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
			<div id="headerimage"><img src="logo.png" alt="Logo"></img></div>
			<div id="headertext">Goldene Ziffer</div>
		</div>
    </header>
    <div id="login_logout">
		<?php
			require_once("i18n.php");
			if(!isset($_SESSION)){ 
				session_start(); 
			}
			if (isset($_SESSION["user"])) {
				echo $_SESSION["user"];
				echo "|";
				echo "<a href='logout.php'>".t("LOGOUT")."</a>";
			} else {
				if (isset($_GET['lang'])){
					$lang = $_GET['lang'];
				} else {
					$lang = 'de';
				}
				echo "<a href='index.php?id=101&lang=".$lang."'>".t("REGISTER")."</a>";
			}
		?>
	</div>
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
