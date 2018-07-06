<?php

namespace app\home\controller;

use think\Controller;
use think\Request;
use app\common\model\Order;
use app\common\model\Homelogin;

class PersonController extends Controller
{
    public function person()
    {
        $cnt = 0;
        $order = Order::where('user_uid','=',session('homeUser.uid'))->select();
        $user = Homelogin::where('uid','=',session('homeUser.uid'))->select();

        foreach($order as $k => $v){
            $cnt += $v['cnt'];
        }
        // dump($cnt);die;
        return view('person/person',['cnt'=>$cnt,'user'=>$user]);
    }

    public function pdetail()
    {
        $user = Homelogin::where('uid','=',session('homeUser.uid'))->select();
        return view('person/person_detail',['user'=>$user]);
    }

    public function cdetail(Request $req,$id)
    {

        
        $data = $_POST;
        $email = $req->post('email');
        $file = $req->file('pic');
        // dump($data);

        if($file){
            $info = $file -> move('static/uploads');
            if($info){
                $str = '/static/uploads/'.$info->getSaveName();
            }else{
                return $file->getError();
            }
            $data['pic']=$str;
        }
        
        // dump($data);die;


        $upwd_pattern='/^(\w){6,18}$/';
        $email_pattern = '/^[\w-]+@[\w-]+(\.\w+){1,3}$/';

        if($_POST['upwd'] !== $_POST['reupwd']){
            return $this->error('密码和确认密码不一致','/pdetail');
        } 
        if((preg_match($upwd_pattern,$_POST['upwd']) == 0) || (preg_match($email_pattern,$_POST['email'])) == 0){
            return $this->error('信息格式不正确','/pdetail');
        }
        // dump($_POST['upwd']);die;

        // dump($data);die;
        $upwd = $req->post('upwd',null,'md5');
        $data['upwd'] = $upwd;
        
        $user = Homelogin::update($data,['uid'=>$id],true);
        // dump($user);die;
        // session('pic',$data['pic']);
        if($user){
            return $this->success('修改成功','/person/person');
        }else{
            return $this->error('修改失败',"/cdetail/{:session('homeUser.uid')}");
        }
    }
}
