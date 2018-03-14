/*
SQLyog Ultimate v11.24 (32 bit)
MySQL - 5.6.21 : Database - oa0796zcom
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `oa_auth_group` */

DROP TABLE IF EXISTS `oa_auth_group`;

CREATE TABLE `oa_auth_group` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '角色id',
  `title` char(100) NOT NULL DEFAULT '' COMMENT '名称',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态 0，关闭，1正常',
  `rules` text COMMENT '规则id',
  `sort` int(3) unsigned NOT NULL DEFAULT '50' COMMENT '排序id',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `oa_auth_group` */

insert  into `oa_auth_group`(`id`,`title`,`status`,`rules`,`sort`) values (1,'超级管理员',1,'',1),(2,'普通管理员',1,'1,4,5,6,7,2,8,9,10,11,12,13,14,15,16,17,18,52,56,57,58,59,62,63,64,65,66,67,19,20,21,22,23,24,25,26,27,28,29,30,47,48,49,50,51,68,70,69,71,72,31,37,38,39,40,41,32,33,34,35,36,42,43,44,45,46,53,54,60,55,61,3',2),(3,'测试管理员',1,'1,4,5,6,7,9,73,8,2,12,74,52,75,62,67,20,76,19,25,77,47,78,68,79,37,81,31,32,80,42,82,54,83,53,55,84',3);

/*Table structure for table `oa_auth_group_access` */

DROP TABLE IF EXISTS `oa_auth_group_access`;

