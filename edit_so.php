<?php
//==============================================
// Author: FSI                                 =
// Date-written = July 20, 2006                =
// Filename: edit_so.php                       =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 WMS                          =
// Allows editing of SalesOrders               =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ($_SESSION['user']) )
{
  header ("Location: login.php");
}
$userid = $_SESSION['user'];
$emp = $_SESSION['employee'];
$dept = $_SESSION['department'];
$_SESSION['pagename'] = 'editso';
$page = "CRM: Sales Order";
//////session_register('pagename');

// First include the class definition
include_once('classes/loginClass.php');
include('classes/displayClass.php');
include('classes/soliClass.php');
include('classes/salesorderClass.php');
include('classes/reviewClass.php');

$newlogin = new userlogin;
$newlogin->dbconnect();

$newdisp = new display;
$newsalesorder = new salesorder;
$soli = new soli;
$newreview = new review;

$salesorderrecnum = $_REQUEST['salesorderrecnum'];
$myQI = $soli->getQI($salesorderrecnum);
$result = $newsalesorder->getSalesorder($salesorderrecnum);
$myrow = mysql_fetch_row($result);

// echo "<pre>";
// print_r($myrow);

// $reviewrecnum = $myrow[48];
// $result4review = $newreview->getreview($reviewrecnum);
// $myrow4review = mysql_fetch_assoc($result4review);
?>

<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/salesorder.js"></script>
<script language="javascript" src="scripts/jquery.js"></script>

<html>
<head>
<title>Edit COntract Review</title>
<script language="javascript">

    function onPageLoad() {
        window.setInterval(sendPing, 120000);
    }
    function sendPing() {
       $.ajax({
      url : "getsession4so.php",
      type : "POST",
      dataType: "html",
      success : function (msg){
     //alert(msg);
              $('#sessiondets').html(msg);
              }
          })
    }
</script>
</head>

<body leftmargin="0" topmargin="0" marginwidth="0" rightmargin="0" onload="onPageLoad()">
<form action='processSalesorder.php' method='post'>

<?php
include('header.html');
?>
<!-- <table width=100% cellspacing="0" cellpadding="0" border="0">
<table width=100% cellspacing="0" cellpadding="6" border="0">
<tr>
<td>
<table width=100% border=0 cellspacing="0" cellpadding="0">
  <tr>
      <td><span class="welcome"><b>Welcome <?php echo $userid?></b></td>
            <td align="right">&nbsp;
            <a href="exit.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image16','','images/logout_mo.gif',1)"><img name="Image16" border="0" src="images/logout.gif"></a>
      </td>
  </tr>
</table>
      <table width=100% border=0 cellpadding=0 cellspacing=0>
       <tr><td>
         </td></tr>
        <tr>
         <td>
        <?php $newdisp->dispLinks(''); ?>
        </td></tr>
      </table>
