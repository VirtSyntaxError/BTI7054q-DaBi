<?php
echo "<h1>".t("CART")."</h1>";

echo '<article id="cart">';

if (isset($_SESSION['cart'])){
		$cart = $_SESSION['cart'];
		$cart->render();
}

echo '</article><br>';
