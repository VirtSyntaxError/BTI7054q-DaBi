<?php

require_once("autoloader.php");

if(isset($_SESSION['user'])){
	$user = User::getUserByEmail($_SESSION['user']);
	$prename = $user->getPrename();
	$surname = $user->getSurname();
	$email = $user->getEmail();
	$address = $user->getAddress();
	$zip = $user->getZip();
	$city = $user->getCity();
	$country = $user->getCountry();

} else {
	$prename = $_COOKIE['prename'] ?? "";
	$surname = $_COOKIE['surname'] ?? "";
	$email = $_COOKIE['email'] ?? "";
	$address = $_COOKIE['address'] ?? "";
	$zip = $_COOKIE['zip'] ?? "";
	$city = $_COOKIE['city'] ?? "";
	$country = $_COOKIE['country'] ?? "";
}

?>
<article>
<form  method="post" id="payment_form" onsubmit="return confirmPurchase(document.getElementById('email').value,'<?php echo t("BINDINGCONTRACT")?>');" action="index.php?id=5">
	<h3><?php echo t("ENTER_DATA")?></h3>
	<p>
		<label><?php echo t("PRENAME")?>:</label>
		<input name="prename" required pattern="^[A-Za-zäöü ,.'-]{3,}$" value="<?php echo $prename ?>"/>
	</p>
	<p>
		<label><?php echo t("SURNAME")?>:</label>
		<input name="surname" required pattern="^[A-Za-zäöü ,.'-]{3,}$" value="<?php echo $surname ?>"/>
	</p>
	<p>
		<label><?php echo t("EMAIL")?>:</label>
		<input id="email" name="email" type="email" required value="<?php echo $email ?>"/>
	</p>
	<p>
		<label id="emailexists"></label>
	</p>
	<p>
		<label><?php echo t("ADDRESS")?>:</label>
		<input name="address" type="text" required pattern="^[A-Za-zäöü ,.'-]{3,} [0-9a-z]+$" value="<?php echo $address ?>"/>
	</p>
	<p>
		<label><?php echo t("ZIP")?>:</label>
		<input name="zip" type="text" required pattern="^[0-9]{1,5}$" value="<?php echo $zip ?>"/>
	</p>
	<p>
		<label><?php echo t("CITY")?>:</label>
		<input name="city" type="text" required pattern="^[A-Za-zäöü ,.'-]{3,}$" value="<?php echo $city ?>"/>
	</p>
	<p>
		<label><?php echo t("COUNTRY")?>:</label>
		<select name="country">
			<option value="CH" <?php if ($country=="CH"){echo "selected";}?>><?php echo t("CH")?></option>
			<option value="DE" <?php if ($country=="DE"){echo "selected";}?>><?php echo t("DE")?></option>
			<option value="AT" <?php if ($country=="AT"){echo "selected";}?>><?php echo t("AT")?></option>
		</select>
	</p>
	<p>
		<label><?php echo t("SHIPPING_METHOD")?>:</label>
		<select name="shipping_method">
			<option value="standard" selected><?php echo t("STANDARD")?></option>
			<option value="express"><?php echo t("EXPRESS")?></option>
			<option value="pickup"><?php echo t("PICKUP")?></option>
		</select>
	</p>
	<p>
		<input name="giftbox" type="checkbox" value="giftbox"/><?php echo t("GIFT")?>
	</p>
	<p>
		<textarea name="comment" form="payment_form" placeholder="<?php echo t("ENTER_COMMENT")?>"></textarea>
	</p>
	<p>
		<button value='Submit' type='submit'>Submit</button>
	</p>
</form>
</article>
