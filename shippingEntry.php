<?php
session_start();
header("Cache-control: private");
if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];

$_SESSION['pagename'] = 'shippingentry';
$page = "Invoice: Excise";
//////session_register('pagename');
include('classes/displayClass.php');
//$newPO = new packing;
$newdisp = new display;
?>
<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/shipping.js"></script>
<html>
<head>
<title>New Shipping</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">
<form  action='shippingProcess.php' method='post' enctype='multipart/form-data'>
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
<td width="6"><img src="images/spacer.gif" width="6"></td>
<td bgcolor="#FFFFFF">
<table width=100% border=0 cellpadding=6 cellspacing=0>
<tr><td> -->
<table width=100% border=0>
<tr>
<td><span class="pageheading"><b>New Shipping</b></td>
</tr>
</table>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1">
<tr bgcolor="#FFFFFF">
<tr bgcolor="#EEEFEE"><td colspan=4><span class="heading"><center><b>General Information</b></center></td>
</tr>  </table>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1">
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1">

<tr bgcolor="#FFFFFF">
<td width=15%><span class="labeltext"><p align="left">Invoice #</p></td>
<td ><input type="text" size=20  name="invnum" id="invnum" style=";background-color:#DDDDDD;"
                    readonly="readonly" value=""><img src="images/getinvoice.gif" alt="Get Invoice"
                    onclick="getInvoice()"></td>
<td width=15%><span class="labeltext"><p align="left">Invoice Date</p></td>
<td ><input type="text" id="invdate" name="invdate"
   				style="background-color:#DDDDDD;"
  				 readonly="readonly" size=20 value="">
</td>
</tr>

<tr bgcolor="#FFFFFF">
<td width=15%><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Exporter</p></font></td>
<td ><input type="text" name="company" id="company" style=";background-color:#DDDDDD;"
                    readonly="readonly" size=30 value=""></td>
                    <input type="hidden" name="inv2customer" id="inv2customer" value=""></td>
</td>
<td width=15%><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Ship To</p></font></td>
<td ><input type="text" name="shipcompany" id="shipcompany" style=";background-color:#DDDDDD;"
                    readonly="readonly" size=30 value=""></td>
                    <input type="hidden" name="ship2customer" id="ship2customer" value=""></td>
                    <input type="hidden" name="invrecnum" id="invrecnum" value=""></td>
</td>
</tr>
<tr bgcolor="#FFFFFF">
<td width=15%><span class="labeltext"><p align="left">AR4A #</p></td>
<td ><input type="text" size=30  name="ar4anum" id="ar4anum" value=""></td>
<td width=15%><span class="labeltext"><p align="left">AR4A Date</p></td>
<td ><input type="text" id="ar4adate" name="ar4adate"
   				style="background-color:#DDDDDD;"
  				 readonly="readonly" size=25 value="">
				<img src="images/bu-getdate.gif" alt="Get Date"  onclick="GetDate('ar4adate')">
</td>
</tr>
<tr bgcolor="#FFFFFF">
<!--<td width=15%><span class="labeltext"><p align="left">SB #</p></td>-->
<input type="hidden" size=30  name="sbnum" id="sbnum" value="">
<td><span class="labeltext"><p align="left">SB Date</p></td>
<td><input type="text" id="sbdate" name="sbdate"
   				style="background-color:#DDDDDD;"
  				 readonly="readonly" size=25 value="">
				<img src="images/bu-getdate.gif" alt="Get Date"  onclick="GetDate('sbdate')">
</td>
<td colspan=2><span class="labeltext"><p align="left">&nbsp</p></td>

</tr>
<tr bgcolor="#FFFFFF">
<td width=15%><span class="labeltext"><p align="left">Q/Cert #</p></td>
<td ><input type="text" size=30  name="qcert" id="qcert" value=""></td>
<td width=15%><span class="labeltext"><p align="left">Q/Cert Date</p></td>
<td ><input type="text" id="qcertdate" name="qcertdate"
   				style="background-color:#DDDDDD;"
  				 readonly="readonly" size=25 value="">
				<img src="images/bu-getdate.gif" alt="Get Date"  onclick="GetDate('qcertdate')">
