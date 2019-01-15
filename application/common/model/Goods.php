<?php

namespace app\common\model;

use think\Model;
use app\common\model\Type;

class Goods extends Model
{
    //数据表名
    protected $table = 'data_goods';
    //主键
    protected $pk = 'id';
    public function type()
    {
    	return $this->belongsTo('Type','type_id','id');
    }
}
