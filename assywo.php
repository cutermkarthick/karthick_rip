<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = May 24,2005                  =
// Filename: assywo.php                        =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OMS                          =
// Displays Assy Wos                           =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];
$_SESSION['pagename'] = 'assywo';
$page = "WO: Assy WO";
//////session_register('pagename');
$dept = $_SESSION['department'];
$userrole = $_SESSION['userrole'];
$usertype = $_SESSION['usertype'];
$cond0 = "(a.status = '" . 'Open' . "')";
$cond1 = "c.name like '%'";
$cond2 = "a.assy_wonum like '%'";
$cond3 = "(to_days(a.assydate)-to_days('1582-01-01') > 0 ||
                    a.assydate = '0000-00-00') and
           (to_days(a.assydate)-to_days('2050-12-31') < 0 ||
                    a.assydate = '0000-00-00')";

$cond4 = "a.crn like '%'";
$cond =  $cond0 . ' and ' .$cond1 . ' and ' . $cond2 . ' and ' . $cond3 . ' and ' . $cond4;

$oper1='like';
$oper2='like';
$oper3='like';

if ( isset ( $_REQUEST['final_assywonum'] ) )
{
     $finalwonum_match = $_REQUEST['final_assywonum'];
     if ( isset ( $_REQUEST['wonum_oper'] ) ) {
          $oper2 = $_REQUEST['wonum_oper'];
     }
     else {
         $oper2 = 'like';
     }
     if ($oper2 == 'like') {
         $final_wonum = "'" . $_REQUEST['final_assywonum'] . "%" . "'";
     }
     else {
         $final_wonum = "'" . $_REQUEST['final_assywonum'] . "'";
     }

     $cond2 = "a.assy_wonum " . $oper2 . " " . $final_wonum;

}
else {
     $finalwonum_match = '';
}

if ( isset ( $_REQUEST['scomp'] ) )
{
     $company_match = $_REQUEST['scomp'];
     if ( isset ( $_REQUEST['company_oper'] ) ) {
          $oper1 = $_REQUEST['company_oper'];
     }
     else {
         $oper1 = 'like';
     }
     if ($oper1 == 'like') {
         $scomp = "'" . $_REQUEST['scomp'] . "%" . "'";
     }
     else {
         $scomp = "'" . $_REQUEST['scomp'] . "'";
     }

     $cond1 = "c.name " . $oper1 . " " . $scomp;

}
else {
     $company_match = '';
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

     $cond4 = "a.crn " . $oper3 . " " . $crn;

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
          $cond31 = "to_days(a.assydate) " . ">= to_days('" . $date1 . "')";
     }
     else
     {
          $cond31 = "(to_days(a.assydate)-to_days('1582-01-01') > 0 ||  a.assydate = '0000-00-00')";
     }

     if ( isset ( $_REQUEST['sdate2'] )  &&  $_REQUEST['sdate2'] != '')
     {
          $date2 = $_REQUEST['sdate2'];
          $cond32 = "to_days(a.assydate) " . "<= to_days('" . $date2 . "')";
     }
     else
     {
          $cond32 = "(to_days(a.assydate)-to_days('2050-12-31') < 0 || a.assydate = '0000-00-00')";
     }
     $cond3 = $cond31 . ' and ' . $cond32;

}
else
{
     $date1_match = '';
     $date2_match = '';
}

if(isset ($_REQUEST['status_val'] ) )
{
     $sval = $_REQUEST['status_val'];

      if ($sval== 'Open')
      {
         $cond0 = "(a.status = '" . $sval . "' || a.status is NULL || a.status = '')";
      }
     else if ($sval == 'Closed')
      {
         $cond0 = "a.status = '" . $sval . "'" ;
      }
     else if ($sval == 'All')
      {
         $cond0 = "(a.status like '%' || a.status is NULL)";
      }
     else if ($sval == 'Pending')
      {
         $cond0 = "a.status = '" . $sval . "'" ;
      }
      else if ($sval == 'Cancelled')
      {
         $cond0 = "a.status = '" . $sval . "'" ;
      }
}
else
{
     $sval = 'Open';
     $cond0 = "(a.status = '" . $sval . "' || a.status is NULL || a.status = '')";
}
$cond =  $cond0 . ' and ' .$cond1 . ' and ' . $cond2 . ' and '  . $cond4;
include_once('classes/loginClass.php');

$newlogin = new userlogin;
$newlogin->dbconnect();



// For paging - Added on Dec 6,04

// how many rows to show per page
$rowsPerPage =10;

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

// First include the class definition
include('classes/userClass.php');
include('classes/assywoClass.php');
include('classes/displayClass.php');
$newWo = new assywo;
$newdisplink = new display;
?>

<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/assywo.js"></script>

<html>
<head>
<title>Assy WO</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">
	<form action='assywo.php' method='post' enctype='multipart/form-data'>
