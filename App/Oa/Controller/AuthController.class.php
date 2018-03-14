<?php
namespace Oa\Controller;
use Think\Controller;
use Think\Auth;

/**
 * 权限判断核心文件
 * @author [杨圆建] <[624508914@qq.com]>
 */
class AuthController extends Controller{
	public function _initialize(){
		//用户登陆信息检测处理
		$sess_User = session('user');
		if(!is_array($sess_User)){
			header("content-type:text/html; charset=utf-8");
			$this->redirect('Login/index', '', 0, '您还未登录 '.C('TITLE').' ,页面跳转中！');
		}
		//更新用户登录生存周期
		session('login_time',time());
		//超级管理员免验证
		if($sess_User['info']['uid'] == C("ADMIN")){
			//管理员用户行为检测记录
			writeBehaviorLog();
			return true;
		}

		//检查普通用户权限
		$AuthModel = new Auth();
		$AuthGroups = $AuthModel->getGroups($sess_User['info']['uid']);
		foreach($AuthGroups as $v){
			if($v['group_id'] == '1'){//区分是否该角色拥有超级管理员角色
				return true;
			}
		}
		if(!$AuthModel->check(CONTROLLER_NAME.'/'.ACTION_NAME,$sess_User['info']['uid'])){
			if(IS_GET){
				echo "<div style='padding:10px;'>没有权限</div>";
				exit;
			} else {
				$msg = doReturn("","没有权限",false);
				$this->ajaxReturn($msg);
			}
		}
		//通过规则验证的用户行为检测记录
		writeBehaviorLog();
	}
}