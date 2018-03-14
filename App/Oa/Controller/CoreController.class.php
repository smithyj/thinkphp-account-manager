<?php
namespace Oa\Controller;
use Think\Controller;

class CoreController extends AuthController{

	/**
	 * [Setting 系统配置开始]
	 * ======================================================================
	 */
	public function Setting(){
		if(IS_POST){
			$table_Config = D('ConfigView')->select();
			$this->ajaxReturn($table_Config);
			exit;
		}
		$this->display();
	}

	public function editSetting(){
		if(IS_POST){
			$array_Config = I('data');
			if(is_array($array_Config)){
				foreach($array_Config as $k=>$v){
					$status = M("Config")->where(array("key"=>$v['key']))->save(array("value"=>$v['value']));
					if($status === false) {
						$false_key = $v['key'];
						break;
					}
				}
				$msg = doReturn("配置成功更新","配置更新被中止，可能更新错误KEY：$false_key",$status);
			} else {
				$msg = doReturn("","当前配置没有被更改",false);
			}
			$this->ajaxReturn($msg);
		}
	}

	public function writeSetting(){
		if(IS_POST){
			//读取数据库配置
			$config = D("ConfigCate")->relation(true)->select();
			$config_php = "<?php \r\nreturn array(";
			foreach($config as $k=>$v){
				$config_php .= "\r\n\t/*".$v['title']."*/\r\n";
				foreach($v['configs'] as $k2 => $v2){
					//判断是否有引号
					$v2['value'] = htmlspecialchars_decode($v2['value']);
					if(preg_match("/\'/",$v2['value']) || preg_match('/\"/',$v2['value'])){
						$config_php .= "\r\n\t'".$v2['key']."' => ".$v2['value'].",/*".$v2['name']."*/\r\n";
					}
					else{
						$config_php .= "\r\n\t'".$v2['key']."' => '".$v2['value']."',/*".$v2['name']."*/\r\n";
					}
				}
			}
			$config_php .= "\r\n);";
			$status = file_put_contents("./App/Common/Conf/system.config.php",$config_php);
			$msg = doReturn("配置文件成功生成","配置文件生成失败，请联系管理员",$status);
			$this->ajaxReturn($msg);
			exit;
		}
		echo "确定要生成新的配置文件吗？";
	}

	/**
	 * [EndSetting 系统配置结束]
	 */

	/**
	 * [Rule 菜单管理开始]
	 * ======================================================================
	 */
	public function Rule(){
		if(IS_POST){
			$table_AuthRule = M("AuthRule")->field("id,title,name,sort,display,cls,rule_id")->order("sort asc")->select();
			foreach($table_AuthRule as $k => $v)
	        {
	            $table_AuthRule[$k]['iconCls'] = $v['cls'];
	        }
			$data = treeRule($table_AuthRule);
			$this->ajaxReturn($data);
			exit;
		}
		$this->display();
	}

	public function addRule(){
		if(IS_POST && I("addRule")){
			$table_AuthRule = M("AuthRule");
			if(!$table_AuthRule->create()){
				$msg = doReturn("","数据创建失败，未知原因，请联系管理员",false);
			} else {
				$status = $table_AuthRule->add();
				$msg = doReturn("数据添加成功","数据添加失败,未知原因，请联系管理员",$status);
			}
			$this->ajaxReturn($msg);
			exit;
		}
		$this->rule_id = I("rule_id");
		$this->display();
	}

	public function editRule(){
		if(IS_POST && I("editRule")){
			$table_AuthRule = M("AuthRule");
			if(!$table_AuthRule->create()){
				$msg = doReturn("","数据创建失败，未知原因，请联系管理员",false);
			} else {
				$status = $table_AuthRule->save();
				$msg = doReturn("数据编辑成功","数据编辑失败,未知原因，请联系管理员",$status);
			}
			$this->ajaxReturn($msg);
			exit;
		}
		$this->Rule = M("AuthRule")->find(I('id'));
		$this->display();
	}

	public function delRule(){
		if(IS_POST && I('id') <= 100){
			$msg = doReturn("","不允许删除系统内置规则",false);
			$this->ajaxReturn($msg);
			exit;
		}
		if(IS_POST && I('id')){
			$status = M("AuthRule")->delete(I('id'));
			$msg = doReturn("数据成功删除","数据删除失败，请联系管理员",$status);
			$this->ajaxReturn($msg);
			exit;
		}
	}

