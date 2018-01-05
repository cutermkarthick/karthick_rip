<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = Mar 10, 2010                 =
// Filename: dnSummary.php                     =
// Copyright of Fluent Technologies            =
// Revision: v1.0 WMS                          =
// Displays list of Dispatchs.                 =
//==============================================
session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
header ( "Location: login.php" );

}
$userid = $_SESSION['user'];
$_SESSION['pagename'] = 'dnSummary';
$page = "Post Process: D Note";
// $_SESSION['pageval'] = "Post Process: D Note";
$dept = $_SESSION['department'];
//////session_register('pagename');

// First include the class definition
include_once('classes/userClass.php');
include_once('classes/dnClass.php');
include_once('classes/dnliClass.php');
include_once('classes/displayClass.php');

$newdn = new dn;
$newdisplay = new display;


$cond0 = " d.crn like '%'";
$cond1 =  "(to_days(d.deliver_date)-to_days('1582-01-01') > 0 ||
d.deliver_date = '0000-00-00' ||
d.deliver_date = 'NULL' ) and
(to_days(d.deliver_date)-to_days('2050-12-31') < 0 ||
d.deliver_date = '0000-00-00' ||
d.deliver_date = 'NULL')";
$cond2 = " d.dnnum like '%'";
$cond3 = "(status like '%' || status = '' || status is NULL)";

$cond = $cond0 . ' and ' . $cond1. ' and ' . $cond2. ' and ' . $cond3;

if ( isset ( $_REQUEST['final_crn'] ) )
{
$finalcrn_match = $_REQUEST['final_crn'];       
$final_crn = "'" . $_REQUEST['final_crn'] . "%" . "'";    
$cond0 = "d.crn like " . $final_crn;
}
else {
$finalcrn_match = '';
}

if ( isset ( $_REQUEST['final_dn'] ) )
{
$finaldn_match = $_REQUEST['final_dn'];       
$final_dn = "'" . "%" . $_REQUEST['final_dn'] . "%" . "'";
$cond2 = "d.dnnum like " . $final_dn;
}
else {
$finaldn_match = '';
}


if ( isset ( $_REQUEST['ddate1'] ) || isset ( $_REQUEST['ddate2'] ) )
{
$ddate1_match = $_REQUEST['ddate1'];
$ddate2_match = $_REQUEST['ddate2'];
if ( isset ( $_REQUEST['ddate1']) &&  $_REQUEST['ddate1'] != '' )
{
$date1 = $_REQUEST['ddate1'];
$cond21 = "to_days(d.deliver_date) " . ">= to_days('" . $date1 . "')";
}
else
{
$cond21 = "(to_days(d.deliver_date)-to_days('1582-01-01') > 0 || d.deliver_date = 'NULL' || d.deliver_date = '0000-00-00')";
}

if ( isset ( $_REQUEST['ddate2'] )  &&  $_REQUEST['ddate2'] != '')
{
$date2 = $_REQUEST['ddate2'];
$cond22 = "to_days(d.deliver_date) " . "<= to_days('" . $date2 . "')";
}
else
{
$cond22 = "(to_days(d.deliver_date)-to_days('2050-12-31') < 0 || d.deliver_date = 'NULL' || d.deliver_date = '0000-00-00')";
}
$cond1 = $cond21 . ' and ' . $cond22;

}
else
{
$ddate1_match = '';
$ddate2_match = '';
}

if(isset ($_REQUEST['status_val'] ) )
{
$sval = $_REQUEST['status_val'];
//echo $sval.'-----';

if ($sval== 'Open')
{
$cond3 = "(status = '" . $sval . "' || status is NULL || status = '')";
}
else if ($sval == 'Closed')
{
$cond3 = "status = '" . $sval . "'" ;
}
else if ($sval == 'All')
{
$cond3 = "(status like '%' || status is NULL)";
}   
else if ($sval == 'Cancelled')
{
$cond3 = "status = '" . $sval . "'" ;
} 
}
else
{
$sval = 'Open';
$cond3 = "(status = '" . $sval . "' || status is NULL || status = '')";
}

$cond = $cond0 . ' and ' . $cond1. ' and ' . $cond2. ' and ' . $cond3;
//echo $cond;

$userrole = $_SESSION['userrole'];

// echo $cond;
// how many rows to show per page
$rowsPerPage =20;

// by default we show first page
$pageNum = 1;

// if $_GET['page'] defined, use it as page number
if (isset($_REQUEST['page']))
{
$pageNum = $_REQUEST['page'];
}
if (isset($_REQUEST['totpages']))
{
$totpages = $_REQUEST['totpages'];
}

// counting the offset
$offset = ($pageNum - 1) * $rowsPerPage;

//echo $offset;

?>
<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/dn.js"></script>

<html>
<head>
<title>Delivery Note Summary</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">
<form action='dnSummary.php' method='post' enctype='multipart/form-data'>
<?php

include('header.html');

