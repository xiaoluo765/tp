<?php
namespace app\admin\controller;

use think\Controller;
use think\Request;
use app\common\model\Login;
use think\captcha\Captcha;
use think\facade\Session;

class LoginController extends Controller
{
	public function login()
	{
		return view('login/login');
	}
	//验证码
	
	public function verify()
	{
		$config =[
            'length' => 4,
        ];
		$captcha = new Captcha($config);
		return $captcha->entry();
	}
	//验证
	public function check(Request $req)
	{
		//接收用户提交过来的登录信息
		$uname = $req -> post('uname');
		$upwd = $req -> post('upwd',null,'md5');
		$yzm = $req -> post('yzm');
		$uname_pattern='/^(\w){4,10}$/';
        $upwd_pattern='/^(\w){6,18}$/';
        if((!preg_match($uname_pattern,$uname)) && (!preg_match($upwd_pattern,$upwd))){
        	return $this->error('用户名或密码格式不正确','/admin/login');
        }
        //find表示只获取一条记录
		$user = Login::where('uname','=',$uname)->where('upwd','=',$upwd)->find();
		//检测输入的验证码是否正确
		if(!captcha_check($yzm)){
			return $this->error('验证码错误','/admin/login');
		}
		if($user){
			//函数session()来读取和写入session
			//设置名为adminFlag的session，表示后台用户是否登录
			session('adminFlag',true);
			//设置一个变量，用于存储后台登录用户的信息，可以在任何页面获取到当前用户用的了
			session('adminUser',$user);
			return $this->success('登录成功','/admin/index');
		}else{
			return $this->error('登录失败','/admin/login');
		}
	}

	public function logout(){
		session('adminFlag',null);
		session('adminUser',null);
		return $this->success('退出登录成功','/admin/login');
	}

}
