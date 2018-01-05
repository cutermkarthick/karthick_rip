<?php
//
//==============================================
// Author: FSI                                 =
// Date-written =May 27, 2005                  =
// Filename: edit_vendPart.php                 =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OWT                          =
// Allows edit of new Vend parts               =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
header ( "Location: login.php" );

}
$userid = $_SESSION['user'];
$dept = $_SESSION['department'];
$_SESSION['pagename'] = 'edit_vendPart';
$page = "Purchasing: Part Master";
//////session_register('pagename');
$partrecnum=$_REQUEST['partrecnum'];

// First include the class definition
include('classes/vendPartClass.php');
include('classes/displayClass.php');
$newVend = new vendPart;
$newdisplay = new display;
?>

<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/vendPart.js"></script>

<html>
<head>
<title>Edit Vendor Part</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">
<?php
include('header.html');
$result = $newVend->getPartDetails($partrecnum);
$myrow=mysql_fetch_row($result);

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
<table width=100% border=0 cellpadding=0 cellspacing=0  >
<tr><td></td></tr>
<tr>
<td>
<?php
$newdisplay->dispLinks('');
?>
<table width=100% border=0 cellpadding=0 cellspacing=0  >
<tr bgcolor="DEDFDE">
<td width="6"><img src="images/spacer.gif " width="6"></td> -->
<td bgcolor="#FFFFFF">
<table width=100% border=0 cellpadding=2 cellspacing=0  >
<tr><td>
<table width=100% border=0>
<tr>
<td><span class="pageheading"><b>Vendor Part Details</b></td>
<td colspan=50>&nbsp;</td>
<td bgcolor="#FFFFFF" rowspan=2 align="right">
<input type="button" class="stdbtn btn_blue" style="float:right;padding:2px;margin-right:5px;"  value="Receipts"  
onclick="javascript: updateinvCountinc('Receipts')"> 
<input type="button" class="stdbtn btn_blue" style="float:right;padding:2px;margin-right:5px"  value="Issues"     
onclick="javascript: updateinvCountdec('Issues')">
</td>
</tr>
</table>
</td></tr>
<tr>
<td>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1">
<tr bgcolor="#FFFFFF">
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1">
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1">
<form action='processvendPart.php' method='post' enctype='multipart/form-data'>
<tr bgcolor="#FFFFFF">
<tr bgcolor="#DDDEDD"><td colspan=6><span class="heading"><center><b>Vendor Part Details</b></center></td></tr>
<tr bgcolor="#FFFFFF">
<td width=25%><span class="labeltext"><p align="left">Part Number #</p></font></td>
<td width=25%><input type="text" name="partnum" value="<?php echo "$myrow[1]";?>"></td>
<td width=25%><span class="labeltext"><p align="left">Manufacturer PartNum #</p></font></td>
<td width=25%><input type="text" name="mfr_partnum"  value="<?php echo "$myrow[2]";?>"></td>
</tr>
<tr bgcolor="#FFFFFF">
<td width=25%><span class="labeltext"><p align="left">DigiKey PartNum</p></font></td>
<td width=25%><input type="text" name="digi_partnum"  value="<?php echo "$myrow[3]";?>"></td>
<td width=25%><span class="labeltext"><p align="left">Serial Num</p></font></td>
<td width=25%><span class="tabletext"><input type="text" name="serial" value="<?php echo "$myrow[4]";?>"></td>
</tr>
<tr bgcolor="#FFFFFF">
<td width=25%><span class="labeltext"><p align="left">Manufacturer</p></font></td>
<td width=25%><span class="tabletext"><input type="text" name="mfr" size=20 value="<?php echo "$myrow[5]";?>"></td>
<td width=25%><span class="labeltext"><p align="left">Min Qty</p></font></td>
<td width=25%><span class="tabletext"><input type="text" name="min_qty" size=20  value="<?php echo "$myrow[7]";?>"></td>
</tr>

