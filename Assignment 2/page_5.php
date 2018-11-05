<?php
	$t = time()+60*60*24*30;
	setcookie("name", $_POST["name"], $t);
	setcookie("email", $_POST["email"], $t);
	setcookie("street", $_POST["street"], $t);
	setcookie("streetnr", $_POST["str_nr"], $t);
	setcookie("zip", $_POST["zip"], $t);
	setcookie("city", $_POST["city"], $t);
?>
<h1><?php echo t("CONFIRMATION")?></h1>
<p>ProductInfo blabla</p>
<p><?php echo t("ADDRESS")?>:</p>
<p><?php echo $_POST["name"]?></p>
<p><?php echo $_POST["street"]." ".$_POST["str_nr"]?></p>
<p><?php echo $_POST["zip"]." ".$_POST["city"]?></p>
<input type="submit" value="OK"/>
