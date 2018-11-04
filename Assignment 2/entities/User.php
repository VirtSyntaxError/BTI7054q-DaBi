<?php
class User {
	private $id, $prename, $surname, $password, $email, $address, $city, $zip, $country;

	public function getName(){
		return $this.email;
	}

	public function __toString(){
		return sprintf("%d) %s", $this->id, $this.getName());
	}

	static public function getUsers() {
		$users = array();
		$res = DB::doQuery(
			"SELECT * FROM User;"
		);
		if (!$res) return null;
		while ($user = $res->fetch_object(get_class())){
			$users[] = $user;
		}
		return $users;
	}

	static public function getUserById($id) {
		$id = (int) $id;
		$res = DB::doQuery(
			"SELECT * FROM User WHERE UserID = $id"
		);
		if (!$res) return null;
		return $res->fetch_object(get_class());
	}

	static public function delete($id) {
		$id = (int) $id;
		$res = DB::doQuery(
			"DELETE FROM User WHERE UserID = $id"
		);
		return $res != null;
	}

	static public function insert($values) {
		$stmt = DB::getInstance()->prepare(
			"INSERT INTO User ".
			"(Prename, Surname, Password, Email, Address, City, ZIP, Country) ".
			"VALUES (?,?,?,?,?,?,?,?)"
		);
		if (!$stmt) return false;
		$success = $stmt->bind_param('ssssssis',
			$values['Prename'],
			$values['Surname'],
			$values['Password'],
			$values['Email'],
			$values['Address'],
			$values['City'],
			$values['ZIP'],
			$values['Country']
		);
		if (!$success) return false;
		return $stmt->execute();
	}

	public function set($values){
		$db = DB::getInstance();
		$this->prename = $db->escape_string($values['Prename']);
		$this->surname = $db->escape_string($values['Surname']);
		$this->password = $db->escape_string($values['Password']);
		$this->email = $db->escape_string($values['Email']);
		$this->address = $db->escape_string($values['Address']);
		$this->city = $db->escape_string($values['City']);
		$this->zip = $db->escape_string($values['ZIP']);
		$this->country = $db->escape_string($values['Country']);
	}

	public function save() {
		$sql = sprintf(
			"UPDATE User
			 SET Prename='%s', Surname='%s', Password='%s', Email='%s', Address='%s', City='%s', ZIP='%d', Country='%s'
			 WHERE UserID = %d;",
			 $this->prename,
			 $this->surname,
			 $this->password,
			 $this->email,
			 $this->address,
			 $this->city,
			 $this->zip,
			 $this->country
		);
		$res = DB::doQuery($sql);
		return $res != null;
	}
}