<?php
//==============================================
// Author: FSI                                 =
// Date-written =  Mar 20, 2007                =
// Filename: qualityplanSummary.php            =
// Copyright of Badari Mandyam, FluentSoft     =
// Revision: v1.0 OWT                          =
// Displays list of Quality Plan.              =
//==============================================

session_start();
header("Cache-control: private");
if ( !isset ( $_SESSION['user'] ) )
{
header ( "Location: login.php" );

}
$userid = $_SESSION['user'];
$dept = $_SESSION['department'];

$_SESSION['pagename'] = 'enquirysummary';
$page = "CRM: Enquiry";
//session_register('pagename');

//Following code added to implement search,sort  and Pagination on Dec 29-04 by Jerry George

$cond = "name like '%'";
$sort1='name';
$select='name';
$worec='';
$where1='';
$oper = 'like';
if ( isset ( $_REQUEST['competitor'] ))
{
$company_match = $_REQUEST['competitor'];
if ($company_match!='')
{

if ($oper == 'like')
{

$competitor = "'" . $_REQUEST['competitor'] . "%" . "'";
}
else
{
$competitor = "'" . $_REQUEST['competitor'] . "'";
}

$cond =  "name " . $oper . " " . $competitor;
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

//echo $cond;
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
include('classes/enquiryClass.php');
include_once('classes/displayClass.php');
$newdisplay = new display;
$newenquiry = new enquiry;
?>
<link rel="stylesheet" href="style.css">
<script language="javascript" src="../scripts/mouseover.js"></script>
<script language="javascript" src="scripts/enquiry.js"></script>

<html>
<head>
<title>Enquiry Summary</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">
<form action='enquirySummary.php' method='post' enctype='multipart/form-data'>
<?php
include('header.html');
?>
<td bgcolor="#FFFFFF">
<table width=100% border=0 cellpadding=6 cellspacing=5>
<tr><td><span class="heading"><i>Please click on the Ref Num link to Edit or Delete</i></td></tr>
<tr><td>
<table width=100% border=0 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1" >
<tr>
<td bgcolor="#F5F6F5" colspan="3"><span class="heading"><b><center>Search Criteria</center></b></td>
<td bgcolor="#F5F6F5"  colspan="4"><span class="heading"><b><center>Sort Criteria</center></b></td>
<td bgcolor="#FFFFFF" rowspan=2 align="center">
<button class="stdbtn btn_blue" style="background-color:#2d3e50" onclick="javascript: return searchsort_fields()">Get</button>
</but>
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
<h2><span>Enquiry Summary
<input type="button" class="stdbtn btn_blue" style="float:right;padding:2px;margin-right:5px" onclick="location.href='new_enquiry.php'" value="New Enquiry">
</h2>
</span>
</td>
</tr>
</table>

<table width=100% border=0 cellpadding=3 cellspacing=1 class="stdtable">
	<thead>
<tr>
<th class="head0"><span class="tabletext"><b>SL NO.</b></th>
<th class="head1"><span class="tabletext"><b>Enq Date</b></th>
<th class="head0"><span class="tabletext"><b>Customer</b></th>
<th class="head1"><span class="tabletext"><b>Part Description</b></th>
<th class="head0"><span class="tabletext"><b>Prt Number</b></th>
<th class="head1"><span class="tabletext"><b>Qty</b></th>
<th class="head0"><span class="tabletext"><b>RT Quatation Date</b></th>
<th class="head1"><span class="tabletext"><b>RT Quatation No</b></th>
<th class="head0"><span class="tabletext"><b>Risk Involved</b></th>
<th class="head1"><span class="tabletext"><b>Risk Details</b></th>
<th class="head0"><span class="tabletext"><b>Status</b></th>
</tr>
</thead>
<?php
$newlogin = new userlogin;
$newlogin->dbconnect();
$result = $newenquiry->getenquirys($cond);
while ($myrow = mysql_fetch_assoc($result)) 
{


		   if($myrow['enq_date'] != '0000-00-00' && $myrow['enq_date'] != '' && $myrow['enq_date'] != 'NULL')
		      {
		      $datearr = split('-', $myrow['enq_date']);
		      $d=$datearr[2];
		      $m=$datearr[1];
		      $y=$datearr[0];
		      $x=mktime(0,0,0,$m,$d,$y);
		      $enq_date=date("M j, Y",$x);
		     }
		     else
		     {
		        $enq_date = '';
		     }


	         if($myrow['rtquot_date'] != '0000-00-00' && $myrow['rtquot_date'] != '' && $myrow['rtquot_date'] != 'NULL')
	          {
	          $datearr = split('-', $myrow['rtquot_date']);
	          $d=$datearr[2];
	          $m=$datearr[1];
	          $y=$datearr[0];
	          $x=mktime(0,0,0,$m,$d,$y);
	          $rtquot_date=date("M j, Y",$x);
	         }
	         else
	         {
	            $rtquot_date = '';
	         }

printf('<tr><td bgcolor="#FFFFFF"><span class="tabletext"><a href="enquiryDetails.php?enquiryrecnum=%s"><b>%s</b></td>
<td bgcolor="#FFFFFF"><span class="tabletext">%s</td>
<td bgcolor="#FFFFFF"><span class="tabletext">%s</td>
<td bgcolor="#FFFFFF"><span class="tabletext">%s</td>
<td bgcolor="#FFFFFF"><span class="tabletext">%s</td>
<td bgcolor="#FFFFFF"><span class="tabletext">%s</td>
<td bgcolor="#FFFFFF"><span class="tabletext">%s</td>
<td bgcolor="#FFFFFF"><span class="tabletext">%s</td>
<td bgcolor="#FFFFFF"><span class="tabletext">%s</td>
<td bgcolor="#FFFFFF"><span class="tabletext">%s</td>
<td bgcolor="#FFFFFF"><span class="tabletext">%s</td>

</tr>  ',
$myrow["recnum"],$myrow["recnum"],
$enq_date,
$myrow["name"],
$myrow["partdesc"],
$myrow["partnum"],
$myrow["qty"] ,
$rtquot_date ,
$myrow["rtquot_no"] ,
$myrow["risk_involv"] ,
$myrow["risk_details"] ,
$myrow["status"]
);
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
$prev = " <a href=\"qualityplanSummary.php?page=$page&totpages=$totpages&qualityplanSummary=$company_match&scompanyfl=$where1&competitor_oper=$oper\">[Prev]</a> ";

$first = " <a href=\"qualityplanSummary.php?page=1&totpages=$totpages&qualityplanSummary=$company_match&competitorfl=$where1&competitor_oper=$oper\">[First Page]</a> ";
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
$next = " <a href=\"qualityplanSummary.php?page=$page&totpages=$totpages&competitor=$company_match&competitorfl=$where1&competitor_oper=$oper\">[Next]</a> ";

$last = " <a href=\"qualityplanSummary.php?page=$totpages&totpages=$totpages&competitor=$company_match&competitorfl=$where1&competitor_oper=$oper\">[Last Page]</a> ";
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
</body>
</html>
