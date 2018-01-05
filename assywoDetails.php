<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = Feb 23, 2010                 =
// Filename: assypoNew.php                     =
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
$dept = $_SESSION['department'];

$_SESSION['pagename'] = 'assyWoDetails';
$page = "WO: Assy WO";
//////session_register('pagename');

$assyworecnum = $_REQUEST['worecnum'];
$department= $_SESSION['department'];
$edept = $_SESSION['department'];
// First include the class definition
//include('classes/assyWoClass.php');
include('classes/displayClass.php');
include('classes/companyClass.php');
include('classes/assywoClass.php');
include('classes/assywoliClass.php');
include('classes/assywoli_operClass.php');
include('classes/inassyClass.php');
include('classes/assyProcessDetailsClass.php');
include('classes/assywo_flowClass.php');

//$newassyWo = new assyWo;
$newdisp = new display;
$company = new company;
$assywo = new assywo;
$assywo_li = new assywo_li;
$assywo_oper = new assywo_oper;
$newinassy = new inassy;
$assywo_pdet = new assywoprocessdetails;
$assywo_flow = new assywo_flow;

$result_assywo = $assywo->getAssyWos($assyworecnum);
$myrow = mysql_fetch_assoc($result_assywo);
$result_assywoprdet = $assywo_pdet->getAssyWoprdet($assyworecnum);
?>

<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/assywo.js"></script>
<script language="javascript" src="js/jquery-3.2.1.min.js"></script>


<html>
<head>
<title>Assembly WO Details</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">
<form action='assywoProcess.php' method='post' enctype='multipart/form-data'>
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
<td> -->
<?php
       // $newdisp->dispLinks('');
$flag_print='0';
$result_assyli4print = $assywo_li->get_assy_Li($assyworecnum);
//echo mysql_num_rows($result_assyli4print)."----<br>";
while (($myLI_assy4print = mysql_fetch_assoc($result_assyli4print)))
{
  //$grn=$myLI_assy["grn"];
  //echo $myLI_assy4print["grn"]."*--*-*-*";
  if($myLI_assy4print["grn"] == '')
  {
    $flag_print='1';
  }
}
?>
<!-- <table width=100% border=0 cellpadding=0 cellspacing=0>
<tr bgcolor="DEDFDE">
<td width="6"><img src="images/spacer.gif " width="6"></td> -->
<td bgcolor="#FFFFFF">
<table width=100% border=0 cellpadding=6 cellspacing=0>
<tr><td>
<table width=100% border=0>
<tr>
<td><span class="pageheading"><b>Assembly WO Details</b></td>
<td align="right">
<?php
//echo $flag_print."*/-/-*" ;   https://www.cimtoolsindia.com/wms/
if($flag_print == 0)
{?>
          <input type="button" class="stdbtn btn_blue" style="float:right;padding:2px;margin-right:5px;" onClick="javascript: printAssyWo('<?php echo $assyworecnum?>')" value="Print" >
             <!-- <img src="images/bu-print.gif" alt="Print AssyWO" onClick="javascript: printAssyWo('<?php echo $assyworecnum?>')"> -->
<?
}

if($dept == 'Sales' || $dept == 'PPC' || $dept == 'QA'||$dept == 'PPC5')
{
?>
<input type="button" class="stdbtn btn_blue" style="float:right;padding:2px;margin-right:5px;" onClick="location.href='assywoEdit.php?assyworecnum=<?php echo $assyworecnum ?>'" value="Edit" >
<input type="button" class="stdbtn btn_blue" style="float:right;padding:2px;margin-right:5px;" onClick="location.href='export_assywo.php?assyworecnum=<?php echo $assyworecnum?>&assywonum=<?php echo $myrow["assy_wonum"]?>'" value="Export" >
             <!-- <a href ="assywoEdit.php?assyworecnum=<?php echo $assyworecnum ?>" ><img name="Image8" border="0" src="images/bu-edit.gif" ></a>
             <a href="export_assywo.php?assyworecnum=<?php echo $assyworecnum?>&assywonum=<?php echo $myrow["assy_wonum"]?>"><img name="Image8" border="0" src="images/export.gif" ></a> -->
<?
}
?>
</tr>
</table>
<table width=100% border=0 cellpadding=6 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1">
<tr bgcolor="#FFFFFF"></tr>
<tr bgcolor="#EEEFEE"><td colspan=4><span class="heading"><center><b>General Information</b></center></td>
</tr> </table>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1">
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1">
  <?php
  if($myrow['assydate']!='' && $myrow['assydate'] !='0000-00-00 00:00:00')
{
         $datearr=split(" ",$myrow['assydate']);
         $date_arr=split('-',$datearr[0]);
         $d=$date_arr[2];
         $m=$date_arr[1];
         $y=$date_arr[0];
         $x=mktime(0,0,0,$m,$d,$y);
         $wodate=date('M j,Y',$x)." ".$datearr[1];
 }
 else
 {
         $wodate='';
 }
 ?>
