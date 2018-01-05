<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = april 03, 2007               =
// Filename: reviewDetails.php                 =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 WMS                          =
// Review Details                              =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: ../login.php" );

}
$userid = $_SESSION['user'];

$_SESSION['pagename'] = 'reviewDetails';
//////session_register('pagename');

// First include the class definition

include('classes/reviewClass.php');
include('classes/review_liClass.php');
include('classes/displayClass.php');
include('classes/valpartClass.php');

$newlogin = new userlogin;
$newlogin->dbconnect();
$userid = $_SESSION['user'];

$newreview = new review;
$LI = new review_li;
$newdisplay = new display;
$newvalpart = new valpart;

$reviewrecnum = $_REQUEST['reviewrecnum'];
//echo 'rec='.$reviewrecnum;

$result = $newreview->getreview($reviewrecnum);
$myLI = $LI->getLI($reviewrecnum);
//$result4notes = $newreview->getNotes($reviewrecnum);
//$mynotes = mysql_fetch_row($result4notes);
$myrow = mysql_fetch_assoc($result);
      if($myrow['order_date'] != '0000-00-00' && $myrow['order_date'] != '' && $myrow['order_date'] != 'NULL')
      {
              $datearr = split('-', $myrow['order_date']);
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
	  if($myrow['quote_date'] != '0000-00-00' && $myrow['quote_date'] != '' && $myrow['quote_date'] != 'NULL')
      {
              $datearr = split('-', $myrow['quote_date']);
              $d=$datearr[2];
              $m=$datearr[1];
              $y=$datearr[0];
       $x=mktime(0,0,0,$m,$d,$y);
       $quotedate=date("M j, Y",$x);
      }
      else
      {
        $quotedate = '';
      }
	  if($myrow['amendment_date'] != '0000-00-00' && $myrow['amendment_date'] != '' && $myrow['amendment_date'] != 'NULL')
      {
              $datearr = split('-', $myrow['amendment_date']);
              $d=$datearr[2];
              $m=$datearr[1];
              $y=$datearr[0];
       $x=mktime(0,0,0,$m,$d,$y);
       $amenddate=date("M j, Y",$x);
      }
      else
      {
        $amenddate = '';
      }
      if($myrow['create_date'] != '0000-00-00' && $myrow['create_date'] != '' && $myrow['create_date'] != 'NULL')
      {
              $datearr = split('-', $myrow['create_date']);
              $d=$datearr[2];
              $m=$datearr[1];
              $y=$datearr[0];
       $x=mktime(0,0,0,$m,$d,$y);
       $date1=date("M j, Y",$x);
      }
      else
      {
        $date1 = '';
      }

?>

<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/review.js"></script>
<html>
<head>
<title>Review Order Stage Details</title>
</head>
<script language="javascript">
function readOnlyCheckBox()
{
   return false;
}
</script>
<body leftmargin="0"topmargin="0" marginwidth="0">
<form action='processReview.php' method='post' enctype='multipart/form-data'>
<?php
include('header.html');
?>
<table width=100% cellspacing="0" cellpadding="6" border="0">
<tr><td>
<table width=100% border=0 cellspacing="0" cellpadding="0">
       <tr>
          <td><span class="welcome"><b>Welcome <?php echo $userid?></b></td>
          <td align="right">&nbsp;
          <a href="exit.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image16','','images/logout_mo.gif',1)"><img name="Image16" border="0" src="images/logout.gif"></a></td>
       </tr>
</table>
<table width=100% border=0 cellpadding=0 cellspacing=0>
<tr><td>
</td></tr>
<tr>
<td>

<?php  $newdisplay->dispLinks(''); ?>

</td></tr>
</table>
<table width=100% border=0 cellpadding=0 cellspacing=0>
<tr bgcolor="DEDFDE">
<td width="6"><img src="images/spacer.gif " width="6"></td>
<td bgcolor="#FFFFFF">
<table width=100% border=0 cellspacing="1" cellpadding="6">
<tr>
<td><span class="pageheading"><b>Contract Review Order Stage Details</b><td colspan=250></td>
    <td bgcolor="#FFFFFF" rowspan=2 align="right">
          <a href ="copy_review.php?reviewrecnum=<?php echo $reviewrecnum ?>"><img name="Image8" border="0" src="images/bu_copy.gif" ></a>
          <a href ="edit_review.php?reviewrecnum=<?php echo $reviewrecnum ?>"><img name="Image8" border="0" src="images/bu_editreview.gif" ></a>
          <input type= "image" name="Print" src="images/bu-print.gif" value="Print" onclick="javascript: printreviewDetails(<?php echo $reviewrecnum ?>)">
</td>
  </tr>

<table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=6>


 <table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">

        <tr bgcolor="#FFFFFF">
            <td colspan=2><span class="labeltext"><p align="left">Ref No.</p></font></td>
            <td colspan=2><span class="tabletext"><?php echo $myrow["refno"] ?></td>

        </tr>
        <tr bgcolor="#DDDEDD">
            <td colspan=4><span class="heading"><center><b>Customer & Enquiry Details</b></center></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td width=25%><span class="labeltext">Customer</td>
            <td width=25%><span class="tabletext"><?php echo $myrow["name"] ?></td>
            <td><span class="labeltext">Contact Person</font></td>
            <td><span class="tabletext"><?php echo $myrow["person"] ?></td>

        </tr>
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext">Order No.</td>
            <td><span class="tabletext"><?php echo $myrow["ordernum"]?></td>
            <td><span class="labeltext">Quote Ref/Previous Order</td>
            <td><span class="tabletext"><?php echo $myrow["quoterefnum"]?></td>
        </tr>
        
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext">Order Date</p></font></td>
            <td><span class="tabletext"><?php echo $orddate ?></td>
            <td><span class="labeltext"><p align="left">Quote/Previous Order Date</p></font></td>
            <td><span class="tabletext"><?php echo $quotedate ?></td>
        </tr>

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext">Order Type</td>
            <td><span class="tabletext"><?php echo $myrow["ordertype"] ?></td>
            <td colspan=2></td>
        </tr>

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext">Order Stored in the form of</td>
            <td><span class="tabletext"><?php echo $myrow["data_store"] ?></td>
            <td><span class="labeltext">Filename/Path</font></td>
            <td><span class="tabletext"><?php echo $myrow["path"] ?></td>
        </tr>

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext">Order for</td>
            <td><span class="tabletext"><?php echo $myrow["orderfor"] ?></td>
            <td><span class="labeltext">Attachments</font></td>
            <td><span class="tabletext"><?php echo $myrow["attachment1"] ?></td>
        </tr>


        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">No. of Parts</p></font></td>
            <td><span class="tabletext"><?php echo $myrow["numofparts"] ?></td>
            <td><span class="labeltext">Classification of Parts</td>
            <td><span class="tabletext"><?php echo $myrow["class"] ?></td>
        </tr>

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext">Raw material supplied by Customer <br>
                                         or to be Procured</font></td>
            <td><span class="tabletext"><?php echo $myrow["rawmaterial"] ?></td>
            <td><span class="labeltext">Source of Raw Material planned</td>
            <td><span class="tabletext"><?php echo $myrow["source"] ?></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext">Amendment Num</font></td>
            <td><span class="tabletext"><?php echo $myrow["amendment_num"] ?></td>
            <td><span class="labeltext">Amendment Date</td>
            <td><span class="tabletext"><?php echo $amenddate ?></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Create Date</p></font></td>
            <td><span class="tabletext"><?php echo $date1 ?></td>
            <td><span class="labeltext">Created By</td>
           <td><span class="tabletext"><?php echo $myrow["created_by"] ?></td>
        </tr>
        <?php

            $checked1="";

                if($myrow["qa_approved"] == 'yes'){
                     $checked1="checked";
                 }
        ?>
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext">QA Approved</font></td>
            <td><span class="tabletext"><input type="checkbox"  <?php echo $checked1 ?> name="qa_approved"  onClick="return readOnlyCheckBox()" /></td>
            <?php

   $checked2="";

   if($myrow["engineering_approved"] == 'yes'){
   $checked2="checked";
   }
   ?>
            <td><span class="labeltext">Engineering Approved</td>

            <td><span class="tabletext"><input type="checkbox" <?php echo $checked2 ?> name="engineering_approved"  onClick="return readOnlyCheckBox()"/></td>
        </tr>
        
         <tr bgcolor="#FFFFFF">
            <td><span class="labeltext">Status</font></td>
            <td bgcolor="#00FF00"><span class="tabletext"><?php echo $myrow["status"] ?></td>
            <td><span class="labeltext">Validation Status</font></td>
            <td bgcolor="#00FF00"><span class="tabletext"><?php echo $myrow["val_status"] ?></td>
         </tr>
         <input type="hidden" name="reviewrecnum" value="<?php echo $myrow["recnum"] ?>">
        <?php
         printf('<tr  bgcolor="#DDDEDD"><td colspan=4><span class="heading"><b>Notes for %s</b></center></td></tr>',$myrow["ordernum"]);
         $result = $newreview->getNotes($reviewrecnum);
         printf('<tr bgcolor="#FFFFFF"><td colspan=8><textarea name="notes" rows="6" cols="88"  readonly="readonly">');
         while ($mynotes = mysql_fetch_row($result)) {
          printf("\n");
          printf("********Added by $mynotes[2] on $mynotes[1]*********** ");
          printf("\n");
          printf($mynotes[0]);
          printf("   \n");
          }
      ?>
       </textarea></td>
      </tr>
        <tr bgcolor="#DDDEDD">
            <td colspan=4><span class="heading"><center><b>Resource & Infrastructure Requirements</b></center></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td colspan=2><span class="labeltext">Any resources required apart from the existing<br>
                                                   for this order? Provide Details.</font></td>
            <td colspan=2><span class="tabletext"><?php echo $myrow["resources"] ?></td>
        </tr>
        <tr bgcolor="#DDDEDD">
            <td colspan=4><span class="heading"><center><b>Quality</b></center></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td colspan=2><span class="labeltext">Are quality requirements clear? <br><b>Is it In-line with
               Organization or Specific</td>
            <td colspan=2><span class="tabletext"><?php echo $myrow["qualityreq"] ?></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td colspan=2><span class="labeltext">Comments on Specific Requirements</font></td>
            <td colspan=2><span class="tabletext"><?php echo $myrow["saliant"] ?></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td colspan=2><span class="labeltext">Any additional requirements for quality<br>
                in terms of Resources/Equipment/Infrastructure? Explain.</td>
            <td colspan=2><span class="tabletext"><?php echo $myrow["aditional_resources"] ?></td>
        </tr>

        <tr bgcolor="#DDDEDD">
            <td colspan=4><span class="heading"><center><b>Outsourcing Activity</b></center></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td colspan=2><span class="labeltext">Any Outsourcing/Sub-contracting activity needs to be planned?<br>
                   If yes, provide details</font></td>
            <td colspan=2><span class="tabletext"><?php echo $myrow["subcontract"] ?></td>
        </tr>
        <tr bgcolor="#DDDEDD">
            <td colspan=4><span class="heading"><center><b>Special Processes</b></center></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td colspan=2><span class="labeltext">Is there any Special Process involved?<br>If yes, provide details</font></td>
            <td colspan=2><span class="tabletext"><?php echo $myrow["special_process"] ?></td>
        </tr>
        <tr bgcolor="#DDDEDD">
            <td colspan=4><span class="heading"><center><b>Delivery Requirements</b></center></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td colspan=2><span class="labeltext">Are delivery requirements of the Order Clear?</font></td>
            <td colspan=2><span class="tabletext"><?php echo $myrow["delivery_req"] ?></td>
        </tr>

        <tr bgcolor="#DDDEDD">
            <td colspan=5><span class="heading"><center><b>Risk Analysis</b></center></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td colspan=2><span class="labeltext">Do you foresee any Risk as to the requirements of this<br>
                        Enquiry? If YES, state the probable Risk factor</td>
            <td colspan=2><span class="tabletext"><?php echo $myrow["risk_factors"] ?></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td colspan=2><span class="labeltext">Explain the Risk Factor</td>
            <td colspan=2><span class="tabletext"><?php echo $myrow["explain_risk_factors"] ?></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td colspan=2><span class="labeltext">Are any statutory or regulatory requirements applicable? If yes explain</font></td>
            <td colspan=2><span class="tabletext"><?php echo $myrow["requirements"] ?></td>
        </tr>

        <tr bgcolor="#DDDEDD">
            <td colspan=4><span class="heading"><center><b>Quotation Details</b></center></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext">Quote Reference No.</font></td>
            <td><span class="tabletext"><?php echo $myrow["quotation"] ?></td>
            <td><span class="labeltext">Quote Sent by</td>
            <td><span class="tabletext"><?php echo $myrow["quote_sentby"] ?></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td colspan=2><span class="labeltext">Details of Quotation/Estimation stored in</td>
            <td colspan=2><span class="tabletext"><?php echo $myrow["quotation_det_store"] ?></td>
        </tr>


        <tr bgcolor="#DDDEDD">
            <td colspan=4><span class="heading"><center><b>Data Storage</b></center></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td colspan=2><span class="labeltext">Data related to Enquiry stored in</td>
            <td colspan=2><span class="tabletext"><?php echo $myrow["data_for_enquiry"] ?></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td colspan=2><span class="labeltext">Mention the Filename/Path</td>
            <td colspan=2><span class="tabletext"><?php echo $myrow["enquiry_path"] ?></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td colspan=2><span class="labeltext">Data related to Quote stored in</td>
            <td colspan=2><span class="tabletext"><?php echo $myrow["data_for_quote"] ?></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td colspan=2><span class="labeltext">Mention the Filename/Path</td>
            <td colspan=2><span class="tabletext"><?php echo $myrow["quote_path"] ?></td>
        </tr>
	    <tr bgcolor="#DDDEDD">
            <td colspan=4><span class="heading"><center><b>Special Instructions</b></center></td>
       </tr>

        <tr  bgcolor="#FFFFFF">
		    <td><span class="labeltext"><span class='asterisk'>* </span>Special Instructions</font></td>
            <td colspan=4><textarea name="special_instrns" readonly rows="4" cols="45"><?php echo $myrow['special_instrns'] ?></textarea></td>
		 </tr>
		  <input type="hidden" name="ordernum" value="<?php $myrow["ordernum"] ?>">
		  <?php
		  $validation_status = $myrow["val_status"];
		  ?>
        


<tr bgcolor="#DDDEDD">
<td colspan=10><span class="heading"><center><b> Line Items</b></center></td>
</tr>
<tr bgcolor="#FFFFFF">
<table id="myTable" width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
<td bgcolor="#EEEFEE" width=4%><span class="heading"><b><center>Item No.</center></b></td>
<td bgcolor="#EEEFEE" width=4%><span class="heading"><b><center>CRN No.</center></b></td>
<td bgcolor="#EEEFEE" width=10%><span class="heading"><b><center>Part Num</center></b></td>
<td bgcolor="#EEEFEE" width=10%><span class="heading"><b><center>Part Name</center></b></td>
<td bgcolor="#EEEFEE" width=10%><span class="heading"><b><center>RM Type</center></b></td>
<td bgcolor="#EEEFEE" width=8%><span class="heading"><b><center>RM Spec</center></b></td>
<td bgcolor="#EEEFEE" width=8%><span class="heading"><b><center>UOM</center></b></td>
<td bgcolor="#EEEFEE" width=8%><span class="heading"><b><center>Dia</center></b></td>
<td bgcolor="#EEEFEE" width=8%><span class="heading"><b><center>Length</center></b></td>
<td bgcolor="#EEEFEE" width=8%><span class="heading"><b><center>Width</center></b></td>
<td bgcolor="#EEEFEE" width=8%><span class="heading"><b><center>Thickness</center></b></td>
<td bgcolor="#EEEFEE" width=8%><span class="heading"><b><center>Grain Flow</center></b></td>
<td bgcolor="#EEEFEE" width=8%><span class="heading"><b><center>Max Ruling</center></b></td>
<td bgcolor="#EEEFEE" width=8%><span class="heading"><b><center>Alt Spec</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Drg Iss</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Part Iss/Attach</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>COS Issue</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Model Issue</center></b></td>
<td bgcolor="#EEEFEE" width=6%><span class="heading"><b><center>Qty</center></b></td>
</tr>
<?php
  $partstr = $myrow["name"];
  $i = 1;
  while ($LI = mysql_fetch_row($myLI))
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
    $po_cos = $LI[11];
    $hc_cos = $LI[12];
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
     $crn_num = $LI[23];

	    echo "<td align=\"center\"><span class=\"tabletext\">$line_num</td>";
	    echo "<td align=\"center\"><span class=\"tabletext\">$crn_num</td>";
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
        
        
   $partstr = $partstr.'|'.$partnum;
   $partstr = $partstr.';'.$grainflow;
   $partstr = $partstr.';'.$maxruling;
   $partstr = $partstr.';'.$altspec;
   $partstr = $partstr.';'.$drgiss;
   $partstr = $partstr.';'.$partiss;
   $partstr = $partstr.';'.$cos_iss;
   $partstr = $partstr.';'.$model_iss;

	printf('</tr>');
	$i++;
	?>
 <?php
 }
