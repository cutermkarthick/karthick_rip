<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = Sep 15,2010                  =
// Filename: fair.php                          =
// Copyright of Badari Mandyam, FluentSoft     =
// Revision: v1.0 OMS                          =
// Displays list of wo fair entries            =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
header ( "Location: login.php" );

}
$userid = $_SESSION['user'];
$_SESSION['pagename'] = 'fair';
$page = "QA: Fair";
//////session_register('pagename');
$dept = $_SESSION['department'];
if($dept == 'Sales')
{
$table_size = "60%";
}
else
{
$table_size = "100%";
}

// First include the class definition
include_once('classes/userClass.php');
include_once('classes/fairClass.php');
include_once('classes/displayClass.php');


$newfair = new fair;
$newdisplay = new display;

$cond0 = "fa.crn like '%'";
$cond1 = "(to_days(fa.wo_date)-to_days('1582-01-01') >= 0 ||
fa.wo_date = '0000-00-00' ||
fa.wo_date is NULL) and
(to_days(fa.wo_date)-to_days('2050-12-31') <= 0 ||
fa.wo_date = '0000-00-00' ||
fa.wo_date is NULL)";
$cond2 = "(fa.status like '%' || fa.status is NULL)";
$cond3 = "fa.type like '%'";

$cond = $cond0 . ' and ' . $cond1 . ' and ' . $cond2 . ' and ' . $cond3;

if ( isset ( $_REQUEST['crn'] ) )
{
$finalcrn_match = $_REQUEST['crn'];
$finalcrn = "'" . $_REQUEST['crn'] . "%" . "'";

$cond0 = "crn like ". $finalcrn;

}
else
{
$finalcrn_match='';
}

if ( isset ( $_REQUEST['wdate1'] ) || isset ( $_REQUEST['wdate2'] ) )
{
if ( isset ( $_REQUEST['wdate1']) &&  $_REQUEST['wdate1'] != '' )
{
$wdate1 = $_REQUEST['wdate1'];
$cond11 = "(to_days(fa.wo_date) " . ">= to_days('" . $wdate1 . "'))";

}
else
{
$cond11 = "((to_days(fa.wo_date)-to_days('1582-01-01') >= 0 || fa.wo_date is NULL || fa.wo_date = '0000-00-00'))";
}

if ( isset ( $_REQUEST['wdate2'] )  &&  $_REQUEST['wdate2'] != '')
{
$wdate2 = $_REQUEST['wdate2'];
$cond12 = "(to_days(fa.wo_date) " . "<= to_days('" . $wdate2 . "'))";
}
else
{
$cond12 = "((to_days(fa.wo_date)-to_days('2050-12-31') <= 0 || fa.wo_date is NULL || fa.wo_date = '0000-00-00'))";
}
$cond1 = $cond11 . ' and ' . $cond12;

}
else
{
$wdate1 = '';
$wdate2 = '';
}

if ( isset ( $_REQUEST['final_type'] ) )
{       $final_typematch=$_REQUEST['final_type'];
$type_match = "'" . $_REQUEST['final_type'] . "%" . "'";
$cond3 = "fa.type like ". $type_match;

}
else
{
$final_typematch='';
}

if ( isset ( $_REQUEST['status_val'] ) )
{
//echo '----'.$_REQUEST['status_val'];
$sval = $_REQUEST['status_val'];
if ($sval == 'All')
{
$cond2 = "(fa.status like " . "'%' || fa.status is NULL)";
}
else if ($sval == 'NC')
{
$cond2 = "fa.status = '" . $sval . "'";
}
else if ($sval == 'Approved')
{
$cond2 = "fa.status = '" . $sval . "'" ;
}
else if ($sval == 'Delta Fair')
{
$cond2 = "fa.status = '" . $sval . "'";
}
else
{
$cond2 = "fa.status = '" . $sval . "'";
}
}
else
{
$sval = 'All';
$cond2 = "(fa.status like " . "'%' || fa.status is NULL)";
}

$cond = $cond0 . ' and ' . $cond1 . ' and ' . $cond2 . ' and ' . $cond3;
$userrole = $_SESSION['userrole'];
$dept = $_SESSION['department'];
// how many rows to show per page
$rowsPerPage = 20;
//echo $cond;
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
<script language="javascript" src="scripts/fair.js"></script>

