<!doctype html>
<html>
<head>
	<link rel="stylesheet" href="style.css"> 
	<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<script src="jquery.js"></script> 
  	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
</head>

<body>
	<header>
		<div class="header">
			<div id="headerimage"><img src="pics/logo.png" alt="Logo"></img></div>
			<div id="headertext">Goldene Ziffer</div>
		<?php
			require_once("i18n.php");
			require_once("autoloader.php");
			if(!isset($_SESSION)){ 
				session_start(); 
				if(!isset($_SESSION["cart"])) {
					$_SESSION["cart"] = new Cart();
				}
			}
			$cart = $_SESSION["cart"];
			if (isset($_SESSION["user"])) {
				echo $_SESSION["user"];
			}
			$lang = isset($_GET['lang']) ? $_GET['lang'] : getDefaultLanguage();
		?>
		<a href="index.php?id=7&lang=<?php echo $lang ?>"><img src="pics/cart.png" width="50" alt="Cart"></img>
		<span class="cart-badge" id="cartcount"><?php echo $cart->getQuantity()?></span></a>
		</div>
    </header>
	<nav>
		<?php include("menu.php"); ?>
	</nav>

	<section>
		<?php
			$id = isset($_GET['id']) ? $_GET['id'] : 0;
 			include("page_$id.php"); 
		?>
	</section>
     	<footer>
		<div class="footer">
          	<div>&copy Goldene Ziffer</div>
		</div>
     	</footer>
</body>
</html>
