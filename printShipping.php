<?php
session_start();
header("Cache-control: private");
if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];

$_SESSION['pagename'] = 'printshipping';
//////session_register('pagename');
include('classes/displayClass.php');
include('classes/shippingClass.php');
$newshiping = new shipping;
$newdisp = new display;
//$invrecnum=$_REQUEST['link2invoice'];
$shiprecnum=$_REQUEST['shiprecnum'];

$result_ship= $newshiping->getshippingdetails($shiprecnum);
$myship =mysql_fetch_assoc($result_ship);
$result= $newshiping->getinvoicedetails($myship['link2invoice']);
$myinvoice=mysql_fetch_assoc($result);
$result_li=$newshiping->getshippinglidetails($shiprecnum);
?>
<?php
$d=substr($myship["sbdate"],8,2);
$m=substr($myship["sbdate"],5,2);
$y=substr($myship["sbdate"],0,4);
$x=mktime(0,0,0,$m,$d,$y);
$sbdate=date("M j, Y",$x);

$d=substr($myship["qcertdate"],8,2);
$m=substr($myship["qcertdate"],5,2);
$y=substr($myship["qcertdate"],0,4);
$x=mktime(0,0,0,$m,$d,$y);
$qcertdate=date("M j, Y",$x);

$d=substr($myship["rbiappdate"],8,2);
$m=substr($myship["rbiappdate"],5,2);
$y=substr($myship["rbiappdate"],0,4);
$x=mktime(0,0,0,$m,$d,$y);
$rbiappdate=date("M j, Y",$x);

$d=substr($myship["createdate"],8,2);
$m=substr($myship["createdate"],5,2);
$y=substr($myship["createdate"],0,4);
$x=mktime(0,0,0,$m,$d,$y);
$shipdate=date("M j, Y",$x);

$d=substr($myinvoice["invdate"] ,8,2);
$m=substr($myinvoice["invdate"] ,5,2);
$y=substr($myinvoice["invdate"] ,0,4);
$x=mktime(0,0,0,$m,$d,$y);
$invdate=date("M j, Y",$x);
?>
<link rel="stylesheet" href="style.css">
<html>
<style type="text/css">
<!--
a:link {
	text-decoration: none;
}
a:visited {
	text-decoration: none;
}
a:hover {
	text-decoration: none;
}
a:active {
	text-decoration: none;
}
.style6 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	color: #000000;
	font-size: 10px;
}
.style14 {font-size: 11; font-weight: bold; }
.style16 {font-size: 11; font-weight: bold; }
-->
</style>
<table width=100% border=1 cellpadding=1 cellspacing=1 bgcolor="#DFDEDF" rules="all">
<tr bgcolor="#DDDEDD"><td colspan=4><span class="heading">
<center><b><A HREF="javascript:window.print()">Shipping Bill For Export Of Duty Free Goods<br>Export Promotion Copy</A></b></center></td></tr>
<tr class="bgcolor2" bordercolor="#CCCCCC" >
<td width=15% colspan=1><span class="style6"><p align="left">Shipping #</p></td>
<td width=15%><span class="style6"><?php echo $myship["shipping_id"]  ?></span></td>
<td width=15%><span class="style6"><p align="left">Shipping Date</p></td>
<td width=15%><span class="style6"><?php echo $shipdate  ?></span>
</td>
</tr>
<tr class="bgcolor2" bordercolor="#CCCCCC" >
<td colspan=2><span class="style6"><p align="left">Exporter</p></font></td>
<td colspan=2><span class="style6"><p align="left">Ship To</p></font></td></tr>
<tr class="bgcolor2" bordercolor="#CCCCCC" >
<td colspan=2><span class="style6"><?php echo $myinvoice["name"]  ?></span></td>
<td colspan=2><span class="style6"><?php echo $myinvoice["saddr1"]  ?></span></td>
</tr>
<tr class="bgcolor2" bordercolor="#CCCCCC" >
<td colspan=2><span class="style6"><?php echo $myinvoice["addr1"]?></td>
<td colspan=2><span class="style6"><?php echo $myinvoice["saddr1"] ?></td>
</tr>
<tr class="bgcolor2" bordercolor="#CCCCCC" >
<td colspan=2><span class="style6"><?php echo $myinvoice["city"] . " " . $myinvoice["state"]. " " . $myinvoice["zipcode"]; ?></td>
<td colspan=2><span class="style6"><?php echo $myinvoice["scity"] . " " . $myinvoice["sstate"]?></td>
</tr>
<tr class="bgcolor2" bordercolor="#CCCCCC" >
<td colspan=2><span class="style6"><?php echo $myinvoice["country"]; ?></td>
<td colspan=2><span class="style6"><?php echo $myinvoice["scountry"]; ?></td>
</tr>
<tr class="bgcolor2" bordercolor="#CCCCCC" >
<td width=15%><span class="style6"><p align="left">Invoice #</p></td>
<td ><span class="style6"><?php echo $myinvoice["invnum"]  ?></span></td>
<td width=15%><span class="style6"><p align="left">Invoice Date</p></td>
<td ><span class="style6"><?php echo $invdate  ?>
<input type="hidden" name="invrecnum" id="invrecnum" value="<?php echo $myinvoice["recnum"]  ?>"</span>

