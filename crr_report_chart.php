<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = June 02, 2009                =
// Filename: crr_report_chart.php              =
// Copyright of Badari Mandyam, FluentSoft     =
// Revision: v1.0 WMS                          =
// Displays CRR Report Chart                   =
//==============================================
session_start();
header("Cache-control: private");
$cond = $_SESSION['cond'];

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );
}
$userid = $_SESSION['user'];
$_SESSION['pagename'] = 'reports';
//////session_register('pagename');

include('classes/reportClass.php');
$ncreport = new report;
?>
<table id="myTable" width=50%  border=1 cellpadding=3 cellspacing=1 bgcolor="#FFFFFF">
<tr>
<td>
<?php

 $result = $ncreport->getcrr_report4chart($cond);
 $i = 0;
 while($myrow = mysql_fetch_row($result))
 {
           $dliwonum=$myrow[4];
           $cofcnum=$myrow[1];
           $dcrn=$myrow[0];
           $result1= $ncreport->getnc4dispatch4chart($dcrn);
           $num_rows=mysql_num_rows($result1);
    if($num_rows !=0)
    {
       while($myrow1 = mysql_fetch_row($result1))
       {
          $crn[$i] = $myrow[0];
          $eff[$i] = ($myrow[3]+$myrow1[2]) != 0?(($myrow[3]/($myrow[3]+$myrow1[2]))*100):0;
          $i++;
       }
   }
   else
   {
         $crn[$i] = $myrow[0];
         $eff[$i] = 100.00;
         $i++;
   }
 }


$_SESSION['crn']=$crn;
//////session_register('crn');
$_SESSION['eff']=$eff;
//////session_register('eff');

include_once 'ofc-library/open_flash_chart_object.php';
open_flash_chart_object(450, 300, 'https://'. $_SERVER['SERVER_NAME'] .'/fluenterp/crr_chart.php',false);
?>
</td>
</tr>
</table>



