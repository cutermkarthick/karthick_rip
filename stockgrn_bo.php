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

date_default_timezone_set('Asia/Calcutta');
 $todate1 = date("Y-m-d");
 $today = split('-',$todate1);
$days = $today[2]-1;
$fromdate1 = date("Y-m-d",strtotime("-$days days"));

// For paging - Added on Dec 6,04

// how many rows to show per page
$rowsPerPage = 3000;

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

 $condw1 = "to_days(w.assydate) " . ">= to_days('" . $fromdate1 . "')";
 $condw2 = "to_days(w.assydate) " . "<= to_days('" . $todate1 . "')";
 $condw= $condw1 . ' and ' . $condw2;
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
   $condw = "(to_days(w.assydate)-to_days('1582-01-01') > 0 ||
                    w.assydate = '0000-00-00' ||
                    w.assydate = 'NULL' ) and
           (to_days(w.assydate)-to_days('2050-12-31') < 0 ||
                    w.assydate = '0000-00-00' ||
                    w.assydate = 'NULL')";
  } else
  {
    //echo"-----9999here<br>";
     $cond31 = "to_days(grn.recieved_date) " . ">= to_days('" . $fdate . "')";
     $cond32 = "to_days(grn.recieved_date) " . "<= to_days('" . $tdate . "')";
     $condw1 = "to_days(w.assydate) " . ">= to_days('" . $fdate . "')";
     $condw2 = "to_days(w.assydate) " . "<= to_days('" . $tdate . "')";
     $cond3=$cond32;
     $condw=$condw2;
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

if($crn !='')
{
 $cond5 = "(grn.crn like '".$crn."%')";
 $cim_match=$crn;
}else
{

 $cond5 = "(grn.crn like '%' || grn.crn is NULL)";
}

//$cond5 = "m.CIM_refnum like '%'";
$cond = $cond1 . ' and ' . $cond2 . ' and ' . $cond3 . ' and ' . $cond4 . ' and ' . $cond5;

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

if ( isset ( $_REQUEST['sdate1'] ) || isset ( $_REQUEST['sdate2'] ) )
{
     $fromdate1 = $_REQUEST['sdate1'];
     $todate1 = $_REQUEST['sdate2'];
     if ( isset ( $_REQUEST['sdate1']) &&  $_REQUEST['sdate1'] != '' )
     {
          $date1 = $_REQUEST['sdate1'];
          $cond31 = "to_days(grn.recieved_date) " . ">= to_days('" . $date1 . "')";
          $condw1 = "to_days(w.assydate) " . ">= to_days('" . $date1 . "')";
     }
     else
     {
          $cond31 = "(to_days(grn.recieved_date)-to_days('1582-01-01') > 0 || grn.recieved_date = 'NULL' || grn.recieved_date = '0000-00-00')";
          $condw1 = "(to_days(w.assydate)-to_days('1582-01-01') > 0 || w.assydate = 'NULL' ||w.assydate = '0000-00-00')";
     }

     if ( isset ( $_REQUEST['sdate2'] )  &&  $_REQUEST['sdate2'] != '')
     {
          $date2 = $_REQUEST['sdate2'];
          $cond32 = "to_days(grn.recieved_date) " . "<= to_days('" . $date2 . "')";
          $condw2 = "to_days(w.assydate) " . "<= to_days('" . $date2 . "')";
     }
     else
     {
          $cond32 = "(to_days(grn.recieved_date)-to_days('2050-12-31') < 0 || grn.recieved_date = 'NULL'
                       || grn.recieved_date = '0000-00-00')";
                        $condw2 = "(to_days(w.assydate)-to_days('2050-12-31') < 0 || w.assydate = 'NULL'
                       || w.assydate = '0000-00-00')";
     }
     $cond3 = $cond31 . ' and ' . $cond32;
     $condw = $condw1 . ' and ' . $condw2;
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
$cond = $cond1 . ' and ' . $cond2 . ' and ' . $cond3 . ' and ' . $cond4 . ' and ' . $cond5;
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
<title>Stock(GRN) - BoughtOut & Consummables Status Report</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">

<?php
include('header.html');

?>
<form action='stockgrn_bo.php' method='post' enctype='multipart/form-data'>
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
  <table width=100% border=0 class="stdtable1">
  <!--  <tr><td><span class="heading"><b>Stock(GRN) Status Report</b></td>

    <td align="right"><a href="stock_costReport.php?crn=<?php echo $cim_match ?>&fdate=<?php echo $fromdate1 ?>&tdate=<?php echo $todate1 ?>"><b><img src="images/arrow_left.png" alt="CRN Stock Report"></b></a></td>


