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
$page= "Invoice: Invoice";
////////session_register('pagename');

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
$inv2customer = $_REQUEST['inv2customer'];
$myQI = $newLI->getInvoiceli($invoicerecnum);

$result = $newinvoice->getInvoiceDetails($invoicerecnum);
$myrow = mysql_fetch_assoc($result);
$result1 =$newinvoice->customeraddress($invoicerecnum);
$myrow1 = mysql_fetch_assoc($result1);
$invnum=$myrow["invnum"];
$cust_amt= $newinvoice->getCustinvamt($invnum);
//echo $cust_amt;
?>
<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/invoice.js"></script>
<html>
<head>
<title>Edit Invoice</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">
    <form action='invoiceProcess.php' method='post' enctype='multipart/form-data'>
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
	<tr><td> -->
 <table width=100% border=0>
	<td width="100%"><span class="pageheading"><b>Edit Invoice</b></td>
    <td colspan=20>&nbsp;</td>
	<td bgcolor="#FFFFFF" align="right"><input type= "image" name="Delete" src="images/bu-delete.gif" value="Get" onclick="javascript: return ConfirmDelete()">
	</td>
    </table>

  <tr>
<td>
<table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=6 class="stdtable1">
<tr bgcolor="#DDDEDD"><td colspan=4><span class="heading"><center><b>Invoice Details</b></center></td></tr>
<tr bgcolor="#FFFFFF" >
          <td  width=20%><span class="labeltext"><p align="left">Customer</p></font></td>
          <td width=20% ><input type="text" name="company" style=";background-color:#DDDDDD;"
                    readonly="readonly" size=15 value="<?php echo $myrow["name"] ?>"> <img src="images/bu-getcustomer.gif" alt="Get Customer"
                    onclick="GetAllCustomers()">  </td>
                    <input type="hidden" name="companyrecnum" id ="companyrecnum" value="<?php echo $myrow["inv2customer"] ?>"></td>
                    <input type="hidden" name="invoicerecnum" id="invoicerecnum" value="<?php echo $myrow["recnum"] ?>">
          <td  width=20%><span class="labeltext"><p align="left">Ship to Customer</p></font></td>
          <td width=20% ><input type="text" name="shippingcompany" style=";background-color:#DDDDDD;"
                    readonly="readonly" size=15 value="<?php echo $myrow["sname"] ?>"> <img src="images/bu-getcustomer.gif" alt="Get Customer"
                    onclick="GetCust4Shipping()">  </td>
                    <input type="hidden" name="shippingcompanyrecnum" id ="shippingcompanyrecnum" value="<?php echo $myrow["inv2shipping"] ?>"></td>
                     <input type="hidden" name="cust_amt" id ="cust_amt" value="<?php echo $cust_amt ?>"></td>

                    </tr>
       <tr bgcolor="#FFFFFF" >
         <td width=20%><span class="labeltext"><p align="left">Invoice #</p></font></td>
            <td width=20%><span class="tabletext"><input type="text" name="invnum" size=30 style=";background-color:#DDDDDD;"
                    readonly="readonly"  value="<?php echo $myrow["invnum"] ?>"></td>
		 <td colspan=2>&nbsp</td>
          </tr>

          <table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3 class="stdtable1">
                    <tr  bgcolor="#EEEFEE" >
                        <td width= 50%><span class="heading"><center><b>Billing Address</b></center></td>
                        <td><span class="heading"><b><center>Shipping Address</center></b></td>
                     </tr>
                      <tr  bgcolor="#FFFFFF">
                          <td id="ba1" ><span class="tabletext"><?php echo $myrow1["baddr1"] . "," . $myrow1["baddr2"]?></td>
                          <td id="sa1" ><span class="tabletext"><?php echo $myrow1["saddr1"] . "," . $myrow1["saddr2"] . "," . $myrow1["szipcode"]?></td>
                      </tr>
                      <tr  bgcolor="#FFFFFF">
                          <td id="ba2"><span class="tabletext"><?php echo $myrow1["bcity"] . "," . $myrow1["bstate"] . "," . $myrow1["bzipcode"] ?></td>
                          <td id="sa2"><span class="tabletext"><?php echo $myrow1["scity"] . "," . $myrow1["sstate"] . "," . $myrow1["szipcode"]?></td>

                      </tr>
                      <tr  bgcolor="#FFFFFF">
                          <td id="ba3"><span class="tabletext"><?php echo $myrow1["bcountry"]?></td>
                          <td id="sa3"><span class="tabletext"><?php echo $myrow1["scountry"]?></td>
                      </tr>
            </table>

 <table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1">
 <tr bgcolor="#FFFFFF"></tr>
 <?php
		        if($myrow["duedate"] != '0000-00-00' && $myrow["duedate"]!= '' && $myrow["duedate"] != 'NULL')
                {
                    $datearr = split('-', $myrow["duedate"]);
                    $d=$datearr[2];
                    $m=$datearr[1];
                    $y=$datearr[0];
                    $x=mktime(0,0,0,$m,$d,$y);
                    $duedate=date("M j, Y",$x);
               }
               else
               {
                   $duedate = '';
               }
            ?>
            <tr bgcolor="#FFFFFF">
            		<td><span class="tabletext"><p align="left"><b><span class='asterisk'>*</span>Invoice Date</b></p></font></td>
                    <td><input type="text" name="invdate" id="invdate"
                               style="background-color:#DDDDDD;"
                               readonly="readonly" size=15 value="<?php echo $myrow["invdate"] ?>">
                               <img src="images/bu-getdate.gif" alt="Get Invoice Date" onclick="GetDate('invdate')">
                    </td>
					<td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Due Date</p></font></td>
            		<td><input type="text" name="duedate" id="duedate"
                               style="background-color:#DDDDDD;"
                               readonly="readonly" size=15 value="<?php echo $myrow["duedate"] ?>">
                               <img src="images/bu-getdate.gif" alt="Get Due Date" onclick="GetDate('duedate')">
                    </td>
     			</tr>

            	<tr bgcolor="#FFFFFF">
            		<td><span class="tabletext"><p align="left"><b>DC NO:</b></p></font></td>
                    <td><input type="text" size=30 name="dcnum" id="dcnum" value="<?php echo $myrow["dcnum"] ?>">

                    </td>
					<td><span class="labeltext"><p align="left">DC Date</p></font></td>
            		<td><input type="text" name="dcdate"   id="dcdate"
                               style="background-color:#DDDDDD;"
                               readonly="readonly" size=15 value="<?php echo $myrow["dcdate"] ?>">
                               <img src="images/bu-getdate.gif" alt="Get DC Date" onclick="GetDate('dcdate')">
                    </td>
     			</tr>
	         <tr bgcolor="#FFFFFF">
            <td width=20%><span class="labeltext"><p align="left">Pre-Carriage by</p></font></td>
            <td width=20%><span class="tabletext"><input type="text" name="precarriageby" size=30 style=";background-color:#DDDDDD;"
                    readonly="readonly"  value="<?php echo $myrow["precarriageby"] ?>"></td>
            <td width=20%><span class="labeltext"><p align="left">Pre-carrier Place of Receipt</p></font></td>
            <td width=20%><span class="tabletext"><p align="left"><input type="text" name="precarrierreceipt" size=30  style=";background-color:#DDDDDD;"
                    readonly="readonly"value="<?php echo  $myrow["precarrierreceipt"] ?>"></td>
            </td>
		</tr>
		 <tr bgcolor="#FFFFFF">
            <td width=20%><span class="labeltext"><p align="left">Country of Origin</p></font></td>
            <td width=20%><span class="tabletext"><input type="text" name="countryoforigin" size=30  style=";background-color:#DDDDDD;"
                    readonly="readonly" value="<?php echo $myrow["countryoforigin"] ?>"></td>
            <td width=20%><span class="labeltext"><p align="left">Country of Final Destination</p></font></td>
            <td width=20%><span class="tabletext"><p align="left"><input type="text" name="countryoffinaldest" id="countryoffinaldest" size=30 style=";background-color:#DDDDDD;"
                    readonly="readonly" value="<?php echo $myrow["countryoffinaldest"] ?>"></td>
            </td>
		</tr>

	    <tr bgcolor="#FFFFFF">
            <td width=20%><span class="labeltext"><p align="left">Vessel</p></font></td>
            <td width=20%><span class="tabletext"><input type="text" name="vessel" size=30  value="<?php echo $myrow["vessel"] ?>"></td>
            <td width=20%><span class="labeltext"><p align="left">Port of Loading</p></font></td>
            <td width=20%><span class="tabletext"><p align="left"><input type="text" name="portofloading" size=30  value="<?php echo $myrow["portofloading"] ?>"></td>
            </td>
        </tr>

	    <tr bgcolor="#FFFFFF">
            <td width=20%><span class="labeltext">Port of Discharge</font></td>
            <td width=20%><span class="tabletext"><input type="text" name="portofdischarge" size=30 style=";background-color:#DDDDDD;"
                    readonly="readonly" value="<?php echo $myrow["portofdischarge"] ?>"></td>
            	<td><span class="labeltext"><p align="left">Description</p></font></td>
            		<td><span class="labeltext"><input type="text" name="invdesc" size=30 value="<?php echo $myrow["invdesc"] ?>"></td>

            </td>
        </tr>

        <tr bgcolor="#FFFFFF">
            <td width=20%><span class="labeltext">Currency</td>
            <td width=20%><span class="tabletext"><input type="text" name="currency" id="currency" size=20  value="<?php echo $myrow["currency"] ?>">
            <select name="currency_sel" id="currency_sel" size="1" width="100" onclick="javascript:onSelectcur(this)">
                   <option selected value="$">$</option>
                   <option value="Rs">Rs</option>
				   </select></td>
            <td width=20%><span class="labeltext">FOB/C&F/DAP</td>
            <td width=20%><span class="tabletext"><input type="text" name="fobcf" id="fobcf" size=20  value="<?php echo $myrow["fob_or_candf"] ?>">
            <input type="hidden" name="deleteflag" value="">
              <select name="fobcf_sel" size="1" width="100" onclick="javascript:onSelectfob(this)">
                   <option selected value="FOB">FOB</option>
                   <option value="C&F">C&F</option>
                    <option value="DAP">DAP</option>
				   </select></td>
        </tr>
          </table>
        	<table width=100% border=0 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF" >
                <tr bgcolor="#FFFFFF">
                <td><span class="labeltext"><p align="left">Remarks</p></font></td>
                <td ><textarea name="remarks" id="remarks" rows="6" cols="95"><?php echo $myrow["remarks"] ?></textarea></td></tr>

        		<tr bgcolor="#FFFFFF" colspan=3>
                  <td><span class="labeltext"><p align="left">Terms</p></font></td>
                <td ><textarea name="terms" id="terms" rows="6" cols="95"><?php echo $myrow["terms"] ?></textarea></td></tr>
                  </tr>
                  </table>

 <br>
