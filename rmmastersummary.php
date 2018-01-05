<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = June 18, 2008                =
// Filename: rmmastersummary.php               =
// Copyright of Badari Mandyam, FluentSoft     =
// Revision: v1.0 WMS                          =
// Displays RM Master Summary list.            =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
header ( "Location: login.php" );

}
$userid = $_SESSION['user'];
$_SESSION['pagename'] = 'rmmastersummary';
$page = "Purchasing: RM Master";
//////session_register('pagename');

// First include the class definition
include_once('classes/rmmasterClass.php');
include_once('classes/displayClass.php');

$newdisplay = new display;
$newRM = new rmmaster;
$dept=$_SESSION['department'];

$rm_try=$_REQUEST['rmspec'];
$crn_try=$_REQUEST['rmcode'];
//echo $rm_try."iuiu";
$userrole = $_SESSION['userrole'];

$cond0 = "crnnum like '%'";

$cond1 = " rm_spec like '%'";

$cond2 = "(rm_status like '".$_SESSION['status_val_rm']."%' || rm_status = '' || rm_status is NULL)";


$cond = $cond0 . ' and ' . $cond1 . ' and ' . $cond2;




$oper1='like';
$oper2='like';
$sort1='crnnum';
$sort2='rm_spec';
$sess=session_id();

if ( isset ( $_REQUEST['rmcode'] ) )
{
$rmcode_match = $_REQUEST['rmcode'];

if ( isset ( $_REQUEST['rmcode_oper'] ) ) {
$oper1 = $_REQUEST['rmcode_oper'];
}
else {
$oper1 = 'like';
}
if ($oper1 == 'like') {
$rmcode = "'" . $_REQUEST['rmcode'] . "%" . "'";
}
else {
$rmcode = "'" . $_REQUEST['rmcode'] . "'";
}

$cond0 = "crnnum " . $oper1 . " " . $rmcode;
//  echo "In first if condition".$cond0;

}
else {
$rmcode_match = '';
}

if ( isset ( $_REQUEST['rmspec'] ) )
{
$rmspec_match = $_REQUEST['rmspec'];
if ( isset ( $_REQUEST['rmspec_oper'] ) ) {
$oper2 = $_REQUEST['rmspec_oper'];
}
else {
$oper2 = 'like';
}
if ($oper2 == 'like') {
$rmspec = "'" . $_REQUEST['rmspec'] . "%" . "'";
}
else {
$rmspec = "'" . $_REQUEST['rmspec'] . "'";
}

$cond1 = "rm_spec " . $oper2 . " " . $rmspec;
//   echo "In 2nd if condition".$cond1;

}
else {
$rmspec_match = '';
}

if(isset ($_SESSION['status_val_rm'] ))
{
$sval = $_SESSION['status_val_rm'];
if ($sval== 'Active')
{
$cond2 = "(rm_status = '" . $sval . "' || rm_status is NULL || rm_status = '')";
}
else if ($sval =='Inactive')
{
$cond2 = "rm_status = '" . $sval . "'" ;
}
else if ($sval == 'All')
{
$cond2 = "(rm_status like '%' || rm_status is NULL)";
}
else if ($sval == 'Pending')
{
$cond2 = "rm_status = '" . $sval . "'" ;
}
}
if(isset ($_REQUEST['status_val_rm'] ) )
{
$sval = $_REQUEST['status_val_rm'];
$_SESSION['status_val_rm'] = $sval;

if ($sval== 'Active')
{
$cond2 = "(rm_status = '" . $sval . "' || rm_status is NULL || rm_status = '')";
}
else if ($sval =='Inactive')
{
$cond2 = "rm_status = '" . $sval . "'" ;
}
else if ($sval == 'All')
{
$cond2 = "(rm_status like '%' || rm_status is NULL)";
}
else if ($sval == 'Pending')
{
$cond2 = "rm_status = '" . $sval . "'" ;
}
}
else if(!isset ($_SESSION['status_val_rm'] ))
{
$sval = 'Active';
$cond2 = "(rm_status = '" . $sval . "' || rm_status is NULL || rm_status = '')";
}

//echo $sval."--------------------";
if ( isset ( $_REQUEST['sortfld1'] ) ) {
$sort1 = $_REQUEST['sortfld1'];
}

if ( isset ( $_REQUEST['sortfld2'] ) ) {
$sort2 = $_REQUEST['sortfld2'];
}

