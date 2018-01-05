<?php
session_start();
header("Cache-control: private");
if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];

$_SESSION['pagename'] = 'shippingedit';
$page = "Invoice: Excise";
//////session_register('pagename');
include('classes/displayClass.php');
include('classes/shippingClass.php');
$newshiping = new shipping;
$newdisp = new display;
$invrecnum=$_REQUEST['link2invoice'];
$shiprecnum=$_REQUEST['shiprecnum'];

$result_ship= $newshiping->getshippingdetails($shiprecnum);
$myship =mysql_fetch_assoc($result_ship);
//$fobinwords=$newshiping ->convert_number(round($myship["fob_inr"])) ;
$fobinwords=ucfirst($newshiping ->convert_number(round($myship["fob_inr"]))) ;
$result= $newshiping->getinvoicedetails($invrecnum);
$myinvoice=mysql_fetch_assoc($result);
$result_li=$newshiping->getshippinglidetails($shiprecnum);

if($myship["sbdate"] != '0000-00-00' && $myship["sbdate"]!= '' && $myship["sbdate"] != 'NULL')
{
$datearr = split('-', $myship["sbdate"]);
$d=$datearr[2];
$m=$datearr[1];
$y=$datearr[0];
$x=mktime(0,0,0,$m,$d,$y);
$sbdate=date("M j, Y",$x);
}
else
{
$sbdate = '';
}

if($myship["qcertdate"] != '0000-00-00' && $myship["qcertdate"]!= '' && $myship["qcertdate"] != 'NULL')
{
$datearr = split('-', $myship["qcertdate"]);
$d=$datearr[2];
$m=$datearr[1];
$y=$datearr[0];
$x=mktime(0,0,0,$m,$d,$y);
$qcertdate=date("M j, Y",$x);
}
else
{
$qcertdate = '';
}

if($myship["rbiappdate"] != '0000-00-00' && $myship["rbiappdate"]!= '' && $myship["rbiappdate"] != 'NULL')
{
$datearr = split('-', $myship["rbiappdate"]);
$d=$datearr[2];
$m=$datearr[1];
$y=$datearr[0];
$x=mktime(0,0,0,$m,$d,$y);
$rbiappdate=date("M j, Y",$x);
}
else
{
$rbiappdate = '';
}

if($myship["createdate"] != '0000-00-00' && $myship["createdate"]!= '' && $myship["createdate"] != 'NULL')
{
$datearr = split('-', $myship["createdate"]);
$d=$datearr[2];
$m=$datearr[1];
$y=$datearr[0];
$x=mktime(0,0,0,$m,$d,$y);
$shipdate=date("M j, Y",$x);
}
else
{
$shipdate = '';
}

if($myship["ar4adate"] != '0000-00-00' && $myship["ar4adate"]!= '' && $myship["ar4adate"] != 'NULL')
{
$datearr = split('-', $myship["ar4adate"]);
$d=$datearr[2];
$m=$datearr[1];
$y=$datearr[0];
$x=mktime(0,0,0,$m,$d,$y);
$ar4adate=date("M j, Y",$x);
}
else
{
$ar4adate = '';
}

