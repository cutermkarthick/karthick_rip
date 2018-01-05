<?php
//==============================================
// Author: FSI                                 =
// Date-written = June 20, 2007                =
// Filename: new_grn.php                       =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 WMS                          =
// Allows entry of new GRN                     =
//==============================================
session_start();
header("Cache-control: private");
if ( !isset ( $_SESSION['user'] ) )
{
header ( "Location: login.php" );

}
$userid = $_SESSION['user'];
$dept = $_SESSION['department'];

$_SESSION['pagename'] = 'new_grn';
//////session_register('pagename');

// First include the class definition
include('classes/userClass.php');
include('classes/grnclass.php');
include('classes/displayClass.php');
include('classes/grncofcclass.php');

$newlogin = new userlogin;
$newlogin->dbconnect();

$newdisplay = new display;

$newgrn = new grn;
$newcofc=new cofc;
$approved =  $dept . ' ' . $userid . ' ' . date('M d, m');
$validate = '0';

$grnrecnum = $_REQUEST['grnrecnum'];
$grnnum=$_REQUEST['grnnum'];
$qtm_req=$_REQUEST['qtm_req'];

$crn=$_REQUEST['altcrn'];
$to_crn=$_REQUEST['crn'];
$crn=trim($crn);

if (isset($_REQUEST['bal']))
{   
	$bal=$_REQUEST['bal'];
}

//echo "<br>bal is $bal";
if( $grnrecnum != '')
{
$result = $newgrn->getgrn($grnrecnum);
$myrow = mysql_fetch_row($result);
$grnli = $newgrn->getgrnli($grnrecnum);

$cofc= $newcofc->getcofc($grnrecnum);
$row=mysql_fetch_object($cofc);
$dimenssion=$row->dimensional;
$ndt=$row->ndt;
$visual=$row->visual;
$grain=$row->grain;
$mech=$row->mech;
$conductivity=$row->conductivity;
$chemical=$row->chemical;
$hardness=$row->hardness;
$quantity=$row->quantity;
$temper=$row->temper;
$cus=$row->cusserial;
$from=$row->frmserial;
$to=$row->toserial;
$noncon=$row->noncon;
$ncref=$row->ncref;
$ncdate=$row->ncdate;
$comm=$row->comm;
$dcomm=$row->dcomm;
$remarks=$row->remarks;
$approval=$row->approval;

if($ncdate != '0000-00-00' && $ncdate != '' && $ncdate != 'NULL')
{
  $datearr = split('-', $ncdate);
  $d=$datearr[2];
  $m=$datearr[1];
  $y=$datearr[0];
  $x=mktime(0,0,0,$m,$d,$y);
  $date1=date("M j, Y",$x);
}
else
{
 $date1 = '';
}
$result_bill = $newgrn->getrm_qty_perbill($to_crn);
$myrow4bill = mysql_fetch_row($result_bill);
$cond=" crn='$crn' ";
$result_parent = $newgrn->getparent_grn($cond);

$result_layout = $newgrn->getall_layout();
while($myrow_layout = mysql_fetch_row($result_layout))
{
   $layout[] = $myrow_layout[0];
}
 $layout_db= implode("|",$layout);
}

?>
<html>
<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/grn.js"></script>

<head>
<meta content="text/html;charset=utf-8" http-equiv="Content-Type">
<title>GRN SWAP</title>
</head>

<body leftmargin="0"topmargin="0" marginwidth="0">

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
<?php 
$newdisplay->dispLinks('');
?>
</td></tr>
<table width=100% border=0 cellpadding=0 cellspacing=0  >

<tr bgcolor="DEDFDE"><td width="6"><img src="images/spacer.gif " width="6"></td>
<td bgcolor="#FFFFFF">
<table width=100% border=0 cellpadding=6 cellspacing=0  >
<tr>
<td><span class="pageheading"><b>GRN SWAP</b></td>
</tr>

<form action='processgrn.php' method='post' enctype='multipart/form-data'>
<tr>
<td>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
<tr bgcolor="#DDDEDD">
<td height="34" colspan=4><span class="heading">
<center><b>GRN Header</b></center></td>
</tr>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >

<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>GRN Classification</p></font>
<td><span class="tabletext"><input type="text" name="wotype" id="wotype"
style="background-color:#DDDDDD;" readonly="readonly"  value="<?=$_REQUEST['wotype']?>">
<select name="wotype1" id="wotype1"  size="1" width="20" onchange="onSelectWOType('new_grn')">
<option selected>Please Specify
<option value="Regular">Regular
<option value="Assy">Assy
</select>
</td>
<td width=25%><span class="labeltext"><p align="left"><span class='asterisk'>*</span>QTM Req</p></font></td>
<td width=25%>
<!--<input type="text" name="qtm_req" id="qtm_req" size=20 value="<?=$qtm_req?>" onkeyup="getqtm_reqdetails()">-->
<input type="text" name="qtm_req" id="qtm_req" size=20 value="<?=$qtm_req?>">
</td>
</tr>

