<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = Mar 10, 2010                 =
// Filename: dnDetails.php                     =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 WMS                          =
// Allows entry of Dispatchs                   =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];
//echo date('t');
$_SESSION['pagename'] = 'dnDetails';
$page = "Post Process: D Note";
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
// echo "recnum" . $delrecnum;exit;
$result = $newDn->getdeliverDetails($delrecnum);
$myrow = mysql_fetch_row($result);
?>

<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/dn.js"></script>

<html>
<head>
<title>Delivery Note Details</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">
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
<table width=100% border=0>
<tr>
<td><span class="pageheading"><b>Delivery Note Details</b></td>
<td align="right">
<?php
    //if ($dept != 'Stores')
    //{
?>
             <td align="right">
<input type="button" class="stdbtn btn_blue" style="float:right;padding:2px;margin-right:5px;" onClick="location.href='dnEdit.php?recnum=<?php echo $delrecnum ?>'" value="Edit" >
              <!-- <a href ="dnEdit.php?recnum=<?php echo $delrecnum ?>" ><img name="Image8" border="0" src="images/bu-edit.gif" ></a> -->
<input type="button" class="stdbtn btn_blue" style="float:right;padding:2px;margin-right:5px;" onClick="javascript: printCofc(<?php echo $delrecnum ?>)" value="Print" >

              <!-- <img src="images/bu-print.gif" alt="Print CofC" onClick="javascript: printCofc(<?php echo $delrecnum ?>)"> -->
<?php
    //}
?>
        </td>
</tr>
</table>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
<tr bgcolor="#FFFFFF">
<tr bgcolor="#EEEFEE"><td colspan=4><span class="heading"><center><b>General Information</b></center></td>
</tr>  </table>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1">
<tr bgcolor="#FFFFFF">
<td width="25%"><span class="labeltext"><p align="left">DN Number</p></font></td>
<td colspan=3><span class="tabletext"><b><?php echo $myrow[1] ?></b></td>
</td>

</tr>

<tr bgcolor="#FFFFFF">
<td width="25%"><span class="labeltext"><p align="left">Sent for treatment To</p></font></td>
<td><span class="tabletext"><?php echo $myrow[2] ?></td>
<?php
$newDn = new dn;
$result = $newDn->getVendors();
?>
<td width="25%"><span class="labeltext"><p align="left">After treatment deliver To</p></font></td>
<td><span class="tabletext"><?php echo $myrow[3] ?></td>
</tr>

<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">PRN</p></font></td>
<td><span class="tabletext"><b><?php echo $myrow[4] ?></b></td>
<td><span class="labeltext"><p align="left">Delivery Date</p></font></td>
<?
 if($myrow[5] != '0000-00-00' && $myrow[5] != '' && $myrow[5] != 'NULL')
              {
                $datearr = split('-', $myrow[5]);
                $d=$datearr[2];
                $m=$datearr[1];
                $y=$datearr[0];
                $x=mktime(0,0,0,$m,$d,$y);
                $deliver_date=date("M j, Y",$x);
	          }
	      else
          {
                $deliver_date="";
	      }
		  ?>
 <td><span class="tabletext"><?php echo $deliver_date ?></td>
</tr>

<!-- <tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">PO Num</p></font></td>
<td><span class="tabletext"><?php echo $myrow[6] ?></td>
<td><span class="labeltext"><p align="left">PO Date</p></font></td>
<?
 if($myrow[7] != '0000-00-00' && $myrow[7] != '' && $myrow[7] != 'NULL')
              {
                $datearr = split('-', $myrow[7]);
                $d=$datearr[2];
                $m=$datearr[1];
                $y=$datearr[0];
                $x=mktime(0,0,0,$m,$d,$y);
                $po_date=date("M j, Y",$x);
	          }
	      else
          {
                $po_date="";
	      }
		  ?>
 <td><span class="tabletext"><?php echo $po_date ?></td>	
</td>
</tr>

<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">PO Line # </p></font></td>
<td><span class="tabletext"><?php echo $myrow[8] ?></td>
<td><span class="labeltext"><p align="left">PO Qty</p></font></td>
<td><span class="tabletext"><?php echo $myrow[23] ?></td>
</tr> -->

<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left"><span class='asterisk'></span>WO #</p></font>
<td><span class="tabletext"><b><?php echo $myrow[9] ?></b></td>
<td><span class="labeltext"><p align="left">Untreated Part # </p></font></td>
<td><span class="tabletext"><?php echo $myrow[10] ?></td>

</tr>

<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">Treated Part # </p></font></td>
<td><span class="tabletext"><?php echo $myrow[11] ?></td>
<td><span class="labeltext"><p align="left">Part Iss</p></font></td>
<td><span class="tabletext"><?php echo $myrow[12] ?></td>

</tr>

<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">Drg Iss </p></font></td>
<td><span class="tabletext"><?php echo $myrow[13] ?></td>
<td><span class="labeltext"><p align="left">COS</p></font></td>
<td><span class="tabletext"><?php echo $myrow[14] ?></td>

</tr>

<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">Mtl Spec </p></font></td>
<td><span class="tabletext"><?php echo $myrow[15] ?></td>
<td><span class="labeltext"><p align="left">GRN</p></font></td>
<td><span class="tabletext"><?php echo $myrow[16] ?></td>
</tr>

