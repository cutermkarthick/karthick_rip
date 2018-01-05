<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = april 03, 2007               =
// Filename: edit_review.php                   =
// Copyright of Badari Mandyam, FluentSoft     =
// Revision: v1.0 OWT                          =
// Allows copying of Review Order details      =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: ../login.php" );

}
$userid = $_SESSION['user'];

$_SESSION['pagename'] = 'newreview';
//////session_register('pagename');

// First include the class definition
include('classes/reviewClass.php');
include('classes/review_liClass.php');
include('classes/displayClass.php');

$newlogin = new userlogin;
$newlogin->dbconnect();

$newreview = new review;
$LI = new review_li;
$newdisplay = new display;

$reviewrecnum = $_REQUEST['reviewrecnum'];
//$ordernumber =  $_REQUEST['ordernum'];

$result = $newreview->getreview($reviewrecnum);
$myLI = $LI->getLI($reviewrecnum);
$myrow = mysql_fetch_assoc($result);

?>
<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/review.js"></script>
<script language="javascript" src="scripts/validate.js"></script>
<html>
<head>
<title>Edit review</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">
    <form action='processReview.php' method='post' enctype='multipart/form-data'>
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
 <table width=100% border=0 cellpadding=0 cellspacing=0  >
	<tr bgcolor="DEDFDE">
	<td width="6"><img src="images/spacer.gif " width="6"></td>
 <td bgcolor="#FFFFFF">
 <table width=100% border=0 cellspacing=4  >
	<tr><td>
 <table width=100% border=0>
	<td width="100%"><span class="pageheading"><b>New review</b></td>
    <!--<td align="right">
        <img src="images/bu-validate.gif" value="Validate" onclick="javascript:validate()" /></td> -->

    </table>

  <tr>
<td>
<table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=6>
<tr bgcolor="#DDDEDD"><td colspan=4><span class="heading"><center><b>New review Details</b></center></td></tr>

 <table width=100% border=0 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF">


        <tr bgcolor="#FFFFFF">

            <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Ref No.: </p></font></td>
<?php
 $refarray = split('-' ,$myrow["refno"]);
 $refnum = $refarray[0];
 //$ordernumber = substr($orderno,0,$pos);
 $result2 = $newreview->getrefcount($refnum);
 $myrow2 = mysql_fetch_row($result2);
 $count = $myrow2[0];
 //echo  $count;
 $refnum_copy = $refarray[0]  . '-' . "$count";
?>
            <td><span class="tabletext"><input type="text" name="refno" size=30 value="<?php echo $refnum_copy ?>" readonly="readonly" style="background-color:#DDDDDD;"></td>
            <td colspan=2>&nbsp</td>

            
        </tr>
           <input type="hidden" name="refno" value="<?php echo $refnum_copy ?>">
        <tr bgcolor="#DDDEDD">
            <td colspan=4><span class="heading"><center><b>Customer & review Details</b></center></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Customer</p></font></td>
            <td><span class="tabletext"><input type="text" name="name" size=30 value="<?php echo $myrow["name"] ?>"></td>
            <td><span class="labeltext"><span class='asterisk'>*</span>Contact Person</font></td>
            <td><span class="tabletext"><input type="text" name="person" size=30 value="<?php echo $myrow["person"] ?>"></td>
        </tr>

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext">Order Type</td>
            <td><span class="tabletext"><input type="text" name="ordertype" size=30 value="<?php echo htmlspecialchars($myrow["ordertype"]) ?>"></td>
            <td colspan=2></td>
        </tr>
        <tr bgcolor="#FFFFFF">
<?php

$pattern = '/Amnd/';
$replace = '-';
$order4split = preg_replace($pattern,$replace ,$myrow["ordernum"]);
print_r($order4plit);
$orderarray = split('-' ,$order4split);
//echo "*****".$order4split;
$ordernum = $orderarray[0];
$order_num = trim($ordernum);

