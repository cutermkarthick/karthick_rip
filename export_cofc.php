<?php
//==============================================
// Author: FSI                                                                      =
// Date-written = June 12, 2013                                           =
// Copyright (C) FluentSoft Inc.                                          =
// Contact bmandyam@fluentsoft.com                               =
// Revision: v1.0 OWT                                                          =
//==============================================
session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );
}

$fdate=$_REQUEST['from_date'];
$tdate=$_REQUEST['to_date'];
$crn_num=$_REQUEST['crnnum'];

$cond0 = "d.crn like '".$crn_num."%'";

if ( $fdate!=''  || $tdate!='' )
{

     if ( $fdate!='' )
     {
          $date1 = $fdate;
          $cond01 = "to_days(d.disp_date) " . ">= to_days('" . $date1 . "')";
     }
     else
     {
          $cond01 = "(to_days(d.disp_date)-to_days('1582-01-01') > 0 || d.disp_date is NULL || d.disp_date = '0000-00-00')";
     }

     if ( $tdate!='')
     {
          $date2 = $tdate;
          $cond02 = "to_days(d.disp_date) " . "<= to_days('" . $date2 . "')";
     }
     else
     {
          $cond02 = "(to_days(d.disp_date)-to_days('2050-12-31') < 0 || d.disp_date is NULL || d.disp_date = '0000-00-00')";
     }
     $cond1 = $cond01 . '  and  ' . $cond02;

}
else
{
    $cond1 = "(to_days(d.disp_date)-to_days('1582-01-01') > 0 ||
                    d.disp_date= '0000-00-00' ) and
          (to_days(d.disp_date)-to_days('2050-12-31') < 0 ||
                   d.disp_date = '0000-00-00' )";

}

$cond=$cond0 . ' and ' .$cond1;

//echo $cond."---<br>";
/*if ( !isset ( $_REQUEST['disprecnum'] ) )
{
     header ( "Location: login.php" );
}*/
$header='';
$data='';
$cofcData="";
// First include the class definition
include_once('classes/loginClass.php');
include('classes/dispatchClass.php');
include('classes/dispatchliClass.php');

$newlogin = new userlogin;
$newDispatch = new dispatch;
$newLI = new dispatch_line_items;
$result = $newDispatch->getdispatch4export($cond);
//$myrow = mysql_fetch_row($result);
/*$cofcnum=$myrow[1];
$cim_refnum=$myrow[10];
$cofcdate=$myrow[2];
$companyname=$myrow[4];
$type=$myrow[36];
$liresult = $newLI->getLI($disprecnum,$myrow[36]);*/
  while ($myrow = mysql_fetch_row($result))
    {
       $cofcData = $myrow[0] . "," . $myrow[1] . "," .$myrow[2] . "," .  $myrow[3] . "," . $myrow[4] . "," . $myrow[5] . "," . $myrow[6] . "," . $myrow[7]  . "," .$myrow[8]. "#". $cofcData;
	}

if($crn_num != ''  &&  $fdate != '')
    $cofc_txt="cofc_export_".$crn_num.'('.$fdate.' - '.$tdate.')';
 elseif($crn_num == ''  &&  $fdate != '')
    $cofc_txt="cofc_export(".$fdate.' - '.$tdate.')';
$data = trim($cofcData);

header("Content-type: application/txt");
header("Content-Disposition: attachment; filename=$cofc_txt.txt"); 
header("Cache-Control: cache, must-revalidate");
header("Pragma: public");
header("Pragma: no-cache");
header("Expires: 0");

print "$data";
?>
