<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = Feb 1, 2007                  =
// Filename: processNotes4milestone.php        =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OWT                          =
// Process Notes for milestone.                =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}

$notes = $_REQUEST['spec_instrns'];

$wonum=$_REQUEST['wonum'];
$dept=$_REQUEST['dept'];
$position=$_REQUEST['position'];
if ( !isset ( $_REQUEST['worecnum'] ) )
{
     header ( "Location: login.php" );

}
if (isset($_REQUEST['worecnum']))
{
	$worecnum=$_REQUEST['worecnum'];
  }
  else if (isset($_SESSION['worecnum']))
  {

}

// First include the class definition
include_once('classes/loginClass.php');
include('classes/workorderClass.php');

$newlogin = new userlogin;
$newwo = new workOrder;

$newwo->setdept($dept);
$newwo->addNotes4milestone($worecnum,$notes);
//$date=str_replace(" ","%20",$date);
//$task=str_replace(" ","%20",$task);
header("Location:woDetails.php?worecnum=$worecnum&wonum=$wonum&dept=$dept&position=$position");
?>
