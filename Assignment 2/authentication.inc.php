<?php
require_once("i18n.php");
require_once("autoloader.php");
function checklogin($login, $password){
	$db = DB::getInstance();
	$stmt = $db->prepare(
		"SELECT * FROM Users WHERE Email=?"
	);
	$stmt->bind_param('s', $login);
	$stmt->execute();
	$result = $stmt->get_result();
	if (!$result || $result->num_rows !== 1){
		return false;
	}
	$row = $result->fetch_assoc();
	return [password_verify($password, $row["Password"]),$row["isAdmin"]];
}

if(!isset($_SESSION)){ 
	session_start(); 
}

if (isset($_POST["login"]) && isset($_POST["pw"])){
	$login = $_POST["login"];
	$pw = $_POST["pw"];
	$chklogin = checklogin($login, $pw);
	$ok = $chklogin[0];
	$isAdmin = false;
	if ($chklogin[1] == 1){
		$isAdmin = true;
	}
	if ($ok){
		$_SESSION["user"] = $login;
		if ($isAdmin){
			$_SESSION["isAdmin"] = true;	
		}
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