<tr bgcolor="#FFFFFF">
<td width=20%><span class="labeltext"><p align="left">Assy WO #</p></font></td>
<td width=30%><span class="tabletext"><?php echo $myrow["assy_wonum"]?></td>
<td><span class="labeltext"><p align="left">WO Date</p></font></td>
<td><span class="tabletext"><?php echo $myrow["assydate"]?></td></tr>
<tr bgcolor="#FFFFFF">
<td width=20%><span class="labeltext"><p align="left">Assy Type</p></font></td>
<td ><span class="tabletext"><?php echo $myrow["assy_type"]?></td>
<td><span class="labeltext"><p align="left">Status</p></font></td>
<td><span class="tabletext"><?php echo $myrow["status"]?></td>
</tr>
<tr bgcolor="#FFFFFF">
<?php
// $result_host = $company->getAllHosts();
?>
<td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Customer</p></font></td>
<td><span class="tabletext"><?php echo $myrow["name"]?></td>
<td><span class="labeltext"><p align="left">PRN</p></font></td>
<td><span class="tabletext"><?php echo $myrow["crn"]?></td>
</tr>
<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Cust PO#</p></font></td>
<td><span class="tabletext"><?php echo $myrow["ponum"]?></td>
<td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>PO Qty</p></font></td>
<td><span class="tabletext"><?php echo $myrow["poqty"]?></td>
</tr>
<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">Cust PO Line #</p></font></td>
<td><span class="tabletext"><?php echo $myrow["cust_po_line_num"]?></td>
<td><span class="labeltext"><p align="left">Rework GRN</p></font></td>
<td><span class="tabletext"><?php echo $myrow["rework_grn"]?></td>
</tr>
<input type="hidden" name="page" value="new">
<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">BOM #</p></font></td>
<td><span class="tabletext"><?php echo $myrow["bomnum"]?></td>
<td><span class="labeltext"><p align="left">BOM Rev</p></font></td>
<td><span class="tabletext"><?php echo $myrow["bomiss"]?></td>
</td>
 </tr>
<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">Assy Part #</p></font></td>
<td><span class="tabletext"><?php echo $myrow["assypartnum"]?></td>
<td><span class="labeltext"><p align="left">Assy Part Iss</p></font></td>
<td><span class="tabletext"><?php echo $myrow["assypartiss"]?></td>
</tr>
<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">Assy WO Qty</p></font></td>
<td><span class="tabletext"><?php echo $myrow["assyqty"]?></td>
<td><span class="labeltext"><p align="left">Description</p></font></td>
<td><span class="tabletext"><?php echo $myrow["descr"]?></td>
</tr>
 <tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">Dwg No</p></font></td>
<td><span class="tabletext"><?php echo $myrow["drgno"]?></td>
<td><span class="labeltext"><p align="left">Drg Iss</p></font></td>
<td><span class="tabletext"><?php echo $myrow["drgiss"]?></td>
<!--<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">A.P.S #</p></font></td>
<td><span class="tabletext"><?php //echo $myrow["apsnum"]?></td>
<td><span class="labeltext"><p align="left">A.P.S Iss</p></font></td>
<td><span class="tabletext"><?php //echo $myrow["apsiss"]?></td>
</tr> -->
<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">COS #</p></font></td>
<td><span class="tabletext"><?php echo $myrow["cosno"]?></td>
<td colspan=2></td>
</tr>
<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">MPS/APS #</p></font></td>
<td><span class="tabletext"><?php echo $myrow["mpsnumber"] ?></td>
<td><span class="labeltext"><p align="left">MPS/APS Rev</p></font></td>
<td><span class="tabletext"><?php echo $myrow["mps_rev"] ?></td>
</tr>
</tr>
</table>
<br>


