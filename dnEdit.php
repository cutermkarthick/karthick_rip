<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = Mar 10, 2010                 =
// Filename: dnEdit.php                        =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 WMS                          =                 
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];

$_SESSION['pagename'] = 'dnEdit';
$page="Post Process: D Note";
//////session_register('pagename');
$dept=$_SESSION['department'];
// First include the class definition
include('classes/dnClass.php');
include('classes/dnliClass.php');
include('classes/displayClass.php');
$newDn = new dn;
$newLI = new dnli;
$newdisp = new display;
$delrecnum = $_REQUEST['recnum'];
$result = $newDn->getdeliverDetails($delrecnum);
$myrow4dn = mysql_fetch_row($result);
$liresult = $newLI->getLI($delrecnum);
$result_poqty = $newDn->getpoqty($myrow4dn[6],$myrow4dn[8]);
$myrow_poqty = mysql_fetch_row($result_poqty);
$result4dnsum = $newDn->getdnsum4po($myrow4dn[6],$myrow4dn[8]);
$myrow4dnsum_po = mysql_fetch_row($result4dnsum);
?>

<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/dn.js"></script>

<html>
<head>
<title>Edit Delivery</title>
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
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">
<form action='dnProcess.php' method='GET' enctype='multipart/form-data' onSubmit='Disable(this);'>
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
<table width=100% border=0 cellpadding=6 cellspacing=0  >
<tr><td>
<table width=100% border=0>
<tr>
<td><span class="pageheading"><b>Edit Delivery Note</b></td>
</tr>
</table>
<table style="width:100%" border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1">
<tr bgcolor="#FFFFFF">
<tr bgcolor="#EEEFEE"><td colspan=4><span class="heading"><center><b>General Information</b></center></td>
</tr>  </table>
<table style="width:100%" border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1">
<table style="width:100%" border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1">
<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">DN Number</p></font></td>
<td><span class="tabletext"><b><?php echo $myrow4dn[1] ?></b></td>
</td>
<td colspan=2>&nbsp</td>
</tr>
<tr bgcolor="#FFFFFF">
<?php
$newDn = new dn;
$result = $newDn->getVendors();
?>
<td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Sent for treatment To</p></font></td>
 <?php
 if($dept !='Stores' && $dept !='QA')
 {
 ?>
<td>
<select name='treat_to' id='treat_to'>
<option selected value="<? echo $myrow4dn[2]?>">
<?echo $myrow4dn[2]; ?>
<?php
if($dept != 'Stores')
{
 while($myrow = mysql_fetch_row($result))
 {
   printf('<option value= "%s">%s',$myrow[1],$myrow[1]);
 }
}
?>
</select>
<?php
}
else
{
?>
<td><input type="text" name="treat_to" id="treat_to" style=";background-color:#DDDDDD;"	readonly="readonly" size=50 value="<?php echo $myrow4dn[2]?>"></td>
<?php
}
?>
</td>
<input type="hidden" name="delrecnum" value="<?php echo $myrow4dn[0] ?>">
<td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>After treatment deliver To</p></font></td>
 <?php
 if($dept !='Stores' && $dept !='QA')
 {
 ?>
<td>
<select name='treat_deliver' id='treat_deliver'>
<option selected value="<? echo $myrow4dn[3]?>">
<?echo $myrow4dn[3]; ?>
</option>
<?php
$result1 = $newDn->getVendors();
if($dept != 'Stores')
{
 while ($myrow1 = mysql_fetch_row($result1)){
   printf('<option value= "%s">%s',$myrow1[1],$myrow1[1]);
 }
}
?>
</select>
<?php
}
else
{
?>
<td><input type="text" name="treat_deliver" id="treat_deliver" style=";background-color:#DDDDDD;"	readonly="readonly" size=50 value="<?php echo $myrow4dn[3]?>"></td>
<?php
}
?>
</td>
</tr>

<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>PRN</p></font></td>
 <?php
      if($dept != 'Stores')
      {
    ?>
<td><input type="text" name="crn"  size=20 value="<?echo $myrow4dn[4]?>" onchange="resetpo_wo()" style="background-color:#DDDDDD;" readonly="readonly"></td>
<?php
   }
   else
   {
 ?>
 <td><input type="text" name="crn"  size=20 value="<?echo $myrow4dn[4]?>" onchange="resetpo_wo()" style=";background-color:#DDDDDD;" readonly="readonly"></td>
 <?php
 }
 ?>
<td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Delivery Date</p></font></td>
<td><input type="text" id="deliver_date" name="deliver_date"
			 style=";background-color:#DDDDDD;"
			readonly="readonly" size=12 value="<?echo $myrow4dn[5]?>">
 <?php
      if($dept != 'Stores' && $dept != 'QA')
      {
    ?>
<img src="images/bu-getdateicon.gif" alt="Get Date"  onclick="GetDate('deliver_date')"></td>
<?php
     }
   ?>
