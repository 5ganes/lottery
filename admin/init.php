<?php
session_start();
ini_set("register_globals", "off");
ini_set("upload_max_filesize", "20M");
ini_set("post_max_size", "40M");
ini_set("memory_limit", "80M");

require_once("../data/conn.php");
require_once("../data/users.php");
require_once("../data/prize.php");
require_once("../data/type.php");

$conn 					= new Dbconn();		
$users	 				= new Users();	
$prize					= new Prize();
$prizeType				= new Type();

require_once("../data/constants.php");
require_once("../data/sqlinjection.php");
// require_once("../data/youtubeimagegrabber.php");
?>