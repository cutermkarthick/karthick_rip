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
$_SESSION['pagename'] = 'mastersummary';
$page = "Master Data";
//////session_register('pagename');

// First include the class definition
include_once('classes/userClass.php');
include_once('classes/masterdataClass.php');
include_once('classes/displayClass.php');
include('classes/pageClass.php');

$newdisplay = new display;
$newpage = new page;
$newMD = new masterdata;
$newdisplay = new display;

if (isset($_REQUEST['typenum']))
{
$typenum=$_REQUEST['typenum'];
$_SESSION['typenum'] = $typenum;
//////session_register('typenum');
}
if (isset($_REQUEST['quotetype']))
{
$quotetype=$_REQUEST['quotetype'];
$_SESSION['quotetype'] = $quotetype;
//////session_register('quotetype');
}
if (isset($_REQUEST['quoterecnum']))
{
$quoterecnum=$_REQUEST['quoterecnum'];
$_SESSION['quoterecnum'] = $quoterecnum;
//////session_register('quoterecnum');
}
$userrole = $_SESSION['userrole'];
$cond0 = "m.CIM_refnum like '%'";
$cond1 = "m.customer like '%'";
$cond2 = "m.partnum like '%'";
$cond3 = "(status like 'Active' || status = '' || status is NULL)";
if($_REQUEST[eng_app] !='')
{
$eng_app=$_REQUEST['eng_app'];
$cond4=" eng_app= '".$eng_app."'"; 
$_SESSION['eng_app']=$eng_app;
}
elseif($_REQUEST['eng_app'] == '' && $_SESSION['eng_app']!='')
{
$eng_app=$_SESSION['eng_app'];
$cond4=" eng_app = '".$eng_app."'";
$_SESSION['eng_app']=$eng_app;
}

$cond = $cond0 . ' and ' . $cond1 . ' and ' . $cond2. ' and ' . $cond3. ' and ' . $cond4;

$oper1='like';
$oper2='like';
$oper3='like';
$sort1='CIM_refnum';
$sort2='company';
$sort3='partnum';
$sess=session_id();

if ( isset ( $_REQUEST['cim'] ) )
{
$cim_match = $_REQUEST['cim'];
if ( isset ( $_REQUEST['cim_oper'] ) ) {
$oper1 = $_REQUEST['cim_oper'];
}
else {
$oper1 = 'like';
}
if ($oper1 == 'like') {
$cim = "'" . $_REQUEST['cim'] . "%" . "'";
}
else {
$cim = "'" . $_REQUEST['cim'] . "'";
}

$cond0 = "m.CIM_refnum " . $oper1 . " " . $cim;

}
else {
$cim_match = '';
}

if ( isset ( $_REQUEST['customer'] ) )
{
$cust_match = $_REQUEST['customer'];
if ( isset ( $_REQUEST['cust_oper'] ) ) {
$oper2 = $_REQUEST['cust_oper'];
}
else {
$oper2 = 'like';
}
if ($oper2 == 'like') {
$customer = "'" . $_REQUEST['customer'] . "%" . "'";
}
else {
$customer = "'" . $_REQUEST['customer'] . "'";
}

$cond1 = "m.customer " . $oper2 . " " . $customer;

}
else {
$cust_match = '';
}

if ( isset ( $_REQUEST['partnumber'] ) )
{
$part_match = $_REQUEST['partnumber'];
if ( isset ( $_REQUEST['part_oper'] ) ) {
$oper3 = $_REQUEST['part_oper'];
}
else {
$oper3 = 'like';
}
if ($oper3 == 'like') {
$partnumber = "'" . $_REQUEST['partnumber'] . "%" . "'";
}
else {
$partnumber = "'" . $_REQUEST['partnumber'] . "'";
}

$cond2 = "m.partnum " . $oper3 . " " . $partnumber;

}
else {
$part_match = '';
}


if ( isset ( $_REQUEST['sortfld1'] ) ) {
$sort1 = $_REQUEST['sortfld1'];
}

if ( isset ( $_REQUEST['sortfld2'] ) ) {
$sort2 = $_REQUEST['sortfld2'];
}

