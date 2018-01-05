<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = July 20, 2006                =
// Filename: new_so.php                        =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OWT                          =
// Allows salesorder entry.                    =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
header ( "Location: login.php" );

}
$userid = $_SESSION['user'];
$dept = $_SESSION['department'];

$_SESSION['pagename'] = 'newso';
$page = "CRM: Sales Order";
//////session_register('pagename');
// First include the class definition
include('classes/userClass.php');
include_once('classes/loginClass.php');
include('classes/workorderClass.php');
include('classes/empClass.php');
include('classes/companyClass.php');
include('classes/workflowClass.php');
include('classes/displayClass.php');
include('classes/salesorderClass.php');

$newlogin = new userlogin;
$newlogin->dbconnect();

$newCustomer = new company;
$newdisp = new display;
$result = $newCustomer->getAllCustomers();
$newEmp = new emp;
$employees = $newEmp->getAllEmps();
?>

<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/salesorder.js"></script>
<script language="javascript" src="scripts/jquery.js"></script>

<html>
<head>
<title>New SO Entry</title>

<script language="javascript">

function onPageLoad() {
window.setInterval(sendPing, 120000);
}
function sendPing() {
$.ajax({
url : "getsession4so.php",
type : "POST",
dataType: "html",
//data : "membercode="+memnumber,
success : function (msg){
//alert(msg);
$('#sessiondets').html(msg);
}
})
}
</script>
</head>

<body leftmargin="0" topmargin="0" marginwidth="0" rightmargin="0" onload="onPageLoad()">
<form name="myForm" action='processSalesorder.php' method='post'>


<?php
include('header.html');
?>

<table width=100% cellspacing="0" cellpadding="0" border="0">
<b>New Customer PO</b><br />

<b>Max Line Items Permitted = 40</b>


<table bgcolor="#DFDEDF" style="width:1939px" cellspacing=1 cellpadding=3 class="stdtable1">
<tr bgcolor="#DDDEDD">
<td colspan=4><span class="heading"><center><b>General Information</b></center></td>
</tr>
<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Cust PO No.</p></font></td>
<td><input type="text" name="po_num" size=20 value="">

<input type="hidden" name="porecnum">
<input type="hidden" name="reviewrefrecnum"></td>
<input type="hidden" name="amendment" value=""></td>
<td><span class="labeltext"><p align="left"><span class='asterisk'>* </span>Customer</p></font></td>

<td><input type="text" name="company"
style=";background-color:#DDDDDD;"
readonly="readonly" size=20 value="">
<!-- <input type="button" class="stdbtn btn_blue" style="padding:2px;" onClick="javascript:GetAllCustomers()" value="Get Customer" > -->
<img src="images/bu-getcustomer.gif" alt="Get Customer"
onclick="GetAllCustomers()">
</td>
<input type="hidden" name="companyrecnum"></td>
</tr>
<tr bgcolor="#FFFFFF">
<td><span class="tabletext"><p align="left"><b>Order Date</b></p></font></td>
<td><input type="text" name="order_date"
style="background-color:#DDDDDD;"
readonly="readonly" size=20 value="">
<!-- <button class="stdbtn btn_blue" style="background-color:#2d3e50;padding:2px;" onclick="GetDate('order_date')" >Get Date</button> -->
<!-- <input type="button" class="stdbtn btn_blue" style="padding:2px;" onClick="javascript:GetDate('order_date')" value="Get Date" > -->
<img src="images/bu-getdate.gif" alt="Get BookDate" onclick="GetDate('order_date')">
</td>
<td><span class="labeltext"><p align="left">Order/Quote Ref.</p></font></td>
<td><input type="text" name="quote_num" size=20 value=""></td>
</tr>

<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><span class='asterisk'>* </span>Special Instruction</font></td>
<td colspan=4><textarea name="special_instruction" rows="4" 
cols="45" value=""></textarea></td>
</tr>

