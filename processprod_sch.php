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
include('classes/production_schclass.php');


// Next, create an instance of the classes required

//$newQGen= new genericQuote;
//$newstd = new standard;


// Get all fields related to quote general info

$userid = $_SESSION['user'];

$partnum=$_REQUEST['partnum'];
$quantity=$_REQUEST['quantity'];
$due_date=$_REQUEST['due_date'];


//$action = $_REQUEST['action'];

// Database Connect
$newlogin = new userlogin;
$newlogin->dbconnect();


//$est_time = $quantity / 40;

$est_days = $quantity / 40;

$timeStamp = @strtotime($due_date);
$timeStamp -= 24 * 60 * 60 * $est_days;

$newdate = date("Y-m-d", $timeStamp);


/*
if ($pagename == 'production_sch' )
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

}      */


       header ( "Location: production_sch.php?partnum=$partnum&quantity=$quantity&due_date=$due_date&est_start_date=$newdate" );

?>
