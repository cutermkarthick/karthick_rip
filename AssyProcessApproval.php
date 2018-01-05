<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = Dec 06,2017                  =
// Filename: AssyProcessApproval.php           =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OMS                          =
// Processes all Approvals                     =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
 	header ( "Location: login.php" );
}

$userid = $_SESSION['user'];
$usertype = $_SESSION['usertype'];

include_once('classes/AssyapprovalClass.php');
include_once('classes/loginClass.php');
$newapproval = new Assyapproval;
$newlogin = new userlogin;
$newlogin->dbconnect();

	


	$wfrecnum = $_REQUEST['wfrecnum'];
	$assyworecnum = $_REQUEST['assyworecnum'];
	$type = 'Aerowings';
	$stagenum = $_REQUEST['stagenum'];
	$logindept = $_REQUEST['logindept'];
	$milestone = $_REQUEST['milestone'];

	$sql = "start transaction";
	$result = mysql_query($sql);

	
	$qaapprove4wo = 0;
	if ( ($logindept == 'QA' || $logindept == 'Sales') && $milestone == 'FI_Completed') {
		$result = $newapproval->GetAssywo_QAApproval($assyworecnum);		
		while ($myrow = mysql_fetch_assoc($result)) {
			if ( ($myrow['qaapproved_by'] == '' || $myrow['qaapproved_by'] == 'NULL') && ($myrow['qaapproved_date'] == "NULL" || $myrow['qaapproved_date'] == "" || $myrow['qaapproved_date'] == "0000-00-00")  ){
				$qaapprove4wo = 1;
			}
		}
	}
	
	if ($qaapprove4wo == 1) {
		$response = "All Assy Wo Line Items Should get approved from QA then only you can do FI_Completed milestone \n";
	}
	else{
		$newapproval->updSignOff($assyworecnum, $wfrecnum,$stagenum);
		$sql = "commit";
		$result = mysql_query($sql);

		$response = "success";
	}


	

	// if(!$result) die("Commit failed for" . $type . " Approval..Please report to Sysadmin. " . mysql_error());


	// if ($type == 'Aerowings') {
 //   	if ($usertype == 'EMPL') {
 //    	header("Location:assywoDetails.php?worecnum=$assyworecnum");
 //   	}
	//   if ($usertype == 'CUST') {
	//     header("Location:custboard.php?typenum=$typenum&worecnum=$worecnum");
	//   }
	// }

	echo $response; exit;

?>