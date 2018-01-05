<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = June 20, 2004                =
// Filename: new_po.php                        =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 WMS                          =
// Allows entry of POs                         =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];
$dept = $_SESSION['department'];
$_SESSION['pagename'] = 'newpo';
$page = "Purchasing: PO";
//////session_register('pagename');

// First include the class definition
include('classes/poClass.php');
include('classes/displayClass.php');
$newPO = new po;
$newdisp = new display;
?>

<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/po.js"></script>
<script language="javascript" src="scripts/jquery.js"></script>

<html>
<head>
<title>New PO</title>
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
<body leftmargin="0"topmargin="0" marginwidth="0" onload="onPageLoad()">
<form  action='processPo.php' method='post' enctype='multipart/form-data'>
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
<td width="6"><img src="images/spacer.gif" width="6"></td> -->
<!-- <td bgcolor="#FFFFFF">
<table width=100% border=0 cellpadding=6 cellspacing=0>
<tr><td> -->

<table style="width:100%;" border=0 cellpadding=3 cellspacing=4 >
<tr><td><span class="heading"><b>New Supplier Purchase Order</b></td>
<table style="width:118%" border=0 cellpadding=0 cellspacing=0 bgcolor="#DFDEDF" class="stdtable1">
<tr bgcolor="#EEEFEE"><td colspan=4><span class="heading"><center><b>General Information</b></center></td></tr>

</table>
<table  border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1" style="width:100%">

<tr bgcolor="#FFFFFF">
<td colspan=3><span class="labeltext"><p align="left"><span class='asterisk'>*</span>SupplierName</p></font></td>
<td colspan=2><input type="text" name="vendor" id="vendor" style=";background-color:#DDDDDD;"
			 	readonly="readonly" size=25 value="">
				<img src="images/bu-getvendor.gif" alt="Get Vendor" onclick="GetAllVendors()">
</td>
<td  colspan=1><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Ship To</p></font></td>
<td colspan=3><input type="text" name="host"
			 style=";background-color:#DDDDDD;"
			readonly="readonly" size=25 value="">
			<img src="images/bu-gethost.gif" alt="Get Host" onclick="GetHost()">
</td>
</tr>
<tr bgcolor="#FFFFFF">
<td colspan=3><span class="labeltext"><p align="left"><span class='asterisk'>*</span>PO Date</p></font></td>
<td colspan=2><input type="text" id="podate" name="podate"
   				style="background-color:#DDDDDD;"
  				 readonly="readonly" size=25 value="">
				<img src="images/bu-getdate.gif" alt="Get Date"  onclick="GetDueDate('podate')">
</td>
<td ><span class="labeltext"><p align="left"><span class='asterisk'>*</span>PO #</p></font></td>
<td  colspan=3><input type="text" size=15  name="ponum"></td>
</tr>
<tr bgcolor="#FFFFFF">
<td colspan=3><span class="labeltext"><p align="left"><span class='asterisk'>*</span>PO Desc</p></font></td>
<td  colspan=2><input type="text" size=25 name="desc">
<td><span class="labeltext"><p align="left">Currency</p></font></td>
<td COLSPAN=3><span class="labeltext"><select name="currency" size="1" width="100">
                   <option selected>$</option>
                   <option value>Rs</option>
                   <option value>GBP</option>
                   <option value>Euro</option>
      </select>
</td>
<input type="hidden" size=15  name="wonum">
<input type="hidden" name="vendrecnum" id="vendrecnum" value="">
<input type="hidden" name="hostrecnum">
<input type="hidden" name="status" value="Pending">
<input type="hidden" name="deptname" id="deptname" value="">
<input type="hidden" name="noedit" id="noedit" value="">
</tr>
<tr bgcolor="#FFFFFF">
<td colspan=3><span class="labeltext"><p align="left">AmendmentNo.</p></font></td>
 <td colspan=2><span class="tabletext"><input type="text"  name="amendment_num" id="amendment_num" size=25 value=""></td>
<td><span class="labeltext"><p align="left">Amendment Date</p></font></td>
<td COLSPAN=3><input type="text" name="amendmentdate" id="amendmentdate" style="background-color:#DDDDDD;" readonly="readonly"  size=10 value="">
	<img src="images/bu-getdate.gif" alt="Get Date"  onclick="GetDueDate('amendmentdate')"></td>
 </tr>
<tr bgcolor="#FFFFFF">
<td COLSPAN=3><span class="labeltext"><p align="left">Amendment Notes</p></font></td>
<td colspan=8><span class="tabletext"><textarea  name="amendment_notes" id="amendment_notes" rows="3"
			              cols="150" value=""></textarea></td>
</tr>
<tr bgcolor="#FFFFFF">
<td colspan=3><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Header</p></font></td>
<td  colspan=8><textarea  name="terms" rows="2"  cols="150" value=""></textarea></td>
</tr>

