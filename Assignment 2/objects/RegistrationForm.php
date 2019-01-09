<?php
class RegistrationForm {
	private $readonly = false;
	private $loggedin = false;
	private $showuser = true;
	private $action = "";
	private $onsubmit = "";
	private $submit = "";
	private $formid = "";
	private $additionalrows = [];

	public function __construct(bool $readonly, String $action, String $submit){
		$this->readonly = $readonly;
		$this->action = $action;
		$this->submit = $submit;
	}

	public function setShowUser(bool $showuser){
		$this->showuser = $showuser;
	}

	public function setOnSubmit(String $onsubmit){
		$this->onsubmit = $onsubmit;
	}

	public function setFormId(String $formid){
		$this->formid = $formid;
	}

	public function addAdditionalRow(array $row){
		$this->additionalrows[] = $row;
	}

	public function setReadonly(bool $readonly){
		$this->readonly = $readonly;
	}

	public function setLoggedIn(bool $loggedin){
		$this->loggedin = $loggedin;
	}

	public function render(){
		session_start();
		$columns = array("","");	
		$rows = array();
		if($this->loggedin) {
			$user = User::getUserByUsername($_SESSION['user']);
			$prename = $user->getPrename();
			$surname = $user->getSurname();
			$email = $user->getEmail();
			$address = $user->getAddress();
			$zip = $user->getZip();
			$city = $user->getCity();
			$country = $user->getCountry();
		} else {	
			$prename = $_COOKIE['prename'] ?? "";
			$surname = $_COOKIE['surname'] ?? "";
			$email = $_COOKIE['email'] ?? "";
			$address = $_COOKIE['address'] ?? "";
			$zip = $_COOKIE['zip'] ?? "";
			$city = $_COOKIE['city'] ?? "";
			$country = $_COOKIE['country'] ?? "";
		}
		$error = "";

		$rows[] = array(t("PRENAME"),'<input name="prename" required pattern="^[A-Za-zäöü ,.\'-]{3,}$" value="'.$prename.'" '.(($this->readonly) ? "readonly" : "autofocus").'>');
		$rows[] = array(t("SURNAME"),'<input name="surname" required pattern="^[A-Za-zäöü ,.\'-]{3,}$" value="'.$surname.'" '.(($this->readonly) ? "readonly" : "").'>');
		if($this->showuser) {
			$rows[] = array(t("USERNAME"),'<input name="username" required pattern="^[A-Za-z0-9.-]{3,}$" '.(($this->readonly) ? "readonly" : "").'>');
			$rows[] = array(t("PASSWORD"),'<input type="password" name="pw" '.(($this->readonly) ? "readonly" : "").'>');
		}
		$rows[] = array(t("EMAIL"),'<input type="email" name="email" value="'.$email.'" '.(($this->readonly) ? "readonly" : "").'>');
		$rows[] = array(t("ADDRESS"),'<input name="address" required  pattern="^[A-Za-zäöü ,.\'-]{3,} [0-9a-z]+$" value="'.$address.'"  '.(($this->readonly) ? "readonly" : "").'>');
		$rows[] = array(t("CITY"),'<input name="city" required pattern="^[A-Za-zäöü ,.\'-]{3,}$" value="'.$city.'"  '.(($this->readonly) ? "readonly" : "").'>');
		$rows[] = array(t("ZIP"),'<input name="zip" required pattern="^[0-9]{1,5}$" value="'.$zip.'" '.(($this->readonly) ? "readonly" : "").'>');
		$rows[] = array(t("COUNTRY"),'
		<select name="country"  '.(($this->readonly) ? "disabled" : "").'>
			<option value="CH" '.(($country == "CH") ? "selected" : "").'>'.t("CH").'</option>
			<option value="DE" '.(($country == "DE") ? "selected" : "").'>'.t("DE").'</option>
			<option value="AT" '.(($country == "AT") ? "selected" : "").'>'.t("AT").'</option>
		</select>');
		
		$rows = array_merge($rows, $this->additionalrows);	
	
		$rows[] = array("",'<input type="submit" value="'.t($this->submit).'">');

		$table = new Table($rows,$columns);

		echo '<form method="post"';
		if($this->onsubmit) {
			echo ' onsubmit="'.$this->onsubmit.'"';
		}
		if($this->formid) {
			echo ' id="'.$this->formid.'"';
		}
		echo ' action="'.$this->action.'">';

		$table->render();
	
		if(isset($_GET["error"])) {
			$error = t(strip_tags($_GET["error"]));
		}	
		echo '</form>';
		echo '<label id="userexists">'.$error.'</label>';
	}
}
