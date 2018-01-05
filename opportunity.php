<?php
//==============================================
// Author: FSI                                 =
// Date-written = July 10, 2006                =
// Filename: opportunity.php                   =
// Copyright of Badari Mandyam, FluentSoft     =
// Revision: v1.0 OWT                          =
// Displays list of opportunity.               =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
header ( "Location: login.php" );

}
$userid = $_SESSION['user'];
$dept = $_SESSION['department'];
$_SESSION['pagename'] = 'opportunity';

$page = "CRM: Opportunity";
//session_register('pagename');
//Following code added to implement search,sort  and Pagination on Dec 29-04 by Jerry George

$cond = "opp_name like '%'";
$sort1='name';
$select='name';
$worec='';
$where1='';
$oper='like';
if ( isset ( $_REQUEST['opportunity'] ))
{
$opportunity_match = $_REQUEST['opportunity'];
if ($opportunity_match!='')
{

if ( isset ( $_REQUEST['opportunity_oper'] ) )
{
$oper = $_REQUEST['opportunity_oper'];
}
else
{
$oper = 'like';
}
if ($oper == 'like')
{
$opportunity = "'" . $_REQUEST['opportunity'] . "%" . "'";
}
else
{
$opportunity = "'" . $_REQUEST['opportunity'] . "'";
}
$where1 =$_REQUEST['opportunityfl'];
$select=$_REQUEST['opportunityfl'];
$cond = $where1 . " " . $oper . " " . $opportunity;
}
else
$cond="opp_name like '%'";
}
else
{
$opportunity_match = '';
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
	
// First include the class definition
include_once('classes/userClass.php');
include_once('classes/opportunityClass.php');
include_once('classes/displayClass.php');
$newopportunity = new opportunity;
$newdisplay = new display;
?>
<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/opportunity.js"></script>

<html>
<head>
<title>Opportunity</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">
<form action='opportunity.php?opportunity=$opportunity_match&opportunity_oper=$oper&sortfld1=$sort1&opportunityfl=$where1' method='post' enctype='multipart/form-data'>
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
<table width=100% border=0 cellpadding=0 cellspacing=0  >
<tr><td></td></tr>
<tr>
<td>
<?php $newdisplay->dispLinks(''); ?>
</td></tr>
<table width=100% border=0 cellpadding=0 cellspacing=0  >
<tr bgcolor="DEDFDE"><td width="6"><img src="images/spacer.gif " width="6"></td> -->
<td bgcolor="#FFFFFF">
<table width=100% border=0 cellpadding=6 cellspacing=5>
<tr><td><span class="heading"><i>Please click on Opportunity to Edit/Delete</i></td></tr>
<tr>
<td>
<table width=100% styleborder=0 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1" >
<tr>
<td bgcolor="#F5F6F5" colspan="3"><span class="heading"><b><center>Search Criteria</center></b></td>
<td bgcolor="#F5F6F5"  colspan="4"><span class="heading"><b><center>Sort Criteria</center></b></td>
<td bgcolor="#FFFFFF" rowspan=2 align="center">
<button class="stdbtn btn_blue" style="background-color:#2d3e50" onClick="javascript: return searchsort_fields()" >Get</button>
</td>
</tr>
<tr>
<td bgcolor="#FFFFFF"><span class="tabletext"><select name="opportunity1" size="1" width="50">
<?php if($select=='id'){?>
<option selected>id
<option value>name<?php }else {?>
<option selected>name
<option value>id<?php }?>
</select>
</td>
<td bgcolor="#FFFFFF"><span class="tabletext"><select name="opportunity_oper" size="1" width="50">
<?php if($oper=='like'){?>
<option selected>like
<option value>=<?php }else {?>
<option selected>=
<option value>like<?php }?>
</td>
<td bgcolor="#FFFFFF"><input type="text" name="opportunity" size=20 value="<?php echo $opportunity_match ?>" onkeypress="javascript: return checkenter(event)"></td>
<td bgcolor="#FFFFFF"><span class="labeltext"><b>Sort by</b></td>
<td bgcolor="#FFFFFF" colspan=3><span class="tabletext"><select name="sort1" size="1" width="100">
<option selected>name
</select>
<input type="hidden" name="sortfld1">
<input type="hidden" name="opportunityfl">
<input type="hidden" name="opportunity_oper">
</td>
</tr>
</table>
</td></tr>
<tr><td>
<table width=100% border=0>
<div class="contenttitle radiusbottom0">
<h2><span>Opportunity
	<input type="button" class="stdbtn btn_blue" style="float:right;padding:2px;margin-right:5px;" onClick="location.href='new_opportunity.php'" value="New Opportunity" >
</h2>
</span>
</td>
</tr>
</table>

<table width=100% border=0 cellpadding=3 cellspacing=1 class="stdtable" >
	<thead>
<tr>
<th class="head0"><span class="tabletext"><b>Opportunity Name</b></th>
<th class="head1"th class="head0"><span class="tabletext"><b>Account Name</bth></th>
<th class="head0"><span class="tabletext"><b>Expected Close Date</b></th>
<th class="head1"><span class="tabletext"><b>Sales Stage</b></th>
<th class="head0"><span class="tabletext"><b>Type</b></th>
<th class="head1"><span class="tabletext"><b>Lead Link</b></th>
</thead>
<?php
$result = $newopportunity->getOpportunity();
while ($row = mysql_fetch_assoc($result)) {
$d=substr($row["expected_close_date"],8,2);
$m=substr($row["expected_close_date"],5,2);
$y=substr($row["expected_close_date"],0,4);
$x=mktime(0,0,0,$m,$d,$y);
$date=date("M j, Y",$x);

printf('<tr bgcolor="#FFFFFF"><td align="center"><span class="tabletext">
<a href="opportunityDetails.php?opportunityrecnum=%s">%s</td>
<td align="center"><span class="tabletext">%s</td>
<td align="center"><span class="tabletext">%s</td>
<td align="center"><span class="tabletext">%s</a></td>
<td align="center"><span class="tabletext">%s</td>
<td align="center"><span class="tabletext"><a href="opportunity2leads.php?opportunityrecnum=%s&leadrecnum=%s&oppname=%s">View Leads',
$row["recnum"],$row["opp_name"],
$row["acc_name"],
$date,
$row["sales_stage"],
$row["type"],
$row["recnum"],$row["link2lead"],$row['opp_name']);
printf('</td></tr>');

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

//Additions on Dec 29 04 by Jerry George to implement pagination
//$numrows=mysql_num_rows($result);
//echo   $numrows;
$numrows = $newopportunity->getoppCount($cond,$offset, $rowsPerPage);
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
$prev = " <a href=\"opportunity.php?page=$page&totpages=$totpages&opportunity=$opportunity_match&opportunityfl=$where1&opportunity_oper=$oper\">[Prev]</a> ";

$first = " <a href=\"opportunity.php?page=1&totpages=$totpages&opportunity=$opportunity_match&opportunityfl=$where1&opportunity_oper=$oper\">[First Page]</a> ";
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
$next = " <a href=\"opportunity.php?page=$page&totpages=$totpages&opportunity=$opportunity_match&opportunityfl=$where1&opportunity_oper=$oper\">[Next]</a> ";
$last = " <a href=\"opportunity.php?page=$totpages&totpages=$totpages&opportunity=$opportunity_match&opportunityfl=$where1&opportunity_oper=$oper\">[Last Page]</a> ";
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
</html >