//echo "---------------".$ordernum;
//echo '--------';
//$ordernumber = substr($orderno,0,$pos);
$result1 = $newreview->getordercount($order_num);
$myrow1 = mysql_fetch_row($result1);
$pocount = $myrow1[0];
if($pocount == 1)
{
  $ponum4val = $ordernum;
}
else
{
  $pocount4val = $pocount-1;
  $ponum4val = $ordernum . '-' . $pocount4val;
}
//echo "ponum is=" . $ponum4val;
$ordernum_copy = $orderarray[0]   .   ' Amnd ' . "$pocount";
//if(isset($ordernumber))
//$ordernum = $ordernumber + 1;
//else $ordernum = $myrow["ordernum"] . '-1';
?>
      
            <td><span class="labeltext"><span class='asterisk'>*</span>Order No.</td>
            <td><span class="tabletext"><input type="text" name="ordernum" size=30 value="<?php echo $ordernum_copy ?>"></td>
            <td><span class="labeltext"><span class='asterisk'>*</span>Quote Ref</td>
            <td><span class="tabletext"><input type="text" name="quoterefnum" size=30 value="<?php echo $myrow["quoterefnum"] ?>"></td>
        </tr>

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Order Date</p></font></td>
            <td><span class="tabletext"><input type="text" name="orderdate" size=20 value="<?php echo $myrow['order_date'] ?>" readonly="readonly" style="background-color:#DDDDDD;">
                                 <img src="images/bu-getdate.gif" alt="Get BookDate" onclick="GetDate('orderdate')"></td>
            <td><span class="labeltext"><p align="left">Quote Date</p></font></td>
            <td><span class="tabletext"><input type="text" name="quotedate" size=20 value="<?php echo $myrow['quote_date'] ?>" readonly="readonly" style="background-color:#DDDDDD;">
                                 <img src="images/bu-getdate.gif" alt="Get BookDate" onclick="GetDate('quotedate')"></td>
        </tr>

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext">Order Stored in the form of</td>
            <td><span class="tabletext"><input type="text" name="data_store" size=30 value="<?php echo $myrow["data_store"] ?>"></td>
            <td><span class="labeltext">Filename/Path</font></td>
            <td><span class="tabletext"><input type="text" name="path" size=30 value="<?php echo $myrow["enquiry_path"] ?>"></td>
        </tr>

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Order for</td>
            <td><span class="tabletext"><input type="text" name="orderfor" size=30 value="<?php echo htmlspecialchars($myrow["orderfor"]) ?>"></td>
            <td><span class="labeltext">Attachments</font></td>
            <td><span class="tabletext"><input type="text" name="attachment1" size=30 value="<?php echo $myrow["attachment1"] ?>"></td>
        </tr>


        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">No. of Parts</p></font></td>
            <td><span class="tabletext"><input type="text" name="numofparts" size=30 value="<?php echo $myrow["numofparts"] ?>"></td>
            <td><span class="labeltext">Classification of Parts</td>
            <td><span class="tabletext"><input type="text" name="parts_class" size=30 value="<?php echo $myrow["class"] ?>"></td>
        </tr>

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext">Raw material supplied by Customer or to be Procured</font></td>
            <td><span class="tabletext"><input type="text" name="rawmaterial" size=30 value="<?php echo $myrow["rawmaterial"] ?>"></td>
            <td><span class="labeltext">Source of Raw Material planned</td>
            <td><span class="tabletext"><input type="text" name="source" size=30 value="<?php echo $myrow["source"] ?>"></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext">Amendment Num</font></td>
            <td><span class="tabletext"><input type="text" name="amendment_num" size=30 value="<?php echo $myrow["amendment_num"] ?>"></td>
            <td><span class="labeltext">Amendment Date</td>
            <td><span class="tabletext"><input type="text" name="amendment_date" size=30 value="<?php echo $myrow["amendment_date"] ?>" readonly="readonly" style="background-color:#DDDDDD;">
                    <img src="images/bu-getdate.gif" alt="Get BookDate" onclick="GetDate('amendment_date')"></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Create Date</p></font></td>
            <td><span class="tabletext"><input type="text" name="create_date" size=20 value="<?php echo $myrow["create_date"] ?>" readonly="readonly" style="background-color:#DDDDDD;">
                                 <img src="images/bu-getdate.gif" alt="Get BookDate" onclick="GetDate('create_date')"></td>
            <td><span class="labeltext">Created By</td>
            <td><span class="tabletext"><input type="text" name="created_by" size=30 value="<?php echo $myrow["created_by"] ?>"  </td>

        </tr>
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext">QA Approved</font></td>
             <?php

   $checked1="";
   $_SESSION['pagename'];
   if($myrow["qa_approved"] == 'yes'){
   $checked1="checked";
   }
   ?>

   <td bgcolor="#FFFFFF"><input type="checkbox" <?php echo $checked1 ?> name="qa_approved"  onclick="JavaScript:toggleValue('qa_app',this);">
                         <input type="hidden" name="qa_app" value="<?php echo $myrow["qa_approved"]?>" id="qa_app"></td>

            <td><span class="labeltext">Engineering Approved</td>
            <?php

   $checked2="";

   if($myrow["engineering_approved"] == 'yes'){
   $checked2="checked";
   }
   ?>

   <td bgcolor="#FFFFFF"><input type="checkbox" <?php echo $checked2 ?> name="engineering_approved"  onclick="JavaScript:toggleValue('eng_app',this);">
                         <input type="hidden" name="eng_app" value="<?php echo $myrow["engineering_approved"]?>" id="eng_app"></td>

        </tr>

        <tr bgcolor="#DDDEDD">
            <td colspan=4><span class="heading"><center><b>Purchase Order Requirements</b></center></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td colspan=2><span class="labeltext">Any resources required apart from the existing for this enquiry?
                         <br>Provide Details</td>
            <td colspan=2><span class="tabletext"><input type="text" name="resources" size=90 value="<?php echo $myrow["resources"] ?>"></td>
        </tr>
        <tr bgcolor="#DDDEDD">
            <td colspan=4><span class="heading"><center><b>Quality</b></center></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td colspan=2><span class="labeltext">Are quality requirements clear?
                       <br><b>Is it In-line with Organization or Specific</td>
            <td colspan=2><span class="tabletext"><input type="text" name="qualityreq" size=90 value="<?php echo $myrow["qualityreq"] ?>"></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td colspan=2><span class="labeltext">Comments on Specific Requirements</font></td>
            <td colspan=2><span class="tabletext"><input type="text" name="saliant" size=90 value="<?php echo $myrow["saliant"] ?>"></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td colspan=2><span class="labeltext">Any additional resources required for quality<br>
                in terms of Resources/Equipment/Infrastructure? Explain.</td>
            <td colspan=2><span class="tabletext"><input type="text" name="aditional_resources" size=90 value="<?php echo $myrow["aditional_resources"] ?>"></td>
        </tr>

        <tr bgcolor="#DDDEDD">
            <td colspan=4><span class="heading"><center><b>Outsourcing Activity</b></center></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td colspan=2><span class="labeltext">Any Outsourcing/Subcontracting activity needs to be planned?<br>
                   If yes, provide details</font></td>
            <td colspan=2><span class="tabletext"><input type="text" name="subcontract" size=90 value="<?php echo $myrow["subcontract"] ?>"></td>
        </tr>
        <tr bgcolor="#DDDEDD">
            <td colspan=4><span class="heading"><center><b>Special Processes</b></center></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td colspan=2><span class="labeltext">Is there any special process involved?<br>If yes, provide details</font></td>
            <td colspan=2><span class="tabletext"><input type="text" name="special_process" size=90 value="<?php echo $myrow["special_process"] ?>"></td>
        </tr>
        <tr bgcolor="#DDDEDD">
            <td colspan=4><span class="heading"><center><b>Delivery Requirements</b></center></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td colspan=2><span class="labeltext">Are delivery requirements of the Enquiry Clear?</font></td>
            <td colspan=2><span class="tabletext"><input type="text" name="delivery_req" size=90 value="<?php echo $myrow["delivery_req"] ?>"></td>
        </tr>
        <tr bgcolor="#DDDEDD">
            <td colspan=5><span class="heading"><center><b>Risk Analysis</b></center></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td colspan=2><span class="labeltext">Do you foresee any Risk as to the requirements of this<br>
                        Enquiry? If YES, state the probable Risk factor</td>
            <td colspan=2><span class="tabletext"><input type="text" name="risk_factors" size=90 value="<?php echo $myrow["risk_factors"] ?>"></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td colspan=2><span class="labeltext">Explain the Risk Factor</td>
            <td colspan=2><span class="tabletext"><input type="text" name="explain_risk_factors" size=90 value="<?php echo $myrow["explain_risk_factors"] ?>"></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td colspan=2><span class="labeltext">Are any statutory or regulatory requirements applicable? If yes explain</font></td>
            <td colspan=2><span class="tabletext"><input type="text" name="requirements" size=90 value="<?php echo $myrow["requirements"] ?>"></td>
        </tr>
        <tr bgcolor="#DDDEDD">
            <td colspan=4><span class="heading"><center><b>Quotation Details</b></center></td>
        </tr>

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext">Quote Reference No.</font></td>
            <td><span class="tabletext"><input type="text" name="quotation" size=30 value="<?php echo $myrow["quotation"] ?>"></td>
            <td><span class="labeltext">Quote Sent by</td>
            <td><span class="tabletext"><input type="text" name="quote_sentby" size=30 value="<?php echo $myrow["quote_sentby"] ?>"></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td colspan=2><span class="labeltext">Details of Quotation/Estimation stored in</td>
            <td colspan=2><span class="tabletext"><input type="text" name="quotation_det_store" size=90 value="<?php echo $myrow["quotation_det_store"] ?>"></td>
        </tr>

        <tr bgcolor="#DDDEDD">
            <td colspan=4><span class="heading"><center><b>Data Storage</b></center></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td colspan=2><span class="labeltext">Data related to Enquiry stored in</td>
            <td colspan=2><span class="tabletext"><input type="text" name="data_for_enquiry" size=90 value="<?php echo $myrow["data_for_enquiry"] ?>"></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td colspan=2><span class="labeltext">Mention the Filename/Path</td>
            <td colspan=2><span class="tabletext"><input type="text" name="enquiry_path" size=90 value="<?php echo $myrow["enquiry_path"] ?>"></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td colspan=2><span class="labeltext">Data related to Quote stored in</td>
            <td colspan=2><span class="tabletext"><input type="text" name="data_for_quote" size=90 value="<?php echo $myrow["data_for_quote"] ?>"></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td colspan=2><span class="labeltext">Mention Filename/Path</td>
            <td colspan=2><span class="tabletext"><input type="text" name="quote_path" size=90 value="<?php echo $myrow["quote_path"] ?>"></td>
        </tr>
	    <tr bgcolor="#DDDEDD">
            <td colspan=4><span class="heading"><center><b>Special Instructions</b></center></td>
       </tr>

        <tr  bgcolor="#FFFFFF">
		    <td><span class="labeltext"><span class='asterisk'>* </span>Special Instructions</font></td>
            <td colspan=4><textarea name="special_instrns" rows="4" cols="45" value=""><?php echo  $myrow["special_instrns"];?></textarea></td>
		 </tr>



             <input type="hidden" name="reviewrecnum" value="<?php echo $reviewrecnum ?>">
             <input type="hidden" name="deleteflag" value="">

       <tr bgcolor="#DDDEDD">
