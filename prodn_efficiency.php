<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = Jan 06, 2009                 =
// Filename: prodn_efficiency.php              =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 WMS                          =
// Displays Machine Utilization Efficiency     =
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
date_default_timezone_set('Asia/Calcutta');
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
?>

<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/report.js"></script>
<html>
<head>
<script language="javascript">
function openPrintWindow(divids){
var divs="";
for(i=0;i<divids.length;i++)
{
divs+=((i!=0)?"&":"")+"divid"+i+"="+ divids[i];
}
//alert(divs);
window.open("print.html?"+divs,"PrintWindow","menubar=0,resizable=1"+",width=1000"+",height=650");
}
</script>
<title>Machine Utilization Efficiency Report</title>
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
<table width=100% border=0 cellpadding=6 cellspacing=0>
<tr>
<td>
<table width=100% border=0 >
<tr><td align="center"><span class="heading"><b>Machine Utlization Efficiency</b></td>

<tr><td>

</td></tr>
</tr>
</table>
<tr>
<td>
<div id='bmv601d'>
<table id='bmv601' width=100% border=1 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
        <tr>
         <td width=40% bgcolor="#FFFFFF"><span class="labeltext"><b>From &nbsp&nbsp</b>
         <input type="text" id="fbmv601" name="fbmv601" size=10 value="<?php echo $fromdate1 ?>"
          style="background-color:#DDDDDD;" readonly="readonly"
          onkeypress="javascript: return checkenter(event)">
         <img src="images/bu-getdateicon.gif" alt="Get Date" onclick="GetDate('fbmv601')">
          <span class="labeltext"><b>&nbsp;&nbsp;To</b>
         <input type="text" id="tbmv601" name="tbmv601" size=10 value="<?php echo $todate1 ?>"
          style="background-color:#DDDDDD;" readonly="readonly"
          onkeypress="javascript: return checkenter(event)">
         <img src="images/bu-getdateicon.gif" alt="Get Date" onclick="GetDate('tbmv601')">
         <input type="image" name="Submit" src="images/bu-get.gif" value="Get"
            onclick="javascript: getmc_eff('BMV 60-1','bmv601d','bmv601','fbmv601','tbmv601')">

         </td>
        <td width=30% align="center" bgcolor="#00DDFF"><span class="heading"><b>BMV 60-1</b></td>
        <td align="center" bgcolor="#FFFFFF">
        <input type= "image" name="Print" src="images/bu-print.gif" value="Get"
onclick='javascript: openPrintWindow(new Array("chartbmv601","bmv601div"))'>
</td>

<td align="center" bgcolor="#FFFFFF">
        <input type= "image" name="Print" src="images/printchart.gif" value="Get"
onclick='javascript: openPrintWindow(new Array("chartbmv601","bmv61div"))'>
</td>

<?php
        $cond = "op.st_date >= '$fromdate1' and op.st_date <= '$todate1'";
        $_SESSION['ccond'] = $cond;
?>
        </tr>
</table>

<div id="bmv601div">
<table width=100% border=1 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
<tr>
        <tr>
            <td bgcolor="#00DDFF" width=20%><span class="heading"><b>PRN</b></td>
            <td bgcolor="#00DDFF" width=10%><span class="heading"><b>Stage</b></td>
            <td bgcolor="#00DDFF" width=10%><span class="heading"><b>Qty Mfg</b></td>
            <td bgcolor="#00DDFF"><span class="heading"><b>Est<br>Time</b></td>
            <td bgcolor="#00DDFF"><span class="heading"><b>Actual<br>Time</b></td>
            <td bgcolor="#00DDFF"><span class="heading"><b>Rej<br>Qty</b></td>
            <td bgcolor="#00DDFF"><span class="heading"><b>Rej<br>Time</b></td>
            <td bgcolor="#00DDFF" width=10%><span class="heading"><b>Lost or<br>Gained</b></td>
        </tr>



<?php
        $total_est_time = 0;
        $total_actual_time = 0;
        $total_rej_time = 0;
        $total_lossrgain_time = 0;
        $result = $newreport->gettime4prodn_eff_tab('BMV 60-1',$cond);
        
        while ($myrow = mysql_fetch_row($result)) {

?>
            <tr>
              <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[1];
               $crn[]= $myrow[1];
               ?></td>
              <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[2] ?></td>
              <td bgcolor="#FFFFFF"><span class="tabletext"><?php printf('%.2f', $myrow[3]) ?></td>
              <td bgcolor="#FFFFFF"><span class="tabletext"><?php printf ("%.2f",($myrow[4]+$myrow[7]));
               $total_est_time += ($myrow[4]+$myrow[7]);
               $esttime[]= ($myrow[4]+$myrow[7]);
               ?></td>
              <td bgcolor="#FFFFFF"><span class="tabletext"><?php printf ("%.2f",($myrow[5]+$myrow[6]));
               $total_actual_time += ($myrow[5]+$myrow[6]);
               $actualtime[]= ($myrow[5]+$myrow[6])
               ?></td>
              <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo  $myrow[8] ?></td>
              <td bgcolor="#FFFFFF"><span class="tabletext">
              <?php
               if($myrow[8] != 0)
               {
                 $result4rejtime = $newreport->getmaster_rejtime4prodn_eff($myrow[1],$myrow[2],$myrow[8]);
                 $myrow4rejtime = mysql_fetch_row($result4rejtime);
                 $rej_time=$myrow4rejtime[2];
                 printf("%.2f", $rej_time);
                 $total_rej_time += $rej_time;
               }
               else
               {
                 $rej_time = 0;
                 printf("%.2f",$rej_time);
                 $total_rej_time += $rej_time;
               }
              ?>
              </td>
              <td bgcolor="#FFFFFF"><span class="tabletext">
              <?php
               printf("%.2f", (($myrow[4]+$myrow[7])-(($myrow[5]+$myrow[6]+$rej_time))));
               $total_lossrgain_time += (($myrow[4]+$myrow[7])-(($myrow[5]+$myrow[6]+$rej_time)));
               $lossrgain[]=(($myrow[4]+$myrow[7])-(($myrow[5]+$myrow[6]+$rej_time)));
              ?>
              </td>
            </tr>
<?php
         }
       unset($rej_time);
       
?>
<tr bgcolor="#FFFFFF">
 <td colspan=3 bgcolor="#FFFFFF" align="right"><span class="tabletext"><b>Total</b></td>
  <td bgcolor="#00DDFF"><span class="tabletext"><?php printf("%.2f", $total_est_time); ?></td>
 <td bgcolor="#00DDFF"><span class="tabletext"><?php printf("%.2f", $total_actual_time); ?></td>
  <td bgcolor="#00DDFF"><span class="tabletext">&nbsp;</td>
 <td bgcolor="#00DDFF"><span class="tabletext"><?php printf("%.2f", $total_rej_time); ?></td>
 <td bgcolor="#00DDFF"><span class="tabletext"><?php printf("%.2f", $total_lossrgain_time); ?></td>
</tr>
</table>
<div id="bmv61div">
<table border=1 bgcolor="#FFFFFF" width=100% cellspacing=1 cellpadding=3>
<tr bgcolor="#FFFFFF">
<td colspan=10 bgcolor="#FFFFFF" align='right'><span class="tabletext"><b>Machine Utilization Efficiency</b></td>
 <td colspan=2 bgcolor="#99FFFF"><span class="tabletext"><?php
 $machine_eff = ($total_actual_time+$total_rej_time) != 0? ((($total_est_time)/($total_actual_time+$total_rej_time))*100):0;
 printf("%.2f",$machine_eff);
 echo '%';
 ?></td>
</tr>

        <tr bgcolor="#FFFFFF">
            <td colspan=10><span class="labeltext">F8400-S</td>
            <td><span class="labeltext">Rev No:0 &nbsp Rev Date:8-1-2009</td>
            <td><span class="labeltext"></td>
        </tr>

</table>
</div>

</div>
<table>
<tr>
<td id="chartbmv601">
 <?php
      include_once 'ofc-library/open_flash_chart_object.php';
      $mc=urlencode('BMV 60-1');
      //$wcond = htmlentities($cond);
      open_flash_chart_object( 1000, 350, 'https://'. $_SERVER['SERVER_NAME'] .'/wms/chart-prodneff1.php?mcname='.$mc.'&sdate='.$fromdate1.'&edate='.$todate1, false );
      //open_flash_chart_object( 1000, 350, 'http://'. $_SERVER['SERVER_NAME'] .'/wms_bk_jan5/gallerydata.php', false );

 ?>
</td>
</table>
</tr>
</div>
</td>
</tr>
<tr><td>&nbsp</td></tr>
<tr>
<td>
<div id='bmv602d'>
<table id='bmv602' width=100% border=1 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
        <tr>
         <td width=40% bgcolor="#FFFFFF"><span class="labeltext"><b>From &nbsp&nbsp</b>
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
            onclick="javascript: getmc_eff('BMV 60-2','bmv602d','bmv602','fbmv602','tbmv602')">
         </td>
        <td width=30% align="center" bgcolor="#00DDFF"><span class="heading"><b>BMV 602</b></td>
        <td align="center" bgcolor="#FFFFFF">
        <input type= "image" name="Print" src="images/bu-print.gif" value="Get"
        onclick='javascript: openPrintWindow(new Array("chartbmv602","bmv602div"))'>
</td>

  <td align="center" bgcolor="#FFFFFF">
        <input type= "image" name="Print" src="images/printchart.gif" value="Get"
        onclick='javascript: openPrintWindow(new Array("chartbmv602","bmv62div"))'>
</td>

<?php
        $cond = "op.st_date >= '$fromdate1' and op.st_date <= '$todate1'";
?>
        </tr>
     </table>
     <div id="bmv602div">
     <table width=100% border=1 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
        
        <tr>
            <td bgcolor="#00DDFF" width=20%><span class="heading"><b>PRN</b></td>
            <td bgcolor="#00DDFF" width=10%><span class="heading"><b>Stage</b></td>
            <td bgcolor="#00DDFF" width=10%><span class="heading"><b>Qty Mfg</b></td>
            <td bgcolor="#00DDFF"><span class="heading"><b>Est<br>Time</b></td>
            <td bgcolor="#00DDFF"><span class="heading"><b>Actual<br>Time</b></td>
            <td bgcolor="#00DDFF"><span class="heading"><b>Rej<br>Qty</b></td>
            <td bgcolor="#00DDFF"><span class="heading"><b>Rej<br>Time</b></td>
            <td bgcolor="#00DDFF" width=10%><span class="heading"><b>Lost or<br>Gained</b></td>
        </tr>



<?php
        $total_est_time = 0;
        $total_actual_time = 0;
        $total_rej_time = 0;
        $total_lossrgain_time = 0;
        $result = $newreport->gettime4prodn_eff_tab('BMV 60-2',$cond);
        while ($myrow = mysql_fetch_row($result)) {
?>
            <tr>
              <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[1] ?></td>
              <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[2] ?></td>
              <td bgcolor="#FFFFFF"><span class="tabletext"><?php printf('%.2f', $myrow[3]) ?></td>
              <td bgcolor="#FFFFFF"><span class="tabletext"><?php printf("%.2f",($myrow[4]+$myrow[7]));
               $total_est_time += ($myrow[4]+$myrow[7]);
               ?></td>
              <td bgcolor="#FFFFFF"><span class="tabletext"><?php printf("%.2f",($myrow[5]+$myrow[6]));
               $total_actual_time += ($myrow[5]+$myrow[6]);
               ?></td>
              <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo  $myrow[8] ?></td>
              <td bgcolor="#FFFFFF"><span class="tabletext">
              <?php
               if($myrow[8] != 0)
               {
                 $result4rejtime = $newreport->getmaster_rejtime4prodn_eff($myrow[1],$myrow[2],$myrow[8]);
                 $myrow4rejtime = mysql_fetch_row($result4rejtime);
                 $rej_time=$myrow4rejtime[2];
                 printf("%.2f",$rej_time);
                 $total_rej_time += $rej_time;
               }
               else
               {
                 $rej_time = 0;
                 printf("%.2f",$rej_time);
                 $total_rej_time += $rej_time;
               }
              ?>
              </td>
              <td bgcolor="#FFFFFF"><span class="tabletext">
              <?php
               printf("%.2f", (($myrow[4]+$myrow[7])-(($myrow[5]+$myrow[6]+$rej_time))));
               $total_lossrgain_time += (($myrow[4]+$myrow[7])-(($myrow[5]+$myrow[6]+$rej_time)));
              ?>
              </td>
            </tr>
<?php
         }
       unset($rej_time);
?>
<tr bgcolor="#FFFFFF">
 <td colspan=3 bgcolor="#FFFFFF" align="right"><span class="tabletext"><b>Total</b></td>
  <td bgcolor="#00DDFF"><span class="tabletext"><?php printf("%.2f", $total_est_time); ?></td>
 <td bgcolor="#00DDFF"><span class="tabletext"><?php printf("%.2f", $total_actual_time); ?></td>
  <td bgcolor="#00DDFF"><span class="tabletext">&nbsp;</td>
 <td bgcolor="#00DDFF"><span class="tabletext"><?php printf("%.2f", $total_rej_time); ?></td>
 <td bgcolor="#00DDFF"><span class="tabletext"><?php printf("%.2f", $total_lossrgain_time); ?></td>
</tr>
</table>
<div id="bmv62div">
<table border=1 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3>
<tr bgcolor="#FFFFFF">
 <td colspan=3 bgcolor="#FFFFFF" align="right"><span class="tabletext"><b>Machine Utilization Efficiency</b></td>
 <td colspan=5 bgcolor="#99FFFF"><span class="tabletext"><?php
 $machine_eff = ($total_actual_time+$total_rej_time) != 0? ((($total_est_time)/($total_actual_time+$total_rej_time))*100):0;
 printf("%.2f",$machine_eff);
 echo '%';
 ?></td>
</tr>

        <tr bgcolor="#FFFFFF">
            <td colspan=4><span class="labeltext">F8400-S</td>
            <td colspan=2><span class="labeltext">Rev No:0 &nbsp Rev Date:8-1-2009</td>
            <td colspan=2><span class="labeltext"></td>
        </tr>

</table>
</div>
</div>
<table>
<tr>
<td id="chartbmv602">
 <?php
      include_once 'ofc-library/open_flash_chart_object.php';
      $mc=urlencode('BMV 60-2');
      //$wcond = htmlentities($cond);
      open_flash_chart_object( 1000, 350, 'https://'. $_SERVER['SERVER_NAME'] .'/wms/chart-prodneff1.php?mcname='.$mc.'&sdate='.$fromdate1.'&edate='.$todate1, false );
 ?>
</td>
</tr>
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
         <td width=40% bgcolor="#FFFFFF"><span class="labeltext"><b>From &nbsp&nbsp</b>
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
            onclick="javascript: getmc_eff('BMV 45-1','bmv451d','bmv451','fbmv451','tbmv451')">
         </td>
        <td width=30% align="center" bgcolor="#00DDFF"><span class="heading"><b>BMV 45-1</b></td>
        <td align="center" bgcolor="#FFFFFF">
        <input type= "image" name="Print" src="images/bu-print.gif" value="Get"
        onclick='javascript: openPrintWindow(new Array("chartbmv451","bmv451div"))'>
        </td>
        
		<td align="center" bgcolor="#FFFFFF">
        <input type= "image" name="Print" src="images/printchart.gif" value="Get"
        onclick='javascript: openPrintWindow(new Array("chartbmv451","bmv4551div"))'>
        </td>

<?php
        $cond = "op.st_date >= '$fromdate1' and op.st_date <= '$todate1'";
?>
        </tr>
        </table>
        <div id="bmv451div">
     <table width=100% border=1 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
        <tr>
            <td bgcolor="#00DDFF" width=20%><span class="heading"><b>PRN</b></td>
            <td bgcolor="#00DDFF" width=10%><span class="heading"><b>Stage</b></td>
            <td bgcolor="#00DDFF" width=10%><span class="heading"><b>Qty Mfg</b></td>
            <td bgcolor="#00DDFF"><span class="heading"><b>Est<br>Time</b></td>
            <td bgcolor="#00DDFF"><span class="heading"><b>Actual<br>Time</b></td>
            <td bgcolor="#00DDFF"><span class="heading"><b>Rej<br>Qty</b></td>
            <td bgcolor="#00DDFF"><span class="heading"><b>Rej<br>Time</b></td>
            <td bgcolor="#00DDFF" width=10%><span class="heading"><b>Lost or<br>Gained</b></td>
        </tr>



<?php
        $total_est_time = 0;
        $total_actual_time = 0;
        $total_rej_time = 0;
        $total_lossrgain_time = 0;
        $result = $newreport->gettime4prodn_eff_tab('BMV 45-1',$cond);
        while ($myrow = mysql_fetch_row($result)) {
?>
           <tr>
              <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[1] ?></td>
              <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[2] ?></td>
              <td bgcolor="#FFFFFF"><span class="tabletext"><?php printf('%.2f', $myrow[3]) ?></td>
             <td bgcolor="#FFFFFF"><span class="tabletext"><?php printf("%.2f",($myrow[4]+$myrow[7]));
               $total_est_time += ($myrow[4]+$myrow[7]);
               ?></td>
            <td bgcolor="#FFFFFF"><span class="tabletext"><?php printf ("%.2f",($myrow[5]+$myrow[6]));
               $total_actual_time += ($myrow[5]+$myrow[6]);
               ?></td>
              <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo  $myrow[8] ?></td>
              <td bgcolor="#FFFFFF"><span class="tabletext">
              <?php
               if($myrow[8] != 0)
               {
                 $result4rejtime = $newreport->getmaster_rejtime4prodn_eff($myrow[1],$myrow[2],$myrow[8]);
                 $myrow4rejtime = mysql_fetch_row($result4rejtime);
                 $rej_time=$myrow4rejtime[2];
                 printf("%.2f", $rej_time);
                 $total_rej_time += $rej_time;
               }
               else
               {
                 $rej_time = 0;
                 printf("%.2f", $rej_time);
                 $total_rej_time += $rej_time;
               }
              ?>
              </td>
              <td bgcolor="#FFFFFF"><span class="tabletext">
              <?php
              printf("%.2f", (($myrow[4]+$myrow[7])-(($myrow[5]+$myrow[6]+$rej_time))));
               $total_lossrgain_time += (($myrow[4]+$myrow[7])-(($myrow[5]+$myrow[6]+$rej_time)));
              ?>
              </td>
            </tr>
<?php
         }
        unset($rej_time);
