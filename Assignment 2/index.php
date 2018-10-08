<!doctype html>
<html>
<head>
	<link rel="stylesheet" href="style.css"> 
</head>

<body>
	<header>
		<div class="header">
			<div id="headerimage"><img src="logo.png" alt="Logo"></img></div>
			<div id="headertext">Goldene Ziffer</div>
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
