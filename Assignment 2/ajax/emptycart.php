<?php
require_once("autoloader.php");
session_start();
$cart = $_SESSION['cart'];
$cart->deleteAll();
if ($_GET['red']){
	header ("Location: ../index.php?id=".$_GET['red']);
}