if($myinvoice["invdate"] != '0000-00-00' && $myinvoice["invdate"]!= '' && $myinvoice["invdate"] != 'NULL')
{
$datearr = split('-', $myinvoice["invdate"]);
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
?>
<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/shipping.js"></script>
<html>
<head>
<script language="javascript" type="text/javascript">
function readOnlyRadio() {
   return false;
}

</script>
<title>Shipping Details</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">
<!--<form  action='shippingProcess.php' method='post' enctype='multipart/form-data'>-->
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
<td><span class="pageheading"><b>Shipping Details</b></td>
<td align="right"><a href ="shippingEdit.php?shippingrecnum=<?php echo $shiprecnum ?>" ><img name="Image8" border="0" src="images/editshipping.gif" ></a>
<input type= "image" name="Print" src="images/bu-print.gif" value="Print" onClick="javascript: printshipping(<?php echo $shiprecnum ?>)">
</td>
</tr>
</table>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1">
<tr bgcolor="#FFFFFF">
<tr bgcolor="#EEEFEE"><td colspan=4><span class="heading"><center><b>General Information</b></center></td>
</tr></table>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="statb">
<tr bgcolor="#FFFFFF">
<td width=15% colspan=1><span class="labeltext"><p align="left">Shipping #</p></td>
<td width=15%><span class="tabletext"><?php echo $myship["shipping_id"]  ?></span></td>
<td width=15%><span class="labeltext"><p align="left">Shipping Date</p></td>
<td width=15%><span class="tabletext"><?php echo $shipdate  ?></span>

</td>
</tr>
<tr bgcolor="#FFFFFF">
<td colspan=2><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Exporter</p></font></td>
<td colspan=2><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Ship To</p></font></td></tr>
<tr bgcolor="#FFFFFF">
<td colspan=2><span class="tabletext"><?php echo $myinvoice["name"]  ?></span></td>
<td colspan=2><span class="tabletext"><?php echo $myinvoice["saddr1"]  ?></span></td>
</tr>
<tr bgcolor="#FFFFFF">
<td colspan=2><span class="tabletext"><?php echo $myinvoice["addr1"]?></td>
<td colspan=2><span class="tabletext"><?php echo $myinvoice["saddr1"] ?></td>
</tr>
<tr bgcolor="#FFFFFF">
<td colspan=2><span class="tabletext"><?php echo $myinvoice["city"] . " " . $myinvoice["state"]. " " . $myinvoice["zipcode"]; ?></td>
<td colspan=2><span class="tabletext"><?php echo $myinvoice["scity"] . " " . $myinvoice["sstate"]?></td>
</tr>
<tr bgcolor="#FFFFFF">
<td colspan=2><span class="tabletext"><?php echo $myinvoice["country"]; ?></td>
<td colspan=2><span class="tabletext"><?php echo $myinvoice["scountry"]; ?></td>
</tr>
 <br>
<tr bgcolor="#FFFFFF">
<td width=15%><span class="labeltext"><p align="left">Invoice #</p></td>
<td ><span class="tabletext"><?php echo $myinvoice["invnum"]  ?></span></td>
<td width=15%><span class="labeltext"><p align="left">Invoice Date</p></td>
<td ><span class="tabletext"><?php echo $invdate  ?>
<input type="hidden" name="invrecnum" id="invrecnum" value="<?php echo $myinvoice["recnum"]  ?>"</span>

</td>
</tr>
<tr bgcolor="#FFFFFF">
<td width=15%><span class="labeltext"><p align="left">SB #</p></td>
<td ><span class="tabletext"><?php echo $myship["sbnum"]  ?></td>
<td width=15%><span class="labeltext"><p align="left">SB Date</p></td>
<td ><span class="tabletext"><?php echo $sbdate  ?></td>
</tr>
<tr bgcolor="#FFFFFF">
<td width=15%><span class="labeltext"><p align="left">AR4A #</p></td>
<td ><span class="tabletext"><?php echo $myship["ar4anum"]  ?></td>
<td width=15%><span class="labeltext"><p align="left">AR4A Date</p></td>
<td ><span class="tabletext"><?php echo $ar4adate  ?></td>
</tr>
<tr bgcolor="#FFFFFF">
<td width=15%><span class="labeltext"><p align="left">Q/Cert #</p></td>
<td ><span class="tabletext"><?php echo $myship["qcertnum"]  ?></td>
<td width=15%><span class="labeltext"><p align="left">Q/Cert Date</p></td>
<td ><span class="tabletext"><?php echo $qcertdate  ?></td>
</tr>
<tr bgcolor="#FFFFFF">
<td width=15%><span class="labeltext"><p align="left">Import Export Code #</p></td>
<td ><span class="tabletext"><?php echo $myship["impexpcode"]  ?></td>
<td width=15%><span class="labeltext"><p align="left">RBI Code #</p></td>
<td ><span class="tabletext"><?php echo $myship["rbicode"]  ?></td>
</tr>

<tr bgcolor="#FFFFFF">
<td width=15%><span class="labeltext"><p align="left">Custom House Agent</p></td>
<td><span class="tabletext"><?php echo $myship["custom_agent"]  ?></td>
<td width=15%><span class="labeltext"><p align="left">LIC NO.</p></td>
<td><span class="tabletext"><?php echo $myship["licnum"]  ?></td>
</tr>
<tr bgcolor="#FFFFFF">
<td width=15%><span class="labeltext"><p align="left">Pre-Carriage By</p></td>
<td><span class="tabletext"><?php echo $myinvoice["precarriageby"]  ?></td>
<td width=15%><span class="labeltext"><p align="left">Place Of Receipt<br>By Pre-Carrier</p></td>
<td><span class="tabletext"><?php echo $myinvoice["precarrierreceipt"]  ?></td>
</tr>
<tr bgcolor="#FFFFFF">
<td width=15%><span class="labeltext"><p align="left">Vessel/Flight No.</p></td>
<td><span class="tabletext"><?php echo $myinvoice["vessel"]  ?></td>
<td width=15%><span class="labeltext"><p align="left">Rotating No.</p></td>
<td><span class="tabletext"><?php echo $myship["rotatingnum"]  ?></td></tr>
<tr bgcolor="#FFFFFF">
<td width=15%><span class="labeltext"><p align="left">Port Of Loading</p></td>
<td colspan=3><span class="tabletext"><?php echo $myinvoice["portofloading"]  ?></td>
</tr>
<tr bgcolor="#FFFFFF">
<td width=15%><span class="labeltext"><p align="left">Port Of Discharge</p></td>
<td><span class="tabletext"><?php echo $myinvoice["portofloading"]  ?></td>
<td width=15%><span class="labeltext"><p align="left">Country Of Destination</p></td>
<td><span class="tabletext"><?php echo $myinvoice["countryoffinaldest"]  ?></td></tr>
</table>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
<tr bgcolor="#FFFFFF">
<td rowspan=2 width=15%><span class="labeltext"><p align="left">Export Trade Control</p></td>
<td><span class="labeltext"><p align="left">If Export Under<br> Deffered Credit</p></td>
<td><span class="labeltext"><p align="left">Joint Ventures</p></td>
<td><span class="labeltext"><p align="left">Rupee Credit</p></td>
<td><span class="labeltext"><p align="left">Others</p></td>
<td><span class="labeltext"><p align="left">RBI's Approval<br>/CIR. No.</p></td>
<td><span class="labeltext"><p align="left">RBI's Approval Date</p></td>
</tr>
<?php

   $checked12="";

   if($myship["jointventure"] == 'yes'){
   $checked12="checked";
   }
   $checked13="";

   if($myship["rupcredit"] == 'yes'){
   $checked13="checked";
   }

   $checked14="";

   if($myship["otherex"] == 'yes'){
   $checked14="checked";
   }
   $checked15="";

   if($myship["deffcredit"] == 'yes'){
   $checked15="checked";
   }
   $checked21="";

   if($myship["outrightsale"] == 'yes'){
   $checked21="checked";
   }
   $checked22="";

   if($myship["consignmentexp"] == 'yes'){
   $checked22="checked";
   }

   $checked23="";

   if($myship["othersh"] == 'yes'){
   $checked23="checked";
   }

?>
<tr bgcolor="#FFFFFF">
<td>
<input type="checkbox" name="chk14" id="chk14" <?php echo $checked15 ?> onclick="return readOnlyRadio()">
                         <input type="hidden" name="deffcredit" value="<?php echo $myship["deffcredit"] ?>" id="deffcredit"></td>
<td><input type="checkbox" name="chk11" id="chk11" <?php echo $checked12 ?> onclick="return readOnlyRadio()">
                         <input type="hidden" name="jointven" value="<?php echo $myship["jointventure"] ?>" id="jointven"></td>
<td><input type="checkbox" name="chk12" id="chk12"<?php echo $checked13 ?>  onclick="return readOnlyRadio()">
                         <input type="hidden" name="rucredit" value="<?php echo $myship["rupcredit"] ?>" id="rucredit"></td>
<td><input type="checkbox" name="chk13" id="chk13" <?php echo $checked14 ?> onclick="return readOnlyRadio()">
                         <input type="hidden" name="others_ex" value="<?php echo $myship["otherex"] ?>" id="others_ex"></td>
<td><span class="tabletext"><?php echo $myship["rbiappcode"] ?></td>
<td ><input type="text" id="rbiappdate" name="rbiappdate"
   				style="background-color:#DDDDDD;"
  				 readonly="readonly" size=20 value="<?php echo $rbiappdate ?>">
</td>
</tr>
<tr bgcolor="#FFFFFF">
<td rowspan=2 width=15%><span class="labeltext"><p align="left">Type Of Shipment</p></td>
<td><span class="labeltext"><p align="left">Outright Sale</p></td>
<td><span class="labeltext"><p align="left">Consignment Export</p></td>
<td colspan=6><span class="labeltext"><p align="left">Others(Specify)</p></td>
</tr>

<tr bgcolor="#FFFFFF">
<td><input type="checkbox"  name="outrightsale" <?php echo $checked21 ?> onclick="return readOnlyRadio()">
                         </td>
<td><input type="checkbox"  name="conexp" <?php echo $checked22 ?> onclick="return readOnlyRadio()">
                         </td>
<td colspan=6><input type="checkbox"  name="other_sh" <?php echo $checked23 ?> onclick="return readOnlyRadio()">
                         </td>
</tr>
</table>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >

<tr bgcolor="#FFFFFF">
<td rowspan=2 width=15%><span class="labeltext"><p align="left">Nature Of Contract</p></td>
<td><span class="labeltext"><p align="left">CF</p></td>
<td><span class="labeltext"><p align="left">CFR</p></td>
<td><span class="labeltext"><p align="left">FOB</p></td>
<td><span class="labeltext"><p align="left">Others(Specify)</p></td>
</tr>
<?php

   $checked1="";

   if($myship["cf"] == 'yes'){
   $checked1="checked";
   }
   $checked2="";

   if($myship["cfr"] == 'yes'){
   $checked2="checked";
   }
   $checked3="";

   if($myship["fob"] == 'yes'){
   $checked3="checked";
   }
   $checked4="";

   if($myship["contractother"] == 'yes'){
   $checked4="checked";
   }
   ?>
<tr bgcolor="#FFFFFF">
<td><input type="checkbox"  name="cf" <?php echo $checked1 ?> onclick="return readOnlyRadio()">
                         </td>
<td><input type="checkbox" name="cfr" <?php echo $checked2 ?> onclick="return readOnlyRadio()">
                         </td>
<td><input type="checkbox" name="fob" <?php echo $checked3 ?> onclick="return readOnlyRadio()">
                         </td>
<td><input type="checkbox"  name="other_cony" <?php echo $checked4 ?> onclick="return readOnlyRadio()">
                         </td>
</tr>
</table>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
<tr bgcolor="#FFFFFF">
<td width=17%><span class="labeltext"><p align="left">Exchange Rate U/S 14 of A</p></td>
<td><span class="tabletext"><?php echo $myship["exchangerate"]  ?></td>

<td width=17%><span class="labeltext"><p align="left">Currency Of Invoice</p></td>
<td><span class="tabletext"><?php echo $myinvoice["currency"]  ?></td></tr>
</tr>
<tr bgcolor="#DDDEDD">
                    <td colspan=4><span class="heading"><center><b>Shipping Line Items</b></center></td>
                </tr>
                <tr bgcolor="#FFFFFF">
                <table id="myTable" width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
                    <td bgcolor="#EEEFEE" width=1%><span class="heading"><b>Sl #</b></td>
                    <td bgcolor="#EEEFEE" width=15%><span class="heading"><b>Marks &NOS. No. & KInd<br>Of Pkgs. Container Nos.</b></td>
		            <td bgcolor="#EEEFEE" width=25%><span class="heading"><b>Statistical Code &<br> Description Of Goods</b></td>
					 <td bgcolor="#EEEFEE" width=10%><span class="heading"><b><center>Qty</center></b></td>
		            <td bgcolor="#EEEFEE" width=20%><span class="heading"><center><b>Value Of FOB</b></center></td>
                </tr>
<?php
      $i=1;$flag=0;
//while($i<=10)
//{
//if($flag==0)
//{
   $totamt = 0;
   $totqty=0;
   while ($myLI = mysql_fetch_row($result_li))
  {
	printf('<tr bgcolor="#FFFFFF">');
    $linenumber="linenum" . $i;
	$marknum = "marknum" . $i;
	$statnum = "statnum" . $i;
	$qty = "qty" . $i;
	$vfob = "vfob" . $i;
	$prevlinenum="prev_line_num" . $i;
    $lirecnum="lirecnum" . $i;
    if($myLI[4]==0)
    {
      $quantity="";
    }else
    {
      $quantity=$myLI[4];
      $totqty += $quantity;
    }
    if($myLI[5]==0)
    {
     $fobValue="";

    }else
    {
      $fobValue=$myLI[5];
      $totamt += $fobValue;
    }
    $mark_pack=htmlentities($myLI[2]);
	echo "<td width=1%><span class=\"tabletext\">$myLI[1]</td>";
    echo "<td width=15%><span class=\"tabletext\">$mark_pack</td>";
    echo "<td width=25%><span class=\"tabletext\">$myLI[3]</td>";
    echo "<td align=\"right\" width=10%><span class=\"tabletext\">$quantity</td>";
	printf("<td align=\"right\"><span class=\"tabletext\">%.2f</td>",$fobValue);
	echo "<input type=\"hidden\" name=\"$prevlinenum\" value=\"$myLI[1]\">";
	echo "<input type=\"hidden\" name=\"$lirecnum\" value=\"$myLI[0]\">";
	printf('</tr>');
	$i++;
    }
    //$flag=1;
  //}
 //}
   echo "<input type=\"hidden\" name=\"index\" value=$i>";
   echo "<input type=\"hidden\" name=\"curindex\" value=$i>";
   $totamt = $totamt - $myinvoice["advance_amount"];
  ?>
   <tr bgcolor="#FFFFFF">
   <td colspan=2></td>
   <td colspan=2><span class="labeltext"><p align="left">Adv Amount (to be subtracted)</p></td>
   <td align="right"><span class="tabletext"><b><?php echo $myinvoice["advance_amount"]  ?></b></td></tr>


   <tr bgcolor="#FFFFFF">
  <td colspan=2></td>
<td><span class="labeltext"><p align="left">Total</p></td>
<td align="right"><span class="tabletext"><b><?php echo $totqty  ?></b></td>
<td align="right"><span class="tabletext"><b><?php printf("%.2f", $totamt)  ?></b></td></tr>
</tr>
  </table>
<?php
    $fobinwords=ucfirst($newshiping->convert_number(round($myship["exchangerate"]*$totamt))) ;
    $fobinr=$myship["exchangerate"]*$totamt;
?>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
<tr bgcolor="#FFFFFF">
<td width=15%><span class="labeltext"><p align="left">Net Weight</p></td>
<td width=15%><span class="tabletext"><?php echo $myship["netweight"]  ?></td>

<td width=15%><span class="labeltext"><p align="left">Gross Weight</p></td>
<td width=15%><span class="tabletext"><?php echo $myship["grossweight"]  ?></td></tr>
</tr>
<tr bgcolor="#FFFFFF">
<td width=17%><span class="labeltext"><p align="left">Total FOB Value In Words</p></span></td>
<td colspan=3><span class="tabletext"><?php echo "$fobinwords";  ?></td></tr>
<tr bgcolor="#DDDEDD">
                    <td colspan=4><span class="heading"><center><b>Analysis Of Export Value</b></center></td>
                </tr>
                </table>
                <table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
                <tr bgcolor="#FFFFFF">
                <td bgcolor="#EEEFEE" width=5%><span class="heading"><b>&nbsp;</td>
                <td bgcolor="#EEEFEE" width=5%><span class="heading"><b>&nbsp;</td>
		            <td bgcolor="#EEEFEE" width=5%><span class="heading"><b>Currency</b></td>
					 <td bgcolor="#EEEFEE" width=5%><span class="heading"><b>Amount-INR</b></td>
                </tr>
                <tr bgcolor="#FFFFFF">
                <td bgcolor="#FFFFFF" width=5%><span class="heading"><b>FOB value</td>
                <td><span class="tabletext"><?php echo $totamt  ?></td>
                <td><span class="tabletext"><?php echo $myship["fob_currency"]  ?></td>
                <td><span class="tabletext"><?php echo round($fobinr)  ?></td>
                </tr>
                <tr bgcolor="#FFFFFF">
                <td bgcolor="#FFFFFF" width=5%><span class="heading"><b>Freight</td>
                <td><span class="tabletext"><?php echo $myship["freight_value"]  ?></td>
                <td><span class="tabletext"><?php echo $myship["freight_currency"]  ?></td>
                <td><span class="tabletext"><?php echo $myship["freight_inr"]  ?></td>
                </tr>
                <tr bgcolor="#FFFFFF">
                <td bgcolor="#FFFFFF" width=5%><span class="heading"><b>Insurance</td>
                <td><span class="tabletext"><?php echo $myship["insurance_value"]  ?></td>
                <td><span class="tabletext"><?php echo $myship["insurance_currency"]  ?></td>
                <td><span class="tabletext"><?php echo $myship["insurance_inr"]  ?></td>
                </tr>
                <tr bgcolor="#FFFFFF">
                <td bgcolor="#FFFFFF" width=5%><span class="heading"><b>Commission</td>
                <td><span class="tabletext"><?php echo $myship["commission_value"]  ?></td>
                <td><span class="tabletext"><?php echo $myship["commission_currency"]  ?></td>
                <td><span class="tabletext"><?php echo $myship["commission_inr"]  ?></td>
                </tr>
                <tr bgcolor="#FFFFFF">
                <td bgcolor="#FFFFFF" width=5%><span class="heading"><b>Discount</td>
                <td><span class="tabletext"><?php echo $myship["discount_value"]  ?></td>
                <td><span class="tabletext"><?php echo $myship["discount_currency"]  ?></td>
                <td><span class="tabletext"><?php echo $myship["discount_inr"]  ?></td>
                </tr>
                <tr bgcolor="#FFFFFF">
                <td bgcolor="#FFFFFF" width=5%><span class="heading"><b>Other</td>
                <td><span class="tabletext"><?php echo $myship["other_value"]  ?></td>
                <td><span class="tabletext"><?php echo $myship["other_currency"]  ?></td>
                <td><span class="tabletext"><?php echo $myship["other_inr"]  ?></td>
                </tr>
                <tr bgcolor="#FFFFFF">
                <td bgcolor="#FFFFFF" width=5%><span class="heading"><b>Deductions</td>
                <td><span class="tabletext"><?php echo $myship["deduction_value"]  ?></td>
                <td><span class="tabletext"><?php echo $myship["deduction_currency"]  ?></td>
                <td><span class="tabletext"><?php echo $myship["deduction_inr"]  ?></td>
                </tr>
</table>
  </td>
  
  <table border=3 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3>
        <tr bgcolor="#FFFFFF">
            <td colspan=4><span class="labeltext">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</td>
            <td colspan=2><span class="labeltext"><?php echo $myship["formrev"] ?></td>
            <td colspan=2><span class="labeltext">CIMTOOLS PRIVATE LIMITED</td>
        </tr>

</table>
<td width="6"><img src="images/spacer.gif " width="6"></td>
			</tr>
			<tr bgcolor="DEDFDE">
  				<td width="6"><img src="images/box-left-bottom.gif"></td>
				<td><img src="images/spacer.gif " height="6"></td>
				<td width="6"><img src="images/box-right-bottom.gif"></td>
			</tr>
		</table>
      </FORM>
</table>
</body>
</html>
