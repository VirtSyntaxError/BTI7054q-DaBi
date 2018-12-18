<?php
include_once("functions.php");
include_once("i18n.php");
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
	echo '<span class="dropdown"><button class="dropdown-button">'.$_SESSION['user'].'</button>';
    	echo '<span class="dropdown-content">';
      	writeMenuentry(t("MYORDERS"),104);
	writeMenuentry(t("LOGOUT"),102);
    	echo '</span></span>';
}

if (isset($_SESSION["isAdmin"]) && $_SESSION["isAdmin"] == true) {
	echo '<span class="dropdown"><button class="dropdown-button">Admin</button>';
    	echo '<span class="dropdown-content">';
	writeAdminMenuentry(t("ORDERS"),"admin/showOrders/");
	writeAdminMenuentry(t("NEWPROD"),"admin/newProduct/");
	writeAdminMenuentry(t("USERS"),"admin/showUsers/");
    	echo '</span></span>';
}

echo '<form method="post" class="menuform">';
$langs = getAvailableLanguages();
echo '<select class="menuentry" id="lang" onchange="changeLang(document.getElementById(\'lang\').value)">';
foreach ($langs as $lang){
	if ($lang === $_SESSION['lang']){
		echo "<option selected value=".$lang.">".$lang."</option>";
	} else {
		echo "<option value=".$lang.">".$lang."</option>";
	}
}
echo "</select>";
foreach($_GET as $key => $val){
 if($key != 'lang'){
    echo '<input type="hidden" name="'.htmlspecialchars($key).'" value="'.htmlspecialchars($val).'" />';
 }
}
echo "</form>";