<table width=100% border=0 cellpadding=0 cellspacing=0  >
<tr bgcolor="DEDFDE">
<td width="6"><img src="images/spacer.gif " width="6"></td> -->
<td bgcolor="#FFFFFF">
<table style="width:100%" border=0 cellspacing="1" cellpadding="6">
<tr>
<td><span class="pageheading"><b>Edit Contract Review</b></td>
<td colspan=20>&nbsp;</td>
<table border=0 bgcolor="#DFDEDF" style="width:100%"  cellspacing=1 cellpadding=3 class="stdtable1">
      <tr bgcolor="#DDDEDD">
            <td colspan=4><span class="heading"><center><b>General Information</b></center></td>
        </tr>
        <tr bgcolor="#FFFFFF"  >
			  <td><span class="labeltext"><p align="left"><span class='asterisk'>* </span>Cust PO No.</p></font></td>
            <td><input type="text" name="po_num"
			        style="background-color:#DDDDDD;"
                    readonly="readonly" size=20 value="<?php echo $myrow[16]?>">
              <input type="hidden" name="porecnum">
                <td><span class="labeltext"><p align="left"><span class='asterisk'>* </span>Customer</p></font></td>

            <td><input type="text" name="company"
                    style=";background-color:#DDDDDD;"
                    readonly="readonly" size=20 value="<?php echo $myrow[1]?>">

             <img src="images/bu-getcustomer.gif" alt="Get Customer"
                 onclick="GetAllCustomers()">
            </td>
    <input type="hidden" name="companyrecnum" value="<?php echo $myrow[24]?>"></td>
    <input type="hidden" name="mysorecnum" value="<?php echo $salesorderrecnum?>"></td>
        </tr>
           <tr bgcolor="#FFFFFF">
            <td><span class="tabletext"><p align="left"><b>Order Date</b></p></font></td>
            <td><input type="text" name="order_date"
                    style="background-color:#DDDDDD;"
                    readonly="readonly" size=20 value="<?php echo $myrow[5]?>">
             <img src="images/bu-getdate.gif" alt="Get BookDate" onclick="GetDate('order_date')">
            </td>
            <td><span class="labeltext"><p align="left">Order/Quote Ref.</p></font></td>
            <td><input type="text" name="quote_num" size=20 value="<?php echo $myrow[39]?>"></td>
        </tr>

            <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><span class='asterisk'>* </span>Special Instruction</font></td>
            <td colspan=4><textarea name="special_instruction"
			        
                    rows="4"  cols="45"><?php echo $myrow[7] ?></textarea></td>
            </tr>

            <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Description</p></font></td>
            <td><input type="text" name="description" size=36 value="<?php echo $myrow[3]?>"></td>
             <td><span class="labeltext"><p align="left">Currency</p></font></td>
             <td><span class="labeltext"><select name="currency" size="1" width="100">
             <option selected>$ </option>
             <option value>Rs </option>
             </select>
           </tr>
           <input type="hidden" name="sales_order" size=20 value="">


        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext">Amendment</font></td>
            <td><input type="text" name="amendmentnum" size=20 value="<?php echo $myrow[42]?>"></td>
            <td><span class="labeltext">Amendment Date</td>
            <td><input type="text" name="amendmentdate"
                    style="background-color:#DDDDDD;"
                    readonly="readonly" size=20 value="<?php echo $myrow[43]?>">
             <img src="images/bu-getdate.gif" alt="Get AmndDate" onclick="GetDate('amendmentdate')">
        </tr>
        
	    <tr bgcolor="#FFFFFF">
            <td><span class="tabletext"><p align="left"><b>Status</b></p></font></td>
            <td colspan=3><span class="tabletext"><input type="text" name="status"
             id="status" size=15  style="background-color:#DDDDDD;"
                    readonly="readonly" value="<?php echo $myrow[44] ?>"
            <span class="tabletext"><select name="active"  size="1" width="10" onchange="onSelectStatus()">
             <option selected>Please Specify
             <option value>Open
             <option value>Pending
             <option value>Closed
             <option value>Cancelled
            </select>
            <input type="hidden" name="activeval" value="<?php echo $myrow[47] ?>">
 
            </td>
        </tr>
        <input type="hidden" name="salespersonrecnum" value="0">
        <input type="hidden" name="due_date" value="">
        <input type="hidden" name="quote_date" value="">

        <tr bgcolor="#DDDEDD">
            <td colspan=4><span class="heading"><center><b><span class='asterisk'>*</span>Contact Information</b></center></td>
        </tr>
      <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Contact</p></font></td>
            <td colspan=3><input type="text" name="contact" size=20 value="<?php echo $myrow[37] ?>"></td>
 
            </td>
        </tr>

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Email</p></font></td>
            <td><input type="text" name="email" size=20 value="<?php echo $myrow[29]?>"</td>
            <td><span class="labeltext"><p align="left">Phone</p></font></td>
            <td><input type="text" name="phone" size=20 value="<?php echo $myrow[38]?>"</td>
        </tr>
        
            <input type="hidden" name="amendment" value="">
            <input type="hidden" name="deleteflag" value="">
