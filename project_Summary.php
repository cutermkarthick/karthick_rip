<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = April 06, 2010               =
// Filename: project_Summary.php               =
// Copyright of Fluent Technologies            =
// Revision: v1.0 Project_management           =
// Displays list of Projects.                  =
//==============================================

session_start();
header("Cache-control:private");

if ( !isset ( $_SESSION['user'] ) )
{
header ( "Location: login.php" );

}
$userid = $_SESSION['user'];
$_SESSION['pagename'] = 'project_Summary';
// $page="CRM: Project";
$page="ELM: Project";
////session_register('pagename');

// First include the class definition
include_once('classes/userClass.php');
include_once('classes/projectClass.php');

$newproject = new project;


$cond0 = " project like '%'";
$cond1 = " manager like '%'";
$cond2=  "(to_days(start_date)-to_days('1582-01-01') > 0 ||
       start_date = '0000-00-00' ||
       start_date = 'NULL' ) and
(to_days(start_date)-to_days('2050-12-31') < 0 ||
        start_date = '0000-00-00' ||
        start_date = 'NULL')";

$cond3=  "(to_days(closed_date)-to_days('1582-01-01') > 0 ||
       closed_date = '0000-00-00' ||
       closed_date = 'NULL' ) and
(to_days(closed_date)-to_days('2050-12-31') < 0 ||
        closed_date = '0000-00-00' ||
        closed_date = 'NULL')";


$cond = $cond0 . ' and ' . $cond1. ' and ' . $cond2. ' and ' . $cond3;




if ( isset ( $_REQUEST['project'] ) )
{
$finalproject = $_REQUEST['project'];       
$project = "'" . $_REQUEST['project'] . "%" . "'";    
$cond0 = "project like " . $project;

}
else {
$finalproject = '';
}

if ( isset ( $_REQUEST['manager'] ) )
{
$finalmanager = $_REQUEST['manager'];       
$manager = "'" . $_REQUEST['manager'] . "%" . "'";    
$cond1 = "manager like " . $manager;
}
else {
$finalmanager = '';
}

if ( isset ( $_REQUEST['stdate1'] ) || isset ( $_REQUEST['stdate2'] ) )
{
$stdate1_match = $_REQUEST['stdate1'];
$stdate2_match = $_REQUEST['stdate2'];
if ( isset ( $_REQUEST['stdate1']) &&  $_REQUEST['stdate1'] != '' )
{
$date1 = $_REQUEST['stdate1'];
$cond21 = "to_days(start_date) " . ">= to_days('" . $date1 . "')";
}
else
{
$cond21 = "(to_days(start_date)-to_days('1582-01-01') > 0 || start_date = 'NULL' || start_date = '0000-00-00')";
}

if ( isset ( $_REQUEST['stdate2'] )  &&  $_REQUEST['stdate2'] != '')
{
$date2 = $_REQUEST['stdate2'];
$cond22 = "to_days(start_date) " . "<= to_days('" . $date2 . "')";
}
else
{
$cond22 = "(to_days(start_date)-to_days('2050-12-31') < 0 || start_date = 'NULL' || start_date= '0000-00-00')";
}
$cond2 = $cond21 . ' and ' . $cond22;

}
else
{
$stdate1_match = '';
$stdate2_match = '';
}

if ( isset ( $_REQUEST['cldate1'] ) || isset ( $_REQUEST['cldate2'] ) )
{
$cldate1_match = $_REQUEST['cldate1'];
$cldate2_match = $_REQUEST['cldate2'];
if ( isset ( $_REQUEST['cldate1']) &&  $_REQUEST['cldate1'] != '' )
{
$date1 = $_REQUEST['cldate1'];
$cond31 = "to_days(closed_date) " . ">= to_days('" . $date1 . "')";
}
else
{
$cond31 = "(to_days(closed_date)-to_days('1582-01-01') > 0 || closed_date = 'NULL' || closed_date = '0000-00-00')";
}

if ( isset ( $_REQUEST['cldate2'] )  &&  $_REQUEST['cldate2'] != '')
{
$date2 = $_REQUEST['cldate2'];
$cond32 = "to_days(closed_date) " . "<= to_days('" . $date2 . "')";
}
else
{
$cond32 = "(to_days(closed_date)-to_days('2050-12-31') < 0 || closed_date = 'NULL' || closed_date= '0000-00-00')";
}
$cond3 = $cond31 . ' and ' . $cond32;

}
else
{
$cldate1_match = '';
$cldate2_match = '';
}


