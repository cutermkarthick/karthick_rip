<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = June 20, 2004                =
// Filename: dispatchDetails.php               =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OMS                          =
// Displays Dispatch                           =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];
if ( !isset ( $_REQUEST['disprecnum']) )
{
   header ( "Location: login.php" );

}

$disprecnum = $_REQUEST['disprecnum'];
// $_SESSION['disprecnum'] = $disprecnum;

//////session_register('disprecnum');
//echo "$porecnum";
$_SESSION['pagename'] = 'dispatchDetails';
$page = "Dispatch";
//////session_register('pagename');
$dept=$_SESSION['department'];

// First include the class definition

include('classes/dispatchClass.php');
include('classes/dispatchliClass.php');
include('classes/displayClass.php');
$newDispatch = new dispatch;
$newdisplay = new display;
$newLI = new dispatch_line_items;
$result = $newDispatch->getdispatchDetails($disprecnum);
$myrow = mysql_fetch_row($result);

?>
<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/dispatch.js"></script>

<html>
<head>
<title>Dispatch Details</title>
</head>
<?php
include('header.html');
?>
<!-- <table width=100% cellspacing="0" cellpadding="6" border="0">
	<tr>
		<td>
			<table width=100% border=0 cellspacing="0" cellpadding="0">
   				<tr>
        					<td colspan=2><span class="welcome"><b>Welcome <?php echo $userid?></b></td>
        					<td align="right">&nbsp;
       					<a href="exit.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image16','','images/logout_mo.gif',1)"><img name="Image16" border="0" src="images/logout.gif"></a></td>
        				 </tr>
			</table>
			<table width=100% border=0 cellpadding=0 cellspacing=0  >
				<tr><td></td></tr>
				<tr>
					<td>
<?php $newdisplay->dispLinks(''); ?>
</td></tr>
<table width=100% border=0 cellpadding=0 cellspacing=0  >

	<tr bgcolor="DEDFDE"><td width="6"><img src="images/spacer.gif " width="6"></td> -->
	     		     <td bgcolor="#FFFFFF">
 <table class="stdtable1" width=100% border=0 cellpadding=6 cellspacing=0 style="width:100%!important">
    <tr>
        <td >
        <table class="stdtable1" width=100% border=0 cellpadding=6 cellspacing=0 style="width:100%!important">
        <tr>
<td ><span class="pageheading"><b>Dispatch Details</b></td>
        <td align="right">
<?php
// && ($myrow[1] == 'C18873' || $myrow[1] == 'C18874' || $myrow[1] == 'C18875')

if ( $myrow[19] == 'Open' && $dept=='Sales')
{
?>
<input type="button" class="stdbtn btn_blue" style="float:right;padding:2px;margin-right:5px;" onClick="location.href='dispatchupdate.php?disprecnum=<?php echo $disprecnum ?>'" value="Edit" >
<!-- <a href ="dispatchupdate.php?disprecnum=<?php echo $disprecnum ?>"><img name="Image8" border="0" 
src="images/bu-edit.gif" ></a> -->
<?php
}
?>
   <input type="button" class="stdbtn btn_blue" style="float:right;padding:2px;margin-right:5px;" onClick="javascript: printCofc(<?php echo $disprecnum ?>)" value="Print" >
          <!-- <img src="images/bu-print.gif" alt="Print CofC" onClick="javascript: printCofc(<?php echo $disprecnum ?>)"> -->
			<input type="button" class="stdbtn btn_blue" style="float:right;padding:2px;margin-right:5px;" onClick="location.href='export_cofc.php?disprecnum=<?php echo $_REQUEST['disprecnum']?>'" value="Export" >
       <!-- <a href="export_cofc.php?disprecnum=<?echo $_REQUEST['disprecnum']?>"><img name="Image8" border="0" src="images/export.gif" ></a> -->
        </td>
  </tr>

<table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3 class="stdtable1"   style="width:100%!important">
<tr bgcolor="#DDDEDD"><td colspan=4><span class="heading"><center><b>Dispatch Details</b></center></td></tr>
</td>
    <tr bgcolor="#FFFFFF">
            <td ><span class="labeltext">Rel Note#</td>
            <td ><span class="tabletext"><?php echo $myrow[1] ?></td>
			 <td ><span class="labeltext">Type</td>
            <td ><span class="tabletext"><?php echo $myrow[36] ?></td>
			</tr>
             
			<tr bgcolor="#FFFFFF">
            <td><span class="labeltext">Dispatch Date</td>
