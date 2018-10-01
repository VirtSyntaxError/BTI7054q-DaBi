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
		$current = explode("/", $_SERVER["PHP_SELF"]);
		$script_name = array_values(array_slice($current, -1))[0];
		echo "<li><a href='".$menu["link"]."' class='menuentry' ";
		if ($menu["link"] == $script_name){
			echo "id='menuselected'";
		}
		echo ">".$menu["name"]."</a></li>";
	}
	echo "</ul>";