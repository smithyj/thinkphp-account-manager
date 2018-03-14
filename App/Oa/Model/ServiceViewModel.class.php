<?php
namespace Oa\Model;
use Think\Model\ViewModel;

class ServiceViewModel extends ViewModel{
	public $viewFields = array(
		'Service'=>array('*','(SELECT COUNT(*) FROM oa_domain Domain WHERE Domain.service_id = Service.id)'=>'domain_count','(SELECT COUNT(*) FROM oa_host Host WHERE Host.service_id = Service.id)'=>'host_count'),
	);
}