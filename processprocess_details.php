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
include('classes/process_detailsclass.php');

// Next, create an instance of the classes required

//$newQGen= new genericQuote;
$newpd = new process_details;

// Get all fields related to quote general info

$userid = $_SESSION['user'];

$partnum=$_REQUEST['partnum'];
$part_tasks=$_REQUEST['part_tasks'];
$mfg_cycle_time=$_REQUEST['mfg_cycle_time'];
$inspection_time=$_REQUEST['inspection_time'];

// Database Connect
$newlogin = new userlogin;
$newlogin->dbconnect();

if ($pagename == 'new_process_details' )
{

  $newlogin = new userlogin;
  $newlogin->dbconnect();
  $newpd->setpartnum($partnum);
  $newpd->setpart_tasks($part_tasks);
  $newpd->setmfg_cycle_time($mfg_cycle_time);
  $newpd->setinspection_time($inspection_time);

  $sql = "start transaction";
  $result = mysql_query($sql);
  $process_detailsrecnum = $newpd->addprocess_details();

}
else
{
    $process_detailsrecnum = $_REQUEST['process_detailsrecnum'];
    $newlogin = new userlogin;
    $newlogin->dbconnect();
    $newpd->setpartnum($partnum);
    $newpd->setpart_tasks($part_tasks);
    $newpd->setmfg_cycle_time($mfg_cycle_time);
    $newpd->setinspection_time($inspection_time);

    $sql = "start transaction";
    $result = mysql_query($sql);
    $newpd->updateprocess_details($process_detailsrecnum);

}


       header ( "Location: process_details_summary.php" );

?>
