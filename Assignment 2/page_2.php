<?php
require_once("autoloader.php");
echo "<article><h1>".t("CATEGORIES")."</h1></article>";
$cats = Category::getCategories();
foreach ($cats as $cat){
	echo $cat."<br>";
}