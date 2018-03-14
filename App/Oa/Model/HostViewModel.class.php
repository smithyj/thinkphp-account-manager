<?php
namespace Oa\Model;
use Think\Model\ViewModel;

class HostViewModel extends ViewModel{
	public $viewFields = array(
		'Host' => array('id','ip','mstsc_port','mstsc_user','mstsc_pass','ftp_port','mysql_user','mysql_pass','mysql_port','mysql_dir','end_date','service_id','remake'),
		'Service' => array('title'=>'service_title','_on'=>'Host.service_id=Service.id'),
	);
}