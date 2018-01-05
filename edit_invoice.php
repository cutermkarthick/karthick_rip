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

$_SESSION['pagename'] = 'editinvoice';
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
	<td width="100%"><span class="pageheading"><b>Edit Invoice</b></td>
    <td colspan=20>&nbsp;</td>
	<td bgcolor="#FFFFFF" align="right"><input type= "image" name="Delete" src="images/bu-delete.gif" value="Get" onclick="javascript: return ConfirmDelete()">
	</td>
    </table>

  <tr>
<td>
<table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=6>
<tr bgcolor="#DDDEDD"><td colspan=4><span class="heading"><center><b>Invoice Details</b></center></td></tr>
<tr bgcolor="#FFFFFF" >
          <td><span class="labeltext"><p align="left">Customer</p></font></td>
          <td width=84%><input type="text" name="company" style=";background-color:#DDDDDD;"
                    readonly="readonly" size=15 value="<?php echo $myrow["name"] ?>"> <img src="images/bu-getcustomer.gif" alt="Get Customer"
                    onclick="GetAllCustomers()">  </td>
                    <input type="hidden" name="companyrecnum" value="<?php echo $myrow["inv2customer"] ?>"></td>
                    <input type="hidden" name="invoicerecnum" value="<?php echo $myrow["recnum"] ?>">
          </tr>

          <table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3>
                    <tr  bgcolor="#EEEFEE" >
                        <td width= 50%><span class="heading"><center><b>Billing Address</b></center></td>
                        <td><span class="heading"><b><center>Shipping Address</center></b></td>
                     </tr>
                      <tr  bgcolor="#FFFFFF">
                          <td id="ba1" ><?php echo $myrow1["baddr1"] . "," . $myrow1["baddr2"]?></td>
                          <td id="sa1" ><?php echo $myrow1["scity"] . "," . $myrow1["sstate"] . "," . $myrow1["szipcode"]?></td>
                      </tr>
                      <tr  bgcolor="#FFFFFF">
                          <td id="ba2"><?php echo $myrow1["bcity"] . "," . $myrow1["bstate"] . "," . $myrow1["bzipcode"] ?></td>
                          <td id="sa2"><?php echo $myrow1["scity"] . "," . $myrow1["sstate"] . "," . $myrow1["szipcode"]?></td>

                      </tr>
                      <tr  bgcolor="#FFFFFF">
                          <td id="ba3"><?php echo $myrow1["bcountry"]?></td>
                          <td id="sa3"><?php echo $myrow1["scountry"]?></td>
                      </tr>
            </table>

 <table width=100% border=0 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF">
         <tr bgcolor="#FFFFFF" >
            		<td width= 16% ><span class="labeltext"><p align="left">Invoice Number</p></font></td>
            		<td><span class="labeltext"><input type="text" name="invnum" size=30  value="<?php echo $myrow["invnum"] ?>"></td>
            		<td><span class="tabletext"><p align="left"><b>Invoice Date</b></p></font></td>
                    <td><input type="text" name="invdate"
                               style="background-color:#DDDDDD;"
                               readonly="readonly" size=15 value="<?php echo $myrow["invdate"] ?>">
                               <img src="images/bu-getdate.gif" alt="Get Invoice Date" onclick="GetDate('invdate')">
                    </td>
          </tr>
          <tr bgcolor="#FFFFFF" >
            	    <td><span class="labeltext"><p align="left">Terms</p></font></td>
            		<td><span class="labeltext"><input type="text" name="terms" size=30  value="<?php echo $myrow["terms"] ?>"></td>
            		<td><span class="labeltext"><p align="left">Due Date</p></font></td>
            		<td><input type="text" name="duedate"
                               style="background-color:#DDDDDD;"
                               readonly="readonly" size=15 value="<?php echo $myrow["duedate"] ?>">
                               <img src="images/bu-getdate.gif" alt="Get Due Date" onclick="GetDate('duedate')">
                    </td>
            </tr>
		   <tr bgcolor="#FFFFFF" >
            		<td><span class="labeltext"><p align="left">Customer PO No.</p></font></td>
            		<td><span class="labeltext"><input type="text" name="customerponum" size=30  value="<?php echo $myrow["customerponum"]?>"></td>
            		<td><span class="labeltext"><p align="left">Description</p></font></td>
            		<td><span class="labeltext"><input type="text" name="invdesc" size=30  value="<?php echo $myrow["invdesc"]?>"></td>
     	  </tr>
             <input type="hidden" name="deleteflag" value="">

