<?php
session_start();
header("Cache-control: private");
if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];

$_SESSION['pagename'] = 'shippingedit';
//////session_register('pagename');
include('classes/displayClass.php');
include('classes/shippingClass.php');
$newshiping = new shipping;
$newdisp = new display;
$invrecnum=$_REQUEST['link2invoice'];
$shiprecnum=$_REQUEST['shippingrecnum'];

$result_ship= $newshiping->getshippingdetails($shiprecnum);
$myship =mysql_fetch_assoc($result_ship);
$result= $newshiping->getinvoicedetails($myship['link2invoice']);
$myinvoice=mysql_fetch_assoc($result);
$resultli=$newshiping->getshippinglidetails($shiprecnum);
$resultli_s=$newshiping->getshippinglidetails($shiprecnum);
?>
<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/shipping.js"></script>
<html>
<head>
<title>Shipping Edit</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">
<form  action='shippingProcess.php' method='post' enctype='multipart/form-data'>
<?php
include('header.html');
?>
<table width=100% cellspacing="0" cellpadding="6" border="0">
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
<tr><td>
<table width=100% border=0>
<tr>
<td><span class="pageheading"><b>Shipping Edit</b></td>
</tr>
</table>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
<tr bgcolor="#FFFFFF">
<tr bgcolor="#EEEFEE"><td colspan=4><span class="heading"><center><b>General Information</b></center></td>
</tr>  </table>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
<tr bgcolor="#FFFFFF">
<td width=15%><span class="labeltext"><p align="left">Shipping #</p></td>
<td ><input type="text" name="shipping_id" id="shipping_id" style=";background-color:#DDDDDD;"
                    readonly="readonly" size=30 value="<?php echo $myship["shipping_id"]  ?>"></span></td>
<td width=15%><span class="labeltext"><p align="left">Shipping Date</p></td>
<td ><input type="text" id="shipping_date" name="shipping_date"
   				style="background-color:#DDDDDD;"
  				 readonly="readonly" size=25 value="<?php echo $myship["createdate"]  ?>"></span>

</td>
</tr>
<tr bgcolor="#FFFFFF">
<td width=15%><span class="labeltext"><p align="left">Invoice #</p></td>
<td ><input type="text" size=30  name="invnum" id="invnum"  style=";background-color:#DDDDDD;"
                    readonly="readonly" value="<?php echo $myinvoice["invnum"]  ?>"><img src="images/getinvoice.gif" alt="Get Customer"
                    onclick="getInvoice()"></td>
<td width=15%><span class="labeltext"><p align="left">Invoice Date</p></td>
<td ><input type="text" id="invdate" name="invdate"
   				style="background-color:#DDDDDD;"
  				 readonly="readonly" size=25 value="<?php echo $myinvoice["invdate"]  ?>">

</td>
</tr>
<tr bgcolor="#FFFFFF">
<td width=15%><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Exporter</p></font></td>
<td ><input type="text" name="company" id="company" style=";background-color:#DDDDDD;"
                    readonly="readonly" size=30 value="<?php echo $myinvoice["name"]  ?>"></td>
                    <input type="hidden" name="companyrecnum" id="companyrecnum">
                    <input type="hidden" name="ship2customer" id="ship2customer" value="<?php echo $shiprecnum  ?>"></td></td>
</td>
<td width=15%><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Ship To</p></font></td>
<td > <input type="text" name="shipcompany" id="shipcompany" size=30 style=";background-color:#DDDDDD;"
                    readonly="readonly" value="<?php echo $myinvoice["saddr1"]  ?>"></td>
                    <input type="hidden" name="invrecnum" id="invrecnum" value="<?php echo $myinvoice["recnum"]  ?>">
                    <input type="hidden" name="shippingrecnum" id="shippingrecnum" value="<?php echo $shiprecnum  ?>"></td>
</td>
</tr>

<tr bgcolor="#FFFFFF">
<td width=15%><span class="labeltext"><p align="left">SB #</p></td>
<td ><input type="text" size=30  name="sbnum" id="sbnum" 
          size=30 style=";background-color:#DDDDDD;"
                    readonly="readonly"
          value="<?php echo $myship["sbnum"]  ?>"></td>
