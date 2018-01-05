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
  header ("Location: login.php");
}
$cond1 = $_SESSION['cond'];
$crn = $_REQUEST['crnnum'];
$date_flag = 0;
if(isset($_REQUEST['monthyear']))
{
 //echo 'set';
 $cofc_month_year = $_REQUEST['monthyear'];
 $date_flag = 1;
}
$cond0 = "d.crn='$crn'";

$cond = $cond0 . ' and ' . $cond1;

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

 $result = $ncreport->getcofc_report4chart($cond);
 $prev_cofc='#';
 $prev_date='#';
 $lossrgain = 0;
 $lossrgain4cofc = 0;
 $lossrgain_arr = array();
 $cofc_arr = array();
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
  
  if($cofc_month_year == $month.$year)
  {
   if($prev_cofc != $myrow[0] && $prev_date != $myrow[1] && $count == 0)
   {
    $lossrgain = $help->dateDiff("-", $myrow[2], $myrow[1]);
    $lossrgain4cofc += $lossrgain;
   }
   else if($prev_cofc != $myrow[0] && $prev_date != $myrow[1] && $count > 0)
   {
    $lossrgain_arr[] = $lossrgain4cofc;
    $cofc_arr[] = $prev_cofc;
    unset($lossrgain4cofc);
    $lossrgain = $help->dateDiff("-", $myrow[2], $myrow[1]);
    $lossrgain4cofc += $lossrgain;
   }
  else if($prev_cofc != $myrow[0] && $prev_date == $myrow[1] && $count > 0)
   {
    $lossrgain_arr[] = $lossrgain4cofc;
    $cofc_arr[] = $prev_cofc;
    unset($lossrgain4cofc);
    $lossrgain = $help->dateDiff("-", $myrow[2], $myrow[1]);
    $lossrgain4cofc += $lossrgain;
  }
  else if($prev_cofc == $myrow[0] && $prev_date != $myrow[1] && $count > 0)
  {
    $lossrgain = $help->dateDiff("-", $myrow[2], $myrow[1]);
    $lossrgain4cofc += $lossrgain;
  }
  else if($prev_cofc == $myrow[0] && $prev_date == $myrow[1] && $count > 0)
  {
    $lossrgain = $help->dateDiff("-", $myrow[2], $myrow[1]);
    $lossrgain4cofc += $lossrgain;
  }
    $count++;
    $prev_cofc = $myrow[0];
    $prev_date = $myrow[1];
  }
 }

 $lossrgain_arr[] = $lossrgain4cofc;
 $cofc_arr[] = $prev_cofc;
 //print_r($lossrgain_arr);
 //print_r($cofc_arr);
$_SESSION['timediff']= $lossrgain_arr;
//////session_register('timediff');
$_SESSION['cofcs']= $cofc_arr;
//////session_register('cofcs');
include_once 'ofc-library/open_flash_chart_object.php';
open_flash_chart_object(700, 300, 'http://'. $_SERVER['SERVER_NAME'] .'/wms/cofc_chart.php?crn='.$crn.'&month='.$cofc_month_year,false);
?>
</td>
</tr>
</table>



