<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = June 19, 2008                =
// Filename: crn_cost.php                      =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 WMS                          =
// Displays CRN cost m/c-wise                  =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];
$_SESSION['pagename'] = 'reports';
//////session_register('pagename');


include_once('classes/loginClass.php');

$newlogin = new userlogin;
$newlogin->dbconnect();

// For paging - Added on Dec 6,04

// how many rows to show per page
$rowsPerPage = 30000;

// by default we show first page
$pageNum = 1;

// if $_GET['page'] defined, use it as page number
if (isset($_REQUEST['page']))
{
	//echo "i am set";
    $pageNum = $_REQUEST['page'];
}
if (isset($_REQUEST['totpages']))
{
    $totpages = $_REQUEST['totpages'];
}

// counting the offset
$offset = ($pageNum - 1) * $rowsPerPage;

// Month-to-date computation
$todate1 = date("Y-m-d");
$today = split('-',$todate1);
$days = $today[2]-1;
$fromdate1 = date("Y-m-d",strtotime("-$days days"));
//echo "Fromdate is $fromdate1";

// First include the class definition

include('classes/reportClass.php');
include('classes/displayClass.php');
$newreport = new report;
$newdisplay = new display;

$mc_arr = array('BMV 60-1','BMV 60-2','BMV 45-1','BMV 45-2','BMV 50','VMC 70L','DMG 360L','HMC 440','DX 200-1','DX 200-2','DX 200-3','HAAS','MakinoF3','MakinoF5','HAASVF2SS');
?>

<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/report.js"></script>
<html>
<head>
<title>PRN Cost Report</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">

<?php
include('header.html');

?>

<table width=100% cellspacing="0" cellpadding="6" border="0">
<tr>
<td>
<table width=100% border=0 cellspacing="0" cellpadding="0">
<tr>
<td colspan=2><span class="welcome"><b>Welcome <?php echo $userid?></b></td>
<td align="right">&nbsp;<a href="exit.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image16','','images/logout_mo.gif',1)"><img name="Image16" border="0" src="images/logout.gif"></a></td>
 </tr>
</table>
<table width=100% border=0 cellpadding=0 cellspacing=0  >
<tr><td></td></tr>
<tr>
<td>
<?php $newdisplay ->dispLinks(''); ?>
<table width=100% border=0 cellpadding=0 cellspacing=0  >
<tr bgcolor="DEDFDE">
<td width="6"><img src="images/spacer.gif " width="6"></td>
<td bgcolor="#FFFFFF">
<table width=100% border=0 cellpadding=6 cellspacing=0  >
<tr>
	<td>
  <table width=100% border=0 >
   <tr><td align="center"><span class="heading"><b>Earnings Per Shift</b></td>

<tr><td>

</td></tr>
    </tr>
   </table>