<tr><td> -->
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
<td bgcolor="#FFFFFF"><span class="labeltext"><b>Raw Mtl Spec &nbsp</b></td>
<td  bgcolor="#FFFFFF"><span class="labeltext">like</td>
<td bgcolor="#FFFFFF"><input type="text" name="scomp" id="scomp" size=20 value="<?php echo $company_match ?>" onKeyPress="javascript: return checkenter(event)">
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
</td>
<td  colspan=3 bgcolor="#FFFFFF"><input type="text" name="swonum" id="swonum" size=20 value="<?php echo $wonum_match ?>" onKeyPress="javascript: return checkenter(event)">
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

</tr>

</table>

</td></tr>
    </tr>
   </table>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable">
        <tr>
        <thead>
            <th width="5%" class="head0" align="center"><span class="heading"><b>GRN #</b></th>
            <th width="5%" class="head1" align="center"><span class="heading"><b>Received Date</b></th>
            <th width="7%" class="head0" align="center"><span class="heading"><b>RM Type</b></th>
            <th width="7%" class="head1" align="center"><span class="heading"><b>RM Spec</b></th>
            <th width="5%" class="head0" align="center"><span class="heading"><b>PRN</b></th>
			<th width="5%" class="head1" align="center"><span class="heading"><b>Partnum</b></th>
			<th width="5%" class="head0" align="center"><span class="heading"><b>Part Desc</b></th>
            <th width="5%" class="head1" align="center"><span class="heading"><b>QTM</b></th>
            <th width="5%" class="head0" align="center"><span class="heading"><b>Qty <br>Iss</b></th>
            <th width="5%" class="head1" align="center"><span class="heading"><b>Qty <br>Ret</b></th>
            <th width="5%" class="head0" align="center"><span class="heading"><b>Balance<br>(qtm+ret-woqty)</b></th>
        </tr>

