<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = June 20, 2004                =
// Filename: new_invoice.php                   =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OWT                          =
// Allows entry of new invoice                 =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];

$_SESSION['pagename'] = 'newcustinvoice';
//////session_register('pagename');

// First include the class definition
include_once('classes/loginClass.php');
include('classes/invoiceClass.php');
include('classes/displayClass.php');
$newInvoice = new invoice;
$newdisplay = new display;

?>
<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/invoice.js"></script>

<html>
<head>
<title>New Cust Invoice</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">
     <form action='custinvoiceProcess.php' method='post' enctype='multipart/form-data'>
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
       				<a href="exit.php" onMouseOut="MM_swapImgRestore()"
                       onMouseOver="MM_swapImage('Image16','','images/logout_mo.gif',1)"><img name="Image16" border="0" src="images/logout.gif"></a></td>
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
	<td width="6"><img src="images/spacer.gif " width="6"></td>
 <td bgcolor="#FFFFFF">
 <table width=100% border=0 cellspacing=4 >
	<tr><td>
 <table width=100% border=0>
	<td width="100%"><span class="pageheading"><b>New Invoice</b></td>
    </table>
  <tr>
<td>

<table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=6>
 <tr bgcolor="#DDDEDD">
    <td colspan=4><span class="heading"><center><b>General Information</b></center></td>
        </tr>
  		<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
		  <tr bgcolor="#FFFFFF">
          <td  width= 15%><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Customer</p></font></td>
          <td  width= 25%><input type="text" name="company" style=";background-color:#DDDDDD;"
                    readonly="readonly" size=30 value=""> <img src="images/bu-getcustomer.gif" alt="Get Customer"
                    onclick="GetAllCustomers()">  </td>
                    <input type="hidden" name="companyrecnum" id="companyrecnum" value="">
                    <input type="hidden" name="customerponum" id="customerponum" value=""></td>
          <td  width= 15%><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Shipping Address</p></font></td>
          <td  width= 35%><input type="text" name="shippingcompany" style=";background-color:#DDDDDD;"
                    readonly="readonly" size=30 value=""> <img src="images/bu-getcustomer.gif" alt="Get Shipping"
                    onclick="GetCust4Shipping()">  </td>
			        <input type="hidden" name="shippingcompanyrecnum" id="shippingcompanyrecnum" value="">

 </table>
        <table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3>
                    <tr  bgcolor="#EEEFEE">
                        <td width= 45%><span class="heading"><center><b>Billing Address</b></center></td>
                        <td><span class="heading"><b><center>Shipping Address</center></b></td>
                     </tr>
                      <tr  bgcolor="#FFFFFF">
                          <td font = "arialblack" id="ba1" ></td>
                          <td id="sa1" ></td>
                      </tr>
                      <tr  bgcolor="#FFFFFF">
                          <td id="ba2"></td>
                          <td id="sa2"></td>

                      </tr>
                      <tr  bgcolor="#FFFFFF">
                          <td id="ba3"></td>
                          <td id="sa3"></td>
                      </tr>
            </table>
            <input type="hidden" name="invnum" size=30 value=""></td>

     <table width=100% border=0 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF" >
                <tr bgcolor="#FFFFFF">
                <tr bgcolor="#FFFFFF">
            		<td><span class="tabletext"><p align="left"><b><span class='asterisk'>*</span>Invoice Date</b></p></font></td>
                    <td><input type="text" name="invdate"   id="invdate"
                               style="background-color:#DDDDDD;"
                               readonly="readonly" size=15 value="">
                               <img src="images/bu-getdate.gif" alt="Get Invoice Date" onclick="GetDate('invdate')">
                    </td>
					<td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Due Date</p></font></td>
            		<td><input type="text" name="duedate"   id="duedate"
                               style="background-color:#DDDDDD;"
                               readonly="readonly" size=15 value="">
                               <img src="images/bu-getdate.gif" alt="Get Due Date" onclick="GetDate('duedate')">
                    </td>
     			</tr>
     			<tr bgcolor="#FFFFFF">
            		<td><span class="tabletext"><p align="left"><b>DC NO:</b></p></font></td>
                    <td><input type="text" size=30 name="dcnum" id="dcnum" value="">

                    </td>
					<td><span class="labeltext"><p align="left">DC Date</p></font></td>
            		<td><input type="text" name="dcdate"   id="dcdate"
                               style="background-color:#DDDDDD;"
                               readonly="readonly" size=15 value="">
                               <img src="images/bu-getdate.gif" alt="Get DC Date" onclick="GetDate('dcdate')">
                    </td>
     			</tr>

			     <tr bgcolor="#FFFFFF" colspan=3>
            		<td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Pre-carriage by</p></font></td>
            		<td><span class="labeltext"><input type="text" name="precarriageby" size=30 style="background-color:#DDDDDD;"
                               readonly="readonly" value="Road"></td>
            		<td><span class="labeltext"><p align="left">Pre-carrier Receipt Place</p></font></td>
            		<td><span class="labeltext"><input type="text" name="precarrierreceipt" size=30 style="background-color:#DDDDDD;"
                               readonly="readonly" value="Bangalore"></td>
     			 </tr>

				 <tr bgcolor="#FFFFFF" colspan=3>
            		<td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Country of Origin</p></font></td>
            		<td><span class="labeltext"><input type="text" name="countryoforigin" size=30  style="background-color:#DDDDDD;"
                               readonly="readonly" value="India"></td>
            		<td><span class="labeltext"><p align="left">Country of Final Destination</p></font></td>
            		<td><span class="labeltext"><input type="text" name="countryoffinaldest" size=30 style="background-color:#DDDDDD;"
                               readonly="readonly" value=""></td>
     			 </tr>
				 <tr bgcolor="#FFFFFF" colspan=3>
            		<td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Vessel/Flight No.</p></font></td>
            		<td><span class="labeltext"><input type="text" name="vessel" size=30  value="By Air"></td>
            		<td><span class="labeltext"><p align="left">Port of Loading</p></font></td>
            		<td><span class="labeltext"><input type="text" name="portofloading" size=30 value="Bangalore, India"></td>
     			 </tr>
			     <tr bgcolor="#FFFFFF" colspan=3>
            		<td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Port of Discharge</p></font></td>
            		<td><span class="labeltext"><input type="text" name="portofdischarge" size=30 style="background-color:#DDDDDD;"
                               readonly="readonly"  value=""></td>
                               	<td><span class="labeltext"><p align="left">Description</p></font></td>
            		<td ><span class="labeltext" ><input type="text" name="invdesc" size=30 value=""></td>
            	 </tr>

			     <tr bgcolor="#FFFFFF" colspan=3>
            		<td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Currency</p></font></td>
            		<td><span class="labeltext"><select name="currency" id="currency" size="1" width="100">
                   <option selected>$</option>
                   <option value>Rs</option>
				   </select></td>
            		<td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>FOB/C&F/DAP</p></font></td>
            		<td><span class="labeltext"><select name="fobcf" size="1" width="100">
                   <option value="FOB" selected>FOB</option>
                   <option value="C&F">C&F</option>
                   <option value="DAP">DAP</option>
				   </select></td>
     			 </tr>
     			 </table>
     			<table width=100% border=0 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF" >
                <tr bgcolor="#FFFFFF">
                <td><span class="labeltext"><p align="left">Remarks</p></font></td>
                <td ><textarea name="remarks" id="remarks" rows="6" cols="95"></textarea></td></tr>

        		<tr bgcolor="#FFFFFF" colspan=3>
                  <td><span class="labeltext"><p align="left">Terms</p></font></td>
                <td ><textarea name="terms" id="terms" rows="6" cols="95"></textarea></td></tr>
                  </tr>
        </table>
        <table width=100% border=0 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF" >
	 <tr bgcolor="#FFFFFF" colspan=3>
            		<td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Additional Info</p></font></td>
            		<td><span class="labeltext"><input type="text" name="advance_info" id="advance_info" size=75  value=""></td>
            		<td><span class="labeltext"><p align="left">Advance Amount</p></font></td>
            		<td><span class="labeltext"><input type="text" name="advance_amount" id="advance_amount" size=30 value=""></td>
     			 </tr>
                  </table>



               <table width=100% border=0 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF" >
                <tr bgcolor="#DDDEDD">
                    <td colspan=4><span class="heading"><center><b>Details</b></center></td>
                </tr>
                <tr bgcolor="#FFFFFF">
                <table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" id="tablemm">
                <tr>
                <td colspan=20><span class="heading"><a href="javascript:addRow('tablemm',document.forms[0].index.value)"> <img src="images/bu-addrow.gif" border="0"></a></td>
                </tr>
                <tr>
                    <td bgcolor="#EEEFEE" width=1%><span class="heading"><b><center>Seq#</center></b></td>
		            <td bgcolor="#EEEFEE" width=5%><span class="heading"><b><center>CRN</center></b></td>
		            <td bgcolor="#EEEFEE" width=15%><span class="heading"><b><center>Partnum</center></b></td>
                    <td bgcolor="#EEEFEE" width=15%><span class="heading"><b><center>Description</center></b></td>
                    <td bgcolor="#EEEFEE" width=5%><span class="heading"><b><center>CofC #</center></b></td>
                    <td bgcolor="#EEEFEE" width=5%><span class="heading"><b><center>PO No.</center></b></td>
                    <td bgcolor="#EEEFEE" width=8%><span class="heading"><b><center>PO LN.#</center></b></td>
					<td bgcolor="#EEEFEE" width=5%><span class="heading"><b><center>Schedule PO</center></b></td>
                    <td bgcolor="#EEEFEE" width=10%><span class="heading"><b><center>Raw Mtl</center></b></td>
                    <td bgcolor="#EEEFEE" width=10%><span class="heading"><b><center>Tariff Sch</center></b></td>
                    <td bgcolor="#EEEFEE" width=10%><span class="heading"><b><center>Packaging<br>(inches)</center></b></td>
                    <td bgcolor="#EEEFEE" width=3%><span class="heading"><b><center>Qty</center></b></td>
                    <td bgcolor="#EEEFEE" width=8%><span class="heading"><b><center>Type</center></b></td>
                    <td bgcolor="#EEEFEE" width=8%><span class="heading"><b><center>Price</center></b></td>
                    <td bgcolor="#EEEFEE" width=8%><span class="heading"><b><center>Amount</center></b></td>
                </tr>
