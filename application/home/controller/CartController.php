<?php

namespace app\home\controller;

use think\Controller;
use think\Request;
use app\common\model\Goods;
use app\common\model\Cart;
class CartController extends Controller
{
   //加入购物车
   public function add(Request $request,$id)
   {	
   		$num = $request->post();
   		$data = Goods::find($id);
   		$data['num'] = $num['num'];
      $data['uid'] = session('users')['id'];
   		try {
   			Cart::create(['id'=>$data['id'],'uid'=>$data['uid'],'gname'=>$data['gname'],'pic'=>$data['pic'],'price'=>$data['price'],'content'=>$data['content'],'num'=>$data['num']],['id','uid','gname','pic','price','content','num']);
   		}catch(\Exception $e){
   			return $this->error('购物车添加失败');
   		}
   			return $this->success('购物车添加成功','/home/cart_index');
   }
   //加减
   public function num($id)
   {
   		$res = Cart::find($id);
   		// dump($res);
   		if($_GET['a']=='jian'){
   			$res['num'] -= 1;
   		}else{
   			$res['num'] += 1;
   		}
      if($res['num']<=1){
          $res['num']=1;
        }
   		// dump($res['num']);
   		try {
   			Cart::update(['num'=>$res['num']],['cid'=>$id]);
   		} catch (\Exception $e) {
   			 return redirect('/home/cart_index');
   		}
   			 return redirect('/home/cart_index');
   }
   //显示购物车页
   public function index()
   {
      $uid = session('users.id');
   		$data = Cart::where('uid','=',$uid)->select();
   		// dump($data);
   		 $sum=0;
        //总数量
        $amount=0;
        foreach($data as $k=>$v)
        {
            $amount +=$v->num;
            $sum +=  $v->price * $v->num;
        }
   		return view('/cart/index',['data'=>$data,'amount'=>$amount,'sum'=>$sum]);
   }
   //删除购物车商品
   public function delete($id)
   {
   		$data = Cart::destroy($id);
        if($data){
            return $this->success('删除成功');
        }else{
            return $this->error('删除失败');
        }
   }
   //结算购物车
   public function js()
   {
   		$data = Cart::select();
   		// dump($data);
   		return view('/cart/js',['data'=>$data]);
   }
}
