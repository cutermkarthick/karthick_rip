<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = June 20, 2004                =
// Filename: worderSummary.php                 =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OMS                          =
// Displays WO Summary for SU                  =
// Modifications History                       =
// Dec 6,04 - Paging Enhancements              =
// Dec20,04 - Wo2Po link enhancements          =
//            Coded By Jerry George            =
// Mar 27,05 - Additional search paramaters    =
//             By Badari Mandyam               =
//==============================================
//session_save_path ("/home/virtual/dciapp.com/tmp");
@session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];
$_SESSION['pagename'] = 'salesSummary';
//////session_register('pagename');

$cond0 = "w.actual_ship_date like %";

$cond1 = "c.name like '%'";
$cond2 = "w.wonum like '%'";
$cond3 = "(to_days(w.sch_due_date)-to_days('1582-01-01') > 0 ||
                    w.sch_due_date = '0000-00-00' ||
                    w.sch_due_date = 'NULL' ) and
           (to_days(w.sch_due_date)-to_days('2050-12-31') < 0 ||
                    w.sch_due_date = '0000-00-00' ||
                    w.sch_due_date = 'NULL')";
$cond4 = "w.wotype like '%'";
$cond = $cond0 . ' and ' . $cond1 . ' and ' . $cond2 . ' and ' . $cond3 . ' and ' . $cond4;

$worec='';
$oper1='like';
$oper2='like';
$sort1='wo';
$sort2='company';
$sess=session_id();
if ( isset ( $_REQUEST['status_val'] ) )
{

     $sval = $_REQUEST['status_val'];
     if ($sval == 'All')
     {
         $cond0 = "w.condition like " . "'%'";
     }
     else if ($sval == 'Open')
     {
         $cond0 = "(w.condition = '" . $sval . "' && (w.actual_ship_date is NULL || w.actual_ship_date = '0000-00-00' || w.actual_ship_date = ''))" ;
     }
     else if ($sval == 'Closed')
     {
         $cond0 = "(w.condition = '" . $sval . "' || (w.actual_ship_date is not NULL && w.actual_ship_date != '0000-00-00' && w.actual_ship_date != ''))" ;
     }
     else
     {
         $cond0 = "w.condition = '" . $sval . "'";
     }
}
else
{
     $sval = 'Open';
         $cond0 = "(w.condition = '" . $sval . "' && (w.actual_ship_date is NULL || w.actual_ship_date = '0000-00-00' || w.actual_ship_date = ''))" ;
}

if ( isset ( $_REQUEST['scomp'] ) )
{
     $company_match = $_REQUEST['scomp'];
     if ( isset ( $_REQUEST['company_oper'] ) ) {
          $oper1 = $_REQUEST['company_oper'];
     }
     else {
         $oper1 = 'like';
     }
     if ($oper1 == 'like') {
         $scomp = "'" . $_REQUEST['scomp'] . "%" . "'";
     }
     else {
         $scomp = "'" . $_REQUEST['scomp'] . "'";
     }

     $cond1 = "c.name " . $oper1 . " " . $scomp;

}
else {
     $company_match = '';
}

if ( isset ( $_REQUEST['swonum'] ) )
{
     $wonum_match = $_REQUEST['swonum'];
     if ( isset ( $_REQUEST['wonum_oper'] ) ) {
          $oper2 = $_REQUEST['wonum_oper'];
     }
     else {
         $oper2 = 'like';
     }
     if ($oper2 == 'like') {
         $swonum = "'" . $_REQUEST['swonum'] . "%" . "'";
     }
     else {
         $swonum = "'" . $_REQUEST['swonum'] . "'";
     }

     $cond2 = "w.wonum " . $oper2 . " " . $swonum;

}
else {
     $wonum_match = '';
}
if ( isset ( $_REQUEST['stype'] ) )
{
     $type_match = $_REQUEST['stype'];
     $cond4 = "w.wotype like '" . $type_match . "%'";

}
else {
     $type_match = '';
}
if ( isset ( $_REQUEST['sdate1'] ) || isset ( $_REQUEST['sdate2'] ) )
{
     $date1_match = $_REQUEST['sdate1'];
     $date2_match = $_REQUEST['sdate2'];
     if ( isset ( $_REQUEST['sdate1']) &&  $_REQUEST['sdate1'] != '' )
     {
          $date1 = $_REQUEST['sdate1'];
          $cond31 = "to_days(w.sch_due_date) " . "> to_days('" . $date1 . "')";
     }
     else
     {
          $cond31 = "(to_days(w.sch_due_date)-to_days('1582-01-01') > 0 || w.sch_due_date = 'NULL' || w.sch_due_date = '0000-00-00')";
     }

     if ( isset ( $_REQUEST['sdate2'] )  &&  $_REQUEST['sdate2'] != '')
     {
          $date2 = $_REQUEST['sdate2'];
          $cond32 = "to_days(w.sch_due_date) " . "< to_days('" . $date2 . "')";
     }
     else
     {
          $cond32 = "(to_days(w.sch_due_date)-to_days('2050-12-31') < 0 || w.sch_due_date = 'NULL' || w.sch_due_date = '0000-00-00')";
     }
     $cond3 = $cond31 . ' and ' . $cond32;

}
else
{
     $date1_match = '';
     $date2_match = '';
}
if ( isset ( $_REQUEST['sortfld1'] ) ) {
    $sort1 = $_REQUEST['sortfld1'];
}
if ( isset ( $_REQUEST['sortfld2'] ) ) {
    $sort2 = $_REQUEST['sortfld2'];
}

