<?php
namespace Oa\Model;
use Think\Model\ViewModel;

class WebViewModel extends ViewModel{
	public $viewFields = array(
		'Web'=>array('*'),
		'WebType'=>array('title'=>'web_type_title','_on'=>'Web.web_type_id=WebType.id'),
		'Hosp'=>array('title'=>'hosp_title','_on'=>'Web.hosp_id=Hosp.id'),
		'Host'=>array('ip'=>'host_title','_on'=>'Web.host_id=Host.id')
	);
}