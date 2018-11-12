<?php

$newitem = new Item($_SESSION["articlenumber"],$_POST["strapcolor"],$_POST["watchcolor"],1);
$cart = $_SESSION["cart"];
$cart->addItem($newitem);

?>
<form  method="post" id="payment_form" onsubmit="return confirm('This is a binding contract of purchase. Do you want to continue?');" action="index.php?id=5&lang=<?php echo $_GET["lang"]?>">
	<h3><?php echo t("ENTER_DATA")?></h3>
	<p>
		<label><?php echo t("NAME")?>:</label>
		<input name="name" required pattern="^[A-Za-zäöü ,.'-]{3,}$" value="<?php echo $_COOKIE['name'] ?? "";?>"/>
	</p>
	<p>
		<label><?php echo t("EMAIL")?>:</label>
		<input name="email" type="email" required value="<?php echo $_COOKIE['email'] ?? "";?>"/>
	</p>
	<p>
		<label><?php echo t("ADDRESS")?>:</label>
	</p>
	<p>
		<label><?php echo t("STREET")?>:</label>
		<input name="street" type="text" required pattern="^[A-Za-zäöü ,.'-]{3,}$" value="<?php echo $_COOKIE['street'] ?? "";?>"/>
	</p>
	<p>
		<label><?php echo t("NUMBER")?>:</label>
		<input name="str_nr" type="text" required pattern="^[0-9a-z]+$" value="<?php echo $_COOKIE['streetnr'] ?? "";?>"/>
	</p>
	<p>
		<label><?php echo t("ZIP")?>:</label>
		<input name="zip" type="text" required pattern="^[0-9]{1,5}$" value="<?php echo $_COOKIE['zip'] ?? "";?>"/>
	</p>
	<p>
		<label><?php echo t("CITY")?>:</label>
		<input name="city" type="text" required pattern="^[A-Za-zäöü ,.'-]{3,}$" value="<?php echo $_COOKIE['city'] ?? "";?>"/>
	</p>
	<p>
		<label><?php echo t("COUNTRY")?>:</label>
		<select name="country">
			<option value="ch" selected><?php echo t("CH")?></option>
			<option value="de"><?php echo t("DE")?></option>
			<option value="at"><?php echo t("AT")?></option>
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
		<button value="Submit" type="submit">Submit</button>
	</p>
</form>
