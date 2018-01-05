<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = April 06, 2010               =
// Filename: project_Process.php               =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
//==============================================

session_start();
header("Cache-control: private");
$userid = $_SESSION['user'];
$userrecnum = $_SESSION['userrecnum'];

$pagename= $_SESSION['pagename'];
include('classes/projectClass.php');
$submit=$_REQUEST['submit'];
//Next, create an instance of the class
$newproject = new project;

$project = $_REQUEST['project'];
$desc = $_REQUEST['desc'];
$start_date = $_REQUEST['start_date'];
$closed_date = $_REQUEST['closed_date'];
$manager = $_REQUEST['manager'];

$req = $_REQUEST['req'];
$category = $_REQUEST['category'];
$technology = $_REQUEST['technology'];
$platform = $_REQUEST['platform'];

$recnum = $_REQUEST['recnum'];
$siteid = $_REQUEST['siteid'];
$companyrecnum = $_REQUEST['companyrecnum'];


// echo "<pre>";
// print_r($_REQUEST); exit;
//$newLogin= userlogin::singleton();

$newproject->setproject($project);
$newproject->setdesc($desc);
$newproject->setstart_date($start_date);

$newproject->setclosed_date($closed_date);
$newproject->setmanager($manager);
$newproject->setreq($req);

$newproject->setcategory($category);
$newproject->settechnology($technology);
$newproject->setplatform($platform);
$newproject->setsiteid($siteid);
$newproject->setcompanyrecnum($companyrecnum);

if($submit == 'Submit')
{
$newproject->addProject();
//$result=$newproject->getlast_project();
//$myrow=mysql_fetch_row($result);
header("Location:project_Summary.php");
}
if($submit == 'Update Project')
{
$newproject->Updateproject($recnum);
header("Location:project_details.php?status=edit_project&project=$project&recnum=$recnum");
}