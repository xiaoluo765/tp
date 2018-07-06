<?php

namespace app\home\controller;

use think\Controller;
use think\Request;
use think\captcha\Captcha;
use app\common\model\Homelogin;


class RegisterController extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function register()
    {
        return view('register/register');
    }

    public function verify(){
        $config =[
            'length' => 3,
        ];
        $captcha = new Captcha($config);
        return $captcha->entry();
    }

    public function save(Request $req)
    {
        $data = $_POST;
        $uname = $req->post('uname');
        $email = $req->post('email');
        $yzm = $req->post('yzm');

        $uname_pattern='/^(\w){4,10}$/';
        $upwd_pattern='/^(\w){6,18}$/';
        $email_pattern = '/^[\w-]+@[\w-]+(\.\w+){1,3}$/';


        if($_POST['upwd'] !== $_POST['reupwd']){
            return $this->error('密码和确认密码不一致','/register');
        } 

        if(!captcha_check($yzm)){
            return $this->error('验证码错误','/register');
        }

        if((!preg_match($uname_pattern,$_POST['uname'])) || (!preg_match($upwd_pattern,$_POST['upwd'])) || (!preg_match($email_pattern,$_POST['email']))){
            return $this->error('注册信息格式不正确','/register');
        }
        $upwd = $req->post('upwd',null,'md5');

        $data['upwd'] = $upwd;
        // dump($data);die;
        $user = Homelogin::create($data,true);
        if($user){
            return $this->success('注册成功','/login');
        }else{
            return $this->error('注册失败','/register');
        }

    }
}
