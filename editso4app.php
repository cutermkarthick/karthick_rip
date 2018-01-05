<?php
//
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
$userid = $_SESSION['user'];
$dept = $_SESSION['department'];
//echo $dept;
$_SESSION['pagename'] = 'editso4app';
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
<table width=100% border=0 cellpadding=0 cellspacing=0  >
<tr bgcolor="DEDFDE">
<td width="6"><img src="images/spacer.gif " width="6"></td>
<td bgcolor="#FFFFFF">
<table width=100% border=0 cellspacing="1" cellpadding="6">
<tr>
<td><span class="pageheading"><b>Contract Review Details</b>	</td>

</td>
  </tr>

<table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3>
<?php
?>
 <table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3>
<tr bgcolor="#DDDEDD"><td colspan=4><span class="heading"><center><b>Customer PO Details</b></center></td></tr>
</td>
    <tr bgcolor="#FFFFFF">
            <td ><span class="labeltext">Cust PO</td>
            <td><span class="tabletext"><?php echo $myrow[16] ?></td>
            <td><span class="labeltext">Customer</td>
            <td ><span class="tabletext"><?php echo $myrow[1] ?></td>
    </tr>
      <input type="hidden" name="salesorderrecnum" value="<?php echo $salesorderrecnum; ?>">
      <input type="hidden" name="mysorecnum" id=name="mysorecnum" value="<?php echo $salesorderrecnum; ?>">
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
            <td ><span class="tabletext"><?php echo $myrow[39] ?></td>
      </tr>

   <tr bgcolor="#FFFFFF">
            <td><span class="labeltext">Amendment No.</td>
            <td><span class="tabletext"><?php echo $myrow[45] ?></td>
            <td><span class="labeltext">Amendment Date</td>
            <td ><span class="tabletext"><?php echo $amenddate ?></td>
    </tr>
         <tr bgcolor="#FFFFFF">
            <td bgcolor="#00DDFF"><span class="labeltext">Status</td>
            <td colspan=3><span class="tabletext"><input type="text" name="status" size=15  value="<?php echo $myrow[47]?>"
            <span class="tabletext"><select name="active"  size="1" width="10" onchange="onSelectStatus()">
             <option selected>Please Specify
             <option value>Open
             <option value>Pending
             <option value>Closed
             <option value>Cancelled
            </select>
            <input type="hidden" name="activeval" value="<?php echo $myrow[47] ?>"></td>
         </tr>
          <tr bgcolor="#FFFFFF">
            <td><span class="labeltext">Description</font></td>
            <td colspan=3><span class="tabletext"><?php echo $myrow[3]?></td>
        </tr>
          <tr bgcolor="#FFFFFF">
            <td><span class="labeltext">Special Instruction</font></td>
            <td colspan=4><textarea name="special_instruction"
			      style="background-color:#DDDDDD;" rows="6" cols="45"
                    readonly="readonly"><?php echo $myrow[7] ?></textarea></td>
        </tr>

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
         <tr bgcolor="#FFFFFF">
         </tr>
</table>
<?php

