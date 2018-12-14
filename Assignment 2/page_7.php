<?php
echo "<article><h1>".t("CART")."</h1>";

echo '<article id="cart">';

$cart = $_SESSION['cart'];
$cart->render(false);
if (!$cart->isEmpty()) {
	echo '<input type="button" value="'.t("EMPTYCART").'" onclick="emptyCart()">';
	echo '<form method="post" action="index.php?id=4&lang='.$_GET["lang"].'">';
	echo '<input type="submit" value="'.t("CHECKOUT").'">';
	echo '</form>';

}

echo '</article>';
echo '</article>';
