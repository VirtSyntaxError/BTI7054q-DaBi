<?php

require_once("autoloader.php");

echo '<article>';
echo '<h3>'.t("ENTER_DATA").'</h3>';

$form = new RegistrationForm((bool) false, "index.php?id=5", "SUBMIT");
if(isset($_SESSION['user'])) {
	$form->setReadonly((bool) true);
	$form->setLoggedIn((bool) true);
}
$form->setShowUser((bool) false);
$form->setOnSubmit("return confirm('".t("BINDINGCONTRACT")."');");

$form->addAdditionalRow(array(t("SHIPPING_METHOD"),'<select name="shipping_method">
			<option value="standard" selected>'.t("STANDARD").'</option>
			<option value="express">'.t("EXPRESS").'</option>
			<option value="pickup">'.t("PICKUP").'</option>
		</select>'));
$form->addAdditionalRow(array(t("GIFT"),'<select name="giftbox">
			<option value="0" selected>'.t("NO").'</option>
			<option value="1">'.t("YES").'</option>
		</select>'));
$form->addAdditionalRow(array('','<textarea name="comment" placeholder="'.t("ENTER_COMMENT").'"></textarea>'));

$form->render();

echo '</article>';
