<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = Feb 27,05                    =
// Filename: processApproval.php               =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OMS                          =
// Processes all Approvals                     =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );
}
$userid = $_SESSION['user'];
$userrole = $_SESSION['userrole'];
$usertype = $_SESSION['usertype'];

include('classes/userClass.php');
include_once('classes/loginClass.php');
include_once('classes/approvalClass.php');
include_once('classes/workorderClass.php');
include_once('classes/emailClass.php');

$wfrecnum = $_REQUEST['wfrecnum'];
$worecnum = $_REQUEST['worecnum'];
$typenum = $_REQUEST['typerecnum'];
$drecnum = $_REQUEST['drecnum'];
//$type = $_SESSION['wotype'];
//$type = $_SESSION['wotype'];
$type = 'Aerowings';
$nextstatus = $_REQUEST['nextstatus'];
$stagenum = $_REQUEST['stagenum'];
$userid = $_SESSION['user'];

$newlogin = new userlogin;
$newlogin->dbconnect();


   $newapproval = new approval;
   $newEmail = new email;
   $sql = "start transaction";
   $result = mysql_query($sql);
   $newapproval->updSignOff($worecnum, $wfrecnum,$nextstatus,$drecnum,$stagenum);
//   $newEmail->SendWOStatusEmail($worecnum, $nextstatus);
   $sql = "commit";
   $result = mysql_query($sql);
   if(!$result) die("Commit failed for" . $type . " Approval..Please report to Sysadmin. " . mysql_error());


if ($type == 'Aerowings') {
   if ($usertype == 'EMPL') {
      if ($userrole == 'DESG_B') {
        header("Location:ruboard.php?typenum=$typenum&worecnum=$worecnum");
      }
      else  if ($userrole == 'SU' || $userrole == 'RU'||$userrole == 'OP') {
        header("Location:woDetails.php?typenum=$typenum&worecnum=$worecnum");
      }
   }
   if ($usertype == 'CUST') {
       header("Location:custboard.php?typenum=$typenum&worecnum=$worecnum");
   }
}

else if ($type == 'Socket') {
   if ($usertype == 'EMPL') {
      if ($userrole == 'DESG_S') {
        header("Location:rusocket.php?typenum=$typenum&worecnum=$worecnum");
      }
      else  if ($userrole == 'SU') {
        header("Location:woDetails.php?typenum=$typenum&worecnum=$worecnum");
      }
   }
   if ($usertype == 'CUST') {
       header("Location:custsocket.php?typenum=$typenum&worecnum=$worecnum");
   }
}

else if ($type == 'PCBA') {
   if ($usertype == 'EMPL') {
      if ($userrole == 'DESG_S') {
        header("Location:rupcba.php?typenum=$typenum&worecnum=$worecnum");
      }
      else  if ($userrole == 'SU') {
        header("Location:pcba.php?typenum=$typenum&worecnum=$worecnum");
      }
   }
   if ($usertype == 'CUST') {
       header("Location:pcba.php?typenum=$typenum&worecnum=$worecnum");
   }
}

else {
   header("Location:login.php");
}

?>








