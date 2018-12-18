<?php
require_once("autoloader.php");
define("ROOT", "../../");

class adminView {

	private $adminModel;

	public function __construct($adminModel) {
		$this->adminModel = $adminModel;
	}

	public function renderHeader() {
		require_once("../header.php");
	}
	
	public function renderFooter() {
		require_once("../footer.php");
	}


	public function renderOrders() {
		echo '<article><h1>Admin</h1>';
		echo '<h2>Last Orders</h2>';
		$columns = array("date","description","status","prename","surname","email","changestatus");
		$rows = array();
		
		foreach ($this->adminModel->getOrders() as $purch) {
			$changestatus = '<select id="status-'.$purch['PurchaseID'].'" onChange="changeStatus(document.getElementById(\'status-'.$purch['PurchaseID'].'\').value,'.$purch['PurchaseID'].')">
						<option value="" selected disabled hidden>Choose here</option>
            					<option value="open">open</option>
            					<option value="sent">sent</option>
        				</select>';	
			$rows[] = array(date("H:i d.m.Y", $purch['PurchaseTimestamp']),$purch['Description'],'<span id="state-'.$purch['PurchaseID'].'">'.$purch['PurchaseStatus'].'</span>',$purch['Prename'],$purch['Surname'],$purch['Email'],$changestatus);
		}
	
		$table = new Table($rows,$columns);
		$table->render();
		echo '</article>';

	}

	public function renderUsers() {
		echo '<article><h1>Admin</h1>';
		echo '<h2>Users</h2>';
		$columns = array("prename","surname","email","admin");
		$rows = array();
		
		foreach ($this->adminModel->getUsers() as $user) {
			$rows[] = array($user->getPrename(),$user->getSurname(),$user->getEmail(),$user->getIsAdmin());
		}
	
		$table = new Table($rows,$columns);
		$table->render();
		echo '</article>';

	}


	public function renderNewProduct() {
		echo '<article><h1>Admin</h1>';
		echo '<h2>New product</h2>';

		$lang = $_SESSION["lang"];

		echo '<form action="../insertProduct/" method="post">
		<p>ProductName: <input required name="Productname"/></p>
		<p>Productdesc: <input required name="Productdescription"/></p>
		<p>BrandID: <select name="BrandID" required>';
		foreach ($this->adminModel->getBrands() as $brand) {
			echo '<option value="'.$brand->getId().'">'.$brand->getName().'</option>';	
		}
		echo '</select></p>
		<h3>Colors</h3>';
		foreach ($this->adminModel->getColors($lang) as $color){
			$colorname = $color->getName();
			$colorID = $color->getId();
			echo '<input type="checkbox" name="colors[]" value='.$colorID.'>'.$colorname.'<br>';
		}
		echo '<h3>Straps</h3>';
		foreach ($this->adminModel->getStraps($lang) as $strap){
			$strapname = $strap->getName();
			$strapID = $strap->getId();
			echo '<input type="checkbox" name="straps[]" value='.$strapID.'>'.$strapname.'<br>';
		}
		echo '<p>Price: <input type="text" pattern="^[0-9]{1,9}$" required name="Price"/></p>
		<input type="submit"/>
		</form>';


	}


}
