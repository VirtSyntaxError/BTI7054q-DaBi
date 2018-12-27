<?php
require_once("autoloader.php");
if(!isset($_SESSION)){ 
	session_start(); 
}
$product = Product::getProductById($_POST['id'],$_SESSION['lang']);
$product->setDiscount($_POST['discount']);
$product->save();
echo $product->getDiscount();
