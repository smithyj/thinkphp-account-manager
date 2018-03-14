<?php
$common_config = include("common.config.php");
$system_config = include("system.config.php");
$db_config = include("db.config.php");
$config = array_merge($common_config,$system_config,$db_config);
return $config;