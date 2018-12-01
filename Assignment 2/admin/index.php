<?php

require_once("autoloader.php");
include "../authentication.inc.php";

$adm = $_SESSION["isAdmin"] ?? false;
if (!$adm) {
	echo '<p>You need to be admin to view this page</p>';
} elseif (isset($_GET['controller'])) {

	$controller = new $_GET['controller']();

	if (isset($_GET['action'])) {
		$controller->{$_GET['action']}();
	}

}

?>
