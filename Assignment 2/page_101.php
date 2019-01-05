<?php
require_once("i18n.php");
require_once("autoloader.php");

$logged_in = $_SESSION["user"] ?? false;
if ($logged_in){
	echo '<article>';
	echo "<p>".t("ALREADY_LOGGED_IN")."</p>";
	echo '</article>';
} else {
	echo "<article><h1>".t("REGISTER")."</h1>";


	if (isset($_POST["email"])){
		$_POST["pw"] = password_hash($_POST["pw"], PASSWORD_BCRYPT);
		$_POST["prename"] = htmlspecialchars($_POST["prename"]);
		$_POST["surname"] = htmlspecialchars($_POST["surname"]);
		$_POST["address"] = htmlspecialchars($_POST["address"]);
		$_POST["city"] = htmlspecialchars($_POST["city"]);
		$res = User::insert($_POST);
		if ($res){
			echo t("SUCCESSFUL_REGISTRATION");
		} else {
			echo t("ERROR_REGISTRATION");
		}
	} else {
		$columns = array("","");	
		$rows = array();

		$rows[] = array(t("PRENAME"),'<input name="prename" required pattern="^[A-Za-zäöü ,.\'-]{3,}$" autofocus>');
		$rows[] = array(t("SURNAME"),'<input name="surname" required pattern="^[A-Za-zäöü ,.\'-]{3,}$">');
		$rows[] = array(t("PASSWORD"),'<input type="password" name="pw">');
		$rows[] = array(t("EMAIL"),'<input id="email" type="email" name="email">');
		$rows[] = array(t("ADDRESS"),'<input name="address" required  pattern="^[A-Za-zäöü ,.\'-]{3,} [0-9a-z]+$">');
		$rows[] = array(t("CITY"),'<input name="city" required pattern="^[A-Za-zäöü ,.\'-]{3,}$">');
		$rows[] = array(t("ZIP"),'<input name="zip" required pattern="^[0-9]{1,5}$">');
		$rows[] = array(t("COUNTRY"),'
		<select name="country">
			<option value="CH" selected>'.t("CH").'</option>
			<option value="DE">'.t("DE").'</option>
			<option value="AT">'.t("AT").'</option>
		</select>');
		$rows[] = array('','<label id="emailexists"></label>');
		$rows[] = array("",'<input type="submit" value="'.t("REGISTER").'">');

		$table = new Table($rows,$columns);

		echo '<form method="post" onsubmit="return confirmPurchase(document.getElementById(\'email\').value,\'\')" action="index.php?id=101">';

		$table->render();
	
		echo '</form></article>';
	}
}
