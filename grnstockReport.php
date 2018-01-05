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

$cond1 = "grn.raw_mat_spec like '%'";
$cond2 = "grn.raw_mat_type like '%'";


$cond4 = "grn.grnnum like '%'";
$cond8 = "rm.rm_bars_plates like '%'";

if($crn !='')
{
 $cond5 = "(grn.crn like '".$crn."%')";
 $cim_match=$crn;
}else
{
 $cond5 = "(grn.crn like '%' || grn.crn is NULL)";
}

//$cond5 = "m.CIM_refnum like '%'";
$cond =$cond5 . ' and ' . $cond2 .' and '. $cond8;
$cond4all= $cond3 . ' and ' . $cond2 .' and '. $cond8;

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
if ( isset ( $_REQUEST['tcd'] ) )
{
     $total_cost_dollar = $_REQUEST['tcd'];
}
else
{
     $total_cost_dollar = 0;
}

if ( isset ( $_REQUEST['tcr'] ) )
{
     $total_cost_rupee = $_REQUEST['tcr'];
}
else
{
     $total_cost_rupee = 0;
}
if ( isset ( $_REQUEST['tcn'] ) )
{
     $total_cost_null = $_REQUEST['tcn'];
}
else
{
     $total_cost_null = 0;
}

if ( isset ( $_REQUEST['scomp'] ) )
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
}
if ( isset ( $_REQUEST['barplate'] ) )
{
     $barplate_match = $_REQUEST['barplate'];
     if ( isset ( $_REQUEST['barplate_oper'] ) ) {
          $oper3 = $_REQUEST['barplate_oper'];
     }
     else {
         $oper3 = 'like';
     }
     if ($oper3 == 'like') {
         $barplate = "'" . $_REQUEST['barplate'] . "%" . "'";
     }
     else {
         $barplate = "'" . $_REQUEST['barplate'] . "'";
     }

     $cond8 = "rm.rm_bars_plates " . $oper3 . " " . $barplate;

}
else {
     $barplate_match = '';
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

$cond =$cond5 . ' and ' . $cond2 .' and '. $cond8;
$cond4all= $cond5 . ' and ' . $cond2 .' and '. $cond8;
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
<title>GRN Stock Report</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">

<?php
include('header.html');

?>
<form action='grnstockReport.php' method='post' enctype='multipart/form-data'>
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
   <tr><td><span class="heading"><b>GRN Stock Report</b></td>
<tr><td>


<tr>
<td bgcolor="#FFFFFF" align='right'><span class="pageheading"><b>
</td>
</tr>

<table align="center" width="770px" border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
<tr>
<td bgcolor="#F5F6F5" ><span class="heading"><b><center>Search Criteria</center></b>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

<span class="tabletext">
<input type="image" name="Submit" src="images/bu-get.gif" value="Get"
            onclick="javascript: return searchsort_stockgrn()">
</tr>
<tr>
<td bgcolor="#FFFFFF"><span class="labeltext"><b>PRN</b>
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
<span class="labeltext"><b>Raw Matl Type</b><span class="tabletext">
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
<input type="text" name="swonum" id="swonum" size=20 value="<?php echo $wonum_match ?>" onKeyPress="javascript: return checkenter(event)">
<span class="labeltext"><b>Bar/Plates&nbsp&nbsp</b><span class="tabletext">
   <select name="barplate_oper" size="1" width="100">
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
<input type="text" name="barplate" id="barplate" size=20 value="<?php echo $barplate_match ?>" onKeyPress="javascript: return checkenter(event)">
</td></tr> <tr>
<td bgcolor="#FFFFFF" align='right'><span class="pageheading"><b>
<a href="rmgrnstockExport.php?crn=<?php echo $cim_match ?>&barplate=<?php echo $barplate_match ?>&rm_mat_type=<?php echo $wonum_match ?>" >Export</a>
</td>
</tr>
<tr bgcolor="#FFFFFF">
<td>
<table  width="870px" border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
        <tr>
        <td width="100px" bgcolor="#EEEFEE" align="center"><span class="heading"><b>PRN</b></td>
         <td width="250px" bgcolor="#EEEFEE" align="center"><span class="heading"><b>RM Type</b></td>
         <td width="60px" bgcolor="#EEEFEE" align="center"><span class="heading"><b>Balance</b></td>
	     <td width="60px" bgcolor="#EEEFEE" align="center"><span class="heading"><b>Rate</b></td>
         <td width="200px" bgcolor="#EEEFEE" align="center"><span class="heading"><b>Value</b></td>
         <td width="200px" bgcolor="#EEEFEE" align="center"><span class="heading"><b>Conversion<br>Value</b></td>
         
        </tr>
        </table>
<div style="width:890px; height:270; overflow:auto;border:" id="dataList">
<table width="870px" border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
<?php
$total_dollar_cost=0;  $total_dollar_cost_others=0;  $total_print=0;  $rmpo_qty_tot=0;  $pricetoprint_tot=0;$total_print_convert=0;
$prev_rmtype="#";
$typearr=array("aluminium","titanium","bronze","steel","Others");
//for($i=0;$i<count($typearr);$i++)
//{
$resultall = $newreport->getoverallstock4rm($cond,$typearr[$i]);
        while($myrowall = mysql_fetch_row($resultall))
        {
           //if()
          //{
          
         // }
         //echo $prev_rmtype."------". $myrowall[0]."<br>";
          $total_print+=($myrowall[1]*$myrowall[3]);
          $total_print_convert+=($myrowall[1]*$myrowall[3]*50);
          //if(trim($prev_rmtype)!=trim($myrowall[0]))
          //{//echo "HERE---$prev_rmtype<br>";
          //$total_print+=($myrowall[1]*$myrowall[3]);
          printf('<tr><td width="100px" bgcolor="#FFFFFF" ><span class="tabletext">%s</td>',$myrowall[4]);
          printf('<td width="240px" bgcolor="#FFFFFF" ><span class="tabletext">%s - %s</td>',$myrowall[0],$myrowall[2]);
          printf('<td width="60px" align="right" bgcolor="#FFFFFF" ><span class="tabletext">%d</td>',$myrowall[3]);
		  printf('<td width="60px" align="right" bgcolor="#FFFFFF" ><span class="tabletext">%.2f</td>',$myrowall[1]);
          printf('<td bgcolor="#FFFFFF"  align="right" width="200px" ><span class="tabletext">%s%s</td>','$ ',number_format(($myrowall[1]*$myrowall[3]),2,'.',','));
          printf('<td bgcolor="#FFFFFF"  align="right" width="200px" ><span class="tabletext">%s%s</td>','Rs ',number_format(($myrowall[1]*$myrowall[3]*50),2,'.',','));
           $prev_rmtype=$myrowall[0];
          //}
          //else
          //{
            //$total_print+=($myrowall[1]*$myrowall[3]);
          //}
          		  echo "</tr>";
        }
         printf('<tr><td  colspan=4 bgcolor="#FFFFFF"><span class="tabletext">Total:</span></td>');
         printf('<td bgcolor="#FFFFFF" align="right"  ><span class="tabletext">%s%s</td>','$ ',number_format($total_print,2,'.',','));
          printf('<td bgcolor="#FFFFFF" align="right"  ><span class="tabletext">%s%s</td>','Rs ',number_format($total_print_convert,2,'.',','));

?>

</table>
</div>
</td></tr>
</table>
<br><br>
<table>
</table>

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

//$numrows = $newreport->getstockgrn_count($cond,$offset,$rowsPerPage);
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
    $prev = " <a href=\"grnstockReport.php?page=$page&totpages=$totpages&scomp=$company_match&swonum=$wonum_match&grn=$grn_match&crn=$crn_match&sdate1=$date1_match&sdate2=$date2_match&flag=1&tcr=$total_cost_rupee&tcd=$total_cost_dollar&tcn=$total_cost_null\">[Prev]</a> ";

    $first = " <a href=\"grnstockReport.php?page=1&totpages=$totpages&scomp=$company_match&swonum=$wonum_match&grn=$grn_match&crn=$crn_match&sdate1=$date1_match&sdate2=$date2_match&flag=1&tcr=$total_cost_rupee&tcd=$total_cost_dollar&tcn=$total_cost_null\">[First Page]</a> ";
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
  $next = " <a href=\"grnstockReport.php?page=$page&totpages=$totpages&scomp=$company_match&swonum=$wonum_match&grn=$grn_match&crn=$crn_match&sdate1=$date1_match&sdate2=$date2_match&flag=1&tcr=$total_cost_rupee&tcd=$total_cost_dollar&tcn=$total_cost_null\">[Next]</a> ";

  $last = " <a href=\"grnstockReport.php?page=$totpages&totpages=$totpages&scomp=$company_match&swonum=$wonum_match&grn=$grn_match&crn=$crn_match&sdate1=$date1_match&sdate2=$date2_match&flag=1&tcr=$total_cost_rupee&tcd=$total_cost_dollar&tcn=$total_cost_null\">[Last Page]</a> ";
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
