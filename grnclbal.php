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
$_SESSION['pagename'] = 'reports';
$page = "Reports";
//////session_register('pagename');


include_once('classes/loginClass.php');

$newlogin = new userlogin;
$newlogin->dbconnect();

// For paging - Added on Dec 6,04

// how many rows to show per page
$rowsPerPage = 100000;

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



//$cond0 = "w.actual_ship_date like %";
//$cond0 = "w.condition like " . "'%'";

/*$cond1 = "grn.raw_mat_spec like '%'";
$cond2 = "grn.raw_mat_type like '%'";*/
$cond3 = "(to_days(g.iss_date)-to_days('1582-01-01') > 0 ||
                    g.iss_date = '0000-00-00' ||
                    g.iss_date = 'NULL' ) and
           (to_days(g.iss_date)-to_days('2050-12-31') < 0 ||
                    g.iss_date = '0000-00-00' ||
                    g.iss_date = 'NULL')";
$cond4 = "g.grnnum like '%'";
//$cond5 = "(grn.crn like '%' || grn.crn is NULL)";
//$cond5 = "m.CIM_refnum like '%'";
$cond = $cond3 . ' and ' . $cond4;
// echo $cond;

$oper1='like';
$oper2='like';
$oper3='like';
$oper4='like';

$sess=session_id();

/*if ( isset ( $_REQUEST['scomp'] ) )
{
     $company_match = $_REQUEST['scomp'];
     $scomp = "'" . $_REQUEST['scomp'] . "%'";
     $cond1 = "grn.raw_mat_spec like " . $scomp;

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

     $cond2 = "grn.raw_mat_type " . $oper2 . " " . $swonum;

}
else {
     $wonum_match = '';
}*/

if ( isset ( $_REQUEST['sdate1'] ) || isset ( $_REQUEST['sdate2'] ) )
{
     $date1_match = $_REQUEST['sdate1'];
     $date2_match = $_REQUEST['sdate2'];
     if ( isset ( $_REQUEST['sdate1']) &&  $_REQUEST['sdate1'] != '' )
     {
          $date1 = $_REQUEST['sdate1'];
          $cond31 = "to_days(g.iss_date) " . ">= to_days('" . $date1 . "')";
     }
     else
     {
          $cond31 = "(to_days(g.iss_date)-to_days('1582-01-01') > 0 || g.iss_date = 'NULL' || g.iss_date = '0000-00-00')";
     }

     if ( isset ( $_REQUEST['sdate2'] )  &&  $_REQUEST['sdate2'] != '')
     {
          $date2 = $_REQUEST['sdate2'];
          $cond32 = "to_days(g.iss_date) " . "<= to_days('" . $date2 . "')";
     }
     else
     {
          $cond32 = "(to_days(g.iss_date)-to_days('2050-12-31') < 0 || g.iss_date = 'NULL'
                       || g.iss_date = '0000-00-00')";
     }
     $cond3 = $cond31 . ' and ' . $cond32;

}
else
{
     $date1_match = '';
     $date2_match = '';
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

     $cond4 = "g.grnnum " . $oper3 . " " . $crn;

}
else {
     $crn_match = '';
}

/*if ( isset ( $_REQUEST['cim'] ) )
{
     $cim_match = $_REQUEST['cim'];
     if ( isset ( $_REQUEST['cim_oper'] ) ) {
          $oper4 = $_REQUEST['cim_oper'];
     }
     else {
         $oper4 = 'like';
     }
     if ($oper4 == 'like') {
         $cim = "'" . $_REQUEST['cim'] . "%" . "'";
     }
     else {
         $cim = "'" . $_REQUEST['cim'] . "'";
     }
     if($cim_match=='')
         $cond5 = "(grn.crn " . $oper4 . " " . $cim ." || grn.crn is null)" ;
     else
         $cond5 = "grn.crn " . $oper4 . " " . $cim ;

}
else {
     $cim_match = '';
}*/
if ( isset ( $_REQUEST['sortfld1'] ) ) {
    $sort1 = $_REQUEST['sortfld1'];
}
if ( isset ( $_REQUEST['sortfld2'] ) ) {
    $sort2 = $_REQUEST['sortfld2'];
}

//$cond1 = "c.name like '%'";
$cond = $cond3 . ' and ' . $cond4 ;



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
<title>GRN Balance</title>
</head>
<body leftmargin="0" topmargin="0" marginwidth="0">
	
<?php
include('header.html');

?>
<form action='grnclbal.php' method='post' enctype='multipart/form-data'>
<!-- <table width=100% cellspacing="0" cellpadding="6" border="0">
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
<?php $newdisplay ->dispLinks(''); ?>
<table width=100% border=0 cellpadding=0 cellspacing=0  >
<tr bgcolor="DEDFDE">
<td width="6"><img src="images/spacer.gif " width="6"></td>
<td bgcolor="#FFFFFF">
<table width=100% border=0 cellpadding=6 cellspacing=0  >
<tr>
	<td> -->
  <table width=100% border=0 >
   <tr><td><span class="heading"><b>GRN Closing Balance report</b></td>
    
