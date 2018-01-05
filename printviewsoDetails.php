<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = October 12, 2006             =
// Filename: printsoDetails.php                =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OWT                          =
// Print Salesorder Details                    =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];

$_SESSION['pagename'] = 'printviewsoDetails';
//////session_register('pagename');

// First include the class definition
include('classes/userClass.php');
include('classes/companyClass.php');
include('classes/salesorderClass.php');
include('classes/soliClass.php');
include('classes/displayClass.php');
include('classes/pageClass.php');
include('classes/reviewClass.php');

$newlogin = new userlogin;
$newlogin->dbconnect();

$newpage = new page;
$newsalesorder = new salesorder;
$soli = new soli;
$newdisplay = new display;
$newCustomer = new company;
$newreview = new review;

$salesorderrecnum = $_REQUEST['salesorderrecnum'];
$userid = $_SESSION['user'];

$myQI = $soli->getQI($salesorderrecnum);
$result = $newsalesorder->getSalesorder($salesorderrecnum);
$myrow = mysql_fetch_row($result);
$specialinstrn=wordwrap($myrow[7],100);
?>
<link rel="stylesheet" href="style.css">

<html>
<head>
<title></title>
</head>
  <body>
<table width=100% border=0>
<tr><td><font style="Arial" size=5><center><b><A HREF="javascript:window.print()">Sales Order Details</A></b></center></td</tr>
</table>

<table border=0 bgcolor="#FFFFFF" width=100% cellspacing=1 cellpadding=5>
   <tr><td>&nbsp; </td> </tr>
</table>

   <table border=1 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=5>
     <tr bgcolor="#DDDEDD"><td colspan=4><span class="heading"><center><b>Sales Order Details</b></center></td></tr>
       <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Cust PO</p></font></td>
            <td><span class="tabletext"><?php echo $myrow[16]?></td>
            <td><span class="labeltext"><p align="left">Customer</p></font></td>
             <td ><span class="tabletext"><?php echo $myrow[1]?></td>
        </tr>

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext">Description</font></td>
            <td><span class="tabletext"><?php echo $myrow[3]?></td>
            <td><span class="labeltext">Contract Review Ref No.</td>
            <td ><span class="tabletext"><?php echo $myrow[42] ?></td>
       </tr>

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext">Order Date</font></td>
            <td><span class="tabletext">
            <?php
	      if($myrow[5] != '0000-00-00' && $myrow[5] != '' && $myrow[5] != 'NULL')
          {
              $datearr = split('-', $myrow[5]);
              $d=$datearr[2];
              $m=$datearr[1];
              $y=$datearr[0];
              $x=mktime(0,0,0,$m,$d,$y);
              $date=date("M j, Y",$x);
            //$date=date("F jS Y",$x);
             echo "$date";
		  }
		  else
		  {
			  echo "";
		  }
	      if($myrow[46] != '0000-00-00' && $myrow[46] != '' && $myrow[46] != 'NULL')
          {
              $datearr = split('-', $myrow[46]);
              $d=$datearr[2];
              $m=$datearr[1];
              $y=$datearr[0];
              $x=mktime(0,0,0,$m,$d,$y);
              $amenddate=date("M j, Y",$x);
		  }
		  else
		  {
                      $amenddate="";
		  }
            ?>
            </td>
            <td><span class="labeltext">Order/Quote Ref</font></td>
            <td><span class="tabletext"><?php echo $myrow[39] ?></td>
        </tr>

        <tr bgcolor="#FFFFFF">
             <td><span class="labeltext">Amendment No.</td>
            <td><span class="tabletext"><?php echo $myrow[45] ?></td>
            <td><span class="labeltext">Amendment Date</td>
            <td><span class="tabletext"><?php echo $amenddate ?></td>
        </tr>
        </table>
        <table border=1 bgcolor="#DFDEDF"  width=100% cellspacing=1 cellpadding=5>
        <tr bgcolor="#FFFFFF">
            <td colspan=4><span class="heading"><p align="left"><b>Special Instruction</b></p></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td colspan=4><span class="tabletext"><pre><?php echo $specialinstrn; ?></pre></td>
        </tr>

        <tr bgcolor="#DDDEDD">
            <td colspan=4><span class="heading"><center><b>Contact Information</b></center></td>
        </tr>
      <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Contact</p></font></td>
            <td colspan=3><span class="tabletext"><p align="left"><?php echo $myrow[37] ?></td>
            </td>
      </tr>
        <tr bgcolor="#FFFFFF">
          <td><span class="labeltext"><p align="left">Email</p></font></td>
          <td><span class="tabletext"><p align="left"><?php echo $myrow[29]?></td>
          <td><span class="labeltext"><p align="left">Phone</p></font></td>
          <td><span class="tabletext"><p align="left"><?php echo $myrow[38]?></td>
       </tr>