?>
<tr bgcolor="#FFFFFF">
 <td colspan=3 bgcolor="#FFFFFF" align="right"><span class="tabletext"><b>Total</b></td>
  <td bgcolor="#00DDFF"><span class="tabletext"><?php printf("%.2f", $total_est_time); ?></td>
 <td bgcolor="#00DDFF"><span class="tabletext"><?php printf("%.2f", $total_actual_time); ?></td>
  <td bgcolor="#00DDFF"><span class="tabletext">&nbsp;</td>
 <td bgcolor="#00DDFF"><span class="tabletext"><?php printf("%.2f", $total_rej_time); ?></td>
 <td bgcolor="#00DDFF"><span class="tabletext"><?php printf("%.2f", $total_lossrgain_time); ?></td>
</tr>
</table>
<div id="bmv4551div">
<table border=1 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3>
<tr bgcolor="#FFFFFF">
 <td colspan=3 bgcolor="#FFFFFF" align="right"><span class="tabletext"><b>Machine Utilization Efficiency</b></td>
 <td colspan=5 bgcolor="#99FFFF"><span class="tabletext"><?php
 $machine_eff = ($total_actual_time+$total_rej_time) != 0? ((($total_est_time)/($total_actual_time+$total_rej_time))*100):0;
 printf("%.2f",$machine_eff);
 echo '%';
 ?></td>
</tr>

        <tr bgcolor="#FFFFFF">
            <td colspan=4><span class="labeltext">F8400-S</td>
            <td colspan=2><span class="labeltext">Rev No:0 &nbsp Rev Date:8-1-2009</td>
            <td colspan=2><span class="labeltext"></td>
        </tr>

</table>
</div>
</div>
<table>
<tr>
<td id="chartbmv451">
 <?php
      include_once 'ofc-library/open_flash_chart_object.php';
      $mc=urlencode('BMV 45-1');
      //$wcond = htmlentities($cond);
      open_flash_chart_object( 1000, 350, 'https://'. $_SERVER['SERVER_NAME'] .'/wms/chart-prodneff1.php?mcname='.$mc.'&sdate='.$fromdate1.'&edate='.$todate1, false );
 ?>
</td>
</tr>
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
         <td width=40% bgcolor="#FFFFFF"><span class="labeltext"><b>From &nbsp&nbsp</b>
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
            onclick="javascript: getmc_eff('BMV 45-2','bmv452d','bmv452','fbmv452','tbmv452')">
         </td>
        <td width=30% align="center" bgcolor="#00DDFF"><span class="heading"><b>BMV 45-2</b></td>
        <td align="center" bgcolor="#FFFFFF">
        <input type= "image" name="Print" src="images/bu-print.gif" value="Get"
        onclick='javascript: openPrintWindow(new Array("chartbmv452","bmv452div"))'>
        </td>

		 <td align="center" bgcolor="#FFFFFF">
        <input type= "image" name="Print" src="images/printchart.gif" value="Get"
        onclick='javascript: openPrintWindow(new Array("chartbmv452","bmv4552div"))'>
        </td>
<?php
        $cond = "op.st_date >= '$fromdate1' and op.st_date <= '$todate1'";
?>

        </tr>
          </table>
           <div id="bmv452div">
     <table width=100% border=1 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
        <tr>
            <td bgcolor="#00DDFF" width=20%><span class="heading"><b>PRN</b></td>
            <td bgcolor="#00DDFF" width=10%><span class="heading"><b>Stage</b></td>
            <td bgcolor="#00DDFF" width=10%><span class="heading"><b>Qty Mfg</b></td>
            <td bgcolor="#00DDFF"><span class="heading"><b>Est<br>Time</b></td>
            <td bgcolor="#00DDFF"><span class="heading"><b>Actual<br>Time</b></td>
            <td bgcolor="#00DDFF"><span class="heading"><b>Rej<br>Qty</b></td>
            <td bgcolor="#00DDFF"><span class="heading"><b>Rej<br>Time</b></td>
            <td bgcolor="#00DDFF" width=10%><span class="heading"><b>Lost or<br>Gained</b></td>
        </tr>


<?php
        $total_est_time = 0;
        $total_actual_time = 0;
        $total_rej_time = 0;
        $total_lossrgain_time = 0;
        $result = $newreport->gettime4prodn_eff_tab('BMV 45-2',$cond);
        while ($myrow = mysql_fetch_row($result)) {
?>
            <tr>
              <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[1] ?></td>
              <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[2] ?></td>
              <td bgcolor="#FFFFFF"><span class="tabletext"><?php printf('%.2f', $myrow[3]) ?></td>
              <td bgcolor="#FFFFFF"><span class="tabletext"><?php printf("%.2f",($myrow[4]+$myrow[7]));
               $total_est_time += ($myrow[4]+$myrow[7]);
               ?></td>
            <td bgcolor="#FFFFFF"><span class="tabletext"><?php printf ("%.2f",($myrow[5]+$myrow[6]));
               $total_actual_time += ($myrow[5]+$myrow[6]);
               ?></td>
              <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo  $myrow[8] ?></td>
              <td bgcolor="#FFFFFF"><span class="tabletext">
              <?php
               if($myrow[8] != 0)
               {
                 $result4rejtime = $newreport->getmaster_rejtime4prodn_eff($myrow[1],$myrow[2],$myrow[8]);
                 $myrow4rejtime = mysql_fetch_row($result4rejtime);
                 $rej_time=$myrow4rejtime[2];
                 printf("%.2f", $rej_time);
                 $total_rej_time += $rej_time;
               }
               else
               {
                 $rej_time = 0;
                  printf("%.2f", $rej_time);
                 $total_rej_time += $rej_time;
               }
              ?>
              </td>
              <td bgcolor="#FFFFFF"><span class="tabletext">
              <?php
               printf("%.2f", (($myrow[4]+$myrow[7])-(($myrow[5]+$myrow[6]+$rej_time))));
               $total_lossrgain_time += (($myrow[4]+$myrow[7])-(($myrow[5]+$myrow[6]+$rej_time)));
              ?>
              </td>
            </tr>
<?php
         }
        unset($rej_time);
?>
<tr bgcolor="#FFFFFF">
 <td colspan=3 bgcolor="#FFFFFF" align="right"><span class="tabletext"><b>Total</b></td>
 <td bgcolor="#00DDFF"><span class="tabletext"><?php printf("%.2f", $total_est_time); ?></td>
 <td bgcolor="#00DDFF"><span class="tabletext"><?php printf("%.2f", $total_actual_time); ?></td>
  <td bgcolor="#00DDFF"><span class="tabletext">&nbsp;</td>
 <td bgcolor="#00DDFF"><span class="tabletext"><?php printf("%.2f", $total_rej_time); ?></td>
 <td bgcolor="#00DDFF"><span class="tabletext"><?php printf("%.2f", $total_lossrgain_time); ?></td>
</tr>
</table>
<div id ="bmv4552div">
<table border=1 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3>
<tr bgcolor="#FFFFFF">
 <td colspan=3 bgcolor="#FFFFFF" align="right"><span class="tabletext"><b>Machine Utilization Efficiency</b></td>
 <td colspan=5 bgcolor="#99FFFF"><span class="tabletext"><?php
 $machine_eff = ($total_actual_time+$total_rej_time) != 0? ((($total_est_time)/($total_actual_time+$total_rej_time))*100):0;
 printf("%.2f",$machine_eff);
 echo '%';
 ?></td>
</tr>

        <tr bgcolor="#FFFFFF">
            <td colspan=4><span class="labeltext">F8400-S</td>
            <td colspan=2><span class="labeltext">Rev No:0 &nbsp Rev Date:8-1-2009</td>
            <td colspan=2><span class="labeltext"></td>
        </tr>

</table>
</div>
</div>
<table>
<tr>
<td id="chartbmv452">
 <?php
      include_once 'ofc-library/open_flash_chart_object.php';
      $mc=urlencode('BMV 45-2');
      //$wcond = htmlentities($cond);
      open_flash_chart_object( 1000, 350, 'https://'. $_SERVER['SERVER_NAME'] .'/wms/chart-prodneff1.php?mcname='.$mc.'&sdate='.$fromdate1.'&edate='.$todate1, false );
 ?>
</td>
</tr>
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
         <td width=40% bgcolor="#FFFFFF"><span class="labeltext"><b>From &nbsp&nbsp</b>
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
            onclick="javascript: getmc_eff('BMV 50','bmv50d','bmv50','fbmv50','tbmv50')">
         </td>
        <td width=30% align="center" bgcolor="#00DDFF"><span class="heading"><b>BMV 50</b></td>
        <td align="center" bgcolor="#FFFFFF">
        <input type= "image" name="Print" src="images/bu-print.gif" value="Get"
        onclick='javascript: openPrintWindow(new Array("chartbmv50","bmv50div"))'>
        </td>

		<td align="center" bgcolor="#FFFFFF">
        <input type= "image" name="Print" src="images/printchart.gif" value="Get"
        onclick='javascript: openPrintWindow(new Array("chartbmv50","bmv550div"))'>
        </td>
<?php
        $cond = "op.st_date >= '$fromdate1' and op.st_date <= '$todate1'";
?>

        </tr>
        </table>
         <div id="bmv50div">
     <table width=100% border=1 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
        <tr>
            <td bgcolor="#00DDFF" width=20%><span class="heading"><b>PRN</b></td>
            <td bgcolor="#00DDFF" width=10%><span class="heading"><b>Stage</b></td>
            <td bgcolor="#00DDFF" width=10%><span class="heading"><b>Qty Mfg</b></td>
            <td bgcolor="#00DDFF"><span class="heading"><b>Est<br>Time</b></td>
            <td bgcolor="#00DDFF"><span class="heading"><b>Actual<br>Time</b></td>
            <td bgcolor="#00DDFF"><span class="heading"><b>Rej<br>Qty</b></td>
            <td bgcolor="#00DDFF"><span class="heading"><b>Rej<br>Time</b></td>
            <td bgcolor="#00DDFF" width=10%><span class="heading"><b>Lost or<br>Gained</b></td>
        </tr>



<?php
        $total_est_time = 0;
        $total_actual_time = 0;
        $total_rej_time = 0;
        $total_lossrgain_time = 0;
        $result = $newreport->gettime4prodn_eff_tab('BMV 50',$cond);
        while ($myrow = mysql_fetch_row($result)) {
?>
            <tr>
              <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[1] ?></td>
              <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[2] ?></td>
              <td bgcolor="#FFFFFF"><span class="tabletext"><?php printf('%.2f', $myrow[3]) ?></td>
              <td bgcolor="#FFFFFF"><span class="tabletext"><?php printf("%.2f",($myrow[4]+$myrow[7]));
               $total_est_time += ($myrow[4]+$myrow[7]);
               ?></td>
              <td bgcolor="#FFFFFF"><span class="tabletext"><?php printf ("%.2f",($myrow[5]+$myrow[6]));
               $total_actual_time += ($myrow[5]+$myrow[6]);
               ?></td>
              <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo  $myrow[8] ?></td>
              <td bgcolor="#FFFFFF"><span class="tabletext">
              <?php
               if($myrow[8] != 0)
               {
                 $result4rejtime = $newreport->getmaster_rejtime4prodn_eff($myrow[1],$myrow[2],$myrow[8]);
                 $myrow4rejtime = mysql_fetch_row($result4rejtime);
                 $rej_time=$myrow4rejtime[2];
                  printf("%.2f", $rej_time);
                 $total_rej_time += $rej_time;
               }
               else
               {
                 $rej_time = 0;
                  printf("%.2f", $rej_time);
                 $total_rej_time += $rej_time;
               }
              ?>
              </td>
              <td bgcolor="#FFFFFF"><span class="tabletext">
              <?php
              printf("%.2f", (($myrow[4]+$myrow[7])-(($myrow[5]+$myrow[6]+$rej_time))));
               $total_lossrgain_time += (($myrow[4]+$myrow[7])-(($myrow[5]+$myrow[6]+$rej_time)));
              ?>
              </td>
            </tr>
<?php
         }
       unset($rej_time);
?>
<tr bgcolor="#FFFFFF">
 <td colspan=3 bgcolor="#FFFFFF" align="right"><span class="tabletext"><b>Total</b></td>
  <td bgcolor="#00DDFF"><span class="tabletext"><?php printf("%.2f", $total_est_time); ?></td>
 <td bgcolor="#00DDFF"><span class="tabletext"><?php printf("%.2f", $total_actual_time); ?></td>
  <td bgcolor="#00DDFF"><span class="tabletext">&nbsp;</td>
 <td bgcolor="#00DDFF"><span class="tabletext"><?php printf("%.2f", $total_rej_time); ?></td>
 <td bgcolor="#00DDFF"><span class="tabletext"><?php printf("%.2f", $total_lossrgain_time); ?></td>
</tr>
</table>
<div id="bmv550div">
<table border=1 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3>
<tr bgcolor="#FFFFFF">
 <td colspan=3 bgcolor="#FFFFFF" align="right"><span class="tabletext"><b>Machine Utilization Efficiency</b></td>
 <td colspan=5 bgcolor="#99FFFF"><span class="tabletext"><?php
 $machine_eff = ($total_actual_time+$total_rej_time) != 0? ((($total_est_time)/($total_actual_time+$total_rej_time))*100):0;
 printf("%.2f",$machine_eff);
 echo '%';
 ?></td>
</tr>


        <tr bgcolor="#FFFFFF">
            <td colspan=4><span class="labeltext">F8400-S</td>
            <td colspan=2><span class="labeltext">Rev No:0 &nbsp Rev Date:8-1-2009</td>
            <td colspan=2><span class="labeltext"></td>
        </tr>

</table>
</div>
</div>
<table>
<tr>
<td id="chartbmv50">
 <?php
      include_once 'ofc-library/open_flash_chart_object.php';
      $mc=urlencode('BMV 50');
      //$wcond = htmlentities($cond);
      open_flash_chart_object( 1000, 350, 'https://'. $_SERVER['SERVER_NAME'] .'/wms/chart-prodneff1.php?mcname='.$mc.'&sdate='.$fromdate1.'&edate='.$todate1, false );
 ?>
</td>
</tr>
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
         <td width=40% bgcolor="#FFFFFF"><span class="labeltext"><b>From &nbsp&nbsp</b>
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
            onclick="javascript: getmc_eff('VMC 70L','vmc70ld','vmc70l','fvmc701d','tvmc701d')">
         </td>
        <td width=30% align="center" bgcolor="#00DDFF"><span class="heading"><b>VMC 70L</b></td>
        <td align="center" bgcolor="#FFFFFF">
        <input type= "image" name="Print" src="images/bu-print.gif" value="Get"
        onclick='javascript: openPrintWindow(new Array("chartvmc70l","vmc70ldiv"))'>
        </td>

		  <td align="center" bgcolor="#FFFFFF">
        <input type= "image" name="Print" src="images/printchart.gif" value="Get"
        onclick='javascript: openPrintWindow(new Array("chartvmc70l","vmc700ldiv"))'>
        </td>
<?php
        $cond = "op.st_date >= '$fromdate1' and op.st_date <= '$todate1'";
?>
        </tr>
          </table>
          <div id="vmc70ldiv">
     <table width=100% border=1 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
        <tr>
            <td bgcolor="#00DDFF" width=20%><span class="heading"><b>PRN</b></td>
            <td bgcolor="#00DDFF" width=10%><span class="heading"><b>Stage</b></td>
            <td bgcolor="#00DDFF" width=10%><span class="heading"><b>Qty Mfg</b></td>
            <td bgcolor="#00DDFF"><span class="heading"><b>Est<br>Time</b></td>
            <td bgcolor="#00DDFF"><span class="heading"><b>Actual<br>Time</b></td>
            <td bgcolor="#00DDFF"><span class="heading"><b>Rej<br>Qty</b></td>
            <td bgcolor="#00DDFF"><span class="heading"><b>Rej<br>Time</b></td>
            <td bgcolor="#00DDFF" width=10%><span class="heading"><b>Lost or<br>Gained</b></td>
        </tr>



<?php
        $total_est_time = 0;
        $total_actual_time = 0;
        $total_rej_time = 0;
        $total_lossrgain_time = 0;
        $result = $newreport->gettime4prodn_eff_tab('VMC 70L',$cond);
        while ($myrow = mysql_fetch_row($result)) {
?>
           <tr>
              <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[1] ?></td>
              <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[2] ?></td>
              <td bgcolor="#FFFFFF"><span class="tabletext"><?php printf('%.2f', $myrow[3]) ?></td>
            <td bgcolor="#FFFFFF"><span class="tabletext"><?php printf("%.2f",($myrow[4]+$myrow[7]));
               $total_est_time += ($myrow[4]+$myrow[7]);
               ?></td>
              <td bgcolor="#FFFFFF"><span class="tabletext"><?php printf ("%.2f",($myrow[5]+$myrow[6]));
               $total_actual_time += ($myrow[5]+$myrow[6]);
               ?></td>
              <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo  $myrow[8] ?></td>
              <td bgcolor="#FFFFFF"><span class="tabletext">
              <?php
               if($myrow[8] != 0)
               {
                 $result4rejtime = $newreport->getmaster_rejtime4prodn_eff($myrow[1],$myrow[2],$myrow[8]);
                 $myrow4rejtime = mysql_fetch_row($result4rejtime);
                 $rej_time=$myrow4rejtime[2];
                 printf("%.2f", $rej_time);
                 $total_rej_time += $rej_time;
               }
               else
               {
                 $rej_time = 0;
                  printf("%.2f", $rej_time);
                 $total_rej_time += $rej_time;
               }
              ?>
              </td>
              <td bgcolor="#FFFFFF"><span class="tabletext">
              <?php
              printf("%.2f", (($myrow[4]+$myrow[7])-(($myrow[5]+$myrow[6]+$rej_time))));
               $total_lossrgain_time += (($myrow[4]+$myrow[7])-(($myrow[5]+$myrow[6]+$rej_time)));
              ?>
              </td>
            </tr>
<?php
         }
       unset($rej_time);
