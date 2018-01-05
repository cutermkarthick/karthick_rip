<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = Feb 23, 2010                 =
// Filename: assypoNew.php                     =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 WMS                          =
// Allows entry of Assembly Wo's               =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];
$dept = $_SESSION['department'];

$_SESSION['pagename'] = 'assyWoNew';
$page = "WO: Assy WO";
//////session_register('pagename');
// First include the class definition
//include('classes/assyWoClass.php');
include('classes/displayClass.php');
include('classes/companyClass.php');
include('classes/bomClass.php');
include('classes/salesorderClass.php');
include('classes/workflowClass.php');

//$newassyWo = new assyWo;
$newdisp = new display;
$company = new company;
$bom = new bom;
$custpo = new salesorder;
$newWF = new workflow;
?>

<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/assywo.js"></script>
<script language="javascript" src="scripts/jquery.js"></script>
<script language="javascript" src="scripts/datetimepicker_css.js"></script>
<html>
<head>
<title>New Assembly WO</title>

</head>
<body leftmargin="0"topmargin="0" marginwidth="0">
<form action='processAssywo.php' method='post' enctype='multipart/form-data'>
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
<td width="6"><img src="images/spacer.gif " width="6"></td> -->
<td bgcolor="#FFFFFF">
<table width=100% border=0 cellpadding=6 cellspacing=0>
<tr><td>
<table width=93% border=0>
<tr>
<td><span class="pageheading"><b>New Assembly WO</b></td>
</tr>
</table>
<table width=93% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1">
<tr bgcolor="#FFFFFF">
<tr bgcolor="#EEEFEE"><td colspan=4><span class="heading"><center><b>General Information</b></center></td>
</tr></table>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
<table width=93% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1">
<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Assy WO Qty</p></font></td>
<td width="30%"><span class="tabletext"><input type="text"  name="assy_woqty" id="assy_woqty" size=8 value=""></td>
<td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>WO Date</p></font></td>
<td ><span class="tabletext"><input type="text"  name="wo_date" id="wo_date" size="10" value=""  readonly = "readonly" style=";background-color:#DDDDDD;">
	<!--<img src="images/bu-getdateicon.gif" alt="Get Date"  onclick="GetDate('wo_date')"> -->
    <img src="images/bu-getdateicon.gif" onclick="javascript:NewCssCal('wo_date','yyyyMMdd')" style="cursor:pointer"/></td>
</tr>
<tr bgcolor="#FFFFFF">
	

 <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Assy Type</p></font></td>
            <td colspan=3><span class="tabletext" ><input type="text" name="assy_type" id="assy_type"
                         readonly="readonly"  style=";background-color:#DDDDDD;" value="" size="10">
	            <span class="tabletext" ><select name="assytype" size="1" width="10" onchange="onSelectType(this)">
 	                 <option value='Select'>Please Specify</option>
	            <option value='Kit'>Kit</option>
	            <option value='Assembly'>Assembly</option>
				 <option value='Rework'>Rework</option>
	            </select>
            </td>
</tr> <tr bgcolor="#FFFFFF">
<?php
//$result_cust = $company->getAllCustomers();
?>
<!--<td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Customer</p></font></td>
<td width="30%"><select id="customer" name="customer">
<option selected>Select</option>
<?php
//while($myrow_cust = mysql_fetch_row($result_cust))
//{
 // printf('<option value= %s>%s',$myrow_cust[0],$myrow_cust[1]);
