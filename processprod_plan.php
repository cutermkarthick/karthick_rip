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

include_once('classes/loginClass.php');
include('classes/prod_planclass.php');

// Next, create an instance of the classes required

//$newQGen= new genericQuote;
$newPP = new prod_plan;

// Get all fields related to quote general info

$userid = $_SESSION['user'];

$partnum=$_REQUEST['partnum'];
$customer=$_REQUEST['customer'];
$description=$_REQUEST['description'];
$target=$_REQUEST['target'];
$start_date=$_REQUEST['start_date'];
$end_date=$_REQUEST['end_date'];
$status=$_REQUEST['status'];

// Database Connect
$newlogin = new userlogin;
$newlogin->dbconnect();

if ($pagename == 'new_prod_plan' )
{

  $newlogin = new userlogin;
  $newlogin->dbconnect();
  $newPP->setpartnum($partnum);
  $newPP->setcustomer($customer);
  $newPP->setdescription($description);
  $newPP->settarget($target);
  $newPP->setstart_date($start_date);
  $newPP->setend_date($end_date);
  $newPP->setstatus($status);

  $sql = "start transaction";
  $result = mysql_query($sql);
  $prod_planrecnum = $newPP->addprod_plan();

}
else
{
    $prod_planrecnum = $_REQUEST['prod_planrecnum'];
    $newlogin = new userlogin;
    $newlogin->dbconnect();
    $newPP->setpartnum($partnum);
    $newPP->setcustomer($customer);
    $newPP->setdescription($description);
    $newPP->settarget($target);
    $newPP->setstart_date($start_date);
    $newPP->setend_date($end_date);
    $newPP->setstatus($status);

    $sql = "start transaction";
    $result = mysql_query($sql);
    $newPP->updateprod_plan($prod_planrecnum);
}


       header ( "Location: prod_plan_summary.php" );

?>
