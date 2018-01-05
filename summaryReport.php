<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = Feb 24,2012                  =
// Filename: consumptionReport.php             =
// Copyright of Badari Mandyam, FluentSoft     =
// Revision: v1.0 OMS                          =
// Displays list of stock consumption          =
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

// First include the class definition
include_once('classes/userClass.php');
include_once('classes/reportClass.php');
include_once('classes/displayClass.php');
include_once('classes/consumptionClass.php');

$newlogin = new userlogin;
$newlogin->dbconnect();

$newconsumption = new report;
$newdisplay = new display;
$newconsumption = new consumption;

$rowsPerPage = 30;

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

date_default_timezone_set('Asia/Calcutta');
 $todate1 = date("Y-m-d");

$today = split('-',$todate1);
$days = '2007-01-01';
$fromdate1 = date("Y-m-d",strtotime($days));

$cond0 = "crn like '%'";
$cond1 = "invoice_num like '%'";
$cond2 = "(bond_num like '%' || bond_num is null)";
$cond3 = "(be_num like '%' || be_num is null)";
$cond6 = "(rmtype like '%' || rmtype is null)";
$cond5 = "(description like '%' || description is null)";
$cond7 = "grnnum like '%'";
$cond01 = "to_days(grn_date) " . ">= to_days('" . $fromdate1 . "')";
$cond02 = "to_days(grn_date) " . "<= to_days('" . $todate1 . "')";
$cond8 = "(status like '%' || status is NULL || status = '')";
$cond4= $cond01 . ' and ' . $cond02;
$cond9 = "expinvnum like '%'";
//$cond2 = "(cn.status like '%' || cn.status is NULL)";

$cond =$cond4 . ' and ' . $cond3 . ' and ' . $cond6;

$final_insprecnum='';
$oper1='like';
$oper2='like';
$oper3='like';
$oper4='like';
$oper5='like';
$oper6='like';
$oper7='like';
$sort1='refnum';


if ( isset ( $_REQUEST['final_wono'] ) )
{
     $wono_match = $_REQUEST['final_wono'];
     if ( isset ( $_REQUEST['wono_oper'] ) ) {
          $oper2 = $_REQUEST['wono_oper'];
     }
     else {
         $oper2 = 'like';
     }
     if ($oper2 == 'like') {
         $final_wono = "'" . $_REQUEST['final_wono'] . "%" . "'";
     }
     else {
         $final_wono = "'" . $_REQUEST['final_wono'] . "'";
     }

     $cond1 = "invoice_num " . $oper2 . " " . $final_wono;

}
else {
     $wono_match = '';
}


if ( isset ( $_REQUEST['sdate1'] ) || isset ( $_REQUEST['sdate2'] ) )
{
     $fromdate1 = $_REQUEST['sdate1'];
     $todate1 = $_REQUEST['sdate2'];
     if ( isset ( $_REQUEST['sdate1']) &&  $_REQUEST['sdate1'] != '' )
     {
          $date1 = $_REQUEST['sdate1'];
          $cond01 = "to_days(grn_date) " . ">= to_days('" . $date1 . "')";
     }
     else
     {
          $cond01 = "(to_days(grn_date)-to_days('1582-01-01') > 0 || grn_date is NULL || grn_date = '0000-00-00')";
     }

     if ( isset ( $_REQUEST['sdate2'] )  &&  $_REQUEST['sdate2'] != '')
     {
          $date2 = $_REQUEST['sdate2'];
          $cond02 = "to_days(grn_date) " . "<= to_days('" . $date2 . "')";
     }
     else
     {
          $cond02 = "(to_days(grn_date)-to_days('2050-12-31') < 0 || grn_date is NULL || grn_date = '0000-00-00')";
     }
     $cond4 = $cond01 . ' and ' . $cond02;

}
else
{
      $fromdate1 = $fromdate1;
      $todate1 = $todate1;
}


