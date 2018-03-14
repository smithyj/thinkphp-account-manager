<?php
namespace Oa\Controller;
use Think\Controller;

class IsLoginController extends Controller{
	public function _initialize(){
		//用户登陆信息检测处理
		$sess_User = session('user');
		if(!is_array($sess_User)){
			//$this->error('您还未登录 '.C('TITLE'),U('Login/index'));
			header("content-type:text/html; charset=utf-8");
			$this->redirect('Login/index', '', 0, '您还未登录 '.C('TITLE').' ,页面跳转中！');
		}
		//更新用户登录生存周期
		session('login_time',time());
	}
}