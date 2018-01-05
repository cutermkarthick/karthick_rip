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

include('classes/mdmclass.php');


// Next, create an instance of the classes required
$newmdm = new mdm;


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
if ($pagename == 'new_mdm') {

    $refnum = $_REQUEST["refnum"];
    $partnum = $_REQUEST["partnum"];
    $partname = $_REQUEST["partname"];
    $drg_issue = $_REQUEST["drg_issue"];
    $dim1 = $_REQUEST["dim1"];
    $dim2 = $_REQUEST["dim2"];
    $dim3 = $_REQUEST["dim3"];
    $raw_mat_type = $_REQUEST["raw_mat_type"];
    $raw_mat_spec = $_REQUEST["raw_mat_spec"];
    $maching_cycle_time = $_REQUEST["maching_cycle_time"];
    $filtering_cycle_time = $_REQUEST["filtering_cycle_time"];
    $inopectun_cycle_time = $_REQUEST["inopectun_cycle_time"];
    $part_type = $_REQUEST["part_type"];
    $customer = $_REQUEST["customer"];
    $project = $_REQUEST["project"];

   	$newlogin = new userlogin;
				$newlogin->dbconnect();
				$sql = "start transaction";
 				$result = mysql_query($sql);

  				$newmdm->setrefnum($refnum);
		  		$newmdm->setpartnum($partnum);
			   	$newmdm->setpartname($partname);
      			$newmdm->setdrg_issue($drg_issue);
		  		$newmdm->setdim1($dim1);
			   	$newmdm->setdim2($dim2);
      			$newmdm->setdim3($dim3);
		  		$newmdm->setraw_mat_type($raw_mat_type);
			   	$newmdm->setraw_mat_spec($raw_mat_spec);
      			$newmdm->setmaching_cycle_time($maching_cycle_time);
      			$newmdm->setfiltering_cycle_time($filtering_cycle_time);
		  		$newmdm->setinopectun_cycle_time($inopectun_cycle_time);
			   	$newmdm->setpart_type($part_type);
      			//$newgrn->settest_report($test_report);
      			$newmdm->setcustomer($customer);
		  		$newmdm->setproject($project);

				$sql = "start transaction";
				$result = mysql_query($sql);

				$grnrecnum = $newmdm->addmdm();
}


if ($pagename == 'edit_mdm')
 {
//echo "i am inside editinvoice";
    $mdmrecnum = $_REQUEST['mdmrecnum'];
    $refnum = $_REQUEST["refnum"];
    $partnum = $_REQUEST["partnum"];
    $partname = $_REQUEST["partname"];
    $drg_issue = $_REQUEST["drg_issue"];
    $dim1 = $_REQUEST["dim1"];
    $dim2 = $_REQUEST["dim2"];
    $dim3 = $_REQUEST["dim3"];
    $raw_mat_type = $_REQUEST["raw_mat_type"];
    $raw_mat_spec = $_REQUEST["raw_mat_spec"];
    $maching_cycle_time = $_REQUEST["maching_cycle_time"];
    $filtering_cycle_time = $_REQUEST["filtering_cycle_time"];
    $inopectun_cycle_time = $_REQUEST["inopectun_cycle_time"];
    $part_type = $_REQUEST["part_type"];
    $customer = $_REQUEST["customer"];
    $project = $_REQUEST["project"];


   	$newlogin = new userlogin;
				$newlogin->dbconnect();
				$sql = "start transaction";
 				$result = mysql_query($sql);

                $newmdm->setrefnum($refnum);
		  		$newmdm->setpartnum($partnum);
			   	$newmdm->setpartname($partname);
      			$newmdm->setdrg_issue($drg_issue);
		  		$newmdm->setdim1($dim1);
			   	$newmdm->setdim2($dim2);
      			$newmdm->setdim3($dim3);
		  		$newmdm->setraw_mat_type($raw_mat_type);
			   	$newmdm->setraw_mat_spec($raw_mat_spec);
      			$newmdm->setmaching_cycle_time($maching_cycle_time);
      			$newmdm->setfiltering_cycle_time($filtering_cycle_time);
		  		$newmdm->setinopectun_cycle_time($inopectun_cycle_time);
			   	$newmdm->setpart_type($part_type);
      			//$newgrn->settest_report($test_report);
      			$newmdm->setcustomer($customer);
		  		$newmdm->setproject($project);

				$sql = "start transaction";
				$result = mysql_query($sql);

				$newmdm->updatemdm($mdmrecnum);
 }

  if($pagename == 'new_mdm')
  {
    header("Location:mdm_summary.php");
  }
  else
  {
    header("Location:mdm_details.php?mdmrecnum=$mdmrecnum");
  }

?>
