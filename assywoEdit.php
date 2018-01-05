<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = Feb 23, 2010                 =
// Filename: assywoEdit.php                    =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 WMS                          =
// Allows entry of Assembly Po's               =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
    header ( "Location: login.php" );

}
$userid = $_SESSION['user'];

$_SESSION['pagename'] = 'assyWoEdit';
$page="WO: Assy WO";
//////session_register('pagename');
$dept=$_SESSION['department'];
$edept=$_SESSION['department'];

$assyworecnum = $_REQUEST['assyworecnum'];  

// First include the class definition
//include('classes/assyWoClass.php');
include('classes/displayClass.php');
include('classes/companyClass.php');
include('classes/assywoClass.php');
include('classes/assywoliClass.php');
include('classes/assywoli_operClass.php');
include('classes/bomClass.php');
include('classes/inassyClass.php');
include('classes/assyProcessDetailsClass.php');
include('classes/assywo_flowClass.php');

//$newassyWo = new assyWo;
$newdisp = new display;
$company = new company;
$assywo = new assywo;
$assywo_li = new assywo_li;
$assywo_oper = new assywo_oper;
$assywo_pdet = new assywoprocessdetails;
$bom = new bom;
$newinassy = new inassy;
$assywo_flow = new assywo_flow;

$result_assywo = $assywo->getAssyWos($assyworecnum);
$result_assywoprdet = $assywo_pdet->getAssyWoprdet($assyworecnum);

$myrow = mysql_fetch_assoc($result_assywo);
?>
<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/assywo.js"></script>
<script language="javascript" src="js/jquery-3.2.1.min.js"></script>

<html>
<head>
<title>Edit Assembly WO</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">
<form action='processAssywo.php' method='post' enctype='multipart/form-data'>
<?php
include('header.html');
?>

<td bgcolor="#FFFFFF">
<table width=100% border=0 cellpadding=6 cellspacing=0>
<tr><td>
<table width=100% border=0>
<tr>
<td><span class="pageheading"><b>Edit Assembly WO</b></td>
</tr>
</table>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1">
<tr bgcolor="#DDDEDD">
<tr bgcolor="#DDDEDD"><td colspan=4><span class="heading"><center><b>General Information</b></center></td>
</tr> </table>



<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1">
<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">Assy WO #</p></font></td>
<td><span class="tabletext"><input type="text"  name="assy_wonum" id="assy_wonum"
style="background-color:#DDDDDD;" readonly="readonly" value="<?php echo $myrow["assy_wonum"] ?>"></td>
<td><span class="labeltext"><p align="left">WO Date</p></font></td>
<td><span class="tabletext"><input size=10 type="text"  name="wo_date" id="wo_date"
 value="<?php echo $myrow["assydate"] ?>" style="background-color:#DDDDDD;" readonly="readonly">
<?php

if($dept !='QA' && $dept !='PPC5')
{
?>
    <img src="images/bu-getdateicon.gif" onclick="javascript:NewCssCal('wo_date','yyyyMMdd')" style="cursor:pointer"/>
    <?php
}
    ?></td>
	</tr>

    <tr bgcolor="#FFFFFF">
      <td><span class="labeltext"><p align="left">Assy WO Qty</p></font></td>
      <td><span class="tabletext"><input type="text"  name="assy_woqty" id="assy_woqty" size=8 value="<?php echo $myrow["assyqty"] ?>" ></td>
      <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Assy Type</p></font></td>
      <td><span class="tabletext"><input type="text" name="assy_type" id="assy_type" readonly="readonly"  style=";background-color:#DDDDDD;" value="<?php echo $myrow["assy_type"] ?>" size="10">
        <span class="tabletext">
          <select name="assytype" size="1" width="10" onchange="onSelectType(this)">
            <option value='Kit' <?php if($myrow["assy_type"] == "Kit"){ echo "selected='selected'"; } ?>>Kit</option>
            <option value='Assembly' <?php if($myrow["assy_type"] == "Assembly"){ echo "selected='selected'"; } ?>>Assembly</option>
  				  <option value='Rework' <?php if($myrow["assy_type"] == "Rework"){ echo "selected='selected'"; } ?>>Rework</option>
            <option value='Manufacture' <?php if($myrow["assy_type"] == "Manufacture"){ echo "selected='selected'"; } ?>>Manufacture</option>
          </select>
        </span>
      </td>
    </tr>

<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">PRN</p></font></td>
<td><input type="text" id="crn" name="crn" size=15 value="<?php echo $myrow["crn"] ?>" style="background-color:#DDDDDD;" readonly="readonly">

</td>
<td><span class="labeltext"><p align="left">Rework GRN</p></font></td>
<td><span class="tabletext"><input type="text" name="rework_grn" id="rework_grn" size=10 value="<?php echo $myrow["rework_grn"] ?>" style="background-color:#DDDDDD;" readonly="readonly">
</tr>
<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">BOM #</p></font></td>
<td><span class="tabletext"><input type="text" name="bomnum" id="bomnum" size=15 value="<?php echo $myrow["bomnum"] ?>" style="background-color:#DDDDDD;" readonly="readonly">
  <?php
if($dept !='QA' && $dept !='PPC5')
{
?>
<img src="images/bu-get.gif" alt="Get CIM" onclick="Getcim()">
<?php
 }
