<?php
//==============================================
// Author: FSI                                 =
// Date-written = July 20, 2006                =
// Filename: edit_so.php                       =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 WMS                          =
// Allows editing of SalesOrders               =
//==============================================
session_start();
header("Cache-control: private");

if ( !isset ($_SESSION['user']) )
{
  header ("Location: login.php");
}
$userid = $_SESSION['user'];
$emp = $_SESSION['employee'];
$_SESSION['pagename'] = 'editso';
//////session_register('pagename');

// First include the class definition
include_once('classes/loginClass.php');
include('classes/displayClass.php');
include('classes/soliClass.php');
include('classes/salesorderClass.php');
include('classes/reviewClass.php');

$newlogin = new userlogin;
$newlogin->dbconnect();

$newdisp = new display;
$newsalesorder = new salesorder;
$soli = new soli;
$newreview = new review;

$salesorderrecnum = $_REQUEST['salesorderrecnum'];
$myQI = $soli->getQI($salesorderrecnum);
$result = $newsalesorder->getSalesorder($salesorderrecnum);
$myrow = mysql_fetch_row($result);

$reviewrecnum = $myrow[48];
$result4review = $newreview->getreview($reviewrecnum);
$myrow4review = mysql_fetch_assoc($result4review);
?>

<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/salesorder.js"></script>
<script language="javascript" src="scripts/jquery.js"></script>

<html>
<head>
<title>Edit COntract Review</title>
<script language="javascript">

    function onPageLoad() {
        window.setInterval(sendPing, 120000);
    }
    function sendPing() {
       $.ajax({
      url : "getsession4so.php",
      type : "POST",
      dataType: "html",
      success : function (msg){
     //alert(msg);
              $('#sessiondets').html(msg);
              }
          })
    }
</script>
</head>

<body leftmargin="0" topmargin="0" marginwidth="0" rightmargin="0" onload="onPageLoad()">
<form action='processSalesorder.php' method='post'>
<table width=100% cellspacing="0" cellpadding="0" border="0">
<?php
include('header.html');
?>
<table width=100% cellspacing="0" cellpadding="6" border="0">
<tr>
<td>
<table width=100% border=0 cellspacing="0" cellpadding="0">
  <tr>
      <td><span class="welcome"><b>Welcome <?php echo $userid?></b></td>
            <td align="right">&nbsp;
            <a href="exit.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image16','','images/logout_mo.gif',1)"><img name="Image16" border="0" src="images/logout.gif"></a>
      </td>
  </tr>
</table>
      <table width=100% border=0 cellpadding=0 cellspacing=0>
       <tr><td>
         </td></tr>
        <tr>
         <td>
        <?php $newdisp->dispLinks(''); ?>
        </td></tr>
      </table>
