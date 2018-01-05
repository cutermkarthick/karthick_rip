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

$_SESSION['pagename'] = 'assyReviewDetails';
$page= "CRM: Assy Review";
//////session_register('pagename');

// First include the class definition
include('classes/assyReviewClass.php');
include('classes/assyReview_liClass.php');
include('classes/displayClass.php');
include('classes/valpartClass.php');

$newassyReview = new assyReview;
$newLI = new assyReview_li;
$newdisp = new display;
$newvalpart = new valpart;

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
<form action='assyReviewProcess.php' method='GET' enctype='multipart/form-data'>
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





<td colspan=3><span class="pageheading"><b>Contract Review for Assembly Order</b></td>

<input type="button" class="stdbtn btn_blue" style="float:right;padding:2px;margin-right:2px;"  onClick="javascript: printAssyRevDetails(<?php echo $recnum ?>)" value="Print" >
<!--  <td bgcolor="#FFFFFF"  style="align:right"><img src="images/bu-print.gif" value="Print" onclick="javascript: printAssyRevDetails(<?php echo $recnum ?>)"> -->


  <input type="button" class="stdbtn btn_blue" style="float:right;padding:2px;margin-right:2px;"  onClick="location.href='assyReviewEdit.php?recnum=<?php echo $recnum ?>'" value="Edit" >
<!--  <a href ="assyReviewEdit.php?recnum=<?php echo $recnum ?>" ><img name="Image8" border="0" src="images/bu-edit.gif" ></a></td> -->
</tr>
</table>

<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1">
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
<td bgcolor="#00FF00"><span class="tabletext"><?php echo $myrow["status"]?></td>
            <td><span class="labeltext">Validation Status</font></td>
            <td bgcolor="#00FF00"><span class="tabletext"><?php echo $myrow["val_status"] ?></td>
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
<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">Project</p></font></td>
<td><span class="tabletext"><?php echo $myrow["project"]?></td>
<td><span class="labeltext">Special Instruction</font></td>
            <td><textarea name="special_instruction" rows="6"
			      style="background-color:#DDDDDD;"
                    readonly="readonly"
			      cols="45"><?php echo $myrow["special_instruction"] ?></textarea></td>
</tr>

</table>
</td></tr>
<tr><td>

<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1">
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
<td width=50%><span class="labeltext"><p align="left">Explain the Risk factores</p></font></td>
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

<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable">
<tr bgcolor="#DDDEDD">
<td colspan=15><span class="heading"><center><b>Line Items</b></center></td>
</tr>
       <tr>
<td bgcolor="#EEEFEE" width=3%><span class="heading"><b>Line</b></td>
<td bgcolor="#EEEFEE" ><span class="heading"><b>PRN</b></td>
<td bgcolor="#EEEFEE" ><span class="heading"><b> Assy Part#</b></td>
<td bgcolor="#EEEFEE" ><span class="heading"><b>Assy Description</b></td>
<td bgcolor="#EEEFEE" ><span class="heading"><b> Part#</b></td>
<td bgcolor="#EEEFEE" ><span class="heading"><b>Description</b></td>
<td bgcolor="#EEEFEE" ><span class="heading"><b>BOM Ref</b></td>
<td bgcolor="#EEEFEE" ><span class="heading"><b>BOM Iss</b></td>
<td bgcolor="#EEEFEE" ><span class="heading"><b>Part Iss</b></td>
<td bgcolor="#EEEFEE" ><span class="heading"><b>Cos Iss</b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b>Model Iss</b></td>
<td bgcolor="#EEEFEE" ><span class="heading"><b>Drg Iss</b></td>
<td bgcolor="#EEEFEE" ><span class="heading"><b>Qty</b></td>
<td bgcolor="#EEEFEE" ><span class="heading"><b>Unit Price</b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b>Total Price</b></td>
       </tr>

