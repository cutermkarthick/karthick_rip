<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = June 20, 2004                =
// Filename: company.php                       =
// Copyright of Badari Mandyam, FluentSoft     =
// Revision: v1.0 OMS                          =
// Displays list of comapnies.                 =
//==============================================
@session_start();
header("Cache-control: private");
if ( !isset ( $_SESSION['user'] ) )
{
header ("Location: login.php" );
}
$userid = $_SESSION['user'];
$_SESSION['pagename'] = 'mtltrk_summary';
$page = "Purchasing: Mtl Tracker";
////////////////session_register('pagename');
$usertype = $_SESSION['usertype'];
$dept = $_SESSION['department'];

// First include the class definition
include_once('classes/userClass.php');
include_once('classes/mtl_trackerclass.php');
include_once('classes/displayClass.php');
include('classes/companyClass.php');

$newMT = new mtl_trk;
$newdisplay = new display;
$company = new company;
if ( !isset ( $_SESSION['cname'] ) )
{
$_SESSION['cname']=$_REQUEST['cname'];
}
// print_r($_REQUEST['cname']);exit;
$cond0 = "c.name like '".$_SESSION['cname']."'";
$cond1 = "p.ponum like '%'";
//$cond2="(li.accepted_date between '".$_REQUEST['fromdate']."' and '".$_REQUEST['todate']."')";
$cond = $cond0.' and '. $cond1;
// echo $cond;
$vendcond=$cond1;


if ($usertype == 'VEND') 
{
$results = $newMT->getmtltrks4vend4disp($userid,$vendcond);
$myrow4vend = mysql_fetch_row($results);
$po4disp=$myrow4vend[0];
$po4cal=$myrow4vend[1];
}
else if ($usertype == 'EMPL' && $_SESSION['cname'] != '') 
{
$results = $newMT->getmtltrks4disp($userid,$cond);
$myrow4vend = mysql_fetch_row($results);
$po4disp=$myrow4vend[0];
$po4cal=$myrow4vend[1];
} 





$stage_insprecnum='';

$oper1='like';
if ( isset ( $_REQUEST['cname'] ))
{
$_SESSION['cname']=$_REQUEST['cname'];
$cname_match =$_SESSION['cname'];
$cname ="'".  $_SESSION['cname'] . "%". "'";
$cond0 = "c.name like ". $cname;

}
if ( isset ( $_REQUEST['final_po'] ))
{
$finalpo_match = $_REQUEST['final_po'];
if ( isset ( $_REQUEST['po_oper'] ) ) {
$oper1 = $_REQUEST['po_oper'];
}
else {
$oper1 = 'like';
}
if ($oper1 == 'like') {


$finalpo = "'". $_REQUEST['final_po'] . "%"."'" ;


}
else {

$finalpo = "'" . $_REQUEST['final_po'] . "'";
}
$cond1 = "p.ponum " . $oper1 . " " . $finalpo;
}
else
{
$finalpo_match = '';
}

$cond = $cond0. ' and ' . $cond1;

// echo $cond;
$frmdt = $_REQUEST['fromdate'];
$todt = $_REQUEST['todate'];
if($frmdt != '' && $todt != '')
{
$cond2="(li.accepted_date between '".$_REQUEST['fromdate']."' and '".$_REQUEST['todate']."')";
$vendcond=$cond1.' and '.$cond2;
}
else
{
$vendcond=$cond1;
}
//echo $vendcond;
if ($usertype == 'VEND') 
{
$result = $newMT->getmtltrks4vend($userid,$vendcond);

}
else
{
$result = $newMT->getmtltrks($userid,$cond);

} 
$userrole = $_SESSION['userrole'];
// echo $cond;
// how many rows to show per page
$rowsPerPage = 1000;

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

?>
<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/mtltrk.js"></script>
<script language="javascript" src="scripts/jquery.js"></script>
<html>
<head>
<title>Material Tracker</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0" 
onload="javascript:show_graph_ontime('<?=$po4disp?>','<?= $po4cal ?>')">
<form action="mtltrksummary.php" method="post" enctype="multipart/form-data">
<?php

include('header.html');
?>
<!-- <table width=100% cellspacing="0" cellpadding="6" border="0">
<tr>
<td>
<table width=100% border=0 cellspacing="0" cellpadding="0">
<tr>
<td colspan=2><span class="welcome"><b>Welcome <?php echo $userid?></b></td>
<td align="right">&nbsp;
<a href="exit.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image16','','images/logout_mo.gif',1)"><img name="Image16" border="0" src="images/logout.gif"></a></td>
</tr>
</table>



