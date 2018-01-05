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
$prn_disp=$_REQUEST['prn'];
$start_date=$_REQUEST['frm'];

$prn_outlook = $_REQUEST['crn'];

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



$ftrigger=$_REQUEST['ftrigger'];



if (!isset($_REQUEST['ftrigger']) or 
     $ftrigger == '' or
   ($ftrigger != 'ALL' && 
    $ftrigger != 'all' && 
    $ftrigger != 'TREAT' &&
    $ftrigger != 'treat' && 
    $ftrigger != 'WO' && 
    $ftrigger != 'wo' && 
    $ftrigger != 'RMPO'))
    $ftrigger = 'rmpo';
// by default we show first page
$pageNum = 1;
$crnarr = array();
$crnonlyarr = array();

$dispcrnarr = array();
$dispcrnarr1 = array();
// poarr stores the key as order date (60 days subtracted from sch date)
$poarr = array();
// podtarr stores the sch date with order date as key needed for printing
$podtarr = array();
// wotrigarr stores the key as wo create date 
// (60 days subtracted from sch date)
$wotrigarr = array();
// wodtarr stores the sch date with wo create date as key 
//  needed for printing
$wodtarr = array();

// treattrigarr stores the key as wo create date 
// (60 days subtracted from sch date)
$treattrigarr = array();
// wodtarr stores the sch date with wo create date as key 
//  needed for printing
$treatdtarr = array();

/*$schweekarr = array('2015-07-20','2015-07-27',
           '2015-08-03','2015-08-10','2015-08-17','2015-08-24','2015-08-31',
           '2015-09-07','2015-09-14','2015-09-21','2015-09-28','2015-10-05',
           '2015-10-12','2015-10-19','2015-10-26','2015-11-02','2015-11-09',
           '2015-11-16','2015-11-23','2015-11-30','2015-12-07','2015-12-14',
           '2015-12-21','2015-12-28'
           );
*/
$schweekarr4disp = array();

// Create the work-week(52 weeks from today) array starting from 
// run date week's beginning Monday
$wwbegindate14disp= date("Y-m-d", strtotime('monday this week'));
$wwbegindate4disp= date("Y-m-d", strtotime('monday this week'));
array_push($schweekarr4disp,$wwbegindate4disp);
$newdate = date("Y-m-d", strtotime($wwbegindate4disp . "+7 day"));
for ($x = 0; $x <= 4; $x++) {
    $newdate4disp = date("Y-m-d", strtotime($wwbegindate4disp . "+7 day"));
  array_push($schweekarr4disp,$newdate4disp);
  $wwbegindate4disp = $newdate4disp;
} 


$schweekarr = array();

// Create the work-week(52 weeks from today) array starting from 
// run date week's beginning Monday
$wwbegindate1= date("Y-m-d", strtotime('monday this week'));
$wwbegindate= date("Y-m-d", strtotime('monday this week'));
array_push($schweekarr,$wwbegindate);
$newdate = date("Y-m-d", strtotime($wwbegindate . "+7 day"));
for ($x = 0; $x <= 49; $x++) {
    $newdate = date("Y-m-d", strtotime($wwbegindate . "+7 day"));
  array_push($schweekarr,$newdate);
  $wwbegindate = $newdate;
}


?>
<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/report.js"></script>
<script language="javascript" src="scripts/jquery.js"></script>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="scripts/jquery.freezetablecolumns.1.1.js"></script>


<html>
<head>
<title>HEART BEAT</title>
</head>
<body leftmargin="0" topmargin="0" marginwidth="0">
<style type="text/css">
body {
      width: 1200px;
    }

#freeze-table {
      width: 1200px;
    }    
    
</style>

  <script type="text/javascript">
    $(document).ready(function(){
      $('#freeze-table').freezeTableColumns({
        width:       1000,   // required
        height:      300,   // required
        numFrozen:   8,     // optional
        clearWidths: true,  // optional
      });
    });
</script>
<form  action='dashboard.php' method='post' enctype='multipart/form-data'>
<?php
include('header.html');
?>


<table  style="border:2px solid black" cellpadding=6 cellspacing=0  style="width:100%">
<tr><td style="vertical-align: text-top;">
<table style="border-right:2px solid black;width:100%"  cellpadding=6 cellspacing=1 height='320px'>
<tr><td valign='top' style="vertical-align: text-top;">
<div id='pending_dispatch' style="width:550px;height:300; margin: 6px 9px 27px;">
<table  width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDFDF" >
<tr  bgcolor="#00DDFF">
<td colspan=7 align="center" bgcolor="#00DDFF"><span class="heading"><b>FOUR WEEKS PENDING DISPATCH</b></td>

