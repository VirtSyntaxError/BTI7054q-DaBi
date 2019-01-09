<?php 
require_once("external/PHPMailer.php");
require_once("external/SMTP.php");
require_once("external/Exception.php");
use PHPMailer\PHPMailer\PHPMailer;

class Mail extends PHPMailer {
	
    	public function __construct($exceptions) {
        	parent::__construct($exceptions);
        	$this->setFrom('webshop@goldene-ziffer.ch', 'Goldene Ziffer Webshop');
        	$this->isSMTP();
        	$this->Host = 'tls://smtp.bfh.ch:587';
    	}

	public function setBody(String $body) {
        	$this->msgHTML($body);
	}	

	public function addRecipient(String $recp) {
		$this->addAddress($recp);
	}

	public function setSubject(String $subject) {
		$this->Subject = $subject;
	}

    	public function send() {
        	$send = parent::send();
        	return $send;
    	}
}
