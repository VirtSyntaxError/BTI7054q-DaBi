<?php
define("ROOT", "./");

require_once("header.php"); 

$id = isset($_GET['id']) ? $_GET['id'] : 0;
include("page_$id.php"); 

require_once("footer.php"); 