</table>
<?php

$reviewrecnum = $myrow[48];
$result4review = $newreview->getreview($reviewrecnum);
$myrow4review = mysql_fetch_assoc($result4review);
?>
<table width=100% border=1 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">

        <tr bgcolor="#DDDEDD">
            <td colspan=4 align="center"><span class="heading"><b>Order Stage Details</b></td>
        </tr>
         <tr bgcolor="#FFFFFF">
            <td><span class="labeltext">Review refno</td>
            <td><span class="tabletext"><?php echo $myrow4review["refno"] ?></td>
            <td colspan=2>&nbsp;</td>
         </tr>

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext">Order Type</td>
            <td><span class="tabletext"><?php echo $myrow4review["ordertype"] ?></td>
            <td><span class="labeltext">Contact Person</font></td>
            <td><span class="tabletext"><?php echo $myrow4review["person"] ?></td>
        </tr>

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext">Order Stored in the form of</td>
            <td><span class="tabletext"><?php echo $myrow4review["data_store"] ?></td>
            <td><span class="labeltext">Filename/Path</font></td>
            <td><span class="tabletext"><?php echo $myrow4review["path"] ?></td>
        </tr>

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext">Order for</td>
            <td><span class="tabletext"><?php echo $myrow4review["orderfor"] ?></td>
            <td><span class="labeltext">Attachments</font></td>
            <td><span class="tabletext"><?php echo $myrow4review["attachment1"] ?></td>
        </tr>


        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">No. of Parts</p></font></td>
            <td><span class="tabletext"><?php echo $myrow4review["numofparts"] ?></td>
            <td><span class="labeltext">Classification of Parts</td>
            <td><span class="tabletext"><?php echo $myrow4review["class"] ?></td>
        </tr>

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext">Raw material supplied by Customer <br>
                                         or to be Procured</font></td>
            <td><span class="tabletext"><?php echo $myrow4review["rawmaterial"] ?></td>
            <td><span class="labeltext">Source of Raw Material planned</td>
            <td><span class="tabletext"><?php echo $myrow4review["source"] ?></td>
        </tr>
<?php
      if($myrow4review["create_date"] != '0000-00-00' && $myrow4review["create_date"] != '' && $myrow4review["create_date"] != 'NULL')
          {
              $datearr = split('-', $myrow4review["create_date"]);
              $d=$datearr[2];
              $m=$datearr[1];
              $y=$datearr[0];
              $x=mktime(0,0,0,$m,$d,$y);
              $create_date=date("M j, Y",$x);
		  }
		  else
		  {
              $create_date="";
		  }
