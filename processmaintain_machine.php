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
include('classes/maintain_machineclass.php');

// Next, create an instance of the classes required

//$newQGen= new genericQuote;
$newmm = new maintain_machine;

// Get all fields related to quote general info

$userid = $_SESSION['user'];

$machineid=$_REQUEST['machineid'];
$purpose=$_REQUEST['purpose'];
$task=$_REQUEST['task'];
$task_time=$_REQUEST['task_time'];
$cost=$_REQUEST['cost'];
$currency=$_REQUEST['currency'];


// Database Connect
$newlogin = new userlogin;
$newlogin->dbconnect();

if ($pagename == 'new_maintain_machine' )
{

  $newlogin = new userlogin;
  $newlogin->dbconnect();
  $newmm->setmachineid($machineid);
  $newmm->setpurpose($purpose);
  $newmm->settask($task);
  $newmm->settask_time($task_time);
  $newmm->setcost($cost);
  $newmm->setcurrency($currency);

  $sql = "start transaction";
  $result = mysql_query($sql);
  $maintain_machinerecnum = $newmm->addmaintain_machine();
  
}
else
{
    $maintain_machinerecnum = $_REQUEST['maintain_machinerecnum'];
    $newlogin = new userlogin;
    $newlogin->dbconnect();
    $newmm->setmachineid($machineid);
    $newmm->setpurpose($purpose);
    $newmm->settask($task);
    $newmm->settask_time($task_time);
    $newmm->setcost($cost);
    $newmm->setcurrency($currency);

    $sql = "start transaction";
    $result = mysql_query($sql);
    $newmm->updatemaintain_machine($maintain_machinerecnum);

}


       header ( "Location: maintain_machine_summary.php" );

?>
