<?php

namespace app\home\controller;

use think\Controller;
use think\Request;
use app\common\model\Type;
use app\common\model\Goods;
use app\common\model\Config;
use app\tools\Cattree;
class IndexController extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        $config = Config::find();
        // dump($config);
        if($config['zt']==2){
            return view('/index/tishi');
        }
        $type = Type::select();
        $c = new Cattree($type);
        $type = $c->getTree();
        // dump($type);
        $goods = Goods::select();
        // dump($goods);
        return view('/index/index',['type'=>$type,'goods'=>$goods,'config'=>$config]);
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
        //
    }
}