<!--<tr bgcolor="#FFFFFF"><td colspan=10><a href="javascript:addRow('myTable',document.myForm.index.value)"><img name="Image7" border="0" src="images/bu-addrow.gif"></a></td></tr>-->
<!-- <?php
// include('reviewEdit.php');
?> -->

 <table style="width:100%" border=0 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1">
        <tr bgcolor="#DDDEDD">
            <td colspan=4><span class="heading"><center><b>Order Stage Details</b></center></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext">Review refno</font></td>
            <td><span class="tabletext"><input type="text" name="refno"  style=";background-color:#DDDDDD;"
                    readonly="readonly" size=30 value="<?php echo $myrow["refno"] ?>"></td>
            <td colspan=2>&nbsp;</td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td><span 
            class="labeltext">Order Type</td>
            <td><input type="text" name="ordertype" size=30 value="<?php echo htmlspecialchars($myrow[53]) ?>"></td>
             <td><span class="labeltext"><span class='asterisk'>*</span>Contact Person</font></td>
            <td><span class="tabletext"><input type="text" name="person" size=30 value="<?php echo $myrow[65] ?>"></td>
            <input type="hidden" name="reviewrecnum" value="<?php echo $myrow["recnum"]  ?>">
        </tr>

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext">Order Stored in the form of</td>
            <td><input type="text" name="data_store" size=30 value="<?php echo $myrow[69] ?>"></td>
            <td><span class="labeltext">Filename/Path</font></td>
            <td><span class="tabletext"><input type="text" name="path" size=30 value="<?php echo $myrow[70] ?>"></td>
        </tr>

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Order for</td>
            <td><span class="tabletext"><input type="text" name="orderfor" size=30 value="<?php echo htmlspecialchars($myrow[52]) ?>"></td>
            <td><span class="labeltext">Attachments</font></td>
            <td><span class="tabletext"><input type="text" name="attachment1" size=30 value="<?php echo $myrow[51] ?>"></td>
        </tr>

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">No. of Parts</p></font></td>
            <td><span class="tabletext"><input type="text" name="numofparts" size=30 value="<?php echo $myrow[50] ?>"></td>
            <td><span class="labeltext">Classification of Parts</td>
            <td><span class="tabletext"><input type="text" name="parts_class" size=30 value="<?php echo $myrow[56] ?>"></td>
        </tr>

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext">Raw material supplied by Customer or to be Procured</font></td>
            <td><span class="tabletext"><input type="text" name="rawmaterial" size=30 value="<?php echo $myrow[54] ?>"></td>
            <td><span class="labeltext">Source of Raw Material planned</td>
            <td><span class="tabletext"><input type="text" name="source" size=30 value="<?php echo $myrow[55] ?>"></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Create Date</p></font></td>
            <td><span class="tabletext"><input type="text" name="create_date" size=20 value="<?php echo $myrow[86] ?>" readonly="readonly" style="background-color:#DDDDDD;">
                                 <img src="images/bu-getdate.gif" alt="Get BookDate" onclick="GetDate('create_date')"></td>
            <td><span class="labeltext">Created By</td>
            <td><span class="tabletext"><input type="text" name="created_by" size=30 value="<?php echo $myrow[87] ?>" readonly="readonly" style="background-color:#DDDDDD;"></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext">Director Approved</font></td>
            <input type="hidden" name="userid" id="userid" value="<?php echo $userid;?>"></td>
   <?php
     $checked="checked";
     $_SESSION['pagename'];
     if($myrow[89] == 'yes')
     {
  
   ?>

        <td bgcolor="#FFFFFF"><input type="checkbox" <?php echo $myrow[89] == 'yes'?$checked:"" ?>  name="engineering_approved"  id="engineering_approved" disabled>
                         <input type="hidden" name="eng_app" value="<?php echo $myrow[89]?>" id="eng_app">
                     <!--     <input type="hidden" name="eng_app_by" id="eng_app_by" value="<?php echo $myrow[91]?>"></td></td> -->

   <td><span class="labeltext"><p align="left">Dir Approved By</p></font></td>
            <td><span class="tabletext"> <input type="text" name="eng_app_by"  readonly="readonly" style="background-color:#DDDDDD;" id="eng_app_by" value="<?php echo $myrow[91] ?>"></td>
<?}else
{

?>
  <td bgcolor="#FFFFFF"><input type="checkbox" <?php echo $myrow[89] == 'yes'?$checked:"" ?>  name="engineering_approved"  id="engineering_approved" onclick="JavaScript:toggleValue('eng_app',this);">
                         <input type="hidden" name="eng_app" value="<?php echo $myrow[89]?>" id="eng_app">
                     <!--     <input type="hidden" name="eng_app_by" id="eng_app_by" value="<?php echo $myrow[91]?>"></td></td> -->

   <td><span class="labeltext"><p align="left">Dir Approved By</p></font></td>
            <td><span class="tabletext"> <input type="text" name="eng_app_by"  readonly="readonly" style="background-color:#DDDDDD;" id="eng_app_by" value=""></td>





<?}?>
     </tr>


    <tr bgcolor="#FFFFFF">
    <td><span class="labeltext">Validation Status</font></td>
    <td><span class="tabletext"><input type="text" name="val_status" size=30 value="<?php echo $myrow[85]?>" readonly="readonly" style="background-color:#DDDDDD;"></td>
    <td colspan=2>&nbsp;</td>
    </tr>


      <?php  
         printf('<tr  bgcolor="#DDDEDD"><td colspan=4><span class="heading"><b>Notes for %s</b></center></td></tr>',$myrow[16]);
         $result = $newsalesorder->getNotes($salesorderrecnum);
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
         $result = $newsalesorder->getNotes_type($salesorderrecnum,'prodn');
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
    if($_SESSION['department'] =='Production')
    {
   printf('<tr bgcolor="#DDDEDD"><td colspan=4><span class="heading"><b>Add Prodn. Notes</b></center></td></tr>'); ?>
      <tr bgcolor="#FFFFFF">
       <td colspan=4><textarea name="notes" rows="3" cols="88%" value=""></textarea>
       </td></tr>
     <?php }
         printf('<tr  bgcolor="#DDDEDD"><td colspan=4><span class="heading"><b>Notes for QA</b></center></td></tr>',$myrow[16]);
         $result = $newsalesorder->getNotes_type($salesorderrecnum,'qa');
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
   if($_SESSION['department'] =='QA')
    {
   printf('<tr bgcolor="#DDDEDD"><td colspan=4><span class="heading"><b>Add QA Notes</b></center></td></tr>'); ?>
      <tr bgcolor="#FFFFFF">
       <td colspan=4><textarea name="notes" rows="3" cols="88%" value=""></textarea>
       </td> </tr>
        <?php }
         printf('<tr  bgcolor="#DDDEDD"><td colspan=4><span class="heading"><b>Notes for Eng.</b></center></td></tr>',$myrow[16]);
         $result = $newsalesorder->getNotes_type($salesorderrecnum,'eng');
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
  
    if($_SESSION['department'] =='CAD')
    {
    printf('<tr bgcolor="#DDDEDD"><td colspan=4><span class="heading"><b>Add Eng Notes</b></center></td></tr>'); ?>
      <tr bgcolor="#FFFFFF">
      <td colspan=4><textarea name="notes" rows="3" cols="88%" value=""></textarea>
      </td></tr>
    <?}


