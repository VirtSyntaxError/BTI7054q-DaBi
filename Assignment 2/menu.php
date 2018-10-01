<?php
	$menu_array = array(
		array("name" => "Home",
			  "link" => "index.php",),
		array("name" => "Marken",
			  "link" => "brands.php",),
		array("name" => "Kategorien",
			  "link" => "categories.php",),
		array("name" => "Login",
			  "link" => "login.php",)
		);
	echo "<ul class='menu'>";
	foreach ($menu_array as $menu){
		echo "<li><a href='".$menu["link"]."' id='menu'>".$menu["name"]."</a></li>";
	}
	echo "</ul>";