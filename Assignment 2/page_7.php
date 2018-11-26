<?php
echo "<h1>".t("CART")."</h1>";

echo '<article id="cart">';

$cart = $_SESSION['cart'];
$cart->render();

echo '</article><br>';
if (!$cart->isEmpty()) {
	echo '<input type="button" value="'.t("EMPTYCART").'" onclick="emptyCart()">';
}