<td colspan=4><span class="heading"><center><b>Sales Order Line Items</b></center></td>
</tr>

<tr bgcolor="#FFFFFF"><td><a href="javascript:addRow('myTable',document.forms[0].index.value)"><img name="Image7" border="0" src="images/bu-addrow.gif"></a>
<td colspan=4 bgcolor="#FFFFFF"><span class="tabletext">To delete line items - blankout line number</td></tr>
<tr bgcolor="#FFFFFF">

<table id="myTable" width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
<td bgcolor="#EEEFEE"><span class="heading"><b><center>PO Line Item</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>CRN No.</center></b></td>
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
   $i=1;$flag=0;
   while($i<=40)
	{
		if($flag==0)
		{
		 while ($LI = mysql_fetch_row($myLI))
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
            $drgiss="drgiss" . $i;
            $hcdrgiss="hcdrgiss" . $i;
            $partiss="partiss" . $i;
            $hcpartiss="hcpartiss" . $i;
            $po_cos="po_cos" . $i;
            $hc_cos="hc_cos" . $i;
            $cos_iss="cos_iss" . $i;
            $model_iss="model_iss" . $i;
	        $qty="qty" . $i;
	        $crn_num="crn_num" . $i;

      		$prevlinenum="prev_line_num" . $i;
			$lirecnum="lirecnum" . $i;
			//echo "prevlinenum  : " . $prevlinenum . "    " . $LI[0];
			//echo "<br>$linenumber<br>$prevlinenum<br>$lirecnum<br>";
			echo "<td ><span class=\"tabletext\"><input type=\"text\"  name=\"$linenumber\"  value=\"$LI[0]\" size=\"10%\"></td>";
			echo "<td ><input type=\"text\" name=\"$crn_num\" size=\"15%\" value=\"$LI[23]\"></td>";
	    	echo "<input type=\"hidden\" name=\"$prevlinenum\" value=\"$LI[0]\">";
			echo "<input type=\"hidden\" name=\"$lirecnum\" value=\"$LI[3]\">";
            echo "<td ><input type=\"text\" name=\"$partnum\" size=\"10%\" value=\"$LI[4]\"></td>";
			echo "<td ><input type=\"text\" name=\"$itemdesc\" size=\"10%\" value=\"$LI[1]\"></td>";
            echo "<td ><input type=\"text\" name=\"$rmtype\" size=\"10%\" value=\"$LI[5]\"></td>";
            echo "<td ><input type=\"text\" name=\"$rmspec\" size=\"10%\" value=\"$LI[6]\"></td>";
			echo "<td ><input type=\"text\" name=\"$uom\" size=\"10%\" value=\"$LI[14]\"></td>";
			echo "<td ><input type=\"text\" name=\"$dia\" size=\"10%\" value=\"$LI[15]\"></td>";
			echo "<td ><input type=\"text\" name=\"$length\" size=\"10%\" value=\"$LI[16]\"></td>";
			echo "<td ><input type=\"text\" name=\"$width\" size=\"10%\" value=\"$LI[17]\"></td>";
			echo "<td ><input type=\"text\" name=\"$thickness\" size=\"10%\" value=\"$LI[18]\"></td>";
			echo "<td ><input type=\"text\" name=\"$gf\" size=\"10%\" value=\"$LI[19]\"></td>";
			echo "<td ><input type=\"text\" name=\"$maxruling\" size=\"10%\" value=\"$LI[20]\"></td>";
			echo "<td ><input type=\"text\" name=\"$altspec\" size=\"10%\" value=\"$LI[21]\"></td>";
            echo "<td><input type=\"text\" name=\"$drgiss\" size=\"10\" value=\"$LI[8]\"></td>";
          //  echo "<td><input type=\"text\" name=\"$hcdrgiss\" size=\"10\" value=\"$LI[9]\"></td>";
            echo "<td><input type=\"text\" name=\"$partiss\" size=\"10\" value=\"$LI[7]\"></td>";
          //  echo "<td><input type=\"text\" name=\"$hcpartiss\" size=\"10\" value=\"$LI[10]\"></td>";
         //   echo "<td><input type=\"text\" name=\"$po_cos\" size=\"10\" value=\"$LI[11]\"></td>";
          //  echo "<td><input type=\"text\" name=\"$hc_cos\" size=\"10\" value=\"$LI[12]\"></td>";
            echo "<td><input type=\"text\" name=\"$cos_iss\" size=\"10\" value=\"$LI[13]\"></td>";
            echo "<td><input type=\"text\" name=\"$model_iss\" size=\"10\" value=\"$LI[22]\"></td>";
			echo "<td ><input type=\"text\" name=\"$qty\" size=\"10%\" value=\"$LI[2]\"></td>";
			printf('</tr>');
   $i++;
  	        }
  	$flag=1;
         }