	public function sortRule(){
		$error_id = "";
		$status = true;
		$sortRule = I("sort");
		foreach($sortRule as $k => $v){
			$data = array(
				"id"=>$k,
				"sort"=>$v
			);
			$status = M("AuthRule")->save($data);
			if ($status === false){
				$error_id = $k;
				break;//当排序失败时，捕获错误ID，结束程序
			}
		}
		if($status !== false){
			$data["status"] = true;
			$data["info"] = "菜单排序成功";
		} else {
			$data["status"] = false;
			$data["info"] = "菜单排序失败<br />发生错误的排序ID：$error_id";
		}
		$this->ajaxReturn($data);
	}

	public function exRule(){
		$type = I('download') ? I('download') : false;
		if($type){
			$table_Rule = M("AuthRule")->select();
			header("Content-type:application/data");
			header("Content-Disposition:attachment;filename='菜单备份.data'");
			exit(base64_encode(serialize($table_Rule)));
		} else {
			$sess_downRule = strtoupper(substr(md5(time().rand(10,10000)),5,10));
			session('downRule',$sess_downRule);
			$data['status'] = true;
			$data['info'] = "菜单导出成功";
			$data['url'] = U("Core/exRule",array("download"=>$sess_downRule));
			$this->ajaxReturn($data);
		}
	}

	public function imRule(){
		if(IS_POST){
			$fileTypes = array('data'); // File extensions
			$fileParts = pathinfo($_FILES['file']['name']);
			if (in_array($fileParts['extension'],$fileTypes)) {
				//获取临时上传文件路径
				$tempFile = $_FILES['file']['tmp_name'];
				$data_Rule = file_get_contents($tempFile);
				$data_Rule = unserialize(base64_decode($data_Rule));
				if(is_array($data_Rule)){
					M("AuthRule")->where("1")->delete();
					$status = M("AuthRule")->addAll($data_Rule);
					if($status > 0){
						$data['status'] = true;
						$data['info'] = '菜单导入成功';
					} else {
						$data['status'] = false;
						$data['info'] = '菜单数据导入失败，请手动恢复你备份的菜单数据';
					}
				} else {
					$data['status'] = false;
					$data['info'] = '非法数据';
				}
				$this->ajaxReturn($data);
			} else {
				echo 'Invalid file type.';
			}
		}
	}

	/**
	 * [EndRule 菜单管理结束]
	 */

	/**
	 * [Group 角色管理开始]
	 */

	public function Group(){
		if(IS_POST){
			$table_AuthGroup = M('AuthGroup')->field("id,title,status,sort,id as opert_id")->order("sort asc")->page(I('page'),I('rows'))->select();
			$data = array(
				"total" => M('AuthGroup')->count(),
				"rows" => $table_AuthGroup
			);
			$this->ajaxReturn($data);
			exit;
		}
		$this->display();
	}

	public function sortGroup(){
		$error_id = "";
		$status = true;
		$sortGroup = I("sort");
		foreach($sortGroup as $k => $v){
			$data = array(
				"id"=>$k,
				"sort"=>$v
			);
			$status = M("AuthGroup")->save($data);
			if ($status === false){
				$error_id = $k;
				break;//当排序失败时，跳出循环
			}
		}
		if($status !== false){
			$data["status"] = true;
			$data["info"] = "角色排序成功";
		} else {
			$data["status"] = false;
			$data["info"] = "角色排序失败<br />发生错误的排序ID：$error_id";
		}
		$this->ajaxReturn($data);
	}

	public function addGroup(){
		if(IS_POST && I('addGroup')){
			$table_AuthGroup = M("AuthGroup");
			if(!$table_AuthGroup->create()){
				$msg = doReturn("","数据创建失败，未知原因，请联系管理员",false);
			} else {
				$status = $table_AuthGroup->add();
				$msg = doReturn("数据添加成功","数据添加失败,未知原因，请联系管理员",$status);
			}
			$this->ajaxReturn($msg);
			exit;
		}
		$this->display();
	}

