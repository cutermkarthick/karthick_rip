<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = June 20, 2004                =
// Filename: WodetailsEntry.php                =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OWT                          =
// Allows  WO entry.                           =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );
}
$userid = $_SESSION['user'];
$dept = $_SESSION['department'];

$userrole = $_SESSION['userrole'];

//echo $userrole;
$_SESSION['pagename'] = 'wodetailsEntry';
$page = "WO: Reg WO";
//////session_register('pagename');
// First include the class definition
include('classes/userClass.php');
include('classes/workorderClass.php');
include('classes/empClass.php');
include('classes/companyClass.php');
include('classes/workflowClass.php');
include('classes/displayClass.php');



$newCustomer = new company;
$newdisp = new display;

$result = $newCustomer->getAllCustomers();
$newEmp = new emp;
$employees = $newEmp->getAllEmps();
$newWF = new workflow;

if(isset($_REQUEST['company']))
	$company=$_REQUEST['company'];
else
	$company='';

if(isset($_REQUEST['company']))
	$companyrecnum=$_REQUEST['companyrecnum'];
else
	$companyrecnum='';

if(isset($_REQUEST['descr']))
	$descr=$_REQUEST['descr'];
else
	$descr='';

if(isset($_REQUEST['wonum']))
	$wonum=$_REQUEST['wonum'];
else
	$wonum='';

if(isset($_REQUEST['part']))
	$part=$_REQUEST['part'];
else
	$part='';

if(isset($_REQUEST['ponum']))
	$ponum=$_REQUEST['ponum'];
else
	$ponum='';

if(isset($_REQUEST['quotenum']))
	$quotenum=$_REQUEST['quotenum'];
else
	$quotenum='';

if(isset($_REQUEST['qty']))
	$qty=$_REQUEST['qty'];
else
	$qty='';

if(isset($_REQUEST['ref_spec']))
	$ref_spec=$_REQUEST['ref_spec'];
else
	$ref_spec='';

if(isset($_REQUEST['book_date']))
	$book_date=$_REQUEST['book_date'];
else
	$book_date='';

if(isset($_REQUEST['owner']))
	$owner=$_REQUEST['owner'];
else
	$owner='';

if(isset($_REQUEST['reordercb']))
	$reordercb=$_REQUEST['reordercb'];
else
	$reordercb='';

if(isset($_REQUEST['reorder']))
	$reorder=$_REQUEST['reorder'];
else
	$reorder='';

if(isset($_REQUEST['emprecnum']))
	$emprecnum=$_REQUEST['emprecnum'];
else
	$emprecnum='';

if(isset($_REQUEST['contact']))
	$contact=$_REQUEST['contact'];
else
	$contact='';

if(isset($_REQUEST['contactrecnum']))
	$contactrecnum=$_REQUEST['contactrecnum'];
else
	$contactrecnum='';

if(isset($_REQUEST['phone']))
	$phone=$_REQUEST['phone'];
else
	$phone='';

if(isset($_REQUEST['email']))
	$email=$_REQUEST['email'];
else
	$email='';

if(isset($_REQUEST['wotypeval']))
	$wotype=$_REQUEST['wotypeval'];
else
	$wotype='';

if(isset($_REQUEST['bomnum']))
	$bomnum=$_REQUEST['bomnum'];
else
	$bomnum='';
if(isset($_REQUEST['bomrecnum']))
	$bomrecnum=$_REQUEST['bomrecnum'];
else
	$bomrecnum='';



$wfcnt=$newWF->getcountWF($wotype,'WO');
//echo("$wotype");
/*echo"<br>company:$company    descr:$descr   wonum:$wonum   part:$part   ponum:$ponum   quotenum:$quotenum   qty:$qty
         ref_spec:$ref_spec   book_date:$book_date    owner:$owner   reordercb:$reordercb   contact:$contact   phone:$phone
         email:$email     wotype:$wotype<br>";*/
?>

<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/WorkOrderAerowings.js"></script>
<script language="javascript" src="scripts/woentry.js"></script>
<script language="javascript" src="scripts/jquery.js"></script>

