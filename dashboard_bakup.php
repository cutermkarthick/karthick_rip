<?php
//==============================================
// Author: FSI
// Date-written = July 02, 2013
// Filename: dashboard1.php
// Copyright (C) FluentSoft Inc.
// Contact bmandyam@fluentsoft.com
// Revision: v1.0 WMS
// Dashboard
//==============================================
session_start();
header("Cache-control: private");
if ( !isset ( $_SESSION['user'] ) )
{
   header ( "Location: login.php" );
}
$userid = $_SESSION['user'];
$_SESSION['pagename'] = 'reports';
////sessio_register('pagename');
include_once('classes/loginClass.php');
$newlogin = new userlogin;
$newlogin->dbconnect();
$company = $_REQUEST['company'];
$from = $_REQUEST['from'];
$to = $_REQUEST['to'];
$partnum = $_REQUEST['partnum'];
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
$page = "Reports";
// First include the class definition*/
include('classes/reportClass.php');
include('classes/displayClass.php');
include('classes/helperClass.php');

$newreport = new report;
$newdisplay = new display;
$newhelper = new helper;

$fdate1=$_REQUEST['fdate1'];
$fdate2=$_REQUEST['fdate2'];
$fdate3=$_REQUEST['fdate3'];
$fdate4=$_REQUEST['fdate4'];
$fdate5=$_REQUEST['fdate5'];
$fdate6=$_REQUEST['fdate6'];

$partnum=$_REQUEST['partnum'];
$customer = $_REQUEST['customer'];
$wonum = $_REQUEST['wonum'];
$crn=$_REQUEST['crn'];
$start_date=$_REQUEST['frm'];

$end_date=$_REQUEST['to'];

$todate1 = date("Y-m-d");
$today = split('-',$todate1);

$days = $today[2]-1;

$fromdate1 = date("Y-m-d",strtotime("-$days days"));
//echo $fromdate1;
//echo date("Y-m-d");
$from=($fdate1=='')?$fromdate1:$fdate1;
$to=($fdate2=='')?$todate1:$fdate2;
$fromsale=($fdate3=='')?$fromdate1:$fdate3;
$tosale=($fdate4=='')?$todate1:$fdate4;
$fromeff=($fdate5=='')?$fromdate1:$fdate5;
$toeff=($fdate6=='')?$todate1:$fdate6;
$end_date = date("Y-m-d");
$start_date = date("Y-m-d",strtotime("-$days days"));

$first_day_of_week = date('Y-m-d', strtotime('Last Monday', time()));
$last_day_of_week = date('Y-m-d', strtotime('Next Sunday', time()));

?>
<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/report.js"></script>
<script language="javascript" src="scripts/jquery.js"></script>

<html>
<head>
<title>HEART BEAT</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">
<form  action='dashboard.php' method='post' enctype='multipart/form-data'>
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
<table width=100% border=0 cellpadding=0 cellspacing=0  >
<tr><td></td></tr>
<tr>
<td>
<?php $newdisplay ->dispLinks(''); ?>
</td></tr> -->


<table  style="border:1px solid black" cellpadding=6 cellspacing=0  style="width:100%">
<tr>
<td align="center" colspan=2 bgcolor="#bababa"><span class="pageheading"><b>HEARTBEAT</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;
<b>PRN:</b>&nbsp;
<input type="text" size=10% name="crn_global" id="crn_global" value="prn1"><b>&nbsp&nbsp;From &nbsp&nbsp</b>
         <input type="text" id="frm_global" name="frm_global" size=10 value="<?php echo $start_date ?>"
          style="background-color:#DDDDDD;">
         <img src="images/bu-getdateicon.gif" alt="Get Date" onclick="GetDate('frm_global')">
          <span class="labeltext"><b>&nbsp;&nbsp;To</b>
         <input type="text" id="to_global" name="to_global" size=10 value="<?php echo $end_date ?>"
          style="background-color:#DDDDDD;">
         <img src="images/bu-getdateicon.gif" alt="Get Date" onclick="GetDate('to_global')">   
 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="images/bu-get.gif" value="Get" 
            onclick="javascript: getcrn_globalreport()"></td>

</tr>
<tr><td>

<table style="border-right:2px solid black" width=100%  cellpadding=6 cellspacing=1 height='320px'>
<tr><td valign='top'>
<div id='customerdiv' style="width:524px;overflow-y:auto;height:300;">
<table  width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDFDF" >
<tr>
<td colspan=8 align="center" bgcolor="#bababa"><span class="heading"><b>CRN PERFORMANCE</b></td>
</tr>
<td valign='top' bgcolor="#FFFFFF" width='15%'><span class="tabletext"><b>PRN:</b>&nbsp;
<input type="text" size=10% name="crn" id="crn" value="prn1"></td>
<td  bgcolor="#FFFFFF" colspan=7><span class="labeltext"><b>From &nbsp&nbsp</b>
         <input type="text" id="frm" name="frm" size=10 value="<?php echo $start_date ?>"
          style="background-color:#DDDDDD;">
         <img src="images/bu-getdateicon.gif" alt="Get Date" onclick="GetDate('frm')">
          <span class="labeltext"><b>&nbsp;&nbsp;To</b>
         <input type="text" id="to" name="to" size=10 value="<?php echo $end_date ?>"
          style="background-color:#DDDDDD;">
         <img src="images/bu-getdateicon.gif" alt="Get Date" onclick="GetDate('to')">   
 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="images/bu-get.gif" value="Get" 
            onclick="javascript: getcrn_report('customerdiv')"></td>
</tr>

<tr bgcolor="#FFFFFF">
<td valign='top' colspan=8>
<tr bgcolor="#FFCC00">
<td  width='20px' rowspan=3 align='center' bgcolor="#66cc33"><span class="tabletext" align='center'><b>PRN</b></td>
<td  width='20px' colspan=3 align='center' bgcolor="#3399ff"><span class="tabletext" align='center'><b>WORK ORDER</b></td>
<td   width='20px' colspan=4 align='center' bgcolor="#FFA500"><span class="tabletext" align='center'><b>NC</b></td>
</tr>


<tr>
<td  bgcolor="#3399ff" width='20px' align="center"><span class="tabletext"><b>Book Date</b></td>
<td  bgcolor="#3399ff" width='20px' align="center"><span class="tabletext"><b>Qty</b></td>
<td bgcolor="#3399ff" width='20px' align="center"><span class="tabletext"><b>Acc</b></td>
<td  bgcolor="#FFA500" width='10px' align="center"><span class="tabletext"><b>Qty<br></b></td>
<td  bgcolor="#FFA500" width='10px' align="center"><span class="tabletext"><b>FI<br></b></td>
<td  bgcolor="#FFA500" width='10px' align="center"><span class="tabletext"><b>Inpro<br></b></td>
<td  bgcolor="#FFA500" width='10px' align="center"><span class="tabletext"><b>Cust Rej.<br></b></td>
</tr>