</tr>

<!-- <tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>PO Num</p></font></td>
<td><input type="text" id="ponum" name="ponum"
			 style=";background-color:#DDDDDD;"
			readonly="readonly" size=20 value="<?echo $myrow4dn[6]?>">
    <?php
      if($dept != 'Stores' && $dept != 'QA')
      {
    ?>
     <img src="images/bu-getpo.gif" alt="Get Date"  onclick="Getpo_num()"></td>
    <?php
      }
    ?>
</td> -->
<!-- <td><span class="labeltext"><p align="left">PO Date</p></font></td>
<td><input type="text" id="podate" name="podate"
			 style=";background-color:#DDDDDD;"
			readonly="readonly" size=12 value="<?echo $myrow4dn[7]?>"></td>
</td>
</tr> -->

<tr bgcolor="#FFFFFF">
<!-- <td><span class="labeltext"><p align="left">PO Line # </p></font></td>
<td><input type="text" name="poline_num" id="poline_num" style=";background-color:#DDDDDD;"	readonly="readonly" size=20 value="<?echo $myrow4dn[8]?>"></td> -->
<td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>WO #</p></font>
<td colspan=5><input type="text" id="wonum" name="wonum" id="wonum"
			 style=";background-color:#DDDDDD;"
			readonly="readonly" size=12 value="<?echo $myrow4dn[9]?>">
     <?php
       if($dept != 'Stores' && $myrow4dn[1] == 'DN1710')
      {
     ?>
     <img src="images/bu_getwo.gif" alt="Get WO" onclick="Getwo_dn()"></td>
     <?php
     }
     ?>
</td>
</tr>

<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">Untreated Part # </p></font></td>
<td><input type="text" name="untreated_partnum" id="untreated_partnum" style=";background-color:#DDDDDD;"	readonly="readonly" size=20 value="<?echo $myrow4dn[10]?>"></td>
<td><span class="labeltext"><p align="left">Treated Part # </p></font></td>
<td><input type="text" name="treated_partnum"  id="treated_partnum" style=";background-color:#DDDDDD;"	readonly="readonly" size=20 value="<?echo $myrow4dn[11]?>"></td>
</tr>

<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">Part Iss</p></font></td>
<td><input type="text" name="part_iss"  id="part_iss" style=";background-color:#DDDDDD;"	readonly="readonly" size=20 value="<?echo $myrow4dn[12]?>"></td>
<td><span class="labeltext"><p align="left">Drg Iss </p></font></td>
<td><input type="text" name="drg_iss"  id="drg_iss" style=";background-color:#DDDDDD;"	readonly="readonly" size=20 value="<?echo $myrow4dn[13]?>"></td>
</tr>

<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">COS</p></font></td>
<td><input type="text" name="cos" id="cos" style=";background-color:#DDDDDD;"	readonly="readonly" size=20 value="<?echo $myrow4dn[14]?>"></td>
<td><span class="labeltext"><p align="left">Mtl Spec </p></font></td>
<td><input type="text" name="mtl_spec" id="mtl_spec" style=";background-color:#DDDDDD;"	readonly="readonly" size=20 value="<?echo $myrow4dn[15]?>"></td>
</tr>

<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">GRN</p></font></td>
<td><input type="text" name="grn_num" id="grn_num" style=";background-color:#DDDDDD;"	readonly="readonly" size=20 value="<?echo $myrow4dn[16]?>"></td>
<td><span class="labeltext"><p align="left">Batch Num </p></font></td>
<td><input type="text" name="batch_num" id="batch_num" style=";background-color:#DDDDDD;"	readonly="readonly" size=20 value="<?echo $myrow4dn[17]?>"></td>
</tr>

<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">Qty</p></font></td>
<?php
   if($dept != 'Stores' && $dept != 'QA')
   {
?>
<td><input type="text" name="qty" id="qty" style=";background-color:#DDDDDD;"   readonly="readonly" size=20 value="<?echo $myrow4dn[18]?>">
<input type="hidden" name="qty_prev" id="qty_prev"  value="<?echo $myrow4dn[18]?>"</td>
  <?php
    }
    else
    {
  ?>
  <td><input type="text" name="qty" id="qty" size=20 value="<?echo $myrow4dn[18]?>" style=";background-color:#DDDDDD;"	readonly="readonly"></td>
  <?php
    }
  ?>