<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">Description/Order Type</p></font></td>
<td><input type="text" name="description" size=36 value=""></td>
<td><span class="labeltext"><p align="left">Currency</p></font></td>
<td><span class="labeltext"><select name="currency" size="1" width="100">
<option selected>$ </option>
<option value>Rs </option>
<option value>GBP </option>
<option value>Euro </option>
</select>
</tr>
<input type="hidden" name="sales_order" size=20 value="">


<input type="hidden" name="salespersonrecnum" value="0">
<input type="hidden" name="due_date" value="">
<input type="hidden" name="quote_date" value="">
<tr bgcolor="#FFFFFF">
<td><span class="labeltext">Amendment</font></td>
<td><input type="text" name="amendmentnum" size=20 value=""></td>
<td><span class="labeltext">Amendment Date</td>
<td><input type="text" name="amendmentdate"
style="background-color:#DDDDDD;"
readonly="readonly" size=20 value="">
<!-- <input type="button" class="stdbtn btn_blue" style="padding:2px;" onClick="javascript:GetDate('amendmentdate')" value="Get Date" > -->
<img src="images/bu-getdate.gif" alt="Get AmndDate" onclick="GetDate('amendmentdate')">
</tr>

<tr bgcolor="#DDDEDD">
<td colspan=4><span class="heading"><center><b><span class='asterisk'>*</span>Contact Information</b></center></td>
</tr>
<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">Customer Contact</p></font></td>
<td><input type="text" name="contact" size=20 value=""></td>
<td><span class="labeltext"><p align="left">Phone</p></font></td>
<td><input type="text" name="phone" size=20 value=""></td>
</tr>
<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">Email</p></font></td>
<td><input type="text" name="email" size=20 value=""></td>
<td colspan=2></td>
</tr>
<!-- <?php
// include('reviewEntry.php');
?> -->
<table border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1" style="width:194%">

        <tr bgcolor="#DDDEDD">
            <td colspan=4><span class="heading"><center><b>Order Stage Details</b></center></td>
        </tr>

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext">Order Stored in the form of</td>
            <td><span class="tabletext"><input type="text" name="data_store" size=30 value=""></td>
            <td><span class="labeltext">Filename/Path</font></td>
            <td><span class="tabletext"><input type="text" name="path" size=30 value=""></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext">Order Type</td>
            <td><span class="tabletext"><input type="text" name="ordertype" size=30 value=""></td>
             <td><span class="labeltext"><span class='asterisk'>*</span>Contact Person</font></td>
            <td><span class="tabletext"><input type="text" name="person" size=30 value=""></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Order for</td>
            <td><span class="tabletext"><input type="text" name="orderfor" size=30 value=""></td>
            <td><span class="labeltext">Attachments</font></td>
            <td><span class="tabletext"><input type="text" name="attachment1" size=30 value=""></td>
        </tr>


        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">No. of Parts</p></font></td>
            <td><span class="tabletext"><input type="text" name="numofparts" size=30 value=""></td>
            <td><span class="labeltext">Classification of Parts</td>
            <td><span class="tabletext"><input type="text" name="parts_class" size=30 value=""></td>
        </tr>

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext">Raw material supplied by Customer or to be Procured</font></td>
            <td><span class="tabletext"><input type="text" name="rawmaterial" size=30 value=""></td>
            <td><span class="labeltext">Source of Raw Material planned</td>
            <td><span class="tabletext"><input type="text" name="source" size=30 value=""></td>
        </tr>
        
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Create Date</p></font></td>
            <td><span class="tabletext"><input type="text" name="create_date" size=20 value="" readonly="readonly" style="background-color:#DDDDDD;">
                                 <img src="images/bu-getdate.gif" alt="Get BookDate" onclick="GetDate('create_date')"></td>
            <td><span class="labeltext">Created By</td>
            <td><span class="tabletext"><input type="text" name="created_by" size=30 value="<?php echo $userid ?>" readonly="readonly"></td>
        </tr>
        
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext">Engineering Approved</td>
            <td><span class="tabletext"><input type="checkbox" name="engineering_approved" id="engineering_approved" disabled onclick="JavaScript:toggleValue('eng_app',this);" />
            <input type="hidden" name="eng_app" value="no" id="eng_app"></td></td>
            <td><span class="labeltext">QA Approved</font></td>
            <td><span class="tabletext"><input type="checkbox" name="qa_approved" id="qa_approved" disabled onclick="JavaScript:toggleValue('qa_app',this);" />
            <input type="hidden" name="qa_app" value="no" id="qa_app"></td>
        </tr>
        <tr bgcolor="#DDDEDD">
            <td colspan=4><span class="heading"><center><b>Purchase Order Requirements</b></center></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td colspan=2><span class="labeltext">Any resources required apart from the existing for this order?
                   <br>Provide Details</font></td>
            <td colspan=2><span class="tabletext"><input type="text" name="resources" size=90 value=""></td>
        </tr>
        <tr bgcolor="#DDDEDD">
            <td colspan=4><span class="heading"><center><b>Quality</b></center></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td colspan=2><span class="labeltext">Are quality requirements clear?
                              <br><b>Is it In-line with Organization or Specific</td>
            <td colspan=2><span class="tabletext"><input type="text" name="qualityreq" size=90 value=""></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td colspan=2><span class="labeltext">Comments on Specific Requirements</font></td>
            <td colspan=2><span class="tabletext"><input type="text" name="saliant" size=90 value=""></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td colspan=2><span class="labeltext">Any additional requirements for quality<br>
                in terms of Resources/Equipment/Infrastructure? Explain.</td>
            <td colspan=2><span class="tabletext"><input type="text" name="aditional_resources" size=90 value=""></td>
        </tr>

        <tr bgcolor="#DDDEDD">
            <td colspan=4><span class="heading"><center><b>Outsourcing Activity</b></center></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td colspan=2><span class="labeltext">Any Outsourcing/Subcontracting activity needs to be planned?<br>
                   If yes, provide details</font></td>
            <td colspan=2><span class="tabletext"><input type="text" name="subcontract" size=90 value=""></td>
        </tr>
        <tr bgcolor="#DDDEDD">
            <td colspan=4><span class="heading"><center><b>Special Processes</b></center></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td colspan=2><span class="labeltext">Is there any Special Process involved?<br>If yes, provide details</font></td>
            <td colspan=2><span class="tabletext"><input type="text" name="special_process" size=90 value=""></td>
        </tr>
        <tr bgcolor="#DDDEDD">
            <td colspan=4><span class="heading"><center><b>Delivery Requirements</b></center></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td colspan=2><span class="labeltext">Are delivery requirements of the Order Clear?</font></td>
            <td colspan=2><span class="tabletext"><input type="text" name="delivery_req" size=90 value=""></td>
        </tr>
        <tr bgcolor="#DDDEDD">
            <td colspan=5><span class="heading"><center><b>Risk Analysis</b></center></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td colspan=2><span class="labeltext">Do you foresee any Risk as to the requirements of this<br>
                        Order? If YES, state the probable Risk factor</td>
            <td colspan=2><span class="tabletext"><input type="text" name="risk_factors" size=90 value=""></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td colspan=2><span class="labeltext">Explain the Risk Factor</td>
            <td colspan=2><span class="tabletext"><input type="text" name="explain_risk_factors" size=90 value=""></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td colspan=2><span class="labeltext">Are any statutory or regulatory requirements applicable?<br>
                            If yes, provide details</font></td>
            <td colspan=2><span class="tabletext"><input type="text" name="requirements" size=90 value=""></td>
        </tr>
        <tr bgcolor="#DDDEDD">
            <td colspan=4><span class="heading"><center><b>Quotation Details</b></center></td>
        </tr>

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext">Quote Reference No.</font></td>
            <td><span class="tabletext"><input type="text" name="quotation" size=30 value=""></td>
            <td><span class="labeltext">Quote Sent by</td>
            <td><span class="tabletext"><input type="text" name="quote_sentby" size=90 value=""></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td colspan=2><span class="labeltext">Details of Quotation/Estimation stored in</td>
            <td colspan=2><span class="tabletext"><input type="text" name="quotation_det_store" size=90 value=""></td>
        </tr>

        <tr bgcolor="#DDDEDD">
            <td colspan=4><span class="heading"><center><b>Data Storage</b></center></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td colspan=2><span class="labeltext">Data related to Enquiry stored in</td>
            <td colspan=2><span class="tabletext"><input type="text" name="data_for_enquiry" size=90 value=""></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td colspan=2><span class="labeltext">Mention the Filename/Path</td>
            <td colspan=2><span class="tabletext"><input type="text" name="enquiry_path" size=90 value=""></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td colspan=2><span class="labeltext">Data related to Quote stored in</td>
            <td colspan=2><span class="tabletext"><input type="text" name="data_for_quote" size=90 value=""></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td colspan=2><span class="labeltext">Mention the Filename/Path</td>
            <td colspan=2><span class="tabletext"><input type="text" name="quote_path" size=90 value=""></td>
        </tr>