<tr><td>
<table width=100% border=0 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1">
<tr>
<td bgcolor="#F5F6F5" colspan="7"><span class="heading"><b><center>Search Criteria</center></b></td>
<td bgcolor="#FFFFFF" rowspan=3 colspan=4 align="center"><span class="tabletext">
<input type="image" name="Submit" src="images/bu-get.gif" value="Get"
            onclick="javascript: return searchsort_stockgrn()">

<input type="hidden" name="company_oper">
<input type="hidden" name="wonum_oper">
</td>
</tr>
<tr>
<!-- <td bgcolor="#FFFFFF"><span class="labeltext"><b>Raw Mtl Spec &nbsp</b></td>
<td  bgcolor="#FFFFFF"><span class="labeltext">like</td>
<td bgcolor="#FFFFFF"><input type="text" name="scomp" size=20 value="<?php echo $company_match ?>" onKeyPress="javascript: return checkenter(event)">
</td>

<td bgcolor="#FFFFFF"><span class="labeltext"><b>Raw Matl Type&nbsp&nbsp</b><span class="tabletext">
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
</td> -->
<!-- <td  colspan=3 bgcolor="#FFFFFF"><input type="text" name="swonum" size=20 value="<?php echo $wonum_match ?>" onKeyPress="javascript: return checkenter(event)">
</td>
</tr>
<tr> -->
<td colspan=3 bgcolor="#FFFFFF"><span class="labeltext"><b>Issue Date:  From &nbsp&nbsp</b>
        <input type="text" name="sdate1" id="sdate1" size=10 value="<?php echo $date1_match ?>"
         onkeypress="javascript: return checkenter(event)">
        <img src="images/bu-getdateicon.gif" alt="Get Date" onclick='GetDate("sdate1")'>
         <span class="labeltext"><b>&nbsp;&nbsp;To</b>
        <input type="text" name="sdate2" id="sdate2" size=10 value="<?php echo $date2_match ?>"
         onkeypress="javascript: return checkenter(event)">
        <img src="images/bu-getdateicon.gif" alt="Get Date" onclick='GetDate("sdate2")'>
</td>
<td bgcolor="#FFFFFF"><span class="labeltext"><b>GRN #</b></td>
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
</select>
        <input type="text" name="crn" size=12 value="<?php echo $crn_match ?>"
         onkeypress="javascript: return checkenter(event)">
</td>

<!-- <td bgcolor="#FFFFFF"><span class="labeltext"><b>PRN</b></td>
<td bgcolor="#FFFFFF">
       <select name="cim_oper" size="1" width="100">
<?php
      if ($oper4 == 'like')
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
        <input type="text" name="cim" size=12 value="<?php echo $cim_match ?>"
         onkeypress="javascript: return checkenter(event)">
</td>
</tr> -->

</table>

</td></tr>
    </tr>
   </table>
<tr><td>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable">
        <tr>
        <thead>
            <th width="5%" class="head0"><span class="heading"><b>GRN #</b></th>
            <th width="5%" class="head1"><span class="heading"><b>Issue Date</b></th>
           <th width="5%" class="head0"><span class="heading"><b>wo / assy#</b></th>
           <th width="5%" class="head1"><span class="heading"><b>Status</b></th>       
            <th width="5%" class="head1"><span class="heading"><b>OP Bal</b></th>
            <th width="5%" class="head0"><span class="heading"><b>Iss Qty</b></th>
            <th width="5%" class="head1"><span class="heading"><b>Cl Bal</b></th>
              
        </tr>

<?php      
        $totqtm = 0;
        $totqi = 0;
        $totbal = 0;
        $result = $newreport->get_grnclbal($cond,$offset,$rowsPerPage);
        while ($myrow = mysql_fetch_row($result)) 
        {
	    if($myrow[1] != '0000-00-00' && $myrow[1] != '' && $myrow[1] != 'NULL')
            {
                $datearr = split('-', $myrow[1]);
                $d=$datearr[2];
                $m=$datearr[1];
                $y=$datearr[0];
                $x=mktime(0,0,0,$m,$d,$y);
                $issdate=date("M j, Y",$x);
            }
            else
            {
               $issdate = '';
            }

             printf('<tr><td bgcolor="#FFFFFF" align="center"><span class="tabletext">%s</td>
                    <td bgcolor="#FFFFFF" align="center"><span class="tabletext">%s</td>
                    <td bgcolor="#FFFFFF" align="center"><span class="tabletext">%s</td>
                    <td bgcolor="#FFFFFF" align="center"><span class="tabletext">%s</td>
                    <td bgcolor="#FFFFFF" align="center"><span class="tabletext">%s</td>
                    <td bgcolor="#FFFFFF" align="center"><span class="tabletext">%d</td>
                     <td bgcolor="#FFFFFF" align="center"><span class="tabletext">%s</td>
                    ',
                      $myrow[2],
                      $issdate,
                      $myrow[3],
                      $myrow[7], 
                      $myrow[5],
                      $myrow[6],
                      $myrow[4]
                      );
            
          }
?>
</table>
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
// Added on Dec 6,04 for paging
$numrows = 10;

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
    $prev = " <a href=\"stockgrn_status.php\">[Prev]</a> ";

    $first = " <a href=\"stockgrn_status.php\">[First Page]</a> ";
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
  $next = " <a href=\"stockgrn_status.php\">[Next]</a> ";

  $last = " <a href=\"stockgrn_status.php\">[Last Page]</a> ";
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
