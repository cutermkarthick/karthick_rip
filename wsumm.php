<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = June 20, 2004                =
// Filename: worderSummary.php                 =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OMS                          =
// Displays WO Summary for SU                  =
// Modifications History                       =
// Dec 6,04 - Paging Enhancements              =
// Dec20,04 - Wo2Po link enhancements          =
//            Coded By Jerry George            =
// Mar 27,05 - Additional search paramaters    =
//             By Badari Mandyam               =
//==============================================
//session_save_path ("/home/virtual/dciapp.com/tmp");
@session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );
}
$userid = $_SESSION['user'];
$_SESSION['pagename'] = 'worderSummary';
//////session_register('pagename');

$dept = $_SESSION['department'];
$cond0 = "w.actual_ship_date like %";

$cond1 = "c.name like '%'";
$cond2 = "w.wonum like '%'";
$cond3 = "(to_days(w.book_date)-to_days('1582-01-01') > 0 ||
                    w.book_date = '0000-00-00' ||
                    w.book_date = 'NULL' ) and
           (to_days(w.book_date)-to_days('2050-12-31') < 0 ||
                    w.book_date = '0000-00-00' ||
                    w.book_date = 'NULL')";
$cond4 = "w.wotype like '%'";
$cond5 = "md.CIM_refnum like '%'";
$cond = $cond0 . ' and ' . $cond1 . ' and ' . $cond2 . ' and ' . $cond3 . ' and ' . $cond4;