CREATE TABLE `oa_auth_group_access` (
  `uid` mediumint(8) unsigned NOT NULL COMMENT '用户id',
  `group_id` mediumint(8) unsigned NOT NULL COMMENT '角色id',
  UNIQUE KEY `uid_group_id` (`uid`,`group_id`),
  KEY `uid` (`uid`),
  KEY `group_id` (`group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `oa_auth_group_access` */

insert  into `oa_auth_group_access`(`uid`,`group_id`) values (1,1),(2,3),(3,1);

/*Table structure for table `oa_auth_rule` */

DROP TABLE IF EXISTS `oa_auth_rule`;

CREATE TABLE `oa_auth_rule` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '规则ID',
  `name` char(80) NOT NULL DEFAULT '' COMMENT '路径',
  `title` char(20) NOT NULL DEFAULT '' COMMENT '名称',
  `type` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '类型：1，url  2，菜单',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '状态，0，关闭，1开启',
  `condition` char(100) NOT NULL DEFAULT '' COMMENT '条件',
  `sort` int(3) unsigned NOT NULL DEFAULT '50' COMMENT '排序',
  `display` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '显示：0，隐藏，1，显示',
  `rule_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '上级：0，顶级规则',
  `cls` varchar(50) NOT NULL COMMENT '样式',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=126 DEFAULT CHARSET=utf8;

/*Data for the table `oa_auth_rule` */

insert  into `oa_auth_rule`(`id`,`name`,`title`,`type`,`status`,`condition`,`sort`,`display`,`rule_id`,`cls`) values (1,'Person','个人中心',1,1,'',1,1,0,'icons-folder-folder'),(2,'Core','系统中心',1,1,'',2,1,0,'icons-folder-folder'),(3,'App','应用中心',1,1,'',3,1,0,'icons-other-cog'),(5,'Person/MyProfiles','我的资料',1,1,'',1,1,4,'icons-group-group_gear'),(4,'Person/UserOp','用户操作',1,1,'',1,1,1,'icons-group-group_gear'),(6,'Person/LoginLog','登录日志',1,1,'',2,1,4,'icons-page-page_white_text'),(7,'Person/EditPass','密码修改',1,1,'',3,1,4,'icons-lock-lock_edit'),(8,'Core/CoreSet','后台设置',1,1,'',1,1,2,'icons-other-color_wheel'),(9,'Core/Setting','系统配置',1,1,'',1,1,8,'icons-other-cog'),(10,'Core/editSetting','更新配置',1,1,'',2,1,9,'icons-other-cog_edit'),(11,'Core/writeSetting','写入配置',1,1,'',3,1,9,'icons-other-cog_go'),(12,'Core/Rule','菜单管理',1,1,'',2,1,8,'icons-tag-tag_blue'),(13,'Core/addRule','添加菜单',1,1,'',1,1,12,'icons-tag-tag_blue_add'),(14,'Core/editRule','编辑菜单',1,1,'',3,1,12,'icons-tag-tag_blue_edit'),(15,'Core/delRule','删除菜单',1,1,'',4,1,12,'icons-tag-tag_blue_delete'),(16,'Core/imRule','导入菜单',1,1,'',5,1,12,'icons-other-cog'),(17,'Core/exRule','导出菜单',1,1,'',6,1,12,'icons-other-cog'),(18,'Core/sortRule','菜单排序',1,1,'',7,1,12,'icons-other-cog'),(19,'Core/UserSet','用户设置',1,1,'',2,1,2,'icons-other-cog'),(20,'Core/User','用户管理',1,1,'',1,1,19,'icons-other-cog'),(21,'Core/addUser','添加用户',1,1,'',2,1,20,'icons-other-cog'),(22,'Core/editUser','编辑用户',1,1,'',3,1,20,'icons-other-cog'),(23,'Core/delUser','删除用户',1,1,'',4,1,20,'icons-other-cog'),(24,'Core/resetUserPass','重置密码',1,1,'',5,1,20,'icons-other-cog'),(37,'Core/Disease','疾病管理',1,1,'',2,1,31,'icons-other-cog'),(25,'Core/Group','角色管理',1,1,'',2,1,19,'icons-other-cog'),(26,'Core/addGroup','添加角色',1,1,'',2,1,25,'icons-other-cog'),(27,'Core/editGroup','编辑角色',1,1,'',3,1,25,'icons-other-cog'),(28,'Core/delGroup','删除角色',1,1,'',4,1,25,'icons-other-cog'),(29,'Core/setGroup','角色权限配置',1,1,'',5,1,25,'icons-other-cog'),(30,'Core/sortGroup','角色排序',1,1,'',6,1,25,'icons-other-cog'),(31,'Core/HospSet','医院设置',1,1,'',3,1,2,'icons-other-cog'),(32,'Core/Hosp','医院管理',1,1,'',1,1,31,'icons-other-cog'),(33,'Core/addHosp','添加医院',1,1,'',2,1,32,'icons-other-cog'),(34,'Core/editHosp','编辑医院',1,1,'',3,1,32,'icons-other-cog'),(35,'Core/delHosp','删除医院',1,1,'',4,1,32,'icons-other-cog'),(36,'Core/sortHosp','医院排序',1,1,'',5,1,32,'icons-other-cog'),(38,'Core/addDisease','添加疾病',1,1,'',2,1,37,'icons-other-cog'),(39,'Core/editDisease','编辑疾病',1,1,'',3,1,37,'icons-other-cog'),(40,'Core/delDisease','删除疾病',1,1,'',4,1,37,'icons-other-cog'),(41,'Core/sortDisease','疾病排序',1,1,'',5,1,37,'icons-other-cog'),(42,'Core/Doctor','医生管理',1,1,'',3,1,31,'icons-other-cog'),(43,'Core/addDoctor','添加医生',1,1,'',2,1,42,'icons-other-cog'),(44,'Core/editDoctor','编辑医生',1,1,'',3,1,42,'icons-other-cog'),(45,'Core/delDoctor','删除医生',1,1,'',4,1,42,'icons-other-cog'),(46,'Core/sortDoctor','医生排序',1,1,'',5,1,42,'icons-other-cog'),(70,'Core/editJob','编辑职务',1,1,'',3,1,68,'icons-other-cog'),(69,'Core/addJob','添加职务',1,1,'',2,1,68,'icons-other-cog'),(47,'Core/Branch','部门管理',1,1,'',3,1,19,'icons-other-cog'),(48,'Core/addBranch','添加部门',1,1,'',2,1,47,'icons-other-cog'),(49,'Core/editBranch','编辑部门',1,1,'',3,1,47,'icons-other-cog'),(50,'Core/delBranch','删除部门',1,1,'',4,1,47,'icons-other-cog'),(51,'Core/sortBranch','部门排序',1,1,'',5,1,47,'icons-other-cog'),(52,'Core/Panel','版块管理',1,1,'',3,1,8,'icons-application-application'),(53,'Core/LogSet','日志设置',1,1,'',4,1,2,'icons-other-cog'),(54,'Core/LoginLog','登录日志管理',1,1,'',1,1,53,'icons-other-cog'),(55,'Core/BehaviorLog','行为日志管理',1,1,'',2,1,53,'icons-other-cog'),(56,'Core/addPanel','添加版块',1,1,'',2,1,52,'icons-application-application_add'),(57,'Core/editPanel','编辑版块',1,1,'',3,1,52,'icons-application-application_edit'),(58,'Core/delPanel','删除版块',1,1,'',4,1,52,'icons-application-application_delete'),(59,'Core/sorPanel','版块排序',1,1,'',5,1,52,'icons-arrow-arrow_merge'),(71,'Core/sortJob','职务排序',1,1,'',4,1,68,'icons-other-cog'),(60,'Core/delLoginLog','删除登录日志',1,1,'',2,1,54,'icons-other-cog'),(68,'Core/Job','职务管理',1,1,'',4,1,19,'icons-other-cog'),(61,'Core/delBehaviorLog','删除行为日志',1,1,'',2,1,55,'icons-other-cog'),(62,'Core/Db','数据管理',1,1,'',4,1,8,'icons-other-cog'),(63,'Core/backDb','备份数据',1,1,'',2,1,62,'icons-other-cog'),(64,'Core/restDb','还原数据',1,1,'',3,1,62,'icons-other-cog'),(65,'Core/seoDb','优化数据',1,1,'',4,1,62,'icons-other-cog'),(66,'Core/repairDb','修复数据',1,1,'',5,1,62,'icons-other-cog'),(67,'Core/showDb','查看数据',1,1,'',1,1,62,'icons-other-cog'),(72,'Core/delJob','删除职务',1,1,'',5,1,68,'icons-other-cog'),(73,'Core/showSetting','查看配置',1,1,'',1,1,9,'icons-other-cog_error'),(74,'Core/showRule','查看菜单',1,1,'',2,1,12,'icons-tag-tag_blue'),(75,'Core/showPanel','查看版块',1,1,'',1,1,52,'icons-other-cog'),(76,'Core/showUser','查看用户',1,1,'',1,1,20,'icons-other-cog'),(77,'Core/showGroup','查看角色',1,1,'',1,1,25,'icons-other-cog'),(78,'Core/showBranch','查看部门',1,1,'',1,1,47,'icons-other-cog'),(79,'Core/showJob','查看职务',1,1,'',1,1,68,'icons-other-cog'),(80,'Core/showHosp','查看医院',1,1,'',1,1,32,'icons-other-cog'),(81,'Core/showDisease','查看疾病',1,1,'',1,1,37,'icons-other-cog'),(82,'Core/showDoctor','查看医生',1,1,'',1,1,42,'icons-other-cog'),(83,'Core/showLoginLog','查看登录日志',1,1,'',1,1,54,'icons-other-cog'),(84,'Core/showBehaviorLog','查看行为日志',1,1,'',1,1,55,'icons-other-cog'),(85,'Account','网站关系系统',1,1,'',1,1,3,'icons-other-cog'),(86,'Account/Service','服务商管理',1,1,'',1,1,85,'icons-other-cog'),(91,'Account/Domain','域名管理',1,1,'',6,1,85,'icons-other-cog'),(87,'Account/Host','服务器管理',1,1,'',2,1,85,'icons-other-cog'),(88,'Account/Ftp','FTP管理',1,1,'',3,1,85,'icons-other-cog'),(89,'Account/SqlUser','数据库用户管理',1,1,'',4,1,85,'icons-other-cog'),(90,'Account/SqlObject','数据库对象管理',1,1,'',5,1,85,'icons-other-cog'),(92,'Account/DnsDomain','域名解析管理',1,1,'',7,1,85,'icons-other-cog'),(93,'Account/Web','网站管理',1,1,'',8,1,85,'icons-other-cog'),(94,'Account/addService','添加服务商',1,1,'',2,1,86,'icons-other-cog'),(95,'Account/editService','编辑服务商',1,1,'',3,1,86,'icons-other-cog'),(96,'Account/delService','删除服务商',1,1,'',4,1,86,'icons-other-cog'),(97,'Account/showService','查看服务商',1,1,'',1,1,86,'icons-other-cog'),(98,'Account/showHost','查看服务器',1,1,'',1,1,87,'icons-other-cog'),(99,'Account/addHost','添加服务器',1,1,'',2,1,87,'icons-other-cog'),(100,'Account/editHost','编辑服务器',1,1,'',3,1,87,'icons-other-cog'),(101,'Account/delHost','删除服务器',1,1,'',4,1,87,'icons-other-cog'),(102,'Account/showFtp','查看FTP',1,1,'',1,1,88,'icons-other-cog'),(103,'Account/addFtp','添加FTP',1,1,'',2,1,88,'icons-other-cog'),(104,'Account/editFtp','编辑FTP',1,1,'',3,1,88,'icons-other-cog'),(105,'Account/delFtp','删除FTP',1,1,'',4,1,88,'icons-other-cog'),(106,'Account/showSqlUser','查看数据库用户',1,1,'',1,1,89,'icons-other-cog'),(107,'Account/addSqlUser','添加数据库用户',1,1,'',2,1,89,'icons-other-cog'),(108,'Account/editSqlUser','编辑数据库用户',1,1,'',3,1,89,'icons-other-cog'),(109,'Account/delSqlUser','删除数据库用户',1,1,'',4,1,89,'icons-other-cog'),(110,'Account/showSqlObject','查看数据库对象',1,1,'',1,1,90,'icons-other-cog'),(111,'Account/addSqlObject','添加数据库对象',1,1,'',2,1,90,'icons-other-cog'),(112,'Account/editSqlObject','编辑数据库对象',1,1,'',3,1,90,'icons-other-cog'),(113,'Account/delSqlObject','删除数据库对象',1,1,'',4,1,90,'icons-other-cog'),(114,'Account/showDomain','查看域名',1,1,'',1,1,91,'icons-other-cog'),(115,'Account/addDomain','添加域名',1,1,'',2,1,91,'icons-other-cog'),(116,'Account/editDomain','编辑域名',1,1,'',3,1,91,'icons-other-cog'),(117,'Account/delDomain','删除域名',1,1,'',4,1,91,'icons-other-cog'),(118,'Account/showDnsDomain','查看域名解析',1,1,'',1,1,92,'icons-other-cog'),(119,'Account/addDnsDomain','添加域名解析',1,1,'',2,1,92,'icons-other-cog'),(120,'Account/editDnsDomain','编辑域名解析',1,1,'',3,1,92,'icons-other-cog'),(121,'Account/delDnsDomain','删除域名解析',1,1,'',4,1,92,'icons-other-cog'),(122,'Account/showWeb','查看网站',1,1,'',1,1,93,'icons-other-cog'),(123,'Account/addWeb','添加网站',1,1,'',2,1,93,'icons-other-cog'),(124,'Account/editWeb','编辑网站',1,1,'',3,1,93,'icons-other-cog'),(125,'Account/delWeb','删除网站',1,1,'',4,1,93,'icons-other-cog');

/*Table structure for table `oa_behavior_log` */

DROP TABLE IF EXISTS `oa_behavior_log`;

CREATE TABLE `oa_behavior_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户行为日志id',
  `uid` int(10) unsigned NOT NULL COMMENT '用户id',
  `ip` varchar(250) NOT NULL COMMENT '用户行为ip',
  `date` datetime NOT NULL COMMENT '用户行为时间',
  `area` varchar(250) NOT NULL COMMENT '用户行为网络',
  `country` varchar(250) NOT NULL COMMENT '用户行为地区',
  `user_agent` text NOT NULL COMMENT '用户行为浏览器信息',
  `controller_name` varchar(250) NOT NULL COMMENT '用户行为方法名称',
  `controller_action` varchar(250) NOT NULL COMMENT '用户行为方法路径',
  `json_data` mediumtext NOT NULL COMMENT '用户行为方法参数',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `oa_behavior_log` */

insert  into `oa_behavior_log`(`id`,`uid`,`ip`,`date`,`area`,`country`,`user_agent`,`controller_name`,`controller_action`,`json_data`) values (1,1,'119.139.14.181','2015-05-30 15:44:01','电信','广东省深圳市','Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.152 Safari/537.36','执行 更新配置','Core/editSetting','{&quot;POST&quot;:[]}'),(2,1,'119.139.14.181','2015-05-30 15:44:03','电信','广东省深圳市','Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.152 Safari/537.36','执行 写入配置','Core/writeSetting','{&quot;POST&quot;:[]}'),(3,1,'119.139.14.181','2015-05-30 15:45:29','电信','广东省深圳市','Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.152 Safari/537.36','执行 编辑版块','Core/editPanel','{&quot;GET&quot;:{&quot;id&quot;:&quot;4&quot;,&quot;_&quot;:&quot;1432971883813&quot;}}');

/*Table structure for table `oa_branch` */

DROP TABLE IF EXISTS `oa_branch`;

CREATE TABLE `oa_branch` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '部门id',
  `title` varchar(250) NOT NULL COMMENT '名称',
  `sort` int(10) unsigned NOT NULL DEFAULT '50' COMMENT '排序',
  `branch_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '上级ID，0为顶级部门',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

/*Data for the table `oa_branch` */

insert  into `oa_branch`(`id`,`title`,`sort`,`branch_id`) values (3,'技术部',3,0),(4,'竞价部',4,0),(5,'编辑部',5,0),(6,'财务部',6,0),(2,'高层部',2,0),(7,'导医部',7,0),(8,'医师部',8,0),(1,'系统部',1,0),(9,'咨询部',9,0),(10,'人事部',10,0);

/*Table structure for table `oa_config` */

DROP TABLE IF EXISTS `oa_config`;

CREATE TABLE `oa_config` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '配置ID',
  `name` varchar(250) NOT NULL COMMENT '名称',
  `key` varchar(250) NOT NULL COMMENT 'key',
  `value` varchar(250) DEFAULT NULL COMMENT 'value',
  `default` varchar(250) DEFAULT NULL COMMENT '默认值',
  `editor` varchar(250) NOT NULL DEFAULT 'text' COMMENT '类型:编辑类型',
  `config_cate_id` int(10) unsigned NOT NULL DEFAULT '1' COMMENT '所属分类',
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQUE` (`key`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

/*Data for the table `oa_config` */

insert  into `oa_config`(`id`,`name`,`key`,`value`,`default`,`editor`,`config_cate_id`) values (1,'系统名称','TITLE','医疗OA管理系统','医疗OA管理系统','text',1),(2,'用户过期时间(分钟)','LOGIN_TIME','43200','10080','text',1),(3,'开启登录日志','LOGIN_LOG','true','true','text',1),(4,'开启行为日志','BEHAVIOR_LOG','true','true','text',1),(5,'S缓存有效期(秒)','S_TIME','3600','3600','text',1),(6,'到期提示时间(天)','EXPIRE_DATE','90','30','text',1);

/*Table structure for table `oa_config_cate` */

DROP TABLE IF EXISTS `oa_config_cate`;

CREATE TABLE `oa_config_cate` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '配置分类ID',
  `title` varchar(250) NOT NULL COMMENT '名称',
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQUE` (`title`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `oa_config_cate` */

insert  into `oa_config_cate`(`id`,`title`) values (1,'后台设置'),(2,'核心参数');

/*Table structure for table `oa_disease` */

DROP TABLE IF EXISTS `oa_disease`;

CREATE TABLE `oa_disease` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '疾病id',
  `title` varchar(250) NOT NULL COMMENT '名称',
  `hosp_id` int(10) unsigned NOT NULL COMMENT '医院id',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `oa_disease` */

insert  into `oa_disease`(`id`,`title`,`hosp_id`) values (1,'包皮包茎',1),(2,'阳痿早泄',1),(3,'鼻出血',2);

/*Table structure for table `oa_dns_domain` */

DROP TABLE IF EXISTS `oa_dns_domain`;

CREATE TABLE `oa_dns_domain` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '域名解析ID',
  `host_domain` varchar(15) NOT NULL COMMENT '主机头',
  `host_id` int(10) unsigned NOT NULL COMMENT '服务器ID',
  `domain_id` int(10) unsigned NOT NULL COMMENT '域名ID',
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQUE` (`host_domain`,`domain_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `oa_dns_domain` */

/*Table structure for table `oa_doctor` */

DROP TABLE IF EXISTS `oa_doctor`;

CREATE TABLE `oa_doctor` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '医生ID',
  `title` varchar(30) NOT NULL COMMENT '医生名称',
  `number` varchar(30) DEFAULT NULL COMMENT '医生编号',
  `phone` varchar(15) DEFAULT NULL COMMENT '医生手机',
  `email` varchar(32) DEFAULT NULL COMMENT '医生邮箱',
  `hosp_id` int(10) unsigned NOT NULL COMMENT '医院id',
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQUE` (`title`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `oa_doctor` */

insert  into `oa_doctor`(`id`,`title`,`number`,`phone`,`email`,`hosp_id`) values (1,'李佳','0021','18179112275','624508914@qq.com',1),(2,'杨圆建','0022','18179612275','624508914@qq.com',2);

/*Table structure for table `oa_domain` */

DROP TABLE IF EXISTS `oa_domain`;

CREATE TABLE `oa_domain` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '域名ID',
  `name` varchar(100) NOT NULL COMMENT '域名名称',
  `user` varchar(100) NOT NULL COMMENT '域名所有者(备案主体)',
  `dns` varchar(100) NOT NULL COMMENT '域名DNS服务器',
  `is_record` int(1) unsigned NOT NULL DEFAULT '0' COMMENT '域名是否备案 0：未备案 1：已备案',
  `record_type` int(1) unsigned NOT NULL DEFAULT '0' COMMENT '域名备案类型 0：未备案 1：个人备案 2：企业备案',
  `end_date` datetime NOT NULL COMMENT '域名到期时间',
  `service_id` int(10) unsigned NOT NULL COMMENT '服务商ID',
  `remake` varchar(250) DEFAULT NULL COMMENT '域名备注',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `oa_domain` */

/*Table structure for table `oa_ftp` */

DROP TABLE IF EXISTS `oa_ftp`;

CREATE TABLE `oa_ftp` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'FTP ID',
  `ftp_user` varchar(100) NOT NULL COMMENT 'FTP账号',
  `ftp_pass` varchar(100) NOT NULL COMMENT 'FTP密码',
  `ftp_dir` varchar(250) NOT NULL COMMENT 'FTP主目录',
  `host_id` int(10) NOT NULL COMMENT '所属服务器',
  `remake` varchar(250) DEFAULT NULL COMMENT 'FTP备注',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `oa_ftp` */

/*Table structure for table `oa_hosp` */

DROP TABLE IF EXISTS `oa_hosp`;

CREATE TABLE `oa_hosp` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '医院id',
  `title` varchar(250) NOT NULL COMMENT '名称',
  `sort` int(10) unsigned DEFAULT '50' COMMENT '排序',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态，0，关闭，1正常',
  `desc` text COMMENT '备注',
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQUE` (`title`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

/*Data for the table `oa_hosp` */

insert  into `oa_hosp`(`id`,`title`,`sort`,`status`,`desc`) values (1,'深圳xx耳鼻喉',1,1,''),(6,'深圳xxs耳鼻喉',6,1,''),(7,'深圳xx增高',7,1,''),(2,'深圳xx男科',2,1,''),(3,'深圳xxs男科',3,1,''),(4,'深圳xx性病',4,1,''),(5,'深圳xxs性病',5,1,''),(8,'深圳xxs整形',8,1,''),(9,'天津xx性病',9,1,''),(10,'公共设置医院',10,0,'');

/*Table structure for table `oa_host` */

DROP TABLE IF EXISTS `oa_host`;

CREATE TABLE `oa_host` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '服务器ID',
  `ip` varchar(15) NOT NULL COMMENT '服务器IP',
  `mstsc_port` int(6) unsigned NOT NULL COMMENT '远程端口',
  `mstsc_user` varchar(100) NOT NULL COMMENT '远程用户',
  `mstsc_pass` varchar(100) NOT NULL COMMENT '远程密码',
  `ftp_port` int(6) NOT NULL COMMENT 'FTP端口',
  `mysql_user` varchar(100) DEFAULT NULL COMMENT 'mysql用户',
  `mysql_pass` varchar(100) DEFAULT NULL COMMENT 'mysql密码',
  `mysql_port` int(6) NOT NULL COMMENT 'mysql端口',
  `mysql_dir` varchar(250) DEFAULT NULL COMMENT 'mysql目录',
  `end_date` datetime NOT NULL COMMENT '服务器到期时间',
  `service_id` int(10) NOT NULL COMMENT '所属服务商',
  `remake` varchar(250) DEFAULT NULL COMMENT '服务器备注',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `oa_host` */

/*Table structure for table `oa_job` */

DROP TABLE IF EXISTS `oa_job`;

CREATE TABLE `oa_job` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '职务id',
  `title` varchar(100) NOT NULL COMMENT '职务名称',
  `sort` int(10) unsigned NOT NULL DEFAULT '50' COMMENT '职务排序',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

/*Data for the table `oa_job` */

insert  into `oa_job`(`id`,`title`,`sort`) values (1,'超级管理员',1),(2,'董事长',2),(3,'总经理',3),(4,'部门经理',4),(5,'部门主管',5),(6,'部门组长',6),(7,'普通职员',7);

/*Table structure for table `oa_login_log` */

DROP TABLE IF EXISTS `oa_login_log`;

CREATE TABLE `oa_login_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户登陆日志id',
  `uid` int(10) unsigned NOT NULL COMMENT '用户id',
  `ip` varchar(250) NOT NULL COMMENT '用户登陆ip',
  `date` datetime NOT NULL COMMENT '用户登陆时间',
  `area` varchar(250) NOT NULL COMMENT '用户登陆网络',
  `country` varchar(250) NOT NULL COMMENT '用户登录地区',
  `user_agent` text NOT NULL COMMENT '用户浏览器信息',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=102 DEFAULT CHARSET=utf8;

/*Data for the table `oa_login_log` */

insert  into `oa_login_log`(`id`,`uid`,`ip`,`date`,`area`,`country`,`user_agent`) values (95,1,'0.0.0.0','2015-05-27 14:46:10','对方在服务器本地登录','IANA保留地址','Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/38.0.2125.122 Safari/537.36'),(94,2,'0.0.0.0','2015-05-27 14:45:55','对方在服务器本地登录','IANA保留地址','Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/38.0.2125.122 Safari/537.36'),(93,1,'0.0.0.0','2015-05-26 15:46:27','对方在服务器本地登录','IANA保留地址','Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/38.0.2125.122 Safari/537.36'),(92,1,'0.0.0.0','2015-05-22 09:32:00','对方在服务器本地登录','IANA保留地址','Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/38.0.2125.122 Safari/537.36'),(91,2,'0.0.0.0','2015-05-22 09:31:48','对方在服务器本地登录','IANA保留地址','Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/38.0.2125.122 Safari/537.36'),(90,1,'0.0.0.0','2015-05-21 10:06:21','对方在服务器本地登录','IANA保留地址','Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/38.0.2125.122 Safari/537.36'),(89,3,'192.168.16.206','2015-05-20 15:53:44','对方和您在同一内部网','局域网','Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/31.0.1650.63 Safari/537.36'),(53,2,'119.139.16.183','2015-05-01 08:21:24','电信','广东省深圳市','Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/38.0.2125.122 Safari/537.36'),(54,2,'0.0.0.0','2015-05-01 16:14:01','对方在服务器本地登录','IANA保留地址','Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/38.0.2125.122 Safari/537.36'),(55,2,'0.0.0.0','2015-05-04 14:12:17','对方在服务器本地登录','IANA保留地址','Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/38.0.2125.122 Safari/537.36'),(56,1,'0.0.0.0','2015-05-04 14:14:19','对方在服务器本地登录','IANA保留地址','Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/38.0.2125.122 Safari/537.36'),(57,1,'0.0.0.0','2015-05-06 11:03:07','对方在服务器本地登录','IANA保留地址','Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/38.0.2125.122 Safari/537.36'),(58,3,'192.168.16.206','2015-05-06 14:04:27','对方和您在同一内部网','局域网','Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 6.1; WOW64; Trident/5.0; SLCC2; .NET CLR 2.0.50727; .NET CLR 3.5.30729; .NET CLR 3.0.30729)'),(59,3,'0.0.0.0','2015-05-06 14:09:23','对方在服务器本地登录','IANA保留地址','Mozilla/5.0 (Windows NT 6.3; WOW64; rv:37.0) Gecko/20100101 Firefox/37.0'),(60,1,'0.0.0.0','2015-05-07 14:12:49','对方在服务器本地登录','IANA保留地址','Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/38.0.2125.122 Safari/537.36'),(61,1,'0.0.0.0','2015-05-09 14:44:20','对方在服务器本地登录','IANA保留地址','Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/38.0.2125.122 Safari/537.36'),(62,2,'0.0.0.0','2015-05-09 16:03:56','对方在服务器本地登录','IANA保留地址','Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/38.0.2125.122 Safari/537.36'),(63,2,'0.0.0.0','2015-05-09 16:04:14','对方在服务器本地登录','IANA保留地址','Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/38.0.2125.122 Safari/537.36'),(64,1,'0.0.0.0','2015-05-09 16:04:24','对方在服务器本地登录','IANA保留地址','Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/38.0.2125.122 Safari/537.36'),(65,1,'0.0.0.0','2015-05-09 17:12:40','对方在服务器本地登录','IANA保留地址','Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/38.0.2125.122 Safari/537.36'),(66,3,'192.168.16.206','2015-05-09 17:45:55','对方和您在同一内部网','局域网','Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/31.0.1650.63 Safari/537.36'),(67,1,'0.0.0.0','2015-05-11 08:58:26','对方在服务器本地登录','IANA保留地址','Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/38.0.2125.122 Safari/537.36'),(68,2,'0.0.0.0','2015-05-11 16:18:33','对方在服务器本地登录','IANA保留地址','Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/38.0.2125.122 Safari/537.36'),(69,1,'0.0.0.0','2015-05-11 16:27:00','对方在服务器本地登录','IANA保留地址','Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/38.0.2125.122 Safari/537.36'),(70,1,'0.0.0.0','2015-05-12 16:59:57','对方在服务器本地登录','IANA保留地址','Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/38.0.2125.122 Safari/537.36'),(71,2,'0.0.0.0','2015-05-12 17:45:37','对方在服务器本地登录','IANA保留地址','Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/38.0.2125.122 Safari/537.36'),(72,1,'0.0.0.0','2015-05-13 15:13:26','对方在服务器本地登录','IANA保留地址','Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/38.0.2125.122 Safari/537.36'),(73,1,'0.0.0.0','2015-05-14 09:32:39','对方在服务器本地登录','IANA保留地址','Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/38.0.2125.122 Safari/537.36'),(74,2,'0.0.0.0','2015-05-16 14:37:25','对方在服务器本地登录','IANA保留地址','Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/38.0.2125.122 Safari/537.36'),(75,2,'0.0.0.0','2015-05-16 14:37:40','对方在服务器本地登录','IANA保留地址','Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/38.0.2125.122 Safari/537.36'),(76,1,'0.0.0.0','2015-05-16 14:37:55','对方在服务器本地登录','IANA保留地址','Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/38.0.2125.122 Safari/537.36'),(77,2,'0.0.0.0','2015-05-16 15:32:05','对方在服务器本地登录','IANA保留地址','Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/38.0.2125.122 Safari/537.36'),(78,1,'0.0.0.0','2015-05-16 15:32:45','对方在服务器本地登录','IANA保留地址','Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/38.0.2125.122 Safari/537.36'),(79,2,'0.0.0.0','2015-05-16 15:33:09','对方在服务器本地登录','IANA保留地址','Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/38.0.2125.122 Safari/537.36'),(80,2,'0.0.0.0','2015-05-18 09:11:17','对方在服务器本地登录','IANA保留地址','Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/38.0.2125.122 Safari/537.36'),(81,1,'0.0.0.0','2015-05-18 16:04:27','对方在服务器本地登录','IANA保留地址','Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/38.0.2125.122 Safari/537.36'),(82,2,'0.0.0.0','2015-05-19 08:59:52','对方在服务器本地登录','IANA保留地址','Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/38.0.2125.122 Safari/537.36'),(83,1,'0.0.0.0','2015-05-19 09:02:54','对方在服务器本地登录','IANA保留地址','Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/38.0.2125.122 Safari/537.36'),(84,1,'0.0.0.0','2015-05-19 15:46:53','对方在服务器本地登录','IANA保留地址','Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/38.0.2125.122 Safari/537.36'),(85,2,'0.0.0.0','2015-05-19 16:51:08','对方在服务器本地登录','IANA保留地址','Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/38.0.2125.122 Safari/537.36'),(86,2,'0.0.0.0','2015-05-19 16:51:21','对方在服务器本地登录','IANA保留地址','Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/38.0.2125.122 Safari/537.36'),(87,1,'0.0.0.0','2015-05-19 17:27:05','对方在服务器本地登录','IANA保留地址','Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/38.0.2125.122 Safari/537.36'),(88,1,'0.0.0.0','2015-05-20 08:46:33','对方在服务器本地登录','IANA保留地址','Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/38.0.2125.122 Safari/537.36'),(96,3,'192.168.16.206','2015-05-27 14:47:51','对方和您在同一内部网','局域网','Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/31.0.1650.63 Safari/537.36'),(97,1,'0.0.0.0','2015-05-28 09:49:43','对方在服务器本地登录','IANA保留地址','Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/38.0.2125.122 Safari/537.36'),(98,1,'0.0.0.0','2015-05-29 10:51:16','对方在服务器本地登录','IANA保留地址','Mozilla/5.0 (Windows NT 6.3; WOW64; rv:38.0) Gecko/20100101 Firefox/38.0'),(99,1,'0.0.0.0','2015-05-30 14:49:52','对方在服务器本地登录','IANA保留地址','Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.152 Safari/537.36'),(100,1,'119.139.14.181','2015-05-30 15:34:08','电信','广东省深圳市','Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.152 Safari/537.36'),(101,1,'119.139.14.181','2015-05-30 15:45:17','电信','广东省深圳市','Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.152 Safari/537.36');

/*Table structure for table `oa_panel` */

DROP TABLE IF EXISTS `oa_panel`;

CREATE TABLE `oa_panel` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '版块id',
  `title` varchar(250) NOT NULL COMMENT '标题',
  `content` mediumtext COMMENT '内容',
  `sort` int(3) NOT NULL DEFAULT '50' COMMENT '排序id',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Data for the table `oa_panel` */

insert  into `oa_panel`(`id`,`title`,`content`,`sort`) values (1,'开发日志','&lt;p&gt;[2015-04-26]&lt;/p&gt;&lt;p&gt;1、完成整个后台系统基础核心开发&lt;/p&gt;&lt;p&gt;2、可以基于本系统开发出任意扩展系统&lt;br/&gt;&lt;/p&gt;&lt;p&gt;[2015-04-17]&lt;/p&gt;&lt;p&gt;1、部门管理开发完成&lt;/p&gt;&lt;p&gt;[2015-04-16]&lt;/p&gt;&lt;p&gt;1、系统增加日志系统&lt;br/&gt;&lt;/p&gt;&lt;p&gt;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;行为日志：用于记录用户各个需要授权操作的增删改&lt;br/&gt;&lt;/p&gt;&lt;p&gt;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;登录日志：用户记录用户登录时的信息&lt;br/&gt;&lt;/p&gt;&lt;p&gt;[2015-04-15]&lt;/p&gt;&lt;p&gt;1、新增后台首页版块处理&lt;/p&gt;&lt;p&gt;.....&lt;/p&gt;',1),(2,'安全提示','&lt;p&gt;网站上线后建议关闭DEBUG调试模式&lt;/p&gt;&lt;p&gt;建议开启单点登录功能&lt;/p&gt;',2),(3,'系统说明','&lt;p&gt;&lt;span style=&quot;font-size: 12px; font-family: 微软雅黑, &amp;#39;Microsoft YaHei&amp;#39;;&quot;&gt;医疗OA管理系统第一代版本，起于2014年11月份，止于2015年2月！&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-size: 12px; font-family: 微软雅黑, &amp;#39;Microsoft YaHei&amp;#39;;&quot;&gt;2015年3月进行历史性的第一次全面重构，优化界面与整理性能体验，更加合理的布局与开发！&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-size: 12px; font-family: 微软雅黑, &amp;#39;Microsoft YaHei&amp;#39;;&quot;&gt;我期待，不久的未来，可以基于这套系统繁衍出更多更好的Web应用系统！&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-family: 微软雅黑, &amp;#39;Microsoft YaHei&amp;#39;; font-size: 12px;&quot;&gt;&amp;nbsp;版本号：1.0.150213[开发版] （联系QQ：624508914）&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-family: 微软雅黑, &amp;#39;Microsoft YaHei&amp;#39;; font-size: 12px;&quot;&gt;&lt;a target=&quot;_blank&quot; href=&quot;http://shang.qq.com/wpa/qunwpa?idkey=d6cbb00ab8a3d617fbf889459e7e882cc617d2fc84c5dbbba10c84afb6cc3437&quot; style=&quot;font-family: 微软雅黑, &amp;#39;Microsoft YaHei&amp;#39;; font-size: 12px; white-space: normal;&quot;&gt;&lt;img border=&quot;0&quot; src=&quot;http://pub.idqqimg.com/wpa/images/group.png&quot; alt=&quot;医院OA系统-官方1群&quot; title=&quot;医院OA系统-官方1群&quot;/&gt;&lt;/a&gt;&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-family: 微软雅黑, &amp;#39;Microsoft YaHei&amp;#39;; font-size: 12px;&quot;&gt;基于的开发环境：&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-size: 12px;&quot;&gt;&lt;strong&gt;&lt;span style=&quot;font-family: 微软雅黑, &amp;#39;Microsoft YaHei&amp;#39;; color: rgb(255, 0, 0);&quot;&gt;&lt;span style=&quot;font-family: 微软雅黑, &amp;#39;Microsoft YaHei&amp;#39;;&quot;&gt;IIS &lt;/span&gt;8.5&lt;span style=&quot;font-family: 微软雅黑, &amp;#39;Microsoft YaHei&amp;#39;;&quot;&gt;&lt;span style=&quot;font-family: 微软雅黑, &amp;#39;Microsoft YaHei&amp;#39;;&quot;&gt;&lt;/span&gt; &amp;nbsp;&amp;nbsp; Mysql&amp;nbsp;&lt;/span&gt;5.7.3-m13\r\n &amp;nbsp; &amp;nbsp;&lt;span style=&quot;font-family: 微软雅黑, &amp;#39;Microsoft YaHei&amp;#39;;&quot;&gt;PHP&amp;nbsp;&lt;/span&gt;5.5.15&lt;/span&gt;&lt;/strong&gt;&lt;strong&gt;&lt;span style=&quot;font-family: 微软雅黑, &amp;#39;Microsoft YaHei&amp;#39;; color: rgb(255, 0, 0);&quot;&gt;&lt;/span&gt;&lt;/strong&gt;&lt;span style=&quot;font-family: 微软雅黑, &amp;#39;Microsoft YaHei&amp;#39;;&quot;&gt;（没有做过多的环境调试，一般都兼容）&lt;/span&gt;&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;color: rgb(255, 0, 0); font-size: 12px;&quot;&gt;&lt;strong&gt;&lt;span style=&quot;color: rgb(255, 0, 0); font-family: 微软雅黑, &amp;#39;Microsoft YaHei&amp;#39;;&quot;&gt;本系统采用（ThinkPHP 3.2.3 + jQuery EasyUI 1.4.1）框架&lt;/span&gt;&lt;/strong&gt;&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-family: 微软雅黑, &amp;#39;Microsoft YaHei&amp;#39;; font-size: 12px;&quot;&gt;开发二次开发参考手册：&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;a href=&quot;http://doc.thinkphp.cn/&quot; _src=&quot;http://doc.thinkphp.cn/&quot; style=&quot;font-family: 微软雅黑, &amp;#39;Microsoft YaHei&amp;#39;; text-decoration: underline; font-size: 12px;&quot;&gt;&lt;span style=&quot;font-family: 微软雅黑, &amp;#39;Microsoft YaHei&amp;#39;; font-size: 12px;&quot;&gt;http://doc.thinkphp.cn/&lt;/span&gt;&lt;/a&gt;&lt;/p&gt;&lt;p&gt;&lt;a href=&quot;http://jeasyui.com/documentation/&quot; _src=&quot;http://jeasyui.com/documentation/&quot; style=&quot;font-family: 微软雅黑, &amp;#39;Microsoft YaHei&amp;#39;; text-decoration: underline; font-size: 12px;&quot;&gt;&lt;span style=&quot;font-family: 微软雅黑, &amp;#39;Microsoft YaHei&amp;#39;; font-size: 12px;&quot;&gt;http://jeasyui.com/documentation/&lt;/span&gt;&lt;/a&gt;&lt;/p&gt;',3),(4,'支付宝捐赠','&lt;p&gt;&lt;strong style=&quot;font-family: 微软雅黑; font-size: 12px; line-height: 21.6000003814697px; white-space: normal;&quot;&gt;&lt;/strong&gt;&lt;/p&gt;&lt;table data-sort=&quot;sortDisabled&quot;&gt;&lt;tbody&gt;&lt;tr class=&quot;firstRow&quot;&gt;&lt;td valign=&quot;top&quot; style=&quot;word-break: break-all;&quot; colspan=&quot;2&quot;&gt;&lt;strong style=&quot;font-family: 微软雅黑; font-size: 12px; line-height: 21.6000003814697px;&quot;&gt;用手机扫一扫支付宝二位码进行支付 （ 暂定价格：&lt;/strong&gt;&lt;span style=&quot;color: rgb(192, 0, 0);&quot;&gt;&lt;strong style=&quot;font-family: 微软雅黑; font-size: 12px; line-height: 21.6000003814697px;&quot;&gt;200RMB&lt;/strong&gt;&lt;/span&gt;&lt;strong style=&quot;font-family: 微软雅黑; font-size: 12px; line-height: 21.6000003814697px;&quot;&gt;）么么哒&lt;/strong&gt;&lt;p style=&quot;white-space: normal;&quot;&gt;&lt;strong style=&quot;font-family: 微软雅黑; font-size: 12px; line-height: 21.6000003814697px;&quot;&gt;&lt;strong style=&quot;line-height: 21.6000003814697px;&quot;&gt;支付宝账号姓名：杨圆建 &amp;nbsp;支付宝账号：624508914@qq.com&lt;/strong&gt;&lt;/strong&gt;&lt;/p&gt;&lt;p style=&quot;white-space: normal;&quot;&gt;&lt;span style=&quot;font-family: 微软雅黑;&quot;&gt;&lt;span style=&quot;font-size: 12px; line-height: 21.6000003814697px;&quot;&gt;&lt;strong&gt;感谢各位的慷慨解囊,&lt;strong style=&quot;line-height: 21.6000003814697px;&quot;&gt;&amp;nbsp;将在收到款项之后发送 （&lt;span style=&quot;line-height: 21.6000003814697px; color: rgb(255, 0, 0);&quot;&gt;源码+数据库&lt;/span&gt;）&lt;/strong&gt;&lt;/strong&gt;&lt;/span&gt;&lt;/span&gt;&lt;/p&gt;&lt;/td&gt;&lt;/tr&gt;&lt;tr&gt;&lt;td width=&quot;311&quot; valign=&quot;top&quot; style=&quot;word-break: break-all;&quot;&gt;&lt;span style=&quot;font-family: 微软雅黑;&quot;&gt;&lt;span style=&quot;font-size: 12px; line-height: 21.6000003814697px;&quot;&gt;&lt;strong&gt;手机支付宝-扫码支付&lt;/strong&gt;&lt;/span&gt;&lt;/span&gt;&lt;/td&gt;&lt;td width=&quot;311&quot; valign=&quot;top&quot; style=&quot;word-break: break-all;&quot;&gt;&lt;span style=&quot;font-family: 微软雅黑;&quot;&gt;&lt;span style=&quot;font-size: 12px; line-height: 21.6000003814697px;&quot;&gt;&lt;strong&gt;关注微信公众平台号，实时分享最新信息&lt;/strong&gt;&lt;/span&gt;&lt;/span&gt;&lt;/td&gt;&lt;/tr&gt;&lt;tr&gt;&lt;td width=&quot;311&quot; valign=&quot;top&quot; style=&quot;word-break: break-all;&quot;&gt;&lt;strong style=&quot;white-space: normal; font-size: 12px; line-height: 21.6000003814697px; font-family: 微软雅黑;&quot;&gt;&lt;img src=&quot;/Public/Images/alipay.png&quot; alt=&quot;捐赠我们&quot; height=&quot;150&quot; width=&quot;150&quot; border=&quot;0&quot; vspace=&quot;0&quot; title=&quot;捐赠我们&quot; style=&quot;line-height: 21.6000003814697px; width: 150px; height: 150px;&quot;/&gt;&lt;/strong&gt;&lt;/td&gt;&lt;td width=&quot;311&quot; valign=&quot;top&quot; style=&quot;word-break: break-all;&quot;&gt;&lt;strong style=&quot;white-space: normal; font-size: 12px; line-height: 21.6000003814697px; font-family: 微软雅黑;&quot;&gt;&lt;strong style=&quot;line-height: 21.6000003814697px;&quot;&gt;&lt;img src=&quot;/Public/Uploads/Ueditor/images/20150427/1430104957948850.jpg&quot; width=&quot;150&quot; height=&quot;150&quot; border=&quot;0&quot; vspace=&quot;0&quot; title=&quot;&quot; alt=&quot;&quot; style=&quot;width: 150px; height: 150px;&quot;/&gt;&lt;/strong&gt;&lt;/strong&gt;&lt;/td&gt;&lt;/tr&gt;&lt;/tbody&gt;&lt;/table&gt;&lt;p&gt;&lt;strong style=&quot;font-family: 微软雅黑; font-size: 12px; line-height: 21.6000003814697px; white-space: normal;&quot;&gt;&lt;/strong&gt;&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;',4);

/*Table structure for table `oa_service` */

DROP TABLE IF EXISTS `oa_service`;

CREATE TABLE `oa_service` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '服务商ID',
  `title` varchar(250) NOT NULL COMMENT '服务商名称',
  `url` varchar(250) DEFAULT NULL COMMENT '服务商网址',
  `username` varchar(250) DEFAULT NULL COMMENT '服务商网站登录账号',
  `password` varchar(250) DEFAULT NULL COMMENT '服务商网站登录密码',
  `phone` varchar(20) DEFAULT NULL COMMENT '服务商网站绑定电话',
  `email` varchar(250) DEFAULT NULL COMMENT '服务商网站绑定邮箱',
  `remake` varchar(250) DEFAULT NULL COMMENT '服务商备注',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `oa_service` */

/*Table structure for table `oa_session` */

DROP TABLE IF EXISTS `oa_session`;

CREATE TABLE `oa_session` (
  `session_id` varchar(255) NOT NULL,
  `session_expire` int(11) NOT NULL,
  `session_data` blob,
  UNIQUE KEY `session_id` (`session_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `oa_session` */

insert  into `oa_session`(`session_id`,`session_expire`,`session_data`) values ('4g6bkjbe365ql3sjvjrmf5smb3',1432973470,'uid|s:1:\"1\";login_time|i:1432972027;user|a:1:{s:4:\"info\";a:12:{s:3:\"uid\";s:1:\"1\";s:4:\"name\";s:5:\"admin\";s:4:\"pass\";s:32:\"67c0f828a0e813f57fa552132516e7e3\";s:5:\"title\";s:15:\"超级管理员\";s:6:\"job_id\";s:1:\"1\";s:5:\"phone\";s:11:\"18179612275\";s:2:\"qq\";s:9:\"624508914\";s:5:\"visit\";s:1:\"1\";s:6:\"status\";s:1:\"1\";s:10:\"data_level\";s:1:\"1\";s:9:\"branch_id\";s:1:\"1\";s:11:\"create_date\";s:19:\"2014-12-01 00:00:00\";}}'),('khdd4q15bonvme1qnu3ko6ii96',1432972480,'uid|s:1:\"1\";login_time|i:1432968964;user|a:1:{s:4:\"info\";a:12:{s:3:\"uid\";s:1:\"1\";s:4:\"name\";s:5:\"admin\";s:4:\"pass\";s:32:\"67c0f828a0e813f57fa552132516e7e3\";s:5:\"title\";s:15:\"超级管理员\";s:6:\"job_id\";s:1:\"1\";s:5:\"phone\";s:11:\"18179612275\";s:2:\"qq\";s:9:\"624508914\";s:5:\"visit\";s:1:\"1\";s:6:\"status\";s:1:\"1\";s:10:\"data_level\";s:1:\"1\";s:9:\"branch_id\";s:1:\"1\";s:11:\"create_date\";s:19:\"2014-12-01 00:00:00\";}}');

/*Table structure for table `oa_sql_object` */

DROP TABLE IF EXISTS `oa_sql_object`;

CREATE TABLE `oa_sql_object` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '数据库ID',
  `sql_object` varchar(100) NOT NULL COMMENT '数据库名称',
  `host_id` int(10) unsigned NOT NULL COMMENT '所属服务器',
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQUE` (`sql_object`,`host_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `oa_sql_object` */

/*Table structure for table `oa_sql_user` */

DROP TABLE IF EXISTS `oa_sql_user`;

CREATE TABLE `oa_sql_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '数据库用户ID',
  `sql_user` varchar(100) NOT NULL COMMENT '数据库用户',
  `sql_pass` varchar(100) NOT NULL COMMENT '数据库密码',
  `host_id` int(10) DEFAULT NULL COMMENT '所属服务器',
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQUE` (`sql_user`,`host_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `oa_sql_user` */

/*Table structure for table `oa_user` */

DROP TABLE IF EXISTS `oa_user`;

CREATE TABLE `oa_user` (
  `uid` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户id',
  `name` varchar(20) NOT NULL COMMENT '登录名',
  `pass` varchar(32) NOT NULL COMMENT '登录密码',
  `title` varchar(20) NOT NULL DEFAULT '0' COMMENT '昵称',
  `job_id` tinyint(1) unsigned NOT NULL DEFAULT '6' COMMENT '职务id',
  `phone` varchar(11) NOT NULL DEFAULT '0' COMMENT '电话',
  `qq` varchar(15) NOT NULL DEFAULT '0' COMMENT 'QQ',
  `visit` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '回访权限：0，禁用，1，回访',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '用户状态：0，禁用，1，正常',
  `data_level` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '数据管理：0，普通，1，管理',
  `branch_id` int(10) unsigned NOT NULL COMMENT '部门id',
  `create_date` datetime NOT NULL COMMENT '创建用户时间',
  PRIMARY KEY (`uid`),
  UNIQUE KEY `UNIQUE` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `oa_user` */

insert  into `oa_user`(`uid`,`name`,`pass`,`title`,`job_id`,`phone`,`qq`,`visit`,`status`,`data_level`,`branch_id`,`create_date`) values (1,'admin','67c0f828a0e813f57fa552132516e7e3','超级管理员',1,'18179612275','624508914',1,1,1,1,'2014-12-01 00:00:00'),(2,'guest','e10adc3949ba59abbe56e057f20f883e','测试账号',7,'18179612275','624508914',0,1,0,1,'2015-02-14 10:33:19'),(3,'zym','e10adc3949ba59abbe56e057f20f883e','曾玉梅',5,'18820956096','897332246',1,1,1,1,'0000-00-00 00:00:00');

/*Table structure for table `oa_user_hosp` */

DROP TABLE IF EXISTS `oa_user_hosp`;

CREATE TABLE `oa_user_hosp` (
  `uid` int(10) unsigned NOT NULL COMMENT '用户id',
  `hosp_id` int(10) unsigned NOT NULL COMMENT '医院id',
  UNIQUE KEY `UNIQUE` (`uid`,`hosp_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `oa_user_hosp` */

insert  into `oa_user_hosp`(`uid`,`hosp_id`) values (1,1),(1,2),(1,3),(1,4),(1,5),(1,6),(1,7),(1,8),(1,9),(1,10),(2,1),(2,2),(3,1),(3,2);

/*Table structure for table `oa_web` */

DROP TABLE IF EXISTS `oa_web`;

CREATE TABLE `oa_web` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '网站ID',
  `iis_name` varchar(100) NOT NULL COMMENT '网站IIS名称',
  `title` varchar(100) NOT NULL COMMENT '网站名称',
  `web_dir` varchar(250) NOT NULL COMMENT '网站所在目录',
  `admin_dir` varchar(50) DEFAULT NULL COMMENT '网站后台目录',
  `admin_user` varchar(50) DEFAULT NULL COMMENT '网站后台用户',
  `admin_pass` varchar(50) DEFAULT NULL COMMENT '网站后台密码',
  `web_type_id` int(10) NOT NULL COMMENT '网站类型',
  `hosp_id` int(10) NOT NULL COMMENT '网站所属医院ID',
  `host_id` int(10) NOT NULL COMMENT '网站所属服务器ID',
  `ftp_id` int(10) NOT NULL COMMENT '网站对应FTP ID',
  `sql_user_id` int(10) DEFAULT NULL COMMENT '网站对应数据库用户ID',
  `sql_object_id` int(10) DEFAULT NULL COMMENT '网站对应数据库对象ID',
  `dns_domain_id` varchar(100) NOT NULL COMMENT '网站域名解析ID',
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQUE` (`iis_name`,`host_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `oa_web` */

/*Table structure for table `oa_web_dns_domain` */

DROP TABLE IF EXISTS `oa_web_dns_domain`;

CREATE TABLE `oa_web_dns_domain` (
  `web_id` int(10) unsigned NOT NULL COMMENT '网站ID',
  `dns_domain_id` int(10) unsigned NOT NULL COMMENT '域名解析ID',
  UNIQUE KEY `unique` (`dns_domain_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `oa_web_dns_domain` */

/*Table structure for table `oa_web_type` */

DROP TABLE IF EXISTS `oa_web_type`;

CREATE TABLE `oa_web_type` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '网站类型ID',
  `title` varchar(20) NOT NULL COMMENT '网站类型名称',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `oa_web_type` */

insert  into `oa_web_type`(`id`,`title`) values (1,'竞价'),(2,'优化'),(3,'其他');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
