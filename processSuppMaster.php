<?php 

//==============================================
// Author: FSI                                 =
// Date-written = Dec 18, 2017                 =
// Filename: processSuppMaster.php             =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OWT                          =
// Process of Quality Plan                     =
//==============================================

session_start();
header("Cache-control: private");
if ( !isset ( $_SESSION['user'] ) )
{
  header ( "Location: login.php" );
}



include('classes/suppmasterClass.php');
$newsuppmaster = new suppmaster;

$pagename = $_SESSION['pagename'];
$userid = $_SESSION['userid'];

$supplier = $_REQUEST["supp_name"];
$vendrecnum = $_REQUEST["vendrecnum"];
$ctname = $_REQUEST["ctname"];
$ctemail = $_REQUEST["ctemail"];
$scope = $_REQUEST["scope"];
$methodtype = $_REQUEST["methodtype"];
$extent_control = $_REQUEST["extent_control"];
$inspyear = $_REQUEST["inspyear"];
$risk_involve = $_REQUEST["risk_involve"];

$newsuppmaster->setsupplier($supplier);
$newsuppmaster->setvendrecnum($vendrecnum);
$newsuppmaster->setctname($ctname);
$newsuppmaster->setctemail($ctemail);
$newsuppmaster->setscope($scope);
$newsuppmaster->setmethodtype($methodtype);
$newsuppmaster->setextent_control($extent_control);
$newsuppmaster->setinspyear($inspyear);
$newsuppmaster->setrisk_involve($risk_involve);


if ($pagename == "suppmasterentry") 
{
	$id = $newsuppmaster->AddSuppMaster();
	header("Location:suppmastersummary.php");
}else if($pagename == "suppmasteredit"){

	$recnum = $_REQUEST["recnum"];
	$status = $_REQUEST["status"];
	$approved = $_REQUEST["approved"];
	$approved_by = $_REQUEST["approved_by"];
	$approved_date = $_REQUEST["approved_date"];

	$newsuppmaster->setstatus($status);
	$newsuppmaster->setapproved($approved);
	$newsuppmaster->setapproved_by($approved_by);
	$newsuppmaster->setapproved_date($approved_date);

	// echo "<pre>";
	// print_r($_REQUEST); exit;

	$newsuppmaster->UpdateSuppMaster($recnum);


	header("Location:suppmastersummary.php");
}





?>