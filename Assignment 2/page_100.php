<?php
if(!isset($_SESSION)){ 
	session_start(); 
}
$logged_in = $_SESSION["user"] ?? false;
if ($logged_in){
	echo "<p>".t("ALREADY_LOGGED_IN")."</p>";
} else {
	echo "<h1>".t("LOGIN")."</h1>";
	echo '<article>';
	include("login.php");
	echo '</article>';
}
