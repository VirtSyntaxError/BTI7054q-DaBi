<?php
echo "<h1>".t("CART")."</h1>";

if (isset($_SESSION['cart'])){
		$cart = $_SESSION['cart'];
		$cart->render();
}
echo "<br>";
