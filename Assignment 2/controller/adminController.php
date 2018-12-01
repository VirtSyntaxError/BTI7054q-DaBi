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
		$this->adminView->renderOrders();
	}

	public function newProduct() {
		$this->adminView->renderNewProduct();
	}

	public function insertProduct() {
		if (isset($_POST['Productname'])){
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
		}

	}

}