<?php
$conversionrate=0;

        $convert_array=array(55,54,54,53,56,56,55,56,56,56,56,55);

        $total_issued_cost = 0;
        $total_balance_cost = 0;
        $total_balance_cost_rupee = 0;
        $total_balance_cost_dollar = 0;
        $total_balance_cost_null = 0;
        $total_conversion=0;
        $result = $newreport->get_stockbygrn4dir4bo($cond,$offset,$rowsPerPage);
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

            $datecheck=split('-',$myrow[1]);
        $d=$datecheck[2];
        $m=$datecheck[1];
        $y=$datecheck[0];
        //echo "HERE1----$m---$y---<br>";
        if(($m>='04' && $y=='2012')||(($m>='01'&&$m<='03') && $y=='2013'))
        {
           $ind=substr($m,1);
          //echo "HERE----$ind---$y---<br>";
          $conversionrate=$convert_array[$ind-1];
          //echo "HERE44---$conversionrate----$m---$y---<br>";

        }else if(($m>='04' && $y=='2011')||(($m>='01' && $m<='03') && $y=='2012'))
        {
          $conversionrate=48.3;
          //echo "HERE48---$conversionrate----$m---$y---<br>";
        }else if(($m>='04' && $y=='2010')||(($m>='01' && $m<='03') && $y=='2011'))
        {
           $conversionrate=46.25;
        }
        else if(($m>='04' && $y=='2009')||(($m>='01' && $m<='03') && $y=='2010'))
        {
           $conversionrate=48.38;
        }  else
        {
           $conversionrate=45;
        }

            $balance = 0;

            $woqtyres = $newreport->get_woqty_new4bo($myrow[0],$condw);
            $woqtyrow = mysql_fetch_row($woqtyres);
            $woqty = $woqtyrow[1];
            $woretqtyres = $newreport->get_woretqty_new4bo($myrow[0],$condw);
            $woretqtyrow = mysql_fetch_row($woretqtyres);
            $woretqty = $woretqtyrow[1];
           /* $rm_price4bo = $newreport->get_rmprice4bo($myrow[11]);
            $rm_price4borows = mysql_fetch_row($rm_price4bo);
            $rm_price = $rm_price4borows[1]; */

            $balance = 0;
           // echo $myrow[4]."--**--". $woqty ."---**----".$woretqty."---<br>";
            $balance = $myrow[4] - $woqty + $woretqty ;
           /* $result4rmprice = $newreport->getrmprice($myrow[5]);
            $myrow4rmprice = mysql_fetch_row($result4rmprice); */
            $currency = array("$");
            $rm_price = str_replace($currency, "", $myrow[9]);
            if($myrow[11]!=0 && $myrow[11] !="")
            {
              $rmprice = ($rm_price/$myrow[11]);
            } else
            {
             $rmprice = ($rm_price);
            }

           //echo $rm_price."---***----".$myrow[11]."<br>";
            $currency = $myrow[10];
            if($currency == '$')
            {
              $total_balance_cost_dollar += ($balance*$rmprice);
            }
            else if($currency == 'Rs')
            {
              $total_balance_cost_rupee += ($balance*$rmprice);
            }
            else if($currency == '')
            {
              $total_balance_cost_null += ($balance*$rmprice);
            }
            $total_conversion+=($balance*$rmprice*$conversionrate);
          if ($balance > 0) {
            //if($myrow[6] == 'YES' || $myrow[6] == 'Yes' || $myrow[6] == 'yes' || $myrow[6] == 'Y' || $myrow[6] == 'y')
            //{
              printf('<tr><td bgcolor="#FFFFFF" align="center"><span class="tabletext">%s</td>
                    <td bgcolor="#FFFFFF" align="center"><span class="tabletext">%s</td>
					<td bgcolor="#FFFFFF" align="center"><span class="tabletext">%s</td>
					<td bgcolor="#FFFFFF" align="center"><span class="tabletext">%s</td>
                    <td bgcolor="#FFFFFF" align="center"><span class="tabletext">%s</td>
                    <td bgcolor="#FFFFFF" align="center"><span class="tabletext">%s</td>
                    <td bgcolor="#FFFFFF" align="center"><span class="tabletext">%s</td>
                    <td bgcolor="#FFFFFF" align="center"><span class="tabletext">%d</td>
                    <td bgcolor="#FFFFFF" align="center"><span class="tabletext">%d</td>
                    <td bgcolor="#FFFFFF" align="center"><span class="tabletext">%d</td>',
                      $myrow[0],
                      $recddate,
                      $myrow[2],
                      $myrow[3],
					  $myrow[5],
					  $myrow[12],
                      $myrow[13],
                      $myrow[4],
		              $woqty,
		              $woretqty);
		       $total_issued_cost += $myrow[7] * $rmprice;
		       $total_balance_cost += ($balance*$rmprice);
		      //}
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
<!-- <td width="6"><img src="images/spacer.gif " width="6"></td>
</tr>
<tr bgcolor="DEDFDE">
<td width="6"><img src="images/box-left-bottom.gif"></td>
<td><img src="images/spacer.gif " height="6"></td>
<td width="6"><img src="images/box-right-bottom.gif"></td>
</tr>
</table> -->


<table border = 0 cellpadding=0 cellspacing=0 width=100% >
<tr>
	<td align=left>
  <?php
//  Added on Dec 6,04 for paging

$numrows = $newreport->get_stockbygrn4dir4bo_count($cond,$offset,$rowsPerPage);
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
    $prev = " <a href=\"stockgrn_bo.php?page=$page&totpages=$totpages&scomp=$company_match&swonum=$wonum_match&grn=$grn_match&crn=$crn_match&sdate1=$date1_match&sdate2=$date2_match&flag=1&tcr=$total_cost_rupee&tcd=$total_cost_dollar&tcn=$total_cost_null\">[Prev]</a> ";

    $first = " <a href=\"stockgrn_bo.php?page=1&totpages=$totpages&scomp=$company_match&swonum=$wonum_match&grn=$grn_match&crn=$crn_match&sdate1=$date1_match&sdate2=$date2_match&flag=1&tcr=$total_cost_rupee&tcd=$total_cost_dollar&tcn=$total_cost_null\">[First Page]</a> ";
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
  $next = " <a href=\"stockgrn_bo.php?page=$page&totpages=$totpages&scomp=$company_match&swonum=$wonum_match&grn=$grn_match&crn=$crn_match&sdate1=$date1_match&sdate2=$date2_match&flag=1&tcr=$total_cost_rupee&tcd=$total_cost_dollar&tcn=$total_cost_null\">[Next]</a> ";

  $last = " <a href=\"stockgrn_bo.php?page=$totpages&totpages=$totpages&scomp=$company_match&swonum=$wonum_match&grn=$grn_match&crn=$crn_match&sdate1=$date1_match&sdate2=$date2_match&flag=1&tcr=$total_cost_rupee&tcd=$total_cost_dollar&tcn=$total_cost_null\">[Last Page]</a> ";
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
