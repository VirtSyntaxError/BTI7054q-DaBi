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
		<article>
			<h1>Marken</h1>
			<div>Rolex</div>
			<div>Certina</div>
			<div>Tissot</div>
			<div>Breitling</div>
			<div>Fossil</div>
			<div>Hamilton</div>
		</article>
		<article>
			<?php include("products.php"); ?>
		</article>
	</section>
     	<footer>
		<div class="footer">
          	<div>&copy Goldene Ziffer</div>
		</div>
     	</footer>

</body>
</html>
