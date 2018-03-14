<?php
namespace Oa\Model;
use Think\Model\RelationModel;

class WebModel extends RelationModel{
	protected $_link = array(
		'DnsDomain' => array(
			'mapping_type' => self::MANY_TO_MANY,
			'class_name' => 'DnsDomain',
			'mapping_name' => 'dnsdomain',
			'foreign_key' => 'web_id',
			'relation_foreign_key' => 'dns_domain_id',
			'relation_table' => 'oa_web_dns_domain'
		)
	);
}