<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = June 20, 2004                =
// Filename: processUser.php                   =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OMS                          =
// Process page for users                      =
//==============================================

session_start();
header("Cache-control: private"); 

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );
    
}
$userid = $_SESSION['user'];

$userrecnum = $_SESSION['userrecnum'];

$pagename= $_SESSION['pagename'];

// First include the class definition 
include('classes/userClass.php'); 

// Next, create an instance of the class 
$newUser = new user; 
$loginid = $_REQUEST['loginid'];
if ($pagename == 'edituser') {
    $delete = $_REQUEST['deleteflag'];
}
if ($pagename == 'newuser') {
    $password = $_REQUEST['password'];
    $newUser->setpassword($password);
}
if ($pagename == 'newuser' || $pagename == 'edituser') {

    $status = $_REQUEST['activeval'];
    $typeval = $_REQUEST['typeval']; 
    $statusval = $_REQUEST['activeval'];      
    $initials = $_REQUEST['initials']; 
    $emprecnum = $_REQUEST['emprecnum'];
    $companyrecnum = $_REQUEST['companyrecnum'];
    $contactrecnum = $_REQUEST['contactrecnum'];
    $newUser->setloginid($loginid);
    $newUser->setinitials($initials);
    $newUser->setstatus($statusval);
    $newUser->settype($typeval);
    $newUser->setuser2employee($emprecnum);
    $newUser->setuser2contact($contactrecnum);
}

// Database Connect
$newlogin = new userlogin;
$newlogin->dbconnect();

if ($pagename == 'newuser') {
   $sql = "start transaction";
   $result = mysql_query($sql);
   $newUser->addUser();
   $sql = "commit";
   $result = mysql_query($sql);
   if(!$result) die("Commit failed for New User..Please report to Sysadmin. " . mysql_error()); 
}
if ($pagename == 'edituser' && $delete != 'y') {
   $sql = "start transaction";
   $result = mysql_query($sql);
   $newUser->updateUser($loginid);
   $sql = "commit";
   $result = mysql_query($sql);
   if(!$result) die("Commit failed for User update..Please report to Sysadmin. " . mysql_error()); 
}
if ($pagename == 'edituser'&& $delete == 'y') {
   $sql = "start transaction";
   $result = mysql_query($sql);
   $newUser->deleteUser($loginid);
   $sql = "commit";
   $result = mysql_query($sql);
   if(!$result) die("Commit failed for User update..Please report to Sysadmin. " . mysql_error()); 
}
header("Location:users.php");
?>
