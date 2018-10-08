<?php

function writeMenuentry($menuname,$menuid){
	$id = isset($_GET['id']) ? $_GET['id'] : 0;
	echo "<li><a href='index.php?id=$menuid' class='menuentry' ";
	if ($menuid == $id){
		echo "id='menuselected'";
	}
	echo ">$menuname</a></li>";
}

?>
