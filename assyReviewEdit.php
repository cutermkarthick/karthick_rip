<?php
//==============================================
// Author: FSI                                 =
// Date-written = April , 2010                 =
// Filename: dnEntry.php                       =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 WMS                          =
// Allows entry of Dispatchs                   =
//==============================================

session_start();
header("Cache-control: private");
if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );
}
$userid = $_SESSION['user'];

$_SESSION['pagename'] = 'assyReviewEdit';
$page= "CRM: Assy Review";
//////session_register('pagename');

// First include the class definition
include('classes/displayClass.php');
include('classes/assyReviewClass.php');
include('classes/companyClass.php');
include('classes/assyReview_liClass.php');
include('classes/bomClass.php');
include('classes/vendPartClass.php');
$newassyReview  = new assyReview;
$newLI = new assyReview_li;
$newdisp = new display;
$company = new company;
$bom = new bom;
$newVend = new vendPart;
$recnum=$_REQUEST['recnum'];
$result = $newassyReview->getassyReviewDetails($recnum);
$myrow=mysql_fetch_assoc($result);
?>

<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/assy_review.js"></script>

<html>
<head>
<title>Edit Contract Review for Assembly Order</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">
<form action='assyReviewProcess.php' method='POST' enctype="application/x-www-form-urlencoded">
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
<td width="6"><img src="images/spacer.gif " width="6"></td>
<td bgcolor="#FFFFFF">
<table width=100% border=0 cellpadding=6 cellspacing=0>
<tr><td>
<table width=100% border=0>
<tr> -->
<td><span class="pageheading"><b>Edit Contract Review for Assembly Order</b></td>
</tr>
</table>

<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1">
<tr bgcolor="#FFFFFF">
<tr bgcolor="#EEEFEE"><td colspan=4><span class="heading"><center><b>General Information</b></center></td></tr>
<tr><td>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
<tr bgcolor="#FFFFFF">
<td width="20%"><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Assembly Review#</p></font></td>
<td width="20%"><input type="text" name="cust_ponum"  size=20 value="<?echo $myrow['cust_ponum']?>"  style=";background-color:#DDDDDD;" readonly="readonly">
<input type="hidden" name="recnum" value="<?echo $recnum?>"></td>
<?php
$result_cust = $company->getAllCustomers();
?>
<td width='20%'><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Customer</p></font></td>
<td><select id="customer" name="customer">
<option selected value="<?php echo $myrow['customer']?>"><?php echo $myrow['name']?></option>
<?php
while($myrow_cust = mysql_fetch_row($result_cust))
{
  printf('<option value= %s>%s',$myrow_cust[0],$myrow_cust[1]);
}
?>
</select></td>
</tr>
<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>PO Date</p></font></td>
<td><input type="text" id="po_date" name="po_date"
			 style=";background-color:#DDDDDD;"
			readonly="readonly" size=10 value="<?php echo $myrow['po_date']?>">
<img src="images/bu-getdateicon.gif" alt="Get Date"  onclick="GetDate('po_date')"></td>
<td><span class="labeltext"><p align="left">Line Items in PO</p></font></td>
<td><input type="text" name="po_li" id="po_li" size=20 value="<?php echo $myrow['poline']?>"></td>
</tr>
<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">Review Ref</p></font></td>
<td><input type="text" name="review_ref" id="review_ref"  size=20 value="<?php echo $myrow["review_ref"]?>"></td>
<td><span class="labeltext"><p align="left">Review Date</p></font></td>
<td><input type="text" id="review_date" name="review_date"
			 style=";background-color:#DDDDDD;"
			readonly="readonly" size=10 value="<?php echo $myrow["review_date"]?>">
<img src="images/bu-getdateicon.gif" alt="Get Date"  onclick="GetDate('review_date')"></td>
</tr>

            <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><span class='asterisk'>* </span>Special Instruction</font></td>
            <td colspan=3><textarea name="special_instruction"
			        style="background-color:#DDDDDD;"
                    rows="4"  cols="45"><?php echo $myrow["special_instruction"] ?></textarea></td>
            </tr>