<table width=100% border=0 cellpadding=0 cellspacing=0  >
<tr bgcolor="DEDFDE">
<td width="6"><img src="images/spacer.gif " width="6"></td>
<td bgcolor="#FFFFFF">
<table width=100% border=0 cellspacing="1" cellpadding="6">
<tr>
<td><span class="pageheading"><b>Edit Contract Review</b></td>
<td colspan=20>&nbsp;</td>
<table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3>
      <tr bgcolor="#DDDEDD">
            <td colspan=4><span class="heading"><center><b>General Information</b></center></td>
        </tr>
        <tr bgcolor="#FFFFFF"  >
			  <td><span class="labeltext"><p align="left"><span class='asterisk'>* </span>Cust PO No.</p></font></td>
            <td><input type="text" name="po_num"
			        style="background-color:#DDDDDD;"
                    readonly="readonly" size=20 value="<?php echo $myrow[16]?>">
              <input type="hidden" name="porecnum">
                <td><span class="labeltext"><p align="left"><span class='asterisk'>* </span>Customer</p></font></td>

            <td><input type="text" name="company"
                    style=";background-color:#DDDDDD;"
                    readonly="readonly" size=20 value="<?php echo $myrow[1]?>"">

             <img src="images/bu-getcustomer.gif" alt="Get Customer"
                 onclick="GetAllCustomers()">
            </td>
    <input type="hidden" name="companyrecnum" value="<?php echo $myrow[24]?>"></td>
    <input type="hidden" name="mysorecnum" value="<?php echo $salesorderrecnum?>"></td>
        </tr>
           <tr bgcolor="#FFFFFF">
            <td><span class="tabletext"><p align="left"><b>Order Date</b></p></font></td>
            <td><input type="text" name="order_date"
                    style="background-color:#DDDDDD;"
                    readonly="readonly" size=20 value="<?php echo $myrow[5]?>">
             <img src="images/bu-getdate.gif" alt="Get BookDate" onclick="GetDate('order_date')">
            </td>
            <td><span class="labeltext"><p align="left">Order/Quote Ref.</p></font></td>
            <td><input type="text" name="quote_num" size=20 value="<?php echo $myrow[39]?>"></td>
        </tr>

            <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><span class='asterisk'>* </span>Special Instruction</font></td>
            <td colspan=4><textarea name="special_instruction"
			        style="background-color:#DDDDDD;"
                    rows="4"  cols="45"><?php echo $myrow[7] ?></textarea></td>
            </tr>

            <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Description</p></font></td>
            <td><input type="text" name="description" size=36 value="<?php echo $myrow[3]?>"></td>
             <td><span class="labeltext"><p align="left">Currency</p></font></td>
             <td><span class="labeltext"><select name="currency" size="1" width="100">
             <option selected>$ </option>
             <option value>Rs </option>
             </select>
           </tr>
           <input type="hidden" name="sales_order" size=20 value="">


        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext">Amendment</font></td>
            <td><input type="text" name="amendmentnum" size=20 value="<?php echo $myrow[45]?>"></td>
            <td><span class="labeltext">Amendment Date</td>
            <td><input type="text" name="amendmentdate"
                    style="background-color:#DDDDDD;"
                    readonly="readonly" size=20 value="<?php echo $myrow[46]?>">
             <img src="images/bu-getdate.gif" alt="Get AmndDate" onclick="GetDate('amendmentdate')">
        </tr>
        
	    <tr bgcolor="#FFFFFF">
            <td><span class="tabletext"><p align="left"><b>Status</b></p></font></td>
            <td colspan=3><span class="tabletext"><input type="text" name="status" size=15  value="<?php echo $myrow[47] ?>"
            <span class="tabletext"><select name="active"  size="1" width="10" onchange="onSelectStatus()">
             <option selected>Please Specify
             <option value>Open
             <option value>Pending
             <option value>Closed
             <option value>Cancelled
            </select>
            <input type="hidden" name="activeval" value="<?php echo $myrow[47] ?>">
 
            </td>
        </tr>
        <input type="hidden" name="salespersonrecnum" value="0">
        <input type="hidden" name="due_date" value="">
        <input type="hidden" name="quote_date" value="">

        <tr bgcolor="#DDDEDD">
            <td colspan=4><span class="heading"><center><b><span class='asterisk'>*</span>Contact Information</b></center></td>
        </tr>
      <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Contact</p></font></td>
            <td colspan=3><input type="text" name="contact" size=20 value="<?php echo $myrow[37] ?>"></td>
 
            </td>
        </tr>

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Email</p></font></td>
            <td><input type="text" name="email" size=20 value="<?php echo $myrow[29]?>"</td>
            <td><span class="labeltext"><p align="left">Phone</p></font></td>
            <td><input type="text" name="phone" size=20 value="<?php echo $myrow[38]?>"</td>
        </tr>
        
            <input type="hidden" name="amendment" value="">
            <input type="hidden" name="deleteflag" value="">
<!--<tr bgcolor="#FFFFFF"><td colspan=10><a href="javascript:addRow('myTable',document.myForm.index.value)"><img name="Image7" border="0" src="images/bu-addrow.gif"></a></td></tr>-->
<?php
include('reviewEdit.php');
?>
<tr bgcolor="#DDDEDD">
<td colspan=4><span class="heading"><center><b>Sales Order Line Items</b></center></td>
</tr>
<table id="myTable" width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
<tr bgcolor="#FFFFFF">
<td bgcolor="#EEEFEE"><span class="heading"><b><center>PO Line Item</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>CRN No.</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Part Number</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Part Name</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>RM Type</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>RM Spec</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>RM Condition</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>UOM</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Dia</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Length</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Width</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Thickness</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Grain Flow</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Max Ruling Dim</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Alt Spec</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Drg Iss</center></b></td>
<!--<td bgcolor="#EEEFEE"><span class="heading"><b><center>Hc Drg Iss</center></b></td>-->
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Part Iss/Attach</center></b></td>
<!--<td bgcolor="#EEEFEE"><span class="heading"><b><center>Hc Part Iss/Attach</center></b></td>-->
<!--<td bgcolor="#EEEFEE"><span class="heading"><b><center>PO Cos</center></b></td>-->
<!--<td bgcolor="#EEEFEE"><span class="heading"><b><center>Hc Cos</center></b></td>-->
<!--<td bgcolor="#EEEFEE"><span class="heading"><b><center>COS Iss</center></b></td>-->
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Cos Iss/Attach</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Model Issue</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Quantity</center></b></td>
<!--
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Unit Price</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Amount</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Unit RM Cost</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>RM Amount</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Unit M/C Cost</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>M/C Amount</center></b></td>
-->