?>
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Create Date</p></font></td>
            <td><span class="tabletext"><?php echo $create_date ?></td>
            <td><span class="labeltext">Created By</td>
           <td><span class="tabletext"><?php echo $myrow4review["fname"] ?></td>
        </tr>
        <?php
            $checked="checked";
        ?>
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext">Engineering Approved</td>
            <td><span class="tabletext"><input type="checkbox" <?php echo $myrow4review["engineering_approved"] == 'yes'?$checked:"" ?> name="engineering_approved" disabled onClick="return readOnlyCheckBox()"/></td>
            <td><span class="labeltext">QA Approved</font></td>
            <td><span class="tabletext"><input type="checkbox"  <?php echo $myrow4review["qa_approved"] == 'yes'?$checked:"" ?>  name="qa_approved" disabled onClick="return readOnlyCheckBox()" /></td>
        </tr>
         <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Engg Approved By</p></font></td>
            <td><span class="tabletext"><?php echo $myrow4review["engg_app_by"] ?></td>
            <td><span class="labeltext">QA Approved By</td>
           <td><span class="tabletext"><?php echo $myrow4review["qa_app_by" ] ?></td>
        </tr>
         <tr bgcolor="#FFFFFF">
            <td><span class="labeltext">Validation Status</font></td>
            <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow4review["val_status"] ?></td>
            <td colspan=2>&nbsp;</td>
         </tr>

         <input type="hidden" name="reviewrecnum" value="<?php echo $myrow4review["recnum"] ?>">
      <tr bgcolor="#DDDEDD">
            <td colspan=4><span class="heading"><center><b>Resource & Infrastructure Requirements</b></center></td>
      </tr>
        <tr bgcolor="#FFFFFF">
            <td colspan=2><span class="labeltext">Any resources required apart from the existing<br>
                                                   for this order? Provide Details.</font></td>
            <td colspan=2><span class="tabletext"><?php echo $myrow4review["resources"] ?></td>
        </tr>
        <tr bgcolor="#DDDEDD">
            <td colspan=4><span class="heading"><center><b>Quality</b></center></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td colspan=2><span class="labeltext">Are quality requirements clear? <br><b>Is it In-line with
               Organization or Specific</td>
            <td colspan=2><span class="tabletext"><?php echo $myrow4review["qualityreq"] ?></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td colspan=2><span class="labeltext">Comments on Specific Requirements</font></td>
            <td colspan=2><span class="tabletext"><?php echo $myrow4review["saliant"] ?></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td colspan=2><span class="labeltext">Any additional requirements for quality<br>
                in terms of Resources/Equipment/Infrastructure? Explain.</td>
            <td colspan=2><span class="tabletext"><?php echo $myrow4review["aditional_resources"] ?></td>
        </tr>

        <tr bgcolor="#DDDEDD">
            <td colspan=4><span class="heading"><center><b>Outsourcing Activity</b></center></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td colspan=2><span class="labeltext">Any Outsourcing/Sub-contracting activity needs to be planned?<br>
                   If yes, provide details</font></td>
            <td colspan=2><span class="tabletext"><?php echo $myrow4review["subcontract"] ?></td>
        </tr>
        <tr bgcolor="#DDDEDD">
            <td colspan=4><span class="heading"><center><b>Special Processes</b></center></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td colspan=2><span class="labeltext">Is there any Special Process involved?<br>If yes, provide details</font></td>
            <td colspan=2><span class="tabletext"><?php echo $myrow4review["special_process"] ?></td>
        </tr>
        <tr bgcolor="#DDDEDD">
            <td colspan=4><span class="heading"><center><b>Delivery Requirements</b></center></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td colspan=2><span class="labeltext">Are delivery requirements of the Order Clear?</font></td>
            <td colspan=2><span class="tabletext"><?php echo $myrow4review["delivery_req"] ?></td>
        </tr>

        <tr bgcolor="#DDDEDD">
            <td colspan=5><span class="heading"><center><b>Risk Analysis</b></center></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td colspan=2><span class="labeltext">Do you foresee any Risk as to the requirements of this<br>
                        Enquiry? If YES, state the probable Risk factor</td>
            <td colspan=2><span class="tabletext"><?php echo $myrow4review["risk_factors"] ?></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td colspan=2><span class="labeltext">Explain the Risk Factor</td>
            <td colspan=2><span class="tabletext"><?php echo $myrow4review["explain_risk_factors"] ?></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td colspan=2><span class="labeltext">Are any statutory or regulatory requirements applicable? If yes explain</font></td>
            <td colspan=2><span class="tabletext"><?php echo $myrow4review["requirements"] ?></td>
        </tr>

        <tr bgcolor="#DDDEDD">
            <td colspan=4><span class="heading"><center><b>Quotation Details</b></center></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext">Quote Reference No.</font></td>
            <td><span class="tabletext"><?php echo $myrow4review["quotation"] ?></td>
            <td><span class="labeltext">Quote Sent by</td>
            <td><span class="tabletext"><?php echo $myrow4review["quote_sentby"] ?></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td colspan=2><span class="labeltext">Details of Quotation/Estimation stored in</td>
            <td colspan=2><span class="tabletext"><?php echo $myrow4review["quotation_det_store"] ?></td>
        </tr>


        <tr bgcolor="#DDDEDD">
            <td colspan=4><span class="heading"><center><b>Data Storage</b></center></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td colspan=2><span class="labeltext">Data related to Enquiry stored in</td>
            <td colspan=2><span class="tabletext"><?php echo $myrow4review["data_for_enquiry"] ?></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td colspan=2><span class="labeltext">Mention the Filename/Path</td>
            <td colspan=2><span class="tabletext"><?php echo $myrow4review["enquiry_path"] ?></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td colspan=2><span class="labeltext">Data related to Quote stored in</td>
            <td colspan=2><span class="tabletext"><?php echo $myrow4review["data_for_quote"] ?></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td colspan=2><span class="labeltext">Mention the Filename/Path</td>
            <td colspan=2><span class="tabletext"><?php echo $myrow4review["quote_path"] ?></td>
        </tr>
