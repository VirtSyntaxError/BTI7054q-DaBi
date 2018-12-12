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


	echo t("PLEASE_LOG_IN");

	$columns = array("","");	
	$rows = array();

	$rows[] = array(t("LOGIN"),'<input name="login">');
	$rows[] = array(t("PASSWORD"),'<input type="password" name="pw">');
	$rows[] = array("",'<input type="submit" value="'.t("LOGIN").'">');

	$table = new Table($rows,$columns);
	
	echo '<form method="post" action="authentication.inc.php">';

	$table->render();

	echo '</form></article>';

}