?>
<tr bgcolor="#FFFFFF">
 <td colspan=3 bgcolor="#FFFFFF" align="right"><span class="tabletext"><b>Total</b></td>
  <td bgcolor="#00DDFF"><span class="tabletext"><?php printf("%.2f", $total_est_time); ?></td>
 <td bgcolor="#00DDFF"><span class="tabletext"><?php printf("%.2f", $total_actual_time); ?></td>
  <td bgcolor="#00DDFF"><span class="tabletext">&nbsp;</td>
 <td bgcolor="#00DDFF"><span class="tabletext"><?php printf("%.2f", $total_rej_time); ?></td>
 <td bgcolor="#00DDFF"><span class="tabletext"><?php printf("%.2f", $total_lossrgain_time); ?></td>
</tr>
</table>
<div id="vmc700ldiv">
<table border=1 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3>
<tr bgcolor="#FFFFFF">
 <td colspan=3 bgcolor="#FFFFFF" align="right"><span class="tabletext"><b>Machine Utilization Efficiency</b></td>
 <td colspan=5 bgcolor="#99FFFF"><span class="tabletext"><?php
 $machine_eff = ($total_actual_time+$total_rej_time) != 0? ((($total_est_time)/($total_actual_time+$total_rej_time))*100):0;
 printf("%.2f",$machine_eff);
 echo '%';
 ?></td>
</tr>

        <tr bgcolor="#FFFFFF">
            <td colspan=4><span class="labeltext">F8400-S</td>
            <td colspan=2><span class="labeltext">Rev No:0 &nbsp Rev Date:8-1-2009</td>
            <td colspan=2><span class="labeltext"></td>
        </tr>

</table>
</div>
</div>
<table>
<tr>
<td id="chartvmc70l">
 <?php
      include_once 'ofc-library/open_flash_chart_object.php';
      $mc=urlencode('VMC 70L');
      //$wcond = htmlentities($cond);
      open_flash_chart_object( 1000, 350, 'https://'. $_SERVER['SERVER_NAME'] .'/wms/chart-prodneff1.php?mcname='.$mc.'&sdate='.$fromdate1.'&edate='.$todate1, false );
 ?>
</td>
</tr>
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
         <td width=40% bgcolor="#FFFFFF"><span class="labeltext"><b>From &nbsp&nbsp</b>
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
            onclick="javascript: getmc_eff('DMG 360L','dmg360ld','dmg360l','fdmg360l','tdmg360l')">
         </td>
        <td width=30% align="center" bgcolor="#00DDFF"><span class="heading"><b>DMG 360L</b></td>
        <td align="center" bgcolor="#FFFFFF">
        <input type= "image" name="Print" src="images/bu-print.gif" value="Get"
        onclick='javascript: openPrintWindow(new Array("chartdmg360l","dmg360ldiv"))'>
        </td>

		<td align="center" bgcolor="#FFFFFF">
        <input type= "image" name="Print" src="images/printchart.gif" value="Get"
        onclick='javascript: openPrintWindow(new Array("chartdmg360l","dmg3600ldiv"))'>
        </td>
<?php
       $cond = "op.st_date >= '$fromdate1' and op.st_date <= '$todate1'";
?>
        </tr>
          </table>
           <div id="dmg360ldiv">
     <table width=100% border=1 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
        <tr>
            <td bgcolor="#00DDFF" width=20%><span class="heading"><b>PRN</b></td>
            <td bgcolor="#00DDFF" width=10%><span class="heading"><b>Stage</b></td>
            <td bgcolor="#00DDFF" width=10%><span class="heading"><b>Qty Mfg</b></td>
            <td bgcolor="#00DDFF"><span class="heading"><b>Est<br>Time</b></td>
            <td bgcolor="#00DDFF"><span class="heading"><b>Actual<br>Time</b></td>
            <td bgcolor="#00DDFF"><span class="heading"><b>Rej<br>Qty</b></td>
            <td bgcolor="#00DDFF"><span class="heading"><b>Rej<br>Time</b></td>
            <td bgcolor="#00DDFF" width=10%><span class="heading"><b>Lost or<br>Gained</b></td>
        </tr>



<?php
        $total_est_time = 0;
        $total_actual_time = 0;
        $total_rej_time = 0;
        $total_lossrgain_time = 0;
        $result = $newreport->gettime4prodn_eff_tab('DMG 360L',$cond);
        while ($myrow = mysql_fetch_row($result)) {
?>
            <tr>
              <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[1] ?></td>
              <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[2] ?></td>
              <td bgcolor="#FFFFFF"><span class="tabletext"><?php printf('%.2f', $myrow[3]) ?></td>
             <td bgcolor="#FFFFFF"><span class="tabletext"><?php printf("%.2f",($myrow[4]+$myrow[7]));
               $total_est_time += ($myrow[4]+$myrow[7]);
               ?></td>
              <td bgcolor="#FFFFFF"><span class="tabletext"><?php printf ("%.2f",($myrow[5]+$myrow[6]));
               $total_actual_time += ($myrow[5]+$myrow[6]);
               ?></td>
              <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo  $myrow[8] ?></td>
              <td bgcolor="#FFFFFF"><span class="tabletext">
              <?php
               if($myrow[8] != 0)
               {
                 $result4rejtime = $newreport->getmaster_rejtime4prodn_eff($myrow[1],$myrow[2],$myrow[8]);
                 $myrow4rejtime = mysql_fetch_row($result4rejtime);
                 $rej_time=$myrow4rejtime[2];
                  printf("%.2f", $rej_time);
                 $total_rej_time += $rej_time;
               }
               else
               {
                 $rej_time = 0;
                  printf("%.2f", $rej_time);
                 $total_rej_time += $rej_time;
               }
              ?>
              </td>
              <td bgcolor="#FFFFFF"><span class="tabletext">
              <?php
              printf("%.2f", (($myrow[4]+$myrow[7])-(($myrow[5]+$myrow[6]+$rej_time))));
               $total_lossrgain_time += (($myrow[4]+$myrow[7])-(($myrow[5]+$myrow[6]+$rej_time)));
              ?>
              </td>
            </tr>
<?php
         }
       unset($rej_time);
?>
<tr bgcolor="#FFFFFF">
 <td colspan=3 bgcolor="#FFFFFF" align="right"><span class="tabletext"><b>Total</b></td>
 <td bgcolor="#00DDFF"><span class="tabletext"><?php printf("%.2f", $total_est_time); ?></td>
 <td bgcolor="#00DDFF"><span class="tabletext"><?php printf("%.2f", $total_actual_time); ?></td>
  <td bgcolor="#00DDFF"><span class="tabletext">&nbsp;</td>
 <td bgcolor="#00DDFF"><span class="tabletext"><?php printf("%.2f", $total_rej_time); ?></td>
 <td bgcolor="#00DDFF"><span class="tabletext"><?php printf("%.2f", $total_lossrgain_time); ?></td>
</tr>
</table>
<div id="dmg3600ldiv">
<table border=1 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3>
<tr bgcolor="#FFFFFF">
 <td colspan=3 bgcolor="#FFFFFF" align="right"><span class="tabletext"><b>Machine Utilization Efficiency</b></td>
 <td colspan=5 bgcolor="#99FFFF"><span class="tabletext"><?php
 $machine_eff = ($total_actual_time+$total_rej_time) != 0? ((($total_est_time)/($total_actual_time+$total_rej_time))*100):0;
 printf("%.2f",$machine_eff);
 echo '%';
 ?></td>
</tr>


        <tr bgcolor="#FFFFFF">
            <td colspan=4><span class="labeltext">F8400-S</td>
            <td colspan=2><span class="labeltext">Rev No:0 &nbsp Rev Date:8-1-2009</td>
            <td colspan=2><span class="labeltext"></td>
        </tr>

</table>
</div>
</div>
<table>
<tr>
<td id="chartdmg360l">
 <?php
      include_once 'ofc-library/open_flash_chart_object.php';
      $mc=urlencode('DMG 360L');
      //$wcond = htmlentities($cond);
      open_flash_chart_object( 1000, 350, 'https://'. $_SERVER['SERVER_NAME'] .'/wms/chart-prodneff1.php?mcname='.$mc.'&sdate='.$fromdate1.'&edate='.$todate1, false );
 ?>
</td>
</tr>
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
         <td width=40% bgcolor="#FFFFFF"><span class="labeltext"><b>From &nbsp&nbsp</b>
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
            onclick="javascript: getmc_eff('DX 200-1','dx2001d','dx2001','fdx2001','tdx2001')">
         </td>
        <td width=30% align="center" bgcolor="#00DDFF"><span class="heading"><b>DX 200-1</b></td>
        <td align="center" bgcolor="#FFFFFF">
        <input type= "image" name="Print" src="images/bu-print.gif" value="Get"
        onclick='javascript: openPrintWindow(new Array("chartdx2001","dx2001div"))'>
        </td>

		 <td align="center" bgcolor="#FFFFFF">
        <input type= "image" name="Print" src="images/printchart.gif" value="Get"
        onclick='javascript: openPrintWindow(new Array("chartdx2001","dx20001div"))'>
        </td>
<?php
        $cond = "op.st_date >= '$fromdate1' and op.st_date <= '$todate1'";
?>
        </tr>
          </table>
           <div id="dx2001div">
     <table width=100% border=1 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
        <tr>
            <td bgcolor="#00DDFF" width=20%><span class="heading"><b>PRN</b></td>
            <td bgcolor="#00DDFF" width=10%><span class="heading"><b>Stage</b></td>
            <td bgcolor="#00DDFF" width=10%><span class="heading"><b>Qty Mfg</b></td>
            <td bgcolor="#00DDFF"><span class="heading"><b>Est<br>Time</b></td>
            <td bgcolor="#00DDFF"><span class="heading"><b>Actual<br>Time</b></td>
            <td bgcolor="#00DDFF"><span class="heading"><b>Rej<br>Qty</b></td>
            <td bgcolor="#00DDFF"><span class="heading"><b>Rej<br>Time</b></td>
            <td bgcolor="#00DDFF" width=10%><span class="heading"><b>Lost or<br>Gained</b></td>
        </tr>

<?php
        $total_est_time = 0;
        $total_actual_time = 0;
        $total_rej_time = 0;
        $total_lossrgain_time = 0;
        $result = $newreport->gettime4prodn_eff_tab('DX 200-1',$cond);
        while ($myrow = mysql_fetch_row($result)) {
?>
          <tr>
              <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[1] ?></td>
              <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[2] ?></td>
              <td bgcolor="#FFFFFF"><span class="tabletext"><?php printf('%.2f', $myrow[3]) ?></td>
              <td bgcolor="#FFFFFF"><span class="tabletext"><?php printf("%.2f",($myrow[4]+$myrow[7]));
               $total_est_time += ($myrow[4]+$myrow[7]);
               ?></td>
             <td bgcolor="#FFFFFF"><span class="tabletext"><?php printf ("%.2f",($myrow[5]+$myrow[6]));
               $total_actual_time += ($myrow[5]+$myrow[6]);
               ?></td>
              <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo  $myrow[8] ?></td>
              <td bgcolor="#FFFFFF"><span class="tabletext">
              <?php
               if($myrow[8] != 0)
               {
                 $result4rejtime = $newreport->getmaster_rejtime4prodn_eff($myrow[1],$myrow[2],$myrow[8]);
                 $myrow4rejtime = mysql_fetch_row($result4rejtime);
                 $rej_time=$myrow4rejtime[2];
                 printf("%.2f", $rej_time);
                 $total_rej_time += $rej_time;
               }
               else
               {
                 $rej_time = 0;
                  printf("%.2f", $rej_time);
                 $total_rej_time += $rej_time;
               }
              ?>
              </td>
              <td bgcolor="#FFFFFF"><span class="tabletext">
              <?php
              printf("%.2f", (($myrow[4]+$myrow[7])-(($myrow[5]+$myrow[6]+$rej_time))));
               $total_lossrgain_time += (($myrow[4]+$myrow[7])-(($myrow[5]+$myrow[6]+$rej_time)));
              ?>
              </td>
            </tr>
<?php
         }
        unset($rej_time);
?>
<tr bgcolor="#FFFFFF">
 <td colspan=3 bgcolor="#FFFFFF" align="right"><span class="tabletext"><b>Total</b></td>
  <td bgcolor="#00DDFF"><span class="tabletext"><?php printf("%.2f", $total_est_time); ?></td>
 <td bgcolor="#00DDFF"><span class="tabletext"><?php printf("%.2f", $total_actual_time); ?></td>
  <td bgcolor="#00DDFF"><span class="tabletext">&nbsp;</td>
 <td bgcolor="#00DDFF"><span class="tabletext"><?php printf("%.2f", $total_rej_time); ?></td>
 <td bgcolor="#00DDFF"><span class="tabletext"><?php printf("%.2f", $total_lossrgain_time); ?></td>
</tr>
</table>
<div id="dx20001div">
<table border=1 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3>
<tr bgcolor="#FFFFFF">
 <td colspan=3 bgcolor="#FFFFFF" align="right"><span class="tabletext"><b>Machine Utilization Efficiency</b></td>
 <td colspan=5 bgcolor="#99FFFF"><span class="tabletext"><?php
 $machine_eff = ($total_actual_time+$total_rej_time) != 0? ((($total_est_time)/($total_actual_time+$total_rej_time))*100):0;
 printf("%.2f",$machine_eff);
 echo '%';
 ?></td>
</tr>


        <tr bgcolor="#FFFFFF">
            <td colspan=4><span class="labeltext">F8400-S</td>
            <td colspan=2><span class="labeltext">Rev No:0 &nbsp Rev Date:8-1-2009</td>
            <td colspan=2><span class="labeltext"></td>
        </tr>

</table>
</div>
</div>
<table>
<tr>
<td id="chartdx2001">
 <?php
      include_once 'ofc-library/open_flash_chart_object.php';
      $mc=urlencode('DX 200-1');
      //$wcond = htmlentities($cond);
      open_flash_chart_object( 1000, 350, 'https://'. $_SERVER['SERVER_NAME'] .'/wms/chart-prodneff1.php?mcname='.$mc.'&sdate='.$fromdate1.'&edate='.$todate1, false );
 ?>
</td>
</tr>
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
         <td width=40% bgcolor="#FFFFFF"><span class="labeltext"><b>From &nbsp&nbsp</b>
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
            onclick="javascript: getmc_eff('DX 200-2','dx2002d','dx2002','fdx2002','tdx2002')">
         </td>
        <td width=30% align="center" bgcolor="#00DDFF"><span class="heading"><b>DX 200-2</b></td>
        <td align="center" bgcolor="#FFFFFF">
        <input type= "image" name="Print" src="images/bu-print.gif" value="Get"
        onclick='javascript: openPrintWindow(new Array("chartdx2002","dx2002div"))'>
        </td>

		<td align="center" bgcolor="#FFFFFF">
        <input type= "image" name="Print" src="images/printchart.gif" value="Get"
        onclick='javascript: openPrintWindow(new Array("chartdx2002","dx20002div"))'>
        </td>
<?php
        $cond = "op.st_date >= '$fromdate1' and op.st_date <= '$todate1'";
?>
        </tr>
          </table>
           <div id="dx2002div">
     <table width=100% border=1 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
        <tr>
           <td bgcolor="#00DDFF" width=20%><span class="heading"><b>PRN</b></td>
           <td bgcolor="#00DDFF" width=10%><span class="heading"><b>Stage</b></td>
           <td bgcolor="#00DDFF" width=10%><span class="heading"><b>Qty Mfg</b></td>
           <td bgcolor="#00DDFF"><span class="heading"><b>Est<br>Time</b></td>
           <td bgcolor="#00DDFF"><span class="heading"><b>Actual<br>Time</b></td>
           <td bgcolor="#00DDFF"><span class="heading"><b>Rej<br>Qty</b></td>
           <td bgcolor="#00DDFF"><span class="heading"><b>Rej<br>Time</b></td>
           <td bgcolor="#00DDFF" width=10%><span class="heading"><b>Lost or<br>Gained</b></td>
        </tr>


<?php
        $total_est_time = 0;
        $total_actual_time = 0;
        $total_rej_time = 0;
        $total_lossrgain_time = 0;
        $result = $newreport->gettime4prodn_eff_tab('DX 200-2',$cond);
        while ($myrow = mysql_fetch_row($result)) {
?>
          <tr>
              <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[1] ?></td>
              <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[2] ?></td>
              <td bgcolor="#FFFFFF"><span class="tabletext"><?php printf('%.2f', $myrow[3]) ?></td>
             <td bgcolor="#FFFFFF"><span class="tabletext"><?php printf("%.2f",($myrow[4]+$myrow[7]));
               $total_est_time += ($myrow[4]+$myrow[7]);
               ?></td>
              <td bgcolor="#FFFFFF"><span class="tabletext"><?php printf ("%.2f",($myrow[5]+$myrow[6]));
               $total_actual_time += ($myrow[5]+$myrow[6]);
               ?></td>
              <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo  $myrow[8] ?></td>
              <td bgcolor="#FFFFFF"><span class="tabletext">
              <?php
               if($myrow[8] != 0)
               {
                 $result4rejtime = $newreport->getmaster_rejtime4prodn_eff($myrow[1],$myrow[2],$myrow[8]);
                 $myrow4rejtime = mysql_fetch_row($result4rejtime);
                 $rej_time=$myrow4rejtime[2];
                  printf("%.2f", $rej_time);
                 $total_rej_time += $rej_time;
               }
               else
               {
                 $rej_time = 0;
                  printf("%.2f", $rej_time);
                 $total_rej_time += $rej_time;
               }
              ?>
              </td>
              <td bgcolor="#FFFFFF"><span class="tabletext">
              <?php
              printf("%.2f", (($myrow[4]+$myrow[7])-(($myrow[5]+$myrow[6]+$rej_time))));
               $total_lossrgain_time += (($myrow[4]+$myrow[7])-(($myrow[5]+$myrow[6]+$rej_time)));
              ?>
              </td>
            </tr>
<?php
         }
        unset($rej_time);
