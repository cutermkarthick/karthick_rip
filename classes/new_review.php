<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = April 03, 2007               =
// Filename: new_review.php                    =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OWT                          =
// Allows entry of Review Order                 =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: ../login.php" );

}
$userid = $_SESSION['user'];

$_SESSION['pagename'] = 'newreview';
session_register('pagename');

// First include the class definition
include('classes/loginClass.php');
include('classes/displayClass.php');

$newlogin = new userlogin;
$newlogin->dbconnect();

$newdisplay = new display;

?>


<link rel="stylesheet" href="style.css">
<script language="javascript" src="../scripts/mouseover.js"></script>
<script language="javascript" src="scripts/review.js"></script>

<html>
<head>
<title>Review Stage</title>
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
        					<td align="right">&nbsp;
       					<a href="exit.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image16','','images/logout_mo.gif',1)"><img name="Image16" border="0" src="images/logout.gif"></a></td>
        				 </tr>
			</table>
			<table width=100% border=0 cellpadding=0 cellspacing=0  >
				<tr><td></td></tr>
				<tr>
					<td>
<?php $newdisplay->dispLinks(''); ?>
</td></tr>
<table width=100% border=0 cellpadding=0 cellspacing=0  >

	<tr bgcolor="DEDFDE"><td width="6"><img src="images/spacer.gif " width="6"></td>
	     		     <td bgcolor="#FFFFFF">
				<table width=100% border=0 cellpadding=6 cellspacing=0  >
    <tr>
        <td><span class="pageheading"><b>Contract Review Order Stage</b></td>
    </tr>


     <form action='processReview.php' method='post' enctype='multipart/form-data'>
<tr>
<td>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >

