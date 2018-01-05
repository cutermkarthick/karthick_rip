<?php
//
//==============================================
// Author: FSI                                 =
// Date-written: June 20, 2004                 =
// Filename: exit.php                          =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OMS                          =
// Exit before logout                          =
//==============================================
session_start();
header("Cache-control: private"); 

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );
}

$userid = $_SESSION['user'];

include_once('classes/loginClass.php'); 
include_once('classes/userClass.php'); 
// Database Connect
$newlogin = new userlogin;
$newlogin->dbconnect();


// Insert into log
$newUser = new user; 
$newUser->insertLog($userid, $_SESSION['user'],'Logged Out');
$newUser->deleteactiveLog($userid);
// Disconnect
$newlogin->dbdisconnect();
// Unset all of the session variables.
$_SESSION = array();
// Finally, destroy the session.
session_destroy(); 
session_unset();
unset($_SESSION['user']);
unset($_SESSION['usertype']);
unset($_SESSION['userrole']);

require("login.php");
?>
