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
$dept = $_SESSION['department'];

if (!isset($_SESSION['userrole']))
{
     header ( "Location: login.php" );
}

if ($_SESSION['userrole'] == 'SU' || $_SESSION['userrole'] == 'SALES' ||$_SESSION['userrole'] == 'RU')
{
    $_SESSION['pagename'] = 'ucompany';
}
else
{
    $_SESSION['pagename'] = 'company';
}
//////session_register('pagename');

//Following code added to implement search,sort  and Pagination on Dec 29-04 by Jerry George

$cond0 = "name like '%'";
$cond1 = "type like '".$_SESSION['type_accounts']."%'";
$sort1='name';
$select='name';
$worec='';
$where1='';
$oper='like';
if ( isset ( $_REQUEST['scompany'] ))
{
     $company_match = $_REQUEST['scompany'];
   if ($company_match!='')
{

     if ( isset ( $_REQUEST['company_oper'] ) )
    {
   	  $oper = $_REQUEST['company_oper'];
    }
    else
    {
    	 $oper = 'like';
    }
    if ($oper == 'like')
    {
    	$scompany = "'" . $_REQUEST['scompany'] . "%" . "'";
     }
     else
     {
 	 $scompany = "'" . $_REQUEST['scompany'] . "'";
     }
     $where1 =$_REQUEST['scompanyfl'];
     $select=$_REQUEST['scompanyfl'];
     $cond0 = $where1 . " " . $oper . " " . $scompany;
}
else
$cond0="name like '%'";
}
 else
{
 	$company_match = '';
 }
 
 if(isset ($_SESSION['type_accounts'] ))
{
   $sval = $_SESSION['type_accounts'];
  if ($sval== 'VEND')
      {
         $cond1 = "(type = '" . $sval . "' || type is NULL || type = '')";
      }
     else if ($sval == 'CUST')
      {
         $cond1 = "type = '" . $sval . "'" ;
      }
       else if ($sval == 'HOST')
      {
         $cond1 = "type = '" . $sval . "'" ;
      }
      else if ($sval == 'ALL')
      {
         $cond1 = "type like '%'" ;
      }
}
if(isset ($_REQUEST['type_accounts'] ) )
{
     $sval = $_REQUEST['type_accounts'];
     $_SESSION['type_accounts'] = $sval;

      if ($sval== 'VEND')
      {
         $cond1 = "(type = '" . $sval . "' || type is NULL || type = '')";
      }
     else if ($sval == 'CUST')
      {
         $cond1 = "type = '" . $sval . "'" ;
      }
       else if ($sval == 'HOST')
      {
         $cond1 = "type = '" . $sval . "'" ;
      }
      else if ($sval == 'ALL')
      {
         $cond1 = "type like '%'" ;
      }
}
else if(!isset ($_SESSION['type_accounts'] ))
{
     $sval = 'VEND';
     $cond1 = "(type = '" . $sval . "' || type is NULL || type = '')";
}

 

if ( isset ( $_REQUEST['sortfld1'] ) )
{
	 $sort1 = $_REQUEST['sortfld1'];
}

// how many rows to show per page
$rowsPerPage = 15;

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
if($userid != 'sa')
{
$page = "Accounts";
}else
{
  $page = "Company";
}
// counting the offset
$offset = ($pageNum - 1) * $rowsPerPage;

$cond = $cond0 . ' and ' . $cond1 ;
//End of Addition on Dec 29 -04 by Jerry George

// First include the class definition
include('classes/companyClass.php');
include_once('classes/displayClass.php');
$newdisplay = new display;
$newCompany = new Company;
?>
<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/company.js"></script>

<html>
<head>
<title>Accounts</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">
<form action='account.php?scompany=$company_match&company_oper=$oper&sortfld1=$sort1&scompanyfl=$where1' method='post' enctype='multipart/form-data'>
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
<td width="6"><img src="images/spacer.gif " width="6"></td>
<td bgcolor="#FFFFFF"> -->
<table width=100% border=0 cellpadding=6 cellspacing=2  >
<tr><td><span class="heading"><i>Please click on the Account id link to Edit or Delete</i></td></tr>
<tr><td>
<table width=100% border=0 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1">
<tr>
<td bgcolor="#F5F6F5" colspan="3"><span class="heading"><b><center>Search Criteria</center></b></td>
<td bgcolor="#F5F6F5"  colspan="4"><span class="heading"><b><center>Sort Criteria</center></b></td>
<td bgcolor="#FFFFFF" rowspan=3 align="center">
<button class="stdbtn btn_blue" style="background-color:#2d3e50" onclick="javascript: return searchsort_fields()">Get</button>
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
<td bgcolor="#FFFFFF"><span class="tabletext"><select name="comp_oper" size="1" width="50">
<?php if($oper=='like'){?>
<option selected>like
<option value>=<?php }else {?>
<option selected>=
<option value>like<?php }?>
</td>
<td bgcolor="#FFFFFF"><input type="text" name="scompany" size=20 value="<?php echo $company_match ?>" onkeypress="javascript: return checkenter(event)"></td>
<td bgcolor="#FFFFFF"><span class="labeltext"><b>Sort by</b></td>
<td bgcolor="#FFFFFF" colspan=3><span class="tabletext"><select name="sort1" size="1" width="100">
<option selected>name
</select>
<input type="hidden" name="sortfld1">
<input type="hidden" name="scompanyfl">
<input type="hidden" name="company_oper">
</td>
</tr>
<tr>
<td bgcolor="#FFFFFF"><span class="labeltext"><b>Type</b></td>
<td bgcolor="#FFFFFF" colspan=6><span class="tabletext"><select name="type_accounts" size="1" width="100">
 <?php
 if ($sval == 'VEND')
 {
    ?>
<option selected value="VEND">Vend
<option value="CUST">Cust
  <option value="HOST">Host
 <option value="ALL">All
<?php
}
else if ($sval == 'CUST')
{
 ?>
<option selected value="CUST">Cust
<option value="VEND">Vend
  <option value="HOST">Host
    <option value="ALL">All
<?php
}

