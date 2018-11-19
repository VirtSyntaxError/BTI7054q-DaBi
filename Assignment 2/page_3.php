<?php
require_once("autoloader.php");

$articlenumber = $_POST["articlenumber"];
$_SESSION["articlenumber"] = $articlenumber;
$colorproducts = ColorProduct::getColorByProductId($articlenumber);
$strapproducts = StrapProduct::getStrapByProductId($articlenumber);
$prod = Product::getProductById($articlenumber);
$categories = array();
	$brand = Brand::getBrandById($prod->getBrand());
	$categoryproducts = CategoryProduct::getCategoryByProductId($prod->getID());
	foreach ($categoryproducts as $categoryproduct){
		$category = Category::getCategoryById($categoryproduct->getCategoryId());
		$categories[] = $category->getName();
	}

echo "<article><h1>".t("CUSTOMIZEPROD")."</h1></article>";
	echo $prod->getName();
	echo "<ul>";
	echo "<li> ".t("ARTICLENUMBER").": ".$prod->getID()."</li>";
	echo "<li> ".t("BRAND").": ".$brand->getName()."</li>";
	echo "<li> ".t("CATEGORY").": ".join(",",$categories)."</li>";
	echo "<li> ".t("PRICE").": ".$prod->getPrice()."</li>";
	echo "</ul>";

echo '<article><form method="post" action="index.php?id=6&lang='.$_GET["lang"].'">';
echo '<h2>'.t("STRAPCOLOR").'</h2>';
foreach ($strapproducts as $strapproduct){
	$strapid = $strapproduct->getStrapId();
	$strap = Strap::getStrapById($strapid);
	echo '<input type="radio" name="strapcolor" value="'.$strap->getId().'" required>'.$strap->getName().'<br/>';
}
echo '<h2>'.t("WATCHCOLOR").'</h2>';
foreach ($colorproducts as $colorproduct){
	$colorid = $colorproduct->getColorId();
	$color = Color::getColorById($colorid);
	echo '<input type="radio" name="watchcolor" value="'.$color->getId().'" required>'.$color->getName().'<br/>';
}
echo '<br/><input type="submit" value="'.t("TOCART").'">';
echo '</form></article><br/>';

