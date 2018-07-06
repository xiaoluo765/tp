<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

Route::get('think', function () {
    return 'hello,ThinkPHP5!';
});

Route::get('hello/:name', 'index/hello');

Route::rule('index','index/index/index');


// Route::view('admin/index','admin@common/default');

// Route::get('admin/:user','admin/user/user');
//正则设置name变量规则
// Route::get('admin/:name','admin/user/user')->pattern(['name' => '\w']);

//登录
Route::rule('admin/login','admin/LoginController/login');
Route::rule('login/check','admin/LoginController/check');
Route::rule('admin/code','admin/LoginController/verify');
Route::rule('admin/logout','admin/LoginController/logout');

Route::group([],function(){
	//后台首页
	Route::rule('admin/index','admin/index/index');
	//用户模块
	//添加用户页面的路由
	Route::rule('user/create','admin/UserController/create');
	Route::rule('user/save','admin/UserController/save');
	//返回用户列表的路由
	Route::rule('user/index','admin/UserController/index');
	//删除用户的路由
	Route::rule('user/delete','admin/UserController/delete');
	//返回修改页面的路由
	Route::rule('user/edit','admin/UserController/edit');
	// 执行用户修改的路由
	Route::rule('user/update','admin/UserController/update');
	//修改密码
	Route::rule('user/editpwd','admin/UserController/editpwd');
	//修改密码
	Route::rule('user/updatepwd','admin/UserController/updatepwd');

})->after(['\app\admin\behavior\CheckLogin']);



//分类模块
Route::group(['name'=>'cate/','prefix'=>'admin/CateController/'],function(){
	Route::rule('create/[:id]','create');
	Route::rule('save','save');
	Route::rule('index','index');
	Route::rule('delete/:id','delete');
	Route::rule(':id/edit','edit');
	Route::rule('update/:id','update');
})->after(['\app\admin\behavior\CheckLogin']);
// //添加分类页面的路由
// Route::rule('cate/create','admin/CateController/create');
// Route::rule('cate/save','admin/CateController/save');
// //返回分类列表的路由
// Route::rule('cate/index','admin/CateController/index');
// //返回修改页面的路由
// Route::rule('cate/edit','admin/cateController/edit');
// //修改页面的路由
// Route::rule('cate/update','admin/cateController/update');
// //删除页面的路由
// Route::rule('cate/delete','admin/cateController/delete');

Route::group([],function(){
	//商品模块
	//添加商品页面的路由
	Route::rule('goods/create','admin/GoodsController/create');
	Route::rule('goods/save','admin/GoodsController/save');
	//返回商品列表的路由
	Route::rule('goods/index','admin/GoodsController/index');
	//返回修改页面的路由
	Route::rule('goods/:id/edit','admin/GoodsController/edit');
	//修改页面的路由
	Route::rule('goods/update/:id','admin/GoodsController/update');
	//删除页面的路由
	Route::rule('goods/delete/:id','admin/GoodsController/delete');
	//商品上架路由
	Route::rule('goods/up/:id','admin/GoodsController/up');
	//商品下架路由
	Route::rule('goods/down/:id','admin/GoodsController/down');
})->after(['\app\admin\behavior\CheckLogin']);



Route::group([],function(){
	//订单模块
	//添加订单页面的路由
	Route::rule('order/create','admin/orderController/create');
	Route::rule('order/save','admin/orderController/save');
	//返回订单列表的路由
	Route::rule('order/index','admin/orderController/index');
	//返回修改页面的路由
	Route::rule('order/edit','admin/orderController/edit');
	//修改页面的路由
	Route::rule('order/update','admin/orderController/update');
	//删除页面的路由
	Route::rule('order/delete','admin/orderController/delete');
	//订单详情的路由
	Route::rule('order/show','admin/orderController/show');
	Route::rule('order/out/:id','admin/orderController/out');
	//已发货路由
	Route::rule('order/fa/:id','admin/OrderController/fa');
	//已收货路由
	Route::rule('order/shou/:id','admin/OrderController/shou');
	//取消订单路由
	Route::rule('order/cancel/:id','admin/OrderController/cancel');
});


//前台首页
Route::rule('/','home/indexController/index');
//商品列表页
Route::rule('/goodlist/[:id]','home/GoodController/goodlist');
//商品详情页
Route::rule('/gooddetail/:id','home/GoodController/gooddetail');


Route::group([],function(){
	//购物车
	//添加页
	Route::rule('cart/add','home/CartController/addCart');
	//购物车列表页
	Route::rule('cart/list','home/CartController/listCar');
	//商品购买数量+1
	Route::rule('cart/incr/:id','home/CartController/incr');
	//商品购买数量-1
	Route::rule('cart/desc/:id','home/CartController/desc');
	//删除商品
	Route::rule('cart/delete/:id','home/CartController/delete');
})->after(['\app\home\behavior\CheckLogin']);


Route::group([],function(){
	Route::rule('order/info','home/OrderController/info');
	Route::rule('order/jsy','home/OrderController/jsy');
	Route::rule('order/ok','home/OrderController/ok');
	Route::rule('order/myorder','home/OrderController/myorder');
	//取消订单
	Route::rule('order/cancel/:id','home/OrderController/cancel');
	//确认收货
	Route::rule('order/queren/:id','home/OrderController/queren');
	//删除
	Route::rule('order/del/:id','home/OrderController/delete');
	//个人中心
	Route::rule('person/person','home/PersonController/person');
	Route::rule('pdetail','home/PersonController/pdetail');
	Route::rule('cdetail/:id','home/PersonController/cdetail');
})->after(['\app\home\behavior\CheckLogin']);

// 前台登录
Route::rule('/login','home/LoginController/login');
Route::rule('/check','home/LoginController/check');
Route::rule('home/code','home/LoginController/verify');
Route::rule('/logout','home/LoginController/logout');
//注册
Route::rule('register','home/RegisterController/register');
Route::rule('home/verify','home/RegisterController/verify');
Route::rule('save','home/RegisterController/save');







Route::get('user/:id','admin/user/user',['ext'=>'html']);
return [

];
