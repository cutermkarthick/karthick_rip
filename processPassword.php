<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = June 20, 2004                =
// Filename: processPassword.php               =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OMS                          =
// Processes password changes                  =
//==============================================

session_start();
header("Cache-control: private"); 

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );
    
}
$userid = $_SESSION['user'];

// First include the class definition 
include('classes/userClass.php'); 
 
$userName = $_POST['userName'];
$userPassword = $_POST['userPassword'];
$newpassword = $_POST['newpassword'];

// Next, create an instance of the class 
$newUser = new user; 

// Call the password update function 
$newUser->updatePassword($userName, $userPassword, $newpassword); 

header("Location:login.php");
?>