//}
?>
</select></td>-->
<td ><span class="labeltext"><p align="left">PRN</p></font></td>
<td><input type="text" id="crn" name="crn" size=15 value="" style="background-color:#DDDDDD;" readonly="readonly">
<img src="images/bu-get.gif" alt="Get CIM" onclick="Getcim()"></td>
<td><span class="labeltext"><p align="left">Rework GRN</p></font></td>
<td width="30%"><span class="tabletext" ><input type="text"  name="rework_grn" id="rework_grn" size=14 value="" style="background-color:#DDDDDD;" readonly="readonly"></td>
</tr>
<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">Assy Part #</p></font></td>
<td width="30%"><span class="tabletext" ><input type="text"  name="assy_partno" id="assy_partno" size=16 value="" style="background-color:#DDDDDD;" readonly="readonly"></td>
<td><span class="labeltext"><p align="left">Assy Iss</p></font></td>
<td><span class="tabletext"><input type="text" name="assy_partiss" id="assy_partiss"  size=14 value="" style="background-color:#DDDDDD;" readonly="readonly"></td>
</tr>
<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">Dwg No</p></font></td>
<td width="30%"><span class="tabletext"><input type="text"  name="drg_no" id="drg_no" size=15 value="" style="background-color:#DDDDDD;" readonly="readonly"></td>
<td><span class="labeltext"><p align="left">Drg Iss</p></font></td>
<td><input type="text" name="drg_iss" id="drg_iss"   size=10 value="" style="background-color:#DDDDDD;" readonly="readonly"></td>
 </tr>
<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">BOM #</p></font></td>
<td width="30%"><span class="tabletext"><input type="text"  name="bomnum" id="bomnum" size=12 value="" style="background-color:#DDDDDD;" readonly="readonly"></td>
<td><span class="labeltext"><p align="left">BOM Rev</p></font></td>
<td><span class="tabletext" width="20%"><input type="text" name="bomiss" id="bomiss" size=10 value="" style="background-color:#DDDDDD;" readonly="readonly">
</td>
</tr>
 <tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">MPS /A.P.S #</p></font></td>
<td width="30%"><span class="tabletext"><input type="text"  name="mpsnumber" id="mpsnumber" size=15
style="background-color:#DDDDDD;" readonly="readonly" value=""></td>
<td><span class="labeltext"><p align="left">MPS/APS Rev</p></font></td>
<td><input type="text" id="mpsrev" name="mpsrev" size=15 style="background-color:#DDDDDD;"
readonly="readonly" value="">
<input type="hidden" name="link2mps" id="link2mps" value=""></td>
 </tr>
<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">COS #</p></font></td>
<td width="30%"><span class="tabletext"><input type="text"  name="cos_num" id="cos_num" size=12 value="" style="background-color:#DDDDDD;" readonly="readonly"></td>
<td colspan=2></td>
</tr>

<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">Cust PO#</p></font></td>
<td><input type="text" id="cust_ponum" name="cust_ponum" size=20 value="" >
<?php

if($dept !='QA')
{
?>
<img src="images/bu-getpo.gif" onClick="Getpo('ponum')" id='poimg'>
<?php
}
?>
</td>
<td><span class="labeltext"><p align="left">PO Qty</p></font></td>
<td><span class="tabletext"><input type="text"  name="po_qty" id="po_qty" size="5" value="" ></td>
</tr>
<input type="hidden" name="page" id="page" value="new">

<tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Customer</p></font></td>
            <td colspan=1><input type="text" name="companyname" id="companyname"
                    style=";background-color:#DDDDDD;"
                    readonly="readonly" size=25 value="<?php echo $companyname ?>">
                    <img src="images/bu-getcustomer.gif" alt="Get Customer" onClick="GetAllCustomers()">
            </td>
           <input type="hidden" name="customer" id="customer" value="">
<td><span class="labeltext"><p align="left">Cust PO Line#</p></font></td>
<td><input type="text" size=5 name="cust_po_line_num" id="cust_po_line_num" style="background-color:#DDDDDD;" readonly="readonly" value=""></td>
</tr>
<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">Description</p></font></td>
<td><span class="tabletext"><input type="text" name="descr" id="descr"  size=20 style="background-color:#DDDDDD;" readonly="readonly" value=""></td>
<td colspan=2></td>
</tr>
<tr bgcolor="#FFFFFF">
<input type="hidden"  name="aps_num" id="aps_num" size=15 value="">
<input type="hidden" id="aps_iss" name="aps_iss" size=15 value="">
<div id="fair_crn_prev_stat"></div>
 </tr>

