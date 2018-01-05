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
include('classes/capacity_planclass.php');

// Next, create an instance of the classes required

//$newQGen= new genericQuote;
$newCP = new capacity_plan;

// Get all fields related to quote general info

$userid = $_SESSION['user'];

$machineid=$_REQUEST['machineid'];
$av_cap=$_REQUEST['av_cap'];
$used_cap=$_REQUEST['used_cap'];
$unused_cap=$_REQUEST['unused_cap'];

// Database Connect
$newlogin = new userlogin;
$newlogin->dbconnect();

if ($pagename == 'new_capacity_plan')
{

  $newlogin = new userlogin;
  $newlogin->dbconnect();
  $newCP->setmachineid($machineid);
  $newCP->setav_cap($av_cap);
  $newCP->setused_cap($used_cap);
  $newCP->setunused_cap($unused_cap);

  $sql = "start transaction";
  $result = mysql_query($sql);
  $capacity_planrecnum = $newCP->addcapacity_plan();
}
else
{
    $capacity_planrecnum = $_REQUEST['capacity_planrecnum'];
    $newlogin = new userlogin;
    $newlogin->dbconnect();
    $newCP->setmachineid($machineid);
    $newCP->setav_cap($av_cap);
    $newCP->setused_cap($used_cap);
    $newCP->setunused_cap($unused_cap);


    $sql = "start transaction";
    $result = mysql_query($sql);
    $newCP->updatecapacity_plan($capacity_planrecnum);
}

    header ( "Location: capacity_plan_summary.php" );

?>
