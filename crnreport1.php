<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = August 12, 2009              =
// Filename: crnreport.php                     =
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
include_once('classes/displayClass.php');

$newdisplay = new display;
$newreport = new report;
$rowsPerPage = 2000;
$crn=$_REQUEST['crn'];
// by default we show first page
$pageNum = 1;

// if $_GET['page'] defined, use it as page number
if (isset($_REQUEST['page']))
{
    $pageNum = $_REQUEST['page'];
}
if (isset($_REQUEST['totpages']))
{
    $totpages = $_REQUEST['totpages'];
}

// counting the offset
$offset = ($pageNum - 1) * $rowsPerPage;

$userrole = $_SESSION['userrole'];
?>
<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/report.js"></script>
<html>
<head>
<title>CRN Stock Report</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">

<form action='crnreport1.php' method='post' enctype='multipart/form-data'>
<?php

include('header.html');
?>
<table width=100% cellspacing="0" cellpadding="6" border="0">
	<tr>
		<td>
			<table width=100% border=0 cellspacing="0" cellpadding="0">
   				<tr>
        		<td colspan=2><span class="welcome"><b>Welcome <?php echo $userid?></b></td>
        		<td align="right">&nbsp;
       			<a href="exit.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image16','','images/logout_mo.gif',1)"><img name="Image16" border="0" src="images/logout.gif"></a></td>
        		</tr>
			</table>
			<table width=100% border=0 cellpadding=0 cellspacing=0  >
				<tr><td></td></tr>
				<tr>
					<td>
<?php $newdisplay->dispLinks(''); ?>
</td></tr>
</table>
<table width=100% border=0 cellpadding=0 cellspacing=0>
  <tr bgcolor="DEDFDE"><td width="6"><img src="images/spacer.gif " width="6"></td>
	    <td bgcolor="#FFFFFF">
 <table width=100% border=0 cellpadding=6 cellspacing=0>
     <tr><td>
		</tr>
  <tr>
<td>
</td></tr>
<tr><td valign="top">

<table valign="top" width="100%" border=0>
<tr>
<td valign='top'><span class="pageheading"><b>PRN Report</b></td>
<td colspan=160>&nbsp;</td>
</tr>
</table>

<table valign="top" width="100%" align="center" border=0 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF">
<tr bgcolor="#F5F6F5">
<td align="center" colspan=7><span class="heading"><b>Search Criteria</b></td></tr>
<tr>
<td valign='top' bgcolor="#FFFFFF"><span class="tabletext"><b>PRN:</b>&nbsp;
<input type="text" size=15% name="crn" value="<?echo $_REQUEST['crn'] ?>">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="button"><b><input type="submit" name="submit" value="Get"></b></td>
</tr>
</table>