if(isset ($_REQUEST['status_val'] ) )
{
$sval = $_REQUEST['status_val'];

if ($sval== 'Active')
{
$cond3 = "(m.status = '" . $sval . "' || m.status is NULL || m.status = '')";
}
else if ($sval == 'Inactive')
{
$cond3 = "m.status = '" . $sval . "'" ;
}
else if ($sval == 'All')
{
$cond3 = "(m.status like '%' || m.status is NULL)";
}

}
else
{
$sval = 'Active';
$cond3 = "(m.status = '" . $sval . "' || m.status is NULL || m.status = '')";
}



if(isset ($eng_app ) )
{
//$eng_app = $_REQUEST['eng_app'];

if ($eng_app== 'yes')
{
$cond4 = "m.eng_app = '" . $eng_app ."'" ;
}
else if ($eng_app == 'no')
{
$cond4 = "(m.eng_app is null || m.eng_app = '" . $eng_app . "' || m.eng_app= '' )";
}   

}
else
{
$eng_app='yes';
$cond4 = "m.eng_app = 'yes'";
}

$cond = $cond0 . ' and ' . $cond1 . ' and ' . $cond2 . ' and ' . $cond3. ' and ' . $cond4;


// how many rows to show per page
$rowsPerPage = 20;

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
// echo $pageNum;
$offset = ($pageNum - 1) * $rowsPerPage;



?>
<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/master_data.js"></script>
<html>
<head>
<title>Master Summary</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">




<form action='viewmasterSummary.php' method='post' enctype='multipart/form-data'>
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
<table width=100% border=0 cellpadding=6 cellspacing=2>
<tr><td>
<tr><td><span class="heading"><i>Please click on the Host Ref No. to Edit/Delete</i></td></tr>
</tr>
<tr>
<td>


<table width=100% border=0 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1" >
<tr>
<td bgcolor="#F5F6F5" colspan="10"><span class="heading"><b><center>Search & Sort riteria</center></b></td>
<td bgcolor="#FFFFFF" rowspan=3 align="center"><span class="tabletext"><button class="stdbtn btn_blue" style="background-color:#2d3e50" onClick="javascript: return searchsort_fields()" >Get</button></td>
</tr>
<tr>
<td bgcolor="#FFFFFF"><span class="tabletext"><b>Host Ref No.</b>

</td>
<td bgcolor="#FFFFFF"><span class="tabletext"><select name="cim_oper" size="1" width="50">
<?php if($oper1=='like'){?>
<option selected>like
<option value>=<?php }else {?>
<option selected>=
<option value>like<?php }?>
</select>
<input type="hidden" name="cimoperval">
</td>
<td bgcolor="#FFFFFF"><input type="text" name="cim" size=15 value="<?php echo $cim_match ?>" onkeypress="javascript: return checkenter(event)"></td>
<td bgcolor="#FFFFFF"><span class="tabletext"><b>Part No.</b>

</td>

<td bgcolor="#FFFFFF"><span class="tabletext"><select name="part_oper" size="1" width="50">
<?php if($oper3=='like'){?>
<option selected>like
<option value>=<?php }else {?>
<option selected>=
<option value>like<?php }?>
</select>
<input type="hidden" name="partoperval">
</td>
<td bgcolor="#FFFFFF"><input type="text" name="partnumber" size=15 value="<?php echo $part_match ?>" onkeypress="javascript: return checkenter(event)"></td>

<td bgcolor="#FFFFFF"><span class="tabletext"><b>Customer &nbsp</b>

</td>
<td bgcolor="#FFFFFF"><span class="tabletext"><select name="cust_oper" size="1" width="50">
<?php if($oper2=='like'){?>
<option selected>like
<option value>=<?php }else {?>
<option selected>=
<option value>like<?php }?>
</select>
<input type="hidden" name="custoperval">
</td>
<td bgcolor="#FFFFFF" colspan=2><input type="text" name="customer" size=15 value="<?php echo $cust_match ?>" onkeypress="javascript: return checkenter(event)"></td>


</tr>
<tr>
<td bgcolor="#FFFFFF"><span class="labeltext"><b>Status</b></td>
<td  bgcolor="#FFFFFF" colspan=2><span class="tabletext"><select name="status_val" size="1" width="50">
<?php
if ($sval == 'Active')
{
?>
<option selected value="Active">Active
<option value="Inactive">Inactive
<option value="All">All
<?php
}
else if ($sval == 'Inactive')
{
?>
<option selected value="Inactive">Inactive
<option value="Active">Active
<option value="All">All
<?php
}
else if ($sval == 'All')
{
?>
<option selected value="All">All
<option value="Active">Active
<option value="Inactive">Inactive

<?php
}
?>
</select>
</td>