?>
 
</table>
<?php
  if($validation_status == 'NO')
  {
   //$partstr = $_SESSION['partstr'];
   //echo $partstr;
   echo '<span class="heading"><center><b>Part Number Validation<b></center>';
   //$result = $newreport->get_mccost($mcname,$cond);
   echo "<div style=\"width:1200px;height:200px;overflow:auto;\">";
   echo "<table id=\"$tblid\" width=100% border=1 cellpadding=3 cellspacing=1 bgcolor=\"#DFDEDF\">";

   echo' <tr>
            <td bgcolor="#FFFFFF" width=20%><span class="heading"><b>Cust PO <br>Number</b></td>
            <td bgcolor="#FFFFFF" width=20%><span class="heading"><b>Cust PO<br>Date</b></td>
            <td bgcolor="#FFFFFF" width=20%><span class="heading"><b>Line Num</b></td>
            <td bgcolor="#FFFFFF" width=20%><span class="heading"><b>Part Num</b></td>
            <td bgcolor="#FFFFFF" width=20%><span class="heading"><b>GrainFlow</b></td>
            <td bgcolor="#FFFFFF" width=20%><span class="heading"><b>Max Ruling</b></td>
            <td bgcolor="#FFFFFF" width=20%><span class="heading"><b>Alt Spec</b></td>
            <td bgcolor="#FFFFFF" width=20%><span class="heading"><b>Drg Iss</b></td>
            <td bgcolor="#FFFFFF" width=20%><span class="heading"><b>Part<br>Iss/Attach</b></td>
            <td bgcolor="#FFFFFF" width=20%><span class="heading"><b>COS<br>Issue</b></td>
            <td bgcolor="#FFFFFF" width=20%><span class="heading"><b>Model<br>Issue</b></td>

        </tr>';
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
            $cur_partnum = $curpartarr[0];
            //echo $latest_partnum;
            $j=1;
            $gf = $curpartarr[$j++];
            //echo $gf;
            $mr = $curpartarr[$j++];
            //echo $mr;
            $altspec = $curpartarr[$j++];
            $drgiss = $curpartarr[$j++];
            $partiss = $curpartarr[$j++];
            $cosiss = $curpartarr[$j++];
            $modiss = $curpartarr[$j++];
            $ln = $curpartarr[$j++];
            //echo $modiss;
           $partfound = 0;
           $res_partnum = $newvalpart->getpartnum_details4neworder($cname,$cur_partnum);
           while ($myrow1 = mysql_fetch_row($res_partnum)) {
           if($myrow1[1] == $cur_partnum)
           {
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
            echo "<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$myrow1[3]</td>";
            echo "<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$myrow1[4]</td>";
            echo "<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$myrow1[5]</td>";
            echo "<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$myrow1[6]</td>";
            echo "<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$myrow1[7]</td>";
            echo "<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$myrow1[8]</td>";
            echo "<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$myrow1[9]</td>";
            echo "</tr>";
            echo "<tr>";
            echo "<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">&nbsp</td>";
            echo "<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">&nbsp</td>";
            echo "<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$ln</td>";
            echo "<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$cur_partnum (cur)</td>";
            if($myrow1[3] == $gf)
              echo "<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$gf</td>";
            else
              echo "<td bgcolor=\"#FF0000\"><span class=\"tabletext\">$gf</td>";
            if($myrow1[4] == $mr)
              echo "<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$mr</td>";
            else
              echo "<td bgcolor=\"#FF0000\"><span class=\"tabletext\">$mr</td>";
            if($myrow1[5] == $altspec)
              echo "<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$altspec</td>";
            else
              echo "<td bgcolor=\"#FF0000\"><span class=\"tabletext\">$altspec</td>";
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
            echo "<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$cur_partnum (cur)</td>";
            echo "<td bgcolor=\"#FF0000\"><span class=\"tabletext\">$gf</td>";
            echo "<td bgcolor=\"#FF0000\"><span class=\"tabletext\">$mr</td>";
            echo "<td bgcolor=\"#FF0000\"><span class=\"tabletext\">$altspec</td>";
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

<table border=3 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3>
        <tr bgcolor="#FFFFFF">
            <td colspan=4><span class="labeltext">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</td>
            <td colspan=2><span class="labeltext"><?php echo $myrow["formrev"] ?></td>
            <td colspan=2><span class="labeltext">CIMTOOLS PRIVATE LIMITED</td>
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
<?php
if($validation_status == 'NO')
{
?>
		<span class="tabletext"><input type="submit"
      style="color=#0066CC;background-color:#DDDDDD;width=130;"
      value="Validate" name="submit">
<?php
}
?>
      </FORM>
</table>
</body>
</html>
