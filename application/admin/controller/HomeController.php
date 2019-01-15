<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;
use app\common\model\Home;

class HomeController extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        $search = [];
        if(!empty($_GET['name'])){
            $search[] = ['name','like',"%{$_GET['name']}%"];
        }
        $search[] = ['zt','=','1'];
        if(!empty($_GET['dj'])){
            $search[] = ['dj','=',"{$_GET['dj']}"];
        }
        $data = Home::where($search)->paginate(5)->appends($_GET);
        return view('/home/index',['data'=>$data]);
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
        $data = Home::find($id);
        return view('/home/edit',['data'=>$data]);
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
            Home::update($data,['id'=>$id]);
        } catch(\Exception $e){
            return $this->error('修改失败','/admin/home_edit');
        }
            return $this->success('修改成功','/admin/home_index');
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        try {
            $data = Home::destroy($id);
        }catch(\Exception $e){
            return $this->error('删除失败','/admin/home_index');
        }
            return $this->success('删除成功','/admin/home_index');
    }
    /**
     * 禁用
     */
    public function jy($id)
    {
        // dump($id);
        // die;
        try {
           Home::update(['zt'=>'2'],['id'=>$id]); 
        }catch(\Exception $e){
            return $this->error('禁用失败');
        }
            return redirect('/admin/home_hui');
    }
    /**
     * 启用
     */
    public function qy($id)
    {
       try {
           Home::update(['zt'=>'1'],['id'=>$id]); 
        }catch(\Exception $e){
            return $this->error('启用失败');
        }
            return redirect('/admin/home_index');
    }
    /**
     * 用户回收站显示
     */
    public function hui()
    {
        $search = [];
        if(!empty($_GET['name'])){
            $search[] = ['name','like',"%{$_GET['name']}%"];
        }
        $search[] = ['zt','=','2'];
        if(!empty($_GET['dj'])){
            $search[] = ['dj','=',"{$_GET['dj']}"];
        }
        $data = Home::where($search)->paginate(4)->appends($_GET);
        return view('/home/hui',['data'=>$data]);
    }
}
