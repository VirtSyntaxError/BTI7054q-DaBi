<?php
include_once("functions.php");
include_once("i18n.php");
$menu_array = array(
	array("name" => t("HOME"),
		  "id" => 0,),
	array("name" => t("BRANDS"),
		  "id" => 1,),
	array("name" => t("CATEGORIES"),
		  "id" => 2,),
	array("name" => t("LOGIN"),
		  "id" => 3,)
	);
echo "<ul class='menu'>";
foreach ($menu_array as $menu){
	writeMenuentry($menu['name'],$menu['id']);	
}
echo "<form method='GET'>";
$langs = getAvailableLanguages();
echo "<select name='lang' onchange='this.form.submit()'>";
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