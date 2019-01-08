<?php

require_once("autoloader.php");

if(isset($_SESSION['user'])){
	$user = User::getUserByUsername($_SESSION['user']);
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

echo '<article>';
echo '<h3>'.t("ENTER_DATA").'</h3>';

$form = new RegistrationForm((bool) false, "index.php?id=5", "SUBMIT");
if(isset($user)) {
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