<tr bgcolor="#FFFFFF">
<td colspan=3><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Remarks</p></font></td>
<td colspan=8><span class="tabletext"><textarea  name="remarks" rows="4"  cols="150" value=""></textarea></td>
</tr>
<!--
<tr bgcolor="#FFFFFF">
<td colspan=1><span class="labeltext"><p align="left">Communication</p></font></td>
<td colspan=8><span class="tabletext"><input type="hidden" name="communication" value="10">10
&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp;<span class="tabletext"><input type="radio" name="communication" value="20">20
&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp;<span class="tabletext"><input type="radio" name="communication" value="30">30
&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp;<span class="tabletext"><input type="radio" name="communication" value="40">40
&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp;<span class="tabletext"><input type="radio" name="communication" value="50">50
&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp;<span class="tabletext"><input type="radio" name="communication" value="60">60
&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp;<span class="tabletext"><input type="radio" name="communication" value="70">70
&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp;<span class="tabletext"><input type="radio" name="communication" value="80">80
&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp;<span class="tabletext"><input type="radio" name="communication" value="90">90
&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp;<span class="tabletext"><input type="radio" name="communication" value="100">100</td>
-->
<input type="hidden" id="comm" name="comm" value="">
<input type="hidden" id="communication" name="communication" value="">
</tr>
<tr bgcolor="#FFFFFF">
<td colspan=3><span class="labeltext"><p align="left">Type</p></font></td>
 <td colspan=8><span class="tabletext">
 <input type="text" name="potype" id="potype" style="background-color:#DDDDDD;" readonly="readonly"  size=15 value="Regular">
 <select name="potype_sel" id="potype_sel" size="1" width="100" onchange="onSelecttype()">
 <option selected value="Regulart">Regular
                            <option value="Consummables">Consummables
        					<option value="Bought Out">Bought Out
        	 </select></td>
 </tr>
</tr>
</table>
<div style="width:118%;overflow-x:scroll">
<table style="width:118%" border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1">
<tr>
<td bgcolor="#EEEFEE" align="center"><span class="heading"><b>Line</b></td>
<!--
<td bgcolor="#EEEFEE" align="center"><span class="heading"><b>Layout Ref#</b></td>
<td bgcolor="#EEEFEE" align="center"><span class="heading"><b>On Time</b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b>< 7<br/> days late</b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b>>7 days<br/>late</b></td>
-->
<td bgcolor="#EEEFEE" align="center"><span class="heading"><b>Qty<br>Rej</b></td>
<td bgcolor="#EEEFEE" align="center"><span class="heading"><b>Spec type</b></td>
<td bgcolor="#EEEFEE" align="center"><span class="heading"><b>PRN</b></td>
<td bgcolor="#EEEFEE" align="center"><span class="heading"><b>Order<br>qty</b></td>
<td bgcolor="#EEEFEE" align="center"><span class="heading"><b>Mtl Type</b></td>
<td bgcolor="#EEEFEE" align="center"><span class="heading"><b>Mtl Spec</b></td>
<td bgcolor="#EEEFEE" align="center"><span class="heading"><b>RM Con</b></td>
<td bgcolor="#EEEFEE" align="center"><span class="heading"><b>UOM</b></td>
<td bgcolor="#EEEFEE" align="center"><span class="heading"><b>Dia</b></td>
<td bgcolor="#EEEFEE" align="center"><span class="heading"><b>Length</b></td>
<td bgcolor="#EEEFEE" align="center"><span class="heading"><b>Width</b></td>
<td bgcolor="#EEEFEE" align="center"><span class="heading"><b>Thickness</b></td>
<td bgcolor="#EEEFEE" align="center"><span class="heading"><b>Grf</b></td>
<td bgcolor="#EEEFEE" align="center"><span class="heading"><b>Max Rul</b></td>
<td bgcolor="#EEEFEE"  align="center"><span class="heading"><b>No of Mtr<br>req</b></td>

<td bgcolor="#EEEFEE"  align="center"><span class="heading"><b>No of Unit<br>req</b></td>

