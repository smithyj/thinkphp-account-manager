<?php
namespace Oa\Model;
use Think\Model\ViewModel;

class BehaviorLogViewModel extends ViewModel{
	public $viewFields = array(
		'BehaviorLog' => array('controller_name','controller_action','json_data','date','ip'),
		'User' => array('name','_on'=>'User.uid=BehaviorLog.uid')
	);
}