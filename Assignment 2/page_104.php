<?php
require_once("autoloader.php");
require_once("functions.php");
echo '<article><h1>'.t("MYORDERS").'</h1>';
$orders = Purchase::getPurchaseByUserId(User::getUserByEmail($_SESSION['user'])->getUserId());

if(count($orders) == 0) {
	echo t("NOORDERS");
} else {
	$columns = array("Ordernr","Date","Description","Status");
	$rows = array();
	foreach ($orders as $order){
		$details = PurchaseDetail::getPurchaseDetailsByPurchaseId($order->getId());		
		$rows[] = array($order->getId(),date("H:i d.m.Y",$order->getTimestamp()),$order->getDescription(),$order->getStatus());		

		foreach ($details as $detail) {
			$product = Product::getProductById($detail->getProductId(),$lang);
			$color = Color::getColorById($detail->getColorId(),$lang);
			$strap = Strap::getStrapById($detail->getStrapId(),$lang);
			$productdesc = $detail->getCount()."x ".$product->getName()." (".$strap->getName().", ".$color->getName().")";
			$rows[] = array($productdesc,$product->getPrice(),"","");
		}	
	}
	$table = new Table($rows,$columns);
	$table->render();
}
echo '</article>';
