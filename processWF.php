<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = June 20, 2004                =
// Filename: processCompany.php                =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OMS                          =
// Processes Companies                         =
//==============================================

session_start();
header("Cache-control: private"); 

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );
    
}
$pagename = $_SESSION['pagename']; 

// First include the class definition 
include('classes/workflowClass.php'); 

// Get all fields related to work order general info

// Next, create an instance of the class 
$newWF = new workflow; 

$stage = $_REQUEST['stage'];
$type = $_REQUEST['type'];
$doctype = $_REQUEST['doctype'];  
$dept = $_REQUEST['dept'];  
$status = $_REQUEST['status'];  
$emaillist = $_REQUEST['emaillist'];
$apprtype = $_REQUEST['apprtype'];
$apprby = $_REQUEST['apprby'];
$allowcustdisp = $_REQUEST['allowcustdisp'];
$allowprintdisp = $_REQUEST['allowprintdisp'];
$allowreportdisp = $_REQUEST['allowreportdisp'];
$custstatusdisp = $_REQUEST['custstatusdisp'];
$est_time = $_REQUEST['est_time'];
$est_cost = $_REQUEST['est_cost'];
$act_status = $_REQUEST['act_status'];
$dependency = $_REQUEST['dependency'];
$sec_respose = $_REQUEST['sec_respose'];
$process = $_REQUEST['process'];
$when_process = $_REQUEST['when_process'];
$est_mins = $_REQUEST['est_mins'];
$currency = $_REQUEST['currency'];
$pagename = $_REQUEST['pagename'];
$primary_respose = $_REQUEST['primary_respose'];


$estimate_time = $est_time.":".$est_mins;
// Database Connect
$newlogin = new userlogin;
$newlogin->dbconnect();
// Set the fields
$newWF->setstage($stage);
$newWF->settype($type);
$newWF->setdoctype($doctype);
$newWF->setdept($dept);
$newWF->setstatus($status);
$newWF->setemaillist($emaillist);
$newWF->setapprtype($apprtype);
$newWF->setapprby($apprby);
$newWF->setallowcustdisp($allowcustdisp);
$newWF->setallowprintdisp($allowprintdisp);
$newWF->setallowreportdisp($allowreportdisp);
$newWF->setcuststatusdisp($custstatusdisp);
$newWF->setest_time($estimate_time);
$newWF->setest_cost($est_cost);
$newWF->setact_status($act_status);
$newWF->setdependency($dependency);

$newWF->setsec_respose($sec_respose);
$newWF->setprocess($process);
$newWF->setwhen_process($when_process);
$newWF->setcurrency($currency);
$newWF->setprimary_respose($primary_respose);


if ($pagename == 'addwfstage') {
   $sql = "start transaction";
   $result = mysql_query($sql);
   $newWF->addWFStage();
   $sql = "commit";
   $result = mysql_query($sql);
   if(!$result) die("Commit failed for New Workflow COnfig..Please report to Sysadmin. " . mysql_error()); 
}
if ($pagename == 'editwf') {
   $sql = "start transaction";
   $result = mysql_query($sql);
   $newWF->updateWFStage($stage, $type);
   $sql = "commit";
   $result = mysql_query($sql);
   if(!$result) die("Commit failed for Workflow Config update..Please report to Sysadmin. " . mysql_error()); 
}
header("Location:wfdetails.php?wftype=$type");
?>