<?php

              if($myrow[2] != '0000-00-00' && $myrow[2] != '' && $myrow[2] != 'NULL')
              {
                $datearr = split('-', $myrow[2]);
                $d=$datearr[2];
                $m=$datearr[1];
                $y=$datearr[0];
                $x=mktime(0,0,0,$m,$d,$y);
                $dispdate=date("M j, Y",$x);
	      }
	      else
              {
                $dispdate="";
	      }
?>
            <td><span class="tabletext"><?php echo $dispdate ?></td>              
            <td><span class="labeltext">Dispatch to Customer</font></td>
            <td ><span class="tabletext"><?php echo $myrow[4] ?></td>
     </tr>

            <tr bgcolor="#FFFFFF">
	        <td><span class="labeltext">Dispatch Desc</font></td>
           <td colspan=3><textarea name="disp_desc" rows="3"
			      style="background-color:#DDDDDD;"
                    readonly="readonly"
			      cols="100"><?php echo $myrow[3] ?></textarea></td>
			</tr>

        </tr>

     <tr bgcolor="#FFFFFF">
            <td><span class="labeltext">Via</font></td>
            <td ><span class="tabletext"><?php echo $myrow[5] ?></td>
            <td><span class="labeltext">Ref No</td>
            <td ><span class="tabletext"><?php echo $myrow[6] ?></td>
      </tr>
     <tr bgcolor="#FFFFFF">
            <td><span class="labeltext">PRN</font></td>
            <td ><span class="tabletext"><?php echo $myrow[10] ?></td>
            <td bgcolor="00FF00"><span class="labeltext">Status</font></td>
            <td bgcolor="00FF00"><span class="tabletext"><?php echo $myrow[19] ?></td>
     </tr>
     <tr bgcolor="#FFFFFF">
            <td><span class="labeltext">Export Invoice#</font></td>
            <td colspan=3><span class="tabletext"><?php echo $myrow[39] ?></td>
     </tr>
     <tr bgcolor="#FFFFFF">
            <td><span class="labeltext">Remarks</font></td>
            <td colspan=3><textarea name="remarks" rows="3"
			      style="background-color:#DDDDDD;"
                    readonly="readonly"
			      cols="100"><?php echo $myrow[18] ?></textarea></td>   
      </tr>

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext">Create Date</td>
            <?php

              if($myrow[7] != '0000-00-00' && $myrow[7] != '' && $myrow[7] != 'NULL')
              {
               $datearr = split('-', $myrow[7]);
               $d=$datearr[2];
               $m=$datearr[1];
               $y=$datearr[0];
               $x=mktime(0,0,0,$m,$d,$y);
               $createdate=date("M j, Y",$x);
		      }
		      else
              {
               $createdate="";
		      }
            ?>
            <td><span class="tabletext"><?php echo $createdate ?></td>
            <td><span class="labeltext">Modified Date</td>
            <?php

              if($myrow[8] != '0000-00-00' && $myrow[8] != '' && $myrow[8] != 'NULL')
              {
               $datearr = split('-', $myrow[8]);
               $d=$datearr[2];
               $m=$datearr[1];
               $y=$datearr[0];
               $x=mktime(0,0,0,$m,$d,$y);
               $moddate=date("M j, Y",$x);
		      }
		      else
              {
               $moddate="";
		      }
            ?>
            <td><span class="tabletext"><?php echo $moddate ?></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext">Scheduled Date</td>
            <?php

              if($myrow[34] != '0000-00-00' && $myrow[34] != '' && $myrow[34] != 'NULL')
              {
               $datearr = split('-', $myrow[34]);
               $d=$datearr[2];
               $m=$datearr[1];
               $y=$datearr[0];
               $x=mktime(0,0,0,$m,$d,$y);
               $schdate=date("M j, Y",$x);
		      }
		      else
              {
               $schdate="";
		      }
            ?>
            <td colspan=3><span class="tabletext"><?php echo $schdate ?></td>
            <!--<td><span class="labeltext">Pending Sch Qty</td>
            <td ><span class="tabletext"><?php echo $myrow[35] ?></td> -->
      </tr>
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext">Deliver Address</font></td>
            <td ><span class="tabletext"><?php if ($myrow[20] != '') echo $myrow[20];
            else echo 'Primary'?></td>
            <td bgcolor="FFFFFF"><span class="labeltext">Invoice Address</font></td>
            <td bgcolor="FFFFFF"><span class="tabletext"><?php if ($myrow[21] != '') echo $myrow[21];
            else echo 'Primary' ?></td>
        </tr>
        <table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3 style="width:100%!important">
        <tr bgcolor="#FFFFF">
        <td>
            <?php
               if ($myrow[20] == 'Primary' || $myrow[20] == '')
               {
            ?>
             <b><span class="heading">Deliver to:</b>
             <br><span class="tabletext"><?php echo $myrow[11] ?>
             <br><span class="tabletext"><?php echo $myrow[12] ?>
             <br><span class="tabletext"><?php echo $myrow[13] . ", " . $myrow[14] . ". " . $myrow[15] . ". " . $myrow[16];?>
             <br><span class="tabletext"><?php echo "PH: " . $myrow[17]; ?>
             <?php
             }
              else if ($myrow[20] == 'Billing')
               {
            ?>
             <b><span class="labeltext">Deliver to:</b>
             <br><span class="tabletext"><?php echo $myrow[22] ?>
             <br><span class="tabletext"><?php echo $myrow[23] ?>
             <br><span class="tabletext"><?php echo $myrow[24] . ", " . $myrow[25] . ". " . $myrow[26] . ". " . $myrow[27];?>
             <br><span class="tabletext"><?php echo "PH: " . $myrow[17]; ?>

              <?php
             }
              else if ($myrow[20] == 'Shipping')
               {
            ?>

             <b><span class="heading">Deliver to:</b>
             <br><span class="tabletext"><?php echo $myrow[28] ?>
             <br><span class="tabletext"><?php echo $myrow[29] ?>
             <br><span class="tabletext"><?php echo $myrow[30] . ", " . $myrow[31] . ". " . $myrow[32] . ". " . $myrow[33];?>
             <br><span class="tabletext"><?php echo "PH: " . $myrow[17]; ?>
          <?php
          }
          ?>
     </td>
     <td>
            <?php
               if ($myrow[21] == 'Primary' || $myrow[21] == '')
               {
            ?>
             <b><span class="heading">Invoice to:</b>
             <br><span class="tabletext"><?php echo $myrow[11] ?>
             <br><span class="tabletext"><?php echo $myrow[12] ?>
             <br><span class="tabletext"><?php echo $myrow[13] . ", " . $myrow[14] . ". " . $myrow[15] . ". " . $myrow[16];?>
             <br><span class="tabletext"><?php echo "PH: " . $myrow[17]; ?>
             <?php
             }
              else if ($myrow[21] == 'Billing')
               {
            ?>
             <b><span class="labeltext">Invoice to:</b>
             <br><span class="tabletext"><?php echo $myrow[22] ?>
             <br><span class="tabletext"><?php echo $myrow[23] ?>
             <br><span class="tabletext"><?php echo $myrow[24] . ", " . $myrow[25] . ". " . $myrow[26] . ". " . $myrow[27];?>
             <br><span class="tabletext"><?php echo "PH: " . $myrow[17]; ?>

              <?php
             }
              else if ($myrow[21] == 'Shipping')
               {
            ?>

             <b><span class="heading">Invoice to:</b>
             <br><span class="tabletext"><?php echo $myrow[28] ?>
             <br><span class="tabletext"><?php echo $myrow[29] ?>
             <br><span class="tabletext"><?php echo $myrow[30] . ", " . $myrow[31] . ". " . $myrow[32] . ". " . $myrow[33];?>
             <br><span class="tabletext"><?php echo "PH: " . $myrow[17]; ?>
             <?php
              }
            ?>
     </td>
     </tr>
    </table>
    </table>
  <div style="width:100%;overflow-x:scroll">
