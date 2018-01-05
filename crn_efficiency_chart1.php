<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = March 15,2005                =
// Filename: operator_efficiency.php           =
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
$_SESSION['pagename'] = 'reports';
//////session_register('pagename');
$crnnum=$_REQUEST['crnnum'];
//$wonum=$_REQUEST['wonum'];
$qtyacc=$_REQUEST['qtyacc'];
$qtyrej=$_REQUEST['qtyrej'];
$qtyret=$_REQUEST['qtyret'];
$woqty=$_REQUEST['woqty'];
$qtyrew=$_REQUEST['qty_rew'];

$cond1 =  "((to_days(wo.book_date)-to_days('1582-01-01') > 0 ||
                   wo.book_date = '0000-00-00' ||
                    wo.book_date = 'NULL' )) and
           ((to_days(wo.book_date)-to_days('2050-12-31') < 0 ||
                    wo.book_date = '0000-00-00' ||
                    wo.book_date = 'NULL'))";

//$date1 = $_REQUEST['bdate1'];
if ( isset ( $_REQUEST['bdate1'] ) || isset ( $_REQUEST['bdate2'] ) )
{
     if ( isset ( $_REQUEST['bdate1']) &&  $_REQUEST['bdate1'] != '' )
     {
          $date1 = $_REQUEST['bdate1'];
          $cond11 = "(to_days(wo.book_date) " . ">= to_days('" . $date1 . "'))";
     }
     else
     {
          $cond11 = "((to_days(wo.book_date)-to_days('1582-01-01') >= 0 || wo.book_date = 'NULL' || wo.book_date = '0000-00-00'))";
     }

     if ( isset ( $_REQUEST['bdate2'] )  &&  $_REQUEST['bdate2'] != '')
     {
          $date2 = $_REQUEST['bdate2'];
          $cond12 = "(to_days(wo.book_date) " . "<= to_days('" . $date2 . "'))";
     }
     else
     {
          $cond12 = "((to_days(wo.book_date)-to_days('2050-12-31') <= 0 || wo.book_date = 'NULL' || wo.book_date = '0000-00-00'))";
     }
     $cond1 = $cond11 . ' and ' . $cond12;

}

 
// First include the class definition
include('classes/loginClass.php');
include('classes/displayClass.php');
include('classes/operatorClass.php');
include('classes/reportClass.php');

$newlogin = new userlogin;
$newlogin->dbconnect();

$newdisplay = new display;
$newreport = new report;
?>

<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/report.js"></script>
<html>
<head>
<title>CRN Efficiency</title>
</head>

<body leftmargin="0"topmargin="0" marginwidth="0">

<table width=100% cellspacing="0" cellpadding="6" border="0">
<tr>
<td>
<table width=100% border=0 cellspacing="0" cellpadding="0">
<tr>
<!--<td colspan=2><span class="welcome"><b>Welcome <?php echo $userid?></b></td>
<td align="right">&nbsp;
	<a href="exit.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image16','','images/logout_mo.gif',1)"><img name="Image16" border="0" src="images/logout.gif"></a></td>
	</tr>
-->
</table>
<table width=100% border=0 cellpadding=0 cellspacing=0>
<tr><td></td></tr>
<tr>
<td valign="top">
</td></tr>
</table>
<table border=1 bordercolor="black" width=50% cellpadding=1 cellspacing=0>
<tr><td valign="top">
<?php
include_once 'ofc-library/open_flash_chart_object.php';
open_flash_chart_object( 300, 220, 'https://'. $_SERVER['SERVER_NAME'] .'/wms/crn_chart1.php?qtyacc='.$qtyacc.'&qtyrej='.$qtyrej.'&qtyret='.$qtyret.'&crnnum='.$crnnum.'&woqty='.$woqty.'&qtyrew='.$qtyrew,false);
//echo '<table id="myTable" width=100% border=1 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">';
?>
</td>
<td valign="top">
<table width=413px border=1 cellpadding=1 cellspacing=0>
        <tr bgcolor="#FFFFFF">
            <td width=50px bgcolor="#EEEFEE"><span class="tabletext"><b>WO#</b></td>
            <td width=75px bgcolor="#EEEFEE"><span class="tabletext"><b>Book Date</b></td>
            <td width=45px bgcolor="#EEEFEE"><span class="tabletext"><b>WO<br>Qty</b></td>
            <td width=45px bgcolor="#EEEFEE"><span class="tabletext"><b>Qty<br>Acc</b></td>
	        <td width=45px bgcolor="#EEEFEE"><span class="tabletext"><b>Qty<br>Rej</b></td>
	        <td width=45px bgcolor="#EEEFEE"><span class="tabletext"><b>Qty<br>Ret</b></td>
			<td width=45px bgcolor="#EEEFEE"><span class="tabletext"><b>Qty<br>Rew</b></td>
            <td width=45px bgcolor="#EEEFEE"><span class="tabletext"><b>Status</b></td>
        </tr>
</table>
<div style="width:431px; height:200; overflow:auto;border:" id="dataList">
<table style="table-layout: fixed" width=413px border=1 cellpadding=0 cellspacing=0>

<?php

   $result4wodetails = $newreport->getwodetails4crn_eff($crnnum,$cond1);
    while($myrow4wodetails=mysql_fetch_row($result4wodetails))
    {
        if($myrow4wodetails[6] != '' && $myrow4wodetails[6] != '0000-00-00')
               {
                 $datearr = split('-', $myrow4wodetails[6]);
                 $d=$datearr[2];
                 $m=$datearr[1];
                 $y=$datearr[0];
                 $x=mktime(0,0,0,$m,$d,$y);
                 $book_date=date("M j, Y",$x);
               }
               else
               {
                 $book_date = '';
               }
       printf('<tr bgcolor="#FFFFFF">
                          <td width=50px><span class="tabletext">%s</td>
                          <td width=75px><span class="tabletext">%s</td>
                          <td width=45px><span class="tabletext">%d</td>
                          <td width=45px><span class="tabletext">%d</td>
                          <td width=45px><span class="tabletext">%d</td>
                          <td width=45px><span class="tabletext">%d</td>
						  <td width=45px><span class="tabletext">%d</td>
                          <td width=45px><span class="tabletext">%s</td>',
                          $myrow4wodetails[0],
                          $book_date,
                          $myrow4wodetails[1],
                          $myrow4wodetails[2],
                          $myrow4wodetails[3],
                          $myrow4wodetails[4],
						  $myrow4wodetails[7],
                          $myrow4wodetails[5]);
        printf('</tr>');
                          
    }

?>
</td>
</table>
</table>






