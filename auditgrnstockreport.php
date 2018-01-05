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
$grnqty=$_REQUEST['grnqty'];
$grncost=$_REQUEST['grncost'];
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
$cond = $cond1 . ' and ' . $cond2 . ' and ' . $cond3 . ' and ' . $cond4 . ' and ' . $cond5;
//echo $cond;
// First include the class definition

include('classes/reportClass.php');
include('classes/stockClass.php');
include('classes/displayClass.php');
$newreport = new report;
$newreportstock = new stockreport;
$newdisplay = new display;
?>

<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/report.js"></script>
<html>
<head>
<title>Stock(GRN) Status Report</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">

<?php
include('header.html');

?>
<form action='auditgrnstockreport.php' method='post' enctype='multipart/form-data'>
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
   <tr><td><span class="heading"><b>Stock(GRN) Status Report</b></td>

    <td align="right"><a href="stock_costReport.php?crn=<?php echo $cim_match ?>&fdate=<?php echo $fromdate1 ?>&tdate=<?php echo $todate1 ?>"><b><img width=30px hight=50px border=0 src="images/arrow_left.png" alt="CRN Stock Report"></b></a></td>


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
<td bgcolor="#FFFFFF" align='right'><span class="pageheading"><b>
<!--<a href="" id='excel' onclick="javascript: return grn_stock_export('')">Export</a>-->
</td>
</tr>
<br>
<table style="table-layout: fixed" width=1210px border=0 cellpadding=6 cellspacing=1 bgcolor="#DFDEDF" >
        <tr>
            <td  bgcolor="#EEEFEE" align="center"><span class="heading"><b>GRN #</b></td>
            <td bgcolor="#EEEFEE" align="center"><span class="heading"><b>Received Date</b></td>
            <td  bgcolor="#EEEFEE" align="center"><span class="heading"><b>RM Type</b></td>
            <td bgcolor="#EEEFEE" align="center"><span class="heading"><b>RM Spec</b></td>
            <td  bgcolor="#EEEFEE" align="center"><span class="heading"><b>PRN</b></td>
            <td bgcolor="#EEEFEE" align="center"><span class="heading"><b>Qty To Make</b></td>
            <td  bgcolor="#EEEFEE" align="center"><span class="heading"><b>Qty Issued</b></td>
            <td  bgcolor="#EEEFEE" align="center"><span class="heading"><b>Qty Returned</b></td>
            <td  bgcolor="#EEEFEE" align="center"><span class="heading"><b>Balance<br>(qtm+ret-woqty)</b></td>
            <td  bgcolor="#EEEFEE" align="center"><span class="heading"><b>Unit<br>RM Price ($)</b></td>
            <td  bgcolor="#EEEFEE" align="center"><span class="heading"><b>Balance<br>Cost ($)</b></td>
        </tr>
</table>
<div style="width:1230px; height:400; overflow:auto;border:" id="dataList">

<table style="table-layout: fixed" width=1210px border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >

<?php

        $total_issued_cost = 0;
        $total_balance_cost = 0;
        $total_balance_cost_rupee = 0;
        $total_balance_cost_dollar = 0;
        $total_balance_cost_null = 0;   $to_bal=0;$to_wbal=0;$to_wrbal=0; $total_grn_qty=0;
        $tot_balance_cost_rupee = 0;
        $tot_balance_cost_dollar = 0;
        $tot_balance_cost_null = 0;   $to_balto=0;$to_wbalto=0;$to_wrbalto=0; $tot_grn_qty=0;  $flag=0;
        $result = $newreportstock->get_stockbygrn($cond,$offset,$rowsPerPage);
        if($flag==0)
        {
          $resultto = $newreportstock->get_stockbygrntot($cond);
          while ($myrowto = mysql_fetch_row($resultto))
          {
            $wo_qtyresto = $newreportstock->get_woqty($myrowto[0],$todate1);
            $woqtyrowto = mysql_fetch_row($wo_qtyresto);
            $woqtyto = $woqtyrowto[1];
            $woretqtyto = 0;
            $woqtyresto = $newreportstock->get_woqty4stock_grn($myrowto[0],$todate1);
            while($woqtyrowto = mysql_fetch_row($woqtyresto))
            {
              $woretqtyto += $woqtyrowto[2];
            }

            $balanceto = 0;
            $balanceto = $myrowto[4] + $woretqtyto - $woqtyto;
            $result4rmpriceto = $newreportstock->getrate4crn($myrowto[5]);
            $myrow4rmpriceto = mysql_fetch_row($result4rmpriceto);

            $rmpriceto = $myrow4rmpriceto[0];
            $currencyto = $myrow4rmpriceto[1];

               $tot_balance_cost_dollar += ($balanceto*$rmpriceto);

    	      $to_balto +=$myrowto[4];
		      $to_wbalto +=$woqtyto;
		      $to_wrbalto+=$woretqtyto;
    	      $tot_grn_qty = $to_balto-$to_wbalto+$to_wrbalto;
            // echo $tot_grn_qty."------------";
          }
          $flag=1;
        }
        $t_balance_cost_dollar =number_format ($tot_balance_cost_dollar,2 );
        $t_grn_qty=number_format ($tot_grn_qty,2 );
       // echo "<tr><td colspan=11 align=\"right\"><span class=\"labeltext\">Total Qty: $t_grn_qty  <br>Total Cost($) : $ $t_balance_cost_dollar </td></tr>";

        while ($myrow = mysql_fetch_row($result))
        {
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
             $wo_qtyres = $newreportstock->get_woqty($myrow[0],$todate1);
             $woqtyrow = mysql_fetch_row($wo_qtyres);
             $woqty = $woqtyrow[1];
             $woretqty = 0;
             $woqtyres = $newreportstock->get_woqty4stock_grn($myrow[0],$todate1);
             while($woqtyrow = mysql_fetch_row($woqtyres))
             {
                $woretqty += $woqtyrow[2];
             }
            $balance = 0;
            $balance = $myrow[4] + $woretqty - $woqty;
            $result4rmprice = $newreportstock->getrate4crn($myrow[5]);
            $myrow4rmprice = mysql_fetch_row($result4rmprice);

            $rmprice = $myrow4rmprice[0];
            $currency = $myrow4rmprice[1];

              $total_balance_cost_dollar += ($balance*$rmprice);
            if($balance != 0)
            {
        //    if($myrow[6] == 'YES' || $myrow[6] == 'Yes' || $myrow[6] == 'yes' || $myrow[6] == 'Y' || $myrow[6] == 'y')
       //     {
              printf('<tr><td bgcolor="#FFFFFF" align="center"><span class="tabletext">%s</td>
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
                      wordwrap($myrow[3],"15","<br>\n",true),
                      $myrow[5],
                      $myrow[4],
		       $woqty,
		       $woretqty);
		       $total_issued_cost += $woqty * $rmprice;
		       $total_balance_cost += ($balance*$rmprice);
		   /*   }
		      else 
		      {
		       printf('<tr><td bgcolor="#FFFFFF" align="center"><span class="tabletext">%s</td>
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
                      $myrow[4],
		              $woqty,
		              $woretqty);
		     }*/
		      $to_bal +=$myrow[4];
		      $to_wbal +=$woqty;
		      $to_wrbal+=$woretqty;
		      $total_grn_qty = $to_bal-$to_wbal+$to_wrbal;
             if ($balance < 0)
             {
                printf('<td bgcolor="#FF0000" align="center"><span class="tabletext">%d</td>',$balance);
             }
             else
             {
                printf('<td bgcolor="#FFFFFF" align="center"><span class="tabletext">%d</td>',$balance);
             }
             if($myrow[6] == 'YES' || $myrow[6] == 'Yes' || $myrow[6] == 'yes' || $myrow[6] == 'Y' || $myrow[6] == 'y')
             {
              printf('<td bgcolor="#FFFFFF" align="center"><span class="tabletext">%.2f</td>',$rmprice);

              printf('<td bgcolor="#FFFFFF" align="right"><span class="tabletext">
			        %s</td>',number_format($balance*$rmprice));
             }
             else
             {
              printf('<td bgcolor="#FFFFFF" align="center"><span class="tabletext">NA</td>');
              printf('<td bgcolor="#FFFFFF" align="right"><span class="tabletext">NA</td>');
             }
             }
          }
         // echo $to_bal."-----".$to_wbal."----".$to_wrbal."<br>";
$prcst=number_format ($total_balance_cost_dollar,2 );
?>
</td></tr>
<tr>
<td bgcolor="#FFFFFF" colspan=8 align="right"><span class="heading"><b>Total</b></td>
<?php

printf('<td bgcolor="#FFFFFF" colspan=1 align="center"><span class="tabletext">%d</td>',$grnqty);
printf('<td bgcolor="#FFFFFF" colspan=1 align="right"><span class="tabletext">%s </td>','&nbsp;');
printf('<td bgcolor="#FFFFFF" colspan=1 align="right"><span class="tabletext">%s</td>',number_format($grncost));
?>
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
    $prev = " <a href=\"auditgrnstockreport.php?page=$page&totpages=$totpages&scomp=$company_match&swonum=$wonum_match&grn=$grn_match&crn=$crn_match&sdate1=$date1_match&sdate2=$date2_match&flag=1&tcr=$total_cost_rupee&tcd=$total_cost_dollar&tcn=$total_cost_null\">[Prev]</a> ";

    $first = " <a href=\"auditgrnstockreport.php?page=1&totpages=$totpages&scomp=$company_match&swonum=$wonum_match&grn=$grn_match&crn=$crn_match&sdate1=$date1_match&sdate2=$date2_match&flag=1&tcr=$total_cost_rupee&tcd=$total_cost_dollar&tcn=$total_cost_null\">[First Page]</a> ";
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
  $next = " <a href=\"auditgrnstockreport.php?page=$page&totpages=$totpages&scomp=$company_match&swonum=$wonum_match&grn=$grn_match&crn=$crn_match&sdate1=$date1_match&sdate2=$date2_match&flag=1&tcr=$total_cost_rupee&tcd=$total_cost_dollar&tcn=$total_cost_null\">[Next]</a> ";

  $last = " <a href=\"auditgrnstockreport.php?page=$totpages&totpages=$totpages&scomp=$company_match&swonum=$wonum_match&grn=$grn_match&crn=$crn_match&sdate1=$date1_match&sdate2=$date2_match&flag=1&tcr=$total_cost_rupee&tcd=$total_cost_dollar&tcn=$total_cost_null\">[Last Page]</a> ";
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
