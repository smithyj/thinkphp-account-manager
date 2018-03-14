<?php
namespace Oa\Controller;
use Think\Controller;

class AccountController extends AuthController {
    /**
	 * [Service 服务商管理开始]
	 * ======================================================================
	 */
	public function Service(){
		if(IS_POST){
			$table_Service = D("ServiceView")->order("id asc")->page(I('page'),I('rows'))->select();
			$data = array(
				"total" => M("Service")->count(),
				"rows" => $table_Service
			);
			$this->ajaxReturn($data);
			exit;
		}
		$this->display();
	}

	public function addService(){
		if(IS_POST && I("addService")){
			$table_Service = M("Service");
			if(!$table_Service->create()){
				$msg = doReturn("","数据创建失败，未知原因，请联系管理员",false);
			} else {
				$status = $table_Service->add();
				$msg = doReturn("数据添加成功","数据添加失败,未知原因，请联系管理员",$status);
			}
			$this->ajaxReturn($msg);
			exit;
		}
		$this->display();
	}

	public function editService(){
		if(IS_POST && I("editService")){
			$table_Service = M("Service");
			if(!$table_Service->create()){
				$msg = doReturn("","数据创建失败，未知原因，请联系管理员",false);
			} else {
				$status = $table_Service->save();
				$msg = doReturn("数据编辑成功","数据编辑失败,未知原因，请联系管理员",$status);
			}
			$this->ajaxReturn($msg);
			exit;
		}
		$this->Service = M("Service")->find(I('id'));
		$this->display();
	}

	public function delService(){
		if(IS_POST && I('id')){
			$status = M("Service")->delete(I('id'));
			$msg = doReturn("数据成功删除","数据删除失败，请联系管理员",$status);
			$this->ajaxReturn($msg);
			exit;
		}
	}

	/**
	 * [EndService 服务商管理结束]
	 */

	/**
	 * [Host 服务器管理开始]
	 * ======================================================================
	 */
	public function Host(){
		if(IS_POST){
			$search = I('search');
			if(trim($search['service_id'],' ') != '' && $search['service_id'] > 0){
				$where['service_id'] = trim($search['service_id'],' ');
			}
			$table_Host = D("HostView")->where($where)->order("id asc")->page(I('page'),I('rows'))->select();
			$data = array(
				"total" => D("HostView")->where($where)->count(),
				"rows" => $table_Host
			);
			$this->ajaxReturn($data);
			exit;
		}
		$this->display();
	}

	public function addHost(){
		if(IS_POST && I("addHost")){
			$table_Host = M("Host");
			if(!$table_Host->create()){
				$msg = doReturn("","数据创建失败，未知原因，请联系管理员",false);
			} else {
				$status = $table_Host->add();
				$msg = doReturn("数据添加成功","数据添加失败,未知原因，请联系管理员",$status);
			}
			$this->ajaxReturn($msg);
			exit;
		}
		$this->display();
	}

	public function editHost(){
		if(IS_POST && I("editHost")){
			$table_Host = M("Host");
			if(!$table_Host->create()){
				$msg = doReturn("","数据创建失败，未知原因，请联系管理员",false);
			} else {
				$status = $table_Host->save();
				$msg = doReturn("数据编辑成功","数据编辑失败,未知原因，请联系管理员",$status);
			}
			$this->ajaxReturn($msg);
			exit;
		}
		$this->Host = M("Host")->find(I('id'));
		$this->display();
	}

	public function delHost(){
		if(IS_POST && I('id')){
			$status = M("Host")->delete(I('id'));
			$msg = doReturn("数据成功删除","数据删除失败，请联系管理员",$status);
			$this->ajaxReturn($msg);
			exit;
		}
	}

	/**
	 * [EndHost 服务器管理结束]
	 */

	/**
	 * [Ftp Ftp管理开始]
	 * ======================================================================
	 */
	public function Ftp(){
		if(IS_POST){
			$search = I('search');
			if(trim($search['host_id'],' ') != '' && $search['host_id'] > 0){
				$where['host_id'] = trim($search['host_id'],' ');
			}
			$table_Ftp = D("FtpView")->where($where)->order("id asc")->page(I('page'),I('rows'))->select();
			$data = array(
				"total" => D("FtpView")->where($where)->count(),
				"rows" => $table_Ftp
			);
			$this->ajaxReturn($data);
			exit;
		}
		$this->display();
	}