$cond = $cond0 . ' and ' . $cond1 . ' and ' . $cond2 . ' and ' . $cond3 . ' and ' . $cond4;

// First include the class definition

include_once('classes/userClass.php');
include_once('classes/loginClass.php');
include('classes/workorderClass1.php');
include('classes/displayClass.php');

$newlogin = new userlogin;
$newlogin->dbconnect();
$username = $_SESSION['user'];
$newworkOrder = new workOrder;
$newdisp = new display;


// For paging - Added on Dec 6,04

// how many rows to show per page
$rowsPerPage =15;

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

// End additions on Dec 6,04
?>

<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/wo.js"></script>


<html>
<head>
<title>Sales </title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">

<?php
include('header.html');
?>
<form action='salesSummary.php' method='post' enctype='multipart/form-data'>

<table width=100% cellspacing="0" cellpadding="7" border="0">
<tr>
<td>
<table width=100% border=0 cellspacing="0" cellpadding="0">
<tr>
<td><span class="welcome"><b>Welcome <?php echo $userid?></b></td>



<td align="right"><a href="chPassword.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image15','','images/chpwd_mo.gif',1)"><img name="Image15" border="0" src="images/chpwd.gif"></a>
<a href="exit.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image16','','images/logout_mo.gif',1)"><img name="Image16" border="0" src="images/logout.gif"></a></td>
</tr>
</table>
<table width=100% border=0 cellpadding=0 cellspacing=0  >
<tr><td>
</td></tr>
<tr>
<td>


<?php
      $newdisp->dispLinks('');
?>
<table width=100% border=0 cellpadding=0 cellspacing=0  >
<tr bgcolor="DFDFDE">
<td width="6"><img src="images/spacer.gif " width="6"></td>
<td bgcolor="#FFFFFF">
<table width=100% border=0 cellpadding=6 cellspacing=0  >
<tr><td><span class="heading"><i>Please click on the Sales Summery link for details and to Edit/Delete</i></td></tr>
<tr><td><a href="wodownloadxls.php">Download in Excel Format</a></td></tr></tr>
<tr><td>
<table width=100% border=0 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF" >
<tr>
<td bgcolor="#F5F6F5" colspan="7"><span class="heading"><b><center>Search & Sort Criteria</center></b></td>
<td bgcolor="#FFFFFF" rowspan=3 colspan=4 align="center"><span class="tabletext">
<input type="image" name="Submit" src="images/bu-get.gif" value="Get"
            onclick="javascript: return searchsort_fields()">

<input type="hidden" name="company_oper">
<input type="hidden" name="wonum_oper">
</td>
</tr>
<tr>
<td bgcolor="#FFFFFF"><span class="labeltext"><b>Status = &nbsp</b></td>
<td bgcolor="#FFFFFF"><span class="tabletext"><select name="status_val" size="1" width="100">
<?php
      if ($sval == 'Open')
      {
?>
	<option selected>Open
	<option value>All
	<option value>Closed
        <option value>Cancelled
        <option value>Hold
<?php
      }
      else if ($sval == 'Closed')
      {
?>
	<option selected>Closed
	<option value>Open
	<option value>All
        <option value>Cancelled
        <option value>Hold
<?php
      }
      else if ($sval == 'Hold')
      {
?>
	<option selected>Hold
	<option value>Open
	<option value>All
        <option value>Cancelled
        <option value>Closed
<?php
      }
      else if ($sval == 'All')
      {
?>
	<option selected>All
	<option value>Open
	<option value>Closed
        <option value>Cancelled
        <option value>Hold
<?php
      }
      else if ($sval == 'Cancelled')
      {
?>
	<option selected>Cancelled
	<option value>Open
	<option value>All
        <option value>Closed
        <option value>Hold
<?php
      }
