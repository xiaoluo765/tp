<?php

namespace app\common\model;

use think\Model;

class Login extends Model
{
	//当前模块要关联的表名
    protected $table = 'shop_users';

    //当前模块对应的主键
    protected $pk = 'uid';
}