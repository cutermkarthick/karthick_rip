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
$lirecnum = $_REQUEST['lirecnum'];
$result = $newMT->getmtltrk_details($mtltrkrecnum);
$myrow = mysql_fetch_row($result);
$result1 = $newMT->getmtltrk_li_row($mtltrkrecnum,$lirecnum);

?>
<link rel="stylesheet" href="style.css">

<html>
<head>
<title></title>
</head>

<table width=125% border=0>
<tr><td align=center><font style="Arial" size=5><center><b><A HREF="javascript:window.print()">Material Tracker Details</A></b></center></td</tr>
</table>

<table border=0 bgcolor="#FFFFFF" width=100% cellspacing=1 cellpadding=3>
   <tr><td>&nbsp; </td> </tr>
</table>
<div style="overflow: scroll; width: 800px; height: 300px;">
<table border=0 bgcolor="#DFDEDF" width=200% cellspacing=1 cellpadding=3>

<tr bgcolor="#DDDEDD"><td colspan=9><span class="heading"><center><b>General Information</b></center></td></tr>

<table width=200% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >


        <tr bgcolor="#FFFFFF">

            <td colspan=3><span class="labeltext"><p align="center">CIM</p></font></td>
            <!--<td class="cnf"><span class="labeltext"><p align="center">C&F</p></font></td> -->
            <td colspan=8  class="sup"><span class="labeltext"><p align="center">AMS</p></font></td>
            <td><span class="labeltext"><p align="center">CIM</p></font></td>
            <td colspan=3  class="ff"><span class="labeltext"><p align="center">Frieght Forwarder</p></font></td>
            <td colspan=5  class="cnf"><span class="labeltext"><p align="center">C&F</p></font></td>

        </tr>
       <tr bgcolor="#EEEEEE">
            <td width=4%><span class="labeltext"><p align="center">Line Num</p></font></td>
            <td width=4%><span class="labeltext"><p align="center">RM Code</p></font></td>
            <td width=4%><span class="labeltext"><p align="center">Qty</p></font></td>
            <!--<td width=6%><span class="labeltext"><p align="center">Adv Lic Qty</p></font></td> -->
            <td width=4%><span class="labeltext"><p align="center">Inv#</p></font></td>
            <td width=4%><span class="labeltext"><p align="center">Inv Date</p></font></td>
            <td width=4%><span class="labeltext"><p align="center">Inv Qty</p></font></td>
            <td width=4%><span class="labeltext"><p align="center">Delivery <br>Date</p></font></td>

            <td width=4%><span class="labeltext"><p align="center">Pack No.</p></font></td>
            <td width=4%><span class="labeltext"><p align="center">Bill No.</p></font></td>
            <td width=4%><span class="labeltext"><p align="center">Bill Dt</p></font></td>
             <td width=4%><span class="labeltext"><p align="center">Pay Due Dt</p></font></td>
            <td width=4%><span class="labeltext"><p align="center">Pay Exp Dt</p></font></td>
            <td width=4%><span class="labeltext"><p align="center">Pick Dt</p></font></td>
            <td width=4%><span class="labeltext"><p align="center">Sail Dt</p></font></td>
            <td width=4%><span class="labeltext"><p align="center">EDA</p></font></td>
            <td width=4%><span class="labeltext"><p align="center">AAD</p></font></td>
            <td width=4%><span class="labeltext"><p align="center">Dock No.</p></font></td>
            <td width=4%><span class="labeltext"><p align="center">BOE No.</p></font></td>
            
            <td width=4%><span class="labeltext"><p align="center">Exp Cl Dt</p></font></td>
            <td width=4%><span class="labeltext"><p align="center">Delivery<br>Date</p></font></td>

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

            $date2 = $myLI[2];
            if($date2 == '0000-00-00')
            {
               $date2 = '';
            }

            $date4 = $myLI[23];
            if($date4 == '0000-00-00')
            {
               $date4 = '';
            }

            $date5 = $myLI[5];
            if($date5 == '0000-00-00')
            {
               $date5 = '';
            }

            $date6 = $myLI[6];
            if($date6 == '0000-00-00')
            {
               $date6 = '';
            }

            $date7 = $myLI[7];
            if($date7 == '0000-00-00')
            {
               $date7 = '';
            }

            $date8 = $myLI[8];
            if($date8 == '0000-00-00')
            {
               $date8 = '';
            }

            $date9 = $myLI[9];
            if($date9 == '0000-00-00')
            {
               $date9 = '';
            }

            $date10 = $myLI[10];
            if($date10 == '0000-00-00')
            {
               $date10 = '';
            }

            $date11 = $myLI[11];
            if($date11 == '0000-00-00')
            {
               $date11 = '';
            }

            $date12 = $myLI[12];
           // echo "<br>date12 is   $myLI[12]";
            if($date12 == '0000-00-00')
            {
              // echo "Here";
               $date12 = '';
            }

             $date13 = $myLI[19];
            if($date13 == '0000-00-00')
            {
               $date13 = '';
            }

             $date14 = $myLI[20];
            if($date14 == '0000-00-00')
            {
               $date14 = '';
            }

             $date15 = trim($myLI[21]);
            if($date15 == '0000-00-00')
            {
               $date15 = '';
            }

             $date16 = trim($myLI[22]);
            if($date16 == '0000-00-00')
            {
               $date16 = '';
            }

            $date17 = $myLI[25];

            $date18 = $myLI[26];

            $date19 = $myLI[27];
            if($date19 == '0000-00-00')
            {
               $date19 = '';
            }

            $date20 = $myLI[28];


            $date21 = $myLI[29];



            if($partname != $myLI[15])
            {
            echo "<table id=\"mtltrk$i\"  width=200% border=0 cellpadding=3 cellspacing=1 bgcolor=\"#DFDEDF\" ><tr bgcolor=\"#FFFFFF\" >";
            echo "<td width=4%><span class=\"tabletext\">$myLI[1]</td>";
            echo "<td width=4%><span class=\"labeltext\"><p align=\"center\">$myLI[15]</p></font></td>";
            echo "<td width=4%><span class=\"tabletext\"><p align=\"center\">$myLI[18]</p></font></td>";
           // echo "<td width=6%><span class=\"tabletext\">$myLI[16]</td>";
            echo "<td width=4%><span class=\"tabletext\">$myLI[1]</td>";
            echo "<td width=4%><span class=\"tabletext\">$date2</td>";
            echo "<td width=4%><span class=\"tabletext\">$myLI[3]</td>";
            echo "<td width=4%><span class=\"tabletext\">$date4</td>";
            echo "<td width=4%><span class=\"tabletext\">$date17</td>";
            echo "<td width=4%><span class=\"tabletext\">$date18</td>";
            echo "<td width=4%><span class=\"tabletext\">$date19</td>";
            echo "<td width=4%><span class=\"tabletext\">$date5</td>";

            echo "<td width=4%><span class=\"tabletext\">$date6</td>";
            echo "<td width=4%><span class=\"tabletext\">$date7</td>";
            echo "<td width=4%><span class=\"tabletext\">$date8</td>";
            echo "<td width=4%><span class=\"tabletext\">$date9</td>";
            echo "<td width=4%><span class=\"tabletext\">$date10</td>";
            echo "<td width=4%><span class=\"tabletext\">$date20</td>";
            echo "<td width=4%><span class=\"tabletext\">$date21</td>";
            echo "<td width=4%><span class=\"tabletext\">$date11</td>";
            echo "<td width=4%><span class=\"tabletext\">$date12</td>";
            }

            else

            {
            echo "<tr bgcolor=\"#FFFFFF\" ><td width=6%><span class=\"labeltext\"><p align=\"center\"></p></font></td>";
            echo "<td width=4%><span class=\"tabletext\">$myLI[24]</td>";
            echo "<td width=4%><span class=\"tabletext\"><p align=\"center\"></p></font></td>";
            //echo "<td width=6%></td>";
            echo "<td width=4%><span class=\"tabletext\">$myLI[1]</td>";
            echo "<td width=4%><span class=\"tabletext\">$date2</td>";
            echo "<td width=4%><span class=\"tabletext\">$myLI[3]</td>";
            echo "<td width=4%><span class=\"tabletext\">$date4</td>";
            echo "<td width=4%><span class=\"tabletext\">$date17</td>";
            echo "<td width=4%><span class=\"tabletext\">$date18</td>";
            echo "<td width=4%><span class=\"tabletext\">$date19</td>";
            echo "<td width=4%><span class=\"tabletext\">$date5</td>";

            echo "<td width=4%><span class=\"tabletext\">$date6</td>";
            echo "<td width=4%><span class=\"tabletext\">$date7</td>";
            echo "<td width=4%><span class=\"tabletext\">$date8</td>";
            echo "<td width=4%><span class=\"tabletext\">$date9</td>";
            echo "<td width=4%><span class=\"tabletext\">$date10</td>";
            echo "<td width=4%><span class=\"tabletext\">$date20</td>";
            echo "<td width=4%><span class=\"tabletext\">$date21</td>";
            echo "<td width=4%><span class=\"tabletext\">$date11</td>";
            echo "<td width=4%><span class=\"tabletext\">$date12</td>";
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


  </div>
</body>
</html>
