<?php

namespace app\home\controller;

use think\Controller;
use think\Request;
 use app\common\model\Per;
 use app\common\model\User;
  use app\common\model\Register;


class PerController extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {   
        session_start();
        //显示个人中心
        $sess = session('users');
        $data=Per::where('uid','=',session('users.id'))->select();
        // dump($data);
        return view('/per/index',['data'=>$data,'sess'=>$sess]);
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
    public function save(Request $request,$id)
    {
         $data = $request->post();
         // dump($data);die;
         $abc=session('users.id');
    
        try {
            Per::where('uid',$abc)->update($data);
        }catch(\Exception $e){
            return $this->error('修改用户信息失败');
        }
            return $this->success('修改用户信息成功','/home/per_index');
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
        return view('/per/edit');
        //edit
    }

    /**
     * 保存更新的资源
     *
     * @param  \think\Request  $request
     * @param  int  $id
     * @return \think\Response
     */
    public function dopwd(Request $request, $id)

    {
        //执行修改密码
         $data = $request->post();
        $date = Register::find($id);
        if(empty($data['ypwd'])){
           return $this->error('原密码不能为空'); 
        }elseif(empty($data['pwd'])){
           return $this->error('新密码也不能为空');  
        }elseif($date['pwd']!=md5($data['ypwd'])){
           return $this->error('原密码错误');  
        }
        try {
            Register::update(['pwd'=>$data['pwd']],['id'=>$id]);
        } catch(\Exception $e){
            return $this->error('修改失败');
        }
             session('loginHome',false);
            return $this->success('修改成功..请重新登录','/');
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function passwoed($id)
    {
        $data = Register::find($id);
        return view('/per/uppwd',['data'=>$data]);
        

    }
}
