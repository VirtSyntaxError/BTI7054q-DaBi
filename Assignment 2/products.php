<?php
include_once("i18n.php");
include_once("functions.php");
$products = Product::getProducts();
echo "<ul>";
foreach ($product_array as $articlenumber => $product){
	echo '<form method="post" action="index.php?id=3&lang='.$_GET['lang'].'">';
	echo "<li>".$product["name"];
	echo "<ul>";
	echo "<li> ".t("ARTICLENUMBER").": ".$articlenumber."</li>";
	echo "<li> ".t("SEX").": ".$product["sex"]."</li>";
	echo "<li> ".t("PRICE").": ".$product["price"]."</li>";
	echo "<li> ".t("CATEGORY").": ".$product["cat"]."</li>";
	echo "<li> ".t("BRAND").": ".$product["brand"]."</li>";
	echo "</ul>";
	echo "</li>";
	echo '<input type="hidden" name="articleid" value="'.$articlenumber.'">';
	echo '<input type="submit" value="'.t("BUY").'">';
	echo '</form>';
}
echo "</ul>";


echo "<ul>";
foreach ($products as $prod){
	echo '<form method="post" action="index.php?id=3&lang='.$_GET['lang'].'">';
	echo "<li>".$prod->getName();
	echo "<ul>";
	echo "<li> ".t("ARTICLENUMBER").": ".$prod->getID()."</li>";
	echo "<li> ".t("BRAND").": ".$prod->getBrand()."</li>";
	echo "</ul>";
	echo "</li>";
	echo '<input type="hidden" name="articleid" value="'.$prod->getID().'">';
	echo '<input type="submit" value="'.t("BUY").'">';
	echo '</form>';
}
echo "</ul>";