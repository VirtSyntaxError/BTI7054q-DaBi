<?php

require_once("autoloader.php");

echo '<article>';
echo '<h3>'.t("ENTER_DATA").'</h3>';

$form = new RegistrationForm((bool) false, "index.php?id=5", "SUBMIT");
if(isset($SESSION['user'])) {
	$form->setReadonly((bool) true);
}
$form->setShowUser((bool) false);
$form->setOnSubmit("return confirm('".t("BINDINGCONTRACT")."');");

$form->addAdditionalRow(array(t("SHIPPING_METHOD"),'<select name="shipping_method">
			<option value="standard" selected>'.t("STANDARD").'</option>
			<option value="express">'.t("EXPRESS").'</option>
			<option value="pickup">'.t("PICKUP").'</option>
		</select>'));
$form->addAdditionalRow(array(t("GIFT"),'<input name="giftbox" type="checkbox" value="giftbox"/>'));
$form->addAdditionalRow(array('','<textarea name="comment" placeholder="'.t("ENTER_COMMENT").'"></textarea>'));

$form->render();

echo '</article>';