<!-- <table id="myTable" style="width:100%" border=0 cellpadding=3 cellspacing=1 bgcolor="#FFFFFF" class="stdtable1">
<tr bgcolor="#DDDEDD"> -->
<td colspan=25><span class="heading"><center><b>Line Items</b></center></td>
</tr>
<table id="myTable" style="width:100%" border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1">
<thead>
<tr>

<th class="head0" ><span class="heading"><b><center>PO Line Item</center></b></th>
<th class="head1"><span class="heading"><b><center>PRN</center></b></th>
<th class="head0"><span class="heading"><b><center>Part Number</center></b></th>
<th class="head1"><span class="heading"><b><center>Part Name</center></b></th>
<th class="head0"><span class="heading"><b><center>RM Type</center></b></th>
<th class="head1"><span class="heading"><b><center>RM Spec</center></b></th>
<th class="head0"><span class="heading"><b><center>Condition</center></b></th>
<th class="head1"><span class="heading"><b><center>UOM</center></b></th>
<th class="head0"><span class="heading"><b><center>Dia</center></b></th>
<th class="head1"><span class="heading"><b><center>Length</center></b></th>
<th class="head0"><span class="heading"><b><center>Width</center></b></th>
<th class="head1"><span class="heading"><b><center>Thickness</center></b></th>
<th class="head0"><span class="heading"><b><center>Grain Flow</center></b></th>
<th class="head1"><span class="heading"><b><center>Max Ruling Dim</center></b></th>
<th class="head0"><span class="heading"><b><center>Alt Spec</center></b></th>
<th class="head1"><span class="heading"><b><center>Drg Iss</center></b></th>
<th class="head0"><span class="heading"><b><center>Part Iss/Attach</center></b></th>
<th class="head1"><span class="heading"><b><center>Cos Iss</center></b></th>
<th class="head0"><span class="heading"><b><center>Model Issue</center></b></th>
<th class="head1"><span class="heading"><b><center>Quantity</center></b></th>

