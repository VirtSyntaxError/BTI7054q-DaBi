<?php
class Product {
	private $ProductID, $Productname, $Productdescription, $BrandID, $Price, $Image;

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

	public function getDescription(){
		return $this->Productdescription;
	}

	public function getImage(){
		return $this->Image;
	}

	public function __toString(){
		return sprintf("%d) %s Price: %d", $this->ProductID, $this->getName(),$this->getPrice());
	}

	static public function getProducts($lang) {
		$products = array();
		$res = DB::doQuery(
			"SELECT p.ProductID, p.Productname, i.text_$lang AS Productdescription, p.BrandID, p.Price, p.Image FROM Product AS p
			JOIN i18n AS i ON p.Productdescription = i.i18nID"
		);
		if (!$res) return null;
		while ($product = $res->fetch_object(get_class())){
			$products[] = $product;
		}
		return $products;
	}

	static public function getProductsFiltered($filter, $lang) {
		$products = array();
		$res = DB::doQuery(
			'SELECT p.ProductID, p.Productname, i.text_$lang AS Productdescription, p.BrandID, p.Price, p.Image FROM Product AS p
			JOIN i18n AS i ON p.Productdescription = i.i18nID WHERE Productname LIKE "%'.$filter.'%" OR Productdescription LIKE "%'.$filter.'%";'
		);
		if (!$res) return null;
		while ($product = $res->fetch_object(get_class())){
			$products[] = $product;
		}
		return $products;
	}

	static public function getProductsByBrandId($id, $lang) {
		$id = (int) $id;
		$products = array();
		$res = DB::doQuery(
			"SELECT p.ProductID, p.Productname, i.text_$lang AS Productdescription, p.BrandID, p.Price, p.Image FROM Product AS p
			JOIN i18n AS i ON p.Productdescription = i.i18nID WHERE BrandID = $id;"
		);
		if (!$res) return null;
		while ($product = $res->fetch_object(get_class())){
			$products[] = $product;
		}
		return $products;
	}

	static public function getProductById($id, $lang) {
		$id = (int) $id;
		$res = DB::doQuery(
			"SELECT p.ProductID, p.Productname, i.text_$lang AS Productdescription, p.BrandID, p.Price, p.Image FROM Product AS p
			JOIN i18n AS i ON p.Productdescription = i.i18nID WHERE ProductID = $id"
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
			"(Productname, Productdescription, BrandID, Price, Image) ".
			"VALUES (?, ?, ?, ?, ?)"
		);
		if (!$stmt) return false;
		$success = $stmt->bind_param('ssiis',
			$values['Productname'],
			$values['Productdescription'],
			$values['BrandID'],
			$values['Price'],
			$values['Image']
		);
		if (!$success) return false;
		$stmt->execute();
		return $stmt->insert_id;
	}

	public function set($values){
		$db = DB::getInstance();
		$this->Productname = $db->escape_string($values['Productname']);
		$this->Productdescription = $db->escape_string($values['Productdescription']);
		$this->BrandID = $db->escape_string($values['BrandID']);
		$this->Price = $db->escape_string($values['Price']);
		$this->Image = $db->escape_string($values['Image']);
	}

	public function save() {
		$sql = sprintf(
			"UPDATE Product
			 SET Productname='%s', Productdescription='%s', BrandID=%d, Price=%d, Image='%s'
			 WHERE ProductID = %d;",
			 $this->Productname,
			 $this->Productdescription,
			 $this->BrandID,
			 $this->Price,
			 $this->Image,
			 $this->ProductID
		);
		$res = DB::doQuery($sql);
		return $res != null;
	}
}