$reviewrecnum = $myrow[48];
$result4review = $newreview->getreview($reviewrecnum);
$myrow4review = mysql_fetch_assoc($result4review);
?>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">

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
            if($dept == 'ENGAPP')
            {
        ?>
          <tr bgcolor="#FFFFFF">
            <td><span class="labeltext">Engineering Approved</td>
            <td bgcolor="#FFFFFF"><input type="checkbox" <?php echo $myrow4review["engineering_approved"] == 'yes'?$checked:"" ?>  id="engineering_approved" name="engineering_approved" onclick="JavaScript:toggleValue('eng_app',this);">
                         <input type="hidden" name="eng_app" value="<?php echo $myrow4review["engineering_approved"]?>" id="eng_app">
                         <input type="hidden" name="eng_app_by" id="eng_app_by" value="<?php echo $myrow4review["engg_app_by"]?>"></td></td>
        <?php
           }
           else
           {
        ?>
          <tr bgcolor="#FFFFFF">
            <td><span class="labeltext">Engineering Approved</td>
            <td bgcolor="#FFFFFF"><input type="checkbox" <?php echo $myrow4review["engineering_approved"] == 'yes'?$checked:"" ?>  id="engineering_approved" name="engineering_approved"  disabled>
                         <input type="hidden" name="eng_app" value="<?php echo $myrow4review["engineering_approved"]?>" id="eng_app">
                         <input type="hidden" name="eng_app_by" id="eng_app_by" value="<?php echo $myrow4review["engg_app_by"]?>"></td></td>
          <?php
          }
          if($dept == 'QAAPP' && $myrow4review["engineering_approved"] == 'yes')
          {
        ?>
                         
           <td><span class="labeltext">QA Approved</td>
            <td bgcolor="#FFFFFF"><input type="checkbox" <?php echo $myrow4review["qa_approved"] == 'yes'?$checked:"" ?> id="qa_approved" name="qa_approved"   onclick="JavaScript:toggleValue('qa_app',this);">
                         <input type="hidden" name="qa_app" value="<?php echo $myrow4review["qa_approved"]?>" id="qa_app">
                         <input type="hidden" name="qa_app_by" id="qa_app_by" value="<?php echo $myrow4review["qa_app_by"]?>"></td>
        </tr>
        <?php
          }
          else
          {
         ?>
           <td><span class="labeltext">QA Approved</td>
            <td bgcolor="#FFFFFF"><input type="checkbox" <?php echo $myrow4review["qa_approved"] == 'yes'?$checked:"" ?> id="qa_approved" name="qa_approved" disabled>
                         <input type="hidden" name="qa_app" value="<?php echo $myrow4review["qa_approved"]?>" id="qa_app">
                         <input type="hidden" name="qa_app_by" id="qa_app_by" value="<?php echo $myrow4review["qa_app_by"]?>"></td>
          </tr>
          <?php
          }
         ?>
         <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Engg Approved By</p></font></td>
            <td><span class="tabletext"><?php echo $myrow4review["engg_app_by"] ?></td>
            <td><span class="labeltext">QA Approved By</td>
           <td><span class="tabletext"><?php echo $myrow4review["qa_app_by" ] ?></td>
        </tr>

		<tr bgcolor="#FFFFFF">
<td><span class="labeltext">Production Approved</td>
<?

if($dept == 'PRODNAPP' && $myrow4review["prodn_approved"] == 'yes')
{
$checked="checked";
?>
<td bgcolor="#FFFFFF"><input type="checkbox" <?php echo $myrow4review["prodn_approved"] == 'yes'?$checked:"" ?> name="prodn_approved" disabled>
<input type="hidden" name="prodn_app" value="<?php echo $myrow4review["prodn_approved"]?>" id="prodn_app">
</td>
<?}
else if($dept == 'PRODNAPP')
{?>
<td bgcolor="#FFFFFF"><input type="checkbox" <?php echo $myrow4review["prodn_approved"] == 'yes'?$checked:"" ?> name="prodn_approved" onclick="JavaScript:toggleValue('prodn_app',this);" >
<input type="hidden" name="prodn_app" value="<?php echo $myrow4review["prodn_approved"]?>" id="prodn_app">
</td>
<?}
else
{?>
<td bgcolor="#FFFFFF"><input type="checkbox" <?php echo $myrow4review["prodn_approved"] == 'yes'?$checked:"" ?> name="prodn_approved" disabled >
<input type="hidden" name="prodn_app" value="<?php echo $myrow4review["prodn_approved"]?>" id="prodn_app">
</td>
<?}?>

