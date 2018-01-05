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

include('classes/reportClass.php');
include('classes/helperClass.php');
$ncreport = new report;
$help = new helper;
?>
<table id="myTable" width=100%  border=1 cellpadding=3 cellspacing=1 bgcolor="#FFFFFF">
<tr>
<td>
<?php

 $result = $ncreport->getontime_report4chart($cond);
 $prev_month='#';
 $diff = 0;
 $sch_qty = 0;
 $dispatch_qty =0;
 $count = 0;
 $arr_diff = array();
 $month_arr = array();
 $infull_arr = array();

 while($myrow = mysql_fetch_row($result))
 {

   $crn = $myrow[0];
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
  $short_month=substr_replace($month_year,"",3);
  $y = $month_year;
  $length = strlen($y);
  $characters = 4;
  $start = $length - $characters;
  $year = substr($y , $start ,$characters);
  $short_month_year = $short_month.$year;
  $month_arr[] = $short_month_year;
  if($prev_month == $month_year)
  {
   //echo 'inside1';
    $diff += $help->dateDiff("-", $myrow[2], $myrow[1]);
    $sch_qty += $myrow[3];
    $dispatch_qty += $myrow[4];
   //echo 'diff='.$diff;
  }
  else if($prev_month != $month_year && $count == 0)
  {
   //echo 'inside2';
    $diff += $help->dateDiff("-", $myrow[2], $myrow[1]);
    $sch_qty += $myrow[3];
    $dispatch_qty += $myrow[4];
   //echo 'diff='.$diff;
  }
  else if($prev_month != $month_year && $count > 0)
  {
    //echo 'inside3';
    if($diff == 0)
    {
     $arr_diff[] = 100;
    }
    else
    {
     $arr_diff[]=((100+$diff)/100)*100;
    }
    $qty_eff = $sch_qty != 0?($dispatch_qty/$sch_qty)*100:0;
    $infull_arr[] = $qty_eff;
    unset($diff);
    unset($sch_qty);
    unset($dispatch_qty);
    $diff = $help->dateDiff("-", $myrow[2], $myrow[1]);
    $sch_qty = $myrow[3];
    $dispatch_qty = $myrow[4];
   //echo 'diff='.$diff;
  }
  $prev_month = $month_year;
  $count++;
 }
$qty_eff = $sch_qty != 0?($dispatch_qty/$sch_qty)*100:0;
$infull_arr[] = $qty_eff;
//print_r($infull_arr);
$arr_diff[] = ((100+$diff)/100)*100;
//print_r($arr_diff);
$months = array();
$months = array_unique($month_arr);
$_SESSION['months']= $months;
//////session_register('months');
$_SESSION['diff']= $arr_diff;
//////session_register('diff');
$_SESSION['infull'] = $infull_arr;
//////session_register('infull');
include_once 'ofc-library/open_flash_chart_object.php';
open_flash_chart_object(700, 300, 'https://'. $_SERVER['SERVER_NAME'] .'/wms/ontime_chart.php?crn='.$crn,false);
?>
</td>
</tr>
</table>



