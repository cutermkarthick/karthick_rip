<?php
//
//==============================================
// Author: FSI                                 =
// Date-written: June 20, 2004                 =
// Filename: edit_mtltrk.php                   =
// Copyright of Badari Mandyam, FluentSoft     =
// Revision: v1.0 OMS                          =
// Board details                               =
//==============================================
session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );
}

// Includes
include_once('classes/loginClass.php');
include('classes/displayClass.php');
include('classes/mtl_trackerclass.php');
include('classes/liClass.php');

//$space='&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
$userid = $_SESSION['user'];
$_SESSION['pagename'] = 'edit_mtltrk';
//////session_register('pagename');

$usertype = $_SESSION['usertype'];
$userid = $_SESSION['user'];

if ( !isset ( $_SESSION['ms'] ) )
{
     $_SESSION['ms']=0;
}

//echo $usertype;
//echo $userid;

$newlogin = new userlogin;
$newlogin->dbconnect();
$newdisplay = new display;
$newMT = new mtl_trk;
$newPO = new po_line_items;

$ponum = $_REQUEST['ponum'];
$result = $newMT->getmtltrk_details($ponum);
$myrow = mysql_fetch_row($result);

$result1 = $newMT->getmtltrk_li($ponum);
if(isset($_REQUEST['error']))
{

 $err = $_REQUEST['error'];
 //echo "error no $err";
 $invnum = $_REQUEST['invnum'];
 if($err == 1)
 {
  $error = "Inv Date should be max of 15 days greater than Delivery Date for invnum $invnum";
 }
 else if($err == 2)
 {
  $error = "Vendor Pay Due Date should be greater than Inv Date for invnum $invnum";
 }
 else if($err == 3)
 {

  $error = "Pick Date should be greater than Inv Date for invnum $invnum";
 }
 else if($err == 4)
 {

  $error = "Sail Date should be greater than Pick Date for invnum $invnum";
 }
 else if($err == 5)
 {

  $error = "EDA should be greater than Sail Date for invnum $invnum";
 }
 else if($err == 6)
 {

  $error = "FF Pay Due Date should be greater than EDA for invnum $invnum";
 }
 else if($err == 7)
 {

  $error = "AAD should be greater than EDA for invnum $invnum";
 }
 else if($err == 8)
 {

  $error = "Exp Cl Dt should be greater than aad for invnum $invnum";
 }
 else if($err == 9)
 {

  $error = "CF Delivery Date should be greater than Exp Cl Dt for invnum $invnum";
 }
 else if($err == 10)
 {

  $error = "CF Pay Due Date should be greater than CF Delivery Date for invnum $invnum";
 }
 else if($err == 11)
 {

  $error = "Vendor Pay Due Date should be entered for invnum $invnum";
 }
 else if($err == 12)
 {

  $error = "CF Pay Due Date should be entered for invnum $invnum";
 }
 else if($err == 13)
 {

  $error = "CF Pay Due Date should be entered for invnum $invnum";
 }
 //echo $error;
}
else
{
  //echo 'hiiiiii';
  $error = '';
}


?>
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/mtltrk.js"></script>
<script language="javascript" src="scripts/popcalendar.js"></script>
<link rel="stylesheet" href="style.css">

<html>
<head>
<title>Material Tracker Details</title>
</head>

<body leftmargin="0"topmargin="0" marginwidth="0">
<?php
include('header.html');
?>

<table width=200% cellspacing="0" cellpadding="6" border="0">

<tr><td>
<table width=100% border=0 cellspacing="0" cellpadding="0">
    <tr>

        <td><span class="welcome"><b>Welcome <?php echo $userid?></b></td>
        <td align="right">&nbsp;
        <a href="exit.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image16','','images/logout_mo.gif',1)"><img name="Image16" border="0" src="images/logout.gif"></a></td>

    </tr>
</table>


<table width=100% border=0 cellpadding=0 cellspacing=0  >
	<tr><td>

	</td></tr>
	<tr>
	<td>
<?php
    $newdisplay->dispLinks('');
?>
</td></tr>
</table>

<table width=100% border=0 cellpadding=0 cellspacing=0  >

	<tr bgcolor="DEDFDE"><td width="6"><img src="images/spacer.gif " width="6"></td>
	     		     <td bgcolor="#FFFFFF">
				<table width=100% border=0 cellpadding=6 cellspacing=0  >
    <tr>
        <td width=24%><span class="pageheading"><b>Material Tracker</b></td>
        <td align=left class=tabletext><font color='#ff0000'><?php echo $error; ?></font>
        </td>
    </tr>

     <form action='processmtltrk.php' method='post' enctype='multipart/form-data'>
