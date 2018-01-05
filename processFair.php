<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = Sep 15,2010                  =
// Filename: processFair.php                   =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OWT                          =
// Allows processing of Fairs                  =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ("Location:login.php");

}
$userid = $_SESSION['user'];
$pagename = $_SESSION['pagename'];

include('classes/fairClass.php');

$newFair = new fair;

if ($pagename == 'fairUpdate')
{

   $rec = $_REQUEST['recnum'];
   $nc = $_REQUEST['nc'];
   $status = $_REQUEST['stat'];
   $remarks = $_REQUEST['remarks'];
   
   $newFair->setnc($nc);
   $newFair->setstat($status);
   $newFair->setremarks($remarks);
   $newFair->updateFair($rec);

   
   header("Location:fair.php" );
}


