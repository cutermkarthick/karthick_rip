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
//$fobinwords=ucfirst($newshiping->convert_number($myship["fob_inr"])) ;
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
<html>
<head>
<title></title>
</head>
<table width=100% border=1 cellpadding=1 cellspacing=1 bgcolor="#DFDEDF" rules="all">
<tr bgcolor="#DDDEDD"><td colspan=4><span class="heading">
<center><b><A HREF="javascript:window.print()">Shipping Bill For Export Of Duty Free Goods</A></b></center></td></tr>
<tr class="bgcolor2" bordercolor="#CCCCCC">
<td colspan=1><span class="labeltext">Exporter<br>
<span class="tabletext">A/C Asst Commissioner of Customs Division Bangalore</font>
<br><span class="tabletext">M/s CIM TOOLS PRIVATE LIMITED,(100% EOU)
<br><span class="tabletext">Plot No. 467-469,Site No.1D,12 th Cross,
<br><span class="tabletext">4th Phase, Peenya Industrial Area,
<br><span class="tabletext">Bangalore-560 058</td>
<td colspan=1><span class="labeltext">Invoice No. & Date<br>
<span class="tabletext"><?php echo $myinvoice["invnum"] .' dt ' . $invdate  ?><br>
<span class="labeltext">AR4A # & Date<br>
<span class="tabletext"><?php echo $myship["ar4anum"] . " " .  $ar4adate   ?>
</td>
<td colspan=1><span class="tabletext"><b>SB No. & Date</b><br>
<span class="tabletext"><?php echo $myship["sbnum"] . "  dt " .  $sbdate  ?><br>
<span class="labeltext"><br>
<span class="tabletext">
</td></tr>
<tr class="bgcolor2" bordercolor="#CCCCCC">
<td colspan=1><span class="labeltext">Consignee</span><br>
<span class="tabletext">A/C Office of Asst.Commissioner,ACC-Bangalore</font>
<br><span class="tabletext"><?php echo $myinvoice["name"]  ?></span>
<br><span class="tabletext"><?php echo $myinvoice["saddr1"] ?>
<br><span class="tabletext"><?php echo $myinvoice["scity"] . " " . $myinvoice["sstate"]?>
<br><span class="tabletext"><?php echo $myinvoice["scountry"]; ?></td>
<td colspan=1><span class="labeltext">Q/Cert # & Date<br>
<span class="tabletext"><?php echo $myship["qcertnum"] . " " . $qcertdate  ?></td>
<td colspan=1><span class="labeltext">Import Export Code No.<br>
<span class="tabletext"><?php echo $myship["impexpcode"]  ?><br>
<span class="labeltext">RBI Code # <br><span class="tabletext"><?php echo $myship["rbicode"]  ?></td></tr>
</table>
<?php

$checked15="";

   if($myship["deffcredit"] == 'yes'){
   $checked15="checked";
   }
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
<table width=100% border=1 cellpadding=1 cellspacing=1 bgcolor="#DFDEDF" rules="all">
<tr class="bgcolor2" bordercolor="#CCCCCC">
<td ><span class="labeltext">Custom House Agent</p>
<span class="tabletext"><?php echo wordwrap($myship["custom_agent"],15,"<br>",true ) ?></td>
<td ><span class="labeltext">LIC NO.</p>
<span class="tabletext"><?php echo $myship["licnum"] ?></td>
<td rowspan=2><span class="labeltext">Export Trade Control</p></td>
<td rowspan=1><span class="tabletext"><b>If Export Under:<br>Deffered Credit</b>&nbsp;&nbsp;
<input type="checkbox" name="chk14" id="chk14" <?php echo $checked15 ?> onclick="return readOnlyRadio()"><span class="labeltext">
Joint Ventures&nbsp;<input type="checkbox" name="chk11" id="chk11" <?php echo $checked12 ?> onclick="return readOnlyRadio()">
                         <input type="hidden" name="jointven" value="<?php echo $myship["jointventure"] ?>" id="jointven">
                         <br><span class="labeltext">Rupee Credit&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="chk12" id="chk12"<?php echo $checked13 ?>  onclick="return readOnlyRadio()">
                         <input type="hidden" name="rucredit" value="<?php echo $myship["rupcredit"] ?>" id="rucredit">
                         <span class="labeltext">Others &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="chk13" id="chk13" <?php echo $checked14 ?> onclick="return readOnlyRadio()">
                         <input type="hidden" name="others_ex" value="<?php echo $myship["otherex"] ?>" id="others_ex">
                         <br><span class="labeltext">RBI's Approval/CIR. No.<br> & Date&nbsp;&nbsp;&nbsp;<span class="tabletext"><?php echo $myship["rbiappcode"] .','. $rbiappdate ?></td>

