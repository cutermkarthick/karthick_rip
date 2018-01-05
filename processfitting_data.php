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

include('classes/fittingClass.php');

// Next, create an instance of the classes required
$newfitting = new fitting;

if($pagename == 'editreview')
 {
    $delete = $_REQUEST['deleteflag'];
    if ($delete == 'y')
      {
       $reviewrecnum = $_REQUEST['reviewrecnum'];
       $newreview->deletereview($reviewrecnum);
       header("Location:reviewSummary.php");
      }
 }

// Get all fields related to invoice
if ($pagename == 'fitting_summary') {

    $operator = $_REQUEST["operator"];
    $date = $_REQUEST["date"];
    $shift = $_REQUEST["shift"];
    $time_per_piece = $_REQUEST["time_per_piece"];
    $qty_assigned = $_REQUEST["qty_assigned"];
    //$end_date = $_REQUEST["end_date"];
    $qty_produced = $_REQUEST["qty_produced"];
    $rejection = $_REQUEST["rejection"];

   	$newlogin = new userlogin;
				$newlogin->dbconnect();
				$sql = "start transaction";
 				$result = mysql_query($sql);

  				$newfitting->setoperator($operator);
		  		$newfitting->setdate($date);
			   	$newfitting->setshift($shift);
   				$newfitting->settime_per_piece($time_per_piece);
	  			$newfitting->setqty_assigned($qty_assigned);
		   		$newfitting->setqty_produced($qty_produced);
		   		$newfitting->setrejection($rejection);


			//	$sql = "start transaction";
			//	$result = mysql_query($sql);

				$newfitting->addfitting();

}


if ($pagename == 'edit_fitting')
 {
//echo "i am inside editinvoice";
    $fittingrecnum = $_REQUEST["fittingrecnum"];
    $operator = $_REQUEST["operator"];
    $date = $_REQUEST["date"];
    $shift = $_REQUEST["shift"];
    $time_per_piece = $_REQUEST["time_per_piece"];
    $qty_assigned = $_REQUEST["qty_assigned"];
    //$end_date = $_REQUEST["end_date"];
    $qty_produced = $_REQUEST["qty_produced"];
    $rejection = $_REQUEST["rejection"];
   //$time_wasted = $_REQUEST["time_wasted"];



   	$newlogin = new userlogin;
				$newlogin->dbconnect();
				$sql = "start transaction";
 				$result = mysql_query($sql);

      $newfitting->setoperator($operator);
		  		$newfitting->setdate($date);
			   	$newfitting->setshift($shift);
   				$newfitting->settime_per_piece($time_per_piece);
	  			$newfitting->setqty_assigned($qty_assigned);
		   		$newfitting->setqty_produced($qty_produced);
		   		$newfitting->setrejection($rejection);
      //          $newfitting->settime_wasted($time_wasted);

			/*	$sql = "start transaction";
				$result = mysql_query($sql); */

				$newfitting->updatefitting($fittingrecnum);
 }


header("Location:fitting_summary.php");

?>
