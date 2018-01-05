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

// For paging - Added on Dec 6,04

// how many rows to show per page
$rowsPerPage = 1000;

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
//echo 'totalpages='.$totpages;

// counting the offset
$offset = ($pageNum - 1) * $rowsPerPage;


//$cond0 = "w.actual_ship_date like %";
//$cond0 = "w.condition like " . "'%'";

$cond1 = "grn.raw_mat_spec like '%'";
$cond2 = "grn.raw_mat_type like '%'";
$cond3 = "(to_days(grn.recieved_date)-to_days('1582-01-01') > 0 ||
                    grn.recieved_date = '0000-00-00' ||
                    grn.recieved_date = 'NULL' ) and
           (to_days(grn.recieved_date)-to_days('2050-12-31') < 0 ||
                    grn.recieved_date = '0000-00-00' ||
                    grn.recieved_date = 'NULL')";
$cond4 = "grn.grnnum like '%'";
$cond5 = "(grn.crn like '%' || grn.crn is NULL)";
//$cond5 = "m.CIM_refnum like '%'";
$cond = $cond1 . ' and ' . $cond2 . ' and ' . $cond3 . ' and ' . $cond4 . ' and ' . $cond5;

$oper1='like';
$oper2='like';
$oper3='like';
$oper4='like';

$sess=session_id();

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
     $date1_match = $_REQUEST['sdate1'];
     $date2_match = $_REQUEST['sdate2'];
     if ( isset ( $_REQUEST['sdate1']) &&  $_REQUEST['sdate1'] != '' )
     {
          $date1 = $_REQUEST['sdate1'];
          $cond31 = "to_days(grn.recieved_date) " . "> to_days('" . $date1 . "')";
     }
     else
     {
          $cond31 = "(to_days(grn.recieved_date)-to_days('1582-01-01') > 0 || grn.recieved_date = 'NULL' || grn.recieved_date = '0000-00-00')";
     }

     if ( isset ( $_REQUEST['sdate2'] )  &&  $_REQUEST['sdate2'] != '')
     {
          $date2 = $_REQUEST['sdate2'];
          $cond32 = "to_days(grn.recieved_date) " . "< to_days('" . $date2 . "')";
     }
     else
     {
          $cond32 = "(to_days(grn.recieved_date)-to_days('2050-12-31') < 0 || grn.recieved_date = 'NULL'
                       || grn.recieved_date = '0000-00-00')";
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

     $cond4 = "grn.grnnum " . $oper3 . " " . $crn;

}
else {
     $crn_match = '';
}

if ( isset ( $_REQUEST['cim'] ) )
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
<title>CRN Details Report</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">

<?php
include('header.html');

?>
<form action='crn_details_report.php' method='post' enctype='multipart/form-data'>
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
   <tr><td><span class="heading"><b>PRN Details Report</b></td>

<tr><td>

</td></tr>
    </tr>
   </table>
<tr><td>
<table width=100% border=1 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
        <tr border=1>
          <td colspan=1 bgcolor="#E3E4FA" align="center"><span class="heading"><b>&nbsp</b></td>
          <td colspan=3 bgcolor="#E3E4FA" align="center"><span class="heading"><b>RM on Order</b></td>
          <td width="50px" colspan=1 bgcolor="#E3E4FA" align="center"><span class="heading"><b>RM Transit</b></td>
          <td width="50px" colspan=1 bgcolor="#E3E4FA" align="center"><span class="heading"><b>RM Stock(GRN)</b></td>
          <td colspan=2 bgcolor="#E3E4FA" align="center"><span class="heading"><b>FG</b></td>
        </tr>
        <tr border=0>
            <td  colspan=1 bgcolor="#EEEFEE" align="center"><span class="heading"><b>PRN</b></td>
            <td  colspan=1 bgcolor="#EEEFEE" align="center"><span class="heading"><b>PO#</b></td>
            <td  width="350px" colspan=1 bgcolor="#EEEFEE" align="center"><span class="heading"><b>RM Spec</b></td>
            <td width="60px"  colspan=1 bgcolor="#EEEFEE" align="center"><span class="heading"><b>PO Qty</b></td>
            <td width="60px" colspan=1 bgcolor="#EEEFEE" align="center"><span class="heading"><b>Inv Qty</b></td>
            <td width="60px" colspan=1 bgcolor="#EEEFEE" align="center"><span class="heading"><b>Balance<br>Qty</b></td>
            <td width="100px" colspan=1 bgcolor="#EEEFEE" align="center"><span class="heading"><b>WO#</b></td>
            <td width="70px" colspan=1 bgcolor="#EEEFEE" align="center"><span class="heading"><b>Acc Qty</b></td>
        </tr>