<html>
<head>
<title>FAIR</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">
<form action='fair.php' method='GET' enctype='multipart/form-data'>
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
<table width=100% border=0 cellpadding=6 cellspacing=0>
<tr>
<td>

<table width="<?php echo $table_size?>" border=0 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1">
<tr>
<td bgcolor="#F5F6F5" colspan="13"><span class="heading"><b><center>Search Criteria</center></b></td>
<td bgcolor="#FFFFFF" rowspan=3 align="center"><span class="tabletext">
<button class="stdbtn btn_blue" style="background-color:#2d3e50" onClick="javascript: return searchsort_fields()" >Get</button>
	<!-- <input type= "image" name="Get" src="images/bu-get.gif" value="Get" onclick="javascript: return searchsort_fields()"></td> -->
</tr>
<tr>
<td bgcolor="#FFFFFF"><span class="heading"><b>PRN:</b></td>
<td bgcolor="#FFFFFF"><span class="heading"><input type="text" size=8% name="crn" value="<?echo $finalcrn_match ?>"></td>

<td bgcolor="#FFFFFF"><span class="labeltext"><b>WO Date:</b></td>
<td colspan=10 bgcolor="#FFFFFF"><span class="heading"><b>From:&nbsp;</b><input type="text" name="wdate1" size=10 value="<?php echo $_REQUEST['wdate1'] ?>"
onkeypress="javascript: return checkenter(event)">
<img src="images/bu-getdateicon.gif" alt="Get Date" onclick='GetDate("wdate1")'>
<span class="labeltext"><b>&nbsp;&nbsp;To:&nbsp;</b>
<input type="text" name="wdate2" size=10 value="<?php echo $_REQUEST['wdate2'] ?>"
onkeypress="javascript: return checkenter(event)">
<img src="images/bu-getdateicon.gif" alt="Get Date" onclick='GetDate("wdate2")'>
</td>
<tr>
<td bgcolor="#FFFFFF"><span class="heading"><b>Type:</b></td>
<td bgcolor="#FFFFFF"><input type="text" name="final_type" size=12 value="<?php echo $final_typematch ?>">
</td>
<td  colspan=11 align="left" bgcolor="#FFFFFF"><span class="labeltext"><b>Status:</b>
<span class="tabletext"><select id="status_val" name="status_val" size="1" width="100">
<?php
if ($sval == 'NC')
{
?>
<option selected="NC">NC
<option value="APPROVED">APPROVED</option>
<option value="CUST APPROVED">CUST APPROVED</option>
<option value="RE FAIR">RE FAIR</option>
<option value="DELTA FAIR">DELTA FAIR</option>
<option value="All">All</option>
<?php
}
else if ($sval == 'APPROVED')
{
?>
<option selected="APPROVED">APPROVED
<option value="CUST APPROVED">CUST APPROVED</option>
<option value="NC">NC</option>
<option value="RE FAIR">RE FAIR</option>
<option value="DELTA FAIR">DELTA FAIR</option>
<option value="All">All</option>
<?php
}
else if ($sval == 'RE FAIR')
{
?>
<option selected="RE FAIR">RE FAIR
<option value="DELTA FAIR">DELTA FAIR</option>
<option value="NC">NC</option>
<option value="APPROVED">APPROVED</option>
<option value="CUST APPROVED">CUST APPROVED</option>
<option value="All">All</option>

<?php
}
else if ($sval == 'DELTA FAIR')
{
?>
<option selected="DELTA FAIR">DELTA FAIR
<option value="RE FAIR">RE FAIR</option>
<option value="NC">NC</option>
<option value="APPROVED">APPROVED</option>
<option value="CUST APPROVED">CUST APPROVED</option>
<option value="All">All</option>

<?php
}
else if ($sval == 'All')
{
?>
<option selected="All">All
<option value="NC">NC</option>
<option value="APPROVED">APPROVED</option>
<option value="CUST APPROVED">CUST APPROVED</option>
<option value="RE FAIR">RE FAIR</option>
<option value="DELTA FAIR">DELTA FAIR</option>
<?php
}
else if ($sval == 'CUST APPROVED')
{
?>
<option selected="CUST APPROVED">CUST APPROVED
<option value="NC">NC</option>
<option value="APPROVED">APPROVED</option>
<option value="RE FAIR">RE FAIR</option>
<option value="DELTA FAIR">DELTA FAIR</option>
<option value="All">All</option>
<?php
}
?>
</select>
</td>
</td>
</tr>
</table>
</td></tr>
<tr><td>
<table width=100% border=0>
<div class="contenttitle radiusbottom0">

