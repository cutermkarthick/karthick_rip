<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = June 19, 2008                =
// Filename: crn_status.php                    =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 WMS                          =
// Displays WO Status report                   =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];
$dept = $_SESSION['department'];
$_SESSION['pagename'] = 'reports';
$page = "Reports";
//////session_register('pagename');


include_once('classes/loginClass.php');

$newlogin = new userlogin;
$newlogin->dbconnect();

// For paging - Added on Dec 6,04

// how many rows to show per page
$rowsPerPage = 10;

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



// $cond0 = "w.actual_ship_date like %";
$cond0 = "w.condition like " . "'%'";

$cond1 = "c.name like '%'";
$cond2 = "w.wonum like '%'";
$cond3 = "(to_days(w.book_date)-to_days('1582-01-01') > 0 ||
                    w.book_date = '0000-00-00' ||
                    w.book_date = 'NULL' ) and
           (to_days(w.book_date)-to_days('2050-12-31') < 0 ||
                    w.book_date = '0000-00-00' ||
                    w.book_date = 'NULL')";
$cond4 = "w.wotype like '%'";
$cond5 = "m.CIM_refnum like '%'";
$cond = $cond0 . ' and ' . $cond1 . ' and ' . $cond2 . ' and ' . $cond3 . ' and ' . $cond4;