<tr bgcolor="#DDDEDD">
<td colspan=4><span class="heading"><center><b> Line Items</b></center></td>
</tr>
<input type="hidden" name="caserecnum" value="<?php echo $caserecnum ?>">

<tr bgcolor="#FFFFFF"><td><a href="javascript:addRow('myTable',document.forms[0].index.value)"><img name="Image7" border="0" src="images/bu-addrow.gif"></a>
<td colspan=4 bgcolor="#FFFFFF"><span class="labeltext">To delete line items - blankout line number</td></tr>

<tr bgcolor="#FFFFFF">
<table id="myTable" width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
     									  							<tr>
      								    									<td bgcolor="#EEEFEE" width=10%><span class="heading"><b>Seq #</b></td>
      									     								<td bgcolor="#EEEFEE" width=10%><span class="heading"><b>ITEM ID</b></td>
       											    						<td bgcolor="#EEEFEE" width=60%><span class="heading"><b>Description</b></td>
          										  							<td bgcolor="#EEEFEE" width=10%><span class="heading"><b>Qty</b></td>
        										   							<td bgcolor="#EEEFEE" width=10%><span class="heading"><b>UM</b></td>
                                                                            <td bgcolor="#EEEFEE" width=10%><span class="heading"><b>Disc%</b></td>
        							   										<td bgcolor="#EEEFEE" width=10%><span class="heading"><b>Price</b></td>
      								     									<td bgcolor="#EEEFEE" width=10%><span class="heading"><b>Amount</b></td>

       																</tr>

																<?php

    								    									/*$i = 0;
      								  									$result = $newLI->getLI($porecnum);
    							    										while ($myLI = mysql_fetch_row($result)) {
       							     										 $i = $i + 1;
   								          									$line[$i] = $myLI;

									       								 }
    								    									while ($i < 10) {
       								     									$i = $i + 1;
        									    								$line[$i] = $myLI;
   																	}*/
   															$result = $newLI->getInvoiceli($invoicerecnum);
													$i=1;$flag=0;
													while($i<=10)
													{
														if($flag==0)
														{
															while ($myLI = mysql_fetch_row($result))
												    	 		{
																//echo "i am inside inner while loop";
																printf('<tr bgcolor="#FFFFFF">');
																$linenumber="line_num" . $i;
																$itemid="item_id" . $i;
																$itemdesc="item_desc" . $i;
																$qty="qty" . $i;
																$um="um" . $i;
																$disc_perc="disc_perc" . $i;
																$rate="rate" . $i;
																$amount="amount" . $i;
																$prevlinenum="prev_line_num" . $i;
																$lirecnum="lirecnum" . $i;
																//echo "<br>$linenumber<br>$itemname<br>$itemdesc<br>$qty<br>$rate<br>$duedate<br>";
																echo "<td ><span class=\"tabletext\"><input type=\"text\"  name=\"$linenumber\"  value=\"$myLI[0]\" size=\"10%\"></td>";
																echo "<input type=\"hidden\" name=\"$prevlinenum\" value=\"$myLI[0]\">";
																echo "<input type=\"hidden\" name=\"$lirecnum\" value=\"$myLI[8]\">";
																echo "<td><input type=\"text\" name=\"$itemid\" size=\"10%\" value=\"$myLI[1]\"></td>";
																echo "<td><input type=\"text\" name=\"$itemdesc\" size=\"60%\" value=\"$myLI[2]\"></td>";
																echo "<td><input type=\"text\" name=\"$qty\" size=\"10%\" value=\"$myLI[3]\"></td>";
                                                                echo "<td><input type=\"text\" name=\"$um\" size=\"10%\" value=\"$myLI[4]\"></td>";
                                                                echo "<td><input type=\"text\" name=\"$disc_perc\" size=\"10%\" value=\"$myLI[5]\"></td>";
																echo "<td><input type=\"text\" name=\"$rate\" size=\"10%\" value=\"$myLI[6]\"></td>";
																echo "<td><input type=\"text\" name=\"$amount\" style=\"background-color:#DDDDDD;\"
                  											  				readonly=\"readonly\" size=\"10%\" value=\"$myLI[7]\">";
																printf('</tr>');
																$i++;
															}
															$flag=1;
														}
														//echo "i am in outside while loop";
														printf('<tr bgcolor="#FFFFFF">');
    													$linenumber="line_num" . $i;
														$itemname="item_id" . $i;
														$itemdesc="item_desc" . $i;
														$qty="qty" . $i;
														$um="um" . $i;
														$disc_perc="disc_perc" . $i;
														$duedate="due_date" . $i;
														$rate="rate" . $i;
														$amount="amount" . $i;
														$prevlinenum="prev_line_num" . $i;
														$lirecnum="lirecnum" . $i;
														//echo "<br>$linenumber<br>$itemname<br>$itemdesc<br>$qty<br>$rate<br>$duedate<br>";
														echo "<td ><span class=\"tabletext\"><input type=\"text\"  name=\"$linenumber\"  value=\"\" size=\"10%\"></td>";
														echo "<input type=\"hidden\" name=\"$prevlinenum\" value=\"\">";
														echo "<input type=\"hidden\" name=\"$lirecnum\" value=\"$myLI[8]\">";
														echo "<td><input type=\"text\" name=\"$itemname\" size=\"10%\" value=\"\"></td>";
														echo "<td><input type=\"text\" name=\"$itemdesc\" size=\"60%\" value=\"\"></td>";
														echo "<td><input type=\"text\" name=\"$qty\" size=\"10%\" value=\"\"></td>";
														echo "<td><input type=\"text\" name=\"$um\" size=\"10%\" value=\"\"></td>";
														echo "<td><input type=\"text\" name=\"$disc_perc\" size=\"10%\" value=\"\"></td>";
														echo "<td><input type=\"text\" name=\"$rate\" size=\"10%\" value=\"\"></td>";
														echo "<td><input type=\"text\" name=\"$amount\" style=\"background-color:#DDDDDD;\"
                  										  			readonly=\"readonly\" size=\"10%\" value=\"\">";
														printf('</tr>');
														$i++;
												       	 }
                                                        echo "<input type=\"hidden\" name=\"index\" value=$i>";
	                                                    echo "<input type=\"hidden\" name=\"curindex\" value=$i>";
												?>

      	<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
          <td align="right"><span class="pageheading"><b></b></td><td width="9%"></td></tr>
         <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="right">Subtotal</p></font></td>
            <td align="right"><span class="tabletext">
            <?php
            		printf('$%.2f',$myrow["subtotal"]);
            // echo  "$myrow[21]"?>
        </tr>
         <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="right">Shipping Charges</p></font></td>
            <td align="right"><span class="tabletext">
            <?php
            	printf('$%.2f',$myrow["shipping"]);
            // echo  "$myrow[21]"?>
        </tr>
       <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="right">Sales Tax</p></font></td>
            <td align="right"><span class="tabletext">
            <?php
            	printf('$%.2f',$myrow["salestax"]);
            // echo  "$myrow[21]"?>
        </tr>

      <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="right">Total</p></font></td>
            <td align="right"><span class="tabletext">
            <?php
            	printf('$%.2f',$myrow["total"]);
            // echo  "$myrow[21]"?>
        </tr>

 </tr>
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