$cond = $cond0 . ' and ' . $cond1. ' and ' . $cond2. ' and ' . $cond3;


$userrole = $_SESSION['role'];
// echo $cond;
// how many rows to show per page
$rowsPerPage = 10000;

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
<script language="javascript" src="scripts/project.js"></script>

<html>
<head>
<title>Project Summary</title>
</head>
<body leftmargin="0" topmargin="0" marginwidth="0">
<form action='project_Summary.php' method='GET' enctype='multipart/form-data'>
<?php
include('header.html');
?>
<!-- <table width=100% cellspacing="0" cellpadding="6" border="0">
<tr>
<td>
<table width=100% border=0 cellspacing="0" cellpadding="0">
<tr>
<td colspan=2><span class="welcome"><b>Welcome <?php echo $userid?></b></td> -->
<!-- <a href="exit.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image16','','images/logout_mo.gif',1)"><img name="Image16" border="0" src="images/logout.gif"></a></td>
</tr>
</table> -->

<!-- 
<tr>
<td>
</table>
<tr>
<td>
<table width=100% border=0 cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
<tr><td>
<table width=80% border=0 align='center'>
<tr bgcolor='#FFFFFF'>


</tr>
</table>
</table>
</td></tr>



<table width=80% align='center' border=1 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF"> -->
<table width=100% border=1 cellpadding=6 cellspacing=2  >
<tr><td><span class="heading"><i>Please click on the Project ID link to Edit or Delete</i></td></tr>

<tr>
<table width=100% border=0 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1">
<td align="center" bgcolor="#F5F6F5" colspan=6><span class="pheading"><b>SEARCH CRITERIA</b></td></tr>
<tr bgcolor='#FFFFFF'>
<td bgcolor="#FFFFFF"><span class="heading"><b>Project</b>
<input type="text" size=10% name="project" value="<?echo $finalproject?>"></td>
<td bgcolor="#FFFFFF"><span class="heading"><b>Owner</b>
<input type="text" size=15% name="manager" value="<?echo $finalmanager ?>"></td>
</td>
<td bgcolor="#FFFFFF" rowspan=2 colspan=2 align="center">
<button class="stdbtn btn_blue" style="background-color:#2d3e50" onclick="javascript: return searchsort_fields()">Get</button></td>

</tr>

<tr>
<td bgcolor="#FFFFFF"><span class="labeltext"><b>St Date:From &nbsp</b>
<input type="text" name="stdate1" id="stdate1" size=10 value="<?php echo $stdate1_match ?>"
onkeypress="javascript: return checkenter(event)">
<img src="images/bu-getdateicon.gif" alt="Get Date" onclick='GetDate("stdate1")'>
<span class="labeltext"><b>&nbsp;&nbsp;To</b>
<input type="text" name="stdate2" id="stdate2"  size=10 value="<?php echo $stdate2_match ?>"
onkeypress="javascript: return checkenter(event)">
<img src="images/bu-getdateicon.gif" alt="Get Date" onclick='GetDate("stdate2")'>
</td>
<td bgcolor="#FFFFFF"><span class="labeltext"><b>Cl Date:From &nbsp</b>
<input type="text" name="cldate1" id="cldate1" size=10 value="<?php echo $cldate1_match ?>"
onkeypress="javascript: return checkenter(event)">
<img src="images/bu-getdateicon.gif" alt="Get Date" onclick='GetDate("cldate1")'>
<span class="labeltext"><b>&nbsp;&nbsp;To</b>
<input type="text" name="cldate2" id="cldate2"  size=10 value="<?php echo $cldate2_match ?>"
onkeypress="javascript: return checkenter(event)">
<img src="images/bu-getdateicon.gif" alt="Get Date" onclick='GetDate("cldate2")'>
</td>
</tr>
<tr></tr>
<tr></tr></table>


<table width=100% border=0>
<div class="contenttitle radiusbottom0">
<h2><span>List of Projects
  <input type="button" class="stdbtn btn_blue" style="float:right;padding:2px;margin-right:5px" onClick="location.href='project_Entry.php'" value="New Project" >

</h2>
</span>
</td>
</tr>

</td></tr>
</table>

<!-- <tr bgcolor='#B0C4DE'>
<td align='center' colspan=3><span class="pageheading"><b>List of Projects</b></td>  

