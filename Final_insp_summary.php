<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = June 20, 2004                =
// Filename: company.php                       =
// Copyright of Badari Mandyam, FluentSoft     =
// Revision: v1.0 OMS                          =
// Displays list of comapnies.                 =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
header ( "Location: login.php" );

}
$userid = $_SESSION['user'];
$dept = $_SESSION['department'];
$_SESSION['pagename'] = 'final_insp_summary';
$page = "QA: Final Insp";
//////session_register('pagename');

// First include the class definition
include_once('classes/userClass.php');
include_once('classes/Final_insp_reportClass.php');
include_once('classes/displayClass.php');
include('classes/companyClass.php');
include('classes/Final_insp_reportliClass.php');
include('classes/pageClass.php');

$newFIR = new final_insp_report;
$newLI = new final_insp_reportli;
$newdisplay = new display;
$newpage = new page;
$newdisplay = new display;
$newCustomer = new company;

$cond0 = "fir.refnum like '%'";
$cond1 = "fir.wonum like '%'";
$cond2 = "fir.customer like '%'";
$cond3 = "fir.ponum like '%'";

$cond4 = "(to_days(fir.billdate)-to_days('1582-01-01') > 0 ||
fir.billdate = '0000-00-00' ||
fir.billdate = 'NULL') and
(to_days(fir.billdate)-to_days('2050-12-31') < 0 ||
fir.billdate = '0000-00-00' ||
fir.billdate = 'NULL')";
//$cond4 = "w.wotype like '%'";
$cond5 = "fir.partnum like '%'";

$cond = $cond0 . ' and ' . $cond1 . ' and ' . $cond2 . ' and ' . $cond3 . ' and ' . $cond4 . ' and ' . $cond5;

$final_insprecnum='';
$oper1='like';
$oper2='like';
$oper3='like';
$oper4='like';
$oper5='like';
$oper6='like';
$sort1='refnum';

if ( isset ( $_REQUEST['final_refno'] ) )
{
$finalref_match = $_REQUEST['final_refno'];
if ( isset ( $_REQUEST['refno_oper'] ) ) {
$oper1 = $_REQUEST['refno_oper'];
}
else {
$oper1 = 'like';
}
if ($oper1 == 'like') {
$final_refno = "'" . $_REQUEST['final_refno'] . "%" . "'";
}
else {
$final_refno = "'" . $_REQUEST['final_refno'] . "'";
}

$cond0 = "fir.refnum " . $oper1 . " " . $final_refno;

}
else {
$finalref_match = '';
}

if ( isset ( $_REQUEST['final_wono'] ) )
{
$wono_match = $_REQUEST['final_wono'];
if ( isset ( $_REQUEST['wono_oper'] ) ) {
$oper2 = $_REQUEST['wono_oper'];
}
else {
$oper2 = 'like';
}
if ($oper2 == 'like') {
$final_wono = "'" . $_REQUEST['final_wono'] . "%" . "'";
}
else {
$final_wono = "'" . $_REQUEST['final_wono'] . "'";
}

$cond1 = "fir.wonum " . $oper2 . " " . $final_wono;

}
else {
$wono_match = '';
}

if ( isset ( $_REQUEST['final_cust'] ) )
{
$cust_match = $_REQUEST['final_cust'];
if ( isset ( $_REQUEST['cust_oper'] ) ) {
$oper3 = $_REQUEST['cust_oper'];
}
else {
$oper3 = 'like';
}
if ($oper3 == 'like') {
$final_cust = "'" . $_REQUEST['final_cust'] . "%" . "'";
}
else {
$final_cust = "'" . $_REQUEST['final_cust'] . "'";
}

$cond2 = "fir.customer " . $oper3 . " " . $final_cust;

}
else {
$cust_match = '';
}