<td width=15%><span class="labeltext"><p align="left">SB Date</p></td>
<td ><input type="text" id="sbdate" name="sbdate"
   				style="background-color:#DDDDDD;"
  				 readonly="readonly" size=25 value="<?php echo $myship["sbdate"]  ?>">
				<img src="images/bu-getdate.gif" alt="Get Date"  onclick="GetDate('sbdate')">
</td>
</tr>
<tr bgcolor="#FFFFFF">
<td width=15%><span class="labeltext"><p align="left">AR4A #</p></td>
<td ><input type="text" size=30  name="ar4anum" id="ar4anum" value="<?php echo $myship["ar4anum"]  ?>"></td>
<td width=15%><span class="labeltext"><p align="left">AR4A Date</p></td>
<td ><input type="text" id="ar4adate" name="ar4adate"
   				style="background-color:#DDDDDD;"
  				 readonly="readonly" size=25 value="<?php echo $myship["ar4adate"]  ?>">
				<img src="images/bu-getdate.gif" alt="Get Date"  onclick="GetDate('ar4adate')">
</td>
</tr>
<tr bgcolor="#FFFFFF">
<td width=15%><span class="labeltext"><p align="left">Q/Cert #</p></td>
<td ><input type="text" size=30  name="qcert" id="qcert" value="<?php echo $myship["qcertnum"]  ?>"></td>
<td width=15%><span class="labeltext"><p align="left">Q/Cert Date</p></td>
<td ><input type="text" id="qcertdate" name="qcertdate"
   				style="background-color:#DDDDDD;"
  				 readonly="readonly" size=25 value="<?php echo $myship["qcertdate"]  ?>">
				<img src="images/bu-getdate.gif" alt="Get Date"  onclick="GetDate('qcertdate')">
</td>
</tr>
<tr bgcolor="#FFFFFF">
<td width=15%><span class="labeltext"><p align="left">Import Export Code #</p></td>
<td ><input type="text" size=30  name="impcode" id="impcode" value="<?php echo $myship["impexpcode"]  ?>"></td>
<td width=15%><span class="labeltext"><p align="left">RBI Code #</p></td>
<td ><input type="text" size=30  name="rbicode" id="rbicode" value="<?php echo $myship["rbicode"]  ?>"></td>
</tr>

<tr bgcolor="#FFFFFF">
<td width=15%><span class="labeltext"><p align="left">Custom House Agent</p></td>
<td><input type="text" size=30  name="custome_house_agent" id="custome_house_agent"
     style="background-color:#DDDDDD;" readonly="readonly" value="<?php echo $myship["custom_agent"]  ?>">
     <select name="custome_house_agent_sel" id="custome_house_agent_sel" size="1" width="100" onclick="getcustomsagent()">
                   <option selected>JEENA&Co AAAFJ1721HCH054</option>
                   <option value>KUEHNE&NAGEL PVT Ltd. AAACK2676HCH012</option>
                   <option value>SCHENKER INDIA PVT Ltd. AAACB0697BCH003</option>
                   <option value>SRIVALLI SHIPPING&Tpt AAIF520718C4008</option>
                   <option value>CAPITAL SHIPPING PVT LTD AABCC1595N</option>
                   <option value>EXPO Freight Pvt. Ltd. AAACE2126JCH005</option>
                   <option value>DACHSER India Private Limited-AAACCA7791DCH009</option>
				   </select></td>
<td width=15%><span class="labeltext"><p align="left">LIC NO.</p></td>
<td><input type="text" size=30  name="lic_no" id="lic_no" value="<?php echo $myship["licnum"]  ?>"></td>
</tr>
<tr bgcolor="#FFFFFF">
<td width=15%><span class="labeltext"><p align="left">Pre-Carriage By</p></td>
<td><input type="text" size=30  name="pre_carriage" id="pre_carriage" style=";background-color:#DDDDDD;"
                    readonly="readonly" value="<?php echo $myinvoice["precarriageby"]  ?>"></td>
