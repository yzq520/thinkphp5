<?php

namespace app\common\model;

use think\Model;

class Order extends Model
{
    //数据表名
    protected $table = 'data_order';
    //主键
    protected $pk = 'oid';
}
