<?php
//==============================================
// Author: FSI                                 =
// Date-written = May 6, 2012                =
// Filename: bondProcess.php           =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OWT                          =
// Processing of Bond page                  =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];

$pagename = $_SESSION['pagename'];

include('classes/consumptionClass.php');

// Next, create an instance of the classes required
$newconsumption = new consumption;


 $currbenum = $_REQUEST['be_num'];
 $prevbenum = $_REQUEST['prevbenum'];
 $bedate=$_REQUEST['bedate'];
 $assessval=$_REQUEST['assessval'];
 $cifval=$_REQUEST['cifval'];
 $dutyamt=$_REQUEST['dutyamt'];
  $be_rmtype=$_REQUEST['be_rmtype'];
$newlogin = new userlogin;
$newlogin->dbconnect();
$newconsumption->setprevbenum($prevbenum);
$newconsumption->setbe_num($currbenum);
$newconsumption->setbedate($bedate);
$newconsumption->setassessval($assessval);
$newconsumption->setcifval($cifval);
$newconsumption->setdutyamt($dutyamt);
$newconsumption->setbe_rmtype($be_rmtype);
$result = mysql_query($sql);
$newconsumption->upd4be();
$result = mysql_query($sql);
header("Location:consumptionReport.php" );