</table>

<table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3>
<tr bgcolor="#EEEFEE">
<td colspan=4><span class="heading"><center><b> Line Items</b></center></td>
</tr>

<tr bgcolor="#FFFFFF">
<table id="tablemm" width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
<td colspan=20><span class="heading"><a href="javascript:addRow4edit('tablemm',document.forms[0].index.value)">
<img src="images/bu-addrow.gif" border="0"></a></td>
<tr bgcolor="#FFFFFF">
<td bgcolor="#EEEFEE" width=5%><span class="heading"><b><center>Seq#</center></b></td>
<td bgcolor="#EEEFEE" width=5%><span class="heading"><b><center>CRN</center></b></td>
<td bgcolor="#EEEFEE" width=15%><span class="heading"><b><center>Partnum</center></b></td>
<td bgcolor="#EEEFEE" width=17%><span class="heading"><b><center>Description</center></b></td>
<td bgcolor="#EEEFEE" width=8%><span class="heading"><b><center>CofC</center></b></td>
<td bgcolor="#EEEFEE" width=10%><span class="heading"><b><center>PO #</center></b></td>
<td bgcolor="#EEEFEE" width=8%><span class="heading"><b><center>PO LN.#</center></b></td>
<td bgcolor="#EEEFEE" width=8%><span class="heading"><b><center>Sch PO</center></b></td>
<td bgcolor="#EEEFEE" width=10%><span class="heading"><b><center>Raw Mtl</center></b></td>
<td bgcolor="#EEEFEE" width=10%><span class="heading"><b><center>Tariff</center></b></td>
<td bgcolor="#EEEFEE" width=10%><span class="heading"><b><center>Packaging<br>(inches)</center></b></td>
<td bgcolor="#EEEFEE" width=5%><span class="heading"><b><center>Quantity</center></b></td>
<td bgcolor="#EEEFEE" width=7%><span class="heading"><b><center>Type</center></b></td>
<td bgcolor="#EEEFEE" width=7%><span class="heading"><b><center>Price</center></b></td>
<td bgcolor="#EEEFEE" width=8%><span class="heading"><b><center>Amount</center></b></td>
</tr>
<?php
     $currency = $myrow["currency"];
     $i=1;

      while ($li = mysql_fetch_row($myQI))
      {
       //$res_totqty=$newinvoice->getallcustpo4invoice($inv2customer,$li[3]);
       //$mytqty=mysql_fetch_row($res_totqty);
       //$result_qty=$newinvoice->getcustpoqty4invoice($li[3],$inv2customer);
       //$myqty=mysql_fetch_row($result_qty);
       //$balance=$mytqty[3]-$myqty[0];  onfocus=\"setpo4invoice($i)\"
        printf('<tr bgcolor="#FFFFFF">');
	
	    $prelinenum="prelinenum" . $i;
	    $lirecnum="lirecnum" . $i;
        $line_num="line_num" . $i;
   	    $cofc="cofc" . $i;
	    $item_desc="item_desc" . $i;
	    $qty="qty" . $i;
	    $crn="crn" . $i;
	    $partnum="partnum" . $i;
	    $tariffsch="tariffsch" . $i;
        $rawmtl="rawmtl" . $i;
	    $packaging="packaging" . $i;
	    $ponum="ponum" . $i;
        $rate="rate" . $i;
	    $amount="amount" . $i;
	    $type="type" . $i;
	    $custporecnum="custporecnum" . $i;
	    $po_qty="po_qty" . $i;
        $polinenum="polinenum" . $i;
        $schpo="schpo" . $i;
	    $packging_in=htmlentities($li[17]);
        //echo$crn;
     echo "<td align=\"center\"><input type=\"text\"  name=\"$line_num\" id=\"$line_num\" value=\"$li[0]\" size=2></td>";
	 echo "<input type=\"hidden\" name=\"$prelinenum\" id=\"$prelinenum\" value=\"$li[0]\">";
     echo "<input type=\"hidden\" name=\"$lirecnum\" id=\"$lirecnum\" value=\"$li[15]\">";
	 echo "<td align=\"center\"><input type=\"text\" name=\"$crn\" id=\"$crn\" size=\"10\"  style=\"background-color:#DDDDDD;\"
		  		readonly=\"readonly\" value=\"$li[3]\"><img src=\"images/bu-get.gif\" width=\"80px\" height=\"20px\" alt=\"Get CRN\"  onclick=\"GetCRN4invoice($i)\"></td>";
     echo "<td align=\"center\"><input type=\"text\" name=\"$partnum\"  id=\"$partnum\" style=\"background-color:#DDDDDD;\"
		  		readonly=\"readonly\" size=\"25\" value=\"$li[5]\"></td>";
     echo "<td align=\"center\"><input type=\"text\" name=\"$item_desc\" id=\"$item_desc\" size=\"30\" style=\"background-color:#DDDDDD;\"
		  		readonly=\"readonly\" value=\"$li[8]\"></td>";
     echo "<td align=\"center\"><input type=\"text\" name=\"$cofc\" id=\"$cofc\"size=\"12\" value=\"$li[2]\"  style=\"background-color:#DDDDDD;\"
		  		readonly=\"readonly\">
	 <img src=\"images/bu-get.gif\" alt=\"Get CofC\"  width='80px' onclick=\"getcofc_edit($i)\"></td>";
 	 echo "<td align=\"center\"><input type=\"text\" name=\"$ponum\" id=\"$ponum\" size=\"10\" style=\"background-color:#DDDDDD;\"
		  		readonly=\"readonly\" value=\"$li[1]\"><img src=\"images/bu-getpo.gif\" alt=\"Get CustPo\" width='80px' onclick=\"GetCustpo($i)\">
      <input type=\"hidden\" name=\"$custporecnum\" id=\"$custporecnum\" value=\"\">
      <input type=\"hidden\" name=\"$po_qty\" id=\"$po_qty\"  size=\"5\" value=\"\"></td>";
     echo "<td align=\"center\"><input type=\"text\" name=\"$polinenum\" id=\"$polinenum\"size=\"5\" value=\"$li[18]\"></td>";
     echo "<td align=\"center\"><input type=\"text\" name=\"$schpo\" id=\"$schpo\"size=\"5\" value=\"$li[19]\"></td>";
	 echo "<td align=\"center\"><input type=\"text\" name=\"$rawmtl\" id=\"$rawmtl\" size=\"15\" value=\"$li[4]\"></td>";
     echo "<td align=\"center\"><input type=\"text\" name=\"$tariffsch\" id=\"$tariffsch\" size=\"10\" value=\"$li[9]\"></td>";
     echo "<td align=\"center\"><input type=\"text\" name=\"$packaging\" id=\"$packaging\" size=\"10\" value=\"$packging_in\"></td>";
     echo "<td align=\"center\"><input type=\"text\" name=\"$qty\" id=\"$qty\" size=\"3\" value=\"$li[10]\" style=\"background-color:#DDDDDD;\"
		  		readonly=\"readonly\"></td>";
	 echo "<td ><input type=\"text\" name=\"$type\" id=\"$type\" style=\"background-color:#DDDDDD;\"
		  		readonly=\"readonly\" size=\"8\" value=\"$li[14]\"></td>";
     echo "<td ><input type=\"text\" name=\"$rate\" id=\"$rate\" style=\"background-color:#DDDDDD;\"
		  		readonly=\"readonly\" size=\"8\" value=\"$li[11]\"></td>";
     echo "<td><input type=\"text\" name=\"$amount\" id=\"$amount\" style=\"background-color:#DDDDDD;\"
		  		readonly=\"readonly\" size=\"15\" value=\"$li[12]\"></td>";
	 printf('</tr>');
	 printf('</tr>');
	 $i++;
    }
    echo "<input type=\"hidden\" name=\"index\" id=\"index\" value=$i>";
    echo "<input type=\"hidden\" name=\"curindex\" value=$i>";
    /*echo " <input type=\"text\" name=\"pagename\" id=\"pagename\" style=\"background-color:#DDDDDD;\"
		  		readonly=\"readonly\" size=\"15\" value=\"invedit\">";*/
