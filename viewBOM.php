<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = May 24,2005                  =
// Filename: viewbom.php                           =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OMS                          =
// Displays BOMs                               =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];
$_SESSION['pagename'] = 'viewbom';
//////session_register('pagename');
$userrole = $_SESSION['userrole'];

$cond = "b.bomnum like '%'";


if ( isset ( $_REQUEST['final_bom'] ) )
{
     $finalbom_match = $_REQUEST['final_bom'];
     if ( isset ( $_REQUEST['bom_oper'] ) ) {
          $oper2 = $_REQUEST['bom_oper'];
     }
     else {
         $oper2 = 'like';
     }
     if ($oper2 == 'like') {
         $final_bom = "'" . $_REQUEST['final_bom'] . "%" . "'";
     }
     else {
         $final_bom = "'" . $_REQUEST['final_bom'] . "'";
     }

     $cond = "b.bomnum " . $oper2 . " " . $final_bom;

}
else {
     $finalbom_match = '';
}

$sort11='';
if ( isset ( $_REQUEST['sortfld1'] ) )
{
    $sort1 = $_REQUEST['sortfld1'];
    if ($sort1=='BOM')
         $sort11= "b.bomnum" ;
}

include_once('classes/loginClass.php');

$newlogin = new userlogin;
$newlogin->dbconnect();

// For paging - Added on Dec 6,04

// how many rows to show per page
$rowsPerPage =10;

// by default we show first page
$pageNum = 1;

// if $_GET['page'] defined, use it as page number
if (isset($_REQUEST['page']))
{
	//echo "i am set";
    $pageNum = $_REQUEST['page'];
}
if (isset($_REQUEST['totpages']))
{
    $totpages = $_REQUEST['totpages'];
}

// counting the offset
$offset = ($pageNum - 1) * $rowsPerPage;

// First include the class definition
include('classes/userClass.php');
include('classes/bomClass.php');
include('classes/displayClass.php');
$newBOM = new bom;
$newdisplink = new display;
?>

<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/bom.js"></script>

<html>
<head>
<title>BOM</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">
	<form action='bom.php' method='post' enctype='multipart/form-data'>
<?php
include('header.html');
?>
<table width=100% cellspacing="0" cellpadding="6" border="0">
<tr>
<td>
<table width=100% border=0 cellspacing="0" cellpadding="0">
<tr>
<td colspan=2><span class="welcome"><b>Welcome <?php echo $userid?></b></td>
<td align="right">&nbsp;<a href="exit.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image16','','images/logout_mo.gif',1)"><img name="Image16" border="0" src="images/logout.gif"></a></td>
 </tr>
</table>
<table width=100% border=0 cellpadding=0 cellspacing=0  >
<tr><td></td></tr>
<tr>
<td>
<?php $newdisplink->dispLinks(''); ?>
<table width=100% border=0 cellpadding=0 cellspacing=0  >
<tr bgcolor="DEDFDE">
<td width="6"><img src="images/spacer.gif " width="6"></td>
<td bgcolor="#FFFFFF">
<table width=100% border=0 cellpadding=6 cellspacing=0  >
<tr><td><span class="heading"><i>Please click on the BOM link for details or to Edit/Delete</i></td></tr>
<tr>
	<td>
<table width=100% border=0 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF" >
<tr>
<td bgcolor="#F5F6F5" colspan="3"><span class="heading"><b><center>Search Criteria</center></b></td>
<td bgcolor="#FFFFFF" rowspan=2 align="center"><span class="tabletext"><input type= "image" name="Get" src="images/bu-get.gif" value="Get" onclick="javascript: return searchsort_fields()"></td>
</tr>
<tr>
<td colspan=3 bgcolor="#FFFFFF"><span class="labeltext"><b>BOM #</b>
<span class="tabletext"><select name="bom_oper" size="1" width="20">
<?php
   if ( isset ( $_REQUEST['bom_oper'] ) ){
          $check2 = $_REQUEST['bom_oper'];

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
</select>
<input type="text" name="final_bom" size=10 value="<?php echo $finalbom_match ?>" onkeypress="javascript: return checkenter(event)">
</td>
</tr>
</table>
</td></tr>
<tr><td><span class="pageheading"><b>List of BOMs</b></td></tr>
<tr><td>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
    <tr>
        <td bgcolor="#EEEFEE"><span class="heading"><b>BOM #</b></td>
        <td bgcolor="#EEEFEE"><span class="heading"><b>BOM Issue</b></td>
        <td bgcolor="#EEEFEE"><span class="heading"><b>PRN</b></td>
        <td bgcolor="#EEEFEE"><span class="heading"><b>Assy Part #</b></td>
    </tr>

<?php

            $result = $newBOM->getBOM_summary($cond,$offset,$rowsPerPage);
        while ($myrow = mysql_fetch_row($result)) {



        printf('<td bgcolor="#FFFFFF"><span class="tabletext"><a href="viewbomDetails.php?bomrecnum=%s">%s</a></td>
                <td bgcolor="#FFFFFF"><span class="tabletext">%s</td>
                <td bgcolor="#FFFFFF"><span class="tabletext">%s</td>
                <td bgcolor="#FFFFFF"><span class="tabletext">%s</td>',
		  $myrow[0],$myrow[1],$myrow[2], $myrow[3],$myrow[4]);
              printf('</td></tr>');
        }
?>
</table>
</td></tr>
</table>
</td>
<td width="6"><img src="images/spacer.gif " width="6"></td>
</tr>
<tr bgcolor="DEDFDE">
<td width="6"><img src="images/box-left-bottom.gif"></td>
<td><img src="images/spacer.gif " height="6"></td>
<td width="6"><img src="images/box-right-bottom.gif"></td>
</tr>
</table>


<table border=0 cellpadding=0 cellspacing=0 width=100%>
<tr>
	<td align=left>
  <?php
//  Added on Dec 6,04 for paging

$numrows = $newBOM->getBOMcount($cond,$offset,$rowsPerPage);
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
    $prev = " <a href=\"bom.php?page=$page&totpages=$totpages&bom=$bom_match&bomcritval=$where1&bomoperval=$oper\">[Prev]</a> ";

    $first = " <a href=\"bom.php?page=1&totpages=$totpages&bom=$bom_match&bomcritval=$where1&bomoperval=$oper\">[First Page]</a> ";
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
    $next = " <a href=\"bom.php?page=$page&totpages=$totpages&bom=$bom_match&bomcritval=$where1&bomoperval=$oper\">[Next]</a> ";

    $last = " <a href=\"bom.php?page=$totpages&totpages=$totpages&bom=$bom_match&bomcritval=$where1&bomoperval=$oper\">[Last Page]</a> ";
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
// End additions on Dec 6,04

?>
</td>
</tr></table>
</form>
</body>
</html>
