<?php
require_once("i18n.php");
require_once("autoloader.php");

$logged_in = $_SESSION["user"] ?? false;
if ($logged_in){
	echo "<p>".t("ALREADY_LOGGED_IN")."</p>";
	exit;
} else {
	echo "<article><h1>".t("REGISTER")."</h1>";


	if (isset($_POST["email"])){
		$_POST["pw"] = password_hash($_POST["pw"], PASSWORD_BCRYPT);
		$res = User::insert($_POST);
		if ($res){
			echo t("SUCCESSFUL_REGISTRATION");
		} else {
			echo t("ERROR_REGISTRATION");
		}
	} else {
		$columns = array("","");	
		$rows = array();

		$rows[] = array(t("PRENAME"),'<input name="prename">');
		$rows[] = array(t("SURNAME"),'<input name="surname">');
		$rows[] = array(t("PASSWORD"),'<input type="password" name="pw">');
		$rows[] = array(t("EMAIL"),'<input id="email" type="email" name="email">');
		$rows[] = array('','<label id="emailexists"></label>');
		$rows[] = array(t("ADDRESS"),'<input name="address">');
		$rows[] = array(t("CITY"),'<input name="city">');
		$rows[] = array(t("ZIP"),'<input name="zip">');
		$rows[] = array(t("COUNTRY"),'
		<select name="country">
			<option value="CH" selected>'.t("CH").'</option>
			<option value="DE">'.t("DE").'</option>
			<option value="AT">'.t("AT").'</option>
		</select>');
		$rows[] = array("",'<input type="submit" value="'.t("REGISTER").'">');

		$table = new Table($rows,$columns);

		echo '<form method="post" onsubmit="return confirmPurchase(document.getElementById(\'email\').value,\'\')" action="index.php?id=101">';

		$table->render();
	
		echo '</form></article>';
	}
}