?>
<tr bgcolor="#FFFFFF">
 <td colspan=3 bgcolor="#FFFFFF" align="right"><span class="tabletext"><b>Total</b></td>
  <td bgcolor="#00DDFF"><span class="tabletext"><?php printf("%.2f", $total_est_time); ?></td>
 <td bgcolor="#00DDFF"><span class="tabletext"><?php printf("%.2f", $total_actual_time); ?></td>
  <td bgcolor="#00DDFF"><span class="tabletext">&nbsp;</td>
 <td bgcolor="#00DDFF"><span class="tabletext"><?php printf("%.2f", $total_rej_time); ?></td>
 <td bgcolor="#00DDFF"><span class="tabletext"><?php printf("%.2f", $total_lossrgain_time); ?></td>
</tr>
</table>
<div id="dx20002div">
<table border=1 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3>
<tr bgcolor="#FFFFFF">
 <td colspan=3 bgcolor="#FFFFFF" align="right"><span class="tabletext"><b>Machine Utilization Efficiency</b></td>
 <td colspan=5 bgcolor="#99FFFF"><span class="tabletext"><?php
 $machine_eff = ($total_actual_time+$total_rej_time) != 0? ((($total_est_time)/($total_actual_time+$total_rej_time))*100):0;
 printf("%.2f",$machine_eff);
 echo '%';
 ?></td>
</tr>

        <tr bgcolor="#FFFFFF">
            <td colspan=4><span class="labeltext">F8400-S</td>
            <td colspan=2><span class="labeltext">Rev No:0 &nbsp Rev Date:8-1-2009</td>
            <td colspan=2><span class="labeltext"></td>
        </tr>

</table>
</div>
</div>
<table>
<tr>
<td id="chartdx2002">
 <?php
      include_once 'ofc-library/open_flash_chart_object.php';
      $mc=urlencode('DX 200-2');
      //$wcond = htmlentities($cond);
      open_flash_chart_object( 1000, 350, 'https://'. $_SERVER['SERVER_NAME'] .'/wms/chart-prodneff1.php?mcname='.$mc.'&sdate='.$fromdate1.'&edate='.$todate1, false );
 ?>
</td>
</tr>
</table>
<table border=1 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3>
        <tr bgcolor="#FFFFFF">
            <td colspan=4><span class="labeltext">F8400-S</td>
            <td colspan=2><span class="labeltext">Rev No:0 &nbsp Rev Date:8-1-2009</td>
            <td colspan=2><span class="labeltext"></td>
        </tr>

</table>
</div>
</td>
</tr>
<tr>
<td>
<div id='dx2003d'>
<table id='dx2003' width=100% border=1 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
        <tr>
         <td width=40% bgcolor="#FFFFFF"><span class="labeltext"><b>From &nbsp&nbsp</b>
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
            onclick="javascript: getmc_eff('DX 200-3','dx2003d','dx2003','fdx2003','tdx2003')">
         </td>
        <td width=30% align="center" bgcolor="#00DDFF"><span class="heading"><b>DX 200-3</b></td>
        <td align="center" bgcolor="#FFFFFF">
        <input type= "image" name="Print" src="images/bu-print.gif" value="Get"
        onclick='javascript: openPrintWindow(new Array("chartdx2003","dx2003div"))'>
        </td>

		<td align="center" bgcolor="#FFFFFF">
        <input type= "image" name="Print" src="images/printchart.gif" value="Get"
        onclick='javascript: openPrintWindow(new Array("chartdx2003","dx20003div"))'>
        </td>
<?php
        $cond = "op.st_date >= '$fromdate1' and op.st_date <= '$todate1'";
?>
        </tr>
          </table>
           <div id="dx2003div">
     <table width=100% border=1 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
        <tr>
            <td bgcolor="#00DDFF" width=20%><span class="heading"><b>PRN</b></td>
            <td bgcolor="#00DDFF" width=10%><span class="heading"><b>Stage</b></td>
            <td bgcolor="#00DDFF" width=10%><span class="heading"><b>Qty Mfg</b></td>
            <td bgcolor="#00DDFF"><span class="heading"><b>Est<br>Time</b></td>
            <td bgcolor="#00DDFF"><span class="heading"><b>Actual<br>Time</b></td>
            <td bgcolor="#00DDFF"><span class="heading"><b>Rej<br>Qty</b></td>
            <td bgcolor="#00DDFF"><span class="heading"><b>Rej<br>Time</b></td>
            <td bgcolor="#00DDFF" width=10%><span class="heading"><b>Lost or<br>Gained</b></td>
        </tr>


<?php
        $total_est_time = 0;
        $total_actual_time = 0;
        $total_rej_time = 0;
        $total_lossrgain_time = 0;
        $result = $newreport->gettime4prodn_eff_tab('DX 200-3',$cond);
        while ($myrow = mysql_fetch_row($result)) {
?>
           <tr>
              <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[1] ?></td>
              <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[2] ?></td>
              <td bgcolor="#FFFFFF"><span class="tabletext"><?php printf('%.2f', $myrow[3]) ?></td>
              <td bgcolor="#FFFFFF"><span class="tabletext"><?php printf("%.2f",($myrow[4]+$myrow[7]));
               $total_est_time += ($myrow[4]+$myrow[7]);
               ?></td>
             <td bgcolor="#FFFFFF"><span class="tabletext"><?php printf ("%.2f",($myrow[5]+$myrow[6]));
               $total_actual_time += ($myrow[5]+$myrow[6]);
               ?></td>
              <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo  $myrow[8] ?></td>
              <td bgcolor="#FFFFFF"><span class="tabletext">
              <?php
               if($myrow[8] != 0)
               {
                 $result4rejtime = $newreport->getmaster_rejtime4prodn_eff($myrow[1],$myrow[2],$myrow[8]);
                 $myrow4rejtime = mysql_fetch_row($result4rejtime);
                 $rej_time=$myrow4rejtime[2];
                 printf("%.2f", $rej_time);
                 $total_rej_time += $rej_time;
               }
               else
               {
                 $rej_time = 0;
                  printf("%.2f", $rej_time);
                 $total_rej_time += $rej_time;
               }
              ?>
              </td>
              <td bgcolor="#FFFFFF"><span class="tabletext">
              <?php
             printf("%.2f", (($myrow[4]+$myrow[7])-(($myrow[5]+$myrow[6]+$rej_time))));
               $total_lossrgain_time += (($myrow[4]+$myrow[7])-(($myrow[5]+$myrow[6]+$rej_time)));
              ?>
              </td>
            </tr>
<?php
         }
        unset($rej_time);
?>
<tr bgcolor="#FFFFFF">
 <td colspan=3 bgcolor="#FFFFFF" align="right"><span class="tabletext"><b>Total</b></td>
  <td bgcolor="#00DDFF"><span class="tabletext"><?php printf("%.2f", $total_est_time); ?></td>
 <td bgcolor="#00DDFF"><span class="tabletext"><?php printf("%.2f", $total_actual_time); ?></td>
  <td bgcolor="#00DDFF"><span class="tabletext">&nbsp;</td>
 <td bgcolor="#00DDFF"><span class="tabletext"><?php printf("%.2f", $total_rej_time); ?></td>
 <td bgcolor="#00DDFF"><span class="tabletext"><?php printf("%.2f", $total_lossrgain_time); ?></td>
</tr>
</table>
<div id="dx20003div">
<table border=1 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3>
<tr bgcolor="#FFFFFF">
 <td colspan=3 bgcolor="#FFFFFF" align="right"><span class="tabletext"><b>Machine Utilization Efficiency</b></td>
 <td colspan=5 bgcolor="#99FFFF"><span class="tabletext"><?php
 $machine_eff = ($total_actual_time+$total_rej_time) != 0? ((($total_est_time)/($total_actual_time+$total_rej_time))*100):0;
 printf("%.2f",$machine_eff);
 echo '%';
 ?></td>
</tr>
        <tr bgcolor="#FFFFFF">
            <td colspan=4><span class="labeltext">F8400-S</td>
            <td colspan=2><span class="labeltext">Rev No:0 &nbsp Rev Date:8-1-2009</td>
            <td colspan=2><span class="labeltext"></td>
        </tr>

</table>
</div>
</div>
<table>
<tr>
<td id="chartdx2003">
 <?php
      include_once 'ofc-library/open_flash_chart_object.php';
      $mc=urlencode('DX 200-3');
      //$wcond = htmlentities($cond);
      open_flash_chart_object( 1000, 350, 'https://'. $_SERVER['SERVER_NAME'] .'/wms/chart-prodneff1.php?mcname='.$mc.'&sdate='.$fromdate1.'&edate='.$todate1, false );
 ?>
</td>
</tr>
</table>
</div>
</td>
</tr>
<tr>
<td>
<div id='hmc440d'>
<table id='hmc440' width=100% border=1 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
        <tr>
         <td width=40% bgcolor="#FFFFFF"><span class="labeltext"><b>From &nbsp&nbsp</b>
         <input type="text" name="fhmc440" id="fhmc440" size=10 value="<?php echo $fromdate1 ?>"
          style="background-color:#DDDDDD;" readonly="readonly"
          onkeypress="javascript: return checkenter(event)">
         <img src="images/bu-getdateicon.gif" alt="Get Date" onclick='GetDate("fhmc440")'>
          <span class="labeltext"><b>&nbsp;&nbsp;To</b>
         <input type="text" name="thmc440" id="thmc440" size=10 value="<?php echo $todate1 ?>"
          style="background-color:#DDDDDD;" readonly="readonly"
          onkeypress="javascript: return checkenter(event)">
         <img src="images/bu-getdateicon.gif" alt="Get Date" onclick='GetDate("thmc440")'>
         <input type="image" name="Submit" src="images/bu-get.gif" value="Get"
            onclick="javascript: getmc_eff('HMC 440','hmc440d','hmc440','fhmc440','thmc440')">
         </td>
        <td width=30% align="center" bgcolor="#00DDFF"><span class="heading"><b>HMC 440</b></td>
        <td align="center" bgcolor="#FFFFFF">
        <input type= "image" name="Print" src="images/bu-print.gif" value="Get"
        onclick='javascript: openPrintWindow(new Array("charthmc440","hmc440div"))'>
        </td>

		<td align="center" bgcolor="#FFFFFF">
        <input type= "image" name="Print" src="images/printchart.gif" value="Get"
        onclick='javascript: openPrintWindow(new Array("charthmc440","hmc4400div"))'>
        </td>
<?php
        $cond = "op.st_date >= '$fromdate1' and op.st_date <= '$todate1'";
?>
        </tr>
          </table>
           <div id="hmc440div">
     <table width=100% border=1 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
        <tr>
            <td bgcolor="#00DDFF" width=20%><span class="heading"><b>PRN</b></td>
            <td bgcolor="#00DDFF" width=10%><span class="heading"><b>Stage</b></td>
            <td bgcolor="#00DDFF" width=10%><span class="heading"><b>Qty Mfg</b></td>
            <td bgcolor="#00DDFF"><span class="heading"><b>Est<br>Time</b></td>
            <td bgcolor="#00DDFF"><span class="heading"><b>Actual<br>Time</b></td>
            <td bgcolor="#00DDFF"><span class="heading"><b>Rej<br>Qty</b></td>
            <td bgcolor="#00DDFF"><span class="heading"><b>Rej<br>Time</b></td>
            <td bgcolor="#00DDFF" width=10%><span class="heading"><b>Lost or<br>Gained</b></td>
        </tr>


<?php
        $total_est_time = 0;
        $total_actual_time = 0;
        $total_rej_time = 0;
        $total_lossrgain_time = 0;
        $result = $newreport->gettime4prodn_eff_tab('HMC 440',$cond);
        while ($myrow = mysql_fetch_row($result)) {
?>
           <tr>
              <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[1] ?></td>
              <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[2] ?></td>
              <td bgcolor="#FFFFFF"><span class="tabletext"><?php printf('%.2f', $myrow[3]) ?></td>
              <td bgcolor="#FFFFFF"><span class="tabletext"><?php printf("%.2f",($myrow[4]+$myrow[7]));
               $total_est_time += ($myrow[4]+$myrow[7]);
               ?></td>
             <td bgcolor="#FFFFFF"><span class="tabletext"><?php printf ("%.2f",($myrow[5]+$myrow[6]));
               $total_actual_time += ($myrow[5]+$myrow[6]);
               ?></td>
              <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo  $myrow[8] ?></td>
              <td bgcolor="#FFFFFF"><span class="tabletext">
              <?php
               if($myrow[8] != 0)
               {
                 $result4rejtime = $newreport->getmaster_rejtime4prodn_eff($myrow[1],$myrow[2],$myrow[8]);
                 $myrow4rejtime = mysql_fetch_row($result4rejtime);
                 $rej_time=$myrow4rejtime[2];
                 printf("%.2f", $rej_time);
                 $total_rej_time += $rej_time;
               }
               else
               {
                 $rej_time = 0;
                  printf("%.2f", $rej_time);
                 $total_rej_time += $rej_time;
               }
              ?>
              </td>
              <td bgcolor="#FFFFFF"><span class="tabletext">
              <?php
             printf("%.2f", (($myrow[4]+$myrow[7])-(($myrow[5]+$myrow[6]+$rej_time))));
               $total_lossrgain_time += (($myrow[4]+$myrow[7])-(($myrow[5]+$myrow[6]+$rej_time)));
              ?>
              </td>
            </tr>
<?php
         }
        unset($rej_time);
?>
<tr bgcolor="#FFFFFF">
 <td colspan=3 bgcolor="#FFFFFF" align="right"><span class="tabletext"><b>Total</b></td>
  <td bgcolor="#00DDFF"><span class="tabletext"><?php printf("%.2f", $total_est_time); ?></td>
 <td bgcolor="#00DDFF"><span class="tabletext"><?php printf("%.2f", $total_actual_time); ?></td>
  <td bgcolor="#00DDFF"><span class="tabletext">&nbsp;</td>
 <td bgcolor="#00DDFF"><span class="tabletext"><?php printf("%.2f", $total_rej_time); ?></td>
 <td bgcolor="#00DDFF"><span class="tabletext"><?php printf("%.2f", $total_lossrgain_time); ?></td>
</tr>
</table>
<div id ="hmc4400div">
<table border=1 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3>
<tr bgcolor="#FFFFFF">
 <td colspan=3 bgcolor="#FFFFFF" align="right"><span class="tabletext"><b>Machine Utilization Efficiency</b></td>
 <td colspan=5 bgcolor="#99FFFF"><span class="tabletext"><?php
 $machine_eff = ($total_actual_time+$total_rej_time) != 0? ((($total_est_time)/($total_actual_time+$total_rej_time))*100):0;
 printf("%.2f",$machine_eff);
 echo '%';
 ?></td>
</tr>


        <tr bgcolor="#FFFFFF">
            <td colspan=4><span class="labeltext">F8400-S</td>
            <td colspan=2><span class="labeltext">Rev No:0 &nbsp Rev Date:8-1-2009</td>
            <td colspan=2><span class="labeltext"></td>
        </tr>

</table>
</div>
</div>
<table>
<tr>
<td id="charthmc440">
 <?php
      include_once 'ofc-library/open_flash_chart_object.php';
      $mc=urlencode('HMC 440');
      //$wcond = htmlentities($cond);
      open_flash_chart_object( 1000, 350, 'https://'. $_SERVER['SERVER_NAME'] .'/wms/chart-prodneff1.php?mcname='.$mc.'&sdate='.$fromdate1.'&edate='.$todate1, false );
 ?>
</td>
</tr>
</table>
</div>
</td>
</tr>
<tr>
<td>
<div id='haasd'>
<table id='haas' width=100% border=1 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
        <tr>
         <td width=40% bgcolor="#FFFFFF"><span class="labeltext"><b>From &nbsp&nbsp</b>
         <input type="text" id="fhaas" name="fhaas" size=10 value="<?php echo $fromdate1 ?>"
          style="background-color:#DDDDDD;" readonly="readonly"
          onkeypress="javascript: return checkenter(event)">
         <img src="images/bu-getdateicon.gif" alt="Get Date" onclick="GetDate('fhaas')">
          <span class="labeltext"><b>&nbsp;&nbsp;To</b>
         <input type="text" id="tbmv601" name="thaas" size=10 value="<?php echo $todate1 ?>"
          style="background-color:#DDDDDD;" readonly="readonly"
          onkeypress="javascript: return checkenter(event)">
         <img src="images/bu-getdateicon.gif" alt="Get Date" onclick="GetDate('thaas')">
         <input type="image" name="Submit" src="images/bu-get.gif" value="Get"
            onclick="javascript: getmc_eff('HAAS','haasd','haas','fhaas','thaas')">

         </td>
        <td width=30% align="center" bgcolor="#00DDFF"><span class="heading"><b>HAAS</b></td>
        <td align="center" bgcolor="#FFFFFF">
        <input type= "image" name="Print" src="images/bu-print.gif" value="Get"
onclick='javascript: openPrintWindow(new Array("charthaas","haasdiv"))'>
</td>

   <td align="center" bgcolor="#FFFFFF">
        <input type= "image" name="Print" src="images/printchart.gif" value="Get"
onclick='javascript: openPrintWindow(new Array("charthaas","haassdiv"))'>
</td>
<?php
        $cond = "op.st_date >= '$fromdate1' and op.st_date <= '$todate1'";
        $_SESSION['ccond'] = $cond;
?>
        </tr>
</table>
<div id="haasdiv">
<table width=100% border=1 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
<tr>
        <tr>
            <td bgcolor="#00DDFF" width=20%><span class="heading"><b>PRN</b></td>
            <td bgcolor="#00DDFF" width=10%><span class="heading"><b>Stage</b></td>
            <td bgcolor="#00DDFF" width=10%><span class="heading"><b>Qty Mfg</b></td>
            <td bgcolor="#00DDFF"><span class="heading"><b>Est<br>Time</b></td>
            <td bgcolor="#00DDFF"><span class="heading"><b>Actual<br>Time</b></td>
            <td bgcolor="#00DDFF"><span class="heading"><b>Rej<br>Qty</b></td>
            <td bgcolor="#00DDFF"><span class="heading"><b>Rej<br>Time</b></td>
            <td bgcolor="#00DDFF" width=10%><span class="heading"><b>Lost or<br>Gained</b></td>
        </tr>



