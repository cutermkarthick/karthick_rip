<?php
//==============================================
// Author: FSI                                 =
// Date-written = June 20, 2004                =
// Filename: new_dispatch.php                  =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 WMS                          =
// Allows entry of Dispatch                    =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];
$dept = $_SESSION['department'];

$_SESSION['pagename'] = 'newdispatch';
$page="Dispatch";
//////session_register('pagename');

// First include the class definition
include('classes/dispatchClass.php');
include('classes/displayClass.php');
$newDispatch = new dispatch;
$newdisp = new display;
?>

<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/dispatch.js"></script>
<html>
<head>
<title>New Dispatch</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">
<form action='processDispatch.php' method='post' enctype='multipart/form-data'>
<?php
include('header.html');
?>
<table  border=0 cellpadding=0 cellspacing=0 class="stdtable1" style="width:100%!important">
<td bgcolor="#FFFFFF">
<table width=100% border=0 cellpadding=6 cellspacing=0 class="stdtable1" style="width:100%!important">
<tr><td>
<table width=100% border=0 class="stdtable1" style="width:100%!important">
<tr>
<td><span class="pageheading"><b>New Dispatch</b></td>
</tr>
</table>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1" style="width:100%!important">
<tr bgcolor="#FFFFFF">
<tr bgcolor="#EEEFEE"><td colspan=4><span class="heading"><center><b>General Information</b></center></td>
</tr>  </table>

<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1" style="width:100%!important">

<tr bgcolor="#FFFFFF" width=100%>
<td><span class="labeltext"><p align="left">Type</p></font></td>
             <td><select id="type" name="type" onchange="onchagetype()">
             <option value="Please Specify">Please Specify</option>
                   <option value="Untreated">Untreated</option>
				   <!-- <option value="Manufacture for Assembly">Manufacture for Assembly</option> -->
                   <option value="Treated">Treated[Post Process]</option>
                   <option value="Assembly">Assembly</option>
                   <option value="Kit">Kit</option>
                 </select>
</td>

<td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Dispatch Date</p></font></td>
<td><input type="text" name="disp_date" id="disp_date"
			 style=";background-color:#DDDDDD;"
			readonly="readonly" size=25 value="">
<img src="images/bu-getdate.gif" alt="Get Date"  onclick="GetDate('disp_date')">
</td>
</tr>

<tr bgcolor="#FFFFFF" width=100%>
<td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Company</p></font></td>
<td><input type="text" name="disp2company"  id="disp2company"
    style=";background-color:#DDDDDD;"
    readonly="readonly" size=30 value="">
    <img src="images/bu-getcompany.gif" alt="Get Company"  onclick="GetCompany()">
    <input type="hidden" name="companyrecnum">
</td>
<td><span class="labeltext"><p align="left">Via</p></font></td>
<td><input type="text" name="via"  size=25 value=""></td>
</td>
</tr>

<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">Dispatch Desc</p></font></td>
<td colspan=3><textarea name="disp_desc" rows="2" 
                cols="100" value=""></textarea></td>
</tr>

<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">PRN</p></font></td>
<td><span class="tabletext"><input type="text" id="crnnum" name="crnnum" size=20 value="" onchange='resetsch_date()'></td>
<td><span class="labeltext"><p align="left">Ref No</p></font></td>
<td><input type="text" name="refno"  size=25 value=""></td>
</tr>
<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">Deliver To</p></font></td>
<td><select id="" name="deliver" >
<option value="Primary"selected>Primary</option>
<option value="Billing">Billing</option>
<option value="Shipping">Shipping</option>
</select></td>
<td><span class="labeltext"><p align="left">Invoice To</p></font></td>
<td><select id="invoice" name="invoice" >
<option value="Primary" selected>Primary</option>
<option value="Billing">Billing</option>
<option value="Shipping">Shipping</option>
</select></td>
</tr>

<tr bgcolor="#FFFFFF" width=100%>
<td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Scheduled Date</p></font></td>
<td colspan=3><span class="tabletext">
<input type="text"  style="background-color:#DDDDDD;" readonly="readonly" id="sch_date" name="sch_date" size=20 value=""><img src='images/bu-get.gif' name='cim' onclick='GetSch("<?php echo 'CIM_refnum' ?>")'></td>
</tr>

