<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = June 19, 2008                =
// Filename: crn_status.php                    =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 WMS                          =
// Displays WO Status report                   =
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
$rowsPerPage = 10000;

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
$oper1='like';
$oper2='like';
$oper3='like';
$oper4='like';
//echo $cond;
// First include the class definition

include('classes/reportClass.php');
include('classes/displayClass.php');
$newreport = new report;
$newdisplay = new display;


$cond0 = "op.mc_name like '%'";

 //echo $_REQUEST['mc_name']."----";
if ( isset ( $_REQUEST['mc_name'] ) )
{
     $mcname_match = $_REQUEST['mc_name'];

     if ($mcname_match == 'All') {
     //echo "HERE---111--";
         $final_mcname = "like '%" . "'";
     }
     else {
     //echo "HERE---222--";
         $final_mcname = "='" . $_REQUEST['mc_name'] . "'";
     }

     $cond0 = "op.mc_name ". $final_mcname;

}
else {
     $mcname_match = '';
}
$cond=$cond0;
?>

<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/report.js"></script>
<html>
<head>
<title>GRN Stock Report</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">

<?php
include('header.html');

?>
<form action='wip_timeReport.php' method='post' enctype='multipart/form-data'>
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
   <tr><td><span class="heading"><b>GRN Stock Report</b></td>
<tr><td>
<table width=100% border=0 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF" >
<tr>
<td bgcolor="#F5F6F5" colspan="5"><span class="heading"><b><center>Search Criteria</center></b></td>
<td bgcolor="#FFFFFF" rowspan=2 colspan=2 align="center"><span class="tabletext">
<input type="image" name="Submit" src="images/bu-get.gif" value="Get"
            onclick="javascript: return searchsort_stockgrn()">

<input type="hidden" name="company_oper">
<input type="hidden" name="wonum_oper">
</td>
</tr>
<tr>
<!--<td colspan=3 bgcolor="#FFFFFF"><span class="labeltext"><b>Recd Date:  From &nbsp&nbsp</b>
        <input type="text" name="sdate1" id="sdate1" size=10 value="<?php //echo $fromdate1 ?>"
         onkeypress="javascript: return checkenter(event)">
        <img src="images/bu-getdateicon.gif" alt="Get Date" onclick='GetDate("sdate1")'>
         <span class="labeltext"><b>&nbsp;&nbsp;To</b>
        <input type="text" name="sdate2" id="sdate2" size=10 value="<?php //echo $todate1 ?>"
         onkeypress="javascript: return checkenter(event)">
        <img src="images/bu-getdateicon.gif" alt="Get Date" onclick='GetDate("sdate2")'>
</td> -->
<td bgcolor="#FFFFFF"><span class="labeltext"><p align="left">M/C Name</p></font></td>
            <td bgcolor="#FFFFFF"><span class="tabletext"><select name="mc_name" id="mc_name" size="1" width="100">
             <option value="All">ALL
             <option value="BMV 60-1">BMV 60-1
             <option value="BMV 60-2">BMV 60-2
             <option value="BMV 45-1">BMV 45-1
             <option value="BMV 45-2">BMV 45-2
             <option value="BMV 50">BMV 50
             <option value="VMC 70L">VMC 70L
             <option value="DMG 360L">DMG 360L
             <option value="HMC 440">HMC 440
             <option value="DX 200-1">DX 200-1
             <option value="DX 200-2">DX 200-2
             <option value="DX 200-3">DX 200-3
             <option value="HAAS">HAAS
             <option value="MakinoF3">MakinoF3
             <option value="MakinoF5">MakinoF5
             <option value="HAASVF2SS">HAASVF2SS
             <option value='VR11'>VR11
	         <option value='ST20'>ST20
             <option value='HAASVF2SS-2'>HAASVF2SS-2
             <option value='MakinoF5-2'> MakinoF5-2
             <option value='MakinoF5-3'>MakinoF5-3
             <option value='MakinoF5-4'>MakinoF5-4
             <option value='EMAG-1'>EMAG-1
             <option value='A51nx-1'>A51nx-1
              <option value='QT100S-1'>QT100S-1
			 <option value='QT100S-2'>QT100S-2
             </select>
             </td>
</tr>

</table>

</td></tr>
    </tr>
   </table>
