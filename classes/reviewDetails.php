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
session_register('pagename');

// First include the class definition

include('classes/reviewClass.php');
include('classes/review_liClass.php');
include('classes/displayClass.php');

$newlogin = new userlogin;
$newlogin->dbconnect();
$userid = $_SESSION['user'];

$newreview = new review;
$LI = new review_li;
$newdisplay = new display;

$reviewrecnum = $_REQUEST['reviewrecnum'];

$result = $newreview->getreview($reviewrecnum);
$myLI = $LI->getLI($reviewrecnum);
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

?>

<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/review.js"></script>

<html>
<head>
<title>Review Order Stage Details</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">
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
<table width=100% border=0 cellpadding=0 cellspacing=0  >
<tr><td>
</td></tr>
<tr>
<td>

<?php  $newdisplay->dispLinks(''); ?>

</td></tr>
</table>
<table width=100% border=0 cellpadding=0 cellspacing=0  >
<tr bgcolor="DEDFDE">
<td width="6"><img src="images/spacer.gif " width="6"></td>
<td bgcolor="#FFFFFF">
<table width=100% border=0 cellspacing="1" cellpadding="6">
<tr>
<td><span class="pageheading"><b>Contract Review Order Stage Details</b><td colspan=250></td>
    <td bgcolor="#FFFFFF" rowspan=2 align="right">
          <a href ="edit_review.php?reviewrecnum=<?php echo $reviewrecnum ?>" ><img name="Image8" border="0" src="images/bu_editreview.gif" ></a>
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
            <td><span class="tabletext"><?php echo $myrow["ordernum"] ?></td>
            <td><span class="labeltext">Quote Ref/Previous Order</td>
            <td><span class="tabletext"><?php echo $myrow["quoterefnum"] ?></td>
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



        <tr bgcolor="#DDDEDD">
<td><span class="heading"><center><b> Line Items</b></center></td>
</tr>
<tr bgcolor="#FFFFFF">
<table id="myTable" width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
<td bgcolor="#EEEFEE" width=4%><span class="heading"><b><center>Item No.</center></b></td>
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
       // echo "<td align=\"center\"><span class=\"tabletext\">$hcdrgiss</td>";
        echo "<td align=\"center\"><span class=\"tabletext\">$partiss</td>";
       // echo "<td align=\"center\"><span class=\"tabletext\">$hcpartiss</td>";
       // echo "<td align=\"center\"><span class=\"tabletext\">$po_cos</td>";
      //  echo "<td align=\"center\"><span class=\"tabletext\">$hc_cos</td>";
        echo "<td align=\"center\"><span class=\"tabletext\">$cos_iss</td>";
        echo "<td align=\"center\"><span class=\"tabletext\">$model_iss</td>";
        echo "<td align=\"center\"><span class=\"tabletext\">$qty</td>";


	printf('</tr>');
	$i++;
	?>
 <?php
    }

?>
 
</table>

<table border=3 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3>
        <tr bgcolor="#FFFFFF">
            <td colspan=4><span class="labeltext">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</td>
            <td colspan=2><span class="labeltext"><?php echo $myrow["formrev"] ?></td>
            <td colspan=2><span class="labeltext">CIMTOOLS PRIVATE LIMITED</td>
        </tr>
 
</table>

<table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3>

<tr bgcolor="#FFFFFF">
<table id="myTable" width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >

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
      </FORM>
</table>
</body>
</html>
