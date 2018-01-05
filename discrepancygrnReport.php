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
//////session_register('pagename');


include_once('classes/loginClass.php');

$newlogin = new userlogin;
$newlogin->dbconnect();

date_default_timezone_set('Asia/Calcutta');
 $todate1 = date("Y-m-d");
 $today = split('-',$todate1);
$days = $today[2]-1;
$fromdate1 = date("Y-m-d",strtotime("-$days days"));

// For paging - Added on Dec 6,04

// how many rows to show per page
$rowsPerPage = 10000;

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

$crn=$_REQUEST['crn'];
$fdate=$_REQUEST['fdate'];
$tdate=$_REQUEST['tdate'];

if($tdate=='')
{

   if($crn !='')
{
 $cond5 = "(grn.crn like '".$crn."%')";
 $cim_match=$crn;
}else
{

 $cond5 = "(grn.crn like '%' || grn.crn is NULL)";
 $cim_match='';
}
 $cond31 = "to_days(grn.recieved_date) " . ">= to_days('" . $fromdate1 . "')";
 $cond32 = "to_days(grn.recieved_date) " . "<= to_days('" . $todate1 . "')";
 $cond3= $cond31 . ' and ' . $cond32;
}else
{

   if($crn !='')
{
 $cond5 = "(grn.crn like '".$crn."%')";
 $cim_match=$crn;
}else
{

 $cond5 = "(grn.crn like '%' || grn.crn is NULL)";
 $cim_match='';
}

  //echo $fdate."*--*-*".$tdate;
  if($tdate=='')
  {   //echo"----8888here";
   $cond3 = "(to_days(grn.recieved_date)-to_days('1582-01-01') > 0 ||
                    grn.recieved_date = '0000-00-00' ||
                    grn.recieved_date = 'NULL' ) and
           (to_days(grn.recieved_date)-to_days('2050-12-31') < 0 ||
                    grn.recieved_date = '0000-00-00' ||
                    grn.recieved_date = 'NULL')";
  } else
  {
    //echo"-----9999here<br>";
     $cond31 = "to_days(grn.recieved_date) " . ">= to_days('" . $fdate . "')";
     $cond32 = "to_days(grn.recieved_date) " . "<= to_days('" . $tdate . "')";
     $cond3=$cond32;
     $fromdate1 = $fdate;
     $todate1= $tdate;
     //echo $cond3."*--*-*".$tdate."--------".$fromdate1."-*-*".$todate1;
  }
  //echo $finalref_match."****in***";
}
//$cond0 = "w.actual_ship_date like %";
//$cond0 = "w.condition like " . "'%'";



$cond4 = "grn.grnnum like '%'";

if($crn !='')
{
 $cond5 = "(grn.crn like '".$crn."%')";
 $cim_match=$crn;
}else
{

 $cond5 = "(grn.crn like '%' || grn.crn is NULL)";
}

//$cond5 = "m.CIM_refnum like '%'";
$cond = $cond3 . ' and ' . $cond4 . ' and ' . $cond5;

$oper1='like';
$oper2='like';
$oper3='like';
$oper4='like';

$sess=session_id();
if ( isset ( $_REQUEST['flag'] ) )
{
     $flag = 1;
}
else
{
     $flag = 0;
}


if ( isset ( $_REQUEST['sdate1'] ) || isset ( $_REQUEST['sdate2'] ) )
{
     $fromdate1 = $_REQUEST['sdate1'];
     $todate1 = $_REQUEST['sdate2'];
     if ( isset ( $_REQUEST['sdate1']) &&  $_REQUEST['sdate1'] != '' )
     {
          $date1 = $_REQUEST['sdate1'];
          $cond31 = "to_days(grn.recieved_date) " . ">= to_days('" . $date1 . "')";
     }
     else
     {
          $cond31 = "(to_days(grn.recieved_date)-to_days('1582-01-01') > 0 || grn.recieved_date = 'NULL' || grn.recieved_date = '0000-00-00')";
     }

     if ( isset ( $_REQUEST['sdate2'] )  &&  $_REQUEST['sdate2'] != '')
     {
          $date2 = $_REQUEST['sdate2'];
          $cond32 = "to_days(grn.recieved_date) " . "<= to_days('" . $date2 . "')";
     }
     else
     {
          $cond32 = "(to_days(grn.recieved_date)-to_days('2050-12-31') < 0 || grn.recieved_date = 'NULL'
                       || grn.recieved_date = '0000-00-00')";
     }
     $cond3 = $cond31 . ' and ' . $cond32;
   //echo $cond3."-------";
}
else
{
      if($tdate!='')
     {
       $fromdate1 = $fdate;
       $todate1 = $tdate;
     }else
     { //echo"----here";
       $fromdate1 = $fromdate1;
       $todate1 = $todate1;
     }


}
if ( isset ( $_REQUEST['grn'] ) )
{
     $grn_match = $_REQUEST['grn'];
     if ( isset ( $_REQUEST['grn_oper'] ) ) {
          $oper3 = $_REQUEST['grn_oper'];
     }
     else {
         $oper3 = 'like';
     }
     if ($oper3 == 'like') {
         $grn = "'" . $_REQUEST['grn'] . "%" . "'";
     }
     else {
         $grn = "'" . $_REQUEST['grn'] . "'";
     }

     $cond4 = "grn.grnnum " . $oper3 . " " . $grn;

}
else {
     $grn_match = '';
}

