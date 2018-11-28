<?php
echo "<h1>".t("CART")."</h1>";

echo '<article id="cart">';

$cart = $_SESSION['cart'];
$cart->render(false);

echo '</article><br>';
if (!$cart->isEmpty()) {
	echo '<article><input type="button" value="'.t("EMPTYCART").'" onclick="emptyCart()">';
	echo '<form method="post" action="index.php?id=4&lang='.$_GET["lang"].'">';
	echo '<input type="submit" value="'.t("CHECKOUT").'">';
	echo '</form></article>';

}
