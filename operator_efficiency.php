<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = March 15,2005                =
// Filename: operator_efficiency.php           =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OWT                          =
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

// First include the class definition
include('classes/loginClass.php');
include('classes/displayClass.php');
include('classes/operatorClass.php');
include('classes/reportClass.php');

$newlogin = new userlogin;
$newlogin->dbconnect();

$newdisplay = new display;
$newreport = new report;

$month = date('m');
$year = date('Y');
$date = "$year-$month-01";
$oper3= 'like';
$cond0 = "(to_days(op.st_date) > to_days('". $date ."')) and
           (to_days(op.st_date)-to_days('2050-12-31') < 0)";
$cond1 = "op.oper_name like 'Rames%'";
$cond = $cond0;

$cond2 = "employee.fname like 'Rames%'";

if ( isset ( $_REQUEST['sdate1'] ) || isset ( $_REQUEST['sdate2'] ) )
{
     $date1_match = $_REQUEST['sdate1'];
     $date2_match = $_REQUEST['sdate2'];
     if ( isset ( $_REQUEST['sdate1']) &&  $_REQUEST['sdate1'] != '' )
     {
          $date1 = $_REQUEST['sdate1'];
          $cond01 = "to_days(op.st_date) " . "> to_days('" . $date1 . "')";
     }
     else
     {
          $cond01 = "(to_days(op.st_date)-to_days('1582-01-01') > 0 || op.st_date = 'NULL' || op.st_date = '0000-00-00')";
     }

     if ( isset ( $_REQUEST['sdate2'] )  &&  $_REQUEST['sdate2'] != '')
     {
          $date2 = $_REQUEST['sdate2'];
          $cond02 = "to_days(op.st_date) " . "< to_days('" . $date2 . "')";
     }
     else
     {
          $cond02 = "(to_days(op.st_date)-to_days('2050-12-31') < 0 || op.st_date = 'NULL' || op.st_date = '0000-00-00')";
     }
     $cond0 = $cond01 . ' and ' . $cond02;

}
else
{
     $date1_match = "$year-$month-01";
     $date2_match = '';
}
if ( isset ( $_REQUEST['crn'] ) )
{
     $crn_match = $_REQUEST['crn'];
     if ( isset ( $_REQUEST['crn_oper'] ) ) {
          $oper3 = $_REQUEST['crn_oper'];
     }
     else {
         $oper3 = 'like';
     }
     if ($oper3 == 'like') {
         $crn =  $_REQUEST['crn'] ;
     }
     else {
         $crn =  $_REQUEST['crn'];
     }

     $cond1 = "op.oper_name " . $oper3 . " " . $crn;
     $pnamearr = split(' ',$crn);
     $fname =  "'" . $pnamearr[0]."%'";
     if(!isset($pnamearr[1]))
     {
       $lname = "'%'";
     }
     else
     {
       $lname = "'" .$pnamearr[1] . "%'";
     }
	 $cond2 = "employee.fname " . $oper3 . " " . $fname . ' and  employee.lname ' . $oper3 . " " . $lname ;

}
else {
     $crn_match = '';
}

$date1 = $_REQUEST['sdate1'];
$date2 = $_REQUEST['sdate2'];

$cond = $cond0;

$_SESSION['cond'] = $cond;
$_SESSION['cond1'] = $cond1;
$_SESSION['cond2'] = $cond2;

