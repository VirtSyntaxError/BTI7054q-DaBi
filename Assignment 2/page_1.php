<?php
require_once("autoloader.php");
$brands = Brand::getBrands();
echo "<article>
	<h1>".t("BRANDS")."</h1>";

	foreach ($brands as $brand){
		echo '<a class="link" href=index.php?id=8&brand='.$brand->getId().'>'.$brand->getName().'</a>';
	}
	echo '<a class="link" href=index.php?id=8&brand=all>'.t("ALLBRANDS").'</a><br>';

echo '</article>';
