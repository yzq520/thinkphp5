<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;
use app\common\model\Register;

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
        $data = Register::where($search)->paginate(5)->appends($_GET);
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
        try {
            $data = Register::destroy($id);
        }catch(\Exception $e){
            return $this->error('删除失败','/admin/home_index');
        }
            return $this->success('删除成功','/admin/home_index');
    }
   
}
