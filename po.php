<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = June 20, 2004                =
// Filename: po.php                            =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OWT                          =
// Displays POs                                =
// Po2Wo link                                  =
//==============================================
@session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
header ( "Location: login.php" );

}
$userid = $_SESSION['user'];
$usertype = $_SESSION['usertype'];
$_SESSION['pagename'] = 'po';
$page = "Purchasing: PO";
// $_SESSION['pageval'] = "Purchasing: PO";
//////session_register('pagename');


$cond0 = "p.ponum like '%'";

$cond1 = "c.name like '%'";

$cond2 = "p.status like '%'";

$cond3 = "(pl.crn like '%' || pl.crn is null)";

$cond = $cond0 . ' and ' . $cond1 . ' and ' . $cond2 . ' and ' . $cond3;

$dept = $_SESSION['department'];
$worec='';
$oper1='like';
$oper2='like';
$oper3='like';
$sort1='recnum';
$sort2='company';
$sess=session_id();
//echo 'status'.$_REQUEST['status_val'];
if ( isset ( $_REQUEST['status_val'] ) )
{

$sval = $_REQUEST['status_val'];
//echo $sval."----------------";
if ($sval == 'All')
{
$cond2 = "p.status like " . "'%'";
}
else if ($sval == 'Open')
{
$cond2 = "p.status = '" . $sval . "'";
}
else if ($sval == 'Closed')
{
$cond2 = "p.status = '" . $sval . "'" ;
}
else if ($sval == 'Issued')
{
$cond2 = "p.status = '" . $sval . "'";
}
else if ($sval == 'Pending')
{
$cond2 = "p.status = '" . $sval . "'";
}
else
{
$cond2 = "p.status = '" . $sval . "'";
}
}
else
{
$sval = 'Open';
$cond2 = "p.status = '" . $sval . "'" ;
}


if ( isset ( $_REQUEST['sortfld1'] ) ) {
//echo 'SOORTT=='.$_REQUEST['sortfld1'];
$sort1 = $_REQUEST['sortfld1'];
}

if ( isset ( $_REQUEST['sortfld2'] ) ) {
$sort2 = $_REQUEST['sortfld2'];
}


if ( isset ( $_REQUEST['po'] ) )
{
$po_match = $_REQUEST['po'];
if ( isset ( $_REQUEST['po_oper'] ) ) {
$oper1 = $_REQUEST['po_oper'];
}
else {
$oper1 = 'like';
}
if ($oper1 == 'like') {
$po = "'" . $_REQUEST['po'] . "%" . "'";
}
else {
$po = "'" . $_REQUEST['po'] . "'";
}

$cond0 = "p.ponum " . $oper1 . " " . $po;

}
else {
$po_match = '';
}

if ( isset ( $_REQUEST['vendor'] ) )
{
$vend_match = $_REQUEST['vendor'];
if ( isset ( $_REQUEST['vend_oper'] ) ) {
$oper2 = $_REQUEST['vend_oper'];
}
else {
$oper2 = 'like';
}
if ($oper2 == 'like') {
$vendor = "'" . $_REQUEST['vendor'] . "%" . "'";
}
else {
$vendor = "'" . $_REQUEST['vendor'] . "'";
}

$cond1 = "c.name " . $oper2 . " " . $vendor;

}
else {
$vend_match = '';
}
if ( isset ( $_REQUEST['crn'] ) )
{
$crn_match = $_REQUEST['crn'];
if ( isset ( $_REQUEST['crn_oper'] ) ) {
$oper3 = $_REQUEST['crn_oper'];
}
else {
$oper3 = 'like';
}
if ($oper3 == 'like') {
$crn = "'" . $_REQUEST['crn'] . "%" . "'";
}
else {
$crn = "'" . $_REQUEST['crn'] . "'";
}
if($crn_match!='')
{
$cond3 = "pl.crn " . $oper3 . " " . $crn;
}
else
{
$cond3 = "(pl.crn like '%' || pl.crn is null)";
}

}
else {
$crn_match = '';
}


