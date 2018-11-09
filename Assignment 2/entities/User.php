<?php
class User {
	private $UserID, $Prename, $Surname, $Password, $Email, $Address, $City, $ZIP, $Country;

	public function getName(){
		return $this->Email;
	}

	public function __toString(){
		return sprintf("%d) %s", $this->UserID, $this.getName());
	}

	static public function getUsers() {
		$users = array();
		$res = DB::doQuery(
			"SELECT * FROM Users;"
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
			"SELECT * FROM Users WHERE UserID = $id"
		);
		if (!$res) return null;
		return $res->fetch_object(get_class());
	}

	static public function delete($id) {
		$id = (int) $id;
		$res = DB::doQuery(
			"DELETE FROM Users WHERE UserID = $id"
		);
		return $res != null;
	}

	static public function insert($values) {
		$stmt = DB::getInstance()->prepare(
			"INSERT INTO Users ".
			"(Prename, Surname, Password, Email, Address, City, ZIP, Country, isAdmin) ".
			"VALUES (?,?,?,?,?,?,?,?,0)"
		);
		if (!$stmt) return false;
		$success = $stmt->bind_param('ssssssis',
			$values['prename'],
			$values['surname'],
			$values['pw'],
			$values['email'],
			$values['address'],
			$values['city'],
			$values['zip'],
			$values['country']
		);
		if (!$success) return false;
		return $stmt->execute();
	}

	public function set($values){
		$db = DB::getInstance();
		$this->Prename = $db->escape_string($values['Prename']);
		$this->Surname = $db->escape_string($values['Surname']);
		$this->Password = $db->escape_string($values['Password']);
		$this->Email = $db->escape_string($values['Email']);
		$this->Address = $db->escape_string($values['Address']);
		$this->City = $db->escape_string($values['City']);
		$this->ZIP = $db->escape_string($values['ZIP']);
		$this->Country = $db->escape_string($values['Country']);
	}

	public function save() {
		$sql = sprintf(
			"UPDATE User
			 SET Prename='%s', Surname='%s', Password='%s', Email='%s', Address='%s', City='%s', ZIP='%d', Country='%s'
			 WHERE UserID = %d;",
			 $this->Prename,
			 $this->Surname,
			 $this->Password,
			 $this->Email,
			 $this->Address,
			 $this->City,
			 $this->ZIP,
			 $this->Country,
			 $this->UserID
		);
		$res = DB::doQuery($sql);
		return $res != null;
	}
}