<?php
session_start();
include('classes/bomClass.php');

$newbom = new bom;
$bomnum = $_REQUEST['bom'];
$crn = $_REQUEST['crn'];
$assy_qty=$_REQUEST['assy_qty'];
$assy_type=$_REQUEST['assy_type'];
$bomiss=$_REQUEST['bomiss'];
$recnum=$_REQUEST['recnum'];
//echo $assy_type."*-*--**-*-";

$result_oper =  $newbom->getbom_assyOper($bomnum,$bomiss);
?>

<table id="tablemm" width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1">
  <tr bgcolor="#FFFFFF">
    <td colspan=25><span class="heading"><a href="javascript:addRow4intassy('tablemm',document.forms[0].index.value)">
    <img src="images/bu-addrow.gif" border="0"></a></td>
  </tr>

   <tr>
   <td class="head0" width=3%><span class="heading"><b>Line#</b></span></span></td>
   <td class="head1" width=13%><span class="heading"><b>Type</b></span></td>
   <td class="head0" width=4%><span class="heading"><b>Item No</b></span></td>
   <td class="head1" width=10%><span class="heading"><b>PRN</b></span></td>
   <td class="head0" width=13%><span class="heading"><b>PRN Type</b></span></td>
   <td class="head1" width=10%><span class="heading"><b>Part#</b></span></td>
   <td class="head0" width=8%><span class="heading"><b>Part Issue</b></span></td>
   <td class="head1" width=30%><span class="heading"><b>Description</b></span></td>
   <td class="head0" width=4%><span class="heading"><b>Qty/Assy</b></span></td>
   <!-- <td class="head1" width=6%><span class="heading"><b>UOM</b></span></td> -->
   <td class="head1" width=8%><span class="heading"><b>Qty<br>For WO</b></span></td>
   <td class="head0" width=6%><span class="heading"><b>RMPO #</b></span></td>
   <td class="head1" width=6%><span class="heading"><b>RMPO LI #</b></span></td>
   <td class="head0" width=6%><span class="heading"><b>Cost</b></span></td>
   <td class="head1" width=6%><span class="heading"><b>GRN/WO</b></span></td>
   <td class="head0" width=8%><span class="heading"><b>Expiry Date</b></span></td>
   <td class="head1" width=6%><span class="heading"><b>Acc</b></span></td>
   <td class="head0" width=6%><span class="heading"><b>Rew</b></span></td>
   <td class="head1" width=6%><span class="heading"><b>Ret</b></span></td>
   <td class="head0" width=6%><span class="heading"><b>Rej</b></span></td>

   <td class="head1" width=15%><span class="heading"><b>NCR #</b></span></td>
   <td class="head0" width=10%><span class="heading"><b>Cofc #</b></span></td>
   <td class="head1" width=10%><span class="heading"><b>Supp wo #</b></span></td>


