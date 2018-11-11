<?php
class StrapProduct {
	private $StrapID, $ProductID;

	public function getStrapId(){
		return $this->StrapID;
	}
	
	public function getProductId(){
		return $this->ProductID;
	}

	public function __toString(){
		return sprintf("Product %d, Strap %d", $this->ProductID, $this->StrapID);
	}

	static public function getStrapProduct() {
		$strapproducts = array();
		$res = DB::doQuery(
			"SELECT * FROM StrapProduct;"
		);
		if (!$res) return null;
		while ($strapproduct = $res->fetch_object(get_class())){
			$strapproducts[] = $strapproduct;
		}
		return $strapproducts;
	}

	static public function getStrapByProductId($ProductID) {
		$ProductID = (int) $ProductID;
		$strapsofproduct = array();
		$res = DB::doQuery(
			"SELECT * FROM StrapProduct WHERE ProductID = $ProductID"
		);
		if (!$res) return null;
		while($strap = $res->fetch_object(get_class())){
			$strapsofproduct[] = $strap;	
		}
		return $strapsofproduct;
	}

	static public function getProductByStrapId($StrapID) {
		$StrapID = (int) $StrapID;
		$productsofstrap = array();
		$res = DB::doQuery(
			"SELECT * FROM StrapProduct WHERE StrapID = $StrapID"
		);
		if (!$res) return null;
		while($product = $res->fetch_object(get_class())){
			$productsofstrap[] = $product;	
		}
		return $productsofstrap;
	}

	static public function delete($ProductID,$StrapID) {
		$ProductID = (int) $ProductID;
		$StrapID = (int) $StrapID;
		$res = DB::doQuery(
			"DELETE FROM StrapProduct WHERE StrapID = $StrapID AND ProductID = $ProductID"
		);
		return $res != null;
	}

	static public function insert($values) {
		$stmt = DB::getInstance()->prepare(
			"INSERT INTO StrapProduct ".
			"(StrapID, ProductID) ".
			"VALUES (?, ?)"
		);
		if (!$stmt) return false;
		$success = $stmt->bind_param('dd', 
			$values['StrapID'],
			$values['ProductID']
		);
		if (!$success) return false;
		return $stmt->execute();
	}

	public function set($values){
		$db = DB::getInstance();
		$this->StrapID = $db->escape_string($values['StrapID']);
		$this->ProductID = $db->escape_string($values['ProductID']);
	}
}
