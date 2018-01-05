<?php
//==============================================
// Author: FSI                                 =
// Date-written = July 20, 2006                =
// Filename: account.php                       =
// Copyright of Badari Mandyam, FluentSoft     =
// Revision: v1.0 OWT                          =
// Displays list of accounts .                 =
//==============================================

session_start();
header("Cache-control: private");
if ( !isset ( $_SESSION['user'] ) )
{
header ( "Location: login.php" );

}
$userid = $_SESSION['user'];

if (!isset($_SESSION['userrole']))
{
header ( "Location: login.php" );
}

if ($_SESSION['userrole'] == 'SU' || $_SESSION['userrole'] == 'SALES')
{
$_SESSION['pagename'] = 'competitors';
}
else
{
$_SESSION['pagename'] = 'competitors';
}
$page = "CRM: Competitor";
//session_register('pagename');

//Following code added to implement search,sort  and Pagination on Dec 29-04 by Jerry George

$cond = "name like '%'";
$sort1='name';
$select='name';
$worec='';
$where1='';
$oper='like';
if ( isset ( $_REQUEST['competitor'] ))
{
$company_match = $_REQUEST['competitor'];
if ($company_match!='')
{

if ( isset ( $_REQUEST['competitor_oper'] ) )
{
$oper = $_REQUEST['competitor_oper'];
}
else
{
$oper = 'like';
}
if ($oper == 'like')
{
$competitor = "'" . $_REQUEST['competitor'] . "%" . "'";
}
else
{
$competitor = "'" . $_REQUEST['competitor'] . "'";
}
$where1 =$_REQUEST['competitorfl'];
$select=$_REQUEST['competitorfl'];
$cond = $where1 . " " . $oper . " " . $competitor;
}
else
$cond="name like '%'";
}
else
{
$company_match = '';
}

if ( isset ( $_REQUEST['sortfld1'] ) )
{
$sort1 = $_REQUEST['sortfld1'];
}

// how many rows to show per page
$rowsPerPage = 10;

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
$dept = $_SESSION['department'];

// First include the class definition
include('classes/competitorsClass.php');
include_once('classes/displayClass.php');
$newdisplay = new display;
$newcompetitor = new competitor;
?>
<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/competitor.js"></script>

<html>
<head>
<title>Track Competitors</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">
<form action='competitors.php?competitor=$company_match&competitor_oper=$oper&sortfld1=$sort1&competitorfl=$where1' method='post' enctype='multipart/form-data'>
<?php
include('header.html');
?>
<!-- <table width=100% cellspacing="0" cellpadding="6" border="0">
<tr>
<td>
<table width=100% border=0 cellspacing="0" cellpadding="0">
<tr>
<td colspan=2><span class="welcome"><b>Welcome <?php echo $userid?></b></td>
<td align="right">&nbsp;<a href="exit.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image15','','images/logout_mo.gif',1)"><img name="Image15" border="0" src="images/logout.gif"></a></td>
</tr>
</table>
<table width=100% border=0 cellpadding=0 cellspacing=0  >
<tr><td></td></tr>
<tr>
<td>
<?php $newdisplay->dispLinks(''); ?>
<table width=100% border=0 cellpadding=0 cellspacing=0  >
<tr bgcolor="DEDFDE">
<td width="6"><img src="images/spacer.gif " width="6"></td> -->
<td bgcolor="#FFFFFF">
<table width=100% border=0 cellpadding=6 cellspacing=5>
<tr><td><span class="heading"><i>Please click on the Competitors id link to Edit or Delete</i></td></tr>
<tr><td>
<table width=100% border=0 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1" >
<tr>
<td bgcolor="#F5F6F5" colspan="3"><span class="heading"><b><center>Search Criteria</center></b></td>
<td bgcolor="#F5F6F5"  colspan="4"><span class="heading"><b><center>Sort Criteria</center></b></td>
<td bgcolor="#FFFFFF" rowspan=2 align="center">
<button class="stdbtn btn_blue" style="background-color:#2d3e50" onClick="javascript: return searchsort_fields()" >Get</button>
</td>
</tr>
<tr>
<td bgcolor="#FFFFFF"><span class="tabletext"><select name="scomp" size="1" width="50">
<?php if($select=='id'){?>
<option selected>id
<option value>name<?php }else {?>
<option selected>name
<option value>id<?php }?>
</select>
</td>
<td bgcolor="#FFFFFF"><span class="tabletext"><select name="competitor_oper" size="1" width="50">
<?php if($oper=='like'){?>
<option selected>like
<option value>=<?php }else {?>
<option selected>=
<option value>like<?php }?>
</td>
<td bgcolor="#FFFFFF"><input type="text" name="competitor" size=20 value="<?php echo $company_match ?>" onkeypress="javascript: return checkenter(event)"></td>
<td bgcolor="#FFFFFF"><span class="labeltext"><b>Sort by</b></td>
<td bgcolor="#FFFFFF" colspan=3><span class="tabletext"><select name="sort1" size="1" width="100">
<option selected>name
</select>
<input type="hidden" name="sortfld1">
<input type="hidden" name="competitorfl">
<input type="hidden" name="competitor_oper">
</td>
</tr>
</table>
</td></tr>
<tr><td>
<table width=100% border=0>
<div class="contenttitle radiusbottom0">
<h2><span>Track Competitors List
<input type="button" class="stdbtn btn_blue" style="float:right;padding:2px;margin-right:5px;" onClick="location.href='new_competitors.php'" value="New Competitors" >
</h2>
</span>
</td>
</tr>
</table>