if ( isset ( $_REQUEST['crn'] ) )
{
     $crn_match = $_REQUEST['crn'];
     if ( isset ( $_REQUEST['crn_oper'] ) ) {
          $oper4 = $_REQUEST['crn_oper'];
     }
     else {
         $oper4 = 'like';
     }
     if ($oper4 == 'like') {
         $crn = "'" . $_REQUEST['crn'] . "%" . "'";
     }
     else {
         $crn = "'" . $_REQUEST['crn'] . "'";
     }
     if($crn_match=='')
         $cond5 = "(grn.crn " . $oper4 . " " . $crn ." || grn.crn is null)" ;
     else
         $cond5 = "grn.crn " . $oper4 . " " . $crn ;

}
else {

 if($crn=='')
{
      $cim_match = '';
}else
{

  $cim_match = $crn;
}


}
if ( isset ( $_REQUEST['sortfld1'] ) ) {
    $sort1 = $_REQUEST['sortfld1'];
}
if ( isset ( $_REQUEST['sortfld2'] ) ) {
    $sort2 = $_REQUEST['sortfld2'];
}

//$cond1 = "c.name like '%'";
$cond = $cond3 . ' and ' . $cond4 . ' and ' . $cond5;
//echo $cond;
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
<title>Discrepancy(GRN) Report</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">

<?php
include('header.html');

?>
<form action='discrepancygrnReport.php' method='post' enctype='multipart/form-data'>
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
<?php $newdisplay ->dispLinks(''); ?>
<table width=100% border=0 cellpadding=0 cellspacing=0  >
<tr bgcolor="DEDFDE">
<td width="6"><img src="images/spacer.gif " width="6"></td>
<td bgcolor="#FFFFFF">
<table width=100% border=0 cellpadding=6 cellspacing=0  >
<tr>
	<td>
  <table width=100% border=0 >
   <tr><td><span class="heading"><b>Discrepancy (-ve Bal GRN) Report</b></td>

    <!--<td align="right"><a href="stock_costReport.php?crn=<?php //echo $cim_match ?>&fdate=<?php //echo $fromdate1 ?>&tdate=<?php //echo $todate1 ?>"><b><img src="images/arrow_left.png" alt="CRN Stock Report"></b></a></td>-->


<tr><td>
<table width=100% border=0 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF" >
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
<td colspan=3 bgcolor="#FFFFFF"><span class="labeltext"><b>Recd Date:  From &nbsp&nbsp</b>
        <input type="text" name="sdate1" id="sdate1" size=10 value="<?php echo $fromdate1 ?>"
         onkeypress="javascript: return checkenter(event)">
        <img src="images/bu-getdateicon.gif" alt="Get Date" onclick='GetDate("sdate1")'>
         <span class="labeltext"><b>&nbsp;&nbsp;To</b>
        <input type="text" name="sdate2" id="sdate2" size=10 value="<?php echo $todate1 ?>"
         onkeypress="javascript: return checkenter(event)">
        <img src="images/bu-getdateicon.gif" alt="Get Date" onclick='GetDate("sdate2")'>
</td>
<td bgcolor="#FFFFFF"><span class="labeltext"><b>GRN #</b></td>
<td bgcolor="#FFFFFF">
       <select name="grn_oper" size="1" width="100">
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
        <input type="text" name="grn" id="grn" size=12 value="<?php echo $grn_match ?>"
         onkeypress="javascript: return checkenter(event)">
</td>

<td bgcolor="#FFFFFF"><span class="labeltext"><b>PRN</b></td>
<td bgcolor="#FFFFFF">
       <select name="crn_oper" size="1" width="100">
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
        <input type="text" name="crn" id="crn" size=12 value="<?php echo $crn_match ?>"
         onkeypress="javascript: return checkenter(event)">
</td>
</tr>

</table>

</td></tr>
    </tr>
   </table>
<tr>

