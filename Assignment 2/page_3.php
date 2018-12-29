<?php
require_once("autoloader.php");

if(!isset($_SESSION)){ 
	session_start(); 
}
$lang = $_SESSION["lang"];
$articlenumber = $_POST["articlenumber"];
$_SESSION["articlenumber"] = $articlenumber;
$prod = Product::getProductById($articlenumber, $lang);

echo '<article><h1>'.t("CUSTOMIZEPROD").'</h1>';
echo '<div class="flex-container">';
$pcard = new ProductCard($prod, $lang);
$pcard->renderDetails();



$pcard->renderOptions();

echo '</div></article>';

