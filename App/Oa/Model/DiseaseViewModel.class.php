<?php
namespace Oa\Model;
use Think\Model\ViewModel;

class DiseaseViewModel extends ViewModel{
	public $viewFields = array(
		'Disease' => array('id','title'),
		'Hosp' => array('title'=>'hosp_title','_on'=>'Disease.hosp_id=Hosp.id'),
	);
}