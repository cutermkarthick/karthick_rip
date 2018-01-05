<?
//==============================================
// Author: Fluent Technologies                                 
// Date-written = July 12,2013             
// Filename: wo_chart.php               
// Copyright of Badari Mandyam, FluentSoft     
// Revision: v1.0             
//=============================================
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
include('classes/reportClass.php');
$newreport = new report;

$start_date_wo=$_REQUEST['start_date_wo'];
$end_date_wo=$_REQUEST['end_date_wo'];
?>
<link rel="stylesheet" href="style.css">
<table  width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
<tr>
<td colspan=7 align="center" bgcolor="#00DDFF"><span class="heading"><b>WO PERFORMANCE</b></td>
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
 open_flash_chart_object(550, 230, 'http://'. $_SERVER['SERVER_NAME'].'/fluenterp/chart-data.php?start_date_wo='.$start_date_wo.'&end_date_wo='.$end_date_wo, false);
	  ?>
</td></tr>
</table>