</table>
<tr bgcolor="#FFFFFF">
<table id="myTable" width=100% border=1 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
<tr bgcolor="#DDDEDD">
<td colspan=24><span class="heading"><center><b>Line Items</b></center></td>
</tr>
<td bgcolor="#EEEFEE" width=4%><span class="heading"><b><center>Item No.</center></b></td>
<td bgcolor="#EEEFEE" width=10%><span class="heading"><b><center>Part Name</center></b></td>
<td bgcolor="#EEEFEE" width=10%><span class="heading"><b><center>Part Num</center></b></td>
<td bgcolor="#EEEFEE" width=10%><span class="heading"><b><center>RM Type</center></b></td>
<td bgcolor="#EEEFEE" width=8%><span class="heading"><b><center>RM Spec</center></b></td>
<td bgcolor="#EEEFEE" width=8%><span class="heading"><b><center>Condition</center></b></td>
<td bgcolor="#EEEFEE" width=5%><span class="heading"><b><center>UOM</center></b></td>
<td bgcolor="#EEEFEE" width=5%><span class="heading"><b><center>Dia</center></b></td>
<td bgcolor="#EEEFEE" width=5%><span class="heading"><b><center>Length</center></b></td>
<td bgcolor="#EEEFEE" width=5%><span class="heading"><b><center>Width</center></b></td>
<td bgcolor="#EEEFEE" width=5%><span class="heading"><b><center>Thick</center></b></td>
<td bgcolor="#EEEFEE" width=8%><span class="heading"><b><center>Grain Flow</center></b></td>
<td bgcolor="#EEEFEE" width=8%><span class="heading"><b><center>Max Ruling</center></b></td>
<td bgcolor="#EEEFEE" width=8%><span class="heading"><b><center>Alt Spec</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Drg Iss</center></b></td>
<!--<td bgcolor="#EEEFEE"><span class="heading"><b><center>Hc Drg Iss</center></b></td>-->
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Part Iss/Attach</center></b></td>
<!--<td bgcolor="#EEEFEE"><span class="heading"><b><center>Hc Part Iss/Attach</center></b></td> -->
<!--<td bgcolor="#EEEFEE"><span class="heading"><b><center>PO Cos</center></b></td>-->
<!--<td bgcolor="#EEEFEE"><span class="heading"><b><center>Hc Cos</center></b></td>-->
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Cos Iss/Attach</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Model Issue</center></b></td>
<td bgcolor="#EEEFEE" width=6%><span class="heading"><b><center>Qty</center></b></td>
</tr>
<?php
 $i = 1;
      while ($QI = mysql_fetch_row($myQI))
      {
	printf('<tr bgcolor="#FFFFFF">');
	$line_num = $QI[0];
	$qty = $QI[2];
	$item_desc = $QI[1];
    $partnum = $QI[6];
    $rmtype = $QI[7];
    $rmspec = $QI[8];
    $partiss = $QI[9];
   // $hcpartiss = $QI[16];
    $po_cos = $QI[15];
  //  $hc_cos = $QI[18];
    $model_iss = $QI[16];
    //$cosiss = $QI[25];
    $drgiss = $QI[10];
  //  $hcdrgiss = $QI[15];
	//$price = $QI[3];
	//$amount = $QI[4];
	$rmprice = $QI[11];
	//$rmamount = $QI[12];
	//$mcprice = $QI[13];
	//$mcamount = $QI[14];
    $uom = $QI[17];
    $dia = $QI[18];
    $length = $QI[19];
    $width = $QI[20];
    $thickness = $QI[21];
    $gf = $QI[22];
    $maxruling = $QI[23];
    $altspec = $QI[24];
    $cond = wordwrap($QI[27],15,"<br />\n");
    $cosiss = wordwrap($QI[25],15,"<br />\n");

	echo "<td align=\"center\"><span class=\"tabletext\">$line_num</td>";
	echo "<td align=\"center\"><span class=\"tabletext\">$item_desc</td>";
    echo "<td align=\"center\"><span class=\"tabletext\">$partnum</td>";
    echo "<td align=\"center\"><span class=\"tabletext\">$rmtype</td>";
    echo "<td align=\"center\"><span class=\"tabletext\">$rmspec</td>";
    echo "<td align=\"center\"><span class=\"tabletext\">$cond</td>";
    echo "<td align=\"center\"><span class=\"tabletext\">$uom</td>";
    echo "<td align=\"center\"><span class=\"tabletext\">$dia</td>";
    echo "<td align=\"center\"><span class=\"tabletext\">$length</td>";
    echo "<td align=\"center\"><span class=\"tabletext\">$width</td>";
    echo "<td align=\"center\"><span class=\"tabletext\">$thickness</td>";
    echo "<td align=\"center\"><span class=\"tabletext\">$gf</td>";
    echo "<td align=\"center\"><span class=\"tabletext\">$maxruling</td>";
    echo "<td align=\"center\"><span class=\"tabletext\">$altspec</td>";
    echo "<td align=\"center\"><span class=\"tabletext\">$drgiss</td>";
   // echo "<td align=\"center\"><span class=\"tabletext\">$hcdrgiss</td>";
    echo "<td align=\"center\"><span class=\"tabletext\">$partiss</td>";
   // echo "<td align=\"center\"><span class=\"tabletext\">$hcpartiss</td>";
   // echo "<td align=\"center\"><span class=\"tabletext\">$po_cos</td>";
   // echo "<td align=\"center\"><span class=\"tabletext\">$hc_cos</td>";
    echo "<td align=\"center\"><span class=\"tabletext\">$cosiss</td>";
    echo "<td align=\"center\"><span class=\"tabletext\">$model_iss</td>";
    echo "<td align=\"center\"><span class=\"tabletext\">$qty</td>";

	printf('</tr>');
	$i++;
	?>
 <?php
    }

?>


   </table>
    </table>
    <table border=3 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3>
        <tr bgcolor="#FFFFFF">
            <td colspan=4><span class="labeltext">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</td>
            <td colspan=2><span class="labeltext"><?php echo $myrow[49]." ".$myrow[50] ?></td>
            <td colspan=2><span class="labeltext"></td>
        </tr>

</table>
    </table>


</body>
</html>
