<?php

namespace app\common\model;

use think\Model;

class Register extends Model
{
    //数据表名
    protected $table = 'data_user';
    //主键
    protected $pk = 'id';
    //修改器
    public function setPwdAttr($v){
    	return md5($v);
    }
}