<?php
foreach($mc_arr as $mc_name)
{
   $mc = strtolower($mc_name);
   $mc = str_replace(" ","",$mc_name);
   $mc = str_replace("-","",$mc);
   $main_div = $mc.'d';
   $table_id = $mc;
   $from_id =  'f'.$mc;
   $to_id  = 't'.$mc;
?>
<tr>
<td>
<div id='<?php echo $main_div ?>'>
<table id='<?php echo $table_id ?>' width=100% border=1 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
        <tr>
         <td colspan=2 bgcolor="#FFFFFF"><span class="labeltext"><b>From &nbsp&nbsp</b>
         <input type="text" id="<?php echo $from_id ?>" name="<?php echo $from_id ?>" size=10 value="<?php echo $fromdate1 ?>"
          style="background-color:#DDDDDD;" readonly="readonly"
          onkeypress="javascript: return checkenter(event)">
         <img src="images/bu-getdateicon.gif" alt="Get Date" onclick="GetDate('<?php echo $from_id ?>')">
          <span class="labeltext"><b>&nbsp;&nbsp;To</b>
         <input type="text" id="<?php echo $to_id ?>" name="<?php echo $to_id ?>" size=10 value="<?php echo $todate1 ?>"
          style="background-color:#DDDDDD;" readonly="readonly"
          onkeypress="javascript: return checkenter(event)">
         <img src="images/bu-getdateicon.gif" alt="Get Date" onclick="GetDate('<?php echo $to_id ?>')">
         <input type="image" name="Submit" src="images/bu-get.gif" value="Get"
            onclick="javascript: getcost('<?php echo $mc_name ?>','<?php echo $main_div ?>','<?php echo $table_id ?>','<?php echo $from_id ?>','<?php echo $to_id ?>')">
         </td>
        <td colspan=2 align="center" bgcolor="#00DDFF"><span class="heading"><b><?php echo $mc_name ?></b></td>
<?php
        $cond = "op.st_date >= '$fromdate1' and op.st_date <= '$todate1'";
        $result = $newreport->get_mccost($mc_name,$cond);
        $totcost = 0;
        while ($myrow = mysql_fetch_row($result)) {
              $totcost += $myrow[4];
        }
?>
        <td  align="right" colspan=2 bgcolor="#FFFFFF"><span class="heading"><b>Total:<?php printf('%.2f', $totcost) ?></b></td>
        </tr>
        <tr>
            <td bgcolor="#00DDFF" width=20%><span class="heading"><b>Date</b></td>
            <td bgcolor="#00DDFF" width=15%><span class="heading"><b>Shift</b></td>
            <td bgcolor="#00DDFF" width=20%><span class="heading"><b>PRN</b></td>
            <td bgcolor="#00DDFF" width=20%><span class="heading"><b>Qty</b></td>
            <td bgcolor="#00DDFF" width=20%><span class="heading"><b>Cost</b></td>
        </tr>



<?php

        $result = $newreport->get_mccost($mc_name,$cond);
        while ($myrow = mysql_fetch_row($result)) {
              if($myrow[2] != '0000-00-00' && $myrow[2] != '' && $myrow[2] != 'NULL')
              {
                  $datearr = split('-', $myrow[2]);
                  $d=$datearr[2];
                  $m=$datearr[1];
                  $y=$datearr[0];
                  $x=mktime(0,0,0,$m,$d,$y);
                  $date1=date("M j, Y",$x);
              }
              else
              {
                  $date1 = '';
              }
?>
            <tr>
              <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $date1 ?></td>
              <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[3] ?></td>
              <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[1] ?></td>
              <td bgcolor="#FFFFFF"><span class="tabletext"><?php printf('%.2f',$myrow[6]) ?></td>
              <td align="right" bgcolor="#FFFFFF"><span class="tabletext"><?php printf('%.2f',$myrow[4]) ?></td>
            </tr>
<?php
         }
?>
</table>
</div>
</td>
</tr>
<?php
}
?>
<!--
<tr><td>&nbsp</td></tr>
<tr>
<td>
<div id='bmv602d'>
<table id='bmv602' width=100% border=1 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
        <tr>
         <td colspan=2 bgcolor="#FFFFFF"><span class="labeltext"><b>From &nbsp&nbsp</b>
         <input type="text" name="fbmv602" id="fbmv602" size=10 value="<?php echo $fromdate1 ?>"
          style="background-color:#DDDDDD;" readonly="readonly"
          onkeypress="javascript: return checkenter(event)">
         <img src="images/bu-getdateicon.gif" alt="Get Date" onclick='GetDate("fbmv602")'>
          <span class="labeltext"><b>&nbsp;&nbsp;To</b>
         <input type="text" name="tbmv602" id="tbmv602" size=10 value="<?php echo $todate1 ?>"
          style="background-color:#DDDDDD;" readonly="readonly"
          onkeypress="javascript: return checkenter(event)">
         <img src="images/bu-getdateicon.gif" alt="Get Date" onclick='GetDate("tbmv602")'>
         <input type="image" name="Submit" src="images/bu-get.gif" value="Get"
            onclick="javascript: getcost('BMV 60-2','bmv602d','bmv602','fbmv602','tbmv602')">
         </td>
        <td colspan=2 align="center" bgcolor="#00DDFF"><span class="heading"><b>BMV 602</b></td>
<?php
        $cond = "op.st_date >= '$fromdate1' and op.st_date <= '$todate1'";
        $result = $newreport->get_mccost('BMV 60-2',$cond);
        $totcost = 0;
        while ($myrow = mysql_fetch_row($result)) {
              $totcost += $myrow[4];
        }
?>
        <td  align="right" colspan=2 bgcolor="#FFFFFF"><span class="heading"><b>Total:<?php printf('%.2f', $totcost) ?></b></td>
        </tr>
        <tr>
            <td bgcolor="#00DDFF" width=20%><span class="heading"><b>Date</b></td>
            <td bgcolor="#00DDFF" width=15%><span class="heading"><b>Shift</b></td>
            <td bgcolor="#00DDFF" width=20%><span class="heading"><b>PRN</b></td>
            <td bgcolor="#00DDFF" width=20%><span class="heading"><b>Qty</b></td>
            <td bgcolor="#00DDFF" width=20%><span class="heading"><b>Cost</b></td>
        </tr>



<?php
        $result = $newreport->get_mccost('BMV 60-2',$cond);
        while ($myrow = mysql_fetch_row($result)) {
              if($myrow[2] != '0000-00-00' && $myrow[2] != '' && $myrow[2] != 'NULL')
              {
                  $datearr = split('-', $myrow[2]);
                  $d=$datearr[2];
                  $m=$datearr[1];
                  $y=$datearr[0];
                  $x=mktime(0,0,0,$m,$d,$y);
                  $date1=date("M j, Y",$x);
              }
              else
              {
                  $date1 = '';
              }
?>
            <tr>
              <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $date1 ?></td>
              <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[3] ?></td>
              <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[1] ?></td>
              <td bgcolor="#FFFFFF"><span class="tabletext"><?php printf('%.2f',$myrow[6]) ?></td>
              <td align="right" bgcolor="#FFFFFF"><span class="tabletext"><?php printf('%.2f',$myrow[4]) ?></td>
            </tr>
<?php
         }
