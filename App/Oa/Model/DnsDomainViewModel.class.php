<?php
namespace Oa\Model;
use Think\Model\ViewModel;

class DnsDomainViewModel extends ViewModel{
	public $viewFields = array(
		'DnsDomain'=>array('id','host_domain','host_id','domain_id','(SELECT COUNT(*) FROM oa_web Web WHERE FIND_IN_SET(DnsDomain.id,Web.dns_domain_id))'=>'web_count'),
		'Domain' => array('name','_on'=>'DnsDomain.domain_id=Domain.id'),
		'Host' => array('ip','_on'=>'DnsDomain.host_id=Host.id'),
	);
}