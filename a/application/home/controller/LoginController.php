<?php

namespace app\home\controller;

use think\Controller;
use think\Request;
use think\captcha\Captcha;
use think\facade\Session;
use app\common\model\Homelogin;

class LoginController extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function verify(){
        $config =[
            'length' => 3,
        ];
        $captcha = new Captcha($config);
        return $captcha->entry();
    }
    public function login()
    {
        return view('login/login');
    }

    public function check(Request $req){
        $uname = $req -> post('uname');
        $upwd = $req -> post('upwd',null,'md5');
        $yzm = $req -> post('yzm');
        $uname_pattern='/^(\w){4,10}$/';
        $upwd_pattern='/^(\w){6,18}$/';

        if((!preg_match($uname_pattern,$uname)) && (!preg_match($upwd_pattern,$upwd))){
            return $this->error('用户名或密码格式不正确','/login');
        }

        $user = Homelogin::where('uname','=',$uname)->where('upwd','=',$upwd)->find();

        if(!captcha_check($yzm)){
            return $this->error('验证码错误','/login');
        }
        if($user){
            session('homeFlag',true);
            session('homeUser',$user);

            if(!empty(session('back'))){

               
                return $this->success('登录成功','/order/cart');
            }else{
                return $this->success('登录成功','/');
            }
        }else{
            return $this->error('登录失败','/login');
        }
    }

    public function logout(){
        session('homeFlag',null);

        session('homeUser',null);

        session('back',null);

        session('cart',null);

        session('orders',null);
        return redirect('/');
    }

    
}
