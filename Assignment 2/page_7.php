<?php
echo "<article>";

echo '<span class="outercart">';

$cart = $_SESSION['cart'];
echo '<div class="cardfull" id="cart">';
echo '<h1>'.t("CART").'</h1>';
$cart->render(false);
if (!$cart->isEmpty()) {
	echo '<form method="post" action="ajax/emptycart.php?red=7">';
	echo '<input type="submit" value="'.t("EMPTYCART").'" onclick="emptyCart(); return false">';
	echo '</form>';
	echo '<form method="post" action="index.php?id=4">';
	echo '<input type="submit" value="'.t("CHECKOUT").'">';
	echo '</form>';
}

echo '</div>';
echo '</span>';
echo '</article>';