<?php

        $result = $newreport->getcrn_details4report();
        while ($myrow = mysql_fetch_row($result)) {
            $flag=0;
            if($myrow[5] != '')
            {
             $bal_qty=$myrow[5];
            }
            else
            {
             $bal_qty = '&nbsp';
            }

            printf('<tr><td  bgcolor="#FFFFFF" align="center"><span class="tabletext">%s</td>
                    <td  bgcolor="#FFFFFF" align="center"><span class="tabletext">%s</td>
                    <td  width="350px" bgcolor="#FFFFFF" align="center"><span class="tabletext">%s</td>
                    <td width="60px"  bgcolor="#FFFFFF" align="center"><span class="tabletext">%s</td>
                    <td width="60px" bgcolor="#FFFFFF" align="center"><span class="tabletext">%s</td>
                    <td width="60px" bgcolor="#FFFFFF" align="center"><span class="tabletext">%s</td>',
                      $myrow[0],
                      $myrow[1],
                      $myrow[2],
                      $myrow[3],
                      'NA',
                      $bal_qty);
         $result4wo =  $newreport->getwo4crn_details($myrow[0]);
         $numrows = mysql_num_rows($result4wo);
         //echo  $numrows;
         if($numrows > 0)
         {
          while($myrow4wo = mysql_fetch_row($result4wo)) {
              if($flag == 0)
              {
                 printf('<td width="100px" bgcolor="#FFFFFF" align="center"><span class="tabletext">%s</td>',$myrow4wo[0]);
                 printf('<td width="70px" bgcolor="#FFFFFF" align="center"><span class="tabletext">%d</td>',$myrow4wo[1]);
                $flag=1;
              }
              else
              {
                printf('<tr><td  bgcolor="#FFFFFF" align="center"><span class="tabletext">&nbsp</td>
                    <td  bgcolor="#FFFFFF" align="center"><span class="tabletext">&nbsp</td>
                    <td  width="350px" bgcolor="#FFFFFF" align="center"><span class="tabletext">&nbsp</td>
                    <td width="60px"  bgcolor="#FFFFFF" align="center"><span class="tabletext">&nbsp</td>
                    <td width="60px" bgcolor="#FFFFFF" align="center"><span class="tabletext">&nbsp</td>
                    <td width="60px" bgcolor="#FFFFFF" align="center"><span class="tabletext">&nbsp</td>');
                    printf('<td width="100px" bgcolor="#FFFFFF" align="center"><span class="tabletext">%s</td>',$myrow4wo[0]);
                    printf('<td width="70px" bgcolor="#FFFFFF" align="center"><span class="tabletext">%d</td>',$myrow4wo[1]);
              
              }
         
         
            }/*end of while for wo*/
           }/*end of if*/
           else
           {
             printf('<td width="100px"bgcolor="#FFFFFF" align="center"><span class="tabletext">&nbsp</td>');
             printf('<td width="70px" bgcolor="#FFFFFF" align="center"><span class="tabletext">&nbsp</td>');
           }
          }

?>
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


<table border = 0 cellpadding=0 cellspacing=0 width=100%>
<tr>
	<td align=left>
  <?php
//  Added on Dec 6,04 for paging

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
    $prev = " <a href=\"stockgrn_status.php?page=$page&totpages=$totpages&scomp=$company_match&swonum=$wonum_match&crn=$crn_match&sdate1=$date1_match&sdate2=$date2_match\">[Prev]</a> ";

    $first = " <a href=\"stockgrn_status.php?page=1&totpages=$totpages&scomp=$company_match&swonum=$wonum_match&crn=$crn_match&sdate1=$date1_match&sdate2=$date2_match\">[First Page]</a> ";
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
  $next = " <a href=\"stockgrn_status.php?page=$page&totpages=$totpages&scomp=$company_match&swonum=$wonum_match&crn=$crn_match&sdate1=$date1_match&sdate2=$date2_match\">[Next]</a> ";

  $last = " <a href=\"stockgrn_status.php?page=$totpages&totpages=$totpages&scomp=$company_match&swonum=$wonum_match&crn=$crn_match&sdate1=$date1_match&sdate2=$date2_match&total_make_cost=$total_qty2make_cost&total_iss_cost=$total_issued_cost\">[Last Page]</a> ";
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