<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">Batch Num </p></font></td>
<td><span class="tabletext"><?php echo $myrow[17] ?></td>
<td><span class="labeltext"><p align="left">Qty</p></font></td>
<td><span class="tabletext"><?php echo $myrow[18] ?></td>
</tr>
<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">Status</p></font></td>
<td><span class="tabletext"><?php echo $myrow[22] ?></td>
<td><span class="labeltext"><p align="left">Type</p></font></td>
<td><span class="tabletext"><?php echo $myrow[24] ?></td>
</tr>
<tr bgcolor="#FFFFFF">
<td><span class="labeltext">Remarks</font></td>
<td colspan=3><textarea name="remarks" rows="3"
			      style="background-color:#DDDDDD;"
                    readonly="readonly"
			      cols="90"><?php echo $myrow[21] ?></textarea></td>   
</tr>

</table>
<input type="hidden" name="page" value="new">
<br>
<tr bgcolor="#DDDEDD">
<td bgcolor="#DDDEDD" colspan=12><span class="heading"><center><b>Receipts Line Items</b></center></td>
</tr>
<table id="myTable" width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable">
<tr>
<thead>
<th class="head0" width=3%><span class="heading"><b>Line</b></th>
<th class="head1" width=3%><span class="heading"><b>Dn Stage</b></th>
<th class="head0" width=6%><span class="heading"><b>CofC #</b></th>
<th class="head1" width=6%><span class="heading"><b>Cofc Date</b></th>
<th class="head0" width=6%><span class="heading"><b>Cost</b></th>
<th class="head1" width=6%><span class="heading"><b>Qty Recd</b></th>
<!--<td bgcolor="#EEEFEE" width=6%><span class="heading"><b>Qty Rej</b></td>
<td bgcolor="#EEEFEE" width=6%><span class="heading"><b>Qty Rew</b></td> -->
<th class="head0" width=6%><span class="heading"><b>Supplier WO</b></th>
<th class="head1" width=6%><span class="heading"><b>Date Code</b></th>
<th class="head0" width=6%><span class="heading"><b>Qty Acc</b></th>
<th class="head1" width=6%><span class="heading"><b>Qty Rew</b></th>
<th class="head0" width=6%><span class="heading"><b>Qty Rej</b></th>
<th class="head1" width=6%><span class="heading"><b>NC #</b></th>
<th class="head0" width=6%><span class="heading"><b>Disp Qty</b></th>
<th class="head1" width=10%><span class="heading"><b>Insp Stamp</b></th>
</tr>

<?php
$i=1;
$result = $newLI->getLI($delrecnum);
while ($myLI = mysql_fetch_assoc($result)) {


	if($myLI["cofc_date"] != '0000-00-00' && $myLI["cofc_date"] != '' && $myLI["cofc_date"] != 'NULL')
           {
              $datearr = split('-', $myLI["cofc_date"]);
              $d=$datearr[2];
              $m=$datearr[1];
              $y=$datearr[0];
              $x=mktime(0,0,0,$m,$d,$y);
              $cofc_date=date("M j, Y",$x);
           }
           else
           {
              $cofc_date = '';
           }
           
      if($myLI["datecode"] != '0000-00-00' && $myLI["datecode"] != '' && $myLI["datecode"] != 'NULL')
           {
              $datearr = split('-', $myLI["datecode"]);
              $d=$datearr[2];
              $m=$datearr[1];
              $y=$datearr[0];
              $x=mktime(0,0,0,$m,$d,$y);
              $dc=date("M j, Y",$x);
           }
           else
           {
              $dc = '';
           }

            $line_num = $myLI["line_num"];
            $dn_stage = $myLI["dn_stage"];
            $cofc_num = $myLI["cofc_num"];     
            $cofc_date = $myLI["cofc_date"];
            $qty_recd = $myLI["qty_recd"];
            $qty_acc = $myLI["qty_acc"];
            $qty_rej = $myLI["qty_rej"];
            $insp_stamp = $myLI["insp_stamp"];
            $suppwo =  $myLI["supplier_wo"];
            $nc_num=$myLI["ncnum"];
             $disp_qty=$myLI["disp_qty"];
            $cost=$myLI["cost"];
            //$qty_rej4stores=$myLI["qtyrej4store"];
            //$qty_rew = $myLI["qty_rew"];
            $qty_rewqa = $myLI["qty_rewqa"];
             $i = $i + 1;
	         echo"<tr><td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$line_num</td>" ;
           echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$dn_stage</td>" ;
             echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$cofc_num</td>";
             echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$cofc_date</td>";
             echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$cost</td>";
             echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$qty_recd</td>";
             //echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$qty_rej4stores</td>";
             //echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$qty_rew</td>";
             echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$suppwo</td>";
             echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$dc</td>";
             echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$qty_acc</td>";
             echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$qty_rewqa</td>";
             echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$qty_rej</td>";
             echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$nc_num</td>";
             echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$disp_qty</td>";
             echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$insp_stamp</td>";            

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
<table border = 0 cellpadding=0 cellspacing=0 width=100%>
<tr>
<td align=left>
</td>
</tr>
</table>
</FORM>
</body>
</html>