?>
<td><span class="labeltext"><p align="left">BOM Rev</p></font></td>
<td><span class="tabletext"><input type="text" name="bomiss" id="bomiss" size=10 value="<?php echo $myrow["bomiss"] ?>" style="background-color:#DDDDDD;" readonly="readonly">
</td>
</tr>
<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">Assy Part #</p></font></td>
<td><span class="tabletext"><input type="text"  name="assy_partno" id="assy_partno" size=20 value="<?php echo $myrow["assypartnum"] ?>" style="background-color:#DDDDDD;" readonly="readonly"></td>
<td><span class="labeltext"><p align="left">Assy Part Iss</p></font></td>
<td><span class="tabletext"><input type="text" name="assy_partiss" id="assy_partiss"  size=20 value="<?php echo $myrow["assypartiss"] ?>" style="background-color:#DDDDDD;" readonly="readonly"></td>
</tr>
<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">Dwg No</p></font></td>
<td><span class="tabletext"><input type="text"  name="drg_no" id="drg_no" size=12 value="<?php echo $myrow["drgno"] ?>" style="background-color:#DDDDDD;" readonly="readonly"></td>
<td><span class="labeltext"><p align="left">Drg Iss</p></font></td>
<td><input type="text" name="drg_iss" id="drg_iss"   size=10 value="<?php echo $myrow["drgiss"] ?>" style="background-color:#DDDDDD;" readonly="readonly"></td>
</tr>
<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">COS #</p></font></td>
<td colspan=3><span class="tabletext"><input type="text"  name="cos_num" id="cos_num" size=12 value="<?php echo $myrow["cosno"] ?>" style="background-color:#DDDDDD;" readonly="readonly"></td>
</tr>
<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">MPS/APS #</p></font></td>
<td><span class="tabletext"><input type="text"  name="mpsnumber" id="mpsnumber" size=12 value="<?php echo $myrow["mpsnumber"] ?>" style="background-color:#DDDDDD;" readonly="readonly"></td>
<td><span class="labeltext"><p align="left">MPS/APS Rev</p></font></td>
<td><input type="text" name="mpsrev" id="mpsrev"   size=10 value="<?php echo $myrow["mps_rev"] ?>"
style="background-color:#DDDDDD;" readonly="readonly">
<input type="hidden" name="link2mps" id="link2mps" value="<?php echo $myrow["link2mps"] ?>">
<input type="hidden" name="bomrevnum" id="bomrevnum" value="<?php echo $myrow["bomrevnum"] ?>"></td>
</tr>
<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Cust PO#</p></font></td>
<td><span class="tabletext">
<?php

if($dept !='QA' && $dept !='PPC5')
{
?>
<input type="text" size=15 name="cust_ponum" id="cust_ponum" value="<?php echo $myrow["ponum"] ?>" style="background-color:#DDDDDD;"
readonly="readonly">
<!-- <img src="images/bu-getpo.gif" onClick="Getpo('ponum')" id='poimg'> -->
<?php
}else
{
?>
<input type="text" size=15 name="cust_ponum" id="cust_ponum" style="background-color:#DDDDDD;"
readonly="readonly" value="<?php echo $myrow["ponum"] ?>" >
<?php
}
?>
</td>
<td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>PO Qty</p></font></td>
<td><span class="tabletext">
<?php
if($dept !='QA' && $dept !='PPC5')
{
?>
<input type="text"  size=5 name="po_qty" id="po_qty"value="<?php echo $myrow["poqty"] ?>" style="background-color:#DDDDDD;"
readonly="readonly">
<?php
}else
{
?>
<input type="text"  size=5 name="po_qty" id="po_qty" style="background-color:#DDDDDD;"
readonly="readonly" value="<?php echo $myrow["poqty"] ?>">
<?php
}
?>
</td>
</tr>
<input type="hidden" name="page"  id="page" value="edit">

<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">Customer</p></font></td>
<td width="30%"><input type="hidden"  name="customer" id="customer" size="30" style="background-color:#DDDDDD;"
readonly="readonly" value="<?php echo $myrow['crec']?>" >
<input type="text" name="companyname" id="companyname" size="30" style="background-color:#DDDDDD;"
readonly="readonly" value="<?php echo $myrow['name']?>">
<?php

if($dept !='QA' && $dept !='PPC5')
{
?>
<img src="images/bu-getcustomer.gif" alt="Get Customer" onClick="GetAllCustomers()">
<?php
}
?>
</td>
<td><span class="labeltext"><p align="left">Cust PO Line#</p></font></td>
<td><input type="text" size=5 name="cust_po_line_num" id="cust_po_line_num" style="background-color:#DDDDDD;" readonly="readonly" value="<?php echo $myrow["cust_po_line_num"] ?>"></td>