<td bgcolor="#00FF00"><span class="heading"><b><center>Save</center></b></td>
</tr>


<?php
   $i=1;$flag=0;
   while($i<=40)
	{
		if($flag==0)
		{

		 while ($QI = mysql_fetch_row($myQI))
   	 		{
			//echo "i am inside inner while loop";
			printf('<tr bgcolor="#FFFFFF">');
			$linenumber="line_num" . $i;
			$itemdesc="item_desc" . $i;
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

            $partiss="partiss" . $i;
            //$hcpartiss="hcpartiss" . $i;
            $po_cos="po_cos" . $i;
            $cos_iss="cos_iss" . $i;
            //$hc_cos="hc_cos" . $i;
            $model_iss="model_iss" . $i;
            $drgiss="drgiss" . $i;
            //$hcdrgiss="hcdrgiss" . $i;
			$qty="qty" . $i;
			$price="price" . $i;
			$amount="amount" . $i;
			$rmprice="rmprice" . $i;
			$rmamount="rmamount" . $i;
			$mcprice="mcprice" . $i;
			$mcamount="mcamount" . $i;
            $prevlinenum="prev_line_num" . $i;
			$lirecnum="lirecnum" . $i;
			$crn_num="crn_num" . $i;
			$condition="condition". $i;
			//echo "prevlinenum  : " . $prevlinenum . "    " . $QI[0];
			//echo "<br>$linenumber<br>$prevlinenum<br>$lirecnum<br>";
			echo "<td><span class=\"tabletext\"><input type=\"text\" id=\"$linenumber\"  name=\"$linenumber\"  value=\"$QI[0]\" size=\"4%\"></td>";
			echo "<td><span class=\"tabletext\"><input type=\"text\"  id=\"$crn_num\" name=\"$crn_num\"  style=\"background-color:#DDDDDD;\"
            	            readonly=\"readonly\" value=\"$QI[26]\" size=\"8%\" >
                      <img src=\"images/bu-get.gif\" onclick=\"GetCrn4Soli('$i')\"></td>";
            echo "<input type=\"hidden\" id=\"$prevlinenum\" name=\"$prevlinenum\" value=\"$QI[0]\">";
	        echo "<input type=\"hidden\" id=\"$lirecnum\" name=\"$lirecnum\" value=\"$QI[5]\">";
            echo "<td><input type=\"text\" id=\"$partnum\" name=\"$partnum\" size=\"10%\" value=\"$QI[6]\" style=\"background-color:#DDDDDD;\"
            	            readonly=\"readonly\"></td>";
	        echo "<td><input type=\"text\" id=\"$itemdesc\" name=\"$itemdesc\" size=\"10%\" value=\"$QI[1]\" style=\"background-color:#DDDDDD;\"
            	            readonly=\"readonly\"></td>";
            echo "<td><input type=\"text\" id=\"$rmtype\" name=\"$rmtype\" size=\"10%\" value=\"$QI[7]\" style=\"background-color:#DDDDDD;\"
            	            readonly=\"readonly\"></td>";
            echo "<td><input type=\"text\" id=\"$rmspec\" name=\"$rmspec\" size=\"10%\" value=\"$QI[8]\" style=\"background-color:#DDDDDD;\"
            	            readonly=\"readonly\"></td>";
            echo "<td><span class=\"tabletext\"><textarea id=\"$condition\" name=\"$condition\" rows=\"2\"
                 style=\"background-color:#DDDDDD;\"
            	            readonly=\"readonly\"
			              cols=\"20\" value=\"\">$QI[27]</textarea></td>";
            echo "<td ><input type=\"text\" id=\"$uom\" name=\"$uom\" size=\"10%\" value=\"$QI[17]\" style=\"background-color:#DDDDDD;\"
            	            readonly=\"readonly\"></td>";
            echo "<td ><input type=\"text\" id=\"$dia\" name=\"$dia\" size=\"10%\" value=\"$QI[18]\" style=\"background-color:#DDDDDD;\"
            	            readonly=\"readonly\"></td>";
            echo "<td ><input type=\"text\" id=\"$length\" name=\"$length\" size=\"10%\" value=\"$QI[19]\" style=\"background-color:#DDDDDD;\"
            	            readonly=\"readonly\"></td>";
            echo "<td ><input type=\"text\" id=\"$width\" name=\"$width\" size=\"10%\" value=\"$QI[20]\" style=\"background-color:#DDDDDD;\"
            	            readonly=\"readonly\"></td>";
            echo "<td ><input type=\"text\" id=\"$thickness\" name=\"$thickness\" size=\"10%\" value=\"$QI[21]\" style=\"background-color:#DDDDDD;\"
            	            readonly=\"readonly\"></td>";
            echo "<td ><input type=\"text\" id=\"$gf\" name=\"$gf\" size=\"10%\" value=\"$QI[22]\" style=\"background-color:#DDDDDD;\"
            	            readonly=\"readonly\"></td>";
            echo "<td ><input type=\"text\" id=\"$maxruling\" name=\"$maxruling\" size=\"10%\" value=\"$QI[23]\" style=\"background-color:#DDDDDD;\"
            	            readonly=\"readonly\"></td>";
            echo "<td ><input type=\"text\" id=\"$altspec\" name=\"$altspec\" size=\"10%\" value=\"$QI[24]\" style=\"background-color:#DDDDDD;\"
            	            readonly=\"readonly\"></td>";
	    $drgissvalue = htmlspecialchars($QI[10]);
	    echo "<td ><input type=\"text\" id=\"$drgiss\" name=\"$drgiss\" size=\"10%\" value=\"$drgissvalue\" ></td>";
	    $partissvalue = htmlspecialchars($QI[9]);
            echo "<td ><input type=\"text\" id=\"$partiss\" name=\"$partiss\" size=\"10%\" value=\"$partissvalue\" ></td>";
            //echo "<td ><input type=\"text\" name=\"$hcpartiss\" size=\"10%\" value=\"$QI[16]\"></td>";
            // echo "<td ><input type=\"text\" name=\"$po_cos\" size=\"10%\" value=\"$QI[15]\"></td>";
            // echo "<td ><input type=\"text\" name=\"$hc_cos\" size=\"10%\" value=\"$QI[18]\"></td>";
	    $cosissvalue = htmlspecialchars($QI[25]);
            echo "<td ><input type=\"text\" id=\"$cos_iss\" name=\"$cos_iss\" size=\"10%\" value=\"$cosissvalue\" ></td>";

            echo "<td ><input type=\"text\" id=\"$model_iss\" name=\"$model_iss\" size=\"10%\" value=\"$QI[16]\" ></td>";
           // echo "<td ><input type=\"text\" name=\"$hcdrgiss\" size=\"10%\" value=\"$QI[15]\"></td>";
	        echo "<td ><input type=\"text\" id=\"$qty\" name=\"$qty\" size=\"6%\" value=\"$QI[2]\"></td>";
            echo "<input type=\"hidden\" id=\"$price\" name=\"$price\" size=\"10%\" value=\"$QI[3]\">";



/*
            echo "<td><input type=\"text\" id=\"$amount\" name=\"$amount\" style=\"background-color:#DDDDDD;\"
            	            readonly=\"readonly\" size=\"10%\" value=\"$QI[4]===\">";
            echo "<td ><input type=\"text\" id=\"$rmprice\" name=\"$rmprice\" size=\"10%\" value=\"$QI[11]\" style=\"background-color:#DDDDDD;\"
            	            readonly=\"readonly\"></td>";
            echo "<td><input type=\"text\" id=\"$rmamount\" name=\"$rmamount\" style=\"background-color:#DDDDDD;\"
            	            readonly=\"readonly\" size=\"10%\" value=\"$QI[12]\" >";
            echo "<td ><input type=\"text\" id=\"$mcprice\" name=\"$mcprice\" size=\"10%\" value=\"$QI[13]\"></td>";
            echo "<td><input type=\"text\" id=\"$mcamount\" name=\"$mcamount\" style=\"background-color:#DDDDDD;\"
            	            readonly=\"readonly\" size=\"10%\" value=\"$QI[14]\">";
					*/
					            echo "<input type=\"hidden\" id=\"$amount\" name=\"$amount\" style=\"background-color:#DDDDDD;\"
            	            readonly=\"readonly\" size=\"10%\" value=\"$QI[4]\">";
            echo "<input type=\"hidden\" id=\"$rmprice\" name=\"$rmprice\" size=\"10%\" value=\"$QI[11]\" style=\"background-color:#DDDDDD;\"
            	            readonly=\"readonly\"></td>";
            echo "<input type=\"hidden\" id=\"$rmamount\" name=\"$rmamount\" style=\"background-color:#DDDDDD;\"
            	            readonly=\"readonly\" size=\"10%\" value=\"$QI[12]\" >";
            echo "<input type=\"hidden\" id=\"$mcprice\" name=\"$mcprice\" size=\"10%\" value=\"$QI[13]\"></td>";
            echo "<input type=\"hidden\" id=\"$mcamount\" name=\"$mcamount\" style=\"background-color:#DDDDDD;\"
            	            readonly=\"readonly\" size=\"10%\" value=\"$QI[14]\">";





            echo "<td align=\"center\" bgcolor=\"#FFFFFF\">
                     <input type=\"submit\" name=\"Save\" value=\"Save\" onclick=\"javascript: return check_req_fields1('edit_so','save')\">";
			printf('</tr>');
			$i++;
			}
           $flag=1;
       }
//echo "i am in outside while loop";
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
        $partiss="partiss" . $i;
       // $hcpartiss="hcpartiss" . $i;
        $po_cos="po_cos" . $i;
      //  $hc_cos="hc_cos" . $i;
        $cos_iss="cos_iss" . $i;
        $model_iss="model_iss" . $i;
        $drgiss="drgiss" . $i;
        $crn_num="crn_num" . $i;
		$qty="qty" . $i;
		$condition="condition" . $i;
		$duedate="due_date" . $i;
		$price="price" . $i;
		$amount="amount" . $i;
		$rmprice="rmprice" . $i;
		$rmamount="rmamount" . $i;
		$mcprice="mcprice" . $i;
		$mcamount="mcamount" . $i;
		$prevlinenum="prev_line_num" . $i;
		$lirecnum="lirecnum" . $i;
		//echo "<br>$line_num<br>$prevlinenum<br>$lirecnum<br>";
    echo "<td><span class=\"tabletext\"><input type=\"text\"  id=\"$line_num\" name=\"$line_num\" value=\"\" size=\"4%\"></td>";
   	echo "<td><span class=\"tabletext\"><input type=\"text\" id=\"$crn_num\" name=\"$crn_num\" style=\"background-color:#DDDDDD;\"
            	            readonly=\"readonly\" value=\"\" size=\"8%\" >
                                                 <img src=\"images/bu-get.gif\" onclick=\"GetCrn4Soli('$i')\"></td>";
    echo "<td><input type=\"text\" id=\"$partnum\" name=\"$partnum\" size=\"10%\" value=\"\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></td>";
    echo "<td><input type=\"text\" id=\"$item_desc\" name=\"$item_desc\" size=\"10%\" value=\"\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></td>";
    echo "<td><input type=\"text\" id=\"$rmtype\" name=\"$rmtype\" size=\"10%\" value=\"\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></td>";
    echo "<td><input type=\"text\" id=\"$rmspec\" name=\"$rmspec\" size=\"10%\" value=\"\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></td>";
    echo "<td><textarea id=\"$condition\" name=\"$condition\" rows=\"2\"
                               cols=\"20\" value=\"\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></textarea></td>";
	echo "<td><input type=\"text\" id=\"$uom\" name=\"$uom\" size=\"10%\" value=\"\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></td>";
	echo "<td><input type=\"text\" id=\"$dia\" name=\"$dia\" size=\"10%\"  value=\"\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></td>";
	echo "<td><input type=\"text\" id=\"$length\" name=\"$length\" size=\"10%\"  value=\"\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></td>";
	echo "<td><input type=\"text\" id=\"$width\" name=\"$width\" size=\"10%\" value=\"\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></td>";
	echo "<td><input type=\"text\" id=\"$thickness\" name=\"$thickness\" size=\"10%\" value=\"\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></td>";
	echo "<td><input type=\"text\" id=\"$gf\" name=\"$gf\" size=\"10%\"  value=\"\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></td>";
	echo "<td><input type=\"text\" id=\"$maxruling\" name=\"$maxruling\" size=\"10%\" value=\"\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></td>";
	echo "<td><input type=\"text\" id=\"$altspec\" name=\"$altspec\" size=\"10%\" value=\"\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></td>";
    echo "<td><input type=\"text\" id=\"$drgiss\" name=\"$drgiss\" size=\"10%\" value=\"\" ></td>";
    echo "<td><input type=\"text\" id=\"$partiss\" name=\"$partiss\" size=\"10%\" value=\"\" ></td>";
    echo "<td><input type=\"text\" id=\"$cos_iss\" name=\"$cos_iss\" size=\"10%\" value=\"\" ></td>";
    echo "<td><input type=\"text\" id=\"$model_iss\" name=\"$model_iss\" size=\"10%\" value=\"\"></td>";
    echo "<td><input type=\"text\" id=\"$qty\" name=\"$qty\" size=\"6%\" value=\"\"></td>";
	echo "<input type=\"hidden\" id=\"$price\" name=\"$price\" size=\"10%\" value=\"0\" >";

/*
	echo "<td><input type=\"text\" id=\"$amount\" name=\"$amount\" size=\"10%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"\"></td>";
	echo "<td><input type=\"text\" id=\"$rmprice\" name=\"$rmprice\" size=\"10%\" value=\"0\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></td>";
	echo "<td><input type=\"text\" id=\"$rmamount\" name=\"$rmamount\" style=\"background-color:#DDDDDD;\"
		  		readonly=\"readonly\" size=\"10%\" value=\"\"></td>";
	echo "<td><input type=\"text\" id=\"$mcprice\" name=\"$mcprice\" size=\"10%\" value=\"0\"></td>";
	echo "<td><input type=\"text\" id=\"$mcamount\" name=\"$mcamount\" style=\"background-color:#DDDDDD;\"
		  		readonly=\"readonly\" size=\"10%\" value=\"\"></td>";
				*/

					echo "<input type=\"hidden\" id=\"$amount\" name=\"$amount\" size=\"10%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"\">";
	echo "<input type=\"hidden\" id=\"$rmprice\" name=\"$rmprice\" size=\"10%\" value=\"0\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\">";
	echo "<input type=\"hidden\" id=\"$rmamount\" name=\"$rmamount\" style=\"background-color:#DDDDDD;\"
		  		readonly=\"readonly\" size=\"10%\" value=\"\">";
	echo "<input type=\"hidden\" id=\"$mcprice\" name=\"$mcprice\" size=\"10%\" value=\"0\">";
	echo "<input type=\"hidden\" id=\"$mcamount\" name=\"$mcamount\" style=\"background-color:#DDDDDD;\"
		  		readonly=\"readonly\" size=\"10%\" value=\"\">";



   echo "<td align=\"center\" bgcolor=\"#FFFFFF\">
                     <input type=\"submit\" name=\"Save\" value=\"Save\" onclick=\"javascript: return check_req_fields1('edit_so','save')\">";
	printf('</tr>');
	$i++;
		
	 }
     echo "<input type=\"hidden\" id=\"index\" name=\"index\" value=$i>";
 echo "<input type=\"hidden\" name=\"subtype\" value='Submit'>";
 ?>

</table>


<input type="hidden" name="tax" size=10 value="0">
<input type="hidden" name="labor" size=10 value="0">
<input type="hidden" name="shipping" size=10 value="0">

 <td width="6"><img src="images/spacer.gif " width="6"></td>
      </tr>
			<tr bgcolor="DEDFDE">
  				<td width="6"><img src="images/box-left-bottom.gif"></td>
				<td><img src="images/spacer.gif " height="6"></td>
				<td width="6"><img src="images/box-right-bottom.gif"></td>
		</tr>

    </table>
               <span class="labeltext"><input type="submit"
                     style="color=#0066CC;background-color:#DDDDDD;width=130;"
                     value="Submit" name="submit" onclick="javascript: return check_req_fields1('edit_so','submit')">
                <INPUT TYPE="RESET"
                     style="color=#0066CC;background-color:#DDDDDD;width=130;"
                     VALUE="Reset" onclick="javascript: putfocus()">
         </table>

</FORM>
</body>
</html>