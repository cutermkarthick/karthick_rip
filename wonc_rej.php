<?php
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
$cond2= "w.wonum like '%'";
$oper3='like';
$oper4='like';
$cond=$cond1. ' and ' . $cond2;

if ( isset ( $_REQUEST['crn4report'] ) )
{
     $crn_match = $_REQUEST['crn4report'];
     if ( isset ( $_REQUEST['crn_oper'] ) ) {
          $oper3 = $_REQUEST['crn_oper'];
     }
     else {
         $oper3 = 'like';
     }
     if ($oper3 == 'like') {
         $crn = "'" . $_REQUEST['crn4report'] . "%" . "'";
     }
     else {
         $crn = "'" . $_REQUEST['crn4report'] . "'";
     }

     $cond1 = "w.crn_num " . $oper3 . " " . $crn;

}
else {
     $crn_match = '';
}
if ( isset ( $_REQUEST['wo_num4report'] ) )
{
     $wo_match = $_REQUEST['wo_num4report'];
     if ( isset ( $_REQUEST['wo_oper'] ) ) {
          $oper4 = $_REQUEST['wo_oper'];
     }
     else {
         $oper4 = 'like';
     }
     if ($oper4 == 'like') {
         $wonum = "'" . $_REQUEST['wo_num4report'] . "%" . "'";
     }
     else {
         $wonum = "'" . $_REQUEST['wo_num4report'] . "'";
     }

     $cond2 = "w.wonum " . $oper4 . " " . $wonum;

}
else {
     $wo_match = '';
}
$cond=$cond1. ' and ' . $cond2;
?>

<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/report.js"></script>
<html>
<head>
<title>WO Status Report</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">

<?php
include('header.html');

?>
<form action='wonc_rej.php' method='post' enctype='multipart/form-data'>
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
<td bgcolor="#F5F6F5" colspan="4"><span class="heading"><b><center>Search & Sort Criteria</center></b></td>
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
        <input type="text" name="crn4report" size=20 value="<?php echo $crn_match ?>"
         onkeypress="javascript: return checkenter(event)">
</td>

<td bgcolor="#FFFFFF"><span class="labeltext"><b>WO #</b></td>
<td bgcolor="#FFFFFF">
       <select name="wo_oper" size="1" width="100">
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
</select>&nbsp;&nbsp;
        <input type="text" name="wo_num4report" size=20 value="<?php echo $wo_match ?>"
         onkeypress="javascript: return checkenter(event)">
</td>

</tr>
  <table width=100% border=0 >
   <tr><td><span class="heading"><b>Discrepancy Report</b></td>
   </tr>
   </table>
   <tr><td>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
        <tr>
            <td  align=center bgcolor="#EEEFEE"><span class="heading"><b>PRN</b></td>
	        <td   align=center colspan=5 bgcolor="#E8A317"><span class="heading"><b>WO </b></td>
            <td  align=center colspan=4 bgcolor="#43BFC7"><span class="heading"><b>NC</b></td>
            </tr>
            <tr>
            <td  align=center bgcolor="#EEEFEE"><span class="heading"><b></b></td>
            <td  align=center bgcolor="#EEEFEE"><span class="heading"><b>WO #</b></td>
            <td  align=center bgcolor="#EEEFEE"><span class="heading"><b>Rew</b></td>
            <td  align=center bgcolor="#EEEFEE"><span class="heading"><b>Rej</b></td>
            <td  align=center bgcolor="#EEEFEE"><span class="heading"><b>Acc</b></td>
            <td  align=center bgcolor="#EEEFEE"><span class="heading"><b>Stage</b></td>
            <td  align=center bgcolor="#EEEFEE"><span class="heading"><b>NC #</b></td>
            <td  align=center bgcolor="#EEEFEE"><span class="heading"><b>Qty</b></td>
            <td  align=center bgcolor="#EEEFEE"><span class="heading"><b>Status</b></td>
            <td  align=center bgcolor="#EEEFEE"><span class="heading"><b>Stage</b></td>
            </tr>
<tr>
 <?php

 //echo$cond;
 $result=$newreport->getwo_ncdiscrepancy($cond,$offset,$rowsPerPage);

 while($myrow=mysql_fetch_row($result) )
 {
      $result_rej=$newreport->getwo_rejqty($cond,$myrow[1]);
      $myrow_rej=mysql_fetch_row($result_rej);
   //if($myrow[3] != $myrow[4] )
   //{
   //echo$myrow_rej[2]."***";
?>
 <tr>
    <td align=center bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[0]?></td>
    <td align=center bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[1]?></td>
    <td align=center bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow_rej[3]?></td>
    <td align=center bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow_rej[2]?></td>
    <td align=center bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow_rej[4]?></td>
    <td align=center bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow_rej[5]?></td>
    <td align=center bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[2]?></td>
   <?php
   if($myrow_rej[2] != $myrow[3])
   {
   ?>
    <td align=center bgcolor="#FF0000"><span class="tabletext"><?php echo $myrow[3]?></td>
   <?php
   }
   else
   {
   ?>
   <td align=center bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[3]?></td>
   <?php
   }
   ?>
    <td align=center bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[4]?></td>
    <?php
    if($myrow[5]=='yes')
    {
    ?>
    <td align=center bgcolor="#FFFFFF"><span class="tabletext"><?php echo 'In Process'?></td>
    <?php
    }
    else if($myrow[6]=='yes')
    {
    ?>
     <td align=center bgcolor="#FFFFFF"><span class="tabletext"><?php echo 'Final Inspection'?></td>
<?php
 }
 else
 {
 ?>
   <td align=center bgcolor="#FFFFFF"><span class="tabletext"></td>
 <?php
 }
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

$result_rows = $newreport->getwo_ncdiscrepancycount($cond,$offset,$rowsPerPage);
$numrows =mysql_num_rows($result_rows);
//$numrows =10;
//echo $numrows;
 //$numrows =100;
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
    $prev = " <a href=\"wonc_rej.php?page=$page&totpages=$totpages&crn=$crn_match\">[Prev]</a> ";

    $first = " <a href=\"wonc_rej.php?page=1&totpages=$totpages&crn=$crn_match\">[First Page]</a> ";
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
  $next = " <a href=\"wonc_rej.php?page=$page&totpages=$totpages&crn=$crn_match\">[Next]</a> ";

  $last = " <a href=\"wonc_rej.php?page=$totpages&totpages=$totpages&crn=$crn_match\">[Last Page]</a> ";
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

