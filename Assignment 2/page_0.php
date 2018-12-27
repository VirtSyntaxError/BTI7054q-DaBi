<?php
include_once("i18n.php");
include_once("functions.php");
include_once("autoloader.php");

echo '<article id="productoutput"><h1>'.t("TODAYSOFFER").'</h1>';

echo '<table>';
echo '<tr>';

$lang = $_SESSION["lang"];
$products = Product::getProductsOnOffer($lang);

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
	echo '<p>';
	echo '<form method="post" action="index.php?id=3">';
	echo '<div class="card">';
  	echo '<img src="img/'.$prod->getImage().'" alt="'.$prod->getName().'">';
  	echo '<h1>'.$prod->getName().'</h1>';
	if($prod->getOffer()) {
  		echo '<p class="priceoffer">'.round($prod->getPrice()*0.01*(100-$prod->getDiscount())).'.- <s>'.$prod->getPrice().'.-</s></p>';
	} else {
  		echo '<p class="price">'.$prod->getPrice().'.-</p>';
	}
  	echo '<p>'.join(", ",$categories).'</p>';
  	echo '<p class="desc">'.$prod->getDescription().'</p>';
	echo '<input type="hidden" name="articlenumber" value="'.$prod->getID().'">';
  	echo '<input type="submit" value="'.t("DETAILS").'">';
	echo '</div>';
	echo '</form>';
	echo '</p>';
	$count++;

	if ($count >= 4) {
		echo '</tr><tr>';
		$count = 0;
	}
}

echo '</tr></table>';
echo '</article>';
