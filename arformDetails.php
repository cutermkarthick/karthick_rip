<?php
session_start();
header("Cache-control: private");
if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];
$recnum=$_REQUEST['arrecnum'];
$invrecnum=$_REQUEST['link2invoice'];
$_SESSION['pagename'] = 'arformdetails';
////////session_register('pagename');
include('classes/displayClass.php');
include('classes/arformClass.php');
//$newPO = new packing;
$newdisp = new display;
$newarform = new arform;

$result_ar= $newarform->getardetails($recnum);
$myarform =mysql_fetch_assoc($result_ar);
$result= $newarform->getinvoicedetails($myarform['link2invoice']);
$myinvoice=mysql_fetch_assoc($result);
$resultli=$newarform->getarformlidetails($recnum);
$resultli_s=$newarform->getarformlidetails($recnum);
$valueinwords=ucfirst($newarform->convert_number(round($myarform["totalrupees"]))) ;
$dutyinwords=ucfirst($newarform->convert_number(round($myarform["total_payableamt"]))) ;

?>
<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/arform.js"></script>
<html>
<head>
<title>AR Form Details</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">
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
<td><span class="pageheading"><b>AR Form Details</b></td>
</tr>
<tr>
    <td align="right" bgcolor="#FFFFFF">
          <a href ="arformedit.php?arrecnum=<?php echo $recnum ?>&link2invoice=<?php echo $invrecnum ?>" ><img name="Image8" border="0" src="images/bu-edit.gif" ></a>
     <img name="Image8"  name="Print" src="images/bu-print.gif" value="Print" onclick="javascript: printarform(<?php echo $recnum ?>,<?php echo $invrecnum ?>)">

  </tr>
</table>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
<tr bgcolor="#FFFFFF">
<tr bgcolor="#EEEFEE"><td colspan=4><span class="heading"><center><b>General Information</b></center></td>
</tr>  </table>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
 <tr bgcolor="#FFFFFF">
          <td  width= 15%><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Customer</p></font></td>
          <td><span class="tabletext"><?php echo $myinvoice["name"]  ?></td>
                    <input type="hidden" name="companyrecnum" id="companyrecnum" value="<?php echo $myinvoice["inv2customer"]  ?>">
                    <input type="hidden" name="arrecnum" id="arrecnum" value="<?php echo $recnum ?>">
		          <td  width= 15%><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Ship to</p></font></td>
          <td><span class="tabletext"><?php echo $myarform["name"]  ?></td>
                    <input type="hidden" name="ship2companyrecnum" id="ship2companyrecnum" value="<?php echo $myarform["link2ship"]  ?>">
                    </tr>
<tr bgcolor="#FFFFFF">
<td width=15%><span class="labeltext"><p align="left">Invoice #</p></td>
<td ><span class="tabletext"><?php echo $myinvoice["invnum"] ?>
                    <input type="hidden" name="invrecnum" id="invrecnum" value="<?php echo $myinvoice["recnum"] ?>"></td>
<td width=15%><span class="labeltext"><p align="left">Invoice Date</p></td>
<td ><span class="tabletext"><?php echo $myinvoice["invdate"] ?>
</td>
</tr>


<tr bgcolor="#FFFFFF">
<td width=15%><span class="labeltext"><p align="left">AR3A #</p></td>
<td ><span class="tabletext"><?php echo $myarform["ar3anum"] ?></td>
<td width=15%><span class="labeltext"><p align="left">AR3A Date</p></td>
<td ><span class="tabletext"><?php echo $myarform["ar3adate"] ?>
</td>
</tr>

<tr bgcolor="#FFFFFF">
<td width=15%><span class="labeltext"><p align="left">Pre-Carriage By</p></td>
<td colspan=3><span class="tabletext"><?php echo $myinvoice["precarriageby"]  ?></td>
</tr>
<tr bgcolor="#FFFFFF">
<td width=15%><span class="labeltext"><p align="left">No. and <br>Desc On Packages</p></td>
<td><span class="tabletext"><?php echo $myarform["numpkgs"]  ?></td>
<td width=15%><span class="labeltext"><p align="left">Gross Weight Of Packages</p></td>
<td><span class="tabletext"><?php echo $myarform["grosswt"]  ?></td></tr>