if ( isset ( $_REQUEST['final_pono'] ) )
{
$pono_match = $_REQUEST['final_pono'];
if ( isset ( $_REQUEST['pono_oper'] ) ) {
$oper4 = $_REQUEST['pono_oper'];
}
else {
$oper4 = 'like';
}
if ($oper4 == 'like') {
$final_pono = "'" . $_REQUEST['final_pono'] . "%" . "'";
}
else {
$final_pono = "'" . $_REQUEST['final_pono'] . "'";
}

$cond3 = "fir.ponum " . $oper4 . " " . $final_pono;

}
else {
$pono_match = '';
}
if ( isset ( $_REQUEST['final_part'] ) )
{
$partno_match = $_REQUEST['final_part'];
if ( isset ( $_REQUEST['part_oper'] ) ) {
$oper6 = $_REQUEST['part_oper'];
}
else {
$oper6 = 'like';
}
if ($oper6 == 'like') {
$final_part = "'" . $_REQUEST['final_part'] . "%" . "'";
}
else {
$final_part = "'" . $_REQUEST['final_part'] . "'";
}

$cond5 = "fir.partnum " . $oper6 . " " . $final_part;

}
else {
$partno_match = '';
}

if ( isset ( $_REQUEST['final_date1'] ) || isset ( $_REQUEST['final_date2'] ) )
{
$fdate1_match = $_REQUEST['final_date1'];
$fdate2_match = $_REQUEST['final_date2'];
if ( isset ( $_REQUEST['final_date1']) &&  $_REQUEST['final_date1'] != '' )
{
$date1 = $_REQUEST['final_date1'];
$cond41 = "to_days(fir.billdate) " . "> to_days('" . $date1 . "')";
}
else
{
$cond41 = "(to_days(fir.billdate)-to_days('1582-01-01') > 0 || fir.billdate = 'NULL' || fir.billdate = '0000-00-00')";
}

if ( isset ( $_REQUEST['final_date2'] )  &&  $_REQUEST['final_date2'] != '')
{
$date2 = $_REQUEST['final_date2'];
$cond42 = "to_days(fir.billdate) " . "< to_days('" . $date2 . "')";
}
else
{
$cond42 = "(to_days(fir.billdate)-to_days('2050-12-31') < 0 || fir.billdate = 'NULL' || fir.billdate = '0000-00-00')";
}
$cond4 = $cond41 . ' and ' . $cond42;

}

else
{
$fdate1_match = '';
$fdate2_match = '';
}

if ( isset ( $_REQUEST['sortfld1'] ) ) {
$sort1 = $_REQUEST['sortfld1'];

}


$cond = $cond0 . ' and ' . $cond1 . ' and ' . $cond2 . ' and ' . $cond3 . ' and ' . $cond4 . 'and ' . $cond5;

$userrole = $_SESSION['userrole'];

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

//echo $offset;

?>

<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/final_insp.js"></script>

<html>
<head>
<title>Final Inspection Report</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">
<form action='Final_insp_summary.php' method='post' enctype='multipart/form-data'>
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
<tr bgcolor="DEDFDE"><td width="6"><img src="images/spacer.gif " width="6"></td> -->
<td bgcolor="#FFFFFF">
<table width=100% border=0 cellpadding=6 cellspacing=1>
<tr><td>
<tr><td><span class="heading"><i>Please click on the Host Ref No to Edit/Delete</i></td></tr>
</tr>
<tr>
<td>

<table width=100% border=0 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1">
<tr>
<td bgcolor="#F5F6F5" colspan="13"><span class="heading"><b><center>Search & SortCriteria</center></b></td>
<td bgcolor="#FFFFFF" rowspan=3 align="center">
	<button class="stdbtn btn_blue" style="background-color:#2d3e50" onClick="javascript: return searchsort_fields()" >Get</button>
<!-- <input type= "image" name="submit" src="images/bu-get.gif" value="Get" onclick="javascript: return searchsort_fields()"> -->


