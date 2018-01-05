<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = June 20, 2004                =
// Filename: processCustEmail.php              =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OMS                          =
// Processes Customer Email                    =
//==============================================

session_start();
header("Cache-control: private"); 

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );
    
}
$userid = $_SESSION['user'];
$wonum = $_REQUEST['wonum'];
$email = $_REQUEST['email'];

if ( !isset ( $_REQUEST['wonum'] ) )
{
     header ( "Location: login.php" );
    
}
$userrole = $_SESSION['userrole'];
$userid = $_SESSION['user'];
$usertype = $_SESSION['usertype'];

// First include the class definition 
include_once('classes/loginClass.php');
include('classes/emailClass.php');

// Database Connect
$newlogin = new userlogin;
$newlogin->dbconnect();
$newemail = new email;

$sql = "start transaction";
$result = mysql_query($sql);
$newemail->custEmail($wonum,$email);
$sql = "commit";
$result = mysql_query($sql);
if(!$result) die("Email failed.  Please report to Sysadmin. " . mysql_error()); 

header("Location: wosum.php" );

?>