<!--
<?php
$result_bom = $bom->getBom_assywo();
while($myrow_bom = mysql_fetch_row($result_bom))
{
   echo "<option value='$myrow_bom[0]|$myrow_bom[1]'>$myrow_bom[0]";
}
?>
</select></td>
</tr>-->
<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">Contact Person</p></font></td>
<td><input type="text" name="contact" id="contact"  size=15 value="<?php echo $myrow["contact"]?>"></td>
<td><span class="labeltext"><p align="left">Email</p></font></td>
<td><input type="text" name="email_id" id="email_id"  size=20 value="<?php echo $myrow["email"]?>"></td>
</tr>

<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">Order for</p></font></td>
<td><input type="text" name="order_for" id="order_for"  size=15 value="<?php echo $myrow["order_for"]?>"></td>
<td><span class="labeltext"><p align="left">Order Type</p></font></td>
<td><input type="text" name="ord_type" id="ord_type"  size=20 value="<?php echo $myrow["ord_type"]?>"></td>
</tr>

<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">Ammendment No</p></td>
<td><input type="text" name="amendment" id="amendment"  size=20 value="<?php echo $myrow["amendment_num"]?>"></td>
<td><span class="labeltext"><p align="left">Ammendment Date</p></font></td>
<td><input type="text" id="amnd_date" name="amnd_date"
			 style=";background-color:#DDDDDD;"
			readonly="readonly" size=10 value="<?php echo $myrow["amendment_date"]?>">
<img src="images/bu-getdateicon.gif" alt="Get Date"  onclick="GetDate('amnd_date')"></td>
</tr>

<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">Quote Ref</p></font></td>
<td><input type="text" name="quote_ref" id="quote_ref"  size=20 value="<?php echo $myrow["review_ref"]?>"></td>
<td><span class="labeltext"><p align="left">Agreements</p></font></td>
<td><input type="text" name="agr" id="agr"  size=20 value="<?php echo $myrow["agreement"]?>"></td>
</tr>
<tr bgcolor="#FFFFFF">
            <td><span class="tabletext"><p align="left"><b>Status</b></p></font></td>
            <td ><span class="tabletext"><input type="text" name="status" size=15  value="<?php echo $myrow["status"] ?>"<td>
            <span class="tabletext"><select name="active"  size="1" width="10" onchange="onSelectStatus()">
             <option selected>Please Specify
             <option value>Open
             <option value>Pending
             <option value>Closed
             <option value>Cancelled
            </select>
            <input type="hidden" name="activeval" value="<?php echo $myrow["status"] ?>">

            </td>
<td><span class="labeltext"><p align="left">Project</p></font></td>
<td><input type="text" name="project" id="project"  size=20 value="<?php echo $myrow["project"]?>"></td>
</tr>
<tr bgcolor="#FFFFFF">
            <td><span class="labeltext">Engineering Approved</font></td>
            <input type="hidden" name="userid" id="userid" value="<?php echo $userid;?>"></td>
   <?php
     $checked="checked";
     $_SESSION['pagename'];
   ?>
        <td bgcolor="#FFFFFF"><input type="checkbox" <?php echo $myrow["engineering_approved"] == 'yes'?$checked:"" ?>  name="engineering_approved" disabled>
                         <input type="hidden" name="eng_app" value="<?php echo $myrow["engineering_approved"]?>" id="eng_app">
                         <input type="hidden" name="eng_app_by" id="eng_app_by" value="<?php echo $myrow["engg_app_by"]?>"></td></td>


        <td><span class="labeltext">QA Approved</td>
        <td bgcolor="#FFFFFF"><input type="checkbox" <?php echo $myrow["qa_approved"] == 'yes'?$checked:"" ?> name="qa_approved" disabled>
                         <input type="hidden" name="qa_app" value="<?php echo $myrow["qa_approved"]?>" id="qa_app">
                         <input type="hidden" name="qa_app_by" id="qa_app_by" value="<?php echo $myrow["qa_app_by"]?>"></td>
    </tr>
   </tr>
    <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Engg Approved By</p></font></td>
            <td><span class="tabletext"><input type="text" size=20 value="<?php echo $myrow["engg_app_by"] ?>" readonly="readonly" style="background-color:#DDDDDD;"></td>
            <td><span class="labeltext">QA Approved By</td>
            <td><span class="tabletext"><input type="text" size=30 value="<?php echo $myrow["qa_app_by"] ?>" readonly="readonly" style="background-color:#DDDDDD;"></td>
    </tr>