</tr>
<?php
$i=1; $crn_mfg=''; $n=1;$plinenum=0;
if($assy_type =='Assembly')
{
$result_part = $newbom->getbom_assyWo_partDetails($bomnum,$bomiss);


while ($myrow_li=mysql_fetch_row($result_part))
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

   $qty="qty" . $i;
   $qty_rew="qty_rew" . $i;
   $qty_rej="qty_rej" . $i;
   $exp_date="exp_date" . $i;
   $remarks_li="remarks_li" . $i;
   $type = "type" . $i;
   $qty_ret = "qty_ret" . $i;
   $qty_acc = "qty_acc" . $i;
   $crn_num4li = "crn_num4li" . $i;
   $prevlinenum="prev_line_num" . $i;
   $qty4wo=$assy_qty*$myrow_li[6];
   $crn_mfg=$myrow_li[5];
   $pcrn_num = "pcrn_num" . $i;
   $crn_type = "crn_type" . $i;
   $wpsrecnum = "wpsrecnum" . $i;

   $worecnum = "worecnum" . $i;
   $cofc_num = "cofc_num" . $i;
   $supplier_wo = "supplier_wo" . $i;
   $dnrecnum = "dnrecnum" . $i;
   $avail_qty = "avail_qty" . $i;
   $nc_num = "nc_num" . $i;

   $rmponum_li = "rmponum_li". $i;
   $cost_li = "cost_li". $i;
   $rmponum_linum = "rmponum_linum". $i;
   $ncrnum_li="ncrnum_li" . $i;

   echo "<input type=\"hidden\" name=\"$avail_qty\"  id=\"$avail_qty\" value=\"\">";
   echo "<input type=\"hidden\" name=\"$wpsrecnum\"  id=\"$wpsrecnum\" value=\"\">";

   echo "<input type=\"hidden\" name=\"$worecnum\" id=\"$worecnum\" value=\"\">";
   // echo "<input type=\"hidden\" name=\"$cofc_num\"  id=\"$cofc_num\" value=\"\">";
   // echo "<input type=\"hidden\" name=\"$supplier_wo\"  id=\"$supplier_wo\" value=\"\">";
   echo "<input type=\"hidden\" name=\"$dnrecnum\" id=\"$dnrecnum\"  value=\"\">";
   echo "<input type=\"hidden\" name=\"$nc_num\" id=\"$nc_num\"  value=\"\">";
   
   echo "<input type=\"hidden\" name=\"$prevlinenum\" value=\"\">";

   echo "<td width=3%><span class=\"tabletext\"><input type=\"text\" id=\"$linenumber\"  name=\"$linenumber\"  value=\"$i\" size=\"3%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></td>";

   echo "<td width=13%><span class=\"tabletext\"><input type=\"text\" id=\"$type\"  name=\"$type\"  value=\"$myrow_li[4]\" size=\"13%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></td>";

   echo "<td width=4%><input type=\"text\" id=\"$itemno\" name=\"$itemno\"  size=\"6%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"$myrow_li[0]\">";
   echo "<td width=10%><input type=\"text\" id=\"$crn_num4li\" name=\"$crn_num4li\"  size=\"6%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"$myrow_li[5]\">";

   echo "<td width=13%><span class=\"tabletext\"><input type=\"text\" id=\"$crn_type\"  name=\"$crn_type\"  value=\"$myrow_li[7]\" size=\"13%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></td>";
   echo "<input type=\"hidden\" id=\"$pcrn_num\"  name=\"$pcrn_num\"  value=\"\" size=\"13%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></td>";

   echo "<td width=10%><input type=\"text\" id=\"$partnum\" name=\"$partnum\"  size=\"20%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"$myrow_li[1]\"></td>";
   echo "<td width=8%><input type=\"text\" id=\"$issue\" name=\"$issue\"  size=\"15%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"$myrow_li[3]\"></td>";

   echo "<td width=30%><input type=\"text\" id=\"$descr\" name=\"$descr\"  size=\"23%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"$myrow_li[2] $myrow_li[8]\"></td>";
   echo "<td width=4%><input type=\"text\" id=\"$qty\" name=\"$qty\"  style=\"background-color:#DDDDDD;\" readonly=\"readonly\" size=\"5%\" value=\"$myrow_li[6]\"></td>";

   // echo "<td width=6%><input type=\"text\" id=\"$uom\" name=\"$uom\"  size=\"8%\" value=\"\"></td>";
   echo "<td width=8%><input type=\"text\" id=\"$qty_wo\" name=\"$qty_wo\"  size=\"5%\" value=\"$qty4wo\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></td>";

 if ($myrow_li[4] == "Bought Out" || $myrow_li[4] == "Consummables") 
   {
      echo "<td width=6%><input type=\"text\" id=\"$rmponum_li\" name=\"$rmponum_li\"  size=\"10%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"\"><img src=\"images/bu-get.gif\" alt=\"Get CIM\" onclick=\"GetRmpoNum4BOI('$myrow_li[4]',$i)\"></td>";  
   }
   else
   {
      echo "<td width=6%><input type=\"text\" id=\"$rmponum_li\" name=\"$rmponum_li\"  size=\"10%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"\"></td>";  
   }

      // <img src=\"images/bu-get.gif\" alt=\"Get CIM\" onclick=\"GetRmpoNum4BOI('$myrow_li[4]',$i)\">
   
   echo "<td width=6%><input type=\"text\" id=\"$rmponum_linum\" name=\"$rmponum_linum\"  size=\"10%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"\"></td>"; 


   echo "<td width=6%><input type=\"text\" id=\"$cost_li\" name=\"$cost_li\"  size=\"10%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"\"></td>";

   echo "<td width=6%><input type=\"text\" id=\"$grn\" name=\"$grn\"  size=\"10%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"\"><img src=\"images/bu-get.gif\" alt=\"Get CIM\" onclick=\"getgrn_wo($i)\"></td>";

   echo "<td width=8%><input type=\"text\" id=\"$exp_date\" name=\"$exp_date\"  size=\"8%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"\">";

   ?>
<img src="images/bu-getdateicon.gif" alt="Get Expiry Date"  onclick="javascript:NewCssCal('<?php echo "$exp_date";?>','yyyyMMdd')" ></td>
<?
   echo "<td width=5%><input type=\"text\" id=\"$qty_acc\" name=\"$qty_acc\"  size=\"4%\" value=\"\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></td>";
   echo "<td width=5%><input type=\"text\" id=\"$qty_rew\" name=\"$qty_rew\"  size=\"4%\" value=\"\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></td>";
   echo "<td width=5%><input type=\"text\" id=\"$qty_ret\" name=\"$qty_ret\"  size=\"4%\" value=\"\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></td>";
   echo "<td width=5%><input type=\"text\" id=\"$qty_rej\" name=\"$qty_rej\"  size=\"4%\" value=\"\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></td>";

   // echo "<td width=15%><input type=\"text\" id=\"$remarks_li\" name=\"$remarks_li\"  size=\"27%\" value=\"\"></td>";
   echo "<td width=15%><input type=\"text\" id=\"$ncrnum_li\" name=\"$ncrnum_li\"  size=\"9%\" value=\"\"></td>";
   echo "<td width=10%><input type=\"text\" id=\"$cofc_num\" name=\"$cofc_num\"  size=\"9%\" value=\"\"></td>";
   echo "<td width=10%><input type=\"text\" id=\"$supplier_wo\" name=\"$supplier_wo\"  size=\"9%\" value=\"\"></td>";

   printf('</tr>');

 $result_bo_crn = $newbom->getbom4assyWopartDetails($bomnum,$crn_mfg,$bomiss);

while($myrow_li4wo=mysql_fetch_row($result_bo_crn))
{  $i++;
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
   $qty_rew="qty_rew" . $i;
   $qty_rej="qty_rej" . $i;
   $exp_date="exp_date" . $i;
   $remarks_li="remarks_li" . $i;
   $type = "type" . $i;
   $qty_ret = "qty_ret" . $i;
   $qty_acc = "qty_acc" . $i;
   $crn_num4li = "crn_num4li" . $i;
   $prevlinenum="prev_line_num" . $i;
   $qty4wo=$assy_qty*$myrow_li[6];
   $pcrn_num = "pcrn_num" . $i;
    $crn_type = "crn_type" . $i;
       $wpsrecnum = "wpsrecnum" . $i;
   $worecnum = "worecnum" . $i;
   $cofc_num = "cofc_num" . $i;
   $supplier_wo = "supplier_wo" . $i;
      $dnrecnum = "dnrecnum" . $i;
          $avail_qty = "avail_qty" . $i;
          $nc_num = "nc_num" . $i;
      
    //$myrow_li[7]

   echo "<input type=\"hidden\" name=\"$wpsrecnum\"  id=\"$wpsrecnum\" value=\"\">";
 echo "<input type=\"hidden\" name=\"$avail_qty\"  id=\"$avail_qty\" value=\"\">";
   echo "<input type=\"hidden\" name=\"$worecnum\" id=\"$worecnum\" value=\"\">";
   // echo "<input type=\"hidden\" name=\"$cofc_num\"  id=\"$cofc_num\" value=\"\">";
   // echo "<input type=\"hidden\" name=\"$supplier_wo\"  id=\"$supplier_wo\" value=\"\">";
   echo "<input type=\"hidden\" name=\"$prevlinenum\" value=\"\">";
  echo "<input type=\"hidden\" name=\"$dnrecnum\" id=\"$dnrecnum\"  value=\"\">";
  echo "<input type=\"hidden\" name=\"$nc_num\" id=\"$nc_num\"  value=\"\">";
   echo "<td width=3%><span class=\"tabletext\"><input type=\"text\" id=\"$linenumber\"  name=\"$linenumber\"  value=\"\" size=\"3%\" ></td>";
   echo "<td width=13%><span class=\"tabletext\"><input type=\"text\" id=\"$type\"  name=\"$type\"  value=\"$myrow_li4wo[4]\" size=\"13%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></td>";
   echo "<td width=4%><input type=\"text\" id=\"$itemno\" name=\"$itemno\"  size=\"6%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"$myrow_li4wo[0]\">";
   echo "<td width=10%><input type=\"text\" id=\"$crn_num4li\" name=\"$crn_num4li\"  size=\"6%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"$myrow_li4wo[5]\">
   <input type=\"hidden\" id=\"$pcrn_num\" name=\"$pcrn_num\"  size=\"6%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"$crn_mfg\">";
   echo "<td width=13%><span class=\"tabletext\"><input type=\"text\" id=\"$crn_type\"  name=\"$crn_type\"  value=\"$myrow_li4wo[7]\" size=\"13%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></td>";
   echo "<td width=10%><input type=\"text\" id=\"$partnum\" name=\"$partnum\"  size=\"20%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"$myrow_li4wo[1]\"></td>";
   echo "<td width=8%><input type=\"text\" id=\"$issue\" name=\"$issue\"  size=\"15%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"$myrow_li4wo[3]\"></td>";
   echo "<td width=30%><input type=\"text\" id=\"$descr\" name=\"$descr\"  size=\"23%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"$myrow_li4wo[2] $myrow_li4wo[8]\"></td>";
   echo "<td width=4%><input type=\"text\" id=\"$qty\" name=\"$qty\"  style=\"background-color:#DDDDDD;\" readonly=\"readonly\" size=\"5%\" value=\"$myrow_li4wo[6]\"></td>";
   // echo "<td width=6%><input type=\"text\" id=\"$uom\" name=\"$uom\"  size=\"8%\" value=\"\"></td>";
   echo "<td width=8%><input type=\"text\" id=\"$qty_wo\" name=\"$qty_wo\"  size=\"5%\" value=\"$qty4wo\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></td>";

   echo "<td width=6%><input type=\"text\" id=\"$grn\" name=\"$grn\"  size=\"10%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"\"><img src=\"images/bu-get.gif\" alt=\"Get CIM\" onclick=\"getgrn_wo($i)\"></td>";
   echo "<td width=8%><input type=\"text\" id=\"$exp_date\" name=\"$exp_date\"  size=\"8%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"\">";
   ?>
<img src="images/bu-getdateicon.gif" alt="Get Expiry Date"  onclick="javascript:NewCssCal('<?php echo "$exp_date";?>','yyyyMMdd')" ></td>
<?php

   echo "<td width=5%><input type=\"text\" id=\"$qty_acc\" name=\"$qty_acc\"  size=\"4%\" value=\"\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></td>";
   echo "<td width=5%><input type=\"text\" id=\"$qty_rew\" name=\"$qty_rew\"  size=\"4%\" value=\"\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></td>";
   echo "<td width=5%><input type=\"text\" id=\"$qty_ret\" name=\"$qty_ret\"  size=\"4%\" value=\"\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></td>";
   echo "<td width=5%><input type=\"text\" id=\"$qty_rej\" name=\"$qty_rej\"  size=\"4%\" value=\"\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></td>";
   

   // echo "<td width=15%><input type=\"text\" id=\"$remarks_li\" name=\"$remarks_li\"  size=\"27%\" value=\"\"></td>";
   echo "<td width=15%><input type=\"text\" id=\"$ncrnum_li\" name=\"$ncrnum_li\"  size=\"9%\" value=\"\"></td>";
   echo "<td width=10%><input type=\"text\" id=\"$cofc_num\" name=\"$cofc_num\"  size=\"9%\" value=\"\"></td>";
   echo "<td width=10%><input type=\"text\" id=\"$supplier_wo\" name=\"$supplier_wo\"  size=\"9%\" value=\"\"></td>";


   printf('</tr>');

 }
   $i++;
 }
 }

