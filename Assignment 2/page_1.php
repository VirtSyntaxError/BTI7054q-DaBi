<?php
require_once("autoloader.php");
$brands = Brand::getBrands();
echo "<article>
	<h1>".t("BRANDS")."</h1>";

	foreach ($brands as $brand){
		echo $brand."<br>";
	}
echo "
</article>
<article>";
include("products.php");
echo "</article>";