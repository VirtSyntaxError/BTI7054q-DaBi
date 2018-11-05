<?php
require_once("i18n.php");
function checklogin($login, $password){
	$db = DB::getInstance();
	$stmt = $db->prepare(
		"SELECT * FROM User WHERE Email=?"
	);
	$stmt->bind_param('s', $login);
	$stmt->execute();
	$result = $stmt->get_result();
	if (!$result || $result->num_rows !== 1){
		return false;
	}
	$row = $result->fetch_assoc();
	return password_verify($password, $row["Password"]);
}

session_start();


if (isset($_POST["login"]) && isset($_POST["pw"])){
	$login = $_POST["login"];
	$pw = $_POST["pw"];
	if (checklogin($login, $pw)){
		$_SESSION["user"] = $login;
	} else {
		echo "<!DOCTYPE html>\n";
		echo '<a href="login.php">'.t("WRONGPW").'</a>.';
		exit;
	}
}
if (!isset($_SESSION["user"])){
	echo "<!DOCTYPE html>\n";
	echo '<a href="login.php">'.t("PLEASE_LOG_IN").'</a>.';
	exit;
}