$worec='';
$oper1='like';
$oper2='like';
$oper3='like';
$sort1='wo';
$sort2='crn';
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
     $scomp = "'" . $_REQUEST['scomp'] . "%'";
     $cond1 = "c.name like " . $scomp;

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
if ( isset ( $_REQUEST['crn'] ) )
{
     $crn_match = $_REQUEST['crn'];
     if ( isset ( $_REQUEST['crn_oper'] ) ) {
          $oper3 = $_REQUEST['crn_oper'];
     }
     else {
         $oper3 = 'like';
     }
     if ($oper3 == 'like') {
         $crn = "'" . $_REQUEST['crn'] . "%" . "'";
     }
     else {
         $crn = "'" . $_REQUEST['crn'] . "'";
     }

     $cond5 = "m.CIM_refnum " . $oper3 . " " . $crn;

}
else {
     $crn_match = '';
}
if ( isset ( $_REQUEST['sdate1'] ) || isset ( $_REQUEST['sdate2'] ) )
{
     $date1_match = $_REQUEST['sdate1'];
     $date2_match = $_REQUEST['sdate2'];
     if ( isset ( $_REQUEST['sdate1']) &&  $_REQUEST['sdate1'] != '' )
     {
          $date1 = $_REQUEST['sdate1'];
          $cond31 = "to_days(w.book_date) " . "> to_days('" . $date1 . "')";
     }
     else
     {
          $cond31 = "(to_days(w.book_date)-to_days('1582-01-01') > 0 || w.book_date = 'NULL' || w.book_date = '0000-00-00')";
     }

     if ( isset ( $_REQUEST['sdate2'] )  &&  $_REQUEST['sdate2'] != '')
     {
          $date2 = $_REQUEST['sdate2'];
          $cond32 = "to_days(w.book_date) " . "< to_days('" . $date2 . "')";
     }
     else
     {
          $cond32 = "(to_days(w.book_date)-to_days('2050-12-31') < 0 || w.book_date = 'NULL' || w.book_date = '0000-00-00')";
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

//$cond1 = "c.name like '%'";
$cond = $cond0 . ' and ' . $cond1 . ' and ' . $cond2 . ' and ' . $cond3 . ' and ' . $cond4 . ' and ' . $cond5;

// echo $cond;
// First include the class definition

include('classes/reportClass.php');
include('classes/displayClass.php');
$newreport = new report;
$newdisplay = new display;
?>

<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/report.js"></script>
<html>
<head>
<title>WO Status Report</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">
	
<?php
include('header.html');

?>
<form action='crn_status.php' method='post' enctype='multipart/form-data'>
<!-- <table width=100% cellspacing="0" cellpadding="6" border="0">
<tr>
<td>
<table width=100% border=0 cellspacing="0" cellpadding="0">
<tr>
<td colspan=2><span class="welcome"><b>Welcome <?php echo $userid?></b></td>
<td align="right">&nbsp;<a href="exit.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image16','','images/logout_mo.gif',1)"><img name="Image16" border="0" src="images/logout.gif"></a></td>
 </tr>
</table>
<table width=100% border=0 cellpadding=0 cellspacing=0>
<tr><td></td></tr>
<tr>
<td>
<?php $newdisplay->dispLinks(''); ?>
<table width=100% border=0 cellpadding=0 cellspacing=0  >
<tr bgcolor="DEDFDE">
<td width="6"><img src="images/spacer.gif " width="6"></td> -->
<td bgcolor="#FFFFFF">
<table width=100% border=0 cellpadding=6 cellspacing=0  >
<tr>
	<td>
  <table width=100% border=0 >
   <tr><td><span class="heading"><b>WOs Status Report (Only Part Status with Final Stage is taken)</b></td>
    
<tr><td>
<table width=100% border=0 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1">
<tr>
<td bgcolor="#F5F6F5" colspan="7"><span class="heading"><b><center>Search & Sort Criteria</center></b></td>
<td bgcolor="#FFFFFF" rowspan=3 colspan=4 align="center"><span class="tabletext">
<button class="stdbtn btn_blue" style="float:right;padding:2px;margin-right:5px;"
  onclick="javascript: return searchsort_forcrn()">Get</button>
<!-- <input type="Get" class="stdbtn btn_blue" style="float:right;padding:2px;margin-right:5px;"
  onclick="javascript: return searchsort_forcrn()" value="get"> -->

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
  <option selected value="Open">Open
  <option value="All">All
  <option value="Closed">Closed
    <option value="Cancelled">Cancelled
    <option value="Hold">Hold
<?php
      }
      else if ($sval == 'Closed')
      {
?>
  <option selected value="Closed">Closed
  <option value="Open">Open
  <option value="All">All
    <option value="Cancelled">Cancelled
    <option value="Hold">Hold
<?php
      }
      else if ($sval == 'Hold')
      {
?>
  <option value="Hold" selected>Hold
  <option value="Open">Open
  <option value="All">All
        <option value="Cancelled">Cancelled
        <option value="Closed">Closed
<?php
      }
      else if ($sval == 'All')
      {
?>
  <option selected value = "All">All
  <option value="Open">Open
  <option value="closed">Closed
        <option value="Cancelled">Cancelled
        <option value="Hold">Hold
<?php
      }
      else if ($sval == 'Cancelled')
      {
?>
  <option selected value="Cancelled">Cancelled
  <option value="Open">Open
  <option value="All">All
        <option value="Closed">Closed
        <option value="Hold">Hold
<?php
      }
?>
</select>
</td>

<td bgcolor="#FFFFFF"><span class="labeltext"><b>Company &nbsp</b></td>
<td  bgcolor="#FFFFFF"><span class="labeltext">like</td>
<td bgcolor="#FFFFFF"><input type="text" name="scomp" size=20 value="<?php echo $company_match ?>" onKeyPress="javascript: return checkenter(event)">
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
<td bgcolor="#FFFFFF"><input type="text" name="swonum" size=20 value="<?php echo $wonum_match ?>" onKeyPress="javascript: return checkenter(event)">
</td>
</tr>
<tr>
<td colspan=3 bgcolor="#FFFFFF"><span class="labeltext"><b>Book Date:  From &nbsp&nbsp</b>
        <input type="text" name="sdate1" size=10 value="<?php echo $date1_match ?>"
         onkeypress="javascript: return checkenter(event)">
        <img src="images/bu-getdateicon.gif" alt="Get Date" onclick='GetDate("sdate1")'>
         <span class="labeltext"><b>&nbsp;&nbsp;To</b>
        <input type="text" name="sdate2" size=10 value="<?php echo $date2_match ?>"
         onkeypress="javascript: return checkenter(event)">
        <img src="images/bu-getdateicon.gif" alt="Get Date" onclick='GetDate("sdate2")'>
</td>
<td bgcolor="#FFFFFF"><span class="labeltext"><b>PRN#</b></td>
<td bgcolor="#FFFFFF">
       <select name="crn_oper" size="1" width="100">
<?php
      if ($oper3 == 'like')
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
</select> &nbsp;&nbsp;
        <input type="text" name="crn" size=10 value="<?php echo $crn_match ?>"
         onkeypress="javascript: return checkenter(event)">
</td>
<td bgcolor="#ffffff" colspan=2></td>
</tr>
</table>

</td></tr>
    </tr>
   </table>
<tr><td>
<table width=100% border=0 cellpadding=3 cellspacing=1 class="stdtable">
  <thead>
        <tr>
<th class="head0"><span class="heading"><b>PRN</b></th>
<th class="head1"><span class="heading"><b>WO #</b></th>
<th class="head0"><span class="heading"><b>Customer</b></th>
<th class="head1"><span class="heading"><b>Book Dt</b></th>
<th class="head0"><span class="heading"><b>Schedule Dt</b></th>
<th class="head1"><span class="heading"><b>WO Qty</b></th>
<th class="head0"><span class="heading"><b>Acc</b></th>
<th class="head1"><span class="heading"><b>Rework</b></th>
<th class="head0"><span class="heading"><b>Rej</b></th>
<th class="head1"><span class="heading"><b>Ret</b></th>
<th class="head0"><span class="heading"><b>Disp Qty</b></th>
<th class="head1"><span class="heading"><b>Balance<br>(Acc-Disp)</b></th>
        </tr>
      </thead>

<?php  
$$balance =0;    
        $result = $newreport->wopartstatus($cond,$offset,$rowsPerPage);
        while ($myrow = mysql_fetch_row($result)) {
	    if($myrow[2] != '0000-00-00' && $myrow[2] != '' && $myrow[2] != 'NULL')
            {
                $datearr = split('-', $myrow[2]);
                $d=$datearr[2];
                $m=$datearr[1];
                $y=$datearr[0];
                $x=mktime(0,0,0,$m,$d,$Y);
                $custpodate=date("M j, Y",$x);
            }
            else
            {
               $custpodate = '';
            }
	    if($myrow[10] != '0000-00-00' && $myrow[10] != '' && $myrow[10] != 'NULL')
            {
                $datearr = split('-', $myrow[10]);
                $d=$datearr[2];
                $m=$datearr[1];
                $y=$datearr[0];
                $x=mktime(0,0,0,$m,$d,$y);
                $bookdate=date("M j, Y",$x);
            }
            else
            {
               $bookdate = '';
            }
	    if($myrow[9] != '0000-00-00' && $myrow[9] != '' && $myrow[9] != 'NULL')
            {
                $datearr = split('-', $myrow[9]);
                $d=$datearr[2];
                $m=$datearr[1];
                $y=$datearr[0];
                $x=mktime(0,0,0,$m,$d,$y);
                $compdate=date("M j, Y",$x);
            }
            else
            {
               $compdate = '';
            }

               if($myrow[15] != '0000-00-00' && $myrow[15] != '' && $myrow[15] != 'NULL')
            {
                $datearr = split('-', $myrow[15]);
                $d=$datearr[2];
                $m=$datearr[1];
                $y=$datearr[0];
                $x=mktime(0,0,0,$m,$d,$y);
                $schdate=date("M j, Y",$x);
            }
            else
            {
               $schdate = '';
            }
            $balance = $myrow[11];
           $balance = $balance - $myrow[15];
            printf('<tr><td bgcolor="#FFFFFF"  align="center"><span class="tabletext">%s</td>
                    <td bgcolor="#FFFFFF" align="center"><span class="tabletext">%s</td>
                    <td bgcolor="#FFFFFF" align="center"><span class="tabletext">%s</td>
                    <td bgcolor="#FFFFFF" align="center"><span class="tabletext">%s</td>
                    <td bgcolor="#FFFFFF" align="center"><span class="tabletext">%s</td>
                    <td bgcolor="#FFFFFF" align="ce align="center"nter"><span class="tabletext">%s</td>
                    <td bgcolor="#FFFFFF" align="center"><span class="tabletext">%s</td>
                    <td bgcolor="#FFFFFF" align="center"><span class="tabletext">%s</td>
                    <td bgcolor="#FFFFFF" align="center"><span class="tabletext">%s</td>
                    <td bgcolor="#FFFFFF" align="center"><span class="tabletext">%s</td>
                      <td bgcolor="#FFFFFF" align="center"><span class="tabletext">%s</td>
                        <td bgcolor="#FFFFFF" align="center"><span class="tabletext">%s</td>
                    ',
                      $myrow[5],
                      $myrow[6], 
                      $myrow[0],
            		      $bookdate,
                      $schdate,
                      $myrow[7],
                      $myrow[11],
                      $myrow[12],
                      $myrow[13],
                      $myrow[14],
                      $myrow[15],
                      $balance

                      
                      );
             /*   $dispres = $newreport->get_disp4worep($myrow[6]);
               $balance = $myrow[11];
               $dispfound=0;
               while ($mydisp = mysql_fetch_row($dispres)) 
               {
                    $balance = $balance - $mydisp[1];
                    printf('<td bgcolor="#FFFFFF" align="center"><span class="tabletext">%s</td> 
                      <td bgcolor="#FFFFFF" align="center"><span class="tabletext">%s</td> 
                      <td bgcolor="#00FF00" align="center"><span class="tabletext">%s</td>',
                        $myrow[13],
                       $myrow[14],
                      $balance);
                   
                    $dispfound=1;
                }
               if ($dispfound == 1) 
               {
                   print('</td></tr></tr>');
               }
               else {

                   print('<td bgcolor="#FFFFFF">&nbsp</td><td bgcolor="#FFFFFF">&nbsp</td><td bgcolor="#FFFFFF">&nbsp</td></tr>');
               }*/
          }

?>
</td></tr>
</table>
</td></tr>
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
//  Added on Dec 6,04 for paging

$numrows = $newreport->wopartstatuscount($cond);
//echo $numrows;

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
    $prev = " <a href=\"crn_status.php?page=$page&totpages=$totpages&scomp=$company_match&swonum=$wonum_match&sdate1=$date1_match&sdate2=$date2_match&crn=$crn_match&status_val=$sval\">[Prev]</a> ";

    $first = " <a href=\"crn_status.php?page=1&totpages=$totpages&scomp=$company_match&swonum=$wonum_match&sdate1=$date1_match&sdate2=$date2_match&crn=$crn_match&status_val=$sval\">[First Page]</a> ";
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
  $next = " <a href=\"crn_status.php?page=$page&totpages=$totpages&scomp=$company_match&swonum=$wonum_match&sdate1=$date1_match&sdate2=$date2_match&crn=$crn_match&status_val=$sval\">[Next]</a> ";

  $last = " <a href=\"crn_status.php?page=$totpages&totpages=$totpages&scomp=$company_match&swonum=$wonum_match&sdate1=$date1_match&sdate2=$date2_match&crn=$crn_match&status_val=$sval\">[Last Page]</a> ";
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