<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >

        <tr bgcolor="#DDDEDD">
            <td colspan=4><span class="heading"><center><b>Customer & Order Details</b></center></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Customer</p></font></td>
            <td><span class="tabletext"><input type="text" name="name" size=30 value=""></td>
            <td><span class="labeltext"><span class='asterisk'>*</span>Contact Person</font></td>
            <td><span class="tabletext"><input type="text" name="person" size=30 value=""></td>

        </tr>
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Order No.</p></font></td>
            <td><span class="tabletext"><input type="text" name="ordernum" size=30 value=""></td>
            <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Quote Ref</p></font></td>
            <td><span class="tabletext"><input type="text" name="quoterefnum" size=30 value=""></td>
        </tr>
        
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Order Date</p></font></td>
            <td><span class="tabletext"><input type="text" name="orddate" size=20 value="" readonly="readonly" style="background-color:#DDDDDD;">
                                 <img src="images/bu-getdate.gif" alt="Get BookDate" onclick="GetDate('orddate')"></td>
            <td><span class="labeltext"><p align="left">Quote Date</p></font></td>
            <td><span class="tabletext"><input type="text" name="quotedate" size=20 value="" readonly="readonly" style="background-color:#DDDDDD;">
                                 <img src="images/bu-getdate.gif" alt="Get BookDate" onclick="GetDate('quotedate')"></td>
        </tr>

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext">Order Stored in the form of</td>
            <td><span class="tabletext"><input type="text" name="data_store" size=30 value=""></td>
            <td><span class="labeltext">Filename/Path</font></td>
            <td><span class="tabletext"><input type="text" name="path" size=30 value=""></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext">Order Type</td>
            <td><span class="tabletext"><input type="text" name="ordtype" size=30 value=""></td>
            <td colspan=2>&nbsp</td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Order for</td>
            <td><span class="tabletext"><input type="text" name="orderfor" size=30 value=""></td>
            <td><span class="labeltext">Attachments</font></td>
            <td><span class="tabletext"><input type="text" name="attachment1" size=30 value=""></td>
        </tr>


        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">No. of Parts</p></font></td>
            <td><span class="tabletext"><input type="text" name="numofparts" size=30 value=""></td>
            <td><span class="labeltext">Classification of Parts</td>
            <td><span class="tabletext"><input type="text" name="parts_class" size=30 value=""></td>
        </tr>

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext">Raw material supplied by Customer or to be Procured</font></td>
            <td><span class="tabletext"><input type="text" name="rawmaterial" size=30 value=""></td>
            <td><span class="labeltext">Source of Raw Material planned</td>
            <td><span class="tabletext"><input type="text" name="source" size=30 value=""></td>
        </tr>
        
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext">Amendment Num</font></td>
            <td><span class="tabletext"><input type="text" name="amendment_num" size=30 value=""></td>
            <td><span class="labeltext">Amendment Date</td>
            <td><span class="tabletext"><input type="text" name="amendment_date" size=30 value="" readonly="readonly" style="background-color:#DDDDDD;">
                    <img src="images/bu-getdate.gif" alt="Get BookDate" onclick="GetDate('amendment_date')"></td>
        </tr>

        <tr bgcolor="#DDDEDD">
            <td colspan=4><span class="heading"><center><b>Purchase Order Requirements</b></center></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td colspan=2><span class="labeltext">Any resources required apart from the existing for this order?
                   <br>Provide Details</font></td>
            <td colspan=2><span class="tabletext"><input type="text" name="resources" size=90 value=""></td>
        </tr>
        <tr bgcolor="#DDDEDD">
            <td colspan=4><span class="heading"><center><b>Quality</b></center></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td colspan=2><span class="labeltext">Are quality requirements clear? 
                              <br><b>Is it In-line with Organization or Specific</td>
            <td colspan=2><span class="tabletext"><input type="text" name="qualityreq" size=90 value=""></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td colspan=2><span class="labeltext">Comments on Specific Requirements</font></td>
            <td colspan=2><span class="tabletext"><input type="text" name="saliant" size=90 value=""></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td colspan=2><span class="labeltext">Any additional requirements for quality<br>
                in terms of Resources/Equipment/Infrastructure? Explain.</td>
            <td colspan=2><span class="tabletext"><input type="text" name="aditional_resources" size=90 value=""></td>
        </tr>

        <tr bgcolor="#DDDEDD">
            <td colspan=4><span class="heading"><center><b>Outsourcing Activity</b></center></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td colspan=2><span class="labeltext">Any Outsourcing/Subcontracting activity needs to be planned?<br>
                   If yes, provide details</font></td>
            <td colspan=2><span class="tabletext"><input type="text" name="subcontract" size=90 value=""></td>
        </tr>
        <tr bgcolor="#DDDEDD">
            <td colspan=4><span class="heading"><center><b>Special Processes</b></center></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td colspan=2><span class="labeltext">Is there any Special Process involved?<br>If yes, provide details</font></td>
            <td colspan=2><span class="tabletext"><input type="text" name="special_process" size=90 value=""></td>
        </tr>
        <tr bgcolor="#DDDEDD">
            <td colspan=4><span class="heading"><center><b>Delivery Requirements</b></center></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td colspan=2><span class="labeltext">Are delivery requirements of the Order Clear?</font></td>
            <td colspan=2><span class="tabletext"><input type="text" name="delivery_req" size=90 value=""></td>
        </tr>
        <tr bgcolor="#DDDEDD">
            <td colspan=5><span class="heading"><center><b>Risk Analysis</b></center></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td colspan=2><span class="labeltext">Do you foresee any Risk as to the requirements of this<br>
                        Order? If YES, state the probable Risk factor</td>
            <td colspan=2><span class="tabletext"><input type="text" name="risk_factors" size=90 value=""></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td colspan=2><span class="labeltext">Explain the Risk Factor</td>
            <td colspan=2><span class="tabletext"><input type="text" name="explain_risk_factors" size=90 value=""></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td colspan=2><span class="labeltext">Are any statutory or regulatory requirements applicable?<br> 
                            If yes, provide details</font></td>
            <td colspan=2><span class="tabletext"><input type="text" name="requirements" size=90 value=""></td>
        </tr>
        <tr bgcolor="#DDDEDD">
            <td colspan=4><span class="heading"><center><b>Quotation Details</b></center></td>
        </tr>

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext">Quote Reference No.</font></td>
            <td><span class="tabletext"><input type="text" name="quotation" size=30 value=""></td>
            <td><span class="labeltext">Quote Sent by</td>
            <td><span class="tabletext"><input type="text" name="quote_sentby" size=90 value=""></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td colspan=2><span class="labeltext">Details of Quotation/Estimation stored in</td>
            <td colspan=2><span class="tabletext"><input type="text" name="quotation_det_store" size=90 value=""></td>
        </tr>

        <tr bgcolor="#DDDEDD">
            <td colspan=4><span class="heading"><center><b>Data Storage</b></center></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td colspan=2><span class="labeltext">Data related to Enquiry stored in</td>
            <td colspan=2><span class="tabletext"><input type="text" name="data_for_enquiry" size=90 value=""></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td colspan=2><span class="labeltext">Mention the Filename/Path</td>
            <td colspan=2><span class="tabletext"><input type="text" name="enquiry_path" size=90 value=""></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td colspan=2><span class="labeltext">Data related to Quote stored in</td>
            <td colspan=2><span class="tabletext"><input type="text" name="data_for_quote" size=90 value=""></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td colspan=2><span class="labeltext">Mention the Filename/Path</td>
            <td colspan=2><span class="tabletext"><input type="text" name="quote_path" size=90 value=""></td>
        </tr>
        
	    <tr bgcolor="#DDDEDD">
            <td colspan=4><span class="heading"><center><b>Special Instructions</b></center></td>
       </tr>

        <tr  bgcolor="#FFFFFF">
		    <td><span class="labeltext"><span class='asterisk'>* </span>Special Instructions</font></td>
            <td colspan=4><textarea name="special_instrns" rows="4" cols="45" value=""></textarea></td>
		 </tr>
        <tr bgcolor="#DDDEDD">
