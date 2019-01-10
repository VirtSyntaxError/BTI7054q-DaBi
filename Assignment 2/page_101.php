<?php
require_once("i18n.php");
require_once("autoloader.php");

$logged_in = $_SESSION["user"] ?? false;
if ($logged_in){
	echo '<article>';
	echo "<p>".t("ALREADY_LOGGED_IN")."</p>";
	echo '</article>';
} else {
	echo "<article>";
	echo '<div class="outercart">';
	echo '<div class="cardfull">';
	echo "<h1>".t("REGISTER")."</h1>";

	if (isset($_POST["username"])){

		if(User::getUserByUsername($_POST["username"])) {
			$t = time()+60*60*24*30;
			setcookie("prename", $_POST["prename"], $t, "/");
			setcookie("surname", $_POST["surname"], $t, "/");
			setcookie("email", $_POST["email"], $t, "/");
			setcookie("address", $_POST["address"], $t, "/");
			setcookie("zip", $_POST["zip"], $t, "/");
			setcookie("city", $_POST["city"], $t, "/");
			setcookie("country", $_POST["country"], $t, "/");
			header('Location: index.php?id=101&error=USEREXISTS');	
		} else {
			$_POST["pw"] = password_hash($_POST["pw"], PASSWORD_BCRYPT);
			$_POST["prename"] = htmlspecialchars($_POST["prename"]);
			$_POST["surname"] = htmlspecialchars($_POST["surname"]);
			$_POST["username"] = htmlspecialchars($_POST["username"]);
			$_POST["address"] = htmlspecialchars($_POST["address"]);
			$_POST["city"] = htmlspecialchars($_POST["city"]);
			$res = User::insert($_POST);
			if ($res){
				echo t("SUCCESSFUL_REGISTRATION");
			} else {
				echo t("ERROR_REGISTRATION");
			}
		}
	} else {

		$form = new RegistrationForm((bool) false,"index.php?id=101","REGISTER"); 
		$form->setOnSubmit("return confirmPurchase(document.getElementsByName('username')[0].value,''");
		$form->setSubmitNotInTable((bool) true);
		$form->render();
	}
	echo '</div>';
	echo '</div>';
	echo '</article>';
}