<td bgcolor="#FFFFFF"><span class="labeltext"><b>Eng Approved</b></td>
<td  bgcolor="#FFFFFF" colspan=5><span class="tabletext"><select name="eng_app" size="1" width="50">
<?php
if ($eng_app == 'yes')
{
?>
<option selected value="yes">Yes
<option value="no">No

<?php
}
else if ($eng_app == 'no')
{
?>
<option selected value="no">No
<option value="yes">Yes

<?php
}      
?>
</select>
</td>

</tr>
</table>

</td></tr>
<tr><td>
<table width=100% border=0>

<!--	<tr>
<td><span class="labeltext">Upload File:</td>
<td align=left><input type="file" name="attachments" size=20 value="">
<input type="submit" value="Upload" >
</td>
</tr>    -->

<tr>
<td><span class="pageheading"><b>List Of Master Data</b></td>
<td colspan=160>&nbsp;</td>

<!--<td>
<a href ="processMaster_data.php"><img name="Image8" border="0" src="images/bu_newmaster.gif"></a></td>
</td> -->

<td>
<!--  <a href ="new_master_data.php"><img name="Image8" border="0" src="images/bu_newmaster.gif"></a>-->
</td>
</tr>

</table>

<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable">
<tr>
<thead>
<th class="head0"  bgcolor="#EEEFEE"><span class="tabletext"><b>Host Ref No.</b></th>
<th class="head1"  bgcolor="#EEEFEE"><span class="tabletext"><b>PRN Status</b></th>
<th class="head0"  bgcolor="#EEEFEE"><span class="tabletext"><b>Part Name</b></th>
<th class="head1"  bgcolor="#EEEFEE"><span class="tabletext"><b>Part#</b></th>
<th class="head0"  bgcolor="#EEEFEE"><span class="tabletext"><b>Secondary Part#</b></th>
<th class="head1"  bgcolor="#EEEFEE"><span class="tabletext"><b>Customer</b></th>
<th class="head0"  bgcolor="#EEEFEE"><span class="tabletext"><b>RM Type</b></th>

</tr>
</thead>


<?php



$result = $newMD->getmasterdatas($cond,$sort1,$offset,$rowsPerPage);

while($myrow=mysql_fetch_row($result))
{

printf('<tr bgcolor="#FFFFFF">');
if($myrow[8] == 'Inactive')
{
$color = '"#FF0000"';
}
else
{
$color = '"#FFFFFF"';

}
printf("<td ><span class=\"tabletext\">
<a href=\"viewmaster_dataDetails.php?masterdatarecnum=%s&crnnum=%s\">%s</td>
<td bgcolor=$color><span class=\"tabletext\">%s</td>
<td><span class=\"tabletext\">%s</td>
<td><span class=\"tabletext\">%s</td>
<td><span class=\"tabletext\">%s</td>
<td><span class=\"tabletext\">%s</td>
<td><span class=\"tabletext\">%s</td>
",
$myrow[0],$myrow[1],
$myrow[1],
$myrow[8],
$myrow[2],
$myrow[6],
$myrow[7],
$myrow[4],
$myrow[5]);
printf("</td></tr>");
}

?>
</table>
</table>
<!--      <td width="6"><img src="images/spacer.gif " width="6"></td>
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

$numrows = $newMD->getcrncount($cond,$offset,$rowsPerPage);
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
$prev = " <a href=\"viewmasterSummary.php?page=$page&totpages=$totpages&cim=$cim_match&customer=$cust_match&sortfld1=$sort1&status_val=$sval\">[Prev]</a> ";

$first = " <a href=\"viewmasterSummary.php?page=1&totpages=$totpages&cim=$cim_match&customer=$cust_match&sortfld1=$sort1&status_val=$sval\">[First Page]</a> ";
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
$next = " <a href=\"viewmasterSummary.php?page=$page&totpages=$totpages&cim=$cim_match&customer=$cust_match&sortfld1=$sort1&status_val=$sval\">[Next]</a> ";

$last = " <a href=\"viewmasterSummary.php?page=$totpages&totpages=$totpages&cim=$cim_match&customer=$cust_match&sortfld1=$sort1&status_val=$sval\">[Last Page]</a> ";
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