</td>
</tr>
<tr bgcolor="#FFFFFF">
<td width=15%><span class="labeltext"><p align="left">Import Export Code #</p></td>
<td ><input type="text" size=30  name="impcode" id="impcode" value="0797004271"></td>
<td width=15%><span class="labeltext"><p align="left">RBI Code #</p></td>
<td ><input type="text" size=30  name="rbicode" id="rbicode" value=""></td>
</tr>

<tr bgcolor="#FFFFFF">
<td width=15%><span class="labeltext"><p align="left">Custom House Agent</p></td>
<td><span class="labeltext"><select name="custome_house_agent" id="custome_house_agent" size="1" width="100">
                   <option selected>JEENA&Co AAAFJ1721HCH054</option>
                   <option value>KUEHNE&NAGEL PVT Ltd. AAACK2676HCH012</option>
                   <option value>SCHENKER INDIA PVT Ltd. AAACB0697BCH003</option>
                   <option value>SRIVALLI SHIPPING&Tpt AAIF520718C4008</option>
                   <option value>CAPITAL SHIPPING PVT LTD AABCC1595N</option>
                   <option value>EXPO Freight Pvt. Ltd. AAACE2126JCH005</option>
                   <option value>DACHSER India Private Limited-AAACCA7791DCH009</option>
				   </select></td>
<td width=15%><span class="labeltext"><p align="left">LIC NO.</p></td>
<td><input type="text" size=30  name="lic_no" id="lic_no" value=""></td>
</tr>
<tr bgcolor="#FFFFFF">
<td width=15%><span class="labeltext"><p align="left">Pre-Carriage By</p></td>
<td><input type="text" size=30  name="pre_carriage" id="pre_carriage" style=";background-color:#DDDDDD;"
                    readonly="readonly" value=""></td>
<td width=15%><span class="labeltext"><p align="left">Place Of Receipt<br>By Pre-Carrier</p></td>
<td><input type="text" size=30  name="place_receipt" id="place_receipt" style=";background-color:#DDDDDD;"
                    readonly="readonly" value=""></td>
</tr>
<tr bgcolor="#FFFFFF">
<td width=15%><span class="labeltext"><p align="left">Vessel/Flight No.</p></td>
<td><input type="text" size=30  name="vesselnum" id="vesselnum" style=";background-color:#DDDDDD;"
                    readonly="readonly" value=""></td>
<td width=15%><span class="labeltext"><p align="left">Rotating No.</p></td>
<td><input type="text" size=30  name="rotatingnum" id="rotatingnum" value=""></td></tr>
<tr bgcolor="#FFFFFF">
<td width=15%><span class="labeltext"><p align="left">Port Of Loading</p></td>
<td colspan=3><input type="text" size=30  name="port_loading" id="port_loading" style=";background-color:#DDDDDD;"
                    readonly="readonly" value=""></td>
</tr>
<tr bgcolor="#FFFFFF">
<td width=15%><span class="labeltext"><p align="left">Port Of Discharge</p></td>
<td><input type="text" size=30  name="port_discharge" id="port_discharge" style=";background-color:#DDDDDD;"
                    readonly="readonly" value=""></td>
<td width=15%><span class="labeltext"><p align="left">Country Of Destination</p></td>
<td><input type="text" size=30  name="country_desti" id="country_desti"style=";background-color:#DDDDDD;"
                    readonly="readonly" value=""></td></tr>
