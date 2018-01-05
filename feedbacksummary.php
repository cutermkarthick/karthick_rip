<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = Mar 22, 2006                 =
// Filename: feedbacksummary.php               =
// Copyright of Badari Mandyam, FluentSoft     =
// Revision: v1.0 OWT                          =
// Displays list of feedback.                  =
//==============================================

session_start();
header("Cache-control: private");
if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}

$userid = $_SESSION['user'];
$_SESSION['pagename'] = 'feedbacksummary';
$dept = $_SESSION['department'];
//////session_register('pagename');
//search part

$cond = "name like '%'";
$sort1='name';
$select='name';
$worec='';
$where1='';
$oper='like';
if ( isset ( $_REQUEST['leads'] ))
{
     $company_match = $_REQUEST['leads'];
   if ($leads_match!='')
{

     if ( isset ( $_REQUEST['leads_oper'] ) )
    {
   	  $oper = $_REQUEST['leads_oper'];
    }
    else
    {
    	 $oper = 'like';
    }
    if ($oper == 'like')
    {
    	$leads = "'" . $_REQUEST['leads'] . "%" . "'";
     }
     else
     {
 	 $leads = "'" . $_REQUEST['leads'] . "'";
     }
     $where1 =$_REQUEST['sleadsfl'];
     $select=$_REQUEST['sleadsfl'];
     $cond = $where1 . " " . $oper . " " . $leads;
}
else
$cond="name like '%'";
}
 else
{
 	$leads_match = '';
 }

if ( isset ( $_REQUEST['sortfld1'] ) )
{
	 $sort1 = $_REQUEST['sortfld1'];
}

//search end
// how many rows to show per page
$rowsPerPage = 20;

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


include_once('classes/loginClass.php');
include('classes/feedbackClass.php');
include_once('classes/displayClass.php');
$newfeedback = new feedback;
$newdisplay = new display;
?>
<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/feedback.js"></script>
<html>
<head>
<title>Feedback Summary</title>
</head>
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
  <tr><td><span class="heading"><i>Please click on leads to Edit/Delete</i></td></tr>
<tr>
<td>
<table width=100% border=0 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF" >
<tr>
<td bgcolor="#F5F6F5" colspan="3"><span class="heading"><b><center>Search Criteria</center></b></td>
	<td bgcolor="#F5F6F5"  colspan="4"><span class="heading"><b><center>Sort Criteria</center></b></td>
	<td bgcolor="#FFFFFF" rowspan=2 align="center">
	<input type= "image" name="submit" src="images/bu-get.gif" value="Get" onclick="javascript: return searchsort_fields()">
	</td>
	</tr>
	<tr>
	<td bgcolor="#FFFFFF"><span class="tabletext"><select name="sleads" size="1" width="50">
		<?php if($select=='id'){?>
    		<option selected>id
    		<option value>name<?php }else {?>
    		<option selected>name
    		<option value>id<?php }?>
    		</select>
    		</td>
    <td bgcolor="#FFFFFF"><span class="tabletext"><select name="leads_oper" size="1" width="50">
    	<?php if($oper=='like'){?>
    		<option selected>like
			<option value>=<?php }else {?>
    		<option selected>=
			<option value>like<?php }?>
    		</td>
	<td bgcolor="#FFFFFF"><input type="text" name="sleads" size=20 value="<?php echo $leads_match ?>" onkeypress="javascript: return checkenter(event)"></td>
	<td bgcolor="#FFFFFF"><span class="labeltext"><b>Sort by</b></td>
	<td bgcolor="#FFFFFF" colspan=3><span class="tabletext"><select name="sort1" size="1" width="100">
    		<option selected>name
    		</select>
			<input type="hidden" name="sortfld1">
			<input type="hidden" name="sleadsfl">
			<input type="hidden" name="leads_oper">
 </td>
</tr>

</table>

<table width=100% border=0>
  <tr>
	<td><span class="pageheading"><b>Feedback Summary</b></td>
	<td colspan=152>&nbsp;</td>
    <td><a href ="new_feedback.php"><img name="Image8" border="0" src="images/bu_newfeedback.gif"></a>
	</td>
  </tr>
</table>

<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
        <tr  bgcolor="#FFCC00">
            <td  bgcolor="#EEEFEE"><span class="tabletext"><b>PRN</b></td>
            <td  bgcolor="#EEEFEE"><span class="tabletext"><b>Reference No.</b></td>
            <td  bgcolor="#EEEFEE"><span class="tabletext"><b>Part Name</b></td>
            <td  bgcolor="#EEEFEE"><span class="tabletext"><b>Date</b></td>

<?php
             $result = $newfeedback->getFeedbacks();
            while ($row = mysql_fetch_assoc($result)) {


            $d=substr($row["docdate"],8,2);
            $m=substr($row["docdate"],5,2);
            $y=substr($row["docdate"],0,4);
            $x=mktime(0,0,0,$m,$d,$y);
            $date=date("M j, Y",$x);
           // echo "$date";



             printf('<tr bgcolor="#FFFFFF"><td ><span class="tabletext">
                          <a href="feedbackDetails.php?feedbackrecnum=%s">%s</td>
                          <td><span class="tabletext">%s</td>
                          <td><span class="tabletext">%s</td>
                          <td><span class="tabletext">%s</td>',
                    $row["recnum"],$row["crn"],
                    $row["refno"],
                    $row["partname"],
                    $date
                   );
              printf('</td></tr>');
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

//$numrows=mysql_num_rows($result);

//Additions on Dec 29 04 by Jerry George to implement pagination

//$numrows = $newLeads ->getleadsCount($cond,$offset,$rowsPerPage);
$numrows=20;
// how many pages we have when using paging?
//echo   $numrows;
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
    $prev = " <a href=\"leadssummary.php?page=$page&totpages=$totpages&sleads=$leads_match&sleadsfl=$where1&leadst_oper=$oper\">[Prev]</a> ";

    $first = " <a href=\"leadssummary.php?page=1&totpages=$totpages&sleads=$leads_match&sleadsfl=$where1&leads_oper=$oper\">[First Page]</a> ";
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
    $next = " <a href=\"leadssummary.php?page=$page&totpages=$totpages&sleads=$leads_match&sleadsfl=$where1&leads_oper=$oper\">[Next]</a> ";

    $last = " <a href=\"leadssummary.php?page=$totpages&totpages=$totpages&sleads=$leads_match&sleadsfl=$where1&leads_oper=$oper\">[Last Page]</a> ";
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
</tr></table>

      </FORM>
</body>
</html >



