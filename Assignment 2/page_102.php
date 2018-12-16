<?php
if(!isset($_SESSION)){ 
	session_start(); 
}
$cart = $_SESSION['cart'];
$lang = $_SESSION['lang'];
$_SESSION = [];
setcookie(session_name(),'',1);
$_SESSION['cart'] = $cart;
$_SESSION['lang'] = $lang;
header("Location: index.php?id=100");