</table>
</td></tr>
<tr><td>

<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1">
<tr bgcolor="#FFFFFF">
<td colspan=1><span class="labeltext"><p align="left"><u>Quality Requirements</u></p></font></td>
<td colspan=3><span class="labeltext"><p align="left"></p></font></td>
</tr>

<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">Are the Technical requirements clear?</p></font></td>
<td colspan=3><input type="text" name="technical_requirements"  id="technical_requirements"  size=80 value="<?php echo $myrow["technical_requirement"]?>"></td>
</tr>

<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">Are the quality requirements with regards to Traceablity,NDT,<br>secondary processes assembly,preservation and packing clear?</p></font></td>
<td colspan=3><input type="text" name="quality_requirements"   id="quality_requirements"  size=80 value="<?php echo $myrow["quality_requirement"]?>"></td>
</tr>

<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">Are all the relevant Standards in place and controlled?</p></font></td>
<td colspan=3><input type="text" name="controlled"  id="controlled"  size=80 value="<?php echo $myrow["controlled"]?>"></td>
</tr>

<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">Are documentation requirements clearly defined?</p></font></td>
<td colspan=3><input type="text" name="doc_req"  id="doc_req"  size=80 value="<?php echo $myrow["doc_req"]?>"></td>
</tr>

<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">Any Specific requirements on Documentation?</p></font></td>
<td colspan=3><input type="text" name="spec_req"  id="spec_req"  size=80 value="<?php echo $myrow["spec_req"]?>"></td>
</tr>

<tr bgcolor="#FFFFFF">
<td colspan=1><span class="labeltext"><p align="left"><u>Outsourcing</u></p></font></td>
<td colspan=3><span class="labeltext"><p align="left"></p></font></td>
</tr>

<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">Any activities needs to be outsourced?</p></font></td>
<td colspan=3><input type="text" name="outsourcing_activities"  id="outsourcing_activities"  size=80 value="<?php echo $myrow["outsourcing_activities"]?>"></td>
</tr>

<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">Has the customer agreed for Outsourcing of Activities?</p></font></td>
<td><input type="text" name="cust_agr"  id="cust_agr"  size=80 value="<?php echo $myrow["cust_agr"]?>"></td>
</tr>

<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">Are the planned Source approved by the customer?</p></font></td>
<td colspan=3><input type="text" name="app_cust"  id="app_cust"  size=80 value="<?php echo $myrow["app_cust"]?>"></td>
</tr>

<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">Mention the activities that needs to outsourced</p></font></td>
<td colspan=3><input type="text" name="act_out"  id="act_out"  size=80 value="<?php echo $myrow["act_out"]?>"></td>
</tr>

<tr bgcolor="#FFFFFF">
<td colspan=1><span class="labeltext"><p align="left"><u>Procurement</u></p></font></td>
<td colspan=3><span class="labeltext"><p align="left"></p></font></td>
</tr>

<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">Mention the Planned Source of Raw Material<br>for Manufacture</p></font></td>
<td colspan=3><input type="text" name="source_mfg"  id="source_mfg"  size=80 value="<?php echo $myrow["source_raw_material"]?>"></td>
</tr>