<table valign="top" width="100%" border=0 cellpadding=3 cellspacing=1 bgcolor="#FFFFFF">
<tr bgcolor="#FFFFFF">
<td valign='top'>
<?php
if($crn!='')
{
?>
<table align="top" style="table-layout: fixed" width="400px" border=0 cellpadding=3 cellspacing=1 bgcolor="#FFFFFF">
<tr bgcolor="#FFFFFF">
    <td><span class="tabletext">
                          <a href="crnstock_xls.php?crn=<?php echo $crn ?>">Export To Excel</td>
</tr>
</table>
<table align="top" style="table-layout: fixed" width="400px" style="border:1px solid #000000;" border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
<tr bgcolor="#FFCC00">
<td width="100px" bgcolor="#EEEFEE"><span class="tabletext" align='center'><b>PRN</b></td>
<td width="200px" bgcolor="#EEEFEE"><span class="tabletext" align='center'><b>Part Number</b></td>
<td width="100px" bgcolor="#EEEFEE"><span class="tabletext" align='center'><b>Total Stock</b></td>

</tr>
<?php
$cond='';
if($crn!='')
{
$cond='and w.crn_num like '."'".$crn."%'";
$cond1='where w.crn_num like '."'".$crn."%'".$cond;
}
else
{
$cond='';
$cond1=''.$cond;
}
$result = $newreport->getallCRN4all($cond1,$crn);
$total=0;
$total4dis=0;
$total4grn=0;
$totalgrn_quar=0;
$totalbalance=0;
$totalbalance_quar=0;
$totaldn_qty=0;
$totalrecd_qty=0;
$totalrmpoqty=0;
$woprocarr = array("Assembly","Manufacture Only","With Treatment");
while($myrow4crn=mysql_fetch_row($result))
{
 $dnSent_qty=0;
 $dnRecd_qty=0; 
$part_num=$myrow4crn[3];
$crn4total=$myrow4crn[1];
foreach ($woprocarr as $proc)
{

$openflag=0;
$results = $newreport->getallCRN4open($myrow4crn[1],$proc);
if(mysql_num_rows($results) == '0')
{

 //printf('<td width="50px" align="center" bgcolor="#FFFFFF"><span class="tabletext">%s</td>','&nbsp');
}
while($myrow4=mysql_fetch_row($results))
{

 if($proc == "With Treatment")
 {
  $dn = $newreport->getdn_qty($myrow4crn[1],$proc);
  $dn_sent = split("\|",$dn);
  $dnSent_qty = $dn_sent[0];
  $dnRecd_qty = $dn_sent[1];
  //printf('<td width="50px" align="center" bgcolor="#FFFFFF"><span class="tabletext">%d</td>',($myrow4[2]-$dn_sent[0]));
  $total = $total + ($myrow4[2]-$dn_sent[0]);
 // $totaldn_qty += $dn_sent[0];
  $totalrecd_qty += $dn_sent[0];
 }
 else
 {
  //printf('<td width="50px" align="center" bgcolor="#FFFFFF"><span class="tabletext">%d</td>',$myrow4[2]);
  $total = $total + $myrow4[2];
 }
}
//printf('</td></tr>');
//$result4closed = $newreport->getallCRN4closed($myrow4crn[1],$proc);
if($proc == 'Manufacture Only')
{
// printf('<td align="center" width="40px" bgcolor="#FFFFFF"><span class="tabletext">%s</td></tr>','&nbsp;');
}
if($proc == 'With Treatment')
{
//printf('<tr>');
//$result1 = $newreport->getallCRNDetails($myrow4closed[0],$myrow4closed[2],$proc);
//$num_rows = mysql_num_rows($result1);
//printf('<td align="center" width="40px" bgcolor="#FFFFFF"><span class="tabletext">%d</td>',($dnSent_qty-$dnRecd_qty));
//$total4dis = $total4dis + $myrow4closed[2];
//echo($dnRecd_qty."**********".$dnSent_qty)."IN DN+++";
$totaldn_qty += ($dnSent_qty-$dnRecd_qty);
//printf('</td></tr>');
}
//}
//}
$result4closed = $newreport->getallCRN4closed($myrow4crn[1],$proc);
if(mysql_num_rows($result4closed) == '0')
{
 //printf('<td align="center" width="40px" bgcolor="#FFFFFF"><span class="tabletext">%s</td></tr>','&nbsp;');
}
while($myrow4closed=mysql_fetch_row($result4closed))
{
//printf('<tr>');
$result1 = $newreport->getallCRNDetails($myrow4closed[0],$myrow4closed[2],$proc);
$num_rows = mysql_num_rows($result1);
if($num_rows=='0')
{
//printf('<td align="center" width="40px" bgcolor="#FFFFFF"><span class="tabletext">%d</td>',$myrow4closed[2]);
$total4dis = $total4dis + $myrow4closed[2];
}
while($myrow4dispatch=mysql_fetch_row($result1))
{
//printf('<td align="center" width="40px" bgcolor="#FFFFFF"><span class="tabletext">%d</td>',$myrow4dispatch[0]);
$total4dis = $total4dis + $myrow4dispatch[0];
}
//printf('</td></tr>');
}
//}
//}
//printf('<tr>');
$resultall = $newreport->getCRN($myrow4crn[1],'Regular');
while($myrow4all=mysql_fetch_row($resultall))
{
$result2 = $newreport->getallGRN4Details($myrow4all[2],$myrow4all[0],$myrow4all[1],'Regular');
$num_rows = mysql_num_rows($result2);
if($num_rows=='0')
{
//printf('<td align="center" width="40px" bgcolor="#FFFFFF"><span class="tabletext">%s</td>','&nbsp;');
//printf('</td></tr>');
}
while($myrow4grn=mysql_fetch_row($result2))
{
 $result4 = $newreport->get_woretqty($myrow4grn[0]);
 $myrow= mysql_fetch_row($result4);
 $balance=$myrow[1]+$myrow4grn[2];
 if ($proc == 'Manufacture Only')
 {
 $total4grn = $total4grn + $balance;
 $totalbalance =$totalbalance+$balance;
 }
}
}
 if ($proc == 'Manufacture Only')
 {
  //  printf('<td align="center" width="40px" bgcolor="#FFFFFF"><span class="tabletext">%d</td>',$totalbalance);
   // printf('</td></tr>');
 }
 else
 {
   // printf('<td align="center" width="40px" bgcolor="#FFFFFF"><span class="tabletext">%s</td></tr>','&nbsp');
 }
$totalbalance='&nbsp';
//printf('<tr>');
$result_crn_quar = $newreport->getCRN($myrow4crn[1],'Quarantined');
while($myrow4crn_quar=mysql_fetch_row($result_crn_quar))
{
 $result_grnDet_quar = $newreport->getallGRN4Details($myrow4crn_quar[2],$myrow4crn_quar[0],$myrow4crn_quar[1],'Quarantined');
 $num_rows = mysql_num_rows($result_grnDet_quar);
if($num_rows=='0')
{
// printf('<td align="center" width="40px" bgcolor="#FFFFFF"><span class="tabletext">%s</td>','&nbsp;');
 //printf('</td></tr>');
}
while($myrow4grn_quar=mysql_fetch_row($result_grnDet_quar))
{
  $result_ret_quar = $newreport->get_woretqty($myrow4grn_quar[0]);
  $myrow_ret= mysql_fetch_row($result_ret_quar);
  $balance_quar=$myrow_ret[1]+$myrow4grn_quar[2];
  if ($proc == 'Manufacture Only')
  {
   $totalgrn_quar = $totalgrn_quar+$balance_quar;
   $totalbalance_quar = $totalbalance_quar+$balance_quar;
  }
 }
}
 if ($proc == 'Manufacture Only')
 {
 //   printf('<td align="center" width="40px" bgcolor="#FFFFFF"><span class="tabletext">%d</td>',$totalbalance_quar);
    //printf('</td></tr>');
 }
 else
 {
   // printf('<td align="center" width="40px" bgcolor="#FFFFFF"><span class="tabletext">%s</td>','&nbsp;');
 }

$totalbalance='&nbsp';
$totalbalance_quar='&nbsp';

$result4rmpo=$newreport->get_rmpotqty($myrow4crn[1]);
$myrmpo=mysql_fetch_row($result4rmpo);
if($proc == 'With Treatment')
{
//printf('<td align="center" width="85px" bgcolor="#FFFFFF"><span class="tabletext">%s</td></tr>','&nbsp;');
}
if($proc == 'Manufacture Only')
{
//printf('<tr>');
//echo $myrmpo[0]."date<br>";

$end_date='';
//echo "<br>".$myrmpo[3]."in rep<br>".$myrmpo[2];
if($myrow[2] != '0.00' && $myrow[2] != '0' && $myrow[2] != '' && $myrow[2] != '-'){

if($myrmpo[0] != '0000-00-00' && $myrmpo[0] != '' && $myrmpo[0] != 'NULL')
{
	
  $date_arr=split('-',$myrmpo[0]) ;
  $year=$date_arr[0];
  $month=$date_arr[1];
  $day=$date_arr[2];
  $d = mktime(0,0,0,$month,$day,$year);
  if($myrmpo[4]=='SEA'){
   $end_date = date('M j, Y',strtotime('+60 days',$d));
  }
  if($myrmpo[4]=='AIR'){
    $end_date = date('M j, Y',strtotime('+20 days',$d));
  }

   //echo $end_date.'    date---<br>'.$myrmpo[4].'<br>';
}
$rmpoqty=$myrmpo[2];
}
else
{
 //echo "<br>abcd===".$myrmpo[3] ;
if($myrmpo[0] != '0000-00-00' && $myrmpo[0] != '' && $myrmpo[0] != 'NULL')
{
  $date_arr=split('-',$myrmpo[0]) ;
  $year=$date_arr[0];
  $month=$date_arr[1];
  $day=$date_arr[2];
  $d = mktime(0,0,0,$month,$day,$year);
  if($myrmpo[4]=='SEA'){
   $end_date = date('M j, Y',strtotime('+60 days',$d));
  }
  if($myrmpo[4]=='AIR'){
    $end_date = date('M j, Y',strtotime('+20 days',$d));
  }

   //echo $end_date.'    date---<br>'.$myrmpo[4].'<br>';
}

 $rmpoqty=$myrmpo[3];
}
//printf('<td align="center" width="90px" bgcolor="#FFFFFF"><span class="tabletext">%s/<br>%s/%s </td>',$myrmpo[1],$rmpoqty,$end_date);
//printf('<td align="center" width="85px" bgcolor="#FFFFFF"><span class="tabletext">%s/%s%s/%s</td>',"hi","hi","hello",$end_date);
$totalrmpoqty += $rmpoqty;
printf('</td></tr>');
}


 if ($proc == 'Manufacture Only')
 {
  $crn_exp=urlencode($myrow4crn[1]);

 }


}



	$totalstock = $total+$totaldn_qty+$total4dis+$total4grn;
printf('<tr bgcolor="#F5F6F5">
        <td width="100px"><span class="tabletext"><b>%s</b></td>
	    <td width="200px"><span class="tabletext"><b>%s</b></td>
		<td align="center" width="100px"><span class="tabletext"><b>%s</b></td>
        ',$crn4total,$part_num,$totalstock);
$totalstock = 0;
$total=0;
$totaldn_qty=0;
$total4dis=0;
$total4grn=0;

}

}
?>
</td>
<br>
</br>
<td valign='top'>
<table width="200px"  border=0 cellpadding=3 cellspacing=1 bgcolor="#FFFFFF" >
<tr  bgcolor="#FFFFFF">
<td valign='top'>
<div id='cust'>
</td>
<tr>
</table>
</td></tr>
</table>
</td></tr>
</table>


<td width="6"><img src="images/spacer.gif " width="6"></td>
</tr>
<tr bgcolor="DEDFDE">
<td width="6"><img src="images/box-left-bottom.gif"></td>
<td><img src="images/spacer.gif " height="6"></td>
<td width="6"><img src="images/box-right-bottom.gif"></td>
</tr>
</table>
</table>
</table>
</table>
</FORM>
</body>
</html>
