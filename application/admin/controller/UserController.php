<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;
use app\common\model\Users;
use think\facade\Session;
use Exception;

class UserController extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        // echo '<pre>';
        $conditon = [];
        //如果性别不为空
        if(!empty($_GET['sex'])){
            $conditon[] = ['sex','=',$_GET['sex']];
            //以get方式接收到性别，需要把性别变量传到前台模板，给表单绑定给定的值
            $this->assign('sex',$_GET['sex']);
        }
        //如果用户名不为空
        if(!empty($_GET['uname'])){
            $conditon[] = ['uname','like',"%{$_GET['uname']}%"];
            $conditon[] = ['auth','like',"%{$_GET['uname']}%"];
            $conditon[] = ['tel','like',"%{$_GET['uname']}%"];
            $this->assign('uname',$_GET['uname']);
        }
        //通过模型获取数据
        //$users = Users::select();
        //appends()用于在点击前台模板中下一页或者上一页时，将查询条件带到后台
        //where('字段名','表达式','查询条件');
        $users = Users::whereor($conditon)->paginate(4)->appends($_GET);
        // var_dump($users);die();
        //将数据和视图绑定
        //参数1：需要返回的视图
        //参数2：需要给视图绑定数据，数组形式
        //'在视图中表示通过模型获取到的数据$users' => 上面获取到的数据
        //即获取到的数据，绑定到页面上，并给这个数据起个别名
        return view('user/index',['user'=>$users]);

       
    }

    /**
     * 添加.
     *
     * @return \think\Response
     */
    public function create()
    {
        return view('user/insert');
    }

    /**
     * 保存
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        // echo '<pre>';
        // var_dump($_POST);
        // 获取表单提取的数据
        $data = $_POST;
        $uname_pattern='/^(\w){4,10}$/';
        $upwd_pattern='/^(\w){6,18}$/';
        $tel_pattern = '/^1[3-9]\d{9}$/';
        //判断密码是否为空
        if(empty($_POST['auth']) || empty($_POST['uname']) || empty($_POST['upwd']) || empty($_POST['reupwd'])){
            return $this->error('信息不能为空','/user/create');
        }
        //判断密码和确认密码是否一致
        if($_POST['upwd'] !== $_POST['reupwd']){
            return $this->error('密码和确认密码必须一致','/user/create');
        }

        //向用户的users表执行添加操作
        //使用模型前，一定要先引用，然后再实例化
        //引入的方法：找到当前类Users所在的命名空间，在当前控制器中use一下，再加上类名
        // $user = new Users;
        // $res = $user -> save($data);
        
        // 添加用户的第二种方法，推荐
        //参数1：表单提交过来的数据
        //参数2：如果是true，会自动对表单提交过来的数据进行过滤，只保留表中存在的字段的数据
        if(!preg_match($uname_pattern,$_POST['uname'])){
            return $this->error('用户名不符合','/user/create');
        }elseif(!preg_match($upwd_pattern,$_POST['upwd'])){
            return $this->error('密码必须6-18位，只能包含字母数字下划线');
        }elseif(!preg_match($tel_pattern,$_POST['tel'])){
            return $this->error('号码不符合');
        }
        $res = Users::create($data,true);
        if($res){
            return $this->success('添加用户成功','/user/index');
        }else{
            return $this->error('添加用户失败','/user/create');
        }
    }

    /**
     * 显示指定的资源
     *
     * @param  int  $id
     * @return \think\Response
     */

    public function read($id)
    {
        //
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit()
    {
        $uid = $_GET['uid'];
        //如果只获取一条记录
        // $users = Users::find($uid);
        $users = Users::get($uid);
        return view('user/edit',['users'=>$users]);
    }

    /**
     * 保存更新的资源
     *
     * @param  \think\Request  $request
     * @param  int  $id
     * @return \think\Response
     */
    public function update()
    {
        $uid = $_GET['uid'];
        if(empty($_POST['auth']) || empty($_POST['uname']) || empty($_POST['sex']) || empty($_POST['tel'])){
            return $this->error('修改的信息不能有空','/user/edit?uid='.$uid);
        }

        try{
            //参数1：表示要修改的记录
            //参数2：要修改的记录的id
            //参数3：表示只修改数据表中存在的字段，不存在的直接过滤掉
            Users::update($_POST,['uid'=>$uid],true);
        }catch(Exception $e){
            return $this->error('用户修改失败','/user/edit?uid='.$uid);
        }
        return $this->success('用户修改成功','/user/index');
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
      
    public function delete()
    {
        $uid = $_GET['uid'];
        //$user = User::get($uid);
        //$user -> delete();
        $res = Users::destroy($uid);
        if($res){
            return $this->success('删除用户成功','/user/index');
        }else{
            return $this->error('删除用户失败','/user/index');
        }
    }

    public function editpwd(){
        $uid = $_GET['uid'];
        $user = Users::get($uid);
        return view('user/editpwd',['users'=>$user]);
    }
    public function updatepwd(){
        $uid = $_GET['uid'];
        if(empty($_POST['upwd']) || $_POST['upwd']!=$_POST['reupwd']){
           return $this->error('密码有误','/user/editpwd?uid='.$uid);
        }
        $user = Users::update($_POST,['uid'=>$uid],true);
        if($user){
            return $this->success('修改密码成功','/user/index');
        }else{
            return $this->error('修改密码失败','/user/editpwd?uid='.$uid);
        }

    }
}
