<?php
session_start();
$logged_in = $_SESSION["user"] ?? false;
if ($logged_in){
	echo "<p>".t("ALREADY_LOGGED_IN")."</p>";
	exit;
}
echo "<article><h1>".t("LOGIN")."</h1></article>";
include("login.php");