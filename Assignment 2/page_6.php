<?php

if (isset($_POST["strapcolor"]) && isset($_POST["watchcolor"])) {
	$newitem = new Item($_SESSION["articlenumber"],$_POST["strapcolor"],$_POST["watchcolor"],1);
	$cart = $_SESSION["cart"];
	$cart->addItem($newitem);
}
header('Location: index.php?id=7&lang='.$_GET["lang"]); 