$cond = $cond0 . ' and ' . $cond1 . ' and ' . $cond2 . ' and ' . $cond3 ;

//echo $cond;


/*$cond = "p.ponum like'%'";
$worec='';
$oper='like';
$select='PO num';
$sort1='Po';
$po_match='';
$where1='';
$dept = $_SESSION['department'];

if ( isset ( $_REQUEST['po'] ) )
{
// echo "po set</br>";
$po_match = $_REQUEST['po'];
//echo "</br>po match  :$po_match</br>";
if ($po_match!='')
{
if ( isset ( $_REQUEST['pooperval'] ) ) {
$oper = $_REQUEST['pooperval'];
//echo "po oper set   :$oper</br>";
}
else {
// echo "po oper not set</br>";
$oper = 'like';
}
if ($oper == 'like') {
$po = "'" . $_REQUEST['po'] . "%" . "'";
}
    else {
	$po = "'" . $_REQUEST['po'] . "'";
    }
$where1 =$_REQUEST['pocritval'];
$select=$_REQUEST['pocritval'];
//echo "</br> value of where   :$where1";
if($where1=='PO num'){

$cond = "p.ponum" . " " . $oper . " " . $po;}
else  if($where1=='Vendor'){

$cond = "c.name" ." " . $oper . " " . $po;}
// $cond = $where1 . " " . $oper . " " . $scontact;

}
else
{
$po_match = '';
//   echo "</br>po match is null";

//$where1 =$_REQUEST['pocritval'];
//echo "where1 is  :$where1";

//echo "cond :$cond";
}
}
else {
//echo "po not set";
$po_match = '';
}
//echo "$cond";
$sort11='';

if ( isset ( $_REQUEST['sortfld1'] ) ) {
$sort1 = $_REQUEST['sortfld1'];
if ($sort1=='Po')
$sort11= "p.ponum" ;
//echo "sort is set :$sort1</br>";
//	$sort1='s.ponum';
//echo "sort is set after :$sort1";
}       */

include_once('classes/loginClass.php');

$newlogin = new userlogin;
$newlogin->dbconnect();
//$username = $_SESSION['user'];
//$newpo = new po;
// For paging - Added on Dec 6,04

// how many rows to show per page
$rowsPerPage =100;

// by default we show first page
$pageNum = 1;

// if $_GET['page'] defined, use it as page number
if (isset($_REQUEST['page']))
{
//echo "i am set";
$pageNum = $_REQUEST['page'];
}
if (isset($_REQUEST['totpages']))
{
$totpages = $_REQUEST['totpages'];
}

	echo "dept $dept <br>";

// counting the offset
$offset = ($pageNum - 1) * $rowsPerPage;
// echo "$offset";
//echo "pagenum     $pageNum<br>";
//echo "rows per  page    :$rowsPerPage";
// First include the class definition
include_once('classes/userClass.php');
include('classes/poClass.php');
include('classes/displayClass.php');
$newPO = new po;
$newdisplay = new display;
?>

<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/po.js"></script>
<script language="javascript" src="scripts/mouseover.js"></script>

<html>
<head>
<title>PO</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">
<form action='po.php' method='post' enctype='multipart/form-data'>
<?php
include('header.html');
?>
<!-- <table width=100% cellspacing="0" cellpadding="6" border="0">
<tr>
<td>
<table width=100% border=0 cellspacing="0" cellpadding="0">
<tr>
	<td colspan=2><span class="welcome"><b>Welcome <?php echo $userid?></b></td>
