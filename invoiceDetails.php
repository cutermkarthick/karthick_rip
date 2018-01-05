<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = Dec 8, 2006                  =
// Filename: invoiceDetails.php                =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OWT                          =
// invoice Details                             =
//==============================================
session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];

$_SESSION['pagename'] = 'invoicedetails';
$page = "Invoice: Invoice";
////////session_register('pagename');

// First include the class definition
include('classes/userClass.php');
include('classes/invoiceClass.php');
include('classes/invoiceliClass.php');
include('classes/displayClass.php');

$newlogin = new userlogin;
$newlogin->dbconnect();
$userid = $_SESSION['user'];

$newinvoice = new invoice;
$newLI = new invoiceli;
$newdisplay = new display;
$invoicerecnum = $_REQUEST['invoicerecnum'];
$custname=$_REQUEST['inv2customer'];
//echo $invoicerecnum;
$result = $newinvoice->getinvoicedetails($invoicerecnum);
$myrow = mysql_fetch_assoc($result);
$result1 = $newLI->getinvoiceli($invoicerecnum);
$resultprint = $newLI->getinvoiceli($invoicerecnum);
   $cofc_flag=0;
?>

<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/invoice.js"></script>

<html>
<head>
<title>Invoice Details</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">
<?php
include('header.html');
?>
<!-- <table width=100% cellspacing="0" cellpadding="6" border="0">
<tr><td>
<table width=100% border=0 cellspacing="0" cellpadding="0">
       <tr>
          <td><span class="welcome"><b>Welcome <?php echo $userid?></b></td>
          <td align="right">&nbsp;
          <a href="exit.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image16','','images/logout_mo.gif',1)"><img name="Image16" border="0" src="images/logout.gif"></a></td>
       </tr>
</table>
<table width=100% border=0 cellpadding=0 cellspacing=0  >
<tr><td>
</td></tr>
<tr>
<td>

<?php  $newdisplay->dispLinks(''); ?>

</td></tr>
</table>
<table width=100% border=0 cellpadding=0 cellspacing=0  >
<tr bgcolor="DEDFDE">
<td width="6"><img src="images/spacer.gif " width="6"></td>
<td bgcolor="#FFFFFF">-->
<table width=100% border=0 cellspacing="1" cellpadding="6" class="stdtable1">
<tr> 
<td><span class="pageheading"><b>Invoice Details</b><td colspan=250></td>
    <td bgcolor="#FFFFFF" rowspan=2 align="right">
    <input type="button" class="stdbtn btn_blue" style="float:right;padding:2px;margin-right:5px;" onClick="location.href='invoiceEdit.php?invoicerecnum=<?php echo $invoicerecnum ?>'" value="Edit Invoice" >              
 <!--          <a href ="invoiceEdit.php?invoicerecnum=<?php echo $invoicerecnum ?>" ><img name="Image8" border="0" src="images/bu_editinvoice.gif" ></a> -->
<?php
 while ($li_print = mysql_fetch_assoc($resultprint))
      {
		  if($li_print["cofc_num"]!="")
		  {
              $cofc_flag=0;
		  }else
		  {
              $cofc_flag=1;
		  }
	  }
	  if($cofc_flag==0 || 
             $myrow["name"] == 'HAL-Aircraft' || 
             $myrow["name"] == 'HAL-Helicopter' || 
             $myrow["name"] == 'HAL-NASIK' || 
             $myrow["name"] == 'HAL-LCA' || 
             $myrow["name"] == 'HAL-LCH'
            )
	  {
?>
 <input type= "image" name="Print" src="images/bu-print.gif" value="Print" onclick="javascript: printinvoiceDetails(<?php echo $invoicerecnum ?>)">
 <?php
	  }
