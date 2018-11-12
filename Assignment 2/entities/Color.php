<?php
class Color {
	private $ColorID, $ColorName;

	public function getName(){
		return $this->ColorName;
	}

	public function getId(){
		return $this->ColorID;
	}

	public function __toString(){
		return sprintf("%d) %s", $this->ColorID, $this->getName());
	}

	static public function getColors() {
		$colors = array();
		$res = DB::doQuery(
			"SELECT * FROM Color;"
		);
		if (!$res) return null;
		while ($color = $res->fetch_object(get_class())){
			$colors[] = $color;
		}
		return $colors;
	}

	static public function getColorById($id) {
		$id = (int) $id;
		$res = DB::doQuery(
			"SELECT * FROM Color WHERE ColorID = $id"
		);
		if (!$res) return null;
		return $res->fetch_object(get_class());
	}

	static public function delete($id) {
		$id = (int) $id;
		$res = DB::doQuery(
			"DELETE FROM Color WHERE ColorID = $id"
		);
		return $res != null;
	}

	static public function insert($values) {
		$stmt = DB::getInstance()->prepare(
			"INSERT INTO Color ".
			"(ColorName) ".
			"VALUES (?)"
		);
		if (!$stmt) return false;
		$success = $stmt->bind_param('s', $values['ColorName']);
		if (!$success) return false;
		return $stmt->execute();
	}

	public function set($values){
		$db = DB::getInstance();
		$this->ColorName = $db->escape_string($values['ColorName']);
	}

	public function save() {
		$sql = sprintf(
			"UPDATE Color
			 SET ColorName='%s'
			 WHERE ColorID = %d;",
			 $this->ColorName,
			 $this->ColorID
		);
		$res = DB::doQuery($sql);
		return $res != null;
	}
}
