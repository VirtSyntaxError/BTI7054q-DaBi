<?php
require_once("autoloader.php");
session_start();
$cart = $_SESSION['cart'];
foreach($cart->getItems() as $it){
	if ($it->getId() == $_POST['id']){
		$cart->removeItem($it);
	}
}
