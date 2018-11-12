<?php
require_once("autoloader.php");
include "authentication.inc.php";

$adm = $_SESSION["isAdmin"] ?? false;
if (!$adm){
	echo "<p>You need to be admin to view this page</p>";
}
else{
	echo "<form action='admin.php' method='post'>
		<p>ProductName: <input required name='Productname'/></p>
		<p>Productdesc: <input required name='Productdescription'/></p>
		<p>BrandID: <input required name='BrandID'/></p>
		<input type='submit'/>
		</form>";
	if (isset($_POST['Productname'])){
		Product::insert($_POST);
	}
}
