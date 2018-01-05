<?php
//==============================================
// Author: FSI                                 =
// Date-written = Jan 06, 2009                 =
// Filename: prodn_efficiency.php              =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 wms_sep14_2015               =
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
// ('pagename');
$page = "Reports";

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
 /*
   date_default_timezone_set('America/Los_Angeles');
   $today = date("F j, Y, g:i a");
   echo "$today\n";
   $today = date("F j, Y, g:i a");
   echo "$today\n";
  $todate1 = date("Y-m-d");
*/

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
function openPrintWindow(divids)
{
var divs="";
for(i=0;i<divids.length;i++)
{
divs+=((i!=0)?"&":"")+"divid"+i+"="+ divids[i];
}
window.open("print.html?"+divs,"PrintWindow","menubar=0,resizable=1"+",width=1000"+",height=650");
}
</script>

<title>Machine Utilization Efficiency Report</title>
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
<?php $newdisplay ->dispLinks(''); ?>
   </td></tr>
   </table>
<table width=100% border=0 cellpadding=0 cellspacing=0  >
  <tr bgcolor="DEDFDE">
      <td width="6"><img src="images/spacer.gif " width="6"></td>
      <td bgcolor="#FFFFFF">
          <table width=100% border=0 cellpadding=6 cellspacing=0  >
            <tr> <td>
            </tr>
            <tr>
            <td>
            </td></tr> -->
<table width=100% border=0>
<tr><td align="center"><span class="heading"><b>Machine Utlization Efficiency</b></td>

<!-- <tr><td></td> -->

</tr>
</table>
</tr>
  <td></td>
    </tr>
    </table>
<tr><tr>
<td>


  <form action="prodn_performance.php" method="post" enctype="multipart/form-data">
<select id="machine"  name="machine">
<option name ="" value="">Please Select</option>
<!--  <?php 

    $machine = $newreport->get_machine();
?> -->
  <!--    <option value="ALL" <?php echo $s;?> > ALL</option> -->
<?php 
    // while($myrow = mysql_fetch_array($machine))
    // {   
    //     if ($_POST['machine'] == $myrow[0]) 
    //     {
    //         $s="selected='selected'";
    //     }
    //     else 
    //     {
    //         $s="";
    //     }
      ?>

         <option value="ALL"  > ALL</option> 
          <option value="BMV 1"  > BMV 1</option>   
           <option value="DMG 3"  > DMG 3</option>  
           <option value="VMC 2"  > VMC 2</option>     
        <!-- <option value="<?php echo $myrow[0]; ?>" <?php echo $s;?>><?php echo $myrow[0]; ?></option> -->




     </select>
    <input type="hidden" value="<?php echo $myrow[0]; ?>" name="<?php echo $myrow[0]; ?>">
     <input type="submit" value="search" > 
</form>

