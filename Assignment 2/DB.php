<?php
class DB extends mysqli{
	static private $instance;
	
	function __construct() {
		$db_conf = parse_ini_file("db_config.ini");
		parent::__construct($db_conf["HOST"], $db_conf["USER"], $db_conf["PW"], $db_conf["DB_NAME"]);
	}

	static public function getInstance() {
		if ( !self::$instance) {
			@self::$instance = new DB();
		}
		if (self::$instance->connect_errno > 0){
			die ("Unable to connect to database: ".$instance->connect_errno);
		}
		if (!self::$instance->set_charset("utf8")){
			die ("Error loading character set utf8 ".$instance->error);
		}
		return self::$instance;
	}

	static public function doQuery($sql){
		return self::getInstance()->query($sql);
	}
}
