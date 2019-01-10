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
	echo '<article>';
	echo '<div class="outercart">';
	echo '<div class="cardfull">';
	echo '<h1>'.t("PROFILE").'</h1>';

	$form = new RegistrationForm((bool) false, "index.php?id=106", "SAVE");
	$form->setLoggedIn((bool) true);
	$form->setShowUser((bool) false);
	$form->setSubmitNotInTable((bool) true);

	$form->render();

	echo '</div>';	
	echo '</div>';	
	echo '</article>';
}
