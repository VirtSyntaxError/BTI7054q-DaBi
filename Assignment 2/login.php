<!DOCTYPE html>
<?php require_once("i18n.php");?>
<h1><?php echo t("PLEASE_LOG_IN")?></h1>
<form method="post" action="admin.php?id=100&lang="<?php $_GET['lang']?>>
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