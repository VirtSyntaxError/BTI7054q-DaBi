<?php
require_once("autoloader.php");
session_start();
$cart = $_SESSION['cart'];
echo $cart->getQuantity();