<td colspan=10><span class="heading"><center><b>Review Line Items</b></center></td>
</tr>
<tr bgcolor="#FFFFFF"><td colspan=17><a href="javascript:addRow('myTable',document.forms[0].index.value)"><img name="Image7" border="0" src="images/bu-addrow.gif"></a></td></tr>
<tr bgcolor="#FFFFFF">
<table id="myTable" width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
<td bgcolor="#EEEFEE"><span class="heading"><b><center>PO Line Item</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Part Number</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Part Name</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>RM Type</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>RM Spec</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>UOM</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Dia</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Length</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Width</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Thickness</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Grain Flow</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Max Ruling Section</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Alt Spec</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Drg Iss</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Part Iss/Attach</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>COS Issue</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Model Issue</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Qty</center></b></td>

</tr>

<?php
      $i=1;
      while ($i<=5)
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
    $drgiss="drgiss" . $i;
    //$hcdrgiss="hcdrgiss" . $i;
    $partiss="partiss" . $i;
   // $hcpartiss="hcpartiss" . $i;
    //$po_cos="po_cos" . $i;
   // $hc_cos="hc_cos" . $i;
    $cos_iss="cos_iss" . $i;
    $model_iss="model_iss" . $i;
	$qty="qty" . $i;
	$price="price" . $i;
	$amount="amount" . $i;
	$rmprice="rmprice" . $i;
	$rmamount="rmamount" . $i;
	$mcprice="mcprice" . $i;
	$mcamount="mcamount" . $i;
	echo "<td><span class=\"tabletext\"><input type=\"text\"  name=\"$line_num\"  value=\"\" size=\"10\"></td>";
    echo "<td><input type=\"text\" name=\"$partnum\" size=\"10\" value=\"\"></td>";
    echo "<td><input type=\"text\" name=\"$item_desc\" size=\"10\" value=\"\"></td>";
    echo "<td><input type=\"text\" name=\"$rmtype\" size=\"10\" value=\"\"></td>";
    echo "<td><input type=\"text\" name=\"$rmspec\" size=\"10\" value=\"\"></td>";
    echo "<td><input type=\"text\" name=\"$uom\" size=\"10\" value=\"\"></td>";
    echo "<td><input type=\"text\" name=\"$dia\" size=\"10\" value=\"\"></td>";
    echo "<td><input type=\"text\" name=\"$length\" size=\"10\" value=\"\"></td>";
    echo "<td><input type=\"text\" name=\"$width\" size=\"10\" value=\"\"></td>";
    echo "<td><input type=\"text\" name=\"$thickness\" size=\"10\" value=\"\"></td>";
    echo "<td><input type=\"text\" name=\"$gf\" size=\"10\" value=\"\"></td>";
    echo "<td><input type=\"text\" name=\"$maxruling\" size=\"10\" value=\"\"></td>";
    echo "<td><input type=\"text\" name=\"$altspec\" size=\"10\" value=\"\"></td>";

    echo "<td><input type=\"text\" name=\"$drgiss\" size=\"10\" value=\"\"></td>";
   //echo "<td><input type=\"text\" name=\"$hcdrgiss\" size=\"10\" value=\"\"></td>";
    echo "<td><input type=\"text\" name=\"$partiss\" id=\"$partiss\" size=\"10\" value=\"\"></td>";
    //echo "<td><input type=\"text\" name=\"$hcpartiss\" size=\"10\" value=\"\"></td>";
   // echo "<td><input type=\"text\" name=\"$po_cos\" size=\"10\" value=\"\"></td>";
   // echo "<td><input type=\"text\" name=\"$hc_cos\" size=\"10\" value=\"\"></td>";
    echo "<td><input type=\"text\" name=\"$cos_iss\" id=\"$cos_iss\" size=\"10\" value=\"\"></td>";
    echo "<td><input type=\"text\" name=\"$model_iss\" id=\"$model_iss\" size=\"10\" value=\"\"></td>";
    echo "<td><input type=\"text\" name=\"$qty\" size=\"10\" value=\"\"></td>";

	printf('</tr>');
	$i++;
    }
echo "<input type=\"hidden\" name=\"index\" value=$i>";

?>


        </table>
	</td>
    </tr>


</table>

</td>
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
                value="Submit" name="submit" onclick="javascript:return check_req_fields();">
                <INPUT TYPE="RESET"
                style="color=#0066CC;background-color:#DDDDDD;width=130;"
                VALUE="Reset" onclick="javascript: putfocus()">

      </FORM>
</table>
</body>
</html>
