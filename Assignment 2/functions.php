<?php
include_once("i18n.php");

function alert($msg) {
    echo "<script type='text/javascript'>alert('$msg');</script>";
}

function redirect($path) {
    echo "<script type='text/javascript'>location.href = '$path';</script>";
}

function writeMenuentry($menuname,$menuid){
	if(!isset($_SESSION)){ 
		session_start(); 
	}
	
	$id = isset($_GET['id']) ? $_GET['id'] : -1;
	$url = ROOT."index.php";
	$url = addParam($url, "id", $menuid);
	echo "<a href='".$url."' class='menuentry";
	if ($menuid == $id){
		echo " menuselected";
	}
	echo "'>$menuname</a>";
}

function writeAdminMenuentry($menuname,$url){
	if(!isset($_SESSION)){ 
		session_start(); 
	}
	
	$url = ROOT.$url;
	echo "<a href='".$url."' class='menuentry' ";
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

function writeMenu($mobile) {
	$menu_array = array(
	array("name" => t("HOME"),
		  "id" => 0,),
	array("name" => t("BRANDS"),
		  "id" => 1,),
	array("name" => t("CATEGORIES"),
		  "id" => 2,)
	);

	if (!isset($_SESSION["user"])) {
		$menu_array[] = array("name" => t("LOGIN"),
			"id" => 100,);
		$menu_array[] = array("name" => t("REGISTER"),
			"id" => 101,);
	}
	foreach ($menu_array as $menu){
		writeMenuentry($menu['name'],$menu['id']);	
	}

	if (isset($_SESSION["user"])) {
		echo '<div class="dropdown"><button class="dropdown-button">'.$_SESSION['user'].'</button>';
    		echo '<div class="dropdown-content">';
      		writeMenuentry(t("PROFILE"),105);
      		writeMenuentry(t("MYORDERS"),104);
		writeMenuentry(t("LOGOUT"),102);
    		echo '</div></div>';
	}
	
	if (isset($_SESSION["isAdmin"]) && $_SESSION["isAdmin"] == true) {
		echo '<div class="dropdown"><button class="dropdown-button">Admin</button>';
    		echo '<div class="dropdown-content">';
		writeAdminMenuentry(t("ORDERS"),"admin/showOrders/");
		writeAdminMenuentry(t("PRODUCTS"),"admin/showProducts/");
		writeAdminMenuentry(t("NEWPROD"),"admin/newProduct/");
		writeAdminMenuentry(t("USERS"),"admin/showUsers/");
    		echo '</div></div>';
	}

	echo '<form method="post" class="menuform" action="index.php?id=9">';
	$langs = getAvailableLanguages();
	if($mobile) {
		echo '<select class="menuentry" id="langmobile" name="lang" onchange="changeLang(document.getElementById(\'langmobile\').value)">';
	} else {
		echo '<select class="menuentry" id="lang" name="lang" onchange="changeLang(document.getElementById(\'lang\').value)">';
	}
	foreach ($langs as $lang){
		if ($lang === $_SESSION['lang']){
			echo "<option selected value=".$lang.">".$lang."</option>";
		} else {
			echo "<option value=".$lang.">".$lang."</option>";
		}
	}
	echo '</select>';
	echo '<noscript>
		<input type="hidden" name="prev" value="'.$_SERVER['REQUEST_URI'].'">
		<input type="submit" value="'.t("CHANGE").'"></noscript>';
	echo '</form>';
}