<td bgcolor="#EEEFEE" align="center"><span class="heading"><b>No of Lgth<br>req</b></td>
<td bgcolor="#EEEFEE" align="center"><span class="heading"><b>Due</b></td>
<td bgcolor="#EEEFEE" align="center"><span class="heading"><b>Due1</b></td>
<td bgcolor="#EEEFEE" align="center"><span class="heading"><b>Due2</b></td>
<td bgcolor="#EEEFEE" align="center"><span class="heading"><b>Delv By</b></td>
<td bgcolor="#EEEFEE"  align="center"><span class="heading"><b>Rate</b></td>
<td bgcolor="#EEEFEE" align="center"><span class="heading"><b>Amount</b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b>Status</b></td>
<td bgcolor="#EEEFEE" align="center"><span class="heading"><b>Remarks</b></td>
</tr>
<?php
	 $i=1;
	 while ($i<=30)
	 {
            printf('<tr bgcolor="#FFFFFF">');
		  $linenumber="line_num" . $i;
		  $layoutrefnum="layoutrefnum" . $i;
		  $itemname="rmcode" . $i;
		  $crn="crn" . $i;
		  $itemdesc="item_desc" . $i;
		  $qty="qty" . $i;
		  $material_ref="material_ref" . $i;
		  $material_spec="material_spec" . $i;
		  $uom="uom" . $i;
          $dia="dia" . $i;
          $thick="thick" . $i;
		  $width="width" . $i;
		  $len="len" . $i;
		  $grainflow="grainflow" . $i;
          $maxruling="maxruling" . $i;
		  $condition="condition" . $i;
		  $qty_per_meter="qty_per_meter" . $i;
		  $no_of_meterages="no_of_meterages" . $i;
		  $no_of_lengths="no_of_lengths" . $i;
		  $duedate="due_date" . $i;
		  $due_datef="due_datef" . $i;
		  $due_dates="due_dates" . $i;
          $delvby="delvby" . $i;
          $rate="rate" . $i;
 	      $amount="amount" . $i;
 	      $delivery_time = "delivery_time" . $i;
 	      $delivery = "delivery" . $i;
 	      $qty_rej = "qty_rej". $i;
 	      $order_qty = "order_qty". $i;
 	      $alt_spec = "alt_spec". $i;
 	      $spec_type="spec_type".$i;
 	      $remarks_li="remarks_li".$i;
		  $num_of_units_req="num_of_units_req" .$i;

		  echo "<td><span class=\"tabletext\"><input type=\"text\" id=\"$linenumber\"  name=\"$linenumber\"  value=\"\" size=\"3%\"></td>";
		  echo "<input type=\"hidden\" id=\"$layoutrefnum\"  name=\"$layoutrefnum\"  value=\"\" size=\"3%\">";
          echo "<input type=\"hidden\"   name=\"$delivery_time\" value=\"1\" size=\"3%\">";
          echo "<input type=\"hidden\"   name=\"$delivery_time\" value=\"2\" size=\"3%\">";
          echo "<input type=\"hidden\"   name=\"$delivery_time\" value=\"3\" size=\"3%\">";
          echo "<td><span class=\"tabletext\"><input type=\"text\" id=\"$qty_rej\"  name=\"$qty_rej\" value=\"\" size=\"3%\"></td>";
		 echo "<td><select name=\"$spec_type\" id=\"$spec_type\"  size=\"1\" width=\"100\">"
?>
<!--        <td><select name="<?php //echo $spec_type ?>" id="<?php //echo $spec_type ?>" size="1" width="100">-->
         	 				<option selected value="Primary Spec">Primary Spec
        					<option value="Alt Spec1">Alt Spec1
        					<option value="Alt Spec2">Alt Spec2
        	 </select>
                 </td>
		<!--<img src="images/bu-get.gif" alt="Get RMCode"  onclick="GetRM('<?php echo "$i";?>')">-->
<?php

         echo "<td><input type=\"text\" id=\"$crn\" name=\"$crn\" size=\"8%\" value=\"\">";?><img src="images/bu-get.gif" alt="Get CIM"  onclick="GetCIM4Po('<?php echo "$i";?>')"></td>

<?php
 	            echo "<td><input type=\"text\" id=\"$order_qty\" name=\"$order_qty\"  size=\"5%\" value=\"\">
	         	<input type=\"hidden\" id=\"$alt_spec\" name=\"$alt_spec\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" size=\"5%\" value=\"\"></td>";

                echo "<td><input type=\"text\" id=\"$material_ref\" name=\"$material_ref\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" size=\"6%\" value=\"\"></td>";
                echo "<td><input type=\"text\" id=\"$material_spec\" name=\"$material_spec\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"  size=\"10%\" value=\"\"></td>";
                echo "<td><span class=\"tabletext\"><textarea id=\"$condition\" name=\"$condition\" rows=\"2\"
                style=\"background-color:#DDDDDD;\" readonly=\"readonly\"
			              cols=\"15\" value=\"\"></textarea></td>";
	            echo "<td><input type=\"text\" id=\"$uom\" name=\"$uom\" size=\"5%\"style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"\"></td>";
	            echo "<td><input type=\"text\" id=\"$dia\" name=\"$dia\" size=\"5%\"style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"\"></td>";
                echo "<td><input type=\"text\" id=\"$width\" name=\"$width\" size=\"5%\"style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"\"></td>";
                echo "<td><input type=\"text\" id=\"$len\" name=\"$len\" size=\"5%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"\"></td>";
                echo "<td><input type=\"text\" id=\"$thick\" name=\"$thick\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" size=\"5%\" value=\"\"></td>";
		        echo "<td><input type=\"text\" id=\"$grainflow\" name=\"$grainflow\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"  size=\"5%\" value=\"\"></td>";
	         	echo "<td><input type=\"text\" id=\"$maxruling\" name=\"$maxruling\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" size=\"5%\" value=\"\"></td>";
               //echo "<td><input type=\"text\" name=\"$qty_per_meter " size=\"5%\" value=\"\"></td>";
                echo "<td><input type=\"text\" name=\"$no_of_meterages\" id=\"$no_of_meterages\" size=\"5%\" value=\"\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></td>";

				 echo "<td><input type=\"text\" name=\"$num_of_units_req\" id=\"$num_of_units_req\" size=\"5%\" value=\"\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></td>";




                echo "<td><input type=\"text\" name=\"$no_of_lengths\" id=\"$no_of_lengths\" size=\"5%\" value=\"\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></td>";
                echo "<td><input type=\"text\" id=\"$duedate\" name=\"$duedate\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" size=\"10%\" value=\"\">";
?>
	        <img src="images/bu-getdateicon.gif" alt="Get Date"  onclick="GetDueDate('<?php echo "$duedate";?>')"></td>
	        <td><input type="text" id="<?php echo "$due_datef";?>" name="<?php echo "$due_datef";?>" style="background-color:#DDDDDD;"  size="10%" value="">
	        <img src="images/bu-getdateicon.gif" alt="Get Date"  onclick="GetDueDate('<?php echo "$due_datef";?>')"></td>
	        <td><input type="text" id="<?php echo "$due_dates";?>" name="<?php echo "$due_dates";?>" style="background-color:#DDDDDD;"  size="10%" value="">
	        <img src="images/bu-getdateicon.gif" alt="Get Date"  onclick="GetDueDate('<?php echo "$due_dates";?>')"></td>

          	<td><select name=<?php echo $delvby ?> size="1" width="100">
         	 				<option selected>SEA
        					<option value>AIR
        					<option value>LAND
        	 </select>
                 </td>
<?php

            echo "<td><input type=\"text\" name=\"$rate\" id=\"$rate\"  size=\"10%\" value=\"\"></td>";
		    echo "<td><input type=\"text\" name=\"$amount\" style=\"background-color:#DDDDDD;\"
           			  		readonly=\"readonly\" size=\"10%\" value=\"\">";

            echo "<input type=\"hidden\" name=\"$delivery\" id=\"$delivery\"  value=\"\">";
            ?>
<td><center><select  name="li_status<?php echo $i ?>" id="li_status<?php echo $i ?>"  >
                   <option value="Open">Open</option>
                   <option value="Close">Close</option>
                   <option value="Amend Close">Amend Close</option>
                   </select></center></td>

<?php
echo "<td><span class=\"tabletext\"><textarea id=\"$remarks_li\" name=\"$remarks_li\" rows=\"2\"
cols=\"15\" value=\"\"></textarea></td>";
	printf('</tr>');
			$i++;
	 }
