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
$rowsPerPage = 10;
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
<title>PRN Stock Report</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">

<form action='crncostreport.php' method='post' enctype='multipart/form-data'>
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
<table width=100% border=0 cellpadding=0 cellspacing=0  >
  <tr bgcolor="DEDFDE"><td width="6"><img src="images/spacer.gif " width="6"></td>
	    <td bgcolor="#FFFFFF">
 <table width=100% border=0 cellpadding=6 cellspacing=0  >
     <tr><td>
		</tr>
  <tr>
<td>
</td></tr>
<tr><td>

<table width="100%" border=0>
<tr>
<td><span class="pageheading"><b>PRN Report</b></td>
<td colspan=160>&nbsp;</td>
</tr>
</table>

<table width="100%" align="center" border=0 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF">
<tr bgcolor="#F5F6F5">
<td align="center" colspan=7><span class="heading"><b>Search Criteria</b></td></tr>
<tr>
<td bgcolor="#FFFFFF"><span class="tabletext"><b>PRN:</b>&nbsp;
<input type="text" size=15% name="crn" value="<?echo $_REQUEST['crn'] ?>">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="button"><b><input type="submit" name="submit" value="Get"></b></td>
<td bgcolor="#FFFFFF" align='center' width='85%'><span class="pageheading"><b><a href="" id='excel' onclick="javascript: return crn_cost_export('')">Export</a>
</td>
</tr>
   
</table>

