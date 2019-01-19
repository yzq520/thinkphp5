<?php

namespace app\home\controller;

use think\Controller;
use think\Request;
use app\common\model\Order;
use app\common\model\Cart;

class OrderController extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        return view('/cart/list');
    }

    

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        $data = $request->post();
        // dump($data);die;
        // $res = Order::where(['addr'=>$data['addr'],'email'=>$data['email'],'name'=>$data['name'],'phone'=>$data['phone'],'ddh'=>$data['ddh']],['addr','email','name','phone','ddh'])->select();
        //保存(session)登录用户信息
        session('orders',$data);
        return redirect('/home/js_cart');

    }


    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create()
    {
        $uid = session('users.id');
        $data = Cart::where('uid','=',$uid)->select();
        foreach($data as $v){
            $ord = [];
            $ord['uid'] = $v['uid'];
            $ord['gname'] = $v['gname'];
            $ord['pic'] = $v['pic'];
            $ord['zprice'] = $v['price'] * $v['num'];
            $ord['num'] = $v['num'];
            $ord['status'] = 1;
            $ord['ddh'] = session('orders.ddh');
            $ord['addr'] = session('orders.addr');
            $ord['email'] = session('orders.email');
            $ord['name'] = session('orders.name');
            $ord['phone'] = session('orders.phone');
            Order::create($ord,true);
        }
        // 清空购物车
            foreach($data as $k=>$v){      
                $id[$k] = $v['cid'];
                Cart::destroy($id);
            } 
        return $this->success('添加成功','/home/order_index');
        // dump($data);die;
    }

    /**
     * 显示指定的资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function read($id)
    {
        //
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * 保存更新的资源
     *
     * @param  \think\Request  $request
     * @param  int  $id
     * @return \think\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        //
    }
}