?>
</table>

<?php

$customername = $myrow["name"]  ;
//$customername ='Mahindra';
if($customername ==  'MAHINDRA AEROSTRUCTURES PVT. LTD')
{
?>
<Table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1">
          <td align="right"><span class="pageheading"><b></b></td><td width="9%"></td></tr>
         <tr bgcolor="#FFFFFF">
            <td colspan=2 style="width:90%"><span class="labeltext"><p align="right">Subtotal</p></font></td>
            <td align="right"><span class="tabletext">
            <?php
            		printf('Rs. %.2f',$myrow["subtotal"]);
          ?>
        </tr>
		<input type='hidden' id='subtotal' name='subtotal' value="<?=$myrow["subtotal"]?>">
         <tr bgcolor="#FFFFFF">
            <td colspan=2 style="width:90%"> <span class="labeltext"><p align="right">Excise (12.5%)</p></font></td>
            <td align="right"><span class="tabletext">
            <?php
			
            	printf('%.2f',$myrow["excise"]);
            ?>
        </tr>
		<input type='hidden' id='excise' name='excise' value="<?=$myrow["excise"];?>">
		
		  <tr bgcolor="#FFFFFF">
            <td colspan=2 style="width:90%"> <span class="labeltext"><p align="right">Subtotal(W/EXC)</p></font></td>
            <td align="right"><span class="tabletext">
            <?php
			
            	printf('%.2f',$myrow["excsubtotal"]);
            ?>
        </tr>
		<input type='hidden' id='excise' name='excise' value="<?=$myrow["excsubtotal"];?>">
		
       <tr bgcolor="#FFFFFF">
            <td colspan=2 style="width:90%"><span class="labeltext"><p align="right">VAT (14.5%)</p></font></td>
            <td align="right"><span class="tabletext">
            <?php
            	printf('%.2f',$myrow["vat"]);
            // echo  "$myrow[21]"?>
        </tr>
		<input type='hidden' id='vat' name='vat' value="<?=$myrow["vat"]?>">
	
		

      <tr bgcolor="#FFFFFF">
            <td colspan=2 style="width:90%"><span class="labeltext"><p align="right">Total</p></font></td>
            			  <td align="right"><span class="tabletext"><input type="text" name="inv_totamt" size=9 id ="inv_totamt" style="background-color:#DDDDDD;"
		  		readonly="readonly" value="<?php  printf('Rs. %.2f',$myrow["total"]) ?>"></td>
        </tr>		
 </tr>
 </table>
 

<?php

}
else if($customername ==  'Aerostructures Assemblies India Pvt.Ltd')
{
?>
<Table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF"  class="stdtable1">
          <td align="right"><span class="pageheading"><b></b></td><td width="9%"></td></tr>
         <tr bgcolor="#FFFFFF">
            <td colspan=2 style="width:90%"><span class="labeltext"><p align="right">Subtotal</p></font></td>
            <td align="right"><span class="tabletext">
            <?php
            		printf('$%.2f',$myrow["subtotal"]);
          ?>
        </tr>
		<input type='hidden' id='subtotal' name='subtotal' value="<?=$myrow["subtotal"]?>">
      
       <tr bgcolor="#FFFFFF">
            <td colspan=2 style="width:90%"><span class="labeltext"><p align="right">VAT (14.5%)</p></font></td>
            <td align="right"><span class="tabletext">
            <?php
            	printf('%.2f',$myrow["vat"]);
            // echo  "$myrow[21]"?>
        </tr>
		<input type='hidden' id='vat' name='vat' value="<?=$myrow["vat"]?>">
		
      <tr bgcolor="#FFFFFF">
            <td colspan=2 style="width:90%"><span class="labeltext"><p align="right">Total</p></font></td>
            			  <td align="right"><span class="tabletext"><input type="text" name="inv_totamt" size=5 id ="inv_totamt" style="background-color:#DDDDDD;text-align:right"
		  		readonly="readonly" value="<?php  printf('$%.2f',$myrow["total"]) ?>"></td>
        </tr>		
 </tr>
 </table>
 <?php
}
else if($customername ==  'Dynamatic Technologies Limited')
{
?>
<Table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
          <td align="right"><span class="pageheading"><b></b></td><td width="9%"></td></tr>
         <tr bgcolor="#FFFFFF">
            <td colspan=2 style="width:90%"><span class="labeltext"><p align="right">Subtotal</p></font></td>
            <td align="right"><span class="tabletext">
            <?php
                printf('$%.2f',$myrow["subtotal"]);
          ?>
        </tr>
    <input type='hidden' id='subtotal' name='subtotal' value="<?=$myrow["subtotal"]?>">
      
       <tr bgcolor="#FFFFFF">
            <td colspan=2 style="width:90%"><span class="labeltext"><p align="right">Service Tax (14%)</p></font></td>
            <td align="right"><span class="tabletext">
            <?php
              printf('%.2f',$myrow["service_tax"]);
            // echo  "$myrow[21]"?>
        </tr>
    <input type='hidden' id='service_tax' name='service_tax' value="<?=$myrow["service_tax"]?>">

     <tr bgcolor="#FFFFFF">
            <td colspan=2 style="width:90%"><span class="labeltext"><p align="right">Swach Bhart Cess(0.5%)</p></font></td>
            <td align="right"><span class="tabletext">
            <?php
              printf('%.2f',$myrow["cess1"]);
            // echo  "$myrow[21]"?>
        </tr>
    <input type='hidden' id='cess1' name='cess1' value="<?=$myrow["cess1"]?>">
     <tr bgcolor="#FFFFFF">
            <td colspan=2 style="width:90%"><span class="labeltext"><p align="right">Krishi Kalyan Cess (0.5%)</p></font></td>
            <td align="right"><span class="tabletext">
            <?php
              printf('%.2f',$myrow["cess2"]);
            // echo  "$myrow[21]"?>
        </tr>
    <input type='hidden' id='cess2' name='cess2' value="<?=$myrow["cess2"]?>">
    
      <tr bgcolor="#FFFFFF">
            <td colspan=2 style="width:90%"><span class="labeltext"><p align="right">Total</p></font></td>
                    <td align="right"><span class="tabletext"><input type="text" name="inv_totamt" size=5 id ="inv_totamt" style="background-color:#DDDDDD;text-align:right"
          readonly="readonly" value="<?php  printf('$%.2f',$myrow["total"]) ?>"></td>
        </tr>   
 </tr>
 </table>
 
<?php

}
else 
{
?>

      	<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1">
          <td align="right"><span class="pageheading"><b></b></td><td width="9%"></td></tr>
         <tr bgcolor="#FFFFFF">
            <td colspan=2><span class="labeltext"><p align="right">Subtotal</p></font></td>
            <td align="right"><span class="tabletext">
            <?php
            		printf('$%.2f',$myrow["subtotal"]);
            ?>
        </tr>
		<input type='hidden' id='subtotal' name='subtotal' value="<?=$myrow["subtotal"]?>">
         <tr bgcolor="#FFFFFF">
            <td colspan=2><span class="labeltext"><p align="right">Shipping Charges</p></font></td>
            <td align="right"><span class="tabletext">
            <?php
            	printf('$%.2f',$myrow["shipping"]);
           ?>
        </tr>
		<input type='hidden' id='shipping' name='shipping' value="<?=$myrow["shipping"]?>">
       <tr bgcolor="#FFFFFF">
            <td colspan=2><span class="labeltext"><p align="right">Sales Tax</p></font></td>
            <td align="right"><span class="tabletext">
            <?php
            	printf('$%.2f',$myrow["salestax"]);?>
        </tr>
	   <input type='hidden' id='salestax' name='salestax' value="<?=$myrow["salestax"]?>">
		   <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Additional Info</font>&nbsp;&nbsp;<input type="text" name="advance_info" id="advance_info" size=50  value="<?php echo $myrow["advance_info"] ?>"></td>
			<td><span class="labeltext"><p align="right">Additional Amount</p></font></td>
            <td align="right"><input type="text" name="advance_amount" id="advance_amount" size=3 value="<?php echo $myrow["advance_amount"] ?>" onkeyup="javascript:Calculate_total()"></td> 
        </tr>


      <tr bgcolor="#FFFFFF">
            <td colspan=2><span class="labeltext"><p align="right">Total</p></font></td>
            <td align="right"><span class="tabletext"><input type="text" name="inv_totamt" size=3 id ="inv_totamt" style="background-color:#DDDDDD;text-align:right"
		  		readonly="readonly" value="<?php  printf('$%.2f',$myrow["total"]) ?>"></td>
        </tr>	

 </tr>
 </table>
<?php }?>

<!-- <td width="6"><img src="images/spacer.gif " width="6"></td>
		</tr>
			<tr bgcolor="DEDFDE">
				<td width="6"><img src="images/box-left-bottom.gif"></td>
				<td><img src="images/spacer.gif " height="6"></td>
				<td width="6"><img src="images/box-right-bottom.gif"></td>
			</tr>
		</table> -->
			<table border = 0 cellpadding=0 cellspacing=0 width=100% >
				<tr>
					<td align=left>
						</td>
					</tr>
				</table>
                <span class="tabletext"><input type="submit"
                     style="color=#0066CC;background-color:#DDDDDD;width=130;"
                     value="Submit" name="submit" onclick="javascript: return check_req_fields()">
                <INPUT TYPE="RESET"
                     style="color=#0066CC;background-color:#DDDDDD;width=100;"
                     VALUE="Reset" onclick="javascript: putfocus()">

					</FORM>
		</body>
</html>