if ( isset ( $_REQUEST['final_beno'] ) )
{
     $finalbe_match = $_REQUEST['final_beno'];
     if ( isset ( $_REQUEST['be_oper'] ) ) {
          $oper4 = $_REQUEST['be_oper'];
     }
     else {
         $oper4 = 'like';
     }
     if ($oper4 == 'like') {
         $final_beno = "'" . $_REQUEST['final_beno'] . "%'" ;
         $cond3 = "(be_num " . $oper4 . " " . $final_beno.")";
     }
     else {
         $final_beno = "'" . $_REQUEST['final_beno'] . "'";
         $cond3 = "(be_num " . $oper4 . " " . $final_beno.")";
     }
      if($_REQUEST['final_beno']=='')
      {
      $cond3 = "(be_num like '%' || be_num is null)";
      }

}
else {
     $finalbe_match = '';

}

if ( isset ( $_REQUEST['final_rmtype'] ) )
{
     $finalrmtype_match = $_REQUEST['final_rmtype'];
     if ( isset ( $_REQUEST['rmt_oper'] ) ) {
          $oper5 = $_REQUEST['rmt_oper'];
     }
     else {
         $oper5 = 'like';
     }
     if ($oper5 == 'like') {
         $final_rmtype = "'" . $_REQUEST['final_rmtype'] . "%'" ;
         $cond6= "(rmtype " . $oper5 . " " . $final_rmtype.")";
     }
     else {
         $final_rmtype = "'" . $_REQUEST['final_rmtype'] . "'";
         $cond6 = "(rmtype " . $oper5 . " " . $final_rmtype.")";
     }
      if($_REQUEST['final_rmtype']=='')
      {
      $cond6 = "(rmtype like '%' || rmtype is null)";
      }

}
else {
     $finalrmtype_match = '';

}


$cond =$cond4 . ' and ' . $cond3 . ' and ' . $cond6;

$userrole = $_SESSION['userrole'];
$dept = $_SESSION['department'];

// echo $cond;
// how many rows to show per page


 //echo $offset;

?>
<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/report.js"></script>

<html>
<head>
<title>Consumption Report</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">
<form action='summaryReport.php' method='post' enctype='multipart/form-data'>
<?php

 include('header.html');

?>
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
			<table width=100% border=0 cellpadding=0 cellspacing=0>
				<tr><td></td></tr>
				<tr>
					<td>
<?php $newdisplay->dispLinks(''); ?>
</td></tr>
<table width=100% border=0 cellpadding=0 cellspacing=0>
  <tr bgcolor="DEDFDE"><td width="6"><img src="images/spacer.gif " width="6"></td>
	    <td bgcolor="#FFFFFF">
 <table width=100% border=0 cellpadding=6 cellspacing=0>
     <tr><td>
          <tr><td><span class="heading"><i>Please click on the appropriate link to Edit/Delete</i></td></tr>
		</tr>
  <tr>
<td>

<table width=100% border=0 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF">
  <tr>
	<td bgcolor="#F5F6F5" colspan="8"><span class="heading"><b><center>Search & SortCriteria</center></b></td>
    <td bgcolor="#FFFFFF" rowspan=4 align="center">
	<input type= "image" name="submit" src="images/bu-get.gif" value="Get" onclick="javascript: return searchsort_fields4cons()">


<input type="hidden" name="refno_oper">
<input type="hidden" name="wono_oper">
<input type="hidden" name="cust_oper">
<input type="hidden" name="partno_oper">
<input type="hidden" name="pono_oper">
	</td>
  </tr>
<tr>
<td bgcolor="#FFFFFF"><span class="labeltext"><b>GRN Date:  From &nbsp&nbsp</b>
        <input type="text" name="sdate1" id="sdate1" size=10 value="<?php echo $fromdate1 ?>"
         onkeypress="javascript: return checkenter(event)">
        <img src="images/bu-getdateicon.gif" alt="Get Date" onclick='GetDate("sdate1")'>
         <span class="labeltext"><b>&nbsp;&nbsp;To</b>
        <input type="text" name="sdate2" id="sdate2" size=10 value="<?php echo $todate1  ?>"
         onkeypress="javascript: return checkenter(event)">
        <img src="images/bu-getdateicon.gif" alt="Get Date" onclick='GetDate("sdate2")'>
</td>
<td bgcolor="#FFFFFF"><span class="labeltext"><b>BE No</b></td>

