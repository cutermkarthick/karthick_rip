<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = June 20, 2004                =
// Filename: dispatchSummary.php               =
// Copyright of Fluent Technologies            =
// Revision: v1.0 WMS                          =
// Displays list of Dispatchs.                 =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];
$_SESSION['pagename'] = 'dispatchSummary';
$page="Dispatch";
$dept = $_SESSION['department'];
$usertype = $_SESSION['usertype'];
// echo $usertype;
//////session_register('pagename');

// First include the class definition
include_once('classes/userClass.php');
include_once('classes/dispatchClass.php');
include_once('classes/dispatchliClass.php');
include_once('classes/displayClass.php');

$newdispatch = new dispatch;
$newdisplay = new display;


$cond0 = " d.relnotenum like '%'";
$cond1 = " dl.wonum like '%'";
$cond2 =  "(to_days(d.disp_date)-to_days('1582-01-01') > 0 ||
                   d.disp_date = '0000-00-00' ||
                    d.disp_date = 'NULL' ) and
           (to_days(d.disp_date)-to_days('2050-12-31') < 0 ||
                    d.disp_date = '0000-00-00' ||
                    d.disp_date = 'NULL')";
$cond3 = " d.crn like '%'";
$cond4 = "(d.type = 'Manufacture Only' || d.type = '' || d.type is NULL)";
$cond5 = " dl.partnum like '%'";

$cond = $cond0 . ' and ' . $cond1 . ' and ' . $cond2. ' and ' . $cond3 . ' and ' . $cond4. ' and ' . $cond5; 

//$final_insprecnum='';
$oper1='like';
$oper2='like';
$oper3='like';
$sort1='d.relnotenum';

if ( isset ( $_REQUEST['type']) )
{
     //echo '----'.$_REQUEST['status_val'];
     $val = $_REQUEST['type'];
     if ($val == 'Manufacture Only')
     {
         $cond4 = "(d.type = 'Manufacture Only' || d.type = '' || d.type is NULL)";
     }
     else if ($val == 'Post Process')
     {
         $cond4 = "d.type = 'Post Process'";
     }
	 else if ($val == 'Assembly')
     {
         $cond4 = "d.type = 'Assembly'";
     }
	 else if ($val == 'Kit')
     {
         $cond4 = "d.type = 'Kit'";
     }
	 else if ($val == 'All')
     {
         $cond4 = "d.type like '%'";
     }

}
else
{
     $val = 'All';
     $cond4 = "(d.type like '%')";
}


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

     $cond0 = "d.relnotenum " . $oper1 . " " . $final_relno;

}
else {
     $finalrel_match = '';
}


