<?php
//==============================================
// Author: FSI                                 =
// Date-written = Dec 28, 2017                 =
// Filename: SuppEnquiryProcess.php            =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OWT                          =
// Process of Contract Enquiry                 =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
  header ( "Location: login.php" );
}

$userid = $_SESSION['user'];
$pagename = $_SESSION['pagename'];

include('classes/suppenquiryClass.php');
$newsuppenquiry = new suppenquiry;

// echo "<pre>";
// print_r($_REQUEST); exit;

	$vendrecnum = $_REQUEST["vendrecnum"];
  $partdesc = $_REQUEST["partdesc"];
  $partnum = $_REQUEST["partnum"];
  $qty = $_REQUEST["qty"];
  $enq_date = $_REQUEST["enq_date"];
  $rtquot_date = $_REQUEST["rtquot_date"];
  $rtquot_no = $_REQUEST["rtquot_no"];
  $risk_involv = $_REQUEST["risk_involv"];
  $risk_details = $_REQUEST["risk_details"];
  $status = $_REQUEST["status"];
  $cust_id = $_REQUEST["cust_id"];
  $created_date = $_REQUEST["crdate"];
  $created_by = $_REQUEST["created_by"];
  $approval = $_REQUEST["approval"];
  $app_date = $_REQUEST["app_date"];
  $approved_by = $_REQUEST["approved_by"];
  $remarks = $_REQUEST["remarks"];

    
	$newsuppenquiry->setcompanyrecnum($vendrecnum);
 	$newsuppenquiry->setpartdesc($partdesc);
	$newsuppenquiry->setpartnum($partnum);
	$newsuppenquiry->setqty($qty);
	$newsuppenquiry->setenq_date($enq_date);
  $newsuppenquiry->setrtquot_date($rtquot_date);
  $newsuppenquiry->setrtquot_no($rtquot_no);
  $newsuppenquiry->setrisk_involv($risk_involv);
  $newsuppenquiry->setrisk_details($risk_details);
  $newsuppenquiry->setstatus($status);
  $newsuppenquiry->setremarks($remarks);
  $newsuppenquiry->setcust_id($cust_id);
  $newsuppenquiry->setcreated_date($created_date);
  $newsuppenquiry->setcreated_by($created_by);
  $newsuppenquiry->setapproval($approval);
  $newsuppenquiry->setapproved_date($app_date);
  $newsuppenquiry->setapproved_by($approved_by);

	if ($pagename == 'newsuppenquiry') 
	{
		$enquiryrecnum = $newsuppenquiry->addSuppEnquiry();
		header("Location:suppenquirySummary.php");
	}
	else if($pagename == 'editsuppenquiry')
	{	
		$recnum = $_REQUEST["recnum"];
		$newsuppenquiry->update_suppenquiry($recnum);

		header("Location:suppenquiryDetails.php?recnum=". $recnum);

	}

?>