?>
<!-- <table width=100% cellspacing="0" cellpadding="6" border="0">
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
<?php $newdisplay->dispLinks(''); ?>
</td></tr>
<table width=100% border=0 cellpadding=0 cellspacing=0>
<tr bgcolor="DEDFDE"><td width="6"><img src="images/spacer.gif " width="6"></td>
<td bgcolor="#FFFFFF"> -->
<table width=100% border=0 cellpadding=6 cellspacing=0>
<tr><td>
<tr><td><span class="heading"><i>Please click on the link for Details and Edit</i></td></tr>
</tr>
<tr>
<td>

<table width=100% border=0 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1">
<tr>
<td bgcolor="#F5F6F5" colspan="13"><span class="heading"><b><center>Search Criteria</center></b></td>
<td bgcolor="#FFFFFF" rowspan=3 align="center">
<button class="stdbtn btn_blue" style="background-color:#2d3e50" onClick="javascript: return searchsort_fields()" >Get</button>	
<!-- <input type= "image" name="submit" src="images/bu-get.gif" value="Get" onclick="javascript: return searchsort_fields()"> -->


<input type="hidden" name="rel_oper">
<input type="hidden" name="wo_oper">
</td>
</tr>
<tr>
<td bgcolor="#FFFFFF"><span class="labeltext"><b>DN No .&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b>
<input type="text" name="final_dn" size=10 value="<?php echo $finaldn_match ?>" onkeypress="javascript: return checkenter(event)">
</td>

<td colspan=12 bgcolor="#FFFFFF"><span class="labeltext"><b>PRN No.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b>
<input type="text" name="final_crn" size=15 value="<?php echo $finalcrn_match ?>" onkeypress="javascript: return checkenter(event)">
</td>
</tr>

<tr>
<td  bgcolor="#FFFFFF"><span class="labeltext"><b>Deliver Date:  From &nbsp&nbsp</b>
<input type="text" name="ddate1" id="ddate1" size=10 value="<?php echo $ddate1_match ?>"
onkeypress="javascript: return checkenter(event)">
<img src="images/bu-getdateicon.gif" alt="Get Date" onclick='GetDate("ddate1")'>
<span class="labeltext"><b>&nbsp;&nbsp;To</b>
<input type="text" name="ddate2" id="ddate2"  size=10 value="<?php echo $ddate2_match ?>"
onkeypress="javascript: return checkenter(event)">
<img src="images/bu-getdateicon.gif" alt="Get Date" onclick='GetDate("ddate2")'>
</td>
<td colspan=12 bgcolor="#FFFFFF"><span class="labeltext"><b>Status </b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<span class="tabletext"><select name="status_val" size="1" width="50">
<?php
if ($sval == 'Open')
{
?>
<option selected='Open'>Open
<option value='Closed'>Closed
<option value='Cancelled'>Cancelled
<option value='All'>All
<?php
}
else if ($sval == 'Closed')
{
?>
<option selected='Closed'>Closed
<option value='Open'>Open
<option value='Cancelled'>Cancelled
<option value='All'>All
<?php
}
else if ($sval == 'Cancelled')
{
?>
<option selected='Cancelled'>Cancelled
<option value='Open'>Open
<option value='Closed'>Closed
<option value='All'>All
<?php
}
else if ($sval == 'All')
{
?>
<option selected='All'>All
<option value='Open'>Open
<option value='Closed'>Closed
<option value='Cancelled'>Cancelled
<?php
}
?>
</select>
</td>
</tr>

</table>
<tr><td>
<table width=100% border=0>
<div class="contenttitle radiusbottom0">
<h2 class="table"><span>List of Delivery Note
<input type="button" class="stdbtn btn_blue" style="float:right;padding:2px;margin-right:5px;" onClick="location.href='dnEntry.php'" value="New" >	
<!-- <a href ="dnEntry.php"><img name="Image8" border="0" style="float:right" src="images/new.gif"></a> -->
</span>
</h2>
</table>

<table width=100% border=0 cellpadding=3 cellspacing=1 class="stdtable">
<thead>
<tr>
<th width="4%" class="head0"><b>DN #</b></th>
<th width="4%" class="head1"><b>PRN #</b></th>
<th width="6%" class="head0"><b>Sent for treatment To</b></th>
<th width="6%" class="head1"><b>After treatment deliver To</b></th>
<th width="6%" class="head0"><b>PO No.</b></th>
<th width="5%" class="head1"><b>WO#</b></th>
<th width="5%" class="head0"><b>Delivery Date</b></th>
<th width="5%" class="head1"><b>Qty</b></th>
<th width="4%" class="head0"><b>Qty<br>Recd</b></th>
<th width="4%" class="head1"><b>DN<br>Bal</b></th>
<th width="4%" class="head0"><b>QA <br>Pending</b></th>
<th width="5%" class="head1"><b>Status</b></th>
<th width="4%" class="head0"><b>Type</b></th>
</tr>

<?php
$result = $newdn->getdeliverSummary($cond,$offset,$rowsPerPage);