</table>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1">
<tr bgcolor="#FFFFFF">
<td rowspan=2 width=15%><span class="labeltext"><p align="left">Export Trade Control</p></td>
<td><span class="labeltext"><p align="left">If Export Under<br> Deffered Credit</p></td>
<td><span class="labeltext"><p align="left">Joint Ventures</p></td>
<td><span class="labeltext"><p align="left">Rupee Credit</p></td>
<td><span class="labeltext"><p align="left">Others</p></td>
<td><span class="labeltext"><p align="left">RBI's Approval<br>/CIR. No.</p></td>
<td><span class="labeltext"><p align="left">RBI's Approval Date</p></td>
</tr>

<tr bgcolor="#FFFFFF">
<td><input type="text" size=10  name="deffcredit" id="deffcredit"></td>
<td><input type="radio" name="chk11" id="chk11" onclick="JavaScript:toggleValue('jointven',this);">
                         <input type="hidden" name="jointven" value="no" id="jointven"></td>
<td><input type="radio" name="chk12" id="chk12" onclick="JavaScript:toggleValue('rucredit',this);">
                         <input type="hidden" name="rucredit" value="no" id="rucredit"></td>
<td><input type="radio" name="chk13" id="chk13" onclick="JavaScript:toggleValue('others_ex',this);">
                         <input type="hidden" name="others_ex" value="no" id="others_ex"></td>
<td><input type="text" size=30  name="rbiapp" id="rbiapp"></td>
<td ><input type="text" id="rbiappdate" name="rbiappdate"
   				style="background-color:#DDDDDD;"
  				 readonly="readonly" size=20 value="">
				<img src="images/bu-getdate.gif" alt="Get Date"  onclick="GetDate('rbiappdate')">
</td>
</tr>
<tr bgcolor="#FFFFFF">
<td rowspan=2 width=15%><span class="labeltext"><p align="left">Type Of Shipment</p></td>
<td><span class="labeltext"><p align="left">Outright Sale</p></td>
<td><span class="labeltext"><p align="left">Consignment Export</p></td>
<td colspan=6><span class="labeltext"><p align="left">Others(Specify)</p></td>
</tr>

<tr bgcolor="#FFFFFF">
<td><input type="radio" name="chk21" id="chk21" onclick="JavaScript:toggleValue('outrightsale',this);">
                         <input type="hidden" name="outrightsale" value="no" id="outrightsale"></td>
<td><input type="radio" name="chk22" id="chk22" onclick="JavaScript:toggleValue('conexp',this);">
                         <input type="hidden" name="conexp"  value="no" id="conexp"></td>
<td colspan=6><input type="radio" name="chk23" id="chk23" onclick="JavaScript:toggleValue('other_sh',this);">
                         <input type="hidden" name="other_sh" value="no"  id="other_sh"></td>
</tr>
</table>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1">

<tr bgcolor="#FFFFFF">
<td rowspan=2 width=15%><span class="labeltext"><p align="left">Nature Of Contract</p></td>
<td><span class="labeltext"><p align="left">CF</p></td>
<td><span class="labeltext"><p align="left">CFR</p></td>
<td><span class="labeltext"><p align="left">FOB</p></td>
<td><span class="labeltext"><p align="left">Others(Specify)</p></td>
</tr>

<tr bgcolor="#FFFFFF">
<td><input type="radio" name="chk1" id="chk1" onclick="JavaScript:toggleValue('cf',this);">
                         <input type="hidden" name="cf" value="no" id="cf"></td>
<td><input type="radio" name="chk2" id="chk2" onclick="JavaScript:toggleValue('cfr',this);">
                         <input type="hidden" name="cfr"  value="no" id="cfr"></td>
<td><input type="radio" name="chk3" id="chk3" onclick="JavaScript:toggleValue('fob',this);">
                         <input type="hidden" name="fob" value="no"  id="fob"></td>
<td><input type="text" size=30  name="other_cont" id="other_cont" value=""></td>
</tr>
</table>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1">
<tr bgcolor="#FFFFFF">
<td width=17%><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Exchange Rate U/S 14 of A</p></td>
<td><input type="text" size=30  name="exchange_rate" id="exchange_rate" value=""></td>