<html>
<head>
<script language="javascript" type="text/javascript">
function Disable(form) {
if (document.getElementById) {
for (var i = 0; i < form.length; i++) {
if (form.elements[i].type.toLowerCase() == "submit")
form.elements[i].disabled = true;
}
}
return true;
}
</script>
<title><?php echo $wotype?>Wo Entry</title>
</head>

<body leftmargin="0" topmargin="0" marginwidth="0" rightmargin="0" onload="javascript:clearPo()">
<form action='processGenericWO.php' method='post' enctype='multipart/form-data' onSubmit='Disable(this);'>
<input type="hidden" name="msdynamic" value="0">
<input type="hidden" name="hidpname"id="hidpname" value="woEntry">

<?php
include('header.html');
?>
<!-- <table width=100% cellspacing="0" cellpadding="6" border="0">

<tr>
<td>
<table width=100% border=0 cellspacing="0" cellpadding="0">
<tr>
<td><span class="welcome"><b>Welcome <?php echo $userid?></b></td>
<td align="right">&nbsp;
    <a href="exit.php" onMouseOut="MM_swapImgRestore()"
    onMouseOver="MM_swapImage('Image16','','images/logout_mo.gif',1)"><img name="Image16" border="0" src="images/logout.gif"></a>
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
<td width="6"><img src="images/spacer.gif " width="6"></td>
<td bgcolor="#FFFFFF"> -->
<div>
   <h2><span class="heading"><b>New Work Order</b></h2></span>


</div>

<table align="right" border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3 id="tablemd" class="stdtable1">
<tr bgcolor="#DDDEDD">
            <td colspan=4><span class="heading"><center><b>Work Order Information</b></center></td>
      </tr>
      <tr bgcolor="#FFFFFF">
             <td><span class="labeltext"><p align="left">Work Order Type</p></font></td>
             <td colspan=18><select onchange="clearPo()" id="woclassif" name="woclassif">
                   <option value="Regular">Regular</option>
                   <option value="Rework">Rework</option>
                   <option value="Split">Split</option>
				   <option value="Assembly">Assembly</option>
				   <option value="Split Assembly">Split Assembly</option>
                 </select>
            </td>
           <!--<td><span class="labeltext"><p align="left">Treatment</p></font></td>
             <td><select id="treatment" name="treatment">
                   <option value="Manufacture Only">Manufacture Only</option>
                   <option value="With Treatment">With Treatment</option>
                 </select>
            </td>-->

  </tr>
  <tr bgcolor="#FFFFFF" id="wo_status" style="display: none">
         <td ><span class="labeltext"><p align="left">Stage</font></td>
   	    <td ><input type="text" id="stage_split" name="stage_split" size=20 value="" onclick="javascript:Stage()return;"></td>
          <td><span class="labeltext"><p align="left">Work Order Ref#</p></font></td>
            <td colspan=18><input type="text" id="worefnum" name="worefnum" size=12 style="background-color:#DDDDDD;">
            <img src="images/bu_getwo.gif" alt="Get Wo" onclick="Getwo_crn()">
           
        </tr>
  <tr bgcolor="#FFFFFF">
  <td><span class="labeltext">
            <p align="left"><span class='asterisk'>*</span>Work Order Date</p>
            </font></td>
          <td><input type="text" name="book_date" id="book_date"
                    style="background-color:#DDDDDD;"
                    readonly="readonly" size=12 value="<?php echo $book_date ?>">
            <img src="images/bu-getdate.gif" alt="Get BookDate" onClick="GetDate('book_date')"></td>
            <td><span class="labeltext">
            <p align="left">Work Order Qty</p>
            </font></td>
            <td><input type="text" id="qty" name="qty" size=20 value=""><input type="hidden" name="owner"  size=20 value="">

            </td>
             <input type="hidden" name="quoterecnum">
  </tr>


      <?php


              include("mdEntry.php");


      ?>

      <tr bgcolor="#DDDEDD">
            <td colspan=4><span class="heading"><center><b>General Information</b></center></td>
      </tr>


      <input type="hidden" name="descr" size=140 value="xyz">


        <tr bgcolor="#FFFFFF">
              <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Cust PO #</p>
            </font></td>
            <td><span class="tabletext"><span class="tabletext">
            <input type="text" name="ponum" id="ponum" size=12 value="<?php echo $ponum ?>" style="background-color:#DDDDDD;"
                 readonly="readonly">
            <img src="images/bu-getpo.gif" onClick="Getpo('ponum')" id='poimg'>
            <input type="hidden" name="companyrecnum" id="companyrecnum" value="">