<?php
if ($myrow[9] == 'y')
{
$html=  "<td ><span class=\"labeltext\"><p align=\"left\">Lead Time</p></font></td>
<td><input type=\"text\" name=\"lead_time\" size=20 value=\"$myrow[8]\">
<span class=\"tabletext\">Weeks&nbsp
<input type=\"radio\"  name=\"lead_unit\" value=\"yes\" checked>
<span class=\"tabletext\">Months&nbsp
<input type=\"radio\"  name=\"lead_unit\" value=\"no\"></td>";
}
else
{
$html=  "<td ><span class=\"labeltext\"><p align=\"left\">Lead Time</p></font></td>
<td><input type=\"text\" name=\"lead_time\" size=20 value=\"$myrow[8]\">
<span class=\"tabletext\">Weeks&nbsp
<input type=\"radio\"  name=\"lead_unit\" value=\"yes\" >
<span class=\"tabletext\">Months&nbsp
<input type=\"radio\"  name=\"lead_unit\" value=\"no\" checked></td>";
}
?>
<tr bgcolor="#FFFFFF">
<?php echo $html;?>
<td><span class="labeltext"><p align="left">Part Iss</p></font></td>
<td><input type="text" name="part_iss" value="<?php echo $myrow[17]?>"></td>
</tr>
<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">Drg #</p></font></td>
<td><input type="text" name="drg_no" value="<?php echo $myrow[18]?>"></td>
<td><span class="labeltext"><p align="left">Drg Iss</p></font></td>
<td><span class="tabletext"><input type="text" name="drg_iss"  value="<?php echo $myrow[19]?>"></td>
</tr>
<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">Part Description</p></font></td>
<td colspan=3><span class="tabletext"><input type="text" name="part_desc" size="100%" value="<?php echo "$myrow[10]";?>"></td>
</tr>
<tr bgcolor="#FFFFFF">
<td width=25%><span class="labeltext"><p align="left">Value</p></font></td>
<td width=25%><span class="tabletext"><input type="text" name="value" size=20 value="<?php echo "$myrow[11]";?>"></td>
<td width=25%><span class="labeltext"><p align="left">Inventory Count</p></font></td>
<td width=25%><span class="tabletext"><input type="text" name="invent_cnt" id="invent_cnt"
style=";background-color:#DDDDDD;"
readonly="readonly" size=20 value="<?php echo "$myrow[12]";?>">
<!--<img src="images/bu-activitylog.gif" alt="Get InvXsactions"
onclick="javscript:GetInvXsaction()">-->
</td>
</tr>
<tr bgcolor="#FFFFFF">
<td  width=25%><span class="labeltext"><p align="left">Vendor</p></font></td>
<td  width=25%><span class="tabletext"><input type="text" name="vendor"
style=";background-color:#DDDDDD;"
readonly="readonly" size=20 value="<?php echo "$myrow[21]";?>">
<img src="images/bu-getvendor.gif" alt="Get Vendor"
onclick="javscript:GetAllVendors()">
<!-- <input type="button" class="stdbtn btn_blue" style="height:25px;margin-top:-2px;" value="Get Supplier"
onclick="GetAllVendors()"> -->
<td width=25%><span class="labeltext"><p align="left">Rate</p></font></td>
<td width=25%><span class="tabletext"><input type="text" name="rate" size=20 value="<?php echo "$myrow[6]";?>"></td>
<input type="hidden" name="vendrecnum" value="<?php echo "$myrow[13]";?>">
</tr>

<tr bgcolor="#FFFFFF" >
<td><span class="labeltext"><p align="left">BOM</p></font></td>
<td colspan=6><span class="labeltext"><input type="text" name="ptype" size="11" value="<?php echo $myrow[15] ?>">
<span class="tabletext"><select name="ptype1" size="1" width="100" onchange="selecttype()">
<option selected>No </option>
<option value>Yes</option>
</select>
</td>
</tr>
</table>
</td>
</tr>
</table>
</td>
<!-- 	<td width="6"><img src="images/spacer.gif " width="6"></td>
</tr>
<tr bgcolor="DEDFDE">
<td width="6"><img src="images/box-left-bottom.gif"></td>
<td><img src="images/spacer.gif " height="6"></td>
<td width="6"><img src="images/box-right-bottom.gif"></td>
</tr> -->
</table>
<span class="tabletext"><input type="submit"
style="color=#0066CC;background-color:#DDDDDD;width=130;"
value="Submit" name="submit" onclick="javascript: return check_req_fields()">
<INPUT TYPE="RESET"
style="color=#0066CC;background-color:#DDDDDD;width=130;"
VALUE="Reset" onclick="javascript: putfocus1()">
</FORM>
</body>
</html>