<?php
        $total_est_time = 0;
        $total_actual_time = 0;
        $total_rej_time = 0;
        $total_lossrgain_time = 0;
        $result = $newreport->gettime4prodn_eff_tab('HAAS',$cond);
        
        while ($myrow = mysql_fetch_row($result)) {

?>
            <tr>
              <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[1];
               $crn[]= $myrow[1];
               ?></td>
              <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[2] ?></td>
              <td bgcolor="#FFFFFF"><span class="tabletext"><?php printf('%.2f', $myrow[3]) ?></td>
              <td bgcolor="#FFFFFF"><span class="tabletext"><?php printf ("%.2f",($myrow[4]+$myrow[7]));
               $total_est_time += ($myrow[4]+$myrow[7]);
               $esttime[]= ($myrow[4]+$myrow[7]);
               ?></td>
              <td bgcolor="#FFFFFF"><span class="tabletext"><?php printf ("%.2f",($myrow[5]+$myrow[6]));
               $total_actual_time += ($myrow[5]+$myrow[6]);
               $actualtime[]= ($myrow[5]+$myrow[6])
               ?></td>
              <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo  $myrow[8] ?></td>
              <td bgcolor="#FFFFFF"><span class="tabletext">
              <?php
               if($myrow[8] != 0)
               {
                 $result4rejtime = $newreport->getmaster_rejtime4prodn_eff($myrow[1],$myrow[2],$myrow[8]);
                 $myrow4rejtime = mysql_fetch_row($result4rejtime);
                 $rej_time=$myrow4rejtime[2];
                 printf("%.2f", $rej_time);
                 $total_rej_time += $rej_time;
               }
               else
               {
                 $rej_time = 0;
                 printf("%.2f",$rej_time);
                 $total_rej_time += $rej_time;
               }
              ?>
              </td>
              <td bgcolor="#FFFFFF"><span class="tabletext">
              <?php
               printf("%.2f", (($myrow[4]+$myrow[7])-(($myrow[5]+$myrow[6]+$rej_time))));
               $total_lossrgain_time += (($myrow[4]+$myrow[7])-(($myrow[5]+$myrow[6]+$rej_time)));
               $lossrgain[]=(($myrow[4]+$myrow[7])-(($myrow[5]+$myrow[6]+$rej_time)));
              ?>
              </td>
            </tr>
<?php
         }
       unset($rej_time);
       
?>
<tr bgcolor="#FFFFFF">
 <td colspan=3 bgcolor="#FFFFFF" align="right"><span class="tabletext"><b>Total</b></td>
  <td bgcolor="#00DDFF"><span class="tabletext"><?php printf("%.2f", $total_est_time); ?></td>
 <td bgcolor="#00DDFF"><span class="tabletext"><?php printf("%.2f", $total_actual_time); ?></td>
  <td bgcolor="#00DDFF"><span class="tabletext">&nbsp;</td>
 <td bgcolor="#00DDFF"><span class="tabletext"><?php printf("%.2f", $total_rej_time); ?></td>
 <td bgcolor="#00DDFF"><span class="tabletext"><?php printf("%.2f", $total_lossrgain_time); ?></td>
</tr>
</table>
<div id ='haassdiv'>
<table border=1 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3>
<tr bgcolor="#FFFFFF">
 <td colspan=3 bgcolor="#FFFFFF" align="right"><span class="tabletext"><b>Machine Utilization Efficiency</b></td>
 <td colspan=5 bgcolor="#99FFFF"><span class="tabletext"><?php
 $machine_eff = ($total_actual_time+$total_rej_time) != 0? ((($total_est_time)/($total_actual_time+$total_rej_time))*100):0;
 printf("%.2f",$machine_eff);
 echo '%';
 ?></td>
</tr>

        <tr bgcolor="#FFFFFF">
            <td colspan=4><span class="labeltext">F8400-S</td>
            <td colspan=2><span class="labeltext">Rev No:0 &nbsp Rev Date:8-1-2009</td>
            <td colspan=2><span class="labeltext"></td>
        </tr>

</table>
</div>
</div>
<table>
<tr>
<td id="charthaas">
 <?php
      include_once 'ofc-library/open_flash_chart_object.php';
      $mc=urlencode('HAAS');
      //$wcond = htmlentities($cond);
      open_flash_chart_object( 1000, 350, 'https://'. $_SERVER['SERVER_NAME'] .'/wms/chart-prodneff1.php?mcname='.$mc.'&sdate='.$fromdate1.'&edate='.$todate1, false );
      //open_flash_chart_object( 1000, 350, 'https://'. $_SERVER['SERVER_NAME'] .'/wms_bk_jan5/gallerydata.php', false );

 ?>
</td>
</table>
</tr>
</div>
</td></tr>
<tr>
<td>
<div id='makinof3d'>
<table id='makinof3' width=100% border=1 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
        <tr>
         <td width=40% bgcolor="#FFFFFF"><span class="labeltext"><b>From &nbsp&nbsp</b>
         <input type="text" id="fmakinof3" name="fmakinof3" size=10 value="<?php echo $fromdate1 ?>"
          style="background-color:#DDDDDD;" readonly="readonly"
          onkeypress="javascript: return checkenter(event)">
         <img src="images/bu-getdateicon.gif" alt="Get Date" onclick="GetDate('fmakinof3')">
          <span class="labeltext"><b>&nbsp;&nbsp;To</b>
         <input type="text" id="tmakinof3" name="tmakinof3" size=10 value="<?php echo $todate1 ?>"
          style="background-color:#DDDDDD;" readonly="readonly"
          onkeypress="javascript: return checkenter(event)">
         <img src="images/bu-getdateicon.gif" alt="Get Date" onclick="GetDate('tmakinof3')">
         <input type="image" name="Submit" src="images/bu-get.gif" value="Get"
            onclick="javascript: getmc_eff('MakinoF3','makinof3d','makinof3','fmakinof3','tmakinof3')">

         </td>
        <td width=30% align="center" bgcolor="#00DDFF"><span class="heading"><b>Makino F3</b></td>
        <td align="center" bgcolor="#FFFFFF">
        <input type= "image" name="Print" src="images/bu-print.gif" value="Get"
onclick='javascript: openPrintWindow(new Array("chartmakinof3","makinof3div"))'>
</td>

   <td align="center" bgcolor="#FFFFFF">
        <input type= "image" name="Print" src="images/printchart.gif" value="Get"
onclick='javascript: openPrintWindow(new Array("chartmakinof3","makino3div"))'>
</td>
<?php
        $cond = "op.st_date >= '$fromdate1' and op.st_date <= '$todate1'";
        $_SESSION['ccond'] = $cond;
?>
        </tr>
</table>
<div id="makinof3div">
<table width=100% border=1 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
<tr>
        <tr>
            <td bgcolor="#00DDFF" width=20%><span class="heading"><b>PRN</b></td>
            <td bgcolor="#00DDFF" width=10%><span class="heading"><b>Stage</b></td>
            <td bgcolor="#00DDFF" width=10%><span class="heading"><b>Qty Mfg</b></td>
            <td bgcolor="#00DDFF"><span class="heading"><b>Est<br>Time</b></td>
            <td bgcolor="#00DDFF"><span class="heading"><b>Actual<br>Time</b></td>
            <td bgcolor="#00DDFF"><span class="heading"><b>Rej<br>Qty</b></td>
            <td bgcolor="#00DDFF"><span class="heading"><b>Rej<br>Time</b></td>
            <td bgcolor="#00DDFF" width=10%><span class="heading"><b>Lost or<br>Gained</b></td>
        </tr>



<?php
        $total_est_time = 0;
        $total_actual_time = 0;
        $total_rej_time = 0;
        $total_lossrgain_time = 0;
        $result = $newreport->gettime4prodn_eff_tab('MakinoF3',$cond);

        while ($myrow = mysql_fetch_row($result)) {

?>
            <tr>
              <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[1];
               $crn[]= $myrow[1];
               ?></td>
              <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[2] ?></td>
              <td bgcolor="#FFFFFF"><span class="tabletext"><?php printf('%.2f', $myrow[3]) ?></td>
              <td bgcolor="#FFFFFF"><span class="tabletext"><?php printf ("%.2f",($myrow[4]+$myrow[7]));
               $total_est_time += ($myrow[4]+$myrow[7]);
               $esttime[]= ($myrow[4]+$myrow[7]);
               ?></td>
              <td bgcolor="#FFFFFF"><span class="tabletext"><?php printf ("%.2f",($myrow[5]+$myrow[6]));
               $total_actual_time += ($myrow[5]+$myrow[6]);
               $actualtime[]= ($myrow[5]+$myrow[6]);
               ?></td>
              <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo  $myrow[8] ?></td>
              <td bgcolor="#FFFFFF"><span class="tabletext">
              <?php
               if($myrow[8] != 0)
               {
                 $result4rejtime = $newreport->getmaster_rejtime4prodn_eff($myrow[1],$myrow[2],$myrow[8]);
                 $myrow4rejtime = mysql_fetch_row($result4rejtime);
                 $rej_time=$myrow4rejtime[2];
                 printf("%.2f", $rej_time);
                 $total_rej_time += $rej_time;
               }
               else
               {
                 $rej_time = 0;
                 printf("%.2f",$rej_time);
                 $total_rej_time += $rej_time;
               }
              ?>
              </td>
              <td bgcolor="#FFFFFF"><span class="tabletext">
              <?php
               printf("%.2f", (($myrow[4]+$myrow[7])-(($myrow[5]+$myrow[6]+$rej_time))));
               $total_lossrgain_time += (($myrow[4]+$myrow[7])-(($myrow[5]+$myrow[6]+$rej_time)));
               $lossrgain[]=(($myrow[4]+$myrow[7])-(($myrow[5]+$myrow[6]+$rej_time)));
              ?>
              </td>
            </tr>
<?php
         }
       unset($rej_time);

?>
<tr bgcolor="#FFFFFF">
 <td colspan=3 bgcolor="#FFFFFF" align="right"><span class="tabletext"><b>Total</b></td>
  <td bgcolor="#00DDFF"><span class="tabletext"><?php printf("%.2f", $total_est_time); ?></td>
 <td bgcolor="#00DDFF"><span class="tabletext"><?php printf("%.2f", $total_actual_time); ?></td>
  <td bgcolor="#00DDFF"><span class="tabletext">&nbsp;</td>
 <td bgcolor="#00DDFF"><span class="tabletext"><?php printf("%.2f", $total_rej_time); ?></td>
 <td bgcolor="#00DDFF"><span class="tabletext"><?php printf("%.2f", $total_lossrgain_time); ?></td>
</tr>
</table>
<div id ='makino3div'>
<table border=1 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3>
<tr bgcolor="#FFFFFF">
 <td colspan=3 bgcolor="#FFFFFF" align="right"><span class="tabletext"><b>Machine Utilization Efficiency</b></td>
 <td colspan=5 bgcolor="#99FFFF"><span class="tabletext"><?php
 $machine_eff = ($total_actual_time+$total_rej_time) != 0? ((($total_est_time)/($total_actual_time+$total_rej_time))*100):0;
 printf("%.2f",$machine_eff);
 echo '%';
 ?></td>
</tr>

        <tr bgcolor="#FFFFFF">
            <td colspan=4><span class="labeltext">F8400-S</td>
            <td colspan=2><span class="labeltext">Rev No:0 &nbsp Rev Date:8-1-2009</td>
            <td colspan=2><span class="labeltext"></td>
        </tr>

</table>
</div>
</div>
<table>
<tr>
<td id="chartmakinof3">
 <?php
      include_once 'ofc-library/open_flash_chart_object.php';
      $mc=urlencode('MakinoF3');
      //$wcond = htmlentities($cond);
      open_flash_chart_object( 1000, 350, 'https://'. $_SERVER['SERVER_NAME'] .'/wms/chart-prodneff1.php?mcname='.$mc.'&sdate='.$fromdate1.'&edate='.$todate1, false );
      //open_flash_chart_object( 1000, 350, 'http://'. $_SERVER['SERVER_NAME'] .'/wms_bk_jan5/gallerydata.php', false );

 ?>
</td>
</table>
</tr>
</div>
</td></tr>
<tr>
<td>
<div id='makinod'>
<table id='makino' width=100% border=1 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
        <tr>
         <td width=40% bgcolor="#FFFFFF"><span class="labeltext"><b>From &nbsp&nbsp</b>
         <input type="text" id="fmakino" name="fmakino" size=10 value="<?php echo $fromdate1 ?>"
          style="background-color:#DDDDDD;" readonly="readonly"
          onkeypress="javascript: return checkenter(event)">
         <img src="images/bu-getdateicon.gif" alt="Get Date" onclick="GetDate('fmakino')">
          <span class="labeltext"><b>&nbsp;&nbsp;To</b>
         <input type="text" id="tmakino" name="tmakino" size=10 value="<?php echo $todate1 ?>"
          style="background-color:#DDDDDD;" readonly="readonly"
          onkeypress="javascript: return checkenter(event)">
         <img src="images/bu-getdateicon.gif" alt="Get Date" onclick="GetDate('tmakino')">
         <input type="image" name="Submit" src="images/bu-get.gif" value="Get"
            onclick="javascript: getmc_eff('MakinoF5','makinod','makino','fmakino','tmakino')">

         </td>
        <td width=30% align="center" bgcolor="#00DDFF"><span class="heading"><b>Makino F5</b></td>
        <td align="center" bgcolor="#FFFFFF">
        <input type= "image" name="Print" src="images/bu-print.gif" value="Get"
onclick='javascript: openPrintWindow(new Array("chartmakino","makinof5div"))'>
</td>

   <td align="center" bgcolor="#FFFFFF">
        <input type= "image" name="Print" src="images/printchart.gif" value="Get"
onclick='javascript: openPrintWindow(new Array("chartmakino","makinodiv"))'>
</td>
<?php
        $cond = "op.st_date >= '$fromdate1' and op.st_date <= '$todate1'";
        $_SESSION['ccond'] = $cond;
?>
        </tr>
</table>
<div id="makinof5div">
<table width=100% border=1 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
<tr>
        <tr>
            <td bgcolor="#00DDFF" width=20%><span class="heading"><b>PRN</b></td>
            <td bgcolor="#00DDFF" width=10%><span class="heading"><b>Stage</b></td>
            <td bgcolor="#00DDFF" width=10%><span class="heading"><b>Qty Mfg</b></td>
            <td bgcolor="#00DDFF"><span class="heading"><b>Est<br>Time</b></td>
            <td bgcolor="#00DDFF"><span class="heading"><b>Actual<br>Time</b></td>
            <td bgcolor="#00DDFF"><span class="heading"><b>Rej<br>Qty</b></td>
            <td bgcolor="#00DDFF"><span class="heading"><b>Rej<br>Time</b></td>
            <td bgcolor="#00DDFF" width=10%><span class="heading"><b>Lost or<br>Gained</b></td>
        </tr>



<?php
        $total_est_time = 0;
        $total_actual_time = 0;
        $total_rej_time = 0;
        $total_lossrgain_time = 0;
        $result = $newreport->gettime4prodn_eff_tab('MakinoF5',$cond);

        while ($myrow = mysql_fetch_row($result)) {

?>
            <tr>
              <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[1];
               $crn[]= $myrow[1];
               ?></td>
              <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[2] ?></td>
              <td bgcolor="#FFFFFF"><span class="tabletext"><?php printf('%.2f', $myrow[3]) ?></td>
              <td bgcolor="#FFFFFF"><span class="tabletext"><?php printf ("%.2f",($myrow[4]+$myrow[7]));
               $total_est_time += ($myrow[4]+$myrow[7]);
               $esttime[]= ($myrow[4]+$myrow[7]);
               ?></td>
              <td bgcolor="#FFFFFF"><span class="tabletext"><?php printf ("%.2f",($myrow[5]+$myrow[6]));
               $total_actual_time += ($myrow[5]+$myrow[6]);
               $actualtime[]= ($myrow[5]+$myrow[6])
               ?></td>
              <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo  $myrow[8] ?></td>
              <td bgcolor="#FFFFFF"><span class="tabletext">
              <?php
               if($myrow[8] != 0)
               {
                 $result4rejtime = $newreport->getmaster_rejtime4prodn_eff($myrow[1],$myrow[2],$myrow[8]);
                 $myrow4rejtime = mysql_fetch_row($result4rejtime);
                 $rej_time=$myrow4rejtime[2];
                 printf("%.2f", $rej_time);
                 $total_rej_time += $rej_time;
               }
               else
               {
                 $rej_time = 0;
                 printf("%.2f",$rej_time);
                 $total_rej_time += $rej_time;
               }
              ?>
              </td>
              <td bgcolor="#FFFFFF"><span class="tabletext">
              <?php
               printf("%.2f", (($myrow[4]+$myrow[7])-(($myrow[5]+$myrow[6]+$rej_time))));
               $total_lossrgain_time += (($myrow[4]+$myrow[7])-(($myrow[5]+$myrow[6]+$rej_time)));
               $lossrgain[]=(($myrow[4]+$myrow[7])-(($myrow[5]+$myrow[6]+$rej_time)));
              ?>
              </td>
            </tr>
<?php
         }
       unset($rej_time);

?>
<tr bgcolor="#FFFFFF">
 <td colspan=3 bgcolor="#FFFFFF" align="right"><span class="tabletext"><b>Total</b></td>
  <td bgcolor="#00DDFF"><span class="tabletext"><?php printf("%.2f", $total_est_time); ?></td>
 <td bgcolor="#00DDFF"><span class="tabletext"><?php printf("%.2f", $total_actual_time); ?></td>
  <td bgcolor="#00DDFF"><span class="tabletext">&nbsp;</td>
 <td bgcolor="#00DDFF"><span class="tabletext"><?php printf("%.2f", $total_rej_time); ?></td>
 <td bgcolor="#00DDFF"><span class="tabletext"><?php printf("%.2f", $total_lossrgain_time); ?></td>
