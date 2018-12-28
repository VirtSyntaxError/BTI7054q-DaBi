<?php
include_once("i18n.php");
include_once("functions.php");
include_once("autoloader.php");

echo '<article><h1>'.t("TODAYSOFFER").'</h1>';

$lang = $_SESSION["lang"];
$products = Product::getProductsOnOffer($lang);

$pgrid = new ProductGrid($lang, ...$products);
$pgrid->render();	

echo '</article>';