<table width=100% border=0 cellpadding=0 cellspacing=0>
<tr><td></td></tr>
<tr>
<td>
<?php $newdisplay->dispLinks(''); ?>
</td></tr>
<table width=60% border=0 cellpadding=0 cellspacing=0>
<tr bgcolor="DEDFDE"><td width="6"><img src="images/spacer.gif " width="6"></td>
<td bgcolor="#FFFFFF"> -->
<!-- <table width=100% border=0 cellpadding=6 cellspacing=0> -->
<tr><td>
<tr><td><font class="heading"><i><b>Any line items not dispatched within +7 and -15 from the accepted due date will show in red as overdue</b></i></td></tr>
</tr>
<tr>
<td>

<?
if($usertype == 'EMPL')
{


	?>
<table style="width:82%" border=0 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF" class="stdtable_mtl">
<tr>
<td bgcolor="#F5F6F5" colspan="12"><span class="heading"><b><center>Search Criteria</center></b></td>
<td bgcolor="#FFFFFF" rowspan=3 align="center">
<button class="stdbtn btn_blue" style="padding:2px;margin-right:5px;" onClick="javascript: return searchsort_fields()" >Get</button>	
<!-- <input type= "image" name="submit" src="images/bu-get.gif" value="Get" onclick="javascript: return searchsort_fields()"> -->
  <a id='myLink' style="color:blue;padding-right:5px;" href="mtltrkexport.php?cond=<?php echo $cond;?>">Export</a>

<!-- <a href="mtltrkexport.php?cond=<?php echo $cond;?>"><img name="Image8" border="0" src="images/export.gif" ></a> -->
<input type="hidden" id="rel_oper" name="rel_oper">
<input type="hidden" id="wo_oper" name="wo_oper">
</td>
</tr>
<tr>
<td  bgcolor="#FFFFFF" ><span class="heading"><b>Supplier</b>
<?php
$res=$company->getAllVendors();       

?>
<select name="cname">
<option value="select">Select</option>
<?


$flag = 0;
$row1=mysql_fetch_object($res);
while($row1!=NULL)
{

$name=$row1->name;

$recnum=$row1->recnum;
if($_SESSION[cname]==$row1->name)
{
$status="selected";
}
else
{
$status="false";
}
?>
<?php if ($userid == 'ashorrock')
{
if($recnum ==150 || $recnum ==131)
{
?>
<option value="<? echo $row1->name;?>"
<?php
echo $status ?>>

<?

echo $row1->name;
?>
</option>
<?php 
}
}
else
{
?>
<option value="<? echo $row1->name;?>"
<?php
echo $status ?>>

<?

echo $row1->name;
?>
</option>
<?php 
}

?>
<?
$row1=mysql_fetch_object($res);

}

?>
</select></td>

<td bgcolor="#FFFFFF"><span class="labeltext"><b>PO#</b>
<span class="tabletext"><select id="po_oper" name="po_oper" size="1" width="20">
<?php
if ( isset ( $_REQUEST['po_oper'] ) ){
$check2 = $_REQUEST['po_oper'];

if ($check2 =="like"){
?>
<option value="=">=
<option selected value="like">like
<?php
}else{
?>
<option selected value="=">=
<option value="like">like

<?php
}
}else{
?>
<option selected value="like">like
<option value="=">=
<?PHP
}
?>
</select>
<input type="text" id="final_po" name="final_po" size=10 value="<?php echo $finalpo_match ?>" onkeypress="javascript: return checkenter(event)">
</td>
</tr>
</table>
<?}
else
{

?>
<table width='100%' border=0 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF" class="stdtable_mtl">
<tr>
<td bgcolor="#F5F6F5" colspan="12"><span class="heading"><b><center>Search Criteria</center></b></td>
<td bgcolor="#FFFFFF" rowspan=3 align="center">
<button class="stdbtn btn_blue" style="padding:2px;margin-right:5px;" onClick="javascript: return searchsort_fields()" >Get</button>	


  <a id='myLink' style="color:blue;padding-right:5px;" href="mtltrkexport.php?vendcond=<?php echo $vendcond;?>">Export</a>
  
  
<!--<a href="mtltrkexport.php?vendcond=<?php echo $vendcond;?>"><img name="Image8" border="0" src="images/export.gif" ></a>-->
<input type="hidden" id="rel_oper" name="rel_oper">
<input type="hidden" id="wo_oper" name="wo_oper">
</td>
</tr>
<tr>


<td bgcolor="#FFFFFF"><span class="labeltext"><b>PO#</b>
<span class="tabletext"><select id="po_oper" name="po_oper" size="1" width="20">
<?php
if ( isset ( $_REQUEST['po_oper'] ) ){
$check2 = $_REQUEST['po_oper'];

if ($check2 =='like'){
?>
<option value='='>=
<option selected value='like'>like
<?php
}else{
?>
<option selected value='='>=
<option value='like' >like

<?php
}
}else{
?>
<option selected value='like'>like
<option value='='>=
<?PHP
}
?>
</select>
<input type="text" id="final_po" name="final_po" size=10 value="<?php echo $finalpo_match ?>" onkeypress="javascript: return checkenter(event)">
</td>


<td bgcolor="#FFFFFF"><b>From:</b>
<span class="tabletext">
<input type="text" id="fromdate" name="fromdate" size=10 value="<?php echo $_REQUEST['fromdate'] ?>" onkeypress="">
<img src="images/bu-getdateicon.gif" alt="Get BookDate" onclick="GetDate('fromdate')"/>
</td>

<td bgcolor="#FFFFFF"><b>To:</b>
<span class="tabletext">
<input type="text" id="todate" name="todate" size=10 value="<?php echo $_REQUEST['todate'] ?>" onkeypress="">
<img src="images/bu-getdateicon.gif" alt="Get BookDate" onclick="GetDate('todate')"/>

</td>
</tr>
</table>
<?}