else if ($sval == 'ALL')
{
?>
<option selected value="ALL">All
<option value="VEND">Vend
<option value="CUST">Cust
<option value="HOST">Host
<?php
 }

    else if ($sval == 'HOST')
{
?>
<option selected value="ALL">All
<option value="VEND">Vend
<option value="CUST">Cust
  <option value="HOST">Host

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
<div class="contenttitle radiusbottom0">
<h2><span>Accounts List
  <input type="button" class="stdbtn btn_blue" style="float:right;padding:2px;margin-right:5px" onClick="location.href='new_account.php'" value="New Account" >
<!-- <a href ="new_account.php"><img name="Image8" style="float:right" border="0" src="images/na.gif"></a> -->
</h2>
</span>
</td>
</tr>

</td></tr>
</table>
							
<table width=100% border=0 cellpadding=3 cellspacing=1 class="stdtable">
  <thead>
<tr>
<th class="head0"><span class="tabletext"><b>Id</b></th>
<th class="head1"><span class="tabletext"><b>Account Name</b></th>
<th class="head0"><span class="tabletext"><b>Type</b></th>
<th class="head1"><span class="tabletext"><b>Industry</b></th>
<th class="head0"><span class="tabletext"><b>Phone</b></th>
<th class="head1"><span class="tabletext"><b>City</b></th>
<th class="head0"><span class="tabletext"><b>State</b></th>
<th class="head1"><span class="tabletext"><b>Country</b></th>
</tr>
</thead>

<?php
$newlogin = new userlogin;
$newlogin->dbconnect();
$newCompany = new company;
//Function getAccounts() modified on Dec 29 to implement sort and search
$result = $newCompany->getAccounts($cond,$sort1,$offset,$rowsPerPage);
while ($myrow = mysql_fetch_row($result)) {
printf('<tr><td bgcolor="#FFFFFF" align="center"><span class="tabletext"><a href="edit_account.php?id=%s"><b>%s</b></td>
<td bgcolor="#FFFFFF" align="center"><span class="tabletext">%s</td>
<td bgcolor="#FFFFFF" align="center"><span class="tabletext">%s</td>
<td bgcolor="#FFFFFF" align="center"><span class="tabletext">%s</td>
<td bgcolor="#FFFFFF" align="center"><span class="tabletext">%s</td>
<td bgcolor="#FFFFFF" align="center"><span class="tabletext">%s</td>
<td bgcolor="#FFFFFF" align="center"><span class="tabletext">%s</td>
<td bgcolor="#FFFFFF" align="center"><span class="tabletext">%s</td></tr>',
$myrow[0],$myrow[0],
$myrow[1],
$myrow[2],
$myrow[3],
$myrow[4],
$myrow[5],
$myrow[6],
$myrow[8]);
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
<table border = 0 cellpadding=0 cellspacing=0 width=100% bgcolor="FFFFFF">
<tr>
<td align=left>

<?php

//Additions on Dec 29 04 by Jerry George to implement pagination

$numrows = $newCompany->getcompCount($cond,$offset, $rowsPerPage);
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
    $prev = " <a href=\"account.php?page=$page&totpages=$totpages&scompany=$company_match&type=$sval&scompanyfl=$where1&company_oper=$oper\">[Prev]</a> ";

    $first = " <a href=\"account.php?page=1&totpages=$totpages&scompany=$company_match&type=$sval&scompanyfl=$where1&company_oper=$oper\">[First Page]</a> ";
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
    $next = " <a href=\"account.php?page=$page&totpages=$totpages&scompany=$company_match&type=$sval&scompanyfl=$where1&company_oper=$oper\">[Next]</a> ";

    $last = " <a href=\"account.php?page=$totpages&totpages=$totpages&scompany=$company_match&type=$sval&scompanyfl=$where1&company_oper=$oper\">[Last Page]</a> ";
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
