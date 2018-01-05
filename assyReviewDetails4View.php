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

$_SESSION['pagename'] = 'assyReviewDetails4View';
//////session_register('pagename');
//echo $_SESSION['pagename']."===---";
// First include the class definition
include('classes/assyReviewClass.php');
include('classes/assyReview_liClass.php');
include('classes/displayClass.php');
$newassyReview = new assyReview;
$newLI = new assyReview_li;
$newdisp = new display;
$dept=$_SESSION['department'];

$recnum=$_REQUEST['recnum'];
$result = $newassyReview->getassyReviewDetails($recnum);
$myrow=mysql_fetch_assoc($result);

if($myrow['po_date'] != '' && $myrow['po_date'] != '0000-00-00')
{
                 $datearr = split('-', $myrow['po_date']);
                 $d=$datearr[2];
                 $m=$datearr[1];
                 $y=$datearr[0];
                 $x=mktime(0,0,0,$m,$d,$y);
                 $po_date=date("M j, Y",$x);
}
else
{
                 $po_date = '';
}

if($myrow['review_date'] != '' && $myrow['review_date'] != '0000-00-00')
{
                 $datearr = split('-', $myrow['review_date']);
                 $d=$datearr[2];
                 $m=$datearr[1];
                 $y=$datearr[0];
                 $x=mktime(0,0,0,$m,$d,$y);
                 $review_date=date("M j, Y",$x);
}
else
{
                 $review_date = '';
}
if($myrow['amendment_date'] != '' && $myrow['amendment_date'] != '0000-00-00')
{
                 $datearr = split('-', $myrow['amendment_date']);
                 $d=$datearr[2];
                 $m=$datearr[1];
                 $y=$datearr[0];
                 $x=mktime(0,0,0,$m,$d,$y);
                 $amnd_date=date("M j, Y",$x);
}
else
{
                 $amnd_date = '';
}

?>

<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/assy_review.js"></script>

<html>
<head>
<title>Contract Review for Assembly Order Details</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">
<form action='assyReviewProcess.php' method='POST' enctype='multipart/form-data'>
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
<td width="6"><img src="images/spacer.gif " width="6"></td>
<td bgcolor="#FFFFFF">
<table width=100% border=0 cellpadding=6 cellspacing=0>
<tr><td>
<table width=100% border=0>
<tr>
<td><span class="pageheading"><b>Contract Review for Assembly Order</b></td>
 <td bgcolor="#FFFFFF"  align="right"><img src="images/bu-print.gif" value="Print" onclick="javascript: printAssyRevDetails4View(<?php echo $recnum ?>)">
<?php
//echo$dept;
if($dept == 'QAAPP' || $dept == 'ENGAPP')
{
?>
  <a href ="assyreviewedit4app.php?recnum=<?php echo $recnum ?>" ><img name="Image8" border="0" src="images/bu-edit.gif" ></a></td>

<?php
}
?>
</td>
</tr>
</table>

<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
<tr bgcolor="#FFFFFF">
<tr bgcolor="#EEEFEE"><td colspan=4><span class="heading"><center><b>General Information</b></center></td></tr>
<tr><td>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Assembly Review#</p></font></td>
<td><span class="tabletext"><?php echo $myrow["cust_ponum"]?></td>
<td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Customer</p></font></td>
<td><span class="tabletext"><?php echo $myrow["name"]?></td>
</tr>

<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>PO Date</p></font></td>
<td><span class="tabletext"><?php echo $po_date?></td>
<td><span class="labeltext"><p align="left">PO Line Item</p></font></td>
<td><span class="tabletext"><?php echo $myrow["poline"]?></td>
</tr>

<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">Contact</p></font></td>
<td><span class="tabletext"><?php echo $myrow["contact"]?></td>
<td><span class="labeltext"><p align="left">Email</p></font></td>
<td><span class="tabletext"><?php echo $myrow["email"]?></td>
</tr>

<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">Order For</p></font></td>
<td><span class="tabletext"><?php echo $myrow["order_for"]?></td>
<td><span class="labeltext"><p align="left">Order Type</p></font></td>
<td><span class="tabletext"><?php echo $myrow["ord_type"]?></td>
</tr>

<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">Ammendment No</p></td>
<td><span class="tabletext"><?php echo $myrow["amendment_num"]?></td>
<td><span class="labeltext"><p align="left">Ammendment Date</p></font></td>
<td><span class="tabletext"><?php echo $amnd_date?></td>
</tr>

<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">Review Ref</p></font></td>
<td><span class="tabletext"><?php echo $myrow["review_ref"]?></td>
<td><span class="labeltext"><p align="left">Review Date</p></font></td>
<td><span class="tabletext"><?php echo $review_date ?></td>
</tr>