<input type="hidden" name="cust_po_line_num" id="cust_po_line_num" value=""></td>
            </td>
            <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Customer</p></font></td>
            <td colspan=1><input type="text" name="company" id="company"
                    style=";background-color:#DDDDDD;"
                    readonly="readonly" size=25 value="<?php echo $company ?>">
                    <img src="images/bu-getcustomer.gif" alt="Get Customer" onClick="GetAllCustomers()">
            </td>


        </tr>

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Customer PO Date </p></font></td>
            <?
             $po_date="";
            ?>
            <td><input type="text" readonly="readonly" name="po_date" id='po_date' style="background-color:#DDDDDD;"  size=12 value="<?php echo $po_date ?>">

            </td>
             <td><span class="labeltext">
            <p align="left">Customer PO Qty(Balance)</p>
            </font></td>
          <td><input type="text" name="po_qty" id="po_qty" size=12 value="" style="background-color:#DDDDDD;" readonly='readonly'>
          </td>


           <!-- <input type="hidden" name="bomrecnum" value="<?php //echo $bomrecnum ?>">-->
        </tr>

            <tr bgcolor="#FFFFFF" id="grn_img">
            <td><span class="labeltext"><p align="left">GRN#&nbsp;</p></font></td>
            <td><input type="text" id="grnnum" name="grnnum" size=12 style="background-color:#DDDDDD;">
            <img src="images/bu-get.gif"  alt="Get Grn" onClick="Getgrns('grnnum')">
            </td>
            <td><span class="labeltext"><p align="left">Batch#&nbsp;</p></font></td>
            <td><input type="text" id="batchnum" name="batchnum" size=12 style="background-color:#DDDDDD;">
      </tr>
      <tr bgcolor="#FFFFFF" id="grn_img_rm_spec">
            <td><span class="labeltext"><p align="left">RM Type</p></font></td>
            <td><input type="text" name="rm_type" id="rm_type" style="background-color:#DDDDDD;" size=20 value=""></td>
            <td><span class="labeltext"><p align="left">RM Specification</p></font></td>
            <td><input type="text" name="rm_spec" id="rm_spec" style="background-color:#DDDDDD;" size=20 value=""></td>

        </tr>
         <td><input type="hidden" name="qtm" id="qtm" style="background-color:#DDDDDD;" size=20 value=""></td>
       <tr bgcolor="#FFFFFF" id="grn_noimg">

            <td><span class="labeltext"><p align="left">GRN#&nbsp;</p></font></td>
            <td><input type="text" id="grnnum_split" name="grnnum_split" size=12 style="background-color:#DDDDDD;" value="">
            </td>
            <td><span class="labeltext"><p align="left">Batch#&nbsp;</p></font></td>
            <td><input type="text" id="batchnum_split" name="batchnum_split" size=12 style="background-color:#DDDDDD;" value="">
      </tr>
      <tr bgcolor="#FFFFFF" id="grn_noimg_rm_spec">
            <td><span class="labeltext"><p align="left">RM Type</p></font></td>
            <td><input type="text" name="rm_type_split" id="rm_type_split" style="background-color:#DDDDDD;" size=20 value="" readonly='readonly'></td>
            <td><span class="labeltext"><p align="left">RM Specification</p></font></td>
            <td><input type="text" name="rm_spec_split" id="rm_spec_split" style="background-color:#DDDDDD;" size=20 value="" readonly='readonly'></td>
        </tr>


	<tr bgcolor="#FFFFFF" id="amendments">
        <td><span class="labeltext"><p align="left">Amendment Qty</p></font></td>
		<td><input type="text" id="amendqty" name="amendqty" size=20 value=""></td>
       <td><span class="labeltext">
            <p align="left">Amendment Date</p></font></td>
           <td><input type="text" id="amenddate"  name="amenddate" style="background-color:#DDDDDD;" readonly="readonly"
           size="10%" value=""><img src="images/bu-getdateicon.gif" alt="GetDate"
           onclick="GetDate('amenddate')"> </td>
		</tr>



            <tr bgcolor="#FFFFFF">
            <td><span class="labeltext">Remarks</font></td>
            <td><textarea id="remarks" name="remarks" rows="3"
			              style=";background-color:#FFFFF;"
			              cols="45" value=""></textarea></td>
                    <td colspan="4" id="extratd"></td>
			              <td id="amendment_notes"><span class="labeltext"><p align="left">Amendment Notes</p></font></td>
		<td id="amendment_text"><textarea id="amendnotes" name="amendnotes" rows="2"
			              style=";background-color:#FFFFF;"
			              cols="30" value=""></textarea></td>

        </tr>

         <input type="hidden" name="reorder" value="<?php echo $reorder ?>">
         <input type="hidden" name="emprecnum" value="<?php echo $emprecnum ?>">
         <div id="fair">
         <input type="hidden" id="fair_stat" name="fair_stat" value="<?php echo '0'?>">
         <input type="hidden" id="prev_fairs" name="prev_fairs" value="<?php echo '0'?>">
         </div>


       <!-- <tr bgcolor="#DDDEDD">
            <td colspan=4><span class="heading"><center><b><span class='asterisk'>*</span>Contact Information</b></center></td>
        </tr>-->

       <!--  <tr bgcolor="#FFFFFF">
           <td><span class="labeltext"><span class='asterisk'>*</span>Contact</p></font></td>-->
           <input type="hidden" name="contact" style="background-color:#DDDDDD;"  size=30 value="fluent">
            <!-- <img src="images/bu-getcontact.gif" alt="Get Contact"  onclick="GetContact()">-->
	       <input type="hidden" name="contactrecnum" value="<?php echo $contactrecnum ?>">
           <input type="hidden" name="phone" style="background-color:#DDDDDD;"
                     size=12 value="12222">
           <input type="hidden" name="email" style="background-color:#DDDDDD;"
                     size=30 value="fluent@gmail.com">
        
