<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = June 20, 2004                =
// Filename: processNotes4task.php             =
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

$notes = $_REQUEST['spec_instrns'];
$task=$_REQUEST['task'];
$date=$_REQUEST['date'];
$id=$_REQUEST['id'];

if ( !isset ( $_REQUEST['tasklistrecnum'] ) )
{
     header ( "Location: login.php" );

}
if (isset($_REQUEST['tasklistrecnum']))
{
	$tasklistrecnum=$_REQUEST['tasklistrecnum'];
  }
  else if (isset($_SESSION['tasklistrecnum']))
  {

}

// First include the class definition
include_once('classes/loginClass.php');
include('classes/tasklistClass.php');

$newlogin = new userlogin;
$newtask= new tasklist;

$newtask->settask($task);
$newtask->addNotes($tasklistrecnum,$notes);
$date=str_replace(" ","%20",$date);
$task=str_replace(" ","%20",$task);
header("Location:addNotes4task.php?tasklistrecnum=$tasklistrecnum&task=$task&date=$date&id=$id");
?>