</tr>
<tr class="bgcolor2" bordercolor="#CCCCCC">
<td width=15%><span class="labeltext"><p align="left">Pre-Carriage By</p>
<span class="tabletext"><?php echo $myinvoice["precarriageby"]  ?></td>
<td width=15%><span class="labeltext"><p align="left">Place Of Receipt<br>By Pre-Carrier</p>
<span class="tabletext"><?php echo $myinvoice["precarrierreceipt"]  ?></td>

<td rowspan=1><span class="labeltext">Type Of Shipment<br>Outright Sale&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox"  name="outrightsale" <?php echo $checked21 ?>
onclick="return readOnlyRadio()"><br><span class="labeltext">Consignment Export&nbsp;<input type="checkbox" name="chk13" id="chk13" <?php echo $checked22 ?> onclick="return readOnlyRadio()">
<br><span class="labeltext">Others(Specify)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox"  name="other_sh" <?php echo $checked23 ?> onclick="return readOnlyRadio()">
</td>
</tr>
<tr class="bgcolor2" bordercolor="#CCCCCC">
<td width=15%><span class="tabletext"><b>Vessel/Flight No.</b> <br><?php echo $myinvoice["vessel"]  ?></td>
<td width=15%><span class="tabletext"><b>Rotating No.</b>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $myship["rotatingnum"]  ?><br><br>
<span class="tabletext"><b>Port Of Loading </b><br><?php echo $myinvoice["portofloading"]  ?></td>
<td width=15%><span class="labeltext">Nature Of Contract
<br><br><span class="labeltext">Others(Specify)</td>
<td><span class="labeltext">CF/ <input type="checkbox"  name="cf" <?php echo $checked1 ?> onclick="return readOnlyRadio()">
<span class="labeltext">CFR/<input type="checkbox" name="cfr" <?php echo $checked2 ?> onclick="return readOnlyRadio()">
<span class="labeltext">FOB<input type="checkbox" name="fob" <?php echo $checked3 ?> onclick="return readOnlyRadio()">
<br><span class="labeltext"><input type="checkbox" name="other_ex"<?php echo $checked4 ?> onclick="return readOnlyRadio()">
</td>
</tr>
<tr class="bgcolor2" bordercolor="#CCCCCC">
<td width=15%><span class="tabletext"><b>Port Of Discharge
<br><span class="tabletext"><?php echo wordwrap($myinvoice["portofdischarge"],20,"<br>",true)  ?></td>
<td width=20%><span class="tabletext"><b>Country Of Destination
<br><span class="tabletext"><?php echo wordwrap($myinvoice["countryoffinaldest"],20,"<br>",true)   ?></td>
<td width=30%><span class="tabletext"><b>Exchange RateU/S14ofA
<br><span class="tabletext"><?php echo $myship["exchangerate"]  ?></td>
<td width=15%><span class="tabletext"><b>Currency of Invoice
<span class="tabletext"><?php echo $myinvoice["currency"]  ?></td>
</tr>
</table>
<table width=100% border=1 cellpadding=1 cellspacing=1 bgcolor="#DFDEDF" rules="all">
                <tr class="bgcolor2" bordercolor="#CCCCCC">
                    <td bgcolor="#EEEFEE" width=1%><span class="labeltext"><b>Sl No.</b></td>
                    <td bgcolor="#EEEFEE" width=15%><span class="labeltext">Marks & NOS. No. & Kind Of Pkgs. Container Nos.</td>
		            <td bgcolor="#EEEFEE" width=25%><span class="labeltext">Statistical Code & Description Of Goods</td>
					 <td bgcolor="#EEEFEE" align="center" width=10%><span class="labeltext"><b>Qty</b></td>
		            <td bgcolor="#EEEFEE" width=20%><span class="labeltext">Value Of FOB</td>
                </tr>
