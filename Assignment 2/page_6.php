<?php

if (isset($_POST["strapcolor"]) && isset($_POST["watchcolor"])) {
	$newitem = new Item($_SESSION["articlenumber"],$_POST["strapcolor"],$_POST["watchcolor"],1);
	$cart = $_SESSION["cart"];
	$cart->addItem($newitem);
}
echo "<h1>".t("CART")."</h1>";
if (isset($_SESSION['cart'])){
		$cart = $_SESSION['cart'];
		$cart->render();
}

