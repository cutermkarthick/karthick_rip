<?php
//==============================================
// Author: FSI                                 =
// Date-written = dec 21, 2007                 =
// Filename: processplaylist.php               =
// Copyright (C) FluentSoft Inc.               =
// Revision: v1.0                              =
//==============================================
session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}

$userid = $_SESSION['user'];
 include_once('classes/review_liClass.php');

 //echo "INside addlis";
   $reviewrecnum = $_REQUEST['reviewrecnum'];
   $LI = new review_li;
   $salesorderrecnum = $_REQUEST['salesorderrecnum'];
   //echo "-----------".$salesorderrecnum;
   if($salesorderrecnum != 'undefined')
   {
     $LI->delete_old_LI($salesorderrecnum);
   }
   $i = 1;
   $result = $LI->getLI($reviewrecnum);
   echo '<table id="myTable" width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">';
   echo '<tr bgcolor="#FFFFFF">';
   echo "<td bgcolor=\"#EEEFEE\"><span class=\"heading\"><b><center>PO Line Item</center></b></td>";
   echo "<td bgcolor=\"#EEEFEE\"><span class=\"heading\"><b><center>PRN No.</center></b></td>";
   echo '<td bgcolor="#EEEFEE"><span class="heading"><b><center>Part Number</center></b></td>';
   echo '<td bgcolor="#EEEFEE"><span class="heading"><b><center>Part Name</center></b></td>';
   echo '<td bgcolor="#EEEFEE"><span class="heading"><b><center>RM Type</center></b></td>';
   echo '<td bgcolor="#EEEFEE"><span class="heading"><b><center>RM Spec</center></b></td>';
   echo '<td bgcolor="#EEEFEE"><span class="heading"><b><center>UOM</center></b></td>';
   echo '<td bgcolor="#EEEFEE"><span class="heading"><b><center>Dia</center></b></td>';
   echo '<td bgcolor="#EEEFEE"><span class="heading"><b><center>Length</center></b></td>';
   echo '<td bgcolor="#EEEFEE"><span class="heading"><b><center>Width</center></b></td>';
   echo '<td bgcolor="#EEEFEE"><span class="heading"><b><center>Thickness</center></b></td>';
   echo '<td bgcolor="#EEEFEE"><span class="heading"><b><center>Grain Flow</center></b></td>';
   echo '<td bgcolor="#EEEFEE"><span class="heading"><b><center>Max Ruling Section</center></b></td>';
   echo '<td bgcolor="#EEEFEE"><span class="heading"><b><center>Alt Spec</center></b></td>';
   echo '<td bgcolor="#EEEFEE"><span class="heading"><b><center>Drg Iss</center></b></td>';
  // echo '<td bgcolor="#EEEFEE"><span class="heading"><b><center>Hc Drg Iss</center></b></td>';
   echo '<td bgcolor="#EEEFEE"><span class="heading"><b><center>Part Iss/Attach</center></b></td>';
  // echo '<td bgcolor="#EEEFEE"><span class="heading"><b><center>Hc Part Iss/Attach</center></b></td>';
   //echo '<td bgcolor="#EEEFEE"><span class="heading"><b><center>PO Cos</center></b></td>';
  // echo '<td bgcolor="#EEEFEE"><span class="heading"><b><center>Hc Cos</center></b></td>';
   echo '<td bgcolor="#EEEFEE"><span class="heading"><b><center>COS Issue</center></b></td>';
   echo '<td bgcolor="#EEEFEE"><span class="heading"><b><center>Model Issue</center></b></td>';
   echo '<td bgcolor="#EEEFEE"><span class="heading"><b><center>Quantity</center></b></td>';
   echo '<td bgcolor="#EEEFEE"><span class="heading"><b><center>Unit Price</center></b></td>';
   echo '<td bgcolor="#EEEFEE"><span class="heading"><b><center>Amount</center></b></td>';
   echo '<td bgcolor="#EEEFEE"><span class="heading"><b><center>Unit RM Cost</center></b></td>';
   echo '<td bgcolor="#EEEFEE"><span class="heading"><b><center>RM Amount</center></b></td>';
   echo '<td bgcolor="#EEEFEE"><span class="heading"><b><center>Unit M/C Cost</center></b></td>';
   echo '<td bgcolor="#EEEFEE"><span class="heading"><b><center>M/C Amount</center></b></td>';
   echo '</tr>';
 
 while($myLI = mysql_fetch_array($result))
 {

    printf('<tr bgcolor="#FFFFFF">');
    $line_num="line_num" . $i;
	$item_desc="item_desc" . $i;
    $partnum="partnum" . $i;
    $rmtype="rmtype" . $i;
    $rmspec="rmspec" . $i;
	$uom="uom" . $i;
    $dia="dia" . $i;
    $length="length" . $i;
    $width="width" . $i;
    $thickness="thickness" . $i;
    $gf="gf" . $i;
    $maxruling="maxruling" . $i;
    $altspec="altspec" . $i;
    $crn_num="crn_num" . $i;
	$uom="uom" . $i;
    $dia="dia" . $i;
    $length="length" . $i;
    $width="width" . $i;
    $thickness="thickness" . $i;
    $gf="gf" . $i;
    $maxruling="maxruling" . $i;
    $altspec="altspec" . $i;

    $partiss="partiss" . $i;
   // $hcpartiss="hcpartiss" . $i;
    $po_cos="po_cos" . $i;
    $cos_iss="cos_iss" . $i;
   // $hc_cos="hc_cos" . $i;
    $model_iss="model_iss" . $i;
    $drgiss="drgiss" . $i;
   // $hcdrgiss="hcdrgiss" . $i;
	$qty="qty" . $i;
	$price="price" . $i;
	$amount="amount" . $i;
	$rmprice="rmprice" . $i;
	$rmamount="rmamount" . $i;
	$mcprice="mcprice" . $i;
	$mcamount="mcamount" . $i;
	echo "<td><span class=\"tabletext\"><input type=\"text\"  name=\"$line_num\"  style=\"background-color:#DDDDDD;\"
		  		readonly=\"readonly\" value=\"$myLI[0]\" size=\"4%\"></td>";
   	echo "<td><span class=\"tabletext\"><input type=\"text\"  name=\"$crn_num\"  style=\"background-color:#DDDDDD;\"
		  		readonly=\"readonly\" value=\"$myLI[23]\" size=\"4%\"></td>";
    echo "<td><input type=\"text\" name=\"$partnum\" size=\"10%\" style=\"background-color:#DDDDDD;\"
		  		readonly=\"readonly\" value=\"$myLI[4]\"></td>";
    echo "<td><input type=\"text\" name=\"$item_desc\" size=\"10%\" style=\"background-color:#DDDDDD;\"
		  		readonly=\"readonly\" value=\"$myLI[1]\"></td>";
    echo "<td><input type=\"text\" name=\"$rmtype\" size=\"10%\" style=\"background-color:#DDDDDD;\"
		  		readonly=\"readonly\" value=\"$myLI[5]\"></td>";
    echo "<td><input type=\"text\" name=\"$rmspec\" size=\"8%\" style=\"background-color:#DDDDDD;\"
		  		readonly=\"readonly\" value=\"$myLI[6]\"></td>";
	echo "<td><input type=\"text\" name=\"$uom\" size=\"8%\" style=\"background-color:#DDDDDD;\"
		  		readonly=\"readonly\" value=\"$myLI[14]\"></td>";
	echo "<td><input type=\"text\" name=\"$dia\" size=\"8%\" style=\"background-color:#DDDDDD;\"
		  		readonly=\"readonly\" value=\"$myLI[15]\"></td>";
	echo "<td><input type=\"text\" name=\"$length\" size=\"8%\" style=\"background-color:#DDDDDD;\"
		  		readonly=\"readonly\" value=\"$myLI[16]\"></td>";
	echo "<td><input type=\"text\" name=\"$width\" size=\"8%\" style=\"background-color:#DDDDDD;\"
		  		readonly=\"readonly\" value=\"$myLI[17]\"></td>";
	echo "<td><input type=\"text\" name=\"$thickness\" size=\"8%\" style=\"background-color:#DDDDDD;\"
		  		readonly=\"readonly\" value=\"$myLI[18]\"></td>";
	echo "<td><input type=\"text\" name=\"$gf\" size=\"8%\" style=\"background-color:#DDDDDD;\"
		  		readonly=\"readonly\" value=\"$myLI[19]\"></td>";
	echo "<td><input type=\"text\" name=\"$maxruling\" size=\"8%\" style=\"background-color:#DDDDDD;\"
		  		readonly=\"readonly\" value=\"$myLI[20]\"></td>";
	echo "<td><input type=\"text\" name=\"$altspec\" size=\"8%\" style=\"background-color:#DDDDDD;\"
		  		readonly=\"readonly\" value=\"$myLI[21]\"></td>";
    echo "<td><input type=\"text\" name=\"$drgiss\" size=\"6%\" style=\"background-color:#DDDDDD;\"
		  		readonly=\"readonly\" value=\"$myLI[8]\"></td>";
    //echo "<td><input type=\"text\" name=\"$hcdrgiss\" size=\"6%\" value=\"$myLI[9]\"></td>";
    echo "<td><input type=\"text\" name=\"$partiss\" size=\"6%\" style=\"background-color:#DDDDDD;\"
		  		readonly=\"readonly\" value=\"$myLI[7]\"></td>";
    // echo "<td><input type=\"text\" name=\"$hcpartiss\" size=\"6%\" value=\"$myLI[10]\"></td>";
    //echo "<td><input type=\"text\" name=\"$po_cos\" size=\"6%\" value=\"$myLI[11]\"></td>";
    // echo "<td><input type=\"text\" name=\"$hc_cos\" size=\"6%\" value=\"$myLI[12]\"></td>";
    echo "<td><input type=\"text\" name=\"$cos_iss\" size=\"6%\" style=\"background-color:#DDDDDD;\"
		  		readonly=\"readonly\" value=\"$myLI[13]\"></td>";
    echo "<td><input type=\"text\" name=\"$model_iss\" size=\"6%\" style=\"background-color:#DDDDDD;\"
		  		readonly=\"readonly\" value=\"$myLI[22]\"></td>";
    echo "<td><input type=\"text\" name=\"$qty\" size=\"6%\" style=\"background-color:#DDDDDD;\"
		  		readonly=\"readonly\" value=\"$myLI[2]\"></td>";
	echo "<td><input type=\"text\" name=\"$price\" size=\"6%\" value=\"0\"></td>";
	echo "<td><input type=\"text\" name=\"$amount\" style=\"background-color:#DDDDDD;\"
		  		readonly=\"readonly\" size=\"7%\" value=\"\"></td>";
	echo "<td><input type=\"text\" name=\"$rmprice\" size=\"6%\" value=\"0\"></td>";
	echo "<td><input type=\"text\" name=\"$rmamount\" style=\"background-color:#DDDDDD;\"
		  		readonly=\"readonly\" size=\"7%\" value=\"\"></td>";
	echo "<td><input type=\"text\" name=\"$mcprice\" size=\"6%\" value=\"0\"></td>";
	echo "<td><input type=\"text\" name=\"$mcamount\" style=\"background-color:#DDDDDD;\"
		  		readonly=\"readonly\" size=\"7%\" value=\"\"></td>";
	printf('</tr>');
	$i++;
    }
echo "<input type=\"hidden\" name=\"index\" value=$i>";
echo '</table>';

?>