</table>
<div id="bomli">
<table id="myTable" width=100%  border=0 cellpadding=3 cellspacing=1 bgcolor="#FFFFFF">
<!--
<tr bgcolor="#DDDEDD">
<td bgcolor="#DDDEDD" colspan=13><span class="heading"><center><b>Part Details</b></center></td>
</tr>
<tr>
<td bgcolor="#EEEFEE" width=3%><span class="heading"><b>Line</b></td>
<td bgcolor="#EEEFEE" width=4%><span class="heading"><b>Item No</b></td>
<td bgcolor="#EEEFEE" width=10%><span class="heading"><b>Part#</b></td>
<td bgcolor="#EEEFEE" width=10%><span class="heading"><b>Part Issue</b></td>
<td bgcolor="#EEEFEE" width=12%><span class="heading"><b>Description</b></td>
<td bgcolor="#EEEFEE" width=4%><span class="heading"><b>Qty/Assy</b></td>
<td bgcolor="#EEEFEE" width=6%><span class="heading"><b>UOM</b></td>
<td bgcolor="#EEEFEE" width=5%><span class="heading"><b>Qty<br>For WO</b></td>
<td bgcolor="#EEEFEE" width=6%><span class="heading"><b>GRN</b></td>
<td bgcolor="#EEEFEE" width=8%><span class="heading"><b>Expiry Date</b></td>
<td bgcolor="#EEEFEE" width=15%><span class="heading"><b>Remarks</b></td>
</tr>  -->
<?php
/*$i=1;
while ($i<=5)
{
   printf('<tr bgcolor="#FFFFFF">');
   $linenumber="line_num" . $i;
   $itemno="itemno" . $i;
   $partnum="partnum" . $i;
   $issue="issue" . $i;
   $descr="descr" . $i;
   $partiss="partiss" . $i;
   $qty="qty" . $i;
   $uom="uom" . $i;
   $qty_wo="qty_wo" . $i;
   $grn="grn" . $i;
   //$custpo_date="custpo_date" . $i;
   $qty="qty" . $i;
   $exp_date="exp_date" . $i;
   $remarks="remarks_li" . $i;
   $qty_rew="qty_rew" . $i;
   $qty_rej="qty_rej" . $i;
   $crn_num4li="crn_num4li".$i;
   $type = "type" . $i;
   $crn_type = "crn_type" . $i;
   echo "<td><span class=\"tabletext\"><input type=\"text\" id=\"$linenumber\"  name=\"$linenumber\"  value=\"\" size=\"3%\"></td>";
   echo "<td><input type=\"text\" id=\"$itemno\" name=\"$itemno\"  size=\"6%\" value=\"\">";
   echo "<td><input type=\"text\" id=\"$type\" name=\"$type\"  size=\"6%\" value=\"\">";
   echo "<td><input type=\"text\" id=\"$partnum\" name=\"$partnum\"  size=\"20%\" value=\"\"></td>";
   echo "<td><input type=\"text\" id=\"$issue\" name=\"$issue\"  size=\"15%\" value=\"\"></td>";
   echo "<td><input type=\"text\" id=\"$descr\" name=\"$descr\"  size=\"23%\" value=\"\"></td>";
   echo "<td><input type=\"text\" id=\"$qty\" name=\"$qty\"  size=\"5%\" value=\"\"></td>";
   echo "<td><input type=\"text\" id=\"$uom\" name=\"$uom\"  size=\"8%\" value=\"\"></td>";
   echo "<td><input type=\"text\" id=\"$qty_wo\" name=\"$qty_wo\"  size=\"6%\" value=\"\"></td>";
   echo "<td><input type=\"text\" id=\"$qty_rew\" name=\"$qty_rew\"  size=\"6%\" value=\"\"></td>";
   echo "<td><input type=\"text\" id=\"$qty_rej\" name=\"$qty_rej\"  size=\"6%\" value=\"\"></td>";
   echo "<td><input type=\"text\" id=\"$grn\" name=\"$grn\"  size=\"10%\" value=\"\"></td>";
   echo "<td><input type=\"text\" id=\"$exp_date\" name=\"$exp_date\"  size=\"8%\" value=\"\">";  */
   ?>
