<?php
class DB extends mysqli{
	static private $instance;
	
	function __construct() {
		$db_conf = parse_ini_file("db_config.ini.php");
		parent::__construct($db_conf["HOST"], $db_conf["USER"], $db_conf["PW"], $db_conf["DB_NAME"]);
	}

	static public function getInstance() {
		if ( !self::$instance) {
			@self::$instance = new DB();
			if (!self::$instance){
				die ("Error connecting to the database");
			}
			if (!self::$instance->set_charset("utf8mb4")){
				die ("Error loading character set utf8mb4 ".self::$instance->error);
			}
			if (self::$instance->connect_errno > 0){
				die ("Unable to connect to database: ".self::$instance->connect_errno);
			}
		}
		return self::$instance;
	}

	static public function doQuery($sql){
		return self::getInstance()->query($sql);
	}

}