<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">From PRN</p></font></td>
<td><input type="text" id="altcrn" name="altcrn" size=20 style="background-color:#DDDDDD;" readonly="readonly"  value="<?=$_REQUEST['altcrn']?>" >
<img src='images/bu-get.gif' name='cim' onclick='GetCIM("<?php echo 'altcrn' ?>")'></td>
<td><span class="labeltext"><p align="left">To CRN (Alternate)</p></font></td>
<td><input type="text" id="crn" name="crn" size=20 style="background-color:#DDDDDD;" readonly="readonly"  value="<?=$_REQUEST['crn']?>" >
<img src='images/bu-get.gif' name='cim' onclick='GetCIM("<?php echo 'crn' ?>")'></td>
</tr>
<tr bgcolor="#FFFFFF">
<td width=25%><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Parent GRN No.</p></font></td>
<?
if($grnrecnum != '')
{?>
<td width=25%>
<div id='parent_grn'>
<span class="tabletext"><select name="parentgrnnum" id="parentgrnnum"  size="1" onchange='getparentrecnum(this)'>
<option selected value=''>Please Specify
<?php 
while ($myrow_p = mysql_fetch_row($result_parent)) 
{
	 if($myrow_p[1] == $grnnum)
	 {
			  printf('<option selected value=%s|%s|%s>%s', $myrow_p[0],$myrow_p[1],$myrow_p[2],$myrow_p[1]);
	 }
	 else
	 { 
		  printf('<option value=%s|%s|%s>%s', $myrow_p[0],$myrow_p[1],$myrow_p[2],$myrow_p[1]);			
	 
	 }
}
?>
</select>
</div>
</td>
<?}
else
{?>
<td width=25%>
<div id='parent_grn'>
<span class="tabletext"><input type='text' name="parentgrnnum" id="parentgrnnum"  onchange='getparentrecnum(this)' size=20 style=";background-color:#DDDDDD;" readonly="readonly"></div></td>
<?}
?>
<td width=25%><span class="labeltext"><p align="left">Layout Ref#</p></font></td>
<td width=25%><span class=\"tabletext\"><input type="text" id="layout_ref1"  name="layout_ref1" value="" size="20" onkeyup="javascript:swap_removereadonly(this)"></td>
</tr>

<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>GRN No.</p></font></td>
<td><input type="text" name="grnnum" id="grnnum" size=20 value="">
</td>
<td colspan=2></td>
</tr>

<?
if($grnrecnum != '')
{?>
<tr bgcolor="#FFFFFF">
<td  width=25%><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Supplier</p></font></td>
<td><span class="tabletext"><input type="text" name="vendor"
style=";background-color:#DDDDDD;"
readonly="readonly" size=20 value="<?php echo "$myrow[23]";?>"></td>
<input type="hidden" name="vendrecnum" id="vendrecnum" value="<?php echo "$myrow[24]";?>">
</td>
<td><span class="labeltext"><p align="left">Raw Material Type</p></font></td>
<td><input type="text" name="raw_mat_type" id="raw_mat_type" size=20 value="<?php echo $myrow[4] ?>" style=";background-color:#DDDDDD;" readonly="readonly">
</td>
</tr>
<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">Raw Material Spec</p></font></td>
<td><input type="text" name="raw_mat_spec" id="raw_mat_spec" size=20 value="<?php echo $myrow[5] ?>" style=";background-color:#DDDDDD;" readonly="readonly"></td>

<td><span class="labeltext"><p align="left">Raw Material Code</p></font></td>
<td><input type="text" name="raw_mat_code" size=19 value="<?php echo $myrow[12] ?>" style=";background-color:#DDDDDD;" readonly="readonly"></td>
</tr>
<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">MGP/DC No.</p></font></td>
<td><input type="text" name="mgp_num" size=20 value="<?php echo $myrow[18] ?>" style=";background-color:#DDDDDD;" readonly="readonly"></td>
<td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Invoice No.</p></font></td>
<td><input type="text" name="invoice_num" size=20 value="<?php echo $myrow[13] ?>" style=";background-color:#DDDDDD;" readonly="readonly"></td>
</tr>
<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Invoice Date</p></font></td>
<td><input type="text" name="invoice_date" id="invoice_date" size=20 value="<?php echo $myrow[14] ?>" style=";background-color:#DDDDDD;" readonly="readonly"></td>

<td><span class="labeltext"><p align="left">Test Reports & COC</p></font></td>
<td><input type="text" name="test_report" size=20 value="<?php echo $myrow[16] ?>" style=";background-color:#DDDDDD;" readonly="readonly"></td>
</tr>
<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Received Date</p></font></td>
<td><input type="text" name="recieved_date" id="recieved_date" size=20 value="<?php echo $myrow[15] ?>" style=";background-color:#DDDDDD;" readonly="readonly"></td>
<td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Batch No.</p></font></td>
<td><input type="text" name="batch_num" size=20 value="<?php echo $myrow[17] ?>" style=";background-color:#DDDDDD;" readonly="readonly"></td>
</tr>
<?}
else
{?>
<tr bgcolor="#FFFFFF">
<td  width=25%><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Supplier</p></font></td>
<td><span class="tabletext"><input type="text" name="vendor"
style=";background-color:#DDDDDD;"
readonly="readonly" size=20 value="<?php echo "$myrow[23]";?>"></td>
<input type="hidden" name="vendrecnum" id="vendrecnum" value="<?php echo "$myrow[24]";?>">
</td>
<td><span class="labeltext"><p align="left">Raw Material Type</p></font></td>
<td><input type="text" name="raw_mat_type" id="raw_mat_type" size=20 style=";background-color:#DDDDDD;"
readonly="readonly" value="<?php echo $myrow[4] ?>">
</td>
</tr>
<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">Raw Material Spec</p></font></td>
<td><input type="text" name="raw_mat_spec" id="raw_mat_spec" size=20 style=";background-color:#DDDDDD;"
readonly="readonly" value="<?php echo $myrow[5] ?>"></td>

<td><span class="labeltext"><p align="left">Raw Material Code</p></font></td>
<td><input type="text" name="raw_mat_code" size=19 style=";background-color:#DDDDDD;"
readonly="readonly" value="<?php echo $myrow[12] ?>"></td>
</tr>
<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">MGP/DC No.</p></font></td>
<td><input type="text" name="mgp_num" size=20 style=";background-color:#DDDDDD;"
readonly="readonly" value="<?php echo $myrow[18] ?>"></td>
<td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Invoice No.</p></font></td>
<td><input type="text" name="invoice_num" style=";background-color:#DDDDDD;"
readonly="readonly" size=20 value="<?php echo $myrow[13] ?>"></td>
</tr>
<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Invoice Date</p></font></td>
<td><input type="text" name="invoice_date" id="invoice_date" size=20 value="<?php echo $myrow[14] ?>" style=";background-color:#DDDDDD;" readonly="readonly">
</td>

<td><span class="labeltext"><p align="left">Test Reports & COC</p></font></td>
<td><input type="text" name="test_report" size=20 style=";background-color:#DDDDDD;"
readonly="readonly" value="<?php echo $myrow[16] ?>"></td>
</tr>
<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Received Date</p></font></td>
<td><input type="text" name="recieved_date" id="recieved_date" size=20 value="<?php echo $myrow[15] ?>" style=";background-color:#DDDDDD;" readonly="readonly">
</td>
<td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Batch No.</p></font></td>
<td><input type="text" name="batch_num" style=";background-color:#DDDDDD;"
readonly="readonly" size=20 value="<?php echo $myrow[17] ?>"></td>
</tr>
<?}?>

