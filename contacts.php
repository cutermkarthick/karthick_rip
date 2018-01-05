<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = June 20, 2004                =
// Filename: contacts.php                      =
// Copyright of Badari Mandyam, FluentSoft     =
// Revision: v1.0 OET                          =
// Displays list of contacts                   =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
header ( "Location: login.php" );

}
$userid = $_SESSION['user'];
$dept = $_SESSION['department'];
if (!isset($_SESSION['userrole']))
{
header ( "Location: login.php" );
}

if ($_SESSION['userrole'] == 'SU'|| $_SESSION['userrole'] == 'SALES' || $_SESSION['userrole'] == 'RU')
{
$_SESSION['pagename'] = 'ucontact';
}
else
{
$_SESSION['pagename'] = 'contacts';
}
//////session_register('pagename');
if($userid != 'sa')
{
$page = "Accounts: Contacts";
}
else
{
	$page = "Company: Contacts";
}
//Following code added to implement search,sort  and Pagination on Dec 29-04 by Jerry George

$cond = "c1.fname like '%'";
$sort1='c2.name';
$select='fname';
$worec='';
$oper='like';
$where1='';
if ( isset ( $_REQUEST['scontact'] ) )
{
$contact_match = $_REQUEST['scontact'];
//echo " contact match :$contact_match</br>";
if ($contact_match!='')
{
if ( isset ( $_REQUEST['contact_oper'] ) ) {
$oper = $_REQUEST['contact_oper'];
//echo "oper :$oper";
}
else {
$oper = 'like';
}
if ($oper == 'like') {
$scontact = "'" . $_REQUEST['scontact'] . "%" . "'";
}
else {
$scontact = "'" . $_REQUEST['scontact'] . "'";
}
$where1 =$_REQUEST['scontactfl'];
$select=$_REQUEST['scontactfl'];
//echo "</br> value of where   :$where1";
if($where1=='company'){
$where1="name" ;
$cond = "c2." . $where1 . " " . $oper . " " . $scontact;}

else{
$cond = "c1." . $where1 . " " . $oper . " " . $scontact;}
$cond = $where1 . " " . $oper . " " . $scontact;
//echo "</br> value of where   :$where1";
}
else
$cond="c1.fname like '%'";
}
else {
$contact_match = '';
}
if ( isset ( $_REQUEST['sortfld1'] ) ) {
$sort1 ="c2." . $_REQUEST['sortfld1'];
//echo "</br>sort by  : $sort1";

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
/* if (isset($_REQUEST['submit']))
{
$submit=$_REQUEST['submit'];
//echo "$submit";
//     	 if ($submit=='New Contact')
//		 header ("Location: new_contact.php");
}*/

// counting the offset
$offset = ($pageNum - 1) * $rowsPerPage;

//End of Addition on Dec 29 -04 by Jerry George

// First include the class definition
include('classes/contactClass.php');
include_once('classes/displayClass.php');
$newdisplay = new display;
$newContact = new contact;
?>
<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/contact.js"></script>

<html>
<head>
<title>Contact</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">
<form action='contacts.php?scontact=$contact_match&contact_oper=$oper&sortfld1=$sort1&scontactfl=$where1' method='post' enctype='multipart/form-data'>
<?php
include('header.html');
?>
<!-- <table width=100% cellspacing="0" cellpadding="6" border="0">
<tr>
<td>
<table width=100% border=0 cellspacing="0" cellpadding="0">
<tr>
<td colspan=2><span class="welcome"><b>Welcome <?php echo $userid?></b></td>
<td align="right">&nbsp;<a href="exit.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image20','','images/logout_mo.gif',1)"><img name="Image20" border="0" src="images/logout.gif"></a></td>
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
<table width=100% border=0 cellpadding=6 cellspacing=0  >
<tr><td><span class="heading"><i>Please click on the Id link to Edit or Delete</i></td></tr>
<tr><td>
<table width=100% border=0 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1">
<tr>
<td bgcolor="#F5F6F5" colspan="3"><span class="heading"><b><center>Search Criteria</center></b></td>
<td bgcolor="#F5F6F5"  colspan="4"><span class="heading"><b><center>Sort Criteria</center></b></td>
<td bgcolor="#FFFFFF" rowspan=2 align="center">
<button class="stdbtn btn_blue" style="background-color:#2d3e50" onClick="javascript: return searchsort_fields()" >Get</button>	
<!-- <input type= "image" name="submit" src="images/bu-get.gif" value="Get" onclick="javascript: return searchsort_fields()"> -->

</td>
</tr>
<tr>
<td bgcolor="#FFFFFF"><span class="tabletext"><select name="scont" size="1" width="50">
<?php if($select=='fname'){?>
<option selected>fname
<option value>lname
<option value>company<?php }else if($select=='lname') {?>
<option selected>lname
<option value>fname
<option value>company<?php }else {?>
<option selected>company
<option value>fname
<option value>lname<?php }?>
</select>
</td>
<td bgcolor="#FFFFFF"><span class="tabletext"><select name="cont_oper" size="1" width="100">
<?php if($oper=='like'){?>
<option selected>like
<option value>=<?php }else {?>
<option selected>=
<option value>like<?php }?>
</select>
</td>
<td bgcolor="#FFFFFF"><input type="text" name="scontact" size=15 value="<?php echo $contact_match ?>" onkeypress="javascript: return checkenter(event)"></td>
<td bgcolor="#FFFFFF"><span class="labeltext"><b>Sort by</b></td>
<td bgcolor="#FFFFFF" colspan=3><span class="tabletext"><select name="sort1" size="1" width="100">
<option selected>name
</select>
<input type="hidden" name="scontactfl">
<input type="hidden" name="contact_oper">
<input type="hidden" name="sortfld1">
</td>
</tr>
</table>
</td></tr>
<tr><td>
<table width=100% border=0>

<div class="contenttitle radiusbottom0">
<h2><span>List of Contacts
<input type="button" class="stdbtn btn_blue" style="float:right;padding:2px;margin-right:5px;" onClick="location.href='new_contact.php'" value="New Contact" >	
<!-- <a href ="new_contact.php"><img style="float:right" name="Image8" border="0" src="images/bu-newcontact.gif"></a> -->
</h2>
</span>
</td>
</tr>
</table>
</td></tr>
<tr>
<td>

<table width=100% border=0 cellpadding=3 cellspacing=1 class="stdtable">
<thead>
<tr>
<th class="head0"><span class="tabletext"><b>Id</b></th>
<th class="head1"><span class="tabletext"><b>First Name</b></th>
<th class="head0"><span class="tabletext"><b>Last Name</b></th>
<th class="head1"><span class="tabletext"><b>Company</b></th>
<th class="head0"><span class="tabletext"><b>Email</b></th>
<th class="head1"><span class="tabletext"><b>Type</b></th>
<th class="head0"><span class="tabletext"><b>Title</b></th>
<th class="head1"><span class="tabletext"><b>Role</b></th>
<th class="head0"><span class="tabletext"><b>Status</b></th>
</tr>
</thead>
<?php
$newlogin = new userlogin;
$newlogin->dbconnect();
$result = $newContact->getContacts4sa($cond,$sort1,$offset,$rowsPerPage);
while ($myrow = mysql_fetch_assoc($result)) {
printf('<tr><td bgcolor="#FFFFFF" align="center"><span class="tabletext"><a href="edit_contact.php?contactid=%s"><b>%s</b></td>
<td bgcolor="#FFFFFF" align="center"><span class="tabletext">%s</td>
<td bgcolor="#FFFFFF" align="center"><span class="tabletext">%s</td>
<td bgcolor="#FFFFFF" align="center"><span class="tabletext">%s</td>
<td bgcolor="#FFFFFF" align="center"><span class="tabletext">%s</td>
<td bgcolor="#FFFFFF" align="center"><span class="tabletext">%s</td>
<td bgcolor="#FFFFFF" align="center"><span class="tabletext">%s</td>
<td bgcolor="#FFFFFF" align="center"><span class="tabletext">%s</td>
<td bgcolor="#FFFFFF" align="center"><span class="tabletext">%s</td></tr>',
$myrow["cid"],$myrow["cid"],
$myrow["fname"],
$myrow["lname"],
$myrow["name"],
$myrow["email"],
$myrow["type"],
$myrow["title"],
$myrow["role"],
$myrow["status"]);
printf('</td></tr>');
}

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

$numrows = $newContact ->getcontCount($cond,$offset, $rowsPerPage);
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
$prev = " <a href=\"contacts.php?page=$page&totpages=$totpages&scontact=$contact_match&scontactfl=$where1&contact_oper=$oper\">[Prev]</a> ";

$first = " <a href=\"contacts.php?page=1&totpages=$totpages&scontact=$contact_match&scontactfl=$where1&contact_oper=$oper\">[First Page]</a> ";
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
$next = " <a href=\"contacts.php?page=$page&totpages=$totpages&scontact=$contact_match&scontactfl=$where1&contact_oper=$oper\">[Next]</a> ";

$last = " <a href=\"contacts.php?page=$totpages&totpages=$totpages&scontact=$contact_match&scontactfl=$where1&contact_oper=$oper\">[Last Page]</a> ";
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
