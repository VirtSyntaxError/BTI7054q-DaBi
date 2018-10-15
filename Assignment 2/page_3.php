<?php
$articleid = $_POST["articleid"];
echo "<article><h1>".t("CUSTOMIZEPROD")."</h1></article>";
echo '<article><form method="post" action="index.php?id=4&lang='.$_GET["lang"].'">';
echo '<h2>Strap Color</h2>';
foreach ($product_array[$articleid]["strapcolor"] as $strapcolor){
	echo '<input type="radio" name="strapcolor" value="'.$strapcolor.'">'.$strapcolor.'<br/>';
}
echo '<h2>Watch Color</h2>';
foreach ($product_array[$articleid]["watchcolor"] as $watchcolor){
	echo '<input type="radio" name="watchcolor" value="'.$watchcolor.'">'.$watchcolor.'<br/>';
}
echo '<input type="submit" value="'.t("SUBMIT").'">';
echo '</form></article>';

