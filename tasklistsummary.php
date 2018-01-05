<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = September 25, 2006           =
// Filename: tasklistsummary.php               =
// Copyright of Badari Mandyam, FluentSoft     =
// Revision: v1.0 OWT                          =
// Displays list of tasks.                     =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];
$_SESSION['pagename'] = 'tasklistsummary';
//////session_register('pagename');

$cond = "(to_days(w.taskdate)-to_days('1582-01-01') > 0 ||
                    w.taskdate = 'NULL') and
           (to_days(w.taskdate)-to_days('2050-12-31') < 0 ||
               w.taskdate = 'NULL')";


$worec='';
$oper1='like';
$oper2='like';
$sort1='ascending';
$sort2='descending';
$sess=session_id();


if ( isset ( $_REQUEST['sdate1'] ) || isset ( $_REQUEST['sdate2'] ) )
{
      if($_REQUEST['sdate1'] =='' || $_REQUEST['sdate2']=='' )
      {
		$date1_match = '';
		$date2_match = '';
       }
       else
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
	          $cond31 = "(to_days(w.sch_due_date)-to_days('1582-01-01') > 0 || w.sch_due_date = 'NULL')";
	     }

	     if ( isset ( $_REQUEST['sdate2'] )  &&  $_REQUEST['sdate2'] != '')
	     {
	          $date2 = $_REQUEST['sdate2'];
	          $cond32 = "to_days(w.taskdate) " . "< to_days('" . $date2 . "')";
	     }
	     else
	     {
	          $cond32 = "(to_days(w.taskdate)-to_days('2050-12-31') < 0 || w.taskdate = 'NULL')";
	     }
	     $cond3 = $cond31 . ' and ' . $cond32;
           }

}
else
{
	    $date1_match = '';
	    $date2_match = '';

}

if ( isset ( $_REQUEST['sortfld1'] ) )
{
		 $sort1=$_REQUEST['sortfld1'];
}
if ( isset ( $_REQUEST['sortfld2'] ) )
{
		 $sort2 = $_REQUEST['sortfld2'];
}

//$cond = $cond1 . ' and ' . $cond2 . ' and ' . $cond3;





// First include the class definition
include_once('classes/userClass.php');
include('classes/tasklistClass.php');
include_once('classes/displayClass.php');
$newtask= new tasklist;
$newdisplay = new display;



// how many rows to show per page
$rowsPerPage =50;

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
<script language="javascript" src="scripts/tasklist.js"></script>
<html>
<head>
<title>Tasklist Summary</title>
</head>
<?php
include('header.html');
?>
<?PHP
$day=date('d');
$month= date('m');
$year= date('y');
?>
<form action='tasklistsummary.php' method='post' >
<table width=100% cellspacing="0" cellpadding="6" border="0">
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
  <tr bgcolor="DEDFDE"><td width="6"><img src="images/spacer.gif " width="6"></td>
	    <td bgcolor="#FFFFFF">
      <table width=100% border=0 cellpadding=6 cellspacing=0  >
  <tr><td><span class="heading"><i></i></td></tr>
<tr>
<td>



<table width=100% border=0 cellpadding=6 cellspacing=0  >
<tr><td>
<table width=100% border=0 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF" >
<tr>
<td bgcolor="#F5F6F5" colspan="5"><span class="heading"><b><center>Search & Sort Criteria</center></b></td>
<td bgcolor="#FFFFFF" rowspan=3 colspan=4 align="center"><span class="tabletext">
<input type="image" name="Submit" src="images/bu-get.gif" value="Get"
            onclick="javascript: return searchsort_fields()">

<input type="hidden" name="company_oper">
<input type="hidden" name="wonum_oper">
</td>
</tr>

<tr>
<td colspan=3 bgcolor="#FFFFFF" rowspan=2><span class="labeltext"><b> Task Date:   </b>From
        <input type="text" name="sdate1" size=10 value="<?php echo $date1_match ?>"
         onkeypress="javascript: return checkenter(event)">
        <img src="images/bu-getdateicon.gif" alt="Get Date" onclick='GetDate("sdate1")'>
         <span class="labeltext"><b>&nbsp&nbspTo</b>
        <input type="text" name="sdate2" size=10 value="<?php echo $date2_match ?>"
         onkeypress="javascript: return checkenter(event)">
        <img src="images/bu-getdateicon.gif" alt="Get Date" onclick='GetDate("sdate2")'>
</td>

<td bgcolor="#FFFFFF"><span class="labeltext"><b>Sort on</b>
<span class="tabletext"><select name="sort1" size="1" width="100">

<?php

      if ($sortl == 'ascending')
      {
?>
	<option selected>ascending
	<option selected>descending
<?php
      }
      else {
?>
	<option selected>descending
	<option selected>ascending
<?php
      }
?>
</select></td>


<input type="hidden" name="sortfld1">
<input type="hidden" name="sortfld2">
<?php
$_SESSION['printcond'] = $cond;
//////session_register('printcond');
?>
<input type="hidden" name="cond" value="<?php echo "$cond";?>">
</td>

</tr>
</table>




<table width=100% border=0>
  <tr>
	<td><span class="pageheading"><b>Tasklist Summary</b></td>
	<td colspan=170>&nbsp;</td>
    <td><a href ="new_task.php?day=<?php echo $day ?>&month=<?php echo $month ?>&year=<?php echo $year ?>"><img name="Image88" border="0" src="images/new-task.gif"></a></td>
  </tr>
</table>

</table>

<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
        <tr  bgcolor="#FFCC00">
            <td  bgcolor="#EEEFEE" width=5%><span class="tabletext"><b>Sl.No</b></td>
            <td  bgcolor="#EEEFEE" width=10%><span class="tabletext"><b>Task Date</b></td>
            <td  bgcolor="#EEEFEE" width=10%><span class="tabletext"><b>User</b></td>
             <td  bgcolor="#EEEFEE" width=20%><span class="tabletext"><b>Created date</b></td>


<?php
            // $result = $newtask->getAccounts($cond,$argsort1,$argoffset,$arglimit);
             $result = $newtask->getasklists();
            while ($row = mysql_fetch_assoc($result)) {
                  printf('<tr bgcolor="#FFFFFF"><td ><span class="tabletext">%s</td>
                          <td><span class="tabletext"><a href="addNotes4task.php?tasklistrecnum=%s" TITLE="Task Details">%s</td>
                          <td><span class="tabletext">%s</td>
                          <td><span class="tabletext">%s</td>',
                   $row["recnum"],
                   $row["recnum"], $row["taskdate"],
                   $row["userid"],
                   $row["date"]);

              printf('</td></tr>');
              }
?>
      </FORM>
</table>
      </table>
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

//$numrows = $newtask->getcompCount($cond,$offset, $rowsPerPage);
// how many pages we have when using paging?
$numrows=30;
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
    $prev = " <a href=\"boardReport.php?page=$page&totpages=$totpages\">[Prev]</a> ";

    $first = " <a href=\"boardReport.php?page=1&totpages=$totpages\">[First Page]</a> ";
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
    $next = " <a href=\"boardReport.php?page=$page&totpages=$totpages\">[Next]</a> ";

    $last = " <a href=\"boardReport.php?page=$totpages&totpages=$totpages\">[Last Page]</a> ";
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
</html >