<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">Remarks</p></font></td>
<td colspan=1><textarea style=";background-color:#DDDDDD;"
 name="remarks" size=20><?php echo $myrow[33] ?></textarea></td>        
<td><span class="labeltext"><p align="left">COC Ref#</p></font></td>
<td><input type="text" style=";background-color:#DDDDDD;"
readonly="readonly" name="coc_refnum" size=20 value="<?php echo $myrow[26] ?>"></td>

</tr>
<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>RM by CIM</p></font></td>
<td><input type="text" name="rmbycim" style=";background-color:#DDDDDD;"
readonly="readonly" id="rmbycim" size=20 value="<?php echo $myrow[28] ?>"></td>
<td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>RM by Cust</p></font></td>
<td><input type="text" name="rmbycust" style=";background-color:#DDDDDD;"
readonly="readonly" id="rmbycust" size=20 value="<?php echo $myrow[29] ?>"></td>
</tr>
<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>CIM PO Num</p></font></td>
<td><input type="text" name="cimponum" style=";background-color:#DDDDDD;"
readonly="readonly" id="cimponum" size=20 value="<?php echo $myrow[30] ?>"></td>
<td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>RMPO Line#</p></font></td>
<td><input type="text" name="rmpoline_num" style=";background-color:#DDDDDD;"
readonly="readonly" id="rmpoline_num" size=4 value="<?php echo $myrow[49] ?>">
</tr>
<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">GRN Type</p></font>
<td><span class="tabletext"><input type="text" name="grntype" id="grntype"
style="background-color:#DDDDDD;" readonly="readonly"  value="<?php echo $myrow[35] ?>">
<!--
<span class="tabletext"><select name="grntype1" size="1" width="20" onchange="onSelectGRNType()">
<option selected>Please Specify
<option value="Regular">Regular
<option value="Rework">Rework
<option value="Semifinish">Semifinish
<option value="Subcontracted">Subcontracted
<option value="Consummables">Consummables
<option value="Quarantined">Quarantined
</select>-->
</td>
<input type="hidden" name="prevgrntype" id="prevgrntype" value="<?php echo $myrow[35] ?>">
<td><span class="labeltext"><p align="left">QA NC Ref#</p></font></td>
<td><input type="text" name="nc_refnum" id="nc_refnum" style=";background-color:#DDDDDD;"
readonly="readonly" size=20 value="<?php echo $myrow[34] ?>"></td>
</tr>

<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">RM Checked By</p></font></td>
<td><input type="text" name="rmempcode" style=";background-color:#DDDDDD;"
readonly="readonly" id ="rmempcode" size=20 value="<?php echo $myrow[42] ?>"></td>
<td><span class="labeltext"><p align="left">RM Checked Date</p></font></td>
<td><input type="text" name="rmcheckdate" id="rmcheckdate" size=20
style=";background-color:#DDDDDD;" readonly="readonly" value="<?php echo $myrow[43] ?>">
</td>
</tr>
<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">Unit RM Cost</p></td>
<td><input type="text" id="rm_cost"style=";background-color:#DDDDDD;"
readonly="readonly"  name="rm_cost" size=20 value="<?php echo $myrow[46] ?>">
<!--
<span class="tabletext">
<select name="currency" id="currency"  width=2>
<?
$currency=array('$','Rs');
for($j=0;$j<count($currency);$j++){

if($currency[$j] == $myrow[47]){?>
<option selected value="<? echo $currency[$j]?>"><?echo $currency[$j]; ?>
</option>
<?}
else{?>
<option value="<? echo $currency[$j]?>"><?echo $currency[$j]; ?>
</option>
<?}
}?>
-->
</td>
<td><span class="labeltext"><p align="left">PO PRN</p></font></td>
<td><input type="text" id="pocrn" name="pocrn" size=20 value="<?=$_REQUEST['pocrn']?>" style=";background-color:#DDDDDD;" readonly = 'readonly'>
</td>
</tr>
<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">GRN Checked By</p></font></td>
<td><input type="text" name="grnempcode" id ="grnempcode" style=";background-color:#DDDDDD;"
readonly="readonly" size=20 value="<?php echo $myrow[44] ?>"></td>
<td><span class="labeltext"><p align="left">GRN Checked Date</p></font></td>
<td><input type="text" name="grncheckdate" id="grncheckdate" size=20
style=";background-color:#DDDDDD;" readonly="readonly" value="<?php echo $myrow[45] ?>">
</td>
</tr>
<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">Quarantine Remarks</p></font></td>
<?php
if ($myrow[35] == 'Quarantined' && $myrow[40] != '')
{
?>
<td><textarea style=";background-color:#DDDDDD;" readonly="readonly"
name="quarremarks" id ="quarremarks" size=20><?php echo $myrow[40] ?></textarea></td>
<td><span class="labeltext"><p align="left">Conversion(to Regular) Date</p></font></td>
<td><input type="text" name="conversion_date" id="conversion_date" size=20 value="<?php echo $myrow[39]  ?>"
style=";background-color:#DDDDDD;" readonly="readonly">
</td>
<?php
}
else
{
?>
<td><textarea name="quarremarks" style=";background-color:#DDDDDD;" readonly="readonly" id ="quarremarks" size=20><?php echo $myrow[40] ?></textarea></td>
<td><span class="labeltext"><p align="left">Conversion(to Regular) Date</p></font></td>
<td><input type="text" name="conversion_date" id="conversion_date" size=20 value="<?php echo $myrow[39]  ?>"
style=";background-color:#DDDDDD;" readonly="readonly">


</td>
<?php
}
?>
</tr>

