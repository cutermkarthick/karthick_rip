<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = Mar 21, 2007                 =
// Filename: printqualityplanDetails.php       =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OWT                          =
// print Quality Plan Details                  =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];

$_SESSION['pagename'] = 'ds_details';
//////session_register('pagename');

// First include the class definition

include('classes/mtl_trackerclass.php');
include('classes/liClass.php');
include('classes/displayClass.php');

$newlogin = new userlogin;
$newlogin->dbconnect();
$userid = $_SESSION['user'];

$newMT = new mtl_trk;
$newPO = new po_line_items;

$mtltrkrecnum = $_REQUEST['mtltrkrecnum'];
$result = $newMT->getmtltrk_details($mtltrkrecnum);
$myrow = mysql_fetch_row($result);
$result1 = $newMT->getmtltrk_li($mtltrkrecnum);

?>
<link rel="stylesheet" href="style.css">

<html>
<head>
<title></title>
</head>

<table width=125%% border=0>
<tr><td align=center><font style="Arial" size=5><center><b><A HREF="javascript:window.print()">Material Tracker Details</A></b></center></td</tr>
</table>

<table border=0 bgcolor="#FFFFFF" width=125% cellspacing=1 cellpadding=3>
   <tr><td>&nbsp; </td> </tr>
</table>
<div style="overflow: scroll; width: 760px; height: 590px;">
<table border=0 bgcolor="#DFDEDF" width=125% cellspacing=1 cellpadding=3>

<tr bgcolor="#DDDEDD"><td colspan=4><span class="heading"><center><b>General Information</b></center></td></tr>

