<?php
require_once("autoloader.php");

$articlenumber = $_POST["articlenumber"];
$cart = $_SESSION["cart"];
$cart->addItem($articlenumber,1);
$colorproducts = ColorProduct::getColorByProductId($articlenumber);
$strapproducts = StrapProduct::getStrapByProductId($articlenumber);
echo "<article><h1>".t("CUSTOMIZEPROD")."</h1></article>";
echo '<article><form method="post" action="index.php?id=4&lang='.$_GET["lang"].'">';
echo '<h2>'.t("STRAPCOLOR").'</h2>';
foreach ($strapproducts as $strapproduct){
	$strapid = $strapproduct->getStrapId();
	$strap = Strap::getStrapById($strapid);
	echo '<input type="radio" name="strapcolor" value="'.$strap->getName().'" required>'.$strap->getName().'<br/>';
}
echo '<h2>'.t("WATCHCOLOR").'</h2>';
foreach ($colorproducts as $colorproduct){
	$colorid = $colorproduct->getColorId();
	$color = Color::getColorById($colorid);
	echo '<input type="radio" name="watchcolor" value="'.$color->getName().'" required>'.$color->getName().'<br/>';
}
echo '<br/><input type="submit" value="'.t("SUBMIT").'">';
echo '</form></article><br/>';

