<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = June 18, 2008                =
// Filename: rmmastersummary.php               =
// Copyright of Badari Mandyam, FluentSoft     =
// Revision: v1.0 WMS                          =
// Displays RM Master Summary list.            =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];
$_SESSION['pagename'] = 'packingsummary';
$page = "Invoice: Packing";
//////session_register('pagename');

// First include the class definition
include_once('classes/packingClass.php');
include_once('classes/displayClass.php');

$newdisplay = new display;
$newPacking= new packing;
//echo $rm_try."iuiu";
$userrole = $_SESSION['userrole'];

$cond0 = " p.packingnum like '%'";
//$cond1 = " dl.wonum like '%'";
$cond2 =  "(to_days(p.podate)-to_days('1582-01-01') > 0 ||
                   p.podate = '0000-00-00' ||
                    p.podate = 'NULL' ) and
           (to_days(p.podate)-to_days('2050-12-31') < 0 ||
                    p.podate = '0000-00-00' ||
                    p.podate = 'NULL')";
$cond3 = " p.ponum like '%'";
//$cond4 = "(d.type = 'Manufacture Only' || d.type = '' || d.type is NULL)";
$cond5 = " p.cim_invoice like '%'";

$cond = $cond0 . ' and ' . $cond2 . ' and ' . $cond3. ' and ' . $cond5;

//$final_insprecnum='';
$oper1='like';
$oper2='like';
$oper3='like';
$sort1='p.packingnum';



if ( isset ( $_REQUEST['final_relno'] ) )
{
     $finalrel_match = $_REQUEST['final_relno'];
     if ( isset ( $_REQUEST['rel_oper'] ) ) {
          $oper1 = $_REQUEST['rel_oper'];
     }
     else {
         $oper1 = 'like';
     }
     if ($oper1 == 'like') {
         $final_relno = "'" . $_REQUEST['final_relno'] . "%" . "'";
     }
     else {
         $final_relno = "'" . $_REQUEST['final_relno'] . "'";
     }

     $cond0 = "p.packingnum " . $oper1 . " " . $final_relno;

}
else {
     $finalrel_match = '';
}


if ( isset ( $_REQUEST['final_crn'] ) )
{
     $final_crnmatch = $_REQUEST['final_crn'];
     if ( isset ( $_REQUEST['crn_oper'] ) ) {
          $oper2 = $_REQUEST['crn_oper'];
     }
     else {
         $oper2 = 'like';
     }
     if ($oper2 == 'like') {
         $final_crn = "'" . $_REQUEST['final_crn'] . "%" . "'";
     }
     else {
         $final_crn = "'" . $_REQUEST['final_crn'] . "'";
     }

     $cond3 = "p.ponum " . $oper2 . " " . $final_crn;

}
else {
     $final_crnmatch = '';
}

if ( isset ( $_REQUEST['final_partnum'] ) )
{
     $final_partnummatch = $_REQUEST['final_partnum'];
     if ( isset ( $_REQUEST['partnum_oper'] ) ) {
          $oper2 = $_REQUEST['partnum_oper'];
     }
     else {
         $oper2 = 'like';
     }
     if ($oper2 == 'like') {
         $final_partnum= "'" . $_REQUEST['final_partnum'] . "%" . "'";
     }
     else {
         $final_partnum = "'" . $_REQUEST['final_partnum'] . "'";
     }

     $cond5 = "p.cim_invoice " . $oper2 . " " . $final_partnum;

}
else {
     $final_partnummatch = '';
}
if ( isset ( $_REQUEST['ddate1'] ) || isset ( $_REQUEST['ddate2'] ) )
{
     $ddate1_match = $_REQUEST['ddate1'];
     $ddate2_match = $_REQUEST['ddate2'];
     if ( isset ( $_REQUEST['ddate1']) &&  $_REQUEST['ddate1'] != '' )
     {
          $date1 = $_REQUEST['ddate1'];
          $cond21 = "to_days(p.podate) " . "> to_days('" . $date1 . "')";
     }
     else
     {
          $cond21 = "(to_days(p.podate)-to_days('1582-01-01') > 0 || p.podate = 'NULL' || p.podate = '0000-00-00')";
     }

     if ( isset ( $_REQUEST['ddate2'] )  &&  $_REQUEST['ddate2'] != '')
     {
          $date2 = $_REQUEST['ddate2'];
          $cond22 = "to_days(p.podate) " . "< to_days('" . $date2 . "')";
     }
     else
     {
          $cond22 = "(to_days(p.podate)-to_days('2050-12-31') < 0 || p.podate = 'NULL' || p.podate = '0000-00-00')";
     }
     $cond2 = $cond21 . ' and ' . $cond22;

}
else
{
     $ddate1_match = '';
     $ddate2_match = '';
}