?>
<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/report.js"></script>
<script language="javascript">
function openPrintWindow(){
window.open("tabchart.html", "Efficiency", +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=1000" + ",height=650");
}
</script>
<html>
<head>
<title>Operator data</title>
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
<td align="right">&nbsp;
	<a href="exit.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image16','','images/logout_mo.gif',1)"><img name="Image16" border="0" src="images/logout.gif"></a></td>
</tr>
</table>
<table width=100% border=0 cellpadding=0 cellspacing=0>
<tr><td></td></tr>
<tr>
<td>
<?php
     $newdisplay->dispLinks('');
?>
</td></tr>
<table width=100% border=0 cellpadding=0 cellspacing=0>
<tr bgcolor="DEDFDE"><td width="6"><img src="images/spacer.gif " width="6"></td>
<td bgcolor="#FFFFFF">
<table width=100% border=0 cellpadding=6 cellspacing=0>
<tr>
<td><span class="pageheading"><b>Operator Efficiency</b> (As per From and To dates in Search below)
              &nbsp&nbsp&nbsp&nbsp&nbsp&nbspSelect Operator Name in Search below</td>
<td>
<input type= "image" name="Print" src="images/bu-print.gif" value="Get"
onclick='javascript: openPrintWindow()'>
</td>
</tr>
<form name="operator_efficiency" action='operator_efficiency.php' method='post' enctype='multipart/form-data'>
<tr>
<td id="chartdata">
 <?php
       include_once 'ofc-library/open_flash_chart_object.php';
       open_flash_chart_object( 800, 350, 'https://'. $_SERVER['SERVER_NAME'] .'/wms/chart-data6.php?cond='.$cond.'&op='.$op.'&from='.$date1.'&to='.$date2, false );
 ?>
</td>
</tr>
<tr>

<tr><td width=800px>
<table width=100% border=0 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF" >
<tr>
<td bgcolor="#F5F6F5" colspan="6"><span class="heading"><b><center>Search Criteria</center></b></td>
<td bgcolor="#FFFFFF" rowspan=2 align="center"><span class="tabletext">
<input type="image" name="Submit" src="images/bu-get.gif" value="Get"
            onclick="javascript: return searchsort_fields()">

</td>
</tr>
<tr>
<td colspan=3 bgcolor="#FFFFFF"><span class="labeltext"><b>Date:  From &nbsp&nbsp</b>
        <input type="text" name="sdate1" size=10 value="<?php echo $date1_match ?>"
         onkeypress="javascript: return checkenter(event)">
        <img src="images/bu-getdateicon.gif" alt="Get Date" onclick='GetDate("sdate1")'>
         <span class="labeltext"><b>&nbsp;&nbsp;To</b>
        <input type="text" name="sdate2" size=10 value="<?php echo $date2_match ?>"
         onkeypress="javascript: return checkenter(event)">
        <img src="images/bu-getdateicon.gif" alt="Get Date" onclick='GetDate("sdate2")'>
</td>
<td bgcolor="#FFFFFF"><span class="labeltext"><b>Oper Name</b></td>
<td bgcolor="#FFFFFF">
       <select name="crn_oper" size="1" width="100">
<?php
      if ($oper3 == 'like')
      {
?>
	<option selected>like
	<option value>=
<?php
      }
      else
      {
?>
	<option selected>=
	<option value>like
<?php
      }
?>
</select> &nbsp;&nbsp;
        <input type="text" name="crn" size=10 value="<?php echo $crn_match ?>"
         onkeypress="javascript: return checkenter(event)">

</td>
</tr>
</table>

</td></tr>

<td>
<div style="overflow: scroll; width: 800px; height: 330px;" id="reportdata">
<table width=100% align=left border=1 rules=all cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
<tr bgcolor="#DDDEDD">
<td colspan=6 ><span class="heading"><center><b>Operator Efficiency Status Table - From:<?php
if($date1_match != '' && $date1_match != '0000-00-00')
               {
                 $datearr = split('-', $date1_match);
                 $d=$datearr[2];
                 $m=$datearr[1];
                 $y=$datearr[0];
                 $x=mktime(0,0,0,$m,$d,$y);
                 $from_date=date("M j, Y",$x);
               }
               else
               {
                 $from_date = '';
               }
 echo $from_date; ?> To:<?php
if($date2_match != '' && $date2_match != '0000-00-00')
               {
                 $datearr = split('-', $date2_match);
                 $d=$datearr[2];
                 $m=$datearr[1];
                 $y=$datearr[0];
                 $x=mktime(0,0,0,$m,$d,$y);
                 $to_date=date("M j, Y",$x);
               }
               else
               {
                 $to_date = '';
               }
  echo $to_date ; ?></b></center></td>
</tr>

 <?php
      $result = $newreport->getops($cond2);
 ?>

<tr bgcolor="#FFFFFF">
<td width=8% rowspan=4><span class="labeltext"><p align="center">Operator</p></font></td>
</tr>
<tr bgcolor="#FFFFFF">
<td width=10% colspan=3><span class="labeltext"><p align="center">Eff</td>
<td colspan=6><span class="labeltext"><p align="center">Mins</td>
</tr>
<tr bgcolor="#FFFFFF">
<td rowspan=2><span class="labeltext"><p align="center">ST Eff</td>
<td rowspan=2><span class="labeltext"><p align="center">RT Eff</td>
<td colspan=2><span class="labeltext"><p align="center">Lost</td>
<td colspan=2><span class="labeltext"><p align="center">Gained</td>
<td rowspan=2><span class="labeltext"><p align="center">Rej<br>Time</td>
</tr>
<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="center">ST</td>
<td><span class="labeltext"><p align="center">RT(Incl Rej Time)</td>
<td><span class="labeltext"><p align="center">ST</td>
<td><span class="labeltext"><p align="center">RT(Incl Rej Time)</td>
</tr>

<?php
      $k = 0;
      while($myrow=mysql_fetch_row($result))
      {
           $op = $myrow[0].' '.$myrow[1];
           //echo $op;
?>

<tr bgcolor="#FFFFFF">
 <td width=8%><span class="tabletext">
       <a href='operator_efficiency_rows.php?operator=<?php echo "$myrow[0] $myrow[1]"; ?>'><?php echo "$myrow[0] $myrow[1]"; ?></a></td>

<?php
       $eff_runtime=0;
       $eff_settime=0;
       $runtimediff=0;
       $settimediff=0;
       $rejtime=0;
       $actual_time4set_eff=0;
       $ideal_time4set_eff=0;
       $actual_time4run_eff=0;
       $ideal_time4run_eff=0;
       
       $rec_arr = array();
       $crn_arr = array();
       $result_rev=$newreport->getrev_crn($op,$cond);
      if(mysql_num_rows($result_rev) != 0)
      {
       while($myrow_crn_rev=mysql_fetch_row($result_rev))
       {
           $rec_arr[]=$myrow_crn_rev[4];
           $crn_arr[]=$myrow_crn_rev[0];
       }
       
       $setting_arr = array();
      $result4settime = $newreport->getsettime4eff($op,$cond,$rec_arr);
        while($myrow4seteff=mysql_fetch_row($result4settime))
        {
         $setting_arr[$op] = $myrow4seteff[0].'|'.$myrow4seteff[1];
        }
         $settimearr = split('\|',$setting_arr[$op]);
         $ideal_settime = $settimearr[0];
         $actual_settime = $settimearr[1];
      // print_r ($setting_arr);
$result4eff = $newreport->geteffdetails($op,$cond,$rec_arr);
         while($myrow4eff=mysql_fetch_row($result4eff))
         {
          $actual_runtime += $myrow4eff[5];
          $ideal_runtime += $myrow4eff[6];
         }
         //echo 'actualruntime='.$actual_runtime;
$result4stg = $newreport->getstagenum($op,$cond);
       while($myrow4stg=mysql_fetch_row($result4stg))
       {
          $crn = $myrow4stg[1];
          $stagenum = $myrow4stg[2];
          $qty_rej = $myrow4stg[3];
          $result4rejtime = $newreport->getmaster_rejtime($crn,$stagenum,$qty_rej,$rec_arr);
          $myrow4rejtime=mysql_fetch_row($result4rejtime);
          $rejtime +=  $myrow4rejtime[2];
       }
         //echo 'idealruntime='.$ideal_runtime;
        // echo 'actualruntime='.$actual_runtime;
         //echo 'Rejection Time='. $rejtime;
         $actual_runtime = $actual_runtime +  $rejtime;
         //echo 'runtime='.$actual_runtime;
         $eff_settime =  $actual_settime != 0 ? (($ideal_settime/$actual_settime)*100) : 0;
         $eff_runtime =  $actual_runtime != 0 ? (($ideal_runtime/$actual_runtime)*100) : 0;
         $settimediff = ($ideal_settime-$actual_settime);
         $runtimediff = ($ideal_runtime-$actual_runtime);

?>
<td width=10%><span class="tabletext"><p align="center">

<?php
        printf("%.2f",$eff_settime);
        echo ' %';
?>

</td>
<td width=10%><span class="tabletext"><p align="center">

<?php
        printf("%.2f",$eff_runtime);
        echo ' %';
?>
</td>


<?php
        if ($settimediff==0)
             $settimediff='';
        if ($runtimediff==0)
            $runtimediff='';
        if ($settimediff >=0 && $runtimediff >=0)
        {
?>
           <td><span class="tabletext"><p align="center"></td>
           <td><span class="tabletext"><p align="center"></td>
           <td><span class="tabletext"><p align="center"><?php echo $settimediff;?></td>
           <td><span class="tabletext"><p align="center"><?php echo $runtimediff;?></td>

<?php
         }
         elseif ($settimediff <0 && $runtimediff >=0)
         {
?>

           <td><span class="tabletext"><p align="center"><?php
           printf("%.2f",$settimediff);
           echo 'm';?></td>
           <td><span class="tabletext"><p align="center"></td>
           <td><span class="tabletext"><p align="center"></td>
           <td><span class="tabletext"><p align="center"><?php
           printf("%.2f",$runtimediff);
           echo 'm';?></td>

<?php
          }

          if($settimediff >=0 && $runtimediff <0)
          {
?>
            <td><span class="tabletext"><p align="center"></td>
            <td><span class="tabletext"><p align="center"><?php
            printf("%.2f",$runtimediff);
            echo 'm';?></td>                     </td>
            <td><span class="tabletext"><p align="center"><?php
            printf("%.2f",$settimediff);
            echo 'm';?></td>                     </td>
            <td><span class="tabletext"><p align="center"></td>
<?php
          }
          if( $settimediff <0 && $runtimediff <0)
          {
?>
            <td><span class="tabletext"><p align="center"><?php
            printf("%.2f",$settimediff);
            echo 'm';?></td>
            <td><span class="tabletext"><p align="center"><?php
            printf("%.2f",$runtimediff);
            echo 'm';?></td>
            <td><span class="tabletext"><p align="center"></td>
            <td><span class="tabletext"><p align="center"></td>
<?php
          }
          if( $settimediff=='' && $runtimediff=='')
          {
?>
            <td><span class="tabletext"><p align="center"> </td>
            <td><span class="tabletext"><p align="center">  </td>
            <td><span class="tabletext"><p align="center"> </td>
            <td><span class="tabletext"><p align="center"> </td>

<?php
          }
          if($rejtime != 0) {
            echo '<td><span class="tabletext"><p align="center">'.$rejtime.''.m.'</td>';
        }
        else {
        echo '<td><span class="tabletext"><p align="center"></td>';
        }

          unset($eff_runtime);
          unset($eff_settime);
          unset($runtimediff);
          unset($settimediff);
          unset($actual_runtime);
          unset($ideal_runtime);
          unset($rejtime);
          unset($crn);
          unset($stagenum);
          unset($qty_rej);
         //print_r ($setting_arr);
         
        }
      }
?>
</table>
</td>
</tr>
</table>
<table border=1 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3>
        <tr bgcolor="#FFFFFF">
            <td colspan=4><span class="labeltext">F8401-S</td>
            <td colspan=2><span class="labeltext">Rev No:0 &nbsp Rev Date:8-1-2009</td>
            <td colspan=2><span class="labeltext">&nbsp;</td>
        </tr>

</table>
</div>
</td>
<td width="6"><img src="images/spacer.gif " width="6"></td>
</tr>
<tr bgcolor="DEDFDE">
<td width="6"><img src="images/box-left-bottom.gif"></td>
<td><img src="images/spacer.gif " height="6"></td>
<td width="6"><img src="images/box-right-bottom.gif"></td>
</tr>
</table>
</FORM>
</table>
</body>
</html>