</td>
</tr>
<tr class="bgcolor2" bordercolor="#CCCCCC" >
<td width=15%><span class="style6"><p align="left">SB #</p></td>
<td ><span class="style6"><?php echo $myship["sbnum"]  ?></td>
<td width=15%><span class="style6"><p align="left">SB Date</p></td>
<td ><span class="style6"><?php echo $sbdate  ?></td>
</tr>
<tr class="bgcolor2" bordercolor="#CCCCCC" >
<td width=15%><span class="style6"><p align="left">AR4A #</p></td>
<td ><span class="style6"><?php echo $myship["ar4anum"]  ?></td>
<td width=15%><span class="style6"><p align="left">AR4A Date</p></td>
<td ><span class="style6"><?php echo $ar4adate  ?></td>
</tr>
<tr class="bgcolor2" bordercolor="#CCCCCC" >
<td width=15%><span class="style6"><p align="left">Q/Cert #</p></td>
<td ><span class="style6"><?php echo $myship["qcertnum"]  ?></td>
<td width=15%><span class="style6"><p align="left">Q/Cert Date</p></td>
<td ><span class="style6"><?php echo $qcertdate  ?></td>
</tr>
<tr class="bgcolor2" bordercolor="#CCCCCC" >
<td width=15%><span class="style6"><p align="left">Import Export Code #</p></td>
<td ><span class="style6"><?php echo $myship["impexpcode"]  ?></td>
<td width=15%><span class="style6"><p align="left">RBI Code #</p></td>
<td ><span class="style6"><?php echo $myship["rbicode"]  ?></td>
</tr>
<tr class="bgcolor2" bordercolor="#CCCCCC" >
<td width=15%><span class="style6"><p align="left">Custom House Agent</p></td>
<td><span class="style6"><?php echo $myship["custom_agent"]  ?></td>
<td width=15%><span class="style6"><p align="left">LIC NO.</p></td>
<td><span class="style6"><?php echo $myship["licnum"]  ?></td>
</tr>
<tr class="bgcolor2" bordercolor="#CCCCCC" >
<td width=15%><span class="style6"><p align="left">Pre-Carriage By</p></td>
<td><span class="style6"><?php echo $myinvoice["precarriageby"]  ?></td>
<td width=15%><span class="style6"><p align="left">Place Of Receipt By Pre-Carrier</p></td>
<td><span class="style6"><?php echo $myinvoice["precarrierreceipt"]  ?></td>
</tr>
<tr class="bgcolor2" bordercolor="#CCCCCC" >
<td width=15%><span class="style6"><p align="left">Vessel/Flight No.</p></td>
<td><span class="style6"><?php echo $myinvoice["vessel"]  ?></td>
<td width=15%><span class="style6"><p align="left">Rotating No.</p></td>
<td><span class="style6"><?php echo $myship["rotatingnum"]  ?></td></tr>
<tr bgcolor="#FFFFFF">
<td width=15%><span class="style6"><p align="left">Port Of Loading</p></td>
<td colspan=3><span class="style6"><?php echo $myinvoice["portofloading"]  ?></td>
</tr>
<tr class="bgcolor2" bordercolor="#CCCCCC" >
<td width=15%><span class="style6"><p align="left">Port Of Discharge</p></td>
<td><span class="style6"><?php echo $myinvoice["portofloading"]  ?></td>
<td width=15%><span class="style6"><p align="left">Country Of Destination</p></td>
<td><span class="style6"><?php echo $myinvoice["countryoffinaldest"]  ?></td></tr>
</table>