?>
</table>
</div>
</td>
</tr>
<tr><td>&nbsp</td></tr>
<tr>
<td>
<div id='bmv451d'>
<table id='bmv451' width=100% border=1 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
        <tr>
         <td colspan=2 bgcolor="#FFFFFF"><span class="labeltext"><b>From &nbsp&nbsp</b>
         <input type="text" name="fbmv451" id="fbmv451" size=10 value="<?php echo $fromdate1 ?>"
          style="background-color:#DDDDDD;" readonly="readonly"
          onkeypress="javascript: return checkenter(event)">
         <img src="images/bu-getdateicon.gif" alt="Get Date" onclick='GetDate("fbmv451")'>
          <span class="labeltext"><b>&nbsp;&nbsp;To</b>
         <input type="text" name="tbmv451" id="tbmv451" size=10 value="<?php echo $todate1 ?>"
          style="background-color:#DDDDDD;" readonly="readonly"
          onkeypress="javascript: return checkenter(event)">
         <img src="images/bu-getdateicon.gif" alt="Get Date" onclick='GetDate("tbmv451")'>
         <input type="image" name="Submit" src="images/bu-get.gif" value="Get"
            onclick="javascript: getcost('BMV 45-1','bmv451d','bmv451','fbmv451','tbmv451')">
         </td>
        <td colspan=2 align="center" bgcolor="#00DDFF"><span class="heading"><b>BMV 45-1</b></td>
<?php
        $cond = "op.st_date >= '$fromdate1' and op.st_date <= '$todate1'";
        $result = $newreport->get_mccost('BMV 45-1',$cond);
        $totcost = 0;
        while ($myrow = mysql_fetch_row($result)) {
              $totcost += $myrow[4];
        }
?>
        <td  align="right" colspan=2 bgcolor="#FFFFFF"><span class="heading"><b>Total:<?php printf('%.2f', $totcost) ?></b></td>
        </tr>
        <tr>
            <td bgcolor="#00DDFF" width=20%><span class="heading"><b>Date</b></td>
            <td bgcolor="#00DDFF" width=15%><span class="heading"><b>Shift</b></td>
            <td bgcolor="#00DDFF" width=20%><span class="heading"><b>PRN</b></td>
            <td bgcolor="#00DDFF" width=20%><span class="heading"><b>Qty</b></td>
            <td bgcolor="#00DDFF" width=20%><span class="heading"><b>Cost</b></td>
        </tr>



<?php
        $result = $newreport->get_mccost('BMV 45-1',$cond);
        while ($myrow = mysql_fetch_row($result)) {
              if($myrow[2] != '0000-00-00' && $myrow[2] != '' && $myrow[2] != 'NULL')
              {
                  $datearr = split('-', $myrow[2]);
                  $d=$datearr[2];
                  $m=$datearr[1];
                  $y=$datearr[0];
                  $x=mktime(0,0,0,$m,$d,$y);
                  $date1=date("M j, Y",$x);
              }
              else
              {
                  $date1 = '';
              }
?>
            <tr>
              <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $date1 ?></td>
              <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[3] ?></td>
              <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[1] ?></td>
              <td bgcolor="#FFFFFF"><span class="tabletext"><?php printf('%.2f',$myrow[6]) ?></td>
              <td align="right" bgcolor="#FFFFFF"><span class="tabletext"><?php printf('%.2f',$myrow[4]) ?></td>
            </tr>
<?php
         }
?>
</table>
</div>
</td>
</tr>
<tr><td>&nbsp</td></tr>
<tr>
<td>
<div id='bmv452d'>
<table id='bmv452' width=100% border=1 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
        <tr>
         <td colspan=2 bgcolor="#FFFFFF"><span class="labeltext"><b>From &nbsp&nbsp</b>
         <input type="text" name="fbmv452" id="fbmv452" size=10 value="<?php echo $fromdate1 ?>"
          style="background-color:#DDDDDD;" readonly="readonly"
          onkeypress="javascript: return checkenter(event)">
         <img src="images/bu-getdateicon.gif" alt="Get Date" onclick='GetDate("fbmv452")'>
          <span class="labeltext"><b>&nbsp;&nbsp;To</b>
         <input type="text" name="tbmv452" id="tbmv452" size=10 value="<?php echo $todate1 ?>"
          style="background-color:#DDDDDD;" readonly="readonly"
          onkeypress="javascript: return checkenter(event)">
         <img src="images/bu-getdateicon.gif" alt="Get Date" onclick='GetDate("tbmv452")'>
         <input type="image" name="Submit" src="images/bu-get.gif" value="Get"
            onclick="javascript: getcost('BMV 45-2','bmv452d','bmv452','fbmv452','tbmv452')">
         </td>
        <td colspan=2 align="center" bgcolor="#00DDFF"><span class="heading"><b>BMV 45-2</b></td>
