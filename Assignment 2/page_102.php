<?php
if(!isset($_SESSION)){ 
	session_start(); 
}
$cart = $_SESSION['cart'];
$_SESSION = [];
setcookie(session_name(),'',1);
$_SESSION['cart'] = $cart;
header("location:index.php?id=100&lang=de");