$worec='';
$oper1='like';
$oper2='like';
$oper3='like';
$sort1='wo';
$sort2='company';
$sess=session_id();
// Sep 23, 2008 - Modifications request to hide all work orders
// priorto Aug 15, 2008.  So, updated their status to Hidden
// and hence the change to the condition here.
if ( isset ( $_REQUEST['status_val'] ) )
{

     $sval = $_REQUEST['status_val'];
     if ($sval == 'All')
     {
         $cond0 = "w.condition != " . "'Hidden'";
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

     $cond5 = "md.CIM_refnum " . $oper3 . " " . $crn;

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

$cond = $cond0 . ' and ' . $cond1 . ' and ' . $cond2 . ' and ' . $cond3 . ' and ' . $cond4 . ' and ' . $cond5;

// First include the class definition

include_once('classes/userClass.php');
include_once('classes/loginClass.php');
include('classes/workorderClass.php');
include('classes/displayClass.php');

$newlogin = new userlogin;
$newlogin->dbconnect();
$username = $_SESSION['user'];
$newworkOrder = new workOrder;
$newdisp = new display;

// For paging - Added on Dec 6,04

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

// End additions on Dec 6,04
?>

<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/wo.js"></script>

<html>
<head>
<title>Work Order</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">

<?php
include('header.html');
?>
<form action='worderSummary.php' method='post' enctype='multipart/form-data'>

<table width=100% cellspacing="0" cellpadding="6" border="0">
<tr>
<td>
<table width=100% border=0 cellspacing="0" cellpadding="0">
<tr>
<td><span class="welcome"><b>Welcome <?php echo $userid?></b></td>
<td align="right">
<?php
  if ($dept == 'Sales')
  {
?>
     <a href="chPassword.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image15','','images/chpwd_mo.gif',1)"><img name="Image15" border="0" src="images/chpwd.gif"></a>
<?php
  }
?>
	<a href="exit.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image16','','images/logout_mo.gif',1)"><img name="Image16" border="0" src="images/logout.gif"></a></td>
</tr>
			</table>
<table width=100% border=0 cellpadding=0 cellspacing=0  >
<tr><td>
</td></tr>
<tr>
<td>
<?php
      $newdisp->dispLinks('');
?>
<table width=100% border=0 cellpadding=0 cellspacing=0  >
<tr bgcolor="DEDFDE">
<td width="6"><img src="images/spacer.gif " width="6"></td>
<td bgcolor="#FFFFFF">
<table width=100% border=0 cellpadding=6 cellspacing=0  >
<tr><td><span class="heading"><i>Please click on the WO link for details and to Edit/Delete</i></td></tr>
<!--<td align="left"><span class="pageheading"><b>Downloads :  <a href="wodownloadxls.php">Excel</a>  / <a href="wodownloadxml.php">XML</a> </b></td>  -->
<tr><td>
<table width=100% border=0 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF" >
<tr>
<td bgcolor="#F5F6F5" colspan="7"><span class="heading"><b><center>Search & Sort Criteria</center></b></td>
<td bgcolor="#FFFFFF" rowspan=3 colspan=4 align="center"><span class="tabletext">
<input type="image" name="Submit" src="images/bu-get.gif" value="Get"
            onclick="javascript: return searchsort_fields()">

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
	<option selected  value="Closed">Closed
	<option value="Open">Open
	<option value="All">All
    <option value="Cancelled">Cancelled
    <option value="Hold">Hold
<?php
      }
      else if ($sval == 'Hold')
      {
?>
	<option selected value="Hold">Hold
	<option value="Open">Open
	<option value="All">All
        <option value="Cancelled">Cancelled
        <option value="Closed">Closed
<?php
      }
      else if ($sval == 'All')
      {
?>
	<option selected value=="All">All
	<option value="Open">Open
	<option value="Closed">Closed
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
<td bgcolor="#FFFFFF"><span class="labeltext"><b>Sort on</b>
<span class="tabletext"><select name="sort1" size="1" width="100">
<?php
      if ($sort1 == 'wo')
      {
?>
	<option selected>wo
	<option>company
<?php
      }
      else {
?>
	<option selected>company
	<option>wo
<?php
      }
?>
</select></td>
<td bgcolor="#FFFFFF"><span class="labeltext"><b>Sort on</b>
<span class="tabletext"><select name="sort2" size="1" width="100">
<?php
      if ($sort2 == 'wo')
      {
?>
	<option selected>wo
	<option>company
<?php
      }
      else {
?>
	<option selected>company
	<option>wo
<?php
      }
?>
</select>

<input type="hidden" name="sortfld1">
<input type="hidden" name="sortfld2">
</td>

</tr>
</table>

</td></tr>

<table width=100% border=0 cellpadding=3 cellspacing=1 >


<tr><td><span class="pageheading"><b>List of Work Orders</b></td></tr>
<?php
if ($dept == 'PPC' || $dept == 'Sales')
{
?> 
<tr><td align="right"><a href ="WodetailsEntry.php"><img name="Image8" border="0" src="images/new.gif"></a>
  </td></tr>
<?php
}
?>
<tr><td>

<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
<thead>
<tr>
<th bgcolor="#EEEFEE"><span class='tabletext'><b>WO</b></th>
<th bgcolor="#EEEFEE"><span class='tabletext'><b>Company</b></th>
<th bgcolor="#EEEFEE"><span class='tabletext'><b>Cust PO</b></th>
<th bgcolor="#EEEFEE"><span class='tabletext'><b>PRN#</b></th>
<th bgcolor="#EEEFEE"><span class='tabletext'><b>Book Date</b></th>
<th bgcolor="#EEEFEE"><span class='tabletext'><b>WO Qty</b></th>
<th bgcolor="#EEEFEE"><span class='tabletext'><b>Amnd Qty</b></th>
<th bgcolor="#EEEFEE"><span class='tabletext'><b>GRN#</b></th>
<th bgcolor="#EEEFEE"><span class='tabletext'><b>Status</b></th>
<th bgcolor="#EEEFEE"><span class='tabletext'><b>Sch Due</b></th>
<th bgcolor="#EEEFEE"><span class='tabletext'><b>Rev. Comp</b></th>
<th bgcolor="#EEEFEE"><span class='tabletext'><b>Date Code</b></th>
<th bgcolor="#EEEFEE"><span class='tabletext'><b>WO Type</b></th>
<th bgcolor="#EEEFEE"><span class='tabletext'><b>FAI</b></th>
</tr>
</thead>
<tbody>
<?php
       $result = $newworkOrder->getWorkOrders($username,$cond,$sort1,$sort2,$offset,$rowsPerPage);

// Dec 30, 05 - Added the following piece of code to accomodoate
//  Excel download feature.
	$_SESSION['username'] = $username;
	//////session_register('username');
	$_SESSION['cond'] = $cond;
	//////session_register('cond');
	$_SESSION['sort1'] = $sort1;
	//////session_register('sort1');
	$_SESSION['sort2'] = $sort2;
	//////session_register('sort2');
	$_SESSION['offset'] = $offset;
	//////session_register('offset');
	$_SESSION['rowsPerPage'] = $rowsPerPage;
	//////session_register('rowsPerPage');
// Dec 30, 05
       $flag = 0;

       while ($myrow = mysql_fetch_row($result))
       {		   
	    if($myrow[30] > 0)
	    {
		$woqty = $myrow[30];  
                $amndqty =  $myrow[25];                
	    }
            if($myrow[30]  == 0 || $myrow[30] == 'null' || $myrow[30] == '')
	    {
		$woqty = $myrow[25]; 
                $amndqty = 0;                   
	    }
            
            
            if ($flag == 0)
            {
   	       printf('<tr><td bgcolor="#FFFFFF"><span class="tabletext">
                           <a href="woDetails.php?typenum=%s&wotype=%s&worecnum=%s&wonum=%s">%05d</td>
                      ',
		         $myrow[7],$myrow[1],$myrow[11],$myrow[0],$myrow[0]
                     );
               $flag = 1;
?>
               <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[2] ?></td>
               
               <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[3] ?></td>
               <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[28] ?></td>
              
               <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[16] ?></td>
    <?php
         /*
           if($myrow[20]!=null){
               printf('<td bgcolor="#FFFFFF" ><span class="tabletext">%s   <img src="images/view.gif" alt="View BOM" onclick="javascript:javascript:viewbom(%s)"></td>',
		        $myrow[19], $myrow[20]);
                 }
           if($myrow[20]==null){
                    printf('<td  bgcolor="#FFFFFF" align="center" ><span class="tabletext"></td>' );
                 }       */
   ?>
       <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $woqty ?></td>
       <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $amndqty ?></td>
       <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[27] ?></td>
	   
<?php

	   // Added for Wo2po link enhancement on Dec 20

           $worecnum=$myrow[11];

               //printf('<td bgcolor="#FFFFFF"><span class="tabletext"><a href="wo2po.php?worecnum=%s&wonum=%s">View Po</td>',
		        // $worecnum,$myrow[0]);
	   // End additions
?>
               <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[5] ?></td>
               <td bgcolor="#FFFFFF"><span class="tabletext"><?php if ($myrow[14] != '00-00-00') echo $myrow[14] ?></td>
               <td bgcolor="#FFFFFF"><span class="tabletext"><?php if ($myrow[17] != '00-00-00') echo $myrow[17] ?></td>
               <td bgcolor="#FFFFFF"><span class="tabletext"><?php if ($myrow[15] != '00-00-00') echo $myrow[15] ?></td>
               <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[29] ?></td>
               <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[31] ?></td></tr>

       </tr>
 <!--

            <td colspan=2 bgcolor="#FFFFFF"><span class="heading">Attached files:</td>
<?php

	   // multiple file attachments added on 25 Jan 2007
             $result1 = $newworkOrder->getAttachedfile($myrow[11]);
	            while ( $myrow1 = mysql_fetch_row($result1)) {
	                    printf('<td bgcolor="#FFFFFF" ><span class="heading"><a href=%s>%s</a></td>',
		                $myrow1[1],$myrow1[1]);}
	   // End additions
?>
                <td bgcolor="#FFFFFF" colspan=10>
                </tr>
 -->
<?php
             }
             else
             {
                printf('<tr bgcolor="#EEEEEE"><td><span class="tabletext"><a href="woDetails.php?typenum=%s&wotype=%s&worecnum=%s&wonum=%s">%05d</td>
                      ',
		         $myrow[7],$myrow[1],$myrow[11],$myrow[0],$myrow[0]
                     );

                $flag = 0;
?>
                <td><span class="tabletext"><?php echo $myrow[2] ?></td>
                
               
                <td><span class="tabletext"><?php echo $myrow[3] ?></td>
                <td><span class="tabletext"><?php echo $myrow[28] ?></td>
              
                <td><span class="tabletext"><?php echo $myrow[16] ?></td>
           <!-- Added for bomdetails view on october 31,2006
                 <td align ="center"><span class="tabletext"><?php echo $myrow[19] ?>     <img src="images/view.gif" alt="View BOM" onclick="javascript:viewbom('<?php echo "$myrow[20]";?>');">
           -->
    <?php
     /*   //Added for bomdetails view on october 31,2006
           if($myrow[20]!=null){
               printf('<td><span class="tabletext">%s   <img src="images/view.gif" alt="View BOM" onclick="javascript:javascript:viewbom(%s)"></td>',
		        $myrow[19], $myrow[20]);
                 }
           if($myrow[20]==null){	
                    printf('<td align="center" ><span class="tabletext"></td>');
                 }   */
    ?>
           <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $woqty ?></td>
          <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $amndqty ?></td>
           <td><span class="tabletext"><?php echo $myrow[27] ?></td>
		   
<?php
		// Added for Wo2po link enhancement on Dec 20
		$worecnum=$myrow[11];
	       // printf('<td><span class="tabletext"><a href="wo2po.php?worecnum=%s&wonum=%s">View Po</td>',
		         //$worecnum,$myrow[0]);
		// End additions
?>

               <td><span class="tabletext"><?php echo $myrow[5] ?></td>
               <td><span class="tabletext"><?php if ($myrow[14] != '00-00-00') echo $myrow[14] ?></td>
               <td><span class="tabletext"><?php if ($myrow[17] != '00-00-00') echo $myrow[17] ?></td>
               <td><span class="tabletext"><?php if ($myrow[15] != '00-00-00') echo $myrow[15] ?></td>
               <td><span class="tabletext"><?php echo $myrow[29] ?></td>
               <td><span class="tabletext"><?php echo $myrow[31] ?></td></tr>




<!--

               <td colspan=2 bgcolor="#EFEFEF"><span class="heading">Attached files:</td>
<?php

	  // multiple file attachments added on 25 Jan 2007  */
             $result1 = $newworkOrder->getAttachedfile($myrow[11]);
	            while ( $myrow1 = mysql_fetch_row($result1)) {
                        printf('<td bgcolor="#EFEFEF" ><span class="heading"><a href=%s>%s</a></td>',
		                $myrow1[1],$myrow1[1]);
                  }
	   // End additions
?>
                <td bgcolor="#EFEFEF" colspan=10>
                </tr>
 -->

<?php
             }
       }
?>

</tbody>
</table>
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
	<td align=left bgcolor=#ffffff>

<?php
//  Added on Dec 6,04 for paging

$numrows = $newworkOrder->getWOcount($cond,$offset, $rowsPerPage);
// how many pages we have when using paging?

//echo "<br> $numrows<br>";
$maxPage = ceil($numrows/$rowsPerPage);
//echo "<br> $maxPage<br>";
if (!isset($_REQUEST['page']))
{
    $totpages = $maxPage;
   // echo "<br> $totpages<br>";
}

$self = $_SERVER['PHP_SELF'];

// creating 'previous' and 'next' link
// plus 'first page' and 'last page' link

// print 'previous' link only if we're not
// on page one

if ($pageNum > 1)
{
    $page = $pageNum - 1;
    $prev = " <a href=\"worderSummary.php?page=$page&totpages=$totpages&scomp=$company_match&status_val=$sval&swonum=$wonum_match&crn=$crn_match&sdate1=$date1_match&sdate2=$date2_match&stype=$type_match&sortfld1=$sort1&sortfld2=$sort2\">[Prev]</a> ";
    $first = " <a href=\"worderSummary.php?page=1&totpages=$totpages&scomp=$company_match&status_val=$sval&swonum=$wonum_match&crn=$crn_match&sdate1=$date1_match&sdate2=$date2_match&stype=$type_match&sortfld1=$sort1&sortfld2=$sort2\">[First Page]</a> ";
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
    $next = " <a href=\"worderSummary.php?page=$page&totpages=$totpages&scomp=$company_match&status_val=$sval&swonum=$wonum_match&crn=$crn_match&sdate1=$date1_match&sdate2=$date2_match&stype=$type_match&sortfld1=$sort1&sortfld2=$sort2\">[Next]</a> ";
    $last = " <a href=\"worderSummary.php?page=$totpages&totpages=$totpages&scomp=$company_match&status_val=$sval&swonum=$wonum_match&crn=$crn_match&sdate1=$date1_match&sdate2=$date2_match&stype=$type_match&sortfld1=$sort1&sortfld2=$sort2\">[Last Page]</a> ";
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
</body>
</html>
