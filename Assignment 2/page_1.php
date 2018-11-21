<?php
require_once("autoloader.php");
$brands = Brand::getBrands();
echo "<article>
	<h1>".t("BRANDS")."</h1>";

	foreach ($brands as $brand){
		echo '<a href=index.php?id=8&lang='.$_GET['lang'].'&brand='.$brand->getId().'>'.$brand.'</a><br>';
	}
	echo '<a href=index.php?id=8&lang='.$_GET['lang'].'&brand=all>'.t("ALLBRANDS").'</a><br>';

echo '</article>';
