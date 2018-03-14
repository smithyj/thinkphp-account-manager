<?php
namespace Oa\Model;
use Think\Model\ViewModel;

class UserViewModel extends ViewModel{
	public $viewFields = array(
		'User' => array('uid'),
		'AuthGroupAccess' => array('group_id','_on'=>'User.uid=AuthGroupAccess.uid'),
		'AuthGroup' => array('status','_on'=>'AuthGroup.id=AuthGroupAccess.group_id')
	);
}