	public function setGroup(){
		//配置权限操作
		if(IS_POST && I('setGroup') == 'setGroup'){
			$RuleIds = implode(",",array_unique(explode(',',I('setGroupRule'))));
			$data = array(
				'id' => I('id','0','int'),
				'rules' => $RuleIds
			);
			$status = M("AuthGroup")->save($data);
			$msg = doReturn("配置权限成功","配置权限失败,未知原因，请联系管理员",$status);
			$this->ajaxReturn($msg);
			exit;
		}
		//加载角色节点权限数据
		if(IS_POST){
			$table_AuthRule = M("AuthRule")->field("id,title as text,rule_id")->select();
			$table_AuthGroup = M("AuthGroup")->find(I('id'));
			$RuleIds = explode(",",$table_AuthGroup['rules']);
			$data = treeRule($table_AuthRule);
			$data = treeState($data,$RuleIds);
			$this->ajaxReturn($data);
		}
		if(I('id') == '1'){
			echo "不允许对超级管理员配置";
			exit;
		}
		$this->id = I('id');
		$this->display();
	}

	public function editGroup(){
		if(IS_POST && I("editGroup")){
			$table_AuthGroup = M("AuthGroup");
			if(!$table_AuthGroup->create()){
				$msg = doReturn("","数据创建失败，未知原因，请联系管理员",false);
			} else {
				$status = $table_AuthGroup->save();
				$msg = doReturn("数据编辑成功","数据编辑失败,未知原因，请联系管理员",$status);
			}
			$this->ajaxReturn($msg);
			exit;
		}
		if(I('id') == '1'){
			echo "不允许对超级管理员编辑";
			exit;
		}
		$this->Group = M("AuthGroup")->find(I('id'));
		$this->display();
	}

	public function delGroup(){
		if(I('id') == '1'){
			$msg = doReturn("","不允许删除超级管理员",false);
			exit;
		}
		if(IS_POST && I('id')){
			$status = M("AuthGroup")->delete(I('id'));
			$msg = doReturn("数据成功删除","数据删除失败，请联系管理员",$status);
			$this->ajaxReturn($msg);
			exit;
		}
	}

	/**
	 * [EndGroup 菜单管理结束]
	 * ======================================================================
	 */

	/**
	 * [Panel 后台首页版块管理开始]
	 * ======================================================================
	 */

	public function Panel(){
		if(IS_POST){
			$table_Panel = M('Panel')->field("id,title,sort,id as opert_id")->order("sort asc")->page(I('page'),I('rows'))->select();
			$data = array(
				"total" => M('Panel')->count(),
				"rows" => $table_Panel
			);
			$this->ajaxReturn($data);
			exit;
		}
		$this->display();
	}

	public function sortPanel(){
		$error_id = "";
		$status = true;
		$sortPanel = I("sort");
		foreach($sortPanel as $k => $v){
			$data = array(
				"id"=>$k,
				"sort"=>$v
			);
			$status = M("Panel")->save($data);
			if ($status === false){
				$error_id = $k;
				break;//当排序失败时，跳出循环
			}
		}
		if($status !== false){
			$data["status"] = true;
			$data["info"] = "版块排序成功";
		} else {
			$data["status"] = false;
			$data["info"] = "版块排序失败<br />发生错误的排序ID：$error_id";
		}
		$this->ajaxReturn($data);
	}

	public function addPanel(){
		if(IS_POST && I('addPanel')){
			$table_Panel = M("Panel");
			if(!$table_Panel->create()){
				$msg = doReturn("","数据创建失败，未知原因，请联系管理员",false);
			} else {
				$status = $table_Panel->add();
				$msg = doReturn("数据添加成功","数据添加失败,未知原因，请联系管理员",$status);
			}
			$this->ajaxReturn($msg);
			exit;
		}
		$this->display();
	}

	public function editPanel(){
		if(IS_POST && I("editPanel")){
			$table_Panel = M("Panel");
			if(!$table_Panel->create()){
				$msg = doReturn("","数据创建失败，未知原因，请联系管理员",false);
			} else {
				$status = $table_Panel->save();
				$msg = doReturn("数据编辑成功","数据编辑失败,未知原因，请联系管理员",$status);
			}
			$this->ajaxReturn($msg);
			exit;
		}
		$this->Panel = M("Panel")->find(I('id'));
		$this->display();
	}

	public function delPanel(){

		if(IS_POST && I('id')){
			$status = M("Panel")->delete(I('id'));
			$msg = doReturn("数据成功删除","数据删除失败，请联系管理员",$status);
			$this->ajaxReturn($msg);
			exit;
		}
	}

	/**
	 * [EndPanel 后台首页版块管理结束]
	 * ======================================================================
	 */