<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">Are any Boughtout Item or Consumables required</p></font></td>
<td colspan=3><input type="text" name="item_req"  id="item_req"  size=80 value="<?php echo $myrow["item_req"]?>"></td>
</tr>

<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">Is the planned Source for<br>Bought Out Item/Consumables approved?</p></font></td>
<td colspan=3><input type="text" name="item_app"  id="item_app"  size=80 value="<?php echo $myrow["item_app"]?>"></td>
</tr>

<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">Mention the Supplier name for<br>Bought Item/Consumables</p></font></td>
<td colspan=3><input type="text" name="sup_item"  id="sup_item"  size=80 value="<?php echo $myrow["sup_item"]?>"></td>
</tr>

<tr bgcolor="#FFFFFF">
<td colspan=1><span class="labeltext"><p align="left"><u>Delivery</u></p></font></td>
<td colspan=3><span class="labeltext"><p align="left"></p></font></td>
</tr>

<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">Are the delivery schedule clearly defined</p></font></td>
<td colspan=3><input type="text" name="delivery"  id="delivery"  size=80 value="<?php echo $myrow["delivery"]?>"></td>
</tr>

<tr bgcolor="#FFFFFF">
<td colspan=1><span class="labeltext"><p align="left"><u>Risks</u></p></font></td>
<td colspan=3><span class="labeltext"><p align="left"></p></font></td>
</tr>

<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">Do you foresee any risk to the requirement of this order.</p></font></td>
<td colspan=3><input type="text" name="risk"  id="risk"  size=80 value="<?php echo $myrow["risk"]?>"></td>
</tr>

<tr bgcolor="#FFFFFF">
<td colspan=1><span class="labeltext"><p align="left">Explain the Risk factores</p></font></td>
<td colspan=3><span class="labeltext"><p align="left"></p></font></td>
</tr>

<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">a)Resource(Manpower/Equipment)</p></font></td>
<td colspan=3><input type="text" name="resources"  id="resources"  size=80 value="<?php echo $myrow["resources"]?>"></td>
</tr>