<?
if($_SESSION['department'] == 'Sales')
{?>
<th class="head0"><span class="heading"><b><center>Unit Price</center></b></th>
<th class="head1"><span class="heading"><b><center>Amount</center></b></th>
<!--<td bgcolor="#EEEFEE"><span class="heading"><b><center>Unit RM Cost</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>RM Amount</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Unit M/C Cost</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>M/C Amount</center></b></td>
-->
<?}?>
<th class="head0"><span class="heading"><b><center>Save</center></b></th>
</tr>
</thead>
<?php

$i=1;
while ($i<=40)
{
printf('<tr bgcolor="#FFFFFF">');
$line_num="line_num" . $i;
$item_desc="item_desc" . $i;
$partnum="partnum" . $i;
$rmtype="rmtype" . $i;
$rmspec="rmspec" . $i;
$uom="uom" . $i;
$dia="dia" . $i;
$length="length" . $i;
$width="width" . $i;
$thickness="thickness" . $i;
$gf="gf" . $i;
$maxruling="maxruling" . $i;
$altspec="altspec" . $i;
$crn_num="crn_num" . $i;
$uom="uom" . $i;
$dia="dia" . $i;
$length="length" . $i;
$width="width" . $i;
$thickness="thickness" . $i;
$gf="gf" . $i;
$maxruling="maxruling" . $i;
$altspec="altspec" . $i;
$condition="condition" . $i;
$partiss="partiss" . $i;
// $hcpartiss="hcpartiss" . $i;
$po_cos="po_cos" . $i;
$cos_iss="cos_iss" . $i;
// $hc_cos="hc_cos" . $i;
$model_iss="model_iss" . $i;
$drgiss="drgiss" . $i;
// $hcdrgiss="hcdrgiss" . $i;
$qty="qty" . $i;
$price="price" . $i;
$amount="amount" . $i;
$rmprice="rmprice" . $i;
$rmamount="rmamount" . $i;
$mcprice="mcprice" . $i;
$mcamount="mcamount" . $i;
echo "<td><span class=\"tabletext\"><input type=\"text\"  id=\"$line_num\" name=\"$line_num\" value=\"\" size=\"4%\"></td>";
echo "<td><span class=\"tabletext\"><input type=\"text\" id=\"$crn_num\" name=\"$crn_num\"
style=\"background-color:#DDDDDD;\"
readonly=\"readonly\" value=\"\" size=\"8%\" >
<img src=\"images/bu-get.gif\" alt=\"Get\" onclick=\"GetCrn4Soli('$i')\">
           </td>";
echo "<td><input type=\"text\" id=\"$partnum\" name=\"$partnum\" size=\"10%\" value=\"\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></td>";
echo "<td><input type=\"text\" id=\"$item_desc\" name=\"$item_desc\" size=\"10%\" value=\"\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></td>";
echo "<td><input type=\"text\" id=\"$rmtype\" name=\"$rmtype\" size=\"10%\" value=\"\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></td>";
echo "<td><input type=\"text\" id=\"$rmspec\" name=\"$rmspec\" size=\"8%\" value=\"\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></td>";
echo "<td><textarea id=\"$condition\" name=\"$condition\" rows=\"2\"
cols=\"20\" value=\"\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></textarea></td>";
echo "<td><input type=\"text\" id=\"$uom\" name=\"$uom\" size=\"8%\" value=\"\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></td>";
echo "<td><input type=\"text\" id=\"$dia\" name=\"$dia\" size=\"8%\"  value=\"\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></td>";
echo "<td><input type=\"text\" id=\"$length\" name=\"$length\" size=\"8%\"  value=\"\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></td>";
echo "<td><input type=\"text\" id=\"$width\" name=\"$width\" size=\"8%\" value=\"\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></td>";
echo "<td><input type=\"text\" id=\"$thickness\" name=\"$thickness\" size=\"8%\" value=\"\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></td>";
echo "<td><input type=\"text\" id=\"$gf\" name=\"$gf\" size=\"8%\"  value=\"\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></td>";
echo "<td><input type=\"text\" id=\"$maxruling\" name=\"$maxruling\" size=\"8%\" value=\"\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></td>";
echo "<td><input type=\"text\" id=\"$altspec\" name=\"$altspec\" size=\"8%\" value=\"\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></td>";
echo "<td><input type=\"text\" id=\"$drgiss\" name=\"$drgiss\" size=\"6%\" value=\"\" ></td>";
echo "<td><input type=\"text\" id=\"$partiss\" name=\"$partiss\" size=\"6%\" value=\"\" ></td>";
echo "<td><input type=\"text\" id=\"$cos_iss\" name=\"$cos_iss\" size=\"6%\" value=\"\" ></td>";
echo "<td><input type=\"text\" id=\"$model_iss\" name=\"$model_iss\" size=\"6%\" value=\"\"></td>";
echo "<td><input type=\"text\" id=\"$qty\" name=\"$qty\" size=\"6%\" value=\"\" ></td>";

if($_SESSION['department'] == 'Sales')
{
echo "<td><input type=\"text\" id=\"$price\" name=\"$price\" size=\"6%\" value=\"0\" ></td>";
echo "<td><input type=\"text\" id=\"$amount\" name=\"$amount\" size=\"7%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"\"></td>";
echo "<input type=\"hidden\" id=\"$rmprice\" name=\"$rmprice\" size=\"6%\" value=\"0\">";
echo "<input type=\"hidden\" id=\"$rmamount\" name=\"$rmamount\" style=\"background-color:#DDDDDD;\"
readonly=\"readonly\" size=\"7%\" value=\"\"></td>";
echo "<input type=\"hidden\" id=\"$mcprice\" name=\"$mcprice\" size=\"6%\" value=\"0\"></td>";
echo "<input type=\"hidden\" id=\"$mcamount\" name=\"$mcamount\" style=\"background-color:#DDDDDD;\"
readonly=\"readonly\" size=\"7%\" value=\"\">";
}else
{
echo "<input type=\"hidden\" id=\"$price\" name=\"$price\" size=\"6%\" value=\"0\" >";
echo "<input type=\"hidden\" id=\"$amount\" name=\"$amount\" size=\"7%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"\">";
echo "<input type=\"hidden\" id=\"$rmprice\" name=\"$rmprice\" size=\"6%\" value=\"0\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\">";
echo "<input type=\"hidden\" id=\"$rmamount\" name=\"$rmamount\" style=\"background-color:#DDDDDD;\"
readonly=\"readonly\" size=\"7%\" value=\"\">";
echo "<input type=\"hidden\" id=\"$mcprice\" name=\"$mcprice\" size=\"6%\" value=\"0\">";
echo "<input type=\"hidden\" id=\"$mcamount\" name=\"$mcamount\" style=\"background-color:#DDDDDD;\"
readonly=\"readonly\" size=\"7%\" value=\"\">";

}



echo "<td align=\"center\" bgcolor=\"#FFFFFF\">
<input type=\"submit\" name=\"Save\" value=\"Save\" onclick=\"javascript: return check_req_fields1('new_so','save')\">";
printf('</tr>');
$i++;
}
echo "<input type=\"hidden\" id=\"index\" name=\"index\" value=$i>";
?>