<td width=17%><span class="labeltext"><p align="left">Currency Of Invoice</p></td>
<td><input type="text" size=30  name="currency_in" id="currency_in" style=";background-color:#DDDDDD;"
                    readonly="readonly" value=""></td></tr>
</tr>
<tr bgcolor="#DDDEDD">
                    <td colspan=4><span class="heading"><center><b>Shipping Line Items</b></center></td>
                </tr>

                <table id="myTable" width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1">
                <tr bgcolor="#FFFFFF">
                <td>
                    <table id="myTable" width=50% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1">
                    <tr bgcolor="#FFFFFF">
                    <td bgcolor="#EEEFEE" width=1%><span class="heading"><b>Sl #</b></td>
                    <td bgcolor="#EEEFEE" width=20%><span class="heading"><b>Marks &NOS. No. & Kind<br>Of Pkgs. Container Nos.</b></td>
                    <td bgcolor="#EEEFEE" rowspan=11><img src="images/bu-getpl.gif" alt="Get Packing"  onclick="GetPacking()"></td>
                </tr>
<?php
      $i=1;
      while ($i<17)
     {
	printf('<tr bgcolor="#FFFFFF">');
    $linenum="linenum" . $i;
	$marknum = "marknum" . $i;

	echo "<td  ><span class=\"tabletext\"><input type=\"text\"  name=\"$linenum\" id=\"$linenum\" value=\"\" size=\"2\"></td>";
    echo "<td ><input type=\"text\" name=\"$marknum\" id=\"$marknum\" size=\"40\" value=\"\"></td>";
	printf('</tr>');
	$i++;
    }


  ?>
  </table>
  </td>
  <td>

                  <table id="myTable" width=50% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF"  class="stdtable1">
                    <tr bgcolor="#FFFFFF">
                    <td bgcolor="#EEEFEE" width=25%><span class="heading"><b>Statistical Code &<br> Description Of Goods</b></td>
					 <td bgcolor="#EEEFEE" width=5%><span class="heading"><b>Qty</b></td>
		            <td bgcolor="#EEEFEE" width=20%><span class="heading"><b>Value Of FOB</b></td>
		           <td bgcolor="#EEEFEE" rowspan=11><img src="images/getinvoice.gif" alt="Get Date"  onclick="GetInvoicedet4shipping()"></td>
                </tr>
<?php
      $j=1;
      while ($j<17)
     {
	printf('<tr bgcolor="#FFFFFF">');
 	$statnum = "statnum" . $j;
	$qty = "qty" . $j;
	$vfob = "vfob" . $j;
    echo "<td ><input type=\"text\" name=\"$statnum\" id=\"$statnum\" size=\"65\" value=\"\"></td>";
    echo "<td ><input type=\"text\" name=\"$qty\" id=\"$qty\"  size=\"10\" value=\"\"></td>";
	echo "<td ><input type=\"text\" name=\"$vfob\" id=\"$vfob\" size=\"20\" value=\"\"></td>";
	printf('</tr>');
	$j++;
    }
   echo "<input type=\"hidden\" name=\"index\" value=$i>";
   echo "<input type=\"hidden\" name=\"curindex\" value=$i>";

  ?>
  </table>
  </td>
  </tr>
  </table>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1">
<tr bgcolor="#FFFFFF">
<td width=15%><span class="labeltext"><p align="left">Net Weight</p></td>
<td><input type="text" size=30  name="net_weight" id="net_weight" value=""></td>

