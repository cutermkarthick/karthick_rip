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

$_SESSION['pagename'] = 'newinvoice';
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
<title>New Invoice</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">
     <form action='processInvoice.php' method='post' enctype='multipart/form-data'>
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
          <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Customer</p></font></td>
          <td colspan=3><input type="text" name="company" style=";background-color:#DDDDDD;"
                    readonly="readonly" size=30 value=""> <img src="images/bu-getcustomer.gif" alt="Get Customer"
                    onclick="GetAllCustomers()">  </td>
                    <input type="hidden" name="companyrecnum"></td>

<!--
    <table width=100% border=0 cellpadding=0 cellspacing=0 bgcolor="#DFDEDF" align= center>

                      <tr bgcolor="#FFFFFF" align= center>
                          <input type="text" name="badr1" style="background-color:#DDDDDD;"
                              readonly="readonly" size=40 value=""></td>
                          <input type="text" name="sadr1" style="background-color:#DDDDDD;"
                              readonly="readonly" size=40 value=""></td>
                      </tr>
                      <tr bgcolor="#FFFFFF" align= center>
                          <input type="text" name="badr2" style="background-color:#DDDDDD;"
                              readonly="readonly" size=40 value=""></td>
                        <input type="text" name="sadr2" style="background-color:#DDDDDD;"
                              readonly="readonly" size=40 value=""></td>

                      </tr>
                      <tr bgcolor="#FFFFFF" align= center>
                         <input type="text" name="badr3" style="background-color:#DDDDDD;"
                              readonly="readonly" size=40 value=""></td>
                         <input type="text" name="sadr3" style="background-color:#DDDDDD;"
                              readonly="readonly" size=40 value=""></td>
                      </tr>
                      <tr></td>
                      </tr>

-->
 </table>
        <table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3>
                    <tr  bgcolor="#EEEFEE">
                        <td width= 50%><span class="heading"><center><b>Billing Address</b></center></td>
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

     <table width=100% border=0 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF" >
                <tr bgcolor="#FFFFFF">
                <tr bgcolor="#FFFFFF">
            		<td width= 16% ><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Invoice Number</p></font></td>
            		<td><span class="labeltext"><input type="text" name="invnum" size=30 value=""></td>
            		<td><span class="tabletext"><p align="left"><b><span class='asterisk'>*</span>Invoice Date</b></p></font></td>
                    <td><input type="text" name="invdate"
                               style="background-color:#DDDDDD;"
                               readonly="readonly" size=15 value="">
                               <img src="images/bu-getdate.gif" alt="Get Invoice Date" onclick="GetDate('invdate')">
                    </td>
     			</tr>
        		<tr bgcolor="#FFFFFF" colspan=3>
            	    <td><span class="labeltext"><p align="left">Terms</p></font></td>
            		<td><span class="labeltext"><input type="text" name="terms" size=30 value=""></td>
            		<td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Due Date</p></font></td>
            		<td><input type="text" name="duedate"
                               style="background-color:#DDDDDD;"
                               readonly="readonly" size=15 value="">
                               <img src="images/bu-getdate.gif" alt="Get Due Date" onclick="GetDate('duedate')">
                    </td>
                  </tr>
                  <tr bgcolor="#FFFFFF" colspan=3>
            		<td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Customer PO No.</p></font></td>
            		<td><span class="labeltext"><input type="text" name="customerponum" size=30  value=""></td>
            		<td><span class="labeltext"><p align="left">Description</p></font></td>
            		<td><span class="labeltext"><input type="text" name="invdesc" size=30 value=""></td>
     			 </tr>
                <tr bgcolor="#DDDEDD">
                    <td colspan=4><span class="heading"><center><b>Invoice Line Items</b></center></td>
                </tr>
                    <input type="hidden" name="caserecnum" value="<?php echo $caserecnum ?>">
                    <tr bgcolor="#FFFFFF"><td colspan=5><a href="javascript:addRow('myTable',document.forms[0].index.value)"><img name="Image7" border="0" src="images/bu-addrow.gif"></a></td></tr>
                <tr bgcolor="#FFFFFF">
                <table id="myTable" width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
                    <td bgcolor="#EEEFEE" width=10%><span class="heading"><b><center>Seq#</center></b></td>
                    <td bgcolor="#EEEFEE" width=10%><span class="heading"><b><center>Item ID</center></b></td>
                    <td bgcolor="#EEEFEE" width=30%><span class="heading"><b><center>Description</center></b></td>
                    <td bgcolor="#EEEFEE" width=10%><span class="heading"><b><center>Quantity</center></b></td>
                    <td bgcolor="#EEEFEE" width=10%><span class="heading"><b><center>UM</center></b></td>
                    <td bgcolor="#EEEFEE" width=10%><span class="heading"><b><center>Disc%</center></b></td>
                    <td bgcolor="#EEEFEE" width=10%><span class="heading"><b><center>Price</center></b></td>
                    <td bgcolor="#EEEFEE" width=10%><span class="heading"><b><center>Amount</center></b></td>
                </tr>
<?php
      $i=1;
      while ($i<5)
     {
	printf('<tr bgcolor="#FFFFFF">');
    $linenumber="linenum" . $i;
	$item_id = "item_id" . $i;
	$item_desc = "item_desc" . $i;
	$um="um" . $i;
	$disc_perc = "disc_perc" . $i;
	$qty = "qty" . $i;
	$rate = "rate" . $i;
	$amount = "amount" . $i;
	echo "<td  ><span class=\"tabletext\"><input type=\"text\"  name=\"$linenumber\" value=\"\" size=\"10%\"></td>";
    echo "<td ><input type=\"text\" name=\"$item_id\" size=\"10%\" value=\"\"></td>";
    echo "<td ><input type=\"text\" name=\"$item_desc\" size=\"60%\" value=\"\"></td>";
    echo "<td ><input type=\"text\" name=\"$qty\" size=\"10%\" value=\"\"></td>";
	echo "<td ><input type=\"text\" name=\"$um\" size=\"10%\" value=\"\"></td>";
	echo "<td ><input type=\"text\" name=\"$disc_perc\" size=\"10%\" value=\"\"></td>";
	echo "<td ><input type=\"text\" name=\"$rate\" size=\"10%\" value=\"\"></td>";
	echo "<td><input type=\"text\" name=\"$amount\" style=\"background-color:#DDDDDD;\"
		  		readonly=\"readonly\" size=\"10%\" value=\"\"></td>";
	printf('</tr>');
	$i++;
    }
   echo "<input type=\"hidden\" name=\"index\" value=$i>";
   echo "<input type=\"hidden\" name=\"curindex\" value=$i>";
      $salestax='10%' ;
	  $shipping='10%' ;
  ?>

    </table>
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