	public function addFtp(){
		if(IS_POST && I("addFtp")){
			$table_Ftp = M("Ftp");
			if(!$table_Ftp->create()){
				$msg = doReturn("","数据创建失败，未知原因，请联系管理员",false);
			} else {
				$status = $table_Ftp->add();
				$msg = doReturn("数据添加成功","数据添加失败,未知原因，请联系管理员",$status);
			}
			$this->ajaxReturn($msg);
			exit;
		}
		$this->display();
	}

	public function editFtp(){
		if(IS_POST && I("editFtp")){
			$table_Ftp = M("Ftp");
			if(!$table_Ftp->create()){
				$msg = doReturn("","数据创建失败，未知原因，请联系管理员",false);
			} else {
				$status = $table_Ftp->save();
				$msg = doReturn("数据编辑成功","数据编辑失败,未知原因，请联系管理员",$status);
			}
			$this->ajaxReturn($msg);
			exit;
		}
		$this->Ftp = M("Ftp")->find(I('id'));
		$this->display();
	}

	public function delFtp(){
		if(IS_POST && I('id')){
			$status = M("Ftp")->delete(I('id'));
			$msg = doReturn("数据成功删除","数据删除失败，请联系管理员",$status);
			$this->ajaxReturn($msg);
			exit;
		}
	}

	/**
	 * [EndFtp Ftp管理结束]
	 */

	/**
	 * [SqlUser 数据库用户管理开始]
	 * ======================================================================
	 */
	public function SqlUser(){
		if(IS_POST){
			$search = I('search');
			if(trim($search['sql_user'],' ') != ''){
				$where['sql_user'] = array('like','%'.trim($search['sql_user'],' ').'%');
			}
			if(trim($search['host_id'],' ') != '' && $search['host_id'] > 0){
				$where['host_id'] = trim($search['host_id'],' ');
			}
			$table_SqlUser = D("SqlUserView")->where($where)->order("id asc")->page(I('page'),I('rows'))->select();
			$data = array(
				"total" => D("SqlUserView")->where($where)->count(),
				"rows" => $table_SqlUser
			);
			$this->ajaxReturn($data);
			exit;
		}
		$this->display();
	}

	public function addSqlUser(){
		if(IS_POST && I("addSqlUser")){
			$table_SqlUser = M("SqlUser");
			if(!$table_SqlUser->create()){
				$msg = doReturn("","数据创建失败，未知原因，请联系管理员",false);
			} else {
				S('SqlUser_host_id',$table_SqlUser->host_id,C("S_TIME"));
				$status = $table_SqlUser->add();
				$msg = doReturn("数据添加成功","数据添加失败,未知原因，请联系管理员",$status);
			}
			$this->ajaxReturn($msg);
			exit;
		}
		$this->display();
	}

	public function editSqlUser(){
		if(IS_POST && I("editSqlUser")){
			$table_SqlUser = M("SqlUser");
			if(!$table_SqlUser->create()){
				$msg = doReturn("","数据创建失败，未知原因，请联系管理员",false);
			} else {
				$status = $table_SqlUser->save();
				$msg = doReturn("数据编辑成功","数据编辑失败,未知原因，请联系管理员",$status);
			}
			$this->ajaxReturn($msg);
			exit;
		}
		$this->SqlUser = M("SqlUser")->find(I('id'));
		$this->display();
	}

	public function delSqlUser(){
		if(IS_POST && I('id')){
			$status = M("SqlUser")->delete(I('id'));
			$msg = doReturn("数据成功删除","数据删除失败，请联系管理员",$status);
			$this->ajaxReturn($msg);
			exit;
		}
	}

	/**
	 * [EndSqlUser 数据库用户管理结束]
	 */

	/**
	 * [SqlObject 数据库对象管理开始]
	 * ======================================================================
	 */
	public function SqlObject(){
		if(IS_POST){
			$search = I('search');
			if(trim($search['sql_object'],' ') != ''){
				$where['sql_object'] = array('like','%'.trim($search['sql_object'],' ').'%');
			}
			if(trim($search['host_id'],' ') != '' && $search['host_id'] > 0){
				$where['host_id'] = trim($search['host_id'],' ');
			}
			$table_SqlObject = D("SqlObjectView")->where($where)->order("id asc")->page(I('page'),I('rows'))->select();
			$data = array(
				"total" => D("SqlObjectView")->where($where)->count(),
				"rows" => $table_SqlObject
			);
			$this->ajaxReturn($data);
			exit;
		}
		$this->display();
	}

