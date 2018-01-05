<?php
//==============================================
// Author: FSI                                 =
// Date-written = July 18, 2013                =
// Filename: processmc_capacity.php            =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OMS                          =
// Processes Contacts                          =
//==============================================
session_start();
header("Cache-control: private");
$userid = $_SESSION['user'];
$dept = $_SESSION['department'];

$userrecnum = $_SESSION['userrecnum'];

$pagename= $_REQUEST['pagename'];


// echo $pagename;exit;

$_SESSION['pagename'] = 'delivery_sch';
include('classes/mc_capacityClass.php');
$submit=$_REQUEST['submit'];
//Next, create an instance of the class
$newmc_capacity = new mc_capacity;

$recnum = $_REQUEST['recnum'];
$mc_id = $_REQUEST['mc_id'];
$mc_name = $_REQUEST['mc_name'];
$avail_capacity = $_REQUEST['avail_capacity'];
$mc_series = $_REQUEST['mc_series'];
$pagename = $_REQUEST['pagename'];

$crnnum=$_REQUEST['crnnum'];
$runtime=$_REQUEST['runtime'];
$operation=$_REQUEST['operation'];

$month=$_REQUEST['month'];
$year=$_REQUEST['year'];
$blank=$_REQUEST['blank'];
$shift=$_REQUEST['shift'];
$units=$_REQUEST['units'];



// echo "<pre>";
// print_r($_REQUEST);exit;

$newmc_capacity->setmc_id($mc_id);
$newmc_capacity->setmc_name($mc_name);
$newmc_capacity->setavail_capacity($avail_capacity);
$newmc_capacity->setmc_series($mc_series);
$newmc_capacity->setdept($dept);

$newmc_capacity->setcrnnum($crnnum);
$newmc_capacity->setruntime($runtime);
$newmc_capacity->setoperation($operation);

$newmc_capacity->setplan_month($month);
$newmc_capacity->setplan_year($year);
$newmc_capacity->setpartsperblank($blank);
$newmc_capacity->setshift($shift);
$newmc_capacity->setunits($units);


$newlogin = new userlogin;
$newlogin->dbconnect();

if($pagename == 'new_mc_capacity')
{
//$res=$newmc_capacity->getallmc_series($mc_name);
//$myrow=mysql_fetch_row($res);
//if($myrow[0]==$mc_series || mysql_num_rows($res)=='0')
//{
   $newmc_capacity->addmc_capacity();
//}
header("Location:mc_capacitySummary.php?status=new&mc_name1=$mc_name");
}

if($pagename == 'edit_mc_capacity')
{
$newmc_capacity->Updatemc_capacity($recnum);
header("Location:mc_capacityDetails.php?status=edit&recnum=$recnum");
}

if($pagename == 'new_crn_mc')
{
$newmc_capacity->addcrn_mc();
header("Location:production_sch.php?status=new&mc_name1=$mc_name");
}
if($pagename == 'edit_crn_mc')
{
$newmc_capacity->Updatecrn_mc($recnum);
header("Location:production_schDetails.php?status=edit&recnum=$recnum");
}