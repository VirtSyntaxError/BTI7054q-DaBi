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
} elseif (isset($_POST)) {

	$user = User::getUserByUsername($_SESSION['user']);

	$user->setPrename($_POST['prename']);
	$user->setSurname($_POST['surname']);
	$user->setAddress($_POST['address']);
	$user->setEmail($_POST['email']);
	$user->setZip($_POST['zip']);
	$user->setCity($_POST['city']);
	$user->setCountry($_POST['country']);
	
	if($user->save()) {
		header('Location: index.php?id=105&error=USERSAVED');
	} else {
		header('Location: index.php?id=105&error=USERSAVEDERROR');
	}
}