<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">Quarantined Date</p></font></td>
<td><input type="text" name="Quarantined_date" id="Quarantined_date" size=20 value="<?php echo $myrow[41] ?>" style="background-color:#DDDDDD;" readonly="readonly">
<!--
<?php if($myrow[35] != "Quarantined")
{
echo "<img src=\"images/bu-getdateicon.gif\" id='image' alt=\"Get BookDate\"          onClick=\"GetDate('Quarantined_date')\">";
}
?>-->
</td>
<?
if($grnrecnum != '')
{?>
	<td width=20%><span class="labeltext"><p align="left">Status</p></font></td>
<td ><span class="tabletext"><input type="text" name="status" id="status" style="background-color:#DDDDDD;" readonly="readonly"  value="Pending">
<input type="hidden" name="validate_flag" id="validate_flag" value="1"></td>
<?}
else
{?>
<td width=20%><span class="labeltext"><p align="left">Status</p></font></td>
<td ><span class="tabletext"><input type="text" name="status" id="status" style="background-color:#DDDDDD;" readonly="readonly"  value="<?php echo $myrow[37] ?>">
<!--
<span class="tabletext"><select name="grnstat" size="1" width="20" onchange="onSelectStatus()">
<option selected>Please Specify
<option value>Open
<option value>Closed
<option value>Cancelled
<option value>All
</select>-->
<input type="hidden" name="validate_flag" id="validate_flag" value=""></td>
<?}?>
</tr>

<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">WO Ref.</p></font></td>
<td><input type="text" id="wo_ref" name="wo_ref" size=20 value="" style=";background-color:#DDDDDD;">
</td>
</td>
<td colspan=2></td>
</tr>
<!-- 
<tr bgcolor="#FFFFFF"><td colspan=5><a href="javascript:addRow('myTable',document.forms[0].index.value)"><img name="Image7" border="0" src="images/bu-addrow.gif"></a></td></tr>
-->
<input type="hidden" name="action" value="new">
<?php
//echo "quotetype:$quotetype";
//$wotype="test2";
// $ctrls=$newpage->createjs4quote("Quote",$quotetype) ;
//$ctrls=$newpage->createctrls("Quote",$quotetype) ;
//echo "$ctrls";
?>
<tr bgcolor="#DDDEDD">
<td colspan=4><span class="heading"><center><b>GRN Line Items</b></center></td>
</tr>


<tr bgcolor="#FFFFFF">
<table id="myTable" width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
<tr bgcolor="#FFFFFF">
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Line</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Amend Line</center></b></td>
<!--<td bgcolor="#EEEFEE"><span class="heading"><b><center>Layout Ref#</center></b></td>-->
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Partnum</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Part Desc</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Batch</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>UOM</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Exp Date<br>(yyyy-mm-dd)</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>No of<br>Pieces</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Dim1(L)</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Dim2(W/ID)</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Dim3(T/OD)</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Qty</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Qty/Billet</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Qty Rej</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>QTM</center></b></td>
<!--<td bgcolor="#EEEFEE"><span class="heading"><b><center>Amend Stat</center></b></td> -->
</tr>
<?php
$i=1;

