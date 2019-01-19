<?php

namespace app\common\model;

use think\Model;

class Cart extends Model
{
    //数据表名
    protected $table = 'data_cart';
    //表主键
    protected $pk = 'cid';
}
