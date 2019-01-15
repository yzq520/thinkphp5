<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;
use app\common\model\Config;

class ConfigController extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        $data = Config::select();
        return view('/config/index',['data'=>$data]);
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create()
    {
        return view('/config/create');
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        $data =$request->post();
        $file = $request->file('pic');
        $info = $file->move('photo');
        $filePath = $info->getSaveName();
        $data['pic'] = $filePath;
        try {
            Config::create($data,true);
        }catch(\Exception $e){
            return $this->error('配置添加失败');
        }
            return $this->success('配置添加成功','/admin/config_index');
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
        $data = Config::find($id);
        // dump($data);die;
        return view('/config/edit',['data'=>$data]);
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
            Config::update($data,['id'=>$id]);
        }catch(\Exception $e){
            return $this->error('网站配置修改失败');
        }
            return $this->success('网站配置修改成功','/admin/config_index');
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
    /**
     * 禁用
     */
    public function jy($id)
    {
        // dump($id);
        // die;
        try {
           Config::update(['zt'=>'2'],['id'=>$id]); 
        }catch(\Exception $e){
            return $this->error('禁用失败');
        }
            return redirect('/admin/config_index');
    }
    /**
     * 启用
     */
    public function qy($id)
    {
       try {
           Config::update(['zt'=>'1'],['id'=>$id]); 
        }catch(\Exception $e){
            return $this->error('启用失败');
        }
            return redirect('/admin/config_index');
    }
}