<table width=125% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >

        <tr bgcolor="#FFFFFF">
            <td colspan=2 bgcolor="#FFFFFF"><span class="labeltext"><p align="center">PO#</p></td>
            <td colspan=3><span class="tabletext"><?php echo $myrow[1] ?></td>
            <td colspan=2 bgcolor="#FFFFFF"><span class="labeltext"><p align="center">Vendor</p></td>
            <td colspan=9><span class="tabletext"><?php echo "$myrow[5]<br>$myrow[6],$myrow[7]<br>$myrow[8]-$myrow[9]<br>ph-$myrow[10]." ?></td>
        </tr>

        <tr bgcolor="#FFFFFF">
            <td colspan=15 align=right><a href ="javascript:displayActivityLog()"><img src="images/bu-activitylog.gif" border=0></a></td>

        </tr>
        <tr bgcolor="#FFFFFF">

            <td colspan=2><span class="labeltext"><p align="center">CIM</p></font></td>
            <td class="cnf"><span class="labeltext"><p align="center">C&F</p></font></td>
            <td colspan=5  class="sup"><span class="labeltext"><p align="center">Supplier</p></font></td>
            <td><span class="labeltext"><p align="center">CIM</p></font></td>
            <td colspan=3  class="ff"><span class="labeltext"><p align="center">Frieght Forwarder</p></font></td>
            <td colspan=3  class="cnf"><span class="labeltext"><p align="center">C&F</p></font></td>

        </tr>
       <tr bgcolor="#EEEEEE">

            <td width=6%><span class="labeltext"><p align="center">Part#</p></font></td>
            <td width=6%><span class="labeltext"><p align="center">Qty</p></font></td>
            <td width=6%><span class="labeltext"><p align="center">Adv Lic Qty</p></font></td>
            <td width=6%><span class="labeltext"><p align="center">Inv#</p></font></td>
            <td width=6%><span class="labeltext"><p align="center">Inv Date</p></font></td>
            <td width=6%><span class="labeltext"><p align="center">Inv Qty</p></font></td>
            <td width=6%><span class="labeltext"><p align="center">Delivery <br>Date</p></font></td>
            <td width=6%><span class="labeltext"><p align="center">Pay Due Dt</p></font></td>

            <td width=6%><span class="labeltext"><p align="center">Pay Exp Dt</p></font></td>
            <td width=6%><span class="labeltext"><p align="center">Pick Dt</p></font></td>
            <td width=6%><span class="labeltext"><p align="center">Sail Dt</p></font></td>
            <td width=6%><span class="labeltext"><p align="center">EDA</p></font></td>
            <td width=6%><span class="labeltext"><p align="center">AAD</p></font></td>
            <td width=6%><span class="labeltext"><p align="center">Exp Cl Dt</p></font></td>
            <td width=6%><span class="labeltext"><p align="center">Delivery<br>Date</p></font></td>

        </tr>


         <?php

            $i=1;
            $partname = '';
            while ($myLI = mysql_fetch_row($result1)) {

            $adv_license_qty = 'adv_license_qty' . $i;
            $invnum ='invnum' . $i;
            $invdate = 'invdate' . $i;
            $invqty ='invqty' . $i;
            $supdel_date ='supdel_date' . $i;
            $paydue_date ='paydue_date' . $i;
            $payexp_date ='payexp_date' . $i;
            $pick_date ='pick_date' . $i;
            $sail_date ='sail_date' . $i;
            $eda ='eda' . $i;
            $aad ='aad' . $i;
            $expclr_date ='expclr_date' . $i;
            $cfdel_date ='cfdel_date' . $i;

            $date2 = substr($myLI[2],2,8);
            if($date2 == '00-00-00')
            {
               $date2 = '';
            }

            $date4 = substr($myLI[4],2,8);
            if($date4 == '00-00-00')
            {
               $date4 = '';
            }

            $date5 = substr($myLI[5],2,8);
            if($date5 == '00-00-00')
            {
               $date5 = '';
            }

            $date6 = substr($myLI[6],2,8);
            if($date6 == '00-00-00')
            {
               $date6 = '';
            }

            $date7 = substr($myLI[7],2,8);
            if($date7 == '00-00-00')
            {
               $date7 = '';
            }

            $date8 = substr($myLI[8],2,8);
            if($date8 == '00-00-00')
            {
               $date8 = '';
            }

            $date9 = substr($myLI[9],2,8);
            if($date9 == '00-00-00')
            {
               $date9 = '';
            }

            $date10 = substr($myLI[10],2,8);
            if($date10 == '00-00-00')
            {
               $date10 = '';
            }

            $date11 = substr($myLI[11],2,8);
            if($date11 == '00-00-00')
            {
               $date11 = '';
            }

            $date12 = substr($myLI[12],2,8);
            if($date12 == '00-00-00')
            {
               $date12 = '';
            }

            if($partname != $myLI[15])
            {
            echo "<table id=\"mtltrk$i\"  width=125% border=0 cellpadding=3 cellspacing=1 bgcolor=\"#DFDEDF\" ><tr bgcolor=\"#FFFFFF\" ><td width=6%><span class=\"labeltext\"><p align=\"center\">$myLI[15]</p></font></td>";
            echo "<td width=6%><span class=\"tabletext\"><p align=\"center\">$myLI[18]</p></font></td>";
            echo "<td width=6%><span class=\"tabletext\">$myLI[16]</td>";
            echo "<td width=6%><span class=\"tabletext\">$myLI[1]</td>";
            echo "<td width=6%><span class=\"tabletext\">$date2</td>";
            echo "<td width=6%><span class=\"tabletext\">$myLI[3]</td>";
            echo "<td width=6%><span class=\"tabletext\">$date4</td>";
            echo "<td width=6%><span class=\"tabletext\">$date5</td>";

            echo "<td width=6%><span class=\"tabletext\">$date6</td>";
            echo "<td width=6%><span class=\"tabletext\">$date7</td>";
            echo "<td width=6%><span class=\"tabletext\">$date8</td>";
            echo "<td width=6%><span class=\"tabletext\">$date9</td>";
            echo "<td width=6%><span class=\"tabletext\">$date10</td>";
            echo "<td width=6%><span class=\"tabletext\">$date11</td>";
            echo "<td width=6%><span class=\"tabletext\">$date12</td>";
            }

            else

            {
            echo "<tr bgcolor=\"#FFFFFF\" ><td width=6%><span class=\"labeltext\"><p align=\"center\"></p></font></td>";
            echo "<td width=6%><span class=\"tabletext\"><p align=\"center\"></p></font></td>";
            echo "<td width=6%></td>";
            echo "<td width=6%><span class=\"tabletext\">$myLI[1]</td>";
            echo "<td width=6%><span class=\"tabletext\">$date2</td>";
            echo "<td width=6%><span class=\"tabletext\">$myLI[3]</td>";
            echo "<td width=6%><span class=\"tabletext\">$date4</td>";
            echo "<td width=6%><span class=\"tabletext\">$date5</td>";

            echo "<td width=6%><span class=\"tabletext\">$date6</td>";
            echo "<td width=6%><span class=\"tabletext\">$date7</td>";
            echo "<td width=6%><span class=\"tabletext\">$date8</td>";
            echo "<td width=6%><span class=\"tabletext\">$date9</td>";
            echo "<td width=6%><span class=\"tabletext\">$date10</td>";
            echo "<td width=6%><span class=\"tabletext\">$date11</td>";
            echo "<td width=6%><span class=\"tabletext\">$date12</td>";
           }

            $i++;
            $partname = $myLI[15];
           }
            echo "<input type=\"hidden\" name=\"index\" value=\"$i\">";
       ?>
       </tr>
     <tr bgcolor="#EEEEEE">
