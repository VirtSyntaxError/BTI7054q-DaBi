<?php
class DB extends mysqli{
	$db_conf = parse_ini_file("db_config.ini");
	const HOST=$db_config["HOST"], USER=$db_config["USER"], PW=$db_config["PW"], DB_NAME=$db_config["DB_NAME"];
	static private $instance;
	
	function __construct() {
		parent::__construct(self::HOST, self::USER, self::PW, self::DB_NAME)
	}
}