</tr>
<tr bgcolor="#FFFFFF">
<?php
if($dept =='QA')
{?>
<td><span class="labeltext"><p align="left">Description</p></font></td>
<td><span class="tabletext"><input type="text" name="descr" id="descr"  size=25 style="background-color:#DDDDDD;"
readonly="readonly" value="<?php echo $myrow["descr"] ?>"></td>
<?php
}
else
{?>
<td><span class="labeltext"><p align="left">Description</p></font></td>
<td><span class="tabletext"><input type="text" name="descr" id="descr"  style="background-color:#DDDDDD;" readonly="readonly" size=25  value="<?php echo $myrow["descr"] ?>"></td>
<?php
}
if($dept =='PPC5')
{?>
    <td><span class="labeltext"><p align="left">WO Status</p></font></td>
    <td><input type="text" name="status" id="status" size=8 style="background-color:#DDDDDD;" readonly="readonly" value="<?php echo $myrow["status"]?>">
      <span class="tabletext">
        <select name="condtype" size="1" width="100" onchange="onSelectcond()">
          <option value="Open" <?php if($myrow["status"] =="Open"){ echo "selected='selected'"; } ?>>Open</option>
          <option value="Pending" <?php if($myrow["status"] =="Pending"){ echo "selected='selected'"; } ?>>Pending</option>
    			<option value="Closed" <?php if($myrow["status"] =="Closed"){ echo "selected='selected'"; } ?>>Closed</option>
          <option value="Cancelled" <?php if($myrow["status"] =="Cancelled"){ echo "selected='selected'"; } ?>>Cancelled</option>
       	</select>
      </span>
    </td>
<?php
}
else
{?>
      <td><span class="labeltext"><p align="left">WO Status</p></font></td>
      <td><input type="text" name="status" id="status" size=8 style="background-color:#DDDDDD;" readonly="readonly" value="<?php echo $myrow["status"]?>">
      <span class="tabletext">
        <select name="condtype" size="1" width="100" onchange="onSelectcond()">
          <option value="Open" <?php if($myrow["status"] =="Open"){ echo "selected='selected'"; } ?>>Open</option>
          <option value="Pending" <?php if($myrow["status"] =="Pending"){ echo "selected='selected'"; } ?>>Pending</option>
          <option value="Closed" <?php if($myrow["status"] =="Closed"){ echo "selected='selected'"; } ?>>Closed</option>
          <option value="Cancelled" <?php if($myrow["status"] =="Cancelled"){ echo "selected='selected'"; } ?>>Cancelled</option>
        </select>
      </span>
    </td>
<?php
}
?>
</tr>
<input type="hidden"  name="aps_num" id="aps_num" size=15 style="background-color:#DDDDDD;"
readonly="readonly" value="<?php echo $myrow["apsnum"] ?>">
<input type="hidden" id="aps_iss" name="aps_iss" size=15  style="background-color:#DDDDDD;"
readonly="readonly" value="<?php echo $myrow["apsiss"] ?>">
</tr>

</tr>
</tr>
</table>
<input type="hidden" name="assyworecnum" id="assyworecnum" value=<?php echo $assyworecnum?>>
<br>

</table>


<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1">
<tr bgcolor="#DDDEDD">
<td bgcolor="#DDDEDD" colspan=13><span class="heading"><center><b>Wo Notes</b></center></td>
</tr>
  <?php 
    $result = $assywo->getNotes4assywo($assyworecnum);
    echo "<tr bgcolor=\"#FFFFFF\"><td colspan=12>";
    echo "<textarea rows=\"6\" cols=\"89\" readonly=\"readonly\">";
    while ($mynotes4wo = mysql_fetch_row($result)) {
      printf("\n");
      printf("********Added by $mynotes4wo[2] on $mynotes4wo[0]*******");
      printf("\n");
      printf($mynotes4wo[1]);
      printf("   \n");
    }

    echo "</textarea></td>";
    echo "<tr>";
  ?>

  <tr bgcolor="#DDDEDD">
      <td colspan=4><span class="heading"><center><b>Add Notes</b></center></span></td>
  </tr>
  <tr bgcolor="#FFFFFF">
    <td colspan=8><textarea name="notes" id="notes" rows="3" cols="89" value=""></textarea></td> 
  </tr>


</table>