if ( isset ( $_REQUEST['final_wo'] ) )
{
     $final_womatch = $_REQUEST['final_wo'];
     if ( isset ( $_REQUEST['wo_oper'] ) ) {
          $oper2 = $_REQUEST['wo_oper'];
     }
     else {
         $oper2 = 'like';
     }
     if ($oper2 == 'like') {
         $final_wo = "'" . $_REQUEST['final_wo'] . "%" . "'";
     }
     else {
         $final_wo = "'" . $_REQUEST['final_wo'] . "'";
     }

     $cond1 = "dl.wonum " . $oper2 . " " . $final_wo;

}
else {
     $final_womatch = '';
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

     $cond3 = "d.crn " . $oper2 . " " . $final_crn;

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

     $cond5 = "dl.partnum " . $oper2 . " " . $final_partnum;

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
          $cond21 = "to_days(d.disp_date) " . "> to_days('" . $date1 . "')";
     }
     else
     {
          $cond21 = "(to_days(d.disp_date)-to_days('1582-01-01') > 0 || d.disp_date = 'NULL' || d.disp_date = '0000-00-00')";
     }

     if ( isset ( $_REQUEST['ddate2'] )  &&  $_REQUEST['ddate2'] != '')
     {
          $date2 = $_REQUEST['ddate2'];
          $cond22 = "to_days(d.disp_date) " . "< to_days('" . $date2 . "')";
     }
     else
     {
          $cond22 = "(to_days(d.disp_date)-to_days('2050-12-31') < 0 || d.disp_date = 'NULL' || d.disp_date = '0000-00-00')";
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


$cond = $cond0 . ' and ' . $cond1 . ' and ' . $cond2. ' and ' . $cond3 . ' and ' . $cond4. ' and ' . $cond5;
//echo $cond;

$userrole = $_SESSION['userrole'];

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

 //echo $offset;

?>
<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/dispatch.js"></script>

<html>
<head>
<title>Dispatch Summary</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">
<form action='dispatchSummary.php' method='post' enctype='multipart/form-data'>
<?php

 include('header.html');

?>
<!-- <table width=100% cellspacing="0" cellpadding="6" border="0">
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
</td></tr> -->
<!-- <table width=100% border=0 cellpadding=0 cellspacing=0>
  <tr>
	    <td bgcolor="#FFFFFF"> -->

 <table width=100% border=0 cellpadding=6 cellspacing=3>
     <tr><td>
          <tr><td><span class="heading"><i>Please click on the Rel Note# link for Details and Edit</i></td></tr>
 <tr>
 <td>         

		</tr>
</td>

<table width=100% border=0 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1">
  <tr>
	<td bgcolor="#F5F6F5" colspan="13"><span class="heading"><b><center>Search Criteria</center></b></td>
    <td bgcolor="#FFFFFF" rowspan=3 align="center">
      <button class="stdbtn btn_blue" style="background-color:#2d3e50" onClick="javascript: return searchsort_fields()" >Get</button>
	<!-- <input type= "image" name="submit" src="images/bu-get.gif" value="Get" onclick="javascript: return searchsort_fields()"> -->


<input type="hidden" name="rel_oper">
<input type="hidden" name="wo_oper">
	</td>
  </tr>
<tr>
<td bgcolor="#FFFFFF"><span class="labeltext"><b>Rel Note#</b>
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
<input type="text" name="final_relno" size=10 value="<?php echo $finalrel_match ?>" onkeypress="javascript: return checkenter(event)">
</td>
<td  align="left" bgcolor="#FFFFFF"><span class="labeltext"><b>Type=</b>
<span class="tabletext"><select id="type" name="type" size="1" width="100">
<?php
      if ($val == 'Manufacture Only')
      {
?>
	 <option selected="Manufacture Only">Manufacture Only
	 <option value="Assembly">Assembly
	 <option value="Post Process">Post Process</option>
	 <option value="Kit">Kit</option>
	 <option value="All">All</option>

<?php
      }
      else if ($val == 'Post Process')
      {
?>
	<option selected="Post Process">Post Process
	<option value="Assembly">Assembly
	<option value="Manufacture Only">Manufacture Only</option>
	 <option value="Kit">Kit</option>
	 <option value="All">All</option>

<?php
      }
      else if ($val == 'Assembly')
      {
?>
    <option selected="Assembly">Assembly
	<option value="Post Process">Post Process
	<option value="Manufacture Only">Manufacture Only</option>
	 <option value="Kit">Kit</option>
 	 <option value="All">All</option>

<?php
      }
      else if ($val == 'Kit')
      {
?>
    <option selected="Kit">Kit
	<option value="Post Process">Post Process
	<option value="Manufacture Only">Manufacture Only</option>
	 <option value="Assembly">Assembly</option>
	 <option value="All">All</option>

<?php
      }
      else if ($val == 'All')
      {
?>
    <option selected="All">All</option>
    <option value="Kit">Kit
	<option value="Post Process">Post Process
	<option value="Manufacture Only">Manufacture Only</option>
	 <option value="Assembly">Assembly</option>
<?php
      }

?>
</select>
</td>
<td bgcolor="#FFFFFF"><span class="labeltext"><b>WO#</b></td>

<td bgcolor="#FFFFFF"><span class="tabletext"><select name="wo_oper" size="1" width="50">
<?php
   if ( isset ( $_REQUEST['wo_oper'] ) ){
          $check2 = $_REQUEST['wo_oper'];

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

<td colspan=9 bgcolor="#FFFFFF"><input type="text" name="final_wo" size=15 value="<?php echo $final_womatch ?>" onkeypress="javascript: return checkenter(event)">
</td>
</tr>

 <tr>
<td colspan=2 bgcolor="#FFFFFF"><span class="labeltext"><b>Dispatch Date:  From &nbsp&nbsp</b>
        <input type="text" name="ddate1" id="ddate1"  size=10 value="<?php echo $ddate1_match ?>"
         onkeypress="javascript: return checkenter(event)">
        <img src="images/bu-getdateicon.gif" alt="Get Date" onclick='GetDate("ddate1")'>
         <span class="labeltext"><b>&nbsp;&nbsp;To</b>
        <input type="text" name="ddate2" id="ddate2"  size=10 value="<?php echo $ddate2_match ?>"
         onkeypress="javascript: return checkenter(event)">
        <img src="images/bu-getdateicon.gif" alt="Get Date" onclick='GetDate("ddate2")'>
</td>
<td bgcolor="#FFFFFF"><span class="labeltext"><b>PRN</b></td>
<td bgcolor="#FFFFFF"><span class="tabletext"><select name="crn_oper" size="1" width="50">
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

<td colspan=1 bgcolor="#FFFFFF"><input type="text" name="final_crn" id="final_crn" size=15 value="<?php echo $final_crnmatch ?>" onkeypress="javascript: return checkenter(event)">
</td>
<td bgcolor="#FFFFFF"><span class="labeltext"><b>Part No.</b></td>
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

<td colspan=4 bgcolor="#FFFFFF"><input type="text" name="final_partnum" size=20 value="<?php echo $final_partnummatch ?>" onkeypress="javascript: return checkenter(event)">
</td>

</tr>

</table>
<tr><td>
<table width=100% border=0>
  <div class="contenttitle radiusbottom0">
  <h2><span>List of Dispatch
<? if($usertype != 'CUST')
{ 
?>

    <input type="button" class="stdbtn btn_blue" style="float:right;padding:2px;margin-right:5px;" onClick="location.href='newdispatch.php'" value="New" >
  <!-- <a href ="newdispatch.php"><img name="Image8" style="float:right" border="0" src="images/new.gif"></a> -->

  <!--
  <a href="export_cofc.php?from_date=<?echo $_REQUEST['ddate1']?>&to_date=<?echo $_REQUEST['ddate2']?>&crnnum=<?echo $_REQUEST['final_crn']?>">
-->
<input type="button" class="stdbtn btn_blue" style="float:right;padding:2px;margin-right:5px;" onClick="location.href='export_cofc.php'" value="Export" >

<?
}
?>
  <!-- <a href="export_cofc.php" id='myLink' onclick="javascript:export_dispatch()"> -->

  <!-- <img name="Image8" style="float:right" border="0" src="images/export.gif" ></a> -->
   </h2>
</span>
  </td>
  </tr>
</table>

<table width=100% border=0 cellpadding=3 cellspacing=1 class="stdtable" >
  <thead>
        <tr>
            <th  class="head0" width="4%"><b>Rel Note#</b></th>
            <th width="5%" class="head1"><b>Type</b></th>
            <th width="4%" class="head0"><b>Status</b></th>
            <th width="4%" class="head1"><b>Dispatch Date</b></th>
            <th width="11%" class="head0"><b>Customer</b></th>
			<th width="5%" class="head1"><b>PRN</b></th>
			<th width="5%" class="head0"><b>Part #</b></th>
            <th width="4%" class="head1"><b>WO#</b></th>
            <th width="4%" class="head0"><b>Dispatch Qty</b></th>

        </tr>
      </thead>

<?php

     $result = $newdispatch->getdispatch($cond,$offset,$sort1,$rowsPerPage);

            while ($myrow = mysql_fetch_row($result)) {
              if($myrow[2] != '' && $myrow[2] != '0000-00-00')
               {
                 $datearr = split('-', $myrow[2]);
                 $d=$datearr[2];
                 $m=$datearr[1];
                 $y=$datearr[0];
                 $x=mktime(0,0,0,$m,$d,$y);
                 $date1=date("M j, Y",$x);
               }
               else
               {
                 $date1 = '';
               }
   	           echo '<tr bgcolor="#FFFFFF"><td align="center"><span class="tabletext">';
               echo "<a href=\"dispatchDetails.php?disprecnum=$myrow[0]\">$myrow[1]</td>";
               echo "<td align=\"center\"><span class=\"tabletext\">$myrow[8]</td>";
               if ($myrow[6] != 'Signed & Closed')
               { 
                  echo "<td align=\"center\"><span class=\"tabletext\">$myrow[6]</td>";
               }
               else 
               {
                  echo "<td bgcolor=\"#00FF00\" align=\"center\"><span class=\"tabletext\">$myrow[6]</td>";
               }
               echo "<td align=\"center\"><span class=\"tabletext\">$date1</td>";
               echo "<td align=\"center\"><span class=\"tabletext\">$myrow[3]</td>";
               echo "<td align=\"center\"><span class=\"tabletext\">$myrow[7]</td>";
               echo "<td align=\"center\"><span class=\"tabletext\">$myrow[9]</td>";
			         echo "<td align=\"center\"><span class=\"tabletext\">$myrow[4]</td>";
               echo "<td align=\"center\"><span class=\"tabletext\">$myrow[5]</td>";
               echo '</td></tr>';
            }



?>
</table>
      </table>
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
$numrows = $newdispatch->getdispatchCount($cond,$offset,$rowsPerPage);
// how many pages we have when using paging?
$maxPage = ceil($numrows/$rowsPerPage);
//echo "$maxPage</br>";
if (!isset($_REQUEST['page']))
{
//echo "page is set";
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
    $prev = " <a href=\"dispatchSummary.php?page=$page&totpages=$totpages&final_relno=$finalrel_match&
	final_wo=$final_womatch&final_crn=$final_crnmatch&ddate1=$ddate1_match&ddate2=$ddate2_match&type=$val&final_partnum=$final_partnummatch\">[Prev]</a> ";

    $first = " <a href=\"dispatchSummary.php?page=1&totpages=$totpages&final_relno=$finalrel_match&final_wo=$final_womatch&
	final_crn=$final_crnmatch&ddate1=$ddate1_match&ddate2=$ddate2_match&type=$val&final_partnum=$final_partnummatch\">[First Page]</a> ";
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
    $next = " <a href=\"dispatchSummary.php?page=$page&totpages=$totpages&final_relno=$finalrel_match&final_wo=$final_womatch&
	final_crn=$final_crnmatch&ddate1=$ddate1_match&ddate2=$ddate2_match&type=$val&final_partnum=$final_partnummatch\">[Next]</a> ";

    $last = " <a href=\"dispatchSummary.php?page=$totpages&totpages=$totpages&final_relno=$finalrel_match&final_wo=$final_womatch&final_crn=$final_crnmatch&ddate1=$ddate1_match&ddate2=$ddate2_match&type=$val&final_partnum=$final_partnummatch\">[Last Page]</a> ";
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
else        {
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

