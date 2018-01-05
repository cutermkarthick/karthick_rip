<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = June 20, 2004                =
// Filename: dnEntry.php                       =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 WMS                          =
// Allows entry of Dispatchs                   =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
header ( "Location: login.php" );

}
$userid = $_SESSION['user'];

$_SESSION['pagename'] = 'dnEntry';
$page = "Post Process: D Note";
//////session_register('pagename');
$dept=$_SESSION['department'];
// First include the class definition
include('classes/dnClass.php');
include('classes/displayClass.php');
$newDn = new dn;
$newdisp = new display;
?>

<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/dn.js"></script>

<html>
<head>
<script language="javascript" type="text/javascript">
function Disable(form) {
if (document.getElementById) {
for (var i = 0; i < form.length; i++) {
if (form.elements[i].type.toLowerCase() == "submit")
form.elements[i].disabled = true;
}
}
return true;
}
</script>
<title>New Delivery</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">
<form action='dnProcess.php' method='GET' enctype='multipart/form-data' onSubmit='Disable(this);'>
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
<table width=100% border=0 cellpadding=0 cellspacing=0>
<tr><td></td></tr>
<tr>
<td>
<?php
$newdisp->dispLinks('');
?>
<table width=100% border=0 cellpadding=0 cellspacing=0>
<tr bgcolor="DEDFDE">
<td width="6"><img src="images/spacer.gif " width="6"></td> -->
<!-- <td bgcolor="#FFFFFF">
<table width=100% border=0 cellpadding=6 cellspacing=0>
<!-- <tr><td> -->
<table width=100% border=0>
<tr>
<td><span class="pageheading"><b>New Delivery Note</b></td>
</tr>
</table>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
<tr bgcolor="#FFFFFF">
<tr bgcolor="#EEEFEE"><td colspan=4><span class="heading"><center><b>General Information</b></center></td>
</tr>  </table>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1">
<tr bgcolor="#FFFFFF">
<?php
$newDn = new dn;
$result = $newDn->getVendors();
?>
<td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Sent for treatment To</p></font></td>
<td>
<select name='treat_to' id='treat_to'>
<option value='select'>Select</option>
<?php
while ($myrow = mysql_fetch_row($result)){
if($myrow[1]==$_REQUEST['treat_to']){
?>
<option selected value="<? echo $myrow[1]?>">
<?echo $myrow[1]; ?>
</option>
<?
}
else{
?>
<option value="<? echo $myrow[1]?>">
<?echo $myrow[1]; ?> </option>
<?php
}
}
?>
</select>
</td>

<td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>After treatment deliver To</p></font></td>
<td>
<select name='treat_deliver' id='treat_deliver'>
<option value='select'>Select</option>
<?php
$result1 = $newDn->getVendors();
while ($myrow1 = mysql_fetch_row($result1)){
if($myrow1[1]==$_REQUEST['treat_deliver']){
?>
<option selected value="<? echo $myrow1[1]?>">
<?echo $myrow1[1]; ?>
</option>
<?
}
else{
?>
<option value="<? echo $myrow1[1]?>">
<?echo $myrow1[1]; ?> </option>
<?php
}
}
?>
</select>
</td>
</tr>

<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>PRN</p></font>
</td>
<td><input type="text" name="crn" id="crn"  size=20 value=""  style=";background-color:#DDDDDD;"
readonly="readonly"><img src="images/get.gif" alt="Get" onclick="Getwocrn()"></td>
<td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Deliver Date</p></font></td>
<td><input type="text" id="deliver_date" name="deliver_date"
style=";background-color:#DDDDDD;"
readonly="readonly" size=12 value="">
<img src="images/bu-getdateicon.gif" alt="Get Date"  onclick="GetDate('deliver_date')"></td>
</tr>
<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>WO #</p></font>
<td><input type="text" id="wonum" name="wonum" 
style=";background-color:#DDDDDD;"
readonly="readonly" size=12 value="">
<img src="images/bu_getwo.gif" alt="Get WO" onclick="Getwo_dn()"></td>
<td><span class="labeltext"><p align="left">Untreated Part # </p></font></td>
<td><input type="text" name="untreated_partnum" id="untreated_partnum" style=";background-color:#DDDDDD;" readonly="readonly" size=20 value=""></td>
</tr>

<!-- <tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>PO Num</p></font></td>
<td><input type="text" id="ponum" name="ponum"
size=20 value="">
<img src="images/bu-getpo.gif" alt="Get Date"  onclick="Getpo_num()"></td>
</td>
<td><span class="labeltext"><p align="left">PO Date</p></font></td>
<td><input type="text" id="podate" name="podate"
value=""></td>
</td>
</tr> -->

