<?php
namespace Oa\Model;
use Think\Model\ViewModel;

class SqlUserViewModel extends ViewModel{
	public $viewFields = array(
		'SqlUser' => array('id','sql_user','sql_pass','host_id','(SELECT COUNT(*) FROM oa_web Web WHERE Web.sql_user_id = SqlUser.id)'=>'web_count'),
		'Host' => array('ip','_on'=>'SqlUser.host_id=Host.id'),
	);
}