<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">b)Work Environment</p></font></td>
<td colspan=3><input type="text" name="env"  id="env"  size=80 value="<?php echo $myrow["env"]?>"></td>
</tr>
<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">c)Others</p></font></td>
<td colspan=3><input type="text" name="others"  id="others"  size=80 value="<?php echo $myrow["others"]?>"></td>
</tr>
</table>
</table>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
<td colspan=13><span class="heading"><center><b>Line Items</b></center></td> </tr><tr >
<td bgcolor="#FFFFFF" colspan=12><span class="heading"><p>Please Enter Line # & Qty before GET CIM</p></td>
<tr>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
<tr bgcolor="#FFFFFF"><td colspan=18><a href="javascript:addRow('myTable',document.forms[0].maxrecnum.value)"><img name="Image7" border="0" src="images/bu-addrow.gif"></a></td></tr>
</table>
<div style="width:100%;overflow-x:scroll;">
<table id="myTable" width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable">
<tr>
<thead>
<th class="head0" width=3%><span class="heading"><b>Line</b></td>
<th class="head1" width=12%><span class="heading"><b>PRN</b></td>
<th class="head0" width=10%><span class="heading"><b> Assy Part#</b></td>
<th class="head1" width=13%><span class="heading"><b>Assy Description</b></td>
<th class="head0" width=10%><span class="heading"><b> Part#</b></td>
<th class="head1" width=13%><span class="heading"><b>Description</b></td>
<th class="head0" width=5%><span class="heading"><b>BOM Ref</b></td>
<th class="head1" width=5%><span class="heading"><b>BOM Iss</b></td>
<th class="head0" width=8%><span class="heading"><b>Part Iss</b></td>
<th class="head1" width=8%><span class="heading"><b>Cos Iss</b></td>
<th class="head0" width=8%><span class="heading"><b>Model Iss</b></td>
<th class="head1" width=8%><span class="heading"><b>Drg Iss</b></td>
<th class="head0" width=4%><span class="heading"><b>Qty</b></td>
<th class="head1" width=5%><span class="heading"><b>Unit Price</b></td>
<th class="head0" width=10%><span class="heading"><b>Total Price</b></td>
<?php
$fl = 0;  $childflag=0;
$result4bom = $newVend->getbom2Parts();
while($row=mysql_fetch_row($result4bom))
{
    if($fl == 0)
    {
      $bom_arr  = $row[1].'|'.$row[2].'|'.$row[3];
      $fl=1;
    }
    else
     $bom_arr .= '*'.$row[1].'|'.$row[2].'|'.$row[3];
}
$result = $newLI->getLI($recnum);
		$i=0;$flag=0;
		while($i<6)
		{
			if($flag==0)
			{
				while ($myLI = mysql_fetch_row($result))
	  	 		{
					//echo "i am inside inner while loop";


                    $linenumber="line_num" . $i;
                    $crn="crn" . $i;
                    $crn_check="crn_check" . $i;
                    $assy_partnum="assy_partnum" . $i;
                    $assy_desc="assy_desc" . $i;
                    $bom="bom" . $i;
                    $bomnum="bomnum" . $i;
                    $bom_iss="bom_iss" . $i;
                    $qty="qty" . $i;
                    $price="price" . $i;
                    $tot_price="tot_price" . $i;
                    $pcrn="pcrn".$i;
                    $prev_crn="prev_crn".$i;
                    
                    $prevlinenum="prev_line_num" . $i;
                    $lirecnum="lirecnum" . $i;
                    
                     $partnum="partnum" . $i;
                     $description="description" . $i ;
                     $part_iss="part_iss" . $i;
                     $cos_iss="cos_iss" . $i;
                     $model_iss="model_iss" . $i ;
                     $drg_iss="drg_iss" . $i ;

                    $m="m".$i;
                    $lnarr=split("-",$myLI[1]);
                    if($lnarr[1]!="")
                    {
                      $childflag=1;
                      //echo $childflag."---**---";
                    }else
                    {
                      $childflag=0;
                    }
                    echo "<input type=\"hidden\" name=\"$prevlinenum\" id=\"$prevlinenum\"  value=\"$myLI[1]\">";
					echo "<input type=\"hidden\" name=\"$lirecnum\"  value=\"$myLI[0]\">";
  					echo "<input type=\"hidden\" id=\"$prev_crn\" name=\"$prev_crn\" size=\"5%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"$myLI[2]\">";

                    				/*	echo "<td><span class=\"tabletext\"><input type=\"text\" id=\"$linenumber\"  name=\"$linenumber\"  value=\"$myLI[1]\" size=\"3%\"></td>";
                    echo "<td><input type=\"text\" id=\"$crn\" name=\"$crn\" size=\"8%\" readonly=\"readonly\" style=\"background-color:#DDDDDD;\" value=\"$myLI[2]\">";
                    echo "<img src=\"images/getcim.gif\" onclick=\"GetCrn4asyrevli('$i')\"></td>"; */
                    printf('<tr bgcolor="#FFFFFF">');
                    if($childflag==1)
                    {
   					echo "<input type=\"hidden\" id=\"$pcrn\" name=\"$pcrn\" size=\"5%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"$myLI[10]\">";
   					echo "<td><span class=\"tabletext\"><input type=\"text\" id=\"$linenumber\"  name=\"$linenumber\"  style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"$myLI[1]\" size=\"3%\"></td>";
                    echo "<td><input type=\"text\" id=\"$crn\" name=\"$crn\" size=\"10%\" readonly=\"readonly\" style=\"background-color:#DDDDDD;\" value=\"$myLI[2]\"></td>";
                    echo "<td><input type=\"text\" id=\"$assy_partnum\"  name=\"$assy_partnum\"  readonly=\"readonly\" style=\"background-color:#DDDDDD;\" size=\"22%\" value=\"$myLI[3]\"></td>";
					echo "<td><input type=\"text\" id=\"$assy_desc\" name=\"$assy_desc\" size=\"30%\" readonly=\"readonly\" style=\"background-color:#DDDDDD;\" value=\"$myLI[4]\"></td>";
                      echo "<td><input type=\"text\" id=\"$partnum\" name=\"$partnum\"  style=\"background-color:#DDDDDD;\" readonly=\"readonly\" size=\"22%\" value=\"$myLI[11]\"></td>";
                      echo "<td><input type=\"text\" id=\"$description\" name=\"$description\"   style=\"background-color:#DDDDDD;\" readonly=\"readonly\" size=\"30%\" value=\"$myLI[12]\"></td>";

                    ?>
                     <td><input type="text" id="<?php echo $bom ?>" name="<?php echo $bom ?>" readonly="readonly" style="background-color:#DDDDDD;" value="<?php echo $myLI[5] ?>"</td>
                   <?php
                	echo "<td><input type=\"text\" id=\"$bom_iss\" name=\"$bom_iss\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" size=\"10%\" value=\"$myLI[6]\"></td>";
                	echo "<td><input type=\"text\" id=\"$part_iss\" name=\"$part_iss\"  size=\"8%\" value=\"$myLI[13]\">";
   echo "<td><input type=\"text\" id=\"$cos_iss\" name=\"$cos_iss\"  size=\"8%\" value=\"$myLI[15]\"></td>";
   echo "<td><input type=\"text\" id=\"$model_iss\" name=\"$model_iss\"  size=\"8%\" value=\"$myLI[16]\">";
   echo "<td><input type=\"text\" id=\"$drg_iss\" name=\"$drg_iss\"  size=\"8%\" value=\"$myLI[14]\"></td>";
                    echo "<td><input type=\"text\" id=\"$qty\" name=\"$qty\"  size=\"5%\" readonly=\"readonly\" style=\"background-color:#DDDDDD;\" value='$myLI[7]'></td>";
                   	echo "<td><input type=\"text\" id=\"$price\" name=\"$price\"  size=\"6%\" readonly=\"readonly\" style=\"background-color:#DDDDDD;\" value=\"$myLI[8]\"></td>";
                    echo "<td><input type=\"text\" id=\"$tot_price\" name=\"$tot_price\" readonly=\"readonly\" style=\"background-color:#DDDDDD;\" size=\"8%\" value='$myLI[9]'></td>";

                    }else
                    {
                    echo "<input type=\"hidden\" id=\"$pcrn\" name=\"$pcrn\" size=\"5%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"$myLI[10]\">";
   					echo "<td><span class=\"tabletext\"><input type=\"text\" id=\"$linenumber\"  name=\"$linenumber\"  value=\"$myLI[1]\" size=\"3%\"></td>";
                    echo "<td><input type=\"text\" id=\"$crn\" name=\"$crn\" size=\"10%\" readonly=\"readonly\" style=\"background-color:#DDDDDD;\" value=\"$myLI[2]\">";
                    echo "<img src=\"images/bu-get.gif\" onclick=\"GetCrn4asyrevli('$i')\"></td>";

					echo "<td><input type=\"text\" id=\"$assy_partnum\"  name=\"$assy_partnum\"  readonly=\"readonly\" style=\"background-color:#DDDDDD;\" size=\"22%\" value=\"$myLI[3]\"></td>";
					echo "<td><input type=\"text\" id=\"$assy_desc\" name=\"$assy_desc\" size=\"30%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"$myLI[4]\"></td>";
                    echo "<td><input type=\"text\" id=\"$partnum\" name=\"$partnum\"  style=\"background-color:#DDDDDD;\" readonly=\"readonly\" size=\"22%\" value=\"$myLI[11]\"></td>";
                      echo "<td><input type=\"text\" id=\"$description\" name=\"$description\"   style=\"background-color:#DDDDDD;\" readonly=\"readonly\" size=\"30%\" value=\"$myLI[12]\"></td>";

                    ?>
                     <td><input type="text" id="<?php echo $bom ?>" name="<?php echo $bom ?>" readonly="readonly" style="background-color:#DDDDDD;" value="<?php echo $myLI[5] ?>"</td>
                   <?php
                	echo "<td><input type=\"text\" id=\"$bom_iss\" name=\"$bom_iss\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" size=\"10%\" value=\"$myLI[6]\"></td>";
                	echo "<td><input type=\"text\" id=\"$part_iss\" name=\"$part_iss\"  size=\"8%\" value=\"$myLI[13]\">";
                    echo "<td><input type=\"text\" id=\"$cos_iss\" name=\"$cos_iss\"  size=\"8%\" value=\"$myLI[15]\"></td>";
                    echo "<td><input type=\"text\" id=\"$model_iss\" name=\"$model_iss\"  size=\"8%\" value=\"$myLI[16]\">";
                    echo "<td><input type=\"text\" id=\"$drg_iss\" name=\"$drg_iss\"  size=\"8%\" value=\"$myLI[14]\"></td>";
                    echo "<td><input type=\"text\" id=\"$qty\" name=\"$qty\"  size=\"5%\" value='$myLI[7]'></td>";
                   	echo "<td><input type=\"text\" id=\"$price\" name=\"$price\"  size=\"6%\" value=\"$myLI[8]\"></td>";
                    echo "<td><input type=\"text\" id=\"$tot_price\" name=\"$tot_price\" readonly=\"readonly\" style=\"background-color:#DDDDDD;\" size=\"8%\" value='$myLI[9]'></td>";
                    }
                    echo "<input type=\"hidden\" id=\"$bomnum\" name=\"$bomnum\" readonly=\"readonly\" size=\"8%\" value=\"$myLI[5]\">";
                    echo "<input type=\"hidden\" id=\"$crn_check\" name=\"$crn_check\" size=\"8%\" value=\"$myLI[2]\">";
					printf('</tr>');
					$i++;
				}
				$flag=1;
			}
                        if ($i < 6) {
                    //echo "i am in outside while loop";


                    $linenumber="line_num" . $i;
                    $crn="crn" . $i;
                    $crn_check="crn_check" . $i;
                    $assy_partnum="assy_partnum" . $i;
                    $assy_desc="assy_desc" . $i;
                    $bom="bom" . $i;
                    $bomnum="bomnum" . $i;
                    $bom_iss="bom_iss" . $i;
                    $qty="qty" . $i;
                    $price="price" . $i;
                    $tot_price="tot_price" . $i;
                    $pcrn="pcrn".$i;
                    $prelinenum="prev_line_num" . $i;
	                $lirecnum="lirecnum" . $i;
	                $partnum="partnum" . $i;
                     $description="description" . $i ;
                     $part_iss="part_iss" . $i;
                     $cos_iss="cos_iss" . $i;
                     $model_iss="model_iss" . $i ;
                     $drg_iss="drg_iss" . $i ;
	                
	                echo "<input type=\"hidden\" name=\"$prelinenum\" value=\"\">";
			        echo "<input type=\"hidden\" name=\"$lirecnum\" value=\"\">";

                    printf('<tr bgcolor="#FFFFFF">');
   					echo "<input type=\"hidden\" id=\"$pcrn\" name=\"$pcrn\" size=\"5%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"$myLI[10]\">";
		            echo "<td ><span class=\"tabletext\"><input type=\"text\" name=\"$linenumber\"  id=\"$linenumber\" value=\"\" size=\"3%\"></td>";
                    echo "<td><input type=\"text\" id=\"$crn\" name=\"$crn\" size=\"10%\" readonly=\"readonly\" style=\"background-color:#DDDDDD;\" value=\"\"><img src=\"images/bu-get.gif\" onclick=\"GetCrn4asyrevli('$i')\"></td>";
					echo "<td><input type=\"text\" name=\"$assy_partnum\"  id=\"$assy_partnum\"  size=\"22%\" readonly=\"readonly\" style=\"background-color:#DDDDDD;\" value=\"\"></td>";
					echo "<td><input type=\"text\" name=\"$assy_desc\" id=\"$assy_desc\"  size=\"30%\" value=\"\"></td>";
					echo "<td><input type=\"text\" id=\"$partnum\" name=\"$partnum\"  style=\"background-color:#DDDDDD;\" readonly=\"readonly\" size=\"22%\" value=\"\"></td>";
                      echo "<td><input type=\"text\" id=\"$description\" name=\"$description\"   style=\"background-color:#DDDDDD;\" readonly=\"readonly\" size=\"30%\" value=\"\"></td>";

                   ?>
                     <td><input type="text" id="<?php echo $bom ?>" name="<?php echo $bom ?>" readonly="readonly" style="background-color:#DDDDDD;" value="<?php echo $myLI[5] ?>"</td>
                   <?php

					echo "<td><input type=\"text\" name=\"$bom_iss\"  id=\"$bom_iss\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" size=\"10%\"  value=\"\"></td>";
					echo "<td><input type=\"text\" id=\"$part_iss\" name=\"$part_iss\"  size=\"8%\" value=\"\">";
   echo "<td><input type=\"text\" id=\"$cos_iss\" name=\"$cos_iss\"  size=\"8%\" value=\"\"></td>";
   echo "<td><input type=\"text\" id=\"$model_iss\" name=\"$model_iss\"  size=\"8%\" value=\"\">";
   echo "<td><input type=\"text\" id=\"$drg_iss\" name=\"$drg_iss\"  size=\"8%\" value=\"\"></td>";
                    echo "<td><input type=\"text\" name=\"$qty\"   id=\"$qty\" size=\"5%\"  value=''></td>";
                    echo "<td><input type=\"text\" name=\"$price\"    id=\"$price\"  size=\"6%\" value=''></td>";
                    echo "<td><input type=\"text\" name=\"$tot_price\" id=\"$tot_price\" readonly=\"readonly\" style=\"background-color:#DDDDDD;\" size=\"8%\"  value=''></td>";
                    echo "<input type=\"hidden\" name=\"$bomnum\" id=\"$bomnum\" value=''>";
                    echo "<input type=\"hidden\" id=\"$crn_check\" name=\"$crn_check\" readonly=\"readonly\" size=\"8%\" value=\"\">";
			      printf('</tr>');
			      $i++;
		  }
        }
