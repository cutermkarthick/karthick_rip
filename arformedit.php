<?php
session_start();
header("Cache-control: private");
if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];
$recnum=$_REQUEST['arrecnum'];
$invrecnum=$_REQUEST['link2invoice'];
$_SESSION['pagename'] = 'arformedit';
////////session_register('pagename');
include('classes/displayClass.php');
include('classes/arformClass.php');
//$newPO = new packing;
$newdisp = new display;
$newarform = new arform;

$result_ar= $newarform->getardetails($recnum);
$myarform =mysql_fetch_assoc($result_ar);
$result= $newarform->getinvoicedetails($myarform['link2invoice']);
$myinvoice=mysql_fetch_assoc($result);
$resultli=$newarform->getarformlidetails($recnum);
$resultli_s=$newarform->getarformlidetails($recnum);

?>
<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/arform.js"></script>
<html>
<head>
<title>Edit AR Form</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">
<form  action='processArform.php' method='post' enctype='multipart/form-data'>
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
<td width="6"><img src="images/spacer.gif" width="6"></td>
<td bgcolor="#FFFFFF">
<table width=100% border=0 cellpadding=6 cellspacing=0>
<tr><td>
<table width=100% border=0>
<tr>
<td><span class="pageheading"><b>Edit AR Form</b></td>
</tr>
</table>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
<tr bgcolor="#FFFFFF">
<tr bgcolor="#EEEFEE"><td colspan=4><span class="heading"><center><b>General Information</b></center></td>
</tr>  </table>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
 <tr bgcolor="#FFFFFF">
          <td  width= 15%><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Customer</p></font></td>
          <td><input type="text" name="company" style=";background-color:#DDDDDD;"
                    readonly="readonly" size=30 value="<?php echo $myinvoice["name"]  ?>"> <img src="images/bu-getcustomer.gif" alt="Get Customer"
                    onclick="GetAllCustomers()">  </td>
                    <input type="hidden" name="companyrecnum" id="companyrecnum" value="<?php echo $myinvoice["inv2customer"]  ?>">
                    <input type="hidden" name="arrecnum" id="arrecnum" value="<?php echo $recnum ?>">
		  <td  width= 15%><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Ship to</p></font></td>
          <td><input type="text" name="ship2company" style=";background-color:#DDDDDD;"
                    readonly="readonly" size=30 value="<?php echo $myarform["name"]  ?>"> <img src="images/bu-getcustomer.gif" alt="Get Customer"
                    onclick="GetAllShip2Customers()">  </td>
                    <input type="hidden" name="ship2companyrecnum" id="ship2companyrecnum" value="<?php echo $myarform["link2ship"]  ?>">
					<input type="hidden" name="ship2companycategory" id="ship2companycategory" value="">

                    </tr>
<tr bgcolor="#FFFFFF">
<td width=15%><span class="labeltext"><p align="left">Invoice #</p></td>
<td ><input type="text" size=20  name="invnum" id="invnum" style=";background-color:#DDDDDD;"
                    readonly="readonly" value="<?php echo $myinvoice["invnum"] ?>"><img src="images/getinvoice.gif" alt="Get Invoice"
                    onclick="getInvoice()">
                    <input type="hidden" name="invrecnum" id="invrecnum" value="<?php echo $myinvoice["recnum"] ?>"></td>
<td width=15%><span class="labeltext"><p align="left">Invoice Date</p></td>
<td ><input type="text" id="invdate" name="invdate"
   				style="background-color:#DDDDDD;"
  				 readonly="readonly" size=20 value="<?php echo $myinvoice["invdate"] ?>">
</td>
</tr>


<tr bgcolor="#FFFFFF">
<td width=15%><span class="labeltext"><p align="left">AR3A #</p></td>
<td ><input type="text" size=30  name="ar3anum" id="ar3anum" style="background-color:#DDDDDD;"
  				 readonly="readonly" value="<?php echo $myarform["ar3anum"] ?>"></td>
