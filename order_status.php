<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = Dec 27 ,2007                 =
// Filename: order_status.php                  =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OWT                          =
// Displays Wo Status report partwise          =
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
$rowsPerPage = 20;

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

include('classes/reportClass.php');
include('classes/displayClass.php');
$newreport = new report;
$newdisplay = new display;
?>

<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<html>
<head>
<title>WO Status Report</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">
	
<?php
include('header.html');

?>
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
   <tr><td><span class="heading"><b>WO Status Report</b></td>
    <td colspan=190>&nbsp;</td>

    </tr>
   </table>



<!--
<table width=100% border=0 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF" >


<tr><td>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
        <tr>
            <td bgcolor="#EEEFEE"><span class="heading"><b>Customer</b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b>Cust PO</b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b>PO Date</b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b>Part #</b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b>PO Qty</b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b>PRN</b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b>WO</b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b>WO Qty</b></td>
        </tr>

<?php      
        $result = $newreport->wopartstatus();
        while ($myrow = mysql_fetch_row($result)) {
            printf('<tr><td bgcolor="#FFFFFF"><span class="tabletext">%s</td>
                    <td bgcolor="#FFFFFF"><span class="tabletext">%s</td>
                    <td bgcolor="#FFFFFF"><span class="tabletext">%s</td>
                    <td bgcolor="#FFFFFF"><span class="tabletext">%s</td>
                    <td bgcolor="#FFFFFF"><span class="tabletext">%s</td>
                    <td bgcolor="#FFFFFF"><span class="tabletext">%s</td>
                    <td bgcolor="#FFFFFF"><span class="tabletext">%s</td>
                    <td bgcolor="#FFFFFF"><span class="tabletext">%s</td>',
                      $myrow[0],
                      $myrow[1], 
                      $myrow[2],
                      $myrow[3],
                      $myrow[4],
                      $myrow[5],
                      $myrow[6],
                      $myrow[7]);
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


<table border = 0 cellpadding=0 cellspacing=0 width=100% >
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
    $prev = " <a href=\"order_status.php\">[Prev]</a> ";

    $first = " <a href=\"order_status.php\">[First Page]</a> ";
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
  $next = " <a href=\"order_status.php\">[Next]</a> ";

  $last = " <a href=\"order_status.php\">[Last Page]</a> ";
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