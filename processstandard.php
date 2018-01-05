<?php
//
//==============================================
// Author: FSI                                 =
// Date-written =July 5, 2005                  =
// Filename: processQuoteGeneric.php           =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 WMS                          =
//==============================================

session_start();
header("Cache-control: private");

$pagename = $_SESSION['pagename'];
$action = $_REQUEST['action'];

include_once('classes/loginClass.php');
include('classes/standardclass.php');


// Next, create an instance of the classes required

//$newQGen= new genericQuote;
$newstd = new standard;


// Get all fields related to quote general info

$userid = $_SESSION['user'];

$file ='';
$check1=$_FILES['file']['name'] ;
if ($check1 != '' )
{
	 $file = $userid . '_' . $_FILES['file']['name'];
	 $file = preg_replace('/\s+/',' ',$file);
  	 $file = preg_replace('/\s/','_',$file);
	//echo "$excelfile<br>";
	 $file = strtolower($file);
}
 if($check1 != '')
 {
  $newstd->setfile($check1);
 }
$name=$_REQUEST['name'];
$description=$_REQUEST['description'];

$action = $_REQUEST['action'];

// Database Connect
$newlogin = new userlogin;
$newlogin->dbconnect();



if ($pagename == 'standards' )
{
//	$type=$_REQUEST['quotetype'];
//	$newQGen->settype($type);

	// Get quote details

//	$genrecnum=$newQGen->addgenericQuote();
//	$newQuote->setquote2type($genrecnum);
//   	$quoterecnum = $newQuote->addQuote();

  $newlogin = new userlogin;
  $newlogin->dbconnect();
  $newstd->setname($name);
  $newstd->setdescription($description);

  $sql = "start transaction";
  $result = mysql_query($sql);
  $final_insprecnum = $newstd->addstandard();
}
else
{
    $standardrecnum = $_REQUEST['standardrecnum'];
    $newlogin = new userlogin;
    $newlogin->dbconnect();
    $newstd->setname($name);
    $newstd->setdescription($description);

    $sql = "start transaction";
    $result = mysql_query($sql);
    $newstd->updatestandard($standardrecnum);

}


       header ( "Location: standards.php" );

?>