<tr bgcolor="#DDDEDD">
<td bgcolor="#DDDEDD" colspan=12><span class="heading"><center><b>Wo Notes</b></center></td>
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
<td bgcolor="#DDDEDD" colspan=12><span class="heading"><center><b>Part Details</b></center></td>
</tr>
<table id="myTable" width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1">
<tr>
<td bgcolor="#EEEFEE" width=3%><span class="heading"><b>Line</b></td>
<!-- <td bgcolor="#EEEFEE" width=10%><span class="heading"><b>Item No</b></td> -->
<td bgcolor="#EEEFEE" width=10%><span class="heading"><b>Type</b></td>
<td bgcolor="#EEEFEE" width=10%><span class="heading"><b>PRN</b></td>
<td bgcolor="#EEEFEE" width=10%><span class="heading"><b>PRN Type</b></td>
<td bgcolor="#EEEFEE" width=10%><span class="heading"><b>Part#</b></td>
<td bgcolor="#EEEFEE" width=10%><span class="heading"><b>Issue</b></td>
<td bgcolor="#EEEFEE" width=10%><span class="heading"><b>Description</b></td>
<td bgcolor="#EEEFEE" width=6%><span class="heading"><b>Qty<br>/Assy</b></td>
<!-- <td bgcolor="#EEEFEE" width=6%><span class="heading"><b>UOM</b></td> -->
<td bgcolor="#EEEFEE" width=10%><span class="heading"><b>Qty For WO</b></td>

<td bgcolor="#EEEFEE" width=6%><span class="heading"><b>RMPO#</b></td>
<td bgcolor="#EEEFEE" width=6%><span class="heading"><b>RMPO LI #</b></td>
<td bgcolor="#EEEFEE" width=10%><span class="heading"><b>GRN<br>/WO</b></td>
<td bgcolor="#EEEFEE" width=10%><span class="heading"><b>Cost</b></td>
<td bgcolor="#EEEFEE" width=6%><span class="heading"><b>Expiry<br>Date</b></td>

<td bgcolor="#EEEFEE" width=6%><span class="heading"><b>Acc</b></td>
<td bgcolor="#EEEFEE" width=6%><span class="heading"><b>Rew</b></td>
<td bgcolor="#EEEFEE" width=6%><span class="heading"><b>Ret</b></td>
<td bgcolor="#EEEFEE" width=6%><span class="heading"><b>Rej</b></td>


<td bgcolor="#EEEFEE" width=6%><span class="heading"><b>QA <br>Appr</b></td>
<td bgcolor="#EEEFEE" width=6%><span class="heading"><b>QA <br>Appr<br>Date</b></td>

