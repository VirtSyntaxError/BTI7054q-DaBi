<?php
include_once("i18n.php");

$product_array = array(
	"1" => array(
"name" => "Fossil Q Venture Smartwatch",
		  "price" => 999,
		  "sex" => "male/female",
		  "cat" => "Smartwatch",
		  "brand" => "Fossil",
		  "watchcolor" => array("Gold","Rosegold","Silver"),
		  "strapcolor" => array("Gold","Rosegold","Silver")),
	"2" => array(
	"name" => "Certina DS Action Lady Precidrive",
		  "price" => 888,
		  "sex" => "female",
		  "cat" => "Dive Watch",
		  "brand" => "Certina",
		  "watchcolor" => array("Black","Silver"),
		  "strapcolor" => array("Silver Metal", "White Plastic", "Black Plastic")),
	"3" => array(
	"name" => "Rolex SUBMARINER",
		  "price" => 1999,
		  "sex" => "male",
		  "cat" => "Dive Watch",
		  "brand" => "Rolex",
		  "watchcolor" => array("Black"),
		  "strapcolor" => array("Silver Metal")),
	"4" => array(
	"name" => "Rolex SUBMARINER DATE",
		  "price" => 2000,
		  "sex" => "male",
		  "cat" => "Dive Watch",
		  "brand" => "Rolex",
		  "watchcolor" => array("Blue","Green"),
		  "strapcolor" => array("Silver Metal")),
	"5" => array(
	"name" => "SKY_DWELLER",
		  "price" => 9999,
		  "sex" => "male",
		  "cat" => "Dress Watch",
		  "brand" => "Rolex",
		  "watchcolor" => array("Blue","Silver","Black"),
		  "strapcolor" => array("Silver Metal")),
);

function alert($msg) {
    echo "<script type='text/javascript'>alert('$msg');</script>";
}

function redirect($path) {
    echo "<script type='text/javascript'>location.href = '$path';</script>";
}

function writeMenuentry($menuname,$menuid){
	$id = isset($_GET['id']) ? $_GET['id'] : 0;
	$lang = isset($_GET['lang']) ? $_GET['lang'] : getDefaultLanguage();
	$url = "index.php";
	$url = addParam($url, "id", $menuid);
	$url = addParam($url, "lang", $lang);
	echo "<li><a href='".$url."' class='menuentry' ";
	if ($menuid == $id){
		echo "id='menuselected'";
	}
	echo ">$menuname</a></li>";
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