</table>

<table valign="top" style="width:100%" border=0 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF" class="stdtable">
 <tr bgcolor="#F5F6F5">
<td align="center" colspan=7><span class="heading"><b>Search Criteria</b></td></tr>
<tr>
<td valign='top' bgcolor="#FFFFFF"><span class="labeltext"><b>PRN:</b>&nbsp;
<input type="text" size=15% name="prn_disp" id="prn_disp" value="<?echo $_REQUEST['prn_disp'] ?>">
<img src="images/bu-get.gif" value="Get"
onclick="javascript: get4weekspendingdisp('pending_dispatch')">
</td>
</td>
</tr> 
</table>
<div id="disp_loader"></div>
<?php

$crnkarray = array();
$partnumarray = array();
$bufferarray = array();

  
$lobresult = $newreport->getpenddelivery_sch4weeks($prn_disp);
        
while($mylobrow=mysql_fetch_row($lobresult))
{
          $crn1 = $mylobrow[0];
           $date = $mylobrow[1];             
           $qty = $mylobrow[2];
           $partnum = $mylobrow[3];
           $buffer = $mylobrow[4];

   
          $datedi  = date("Y-m-d", strtotime($wwbegindate14disp . "+7 day"));
            
        // echo $datedi . "  " . $wwbegindate1 ."<BR>" ;
      if ($newhelper->dateDiff('-', $date, $datedi ) <0)
         {
          // echo $crn1 .  "--" . $qty ."<Br>";                        
         $crnarr[$crn1][$wwbegindate1]
          += $qty;

        }
      else 
      { 

        $crnarr[$crn1][$date] = $qty;

      }
        $crndispyarr[$crn1] = $crn1;
        $partnumarr[$crn1] = $partnum;
        $bufferarr[$crn1] = $buffer;
      
}

?>
<table align="top"   style="table-layout: fixed;width:100%;"  style="border:1px solid #000000;" border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable">
<thead>
<tr bgcolor="#FFCC00">
<td width="50px"  align="center" bgcolor="#EEEFEE"><span class="labeltext" align="center"><b>PRN</b></td>
<td width="50px"  align="center" bgcolor="#EEEFEE"><span class="labeltext"><b>Part#</b></td>

<?php
$ft = 0;

for ($z=0;$z<=4;$z++) 
{ 
  
    $date1 = $schweekarr4disp[$z];
  $datearr = split('-', $date1);
    $d=$datearr[2];
    $m=$datearr[1];
    $y=$datearr[0];
    $x=mktime(0,0,0,$m,$d,$y);
  if ($ft == 0)
  {
       $schdate1=date("M j, Y",$x);
      echo "<td align=\"center\" width=\"70px\" bgcolor=\"#00DDFF\" align=\"left\"><span class=\"schtext\" ><b>WW<br/>starting<br> $schdate1<br>(Potential Backlog)</b></td>";
      $schdateb = $date1 ;
    }
  else
  {
       $schdate1=date("M j, Y",$x);
      echo "<td align=\"center\" width=\"50px\" bgcolor=\"#00DDFF\" align=\"left\"><span class=\"schtext\" ><b>WW<br/>starting<br> $schdate1</b></td>";
    }
  $ft = 1;
}


  $i = 0;
  $suffix = '';
?>
</tr>
 </thead>
</table>
<div style="width:100%; height:100; overflow-y:auto; hidden;border:" class="stdtable">
<table align="top"   style="table-layout: fixed;width:100%;"   style="border:1px solid #000000;" border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
<thead>


<?php