<table width=100% style="border:1px" cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable" >
<tr bgcolor="#DDDEDD">
  <thead>
<td colspan=22><span class="heading"><center><b>Line Items</b></center></td>



       <tr>
            <th class="head0" width=3%><span class="heading"><b>Line</b></td>
            <th class="head1" width=6%><span class="heading"><b>WO#</b></td>
            <th class="head0" width=6%><span class="heading"><b>DN Num</b></td>
			      <th class="head1" width=6%><span class="heading"><b>Supplier<br/>WO#</b></td>
            <th class="head0" width=6%><span class="heading"><b>Part #</b></td>
            <th class="head1" width=6%><span class="heading"><b>Part <br>Name</b></td>
            <th class="head0" width=6%><span class="heading"><b>RM Spec</b></td>
            <th class="head1" width=6%><span class="heading"><b>Part<br>Iss</b></td>
            <th class="head0" width=6%><span class="heading"><b>Drg <br>Iss</b></td>
            <th class="head1" width=10%><span class="heading"><b>COS</b></td>
            <th class="head0" width=6%><span class="heading"><b>GRN Num</b></td>
            <th class="head1" width=6%><span class="heading"><b>Batch No</b></td>
            <th class="head0" width=6%><span class="heading"><b>Custpo Num</b></td>
			      <th class="head1" width=6%><span class="heading"><b>Item<br>Num</b></td>
			     <!--  <th class="head0" width=6%><span class="heading"><b>Disp CustPo <br/>No.</b></td>
   		      <th class="head1" width=6%><span class="heading"><b>Disp Custpo<br/> Item</b></td> -->
            <th class="head0" width=6%><span class="heading"><b>WO Comp<br>&nbsp;&nbspDate</b></td>
            <th class="head1" width=6%><span class="heading"><b>WO Qty</b></td>
            <th class="head0" width=6%><span class="heading"><b>Acc Qty</b></td>
            <th class="head1" width=6%><span class="heading"><b>Dispatch Qty</b></td>
            <th class="head0" width=6%><span class="heading"><b>Packing<br>Slip No</b></td>
            <th class="head1" width=6%><span class="heading"><b>Save</b></td>

       </tr>
     </thead>