<?php
 $partstr = $myrow["customer"];
 // echo $partstr."-----<br>";
        $result = $newLI->getLI($recnum);
        while ($myLI = mysql_fetch_assoc($result)) {


            //echo "$date";
            $line_num = $myLI["line_num"];
            $crn = $myLI["crn"];
            $asy_partnum = $myLI["assy_partnum"];
            $assy_desc = $myLI["assy_desc"];
            //echo'seccP='.$secpartNum;
            $bomref = $myLI["bomref"];
            $bomiss = $myLI["bomiss"];
            $qty = $myLI["qty"];
            $partnum = $myLI["part_num"];
            $description = $myLI["description"];
             $part_iss = $myLI["pi_attachments"];
             $cos_iss = $myLI["cos_iss"];
              $model_iss = $myLI["model_iss"];
               $drg_iss = $myLI["drg_iss"];
            $unit_price = number_format($myLI["unit_price"],2);
            $Price = number_format(($unit_price*$qty),2);

	         echo"<tr><td bgcolor=\"#FFFFFF\" align=\"center\"><span class=\"tabletext\">$line_num</td>" ;
             echo"<td bgcolor=\"#FFFFFF\" align=\"center\"><span class=\"tabletext\">$crn</td>";
             echo"<td bgcolor=\"#FFFFFF\" align=\"center\"><span class=\"tabletext\">$asy_partnum</td>";
             echo"<td bgcolor=\"#FFFFFF\" align=\"center\"><span class=\"tabletext\">$assy_desc</td>";
             echo"<td bgcolor=\"#FFFFFF\" align=\"center\"><span class=\"tabletext\">$partnum</td>";
             echo"<td bgcolor=\"#FFFFFF\" align=\"center\"><span class=\"tabletext\">$description</td>";
             echo"<td bgcolor=\"#FFFFFF\" align=\"center\"><span class=\"tabletext\">$bomref</td>";
             echo"<td bgcolor=\"#FFFFFF\" align=\"center\"><span class=\"tabletext\">$bomiss</td>";
             echo"<td bgcolor=\"#FFFFFF\" align=\"center\"><span class=\"tabletext\">$part_iss</td>";
             echo"<td bgcolor=\"#FFFFFF\" align=\"center\"><span class=\"tabletext\">$cos_iss</td>";
             echo"<td bgcolor=\"#FFFFFF\" align=\"center\"><span class=\"tabletext\">$model_iss</td>";
             echo"<td bgcolor=\"#FFFFFF\" align=\"center\"><span class=\"tabletext\">$drg_iss</td>";
             echo"<td bgcolor=\"#FFFFFF\" align=\"center\"><span class=\"tabletext\">$qty</td>";
             echo"<td bgcolor=\"#FFFFFF\" align=\"center\"><span class=\"tabletext\">$unit_price</td>";
             echo"<td bgcolor=\"#FFFFFF\" align=\"center\"><span class=\"tabletext\">$Price</td>";
             
             $partstr = $partstr.'|'.$crn;
             //$partstr = $partstr.';'.$gf;
             //$partstr = $partstr.';'.$maxruling;
             //$partstr = $partstr.';'.$altspec;
             $partstr = $partstr.';'.$drg_iss;
             $partstr = $partstr.';'.$part_iss;
             $partstr = $partstr.';'.$cos_iss;
             $partstr = $partstr.';'.$model_iss;
        }
?>

