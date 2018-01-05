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
$dept = $_SESSION['department'];

$userrole = $_SESSION['userrole'];


$_SESSION['pagename'] = 'spmasterentry';
//////session_register('pagename');

// First include the class definition
include_once('classes/loginClass.php');
include('classes/spmasterClass.php');
include('classes/displayClass.php');

$newspmaster = new spmaster;
$newdisplay = new display;

?>
<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/spmaster.js"></script>

<html>
<head>
<title>SPMaster Edit</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">
     <form action='spmasterProcess.php' method='post' enctype='multipart/form-data'>
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
	<td width="100%"><span class="pageheading"><b>New SPMaster</b></td>
    </table>
  <tr>
<td>

<table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=6>
 <tr bgcolor="#DDDEDD">
    <td colspan=4><span class="heading"><center><b>General Information</b></center></td>
        </tr>
       <table width=100% border=0 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF" >

                <tr bgcolor="#FFFFFF">
                <tr bgcolor="#FFFFFF">
          <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Supplier</p></font></td>
          <td ><input type="text" name="company" id="company" style=";background-color:#DDDDDD;"
                    readonly="readonly" size=30 value=""> <img src="images/bu-getvendor.gif" alt="Get Supplier"
                    onclick="GetAllCustomers()">
                    <input type="hidden" name="companyrecnum" id="companyrecnum" value="">
                    <input type="hidden" name="pagename" id="pagename" value="entryspmaster"></td></td>
                    <td colspan=2></td>
            	                   </tr>
                   <tr bgcolor="#FFFFFF">
       			    <td width= 16% ><span class="labeltext"><p align="left"><span class='asterisk'>*</span>PRN #</p></font></td>
            		<td ><span class="labeltext"><input type="text" name="crnnum" id="crnnum" size=20  value=""></td>
                    <td><span class="tabletext"><p align="left"><b><span class='asterisk'>*</span>Partnumber</b></p></font></td>
                    <td><input type="text" name="partnum"  id="partnum" size=30  value=""></td>
     			</tr>
                   <tr bgcolor="#FFFFFF">
            		<td width= 16% ><span class="labeltext"><p align="left"><span class='asterisk'>*</span>SAAB Partnumber</p></font></td>
            		<td ><span class="labeltext"><input type="text" name="saabpartnum" id="saabpartnum" size=30  value=""></td>
                    <td><span class="tabletext"><p align="left"><b><span class='asterisk'>*</span>AUK Partnumber</b></p></font></td>
                    <td><input type="text" name="aukpartnum"  id="aukpartnum" size=30  value=""></td>
     			</tr>
     			<tr bgcolor="#FFFFFF" colspan=3>
                 	<td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Qty</p></font></td>
            		<td><input type="text" name="qty"  id="qty"
                                size=15 value="">
                    </td>
            		<td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Validity for Qty</p></font></td>
            		<td><input type="text" name="qty_valid_from"  id="qty_valid_from"
                                size=20 value=""style=";background-color:#DDDDDD;" readonly="readonly">
                <img src="images/bu-getdateicon.gif" alt="Get BookDate" onclick="GetDate('qty_valid_from')">
                <input type="text" name="qty_valid_upto"  id="qty_valid_upto"
                                size=20 value=""style=";background-color:#DDDDDD;" readonly="readonly">
                <img src="images/bu-getdateicon.gif" alt="Get BookDate" onclick="GetDate('qty_valid_upto')"></td>
                  </tr>

                  <tr bgcolor="#FFFFFF" colspan=3>
            		<td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Price</p></font></td>
            		<td><span class="labeltext"><input type="text" name="price" id="price" size=15  value="">
                    <span class="tabletext">
		           <select name="currency" id="currency"  width=2>
					<option selected value="$">$</option>
                     <option value="Rs">Rs
					 <option value='GBP'>GBP</option>
					 <option value='Euro'>Euro</option>
					</option>

        </td>
         <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Validity for Price</p></font></td>
            		<td><input type="text" name="price_valid_from"  id="price_valid_from"
                                size=20 value=""style=";background-color:#DDDDDD;" readonly="readonly">
                <img src="images/bu-getdateicon.gif" alt="Get BookDate" onclick="GetDate('price_valid_from')">
                <input type="text" name="price_valid_upto"  id="price_valid_upto"
                                size=20 value=""style=";background-color:#DDDDDD;" readonly="readonly">
                <img src="images/bu-getdateicon.gif" alt="Get BookDate" onclick="GetDate('price_valid_upto')"></td>
            </tr>
            	<tr bgcolor="#FFFFFF" colspan=3>
                 	<td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Total Cost</p></font></td>
            		<td><input type="text" name="totalcost"  id="totalcost"
                                size=15 value="">
                    </td>
            		<td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Validity for Total Cost</p></font></td>
            		<td><input type="text" name="totalcost_valid_from"  id="totalcost_valid_from"
                                size=20 value=""style=";background-color:#DDDDDD;" readonly="readonly">
                <img src="images/bu-getdateicon.gif" alt="Get BookDate" onclick="GetDate('totalcost_valid_from')">
                <input type="text" name="totalcost_valid_upto"  id="totalcost_valid_upto"
                                size=20 value=""style=";background-color:#DDDDDD;" readonly="readonly">
                <img src="images/bu-getdateicon.gif" alt="Get BookDate" onclick="GetDate('totalcost_valid_upto')"></td>
                  </tr>
             <!--<tr bgcolor="#FFFFFF" colspan=3>
              <td><span class="labeltext"><p align="left">Status</p></font></td>
            <td colspan=3><span class="tabletext"><input type="text" name="status" id="status"
                         readonly="readonly"  style=";background-color:#DDDDDD;" value="">

            </td>
     			 </tr>-->

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