<?php 

 if ($_POST['machine'] == NULL || $_POST['machine'] == '') {
    $_POST['machine'] = "ALL";
  }
  
  if ($_POST['machine'] != 'ALL' ) {

  if (isset($_POST['machine'])) {

    $machine_name = $_POST['machine'];

    
    $string = str_replace("-", "", $machine_name);
    $mac_nam = strtolower(preg_replace('/[^A-Za-z0-9\-]/', '', $string));
    $add_mac = strtolower($mac_nam).'d';

      $tblid = $mac_nam;
      $divid = $add_mac;
   


  ?>

  <div id="<?php echo strtolower($add_mac); ?>">
<table id="<?php echo strtolower($machine_name); ?>" width=100% border=1 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
        <tr>

        <td width=69% align="center" bgcolor="#00DDFF"><span class="heading"><b><?php echo $machine_name ?></b></td>

<?php
        $cond = "op.st_date >= '$fromdate1' and op.st_date <= '$todate1'";
        $_SESSION['ccond'] = $cond;

?>
</tr>
</table>


<table id="<?php echo strtolower($machine_name); ?>" width=100% border=1 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
        <tr>
         <td width=40% bgcolor="#FFFFFF">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
         <span class="labeltext"><b>From &nbsp&nbsp</b>
         <input type="text" id="f$tblid" name="f$tblid" size=10 value="<?php echo $fromdate1 ?>"
          style="background-color:#DDDDDD;" readonly="readonly"
          onkeypress="javascript: return checkenter(event)">
         <img src="images/bu-getdateicon.gif" alt="Get Date" onclick="GetDate('f$tblid')">
          <span class="labeltext"><b>&nbsp;&nbsp;To</b>
         <input type="text" id="t$tblid" name="t$tblid" size=10 value="<?php echo $todate1 ?>"
          style="background-color:#DDDDDD;" readonly="readonly"
          onkeypress="javascript: return checkenter(event)">


         <b>&nbsp;&nbsp;PRN &nbsp;&nbsp;</b>
         <input type="text" id="crn$tblid" name="crn$tblid" size=10 value="">
         <b>&nbsp;&nbsp;Shift &nbsp;&nbsp;</b>
         <input type="text" id="shift$tblid" name="shift$tblid" size=10 value="">
         <b>&nbsp;&nbsp;Stage &nbsp;&nbsp;</b>
         <input type="text" id="stage$tblid" name="stage$tblid" size=10 value="">

         <img src="images/bu-getdateicon.gif" alt="Get Date" onclick="GetDate('t$tblid')">
         <input type="image" name="Submit" src="images/bu-get.gif" value="Get"
            onclick="javascript: getmc_eff_performance('<?php echo strtolower($machine_name); ?>','<?php echo strtolower($add_mac); ?>','<?php echo strtolower($mac_nam); ?>','f$tblid','t$tblid',1,'crn$tblid','stage$tblid','shift$tblid')">

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

  <input type="image" src="images/export.gif" onclick="javascript: excel4mcutilize('<?php echo strtolower($machine_name); ?>','<?php echo strtolower($add_mac); ?>','<?php echo strtolower($mac_nam); ?>','f$tblid','t$tblid',1,'crn$tblid','stage$tblid','shift$tblid')">



        

<?php
        $cond = "op.st_date >= '$fromdate1' and op.st_date <= '$todate1'";
        $_SESSION['ccond'] = $cond;
?>
</tr>
</table>



<table width=100% border=1  cellpadding=3 cellspacing=1>
<tr>
<td  width=70% valign="top" >
<div id="$tbliddiv" style="max-height: 160px;  overflow: auto;"  >
<table style="table-layout: fixed" width=1180px border=1 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
        <tr>
            <td bgcolor="#00DDFF"  width=50px><span class="heading"><b>PRN</b></td>
            <td bgcolor="#00DDFF"  width=30px><span class="heading"><b>Stage</b></td>
            <td bgcolor="#00DDFF"  width=50px><span class="heading"><b>Qty Mfg</b></td>

            <td bgcolor="#00DDFF" width=50px><span class="heading"><b>Est<br>Setting<br>Time</b></td> 
            <td bgcolor="#00DDFF" width=50px><span class="heading"><b>Est<br>Running<br>Time</b></td> 

            <td bgcolor="#00DDFF"  width=50px><span class="heading"><b>Setting<br>Time</b></td> 
            <td bgcolor="#00DDFF"  width=50px><span class="heading"><b>Running<br>Time</b></td> 
            <td bgcolor="#00DDFF"  width=50px><span class="heading"><b>Total<br>Est<br>Time</b></td>
            <td bgcolor="#00DDFF"  width=50px><span class="heading"><b>Total<br>Actual<br>Time</b></td>
            <td bgcolor="#00DDFF"  width=50px><span class="heading"><b>RW/Rej<br>Qty</b></td>
            <td bgcolor="#00DDFF"  width=50px><span class="heading"><b>RW/Rej<br>Time</b></td>         
            <td bgcolor="#00DDFF"  width=50px><span class="heading"><b>Inspection<br>Time</b></td> 
            <td bgcolor="#00DDFF"  width=50px><span class="heading"><b>Maint<br>Time</b></td> 
            <td bgcolor="#00DDFF"  width=50px><span class="heading"><b>Breakdown<br>Time</b></td> 
            <td bgcolor="#00DDFF"  width=50px><span class="heading"><b>Others</b></td> 
            <td bgcolor="#00DDFF"  width=50px><span class="heading"><b>Lost or<br>Gained</b></td>
       </tr>
</table>

  <div style="width:1180px; height:100;border:" id="dataList">
  <table style="table-layout: fixed"  width=1180px border=1 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >

<?php
        $total_est_time = 0;
        $total_actual_time = 0;
        $total_rej_time = 0;
        $total_lossrgain_time = 0;

    $total_setting_time = 0;
    $total_running_time = 0;
    $total_breakdown_time = 0;
    $total_idle_time = 0;

    $esttotal_setting_time = 0;
    $esttotal_running_time = 0;

     $total_insp_time = 0;
     $total_maint_time = 0;

    $i=1;
        $result = $newreport->gettime4mu_eff_tab($machine_name,$cond);
        while ($myrow = mysql_fetch_row($result))
    {
      $setting_time=$myrow[5];
            $idle_time=$myrow[9];
      $breakdown_time=$myrow[10];
      $running_time=$myrow[11];
      $estsetting_time=$myrow[4];
      $estrunning_time=$myrow[7];

      $total_setting_time += $myrow[5];
        $total_running_time +=  $myrow[11];
        $total_breakdown_time += $myrow[10];
        $total_idle_time +=  $myrow[9];

          $esttotal_setting_time += $myrow[4];
          $esttotal_running_time += $myrow[7];

          $total_insp_time += $myrow[12];
         $total_maint_time += $myrow[13];

           ?>

    <tr>


      <td bgcolor="#FFFFFF" width=50px><span class="tabletext"><?php echo $myrow[1];
     $crn[]= $myrow[1];
     ?></td>

    <td bgcolor="#FFFFFF" width=30px><span class="tabletext"><?php echo $myrow[2] ?></td>

    <td bgcolor="#FFFFFF" width=50px><span class="tabletext"><?php printf('%.2f', $myrow[3]) ?></td>


    
      <td bgcolor="#FFFFFF" width=50px><span class="tabletext"><?php printf('%.2f', $myrow[4]) ?></td>

      <td bgcolor="#FFFFFF" width=50px><span class="tabletext"><?php printf('%.2f', $myrow[7]) ?></td>

      

      <td bgcolor="#FFFFFF" width=50px><span class="tabletext"><?php echo  $myrow[5] ?></td>

       <td bgcolor="#FFFFFF" width=50px><span class="tabletext"><?php echo  $myrow[11] ?></td>


       <td bgcolor="#FFFFFF" width=50px><span class="tabletext"><?php printf ("%.2f",($myrow[4]+$myrow[7]));
               $total_est_time += ($myrow[4]+$myrow[7]);
               $esttime[]= ($myrow[4]+$myrow[7]);
               ?></td>

        <td bgcolor="#FFFFFF" width=50px><span class="tabletext"><?php printf ("%.2f",($myrow[5]+$myrow[6]));
               $total_actual_time += ($myrow[5]+$myrow[6]);
               $actualtime[]= ($myrow[5]+$myrow[6])
               ?></td>


      <td bgcolor="#FFFFFF" width=50px><span class="tabletext"><?php echo  $myrow[8] ?></td>

      <td bgcolor="#FFFFFF" width=50px><span class="tabletext">
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

        <td bgcolor="#FFFFFF"  width=50px><span class="tabletext"><?php echo  $myrow[12] ?></td>

            <td bgcolor="#FFFFFF"  width=50px><span class="tabletext"><?php echo  $myrow[13] ?></td>

       <td bgcolor="#FFFFFF" width=50px><span class="tabletext"><?php echo  $myrow[10] ?></td>
        <td bgcolor="#FFFFFF" width=50px><span class="tabletext"><?php echo  $myrow[14] ?></td>


              <td bgcolor="#FFFFFF" width=50px><span class="tabletext">
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
</table>
</div>
</div>

 <table  width=1180px border=1 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
 <tr bgcolor="#FFFFFF">
 <td width=145px bgcolor="#FFFFFF" align="right"><span class="tabletext"><b>Total</b></td>

 <td width=50px bgcolor="#00DDFF"><span class="tabletext"><?php printf("%.2f", $esttotal_setting_time); ?></td>
 <td width=50px bgcolor="#00DDFF"><span class="tabletext"><?php printf("%.2f", $esttotal_running_time); ?></td>

 <td width=50px bgcolor="#00DDFF"><span class="tabletext"><?php printf("%.2f", $total_setting_time); ?></td>
 <td width=50px bgcolor="#00DDFF"><span class="tabletext"><?php printf("%.2f", $total_running_time); ?></td>

  <td width=50px bgcolor="#00DDFF"><span class="tabletext"><?php printf("%.2f", $total_est_time); ?></td>
   <td width=50px bgcolor="#00DDFF"><span class="tabletext"><?php printf("%.2f", $total_actual_time); ?></td>

 <td width=50px bgcolor="#00DDFF"><span class="tabletext">&nbsp;</td>
 <td width=50px bgcolor="#00DDFF"><span class="tabletext"><?php printf("%.2f", $total_rej_time); ?></td>

  <td width=50px bgcolor="#00DDFF"><span class="tabletext"><?php printf("%.2f", $total_insp_time); ?></td>
   <td width=50px bgcolor="#00DDFF"><span class="tabletext"><?php printf("%.2f", $total_maint_time); ?></td>

 <td width=50px bgcolor="#00DDFF"><span class="tabletext"><?php printf("%.2f", $total_breakdown_time); ?></td>

 <td width=50px bgcolor="#00DDFF"><span class="tabletext">&nbsp;</td>
 <td width=50px bgcolor="#00DDFF"><span class="tabletext"><?php printf("%.2f", $total_lossrgain_time); ?></td>
</tr>
</table>

<div id="bmv61div">

<table border=1 bgcolor="#FFFFFF" width="1180px" cellspacing=1 cellpadding=3>
<tr bgcolor="#FFFFFF">
<td colspan=10 bgcolor="#FFFFFF" align='right'><span class="tabletext"><b>Overall Equipment Efficiency</b></td>

<td colspan=2 bgcolor="#99FFFF"><span class="tabletext"><?php
 $machine_eff = ($total_actual_time+$total_rej_time) != 0? ((($total_est_time)/($total_actual_time+$total_rej_time))*100):0;
 printf("%.2f",$machine_eff);
 echo '%';
 ?></td>
</tr>

 <tr bgcolor="#FFFFFF">
 <td colspan=10><span class="labeltext">F8400-S</td>
 <td><span class="labeltext">Rev No:0 &nbsp Rev Date:8-1-2009</td>
 <td><span class="labeltext">FLUENTWMS</td>
 </tr>

</table>
</div>

<div id="bmv61divst" style="display:none">
<table border=1 bgcolor="#FFFFFF" width="1180px" cellspacing=1 cellpadding=3>
<tr bgcolor="#FFFFFF">
<td colspan=10 bgcolor="#FFFFFF" align='right'><span class="tabletext"><b>Machine Utilization Efficiency</b></td>
 <td colspan=2 bgcolor="#99FFFF"><span class="tabletext"><?php
  $total_setting_time!=0 && $esttotal_setting_time !=0 ?$machine_eff =(($esttotal_setting_time/$total_setting_time)*100):$machine_eff=0;
 printf("%.2f",$machine_eff);
 echo '%';
 ?></td>
</tr>

 <tr bgcolor="#FFFFFF">
 <td colspan=10><span class="labeltext">F8400-S</td>
 <td><span class="labeltext">Rev No:0 &nbsp Rev Date:8-1-2009</td>
 <td><span class="labeltext">FLUENTWMS</td>
 </tr>

</table>


</div>



<div id="bmv61divrt" style="display:none">
<table border=1 bgcolor="#FFFFFF" width="990px" cellspacing=1 cellpadding=3>
<tr bgcolor="#FFFFFF">
<td colspan=10 bgcolor="#FFFFFF" align='right'><span class="tabletext"><b>Machine Utilization Efficiency</b></td>
 <td colspan=2 bgcolor="#99FFFF"><span class="tabletext"><?php
  $total_running_time!=0 && $esttotal_running_time !=0 ?$machine_eff =(($esttotal_running_time/$total_running_time)*100):$machine_eff=0;
 printf("%.2f",$machine_eff);
 echo '%';
 ?></td>
</tr>

 <tr bgcolor="#FFFFFF">
 <td colspan=10><span class="labeltext">F8400-S</td>
 <td><span class="labeltext">Rev No:0 &nbsp Rev Date:8-1-2009</td>
 <td><span class="labeltext">FLUENTWMS</td>
 </tr>

</table>
</div>
</div>
</td>
<!-- <td width=40% valign="top">
<div id="layer<?echo $i?>">
<table id="myTable" width=100%  border=0 cellpadding=3 cellspacing=1 bgcolor="#FFFFFF">
<?php
include_once 'ofc-library/open_flash_chart_object.php';
open_flash_chart_object( 450, 200, 'http://'. $_SERVER['SERVER_NAME'] .'/fluenterp/pie_chart_prodn.php?setting_time='.$total_setting_time.'&idle_time='.$total_idle_time.'&breakdown_time='.$total_breakdown_time.'&running_time='.$total_running_time.'&machine=BMV 60-1',false );
?>
</table>

</div>
</td> -->
</tr>
</table>


<div style=" max-width: 100%; overflow: auto;">
<table width=100% border=1 cellpadding=3 cellspacing=1 bgcolor="#FFFFFF">
<tr>
<td align="right" bgcolor="#FFFFFF">
        <input type= "image" name="Print" src="images/printchart.gif" value="Get"
onclick='javascript: openPrintWindow(new Array("chart$tblid","bmv61div"))'>
</td>
</tr>
<tr>
<td id="chart$tblid">
 <?php
      include_once 'ofc-library/open_flash_chart_object.php';
      $mc=urlencode('BMV 1');
      open_flash_chart_object( '400%', 350, 'http://'. $_SERVER['SERVER_NAME'] .'/fluenterp/chart-prodneff1.php?mcname='.$mc.'&sdate='.$fromdate1.'&edate='.$todate1, false );

 ?>
</td>
</tr>
</table>
</div>
<div style=" max-width: 100%; overflow: auto;">
<table width=100% border=1 cellpadding=3 cellspacing=1 bgcolor="#FFFFFF">
<tr>
<td align="right" bgcolor="#FFFFFF">
        <input type= "image" name="Print" src="images/printchart.gif" value="Get"
onclick='javascript: openPrintWindow(new Array("chartst$tblid","bmv61divst"))'>
</td>
</tr>
<tr>
<td id="chartst$tblid">
 <?php
      include_once 'ofc-library/open_flash_chart_object.php';
      $mc=urlencode('BMV 1');
      open_flash_chart_object( 990, 350, 'http://'. $_SERVER['SERVER_NAME'] .'/fluenterp/chart-eststeff1.php?mcname='.$mc.'&sdate='.$fromdate1.'&edate='.$todate1, false );

 ?>
</td>
</tr>
</table>
</div>

<div style=" max-width: 100%; overflow: auto;">
<table width=100% border=1 cellpadding=3 cellspacing=1 bgcolor="#FFFFFF">
<tr>
<td align="right" bgcolor="#FFFFFF">
        <input type= "image" name="Print" src="images/printchart.gif" value="Get"
onclick='javascript: openPrintWindow(new Array("chartrt$tblid","bmv61divrt"))'>
</td>
</tr>

<tr>
<td id="chartrt$tblid">
 <?php
      include_once 'ofc-library/open_flash_chart_object.php';
      $mc=urlencode('BMV 1');
      open_flash_chart_object( 990, 350, 'http://'. $_SERVER['SERVER_NAME'] .'/fluenterp/chart-estrteff1.php?mcname='.$mc.'&sdate='.$fromdate1.'&edate='.$todate1, false );

 ?>
</td>
</table>
</div>

</tr>
</div>
</td>
</tr>

<tr><td>&nbsp;</td></tr>

<?php 
}

  }
  else
  { ?>

<div id='bmv601d'>
<table id='bmv601' width=100% border=1 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
        <tr>

        <td width=69% align="center" bgcolor="#00DDFF"><span class="heading"><b>BMV 1</b></td>
        
</td>
<?php
        $cond = "op.st_date >= '$fromdate1' and op.st_date <= '$todate1'";
        $_SESSION['ccond'] = $cond;
?>
</tr>
</table>



<table id="bmv601" width=100% border=1 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
        <tr>
         <td width=40% bgcolor="#FFFFFF">
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
         <span class="labeltext"><b>From &nbsp&nbsp</b>
         <input type="text" id="fbmv601" name="fbmv601" size=10 value="<?php echo $fromdate1 ?>"
          style="background-color:#DDDDDD;" readonly="readonly"
          onkeypress="javascript: return checkenter(event)">
         <img src="images/bu-getdateicon.gif" alt="Get Date" onclick="GetDate('fbmv601')">
          <span class="labeltext"><b>&nbsp;&nbsp;To</b>
         <input type="text" id="tbmv601" name="tbmv601" size=10 value="<?php echo $todate1 ?>"
          style="background-color:#DDDDDD;" readonly="readonly"
          onkeypress="javascript: return checkenter(event)">


         <b>&nbsp;&nbsp;PRN &nbsp;&nbsp;</b>
         <input type="text" id="crnbmv601" name="crnbmv601" size=10 value="">
         <b>&nbsp;&nbsp;Shift &nbsp;&nbsp;</b>
         <input type="text" id="shiftbmv601" name="shiftbmv601" size=10 value="">
         <b>&nbsp;&nbsp;Stage &nbsp;&nbsp;</b>
         <input type="text" id="stagebmv601" name="stagebmv601" size=10 value="">

         <img src="images/bu-getdateicon.gif" alt="Get Date" onclick="GetDate('tbmv601')">
         <input type="image" name="Submit" src="images/bu-get.gif" value="Get"
            onclick="javascript: getmc_eff_performance('BMV 1','bmv601d','bmv601','fbmv601','tbmv601',1,'crnbmv601','stagebmv601','shiftbmv601')">

            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

            <input type="image" src="images/export.gif" onclick="javascript: excel4mcutilize('BMV 1','bmv601d','bmv601','fbmv601','tbmv601',1,'crnbmv601','stagebmv601','shiftbmv601')">



     

<?php
        $cond = "op.st_date >= '$fromdate1' and op.st_date <= '$todate1'";
        $_SESSION['ccond'] = $cond;
?>
</tr>
</table>




<table width=100% border=1  cellpadding=3 cellspacing=1>
<tr>
<td  width=50% valign="top" >
<div id="bmv601div" style="max-height: 160px;  overflow: auto;"  >
<table style="table-layout: fixed" width=1180px border=1 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
        <tr>
            <td bgcolor="#00DDFF"  width=50px><span class="heading"><b>PRN</b></td>
            <td bgcolor="#00DDFF"  width=30px><span class="heading"><b>Stage</b></td>
            <td bgcolor="#00DDFF"  width=50px><span class="heading"><b>Qty Mfg</b></td>

            <td bgcolor="#00DDFF" width=50px><span class="heading"><b>Est<br>Setting<br>Time</b></td> 
            <td bgcolor="#00DDFF" width=50px><span class="heading"><b>Est<br>Running<br>Time</b></td> 

            <td bgcolor="#00DDFF"  width=50px><span class="heading"><b>Setting<br>Time</b></td> 
            <td bgcolor="#00DDFF"  width=50px><span class="heading"><b>Running<br>Time</b></td> 
            <td bgcolor="#00DDFF"  width=50px><span class="heading"><b>Total<br>Est<br>Time</b></td>
            <td bgcolor="#00DDFF"  width=50px><span class="heading"><b>Total<br>Actual<br>Time</b></td>
            <td bgcolor="#00DDFF"  width=50px><span class="heading"><b>RW/Rej<br>Qty</b></td>
            <td bgcolor="#00DDFF"  width=50px><span class="heading"><b>RW/Rej<br>Time</b></td>         
            <td bgcolor="#00DDFF"  width=50px><span class="heading"><b>Inspection<br>Time</b></td> 
            <td bgcolor="#00DDFF"  width=50px><span class="heading"><b>Maint<br>Time</b></td> 
            <td bgcolor="#00DDFF"  width=50px><span class="heading"><b>Breakdown<br>Time</b></td> 
            <td bgcolor="#00DDFF"  width=50px><span class="heading"><b>Others</b></td> 
            <td bgcolor="#00DDFF"  width=50px><span class="heading"><b>Lost or<br>Gained</b></td>
       </tr>
</table>

  <div style="width:900px; height:100;border:" id="dataList">
  <table style="table-layout: fixed"  width=1180px border=1 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >

<?php
        $total_est_time = 0;
        $total_actual_time = 0;
        $total_rej_time = 0;
        $total_lossrgain_time = 0;

		$total_setting_time = 0;
		$total_running_time = 0;
		$total_breakdown_time = 0;
		$total_idle_time = 0;

		$esttotal_setting_time = 0;
		$esttotal_running_time = 0;

		$i=1;
        $result = $newreport->gettime4mu_eff_tab('BMV 1',$cond);
        while ($myrow = mysql_fetch_row($result))
		{
			$setting_time=$myrow[5];
            $idle_time=$myrow[9];
			$breakdown_time=$myrow[10];
			$running_time=$myrow[11];
			$estsetting_time=$myrow[4];
			$estrunning_time=$myrow[7];

			$total_setting_time += $myrow[5];
		    $total_running_time +=  $myrow[11];
		    $total_breakdown_time += $myrow[10];
		    $total_idle_time +=  $myrow[9];

            $esttotal_setting_time += $myrow[4];
			$esttotal_running_time += $myrow[7];
           ?>

              <tr>


      <td bgcolor="#FFFFFF" width=50px><span class="tabletext"><?php echo $myrow[1];
     $crn[]= $myrow[1];
     ?></td>

    <td bgcolor="#FFFFFF" width=30px><span class="tabletext"><?php echo $myrow[2] ?></td>

    <td bgcolor="#FFFFFF" width=50px><span class="tabletext"><?php printf('%.2f', $myrow[3]) ?></td>


    
      <td bgcolor="#FFFFFF" width=50px><span class="tabletext"><?php printf('%.2f', $myrow[4]) ?></td>

      <td bgcolor="#FFFFFF" width=50px><span class="tabletext"><?php printf('%.2f', $myrow[7]) ?></td>

      

      <td bgcolor="#FFFFFF" width=50px><span class="tabletext"><?php echo  $myrow[5] ?></td>

       <td bgcolor="#FFFFFF" width=50px><span class="tabletext"><?php echo  $myrow[11] ?></td>


       <td bgcolor="#FFFFFF" width=50px><span class="tabletext"><?php printf ("%.2f",($myrow[4]+$myrow[7]));
               $total_est_time += ($myrow[4]+$myrow[7]);
               $esttime[]= ($myrow[4]+$myrow[7]);
               ?></td>

        <td bgcolor="#FFFFFF" width=50px><span class="tabletext"><?php printf ("%.2f",($myrow[5]+$myrow[6]));
               $total_actual_time += ($myrow[5]+$myrow[6]);
               $actualtime[]= ($myrow[5]+$myrow[6])
               ?></td>


      <td bgcolor="#FFFFFF" width=50px><span class="tabletext"><?php echo  $myrow[8] ?></td>

      <td bgcolor="#FFFFFF" width=50px><span class="tabletext">
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

        <td bgcolor="#FFFFFF"  width=50px><span class="tabletext"><?php echo  $myrow[12] ?></td>

            <td bgcolor="#FFFFFF"  width=50px><span class="tabletext"><?php echo  $myrow[13] ?></td>

       <td bgcolor="#FFFFFF" width=50px><span class="tabletext"><?php echo  $myrow[10] ?></td>
        <td bgcolor="#FFFFFF" width=50px><span class="tabletext"><?php echo  $myrow[14] ?></td>


              <td bgcolor="#FFFFFF" width=50px><span class="tabletext">
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
</table>
</div>
</div>

 <table  width=1180px border=1 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
 <tr bgcolor="#FFFFFF">
 <td width=145px bgcolor="#FFFFFF" align="right"><span class="tabletext"><b>Total</b></td>

 <td width=50px bgcolor="#00DDFF"><span class="tabletext"><?php printf("%.2f", $esttotal_setting_time); ?></td>
 <td width=50px bgcolor="#00DDFF"><span class="tabletext"><?php printf("%.2f", $esttotal_running_time); ?></td>

 <td width=50px bgcolor="#00DDFF"><span class="tabletext"><?php printf("%.2f", $total_setting_time); ?></td>
 <td width=50px bgcolor="#00DDFF"><span class="tabletext"><?php printf("%.2f", $total_running_time); ?></td>

  <td width=50px bgcolor="#00DDFF"><span class="tabletext"><?php printf("%.2f", $total_est_time); ?></td>
   <td width=50px bgcolor="#00DDFF"><span class="tabletext"><?php printf("%.2f", $total_actual_time); ?></td>

 <td width=50px bgcolor="#00DDFF"><span class="tabletext">&nbsp;</td>
 <td width=50px bgcolor="#00DDFF"><span class="tabletext"><?php printf("%.2f", $total_rej_time); ?></td>

  <td width=50px bgcolor="#00DDFF"><span class="tabletext"><?php printf("%.2f", $total_insp_time); ?></td>
   <td width=50px bgcolor="#00DDFF"><span class="tabletext"><?php printf("%.2f", $total_maint_time); ?></td>

 <td width=50px bgcolor="#00DDFF"><span class="tabletext"><?php printf("%.2f", $total_breakdown_time); ?></td>

 <td width=50px bgcolor="#00DDFF"><span class="tabletext">&nbsp;</td>
 <td width=50px bgcolor="#00DDFF"><span class="tabletext"><?php printf("%.2f", $total_lossrgain_time); ?></td>
</tr>
</table>

<div id="bmv61div">

<table border=1 bgcolor="#FFFFFF" width="1180px" cellspacing=1 cellpadding=3>
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
 <td><span class="labeltext">fluenterp</td>
 </tr>

</table>
</div>

<div id="bmv61divst" style="display:none">
<table border=1 bgcolor="#FFFFFF" width="990px" cellspacing=1 cellpadding=3>
<tr bgcolor="#FFFFFF">
<td colspan=10 bgcolor="#FFFFFF" align='right'><span class="tabletext"><b>Machine Utilization Efficiency</b></td>
 <td colspan=2 bgcolor="#99FFFF"><span class="tabletext"><?php
  $total_setting_time!=0 && $esttotal_setting_time !=0 ?$machine_eff =(($esttotal_setting_time/$total_setting_time)*100):$machine_eff=0;
 printf("%.2f",$machine_eff);
 echo '%';
 ?></td>
</tr>

 <tr bgcolor="#FFFFFF">
 <td colspan=10><span class="labeltext">F8400-S</td>
 <td><span class="labeltext">Rev No:0 &nbsp Rev Date:8-1-2009</td>
 <td><span class="labeltext">fluenterp</td>
 </tr>

</table>


</div>



<div id="bmv61divrt" style="display:none">
<table border=1 bgcolor="#FFFFFF" width="990px" cellspacing=1 cellpadding=3>
<tr bgcolor="#FFFFFF">
<td colspan=10 bgcolor="#FFFFFF" align='right'><span class="tabletext"><b>Machine Utilization Efficiency</b></td>
 <td colspan=2 bgcolor="#99FFFF"><span class="tabletext"><?php
  $total_running_time!=0 && $esttotal_running_time !=0 ?$machine_eff =(($esttotal_running_time/$total_running_time)*100):$machine_eff=0;
 printf("%.2f",$machine_eff);
 echo '%';
 ?></td>
</tr>

 <tr bgcolor="#FFFFFF">
 <td colspan=10><span class="labeltext">F8400-S</td>
 <td><span class="labeltext">Rev No:0 &nbsp Rev Date:8-1-2009</td>
 <td><span class="labeltext">fluenterp</td>
 </tr>

</table>
</div>
</div>
</td>
<!-- <td width=40% valign="top">
<div id="layer<?echo $i?>">
<table id="myTable" width=100%  border=0 cellpadding=3 cellspacing=1 bgcolor="#FFFFFF">
<?php
include_once 'ofc-library/open_flash_chart_object.php';
open_flash_chart_object( 450, 200, 'http://'. $_SERVER['SERVER_NAME'] .'/fluenterp/pie_chart_prodn.php?setting_time='.$total_setting_time.'&idle_time='.$total_idle_time.'&breakdown_time='.$total_breakdown_time.'&running_time='.$total_running_time.'&machine=BMV 1',false );
?>
</table>

</div>
</td> -->
</tr>
</table>


<div style=" max-width: 100%; overflow: auto;">
<table width=100% border=1 cellpadding=3 cellspacing=1 bgcolor="#FFFFFF">
<tr>
<td align="right" bgcolor="#FFFFFF">
        <input type= "image" name="Print" src="images/printchart.gif" value="Get"
onclick='javascript: openPrintWindow(new Array("chartbmv601","bmv61div"))'>
</td>
</tr>
<tr>
<td id="chartbmv601">
 <?php
      include_once 'ofc-library/open_flash_chart_object.php';
      $mc=urlencode('BMV 1');
      open_flash_chart_object( '400%', 350, 'http://'. $_SERVER['SERVER_NAME'] .'/fluenterp/chart-prodneff1.php?mcname='.$mc.'&sdate='.$fromdate1.'&edate='.$todate1, false );

 ?>
</td>
</tr>
</table>
</div>
<div style=" max-width: 100%; overflow: auto;">
<table width=100% border=1 cellpadding=3 cellspacing=1 bgcolor="#FFFFFF">
<tr>
<td align="right" bgcolor="#FFFFFF">
        <input type= "image" name="Print" src="images/printchart.gif" value="Get"
onclick='javascript: openPrintWindow(new Array("chartstbmv601","bmv61divst"))'>
</td>
</tr>
<tr>
<td id="chartstbmv601">
 <?php
      include_once 'ofc-library/open_flash_chart_object.php';
      $mc=urlencode('BMV 1');
      open_flash_chart_object( 990, 350, 'http://'. $_SERVER['SERVER_NAME'] .'/fluenterp/chart-eststeff1.php?mcname='.$mc.'&sdate='.$fromdate1.'&edate='.$todate1, false );

 ?>
</td>
</tr>
</table>
</div>

<div style=" max-width: 100%; overflow: auto;">
<table width=100% border=1 cellpadding=3 cellspacing=1 bgcolor="#FFFFFF">
<tr>
<td align="right" bgcolor="#FFFFFF">
        <input type= "image" name="Print" src="images/printchart.gif" value="Get"
onclick='javascript: openPrintWindow(new Array("chartrtbmv601","bmv61divrt"))'>
</td>
</tr>

<tr>
<td id="chartrtbmv601">
 <?php
      include_once 'ofc-library/open_flash_chart_object.php';
      $mc=urlencode('BMV 1');
      open_flash_chart_object( 990, 350, 'http://'. $_SERVER['SERVER_NAME'] .'/fluenterp/chart-estrteff1.php?mcname='.$mc.'&sdate='.$fromdate1.'&edate='.$todate1, false );

 ?>
</td>
</table>
</div>

</tr>
</div>
</td>
</tr>

<tr><td>&nbsp;</td></tr>

<tr>
<td>
<div id='bmv602d'>
<table id='bmv602' width=100% border=1 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
        <tr>

        <td width=69% align="center" bgcolor="#00DDFF"><span class="heading"><b>DMG 3</b></td>


</tr>
</table>


<table id="bmv602" width=100% border=1 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
        <tr>
         <td width=40% bgcolor="#FFFFFF">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
         <span class="labeltext"><b>From &nbsp&nbsp</b>
         <input type="text" id="fbmv602" name="fbmv602" size=10 value="<?php echo $fromdate1 ?>"
          style="background-color:#DDDDDD;" readonly="readonly"
          onkeypress="javascript: return checkenter(event)">
         <img src="images/bu-getdateicon.gif" alt="Get Date" onclick="GetDate('fbmv602')">
          <span class="labeltext"><b>&nbsp;&nbsp;To</b>
         <input type="text" id="tbmv602" name="tbmv602" size=10 value="<?php echo $todate1 ?>"
          style="background-color:#DDDDDD;" readonly="readonly"
          onkeypress="javascript: return checkenter(event)">


         <b>&nbsp;&nbsp;PRN &nbsp;&nbsp;</b>
         <input type="text" id="crnbmv602" name="crnbmv602" size=10 value="">
         <b>&nbsp;&nbsp;Shift &nbsp;&nbsp;</b>
         <input type="text" id="shiftbmv602" name="shiftbmv602" size=10 value="">
         <b>&nbsp;&nbsp;Stage &nbsp;&nbsp;</b>
         <input type="text" id="stagebmv602" name="stagebmv602" size=10 value="">

         <img src="images/bu-getdateicon.gif" alt="Get Date" onclick="GetDate('tbmv602')">
         <input type="image" name="Submit" src="images/bu-get.gif" value="Get"
            onclick="javascript: getmc_eff_performance('BMV 60-2','bmv602d','bmv602','fbmv602','tbmv602',1,'crnbmv602','stagebmv602','shiftbmv602')">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <input type="image" src="images/export.gif" onclick="javascript: excel4mcutilize('BMV 60-2','bmv602d','bmv602','fbmv602','tbmv602',1,'crnbmv602','stagebmv602','shiftbmv602')">



<?php
        $cond = "op.st_date >= '$fromdate1' and op.st_date <= '$todate1'";
        $_SESSION['ccond'] = $cond;
?>
</tr>
</table>


<table width=100% border=1 cellpadding=3 cellspacing=1>
<tr>
<td  width=60% valign="top">
<div id="bmv602div"  style="max-height: 160px;  overflow: auto;"  >
<table style="table-layout: fixed" width=1180px border=1 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
<tr>
            <td bgcolor="#00DDFF"  width=50px><span class="heading"><b>PRN</b></td>
            <td bgcolor="#00DDFF"  width=30px><span class="heading"><b>Stage</b></td>
            <td bgcolor="#00DDFF"  width=50px><span class="heading"><b>Qty Mfg</b></td>

            <td bgcolor="#00DDFF" width=50px><span class="heading"><b>Est<br>Setting<br>Time</b></td> 
            <td bgcolor="#00DDFF" width=50px><span class="heading"><b>Est<br>Running<br>Time</b></td> 

            <td bgcolor="#00DDFF"  width=50px><span class="heading"><b>Setting<br>Time</b></td> 
            <td bgcolor="#00DDFF"  width=50px><span class="heading"><b>Running<br>Time</b></td> 
            <td bgcolor="#00DDFF"  width=50px><span class="heading"><b>Total<br>Est<br>Time</b></td>
            <td bgcolor="#00DDFF"  width=50px><span class="heading"><b>Total<br>Actual<br>Time</b></td>
            <td bgcolor="#00DDFF"  width=50px><span class="heading"><b>RW/Rej<br>Qty</b></td>
            <td bgcolor="#00DDFF"  width=50px><span class="heading"><b>RW/Rej<br>Time</b></td>         
            <td bgcolor="#00DDFF"  width=50px><span class="heading"><b>Inspection<br>Time</b></td> 
            <td bgcolor="#00DDFF"  width=50px><span class="heading"><b>Maint<br>Time</b></td> 
            <td bgcolor="#00DDFF"  width=50px><span class="heading"><b>Breakdown<br>Time</b></td> 
            <td bgcolor="#00DDFF"  width=50px><span class="heading"><b>Others</b></td> 
            <td bgcolor="#00DDFF"  width=50px><span class="heading"><b>Lost or<br>Gained</b></td>
  </tr>
  </table>
  <div style="width:900px; height:100;border:" id="dataList">
  <table style="table-layout: fixed" width=900px border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >

<?php
        $total_est_time = 0;
        $total_actual_time = 0;
        $total_rej_time = 0;
        $total_lossrgain_time = 0;

	$total_setting_time = 0;
	$total_running_time = 0;
	$total_breakdown_time = 0;
	$total_idle_time = 0;

	$esttotal_setting_time = 0;
	$esttotal_running_time = 0;

		$i=1;
        $result = $newreport->gettime4mu_eff_tab('BMV 60-2',$cond);
        while ($myrow = mysql_fetch_row($result)) {
			$setting_time=$myrow[5];
            $idle_time=$myrow[9];
			$breakdown_time=$myrow[10];
			$running_time=$myrow[11];
			$estsetting_time=$myrow[4];
			$estrunning_time=$myrow[7];


			$total_setting_time += $myrow[5];
		    $total_running_time +=  $myrow[11];
		    $total_breakdown_time += $myrow[10];
		    $total_idle_time +=  $myrow[9];

			$esttotal_setting_time += $myrow[4];
			$esttotal_running_time += $myrow[7];

?>
            <tr>


      <td bgcolor="#FFFFFF" width=50px><span class="tabletext"><?php echo $myrow[1];
     $crn[]= $myrow[1];
     ?></td>

    <td bgcolor="#FFFFFF" width=30px><span class="tabletext"><?php echo $myrow[2] ?></td>

    <td bgcolor="#FFFFFF" width=50px><span class="tabletext"><?php printf('%.2f', $myrow[3]) ?></td>


    
      <td bgcolor="#FFFFFF" width=50px><span class="tabletext"><?php printf('%.2f', $myrow[4]) ?></td>

      <td bgcolor="#FFFFFF" width=50px><span class="tabletext"><?php printf('%.2f', $myrow[7]) ?></td>

      

      <td bgcolor="#FFFFFF" width=50px><span class="tabletext"><?php echo  $myrow[5] ?></td>

       <td bgcolor="#FFFFFF" width=50px><span class="tabletext"><?php echo  $myrow[11] ?></td>


       <td bgcolor="#FFFFFF" width=50px><span class="tabletext"><?php printf ("%.2f",($myrow[4]+$myrow[7]));
               $total_est_time += ($myrow[4]+$myrow[7]);
               $esttime[]= ($myrow[4]+$myrow[7]);
               ?></td>

        <td bgcolor="#FFFFFF" width=50px><span class="tabletext"><?php printf ("%.2f",($myrow[5]+$myrow[6]));
               $total_actual_time += ($myrow[5]+$myrow[6]);
               $actualtime[]= ($myrow[5]+$myrow[6])
               ?></td>


      <td bgcolor="#FFFFFF" width=50px><span class="tabletext"><?php echo  $myrow[8] ?></td>

      <td bgcolor="#FFFFFF" width=50px><span class="tabletext">
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

        <td bgcolor="#FFFFFF"  width=50px><span class="tabletext"><?php echo  $myrow[12] ?></td>

            <td bgcolor="#FFFFFF"  width=50px><span class="tabletext"><?php echo  $myrow[13] ?></td>

       <td bgcolor="#FFFFFF" width=50px><span class="tabletext"><?php echo  $myrow[10] ?></td>
        <td bgcolor="#FFFFFF" width=50px><span class="tabletext"><?php echo  $myrow[14] ?></td>


              <td bgcolor="#FFFFFF" width=50px><span class="tabletext">
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
</table>
</div>
</div>

 <table  width=1180px border=1 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
 <tr bgcolor="#FFFFFF">
 <td width=145px bgcolor="#FFFFFF" align="right"><span class="tabletext"><b>Total</b></td>

 <td width=50px bgcolor="#00DDFF"><span class="tabletext"><?php printf("%.2f", $esttotal_setting_time); ?></td>
 <td width=50px bgcolor="#00DDFF"><span class="tabletext"><?php printf("%.2f", $esttotal_running_time); ?></td>

 <td width=50px bgcolor="#00DDFF"><span class="tabletext"><?php printf("%.2f", $total_setting_time); ?></td>
 <td width=50px bgcolor="#00DDFF"><span class="tabletext"><?php printf("%.2f", $total_running_time); ?></td>

  <td width=50px bgcolor="#00DDFF"><span class="tabletext"><?php printf("%.2f", $total_est_time); ?></td>
   <td width=50px bgcolor="#00DDFF"><span class="tabletext"><?php printf("%.2f", $total_actual_time); ?></td>

 <td width=50px bgcolor="#00DDFF"><span class="tabletext">&nbsp;</td>
 <td width=50px bgcolor="#00DDFF"><span class="tabletext"><?php printf("%.2f", $total_rej_time); ?></td>

  <td width=50px bgcolor="#00DDFF"><span class="tabletext"><?php printf("%.2f", $total_insp_time); ?></td>
   <td width=50px bgcolor="#00DDFF"><span class="tabletext"><?php printf("%.2f", $total_maint_time); ?></td>

 <td width=50px bgcolor="#00DDFF"><span class="tabletext"><?php printf("%.2f", $total_breakdown_time); ?></td>

 <td width=50px bgcolor="#00DDFF"><span class="tabletext">&nbsp;</td>
 <td width=50px bgcolor="#00DDFF"><span class="tabletext"><?php printf("%.2f", $total_lossrgain_time); ?></td>
</tr>
</table>

<div id="bmv62div">
<table border=1 bgcolor="#FFFFFF" width="990px" cellspacing=1 cellpadding=3>
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
 <td><span class="labeltext">FLUENTWMS</td>
 </tr>

</table>
</div>

<div id="bmv62divst" style="display:none">
<table border=1 bgcolor="#FFFFFF" width="990px" cellspacing=1 cellpadding=3>
<tr bgcolor="#FFFFFF">
<td colspan=10 bgcolor="#FFFFFF" align='right'><span class="tabletext"><b>Machine Utilization Efficiency</b></td>
 <td colspan=2 bgcolor="#99FFFF"><span class="tabletext"><?php
 $total_setting_time!=0 && $esttotal_setting_time !=0 ?$machine_eff =(($esttotal_setting_time/$total_setting_time)*100):$machine_eff=0;
 printf("%.2f",$machine_eff);
 echo '%';
 ?></td>
</tr>

 <tr bgcolor="#FFFFFF">
 <td colspan=10><span class="labeltext">F8400-S</td>
 <td><span class="labeltext">Rev No:0 &nbsp Rev Date:8-1-2009</td>
 <td><span class="labeltext">FLUENTWMS</td>
 </tr>

</table>
</div>




<div id="bmv62divrt" style="display:none">
<table border=1 bgcolor="#FFFFFF" width="990px" cellspacing=1 cellpadding=3>
<tr bgcolor="#FFFFFF">
<td colspan=10 bgcolor="#FFFFFF" align='right'><span class="tabletext"><b>Machine Utilization Efficiency</b></td>
 <td colspan=2 bgcolor="#99FFFF"><span class="tabletext"><?php
  $total_running_time!=0 && $esttotal_running_time !=0 ?$machine_eff =(($esttotal_running_time/$total_running_time)*100):$machine_eff=0;
 printf("%.2f",$machine_eff);
 echo '%';
 ?></td>
</tr>

 <tr bgcolor="#FFFFFF">
 <td colspan=10><span class="labeltext">F8400-S</td>
 <td><span class="labeltext">Rev No:0 &nbsp Rev Date:8-1-2009</td>
 <td><span class="labeltext">FLUENTWMS</td>
 </tr>

</table>
</div>
</div>
</td>
<!-- <td width=40% valign="top">
<div id="layer<?echo $i?>">
<table id="myTable" width=20%  border=0 cellpadding=3 cellspacing=1 bgcolor="#FFFFFF">
<?php
include_once 'ofc-library/open_flash_chart_object.php';
open_flash_chart_object( 450, 200, 'http://'. $_SERVER['SERVER_NAME'] .'/fluenterp/pie_chart_prodn.php?setting_time='.$total_setting_time.'&idle_time='.$total_idle_time.'&breakdown_time='.$total_breakdown_time.'&running_time='.$total_running_time.'&machine=BMV 60-2',false );
?>
</table>
</div>
</td> -->
</tr>
</table>

<table width=100% border=1 cellpadding=3 cellspacing=1>
<tr>
<td align="right" bgcolor="#FFFFFF">
        <input type= "image" name="Print" src="images/printchart.gif" value="Get"
onclick='javascript: openPrintWindow(new Array("chartbmv602","bmv62div"))'>
</td>
</tr>
<tr>
<td id="chartbmv602">
 <?php
      include_once 'ofc-library/open_flash_chart_object.php';
      $mc=urlencode('DMG 3');
      open_flash_chart_object( 990, 350, 'http://'. $_SERVER['SERVER_NAME'] .'/fluenterp/chart-prodneff1.php?mcname='.$mc.'&sdate='.$fromdate1.'&edate='.$todate1, false );

 ?>
</td>
</table>


<table width=100% border=1 cellpadding=3 cellspacing=1>
<tr>
<td align="right" bgcolor="#FFFFFF">
        <input type= "image" name="Print" src="images/printchart.gif" value="Get"
onclick='javascript: openPrintWindow(new Array("chartstbmv602","bmv62divst"))'>
</td>
</tr>
<tr>
<td id="chartstbmv602">
 <?php
      include_once 'ofc-library/open_flash_chart_object.php';
      $mc=urlencode('DMG 3');
      open_flash_chart_object( 990, 350, 'http://'. $_SERVER['SERVER_NAME'] .'/fluenterp/chart-eststeff1.php?mcname='.$mc.'&sdate='.$fromdate1.'&edate='.$todate1, false );

 ?>
</td>
</table>


<table width=100% border=1 cellpadding=3 cellspacing=1>
<tr>
<td align="right" bgcolor="#FFFFFF">
        <input type= "image" name="Print" src="images/printchart.gif" value="Get"
onclick='javascript: openPrintWindow(new Array("chartrtbmv602","bmv62divrt"))'>
</td>
</tr>
<tr>
<td id="chartrtbmv602">
 <?php
      include_once 'ofc-library/open_flash_chart_object.php';
      $mc=urlencode('DMG 3');
      open_flash_chart_object( 990, 350, 'http://'. $_SERVER['SERVER_NAME'] .'/fluenterp/chart-estrteff1.php?mcname='.$mc.'&sdate='.$fromdate1.'&edate='.$todate1, false );

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


 
</td>
<!--<td width="6"><img src="images/spacer.gif " width="6"></td>
</tr>
<tr bgcolor="DEDFDE">
<td width="6"><img src="images/box-left-bottom.gif"></td>
<td><img src="images/spacer.gif " height="6"></td>
<td width="6"><img src="images/box-right-bottom.gif"></td>
</tr>-->
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



<?php  } ?>

</body>
</html>