</tr>
</table>
<div id ='makinodiv'>
<table border=1 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3>
<tr bgcolor="#FFFFFF">
 <td colspan=3 bgcolor="#FFFFFF" align="right"><span class="tabletext"><b>Machine Utilization Efficiency</b></td>
 <td colspan=5 bgcolor="#99FFFF"><span class="tabletext"><?php
 $machine_eff = ($total_actual_time+$total_rej_time) != 0? ((($total_est_time)/($total_actual_time+$total_rej_time))*100):0;
 printf("%.2f",$machine_eff);
 echo '%';
 ?></td>
</tr>

        <tr bgcolor="#FFFFFF">
            <td colspan=4><span class="labeltext">F8400-S</td>
            <td colspan=2><span class="labeltext">Rev No:0 &nbsp Rev Date:8-1-2009</td>
            <td colspan=2><span class="labeltext"></td>
        </tr>

</table>
</div>
</div>
<table>
<tr>
<td id="chartmakino">
 <?php
      include_once 'ofc-library/open_flash_chart_object.php';
      $mc=urlencode('MakinoF5');
      //$wcond = htmlentities($cond);
      open_flash_chart_object( 1000, 350, 'https://'. $_SERVER['SERVER_NAME'] .'/wms/chart-prodneff1.php?mcname='.$mc.'&sdate='.$fromdate1.'&edate='.$todate1, false );
      //open_flash_chart_object( 1000, 350, 'http://'. $_SERVER['SERVER_NAME'] .'/wms_bk_jan5/gallerydata.php', false );

 ?>
</td>
</table>
</tr>
</div>
</td></tr>
<tr>
<td>
<div id='haasvfd'>
<table id='haasvf' width=100% border=1 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
        <tr>
         <td width=40% bgcolor="#FFFFFF"><span class="labeltext"><b>From &nbsp&nbsp</b>
         <input type="text" id="fhaasvf" name="fhaasvf" size=10 value="<?php echo $fromdate1 ?>"
          style="background-color:#DDDDDD;" readonly="readonly"
          onkeypress="javascript: return checkenter(event)">
         <img src="images/bu-getdateicon.gif" alt="Get Date" onclick="GetDate('fhaasvf')">
          <span class="labeltext"><b>&nbsp;&nbsp;To</b>
         <input type="text" id="thaasvf" name="thaasvf" size=10 value="<?php echo $todate1 ?>"
          style="background-color:#DDDDDD;" readonly="readonly"
          onkeypress="javascript: return checkenter(event)">
         <img src="images/bu-getdateicon.gif" alt="Get Date" onclick="GetDate('thaasvf')">
         <input type="image" name="Submit" src="images/bu-get.gif" value="Get"
            onclick="javascript: getmc_eff('HAASVF2SS','haasvfd','haasvf','fhaasvf','thaasvf')">

         </td>
        <td width=30% align="center" bgcolor="#00DDFF"><span class="heading"><b>HAASVF2SS</b></td>
        <td align="center" bgcolor="#FFFFFF">
        <input type= "image" name="Print" src="images/bu-print.gif" value="Get"
onclick='javascript: openPrintWindow(new Array("charthaasvf","haasvfdiv"))'>
</td>

   <td align="center" bgcolor="#FFFFFF">
        <input type= "image" name="Print" src="images/printchart.gif" value="Get"
onclick='javascript: openPrintWindow(new Array("charthaasvf","haasvf2SSdiv"))'>
</td>
<?php
        $cond = "op.st_date >= '$fromdate1' and op.st_date <= '$todate1'";
        $_SESSION['ccond'] = $cond;
?>
        </tr>
</table>
<div id="haasvfdiv">
<table width=100% border=1 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
<tr>
        <tr>
            <td bgcolor="#00DDFF" width=20%><span class="heading"><b>PRN</b></td>
            <td bgcolor="#00DDFF" width=10%><span class="heading"><b>Stage</b></td>
            <td bgcolor="#00DDFF" width=10%><span class="heading"><b>Qty Mfg</b></td>
            <td bgcolor="#00DDFF"><span class="heading"><b>Est<br>Time</b></td>
            <td bgcolor="#00DDFF"><span class="heading"><b>Actual<br>Time</b></td>
            <td bgcolor="#00DDFF"><span class="heading"><b>Rej<br>Qty</b></td>
            <td bgcolor="#00DDFF"><span class="heading"><b>Rej<br>Time</b></td>
            <td bgcolor="#00DDFF" width=10%><span class="heading"><b>Lost or<br>Gained</b></td>
        </tr>



<?php
        $total_est_time = 0;
        $total_actual_time = 0;
        $total_rej_time = 0;
        $total_lossrgain_time = 0;
        $result = $newreport->gettime4prodn_eff_tab('HAASVF2SS',$cond);

        while ($myrow = mysql_fetch_row($result)) {

?>
            <tr>
              <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[1];
               $crn[]= $myrow[1];
               ?></td>
              <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[2] ?></td>
              <td bgcolor="#FFFFFF"><span class="tabletext"><?php printf('%.2f', $myrow[3]) ?></td>
              <td bgcolor="#FFFFFF"><span class="tabletext"><?php printf ("%.2f",($myrow[4]+$myrow[7]));
               $total_est_time += ($myrow[4]+$myrow[7]);
               $esttime[]= ($myrow[4]+$myrow[7]);
               ?></td>
              <td bgcolor="#FFFFFF"><span class="tabletext"><?php printf ("%.2f",($myrow[5]+$myrow[6]));
               $total_actual_time += ($myrow[5]+$myrow[6]);
               $actualtime[]= ($myrow[5]+$myrow[6])
               ?></td>
              <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo  $myrow[8] ?></td>
              <td bgcolor="#FFFFFF"><span class="tabletext">
              <?php
               if($myrow[8] != 0)
               {
                 $result4rejtime = $newreport->getmaster_rejtime4prodn_eff($myrow[1],$myrow[2],$myrow[8]);
                 $myrow4rejtime = mysql_fetch_row($result4rejtime);
                 $rej_time=$myrow4rejtime[2];
                 printf("%.2f", $rej_time);
                 $total_rej_time += $rej_time;
               }
               else
               {
                 $rej_time = 0;
                 printf("%.2f",$rej_time);
                 $total_rej_time += $rej_time;
               }
              ?>
              </td>
              <td bgcolor="#FFFFFF"><span class="tabletext">
              <?php
               printf("%.2f", (($myrow[4]+$myrow[7])-(($myrow[5]+$myrow[6]+$rej_time))));
               $total_lossrgain_time += (($myrow[4]+$myrow[7])-(($myrow[5]+$myrow[6]+$rej_time)));
               $lossrgain[]=(($myrow[4]+$myrow[7])-(($myrow[5]+$myrow[6]+$rej_time)));
              ?>
              </td>
            </tr>
<?php
         }
       unset($rej_time);

?>
<tr bgcolor="#FFFFFF">
 <td colspan=3 bgcolor="#FFFFFF" align="right"><span class="tabletext"><b>Total</b></td>
  <td bgcolor="#00DDFF"><span class="tabletext"><?php printf("%.2f", $total_est_time); ?></td>
 <td bgcolor="#00DDFF"><span class="tabletext"><?php printf("%.2f", $total_actual_time); ?></td>
  <td bgcolor="#00DDFF"><span class="tabletext">&nbsp;</td>
 <td bgcolor="#00DDFF"><span class="tabletext"><?php printf("%.2f", $total_rej_time); ?></td>
 <td bgcolor="#00DDFF"><span class="tabletext"><?php printf("%.2f", $total_lossrgain_time); ?></td>
</tr>
</table>
<div id ='haasvf2SSdiv'>
<table border=1 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3>
<tr bgcolor="#FFFFFF">
 <td colspan=3 bgcolor="#FFFFFF" align="right"><span class="tabletext"><b>Machine Utilization Efficiency</b></td>
 <td colspan=5 bgcolor="#99FFFF"><span class="tabletext"><?php
 $machine_eff = ($total_actual_time+$total_rej_time) != 0? ((($total_est_time)/($total_actual_time+$total_rej_time))*100):0;
 printf("%.2f",$machine_eff);
 echo '%';
 ?></td>
</tr>

        <tr bgcolor="#FFFFFF">
            <td colspan=4><span class="labeltext">F8400-S</td>
            <td colspan=2><span class="labeltext">Rev No:0 &nbsp Rev Date:8-1-2009</td>
            <td colspan=2><span class="labeltext"></td>
        </tr>

</table>
</div>
</div>
<table>
<tr>
<td id="charthaasvf">
 <?php
      include_once 'ofc-library/open_flash_chart_object.php';
      $mc=urlencode('HAASVF255');
      //$wcond = htmlentities($cond);
      open_flash_chart_object( 1000, 350, 'https://'. $_SERVER['SERVER_NAME'] .'/wms/chart-prodneff1.php?mcname='.$mc.'&sdate='.$fromdate1.'&edate='.$todate1, false );
      //open_flash_chart_object( 1000, 350, 'http://'. $_SERVER['SERVER_NAME'] .'/wms_bk_jan5/gallerydata.php', false );

 ?>
</td>
</table>
</tr>
</div>
</td></tr>
<tr><td>&nbsp;</td></tr>
</td></tr>
<tr>
<td>
<div id='haasvf2ss2d'>
<table id='haasvf2ss2' width=100% border=1 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
        <tr>
         <td width=40% bgcolor="#FFFFFF"><span class="labeltext"><b>From &nbsp&nbsp</b>
         <input type="text" id="fhaasvf2ss2" name="fhaasvf2ss2" size=10 value="<?php echo $fromdate1 ?>"
          style="background-color:#DDDDDD;" readonly="readonly"
          onkeypress="javascript: return checkenter(event)">
         <img src="images/bu-getdateicon.gif" alt="Get Date" onclick="GetDate('fhaasvf2ss2')">
          <span class="labeltext"><b>&nbsp;&nbsp;To</b>
         <input type="text" id="thaasvf2ss2" name="thaasvf2ss2" size=10 value="<?php echo $todate1 ?>"
          style="background-color:#DDDDDD;" readonly="readonly"
          onkeypress="javascript: return checkenter(event)">
         <img src="images/bu-getdateicon.gif" alt="Get Date" onclick="GetDate('thaasvf2ss2')">
         <input type="image" name="Submit" src="images/bu-get.gif" value="Get"
            onclick="javascript: getmc_eff('HAASVF2SS-2','haasvf2ss2d','haasvf2ss2','fhaasvf2ss2','thaasvf2ss2')">

         </td>
        <td width=30% align="center" bgcolor="#00DDFF"><span class="heading"><b>HAASVF2SS-2</b></td>
        <td align="center" bgcolor="#FFFFFF">
        <input type= "image" name="Print" src="images/bu-print.gif" value="Get"
onclick='javascript: openPrintWindow(new Array("charthaasvf2ss2","haasvf2ss2div"))'>
</td>

   <td align="center" bgcolor="#FFFFFF">
        <input type= "image" name="Print" src="images/printchart.gif" value="Get"
onclick='javascript: openPrintWindow(new Array("charthaasvf2ss2","haasvf2ss2div"))'>
</td>
<?php
        $cond = "op.st_date >= '$fromdate1' and op.st_date <= '$todate1'";
        $_SESSION['ccond'] = $cond;
?>
        </tr>
</table>
<div id="haasvf2ss2div">
<table width=100% border=1 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
<tr>
        <tr>
            <td bgcolor="#00DDFF" width=20%><span class="heading"><b>PRN</b></td>
            <td bgcolor="#00DDFF" width=10%><span class="heading"><b>Stage</b></td>
            <td bgcolor="#00DDFF" width=10%><span class="heading"><b>Qty Mfg</b></td>
            <td bgcolor="#00DDFF"><span class="heading"><b>Est<br>Time</b></td>
            <td bgcolor="#00DDFF"><span class="heading"><b>Actual<br>Time</b></td>
            <td bgcolor="#00DDFF"><span class="heading"><b>Rej<br>Qty</b></td>
            <td bgcolor="#00DDFF"><span class="heading"><b>Rej<br>Time</b></td>
            <td bgcolor="#00DDFF" width=10%><span class="heading"><b>Lost or<br>Gained</b></td>
        </tr>



<?php
        $total_est_time = 0;
        $total_actual_time = 0;
        $total_rej_time = 0;
        $total_lossrgain_time = 0;
        $result = $newreport->gettime4prodn_eff_tab('HAASVF2SS-2',$cond);

        while ($myrow = mysql_fetch_row($result)) {

?>
            <tr>
              <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[1];
               $crn[]= $myrow[1];
               ?></td>
              <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[2] ?></td>
              <td bgcolor="#FFFFFF"><span class="tabletext"><?php printf('%.2f', $myrow[3]) ?></td>
              <td bgcolor="#FFFFFF"><span class="tabletext"><?php printf ("%.2f",($myrow[4]+$myrow[7]));
               $total_est_time += ($myrow[4]+$myrow[7]);
               $esttime[]= ($myrow[4]+$myrow[7]);
               ?></td>
              <td bgcolor="#FFFFFF"><span class="tabletext"><?php printf ("%.2f",($myrow[5]+$myrow[6]));
               $total_actual_time += ($myrow[5]+$myrow[6]);
               $actualtime[]= ($myrow[5]+$myrow[6])
               ?></td>
              <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo  $myrow[8] ?></td>
              <td bgcolor="#FFFFFF"><span class="tabletext">
              <?php
               if($myrow[8] != 0)
               {
                 $result4rejtime = $newreport->getmaster_rejtime4prodn_eff($myrow[1],$myrow[2],$myrow[8]);
                 $myrow4rejtime = mysql_fetch_row($result4rejtime);
                 $rej_time=$myrow4rejtime[2];
                 printf("%.2f", $rej_time);
                 $total_rej_time += $rej_time;
               }
               else
               {
                 $rej_time = 0;
                 printf("%.2f",$rej_time);
                 $total_rej_time += $rej_time;
               }
              ?>
              </td>
              <td bgcolor="#FFFFFF"><span class="tabletext">
              <?php
               printf("%.2f", (($myrow[4]+$myrow[7])-(($myrow[5]+$myrow[6]+$rej_time))));
               $total_lossrgain_time += (($myrow[4]+$myrow[7])-(($myrow[5]+$myrow[6]+$rej_time)));
               $lossrgain[]=(($myrow[4]+$myrow[7])-(($myrow[5]+$myrow[6]+$rej_time)));
              ?>
              </td>
            </tr>
<?php
         }
       unset($rej_time);

?>
<tr bgcolor="#FFFFFF">
 <td colspan=3 bgcolor="#FFFFFF" align="right"><span class="tabletext"><b>Total</b></td>
  <td bgcolor="#00DDFF"><span class="tabletext"><?php printf("%.2f", $total_est_time); ?></td>
 <td bgcolor="#00DDFF"><span class="tabletext"><?php printf("%.2f", $total_actual_time); ?></td>
  <td bgcolor="#00DDFF"><span class="tabletext">&nbsp;</td>
 <td bgcolor="#00DDFF"><span class="tabletext"><?php printf("%.2f", $total_rej_time); ?></td>
 <td bgcolor="#00DDFF"><span class="tabletext"><?php printf("%.2f", $total_lossrgain_time); ?></td>
</tr>
</table>
<div id ='haasvf2ss2div'>
<table border=1 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3>
<tr bgcolor="#FFFFFF">
 <td colspan=3 bgcolor="#FFFFFF" align="right"><span class="tabletext"><b>Machine Utilization Efficiency</b></td>
 <td colspan=5 bgcolor="#99FFFF"><span class="tabletext"><?php
 $machine_eff = ($total_actual_time+$total_rej_time) != 0? ((($total_est_time)/($total_actual_time+$total_rej_time))*100):0;
 printf("%.2f",$machine_eff);
 echo '%';
 ?></td>
</tr>

        <tr bgcolor="#FFFFFF">
            <td colspan=4><span class="labeltext">F8400-S</td>
            <td colspan=2><span class="labeltext">Rev No:0 &nbsp Rev Date:8-1-2009</td>
            <td colspan=2><span class="labeltext"></td>
        </tr>

</table>
</div>
</div>
<table>
<tr>
<td id="charthaasvf2ss2">
 <?php
      include_once 'ofc-library/open_flash_chart_object.php';
      $mc=urlencode('HAASVF2SS-2');
      //$wcond = htmlentities($cond);
      open_flash_chart_object( 1000, 350, 'https://'. $_SERVER['SERVER_NAME'] .'/wms/chart-prodneff1.php?mcname='.$mc.'&sdate='.$fromdate1.'&edate='.$todate1, false );
      //open_flash_chart_object( 1000, 350, 'http://'. $_SERVER['SERVER_NAME'] .'/wms_bk_jan5/gallerydata.php', false );

 ?>
</td>
</table>
</tr>
</div>
<tr>
<td>
<div id='makinof52d'>
<table id='makinof52' width=100% border=1 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
        <tr>
         <td width=40% bgcolor="#FFFFFF"><span class="labeltext"><b>From &nbsp&nbsp</b>
         <input type="text" id="fmakinof52" name="fmakinof52" size=10 value="<?php echo $fromdate1 ?>"
          style="background-color:#DDDDDD;" readonly="readonly"
          onkeypress="javascript: return checkenter(event)">
         <img src="images/bu-getdateicon.gif" alt="Get Date" onclick="GetDate('fmakinof52')">
          <span class="labeltext"><b>&nbsp;&nbsp;To</b>
         <input type="text" id="tmakinof52" name="tmakinof52" size=10 value="<?php echo $todate1 ?>"
          style="background-color:#DDDDDD;" readonly="readonly"
          onkeypress="javascript: return checkenter(event)">
         <img src="images/bu-getdateicon.gif" alt="Get Date" onclick="GetDate('tmakinof52')">
         <input type="image" name="Submit" src="images/bu-get.gif" value="Get"
            onclick="javascript: getmc_eff('MakinoF5-2','makinof52d','makinof52','fmakinof52','tmakinof52')">

         </td>
        <td width=30% align="center" bgcolor="#00DDFF"><span class="heading"><b>MakinoF5-2</b></td>
        <td align="center" bgcolor="#FFFFFF">
        <input type= "image" name="Print" src="images/bu-print.gif" value="Get"
