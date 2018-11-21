<?php
class Product {
	private $ProductID, $Productname, $Productdescription, $BrandID, $Price;

	public function getName(){
		return $this->Productname;
	}

	public function getID(){
		return $this->ProductID;
	}

	public function getPrice(){
		return $this->Price;
	}

	public function getBrand(){
		return $this->BrandID;
	}

	public function __toString(){
		return sprintf("%d) %s Price: %d", $this->ProductID, $this->getName(),$this->getPrice());
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

	static public function getProductsByBrandId($id) {
		$id = (int) $id;
		$products = array();
		$res = DB::doQuery(
			"SELECT * FROM Product WHERE BrandID = $id;"
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
			"(Productname, Productdescription, BrandID, Price) ".
			"VALUES (?, ?, ?, ?)"
		);
		if (!$stmt) return false;
		$success = $stmt->bind_param('ssii',
			$values['Productname'],
			$values['Productdescription'],
			$values['BrandID'],
			$values['Price']
		);
		if (!$success) return false;
		return $stmt->execute();
	}

	public function set($values){
		$db = DB::getInstance();
		$this->Productname = $db->escape_string($values['Productname']);
		$this->Productdescription = $db->escape_string($values['Productdescription']);
		$this->BrandID = $db->escape_string($values['BrandID']);
		$this->Price = $db->escape_string($values['Price']);
	}

	public function save() {
		$sql = sprintf(
			"UPDATE Product
			 SET Productname='%s', Productdescription='%s', BrandID=%d, Price=%d
			 WHERE ProductID = %d;",
			 $this->Productname,
			 $this->Productdescription,
			 $this->BrandID,
			 $this->Price,
			 $this->ProductID
		);
		$res = DB::doQuery($sql);
		return $res != null;
	}
}