<!-- <tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">PO Line # </p></font></td>
<td><input type="text" name="poline_num" id="poline_num"  size=20 value=""></td>
<td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>WO #</p></font>
<td><input type="text" id="wonum" name="wonum" 
style=";background-color:#DDDDDD;"
readonly="readonly" size=12 value="">
<img src="images/bu_getwo.gif" alt="Get WO" onclick="Getwo_dn()"></td>
</td>
</tr> -->

<!-- <tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">PO Qty</p></font></td>
<td><input type="text" name="pur_qty" id="pur_qty"  size=8 value=""></td>
<td><span class="labeltext"><p align="left">Untreated Part # </p></font></td>
<td><input type="text" name="untreated_partnum" id="untreated_partnum" style=";background-color:#DDDDDD;"	readonly="readonly" size=20 value=""></td>

</tr> -->

<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">Treated Part # </p></font></td>
<td><input type="text" name="treated_partnum"  id="treated_partnum" style=";background-color:#DDDDDD;"	readonly="readonly" size=20 value=""></td>
<td><span class="labeltext"><p align="left">Part Iss</p></font></td>
<td><input type="text" name="part_iss"  id="part_iss" style=";background-color:#DDDDDD;"	readonly="readonly" size=20 value=""></td>
</tr>

<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">Drg Iss </p></font></td>
<td><input type="text" name="drg_iss"  id="drg_iss" style=";background-color:#DDDDDD;"	readonly="readonly" size=20 value=""></td>
<td><span class="labeltext"><p align="left">COS</p></font></td>
<td><input type="text" name="cos" id="cos" style=";background-color:#DDDDDD;"	readonly="readonly" size=20 value=""></td>

</tr>

<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">Mtl Spec </p></font></td>
<td><input type="text" name="mtl_spec" id="mtl_spec" style=";background-color:#DDDDDD;"	readonly="readonly" size=20 value=""></td>
<td><span class="labeltext"><p align="left">GRN</p></font></td>
<td><input type="text" name="grn_num" id="grn_num" style=";background-color:#DDDDDD;"	readonly="readonly" size=20 value=""></td>

</tr>

<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">Batch Num</p></font></td>
<td><input type="text" name="batch_num" id="batch_num" style=";background-color:#DDDDDD;"	readonly="readonly" size=20 value=""></td>
<td><span class="labeltext"><p align="left">Qty</p></font></td>
<td><input type="text" name="qty" id="qty" style=";background-color:#DDDDDD;"   readonly="readonly" size=20 value="">
<input type="hidden" name="qty_prev" id="qty_prev"  value=""</td>
</tr>
<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">Status</p></font></td>
<td><span class="labeltext"><select id="status" name="status" >
<option value="Open">Open</option>
<option value="Closed">Closed</option>
</select>
</td>
<td colspan=2></td>
</tr>
<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">Remarks</p></font></td>
<td colspan=3><textarea name="remarks" rows="3"
style="background-color:#FFFFFF;"
cols="100"></textarea></td>   
</tr>

</table>
<input type="hidden" name="page" value="new">
<input type="hidden" name="dept" value="<?php echo $dept?>">

<!-- <tr bgcolor="#DDDEDD">
<tr bgcolor="#FFFFFF"><td colspan=12><a href="javascript:addRow4new('myTable',document.forms[0].index.value)"><img name="Image7" border="0" src="images/bu-addrow.gif"></a></td></tr>
<td bgcolor="#DDDEDD" colspan=12><span class="heading"><center><b>Line Items</b></center></td>
</tr>
<table id="myTable" width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
<tr>
<td bgcolor="#EEEFEE" width=3%><span class="heading"><b>Line</b></td>
<td bgcolor="#EEEFEE" width=6%><span class="heading"><b><span class='asterisk'>*</span>CofC #</b></td>
<td bgcolor="#EEEFEE" width=6%><span class="heading"><b><span class='asterisk'>*</span>Cofc Date</b></td>
<td bgcolor="#EEEFEE" width=6%><span class="heading"><b>Qty Recd</b></td>
<td bgcolor="#EEEFEE" width=6%><span class="heading"><b>Qty Rej</b></td>
<td bgcolor="#EEEFEE" width=6%><span class="heading"><b>Qty Rew</b></td>-->
<!-- <td bgcolor="#EEEFEE" width=6%><span class="heading"><b>Supplier WO#</b></td>
<td bgcolor="#EEEFEE" width=6%><span class="heading"><b>Date Code</b></td>
<td bgcolor="#EEEFEE" width=6%><span class="heading"><b>Qty Acc</b></td>
<td bgcolor="#EEEFEE" width=6%><span class="heading"><b>Qty Rew</b></td>
<td bgcolor="#EEEFEE" width=6%><span class="heading"><b>Qty Rej</b></td>
<td bgcolor="#EEEFEE" width=6%><span class="heading"><b>NC #</b></td>
<td bgcolor="#EEEFEE" width=6%><span class="heading"><b>Dispatch</b></td>
<td bgcolor="#EEEFEE" width=10%><span class="heading"><b>Insp Stamp</b></td>
</tr>  -->
<?php
// $i=1;
// while ($i<=6)
// {
// printf('<tr bgcolor="#FFFFFF">');
// $line_num="line_num" . $i;
// $cofc_num="cofc_num" . $i;
// $cofc_date="cofc_date" . $i;
// $qty_recd="qty_recd" . $i;
// //$qty_rej4stores="qty_rej4stores" . $i;
// $qty_acc="qty_acc" . $i;
// $qty_rej="qty_rej" . $i;
// $insp_stamp="insp_stamp" . $i;
// $supp_wo="supp_wo" . $i;
// $datecode="datecode" . $i;
// $nc_num="nc_num" . $i;
// //$qty_rew="qty_rew" . $i;
// $qty_rewqa="qty_rewqa" . $i;


