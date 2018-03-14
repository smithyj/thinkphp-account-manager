<?php
namespace Oa\Controller;
use Think\Controller;
use Think\Auth;

class IndexController extends IsLoginController {
    public function index(){
        $this->display();
    }
    public function main(){
    	$sess_Uid = session('uid');
    	//过期时间定义
		$expireDate = time()+(60*60*24*C("EXPIRE_DATE"));
		//过期服务器读取处理
		$this->Host = M("Host")->where(array("unix_timestamp(end_date)"=>array("LT",$expireDate)))->order("id desc")->select();
		//过期域名读取处理
		$this->Domain = M("Domain")->where(array("unix_timestamp(end_date)"=>array("LT",$expireDate)))->order("id desc")->select();
    	//加载首页版块
    	$this->update_Info = M("Panel")->find(1);
    	$this->safe_Info = M("Panel")->find(2);
    	$this->system_Info = M("Panel")->find(3);
    	$this->alipay_Info = M("Panel")->find(4);
    	//个人信息版块
    	$this->sess_User = session('user');
    	$table_User = D("User")->relation(true)->find($sess_Uid);
    	foreach($table_User['groups'] as $v){
    		$groups[] = $v['title'];
    	}
    	$this->Groups = implode(',', $groups);
    	$this->last_Login = M("LoginLog")->order("id desc")->where(array('uid'=>$sess_Uid))->find();
    	//近期登录版块
    	$this->lately_Login = M("LoginLog")->order("id desc")->where(array('uid'=>$sess_Uid))->limit(5)->select();
    	$this->display();
    }
    public function getLeftMenu(){
    	$sess_Uid = session('uid');
    	if($sess_Uid == '1'){//区分是否管理员用户
	    	$table_AuthRule = M('AuthRule')->field('id')->select();
			foreach($table_AuthRule as $v){
				$AuthRules[] = $v['id'];
			}
		} else {
			$Auth = new Auth();
			$AuthGroups = $Auth->getGroups($sess_Uid);//获取用户所有组
			foreach($AuthGroups as $v){
				if($v['group_id'] == '1'){//区分是否该角色拥有超级管理员角色
					$AuthRules = array();
					$table_AuthRule = M('AuthRule')->field('id')->select();
					foreach($table_AuthRule as $v){
						$AuthRules[] = $v['id'];
					}
					break;//超级管理员中止循环，具有所有规则权限
				} else {
					$AuthRules[] = $v['rules'];
				}
			}
		}
		$AuthRules = implode(',', $AuthRules);
		$where = array(
			'rule_id'=>I('id','','int'),
			'display'=>1,
			'id'=>array('in',$AuthRules)
		);
		$table_AuthRule = M("AuthRule")->where($where)->order("sort asc")->field("id,title as text,cls")->select();
		foreach($table_AuthRule as $k => $v){
			$where = array(
				'rule_id'=>$v['id'],
				'display'=>1,
				'id'=>array('in',$AuthRules)
			);
			$table_AuthRule_son = M("AuthRule")->where($where)->order("sort asc")->field("id,title as text,cls,name as url")->select();
			foreach($table_AuthRule_son as $k2 => $v2){
				$table_AuthRule_son[$k2]['url'] = __MODULE__."/".$v2['url'];
				$table_AuthRule_son[$k2]['type'] = true;
				$table_AuthRule_son[$k2]['iconCls'] = $v2['cls'];
			}
			$table_AuthRule[$k]['children'] = $table_AuthRule_son;
			$table_AuthRule[$k]['iconCls'] = $v['cls'];
		}

		$this->ajaxReturn($table_AuthRule);
    }
}