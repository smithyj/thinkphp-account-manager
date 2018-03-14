<?php
namespace Oa\Model;
use Think\Model\ViewModel;

class FtpViewModel extends ViewModel{
	public $viewFields = array(
		'Ftp' => array('id','ftp_user','ftp_pass','ftp_dir','host_id','remake','(SELECT COUNT(*) FROM oa_web Web WHERE Web.ftp_id = Ftp.id)'=>'web_count'),
		'Host' => array('ip','_on'=>'Ftp.host_id=Host.id'),
	);
}