<td align="right">&nbsp;<a href="exit.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image16','','images/logout_mo.gif',1)"><img name="Image16" border="0" src="images/logout.gif"></a></td>
</tr>
</table>
<table width=100% border=0 cellpadding=0 cellspacing=0  >
<tr><td></td></tr>
<tr>
<td>
<?php $newdisplay->dispLinks(''); ?>
<table width=100% border=0 cellpadding=0 cellspacing=0  >
<tr bgcolor="DEDFDE">
<td width="6"><img src="images/spacer.gif " width="6"></td>
<td bgcolor="#FFFFFF">
<table width=100% border=0 cellpadding=6 cellspacing=0  > -->
<!-- <table width=100% cellspacing="0" cellpadding="6" border="0">
<tr>
<td>
<table width=100% border=0 cellpadding=0 cellspacing=0  >

<tr>
<td> -->
<table width=100% border=0 cellpadding=0 cellspacing=0  >

<td>
<table width=100% border=0 cellpadding=6 cellspacing=2 >
<tr><td><span class="heading"><i>Please click on the PO link for details and to Edit/Delete</i></span></td></tr>
<tr>
<td>
<table width=100% border=0 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF"class="stdtable1" >
<tr>
<td bgcolor="#F5F6F5" colspan="7"><span class="heading"><b><center>Search & Sort Criteria</center></b></td>

<td bgcolor="#FFFFFF" rowspan=3 align="center"><span class="tabletext">
<button class="stdbtn btn_blue" style="background-color:#2d3e50" onClick="javascript: return searchsort_fields()" >Get</button>

	 <!-- <input type= "image" name="Get" src="images/bu-get.gif" value="Get" onclick="javascript: return searchsort_fields()"> -->

</td>


</tr>
		<tr>
			<td bgcolor="#FFFFFF"><span class="tabletext"><b>PO # &nbsp</b>

						</td>
						<td bgcolor="#FFFFFF"><span class="tabletext"><select name="po_oper" size="1" width="30">
							    <?php if($oper1=='like'){?>
										<option selected>like
				            <option value>=<?php }else {?>
											<option selected>=
				            <option value>like<?php }?>
										</select>
											<input type="hidden" name="pooperval">
    				 </td>
    				 <td bgcolor="#FFFFFF"><input type="text" name="po" size=10 value="<?php echo $po_match ?>" onkeypress="javascript: return checkenter(event)"></td>
    				 
             <td bgcolor="#FFFFFF"><span class="tabletext"><b>Supplier &nbsp</b>

						</td>
						<td bgcolor="#FFFFFF"><span class="tabletext"><select name="vend_oper" size="1" width="50">
							    <?php if($oper2=='like'){?>
										<option selected>like
				            <option value>=<?php }else {?>
											<option selected>=
				            <option value>like<?php }?>
										</select>
											<input type="hidden" name="pooperval">
    				 </td>
    				 <td bgcolor="#FFFFFF" colspan=2><input type="text" name="vendor" size=15 value="<?php echo $vend_match ?>" onkeypress="javascript: return checkenter(event)"></td>

		</tr>
                          <tr>
<td  align="left" bgcolor="#FFFFFF"><span class="labeltext"><b>Status </b></td>
<td bgcolor="#FFFFFF"><span class="tabletext"><select name="status_val" size="1" width="100">
<?php
if ($sval == 'Open')
{
?>
<option selected="Open">Open
<option value="Pending">Pending</option>
<option value="Closed">Closed</option>
<option value="Cancelled">Cancelled</option>
<option value="Issued">Issued</option>
<option value="All">All</option>
<?php
}
else if ($sval == 'Closed')
{
?>
<option selected="Closed">Closed
<option value="Open">Open</option>
<option value="Pending">Pending</option>
<option value="Cancelled">Cancelled</option>
<option value="Issued">Issued</option>
<option value="All">All</option>

<?php
}
else if ($sval == 'All')
{
?>
<option selected="All">All
<option value="Open">Open</option>
<option value="Pending">Pending</option>
<option value="Closed">Closed</option>
<option value="Cancelled">Cancelled</option>
<option value="Issued">Issued</option>
<?php
}
else if ($sval == 'Issued')
{
?>
<option selected="Issued">Issued
<option value="Open">Open</option>
<option value="Pending">Pending</option>
<option value="Closed">Closed</option>
<option value="Cancelled">Cancelled</option>
<option value="All">All</option>
<?php
}
else if ($sval == 'Cancelled')
{
?>
<option selected="Cancelled">Cancelled
<option value="Open">Open</option>
<option value="Pending">Pending</option>
<option value="Closed">Closed</option>
<option value="Issued">Issued</option>
<option value="All">All</option>

<?php
}
else if ($sval == 'Pending')
{
?>
<option selected="Pending">Pending
<option value="Open">Open</option>
<option value="Closed">Closed</option>
<option value="Issued">Issued</option>
<option value="Cancelled">Cancelled</option>
<option value="All">All</option>
<?php
}
?>