$cond = $cond0 . ' and ' . $cond1 . ' and ' . $cond2;


// echo $cond;
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



?>
<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/rmmaster.js"></script>
<html>
<head>
<title>RM Master Summary</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0" >




<form action='rmmastersummary.php' method='post' enctype='multipart/form-data'>
<?php

include('header.html');
?>
<!-- <table width=100% cellspacing="0" cellpadding="6" border="0">
<tr>
<td>
<table width=100% border=0 cellspacing="0" cellpadding="0">
<tr>
<td colspan=2><span class="welcome"><b>Welcome <?php echo $userid ?></b></td>
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
<table width=100% border=0 cellpadding=6 cellspacing=0  >
<tr><td>
<tr><td><span class="heading"><i>Please click on the RM to Edit</i></td></tr>
</tr>
<tr>
<td>


<table width=100% border=0 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1">
<tr>
<td bgcolor="#F5F6F5" colspan="7"><span class="heading"><b><center>Search & Sort Criteria</center></b></td>
<td bgcolor="#FFFFFF" rowspan=3 align="center"><span class="tabletext">

<button class="stdbtn btn_blue" style="background-color:#2d3e50" onClick="javascript: return searchsort_fields()" >Get</button>
	<!-- <input type= "image" name="Get" src="images/bu-get.gif" value="Get" onclick="javascript: return searchsort_fields()"> -->
</td>
</tr>
<tr>
<td bgcolor="#FFFFFF"><span class="tabletext"><b>PRN</b>

</td>
<td bgcolor="#FFFFFF"><span class="tabletext"><select name="rmcode_oper" size="1" width="50">
<?php if($oper1=='like'){?>
<option selected>like
<option value>=<?php }else {?>
<option selected>=
<option value>like<?php }?>
</select>
<input type="hidden" name="rmcodeoperval">
</td>
<td bgcolor="#FFFFFF"><input type="text" name="rmcode" size=15 value="<?php echo $rmcode_match ?>" onkeypress="javascript: return checkenter(event)"></td>

<td bgcolor="#FFFFFF"><span class="tabletext"><b>RM Spec &nbsp</b>

</td>
<td bgcolor="#FFFFFF"><span class="tabletext"><select name="rmspec_oper" size="1" width="50">
<?php if($oper2=='like'){?>
<option selected>like
<option value>=<?php }else {?>
<option selected>=
<option value>like<?php }?>
</select>
<input type="hidden" name="rmspecoperval">
</td>
<td bgcolor="#FFFFFF" colspan=2><input type="text" name="rmspec" size=15 value="<?php echo $rmspec_match ?>" onkeypress="javascript: return checkenter(event)"></td>

<!--<td bgcolor="#FFFFFF"><span class="labeltext"><b>Sort by</b></td>
<td bgcolor="#FFFFFF" colspan=1><span class="tabletext"><select name="sort1" size="1" width="100">
<?php if($sort1 == 'rmcode')
{
?>
<option selected>rmcode
<option>rm_spec
<?php } else{
?>
<option selected>rm_spec
<option>rmcode
<?php
}
?>
</select> -->
<input type="hidden" name="sortfld1">
</td>

</tr>
<tr>
<td bgcolor="#FFFFFF"><span class="labeltext"><b>Status =</b></td>
<td colspan=6 bgcolor="#FFFFFF"><span class="tabletext"><select name="status_val_rm" size="1" width="50">
<?php
if ($sval == 'Active')
{
?>
<option  value="Active" selected>Active
<option value="Inactive">Inactive
<option value="Pending">Pending
<option value="All">All
<?php
}
else if ($sval == 'Inactive')
{
?>
<option  value="Inactive" selected>Inactive
<option value="Active">Active
<option value="Pending">Pending
<option value="All">All
<?php
}
else if ($sval == 'Pending')
{
?>
<option  value="Pending" selected>Pending
<option value="Active">Active
<option value="Inactive">Inactive
<option value="All">All
<?php
}
else if ($sval == 'All')
{
?>
<option  value="All" selected>All
<option value="Active">Active
<option value="Inactive">Inactive
<option value="Pending">Pending

<?php
}
?>
</select>
</td>
<tr>

</table>
</td></tr>
<tr><td>
<table width=100% border=0>
<div class="contenttitle radiusbottom0">
<h2><span>List Of RM Master Data

