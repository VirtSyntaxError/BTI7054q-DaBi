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
		$brandname = Brand::getBrandById($brandid)->getName();	

		$products = Product::getProductsByBrandId($brandid,$lang);
		if (!isset($_GET["filter"])) {
			echo '<article><h1>'.t("PRODUCTOFBRAND").' '.$brandname.'</h1>';
		}
	} elseif (!isset($_GET["filter"])) {
		echo '<article><h1>'.t("ALLBRANDS").'</h1>';
	}
}
elseif (isset($_GET["cat"])) {
	$catid = $_GET["cat"];
	if ($catid != "all") {
		$catname = Category::getCategoryById($catid,$lang)->getName();	
		$productids = CategoryProduct::getProductByCategoryId($catid);
		foreach ($productids as $productid) {
			$products[] = Product::getProductById($productid->getProductId(),$lang);
		}
		if (!isset($_GET["filter"])) {
			echo '<article><h1>'.t("PRODUCTOFCAT").' '.$catname.'</h1>';
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
	echo '<article><input id="filter" onkeyup="applyFilter()" name="filter" placeholder="Filter.."><br>';	
	echo '<article id="productoutput">';
}


	echo '<table>';
	echo '<tr>';
	$count = 0;
foreach ($products as $prod){
	$categories = array();
	$brand = Brand::getBrandById($prod->getBrand());
	$categoryproducts = CategoryProduct::getCategoryByProductId($prod->getID());
	foreach ($categoryproducts as $categoryproduct){
		$category = Category::getCategoryById($categoryproduct->getCategoryId(),$lang);
		$categories[] = $category->getName();
	}
	echo '<td>';
	echo '<form method="post" action="index.php?id=3">';
	echo '<div class="card">';
  	echo '<img src="img/'.$prod->getImage().'" alt="'.$prod->getName().'">';
  	echo '<h1>'.$prod->getName().'</h1>';
  	echo '<p class="price">'.$prod->getPrice().'.-</p>';
  	echo '<p>'.join(", ",$categories).'</p>';
	echo '<input type="hidden" name="articlenumber" value="'.$prod->getID().'">';
  	echo '<p><input type="submit" value="'.t("DETAILS").'"></p>';
	echo '</div>';
	echo '</form>';
	echo '<td>';
	$count++;

	if ($count >= 4) {
		echo '</tr><tr>';
		$count = 0;
	}
}

	echo '</tr></table>';

if (!isset($_GET["filter"])) {
	echo '</article></article>';
}
