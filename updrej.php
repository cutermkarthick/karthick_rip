<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = August 12, 2009              =
// Filename: updrej.php                     =
// Copyright of Badari Mandyam, FluentSoft     =
// Revision: v1.0 WMS                          =
// Displays CRN Stock Summary list.            =
//==============================================

session_start();
header("Cache-control: private");
if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );
}
$userid = $_SESSION['user'];
$_SESSION['pagename'] = 'reports';
//////session_register('pagename');

// First include the class definition
include_once('classes/reportClass.php');

$newreport = new report;
$result = $newreport->getwos4qtyupd();
echo "<br>start of update";
while($mywos=mysql_fetch_row($result))
{
       $wonum = $mywos[0];
	   $rejqty = $mywos[1];
	   echo "<br>Updating work order $wonum for rej qty of $rejqty";
	   $newreport->updwos4qty($wonum,$rejqty);
}
echo "<br>WO rej qty updated";
?>
