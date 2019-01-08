<?php
class Purchase {
	private $PurchaseID, $PurchaseTimestamp, $Description, $Shipment, $Gift, $PurchaseStatus, $UserID;

	public function __toString(){
		return sprintf("%d) %d - %s - %s - %d", $this->PurchaseID, $this->PurchaseTimestamp, $this->Description, $this->PurchaseStatus, $this->UserID);
	}

	public function getId() {
		return $this->PurchaseID;
	}

	public function getTimestamp() {
		return $this->PurchaseTimestamp;
	}

	public function getDescription() {
		return $this->Description;
	}

	public function getStatus() {
		return $this->PurchaseStatus;
	}

	public function setStatus($status) {
		$this->PurchaseStatus = $status;
	}

	public function getShipment() {
		return $this->Shipment;
	}
	
	public function getGift() {
		return $this->Gift;
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

	static public function getPurchaseByUserId($id) {
		$purchases = array();
		$id = (int) $id;
		$res = DB::doQuery(
			"SELECT * FROM Purchase WHERE UserID = $id"
		);
		if (!$res) return null;
		while ($purchase = $res->fetch_object(get_class())){
			$purchases[] = $purchase;
		}
		return $purchases;
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
			"(PurchaseTimestamp, Description, Shipment, Gift, PurchaseStatus, UserID) ".
			"VALUES (?, ?, ?, ?, ?, ?)"
		);
		if (!$stmt) return false;
		$success = $stmt->bind_param('issisi',
			$values['PurchaseTimestamp'],
			$values['Description'],
			$values['Shipment'],
			$values['Gift'],
			$values['PurchaseStatus'],
			$values['UserID']
		);
		if (!$success) return false;
		return [$stmt->execute(),DB::getInstance()->insert_id];
	}

	public function set($values){
		$db = DB::getInstance();
		$this->PurchaseTimestamp = $db->escape_string($values['PurchaseTimestamp']);
		$this->Description = $db->escape_string($values['Description']);
		$this->Shipment = $db->escape_string($values['Shipment']);
		$this->Gift = $db->escape_string($values['Gift']);
		$this->PurchaseStatus = $db->escape_string($values['PurchaseStatus']);
		$this->UserID = $db->escape_string($values['UserID']);
	}

	public function save() {
		$sql = sprintf(
			"UPDATE Purchase
			 SET PurchaseTimestamp='%d', Description='%s', Shipment='%s', Gift='%d', PurchaseStatus='%s', UserID='%d'
			 WHERE PurchaseID = %d;",
			 $this->PurchaseTimestamp,
			 $this->Description,
			 $this->Shipment,
			 $this->Gift,
			 $this->PurchaseStatus,
			 $this->UserID,
			 $this->PurchaseID
		);
		$res = DB::doQuery($sql);
		return $res != null;
	}
}
