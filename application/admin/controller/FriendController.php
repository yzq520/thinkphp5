<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;
use app\common\model\Friend;
use app\tools\Cattree;

class FriendController extends Controller
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
        if(!empty($_GET['status'])){
            $search[] = ['status','=',"{$_GET['status']}"];
        }
        $data = Friend::where($search)->paginate(4)->appends($_GET);
        // dump($data);die;
        return view('friend/index',['data'=>$data]);
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create()
    {
         
       
       
        // dump($data);die;
        return view('friend/create');
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

        $file = $request->file('pic');
        $info = $file->move('photo');
        $filePath = $info->getSaveName();
        $data['pic'] = $filePath;
        try {
            Friend::create($data,true);
        }catch(\Exception $e){
            return $this->error('商品添加失败');
        }
            return $this->success('商品添加成功','/admin/friend_index');
    }

    /**
     * 显示指定的资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function read($id)
    {
       
        // $data = Friend::find($id);
        // // dump($data);die;
        // return view('/Friend/edit',['data'=>$data]);
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id)
    {
        $data = Friend::find($id);
        // dump($data);die;
        return view('friend/edit',['data'=>$data]);
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
        $file = $request->file();
        if(!empty($file)){
            $info = $file['pic']->move('photo');
            $filePath = $info->getSaveName();
            $data['pic'] = $filePath;
            $path = 'photo/'.$data['ypic'];
            unlink($path);
        }else{
            // dump($data['ypic']);
            $data['pic'] = $data['ypic'];
        }
        // dump($data);die;
        try {
            Friend::update($data,['id'=>$id]);
        }catch(\Exception $e){
            return $this->error('友情链接修改失败');
        }
            return $this->success('友情链接修改成功','/admin/friend_index');
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
         $data = Friend::find($id);
        $path = 'photo/'.$data['pic'];
        // dump($path);
        try {
            Friend::destroy($id);
            unlink($path);
        }catch(\Exception $e){
             return $this->error('友情链接删除失败');
        }
            return $this->success('友情链接删除成功','/admin/friend_index');
    }
    
      /**
     * 禁用
     */
    public function jy($id)
    {
        // dump($id);
        // die;
        try {
           Friend::update(['zt'=>'2'],['id'=>$id]); 
        }catch(\Exception $e){
            return $this->error('禁用失败');
        }
            return redirect('/admin/friend_index');
    }
    /**
     * 启用
     */
    public function qy($id)
    {
       try {
           Friend::update(['zt'=>'1'],['id'=>$id]); 
        }catch(\Exception $e){
            return $this->error('启用失败');
        }
            return redirect('/admin/friend_index');
    }
}