<input type="hidden" id="schqty" name="schqty" value="<?php echo $myrow[35] ?>">
<tr bgcolor="#FFFFFF" width=100%>
<td><span class="labeltext"><p align="left">Export Invoice #</p></font></td>
<td colspan=3><span class="tabletext"><input type="text" id="expinvnum" name="expinvnum" size=20 value=""></td>
</tr>
                 
<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">Remarks</p></font></td>
<td colspan=3><textarea name="remarks" rows="3" 
                cols="100" value=""></textarea></td>
</tr>
</table>
</table>
<tr bgcolor="#DDDEDD">
<td colspan=3><span class="heading"><center><b>Line Items</b></center></td>
</tr>
</table>
<div style="width:100%;overflow-x:scroll">
<table id="myTable" width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1" >
<tr>
<td bgcolor="#EEEFEE" width=3%><span class="heading"><b>Line</b></td>
<td bgcolor="#EEEFEE" width=10%><span class="heading"><b>WO#</b></td>
<td bgcolor="#EEEFEE" width=10%><span class="heading"><b>DN Num</b></td>
<td bgcolor="#EEEFEE" width=10%><span class="heading"><b>Supplier<br/>WO#</b></td>
<td bgcolor="#EEEFEE" width=10%><span class="heading"><b>Part #</b></td>
<td bgcolor="#EEEFEE" width=6%><span class="heading"><b>Part Name</b></td>
<td bgcolor="#EEEFEE" width=6%><span class="heading"><b>RM Spec</b></td>
<td bgcolor="#EEEFEE" width=6%><span class="heading"><b>Part<br>Iss</b></td>
<td bgcolor="#EEEFEE" width=6%><span class="heading"><b>Drg <br>Iss</b></td>
<td bgcolor="#EEEFEE" width=6%><span class="heading"><b>COS</b></td>
<td bgcolor="#EEEFEE" width=6%><span class="heading"><b>GRN Num</b></td>
<td bgcolor="#EEEFEE" width=6%><span class="heading"><b>Batch No</b></td>
<td bgcolor="#EEEFEE" width=6%><span class="heading"><b>Cust PO Num</b></td>

<td bgcolor="#EEEFEE" width=6%><span class="heading"><b>Dispatch Cust PO Num</b></td>
<td bgcolor="#EEEFEE" width=6%><span class="heading"><b>Dispatch Cust PO<br/>Item</b></td>


<td bgcolor="#EEEFEE" width=6%><span class="heading"><b>Item<br>Num</b></td>
<td bgcolor="#EEEFEE" width=6%><span class="heading"><b>WO Comp Date</b></td>
<td bgcolor="#EEEFEE" width=6%><span class="heading"><b>WO<br>Qty</b></td>
<td bgcolor="#EEEFEE" width=6%><span class="heading"><b>Acc<br> Qty</b></td>
<td bgcolor="#EEEFEE" width=6%><span class="heading"><b>Dispatch<br>up to date</b></td>
<td bgcolor="#EEEFEE" width=6%><span class="heading"><b>Curr<br>Disp Qty</b></td>
<td bgcolor="#EEEFEE" width=6%><span class="heading"><b>Packing<br>Slip No</b></td>