//Added on June 24th,2013
        printf('<tr  bgcolor="#DDDEDD"><td colspan=4><span class="heading"><b>Notes for PPC.</b></center></td></tr>',$myrow[16]);
         $result = $newsalesorder->getNotes_type($salesorderrecnum,'ppc');
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
    if($_SESSION['department'] =='PPC' || $_SESSION['department'] =='PPC1' || $_SESSION['department'] =='PPC2')
    {
    printf('<tr bgcolor="#DDDEDD"><td colspan=4><span class="heading"><b>Add PPC Notes</b></center></td></tr>'); ?>
      <tr bgcolor="#FFFFFF">
      <td colspan=4><textarea name="notes" rows="3" cols="88%" value=""></textarea>
      </td></tr>
    <?}?>
        <tr bgcolor="#DDDEDD">
            <td colspan=4><span class="heading"><center><b>Purchase Order Requirements</b></center></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td colspan=2><span class="labeltext">Any resources required apart from the existing for this enquiry?
                         <br>Provide Details</td>
            <td colspan=2><span class="tabletext"><input type="text" name="resources" size=90 value="<?php echo $myrow[57] ?>"></td>
        </tr>
        <tr bgcolor="#DDDEDD">
            <td colspan=4><span class="heading"><center><b>Quality</b></center></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td colspan=2><span class="labeltext">Are quality requirements clear?
                       <br><b>Is it In-line with Organization or Specific</td>
            <td colspan=2><span class="tabletext"><input type="text" name="qualityreq" size=90 value="<?php echo $myrow[58] ?>"></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td colspan=2><span class="labeltext">Comments on Specific Requirements</font></td>
            <td colspan=2><span class="tabletext"><input type="text" name="saliant" size=90 value="<?php echo $myrow[59] ?>"></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td colspan=2><span class="labeltext">Any additional resources required for quality<br>
                in terms of Resources/Equipment/Infrastructure? Explain.</td>
            <td colspan=2><span class="tabletext"><input type="text" name="aditional_resources" size=90 value="<?php echo $myrow[60] ?>"></td>
        </tr>

        <tr bgcolor="#DDDEDD">
            <td colspan=4><span class="heading"><center><b>Outsourcing Activity</b></center></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td colspan=2><span class="labeltext">Any Outsourcing/Subcontracting activity needs to be planned?<br>
                   If yes, provide details</font></td>
            <td colspan=2><span class="tabletext"><input type="text" name="subcontract" size=90 value="<?php echo $myrow[62] ?>"></td>
        </tr>
        <tr bgcolor="#DDDEDD">
            <td colspan=4><span class="heading"><center><b>Special Processes</b></center></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td colspan=2><span class="labeltext">Is there any special process involved?<br>If yes, provide details</font></td>
            <td colspan=2><span class="tabletext"><input type="text" name="special_process" size=90 value="<?php echo $myrow[63] ?>"></td>
        </tr>
        <tr bgcolor="#DDDEDD">
            <td colspan=4><span class="heading"><center><b>Delivery Requirements</b></center></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td colspan=2><span class="labeltext">Are delivery requirements of the Enquiry Clear?</font></td>
            <td colspan=2><span class="tabletext"><input type="text" name="delivery_req" size=90 value="<?php echo $myrow[64] ?>"></td>
        </tr>
        <tr bgcolor="#DDDEDD">
            <td colspan=5><span class="heading"><center><b>Risk Analysis</b></center></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td colspan=2><span class="labeltext">Do you foresee any Risk as to the requirements of this<br>
                        Enquiry? If YES, state the probable Risk factor</td>
            <td colspan=2><span class="tabletext"><input type="text" name="risk_factors" size=90 value="<?php echo $myrow[72] ?>"></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td colspan=2><span class="labeltext">Explain the Risk Factor</td>
            <td colspan=2><span class="tabletext"><input type="text" name="explain_risk_factors" size=90 value="<?php echo $myrow[75] ?>"></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td colspan=2><span class="labeltext">Are any statutory or regulatory requirements applicable? If yes explain</font></td>
            <td colspan=2><span class="tabletext"><input type="text" name="requirements" size=90 value="<?php echo $myrow[73] ?>"></td>
        </tr>
        <tr bgcolor="#DDDEDD">
            <td colspan=4><span class="heading"><center><b>Quotation Details</b></center></td>
        </tr>

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext">Quote Reference No.</font></td>
            <td><span class="tabletext"><input type="text" name="quotation" size=30 value="<?php echo $myrow[67] ?>"></td>
            <td><span class="labeltext">Quote Sent by</td>
            <td><span class="tabletext"><input type="text" name="quote_sentby" size=30 value="<?php echo $myrow[74] ?>"></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td colspan=2><span class="labeltext">Details of Quotation/Estimation stored in</td>
            <td colspan=2><span class="tabletext"><input type="text" name="quotation_det_store" size=90 value="<?php echo $myrow[71] ?>"></td>
        </tr>

        <tr bgcolor="#DDDEDD">
            <td colspan=4><span class="heading"><center><b>Data Storage</b></center></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td colspan=2><span class="labeltext">Data related to Enquiry stored in</td>
            <td colspan=2><span class="tabletext"><input type="text" name="data_for_enquiry" size=90 value="<?php echo $myrow[80] ?>"></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td colspan=2><span class="labeltext">Mention the Filename/Path</td>
            <td colspan=2><span class="tabletext"><input type="text" name="enquiry_path" size=90 value="<?php echo $myrow[79] ?>"></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td colspan=2><span class="labeltext">Data related to Quote stored in</td>
            <td colspan=2><span class="tabletext"><input type="text" name="data_for_quote" size=90 value="<?php echo $myrow[68] ?>"></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td colspan=2><span class="labeltext">Mention Filename/Path</td>
            <td colspan=2><span class="tabletext"><input type="text" name="quote_path" size=90 value="<?php echo $myrow[78] ?>"></td>
        </tr>