<td bgcolor="#EEEFEE" width=6%><span class="heading"><b>NCR #</b></td>
<td bgcolor="#EEEFEE" width=6%><span class="heading"><b>Cofc #</b></td>
<td bgcolor="#EEEFEE" width=6%><span class="heading"><b>Supp Wo #</b></td>
</tr>
<?php
$result_assyli = $assywo_li->get_assy_Li($assyworecnum);
while (($myLI_assy = mysql_fetch_assoc($result_assyli)))
{
   printf('<tr bgcolor="#FFFFFF">');
   $linenumber=$myLI_assy["linenum"];
   $itemno=$myLI_assy["itemno"];
   $partnum=$myLI_assy["partnum"];
   $issue=$myLI_assy["issue"];
   $descr=$myLI_assy["descr"];
   $qty=$myLI_assy["qty"];
   $uom=$myLI_assy["uom"];
   $qty_wo=$myLI_assy["qty_wo"];
   $grn=$myLI_assy["grn"];
   $exp_date=$myLI_assy["exp_date"];
   $remarks=$myLI_assy["remarks"];
   $crn_num4li=$myLI_assy["crn_num4li"];
   $qty_rew=$myLI_assy["qty_rew"];
   $qty_rej=$myLI_assy["qty_rej"];
   $qty_ret=$myLI_assy["qty_ret"];
   $qty_acc=$myLI_assy["qty_acc"];
   $type=$myLI_assy["bom_type"];
    $crn_type=$myLI_assy["crn_type"];
  
  $rmponum=$myLI_assy["rmponum"];
  $rmpo_linenum=$myLI_assy["rmpo_linenum"];
  $rmpo_cost=$myLI_assy["rmpo_cost"];
  $qaapproved_by=$myLI_assy["qaapproved_by"];
  $ncrnum=$myLI_assy["ncrnum"];
  $cofc_num=$myLI_assy["cofc_num"];
  $supplier_wo=$myLI_assy["supplier_wo"];


    if($myLI_assy['qaapproved_date'] !='' && $myLI_assy["qaapproved_date"] !='0000-00-00' && $myLI_assy["qaapproved_date"] !='NULL')
    {
      $datearr=split(" ",$myLI_assy["qaapproved_date"]);
      $date_arr=split('-',$datearr[0]);
      $d=$date_arr[2];
      $m=$date_arr[1];
      $y=$date_arr[0];
      $x=mktime(0,0,0,$m,$d,$y);
      $qaapproved_date=date('M j,Y',$x)." ".$datearr[1];
     }
     else
     {
       $qaapproved_date='';
     }



             echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$linenumber</td>" ;
             // echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$itemno</td>" ;
             echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$type</td>" ;
             echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$crn_num4li</td>" ;
             echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$crn_type</td>" ;
             echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$partnum</td>" ;
             echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$issue</td>" ;
             echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$descr</td>";
             echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$qty</td>";
           /*  echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$uom</td>";*/
             echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$qty_wo</td>";
               echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$rmponum</td>";
             echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$rmpo_linenum</td>";

             echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$grn</td>";
             echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$rmpo_cost</td>";

             echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$exp_date</td>";
             
             echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$qty_acc</td>";
             echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$qty_rew</td>";
             echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$qty_ret</td>";
             echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$qty_rej</td>";

           

             echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$qaapproved_by</td>";
             echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$qaapproved_date</td>";

             echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$ncrnum</td>";
             echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$cofc_num</td>";
             echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$supplier_wo</td>";
}

?>
<tr bgcolor="#DDDEDD">
<td colspan=25 bgcolor="#DDDEDD"><span class="heading"><center><b>Operation Description Line Items</b></center></td>
</tr>
<table id="myTable" width=100% border=0 cellpadding=3 cellspacing=1 class="stdtable">
<tr>
<th class="head0" width=3% bgcolor="#EEEFEE"><span class="heading"><b>Opn #</b></th>
<th class="head1" width=10% bgcolor="#EEEFEE"><span class="heading"><b>Stn</b></th>
<th class="head0" width=10% bgcolor="#EEEFEE"><span class="heading"><b>Operation Desc</b></th>
<th class="head1" width=10% bgcolor="#EEEFEE"><span class="heading"><b>Sign Off</b></th>
<th class="head0" width=10% bgcolor="#EEEFEE"><span class="heading"><b>Remarks</b></th>

</tr>
<?php
$result_assyoper = $assywo_oper->get_assy_oper($assyworecnum);
while ($myLI_assyoper = mysql_fetch_assoc($result_assyoper))
{
   printf('<tr bgcolor="#FFFFFF">');
   $oppn_num=$myLI_assyoper["opnnum"];
   $stn_num=$myLI_assyoper["stn"];
   $operation_descr=$myLI_assyoper["oper_descr"];
   $sign=$myLI_assyoper["signoff"];
   $remarks=$myLI_assyoper["remarks"];



       echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$oppn_num</td>" ;
       echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$stn_num</td>" ;
       echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$operation_descr</td>" ;
       echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$sign</td>" ;
       echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$remarks</td>";
       printf('</tr>');
}
?>
</table>
<!-- <table id="processDets" width=100% border=0 cellpadding=3 cellspacing=1  class="stdtable">