<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">Quote Ref</p></font></td>
<td><span class="tabletext"><?php echo $myrow["quote_ref"]?></td>
<td><span class="labeltext"><p align="left">Agreements</p></font></td>
<td><span class="tabletext"><?php echo $myrow["agreement"]?></td>
</tr>
<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">Status</p></font></td>
<td colspan=3><span class="tabletext"><?php echo $myrow["status"]?></td>
</tr>
<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">Project</p></font></td>
<td><span class="tabletext"><?php echo $myrow["project"]?></td>
<td><span class="labeltext">Special Instruction</font></td>
            <td><textarea name="special_instruction" rows="6"
			      style="background-color:#DDDDDD;"
                    readonly="readonly"
			      cols="45"><?php echo $myrow["special_instruction"] ?></textarea></td>
</tr>
<?php
            $checked="checked";
        ?>
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext">Engineering Approved</td>
            <td><span class="tabletext"><input type="checkbox" <?php echo $myrow["engineering_approved"] == 'yes'?$checked:"" ?> name="engineering_approved" disabled onClick="return readOnlyCheckBox()"/></td>
            <td><span class="labeltext">QA Approved</font></td>
            <td><span class="tabletext"><input type="checkbox"  <?php echo $myrow["qa_approved"] == 'yes'?$checked:"" ?>  name="qa_approved" disabled onClick="return readOnlyCheckBox()" /></td>
        </tr>
         <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Engg Approved By</p></font></td>
            <td><span class="tabletext"><?php echo $myrow["engg_app_by"] ?></td>
            <td><span class="labeltext">QA Approved By</td>
           <td><span class="tabletext"><?php echo $myrow["qa_app_by" ] ?></td>
        </tr>
        <!-- <tr bgcolor="#FFFFFF">
            <td><span class="labeltext">Validation Status</font></td>
            <td bgcolor="#00FF00"><span class="tabletext"><?php echo $myrow["val_status"] ?></td>
            <td colspan=2>&nbsp;</td>
         </tr>  -->

</table>
</td></tr>
<tr><td>

<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
<tr bgcolor="#FFFFFF">
<td width=50%><span class="labeltext"><p align="left"><u>Quality Requirements</u></p></font></td>
<td width=50%><span class="labeltext"><p align="left"></p></font></td>
</tr>

<tr bgcolor="#FFFFFF">
<td width=50%><span class="labeltext"><p align="left">Are the Technical requirements clear?</p></font></td>
<td width=50%><span class="tabletext"><?php echo wordwrap($myrow["technical_requirement"], 100, "</br>",true);?></td>
</tr>

<tr bgcolor="#FFFFFF">
<td width=50%><span class="labeltext"><p align="left">Are the quality requirements with regards to Traceablity,NDT,<br>secondary processes assembly,preservation and packing clear?</p></font></td>
<td width=50%><span class="tabletext"><?php echo wordwrap($myrow["quality_requirement"], 100, "</br>",true);?></td>
</tr>

<tr bgcolor="#FFFFFF">
<td width=50%><span class="labeltext"><p align="left">Are all the relevant Standards in place and controlled?</p></font></td>
<td width=50%><span class="tabletext"><?php echo wordwrap($myrow["controlled"], 100, "</br>",true);?></td>
</tr>

<tr bgcolor="#FFFFFF">
<td width=50%><span class="labeltext"><p align="left">Are documentation requirements clearly defined?</p></font></td>
<td width=50%><span class="tabletext"><?php echo wordwrap($myrow["doc_req"], 100, "</br>",true);?></td>
</tr>
<tr bgcolor="#FFFFFF">
<td width=50%><span class="labeltext"><p align="left">Any Specific requirements on Documentation?</p></font></td>
<td width=50%><span class="tabletext"><?php echo wordwrap($myrow["spec_req"], 100, "</br>",true);?></td>
</tr>

<tr bgcolor="#FFFFFF">
<td width=50%><span class="labeltext"><p align="left"><u>Outsourcing</u></p></font></td>
<td width=50%><span class="labeltext"><p align="left"></p></font></td>
</tr>

<tr bgcolor="#FFFFFF">
<td width=50%><span class="labeltext"><p align="left">Any activities needs to be outsourced?</p></font></td>
<td width=50%><span class="tabletext"><?php echo wordwrap($myrow["outsourcing_activities"], 100, "</br>",true);?></td>
</tr>

<tr bgcolor="#FFFFFF">
<td width=50%><span class="labeltext"><p align="left">Has the customer agreed for Outsourcing of Activities?</p></font></td>
<td width=50%><span class="tabletext"><?php echo wordwrap($myrow["cust_agr"], 100, "</br>",true);?></td>
</tr>

