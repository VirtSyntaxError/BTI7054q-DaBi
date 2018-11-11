<?php
class ColorProduct {
	private $ColorID, $ProductID;

	public function getColorId(){
		return $this->ColorID;
	}
	
	public function getProductId(){
		return $this->ProductID;
	}

	public function __toString(){
		return sprintf("Product %d, Color %d", $this->ProductID, $this->ColorID);
	}

	static public function getColorProduct() {
		$colorproducts = array();
		$res = DB::doQuery(
			"SELECT * FROM ColorProduct;"
		);
		if (!$res) return null;
		while ($colorproduct = $res->fetch_object(get_class())){
			$colorproducts[] = $colorproduct;
		}
		return $colorproducts;
	}

	static public function getColorByProductId($ProductID) {
		$ProductID = (int) $ProductID;
		$colorsofproduct = array();
		$res = DB::doQuery(
			"SELECT * FROM ColorProduct WHERE ProductID = $ProductID"
		);
		if (!$res) return null;
		while($color = $res->fetch_object(get_class())){
			$colorsofproduct[] = $color;	
		}
		return $colorsofproduct;
	}

	static public function getProductByColorId($ColorID) {
		$ColorID = (int) $ColorID;
		$productsofcolor = array();
		$res = DB::doQuery(
			"SELECT * FROM ColorProduct WHERE ColorID = $ColorID"
		);
		if (!$res) return null;
		while($product = $res->fetch_object(get_class())){
			$productsofcolor[] = $product;	
		}
		return $productsofcolor;
	}

	static public function delete($ProductID,$ColorID) {
		$ProductID = (int) $ProductID;
		$ColorID = (int) $ColorID;
		$res = DB::doQuery(
			"DELETE FROM ColorProduct WHERE ColorID = $ColorID AND ProductID = $ProductID"
		);
		return $res != null;
	}

	static public function insert($values) {
		$stmt = DB::getInstance()->prepare(
			"INSERT INTO ColorProduct ".
			"(ColorID, ProductID) ".
			"VALUES (?, ?)"
		);
		if (!$stmt) return false;
		$success = $stmt->bind_param('dd', 
			$values['ColorID'],
			$values['ProductID']
		);
		if (!$success) return false;
		return $stmt->execute();
	}

	public function set($values){
		$db = DB::getInstance();
		$this->ColorID = $db->escape_string($values['ColorID']);
		$this->ProductID = $db->escape_string($values['ProductID']);
	}
}