<input type="hidden" name="wotype" value="<?php echo $wotype?>">
<input type="hidden" name="action" value="new">
 <!--<tr bgcolor="#DDDEDD">
            <td colspan=4><span class="heading"><center><b>Part Iss/Attachments</b></center></td>
   </tr>
         <tr  bgcolor="#FFFFFF">
             <td style='vertical-align: middle'><span class="labeltext"><p align="left">File1</td>
             <td><span class="tabletext"><input type="text" name="filename1"
             src="images/bu-browse.gif">
             <td style='vertical-align: middle'><span class="labeltext"><p align="left">File2</td>
             <td><span class="tabletext"><input type="text" name="filename2"
             src="images/bu-browse.gif">
        </td>
        <tr  bgcolor="#FFFFFF">
             <td style='vertical-align: middle'><span class="labeltext"><p align="left">File3</td>
             <td><span class="tabletext"><input type="text" name="filename3"
             src="images/bu-browse.gif">
             <td style='vertical-align: middle'><span class="labeltext"><p align="left">File4</td>
             <td><span class="tabletext"><input type="text" name="filename4"
             src="images/bu-browse.gif">
        </td>-->


   </table>


    <?php
    

       /* if($client =='yes')
        {
           if( $userrole == 'SU' || ($userrole == 'RU' && $dept == 'Stores'))
           {
              include("irmEntry.php");
           }

            if( $userrole == 'SU' || ($userrole == 'RU' && $dept == 'Production'))
           {
             include("mmentry.php");
           }

            if( $userrole == 'SU' || ($userrole == 'RU' && $dept == 'QA'))
           {
              include("siEntry.php");
              include("fidEntry.php");
              include("ddEntry.php");
           }

        }*/
    // include("mmentry.php");
       include("interaction.php");
    ?>

   <table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3>
   <tr>
   <td>
   <table border=0 width=100% cellspacing=1 cellpadding=3 class="stdtable1">

        <tr>
            <td colspan=6><span class="heading"><center><b>Timeline & Owner</b></center></td>
        </tr>

      <tr bgcolor="#FFFFFF">
            <td><span class="tabletext"><p align="left"><b>Sch Due Date</b></p></font></td>
            <td><input type="text" name="sch_due_date" id="sch_due_date"
                    style="background-color:#DDDDDD;"
                    readonly="readonly" size=12 value="">
             <img src="images/bu-getdate.gif" alt="Get SchDueDate" onClick="GetSch()">
            </td>
            <td><span class="tabletext"><p align="left"><b>Revised Completed Date</b></p></font></td>
            <td><input type="text" name="rev_ship_date" id="rev_ship_date"
                    style="background-color:#DDDDDD;"
                    readonly="readonly" size=12 value="">
             <img src="images/bu-getdate.gif" alt="Get RevShipDate"  onclick="GetDate('rev_ship_date')">
            </td>
            <td><span class="tabletext"><p align="left"><b>Actual Completion Date</b></p></font></td>
            <td><input type="text" name="act_ship_date" id="act_ship_date"
                    style="background-color:#DDDDDD;"
                    readonly="readonly" size=12 value="">
             <img src="images/bu-getdate.gif" alt="Get ActShipDate"  onclick="GetDate('act_ship_date')">
            </td>

      </tr>
  </table>

	<table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3 align=center>
        <!--<tr bgcolor="#FFFFFF">
			<td colspan="6"><a href="javascript:addRow('mytable',document.forms[0].msdynamic.value)"> <img src="images/bu-addrow.gif" border="0"></a></td>
	</tr>-->
     <tr bgcolor="#FFFFFF">
     <td colspan="6">
     <div id="workflow"></div>
      <div  id="prevworkflow">
     <table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3 id="mytable" class="stdtable1">

    <tr  bgcolor="#FFFFFF">
            <td bgcolor="#EEEFEE"><span class="heading"><b>Select</b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b>Dept</b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b>Mile<br/>stone</b></td>
	        <td bgcolor="#EEEFEE"><span class="heading"><b>Scheduled Date</b></td>
          <td bgcolor="#EEEFEE"><span class="heading"><b><center>Owner</center></b></td>
          <td bgcolor="#EEEFEE"><span class="heading"><b><center>Secs<br>Resposibility</center></b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b><center>Primary <br>Resposeibility</center></b></td>
          <td bgcolor="#EEEFEE"><span class="heading"><b><center>Process</center></b></td>
	        <td bgcolor="#EEEFEE"><span class="heading"><b><center>ETA</center></b></td>
       </tr>
 
    <input type="hidden" name="max" value="<?php echo "$wfcnt";?>">
	<input type="hidden" name="max1" value="0">
