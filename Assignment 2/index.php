<?php
define("ROOT", "./");

require_once("header.php"); 

$id = isset($_GET['id']) ? $_GET['id'] : 0;


if(!@include("page_$id.php")) {
	include("page_0.php");
} 

require_once("footer.php"); 
