<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;
 use app\common\model\Order;
 use app\common\model\User;
class OrderController extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        $res=Order::select();
        // dump($res);die;
       
        return view('order/index',['res'=>$res]);
        
        // return view('order/index');
    }
    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create()
    {
        //
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        //
    }

    /**
     * 显示指定的资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function read($id)
    {
        
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id)

    {
        $data = Order::find($id);
        // dump($data);
         return view('order/edit',['data'=>$data]);
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
       $data = $request->post();
       // dump($data);die;
       
        try {
            Order::update($data,['oid'=>$id]);
        }catch(\Exception $e){
            return $this->error('商品修改失败');
        }
            return $this->success('商品修改成功','/admin/order_index');
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