<tr bgcolor="#FFFFFF">
<td width=50%><span class="labeltext"><p align="left">Are the planned Source approved by the customer?</p></font></td>
<td width=50%><span class="tabletext"><?php echo wordwrap($myrow["app_cust"], 100, "</br>",true);?></td>
</tr>

<tr bgcolor="#FFFFFF">
<td width=50%><span class="labeltext"><p align="left">Mention the activities that needs to outsourced</p></font></td>
<td width=50%><span class="tabletext"><?php echo wordwrap($myrow["act_out"], 100, "</br>",true);?></td>
</tr>

<tr bgcolor="#FFFFFF">
<td width=50%><span class="labeltext"><p align="left"><u>Procurement</u></p></font></td>
<td width=50%><span class="labeltext"><p align="left"></p></font></td>
</tr>

<tr bgcolor="#FFFFFF">
<td width=50%><span class="labeltext"><p align="left">Mention the Planned Source of Raw Material<br>for Manufacture</p></font></td>
<td width=50%><span class="tabletext"><?php echo wordwrap($myrow["source_raw_material"], 100, "</br>",true);?></td>
</tr>

<tr bgcolor="#FFFFFF">
<td width=50%><span class="labeltext"><p align="left">Are any Boughtout Item or Consumables required</p></font></td>
<td width=50%><span class="tabletext"><?php echo wordwrap($myrow["item_req"], 100, "</br>",true);?></td>
</tr>

<tr bgcolor="#FFFFFF">
<td width=50%><span class="labeltext"><p align="left">Is the planned Source for<br>Bought Out Item/Consumables approved?</p></font></td>
<td width=50%><span class="tabletext"><?php echo wordwrap($myrow["item_app"], 100, "</br>",true);?></td>
</tr>

<tr bgcolor="#FFFFFF">
<td width=50%><span class="labeltext"><p align="left">Mention the Supplier name for<br>Bought Item/Consumables</p></font></td>
<td width=50%><span class="tabletext"><?php echo wordwrap($myrow["sup_item"], 100, "</br>",true);?></td>
</tr>

<tr bgcolor="#FFFFFF">
<td width=50%><span class="labeltext"><p align="left"><u>Delivery</u></p></font></td>
<td width=50%><span class="tabletext"></td>
</tr>

<tr bgcolor="#FFFFFF">
<td width=50%><span class="labeltext"><p align="left">Are the delivery schedule clearly defined</p></font></td>
<td width=50%><span class="tabletext"><?php echo wordwrap($myrow["delivery"], 100, "</br>",true);?></td>

<tr bgcolor="#FFFFFF">
<td width=50%><span class="labeltext"><p align="left"><u>Risks</u></p></font></td>
<td width=50%><span class="labeltext"><p align="left"></p></font></td>
</tr>

<tr bgcolor="#FFFFFF">
<td width=50%><span class="labeltext"><p align="left">Do you foresee any risk to the requirement of this order.</p></font></td>
<td width=50%><span class="tabletext"><?php echo wordwrap($myrow["risk"], 100, "</br>",true);?></td>
</tr>

<tr bgcolor="#FFFFFF">
<td width=50%><span class="labeltext"><p align="left">Explain the Risk factors</p></font></td>
<td width=50%><span class="labeltext"><p align="left"></p></font></td>
</tr>

<tr bgcolor="#FFFFFF">
<td width=50%><span class="labeltext"><p align="left">a)Resource(Manpower/Equipment)</p></font></td>
<td width=50%><span class="tabletext"><?php echo wordwrap($myrow["resources"], 100, "</br>",true);?></td>
</tr>

<tr bgcolor="#FFFFFF">
<td width=50%><span class="labeltext"><p align="left">b)Work Environment</p></font></td>
<td width=50%><span class="tabletext"><?php echo wordwrap($myrow["env"], 100, "</br>",true);?></td>
</tr>
<tr bgcolor="#FFFFFF">
<td width=50%><span class="labeltext"><p align="left">c)Others</p></font></td>
<td width=50%><span class="tabletext"><?php echo wordwrap($myrow["others"], 100, "</br>",true);?></td>
</tr>
</table>

