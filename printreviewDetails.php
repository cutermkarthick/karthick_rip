<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = Mar 21, 2007                 =
// Filename: printreviewDetails.php            =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OWT                          =
// print Quality Plan Details                  =
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
include('classes/displayClass.php');

$newlogin = new userlogin;
$newlogin->dbconnect();
$userid = $_SESSION['user'];

$newreview = new review;
$newdisplay = new display;

$reviewrecnum = $_REQUEST['reviewrecnum'];

$result = $newreview->getreview($reviewrecnum);
$myrow = mysql_fetch_assoc($result);
if ($myrow['order_date'] != '0000-00-00') 
{
            $d=substr($myrow['order_date'],8,2);
            $m=substr($myrow['order_date'],5,2);
            $y=substr($myrow['order_date'],0,4);
            $x=mktime(0,0,0,$m,$d,$y);
            $orddate=date("M j, Y",$x);
}
else {
          $orddate = '';
}
if ($myrow['quote_date'] != '0000-00-00') 
{
            $d=substr($myrow['quote_date'],8,2);
            $m=substr($myrow['quote_date'],5,2);
            $y=substr($myrow['quote_date'],0,4);
            $x=mktime(0,0,0,$m,$d,$y);
            $quotedate=date("M j, Y",$x);
}
else {
          $quotedate = '';
}
?>
<link rel="stylesheet" href="style.css">

<html>
<head>
<title></title>
</head>

<table width=630 border=0>
<tr><td><font style="Arial" size=5><center><b><A HREF="javascript:window.print()">Contract Review</A></b></center></td</tr>
<tr><td>&nbsp</td></tr>
</table>

<table width=630 border=1 bgcolor="#DFDEDF"  cellspacing=1 cellpadding=3 rules=all>

<tr bgcolor="#DDDEDD"><td colspan=6><span class="heading"><center><b>Order Stage Details</b></center></td></tr>

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

 
</table>

<table width=792 border=1 bgcolor="#DFDEDF"  cellspacing=1 cellpadding=3 rules=all>
        <tr bgcolor="#FFFFFF">
            <td colspan=4><span class="labeltext">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</td>
            <td colspan=2><span class="labeltext"><?php echo $myrow["formrev"] ?></td>
            <td colspan=2><span class="labeltext"></td>
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