	/**
	 * [LoginLog 登录日志管理开始]
	 * ======================================================================
	 */
	public function LoginLog(){
		if(IS_POST){
			$search = I('search');
			if(trim($search['name'],' ') != ''){
				$where['User.name'] = trim($search['name'],' ');
			}
			if($search['date_begin'] != '' && $search['date_end'] != ''){
				$where['unix_timestamp(LoginLog.date)'] = array("between",array(strtotime($search['date_begin']),strtotime($search['date_end'])));
			}
			$table_LoginLog = D('LoginLogView')->where($where)->order("LoginLog.id desc")->page(I('page'),I('rows'))->select();
			$data = array(
				"total" => D('LoginLogView')->where($where)->count(),
				"rows" => $table_LoginLog
			);
			$this->ajaxReturn($data);
			exit;
		}
		$this->display();
	}

	public function delLoginLog(){
		if(IS_POST && I("id") == 'lastMonth'){
			$where['unix_timestamp(date)'] = array("between",array(strtotime(date('Y-m-01', strtotime('-1 month'))),strtotime(date('Y-m-t 23:59:59', strtotime('-1 month')))));
			$status = M("LoginLog")->where($where)->delete();
			$msg = doReturn("数据成功删除","数据删除失败，请联系管理员",$status);
			$this->ajaxReturn($msg);
			exit;
		}
	}
	/**
	 * [EndLoginLog 登录日志管理结束]
	 * ======================================================================
	 */

	/**
	 * [BehaviorLog 行为日志管理开始]
	 * ======================================================================
	 */
	public function BehaviorLog(){
		if(IS_POST){
			$search = I('search');
			if(trim($search['name'],' ') != ''){
				$where['User.name'] = trim($search['name'],' ');
			}
			if($search['date_begin'] != '' && $search['date_end'] != ''){
				$where['unix_timestamp(BehaviorLog.date)'] = array("between",array(strtotime($search['date_begin']),strtotime($search['date_end'])));
			}
			$table_BehaviorLog = D('BehaviorLogView')->where($where)->order("BehaviorLog.id desc")->page(I('page'),I('rows'))->select();
			$data = array(
				"total" => D('BehaviorLogView')->where($where)->count(),
				"rows" => $table_BehaviorLog
			);
			$this->ajaxReturn($data);
			exit;
		}
		$this->display();
	}

	public function delBehaviorLog(){
		if(IS_POST && I("id") == 'lastMonth'){
			$where['unix_timestamp(date)'] = array("between",array(strtotime(date('Y-m-01', strtotime('-1 month'))),strtotime(date('Y-m-t 23:59:59', strtotime('-1 month')))));
			$status = M("BehaviorLog")->where($where)->delete();
			$msg = doReturn("数据成功删除","数据删除失败，请联系管理员",$status);
			$this->ajaxReturn($msg);
			exit;
		}
	}
	/**
	 * [EndBehaviorLog 行为日志管理结束]
	 * ======================================================================
	 */

	/**
	 * [Branch 部门管理开始]
	 * ======================================================================
	 */
	public function Branch(){
		if(IS_POST){
			$table_Branch = M("Branch")->field("id,title,sort,branch_id")->order("sort asc")->select();
			$data = treeBranch($table_Branch);
			$this->ajaxReturn($data);
			exit;
		}
		$this->display();
	}

	public function addBranch(){
		if(IS_POST && I("addBranch")){
			$table_Branch = M("Branch");
			if(!$table_Branch->create()){
				$msg = doReturn("","数据创建失败，未知原因，请联系管理员",false);
			} else {
				$status = $table_Branch->add();
				$msg = doReturn("数据添加成功","数据添加失败,未知原因，请联系管理员",$status);
			}
			$this->ajaxReturn($msg);
			exit;
		}
		$this->branch_id = I("branch_id");
		$this->display();
	}

	public function editBranch(){
		if(IS_POST && I("editBranch")){
			$table_Branch = M("Branch");
			if(!$table_Branch->create()){
				$msg = doReturn("","数据创建失败，未知原因，请联系管理员",false);
			} else {
				$status = $table_Branch->save();
				$msg = doReturn("数据编辑成功","数据编辑失败,未知原因，请联系管理员",$status);
			}
			$this->ajaxReturn($msg);
			exit;
		}
		$this->Branch = M("Branch")->find(I('id'));
		$this->display();
	}

	public function delBranch(){
		if(IS_POST && I('id')){
			$status = M("Branch")->delete(I('id'));
			$msg = doReturn("数据成功删除","数据删除失败，请联系管理员",$status);
			$this->ajaxReturn($msg);
			exit;
		}
	}

