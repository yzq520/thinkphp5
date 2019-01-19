<?php

namespace app\common\model;

use think\Model;

class Order extends Model
{
     //数据表名
   protected $table = 'data_order';
    //表主键
    protected $pk = 'oid';

    public function setpwdAttr($v){	//set字段名Attr
    	return md5($v);	
    }
}