<tr>
<td bgcolor="#FFFFFF" align='right'><span class="pageheading"><b>
<a href="wip_timeReportexp.php?machine=<?php echo $mcname_match ?>">Export</a>
</td>
</tr>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
        <tr>
            <td width="5%" bgcolor="#EEEFEE" align="center"><span class="heading"><b>PRN </b></td>
            <td width="5%" bgcolor="#EEEFEE" align="center"><span class="heading"><b>QTY</b></td>
            <td width="5%" bgcolor="#EEEFEE" align="center"><span class="heading"><b>WONUM</b></td>
            <td width="15%" bgcolor="#EEEFEE" align="center"><span class="heading"><b>Machine Name </b></td>
            <td width="5%" bgcolor="#EEEFEE" align="center"><span class="heading"><b>Estimated Time</b></td>
            <td width="5%" bgcolor="#EEEFEE" align="center"><span class="heading"><b>Actual Time</b></td>
            <td width="5%" bgcolor="#EEEFEE" align="center"><span class="heading"><b>Hours Balance</b></td>
        </tr>

<?php

        $result = $newreport->getwipdets($cond);
        while ($myrow = mysql_fetch_row($result))
        {      //$esti_time=($myrow[5]+$myrow[6]);
               //$act_time=($myrow[3]+$myrow[4]);
               $hour_balance=number_format(($myrow[4]- $myrow[3]),2,'.','');
               if($hour_balance<0)
               {
                 $color='#FF0000';
               }else
               {
                 $color='#FFFFFF';
               }
              printf('<tr><td bgcolor="#FFFFFF" ><span class="tabletext">%s</td>
                    <td bgcolor="#FFFFFF" align="center"><span class="tabletext">%d</td>
                    <td bgcolor="#FFFFFF" align="center"><span class="tabletext">%s</td>
                    <td bgcolor="#FFFFFF" align="center"><span class="tabletext">%s</td>
                    <td bgcolor="#FFFFFF" align="center"><span class="tabletext">%.2f</td>
                    <td bgcolor="#FFFFFF" align="center"><span class="tabletext">%.2f</td>',

                      $myrow[0],
                      $myrow[2],
                      $myrow[1],
                      $myrow[5],
                      $myrow[4],
                      $myrow[3]
		              );
		              echo"<td bgcolor=$color align=\"center\"><span class=\"tabletext\">$hour_balance</td>";

          }
?>
</td></tr>
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


<table border = 0 cellpadding=0 cellspacing=0 width=100% >
<tr>
	<td align=left>
  <?php
//  Added on Dec 6,04 for paging

/*$numrows = $newreport->getgrndets4reportcount($cond,$offset,$rowsPerPage);
//$numrows = 3000;
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
    $prev = " <a href=\"wiptimereport.php?page=$page&totpages=$totpages&scomp=$company_match&swonum=$wonum_match&grn=$grn_match&crn=$crn_match&sdate1=$date1_match&sdate2=$date2_match&flag=1&tcr=$total_cost_rupee&tcd=$total_cost_dollar&tcn=$total_cost_null\">[Prev]</a> ";

    $first = " <a href=\"wiptimereport.php?page=1&totpages=$totpages&scomp=$company_match&swonum=$wonum_match&grn=$grn_match&crn=$crn_match&sdate1=$date1_match&sdate2=$date2_match&flag=1&tcr=$total_cost_rupee&tcd=$total_cost_dollar&tcn=$total_cost_null\">[First Page]</a> ";
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
  $next = " <a href=\"wiptimereport.php?page=$page&totpages=$totpages&scomp=$company_match&swonum=$wonum_match&grn=$grn_match&crn=$crn_match&sdate1=$date1_match&sdate2=$date2_match&flag=1&tcr=$total_cost_rupee&tcd=$total_cost_dollar&tcn=$total_cost_null\">[Next]</a> ";

  $last = " <a href=\"wiptimereport.php?page=$totpages&totpages=$totpages&scomp=$company_match&swonum=$wonum_match&grn=$grn_match&crn=$crn_match&sdate1=$date1_match&sdate2=$date2_match&flag=1&tcr=$total_cost_rupee&tcd=$total_cost_dollar&tcn=$total_cost_null\">[Last Page]</a> ";
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
echo "<span class=\"labeltext\"><align=\"center\">";     */
// End additions on Dec 6,04

?>
</td>
</tr></table>
</form>
</body>
</html>
