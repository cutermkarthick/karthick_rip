<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = October 18, 2006             =
// Filename: processol.php                     =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OWT                          =
// For processing data from opportunity.php    =
// Modifications History                       =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];
$cond = "c.name like '%'";
$worec='';
if ( isset ( $_REQUEST['scomp'] ) )
{
     $company_match = $_REQUEST['scomp'];
     if ( isset ( $_REQUEST['company_oper'] ) ) {
          $oper = $_REQUEST['company_oper'];
     }
     else {         $oper = 'like';

     }
     if ($oper == 'like') {
         $scomp = "'" . $_REQUEST['scomp'] . "%" . "'";
     }
     else {
         $scomp = "'" . $_REQUEST['scomp'] . "'";
     }

     $cond = "c.name " . $oper . " " . $scomp;

}
else {
     $company_match = '';
}
$sort1='';
$sort2='';
if ( isset ( $_REQUEST['sortfld1'] ) ) {
    $sort1 = $_REQUEST['sortfld1'];
}
if ( isset ( $_REQUEST['sortfld2'] ) ) {
    $sort2 = $_REQUEST['sortfld2'];
}
$leadsrecnum=$_REQUEST['leadsrecnum'];
$posubmit=$_REQUEST['posubmit'];
$submit=$_REQUEST['submit'];
//echo "$submit";
if($posubmit=="Get")
{
//	echo " i am inside get";
	     header ( "Location: leads_link_unlink.php?leadsrecnum=$leadsrecnum&submit=$submit");
    //  header ( "Location: login.php" );

}
else
{
      $modify=$_REQUEST['submit'];
     $leadsrecnum=$_REQUEST['leadsrecnum'];
     $max=$_REQUEST['max'];
//echo "$max";
    //$max1=3;


// First include the class definition

include_once('classes/userClass.php');
include_once('classes/loginClass.php');
include('classes/workorderClass.php');
include('classes/poClass.php');
include('classes/leadsClass.php');
include('classes/opportunityClass.php');
$newLead = new leads;
$newlogin = new userlogin;
$newlogin->dbconnect();
$username = $_SESSION['user'];
$newworkOrder = new workOrder;
$newPO = new po;
	$i=1;
	while( $i <= $max)
	{
		//echo "inside while";
		$chknm="ckbo" . $i;
		//echo "$chknm<\br>";
		if (isset($_REQUEST[$chknm]))
		{
			$val="val" . $i;
	  	        $opportunityrecnum=$_REQUEST[$val];
			    $newLead->modifyMtm($modify,$leadsrecnum,$opportunityrecnum);
		}
		$i++;
	}

	header ( "Location: leads2opportunity.php?leadsrecnum=$leadsrecnum" );
}
?>