<table border=0 bgcolor="#FFFFFF" style="width:100%" cellspacing=1 cellpadding=3 class="stdtable1">
<tr bgcolor="#DDDEDD">
<td colspan=4><span class="heading"><center><b>Sales Order Line Items</b></center></td>
</tr>
</table>
<div style="width:100%; overflow-x: scroll;">
<table id="myTable" width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1">
<tr>
<thead>
<th class="head0"><span class="heading"><b><center>PO Line Item</center></b></th>
<th class="head1"><span class="heading"><b><center>PRN No.</center></b></th>
<th class="head0"><span class="heading"><b><center>Part Number</center></b></th>
<th class="head1"><span class="heading"><b><center>Part Name</center></b></th>
<th class="head0"><span class="heading"><b><center>RM Type</center></b></th>
<th class="head1"><span class="heading"><b><center>RM Spec</center></b></th>
<th class="head0"><span class="heading"><b><center>RM Condition</center></b></th>
<th class="head1"><span class="heading"><b><center>UOM</center></b></th>
<th class="head0"><span class="heading"><b><center>Dia</center></b></th>
<th class="head1"><span class="heading"><b><center>Length</center></b></th>
<th class="head0"><span class="heading"><b><center>Width</center></b></th>
<th class="head1"><span class="heading"><b><center>Thickness</center></b></th>
<th class="head0"><span class="heading"><b><center>Grain Flow</center></b></th>
<th class="head1"><span class="heading"><b><center>Max Ruling Dim</center></b></th>
<th class="head0"><span class="heading"><b><center>Alt Spec</center></b></th>
<th class="head1"><span class="heading"><b><center>Drg Iss</center></b></th>
<!--<td bgcolor="#EEEFEE"><span class="heading"><b><center>Hc Drg Iss</center></b></td>-->
<th class="head0"><span class="heading"><b><center>Part Iss/Attach</center></b></th>
<!--<td bgcolor="#EEEFEE"><span class="heading"><b><center>Hc Part Iss/Attach</center></b></td>-->
<!--<td bgcolor="#EEEFEE"><span class="heading"><b><center>PO Cos</center></b></td>-->
<!--<td bgcolor="#EEEFEE"><span class="heading"><b><center>Hc Cos</center></b></td>-->
<!--<td bgcolor="#EEEFEE"><span class="heading"><b><center>COS Iss</center></b></td>-->
<th class="head1"><span class="heading"><b><center>Cos Iss/Attach</center></b></th>
<th class="head0"><span class="heading"><b><center>Model Issue</center></b></th>
<th class="head1"><span class="heading"><b><center>Quantity</center></b></th>
<th class="head0"><span class="heading"><b><center>Unit Price</center></b></th>
<th class="head1"><span class="heading"><b><center>Amount</center></b></th>
<th class="head0"><span class="heading"><b><center>Unit RM Cost</center></b></th>
<th class="head1"><span class="heading"><b><center>RM Amount</center></b></th>
<th class="head0"><span class="heading"><b><center>Unit M/C Cost</center></b></th>
<th class="head1"><span class="heading"><b><center>M/C Amount</center></b></th>
<th class="head0"><span class="heading"><b><center>Save</center></b></th>
</tr>