<tr bgcolor="#FFFFFF">
<?php
$cond='';
$start_array=explode('-',$start_date);
$start_year=$start_array[0];
$start_month=$start_array[1];
$end_array=explode('-',$end_date);
$end_year=$end_array[0];
$end_month=$end_array[1];
$crn1='prn1';
if($start_year == $end_year)
{
   for($j=$start_month;$j<=$end_month;$j++)
   {
       $monthName = date("F", mktime(0, 0, 0, $j, 10));
       $Date=$monthName.','.$start_year;  
       if(intval($j) <=9)
        $j='0'.intval($j);
           $cond1="w.crn_num like '$crn1%' and w.book_date like '$start_year-$j%'";               
       $result3 = $newreport->check_4_FI_INSP($cond1);
       $myrow4qty=mysql_fetch_row($result3);
      
       if($myrow4qty[6]!='')
     {
      printf('<tr bgcolor="#FFFFFF">
        <td width="20px" align="center"><span class="tabletext">%s</td>',$myrow4qty[6]);
    printf('<td width="20px" align="center"><span class="tabletext">%s</td>',$Date);
    printf('<td width="10px" align="center"><span class="tabletext">%s</td>
        <td width="10px" align="center"><span class="tabletext">%s</td>',$myrow4qty[0],$myrow4qty[1]); 
    printf('<td width="10px" align="center"><span class="tabletext">%s</td>',$myrow4qty[7]);
    printf('<td width="10px" align="center"><span class="tabletext">%s</td>',$myrow4qty[3]);
    printf('<td width="10px" align="center"><span class="tabletext">%s</td>',$myrow4qty[4]);
    printf('<td width="10px" align="center"><span class="tabletext">%s</td></tr>',$myrow4qty[5]);
     }
   }
}
if($start_year != $end_year)
{ 
  $end_month1=12;
  for($m=$start_year ;$m<=$end_year;$m++)
  {
      $end_month1=($m==$end_year)?$end_month:12;
      for($n=$start_month;$n<=$end_month1;$n++)
      {
        $monthName = date("F", mktime(0, 0, 0, $n, 10));
    $Date=$monthName.', '.$m;
    if(intval($n) <=9)
         $n='0'.intval($n);
        $cond1="w.crn_num like '$crn1%'and w.book_date like '$m-$n%'";  
      $result3 = $newreport->check_4_FI_INSP($cond1);
    $myrow4qty=mysql_fetch_row($result3);
     if($myrow4qty[6]!='')
     {
      printf('<tr bgcolor="#FFFFFF">
        <td width="20px" align="center"><span class="tabletext">%s</td>',$myrow4qty[6]);
    printf('<td width="20px" align="center"><span class="tabletext">%s</td>',$Date);
    printf('<td width="10px" align="center"><span class="tabletext">%s</td>
        <td width="10px" align="center"><span class="tabletext">%s</td>',$myrow4qty[0],$myrow4qty[1]); 
    printf('<td width="10px" align="center"><span class="tabletext">%s</td>',$myrow4qty[7]);
    printf('<td width="10px" align="center"><span class="tabletext">%s</td>',$myrow4qty[3]);
    printf('<td width="10px" align="center"><span class="tabletext">%s</td>',$myrow4qty[4]);
    printf('<td width="10px" align="center"><span class="tabletext">%s</td></tr>',$myrow4qty[5]);
     }
     }
     $start_month=1;       
  }
}
?>
</tr>
</table>
</div> 
</table>
</td>
<td valign='top'>
<?$start_date_wo='2016-11-01';
$end_date_wo='2016-12-30';?>
<table  width=100% style="border:right:3px solid black;" cellpadding=3 cellspacing=1>
<tr><td>
<div id='wo_performance' style="width:524px; overflow:auto;height:300;">
<table  width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
<tr>
<td colspan=8 align="center" bgcolor="#bababa"><span class="heading"><b>WO PERFORMANCE</b></td>
</tr>
<tr>
<td  bgcolor="#FFFFFF" colspan=6><span class="labeltext"><b>From &nbsp&nbsp</b>
         <input type="text" id="start_date_wo" name="start_date_wo" size=10 value="<?php echo $start_date_wo ?>"
          style="background-color:#DDDDDD;">
         <img src="images/bu-getdateicon.gif" alt="Get Date" onclick="GetDate('start_date_wo')">
          <span class="labeltext"><b>&nbsp;&nbsp;To</b>
         <input type="text" id="end_date_wo" name="end_date_wo" size=10 value="<?php echo $end_date_wo ?>"
          style="background-color:#DDDDDD;">
         <img src="images/bu-getdateicon.gif" alt="Get Date" onclick="GetDate('end_date_wo')">   
 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="images/bu-get.gif" value="Get" 
            onclick="javascript: getwo_performance('wo_performance')"></td>
</tr>

<tr bgcolor='#FFFFFF'><td>
<?
 include_once 'ofc-library/open_flash_chart_object.php';
      open_flash_chart_object(570, 230, 'http://'. $_SERVER['SERVER_NAME'].'/fluentwms/chart-data.php?start_date_wo='.$start_date_wo.'&end_date_wo='.$end_date_wo, false);
    ?>

</td></tr>
</table>

</div>
</table>


</td>

</tr>
<tr>
<td valign='top'>
<table width=100% style="border-right:2px solid black" cellpadding=6 cellspacing=0 height='347px'>
<tr><td valign='top'>
<div id='schedule'>
<table  width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
<tr>
<td colspan=8 align="center" bgcolor="#bababa" ><span class="heading"><b>Schedule Report</b></td>
</tr>
<tr>
<td valign='top' bgcolor="#FFFFFF"><span class="labeltext"><b>PRN:</b>&nbsp;
<input type="text" size=15% name="crn_schedule" id="crn_schedule" value="prn9"></td>
<td  bgcolor='#FFFFFF'> <img src="images/bu-get.gif" value="Get"
            onclick="javascript: getschedule_report('schedule')"></td>
</tr>
</table>

<div style="width:524px; overflow:auto;height:300;">

  <table valign="top" width="100%" border=0 cellpadding=3 cellspacing=1 bgcolor="#FFFFFF">
<tr bgcolor="#FFFFFF">
<td valign='top'>
<?php
$schweekarr = array();
$wwbegindate1= date("Y-m-d", strtotime('monday this week'));
$wwbegindate= date("Y-m-d", strtotime('monday this week'));
array_push($schweekarr,$wwbegindate);
$newdate = date("Y-m-d", strtotime($wwbegindate . "+7 day"));
for ($x = 0; $x <= 49; $x++) {
    $newdate = date("Y-m-d", strtotime($wwbegindate . "+7 day"));
  array_push($schweekarr,$newdate);
  $wwbegindate = $newdate;
} 

$crnonlyarr = array();
$currmnth = date("Y-m-d");
$nextdate=mktime(0,0,0,date("m")+1,date("d"),date("Y"));
$currmnthplus1 = date("Y-m-d", $nextdate);
$nextdate=mktime(0,0,0,date("m")+2,date("d"),date("Y"));
$currmnthplus2 = date("Y-m-d", $nextdate);
$nextdate=mktime(0,0,0,date("m")+3,date("d"),date("Y"));
$currmnthplus3 = date("Y-m-d", $nextdate);
$nextdate=mktime(0,0,0,date("m")+4,date("d"),date("Y"));
$currmnthplus4 = date("Y-m-d", $nextdate);
$nextdate=mktime(0,0,0,date("m")+5,date("d"),date("Y"));
$currmnthplus5 = date("Y-m-d", $nextdate);
$nextdate=mktime(0,0,0,date("m")+6,date("d"),date("Y"));
$currmnthplus6 = date("Y-m-d", $nextdate);
$nextdate=mktime(0,0,0,date("m")+7,date("d"),date("Y"));
$currmnthplus7 = date("Y-m-d", $nextdate);
$nextdate=mktime(0,0,0,date("m")+8,date("d"),date("Y"));
$currmnthplus8 = date("Y-m-d", $nextdate);
$nextdate=mktime(0,0,0,date("m")+9,date("d"),date("Y"));
$currmnthplus9 = date("Y-m-d", $nextdate);
$nextdate=mktime(0,0,0,date("m")+10,date("d"),date("Y"));
$currmnthplus10 = date("Y-m-d", $nextdate);
$nextdate=mktime(0,0,0,date("m")+11,date("d"),date("Y"));
$currmnthplus11 = date("Y-m-d", $nextdate);
$nextdate=mktime(0,0,0,date("m")+12,date("d"),date("Y"));
$currmnthplus12 = date("Y-m-d", $nextdate);
$crn='prn9';
if($crn!='')
{
       $lobresult = $newreport->getlob1($crn);
       if(mysql_num_rows($lobresult) != 0)
     {
         
          while($mylobrow=mysql_fetch_row($lobresult))
              {
                $crn1 = $mylobrow[0];
                   $date = $mylobrow[1];             
                   $qty = $mylobrow[2];
                   if($qty  >0 )
                   {
            $datedi  = date("Y-m-d", strtotime($wwbegindate1 . "+7 day"));
                    
                    // echo $date . "  " . $currmnth ."<BR>" ;
          if ($newhelper->dateDiff('-', $date, $datedi ) <=0)
             {
              // echo $crn1 .  "--" . $qty ."<BR>";

             $crnarr[$crn1][$wwbegindate1]
              += $qty;
            }
          else 
          { 
            $crnarr[$crn1][$date] = $qty;
            }
          $crnonlyarr[$crn1] = $crn1;
        }
      }   

?>
<table align="top" style="table-layout: fixed" width="650px" border=0 cellpadding=3 cellspacing=1 bgcolor="#FFFFFF">
<tr bgcolor="#FFFFFF">
<td width="100px" bgcolor="#FFFFFF"><span class="labeltext" align='center'><b>LEGEND:</b></td>
<td width="20px" height="20px" bgcolor="#00FF00"><span class="labeltext" align='center'>&nbsp</td>
<td width="55px" bgcolor="#FFFFFF"><span class="labeltext" align='center'><b>Safe</b></td>
<td width="20px" bgcolor="#FFFF00"><span class="labeltext" align='center'>&nbsp</td>
<td width="90px" bgcolor="#FFFFFF" ><span class="labeltext" align='center'><b>Borderline</b></td>
<td width="20px" bgcolor="#00DDFF"><span class="labeltext" align='center'>&nbsp</td>
<td width="100px" bgcolor="#FFFFFF"><span class="labeltext" align='center'><b>Qty from PO</b></td>
<td width="20px" bgcolor="#FF0000"><span class="labeltext" align='center'>&nbsp</td>
<td width="70px" bgcolor="#FFFFFF"><span class="labeltext" align='center'><b>Danger</b></td>
<td width="20px" bgcolor="#FFA500"><span class="labeltext" align='center'>&nbsp</td>
<td width="100px" bgcolor="#FFFFFF"><span class="labeltext" align='center'><b>GRN-to-Prodn</b></td>
<td width="20px" bgcolor="#cccc33"><span class="labeltext" align='center'>&nbsp</td>
<td width="100px" bgcolor="#FFFFFF"><span class="labeltext" align='center'><b>PO Date Issue</b></td>
 </tr>
</table>
<table align="top" style="table-layout: fixed" width="650px" style="border:1px solid #000000;" border=0 cellpadding=3 cellspacing=1  scrolling='yes' class="stdtable">
<tr>
<thead>
<th width="90px" class="head0"><span class="labeltext" align="center"><b>PRN</b></th>
<th width="180px"  class="head1"><span class="labeltext"><b>Part Number</b></th>
<th width="60px"  class="head0"><span class="labeltext"><b>WIP (fg)</b></th>
<th width="60px"  class="head1"><span class="labeltext"><b>Post Process (fg)</b></th>
<th width="60px"  class="head0"><span class="labeltext"><b>FG (fg)</b></th>
<th width="65px"  class="head1"><span class="labeltext"><b>GRN (grn)</b></th>
<th width="65px"  class="head0"><span class="labeltext"><b>Buffer</b></th>
<?php

$ft = 0;

foreach ($schweekarr as $date1) 
{
  $datearr = split('-', $date1);
    $d=$datearr[2];
    $m=$datearr[1];
    $y=$datearr[0];
    $x=mktime(0,0,0,$m,$d,$y);
  if ($ft == 0)
  {
       $schdate1=date("M j, Y",$x);
      echo "<td align=\"center\" width=\"200px\" bgcolor=\"#00DDFF\" align=\"left\"><span class=\"schtext\" ><b>WW starting<br> $schdate1<br>(Potential Backlog)</b></td>";
    }
  else
  {
       $schdate1=date("M j, Y",$x);
      echo "<td align=\"center\" width=\"200px\" bgcolor=\"#00DDFF\" align=\"left\"><span class=\"schtext\" ><b>WW starting<br> $schdate1</b></td>";
    }
  $ft = 1;
}
  $i = 0;
  $suffix = '';
while ($i < 13)
{
    $nextdate=mktime(0,0,0,date("m")+$i,date("d"),date("Y"));
    $nextmonth = date("Y-m-d", $nextdate);
 
?>

<td width="100px" bgcolor="#EEEFEE"  align="center"><span class="schtext">
<b>PO <?php echo $i, "<br>", $rmpodate1 ?></b>

<?php
  $i++;
}
?>
</table>
<div style="overflow:auto;border:" id="dataList">

<table style="width:100%"  border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF"  class="stdtable">
<?php
$cond='';
if($crn!='')
{
$cond='and w.crn_num like '."'".$crn."%'";
$cond1='where w.crn_num like '."'".$crn."%'".$cond;
}
else
{
$cond='';
$cond1=''.$cond;
}

foreach ($crnonlyarr as $uniquecrn =>$value) 
{
$crnvalk = '';
$crnv='';
$crn = $uniquecrn;
if(strpos($crn, "/") == true)
{

$crnv = explode("/", $crn) ;
}
else
{
$crnv[0] = $crn ;
}

if($crnv[1] !='' )
{
$crnvalk = $crnv[1];
}
else
{
$crnvalk = $crnv[0];
}

  $flagcrn = 0;
  //print "\ncrn1 is $crn1";

$result = $newreport->getcrnfromlob($cond1,$crnvalk);
$total=0;
$total4dis=0;
$total4grn=0;
$grnbbal =0 ;
$totalgrn_quar=0;
$totalbalance=0;
$totalbalance_quar=0;
$totaldn_qty=0;
$total_recd4stores=0;
$totalrecd_qty=0;
$grnbal =0;
$totalrmpoqty=0;
$wip = 0 ;
$woprocarr = array("Assembly","Untreated","Treated");
while($myrow4crn=mysql_fetch_row($result))
{


  $dnSent_qty=0;
  $dnRecd_qty=0; 

  
  $part_num=wordwrap($myrow4crn[4],30,"<br>\n");
  
  foreach ($woprocarr as $proc)
  {

  $openflag=0;
  $results = $newreport->getallCRN4open($myrow4crn[1],$proc);
  if(mysql_num_rows($results) == '0')
  {

    //printf('<td width="50px" align="center" bgcolor="#FFFFFF"><span class="schtext">%s</td>','&nbsp');
  }
  while($myrow4=mysql_fetch_row($results))
  {


     if ($myrow4[3] == 'Open')
    {
     $total = $total + $myrow4[2]; 
     $wip = $total ;
    }
    if($proc == 'Treated' && $myrow4[3] == 'Open')
    {
    $totaldn_qty += $myrow4[4];
    $total_recd4stores += $myrow4[5]-$myrow4[6];

    }
  }
  $result4closed = $newreport->getallCRN4closed($myrow4crn[1],$proc);
  while($myrow4closed=mysql_fetch_row($result4closed))
  {
     $result1 = $newreport->getallCRNDetails($myrow4closed[0],$myrow4closed[2],$proc);
     $num_rows = mysql_num_rows($result1);
     if($num_rows=='0')
     {
      $total4dis = $total4dis + $myrow4closed[2];
     }
     while($myrow4dispatch=mysql_fetch_row($result1))
     {
      $total4dis = $total4dis + $myrow4dispatch[0];

     }
  }


  $totalbalance='&nbsp';
  $totalbalance_quar='&nbsp';
  $poarray = array();
  $result4rmpo=$newreport->get_rmpotqty4lob($myrow4crn[1],'0000-00-00',$currmnth);
  $myrmpo=mysql_fetch_row($result4rmpo);
  $totalrmpoqty0 = $myrmpo[1];
  $poarray[0] = $totalrmpoqty0;
  $rmpoqty0 = $myrmpo[1];
  $rmpoqty0ponum = $myrmpo[3];
  $result4rmpo=$newreport->get_rmpotqty4lob($myrow4crn[1],$currmnth,$currmnthplus1);
  $myrmpo=mysql_fetch_row($result4rmpo);
  $totalrmpoqty1 = $myrmpo[1];
  $poarray[1] = $totalrmpoqty1;
  $rmpoqty1 = $myrmpo[1];
  $rmpoqty1ponum = $myrmpo[3];
  $result4rmpo=$newreport->get_rmpotqty4lob($myrow4crn[1],$currmnthplus1,$currmnthplus2);
  $myrmpo=mysql_fetch_row($result4rmpo);
  $totalrmpoqty2 = $myrmpo[1];
  $poarray[2] = $totalrmpoqty2;
  $rmpoqty2 = $myrmpo[1];
  $rmpoqty2ponum = $myrmpo[3];
  $result4rmpo=$newreport->get_rmpotqty4lob($myrow4crn[1],$currmnthplus2,$currmnthplus3);
  $myrmpo=mysql_fetch_row($result4rmpo);
  $totalrmpoqty3 = $myrmpo[1];
  $poarray[3] = $totalrmpoqty3;
  $rmpoqty3 = $myrmpo[1];
  $rmpoqty3ponum = $myrmpo[3];
  $result4rmpo=$newreport->get_rmpotqty4lob($myrow4crn[1],$currmnthplus3,$currmnthplus4);
  $myrmpo=mysql_fetch_row($result4rmpo);
  $totalrmpoqty4 = $myrmpo[1];
  $poarray[4] = $totalrmpoqty4;
  $rmpoqty4 = $myrmpo[1];
  $rmpoqty4ponum = $myrmpo[3];
  $result4rmpo=$newreport->get_rmpotqty4lob($myrow4crn[1],$currmnthplus4,$currmnthplus5);
  $myrmpo=mysql_fetch_row($result4rmpo);
  $totalrmpoqty5 = $myrmpo[1];
  $poarray[5] = $totalrmpoqty5;
  $rmpoqty5 = $myrmpo[1];
  $rmpoqty5ponum = $myrmpo[3];
  $result4rmpo=$newreport->get_rmpotqty4lob($myrow4crn[1],$currmnthplus5,$currmnthplus6);
  $myrmpo=mysql_fetch_row($result4rmpo);
  $totalrmpoqty6 = $myrmpo[1];
  $poarray[6] = $totalrmpoqty6;
  $rmpoqty6 = $myrmpo[1];
  $rmpoqty6ponum = $myrmpo[3];
  $result4rmpo=$newreport->get_rmpotqty4lob($myrow4crn[1],$currmnthplus6,$currmnthplus7);
  $myrmpo=mysql_fetch_row($result4rmpo);
  $totalrmpoqty7 = $myrmpo[1];
  $poarray[7] = $totalrmpoqty7;
  $rmpoqty7 = $myrmpo[1];
  $rmpoqty7ponum = $myrmpo[3];
  $result4rmpo=$newreport->get_rmpotqty4lob($myrow4crn[1],$currmnthplus7,$currmnthplus8);
  $myrmpo=mysql_fetch_row($result4rmpo);
  $totalrmpoqty8 = $myrmpo[1];
  $poarray[8] = $totalrmpoqty8;
  $rmpoqty8 = $myrmpo[1];
  $rmpoqty8ponum = $myrmpo[3];
  $result4rmpo=$newreport->get_rmpotqty4lob($myrow4crn[1],$currmnthplus8,$currmnthplus9);
  $myrmpo=mysql_fetch_row($result4rmpo);
  $totalrmpoqty9 = $myrmpo[1];
  $poarray[9] = $totalrmpoqty9;
  $rmpoqty9 = $myrmpo[1];
  $rmpoqty9ponum = $myrmpo[3];
  $result4rmpo=$newreport->get_rmpotqty4lob($myrow4crn[1],$currmnthplus9,$currmnthplus10);
  $myrmpo=mysql_fetch_row($result4rmpo);
  $totalrmpoqty10 = $myrmpo[1];
  $poarray[10] = $totalrmpoqty10;
  $rmpoqty10 = $myrmpo[1];
  $rmpoqty10ponum = $myrmpo[3];
  $result4rmpo=$newreport->get_rmpotqty4lob($myrow4crn[1],$currmnthplus10,$currmnthplus11);
  $myrmpo=mysql_fetch_row($result4rmpo);
  $totalrmpoqty11 = $myrmpo[1];
  $poarray[11] = $totalrmpoqty11;
  $rmpoqty11 = $myrmpo[1];
  $rmpoqty11ponum = $myrmpo[3];
  $result4rmpo=$newreport->get_rmpotqty4lob($myrow4crn[1],$currmnthplus11,$currmnthplus12);
  $myrmpo=mysql_fetch_row($result4rmpo);
  $totalrmpoqty12 = $myrmpo[1];
  $poarray[12] = $totalrmpoqty12;
  $rmpoqty12 = $myrmpo[1];
  $rmpoqty12ponum = $myrmpo[3];
  }

  $crnvalold = $myrow4crn[1] ;

}

$reqfrompo='';
$totalrmpoqtycomp='';
$totalrmpoqtyeqn='';

// Get GRN stock
if(strpos($crn,'BOI') == false )
{
$result = $newreport->getgrnqty4crnnew($crnvalk);
while($mygrn=mysql_fetch_row($result))
{

$grnbal = 0;

      $crndb = $mygrn[3];
      $grnqtm=$mygrn[0];
      $grnqtyused = $mygrn[1];
      $qty_ret=  $mygrn[4];
      $grnquar = $mygrn[2];
     // echo $grnquar."-**---";
    $grnbal = $grnqtm - $grnqtyused+$qty_ret;
    $grnarray[$crndb][0] = $grnbal;
    $grnarray[$crndb][1] = $grnquar;
    $total4grn += $grnbal;
    $totalgrn_quar += $grnquar;
}
//var_dump($grnarray);

}
if(strpos($crn, "/") == true)
{

$crnvk = explode("/", $crn) ;
}
else
{
$crnvk[0] = $crn ;
}


$subcrndisplay = 1 ;
$crnflag = 1;
$crndispflag = 1;
$qtyreqold =0;
foreach ($crnarr[$crn] as $date => $qtyreq) 
{

$fg = $totaldn_qty+$total4dis+$total_recd4stores;
if($crn !='')
{
$crnkval = explode("/", $crn) ;
$crnk = $crnkval[0] ;
if($crnkval[1] == "")
{
  $qtyreqold += $qtyreq ; 
if($qtyreq == $fg || $qtyreqold <= $fg)
{

$crnflag = 1;
$crndispflag = 1;
$dispcrnarr1[$crnk][$date] = $crndispflag ;
$dispcrnarr[$crnk] = $crnflag ;
$subcrndisplay = 1 ;
$qtyreqold = $qtyreqold ;
}
else 
{
$qtyreq += $qtyreq ; 
$crnflag = 0;
$crndispflag = 1;
$dispcrnarr1[$crnk][$date] = $crnflag ;
$dispcrnarr[$crnk] = $crnflag ;
$subcrndisplay = 1 ;
$qtyreqold = $qtyreq ;
break;

}
}
else
{
if ($dispcrnarr[$crnk] == 0) {
   
$crndispflag1 = $dispcrnarr1[$crnk][$date] ;
$dispcrnarr1[$crn][$date] = $crndispflag1  ;
$subcrndisplay = 1 ;
}
else
{

  $subcrndisplay = 0 ;
  $crndispflag = 1;
  $dispcrnarr1[$crn][$date] = $crndispflag  ;
}
}
}
}

if($subcrndisplay ==1 )
{
if(strpos($crn,'BOI') == true )
{
  $crnkpartnum ='';
  $crnk1 ='';
    $assy_crn = substr($crn,2,2);
  $crnv1 = explode("/", $crn) ;
  if($assy_crn =='K-' && $crnv1[3] !='')
  {
    $crnk1 = $crnv1[1] ;
    $crnkpartnum = $crnv1[2] ;
  }
  else
  {
  $crnk1 = $crnv1[0] ;
  $crnkpartnum = $crnv1[1] ;
  } 


$result = $newreport->getpartnumboughtout1($crnk1,$crnkpartnum);
if($result)
{
  $row = mysql_fetch_row($result) ;

  $boqpval = $row[1] ;

  $partnumk = trim($row[0]) ;

$result1 = $newreport->getfgforboughtout($partnumk);
if($result1)
{
  $fg =0;

  $row1 = mysql_fetch_row($result1);
  $qtmb =  $row1[0] ;
  $qtyb_used = $row1[1] ;
  $qtyb_quar =  $row1[2] ;
  $partnum1 =  $row1[3] ;
  $qtyb_ret   = $row1[4] ;

  $grnbbal = $qtmb - $qtyb_used +$qtyb_ret;


$colorval2 ="style=background-color:#00DDFF" ;

  printf('<tr bgcolor="#FFFFFF" >
    <td bgcolor="#FFFFFF" align="center" width="65px" %s><span class="labeltext"><font color="black">%s</font></td>
    <td bgcolor="#FFFFFF" align="center" width="60px" ><span class="labeltext">%s</td>',
  $colorval2,wordwrap($crn,10,"\n",true),$partnum1);

 printf('<td bgcolor="#00FF00" align="center" width="100px"><span class="labeltext">%d</td>' , $myrow4crn[5]);


printf('
     <td bgcolor="#FFFFFF" align="center" width="60px"><span class="schtext"><b>%d</b></td>
     <td bgcolor="#FFFFFF" align="center" width="60px"><span class="schtext"><b>%d</b></td>
     <td bgcolor="#FFFFFF" align="center" width="60px"><span class="schtext"><b>%d</b></td>
   <td bgcolor="#FFFFFF" align="center" width="60px"><span class="schtext"><b>%d</b></td>
   <td bgcolor="#FFFFFF" align="center" width="60px"><span class="schtext"><b>%d</b></td>
   ','','','','',$grnbbal);
  
$grn = $grnbbal ;
 }

  
}

}
else
{
$crnv2 = explode("/", $crn) ;


$colorval ="style=background-color:#FFFFFF" ;
if($crnv2[1] !='' )
{
$colorval1 ="style=background-color:#00DDFF" ;  
}
else
{
$colorval1 ="style=background-color:#3BE8D4" ;

}
$fg = 0;


  printf('<tr title=%s bgcolor="#FFFFFF" >
      <td bgcolor="#FFFFFF" align="center" width="65px" %s><span class="labeltext"><font color="black">%s</font></td>
      <td bgcolor="#FFFFFF" align="center" width="60px"><span class="labeltext">%s</td>',
        $crn,$colorval1,wordwrap($crn,10,"\n",true),$part_num);

     printf('<td  align="center" bgcolor="#00FF00" width="60px"><span class="labeltext">%d</td>' , $myrow4crn[5]);


printf('
         <td bgcolor="#FFFFFF" align="center" width="60px"><span class="schtext"><b>%d</b></td>
         <td bgcolor="#FFFFFF" align="center" width="60px"><span class="schtext"><b>%d</b></td>
      
     <td bgcolor="#FFFFFF" align="center" width="60px"><span class="schtext"><b>%s</b></td>
     <td bgcolor="#FFFFFF" align="center" width="60px"><span class="schtext"><b>%d</b></td>
       ',$total,$totaldn_qty,$total4dis,$total4grn);
    $fg = $totaldn_qty+$total4dis+$total_recd4stores;
    $grn = $total4grn;

}
}


$bufferqty = 0;
$count = 0;

// echo "<pre>" ;
// print_r($crnarr) ;
if($subcrndisplay == 1 )
{

foreach ($crnarr[$crn] as $date => $qtyreq) 
{
  //echo $crn ." " .  $crndispflag ."  " . $date  ."<BR>" ;
  if ($qtyreq != 0)
  {
     //echo "<br>qtyreq is $qtyreq as on $date for crn $crn";
     //echo "<br>fg is $fg";
     //echo "<br>grn is $grn";
     // First check if req qty is equal to Finished Goods qty (fg); if so, color yellow

     if ($qtyreq == $wip)
     {
      $equation=$wip . "wip";
      $disparr[$date] =  " bgcolor=\"#FFFF00\"><span class=\"schtext\">$qtyreq<br>($equation)";
        $wip = $wip- $qtyreq;
     }

    else if ($qtyreq < $wip)
     {

        $equation=$qtyreq . "wip";
      $disparr[$date] =  " bgcolor=\"#00FF00\"><span class=\"schtext\">$qtyreq<br>($equation)";
          $wip = $wip - $qtyreq;
      }
     // if ($qtyreq == $fg + $wip)
     // {

      // $equation=$wip ."wip +" . $fg . "fg";
      // $disparr[$date] =  " bgcolor=\"#FFFF00\"><span class=\"schtext\">$qtyreq<br>($equation)";
     //    $fg = $wip-$fg - $qtyreq;
     // }


  // Next check if req qty is < Finished Goods qty (fg); if so, color green
     else if ($qtyreq < $fg + $wip)
     {

        $reqfromfg = $qtyreq - $wip;
        $equation=$wip ."wip +" . $reqfromfg . "fg";
      $disparr[$date] =  " bgcolor=\"#00FF00\"><span class=\"schtext\">$qtyreq<br>($equation)";
          $fg = $wip + $fg - $qtyreq;
          $wip=0;
      }

  // Else check if req qty is < fg+grn; if so, color green
  // For grn qty check you need to add 4 weeks to today and check
  // to see if the date falls within the req date and color green else red
    else if ($qtyreq < ($fg+$grn+$wip))
      {

     

      $nextdate=mktime(0,0,0,date("m")+1,date("d"),date("Y"));
      $grn2mfrdate = date("Y-m-d", $nextdate);
      //echo "<br>grnmfrdate is $grn2mfrdate";
      //echo "<br>date is $date";
      //echo "<br>fg is $fg";
      $reqfromgrn = $qtyreq-$wip -$fg;
// Added code to check if qty used from grn; if so need WO create trigger
       if ($reqfromgrn > 0)
       {  
              $wocrdate = date('Y-m-d',strtotime("$date -84 days"));
        //echo "<br>date is $date wo cr date is $wocrdate";
        if ($newhelper->dateDiff('-', $wocrdate, $wwbegindate1) <0)
         {
           $wotrigarr[$wwbegindate1] = $reqfromgrn;
         $wodtarr[$wwbegindate1] = $date;
         }
        else 
         {
          $wotrigarr[$wocrdate] = $reqfromgrn;
            $wodtarr[$wocrdate] = $date;
         }
              $wotrdate = date('Y-m-d',strtotime("$date -28 days"));
        if ($newhelper->dateDiff('-', $wocrdate, $wwbegindate1) <0)
         {
           $treattrigarr[$wwbegindate1] = $reqfromgrn;
           $treatdtarr[$wwbegindate1] = $date;
         }
        else 
         {
            $treattrigarr[$wotrdate] = $reqfromgrn;
            $treatdtarr[$wotrdate] = $date;
         }      

         }

      $equation =$wip . "wip +" . $fg . "fg + " . $reqfromgrn . "grn";
      if ($grn2mfrdate <= $date) 
      {
        $disparr[$date] =  " bgcolor=\"#00FF00\"><span class=\"schtext\">$qtyreq<br>($equation)";

       }
       else 
       {
        $disparr[$date] =  " bgcolor=\"#FFA500\"><span class=\"schtext\">$qtyreq<br>($equation)";

       }
      $grn = $grn + $fg + $wip - $qtyreq;
      $fg=0;
      $wip=0;
     }


   else  if ($qtyreq < ($wip+$fg+$grn+$poarray[0]))
      {
      
        //echo "<br>Here poarray0 is $poarray[0]";
            poequation1(1);
      $equation = $wip . "wip +" . $fg . "fg + " . $grn . "grn  " .  $totalrmpoqtyeqn;
              $wocrdate = date('Y-m-d',strtotime("$date -84 days"));      
        if ($newhelper->dateDiff('-', $wocrdate, $wwbegindate1) <=0)
         {
           $wotrigarr[$wwbegindate1] = $qtyreq;
         $wodtarr[$wwbegindate1] = $date;
         }
        else 
         {
          $wotrigarr[$wocrdate] = $qtyreq;
            $wodtarr[$wocrdate] = $date;
         }
              $wotrdate = date('Y-m-d',strtotime("$date -28 days"));
        if ($newhelper->dateDiff('-', $wocrdate, $wwbegindate1) <0)
         {
           $treattrigarr[$wwbegindate1] = $qtyreq;
           $treatdtarr[$wwbegindate1] = $date;
         }
        else 
         {
            $treattrigarr[$wotrdate] = $qtyreq;
            $treatdtarr[$wotrdate] = $date;
         }       
        if ($currmnth < $date)         
        {
          $disparr[$date] =  " bgcolor=\"#FF0000\"><span class=\"schtext\">$qtyreq<br>($equation)";

         }
         else 
         {
                  $disparr[$date] =  " bgcolor=\"#FF0000\"><span class=\"schtext\">$qtyreq<br>($equation)";
         }
            $fg=0;
            $grn=0;
            $wip=0;
             
     }

   else  if ($qtyreq < ($wip+$fg+$grn+$poarray[0]+$poarray[1]))
      {
            poequation1(2);
      $equation = $wip . "wip +" . $fg . "fg + " . $grn . "grn " .  $totalrmpoqtyeqn;
// Added code to check if qty used from grn; if so need WO create trigger
             $wocrdate = date('Y-m-d',strtotime("$date -84 days"));
        if ($newhelper->dateDiff('-', $wocrdate, $wwbegindate1) <=0)
         {
           $wotrigarr[$wwbegindate1] = $qtyreq;
         $wodtarr[$wwbegindate1] = $date;
         }
        else 
         {
          $wotrigarr[$wocrdate] = $qtyreq;
            $wodtarr[$wocrdate] = $date;
         }
              $wotrdate = date('Y-m-d',strtotime("$date -28 days"));
        if ($newhelper->dateDiff('-', $wocrdate, $wwbegindate1) <0)
         {
           $treattrigarr[$wwbegindate1] = $qtyreq;
           $treatdtarr[$wwbegindate1] = $date;
         }
        else 
         {
            $treattrigarr[$wotrdate] = $qtyreq;
            $treatdtarr[$wotrdate] = $date;
         } 
        if ($currmnthplus1 < $date)        
        {
        $disparr[$date] =  " bgcolor=\"#FF0000\"><span class=\"schtext\">$qtyreq<br>($equation)";

      }
      else 
      {
                $disparr[$date] =  " bgcolor=\"#FF0000\"><span class=\"schtext\">$qtyreq<br>($equation)";
      }
        $fg=0;
        $grn=0;
        $wip=0;       

     }


   else  if ($qtyreq < ($wip+$fg+$grn+$poarray[0]+$poarray[1]+$poarray[2]))
      {
        //echo "<br>Here poarray2 is $poarray[2]";
            poequation1(3);
        $wocrdate = date('Y-m-d',strtotime("$date -84 days"));
      $equation =  $wip . "wip+" . $fg . "fg + " . $grn . "grn " .  $totalrmpoqtyeqn;
// Added code to check if qty used from grn; if so need WO create trigger
        if ($newhelper->dateDiff('-', $wocrdate, $wwbegindate1) <=0)
         {
           $wotrigarr[$wwbegindate1] = $qtyreq;
         $wodtarr[$wwbegindate1] = $date;
         }
        else 
         {
          $wotrigarr[$wocrdate] = $qtyreq;
            $wodtarr[$wocrdate] = $date;
         }
              $wotrdate = date('Y-m-d',strtotime("$date -28 days"));
        if ($newhelper->dateDiff('-', $wocrdate, $wwbegindate1) <0)
         {
           $treattrigarr[$wwbegindate1] = $qtyreq;
           $treatdtarr[$wwbegindate1] = $date;
         }
        else 
         {
            $treattrigarr[$wotrdate] = $qtyreq;
            $treatdtarr[$wotrdate] = $date;
         } 
      
      if ($currmnthplus2 < $date)        
        {
        $disparr[$date] =  " bgcolor=\"#FF0000\"><span class=\"schtext\">$qtyreq<br>($equation)";

         }
         else 
         {
                   $disparr[$date] =  " bgcolor=\"#FF0000\"><span class=\"schtext\">$qtyreq<br>($equation)";
         }
            $fg=0;
            $grn=0;
            $wip =0;

     }

   else  if ($qtyreq < ($fg+$grn+ $poarray[0]+$poarray[1]+$poarray[2]+$poarray[3]))
      {
            poequation1(4);
      $wocrdate = date('Y-m-d',strtotime("$date -84 days"));
      $equation = $wip . "wip +" . $fg . "fg + " . $grn . "grn " .  $totalrmpoqtyeqn;
// Added code to check if qty used from grn; if so need WO create trigger
        if ($newhelper->dateDiff('-', $wocrdate, $wwbegindate1) <=0)
         {
           $wotrigarr[$wwbegindate1] = $qtyreq;
         $wodtarr[$wwbegindate1] = $date;
         }
        else 
         {
          $wotrigarr[$wocrdate] = $qtyreq;
            $wodtarr[$wocrdate] = $date;
         }
              $wotrdate = date('Y-m-d',strtotime("$date -28 days"));
        if ($newhelper->dateDiff('-', $wocrdate, $wwbegindate1) <0)
         {
           $treattrigarr[$wwbegindate1] = $qtyreq;
           $treatdtarr[$wwbegindate1] = $date;
         }
        else 
         {
            $treattrigarr[$wotrdate] = $qtyreq;
            $treatdtarr[$wotrdate] = $date;
         } 
      
      if ($currmnthplus3 < $date)        
        {
             $disparr[$date] = " bgcolor=\"#FF0000\"><span class=\"schtext\">$qtyreq<br>($equation)";

         }
         else 
         {
                  $disparr[$date] =  " bgcolor=\"#FF0000\"><span class=\"schtext\">$qtyreq<br>($equation)";
         }
            $fg=0;
            $grn=0;
            $wip=0;

     }

   else  if ($qtyreq < ($wip + $fg+$grn+$poarray[0]+$poarray[1]+$poarray[2]+$poarray[3] + 
                                    $poarray[4]))
      {
            poequation1(5);
      $wocrdate = date('Y-m-d',strtotime("$date -84 days"));
      $equation =$wip . "wip +" .  $fg . "fg + " . $grn . "grn " .  $totalrmpoqtyeqn;
// Added code to check if qty used from grn; if so need WO create trigger
        if ($newhelper->dateDiff('-', $wocrdate, $wwbegindate1) <=0)
         {
           $wotrigarr[$wwbegindate1] = $qtyreq;
         $wodtarr[$wwbegindate1] = $date;
         }
        else 
         {
          $wotrigarr[$wocrdate] = $qtyreq;
            $wodtarr[$wocrdate] = $date;
         }
              $wotrdate = date('Y-m-d',strtotime("$date -28 days"));
        if ($newhelper->dateDiff('-', $wocrdate, $wwbegindate1) <0)
         {
           $treattrigarr[$wwbegindate1] = $qtyreq;
           $treatdtarr[$wwbegindate1] = $date;
         }
        else 
         {
            $treattrigarr[$wotrdate] = $qtyreq;
            $treatdtarr[$wotrdate] = $date;
         }    
      
      if ($currmnthplus4 < $date)        
        {
               $disparr[$date] = " bgcolor=\"#FF0000\"><span class=\"schtext\">$qtyreq<br>($equation)";
         }
         else 
         {
                  $disparr[$date] =  " bgcolor=\"#FF0000\"><span class=\"schtext\">$qtyreq<br>($equation)";
         }

            $fg=0;
            $grn=0;
            $wip =0;
     }
   else  if ($qtyreq < ($wip+$fg+$grn+$poarray[0]+$poarray[1]+$poarray[2]+$poarray[3] + 
                                    $poarray[4]+$poarray[5]))
      {
            poequation1(6);
      $wocrdate = date('Y-m-d',strtotime("$date -84 days"));
      $equation = $wip . "wip +" . $fg . "fg + " . $grn . "grn " .  $totalrmpoqtyeqn;
// Added code to check if qty used from grn; if so need WO create trigger
        if ($newhelper->dateDiff('-', $wocrdate, $wwbegindate1) <=0)
         {
           $wotrigarr[$wwbegindate1] = $qtyreq;
         $wodtarr[$wwbegindate1] = $date;
         }
        else 
         {
          $wotrigarr[$wocrdate] = $qtyreq;
            $wodtarr[$wocrdate] = $date;
         }
              $wotrdate = date('Y-m-d',strtotime("$date -28 days"));
        if ($newhelper->dateDiff('-', $wocrdate, $wwbegindate1) <0)
         {
           $treattrigarr[$wwbegindate1] = $qtyreq;
           $treatdtarr[$wwbegindate1] = $date;
         }
        else 
         {
            $treattrigarr[$wotrdate] = $qtyreq;
            $treatdtarr[$wotrdate] = $date;
         } 
      
      if ($currmnthplus5 < $date)        
        {
         $disparr[$date] =  " bgcolor=\"#FF0000\"><span class=\"schtext\">$qtyreq<br>($equation)";

         }
         else 
         {
                  $disparr[$date] =  " bgcolor=\"#FF0000\"><span class=\"schtext\">$qtyreq<br>($equation)";
         }
            $fg=0;
            $grn=0;
            $wip=0;

     }

   else  if ($qtyreq < ($wip+$fg+$grn+$poarray[0]+$poarray[1]+$poarray[2]+$poarray[3] + 
                                    $poarray[4]+$poarray[5] + $poarray[6]))
      {          
        poequation1(7);
      $wocrdate = date('Y-m-d',strtotime("$date -84 days"));
      $equation = $wip . "wip +" . $fg . "fg + " . $grn . "grn " .  $totalrmpoqtyeqn;
// Added code to check if qty used from grn; if so need WO create trigger
        if ($newhelper->dateDiff('-', $wocrdate, $wwbegindate1) <=0)
         {
           $wotrigarr[$wwbegindate1] = $qtyreq;
         $wodtarr[$wwbegindate1] = $date;
         }
        else 
         {
          $wotrigarr[$wocrdate] = $qtyreq;
            $wodtarr[$wocrdate] = $date;
         }
              $wotrdate = date('Y-m-d',strtotime("$date -28 days"));
        if ($newhelper->dateDiff('-', $wocrdate, $wwbegindate1) <0)
         {
           $treattrigarr[$wwbegindate1] = $qtyreq;
           $treatdtarr[$wwbegindate1] = $date;
         }
        else 
         {
            $treattrigarr[$wotrdate] = $qtyreq;
            $treatdtarr[$wotrdate] = $date;
         }     
      
      if ($currmnthplus6 < $date)        
        {
        $disparr[$date] =  " bgcolor=\"#FF0000\"><span class=\"schtext\">$qtyreq<br>($equation)";

         }
         else 
         {
                 $disparr[$date] = " bgcolor=\"#FF0000\"><span class=\"schtext\">$qtyreq<br>($equation)";
         }
            $fg=0;
            $grn=0;
            $wip=0;

     }
   else  if ($qtyreq < ($wip+$fg+$grn+$poarray[0]+$poarray[1]+$poarray[2]+$poarray[3] + 
                                    $poarray[4]+$poarray[5] + $poarray[6] + $poarray[7]))
      {          
            poequation1(8);
      $wocrdate = date('Y-m-d',strtotime("$date -84 days"));
      $equation = $wip . "wip +" . $fg . "fg + " . $grn . "grn " .  $totalrmpoqtyeqn;
        
// Added code to check if qty used from grn; if so need WO create trigger
        if ($newhelper->dateDiff('-', $wocrdate, $wwbegindate1) <=0)
         {
           $wotrigarr[$wwbegindate1] = $qtyreq;
         $wodtarr[$wwbegindate1] = $date;
         }
        else 
         {
          $wotrigarr[$wocrdate] = $qtyreq;
            $wodtarr[$wocrdate] = $date;
         }
              $wotrdate = date('Y-m-d',strtotime("$date -28 days"));
        if ($newhelper->dateDiff('-', $wocrdate, $wwbegindate1) <0)
         {
           $treattrigarr[$wwbegindate1] = $qtyreq;
           $treatdtarr[$wwbegindate1] = $date;
         }
        else 
         {
            $treattrigarr[$wotrdate] = $qtyreq;
            $treatdtarr[$wotrdate] = $date;
         } 
      
      if ($currmnthplus7 < $date)        
        {
        $disparr[$date] =  " bgcolor=\"#FF0000\"><span class=\"schtext\">$qtyreq<br>($equation)";

         }
         else 
         {
                  $disparr[$date] =  " bgcolor=\"#FF0000\"><span class=\"schtext\">$qtyreq<br>($equation)";
         }
            $fg=0;
            $grn=0;
            $wip=0;

     }
   else  if ($qtyreq < ($wip+$fg+$grn+$poarray[0]+$poarray[1]+$poarray[2]+$poarray[3] + 
                                    $poarray[4]+$poarray[5] + $poarray[6] + $poarray[7] + $poarray[8]))
      {          
            poequation1(9);
      $wocrdate = date('Y-m-d',strtotime("$date -84 days"));
      $equation = $wip . "wip +" . $fg . "fg + " . $grn . "grn " .  $totalrmpoqtyeqn;
        
// Added code to check if qty used from grn; if so need WO create trigger
        if ($newhelper->dateDiff('-', $wocrdate, $wwbegindate1) <=0)
         {
           $wotrigarr[$wwbegindate1] = $qtyreq;
         $wodtarr[$wwbegindate1] = $date;
         }
        else 
         {
          $wotrigarr[$wocrdate] = $qtyreq;
            $wodtarr[$wocrdate] = $date;
         }
              $wotrdate = date('Y-m-d',strtotime("$date -28 days"));
        if ($newhelper->dateDiff('-', $wocrdate, $wwbegindate1) <0)
         {
           $treattrigarr[$wwbegindate1] = $qtyreq;
           $treatdtarr[$wwbegindate1] = $date;
         }
        else 
         {
            $treattrigarr[$wotrdate] = $qtyreq;
            $treatdtarr[$wotrdate] = $date;
         } 
      if ($currmnthplus8 < $date)        
        {
        $disparr[$date] =  " bgcolor=\"#FF0000\"><span class=\"schtext\">$qtyreq<br>($equation)";

         }
         else 
         {
                  $disparr[$date] =  " bgcolor=\"#FF0000\"><span class=\"schtext\">$qtyreq<br>($equation)";
         }
            $fg=0;
            $grn=0;
            $wip=0;

     }
   else  if ($qtyreq < ($wip+$fg+$grn+$poarray[0]+$poarray[1]+$poarray[2]+$poarray[3] + 
                                    $poarray[4]+$poarray[5] + $poarray[6] + $poarray[7] + 
                                    $poarray[8] + $poarray[9]))
      {           
        poequation1(10);
      $wocrdate = date('Y-m-d',strtotime("$date -84 days"));
      $equation = $wip . "wip +" . $fg . "fg + " . $grn . "grn " .  $totalrmpoqtyeqn;
        
// Added code to check if qty used from grn; if so need WO create trigger
        if ($newhelper->dateDiff('-', $wocrdate, $wwbegindate1) <=0)
         {
           $wotrigarr[$wwbegindate1] = $qtyreq;
         $wodtarr[$wwbegindate1] = $date;
         }
        else 
         {
          $wotrigarr[$wocrdate] = $qtyreq;
            $wodtarr[$wocrdate] = $date;
         }
              $wotrdate = date('Y-m-d',strtotime("$date -28 days"));
        if ($newhelper->dateDiff('-', $wocrdate, $wwbegindate1) <0)
         {
           $treattrigarr[$wwbegindate1] = $qtyreq;
           $treatdtarr[$wwbegindate1] = $date;
         }
        else 
         {
            $treattrigarr[$wotrdate] = $qtyreq;
            $treatdtarr[$wotrdate] = $date;
         } 
      
      if ($currmnthplus9 < $date)        
        {
               $disparr[$date] =  " bgcolor=\"#FF0000\"><span class=\"schtext\">$qtyreq<br>($equation)";

         }
         else 
         {
                  $disparr[$date] =  " bgcolor=\"#FF0000\"  width=\"200px\"><span class=\"schtext\">$qtyreq<br>($equation)";
         }
            $fg=0;
            $grn=0;
            $wip=0;

     }

   else  if ($qtyreq < ($wip+$fg+$grn+$poarray[0]+$poarray[1]+$poarray[2]+$poarray[3] + 
                                    $poarray[4]+$poarray[5] + $poarray[6] + $poarray[7] + 
                                    $poarray[8] + $poarray[9] + $poarray[10]))          
      {
            poequation1(11);
      $wocrdate = date('Y-m-d',strtotime("$date -84 days"));
      $equation =$wip ."wip+ " . $fg . "fg + " . $grn . "grn  " .  $totalrmpoqtyeqn;
        
// Added code to check if qty used from grn; if so need WO create trigger
        if ($newhelper->dateDiff('-', $wocrdate, $wwbegindate1) <=0)
         {
           $wotrigarr[$wwbegindate1] = $qtyreq;
         $wodtarr[$wwbegindate1] = $date;
         }
        else 
         {
          $wotrigarr[$wocrdate] = $qtyreq;
            $wodtarr[$wocrdate] = $date;
         }
              $wotrdate = date('Y-m-d',strtotime("$date -28 days"));
        if ($newhelper->dateDiff('-', $wocrdate, $wwbegindate1) <0)
         {
           $treattrigarr[$wwbegindate1] = $qtyreq;
           $treatdtarr[$wwbegindate1] = $date;
         }
        else 
         {
            $treattrigarr[$wotrdate] = $qtyreq;
            $treatdtarr[$wotrdate] = $date;
         } 
      
      if ($currmnthplus10 < $date)         
        {
              $disparr[$date] =  " bgcolor=\"#FF0000\"><span class=\"schtext\">$qtyreq<br>($equation)";

         }
         else 
         {
                  $disparr[$date] =   " bgcolor=\"#FF0000\"><span class=\"schtext\">$qtyreq<br>($equation)";
         }
            $fg=0;
            $grn=0;
            $wip=0;

     }
   else  if ($qtyreq < ($wip+$fg+$grn+$poarray[0]+$poarray[1]+$poarray[2]+$poarray[3] + 
                                    $poarray[4]+$poarray[5] + $poarray[6] + $poarray[7] + 
                                    $poarray[8] + $poarray[9] + $poarray[10] + $poarray[11]))         
      {
            poequation1(12);
      $wocrdate = date('Y-m-d',strtotime("$date -84 days"));
      $equation = $wip ."wip + " . $fg . "fg + " . $grn . "grn " .  $totalrmpoqtyeqn;
        
// Added code to check if qty used from grn; if so need WO create trigger
        if ($newhelper->dateDiff('-', $wocrdate, $wwbegindate1) <=0)
         {
           $wotrigarr[$wwbegindate1] = $qtyreq;
         $wodtarr[$wwbegindate1] = $date;
         }
        else 
         {
          $wotrigarr[$wocrdate] = $qtyreq;
            $wodtarr[$wocrdate] = $date;
         }
              $wotrdate = date('Y-m-d',strtotime("$date -28 days"));
        if ($newhelper->dateDiff('-', $wocrdate, $wwbegindate1) <0)
         {
           $treattrigarr[$wwbegindate1] = $qtyreq;
           $treatdtarr[$wwbegindate1] = $date;
         }
        else 
         {
            $treattrigarr[$wotrdate] = $qtyreq;
            $treatdtarr[$wotrdate] = $date;
         } 
      if ($currmnthplus11 < $date)         
        {
        $disparr[$date] =  " bgcolor=\"#FF0000\"><span class=\"schtext\">$qtyreq<br>($equation)";

         }
         else 
         {
          $disparr[$date] =  " bgcolor=\"#FF0000\"><span class=\"schtext\">$qtyreq<br>($equation)";
         }
            $fg=0;
            $grn=0;
            $wip =0;

     }
   else  if ($qtyreq < ($wip+$fg+$grn+$poarray[0]+$poarray[1]+$poarray[2]+$poarray[3] + 
                                    $poarray[4]+$poarray[5] + $poarray[6] + $poarray[7] + 
                                    $poarray[8] + $poarray[9] + $poarray[10] + $poarray[11] + $poarray[12]))          
      {
            poequation1(13);
      $wocrdate = date('Y-m-d',strtotime("$date -84 days"));
// Added code to check if qty used from grn; if so need WO create trigger
        if ($newhelper->dateDiff('-', $wocrdate, $wwbegindate1) <=0)
         {
           $wotrigarr[$wwbegindate1] = $qtyreq;
         $wodtarr[$wwbegindate1] = $date;
         }
        else 
         {
          $wotrigarr[$wocrdate] = $qtyreq;
            $wodtarr[$wocrdate] = $date;
         }
              $wotrdate = date('Y-m-d',strtotime("$date -28 days"));
        if ($newhelper->dateDiff('-', $wocrdate, $wwbegindate1) <0)
         {
           $treattrigarr[$wwbegindate1] = $qtyreq;
           $treatdtarr[$wwbegindate1] = $date;
         }
        else 
         {
            $treattrigarr[$wotrdate] = $qtyreq;
            $treatdtarr[$wotrdate] = $date;
         } 
      $equation = $wip ."wip+ " . $fg . "fg + " . $grn . "grn  " .  $totalrmpoqtyeqn;
        if ($currmnthplus12 < $date)         
        {
                $disparr[$date] =  " bgcolor=\"#FF0000\"><span class=\"schtext\">$qtyreq<br>($equation)";

         }
         else 
         {
                $disparr[$date] = " bgcolor=\"#FF0000\"><span class=\"schtext\">$qtyreq<br>($equation)";
         }
            $fg=0;
            $grn=0;
            $wip=0;

     }


    // Else color red if none of the above succeeds
      else
    {

          $wocrdate = date('Y-m-d',strtotime("$date -84 days"));
        $totalrmpoqtycomp = 0;
          $totalrmpoqtyeqn = "";
      $equation = '';
        for ($i = 0; $i <= 12; $i++)
          {
                  $poqtysum += (int)$poarray[$i];
          //echo "<br> value of po array element for $i is $poarray[$i]";
          if ($poarray[$i] != 0)
            {
             $reqpoqty = (int)$poarray[$i];
                       $totalrmpoqtyeqn .= " + $reqpoqty " .  "po{$i}";
             $equation = "(" . $totalrmpoqtyeqn . ")";
             $poarray[$i] = 0;
            }
        }
      $equation = $wip . "wip + " . $fg . "fg + " . $grn . "grn  " .  $totalrmpoqtyeqn;
        //$equation = $totalrmpoqtyeqn;
         $shortfall = $qtyreq - ($wip+$fg+$grn+$poqtysum);
         $poqtysum = 0;
       if ($shortfall > 0)
       {  
               $poorddate = date('Y-m-d',strtotime("$date -199 days"));
         if ($newhelper->dateDiff('-', $poorddate, $wwbegindate1) <=0)
         {
            $poarr[$wwbegindate1] = $shortfall;
            $podtarr[$wwbegindate1] = $date;
         }
        else 
         {
            $poarr[$poorddate] = $shortfall;
            $podtarr[$poorddate] = $date;
         }
              
              //$poorddate = date('Y-m-d',strtotime("$date -10 days"));
         }
        if ($newhelper->dateDiff('-', $wocrdate, $wwbegindate1) <=0)
         {
           $wotrigarr[$wwbegindate1] = $qtyreq;
         $wodtarr[$wwbegindate1] = $date;
         }
        else 
         {
          $wotrigarr[$wocrdate] = $qtyreq;
            $wodtarr[$wocrdate] = $date;
         }
              $wotrdate = date('Y-m-d',strtotime("$date -28 days"));
        if ($newhelper->dateDiff('-', $wotrdate, $wwbegindate1) <0)
         {
           $treattrigarr[$wwbegindate1] = $qtyreq;
           $treatdtarr[$wwbegindate1] = $date;
         }
        else 
         {
            $treattrigarr[$wotrdate] = $qtyreq;
            $treatdtarr[$wotrdate] = $date;
         } 
       $disparr[$date] = " bgcolor=\"#FF0000\"><span class=\"schtext\">$qtyreq($shortfall)<br>($equation)";
       $wip=0;
       $fg = 0;
       $grn = 0;
       $poqtysum=0;
    }
  }
  else
  {
       //$disparr[$date] = $qtyreq;
       $disparr[$date] ="$qtyreq";
  }
  $actcount++;
  if ($actcount == $schdtcount)
    break;
   }

}


    //echo "<br>actcount for $crn is $actcount";
  //echo "<br>schdtcount is $schdtcount";
    while ($actcount < $schdtcount)
  {
      $disparr[$date] = '';
    //echo "<tr bgcolor=\"#FFCC00\"><td align=\"center\" bgcolor=\"#FFFFFF\" width=\"200px\"><span class=\"schtext\">&nbsp</td></tr>";
       $actcount++;
  }
    $actcount = 0;

//echo "<br>po array is ";
//print_r($poarr);
//echo "<br>Here";
 // Print data from array
 $skip = 0;
 $wotrigger = '';
 $potrigger = '';
 $dispdate = '';
 $dataflag = 0;
 //echo "<br>before for loop";


if($subcrndisplay == 1) 
{
for ($j=0; $j<=50; $j++) 
{
    //echo "<br> week index is $j";
    $data = '';
    $thisweek = $j;
    $nextweek = $thisweek+1;
    $fromdate = $schweekarr[$thisweek];
      $todate = $schweekarr[$nextweek];
      foreach ($disparr as $dispdate => $data1) 
      {
     //echo "here - from date = $fromdate; todate = $todate and $dispdate $data1";
       if (check_in_range($fromdate, $todate, $dispdate) && $data1 != '')
     {
      $flagdisp = 0;
      $crne = explode("/",$crn) ;
      if($crne[1] =='')
      {
        $flagdisp = 1;  
      }
      
      if($dispcrnarr1[$crn][$dispdate] == 1 && $flagdisp != 1)
      {
      $data .= "&nbsp;<br>";
      }
      else
      {
        $data .= "$data1<br>";
      }
      //unset($disparr[$dispdate]);
      //echo "<br>Here $data";
      $dataflag = 1;
     }
      }
    $dataflag = 0;

    foreach($poarr as $orddate => $reqqty) 
      {
         $fromdate4po = $fromdate;
       if (check_in_range($fromdate4po, $todate, $orddate))
       {
           $potrigger += $reqqty;
       $po4schdt = $podtarr[$orddate];
       unset($poarr[$orddate]);      
     }
      }
 
    foreach($wotrigarr as $wocrdate => $woqty) 
      {
       if (check_in_range($fromdate, $todate, $wocrdate))
       {

        $flagdisp2 = 0;
      $crne2 = explode("/",$crn) ;
      if($crne2[1] =='')
      {
        $flagdisp2 = 1; 
      }



           $wotrigger += $woqty;

         
       $wo4schdt = $wodtarr[$wocrdate];
       //echo "<br>fromdate is $fromdate todae is $todate  crdate is $wocrdate";
       //echo "<br>wo4schdt is $wo4schdt";
       unset($wotrigarr[$wocrdate]);
       }
      }
// Check for WO Treatment trigger
    foreach($treattrigarr as $trtrdate => $wotrqty) 
      {
       if (check_in_range($fromdate, $todate, $trtrdate))
       {

        $flagdisp3 = 0;
      $crne3 = explode("/",$crn) ;
      if($crne3[1] =='')
      {
        $flagdisp3 = 1; 
      }



           $treattrigger += $wotrqty;
       $treattrigger += "" ;

           
       $tr4schdt = $treatdtarr[$trtrdate];
       unset($treattrigarr[$trtrdate]);

       }
      }

   if ($ftrigger == 'ALL' or $ftrigger == 'WO' or
     $ftrigger == 'all' or $ftrigger == 'wo')
   {
   if ($wotrigger != '')
   {
     $datearr = split('-', $wo4schdt);
         $d=$datearr[2];
         $m=$datearr[1];
         $y=$datearr[0];
         $x=mktime(0,0,0,$m,$d,$y);
         $wotrdate=date("M j, Y",$x);


       $data = $data . "<br><b><font color=\"#990000\">(WO for $wotrigger nos. for <br>$wotrdate)</b></font>";
      $wotrigger = '';
   }
   }

   if ($ftrigger == 'ALL' or $ftrigger == 'TREAT' or
     $ftrigger == 'all' or $ftrigger == 'treat')
   {
   if ($treattrigger != '')
   {
     $datearr = split('-', $tr4schdt);
         $d=$datearr[2];
         $m=$datearr[1];
         $y=$datearr[0];
         $x=mktime(0,0,0,$m,$d,$y);
         $trtrdate=date("M j, Y",$x);
       $data = $data . "<br><b><font color=\"#990000\">($treattrigger nos. to Treatment for <br>$trtrdate)</b></font>";
      $treattrigger = '';
   }

   }

  if ($ftrigger == 'ALL' or $ftrigger == 'RMPO' or
    $ftrigger == 'all' or $ftrigger == 'rmpo')
   {
   if ($potrigger != '')
   {
     $datearr = split('-', $po4schdt);
     //echo "<br>po ord dt is $po4schdt";
         $d=$datearr[2];
         $m=$datearr[1];
         $y=$datearr[0];
         $x=mktime(0,0,0,$m,$d,$y);
         $potrigdate=date("M j, Y",$x);

            $flagdisp1 = 0;
      $crne1 = explode("/",$crn) ;
      if($crne1[1] =='')
      {
        $flagdisp1 = 1; 
      }



         $data .= "<br><b><font color=\"#990000\">(RM PO $potrigger nos. for <br>$potrigdate)</b></font>";
      $potrigger = '';
   }
   }

    //echo "<td align=\"center\" bgcolor=\"#FFFFFF\" width=\"200px\"><span class=\"schtext\">$data</td>";
    echo "<td width=\"200px\" align=\"center\"" . "$data</td>";
}


   printf('
     <td align="center" width="100px"><span class="schtext"><b>%d<br>%s</b></td>  
       <td align="center" width="100px"><span class="schtext"><b>%d<br>%s</b></td>
     <td align="center" width="100px"><span class="schtext"><b>%d<br>%s</b></td>
     <td align="center" width="100px"><span class="schtext"><b>%d<br>%s</b></td>
       <td align="center" width="100px"><span class="schtext"><b>%d<br>%s</b></td>
     <td align="center" width="100px"><span class="schtext"><b>%d<br>%s</b></td>  
     <td align="center" width="100px"><span class="schtext"><b>%d<br>%s</b></td>  
       <td align="center" width="100px"><span class="schtext"><b>%d<br>%s</b></td>
     <td align="center" width="100px"><span class="schtext"><b>%d<br>%s</b></td>  
     <td align="center" width="100px"><span class="schtext"><b>%d<br>%s</b></td>  
     <td align="center" width="100px"><span class="schtext"><b>%d<br>%s</b></td>  
       <td align="center" width="100px"><span class="schtext"><b>%d<br>%s</b></td>
     <td align="center" width="100px"><span class="schtext"><b>%d<br>%s</b></td>  
    ',$rmpoqty0,$rmpoqty0ponum,$rmpoqty1,$rmpoqty1ponum,
      $rmpoqty2,$rmpoqty2ponum,$rmpoqty3,$rmpoqty3ponum,
      $rmpoqty4,$rmpoqty4ponum,$rmpoqty5,$rmpoqty5ponum,
      $rmpoqty6,$rmpoqty6ponum,$rmpoqty7,$rmpoqty7ponum,
      $rmpoqty8,$rmpoqty8ponum,$rmpoqty9,$rmpoqty9ponum,
      $rmpoqty10,$rmpoqty10ponum,$rmpoqty11,$rmpoqty11ponum,
      $rmpoqty12,$rmpoqty12ponum
      ); 
echo "</tr>";




 $disparr = array();
$poarr = array();
$podtarr = array();
$wotrigarr = array();
$wodtarr = array(); 
$treattrigarr = array();
$treatdtarr = array();

} }


}
}
function check_in_range($start_date, $end_date, $date_from_user)
{
  // Convert to timestamp
  $start_ts = strtotime($start_date);
  $end_ts = strtotime($end_date);
  $user_ts = strtotime($date_from_user);

  // Check that user date is between start & end
  return (($user_ts >= $start_ts) && ($user_ts < $end_ts));
}

function poequation1($pocount)
{
   // GLOBAL $totalrmpoqty0, $totalrmpoqty1, $totalrmpoqty2, $totalrmpoqty3, 
//                 $totalrmpoqty4, $totalrmpoqty5, $totalrmpoqty6, $totalrmpoqty7, 
//                 $totalrmpoqty8, $totalrmpoqty9, $totalrmpoqty10, $totalrmpoqty11,
//                    $totalrmpoqty12, $reqfrompo;
    GLOBAL $poarray, $qtyreq, $fg, $grn, $wip, $reqfrompo, $totalrmpoqtycomp,$totalrmpoqtyeqn;
  $totalrmpoqtycomp = 0;
  $totalrmpoqtyeqn = "";
  $usedfrompo = 0;
  for ($i = 0; $i < $pocount; $i++)
  {
        $index = $pocount -1;
      
      if ($poarray[$i] == '' || $poarray[$i] == 0)
        {
        $poarray[$i] = 0;
         }
            else
      {

                $totalrmpoqtycomp = $totalrmpoqtycomp + $poarray[$i];
          //echo "<br>totalpo till now is $totalrmpoqtycomp";
          $reqfrompo = $qtyreq-($wip+$fg+$grn)-$usedfrompo;
            //echo "<br>reqfrom po for $i is $reqfrompo";
          if ($reqfrompo > $poarray[$i])
          {
                $usedfrompo = $poarray[$i];
            $poarray[$i] = 0;
            $totalrmpoqtyeqn .= "+ $usedfrompo" . "po{$i}";
          }
          else
          {
                $usedfrompo = $reqfrompo;
            $poarray[$i] = $poarray[$i] - $reqfrompo;
            $totalrmpoqtyeqn .= "+ $usedfrompo" . "po{$i}";
          }
            
          //echo "<br>reqfrom po for $i is $reqfrompo";
          //echo "<br>In function value of poarray for $i is $poarray[$i]";
          //var_dump($poarray);
           }
            //$poarray[$index] = 0;
  }
  $reqfrompo = $qtyreq-($wip+$fg+$grn+$totalrmpoqtycomp);
  //echo "<br>In function value of reqfrom po is $reqfrompo and pocount is $pocount";
  //echo "<br>In function value of poarray for $index is $poarray[$index]";

} 

?>
</tr>
</table>
</table>
</div>
</table>
</td>
<td valign='top'>



<table width=100% border=0 cellpadding=6 cellspacing=0 height='320px'>
<tr><td valign='top'>
<?$crn='';?>

<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
  <tr>
    <td colspan=6 align="center" bgcolor="#bababa"><span class="heading"><b>RM PO Projections</b></td>
  </tr>
        <tr>
       <tr>
<td valign='top' bgcolor="#FFFFFF"><span class="labeltext"><b>PRN:</b>&nbsp;
<input type="text" size=15% name="crn_rmpo" id="crn_rmpo" value="prn2"></td>
<td  bgcolor='#FFFFFF'> <img src="images/bu-get.gif" value="Get"
            onclick="javascript: getrmschedule_report('rmposchedule')"></td>
</tr>
</table>
<div id='rmposchedule' style="width:500px; overflow:auto;height:300;">
<?php
$udate='0000-00-00';
$currmnth = date("Y-m-d");
$nextdate=mktime(0,0,0,date("m")+1,date("d"),date("Y"));
$currmnthplus1 = date("Y-m-d", $nextdate);
$nextdate=mktime(0,0,0,date("m")+2,date("d"),date("Y"));
$currmnthplus2 = date("Y-m-d", $nextdate);
$nextdate=mktime(0,0,0,date("m")+3,date("d"),date("Y"));
$currmnthplus3 = date("Y-m-d", $nextdate);
$nextdate=mktime(0,0,0,date("m")+4,date("d"),date("Y"));
$currmnthplus4 = date("Y-m-d", $nextdate);
$nextdate=mktime(0,0,0,date("m")+5,date("d"),date("Y"));
$currmnthplus5 = date("Y-m-d", $nextdate);
$nextdate=mktime(0,0,0,date("m")+6,date("d"),date("Y"));
$currmnthplus6 = date("Y-m-d", $nextdate);
$nextdate=mktime(0,0,0,date("m")+7,date("d"),date("Y"));
$currmnthplus7 = date("Y-m-d", $nextdate);
$nextdate=mktime(0,0,0,date("m")+8,date("d"),date("Y"));
$currmnthplus8 = date("Y-m-d", $nextdate);
$nextdate=mktime(0,0,0,date("m")+9,date("d"),date("Y"));
$currmnthplus9 = date("Y-m-d", $nextdate);
$nextdate=mktime(0,0,0,date("m")+10,date("d"),date("Y"));
$currmnthplus10 = date("Y-m-d", $nextdate);
$nextdate=mktime(0,0,0,date("m")+11,date("d"),date("Y"));
$currmnthplus11 = date("Y-m-d", $nextdate);
$nextdate=mktime(0,0,0,date("m")+12,date("d"),date("Y"));
$currmnthplus12 = date("Y-m-d", $nextdate);
$crn='prn2';
if($crn!='')
{
       $lobresult = $newreport->getlob($crn);
       if(mysql_num_rows($lobresult) != 0)
     {
         while($mylobrow=mysql_fetch_row($lobresult))
              {
                 $crn1 = $mylobrow[0];
              // echo "<br>inside while $crn1-----";
                   $date = $mylobrow[1];
                   $qty = $mylobrow[2];
                   $crnarr[$crn1][$date] = $qty;
          //echo $crnarr[$crn1][$date];
                  $crnonlyarr[$crn1] = $crn1;
                }
        //         echo "<pre>";
        // print_r($crnonlyarr);
?>

<table align="top" style="table-layout: fixed" width="590px"  border=0 cellpadding=3 cellspacing=1 class="stdtable">
<tr>
<thead>
<th width="90px" class="head0"><span class="labeltext" align="center"><b>PRN</b></th>
<th width="90px"  class="head1"><span class="labeltext" align="center"><b>Sch Date</b></th>
<th width="90px" class="head0"><span class="labeltext" align="center"><b>Sch Po Qty</b></th>
<th width="90px"  class="head1"><span class="labeltext" align="center"><b>PO Projection</b></th>
</tr>
<?php
foreach($crnarr as $crn2 => $values) 
{ 
   foreach($values as $date => $qty) 
   {    $udate=$date;  
        $datearr = split('-', $date);
        $d=$datearr[2];
        $m=$datearr[1];
        $y=$datearr[0];
        $x=mktime(0,0,0,$m,$d,$y);
        $date1=date("M j, Y",$x);
   } 
   break;
}
$i = 0;
$suffix = '';
while ($i < 13)
{
    $nextdate=mktime(0,0,0,date("m")+$i,date("d"),date("Y"));
    $nextmonth = date("Y-m-d", $nextdate);
    $datearr = split('-', $nextmonth);
    $d=$datearr[2];
    $m=$datearr[1];
    $y=$datearr[0];
    $x=mktime(0,0,0,$m,$d,$y);
    $rmpodate1=date("M j, Y",$x);
  $i++;
}
?>
</table>
<table style="table-layout: fixed;width:100%" border=0 cellpadding=3 cellspacing=1 class="stdtable">
<?php
$cond='';
if($crn!='')
{
$cond='and w.crn_num like '."'".$crn."%'";
$cond1='where w.crn_num like '."'".$crn."%'".$cond;
}
else
{
$cond='';
$cond1=''.$cond;
}
foreach ($crnonlyarr as $uniquecrn) 
{
$crn = $uniquecrn;

$result = $newreport->getcrnfromlob($cond1,$crn);
$total=0;
$total4dis=0;
$total4grn=0;
$totalgrn_quar=0;
$totalbalance=0;
$totalbalance_quar=0;
$totaldn_qty=0;
$totalrecd_qty=0;
$totalrmpoqty=0;
$woprocarr = array("Assembly","Untreated","Treated");
while($myrow4crn=mysql_fetch_row($result))
{
 $dnSent_qty=0;
 $dnRecd_qty=0; 
 $part_num=wordwrap($myrow4crn[4],30,"<br>\n");

foreach ($woprocarr as $proc)
{
//echo "process is $proc<br>";

$openflag=0;
$results = $newreport->getallCRN4open($myrow4crn[1],$proc);
while($myrow4=mysql_fetch_row($results))
{
 if($proc == "Treated")
 {
  $dn = $newreport->getdn_qty($myrow4crn[1],$proc);
  $dn_sent = split("\|",$dn);
  $dnSent_qty = $dn_sent[0];
  $dnRecd_qty = $dn_sent[1];
  $total = $total + ($myrow4[2]-$dn_sent[0]);
  $totalrecd_qty += $dn_sent[0];
 }
 else
 {
  $total = $total + $myrow4[2];
 }
}
if($proc == 'Treated')
{
  $totaldn_qty += ($dnSent_qty-$dnRecd_qty);
}

$result4closed = $newreport->getallCRN4closed($myrow4crn[1],$proc);
while($myrow4closed=mysql_fetch_row($result4closed))
{
$result1 = $newreport->getallCRNDetails($myrow4closed[0],$myrow4closed[2],$proc);
$num_rows = mysql_num_rows($result1);
if($num_rows=='0')
{
$total4dis = $total4dis + $myrow4closed[2];
}
while($myrow4dispatch=mysql_fetch_row($result1))
{
$total4dis = $total4dis + $myrow4dispatch[0];
}
}

$resultall = $newreport->getCRN($myrow4crn[1],'Regular');
while($myrow4all=mysql_fetch_row($resultall))
{
$result2 = $newreport->getallGRN4Details($myrow4all[2],$myrow4all[0],$myrow4all[1],'Regular');
$num_rows = mysql_num_rows($result2);
if($num_rows=='0')
{
}
while($myrow4grn=mysql_fetch_row($result2))
{
 $result4 = $newreport->get_woretqty($myrow4grn[0]);
 $myrow= mysql_fetch_row($result4);
 $balance=$myrow[1]+$myrow4grn[2];
 if ($proc == 'Untreated')
 {
 $total4grn = $total4grn + $balance;
 $totalbalance =$totalbalance+$balance;
 }
}
}
$totalbalance='&nbsp';
$result_crn_quar = $newreport->getCRN($myrow4crn[1],'Quarantined');
while($myrow4crn_quar=mysql_fetch_row($result_crn_quar))
{
 $result_grnDet_quar = $newreport->getallGRN4Details($myrow4crn_quar[2],$myrow4crn_quar[0],$myrow4crn_quar[1],'Quarantined');
 $num_rows = mysql_num_rows($result_grnDet_quar);
while($myrow4grn_quar=mysql_fetch_row($result_grnDet_quar))
{
  $result_ret_quar = $newreport->get_woretqty($myrow4grn_quar[0]);
  $myrow_ret= mysql_fetch_row($result_ret_quar);
  $balance_quar=$myrow_ret[1]+$myrow4grn_quar[2];
  if ($proc == 'Manufacture Only')
  {
   $totalgrn_quar = $totalgrn_quar+$balance_quar;
   $totalbalance_quar = $totalbalance_quar+$balance_quar;
  }
 }
}

$totalbalance='&nbsp';
$totalbalance_quar='&nbsp';
$poarray = array();
$result4rmpo=$newreport->get_rmpotqty4lob($myrow4crn[1],'0000-00-00',$currmnth);
$myrmpo=mysql_fetch_row($result4rmpo);
$totalrmpoqty0 = $myrmpo[1];
 $poarray[0] = $totalrmpoqty0;
$rmpoqty0 = $myrmpo[1];
$result4rmpo=$newreport->get_rmpotqty4lob($myrow4crn[1],$currmnth,$currmnthplus1);
$myrmpo=mysql_fetch_row($result4rmpo);
$totalrmpoqty1 = $myrmpo[1];
$poarray[1] = $totalrmpoqty1;
$rmpoqty1 = $myrmpo[1];
$result4rmpo=$newreport->get_rmpotqty4lob($myrow4crn[1],$currmnthplus1,$currmnthplus2);
$myrmpo=mysql_fetch_row($result4rmpo);
$totalrmpoqty2 = $myrmpo[1];
$poarray[2] = $totalrmpoqty2;
$rmpoqty2 = $myrmpo[1];
$result4rmpo=$newreport->get_rmpotqty4lob($myrow4crn[1],$currmnthplus2,$currmnthplus3);
$myrmpo=mysql_fetch_row($result4rmpo);
$totalrmpoqty3 = $myrmpo[1];
$poarray[3] = $totalrmpoqty3;
$rmpoqty3 = $myrmpo[1];
$result4rmpo=$newreport->get_rmpotqty4lob($myrow4crn[1],$currmnthplus3,$currmnthplus4);
$myrmpo=mysql_fetch_row($result4rmpo);
$totalrmpoqty4 = $myrmpo[1];
$poarray[4] = $totalrmpoqty4;
$rmpoqty4 = $myrmpo[1];
$result4rmpo=$newreport->get_rmpotqty4lob($myrow4crn[1],$currmnthplus4,$currmnthplus5);
$myrmpo=mysql_fetch_row($result4rmpo);
$totalrmpoqty5 = $myrmpo[1];
$poarray[5] = $totalrmpoqty5;
$rmpoqty5 = $myrmpo[1];
$result4rmpo=$newreport->get_rmpotqty4lob($myrow4crn[1],$currmnthplus5,$currmnthplus6);
$myrmpo=mysql_fetch_row($result4rmpo);
$totalrmpoqty6 = $myrmpo[1];
$poarray[6] = $totalrmpoqty6;
$rmpoqty6 = $myrmpo[1];
$result4rmpo=$newreport->get_rmpotqty4lob($myrow4crn[1],$currmnthplus6,$currmnthplus7);
$myrmpo=mysql_fetch_row($result4rmpo);
$totalrmpoqty7 = $myrmpo[1];
$poarray[7] = $totalrmpoqty7;
$rmpoqty7 = $myrmpo[1];
$result4rmpo=$newreport->get_rmpotqty4lob($myrow4crn[1],$currmnthplus7,$currmnthplus8);
$myrmpo=mysql_fetch_row($result4rmpo);
$totalrmpoqty8 = $myrmpo[1];
$poarray[8] = $totalrmpoqty8;
$rmpoqty8 = $myrmpo[1];
$result4rmpo=$newreport->get_rmpotqty4lob($myrow4crn[1],$currmnthplus8,$currmnthplus9);
$myrmpo=mysql_fetch_row($result4rmpo);
$totalrmpoqty9 = $myrmpo[1];
$poarray[9] = $totalrmpoqty9;
$rmpoqty9 = $myrmpo[1];
$result4rmpo=$newreport->get_rmpotqty4lob($myrow4crn[1],$currmnthplus9,$currmnthplus10);
$myrmpo=mysql_fetch_row($result4rmpo);
$totalrmpoqty10 = $myrmpo[1];
$poarray[10] = $totalrmpoqty10;
$rmpoqty10 = $myrmpo[1];
$result4rmpo=$newreport->get_rmpotqty4lob($myrow4crn[1],$currmnthplus10,$currmnthplus11);
$myrmpo=mysql_fetch_row($result4rmpo);
$totalrmpoqty11 = $myrmpo[1];
$poarray[11] = $totalrmpoqty11;
$rmpoqty11 = $myrmpo[1];
$result4rmpo=$newreport->get_rmpotqty4lob($myrow4crn[1],$currmnthplus11,$currmnthplus12);
$myrmpo=mysql_fetch_row($result4rmpo);
$totalrmpoqty12 = $myrmpo[1];
$poarray[12] = $totalrmpoqty12;
$rmpoqty12 = $myrmpo[1];
}
$crndataarray[$crn]=$myrow4crn[1];
}
$reqfrompo='';
$totalrmpoqtycomp='';
$totalrmpoqtyeqn='';
    $fg = $total+$totaldn_qty+$total4dis;
    $grn = $total4grn;
$bufferqty = 0;
$count = 0;
foreach ($crnarr[$crn] as $date => $qtyreq) 
{
  
     if ($qtyreq != 0)
     {
         $bufferqty += $qtyreq;
         $count++;
     }
}
if ($bufferqty > 0)
{
   $bufferavg = $bufferqty / $count;
}
else
{
   $bufferavg = 0;
}
foreach ($crnarr[$crn] as $date => $qtyreq) 
{ 
  //echo $qtyreq.'======';
  if ($qtyreq != 0)
  {    
     if ($qtyreq == $fg)
     {
       $equation=$fg . "fg";       
     }       // Next check if req qty is < Finished Goods qty (fg); if so, color green
     else if ($qtyreq < $fg)
     {
        $equation=$qtyreq . "fg";        
          $fg = $fg - $qtyreq;
      }

    else if ($qtyreq < ($fg+$grn))
      {
          $nextdate=mktime(0,0,0,date("m")+1,date("d"),date("Y"));
                  $grn2mfrdate = date("Y-m-d", $nextdate);
         /* echo "<br>grnmfrdate is $grn2mfrdate";
          echo "<br>date is $date";
          echo "<br>fg is $fg";*/
          $reqfromgrn = $qtyreq-$fg;
          $equation = $fg . "fg + " . $reqfromgrn . "grn";
        
            $grn = $grn + $fg - $qtyreq;
          $fg=0;
     }


   else  if ($qtyreq < ($fg+$grn+$poarray[0]))
      {
        //echo "<br>Here poarray0 is $poarray[0]";
            poequation(1);
      $equation = $fg . "fg + " . $grn . "grn  " .  $totalrmpoqtyeqn;
     }
   else  if ($qtyreq < ($fg+$grn+$poarray[0]+$poarray[1]))
      {
        //echo "<br>Here poarray1 is $poarray[1]";
            poequation(2);
      $equation = $fg . "fg + " . $grn . "grn " .  $totalrmpoqtyeqn;  

     }
   else  if ($qtyreq < ($fg+$grn+$poarray[0]+$poarray[1]+$poarray[2]))
      {
        //echo "<br>Here poarray2 is $poarray[2]";
            poequation(3);
      $equation = $fg . "fg + " . $grn . "grn " .  $totalrmpoqtyeqn;

     }

   else  if ($qtyreq < ($fg+$grn+ $poarray[0]+$poarray[1]+$poarray[2]+$poarray[3]))
      {
            poequation(4);
      $equation = $fg . "fg + " . $grn . "grn " .  $totalrmpoqtyeqn;

     }

   else  if ($qtyreq < ($fg+$grn+$poarray[0]+$poarray[1]+$poarray[2]+$poarray[3] + 
                                    $poarray[4]))
      {
            poequation(5);
      $equation = $fg . "fg + " . $grn . "grn " .  $totalrmpoqtyeqn;

     }
   else  if ($qtyreq < ($fg+$grn+$poarray[0]+$poarray[1]+$poarray[2]+$poarray[3] + 
                                    $poarray[4]+$poarray[5]))
      {
            poequation(6);
      $equation = $fg . "fg + " . $grn . "grn " .  $totalrmpoqtyeqn;    

     }

   else  if ($qtyreq < ($fg+$grn+$poarray[0]+$poarray[1]+$poarray[2]+$poarray[3] + 
                                    $poarray[4]+$poarray[5] + $poarray[6]))
      {          
        poequation(7);
      $equation = $fg . "fg + " . $grn . "grn " .  $totalrmpoqtyeqn;    
     }
   else  if ($qtyreq < ($fg+$grn+$poarray[0]+$poarray[1]+$poarray[2]+$poarray[3] + 
                                    $poarray[4]+$poarray[5] + $poarray[6] + $poarray[7]))
      {          
            poequation(8);
      $equation = $fg . "fg + " . $grn . "grn " .  $totalrmpoqtyeqn;      
     }
   else  if($qtyreq < ($fg+$grn+$poarray[0]+$poarray[1]+$poarray[2]+$poarray[3] + 
                                    $poarray[4]+$poarray[5] + $poarray[6] + $poarray[7] + $poarray[8]))
      {          
            poequation(9);
      $equation = $fg . "fg + " . $grn . "grn " .  $totalrmpoqtyeqn;      
     }
   else  if ($qtyreq < ($fg+$grn+$poarray[0]+$poarray[1]+$poarray[2]+$poarray[3] + 
                                    $poarray[4]+$poarray[5] + $poarray[6] + $poarray[7] + 
                                    $poarray[8] + $poarray[9]))
      {           
        poequation(10);
      $equation = $fg . "fg + " . $grn . "grn " .  $totalrmpoqtyeqn;    

     }

   else  if ($qtyreq < ($fg+$grn+$poarray[0]+$poarray[1]+$poarray[2]+$poarray[3] + 
                                    $poarray[4]+$poarray[5] + $poarray[6] + $poarray[7] + 
                                    $poarray[8] + $poarray[9] + $poarray[10]))          
      {
            poequation(11);
      $equation = $fg . "fg + " . $grn . "grn  " .  $totalrmpoqtyeqn;    
     }
   else  if ($qtyreq < ($fg+$grn+$poarray[0]+$poarray[1]+$poarray[2]+$poarray[3] + 
                                    $poarray[4]+$poarray[5] + $poarray[6] + $poarray[7] + 
                                    $poarray[8] + $poarray[9] + $poarray[10] + $poarray[11]))         
      {
            poequation(12);
      $equation = $fg . "fg + " . $grn . "grn " .  $totalrmpoqtyeqn;    

     }
   else  if ($qtyreq < ($fg+$grn+$poarray[0]+$poarray[1]+$poarray[2]+$poarray[3] + 
                                    $poarray[4]+$poarray[5] + $poarray[6] + $poarray[7] + 
                                    $poarray[8] + $poarray[9] + $poarray[10] + $poarray[11] + $poarray[12]))          
      {
            poequation(13);
      $equation = $fg . "fg + " . $grn . "grn  " .  $totalrmpoqtyeqn;
    
     }
    // Else color red if none of the above succeeds
      else
    {
        $totalrmpoqtycomp = 0;
          $totalrmpoqtyeqn = "";
        for ($i = 0; $i <= 12; $i++)
         {
                  $poqtysum += $poarray[$i];          
          if ($poarray[$i] != 0)
            {
                       $totalrmpoqtyeqn .= "+ $poarray[$i]" .  "po{$i}";
              $poarray[$i] = 0;
            }
        }
      $equation = $fg . "fg + " . $grn . "grn  " .  $totalrmpoqtyeqn; 
        $shortfall = $qtyreq - ($fg+$grn+$poqtysum);
        $poqtysum = 0;
     
      $datearr=split('-',$date);
      $d=$datearr[2];
          $m=$datearr[1];
          $y=$datearr[0];   
      if($proc=='Untreated')
      {
             $x=mktime(0,0,0,$m-4,$d,$y);
      }
      else
      {
             $x=mktime(0,0,0,$m-5,$d,$y);
      }          
          $date2=date("M j, Y",$x);
          $schdate=date('M d,Y',strtotime($date));  
          // echo $prevcrn . " " . $crn;
          echo "<tr>";
      if($prevcrn!=$crn)
            {
// echo "prevcrn " .$prevcrn . "crn  ". $crn;
                 echo "<td align=\"center\" bgcolor=\"#FFFFFF\"  width=\"90px\"><span class=\"tabletext\">$crn</td>";
         echo "<td align=\"center\" bgcolor=\"#FFFFFF\"  width=\"90px\"><span class=\"tabletext\">$schdate</td>";
          echo "<td align=\"center\" bgcolor=\"#FFFFFF\"  width=\"90px\"><span class=\"tabletext\">$qtyreq($schdate)</td>";
        echo "<td align=\"center\" bgcolor=\"#FFFFFF\"  width=\"90px\"><span class=\"tabletext\">$date2</td>";
          echo "</tr>";
            }
      else
      {


          echo "<td align=\"center\" bgcolor=\"#FFFFFF\"  width=\"90px\"><span class=\"tabletext\">&nbsp;</td>";
          echo "<td align=\"center\" bgcolor=\"#FFFFFF\"  width=\"90px\"><span class=\"tabletext\">$schdate</td>";
            echo "<td align=\"center\" bgcolor=\"#FFFFFF\" width=\"90px\"><span class=\"tabletext\">$qtyreq($schdate)</td>";
          echo "<td align=\"center\" bgcolor=\"#FFFFFF\"  width=\"90px\"><span class=\"tabletext\">$date2</td>";
          echo "</tr>";
          $prevcrn=$crn;
          $fg = 0;
          $grn = 0;
          $poqtysum=0;
    }
  
     // 
    }
  }

  else
  {
        // echo "<td align=\"center\" bgcolor=\"#FFFFFF\" width=\"100px\"><span class=\"labeltext\">$qtyreq</td>";
  }
   }   
 }
}
}
echo "</table>";



function poequation($pocount)
{
   // GLOBAL $totalrmpoqty0, $totalrmpoqty1, $totalrmpoqty2, $totalrmpoqty3, 
//                 $totalrmpoqty4, $totalrmpoqty5, $totalrmpoqty6, $totalrmpoqty7, 
//                 $totalrmpoqty8, $totalrmpoqty9, $totalrmpoqty10, $totalrmpoqty11,
//                    $totalrmpoqty12, $reqfrompo;
    GLOBAL $poarray, $qtyreq, $fg, $grn, $reqfrompo, $totalrmpoqtycomp,$totalrmpoqtyeqn;
  $totalrmpoqtycomp = 0;
  $totalrmpoqtyeqn = "";
  $usedfrompo = 0;
  for ($i = 0; $i < $pocount; $i++)
  {
        $index = $pocount -1;
      
      if ($poarray[$i] == '' || $poarray[$i] == 0)
        {
        $poarray[$i] = 0;
         }
            else
      {
                $totalrmpoqtycomp = $totalrmpoqtycomp + $poarray[$i];
          //echo "<br>totalpo till now is $totalrmpoqtycomp";
          $reqfrompo = $qtyreq-($fg+$grn)-$usedfrompo;
          //echo "<br>reqfrom po for $i is $reqfrompo";
          if ($reqfrompo > $poarray[$i])
          {
                $usedfrompo = $poarray[$i];
            $poarray[$i] = 0;
            $totalrmpoqtyeqn .= "+ $usedfrompo" . "po{$i}";
          }
          else
          {
                $usedfrompo = $reqfrompo;
            $poarray[$i] = $poarray[$i] - $reqfrompo;
            $totalrmpoqtyeqn .= "+ $usedfrompo" . "po{$i}";
          }           
          //echo "<br>reqfrom po for $i is $reqfrompo";
          //echo "<br>In function value of poarray for $i is $poarray[$i]";
          //var_dump($poarray);
           }
            //$poarray[$index] = 0;
  }
  $reqfrompo = $qtyreq-($fg+$grn+$totalrmpoqtycomp);
  //echo "<br>In function value of reqfrom po is $reqfrompo and pocount is $pocount";
  //echo "<br>In function value of poarray for $index is $poarray[$index]";
}

?>
</tr>
</table>
</div>


</td>

<tr><td valign='top'>

<table width=100% style="border-right:2px solid black" cellpadding=6 cellspacing=0 height='347px'>
<tr><td valign='top'>
<div id='this_week_disp' style="width:524px; overflow:auto;height:385;">
<table  width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
<tr>
<td colspan=6 align="center" bgcolor="#bababa"><span class="heading"><b>This Week Dispatch</b></td>
</tr>
         <tr>
       <tr>
<td valign='top' bgcolor="#FFFFFF"><span class="labeltext"><b>PRN:</b>&nbsp;
<input type="text" size=15% name="crn_disp" id="crn_disp" value="prn6"></td>
<td  bgcolor='#FFFFFF'> <img src="images/bu-get.gif" value="Get"
            onclick="javascript: getthis_week_disp_report('this_week_disp')"></td>
</tr>    
</table>

<table  width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable">
<?php
$crn_disp='28-005';
?>
<tr>
<thead>
<th  width='20px' class="head0"><span class="tabletext" align='center'><b>PRN</b></th>
<th  width='20px'  class="head1"><span class="tabletext" align='center'><b>Sch Due Date</b></th>
<th  width='20px' class="head0"><span class="tabletext" align='center'><b>FG</b></th>
<th  width='20px' class="head1"><span class="tabletext" align='center'><b>Sch Qty</b></th>
<th  width='20px' class="head0"><span class="tabletext" align='center'><b>Disp</b></th>
<th  width='20px' class="head1"><span class="tabletext" align='center'><b>BALANCE</b></th>
</tr>
<tr bgcolor="#FFFFFF">
<?php.
$cond="d.crnnum like '".$crn_disp."%' and d.schedule_date between'".$first_day_of_week."' and '".$last_day_of_week."' and w.crn_num=d.crnnum";
$result = $newreport->get_thisweekdisp($cond);
$balance=0;
$prevcrn1="#";
while($myrow=mysql_fetch_row($result))
{        
         $sch_date=date('M d, Y',strtotime($myrow[2]));    
      // echo $prevcrn1."----";
            if($prevcrn1 == $myrow[1])
          {
          $balance=$balance-$myrow[3];
        $crn='';
        $fg='';
      }
      else
          {
        //echo "<br>HERE--- $myrow[4]---$myrow[5]---$myrow[6]----$myrow[3]<br>";
      $fg=$myrow[4]-($myrow[5]+$myrow[6]);
      $balance=$fg-$myrow[3];
      $crn=$myrow[1]; 
      $prevcrn1 = $myrow[1];


      }
       printf('<tr bgcolor="#FFFFFF">
           <td width="20px" align="center"><span class="tabletext">%s</td>',$crn_disp);
       printf('<td width="20px" align="center"><span class="tabletext">%s</td>',$sch_date);
       printf('<td width="20px" align="center"><span class="tabletext">%s</td>',$fg);     
       printf('<td width="20px" align="center"><span class="tabletext">%s</td>',$myrow[3]); 

       printf('<td width="20px" align="center"><span class="tabletext">%s</td>',$myrow[5]);     
       if($balance < 0)
       {
       printf('<td bgcolor="#ff6600" width="20px" align="center"><span class="tabletext">%s</td></tr>',$balance);  
     }else
     {
       printf('<td width="20px" align="center"><span class="tabletext">%s</td></tr>',$balance);
      } 
       $prevcrn=$myrow[1];

}
?>
</table>
</div>
</table>
</td>
<td valign='top'>
<table width=100% border=0 cellpadding=6 cellspacing=0 height='320px'>
<tr><td valign='top'>

<table  width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
 <tr>
    <td colspan=6 align="center" bgcolor="#bababa"><span class="heading"><b>BOI Schedule</b></td>
  </tr>
<tr>
<td valign='top' bgcolor="#FFFFFF"><span class="labeltext"><b>Part No.</b>&nbsp;
<input type="text" size=15% name="partnum" id="partnum" value="1234"></td>
<td  bgcolor='#FFFFFF'> <img src="images/bu-get.gif" value="Get"
            onclick="javascript: getboi_sch_report('boischedule')"></td>
</tr>
</table>

<!-- <table valign="top" width="100%" border=0 cellpadding=3 cellspacing=1 bgcolor="#FFFFFF">
<tr bgcolor="#FFFFFF">
<td valign='top'> -->
<table align="top" style="table-layout: fixed" width="87%" style="border:1px solid #000000;" border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable">
<tr>
<thead>
<th width="30%" class="head0"><span class="labeltext"><b>Part Number</b></th>
<th width="10%"  class="head1"><span class="labeltext"><b>GRN Qty<br/>(Bal.)</b></th>
<th width="15%"  class="head0"><span class="labeltext" align="center"><b>Sch Date</b></th>
<th width="15%" class="head1"><span class="labeltext" align="center"><b>PRN</b></th>
<th width="15%" class="head0"><span class="labeltext" align="center"><b>Sch Qty</b></th>
<th width="15%" class="head1"><span class="labeltext" align="center"><b>Balance</b></th>
</tr>
</table>
<div id='boischedule' style="width:514px; overflow:auto;height:300;">
<table valign="top" width="100%" border=0 cellpadding=3 cellspacing=1 class="stdtable">
<?
$partnum='123';
if($partnum!='')
{
$lobresult = $newreport->getlob4boi($partnum);
  $prev_partnum='';
  $prev_grn='';
  $prev_schdate='';
  $balance=0;
while($myrow=mysql_fetch_array($lobresult))
{ 
  $total4grn=0;
  $resultall = $newreport->getCRN4boi($partnum);
  $myrow4all=mysql_fetch_row($resultall);
  $total4grn=$myrow4all[3];

  printf('<tr bgcolor="#FFFFFF">');
    if($myrow[0] != $prev_partnum)
  {
      echo '<td align="center" width="16%" ><span class="labeltext">'.$myrow[0].'</font></td>';
    }else
  {
             echo '<td align="center" width="16%" >&nbsp;</td>';
  }
    if($total4grn != $prev_grn)
  {
     echo '<td align="center" width="16%" ><span class="labeltext">'.$total4grn.'</font></td>';
  }
  else
  {
     echo '<td align="center" width="16%" >&nbsp;</td>';
  }

    $date1=date("M j, Y",strtotime($myrow[3]));
  if($myrow[3]!=$prev_schdate)
  {
     echo '<td align="center" width="15%" ><span class="labeltext">'.$date1.'</font></td>';
  }
  else
  { 
      echo '<td align="center" width="15%" >&nbsp;</td>';
  }
  echo '<td align="center" width="15%" ><span class="labeltext">'.$myrow[1].'</font></td>';
  
  echo '<td align="center" width="15%" ><span class="labeltext">'.$myrow[2].'</font></td>';
    if($prev_partnum!= $myrow[0])
  {
      $balance=$total4grn-$myrow[2];
  }
  else
  { 
    $balance=$balance-$myrow[2];
  }
  if($balance <0)
  $colour='#FF0000';
    else
  $colour='#FFFFFF';  
    
  echo "<td align=\"center\" width=\"15%\" bgcolor='$colour'><span class=\"labeltext\">$balance</td>"; 
  $prev_partnum=$myrow[0];
  $prev_grn=$total4grn;
  $prev_schdate=$myrow[3];

}
}
?>
</tr>
</table></table>
</tr>
</table>
</tr>
</table>
</div>
</table>
</table>
</form>
</body>
</html>
