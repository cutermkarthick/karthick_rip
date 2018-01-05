<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = Jan 04, 2010                 =
// Filename: tools_xsactionProcess.php         =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OMS                          =
// Processes Contacts                          =
//==============================================

session_start();
header("Cache-control: private");
$userid = $_SESSION['user'];
$userrecnum = $_SESSION['userrecnum'];

$pagename= $_SESSION['pagename'];
$_SESSION['pagename'] = 'delivery_sch';
include('classes/delivery_schClass.php');
$submit=$_REQUEST['submit'];
//Next, create an instance of the class
$newdelivery_sh = new deliverye_sch;

$recnum = $_REQUEST['recnum'];

$crnnum = $_REQUEST['crnnum'];
$schedule_date = $_REQUEST['schedule_date'];
$schedule_qty = $_REQUEST['schedule_qty'];
$time_required = $_REQUEST['time_required'];
$status = $_REQUEST['status'];
$partnum = $_REQUEST['partnum'];
$disputd = $_REQUEST['disp_qty'];
$remarks = $_REQUEST['remarks'];
$custcode = $_REQUEST['custcode'];

$newlogin = new userlogin;
$newlogin->dbconnect();

$newdelivery_sh->setcrnnum($crnnum);
$newdelivery_sh->setschedule_date($schedule_date);
$newdelivery_sh->setschedule_qty($schedule_qty);
$newdelivery_sh->settime_required($time_required);
$newdelivery_sh->setstatus($status);
$newdelivery_sh->setpartnum($partnum);
$newdelivery_sh->setdisputd($disputd);
$newdelivery_sh->setremarks($remarks);
$newdelivery_sh->setcustcode($custcode);

if($submit == 'Submit')
{
$newdelivery_sh->adddelivery_sch();
header("Location:delivery_schSummary.php?status=new&crn=$crnnum&sch_date=$schedule_date");
}

if($submit == 'Update')
{
$newdelivery_sh->Updatedelivery_sch($recnum);
header("Location:delivery_schDetails.php?status=edit&recnum=$recnum");
}

