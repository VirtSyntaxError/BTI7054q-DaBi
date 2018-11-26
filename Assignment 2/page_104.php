<?php
require_once("autoloader.php");
include "authentication.inc.php";

$adm = $_SESSION["isAdmin"] ?? false;
if (!$adm) {
	echo '<p>You need to be admin to view this page</p>';
} else {
	$brands = Brand::getBrands();
	$colors = Color::getColors();
	$straps = Strap::getStraps();
	echo '<article><h1>Admin</h1></article><h2>Product</h2>';
	echo '<form action="" method="post">
		<p>ProductName: <input required name="Productname"/></p>
		<p>Productdesc: <input required name="Productdescription"/></p>
		<p>BrandID: <select name="BrandID" required>';
	foreach ($brands as $brand) {
		echo '<option value="'.$brand->getId().'">'.$brand->getName().'</option>';	
	}
	echo '</select></p>
		<h3>Colors</h3>';
	foreach ($colors as $color){
		$colorname = $color->getName();
		$colorID = $color->getId();
		echo '<input type="checkbox" name="colors[]" value='.$colorID.'>'.$colorname.'<br>';
	}
	echo '<h3>Straps</h3>';
	foreach ($straps as $strap){
		$strapname = $strap->getName();
		$strapID = $strap->getId();
		echo '<input type="checkbox" name="straps[]" value='.$strapID.'>'.$strapname.'<br>';
	}
	echo '
		<p>Price: <input type="text" pattern="^[0-9]{1,9}$" required name="Price"/></p>
		<input type="submit"/>
		</form>';

	echo '<form action="" method="post">
		<h2>Color</h2>
		<p>ColorName: <input required name="ColorName"/></p>';
	echo '<input type="submit"/>
		</form>';

	echo '<form action="" method="post">
		<h2>Strap</h2>
		<p>StrapName: <input required name="Strap"/></p>';
	echo '<input type="submit"/>
		</form>';

	if (isset($_POST['Productname'])){
		$id = Product::insert($_POST);

		if (isset($_POST['colors'])){
			foreach ($_POST['colors'] as $color){
				$insarray = array('ColorID'=>$color, 'ProductID'=>$id);
				ColorProduct::insert($insarray);
			}
		}
		if (isset($_POST['straps'])){
			foreach ($_POST['straps'] as $strap){
				$insarray = array('StrapID'=>$strap, 'ProductID'=>$id);
				StrapProduct::insert($insarray);
			}
		}
	}

	if (isset($_POST['ColorName'])){
		Color::insert($_POST);
	}

	if (isset($_POST['Strap'])){
		Color::insert($_POST);
	}
}
