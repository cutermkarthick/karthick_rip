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
//$typenum = $_REQUEST['typenum'];
$notes = $_REQUEST['spec_instrns'];
 if (isset($_REQUEST['opportunityrecnum']))
{
	$opportunityrecnum=$_REQUEST['opportunityrecnum'];
  }
  else if (isset($_SESSION['opportunityrecnum']))
  {

}
$opportunityrecnum = $_REQUEST['opportunityrecnum'];
//$wotype = $_REQUEST['type'];
$userrole = $_SESSION['userrole'];
$usertype = $_SESSION['usertype'];
//$wonum = $_SESSION['wonum'];

//echo "<br>typenum is " . $typenum;
//echo "<br>type is " . $type;
//echo "<br>userrole is " . $userrole;
//echo "<br>usertype is " . $usertype;
// First include the class definition
include_once('classes/loginClass.php');
include('classes/workorderClass.php');
include('classes/opportunityClass.php');
$newlogin = new userlogin;
$newlogin->dbconnect();
$newwo = new workOrder;
$newopportunity = new opportunity;
$newopportunity->addNotes($opportunityrecnum,$notes);

/*if ($usertype == 'EMPL') {
   if ($userrole == 'SU' || $userrole == 'SALES') {
     // header("Location:opportunityDetails.php");
   }
}
if ($usertype == 'EMPL') {
   if ($userrole == 'SU' || $userrole == 'SALES PERSON') {
     // header("Location:opportunityDetails.php");
   }
}
else {  }   */
  header("Location:opportunity.php");
?>