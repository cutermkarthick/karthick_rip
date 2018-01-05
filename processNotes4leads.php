<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = June 20, 2004                =
// Filename: processNotes.php                  =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OMS                          =
// Process Notes                               =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
//$userid = $_SESSION['user'];
//$typenum = $_REQUEST['typenum'];
//$type = $_REQUEST['type'];
$notes = $_REQUEST['spec_instrns'];

if ( !isset ( $_REQUEST['leadsrecnum'] ) )
{
     header ( "Location: login.php" );

}
if (isset($_REQUEST['leadsrecnum']))
{
	$leadsrecnum=$_REQUEST['leadsrecnum'];
  }
  else if (isset($_SESSION['leadsrecnum']))
  {

}
// First include the class definition
include_once('classes/loginClass.php');
include('classes/leadsClass.php');

$newlogin = new userlogin;
$newlogin->dbconnect();
$newLead = new leads;
$newLead->addNotes($leadsrecnum,$notes);

header("Location:leadssummary.php");
?>