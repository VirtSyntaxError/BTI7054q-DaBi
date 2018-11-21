<!DOCTYPE html>
<?php require_once("i18n.php");?>
<p><?php echo t("PLEASE_LOG_IN")?></p>
<form method="post" action="authentication.inc.php">
	<p>
		<label><?php echo t("LOGIN"); ?></label>
		<input name="login">
	</p>
	<p>
		<label><?php echo t("PASSWORD"); ?></label>
		<input type="password" name="pw">
	</p>
	<p>
		<input type="submit" value="Login">
	</p>
</form>