<td width=15%><span class="labeltext"><p align="left">Place Of Receipt<br>By Pre-Carrier</p></td>
<td><input type="text" size=30  name="place_receipt" id="place_receipt" style=";background-color:#DDDDDD;"
                    readonly="readonly" value="<?php echo $myinvoice["precarrierreceipt"]  ?>"></td>
</tr>
<tr bgcolor="#FFFFFF">
<td width=15%><span class="labeltext"><p align="left">Vessel/Flight No.</p></td>
<td><input type="text" size=30  name="vesselnum" id="vesselnum" style=";background-color:#DDDDDD;"
                    readonly="readonly" value="<?php echo $myinvoice["vessel"]  ?>"></td>
<td width=15%><span class="labeltext"><p align="left">Rotating No.</p></td>
<td><input type="text" size=30  name="rotatingnum" id="rotatingnum" value="<?php echo $myship["rotatingnum"]  ?>"></td></tr>
<tr bgcolor="#FFFFFF">
<td width=15%><span class="labeltext"><p align="left">Port Of Loading</p></td>
<td colspan=3><input type="text" size=30  name="port_loading" id="port_loading" style=";background-color:#DDDDDD;"
                    readonly="readonly" value="<?php echo $myinvoice["portofloading"]  ?>"></td>
</tr>
<tr bgcolor="#FFFFFF">
<td width=15%><span class="labeltext"><p align="left">Port Of Discharge</p></td>
<td><input type="text" size=30  name="port_discharge" id="port_discharge" style=";background-color:#DDDDDD;"
                    readonly="readonly" value="<?php echo $myinvoice["portofloading"]  ?>"></td>
<td width=15%><span class="labeltext"><p align="left">Country Of Destination</p></td>
<td><input type="text" size=30  name="country_desti" id="country_desti" style=";background-color:#DDDDDD;"
                    readonly="readonly" value="<?php echo $myinvoice["countryoffinaldest"]  ?>"></td></tr>
</table>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
<tr bgcolor="#FFFFFF">
<td rowspan=2 width=15%><span class="labeltext"><p align="left">Export Trade Control</p></td>
<td><span class="labeltext"><p align="left">If Export Under<br> Deffered Credit</p></td>
<td><span class="labeltext"><p align="left">joint Ventures</p></td>
<td><span class="labeltext"><p align="left">Rupee Credit</p></td>
<td><span class="labeltext"><p align="left">Others</p></td>
<td><span class="labeltext"><p align="left">RBI's Approval<br>/CIR. No.</p></td>
<td><span class="labeltext"><p align="left">RBI's Approval Date</p></td>
</tr>
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

?>
<tr bgcolor="#FFFFFF">
<td><input type="checkbox" name="chk14" id="chk14" <?php echo $checked15 ?> onclick="JavaScript:toggleValue('deffcredit',this);">
                         <input type="hidden" name="deffcredit" value="<?php echo $myship["deffcredit"] ?>" id="deffcredit"></td>
<td><input type="checkbox" name="chk11" id="chk11" <?php echo $checked12 ?> onclick="JavaScript:toggleValue('jointven',this);">
                         <input type="hidden" name="jointven" value="<?php echo $myship["jointventure"] ?>" id="jointven"></td>
<td><input type="checkbox" name="chk12" id="chk12"<?php echo $checked13 ?>  onclick="JavaScript:toggleValue('rucredit',this);">
                         <input type="hidden" name="rucredit" value="<?php echo $myship["rupcredit"] ?>" id="rucredit"></td>
<td><input type="checkbox" name="chk13" id="chk13" <?php echo $checked14 ?> onclick="JavaScript:toggleValue('others_ex',this);">
                         <input type="hidden" name="others_ex" value="<?php echo $myship["otherex"] ?>" id="others_ex"></td>
