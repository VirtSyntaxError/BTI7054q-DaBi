<?php
require_once("autoloader.php");
require_once("../functions.php");
if(!isset($_SESSION)){ 
	session_start(); 
}
$user = User::getUserByUsername($_POST['username']);

if($user){
	echo t("USEREXISTS");
}
