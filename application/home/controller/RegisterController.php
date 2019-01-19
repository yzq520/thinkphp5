<?php

namespace app\home\controller;

use think\Controller;
use think\Request;
use app\common\model\Register;
use app\common\model\Per;


class RegisterController extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        return view('/register/index');
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
         $data = $request->post();
        // dump($data);die;
        if(empty($data['pwd'])){
            return $this->error('密码不能为空');
        }else if($data['pwd']!=$data['repwd']){
            return $this->error('密码不一致');
        }else if(empty($data['name'])){
            return $this->error('用户名不能为空');
        }
        try{
           $data=Register::create($data,true);

           $per['uid']=$data['id'];
           Per::create($per,true);
           
        }catch(\Exteption $e){
            return $this->error('注册失败');
        }

            
            return $this->success('注册成功','/home/login_index');
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
