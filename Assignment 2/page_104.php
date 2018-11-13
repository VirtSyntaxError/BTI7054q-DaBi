<?php
require_once("autoloader.php");
include "authentication.inc.php";

$adm = $_SESSION["isAdmin"] ?? false;
if (!$adm) {
	echo '<p>You need to be admin to view this page</p>';
} else {
	$brands = Brand::getBrands();
	echo '<article><h1>Admin</h1></article>';
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
	if (isset($_POST['Productname'])){
		Product::insert($_POST);
	}
}