<table border=1 bgcolor="#FFFFFF" width=100% cellpadding=1 cellspacing=1 rule=all bordercolor="#000000">
<tr class="bgcolor2" bordercolor="#CCCCCC" >
<td rowspan=2 width=15%><span class="style6"><p align="left">Export Trade Control</p></td>
<td width=18%><span class="style6"><p align="left">If Export Under<br> Deffered Credit</p></td>
<td><span class="style6"><p align="left">Joint <br>Ventures</p></td>
<td><span class="style6"><p align="left">Rupee Credit</p></td>
<td><span class="style6"><p align="left">Others</p></td>
<td width=18%><span class="style6"><p align="left">RBI's Approval<br>/CIR. No.</p></td>
<td width=18%><span class="style6"><p align="left">RBI's Approval Date</p></td>
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
<tr class="bgcolor2" bordercolor="#CCCCCC" >
<td><span class="style6"><?php echo $myship["deffcredit"] ?></td>
<td><input type="radio" name="chk11" id="chk11" <?php echo $checked21 ?> onclick="return readOnlyRadio()">
                         <input type="hidden" name="jointven" value="<?php echo $myship["jointventure"] ?>" id="jointven"></td>
<td><input type="radio" name="chk12" id="chk12"<?php echo $checked22 ?>  onclick="return readOnlyRadio()">
                         <input type="hidden" name="rucredit" value="<?php echo $myship["rupcredit"] ?>" id="rucredit"></td>
<td><input type="radio" name="chk13" id="chk13" <?php echo $checked23 ?> onclick="return readOnlyRadio()">
                         <input type="hidden" name="others_ex" value="<?php echo $myship["otherex"] ?>" id="others_ex"></td>
<td><span class="style6"><?php echo $myship["rbiappcode"] ?></td>
<td ><span class="style6"><?php echo $rbiappdate ?>
</td>
</tr>
<tr class="bgcolor2" bordercolor="#CCCCCC" >
<td rowspan=2 width=20%><span class="style6"><p align="left">Type Of Shipment</p></td>
<td><span class="style6"><p align="left">Outright Sale</p></td>
<td colspan=3><span class="style6"><p align="left">Consignment Export</p></td>
<td colspan=3><span class="style6"><p align="left">Others(Specify)</p></td>
</tr>

<tr class="bgcolor2" bordercolor="#CCCCCC" >
<td><input type="radio"  name="outrightsale" <?php echo $checked21 ?> onclick="return readOnlyRadio()">
                         </td>
<td colspan=3><input type="radio"  name="conexp" <?php echo $checked22 ?> onclick="return readOnlyRadio()">
                         </td>
<td colspan=3><input type="radio"  name="other_sh" <?php echo $checked23 ?> onclick="return readOnlyRadio()">
                         </td>
</tr>

<tr class="bgcolor2" bordercolor="#CCCCCC" >
<td rowspan=2 width=15%><span class="style6"><p align="left">Nature Of Contract</p></td>
<td><span class="style6"><p align="left">CF</p></td>
<td><span class="style6"><p align="left">CFR</p></td>
<td><span class="style6"><p align="left">FOB</p></td>
<td colspan=6><span class="style6"><p align="left">Others(Specify)</p></td>
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
   ?>
<tr class="bgcolor2" bordercolor="#CCCCCC" >
<td><input type="radio"  name="cf" <?php echo $checked1 ?> onclick="return readOnlyRadio()">
                         </td>
<td><input type="radio" name="cfr" <?php echo $checked2 ?> onclick="return readOnlyRadio()">
                         </td>
<td><input type="radio" name="fob" <?php echo $checked3 ?> onclick="return readOnlyRadio()">
                         </td>
<td colspan=6><span class="style6"><?php echo $myship["contractother"]  ?></td>
</tr>
</table>

<table border=1 bgcolor="#FFFFFF" width=100% cellpadding=1 cellspacing=1 rule=all bordercolor="#000000">
<tr class="bgcolor2" bordercolor="#CCCCCC" >
<td width=28%><span class="style6"><p align="left">Others(specify)</p></span></td>
<td colspan=3><span class="style6"><?php echo $myship["contractother"]  ?></td></tr>
<tr class="bgcolor2" bordercolor="#CCCCCC" >
<td width=28%><span class="style6"><p align="left">Exchange Rate U/S 14 of A</p></td>
<td><span class="style6"><?php echo $myship["exchangerate"]  ?></td>
<td width=17%><span class="style6"><p align="left">Currency Of Invoice</p></td>
<td><span class="style6"><?php echo $myship["currency_in"]  ?></td></tr>
</tr>
</table>

<table border=1 bgcolor="#FFFFFF" width=100% cellpadding=1 cellspacing=1 rule=all bordercolor="#000000">
<tr class="bgcolor2" bordercolor="#CCCCCC" >
                    <td colspan=4><span class="labeltext"><center><b>Shipping Line Items</b></center></td>
                </tr>