<?php

        $i = 0; $n=0;
		$type = $myrow[36];
        $result = $newLI->getLI($disprecnum,$type);
        $wo_num=array();
        while ($myLI = mysql_fetch_assoc($result)) {
         $wo_num[$n]=$myLI["wonum"];
	   if($myLI["custpo_date"] != '0000-00-00' && $myLI["custpo_date"] != '' && $myLI["custpo_date"] != 'NULL')
           {
              $datearr = split('-', $myLI["custpo_date"]);
              $d=$datearr[2];
              $m=$datearr[1];
              $y=$datearr[0];
              $x=mktime(0,0,0,$m,$d,$y);
              $custpodate=date("M j, Y",$x);
           }
           else
           {
              $custpodate = '';
           }
            //echo "$date";
            $line_num = $myLI["line_num"];
            $partname = $myLI["partname"];
            $drgiss = $myLI["drgiss"];
            $partiss = $myLI["partiss"];
            $cos = $myLI["cos"];
            $itemnum = $myLI["itemnum"];
            $datecode = $myLI["datecode"];
            $rmspec = $myLI["rmspec"];
            $wonum = $myLI["wonum"];
   $dnnum = $myLI["dnnum"];
			$supplier_wonum = $myLI["supplier_wonum"];
            $partnum = $myLI["partnum"];
            $rmspec = $myLI["rmspec"];
            $woqty = $myLI["wo_qty"];
            $compqty = $myLI["comp_qty"];
            $grnnum = $myLI["grnnum"];
            //$delvby = $myLI["delv_by"];
            $custponum = $myLI["custpo_num"];

			$disp_custpo_no = $myLI["disp_custpo_no"];
			
			$disp_custpo_item = $myLI["disp_custpo_item"];


            $custpoqty = $myLI["custpo_qty"];
            $dispatchqty = $myLI["dispatch_qty"];
            $disp_update = $dispatchqty;
            $batchno = $myLI["batchNo"];
            $psn = $myLI["psn"];
            $lirec = $myLI["recnum"];

              $i = $i + 1; 
              

	         echo"<tr><td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$line_num</td>" ;
             echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$wonum</td>";
            echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$dnnum</td>";
			 echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$supplier_wonum</td>";
             echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$partnum</td>";
             echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$partname</td>";
             echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$rmspec</td>";
             echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$partiss</td>";
             echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$drgiss</td>";
             echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$cos</td>";
             echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$grnnum</td>";
             echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$batchno</td>";
             echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$custponum</td>";
			  echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$itemnum</td>";

			  /*echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$disp_custpo_no</td>";
			   echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$disp_custpo_item</td>";*/


            
             echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$custpodate</td>";
             echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$woqty</td>";
             echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$compqty</td>";
             echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$dispatchqty</td>";
             echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$psn</td>";
             $custpo_num = urlencode($custponum);
             $partno = urlencode($partnum);
             $batch= urlencode($batchno);
             $psn=urlencode($psn);
           ?>
              <td bgcolor="#FFFFFF"><span class="tabletext">
                          <a href="print_prn.php?ponum=<?php echo $custpo_num ?>&partnum=<?php echo $partno?>&qty=<?php echo $dispatchqty?>&batchno=<?php echo $batch?>&psn=<?php echo $psn?>&wonum=<?php echo $wonum?>">Save</td>
<?php
$n++;
        }
?>

</table>
<br>
<?php
//echo count($wo_num)."--------";

/*if($myrow[36] == 'Assembly')
{ */
?>