while($i<2)
{
	if($grnrecnum != '')
	{
	    while ($mygrnli = mysql_fetch_row($grnli))
        {
			printf('<tr bgcolor="#FFFFFF">');
			$line_num="line_num" . $i;
			$partnum="partnum" . $i;
			$qty="qty" . $i;
			$dim1="dim1" . $i;
			$dim2="dim2" . $i;
			$dim3="dim3" . $i;
			$qty_rej="qty_rej" . $i;
			$qty_to_make="qty_to_make" . $i;
			$qty4billet="qty4billet".$i;
			$partdesc="partdesc" . $i;
			$batchnum="batchnum" . $i;
			$uom="uom" . $i;
			$expdate="expdate" . $i;
			$rmpoline_num="rmpoline_num" . $i;
			//$layout_ref="layout_ref" . $i;
			$amend_line_num="amend_line_num" . $i;
			$amendstatus="amendstatus" . $i;
			$noofpieces="noofpieces" . $i;
			if($myrow4bill[0] != '' && $myrow4bill[0] != 0)
				$qty_value=intval($qtm_req/$myrow4bill[0]);	
			else
				$qty_value=0;

			$d1=$mygrnli[2];
			$d2=$mygrnli[3];
			$d3=$mygrnli[4];
			$um=$mygrnli[14];
	    }
		echo "<td><center><span class=\"tabletext\"><input type=\"text\" id=\"$line_num\"  name=\"$line_num\" value=\"$i\" size=\"2%\"><center></td>";
		echo "<td><center><span class=\"tabletext\"><input type=\"text\" id=\"$amend_line_num\"  name=\"$amend_line_num\" value=\"\" size=\"2%\"><center></td>";

		/*echo "<td><center><span class=\"tabletext\"><input type=\"text\" id=\"$layout_ref\"  name=\"$layout_ref\" value=\"\" size=\"8%\" onkeyup=\"javascript:swap_removereadonly(this);\"  ><center></td>";*/

		echo "<td><center><input type=\"text\" id=\"$partnum\" name=\"$partnum\" size=\"6%\" value=\"\"><center></td>";
		echo "<td><center><input type=\"text\" id=\"$partdesc\" name=\"$partdesc\" size=\"25%\" value=\"\"><center></td>";
		echo "<td><center><input type=\"text\" id=\"$batchnum\" name=\"$batchnum\" size=\"6%\" value=\"\"><center></td>";
		echo "<td><center><input type=\"text\" id=\"$uom\" name=\"$uom\" size=\"5%\" value=\"$um\"  style=\"background-color:#DDDDDD\" readonly=\"readonly\"  onkeyup=\"javascript:getuom(this);\"><center></td>";
		echo "<td><center><input type=\"text\" id=\"$expdate\" name=\"$expdate\" size=\"10%\" value=\"\"><center></td>";
		echo "<td><center><input type=\"text\" id=\"$noofpieces\" name=\"$noofpieces\" size=\"3%\" value=\"\" onkeyup=\"javascript:getQty(this);\"><center></td>";
		echo "<td><center><input type=\"text\" id=\"$dim1\" name=\"$dim1\" size=\"5%\" 
		value=\"$d1\" onkeyup=\"javascript:getQty(this);\"  style=\"background-color:#DDDDDD\" readonly=\"readonly\"><center></td>";
		echo "<td><center><input type=\"text\" id=\"$dim2\" name=\"$dim2\" size=\"5%\" value=\"$d2\"  style=\"background-color:#DDDDDD\" readonly=\"readonly\"><center></td>";
		echo "<td><center><input type=\"text\" id=\"$dim3\" name=\"$dim3\" size=\"5%\" value=\"$d3\"  style=\"background-color:#DDDDDD\" readonly=\"readonly\"><center></td>";
/*
        if($crn == $to_crn)
		{
		echo "<td><center><input type=\"text\" id=\"$qty\" name=\"$qty\" size=\"3%\" value=\"$qty_value\" onkeyup=\"javascript:getqtm_value($i);\"  style=\"background-color:#DDDDDD\" readonly=\"readonly\"><center></td>";
		}
		else
		{
		echo "<td><center><input type=\"text\" id=\"$qty\" name=\"$qty\" size=\"3%\" value=\"$qty_value\" onkeyup=\"javascript:getqtm_value($i);\"><center></td>";
		}
*/
		echo "<td><center><input type=\"text\" id=\"$qty\" name=\"$qty\" size=\"3%\" value=\"$qty_value\" onkeyup=\"javascript:getqtm_value($i);\"><center></td>";

		echo "<td><center><input type=\"text\" id=\"$qty4billet\" name=\"$qty4billet\"  size=\"5%\" value=\"$myrow4bill[0]\" 
                       onkeyup=\"javascript:getqtm_value($i);\" style=\"background-color:#DDDDDD\" readonly=\"readonly\"><center></td>";
		echo "<td><center><input type=\"text\" id=\"$qty_rej\" name=\"$qty_rej\"  size=\"5%\" value=\"\"><center></td>";
/*
        if($crn == $to_crn)
		{
		echo "<td><center><input type=\"text\" id=\"$qty_to_make\" name=\"$qty_to_make\" size=\"5%\" value=\"$qtm_req\" onblur=\"javascript:get_total(this);\" style=\"background-color:#DDDDDD\" readonly=\"readonly\" ><center></td>";
		}
		else
		{
		echo "<td><center><input type=\"text\" id=\"$qty_to_make\" name=\"$qty_to_make\" size=\"5%\" value=\"$qtm_req\" onblur=\"javascript:get_total(this);\"  ><center></td>";
		}
*/
		echo "<td><center><input type=\"text\" id=\"$qty_to_make\" name=\"$qty_to_make\" size=\"5%\" value=\"$qtm_req\" onblur=\"javascript:get_total(this);\" style=\"background-color:#DDDDDD\" readonly=\"readonly\" ><center></td>";
		printf('</tr>');
		$i++;   
	}
	else
	{		
		 printf('<tr bgcolor="#FFFFFF">');
	   $line_num="line_num" . $i;
	   $amend_line_num="amend_line_num" . $i;
	   $partnum="partnum" . $i;
       $qty="qty" . $i;
       $dim1="dim1" . $i;
       $dim2="dim2" . $i;
       $dim3="dim3" . $i;
       $qty_rej="qty_rej" . $i;
       $qty_to_make="qty_to_make" . $i;
       $qty4billet="qty4billet".$i;
       $partdesc="partdesc" . $i;
	   $batchnum="batchnum" . $i;
	   $uom="uom" . $i;
	   $expdate="expdate" . $i;
	   $rmpoline_num="rmpoline_num" . $i;
	   $layout_ref="layout_ref" . $i;
	   $amendstatus="amendstatus" . $i;
	   $noofpieces="noofpieces" . $i;

       echo "<td><center><span class=\"tabletext\"><input type=\"text\" id=\"$line_num\"  name=\"$line_num\" value=\"\" size=\"2%\"><center></td>";
       echo "<td><center><span class=\"tabletext\"><input type=\"text\" id=\"$amend_line_num\"  name=\"$amend_line_num\" value=\"\" size=\"2%\" onblur=\"javascript:getstat(this,$i);\"><center></td>";

       /*echo "<td><center><span class=\"tabletext\"><input type=\"text\" id=\"$layout_ref\"  name=\"$layout_ref\" value=\"\" size=\"8%\"><center></td>";
	   */
       echo "<td><center><input type=\"text\" id=\"$partnum\" name=\"$partnum\" size=\"6%\" value=\"\"><center></td>";
       echo "<td><center><input type=\"text\" id=\"$partdesc\" name=\"$partdesc\" size=\"25%\" value=\"\"><center></td>";
       echo "<td><center><input type=\"text\" id=\"$batchnum\" name=\"$batchnum\" size=\"6%\" value=\"\"><center></td>";
       echo "<td><center><input type=\"text\" id=\"$uom\" name=\"$uom\" size=\"5%\" value=\"\" onkeyup=\"javascript:getuom(this);\"><center></td>";
       echo "<td><center><input type=\"text\" id=\"$expdate\" name=\"$expdate\" size=\"10%\" value=\"\"><center></td>";
       echo "<td><center><input type=\"text\" id=\"$noofpieces\" name=\"$noofpieces\" size=\"3%\" value=\"\" onblur=\"javascript:getQty(this);\"><center></td>";
       echo "<td><center><input type=\"text\" id=\"$dim1\" name=\"$dim1\" size=\"5%\" value=\"\" onblur=\"javascript:getQty(this);\"><center></td>";
       echo "<td><center><input type=\"text\" id=\"$dim2\" name=\"$dim2\" size=\"5%\" value=\"\"><center></td>";
       echo "<td><center><input type=\"text\" id=\"$dim3\" name=\"$dim3\" size=\"5%\" value=\"\"><center></td>";
       echo "<td><center><input type=\"text\" id=\"$qty\" name=\"$qty\" size=\"3%\" value=\"\"><center></td>";
       echo "<td><center><input type=\"text\" id=\"$qty4billet\" name=\"$qty4billet\"  size=\"5%\" value=\"\"><center></td>";
       echo "<td><center><input type=\"text\" id=\"$qty_rej\" name=\"$qty_rej\"  size=\"5%\" value=\"\"><center></td>";
       echo "<td><center><input type=\"text\" id=\"$qty_to_make\" name=\"$qty_to_make\" size=\"5%\" value=\"\" onblur=\"javascript:get_total(this);\"><center></td>";  
       printf('</tr>');
	   $i++;
	  }
}
echo "<input type=\"hidden\" name=\"index\" id=\"index\" value=$i>";
?>

