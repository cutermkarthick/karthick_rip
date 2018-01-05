<?php
session_start();
header("Cache-control: private");
if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];

$_SESSION['pagename'] = 'arformentry';
$page="Invoice: Arform";
////////session_register('pagename');
include('classes/displayClass.php');
//$newPO = new packing;
$newdisp = new display;
?>
<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/arform.js"></script>
<html>
<head>
<title>New AR Form</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">
<form  action='processArform.php' method='post' enctype='multipart/form-data'>
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
<td><span class="pageheading"><b>New AR Form</b></td>
</tr>
</table>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1">
<tr bgcolor="#FFFFFF">
<tr bgcolor="#EEEFEE"><td colspan=4><span class="heading"><center><b>General Information</b></center></td>
</tr>  </table>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1">
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1">
 <tr bgcolor="#FFFFFF">
          <td  width= 15%><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Customer</p></font></td>
          <td><input type="text" name="company" style=";background-color:#DDDDDD;"
                    readonly="readonly" size=30 value=""> <img src="images/bu-getcustomer.gif" alt="Get Customer"
                    onclick="GetAllCustomers()">  </td>
                    <input type="hidden" name="companyrecnum" id="companyrecnum" value="">

	       <td  width= 15%><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Ship To</p></font></td>
          <td><input type="text" name="ship2company" style=";background-color:#DDDDDD;"
                    readonly="readonly" size=30 value=""> <img src="images/bu-getcustomer.gif" alt="Get Customer"
                    onclick="GetAllShip2Customers()">  </td>
                    <input type="hidden" name="ship2companyrecnum" id="ship2companyrecnum" value="">
                    <input type="hidden" name="ship2companycategory" id="ship2companycategory" value="">

                    </tr>
<tr bgcolor="#FFFFFF">
<td width=15%><span class="labeltext"><p align="left">Invoice #</p></td>
<td ><input type="text" size=20  name="invnum" id="invnum" style=";background-color:#DDDDDD;"
                    readonly="readonly" value=""><img src="images/getinvoice.gif" alt="Get Invoice"
                    onclick="getInvoice()">
                    <input type="hidden" name="invrecnum" id="invrecnum" value=""></td>
<td width=15%><span class="labeltext"><p align="left">Invoice Date</p></td>
<td ><input type="text" id="invdate" name="invdate"
   				style="background-color:#DDDDDD;"
  				 readonly="readonly" size=20 value="">
</td>
</tr>


<tr bgcolor="#FFFFFF">

<td width=15%><span class="labeltext"><p align="left">AR3A Date</p></td>
<td ><input type="text" id="ar3adate" name="ar3adate"
   				style="background-color:#DDDDDD;"
  				 readonly="readonly" size=25 value="">
				<img src="images/bu-getdate.gif" alt="Get Date"  onclick="GetDate('ar3adate')">
</td>
<td colspan=2></td>
</tr>

<tr bgcolor="#FFFFFF">
<td width=15%><span class="labeltext"><p align="left">Pre-Carriage By</p></td>
<td colspan=3><input type="text" size=30  name="pre_carriage" id="pre_carriage" style=";background-color:#DDDDDD;"
                    readonly="readonly" value=""></td>
</tr>
<tr bgcolor="#FFFFFF">
<td width=15%><span class="labeltext"><p align="left">No. and <br>Desc On Packages</p></td>
<td><input type="text" size=30  name="nopackage" id="nopackage" style=";background-color:#DDDDDD;"
                    readonly="readonly" value=""></td>
<td width=15%><span class="labeltext"><p align="left">Gross Weight Of Packages</p></td>
<td><input type="text" size=30  name="gross_weight" id="gross_weight"
style=";background-color:#DDDDDD;" readonly="readonly"value=""></td></tr>

<tr bgcolor="#FFFFFF">
<td width=17%><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Exchange Rate U/S 14 of A</p></td>
<td><input type="text" size=30  name="exchange_rate" id="exchange_rate" value=""></td>

<td width=17%><span class="labeltext"><p align="left">Currency Of Invoice</p></td>
<td><input type="text" size=30  name="currency_in" id="currency_in" style=";background-color:#DDDDDD;"
                    readonly="readonly" value=""></td></tr>