<!--<img src="images/bu-getdateicon.gif" alt="Get Expiry Date"  onclick="GetDate('<?php echo "$exp_date";?>')"></td>-->
<?php




  /* echo "<td><input type=\"text\" id=\"$remarks\" name=\"$remarks\"  size=\"27%\" value=\"\"></td>";
   printf('</tr>');
   $i++;
 }
   echo "<input type=\"hidden\" name=\"index\" value=$i>"; */
?>

<table id="myTable_oper" width=30%  border=0 cellpadding=3 cellspacing=1 bgcolor="#FFFFFF">
</table>
 
</div>
<input type="hidden" name="index" value="1">
<!-- <table id="processDets" width=93%  border=0 cellpadding=3 cellspacing=1 bgcolor="#FFFFFF" class="stdtable1">
<tr bgcolor="#DDDEDD">
<td bgcolor="#DDDEDD" colspan=13><span class="heading"><center><b>Process Details</b></center></td>
</tr>
<tr bgcolor="#FFFFFF">
<td colspan=13><span class="heading"><a href="javascript:addRowprodets('processDets',document.forms[0].index_pdets.value)"> <img src="images/bu-addrow.gif" border="0"></a></td>
</tr>
<tr  bgcolor="#FFFFFF">
<td bgcolor="#EEEFEE" width=3%><span class="heading"><b>Line</b></td>
<td bgcolor="#EEEFEE" width=15%><span class="heading"><b>Process</b></td>
<td bgcolor="#EEEFEE" width=30%><span class="heading"><b>Start Date & Time</b></td>
<td bgcolor="#EEEFEE" width=30%><span class="heading"><b>End Date & Time</b></td>
<td bgcolor="#EEEFEE" width=42%><span class="heading"><b>Other Details</b></td>
</tr> -->
<!--<div style="text-align:center; margin:150px auto 100px auto;">
        <label for="demo1">Please enter a date here &gt;&gt; </label>
        <input type="Text" id="demo1" maxlength="25" size="25"/>
        <img src="images2/cal.gif" onclick="javascript:NewCssCal('demo1','MMddyyyy','dropdown',true,'24',true)" style="cursor:pointer"/>
    </div>  -->
<!-- <?php

  
$j=1;
while ($j<=5)
{

   printf('<tr bgcolor="#FFFFFF">');
   $seqnumber="seqnumber" . $j;
   $process="process" . $j;
   $st_date_time="st_date_time" . $j;
   $end_date_time="end_date_time" . $j;
   $remarks_pdets="remarks_pdets" . $j;

   echo "<td><span class=\"tabletext\"><input type=\"text\" id=\"$seqnumber\"  name=\"$seqnumber\"  value=\"\" size=\"3%\"></td>";
   echo "<td><input type=\"text\" id=\"$process\" name=\"$process\"  size=\"15%\" value=\"\">";
   echo "<td><input type=\"text\" id=\"$st_date_time\" name=\"$st_date_time\"  size=\"30%\" style=\"background-color:#DDDDDD;\"
                    readonly=\"readonly\" value=\"\">
   <img src=\"images/bu-getdateicon.gif\" onclick=\"javascript:NewCssCal('$st_date_time','yyyyMMdd','dropdown',true,'24',true)\" style=\"cursor:pointer\"/></td>";
   echo "<td><input type=\"text\" id=\"$end_date_time\" name=\"$end_date_time\"  size=\"30%\" style=\"background-color:#DDDDDD;\"
                    readonly=\"readonly\" value=\"\">
   <img src=\"images/bu-getdateicon.gif\" onclick=\"javascript:NewCssCal('$end_date_time','yyyyMMdd','dropdown',true,'24',true)\" style=\"cursor:pointer\"/></td>";
   echo "<td><textarea id=\"$remarks_pdets\" name=\"$remarks_pdets\"  rows=2 cols=30></textarea></td>";
   printf('</tr>');
   $j++;
 }
   echo "<input type=\"hidden\" name=\"index_pdets\" value=$j>";
   echo "<input type=\"hidden\" name=\"cur_index_pdets\" value=$j>";
?>
</table> -->

<?php

   include("inassyentry.php");
