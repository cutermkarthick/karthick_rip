<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = June 02, 2009                =
// Filename: ontime_report_chart.php           =
// Copyright of Badari Mandyam, FluentSoft     =
// Revision: v1.0 WMS                          =
// Displays Ontime Report Chart                =
//==============================================
session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
  header ( "Location: login.php" );
}
$cond = $_SESSION['cond'];

$userid = $_SESSION['user'];
$_SESSION['pagename'] = 'reports';
//////session_register('pagename');

include('classes/helperClass.php');
include('classes/reportClass.php');
$ncreport = new report;
$help = new helper;
?>
<table id="myTable" width=100%  border=1 cellpadding=3 cellspacing=1 bgcolor="#FFFFFF">
<tr>
<td>
<?php

 $result = $ncreport->getcofc_report4chart($cond);
 $prev_cofc='#';
 $prev_date='#';
 $lossrgain = 0;
 $lossrgain4cofc = 0;
 $lossrgain_arr = array();
 $cofc_arr = array();
 $infull_arr = array();
 $infull = 0;
 $count = 0;

 while($myrow = mysql_fetch_row($result))
 {
   if($myrow[1] != '' && $myrow[1] != '0000-00-00')
  {
   $datearr = split('-', $myrow[1]);
   $d=$datearr[2];
   $m=$datearr[1];
   $y=$datearr[0];
   $x=mktime(0,0,0,$m,$d,$y);
   $date1=date("M j, Y",$x);
  }
  //echo 'date='.$myrow[1];
  $mon = getdate($x);
  $month = $mon[month];
  $year = $mon[year];
  $month_year = $month.$year;

   if($prev_cofc != $myrow[0] && $prev_date != $myrow[1] && $count == 0)
   {
    $lossrgain = $help->dateDiff("-", $myrow[2], $myrow[1]);
    $lossrgain4cofc += $lossrgain;
    $infull += $myrow[4]-$myrow[3];
   }
   else if($prev_cofc != $myrow[0] && $prev_date != $myrow[1] && $count > 0)
   {
    $lossrgain_arr[] = $lossrgain4cofc;
    $cofc_arr[] = $prev_cofc;
    $infull_arr[] = $infull;
    unset($lossrgain4cofc);
    unset($infull);
    $lossrgain = $help->dateDiff("-", $myrow[2], $myrow[1]);
    $lossrgain4cofc += $lossrgain;
    $infull += $myrow[4]-$myrow[3];
   }
  else if($prev_cofc != $myrow[0] && $prev_date == $myrow[1] && $count > 0)
   {
    $lossrgain_arr[] = $lossrgain4cofc;
    $cofc_arr[] = $prev_cofc;
    $infull_arr[] = $infull;
    unset($lossrgain4cofc);
    unset($infull);
    $lossrgain = $help->dateDiff("-", $myrow[2], $myrow[1]);
    $lossrgain4cofc += $lossrgain;
    $infull += $myrow[4]-$myrow[3];
  }
  else if($prev_cofc == $myrow[0] && $prev_date != $myrow[1] && $count > 0)
  {
    $lossrgain = $help->dateDiff("-", $myrow[2], $myrow[1]);
    $lossrgain4cofc += $lossrgain;
    $infull += $myrow[4]-$myrow[3];
  }
  else if($prev_cofc == $myrow[0] && $prev_date == $myrow[1] && $count > 0)
  {
    $lossrgain = $help->dateDiff("-", $myrow[2], $myrow[1]);
    $lossrgain4cofc += $lossrgain;
    $infull += $myrow[4]-$myrow[3];
  }
    $count++;
    $prev_cofc = $myrow[0];
    $prev_date = $myrow[1];

 }

 $lossrgain_arr[] = $lossrgain4cofc;
 $cofc_arr[] = $prev_cofc;
 $infull_arr[] = $infull;
 //print_r($lossrgain_arr);
 //print_r($cofc_arr);
$_SESSION['timediff']= $lossrgain_arr;
//////session_register('timediff');
$_SESSION['cofcs']= $cofc_arr;
//////session_register('cofcs');
$_SESSION['infull'] = $infull_arr;
//////session_register('infull');
$cofcmonth='';
include_once 'ofc-library/open_flash_chart_object.php';
open_flash_chart_object(700, 300, 'https://'. $_SERVER['SERVER_NAME'] .'/wms/cofc_chart.php?crn='.$crn.'&month='.$cofcmonth,false);
?>
</td>
</tr>
</table>



