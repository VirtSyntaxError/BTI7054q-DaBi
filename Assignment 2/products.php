<?php
include_once("i18n.php");
include_once("functions.php");
$products = Product::getProducts();

echo "<ul>";
foreach ($products as $prod){
	$categories = array();
	$brand = Brand::getBrandById($prod->getBrand());
	$categoryproducts = CategoryProduct::getCategoryByProductId($prod->getID());
	foreach ($categoryproducts as $categoryproduct){
		$category = Category::getCategoryById($categoryproduct->getCategoryId());
		$categories[] = $category->getName();
	}
	
	echo '<form method="post" action="index.php?id=3&lang='.$_GET['lang'].'">';
	echo "<li>".$prod->getName();
	echo "<ul>";
	echo "<li> ".t("ARTICLENUMBER").": ".$prod->getID()."</li>";
	echo "<li> ".t("BRAND").": ".$brand->getName()."</li>";
	echo "<li> ".t("CATEGORY").": ".join(",",$categories)."</li>";
	echo "<li> ".t("PRICE").": ".$prod->getPrice()."</li>";
	echo "</ul>";
	echo "</li>";
	echo '<input type="hidden" name="articlenumber" value="'.$prod->getID().'">';
	echo '<input type="submit" value="'.t("BUY").'">';
	echo '</form>';
}
echo "</ul>";