?>
<input type="hidden" name="maxrecnum" id="maxrecnum" value="<?php echo $i ?>">
<input type="hidden" name="recnum" value="<?echo $recnum?>"></td>
<input type="hidden" name="bom_details" id="bom_details" value="<?php echo $bom_arr?>">
<input type="hidden" name="page" id="page" value="edit">

</table>
</div>
<div id="subassy"></div>
</td>
</tr>
</table>
</td>
<!-- <td width="6"><img src="images/spacer.gif " width="6"></td>
</tr>
<tr bgcolor="DEDFDE">
<td width="6"><img src="images/box-left-bottom.gif"></td>
<td><img src="images/spacer.gif " height="6"></td>
<td width="6"><img src="images/box-right-bottom.gif"></td>
</tr> -->
</table>
<table border=0 cellpadding=0 cellspacing=0 width=100%>
<tr>
<td align=left>
</td>
</tr>
</table>
<span class="tabletext">
                  <input type="submit"
                     style="color=#0066CC;background-color:#DDDDDD;width=130;"
                     value="Submit" name="submit" onclick="javascript: return check_req_fields()">
                <INPUT TYPE="RESET"
                     style="color=#0066CC;background-color:#DDDDDD;width=130;"
                     VALUE="Reset" onclick="javascript: putfocus()">

</form>
</body>
</html>
