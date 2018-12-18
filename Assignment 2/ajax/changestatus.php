<?php
require_once("autoloader.php");
if(!isset($_SESSION)){ 
	session_start(); 
}
$purchase = Purchase::getPurchaseById($_POST['id']);
$purchase->setStatus($_POST['state']);
$purchase->save();
echo $purchase->getStatus();
