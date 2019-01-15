<?php

namespace app\common\model;

use think\Model;

class Type extends Model
{
    //数据表名
    protected $table = 'data_type';
    //主键
    protected $pk = 'id';
    //获取器
    public function getTypenameAttr(){
    	$n = substr_count($this->path,',')-1;
    	$space = str_repeat('&nbsp;',$n*15);
    	$name = $space.$this['name'];
    	return $name;
    }
}