</select>
</td>
<td bgcolor="#FFFFFF"><span class="tabletext"><b> &nbsp</b>
<td bgcolor="#FFFFFF"><span class="tabletext"><b>PRN Num &nbsp</b>


						<td bgcolor="#FFFFFF"><span class="tabletext"><select name="crn_oper" size="1" width="30">
							    <?php if($oper3=='like'){?>
										<option selected>like
				            <option value>=<?php }else {?>
											<option selected>=
				            <option value>like<?php }?>
										</select>

    				 </td>
    				 <td colspan=2 bgcolor="#FFFFFF"><input type="text" name="crn" size=15 value="<?php echo $crn_match ?>" onkeypress="javascript: return checkenter(event)"></td>

</tr>
</table>
         </td></tr>
	<tr><td>
<table width=100% border=0>
<tr>
<td rowspan="3">

<div class="contenttitle radiusbottom0">
<h2 class="table"><span>List of Supplier POs


			
			<?php

			if( $dept !='QA' && $dept != 'Stores'  && $dept !='PPC1' && $dept !='PPC2' && $dept !='PPC3' && $dept !='PPC4'&& $dept !='PPC5' && $usertype != 'VEND')
			{
			?>
			<input type="button" class="stdbtn btn_blue" style="float:right;padding:2px;margin-right:5px;" onClick="location.href='new_po.php'" value="New" >
		    <!-- <a href ="new_po.php"><img name="Image8" border="0" style="float:right" src="images/new.gif"></a> -->
			
			<?php
			}
			?>
			</span></h2>
</div>
				</tr>
	      </table>
	</td></tr>
<tr><td>
<table  width=1600px border=0 cellpadding=3 cellspacing=0 class="stdtable" >
<thead>
	<tr>
<th class="head0" >Seq #</th>
<th  class="head1" >PO #</th>
<th  class="head0">Date</th>
<th  class="head1">Supplier Name</th>
<th  class="head0">Description</th>
<th  class="head1">PRN</th>
<th  class="head0">Mtl Type</th>
<th  class="head1">Mtl Spec</th>
<th  class="head0">Order<br>Qty</th>
<th  class="head1">No. Of Meters</th>
<th  class="head0">No. Of Length</th>
<th  class="head1">Due Date</th>
<!-- <th  class="head0">Due Date1</th>
<td  class="head1">Due Date2</th> -->
<td  class="head0">Qty Recd</th>
<td  class="head1">Accepted Date</th>
<td  class="head0">Amount</th>
<td  align="center" class="head1">Total Amount</th>
<td  class="head0">Status</th>
</thead>
</tr>


<!-- <table width=1600px border=0 cellpadding=3 cellspacing=0 class="stdtable" > -->
<?php

$result = $newPO->getPosort($cond,$sort1,$offset,$rowsPerPage);
$precnum='##';