<?php
      $i=1;
      while ($i<5)
     {
	printf('<tr bgcolor="#FFFFFF">');
    $line_num="line_num".$i;
	$cofc = "cofc".$i;
	$crn = "crn".$i;
	$partnum = "partnum".$i;
	//$partname = "partname" . $i;
	$item_desc = "item_desc".$i;
	$rawmtl = "rawmtl".$i;
	$tariffsch = "tariffsch".$i;
	$packaging = "packaging".$i;
	$ponum = "ponum".$i;
	$qty = "qty".$i;
	$rate = "rate".$i;
	$amount = "amount".$i;
	$type = "type".$i;
	$custporecnum = "custporecnum".$i;
	$po_qty="po_qty" . $i;
    $polinenum="polinenum" . $i;
	$schpo="schpo" . $i;
	echo "<td ><span class=\"tabletext\"><input type=\"text\"  name=\"$line_num\" id=\"$line_num\" value=\"\" size=\"2\"></td>";
    echo "<td ><input type=\"text\" name=\"$crn\" id=\"$crn\" size=\"10\"  style=\"background-color:#DDDDDD;\"
		  		readonly=\"readonly\" value=\"\"><img src=\"images/bu-get.gif\" width=\"90px\" height=\"20px\" alt=\"Get CRN\"  onclick=\"GetCRN4invoice($i)\"></td>";

    echo "<td ><input type=\"text\" name=\"$partnum\"  id=\"$partnum\" style=\"background-color:#DDDDDD;\"
		  		readonly=\"readonly\" size=\"25\" value=\"\"></td>";
	echo "<td ><input type=\"text\" name=\"$item_desc\" id=\"$item_desc\"  style=\"background-color:#DDDDDD;\"
		  		readonly=\"readonly\" size=\"25\" value=\"\">
                  </td>";
    echo "<td ><input type=\"text\" name=\"$cofc\" id=\"$cofc\" size=\"12\" value=\"\" style=\"background-color:#DDDDDD;\">
		  		<img src=\"images/bu-get.gif\" alt=\"Get CofC\"  width='80px' onclick=\"getcofc($i)\"></td>";
    echo "<td ><input type=\"text\" name=\"$ponum\" id=\"$ponum\" size=\"10\" style=\"background-color:#DDDDDD;\"
		  		readonly=\"readonly\" value=\"\"><img src=\"images/bu-getpo.gif\" alt=\"Get CustPo\" onclick=\"GetCustpo($i)\">
                  <input type=\"hidden\" name=\"$custporecnum\" id=\"$custporecnum\" value=\"\">
                  <input type=\"hidden\" name=\"$po_qty\" id=\"$po_qty\"  size=\"5\" value=\"0\"></td>";
    echo "<td ><input type=\"text\" name=\"$polinenum\" id=\"$polinenum\" size=\"5\" value=\"\"></td>";
    echo "<td ><input type=\"text\" name=\"$schpo\" id=\"$schpo\" size=\"5\" value=\"\"></td>";
    echo "<td ><input type=\"text\" name=\"$rawmtl\" id=\"$rawmtl\" size=\"15\" value=\"\"></td>";
    echo "<td ><input type=\"text\" name=\"$tariffsch\" id=\"$tariffsch\" size=\"10\" value=\"\"></td>";
    echo "<td ><input type=\"text\" name=\"$packaging\" id=\"$packaging\"  size=\"10\" value=\"\"></td>";

    echo "<td ><input type=\"text\" name=\"$qty\" id=\"$qty\" size=\"3\" value=\"\" style=\"background-color:#DDDDDD;\">";

    echo "<td ><input type=\"text\" name=\"$type\" id=\"$type\" style=\"background-color:#DDDDDD;\"
		  		readonly=\"readonly\" size=\"8\" value=\"\"></td>";
   echo "<td ><input type=\"text\" name=\"$rate\" id=\"$rate\" style=\"background-color:#DDDDDD;\"
		  		readonly=\"readonly\" size=\"8\" value=\"\"></td>";
	echo "<td><input type=\"text\" name=\"$amount\" id=\"$amount\" style=\"background-color:#DDDDDD;\"
		  		readonly=\"readonly\" size=\"15\" value=\"\"></td>";

	printf('</tr>');
	$i++;
    }
   echo "<input type=\"hidden\" name=\"index\" id=\"index\" value=$i>";
   echo "<input type=\"hidden\" name=\"curindex\" value=$i>";
 /* echo " <input type=\"hidden\" name=\"pagename\" id=\"pagename\" style=\"background-color:#DDDDDD;\"
		  		readonly=\"readonly\" size=\"15\" value=\"custinventry\">";*/
      $salestax='10%' ;
	  $shipping='10%' ;
  ?>
 
    </table>

  </td>
 <td width="6"><img src="images/spacer.gif " width="6"></td>
	<tr bgcolor="DEDFDE">
  		<td width="6"><img src="images/box-left-bottom.gif"></td>
		<td><img src="images/spacer.gif " height="6"></td>
		<td width="6"><img src="images/box-right-bottom.gif"></td>
	</tr>
 </table>
               <span class="labeltext"><input type="submit"
                     style="color=#0066CC;background-color:#DDDDDD;width=130;"
                     value="Submit" name="submit" onclick="javascript: return check_req_fields()">
                <INPUT TYPE="RESET"
                  style="color=#0066CC;background-color:#DDDDDD;width=130;"
                     VALUE="Reset" onclick="javascript: putfocus()">

</FORM>
</body>
</html>