<?php
$i=1;

$wf = $newWF->getWF($wotype,'WO');

        while ($myrow = mysql_fetch_row($wf)) {
        $dates="dates" . $i;
        $est="est" . $i;
        $chknm="ckbo".$i;
        $dependency="dependency" . $i;
        $stagename="stagename" . $i;
        $stagenum="stagenum" . $i;
        $dept="dept" . $i;
        $secs_respose="secs_respose" . $i;
        $process="process" . $i;
        $when_process="when_process" . $i;
        $email="email" . $i;
        $primary_respose="primary_respose" . $i;
?>


          <tr bgcolor="#FFFFFF">
            <td  bgcolor=#FFFFFF><span class=tabletext><input type=checkbox name=<?php echo "$chknm";?> value=""  onclick="Setmax(<?php echo "$i";?>)" checked></td>
            <td><span class="heading"><?php echo $myrow[2] ?></td>
            <td><span class="heading"><?php echo $myrow[3] ?></td>
	        <input type="hidden" name="<?php echo "$est";?>" value="<?php echo "$myrow[9]";?>">

            <td><input type="text" name="<?php echo $dates ?>" id="<?php echo $dates ?>" style="background-color:#DDDDDD;" readonly="readonly" size=10 value="">
              <img src="images/bu-getdate.gif" alt="Get Date" onclick='GetDate1("<?php echo $dates ?>")'>
            </td>

<?php
          if ($myrow[2] != 'Cust') {
            
?>
            <td><input type="text" id="<?php echo $myrow[3],'_owner' ?>" name="<?php echo $myrow[3],'_owner' ?>" style=";background-color:#DDDDDD;" readonly="readonly" size=20 value="">
              <img src="images/bu-getowner.gif" alt="Get Owner" onclick='GetOwner("<?php echo $myrow[3],'_owner' ?>")'>
            </td>
                <input type="hidden" name="<?php echo $myrow[3],'_ownerrecnum' ?>" id="<?php echo $myrow[3],'_ownerrecnum' ?>" value="">
                 <input type="hidden" name="<?php echo $secs_respose ?>" value="<?php echo $myrow[11] ?>">
                 <input type="hidden" name="<?php echo $stagename ?>" value="<?php echo $myrow[3] ?>">
                 <input type="hidden" name="<?php echo $process ?>" value="<?php echo $myrow[12] ?>">
                 <input type="hidden" name="<?php echo $when_process ?>" value="<?php echo $myrow[13] ?>">
                 <input type="hidden" name="<?php echo $stagenum ?>" value="<?php echo $myrow[15] ?>">
                 <input type="hidden" name="<?php echo $dept ?>" value="<?php echo $myrow[2] ?>">
                 <input type="hidden" name="<?php echo $dependency ?>" value="<?php echo $myrow[10] ?>">
                 <input type="hidden" name="<?php echo $email ?>" value="<?php echo $myrow[14] ?>">
                  <input type="hidden" name="<?php echo $primary_respose ?>" id="<?php echo $primary_respose ?>" value="<?php echo $myrow[16] ?>">

<?php

          }
          else {

?>
            <td colspan=3>&nbsp
            </td>
<?php
          }

?>        
          <td><input type="text" name="<?php echo $secs_respose ?>"   id="<?php echo $secs_respose ?>" readonly="readonly" style="background-color: #DDDDDD" size="15" value="<?php echo $myrow[11] ?>">
          </td>

          <td><input type="text" name="<?php echo $primary_respose ?>"   id="<?php echo $primary_respose ?>" readonly="readonly" style="background-color: #DDDDDD" size="15" value="<?php echo $myrow[16] ?>">
          </td>

          <td>
            <textarea name="<?php echo $process ?>" rows=2 cols=15 readonly="readonly" style="background-color: #DDDDDD; overflow-y: scroll;"> <?php echo $myrow[12] ?></textarea>
        
          </td>

          <td>
               <textarea name="<?php echo $when_process ?>" rows=2 cols=15 readonly="readonly" style="background-color: #DDDDDD; overflow-y: scroll;"> <?php echo $myrow[13] ?></textarea>

          </td>

          </tr>

<?php
         $i++;
        }

?>
</div>


         <input type="hidden" name="wotype" size=15 value="<?php echo "$wotype" ?>">

         <input type="hidden" name="pagename_ol" id="pagename_ol" size=15 value="boardwoEntry">
         <input type="hidden" name="pagename" id="pagename" size=15 value="woEntry">
         <input type="hidden" name="wo_issue_qty" id="wo_issue_qty" value="0">
             <input type="hidden" id="approval_index" name="approval_index" value="">
</tr>
</table>


</td>

</tr>

</table>
</table>
<span class="labeltext"><input type="submit"
                     style="color=#0066CC;background-color:#DDDDDD;width=130;"
                     value="Submit" name="submit" onClick="javascript: return check_req_fields()">
                <INPUT TYPE="RESET"
                     style="color=#0066CC;background-color:#DDDDDD;width=130;"
                     VALUE="Reset" onClick="javascript: putfocus()">

</FORM>

		</body>
</html>