<td><span class="labeltext"><p align="left">Production Approved By</p></font></td>
            <td><span class="tabletext"><input type="text" name="prodn_app_by" id="prodn_app_by" size=20 value="<?php echo $myrow4review["prodn_app_by"] ?>" readonly="readonly" style="background-color:#DDDDDD;"></td>
			</tr>

         <input type="hidden" name="userid" id="userid" value="<?php echo $userid;?>"></td>
         <tr bgcolor="#FFFFFF">
            <td><span class="labeltext">Validation Status</font></td>
            <td bgcolor="#00FF00"><span class="tabletext"><?php echo $myrow4review["val_status"]?></td>
            <td colspan=2>&nbsp;</td>
         </tr>

         <input type="hidden" name="reviewrecnum" value="<?php echo $myrow4review["recnum"] ?>">
         <input type="hidden" name="dept" value="<?php echo $dept ?>">
      
	   <?php	 
         printf('<tr  bgcolor="#DDDEDD"><td colspan=4><span class="heading"><b>Notes for %s</b></center></td></tr>',$myrow[16]);
         $result = $newreview->getNotes($reviewrecnum);
         printf('<tr bgcolor="#FFFFFF"><td colspan=8><textarea name="notes1" rows="6" cols="88"  readonly="readonly">');
         while ($mynotes = mysql_fetch_row($result))
         {
          print("\n");
          print("********Added by $mynotes[2] on $mynotes[1]*********** ");
          print("\n");
          print($mynotes[0]);
          print("   \n");
         }
      ?>
      </textarea></td>
      </tr>


     <?php 
	  if($_SESSION['department'] =='Sales')
	  {
	 printf('<tr bgcolor="#DDDEDD"><td colspan=4><span class="heading"><b>Add Notes</b></center></td></tr>'); ?>
      <tr bgcolor="#FFFFFF">
       <td colspan=4><textarea name="notes" rows="3" cols="88%" value=""></textarea>
       </td> </tr>
	   <?}?>



	    <?php
         printf('<tr  bgcolor="#DDDEDD"><td colspan=4><span class="heading"><b>Notes for Production</b></center></td></tr>',$myrow[16]);
         $result = $newreview->getNotes_type($reviewrecnum,'prodn');
         printf('<tr bgcolor="#FFFFFF"><td colspan=8><textarea name="notes1" rows="6" cols="88"  readonly="readonly">');
         while ($mynotes = mysql_fetch_row($result))
         {
          print("\n");
          print("********Added by $mynotes[2] on $mynotes[1]*********** ");
          print("\n");
          print($mynotes[0]);
          print("   \n");
         }
      ?>
      </textarea></td>
      </tr>

     <?php 
	  if($_SESSION['department'] =='Production' || $_SESSION['department'] =='PRODNAPP')
	  {
	 printf('<tr bgcolor="#DDDEDD"><td colspan=4><span class="heading"><b>Add Prodn. Notes</b></center></td></tr>'); ?>
      <tr bgcolor="#FFFFFF">
       <td colspan=4><textarea name="notes" rows="3" cols="88%" value=""></textarea>
       </td></tr>
	   <?php }
         printf('<tr  bgcolor="#DDDEDD"><td colspan=4><span class="heading"><b>Notes for QA</b></center></td></tr>',$myrow[16]);
         $result = $newreview->getNotes_type($reviewrecnum,'qa');
         printf('<tr bgcolor="#FFFFFF"><td colspan=8><textarea name="notes1" rows="6" cols="88"  readonly="readonly">');
         while ($mynotes = mysql_fetch_row($result))
         {
          print("\n");
          print("********Added by $mynotes[2] on $mynotes[1]*********** ");
          print("\n");
          print($mynotes[0]);
          print("   \n");
         }
      ?>
      </textarea></td>
      </tr>
     <?php 
	 if($_SESSION['department'] =='QA' || $_SESSION['department'] =='QAAPP')
	  {
	 printf('<tr bgcolor="#DDDEDD"><td colspan=4><span class="heading"><b>Add QA Notes</b></center></td></tr>'); ?>
      <tr bgcolor="#FFFFFF">
       <td colspan=4><textarea name="notes" rows="3" cols="88%" value=""></textarea>
       </td> </tr>
	   	  <?php }
         printf('<tr  bgcolor="#DDDEDD"><td colspan=4><span class="heading"><b>Notes for Eng.</b></center></td></tr>',$myrow[16]);
         $result = $newreview->getNotes_type($reviewrecnum,'eng');
         printf('<tr bgcolor="#FFFFFF"><td colspan=8><textarea name="notes1" rows="6" cols="88"  readonly="readonly">');
         while ($mynotes = mysql_fetch_row($result))
         {
          print("\n");
          print("********Added by $mynotes[2] on $mynotes[1]*********** ");
          print("\n");
          print($mynotes[0]);
          print("   \n");
         }
      ?>
      </textarea></td>
      </tr>
     <?php 	
	  if($_SESSION['department'] =='CAD' || $_SESSION['department'] =='ENGAPP')
	  {
	  printf('<tr bgcolor="#DDDEDD"><td colspan=4><span class="heading"><b>Add Eng Notes</b></center></td></tr>'); ?>
      <tr bgcolor="#FFFFFF">
      <td colspan=4><textarea name="notes" rows="3" cols="88%" value=""></textarea>
      </td></tr>
	  <?}?>


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
    <table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3>
