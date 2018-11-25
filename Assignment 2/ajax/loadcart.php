<?php
require_once("autoloader.php");
require_once("../functions.php");
session_start();

if (isset($_SESSION['cart'])){
		$cart = $_SESSION['cart'];
		$cart->render();
}