<?php
if($dept=='Sales' ||$dept=='Purchasing' )
{
?>
<input type="button" class="stdbtn btn_blue" style="float:right;padding:2px;margin-right:5px;" onClick="location.href='rmmasterentry.php'" value="New" >
<input type="button" class="stdbtn btn_blue" style="float:right;padding:2px;margin-right:5px;" onClick="location.href='rmmasterExport.php?cond=<?php echo $rmcode_match ?>'" value="Export" >
<!-- <a href="rmmasterExport.php?cond=<?php echo $rmcode_match ?>"><img style="float:right" name="Image8" border="0" src="images/export.gif" ></a> -->
<!-- <a href ="rmmasterentry.php"><img style="float:right" name="Image8" border="0" src="images/new.gif"></a> -->
<?php
}

?>
</h2>
</span>
</td width="20%">
</tr>

</table>

<table width=100% border=0 cellpadding=3 cellspacing=1 class="stdtable" >
  <thead>
<tr>
<th  class="head0"><span class="tabletext"><b>PRN#</b></th>
<th  class="head1"><span class="tabletext"><b>RM Status</b></th>
<th  class="head0"><span class="tabletext"><b>RM Spec</b></th>
<th  class="head1"><span class="tabletext"><b>Spec Type</b></th>
<th  class="head0"><span class="tabletext"><b>MRS</b></th>
<th  class="head1"><span class="tabletext"><b>Dia</b></th>
<th  class="head0"><span class="tabletext"><b>Length</b></th>
<th  class="head1"><span class="tabletext"><b>Width</b></th>
<th  class="head0"><span class="tabletext"><b>Thickness</b></th>
<th  class="head1"><span class="tabletext"><b>Qty/Billet</b></th>
<th  class="head0"><span class="tabletext"><b>Price</b></th>
</tr>
</thead>
<?php

$result = $newRM->getrmmaster($cond,$sort1,$offset,$rowsPerPage);

while($myrow=mysql_fetch_row($result))
{
printf('<tr bgcolor="#FFFFFF">');
if($myrow[22] == 'Inactive')
{
$color = '"#FF0000"';
}
else
{
$color = '"#FFFFFF"';
}
printf("<td align=\"center\" ><span class=\"tabletext\"><a href=\"rmmasterDetails.php?masterdatarecnum=%s\">%s</td>
<td bgcolor=$color align=\"center\"><span class=\"tabletext\">%s</td>
<td align=\"center\"><span class=\"tabletext\">%s</td>
<td align=\"center\"><span class=\"tabletext\">%s</td>
<td align=\"center\"><span class=\"tabletext\">%s</td>
<td align=\"center\"><span class=\"tabletext\">%s</td>
<td align=\"center\"><span class=\"tabletext\">%s</td>
<td align=\"center\"><span class=\"tabletext\">%s</td>
<td align=\"center\"><span class=\"tabletext\">%s</td>
<td align=\"center\"><span class=\"tabletext\">%s</td>
<td align=\"center\"><span class=\"tabletext\">%s %s</td>
",
$myrow[0],
$myrow[10],
$myrow[22],
$myrow[4],
$myrow[20],
$myrow[17],
$myrow[8],
$myrow[5],
$myrow[6],
$myrow[7],
$myrow[16],
$myrow[29],$myrow[18]);
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
</tr> -->

</table>
<table border = 0 cellpadding=0 cellspacing=0 width=100% >
<tr>
<td align=left>

<?php

//Additions on Dec 29 04 by Jerry George to implement pagination

$numrows = $newRM->getcrncount($cond,$offset,$rowsPerPage);
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
$prev = " <a href=\"rmmastersummary.php?page=$page&totpages=$totpages&rmcode=$rmcode_match&rmspec=$rmspec_match&sortfld1=$sort1&status_val=$sval\">[Prev]</a> ";

$first = " <a href=\"rmmastersummary.php?page=1&totpages=$totpages&rmcode=$rmcode_match&rmspec=$rmspec_match&sortfld1=$sort1&status_val=$sval\">[First Page]</a> ";
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
$next = " <a href=\"rmmastersummary.php?page=$page&totpages=$totpages&rmcode=$rmcode_match&rmspec=$rmspec_match&sortfld1=$sort1&status_val=$sval\">[Next]</a> ";

$last = " <a href=\"rmmastersummary.php?page=$totpages&totpages=$totpages&rmcode=$rmcode_match&rmspec<PRE></PRE>=$rmspec_match&sortfld1=$sort1&status_val=$sval\">[Last Page]</a> ";
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