foreach ($crndispyarr as $crn) 
{
  $crnflag = 0;
    $partnum = $partnumarr[$crn];
    $buffer = $bufferarr[$crn];
    $colorval2 ="style=background-color:#00DDFF" ;
    $crnarrval = explode("-", $crn);
    $crnval = $crnarrval[0];
  

    printf('<tr bgcolor="#FFFFFF" >
      <td bgcolor="#FFFFFF" align="center" width="50px" %s><span class="labeltext"><font color="black">%s</font></td>
      <td bgcolor="#FFFFFF" align="center" width="50px" ><span class="labeltext">%s</td>
      ',
    $colorval2,$crn,$partnum);


   
  
for ($j=0; $j<=4; $j++) 
{

    
    $data = '';
    $thisweek = $j;
    $nextweek = $thisweek+1;
    $fromdate = $schweekarr[$thisweek];
      $todate = $schweekarr[$nextweek];
           
     $flag =  0; 
      foreach ($crnarr as $key => $value) 
      {
    
      foreach ($value as $dispdate => $data1) 
      {

        
         $data=''; 
        
     
      if($key ==  $crn)
        { 
         if (check_in_range($fromdate, $todate, $dispdate))
     {
               
                    $data = $data1 ;
           
          echo "<td width=\"70px\" align=\"center\"><span class=\"labeltext\">$data</td>";
                $flag = 1 ;
            
     }
    

    
   }  
        
  
    
  }
}


 if($flag != 1)
{
  //echo "<br/>".$crn." " .$fromdate. " ".$todate." ".$dispdate ." ".$data1." ".$flag. "<br/>";
        
  echo "<td width=\"50px\" align=\"center\"></td>";
}


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
<table  width=100% style="border:right:3px solid black;" cellpadding=3 cellspacing=2>
<tr><td>
<div id='wo_performance' style="width:420px; overflow:auto;height:300; margin: 6px 9px 27px;">
<table  width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
<tr>
<td colspan=3 align="center" bgcolor="#00DDFF"><span class="heading"><b>WO PERFORMANCE</b></td>
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
 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <img src="images/bu-get.gif" value="Get" 
            onclick="javascript: getwo_performance('wo_performance')">



            </td>
</tr>

<tr bgcolor='#FFFFFF'><td>
<?
 include_once 'ofc-library/open_flash_chart_object.php';
      open_flash_chart_object(570, 230, 'http://'. $_SERVER['SERVER_NAME'].'/fluenterp/chart-data.php?start_date_wo='.$start_date_wo.'&end_date_wo='.$end_date_wo, false);
    ?>

</td></tr>
</table>

</div>
</table>


</td>

</tr>
</table>
<table width="100%" border=0 cellpadding=6 cellspacing=1>
<tr><td>
</td></tr></table>
<br>
<div id='outlook'>

<table valign="top" width="100%" border=0 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF">
<tr bgcolor="#00DDFF">
<td align="center" colspan=7><span class="heading"><b>PRN OUTLOOK</b></td></tr>
<tr bgcolor="#F5F6F5">
<td align="center" colspan=7><span class="heading"><b>Search Criteria</b></td></tr>
<tr>
<td valign='top' bgcolor="#FFFFFF"><span class="labeltext"><b>PRN:</b>&nbsp;
<input type="text" size=15% name="prn_outlook" id="prn_outlook" value="prn1">
&nbsp;&nbsp;<span class="labeltext"><b>Trigger:</b>&nbsp;
<input type="text" size=15% name="ftrigger" id="ftrigger" value="<?echo $ftrigger; ?>">(ALL/RMPO/WO/TREAT)
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="images/bu-get.gif" value="Get"
           onclick="javascript: getprn_outlook('outlook')"></b>
</td>

</td>
</tr>

</table>
<div id="crn_loader"></div>
<?php

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
$schdtcount = 0;
$actcount = 0;



$countmaincrn = 0;
$crn = "prn1";

  $crntype=$newreport->getcrntype($crn);
    if($flag == 0)
    {
        $lobresult = $newreport->getlob1($crn,$crntype);
        }
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
<td width="90px" bgcolor="#FFFFFF"><span class="labeltext" align='center'><b>Borderline</b></td>
<td width="20px" bgcolor="#00DDFF"><span class="labeltext" align='center'>&nbsp</td>
<td width="100px" bgcolor="#FFFFFF"><span class="labeltext" align='center'><b>Qty from PO</b></td>
<td width="20px" bgcolor="#FF0000"><span class="labeltext" align='center'>&nbsp</td>
<td width="70px" bgcolor="#FFFFFF"><span class="labeltext" align='center'><b>Danger</b></td>
<td width="20px" bgcolor="#FFA500"><span class="labeltext" align='center'>&nbsp</td>
<td width="100px" bgcolor="#FFFFFF"><span class="labeltext" align='center'><b>GRN-to-Prodn</b></td>


<td width="20px" bgcolor="#990000"><span class="labeltext" align='center'>&nbsp</td>
<td width="100px" bgcolor="#FFFFFF"><span class="labeltext" align='center'><b>Trigger text</b></td>
<td width="39px" bgcolor="#FFFFFF"><span class="labeltext" align='center'>WW = </td>
<td width="100px" bgcolor="#FFFFFF"><span class="labeltext" align='center'><b>Work Week</b></td>
 </tr>
</table>
<table  id="freeze-table" align="top"  style="border:1px solid #000000;" border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
<thead>
<tr bgcolor="#FFCC00">
<td width="120px"  align="center" bgcolor="#EEEFEE"><span class="labeltext" align="center"><b>PRN</b></td>
<td width="180px"  align="center" bgcolor="#EEEFEE"><span class="labeltext"><b>Part Number</b></td>
<td width="100px"  align="center" bgcolor="#3BE8D4"><span class="labeltext"><b>Buffer</b></td>
<td width="100px"  align="center" bgcolor="#EEEFEE"><span class="labeltext"><b>WIP </b></td>
<td width="100px"  align="center" bgcolor="#EEEFEE"><span class="labeltext"><b>Post Process</b></td>

<td width="100px"  align="center" bgcolor="#EEEFEE"><span class="labeltext"><b>FG (fg)</b></td>
<td width="100px"  align="center" bgcolor="#EEEFEE"><span class="labeltext"><b>GRN (grn)</b></td>
<td width="100px"  align="center" bgcolor="#EEEFEE"><span class="labeltext"><b>Type</b></td>

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
</thead>
<tbody>




<!-- <table style="table-layout: fixed" border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" > -->
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



$crnvalold ="" ;


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
/*echo "<pre>";
print_r($crnarr);*/
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
  if($crntype =='Kit' && $crnv1[3] !='')
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
    <td bgcolor="#FFFFFF" align="center" width="120px" %s><span class="labeltext"><font color="black">%s</font></td>
    <td bgcolor="#FFFFFF" align="center" width="180px" ><span class="labeltext">%s</td>
    ',
  $colorval2,wordwrap($crn,10,"\n",true),$partnum1);

 printf('<td bgcolor="#00FF00" align="center" width="100px"><span class="labeltext">%d</td>' , $myrow4crn[5]);


printf('
     <td bgcolor="#FFFFFF" align="center" width="100px"><span class="schtext"><b>%d</b></td>
     <td bgcolor="#FFFFFF" align="center" width="100px"><span class="schtext"><b>%d</b></td>
     <td bgcolor="#FFFFFF" align="center" width="100px"><span class="schtext"><b>%d</b></td>
   <td bgcolor="#FFFFFF" align="center" width="100px"><span class="schtext"><b>%d</b></td>
    <td bgcolor="#FFFFFF" align="center" width="100px"><span class="schtext"><b>%s</b></td>
   ','','','',$grnbbal,$crntype);

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
      <td bgcolor="#FFFFFF" align="center" width="120px" %s><span class="labeltext"><font color="black">%s</font></td>
      <td bgcolor="#FFFFFF" align="center" width="180px"><span class="labeltext">%s</td>',
        $crn,$colorval1,wordwrap($crn,10,"\n",true),$part_num);

     printf('<td  align="center" bgcolor="#00FF00" width="100px"><span class="labeltext">%d</td>' , $myrow4crn[5]);


printf('
         <td bgcolor="#FFFFFF" align="center" width="100px"><span class="schtext"><b>%d</b></td>
         <td bgcolor="#FFFFFF" align="center" width="100px"><span class="schtext"><b>%d</b></td>
      
     <td bgcolor="#FFFFFF" align="center" width="100px"><span class="schtext"><b>%s</b></td>
     <td bgcolor="#FFFFFF" align="center" width="100px"><span class="schtext"><b>%d</b></td>
      <td bgcolor="#FFFFFF" align="center" width="100px"><span class="schtext">%s<b></b></td>
       ',$total,$totaldn_qty,$total4dis,$total4grn,$crntype);
    $fg = $totaldn_qty+$total4dis+$total_recd4stores;
    $grn = $total4grn;

}
}


$bufferqty = 0;
$count = 0;

/*echo "<pre>" ;
print_r($crnarr) ;*/
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
            poequation(1);
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
            poequation(2);
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
            poequation(3);
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
            poequation(4);
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
            poequation(5);
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
            poequation(6);
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
        poequation(7);
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
            poequation(8);
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
            poequation(9);
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
        poequation(10);
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
            poequation(11);
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
            poequation(12);
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
            poequation(13);
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
/*echo "<pre>";
print_r($poarr);*/

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


function check_in_range($start_date, $end_date, $date_from_user)
{
  // Convert to timestamp
  $start_ts = strtotime($start_date);
  $end_ts = strtotime($end_date);
  $user_ts = strtotime($date_from_user);

 // Check that user date is between start & end
 

  return (($user_ts >= $start_ts) && ($user_ts < $end_ts));
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
