<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = June 17, 2005                =
// Filename: processMfg.php                    =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OWT                          =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];
if ( isset ( $_SESSION['mfgrecnum']) )
{

$mfgrecnum=$_SESSION['mfgrecnum'];
}
include('classes/mfgClass.php');

// Next, create an instance of the class
$newmfg = new mfg;

// Set the quote fields

// Upload the Excel file

if ($_SESSION['pagename'] == 'new_mfg') {

	$mfgid = $_REQUEST['mfg_id'];
	$desc = $_REQUEST['desc'];
	$orderdate = $_REQUEST['orderdate'];
	$max=$_REQUEST['max'];
	$companyrecnum = $_REQUEST['companyrecnum'];
	$contactrecnum = $_REQUEST['contactrecnum'];

	$newmfg->setlink2company($companyrecnum);
	$newmfg->setlink2contact($contactrecnum);
	$newmfg->setmfg_id($mfgid);
	$newmfg->setmfg_desc($desc);
	$newmfg->setorderdate($orderdate);
	$crdate = date("d-M-y");
	$mfgrecnum=$newmfg->addmfg();
	$i=1;
	while( $i <= $max)
	{
		//echo "inside while";
		$chknm="ckbo" . $i;
		//echo "$chknm<\br>";
		if (isset($_REQUEST[$chknm]))
		{
			$val="val" . $i;
	  	        $worecnum=$_REQUEST[$val];
			$newmfg->insertmfg($mfgrecnum,$worecnum);
		}
		$i++;
	}
	header ( "Location: mfg.php" );
}

if ($_SESSION['pagename'] == 'womgt4mfg') {
	//$mfgrecnum=$newmfg->addmfg();
                $modify=$_REQUEST['submit'];
                $mfgrecnum=$_REQUEST['mfgrecnum'];
	$max=$_REQUEST['max'];
	$i=1;
	while( $i <= $max)
	{
		//echo "inside while";
		$chknm="ckbo" . $i;
		//echo "$chknm<\br>";
		if (isset($_REQUEST[$chknm]))
		{
			$val="val" . $i;
	  	        $worecnum=$_REQUEST[$val];
			$newmfg->manageWo($modify,$mfgrecnum,$worecnum);
		}
		$i++;
	}
	header ( "Location: mfgDetails.php?recnum=$mfgrecnum" );

}

if ($_SESSION['pagename'] == 'edit_mfg') {
	$mfgid = $_REQUEST['mfg_id'];
	$desc = $_REQUEST['desc'];
	$orderdate = $_REQUEST['orderdate'];
	$companyrecnum = $_REQUEST['companyrecnum'];
	$contactrecnum = $_REQUEST['contactrecnum'];

	$newmfg->setlink2company($companyrecnum);
	$newmfg->setlink2contact($contactrecnum);
	$newmfg->setmfg_id($mfgid);
	$newmfg->setmfg_desc($desc);
	$newmfg->setorderdate($orderdate);
	$crdate = date("d-M-y");
	$newmfg->updatemfg($mfgrecnum);
	header ( "Location: mfgDetails.php?recnum=$mfgrecnum" );
}
if ($_SESSION['pagename']=='edit_mfg')
 {
    $delete = $_REQUEST['deleteflag'];
    if ($delete == 'y')
      {
       $mfgrecnum=$_SESSION['mfgrecnum'];
       $newmfg->deletemfg($mfgrecnum);
       header("Location:mfg.php" );
     }
 }


?>
