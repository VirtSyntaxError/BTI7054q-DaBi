<?php
require_once("autoloader.php");
	$t = time()+60*60*24*30;
	setcookie("name", $_POST["name"], $t);
	setcookie("email", $_POST["email"], $t);
	setcookie("address", $_POST["address"], $t);
	setcookie("zip", $_POST["zip"], $t);
	setcookie("city", $_POST["city"], $t);
	if (!isset($_SESSION['user'])){
		echo t("PLEASE_LOG_IN");
		exit;
	};
	$purch = Purchase::insert(array(
							"PurchaseTimestamp" => time(),
							"Description" => $_POST["comment"],
							"PurchaseStatus" => 'open',
							"UserID" => $_SESSION["userID"]));
	if (!$purch){
		echo "ERROR inserting purchase to DB<br>";
		exit;
	}
	$items = $_SESSION['cart']->getItems();
	foreach ($items as $it){
		PurchaseDetail::insert(array(
							"Count" => $it->getCount(),
							"ProductID" => $it->getProductId(),
							"ColorID" => $it->getColorId(),
							"StrapID" => $it->getStrapId(),
							"PurchaseID" => $purch[1]));
	}
?>
<article>
<h1><?php echo t("CONFIRMATION")?></h1>
<p><?php echo t("PRODUCTINFORMATION")?>:</p>
<p>
<?php 
	$cart->render(true);
	$_SESSION['cart']->deleteAll();
?></p>
<p><?php echo t("ADDRESS")?>:</p>
<p><?php echo $_POST["name"]?></p>
<p><?php echo $_POST["address"] ?></p>
<p><?php echo $_POST["zip"]." ".$_POST["city"]?></p>
</article>