<tr bgcolor="#DDDEDD">
<td colspan=12><span class="heading"><center><b>Process Details</b></center></td>
</tr>
<tr>
<th class="head0" width=3%><span class="heading"><b>Line</b></th>
<th class="head1" width=15%><span class="heading"><b>Process</b></th>
<th class="head0" width=30%><span class="heading"><b>Start Date & Time</b></th>
<th class="head1" width=30%><span class="heading"><b>End Date & Time</b></th>
<th class="head0" width=42%><span class="heading"><b>Other Details</b></th>

</tr>
<?php

       while ($myLI_assyprdet = mysql_fetch_row($result_assywoprdet))
      {

       if($myLI_assyprdet[3]!='' && $myLI_assyprdet[3] !='0000-00-00 00:00:00')
       {
         $datearr=split(" ",$myLI_assyprdet[3]);
         //echo $datearr[0]."===---====".$datearr[1]."<br>";
         $date_arr=split('-',$datearr[0]);
         $d=$date_arr[2];
         $m=$date_arr[1];
         $y=$date_arr[0];
         $x=mktime(0,0,0,$m,$d,$y);
         $stdatetime=date('M j,Y',$x)." ".$datearr[1];
       }else
       {
         $stdatetime='';
       }
       
       if($myLI_assyprdet[4]!='' && $myLI_assyprdet[4] !='0000-00-00 00:00:00')
       {
         $datearr=split(" ",$myLI_assyprdet[4]);
         //echo $datearr[0]."===---====".$datearr[1]."<br>";
         $date_arr=split('-',$datearr[0]);
         $d=$date_arr[2];
         $m=$date_arr[1];
         $y=$date_arr[0];
         $x=mktime(0,0,0,$m,$d,$y);
         $enddatetime=date('M j,Y',$x)." ".$datearr[1];
       }else
       {
         $enddatetime='';
       }
      printf('<tr bgcolor="#FFFFFF">');
        echo "<td><span class=\"tabletext\">$myLI_assyprdet[1]</td>";
        echo "<td><span class=\"tabletext\">$myLI_assyprdet[2]</td>";
        echo "<td><span class=\"tabletext\">$stdatetime</td>";
        echo "<td><span class=\"tabletext\">$enddatetime</td>";
        echo "<td><textarea style=\"background-color:#DDDDDD;\"  readonly=\"readonly\" rows=2 cols=30>$myLI_assyprdet[5]</textarea></td>";
        printf('</tr>');
      }

?>


</table> -->
<table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3 >
<?
    include("inassydetails.php");
