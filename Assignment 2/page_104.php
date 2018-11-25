<?php
require_once("autoloader.php");
include "authentication.inc.php";

$adm = $_SESSION["isAdmin"] ?? false;
if (!$adm) {
	echo '<p>You need to be admin to view this page</p>';
} else {
	$brands = Brand::getBrands();
	echo '<article><h1>Admin</h1></article><h2>Product</h2>';
	echo '<form action="" method="post">
		<p>ProductName: <input required name="Productname"/></p>
		<p>Productdesc: <input required name="Productdescription"/></p>
		<p>BrandID: <select name="BrandID" required>';
	foreach ($brands as $brand) {
		echo '<option value="'.$brand->getId().'">'.$brand->getName().'</option>';	
	}
	echo '</select></p>
		<p>Price: <input type="text" pattern="^[0-9]{1,9}$" required name="Price"/></p>
		<input type="submit"/>
		</form>';

	$colors = Color::getColors();
	echo '<form action="" method="post">
		<h2>Color</h2>
		<p>ColorName: <input required name="ColorName"/></p>';
	echo '<input type="submit"/>
		</form>';

	$straps = Strap::getStraps();
	echo '<form action="" method="post">
		<h2>Strap</h2>
		<p>StrapName: <input required name="Strap"/></p>';
	echo '<input type="submit"/>
		</form>';

	if (isset($_POST['Productname'])){
		Product::insert($_POST);
	}

	if (isset($_POST['ColorName'])){
		Color::insert($_POST);
	}

	if (isset($_POST['Strap'])){
		Color::insert($_POST);
	}
}
