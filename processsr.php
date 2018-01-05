<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = June 20, 2004                =
// Filename: processsr.php                     =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OWT                          =
// Processes                                   =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];


$pagenamename= $_SESSION['pagename'];
//echo "$pagenamename";
// First include the class definition
include('classes/srClass.php');
 include('classes/supportClass.php');

// Get all fields related to work order general info

// Next, create an instance of the class
$newsr = new sr;
$newsupp = new support;

$srnum = $_REQUEST['srnum'];
$worecnum = $_REQUEST['worecnum'];
$drawing_rev = $_REQUEST['drawing'];
$title = $_REQUEST['title'];
$reportedby = $_REQUEST['reportedval'];
$status = $_REQUEST['srstatusval'];
$priority = $_REQUEST['priorityval'];
$error_desc = $_REQUEST['error_desc'];
$sr2customer = $_REQUEST['companyrecnum'];
$sr2contact = $_REQUEST['contactrecnum'];
$sr2employee = $_REQUEST['empnum'];
$sr2solution = $_REQUEST['solrecnum'];
$receiveddate= $_REQUEST['rec_date'];

if($sr2solution=='')
$sr2solution=0;
$createdate = '';
$docdate = $_REQUEST['doc_date'];
$received_date= $_REQUEST['rec_date'];

$duedate=$_REQUEST['due_date'];
//echo "$reportedby";

/*
echo "solrecnum :$sr2solution</br>";


echo "srnum :$srnum</br>";
echo "srtype :$srtype</br>";
echo "worecnum :$worecnum</br>";
echo "drawing :$drawing_rev</br>";
echo "title :$title</br>";
echo "status :$status</br>";
echo "priority :$priority</br>";
echo "error :$error_desc</br>";
echo "cust :$sr2customer</br>";
echo "cont :$sr2contact</br>";
echo "emp :$sr2employee</br>";
echo "sol :$sr2solution</br>";
echo "cdate :$createdate</br>";
echo "ddate :$docdate</br>";
echo "redate :$received_date</br>";
*/
/// Database Connect
$newlogin = new userlogin;
$newlogin->dbconnect();
// Set the fields

$newsr->setsrnum($srnum);

$newsr->setdrawing_rev($drawing_rev);
$newsr->settitle($title);
$newsr->setreportedby($reportedby);
$newsr->setstatus($status);
$newsr->setpriority($priority);
$newsr->seterror_desc($error_desc);
$newsr->setcreatedate($createdate);
$newsr->setdocdate($docdate);
$newsr->setreceived_date($received_date);
$newsr->setdueddate($duedate);


//echo "$pagenamename";
if ($pagenamename == 'newsr') {
   $sql = "start transaction";
   $result = mysql_query($sql);
   $srrecnum=  $newsr->addsr();
   $sql = "commit";
   $result = mysql_query($sql);
   if(!$result) die("Commit failed for New Service Request.Please report to Sysadmin. " . mysql_error());
   $sql = "start transaction";
   $result = mysql_query($sql);
   $newsupp->settype('SR');
   $newsupp->setstatus('SR open');
   $newsupp->setcondition('progress');
   $newsupp->setsupp2type($srrecnum);
   $newsupp->setsupp2wo($worecnum);
   $newsupp->setsupp2customer($sr2customer);
   $newsupp->setsupp2contact($sr2contact);
   $newsupp->setsupp2employee($sr2employee);
   $newsupp->setsupp2solution($sr2solution);
   $newsupp->setreceived_date($receiveddate);
   $newsupp->addsupport();
   $sql = "commit";
   $result = mysql_query($sql);
   if(!$result) die("Commit failed for New Support.Please report to Sysadmin. " . mysql_error());

}
if ($pagenamename == 'updatesr') {
$srrecnum = $_SESSION['srrecnum'];
   $sql = "start transaction";
   $result = mysql_query($sql);
   $newsr->updatesr($srrecnum);
   $sql = "commit";
   $result = mysql_query($sql);
   if(!$result) die("Commit failed for Service Request update..Please report to Sysadmin. " . mysql_error());
   $sql = "start transaction";
   $result = mysql_query($sql);
   $newsupp->settype('SR');
   $newsupp->setstatus('SR open');
   $newsupp->setcondition('progress');
   $newsupp->setsupp2type($srrecnum);
   $newsupp->setsupp2wo($worecnum);
   $newsupp->setsupp2customer($sr2customer);
   $newsupp->setsupp2contact($sr2contact);
   $newsupp->setsupp2employee($sr2employee);
   $newsupp->setsupp2solution($sr2solution);
   $newsupp->setreceived_date($receiveddate);
   $newsupp->updatesupport($srrecnum,'SR');
   $sql = "commit";
   $result = mysql_query($sql);
//echo "i am here";
   if(!$result) die("Commit failed for Update Support.Please report to Sysadmin. " . mysql_error());

}
header("Location:supportsummary.php");

?>