	public function sortBranch(){
		$error_id = "";
		$status = true;
		$sortBranch = I("sort");
		foreach($sortBranch as $k => $v){
			$data = array(
				"id"=>$k,
				"sort"=>$v
			);
			$status = M("Branch")->save($data);
			if ($status === false){
				$error_id = $k;
				break;//当排序失败时，捕获错误ID，结束程序
			}
		}
		if($status !== false){
			$data["status"] = true;
			$data["info"] = "部门排序成功";
		} else {
			$data["status"] = false;
			$data["info"] = "部门排序失败<br />发生错误的排序ID：$error_id";
		}
		$this->ajaxReturn($data);
	}

	/**
	 * [EndBranch 部门管理结束]
	 */

	/**
	 * [Hosp 医院管理开始]
	 * ======================================================================
	 */
	public function Hosp(){
		if(IS_POST){
			$table_Hosp = M("Hosp")->field("id,title,sort,status,desc")->order("sort asc")->page(I('page'),I('rows'))->select();
			$data = array(
				"total" => M("Hosp")->count(),
				"rows" => $table_Hosp
			);
			$this->ajaxReturn($data);
			exit;
		}
		$this->display();
	}

	public function addHosp(){
		if(IS_POST && I("addHosp")){
			$table_Hosp = M("Hosp");
			if(!$table_Hosp->create()){
				$msg = doReturn("","数据创建失败，未知原因，请联系管理员",false);
			} else {
				$status = $table_Hosp->add();
				$msg = doReturn("数据添加成功","数据添加失败,未知原因，请联系管理员",$status);
			}
			$this->ajaxReturn($msg);
			exit;
		}
		$this->display();
	}

	public function editHosp(){
		if(IS_POST && I("editHosp")){
			$table_Hosp = M("Hosp");
			if(!$table_Hosp->create()){
				$msg = doReturn("","数据创建失败，未知原因，请联系管理员",false);
			} else {
				$status = $table_Hosp->save();
				$msg = doReturn("数据编辑成功","数据编辑失败,未知原因，请联系管理员",$status);
			}
			$this->ajaxReturn($msg);
			exit;
		}
		$this->Hosp = M("Hosp")->find(I('id'));
		$this->display();
	}

	public function delHosp(){
		if(IS_POST && I('id')){
			$status = M("Hosp")->delete(I('id'));
			$msg = doReturn("数据成功删除","数据删除失败，请联系管理员",$status);
			$this->ajaxReturn($msg);
			exit;
		}
	}

	public function sortHosp(){
		$error_id = "";
		$status = true;
		$sortHosp = I("sort");
		foreach($sortHosp as $k => $v){
			$data = array(
				"id"=>$k,
				"sort"=>$v
			);
			$status = M("Hosp")->save($data);
			if ($status === false){
				$error_id = $k;
				break;//当排序失败时，捕获错误ID，结束程序
			}
		}
		if($status !== false){
			$data["status"] = true;
			$data["info"] = "医院排序成功";
		} else {
			$data["status"] = false;
			$data["info"] = "医院排序失败<br />发生错误的排序ID：$error_id";
		}
		$this->ajaxReturn($data);
	}

	/**
	 * [EndHosp 医院管理结束]
	 */

	/**
	 * [Disease 疾病管理开始]
	 * ======================================================================
	 */
	public function Disease(){
		if(IS_POST){
			$search = I('search');
			if(trim($search['hosp_id'],' ') != '' && $search['hosp_id'] > 0){
				$where['Disease.hosp_id'] = trim($search['hosp_id'],' ');
			}
			$table_Disease = D("DiseaseView")->where($where)->order("id asc")->page(I('page'),I('rows'))->select();
			$data = array(
				"total" => D("DiseaseView")->where($where)->count(),
				"rows" => $table_Disease
			);
			$this->ajaxReturn($data);
			exit;
		}
		$this->display();
	}

	public function addDisease(){
		if(IS_POST && I("addDisease")){
			$table_Disease = M("Disease");
			if(!$table_Disease->create()){
				$msg = doReturn("","数据创建失败，未知原因，请联系管理员",false);
			} else {
				$status = $table_Disease->add();
				$msg = doReturn("数据添加成功","数据添加失败,未知原因，请联系管理员",$status);
			}
			$this->ajaxReturn($msg);
			exit;
		}
		$this->display();
	}

