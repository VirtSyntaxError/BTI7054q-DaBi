<?php
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
		$id = isset($_GET['id']) ? $_GET['id'] : 0;
		#$current = explode("/", $_SERVER["PHP_SELF"]);
		#$script_name = array_values(array_slice($current, -1))[0];
		echo "<li><a href='index.php?id=".$menu['id']."' class='menuentry' ";
		if ($menu["id"] == $id){
			echo "id='menuselected'";
		}
		echo ">".$menu["name"]."</a></li>";
	}
	echo "</ul>";