<td><span class="labeltext"><p align="left">Status</p></font></td>
<?php
   if($dept != 'Stores')
   {
?>
<td><span class="labeltext">
<select id="status" name="status">
<?
$status=array('Open','Closed');
for($j=0;$j<count($status);$j++)
{					
if($status[$j] == $myrow4dn[22]){?>
<option selected value="<? echo $status[$j]?>"><?echo $status[$j]; ?> 
</option>
<?}
else{?>
<option value="<? echo $status[$j]?>"><?echo $status[$j]; ?> 
</option>
<?}
}?>
</select>
<?php
}
else
{
?>
  <td><input type="text" name="status" id="status" size=12 value="<?echo $myrow4dn[22]?>" style=";background-color:#DDDDDD;"	readonly="readonly">

<?php
}
?>
</td>
</tr>
<tr bgcolor="#FFFFFF">
<!-- <td><span class="labeltext"><p align="left">PO Qty</p></font></td>
<td><input type="text" name="pur_qty" id="pur_qty" style=";background-color:#DDDDDD;"	readonly="readonly" size=8 value="<?php echo $myrow4dn[23]?>"></td> -->
<td><span class="labeltext"><p align="left">Type</p></font></td>
<td colspan=5><input type="text" name="type" id="type" style=";background-color:#DDDDDD;"	readonly="readonly" size=8 value="<?php echo $myrow4dn[24]?>"></td>
</tr>
 <tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">Remarks</p></font></td>
<?php
if($dept != 'Stores')
{
?>
<td colspan=3><textarea name="remarks" rows="3"
			      style="background-color:#FFFFFF;"
			      cols="100"><?php echo $myrow4dn[21] ?></textarea></td>
<?php
}
 else
 {
?>
 <td colspan=3><textarea name="remarks" rows="3"
         style=";background-color:#DDDDDD;"	readonly="readonly"
			      cols="100"><?php echo $myrow4dn[21] ?></textarea></td>
<?php
 }
?>
</tr>