	public function editDisease(){
		if(IS_POST && I("editDisease")){
			$table_Disease = M("Disease");
			if(!$table_Disease->create()){
				$msg = doReturn("","数据创建失败，未知原因，请联系管理员",false);
			} else {
				$status = $table_Disease->save();
				$msg = doReturn("数据编辑成功","数据编辑失败,未知原因，请联系管理员",$status);
			}
			$this->ajaxReturn($msg);
			exit;
		}
		$this->Disease = M("Disease")->find(I('id'));
		$this->display();
	}

	public function delDisease(){
		if(IS_POST && I('id')){
			$status = M("Disease")->delete(I('id'));
			$msg = doReturn("数据成功删除","数据删除失败，请联系管理员",$status);
			$this->ajaxReturn($msg);
			exit;
		}
	}

	/**
	 * [EndDisease 疾病管理结束]
	 */

	/**
	 * [Doctor 医生管理开始]
	 * ======================================================================
	 */
	public function Doctor(){
		if(IS_POST){
			$search = I('search');
			if(trim($search['hosp_id'],' ') != '' && $search['hosp_id'] > 0){
				$where['Doctor.hosp_id'] = trim($search['hosp_id'],' ');
			}
			$table_Doctor = D("DoctorView")->where($where)->order("id asc")->page(I('page'),I('rows'))->select();
			$data = array(
				"total" => D("DiseaseView")->where($where)->count(),
				"rows" => $table_Doctor
			);
			$this->ajaxReturn($data);
			exit;
		}
		$this->display();
	}

	public function addDoctor(){
		if(IS_POST && I("addDoctor")){
			$table_Doctor = M("Doctor");
			if(!$table_Doctor->create()){
				$msg = doReturn("","数据创建失败，未知原因，请联系管理员",false);
			} else {
				$status = $table_Doctor->add();
				$msg = doReturn("数据添加成功","数据添加失败,未知原因，请联系管理员",$status);
			}
			$this->ajaxReturn($msg);
			exit;
		}
		$this->display();
	}

	public function editDoctor(){
		if(IS_POST && I("editDoctor")){
			$table_Doctor = M("Doctor");
			if(!$table_Doctor->create()){
				$msg = doReturn("","数据创建失败，未知原因，请联系管理员",false);
			} else {
				$status = $table_Doctor->save();
				$msg = doReturn("数据编辑成功","数据编辑失败,未知原因，请联系管理员",$status);
			}
			$this->ajaxReturn($msg);
			exit;
		}
		$this->Doctor = M("Doctor")->find(I('id'));
		$this->display();
	}

	public function delDoctor(){
		if(IS_POST && I('id')){
			$status = M("Doctor")->delete(I('id'));
			$msg = doReturn("数据成功删除","数据删除失败，请联系管理员",$status);
			$this->ajaxReturn($msg);
			exit;
		}
	}

	/**
	 * [EndDoctor 医生管理结束]
	 */

	/**
	 * [Job 职务管理开始]
	 * ======================================================================
	 */
	public function Job(){
		if(IS_POST){
			$table_Job = M("Job")->order("sort asc")->page(I('page'),I('rows'))->select();
			$data = array(
				"total" => M("Job")->count(),
				"rows" => $table_Job
			);
			$this->ajaxReturn($data);
			exit;
		}
		$this->display();
	}

	public function sortJob(){
		$error_id = "";
		$status = true;
		$sortJob = I("sort");
		foreach($sortJob as $k => $v){
			$data = array(
				"id"=>$k,
				"sort"=>$v
			);
			$status = M("Job")->save($data);
			if ($status === false){
				$error_id = $k;
				break;//当排序失败时，跳出循环
			}
		}
		if($status !== false){
			$data["status"] = true;
			$data["info"] = "职务排序成功";
		} else {
			$data["status"] = false;
			$data["info"] = "职务排序失败<br />发生错误的排序ID：$error_id";
		}
		$this->ajaxReturn($data);
	}

	public function addJob(){
		if(IS_POST && I("addJob")){
			$table_Job = M("Job");
			if(!$table_Job->create()){
				$msg = doReturn("",$table_Job->getError(),false);
			} else {
				$status = $table_Job->add();
				$msg = doReturn("数据添加成功","数据添加失败,未知原因，请联系管理员",$status);
			}
			$this->ajaxReturn($msg);
			exit;
		}
		$this->display();
	}

