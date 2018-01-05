<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = June 20, 2004                =
// Filename: new_contact.php                   =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OMS                          =
// Allows entry of new contacts                =
//==============================================
session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );
}
$partnum = $_REQUEST['partnum'];
if ( !isset ( $partnum ) )
{
     header ( "Location: login.php" );
    
}
include('classes/partClass.php'); 
$newPart = new part; 
$result = $newPart->verifyPart($partnum);
echo $result;
return $result;

?>
