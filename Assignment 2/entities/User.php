<?php
class User {
	private $UserID, $Prename, $Surname, $Password, $Email, $Address, $City, $ZIP, $Country, $isAdmin, $Username;

	public function getUsername(){
		return $this->Username;
	}

	public function getIsAdmin(){
		return $this->isAdmin;
	}

	public function getUserId(){
		return $this->UserID;
	}

	public function getPrename(){
		return $this->Prename;
	}

	public function getSurname(){
		return $this->Surname;
	}

	public function getEmail(){
		return $this->Email;
	}

	public function getAddress(){
		return $this->Address;
	}

	public function getCity(){
		return $this->City;
	}

	public function getZip(){
		return $this->ZIP;
	}

	public function getCountry(){
		return $this->Country;
	}

	public function setPrename($prename){
		$this->Prename = $prename;
	}

	public function setSurname($surname){
		$this->Surname = $surname;
	}

	public function setEmail($email){
		$this->Email = $email;
	}

	public function setAddress($address){
		$this->Address = $address;
	}

	public function setCity($city){
		$this->City = $city;
	}

	public function setZip($zip){
		$this->ZIP = $zip;
	}

	public function setCountry($country){
		$this->Country = $country;
	}

	public function __toString(){
		return sprintf("%d) %s", $this->UserID, $this->getName());
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
	
	static public function getUsersWithoutGuests() {
		$users = array();
		$res = DB::doQuery(
			"SELECT * FROM User WHERE Username IS NOT NULL;"
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

	static public function getUserByEmail($email) {
		$res = DB::doQuery(
			'SELECT * FROM User WHERE Email = "'.$email.'"'
		);
		if (!$res) return null;
		return $res->fetch_object(get_class());
	}

	static public function getUserByUsername($username) {
		$res = DB::doQuery(
			'SELECT * FROM User WHERE Username = "'.$username.'"'
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
			"(Prename, Surname, Username, Password, Email, Address, City, ZIP, Country, isAdmin) ".
			"VALUES (?,?,?,?,?,?,?,?,?,?)"
		);
		if (!$stmt) return false;
		$isAdmin = 0;
		$success = $stmt->bind_param('sssssssisi',
			$values['prename'],
			$values['surname'],
			$values['username'],
			$values['pw'],
			$values['email'],
			$values['address'],
			$values['city'],
			$values['zip'],
			$values['country'],
			$isAdmin
		);
		if (!$success) return false;
		$stmt->execute();
		return $stmt->insert_id;
	}

	static public function insertGuest($values) {
		$stmt = DB::getInstance()->prepare(
			"INSERT INTO User ".
			"(Prename, Surname, Username, Password, Email, Address, City, ZIP, Country, isAdmin) ".
			"VALUES (?,?,NULL,?,?,?,?,?,?,?)"
		);
		if (!$stmt) return false;
		$isAdmin = 0;
		$success = $stmt->bind_param('ssssssisi',
			$values['prename'],
			$values['surname'],
			$values['pw'],
			$values['email'],
			$values['address'],
			$values['city'],
			$values['zip'],
			$values['country'],
			$isAdmin
		);
		if (!$success) return false;
		$stmt->execute();
		return $stmt->insert_id;
	}

	public function set($values){
		$db = DB::getInstance();
		$this->Prename = $db->escape_string($values['Prename']);
		$this->Surname = $db->escape_string($values['Surname']);
		$this->Username = $db->escape_string($values['Username']);
		$this->Password = $db->escape_string($values['Password']);
		$this->Email = $db->escape_string($values['Email']);
		$this->Address = $db->escape_string($values['Address']);
		$this->City = $db->escape_string($values['City']);
		$this->ZIP = $db->escape_string($values['ZIP']);
		$this->Country = $db->escape_string($values['Country']);
		$this->isAdmin = $db->escape_string($values['isAdmin']);
	}

	public function save() {
		$sql = sprintf(
			"UPDATE User
			 SET Prename='%s', Surname='%s', Username='%s', Password='%s', Email='%s', Address='%s', City='%s', ZIP='%d', Country='%s', isAdmin='%d'
			 WHERE UserID = %d;",
			 $this->Prename,
			 $this->Surname,
			 $this->Username,
			 $this->Password,
			 $this->Email,
			 $this->Address,
			 $this->City,
			 $this->ZIP,
			 $this->Country,
			 $this->isAdmin,
			 $this->UserID
		);
		$res = DB::doQuery($sql);
		return $res != null;
	}
}
