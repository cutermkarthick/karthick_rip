<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = May 27,2005                  =
// Filename: updateinvCount.php                =
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
$xsaction = $_REQUEST['reasontext'];
$userid = $_SESSION['user'];
$_SESSION['pagename']='updateinvCount';
$pagename=$_SESSION['pagename'];
$partrecnum=$_REQUEST['partrecnum'];
$invtcount = $_REQUEST['invtcount'];

// echo $invtcount;exit;
//////session_register('pagename');
?>

<html>
<head>
    <title>Recipt/Issue</title>

</head>

<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/vendPart.js"></script>
<form action='processinvCont.php' method='post' enctype='multipart/form-data'>
<b>Enter Details For <?php echo $xsaction ?></b><br>
<br>
<?php
	$index=$_REQUEST['reasontext'];
	echo "<input type=\"hidden\" name=\"type1\" id=\"type1\" value=\"$index\">";
?>
<?php
if($index == "Receipts")
{
  ?>
<table width=100% border=0 cellpadding=3 cellspacing=1  bgcolor="#DFDEDF" >
<tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Reference Type</p></font></td>
            <td><input type="text" name="ref_type" value=""></td>
</tr>
<tr bgcolor="#FFFFFF">
           <td><span class="labeltext"><p align="left">Reference Num</p></font></td>
           <td><input type="text" name="ref_num"  value=""></td>
</tr>
<tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Qty</p></font></td>
             <td><input type="text" name="qty" value=""></td>
</tr>

<tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Invoice\DC Date</p></font></td>
             <td><input type="text" name="inv_date" id="inv_date" style="background-color:#DDDDDD;" readonly="readonly" size=10% value="<?php echo $myrow["amnd_date"] ?>">
  <img src="images/bu-getdateicon.gif" alt="Get Date"  onclick="GetDate('inv_date')"></td>
</tr>
<tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Invoice\DC #</p></font></td>
             <td><input type="text" name="inv_num" id="inv_num" value=""></td>
</tr>
<tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Receive Date</p></font></td>
             <td><input type="text" name="rece_date" id="rece_date" style="background-color:#DDDDDD;" readonly="readonly" size=10% value="<?php echo $myrow["amnd_date"] ?>">
  <img src="images/bu-getdateicon.gif" alt="Get Date"  onclick="GetDate('rece_date')"></td>
</tr>
<tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Emp #</p></font></td>
             <td><input type="text" name="rece_by" id="rece_by" value=""></td>
</tr>
<tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Invoice Value</p></font></td>
             <td><input type="text" name="inv_value" id="inv_value" value=""></td>
</tr>
<tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">CRN</p></font></td>
             <td><input type="text" name="crn" id="crn" value=""></td>
</tr>
<tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">m/c Name</p></font></td>
             <td><input type="text" name="mc_name" id="mc_name" value=""></td>
</tr>

</table>
<?}else if($index == 'Issues'){?>


<table width=100% border=0 cellpadding=3 cellspacing=1  bgcolor="#DFDEDF" >
<tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Reference Type</p></font></td>
            <td><input type="text" name="ref_type" value=""></td>
</tr>
<tr bgcolor="#FFFFFF">
           <td><span class="labeltext"><p align="left">Reference Num</p></font></td>
           <td><input type="text" name="ref_num"  value=""></td>
</tr>
<tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Qty</p></font></td>
             <td><input type="text" name="qty" value=""></td>
</tr>

  <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">CRN</p></font></td>
             <td><input type="text" name="crn" id="crn" value=""></td>
</tr>
<tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">m/c Name</p></font></td>
             <td><input type="text" name="mc_name" id="mc_name" value=""></td>
</tr>
<tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Emp #</p></font></td>
             <td><input type="text" name="rece_by" id="rece_by" value=""></td>
</tr>


</table>

 <td><input type="hidden" name="invent_cnt" id="invent_cnt" value="<?php echo $invtcount;?>"></td>
<?php
}?>


<span class="tabletext"><input type="submit"
                     style="color=#0066CC;background-color:#DDDDDD;width=130;"
                     value="Submit" name="submit" onclick="javascript: return check_Reciept_req_fields()">
</form>
</html>