<td><input type="text" size=30  name="rbiapp" id="rbiapp" value="<?php echo $myship["rbiappcode"] ?>"></td>
<td ><input type="text" id="rbiappdate" name="rbiappdate"
   				style="background-color:#DDDDDD;"
  				 readonly="readonly" size=20 value="<?php echo $myship["rbiappdate"] ?>">
				<img src="images/bu-getdate.gif" alt="Get Date"  onclick="GetDate('rbiappdate')">
</td>
</tr>
<tr bgcolor="#FFFFFF">
<td rowspan=2 width=15%><span class="labeltext"><p align="left">Type Of Shipment</p></td>
<td><span class="labeltext"><p align="left">Outright Sale</p></td>
<td><span class="labeltext"><p align="left">Consignment Export</p></td>
<td colspan=6><span class="labeltext"><p align="left">Others(Specify)</p></td>
</tr>

<tr bgcolor="#FFFFFF">
<td><input type="checkbox" name="chk21" id="chk21"<?php echo $checked21 ?> onclick="JavaScript:toggleValue('outrightsale',this);">
                         <input type="hidden" name="outrightsale" value="<?php echo $myship["outrightsale"] ?>" id="outrightsale"></td>
<td><input type="checkbox" name="chk22" id="chk22" <?php echo $checked22 ?> onclick="JavaScript:toggleValue('conexp',this);">
                         <input type="hidden" name="conexp"  value="<?php echo $myship["consignmentexp"] ?>" id="conexp"></td>
<td colspan=6><input type="checkbox" name="chk23" <?php echo $checked23 ?> id="chk23" onclick="JavaScript:toggleValue('other_sh',this);">
                         <input type="hidden" name="other_sh" value="<?php echo $myship["othersh"] ?>"  id="other_sh"></td>
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
<td><input type="checkbox" name="chk1" id="chk1" <?php echo $checked1 ?> onclick="JavaScript:toggleValue('cf',this);">
                         <input type="hidden" name="cf" value="<?php echo $myship["cf"] ?>" id="cf"></td>
<td><input type="checkbox" name="chk2" id="chk2" <?php echo $checked2 ?> onclick="JavaScript:toggleValue('cfr',this);">
                         <input type="hidden" name="cfr"  value="<?php echo $myship["cfr"] ?>" id="cfr"></td>
<td><input type="checkbox" name="chk3" id="chk3" <?php echo $checked3 ?> onclick="JavaScript:toggleValue('fob',this);">
                         <input type="hidden" name="fob" value="<?php echo $myship["fob"] ?>"  id="fob"></td>
<td><input type="checkbox" name="chk4" <?php echo $checked4 ?> id="chk4" onclick="JavaScript:toggleValue('other_cont',this);">
                         <input type="hidden" name="other_cont" value="<?php echo $myship["contractother"] ?>"  id="other_sh"></td>
</tr>
 </table>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
<tr bgcolor="#FFFFFF">
<td width=17%><span class="labeltext"><p align="left">Exchange Rate U/S 14 of A</p></td>
<td><input type="text" size=30  name="exchange_rate" id="exchange_rate" value="<?php echo $myship["exchangerate"]  ?>"></td>

<td width=17%><span class="labeltext"><p align="left">Currency Of Invoice</p></td>
<td><input type="text" size=30  name="currency_in" id="currency_in" style=";background-color:#DDDDDD;"
                    readonly="readonly" value="<?php echo $myinvoice["currency"]  ?>"></td></tr>
</tr>
<tr bgcolor="#DDDEDD">
                    <td colspan=4><span class="heading"><center><b>Shipping Line Items</b></center></td>
                </tr>
                <table id="myTable" width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
                <tr bgcolor="#FFFFFF">
                <td>
                  <table id="myTable" width=50% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
                    <tr bgcolor="#FFFFFF">
                    <td bgcolor="#EEEFEE" width=1%><span class="heading"><b>Sl #</b></td>
                    <td bgcolor="#EEEFEE" width=20%><span class="heading"><b>Marks &NOS. No. & Kind<br>Of Pkgs. Container Nos.</b></td>
                    <td bgcolor="#EEEFEE" rowspan=12><img src="images/bu-getpl.gif" alt="Get Packing"  onclick="GetPacking()"></td>
                </tr>

