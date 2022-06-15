<?php
	
	$config['db']['host'] = "localhost";
	$config['db']['user'] = "root";
	$config['db']['pass'] = "admin123";
	$config['db']['base'] = "testy";


	$db = new PDO('mysql:host='.$config['db']['host'].';dbname='.$config['db']['base'], $config['db']['user'], $config['db']['pass'], array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

?>