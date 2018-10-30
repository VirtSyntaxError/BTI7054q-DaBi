<?php
class Strap {
	private $id, $strap;

	public function getName(){
		return $this.strap;
	}

	public function __toString(){
		return sprintf("%d) %s", $this->id, $this.getName());
	}

	static public function getStraps() {
		$straps = array();
		$res = DB::doQuery(
			"SELECT * FROM Strap;"
		);
		if (!$res) return null;
		while ($strap = $res->fetch_object(get_class())){
			$straps[] = $strap;
		}
		return $straps;
	}

	static public function getStrapById($id) {
		$id = (int) $id;
		$res = DB::doQuery(
			"SELECT * FROM Strap WHERE StrapID = $id"
		);
		if (!$res) return null;
		return $res->fetch_object(get_class());
	}

	static public function delete($id) {
		$id = (int) $id;
		$res = DB::doQuery(
			"DELETE FROM Strap WHERE StrapID = $id"
		);
		return $res != null;
	}

	static public function insert($values) {
		$stmt = DB::getInstance()->prepare(
			"INSERT INTO Strap ".
			"(Strap) ".
			"VALUES (?)"
		);
		if (!$stmt) return false;
		$success = $stmt->bind_param('s', $values['Strap']);
		if (!$success) return false;
		return $stmt->execute();
	}

	public function set($values){
		$db = DB::getInstance();
		$this->strap = $db->escape_string($values['Strap']);
	}

	public function save() {
		$sql = sprintf(
			"UPDATE Strap
			 SET Strap='%s'
			 WHERE id = %d;",
			 $this->Strap,
			 $this->id
		);
		$res = DB::doQuery($sql);
		return $res != null;
	}
}