<table width="100%" border=0 cellpadding=3 cellspacing=1 bgcolor="#FFFFFF">
<tr bgcolor="#FFFFFF">
<td valign='top'>
<?php
if($crn!='')
{?>
<table style="table-layout: fixed" width="700px" style="border:1px solid #000000;" border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
<tr bgcolor="#FFCC00">
<td width="80px" bgcolor="#EEEFEE"><span class="tabletext" align='center'><b>PRN</b></td>
<td width="150px" bgcolor="#EEEFEE"><span class="tabletext" align='center'><b>WO Process</b></td>
<td width="70px" bgcolor="#EEEFEE"><span class="tabletext" align='center'><b>WO Qty<br>(WIP)</b></td>
<td  width="70px" bgcolor="#EEEFEE" align='center'><span class="tabletext"><b>Cost</b></td>
<td width="70px" bgcolor="#EEEFEE"><span class="tabletext" align='center'><b>FG<br>Stock</b></td>
<td  width="70px" bgcolor="#EEEFEE" align='center'><span class="tabletext"><b>Cost</b></td>
<td width="70px" bgcolor="#EEEFEE"><span class="tabletext" align='center'><b>GRN<br>Stock</b></td>
<td  width="70px" bgcolor="#EEEFEE" align='center'><span class="tabletext"><b>Cost</b></td>
</tr>
</table>

<div style="width:720px; height:200; overflow:auto;border:" id="dataList">
<table width="700px" style="border:1px solid #000000;" border=1 cellpadding=3 cellspacing=1 bgcolor="#FFFFFF">
<tr bgcolor="#FFFFFF">
<td valign='top' width='79px'>
<?php
$cond='';
if($crn!='')
{
$cond='and w.crn_num like '."'".$crn."%'";
$cond1='where w.crn_num like '."'".$crn."%'";
}
else
{
$cond='';
$cond1='';
}
$result = $newreport->getallCRN4all($cond1); 
$total=0;
$total4dis=0;
$total4grn=0;
$totalbalance=0;

$total_cost1_dol=0;
$total_cost1_re=0;
$total_cost1_others=0;
$total_cost2_dol=0;
$total_cost2_re=0;
$total_cost2_others=0;
$total_cost3_dol=0;
$total_cost3_re=0;
$total_cost3_others=0;

$woprocarr = array("Manufacture Only","With Treatment");

while($myrow4crn=mysql_fetch_row($result))
{
?>
<table style="table-layout: fixed" width="75px" border=0 cellpadding=3 cellspacing=1 bgcolor="#FFFFFF">
<?
printf('<tr bgcolor="#FFFFFF" valign="top" rowspan=2>
        <td align="center"><a href="javascript:ShowDetails(\'%s\')"><span class="tabletext"><font color="red">%s</font></td> ',$myrow4crn[1],$myrow4crn[1]);
?>
</table>
</td>
<?
foreach ($woprocarr as $proc) 
{?>
<td valign='top' width='290px'>
<table style="table-layout: fixed" width="100%"  border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
<?
printf('<tr valign="top">');
printf('<td  width="150px"  align="center" bgcolor="#FFFFFF"><span class="tabletext">%s</td>',$proc);
$results = $newreport->getallCRN4open($myrow4crn[1],$proc);  
if(mysql_num_rows($results) == '0')
{
   printf('<td width="70px" align="center" bgcolor="#FFFFFF"><span class="tabletext">%s</td>','&nbsp');
   printf('<td  width="70px" align="right" bgcolor="#FFFFFF"><span class="tabletext">%s</td>','&nbsp');
   $results_c1 = $newreport->getprice4crn($myrow4crn[1]); 
   while($myrow4c1=mysql_fetch_row($results_c1))
   {
		$soprice = $myrow4c1[1];
		$so_curr = $myrow4c1[2];
   }
}
while($myrow4=mysql_fetch_row($results))
{  
  printf('<td  width="70px" align="center" bgcolor="#FFFFFF"><span class="tabletext">%d</td>',$myrow4[2]);
  $results_c1 = $newreport->getprice4crn($myrow4crn[1]); 
  while($myrow4c1=mysql_fetch_row($results_c1))
  {
	if($myrow4[2] != '')
	{	
		$soprice = $myrow4c1[1];
		$so_curr = $myrow4c1[2];
		
		$cost1=($myrow4[2]*$myrow4c1[1]);
		printf('<td width="70px"  align="right" bgcolor="#FFFFFF"><span class="tabletext">%s %d</td>',$myrow4c1[2],$cost1);		
		if($myrow4c1[2] == '$')
		{
			$total_cost1_dol = $total_cost1_dol + $cost1;		  
		}
		else if($myrow4c1[2] == 'RS'|| $myrow4c3[1] == 'Rs')
		{
			$total_cost1_re = $total_cost1_re + $cost1;	
		}
		else 
		{
            $total_cost1_others = $total_cost1_others + $cost1;	
		}
	}
	else
	{
       printf('<td width="70px" align="right" bgcolor="#FFFFFF"><span class="tabletext">%s</td>','NA');
	}
  }
  $total = $total + $myrow4[2];
}
printf('</td></tr>');
?>
</table>

</td>
<td valign='top' width='140px'>

<table style="table-layout: fixed" width="140px"  border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
<?
$result4closed = $newreport->getallCRN4closed($myrow4crn[1],$proc); 
if(mysql_num_rows($result4closed) == '0')
{
 printf('<td align="center" width="70px" bgcolor="#FFFFFF"><span class="tabletext">%s</td>','&nbsp;');
 printf('<td align="right" width="70px" bgcolor="#FFFFFF"><span class="tabletext">%s</td>','&nbsp;');
}
while($myrow4closed=mysql_fetch_row($result4closed))
{
printf('<tr>');
$result1 = $newreport->getallCRNDetails($myrow4closed[0],$myrow4closed[2],$proc); 
$num_rows = mysql_num_rows($result1);
if($num_rows=='0')
{
printf('<td align="center" width="70px" bgcolor="#FFFFFF"><span class="tabletext">%d</td>',$myrow4closed[2]);
$cost2=($myrow4closed[2]*$soprice);
printf('<td align="right" width="70px" bgcolor="#FFFFFF"><span class="tabletext">%s %d</td>',$so_curr,$cost2);
$total4dis = $total4dis + $myrow4closed[2];
if($so_curr == '$')
{
$total_cost2_dol = $total_cost2_dol + $cost2;
}
else if($so_curr == 'RS'|| $myrow4c3[1] == 'Rs')
{
$total_cost2_re = $total_cost2_re + $cost2;
}
else
{
$total_cost2_others = $total_cost2_others + $cost2;
}
}
while($myrow4dispatch=mysql_fetch_row($result1))
{
printf('<td align="center" width="70px" bgcolor="#FFFFFF"><span class="tabletext">%d</td>',$myrow4dispatch[0]); 
$total4dis = $total4dis + $myrow4dispatch[0];

$cost2=($myrow4dispatch[0]*$soprice);
printf('<td  width="70px" align="right" bgcolor="#FFFFFF"><span class="tabletext">%s %d</td>',$so_curr,$cost2);
if($so_curr == '$')
{
$total_cost2_dol = $total_cost2_dol + $cost2;
}
else if($so_curr == 'RS'|| $myrow4c3[1] == 'Rs')
{
$total_cost2_re = $total_cost2_re + $cost2;
}
else
{
$total_cost2_others = $total_cost2_others + $cost2;
}
}
printf('</td></tr>');
}
?>
</table>

</td>
<td valign='top' width='140px'>

<table style="table-layout: fixed" width="140px" border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
<?
printf('<tr>');
$resultall = $newreport->getCRN($myrow4crn[1],'Regular');
while($myrow4all=mysql_fetch_row($resultall))
{
$result2 = $newreport->getallGRN4Details($myrow4all[2],$myrow4all[0],$myrow4all[1],'Regular');
$num_rows = mysql_num_rows($result2);
if($num_rows=='0')
{
printf('<td align="center" width="70px" bgcolor="#FFFFFF"><span class="tabletext">%s</td>','&nbsp;');
printf('</td></tr>');
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
    printf('<td align="center" width="70px" bgcolor="#FFFFFF"><span class="tabletext">%d</td>',$totalbalance);
	$results_c3 = $newreport->getrate4crn($myrow4crn[1]); 
	$numrows = mysql_num_rows($results_c3);	
    if($numrows=='0')
    {
     printf('<td align="right" width="70px" bgcolor="#FFFFFF"><span class="tabletext">%s</td>','&nbsp;');
    }
    while($myrow4c3=mysql_fetch_row($results_c3))
    {		
	  $cost3=($totalbalance*$myrow4c3[0]);
	   printf('<td  width="70px" align="right" bgcolor="#FFFFFF"><span class="tabletext">%s %d</td>',$myrow4c3[1],$cost3);
	   if($myrow4c3[1] == '$')
	   {
			$total_cost3_dol = $total_cost3_dol + $cost3;
	   }
	   else if($myrow4c3[1] == 'RS'|| $myrow4c3[1] == 'Rs')
	   {
			$total_cost3_re = $total_cost3_re + $cost3;
	   }
	   else 
	   {
			$total_cost3_others = $total_cost3_others + $cost3;
	   }
    }  
}
else
{
    printf('<td align="right" width="70px" bgcolor="#FFFFFF"><span class="tabletext">%s</td>','&nbsp');
    printf('<td align="right" width="70px" bgcolor="#FFFFFF"><span class="tabletext">%s</td>','&nbsp');
}
printf('</tr>'); 
$totalbalance='&nbsp';
?>
</table>
</td></tr><tr><td valign='top'>
<?
}
}?>
</table>
<table style="table-layout: fixed" width="700px" style="border:1px solid #000000;"  border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
<?
printf('<tr bgcolor="#F5F6F5"> 
        <td width="80px"><span class="tabletext"><b>%s</b></td>
		<td align="center" width="150px"><span class="tabletext"><b>%s</b></td>
		<td align="center" width="70px"><span class="tabletext"><b>%d</b></td>
		<td align="right" width="70px"><span class="tabletext"><b>$ %d</b></td>
		<td align="center" width="70px"><span class="tabletext"><b>%d</b></td>
		<td align="right" width="70px"><span class="tabletext"><b>$ %d</b></td>
		<td align="center" width="70px"><span class="tabletext"><b>%d</b></td>		
		<td align="right" width="70px"><span class="tabletext" width="70px"><b>$ %d</b></td></tr>','Total','&nbsp;',$total,$total_cost1_dol,$total4dis,$total_cost2_dol,$total4grn,$total_cost3_dol);

		printf('<tr bgcolor="#F5F6F5"> 
        <td width="80px"><span class="tabletext"><b>%s</b></td>
		<td align="center" width="150px"><span class="tabletext"><b>%s</b></td>
		<td align="center" width="70px"><span class="tabletext"><b>%s</b></td>
		<td align="right" width="70px"><span class="tabletext"><b>Rs %d</b></td>
		<td align="center" width="70px"><span class="tabletext"><b>%s</b></td>
		<td align="right" width="70px"><span class="tabletext"><b>Rs %d</b></td>
		<td align="center" width="70px"><span class="tabletext"><b>%s</b></td>		
		<td align="right" width="70px"><span class="tabletext" width="70px"><b>Rs %d</b></td></tr>','&nbsp;','&nbsp;','&nbsp;',$total_cost1_re,'&nbsp;',$total_cost2_re,'&nbsp;',$total_cost3_re);

		printf('<tr bgcolor="#F5F6F5"> 
        <td width="80px"><span class="tabletext"><b>%s</b></td>
		<td align="center" width="150px"><span class="tabletext"><b>%s</b></td>
		<td align="center" width="70px"><span class="tabletext"><b>%s</b></td>
		<td align="right" width="70px"><span class="tabletext"><b>Oth: %d</b></td>
		<td align="center" width="70px"><span class="tabletext"><b>%s</b></td>
		<td align="right" width="70px"><span class="tabletext"><b>Oth: %d</b></td>
		<td align="center" width="70px"><span class="tabletext"><b>%s</b></td>		
		<td align="right" width="70px"><span class="tabletext" width="70px"><b>Oth: %d</b></td></tr>','&nbsp;','&nbsp;','&nbsp;',$total_cost1_others,'&nbsp;',$total_cost2_others,'&nbsp;',$total_cost3_others);

?>
</tr>
</table>
<?php
}
?>
</td>

<br>
</br>
<td valign='top'>
<table width="200px"  border=0 cellpadding=3 cellspacing=1 bgcolor="#FFFFFF" >
<tr  bgcolor="#FFFFFF">
<td>
<div id='cust'>
</td>
<tr>
</table>
</td></tr>
</table>
</td></tr>
</table>
<input type='hidden' name='crn_num' value='<?echo $crn?>'>
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