else if($assy_type =='Rework')
{
$result_part = $newbom->getrework_assyWo_details($recnum);
while ($myrow_li=mysql_fetch_row($result_part))
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
   $qty_rew="qty_rew" . $i;
   $qty_rej="qty_rej" . $i;
   $exp_date="exp_date" . $i;
   $remarks_li="remarks_li" . $i;
   $type = "type" . $i;
   $qty_ret = "qty_ret" . $i;
   $qty_acc = "qty_acc" . $i;
   $crn_num4li = "crn_num4li" . $i;
   $prevlinenum="prev_line_num" . $i;
   $qty4wo=$assy_qty*$myrow_li[6];
   $crn_mfg=$myrow_li[5];
   $pcrn_num = "pcrn_num" . $i;
   $crn_type = "crn_type" . $i;
    $avail_qty = "avail_qty" . $i;
   $nc_num = "nc_num" . $i;
   
   echo "<input type=\"hidden\" name=\"$prevlinenum\" value=\"\">";
    echo "<input type=\"hidden\" name=\"$avail_qty\"  id=\"$avail_qty\" value=\"\">";
   echo "<input type=\"hidden\" name=\"$nc_num\" id=\"$nc_num\"  value=\"\">";
   echo "<td width=3%><span class=\"tabletext\"><input type=\"text\" id=\"$linenumber\"  name=\"$linenumber\"  value=\"$myrow_li[0]\" size=\"3%\" ></td>";
   echo "<td width=13%><span class=\"tabletext\"><input type=\"text\" id=\"$type\"  name=\"$type\"  value=\"$myrow_li[1]\" size=\"13%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></td>";
   echo "<td width=4%><input type=\"text\" id=\"$itemno\" name=\"$itemno\"  size=\"6%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"$myrow_li[2]\">";
   echo "<td width=10%><input type=\"text\" id=\"$crn_num4li\" name=\"$crn_num4li\"  size=\"6%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"$myrow_li[3]\">";
   echo "<td width=13%><span class=\"tabletext\"><input type=\"text\" id=\"$crn_type\"  name=\"$crn_type\"  value=\"$myrow_li[4]\" size=\"13%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></td>";
   echo "<input type=\"hidden\" id=\"$pcrn_num\"  name=\"$pcrn_num\"  value=\"\" size=\"13%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></td>";
   echo "<td width=10%><input type=\"text\" id=\"$partnum\" name=\"$partnum\"  size=\"20%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"$myrow_li[5]\"></td>";
   echo "<td width=8%><input type=\"text\" id=\"$issue\" name=\"$issue\"  size=\"15%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"$myrow_li[6]\"></td>";
   echo "<td width=30%><input type=\"text\" id=\"$descr\" name=\"$descr\"  size=\"23%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"$myrow_li[2] $myrow_li[7]\"></td>";
   echo "<td width=4%><input type=\"text\" id=\"$qty\" name=\"$qty\"  style=\"background-color:#DDDDDD;\" readonly=\"readonly\" size=\"5%\" value=\"$myrow_li[8]\"></td>";
   // echo "<td width=6%><input type=\"text\" id=\"$uom\" name=\"$uom\"  size=\"8%\" value=\"$myrow_li[9]\"></td>";
   echo "<td width=8%><input type=\"text\" id=\"$qty_wo\" name=\"$qty_wo\"  size=\"5%\" value=\"$myrow_li[10]\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></td>";

   echo "<td width=6%><input type=\"text\" id=\"$grn\" name=\"$grn\"  size=\"10%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"$myrow_li[15]\"><img src=\"images/bu-get.gif\" alt=\"Get CIM\" onclick=\"getgrn_wo($i)\"></td>";

  // echo "<td width=6%><input type=\"text\" id=\"$grn\" name=\"$grn\"  size=\"10%\" value=\"\"></td>";



   echo "<td width=8%><input type=\"text\" id=\"$exp_date\" name=\"$exp_date\"  size=\"8%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"$myrow_li[16]\">";
   ?>
<img src="images/bu-getdateicon.gif" alt="Get Expiry Date"  onclick="javascript:NewCssCal('<?php echo "$exp_date";?>','yyyyMMdd')" ></td>
<?php


   echo "<td width=5%><input type=\"text\" id=\"$qty_acc\" name=\"$qty_acc\"  size=\"4%\" value=\"$myrow_li[11]\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></td>";
   echo "<td width=5%><input type=\"text\" id=\"$qty_rew\" name=\"$qty_rew\"  size=\"4%\" value=\"$myrow_li[12]\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></td>";
   echo "<td width=5%><input type=\"text\" id=\"$qty_ret\" name=\"$qty_ret\"  size=\"4%\" value=\"$myrow_li[13]\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></td>";
   echo "<td width=5%><input type=\"text\" id=\"$qty_rej\" name=\"$qty_rej\"  size=\"4%\" value=\"$myrow_li[14]\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></td>";


   // echo "<td width=15%><input type=\"text\" id=\"$remarks_li\" name=\"$remarks_li\"  size=\"27%\" value=\"$myrow_li[17]\"></td>";
echo "<td width=15%><input type=\"text\" id=\"$ncrnum_li\" name=\"$ncrnum_li\"  size=\"9%\" value=\"\"></td>";
   echo "<td width=10%><input type=\"text\" id=\"$cofc_num\" name=\"$cofc_num\"  size=\"9%\" value=\"\"></td>";
   echo "<td width=10%><input type=\"text\" id=\"$supplier_wo\" name=\"$supplier_wo\"  size=\"9%\" value=\"\"></td>";

   printf('</tr>');

   $i++;
 }
 }



 else
 {
  $result_part = $newbom->getbom_assyWo_partDetails($bomnum,$bomiss);
  while ($myrow_li=mysql_fetch_row($result_part))
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
   $qty_rew="qty_rew" . $i;
   $qty_rej="qty_rej" . $i;
   $exp_date="exp_date" . $i;
   $remarks_li="remarks_li" . $i;
   $type = "type" . $i;
   $qty_ret = "qty_ret" . $i;
   $qty_acc = "qty_acc" . $i;
   $crn_num4li = "crn_num4li" . $i;
   $prevlinenum="prev_line_num" . $i;
   $qty4wo=$assy_qty*$myrow_li[6];
   $crn_mfg=$myrow_li[5];
   $pcrn_num = "pcrn_num" . $i;
   $crn_type = "crn_type" . $i;
   $dnrecnum = "dnrecnum" . $i;
    $nc_num = "nc_num" . $i;
    $avail_qty = "avail_qty" . $i;
   
   echo "<input type=\"hidden\" name=\"$prevlinenum\" value=\"\">";
   echo "<input type=\"hidden\" name=\"$avail_qty\"  id=\"$avail_qty\" value=\"\">";
   echo "<input type=\"hidden\" name=\"$dnrecnum\" id=\"$dnrecnum\"  value=\"\">";
   echo "<input type=\"hidden\" name=\"$nc_num\" id=\"$nc_num\"  value=\"\">";
   echo "<td width=3%><span class=\"tabletext\"><input type=\"text\" id=\"$linenumber\"  name=\"$linenumber\"  value=\"\" size=\"3%\" ></td>";
   echo "<td width=13%><span class=\"tabletext\"><input type=\"text\" id=\"$type\"  name=\"$type\"  value=\"$myrow_li[4]\" size=\"13%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></td>";
   echo "<td width=4%><input type=\"text\" id=\"$itemno\" name=\"$itemno\"  size=\"6%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"$myrow_li[0]\">";
   echo "<td width=10%><input type=\"text\" id=\"$crn_num4li\" name=\"$crn_num4li\"  size=\"6%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"$myrow_li[5]\">";
   echo "<td width=13%><span class=\"tabletext\"><input type=\"text\" id=\"$crn_type\"  name=\"$crn_type\"  value=\"$myrow_li[7]\" size=\"13%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></td>";
   echo "<input type=\"hidden\" id=\"$pcrn_num\"  name=\"$pcrn_num\"  value=\"\" size=\"13%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></td>";
   echo "<td width=10%><input type=\"text\" id=\"$partnum\" name=\"$partnum\"  size=\"20%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"$myrow_li[1]\"></td>";
   echo "<td width=8%><input type=\"text\" id=\"$issue\" name=\"$issue\"  size=\"15%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"$myrow_li[3]\"></td>";
   echo "<td width=30%><input type=\"text\" id=\"$descr\" name=\"$descr\"  size=\"23%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"$myrow_li[2] $myrow_li[8]\"></td>";
   echo "<td width=4%><input type=\"text\" id=\"$qty\" name=\"$qty\"  style=\"background-color:#DDDDDD;\" readonly=\"readonly\" size=\"5%\" value=\"$myrow_li[6]\"></td>";
   // echo "<td width=6%><input type=\"text\" id=\"$uom\" name=\"$uom\"  size=\"8%\" value=\"\"></td>";
   echo "<td width=8%><input type=\"text\" id=\"$qty_wo\" name=\"$qty_wo\"  size=\"5%\" value=\"$qty4wo\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></td>";

     echo "<td width=6%><input type=\"text\" id=\"$grn\" name=\"$grn\"  size=\"10%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"\"><img src=\"images/bu-get.gif\" alt=\"Get CIM\" onclick=\"getgrn_wo($i)\"></td>";
  // echo "<td width=6%><input type=\"text\" id=\"$grn\" name=\"$grn\"  size=\"10%\" value=\"\"></td>";
   echo "<td width=8%><input type=\"text\" id=\"$exp_date\" name=\"$exp_date\"  style=\"background-color:#DDDDDD;\" readonly=\"readonly\" size=\"8%\" value=\"\">";
   ?>
<img src="images/bu-getdateicon.gif" alt="Get Expiry Date"  onclick="javascript:NewCssCal('<?php echo "$exp_date";?>','yyyyMMdd')" ></td>
<?php



   echo "<td width=5%><input type=\"text\" id=\"$qty_acc\" name=\"$qty_acc\"  size=\"4%\" value=\"\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></td>";
   echo "<td width=5%><input type=\"text\" id=\"$qty_rew\" name=\"$qty_rew\"  size=\"4%\" value=\"\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></td>";
   echo "<td width=5%><input type=\"text\" id=\"$qty_ret\" name=\"$qty_ret\"  size=\"4%\" value=\"\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></td>";
   echo "<td width=5%><input type=\"text\" id=\"$qty_rej\" name=\"$qty_rej\"  size=\"4%\" value=\"\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></td>";
 

   // echo "<td width=15%><input type=\"text\" id=\"$remarks_li\" name=\"$remarks_li\"  size=\"27%\" value=\"\"></td>";
echo "<td width=15%><input type=\"text\" id=\"$ncrnum_li\" name=\"$ncrnum_li\"  size=\"9%\" value=\"\"></td>";
   echo "<td width=10%><input type=\"text\" id=\"$cofc_num\" name=\"$cofc_num\"  size=\"9%\" value=\"\"></td>";
   echo "<td width=10%><input type=\"text\" id=\"$supplier_wo\" name=\"$supplier_wo\"  size=\"9%\" value=\"\"></td>";

   printf('</tr>');


   $i++;
 }


 }

       echo "<input type=\"hidden\" name=\"index\" value=$i>";
       echo "<input type=\"hidden\" name=\"index_add\" value=$n>";

?>
</table>