<td width=15%><span class="labeltext"><p align="left">Gross Weight</p></td>
<td><input type="text" size=30  name="gross_weight" id="gross_weight" value=""></td></tr>
</tr>
<tr bgcolor="#FFFFFF">
<td width=17%><span class="labeltext"><p align="left">Total FOB Value In Words</p></span></td>
<td colspan=3><input type="text" size=100  name="fob_inwords" id="fob_inwords" value=""></td></tr>
<tr bgcolor="#DDDEDD">
                    <td colspan=4><span class="heading"><center><b>Analysis Of Export Value</b></center></td>
                </tr>
                </table>
                <table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1">
                <tr bgcolor="#FFFFFF">
                <td bgcolor="#EEEFEE" width=5%><span class="heading"><b>&nbsp;</td>
                <td bgcolor="#EEEFEE" width=5%><span class="heading"><b>&nbsp;</td>
		            <td bgcolor="#EEEFEE" width=5%><span class="heading"><b>Currency</b></td>
					 <td bgcolor="#EEEFEE" width=5%><span class="heading"><b>Amount-INR</b></td>
                </tr>
                <tr bgcolor="#FFFFFF">
                <td bgcolor="#FFFFFF" width=5%><span class="heading"><b>FOB value</td>
                <td><input type="text" size=10  name="fob_value" id="fob_value" value=""></td>
                <td><input type="text" size=10  name="fob_cur" id="fob_cur" value=""></td>
                <td><input type="text" size=10  name="fob_inr" id="fob_inr" value=""></td>
                </tr>
                <tr bgcolor="#FFFFFF">
                <td bgcolor="#FFFFFF" width=5%><span class="heading"><b>Freight</td>
                <td><input type="text" size=10  name="freight_value" id="freight_value" value=""></td>
                <td><input type="text" size=10  name="freight_cur" id="freight_cur" value=""></td>
                <td><input type="text" size=10  name="freight_inr" id="freight_inr" value=""></td>
                </tr>
                <tr bgcolor="#FFFFFF">
                <td bgcolor="#FFFFFF" width=5%><span class="heading"><b>Insurance</td>
                <td><input type="text" size=10  name="insurance_value" id="insurance_value" value=""></td>
                <td><input type="text" size=10  name="insurance_cur" id="insurance_cur" value=""></td>
                <td><input type="text" size=10  name="insurance_inr" id="insurance_inr" value=""></td>
                </tr>
                <tr bgcolor="#FFFFFF">
                <td bgcolor="#FFFFFF" width=5%><span class="heading"><b>Commission</td>
                <td><input type="text" size=10  name="commission_value" id="commission_value" value=""></td>
                <td><input type="text" size=10  name="commission_cur" id="commission_cur" value=""></td>
                <td><input type="text" size=10  name="commission_inr" id="commission_inr" value=""></td>
                </tr>
                <tr bgcolor="#FFFFFF">
                <td bgcolor="#FFFFFF" width=5%><span class="heading"><b>Discount</td>
                <td><input type="text" size=10  name="discount_value" id="discount_value" value=""></td>
                <td><input type="text" size=10  name="discount_cur" id="discount_cur" value=""></td>
                <td><input type="text" size=10  name="discount_inr" id="discount_inr" value=""></td>
                </tr>
                <tr bgcolor="#FFFFFF">
                <td bgcolor="#FFFFFF" width=5%><span class="heading"><b>Other</td>
                <td><input type="text" size=10  name="other_value" id="other_value" value=""></td>
                <td><input type="text" size=10  name="other_cur" id="other_cur" value=""></td>
                <td><input type="text" size=10  name="other_inr" id="other_inr" value=""></td>
                </tr>
                <tr bgcolor="#FFFFFF">
                <td bgcolor="#FFFFFF" width=5%><span class="heading"><b>Deductions</td>
                <td><input type="text" size=10  name="deduction_value" id="deduction_value" value=""></td>
                <td><input type="text" size=10  name="deduction_cur" id="deduction_cur" value=""></td>
                <td><input type="text" size=10  name="deduction_inr" id="deduction_inr" value=""></td>
                </tr>
</table>
</table>
  </td>
<!--  <td width="6"><img src="images/spacer.gif " width="6"></td>
	<tr bgcolor="DEDFDE">
  		<td width="4"><img src="images/box-left-bottom.gif"></td>
		<td><img src="images/spacer.gif " height="6"></td>
		<td width="4"><img src="images/box-right-bottom.gif"></td>
	</tr>-->
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