?>

 <table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3 class="stdtable1">

        <tr bgcolor="#DDDEDD">
            <td colspan=13><span class="heading"><center><b>Timeline</b></center></td>
        </tr>

      <tr bgcolor="#FFFFFF">
            <td><span class="tabletext"><p align="left"><b>Sch Due Date</b></p></font></td>
            <td><input type="text" name="sch_due_date"
                    style="background-color:#DDDDDD;"
                    readonly="readonly" size=12 value="<?php echo $myrow['sch_due_date']?>">
         
             <input type="hidden" name="prev_rev_ship_date" value="<?php echo $myrow['sch_due_date'] ?>">
            <td><span class="tabletext"><p align="left"><b>Revised Completed Date</b></p></font></td>
            <td><input type="text" name="rev_ship_date"
                    style="background-color:#DDDDDD;"
                    readonly="readonly" size=12 value="<?php echo $myrow['revised_ship_date']?>">
            
            <td><span class="tabletext"><p align="left"><b>Date Code</b></p></font></td>
            <td><input type="text" id="act_ship_date" name="act_ship_date"
                    style="background-color:#DDDDDD;"
                    readonly="readonly" size=12 value="<?php echo $myrow['actual_ship_date']?>">
             </td>

     </table>

    <table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3 class="stdtable1">
      <tr class='bgcolor4' WIDTH="100%">
        <td width=13%><span class="heading"><b>Department</b></td>
        <td width=4%><span class="heading"><b>Stage#</b></td>
        <td width=21%><span class="heading"><b>Milestone</b></td>
        <td width=4%><span class="heading"><b>Dep#</b></td>
        <td width=9%><span class="heading"><b>Sch Date</b></td>

        <td width=9%><span class="heading"><b>Completed Date</b></td>
        <td width=9%><span class="heading"><b><center>Primary <br> Resposibility</center></b></td>
        <td width=11%><span class="heading"><b><center>Approved by</center></b></td>

        <td width=11%><span class="heading"><b><center>Secondary <br> Resposibility</center></b></td>
        <td width=11%><span class="heading"><b><center>Process</center></b></td>
        <td width=20%><span class="heading"><b><center>ETA</center></b></td>

      </tr>

      <?php 
        $department = "";
        $app_flag = 0;
        $i = 1;
        $timeline = $assywo_flow->getassywo_flow('WO', $assyworecnum);
        while ($mytl = mysql_fetch_row($timeline)) 
        {
          if($mytl[2] != '' && $mytl[2] != '0000-00-00' && $mytl[2] != 'NULL')
          {
            $datearr = split('-', $mytl[2]);
            $d=$datearr[2];
            $m=$datearr[1];
            $y=$datearr[0];
            $date1=date($d.'-'.$m.'-'.$y);
          }
          else
          {
            $date1 = '';
          }


          if($mytl[4] != '' && $mytl[4] != '0000-00-00' && $mytl[4] != 'NULL')
          {
            $datearr = split('-', $mytl[4]);
            $d=$datearr[2];
            $m=$datearr[1];
            $y=$datearr[0];
            $date3=date($y.'-'.$m.'-'.$d);
          }
          else
          {
            $date3 = '';
          }

        ?>

        <tr class='bgcolor4'>
          <td width=13%><span class="heading"><b><i>
            <?php 
            if ($department != $mytl[28]) {
              echo $mytl[28] ;  
            }
            ?>
            </i></b></td>
          <td width=4%><span class="heading"><?php echo $mytl[31] ?></td>
          <td width=21%><span class="heading"><?php echo $mytl[30] ?></td>
          <td width=4%><span class="heading"><?php echo $mytl[29] ?></td>
          <td width=9%><span class="heading"><?php echo $date1 ?></td>
          <td width=9%><span class="heading"><?php echo $date3 ?></td>
          <td width=9%><span class="heading"><?php echo $mytl[38] ?></td>
          <td width=9%><span class="heading">
          <?php 
            if (( $mytl[39] == 0 &&  $edept=='Sales' && $app_flag == 0) || ( ($mytl[28] == $edept) &&  $mytl[39] == 0 && $app_flag == 0 ) ) {
              
              // echo "<a href=AssyProcessApproval.php?assyworecnum=$assyworecnum&wfrecnum=$mytl[8]&stagenum=$mytl[31]&logindept=$edept&milestone=$mytl[30]><img src=\"images/bu_approval.gif\" border=0></a>";
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
            <textarea  rows=3 cols=20 readonly="readonly"  style="background-color: #DDDDDD; overflow-y: scroll;"><?php echo $mytl[36] ?></textarea>
          </td>
          <td width=20%>
            <textarea  rows=3 cols=20 readonly="readonly"  style="background-color: #DDDDDD; overflow-y: scroll;"><?php echo $mytl[37] ?></textarea>
          </td>
        </tr>

        <?php

          $department = $mytl[28];
          $i++;
        }



      ?>


    </table>

</td>
<!-- <td width="6"><img src="images/spacer.gif " width="6"></td>
</tr>
<tr bgcolor="DEDFDE">
<td width="6"><img src="images/box-left-bottom.gif"></td>
<td><img src="images/spacer.gif " height="6"></td>
<td width="6"><img src="images/box-right-bottom.gif"></td>
</tr> -->
</table>
<!-- <table border = 0 cellpadding=0 cellspacing=0 width=100% >
<tr>
<td align=left> -->
</td>
</tr>
</table>
</table>
</FORM>




</body>
</html>