onclick='javascript: openPrintWindow(new Array("chartmakinof52","makinof52div"))'>
</td>

   <td align="center" bgcolor="#FFFFFF">
        <input type= "image" name="Print" src="images/printchart.gif" value="Get"
onclick='javascript: openPrintWindow(new Array("chartmakinof52","makinof52div"))'>
</td>
<?php
        $cond = "op.st_date >= '$fromdate1' and op.st_date <= '$todate1'";
        $_SESSION['ccond'] = $cond;
?>
        </tr>
</table>
<div id="makinof52div">
<table width=100% border=1 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
<tr>
        <tr>
            <td bgcolor="#00DDFF" width=20%><span class="heading"><b>PRN</b></td>
            <td bgcolor="#00DDFF" width=10%><span class="heading"><b>Stage</b></td>
            <td bgcolor="#00DDFF" width=10%><span class="heading"><b>Qty Mfg</b></td>
            <td bgcolor="#00DDFF"><span class="heading"><b>Est<br>Time</b></td>
            <td bgcolor="#00DDFF"><span class="heading"><b>Actual<br>Time</b></td>
            <td bgcolor="#00DDFF"><span class="heading"><b>Rej<br>Qty</b></td>
            <td bgcolor="#00DDFF"><span class="heading"><b>Rej<br>Time</b></td>
            <td bgcolor="#00DDFF" width=10%><span class="heading"><b>Lost or<br>Gained</b></td>
        </tr>



<?php
        $total_est_time = 0;
        $total_actual_time = 0;
        $total_rej_time = 0;
        $total_lossrgain_time = 0;
        $result = $newreport->gettime4prodn_eff_tab('MakinoF5-2',$cond);

        while ($myrow = mysql_fetch_row($result)) {

?>
            <tr>
              <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[1];
               $crn[]= $myrow[1];
               ?></td>
              <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[2] ?></td>
              <td bgcolor="#FFFFFF"><span class="tabletext"><?php printf('%.2f', $myrow[3]) ?></td>
              <td bgcolor="#FFFFFF"><span class="tabletext"><?php printf ("%.2f",($myrow[4]+$myrow[7]));
               $total_est_time += ($myrow[4]+$myrow[7]);
               $esttime[]= ($myrow[4]+$myrow[7]);
               ?></td>
              <td bgcolor="#FFFFFF"><span class="tabletext"><?php printf ("%.2f",($myrow[5]+$myrow[6]));
               $total_actual_time += ($myrow[5]+$myrow[6]);
               $actualtime[]= ($myrow[5]+$myrow[6])
               ?></td>
              <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo  $myrow[8] ?></td>
              <td bgcolor="#FFFFFF"><span class="tabletext">
              <?php
               if($myrow[8] != 0)
               {
                 $result4rejtime = $newreport->getmaster_rejtime4prodn_eff($myrow[1],$myrow[2],$myrow[8]);
                 $myrow4rejtime = mysql_fetch_row($result4rejtime);
                 $rej_time=$myrow4rejtime[2];
                 printf("%.2f", $rej_time);
                 $total_rej_time += $rej_time;
               }
               else
               {
                 $rej_time = 0;
                 printf("%.2f",$rej_time);
                 $total_rej_time += $rej_time;
               }
              ?>
              </td>
              <td bgcolor="#FFFFFF"><span class="tabletext">
              <?php
               printf("%.2f", (($myrow[4]+$myrow[7])-(($myrow[5]+$myrow[6]+$rej_time))));
               $total_lossrgain_time += (($myrow[4]+$myrow[7])-(($myrow[5]+$myrow[6]+$rej_time)));
               $lossrgain[]=(($myrow[4]+$myrow[7])-(($myrow[5]+$myrow[6]+$rej_time)));
              ?>
              </td>
            </tr>
<?php
         }
       unset($rej_time);

?>
<tr bgcolor="#FFFFFF">
 <td colspan=3 bgcolor="#FFFFFF" align="right"><span class="tabletext"><b>Total</b></td>
  <td bgcolor="#00DDFF"><span class="tabletext"><?php printf("%.2f", $total_est_time); ?></td>
 <td bgcolor="#00DDFF"><span class="tabletext"><?php printf("%.2f", $total_actual_time); ?></td>
  <td bgcolor="#00DDFF"><span class="tabletext">&nbsp;</td>
 <td bgcolor="#00DDFF"><span class="tabletext"><?php printf("%.2f", $total_rej_time); ?></td>
 <td bgcolor="#00DDFF"><span class="tabletext"><?php printf("%.2f", $total_lossrgain_time); ?></td>
</tr>
</table>
<div id ='makinof52div'>
<table border=1 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3>
<tr bgcolor="#FFFFFF">
 <td colspan=3 bgcolor="#FFFFFF" align="right"><span class="tabletext"><b>Machine Utilization Efficiency</b></td>
 <td colspan=5 bgcolor="#99FFFF"><span class="tabletext"><?php
 $machine_eff = ($total_actual_time+$total_rej_time) != 0? ((($total_est_time)/($total_actual_time+$total_rej_time))*100):0;
 printf("%.2f",$machine_eff);
 echo '%';
 ?></td>
</tr>

        <tr bgcolor="#FFFFFF">
            <td colspan=4><span class="labeltext">F8400-S</td>
            <td colspan=2><span class="labeltext">Rev No:0 &nbsp Rev Date:8-1-2009</td>
            <td colspan=2><span class="labeltext"></td>
        </tr>

</table>
</div>
</div>
<table>
<tr>
<td id="chartmakinof52">
 <?php
      include_once 'ofc-library/open_flash_chart_object.php';
      $mc=urlencode('MakinoF5-2');
      //$wcond = htmlentities($cond);
      open_flash_chart_object( 1000, 350, 'https://'. $_SERVER['SERVER_NAME'] .'/wms/chart-prodneff1.php?mcname='.$mc.'&sdate='.$fromdate1.'&edate='.$todate1, false );
      //open_flash_chart_object( 1000, 350, 'http://'. $_SERVER['SERVER_NAME'] .'/wms_bk_jan5/gallerydata.php', false );

 ?>
</td>
</table>
</tr>
</div>
<tr>
<td>
<div id='makinof53d'>
<table id='makinof53' width=100% border=1 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
        <tr>
         <td width=40% bgcolor="#FFFFFF"><span class="labeltext"><b>From &nbsp&nbsp</b>
         <input type="text" id="fmakinof53" name="fmakinof53" size=10 value="<?php echo $fromdate1 ?>"
          style="background-color:#DDDDDD;" readonly="readonly"
          onkeypress="javascript: return checkenter(event)">
         <img src="images/bu-getdateicon.gif" alt="Get Date" onclick="GetDate('fmakinof53')">
          <span class="labeltext"><b>&nbsp;&nbsp;To</b>
         <input type="text" id="tmakinof53" name="tmakinof53" size=10 value="<?php echo $todate1 ?>"
          style="background-color:#DDDDDD;" readonly="readonly"
          onkeypress="javascript: return checkenter(event)">
         <img src="images/bu-getdateicon.gif" alt="Get Date" onclick="GetDate('tmakinof53')">
         <input type="image" name="Submit" src="images/bu-get.gif" value="Get"
            onclick="javascript: getmc_eff('MakinoF5-3','makinof53d','makinof53','fmakinof53','tmakinof53')">

         </td>
        <td width=30% align="center" bgcolor="#00DDFF"><span class="heading"><b>MakinoF5-3</b></td>
        <td align="center" bgcolor="#FFFFFF">
        <input type= "image" name="Print" src="images/bu-print.gif" value="Get"
onclick='javascript: openPrintWindow(new Array("chartmakinof53","makinof53div"))'>
</td>

   <td align="center" bgcolor="#FFFFFF">
        <input type= "image" name="Print" src="images/printchart.gif" value="Get"
onclick='javascript: openPrintWindow(new Array("chartmakinof53","makinof53div"))'>
</td>
<?php
        $cond = "op.st_date >= '$fromdate1' and op.st_date <= '$todate1'";
        $_SESSION['ccond'] = $cond;
?>
        </tr>
</table>
<div id="makinof53div">
<table width=100% border=1 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
<tr>
        <tr>
            <td bgcolor="#00DDFF" width=20%><span class="heading"><b>PRN</b></td>
            <td bgcolor="#00DDFF" width=10%><span class="heading"><b>Stage</b></td>
            <td bgcolor="#00DDFF" width=10%><span class="heading"><b>Qty Mfg</b></td>
            <td bgcolor="#00DDFF"><span class="heading"><b>Est<br>Time</b></td>
            <td bgcolor="#00DDFF"><span class="heading"><b>Actual<br>Time</b></td>
            <td bgcolor="#00DDFF"><span class="heading"><b>Rej<br>Qty</b></td>
            <td bgcolor="#00DDFF"><span class="heading"><b>Rej<br>Time</b></td>
            <td bgcolor="#00DDFF" width=10%><span class="heading"><b>Lost or<br>Gained</b></td>
        </tr>



<?php
        $total_est_time = 0;
        $total_actual_time = 0;
        $total_rej_time = 0;
        $total_lossrgain_time = 0;
        $result = $newreport->gettime4prodn_eff_tab('MakinoF5-3',$cond);

        while ($myrow = mysql_fetch_row($result)) {

?>
            <tr>
              <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[1];
               $crn[]= $myrow[1];
               ?></td>
              <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[2] ?></td>
              <td bgcolor="#FFFFFF"><span class="tabletext"><?php printf('%.2f', $myrow[3]) ?></td>
              <td bgcolor="#FFFFFF"><span class="tabletext"><?php printf ("%.2f",($myrow[4]+$myrow[7]));
               $total_est_time += ($myrow[4]+$myrow[7]);
               $esttime[]= ($myrow[4]+$myrow[7]);
               ?></td>
              <td bgcolor="#FFFFFF"><span class="tabletext"><?php printf ("%.2f",($myrow[5]+$myrow[6]));
               $total_actual_time += ($myrow[5]+$myrow[6]);
               $actualtime[]= ($myrow[5]+$myrow[6])
               ?></td>
              <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo  $myrow[8] ?></td>
              <td bgcolor="#FFFFFF"><span class="tabletext">
              <?php
               if($myrow[8] != 0)
               {
                 $result4rejtime = $newreport->getmaster_rejtime4prodn_eff($myrow[1],$myrow[2],$myrow[8]);
                 $myrow4rejtime = mysql_fetch_row($result4rejtime);
                 $rej_time=$myrow4rejtime[2];
                 printf("%.2f", $rej_time);
                 $total_rej_time += $rej_time;
               }
               else
               {
                 $rej_time = 0;
                 printf("%.2f",$rej_time);
                 $total_rej_time += $rej_time;
               }
              ?>
              </td>
              <td bgcolor="#FFFFFF"><span class="tabletext">
              <?php
               printf("%.2f", (($myrow[4]+$myrow[7])-(($myrow[5]+$myrow[6]+$rej_time))));
               $total_lossrgain_time += (($myrow[4]+$myrow[7])-(($myrow[5]+$myrow[6]+$rej_time)));
               $lossrgain[]=(($myrow[4]+$myrow[7])-(($myrow[5]+$myrow[6]+$rej_time)));
              ?>
              </td>
            </tr>
<?php
         }
       unset($rej_time);

?>
<tr bgcolor="#FFFFFF">
 <td colspan=3 bgcolor="#FFFFFF" align="right"><span class="tabletext"><b>Total</b></td>
  <td bgcolor="#00DDFF"><span class="tabletext"><?php printf("%.2f", $total_est_time); ?></td>
 <td bgcolor="#00DDFF"><span class="tabletext"><?php printf("%.2f", $total_actual_time); ?></td>
  <td bgcolor="#00DDFF"><span class="tabletext">&nbsp;</td>
 <td bgcolor="#00DDFF"><span class="tabletext"><?php printf("%.2f", $total_rej_time); ?></td>
 <td bgcolor="#00DDFF"><span class="tabletext"><?php printf("%.2f", $total_lossrgain_time); ?></td>
</tr>
</table>
<div id ='makinof53div'>
<table border=1 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3>
<tr bgcolor="#FFFFFF">
 <td colspan=3 bgcolor="#FFFFFF" align="right"><span class="tabletext"><b>Machine Utilization Efficiency</b></td>
 <td colspan=5 bgcolor="#99FFFF"><span class="tabletext"><?php
 $machine_eff = ($total_actual_time+$total_rej_time) != 0? ((($total_est_time)/($total_actual_time+$total_rej_time))*100):0;
 printf("%.2f",$machine_eff);
 echo '%';
 ?></td>
</tr>

        <tr bgcolor="#FFFFFF">
            <td colspan=4><span class="labeltext">F8400-S</td>
            <td colspan=2><span class="labeltext">Rev No:0 &nbsp Rev Date:8-1-2009</td>
            <td colspan=2><span class="labeltext"></td>
        </tr>

</table>
</div>
</div>
<table>
<tr>
<td id="chartmakinof53">
 <?php
      include_once 'ofc-library/open_flash_chart_object.php';
      $mc=urlencode('MakinoF5-3');
      //$wcond = htmlentities($cond);
      open_flash_chart_object( 1000, 350, 'https://'. $_SERVER['SERVER_NAME'] .'/wms/chart-prodneff1.php?mcname='.$mc.'&sdate='.$fromdate1.'&edate='.$todate1, false );
      //open_flash_chart_object( 1000, 350, 'http://'. $_SERVER['SERVER_NAME'] .'/wms_bk_jan5/gallerydata.php', false );

 ?>
</td>
</table>
</tr>
</div>

<tr>
<td>
<div id='makinof54d'>
<table id='makinof54' width=100% border=1 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
        <tr>
         <td width=40% bgcolor="#FFFFFF"><span class="labeltext"><b>From &nbsp&nbsp</b>
         <input type="text" id="fmakinof54" name="fmakinof54" size=10 value="<?php echo $fromdate1 ?>"
          style="background-color:#DDDDDD;" readonly="readonly"
          onkeypress="javascript: return checkenter(event)">
         <img src="images/bu-getdateicon.gif" alt="Get Date" onclick="GetDate('fmakinof52')">
          <span class="labeltext"><b>&nbsp;&nbsp;To</b>
         <input type="text" id="tmakinof54" name="tmakinof54" size=10 value="<?php echo $todate1 ?>"
          style="background-color:#DDDDDD;" readonly="readonly"
          onkeypress="javascript: return checkenter(event)">
         <img src="images/bu-getdateicon.gif" alt="Get Date" onclick="GetDate('tmakinof54')">
         <input type="image" name="Submit" src="images/bu-get.gif" value="Get"
            onclick="javascript: getmc_eff('MakinoF5-4','makinof54d','makinof54','fmakinof54','tmakinof54')">

         </td>
        <td width=30% align="center" bgcolor="#00DDFF"><span class="heading"><b>MakinoF5-4</b></td>
        <td align="center" bgcolor="#FFFFFF">
        <input type= "image" name="Print" src="images/bu-print.gif" value="Get"
onclick='javascript: openPrintWindow(new Array("chartmakinof54","makinof54div"))'>
</td>

   <td align="center" bgcolor="#FFFFFF">
        <input type= "image" name="Print" src="images/printchart.gif" value="Get"
onclick='javascript: openPrintWindow(new Array("chartmakinof54","makinof54div"))'>
</td>
<?php
        $cond = "op.st_date >= '$fromdate1' and op.st_date <= '$todate1'";
        $_SESSION['ccond'] = $cond;
?>
        </tr>
</table>
<div id="makinof54div">
<table width=100% border=1 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
<tr>
        <tr>
            <td bgcolor="#00DDFF" width=20%><span class="heading"><b>PRN</b></td>
            <td bgcolor="#00DDFF" width=10%><span class="heading"><b>Stage</b></td>
            <td bgcolor="#00DDFF" width=10%><span class="heading"><b>Qty Mfg</b></td>
            <td bgcolor="#00DDFF"><span class="heading"><b>Est<br>Time</b></td>
            <td bgcolor="#00DDFF"><span class="heading"><b>Actual<br>Time</b></td>
            <td bgcolor="#00DDFF"><span class="heading"><b>Rej<br>Qty</b></td>
            <td bgcolor="#00DDFF"><span class="heading"><b>Rej<br>Time</b></td>
            <td bgcolor="#00DDFF" width=10%><span class="heading"><b>Lost or<br>Gained</b></td>
        </tr>



<?php
        $total_est_time = 0;
        $total_actual_time = 0;
        $total_rej_time = 0;
        $total_lossrgain_time = 0;
        $result = $newreport->gettime4prodn_eff_tab('MakinoF5-4',$cond);

        while ($myrow = mysql_fetch_row($result)) {

?>
            <tr>
              <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[1];
               $crn[]= $myrow[1];
               ?></td>
              <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[2] ?></td>
              <td bgcolor="#FFFFFF"><span class="tabletext"><?php printf('%.2f', $myrow[3]) ?></td>
              <td bgcolor="#FFFFFF"><span class="tabletext"><?php printf ("%.2f",($myrow[4]+$myrow[7]));
               $total_est_time += ($myrow[4]+$myrow[7]);
               $esttime[]= ($myrow[4]+$myrow[7]);
               ?></td>
              <td bgcolor="#FFFFFF"><span class="tabletext"><?php printf ("%.2f",($myrow[5]+$myrow[6]));
               $total_actual_time += ($myrow[5]+$myrow[6]);
               $actualtime[]= ($myrow[5]+$myrow[6])
               ?></td>
              <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo  $myrow[8] ?></td>
              <td bgcolor="#FFFFFF"><span class="tabletext">
              <?php
               if($myrow[8] != 0)
               {
                 $result4rejtime = $newreport->getmaster_rejtime4prodn_eff($myrow[1],$myrow[2],$myrow[8]);
                 $myrow4rejtime = mysql_fetch_row($result4rejtime);
                 $rej_time=$myrow4rejtime[2];
                 printf("%.2f", $rej_time);
                 $total_rej_time += $rej_time;
               }
               else
               {
                 $rej_time = 0;
                 printf("%.2f",$rej_time);
                 $total_rej_time += $rej_time;
               }
              ?>
              </td>
              <td bgcolor="#FFFFFF"><span class="tabletext">
              <?php
               printf("%.2f", (($myrow[4]+$myrow[7])-(($myrow[5]+$myrow[6]+$rej_time))));
               $total_lossrgain_time += (($myrow[4]+$myrow[7])-(($myrow[5]+$myrow[6]+$rej_time)));
               $lossrgain[]=(($myrow[4]+$myrow[7])-(($myrow[5]+$myrow[6]+$rej_time)));
              ?>
              </td>
            </tr>
<?php
         }
       unset($rej_time);

