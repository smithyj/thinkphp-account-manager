<?php
namespace Oa\Model;
use Think\Model\ViewModel;

class SqlObjectViewModel extends ViewModel{
	public $viewFields = array(
		'SqlObject' => array('id','sql_object','host_id','(SELECT COUNT(*) FROM oa_web Web WHERE Web.sql_object_id = SqlObject.id)'=>'web_count'),
		'Host' => array('ip','_on'=>'SqlObject.host_id=Host.id'),
	);
}