<?php
require_once("autoloader.php");
require_once("functions.php");

if(!isset($_SESSION)){ 
	session_start(); 
}
$lang = $_SESSION['lang'];

$logged_in = $_SESSION["user"] ?? false;
if (!$logged_in){
	echo '<article>';
	echo "<p>".t("PLEASE_LOG_IN")."</p>";
	echo '</article>';
} else {
	echo '<article><h1>'.t("MYORDERS").'</h1>';

	$orders = Purchase::getPurchaseByUserId(User::getUserByEmail($_SESSION['user'])->getUserId());

	$ogrid = new OrderGrid($lang,...$orders);
	$ogrid->render();
	
	echo '</article>';
}
