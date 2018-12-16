<?php
require_once("i18n.php");
require_once("autoloader.php");
require_once("functions.php");

if(!isset($_SESSION)){ 
	session_start(); 
}

if(!isset($_SESSION["cart"])) {
	$_SESSION["cart"] = new Cart();
}
$cart = $_SESSION["cart"];
					
if(!isset($_SESSION["lang"])){
	$_SESSION["lang"] = getDefaultLanguage();
}
?>
<!doctype html>
<html>
<head>
	<link rel="stylesheet" href="<?php echo ROOT ?>style.css"> 
	<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<script src="jquery.js"></script> 
</head>

<body>
	<header>
		<noscript><div id="nojs"><b><?php echo t("ACTIVATEJS") ?></b></div></noscript>
		<div class="header-row">
			<div id="headerimage"><img src="<?php echo ROOT ?>pics/logo.png" alt="Logo"></img></div>
			<div id="headertext">Goldene Ziffer</div>
			<div class="header-cell"></div>
		</div>
		<div class="header-row" id="beforenav"></div>
		<div class="header-row" id="nav">
			<div class="header-cell"></div>
			<div class="header-cell">
				<div class="nav">
				<?php 
					include("menu.php"); 
	
					if (isset($_SESSION["user"])) {
						echo $_SESSION["user"];
					}
				?>
				</div>
			</div>
			<div id="headercart">
				<a href="<?php echo ROOT ?>index.php?id=7">
					<img src="<?php echo ROOT ?>pics/cart.png" width="50" alt="Cart"></img>
					<span class="cart-badge" id="cartcount"><?php echo $cart->getQuantity() ?></span>
				</a>
			</div>
		</div>
    	</header>
	<section>