</table>
<?php
  if($myrow["val_status"] == 'NO')
  {
   //$partstr = $_SESSION['partstr'];
   //echo $partstr;
   echo '<span class="heading"><center><b>Part Number Validation<b></center>';
   //$result = $newreport->get_mccost($mcname,$cond);
   echo "<div style=\"width:1200px;height:200px;overflow:auto;\">";
   echo "<table id=\"$tblid\" width=100% border=1 cellpadding=3 cellspacing=1 bgcolor=\"#DFDEDF\">";
   echo '<tr>
            <td bgcolor="#FFFFFF" width=20%><span class="heading"><b>Cust PO <br>Number</b></td>
            <td bgcolor="#FFFFFF" width=20%><span class="heading"><b>Cust PO<br>Date</b></td>
            <td bgcolor="#FFFFFF" width=20%><span class="heading"><b>Line Num</b></td>
            <td bgcolor="#FFFFFF" width=20%><span class="heading"><b>PRN</b></td>
            <td bgcolor="#FFFFFF" width=20%><span class="heading"><b>Drg Iss</b></td>
            <td bgcolor="#FFFFFF" width=20%><span class="heading"><b>Part<br>Iss/Attach</b></td>
            <td bgcolor="#FFFFFF" width=20%><span class="heading"><b>COS<br>Issue</b></td>
            <td bgcolor="#FFFFFF" width=20%><span class="heading"><b>Model<br>Issue</b></td>
        </tr>';
        // echo $partstr."----";
         $partarr1 = split("\|" ,$partstr,2);
         $cname = $partarr1[0];
         //echo $cname;
         $partarr = split("\|" ,$partarr1[1]);
         //echo $cname;
         //print_r($partarr);
         $partcount=count($partarr);
         //echo $partcount;
         for($i=0;$i<$partcount;$i++)
         {
            $curpartarr = split(";" ,$partarr[$i]);
            //print_r($curpartarr);
            $curpartcount = count($curpartarr);
            $cur_crnnum = $curpartarr[0];
            $j=1;
            //echo $cur_crnnum;
           // $gf = $curpartarr[$j++];
            //echo $gf;
           // $mr = $curpartarr[$j++];
            //echo $mr;
            //$altspec = $curpartarr[$j++];
            $drgiss = $curpartarr[$j++];
            $partiss = $curpartarr[$j++];
            $cosiss = $curpartarr[$j++];
            $modiss = $curpartarr[$j++];
            $ln = $curpartarr[$j++];
            //echo $modiss;
           $partfound = 0;
           $res_crnnum = $newvalpart->getpartnum_details4newassyorder($cname,$cur_crnnum);
           while ($myrow1 = mysql_fetch_row($res_crnnum)) {
           if($myrow1[1] == $cur_crnnum)
           {  //  echo $myrow1[2]."---d---";
            echo "<tr>";
            echo "<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$myrow1[11]</td>";
            if($myrow1[2] != '' && $myrow1[2] != '0000-00-00')
               {
                 $datearr = split('-', $myrow1[2]);
                 $d=$datearr[2];
                 $m=$datearr[1];
                 $y=$datearr[0];
                 $x=mktime(0,0,0,$m,$d,$y);
                 $orddate=date("M j, Y",$x);
               }
               else
               {
                 $orddate = '';
               }
            echo "<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$orddate</td>";
            echo "<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$myrow1[10]</td>";
            echo "<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$myrow1[1](prev)</td>";
            //echo "<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$myrow1[3]</td>";
           // echo "<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$myrow1[4]</td>";
           // echo "<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$myrow1[5]</td>";
            echo "<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$myrow1[6]</td>";
            echo "<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$myrow1[7]</td>";
            echo "<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$myrow1[8]</td>";
            echo "<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$myrow1[9]</td>";
            echo "</tr>";
            echo "<tr>";
            echo "<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">&nbsp</td>";
            echo "<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">&nbsp</td>";
            echo "<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$ln</td>";
            echo "<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$cur_crnnum (cur)</td>";
            //if($myrow1[3] == $gf)
             // echo "<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$gf</td>";
            //else
             // echo "<td bgcolor=\"#FF0000\"><span class=\"tabletext\">$gf</td>";
           // if($myrow1[4] == $mr)
             // echo "<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$mr</td>";
            //else
             // echo "<td bgcolor=\"#FF0000\"><span class=\"tabletext\">$mr</td>";
            //if($myrow1[5] == $altspec)
             // echo "<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$altspec</td>";
            //else
              //echo "<td bgcolor=\"#FF0000\"><span class=\"tabletext\">$altspec</td>";
            if($myrow1[6] == $drgiss)
              echo "<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$drgiss</td>";
            else
              echo "<td bgcolor=\"#FF0000\"><span class=\"tabletext\">$drgiss</td>";
            if($myrow1[7] == $partiss)
              echo "<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$partiss</td>";
            else
              echo "<td bgcolor=\"#FF0000\"><span class=\"tabletext\">$partiss</td>";
            if($myrow1[8] == $cosiss)
              echo "<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$cosiss</td>";
            else
              echo "<td bgcolor=\"#FF0000\"><span class=\"tabletext\">$cosiss</td>";
            if($myrow1[9] == $modiss)
              echo "<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$modiss</td>";
            else
              echo "<td bgcolor=\"#FF0000\"><span class=\"tabletext\">$modiss</td>";
            echo "</tr>";
            $partfound = 1;
           }
          }
          if($partfound != 1)
           {
            echo "<tr>";
            echo "<td colspan=11 bgcolor=\"#FFFFFF\"><span class=\"tabletext\">No Previous Part</td>";
            echo "</tr>";
            echo "<tr>";
            echo "<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">&nbsp</td>";
            echo "<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">&nbsp</td>";
            echo "<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$ln</td>";
            echo "<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$cur_crnnum (cur)</td>";
            //echo "<td bgcolor=\"#FF0000\"><span class=\"tabletext\">$gf</td>";
            //echo "<td bgcolor=\"#FF0000\"><span class=\"tabletext\">$mr</td>";
           // echo "<td bgcolor=\"#FF0000\"><span class=\"tabletext\">$altspec</td>";
            echo "<td bgcolor=\"#FF0000\"><span class=\"tabletext\">$drgiss</td>";
            echo "<td bgcolor=\"#FF0000\"><span class=\"tabletext\">$partiss</td>";
            echo "<td bgcolor=\"#FF0000\"><span class=\"tabletext\">$cosiss</td>";
            echo "<td bgcolor=\"#FF0000\"><span class=\"tabletext\">$modiss</td>";
            echo "</tr>";
           }
         }
         echo '</table>';
         echo '</div>';
      }
?>
</table>
<input type="hidden" name="page" value="details">
<input type="hidden" name="recnum" value="<?php echo $recnum ?>">
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
<?php
if($myrow["val_status"] == 'NO')
{
?>
		<span class="tabletext"><input type="submit"
      style="color=#0066CC;background-color:#DDDDDD;width=130;"
      value="Validate" name="submit">
<?php
}
?>
<table border=0 cellpadding=0 cellspacing=0 width=100%>
<tr>
<td align=left>
</td>
</tr>
</table>


</FORM>
</body>
</html>
