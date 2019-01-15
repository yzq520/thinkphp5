<?php

namespace app\common\model;

use think\Model;

class User extends Model
{
    //数据表名
    protected $table = 'data_admin';
    //表主键
    protected $pk = 'uid';
    //修改器
    public function setPwdAttr($v){
    	return md5($v);
    }
}
