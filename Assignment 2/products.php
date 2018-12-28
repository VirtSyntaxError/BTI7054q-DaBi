<?php
include_once("i18n.php");
include_once("functions.php");
include_once("autoloader.php");

if(!isset($_SESSION)){ 
	session_start(); 
}
$lang = $_SESSION["lang"];

$products = array();
if (isset($_GET["brand"])) {
	$brandid = $_GET["brand"];
	if ($brandid != "all") {
		$brand = Brand::getBrandById($brandid);

		if($brand) {
			$brandname = $brand->getName();	

			$products = Product::getProductsByBrandId($brandid,$lang);
			if (!isset($_GET["filter"])) {
				echo '<article><h1>'.t("PRODUCTOFBRAND").' '.$brandname.'</h1>';
			}
		}
	} elseif (!isset($_GET["filter"])) {
		echo '<article><h1>'.t("ALLBRANDS").'</h1>';
	}
}
elseif (isset($_GET["cat"])) {
	$catid = $_GET["cat"];
	if ($catid != "all") {
		$cat = Category::getCategoryById($catid,$lang);

		if($cat) {
			$catname = $cat->getName();	
			$productids = CategoryProduct::getProductByCategoryId($catid);
			foreach ($productids as $productid) {
				$products[] = Product::getProductById($productid->getProductId(),$lang);
			}
			if (!isset($_GET["filter"])) {
				echo '<article><h1>'.t("PRODUCTOFCAT").' '.$catname.'</h1>';
			}
		}
	} elseif (!isset($_GET["filter"])) {
		echo '<article><h1>'.t("ALLCATS").'</h1>';
	}
}

if (count($products) <= 0) {
	$products = Product::getProducts($lang);
}

if (isset($_GET["filter"])) {
	$filter = $_GET["filter"];
	if ($filter) {
		$newproducts = array();

		foreach ($products as $prod) {
			if(stripos($prod->getName(),$filter) !== false || stripos($prod->getDescription(),$filter) !== false ) {
				$newproducts[] = $prod;
			}
		}
		$products = $newproducts;
	}
} else {
	echo '<article><input id="filter" onkeyup="applyFilter()" name="filter" placeholder=""><br>';	
	echo '<article id="productoutput">';
}

$pgrid = new ProductGrid($lang, ...$products);
$pgrid->render();	

if (!isset($_GET["filter"])) {
	echo '</article></article>';
}