?>

<table width=100% border=0 class="stdtable_mtl">
<tr>
<td width='20%'><span class="pageheading"><b>Material Trackers</b></td>

<td><span class="pageheading"><b>Supplier:<font color='blue'><?=$myrow4vend[4]?></font></b></td>
<?php 
$_SESSION['supplier']=$myrow4vend[4];
?>
<td colspan=160 rowspan=2>&nbsp;</td>
</tr>
</table>

<?
if($_SESSION['usertype'] == 'VEND')
{


?>
<table width=100% border=0>
<tr><td width=70%>

<table  style="width:100%" border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF"  align='left' class="stdtable_mtl">
<tr>
	<thead>
<th class="head0"  bgcolor="#EEEFEE" ><span class="tabletext"><b>PO#</b></th>
<th class="head1"  bgcolor="#EEEFEE" ><span class="tabletext"><b>Line#</b></th>
<th class="head0"  bgcolor="#EEEFEE" ><span class="tabletext"><b>PO Date</b></th>  
<th class="head1"  bgcolor="#EEEFEE" ><span class="tabletext"><b>Dispatch Due <br>Date</b></th>

<th class="head0"  bgcolor="#EEEFEE"><span class="tabletext"><b>B/L Date</b></th>

<th class="head1"  bgcolor="#EEEFEE"><span class="tabletext"><b>Recd Date</b></v>



<th class="head0"  bgcolor="#EEEFEE" ><span class="tabletext"><b>RM Type</b></th>
<th class="head1"  bgcolor="#EEEFEE" ><span class="tabletext"><b>NO of Len</b></th>
<th class="head0"  bgcolor="#EEEFEE" ><span class="tabletext"><b>Recd Qty</b></th>
<th class="head1"  bgcolor="#EEEFEE" ><span class="tabletext"><b>Status</b></th>
<th class="head0"  bgcolor="#EEEFEE" ><span class="tabletext"><b>Chart</b></th>

</tr>
</thead>


<!--<div style= "overflow-y:scroll;width:100%;height:100">

<table  style="width:100%" border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF"  align='left' class="stdtable_mtl">-->
<?php           

while ($myrow = mysql_fetch_row($result)) 
{

// echo "<pre>"; print_r($myrow); exit;
if ($myrow[3] != 0)
{ 
$qty = $myrow[3];
}
else 
{
$qty = $myrow[5];
}
$order_qty=$myrow[13];
$recd_qty=$myrow[14];
if ($myrow[7] == '')
{ 
$accdate = '0000-00-00';
}

if(($myrow[7] == '0000-00-00' || $myrow[7]  == NULL) && $myrow[8] > 7)
{
$bgcolor='red';
}
else
{
$bgcolor='#FFFFFF';
}

if($myrow[7] != '0000-00-00' && $myrow[7] != '' && $myrow[7] != 'NULL')
{
$datearr = split('-', $myrow[7]);
$d=$datearr[2];
$m=$datearr[1];
$y=$datearr[0];
$x=mktime(0,0,0,$m,$d,$y);
$acc_date=date("M j, Y",$x);
}
else
{
$acc_date = '';
}
if($myrow[10] != '0000-00-00' && $myrow[10] != '' && $myrow[10] != 'NULL')
{
$datearr = split('-', $myrow[10]);
$d=$datearr[2];
$m=$datearr[1];
$y=$datearr[0];
$x=mktime(0,0,0,$m,$d,$y);
$due_date=date("M j, Y",$x);
}
else
{
$due_date = '';
}
if($myrow[6] != '0000-00-00' && $myrow[6] != '' && $myrow[6] != 'NULL')
{
$datearr = split('-', $myrow[6]);
$d=$datearr[2];
$m=$datearr[1];
$y=$datearr[0];
$x=mktime(0,0,0,$m,$d,$y);
$po_date=date("M j, Y",$x);
}
else
{
$po_date = '';
}
if($myrow[11] != '0000-00-00' && $myrow[11] != '' && $myrow[11] != 'NULL')
{
$datearr = split('-', $myrow[11]);
$d=$datearr[2];
$m=$datearr[1];
$y=$datearr[0];
$x=mktime(0,0,0,$m,$d,$y);
$due_date1=date("M j, Y",$x);
}
else
{
$due_date1 = '';
}
if($myrow[12] != '0000-00-00' && $myrow[12] != '' && $myrow[12] != 'NULL')
{
$datearr = split('-', $myrow[12]);
$d=$datearr[2];
$m=$datearr[1];
$y=$datearr[0];
$x=mktime(0,0,0,$m,$d,$y);
$due_date2=date("M j, Y",$x);
}
else
{
$due_date2 = '';
}

if($myrow[16] != '0000-00-00' && $myrow[16] != '' && $myrow[16] != 'NULL')
{
$datearr = split('-', $myrow[16]);
$d=$datearr[2];
$m=$datearr[1];
$y=$datearr[0];
$x=mktime(0,0,0,$m,$d,$y);
$bl_date=date("M j, Y",$x);
}
else
{
$bl_date = '';
}
/*<th class="head0"  bgcolor="#EEEFEE" ><span class="tabletext"><b><?php echo wordwrap('Supplier Agreed Dispatch Date1',15,"<br>\n"); ?></b></th>
<th class="head1"  bgcolor="#EEEFEE" ><span class="tabletext"><b><?php echo wordwrap('Supplier Agreed Dispatch Date2',15,"<br>\n"); ?></b></th>*/
if($ponum != $myrow[1])
{
printf("<tr bgcolor='$bgcolor'><td width=100px align=\"center\"><span class=\"tabletext\">");              
printf("<a href=\"mtltrk_details.php?ponum=%s\">",$myrow[0]);                 
printf("%s</td>
<td width=50px align=\"center\"><span class=\"tabletext\">%s</td>
<td width=100px align=\"center\"><span class=\"tabletext\">%s</td>
<td width=100px align=\"center\"><span class=\"tabletext\">%s</td>
<td width=100px align=\"center\"><span class=\"tabletext\">%s</td>


<td width=100px align=\"center\"><span class=\"tabletext\">%s</td>
<td width=100px align=\"center\"><span class=\"tabletext\">%s</td>
<td width=60px  align=\"center\"><span class=\"tabletext\">%s</td>
<td width=60px  align=\"center\"><span class=\"tabletext\">%s</td>
<td width=60px  align=\"center\"><span class=\"tabletext\">%s</td>
<td width=100px  align=\"center\"><span class=\"tabletext\"><a href=\"javascript:show_graph_ontime(%s,'%s')\">%s</td>",
$myrow[1],
$myrow[9],
$po_date,                   
$due_date,


$bl_date,
$acc_date, 
wordwrap($myrow[2],20,"<br>\n",true),
$qty,
$recd_qty,
$myrow[15],
$myrow[0],
$myrow[1],
$myrow[1] );
printf('</td></tr>');
$supplier= $myrow[4];
}
else
{
printf("<tr bgcolor='$bgcolor'><td width=100px  align=\"center\"> &nbsp;</td>
<td width=100px align=\"center\"><span class=\"tabletext\">%s</td>
<td width=100px align=\"center\"><span class=\"tabletext\">&nbsp;</td>
<td width=100px align=\"center\"><span class=\"tabletext\">%s</td>
<td width=100px align=\"center\"><span class=\"tabletext\">%s</td>


<td width=100px align=\"center\"><span class=\"tabletext\">%s</td>
<td width=100px align=\"center\"><span class=\"tabletext\">%s</td>
<td width=100px align=\"center\"><span class=\"tabletext\">%s</td>
<td width=100px align=\"center\"><span class=\"tabletext\">%s</td>
<td width=100px align=\"center\"><span class=\"tabletext\">%s</td>
<td width=100px align=\"center\"> &nbsp;</td>",
$myrow[9],              
$due_date,

$bl_date ,
$acc_date,
wordwrap($myrow[2],20,"<br>\n",true),
$order_qty,
$recd_qty,
$myrow[15]);
printf('</td></tr>');
$supplier= $myrow[4];
}
$ponum = $myrow[1];
}
?>
</table>

</div>
</td>
<td width=30% style="vertical-align:top">

<table width=100% border=0 cellpadding=4 cellspacing=1 bgcolor="#FFFFFF" class="stdtable">
<tr><td bgcolor='#FFFFFF'>
<table width=50% border=0 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF" align='left'>
<tr bgcolor="#00DDFF">
<td colspan=6><span class="heading"><center><b>Supplier Synopsis</b></center></td>
</tr>
<? 
$i=0;
$open_nccount=0;
$ftflag=0;
$overduencscount = 0;

$result1 = $newMT->getncDetails($supplier);


while($myrow = mysql_fetch_array($result1))
{

$i++;   
if($ftflag == 0)
{
if($myrow[2] != '0000-00-00' && $myrow[2] != '' && $myrow[2] != 'NULL')
{
$datearr = split('-', $myrow[2]);
$d=$datearr[2];
$m=$datearr[1];
$y=$datearr[0];
$x=mktime(0,0,0,$m,$d,$y);
$oldest_date=date("M j, Y",$x);
}
else
{
$oldest_date = '';
}
$ftflag=1;
}
if($myrow['status'] == 'Open' || $myrow['status'] == '' || $myrow['status']  == 'NULL')
{
$open_nccount++;
}
}

$firsrnc_date = $newMT->get_first_nc($supplier);
$nc_date = $firsrnc_date['date'];

if($nc_date != '0000-00-00' && $nc_date != '' && $nc_date != 'NULL')
{
$datearr = split('-', $nc_date);

$d=$datearr[2];
$m=$datearr[1];
$y=$datearr[0];
$x=mktime(0,0,0,$m,$d,$y);
$first_ncdate1=date("M j, Y",$x);

}
else
{
$first_ncdate1 = '';
}
$today = strtotime(date('Y-m-d'),"00:00:00");
$myBookDate = strtotime($myrow[2],"00:00:00");


if($myBookDate !='')
{
$days_old=round(abs($today-$myBookDate)/60/60/24)."days";
}
else
{
$days_old =0;
}

if(($days_old>=7) && ($myrow[12] =='' || $myrow[13] =='' || $myrow[14] == '' || $myrow[15] ==''))
{      
$overduencscount++;
}
?>
<tr bgcolor='#FFFFFF'>
<td ><span class="labeltext"><p align="left">Date of First NC</p></font></td>
<td><span class="tabletext"><a href="view_supplier_summary.php"><?php echo $first_ncdate1; ?><img src="images/pointer.png" border="0"></a></span></td>
</td>
</tr>

<tr bgcolor='#FFFFFF'>
<td ><span class="labeltext"><p align="left">Total Number of NCs</p></font></td>
<td><span class="tabletext"><?php if($i!=0){ ?><a href="view_supplier_summary.php"><?php echo $i ?><img src="images/pointer.png" border="0"></a><?php }
else
{

echo $i;
}?></td>
</td>
</tr>
<tr bgcolor='#FFFFFF'>
<td><span class="labeltext"><p align="left">Overdue Ncs</p></font></td>
<td><span class="tabletext"><a href="view_supplier_summary.php"><?php echo $overduencscount ?><img src="images/pointer.png" border="0"></a></td>
</td>
</tr>
<tr bgcolor='#FFFFFF'>
<td><span class="labeltext"><p align="left">Open NCs Count</p></font></td>
<td><span class="tabletext"><a href="view_supplier_summary.php"><?php echo $open_nccount ?><img src="images/pointer.png" border="0"></a></td>
</td>
</tr>
</table>
</br>


<!---------------------------------------------------->


</br>
</td></tr>
<tr bgcolor="grey">
<td >
<table border=0>
<tr><td>

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
From:&nbsp;<input type="text" name="from" id="from"/><img src="images/bu-getdateicon.gif" alt="Get BookDate" onclick="GetDate('from')"/>
To:&nbsp;<input type="text" name="to" id="to"/><img src="images/bu-getdateicon.gif" alt="Get BookDate" onclick="GetDate('to')"/>
&nbsp;&nbsp;<input type="button" value="Find" name="find" onClick="show_graph_ondate()"/>
</td></tr>
</table>
<div id="poontime">
<table id="myTable" border=1 cellpadding=3 cellspacing=1 >
</table>
</div> 
</td>
</tr></table>
</td></tr>
</table>
<?}
else
{?>
<table width=100% border=0>
<tr><td width=70%>

<table  style="width:100%" border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF"  align='left' class="stdtable">
<tr>
<thead>
<th class="head0"  bgcolor="#EEEFEE" width='100px'><span class="tabletext"><b>PO#</b></th>
<th class="head1"  bgcolor="#EEEFEE" width='50px'><span class="tabletext"><b>Line#</b></th>
<th class="head0"  bgcolor="#EEEFEE" width='100px'><span class="tabletext"><b>PRN</b></th>
<th class="head1"  bgcolor="#EEEFEE" width='100px'><span class="tabletext"><b>PO Date</b></th>  
<th class="head0"  bgcolor="#EEEFEE" width='100px'><span class="tabletext"><b><?php echo wordwrap('Dispatch Due Date',10,"<br>\n"); ?></b></th>

<th class="head1"  bgcolor="#EEEFEE" width='100px'><span class="tabletext"><b>B/L Date</b></th>
<th class="head0"  bgcolor="#EEEFEE" width='100px'><span class="tabletext"><b>Recd Date</b></th>
<th class="head1"  bgcolor="#EEEFEE" width='100px'><span class="tabletext"><b>RM Type</b></th>
<th class="head0"  bgcolor="#EEEFEE" width='60px'><span class="tabletext"><b>Order Qty</b></th>
<th class="head1"  bgcolor="#EEEFEE" width='60px'><span class="tabletext"><b>Recd Qty</b></th>
<th class="head0"  bgcolor="#EEEFEE" width='60px'><span class="tabletext"><b>Status</b></th>
<th class="head1"  bgcolor="#EEEFEE" width='100px'><span class="tabletext"><b>Chart</b></th>
</tr>
</thead>



<?php           
$ponum='';
while ($myrow = mysql_fetch_row($result)) 
{



if ($myrow[3] != 0)
{ 
$qty = $myrow[3];
}
else 
{
$qty = $myrow[5];
}
$order_qty=$myrow[13];
$recd_qty=$myrow[14];
if ($myrow[7] == '')
{ 
$accdate = '0000-00-00';
}
if(($myrow[7] == '0000-00-00' || $myrow[7]  == NULL) && $myrow[8] > 7)
$bgcolor='red';
else
$bgcolor='#FFFFFF';
if($myrow[7] != '0000-00-00' && $myrow[7] != '' && $myrow[7] != 'NULL')
{
$datearr = split('-', $myrow[7]);
$d=$datearr[2];
$m=$datearr[1];
$y=$datearr[0];
$x=mktime(0,0,0,$m,$d,$y);
$acc_date=date("M j, Y",$x);
}
else
{
$acc_date = '';
}
if($myrow[10] != '0000-00-00' && $myrow[10] != '' && $myrow[10] != 'NULL')
{
$datearr = split('-', $myrow[10]);
$d=$datearr[2];
$m=$datearr[1];
$y=$datearr[0];
$x=mktime(0,0,0,$m,$d,$y);
$due_date=date("M j, Y",$x);
}
else
{
$due_date = '';
}
if($myrow[6] != '0000-00-00' && $myrow[6] != '' && $myrow[6] != 'NULL')
{
$datearr = split('-', $myrow[6]);
$d=$datearr[2];
$m=$datearr[1];
$y=$datearr[0];
$x=mktime(0,0,0,$m,$d,$y);
$po_date=date("M j, Y",$x);
}
else
{
$po_date = '';
}
if($myrow[11] != '0000-00-00' && $myrow[11] != '' && $myrow[11] != 'NULL')
{
$datearr = split('-', $myrow[11]);
$d=$datearr[2];
$m=$datearr[1];
$y=$datearr[0];
$x=mktime(0,0,0,$m,$d,$y);
$due_date1=date("M j, Y",$x);
}
else
{
$due_date1 = '';
}
if($myrow[12] != '0000-00-00' && $myrow[12] != '' && $myrow[12] != 'NULL')
{
$datearr = split('-', $myrow[12]);
$d=$datearr[2];
$m=$datearr[1];
$y=$datearr[0];
$x=mktime(0,0,0,$m,$d,$y);
$due_date2=date("M j, Y",$x);
}
else
{
$due_date2 = '';
}

if($myrow[16] != '0000-00-00' && $myrow[16] != '' && $myrow[16] != 'NULL')
{
$datearr = split('-', $myrow[16]);
$d=$datearr[2];
$m=$datearr[1];
$y=$datearr[0];
$x=mktime(0,0,0,$m,$d,$y);
$bl_date=date("M j, Y",$x);
}
else
{
$bl_date = '';
}

if($ponum != $myrow[1])
{
printf("<tr bgcolor='$bgcolor'><td width=100px align=\"center\"><span class=\"tabletext\">");              
printf("<a href=\"mtltrk_details.php?ponum=%s\">",$myrow[0]);                 
printf("%s</td>
<td width=50px align=\"center\"><span class=\"tabletext\">%s</td>
<td width=100px align=\"center\"><span class=\"tabletext\">%s</td>
<td width=100px align=\"center\"><span class=\"tabletext\">%s</td>
<td width=100px align=\"center\"><span class=\"tabletext\">%s</td>

<td width=100px align=\"center\"><span class=\"tabletext\">%s</td>

<td width=100px align=\"center\"><span class=\"tabletext\">%s</td>
<td width=100px align=\"center\"><span class=\"tabletext\">%s</td>
<td width=60px  align=\"center\"><span class=\"tabletext\">%s</td>
<td width=60px  align=\"center\"><span class=\"tabletext\">%s</td>
<td width=60px  align=\"center\"><span class=\"tabletext\">%s</td>
<td width=100px align=\"center\" ><span class=\"tabletext\"><a href=\"javascript:show_graph_ontime(%s,'%s')\">%s</td>",


$myrow[1],
$myrow[9],
$myrow[17],
$po_date,                   
$due_date,


$bl_date ,
$acc_date, 
wordwrap($myrow[2],20,"<br>\n",true),
$qty,
$recd_qty,
$myrow[15],
$myrow[0],
$myrow[1],
$myrow[1] );
printf('</td></tr>');
$supplier= $myrow[4];


}
else
{
printf("<tr bgcolor='$bgcolor'><td width=100px> &nbsp;</td>
<td width=100px align=\"center\"><span class=\"tabletext\">%s</td>
<td width=100px align=\"center\"><span class=\"tabletext\">%s</td>
<td width=100px align=\"center\"><span class=\"tabletext\">&nbsp;</td>
<td width=100px align=\"center\"><span class=\"tabletext\">%s</td>
<td width=100px align=\"center\"><span class=\"tabletext\">%s</td>

<td width=100px align=\"center\"><span class=\"tabletext\">%s</td>
<td width=100px align=\"center\"><span class=\"tabletext\">%s</td>
<td width=100px align=\"center\"><span class=\"tabletext\">%s</td>
<td width=100px align=\"center\"><span class=\"tabletext\">%s</td>
<td width=100px align=\"center\"><span class=\"tabletext\">%s</td>

<td width=100px> &nbsp;</td>",


$myrow[9],              
$myrow[17],
$due_date,

$bl_date,
$acc_date,
wordwrap($myrow[2],20,"<br>\n",true),
$order_qty,
$recd_qty,
$myrow[15]);
printf('</td></tr>');
$supplier= $myrow[4];
}

$ponum = $myrow[1];
}
?>

</table>
</td>
<td width=30% style="vertical-align:top">
<?
if(isset($_SESSION['cname']))
{?>

<table width=100% border=0 cellpadding=4 cellspacing=1 bgcolor="#FFFFFF" class="stdtable">
<tr><td bgcolor='#FFFFFF'>
<table width=50% border=0 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF" align='left'>
<tr bgcolor="#00DDFF">
<td colspan=6><span class="heading"><center><b>Supplier Synopsis</b></center></td>
</tr>
<?

$i=0;
$open_nccount=0;
$ftflag=0;
$overduencscount = 0;

$result1 = $newMT->getncDetails($supplier);
while($myrow = mysql_fetch_array($result1))
{
$i++;   
if($ftflag == 0)
{
if($myrow[2] != '0000-00-00' && $myrow[2] != '' && $myrow[2] != 'NULL')
{
$datearr = split('-', $myrow[2]);
$d=$datearr[2];
$m=$datearr[1];
$y=$datearr[0];
$x=mktime(0,0,0,$m,$d,$y);
$oldest_date=date("M j, Y",$x);
}
else
{
$oldest_date = '';
}
$ftflag=1;
}
if($myrow['status'] == 'Open' || $myrow['status'] == '' || $myrow['status']  == 'NULL')
{
$open_nccount++;
}

$today = strtotime(date('Y-m-d'),"00:00:00");
$myBookDate = strtotime($myrow[2],"00:00:00");
if($myBookDate != '')
{
$days_old=round(abs($today-$myBookDate)/60/60/24)."days";
}
else
{

$days_old = 0;
}



if(($days_old>=7) && ($myrow[12] =='' || $myrow[13] =='' || $myrow[14] == '' || $myrow[15] ==''))
{

$overduencscount++;
}
}
?>
<tr bgcolor='#FFFFFF'>
<td ><span class="labeltext"><p align="left">Date of First NC</p></font></td>
<td><span class="tabletext"><?php echo $i ?><img src="images/pointer.png" border="0"></td>

</td>
</tr>

<tr bgcolor='#FFFFFF'>
<td ><span class="labeltext"><p align="left">Total Number of NCs</p></font></td>
<td><span class="tabletext"><?php echo $i ?><img src="images/pointer.png" border="0"></td>
</td>
</tr>
<tr bgcolor='#FFFFFF'>
<td><span class="labeltext"><p align="left">Overdue NCs</p></font></td>
<td><span class="tabletext"><?php echo $overduencscount ?><img src="images/pointer.png" border="0"></td>
</td>
</tr>
<tr bgcolor='#FFFFFF'>
<td><span class="labeltext"><p align="left">Open NCs Count</p></font></td>
<td><span class="tabletext"><?php echo $open_nccount ?><img src="images/pointer.png" border="0"></td>
</td>
</tr>
</table>
</br>


<!---------------------------------------------------->


</br>
</td></tr>
<tr bgcolor="grey">
<td >
<table border=0>
<tr><td>

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
From:&nbsp;<input type="text" name="from" id="from"/><img src="images/bu-getdateicon.gif" alt="Get BookDate" onclick="GetDate('from')"/>
To:&nbsp;<input type="text" name="to" id="to"/><img src="images/bu-getdateicon.gif" alt="Get BookDate" onclick="GetDate('to')"/>
&nbsp;&nbsp;<input type="button" value="Find" name="find" onClick="show_graph_ondate()"/>
</td></tr>
</table>
<div id="poontime">
<table id="myTable" border=1 cellpadding=3 cellspacing=1 >
</table>
</div>
<?}?>

</td>
</tr></table>
</td></tr>
</table>
<?}?>
</td>
</tr>
</table>
</td>
<!-- <td width="6"><img src="images/spacer.gif " width="6"></td>
</tr>
<tr bgcolor="DEDFDE">
<td width="6"><img src="images/box-left-bottom.gif"></td>
<td><img src="images/spacer.gif " height="6"></td>
<td width="6"><img src="images/box-right-bottom.gif"></td>
</tr> -->
</table>
<table border = 0 cellpadding=0 cellspacing=0 width=100% bgcolor="FFFFFF">
<tr>
<td align=left>
<?php