//echo "i am in outside while loop";
		printf('<tr bgcolor="#FFFFFF">');
    	$line_num="line_num" . $i;
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
            $drgiss="drgiss" . $i;
            $hcdrgiss="hcdrgiss" . $i;
            $partiss="partiss" . $i;
            $hcpartiss="hcpartiss" . $i;
            $po_cos="po_cos" . $i;
            $hc_cos="hc_cos" . $i;
            $cos_iss="cos_iss" . $i;
            $model_iss="model_iss" . $i;
	        $qty="qty" . $i;
            $crn_num="crn_num" . $i;
		$prevlinenum="prev_line_num" . $i;
		$lirecnum="lirecnum" . $i;
		//echo "<br>$line_num<br>$prevlinenum<br>$lirecnum<br>";
    	echo "<td><span class=\"tabletext\"><input type=\"text\"  name=\"$line_num\"  value=\"\" size=\"10%\"></td>";
    	echo "<td><input type=\"text\" name=\"$crn_num\" size=\"15%\" value=\"\"></td>";
		echo "<input type=\"hidden\" name=\"$prevlinenum\" value=\"\">";
		echo "<input type=\"hidden\" name=\"$lirecnum\" value=\"\">";
        echo "<td><input type=\"text\" name=\"$partnum\" size=\"10%\" value=\"\"></td>";
        echo "<td><input type=\"text\" name=\"$itemdesc\" size=\"10%\" value=\"\"></td>";
        echo "<td><input type=\"text\" name=\"$rmtype\" size=\"10%\" value=\"\"></td>";
        echo "<td><input type=\"text\" name=\"$rmspec\" size=\"10%\" value=\"\"></td>";
		echo "<td ><input type=\"text\" name=\"$uom\" size=\"10%\" value=\"\"></td>";
		echo "<td ><input type=\"text\" name=\"$dia\" size=\"10%\" value=\"\"></td>";
		echo "<td ><input type=\"text\" name=\"$length\" size=\"10%\" value=\"\"></td>";
		echo "<td ><input type=\"text\" name=\"$width\" size=\"10%\" value=\"\"></td>";
		echo "<td ><input type=\"text\" name=\"$thickness\" size=\"10%\" value=\"\"></td>";
		echo "<td ><input type=\"text\" name=\"$gf\" size=\"10%\" value=\"\"></td>";
		echo "<td ><input type=\"text\" name=\"$maxruling\" size=\"10%\" value=\"\"></td>";
		echo "<td ><input type=\"text\" name=\"$altspec\" size=\"10%\" value=\"\"></td>";
        echo "<td><input type=\"text\" name=\"$drgiss\" size=\"10\" value=\"\"></td>";
     //   echo "<td><input type=\"text\" name=\"$hcdrgiss\" size=\"10\" value=\"\"></td>";
        echo "<td><input type=\"text\" name=\"$partiss\" size=\"10\" value=\"\"></td>";
   //     echo "<td><input type=\"text\" name=\"$hcpartiss\" size=\"10\" value=\"\"></td>";
    //    echo "<td><input type=\"text\" name=\"$po_cos\" size=\"10\" value=\"\"></td>";
    //    echo "<td><input type=\"text\" name=\"$hc_cos\" size=\"10\" value=\"\"></td>";
        echo "<td><input type=\"text\" name=\"$cos_iss\" size=\"10\" value=\"\"></td>";
        echo "<td><input type=\"text\" name=\"$model_iss\" size=\"10\" value=\"\"></td>";
		echo "<td><input type=\"text\" name=\"$qty\" size=\"10%\" value=\"\"></td>";

		printf('</tr>');
		$i++;
	 }
	 echo "<input type=\"hidden\" name=\"index\" value=$i>";

 ?>

</table>
</table>
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
<span class="labeltext">
               <!-- <input type="button"
                style="color=#0066CC;background-color:#DDDDDD;width=130;"
                value="Validate" name="Validate" onclick="javascript:return validate4newpo();">  -->
                <input type="submit"
                style="color=#0066CC;background-color:#DDDDDD;width=130;"
                value="Submit" name="submit" onclick="javascript:return check_req_fields();">
                <INPUT TYPE="RESET"
                style="color=#0066CC;background-color:#DDDDDD;width=130;"
                VALUE="Reset" onclick="javascript: putfocus()">

					</FORM>
		</body>
</html>
