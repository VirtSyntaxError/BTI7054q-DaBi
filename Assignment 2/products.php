<?php
include_once("i18n.php");
include_once("functions.php");
include_once("autoloader.php");
$products = array();
if (isset($_GET["brand"])) {
	$brandid = $_GET["brand"];
	if ($brandid != "all") {
		$brandname = Brand::getBrandById($brandid)->getName();	

		$products = Product::getProductsByBrandId($brandid);
		if (!isset($_GET["filter"])) {
			echo '<h1>'.t("PRODUCTOFBRAND").' '.$brandname.'</h1>';
		}
	} elseif (!isset($_GET["filter"])) {
		echo '<h1>'.t("ALLBRANDS").'</h1>';
	}
}
elseif (isset($_GET["cat"])) {
	$catid = $_GET["cat"];
	if ($catid != "all") {
		$catname = Category::getCategoryById($catid)->getName();	
		$productids = CategoryProduct::getProductByCategoryId($catid);
		foreach ($productids as $productid) {
			$products[] = Product::getProductById($productid->getProductId());
		}
		if (!isset($_GET["filter"])) {
			echo '<h1>'.t("PRODUCTOFCAT").' '.$catname.'</h1>';
		}
	} elseif (!isset($_GET["filter"])) {
		echo '<h1>'.t("ALLCATS").'</h1>';
	}
}

if (count($products) <= 0) {
	$products = Product::getProducts();
}

if (isset($_GET["filter"])) {
	$filter = $_GET["filter"];
	if ($filter) {
		$newproducts = array();

		foreach ($products as $prod) {
			if(stripos($prod->getName(),$filter) || stripos($prod->getDescription(),$filter) ) {
				$newproducts[] = $prod;
			}
		}
		$products = $newproducts;
	}
} else {
	echo '<input id="filter" onkeyup="applyFilter()" name="filter" placeholder="Filter.."><br>';	
	echo '<ul><article id="productoutput">';
}


foreach ($products as $prod){
	$categories = array();
	$brand = Brand::getBrandById($prod->getBrand());
	$categoryproducts = CategoryProduct::getCategoryByProductId($prod->getID());
	foreach ($categoryproducts as $categoryproduct){
		$category = Category::getCategoryById($categoryproduct->getCategoryId());
		$categories[] = $category->getName();
	}

	echo '<form method="post" action="index.php?id=3&lang='.$_GET['lang'].'">';
	echo '<article>';
	echo '<li>'.$prod->getName();
	echo "<ul>";
	echo "<li> ".t("ARTICLENUMBER").": ".$prod->getID()."</li>";
	echo "<li> ".t("BRAND").": ".$brand->getName()."</li>";
	echo "<li> ".t("CATEGORY").": ".join(",",$categories)."</li>";
	echo "<li> ".t("PRICE").": ".$prod->getPrice()."</li>";
	echo "</ul>";
	echo "</li>";
	echo '<input type="hidden" name="articlenumber" value="'.$prod->getID().'">';
	echo '<input type="submit" value="'.t("DETAILS").'">';
	echo '</form></article>';
}

if (!isset($_GET["filter"])) {
	echo '</ul></article>';
}
