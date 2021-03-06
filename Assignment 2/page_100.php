<?php
if(!isset($_SESSION)){ 
	session_start(); 
}
$logged_in = $_SESSION["user"] ?? false;
if ($logged_in){
	echo '<article>';
	echo "<p>".t("ALREADY_LOGGED_IN")."</p>";
	echo '</article>';
} else {
	echo '<article>';
	echo '<div class="outercart">';
	echo '<div class="cardfull">';
	echo "<h1>".t("LOGIN")."</h1>";

	echo t("PLEASE_LOG_IN");

	$columns = array("","");
	$rows = array();

	$rows[] = array(t("USERNAME"),'<input name="login" autofocus required>');
	$rows[] = array(t("PASSWORD"),'<input type="password" name="pw" required>');

	$table = new Table($rows,$columns);
	
	echo '<form method="post" action="authentication.inc.php">';

	$table->render();

	echo '<br />';
	echo '<input type="submit" value="'.t("LOGIN").'">';
	echo '</form>';
	echo '</div>';
	echo '</div>';
	echo '</article>';

}