?>

<input type="hidden" name="page" id="page" value="new">
<tr bgcolor="#FFFFFF">
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
<td align="right"><span class="pageheading"><b></b></td><td width="5%"></td></tr>
<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="right">Tax</p></font></td>
<td colspan=3><input type="text" name="tax" size=10 value=""></td>
</tr>
<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="right">Shipping</p></font></td>
<td colspan=3><input type="text" name="shipping" size=10 value=""></td>
</tr>
<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="right">Labor</p></font></td>
<td colspan=3><input type="text" name="labor" size=10 value=""></td>
</tr>
</tr>
</table>
</div>
</td>
</tr>
</table>
<!-- </td>
<td width="6"><img src="images/spacer.gif " width="6"></td>
</tr>
<tr bgcolor="DEDFDE">
<td width="6"><img src="images/box-left-bottom.gif"></td>
<td><img src="images/spacer.gif " height="6"></td>
<td width="6"><img src="images/box-right-bottom.gif"></td>
</tr> -->
</table>
<table border = 0 cellpadding=0 cellspacing=0 width=100%>
<tr>
<td align=left>
</td>
</tr>
</table>
<span class="tabletext"><input type="submit"
      style="color=#0066CC;background-color:#DDDDDD;width=130;"
      value="Submit" name="submit" onclick="javascript: return check_req_fields1()">
      <INPUT TYPE="RESET"
           style="color=#0066CC;background-color:#DDDDDD;width=130;"
           VALUE="Reset" onclick="javascript: return allowReset()">
</FORM>
</body>
</html>