?>
<tr bgcolor="#FFFFFF">
 <td colspan=3 bgcolor="#FFFFFF" align="right"><span class="tabletext"><b>Total</b></td>
  <td bgcolor="#00DDFF"><span class="tabletext"><?php printf("%.2f", $total_est_time); ?></td>
 <td bgcolor="#00DDFF"><span class="tabletext"><?php printf("%.2f", $total_actual_time); ?></td>
  <td bgcolor="#00DDFF"><span class="tabletext">&nbsp;</td>
 <td bgcolor="#00DDFF"><span class="tabletext"><?php printf("%.2f", $total_rej_time); ?></td>
 <td bgcolor="#00DDFF"><span class="tabletext"><?php printf("%.2f", $total_lossrgain_time); ?></td>
</tr>
</table>
<div id ='makinof54div'>
<table border=1 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3>
<tr bgcolor="#FFFFFF">
 <td colspan=3 bgcolor="#FFFFFF" align="right"><span class="tabletext"><b>Machine Utilization Efficiency</b></td>
 <td colspan=5 bgcolor="#99FFFF"><span class="tabletext"><?php
 $machine_eff = ($total_actual_time+$total_rej_time) != 0? ((($total_est_time)/($total_actual_time+$total_rej_time))*100):0;
 printf("%.2f",$machine_eff);
 echo '%';
 ?></td>
</tr>

        <tr bgcolor="#FFFFFF">
            <td colspan=4><span class="labeltext">F8400-S</td>
            <td colspan=2><span class="labeltext">Rev No:0 &nbsp Rev Date:8-1-2009</td>
            <td colspan=2><span class="labeltext"></td>
        </tr>

</table>
</div>
</div>
<table>
<tr>
<td id="chartmakinof54">
 <?php
      include_once 'ofc-library/open_flash_chart_object.php';
      $mc=urlencode('MakinoF5-4');
      //$wcond = htmlentities($cond);
      open_flash_chart_object( 1000, 350, 'https://'. $_SERVER['SERVER_NAME'] .'/wms/chart-prodneff1.php?mcname='.$mc.'&sdate='.$fromdate1.'&edate='.$todate1, false );
      //open_flash_chart_object( 1000, 350, 'http://'. $_SERVER['SERVER_NAME'] .'/wms_bk_jan5/gallerydata.php', false );

 ?>
</td>
</table>
</tr>
</div>

 <tr>
<td>
<div id='emag1d'>
<table id='emag1' width=100% border=1 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
        <tr>
         <td width=40% bgcolor="#FFFFFF"><span class="labeltext"><b>From &nbsp&nbsp</b>
         <input type="text" id="femag1" name="femag1" size=10 value="<?php echo $fromdate1 ?>"
          style="background-color:#DDDDDD;" readonly="readonly"
          onkeypress="javascript: return checkenter(event)">
         <img src="images/bu-getdateicon.gif" alt="Get Date" onclick="GetDate('femag1')">
          <span class="labeltext"><b>&nbsp;&nbsp;To</b>
         <input type="text" id="temag1" name="temag1" size=10 value="<?php echo $todate1 ?>"
          style="background-color:#DDDDDD;" readonly="readonly"
          onkeypress="javascript: return checkenter(event)">
         <img src="images/bu-getdateicon.gif" alt="Get Date" onclick="GetDate('temag1')">
         <input type="image" name="Submit" src="images/bu-get.gif" value="Get"
            onclick="javascript: getmc_eff('EMAG-1','emag1d','emag1','femag1','temag1')">

         </td>
        <td width=30% align="center" bgcolor="#00DDFF"><span class="heading"><b>EMAG-1</b></td>
        <td align="center" bgcolor="#FFFFFF">
        <input type= "image" name="Print" src="images/bu-print.gif" value="Get"
onclick='javascript: openPrintWindow(new Array("chartemag1","emag1div"))'>
</td>

   <td align="center" bgcolor="#FFFFFF">
        <input type= "image" name="Print" src="images/printchart.gif" value="Get"
onclick='javascript: openPrintWindow(new Array("chartemag1","emag1div"))'>
</td>
<?php
        $cond = "op.st_date >= '$fromdate1' and op.st_date <= '$todate1'";
        $_SESSION['ccond'] = $cond;
?>
        </tr>
</table>
<div id="emag1div">
<table width=100% border=1 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
<tr>
        <tr>
            <td bgcolor="#00DDFF" width=20%><span class="heading"><b>PRN</b></td>
            <td bgcolor="#00DDFF" width=10%><span class="heading"><b>Stage</b></td>
            <td bgcolor="#00DDFF" width=10%><span class="heading"><b>Qty Mfg</b></td>
            <td bgcolor="#00DDFF"><span class="heading"><b>Est<br>Time</b></td>
            <td bgcolor="#00DDFF"><span class="heading"><b>Actual<br>Time</b></td>
            <td bgcolor="#00DDFF"><span class="heading"><b>Rej<br>Qty</b></td>
            <td bgcolor="#00DDFF"><span class="heading"><b>Rej<br>Time</b></td>
            <td bgcolor="#00DDFF" width=10%><span class="heading"><b>Lost or<br>Gained</b></td>
        </tr>



<?php
        $total_est_time = 0;
        $total_actual_time = 0;
        $total_rej_time = 0;
        $total_lossrgain_time = 0;
        $result = $newreport->gettime4prodn_eff_tab('MakinoF5-4',$cond);

        while ($myrow = mysql_fetch_row($result)) {

?>
            <tr>
              <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[1];
               $crn[]= $myrow[1];
               ?></td>
              <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[2] ?></td>
              <td bgcolor="#FFFFFF"><span class="tabletext"><?php printf('%.2f', $myrow[3]) ?></td>
              <td bgcolor="#FFFFFF"><span class="tabletext"><?php printf ("%.2f",($myrow[4]+$myrow[7]));
               $total_est_time += ($myrow[4]+$myrow[7]);
               $esttime[]= ($myrow[4]+$myrow[7]);
               ?></td>
              <td bgcolor="#FFFFFF"><span class="tabletext"><?php printf ("%.2f",($myrow[5]+$myrow[6]));
               $total_actual_time += ($myrow[5]+$myrow[6]);
               $actualtime[]= ($myrow[5]+$myrow[6])
               ?></td>
              <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo  $myrow[8] ?></td>
              <td bgcolor="#FFFFFF"><span class="tabletext">
              <?php
               if($myrow[8] != 0)
               {
                 $result4rejtime = $newreport->getmaster_rejtime4prodn_eff($myrow[1],$myrow[2],$myrow[8]);
                 $myrow4rejtime = mysql_fetch_row($result4rejtime);
                 $rej_time=$myrow4rejtime[2];
                 printf("%.2f", $rej_time);
                 $total_rej_time += $rej_time;
               }
               else
               {
                 $rej_time = 0;
                 printf("%.2f",$rej_time);
                 $total_rej_time += $rej_time;
               }
              ?>
              </td>
              <td bgcolor="#FFFFFF"><span class="tabletext">
              <?php
               printf("%.2f", (($myrow[4]+$myrow[7])-(($myrow[5]+$myrow[6]+$rej_time))));
               $total_lossrgain_time += (($myrow[4]+$myrow[7])-(($myrow[5]+$myrow[6]+$rej_time)));
               $lossrgain[]=(($myrow[4]+$myrow[7])-(($myrow[5]+$myrow[6]+$rej_time)));
              ?>
              </td>
            </tr>
<?php
         }
       unset($rej_time);

?>
<tr bgcolor="#FFFFFF">
 <td colspan=3 bgcolor="#FFFFFF" align="right"><span class="tabletext"><b>Total</b></td>
  <td bgcolor="#00DDFF"><span class="tabletext"><?php printf("%.2f", $total_est_time); ?></td>
 <td bgcolor="#00DDFF"><span class="tabletext"><?php printf("%.2f", $total_actual_time); ?></td>
  <td bgcolor="#00DDFF"><span class="tabletext">&nbsp;</td>
 <td bgcolor="#00DDFF"><span class="tabletext"><?php printf("%.2f", $total_rej_time); ?></td>
 <td bgcolor="#00DDFF"><span class="tabletext"><?php printf("%.2f", $total_lossrgain_time); ?></td>
</tr>
</table>
<div id ='emag1div'>
<table border=1 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3>
<tr bgcolor="#FFFFFF">
 <td colspan=3 bgcolor="#FFFFFF" align="right"><span class="tabletext"><b>Machine Utilization Efficiency</b></td>
 <td colspan=5 bgcolor="#99FFFF"><span class="tabletext"><?php
 $machine_eff = ($total_actual_time+$total_rej_time) != 0? ((($total_est_time)/($total_actual_time+$total_rej_time))*100):0;
 printf("%.2f",$machine_eff);
 echo '%';
 ?></td>
</tr>

        <tr bgcolor="#FFFFFF">
            <td colspan=4><span class="labeltext">F8400-S</td>
            <td colspan=2><span class="labeltext">Rev No:0 &nbsp Rev Date:8-1-2009</td>
            <td colspan=2><span class="labeltext"></td>
        </tr>

</table>
</div>
</div>
<table>
<tr>
<td id="chartemag1">
 <?php
      include_once 'ofc-library/open_flash_chart_object.php';
      $mc=urlencode('EMAG-1');
      //$wcond = htmlentities($cond);
      open_flash_chart_object( 1000, 350, 'https://'. $_SERVER['SERVER_NAME'] .'/wms/chart-prodneff1.php?mcname='.$mc.'&sdate='.$fromdate1.'&edate='.$todate1, false );
      //open_flash_chart_object( 1000, 350, 'http://'. $_SERVER['SERVER_NAME'] .'/wms_bk_jan5/gallerydata.php', false );

 ?>
</td>
</table>
</tr>
</div>

 <tr>
<td>
<div id='a51nx1d'>
<table id='a51nx1' width=100% border=1 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
        <tr>
         <td width=40% bgcolor="#FFFFFF"><span class="labeltext"><b>From &nbsp&nbsp</b>
         <input type="text" id="fa51nx1" name="fa51nx1" size=10 value="<?php echo $fromdate1 ?>"
          style="background-color:#DDDDDD;" readonly="readonly"
          onkeypress="javascript: return checkenter(event)">
         <img src="images/bu-getdateicon.gif" alt="Get Date" onclick="GetDate('fa51nx1')">
          <span class="labeltext"><b>&nbsp;&nbsp;To</b>
         <input type="text" id="ta51nx1" name="ta51nx1" size=10 value="<?php echo $todate1 ?>"
          style="background-color:#DDDDDD;" readonly="readonly"
          onkeypress="javascript: return checkenter(event)">
         <img src="images/bu-getdateicon.gif" alt="Get Date" onclick="GetDate('ta51nx1')">
         <input type="image" name="Submit" src="images/bu-get.gif" value="Get"
            onclick="javascript: getmc_eff('A51nx-1','a51nx1d','a51nx1','fa51nx1','ta51nx1')">

         </td>
        <td width=30% align="center" bgcolor="#00DDFF"><span class="heading"><b>A51nx-1</b></td>
        <td align="center" bgcolor="#FFFFFF">
        <input type= "image" name="Print" src="images/bu-print.gif" value="Get"
onclick='javascript: openPrintWindow(new Array("charta51nx1","a51nx1div"))'>
</td>

   <td align="center" bgcolor="#FFFFFF">
        <input type= "image" name="Print" src="images/printchart.gif" value="Get"
onclick='javascript: openPrintWindow(new Array("charta51nx1","a51nx1div"))'>
</td>
<?php
        $cond = "op.st_date >= '$fromdate1' and op.st_date <= '$todate1'";
        $_SESSION['ccond'] = $cond;
?>
        </tr>
</table>
<div id="a51nx1div">
<table width=100% border=1 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
<tr>
        <tr>
            <td bgcolor="#00DDFF" width=20%><span class="heading"><b>PRN</b></td>
            <td bgcolor="#00DDFF" width=10%><span class="heading"><b>Stage</b></td>
            <td bgcolor="#00DDFF" width=10%><span class="heading"><b>Qty Mfg</b></td>
            <td bgcolor="#00DDFF"><span class="heading"><b>Est<br>Time</b></td>
            <td bgcolor="#00DDFF"><span class="heading"><b>Actual<br>Time</b></td>
            <td bgcolor="#00DDFF"><span class="heading"><b>Rej<br>Qty</b></td>
            <td bgcolor="#00DDFF"><span class="heading"><b>Rej<br>Time</b></td>
            <td bgcolor="#00DDFF" width=10%><span class="heading"><b>Lost or<br>Gained</b></td>
        </tr>



<?php
        $total_est_time = 0;
        $total_actual_time = 0;
        $total_rej_time = 0;
        $total_lossrgain_time = 0;
        $result = $newreport->gettime4prodn_eff_tab('A51nx-1',$cond);

        while ($myrow = mysql_fetch_row($result)) {

?>
            <tr>
              <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[1];
               $crn[]= $myrow[1];
               ?></td>
              <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[2] ?></td>
              <td bgcolor="#FFFFFF"><span class="tabletext"><?php printf('%.2f', $myrow[3]) ?></td>
              <td bgcolor="#FFFFFF"><span class="tabletext"><?php printf ("%.2f",($myrow[4]+$myrow[7]));
               $total_est_time += ($myrow[4]+$myrow[7]);
               $esttime[]= ($myrow[4]+$myrow[7]);
               ?></td>
              <td bgcolor="#FFFFFF"><span class="tabletext"><?php printf ("%.2f",($myrow[5]+$myrow[6]));
               $total_actual_time += ($myrow[5]+$myrow[6]);
               $actualtime[]= ($myrow[5]+$myrow[6])
               ?></td>
              <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo  $myrow[8] ?></td>
              <td bgcolor="#FFFFFF"><span class="tabletext">
              <?php
               if($myrow[8] != 0)
               {
                 $result4rejtime = $newreport->getmaster_rejtime4prodn_eff($myrow[1],$myrow[2],$myrow[8]);
                 $myrow4rejtime = mysql_fetch_row($result4rejtime);
                 $rej_time=$myrow4rejtime[2];
                 printf("%.2f", $rej_time);
                 $total_rej_time += $rej_time;
               }
               else
               {
                 $rej_time = 0;
                 printf("%.2f",$rej_time);
                 $total_rej_time += $rej_time;
               }
              ?>
              </td>
              <td bgcolor="#FFFFFF"><span class="tabletext">
              <?php
               printf("%.2f", (($myrow[4]+$myrow[7])-(($myrow[5]+$myrow[6]+$rej_time))));
               $total_lossrgain_time += (($myrow[4]+$myrow[7])-(($myrow[5]+$myrow[6]+$rej_time)));
               $lossrgain[]=(($myrow[4]+$myrow[7])-(($myrow[5]+$myrow[6]+$rej_time)));
              ?>
              </td>
            </tr>
<?php
         }
       unset($rej_time);

?>
<tr bgcolor="#FFFFFF">
 <td colspan=3 bgcolor="#FFFFFF" align="right"><span class="tabletext"><b>Total</b></td>
  <td bgcolor="#00DDFF"><span class="tabletext"><?php printf("%.2f", $total_est_time); ?></td>
 <td bgcolor="#00DDFF"><span class="tabletext"><?php printf("%.2f", $total_actual_time); ?></td>
  <td bgcolor="#00DDFF"><span class="tabletext">&nbsp;</td>
 <td bgcolor="#00DDFF"><span class="tabletext"><?php printf("%.2f", $total_rej_time); ?></td>
 <td bgcolor="#00DDFF"><span class="tabletext"><?php printf("%.2f", $total_lossrgain_time); ?></td>
</tr>
</table>
<div id ='a51nx1div'>
<table border=1 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3>
<tr bgcolor="#FFFFFF">
 <td colspan=3 bgcolor="#FFFFFF" align="right"><span class="tabletext"><b>Machine Utilization Efficiency</b></td>
 <td colspan=5 bgcolor="#99FFFF"><span class="tabletext"><?php
 $machine_eff = ($total_actual_time+$total_rej_time) != 0? ((($total_est_time)/($total_actual_time+$total_rej_time))*100):0;
 printf("%.2f",$machine_eff);
 echo '%';
 ?></td>
</tr>

        <tr bgcolor="#FFFFFF">
            <td colspan=4><span class="labeltext">F8400-S</td>
            <td colspan=2><span class="labeltext">Rev No:0 &nbsp Rev Date:8-1-2009</td>
            <td colspan=2><span class="labeltext"></td>
        </tr>

</table>
</div>
</div>
<table>
<tr>
<td id="charta51nx1">
 <?php
      include_once 'ofc-library/open_flash_chart_object.php';
      $mc=urlencode('A51nx-1');
      //$wcond = htmlentities($cond);
      open_flash_chart_object( 1000, 350, 'https://'. $_SERVER['SERVER_NAME'] .'/wms/chart-prodneff1.php?mcname='.$mc.'&sdate='.$fromdate1.'&edate='.$todate1, false );
      //open_flash_chart_object( 1000, 350, 'http://'. $_SERVER['SERVER_NAME'] .'/wms_bk_jan5/gallerydata.php', false );

 ?>
</td>
</table>
</tr>
</div>

</td></tr>
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


<table border = 0 cellpadding=0 cellspacing=0 width=100%>
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
    $prev = " <a href=\"prodn_efficiency.php\">[Prev]</a> ";

    $first = " <a href=\"prodn_efficiency\">[First Page]</a> ";
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
  $next = " <a href=\"prodn_efficiency.php\">[Next]</a> ";

  $last = " <a href=\"prodn_efficiency.php\">[Last Page]</a> ";
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
