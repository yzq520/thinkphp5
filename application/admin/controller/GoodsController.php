<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;
use app\common\model\Goods;
use app\common\model\Type;
use app\tools\Cattree;

class GoodsController extends Controller
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
        $data = Goods::where($search)->paginate(4)->appends($_GET);
        // dump($data);die;
        return view('/goods/index',['data'=>$data]);
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create()
    {
        $data = Type::select();
        $c = new Cattree($data);
        $data = $c->getTree();
        // dump($data);die;
        return view('/goods/create',['data'=>$data]);
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
            Goods::create($data,true);
        }catch(\Exception $e){
            return $this->error('商品添加失败');
        }
            return $this->success('商品添加成功','/admin/goods_index');
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
        $data = Goods::find($id);
        // dump($data);die;
        return view('/goods/edit',['data'=>$data]);
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
            Goods::update($data,['id'=>$id]);
        }catch(\Exception $e){
            return $this->error('商品修改失败');
        }
            return $this->success('商品修改成功','/admin/goods_index');
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        $data = Goods::find($id);
        $path = 'photo/'.$data['pic'];
        // dump($path);
        try {
            Goods::destroy($id);
            unlink($path);
        }catch(\Exception $e){
             return $this->error('商品删除失败');
        }
            return $this->success('商品删除成功','/admin/goods_index');
    }
}