</tr>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
        <tr>
            <td width="5%" bgcolor="#EEEFEE" align="center"><span class="heading"><b>GRN #</b></td>
            <td width="5%" bgcolor="#EEEFEE" align="center"><span class="heading"><b>Received Date</b></td>
            <td width="5%" bgcolor="#EEEFEE" align="center"><span class="heading"><b>PRN</b></td>
            <td width="5%" bgcolor="#EEEFEE" align="center"><span class="heading"><b>Qty To Make</b></td>
            <td width="5%" bgcolor="#EEEFEE" align="center"><span class="heading"><b>Qty Issued</b></td>
            <td width="5%" bgcolor="#EEEFEE" align="center"><span class="heading"><b>Qty Returned</b></td>
            <td width="5%" bgcolor="#EEEFEE" align="center"><span class="heading"><b>Balance<br>(qtm+ret-woqty)</b></td>
        </tr>

<?php

        $result = $newreport->get_stockbygrn($cond,$offset,$rowsPerPage);
        while ($myrow = mysql_fetch_row($result)) {
	    if($myrow[1] != '0000-00-00' && $myrow[1] != '' && $myrow[1] != 'NULL')
            {
                $datearr = split('-', $myrow[1]);
                $d=$datearr[2];
                $m=$datearr[1];
                $y=$datearr[0];
                $x=mktime(0,0,0,$m,$d,$y);
                $recddate=date("M j, Y",$x);
            }
            else
            {
               $recddate = '';
            }
            $wo_qtyres = $newreport->get_woqty($myrow[0]);
            $woqtyrow = mysql_fetch_row($wo_qtyres);
            $woqty = $woqtyrow[1];
            $woretqty = 0;
            $woqtyres = $newreport->get_woqty4stock_grn($myrow[0]);
            while($woqtyrow = mysql_fetch_row($woqtyres)){

             $woretqty += $woqtyrow[2];

            }

            $balance = 0;
            //echo $myrow[4]."===".$woretqty."===".$woqty;
            $balance = $myrow[4] + $woretqty - $woqty;
           // echo $balance."GRN==";
            if($balance<0)
           {

              printf('<tr><td bgcolor="#FFFFFF" align="center"><span class="tabletext">%s</td>
                    <td bgcolor="#FFFFFF" align="center"><span class="tabletext">%s</td>
                    <td bgcolor="#FFFFFF" align="center"><span class="tabletext">%s</td>
                    <td bgcolor="#FFFFFF" align="center"><span class="tabletext">%d</td>
                    <td bgcolor="#FFFFFF" align="center"><span class="tabletext">%d</td>
                    <td bgcolor="#FFFFFF" align="center"><span class="tabletext">%d</td>',
                      $myrow[0],
                      $recddate,
                      $myrow[5],
                      $myrow[4],
		       $woqty,
		       $woretqty);
              if ($balance < 0)
             {
                printf('<td bgcolor="#FF0000" align="center"><span class="tabletext">%d</td>',$balance);
             }
             else
             {
                printf('<td bgcolor="#FFFFFF" align="center"><span class="tabletext">%d</td>',$balance);
             }

          }
          }
?>
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

$numrows = $newreport->getstockgrn_count($cond,$offset,$rowsPerPage);
//$numrows = 3000;
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
    $prev = " <a href=\"discrepancygrnReport.php?page=$page&totpages=$totpages&scomp=$company_match&swonum=$wonum_match&grn=$grn_match&crn=$crn_match&sdate1=$date1_match&sdate2=$date2_match&flag=1&tcr=$total_cost_rupee&tcd=$total_cost_dollar&tcn=$total_cost_null\">[Prev]</a> ";

    $first = " <a href=\"discrepancygrnReport.php?page=1&totpages=$totpages&scomp=$company_match&swonum=$wonum_match&grn=$grn_match&crn=$crn_match&sdate1=$date1_match&sdate2=$date2_match&flag=1&tcr=$total_cost_rupee&tcd=$total_cost_dollar&tcn=$total_cost_null\">[First Page]</a> ";
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
  $next = " <a href=\"discrepancygrnReport.php?page=$page&totpages=$totpages&scomp=$company_match&swonum=$wonum_match&grn=$grn_match&crn=$crn_match&sdate1=$date1_match&sdate2=$date2_match&flag=1&tcr=$total_cost_rupee&tcd=$total_cost_dollar&tcn=$total_cost_null\">[Next]</a> ";

  $last = " <a href=\"discrepancygrnReport.php?page=$totpages&totpages=$totpages&scomp=$company_match&swonum=$wonum_match&grn=$grn_match&crn=$crn_match&sdate1=$date1_match&sdate2=$date2_match&flag=1&tcr=$total_cost_rupee&tcd=$total_cost_dollar&tcn=$total_cost_null\">[Last Page]</a> ";
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
echo "<span class=\"labeltext\"><align=\"center\">";
// End additions on Dec 6,04

?>
</td>
</tr></table>
</form>
</body>
</html>