<td width=15%><span class="labeltext"><p align="left">AR3A Date</p></td>
<td ><input type="text" id="ar3adate" name="ar3adate"
   				style="background-color:#DDDDDD;"
  				 readonly="readonly" size=25 value="<?php echo $myarform["ar3adate"] ?>">
				<img src="images/bu-getdate.gif" alt="Get Date"  onclick="GetDate('ar3adate')">
</td>
</tr>

<tr bgcolor="#FFFFFF">
<td width=15%><span class="labeltext"><p align="left">Pre-Carriage By</p></td>
<td colspan=3><input type="text" size=30  name="pre_carriage" id="pre_carriage" style=";background-color:#DDDDDD;"
                    readonly="readonly" value="<?php echo $myinvoice["precarriageby"]  ?>"></td>
</tr>
<tr bgcolor="#FFFFFF">
<td width=15%><span class="labeltext"><p align="left">No. and <br>Desc On Packages</p></td>
<td><input type="text" size=30  name="nopackage" id="nopackage" style=";background-color:#DDDDDD;"
                    readonly="readonly" value="<?php echo $myarform["numpkgs"]  ?>"></td>
<td width=15%><span class="labeltext"><p align="left">Gross Weight Of Packages</p></td>
<td><input type="text" size=30  name="gross_weight" id="gross_weight"
style=";background-color:#DDDDDD;" readonly="readonly"value="<?php echo $myarform["grosswt"]  ?>"></td></tr>

<tr bgcolor="#FFFFFF">
<td width=17%><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Exchange Rate U/S 14 of A</p></td>
<td><input type="text" size=30  name="exchange_rate" id="exchange_rate" value="<?php echo $myarform["exchangerate"]  ?>"></td>

<td width=17%><span class="labeltext"><p align="left">Currency Of Invoice</p></td>
<td><input type="text" size=30  name="currency_in" id="currency_in" style=";background-color:#DDDDDD;"
                    readonly="readonly" value="<?php echo $myinvoice["currency"]  ?>"></td></tr>