<tr>
<td colspan=2>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
        <tr bgcolor="#DDDEDD">
            <td colspan=4><span class="heading"><center><b>Material Tracker Header</b></center></td>
        </tr>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >

        <tr bgcolor="#FFFFFF">
            <td colspan=4 bgcolor="#FFFFFF"><span class="labeltext"><p align="center">PO#</p></td>
            <td colspan=5><span class="tabletext"><?php echo $myrow[1] ?></td>
            <td colspan=5 bgcolor="#FFFFFF"><span class="labeltext"><p align="center">Supplier</p></td>
            <td colspan=11><span class="tabletext"><?php echo "$myrow[3]<br>$myrow[4],$myrow[5]<br>$myrow[6]-$myrow[7]<br>ph-$myrow[8]." ?></td>
        </tr>

        <tr bgcolor="#FFFFFF">
            <td colspan=25 align=right>&nbsp</td>
        </tr>

        <tr bgcolor="#FFFFFF">

            <td colspan=4><span class="labeltext"><p align="center">Host</p></font></td>
            <!--<td class="cnf"><span class="labeltext"><p align="center">C&F</p></font></td>-->
            <td 
           <?php 
               if($usertype == 'VEND' || $usertype == 'EMPL') 
                  echo 'colspan=7'; 
               else echo 'colspan=6'; 
            ?> 
                class="sup">
               <span class="labeltext"><p align="center"><?php echo $myrow[3]; ?></p></font></td>
            <?php 
               if($usertype == 'VEND' || $usertype == 'EMPL')
               {
            ?>
            <td><span class="labeltext"><p align="center">Host</p></font></td>
            <?php
             }
            ?>
            <td 
           <?php 
               if($usertype == 'FF' || $usertype == 'EMPL') 
                  echo 'colspan=4'; 
               else echo 'colspan=3'; 
           ?>  class="ff">
              <span class="labeltext"><p align="center">Freight Forwarder</p></font></td>
            <?php if($usertype == 'FF' || $usertype == 'EMPL')
             {
            ?>

            <td><span class="labeltext"><p align="center">Host</p></font></td>
            <?php
             }
            ?>
            <td <?php if($usertype == 'CF' || $usertype == 'EMPL') echo 'colspan=6'; else echo 'colspan=5'; ?> class="cnf"><span class="labeltext"><p align="center">C&F</p></font></td>
           <?php if($usertype == 'CF' || $usertype == 'EMPL')
             {
            ?>
            <td><span class="labeltext"><p align="center">Host</p></font></td>
            <?php
             }
            ?>

        </tr>
       <tr bgcolor="#EEEEEE">
            <td width=2% ><span class="labeltext"><p align="center">LN</p></font></td>
            <td width=2% ><span class="labeltext"><p align="center">Mtl Spec</p></font></td>
            <td width=2% ><span class="labeltext"><p align="center">Qty</p></font></td>
           <!-- <td width=6%> <span class="labeltext"><p align="center">Adv Lic Qty</p></font></td> -->
            <td width=2% ><span class="labeltext"><p align="center">Del <br>Date</p></font></td>
            <td width=2% bgcolor="#FF9900"><span class="labeltext"><p align="center">Inv</p></font></td>
            <td width=3% bgcolor="#FF9900"><span class="labeltext"><p align="center">Inv Dt</p></font></td>
            <td width=2% bgcolor="#FF9900"><span class="labeltext"><p align="center">Inv Qty</p></font></td>
            <td width=2% bgcolor="#FF9900"><span class="labeltext"><p align="center">P/S #</p></font></td>
            <td width=2% bgcolor="#FF9900"><span class="labeltext"><p align="center">B/L #</p></font></td>
            <td width=2% bgcolor="#FF9900"><span class="labeltext"><p align="center">B/L Dt</p></font></td>
          <?php if($usertype == 'EMPL' || $usertype == 'VEND')
           {
          ?>
            <td width=3% bgcolor="#FF9900"><span class="labeltext"><p align="center">Pay Due Dt</p></font></td>
          <?php
           }

           if($usertype == 'EMPL' || $usertype == 'VEND')
           {
          ?>
            <td><span class="labeltext"><p align="center">Pay Exp Dt</p></font></td>
          <?
           }
          ?>
            <td bgcolor="#A0C544"><span class="labeltext"><p align="center">Pick Dt</p></font></td>
            <td bgcolor="#A0C544"><span class="labeltext"><p align="center">Sail Dt</p></font></td>
            <td bgcolor="#A0C544"><span class="labeltext"><p align="center">EDA</p></font></td>
         <?php if($usertype == 'EMPL' || $usertype == 'FF')
           {
         ?>
            <td bgcolor="#A0C544"><span class="labeltext"><p align="center">Pay Due Dt</p></font></td>
            <td><span class="labeltext"><p align="center">Pay Exp Dt</p></font></td>
         <?php
           }
         ?>

            <td bgcolor="#659EC7"><span class="labeltext"><p align="center">AAD</p></font></td>
            <td bgcolor="#659EC7"><span class="labeltext"><p align="center">Dock No.</p></font></td>
            <td bgcolor="#659EC7"><span class="labeltext"><p align="center">BOE No.</p></font></td>
            <td bgcolor="#659EC7"><span class="labeltext"><p align="center">Exp Cl Dt</p></font></td>
            <td bgcolor="#659EC7"><span class="labeltext"><p align="center">Delivery Date</p></font></td>

         <?php if($usertype == 'EMPL' || $usertype == 'CF')
           {
         ?>
            <td bgcolor="#659EC7"><span class="labeltext"><p align="center">Pay Due Dt</p></font></td>
            <td><span class="labeltext"><p align="center">Pay Exp Dt</p></font></td>
         <?php
           }
         ?>
        </tr>

        <?php

            $i=1;
            $polirecnum = '';
            while ($myLI = mysql_fetch_row($result1)) {


            $j = 0;
        $result3 = $newPO->getLI4mtltrk($ponum);

        while ($myLI1 = mysql_fetch_assoc($result3)) {
             //echo "hiiiiiiiiiiiii $ponum";

            if($myLI1["duedate"] != '0000-00-00' && $myLI1["duedate"] != '' && $myLI1["duedate"] != 'NULL')
            {
                  $datearr = split('-',$myLI1["duedate"]);
                  $d=$datearr[2];
                  $m=$datearr[1];
                  $y=$datearr[0];
                  $x=mktime(0,0,0,$m,$d,$y);
                  $due[$j]=date("M j, Y",$x);
            }
            else
           {
                 $due[$j] = '';
           }
              $j++;
         }


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
            $link2mtltracker ='link2mtltracker' . $i;
            $prevlinenum="prev_line_num" . $i;
            $lirecnum="lirecnum" . $i;
            $partnum = 'partnum' . $i;
            $ffpaydue_date ='ffpaydue_date' . $i;
            $ffpayexp_date ='ffpayexp_date' . $i;
            $cfpaydue_date ='cfpaydue_date' . $i;
            $cfpayexp_date ='cfpayexp_date' . $i;
            $packnum = 'packnum' . $i;
            $bill_lading_num ='bill_lading_num' . $i;
            $bil_lading_date ='bil_lading_date' . $i;
            $docket_num ='docket_num' . $i;
            $boe_num ='boe_num' . $i;


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

            
            echo "<input type=\"hidden\" name=\"ms\" id=\"ms\" value=\"1\">";

         if($polirecnum != $myLI[17])
         {
            //echo "<table id=\"mtltrk$i\" colspan=20 width=100% border=0 cellpadding=3 cellspacing=1 bgcolor=\"#DFDEDF\" ><tr bgcolor=\"#FFFFFF\" >";
            echo "<tr bgcolor=\"#FFFFFF\" >";
            echo "<td width=1% ><span class=\"labeltext\"><p align=\"center\">$myLI[24]</p></font></td>";
            echo "<td width=2% ><span class=\"labeltext\"><p align=\"center\">$myLI[30]</p></font></td>";
            //echo "<td width=2% ><span class=\"tabletext\"><p align=\"center\">$myLI[18]</p></font></td>";
            $myLI[16]=$myLI[16]?$myLI[16]:$myLI[18];
            echo "<td width=2% ><span class=\"tabletext\"><p align=\"center\">$myLI[16]</p></font></td>";

            if(($usertype == 'VEND') && ($myLI[22] == '' || $myLI[22] =='0000-00-00'))
            {
              //echo "here1";
              if($usertype == 'VEND')
              {
               // echo "here1";
               if($date7 == '')
               {
                echo "<td width=1%><span class=\"tabletext\"><p align=\"left\">$date4</p></font></td>";
                echo "<td width=2%><input type=\"textbox\" size=\"2\" name=\"$invnum\"  value=\"$myLI[1]\"></td>";
                echo "<td  width=3%><input type=\"textbox\" size=\"9\" name=\"$invdate\" id=\"$invdate\" onfocus=\"javascript:fPopCalendar1('$invdate','$invdate');\" onchange=\"javascript:alert('hi');\" value=\"$date2\"></td>";
                //onblur=\"javascript:chkInvDate('$date2','$date4')\"
                echo "<td width=2%><input type=\"textbox\" size=\"2\" name=\"$invqty\" value=\"$myLI[3]\"></td>";

                echo "<td><input type=\"textbox\" size=\"4\" name=\"$packnum\" id=\"$packnum\" value=\"$date17\"></td>";
                echo "<td><input type=\"textbox\" size=\"4\" name=\"$bill_lading_num\" id=\"$bill_lading_num\" value=\"$date18\"></td>";
                echo "<td><input type=\"textbox\" size=\"9\" name=\"$bil_lading_date\" id=\"$bil_lading_date\" onfocus=\"javascript:fPopCalendar1('$bil_lading_date','$bil_lading_date');\" value=\"$date19\"></td>";
                
                echo "<td><input type=\"textbox\" size=\"9\" name=\"$paydue_date\" id=\"$paydue_date\"  onfocus=\"javascript:fPopCalendar1('$paydue_date','$paydue_date');\" value=\"$date5\"></td>";
                //echo "<td width=6%><span class=\"tabletext\">$date5</td>";

                //echo "<td width=4% align=center><a href=\"javascript:addRow('mtltrk$i',document.forms[0].index.value,'$myLI[17]','$date4','ms')\"><img src=\"images/arrow2.gif\" border=0></td>";

               // echo "<input type=\"hidden\" name=\"$paydue_date\" id=\"$paydue_date\" size=\"7\"  onfocus=\"javascript:fPopCalendar1('$paydue_date','$paydue_date');\" value=\"$date5\">";
                echo "<input type=\"hidden\" name=\"$supdel_date\" id=\"$supdel_date\" size=\"7\"  onfocus=\"javascript:fPopCalendar1('$supdel_date','$supdel_date');\" value=\"$date4\">";
               }
               
               else if($date6 == '')
               {
                echo "<td><span class=\"tabletext\">$date4</td>";
                echo "<td><span class=\"tabletext\">$myLI[1]</td>";
                echo "<td><span class=\"tabletext\">$date2</td>";
                echo "<td><span class=\"tabletext\">$myLI[3]</td>";
                echo "<td><span class=\"tabletext\">$date17</td>";
                echo "<td><span class=\"tabletext\">$date18</td>";
                echo "<td><span class=\"tabletext\">$date19</td>";
                echo "<td><input type=\"textbox\" name=\"$paydue_date\" id=\"$paydue_date\" size=\"8\"  onfocus=\"javascript:fPopCalendar1('$paydue_date','$paydue_date');\" value=\"$date5\"></td>";
                //echo "<td><span class=\"tabletext\">$date5</td>";

                echo "<td align=center><a href=\"javascript:addRow('mtltrk$i',document.forms[0].index.value,'$myLI[17]','$date4','ms')\"><img src=\"images/arrow2.gif\" border=0></td>";

               // echo "<input type=\"hidden\" name=\"$paydue_date\" id=\"$paydue_date\" size=\"7\"  onfocus=\"javascript:fPopCalendar1('$paydue_date','$paydue_date');\" value=\"$date5\">";
                echo "<input type=\"hidden\" name=\"$invnum\" size=\"7\" value=\"$myLI[1]\">";
                echo "<input type=\"hidden\" name=\"$invdate\" size=\"7\" id=\"$invdate\" onfocus=\"javascript:fPopCalendar1('$invdate','$invdate');\" value=\"$date2\">";
                echo "<input type=\"hidden\" name=\"$invqty\" size=\"7\" value=\"$myLI[3]\">";
                echo "<input type=\"hidden\" name=\"$supdel_date\" id=\"$supdel_date\" size=\"7\"  onfocus=\"javascript:fPopCalendar1('$supdel_date','$supdel_date');\" value=\"$date4\">";
                echo "<input type=\"hidden\" name=\"$supdel_date\" id=\"$supdel_date\" size=\"7\"  onfocus=\"javascript:fPopCalendar1('$supdel_date','$supdel_date');\" value=\"$date4\">";
                echo "<input type=\"hidden\" name=\"$packnum\" id=\"$packnum\" size=\"8\" value=\"$date17\">";
                echo "<input type=\"hidden\" name=\"$bill_lading_num\" id=\"$bill_lading_num\" size=\"8\" value=\"$date18\">";
                echo "<input type=\"hidden\" name=\"$bil_lading_date\" id=\"$bil_lading_date\" size=\"8\"  onfocus=\"javascript:fPopCalendar1('$bil_lading_date','$bil_lading_date');\" value=\"$date19\">";

               }

               else
               {

                  echo "<td><span class=\"tabletext\">$date4</td>";
                  echo "<td><span class=\"tabletext\">$myLI[1]</td>";
                  echo "<td><span class=\"tabletext\">$date2</td>";
                  echo "<td><span class=\"tabletext\">$myLI[3]</td>";
                  echo "<td><span class=\"tabletext\">$date17</td>";
                  echo "<td><span class=\"tabletext\">$date18</td>";
                  echo "<td><span class=\"tabletext\">$date19</td>";
                  echo "<td><span class=\"tabletext\">$date5</td>";

                  //echo "<td align=center><a href=\"javascript:addRow('mtltrk$i',document.forms[0].index.value,'$myLI[17]','$date4')\"><img src=\"images/arrow2.gif\" border=0></td>";

                  echo "<input type=\"hidden\" name=\"$invnum\" size=\"7\" value=\"$myLI[1]\">";
                  echo "<input type=\"hidden\" name=\"$invdate\" size=\"8\" id=\"$invdate\" onfocus=\"javascript:fPopCalendar1('$invdate','$invdate');\" value=\"$date2\">";
                  echo "<input type=\"hidden\" name=\"$invqty\" size=\"7\" value=\"$myLI[3]\">";
                  echo "<input type=\"hidden\" name=\"$supdel_date\" id=\"$supdel_date\" size=\"7\"  onfocus=\"javascript:fPopCalendar1('$supdel_date','$supdel_date');\" value=\"$date4\">";
                  echo "<input type=\"hidden\" name=\"$packnum\" id=\"$packnum\" size=\"8\" value=\"$date17\">";
                  echo "<input type=\"hidden\" name=\"$bill_lading_num\" id=\"$bill_lading_num\" size=\"8\" value=\"$date18\">";
                  echo "<input type=\"hidden\" name=\"$bil_lading_date\" id=\"$bil_lading_date\" size=\"8\"  onfocus=\"javascript:fPopCalendar1('$bil_lading_date','$bil_lading_date');\" value=\"$date19\">";
                  echo "<input type=\"hidden\" name=\"$paydue_date\" id=\"$paydue_date\" size=\"7\"  onfocus=\"javascript:fPopCalendar1('$paydue_date','$paydue_date');\" value=\"$date5\">";

               }

              }

            }
            else
            {
              //echo "here2";


              echo "<td width=4%><span class=\"tabletext\">$date4</td>";
              echo "<td width=4%><span class=\"tabletext\">$myLI[1]</td>";
              echo "<td width=4%><span class=\"tabletext\">$date2</td>";
              echo "<td width=4%><span class=\"tabletext\">$myLI[3]</td>";
              echo "<td width=4%><span class=\"tabletext\">$date17</td>";
              echo "<td width=4%><span class=\"tabletext\">$date18</td>";
              echo "<td width=4%><span class=\"tabletext\">$date19</td>";
              if($usertype == 'EMPL' || $usertype == 'VEND')
              {

              echo "<td width=4%><span class=\"tabletext\">$date5</td>";
              }

             // echo "<td width=3% align=center><a href=\"javascript:addRow('mtltrk$i',document.forms[0].index.value,'$myLI[17]')\"><img src=\"images/arrow2.gif\" border=0></td>";
              //echo "<td width=4%></td>";
              echo "<input type=\"hidden\" name=\"$invnum\" size=\"7\" value=\"$myLI[1]\">";
              echo "<input type=\"hidden\" name=\"$invdate\" size=\"7\" id=\"$invdate\" onfocus=\"javascript:fPopCalendar1('$invdate','$invdate');\" value=\"$date2\">";
              echo "<input type=\"hidden\" name=\"$invqty\" size=\"7\" value=\"$myLI[3]\">";
              echo "<input type=\"hidden\" name=\"$supdel_date\" id=\"$supdel_date\" size=\"7\"  onfocus=\"javascript:fPopCalendar1('$supdel_date','$supdel_date');\" value=\"$date4\">";
              echo "<input type=\"hidden\" name=\"$paydue_date\" id=\"$paydue_date\" size=\"7\"  onfocus=\"javascript:fPopCalendar1('$paydue_date','$paydue_date');\" value=\"$date5\">";
              echo "<input type=\"hidden\" name=\"$packnum\" id=\"$packnum\" size=\"8\" value=\"$date17\">";
              echo "<input type=\"hidden\" name=\"$bill_lading_num\" id=\"$bill_lading_num\" size=\"8\" value=\"$date18\">";
              echo "<input type=\"hidden\" name=\"$bil_lading_date\" id=\"$bil_lading_date\" size=\"8\"  onfocus=\"javascript:fPopCalendar1('$bil_lading_date','$bil_lading_date');\" value=\"$date19\">";

            }



            if(($usertype == 'EMPL' || $usertype == 'VEND') && ($myLI[22] == '' || $myLI[22] =='0000-00-00') && $date5!='')
            {
             // echo "hi";
              if($usertype == 'EMPL')
              {
              echo "<td width=4%><input type=\"textbox\" name=\"$payexp_date\" id=\"$payexp_date\" size=\"8\" onfocus=\"javascript:fPopCalendar1('$payexp_date','$payexp_date');\" value=\"$date6\"></td>";
              }
              else if($usertype == 'VEND')
              {
                echo "<td width=4%><span class=\"tabletext\">$date6</td>";
               echo "<input type=\"hidden\" name=\"$payexp_date\" id=\"$payexp_date\" size=\"7\" onfocus=\"javascript:fPopCalendar1('$payexp_date','$payexp_date');\" value=\"$date6\">";
              }
            }
            else
            {

                if($usertype == 'EMPL' || $usertype == 'VEND')
                {
                  echo "<td width=4%><span class=\"tabletext\">$date6</td>";
                }
            echo "<input type=\"hidden\" name=\"$payexp_date\" id=\"$payexp_date\" size=\"7\" onfocus=\"javascript:fPopCalendar1('$payexp_date','$payexp_date');\" value=\"$date6\">";
            }
            if(($usertype == 'FF' || $usertype == 'EMPL') &&($myLI[22] == '' || $myLI[22] =='0000-00-00') && $date2 != '' )
            {
             //echo "here2";
              if($usertype == 'FF')
              {
                if($date10 == '')
                {
                  echo "<td width=4%><input type=\"textbox\" name=\"$pick_date\" id=\"$pick_date\" size=\"8\" onfocus=\"javascript:fPopCalendar1('$pick_date','$pick_date');\" value=\"$date7\"></td>";
                  echo "<td width=4%><input type=\"textbox\" name=\"$sail_date\" id=\"$sail_date\" size=\"8\" onfocus=\"javascript:fPopCalendar1('$sail_date','$sail_date');\" value=\"$date8\"></td>";
                  echo "<td width=4%><input type=\"textbox\" name=\"$eda\" id=\"$eda\" size=\"8\" onfocus=\"javascript:fPopCalendar1('$eda','$eda');\" value=\"$date9\"></td>";
                  //echo "<td width=6%><span class=\"tabletext\">$date13</td>";
                  echo "<td width=4%><input type=\"textbox\" name=\"$ffpaydue_date\" id=\"$ffpaydue_date\" size=\"8\" onfocus=\"javascript:fPopCalendar1('$ffpaydue_date','$ffpaydue_date');\" value=\"$date13\"></td>";
                  echo "<td width=4%><span class=\"tabletext\">$date14</td>";
                  //echo "<td width=6%><input type=\"textbox\" name=\"$ffpaydue_date\" id=\"$ffpaydue_date\" size=\"7\" onfocus=\"javascript:fPopCalendar1('$ffpaydue_date','$ffpaydue_date');\" value=\"$date13\"></td>";
                  //echo "<td width=6%><input type=\"textbox\" name=\"$ffpayexp_date\" id=\"$ffpayexp_date\" size=\"7\" onfocus=\"javascript:fPopCalendar1('$ffpayexp_date','$ffpayexp_date');\" value=\"$date14\"></td>";

                  //echo "<input type=\"hidden\" name=\"$ffpaydue_date\" id=\"$ffpaydue_date\" size=\"7\" value=\"$date13\">";
                  echo "<input type=\"hidden\" name=\"$ffpayexp_date\" id=\"$ffpayexp_date\" size=\"7\" value=\"$date14\">";
                }
                
                else if($date14 == '')
                {
                  echo "<td width=4%><span class=\"tabletext\">$date7</td>";
                  echo "<td width=4%><span class=\"tabletext\">$date8</td>";
                  echo "<td width=4%><span class=\"tabletext\">$date9</td>";
                  echo "<td width=4%><input type=\"textbox\" name=\"$ffpaydue_date\" id=\"$ffpaydue_date\" size=\"8\" onfocus=\"javascript:fPopCalendar1('$ffpaydue_date','$ffpaydue_date');\" value=\"$date13\"></td>";
                  echo "<td width=4%><span class=\"tabletext\">$date14</td>";
                  //echo "<td width=6%><input type=\"textbox\" name=\"$ffpaydue_date\" id=\"$ffpaydue_date\" size=\"7\" onfocus=\"javascript:fPopCalendar1('$ffpaydue_date','$ffpaydue_date');\" value=\"$date13\"></td>";
                  //echo "<td width=6%><input type=\"textbox\" name=\"$ffpayexp_date\" id=\"$ffpayexp_date\" size=\"7\" onfocus=\"javascript:fPopCalendar1('$ffpayexp_date','$ffpayexp_date');\" value=\"$date14\"></td>";

                  //echo "<input type=\"hidden\" name=\"$ffpaydue_date\" id=\"$ffpaydue_date\" size=\"7\" value=\"$date13\">";
                  echo "<input type=\"hidden\" name=\"$pick_date\" id=\"$pick_date\" size=\"7\" onfocus=\"javascript:fPopCalendar1('$pick_date','$pick_date');\" value=\"$date7\">";
                  echo "<input type=\"hidden\" name=\"$sail_date\" id=\"$sail_date\" size=\"7\" onfocus=\"javascript:fPopCalendar1('$sail_date','$sail_date');\" value=\"$date8\">";
                  echo "<input type=\"hidden\" name=\"$eda\" id=\"$eda\" size=\"7\" onfocus=\"javascript:fPopCalendar1('$eda','$eda');\" value=\"$date9\">";
                  echo "<input type=\"hidden\" name=\"$ffpayexp_date\" id=\"$ffpayexp_date\" size=\"7\" value=\"$date14\">";
                }
                
                else
                {
                   echo "<td width=4%><span class=\"tabletext\">$date7</td>";
                   echo "<td width=4%><span class=\"tabletext\">$date8</td>";
                   echo "<td width=4%><span class=\"tabletext\">$date9</td>";
                   echo "<td width=4%><span class=\"tabletext\">$date13</td>";
                   echo "<td width=4%><span class=\"tabletext\">$date14</td>";
                  //echo "<td width=6%><input type=\"textbox\" name=\"$ffpaydue_date\" id=\"$ffpaydue_date\" size=\"7\" onfocus=\"javascript:fPopCalendar1('$ffpaydue_date','$ffpaydue_date');\" value=\"$date13\"></td>";
                  //echo "<td width=6%><input type=\"textbox\" name=\"$ffpayexp_date\" id=\"$ffpayexp_date\" size=\"7\" onfocus=\"javascript:fPopCalendar1('$ffpayexp_date','$ffpayexp_date');\" value=\"$date14\"></td>";

                  //echo "<input type=\"hidden\" name=\"$ffpaydue_date\" id=\"$ffpaydue_date\" size=\"7\" value=\"$date13\">";
                  echo "<input type=\"hidden\" name=\"$pick_date\" id=\"$pick_date\" size=\"7\" onfocus=\"javascript:fPopCalendar1('$pick_date','$pick_date');\" value=\"$date7\">";
                  echo "<input type=\"hidden\" name=\"$sail_date\" id=\"$sail_date\" size=\"7\" onfocus=\"javascript:fPopCalendar1('$sail_date','$sail_date');\" value=\"$date8\">";
                  echo "<input type=\"hidden\" name=\"$eda\" id=\"$eda\" size=\"7\" onfocus=\"javascript:fPopCalendar1('$eda','$eda');\" value=\"$date9\">";
                  echo "<input type=\"hidden\" name=\"$ffpaydue_date\" id=\"$ffpaydue_date\" size=\"7\" value=\"$date13\">";
                  echo "<input type=\"hidden\" name=\"$ffpayexp_date\" id=\"$ffpayexp_date\" size=\"7\" value=\"$date14\">";
                }
              }

              else if($usertype == 'EMPL' )
              {
                echo "<td width=4%><span class=\"tabletext\">$date7</td>";
                echo "<td width=4%><span class=\"tabletext\">$date8</td>";
                echo "<td width=4%><span class=\"tabletext\">$date9</td>";
                echo "<td width=4%><span class=\"tabletext\">$date13</td>";
                if($date9 != '')
                {
                //echo "<td width=6%><input type=\"textbox\" name=\"$ffpaydue_date\" id=\"$ffpaydue_date\" size=\"8\" onfocus=\"javascript:fPopCalendar1('$ffpaydue_date','$ffpaydue_date');\" value=\"$date13\"></td>";
                echo "<td width=4%><input type=\"textbox\" name=\"$ffpayexp_date\" id=\"$ffpayexp_date\" size=\"8\" onfocus=\"javascript:fPopCalendar1('$ffpayexp_date','$ffpayexp_date');\" value=\"$date14\"></td>";
                }
                else
                {
                 //echo "<td width=6%><span class=\"tabletext\">$date13</td>";
                 echo "<td width=4%><span class=\"tabletext\">$date14</td>";
                }
                echo "<input type=\"hidden\" name=\"$pick_date\" id=\"$pick_date\" size=\"7\" onfocus=\"javascript:fPopCalendar1('$pick_date','$pick_date');\" value=\"$date7\">";
                echo "<input type=\"hidden\" name=\"$sail_date\" id=\"$sail_date\" size=\"7\" onfocus=\"javascript:fPopCalendar1('$sail_date','$sail_date');\" value=\"$date8\">";
                echo "<input type=\"hidden\" name=\"$eda\" id=\"$eda\" size=\"7\" onfocus=\"javascript:fPopCalendar1('$eda','$eda');\" value=\"$date9\">";
                echo "<input type=\"hidden\" name=\"$ffpaydue_date\" id=\"$ffpaydue_date\" size=\"7\" value=\"$date13\">";
              }

            }

            else
            {

              //echo "here";
              echo "<td width=4%><span class=\"tabletext\">$date7</td>";
              echo "<td width=4%><span class=\"tabletext\">$date8</td>";
              echo "<td width=4%><span class=\"tabletext\">$date9</td>";
              if($usertype == 'EMPL' || $usertype == 'FF')
              {
              echo "<td width=4%><span class=\"tabletext\">$date13</td>";
              echo "<td width=4%><span class=\"tabletext\">$date14</td>";
              }
              echo "<input type=\"hidden\" name=\"$pick_date\" id=\"$pick_date\" size=\"7\" onfocus=\"javascript:fPopCalendar1('$pick_date','$pick_date');\" value=\"$date7\">";
              echo "<input type=\"hidden\" name=\"$sail_date\" id=\"$sail_date\" size=\"7\" onfocus=\"javascript:fPopCalendar1('$sail_date','$sail_date');\" value=\"$date8\">";
              echo "<input type=\"hidden\" name=\"$eda\" id=\"$eda\" size=\"7\" onfocus=\"javascript:fPopCalendar1('$eda','$eda');\" value=\"$date9\">";
              echo "<input type=\"hidden\" name=\"$ffpaydue_date\" id=\"$ffpaydue_date\" size=\"7\" value=\"$date13\">";
              echo "<input type=\"hidden\" name=\"$ffpayexp_date\" id=\"$ffpayexp_date\" size=\"7\" value=\"$date14\">";

            }

            if(($usertype == 'CF' || $usertype == 'EMPL') && ($myLI[22] == '' || $myLI[22] =='0000-00-00')  && $date9 != '')
            {
              $date12 = $date12 ? $date12 : $space;
              $date15 = $date15 ? $date15 : $space;
              $date16 = $date16 ? $date16 : $space;
              //  echo "<br>after ternary date12 is   $date12";
              // echo "here4";
              if($usertype == 'CF')
              {

                if( $date15 == '' || $date15 == $space)
                {

                 echo "<td width=4%><input type=\"textbox\" name=\"$aad\" id=\"$aad\" size=\"8\" onfocus=\"javascript:fPopCalendar1('$aad','$aad');\" value=\"$date10\"></td>";
                 echo "<td width=4%><input type=\"textbox\" name=\"$docket_num\" id=\"$docket_num\" size=\"8\" value=\"$date20\"></td>";
                 echo "<td width=4%><input type=\"textbox\" name=\"$boe_num\" id=\"$boe_num\" size=\"8\" value=\"$date21\"></td>";
                 echo "<td width=4%><input type=\"textbox\" name=\"$expclr_date\" id=\"$expclr_date\" size=\"8\" onfocus=\"javascript:fPopCalendar1('$expclr_date','$expclr_date');\" value=\"$date11\"></td>";
                 echo "<td width=4%><input type=\"textbox\" name=\"$cfdel_date\" id=\"$cfdel_date\" size=\"8\" onfocus=\"javascript:fPopCalendar1('$cfdel_date','$cfdel_date');\" value=\"$date12\"></td>";
                 //echo "<td width=6%><span class=\"tabletext\">" . $date15 . "</td>";
                 echo "<td width=4%><input type=\"textbox\" name=\"$cfpaydue_date\" id=\"$cfpaydue_date\" size=\"8\" onfocus=\"javascript:fPopCalendar1('$cfpaydue_date','$cfpaydue_date');\" value=\"$date15\"></td>";
                 echo "<td width=4%><span class=\"tabletext\">" . $date16 . "</td>";
                 //echo "<td width=6%><input type=\"textbox\" name=\"$cfpaydue_date\" id=\"$cfpaydue_date\" size=\"4\" onfocus=\"javascript:fPopCalendar1('$cfpaydue_date','$cfpaydue_date');\" value=\"$date15\"></td>";
                 //echo "<td width=6%><input type=\"textbox\" name=\"$cfpayexp_date\" id=\"$cfpayexp_date\" size=\"4\" onfocus=\"javascript:fPopCalendar1('$cfpayexp_date','$cfpayexp_date');\" value=\"$date16\"></td>";

                 //echo "<input type=\"hidden\" name=\"$cfpaydue_date\" id=\"$cfpaydue_date\" size=\"7\" value=\"$date15\">";
                 echo "<input type=\"hidden\" name=\"$cfpayexp_date\" id=\"$cfpayexp_date\" size=\"7\" value=\"$date16\">";
                }
                
                else if( $date16 == '' || $date16 == $space)
                {

                 echo "<td width=4%><span class=\"tabletext\">$date10</td>";
                 echo "<td width=4%><span class=\"tabletext\">$date20</td>";
                 echo "<td width=4%><span class=\"tabletext\">$date21</td>";
                 echo "<td width=4%><span class=\"tabletext\">$date11</td>";
                 echo "<td width=4%><span class=\"tabletext\">" . $date12 . "</td>";
                 echo "<td width=4%><input type=\"textbox\" name=\"$cfpaydue_date\" id=\"$cfpaydue_date\" size=\"8\" onfocus=\"javascript:fPopCalendar1('$cfpaydue_date','$cfpaydue_date');\" value=\"$date15\"></td>";
                 echo "<td width=4%><span class=\"tabletext\">" . $date16 . "</td>";
                 //echo "<td width=6%><input type=\"textbox\" name=\"$cfpaydue_date\" id=\"$cfpaydue_date\" size=\"4\" onfocus=\"javascript:fPopCalendar1('$cfpaydue_date','$cfpaydue_date');\" value=\"$date15\"></td>";
                 //echo "<td width=6%><input type=\"textbox\" name=\"$cfpayexp_date\" id=\"$cfpayexp_date\" size=\"4\" onfocus=\"javascript:fPopCalendar1('$cfpayexp_date','$cfpayexp_date');\" value=\"$date16\"></td>";

                 //echo "<input type=\"hidden\" name=\"$cfpaydue_date\" id=\"$cfpaydue_date\" size=\"7\" value=\"$date15\">";

                 echo "<input type=\"hidden\" name=\"$aad\" id=\"$aad\" onfocus=\"javascript:fPopCalendar1('$aad','$aad');\" value=\"$date10\">";
                 echo "<input type=\"hidden\" name=\"$docket_num\" id=\"$docket_num\" size=\"8\" value=\"$myLI[28]\">";
                 echo "<input type=\"hidden\" name=\"$boe_num\" id=\"$boe_num\" size=\"8\" value=\"$date21\">";
                 echo "<input type=\"hidden\" name=\"$expclr_date\" id=\"$expclr_date\" size=\"7\" onfocus=\"javascript:fPopCalendar1('$expclr_date','$expclr_date');\" value=\"$date11\">";
                 echo "<input type=\"hidden\" name=\"$cfdel_date\" id=\"$cfdel_date\" size=\"7\" onfocus=\"javascript:fPopCalendar1('$cfdel_date','$cfdel_date');\" value=\"$date12\">";
                 echo "<input type=\"hidden\" name=\"$cfpayexp_date\" id=\"$cfpayexp_date\" size=\"7\" value=\"$date16\">";
                }
                
                else
                {
                   echo "<td width=4%><span class=\"tabletext\">$date10</td>";
                   echo "<td width=4%><span class=\"tabletext\">$date20</td>";
                   echo "<td width=4%><span class=\"tabletext\">$date21</td>";
                   echo "<td width=4%><span class=\"tabletext\">$date11</td>";
                   echo "<td width=4%><span class=\"tabletext\">" . $date12 . "</td>";
                   echo "<td width=4%><span class=\"tabletext\">" . $date15 . "</td>";
                   echo "<td width=4%><span class=\"tabletext\">" . $date16 . "</td>";
                 //echo "<td width=6%><input type=\"textbox\" name=\"$cfpaydue_date\" id=\"$cfpaydue_date\" size=\"4\" onfocus=\"javascript:fPopCalendar1('$cfpaydue_date','$cfpaydue_date');\" value=\"$date15\"></td>";
                 //echo "<td width=6%><input type=\"textbox\" name=\"$cfpayexp_date\" id=\"$cfpayexp_date\" size=\"4\" onfocus=\"javascript:fPopCalendar1('$cfpayexp_date','$cfpayexp_date');\" value=\"$date16\"></td>";
                 //echo "<input type=\"hidden\" name=\"$cfpaydue_date\" id=\"$cfpaydue_date\" size=\"7\" value=\"$date15\">";
                 echo "<input type=\"hidden\" name=\"$aad\" id=\"$aad\" onfocus=\"javascript:fPopCalendar1('$aad','$aad');\" value=\"$date10\">";
                 echo "<input type=\"hidden\" name=\"$docket_num\" id=\"$docket_num\" size=\"8\" value=\"$date20\">";
                 echo "<input type=\"hidden\" name=\"$boe_num\" id=\"$boe_num\" size=\"8\" value=\"$date21\">";
                 echo "<input type=\"hidden\" name=\"$expclr_date\" id=\"$expclr_date\" size=\"7\" onfocus=\"javascript:fPopCalendar1('$expclr_date','$expclr_date');\" value=\"$date11\">";
                 echo "<input type=\"hidden\" name=\"$cfdel_date\" id=\"$cfdel_date\" size=\"7\" onfocus=\"javascript:fPopCalendar1('$cfdel_date','$cfdel_date');\" value=\"$date12\">";
                 echo "<input type=\"hidden\" name=\"$cfpaydue_date\" id=\"$cfpaydue_date\" size=\"7\" value=\"$date15\">";
                 echo "<input type=\"hidden\" name=\"$cfpayexp_date\" id=\"$cfpayexp_date\" size=\"7\" value=\"$date16\">";

                }
              }
              else if($usertype == 'EMPL' )
              {
                echo "<td width=4%><span class=\"tabletext\">$date10</td>";
                echo "<td width=4%><span class=\"tabletext\">$date20</td>";
                echo "<td width=4%><span class=\"tabletext\">$date21</td>";
                echo "<td width=4%><span class=\"tabletext\">$date11</td>";
                echo "<td width=4%><span class=\"tabletext\">" . $date12 . "</td>";
                echo "<td width=4%><span class=\"tabletext\">" . $date15 . "</td>";
               if($date12 != '' && $date12 != $space)
               {
                //echo "<td width=6%><input type=\"textbox\" name=\"$cfpaydue_date\" id=\"$cfpaydue_date\" size=\"8\" onfocus=\"javascript:fPopCalendar1('$cfpaydue_date','$cfpaydue_date');\" value=\"$date15\"></td>";
                echo "<td width=4%><input type=\"textbox\" name=\"$cfpayexp_date\" id=\"$cfpayexp_date\" size=\"8\" onfocus=\"javascript:fPopCalendar1('$cfpayexp_date','$cfpayexp_date');\" value=\"$date16\"></td>";
               }
               else
               {
                //echo "<td width=6%><span class=\"tabletext\">" . $date15 . "</td>";
                echo "<td width=4%><span class=\"tabletext\">" . $date16 . "</td>";
               }
                echo "<input type=\"hidden\" name=\"$aad\" id=\"$aad\" onfocus=\"javascript:fPopCalendar1('$aad','$aad');\" value=\"$date10\">";
                echo "<input type=\"hidden\" name=\"$docket_num\" id=\"$docket_num\" size=\"8\" value=\"$date20\">";
                echo "<input type=\"hidden\" name=\"$boe_num\" id=\"$boe_num\" size=\"8\" value=\"$date21\">";
                echo "<input type=\"hidden\" name=\"$expclr_date\" id=\"$expclr_date\" size=\"7\" onfocus=\"javascript:fPopCalendar1('$expclr_date','$expclr_date');\" value=\"$date11\">";
                echo "<input type=\"hidden\" name=\"$cfdel_date\" id=\"$cfdel_date\" size=\"7\" onfocus=\"javascript:fPopCalendar1('$cfdel_date','$cfdel_date');\" value=\"$date12\">";
                echo "<input type=\"hidden\" name=\"$cfpaydue_date\" id=\"$cfpaydue_date\" size=\"7\" value=\"$date15\">";
              }


           }
            else
            {
             //  echo "here1";
             $date12 = $date12 ? $date12 : $space;
             $date15 = $date15 ? $date15 : $space;
             $date16 = $date16 ? $date16 : $space;
            // echo "<br>after ternary date12 is   $date12";

              echo "<td width=4%><span class=\"tabletext\">$date10</td>";
              echo "<td width=4%><span class=\"tabletext\">$date20</td>";
              echo "<td width=4%><span class=\"tabletext\">$date21</td>";
              echo "<td width=4%><span class=\"tabletext\">$date11</td>";
              echo "<td width=4%><span class=\"tabletext\">" . $date12 . "</td>";

              if($usertype == 'EMPL' || $usertype == 'CF')
              {
                echo "<td width=4%><span class=\"tabletext\">" . $date15 . "</td>";
                echo "<td width=4%><span class=\"tabletext\">" . $date16 . "</td>";
              }

              echo "<input type=\"hidden\" name=\"$aad\" id=\"$aad\" onfocus=\"javascript:fPopCalendar1('$aad','$aad');\" value=\"$date10\">";
              echo "<input type=\"hidden\" name=\"$docket_num\" id=\"$docket_num\" size=\"8\" value=\"$date20\">";
              echo "<input type=\"hidden\" name=\"$boe_num\" id=\"$boe_num\" size=\"8\" value=\"$date21\">";
              echo "<input type=\"hidden\" name=\"$expclr_date\" id=\"$expclr_date\" size=\"7\" onfocus=\"javascript:fPopCalendar1('$expclr_date','$expclr_date');\" value=\"$date11\">";
              echo "<input type=\"hidden\" name=\"$cfdel_date\" id=\"$cfdel_date\" size=\"7\" onfocus=\"javascript:fPopCalendar1('$cfdel_date','$cfdel_date');\" value=\"$date12\">";
              echo "<input type=\"hidden\" name=\"$cfpaydue_date\" id=\"$cfpaydue_date\" size=\"7\" value=\"$date15\">";
              echo "<input type=\"hidden\" name=\"$cfpayexp_date\" id=\"$cfpayexp_date\" size=\"7\" value=\"$date16\">";
            }

         }
        else
        {  // echo "hi";
           //$date4=$due[$i-2];

          echo "<tr bgcolor=\"#FFFFFF\" >";
          echo "<td width=4%><span class=\"labeltext\"><p align=\"center\">$myLI[24]</p></font></td>";
          echo  "<td width=4%><span class=\"labeltext\"><p align=\"center\">$myLI[15]</p></font></td>";
            echo "<td width=4%><span class=\"tabletext\"><p align=\"center\">$myLI[18]</p></font></td>";



            if($usertype == 'EMPL' && ($myLI[22] == '' || $myLI[22] =='0000-00-00'))
            {
             if($myLI[1] == '')
             {
                 $myLI[16]=$myLI[16]?$myLI[16]:$myLI[18];
              // echo "<td width=6%><input type=\"textbox\" name=\"$adv_license_qty\" size=\"4\" value=\"$myLI[16]\" onblur=\"javascript:checkValue($myLI[18],this.value,this)\"></td>";
             }
            // else
             //  echo "<td width=6%><span class=\"tabletext\">$myLI[16]</td>";
            }

            else
            {
             // echo "<td width=6%><span class=\"tabletext\">$myLI[16]</td>";
            //  echo "<input type=\"hidden\" name=\"$adv_license_qty\" size=\"4\" value=\"$myLI[16]\">";
            }


           /* echo "<tr bgcolor=\"#FFFFFF\" ><td width=6%><span class=\"labeltext\"><p align=\"center\"></p></td>";
            echo "<td width=6%><span class=\"tabletext\"><p align=\"center\"></p></font></td>";
            echo "<td width=6%></td>";
                                         */
                       if(($usertype == 'VEND' || $usertype == 'EMPL') && ($myLI[22] == '' || $myLI[22] =='0000-00-00'))
            {
              if($usertype == 'VEND')
              {
                if($date7 == '')
                {
                  echo "<td width=4%><span class=\"tabletext\"><p align=\"center\">$date4</p></td>";
                  //echo "<td width=6%><input type=\"textbox\" name=\"$supdel_date\" id=\"$supdel_date\" size=\"8\"  onfocus=\"javascript:fPopCalendar1('$supdel_date','$supdel_date');\" value=\"$date4\"></td>";
                  echo "<td width=4%><input type=\"textbox\" name=\"$invnum\" size=\"4\" value=\"$myLI[1]\"></td>";
                  echo "<td width=4%><input type=\"textbox\" name=\"$invdate\" size=\"8\" id=\"$invdate\" onfocus=\"javascript:fPopCalendar1('$invdate','$invdate');\" value=\"$date2\"></td>";
                  echo "<td width=4%><input type=\"textbox\" name=\"$invqty\" size=\"3\" value=\"$myLI[3]\"></td>";
                  //echo "<td width=6%><span class=\"tabletext\">$date5</td>";
                  echo "<td width=4%><input type=\"textbox\" name=\"$packnum\" id=\"$packnum\" size=\"8\" value=\"$date17\"></td>";
                  echo "<td width=4%><input type=\"textbox\" name=\"$bill_lading_num\" id=\"$bill_lading_num\" size=\"8\" value=\"$date18\"></td>";
                  echo "<td width=4%><input type=\"textbox\" name=\"$bil_lading_date\" id=\"$bil_lading_date\" size=\"8\"  onfocus=\"javascript:fPopCalendar1('$bil_lading_date','$bil_lading_date');\" value=\"$date19\"></td>";


                  echo "<td width=4%><input type=\"textbox\" name=\"$paydue_date\" id=\"$paydue_date\" size=\"8\"  onfocus=\"javascript:fPopCalendar1('$paydue_date','$paydue_date');\" value=\"$date5\"></td>";
                  //echo "<input type=\"hidden\" name=\"$paydue_date\" id=\"$paydue_date\" size=\"7\" value=\"$date5\">";
                  echo "<input type=\"hidden\" name=\"$supdel_date\" id=\"$supdel_date\" size=\"7\" value=\"hi$date4\">";
                }
                
                else if($date6 == '')
                {
                  echo "<td width=4%><span class=\"tabletext\"><p align=\"center\">$date4</td>";
                  echo "<td width=4%><span class=\"tabletext\">$myLI[1]</td>";
                  echo "<td width=4%><span class=\"tabletext\">$date2</td>";
                  echo "<td width=4%><span class=\"tabletext\">$myLI[3]</td>";
                  echo "<td width=4%><span class=\"tabletext\">$date17</td>";
                  echo "<td width=4%><span class=\"tabletext\">$date18</td>";
                  echo "<td width=4%><span class=\"tabletext\">$date19</td>";
                  echo "<td width=4%><input type=\"textbox\" name=\"$paydue_date\" id=\"$paydue_date\" size=\"8\"  onfocus=\"javascript:fPopCalendar1('$paydue_date','$paydue_date');\" value=\"$date5\"></td>";
                  //echo "<input type=\"hidden\" name=\"$paydue_date\" id=\"$paydue_date\" size=\"7\" value=\"$date5\">";

                  echo "<input type=\"hidden\" name=\"$invnum\" size=\"7\" value=\"$myLI[1]\">";
                  echo "<input type=\"hidden\" name=\"$invdate\" size=\"7\" id=\"$invdate\" onfocus=\"javascript:fPopCalendar1('$invdate','$invdate');\" value=\"$date2\">";
                  echo "<input type=\"hidden\" name=\"$invqty\" size=\"7\" value=\"$myLI[3]\">";
                  echo "<input type=\"hidden\" name=\"$supdel_date\" id=\"$supdel_date\" size=\"7\" value=\"$date4\">";
                  echo "<input type=\"hidden\" name=\"$packnum\" id=\"$packnum\" size=\"7\" value=\"$date17\">";
                  echo "<input type=\"hidden\" name=\"$bill_lading_num\" id=\"$bill_lading_num\" size=\"7\" value=\"$date18\">";
                  echo "<input type=\"hidden\" name=\"$bil_lading_date\" id=\"$bil_lading_date\" size=\"7\" value=\"$date19\">";
                }
                
                else
                {

                   echo "<td width=4%><span class=\"tabletext\"><p align=\"center\">$date4</td>";
                   echo "<td width=4%><span class=\"tabletext\">$myLI[1]</td>";
                   echo "<td width=4%><span class=\"tabletext\">$date2</td>";
                   echo "<td width=4%><span class=\"tabletext\">$myLI[3]</td>";
                   echo "<td width=4%><span class=\"tabletext\">$date17</td>";
                   echo "<td width=4%><span class=\"tabletext\">$date18</td>";
                   echo "<td width=4%><span class=\"tabletext\">$date19</td>";
                   echo "<td width=4%><span class=\"tabletext\">$date5</td>";

                   echo "<input type=\"hidden\" name=\"$invnum\" size=\"7\" value=\"$myLI[1]\">";
                   echo "<input type=\"hidden\" name=\"$invdate\" size=\"7\" id=\"$invdate\" onfocus=\"javascript:fPopCalendar1('$invdate','$invdate');\" value=\"$date2\">";
                   echo "<input type=\"hidden\" name=\"$invqty\" size=\"7\" value=\"$myLI[3]\">";
                   echo "<input type=\"hidden\" name=\"$supdel_date\" id=\"$supdel_date\" size=\"7\" value=\"$date4\">";
                   echo "<input type=\"hidden\" name=\"$paydue_date\" id=\"$paydue_date\" size=\"7\" value=\"$date5\">";
                   echo "<input type=\"hidden\" name=\"$packnum\" id=\"$packnum\" size=\"7\" value=\"$date17\">";
                   echo "<input type=\"hidden\" name=\"$bill_lading_num\" id=\"$bill_lading_num\" size=\"7\" value=\"$date18\">";
                   echo "<input type=\"hidden\" name=\"$bil_lading_date\" id=\"$bil_lading_date\" size=\"7\" value=\"$date19\">";
                }
              }
              if($usertype == 'EMPL')
              {
               echo "<td width=4%><span class=\"tabletext\">$date4</td>";
               echo "<td width=4%><span class=\"tabletext\">$myLI[1]</td>";
               echo "<td width=4%><span class=\"tabletext\">$date2</td>";
               echo "<td width=4%><span class=\"tabletext\">$myLI[3]</td>";
               echo "<td width=4%><span class=\"tabletext\">$date17</td>";
               echo "<td width=4%><span class=\"tabletext\">$date18</td>";
               echo "<td width=4%><span class=\"tabletext\">$date19</td>";
               //if($date4 != '')
               //{
               //   echo "<td width=6%><input type=\"textbox\" name=\"$paydue_date\" id=\"$paydue_date\" size=\"8\"  onfocus=\"javascript:fPopCalendar1('$paydue_date','$paydue_date');\" value=\"$date5\"></td>";
               //}
              // else
              // {
                  echo "<td width=4%><span class=\"tabletext\">$date5</td>";
               //}
               echo "<input type=\"hidden\" name=\"$invnum\" size=\"7\" value=\"$myLI[1]\">";
               echo "<input type=\"hidden\" name=\"$invdate\" size=\"7\" id=\"$invdate\" onfocus=\"javascript:fPopCalendar1('$invdate','$invdate');\" value=\"$date2\">";
               echo "<input type=\"hidden\" name=\"$invqty\" size=\"7\" value=\"$myLI[3]\">";
               echo "<input type=\"hidden\" name=\"$supdel_date\" id=\"$supdel_date\" size=\"7\" value=\"$date4\">";
               echo "<input type=\"hidden\" name=\"$paydue_date\" id=\"$paydue_date\" size=\"7\" value=\"$date5\">";
               echo "<input type=\"hidden\" name=\"$packnum\" id=\"$packnum\" size=\"7\" value=\"$date17\">";
               echo "<input type=\"hidden\" name=\"$bill_lading_num\" id=\"$bill_lading_num\" size=\"7\" value=\"$date18\">";
               echo "<input type=\"hidden\" name=\"$bil_lading_date\" id=\"$bil_lading_date\" size=\"7\" value=\"$date19\">";
              }

            }

             else
            {

              echo "<td width=4%><span class=\"tabletext\">$date4</td>";
              echo "<td width=4%><span class=\"tabletext\">$myLI[1]</td>";
              echo "<td width=4%><span class=\"tabletext\">$date2</td>";
              echo "<td width=4%><span class=\"tabletext\">$myLI[3]</td>";
              echo "<td width=4%><span class=\"tabletext\">$date17</td>";
              echo "<td width=4%><span class=\"tabletext\">$date18</td>";
              echo "<td width=4%><span class=\"tabletext\">$date19</td>";
               if($usertype == 'EMPL' || $usertype == 'VEND')
              {
              echo "<td width=4%><span class=\"tabletext\">$date5</td>";
              }


              echo "<input type=\"hidden\" name=\"$invnum\" size=\"7\" value=\"$myLI[1]\">";
              echo "<input type=\"hidden\" name=\"$invdate\" size=\"7\" id=\"$invdate\" onfocus=\"javascript:fPopCalendar1('$invdate','$invdate');\" value=\"$date2\">";
              echo "<input type=\"hidden\" name=\"$invqty\" size=\"7\" value=\"$myLI[3]\">";
              echo "<input type=\"hidden\" name=\"$supdel_date\" id=\"$supdel_date\" size=\"7\" value=\"$date4\">";
              echo "<input type=\"hidden\" name=\"$paydue_date\" id=\"$paydue_date\" size=\"7\" value=\"$date5\">";
              echo "<input type=\"hidden\" name=\"$packnum\" id=\"$packnum\" size=\"7\" value=\"$date17\">";
              echo "<input type=\"hidden\" name=\"$bill_lading_num\" id=\"$bill_lading_num\" size=\"7\" value=\"$date18\">";
              echo "<input type=\"hidden\" name=\"$bil_lading_date\" id=\"$bil_lading_date\" size=\"7\" value=\"$date19\">";
            }

            echo "<td width=4%></td>";

            if(($usertype == 'EMPL' || $usertype == 'VEND') && ($myLI[22] == '' || $myLI[22] =='0000-00-00') && $date5!='')
            {

             if($usertype == 'EMPL')
             {
              echo "<td width=4%><input type=\"textbox\" name=\"$payexp_date\" id=\"$payexp_date\" size=\"8\" onfocus=\"javascript:fPopCalendar1('$payexp_date','$payexp_date');\" value=\"$date6\"></td>";
             }
             else if($usertype == 'VEND')
             {
              echo "<td width=4%><span class=\"tabletext\">" . $date6 . "</td>";
              echo "<input type=\"hidden\" name=\"$payexp_date\" id=\"$payexp_date\" size=\"7\" onfocus=\"javascript:fPopCalendar1('$payexp_date','$payexp_date');\" value=\"$date6\">";
             }
           }
           else
           {

             if($usertype == 'EMPL' || $usertype == 'VEND')
             {
              echo "<td width=4%><span class=\"tabletext\">$date6</td>";
             }
            echo "<input type=\"hidden\" name=\"$payexp_date\" id=\"$payexp_date\" size=\"7\" onfocus=\"javascript:fPopCalendar1('$payexp_date','$payexp_date');\" value=\"$date6\">";
           }
            if(($usertype == 'FF' || $usertype == 'EMPL') && ($myLI[22] == '' || $myLI[22] =='0000-00-00') && $date2 != '')
            {
             // echo "here3";
              if($usertype == 'FF')
              {
                if($date10 == '')
                {
                  echo "<td width=4%><input type=\"textbox\" name=\"$pick_date\" id=\"$pick_date\" size=\"8\" onfocus=\"javascript:fPopCalendar1('$pick_date','$pick_date');\" value=\"$date7\"></td>";
                  echo "<td width=4%><input type=\"textbox\" name=\"$sail_date\" id=\"$sail_date\" size=\"8\" onfocus=\"javascript:fPopCalendar1('$sail_date','$sail_date');\" value=\"$date8\"></td>";
                  echo "<td width=4%><input type=\"textbox\" name=\"$eda\" id=\"$eda\" size=\"8\" onfocus=\"javascript:fPopCalendar1('$eda','$eda');\" value=\"$date9\"></td>";
                  //echo "<td width=6%><span class=\"tabletext\">$date13</td>";
                  echo "<td width=4%><input type=\"textbox\" name=\"$ffpaydue_date\" id=\"$ffpaydue_date\" size=\"8\" onfocus=\"javascript:fPopCalendar1('$ffpaydue_date','$ffpaydue_date');\" value=\"$date13\"></td>";
                  echo "<td width=4%><span class=\"tabletext\">$date14</td>";
                  //echo "<input type=\"hidden\" name=\"$ffpaydue_date\" id=\"$ffpaydue_date\" size=\"7\" value=\"$date13\">";
                  echo "<input type=\"hidden\" name=\"$ffpayexp_date\" id=\"$ffpayexp_date\" size=\"7\" value=\"$date14\">";
                }
                
                else if($date14 == '')
                {
                  echo "<td width=4%><span class=\"tabletext\">$date7</td>";
                  echo "<td width=4%><span class=\"tabletext\">$date8</td>";
                  echo "<td width=4%><span class=\"tabletext\">$date9</td>";
                  echo "<td width=4%><input type=\"textbox\" name=\"$ffpaydue_date\" id=\"$ffpaydue_date\" size=\"8\" onfocus=\"javascript:fPopCalendar1('$ffpaydue_date','$ffpaydue_date');\" value=\"$date13\"></td>";
                  echo "<td width=4%><span class=\"tabletext\">$date14</td>";

                  //echo "<input type=\"hidden\" name=\"$ffpaydue_date\" id=\"$ffpaydue_date\" size=\"7\" value=\"$date13\">";

                  echo "<input type=\"hidden\" name=\"$pick_date\" id=\"$pick_date\" size=\"7\" onfocus=\"javascript:fPopCalendar1('$pick_date','$pick_date');\" value=\"$date7\">";
                  echo "<input type=\"hidden\" name=\"$sail_date\" id=\"$sail_date\" size=\"7\" onfocus=\"javascript:fPopCalendar1('$sail_date','$sail_date');\" value=\"$date8\">";
                  echo "<input type=\"hidden\" name=\"$eda\" id=\"$eda\" size=\"7\" onfocus=\"javascript:fPopCalendar1('$eda','$eda');\" value=\"$date9\">";
                  echo "<input type=\"hidden\" name=\"$ffpayexp_date\" id=\"$ffpayexp_date\" size=\"7\" value=\"$date14\">";
                }
                
                else
                {
                   echo "<td width=4%><span class=\"tabletext\">$date7</td>";
                   echo "<td width=4%><span class=\"tabletext\">$date8</td>";
                   echo "<td width=4%><span class=\"tabletext\">$date9</td>";
                   echo "<td width=4%><span class=\"tabletext\">$date13</td>";
                   echo "<td width=4%><span class=\"tabletext\">$date14</td>";

                   echo "<input type=\"hidden\" name=\"$pick_date\" id=\"$pick_date\" size=\"7\" onfocus=\"javascript:fPopCalendar1('$pick_date','$pick_date');\" value=\"$date7\">";
                   echo "<input type=\"hidden\" name=\"$sail_date\" id=\"$sail_date\" size=\"7\" onfocus=\"javascript:fPopCalendar1('$sail_date','$sail_date');\" value=\"$date8\">";
                   echo "<input type=\"hidden\" name=\"$eda\" id=\"$eda\" size=\"7\" onfocus=\"javascript:fPopCalendar1('$eda','$eda');\" value=\"$date9\">";
                   echo "<input type=\"hidden\" name=\"$ffpaydue_date\" id=\"$ffpaydue_date\" size=\"7\" value=\"$date13\">";
                   echo "<input type=\"hidden\" name=\"$ffpayexp_date\" id=\"$ffpayexp_date\" size=\"7\" value=\"$date14\">";
                }
              }
              else if($usertype == 'EMPL')
              {
                echo "<td width=4%><span class=\"tabletext\">$date7</td>";
                echo "<td width=4%><span class=\"tabletext\">$date8</td>";
                echo "<td width=4%><span class=\"tabletext\">$date9</td>";
                echo "<td width=4%><span class=\"tabletext\">$date13</td>";
                if($date9 != '')
                {
                  //echo "<td width=6%><input type=\"textbox\" name=\"$ffpaydue_date\" id=\"$ffpaydue_date\" size=\"8\" onfocus=\"javascript:fPopCalendar1('$ffpaydue_date','$ffpaydue_date');\" value=\"$date13\"></td>";
                  echo "<td width=4%><input type=\"textbox\" name=\"$ffpayexp_date\" id=\"$ffpayexp_date\" size=\"8\" onfocus=\"javascript:fPopCalendar1('$ffpayexp_date','$ffpayexp_date');\" value=\"$date14\"></td>";
                }
                else
                {
                   //echo "<td width=6%><span class=\"tabletext\">$date13</td>";
                   echo "<td width=4%><span class=\"tabletext\">$date14</td>";
                   echo "<input type=\"hidden\" name=\"$ffpayexp_date\" id=\"$ffpayexp_date\" size=\"7\" value=\"$date14\">";
                }
                echo "<input type=\"hidden\" name=\"$pick_date\" id=\"$pick_date\" size=\"7\" onfocus=\"javascript:fPopCalendar1('$pick_date','$pick_date');\" value=\"$date7\">";
                echo "<input type=\"hidden\" name=\"$sail_date\" id=\"$sail_date\" size=\"7\" onfocus=\"javascript:fPopCalendar1('$sail_date','$sail_date');\" value=\"$date8\">";
                echo "<input type=\"hidden\" name=\"$eda\" id=\"$eda\" size=\"7\" onfocus=\"javascript:fPopCalendar1('$eda','$eda');\" value=\"$date9\">";
                echo "<input type=\"hidden\" name=\"$ffpaydue_date\" id=\"$ffpaydue_date\" size=\"7\" value=\"$date13\">";
              }

            }

            else
            {
              //echo "here2";
              echo "<td width=4%><span class=\"tabletext\">$date7</td>";
              echo "<td width=4%><span class=\"tabletext\">$date8</td>";
              echo "<td width=4%><span class=\"tabletext\">$date9</td>";

              if($usertype == 'EMPL' || $usertype == 'FF')
              {
              echo "<td width=4%><span class=\"tabletext\">$date13</td>";
              echo "<td width=4%><span class=\"tabletext\">$date14</td>";
              }
              echo "<input type=\"hidden\" name=\"$pick_date\" id=\"$pick_date\" size=\"7\" onfocus=\"javascript:fPopCalendar1('$pick_date','$pick_date');\" value=\"$date7\">";
              echo "<input type=\"hidden\" name=\"$sail_date\" id=\"$sail_date\" size=\"7\" onfocus=\"javascript:fPopCalendar1('$sail_date','$sail_date');\" value=\"$date8\">";
              echo "<input type=\"hidden\" name=\"$eda\" id=\"$eda\" size=\"7\" onfocus=\"javascript:fPopCalendar1('$eda','$eda');\" value=\"$date9\">";
              echo "<input type=\"hidden\" name=\"$ffpaydue_date\" id=\"$ffpaydue_date\" size=\"7\" value=\"$date13\">";
              echo "<input type=\"hidden\" name=\"$ffpayexp_date\" id=\"$ffpayexp_date\" size=\"7\" value=\"$date14\">";
            }

         // echo 'date14 ' . $date14;


           if(($usertype == 'CF' || $usertype == 'EMPL') && ($myLI[22] == '' || $myLI[22] =='0000-00-00') && $date9 != '')
            {
            // echo 'hiiiii';
             if($usertype == 'CF')
             {
              if($date15 == '')
              {
                echo "<td width=4%><input type=\"textbox\" name=\"$aad\" id=\"$aad\" size=\"8\" onfocus=\"javascript:fPopCalendar1('$aad','$aad');\" value=\"$date10\"></td>";
                echo "<td width=4%><input type=\"textbox\" name=\"$docket_num\" id=\"$docket_num\" size=\"8\" value=\"$date20\"></td>";
                echo "<td width=4%><input type=\"textbox\" name=\"$boe_num\" id=\"$boe_num\" size=\"8\" value=\"$date21\"></td>";
                echo "<td width=4%><input type=\"textbox\" name=\"$expclr_date\" id=\"$expclr_date\" size=\"8\" onfocus=\"javascript:fPopCalendar1('$expclr_date','$expclr_date');\" value=\"$date11\"></td>";
                echo "<td width=4%><input type=\"textbox\" name=\"$cfdel_date\" id=\"$cfdel_date\" size=\"8\" onfocus=\"javascript:fPopCalendar1('$cfdel_date','$cfdel_date');\" value=\"$date12\"></td>";
                //echo "<td width=6%><span class=\"tabletext\">$date15</td>";
                echo "<td width=4%><input type=\"textbox\" name=\"$cfpaydue_date\" id=\"$cfpaydue_date\" size=\"8\" onfocus=\"javascript:fPopCalendar1('$cfpaydue_date','$cfpaydue_date');\" value=\"$date15\"></td>";
                echo "<td width=4%><span class=\"tabletext\">$date16</td>";
               // echo "<input type=\"hidden\" name=\"$cfpaydue_date\" id=\"$cfpaydue_date\" size=\"7\" value=\"$date15\">";
                echo "<input type=\"hidden\" name=\"$cfpayexp_date\" id=\"$cfpayexp_date\" size=\"7\" value=\"$date16\">";
              }
              
              else if($date16 == '')
              {
                echo "<td width=4%><span class=\"tabletext\">$date10</td>";
                echo "<td width=4%><span class=\"tabletext\">$date20</td>";
                echo "<td width=4%><span class=\"tabletext\">$date21</td>";
                echo "<td width=4%><span class=\"tabletext\">$date11</td>";
                echo "<td width=4%><span class=\"tabletext\">$date12</td>";
                echo "<td width=4%><input type=\"textbox\" name=\"$cfpaydue_date\" id=\"$cfpaydue_date\" size=\"8\" onfocus=\"javascript:fPopCalendar1('$cfpaydue_date','$cfpaydue_date');\" value=\"$date15\"></td>";
                echo "<td width=4%><span class=\"tabletext\">$date16</td>";
               // echo "<input type=\"hidden\" name=\"$cfpaydue_date\" id=\"$cfpaydue_date\" size=\"7\" value=\"$date15\">";

                echo "<input type=\"hidden\" name=\"$aad\" id=\"$aad\" size=\"7\" onfocus=\"javascript:fPopCalendar1('$aad','$aad');\" value=\"$date10\">";
                echo "<input type=\"hidden\" name=\"$docket_num\" id=\"$docket_num\" size=\"7\" value=\"$date20\">";
                echo "<input type=\"hidden\" name=\"$boe_num\" id=\"$boe_num\" size=\"7\" value=\"$date21\">";
                echo "<input type=\"hidden\" name=\"$expclr_date\" id=\"$expclr_date\" size=\"7\" onfocus=\"javascript:fPopCalendar1('$expclr_date','$expclr_date');\" value=\"$date11\">";
                echo "<input type=\"hidden\" name=\"$cfdel_date\" id=\"$cfdel_date\" size=\"7\" onfocus=\"javascript:fPopCalendar1('$cfdel_date','$cfdel_date');\" value=\"$date12\">";
                echo "<input type=\"hidden\" name=\"$cfpayexp_date\" id=\"$cfpayexp_date\" size=\"7\" value=\"$date16\">";
              }
              
              else
              {
                 echo "<td width=4%><span class=\"tabletext\">$date10</td>";
                 echo "<td width=4%><span class=\"tabletext\">$date20</td>";
                 echo "<td width=4%><span class=\"tabletext\">$date21</td>";
                 echo "<td width=4%><span class=\"tabletext\">$date11</td>";
                 echo "<td width=4%><span class=\"tabletext\">$date12</td>";
                 echo "<td width=4%><span class=\"tabletext\">$date15</td>";
                 echo "<td width=4%><span class=\"tabletext\">$date16</td>";

                 echo "<input type=\"hidden\" name=\"$aad\" id=\"$aad\" size=\"7\" onfocus=\"javascript:fPopCalendar1('$aad','$aad');\" value=\"$date10\">";
                 echo "<input type=\"hidden\" name=\"$docket_num\" id=\"$docket_num\" size=\"7\" value=\"$date20\">";
                 echo "<input type=\"hidden\" name=\"$boe_num\" id=\"$boe_num\" size=\"7\" value=\"$date21\">";
                 echo "<input type=\"hidden\" name=\"$expclr_date\" id=\"$expclr_date\" size=\"7\" onfocus=\"javascript:fPopCalendar1('$expclr_date','$expclr_date');\" value=\"$date11\">";
                 echo "<input type=\"hidden\" name=\"$cfdel_date\" id=\"$cfdel_date\" size=\"7\" onfocus=\"javascript:fPopCalendar1('$cfdel_date','$cfdel_date');\" value=\"$date12\">";
                 echo "<input type=\"hidden\" name=\"$cfpaydue_date\" id=\"$cfpaydue_date\" size=\"7\" value=\"$date15\">";
                 echo "<input type=\"hidden\" name=\"$cfpayexp_date\" id=\"$cfpayexp_date\" size=\"7\" value=\"$date16\">";
              }
             }
             else if($usertype == 'EMPL')
             {
              echo "<td width=4%><span class=\"tabletext\">$date10</td>";

              echo "<td width=4%><span class=\"tabletext\">$date20</td>";
              echo "<td width=4%><span class=\"tabletext\">$date21</td>";

              echo "<td width=4%><span class=\"tabletext\">$date11</td>";
              echo "<td width=4%><span class=\"tabletext\">$date12</td>";
              echo "<td width=4%><span class=\"tabletext\">$date15</td>";
              if($date12 != '' && $date12 != '0000-00-00')
              {
              //echo "<td width=6%><input type=\"textbox\" name=\"$cfpaydue_date\" id=\"$cfpaydue_date\" size=\"8\" onfocus=\"javascript:fPopCalendar1('$cfpaydue_date','$cfpaydue_date');\" value=\"$date15\"></td>";
              echo "<td width=4%><input type=\"textbox\" name=\"$cfpayexp_date\" id=\"$cfpayexp_date\" size=\"8\" onfocus=\"javascript:fPopCalendar1('$cfpayexp_date','$cfpayexp_date');\" value=\"$date16\"></td>";
              }
              else
              {
               // echo "<td width=6%><span class=\"tabletext\">$date15</td>";
                echo "<td width=4%><span class=\"tabletext\">$date16</td>";
              }
              echo "<input type=\"hidden\" name=\"$aad\" id=\"$aad\" size=\"7\" onfocus=\"javascript:fPopCalendar1('$aad','$aad');\" value=\"$date10\">";
              echo "<input type=\"hidden\" name=\"$expclr_date\" id=\"$expclr_date\" size=\"7\" onfocus=\"javascript:fPopCalendar1('$expclr_date','$expclr_date');\" value=\"$date11\">";
              echo "<input type=\"hidden\" name=\"$cfdel_date\" id=\"$cfdel_date\" size=\"7\" onfocus=\"javascript:fPopCalendar1('$cfdel_date','$cfdel_date');\" value=\"$date12\">";
              echo "<input type=\"hidden\" name=\"$cfpaydue_date\" id=\"$cfpaydue_date\" size=\"7\" value=\"$date15\">";
              echo "<input type=\"hidden\" name=\"$docket_num\" id=\"$docket_num\" size=\"7\" value=\"$date20\">";
              echo "<input type=\"hidden\" name=\"$boe_num\" id=\"$boe_num\" size=\"7\" value=\"$date21\">";
             }
            }
            else
            {
             //echo "here";
              echo "<td width=4%><span class=\"tabletext\">$date10</td>";
              echo "<td width=4%><span class=\"tabletext\">$date20</td>";
              echo "<td width=4%><span class=\"tabletext\">$date21</td>";
              echo "<td width=4%><span class=\"tabletext\">$date11</td>";
              echo "<td width=4%><span class=\"tabletext\">$date12</td>";
              if($usertype == 'EMPL' || $usertype == 'CF')
             {
              echo "<td width=4%><span class=\"tabletext\">$date15</td>";
              echo "<td width=4%><span class=\"tabletext\">$date16</td>";
             }

              echo "<input type=\"hidden\" name=\"$aad\" id=\"$aad\" size=\"7\" onfocus=\"javascript:fPopCalendar1('$aad','$aad');\" value=\"$date10\">";
              echo "<input type=\"hidden\" name=\"$expclr_date\" id=\"$expclr_date\" size=\"7\" onfocus=\"javascript:fPopCalendar1('$expclr_date','$expclr_date');\" value=\"$date11\">";
              echo "<input type=\"hidden\" name=\"$cfdel_date\" id=\"$cfdel_date\" size=\"7\" onfocus=\"javascript:fPopCalendar1('$cfdel_date','$cfdel_date');\" value=\"$date12\">";
              echo "<input type=\"hidden\" name=\"$cfpaydue_date\" id=\"$cfpaydue_date\" size=\"7\" value=\"$date15\">";
              echo "<input type=\"hidden\" name=\"$cfpayexp_date\" id=\"$cfpayexp_date\" size=\"7\" value=\"$date16\">";
              echo "<input type=\"hidden\" name=\"$docket_num\" id=\"$docket_num\" size=\"7\" value=\"$date20\">";
              echo "<input type=\"hidden\" name=\"$boe_num\" id=\"$boe_num\" size=\"7\" value=\"$date21\">";
            }

        }

            echo "<input type=\"hidden\" name=\"$prevlinenum\" value=\"$myLI[1]\">";
            echo "<input type=\"hidden\" name=\"$lirecnum\" value=\"$myLI[0]\">";
            echo "<input type=\"hidden\" name=\"$partnum\" value=\"$myLI[15]\">";
            echo "<input type=\"hidden\" name=\"$link2mtltracker\" value=\"$myLI[17]\">";

            $i++;
            $polirecnum = $myLI[17];
           }

       ?>
       </tr>

