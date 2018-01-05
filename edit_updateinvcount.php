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
$_SESSION['pagename'] = 'edit_updateinvcount';
$page = "Purchasing: Part Master";
$pagename=$_SESSION['pagename'];
////////session_register('pagename');
// $partrecnum=$_SESSION['partrecnum'];
$recnum = $_REQUEST['recnum'];
$partrecnum = $_REQUEST['partrecnum'];


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
<td><span class="pageheading"><b>Issues Details</b></td>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
<tr bgcolor="#FFFFFF">
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1">
<?php
$result = $newVend->getInventoryIssues($recnum);
$myrow = mysql_fetch_row($result)



?>

<form action='processinvCont.php' method='post' enctype='multipart/form-data'>

<tr bgcolor="#DDDEDD"><td colspan=6><span class="heading"><center><b>Issues/Receipts Log</b></center></td></tr>
 <tr bgcolor="#FFFFFF">
            <td width=25%><span class="labeltext"><p align="left">Date</p></font></td>
            <td width=25%><input type="text" name="date" value="<?php echo "$myrow[9]";?>" readonly="readonly" style=";background-color:#DDDDDD;"></td>
            <td width=25%><span class="labeltext"><p align="left">Type</p></font></td>
            <td width=25%><input type="text" name="type1"  value="<?php echo "$myrow[2]";?>" readonly="readonly" style=";background-color:#DDDDDD;"></td>
</tr>
 <tr bgcolor="#FFFFFF">
            <td width=25%><span class="labeltext"><p align="left">Reference Type</p></font></td>
            <td width=25%><input type="text" name="ref_type" value="<?php echo "$myrow[5]";?>" readonly="readonly" style=";background-color:#DDDDDD;"></td>
            <td width=25%><span class="labeltext"><p align="left">Reference Num</p></font></td>
            <td width=25%><input type="text" name="ref_num"  value="<?php echo "$myrow[4]";?>" readonly="readonly" style=";background-color:#DDDDDD;"></td>
</tr>
 <tr bgcolor="#FFFFFF">
            <td width=25%><span class="labeltext"><p align="left">Qty</p></font></td>
            <td width=25%><input type="text" name="qty" value="<?php echo "$myrow[3]";?>" readonly="readonly" style=";background-color:#DDDDDD;"></td>
            <td width=25%><span class="labeltext"><p align="left">Balance</p></font></td>
            <td width=25%><input type="text" name="clbal"  value="<?php echo "$myrow[8]";?>" readonly="readonly" style=";background-color:#DDDDDD;"></td>
</tr>
<!--  <tr bgcolor="#FFFFFF">
            <td width=25%><span class="labeltext"><p align="left">Invoice #</p></font></td>
            <td width=25%><input type="text" name="inv_num" value="" readonly="readonly" style=";background-color:#DDDDDD;"></td>
            <td width=25%><span class="labeltext"><p align="left">Invoice Date</p></font></td>
            <td width=25%><input type="text" name="inv_date"  value="" readonly="readonly" style=";background-color:#DDDDDD;"></td>
</tr> -->
 <tr bgcolor="#FFFFFF">
            <td width=25%><span class="labeltext"><p align="left">Issues/Receipts<br>Emp #</p></font></td>
            <td width=25%><input type="text" name="rece_by" value="<?php echo "$myrow[10]";?>" readonly="readonly" style=";background-color:#DDDDDD;"></td>
            <td width=25%><span class="labeltext"><p align="left">CRN</p></font></td>
            <td width=25%><input type="text" name="crn"  value="<?php echo "$myrow[12]";?>" readonly="readonly" style=";background-color:#DDDDDD;"></td>
</tr>
 <tr bgcolor="#FFFFFF">
            <td width=25%><span class="labeltext"><p align="left">M/C Name</p></font></td>
            <td width=25%><input type="text" name="mc_name" value="<?php echo "$myrow[13]";?>" readonly="readonly" style=";background-color:#DDDDDD;"></td>


             <td width=25%><span class="labeltext"><p align="left">Status</p></font></td>
         <td colspan="3"><span class="tabletext"><input type="text" name="issStatus" id="issStatus" 
              style="background-color:#DDDDDD;" readonly="readonly"  value=" "
    <span class="tabletext"><select name="iss_status" size="1" width="20" onchange="onSelectIssStatus()">
    <option selected>Please Specify
    <option value="Active">Active</option>
    <option value="Scrap">Scrap</option>
    </select>
        <!--     <td width=25%><span class="labeltext"><p align="left">Invoice Value</p></font></td>
            <td width=25%><input type="text" name="inv_value"  value="" readonly="readonly" style=";background-color:#DDDDDD;"></td> -->
<input type="hidden" name="recnum" value="<?php echo $recnum?>">
<input type="hidden" name="partrecnum" value="<?php echo $partrecnum?>">
</tr>
           
         <!--    <td width=25%><span class="labeltext"><p align="left">Closing Date</p></font></td>
              <td><input type="text" name="cl_date" id="cl_date" style="background-color:#DDDDDD;" readonly="readonly" size=10% value="<?php echo $myrow["amnd_date"] ?>">
  <img src="images/bu-getdateicon.gif" alt="Get Date"  onclick="GetDate('cl_date')"></td> -->

	</table>
        </td>
        </tr>
    </table>
    </td>
<!--     <td width="6"><img src="images/spacer.gif " width="6"></td>
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
