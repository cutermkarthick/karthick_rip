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

$rowsPerPage = 10;

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
$cond1 = "md.CIM_refnum like '%'";
$oper3='like';
$cond=$cond1;

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

     $cond1 = "md.CIM_refnum " . $oper3 . " " . $crn;

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
<title>Master Data Discrepancy Report</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">

<?php
include('header.html');

?>
<form action='masterDiscrepancy.php' method='post' enctype='multipart/form-data'>
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
        <input type="text" name="crn" size=20 value="<?php echo $crn_match ?>"
         onkeypress="javascript: return checkenter(event)">
</td>

</tr>
  <table width=100% border=0 >
   <tr><td><span class="heading"><b>Master Data Discrepancy Report</b></td>
   </tr>
   </table>
   <tr><td>
<table width=1220px border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
           <tr>
            <td align=center bgcolor="#EEEFEE"><span class="heading"><b>PRN</b></td>
	        <td align=center colspan=6  bgcolor="#E8A317"><span class="heading"><b>Master Data</b></td>
            <td align=center colspan=6 bgcolor="#43BFC7"><span class="heading"><b>RM Master</b></td>
           </tr>
           <tr>
            <td bgcolor="#EEEFEE" width=100px><span class="heading"><b></b></td>
            <td bgcolor="#EEEFEE" width=100px><span class="heading"><b>RM Type</b></td>
            <td bgcolor="#EEEFEE" width=100px><span class="heading"><b>RM Spec</b></td>
            <td bgcolor="#EEEFEE" width=100px><span class="heading"><b>Grainflow</b></td>
	        <td bgcolor="#EEEFEE" width=100px><span class="heading"><b>Length</b></td>
            <td bgcolor="#EEEFEE" width=100px><span class="heading"><b>Width</b></td>
            <td bgcolor="#EEEFEE" width=100px><span class="heading"><b>Thickness</b></td>
            <td bgcolor="#EEEFEE" width=100px><span class="heading"><b>RM Type</b></td>
            <td bgcolor="#EEEFEE" width=100px><span class="heading"><b>RM Spec</b></td>
            <td bgcolor="#EEEFEE" width=100px><span class="heading"><b>Grainflow</b></td>
	        <td bgcolor="#EEEFEE" width=100px><span class="heading"><b>Length</b></td>
            <td bgcolor="#EEEFEE" width=100px><span class="heading"><b>Width</b></td>
            <td bgcolor="#EEEFEE" width=100px><span class="heading"><b>Thickness</b></td>
           </tr>

 <?php
 $matchflag=0;
 //echo$cond;
 $result=$newreport->getDiscrepancy_master($cond,$offset,$rowsPerPage);
 while($myrow=mysql_fetch_row($result)){

 if((trim($myrow[0]) == trim($myrow[6]) )
    && (trim($myrow[1]) == trim($myrow[7]) )
    && (trim($myrow[2]) == trim($myrow[11]) )
    &&(trim($myrow[3]) == trim($myrow[8]) )
    && (trim($myrow[4]) == trim($myrow[9]))
    && (trim($myrow[5]) == trim($myrow[10])))
 {
    $matchflag=1;
 ?>
 <tr>
               <td bgcolor="#FFFFFF" width=100px><span class="tabletext"><?php echo $myrow[12]?></td>
               <td bgcolor="#FFFFFF" width=100px><span class="tabletext"><?php echo $myrow[0]?></td>
               <td bgcolor="#FFFFFF" width=100px><span class="tabletext"><?php echo wordwrap($myrow[1],25,"<br />\n")?></td>
               <td bgcolor="#FFFFFF" width=100px><span class="tabletext"><?php echo $myrow[2]?></td>
               <td bgcolor="#FFFFFF" width=100px><span class="tabletext"><?php echo $myrow[3] ?></td>
               <td bgcolor="#FFFFFF" width=100px><span class="tabletext"><?php echo $myrow[4] ?></td>
               <td bgcolor="#FFFFFF" width=100px><span class="tabletext"><?php echo $myrow[5] ?></td>


<?php
 }
     else
 {
      $matchflag=0;

 ?>
 <tr>
               <td bgcolor="#FFFFFF" width=100px><span class="tabletext"><?php echo $myrow[12]?></td>
               <td bgcolor="#FFFFFF" width=100px><span class="tabletext"><?php echo $myrow[0]?></td>
               <td bgcolor="#FFFFFF" width=100px><span class="tabletext"><?php echo wordwrap($myrow[1],25,"<br />\n")?></td>
               <td bgcolor="#FFFFFF" width=100px><span class="tabletext"><?php echo $myrow[2]?></td>
               <td bgcolor="#FFFFFF" width=100px><span class="tabletext"><?php echo $myrow[3] ?></td>
               <td bgcolor="#FFFFFF" width=100px><span class="tabletext"><?php echo $myrow[4] ?></td>
               <td bgcolor="#FFFFFF" width=100px><span class="tabletext"><?php echo $myrow[5] ?></td>

 <?php
 }
          if((trim($myrow[0]) == trim($myrow[6]) ))
                     {

               ?>
                <td bgcolor="#FFFFFF" width=100px><span class="tabletext"><?php echo $myrow[6] ?></td>
                <?php }
               else
               {
               ?>
                <td bgcolor="#FF0000" width=100px><span class="tabletext"><?php echo $myrow[6] ?></td>
               <?php
               }
               if((trim($myrow[1]) == trim($myrow[7]) ))
                     {

               ?>
                <td bgcolor="#FFFFFF" width=100px><span class="tabletext"><?php echo wordwrap($myrow[7],25,"<br />\n"); ?></td>
                <?php }
               else
               {
               ?>
                <td bgcolor="#FF0000" width=100px><span class="tabletext"><?php echo wordwrap($myrow[7],25,"<br />\n"); ?></td>
               <?php
               }
                if((trim($myrow[2]) == trim($myrow[11])))
                     {

               ?>
                <td bgcolor="#FFFFFF" width=100px><span class="tabletext"><?php echo $myrow[11] ?></td>
                <?php }
               else
               {
               ?>
                <td bgcolor="#FF0000" width=100px><span class="tabletext"><?php echo $myrow[11] ?></td>
               <?php
               }
               ?>
               <?php if((trim($myrow[3]) == trim($myrow[8]) ))
                     {

               ?>
                <td bgcolor="#FFFFFF" width=100px><span class="tabletext"><?php echo $myrow[8] ?></td>
                <?php }
               else
               {
               ?>
                <td bgcolor="#FF0000" width=100px><span class="tabletext"><?php echo $myrow[8] ?></td>
               <?php
               }
              if((trim($myrow[4]) == trim($myrow[9]) ))
                     {

               ?>
                <td bgcolor="#FFFFFF" width=100px><span class="tabletext"><?php echo $myrow[9] ?></td>
                <?php }
               else
               {
               ?>
                <td bgcolor="#FF0000" width=100px><span class="tabletext"><?php echo $myrow[9] ?></td>
               <?php
               }
              if((trim($myrow[5]) == trim($myrow[10])))
                     {

               ?>
                <td bgcolor="#FFFFFF" width=100px><span class="tabletext"><?php echo $myrow[10] ?></td>
                <?php }
               else
               {
               ?>
                <td bgcolor="#FF0000" width=100px><span class="tabletext"><?php echo $myrow[10] ?></td>
               <?php
               }
               ?>
               </tr>
<?php
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

$numrows = $newreport->getDiscrepancy_mastercount($cond,$offset,$rowsPerPage);
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
    $prev = " <a href=\"masterDiscrepancy.php?page=$page&totpages=$totpages&crn=$crn_match\">[Prev]</a> ";

    $first = " <a href=\"masterDiscrepancy.php?page=1&totpages=$totpages&crn=$crn_match\">[First Page]</a> ";
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
  $next = " <a href=\"masterDiscrepancy.php?page=$page&totpages=$totpages&swonum=$wonum_match&crn=$crn_match&state=$state_match&milestone_search=$milestone_match\">[Next]</a> ";

  $last = " <a href=\"masterDiscrepancy.php?page=$totpages&totpages=$totpages&swonum=$wonum_match&crn=$crn_match&state=$state_match&milestone_search=$milestone_match\">[Last Page]</a> ";
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