</tr>
</table>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1">
<tr bgcolor="#DDDEDD">
                    <td colspan=4><span class="heading"><center><b>Shipping Line Items</b></center></td>
                </tr>

                <table id="myTable" width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1">
                <tr bgcolor="#FFFFFF">
                <td style="vertical-align:top">
                    <table id="myTable" width=50% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1">
                    <tr bgcolor="#FFFFFF">
                    <td bgcolor="#EEEFEE" width=1%><span class="heading"><b>Sl #</b></td>
                    <td bgcolor="#EEEFEE" width=20%><span class="heading"><b>Marks &NOS. No. & Kind<br>Of Pkgs. Container Nos.</b></td>
                    <td bgcolor="#EEEFEE" rowspan=18><img src="images/bu-getpl.gif" alt="Get Packing"  onclick="GetPacking()"></td>
                </tr>
                <tr bgcolor="#FFFFFF">
                    <td bgcolor="#EEEFEE" width=1%><span class="heading"><b>&nbsp;</b></td>
                    <td bgcolor="#EEEFEE" width=20%><span class="heading"><b>&nbsp;</b></td>
                </tr>
<?php
      $i=1;
      while ($i<17)
     {
	printf('<tr bgcolor="#FFFFFF">');
    $linenum="linenum" . $i;
	$marknum = "marknum" . $i;

	echo "<td  ><span class=\"tabletext\"><input type=\"text\"  name=\"$linenum\" id=\"$linenum\"  value=\"\" size=\"2\"></td>";
    echo "<td ><input type=\"text\" name=\"$marknum\" id=\"$marknum\" size=\"40\" style=\"background-color:#DDDDDD;\"
  				 readonly=\"readonly\" value=\"\"></td>";
	printf('</tr>');
	$i++;
    }


  ?>
  </table>
  </td>
  <td>

                  <table id="myTable" width=50% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1">
                    <tr bgcolor="#FFFFFF">
                    <td bgcolor="#EEEFEE" width=25%><span class="heading"><b>Statistical Code &<br> Description Of Goods</b></td>
					 <td bgcolor="#EEEFEE" width=5%><span class="heading"><b>Qty</b></td>
					 <td bgcolor="#EEEFEE" width=5%><span class="heading"><b>Date of first <br>Warehousing</b></td>
		            <td bgcolor="#EEEFEE" width=20%><span class="heading"><b>Value</b></td>
		            <td bgcolor="#EEEFEE" width=30% colspan=2><span class="heading"><b>Duty</b></td>
		            <td bgcolor="#EEEFEE" width=30% ><span class="heading"><b>Remarks</b></td>
		           <td bgcolor="#EEEFEE" rowspan=18><img src="images/getinvoice.gif" alt="Get Invoice"  onclick="GetInvoicedet4shipping()"></td>
                </tr>
                 <tr bgcolor="#FFFFFF">
                    <td bgcolor="#EEEFEE" width=25%><span class="heading"><b></b></td>
					 <td bgcolor="#EEEFEE" width=5%><span class="heading"><b></b></td>
					 <td bgcolor="#EEEFEE" width=5%><span class="heading"><b></b></td>
		            <td bgcolor="#EEEFEE" width=20%><span class="heading"><b id="currchange">USD</b></td>
		            <td bgcolor="#EEEFEE" width=5%><span class="heading"><b>Rate</b></td>
		            <td bgcolor="#EEEFEE" width=25%><span class="heading"><b id="change_curr">Amt Payable USD</b></td>
		            <td bgcolor="#EEEFEE" width=15%><span class="heading"><b></b></td>

                </tr>
