<?php
namespace Oa\Model;
use Think\Model\ViewModel;

class ConfigViewModel extends ViewModel{
	public $viewFields = array(
		'Config' => array('name','key'=>'`key`','value'=>'`value`','default'=>'`default`','editor'),
		'ConfigCate' => array('title'=>'`group`','_on'=>'Config.config_cate_id=ConfigCate.id')
	);
}