<td align="right" width="15%" ><a href ="project_Entry.php" class="btn-primary">New Project</a>
</td>
<td align="center"><span class="button">
 <a href ="project_Entry.php"><input type="button" name="button"  value="New Project"></a></td>




</tr>
</table> 
 -->
<table width=80% align='center' border=1 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF" class="stdtable">
<thead><tr>
<td width="4%" class="head0"><span class="tabletext"><b>Project</b></td>
<td width="4%" class="head1"><span class="tabletext"><b>Customer</b></td>
<td width="4%" class="head0"><span class="tabletext"><b>Owner</b></td>
<td width="6%" class="head1"><span class="tabletext"><b>Category</b></td>      
<td width="5%" class="head0"><span class="tabletext"><b>Start Date</b></td>
<td width="5%" class="head1"><span class="tabletext"><b>Closed Date</b></td>         
</tr>
</thead>
<?php
$result = $newproject->getprojectSummary($cond,$offset,$rowsPerPage);

while ($myrow = mysql_fetch_row($result)) {
   if($myrow[3] != '' && $myrow[3] != '0000-00-00')
   {
     $datearr = split('-', $myrow[3]);
     $d=$datearr[2];
     $m=$datearr[1];
     $y=$datearr[0];
     $x=mktime(0,0,0,$m,$d,$y);
     $start_date=date("M j, Y",$x);
   }
   else
   {
     $start_date = '';
   }
if($myrow[4] != '' && $myrow[4] != '0000-00-00')
   {
     $datearr = split('-', $myrow[4]);
     $d=$datearr[2];
     $m=$datearr[1];
     $y=$datearr[0];
     $x=mktime(0,0,0,$m,$d,$y);
     $closed_date=date("M j, Y",$x);
   }
   else
   {
     $closed_date = '';

   }

     echo '<tr bgcolor="#FFFFFF"><td><span class="tabletext">';
echo "<a href=\"project_details.php?recnum=$myrow[0]\">$myrow[1]</td>";

echo "<td><span class=\"tabletext\">$myrow[10]</td>";
   echo "<td><span class=\"tabletext\">$myrow[5]</td>";
   echo "<td><span class=\"tabletext\">$myrow[7]</td>";
   
echo "<td><span class=\"tabletext\">$start_date</td>";
echo "<td><span class=\"tabletext\">$closed_date</td>";			
   echo '</td></tr>';
}
?>
</table>
<table width=100%  border=0 cellpadding=4 cellspacing=1 bgcolor="#FFFFFF" >   
<!-- <tr bgcolor='#FFFFFF'><td align='left'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; -->
<?php
$numrows = $newproject->getprojectSummaryCount($cond,$offset,$rowsPerPage);;
// how many pages we have when using paging?
$maxPage = ceil($numrows/$rowsPerPage);
//echo "$maxPage</br>";
if (!isset($_REQUEST['page']))
{
//echo "page is set";
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
$prev = " <a href=\"project_Summary.php?page=$page&totpages=$totpages&project=$finalproject
&manager=$finalmanager&stdate1=$stdate1_match&stdate2=$stdate2_match&cldate1=$cldate1_match&
cldate2=$cldate2_match\">[Prev]</a> ";


$first = " <a href=\"project_Summary.php?page=1&totpages=$totpages&project=$finalproject
&manager=$finalmanager&stdate1=$stdate1_match&stdate2=$stdate2_match&cldate1=$cldate1_match&
cldate2=$cldate2_match\">[First Page]</a> ";
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
$next = " <a href=\"project_Summary.php?page=$page&totpages=$totpages&project=$finalproject
&manager=$finalmanager&stdate1=$stdate1_match&stdate2=$stdate2_match&cldate1=$cldate1_match&
cldate2=$cldate2_match\">[Next]</a> ";

$last = " <a href=\"project_Summary.php?page=$totpages&totpages=$totpages&project=$finalproject
&manager=$finalmanager&stdate1=$stdate1_match&stdate2=$stdate2_match&cldate1=$cldate1_match&
cldate2=$cldate2_match\">[Last Page]</a> ";
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
{
echo "<span class=\"labeltext\"><align=\"center\">No matching records found";
}
// End additions on Dec 29,04
?>
</td>
</tr>
</table>

</td>
</tr>
</table>
</FORM>
</body>
</html>