</table>
</table>

<?php


   echo "<input type=\"hidden\" name=\"index\" value=\"$i\">";
   echo "<input type=\"hidden\" name=\"ponum\" value=\"$ponum\">";
   echo "<input type=\"hidden\" name=\"usertype\" value=\"$usertype\">";
   echo "<input type=\"hidden\" name=\"userid\" value=\"$userid\">";

?>

<span class="labeltext"><input type="submit"
                style="color=#0066CC;background-color:#DDDDDD;width=130;"
                value="Submit" name="submit" onclick="javascript: return check_req_fields()">
                <INPUT TYPE="RESET"
                style="color=#0066CC;background-color:#DDDDDD;width=130;"
                VALUE="Reset" onclick="javascript: putfocus()">
</form>

<?php if($usertype != 'FF' && $usertype != 'CF')
     {
?>


<table width=100% border=0 cellpadding=0 cellspacing=0  >

	<tr>
	     		     <td bgcolor="#FFFFFF">
				<table width=100% border=0 cellpadding=6 cellspacing=0  >
    <tr>
        <td><span class="pageheading"><b>Original PO</b></td>

    </tr>


<tr>
<td colspan=2>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >

<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >

       <tr>
            <td bgcolor="#EEEFEE"><span class="heading"><b>Ln</b></td>
            <!--<td bgcolor="#EEEFEE"2><span class="heading"><b>RM Code</b></td>-->
            <td bgcolor="#EEEFEE"><span class="heading"><b>Material Ref</b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b>Material Spec</b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b>UOM</b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b>Dia</b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b>Length</b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b>Width</b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b>Thickness</b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b>Grainflow</b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b>No. of Meters req</b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b>No. of Lengths req</b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b>Due</b></td>
	    <td bgcolor="#EEEFEE"><span class="heading"><b>Accepted</b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b>Delv Mode</b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b>Rate</b></td>
            <td bgcolor="#EEEFEE" align="right"><span class="heading"><b>Amount</b></td>

       </tr>
        <?php
        $total = 0;
        $i = 0;
        $ft=0;    
        $result3 = $newPO->getLI4mtltrk($ponum);
        while ($myLI = mysql_fetch_assoc($result3)) {
             if ($ft == 0) {
                $curr = $myLI["currency"];
                $poamount = $myLI["poamount"];
                $ft = 1;
             }
             //echo "hiiiiiiiiiiiii $ponum";

	   if($myLI["duedate"] != '0000-00-00' && $myLI["duedate"] != '' && $myLI["duedate"] != 'NULL')
           {
              $datearr = split('-', $myLI["duedate"]);
              $d=$datearr[2];
              $m=$datearr[1];
              $y=$datearr[0];
              $x=mktime(0,0,0,$m,$d,$y);
              $date=date("M j, Y",$x);
           }
           else
           {
              $date = '';
           }
		   if($myLI["accepted_date"] != '0000-00-00' && $myLI["accepted_date"] != '' && $myLI["accepted_date"] != 'NULL')
           {
              $datearr = split('-', $myLI["accepted_date"]);
              $d=$datearr[2];
              $m=$datearr[1];
              $y=$datearr[0];
              $x=mktime(0,0,0,$m,$d,$y);
              $accdate=date("M j, Y",$x);
           }
           else
           {
              $accdate = '';
           }
            //echo "$date";
            $line_num = $myLI["line_num"];
            $item_name = $myLI["item_name"];
            $item_desc = $myLI["item_desc"];
            $qty = $myLI["qty"];
            $delvby = $myLI["delv_by"];
            $uom = $myLI["uom"];
            $grainflow = $myLI["grainflow"];
            $material_ref = $myLI["material_ref"];
            $material_spec = $myLI["material_spec"];
            $dia ="";
            $thick="";
            $width = $myLI["width"];
            $length = $myLI["length"];
            if (trim($length) == "") 
            {
                $dia = $myLI['thick'];
            }
            else 
            {
                $thick = $myLI['thick'];
            }

            $qty_per_meter = $myLI["qty_per_meter"];
            $no_of_meterages = $myLI["no_of_meterages"];
            $no_of_lengths = $myLI["no_of_lengths"];


              $i = $i + 1;
	     echo"<tr><td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$line_num</td>" ;
         //echo"<td bgcolor=\"#FFFFFF\" ><span class=\"tabletext\">$item_name</td>";
         //                echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$qty</td>";
                         echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$material_ref</td>";
                         echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$material_spec</td>";
                         echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$uom</td>";
                         echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$dia</td>";
                         echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$width</td>";
                         echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$length</td>";
                         echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$thick</td>";
                         echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$grainflow</td>";
                         echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$no_of_meterages</td>";
                         echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$no_of_lengths</td>";
                         echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$date</td>";
                         echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$accdate</td>";
                         echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$delvby</td>";
                         printf('<td bgcolor="#FFFFFF"><span class="tabletext">%s %.2f</td>',$myLI["currency"],$myLI["rate"]);
                         printf('<td align="right" bgcolor="#FFFFFF"><span class="tabletext">%s %.2f</td>',$curr,$myLI["amount"]);
                         $total += $myLI["amount"];
        }
?>

          <tr>
              <td bgcolor="#FFFFFF" colspan=15 align="right"><span class="tabletext"><b>Total</b></td>
              <td align="right" bgcolor="#FFFFFF"><span class="tabletext"><?php printf('%s %.2f',$curr,$total); ?></td>
          </tr>
</span></td></tr>
</table>
</table>
</table>

<?php } ?>



  <table border=0 bgcolor="#FFFFFF" width=100%  cellspacing=1 cellpadding=3>
   <tr>
    <td>

 <table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >

     <table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
      <tr>


      </tr></table>
        </table>


</td>
				<td width="6"><img src="images/spacer.gif " width="6"></td>
			</tr>
			<tr bgcolor="DEDFDE">
  				<td width="6"><img src="images/box-left-bottom.gif"></td>
				<td><img src="images/spacer.gif " height="6"></td>
				<td width="6"><img src="images/box-right-bottom.gif"></td>
			</tr>

		</table>

</table>

</body>
</html>
