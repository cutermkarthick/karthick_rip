<?php
//
//==============================================
// Author: FSI                                 
// Date-written = Aug 9, 2008              
// Filename: verifycustpo.php           
// Copyright of Badari Mandyam, FluentSoft     
// Revision: v1.0 OMS                          
// Allows verification of Cust PO with Order Stage   
//==============================================

session_start();
header("Cache-control: private");
/*
if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];
*/
$_SESSION['pagename'] = 'verifycustpo';
//////session_register('pagename');

// First include the class definition
include('classes/custpoverifyClass.php');
include('classes/displayClass.php');
$newCustpoverify= new custpoverify;
$newdisplay = new display;
if (isset($_REQUEST['ponum']))
{
    $ponum = $_REQUEST['ponum'];
}
else {
    $ponum="";
}
?>

<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>

<html>
<head>
<title>Verify Cust PO</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">
<form action='verifycustpo.php' method='post' enctype='multipart/form-data'>
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
<?php
   $newdisplay->dispLinks('');

?>
<table width=100% border=0 cellpadding=0 cellspacing=0  >
<tr bgcolor="DEDFDE">
<td width="6"><img src="images/spacer.gif " width="6"></td>
<td bgcolor="#FFFFFF">
<table width=100% border=0 cellpadding=6 cellspacing=0  >
<tr><td>
<table width=100% border=0>
<tr>
<td><span class="pageheading"><b>Verification Cust PO</b></td>
</tr>
</table>
</td></tr>
<tr>
<td>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
<tr bgcolor="#EEEFEE"><td colspan=4><span class="heading"><center><b>Order Stage vs Cust PO</b></center></td></tr>
<tr bgcolor="#FFFFFF"  >
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >

<tr bgcolor="#FFFFFF">
    <td><span class="labeltext"><p align="left">PO #</p></font></td>
    <td><input type="text" name="ponum" size=20 value="<?php echo $ponum ?>"></td>