?>

<input type="hidden" id="page" name="page" value="new">
 <table border=0 style="width:100%" cellspacing=1 cellpadding=3 class="stdtable1" bgcolor="#DFDEDF">

        <tr>
            <td colspan=6><span class="heading"><center><b>Timeline</b></center></td>
        </tr>

      <tr bgcolor="#FFFFFF">
            <td><span class="tabletext"><p align="left"><b>Sch Due Date</b></p></font></td>
            <td><input type="text" id="sch_due_date" name="sch_due_date"
                    style="background-color:#DDDDDD;"
                    readonly="readonly" size=12 value="">
             <img src="images/bu-getdateicon.gif" onclick="javascript:NewCssCal('sch_due_date','yyyyMMdd')" style="cursor:pointer"/>
            </td>
            <td><span class="tabletext"><p align="left"><b>Revised Completed Date</b></p></font></td>
            <td><input type="text" id="rev_ship_date" name="rev_ship_date"
                    style="background-color:#DDDDDD;"
                    readonly="readonly" size=12 value="">
            <img src="images/bu-getdateicon.gif" onclick="javascript:NewCssCal('rev_ship_date','yyyyMMdd')" style="cursor:pointer"/>
            </td>
            <td><span class="tabletext"><p align="left"><b>Date Code</b></p></font></td>
            <td><input type="text"  id="act_ship_date" name="act_ship_date"
                    style="background-color:#DDDDDD;"
                    readonly="readonly" size=12 value="">
             <img src="images/bu-getdateicon.gif" onclick="javascript:NewCssCal('act_ship_date','yyyyMMdd')" style="cursor:pointer"/>
            </td>

      </tr>
  </table>
<!-- </table> -->


  <table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3 align=center>
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
 
<?php
$i=1;
$wotype = 'Ripple';
$wfcnt=$newWF->getcountWF($wotype,'WO');
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
        $link2wfconfig="link2wfconfig" . $i;
?>


          <tr bgcolor="#FFFFFF">
            <td  bgcolor=#FFFFFF><span class=tabletext><input type=checkbox name=<?php echo "$chknm";?> value=""  onclick="Setmax(<?php echo "$i";?>)" checked></td>
            <td><span class="heading"><?php echo $myrow[2] ?></td>
            <td><span class="heading"><?php echo $myrow[3] ?></td>
          <input type="hidden" name="<?php echo "$est";?>" value="<?php echo "$myrow[9]";?>">

            <td><input type="text" name="<?php echo $dates ?>" id="<?php echo $dates ?>" style="background-color:#DDDDDD;" readonly="readonly" size=10 value="">
              <img src="images/bu-getdate.gif" alt="Get Date" onclick='GetDate("<?php echo $dates ?>")'>
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
                 <input type="hidden" name="<?php echo $link2wfconfig ?>" value="<?php echo $myrow[4] ?>">
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

      <input type="hidden" name="wfcnt" value="<?php echo "$wfcnt";?>">


</table>



</td>
<!-- <td width="6"><img src="images/spacer.gif " width="6"> -->
<input type="hidden" id="pagename" name="pagename"
                    style="background-color:#DDDDDD;"
                    readonly="readonly" size=12 value="new_assywo">
                    <input type="hidden" id="dept" name="dept"
                    style="background-color:#DDDDDD;"
                    readonly="readonly" size=12 value="<?php echo $dept ?>"></td>
</tr>
<!-- <tr bgcolor="DEDFDE">
<td width="6"><img src="images/box-left-bottom.gif"></td>
<td><img src="images/spacer.gif " height="6"></td>
<td width="6"><img src="images/box-right-bottom.gif"></td>
</tr> -->
</table>

<span class="tabletext"><input type="submit"
                     style="color=#0066CC;background-color:#DDDDDD;width=130;"
                     value="Submit" name="submit" onclick="javascript: return check_req_fields()">
                <INPUT TYPE="RESET"
                     style="color=#0066CC;background-color:#DDDDDD;width=130;"
                     VALUE="Reset" onclick="javascript: putfocus()">

</FORM>
</body>
</html>