	public function editJob(){
		if(IS_POST && I("editJob")){
			$table_Job = M("Job");
			if(!$table_Job->create()){
				$msg = doReturn("",$table_Job->getError(),false);
			} else {
				$status = $table_Job->save();
				$msg = doReturn("数据编辑成功","数据编辑失败,未知原因，请联系管理员",$status);
			}
			$this->ajaxReturn($msg);
			exit;
		}
		if(I('id') == '1'){
			echo "不允许对超级管理员编辑";
			exit;
		}
		$this->Job = M("Job")->find(I('id'));
		$this->display();
	}

	public function delJob(){
		if(IS_POST && I('id')){
			if(I('id') == '1'){
				$msg = doReturn("","不允许删除超级管理员",false);
				exit;
			}
			$status = M("Job")->delete(I('id'));
			$msg = doReturn("数据成功删除","数据删除失败，请联系管理员",$status);
			$this->ajaxReturn($msg);
			exit;
		}
	}

	/**
	 * [EndJob 职务管理结束]
	 */

	/**
	 * [User 用户管理开始]
	 * ======================================================================
	 */
	public function User(){
		if(IS_POST){
			//搜索开始
			$search = I('search');
			//搜索医院对应用户
			if(trim($search['hosp_id'],' ') != '' && $search['hosp_id'] > 0){
				$table_Hosp = M("UserHosp")->where(array("hosp_id"=>$search['hosp_id']))->select();
				foreach($table_Hosp as $k => $v){
					$Hosp_Ids[] = $v['uid'];
				}
				$where['uid'] = array("in",$Hosp_Ids);
			}
			//搜索部门对应用户
			if(trim($search['branch_id'],' ') != '' && $search['branch_id'] > 0){
				$where['branch_id'] = trim($search['branch_id'],' ');
			}
			//搜索角色对应用户
			if(trim($search['group_id'],' ') != '' && $search['group_id'] > 0){
				$table_Group = M("AuthGroupAccess")->where(array("group_id"=>$search['group_id']))->select();
				foreach($table_Group as $k => $v){
					$Group_Ids[] = $v['uid'];
				}
				$where['uid'] = array("in",$Group_Ids);
			}
			//搜索对应用户名称
			if(trim($search['name'],' ') != ''){
				$where['_string'] = '(name like "%'.trim($search['name'],' ').'%")  OR ( title like "%'.trim($search['name'],' ').'%")';
			}
			$table_User = D("User")->field('pass',true)->relation(true)->where($where)->order("uid asc")->page(I('page'),I('rows'))->select();
			$data = array(
				"total" => D("User")->where($where)->count(),
				"rows" => $table_User
			);
			$this->ajaxReturn($data);
			exit;
		}
		$this->display();
	}

	public function addUser(){
		if(IS_POST && I("addUser")){
			//当密码都不为空，且不相等时进行验证判断
			if((I('pass') != '' && I('pass2') != '') && I('pass') != I('pass2')){
				$msg = doReturn("","两次密码不相等",$status);
				$this->ajaxReturn($msg);
			}
			$table_User = D("User");
			if(!$table_User->create()){
				$msg = doReturn("",$table_User->getError(),false);
			} else {
				$table_User->hosps = I('hosps');
				$table_User->groups = I('groups');
				$table_User->create_date = '0000-00-00 00:00:00';
				$status = $table_User->relation(true)->add();
				$msg = doReturn("数据添加成功","数据添加失败,未知原因，请联系管理员",$status);
			}
			$this->ajaxReturn($msg);
			exit;
		}
		$this->display();
	}

	public function editUser(){
		if(I('id') == '1'){
			echo "不允许对超级管理员进行修改";
			exit;
		}
		if(IS_POST && I("editUser")){
			//当密码都不为空，且不相等时进行验证判断
			if((I('pass') != '' && I('pass2') != '') && I('pass') != I('pass2')){
				$msg = doReturn("","两次密码不相等",$status);
				$this->ajaxReturn($msg);
			}
			$table_User = D("User");
			if(!$table_User->create()){
				$msg = doReturn("","数据创建失败，未知原因，请联系管理员",false);
			} else {
				if(I('pass') == '' || I('pass2') == ''){//当没有修改密码时
					unset($table_User->pass);
				}
				$table_User->hosps = I('hosps');
				$table_User->groups = I('groups');
				$status = $table_User->relation(true)->save();
				$msg = doReturn("数据编辑成功","数据编辑失败,未知原因，请联系管理员",$status);
			}
			$this->ajaxReturn($msg);
			exit;
		}
		$User = D("User")->relation(true)->find(I('id'));
		//组合用户拥有的医院
		foreach($User['hosps'] as $v){
			$tmp_HospIds[] = $v['id'];
		}
		$User['hosps'] = implode(',',$tmp_HospIds);
		//组合用户拥有的角色
		foreach($User['groups'] as $v){
			$tmp_GroupIds[] = $v['id'];
		}
		$User['groups'] = implode(',',$tmp_GroupIds);
		$this->User = $User;
		$this->display();
	}

