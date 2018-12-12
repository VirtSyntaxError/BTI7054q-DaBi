<?php

require_once("autoloader.php");

class adminModel {

	public function getOrders() {
		return DB::doQuery("SELECT p.PurchaseTimestamp, p.Description, p.PurchaseStatus, u.Prename, u.Surname, u.Email FROM Purchase AS p
				JOIN Users as u ON u.UserID = p.UserID ORDER BY p.PurchaseTimestamp DESC;");
	}

	public function getBrands() {
		return Brand::getBrands();
	}	

	public function getStraps($lang) {
		return Strap::getStraps($lang);
	}

	public function getColors($lang) {
		return Color::getColors($lang);
	}

	public function insertProduct($parts) { 
		$id = Product::insert($parts);
		return $id;
	}

	public function insertProductColor($pid, $cid) {
		$insarray = array('ColorID'=>$cid, 'ProductID'=>$pid);
		ColorProduct::insert($insarray);

	}

	public function insertProductStrap($pid, $sid) {
		$insarray = array('StrapID'=>$sid, 'ProductID'=>$pid);
		StrapProduct::insert($insarray);
	}

}
