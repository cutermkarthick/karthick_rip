<?php
//
//==============================================
// Author: FSI                                 =
// Date-written =May 27, 2005                  =
// Filename: new_vendPart.php                  =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OWT                          =
// Allows entry of new Vend parts              =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];
$_SESSION['pagename'] = 'new_vendPart';
$page = "Purchasing: Part Master";
//////session_register('pagename');

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
<title>New Vend Part</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">
     <form action='processvendPart.php' method='post' enctype='multipart/form-data'>
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
<?php
	   $newdisplay->dispLinks('');

?>
<table width=100% border=0 cellpadding=0 cellspacing=0  >
<tr bgcolor="DEDFDE">
<td width="6"><img src="images/spacer.gif " width="6"></td> -->
<td bgcolor="#FFFFFF">
<table width=100% border=0 cellpadding=6 cellspacing=0  >
<tr><td>
 <table width=100% border=0>
<tr>
<td><span class="pageheading"><b>New Vend Part</b></td>
</tr>
</table>
</td></tr>
<tr>
<td>
    <table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
	       <tr bgcolor="#FFFFFF">
           <tr bgcolor="#EEEFEE"><td colspan=4><span class="heading"><center><b>General Information</b></center></td>
           </tr>
    </table>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1" >
<tr bgcolor="#FFFFFF" >
         <td><span class="labeltext"><p align="left">BOM</p></font></td>
         <td><span class="labeltext"><span class="labeltext"><select name="ptype" size="1" width="100" onchange="javascript:enableField();">
                        <OPTION value='No'>No</OPTION>
                        <OPTION value='Yes'>Yes</OPTION></select>
                        <input type="hidden" name="typeval">
         </td>
            <td><span class="labeltext"><p align="left">Get BOM&nbsp;</p></font></td>
            <td><input type="text" name="bomnum" style="background-color:#DDDDDD;" readonly="readonly" size=12 value="" >
	                  <img id="s" src="images/bu-getbom.gif" alt="Get BOM No" onclick="GetAllbom2parts()">
            </td>
           <input type="hidden" name="bomrecnum" value="0">
</tr>

<tr bgcolor="#FFFFFF">
	<td><span class="labeltext"><p align="left">Part Number #</p></font></td>
    <td><input type="text" name="partnum" value=""></td>
    <td><span class="labeltext"><p align="left">Manufacturer PartNum #</p></font></td>
    <td><input type="text" name="mfr_partnum" value=""></td>
</tr>

<tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">DigiKey PartNum</p></font></td>
            <td><input type="text" name="digi_partnum" value=""></td>
            <td><span class="labeltext"><p align="left">Serial Num</p></font></td>
            <td><span class="tabletext"><input type="text" name="serial"  value=""></td>
</tr>
<tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Manufacturer</p></font></td>
            <td><span class="tabletext"><input type="text" name="mfr" size=20 value=""></td>
            <td><span class="labeltext"><p align="left">Min Qty</p></font></td>
            <td><span class="tabletext"><input type="text" name="min_qty" size=20 value="" onKeyup="javascript:validate(min_qty)"></td>
</tr>
<tr bgcolor="#FFFFFF">
             <td><span class="labeltext"><p align="left">Lead Time</p></font></td>
             <td><span class="tabletext"><input type="text" name="lead_time" size=20 value="" onKeyup="javascript:validate(lead_time)">
             <span class="labeltext">&nbsp;&nbsp;Weeks&nbsp&nbsp
	<input type="radio" name="lead_unit" value="yes" checked>
	<span class="labeltext">&nbsp&nbsp Months &nbsp&nbsp
	<input type="radio" name="lead_unit" value="no"></td>
	<td><span class="labeltext"><p align="left">Part Iss</p></font></td>
    <td><input type="text" name="part_iss" value=""></td>
</tr>

<tr bgcolor="#FFFFFF">
   <td><span class="labeltext"><p align="left">Drg #</p></font></td>
   <td><input type="text" name="drg_no" value=""></td>
   <td><span class="labeltext"><p align="left">Drg Iss</p></font></td>
   <td><span class="tabletext"><input type="text" name="drg_iss" value=""></td>
</tr>
<tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Part Description</p></font></td>
            <td colspan=3><span class="tabletext"><input type="text" name="part_desc" size="70%" value=""></td>
</tr>
<tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Value</p></font></td>
            <td><span class="tabletext"><input type="text" name="value" size=20 value=""></td>
            <td><span class="labeltext"><p align="left">Inventory Count</p></font></td>
            <td><span class="tabletext"><input type="text" name="invent_cnt" size=20 value="" onKeyup="javascript:validate(invent_cnt)"></td>
</tr>
<tr bgcolor="#FFFFFF">
	<td bgcolor="#FFFFFF"><span class="labeltext"><p align="left">Vendor</p></font></td>
	<td ><span class="tabletext"><input type="text" name="vendor"
		     style=";background-color:#DDDDDD;"
		     readonly="readonly" size=20 value="">
   		     <img src="images/bu-getvendor.gif" alt="Get Vendor"
                     onclick="GetAllVendors()">
                 <td><span class="labeltext"><p align="left">Rate</p></font></td>
                 <td><span class="tabletext"><input type="text" name="rate" size=20 value=""></td>
	            <input type="hidden" name="vendrecnum" value="">
</tr>

</table>
</td>
</tr>
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
<table border = 0 cellpadding=0 cellspacing=0 width=100% >
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
                     VALUE="Reset" onclick="javascript: putfocus1()">
</FORM>
</body>
</html>