	public function delUser(){
		if(I('id') == '1'){
			$msg = doReturn("","不允许删除超级管理员",false);
			$this->ajaxReturn($msg);
			exit;
		}
		if(IS_POST && I('id')){
			$status = D("User")->relation(true)->delete(I('id'));
			$msg = doReturn("数据成功删除","数据删除失败，请联系管理员",$status);
			$this->ajaxReturn($msg);
			exit;
		}
	}

	public function resetUserPass(){
		if(IS_POST && I("id")){
			$pass_text = str_split("abcdefghijklmnopqrstuvwxyz1234567890");
			foreach($pass_text as $k=>$v){
				if($k < 6){
					$pass_rand[] = rand(0,count($pass_text)-1);
				} else {
					break;
				}
			}
			foreach($pass_rand as $v){
				$UserPass[] = $pass_text[$v];
			}
			$data['pass'] = md5(implode('',$UserPass));
			$data['uid'] = I('id');
			$status = M("User")->save($data);
			$msg = doReturn("密码修改成功，请牢记新的登录密码：".implode('',$UserPass),"密码修改失败，请联系管理员",$status);
			$this->ajaxReturn($msg);
		}
	}

	/**
	 * [EndUser 用户管理结束]
	 */


	public function Db(){
		$tables = M()->query("SHOW TABLES");
		if(IS_POST){
			$db_Info = M()->query("SHOW TABLE STATUS FROM ".C("DB_NAME"));
			$this->ajaxReturn($db_Info);
		}
		$this->display();
	}

	public function seoDb(){
		//设置程序不超时
		set_time_limit(0);
		//单个表进行优化
		if(IS_POST && I("type") == 'one'){
			$status = M()->query("OPTIMIZE TABLE ".I("table"));
			$msg = doReturn("成功优化 ".I("table")." 表","优化表 ".I('table')."",$status);
			$this->ajaxReturn($msg);
		}
		//所有表进行优化
		else if(IS_POST && I("type") == 'all'){
			$tables = M()->query("SHOW TABLES");
			$table_status = true;
			foreach($tables as $k=>$v){
				$status = M()->query("OPTIMIZE TABLE ".$v['tables_in_'.C("DB_NAME")]);
				if($status === false){
					$error_table = $v['tables_in_'.C("DB_NAME")];
					$table_status = false;
					break;
				}
			}
			//捕获执行不成功表名输出前台
			if($table_status === false){
				$msg = doReturn('','优化表失败，断点表：'.$error_table,false);
				$this->ajaxReturn($msg);
			}
			$msg = doReturn("成功优化所有表");
			$this->ajaxReturn($msg);
		}
	}

	public function repairDb(){
		//设置程序不超时
		set_time_limit(0);
		//单个表进行修复
		if(IS_POST && I("type") == 'one'){
			$status = M()->query("REPAIR TABLE ".I("table"));
			$msg = doReturn("成功修复 ".I("table")." 表","修复表 ".I('table')."",$status);
			$this->ajaxReturn($msg);
		}
		//所有表进行修复
		else if(IS_POST && I("type") == 'all'){
			$tables = M()->query("SHOW TABLES");
			$table_status = true;
			foreach($tables as $k=>$v){
				$status = M()->query("REPAIR TABLE ".$v['tables_in_'.C("DB_NAME")]);
				if($status === false){
					$error_table = $v['tables_in_'.C("DB_NAME")];
					$table_status = false;
					break;
				}
			}
			//捕获执行不成功表名输出前台
			if($table_status === false){
				$msg = doReturn('','修复表失败，断点表：'.$error_table,false);
				$this->ajaxReturn($msg);
			}
			$msg = doReturn("成功修复所有表");
			$this->ajaxReturn($msg);
		}
	}

}