<tr class="bgcolor2" bordercolor="#CCCCCC" >
                    <td bgcolor="#EEEFEE" width=1%><span class="labeltext"><b>Sl #</b></td>
                    <td align="center" bgcolor="#EEEFEE" width=20%><span class="labeltext"><b>Marks &NOS. No. & KInd<br>Of Pkgs. Container Nos.</b></td>
		            <td align="center" bgcolor="#EEEFEE" width=20%><span class="labeltext"><b>Statistical Code & <br>Description Of Goods</b></td>
					 <td bgcolor="#EEEFEE" width=5%><span class="heading"><b>Qty</b></td>
		            <td align="center" bgcolor="#EEEFEE" width=20%><span class="labeltext"><b>Value Of FOB</b></td>
                </tr>
<?php
      $i=1;

   while ($myLI = mysql_fetch_row($result_li))
  {
	printf('<tr class="bgcolor2" bordercolor="#CCCCCC" >');
    $linenumber="linenum" . $i;
	$marknum = "marknum" . $i;
	$statnum = "statnum" . $i;
	$qty = "qty" . $i;
	$vfob = "vfob" . $i;
	$prevlinenum="prev_line_num" . $i;
    $lirecnum="lirecnum" . $i;

	echo "<td  align=\"center\"><span class=\"style6\">$myLI[1]</td>";
    echo "<td align=\"center\"><span class=\"style6\">$myLI[2]</td>";
    echo "<td align=\"center\"><span class=\"style6\">$myLI[3]</td>";
    echo "<td align=\"center\"><span class=\"style6\">$myLI[4]</td>";
	echo "<td align=\"center\"><span class=\"style6\">$myLI[5]</td>";
	echo "<input type=\"hidden\" name=\"$prevlinenum\" value=\"$myLI[1]\">";
	echo "<input type=\"hidden\" name=\"$lirecnum\" value=\"$myLI[0]\">";
	printf('</tr>');
	$i++;
    }

   echo "<input type=\"hidden\" name=\"index\" value=$i>";
   echo "<input type=\"hidden\" name=\"curindex\" value=$i>";
  ?>
<tr class="bgcolor2" bordercolor="#CCCCCC" >
  <td colspan=2></td>
<td><span class="style6"><p align="left">Total</p></td>
<td><span class="style6"><?php echo $myship["total_qty"]  ?></td>
<td><span class="style6"><?php echo $myship["vfobtotal"]  ?></td></tr>
</tr>
  </table>
<table border=1 bgcolor="#FFFFFF" width=100% cellpadding=1 cellspacing=1 rule=all bordercolor="#000000">
<tr class="bgcolor2" bordercolor="#CCCCCC" >
<td width=15%><span class="style6"><p align="left">Net Weight</p></td>
<td width=15%><span class="style6"><?php echo $myship["netweight"]  ?></td>

<td width=15%><span class="style6"><p align="left">Gross Weight</p></td>
<td width=15%><span class="style6"><?php echo $myship["grossweight"]  ?></td></tr>
</tr>
<tr class="bgcolor2" bordercolor="#CCCCCC" >
<td width=17%><span class="style6"><p align="left">Total FOB Value In Words</p></span></td>
<td colspan=3><span class="style6"><?php echo $myship["fobwords"]  ?></td></tr>

                </table>

<table border=1 bgcolor="#FFFFFF" width=100% cellpadding=1 cellspacing=1 rule=all bordercolor="#000000">
                <tr bgcolor="#DDDEDD">
                    <td colspan=4><span class="heading"><center><b>Analysis Of Export Value</b></center></td>
                </tr>


               <tr class="bgcolor2" bordercolor="#CCCCCC" >

                <td bgcolor="#EEEFEE" width=5%><span class="labeltext"><b>&nbsp;</td>
                <td bgcolor="#EEEFEE" width=5%><span class="labeltext"><b>&nbsp;</td>
		            <td bgcolor="#EEEFEE" width=5%><span class="labeltext"><b>Currency</b></td>
					 <td bgcolor="#EEEFEE" width=5%><span class="labeltext"><b>Amount-INR</b></td>
                </tr>
<tr class="bgcolor2" bordercolor="#CCCCCC" >
                <td bgcolor="#FFFFFF" width=5%><span class="labeltext"><b>FOB value</td>
                <td><span class="style6"><?php echo $myship["fob_value"]  ?></td>
                <td><span class="style6"><?php echo $myship["fob_currency"]  ?></td>
                <td><span class="style6"><?php echo $myship["fob_inr"]  ?></td>
                </tr>
