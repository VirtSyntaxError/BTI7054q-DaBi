<?php
if(!isset($_SESSION)){ 
	session_start(); 
}
$_SESSION = [];
setcookie(session_name(),'',1);
header("location:index.php?id=100&lang=de");