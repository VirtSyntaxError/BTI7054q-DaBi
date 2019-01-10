<?php

if(!isset($_SESSION)){ 
	session_start(); 
}

$_SESSION['lang'] = $_POST['lang'];

header('Location: '.$_POST['prev']);
