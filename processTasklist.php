<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = September 22, 2006           =
// Filename: processtasklist.php               =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OWT                          =
// Processes tasklist                          =
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

include('classes/tasklistClass.php');

// Next, create an instance of the class

$newtasklist= new tasklist;
$task1 = $_REQUEST['task1'];
$task2 = $_REQUEST['task2'];
$task3 = $_REQUEST['task3'];
$task4 = $_REQUEST['task4'];
$task5 = $_REQUEST['task5'];
$task6 = $_REQUEST['task6'];
$task7 = $_REQUEST['task7'];
$task8 = $_REQUEST['task8'];
$taskdate = $_REQUEST['taskdate'];
//$date = $_REQUEST['date'];

//$task1 = $_REQUEST['task1'] . $_REQUEST['task2'] . $_REQUEST['task3'] . $_REQUEST['task4'] . $_REQUEST['task5']

if (isset($_REQUEST['tasklistrecnum']))
{
	$tasklistrecnum=$_REQUEST['tasklistrecnum'];
}
// Database Connect
$newlogin = new userlogin;
$newlogin->dbconnect();

$newtasklist->setuserid($userid);
$newtasklist->settask1($task1);
$newtasklist->settask2($task2);
$newtasklist->settask3($task3);
$newtasklist->settask4($task4);
$newtasklist->settask5($task5);
$newtasklist->settask6($task6);
$newtasklist->settask7($task7);
$newtasklist->settask8($task8);
$newtasklist->settaskdate($taskdate);
//$newtasklist->setdate($date);


if ($pagename == 'edittasklist')
 {
    $delete = $_REQUEST['deleteflag'];
    if ($delete == 'y')
      {
      $tasklistrecnum = $_REQUEST['tasklistrecnum'];
      $newtasklist->deletetasklists($tasklistrecnum);
      header("Location:tasklistsummary.php");
      }
 }

if ($pagename== 'newtask') {
//echo "I am here new1";
   $sql = "start transaction";
   $result = mysql_query($sql);
   $tasklistrecnum = $newtasklist->addtasklist();
   $sql = "commit";
   $result = mysql_query($sql);
   if(!$result) die("Commit failed for New Service Request.Please report to Sysadmin. " . mysql_error());
}
if ($pagename== 'edittasklist') {
   $tasklistrecnum = $_REQUEST['tasklistrecnum'];
   $sql = "start transaction";
   $result = mysql_query($sql);
   $tasklistrecnum = $newtasklist->updatetasklist($tasklistrecnum);
   $sql = "commit";
   $result = mysql_query($sql);
   if(!$result) die("Commit failed for Service Request update..Please report to Sysadmin. " . mysql_error());
}
  header("Location:tasklistsummary.php");

?>