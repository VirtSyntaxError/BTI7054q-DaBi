<?php
class Product {
	private $id, $productname, $productdesc, $brandid;

	public function getName(){
		return $this->productname;
	}

	public function __toString(){
		return sprintf("%d) %s", $this->id, $this.getName());
	}

	static public function getProducts() {
		$products = array();
		$res = DB::doQuery(
			"SELECT * FROM Product;"
		);
		if (!$res) return null;
		while ($product = $res->fetch_object(get_class())){
			$products[] = $product;
		}
		return $products;
	}

	static public function getProductById($id) {
		$id = (int) $id;
		$res = DB::doQuery(
			"SELECT * FROM Product WHERE ProductID = $id"
		);
		if (!$res) return null;
		return $res->fetch_object(get_class());
	}

	static public function delete($id) {
		$id = (int) $id;
		$res = DB::doQuery(
			"DELETE FROM Product WHERE ProductID = $id"
		);
		return $res != null;
	}

	static public function insert($values) {
		$stmt = DB::getInstance()->prepare(
			"INSERT INTO Product ".
			"(Productname, Productdescription, BrandID) ".
			"VALUES (?, ?, ?)"
		);
		if (!$stmt) return false;
		$success = $stmt->bind_param('ssi',
			$values['Productname'],
			$values['Productdescription'],
			$values['BrandID']
		);
		if (!$success) return false;
		return $stmt->execute();
	}

	public function set($values){
		$db = DB::getInstance();
		$this->product = $db->escape_string($values['Productname']);
	}

	public function save() {
		$sql = sprintf(
			"UPDATE Product
			 SET Productname='%s', Productdescription='%s', BrandID='%s'
			 WHERE ProductID = %d;",
			 $this->productname,
			 $this->productdesc,
			 $this->brandid,
			 $this->id
		);
		$res = DB::doQuery($sql);
		return $res != null;
	}
}