<?php
        $cond = "op.st_date >= '$fromdate1' and op.st_date <= '$todate1'";
        $result = $newreport->get_mccost('BMV 45-2',$cond);
        $totcost = 0;
        while ($myrow = mysql_fetch_row($result)) {
              $totcost += $myrow[4];
        }
?>
        <td  align="right" colspan=2 bgcolor="#FFFFFF"><span class="heading"><b>Total:<?php printf('%.2f', $totcost) ?></b></td>
        </tr>
        <tr>
            <td bgcolor="#00DDFF" width=20%><span class="heading"><b>Date</b></td>
            <td bgcolor="#00DDFF" width=15%><span class="heading"><b>Shift</b></td>
            <td bgcolor="#00DDFF" width=20%><span class="heading"><b>PRN</b></td>
            <td bgcolor="#00DDFF" width=20%><span class="heading"><b>Qty</b></td>
            <td bgcolor="#00DDFF" width=20%><span class="heading"><b>Cost</b></td>
        </tr>


<?php
        $result = $newreport->get_mccost('BMV 45-2',$cond);
        while ($myrow = mysql_fetch_row($result)) {
              if($myrow[2] != '0000-00-00' && $myrow[2] != '' && $myrow[2] != 'NULL')
              {
                  $datearr = split('-', $myrow[2]);
                  $d=$datearr[2];
                  $m=$datearr[1];
                  $y=$datearr[0];
                  $x=mktime(0,0,0,$m,$d,$y);
                  $date1=date("M j, Y",$x);
              }
              else
              {
                  $date1 = '';
              }
?>
            <tr>
              <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $date1 ?></td>
              <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[3] ?></td>
              <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[1] ?></td>
              <td bgcolor="#FFFFFF"><span class="tabletext"><?php printf('%.2f',$myrow[6]) ?></td>
              <td align="right" bgcolor="#FFFFFF"><span class="tabletext"><?php printf('%.2f',$myrow[4]) ?></td>
            </tr>
<?php
         }
?>
</table>
</div>
</td>
</tr>
<tr><td>&nbsp</td></tr>
<tr>
<td>
<div id='bmv50d'>
<table id='bmv50' width=100% border=1 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
        <tr>
         <td colspan=2 bgcolor="#FFFFFF"><span class="labeltext"><b>From &nbsp&nbsp</b>
         <input type="text" name="fbmv50" id="fbmv50" size=10 value="<?php echo $fromdate1 ?>"
          style="background-color:#DDDDDD;" readonly="readonly"
          onkeypress="javascript: return checkenter(event)">
         <img src="images/bu-getdateicon.gif" alt="Get Date" onclick='GetDate("fbmv50")'>
          <span class="labeltext"><b>&nbsp;&nbsp;To</b>
         <input type="text" name="tbmv50" id="tbmv50" size=10 value="<?php echo $todate1 ?>"
          style="background-color:#DDDDDD;" readonly="readonly"
          onkeypress="javascript: return checkenter(event)">
         <img src="images/bu-getdateicon.gif" alt="Get Date" onclick='GetDate("tbmv50")'>
         <input type="image" name="Submit" src="images/bu-get.gif" value="Get"
            onclick="javascript: getcost('BMV 50','bmv50d','bmv50','fbmv50','tbmv50')">
         </td>
        <td colspan=2 align="center" bgcolor="#00DDFF"><span class="heading"><b>BMV 50</b></td>
<?php
        $cond = "op.st_date >= '$fromdate1' and op.st_date <= '$todate1'";
        $result = $newreport->get_mccost('BMV 50',$cond);
        $totcost = 0;
        while ($myrow = mysql_fetch_row($result)) {
              $totcost += $myrow[4];
        }
?>
        <td  align="right" colspan=2 bgcolor="#FFFFFF"><span class="heading"><b>Total:<?php printf('%.2f', $totcost) ?></b></td>
        </tr>
        <tr>
            <td bgcolor="#00DDFF" width=20%><span class="heading"><b>Date</b></td>
            <td bgcolor="#00DDFF" width=15%><span class="heading"><b>Shift</b></td>
            <td bgcolor="#00DDFF" width=20%><span class="heading"><b>PRN</b></td>
            <td bgcolor="#00DDFF" width=20%><span class="heading"><b>Qty</b></td>
            <td bgcolor="#00DDFF" width=20%><span class="heading"><b>Cost</b></td>
        </tr>