<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1">
<tr bgcolor="#DDDEDD">
<td bgcolor="#DDDEDD" colspan=13><span class="heading"><center><b>Part Details</b></center></td>
</tr>
</table>

  <div style="width:100%;overflow-x:scroll">
    <div id="bomli">
      <table id="tablemm" width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1">
        <tr bgcolor="#FFFFFF">
          <td colspan=25><span class="heading"><a href="javascript:addRow4intassy('tablemm',document.forms[0].index.value)">
          <img src="images/bu-addrow.gif" border="0"></a></td>
        </tr>

        <tr bgcolor="#FFFFFF">
          <td bgcolor="#EEEFEE" width=3%><span class="heading"><b>Line#</b></span></td>
          <td bgcolor="#EEEFEE" width=13%><span class="heading"><b>Type</b></span></td>
          <td bgcolor="#EEEFEE" width=4%><span class="heading"><b>Item No</b></span></td>
          <td bgcolor="#EEEFEE" width=10%><span class="heading"><b>PRN</b></span></td>
          <td bgcolor="#EEEFEE" width=10%><span class="heading"><b>PRN Type</b></span></td>
          <td bgcolor="#EEEFEE" width=10%><span class="heading"><b>Part#</b></span></td>
          <td bgcolor="#EEEFEE" width=10%><span class="heading"><b>Part Issue</b></span></td>
          <td bgcolor="#EEEFEE" width=12%><span class="heading"><b>Description</b></span></td>
          <td bgcolor="#EEEFEE" width=4%><span class="heading"><b>Qty/Assy</b></span></td>
          <td bgcolor="#EEEFEE" width=8%><span class="heading"><b>Qty<br>For WO</b></span></td>
          <td bgcolor="#EEEFEE" width=6%><span class="heading"><b>RMPO #</b></span></td>
          <td bgcolor="#EEEFEE" width=6%><span class="heading"><b>RMPO LI #</b></span></td>
          <td bgcolor="#EEEFEE" width=6%><span class="heading"><b>Cost</b></span></td>
          <td bgcolor="#EEEFEE" width=6%><span class="heading"><b>GRN/WO</b></span></td>
          <td bgcolor="#EEEFEE" width=8%><span class="heading"><b>Expiry Date</b></span></td>
          <td bgcolor="#EEEFEE" width=6%><span class="heading"><b>Acc</b></span></td>
          <td bgcolor="#EEEFEE" width=6%><span class="heading"><b>Rew</b></span></td>
          <td bgcolor="#EEEFEE" width=6%><span class="heading"><b>Ret</b></span></td>
          <td bgcolor="#EEEFEE" width=6%><span class="heading"><b>Rej</b></span></td>
          <td bgcolor="#EEEFEE" width=3%><span class="heading"><b>QA Ins</b></span></td>
          <td bgcolor="#EEEFEE" width=8%><span class="heading"><b>Apprve<br> Date</b></span></td>
          <td bgcolor="#EEEFEE" width=15%><span class="heading"><b>NCR #</b></span></td>
          <td bgcolor="#EEEFEE" width=6%><span class="heading"><b>Cofc #</b></span></td>
          <td bgcolor="#EEEFEE" width=6%><span class="heading"><b>Supp Wo #</b></span></td>
        </tr>
        
        <?php
          $i=1;
          $flag=0;
          $result_assyli = $assywo_li->get_assy_Li($assyworecnum);
          while ($myLI_assy = mysql_fetch_row($result_assyli))
          {
            if($myLI_assy[16] == 'Treated')
            {
              $resultdn = $assywo_li->getdnrecnum4assyli($myLI_assy[8]);
              $myrow = mysql_fetch_row($resultdn); 
            }

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
            $exp_date="exp_date" . $i;
            $remarks="remarks_li" . $i;
            $type="type".$i;
            $qty_rew="qty_rew" . $i;
            $qty_rej="qty_rej" . $i;
            $qty_acc="qty_acc" . $i;
            $crn_num4li = "crn_num4li" . $i;
            $prevlinenum="prev_line_num" . $i;
            $lirecnum="lirecnum" . $i;
            $type="type".$i;
            $qty_ret = "qty_ret" . $i;
            $pcrn_num = "pcrn_num" . $i;
            $crn_type = "crn_type" . $i;
            $prev_qty_wo="prev_qty_wo" . $i;
            $dnrecnum="dnrecnum" . $i;

            $avail_qty = "avail_qty" . $i;
            $rmponum_li = "rmponum_li". $i;
            $cost_li = "cost_li". $i;
            $rmponum_linum = "rmponum_linum". $i;
            $qainsp_app = "qainsp_app". $i;
            $qainsp_appdate = "qainsp_appdate". $i;
            $qainsp_appby = "qainsp_appby". $i;
            $ncrnum="ncrnum" . $i;
            $cofc_num = "cofc_num" . $i;
            $supplier_wo = "supplier_wo" . $i;
   
            echo "<input type=\"hidden\" name=\"$prevlinenum\" value=\"$myLI_assy[1]\">";
            echo "<input type=\"hidden\" name=\"$lirecnum\" value=\"$myLI_assy[0]\">";
            echo "<input type=\"hidden\" name=\"$dnrecnum\" id=\"$dnrecnum\" value=\"$myrow[0]\">";
            echo "<input type=\"hidden\" name=\"$avail_qty\"  id=\"$avail_qty\" value=\"$qty_wo_val\">";

            if($dept !='QA')
            {
              if($myLI_assy[19] =='')
              {
                echo "<td width=3%><span class=\"tabletext\"><input type=\"text\"  name=\"$linenumber\" id=\"$linenumber\" value=\"$myLI_assy[1]\" size=\"8%\"></td>";
              }
              else
              {
                echo "<td width=3%><span class=\"tabletext\"><input type=\"text\"  name=\"$linenumber\" id=\"$linenumber\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"  value=\"$myLI_assy[1]\" size=\"8%\"></td>";
              }

              //echo "<td width=3%><span class=\"tabletext\"><input type=\"text\" id=\"$linenumber\"  name=\"$linenumber\"  value=\"$myLI_assy[1]\" size=\"3%\" ></td>";
              echo "<td width=13%><span class=\"tabletext\"><input type=\"text\" id=\"$type\"  name=\"$type\"  value=\"$myLI_assy[16]\" size=\"13%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></td>";
              echo "<td width=4%><input type=\"text\" id=\"$itemno\" name=\"$itemno\"  size=\"6%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"$myLI_assy[2]\">";
              echo "<td width=10%><input type=\"text\" id=\"$crn_num4li\" name=\"$crn_num4li\"  size=\"6%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"$myLI_assy[15]\">
                <input type=\"hidden\" name=\"$pcrn_num\" size=\"20%\" value=\"$myLI_assy[19]\"></td>";
              echo "<td width=13%><span class=\"tabletext\"><input type=\"text\" id=\"$crn_type\"  name=\"$crn_type\"  value=\"$myLI_assy[20]\" size=\"13%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></td>";
              echo "<td width=10%><input type=\"text\" id=\"$partnum\" name=\"$partnum\"  size=\"20%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"$myLI_assy[3]\"></td>";
              echo "<td width=10%><input type=\"text\" id=\"$issue\" name=\"$issue\"  size=\"15%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"$myLI_assy[4]\"></td>";
              echo "<td width=12%><input type=\"text\" id=\"$descr\" name=\"$descr\"  size=\"23%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"$myLI_assy[12]\"></td>";
              echo "<td width=4%><input type=\"text\" id=\"$qty\" name=\"$qty\"  style=\"background-color:#DDDDDD;\" readonly=\"readonly\" size=\"5%\" value=\"$myLI_assy[5]\"></td>";
              // echo "<td width=6%><input type=\"text\" id=\"$uom\" name=\"$uom\"  size=\"8%\" value=\"$myLI_assy[7]\"></td>";
              echo "<td width=8%><input type=\"text\" id=\"$qty_wo\" name=\"$qty_wo\"  size=\"5%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"$myLI_assy[6]\">
              <input type=\"hidden\" id=\"$prev_qty_wo\" name=\"$prev_qty_wo\"  size=\"5%\" value=\"$myLI_assy[6]\"></td>";


              if ($myLI_assy[16] == "Bought Out" || $myLI_assy[16] == "Consummables") 
              {
                echo "<td width=6%><input type=\"text\" id=\"$rmponum_li\" name=\"$rmponum_li\"  size=\"10%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"$myLI_assy[21]\"><img src=\"images/bu-get.gif\" alt=\"Get CIM\" onclick=\"GetRmpoNum4BOI('$myLI_assy[16]',$i)\"></td>";  
              }
              else
              {
                echo "<td width=6%><input type=\"text\" id=\"$rmponum_li\" name=\"$rmponum_li\"  size=\"10%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"$myLI_assy[21]\"></td>";  
              }
   
              echo "<td width=6%><input type=\"text\" id=\"$rmponum_linum\" name=\"$rmponum_linum\"  size=\"10%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"$myLI_assy[22]\"></td>";

              if ($myLI_assy[23] == 0.00 || $myLI_assy[23] == "0.00") {
                $myLI_assy[23] = "";
              }

              echo "<td width=6%><input type=\"text\" id=\"$cost_li\" name=\"$cost_li\"  size=\"10%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"$myLI_assy[23]\"></td>";

              echo "<td width=6%><input type=\"text\" id=\"$grn\" name=\"$grn\"  size=\"10%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"$myLI_assy[8]\"><img src=\"images/bu-get.gif\" alt=\"Get CIM\" onclick=\"getgrn_wo($i)\"></td>";

              echo "<td width=8%><input type=\"text\" id=\"$exp_date\" name=\"$exp_date\"  size=\"8%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"  value=\"$myLI_assy[10]\">";
   
              ?>

              <img src="images/bu-getdateicon.gif" onclick="javascript:NewCssCal('<?php echo "$exp_date";?>','yyyyMMdd')" style="cursor:pointer"/></td>
              <?php

              echo "<td width=5%><input type=\"text\" id=\"$qty_acc\" name=\"$qty_acc\"  size=\"4%\" value=\"$myLI_assy[18]\"></td>";
              echo "<td width=5%><input type=\"text\" id=\"$qty_rew\" name=\"$qty_rew\"  size=\"4%\" value=\"$myLI_assy[13]\"></td>";
              echo "<td width=5%><input type=\"text\" id=\"$qty_ret\" name=\"$qty_ret\"  size=\"4%\" value=\"$myLI_assy[17]\"></td>";
              echo "<td width=5%><input type=\"text\" id=\"$qty_rej\" name=\"$qty_rej\"  size=\"4%\" value=\"$myLI_assy[14]\"></td>";

              // echo "<td width=6%><input type=\"text\" id=\"$rmponum_li\" name=\"$rmponum_li\"  size=\"10%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"$myLI_assy[21]\"></td>";   


              $date=date("Y-m-d");
              $approved_by = $userid;
              echo "<td width=3%><input type=\"checkbox\" id=\"$qainsp_app\" name=\"$qainsp_app\"  value=\"no\" 
              onchange=\"qains_check($i,'$date')\"></td>";
              echo "<td width=8%><input type=\"text\" id=\"$qainsp_appdate\" name=\"$qainsp_appdate\"  size=\"8%\" value=\"\" readonly></td>";
              // echo "<td width=15%><input type=\"text\" id=\"$remarks\" name=\"$remarks\"  size=\"27%\" value=\"$myLI_assy[11]\"></td>";
              echo "<td width=15%><input type=\"text\" id=\"$ncrnum\" name=\"$ncrnum\"  size=\"9%\" value=\"$myLI_assy[26]\"></td>";
              echo "<td width=15%><input type=\"text\" id=\"$cofc_num\" name=\"$cofc_num\"  size=\"9%\" value=\"$myLI_assy[27]\"></td>";
              echo "<td width=15%><input type=\"text\" id=\"$supplier_wo\" name=\"$supplier_wo\"  size=\"9%\" value=\"$myLI_assy[28]\"></td>";
              echo "<input type=\"hidden\" name=\"$qainsp_appby\" id=\"$qainsp_appby\" value=\"$userid\" >";
            }
            else
            {
              echo "<td width=3%><span class=\"tabletext\"><input type=\"text\"  name=\"$linenumber\" id=\"$linenumber\"  style=\"background-color:#DDDDDD;\" readonly=\"readonly\"  value=\"$myLI_assy[1]\" size=\"3%\"></td>";
              //echo "<td width=3%><span class=\"tabletext\"><input type=\"text\" id=\"$linenumber\"  name=\"$linenumber\"  value=\"$myLI_assy[1]\" size=\"3%\" ></td>";
              echo "<td width=13%><span class=\"tabletext\"><input type=\"text\" id=\"$type\"  name=\"$type\"  value=\"$myLI_assy[16]\" size=\"13%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></td>";
              echo "<td width=4%><input type=\"text\" id=\"$itemno\" name=\"$itemno\"  size=\"6%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"$myLI_assy[2]\">";
              echo "<td width=10%><input type=\"text\" id=\"$crn_num4li\" name=\"$crn_num4li\"  size=\"6%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"$myLI_assy[15]\">
                <input type=\"hidden\" name=\"$pcrn_num\" size=\"20%\" value=\"$myLI_assy[19]\"></td>";
              echo "<td width=13%><span class=\"tabletext\"><input type=\"text\" id=\"$crn_type\"  name=\"$crn_type\"  value=\"$myLI_assy[20]\" size=\"13%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></td>";
              echo "<td width=10%><input type=\"text\" id=\"$partnum\" name=\"$partnum\"  size=\"20%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"$myLI_assy[3]\"></td>";
              echo "<td width=10%><input type=\"text\" id=\"$issue\" name=\"$issue\"  size=\"15%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"$myLI_assy[4]\"></td>";
              echo "<td width=12%><input type=\"text\" id=\"$descr\" name=\"$descr\"  size=\"23%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"$myLI_assy[12]\"></td>";
              echo "<td width=4%><input type=\"text\" id=\"$qty\" name=\"$qty\"  style=\"background-color:#DDDDDD;\" readonly=\"readonly\" size=\"5%\" value=\"$myLI_assy[5]\"></td>";
              echo "<td width=6%><input type=\"text\" id=\"$uom\" name=\"$uom\"  size=\"8%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"$myLI_assy[7]\"></td>";
              echo "<td width=8%><input type=\"text\" id=\"$qty_wo\" name=\"$qty_wo\"  size=\"5%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"$myLI_assy[6]\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\">
                <input type=\"hidden\" id=\"$prev_qty_wo\" name=\"$prev_qty_wo\"  size=\"5%\" value=\"$myLI_assy[6]\"></td>";
              echo "<td width=5%><input type=\"text\" id=\"$qty_acc\" name=\"$qty_acc\"  size=\"4%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"$myLI_assy[18]\"></td>";
              echo "<td width=5%><input type=\"text\" id=\"$qty_rew\" name=\"$qty_rew\"  size=\"4%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"$myLI_assy[13]\"></td>";
              echo "<td width=5%><input type=\"text\" id=\"$qty_ret\" name=\"$qty_ret\"  size=\"4%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"$myLI_assy[17]\"></td>";
              echo "<td width=5%><input type=\"text\" id=\"$qty_rej\" name=\"$qty_rej\"  size=\"4%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"$myLI_assy[14]\"></td>";

              echo "<td width=6%><input type=\"text\" id=\"$rmponum_li\" name=\"$rmponum_li\"  size=\"10%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"$myLI_assy[21]\"></td>";   
             
              echo "<td width=6%><input type=\"text\" id=\"$rmponum_linum\" name=\"$rmponum_linum\"  size=\"10%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"$myLI_assy[22]\"></td>";

              echo "<td width=6%><input type=\"text\" id=\"$grn\" name=\"$grn\"  size=\"10%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"$myLI_assy[8]\"></td>";
              echo "<td width=6%><input type=\"text\" id=\"$cost_li\" name=\"$cost_li\"  size=\"10%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"$myLI_assy[23]\"></td>";
              echo "<td width=8%><input type=\"text\" id=\"$exp_date\" name=\"$exp_date\"  size=\"8%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"  value=\"$myLI_assy[10]\"></td>";

              $date=date("Y-m-d");
              $approved_by = $userid;
              echo "<td width=3%><input type=\"checkbox\" id=\"$qainsp_app\" name=\"$qainsp_app\"  value=\"no\" 
              onchange=\"qains_check($i,'$date')\"></td>";
              echo "<td width=8%><input type=\"text\" id=\"$qainsp_appdate\" name=\"$qainsp_appdate\"  size=\"9%\" value=\"\" readonly></td>";
             // echo "<td width=15%><input type=\"text\" id=\"$remarks\" name=\"$remarks\"  size=\"27%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"$myLI_assy[11]\"></td>";
              echo "<td width=15%><input type=\"text\" id=\"$ncrnum\" name=\"$ncrnum\"  size=\"9%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"$myLI_assy[26]\"></td>";
              echo "<td width=15%><input type=\"text\" id=\"$cofc_num\" name=\"$cofc_num\"  size=\"9%\" value=\"$myLI_assy[27]\"></td>";
              echo "<td width=15%><input type=\"text\" id=\"$supplier_wo\" name=\"$supplier_wo\"  size=\"9%\" value=\"$myLI_assy[28]\"></td>";
            }
            printf('</tr>');
            $i++;
          }

          echo "<input type=\"hidden\" name=\"index\" value=$i>";
        ?>

      </table>
    </div>
  </div>

  <table id="myTable_oper" width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1">
    <tr bgcolor="#DDDEDD">
      <td bgcolor="#DDDEDD" colspan=12><span class="heading"><center><b>Operation Description</b></center></span></td>
    </tr>
    <tr>
      <td bgcolor="#EEEFEE" width=6%><span class="heading"><b>Opn #</b></span></td>
      <td bgcolor="#EEEFEE" width=10%><span class="heading"><b>Stn</b></span></td>
      <td bgcolor="#EEEFEE" width=20%><span class="heading"><b>Operation Desc</b></span></td>
      <td bgcolor="#EEEFEE" width=10%><span class="heading"><b>Sign Off</b></span></td>
      <td bgcolor="#EEEFEE" width=10%><span class="heading"><b>Remarks</b></span></td>
    </tr>

    <?php
    $j=1;
    $flag=0;
    $result_assyoper = $assywo_oper->get_assy_oper($assyworecnum);
    while ($j<=5)
    {
      if($flag == 0)
      {
        while ($myLI_assyoper = mysql_fetch_row($result_assyoper))
        {
  	      printf('<tr bgcolor="#FFFFFF">');
          $oppn_num="oppn_num" . $j;
          $stn_num="stn_num" . $j;
          $operation_descr="operation_descr" . $j;
          $sign="sign" . $j;
          $remarks="remarks_oper" . $j;
          $prevlinenum_oper="prev_line_num_oper" . $j;
          $lirecnum_oper="lirecnum_oper" . $j;

          echo "<input type=\"hidden\" name=\"$prevlinenum_oper\" value=\"$myLI_assyoper[1]\">";
          echo "<input type=\"hidden\" name=\"$lirecnum_oper\" value=\"$myLI_assyoper[0]\">";
          if($dept!='QA'&& $dept !='PPC5')
          {
            echo "<td><span class=\"tabletext\"><input type=\"text\" id=\"$oppn_num\"  name=\"$oppn_num\"  value=\"$myLI_assyoper[1]\" size=\"6%\"></td>";
            echo "<td><input type=\"text\" id=\"$stn_num\" name=\"$stn_num\"  size=\"16%\" value=\"$myLI_assyoper[2]\">";
            echo "<td><input type=\"text\" id=\"$operation_descr\" name=\"$operation_descr\"  size=\"40%\" value=\"$myLI_assyoper[3]\"></td>";
            echo "<td><input type=\"text\" id=\"$sign\" name=\"$sign\"  size=\"15%\" value=\"$myLI_assyoper[4]\"></td>";
            echo "<td><input type=\"text\" id=\"$remarks\" name=\"$remarks\"  size=\"28%\" value=\"$myLI_assyoper[5]\"></td>";
          }
          else
          {
            echo "<td><span class=\"tabletext\"><input type=\"text\" id=\"$oppn_num\"  name=\"$oppn_num\"  style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"$myLI_assyoper[1]\" size=\"6%\"></td>";
            echo "<td><input type=\"text\" id=\"$stn_num\" name=\"$stn_num\"  size=\"16%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"$myLI_assyoper[2]\">";
            echo "<td><input type=\"text\" id=\"$operation_descr\" name=\"$operation_descr\"  size=\"40%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"$myLI_assyoper[3]\"></td>";
            echo "<td><input type=\"text\" id=\"$sign\" name=\"$sign\"  size=\"15%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"$myLI_assyoper[4]\"></td>";
            echo "<td><input type=\"text\" id=\"$remarks\" name=\"$remarks\"  size=\"28%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"$myLI_assyoper[5]\"></td>";
          }

          printf('</tr>');
          $j++;
        }
        $flag=1;
      }
      if($dept !='QA'&& $dept !='PPC5')
      {
        printf('<tr bgcolor="#FFFFFF">');
        $oppn_num="oppn_num" . $j;
        $stn_num="stn_num" . $j;
        $operation_descr="operation_descr" . $j;
        $sign="sign" . $j;
        $remarks="remarks_oper" . $j;
        $prevlinenum_oper="prev_line_num_oper" . $j;
        $lirecnum_oper="lirecnum_oper" . $j;
        echo "<input type=\"hidden\" name=\"$prevlinenum_oper\" value=\"\">";
        echo "<input type=\"hidden\" name=\"$lirecnum_oper\" value=\"\">";

        echo "<td><span class=\"tabletext\"><input type=\"text\" id=\"$oppn_num\"  name=\"$oppn_num\"  value=\"\" size=\"6%\"></td>";
        echo "<td><input type=\"text\" id=\"$stn_num\" name=\"$stn_num\"  size=\"16%\" value=\"$myLI_assyoper[2]\">";
        echo "<td><input type=\"text\" id=\"$operation_descr\" name=\"$operation_descr\"  size=\"40%\" value=\"\"></td>";
        echo "<td><input type=\"text\" id=\"$sign\" name=\"$sign\"  size=\"15%\" value=\"\"></td>";
        echo "<td><input type=\"text\" id=\"$remarks\" name=\"$remarks\"  size=\"28%\" value=\"\"></td>";
      }
      printf('</tr>');
      $j++;
    }
    echo "<input type=\"hidden\" name=\"index_oper\" value=$j>";
    echo "<input type=\"hidden\" name=\"delete_flag\" value=0>";
    ?>
  </table>
  <input type="hidden" name="page" value="edit">
  <?
    include("inassyedit.php");
  ?>

  <table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3 class="stdtable1">
    <tr bgcolor="#DDDEDD">
      <td colspan=13><span class="heading"><center><b>Timeline</b></center></td>
    </tr>

    <tr bgcolor="#FFFFFF">
      <td><span class="tabletext"><p align="left"><b>Sch Due Date</b></p></font></td>
      <td><input type="text" id="sch_due_date" name="sch_due_date"  style="background-color:#DDDDDD;"  readonly="readonly" size=12 value="<?php echo $myrow['sch_due_date']?>">
      <?php
        if($dept != 'Purchasing' && $dept != 'QA' && $dept !='PPC5')
        {
        ?>
          <img src="images/bu-getdateicon.gif" onclick="javascript:NewCssCal('sch_due_date','yyyyMMdd')" style="cursor:pointer"/>
        <?php
        }
        else
        {
        ?>
        </td>
        <?php
        }
        ?>
          <input type="hidden" name="prev_rev_ship_date" value="<?php echo $myrow['sch_due_date'] ?>">
          <td><span class="tabletext"><p align="left"><b>Revised Completed Date</b></p></font></td>
          <td><input type="text" id="rev_ship_date" name="rev_ship_date" style="background-color:#DDDDDD;"  readonly="readonly" size=12 value="<?php echo $myrow['revised_ship_date']?>">
          <?php
          if($dept != 'Purchasing' && $dept != 'QA' && $dept !='PPC5')
          {
          ?>
            <img src="images/bu-getdateicon.gif" onclick="javascript:NewCssCal('rev_ship_date','yyyyMMdd')" style="cursor:pointer"/>
          <?php
          }
          else
          {
          ?>
            </td>
          <?php
          }
          ?>
          <td><span class="tabletext"><p align="left"><b>Date Code</b></p></font></td>
          <td><input type="text" id="act_ship_date" name="act_ship_date" style="background-color:#DDDDDD;" readonly="readonly" size=12 value="<?php echo $myrow['actual_ship_date']?>">
          <?php
            if($dept != 'Purchasing' && $dept != 'QA')
            {
            ?>
              <img src="images/bu-getdateicon.gif" onclick="javascript:NewCssCal('act_ship_date','yyyyMMdd')" style="cursor:pointer"/>
               <?php
            }
            ?>
          </td>
    </tr>
  </table>

  <table border=0 bgcolor="#000000" width=100% cellspacing=1 cellpadding=3 id="mytable" class="stdtable1">
    <tr  bgcolor="#FFFFFF">
      <td width=8% bgcolor="#EEEFEE"><span class="heading"><b>Department</b></span></td>
      <td width=4% bgcolor="#EEEFEE"><span class="heading"><b>Stage#</b></span></td>
      <td width=15% bgcolor="#EEEFEE"><span class="heading"><b>Milestone</b></span></td>
      <td width=4% bgcolor="#EEEFEE"><span class="heading"><b>Dep#</b></span></td>
      <td width=9% bgcolor="#EEEFEE"><span class="heading"><b>Sch Date</b></span></td>
      <td width=10% bgcolor="#EEEFEE"><span class="heading"><b>Completed Date</b></span></td>
      <td width=11% bgcolor="#EEEFEE"><span class="heading"><b><center>Primary <br>Responsibility</center></b></span></td>
      <td width=12% bgcolor="#EEEFEE"><span class="heading"><b><center>Approved by</center></b></span></td>
      <td width=11% bgcolor="#EEEFEE"><span class="heading"><b><center>Secondary <br> Responsibility</center></b></span></td>
      <td width=11% bgcolor="#EEEFEE"><span class="heading"><b><center>Process</center></b></span></td>
      <td width=20% bgcolor="#EEEFEE"><span class="heading"><b><center>ETA</center></b></span></td>
    </tr>

    <?php
      $department = "";
      $app_flag = 0;
      $j = 1;
      $timeline = $assywo_flow->getassywo_flow('WO', $assyworecnum);
      while ($mytl = mysql_fetch_row($timeline)) 
      {
        $assywo_flow_approve = "assywo_flow_approve".$j;
        $datec = "datec".$j;
      ?>

        <tr class='bgcolor4'>
          <td width=8%><span class="heading"><b><i>
          <?php 
          if ($department != $mytl[28]) {
            echo $mytl[28] ;  
          }
          ?>
          </i></b></span></td>
          <td width=4%><span class="heading"><?php echo $mytl[31] ?></span></td>
          <td width=15%><span class="heading"><?php echo $mytl[30] ?></span></td>
          <td width=4%><span class="heading"><?php echo $mytl[29] ?></span></td>
          <td width=9%><span class="heading"><?php echo $mytl[2] ?></span></td>
          <td width=10%><input type="text" name="<?php echo $datec?>" id="<?php echo $datec?>" value="<?php echo $mytl[4]; ?>" size=8 style="background-color:#ECE5B6;" readonly="readonly">
          <img src="images/bu-getdateicon.gif" alt="Get Date" onclick='GetDate("<?php echo $datec; ?>")'>
          </td>
          <td width=11%><span class="heading"><?php echo $mytl[38] ?></span></td>
          <td width=12%><span class="heading">
          <?php 
            if (( $mytl[39] == 0 &&  $edept=='Sales' && $app_flag == 0) || ( ($mytl[28] == $edept) &&  $mytl[39] == 0 && $app_flag == 0 ) ) 
            {

              // echo "<a href=AssyProcessApproval.php?assyworecnum=$assyworecnum&wfrecnum=$mytl[8]&stagenum=$mytl[31]>
              // <img src=\"images/bu_approval.gif\" border=0></a>";
              echo "<a href=\"javascript:milestoneApproval($assyworecnum,$mytl[8],'$mytl[31]','$edept','$mytl[30]')\"  id=\"milestoneApproval$i\"><img src=\"images/bu_approval.gif\" border=0></a>";
              $app_flag = 1;
            }
            else if( ($mytl[39] == 0 &&  $edept=='Sales' && $app_flag == 1) || ( ($mytl[28] == $edept) && $mytl[39] == 0  && $app_flag == 1) ){
            }
            else if (  ($mytl[39] == 1 ) )  {
              echo "$mytl[15] ";
            }
            else if(($mytl[39] == 0) && (($mytl[28] == $edept)) ){
              $app_flag = 0;
            }
            else if(($mytl[39] == 0) && (($mytl[28] != $edept)) ){
              $app_flag = 1;
            }

          ?>
          </td>
      
          <td width=11%><span class="heading"><?php echo $mytl[35] ?></td>
          <td width=11%>
          <textarea  rows=3 cols=20 readonly="readonly"  style="background-color: #DDDDDD; overflow-y: scroll;"><?php echo $mytl[36] ?></textarea></td>
          <td width=20%>
            <textarea  rows=3 cols=20 readonly="readonly"  style="background-color: #DDDDDD; overflow-y: scroll;"><?php echo $mytl[37] ?></textarea>
          </td>

          <?php
            echo "<input type=\"hidden\" id=\"$assywo_flow_approve\" name=\"$assywo_flow_approve\" value=\"$mytl[15]\" >";
            $department = $mytl[28];
            $j++;
          } 
          echo "<input type=\"hidden\" id=\"assywo_flow_cnt\" name=\"assywo_flow_cnt\" value=\"$j\" >"; 
        ?>
  </table>

</td>

  <input type="hidden" id="pagename" name="pagename"  style="background-color:#DDDDDD;"  readonly="readonly" size=12 value="edit_assywo">
  <input type="hidden" id="dept" name="dept" style="background-color:#DDDDDD;"  readonly="readonly" size=12 value="<?php echo $dept ?>"></td>
</tr>

</table>
<table border=0 cellpadding=0 cellspacing=0 width=100%>
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