<!--<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
<tr bgcolor="#DDDEDD">
<td colspan=15><span class="heading"><center><b>Line Items(Assembly WO's)</b></center></td>
</tr>
       <tr>
            <td bgcolor="#EEEFEE" width=3%><span class="heading"><b>Line</b></td>
            <td bgcolor="#EEEFEE" width=6%><span class="heading"><b>WO#</b></td>
			<td bgcolor="#EEEFEE" width=6%><span class="heading"><b>Supplier<br/>WO#</b></td>
            <td bgcolor="#EEEFEE" width=6%><span class="heading"><b>Part #</b></td>
            <td bgcolor="#EEEFEE" width=6%><span class="heading"><b>Part <br>Name</b></td>
            <td bgcolor="#EEEFEE" width=6%><span class="heading"><b>RM Spec</b></td>
            <td bgcolor="#EEEFEE" width=6%><span class="heading"><b>Part<br>Iss</b></td>
            <td bgcolor="#EEEFEE" width=6%><span class="heading"><b>Drg <br>Iss</b></td>
            <td bgcolor="#EEEFEE" width=10%><span class="heading"><b>COS</b></td>
            <td bgcolor="#EEEFEE" width=6%><span class="heading"><b>GRN/WO</b></td>
            <td bgcolor="#EEEFEE" width=6%><span class="heading"><b>Batch No</b></td>
            <td bgcolor="#EEEFEE" width=6%><span class="heading"><b>Custpo Num</b></td>
            <td bgcolor="#EEEFEE" width=6%><span class="heading"><b>Item<br>Num</b></td>
            <td bgcolor="#EEEFEE" width=6%><span class="heading"><b>WO Comp<br>&nbsp;&nbspDate</b></td>
            <td bgcolor="#EEEFEE" width=6%><span class="heading"><b>WO Qty</b></td>
            <td bgcolor="#EEEFEE" width=6%><span class="heading"><b>Acc Qty</b></td>
            <td bgcolor="#EEEFEE" width=6%><span class="heading"><b>Dispatch Qty</b></td>
            <td bgcolor="#EEEFEE" width=6%><span class="heading"><b>Packing<br>Slip No</b></td>


       </tr> -->
       <?php
  /*     $ln=1;
  for($z=0;$z<count($wo_num);$z++)
  {
    // echo $wo_num[$z]."**********-----";



        $m = 0;
        $result4assy = $newLI->getLI4aasywo($wo_num[$z]);

        while ($myLI4assy = mysql_fetch_assoc($result4assy)) {


            $line_num = $myLI4assy["linenum"];
            $partname = "";
            $drgiss = "";
            $partiss = $myLI4assy["issue"];
            $cos = "";
            $itemnum = $myLI4assy["itemno"];
            $datecode = "";
            $rmspec = "";
            $wonum = $wo_num[$z];
			$supplier_wonum = "";
            $partnum = $myLI4assy["partnum"];
            $rmspec = "";
            $woqty = $myLI4assy["qty_wo"];
            $compqty = $myLI4assy["qty_acc"];
            $grnnum = $myLI4assy["grn"];
            //$delvby = $myLI["delv_by"];
            $custponum = "";
            $custpoqty = "";
            $dispatchqty = "";
            $disp_update = "";
            $batchno = "";
            $psn = "";
            $lirec = $myLI["recnum"];

              $m = $m + 1;
	         echo"<tr><td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$ln</td>" ;
             echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$wonum</td>";
			 echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$supplier_wonum</td>";
             echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$partnum</td>";
             echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$partname</td>";
             echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$rmspec</td>";
             echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$partiss</td>";
             echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$drgiss</td>";
             echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$cos</td>";
             echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$grnnum</td>";
             echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$batchno</td>";
             echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$custponum</td>";
             echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$itemnum</td>";
             echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$custpodate</td>";
             echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$woqty</td>";
             echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$compqty</td>";
             echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$dispatchqty</td>";
             echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$psn</td>";
             //$custpo_num = urlencode($custponum);
             //$partno = urlencode($partnum);
             //$batch= urlencode($batchno);
             //$psn=urlencode($psn); */
           ?>
             <!-- <td bgcolor="#FFFFFF"><span class="tabletext">
                          <a href="print_prn.php?ponum=<?php// echo $custpo_num ?>&partnum=<?php// echo $partno?>&qty=<?php //echo $dispatchqty?>&batchno=<?php// echo $batch?>&psn=<?php //echo $psn?>&wonum=<?php //echo $wonum?>">Save</td>-->
<?php
// $ln++;
//}
        //}  */
?>
<!--</table> -->
<?php
//}*/
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
<table border = 0 cellpadding=0 cellspacing=0 width=100% >
<tr>
<td align=left>
</td>
</tr>
</table>
</FORM>
</body>
</html>
