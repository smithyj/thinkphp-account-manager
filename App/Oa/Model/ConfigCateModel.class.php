<?php
namespace Oa\Model;
use Think\Model\RelationModel;
class ConfigCateModel extends RelationModel{
   	protected $_link = array(
   		"Config" => array(
   			'mapping_type'  => self::HAS_MANY,
   			"class_name" => "Config",
   			"foreign_key" => "config_cate_id",
   			"mapping_name" => "configs",
   			"mapping_order" => "id desc"
   		)

   	);
}