<input type="hidden" name="refno_oper">
<input type="hidden" name="wono_oper">
<input type="hidden" name="cust_oper">
<input type="hidden" name="partno_oper">
<input type="hidden" name="pono_oper">
</td>
</tr>
<tr>
<td bgcolor="#FFFFFF"><span class="labeltext"><b>PRN No</b></td>

<td bgcolor="#FFFFFF"><span class="tabletext"><select name="refno_oper" size="1" width="50">
<?php
if ( isset ( $_REQUEST['refno_oper'] ) ){
$check2 = $_REQUEST['refno_oper'];

if ($check2 =='like'){
?>
<option value>=
<option selected>like
<?php
}else{
?>
<option selected>=
<option value >like

<?php
}
}else{
?>
<option selected>like
<option value>=
<?PHP
}
?>
</select></td>

<td bgcolor="#FFFFFF"><input type="text" name="final_refno" size=15 value="<?php echo $finalref_match ?>" onkeypress="javascript: return checkenter(event)">
</td>

<td bgcolor="#FFFFFF"><span class="labeltext"><b>WO No</b></td>

<td bgcolor="#FFFFFF"><span class="tabletext"><select name="wono_oper" size="1" width="50">
<?php
if ( isset ( $_REQUEST['wono_oper'] ) ){
$check2 = $_REQUEST['wono_oper'];

if ($check2 =='like'){
?>
<option value>=
<option selected>like
<?php
}else{
?>
<option selected>=
<option value>like

<?php
}
}else{
?>
<option selected>like
<option value>=
<?PHP
}
?>
</select></td>

<td bgcolor="#FFFFFF"><input type="text" name="final_wono" size=15 value="<?php echo $wono_match ?>" onkeypress="javascript: return checkenter(event)">
</td>

<td bgcolor="#FFFFFF"><span class="labeltext"><b>Customer</b></td>

<td bgcolor="#FFFFFF"><span class="tabletext"><select name="cust_oper" size="1" width="50">
<?php
if ( isset ( $_REQUEST['cust_oper'] ) ){
$check2 = $_REQUEST['cust_oper'];

if ($check2 =='like'){
?>
<option value>=
<option selected>like
<?php
}else{
?>
<option selected>=
<option value>like

<?php
}
}else{
?>
<option selected>like
<option value>=
<?PHP
}
?>
</select></td>

<td bgcolor="#FFFFFF"><input type="text" name="final_cust" size=15 value="<?php echo $cust_match ?>" onkeypress="javascript: return checkenter(event)">
</td>

<td bgcolor="#FFFFFF" colspan=4><span class="labeltext"><b>Sort on</b>
<span class="tabletext"><select name="sort1" size="1" width="100">
<?php
if ($sort1=='refnum')
{
?>
<option selected>Ref num

<?php
}
?>
</select>
<input type="hidden" name="sortfld1">
</td>
<tr>

<td bgcolor="#FFFFFF"><span class="labeltext"><b>Part No</b></td>

<td bgcolor="#FFFFFF"><span class="tabletext"><select name="part_oper" size="1" width="50">
<?php
if ( isset ( $_REQUEST['part_oper'] ) ){
$check2 = $_REQUEST['part_oper'];

if ($check2 =='like'){
?>
<option value>=
<option selected>like
<?php
}else{
?>
<option selected>=
<option value>like

<?php
}
}else{
?>
<option value="like" selected>like
<option value="equal">=
<?PHP
}
?>
</select></td>

<td bgcolor="#FFFFFF"><input type="text" name="final_part" size=15 value="<?php echo $partno_match ?>" onkeypress="javascript: return checkenter(event)">
</td>

<td bgcolor="#FFFFFF"><span class="labeltext"><b>PO No</b></td>

<td bgcolor="#FFFFFF"><span class="tabletext"><select name="pono_oper" size="1" width="50">
<?php
if ( isset ( $_REQUEST['pono_oper'] ) ){
$check2 = $_REQUEST['pono_oper'];

if ($check2 =='like'){
?>
<option value>=
<option selected>like
<?php
}else{
?>
<option selected>=
<option value>like

<?php
}
}else{
?>
<option value="like" selected>like
<option value="equal">=
<?PHP
}
?>
</select></td>