<?php
      $j=1;$m=0; $rate_arr=array('5%','12.5%','0%','4%');
      while ($j<17)
     {
	printf('<tr bgcolor="#FFFFFF">');
 	$statnum = "statnum" . $j;
	$qty = "qty" . $j;
	$datew = "datew" . $j;
	$usd = "usd" . $j;
	$amtusd = "amtusd" . $j;
	$remarks = "remarks" . $j;
		$rate = "rate" . $j;

    echo "<td ><input type=\"text\" name=\"$statnum\" id=\"$statnum\" size=\"65\" style=\"background-color:#DDDDDD;\"
  				 readonly=\"readonly\" value=\"\"></td>";
    echo "<td ><input type=\"text\" name=\"$qty\" id=\"$qty\"  size=\"10\" style=\"background-color:#DDDDDD;\"
  				 readonly=\"readonly\" value=\"\"></td>";
    echo "<td ><input type=\"text\" id=\"$datew\" name=\"$datew\"
   				style=\"background-color:#DDDDDD;\"
  				 readonly=\"readonly\" size=6 value=\"\">
				<img src=\"images/bu-getdateicon.gif\" alt=\"Get Date\"  onclick=\"GetDate('$datew')\">";
    echo "<td ><input type=\"text\" name=\"$usd\" id=\"$usd\"  size=\"10\" style=\"background-color:#DDDDDD;\"
  				 readonly=\"readonly\" value=\"\"></td>";
    echo "<td ><input type=\"text\" name=\"$rate\" id=\"$rate\"  size=\"5\" style=\"background-color:#DDDDDD;\"
  				 readonly=\"readonly\" value=\"$rate_arr[$m]\"></td>";
	echo "<td ><input type=\"text\" name=\"$amtusd\" id=\"$amtusd\" size=\"20\" style=\"background-color:#DDDDDD;\"
  				 readonly=\"readonly\" value=\"\"></td>";
	echo "<td ><input type=\"text\" name=\"$remarks\" id=\"$remarks\" size=\"30\"  value=\"\"></td>";
	printf('</tr>');
	$j++;  $m++;
    }
   echo "<input type=\"hidden\" name=\"index\" value=$i>";
   echo "<input type=\"hidden\" name=\"curindex\" value=$i>";

  ?>
   <tr bgcolor="#FFFFFF">
<td ><span class="labeltext"><p align="left">Total</p></td>
<td><input type="text" size=10  name="tot_qty" id="tot_qty" style="background-color:#DDDDDD;"
  				 readonly="readonly" value=""></td>
<td><span id="total_currchange" class="labeltext">Total USD</span></td>
<td><input type="text" size=10  name="tot_amt" id="tot_amt" style="background-color:#DDDDDD;"
  				 readonly="readonly" value=""></td>
<td colspan=1><span id="total_curr_change" class="labeltext">Total USD</span></td>
<td colspan=3><input type="text" size=10  name="tot_payableamt" style="background-color:#DDDDDD;"
  				 readonly="readonly" id="tot_payableamt" value="">
</td></tr>

<tr bgcolor="#FFFFFF">
<td colspan=2>&nbsp;</td>
<td><span id="total_currchange" class="labeltext">Subtotal + Vat </span></td>
<td colspan=5><input type="text" size=10  name="vatsubtotal" id="vatsubtotal" style="background-color:#DDDDDD;"
           readonly="readonly" value=""></td>
 </tr>          

<tr bgcolor="#FFFFFF">
<td colspan=2>&nbsp;</td>
<td ><span class="labeltext"><p align="left">Total(Rupees)</p></td>
<td colspan=5><input type="text" size=10  name="tot_amt_rs" id="tot_amt_rs" style="background-color:#DDDDDD;"
  				 readonly="readonly" value=""></td></tr>
  </table>
  </td>
  </tr>
  </table>

<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1">
<tr bgcolor="#FFFFFF">
<td width=17%><span class="labeltext"><p align="left">Value In Words</p></span></td>
<td colspan=3><input type="text" size=75  name="fob_inwords" style="background-color:#DDDDDD;"
  				 readonly="readonly" id="fob_inwords" value=""></td>
<td width=17%><span class="labeltext"><p align="left">Duty In Words</p></span></td>
<td colspan=3><input type="text" size=75  name="duty_inwords" style="background-color:#DDDDDD;"
  				 readonly="readonly" id="duty_inwords" value=""></td>
</tr>
</table>
</table>
<!--   </td>
 <td width="6"><img src="images/spacer.gif " width="6"></td>
	<tr bgcolor="DEDFDE">
  		<td width="4"><img src="images/box-left-bottom.gif"></td>
		<td><img src="images/spacer.gif " height="6"></td>
		<td width="4"><img src="images/box-right-bottom.gif"></td>
	</tr> -->
 </table>
               <span class="labeltext"><input type="submit"
                     style="color=#0066CC;background-color:#DDDDDD;width=130;"
                     value="Submit" name="submit" onclick="javascript: return check_req_fields()">
                <INPUT TYPE="RESET"
                  style="color=#0066CC;background-color:#DDDDDD;width=130;"
                     VALUE="Reset" >

</FORM>
</body>
</html>
