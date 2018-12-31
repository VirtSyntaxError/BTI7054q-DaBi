<?php
require_once("autoloader.php");
require_once("../functions.php");
session_start();

if (isset($_SESSION['cart'])){
		$cart = $_SESSION['cart'];
		$cart->render(false);
}

if (!$cart->isEmpty()) {
	echo '<form method="post" action="ajax/emptycart.php?red=7">';
	echo '<input type="submit" value="'.t("EMPTYCART").'" onclick="emptyCart(); return false">';
	echo '</form>';
	echo '<form method="post" action="index.php?id=4">';
	echo '<input type="submit" value="'.t("CHECKOUT").'">';
	echo '</form>';

}
