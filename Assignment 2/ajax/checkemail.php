<?php
require_once("autoloader.php");
require_once("../functions.php");
if(!isset($_SESSION)){ 
	session_start(); 
}
$user = User::getUserByEmail($_POST['email']);

if($user){
	echo t("EMAILEXISTS");
}
