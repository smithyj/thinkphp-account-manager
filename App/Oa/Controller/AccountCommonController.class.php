<?php
namespace Oa\Controller;
use Think\Controller;

class AccountCommonController extends IsLoginController{
	public function listService(){
		$table_Service = M("Service")->order("id asc")->select();
		if(IS_POST && I("get.type") == "all"){
			array_unshift($table_Service,array("id"=>"0","title"=>"全部服务商","selected"=>true));
		}
		$this->ajaxReturn($table_Service);
		exit;
	}
	public function listHost(){
		$table_Host = M("Host")->order("id asc")->field('id,ip as title')->select();
		if(IS_POST && I("get.type") == "all"){
			array_unshift($table_Host,array("id"=>"0","title"=>"全部服务器","selected"=>true));
		}
		$this->ajaxReturn($table_Host);
		exit;
	}
	public function listDomain(){
		$table_Domain = M("Domain")->order("id asc")->field('id,name as title')->select();
		if(IS_POST && I("get.type") == "all"){
			array_unshift($table_Domain,array("id"=>"0","title"=>"全部域名","selected"=>true));
		}
		$this->ajaxReturn($table_Domain);
		exit;
	}
	public function listWebType(){
		$table_WebType = M("WebType")->order("id asc")->field('id,title')->select();
		if(IS_POST && I("get.type") == "all"){
			array_unshift($table_WebType,array("id"=>"0","title"=>"全部类型","selected"=>true));
		}
		$this->ajaxReturn($table_WebType);
		exit;
	}
	public function checkAddDnsDomain(){
		//验证是否已存在
		if(IS_POST && I('host_domain')){
			$count = M("DnsDomain")->where(array("host_domain"=>I("host_domain"),"host_id"=>I("host_id"),"domain_id"=>I("domain_id")))->count();
			if(!$count){
				echo "true";
			} else {
				echo "false";
			}
			exit;
		}
	}
	public function checkEditDnsDomain(){
		//验证是否已存在
		if(IS_POST && I('host_domain')){
			$count = M("DnsDomain")->where(array('id' => array('neq',I("get.id")),"host_domain"=>I("host_domain"),"host_id"=>I("host_id"),"domain_id"=>I("domain_id")))->count();
			if(!$count){
				echo "true";
			} else {
				echo "false";
			}
			exit;
		}
	}
	public function listFtp(){
		if(IS_POST && I("get.host_id")){//处理联动
			$where['host_id'] = I("get.host_id");
		}
		$table_Ftp = M("Ftp")->where($where)->order("id asc")->field('id,ftp_user as title')->select();
		if(IS_POST && I("get.type") == "all"){
			array_unshift($table_Ftp,array("id"=>"0","title"=>"全部FTP","selected"=>true));
		}
		$this->ajaxReturn($table_Ftp);
		exit;
	}
	public function listSqlUser(){
		if(IS_POST && I("get.host_id")){//处理联动
			$where['host_id'] = I("get.host_id");
		}
		$table_SqlUser = M("SqlUser")->where($where)->order("id asc")->field('id,sql_user as title')->select();
		if(IS_POST && I("get.type") == "all"){
			array_unshift($table_SqlUser,array("id"=>"0","title"=>"全部数据库用户","selected"=>true));
		}
		$this->ajaxReturn($table_SqlUser);
		exit;
	}
	public function listSqlObject(){
		if(IS_POST && I("get.host_id")){//处理联动
			$where['host_id'] = I("get.host_id");
		}
		$table_SqlObject = M("SqlObject")->where($where)->order("id asc")->field('id,sql_object as title')->select();
		if(IS_POST && I("get.type") == "all"){
			array_unshift($table_SqlObject,array("id"=>"0","title"=>"全部数据库对象","selected"=>true));
		}
		$this->ajaxReturn($table_SqlObject);
		exit;
	}
	public function listDnsDomain(){
		if(IS_POST && I("get.host_id")){//处理联动
			$where['host_id'] = I("get.host_id");
		}
		$table_DnsDomain = D("DnsDomainView")->where($where)->order("id asc")->select();
		foreach($table_DnsDomain as $k => $v){
			$table_DnsDomain[$k]['title'] = ($v['host_domain'] == '@' ? '': $v['host_domain'].'.').$v['name'];
		}
		if(IS_POST && I("get.type") == "all"){
			array_unshift($table_DnsDomain,array("id"=>"0","title"=>"全部域名解析","selected"=>true));
		}
		$this->ajaxReturn($table_DnsDomain);
		exit;
	}
}