<tr bgcolor="#FFFFFF">
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
<tr bgcolor="#FFFFFF" width=100%>
<td width='95%' align=right class=labeltext>Total Qty</td>
<td align=right><input type=text name=total_qty_make id=total_qty_make size=5% value='<?=$qtm_req?>' style=";background-color:#DDDDDD;" readonly="readonly"></td>
</tr>
</table>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
<tr bgcolor="#DDDEDD">
<td align="center" colspan=8><span class="heading"><b>Validation of Certificate of Compliance by RM Supplier</b></span></td>
</tr>
<tr bgcolor="#FFFFFF">
<td  width=30%> <span class="heading"><b><left>Standard for Verification</left></b></td>
<td width=70% colspan=7> <span class="heading"><b><left></left></b></td>
</tr>
<tr bgcolor="#FFFFFF">
<td width=35%><span class="tabletext"><p align="left">Description</p></td>

<td width=5%> <span class="labeltext"><p align="left">Yes</p></td>
<td width=5%> <span class="labeltext"><p align="left">No</p></td>
<td width=5%> <span class="labeltext"><p align="left">N/A</p></td>
<td width=35%> <span class="labeltext"><p align="left">Description</p></td>
<td width=5%> <span class="labeltext"><p align="left">Yes</p></td>
<td width=5%> <span class="labeltext"><p align="left">No</p></td>
<td width=5%> <span class="labeltext"><p align="left">N/A</p></td>
</tr>
<tr bgcolor="#FFFFFF">
<td width=35%><span class="tabletext"><p align="left">Dimensional Inspection</p></td>
<td width=5%> <b><input name="dimensional" type="radio" value="1" <?php if ($dimenssion==1){?>checked="checked" <?php }?>></b></td>
<td width=5%> <b><input name="dimensional" type="radio" value="2" <?php if ($dimenssion==2){?>checked="checked" <?php }?>></b></td>
<td width=5%> <b><input name="dimensional" type="radio" value="3" <?php if ($dimenssion==3){?>checked="checked" <?php }?>></b></td>
<td width=35%> <span class="tabletext"><p align="left">NDT Procedures correct,where applicable</p></td>
<td width=5%> <b><input name="ndt" type="radio" value="1" <?php if ($ndt==1){?>checked="checked" <?php }?>></b></td>
<td width=5%> <b><input name="ndt" type="radio" value="2" <?php if ($ndt==2){?>checked="checked" <?php }?>></b></td>
<td width=5%> <b><input name="ndt" type="radio" value="3" <?php if ($ndt==3){?>checked="checked" <?php }?>></b></td>
</tr>
<tr bgcolor="#FFFFFF">
<td width=35%><span class="tabletext"><p align="left">Visual Examination for Omission of Damages</p></td>
<td width=5%> <b><input name="visual" type="radio" value="1" <?php if ($visual==1){?>checked="checked" <?php }?>></b></td>
<td width=5%> <b><input name="visual" type="radio" value="2" <?php if ($visual==2){?>checked="checked" <?php }?> ></b></td>
<td width=5%> <b><input name="visual" type="radio" value="3" <?php if ($visual==3){?>checked="checked" <?php }?>></b></td>
<td width=35%> <span class="tabletext"><p align="left">Is Grain Flow Mentioned</p></td>
<td width=5%> <b><input name="grain" type="radio" value="1" <?php if ($grain==1){?>checked="checked" <?php }?>></b></td>
<td width=5%> <b><input name="grain" type="radio" value="2" <?php if ($grain==2){?>checked="checked" <?php }?>></b></td>
<td width=5%> <b><input name="grain" type="radio" value="3" <?php if ($grain==3){?>checked="checked" <?php }?>></b></td>
</tr>
<tr bgcolor="#FFFFFF">
<td width=30%><span class="tabletext"><p align="left">Mechanical Properties verified against Standered</p></td>
<td width=5%> <b><input name="mechanical" type="radio" value="1" <?php if ($mech==1){?>checked="checked" <?php }?>></b></td>
<td width=5%> <b><input name="mechanical" type="radio" value="2" <?php if ($mech==2){?>checked="checked" <?php }?> ></b></td>
<td width=5%> <b><input name="mechanical" type="radio" value="3" <?php if ($mech==3){?>checked="checked" <?php }?>></b></td>
<td width=30%> <span class="tabletext"><p align="left">Conductivity</p></td>
<td width=5%> <b><input name="conductivity" type="radio" value="1" <?php if ($conductivity==1){?>checked="checked" <?php }?>></b></td>
<td width=5%> <b><input name="conductivity" type="radio" value="2" <?php if ($conductivity==2){?>checked="checked" <?php }?>></b></td>
<td width=5%> <b><input name="conductivity" type="radio" value="3" <?php if ($conductivity==3){?>checked="checked" <?php }?>></b></td>
</tr>
<tr bgcolor="#FFFFFF">
<td width=30%><span class="tabletext"><p align="left">Chemical Properties verified against Standered</p></td>
<td width=5%> <b><input name="chemical" type="radio" value="1"  <?php if ($chemical==1){?>checked="checked" <?php }?>></b></td>
<td width=5%> <b><input name="chemical" type="radio" value="2" <?php if ($chemical==2){?>checked="checked" <?php }?>></b></td>
<td width=5%> <b><input name="chemical" type="radio" value="3" <?php if ($chemical==3){?>checked="checked" <?php }?>></b></td>
<td width=30%> <span class="tabletext"><p align="left">Hardness</p></td>
<td width=5%> <b><input name="hardness" type="radio" value="1" <?php if ($hardness==1){?>checked="checked" <?php }?>></b></td>
<td width=5%> <b><input name="hardness" type="radio" value="2" <?php if ($hardness==2){?>checked="checked" <?php }?>></b></td>
<td width=5%> <b><input name="hardness" type="radio" value="3" <?php if ($hardness==3){?>checked="checked" <?php }?>></b></td>
</tr>
<tr bgcolor="#FFFFFF">
<td width=30%><span class="tabletext"><p align="left">Quantity received agrees with Certification</p></td>
<td width=5%> <b><input name="quantity" type="radio" value="1"  <?php if ($quantity==1){?>checked="checked" <?php }?>></b></td>
<td width=5%> <b><input name="quantity" type="radio" value="2"  <?php if ($quantity==2){?>checked="checked" <?php }?>></b></td>
<td width=5%> <b><input name="quantity" type="radio" value="3"  <?php if ($quantity==3){?>checked="checked" <?php }?>></b></td>
<td width=30%> <span class="tabletext"><p align="left">Temper</p></td>
<td width=5%> <b><input name="temper" type="radio" value="1" <?php if ($temper==1){?>checked="checked" <?php }?>></b></td>
<td width=5%> <b><input name="temper" type="radio" value="2"  <?php if ($temper==2){?>checked="checked" <?php }?>></b></td>
<td width=5%> <b><input name="temper" type="radio" value="3"  <?php if ($temper==3){?>checked="checked" <?php }?>></b></td>
</tr>
<tr bgcolor="#FFFFFF">
<td width=30%><span class="tabletext"><p align="left">Serialization Requirements?</p></td>
<td width=10% colspan="2"><span class="tabletext"><p align="left">Customer Serialization</p></td>

