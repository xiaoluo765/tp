<?php
namespace app\home\behavior;

class CheckLogin
{
	use \traits\controller\Jump;
	public function run()
	{
		//判断用户是否登录
		if(empty(session('homeFlag'))){
			return $this->error('请先登录，再访问','/login/login');
		}
	}
}