<?php
        $result = $newreport->get_mccost('BMV 50',$cond);
        while ($myrow = mysql_fetch_row($result)) {
              if($myrow[2] != '0000-00-00' && $myrow[2] != '' && $myrow[2] != 'NULL')
              {
                  $datearr = split('-', $myrow[2]);
                  $d=$datearr[2];
                  $m=$datearr[1];
                  $y=$datearr[0];
                  $x=mktime(0,0,0,$m,$d,$y);
                  $date1=date("M j, Y",$x);
              }
              else
              {
                  $date1 = '';
              }
?>
            <tr>
              <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $date1 ?></td>
              <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[3] ?></td>
              <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[1] ?></td>
              <td bgcolor="#FFFFFF"><span class="tabletext"><?php printf('%.2f',$myrow[6]) ?></td>
              <td align="right" bgcolor="#FFFFFF"><span class="tabletext"><?php printf('%.2f',$myrow[4]) ?></td>
            </tr>
<?php
         }
?>
</table>
</div>
</td>
</tr>
<tr><td>&nbsp</td></tr>
<tr>
<td>
<div id='vmc70ld'>
<table id='vmc70l' width=100% border=1 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
        <tr>
         <td colspan=2 bgcolor="#FFFFFF"><span class="labeltext"><b>From &nbsp&nbsp</b>
         <input type="text" name="fvmc701d" id="fvmc701d" size=10 value="<?php echo $fromdate1 ?>"
          style="background-color:#DDDDDD;" readonly="readonly"
          onkeypress="javascript: return checkenter(event)">
         <img src="images/bu-getdateicon.gif" alt="Get Date" onclick='GetDate("fvmc701d")'>
          <span class="labeltext"><b>&nbsp;&nbsp;To</b>
         <input type="text" name="tvmc701d" id="tvmc701d" size=10 value="<?php echo $todate1 ?>"
          style="background-color:#DDDDDD;" readonly="readonly"
          onkeypress="javascript: return checkenter(event)">
         <img src="images/bu-getdateicon.gif" alt="Get Date" onclick='GetDate("tvmc701d")'>
         <input type="image" name="Submit" src="images/bu-get.gif" value="Get"
            onclick="javascript: getcost('VMC 70L','vmc70ld','vmc70l','fvmc701d','tvmc701d')">
         </td>
        <td colspan=2 align="center" bgcolor="#00DDFF"><span class="heading"><b>VMC 70L</b></td>
<?php
        $cond = "op.st_date >= '$fromdate1' and op.st_date <= '$todate1'";
        $result = $newreport->get_mccost('VMC 70L',$cond);
        $totcost = 0;
        while ($myrow = mysql_fetch_row($result)) {
              $totcost += $myrow[4];
        }
?>
        <td  align="right" colspan=2 bgcolor="#FFFFFF"><span class="heading"><b>Total:<?php printf('%.2f', $totcost) ?></b></td>
        </tr>
        <tr>
            <td bgcolor="#00DDFF" width=20%><span class="heading"><b>Date</b></td>
            <td bgcolor="#00DDFF" width=15%><span class="heading"><b>Shift</b></td>
            <td bgcolor="#00DDFF" width=20%><span class="heading"><b>PRN</b></td>
            <td bgcolor="#00DDFF" width=20%><span class="heading"><b>Qty</b></td>
            <td bgcolor="#00DDFF" width=20%><span class="heading"><b>Cost</b></td>
        </tr>



<?php
        $result = $newreport->get_mccost('VMC 70L',$cond);
        while ($myrow = mysql_fetch_row($result)) {
              if($myrow[2] != '0000-00-00' && $myrow[2] != '' && $myrow[2] != 'NULL')
              {
                  $datearr = split('-', $myrow[2]);
                  $d=$datearr[2];
                  $m=$datearr[1];
                  $y=$datearr[0];
                  $x=mktime(0,0,0,$m,$d,$y);
                  $date1=date("M j, Y",$x);
              }
              else
              {
                  $date1 = '';
              }
?>
            <tr>
              <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $date1 ?></td>
              <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[3] ?></td>
              <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[1] ?></td>
              <td bgcolor="#FFFFFF"><span class="tabletext"><?php printf('%.2f',$myrow[6]) ?></td>
              <td align="right" bgcolor="#FFFFFF"><span class="tabletext"><?php printf('%.2f',$myrow[4]) ?></td>
            </tr>
<?php
         }
?>
</table>
</div>
</td>
</tr>
<tr><td>&nbsp</td></tr>
<tr>
<td>
<div id='dmg360ld'>
<table id='dmg360l' width=100% border=1 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
        <tr>
         <td colspan=2 bgcolor="#FFFFFF"><span class="labeltext"><b>From &nbsp&nbsp</b>
         <input type="text" name="fdmg360l" id="fdmg360l" size=10 value="<?php echo $fromdate1 ?>"
          style="background-color:#DDDDDD;" readonly="readonly"
           onkeypress="javascript: return checkenter(event)">
         <img src="images/bu-getdateicon.gif" alt="Get Date" onclick='GetDate("fdmg360l")'>
          <span class="labeltext"><b>&nbsp;&nbsp;To</b>
         <input type="text" name="tdmg360l" id="tdmg360l" size=10 value="<?php echo $todate1 ?>"
          style="background-color:#DDDDDD;" readonly="readonly"
          onkeypress="javascript: return checkenter(event)">
         <img src="images/bu-getdateicon.gif" alt="Get Date" onclick='GetDate("tdmg360l")'>
         <input type="image" name="Submit" src="images/bu-get.gif" value="Get"
            onclick="javascript: getcost('DMG 360L','dmg360ld','dmg360l','fdmg360l','tdmg360l')">
         </td>
        <td colspan=2 align="center" bgcolor="#00DDFF"><span class="heading"><b>DMG 360L</b></td>