<tr class="bgcolor2" bordercolor="#CCCCCC" >
                <td bgcolor="#FFFFFF" width=5%><span class="labeltext"><b>Freight</td>
                <td><span class="style6"><?php echo $myship["freight_value"]  ?></td>
                <td><span class="style6"><?php echo $myship["freight_currency"]  ?></td>
                <td><span class="style6"><?php echo $myship["freight_inr"]  ?></td>
                </tr>
<tr class="bgcolor2" bordercolor="#CCCCCC" >
                <td bgcolor="#FFFFFF" width=5%><span class="labeltext"><b>Insurance</td>
                <td><span class="style6"><?php echo $myship["insurance_value"]  ?></td>
                <td><span class="style6"><?php echo $myship["insurance_currency"]  ?></td>
                <td><span class="style6"><?php echo $myship["insurance_inr"]  ?></td>
                </tr>
<tr class="bgcolor2" bordercolor="#CCCCCC" >
                <td bgcolor="#FFFFFF" width=5%><span class="labeltext"><b>Commission</td>
                <td><span class="style6"><?php echo $myship["commission_value"]  ?></td>
                <td><span class="style6"><?php echo $myship["commission_currency"]  ?></td>
                <td><span class="style6"><?php echo $myship["commission_inr"]  ?></td>
                </tr>
<tr class="bgcolor2" bordercolor="#CCCCCC" >
                <td bgcolor="#FFFFFF" width=5%><span class="labeltext"><b>Discount</td>
                <td><span class="style6"><?php echo $myship["discount_value"]  ?></td>
                <td><span class="style6"><?php echo $myship["discount_currency"]  ?></td>
                <td><span class="style6"><?php echo $myship["discount_inr"]  ?></td>
                </tr>
<tr class="bgcolor2" bordercolor="#CCCCCC" >
                <td bgcolor="#FFFFFF" width=5%><span class="labeltext"><b>Other</td>
                <td><span class="style6"><?php echo $myship["other_value"]  ?></td>
                <td><span class="style6"><?php echo $myship["other_currency"]  ?></td>
                <td><span class="style6"><?php echo $myship["other_inr"]  ?></td>
                </tr>
<tr class="bgcolor2" bordercolor="#CCCCCC" >
                <td bgcolor="#FFFFFF" width=5%><span class="labeltext"><b>Deductions</td>
                <td><span class="style6"><?php echo $myship["deduction_value"]  ?></td>
                <td><span class="style6"><?php echo $myship["deduction_currency"]  ?></td>
                <td><span class="style6"><?php echo $myship["deduction_inr"]  ?></td>
                </tr>
</table>
<table border=1 bgcolor="#FFFFFF" width=100% cellpadding=1 cellspacing=1 rule=all bordercolor="#000000">
<tr class="bgcolor2" bordercolor="#CCCCCC" >
                    <td colspan=2><span class="style6"><b>Full Export Value OR Where Not ascertainable,the value which Exporter Expects To Receive On Sale Of Goods</b></td>
                </tr>
<tr class="bgcolor2" bordercolor="#CCCCCC" >
<td width=15%><span class="style6"><p align="left">Currency</p></td>
<td>..........................</td></tr>
<tr class="bgcolor2" bordercolor="#CCCCCC" >
<td width=15%><span class="style6"><p align="left">Amount</p></td>
<td>..........................</td></tr>
</table>
<table border=1 bgcolor="#FFFFFF" width=100% cellpadding=1 cellspacing=1 rule=all bordercolor="#000000">
<tr class="bgcolor2" bordercolor="#CCCCCC" >
<td><span class="style6"><b>Self Sealing has been permitted by Assisant Commissioner of Custom Vide
Letter No. C.No.VIII/40/09/2009-EOU-II Dt:18.11.2009. As per Public notice # 107/2003 Dt:26.08.2003 & Circular
No. 17/2006 Dt:01.06.2006 Sl.No.08</b></td>
                </tr>
                </table>
                
<table border=1 bgcolor="#FFFFFF" width=100% cellpadding=1 cellspacing=1 rule=all bordercolor="#000000">
<tr class="bgcolor2" bordercolor="#CCCCCC" >
<td colspan=4><span class="heading"><center><b>Declaration</b></center></td>
</tr>
<tr class="bgcolor2" bordercolor="#CCCCCC" >
<td colspan=4><span class="style6">I/We Declare that all particulars given herein are true and correct<br>
I/We also attach the declaration(s) under clause No.(s)</span><td></tr>
<tr bgcolor="#FFFFFF"><td colspan=4>&nbsp;<td></tr>
<tr bgcolor="#FFFFFF"><td colspan=4 align="right"><span class="style6">Signature Of Exporter/CHA & Date<td></tr>
</table>

</body>
</html>
