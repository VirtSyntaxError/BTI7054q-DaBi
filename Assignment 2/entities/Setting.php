<?php
class Setting {
	private $id, $settingname, $settingvalue;

	public function __toString(){
		return sprintf("%d) %s = %s", $this->id, $this->settingname, $this->settingvalue);
	}

	static public function getSettings() {
		$settings = array();
		$res = DB::doQuery(
			"SELECT * FROM Setting;"
		);
		if (!$res) return null;
		while ($setting = $res->fetch_object(get_class())){
			$settings[] = $setting;
		}
		return $settings;
	}

	static public function getSettingById($id) {
		$id = (int) $id;
		$res = DB::doQuery(
			"SELECT * FROM Setting WHERE SettingID = $id"
		);
		if (!$res) return null;
		return $res->fetch_object(get_class());
	}

	static public function delete($id) {
		$id = (int) $id;
		$res = DB::doQuery(
			"DELETE FROM Setting WHERE SettingID = $id"
		);
		return $res != null;
	}

	static public function insert($values) {
		$stmt = DB::getInstance()->prepare(
			"INSERT INTO Setting ".
			"(SettingName, SettingValue) ".
			"VALUES (?, ?)"
		);
		if (!$stmt) return false;
		$success = $stmt->bind_param('ss',
			$values['SettingName'],
			$values['SettingValue']
		);
		if (!$success) return false;
		return $stmt->execute();
	}

	public function set($values){
		$db = DB::getInstance();
		$this->settingname = $db->escape_string($values['SettingName']);
		$this->settingvalue = $db->escape_string($values['SettingValue']);
	}

	public function save() {
		$sql = sprintf(
			"UPDATE Setting
			 SET SettingName='%s', SettingValue='%s'
			 WHERE SettingID = %d;",
			 $this->settingname,
			 $this->settingvalue,
			 $this->id
		);
		$res = DB::doQuery($sql);
		return $res != null;
	}
}