	public function addSqlObject(){
		if(IS_POST && I("addSqlObject")){
			$table_SqlObject = M("SqlObject");
			if(!$table_SqlObject->create()){
				$msg = doReturn("","数据创建失败，未知原因，请联系管理员",false);
			} else {
				S('SqlObject_host_id',$table_SqlObject->host_id,C("S_TIME"));
				$status = $table_SqlObject->add();
				$msg = doReturn("数据添加成功","数据添加失败,未知原因，请联系管理员",$status);
			}
			$this->ajaxReturn($msg);
			exit;
		}
		$this->display();
	}

	public function editSqlObject(){
		if(IS_POST && I("editSqlObject")){
			$table_SqlObject = M("SqlObject");
			if(!$table_SqlObject->create()){
				$msg = doReturn("","数据创建失败，未知原因，请联系管理员",false);
			} else {
				$status = $table_SqlObject->save();
				$msg = doReturn("数据编辑成功","数据编辑失败,未知原因，请联系管理员",$status);
			}
			$this->ajaxReturn($msg);
			exit;
		}
		$this->SqlObject = M("SqlObject")->find(I('id'));
		$this->display();
	}

	public function delSqlObject(){
		if(IS_POST && I('id')){
			$status = M("SqlObject")->delete(I('id'));
			$msg = doReturn("数据成功删除","数据删除失败，请联系管理员",$status);
			$this->ajaxReturn($msg);
			exit;
		}
	}

	/**
	 * [EndSqlObject 数据库对象管理结束]
	 */

	/**
	 * [Domain 域名管理开始]
	 * ======================================================================
	 */
	public function Domain(){
		if(IS_POST){
			//搜索条件组合
			$search = I('search');
			if(trim($search['service_id'],' ') != '' && $search['service_id'] > 0){
				$where['service_id'] = trim($search['service_id'],' ');
			}
			if(trim($search['name'],' ') != ''){
				$where['name'] = array('like','%'.trim($search['name'],' ').'%');
			}
			//前台排序处理
			if(I("sort") && I("order")){
				$sort_field = explode(",",I("sort"));
				$order_field = explode(",",I("order"));
				foreach($sort_field as $k=>$v){
					$order[] = $v." ".$order_field[$k];
				}
				$order = implode(",",$order);
			} else {
				$order = 'id asc';
			}
			$table_Domain = D("DomainView")->where($where)->order($order)->page(I('page'),I('rows'))->select();
			$data = array(
				"total" => D("DomainView")->where($where)->count(),
				"rows" => $table_Domain
			);
			$this->ajaxReturn($data);
			exit;
		}
		$this->display();
	}

	public function addDomain(){
		if(IS_POST && I("addDomain")){
			$table_Domain = M("Domain");
			if(!$table_Domain->create()){
				$msg = doReturn("","数据创建失败，未知原因，请联系管理员",false);
			} else {
				$status = $table_Domain->add();
				$msg = doReturn("数据添加成功","数据添加失败,未知原因，请联系管理员",$status);
			}
			$this->ajaxReturn($msg);
			exit;
		}
		$this->display();
	}

	public function editDomain(){
		if(IS_POST && I("editDomain")){
			$table_Domain = M("Domain");
			if(!$table_Domain->create()){
				$msg = doReturn("","数据创建失败，未知原因，请联系管理员",false);
			} else {
				$status = $table_Domain->save();
				$msg = doReturn("数据编辑成功","数据编辑失败,未知原因，请联系管理员",$status);
			}
			$this->ajaxReturn($msg);
			exit;
		}
		$this->Domain = M("Domain")->find(I('id'));
		$this->display();
	}

	public function delDomain(){
		if(IS_POST && I('id')){
			$status = M("Domain")->delete(I('id'));
			$msg = doReturn("数据成功删除","数据删除失败，请联系管理员",$status);
			$this->ajaxReturn($msg);
			exit;
		}
	}