</tr>
</table>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
<tr bgcolor="#DDDEDD">
                    <td colspan=4><span class="heading"><center><b>Shipping Line Items</b></center></td>
                </tr>

                <table id="myTable" width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
                <tr bgcolor="#FFFFFF">
                <td valign="top">
                    <table id="myTable" width=50% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
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
      $i=1; $flag=0;
      while ($i<17)
     {
     if($flag==0)
     {
       while($myLI = mysql_fetch_row($resultli))
       {
         printf('<tr bgcolor="#FFFFFF">');
         $linenum="linenum" . $i;
	     $marknum = "marknum" . $i;
	     	$prevlinenum="prev_line_num" . $i;
    $lirecnum="lirecnum" . $i;

	   echo "<td  ><span class=\"tabletext\"><input type=\"text\"  name=\"$linenum\" id=\"$linenum\"  value=\"$myLI[10]\" size=\"2\"></td>";
       echo "<td ><input type=\"text\" name=\"$marknum\" id=\"$marknum\" size=\"40\" style=\"background-color:#DDDDDD;\"
  				 readonly=\"readonly\" value=\"$myLI[3]\"></td>";
       echo "<input type=\"hidden\" name=\"$prevlinenum\" value=\"$myLI[1]\">";
	echo "<input type=\"hidden\" name=\"$lirecnum\" value=\"$myLI[0]\">";
	printf('</tr>');
       $i++;
    }
    $flag=1;
     }
	printf('<tr bgcolor="#FFFFFF">');
    $linenum="linenum" . $i;
	$marknum = "marknum" . $i;
	$prevlinenum="prev_line_num" . $i;
    $lirecnum="lirecnum" . $i;


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

                  <table id="myTable" width=50% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
                    <tr bgcolor="#FFFFFF">
                    <td bgcolor="#EEEFEE" width=25%><span class="heading"><b>Statistical Code &<br> Description Of Goods</b></td>
					 <td bgcolor="#EEEFEE" width=5%><span class="heading"><b>Qty</b></td>
					 <td bgcolor="#EEEFEE" width=5%><span class="heading"><b>Date of first<br> Warehousing</b></td>
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
      $n=0;$j=1;$m=0; $rate_arr=array('5%','12.5%','0%','4%');  $flag_1=0;
      while ($j<17)
     {
     if($flag_1==0)
     {
       while($myLI_s = mysql_fetch_row($resultli_s))
       {
        printf('<tr bgcolor="#FFFFFF">');
 	    $statnum = "statnum" . $j;
	    $qty = "qty" . $j;
	    $datew = "datew" . $j;
	    $usd = "usd" . $j;
	    $amtusd = "amtusd" . $j;
	    $remarks = "remarks" . $j;
	    	$prevlinenum="prev_line_num" . $j;
    $lirecnum="lirecnum" . $j;
    $rate="rate" . $j;

    echo "<td ><input type=\"text\" name=\"$statnum\" id=\"$statnum\" size=\"65\" style=\"background-color:#DDDDDD;\"
  				 readonly=\"readonly\" value=\"$myLI_s[2]\"></td>";
    echo "<td ><input type=\"text\" name=\"$qty\" id=\"$qty\"  size=\"10\" style=\"background-color:#DDDDDD;\"
  				 readonly=\"readonly\" value=\"$myLI_s[4]\"></td>";
    echo "<td ><input type=\"text\" id=\"$datew\" name=\"$datew\"
   				style=\"background-color:#DDDDDD;\"
  				 readonly=\"readonly\" size=6 value=\"$myLI_s[5]\">
				<img src=\"images/bu-getdateicon.gif\" alt=\"Get Date\"  onclick=\"GetDate('$datew')\">";
    echo "<td ><input type=\"text\" name=\"$usd\" id=\"$usd\"  size=\"10\" style=\"background-color:#DDDDDD;\"
  				 readonly=\"readonly\" value=\"$myLI_s[6]\"></td>";
    echo "<td ><input type=\"text\" name=\"$rate\" id=\"$rate\"  size=\"5\" style=\"background-color:#DDDDDD;\"
  				 readonly=\"readonly\" value=\"$rate_arr[$m]\"></td>";
	echo "<td ><input type=\"text\" name=\"$amtusd\" id=\"$amtusd\" size=\"15\" style=\"background-color:#DDDDDD;\"
  				 readonly=\"readonly\" value=\"$myLI_s[8]\"></td>";
	echo "<td ><input type=\"text\" name=\"$remarks\" id=\"$remarks\" size=\"30\" value=\"$myLI_s[9]\"></td>";
	echo "<input type=\"hidden\" name=\"$prevlinenum\" value=\"$myLI_s[1]\">";
	echo "<input type=\"hidden\" name=\"$lirecnum\" value=\"$myLI_s[0]\">";
	printf('</tr>');
	$j++;  $m++;
    }
    $flag_1=1;
       }

	printf('<tr bgcolor="#FFFFFF">');
 	$statnum = "statnum" . $j;
	$qty = "qty" . $j;
	$datew = "datew" . $j;
	$usd = "usd" . $j;
	$amtusd = "amtusd" . $j;
	$remarks = "remarks" . $j;
	$prevlinenum="prev_line_num" . $j;
    $lirecnum="lirecnum" . $j;
    $rate="rate" . $j;

    echo "<td ><input type=\"text\" name=\"$statnum\" id=\"$statnum\" size=\"65\" style=\"background-color:#DDDDDD;\"
  				 readonly=\"readonly\"value=\"\"></td>";
    echo "<td ><input type=\"text\" name=\"$qty\" id=\"$qty\"  size=\"10\" style=\"background-color:#DDDDDD;\"
  				 readonly=\"readonly\"value=\"\"></td>";
    echo "<td ><input type=\"text\" id=\"$datew\" name=\"$datew\"
   				style=\"background-color:#DDDDDD;\"
  				 readonly=\"readonly\" size=6 value=\"\">
				<img src=\"images/bu-getdateicon.gif\" alt=\"Get Date\"  onclick=\"GetDate('$datew')\">";
    echo "<td ><input type=\"text\" name=\"$usd\" id=\"$usd\"  size=\"10\" style=\"background-color:#DDDDDD;\"
  				 readonly=\"readonly\"value=\"\"></td>";
    echo "<td ><input type=\"text\" name=\"$rate\" id=\"$rate\"  size=\"5\" style=\"background-color:#DDDDDD;\"
  				 readonly=\"readonly\" value=\"\"></td>";
	echo "<td ><input type=\"text\" name=\"$amtusd\" id=\"$amtusd\" style=\"background-color:#DDDDDD;\"
  				 readonly=\"readonly\" size=\"15\" value=\"\"></td>";
	echo "<td ><input type=\"text\" name=\"$remarks\" id=\"$remarks\" size=\"30\"  value=\"\"></td>";
	printf('</tr>');
	$j++;  $n++;
    }
   echo "<input type=\"hidden\" name=\"index\" value=$i>";
   echo "<input type=\"hidden\" name=\"curindex\" value=$i>";


  ?>
   <tr bgcolor="#FFFFFF">
<td ><span class="labeltext"><p align="left">Total</p></td>
<td><input type="text" size=10  name="tot_qty" id="tot_qty" style="background-color:#DDDDDD;"
  				 readonly="readonly" value="<?php echo $myarform["totqty"]  ?>"></td>
<td><span id="total_currchange" class="labeltext">Total USD</span></td>
<td><input type="text" size=10  name="tot_amt" id="tot_amt" style="background-color:#DDDDDD;"
  				 readonly="readonly" value="<?php echo $myarform["totalusd"]  ?>"></td>


<td colspan=1><span id="total_curr_change" class="labeltext">Total USD</span></td>
<td colspan=3><input type="text" size=10  name="tot_payableamt" style="background-color:#DDDDDD;"
  				 readonly="readonly" id="tot_payableamt" value="<?php echo $myarform["total_payableamt"]  ?>"></td></tr>


 <tr bgcolor="#FFFFFF"> 
  <td colspan=2>&nbsp;</td>
  <td><span id="total_subtotalvat" class="labeltext">Subtotal + VAT</span></td>
   <td colspan=5><input type="text" size=10  name="vatsubtotal" id="vatsubtotal" style="background-color:#DDDDDD;"
           readonly="readonly" value="<?php echo $myarform["vatsubtotal"]  ?>"></td>
</tr>

<tr bgcolor="#FFFFFF">
<td colspan=2>&nbsp;</td>
<td ><span class="labeltext"><p align="left">Total(Rupees)</p></td>
<td colspan=5><input type="text" size=10  name="tot_amt_rs" id="tot_amt_rs" style="background-color:#DDDDDD;"
  				 readonly="readonly" value="<?php echo $myarform["totalrupees"]  ?>"></td></tr>
  </table>
  </td>
  </tr>
  </table>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
<tr bgcolor="#FFFFFF">
<td width=17%><span class="labeltext"><p align="left">Value In Words</p></span></td>
<td colspan=3><input type="text" size=75  name="fob_inwords" id="fob_inwords" style="background-color:#DDDDDD;"
  				 readonly="readonly" value="<?php echo $myarform["valueinwords"]  ?>"></td>
<td width=17%><span class="labeltext"><p align="left">Duty In Words</p></span></td>
<td colspan=3><input type="text" size=75  name="duty_inwords" id="duty_inwords" style="background-color:#DDDDDD;"
  				 readonly="readonly" value="<?php echo $myarform["dutyinwords"]  ?>"></td>
</tr>
</table>
</table>
  </td>
 <td width="6"><img src="images/spacer.gif " width="6"></td>
	<tr bgcolor="DEDFDE">
  		<td width="4"><img src="images/box-left-bottom.gif"></td>
		<td><img src="images/spacer.gif " height="6"></td>
		<td width="4"><img src="images/box-right-bottom.gif"></td>
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
