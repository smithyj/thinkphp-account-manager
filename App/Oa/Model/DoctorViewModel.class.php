<?php
namespace Oa\Model;
use Think\Model\ViewModel;

class DoctorViewModel extends ViewModel{
	public $viewFields = array(
		'Doctor' => array('id','title','number','phone','email'),
		'Hosp' => array('title'=>'hosp_title','_on'=>'Doctor.hosp_id=Hosp.id'),
	);
}