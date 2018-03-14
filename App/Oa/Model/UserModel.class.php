<?php
namespace Oa\Model;
use Think\Model\RelationModel;

class UserModel extends RelationModel{
	protected $_validate = array(
		array('code','checkCode','验证码错误',0,'callback'),
		array('name','checkName','用户名不存在',1,'callback',4),
		array('pass','checkPass','密码错误，请联系管理员',1,'callback',4)
	);
	protected $_auto = array(
        array('create_date', 'time', 1, 'function'),
        array('pass', '', 2, 'ignore'), //修改时
        array('pass', 'md5', 3, 'function')
    );
	public function checkCode(){
		$verify = new \Think\Verify();
		return $verify->check(I('code'));
	}
	public function checkName(){
		$table_User = M("User")->where(array("name"=>I("name")))->find();
		if(!is_array($table_User)) return false;
	}
	public function checkPass(){
		$table_User = M("User")->where(array("name"=>I("name"),"pass"=>I("pass",0,'md5')))->find();
		if(!is_array($table_User)) return false;
		//账号密码校验成功过后记录用户uid
		session('uid',$table_User['uid']);
	}
	protected $_link = array(
		'AuthGroup' => array(
			'mapping_type' => self::MANY_TO_MANY,
			'class_name' => 'AuthGroup',
			'mapping_name' => 'groups',
			'foreign_key' => 'uid',
			'relation_foreign_key' => 'group_id',
			'relation_table' => 'oa_auth_group_access'
		),
		'Branch' => array(
			'mapping_type' => self::BELONGS_TO,
			'class_name' => 'Branch',
			'foreign_key' => 'branch_id',
			'as_fields' => 'title:branch_title'
		),
		'Job' => array(
			'mapping_type' => self::BELONGS_TO,
			'class_name' => 'Job',
			'foreign_key' => 'job_id',
			'as_fields' => 'title:job_title'
		),
		'Hosp' => array(
			'mapping_type' => self::MANY_TO_MANY,
			'class_name' => 'Hosp',
			'mapping_name' => 'hosps',
			'foreign_key' => 'uid',
			'relation_foreign_key' => 'hosp_id',
			'relation_table' => 'oa_user_hosp'
		),

	);
}