	/**
	 * [EndDomain 域名管理结束]
	 */

	/**
	 * [DnsDomain 域名解析管理开始]
	 * ======================================================================
	 */
	public function DnsDomain(){
		if(IS_POST){
			//搜索条件组合
			$search = I('search');
			if(trim($search['host_id'],' ') != '' && $search['host_id'] > 0){
				$where['host_id'] = trim($search['host_id'],' ');
			}
			if(trim($search['domain_id'],' ') != '' && $search['domain_id'] > 0){
				$where['domain_id'] = trim($search['domain_id'],' ');
			}
			if(trim($search['host_domain'],' ') != ''){
				$where['host_domain'] = array('like','%'.trim($search['host_domain'],' ').'%');
			}
			//前台排序处理
			if(I("sort") && I("order")){
				$sort_field = explode(",",I("sort"));
				$order_field = explode(",",I("order"));
				foreach($sort_field as $k=>$v){
					$order[] = $v." ".$order_field[$k];
				}
				$order = implode(",",$order);
			} else {
				$order = 'id asc';
			}
			$table_DnsDomain = D("DnsDomainView")->where($where)->order($order)->page(I('page'),I('rows'))->select();

			$data = array(
				"total" => D("DnsDomainView")->where($where)->count(),
				"rows" => $table_DnsDomain
			);
			$this->ajaxReturn($data);
			exit;
		}
		$this->display();
	}

	public function addDnsDomain(){
		if(IS_POST && I("addDnsDomain")){
			if(!I("domain_id",0,'intval') || !I("host_id",0,'intval')){
				$msg = doReturn("","信息数据不正确，请填写正确再提交",false);
				$this->ajaxReturn($msg);
				exit;
			}
			$table_DnsDomain = M("DnsDomain");
			if(!$table_DnsDomain->create()){
				$msg = doReturn("","数据创建失败，未知原因，请联系管理员",false);
			} else {
				S('DnsDomain_domain_id',$table_DnsDomain->domain_id,C("S_TIME"));
				S('DnsDomain_host_id',$table_DnsDomain->host_id,C("S_TIME"));
				$status = $table_DnsDomain->add();
				$msg = doReturn("数据添加成功","数据添加失败,未知原因，请联系管理员",$status);
			}
			$this->ajaxReturn($msg);
			exit;
		}
		$this->display();
	}

	public function editDnsDomain(){
		if(IS_POST && I("editDnsDomain")){
			$table_DnsDomain = M("DnsDomain");
			if(!$table_DnsDomain->create()){
				$msg = doReturn("","数据创建失败，未知原因，请联系管理员",false);
			} else {
				$status = $table_DnsDomain->save();
				$msg = doReturn("数据编辑成功","数据编辑失败,未知原因，请联系管理员",$status);
			}
			$this->ajaxReturn($msg);
			exit;
		}
		$this->DnsDomain = M("DnsDomain")->find(I('id'));
		$this->display();
	}

	public function delDnsDomain(){
		if(IS_POST && I('id')){
			$status = M("DnsDomain")->delete(I('id'));
			$msg = doReturn("数据成功删除","数据删除失败，请联系管理员",$status);
			$this->ajaxReturn($msg);
			exit;
		}
	}

	/**
	 * [EndDnsDomain 域名解析管理结束]
	 */