?>
</select>
</td>

<td bgcolor="#FFFFFF"><span class="labeltext"><b>Company &nbsp</b></td>
<td  bgcolor="#FFFFFF"><span class="tabletext"><select name="comp_oper" size="1" width="100">
<?php
      if ($oper1 == 'like')
      {
?>
	<option selected>like
	<option value>=
<?php
      }
      else
      {
?>
	<option selected>=
	<option value>like
<?php
      }
?>
</select>
</td>
<td bgcolor="#FFFFFF"><input type="text" name="scomp" size=20 value="<?php echo $company_match ?>" onkeypress="javascript: return checkenter(event)">
</td>

<td bgcolor="#FFFFFF"><span class="labeltext"><b>WO # &nbsp&nbsp</b><span class="tabletext">
   <select name="wonum_oper" size="1" width="100">
<?php
      if ($oper2 == 'like')
      {
?>
	<option selected>like
	<option value>=
<?php
      }
      else
      {
?>
	<option selected>=
	<option value>like
<?php
      }
?>
</select>
</td>
<td bgcolor="#FFFFFF"><input type="text" name="swonum" size=20 value="<?php echo $wonum_match ?>" onkeypress="javascript: return checkenter(event)">
</td>
</tr>
<tr>
<td colspan=4 bgcolor="#FFFFFF"><span class="labeltext"><b>Sch Due:  From &nbsp&nbsp</b>
        <input type="text" name="sdate1" size=10 value="<?php echo $date1_match ?>"
         onkeypress="javascript: return checkenter(event)">
        <img src="images/bu-getdateicon.gif" alt="Get Date" onclick='GetDate("sdate1")'>
         <span class="labeltext"><b>&nbsp&nbspTo</b>
        <input type="text" name="sdate2" size=10 value="<?php echo $date2_match ?>"
         onkeypress="javascript: return checkenter(event)">
        <img src="images/bu-getdateicon.gif" alt="Get Date" onclick='GetDate("sdate2")'>
</td>
<td bgcolor="#FFFFFF"><span class="labeltext"><b>Type &nbsp&nbsp</b>
        <input type="text" name="stype" size=10 value="<?php echo $type_match ?>"
         onkeypress="javascript: return checkenter(event)">
</td>
<td bgcolor="#FFFFFF"><span class="labeltext"><b>Sort on</b>
<span class="tabletext"><select name="sort1" size="1" width="100">
<?php
      if ($sortl == 'wo')
      {
?>
	<option selected>wo
	<option selected>company
<?php
      }
      else {
?>
	<option selected>company
	<option selected>wo
<?php
      }
?>
</select></td>
<td bgcolor="#FFFFFF"><span class="labeltext"><b>Sort on</b>
<span class="tabletext"><select name="sort2" size="1" width="100">
<?php
      if ($sort2 == 'wo')
      {
?>
	<option selected>wo
	<option selected>company
<?php
      }
      else {
?>
	<option selected>company
	<option selected>wo
<?php
      }
?>
</select>

<input type="hidden" name="sortfld1">
<input type="hidden" name="sortfld2">
</td>

</tr>
</table>

</td></tr>


<table width=100% border=0 cellpadding=3 cellspacing=1 >


<tr><td><span class="pageheading"><b>List of Work Orders</b></td></tr>

<tr><td>

<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >

<tr>
<td bgcolor="#EEEFEE"><span class="heading"><b>WO</b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Company</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Designer</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Type</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Cust PO</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b>Quote</b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b>PO Link</b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Stage</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Sch Due</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Rev. Ship</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Act. Ship</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Condition</center></b></td>
</tr>

<?php
       $result = $newworkOrder->getWorkOrders($username,$cond,$sort1,$sort2,$offset, $rowsPerPage);

// Dec 30, 05 - Added the following piece of code to accomodoate
//  Excel download feature.
	$_SESSION['username'] = $username;
	//////session_register('username');
	$_SESSION['cond'] = $cond;
	//////session_register('cond');
	$_SESSION['sort1'] = $sort1;
	//////session_register('sort1');
	$_SESSION['sort2'] = $sort2;
	//////session_register('sort2');
	$_SESSION['offset'] = $offset;
	//////session_register('offset');
	$_SESSION['rowsPerPage'] = $rowsPerPage;
	//////session_register('rowsPerPage');
