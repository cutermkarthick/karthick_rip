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
$page = "CRM: Cust Feedback";
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

// First include the class definition
include('classes/custfeedbackClass.php');

$newcust = new feedback;
?>
<link rel="stylesheet" href="style.css">
<script language="javascript" src="../scripts/mouseover.js"></script>
<script language="javascript" src="scripts/enquiry.js"></script>

<html>
<head>
<title>Customer Feedback Summary</title>
</head>
<body leftmargin="0" topmargin="0" marginwidth="0">
<?php
include('header.html');
?>
<td bgcolor="#FFFFFF">
<table width=100% border=0 cellpadding=6 cellspacing=5>
<tr><td><span class="heading"><i>Please click on the Sl No link to Edit or Delete</i></td></tr>
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
<h2><span>Customer Feedback Summary
<input type="button" class="stdbtn btn_blue" style="float:right;padding:2px;margin-right:5px" onclick="location.href='feedbackEntry.php'" value="New Feedback">
</h2>
</span>
</td>
</tr>
</table>

<table width=100% border=0 cellpadding=3 cellspacing=1 class="stdtable">
<thead>
<tr>
<th class="head0" style="width:3%"><span class="tabletext"><b>From</b></th>
<th class="head0" style="width:3%"><span class="tabletext"><b>To</b></th>
<th class="head1" style="width:5%"><span class="tabletext"><b>Customer</b></th>
<th class="head1" style="width:5%"><span class="tabletext"><b>Parameters</b></th>
<th class="head0" style="width:2%"><span class="tabletext"><b>Ranking</b></th>
<th class="head1"><span class="tabletext"><b>Remarks</b></th>
</tr>
</thead>
<?php
$newlogin = new userlogin;
$newlogin->dbconnect();
$result = $newcust->getcustomer();
$prevfdate='';
while ($myrow = mysql_fetch_assoc($result)) 
{


   if($myrow['fdate'] != '0000-00-00' && $myrow['fdate'] != '' && $myrow['fdate'] != 'NULL')
      {
      $datearr = split('-', $myrow['fdate']);
      $d=$datearr[2];
      $m=$datearr[1];
      $y=$datearr[0];
      $x=mktime(0,0,0,$m,$d,$y);
      $fdate=date("M j, Y",$x);
     }
     else
     {
        $fdate = '';
     }


  if($myrow['todate'] != '0000-00-00' && $myrow['todate'] != '' && $myrow['todate'] != 'NULL')
      {
      $datearr = split('-', $myrow['todate']);
      $d=$datearr[2];
      $m=$datearr[1];
      $y=$datearr[0];
      $x=mktime(0,0,0,$m,$d,$y);
      $todate=date("M j, Y",$x);
     }
     else
     {
        $todate = '';
     }

//$remarks = wordwrap($myrow['remarks'],80,"<br>\n",true);
if($prevfdate != $myrow['fdate'])
{	
// echo " prevdate " .$prevfdate."fdate ".$myrow['fdate']."<br>";
// wordwrap($myrow['remarks'],80,"<br>\n",true)   
		printf('<tr><td bgcolor="#FFFFFF"><span class="tabletext"><b>%s</b></td>
		<td bgcolor="#FFFFFF"><span class="tabletext"><b>%s</b></td>
    <td bgcolor="#FFFFFF"><span class="tabletext">%s</td>
		<td bgcolor="#FFFFFF"><span class="tabletext">%s</td>
		<td bgcolor="#FFFFFF"><span class="tabletext">%s</td>
		<td bgcolor="#FFFFFF"><span class="tabletext">%s</td></tr>',
		$fdate,
		$todate,
    $myrow['name'],
		$myrow['parameters'],
		$myrow["ranking"],
		wordwrap($myrow['remarks'],65,"<br>\n",true)
		);
		printf('</td></tr>');
   
 $prevfdate = $myrow['fdate'];
}
else
{


	printf('<tr><td bgcolor="#FFFFFF"><span class="tabletext"><b></b></td>
		<td bgcolor="#FFFFFF"><span class="tabletext"></td><td bgcolor="#FFFFFF"><span class="tabletext"></td>',
		'',
		'',
    '');
		printf('<td bgcolor="#FFFFFF"><span class="tabletext">%s</td>
		<td bgcolor="#FFFFFF"><span class="tabletext">%s</td>
		<td bgcolor="#FFFFFF"><span class="tabletext">%s</td></tr>',
		$myrow['parameters'],
		$myrow["ranking"],
		wordwrap($myrow['remarks'],65,"<br>\n",true)
		);
		printf('</td></tr>');
  $prevfdate = $myrow['fdate'];
}

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