<?php
      $i=1;$flag=0;
while($i<=16)
{
if($flag==0)
{
   while ($myLI = mysql_fetch_row($resultli))
  {
	printf('<tr bgcolor="#FFFFFF">');
    $linenumber="linenum" . $i;
	$marknum = "marknum" . $i;
	//$statnum = "statnum" . $i;
	//$qty = "qty" . $i;
	//$vfob = "vfob" . $i;
	$prevlinenum="prev_line_num" . $i;
    $lirecnum="lirecnum" . $i;
    $mark_pack=htmlentities($myLI[2]);
	echo "<td  ><span class=\"tabletext\"><input type=\"text\"  name=\"$linenumber\" id=\"$linenumber\" value=\"$myLI[1]\" size=\"2\"></td>";
    echo "<td ><input type=\"text\" name=\"$marknum\" id=\"$marknum\" size=\"40\" value=\"$mark_pack\"></td>";
	echo "<input type=\"hidden\" name=\"$prevlinenum\" value=\"$myLI[1]\">";
	echo "<input type=\"hidden\" name=\"$lirecnum\" value=\"$myLI[0]\">";
	printf('</tr>');
	$i++;
    }
    $flag=1;
  }
  printf('<tr bgcolor="#FFFFFF">');
    $linenum="linenum" . $i;
	$marknum = "marknum" . $i;
	//$statnum = "statnum" . $i;
	//$qty = "qty" . $i;
	//$vfob = "vfob" . $i;
	$prevlinenum="prev_line_num" . $i;
    $lirecnum="lirecnum" . $i;

	echo "<td  ><span class=\"tabletext\"><input type=\"text\"  name=\"$linenum\" id=\"$linenum\" value=\"\" size=\"2\"></td>";
    echo "<td ><input type=\"text\" name=\"$marknum\" id=\"$marknum\" size=\"40\" value=\"\"></td>";
	echo "<input type=\"hidden\" name=\"$prevlinenum\" value=\"$myLI[1]\">";
	echo "<input type=\"hidden\" name=\"$lirecnum\" value=\"$myLI[0]\">";
	printf('</tr>');
	$i++;
}

  ?>

 </table>
  </td>
  <td>

                  <table id="myTable" width=50% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
                    <tr bgcolor="#FFFFFF">
                    <td bgcolor="#EEEFEE" width=25%><span class="heading"><b>Statistical Code &<br> Description Of Goods</b></td>
					 <td bgcolor="#EEEFEE" width=5%><span class="heading"><b>Qty</b></td>
		            <td bgcolor="#EEEFEE" width=20%><span class="heading"><b>Value Of FOB</b></td>
		           <td bgcolor="#EEEFEE" rowspan=16><img src="images/getinvoice.gif" alt="Get Date"  onclick="GetInvoicedet4shipping()"></td>
                </tr>
