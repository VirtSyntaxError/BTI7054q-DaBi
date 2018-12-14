<?php
require_once("autoloader.php");
require_once("../functions.php");
session_start();

if (isset($_SESSION['cart'])){
		$cart = $_SESSION['cart'];
		$cart->render(false);
}

if (!$cart->isEmpty()) {
	echo '<input type="button" value="'.t("EMPTYCART").'" onclick="emptyCart()">';
	echo '<form method="post" action="index.php?id=4&lang='.$_GET["lang"].'">';
	echo '<input type="submit" value="'.t("CHECKOUT").'">';
	echo '</form>';

}