<?php
include('header.html');
?>
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
<?php $newdisplink->dispLinks(''); ?>
<table width=100% border=0 cellpadding=0 cellspacing=0>
<tr bgcolor="DEDFDE">
<td width="6"><img src="images/spacer.gif " width="6"></td> -->
<td bgcolor="#FFFFFF">
<table width=100% border=0 cellpadding=6 cellspacing=1>
<tr><td><span class="heading"><i>Please click on the WO link for details or to Edit/Delete</i></td></tr>
<tr>
	<td>
<table width=100% border=0 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1" >
<tr>
<td bgcolor="#F5F6F5" colspan="7"><span class="heading"><b><center>Search & Sort Criteria</center></b></td>
<td bgcolor="#FFFFFF" rowspan=3 colspan=4 align="center"><span class="tabletext">
<button class="stdbtn btn_blue" style="background-color:#2d3e50" onClick="javascript: return searchsort_fields()" >Get</button>
<!-- <input type="image" name="Submit" src="images/bu-get.gif" value="Get"
            onclick="javascript: return searchsort_fields()"></tr> -->
<tr>
<td bgcolor="#FFFFFF"><span class="labeltext"><b>Status = &nbsp</b></td>
<td bgcolor="#FFFFFF"><span class="tabletext">
  <select name="status_val" size="1" width="100">
    <option value="All" <?php if($sval == "All"){echo "selected='selected'";} ?>>All</option>
    <option value="Open" <?php if($sval == "Open"  ){echo "selected='selected'";} ?> >Open</option>
  	<option value="Pending" <?php if($sval == "Pending"){echo "selected='selected'";} ?>>Pending</option>
  	<option value="Closed" <?php if($sval == "Closed"){echo "selected='selected'";} ?>>Closed</option>
    <option value="Cancelled" <?php if($sval == "Cancelled"){echo "selected='selected'";} ?>>Cancelled</option>
    <option value="Hold" <?php if($sval == "Hold"){echo "selected='selected'";} ?>>Hold</option>
  </select>
</td>

<td bgcolor="#FFFFFF"><span class="labeltext"><b>Company &nbsp</b></td>
<td  bgcolor="#FFFFFF"><span class="tabletext"><select name="comp_oper" size="1" width="100">
<?php
      if ($oper1 == 'like')
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
<td bgcolor="#FFFFFF"><input type="text" name="scomp" size=20 value="<?php echo $company_match ?>" onKeyPress="javascript: return checkenter(event)">
</td>