<?php
$j=1;$flag_s=0;
while($j<=16)
{
if($flag_s==0)
{
   while ($myLI_s = mysql_fetch_row($resultli_s))
  {
	printf('<tr bgcolor="#FFFFFF">');
    //$linenumber="linenum" . $j;
	//$marknum = "marknum" . $j;
	$statnum = "statnum" . $j;
	$qty = "qty" . $j;
	$vfob = "vfob" . $j;
	$prevlinenum="prev_line_num" . $j;
    $lirecnum="lirecnum" . $j;

    echo "<td ><input type=\"text\" name=\"$statnum\" id=\"$statnum\" size=\"65\" value=\"$myLI_s[3]\"></td>";
    echo "<td ><input type=\"text\" name=\"$qty\" id=\"$qty\"  size=\"10\" value=\"$myLI_s[4]\"></td>";
	echo "<td ><input type=\"text\" name=\"$vfob\" id=\"$vfob\" size=\"20\" value=\"$myLI_s[5]\"></td>";
	echo "<input type=\"hidden\" name=\"$prevlinenum\" value=\"$myLI_s[1]\">";
	echo "<input type=\"hidden\" name=\"$lirecnum\" value=\"$myLI_s[0]\">";
	printf('</tr>');
	$j++;
    }
    $flag_s=1;
  }
  printf('<tr bgcolor="#FFFFFF">');
    //$linenumber="linenum" . $j;
	//$marknum = "marknum" . $j;
	$statnum = "statnum" . $j;
	$qty = "qty" . $j;
	$vfob = "vfob" . $j;
	$prevlinenum="prev_line_num" . $j;
    $lirecnum="lirecnum" . $j;

    echo "<td ><input type=\"text\" name=\"$statnum\" id=\"$statnum\" size=\"65\" value=\"$myLI_s[3]\"></td>";
    echo "<td ><input type=\"text\" name=\"$qty\"  id=\"$qty\"  size=\"10\" value=\"$myLI_s[4]\"></td>";
	echo "<td ><input type=\"text\" name=\"$vfob\" id=\"$vfob\" size=\"20\" value=\"$myLI_s[5]\"></td>";
	echo "<input type=\"hidden\" name=\"$prevlinenum\" value=\"$myLI_s[1]\">";
	echo "<input type=\"hidden\" name=\"$lirecnum\" value=\"$myLI_s[0]\">";
	printf('</tr>');
	$j++;
}
   echo "<input type=\"hidden\" name=\"index\" value=$i>";
   echo "<input type=\"hidden\" name=\"curindex\" value=$i>";
  ?>
      <tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">Total</p></td>
<td><input type="text" size=10  name="total_qty" id="total_qty" style=";background-color:#DDDDDD;"
                    readonly="readonly" value="<?php echo $myship["total_qty"]  ?>"></td>
<td><input type="text" size=20  name="vfobtotal" id="vfobtotal" style=";background-color:#DDDDDD;"
                    readonly="readonly" value="<?php echo $myship["vfobtotal"]  ?>"></td></tr>
</tr>
  </table>

  </td>
  </tr>

  </table>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
<tr bgcolor="#FFFFFF">
<td width=15%><span class="labeltext"><p align="left">Net Weight</p></td>
<td><input type="text" size=30  name="net_weight" id="net_weight" value="<?php echo $myship["netweight"]  ?>"></td>