	/**
	 * [Web 网站管理开始]
	 * ======================================================================
	 */
	public function Web(){
		if(IS_POST){
			//搜索条件组合
			$search = I('search');
			if(trim($search['dns_domain'],' ') != ''){
				$table_DnsDomain = D("DnsDomainView")->field("id,CONCAT(DnsDomain.host_domain,CONCAT('.',Domain.name)) as dns_domain")->where("CONCAT(DnsDomain.host_domain,CONCAT('.',Domain.name)) like '%".trim($search['dns_domain'],' ')."%'")->order("id asc")->select();
				foreach($table_DnsDomain as $k => $v){
					$tmp_array[] = "find_in_set(".$v['id'].",dns_domain_id)";
				}
				$where['_string'] = "(".implode(' or ', $tmp_array).")";
			}
			if(trim($search['title'],' ') != ''){
				$where['title'] = array('like','%'.trim($search['title'],' ').'%');
			}
			if(trim($search['host_id'],' ') != '' && $search['host_id'] > 0){
				$where['host_id'] = trim($search['host_id'],' ');
			}
			if(trim($search['hosp_id'],' ') != '' && $search['hosp_id'] > 0){
				$where['hosp_id'] = trim($search['hosp_id'],' ');
			}
			if(trim($search['web_type_id'],' ') != '' && $search['web_type_id'] > 0){
				$where['web_type_id'] = trim($search['web_type_id'],' ');
			}
			//前台排序处理
			if(I("sort") && I("order")){
				$sort_field = explode(",",I("sort"));
				$order_field = explode(",",I("order"));
				foreach($sort_field as $k=>$v){
					$order[] = $v." ".$order_field[$k];
				}
				$order = implode(",",$order);
			} else {
				$order = 'id asc';
			}
			//获取网站绑定的域名解析记录
			$table_Web = D("WebView")->where($where)->order($order)->page(I('page'),I('rows'))->select();
			foreach($table_Web as $k=>$v){
				$s_where['id'] = array('in',$v['dns_domain_id']);
				$table_DnsDomain = D("DnsDomainView")->where($s_where)->order("id asc")->select();
				$DnsDomain_title = array();
				foreach($table_DnsDomain as $j => $t){
					$DnsDomain_title[] = ($t['host_domain'] == '@' ? '': $t['host_domain'].'.').$t['name'];
				}
				$table_Web[$k]['dns_domain_title'] = implode(",",$DnsDomain_title);
				$table_SqlObject = M("SqlObject")->find($table_Web[$k]['sql_object_id']);
				$table_Web[$k]['sql_object_title'] = $table_SqlObject['sql_object'];
				$table_SqlUser = M("SqlUser")->find($table_Web[$k]['sql_user_id']);
				$table_Web[$k]['sql_user_title'] = $table_SqlUser['sql_user'];
			}
			$data = array(
				"total" => D("WebView")->where($where)->count(),
				"rows" => $table_Web
			);
			$this->ajaxReturn($data);
			exit;
		}
		$this->display();
	}

	public function addWeb(){
		if(IS_POST && I("addWeb")){
			$dns_domain_id = I("dns_domain_id");
			if(is_array($dns_domain_id)){
				foreach($dns_domain_id as $k => $v){
					if(!intval($v)){
						$msg = doReturn("","绑定网址错误，参数不能为字符串",false);
						$this->ajaxReturn($msg);
						exit;
					}
				}
			} else {
				$msg = doReturn("","绑定网址错误",false);
				$this->ajaxReturn($msg);
				exit;
			}
			if(!I("web_type_id",0,'intval') || !I("hosp_id",0,'intval') || !I("host_id",0,'intval') || !I("ftp_id",0,'intval')){
				$msg = doReturn("","信息数据不正确，请填写正确再提交",false);
				$this->ajaxReturn($msg);
				exit;
			}

			$table_Web = M("Web");
			if(!$table_Web->create()){
				$msg = doReturn("","数据创建失败，未知原因，请联系管理员",false);
			} else {
				$table_Web->dns_domain_id = implode(",",I("dns_domain_id"));
				$status = $table_Web->add();
				$msg = doReturn("数据添加成功","数据添加失败,未知原因，请联系管理员",$status);
			}
			$this->ajaxReturn($msg);
			exit;
		}
		$this->display();
	}

	public function editWeb(){
		if(IS_POST && I("editWeb")){
			$table_Web = M("Web");
			if(!$table_Web->create()){
				$msg = doReturn("","数据创建失败，未知原因，请联系管理员",false);
			} else {
				$table_Web->dns_domain_id = implode(",",I("dns_domain_id"));
				$status = $table_Web->save();
				$msg = doReturn("数据编辑成功","数据编辑失败,未知原因，请联系管理员",$status);
			}
			$this->ajaxReturn($msg);
			exit;
		}
		$this->Web = M("Web")->find(I('id'));
		$this->display();
	}

	public function delWeb(){
		if(IS_POST && I('id')){
			$status = M("Web")->delete(I('id'));
			$msg = doReturn("数据成功删除","数据删除失败，请联系管理员",$status);
			$this->ajaxReturn($msg);
			exit;
		}
	}

	/**
	 * [EndWeb 网站管理结束]
	 */
}