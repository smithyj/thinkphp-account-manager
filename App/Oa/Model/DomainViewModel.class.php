<?php
namespace Oa\Model;
use Think\Model\ViewModel;

class DomainViewModel extends ViewModel{
	public $viewFields = array(
		'Domain' => array('id','name','user','dns','is_record','record_type','end_date','service_id','remake','(SELECT COUNT(*) FROM oa_dns_domain DnsDomain WHERE DnsDomain.domain_id = Domain.id)'=>'dns_domain_count'),
		'Service' => array('title'=>'service_title','_on'=>'Domain.service_id=Service.id')
	);
}