<td width=15%><span class="labeltext"><p align="left">Gross Weight</p></td>
<td><input type="text" size=30  name="gross_weight" id="gross_weight" value="<?php echo $myship["grossweight"]  ?>"></td></tr>
</tr>
<tr bgcolor="#FFFFFF">
<td width=17%><span class="labeltext"><p align="left">Total FOB Value<br> In Words</p></span></td>
<td colspan=3><input type="text" size=100  name="fob_inwords" id="fob_inwords" value="<?php echo $myship["fobwords"]  ?>"></td></tr>
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
                <?php
                
                  //$tot_amt=($myship["fob_value"]*$myship["exchangerate"]) ;
                ?>
                <tr bgcolor="#FFFFFF">
                <td bgcolor="#FFFFFF" width=5%><span class="heading"><b>FOB value</td>
                <td><input type="text" size=10  name="fob_value" id="fob_value" value="<?php echo $myship["fob_value"]  ?>"></td>
                <td><input type="text" size=10  name="fob_cur" id="fob_cur" value="<?php echo $myship["fob_currency"]  ?>"></td>
                <td><input type="text" size=10  name="fob_inr" id="fob_inr" value="<?php echo $myship["fob_inr"]  ?>"></td>
                </tr>
                <tr bgcolor="#FFFFFF">
                <td bgcolor="#FFFFFF" width=5%><span class="heading"><b>Freight</td>
                <td><input type="text" size=10  name="freight_value" id="freight_value" value="<?php echo $myship["freight_value"]  ?>"></td>
                <td><input type="text" size=10  name="freight_cur" id="freight_cur" value="<?php echo $myship["freight_currency"]  ?>"></td>
                <td><input type="text" size=10  name="freight_inr" id="freight_inr" value="<?php echo $myship["freight_inr"]  ?>"></td>
                </tr>
                <tr bgcolor="#FFFFFF">
                <td bgcolor="#FFFFFF" width=5%><span class="heading"><b>Insurance</td>
                <td><input type="text" size=10  name="insurance_value" id="insurance_value" value="<?php echo $myship["insurance_value"]  ?>"></td>
                <td><input type="text" size=10  name="insurance_cur" id="insurance_cur" value="<?php echo $myship["insurance_currency"]  ?>"></td>
                <td><input type="text" size=10  name="insurance_inr" id="insurance_inr" value="<?php echo $myship["insurance_inr"]  ?>"></td>
                </tr>
                <tr bgcolor="#FFFFFF">
                <td bgcolor="#FFFFFF" width=5%><span class="heading"><b>Commission</td>
                <td><input type="text" size=10  name="commission_value" id="commission_value" value="<?php echo $myship["commission_value"]  ?>"></td>
                <td><input type="text" size=10  name="commission_cur" id="commission_cur" value="<?php echo $myship["commission_currency"]  ?>"></td>
                <td><input type="text" size=10  name="commission_inr" id="commission_inr" value="<?php echo $myship["commission_inr"]  ?>"></td>
                </tr>
                <tr bgcolor="#FFFFFF">
                <td bgcolor="#FFFFFF" width=5%><span class="heading"><b>Discount</td>
                <td><input type="text" size=10  name="discount_value" id="discount_value" value="<?php echo $myship["discount_value"]  ?>"></td>
                <td><input type="text" size=10  name="discount_cur" id="discount_cur" value="<?php echo $myship["discount_currency"]  ?>"></td>
                <td><input type="text" size=10  name="discount_inr" id="discount_inr" value="<?php echo $myship["discount_inr"]  ?>"></td>
                </tr>
                <tr bgcolor="#FFFFFF">
                <td bgcolor="#FFFFFF" width=5%><span class="heading"><b>Other</td>
                <td><input type="text" size=10  name="other_value" id="other_value" value="<?php echo $myship["other_value"]  ?>"></td>
                <td><input type="text" size=10  name="other_cur" id="other_cur" value="<?php echo $myship["other_currency"]  ?>"></td>
                <td><input type="text" size=10  name="other_inr" id="other_inr" value="<?php echo $myship["other_inr"]  ?>"></td>
                </tr>
                <tr bgcolor="#FFFFFF">
                <td bgcolor="#FFFFFF" width=5%><span class="heading"><b>Deductions</td>
                <td><input type="text" size=10  name="deduction_value" id="deduction_value" value="<?php echo $myship["deduction_value"]  ?>"></td>
                <td><input type="text" size=10  name="deduction_cur" id="deduction_cur" value="<?php echo $myship["deduction_currency"]  ?>"></td>
                <td><input type="text" size=10  name="deduction_inr" id="deduction_inr" value="<?php echo $myship["deduction_inr"]  ?>"></td>
                </tr>
</table>
<!--<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
<tr bgcolor="#DDDEDD">
                    <td colspan=2><span class="heading"><center><b>Full Export Value Or Where Not ascertainable,the value which Exporter Expects To Receive On Sale Of Goods</b></center></td>
                </tr>
                </table>
                <table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
                <tr bgcolor="#FFFFFF">
<td width=15%><span class="labeltext"><p align="left">Currency</p></td>
<td><input type="text" size=30  name="currency_final" id="currency_final" value=""></td>
<td width=15%><span class="labeltext"><p align="left">Amount</p></td>
<td><input type="text" size=30  name="amount_final" id="amount_final" value=""></td></tr>
</table> -->
</table>
  </td>
 <td width="6"><img src="images/spacer.gif " width="6"></td>
	<tr bgcolor="DEDFDE">
  		<td width="4"><img src="images/box-left-bottom.gif"></td>
		<td><img src="images/spacer.gif " height="6"></td>
		<td width="4"><img src="images/box-right-bottom.gif"></td>
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
