<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = Feb 23, 2010                 =
// Filename: assypoNew.php                     =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 WMS                          =
// Allows entry of Assembly Po's               =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];

$_SESSION['pagename'] = 'assyPoNew';
//////session_register('pagename');

// First include the class definition
include('classes/assypoClass.php');
include('classes/displayClass.php');
include('classes/companyClass.php');
$newassyPo = new assyPo;
$newdisp = new display;
$company = new company;
?>

<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/assypo.js"></script>

<html>
<head>
<title>New SP PO</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">
<form action='assypoProcess.php' method='post' enctype='multipart/form-data'>
<?php
include('header.html');
?>
<table width=100% cellspacing="0" cellpadding="6" border="0">
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
<td width="6"><img src="images/spacer.gif " width="6"></td>
<td bgcolor="#FFFFFF">
<table width=100% border=0 cellpadding=6 cellspacing=0>
<tr><td>
<table width=100% border=0>
<tr>
<td><span class="pageheading"><b>New SP PO</b></td>
</tr>
</table>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
<tr bgcolor="#FFFFFF">
<tr bgcolor="#EEEFEE"><td colspan=4><span class="heading"><center><b>General Information</b></center></td>
</tr>  </table>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
<tr bgcolor="#FFFFFF">
<?php
$result_host = $company->getAllHosts();
?>
<td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>From</p></font></td>
<td><select id="from" name="from">
<option selected>Select</option>
<?php
while($myrow_host = mysql_fetch_row($result_host))
{
  printf('<option value= %s>%s',$myrow_host[0],$myrow_host[1]);
}
?>
</select></td>
<td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Order To</p></font></td>
<td><select id="order_to" name="order_to">
<option selected>Select</option>
<?php
$result_vendor = $company->getAllVendors();
while($myrow_vendor = mysql_fetch_row($result_vendor))
{
  printf('<option value= %s>%s',$myrow_vendor[0],$myrow_vendor[1]);
}
?>
</select></td>
</tr>
<input type="hidden" name="page" value="new">
<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>SP PO #</p></font></td>
<td><span class="tabletext"><input type="text"  name="po_num" id="po_num" size=12 value=""></td>
<td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>SP PO Date</p></font></td>
<td><input type="text" id="podate" name="podate"
			 style=";background-color:#DDDDDD;"
			readonly="readonly" size=10 value="">
     <img src="images/bu-getdateicon.gif" alt="Get Date"  onclick="GetDate('podate')"></td>
</tr>
<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">Amendment No.</p></font></td>
<td><span class="tabletext"><input type="text"  name="amendment_num" id="amendment_num" size=12 value=""></td>
<td><span class="labeltext"><p align="left">Amendment Date</p></font></td>
<td><input type="text" name="amendmentdate" id="amendmentdate" style="background-color:#DDDDDD;" readonly="readonly"  size=10 value="">
	<img src="images/bu-getdateicon.gif" alt="Get Date"  onclick="GetDate('amendmentdate')"></td>
 </tr>
<tr bgcolor="#FFFFFF" >
 <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span> PO Desc</p></font></td>
<td><input type="text" size=25 name="podesc">
<td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Currency</p></font></td>
<td><span class="labeltext"><select name="currency" size="1" width="100">
                   <option selected>$</option>
                   <option value>Rs</option>
                   <option value>GBP</option>
                   <option value>Euro</option>
      </select>
</td>
</tr>

<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">Amendment Notes</p></font></td>
<td colspan=3><span class="tabletext"><textarea  name="amendment_notes" id="amendment_notes" rows="3"
			              cols="100" value=""></textarea></td>
</tr>

<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Header</p></font></td>
<td colspan=3><textarea  name="terms" rows="2"  cols="100" value=""></textarea></td>
</tr>

<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Remarks</p></font></td>
<td colspan=3><span class="tabletext"><textarea  name="remarks" rows="4"  cols="100" value=""></textarea></td>
</tr>
<tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Type</p></font></td>
           	<td colspan=3><span class="labeltext"><input type="text" name="type" id="type" size="15" value="">
            <span class="tabletext"><select name="type1" size="1" width="100" onchange="onSelecttype()">
            <option selected>Assembly
            <option value>Regular
           	</select>
     	</tr>
</tr>

</table>