<tr bgcolor="#FFFFFF">
<td width=17%><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Exchange Rate U/S 14 of A</p></td>
<td><span class="tabletext"><?php echo $myarform["exchangerate"]  ?></td>

<td width=17%><span class="labeltext"><p align="left">Currency Of Invoice</p></td>
<td><span class="tabletext"><?php echo $myinvoice["currency"]  ?></td></tr>
</tr>
</tr>
<tr bgcolor="#DDDEDD">
                    <td colspan=4><span class="heading"><center><b>Shipping Line Items</b></center></td>
                </tr>
                <tr bgcolor="#FFFFFF">
                  <table id="myTable" width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
                    <tr bgcolor="#FFFFFF">
                    <td bgcolor="#EEEFEE" width=1%><span class="heading"><b>Sl #</b></td>
                    <td bgcolor="#EEEFEE" width=20%><span class="heading"><b>Marks &NOS. No. & Kind<br>Of Pkgs. Container Nos.</b></td>
                    <td bgcolor="#EEEFEE" width=25%><span class="heading"><b>Statistical Code &<br> Description Of Goods</b></td>
					 <td bgcolor="#EEEFEE" width=5%><span class="heading"><b>Qty</b></td>
					 <td bgcolor="#EEEFEE" width=5%><span class="heading"><b>Date of<br>first Warehousing</b></td>
		            <td bgcolor="#EEEFEE" width=20%><span class="heading"><b>Value</b></td>
		            <td bgcolor="#EEEFEE" width=30% colspan=2><span class="heading"><b>Duty</b></td>
		            <td bgcolor="#EEEFEE" width=30% ><span class="heading"><b>Remarks</b></td>

                </tr>
                <tr bgcolor="#FFFFFF">
                    <td bgcolor="#EEEFEE" width=1%><span class="heading"><b>&nbsp;</b></td>
                    <td bgcolor="#EEEFEE" width=20%><span class="heading"><b>&nbsp;</b></td>
                     <td bgcolor="#EEEFEE" width=25%><span class="heading"><b></b></td>
					 <td bgcolor="#EEEFEE" width=5%><span class="heading"><b></b></td>
					 <td bgcolor="#EEEFEE" width=5%><span class="heading"><b></b></td>
					 <?php
 if(preg_match("/\Tara Aerospace\b/i",$myarform["name"]))
                 {
                 ?>
                 <td bgcolor="#EEEFEE" width=20%><span class="heading"><b>Rupees</b></td>
		            <td bgcolor="#EEEFEE" width=15%><span class="heading"><b>Rate</b></td>
		            <td bgcolor="#EEEFEE" width=15%><span class="heading"><b>Amt Payable<br>Rupees</b></td>
                 <?php
                 }else
                 {
                 ?>
                  <td bgcolor="#EEEFEE" width=20%><span class="heading"><b>USD</b></td>
		            <td bgcolor="#EEEFEE" width=15%><span class="heading"><b>Rate</b></td>
		            <td bgcolor="#EEEFEE" width=15%><span class="heading"><b>Amt Payable<br>Rupees</b></td>
               <?php  }
?>

		            <td bgcolor="#EEEFEE" width=15%><span class="heading"><b></b></td>
                </tr>