<?php
      $i=1;
    $totqty=0;
    $totamt = 0;

   while ($myLI = mysql_fetch_row($result_li))
  {
	printf('<tr class="bgcolor2" bordercolor="#CCCCCC">');
    $linenumber="linenum" . $i;
	$marknum = "marknum" . $i;
	$statnum = "statnum" . $i;
	$qty = "qty" . $i;
	$vfob = "vfob" . $i;
	$prevlinenum="prev_line_num" . $i;
    $lirecnum="lirecnum" . $i;  //$myLI[4]
    $stat=wordwrap($myLI[3],40,"<br>",true);
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

     echo "<td width=1%><span class=\"tabletext\">$myLI[1]</td>";
     if ($myLI[2] == '')
     {
         $marks = "&nbsp";
     }
     else
     {
         $marks = $myLI[2];
     }
     echo "<td width=15%><span class=\"tabletext\">$myLI[2]</td>";
     
     echo "<td width=25%><span class=\"tabletext\">$stat</td>";
     echo "<td width=10% align=\"center\"><span class=\"tabletext\">$quantity</td>";
     echo "<td width=20% align=\"right\"><span class=\"tabletext\">$fobValue</td>";
     echo "<input type=\"hidden\" name=\"$prevlinenum\" value=\"$myLI[1]\">";
     echo "<input type=\"hidden\" name=\"$lirecnum\" value=\"$myLI[0]\">";
     printf('</tr>');
     $i++;
    }

   echo "<input type=\"hidden\" name=\"index\" value=$i>";
   echo "<input type=\"hidden\" name=\"curindex\" value=$i>";
   $totamt = $totamt - $myinvoice["advance_amount"];
  ?>
   <tr bgcolor="#FFFFFF">
   <td colspan=2></td>
   <td colspan=2><span class="labeltext"><p align="left">Adv Amount (to be subtracted)</p></td>
   <td align="right"><span class="tabletext"><b><?php printf("%d",$myinvoice["advance_amount"])  ?></b></td></tr>

  <tr class="bgcolor2" bordercolor="#CCCCCC">
  <td colspan=2></td>
<td width=15%><span class="labeltext"><p align="left">Total</p></td>
<td width=15% align="center"><span class="tabletext"><b><?php echo $totqty ?></td>
<td width=15% align="right"><span class="tabletext"><b><?php echo $totamt  ?></td></tr>
<tr class="bgcolor2" bordercolor="#CCCCCC">
<td width=15%><span class="labeltext"><p align="left">Net Weight</p></td>
<td width=25%><span class="tabletext"><?php echo $myship["netweight"]  ?></td>
<td width=15%><span class="labeltext"><p align="left">Gross Weight</p></td>
<td width=15% colspan=2><span class="tabletext"><?php echo $myship["grossweight"]  ?></td></tr>
</tr>
<table>
<?php
    $fobinwords=ucfirst($newshiping->convert_number(round($myship["exchangerate"]*$totamt))) ;
    $fobinr=$myship["exchangerate"]*$totamt;
