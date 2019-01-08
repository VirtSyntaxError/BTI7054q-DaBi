<?php
require_once("autoloader.php");
	$t = time()+60*60*24*30;
	setcookie("prename", $_POST["prename"], $t);
	setcookie("surname", $_POST["surname"], $t);
	setcookie("username", $_POST["username"], $t);
	setcookie("email", $_POST["email"], $t);
	setcookie("address", $_POST["address"], $t);
	setcookie("zip", $_POST["zip"], $t);
	setcookie("city", $_POST["city"], $t);
	setcookie("country", $_POST["country"], $t);
	$userID = 0;
	if (isset($_SESSION["userID"])){
		$userID = $_SESSION["userID"];
	} else {
		$userID = User::insertGuest(array(
						"prename" => $_POST["prename"],
						"surname" => $_POST["surname"],
						"pw" => password_hash("^XvuJJrd=rOd*4", PASSWORD_BCRYPT),
						"email" => $_POST["email"],
						"address" => $_POST["address"],
						"city" => $_POST["city"],
						"zip" => $_POST["zip"],
						"country" => $_POST["country"]
						));
	}
	$purch = Purchase::insert(array(
							"PurchaseTimestamp" => time(),
							"Description" => $_POST["comment"],
							"PurchaseStatus" => 'open',
							"UserID" => $userID));
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
<div class="outercart">
<div class="cardfull" id="cart">
<?php 
	$cart->render(true);
	$_SESSION['cart']->deleteAll();
?>
</div>
<div class="cardfull" id="cart">
<p><?php echo t("ADDRESS")?>:</p>
<p><?php echo $_POST["prename"]?></p>
<p><?php echo $_POST["surname"]?></p>
<p><?php echo $_POST["email"]?></p>
<p><?php echo $_POST["address"] ?></p>
<p><?php echo $_POST["zip"]." ".$_POST["city"]?></p>
</div>
</div>
</article>
