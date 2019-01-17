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
		echo '<h2>'.t("10ORDERS").'</h2>';
		$columns = array("ordernr", "date","status","prename","surname","username","changestatus");
		$rows = array();
		
		foreach ($this->adminModel->getOrders() as $purch) {
			$changestatus = '<select id="status-'.$purch['PurchaseID'].'" onChange="changeStatus(document.getElementById(\'status-'.$purch['PurchaseID'].'\').value,'.$purch['PurchaseID'].')">
						<option value="" selected disabled hidden>...</option>
            					<option value="new">new</option>
            					<option value="open">open</option>
            					<option value="sent">sent</option>
        				</select>';	
			$rows[] = array($purch['PurchaseID'],date("d.m.Y H:i", $purch['PurchaseTimestamp']),'<span id="state-'.$purch['PurchaseID'].'">'.$purch['PurchaseStatus'].'</span>',$purch['Prename'],$purch['Surname'],$purch['Username'],$changestatus);
		}
	
		$table = new Table($rows,$columns);
		$table->render();
		echo '</article>';

	}

	public function renderProducts() {
		echo '<article><h1>Admin</h1>';
		echo '<h2>'.t("PRODUCTS").'</h2>';
		$columns = array("name","brand","price","offer","discount");
		$rows = array();
		
		$lang = $_SESSION["lang"];
		
		foreach ($this->adminModel->getProducts($lang) as $product) {
			$offer = '<select id="offer-'.$product->getId().'" onChange="changeOffer(document.getElementById(\'offer-'.$product->getId().'\').value,'.$product->getId().')">';

			if ($product->getOffer()) {
            			$offer .= '<option value="1" selected>Yes</option>';
            			$offer .= '<option value="0">No</option>';
				$discount = '<span id="disc-'.$product->getId().'" class="notvisible">'.$product->getDiscount()."%</span>";
				$discount .= '<span id="slctdisc-'.$product->getId().'">';
			} else {
            			$offer .= '<option value="1">Yes</option>';
            			$offer .= '<option value="0" selected>No</option>';
				$discount = '<span id="disc-'.$product->getId().'">'.$product->getDiscount()."%</span>";
				$discount .= '<span id="slctdisc-'.$product->getId().'" class="notvisible">';
			}
        		$offer .= '</select>';	
			$discount .= '<select id="discount-'.$product->getId().'" onChange="changeDiscount(document.getElementById(\'discount-'.$product->getId().'\').value,'.$product->getId().')">';
			$percdiscount = $product->getDiscount();
			for ($i = 0; $i < 100; $i++) {
				if ($i == $percdiscount) {
					$discount .= '<option value="'.$i.'" selected>'.$i.'%</option>';
				} else {
					$discount .= '<option value="'.$i.'">'.$i.'%</option>';
				}
			}
        		$discount .= '</select></span>';	
			$rows[] = array($product->getName(),$product->getBrand(),$product->getPrice(),$offer,$discount);
		}
	
		$table = new Table($rows,$columns);
		$table->render();
		echo '</article>';

	}

	public function renderUsers() {
		echo '<article><h1>Admin</h1>';
		echo '<h2>'.t("USERS").'</h2>';
		$columns = array("prename","surname","username","admin");
		$rows = array();
		
		foreach ($this->adminModel->getUsersWithoutGuests() as $user) {
			$rows[] = array($user->getPrename(),$user->getSurname(),$user->getUsername(),$user->getIsAdmin());
		}
	
		$table = new Table($rows,$columns);
		$table->render();
		echo '</article>';

	}


	public function renderNewProduct() {
		echo '<article><h1>Admin</h1>';
		echo '<h2>'.t("NEWPROD").'</h2>';

		$lang = $_SESSION["lang"];

		$descen = $_COOKIE['Productdescription_en'] ?? "";
		$descde = $_COOKIE['Productdescription_de'] ?? "";
		$name = $_COOKIE['Productname'] ?? "";
		$price = $_COOKIE['Price'] ?? "";
		$discount = $_COOKIE['Discount'] ?? "";
		$brandid = $_COOKIE['BrandID'] ?? "";

		if(isset($_GET["error"])) {
			$error = strip_tags($_GET["error"]);
			echo '<p id="userexists">'.t("$error").'</p>';
		}

		echo '<form action="../insertProduct/" method="post" enctype="multipart/form-data">
		<p>'.t("PRODUCTNAME").': <input required name="Productname" value="'.$name.'"/></p>
		<p>'.t("IMAGE").': <input type="file" name="Image" id="image" required></p>
		<p>'.t("DESCRIPTION").' '.t("ENGLISH").': <input required name="Productdescription_en" value="'.$descen.'"/></p>
		<p>'.t("DESCRIPTION").' '.t("GERMAN").': <input required name="Productdescription_de" value="'.$descde.'"/></p>
		<p>'.t("BRAND").': <select name="BrandID" required>';
		foreach ($this->adminModel->getBrands() as $brand) {
			if($brandid == $brand->getId()) {
				echo '<option value="'.$brand->getId().'" selected>'.$brand->getName().'</option>';	
			} else {
				echo '<option value="'.$brand->getId().'">'.$brand->getName().'</option>';	
			}
		}
		echo '</select></p>
			<h3>'.t("CATEGORIES").'</h3>';
		foreach ($this->adminModel->getCategories($lang) as $cat){
			$catname = $cat->getName();
			$catID = $cat->getId();
			echo '<input type="checkbox" name="cats[]" value='.$catID.'>'.$catname.'<br>';
		}

		echo '<h3>'.t("WATCHCOLOR").'</h3>';
		foreach ($this->adminModel->getColors($lang) as $color){
			$colorname = $color->getName();
			$colorID = $color->getId();
			echo '<input type="checkbox" name="colors[]" value='.$colorID.'>'.$colorname.'<br>';
		}
		echo '<h3>'.t("STRAPCOLOR").'</h3>';
		foreach ($this->adminModel->getStraps($lang) as $strap){
			$strapname = $strap->getName();
			$strapID = $strap->getId();
			echo '<input type="checkbox" name="straps[]" value='.$strapID.'>'.$strapname.'<br>';
		}
		echo '<p>'.t("PRICE").': <input type="text" pattern="^[0-9]{1,9}$" required name="Price" value="'.$price.'"/></p>';
		echo '<p>'.t("OFFER").': <select name="Offer"><option value="1">'.t("YES").'</option><option value="0" selected>'.t("NO").'</option></select></p>';
		echo '<p>'.t("DISCOUNT").': <input type="text" pattern="^[0-9]{1,2}$" name="Discount" value="'.$discount.'"/></p>
		<input type="submit" value="'.t("SUBMIT").'"/>
		</form>';


	}


}
