<?php

namespace app\common\model;

use think\Model;

class Homelogin extends Model
{
	//当前模块要关联的表名
    protected $table = 'home_user';

    //当前模块对应的主键
    protected $pk = 'uid';
}