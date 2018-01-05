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
/*
if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];
*/
$_SESSION['pagename'] = 'priceentry';
$userid = $_SESSION['user'];
$page = "Invoice: Price";
////////session_register('pagename');

// First include the class definition
include_once('classes/loginClass.php');
include('classes/invoiceClass.php');
include('classes/displayClass.php');
$newInvoice = new invoice;
$newdisplay = new display;

?>
<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/price.js"></script>

<html>
<head>
<title>New Price</title>
</head>
<body leftmargin="0" topmargin="0" marginwidth="0">
<form action='priceProcess.php' method='post' enctype='multipart/form-data'>
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
	<tr><td> -->
 <table width=100% border=0>
	<td width="100%"><span class="pageheading"><b>New Price</b></td>
    </table>
  <tr>
<td>

<table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=6 class="stdtable1">
 <tr bgcolor="#DDDEDD">
    <td colspan=4><span class="heading"><center><b>General Information</b></center></td>
        </tr>
         <table width=100% border=0 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1">

         <tr bgcolor="#FFFFFF">
          <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Customer</p></font></td>
          <td ><input type="text" name="company" id="company" style=";background-color:#DDDDDD;"
                    readonly="readonly" size=30 value=""> <img src="images/bu-getcustomer.gif" alt="Get Customer"
                    onclick="GetAllCustomers()">  </td>
                    <input type="hidden" name="companyrecnum" id="companyrecnum" value=""></td>
            		<td width= 16% ><span class="labeltext"><p align="left"><span class='asterisk'>*</span>CIM Number</p></font></td>
            		<td ><span class="labeltext"><input type="text" name="crnnum" id="crnnum" size=30 value=""></td>
              	</tr>
     			 <tr bgcolor="#FFFFFF">

            		<td><span class="tabletext"><p align="left"><b><span class='asterisk'>*</span>CIM Partnum</b></p></font></td>
                    <td><input type="text" name="cimpartname"  id="cimpartname" size=30></td>
                    <td width= 16% ><span class="labeltext"><p align="left"><span class='asterisk'>*</span>CIM Partname</p></font></td>
            		<td><span class="labeltext"><input type="text" name="partname" id="partname" size=30 value=""></td>
     			</tr>

                  <tr bgcolor="#FFFFFF" colspan=3>
              <td><span class="labeltext"><p align="left">Price</font></td>
            <td><input type="text" id="price" name="price" size=22 value="">
			<span class="labeltext"><select name="currency" id="currency" size="1" width="100">
                   <option selected>$</option>
                   <option value>Rs</option>
				   </select></td>
				   <td><span class="labeltext"><p align="left">Type</p></font></td>
            <td><span class="tabletext"><input type="text" name="type" id="type" size="15"
                         readonly="readonly"  style=";background-color:#DDDDDD;" value="Treated">
	            <span class="tabletext"><select name="pricetype" id="pricetype" size="1" width="10" onchange="onSelectType(this)">
                <option value='Treated'>Treated</option>
	            <option value='Untreated'>Untreated</option>
	            <option value='Assembly'>Assembly</option>
	            <option value='Kit'>Kit</option>
              </select>
            </td>
            </tr>
			<tr bgcolor="#FFFFFF" colspan=3>
              <td><span class="labeltext"><p align="left">Status</p></font></td>
            <td colspan=3><span class="tabletext"><input type="text" name="status" id="status" size="15"
                         readonly="readonly"  style=";background-color:#DDDDDD;" value="Open">
	            <span class="tabletext"><select name="pricestatus" id="pricestatus" size="1" width="10" onchange="onSelectStatus(this)">
              <option value='Select'>Please Specify</option>
	            <option value='Open'>Open</option>
	            <option value='Closed'>Closed</option>
	            <option value='Pending'>Pending</option>
	            </select>
            </td>
     			 </tr>
     			 
     			 <tr bgcolor="#FFFFFF" colspan=3>
                 	<td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Valid From</p></font></td>
            		<td><input type="text" name="validf"  id="validf"
                               style="background-color:#DDDDDD;"
                               readonly="readonly" size=15 value="">
                               <img src="images/bu-getdate.gif" alt="Get Date" onclick="GetDate('validf')">
                    </td>
            		<td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Valid To</p></font></td>
            		<td><input type="text" name="validt"  id="validt"
                               style="background-color:#DDDDDD;"
                               readonly="readonly" size=15 value="">
                               <img src="images/bu-getdate.gif" alt="Get Due Date" onclick="GetDate('validt')">
                    </td>
                  </tr>
                  <tr bgcolor="#FFFFFF" colspan=3>
            	    <td><span class="labeltext"><p align="left">Remarks</p></font></td>
            		<td colspan=3><span class="labeltext"><input type="text" name="remarks" id="remarks" size=100 value=""></td>
                    </td>
                  </tr>
        </table>
</table>
  </td>
<!--  <td width="6"><img src="images/spacer.gif " width="6"></td>
	<tr bgcolor="DEDFDE">
  		<td width="6"><img src="images/box-left-bottom.gif"></td>
		<td><img src="images/spacer.gif " height="6"></td>
		<td width="6"><img src="images/box-right-bottom.gif"></td>
	</tr> -->
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