?>
 <input type="button" class="stdbtn btn_blue" style="float:right;padding:2px;margin-right:5px;" onClick="location.href='exportInvoice.php?invoicerecnum=<?echo $_REQUEST['invoicerecnum']?>'" value="Export" >
    <!-- <a href="exportInvoice.php?invoicerecnum=<?echo $_REQUEST['invoicerecnum']?>"><img name="Image8" border="0" src="images/export.gif" ></a></td> -->

  </tr>
         <?php
		                                                      if($myrow["invdate"] != '0000-00-00' && $myrow["invdate"]!= '' && $myrow["invdate"] != 'NULL')
                                                              {
                                                                   $datearr = split('-', $myrow["invdate"]);
                                                                   $d=$datearr[2];
                                                                   $m=$datearr[1];
                                                                   $y=$datearr[0];
                                                                   $x=mktime(0,0,0,$m,$d,$y);
                                                                   $invdate=date("M j, Y",$x);
                                                               }
                                                              else
                                                              {
                                                                    $invdate = '';
                                                               }
         if($myrow["dcdate"] != '0000-00-00' && $myrow["dcdate"]!= '' && $myrow["dcdate"] != 'NULL')
                {
                    $datearr = split('-', $myrow["dcdate"]);
                    $d=$datearr[2];
                    $m=$datearr[1];
                    $y=$datearr[0];
                    $x=mktime(0,0,0,$m,$d,$y);
                    $dcdate=date("M j, Y",$x);
               }
              else
              {
                   $dcdate = '';
              }
          ?>

<table border=0 bgcolor="#DFDEDF" width=100% >
<tr>
<td>
 <table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1" class="stdtabl1e">
<tr bgcolor="#FFFFFF">
    <td width=50%><span class="labeltext">Exporter</p></font></td>
    <td width=50%><span class="labeltext">Invoice # & Date</p></font></td>
<tr bgcolor="#FFFFFF">
    <td width=50%><span class="labeltext"><b>CIM TOOLS PRIVATE LIMITED</b></font></td>
    <td width=50%><span class="tabletext"><b><?php echo $myrow["invnum"]," ","Dated:", $invdate ?></b></td>

<tr bgcolor="#FFFFFF">
    <td width=50%><span class="labeltext">PLOT No. 467-469, Site No. 1D, 12th Cross</font></td>
    <td width=50%><span class="labeltext">Buyers Order Nos. & Date</font></td>
<tr bgcolor="#FFFFFF">
    <td width=50%><span class="labeltext"><p align="left">4th Phase, Peenya Industrial Area</font></td>
    <td width=50%><span class="tabletext">Please refer below</td>
<tr bgcolor="#FFFFFF">
    <td width=50%><span class="labeltext">Bangalore - 560058, INDIA.</font></td>
    <td width=50%><span class="tabletext">Other References</td>
<tr bgcolor="#FFFFFF">
    <td width=50%><span class="labeltext">&nbsp</font></td>
    <td width=50%><span class="tabletext">IEC No. 0797004271 & TIN: 29720060144</td>
 </tr>