// Dec 30, 05
       $flag = 0;

       while ($myrow = mysql_fetch_row($result))
       {

            if ($flag == 0)
            {
   	       printf('<tr><td rowspan=2 bgcolor="#FFFFFF"><span class="tabletext">
                   <a href="worder_det.php?typenum=%s&wotype=%s&worecnum=%s">%s</td>',
		   $myrow[7],$myrow[1],$myrow[11],$myrow[0]);
               $flag = 1;
?>
               <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[2] ?></td>
               <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[13] ?></td>
               <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[1] ?></td>
               <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[3] ?></td>
               <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[4] ?></td>
<?php
	   // Added for Wo2po link enhancement on Dec 20
	       $worecnum=$myrow[11];
               printf('<td bgcolor="#FFFFFF"><span class="tabletext"><a href="wo2po.php?worecnum=%s&wonum=%s">View Po</td>',
		         $worecnum,$myrow[0]);
	   // End additions
?>
               <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[5] ?></td>
               <td bgcolor="#FFFFFF"><span class="tabletext"><?php if ($myrow[14] != '00-00-00') echo $myrow[14] ?></td>
               <td bgcolor="#FFFFFF"><span class="tabletext"><?php if ($myrow[17] != '00-00-00') echo $myrow[17] ?></td>
               <td bgcolor="#FFFFFF"><span class="tabletext"><?php if ($myrow[15] != '00-00-00') echo $myrow[15] ?></td>
               <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[6] ?></td></tr>
               <tr><td colspan=11 bgcolor="#FFFFFF"><span class="heading">Description:<span class="tabletext"><?php echo $myrow[12] ?></td></tr>
                  </tr>

<?php
             }
             else
             {
                printf('<tr bgcolor="#EFEFEF"><td rowspan=2><span class="tabletext"><a href="worder_det.php?typenum=%s&wotype=%s&worecnum=%s">%s</td>
                      ',
		         $myrow[7],$myrow[1],$myrow[11],$myrow[0]
                     );
                $flag = 0;
?>
                <td><span class="tabletext"><?php echo $myrow[2] ?></td>
                <td><span class="tabletext"><?php echo $myrow[13] ?></td>
                <td><span class="tabletext"><?php echo $myrow[1] ?></td>
                <td><span class="tabletext"><?php echo $myrow[3] ?></td>
                <td><span class="tabletext"><?php echo $myrow[4] ?></td>

<?php
		// Added for Wo2po link enhancement on Dec 20
		$worecnum=$myrow[11];
	        printf('<td><span class="tabletext"><a href="wo2po.php?worecnum=%s&wonum=%s">View Po</td>',
		         $worecnum,$myrow[0]);
		// End additions
?>

               <td><span class="tabletext"><?php echo $myrow[5] ?></td>
               <td><span class="tabletext"><?php if ($myrow[14] != '00-00-00') echo $myrow[14] ?></td>
               <td><span class="tabletext"><?php if ($myrow[17] != '00-00-00') echo $myrow[17] ?></td>
               <td><span class="tabletext"><?php if ($myrow[10] != '00-00-00') echo $myrow[10] ?></td>
                <td><span class="tabletext"><?php echo $myrow[6] ?></td></tr>
               <tr bgcolor="#EFEFEF"><td colspan=11><span class="heading">Description:<span class="tabletext"><?php echo $myrow[12] ?></td></tr>
                 </tr>
<?php
             }
       }
?>
      </FORM>
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


<table border = 0 cellpadding=0 cellspacing=0 width=100% >
<tr>
	<td align=left>

 <?php
//  Added on Dec 6,04 for paging

$numrows = $newworkOrder->getWOcount($cond,$offset, $rowsPerPage);
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
    $prev = " <a href=\"worderSummary.php?page=$page&totpages=$totpages&scomp=$company_match&status_val=$sval&swonum=$wonum_match&sdate1=$date1_match&sdate2=$date2_match&stype=$type_match\">[Prev]</a> ";

    $first = " <a href=\"worderSummary.php?page=1&totpages=$totpages&scomp=$company_match&status_val=$sval&swonum=$wonum_match&sdate1=$date1_match&sdate2=$date2_match&stype=$type_match\">[First Page]</a> ";
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
    $next = " <a href=\"worderSummary.php?page=$page&totpages=$totpages&scomp=$company_match&status_val=$sval&swonum=$wonum_match&sdate1=$date1_match&sdate2=$date2_match&stype=$type_match\">[Next]</a> ";

    $last = " <a href=\"worderSummary.php?page=$totpages&totpages=$totpages&scomp=$company_match&status_val=$sval&swonum=$wonum_match&sdate1=$date1_match&sdate2=$date2_match&stype=$type_match\">[Last Page]</a> ";
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

</body>
</html>