<td bgcolor="#FFFFFF"><span class="tabletext"><select name="be_oper" size="1" width="20">
<?php
   if ( isset ( $_REQUEST['be_oper'] ) ){
          $check4 = $_REQUEST['be_oper'];

                   if ($check2 =='like'){
?>
    	            <option value="=">=
	                <option selected value="like">like
<?php
                    }else{
?>
                    <option selected value="=">=
	                <option value="like">like

 <?php
                    }
   }else{
?>
 	<option selected value="like">like
	<option value="=">=
 <?PHP
  }
 ?>
</select></td>

<td bgcolor="#FFFFFF"><input type="text" name="final_beno" size=15 value="<?php echo $finalbe_match ?>" onkeypress="javascript: return checkenter(event)">
<td bgcolor="#FFFFFF" ><span class="labeltext"><b>RM Type</b>
<select name="bondno_oper" size="1" width="20">
<?php
   if ( isset ( $_REQUEST['rmt_oper'] ) ){
          $check6 = $_REQUEST['rmt_oper'];

                   if ($check6 =='like'){
?>
    	            <option value="=">=
	                <option selected value="like">like
<?php
                    }else{
?>
                    <option selected value="=">=
	                <option value="like">like

 <?php
                    }
   }else{
?>
 	<option selected value="like">like
	<option value="=">=
 <?PHP
  }
 ?>
</select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="final_rmtype" size=15 value="<?php echo $finalrmtype_match ?>" onkeypress="javascript: return checkenter(event)">
</td>
</tr>
	</table>
	</td></tr>
	<tr><td>
<table width=100% border=0>
  <tr>
  <td><span class="pageheading"><b>Consumption Report</b></td>
  </tr>
</table>

<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
        <tr  bgcolor="#FFCC00">
           <td   bgcolor="#EEEFEE"><span class="tabletext"><b>BOND #</b></td>
		   <td   bgcolor="#EEEFEE"><span class="tabletext"><b>BOND <br>Dt</b></td>
            <td   bgcolor="#EEEFEE"><span class="tabletext"><b>BE #</b></td>
			<td   bgcolor="#EEEFEE"><span class="tabletext"><b>BE<br>Dt</b></td>
			<td    bgcolor="#EEEFEE"><span class="tabletext"><b>Assess.<br>Value</b></td>
			<td   bgcolor="#EEEFEE"><span class="tabletext"><b>Duty<br>Amount</b></td>
			 <td  bgcolor="#EEEFEE" "><span class="tabletext"><b>RM Type</b></td>
		    <!--<td   bgcolor="#EEEFEE"><span class="tabletext"><b>Invoice #</b></td>
		     <td bgcolor="#EEEFEE"><span class="tabletext"><b>Invoice Qty</b></td>
            <td  bgcolor="#EEEFEE" "><span class="tabletext"><b>Inv Dt</b></td>
            <td   bgcolor="#EEEFEE"><span class="tabletext"><b>Inv Amt</b></td>
            <td  bgcolor="#EEEFEE"><span class="tabletext"><b>Inv Duty Amt.</b></td>
             <td  bgcolor="#EEEFEE"><span class="tabletext"><b>Inv Assess Amt.</b></td>  -->
           </tr>


