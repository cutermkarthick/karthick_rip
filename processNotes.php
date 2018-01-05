<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = June 20, 2004                =
// Filename: processNotes.php                  =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OWT                          =
// Process Notes                               =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];
$typenum = $_REQUEST['typenum'];
$notes = htmlspecialchars($_REQUEST['spec_instrns'],ENT_QUOTES);

if ( !isset ( $_REQUEST['worecnum'] ) )
{
     header ( "Location: login.php" );

}
$worecnum = $_REQUEST['worecnum'];
$wotype = $_REQUEST['type'];
$userrole = $_SESSION['userrole'];
$usertype = $_SESSION['usertype'];
$wonum = $_SESSION['wonum'];

//echo "<br>typenum is " . $typenum;
//echo "<br>type is " . $type;
//echo "<br>userrole is " . $userrole;
//echo "<br>usertype is " . $usertype;
// First include the class definition
include_once('classes/loginClass.php');
include('classes/workorderClass.php');

$newlogin = new userlogin;
$newlogin->dbconnect();
$newwo = new workOrder;
$newwo->addNotes($worecnum,$notes);

if ($usertype == 'EMPL') {
   if ($userrole == 'SU' || $userrole == 'SALES' || $userrole == 'RU') {
      header("Location:woDetails.php?typenum=$typenum&wotype=$wotype&worecnum=$worecnum&wonum=$wonum");
   }
}
if ($usertype == 'EMPL') {
   if ($userrole == 'SU' || $userrole == 'SALES PERSON') {
      header("Location:woDetails.php?typenum=$typenum&wotype=$wotype&worecnum=$worecnum&wonum=$wonum");
   }
}
else { header("Location:login.php"); }

?>
