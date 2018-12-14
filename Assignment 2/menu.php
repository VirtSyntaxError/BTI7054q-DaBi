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

if (isset($_SESSION["user"])) {
	$menu_array[] = array("name" => t("LOGOUT"),
		"id" => 102,);
} else {
	$menu_array[] = array("name" => t("LOGIN"),
		"id" => 100,);
	$menu_array[] = array("name" => t("REGISTER"),
		"id" => 101,);
}
foreach ($menu_array as $menu){
	writeMenuentry($menu['name'],$menu['id']);	
}
echo '<form method="GET" class="menuform" >';
$langs = getAvailableLanguages();
echo '<select class="menuentry" name="lang" onchange="this.form.submit()">';
foreach ($langs as $lang){
	if ($lang === $_GET['lang']){
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