</table>
</table>





<table width=125% border=0 cellpadding=0 cellspacing=0  >

	<tr>
	     		     <td bgcolor="#FFFFFF">
				<table width=100% border=0 cellpadding=6 cellspacing=0  >
    <tr>
        <td><span class="pageheading"><b>Original PO</b></td>

    </tr>


     <form action='processmaintain_machine.php' method='post' enctype='multipart/form-data'>
<tr>
<td colspan=2>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >

<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >


        <tr bgcolor="#EEEEEE">
            <td><span class="labeltext"><p align="center">Mtl Ref(Part#)</p></font></td>
            <td><span class="labeltext"><p align="center">Qty Per Year</p></font></td>
            <td><span class="labeltext"><p align="center">Item</p></font></td>
            <td><span class="labeltext"><p align="center">Desc</p></font></td>
            <td><span class="labeltext"><p align="center">Mtl Spec</p></font></td>
            <td><span class="labeltext"><p align="center">Thick/Dia</p></font></td>
            <td><span class="labeltext"><p align="center">Width</p></font></td>
            <td><span class="labeltext"><p align="center">Length</p></font></td>
            <td><span class="labeltext"><p align="center">Qty Per Meter/Billet</p></font></td>
            <td><span class="labeltext"><p align="center">No of <br>meterages <br>required <br>or No of <br>Lengths</p></font></td>

            <td><span class="labeltext"><p align="center">Cost per<br>meterage or<br>per length<br>in USD</p></font></td>

        </tr>
        <?php

        $i = 0;
        $result3 = $newPO->getLI4mtltrk($mtltrkrecnum);

        while ($myLI = mysql_fetch_assoc($result3)) {
             //echo "hiiiiiiiiiiiii $ponum";
            $d=substr($myLI["duedate"],8,2);
            $m=substr($myLI["duedate"],5,2);
            $y=substr($myLI["duedate"],0,4);
            $x=mktime(0,0,0,$m,$d,$y);
            $date=date("M j, Y",$x);
            //echo "$date";
            $line_num = $myLI["line_num"];
            $item_name = $myLI["item_name"];
            $item_desc = $myLI["item_desc"];
            $qty = $myLI["qty"];
            $material_ref = $myLI["material_ref"];
            $material_spec = $myLI["material_spec"];
            $thick = $myLI["thick"];
            $width = $myLI["width"];
            $length = $myLI["length"];
            $qty_per_meter = $myLI["qty_per_meter"];
            $no_of_meterages = $myLI["no_of_meterages"];


              $i = $i + 1;
                         echo"<tr><td bgcolor=\"#FFFFFF\" colspan=1 align=center><span class=\"tabletext\">$material_ref</td>";
                         echo"<td bgcolor=\"#FFFFFF\" colspan=1 align=center><span class=\"tabletext\">$qty</td>";
                         echo"<td bgcolor=\"#FFFFFF\" align=center><span class=\"tabletext\">$item_name</td>";
                         echo"<td bgcolor=\"#FFFFFF\" align=center><span class=\"tabletext\">$item_desc</td>";
                         echo"<td bgcolor=\"#FFFFFF\" colspan=1 align=center><span class=\"tabletext\">$material_spec</td>";
                         echo"<td bgcolor=\"#FFFFFF\" colspan=1 align=center><span class=\"tabletext\">$thick</td>";
                         echo"<td bgcolor=\"#FFFFFF\" colspan=1 align=center><span class=\"tabletext\">$width</td>";
                         echo"<td bgcolor=\"#FFFFFF\" colspan=1 align=center><span class=\"tabletext\">$length</td>";
                         echo"<td bgcolor=\"#FFFFFF\" colspan=1 align=center><span class=\"tabletext\">$qty_per_meter</td>";
                         echo"<td bgcolor=\"#FFFFFF\" colspan=1 align=center><span class=\"tabletext\">$no_of_meterages</td>";

                       //  printf('<td bgcolor="#FFFFFF" colspan=2><span class="tabletext">%s%.2f</td>',$myrow["currency"],$myLI["rate"]);
                         printf('<td align="right" bgcolor="#FFFFFF" colspan=2><span class="tabletext">%.2f</td>',$myLI["amount"]);

        }
?>
</table>
  </div>
</body>
</html>
