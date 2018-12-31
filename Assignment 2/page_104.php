<?php
require_once("autoloader.php");
require_once("functions.php");

if(!isset($_SESSION)){ 
	session_start(); 
}
$lang = $_SESSION['lang'];

echo '<article><h1>'.t("MYORDERS").'</h1>';

$orders = Purchase::getPurchaseByUserId(User::getUserByEmail($_SESSION['user'])->getUserId());

$ogrid = new OrderGrid($lang,...$orders);
$ogrid->render();

echo '</article>';
