<?php
//==============================================
// Author: FSI                                 =
// Date-written = April 15, 2010               =
// Filename: processconnect_cimproc.php        =
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
$wonum=$_REQUEST['wonum'];
$worecnum=$_REQUEST['worecnum'];


if ( !isset ( $_REQUEST['worecnum'] ) )
{
     header ( "Location: login.php" );
}
$header='';
$data='';

// First include the class definition
include_once('classes/loginClass.php');
include('classes/workorderClass.php');
include('classes/masterdataClass.php');

$newlogin = new userlogin;
$newwo = new workOrder;
$newMD = new masterdata;
$result4GenInfo = $newwo->getGenInfo($worecnum);
$myrow = mysql_fetch_row($result4GenInfo);

$result = $newwo->getlink2masterdata($worecnum);
 $myrec =  mysql_fetch_row($result);
 $link2masterdata = $myrec[0];

if($link2masterdata != '')
{
$resultmd = $newMD->getmasterdata4wo($link2masterdata);
$mymd = mysql_fetch_row($resultmd);
if($myrow[34] == 0)
{
    $mps_rev = $mymd[16];
}
else
{
    $mps_rev = $myrow[35];
}
}
$cim_refnum=$mymd[9];
$part_num=$mymd[4];
$mps_num=$mymd[17];
$cos=$mymd[19];
$cos1=str_replace(',',';',$cos);


$cvsData = $cim_refnum . "," . $wonum . "," . $part_num . "," . $mps_num . "," . $mps_rev . "," . $cos1;

$data = trim($cvsData);

header("Content-type: application/txt");
header("Content-Disposition: attachment; filename=$wonum _ $cim_refnum.txt"); 
header("Cache-Control: cache, must-revalidate");
header("Pragma: public");
//header("Pragma: no-cache");
header("Expires: 0");
print "$data";
?>