</tr>
<?php
$i=1;
while ($i<=6)
{



   printf('<tr bgcolor="#FFFFFF">');
   $linenumber="line_num" . $i;
   $wonum="wonum" . $i;
   $dnnum="dnnum" . $i;
   $supplier_wonum="supplier_wonum" . $i;
   $partnum="partnum" . $i;
   $partname="partname" . $i;
   $rmspec="rmspec" . $i;
   $partiss="partiss" . $i;
   $drgiss="drgiss" . $i;
   $cos="cos" . $i;

   $grnnum="grnnum" . $i;
   $custpo_num="custpo_num" . $i;
   $itemnum="itemnum" . $i;
   $custpo_date="custpo_date" . $i;
   $wo_qty="wo_qty" . $i;
   $comp_qty="comp_qty" . $i;
   $disp_qty="disp_qty" . $i;
   $disp_update="disp_update" . $i;
   $batchnum="batchnum" . $i;
  
   $psn="psn" .$i;
   $exp_invnum="exp_invnum" .$i;

   $disp_custpo_no="disp_custpo_no" .$i;
   $disp_custpo_item="disp_custpo_item" .$i;



   echo "<td><span class=\"tabletext\"><input type=\"text\" id=\"$linenumber\"  name=\"$linenumber\"  value=\"\" size=\"3%\"></td>";
   echo "<td><input type=\"text\" id=\"$wonum\" name=\"$wonum\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" size=\"10%\" value=\"\">";
   ?>
   <img src="images/bu_getwo.gif" alt="Get WO"  onclick="Getwo4dc('<?php echo "$i";?>')"></td>
   <?php 
   echo "<td><input type=\"text\" id=\"$dnnum\" name=\"$dnnum\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" size=\"10%\" value=\"\">";
   echo "<td><input type=\"text\" id=\"$supplier_wonum\" name=\"$supplier_wonum\"  size=\"10%\" value=\"\"></td>";
   echo "<td><input type=\"text\" id=\"$partnum\" name=\"$partnum\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" size=\"20%\" value=\"\"></td>";
   echo "<td><input type=\"text\" id=\"$partname\" name=\"$partname\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" size=\"15%\" value=\"\"></td>";
   echo "<td><input type=\"text\" id=\"$rmspec\" name=\"$rmspec\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" size=\"15%\" value=\"\"></td>";   
   echo "<td><input type=\"text\" id=\"$partiss\" name=\"$partiss\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" size=\"3%\" value=\"\"></td>";   
   echo "<td><input type=\"text\" id=\"$drgiss\" name=\"$drgiss\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" size=\"3%\" value=\"\"></td>";
   echo "<td><input type=\"text\" id=\"$cos\" name=\"$cos\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" size=\"3%\" value=\"\"></td>";
   echo "<td><input type=\"text\" id=\"$grnnum\" name=\"$grnnum\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" size=\"10%\" value=\"\"></td>";
   echo "<td><input type=\"text\" id=\"$batchnum\" name=\"$batchnum\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" size=\"10%\" value=\"\"></td>";
   echo "<td><input type=\"text\" id=\"$custpo_num\" name=\"$custpo_num\" size=\"10%\" value=\"\"></td>";


echo "<td><input type=\"text\" id=\"$disp_custpo_no\" name=\"$disp_custpo_no\" size=\"10%\" value=\"\"></td>";
echo "<td><input type=\"text\" id=\"$disp_custpo_item\" name=\"$disp_custpo_item\" size=\"10%\" value=\"\"></td>";


   echo "<td><input type=\"text\" id=\"$itemnum\" name=\"$itemnum\" size=\"3%\" value=\"\"></td>";
   echo "<td><input type=\"text\" id=\"$custpo_date\" name=\"$custpo_date\" style=\"background-color:#DDDDDD;\" size=\"10%\" value=\"\"><img src=\"images/bu-getdateicon.gif\" alt=\"Get Date\"  onclick=\"GetDate('$custpo_date')\">";
   echo "<td><input type=\"text\" id=\"$wo_qty\" name=\"$wo_qty\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" size=\"3%\" value=\"\"></td>";
   echo "<td><input type=\"text\" id=\"$comp_qty\" name=\"$comp_qty\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" size=\"3%\" value=\"\"></td>";
   echo "<td><input type=\"text\" id=\"$disp_update\" name=\"$disp_update\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" size=\"3%\" value=\"\"></td>";
   echo "<td><input type=\"text\" id=\"$disp_qty\" name=\"$disp_qty\" size=\"3%\" value=\"\"></td>";
   echo "<td><input type=\"text\" id=\"$psn\" name=\"$psn\" size=\"6%\" value=\"\"></td>";
   
   echo "<input type=\"hidden\" name=\"$exp_invnum\" id=\"$exp_invnum\" value=\"\">";
   printf('</tr>');
   $i++;
 }
 echo "<input type=\"hidden\" name=\"index\" value=$i>";
?>
<td><input type="hidden"  id="totdispqty" name="totdispqty"  value="0" >
<input type="hidden"  id="delivery_sch_qty" name="delivery_sch_qty"  value="0" >
</td>
</tr>
</table>

<input type="hidden" name="pagename" id="pagename" value='newdispatch'>
<div id="treatment">
</div>
</td>
</table>
</div>
<span class="tabletext"><input type="submit"
                     style="color=#0066CC;background-color:#DDDDDD;width=130;"
                     value="Submit" name="submit" onclick="javascript: return check_req_fields1()">
                <INPUT TYPE="RESET"
                     style="color=#0066CC;background-color:#DDDDDD;width=130;"
                     VALUE="Reset" onclick="javascript: putfocus()">

</FORM>
</body>
</html>