<?php
      $i=1; $flag=0; $m=0; $rate_arr=array('5%','12.5%','0%','4%');  $flag_1=0;

       while($myLI = mysql_fetch_row($resultli))
       {
         printf('<tr bgcolor="#FFFFFF">');
         $linenum="linenum" . $i;
	     $marknum = "marknum" . $i;
   	     $prevlinenum="prev_line_num" . $i;
         $lirecnum="lirecnum" . $i;
         $statnum = "statnum" . $i;
	    $qty = "qty" . $i;
	    $datew = "datew" . $i;
	    $usd = "usd" . $i;
	    $amtusd = "amtusd" . $i;
	    $remarks = "remarks" . $i;

	   echo "<td  ><span class=\"tabletext\">$myLI[10]</td>";
       echo "<td ><span class=\"tabletext\">$myLI[3]</td>";
       echo "<td ><span class=\"tabletext\">$myLI[2]</td>";
       echo "<td ><span class=\"tabletext\">$myLI[4]</td>";
       echo "<td ><span class=\"tabletext\">$myLI[5]</td>";
       echo "<td align=\"right\"><span class=\"tabletext\">$myLI[6]</td>";
       echo "<td ><span class=\"tabletext\">$rate_arr[$m]</td>";
	   echo "<td align=\"right\"><span class=\"tabletext\">$myLI[8]</td>";
	   echo "<td ><span class=\"tabletext\">$myLI[9]</td>";
       echo "<input type=\"hidden\" name=\"$prevlinenum\" value=\"$myLI[1]\">";
       echo "<input type=\"hidden\" name=\"$lirecnum\" value=\"$myLI[0]\">";
	printf('</tr>');
       $i++; $m++;
    }


  ?>
</tr>
<tr bgcolor="#FFFFFF">
<td colspan=9>&nbsp;</td></tr>
   <tr bgcolor="#FFFFFF">

<td colspan=3 align="right"><span class="labeltext">Total</td>
<td><span class="tabletext"><?php echo $myarform["totqty"]  ?></td>
 <?php
 if(preg_match("/\Tara Aerospace\b/i",$myarform["name"]))
                 {
                 ?>
                 <td><span class="labeltext">Total Rupees</span></td>
                 <?php
                 }else
                 {
                 ?>
                  <td><span class="labeltext">Total USD</span></td>
               <?php  }
?>
<td align="right"><span class="tabletext"><?php echo number_format($myarform["totalusd"],2)  ?></td>
<?php
 if(preg_match("/\Tara Aerospace\b/i",$myarform["name"]))
                 {
                 ?>
                 <td colspan=1><span class="labeltext">Total Rupees</span></td>
                 <?php
                 }else
                 {
                 ?>
                  <td colspan=1><span class="labeltext">Total USD</span></td>
               <?php  }
?>
<td  align="right"><span class="tabletext"><?php echo number_format($myarform["total_payableamt"],2)  ?></td>
<td bgcolor="#FFFFFF" colspan=1></td></tr>

<?php 

if($myarform["name"] == 'MAHINDRA AEROSTRUCTURES PVT. LTD' || $myarform["name"] == 'Aerostructures Assemblies India Pvt.Ltd')
{
?>
<tr bgcolor="#FFFFFF">
<tr bgcolor="#FFFFFF">
<td colspan=5 align="right"><span class="labeltext">Subtotal + Vat</td>
<td  align="right"><span class="tabletext"><?php echo number_format($myarform["vatsubtotal"],2)  ?></td>
<td bgcolor="#FFFFFF" colspan=5></td></tr>
</tr>
<?php
}
?>

<tr bgcolor="#FFFFFF">
<td colspan=4>&nbsp;</td>
<td ><span class="labeltext">Total(Rupees)</td>
<td align="right"><span class="tabletext"><?php echo number_format($myarform["totalrupees"],2)  ?></td>
<td colspan=3>&nbsp;</td></tr>



  </table>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
<tr bgcolor="#FFFFFF">
<td width=17%><span class="labeltext"><p align="left">Value In Words</p></span></td>
<td colspan=3><span class="tabletext"><?php echo $valueinwords  ?></td>
<td width=17%><span class="labeltext"><p align="left">Duty In Words</p></span></td>
<td colspan=3><span class="tabletext"><?php echo $dutyinwords ?></td>
</tr>
</table>
</table>
  </td>
 <td width="6"><img src="images/spacer.gif " width="6"></td>
	<tr bgcolor="DEDFDE">
  		<td width="4"><img src="images/box-left-bottom.gif"></td>
		<td><img src="images/spacer.gif " height="6"></td>
		<td width="4"><img src="images/box-right-bottom.gif"></td>
	</tr>
 </table>


</FORM>
</body>
</html>