<input type="hidden" name="page" id="page" value="edit">
<input type="hidden" name="dept" id="dept" value="<?php echo $dept?>">
<input type="hidden" name="unitprice" id="unitprice" value="<?php echo $myrow4dn[26] ?>">
<br>
<tr bgcolor="#DDDEDD">
<tr bgcolor="#FFFFFF"><td colspan=7><a href="javascript:addRow('myTable',document.forms[0].index.value)"><img name="Image7" border="0" src="images/bu-addrow.gif"></a></td></tr>
<td bgcolor="#DDDEDD" colspan=7><span class="heading"><center><b>Receipts Line Items</b></center></td>
</tr>
</table>
</table>
<div style="width:100%;overflow-x:scroll">
<table id="myTable" width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1">
<tr>
<td bgcolor="#EEEFEE" width=3%><span class="heading"><b>Line</b></td>
<td bgcolor="#EEEFEE" width=3%><span class="heading"><b>Dn Stage</b></td>
<td bgcolor="#EEEFEE" width=6%><span class="heading"><b><span class='asterisk'>*</span>CofC #</b></td>
<td bgcolor="#EEEFEE" width=6%><span class="heading"><b><span class='asterisk'>*</span>Cofc Date</b></td>
<td bgcolor="#EEEFEE" width=6%><span class="heading"><b>Cost</b></td>
<td bgcolor="#EEEFEE" width=6%><span class="heading"><b>Qty Recd</b></td>
<!--<td bgcolor="#EEEFEE" width=6%><span class="heading"><b>Qty Rej</b></td>
<td bgcolor="#EEEFEE" width=6%><span class="heading"><b>Qty Rew</b></td>-->
<td bgcolor="#EEEFEE" width=6%><span class="heading"><b>Supplier WO</b></td>
<td bgcolor="#EEEFEE" width=6%><span class="heading"><b>Date Code</b></td>
<td bgcolor="#EEEFEE" width=6%><span class="heading"><b>Qty Acc</b></td>
<td bgcolor="#EEEFEE" width=6%><span class="heading"><b>Qty Rew</b></td>
<td bgcolor="#EEEFEE" width=6%><span class="heading"><b>Qty Rej</b></td>
<td bgcolor="#EEEFEE" width=6%><span class="heading"><b>NC #</b></td>
<td bgcolor="#EEEFEE" width=6%><span class="heading"><b>Disp Qty</b></td>
<td bgcolor="#EEEFEE" width=10%><span class="heading"><b>Insp Stamp</b></td>
</tr>
<!-- echo "<td><span class=\"tabletext\">
<select id=\"$dn_stage\" name=\"$dn_stage\">
<option value='select'>Select</option>
<option  value='fi'>FI</option>    
<option value='stage'>Stage</option>    
</select>
</td>"; -->
<?php
$i=1;
$flag=0;
while ($i<=6)
{
  if($flag==0)
  {
   while ($myLI = mysql_fetch_row($liresult))
   {

 

   printf('<tr bgcolor="#FFFFFF">');
   $line_num="line_num" . $i;
   $dn_stage="dn_stage" . $i;
   $cofc_num="cofc_num" . $i;
   $cofc_date="cofc_date" . $i;
   $qty_recd="qty_recd" . $i;
   $qty_acc="qty_acc" . $i;
   $qty_rej="qty_rej" . $i;
   $insp_stamp="insp_stamp" . $i;
   $supp_wo="supp_wo" . $i;
   $datecode="datecode" . $i;
   $nc_num="nc_num" . $i;
    $disp_qty="disp_qty" . $i;
   $cost="cost" . $i;
  // $qty_rej4stores="qty_rej4stores" . $i;
   //$qty_rew="qty_rew" . $i;
   $prevlinenum="prev_line_num" . $i;
   $prev_qty_acc="prev_qty_acc" . $i;
   $lirecnum="lirecnum" . $i;
   $qty_rewqa="qty_rewqa" . $i;
   echo "<input type=\"hidden\" name=\"$prevlinenum\" value=\"$myLI[1]\">";
   echo "<input type=\"hidden\" name=\"$lirecnum\" value=\"$myLI[0]\">";
    echo "<input type=\"hidden\" id=\"$prev_qty_acc\"  name=\"$prev_qty_acc\"  value=\"$myLI[5]\">";
   if($dept == 'Stores')
   {
            
    echo "<td><span class=\"tabletext\"><input type=\"text\" id=\"$line_num\"  name=\"$line_num\"  value=\"$myLI[1]\" size=\"3%\" ></td>";
      echo "<td><span class=\"tabletext\"><input type=\"text\" id=\"$dn_stage\"  name=\"$dn_stage\"  value=\"$myLI[17]\" size=\"3%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></td>";
    echo "<td><span class=\"tabletext\"><input type=\"text\" id=\"$cofc_num\"  name=\"$cofc_num\"  value=\"$myLI[2]\" size=\"15%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></td>";
    echo "<td><input type=\"text\" id=\"$cofc_date\"  name=\"$cofc_date\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"
    size=\"10%\" value=\"$myLI[3]\"><img src=\"images/bu-getdateicon.gif\" alt=\"GetDate\"
           onclick=\"GetDate('$cofc_date')\"></td>";
    echo "<td><span class=\"tabletext\"><input type=\"text\" id=\"$cost\"  name=\"$cost\"  value=\"$myLI[12]\" size=\"10%\" onblur=\"javascript:check_cost()\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></td>";
    echo "<td><span class=\"tabletext\"><input type=\"text\" id=\"$qty_recd\"  name=\"$qty_recd\"  value=\"$myLI[4]\" size=\"10%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" ></td>";
    //echo "<td><span class=\"tabletext\"><input type=\"text\" id=\"$qty_rej4stores\"  name=\"$qty_rej4stores\"  value=\"$myLI[13]\" size=\"10%\" ></td>";
    //echo "<td><span class=\"tabletext\"><input type=\"text\" id=\"$qty_rew\"  name=\"$qty_rew\"  value=\"$myLI[14]\" size=\"10%\"></td>";
    echo "<td><span class=\"tabletext\"><input type=\"text\" id=\"$supp_wo\"  name=\"$supp_wo\"  value=\"$myLI[9]\" size=\"10%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></td>";
    echo "<td><input type=\"text\" id=\"$datecode\"  name=\"$datecode\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"
    size=\"10%\" value=\"$myLI[10]\"></td>";
    echo "<td><span class=\"tabletext\"><input type=\"text\" id=\"$qty_acc\"  name=\"$qty_acc\"  value=\"$myLI[5]\" size=\"10%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></td>";
       echo "<td><span class=\"tabletext\"><input type=\"text\" id=\"$qty_rewqa\"  name=\"$qty_rewqa\"  value=\"$myLI[15]\" size=\"10%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></td>";
    echo "<td><span class=\"tabletext\"><input type=\"text\" id=\"$qty_rej\"  name=\"$qty_rej\"  value=\"$myLI[6]\" size=\"10%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></td>";
    echo "<td><span class=\"tabletext\"><input type=\"text\" id=\"$nc_num\"  name=\"$nc_num\"  value=\"$myLI[11]\" size=\"10%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></td>";
    echo "<td><span class=\"tabletext\"><input type=\"text\" id=\"$disp_qty\"  name=\"$disp_qty\"  value=\"$myLI[16]\" size=\"10%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></td>";
    echo "<td><span class=\"tabletext\"><input type=\"text\" id=\"$insp_stamp\"  name=\"$insp_stamp\"  value=\"$myLI[7]\" size=\"10%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></td>";
    printf('</tr>');
    $i++;
   }
   else if($dept == 'QA')
   {

     echo "<td><span class=\"tabletext\"><input type=\"text\" id=\"$line_num\"  name=\"$line_num\"  value=\"$myLI[1]\" size=\"3%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></td>";

     echo "<td><span class=\"tabletext\"><input type=\"text\" id=\"$dn_stage\"  name=\"$dn_stage\"  value=\"$myLI[17]\" size=\"8%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></td>";
    echo "<td><span class=\"tabletext\"><input type=\"text\" id=\"$cofc_num\"  name=\"$cofc_num\"  value=\"$myLI[2]\" size=\"15%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></td>";
    echo "<td><input type=\"text\" id=\"$cofc_date\"  name=\"$cofc_date\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"
     size=\"10%\" value=\"$myLI[3]\"></td>";
    echo "<td><span class=\"tabletext\"><input type=\"text\" id=\"$cost\"  name=\"$cost\"  value=\"$myLI[12]\" size=\"10%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" onblur=\"javascript:check_cost()\"></td>";
    echo "<td><span class=\"tabletext\"><input type=\"text\" id=\"$qty_recd\"  name=\"$qty_recd\"  value=\"$myLI[4]\" size=\"10%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></td>";
        //echo "<td><span class=\"tabletext\"><input type=\"text\" id=\"$qty_rej4stores\"  name=\"$qty_rej4stores\"  value=\"$myLI[13]\" size=\"10%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></td>";
    //echo "<td><span class=\"tabletext\"><input type=\"text\" id=\"$qty_rew\"  name=\"$qty_rew\"  value=\"$myLI[14]\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" size=\"10%\"></td>";
   echo "<td><span class=\"tabletext\"><input type=\"text\" id=\"$supp_wo\"  name=\"$supp_wo\"  value=\"$myLI[9]\" size=\"10%\"></td>";
    echo "<td><input type=\"text\" id=\"$datecode\"  name=\"$datecode\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"
    size=\"10%\" value=\"$myLI[10]\"><img src=\"images/bu-getdateicon.gif\" alt=\"GetDate\"
           onclick=\"GetDate('$datecode')\"></td>";
    echo "<td><span class=\"tabletext\"><input type=\"text\" id=\"$qty_acc\"  name=\"$qty_acc\"  value=\"$myLI[5]\" size=\"10%\" ></td>";
    echo "<td><span class=\"tabletext\"><input type=\"text\" id=\"$qty_rewqa\"  name=\"$qty_rewqa\"  value=\"$myLI[15]\" size=\"10%\" ></td>";
   echo "<td><span class=\"tabletext\"><input type=\"text\" id=\"$qty_rej\"  name=\"$qty_rej\"  value=\"$myLI[6]\" size=\"10%\" ></td>";
    echo "<td><span class=\"tabletext\"><input type=\"text\" id=\"$nc_num\"  name=\"$nc_num\"  value=\"$myLI[11]\" size=\"10%\" ></td>";
    echo "<td><span class=\"tabletext\"><input type=\"text\" id=\"$disp_qty\"  name=\"$disp_qty\"  value=\"$myLI[16]\" size=\"10%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></td>";
    echo "<td><span class=\"tabletext\"><input type=\"text\" id=\"$insp_stamp\"  name=\"$insp_stamp\"  value=\"$myLI[7]\" size=\"10%\" ></td>";
    printf('</tr>');
    $i++;
   }
   else
   {

    echo "<td><span class=\"tabletext\"><input type=\"text\" id=\"$line_num\"  name=\"$line_num\"  value=\"$myLI[1]\" size=\"3%\"></td>";
    echo "<td><span class=\"tabletext\"><input type=\"text\" id=\"$dn_stage\"  name=\"$dn_stage\"  value=\"$myLI[17]\" size=\"8%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></td>";
    echo "<td><span class=\"tabletext\"><input type=\"text\" id=\"$cofc_num\"  name=\"$cofc_num\"  value=\"$myLI[2]\" size=\"15%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></td>";
    echo "<td><input type=\"text\" id=\"$cofc_date\"  name=\"$cofc_date\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"
    size=\"10%\" value=\"$myLI[3]\"><img src=\"images/bu-getdateicon.gif\" alt=\"GetDate\"
           onclick=\"GetDate('$cofc_date')\"></td>";
      echo "<td><span class=\"tabletext\"><input type=\"text\" id=\"$cost\"  name=\"$cost\"  value=\"$myLI[12]\" size=\"10%\" onblur=\"javascript:check_cost()\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></td>";
    echo "<td><span class=\"tabletext\"><input type=\"text\" id=\"$qty_recd\"  name=\"$qty_recd\"  value=\"$myLI[4]\" size=\"10%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></td>";
    //echo "<td><span class=\"tabletext\"><input type=\"text\" id=\"$qty_rej4stores\"  name=\"$qty_rej4stores\"  value=\"$myLI[13]\" size=\"10%\"></td>";
    //echo "<td><span class=\"tabletext\"><input type=\"text\" id=\"$qty_rew\"  name=\"$qty_rew\"  value=\"$myLI[14]\" size=\"10%\"></td>";
    echo "<td><span class=\"tabletext\"><input type=\"text\" id=\"$supp_wo\"  name=\"$supp_wo\"  value=\"$myLI[9]\" size=\"10%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></td>";
    echo "<td><input type=\"text\" id=\"$datecode\"  name=\"$datecode\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"
    size=\"10%\" value=\"$myLI[10]\"><img src=\"images/bu-getdateicon.gif\" alt=\"GetDate\"
           onclick=\"GetDate('$datecode')\"></td>";
    echo "<td><span class=\"tabletext\"><input type=\"text\" id=\"$qty_acc\"  name=\"$qty_acc\"  value=\"$myLI[5]\" size=\"10%\" onkeyup=\"javascript: return checkqty_recd(this)\" ></td>";
    echo "<td><span class=\"tabletext\"><input type=\"text\" id=\"$qty_rewqa\"  name=\"$qty_rewqa\"  value=\"$myLI[15]\" size=\"10%\"></td>";
    echo "<td><span class=\"tabletext\"><input type=\"text\" id=\"$qty_rej\"  name=\"$qty_rej\"  value=\"$myLI[6]\" size=\"10%\" ></td>";
    echo "<td><span class=\"tabletext\"><input type=\"text\" id=\"$nc_num\"  name=\"$nc_num\"  value=\"$myLI[11]\" size=\"10%\" ></td>";
   echo "<td><span class=\"tabletext\"><input type=\"text\" id=\"$disp_qty\"  name=\"$disp_qty\"  value=\"$myLI[16]\" size=\"10%\" ></td>";
    echo "<td><span class=\"tabletext\"><input type=\"text\" id=\"$insp_stamp\"  name=\"$insp_stamp\"  value=\"$myLI[7]\" size=\"10%\"></td>";
    printf('</tr>');
    $i++;
   }
 }
 $flag=1;
}
  printf('<tr bgcolor="#FFFFFF">');
   $line_num="line_num" . $i;
   $dn_stage="dn_stage" . $i;
   $cofc_num="cofc_num" . $i;
   $cofc_date="cofc_date" . $i;
   $qty_recd="qty_recd" . $i;
   $qty_acc="qty_acc" . $i;
   $qty_rej="qty_rej" . $i;
   $insp_stamp="insp_stamp" . $i;
   $supp_wo="supp_wo" . $i;
   $datecode="datecode" . $i;
   $nc_num="nc_num" . $i;
   $disp_qty="disp_qty" . $i;
   $cost="cost" . $i;
   $prevlinenum="prev_line_num" . $i;
   $lirecnum="lirecnum" . $i;
   $qty_rej4stores="qty_rej4stores" . $i;
   $prev_qty_acc = "prev_qty_acc" .$i;
   $qty_rew="qty_rew" . $i;
   $qty_rewqa="qty_rewqa" . $i;

   echo "<input type=\"hidden\" name=\"$prevlinenum\" value=\"\">";
   echo "<input type=\"hidden\" name=\"$lirecnum\" value=\"\">";
   echo "<input type=\"hidden\" name=\"$prev_qty_acc\" id=\"$prev_qty_acc\" value=\"\">";

   if($dept == 'Stores')
   {

    echo "<td><span class=\"tabletext\"><input type=\"text\" id=\"$line_num\"  name=\"$line_num\"  value=\"\" size=\"3%\"></td>";
     echo "<td><span class=\"tabletext\">
          <select id=\"$dn_stage\" name=\"$dn_stage\">
         <option value='select'>Select</option>
         <option  value='fi'>FI</option>    
           
          </select>
       </td>";
    echo "<td><span class=\"tabletext\"><input type=\"text\" id=\"$cofc_num\"  name=\"$cofc_num\"  value=\"\" size=\"15%\"></td>";

    echo "<td><input type=\"text\" id=\"$cofc_date\"  name=\"$cofc_date\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"
    size=\"10%\" value=\"\"><img src=\"images/bu-getdateicon.gif\" alt=\"GetDate\"
           onclick=\"GetDate('$cofc_date')\"></td>";
    echo "<td><span class=\"tabletext\"><input type=\"text\" id=\"$cost\"  name=\"$cost\"  value=\"\" size=\"10%\" onblur=\"javascript:check_cost()\"></td>";

    echo "<td><span class=\"tabletext\"><input type=\"text\" id=\"$qty_recd\"  name=\"$qty_recd\"  value=\"\" size=\"10%\"></td>";
    //echo "<td><span class=\"tabletext\"><input type=\"text\" id=\"$qty_rej4stores\"  name=\"$qty_rej4stores\"  value=\"\" size=\"10%\"></td>";
    //echo "<td><span class=\"tabletext\"><input type=\"text\" id=\"$qty_rew\"  name=\"$qty_rew\"  value=\"\" size=\"10%\"></td>";
    echo "<td><span class=\"tabletext\"><input type=\"text\" id=\"$supp_wo\"  name=\"$supp_wo\"  value=\"$myLI[9]\" size=\"10%\"style=\"background-color:#DDDDDD;\" readonly=\"readonly\" ></td>";
    
    echo "<td><input type=\"text\" id=\"$datecode\"  name=\"$datecode\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"
    size=\"10%\" value=\"$myLI[10]\"></td>";

    echo "<td><span class=\"tabletext\"><input type=\"text\" id=\"$qty_acc\"  name=\"$qty_acc\"  value=\"\" size=\"10%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></td>";
    echo "<td><span class=\"tabletext\"><input type=\"text\" id=\"$qty_rewqa\"  name=\"$qty_rewqa\"  value=\"\" size=\"10%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></td>";
    echo "<td><span class=\"tabletext\"><input type=\"text\" id=\"$qty_rej\"  name=\"$qty_rej\"  value=\"\" size=\"10%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></td>";
        echo "<td><span class=\"tabletext\"><input type=\"text\" id=\"$nc_num\"  name=\"$nc_num\"  value=\"\" size=\"10%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></td>";
    echo "<td><span class=\"tabletext\"><input type=\"text\" id=\"$disp_qty\"  name=\"$disp_qty\"  value=\"$myLI[16]\" size=\"10%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></td>";
    echo "<td><span class=\"tabletext\"><input type=\"text\" id=\"$insp_stamp\"  name=\"$insp_stamp\"  value=\"\" size=\"10%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></td>";
   
    printf('</tr>');
    $i++;
   }
   else if ($dept == 'QA')
   {
    echo "<td><span class=\"tabletext\"><input type=\"text\" id=\"$line_num\"  name=\"$line_num\"  value=\"\" size=\"3%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></td>";
     echo "<td><span class=\"tabletext\">
          <select id=\"$dn_stage\" name=\"$dn_stage\">
         <option value='select'>Select</option>
         <option  value='fi'>FI</option>    
            
          </select>
       </td>";
    echo "<td><span class=\"tabletext\"><input type=\"text\" id=\"$cofc_num\"  name=\"$cofc_num\"  value=\"\" size=\"15%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></td>";

    echo "<td><input type=\"text\" id=\"$cofc_date\"  name=\"$cofc_date\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"
      size=\"10%\" value=\"\"></td>";
    echo "<td><span class=\"tabletext\"><input type=\"text\" id=\"$cost\"  name=\"$cost\"  value=\"\" size=\"10%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" onblur=\"javascript:check_cost()\"></td>";

    echo "<td><span class=\"tabletext\"><input type=\"text\" id=\"$qty_recd\"  name=\"$qty_recd\"  value=\"\" size=\"10%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></td>";
    //echo "<td><span class=\"tabletext\"><input type=\"text\" id=\"$qty_rej4stores\"  name=\"$qty_rej4stores\"  value=\"\" size=\"10%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></td>";
    //echo "<td><span class=\"tabletext\"><input type=\"text\" id=\"$qty_rew\"  name=\"$qty_rew\"  value=\"\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" size=\"10%\"></td>";
    echo "<td><span class=\"tabletext\"><input type=\"text\" id=\"$supp_wo\"  name=\"$supp_wo\"  value=\"$myLI[9]\" size=\"10%\"></td>";
    
    echo "<td><input type=\"text\" id=\"$datecode\"  name=\"$datecode\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"
      size=\"10%\" value=\"$myLI[10]\"><img src=\"images/bu-getdateicon.gif\" alt=\"GetDate\"
           onclick=\"GetDate('$datecode')\"></td>";

    echo "<td><span class=\"tabletext\"><input type=\"text\" id=\"$qty_acc\"  name=\"$qty_acc\"  value=\"\" size=\"10%\" ></td>";
    echo "<td><span class=\"tabletext\"><input type=\"text\" id=\"$qty_rewqa\"  name=\"$qty_rewqa\"  value=\"\" size=\"10%\" ></td>";
    echo "<td><span class=\"tabletext\"><input type=\"text\" id=\"$qty_rej\"  name=\"$qty_rej\"  value=\"\" size=\"10%\"></td>";
    echo "<td><span class=\"tabletext\"><input type=\"text\" id=\"$nc_num\"  name=\"$nc_num\"  value=\"\" size=\"10%\" ></td>";
echo "<td><span class=\"tabletext\"><input type=\"text\" id=\"$disp_qty\"  name=\"$disp_qty\"  value=\"\" size=\"10%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" ></td>";
    echo "<td><span class=\"tabletext\"><input type=\"text\" id=\"$insp_stamp\"  name=\"$insp_stamp\"  value=\"\" size=\"10%\"></td>";

    printf('</tr>');
    $i++;
   }
   else
   {
     echo "<td><span class=\"tabletext\"><input type=\"text\" id=\"$line_num\"  name=\"$line_num\"  value=\"\" size=\"3%\"></td>";
        echo "<td><span class=\"tabletext\">
          <select id=\"$dn_stage\" name=\"$dn_stage\">
         <option value='select'>Select</option>
         <option  value='fi'>FI</option>    
            
          </select>
       </td>";
    echo "<td><span class=\"tabletext\"><input type=\"text\" id=\"$cofc_num\"  name=\"$cofc_num\"  value=\"\" size=\"15%\"></td>";

    echo "<td><input type=\"text\" id=\"$cofc_date\"  name=\"$cofc_date\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"
    size=\"10%\" value=\"\"><img src=\"images/bu-getdateicon.gif\" alt=\"GetDate\"
           onclick=\"GetDate('$cofc_date')\"></td>";
    echo "<td><span class=\"tabletext\"><input type=\"text\" id=\"$cost\"  name=\"$cost\"  value=\"\" size=\"10%\" onblur=\"javascript:check_cost()\"></td>";

    echo "<td><span class=\"tabletext\"><input type=\"text\" id=\"$qty_recd\"  name=\"$qty_recd\"  value=\"\" size=\"10%\"></td>";
    //echo "<td><span class=\"tabletext\"><input type=\"text\" id=\"$qty_rej4stores\"  name=\"$qty_rej4stores\"  value=\"\" size=\"10%\"></td>";
    //echo "<td><span class=\"tabletext\"><input type=\"text\" id=\"$qty_rew\"  name=\"$qty_rew\"  value=\"\" size=\"10%\"></td>";
    echo "<td><span class=\"tabletext\"><input type=\"text\" id=\"$supp_wo\"  name=\"$supp_wo\"  value=\"$myLI[9]\" size=\"10%\"></td>";
    
    echo "<td><input type=\"text\" id=\"$datecode\"  name=\"$datecode\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"
      size=\"10%\" value=\"$myLI[10]\"><img src=\"images/bu-getdateicon.gif\" alt=\"GetDate\"
           onclick=\"GetDate('$datecode')\"></td>";

    echo "<td><span class=\"tabletext\"><input type=\"text\" id=\"$qty_acc\"  name=\"$qty_acc\"  value=\"\" size=\"10%\"></td>";
    echo "<td><span class=\"tabletext\"><input type=\"text\" id=\"$qty_rewqa\"  name=\"$qty_rewqa\"  value=\"\" size=\"10%\" ></td>";
    echo "<td><span class=\"tabletext\"><input type=\"text\" id=\"$qty_rej\"  name=\"$qty_rej\"  value=\"\" size=\"10%\"></td>";
    echo "<td><span class=\"tabletext\"><input type=\"text\" id=\"$nc_num\"  name=\"$nc_num\"  value=\"\" size=\"10%\" ></td>";
    echo "<td><span class=\"tabletext\"><input type=\"text\" id=\"$disp_qty\"  name=\"$disp_qty\"  value=\"\" size=\"10%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></td>";
    echo "<td><span class=\"tabletext\"><input type=\"text\" id=\"$insp_stamp\"  name=\"$insp_stamp\"  value=\"\" size=\"10%\"></td>";

    printf('</tr>');
    $i++;
   }
}

    echo "<input type=\"hidden\" name=\"index\" value=$i>";
    //$cond4qty="m.CIM_refnum='".$myrow4dn[4]."'". ' and '. "dn.wonum='".$myrow4dn[9]."'";
    $cond4qty="m.CIM_refnum='".$myrow4dn[4]."'";
    $result4qty = $newDn->getwos4dnwo($cond4qty);
    $myrow4qty = mysql_fetch_row($result4qty);

?>

<input type="hidden" name="wo_qty" id="wo_qty" size=20 value="<?echo $myrow4dn[25] ?>">
<input type="hidden" name="sum_dnqty" id="sum_dnqty" size=20 value="<?echo $myrow4qty[11] ?>">
<input type="hidden" name="cur_qty" id="cur_qty" size=20 value="<?echo $myrow4dn[18] ?>">
<input type="hidden" name="totaldn4po" id="totaldn4po" size=20 value="<?echo $myrow4dnsum_po[0] ?>">
<input type="hidden" name="poqty" id="poqty" size=20 value="<?echo $myrow_poqty[0]?>">

</table>
</div>
</td>
<!-- <td width="6"><img src="images/spacer.gif " width="6"></td>
</tr>
<tr bgcolor="DEDFDE">
<td width="6"><img src="images/box-left-bottom.gif"></td>
<td><img src="images/spacer.gif " height="6"></td>
<td width="6"><img src="images/box-right-bottom.gif"></td>
</tr> -->
</table>
<table border = 0 cellpadding=0 cellspacing=0 width=100%>
<tr>
<td align=left>
</td>
</tr>
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
