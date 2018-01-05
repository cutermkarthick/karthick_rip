<?php
//==============================================
// Author: FSI                                 =
// Date-written = July 20, 2006                =
// Filename: so_review_details.php             =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OWT                          =
// Salesorder Details                          =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ("Location: login.php");

}
$dept = $_SESSION['department'];
// if ($dept != 'Sales')
// {
//      header("Location:login.php");
// }
$userid = $_SESSION['user'];
$usertype = $_SESSION['usertype'];
$_SESSION['pagename'] = 'soDetails';
$page = "CRM: Sales Order";
//////session_register('pagename');

// First include the class definition
include('classes/userClass.php');
include('classes/salesorderClass.php');
include('classes/soliClass.php');
include('classes/displayClass.php');
include('classes/reviewClass.php');
include('classes/review_liClass.php');
include('classes/valpartClass.php');

$newlogin = new userlogin;
$newlogin->dbconnect();
$newsalesorder = new salesorder;
$soli = new soli;
$newdisplay = new display;
$newreview = new review;
$newvalpart = new valpart;

$salesorderrecnum =$_REQUEST['salesorderrecnum'];
$userid = $_SESSION['user'];

$myQI = $soli->getQI($salesorderrecnum);
$result = $newsalesorder->getSalesorder($salesorderrecnum);
$myrow = mysql_fetch_row($result);
// echo "<pre>";
// print_r($myrow);


?>

<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/salesorder.js"></script>
<html>
<head>
<title>Contract Review Details</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">
<form action='processSalesorder.php' method='post' enctype='multipart/form-data'>
<?php
include('header.html');
?>
<!-- <table width=100% cellspacing="0" cellpadding="6" border="0">
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
<table width=100% border=0 cellpadding=0 cellspacing=0  >
<tr bgcolor="DEDFDE">
<td width="6"><img src="images/spacer.gif " width="6"></td> -->
<td>
<table width=100% border=0 cellspacing="1" cellpadding="6" >
<tr>
<td><span class="pageheading"><b>Contract Review Details</b>
          <td rowspan=2 align="right">
<?if($usertype != 'CUST')
{
  ?>

            <input type="button" class="stdbtn btn_blue" style="float:right;padding:2px;margin-right:2px;"  onClick="javascript: printsoDetails(<?php echo $salesorderrecnum ?>)" value="Print" >
            <!-- <img src="images/bu-print.gif" value="Print" onclick="javascript: printsoDetails(<?php echo $salesorderrecnum ?>)"> -->
            <input type="button" class="stdbtn btn_blue" style="float:right;padding:2px;margin-right:2px;"  onClick="location.href='copy_so.php?salesorderrecnum=<?php echo $salesorderrecnum ?>'" value="Copy" >
            <input type="button" class="stdbtn btn_blue" style="float:right;padding:2px;margin-right:2px;"  onClick="location.href='edit_so.php?salesorderrecnum=<?php echo $salesorderrecnum ?>'" value="Edit Sales Order" >

            <input type="button" class="stdbtn btn_blue" style="float:right;padding:2px;margin-right:2px;"    onClick="javascript: printOrderDetails(<?php echo $salesorderrecnum ?>)" value="Print Acceptance" >


           <!-- <a href ="copy_so.php?salesorderrecnum=<?php echo $salesorderrecnum ?>"><img name="Image8" border="0" src="images/bu_copy.gif" ></a>
          <a href ="edit_so.php?salesorderrecnum=<?php echo $salesorderrecnum ?>" ><img name="Image8" border="0" src="images/eso.gif" ></a> -->
 <?}?>
</td>
  </tr>

