<?php
session_start();
// error_reporting(E_ERROR);
ini_set("register_globals", "off");
ini_set("upload_max_filesize", "20M");
ini_set("post_max_size", "40M");
ini_set("memory_limit", "80M");

require_once("data/conn.php");
// require_once("data/donate.php");

require_once("data/prize.php");
require_once("data/type.php");

$prize					= new Prize();
$prizeType				= new Type();

$conn 					= new Dbconn();		

require_once("data/constants.php");
require_once("data/sqlinjection.php");

///////////////////////////////////////////////

$query = "";
if (isset($_GET['query']))
	$query = $_GET['query'];
	//echo $query;
if (!empty($query)) {
	$pageRow = $groups->getByURLName($query);
	if ($pageRow) {
		
		$pageLinkType = $pageRow['linkType'];
		if ($pageLinkType == "Link") {
			header("Location: " . $pageRow['contents']);
			exit();
		}		
	}
}
else
	$query='';

// include("menufunction.php");




///////////////IMAGE CALL IMAGER FUNCTION //////////////////////////////


function imager($source, $width, $height, $fix="")
{
	$str = 'data/imager.php?file=../' . CMS_GROUPS_DIR . $source . '&amp;mw=' . $width . '&amp;mh=' . $height;
	if(!empty($fix))
		$str .= '&amp;fix';		
	return $str;
}
?>