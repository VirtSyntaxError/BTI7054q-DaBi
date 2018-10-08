<?php
	include_once("functions.php");
	$menu_array = array(
		array("name" => "Home",
			  "id" => 0,),
		array("name" => "Marken",
			  "id" => 1,),
		array("name" => "Kategorien",
			  "id" => 2,),
		array("name" => "Login",
			  "id" => 3,)
		);
	echo "<ul class='menu'>";
	foreach ($menu_array as $menu){
		writeMenuentry($menu['name'],$menu['id']);	
	}
	echo "</ul>";
?>
