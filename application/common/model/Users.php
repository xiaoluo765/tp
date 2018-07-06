<?php

namespace app\common\model;

use think\Model;


//跟用户表关联的用户模型，后期通过这个类，就可以对用户表任意操作
class Users extends Model
{	

    //当前模块要关联的表名
    protected $table = 'shop_users';

    //当前模块对应的主键
    protected $pk = 'uid';

    protected $insert = ['create_at'];

    //在模型中就可以对密码进行md5加密
    public function setUpwdAttr($value){
    	return md5($value);
    }

    //在模型中添加一个字段的值(注册时间字段)
    public function setCreateAtAttr($value){
    	return time();
    }

    // //设置时间
    // public function getCreateAtAttr($value){
    // 	return date('Y-m-d H:i:s',time());
    // }

    //设置性别
    public function getSexAttr($value)
	{
		$status = ['m'=>'男','w'=>'女','x'=>'保密'];
		return $status[$value];
	}

	//设置权限
	public function getAuthAttr($value)
	{
		$status = [1=>'超级管理员',2=>'后台用户',3=>'前台用户'];
		return $status[$value];
	}

}



