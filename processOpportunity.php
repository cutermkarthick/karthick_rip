<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = June 2, 2006                 =
// Filename: processopportunity.php            =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OMS                          =
// Processes opportunity                       =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];

$pagename= $_SESSION['pagename'];
// First include the class definition

include('classes/opportunityClass.php');
// Get all fields related to leads general info

// Next, create an instance of the class
$newopportunity= new opportunity;

$leadsnum = $_REQUEST['leadname'];
$oppnum = $_REQUEST['oppnum'];
$opp_name = $_REQUEST['opp_name'];
$acc_name = $_REQUEST['acc_name'];
$expected_close_date = $_REQUEST['expected_close_date'];
$sales_stage = $_REQUEST['sales_stage'];
$type = $_REQUEST['type'];
$link2lead = $_REQUEST['link2lead'];
//$link2lead = 0;
$amount_currency = $_REQUEST['amount_currency'];
$currency = $_REQUEST['currency'];
$assigned_to = $_REQUEST['assigned_to'];
$probability = $_REQUEST['probability'];
$next_step = $_REQUEST['next_step'];
$link2salesnotes = $_REQUEST['link2salesnotes'];
$lead_source = $_REQUEST['lead_source'];
$create_date = $_REQUEST['create_date'];
$opp_stagenum=$_REQUEST['opp_stagenum'];
$proposal_date=$_REQUEST['proposal_date'];
$negotiate_date=$_REQUEST['negotiate_date'];
if($opp_stagenum >140 && $opp_stagenum <180)
{
  $proposal_date=$proposal_date;
}
elseif($opp_stagenum==140)
{
  $proposal_date=date('Y-m-d');
}

if($opp_stagenum>150 && $opp_stagenum <180)
{
  $negotiate_date=$negotiate_date;
}
elseif($opp_stagenum==150)
{
  $negotiate_date=date('Y-m-d');
}

// Database Connect
$newlogin = new userlogin;
$newlogin->dbconnect();

$newopportunity->setleadsnum($leadsnum);
$newopportunity->setoppnum($oppnum);
$newopportunity->setopp_name($opp_name);
$newopportunity->setacc_name($acc_name);
$newopportunity->setexpected_close_date($expected_close_date);
$newopportunity->setsales_stage($sales_stage);
$newopportunity->settype($type);
$newopportunity->setlink2lead($link2lead);
$newopportunity->setamount_currency($amount_currency);
$newopportunity->setcurrency($currency);
$newopportunity->setassigned_to($assigned_to);
$newopportunity->setprobability($probability);
$newopportunity->setnext_step($next_step);
$newopportunity->setlink2salesnotes($link2salesnotes);
$newopportunity->setlead_source($lead_source);
$newopportunity->setcreate_date($create_date);
$newopportunity->setoppstagenum($opp_stagenum);
$newopportunity->setproposaldate($proposal_date);
$newopportunity->setnegotiatedate($negotiate_date);

if ($pagename== 'newopportunity') {
//echo "I am here";
   $sql = "start transaction";
   $result = mysql_query($sql);
   $opportunityrecnum = $newopportunity->addOpportunity();
   $sql = "commit";
   $result = mysql_query($sql);
   if(!$result) die("Commit failed for New Service Request.Please report to Sysadmin. " . mysql_error());
}
if ($pagename== 'editopportunity') {
   $opportunityrecnum = $_REQUEST['opportunityrecnum'];
   $sql = "start transaction";
   $result = mysql_query($sql);
   $opportunityrecnum = $newopportunity->updateOpportunity($opportunityrecnum);
   $sql = "commit";
   $result = mysql_query($sql);
   if(!$result) die("Commit failed for Service Request update..Please report to Sysadmin. " . mysql_error());
}
if ($pagename == 'editopportunity') {
  $opportunityrecnum = $_REQUEST['opportunityrecnum'];
    $delete = $_REQUEST['deleteflag'];
}
if ($pagename == 'editopportunity' && $delete == 'y') {
   $newopportunity->deleteOpportunity($opportunityrecnum);
   }
header("Location:opportunity.php");
?>