<?php
include_once("i18n.php");

function alert($msg) {
    echo "<script type='text/javascript'>alert('$msg');</script>";
}

function redirect($path) {
    echo "<script type='text/javascript'>location.href = '$path';</script>";
}

function writeMenuentry($menuname,$menuid){
	$id = isset($_GET['id']) ? $_GET['id'] : 0;
	$lang = isset($_GET['lang']) ? $_GET['lang'] : getDefaultLanguage();
	$url = ROOT."index.php";
	$url = addParam($url, "id", $menuid);
	$url = addParam($url, "lang", $lang);
	echo "<a href='".$url."' class='menuentry' ";
	if ($menuid == $id){
		echo "id='menuselected'";
	}
	echo ">$menuname</a>";
}

function addParam($url,$name,$value){
	if(strpos($url,'?')!==false){
		$sep='&';
	} else {
		$sep='?';
	}
	return $url.$sep.$name."=".urlencode($value);
}

function getParam($name,$default){
	if (!isset($_GET[$name]))
		return$default;
	return urldecode($_GET[$name]);
}