<input type="hidden" name="status" value="Pending">
<br>
<tr bgcolor="#DDDEDD">
<tr bgcolor="#FFFFFF"><td colspan=12><a href="javascript:addRow('myTable',document.forms[0].index.value)"><img name="Image7" border="0" src="images/bu-addrow.gif"></a></td></tr>
<td bgcolor="#DDDEDD" colspan=12><span class="heading"><center><b>Line Items</b></center></td>
</tr>
<table id="myTable" width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
<tr>
<td bgcolor="#EEEFEE" width=3%><span class="heading"><b>Line</b></td>
<td bgcolor="#EEEFEE" width=10%><span class="heading"><b>PRN</b></td>
<td bgcolor="#EEEFEE" width=10%><span class="heading"><b>Part# Before<br>NDT/SP</b></td>
<td bgcolor="#EEEFEE" width=10%><span class="heading"><b>Part# After<br>SP</b></td>
<td bgcolor="#EEEFEE" width=10%><span class="heading"><b>Part Name</b></td>
<td bgcolor="#EEEFEE" width=6%><span class="heading"><b>Part<br>Iss</b></td>
<td bgcolor="#EEEFEE" width=6%><span class="heading"><b>Drg<br>Iss</b></td>
<td bgcolor="#EEEFEE" width=10%><span class="heading"><b>Mtl Spec</b></td>
<td bgcolor="#EEEFEE" width=10%><span class="heading"><b>Mtl Type</b></td>
<td bgcolor="#EEEFEE" width=6%><span class="heading"><b>COS</b></td>
<td bgcolor="#EEEFEE" width=6%><span class="heading"><b>Qty</b></td>
<td bgcolor="#EEEFEE" width=8%><span class="heading"><b>Price</b></td>
<td bgcolor="#EEEFEE" width=8%><span class="heading"><b>Extended<br>Price</b></td>
</tr>
<?php
$i=1;
while ($i<=6)
{
   printf('<tr bgcolor="#FFFFFF">');
   $linenumber="line_num" . $i;
   $crn="crn" . $i;
   $pri_partnum="pri_partnum" . $i;
   $sec_partnum="sec_partnum" . $i;
   $partname="partname" . $i;
   $partiss="partiss" . $i;
   $drgiss="drgiss" . $i;
   $mtlspec="mtlspec" . $i;
   $mtltype="mtltype" . $i;
   //$grnnum="grnnum" . $i;
   //$custpo_num="custpo_num" . $i;
   $cos="cos" . $i;
   //$custpo_date="custpo_date" . $i;
   $qty="qty" . $i;
   $price="price" . $i;
   $ext_price="ext_price" . $i;



   echo "<td><span class=\"tabletext\"><input type=\"text\" id=\"$linenumber\"  name=\"$linenumber\"  value=\"\" size=\"3%\"></td>";
   echo "<td><input type=\"text\" id=\"$crn\" name=\"$crn\"  size=\"10%\" value=\"\">"
?>
<img src="images/bu-get.gif" alt="Get Details"  onclick="GetPartDetails('<?php echo "$i";?>')"></td>
<?php

   echo "<td><input type=\"text\" id=\"$pri_partnum\" name=\"$pri_partnum\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" size=\"20%\" value=\"\"></td>";
   echo "<td><input type=\"text\" id=\"$sec_partnum\" name=\"$sec_partnum\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" size=\"15%\" value=\"\"></td>";
   echo "<td><input type=\"text\" id=\"$partname\" name=\"$partname\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" size=\"10%\" value=\"\"></td>";
   echo "<td><input type=\"text\" id=\"$partiss\" name=\"$partiss\"  size=\"3%\" value=\"\"></td>";
   echo "<td><input type=\"text\" id=\"$drgiss\" name=\"$drgiss\"  size=\"3%\" value=\"\"></td>";
   echo "<td><input type=\"text\" id=\"$mtlspec\" name=\"$mtlspec\"  size=\"8%\" value=\"\"></td>";
   echo "<td><input type=\"text\" id=\"$mtltype\" name=\"$mtltype\"  size=\"10%\" value=\"\"></td>";
   echo "<td><input type=\"text\" id=\"$cos\" name=\"$cos\"  size=\"10%\" value=\"\"></td>";
   echo "<td><input type=\"text\" id=\"$qty\" name=\"$qty\"  size=\"5%\" value=\"\">";
   echo "<td><input type=\"text\" id=\"$price\" name=\"$price\" size=\"6%\" value=\"\"></td>";
   echo "<td><input type=\"text\" id=\"$ext_price\" name=\"$ext_price\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" size=\"6%\" value=\"\"></td>";
   printf('</tr>');
   $i++;
 }
       echo "<input type=\"hidden\" name=\"index\" value=$i>";
?>

<tr bgcolor="#FFFFFF">
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
<td align="right"><span class="pageheading"><b></b></td><td width="12%"></td></tr>
<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="right">Tax</p></font></td>
<td colspan=3><input type="text" name="tax" size=10 value=""></td>
</tr>
<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="right">Shipping</p></font></td>
<td colspan=3><input type="text" name="shipping" size=10 value=""></td>
</tr>
<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="right">Labor</p></font></td>
<td colspan=3><input type="text" name="labor" size=10 value=""></td>
</tr>
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
<table border=0 cellpadding=0 cellspacing=0 width=100%>
<tr>
<td align=left>
</td>
</tr>
</table>
	<input type="hidden" name="page_name"  id="page_name" value="new_assypo">
<span class="tabletext"><input type="submit"
                     style="color=#0066CC;background-color:#DDDDDD;width=130;"
                     value="Submit" name="submit" onclick="javascript: return check_req_fields()">
                <INPUT TYPE="RESET"
                     style="color=#0066CC;background-color:#DDDDDD;width=130;"
                     VALUE="Reset" onclick="javascript: putfocus()">

</FORM>
</body>
</html>

