<form  method="post" id="payment_form" action="index.php?id=5">
	<h3><?php echo t("ENTER_DATA")?></h3>
	<p>
		<label><?php echo t("NAME")?>:</label>
		<input name="name" required/>
	</p>
	<p>
		<label><?php echo t("EMAIL")?>:</label>
		<input name="email" type="email" required/>
	</p>
	<p>
		<label><?php echo t("ADDRESS")?>:</label>
	</p>
	<p>
		<label><?php echo t("STREET")?>:</label>
		<input name="street" type="text" required/>
	</p>
	<p>
		<label><?php echo t("NUMBER")?>:</label>
		<input name="str_nr" type="text" required/>
	</p>
	<p>
		<label><?php echo t("ZIP")?>:</label>
		<input name="zip" type="text" required/>
	</p>
	<p>
		<label><?php echo t("CITY")?>:</label>
		<input name="city" type="text" required/>
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
		<input type="submit" value="Submit"/>
	</p>
</form>