<input type="hidden" name="index" value=1>



<tr bgcolor="#FFFFFF">
<table style="width:1936px" border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
<td align="right"><span class="pageheading"><b></b></td><td width="10%"></td></tr>


<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="right">Tax</p></font></td>
<td colspan=3><input type="text" name="tax" size=10 value="0"></td>
</tr>

<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="right">Shipping</p></font></td>
<td colspan=3><input type="text" name="shipping" size=10 value="0"></td>
</tr>

<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="right">Misc</p></font></td>
<td colspan=3><input type="text" name="labor" size=10 value="0"></td>
</tr>

</table>

<!--  <td width="6"><img src="images/spacer.gif " width="6"></td>
</tr>
<tr bgcolor="DEDFDE">
<td width="6"><img src="images/box-left-bottom.gif"></td>
<td><img src="images/spacer.gif " height="6"></td>
<td width="6"><img src="images/box-right-bottom.gif"></td>
</tr> -->

</table>
<span class="labeltext"><input type="submit"
style="color=#0066CC;background-color:#DDDDDD;width=130;"
value="Submit" name="submit" onclick="javascript: return check_req_fields1('new_so','submit')">
<INPUT TYPE="RESET"
style="color=#0066CC;background-color:#DDDDDD;width=130;"
VALUE="Reset" onclick="javascript: putfocus()">

</table>
</div>

</FORM>
</body>
</html>