</table>
<table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=6>
   <td  bgcolor="#F5F6F5" width=50%><span class="heading"><center><b>Consignee/Buyer</b></center></td>
   <td bgcolor="#F5F6F5" width=50%><span class="heading"><b><center>Buyer (if other than consignee)</center></b></td>

  <table width=100% border=0 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF" >
  <tr class="bgcolor2" bordercolor="#CCCCCC" >
            <td  bgcolor="#FFFFFF" width=50%><span class="style6"><?php echo $myrow["name"] ?></td>
            <td  bgcolor="#FFFFFF" width=50%><span class="style6"><?php echo $myrow["sname"] ?></td>
       </tr>

       <tr bgcolor="#FFFFFF">
            <td  bgcolor="#FFFFFF" width=50%><span class="tabletext"><?php echo $myrow["baddr1"] . "," . $myrow1["baddr2"]?></td>
            <td  bgcolor="#FFFFFF" width=50%><span class="tabletext"><?php echo $myrow["saddr1"] . "," . $myrow1["saddr2"]?></td>
       </tr>

        <tr bgcolor="#FFFFFF">
            <td  bgcolor="#FFFFFF" width=50%><span class="tabletext"><?php echo $myrow["bcity"] . "," . $myrow1["bstate"] . "," . $myrow1["bzipcode"] ?></td>
            <td  bgcolor="#FFFFFF" width=50%><span class="tabletext"><?php echo $myrow1["scity"] . "," . $myrow1["sstate"] . "," . $myrow1["szipcode"]?></td>
       </tr>

        <tr bgcolor="#FFFFFF">
            <td  bgcolor="#FFFFFF" width=50%><span class="tabletext"><?php echo $myrow["bcountry"]?></td>
            <td  bgcolor="#FFFFFF" width=50%><span class="tabletext"><?php echo $myrow["scountry"]?></td>
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
            <td width=20%><span class="labeltext"><p align="left">DC NO:</p></font></td>
            <td width=20%><span class="tabletext"><?php echo $myrow["dcnum"] ?></td>
            <td width=20%><span class="labeltext"><p align="left">DC Date:</p></font></td>
            <td width=20%><span class="tabletext"><p align="left"><?php echo  $dcdate ?></td>
            </td>
		</tr>
             <tr bgcolor="#FFFFFF">
            <td width=20%><span class="labeltext">Due Date</td>
            <td width=20% colspan=3><span class="tabletext"><?php echo $duedate ?></td>
        </tr>
	         <tr bgcolor="#FFFFFF">
            <td width=20%><span class="labeltext"><p align="left">Pre-Carriage by</p></font></td>
            <td width=20%><span class="tabletext"><?php echo $myrow["precarriageby"] ?></td>
            <td width=20%><span class="labeltext"><p align="left">Pre-carrier Place of Receipt</p></font></td>
            <td width=20%><span class="tabletext"><p align="left"><?php echo  $myrow["precarrierreceipt"] ?></td>
            </td>
		</tr>
		 <tr bgcolor="#FFFFFF">
            <td width=20%><span class="labeltext"><p align="left">Country of Origin</p></font></td>
            <td width=20%><span class="tabletext"><?php echo $myrow["countryoforigin"] ?></td>
            <td width=20%><span class="labeltext"><p align="left">Country of Final Destination</p></font></td>
            <td width=20%><span class="tabletext"><p align="left"><?php echo $myrow["countryoffinaldest"] ?></td>
            </td>
		</tr>

	    <tr bgcolor="#FFFFFF">
            <td width=20%><span class="labeltext"><p align="left">Vessel</p></font></td>
            <td width=20%><span class="tabletext"><?php echo $myrow["vessel"] ?></td>
            <td width=20%><span class="labeltext"><p align="left">Port of Loading</p></font></td>
            <td width=20%><span class="tabletext"><p align="left"><?php echo $myrow["portofloading"] ?></td>
            </td>
        </tr>

	    <tr bgcolor="#FFFFFF">
            <td width=20%><span class="labeltext">Port of Discharge</font></td>
            <td width=20%><span class="tabletext"><?php echo $myrow["portofdischarge"] ?></td>
            <td width=20%><span class="labeltext"><p align="left">Marks & No. of Packages</p></font></td>
            <td width=20%><span class="tabletext"><p align="left"><?php echo $myrow["packages"] ?></td>
            </td>
        </tr>



        <tr bgcolor="#FFFFFF">
            <td width=20%><span class="labeltext">Currency</td>
            <td width=20%><span class="tabletext"><?php echo $myrow["currency"] ?></td>
            <td width=20%><span class="labeltext">FOB/C&F/DAP</td>
            <td width=20%><span class="tabletext"><?php echo $myrow["fob_or_candf"] ?></td>
        </tr>


	        <!--<tr bgcolor="#FFFFFF">
            <td colspan=2><span class="labeltext">Marks & No. of Packages</td>
            <td colspan=2><span class="tabletext"><?php //echo $myrow["packages"] ?></td>
        </tr>-->
 </table>
     			<table width=100% border=0 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF" >
                <tr bgcolor="#FFFFFF">
                <td><span class="labeltext"><p align="left">Remarks</p></font></td>
                <td ><textarea name="remarks" id="remarks" rows="6" cols="95" style="background-color:#DDDDDD;"
                               readonly="readonly"><?php echo $myrow["remarks"] ?></textarea></td></tr>

                <tr bgcolor="#FFFFFF">
                <td><span class="labeltext"><p align="left">terms</p></font></td>
                <td ><textarea name="remarks" id="terms" rows="6" cols="95" style="background-color:#DDDDDD;"
                               readonly="readonly"><?php echo $myrow["terms"] ?></textarea></td></tr>
                </table>
  <br>
