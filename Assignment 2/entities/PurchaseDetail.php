<?php
class PurchaseDetail {
	private $PurchaseID, $Count, $ProductID, $StrapID, $ColorID;

	static public function getPurchaseDetails() {
		$pur_det = array();
		$res = DB::doQuery(
			"SELECT * FROM PurchaseDetail;"
		);
		if (!$res) return null;
		while ($pur_det = $res->fetch_object(get_class())){
			$pur_dets[] = $pur_det;
		}
		return $pur_dets;
	}

	static public function insert($values) {
		$stmt = DB::getInstance()->prepare(
			"INSERT INTO PurchaseDetail ".
			"(Count, ProductID, StrapID, ColorID, PurchaseID) ".
			"VALUES (?, ?, ?, ?, ?)"
		);
		if (!$stmt) return false;
		$success = $stmt->bind_param('iiiii',
			$values['Count'],
			$values['ProductID'],
			$values['StrapID'],
			$values['ColorID'],
			$values['PurchaseID']
		);
		if (!$success) return false;
		return $stmt->execute();
	}
	
}