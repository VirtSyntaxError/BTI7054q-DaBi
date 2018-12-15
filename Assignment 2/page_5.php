<?php
require_once("autoloader.php");
	$t = time()+60*60*24*30;
	setcookie("name", $_POST["name"], $t);
	setcookie("email", $_POST["email"], $t);
	setcookie("address", $_POST["address"], $t);
	setcookie("zip", $_POST["zip"], $t);
	setcookie("city", $_POST["city"], $t);
	if (!isset($_SESSION['user']){
		echo t("PLEASE_LOG_IN");
		exit;
	})
?>
<h1><?php echo t("CONFIRMATION")?></h1>
<article>
<p><?php echo t("PRODUCTINFORMATION")?>:</p>
<p>
<?php 
	$cart->render(true);
?></p>
<p><?php echo t("ADDRESS")?>:</p>
<p><?php echo $_POST["name"]?></p>
<p><?php echo $_POST["address"] ?></p>
<p><?php echo $_POST["zip"]." ".$_POST["city"]?></p>
<input type="submit" value="OK"/>
</article>
