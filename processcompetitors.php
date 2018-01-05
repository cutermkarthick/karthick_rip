<?php
//==============================================
// Author: FSI                                 =
// Date-written = June 20, 2004                =
// Filename: processcompetitors.php            =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OWT                          =
// Processes competitors                       =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];
$userrecnum = $_SESSION['userrecnum'];
$pagename= $_SESSION['pagename'];
if (isset($_REQUEST['competitorrecnum']))
{
	$competitorrecnum=$_REQUEST['competitorrecnum'];
}


// First include the class definition
include('classes/competitorsClass.php');
// Get all fields related to work order general info

// Next, create an instance of the class
$newcompetitor = new competitor;

//$competitorrecnum =$_REQUEST['competitorrecnum'];
$companyname = $_REQUEST['companyname'];
$revenue = $_REQUEST['revenue'];
$product = $_REQUEST['product'];
$industrysegment = $_REQUEST['industrysegment'];
$notes = $_REQUEST['notes'];
$phone = $_REQUEST['phone'];
$email = $_REQUEST['email'];
$guid = $_REQUEST['guid'];
$address1 = $_REQUEST['address1'];
$address2 = $_REQUEST['address2'];
$city = $_REQUEST['city'];
$state = $_REQUEST['state'];
$zip = $_REQUEST['zip'];
$country = $_REQUEST['country'];

// Database Connect
$newlogin = new userlogin;
$newlogin->dbconnect();
// Set the fields
$newcompetitor->setcompanyname($companyname);
$newcompetitor->setrevenue($revenue);
$newcompetitor->setproduct($product);
$newcompetitor->setindustrysegment($industrysegment);
$newcompetitor->setnotes($notes);
$newcompetitor->setphone($phone);
$newcompetitor->setemail($email);
$newcompetitor->setguid($guid);
$newcompetitor->setaddress1($address1);
$newcompetitor->setaddress2($address2);
$newcompetitor->setcity($city);
$newcompetitor->setstate($state);
$newcompetitor->setzip($zip);
$newcompetitor->setcountry($country);


if ($pagename == 'new_competitor') {
//echo    $sql;
   $sql = "start transaction";
   $result = mysql_query($sql);
   $newcompetitor->addcompetitors();
   $sql = "commit";
   $result = mysql_query($sql);
   if(!$result) die("Commit failed for New competitor..Please report to Sysadmin. " . mysql_error());
}

if ($pagename == 'editcompetitor') {
   $competitorrecnum =$_REQUEST['competitorrecnum'];
   $sql = "start transaction";
   $result = mysql_query($sql);
   $newcompetitor->updatecompetitor($competitorrecnum);
   $sql = "commit";
   $result = mysql_query($sql);
   if(!$result) die("Commit failed for competitor update..Please report to Sysadmin. " . mysql_error());
}

if ($_SESSION['pagename'] == 'editcompetitor') {
$competitorrecnum =$_REQUEST['competitorrecnum'];
    $delete = $_REQUEST['deleteflag'];
}
if ($pagename == 'editcompetitor' && $delete == 'y') {
  $newcompetitor->deletecompetitor($competitorrecnum);
}
header("Location:competitors.php");
?>