<td bgcolor="#FFFFFF"><input type="text" name="final_pono" size=15 value="<?php echo $pono_match ?>" onkeypress="javascript: return checkenter(event)">
</td>

<td colspan=7 bgcolor="#FFFFFF"><span class="labeltext"><b>Bill Date:  From &nbsp&nbsp</b>
<input type="text" name="final_date1" size=10 value="<?php echo $fdate1_match ?>"
onkeypress="javascript: return checkenter(event)">
<img src="images/bu-getdateicon.gif" alt="Get Date" onclick='GetDate("final_date1")'>
<span class="labeltext"><b>&nbsp;&nbsp;To</b>
<input type="text" name="final_date2" size=10 value="<?php echo $fdate2_match ?>"
onkeypress="javascript: return checkenter(event)">
<img src="images/bu-getdateicon.gif" alt="Get Date" onclick='GetDate("final_date2")'>
</td>


</tr>

</table>
</td></tr>
<tr><td>
<table width=100% border=0>
<div class="contenttitle radiusbottom0">
<h2><span>List Of Final Inspections 
<input type="button" class="stdbtn btn_blue" style="float:right;padding:2px;margin-right:5px;" onClick="location.href='new_final_insp.php'" value="New Final_Insp" > 
<!-- <a href ="new_final_insp.php"><img style="float:right" name="Image8" border="0"  src="images/bu_newfinal.gif"></a> -->
</h2>
</span>
</table>

<table width=100% border=0 cellpadding=3 cellspacing=1 class="stdtable">
<thead>
<tr>
<th  class="head0"><span class="tabletext"><b>Id No.</b></th>
<th  class="head1"><span class="tabletext"><b>WO No</b></th>
<th  class="head0"><span class="tabletext"><b>Host Ref No.</b></th>
<th  class="head1"><span class="tabletext"><b>Part No</b></th>
<th  class="head0"><span class="tabletext"><b>Customer</b></th>
<th  class="head1"><span class="tabletext"><b>PO No</b></th>
<th  class="head0"><span class="tabletext"><b>Bill Date</b></th>
</tr>
</thead>

<?php

$result = $newFIR->getFinal_insps($cond,$offset,$sort1,$rowsPerPage);

while ($myrow = mysql_fetch_row($result)) {
$d=substr($myrow[5],8,2);
$m=substr($myrow[5],5,2);
$y=substr($myrow[5],0,4);
$x=mktime(0,0,0,$m,$d,$y);
$date=date("M j, Y",$x);

printf('<tr bgcolor="#FFFFFF"><td align="center"><span class="tabletext">
<a href="final_inspDetails.php?final_insprecnum=%s">%05d</td>
<td align="center"><span class="tabletext">%s</td>
<td align="center"><span class="tabletext">%s</td>
<td align="center"><span class="tabletext">%s</td>
<td align="center"><span class="tabletext">%s</td>
<td align="center"><span class="tabletext">%s</td>
<td align="center"><span class="tabletext">%s</td>
',
$myrow[0],$myrow[0],
$myrow[3],
$myrow[1],
$myrow[7],
$myrow[2],
$myrow[4],
$date);
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

$numrows = $newFIR->getfinal_inspCount($cond,$offset,$rowsPerPage);
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
$prev = " <a href=\"final_insp_summary.php?page=$page&totpages=$totpages\">[Prev]</a> ";

$first = " <a href=\"final_insp_summary.php?page=1&totpages=$totpages\">[First Page]</a> ";
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
$next = " <a href=\"final_insp_summary.php?page=$page&totpages=$totpages\">[Next]</a> ";

$last = " <a href=\"final_insp_summary.php?page=$totpages&totpages=$totpages\">[Last Page]</a> ";
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