<?php
//recnum, invoice_num, grnnum, grn_date, ponum, description, qty_recd, qty_cons, create_date, modified_date, crn,
// status, closingbal, invoice_date, cofc_num, bond_num, be_num, grnwonum, company, rmtype, uom
             $prevgrnnum="#";  $closingbal=0;  $prev_grnnum='#'; $color='';  $qty_assv4be=0;   $qty_tot4be=0;
             $prevrmtype="#";
            // echo $cond."-------";
             $result=$newconsumption->getdetailsforrmreport($cond,$offset,$rowsPerPage);
             $close_bal=0; $qty_recd=0;$qty_cons=0;$wastage=0;
            while ($myrow = mysql_fetch_array($result))
			{
                    $rmspec= wordwrap($myrow["description"],20,"<br>\n");
					$supplier = wordwrap($myrow['company'],20,"<br>\n");
                    if($myrow['grn_date'] != '0000-00-00' && $myrow['grn_date'] != 'NULL' && $myrow['grn_date'] != '')
                    {
                     $datearr = split('-', $myrow['grn_date']);
                     $d=$datearr[2];
                     $m=$datearr[1];
                     $y=$datearr[0];
                     $x=mktime(0,0,0,$m,$d,$y);
                     $gdate=date("M j, Y",$x);
                     }
                     else
                     {
                     $gdate = '';
                     }

                     if($myrow['invoice_date'] != '0000-00-00' && $myrow['invoice_date'] != 'NULL' && $myrow['invoice_date'] != '')
                    {
                     $datearr = split('-', $myrow['invoice_date']);
                     $d=$datearr[2];
                     $m=$datearr[1];
                     $y=$datearr[0];
                     $x=mktime(0,0,0,$m,$d,$y);
                     $idate=date("M j, Y",$x);
                     }
                     else
                     {
                     $idate = '';
                     }
                    //echo $prevgrnnum."----111----".$myrow[2]."----------<br>";
                    if($prevgrnnum!=$myrow['be_num'])
                    {
                      $prevgrnnum=$myrow['be_num'];
                      $qty_assv4be +=$myrow['assessval'];
                      $qty_tot4be +=$myrow['dutyamt'];
                    }
                     //echo $closingbal."----1222----".$close_bal;
    echo '<tr  bgcolor="#FFFFFF">';
	if ($myrow['bond_num'] != '')
	{
?>
      <td bgcolor="#FFCC00"><span class="tabletext"><?php echo $myrow['bond_num'] ?></a></td>
      <td ><span class="tabletext"><?php echo $myrow['bonddate'] ?></td>

<?php
    }
	else
	{
?>
      <td ><span class="tabletext">&nbsp</td>
      <td ><span class="tabletext">&nbsp</td>
<?php
	}
	if ($myrow['be_num'] != '')
	{
?>
      <td  bgcolor="00FF00"><span class="tabletext"><?php echo $myrow['be_num'] ?></a></td>
      <td ><span class="tabletext"><?php echo $myrow['bedate'] ?></td>

<?php
    }
	else
	{
?>
      <td ><span class="tabletext">&nbsp</td>
      <td ><span class="tabletext">&nbsp</td>
<?php
	}
?>

						<td ><span class="tabletext"><?php echo $myrow['assessval'] ?></td>
                        <td><span class="tabletext"><?php echo $myrow['dutyamt'] ?></td>
                        <td ><span class="tabletext"><?php echo $myrow['be_rmtype'] ?></td>
            </td></tr>
<?php
			}
?>
<tr bgcolor="#FFFFFF">
<td colspan="4" align="right" class="labeltext">Total</td>
<td  class="tabletext"><?php printf('%.2f',$qty_assv4be);?></td>
<td colspan="1"  class="tabletext"><?php printf('%.2f',$qty_tot4be);?></td>
<td colspan="1"  class="labeltext">&nbsp;</td>
</tr>
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
   $resultrows = $newconsumption->getrmdets4count($cond,$offset,$rowsPerPage);
   $numrows=mysql_num_rows($resultrows);
  // echo $numrows."-**--*-*";
   // how many pages we have when using paging?
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
    $prev = " <a href=\"summaryReport.php?page=$page&totpages=$totpages&sdate1=$fromdate1&sdate2=$todate1&final_beno=$finalbe_match&final_rmtype=$finalrmtype_match\">[Prev]</a> ";

    $first = " <a href=\"summaryReport.php?page=1&totpages=$totpages&sdate1=$fromdate1&sdate2=$todate1&final_beno=$finalbe_match&final_rmtype=$finalrmtype_match\">[First Page]</a> ";
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
    $next = " <a href=\"summaryReport.php?page=$page&totpages=$totpages&sdate1=$fromdate1&sdate2=$todate1&final_beno=$finalbe_match&final_rmtype=$finalrmtype_match\">[Next]</a> ";

    $last = " <a href=\"summaryReport.php?page=$totpages&totpages=$totpages&sdate1=$fromdate1&sdate2=$todate1&final_beno=$finalbe_match&final_rmtype=$finalrmtype_match\">[Last Page]</a> ";
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
      </FORM>
</body>
</html>