while($myrow = mysql_fetch_assoc($result))
{
$crn = wordwrap($myrow["crn"],"10","<br>\n",true);

$datearr = split('-', $myrow["podate"]);
$d=$datearr[2];
$m=$datearr[1];
$y=$datearr[0];
$x=mktime(0,0,0,$m,$d,$y);
$date=date("M j, Y",$x);

if($myrow["duedate"] !='' && $myrow["duedate"] !='0000-00-00' && $myrow["duetdate"] != 'null'){
$datearr = split('-', $myrow["duedate"]);
$d=$datearr[2];
$m=$datearr[1];
$y=$datearr[0];
$x=mktime(0,0,0,$m,$d,$y);
$date1=date("M j, Y",$x);
}
else
{
$date1='';
}
if($myrow["accepted_date"] !='' && $myrow["accepted_date"] !='0000-00-00' && $myrow["accepted_date"] != 'null'){
$datearr = split('-', $myrow["accepted_date"]);
$d=$datearr[2];
$m=$datearr[1];
$y=$datearr[0];
$x=mktime(0,0,0,$m,$d,$y);
$date2=date("M j, Y",$x);
}
else
{
$date2='';
}
/*if($myrow["due_date1"] !='' && $myrow["due_date1"] !='0000-00-00' && $myrow["due_date1"] != 'null'){
$datearr = split('-', $myrow["due_date1"]);
$d=$datearr[2];
$m=$datearr[1];
$y=$datearr[0];
$x=mktime(0,0,0,$m,$d,$y);
$date3=date("M j, Y",$x);
}
else
{
$date3='';
}
if($myrow["due_date2"] !='' && $myrow["due_date2"] !='0000-00-00' && $myrow["due_date2"] != 'null'){
$datearr = split('-', $myrow["due_date2"]);
$d=$datearr[2];
$m=$datearr[1];
$y=$datearr[0];
$x=mktime(0,0,0,$m,$d,$y);
$date4=date("M j, Y",$x);
}
else
{
$date4='';
}*/
if($myrow["status"]=="Pending")
{
$color = '"#FF0000"';
}
else if(($myrow["status"]=="Open")||($myrow["status"]=="open"))
{
$color = '"#00FF00"';
}
else if ($myrow["status"]=="Cancelled")
{
$color = '"#FFEABD"';
}
else if ($myrow["status"]=="Issued")
{
$color = '"#FFDADA"';
}
else
{
$color = '"#FFC89F"';
}
//echo $dept."--------------------";
if($dept !='QA'&& $dept !='PPC1' && $dept !='PPC2' && $dept !='PPC3' && $dept !='PPC4'&& $dept !='PPC5')
{
if($precnum !=$myrow["ponum"])
{
// Added for po2Wo link enhancement on Dec 20
printf('<tr bgcolor="#EEEEEE"><td bgcolor="#FFFFFF" width="78px" align="center"><span class="tabletext"><a href="poDetails.php?porecnum=%s">%s</td>
<td  width="84px" bgcolor="#FFFFFF" align="center"><span class="tabletext">%s</td>
<td width="85px" bgcolor="#FFFFFF" align="center"><span class="tabletext">%s</td>
<td width="85px" bgcolor="#FFFFFF" align="center"><span class="tabletext">%s</td>
<td width="88px" bgcolor="#FFFFFF" align="center"><span class="tabletext">%s</td>',
$myrow["recnum"],$myrow["recnum"],$myrow["ponum"],$date,wordwrap($myrow["name"],15,"<br>\n",true), wordwrap($myrow["podescr"],12,"<br>\n",true));
printf("<td width=\"78px\" bgcolor=\"#FFFFFF\" align=\"center\"><span class=\"tabletext\" >%s</td>
<td width=\"89px\" bgcolor=\"#FFFFFF\" align=\"center\"><span class=\"tabletext\" >%s</td>
<td width=\"90px\" bgcolor=\"#FFFFFF\" align=\"center\"><span class=\"tabletext\">%s</td>
<td bgcolor=\"#FFFFFF\" width=\"60px\" align=\"center\"><span class=\"tabletext\">%s</td>
<td bgcolor=\"#FFFFFF\"width=\"68px\" align=\"center\"><span class=\"tabletext\">%s</td>
<td bgcolor=\"#FFFFFF\"width=\"70px\" align=\"center\"><span class=\"tabletext\">%s</td>
<td width=\"65px\" bgcolor=\"#FFFFFF\" align=\"center\"><span class=\"tabletext\">%s</td>

<td width=\"95px\" bgcolor=\"#FFFFFF\" align=\"center\"><span class=\"tabletext\">%s</td>
<td  width=\"80px\" bgcolor=\"#FFFFFF\" align=\"center\"><span class=\"tabletext\">%s</td>
<td width=\"80px\"  bgcolor=\"#FFFFFF\" align=\"center\"><span class=\"tabletext\">%s %.2f</td>
<td width=\"80px\"  bgcolor=\"#FFFFFF\" align=\"center\"><span class=\"tabletext\">%s %.2f</td>
<td width=\"80px\" bgcolor=$color align=\"center\"><span class=\"tabletext\">%s</td></tr>
",
$myrow["crn"],$myrow["material_ref"],wordwrap($myrow["material_spec"],14,"<br>\n",true),$myrow["order_qty"] ,number_format($myrow["no_of_meterages"],2), number_format($myrow["no_of_lengths"],2), $date1,number_format($myrow["qty_recd"],2),$date2,
$myrow["currency"],$myrow["amount"],$myrow["currency"],$myrow["total_due"],$myrow["status"]);


// End additions
printf('</td></tr>');
}
else
{
printf('<tr ><td bgcolor="#FFFFFF" width="25px" ><span class="tabletext"></td>
<td width="60px" bgcolor="#FFFFFF"><span class="tabletext"></td>
<td width="60px" bgcolor="#FFFFFF"><span class="tabletext"></td>
<td width="90px" bgcolor="#FFFFFF"><span class="tabletext"></td>
<td width="90px" bgcolor="#FFFFFF"><span class="tabletext"></td>','','','','','');
printf("<td width=\"60px\" bgcolor=\"#FFFFFF\" align=\"center\"><span class=\"tabletext\" >%s</td>
<td width=\"100px\" bgcolor=\"#FFFFFF\" align=\"center\"><span class=\"tabletext\">%s</td>
<td width=\"100px\" bgcolor=\"#FFFFFF\" align=\"center\"><span class=\"tabletext\">%s</td>
<td bgcolor=\"#FFFFFF\"width=\"40px\" align=\"center\"><span class=\"tabletext\">%s</td>
<td bgcolor=\"#FFFFFF\"width=\"40px\" align=\"center\"><span class=\"tabletext\">%s</td>
<td bgcolor=\"#FFFFFF\"width=\"40px\" align=\"center\"><span class=\"tabletext\">%s</td>
<td width=\"60px\" bgcolor=\"#FFFFFF\" align=\"center\"><span class=\"tabletext\">%s</td>
<td width=\"60px\" bgcolor=\"#FFFFFF\" align=\"center\"><span class=\"tabletext\">%s</td>
<td width=\"60px\" bgcolor=\"#FFFFFF\" align=\"center\"><span class=\"tabletext\">%s</td>
<td width=\"40px\" bgcolor=\"#FFFFFF\" align=\"center\"><span class=\"tabletext\">%s %.2f</td>

<td width=\"80px\"  bgcolor=\"#FFFFFF\" align=\"center\"><span class=\"tabletext\">%s %.2f</td>
<td width=\"80px\"  bgcolor=\"#FFFFFF\" align=\"center\"><span class=\"tabletext\">%s</td></tr>",
$crn,wordwrap($myrow["material_ref"],14,"<br>\n",true),wordwrap($myrow["material_spec"],14,"<br>\n",true),$myrow["order_qty"],number_format($myrow["no_of_meterages"],2), number_format($myrow["no_of_lengths"],2), $date1,number_format($myrow["qty_recd"],2), $date2,$myrow["currency"],$myrow["amount"],$myrow["currency"],$myrow["total_due"],$myrow["status"]);
// End additions
printf('</td></tr>');

}
$precnum=$myrow["ponum"];
}else
{

if($precnum !=$myrow["ponum"])
{
// Added for po2Wo link enhancement on Dec 20
printf('<tr><td bgcolor="#FFFFFF" width="25px" align="center"><span class="tabletext"><a href="podetailsview4qa.php?porecnum=%s">%s</td>
<td width="60px" bgcolor="#FFFFFF" align="center"><span class="tabletext">%s</td>
<td width="60px" bgcolor="#FFFFFF" align="center"><span class="tabletext">%s</td>
<td width="90px" bgcolor="#FFFFFF" align="center"><span class="tabletext">%s</td>
<td width="90px" bgcolor="#FFFFFF" align="center"><span class="tabletext">%s</td>',
$myrow["recnum"],$myrow["recnum"],$myrow["ponum"],$date,wordwrap($myrow["name"],15,"<br>\n",true), wordwrap($myrow["podescr"],12,"<br>\n",true));
printf("<td width=\"60px\" bgcolor=\"#FFFFFF\" align=\"center\"><span class=\"tabletext\">%s</td>
<td width=\"100px\" bgcolor=\"#FFFFFF\" align=\"center\"><span class=\"tabletext\">%s</td>
<td width=\"100px\" bgcolor=\"#FFFFFF\" align=\"center\"><span class=\"tabletext\">%s</td>
<td bgcolor=\"#FFFFFF\"width=\"40px\" align=\"center\"><span class=\"tabletext\">%s</td>
<td bgcolor=\"#FFFFFF\"width=\"40px\" align=\"center\"><span class=\"tabletext\">%s</td>
<td bgcolor=\"#FFFFFF\"width=\"40px\" align=\"center\"><span class=\"tabletext\">%s</td>

<td width=\"60px\" bgcolor=\"#FFFFFF\" align=\"center\"><span class=\"tabletext\">%s</td>
<td width=\"40px\" bgcolor=\"#FFFFFF\" align=\"center\"><span class=\"tabletext\">%s</td>
<td width=\"80px\" bgcolor=\"#FFFFFF\" align=\"center\"><span class=\"tabletext\">%s</td>
<td width=\"80px\"  bgcolor=\"#FFFFFF\" align=\"center\"><span class=\"tabletext\">%s %.2f</td>
<td width=\"80px\"  bgcolor=\"#FFFFFF\" align=\"center\"><span class=\"tabletext\">%s %.2f</td>
  <td width=\"60px\" bgcolor=$color align=\"center\"><span class=\"tabletext\">%s</td></tr>",
$myrow["crn"],$myrow["material_ref"],wordwrap($myrow["material_spec"],14,"<br>\n",true),$myrow["order_qty"] ,number_format($myrow["no_of_meterages"],2), number_format($myrow["no_of_lengths"],2), $date1,number_format($myrow["qty_recd"],2),$date2,
$myrow["currency"],$myrow["amount"],$myrow["currency"],$myrow["total_due"],$myrow["status"]);
// End additions
printf('</td></tr>');
}
else
{



	
printf('<tr><td bgcolor="#FFFFFF" width="25px"><span class="tabletext"></td>
<td width="60px" bgcolor="#FFFFFF"><span class="tabletext"></td>
<td width="60px" bgcolor="#FFFFFF"><span class="tabletext"></td>
<td width="90px" bgcolor="#FFFFFF"><span class="tabletext"></td>
<td width="90px" bgcolor="#FFFFFF"><span class="tabletext"></td>');
printf("<td width=\"60px\" bgcolor=\"#FFFFFF\"  align=\"center\"><span class=\"tabletext\">%s</td>
<td width=\"100px\" bgcolor=\"#FFFFFF\" align=\"center\"><span class=\"tabletext\">%s</td>
<td width=\"100px\" bgcolor=\"#FFFFFF\" align=\"center\"><span class=\"tabletext\">%s</td>
<td bgcolor=\"#FFFFFF\" width=\"40px\" align=\"center\"><span class=\"tabletext\">%s</td>
<td bgcolor=\"#FFFFFF\" width=\"40px\" align=\"center\"><span class=\"tabletext\">%s</td>
<td bgcolor=\"#FFFFFF\" width=\"40px\" align=\"center\"><span class=\"tabletext\">%s</td>

<td width=\"60px\" bgcolor=\"#FFFFFF\" align=\"center\"><span class=\"tabletext\">%s</td>
<td width=\"40px\" bgcolor=\"#FFFFFF\" align=\"center\"><span class=\"tabletext\">%s</td>
<td width=\"80px\" bgcolor=\"#FFFFFF\" align=\"center\"><span class=\"tabletext\">%s</td>
<td width=\"80px\" bgcolor=\"#FFFFFF\" align=\"center\"><span class=\"tabletext\">%s %.2f</td>
<td width=\"80px\" bgcolor=\"#FFFFFF\" align=\"center\"><span class=\"tabletext\"></td>
  <td width=\"60px\" bgcolor=\"#FFFFFF\" align=\"center\"><span class=\"tabletext\"></td></tr>",
$myrow["crn"],$myrow["material_ref"],wordwrap($myrow["material_spec"],14,"<br>\n",true),$myrow["order_qty"],number_format($myrow["no_of_meterages"],2), number_format($myrow["no_of_lengths"],2), $date1,number_format($myrow["qty_recd"],2), $date2,
$myrow["currency"],$myrow["amount"]);
// End additions
printf('</td></tr>');

}
$precnum=$myrow["ponum"];
}

}

?>

</table>
</td></tr>
</table>
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

<table border = 0 cellpadding=0 cellspacing=0 width=100% >
<tr>
<td align=left>
<?php
//  Added on Dec 6,04 for paging
// how many rows we have in database
//$query   = "SELECT COUNT(*) AS numrows FROM work_order";
//$result  = mysql_query($query) or die('Error, query failed');
//$row     = mysql_fetch_array($result, MYSQL_ASSOC);
//$numrows = $row['numrows'];
$numrows =  $newPO->getPocount($cond,$offset,$rowsPerPage);
// how many pages we have when using paging?
//echo "<br>$numrows";
$maxPage = ceil($numrows/$rowsPerPage);

if (!isset($_REQUEST['page']))
{
$totpages = $maxPage;
}

$self = $_SERVER['PHP_SELF'];

// creating 'previous' and 'next' link
// plus 'first page' and 'last page' link

// print 'previous' link only if we're not
// on page one
if ($pageNum > 1)
{
$page = $pageNum - 1;
$prev = " <a href=\"po.php?page=$page&totpages=$totpages&po=$po_match&vendor=$vend_match&status_val=$sval&sortfld1=$sort1&crn=$crn_match\">[Prev]</a> ";

$first = " <a href=\"po.php?page=1&totpages=$totpages&po=$po_match&vendor=$vend_match&status_val=$sval&sortfld1=$sort1&crn=$crn_match\">[First Page]</a> ";
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
$next = " <a href=\"po.php?page=$page&totpages=$totpages&po=$po_match&vendor=$vend_match&status_val=$sval&sortfld1=$sort1&crn=$crn_match\">[Next]</a> ";

$last = " <a href=\"po.php?page=$totpages&totpages=$totpages&po=$po_match&vendor=$vend_match&status_val=$sval&sortfld1=$sort1&crn=$crn_match\">[Last Page]</a> ";
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
// End additions on Dec 6,04

?>
</td>
</tr></table>
</form>
</body>
</html>