if ( isset ( $_REQUEST['sortfld1'] ) ) {
    $sort1 = $_REQUEST['sortfld1'];

}


$cond = $cond0 . ' and ' . $cond2 . ' and ' . $cond3. ' and ' . $cond5;

// echo $cond;
// how many rows to show per page
$rowsPerPage = 10;

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
<script language="javascript" src="scripts/packing.js"></script>
<html>
<head>
<title>Packing Summary</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0" >




<form action='packingSummary.php' method='post' enctype='multipart/form-data'>
<?php

include('header.html');
?>
<!-- <table width=100% cellspacing="0" cellpadding="6" border="0">
	<tr>
		<td>
			<table width=100% border=0 cellspacing="0" cellpadding="0">
   				<tr>
        		<td colspan=2><span class="welcome"><b>Welcome <?php echo $userid ?></b></td>
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
	    <td bgcolor="#FFFFFF"> -->
 <table width=100% border=0 cellpadding=6 cellspacing=1>
     <tr><td>
          <tr><td><span class="heading"><i>Please click on the link to Edit</i></td></tr>
		</tr>
  <tr>
<td>


<table width=100% border=0 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1">
  <tr>
	<td bgcolor="#F5F6F5" colspan="4"><span class="heading"><b><center>Search Criteria</center></b></td>
    <td bgcolor="#FFFFFF" rowspan=3 align="center">
    <button class="stdbtn btn_blue" style="background-color:#0591e5" onClick="javascript: return searchsort_fields()" >Get</button>
	<!-- <input type= "image" name="submit" src="images/bu-get.gif" value="Get" onclick="javascript: return searchsort_fields()">-->

<input type="hidden" name="rel_oper">
<input type="hidden" name="wo_oper">
	</td>
  </tr>
<tr>
<td bgcolor="#FFFFFF"><span class="labeltext"><b>Packing #</b>
<span class="tabletext"><select name="rel_oper" size="1" width="20">
<?php
   if ( isset ( $_REQUEST['rel_oper'] ) ){
          $check2 = $_REQUEST['rel_oper'];

                   if ($check2 =='like'){
?>
    	            <option value>=
	                <option selected>like
<?php
                    }else{
?>
                    <option selected>=
	                <option value >like

 <?php
                    }
   }else{
?>
 	<option selected>like
	<option value>=
 <?PHP
  }
 ?>
</select>
</td>
<td bgcolor="#FFFFFF"><input type="text" name="final_relno" size=10 value="<?php echo $finalrel_match ?>" onkeypress="javascript: return checkenter(event)">
</td>

 <td bgcolor="#FFFFFF"><span class="labeltext"><b>PO #</b>
 <span class="tabletext"><select name="crn_oper" size="1" width="50">
<?php
   if ( isset ( $_REQUEST['crn_oper'] ) ){
          $check2 = $_REQUEST['crn_oper'];
                   if ($check2 =='like'){
?>
    	            <option value>=
	                <option selected>like
<?php
                    }else{
?>
                    <option selected>=
	                <option value>like

 <?php
                    }
   }else{
?>
 	<option selected>like
	<option value>=
 <?php
  }
 ?>
</select></td>

<td bgcolor="#FFFFFF"><input type="text" name="final_crn" size=20 value="<?php echo $final_crnmatch ?>" onkeypress="javascript: return checkenter(event)">
</td>

</tr>
 <tr>
 <td bgcolor="#FFFFFF"><span class="labeltext"><b>Invoice#</b></td>
<td bgcolor="#FFFFFF"><span class="tabletext"><select name="partnum_oper" size="1" width="50">
<?php
   if ( isset ( $_REQUEST['partnum_oper'] ) ){
          $check2 = $_REQUEST['partnum_oper'];
                   if ($check2 =='like'){
?>
    	            <option value>=
	                <option selected>like
<?php
                    }else{
?>
                    <option selected>=
	                <option value>like

 <?php
                    }
   }else{
?>
 	<option selected>like
	<option value>=
 <?php
  }
 ?>
