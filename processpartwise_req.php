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
include('classes/partwise_reqclass.php');

// Next, create an instance of the classes required

//$newQGen= new genericQuote;
$newpr = new partwise_req;

// Get all fields related to quote general info

$userid = $_SESSION['user'];

$partnum=$_REQUEST['partnum'];
$customer=$_REQUEST['customer'];
$description=$_REQUEST['description'];
$target=$_REQUEST['target'];
$achieved=$_REQUEST['achieved'];
$balance=$_REQUEST['balance'];
$due_date=$_REQUEST['due_date'];
$status=$_REQUEST['status'];

// Database Connect
$newlogin = new userlogin;
$newlogin->dbconnect();

if ($pagename == 'new_partwise_req' )
{

  $newlogin = new userlogin;
  $newlogin->dbconnect();
  $newpr->setpartnum($partnum);
  $newpr->setcustomer($customer);
  $newpr->setdescription($description);
  $newpr->settarget($target);
  $newpr->setachieved($achieved);
  $newpr->setbalance($balance);
  $newpr->setdue_date($due_date);
  $newpr->setstatus($status);

  $sql = "start transaction";
  $result = mysql_query($sql);
  $partwise_reqrecnum = $newpr->addpartwise_req();

}
else
{
    $partwise_reqrecnum = $_REQUEST['partwise_reqrecnum'];
    $newlogin = new userlogin;
    $newlogin->dbconnect();
    $newpr->setpartnum($partnum);
    $newpr->setcustomer($customer);
    $newpr->setdescription($description);
    $newpr->settarget($target);
    $newpr->setachieved($achieved);
    $newpr->setbalance($balance);
    $newpr->setdue_date($due_date);
    $newpr->setstatus($status);

    $sql = "start transaction";
    $result = mysql_query($sql);
    $newpr->updatepartwise_req($partwise_reqrecnum);

}


       header ( "Location: partwise_req_summary.php" );

?>
