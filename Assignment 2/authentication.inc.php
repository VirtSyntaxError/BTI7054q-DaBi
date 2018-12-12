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
			header('Location: admin/showOrders/?lang='.$_GET["lang"]);
		} else {
			header('Location: index.php?id=1&lang='.$_GET["lang"]);
		}
	} else {
		header('Location: index.php?id=103&lang='.$_GET["lang"]);
		exit;
	}
}
if (!isset($_SESSION["user"])){
	echo "<!DOCTYPE html>\n";
	echo '<a href="index.php?id=100&lang="'.$_GET["lang"].'>'.t("PLEASE_LOG_IN").'</a>.';
	exit;
}