<?php
       $cond = "op.st_date >= '$fromdate1' and op.st_date <= '$todate1'";
        $result = $newreport->get_mccost('DMG 360L',$cond);
        $totcost = 0;
        while ($myrow = mysql_fetch_row($result)) {
              $totcost += $myrow[4];
        }
?>
        <td  align="right" colspan=2 bgcolor="#FFFFFF"><span class="heading"><b>Total:<?php printf('%.2f', $totcost) ?></b></td>
        </tr>
        <tr>
            <td bgcolor="#00DDFF" width=20%><span class="heading"><b>Date</b></td>
            <td bgcolor="#00DDFF" width=15%><span class="heading"><b>Shift</b></td>
            <td bgcolor="#00DDFF" width=20%><span class="heading"><b>PRN</b></td>
            <td bgcolor="#00DDFF" width=20%><span class="heading"><b>Qty</b></td>
            <td bgcolor="#00DDFF" width=20%><span class="heading"><b>Cost</b></td>
        </tr>



<?php
        $result = $newreport->get_mccost('DMG 360L',$cond);
        while ($myrow = mysql_fetch_row($result)) {
              if($myrow[2] != '0000-00-00' && $myrow[2] != '' && $myrow[2] != 'NULL')
              {
                  $datearr = split('-', $myrow[2]);
                  $d=$datearr[2];
                  $m=$datearr[1];
                  $y=$datearr[0];
                  $x=mktime(0,0,0,$m,$d,$y);
                  $date1=date("M j, Y",$x);
              }
              else
              {
                  $date1 = '';
              }
?>
            <tr>
              <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $date1 ?></td>
              <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[3] ?></td>
              <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[1] ?></td>
              <td bgcolor="#FFFFFF"><span class="tabletext"><?php printf('%.2f',$myrow[6]) ?></td>
              <td align="right" bgcolor="#FFFFFF"><span class="tabletext"><?php printf('%.2f',$myrow[4]) ?></td>
            </tr>
<?php
         }
?>
</table>
</div>
</td>
</tr>
<tr><td>&nbsp</td></tr>
<tr><td>&nbsp</td></tr>
<tr>
<td>
<div id='dx2001d'>
<table id='dx2001' width=100% border=1 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
        <tr>
         <td colspan=2 bgcolor="#FFFFFF"><span class="labeltext"><b>From &nbsp&nbsp</b>
         <input type="text" id="fdx2001" name="fdx2001" size=10 value="<?php echo $fromdate1 ?>"
          style="background-color:#DDDDDD;" readonly="readonly"
          onkeypress="javascript: return checkenter(event)">
         <img src="images/bu-getdateicon.gif" alt="Get Date" onclick='GetDate("fdx2001")'>
          <span class="labeltext"><b>&nbsp;&nbsp;To</b>
         <input type="text" id="tdx2001" name="tdx2001" size=10 value="<?php echo $todate1 ?>"
          style="background-color:#DDDDDD;" readonly="readonly"
          onkeypress="javascript: return checkenter(event)">
         <img src="images/bu-getdateicon.gif" alt="Get Date" onclick='GetDate("tdx2001")'>
         <input type="image" src="images/bu-get.gif"
            onclick="javascript: getcost('DX 200-1','dx2001d','dx2001','fdx2001','tdx2001')">
         </td>
        <td colspan=2 align="center" bgcolor="#00DDFF"><span class="heading"><b>DX 200-1</b></td>
<?php
        $cond = "op.st_date >= '$fromdate1' and op.st_date <= '$todate1'";
        $result = $newreport->get_mccost('DX 200-1',$cond);
        $totcost = 0;
        while ($myrow = mysql_fetch_row($result)) {
              $totcost += $myrow[4];
        }
?>
        <td  align="right" colspan=2 bgcolor="#FFFFFF"><span class="heading"><b>Total:<?php printf('%.2f', $totcost) ?></b></td>
        </tr>
        <tr>
            <td bgcolor="#00DDFF" width=20%><span class="heading"><b>Date</b></td>
            <td bgcolor="#00DDFF" width=15%><span class="heading"><b>Shift</b></td>
            <td bgcolor="#00DDFF" width=20%><span class="heading"><b>PRN</b></td>
            <td bgcolor="#00DDFF" width=20%><span class="heading"><b>Qty</b></td>
            <td bgcolor="#00DDFF" width=20%><span class="heading"><b>Cost</b></td>
        </tr>