<td  width="%"><span class="tabletext">Yes<input name="cus" type="radio" value="1" <?php if ($cus==1){?>checked="checked" <?php }?> >
<span class="tabletext">No &nbsp;<input name="cus" type="radio" value="2" <?php if ($cus==2){?>checked="checked" <?php }?>></td>

<td width=30%><span class="tabletext"><p align="left">CIM Serialization
<span class="tabletext">&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Yes<input name="cus" type="radio" value="3" <?php if ($cus==3){?>checked="checked" <?php }?>>
<span class="tabletext">No<input name="cim" type="hidden" value="2" checked="checked">
<input name="cus" type="radio" value="4" <?php if ($cus==4){?>checked="checked" <?php }?> ></p></td>
<td width=8% colspan="2"> <span class="tabletext"><p align="left">Serialization not Required</p></td>
<td width=3%> <b><input name="cus" type="radio" value="5" <?php if ($cus==5){?>checked="checked" <?php }?>></b></td>
</tr><input name="not" type="hidden" value="5" >
<tr bgcolor="#FFFFFF">
<td width=30%><span class="tabletext"><p align="left">If yes Mention Serial No. </p></td>
<td width=5% colspan=2> <span class="tabletext"><p align="left">From </p></td>
<td width=5%> <input name="frmserial" type="text" value="<?php echo $from?>"></td>
<td width=5% colspan=4> <span class="tabletext"><p align="left">To     <input name="toserial" type="text" value="<?php echo $to?>"></p></b></td>


</tr>
<tr bgcolor="#DDDEDD">
<td align="center" colspan=8><span class="heading"><b>Non-Conformance</b></span></td>

</tr>
<tr bgcolor="#FFFFFF">
<td width=30%><span class="labeltext"><p align="left">Are any Non Conformance Observed</p></td>
<td width=6%> <span class="labeltext"><b>Yes</b></span>
<input name="conformance" type="radio" value="1"  <?php if ($noncon==1){?>checked="checked" <?php }?>></td>
<td width=5% colspan=2> <b><span class="labeltext"><b>No</b></span>

