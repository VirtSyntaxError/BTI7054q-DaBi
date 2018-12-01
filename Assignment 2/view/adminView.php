<?php
require_once("autoloader.php");

class adminView {

	private $adminModel;

	public function __construct($adminModel) {
		$this->adminModel = $adminModel;
	}

	public function renderOrders() {
		echo '<article><h1>Admin</h1>';
		echo '<h2>Last 10 Orders</h2>';
		$columns = array("timestamp","description","purchasestatus","prename","surname","email");
		$rows = array();
		
		foreach ($this->adminModel->getOrders() as $purch) {
			$rows[] = array(gmdate("Y-m-d H:i:s", $purch['PurchaseTimestamp']),$purch['Description'],$purch['PurchaseStatus'],$purch['Prename'],$purch['Surname'],$purch['Email']);
		}
	
		$table = new Table($rows,$columns);
		$table->render();

	}

	public function renderNewProduct() {
		echo '<article><h1>Admin</h1>';
		echo '<h2>New product</h2>';


		echo '<form action="../insertProduct/" method="post">
		<p>ProductName: <input required name="Productname"/></p>
		<p>Productdesc: <input required name="Productdescription"/></p>
		<p>BrandID: <select name="BrandID" required>';
		foreach ($this->adminModel->getBrands() as $brand) {
			echo '<option value="'.$brand->getId().'">'.$brand->getName().'</option>';	
		}
		echo '</select></p>
		<h3>Colors</h3>';
		foreach ($this->adminModel->getColors() as $color){
			$colorname = $color->getName();
			$colorID = $color->getId();
			echo '<input type="checkbox" name="colors[]" value='.$colorID.'>'.$colorname.'<br>';
		}
		echo '<h3>Straps</h3>';
		foreach ($this->adminModel->getStraps() as $strap){
			$strapname = $strap->getName();
			$strapID = $strap->getId();
			echo '<input type="checkbox" name="straps[]" value='.$strapID.'>'.$strapname.'<br>';
		}
		echo '<p>Price: <input type="text" pattern="^[0-9]{1,9}$" required name="Price"/></p>
		<input type="submit"/>
		</form>';


	}


}
