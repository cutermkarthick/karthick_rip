<?php
//
//===================================================
// Author: FSI
// Date-written = June 19, 2008
// Filename: prodshift_record.php
// Copyright (C) FluentSoft Inc.
// Contact bmandyam@fluentsoft.com
// Revision: v1.0 WMS
// Displays Production Shiftwise record m/c wise
//===================================================

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
$result_p = $newreport->getEmp4Prodnrec();
?>

<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/report.js"></script>
<html>
<head>
<title>Production Report</title>
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
   <tr><td align="center"><span class="heading"><b>Production Record</b></td>

<tr><td>

</td></tr>
    </tr>
   </table>
 <table width=1200px border=0 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF" >
     <tr>
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
             <option value='QT100s-1'>QT100s-1
             <option value='QT100s-2'>QT100s-2
			  <option value='QT100S-3'>QT100S-3
			 <option value='QT100S-4'>QT100S-4
			 <option value='QT100S-5'>QT100S-5
             </select>
             </td>

        <td colspan=3 bgcolor="#FFFFFF"><span class="labeltext"><b>From &nbsp&nbsp</b>
        <input type="text" name="fromdate" id="fromdate" size=10 value="<?php echo $fromdate1; $d1=$fromdate1; $d2=$todate1;?>"
         onkeypress="javascript: return checkenter(event)">
        <img src="images/bu-getdateicon.gif" alt="Get Date" onclick='GetDate("fromdate")'>
         <span class="labeltext"><b>&nbsp;&nbsp;To</b>
        <input type="text" name="todate" id="todate"size=10 value="<?php echo $todate1 ?>"
         onkeypress="javascript: return checkenter(event)">
        <img src="images/bu-getdateicon.gif" alt="Get Date" onclick='GetDate("todate")'></td>
        <td bgcolor="#FFFFFF"><span class="labeltext"><b>PRN </b>
        <input type="text" id="crn" name="crn" size=10 value="">
        <td bgcolor="#FFFFFF"><span class="labeltext">WO
         <input type="text" id="WO" name="WO" size=10 value=""></td>
         <td bgcolor="#FFFFFF"><span class="labeltext">Operator</b>
         <select id="operno"name=operno>
                               <option selected><?php echo $opername ?>
                                <?php
                                   echo "<option value='All'>All";
                                   while($row = mysql_fetch_row($result_p))
                                   {
                                     echo "<option value='$row[0] $row[1]'>$row[0] $row[1]";
                                   }

                                ?>
                                   </select>
        </td>

            <td bgcolor="#FFFFFF" rowspan=3 colspan=4 align="center"><span class="tabletext">
<input type="image" name="Submit" src="images/bu-get.gif" value="Get"
            onclick="javascript: getmachinerec()">
</tr>

 </table>
<tr>

<td>
 <div id="mcname">
 <table id='tmcname' width=1100px border=1 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
 </table>
 </div>
 </td></tr>
 <td>
</td>
</tr>
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