//   echo "<td><span class=\"tabletext\"><input type=\"text\" id=\"$line_num\"  name=\"$line_num\"  value=\"\" size=\"3%\"></td>";

//   echo "<td><span class=\"tabletext\"><input type=\"text\" id=\"$cofc_num\"  name=\"$cofc_num\"  value=\"\" size=\"15%\"></td>";

//   echo "<td><input type=\"text\" id=\"$cofc_date\"  name=\"$cofc_date\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"
//   size=\"10%\" value=\"\"><img src=\"images/bu-getdateicon.gif\" alt=\"GetDate\"
//           onclick=\"GetDate('$cofc_date')\"></td>";

//   echo "<td><span class=\"tabletext\"><input type=\"text\" id=\"$qty_recd\"  name=\"$qty_recd\"  value=\"\" size=\"10%\"></td>";
//   //echo "<td><span class=\"tabletext\"><input type=\"text\" id=\"$qty_rej4stores\"  name=\"$qty_rej4stores\"  value=\"\" size=\"10%\"></td>";
//   //echo "<td><span class=\"tabletext\"><input type=\"text\" id=\"$qty_rew\"  name=\"$qty_rew\"  value=\"\" size=\"10%\"></td>";
//   echo "<td><span class=\"tabletext\"><input type=\"text\" id=\"$supp_wo\"  name=\"$supp_wo\"  value=\"\" size=\"10%\"></td>";

//   echo "<td><input type=\"text\" id=\"$datecode\"  name=\"$datecode\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"
//   size=\"10%\" value=\"\"><img src=\"images/bu-getdateicon.gif\" alt=\"GetDate\"
//           onclick=\"GetDate('$datecode')\"></td>";

//   echo "<td><span class=\"tabletext\"><input type=\"text\" id=\"$qty_acc\"  name=\"$qty_acc\"  value=\"\" size=\"10%\"></td>";
//   echo "<td><span class=\"tabletext\"><input type=\"text\" id=\"$qty_rewqa\"  name=\"$qty_rewqa\"  value=\"\" size=\"10%\"></td>";
//   echo "<td><span class=\"tabletext\"><input type=\"text\" id=\"$qty_rej\"  name=\"$qty_rej\"  value=\"\" size=\"10%\"></td>";

//   echo "<td><span class=\"tabletext\"><input type=\"text\" id=\"$nc_num\"  name=\"$nc_num\"  value=\"\" size=\"15%\"></td>";
//    echo "<td><span class=\"tabletext\"><input type=\"text\" id=\"$dispatch\"  name=\"$dispatch\"  value=\"\" size=\"15%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></td>";

//   echo "<td><span class=\"tabletext\"><input type=\"text\" id=\"$insp_stamp\"  name=\"$insp_stamp\"  value=\"\" size=\"10%\"></td>";

//   printf('</tr>');
//   $i++;
// }
// echo "<input type=\"hidden\" name=\"index\" value=$i>";
?>
<input type="hidden" name="wo_qty" id="wo_qty" size=20 value="0">
<input type="hidden" name="sum_dnqty" id="sum_dnqty" size=20 value="0">
<input type="hidden" name="totaldn4po" id="totaldn4po" size=20 value="0">
<input type="hidden" name="poqty" id="poqty" size=20 value="0">

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
<table border = 0 cellpadding=0 cellspacing=0 width=100%>
<tr>
<td align=left>
</td>
</tr>
</table>
<span class="tabletext"><input type="submit"
style="color=#0066CC;background-color:#DDDDDD;width=130;"
value="Submit" name="submit" onclick="javascript: return check_req_fields()">
<INPUT TYPE="RESET"
style="color=#0066CC;background-color:#DDDDDD;width=130;"
VALUE="Reset" onclick="javascript: putfocus()">

</FORM>
</body>
</html>
