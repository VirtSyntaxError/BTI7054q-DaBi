<?php
class CategoryProduct {
	private $CategoryID, $ProductID;

	public function getCategoryId(){
		return $this->CategoryID;
	}
	
	public function getProductId(){
		return $this->ProductID;
	}

	public function __toString(){
		return sprintf("Product %d, Category %d", $this->ProductID, $this->CategoryID);
	}

	static public function getCategoryProduct() {
		$categoryproducts = array();
		$res = DB::doQuery(
			"SELECT * FROM CategoryProduct;"
		);
		if (!$res) return null;
		while ($categoryproduct = $res->fetch_object(get_class())){
			$categoryproducts[] = $categoryproduct;
		}
		return $categoryproducts;
	}

	static public function getCategoryByProductId($ProductID) {
		$ProductID = (int) $ProductID;
		$categoriesofproduct = array();
		$res = DB::doQuery(
			"SELECT * FROM CategoryProduct WHERE ProductID = $ProductID"
		);
		if (!$res) return null;
		while($category = $res->fetch_object(get_class())){
			$categoriesofproduct[] = $category;	
		}
		return $categoriesofproduct;
	}

	static public function getProductByCategoryId($CategoryID) {
		$CategoryID = (int) $CategoryID;
		$productsofcategory = array();
		$res = DB::doQuery(
			"SELECT * FROM CategoryProduct WHERE CategoryID = $CategoryID"
		);
		if (!$res) return null;
		while($product = $res->fetch_object(get_class())){
			$productsofcategory[] = $product;	
		}
		return $productsofcategory;
	}

	static public function delete($ProductID,$CategoryID) {
		$ProductID = (int) $ProductID;
		$CategoryID = (int) $CategoryID;
		$res = DB::doQuery(
			"DELETE FROM CategoryProduct WHERE CategoryID = $CategoryID AND ProductID = $ProductID"
		);
		return $res != null;
	}

	static public function insert($values) {
		$stmt = DB::getInstance()->prepare(
			"INSERT INTO CategoryProduct ".
			"(CategoryID, ProductID) ".
			"VALUES (?, ?)"
		);
		if (!$stmt) return false;
		$success = $stmt->bind_param('dd', 
			$values['CategoryID'],
			$values['ProductID']
		);
		if (!$success) return false;
		return $stmt->execute();
	}

	public function set($values){
		$db = DB::getInstance();
		$this->CategoryID = $db->escape_string($values['CategoryID']);
		$this->ProductID = $db->escape_string($values['ProductID']);
	}
}