?>
<table width=100% border=1 cellpadding=1 cellspacing=1 bgcolor="#DFDEDF" rules="all" >
<tr class="bgcolor2" bordercolor="#CCCCCC">
<td width=35%><span class="labeltext"><p align="left">Total FOB Value In Words(in Rupees)</p></span></td>
<td colspan=4><span class="tabletext"><?php echo $fobinwords  ?></td></tr>
</table>
                <table width=100% border=1 cellpadding=0 cellspacing=0 bgcolor="#DFDEDF" rules="all" >
                <tr class="bgcolor2" bordercolor="#CCCCCC">
                <td colspan=2 bgcolor="#EEEFEE" width=15%><span class="tabletext">Analysis Of Export Value</td>
                		            <td bgcolor="#EEEFEE" width=15%><span class="tabletext">Currency</td>
					 <td bgcolor="#EEEFEE" width=15%><span class="tabletext">Amount-INR</td>
             <td rowspan=8><span class="labeltext">Full Export Value OR Where Not ascertainable,the <br>
                value which Exporter Expects To Receive On Sale Of Goods</b><br>
                <br><br><br><br><br><br>Currency-&nbsp; <?php echo $myinvoice["currency"] ?>.......................
                <br>Amount&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $totamt ?>     </td>

                </tr>
                <tr class="bgcolor2" bordercolor="#CCCCCC">
                <td bgcolor="#FFFFFF" width=5%><span class="tabletext">FOB value</td>
                <td><span class="tabletext"><?php echo $totamt  ?></td>
                <td><span class="tabletext"><?php echo $myship["fob_currency"]  ?></td>
                <td><span class="tabletext"><?php printf("%.2f", $fobinr) ?></td>
                                </tr>
                <tr class="bgcolor2" bordercolor="#CCCCCC">
                <td bgcolor="#FFFFFF" width=5%><span class="tabletext">Freight</td>
                <td><span class="tabletext"><?php echo $myship["freight_value"]  ?></td>
                <td><span class="tabletext"><?php echo $myship["freight_currency"]  ?></td>
                <td><span class="tabletext"><?php echo $myship["freight_inr"]  ?></td>
                </tr>
                <tr class="bgcolor2" bordercolor="#CCCCCC">
                <td bgcolor="#FFFFFF" width=5%><span class="tabletext">Insurance</td>
                <td><span class="tabletext"><?php echo $myship["insurance_value"]  ?></td>
                <td><span class="tabletext"><?php echo $myship["insurance_currency"]  ?></td>
                <td><span class="tabletext"><?php echo $myship["insurance_inr"]  ?></td>
                </tr>
                <tr class="bgcolor2" bordercolor="#CCCCCC">
                <td bgcolor="#FFFFFF" width=5%><span class="tabletext">Commission</td>
                <td><span class="tabletext"><?php echo $myship["commission_value"]  ?></td>
                <td><span class="tabletext"><?php echo $myship["commission_currency"]  ?></td>
                <td><span class="tabletext"><?php echo $myship["commission_inr"]  ?></td>
                </tr>
                <tr class="bgcolor2" bordercolor="#CCCCCC">
                <td bgcolor="#FFFFFF" width=5%><span class="tabletext">Discount</td>
                <td><span class="tabletext"><?php echo $myship["discount_value"]  ?></td>
                <td><span class="tabletext"><?php echo $myship["discount_currency"]  ?></td>
                <td><span class="tabletext"><?php echo $myship["discount_inr"]  ?></td>
                </tr>
                <tr class="bgcolor2" bordercolor="#CCCCCC">
                <td bgcolor="#FFFFFF" width=5%><span class="tabletext">Other</td>
                <td><span class="tabletext"><?php echo $myship["other_value"]  ?></td>
                <td><span class="tabletext"><?php echo $myship["other_currency"]  ?></td>
                <td><span class="tabletext"><?php echo $myship["other_inr"]  ?></td>
                </tr>
                <tr class="bgcolor2" bordercolor="#CCCCCC">
                <td bgcolor="#FFFFFF" width=5%><span class="tabletext">Deductions</td>
                <td><span class="tabletext"><?php echo $myship["deduction_value"]  ?></td>
                <td><span class="tabletext"><?php echo $myship["deduction_currency"]  ?></td>
                <td><span class="tabletext"><?php echo $myship["deduction_inr"]  ?></td>
                </tr>

</table>
<table width=100% border=1 cellpadding=1 cellspacing=1 bgcolor="#DFDEDF" rules="all">
<tr class="bgcolor2" bordercolor="#CCCCCC">
<td><span class="tabletext">Self Sealing has been permitted by Assisant Commissioner of Custom Vide
Letter No. C.No.VIII/40/09/2009-EOU- <br>IIDt:18.11.2009.As per Public notice # 107/2003 Dt:26.08.2003 & Circular
No. 17/2006 Dt:01.06.2006 Sl.No.08</td>
                </tr>
                </table>

<table width=100% border=1 cellpadding=1 cellspacing=1 bgcolor="#DFDEDF" rules="all">
<tr class="bgcolor2" bordercolor="#CCCCCC">
<td colspan=4 align="left" rowspan=1><span class="tabletext"><span class="tabletext">
I/We Declare that all particulars given herein are true and correct<br>
I/We also attach the declaration(s) under clause No.(s)</span><br><br><br>
</td>
</tr>
<tr class="bgcolor2" bordercolor="#CCCCCC">
<td align="right">
<span class="tabletext">Signature Of Exporter/CHA & Date</td>
</tr>
</table>
</body>
</html>
