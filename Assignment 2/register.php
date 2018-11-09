<!DOCTYPE html>
<?php
	require_once("i18n.php");
	require_once("autoloader.php");
	if (isset($_POST["email"])){
		$_POST["pw"] = password_hash($_POST["pw"], PASSWORD_BCRYPT);
		$res = User::insert($_POST);
		if ($res){
			echo t("SUCCESSFUL_REGISTRATION");
		} else {
			echo t("ERROR_REGISTRATION");
		}
		exit;
	}
?>
<form method="post" action="index.php?id=101&lang="<?php $_GET['lang']?>>
	<p>
		<label><?php echo t("PRENAME"); ?></label>
		<input name="prename">
	</p>
	<p>
		<label><?php echo t("SURNAME"); ?></label>
		<input name="surname">
	</p>
	<p>
		<label><?php echo t("PASSWORD"); ?></label>
		<input type="password" name="pw">
	</p>
	<p>
		<label><?php echo t("EMAIL"); ?></label>
		<input name="email">
	</p>
	<p>
		<label><?php echo t("ADDRESS"); ?></label>
		<input name="address">
	</p>
	<p>
		<label><?php echo t("CITY"); ?></label>
		<input name="city">
	</p>
	<p>
		<label><?php echo t("ZIP"); ?></label>
		<input name="zip">
	</p>
	<p>
		<label><?php echo t("COUNTRY"); ?></label>
		<input name="country">
	</p>
	<p>
		<input type="submit" value='<?php echo t("REGISTER");?>'>
	</p>
</form>