<?php
        $result = $newreport->get_mccost('DX 200-1',$cond);
        while ($myrow = mysql_fetch_row($result)) {
              if($myrow[2] != '0000-00-00' && $myrow[2] != '' && $myrow[2] != 'NULL')
              {
                  $datearr = split('-', $myrow[2]);
                  $d=$datearr[2];
                  $m=$datearr[1];
                  $y=$datearr[0];
                  $x=mktime(0,0,0,$m,$d,$y);
                  $date1=date("M j, Y",$x);
              }
              else
              {
                  $date1 = '';
              }
?>
            <tr>
              <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $date1 ?></td>
              <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[3] ?></td>
              <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[1] ?></td>
              <td bgcolor="#FFFFFF"><span class="tabletext"><?php printf('%.2f',$myrow[6]) ?></td>
              <td align="right" bgcolor="#FFFFFF"><span class="tabletext"><?php printf('%.2f',$myrow[4]) ?></td>
            </tr>
<?php
         }
?>
</table>
</div>
</td>
</tr>
<tr><td>&nbsp</td></tr>
<tr><td>&nbsp</td></tr>
<tr>
<td>

<div id='dx2002d'>
<table id='dx2002' width=100% border=1 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
        <tr>
         <td colspan=2 bgcolor="#FFFFFF"><span class="labeltext"><b>From &nbsp&nbsp</b>
         <input type="text" name="fdx2002" id="fdx2002" size=10 value="<?php echo $fromdate1 ?>"
          style="background-color:#DDDDDD;" readonly="readonly"
          onkeypress="javascript: return checkenter(event)">
         <img src="images/bu-getdateicon.gif" alt="Get Date" onclick='GetDate("fdx2002")'>
          <span class="labeltext"><b>&nbsp;&nbsp;To</b>
         <input type="text" name="tdx2002" id="tdx2002" size=10 value="<?php echo $todate1 ?>"
          style="background-color:#DDDDDD;" readonly="readonly"
          onkeypress="javascript: return checkenter(event)">
         <img src="images/bu-getdateicon.gif" alt="Get Date" onclick='GetDate("tdx2002")'>
         <input type="image" src="images/bu-get.gif"
            onclick="javascript: getcost('DX 200-2','dx2002d','dx2002','fdx2002','tdx2002')">
         </td>
        <td colspan=2 align="center" bgcolor="#00DDFF"><span class="heading"><b>DX 200-2</b></td>
<?php
        $cond = "op.st_date >= '$fromdate1' and op.st_date <= '$todate1'";
        $result = $newreport->get_mccost('DX 200-2',$cond);
        $totcost = 0;
        while ($myrow = mysql_fetch_row($result)) {
              $totcost += $myrow[4];
        }
?>
        <td  align="right" colspan=2 bgcolor="#FFFFFF"><span class="heading"><b>Total:<?php printf('%.2f', $totcost) ?></b></td>
        </tr>
        <tr>
            <td bgcolor="#00DDFF" width=20%><span class="heading"><b>Date</b></td>
            <td bgcolor="#00DDFF" width=15%><span class="heading"><b>Shift</b></td>
            <td bgcolor="#00DDFF" width=20%><span class="heading"><b>PRN</b></td>
            <td bgcolor="#00DDFF" width=20%><span class="heading"><b>Qty</b></td>
            <td bgcolor="#00DDFF" width=20%><span class="heading"><b>Cost</b></td>
        </tr>


<?php
        $result = $newreport->get_mccost('DX 200-2',$cond);
        while ($myrow = mysql_fetch_row($result)) {
              if($myrow[2] != '0000-00-00' && $myrow[2] != '' && $myrow[2] != 'NULL')
              {
                  $datearr = split('-', $myrow[2]);
                  $d=$datearr[2];
                  $m=$datearr[1];
                  $y=$datearr[0];
                  $x=mktime(0,0,0,$m,$d,$y);
                  $date1=date("M j, Y",$x);
              }
              else
              {
                  $date1 = '';
              }
?>
            <tr>
              <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $date1 ?></td>
              <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[3] ?></td>
              <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[1] ?></td>
              <td bgcolor="#FFFFFF"><span class="tabletext"><?php printf('%.2f',$myrow[6]) ?></td>
              <td align="right" bgcolor="#FFFFFF"><span class="tabletext"><?php printf('%.2f',$myrow[4]) ?></td>
            </tr>
<?php
         }