<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
<tr bgcolor="#DDDEDD">
<td colspan=15><span class="heading"><center><b>Line Items</b></center></td>
</tr>
       <tr>
            <td bgcolor="#EEEFEE" width=3%><span class="heading"><b>Line Item</b></td>
            <td bgcolor="#EEEFEE" width=6%><span class="heading"><b>PRN</b></td>
            <td bgcolor="#EEEFEE" width=8%><span class="heading"><b>Assembly Part#</b></td>
            <td bgcolor="#EEEFEE" width=6%><span class="heading"><b>Assembly Desc</b></td>
            <td bgcolor="#EEEFEE" width=6%><span class="heading"><b>BOM Ref</b></td>
            <td bgcolor="#EEEFEE" width=6%><span class="heading"><b>BOM Iss</b></td>
			<td bgcolor="#EEEFEE" width=6%><span class="heading"><b>Part Desc</b></td>
            <td bgcolor="#EEEFEE" width=6%><span class="heading"><b>Part #</b></td>
            <td bgcolor="#EEEFEE" width=6%><span class="heading"><b>Drg Iss</b></td>
            <td bgcolor="#EEEFEE" width=6%><span class="heading"><b>Part Iss</b></td>
            <td bgcolor="#EEEFEE" width=6%><span class="heading"><b>COS Iss</b></td>
            <td bgcolor="#EEEFEE" width=6%><span class="heading"><b>Qty</b></td>
       </tr>

<?php
        $result = $newLI->getLI($recnum);
		$flag = 0;
        while ($myLI = mysql_fetch_assoc($result)) {


            $line_num = $myLI["line_num"];
            $crn = $myLI["crn"];
            $asy_partnum = $myLI["assy_partnum"];
            $assy_desc = $myLI["assy_desc"];
            //echo'seccP='.$secpartNum;
            $bomref = $myLI["bomref"];
            $bomiss = $myLI["bomiss"];
            $qty = $myLI["qty"];
            $unit_price = $myLI["unit_price"];
            $Price = $unit_price*$qty;
            $partnum = $myLI["part_num"];
			$description = $myLI["description"];
            $partiss = $myLI["pi_attachments"];
            $drgiss = $myLI["drg_iss"];
            $cos = $myLI["cos_iss"];

	         echo"<tr><td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$line_num</td>" ;
			 $split4assy = split("-",$crn);
			 $checkifcrn = substr($crn,2,1);
             $chk4assy = substr($split4assy[0],2,1);
			 $linenumarr = split("-",$line_num);
			 if ($prevlinenumarr[0] != $linenumarr[0] && $chk4assy == 'A' && $flag == 0)
			 {
			    echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$crn</td>";
                echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$asy_partnum</td>";
                echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$assy_desc</td>";
                echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$bomref</td>";
                echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$bomiss</td>";
				echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">&nbsp</td>";
	            echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$partnum</td>";
                echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$partiss</td>";
                echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$drgiss</td>";
                echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$cos</td>";
                echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$qty</td>";
                $prevlinenumarr = split("-",$line_num);
			 }
			 else if ($crn != $prevcrn && $prevlinenumarr[0] != $linenumarr[0] && $chk4assy == 'A' && $flag == 1)
			 {
			    echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$crn</td>";
                echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$asy_partnum</td>";
                echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$assy_desc</td>";
                echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$bomref</td>";
                echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$bomiss</td>";
				echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$description</td>";
                echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$partnum</td>";
                echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$partiss</td>";
                echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$drgiss</td>";
                echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$cos</td>";
                echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$qty</td>";
			    $prevcrn = $crn;
				$prevlinenumarr = split("-",$line_num);
			 }
	
			 else if ($crn != $prevcrn && $prevlinenumarr[0] == $linenumarr[0] && $chk4assy == 'A' && $flag == 1)
			 {
			    echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$crn</td>";
                echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$partnum</td>";
                echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$description</td>";
                echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$bomref</td>";
                echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$bomiss</td>";
				echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">&nbsp</td>";
                echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">&nbsp</td>";
                echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$partiss</td>";
                echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$drgiss</td>";
                echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$cos</td>";
                echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$qty</td>";
				$prevlinenumarr = split("-",$line_num);
				$prevcrn = $crn;
			 }

			 else if ($checkifcrn == '-'  && $flag == 1)
			 {
                echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$crn</td>";
                echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">&nbsp</td>";
                echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">&nbsp</td>";
                echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">&nbsp</td>";
                echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">&nbsp</td>";
			    echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$description</td>";
                echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$partnum</td>";
                echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$partiss</td>";
                echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$drgiss</td>";
                echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$cos</td>";
                echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$qty</td>";

			 }
		     else 
			 {
                echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">&nbsp</td>";
                echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">&nbsp</td>";
                echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">&nbsp</td>";
                echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">&nbsp</td>";
                echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">&nbsp</td>";
			    echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$description</td>";
                echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$partnum</td>";
                echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$partiss</td>";
                echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$drgiss</td>";
                echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$cos</td>";
                echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$qty</td>";

			 }

             $flag = 1;
        }
?>

</table>
</table>
<input type="hidden" name="page" value="details">
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
<table border=0 cellpadding=0 cellspacing=0 width=100%>
<tr>
<td align=left>
</td>
</tr>
</table>


</FORM>
</body>
</html>