<?php
   $i=1;$flag=0;
   while($i<=40)
	{
		if($flag==0)
		{

		 while ($QI = mysql_fetch_row($myQI))
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

            $partiss="partiss" . $i;
            //$hcpartiss="hcpartiss" . $i;
            $po_cos="po_cos" . $i;
            $cos_iss="cos_iss" . $i;
            //$hc_cos="hc_cos" . $i;
            $model_iss="model_iss" . $i;
            $drgiss="drgiss" . $i;
            //$hcdrgiss="hcdrgiss" . $i;
			$qty="qty" . $i;
			$price="price" . $i;
			$amount="amount" . $i;
			$rmprice="rmprice" . $i;
			$rmamount="rmamount" . $i;
			$mcprice="mcprice" . $i;
			$mcamount="mcamount" . $i;
      $prevlinenum="prev_line_num" . $i;
			$lirecnum="lirecnum" . $i;
			$crn_num="crn_num" . $i;
			$condition="condition". $i;
			//echo "prevlinenum  : " . $prevlinenum . "    " . $QI[0];
			//echo "<br>$linenumber<br>$prevlinenum<br>$lirecnum<br>";
			echo "<td><span class=\"tabletext\"><input type=\"text\" id=\"$linenumber\"  name=\"$linenumber\"  value=\"$QI[0]\" size=\"4%\"></td>";
			echo "<td><span class=\"tabletext\"><input type=\"text\"  id=\"$crn_num\" name=\"$crn_num\"  style=\"background-color:#DDDDDD;\"
            	            readonly=\"readonly\" value=\"$QI[26]\" size=\"8%\" >
                      <img src=\"images/bu-get.gif\" onclick=\"GetCrn4Soli('$i')\"></td>";
            echo "<input type=\"hidden\" id=\"$prevlinenum\" name=\"$prevlinenum\" value=\"$QI[0]\">";
	        echo "<input type=\"hidden\" id=\"$lirecnum\" name=\"$lirecnum\" value=\"$QI[5]\">";
            echo "<td><input type=\"text\" id=\"$partnum\" name=\"$partnum\" size=\"10%\" value=\"$QI[6]\" style=\"background-color:#DDDDDD;\"
            	            readonly=\"readonly\"></td>";
	        echo "<td><input type=\"text\" id=\"$itemdesc\" name=\"$itemdesc\" size=\"10%\" value=\"$QI[1]\" style=\"background-color:#DDDDDD;\"
            	            readonly=\"readonly\"></td>";
            echo "<td><input type=\"text\" id=\"$rmtype\" name=\"$rmtype\" size=\"10%\" value=\"$QI[7]\" style=\"background-color:#DDDDDD;\"
            	            readonly=\"readonly\"></td>";
            echo "<td><input type=\"text\" id=\"$rmspec\" name=\"$rmspec\" size=\"10%\" value=\"$QI[8]\" style=\"background-color:#DDDDDD;\"
            	            readonly=\"readonly\"></td>";
            echo "<td><span class=\"tabletext\"><textarea id=\"$condition\" name=\"$condition\" rows=\"2\"
                 style=\"background-color:#DDDDDD;\"
            	            readonly=\"readonly\"
			              cols=\"20\" value=\"\">$QI[27]</textarea></td>";
            echo "<td ><input type=\"text\" id=\"$uom\" name=\"$uom\" size=\"10%\" value=\"$QI[17]\" style=\"background-color:#DDDDDD;\"
            	            readonly=\"readonly\"></td>";
            echo "<td ><input type=\"text\" id=\"$dia\" name=\"$dia\" size=\"10%\" value=\"$QI[18]\" style=\"background-color:#DDDDDD;\"
            	            readonly=\"readonly\"></td>";
            echo "<td ><input type=\"text\" id=\"$length\" name=\"$length\" size=\"10%\" value=\"$QI[19]\" style=\"background-color:#DDDDDD;\"
            	            readonly=\"readonly\"></td>";
            echo "<td ><input type=\"text\" id=\"$width\" name=\"$width\" size=\"10%\" value=\"$QI[20]\" style=\"background-color:#DDDDDD;\"
            	            readonly=\"readonly\"></td>";
            echo "<td ><input type=\"text\" id=\"$thickness\" name=\"$thickness\" size=\"10%\" value=\"$QI[21]\" style=\"background-color:#DDDDDD;\"
            	            readonly=\"readonly\"></td>";
            echo "<td ><input type=\"text\" id=\"$gf\" name=\"$gf\" size=\"10%\" value=\"$QI[22]\" style=\"background-color:#DDDDDD;\"
            	            readonly=\"readonly\"></td>";
            echo "<td ><input type=\"text\" id=\"$maxruling\" name=\"$maxruling\" size=\"10%\" value=\"$QI[23]\" style=\"background-color:#DDDDDD;\"
            	            readonly=\"readonly\"></td>";
            echo "<td ><input type=\"text\" id=\"$altspec\" name=\"$altspec\" size=\"10%\" value=\"$QI[24]\" style=\"background-color:#DDDDDD;\"
            	            readonly=\"readonly\"></td>";
	    $drgissvalue = htmlspecialchars($QI[10]);
	    echo "<td ><input type=\"text\" id=\"$drgiss\" name=\"$drgiss\" size=\"10%\" value=\"$drgissvalue\" ></td>";
	    $partissvalue = htmlspecialchars($QI[9]);
            echo "<td ><input type=\"text\" id=\"$partiss\" name=\"$partiss\" size=\"10%\" value=\"$partissvalue\" ></td>";
            //echo "<td ><input type=\"text\" name=\"$hcpartiss\" size=\"10%\" value=\"$QI[16]\"></td>";
            // echo "<td ><input type=\"text\" name=\"$po_cos\" size=\"10%\" value=\"$QI[15]\"></td>";
            // echo "<td ><input type=\"text\" name=\"$hc_cos\" size=\"10%\" value=\"$QI[18]\"></td>";
	    $cosissvalue = htmlspecialchars($QI[25]);
            echo "<td ><input type=\"text\" id=\"$cos_iss\" name=\"$cos_iss\" size=\"10%\" value=\"$cosissvalue\" ></td>";

            echo "<td ><input type=\"text\" id=\"$model_iss\" name=\"$model_iss\" size=\"10%\" value=\"$QI[16]\" ></td>";
           // echo "<td ><input type=\"text\" name=\"$hcdrgiss\" size=\"10%\" value=\"$QI[15]\"></td>";
	        echo "<td ><input type=\"text\" id=\"$qty\" name=\"$qty\" size=\"6%\" value=\"$QI[2]\"></td>";
            echo "<td ><input type=\"text\" id=\"$price\" name=\"$price\" size=\"10%\" value=\"$QI[3]\"></td>";
            echo "<td><input type=\"text\" id=\"$amount\" name=\"$amount\" style=\"background-color:#DDDDDD;\"
            	            readonly=\"readonly\" size=\"10%\" value=\"$QI[4]\">";
            echo "<td ><input type=\"text\" id=\"$rmprice\" name=\"$rmprice\" size=\"10%\" value=\"$QI[11]\" style=\"background-color:#DDDDDD;\"
            	            readonly=\"readonly\"></td>";
            echo "<td><input type=\"text\" id=\"$rmamount\" name=\"$rmamount\" style=\"background-color:#DDDDDD;\"
            	            readonly=\"readonly\" size=\"10%\" value=\"$QI[12]\" >";
            echo "<td ><input type=\"text\" id=\"$mcprice\" name=\"$mcprice\" size=\"10%\" value=\"$QI[13]\"></td>";
            echo "<td><input type=\"text\" id=\"$mcamount\" name=\"$mcamount\" style=\"background-color:#DDDDDD;\"
            	            readonly=\"readonly\" size=\"10%\" value=\"$QI[14]\">";
            echo "<td align=\"center\" bgcolor=\"#FFFFFF\">
                     <input type=\"submit\" name=\"Save\" value=\"Save\" onclick=\"javascript: return check_req_fields1('edit_so','save')\">";
			printf('</tr>');
			$i++;

			}
           $flag=1;
       }