<table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3>
<?php
?>
      <table class="stdtable1" border=0 bgcolor="#DFDEDF" style="width:100%"  cellspacing=1 cellpadding=3>
        <tr bgcolor="#DDDEDD">
          <td colspan=4><span class="heading"><center><b>Customer PO Details</b></center></td></tr>
        </td>

        <tr bgcolor="#FFFFFF">
          <td  width="25%"><span class="labeltext">Cust PO</td>
          <td width="25%"><span class="tabletext"><?php echo $myrow[16] ?></td>
          <td width="25%"><span class="labeltext">Customer</td>
          <td width="25%" ><span class="tabletext"><?php echo $myrow[1] ?></td>
        </tr>

        <input type="hidden" name="salesorderrecnum" id="salesorderrecnum" value="<?php echo $salesorderrecnum; ?>">
        <input type="hidden" name="mysorecnum" id="mysorecnum" value="<?php echo $salesorderrecnum; ?>">

        <tr bgcolor="#FFFFFF">
          <td><span class="labeltext">Order Date</font></td>
          <td ><span class="tabletext">
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

            if($myrow[43] != '0000-00-00' && $myrow[43] != '' && $myrow[43] != 'NULL')
            {
              $datearr = split('-', $myrow[43]);
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
          <td ><span class="tabletext"><?php echo $myrow[39] ?></td>
        </tr>

        <tr bgcolor="#FFFFFF">
          <td><span class="labeltext">Amendment No.</td>
          <td><span class="tabletext"><?php echo $myrow[42] ?></td>
          <td><span class="labeltext">Amendment Date</td>
          <td ><span class="tabletext"><?php echo $amenddate ?></td>
        </tr>

        <tr bgcolor="#FFFFFF">
          <td bgcolor="#00DDFF"><span class="labeltext">Status</td>
          <td bgcolor="#00DDFF"><span class="tabletext"><?php echo $myrow[44] ?></td>
          <td><span class="labeltext">Description</font></td>
          <td colspan=3><span class="tabletext"><?php echo $myrow[3]?></td>
        </tr>

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext">Special Instruction</font></td>
            <td colspan=4><textarea name="special_instruction" style="background-color:#DDDDDD;" rows="6" cols="45"  readonly="readonly"><?php echo $myrow[7] ?></textarea></td>
        </tr>

        <tr bgcolor="#DDDEDD">
          <td colspan=4><span class="heading"><center><b>Contact Information</b></center></td>
        </tr>

        <tr bgcolor="#FFFFFF">
          <td><span class="labeltext"><p align="left">Contact</p></font></td>
          <td colspan=3><span class="tabletext"><p align="left"><?php echo $myrow[37] ?></td>
        </tr>

        <tr bgcolor="#FFFFFF">
          <td><span class="labeltext"><p align="left">Email</p></font></td>
          <td><span class="tabletext"><p align="left"><?php echo $myrow[29]?></td>
          <td><span class="labeltext"><p align="left">Phone</p></font></td>
          <td><span class="tabletext"><p align="left"><?php echo $myrow[38]?></td>
        </tr>
      </table>

      <table class="stdtable1" style="width:100%"  border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
        <tr bgcolor="#DDDEDD">
          <td colspan=4 align="center"><span class="heading"><b>Order Stage Details</b></td>
        </tr>

        <tr bgcolor="#FFFFFF">
          <td width="25%"><span class="labeltext">Review refno</td>
          <td width="25%"><span class="tabletext"><?php echo $myrow["refno"] ?></td>
          <td colspan=2>&nbsp;</td>
        </tr>

        <tr bgcolor="#FFFFFF">
          <td width="25%"><span class="labeltext">Order Type</td>
          <td width="25%"><span class="tabletext"><?php echo $myrow[53] ?></td>
          <td width="25%"><span class="labeltext">Contact Person</font></td>
          <td width="25%"><span class="tabletext"><?php echo $myrow[65] ?></td>
        </tr>

        <tr bgcolor="#FFFFFF">
          <td width="25%"><span class="labeltext">Order Stored in the form of</td>
          <td width="25%"><span class="tabletext"><?php echo $myrow[69] ?></td>
          <td width="25%"><span class="labeltext">Filename/Path</font></td>
          <td width="25%"><span class="tabletext"><?php echo $myrow[70] ?></td>
        </tr>

        <tr bgcolor="#FFFFFF">
          <td width="25%"><span class="labeltext">Order for</td>
          <td width="25%"><span class="tabletext"><?php echo $myrow[52] ?></td>
          <td width="25%"><span class="labeltext">Attachments</font></td>
          <td width="25%"><span class="tabletext"><?php echo $myrow[51] ?></td>
        </tr>


        <tr bgcolor="#FFFFFF">
          <td width="25%"><span class="labeltext"><p align="left">No. of Parts</p></font></td>
          <td width="25%"><span class="tabletext"><?php echo $myrow[50] ?></td>
          <td width="25%"><span class="labeltext">Classification of Parts</td>
          <td width="25%"><span class="tabletext"><?php echo $myrow[56] ?></td>
        </tr>

        <tr bgcolor="#FFFFFF">
          <td width="25%"><span class="labeltext">Raw material supplied by Customer <br>  or to be Procured</font></td>
          <td width="25%"><span class="tabletext"><?php echo $myrow[54] ?></td>
          <td width="25%"><span class="labeltext">Source of Raw Material planned</td>
          <td width="25%"><span class="tabletext"><?php echo $myrow[55] ?></td>
        </tr>
        <?php
          if($myrow[86] != '0000-00-00' && $myrow[86] != '' && $myrow[86] != 'NULL')
          {
            $datearr = split('-', $myrow[86]);
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
          <td><span class="tabletext"><?php echo $myrow["fname"] ?></td>
        </tr>

        <?php
            $checked="checked";
        ?>
        <tr bgcolor="#FFFFFF">
          <td><span class="labeltext">Director Approved</td>
          <td><span class="tabletext"><input type="checkbox" <?php echo $myrow[89] == 'yes'?$checked:"" ?> name="engineering_approved" disabled onClick="return readOnlyCheckBox()"/></td>
          <td><span class="labeltext"><p align="left">Dir Approved By</p></font></td>
          <td><span class="tabletext"><?php echo $myrow[91] ?></td>
        </tr>	

        <tr bgcolor="#FFFFFF">
          <td><span class="labeltext">Validation Status</font></td>
          <td bgcolor="#00FF00"><span class="tabletext"><?php echo $myrow[85] ?></td>
          <td colspan=2>&nbsp;</td>
        </tr>
         
        <input type="hidden" name="reviewrecnum" value="<?php echo $myrow["recnum"] ?>">

      </table>

      <table class="stdtable1" border=0 bgcolor="#DFDEDF" style="width:100%"  cellspacing=1 cellpadding=3>
        <?php 
          echo "<tr bgcolor=\"#DDDEDD\">";
          echo "<td width=\"50%\"><span class=\"heading\"><b>Notes for CustPo</b></center></td>";
          echo "<td width=\"50%\" ></td>";
          echo "</tr>";

          echo "<tr bgcolor=\"#FFFFFF\">";
          echo "<td width=\"50%\"><textarea name=\"notes\" rows=\"6\" cols=\"88\"  readonly=\"readonly\">";
          $myTimezone = new DateTimeZone('Asia/Calcutta');
          $result = $newsalesorder->getNotes($salesorderrecnum);
          while ($mynotes = mysql_fetch_row($result))
          {
            $notestime = new DateTime($mynotes[1], $myTimezone);
            $mytime=$notestime->format('r');
             print("\n");
             print("********Added by $mynotes[2] on $mytime*********** ");
             print("\n");
             print($mynotes[0]);
             print("   \n");
          }
        
          echo"</textarea></td>";
          echo "<td width=\"50%\"></td>";
          echo "</tr>";

          echo "<tr bgcolor=\"#DDDEDD\">";
          echo "<td width=\"50%\"><span class=\"heading\"><b>Notes for Production</b></center></td>";
          echo "<td width=\"50%\" ><span class=\"heading\"><b>Notes for QA</b></center></td>";
          echo "</tr>";

          echo "<tr bgcolor=\"#FFFFFF\">";
          echo "<td width=\"50%\"><textarea name=\"notes\" rows=\"6\" cols=\"88\"  readonly=\"readonly\">";
          $myTimezone = new DateTimeZone('Asia/Calcutta');
          $result = $newsalesorder->getNotes_type($salesorderrecnum,'prodn');
          while ($mynotes = mysql_fetch_row($result))
          {
            $notestime = new DateTime($mynotes[1], $myTimezone);
            $mytime=$notestime->format('r');
            print("\n");
            print("********Added by $mynotes[2] on $mytime*********** ");
            print("\n");
            print($mynotes[0]);
            print("   \n");
          }
        
          echo"</textarea></td>";
          
          echo "<td width=\"50%\"><textarea name=\"notes\" rows=\"6\" cols=\"88\"  readonly=\"readonly\">";
          $myTimezone = new DateTimeZone('Asia/Calcutta');
          $result = $newsalesorder->getNotes_type($salesorderrecnum,'qa');
          while ($mynotes = mysql_fetch_row($result))
          {
            $notestime = new DateTime($mynotes[1], $myTimezone);
            $mytime=$notestime->format('r');
            print("\n");
            print("********Added by $mynotes[2] on $mytime*********** ");
            print("\n");
            print($mynotes[0]);
            print("   \n");
          }

          echo"</textarea></td>";

          echo "</tr>";


          echo "<tr bgcolor=\"#DDDEDD\">";
          echo "<td width=\"50%\"><span class=\"heading\"><b>Notes for Engineering</b></center></td>";
          echo "<td width=\"50%\" ><span class=\"heading\"><b>Notes for PPC</b></center></td>";
          echo "</tr>";

          echo "<tr bgcolor=\"#FFFFFF\">";
          echo "<td width=\"50%\"><textarea name=\"notes\" rows=\"6\" cols=\"88\"  readonly=\"readonly\">";
          $myTimezone = new DateTimeZone('Asia/Calcutta');
          $result = $newsalesorder->getNotes_type($salesorderrecnum,'eng');
          while ($mynotes = mysql_fetch_row($result))
          {
            $notestime = new DateTime($mynotes[1], $myTimezone);
            $mytime=$notestime->format('r');
            print("\n");
            print("********Added by $mynotes[2] on $mytime*********** ");
            print("\n");
            print($mynotes[0]);
            print("   \n");
          }
        
          echo"</textarea></td>";
          
          echo "<td width=\"50%\"><textarea name=\"notes\" rows=\"6\" cols=\"88\"  readonly=\"readonly\">";
          $myTimezone = new DateTimeZone('Asia/Calcutta');
          $result = $newsalesorder->getNotes_type($salesorderrecnum,'ppc');
          while ($mynotes = mysql_fetch_row($result))
          {
            $notestime = new DateTime($mynotes[1], $myTimezone);
            $mytime=$notestime->format('r');
            print("\n");
            print("********Added by $mynotes[2] on $mytime*********** ");
            print("\n");
            print($mynotes[0]);
            print("   \n");
          }

          echo"</textarea></td>";

          echo "</tr>";


        ?>
      </table>

      <table class="stdtable1" border=0 bgcolor="#DFDEDF" style="width:100%"  cellspacing=1 cellpadding=3>
        <tr bgcolor="#DDDEDD">
          <td colspan=4 align="center"><span class="heading"><center><b>Resource & Infrastructure Requirements</b></center></td>
        </tr>
        <tr bgcolor="#FFFFFF">
          <td width="50%"><span class="labeltext">Any resources required apart from the existing<br>   for this order? Provide Details.</font></td>
          <td width="50%"><span class="tabletext"><?php echo $myrow["resources"] ?></td>
        </tr>

        <tr bgcolor="#DDDEDD">
          <td colspan=4 align="center"><span class="heading"><center><b>Quality</b></center></td>
        </tr>
        <tr bgcolor="#FFFFFF">
          <td  width="50%"><span class="labeltext">Are quality requirements clear? <br><b>Is it In-line with
             Organization or Specific</td>
          <td  width="50%"><span class="tabletext"><?php echo $myrow["qualityreq"] ?></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td width="50%"><span class="labeltext">Comments on Specific Requirements</font></td>
            <td width="50%"><span class="tabletext"><?php echo $myrow["saliant"] ?></td>
        </tr>
        <tr bgcolor="#FFFFFF">
          <td width="50%"><span class="labeltext">Any additional requirements for quality<br> in terms of Resources/Equipment/Infrastructure? Explain.</td>
          <td width="50%"><span class="tabletext"><?php echo $myrow["aditional_resources"] ?></td>
        </tr>

        <tr bgcolor="#DDDEDD">
          <td colspan=4 align="center"><span class="heading"><center><b>Outsourcing Activity</b></center></td>
        </tr>
        <tr bgcolor="#FFFFFF">
          <td width="50%"><span class="labeltext">Any Outsourcing/Sub-contracting activity needs to be planned?<br>
          <td width="50%"><span class="tabletext"><?php echo $myrow["subcontract"] ?></td>
        </tr>

        <tr bgcolor="#DDDEDD">
          <td colspan=4 align="center"><span class="heading"><center><b>Special Processes</b></center></td>
        </tr>
        <tr bgcolor="#FFFFFF">
          <td width="50%"><span class="labeltext">Is there any Special Process involved?<br>If yes, provide details</span></td>
          <td width="50%"><span class="tabletext"><?php echo $myrow["special_process"] ?></span></td>
        </tr>

        <tr bgcolor="#DDDEDD">
          <td colspan=4 align="center"><span class="heading"><center><b>Delivery Requirements</b></center></td>
        </tr>
        <tr bgcolor="#FFFFFF">
          <td width="50%"><span class="labeltext">Are delivery requirements of the Order Clear?</font></td>
          <td width="50%"><span class="tabletext"><?php echo $myrow["delivery_req"] ?></td>
        </tr>

        <tr bgcolor="#DDDEDD">
          <td colspan=4 align="center"><span class="heading"><center><b>Risk Analysis</b></center></td>
        </tr>
        <tr bgcolor="#FFFFFF">
          <td width="50%"><span class="labeltext">Do you foresee any Risk as to the requirements of this<br>  Enquiry? If YES, state the probable Risk factor</td>
          <td width="50%"><span class="tabletext"><?php echo $myrow["risk_factors"] ?></td>
        </tr>
        <tr bgcolor="#FFFFFF">
          <td width="50%"><span class="labeltext">Explain the Risk Factor</td>
          <td width="50%"><span class="tabletext"><?php echo $myrow["explain_risk_factors"] ?></td>
        </tr>
        <tr bgcolor="#FFFFFF">
          <td width="50%"><span class="labeltext">Are any statutory or regulatory requirements applicable? If yes explain</span></td>
          <td width="50%"><span class="tabletext"><?php echo $myrow["requirements"] ?></td>
        </tr>

        <tr bgcolor="#DDDEDD">
          <td colspan=4 align="center"><span class="heading"><center><b>Quotation Details</b></center></td>
        </tr>
        <tr bgcolor="#FFFFFF">
          <td width="50%"><span class="labeltext">Quote Reference No.</span></td>
          <td width="50%"><span class="tabletext"><?php echo $myrow["quotation"] ?></td>
        </tr>
        <tr bgcolor="#FFFFFF">
          <td width="50%"><span class="labeltext">Quote Sent by</span></td>
          <td width="50%"><span class="tabletext"><?php echo $myrow["quote_sentby"] ?></td>
        </tr>
        <tr bgcolor="#FFFFFF">
          <td width="50%"><span class="labeltext">Details of Quotation/Estimation stored in</span></td>
          <td width="50%"><span class="tabletext"><?php echo $myrow["quotation_det_store"] ?></td>
        </tr>

        <tr bgcolor="#DDDEDD">
          <td colspan=4 align="center"><span class="heading"><center><b>Data Storage</b></center></td>
        </tr>
        <tr bgcolor="#FFFFFF">
          <td width="50%"><span class="labeltext">Data related to Enquiry stored in</td>
          <td width="50%"><span class="tabletext"><?php echo $myrow["data_for_enquiry"] ?></td>
        </tr>
        <tr bgcolor="#FFFFFF">
          <td width="50%"><span class="labeltext">Mention the Filename/Path</td>
          <td width="50%"><span class="tabletext"><?php echo $myrow["enquiry_path"] ?></td>
        </tr>
        <tr bgcolor="#FFFFFF">
          <td width="50%"><span class="labeltext">Data related to Quote stored in</td>
          <td width="50%"><span class="tabletext"><?php echo $myrow["data_for_quote"] ?></td>
        </tr>
        <tr bgcolor="#FFFFFF">
          <td width="50%"><span class="labeltext">Mention the Filename/Path</td>
          <td width="50%"><span class="tabletext"><?php echo $myrow["quote_path"] ?></td>
        </tr>
      </table> 


    <table border=0 bgcolor="#FFFFFF" style="width:100%" cellspacing=1 cellpadding=3 class="stdtable1">
<tr bgcolor="#DDDEDD">
<td><span class="heading"><center><b> Line Items</b></center></td>
</tr>
</table>
<div style="width:100%; overflow-x: scroll;">
<table id="myTable" border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1">
<tr>
<thead>
<th class="head0" style="padding:5px 6px;width:27px;"><span class="heading"><b><center>Item No.</center></b></td>
<th class="head1" style="padding:5px 6px;width:26px;"><span class="heading"><b><center>PRN</center></b></td>
<th class="head0" style="padding:5px 6px;width:27px;"><span class="heading"><b><center>Part Num</center></b></td>
<th class="head1" style="padding:5px 6px;width:31px;"><span class="heading"><b><center>Part Name</center></b></td>
<th class="head0" style="padding:5px 6px;width:25px;"><span class="heading"><b><center>RM Type</center></b></td>
<th class="head1" style="padding:5px 6px;width:27px;"><span class="heading"><b><center>RM Spec</center></b></td>
<th class="head0" style="padding:5px 6px;width:28px;"><span class="heading"><b><center>Cond</center></b></td>
<th class="head1" style="padding:5px 6px;width:26px;"><span class="heading"><b><center>UOM</center></b></td>
<th class="head0" style="padding:5px 6px;width:22px;"><span class="heading"><b><center>Dia</center></b></td>
<th class="head1" style="padding:5px 6px;width:36px;"><span class="heading"><b><center>Length</center></b></td>
<th class="head0" style="padding:5px 6px;width:32px;"><span class="heading"><b><center>Width</center></b></td>
<th class="head1" style="padding:5px 6px;width:29px;"><span class="heading"><b><center>Thick</center></b></td>
<th class="head0" style="padding:5px 6px;width:30px;"><span class="heading"><b><center>Grain Flow</center></b></td>
<th class="head1" style="padding:5px 6px;width:35px;"><span class="heading"><b><center>Max Ruling Dim</center></b></td>
<!-- <th class="head0" style="padding:5px 6px;width:26px;"><span class="heading"><b><center>Alt Spec</center></b></td> -->
<th class="head1" style="padding:5px 6px;width:23px;" ><span class="heading"><b><center>Drg Iss</center></b></td>
<th class="head0" style="padding:5px 6px;width:37px;" ><span class="heading"><b><center>Part Iss/<br/>Attach</center></b></td>
<th class="head1" style="padding:5px 6px;width:39px ;"><span class="heading"><b><center>Cos Iss/<br/>Attach</center></b></td>
<th class="head0" style="padding:5px 6px;width:36px;" ><span class="heading"><b><center>Model Issue</center></b></td>
<th class="head1" style="padding:5px 6px;width:27px;"><span class="heading"><b><center>Qty</center></b></td>
<th class="head0" style="padding:5px 6px;width:27px;"><span class="heading"><b><center>Unit Price</center></b></td>
<th class="head1" style="padding:5px 6px;width:29px;"><span class="heading"><b><center>Amt</center></b></td>
<!-- <th class="head0" style="padding:5px 6px;width:38px;"><span class="heading"><b><center>RM Unit Price</center></b></td>
<th class="head1" style="padding:5px 6px;width:26px;"><span class="heading"><b><center>RM Amt</center></b></td>
<th class="head0" style="padding:5px 6px;width:32px;"><span class="heading"><b><center>M/C Unit Price</center></b></td>
<th class="head1" style="padding:5px 6px;width:30px;"><span class="heading"><b><center>M/C Amt</center></b></td> -->
</tr>

<?php
 $partstr = $myrow[24];
 $i = 1;
   while ($QI = mysql_fetch_row($myQI))
   {
	printf('<tr bgcolor="#FFFFFF">');
	$line_num = $QI[0];
	$qty = $QI[2];
	$item_desc = wordwrap($QI[1],10,"<br />\n",false);
    $partnum = wordwrap($QI[6],12,"<br />\n",false);
    $rmtype = wordwrap($QI[7],10,"<br />\n",false);
    $rmspec = wordwrap($QI[8],10,"<br />\n",false);
    //$partiss = $QI[9];
    $partiss = wordwrap($QI[9],8,"<br />\n",false);
    $po_cos = $QI[15];
    $model_iss = wordwrap($QI[16],10,"<br />\n",false);
    $cosiss = $QI[25];
    $drgiss = wordwrap($QI[10],8,"<br />\n",false);
	$price = $QI[3];
	$amount = $QI[4];
	$rmprice = $QI[11];
	$rmamount = $QI[12];
	$mcprice = $QI[13];
	$mcamount = $QI[14];
    $uom = $QI[17];
    $dia = $QI[18];
    $length = $QI[19];
	$length = wordwrap($length,6,"<br />\n",false);
    $width = $QI[20];
	$width = wordwrap($width,6,"<br />\n",false);
    $thickness = $QI[21];
    $thickness = wordwrap($thickness,6,"<br />\n",false);
    $gf = $QI[22];
    $maxruling = $QI[23];
    $altspec = $QI[24];
    $crn_num = $QI[26];
    $condition = $QI[27];
    $cond = wordwrap($QI[27],15,"<br />\n",false);
	$rmspec1= wordwrap($rmspec,12,"<br />\n",false);
	$cond1=wordwrap($cond,10,"<br />\n",false);
	$altspec1=wordwrap($altspec,10,"<br />\n",false);
	$partiss1=wordwrap($partiss,10,"<br />\n",false);
	$cosiss1=wordwrap($cosiss,8,"<br />\n",false);
	$amount1=number_format($amount,2);
	$amount1=wordwrap($amount1,8,"<br />\n",false);

    echo "<td width=4px align=\"center\"><span class=\"tabletext\">$line_num</td>";
    echo "<td width=7px align=\"center\"><span class=\"tabletext\">$crn_num</td>";
    echo "<td width=15px align=\"center\"><span class=\"tabletext\">$partnum</td>";
    echo "<td width=25px align=\"center\"><span class=\"tabletext\">$item_desc</td>";
    echo "<td width=15px align=\"center\"><span class=\"tabletext\">$rmtype</td>";
    echo "<td width=15px align=\"center\"><span class=\"tabletext\">$rmspec1</td>";
    echo "<td width=27px align=\"center\"><span class=\"tabletext\">$cond1</td>";
    echo "<td width=14px align=\"center\"><span class=\"tabletext\">$uom</td>";
    echo "<td width=5px align=\"center\"><span class=\"tabletext\">$dia</td>";
    echo "<td width=14px align=\"center\"><span class=\"tabletext\">$length</td>";
    echo "<td width=14px align=\"center\"><span class=\"tabletext\">$width</td>";
    echo "<td width=14px align=\"center\"><span class=\"tabletext\">$thickness</td>";
    echo "<td width=14px align=\"center\"><span class=\"tabletext\">$gf</td>";
    echo "<td width=14px align=\"center\"><span class=\"tabletext\">$maxruling</td>";
    // echo "<td width=14px align=\"center\"><span class=\"tabletext\">$altspec1</td>";
    echo "<td width=15px align=\"center\"><span class=\"tabletext\">$drgiss</td>";
    echo "<td width=25px align=\"center\"><span class=\"tabletext\">$partiss1</td>";
    echo "<td width=14px align=\"center\"><span class=\"tabletext\">$cosiss1</td>";
    echo "<td width=15px align=\"center\"><span class=\"tabletext\">$model_iss</td>";
    echo "<td width=10px align=\"center\"><span class=\"tabletext\">$qty</td>";
	printf('<td align="right" width=10px ><span class="tabletext">%s %.2f</td>',$myrow[30],$price);
	printf('<td align="right" width=16px ><span class="tabletext">%s %s</td>',$myrow[30],$amount1);
	// printf('<td align="right" width=15px ><span class="tabletext">%s %.2f</td>',$myrow[30],$rmprice);
	// printf('<td  align="right" width=20px><span class="tabletext">%s %.2f</td>',$myrow[30],$rmamount);
	// printf('<td align="right" width=15px ><span class="tabletext">%s %.2f</td>',$myrow[30],$mcprice);
	// printf('<td align="right" width=20px ><span class="tabletext">%s %.2f</td>',$myrow[30],$mcamount);
	printf('</tr>');
	printf('</tr>');
	
   $partstr = $partstr.'|'.$crn_num;
   $partstr = $partstr.';'.$gf;
   $partstr = $partstr.';'.$maxruling;
   $partstr = $partstr.';'.$altspec;
   $partstr = $partstr.';'.$drgiss;
   $partstr = $partstr.';'.$partiss;
   $partstr = $partstr.';'.$cosiss;
   $partstr = $partstr.';'.$model_iss;
   
	$i++;
	?>
 <?php
    }

?>
<tr bgcolor="#EEEFEE">
            <td>&nbsp;</td>
            <td colspan=19><span class="labeltext"><p align="right">Total</p></font></td>
            <td align="right"><span class="labeltext">
            <?php

            	printf('%s%.2f</td>',$myrow[30],$myrow[17]);

            ?>
            <!-- <td>&nbsp</td>
            <td align="right"><span class="labeltext"> -->
            <?php

            	// printf('%s%.2f</td>',$myrow[30],$myrow[40]);

            ?>
            <!-- <td>&nbsp</td>
            <td align="right"><span class="labeltext"> -->
            <?php

            	// printf('%s%.2f</td>',$myrow[30],$myrow[41]);

            ?>

        </tr>
        </tr>
</table>
</div>
<?php
/*
  if($myrow4review["val_status"] == 'NO')
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
            $cur_crnnum = $curpartarr[0];
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
           $res_crnnum = $newvalpart->getpartnum_details4neworder($cname,$cur_crnnum);
           while ($myrow1 = mysql_fetch_row($res_crnnum)) {
           if($myrow1[1] == $cur_crnnum)
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
            echo "<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$cur_crnnum (cur)</td>";
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
            echo "<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$cur_crnnum (cur)</td>";
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
	  */
?>
 <table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3>
 </table>
 </td>
<!-- 		<td width="6"><img src="images/spacer.gif " width="6"></td>
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
      </FORM>
</table>
</body>
</html>
