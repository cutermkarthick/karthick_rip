<?
@session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );
}
$userid = $_SESSION['user'];
$_SESSION['pagename'] = 'reports';
//////session_register('pagename');

$dept = $_SESSION['department'];

include_once('classes/userClass.php');
include_once('classes/loginClass.php');
include('classes/reportClass.php');
include('classes/displayClass.php');

$newlogin = new userlogin;
$newlogin->dbconnect();
$username = $_SESSION['user'];
$newreport = new report;
$newdisplay = new display;

$rowsPerPage = 20;

// by default we show first page
$pageNum = 1;
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
$cond1 = "w.crn_num like '%'";
$oper3='like';
$cond=$cond1;

if ( isset ( $_REQUEST['crn_report'] ) )
{
     $crn_match = $_REQUEST['crn_report'];
     if ( isset ( $_REQUEST['crn_oper'] ) ) {
          $oper3 = $_REQUEST['crn_oper'];
     }
     else {
         $oper3 = 'like';
     }
     if ($oper3 == 'like') {
         $crn = "'" . $_REQUEST['crn_report'] . "%" . "'";
     }
     else {
         $crn = "'" . $_REQUEST['crn_report'] . "'";
     }

     $cond1 = "w.crn_num " . $oper3 . " " . $crn;

}
else {
     $crn_match = '';
}

$cond=$cond1;
?>
   <link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/report.js"></script>
<html>
<head>
<title>WO-FI QTY Report</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">

<?php
include('header.html');

?>
<form action='wofiqtyReport.php' method='post' enctype='multipart/form-data'>
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
	<table width=100% border=0 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF" >
<tr>
<td bgcolor="#F5F6F5" colspan="2"><span class="heading"><b><center>Search & Sort Criteria</center></b></td>
<td bgcolor="#FFFFFF" rowspan=3 colspan=4 align="center"><span class="tabletext">
<input type="image" name="Submit" src="images/bu-get.gif" value="Get">
</td>
</tr>
<tr>
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
</select>&nbsp;&nbsp;
        <input type="text" name="crn_report" size=20 value="<?php echo $crn_match ?>">
</td>

</tr>
  <table width=100% border=0 >
   <tr><td><span class="heading"><b>Discrepancy Report</b></td>
   </tr>
   </table>
   <tr><td>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
        <tr>
            <td bgcolor="#EEEFEE"><span class="heading"><b>PRN</b></td>
            <td  bgcolor="#EEEFEE"><span class="heading"><b>Cust<br> WO#</b></td>
            <td  bgcolor="#EEEFEE"><span class="heading"><b>WO Type</b></td>
            <td  bgcolor="#EEEFEE"><span class="heading"><b>WO Status</b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b>Date Code</b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b>WO Qty</b></td>
	        <td bgcolor="#EEEFEE"><span class="heading"><b>Qty(FI)</b></td>
	        </tr>
<?php
$result=$newreport->getwo_fiQty($cond,$offset,$rowsPerPage);
while($myrow=mysql_fetch_row($result))
{
    if($myrow[4] != '0000-00-00' && $myrow[4] != '' && $myrow[4] != 'NULL')
      {
              $datearr = split('-', $myrow[4]);
              $d=$datearr[2];
              $m=$datearr[1];
              $y=$datearr[0];
       $x=mktime(0,0,0,$m,$d,$y);
       $date_code=date("M j, Y",$x);
      }
      else
      {
        $date_code = '';
      }
?>
<tr>
               <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[0] ?></td>
               <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[1] ?></td>
               <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[2] ?></td>
               <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[3] ?></td>
               <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $date_code ?></td>
               <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[5] ?></td>
               <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[6] ?></td>
<?php
}
?>
</tr>
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

//$numrows = $newreport->getwo_fiQty_count($offset,$rowsPerPage);
$result_count = $newreport->getwo_fiQty_count($cond,$offset,$rowsPerPage);
$numrows= mysql_num_rows($result_count);
//$numrows =10;
//echo $numrows."***".$rowsPerPage."<br>";
 //$numrows =100;
// how many pages we have when using paging?
$maxPage = ceil($numrows/$rowsPerPage);
//echo"<br>".$maxPage."*-*-*-*-*";
if (!isset($_REQUEST['page']))
{
    $totpages = $maxPage;
}

$self = $_SERVER['PHP_SELF'];

// creating 'previous' and 'next' link
// plus 'first page' and 'last page' link

// print 'previous' link only if we're not &swonum=$wonum_match&crn=$crn_match
// on page one
if ($pageNum > 1)
{
    $page = $pageNum - 1;
    $prev = " <a href=\"wofiqtyReport.php?page=$page&totpages=$totpages\">[Prev]</a> ";

    $first = " <a href=\"wofiqtyReport.php?page=1&totpages=$totpages\">[First Page]</a> ";
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
  $next = " <a href=\"wofiqtyReport.php?page=$page&totpages=$totpages\">[Next]</a> ";

  $last = " <a href=\"wofiqtyReport.php?page=$totpages&totpages=$totpages\">[Last Page]</a> ";
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