//echo "i am in outside while loop";
		printf('<tr bgcolor="#FFFFFF">');
    	$line_num="line_num" . $i;
		$item_desc="item_desc" . $i;
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
        $partiss="partiss" . $i;
       // $hcpartiss="hcpartiss" . $i;
        $po_cos="po_cos" . $i;
      //  $hc_cos="hc_cos" . $i;
        $cos_iss="cos_iss" . $i;
        $model_iss="model_iss" . $i;
        $drgiss="drgiss" . $i;
        $crn_num="crn_num" . $i;
		$qty="qty" . $i;
		$condition="condition" . $i;
		$duedate="due_date" . $i;
		$price="price" . $i;
		$amount="amount" . $i;
		$rmprice="rmprice" . $i;
		$rmamount="rmamount" . $i;
		$mcprice="mcprice" . $i;
		$mcamount="mcamount" . $i;
		$prevlinenum="prev_line_num" . $i;
		$lirecnum="lirecnum" . $i;
		//echo "<br>$line_num<br>$prevlinenum<br>$lirecnum<br>";
    echo "<td><span class=\"tabletext\"><input type=\"text\"  id=\"$line_num\" name=\"$line_num\" value=\"\" size=\"4%\"></td>";
   	echo "<td><span class=\"tabletext\"><input type=\"text\" id=\"$crn_num\" name=\"$crn_num\" style=\"background-color:#DDDDDD;\"
            	            readonly=\"readonly\" value=\"\" size=\"8%\" >
                                                 <img src=\"images/bu-get.gif\" onclick=\"GetCrn4Soli('$i')\"></td>";
    echo "<td><input type=\"text\" id=\"$partnum\" name=\"$partnum\" size=\"10%\" value=\"\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></td>";
    echo "<td><input type=\"text\" id=\"$item_desc\" name=\"$item_desc\" size=\"10%\" value=\"\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></td>";
    echo "<td><input type=\"text\" id=\"$rmtype\" name=\"$rmtype\" size=\"10%\" value=\"\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></td>";
    echo "<td><input type=\"text\" id=\"$rmspec\" name=\"$rmspec\" size=\"10%\" value=\"\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></td>";
    echo "<td><textarea id=\"$condition\" name=\"$condition\" rows=\"2\"
                               cols=\"20\" value=\"\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></textarea></td>";
	echo "<td><input type=\"text\" id=\"$uom\" name=\"$uom\" size=\"10%\" value=\"\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></td>";
	echo "<td><input type=\"text\" id=\"$dia\" name=\"$dia\" size=\"10%\"  value=\"\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></td>";
	echo "<td><input type=\"text\" id=\"$length\" name=\"$length\" size=\"10%\"  value=\"\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></td>";
	echo "<td><input type=\"text\" id=\"$width\" name=\"$width\" size=\"10%\" value=\"\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></td>";
	echo "<td><input type=\"text\" id=\"$thickness\" name=\"$thickness\" size=\"10%\" value=\"\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></td>";
	echo "<td><input type=\"text\" id=\"$gf\" name=\"$gf\" size=\"10%\"  value=\"\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></td>";
	echo "<td><input type=\"text\" id=\"$maxruling\" name=\"$maxruling\" size=\"10%\" value=\"\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></td>";
	echo "<td><input type=\"text\" id=\"$altspec\" name=\"$altspec\" size=\"10%\" value=\"\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></td>";
    echo "<td><input type=\"text\" id=\"$drgiss\" name=\"$drgiss\" size=\"10%\" value=\"\" ></td>";
    echo "<td><input type=\"text\" id=\"$partiss\" name=\"$partiss\" size=\"10%\" value=\"\" ></td>";
    echo "<td><input type=\"text\" id=\"$cos_iss\" name=\"$cos_iss\" size=\"10%\" value=\"\" ></td>";
    echo "<td><input type=\"text\" id=\"$model_iss\" name=\"$model_iss\" size=\"10%\" value=\"\"></td>";
    echo "<td><input type=\"text\" id=\"$qty\" name=\"$qty\" size=\"6%\" value=\"\"></td>";
	echo "<td><input type=\"text\" id=\"$price\" name=\"$price\" size=\"10%\" value=\"0\" ></td>";
	echo "<td><input type=\"text\" id=\"$amount\" name=\"$amount\" size=\"10%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"\"></td>";
	echo "<td><input type=\"text\" id=\"$rmprice\" name=\"$rmprice\" size=\"10%\" value=\"0\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></td>";
	echo "<td><input type=\"text\" id=\"$rmamount\" name=\"$rmamount\" style=\"background-color:#DDDDDD;\"
		  		readonly=\"readonly\" size=\"10%\" value=\"\"></td>";
	echo "<td><input type=\"text\" id=\"$mcprice\" name=\"$mcprice\" size=\"10%\" value=\"0\"></td>";
	echo "<td><input type=\"text\" id=\"$mcamount\" name=\"$mcamount\" style=\"background-color:#DDDDDD;\"
		  		readonly=\"readonly\" size=\"10%\" value=\"\"></td>";
       echo "<td align=\"center\" bgcolor=\"#FFFFFF\">
                     <input type=\"submit\" name=\"Save\" value=\"Save\" onclick=\"javascript: return check_req_fields1('edit_so','save')\">";
		printf('</tr>');
		$i++;
		
	 }
     echo "<input type=\"hidden\" id=\"index\" name=\"index\" value=$i>";
 ?>

</table>

</div>
<input type="hidden" name="tax" size=10 value="0">
<input type="hidden" name="labor" size=10 value="0">
<input type="hidden" name="shipping" size=10 value="0">
<input type="hidden" id="stype" name="stype" value="">

<!--  <td width="6"><img src="images/spacer.gif " width="6"></td>
      </tr>
			<tr bgcolor="DEDFDE">
  				<td width="6"><img src="images/box-left-bottom.gif"></td>
				<td><img src="images/spacer.gif " height="6"></td>
				<td width="6"><img src="images/box-right-bottom.gif"></td>
		</tr> -->

    </table>
     <input type="hidden" name="salesorderrecnum" value="<?php echo $myrow[0] ?>">
               <span class="labeltext"><input type="submit"
                     style="color=#0066CC;background-color:#DDDDDD;width=130;"
                     value="Submit" name="submit" onclick="javascript: return check_req_fields1('edit_so','submit')">
                <INPUT TYPE="RESET"
                     style="color=#0066CC;background-color:#DDDDDD;width=130;"
                     VALUE="Reset" onclick="javascript: putfocus()">
         </table>

</FORM>
</body>
</html>
