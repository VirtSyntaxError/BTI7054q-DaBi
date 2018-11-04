<?php
class Purchase {
	private $id, $purchasetimestamp, $description, $purchasestatus, $userid;

	public function __toString(){
		return sprintf("%d) %d - %s - %s - %d", $this->id, $this->purchasetimestamp, $this->description, $this->purchasestatus, $this->userid);
	}

	static public function getPurchases() {
		$purchases = array();
		$res = DB::doQuery(
			"SELECT * FROM Purchase;"
		);
		if (!$res) return null;
		while ($purchase = $res->fetch_object(get_class())){
			$purchases[] = $purchase;
		}
		return $purchases;
	}

	static public function getPurchaseById($id) {
		$id = (int) $id;
		$res = DB::doQuery(
			"SELECT * FROM Purchase WHERE PurchaseID = $id"
		);
		if (!$res) return null;
		return $res->fetch_object(get_class());
	}

	static public function delete($id) {
		$id = (int) $id;
		$res = DB::doQuery(
			"DELETE FROM Purchase WHERE PurchaseID = $id"
		);
		return $res != null;
	}

	static public function insert($values) {
		$stmt = DB::getInstance()->prepare(
			"INSERT INTO Purchase ".
			"(PurchaseTimestamp, Description, PurchaseStatus, UserID) ".
			"VALUES (?, ?, ?, ?)"
		);
		if (!$stmt) return false;
		$success = $stmt->bind_param('issi',
			$values['PurchaseTimestamp'],
			$values['Description'],
			$values['PurchaseStatus'],
			$values['UserID']
		);
		if (!$success) return false;
		return $stmt->execute();
	}

	public function set($values){
		$db = DB::getInstance();
		$this->purchasetimestamp = $db->escape_string($values['PurchaseTimestamp']);
		$this->description = $db->escape_string($values['Description']);
		$this->purchasestatus = $db->escape_string($values['PurchaseStatus']);
		$this->userid = $db->escape_string($values['UserID']);
	}

	public function save() {
		$sql = sprintf(
			"UPDATE Purchase
			 SET PurchaseTimestamp='%d', Description='%s', PurchaseStatus='%s', UserID='%d'
			 WHERE PurchaseID = %d;",
			 $this->purchasetimestamp,
			 $this->description,
			 $this->purchasestatus,
			 $this->userid,
			 $this->id
		);
		$res = DB::doQuery($sql);
		return $res != null;
	}
}