<?php

require_once("autoloader.php");

class adminController {
	private $adminModel;
	private $adminView;

	public function __construct() {
		$this->adminModel = new adminModel();
		$this->adminView = new adminView($this->adminModel);
	}

	public function showOrders() {
		$this->adminView->renderHeader();
		$this->adminView->renderOrders();
		$this->adminView->renderFooter();
	}

	public function showProducts() {
		$this->adminView->renderHeader();
		$this->adminView->renderProducts();
		$this->adminView->renderFooter();
	}

	public function newProduct() {
		$this->adminView->renderHeader();
		$this->adminView->renderNewProduct();
		$this->adminView->renderFooter();
	}

	public function showUsers() {
		$this->adminView->renderHeader();
		$this->adminView->renderUsers();
		$this->adminView->renderFooter();
	}

	public function insertProduct() {

		$t = time()+60*60*24*30;
		setcookie("Productname", $_POST["Productname"], $t, "/");
		setcookie("Productdescription_de", $_POST["Productdescription_de"], $t, "/");
		setcookie("Productdescription_en", $_POST["Productdescription_en"], $t, "/");
		setcookie("Price", $_POST["Price"], $t, "/");
		setcookie("BrandID", $_POST["BrandID"], $t, "/");
		setcookie("Discount", $_POST["Discount"], $t, "/");
		
		if (isset($_POST['Productname']) && $_POST['colors'] && $_POST['cats'] && $_POST['straps'] && !$_FILES["Image"]["error"]){

			if(!$this->uploadImage($_FILES['Image'])){
				header('Location: ../newProduct/?error=IMAGEERROR');
			} else {	

				$_POST['Image'] = $_FILES['Image']['name'];
				$_POST['Productdescription_de'] = htmlspecialchars($_POST['Productdescription_de']);
				$_POST['Productdescription_en'] = htmlspecialchars($_POST['Productdescription_en']);
				$_POST['Productname'] = htmlspecialchars($_POST['Productname']);


				$id = $this->adminModel->insertProduct($_POST);

				if (isset($_POST['colors'])){
					foreach ($_POST['colors'] as $color){
						$this->adminModel->insertProductColor($id,$color);
					}
				}
				if (isset($_POST['straps'])){
					foreach ($_POST['straps'] as $strap){
						$this->adminModel->insertProductStrap($id,$strap);
					}
				}
				if (isset($_POST['cats'])){
					foreach ($_POST['cats'] as $cat){
						$this->adminModel->insertProductCategory($id,$cat);
					}
				}

				unset($_COOKIE['Productdescription_en']);
				unset($_COOKIE['Productdescription_de']);
				unset($_COOKIE['Productname']);
				unset($_COOKIE['Price']);
				unset($_COOKIE['BrandID']);
				unset($_COOKIE['Discount']);
				setcookie("Productname", "", time()-3600, "/");
				setcookie("Productdescription_de", "", time()-3600, "/");
				setcookie("Productdescription_en", "", time()-3600, "/");
				setcookie("Price", "", time()-3600, "/");
				setcookie("BrandID", "", time()-3600, "/");
				setcookie("Discount", "", time()-3600, "/");

			
				header('Location: ../showProducts/');
			}
		} else {
			header('Location: ../newProduct/?error=NOTALLERROR');
		}
	}
	
	private function uploadImage($image = []) {
		$fileDest = "../img/".basename($image['name']);
		
    		if(!getimagesize($image['tmp_name'])) {
			echo "not an image";
			var_dump($image);
        		return false;
		}

		if (file_exists($fileDest)) {
			var_dump($image);
			die;
			return false;
		}

		if ($image['size'] > 300000) {
			var_dump($image);
			die;
			return false;
		}

    		if (move_uploaded_file($image['tmp_name'], $fileDest)) {
			return true;
    		} else {
			var_dump($image);
			die;
        		return false;
		}
	}
}