</table>
 <br>
<table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3>
<tr bgcolor="#DDDEDD">
<td colspan=4><span class="heading"><center><b> Line Items</b></center></td>
</tr>
<tr bgcolor="#FFFFFF">
<table id="myTable" width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
<td bgcolor="#EEEFEE" width=5%><span class="heading"><b><center>Seq#</center></b></td>
<td bgcolor="#EEEFEE" width=5%><span class="heading"><b><center>CRN</center></b></td>
<td bgcolor="#EEEFEE" width=15%><span class="heading"><b><center>Partnum</center></b></td>
<td bgcolor="#EEEFEE" width=17%><span class="heading"><b><center>Description</center></b></td>
<td bgcolor="#EEEFEE" width=8%><span class="heading"><b><center>CofC</center></b></td>
<td bgcolor="#EEEFEE" width=10%><span class="heading"><b><center>PO #</center></b></td>
<td bgcolor="#EEEFEE" width=8%><span class="heading"><b><center>PO LN.#</center></b></td>
<td bgcolor="#EEEFEE" width=8%><span class="heading"><b><center>Sch PO</center></b></td>
<td bgcolor="#EEEFEE" width=10%><span class="heading"><b><center>Raw Mtl</center></b></td>
<td bgcolor="#EEEFEE" width=10%><span class="heading"><b><center>Tariff Sch</center></b></td>
<td bgcolor="#EEEFEE" width=10%><span class="heading"><b><center>Packaging<br>(inches)</center></b></td>
<td bgcolor="#EEEFEE" width=5%><span class="heading"><b><center>Quantity</center></b></td>
<td bgcolor="#EEEFEE" width=5%><span class="heading"><b><center>Type</center></b></td>
<td bgcolor="#EEEFEE" width=7%><span class="heading"><b><center>Price</center></b></td>
<td bgcolor="#EEEFEE" width=8%><span class="heading"><b><center>Amount</center></b></td>
</tr>
<?php
     $currency = $myrow["currency"];
     $i = 1;
     $totalamt = 0;
      while ($li = mysql_fetch_assoc($result1))
      {
	printf('<tr bgcolor="#FFFFFF">');
	$line_num = $li["line_num"];
	$crnnum = $li["crnnum"];
        $partnum = $li["cimpartnum"];
	$cofc = $li["cofc_num"];
	$ponum = $li["custpo_num"];
	$descr = $li["descr"];
	$rawmtl = $li["rawmtl"];
	$noofpackages = $li["noofpackages"];
	$packaging = $li["packaging"];
	$tariffsch = $li["tariff_schedule"];
	$qty = $li["qty"];
	$price = $li["price"];
 	$amount = $li["line_amount"];
        $totalamt += $amount;

	$type = $li["type"];
	//$packaging = $li["packaging"];
	$polinenum = $li["polinenum"];
	$schpo = $li["schpo"];
    $packaging = htmlentities($li["packaging"]);
	echo "<td align=\"center\"><span class=\"tabletext\">$line_num</td>";
	echo "<td align=\"center\"><span class=\"tabletext\">$crnnum</td>";
	echo "<td align=\"center\"><span class=\"tabletext\">$partnum</td>";
	echo "<td align=\"center\"><span class=\"tabletext\">$descr</td>";
	echo "<td align=\"center\"><span class=\"tabletext\">$cofc</td>";
 	echo "<td align=\"center\"><span class=\"tabletext\">$ponum</td>";
 	echo "<td align=\"center\"><span class=\"tabletext\">$polinenum</td>";
	echo "<td align=\"center\"><span class=\"tabletext\">$schpo</td>";
    echo "<td align=\"center\"><span class=\"tabletext\">$rawmtl</td>";
    echo "<td align=\"center\"><span class=\"tabletext\">$tariffsch</td>";
    echo "<td align=\"center\"><span class=\"tabletext\">$packaging</td>";
	echo "<td align=\"center\"><span class=\"tabletext\">$qty</td>";
	echo "<td align=\"center\"><span class=\"tabletext\">$type</td>";
    printf('<td align="right"><span class="tabletext">%s %.2f</td>',$currency,$price);
	printf('<td align="right"><span class="tabletext">%s %.2f</td>',$currency,$amount);
	printf('</tr>');
	printf('</tr>');
	$i++;
	?>
 <?php
    }
	$grand_total=$totalamt-$myrow["advance_amount"];

