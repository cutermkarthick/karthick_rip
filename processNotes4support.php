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
$notes = $_REQUEST['spec_instrns'];
$supp2type =$_REQUEST['supp2type'];
$type =$_REQUEST['type'];
if ( !isset ( $_REQUEST['supp2type'] ) )
{
     header ( "Location: login.php" );
    
}
// First include the class definition 
include_once('classes/loginClass.php');
include('classes/srClass.php');
include('classes/supportClass.php');

$newlogin = new userlogin;
$newlogin->dbconnect();
$newsupp=new support;
$newsupp->addNotes($supp2type,$notes,$type);
if($type=='sr')
header("Location:sr.php?recnum=$supp2type");
if($type=='rma')
header("Location:rma.php?recnum=$supp2type");
if($type=='eco')
header("Location:eco.php?recnum=$supp2type");
?>