<h2><span>FAIR Entries</span></h2>
</tr>
</table>
<table width="<?php echo $table_size?>" border=0 cellpadding=3 cellspacing=1 class="stdtable">
<thead>  
<tr>
<th class="head0"><span class="tabletext"><b>Seq#</b></th>
<th class="head1"><span class="tabletext"><b>PRN</b></th>
<th class="head0"><span class="tabletext"><b>WO</b></th>
<th class="head1"><span class="tabletext"><b>Cofc</b></th>
<th class="head0"><span class="tabletext"><b>WO Date</b></th>
<th class="head1"><span class="tabletext"><b>Type</b></th>
<th class="head0"><span class="tabletext"><b>NC</b></th>
<th class="head1"><span class="tabletext"><b>Status</b></th>
</tr>
</thead>
<?php

$result = $newfair->getFairs($cond,$offset,$rowsPerPage);
while ($myrow = mysql_fetch_row($result))
{
if($myrow[4] != '' && $myrow[4] != '0000-00-00')
{
$datearr = split('-', $myrow[4]);
$d=$datearr[2];
$m=$datearr[1];
$y=$datearr[0];
$x=mktime(0,0,0,$m,$d,$y);
$wodate=date("M j, Y",$x);
}
else
{
$wodate = '';
}


if($dept !='PPC1' && $dept !='PPC2' && $dept !='PPC3' && $dept !='PPC4'&& $dept !='PPC'&& $dept !='PPC5')
{
printf('<tr bgcolor="#FFFFFF"><td bgcolor="#FFFFFF" align="center"><span class="tabletext">
<a href="fairUpdate.php?recnum=%s">%s</a></td>
<td align="center"><span class="tabletext">%s</td>
<td align="center"><span class="tabletext">%05s</td>
<td align="center"><span class="tabletext">%s</td>
<td align="center"><span class="tabletext">%s</td>
<td align="center"><span class="tabletext">%s</td>
<td align="center"><span class="tabletext">%s</td>
<td align="center"><span class="tabletext">%s</td>
',
$myrow[0],
$myrow[0],
$myrow[1],
$myrow[2],
$myrow[3],
$wodate,
$myrow[5],
$myrow[6],
$myrow[7]);
printf('</td></tr>');
}else
{

printf('<tr bgcolor="#FFFFFF"><td bgcolor="#FFFFFF" align="center"><span class="tabletext">%s</td>
<td align="center"><span class="tabletext">%s</td>
<td align="center"><span class="tabletext">%05s</td>
<td align="center"><span class="tabletext">%s</td>
<td align="center"><span class="tabletext">%s</td>
<td align="center"><span class="tabletext">%s</td>
<td align="center"><span class="tabletext">%s</td>
<td align="center"><span class="tabletext">%s</td>
',
$myrow[0],
$myrow[1],
$myrow[2],
$myrow[3],
$wodate,
$myrow[5],
$myrow[6],
$myrow[7]);
printf('</td></tr>');
}
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
$numrows = $newfair->getFairscount($cond);
// how many pages we have when using paging?
//$numrows=406;
//echo $numrows."----";

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
$prev = " <a href=\"fair.php?page=$page&totpages=$totpages&crn=$finalcrn_match&final_type=$final_typematch&status_val=$sval&wdate1=$wdate1&wdate2=$wdate2\">[Prev]</a> ";

$first = " <a href=\"fair.php?page=1&totpages=$totpages&crn=$finalcrn_match&final_type=$final_typematch&status_val=$sval&wdate1=$wdate1&wdate2=$wdate2\">[First Page]</a> ";
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
$next = " <a href=\"fair.php?page=$page&totpages=$totpages&crn=$finalcrn_match&final_type=$final_typematch&status_val=$sval&wdate1=$wdate1&wdate2=$wdate2\">[Next]</a> ";

$last = " <a href=\"fair.php?page=$totpages&totpages=$totpages&crn=$finalcrn_match&final_type=$final_typematch&status_val=$sval&wdate1=$wdate1&wdate2=$wdate2\">[Last Page]</a> ";
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