<tr bgcolor="#DDDEDD">
<td><span class="heading"><center><b> Line Items</b></center></td>
</tr>
<tr bgcolor="#FFFFFF">
<table id="myTable" width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
<td bgcolor="#EEEFEE" width=4%><span class="heading"><b><center>Item No.</center></b></td>
<td bgcolor="#EEEFEE" width=4%><span class="heading"><b><center>CRN No.</center></b></td>
<td bgcolor="#EEEFEE" width=10%><span class="heading"><b><center>Part Num</center></b></td>
<td bgcolor="#EEEFEE" width=10%><span class="heading"><b><center>Part Name</center></b></td>
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
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Part Iss/Attach</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Cos Iss/Attach</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Model Issue</center></b></td>
<td bgcolor="#EEEFEE" width=6%><span class="heading"><b><center>Qty</center></b></td>
</tr>
<?php
 $partstr = $myrow[24];
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
    $po_cos = $QI[15];
    $model_iss = $QI[16];
    $cosiss = $QI[25];
    $drgiss = $QI[10];
	$price = $QI[3];
	$amount = $QI[4];
	$rmprice = $QI[11];
	$rmamount = $QI[12];
	$mcprice = $QI[13];
	$mcamount = $QI[14];
    $uom = $QI[17];
    $dia = $QI[18];
    $length = $QI[19];
    $width = $QI[20];
    $thickness = $QI[21];
    $gf = $QI[22];
    $maxruling = $QI[23];
    $altspec = $QI[24];
    $crn_num = $QI[26];
    $condition = $QI[27];
    $cond = wordwrap($QI[27],15,"<br />\n");

	echo "<td align=\"center\"><span class=\"tabletext\">$line_num</td>";
	echo "<td align=\"center\"><span class=\"tabletext\">$crn_num</td>";
    echo "<td align=\"center\"><span class=\"tabletext\">$partnum</td>";
    echo "<td align=\"center\"><span class=\"tabletext\">$item_desc</td>";
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
    echo "<td align=\"center\"><span class=\"tabletext\">$partiss</td>";
    echo "<td align=\"center\"><span class=\"tabletext\">$cosiss</td>";
    echo "<td align=\"center\"><span class=\"tabletext\">$model_iss</td>";
    echo "<td align=\"center\"><span class=\"tabletext\">$qty</td>";


	$i++;
	?>
 <?php
    }
?>
        </tr>
</table>
 <table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3>
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
		<span class="tabletext"><input type="submit"
      style="color=#0066CC;background-color:#DDDDDD;width=130;"
      value="Submit" name="submit" onclick="javascript: return check_status()">

      </FORM>
</table>
</body>
</html>
