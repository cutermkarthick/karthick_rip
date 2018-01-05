<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = Feb 23, 2010                 =
// Filename: assypoNew.php                     =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 WMS                          =
// Allows entry of Assembly Po's               =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );
}
$userid = $_SESSION['user'];

$_SESSION['pagename'] = 'assyexport';
//////session_register('pagename');

$assyworecnum = $_REQUEST['assyworecnum'];
$department=$_SESSION['department'];
// First include the class definition
//include('classes/assyWoClass.php');

include('classes/assywoClass.php');

$assywo = new assywo;

$result_assywo = $assywo->getAssyWos($assyworecnum);
$myrow = mysql_fetch_assoc($result_assywo);
$cim_refnum= $myrow["crn"];
$wonum=$myrow["assy_wonum"];
$part_num=$myrow["assypartnum"];
$mps_num=$myrow["mpsnumber"];
$mps_rev=$myrow["mps_rev"];
$cos=$myrow["cosno"];
$cvsData = $cim_refnum . "," . $wonum . "," . $part_num . "," . $mps_num . "," . $mps_rev . "," . $cos;

$data = trim($cvsData);

header("Content-type: application/txt");
header("Content-Disposition: attachment; filename=$wonum _ $cim_refnum.txt");
header("Cache-Control: cache, must-revalidate");
header("Pragma: public");
//header("Pragma: no-cache");
header("Expires: 0");
print "$data";
?>
