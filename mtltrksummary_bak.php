<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = June 20, 2004                =
// Filename: company.php                       =
// Copyright of Badari Mandyam, FluentSoft     =
// Revision: v1.0 OMS                          =
// Displays list of comapnies.                 =
//==============================================

@session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}

$userid = $_SESSION['user'];
$_SESSION['pagename'] = 'mtltrk_summary';
//////session_register('pagename');
$usertype = $_SESSION['usertype'];

// First include the class definition
include_once('classes/userClass.php');
include_once('classes/mtl_trackerclass.php');
include_once('classes/displayClass.php');

$newMT = new mtl_trk;
$newdisplay = new display;

$cond0 = "sir.refnum like '%'";
$cond1 = "(to_days(sir.revdate)-to_days('1582-01-01') > 0 ||
                    sir.revdate = '0000-00-00' ||
                    sir.revdate = 'NULL') and
          (to_days(sir.revdate)-to_days('2050-12-31') < 0 ||
                    sir.revdate = '0000-00-00' ||
                    sir.revdate = 'NULL')";

$cond = $cond0 . ' and ' . $cond1;

$stage_insprecnum='';
$oper1='like';
$sort1='refnum';

if ( isset ( $_REQUEST['stage_refno'] ) )
{
     $stageref_match = $_REQUEST['stage_refno'];
     if ( isset ( $_REQUEST['refno_oper'] ) ) {
          $oper1 = $_REQUEST['refno_oper'];
     }
     else {
         $oper1 = 'like';
     }
     if ($oper1 == 'like') {
         $stage_refno = "'" . $_REQUEST['stage_refno'] . "%" . "'";
     }
     else {
         $stage_refno = "'" . $_REQUEST['stage_refno'] . "'";
     }

     $cond0 = "sir.refnum " . $oper1 . " " . $stage_refno;

}
else {
     $stageref_match = '';
}

if ( isset ( $_REQUEST['stage_date1'] ) || isset ( $_REQUEST['stage_date2'] ) )
{
     $sdate1_match = $_REQUEST['stage_date1'];
     $sdate2_match = $_REQUEST['stage_date2'];
     if ( isset ( $_REQUEST['stage_date1']) &&  $_REQUEST['stage_date1'] != '' )
     {
          $date1 = $_REQUEST['stage_date1'];
          $cond11 = "to_days(sir.revdate) " . "> to_days('" . $date1 . "')";
     }
     else
     {
          $cond11 = "(to_days(sir.revdate)-to_days('1582-01-01') > 0 || sir.revdate = 'NULL' || sir.revdate = '0000-00-00')";
     }

     if ( isset ( $_REQUEST['stage_date2'] )  &&  $_REQUEST['stage_date2'] != '')
     {
          $date2 = $_REQUEST['stage_date2'];
          $cond12 = "to_days(sir.revdate) " . "< to_days('" . $date2 . "')";
     }
     else
     {
          $cond12 = "(to_days(sir.revdate)-to_days('2050-12-31') < 0 || sir.revdate = 'NULL' || sir.revdate = '0000-00-00')";
     }
     $cond1 = $cond11 . ' and ' . $cond12;

}

else
{
     $sdate1_match = '';
     $sdate2_match = '';
}

if ( isset ( $_REQUEST['sortfld1'] ) ) {
    $sort1 = $_REQUEST['sortfld1'];
}

$cond = $cond0 . ' and ' . $cond1;


 $userrole = $_SESSION['userrole'];


// echo $cond;
// how many rows to show per page
$rowsPerPage = 1000;

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
<script language="javascript" src="scripts/mtltrk.js"></script>
<html>
<head>
<title>Material Tracker</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">
<form action='mtltrksummary.php' method='post' enctype='multipart/form-data'>
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
			<table width=100% border=0 cellpadding=0 cellspacing=0  >
				<tr><td></td></tr>
				<tr>
					<td>
<?php $newdisplay->dispLinks(''); ?>
</td></tr>
<table width=100% border=0 cellpadding=0 cellspacing=0  >
  <tr bgcolor="DEDFDE"><td width="6"><img src="images/spacer.gif " width="6"></td>
	    <td bgcolor="#FFFFFF">
 <table width=100% border=0 cellpadding=6 cellspacing=0  >
     <tr><td>
          <tr><td><span class="heading"><i>Please click on the PO # to Edit/Delete</i></td></tr>
		</tr>

	<tr><td>
<table width=100% border=0>
  <tr>
  <td><span class="pageheading"><b>Material Trackers</b></td>
  <td colspan=160>&nbsp;</td>
  <td>
  </td>
  </tr>
</table>

<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
        <tr bgcolor="#FFCC00">
            <td  bgcolor="#EEEFEE"><span class="tabletext"><b>PO#</b></td>
            <td  bgcolor="#EEEFEE"><span class="tabletext"><b>Vendor</b></td>
            <td  bgcolor="#EEEFEE"><span class="tabletext"><b>Part#</b></td>
            <td  bgcolor="#EEEFEE"><span class="tabletext"><b>Part Qty</b></td>
        </tr>


<?php
            if ($usertype == 'VEND') 
            {
                 $result = $newMT->getmtltrks4vend($userid);
            }
            else {
                 $result = $newMT->getmtltrks($userid);
            }
            $ponum='';
            while ($myrow = mysql_fetch_row($result)) {
                if ($myrow[3] != 0)
                { 
                    $qty = $myrow[3];
                }
                else 
                {
                    $qty = $myrow[5];
                }
            if($ponum != $myrow[1])
            {
   	        printf('<tr bgcolor="#FFFFFF"><td ><span class="tabletext">
                          <a href="mtltrk_details.php?ponum=%s">%s</td>
                          <td><span class="tabletext">%s</td>
                          <td><span class="tabletext">%s</td>
                          <td><span class="tabletext">%s</td>
                          ',
		         $myrow[0],$myrow[1],
                         $myrow[4],
                         $myrow[2],
                         $qty);
              printf('</td></tr>');
            }
            else
            {
              printf('<tr bgcolor="#FFFFFF"><td> &nbsp;</td>
                          <td><span class="tabletext">%s</td>
                          <td><span class="tabletext">%s</td>
                          <td><span class="tabletext">%s</td>
                          ',
                         $myrow[4],
                         $myrow[2],
                         $qty);
              printf('</td></tr>');
            }
            $ponum = $myrow[1];
        }
?>
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
 /*
//Additions on Dec 29 04 by Jerry George to implement pagination

$numrows = $newSI->getstage_inspCount($cond,$offset,$rowsPerPage);
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
    $prev = " <a href=\"mtltrksummary.php?page=$page&totpages=$totpages\">[Prev]</a> ";

    $first = " <a href=\"mtltrksummary.php?page=1&totpages=$totpages\">[First Page]</a> ";
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
    $next = " <a href=\"mtltrksummary.php?page=$page&totpages=$totpages\">[Next]</a> ";

    $last = " <a href=\"mtltrksummary.php?page=$totpages&totpages=$totpages\">[Last Page]</a> ";
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
// End additions on Dec 29,04      */

?>
								</td>
							</tr>
						</table>
      </FORM>
</body>
</html >