<input name="conformance" type="radio" value="2"  <?php if ($noncon==2){?>checked="checked" <?php }?> ></b></td>

<td width=5% colspan=4 align=top><b><span class="labeltext">NCR Ref No.</b></span> <input name="ncref" id="ncref" type="text" value="<?php echo $ncref?>"><br>
<span class="labeltext">NCR Date</b></span>
&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="ncrdate" id="ncrdate" size=20 value="<?php echo $ncdate?>" style="background-color:#DDDDDD;" readonly="readonly">
<img src="images/bu-getdateicon.gif" alt="Get BookDate" onClick="GetDate('ncrdate')"></td>
</tr>
<tr bgcolor="#FFFFFF">
<td width=30% colspan=4><span class="labeltext"><p align="left">Is the Observed Non-Conformance communicated to the respective authorities</p></td>
<td colspan=6> <b><span class="labeltext">Yes<input name="comm" type="radio" value="1"<?php if ($comm==1){?>checked="checked" <?php }?> ></b>
<span class="labeltext">No <b><input name="comm" type="radio" value="2" <?php if ($comm==2){?>checked="checked" <?php }?> ></b></td>
</tr>
<tr bgcolor="#FFFFFF">
<td width=30%><span class="labeltext"><p align="left">Details of Communication</p></td>
<td width=5% colspan=12><textarea name="dcomm" cols="70" rows=""><?php echo $dcomm?></textarea></td>

</tr>
<tr bgcolor="#FFFFFF">
<td width=30%><span class="labeltext"><p align="left">Additional Notes/Remarks</p></td>
<td width=5% colspan=7><textarea name="anotes" cols="70" rows=""><?php echo $remarks?></textarea></td>

</tr>
<tr bgcolor="#FFFFFF">
<td width=30%><span class="labeltext"><p align="left">Authorised Signatory With Date<br>
(Store Department)</p></td>
<td width=5% colspan=8><span class="labeltext"><b>Yes</b><input name="approval" type="radio" value="<?php echo $approved; ?>" >
<span class="labeltext"><b>No</b><input name="approval" type="radio" value=" "></td>
</tr>

</td>
</tr>

</table>
</table>
</td>
<td width="6"><img src="images/spacer.gif " width="6"></td>
</tr>
<tr bgcolor="DEDFDE">
<td width="6"><img src="images/box-left-bottom.gif"></td>
<td><img src="images/spacer.gif " height="6"></td>
<td width="6"><img src="images/box-right-bottom.gif"></td>
</tr>
</table>
<img  src="images/validate.gif" alt="Get validate" onClick="validate_grn()">
<input type="hidden" name="pagename" id="pagename" value="grn_swap">
<input type="hidden" name="department" id="department" value="<?php echo $dept ?>">
<input type="hidden" name="parent_grnnum" id="parent_grnnum" value="<?php echo $grnnum ?>">
<input type="hidden" name="grnrecnum" id="grnrecnum" value="<?php echo $grnrecnum ?>">
 <input type="hidden" name="userid_app_cad" id="userid_app_cad" value="">
<?
$result=$newgrn->getrm_qty_perbill($crn);
$myrow_rm=mysql_fetch_row($result);

$result1=$newgrn->getrm_qty_perbill($to_crn);
$myrow_rm1=mysql_fetch_row($result1);
?>
<input type="hidden" name="rm_qty_perbill" id="rm_qty_perbill" value='<?=$myrow_rm[0]?>'>
<input type="hidden" name="rm_length" id="rm_length" value='<?=$myrow_rm[1]?>'>
<input type="hidden" name="rm_dia" id="rm_dia" value='<?=$myrow_rm[2]?>'>
<input type="hidden" name="rm_uom" id="rm_uom" value='<?=$myrow_rm[3]?>'>
<input type="hidden" name="rm_width" id="rm_width" value='<?=$myrow_rm[4]?>'>
<input type="hidden" name="rm_thickness" id="rm_thickness" value='<?=$myrow_rm[5]?>'>
<input type="hidden" name="rm_type" id="rm_type" value='<?=$myrow_rm[6]?>'>
<input type="hidden" name="rm_spec" id="rm_spec" value='<?=$myrow_rm[7]?>'>

<input type="hidden" name="rm_qty_perbill_to" id="rm_qty_perbill_to" value='<?=$myrow_rm1[0]?>'>
<input type="hidden" name="rm_length_to" id="rm_length_to" value='<?=$myrow_rm1[1]?>'>
<input type="hidden" name="rm_dia_to" id="rm_dia_to" value='<?=$myrow_rm1[2]?>'>
<input type="hidden" name="rm_uom_to" id="rm_uom_to" value='<?=$myrow_rm1[3]?>'>
<input type="hidden" name="rm_width_to" id="rm_width_to" value='<?=$myrow_rm1[4]?>'>
<input type="hidden" name="rm_thickness_to" id="rm_thickness_to" value='<?=$myrow_rm1[5]?>'>
<input type="hidden" name="rm_type_to" id="rm_type_to" value='<?=$myrow_rm1[6]?>'>
<input type="hidden" name="rm_spec_to" id="rm_spec_to" value='<?=$myrow_rm1[7]?>'>

<input type="hidden" name="qtm_bal" id="qtm_bal" value='<?=$bal?>'>
<input type="hidden" name="layout_db" id="layout_db" value='<?=$layout_db?>'>


<input type="submit"
style="color=#0066CC;background-color:#DDDDDD;width=130;"
value="Submit" name="submit" onClick="javascript: return check_req_fields()">
<INPUT TYPE="RESET"
style="color=#0066CC;background-color:#DDDDDD;width=130;"
VALUE="Reset" onClick="javascript: putfocus()">
</FORM>
</table>
</body>
</html>
