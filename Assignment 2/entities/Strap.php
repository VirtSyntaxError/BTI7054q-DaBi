<?php
class Strap {
	private $StrapID, $Strap;

	public function getName(){
		return $this->Strap;
	}

	public function getId(){
		return $this->StrapID;
	}

	public function __toString(){
		return sprintf("%d) %s", $this->StrapID, $this->getName());
	}

	static public function getStraps($lang) {
		$straps = array();
		$res = DB::doQuery(
			"SELECT s.StrapID, i.text_$lang AS Strap FROM Strap AS s
			JOIN i18n AS i ON s.Strap = i.i18nID"
		);
		if (!$res) return null;
		while ($strap = $res->fetch_object(get_class())){
			$straps[] = $strap;
		}
		return $straps;
	}

	static public function getStrapById($id, $lang) {
		$id = (int) $id;
		$res = DB::doQuery(
			"SELECT s.StrapID, i.text_$lang AS Strap FROM Strap AS s
			JOIN i18n AS i ON s.Strap = i.i18nID WHERE StrapID = $id"
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
		$this->Strap = $db->escape_string($values['Strap']);
	}

	public function save() {
		$sql = sprintf(
			"UPDATE Strap
			 SET Strap='%s'
			 WHERE StrapID = %d;",
			 $this->Strap,
			 $this->StrapID
		);
		$res = DB::doQuery($sql);
		return $res != null;
	}
}
