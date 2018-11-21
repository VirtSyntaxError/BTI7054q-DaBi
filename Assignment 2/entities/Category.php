<?php
class Category {
	private $CategoryID, $CategoryName;

	public function getName(){
		return $this->CategoryName;
	}

	public function getId(){
		return $this->CategoryID;
	}

	public function __toString(){
		return sprintf("%d) %s", $this->CategoryID, $this->getName());
	}

	static public function getCategories() {
		$categories = array();
		$res = DB::doQuery(
			"SELECT * FROM Category;"
		);
		if (!$res) return null;
		while ($category = $res->fetch_object(get_class())){
			$categories[] = $category;
		}
		return $categories;
	}

	static public function getCategoryById($id) {
		$id = (int) $id;
		$res = DB::doQuery(
			"SELECT * FROM Category WHERE CategoryID = $id"
		);
		if (!$res) return null;
		return $res->fetch_object(get_class());
	}

	static public function delete($id) {
		$id = (int) $id;
		$res = DB::doQuery(
			"DELETE FROM Category WHERE CategoryID = $id"
		);
		return $res != null;
	}

	static public function insert($values) {
		$stmt = DB::getInstance()->prepare(
			"INSERT INTO Category ".
			"(CategoryName) ".
			"VALUES (?)"
		);
		if (!$stmt) return false;
		$success = $stmt->bind_param('s', $values['CategoryName']);
		if (!$success) return false;
		return $stmt->execute();
	}

	public function set($values){
		$db = DB::getInstance();
		$this->CategoryName = $db->escape_string($values['CategoryName']);
	}

	public function save() {
		$sql = sprintf(
			"UPDATE Category
			 SET CategoryName='%s'
			 WHERE CategoryID = %d;",
			 $this->CategoryName,
			 $this->CategoryID
		);
		$res = DB::doQuery($sql);
		return $res != null;
	}
}
