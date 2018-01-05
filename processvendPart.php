<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = May 27,2005                  =
// Filename: processvendPart.php               =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OWT                         =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}

$userid = $_SESSION['user'];
$pagename = $_SESSION['pagename'];

// Next, create an instance of the classes required
include('classes/vendPartClass.php');
$newVend = new vendPart;

// Get all fields related to Vend Part
if ($pagename == 'new_vendPart' || $pagename == 'edit_vendPart')
{
 if (isset ( $_REQUEST['partnum'] ) ){
   $partnum = $_REQUEST['partnum'];
   }else{
   $partnum = $_REQUEST['bomnum'];
   $bomrecnum = $_REQUEST['bomnum'];
   }

   $mfr_partnum = $_REQUEST['mfr_partnum'];
   $digi_partnum = $_REQUEST['digi_partnum'];
   $serial = $_REQUEST['serial'];
   $mfr = $_REQUEST['mfr'];
   $rate = $_REQUEST['rate'];
   if($rate =='')
   $rate='NULL';
   $min_qty = $_REQUEST['min_qty'];
   if($min_qty =='')
   $min_qty='NULL';
   $lead_time = $_REQUEST['lead_time'];
   if($lead_time =='')
   $lead_time='NULL';
   if ($_REQUEST['lead_unit'] == 'yes')
	$lead_units="y";
   else
	$lead_units ="n";

   $part_desc = $_REQUEST['part_desc'];
   $value = $_REQUEST['value'];
   $invent_cnt = $_REQUEST['invent_cnt'];
   if($invent_cnt =='')
   $invent_cnt='NULL';
   $vendrecnum = $_REQUEST['vendrecnum'];

   if ($_REQUEST['ptype'] == 'Yes')
	$ptype="BOM";
   else
	$ptype ="PART";
	$part_iss = $_REQUEST['part_iss'];
	$drg_no = $_REQUEST['drg_no'];
	$drg_iss = $_REQUEST['drg_iss'];
}

if ($pagename == 'new_vendPart')
{
	$newlogin = new userlogin;
	$newlogin->dbconnect();
	$newVend->setpartnum($partnum);
	$newVend->setdigikey_partnum($digi_partnum );
	$newVend->setmfr_partnum($mfr_partnum);
	$newVend->setserial($serial);
	$newVend->setmfr($mfr);
	$newVend->setrate($rate);
	$newVend->setlead_time( $lead_time);
	$newVend->setlead_unit($lead_units);
	$newVend->setvalue($value);
	$newVend->setinventory_cnt($invent_cnt);
	$newVend->setlink2vendor($vendrecnum);
	$newVend->setmin_qty($min_qty);
	$newVend->setpart_desc($part_desc);
	$newVend->setptype ($ptype);
	$newVend->setpart_iss($part_iss);
	$newVend->setdrg_no($drg_no);
	$newVend->setdrg_iss($drg_iss);
	$sql = "start transaction";
	$result = mysql_query($sql);
	$vendprecnum = $newVend->addPart();
	$flag=1;
}
if ($pagename == 'edit_vendPart')
{
	$vendprecnum =$_SESSION['partrecnum'];
	$newlogin = new userlogin;
	$newlogin->dbconnect();
	$newVend->setpartnum($partnum);
	$newVend->setdigikey_partnum($digi_partnum );
	$newVend->setmfr_partnum($mfr_partnum);
	$newVend->setserial($serial);
	$newVend->setmfr($mfr);
	$newVend->setrate($rate);
	$newVend->setlead_time( $lead_time);
	$newVend->setlead_unit($lead_units);
	$newVend->setvalue($value);
	$newVend->setinventory_cnt($invent_cnt);
	$newVend->setlink2vendor($vendrecnum);
	$newVend->setmin_qty($min_qty);
	$newVend->setpart_desc($part_desc);
	$newVend->setptype ($ptype);
	$newVend->setpart_iss($part_iss);
	$newVend->setdrg_no($drg_no);
	$newVend->setdrg_iss($drg_iss);
	//$sql = "start transaction";
	//$result = mysql_query($sql);
	$newVend->updatePart($vendprecnum);
	$flag=1;
}
if($pagename=='updateinvCount')
{
	$reftype=$_REQUEST['ref_type'];
	$refnum=$_REQUEST['ref_num'];
	$type=$_REQUEST['type'];
	$qty=$_REQUEST['qty'];
	$newVend->addinventory($reftype,$refnum,$type,$qty);
	if($type=='issues')
	$newVend->increaseInv($qty);
	else
	$newVend->decreaseinv($qty);
	header("Location:edit_vendPart.php" );
}
header("Location:vendpartDetails.php?partrecnum=$vendprecnum " );

?>
