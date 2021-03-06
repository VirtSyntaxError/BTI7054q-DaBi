<?php
class Brand {
	private $BrandID, $Brandname;

	public function getName(){
		return $this->Brandname;
	}

	public function getId(){
		return $this->BrandID;
	}

	public function __toString(){
		return sprintf("%d) %s", $this->BrandID, $this->getName());
	}

	static public function getBrands() {
		$brands = array();
		$res = DB::doQuery(
			"SELECT * FROM Brand;"
		);
		if (!$res) return null;
		while ($brand = $res->fetch_object(get_class())){
			$brands[] = $brand;
		}
		return $brands;
	}

	static public function getBrandById($id) {
		$id = (int) $id;
		$res = DB::doQuery(
			"SELECT * FROM Brand WHERE BrandID = $id"
		);
		if (!$res) return null;
		return $res->fetch_object(get_class());
	}

	static public function delete($id) {
		$id = (int) $id;
		$res = DB::doQuery(
			"DELETE FROM Brand WHERE BrandID = $id"
		);
		return $res != null;
	}

	static public function insert($values) {
		$stmt = DB::getInstance()->prepare(
			"INSERT INTO Brand ".
			"(Brandname) ".
			"VALUES (?)"
		);
		if (!$stmt) return false;
		$success = $stmt->bind_param('s', $values['Brandname']);
		if (!$success) return false;
		return $stmt->execute();
	}

	public function set($values){
		$db = DB::getInstance();
		$this->Brandname = $db->escape_string($values['Brandname']);
	}

	public function save() {
		$sql = sprintf(
			"UPDATE Brand
			 SET Brandname='%s'
			 WHERE BrandID = %d;",
			 $this->Brandname,
			 $this->BrandID
		);
		$res = DB::doQuery($sql);
		return $res != null;
	}
}