</select></td>

<td bgcolor="#FFFFFF"><input type="text" name="final_partnum" size=20 value="<?php echo $final_partnummatch ?>" onkeypress="javascript: return checkenter(event)">
</td>
<td colspan=1 bgcolor="#FFFFFF"><span class="labeltext"><b>PO Date:  From &nbsp&nbsp</b>
        <input type="text" name="ddate1" size=10 value="<?php echo $ddate1_match ?>"
         onkeypress="javascript: return checkenter(event)">
        <img src="images/bu-getdateicon.gif" alt="Get Date" onclick='GetDate("ddate1")'>
         <span class="labeltext"><b>&nbsp;&nbsp;To</b>
        <input type="text" name="ddate2" size=10 value="<?php echo $ddate2_match ?>"
         onkeypress="javascript: return checkenter(event)">
        <img src="images/bu-getdateicon.gif" alt="Get Date" onclick='GetDate("ddate2")'>
</td>

</tr>

</table>
	</td></tr>
	<tr><td>
<table width=100% border=0>
<div class="contenttitle radiusbottom0">
<h2 class="table"><span>List Of P/S
 <input type="button" class="stdbtn btn_blue" style="float:right;padding:2px;margin-right:5px;" onClick="location.href='packingEntry.php'" value="New Packing"> 
 </span></h2>
  </tr>

</table>

<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable">
        <tr>
        <thead>
            <th class="head0"><span class="tabletext"><b>Packing#</b></th>
            <th class="head1"><span class="tabletext"><b>PO#</b></th>
            <th class="head0"><span class="tabletext"><b>PO Date</b></th>
            <th class="head1"><span class="tabletext"><b>Customer</b></th>
            <th class="head0"><span class="tabletext"><b>CIM Invoice No.</b></th>
       </tr>

<?php

         $result = $newPacking->getpackdetails4summary($cond,$offset,$rowsPerPage);

         while($myrow=mysql_fetch_row($result))
         {
           $d=substr($myrow[3],8,2);
           $m=substr($myrow[3],5,2);
           $y=substr($myrow[3],0,4);
           $x=mktime(0,0,0,$m,$d,$y);
           $pdate=date("M j, Y",$x);
   	       printf('<tr bgcolor="#FFFFFF">');

              printf("<td ><span class=\"tabletext\"><a href=\"packingDetails.php?recnum=%s\">%s</td>
                      <td><span class=\"tabletext\">%s</td>
                      <td><span class=\"tabletext\">%s</td>
                      <td><span class=\"tabletext\">%s</td>
           	          <td><span class=\"tabletext\">%s</td>
                        ",
		              $myrow[0],
		              $myrow[16],
                      $myrow[1],
                      $pdate,
			          $myrow[9],
			          $myrow[13]);
              printf('</td></tr>');

        }

?>
</table>
      </table>
<!--          <td width="6"><img src="images/spacer.gif " width="6"></td>
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

//Additions on Dec 29 04 by Jerry George to implement pagination

$numrows = $newPacking->getpackdetails4summarycount($cond,$offset,$rowsPerPage);
//$numrows=10;
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
    $prev = " <a href=\"packingSummary.php?page=$page&totpages=$totpages&final_relno=$finalrel_match&
	final_crn=$final_crnmatch&ddate1=$ddate1_match&ddate2=$ddate2_match&final_partnum=$final_partnummatch\">[Prev]</a> ";

    $first = " <a href=\"packingSummary.php?page=1&totpages=$totpages&final_relno=$finalrel_match&
	final_crn=$final_crnmatch&ddate1=$ddate1_match&ddate2=$ddate2_match&final_partnum=$final_partnummatch\">[First Page]</a> ";
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
    $next = " <a href=\"packingSummary.php?page=$page&totpages=$totpages&final_relno=$finalrel_match&
	final_crn=$final_crnmatch&ddate1=$ddate1_match&ddate2=$ddate2_match&final_partnum=$final_partnummatch\">[Next]</a> ";

    $last = " <a href=\"packingSummary.php?page=$totpages&totpages=$totpages&final_relno=$finalrel_match&
	final_crn=$final_crnmatch&ddate1=$ddate1_match&ddate2=$ddate2_match&final_partnum=$final_partnummatch\">[Last Page]</a> ";
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
// End additions on Dec 29,04

?>
								</td>
							</tr>
							

						</table>
      </FORM>
</body>
</html >

