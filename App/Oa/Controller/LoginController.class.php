<?php
namespace Oa\Controller;
use Think\Controller;

class LoginController extends Controller{
	/**
	 * [index 登录首页]
	 * @return [type] [description]
	 */
	public function index(){
		$sess_User = session('user');
		if(is_array($sess_User)){
			$this->success('您已登录'.C('TITLE'),U('Index/index'));
			exit;
		}
		if(IS_POST){
			$table_User = D("User");
			if(!$table_User->create($_POST,4)){//登陆失败
				$msg['info'] = $table_User->getError();
				$msg['status'] = false;
				$this->ajaxReturn($msg);
			} else {
				//写入登录日志
				writeLoginLog();
				$sess_Uid = session('uid');
				/*********************************************************************************************/
				//判读用户角色是否被禁用
				$off_Group = array();
				$table_UserView = D("UserView")->where("User.uid = ".$sess_Uid)->select();
				foreach($table_UserView as $v){
					if(!$v['status']){
						$off_Group[] = false;
					}
				}
				//如果该用户角色都为禁用则返回错误信息，禁止用户登录
				if(count($off_Group) == count($table_UserView)){
					$msg['info'] = "该用户所拥有的角色都已禁用，请联系管理员";
					$msg['status'] = false;
					$this->ajaxReturn($msg);
				}
				$table_User = $table_User->find($sess_Uid);
				//如果该用户状态为禁用状态则返回错误信息，禁止用户登录
				if(!$table_User['status']){
					$msg['info'] = "该用户已被禁用，请联系管理员";
					$msg['status'] = false;
					$this->ajaxReturn($msg);
				}
				/*********************************************************************************************/
				$msg['info'] = "成功登陆，正在跳转会员中心！";
				$msg['status'] = true;
				$msg['url'] = U("Index/index");
				do_LoginSession();
				$this->ajaxReturn($msg);
			}
			$this->ajaxReturn($msg);
			exit;
		}
		$this->display();
	}
	/**
	 * [code 验证码显示]
	 * @return [type] [description]
	 */
	public function code(){
		$config =    array(
			'fontSize'	=>	40,	 // 字体大小
		    'length'    =>  4,     // 验证码位数
		    'useCurve'	=>	false, // 是否使用混淆曲线
		    'useNoise'  =>	false, // 是否使用噪点
		    'bg'		=>	array(255,255,255),
		);
		$verify = new \Think\Verify($config);
		$verify->entry();
	}
	/**
	 * [logout 退出登录操作]
	 * @return [type] [description]
	 */
	public function logout(){
		session(null);
		$this->success("成功退出，正在转向登陆页面！",U('Login/index'));
	}
	/**
	 * [session_timeout 判断是否登录超时]
	 * @return [type] [description]
	 */
	public function session_timeout(){
		$sess_LoginTime = session('login_time');
		$conf_LoginTime = C('LOGIN_TIME');
		if(time()-$sess_LoginTime >= ($conf_LoginTime * 60)){
			$data['status'] = false;
		} else {
			$data['status'] = true;
		}
		$this->ajaxReturn($data);
	}
}