?>
</table>
</div>
</td>
</tr>
<tr>
<td>
<div id='dx2003d'>
<table id='dx2003' width=100% border=1 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
        <tr>
         <td colspan=2 bgcolor="#FFFFFF"><span class="labeltext"><b>From &nbsp&nbsp</b>
         <input type="text" name="fdx2003" id="fdx2003" size=10 value="<?php echo $fromdate1 ?>"
          style="background-color:#DDDDDD;" readonly="readonly"
          onkeypress="javascript: return checkenter(event)">
         <img src="images/bu-getdateicon.gif" alt="Get Date" onclick='GetDate("fdx2003")'>
          <span class="labeltext"><b>&nbsp;&nbsp;To</b>
         <input type="text" name="tdx2003" id="tdx2003" size=10 value="<?php echo $todate1 ?>"
          style="background-color:#DDDDDD;" readonly="readonly"
          onkeypress="javascript: return checkenter(event)">
         <img src="images/bu-getdateicon.gif" alt="Get Date" onclick='GetDate("tdx2003")'>
         <input type="image" name="Submit" src="images/bu-get.gif" value="Get"
            onclick="javascript: getcost('DX 200-3','dx2003d','dx2003','fdx2003','tdx2003')">
         </td>
        <td colspan=2 align="center" bgcolor="#00DDFF"><span class="heading"><b>DX 200-3</b></td>
<?php
        $cond = "op.st_date >= '$fromdate1' and op.st_date <= '$todate1'";
        $result = $newreport->get_mccost('DX 200-3',$cond);
        $totcost = 0;
        while ($myrow = mysql_fetch_row($result)) {
              $totcost += $myrow[4];
        }
?>
        <td  align="right" colspan=2 bgcolor="#FFFFFF"><span class="heading"><b>Total:<?php printf('%.2f', $totcost) ?></b></td>
        </tr>
        <tr>
            <td bgcolor="#00DDFF" width=20%><span class="heading"><b>Date</b></td>
            <td bgcolor="#00DDFF" width=15%><span class="heading"><b>Shift</b></td>
            <td bgcolor="#00DDFF" width=20%><span class="heading"><b>PRN</b></td>
            <td bgcolor="#00DDFF" width=20%><span class="heading"><b>Qty</b></td>
            <td bgcolor="#00DDFF" width=20%><span class="heading"><b>Cost</b></td>
        </tr>


<?php
        $result = $newreport->get_mccost('DX 200-3',$cond);
        while ($myrow = mysql_fetch_row($result)) {
              if($myrow[2] != '0000-00-00' && $myrow[2] != '' && $myrow[2] != 'NULL')
              {
                  $datearr = split('-', $myrow[2]);
                  $d=$datearr[2];
                  $m=$datearr[1];
                  $y=$datearr[0];
                  $x=mktime(0,0,0,$m,$d,$y);
                  $date1=date("M j, Y",$x);
              }
              else
              {
                  $date1 = '';
              }
?>
            <tr>
              <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $date1 ?></td>
              <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[3] ?></td>
              <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[1] ?></td>
              <td bgcolor="#FFFFFF"><span class="tabletext"><?php printf('%.2f',$myrow[6]) ?></td>
              <td align="right" bgcolor="#FFFFFF"><span class="tabletext"><?php printf('%.2f',$myrow[4]) ?></td>
            </tr>
<?php
         }
?>
</table>
</div>
</td>
</tr>
-->
<tr>
<td>
<td width="6"><img src="images/spacer.gif " width="6"></td>
</tr>
<tr bgcolor="DEDFDE">
<td width="6"><img src="images/box-left-bottom.gif"></td>
<td><img src="images/spacer.gif " height="6"></td>
<td width="6"><img src="images/box-right-bottom.gif"></td>
</tr>
</table>


<table border = 0 cellpadding=0 cellspacing=0 width=100% >
<tr>
	<td align=left>
  <?php
//  Added on Dec 6,04 for paging

$numrows = 10;

// how many pages we have when using paging?
$maxPage = ceil($numrows/$rowsPerPage);

if (!isset($_REQUEST['page']))
{
    $totpages = $maxPage;
}

$self = $_SERVER['PHP_SELF'];

// creating 'previous' and 'next' link
// plus 'first page' and 'last page' link

// print 'previous' link only if we're not
// on page one
if ($pageNum > 1)
{
    $page = $pageNum - 1;
    $prev = " <a href=\"stockgrn_status.php\">[Prev]</a> ";

    $first = " <a href=\"stockgrn_status.php\">[First Page]</a> ";
}
else
{
    $prev  = ' [Prev] ';       // we're on page one, don't enable 'previous' link
    $first = ' [First Page] '; // nor 'first page' link
}

// print 'next' link only if we're not
// on the last page
if ($pageNum < $totpages)
{
    $page = $pageNum + 1;
  $next = " <a href=\"stockgrn_statu.php\">[Next]</a> ";

  $last = " <a href=\"stockgrn_status.php\">[Last Page]</a> ";
}
else
{
    $next = ' [Next] ';      // we're on the last page, don't enable 'next' link
    $last = ' [Last Page] '; // nor 'last page' link
}

if($totpages!=0)
{
//$pageNum=0;
// print the page navigation link
echo "<span class=\"labeltext\">" . $first . $prev . " Showing page <strong>$pageNum</strong> of <strong>$totpages</strong> pages " . $next . $last;
}
else
echo "<span class=\"labeltext\"><align=\"center\">No matching records found";
// End additions on Dec 6,04

?>
</td>
</tr></table>

</body>
</html>
