<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = Dec 08 , 2004                =
// Filename: edit_invoice.php                  =
// Copyright of Badari Mandyam, FluentSoft     =
// Revision: v1.0 OWT                          =
// Allows editing of invoice details           =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];

$_SESSION['pagename'] = 'invoicepayment';
//////session_register('pagename');

// First include the class definition
include('classes/invoiceClass.php');
include('classes/invoiceliClass.php');
include('classes/displayClass.php');

$newlogin = new userlogin;
$newlogin->dbconnect();
$newinvoice = new invoice;
$newLI = new invoiceli;
$newdisplay = new display;
$invoicerecnum = $_REQUEST['invoicerecnum'];
//$inv2customer = $_REQUEST['inv2customer'];
$myQI = $newLI->getInvoiceli($invoicerecnum);
$result = $newinvoice->getInvoice($invoicerecnum);
$myrow = mysql_fetch_assoc($result);
$result1 =$newinvoice->customeraddress($invoicerecnum);
$myrow1 = mysql_fetch_assoc($result1);

?>
<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/invoice.js"></script>
<html>
<head>
<title>Edit Invoice</title>
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
       				<a href="exit.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image16','','images/logout_mo.gif',1)"><img name="Image16" border="0" src="images/logout.gif"></a></td>
        		 </tr>
			</table>
			<table width=100% border=0 cellpadding=0 cellspacing=0  >
				<tr><td></td></tr>
				<tr>
				<td>
<?php $newdisplay->dispLinks(''); ?>
 <table width=100% border=0 cellpadding=0 cellspacing=0  >
	<tr bgcolor="DEDFDE">
	<td width="6"><img src="images/spacer.gif " width="6"></td>
 <td bgcolor="#FFFFFF">
 <table width=100% border=0 cellspacing=4  >
	<tr><td>
 <table width=100% border=0>
	<td width="100%"><span class="pageheading"><b>Invoice Payment</b></td>
    </table>
  <tr>
<td>
<table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=6>
<tr bgcolor="#DDDEDD"><td colspan=4><span class="heading"><center><b>Invoice Details</b></center></td></tr>

 <table width=100% border=0 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF">
         <tr bgcolor="#FFFFFF" >
            		<td width= 16% ><span class="labeltext"><p align="left">Customer</p></font></td>
            		<td><span class="labeltext"><input type="text" name="company" size=30 style="background-color:#DDDDDD;"
                               readonly="readonly" value="<?php echo $myrow["name"] ?>"></td>
            		<td><span class="tabletext"><p align="left"><b>Terms</b></p></font></td>
                    <td><input type="text" name="terms"
                               style="background-color:#DDDDDD;"
                               readonly="readonly" size=30 value="<?php echo $myrow["terms"] ?>">
                    </td>
          </tr>
                    <input type="hidden" name="companyrecnum" value="<?php echo $myrow["inv2customer"] ?>"></td>
                    <input type="hidden" name="invoicerecnum" value="<?php echo $myrow["recnum"] ?>">


         <tr bgcolor="#FFFFFF" >
            		<td width= 16% ><span class="labeltext"><p align="left">Invoice Number</p></font></td>
            		<td><span class="labeltext"><input type="text" name="invnum" size=30 style="background-color:#DDDDDD;"
                               readonly="readonly" value="<?php echo $myrow["invnum"] ?>"></td>
            		<td><span class="tabletext"><p align="left"><b>Invoice Date</b></p></font></td>
                    <td><input type="text" name="invdate"
                               style="background-color:#DDDDDD;"
                               readonly="readonly" size=30 value="<?php echo $myrow["invdate"] ?>">

                    </td>
          </tr>
          <tr bgcolor="#FFFFFF" >
            	    <td><span class="labeltext"><p align="left">Customer PO No.</p></font></td>
            		<td><span class="labeltext"><input type="text" name="customerponum" size=30 style="background-color:#DDDDDD;"
                               readonly="readonly" value="<?php echo $myrow["customerponum"] ?>"></td>
            		<td><span class="labeltext"><p align="left">Due Date</p></font></td>
            		<td><input type="text" name="duedate"
                               style="background-color:#DDDDDD;"
                               readonly="readonly" size=30 value="<?php echo $myrow["duedate"] ?>">

                    </td>
            </tr>
		   <tr bgcolor="#FFFFFF" >
            		<td><span class="labeltext"><p align="left">Due Amount</p></font></td>
            		<td><span class="labeltext"><input type="text" name="totaldue" size=30 style="background-color:#DDDDDD;"
                               readonly="readonly" value="<?php echo $myrow["totaldue"]?>"></td>
            		<td><span class="labeltext"><p align="left">Description</p></font></td>
            		<td><span class="labeltext"><input type="text" name="invdesc" size=30 style="background-color:#DDDDDD;"
                               readonly="readonly" value="<?php echo $myrow["invdesc"]?>"></td>
     	  </tr>

       <tr bgcolor="#DDDEDD"><td colspan=4><span class="heading"><center><b>Payment</b></center></td></tr>
     	  <tr bgcolor="#FFFFFF" >
            		<td><span class="labeltext"><p align="left">Payment Amount</p></font></td>
            		<td><span class="labeltext"><input type="text" name="payment_amount" size=30 value=" "></td>
            		<td><span class="tabletext"><p align="left"><b>Payment Date</b></p></font></td>
                    <td><input type="text" name="payment_date"
                               style="background-color:#DDDDDD;"
                               readonly="readonly" size=15 value="">
                               <img src="images/bu-getdate.gif" alt="Get Payment Date" onclick="GetDate('payment_date')">
                    </td>
     	  </tr>
     	  <tr bgcolor="#FFFFFF">
                    <td><span class="labeltext"><p align="left">Ref.#</p></font></td>
                    <td colspan=6><input type="text" name="ref_num" size=30 value=" "></td>
          </tr>
             <input type="hidden" name="deleteflag" value="">

 </table>
  </table>
<td width="6"><img src="images/spacer.gif " width="6"></td>
		</tr>
			<tr bgcolor="DEDFDE">
				<td width="6"><img src="images/box-left-bottom.gif"></td>
				<td><img src="images/spacer.gif " height="6"></td>
				<td width="6"><img src="images/box-right-bottom.gif"></td>
			</tr>
		</table>
			<table border = 0 cellpadding=0 cellspacing=0 width=100% >
				<tr>
					<td align=left>
						</td>
					</tr>
				</table>
                <span class="tabletext"><input type="submit"
                     style="color=#0066CC;background-color:#DDDDDD;width=130;"
                     value="Submit" name="submit">
                <INPUT TYPE="RESET"
                     style="color=#0066CC;background-color:#DDDDDD;width=100;"
                     VALUE="Reset" onclick="javascript: putfocus()">

					</FORM>
		</body>
</html>