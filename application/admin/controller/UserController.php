<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;
use app\common\model\User;

class UserController extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        $search = [];
        if(!empty($_GET['uname'])){
            $search[] = ['uname','like',"%{$_GET['uname']}%"];
        }
        $search[] = ['zt','=','1'];
        if(!empty($_GET['status'])){
            $search[] = ['status','=',"{$_GET['status']}"];
        }
        $data = User::where($search)->paginate(4)->appends($_GET);
        return view('user/index',['data'=>$data]);
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create()
    {
        return view('user/create');
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
        }else if(empty($data['uname'])){
            return $this->error('用户名不能为空');
        }
        try{
            User::create($data,true);
        }catch(\Exteption $e){
            return $this->error('添加失败');
        }
            return $this->success('添加成功','/admin/user_index');
        
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
        $data = User::find($id);
        // dump($data);die;
        return view('/user/edit',['data'=>$data]);
    }
    /**
     * 修改密码显示
     */
    public function editpwd($id)
    {
        $data = User::find($id);
        // dump($data);die;
        return view('/user/editpwd',['data'=>$data]);
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
        try {
            User::update($data,['uid'=>$id]);
        } catch(\Exception $e){
            return $this->error('修改失败','/admin/user_edit');
        }
            return $this->success('修改成功','/admin/user_index');
    }
    /**
     * 执行修改密码
     */
     public function updatepwd(Request $request, $id)
    {
        $data = $request->post();
        $date = User::find($id);
        if(empty($data['ypwd'])){
           return $this->error('原密码不能为空'); 
        }elseif(empty($data['pwd'])){
           return $this->error('新密码也不能为空');  
        }elseif($date['pwd']!==md5($data['ypwd'])){
           return $this->error('原密码错误');  
        }
        try {
            User::update($data,['uid'=>$id]);
        } catch(\Exception $e){
            return $this->error('修改失败');
        }
            return $this->success('修改成功','/admin/user_index');

    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        $data = User::destroy($id);
        if($data){
            return $this->success('删除成功','/admin/user_index');
        }else{
            return $this->error('删除失败','/admin/user_index');
        }
    }
    /**
     * 禁用
     */
    public function jy($id)
    {
        try {
           User::update(['zt'=>'2'],['uid'=>$id]); 
        }catch(\Exception $e){
            return $this->error('禁用失败');
        }
            return redirect('/admin/user_index');
    }
    /**
     * 启用
     */
    public function qy($id)
    {
       try {
           User::update(['zt'=>'1'],['uid'=>$id]); 
        }catch(\Exception $e){
            return $this->error('启用失败');
        }
            return redirect('/admin/user_index');
    }
    /**
     * 用户回收站显示
     */
    public function hui()
    {
        $search = [];
        if(!empty($_GET['uname'])){
            $search[] = ['uname','like',"%{$_GET['uname']}%"];
        }
        $search[] = ['zt','=','2'];
        if(!empty($_GET['status'])){
            $search[] = ['status','=',"{$_GET['status']}"];
        }
        $data = User::where($search)->paginate(4)->appends($_GET);
        return view('user/hui',['data'=>$data]);
    }
    /**
     * 检测用户名是否存在
     */
    public function search_uname(){
       $name = $_GET['uname'];
       $data = User::where('uname','=',$name)->find();
       if(empty($data)){
            return json_encode(['status'=>400]);
       }
       return json_encode(['status'=>200]);
    }
}
