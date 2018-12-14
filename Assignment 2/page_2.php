<?php
require_once("autoloader.php");
echo '<article><h1>'.t("CATEGORIES").'</h1>';
$cats = Category::getCategories($lang);
foreach ($cats as $cat){
	echo '<a class="link" href=index.php?id=8&cat='.$cat->getId().'>'.$cat->getName().'</a>';
}
echo '<a class="link" href=index.php?id=8&cat=all>'.t("ALLCATS").'</a><br>';
echo '<br></article>';