<td colspan=2 bgcolor="#FFFFFF"><span class="labeltext"><b>Assy WO #</b>
<span class="tabletext"><select name="wonum_oper" size="1" width="20">
<?php
   if ( isset ( $_REQUEST['wonum_oper'] ) ){
          $check2 = $_REQUEST['wonum_oper'];

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
<input type="text" name="final_assywonum" size=10 value="<?php echo $finalwonum_match ?>" onkeypress="javascript: return checkenter(event)">
</td>
</tr>
<tr>
<td colspan=2 bgcolor="#FFFFFF"><span class="labeltext"><b>Book Date: From &nbsp&nbsp</b>
        <input type="text" name="sdate1" size=10 value="<?php echo $date1_match ?>"
         onkeypress="javascript: return checkenter(event)">
        <img src="images/bu-getdateicon.gif" onclick="javascript:NewCssCal('sdate1','yyyyMMdd')" style="cursor:pointer"/>
         <span class="labeltext"><b>&nbsp;&nbsp;To</b>
        <input type="text" name="sdate2" size=10 value="<?php echo $date2_match ?>"
         onkeypress="javascript: return checkenter(event)">
        <img src="images/bu-getdateicon.gif" onclick="javascript:NewCssCal('sdate2','yyyyMMdd')" style="cursor:pointer"/>
</td>
<td bgcolor="#FFFFFF"><span class="labeltext"><b>PRN#</b></td>
<td bgcolor="#FFFFFF" colspan=3>
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

</tr>
</table>
</td></tr>

<table width="100%" border=0>
<div class="contenttitle radiusbottom0">
<h2><span>List of Assembly Work Orders
<?php if($dept !='QA' && $dept !='Assembly'&& $dept!='PPC4'&& $dept!='PPC3'&& $dept!='PPC2'&& $dept!='PPC1' && $usertype != 'CUST')
{?>
  <input type="button" class="stdbtn btn_blue" style="float:right;padding:2px;margin-right:5px;" onClick="location.href='assywoEntry.php'" value="New" >
<!-- <a href ="assywoEntry.php"><img style="float:right" name="Image8" border="0" src="images/new.gif"></a> -->
</h2></span>
<?php
}
?>
<tr><td>
<table width=100% border=0 cellpadding=3 cellspacing=1 class="stdtable">
  <thead>
    <tr>
        <th class="head0"><span class="heading"><b>Assy WO#</b></thth>
        <th class="head1"><span class="heading"><b>Company</b></th>
        <th class="head0"><span class="heading"><b>Cust PO</b></th>
        <th class="head1"><span class="heading"><b>PRN</b></th>
        <th class="head0"><span class="heading"><b>BOM#</b></th>
        <th class="head1"><span class="heading"><b>WO Date</b></th>
        <th class="head0"><span class="heading"><b>WO Qty</b></th>
        <th class="head1"><span class="heading"><b>Status</b></th>
        <th class="head0"><span class="heading"><b>Sch Due</b></th>
        <th class="head1"><span class="heading"><b>Rev Comp</b></th>
        <th class="head0"><span class="heading"><b>Date Code</b></th>
        <th class="head1"><span class="heading"><b>Assembly/Kit</b></th>
        <th class="head0"><span class="heading"><b>FAI</b></th>
    </tr>
  </thead>

<?php

        $result = $newWo->getassyWo_summary($cond,$offset,$rowsPerPage);
        while ($myrow = mysql_fetch_row($result)) {

         if($myrow[11] !='' && $myrow[11] !='0000-00-00')
         {
           $datearr=split('-',$myrow[11]);
           $d= $datearr[2];
           $m= $datearr[1];
           $y= $datearr[0];
           $x=mktime(0,0,0,$m,$d,$y);
           $sch_date=date('M j,Y',$x);
         }
         else
         {
           $sch_date='';
         }
         if($myrow[12] !='' && $myrow[12] !='0000-00-00')
         {
           $datearr=split('-',$myrow[12]);
           $d= $datearr[2];
           $m= $datearr[1];
           $y= $datearr[0];
           $x=mktime(0,0,0,$m,$d,$y);
           $rev_date=date('M j,Y',$x);
         }
         else
         {
           $rev_date='';
         }
         if($myrow[13] !='' && $myrow[13] !='0000-00-00')
         {
           $datearr=split('-',$myrow[13]);
           $d= $datearr[2];
           $m= $datearr[1];
           $y= $datearr[0];
           $x=mktime(0,0,0,$m,$d,$y);
           $date_code=date('M j,Y',$x);
         }
         else
         {
           $date_code='';
         }
         if($myrow[2] !='' && $myrow[2] !='0000-00-00')
         {
           $datearr=split('-',$myrow[2]);
           $d= $datearr[2];
           $m= $datearr[1];
           $y= $datearr[0];
           $x=mktime(0,0,0,$m,$d,$y);
           $assy_date=date('M j,Y',$x);
         }
         else
         {
           $assy_date='';
         }

        printf('<td bgcolor="#FFFFFF" align="center"><span class="tabletext"><a href="assywoDetails.php?worecnum=%s">%s</a></td>
                <td bgcolor="#FFFFFF" align="center"><span class="tabletext">%s</td>
                <td bgcolor="#FFFFFF" align="center"><span class="tabletext">%s</td>
                <td bgcolor="#FFFFFF" align="center"><span class="tabletext">%s</td>
                <td bgcolor="#FFFFFF" align="center"><span class="tabletext">%s</td>
                <td bgcolor="#FFFFFF" align="center"><span class="tabletext">%s</td>
                <td bgcolor="#FFFFFF" align="center"><span class="tabletext">%s</td>
                <td bgcolor="#FFFFFF" align="center"><span class="tabletext">%s</td>
                <td bgcolor="#FFFFFF" align="center"><span class="tabletext">%s</td>
                <td bgcolor="#FFFFFF" align="center"><span class="tabletext">%s</td>
                <td bgcolor="#FFFFFF" align="center"><span class="tabletext">%s</td>
                <td bgcolor="#FFFFFF" align="center"><span class="tabletext">%s</td>
                <td bgcolor="#FFFFFF" align="center"><span class="tabletext">%s</td>',
		      $myrow[0],$myrow[1],$myrow[10],$myrow[14],$myrow[4],$myrow[5],$assy_date,$myrow[3],$myrow[7],
              $sch_date,$rev_date,$date_code,$myrow[15],$myrow[8]);
              printf('</td></tr>');
        }
?>

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


<table border=0 cellpadding=0 cellspacing=0 width=100%>
<tr bgcolor="FFFFFF">
	<td align=left>
  <?php
//  Added on Dec 6,04 for paging

$numrows = $newWo->getassywocount($cond,$offset,$rowsPerPage);
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
    $prev = " <a href=\"assywo.php?page=$page&totpages=$totpages&scomp=$company_match&status_val=$sval&final_assywonum=$finalwonum_match&crn=$crn_match&sdate1=$date1_match&sdate2=$date2_match\">[Prev]</a> ";

    $first = " <a href=\"assywo.php?page=1&totpages=$totpages&scomp=$company_match&status_val=$sval&final_assywonum=$finalwonum_match&crn=$crn_match&sdate1=$date1_match&sdate2=$date2_match\">[First Page]</a> ";
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
    $next = " <a href=\"assywo.php?page=$page&totpages=$totpages&scomp=$company_match&status_val=$sval&final_assywonum=$finalwonum_match&crn=$crn_match&sdate1=$date1_match&sdate2=$date2_match\">[Next]</a> ";

    $last = " <a href=\"assywo.php?page=$totpages&totpages=$totpages&scomp=$company_match&status_val=$sval&final_assywonum=$finalwonum_match&crn=$crn_match&sdate1=$date1_match&sdate2=$date2_match\">[Last Page]</a> ";
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
</tr>
</form>
</body>
</html>
