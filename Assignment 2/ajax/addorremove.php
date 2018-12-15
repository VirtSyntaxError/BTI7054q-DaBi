<?php
require_once("autoloader.php");
session_start();
$cart = $_SESSION['cart'];
print_r($_POST);
foreach($cart->getItems() as $it){
	if ($it->getId() == $_POST['id']){
		if ($_POST['add']){			
			$cart->addItem($it);
		} else {
			$cart->removeItem($it);
		}
	}
}
if ($_POST['prev']){
	header("Location: ".$_POST['prev']);
}