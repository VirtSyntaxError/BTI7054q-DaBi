<?php
require_once("autoloader.php");

if(!isset($_SESSION)){ 
	session_start(); 
}
$lang = $_SESSION["lang"];
$articlenumber = $_POST["articlenumber"];
$_SESSION["articlenumber"] = $articlenumber;
$prod = Product::getProductById($articlenumber, $lang);

echo "<article><h1>".t("CUSTOMIZEPROD")."</h1>";
	echo "<article>".$prod->getName()."</article>";
	echo "<ul>";
	echo "<p class='thumb'><img src='img/".$prod->getImage()."'><span><img src='img/".$prod->getImage()."'></span></p>";
	echo "<li> ".t("ARTICLENUMBER").": ".$prod->getID()."</li>";
	echo "<li> ".t("BRAND").": ".$brand->getName()."</li>";
	echo "<li> ".t("CATEGORY").": ".join(",",$categories)."</li>";
	echo "<li> ".t("PRICE").": ".$prod->getPrice()."</li>";
	echo "</ul>";



$pcard->renderOptions();

echo '</div></article>';

