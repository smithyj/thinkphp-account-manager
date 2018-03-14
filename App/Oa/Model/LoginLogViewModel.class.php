<?php
namespace Oa\Model;
use Think\Model\ViewModel;

class LoginLogViewModel extends ViewModel{
	public $viewFields = array(
		'LoginLog' => array('ip','date','area','country','user_agent'),
		'User' => array('name','_on'=>'User.uid=LoginLog.uid')
	);
}