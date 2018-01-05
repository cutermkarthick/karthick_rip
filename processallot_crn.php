<?php
//==============================================
// Author: FSI                                 =
// Date-written = Mar 20, 2007                 =
// Filename: processQualityplan.php            =
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
$userid = $_SESSION['user'];

$pagename = $_SESSION['pagename'];

include('classes/allot_crnclass.php');


// Next, create an instance of the classes required
$newcrn = new allot_crn;


/*if ($pagename == 'edit_nc4stores')
 {
    $delete = $_REQUEST['deleteflag'];
    if ($delete == 'y')
      {
       $reviewrecnum = $_REQUEST['nc4storesrecnum'];
       $newreview->deletenc4stores($reviewrecnum);
       header("Location:nc4stores_Summary.php");
      }
 }  */

// Get all fields related to invoice
if ($pagename == 'new_allotcrn') {

    $refnum = $_REQUEST["refnum"];
    $partnum = $_REQUEST["partnum"];
    $partname = $_REQUEST["partname"];
    $drg_issue = $_REQUEST["drg_issue"];

   	$newlogin = new userlogin;
				$newlogin->dbconnect();
				$sql = "start transaction";
 				$result = mysql_query($sql);

  				$newcrn->setrefnum($refnum);
		  		$newcrn->setpartnum($partnum);
			   	$newcrn->setpartname($partname);
      			$newcrn->setdrg_issue($drg_issue);

				$sql = "start transaction";
				$result = mysql_query($sql);

				$allot_crnrecnum = $newcrn->addallot_crn();
}


if ($pagename == 'edit_allotcrn')
 {
//echo "i am inside editinvoice";
    $allot_crnrecnum = $_REQUEST["allot_crnrecnum"];
    $refnum = $_REQUEST["refnum"];
    $partnum = $_REQUEST["partnum"];
    $partname = $_REQUEST["partname"];
    $drg_issue = $_REQUEST["drg_issue"];


   	$newlogin = new userlogin;
				$newlogin->dbconnect();
				$sql = "start transaction";
 				$result = mysql_query($sql);

                $newcrn->setrefnum($refnum);
		  		$newcrn->setpartnum($partnum);
			   	$newcrn->setpartname($partname);
       			$newcrn->setdrg_issue($drg_issue);

				$sql = "start transaction";
				$result = mysql_query($sql);

				$newcrn->updateallot_crn($allot_crnrecnum);
 }


header("Location:allotcrn_summary.php");

?>
