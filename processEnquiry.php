<?php
//==============================================
// Author: FSI                                 =
// Date-written = Mar 20, 2007                 =
// Filename: processEnquiry.php                =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OWT                          =
// Process of Contract Enquiry                 =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
  header ( "Location: ../login.php" );
}
$userid = $_SESSION['user'];
$pagename = $_SESSION['pagename'];

include('classes/enquiryClass.php');

// Next, create an instance of the classes required
$newenquiry = new enquiry;

if ($pagename == 'editenquiry')
 {
    $delete = $_REQUEST['deleteflag'];
    if ($delete == 'y')
      {
       $enquiryrecnum = $_REQUEST['enquiryrecnum'];
       $newenquiry->deleteenquiry($enquiryrecnum);
       header("Location:enquirySummary.php");
      }
 }

// Get all fields related to invoice
if ($pagename == 'newenquiry') 
{

    $companyrecnum = $_REQUEST["companyrecnum"];
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
    
	$newenquiry->setcompanyrecnum($companyrecnum);
   	$newenquiry->setpartdesc($partdesc);
	$newenquiry->setpartnum($partnum);
	$newenquiry->setqty($qty);
	$newenquiry->setenq_date($enq_date);
    $newenquiry->setrtquot_date($rtquot_date);
    $newenquiry->setrtquot_no($rtquot_no);
    $newenquiry->setrisk_involv($risk_involv);
    $newenquiry->setrisk_details($risk_details);
    $newenquiry->setstatus($status);
    $newenquiry->setremarks($remarks);
    $newenquiry->setcust_id($cust_id);
    $newenquiry->setcreated_date($created_date);
    $newenquiry->setcreated_by($created_by);
    $newenquiry->setapproval($approval);
    $newenquiry->setapproved_date($app_date);
    $newenquiry->setapproved_by($approved_by);
	$enquiryrecnum = $newenquiry->addenquiry();
}


if ($pagename == 'editenquiry')
 {


    $enquiryrecnum = $_REQUEST["enquiryrecnum"];
    $companyrecnum = $_REQUEST["companyrecnum"];
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
    

    $newenquiry->setcompanyrecnum($companyrecnum);
    $newenquiry->setpartdesc($partdesc);
    $newenquiry->setpartnum($partnum);
    $newenquiry->setqty($qty);
    $newenquiry->setenq_date($enq_date);
    $newenquiry->setrtquot_date($rtquot_date);
    $newenquiry->setrtquot_no($rtquot_no);
    $newenquiry->setrisk_involv($risk_involv);
    $newenquiry->setrisk_details($risk_details);
    $newenquiry->setstatus($status);
    $newenquiry->setremarks($remarks);
    $newenquiry->setcust_id($cust_id);
    $newenquiry->setcreated_date($created_date);
    $newenquiry->setcreated_by($created_by);
    $newenquiry->setapproval($approval);
    $newenquiry->setapproved_date($app_date);
    $newenquiry->setapproved_by($approved_by);

        $newenquiry->updateenquiry($enquiryrecnum);
}
        header("Location:enquiryDetails.php?enquiryrecnum=$enquiryrecnum" );

?>