//Additions on Dec 29 04 by Jerry George to implement pagination

// $numrows = $newSI->getstage_inspCount($cond,$offset,$rowsPerPage);
// how many pages we have when using paging?
$numrows = 10;
$maxPage = ceil($numrows/$rowsPerPage);
//echo "$maxPage</br>";
if (!isset($_REQUEST['page']))
{
//   echo "page is set";
$totpages = $maxPage;
}

//echo "total pages :$totpages</br>";
$self = $_SERVER['PHP_SELF'];

// creating 'previous' and 'next' link
// plus 'first page' and 'last page' link

// print 'previous' link only if we're not
// on page one
if ($pageNum > 1)
{
$page = $pageNum - 1;
$prev = " <a href=\"mtltrksummary.php?page=$page&totpages=$totpages\">[Prev]</a> ";

$first = " <a href=\"mtltrksummary.php?page=1&totpages=$totpages\">[First Page]</a> ";
}
else
{
$prev  = ' [Prev] ';       // we're on page one, don't enable 'previous' link
$first = ' [First Page] '; // nor 'first page' link
}

// print 'next' link only if we're not
// on the last page
if ($pageNum < $totpages)
{
$page = $pageNum + 1;
$next = " <a href=\"mtltrksummary.php?page=$page&totpages=$totpages\">[Next]</a> ";

$last = " <a href=\"mtltrksummary.php?page=$totpages&totpages=$totpages\">[Last Page]</a> ";
}
else
{
$next = ' [Next] ';      // we're on the last page, don't enable 'next' link
$last = ' [Last Page] '; // nor 'last page' link
}
if($totpages!=0)
{
//$pageNum=0;
// print the page navigation link
echo "<span class=\"labeltext\">" . $first . $prev . " Showing page <strong>$pageNum</strong> of <strong>$totpages</strong> pages " . $next . $last;
}
else
echo "<span class=\"labeltext\"><align=\"center\">No matching records found";
// End additions on Dec 29,04      

?>
</td>
</tr>
</table>
</FORM>
</body>
</html >