while ($myrow = mysql_fetch_row($result)) {
	
 
$bgcolor = "#FFFFFF";
if ($myrow[21] > 0)
{
$qty_recd = $myrow[21];
$dnbal = $myrow[18] - $myrow[21];
}
else
{
$qty_recd = 0;
$dnbal = $myrow[18];
}
if ($myrow[21] > 0)
{
$dnqabal = $myrow[21] - ($myrow[22] + $myrow[23] + $myrow[24]);
}
else
{
$dnqabal = 'NA';
}
if ($myrow[21] > 0)
{
if ($dnbal > 0 || $dnqabal > 0)
{
$bgcolor = "#FF0000";
}
if ($dnbal == 0 && $dnqabal == 0)
{
$bgcolor = "#00FF00";
}
}
else
{
$bgcolor = "#FFFFFF";
}
if($myrow[5] != '' && $myrow[5] != '0000-00-00')
{
$datearr = split('-', $myrow[5]);
$d=$datearr[2];
$m=$datearr[1];
$y=$datearr[0];
$x=mktime(0,0,0,$m,$d,$y);
$deliver_date=date("M j, Y",$x);
}
else
{
$deliver_date = '';
}
echo "<tr bgcolor=\"$bgcolor\"><td align=\"center\"><span class=\"tabletext\">";
echo "<a href=\"dnDetails.php?recnum=$myrow[0]\">$myrow[1]</td>";
echo "<td align=\"center\"><span class=\"tabletext\">$myrow[4]</td>";
echo "<td align=\"center\"><span class=\"tabletext\">$myrow[2]</td>";
echo "<td align=\"center\"><span class=\"tabletext\">$myrow[3]</td>";
echo "<td align=\"center\"><span class=\"tabletext\">$myrow[6]</td>";
echo "<td align=\"center\"><span class=\"tabletext\">$myrow[9]</td>";
echo "<td align=\"center\"><span class=\"tabletext\">$deliver_date</td>";
echo "<td align=\"center\"><span class=\"tabletext\">$myrow[18]</td>";
echo "<td align=\"center\"><span class=\"tabletext\">$qty_recd</td>";
echo "<td align=\"center\"><span class=\"tabletext\">$dnbal</td>";
echo "<td align=\"center\"><span class=\"tabletext\">$dnqabal</td>";
echo "<td align=\"center\"><span class=\"tabletext\">$myrow[19]</td>";
echo "<td align=\"center\"><span class=\"tabletext\">$myrow[20]</td>";

echo '</td></tr>';
}

?>
</table>
</table>
<!-- <td width="6"><img src="images/spacer.gif " width="6"></td>
</tr>
<tr bgcolor="DEDFDE">
<td width="6"><img src="images/box-left-bottom.gif"></td>
<td><img src="images/spacer.gif " height="6"></td>
<td width="6"><img src="images/box-right-bottom.gif"></td>
</tr>
 -->
</table>
<table border = 0 cellpadding=0 cellspacing=0 width=100% >
<tr>
<td align=left>

<?php
$numrows = $newdn->getdeliverSummaryCount($cond,$offset,$rowsPerPage);;
// how many pages we have when using paging?
$maxPage = ceil($numrows/$rowsPerPage);
//echo "$maxPage</br>";
if (!isset($_REQUEST['page']))
{
//echo "page is set";
$totpages = $maxPage;
}

//echo "total pages :$totpages</br>";
$self = $_SERVER['PHP_SELF'];

// creating 'previous' and 'next' link
// plus 'first page' and 'last page' link

// print 'previous' link only if we're not
// on page one
if ($pageNum > 1)
{
$page = $pageNum - 1;
$prev = " <a href=\"dnSummary.php?page=$page&totpages=$totpages&final_crn=$finalcrn_match
&ddate1=$ddate1_match&ddate2=$ddate2_match&final_dn=$finaldn_match&status_val=$sval\">[Prev]</a> ";

$first = " <a href=\"dnSummary.php?page=1&totpages=$totpages&final_crn=$finalcrn_match
&ddate1=$ddate1_match&ddate2=$ddate2_match&final_dn=$finaldn_match&status_val=$sval\">[First Page]</a> ";
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
$next = " <a href=\"dnSummary.php?page=$page&totpages=$totpages&final_crn=$finalcrn_match
&ddate1=$ddate1_match&ddate2=$ddate2_match&final_dn=$finaldn_match&status_val=$sval\">[Next]</a> ";

$last = " <a href=\"dnSummary.php?page=$totpages&totpages=$totpages&final_crn=$finalcrn_match&ddate1=$ddate1_match&ddate2=$ddate2_match&final_dn=$finaldn_match&status_val=$sval\">[Last Page]</a> ";
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
else        {
echo "<span class=\"labeltext\"><align=\"center\">No matching records found";
}
// End additions on Dec 29,04

?>
</td>
</tr>
</table>
</FORM>
</body>
</html>