<table width=100% border=0 cellpadding=3 cellspacing=1 class="stdtable">
<thead>	
<tr>
<th class="head0"><span class="tabletext"><b>Id</b></th>
<th class="head1"><span class="tabletext"><b>Company Name</b></th>
<th class="head0"><span class="tabletext"><b>Industry Segment</b></th>
<th class="head1"><span class="tabletext"><b>Product</b></th>
<th class="head0"><span class="tabletext"><b>Revenue</b></th>
<th class="head1"><span class="tabletext"><b>Email</b></th>
<th class="head0"><span class="tabletext"><b>Phone</b></th>
<th class="head1"><span class="tabletext"><b>Country</b></th>
</tr>
</thead>
<?php
$newlogin = new userlogin;
$newlogin->dbconnect();
$newcompetitor = new competitor;
//Function getAccounts() modified on Dec 29 to implement sort and search
$result = $newcompetitor->getcompetitors();
while ($myrow = mysql_fetch_row($result)) {
printf('<tr><td bgcolor="#FFFFFF"><span class="tabletext"><a href="competitorsDetails.php?competitorrecnum=%s"><b>%s</b></td>
<td bgcolor="#FFFFFF"><span class="tabletext">%s</td>
<td bgcolor="#FFFFFF"><span class="tabletext">%s</td>
<td bgcolor="#FFFFFF"><span class="tabletext">%s</td>
<td align="right" bgcolor="#FFFFFF"><span class="tabletext">$%.2f</td>
<td bgcolor="#FFFFFF"><span class="tabletext">%s</td>
<td bgcolor="#FFFFFF"><span class="tabletext">%s</td>
<td bgcolor="#FFFFFF"><span class="tabletext">%s</td></tr>',
$myrow[0],$myrow[0],
$myrow[1],
$myrow[3],
$myrow[4],
$myrow[2],
$myrow[6],
$myrow[5],
$myrow[14]);
printf('</td></tr>');
}
/* Free resultset */
mysql_free_result($result);
/* Closing connection */
$newlogin->dbdisconnect();
?>
</table>
</td>
</tr>
</table>
</td>
<!-- <td width="6"><img src="images/spacer.gif " width="6"></td>
</tr>
<tr bgcolor="DEDFDE">
<td width="6"><img src="images/box-left-bottom.gif"></td>
<td><img src="images/spacer.gif " height="6"></td>
<td width="6"><img src="images/box-right-bottom.gif"></td>
</tr> -->
</table>
<table border = 0 cellpadding=0 cellspacing=0 width=100% >
<tr>
<td align=left>

<?php

//Additions on Dec 29 04 by Jerry George to implement pagination
$numrows=10;
//$numrows = $newcompetitor->getcompetitorCount($cond,$offset, $rowsPerPage);
// how many pages we have when using paging?
$maxPage = ceil($numrows/$rowsPerPage);
//echo "$maxPage</br>";
if (!isset($_REQUEST['page']))
{
//   echo "page is set";
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
$prev = " <a href=\"competitor.php?page=$page&totpages=$totpages&competitor=$company_match&scompanyfl=$where1&competitor_oper=$oper\">[Prev]</a> ";

$first = " <a href=\"competitor.php?page=1&totpages=$totpages&competitor=$company_match&competitorfl=$where1&competitor_oper=$oper\">[First Page]</a> ";
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
$next = " <a href=\"competitor.php?page=$page&totpages=$totpages&competitor=$company_match&competitorfl=$where1&competitor_oper=$oper\">[Next]</a> ";

$last = " <a href=\"competitor.php?page=$totpages&totpages=$totpages&competitor=$company_match&competitorfl=$where1&competitor_oper=$oper\">[Last Page]</a> ";
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
// End additions on Dec 29,04

?>
</td>
</tr>
</table>
</FORM>
</body>
</html>