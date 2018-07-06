<?php
namespace app\admin\controller;

class Index
{
    public function index()
    {
    	//view()表示返回当前模块(admin)下的view目录
    	//不需要加后缀
        return view('common/default');   
    }
}