</tr>
</table>
<table>
<tr bgcolor="#DDDEDD">
<td><span class="heading"><center><b>Order Stage Line Items</b></center></td>
</tr>
<?php
  if ($ponum != '') 
  {
  $myrevc = $newCustpoverify->getrevlicount($ponum);
  $mypoc = $newCustpoverify->getpolicount($ponum);
  $lic = mysql_fetch_row($myrevc);
  $poc = mysql_fetch_row($mypoc);
  echo "<tr><td>Order Stage line items = $lic[0]</td>";
  echo "<td>Cust PO Line Items : $poc[0]</td></tr></table>";
  
?>
<table>
<tr bgcolor="#DDDEDD">
<td><span class="heading"><center><b>Order Stage Line Items</b></center></td>
</tr>
<tr bgcolor="#FFFFFF">
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
<td bgcolor="#EEEFEE" width=4%><span class="heading"><b><center>Item No.</center></b></td>
<td bgcolor="#EEEFEE" width=10%><span class="heading"><b><center>Part Num</center></b></td>
<td bgcolor="#EEEFEE" width=10%><span class="heading"><b><center>Part Name</center></b></td>
<td bgcolor="#EEEFEE" width=10%><span class="heading"><b><center>RM Type</center></b></td>
<td bgcolor="#EEEFEE" width=8%><span class="heading"><b><center>RM Spec</center></b></td>
<td bgcolor="#EEEFEE" width=8%><span class="heading"><b><center>UOM</center></b></td>
<td bgcolor="#EEEFEE" width=8%><span class="heading"><b><center>Dia</center></b></td>
<td bgcolor="#EEEFEE" width=8%><span class="heading"><b><center>Length</center></b></td>
<td bgcolor="#EEEFEE" width=8%><span class="heading"><b><center>Width</center></b></td>
<td bgcolor="#EEEFEE" width=8%><span class="heading"><b><center>Thick</center></b></td>
<td bgcolor="#EEEFEE" width=8%><span class="heading"><b><center>Grain Flow</center></b></td>
<td bgcolor="#EEEFEE" width=8%><span class="heading"><b><center>Max Ruling</center></b></td>
<td bgcolor="#EEEFEE" width=8%><span class="heading"><b><center>Alt Spec</center></b></td>
<td bgcolor="#EEEFEE" width=8%><span class="heading"><b><center>Drg Iss</center></b></td>
<td bgcolor="#EEEFEE" width=8%><span class="heading"><b><center>Part Iss</center></b></td>
<td bgcolor="#EEEFEE" width=8%><span class="heading"><b><center>COS Issue</center></b></td>
<td bgcolor="#EEEFEE" width=8%><span class="heading"><b><center>Model Issue</center></b></td>
<td bgcolor="#EEEFEE" width=8%><span class="heading"><b><center>Qty</center></b></td>

</tr>
<?php

  $myRevli = $newCustpoverify->getrevLI($ponum);
  while ($LI = mysql_fetch_row($myRevli))
  {
	printf('<tr bgcolor="#FFFFFF">');
	$line_num = $LI[0];
	$qty = $LI[2];
	$item_desc = $LI[1];
        $partnum = $LI[4];
        $rmtype = $LI[5];
        $rmspec = $LI[6];
        $drgiss = $LI[8];
        $hcdrgiss = $LI[9];
        $partiss = $LI[7];
        $hcpartiss = $LI[10];
        $cos_iss = $LI[13];
        $model_iss = $LI[22];
        $uom = $LI[14];
        $dia = $LI[15];
        $length = $LI[16];
        $width = $LI[17];
        $thickness = $LI[18];
        $grainflow = $LI[19];
        $maxruling = $LI[20];
        $altspec = $LI[21];

        echo "<td align=\"center\"><span class=\"tabletext\">$line_num</td>";
        echo "<td align=\"center\"><span class=\"tabletext\">$partnum</td>";
	echo "<td align=\"center\"><span class=\"tabletext\">$item_desc</td>";
        echo "<td align=\"center\"><span class=\"tabletext\">$rmtype</td>";
        echo "<td align=\"center\"><span class=\"tabletext\">$rmspec</td>";
        echo "<td align=\"center\"><span class=\"tabletext\">$uom</td>";
        echo "<td align=\"center\"><span class=\"tabletext\">$dia</td>";
        echo "<td align=\"center\"><span class=\"tabletext\">$length</td>";
        echo "<td align=\"center\"><span class=\"tabletext\">$width</td>";
        echo "<td align=\"center\"><span class=\"tabletext\">$thickness</td>";
        echo "<td align=\"center\"><span class=\"tabletext\">$grainflow</td>";
        echo "<td align=\"center\"><span class=\"tabletext\">$maxruling</td>";
        echo "<td align=\"center\"><span class=\"tabletext\">$altspec</td>";
        echo "<td align=\"center\"><span class=\"tabletext\">$drgiss</td>";
        echo "<td align=\"center\"><span class=\"tabletext\">$partiss</td>";
        echo "<td align=\"center\"><span class=\"tabletext\">$cos_iss</td>";
        echo "<td align=\"center\"><span class=\"tabletext\">$model_iss</td>";
        echo "<td align=\"center\"><span class=\"tabletext\">$qty</td>";
	printf('</tr>');
	?>
 <?php
    }

?>
</table>

<table>
<tr bgcolor="#DDDEDD">
<td><span class="heading"><center><b>Cust PO Line Items</b></center></td>
</tr>
<tr bgcolor="#FFFFFF">
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
<td bgcolor="#EEEFEE" width=4%><span class="heading"><b><center>Item No.</center></b></td>
<td bgcolor="#EEEFEE" width=10%><span class="heading"><b><center>Part Num</center></b></td>
<td bgcolor="#EEEFEE" width=10%><span class="heading"><b><center>Part Name</center></b></td>
<td bgcolor="#EEEFEE" width=10%><span class="heading"><b><center>RM Type</center></b></td>
<td bgcolor="#EEEFEE" width=8%><span class="heading"><b><center>RM Spec</center></b></td>
<td bgcolor="#EEEFEE" width=8%><span class="heading"><b><center>UOM</center></b></td>
<td bgcolor="#EEEFEE" width=8%><span class="heading"><b><center>Dia</center></b></td>
<td bgcolor="#EEEFEE" width=8%><span class="heading"><b><center>Length</center></b></td>
<td bgcolor="#EEEFEE" width=8%><span class="heading"><b><center>Width</center></b></td>
<td bgcolor="#EEEFEE" width=8%><span class="heading"><b><center>Thick</center></b></td>
<td bgcolor="#EEEFEE" width=8%><span class="heading"><b><center>Grain Flow</center></b></td>
<td bgcolor="#EEEFEE" width=8%><span class="heading"><b><center>Max Ruling</center></b></td>
<td bgcolor="#EEEFEE" width=8%><span class="heading"><b><center>Alt Spec</center></b></td>
<td bgcolor="#EEEFEE" width=8%><span class="heading"><b><center>Drg Iss</center></b></td>
<td bgcolor="#EEEFEE" width=8%><span class="heading"><b><center>Part Iss</center></b></td>
<td bgcolor="#EEEFEE" width=8%><span class="heading"><b><center>Cos Issue</center></b></td>
<td bgcolor="#EEEFEE" width=8%><span class="heading"><b><center>Model Issue</center></b></td>
<td bgcolor="#EEEFEE" width=8%><span class="heading"><b><center>Qty</center></b></td>
</tr>
<?php
      $myRevli = $newCustpoverify->getrevLI($ponum);
      $myPoli = $newCustpoverify->getpoLI($ponum);
      while (($QI = mysql_fetch_row($myPoli)) && ($LI = mysql_fetch_row($myRevli)))
      {
	printf('<tr bgcolor="#FFFFFF">');
	$line_num = $QI[0];
	$qty = $QI[2];
	$item_desc = $QI[1];
        $partnum = $QI[6];
        $rmtype = $QI[7];
        $rmspec = $QI[8];
        $partiss = $QI[9];
        $model_iss = $QI[16];
        $cosiss = $QI[25];
        $drgiss = $QI[10];
        $price = $QI[3];
	$amount = $QI[4];
	$rmprice = $QI[11];
	$rmamount = $QI[12];
	$mcprice = $QI[13];
	$mcamount = $QI[14];
        $uom = $QI[17];
        $dia = $QI[18];
        $length = $QI[19];
        $width = $QI[20];
        $thickness = $QI[21];
        $gf = $QI[22];
        $maxruling = $QI[23];
        $altspec = $QI[24];

	$rline_num = $LI[0];
	$rqty = $LI[2];
	$ritem_desc = $LI[1];
        $rpartnum = $LI[4];
        $rrmtype = $LI[5];
        $rrmspec = $LI[6];
        $rdrgiss = $LI[8];
        $rhcdrgiss = $LI[9];
        $rpartiss = $LI[7];
        $rhcpartiss = $LI[10];
        $rcos_iss = $LI[13];
        $rmodel_iss = $LI[22];
        $ruom = $LI[14];
        $rdia = $LI[15];
        $rlength = $LI[16];
        $rwidth = $LI[17];
        $rthickness = $LI[18];
        $rgf = $LI[19];
        $rmaxruling = $LI[20];
        $raltspec = $LI[21];
        echo "<td align=\"center\"><span class=\"tabletext\">$line_num</td>";
        if ($rpartnum != $partnum)
        {
           echo "<td bgcolor=\"FF0000\" align=\"center\"><span class=\"tabletext\">$partnum</td>";
        }
        else {
           echo "<td align=\"center\"><span class=\"tabletext\">$partnum</td>"; 
        }
        if ($ritem_desc != $item_desc)
        {
            echo "<td bgcolor=\"FF0000\" align=\"center\"><span class=\"tabletext\">$item_desc</td>";
        }
        else {
            echo "<td align=\"center\"><span class=\"tabletext\">$item_desc</td>";
        }
        if ($rrmtype != $rmtype)
        {
            echo "<td bgcolor=\"FF0000\" align=\"center\"><span class=\"tabletext\">$rmtype</td>";
        }
        else {
            echo "<td align=\"center\"><span class=\"tabletext\">$rmtype</td>";
        }
        if ($rrmspec != $rmspec)
        {
            echo "<td bgcolor=\"FF0000\" align=\"center\"><span class=\"tabletext\">$rmspec</td>";
        }
        else {
            echo "<td align=\"center\"><span class=\"tabletext\">$rmspec</td>";
        }
        if ($ruom != $uom)
        {
            echo "<td bgcolor=\"FF0000\" align=\"center\"><span class=\"tabletext\">$uom</td>";
        }
        else {
            echo "<td align=\"center\"><span class=\"tabletext\">$uom</td>";
        }
        if ($rdia != $dia)
        {
            echo "<td bgcolor=\"FF0000\" align=\"center\"><span class=\"tabletext\">$dia</td>";
        }
        else {
            echo "<td align=\"center\"><span class=\"tabletext\">$dia</td>";
        }
        if ($rlength != $length)
        {
            echo "<td bgcolor=\"FF0000\" align=\"center\"><span class=\"tabletext\">$length</td>";
        }
        else {
            echo "<td align=\"center\"><span class=\"tabletext\">$length</td>";
        }
        if ($rwidth != $width)
        {
            echo "<td bgcolor=\"FF0000\" align=\"center\"><span class=\"tabletext\">$width</td>";
        }
        else {
            echo "<td align=\"center\"><span class=\"tabletext\">$width</td>";
        }
        if ($rthickness != $thickness)
        {
            echo "<td bgcolor=\"FF0000\" align=\"center\"><span class=\"tabletext\">$thickness</td>";
        }
        else {
            echo "<td align=\"center\"><span class=\"tabletext\">$thickness</td>";
        }
        if ($rgf != $gf)
        {
            echo "<td bgcolor=\"FF0000\" align=\"center\"><span class=\"tabletext\">$gf</td>";
        }
        else {
            echo "<td align=\"center\"><span class=\"tabletext\">$gf</td>";
        }
        if ($rmaxruling != $maxruling)
        {
            echo "<td bgcolor=\"FF0000\" align=\"center\"><span class=\"tabletext\">$maxruling</td>";
        }
        else {
            echo "<td align=\"center\"><span class=\"tabletext\">$maxruling</td>";
        }
        if ($raltspec != $altspec)
        {
            echo "<td bgcolor=\"FF0000\" align=\"center\"><span class=\"tabletext\">$altspec</td>";
        }
        else {
            echo "<td align=\"center\"><span class=\"tabletext\">$altspec</td>";
        }
        if ($rdrgiss != $drgiss)
        {
            echo "<td bgcolor=\"FF0000\" align=\"center\"><span class=\"tabletext\">$drgiss</td>";
        }
        else {
            echo "<td align=\"center\"><span class=\"tabletext\">$drgiss</td>";
        }
        if ($rpartiss != $partiss)
        {
            echo "<td bgcolor=\"FF0000\" align=\"center\"><span class=\"tabletext\">$partiss</td>";
        }
        else {
            echo "<td align=\"center\"><span class=\"tabletext\">$partiss</td>";
        }
        if ($rcos_iss != $cosiss)
        {
            echo "<td bgcolor=\"FF0000\" align=\"center\"><span class=\"tabletext\">$cosiss</td>";
        }
        else {
            echo "<td align=\"center\"><span class=\"tabletext\">$cosiss</td>";
        }
        if ($rmodel_iss != $model_iss)
        {
            echo "<td bgcolor=\"FF0000\" align=\"center\"><span class=\"tabletext\">$model_iss</td>";
        }
        else {
            echo "<td align=\"center\"><span class=\"tabletext\">$model_iss</td>";
        }
        if ($rqty != $qty)
        {
            echo "<td bgcolor=\"FF0000\" align=\"center\"><span class=\"tabletext\">$qty</td>";
        }
        else {
            echo "<td align=\"center\"><span class=\"tabletext\">$qty</td>";
        }

 	printf('</tr>');
    }

?>
</table>
<?php
  }
?>

</td>
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
                     style="color=#0066CC;background-color:#DDDDDD;width=130;"
                     VALUE="Reset" onclick="javascript: putfocus()">
</FORM>
</body>
</html>
