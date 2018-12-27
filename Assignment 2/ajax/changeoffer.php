<?php
require_once("autoloader.php");
if(!isset($_SESSION)){ 
	session_start(); 
}
$product = Product::getProductById($_POST['id'],$_SESSION['lang']);
$product->setOffer($_POST['offer']);
$product->save();
echo $product->getOffer();