?>
</table>

<?php

$customername = $myrow["name"]  ;
//$customername ='Mahindra';
if($customername ==  'MAHINDRA AEROSTRUCTURES PVT. LTD')
{
?>
<Table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1" >
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
            			  <td align="right"><span class="tabletext"><input type="text" name="inv_totamt" size=7 id ="inv_totamt" style="background-color:#DDDDDD;text-align:right"
		  		readonly="readonly" value="<?php  printf('Rs. %.2f',$myrow["total"]) ?>"></td>
        </tr>		
 </tr>
 </table>
 

<?php

} 
else if($customername ==  'Aerostructures Assemblies India Pvt.Ltd')
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
            <td colspan=2 style="width:90%"><span class="labeltext"><p align="right">VAT (14.5%)</p></font></td>
            <td align="right"><span class="tabletext">
            <?php
            	printf('%.2f',$myrow["vat"]);
            // echo  "$myrow[21]"?>
        </tr>
		<input type='hidden' id='vat' name='vat' value="<?=$myrow["vat"]?>">

      <tr bgcolor="#FFFFFF">
            <td colspan=2 style="width:90%"><span class="labeltext"><p align="right">Total</p></font></td>
            			  <td align="right"><span class="tabletext"><input type="text" name="inv_totamt" size=7 id ="inv_totamt" style="background-color:#DDDDDD;text-align:right"
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
                    <td align="right"><span class="tabletext"><input type="text" name="inv_totamt" size=7 id ="inv_totamt" style="background-color:#DDDDDD;text-align:right"
          readonly="readonly" value="<?php  printf('$%.2f',$myrow["total"]) ?>"></td>
        </tr>   
 </tr>
 </table>
 



<?php

}
else 
	
{
?>

    <table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3 classs="stdtable1">
        <tr>
         <tr bgcolor="#FFFFFF">
       <table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
          <td align="right"><span class="pageheading"><b></b></td><td width="8%"></td></tr>

 
      <tr bgcolor="#FFFFFF">
            <td colspan=7><span class="labeltext"><p align="right">&nbsp</p></font></td>
           <td align="right"><span class="tabletext">
         </tr>

      <tr bgcolor="#FFFFFF">
            <td colspan=7><span class="labeltext"><p align="right">&nbsp</p></font></td>
           <td align="right"><span class="tabletext">
         </tr>

		 <tr bgcolor="#FFFFFF">
            <td colspan=6><span class="labeltext"><p align="left">Additional Info:</font>&nbsp;&nbsp;&nbsp;<span class="tabletext"><?php echo $myrow["advance_info"] ?></td>
			<td><span class="labeltext"><p align="right">Additional Amount:</p></font></td>
            <td align="right" width='5%'><span class="tabletext"><?php echo $myrow["advance_amount"] ?></td> 
        </tr>

        <tr bgcolor="#FFFFFF">
            <td colspan=7><span class="labeltext"><p align="right">Total </p></font></td>
            <td align="right"><span class="tabletext">
            <?php
            	printf('%s %.2f',$currency,$grand_total);
            //printf('%s%.2f</td>',$myrow[30],$myrow[21]); ?>
        </tr>

        </tr>
    </table>
<?php }?>
 </td>
 <table border=3 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3>
        <tr bgcolor="#FFFFFF">
            <td colspan=4><span class="labeltext">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</td>
            <td colspan=2><span class="labeltext"><?php echo $myrow["formrev"] ?></td>
            <td colspan=2><span class="labeltext">Fluentwms</td>
        </tr>

</table>
  		</table>
      </FORM>
</table>
</body>
</html>
