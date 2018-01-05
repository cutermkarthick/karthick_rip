<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = March 15,2005                =
// Filename: boardReport.php                   =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OMS                          =
// Socket report                               =
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
$cond1 = "c.name like '%'";

$cond2 = "w.wonum like '%'";
$cond3 = "(to_days(w.sch_due_date)-to_days('1582-01-01') > 0 ||
                    w.sch_due_date = 'NULL') and
           (to_days(w.sch_due_date)-to_days('2050-12-31') < 0 ||
               w.sch_due_date = 'NULL')";

$cond = $cond1 . ' and ' . $cond2 . ' and ' . $cond3;

$worec='';
$oper1='like';
$oper2='like';
$sort1='wo';
$sort2='company';
$sess=session_id();


if ( isset ( $_REQUEST['scomp'] ) )
{
	 if($_REQUEST['scomp'] =='')
	 {
		$company_match = '';
	  }
	  else
	  {
		 $company_match=$_REQUEST['scomp'];
		  if ( isset ( $_REQUEST['company_oper'] ) )
		  {
			 $oper1 = $_REQUEST['company_oper'];
		   }
		   else
		   {
			 $oper1 = 'like';
			 $oper1 = 'like';
		     }
		     if ($oper1 == 'like')
		    {
		  	   $scomp = "'" . $_REQUEST['scomp'] . "%" . "'";
		     }
		     else
		     {
		       	    $scomp = "'" . $_REQUEST['scomp'] . "'";
		      }

		     $cond1 = "c.name " . $oper1 . " " . $scomp;
		    $cond11 = "c.name " . $oper1 . " " . $scomp;
	     }
 }
else
$company_match = '';


if ( isset ( $_REQUEST['swonum'] ) )
{
	if($_REQUEST['swonum'] =='')
	{
		$wonum_match = '';
	 }
	 else
	 {
		   $wonum_match=$_REQUEST['swonum'];

		   if ( isset ( $_REQUEST['wonum_oper'] ) )
		  {
			    $oper2 = $_REQUEST['wonum_oper'];
	       	   }
		   else
	                   {
		    	$oper2 = 'like';
		    }
	   	   if ($oper2 == 'like')
		  {
		    	$swonum = "'" . $_REQUEST['swonum'] . "%" . "'";
	 	   }
	 	  else
	 	  {
		     	$swonum = "'" . $_REQUEST['swonum'] . "'";
	 	   }

	 	 $cond2 = "w.wonum " . $oper2 . " " . $swonum;
	  }

}
else
	$wonum_match = '';



if ( isset ( $_REQUEST['sdate1'] ) || isset ( $_REQUEST['sdate2'] ) )
{
      if($_REQUEST['sdate1'] =='' || $_REQUEST['sdate2']=='' )
      {
		$date1_match = '';
		$date2_match = '';
       }
       else
       {

	      $date1_match = $_REQUEST['sdate1'];
	      $date2_match = $_REQUEST['sdate2'];
	     if ( isset ( $_REQUEST['sdate1']) &&  $_REQUEST['sdate1'] != '' )
     	     {
	          $date1 = $_REQUEST['sdate1'];
	          $cond31 = "to_days(w.sch_due_date) " . "> to_days('" . $date1 . "')";
	     }
	     else
	     {
	          $cond31 = "(to_days(w.sch_due_date)-to_days('1582-01-01') > 0 || w.sch_due_date = 'NULL')";
	     }

	     if ( isset ( $_REQUEST['sdate2'] )  &&  $_REQUEST['sdate2'] != '')
	     {
	          $date2 = $_REQUEST['sdate2'];
	          $cond32 = "to_days(w.sch_due_date) " . "< to_days('" . $date2 . "')";
	     }
	     else
	     {
	          $cond32 = "(to_days(w.sch_due_date)-to_days('2050-12-31') < 0 || w.sch_due_date = 'NULL')";
	     }
	     $cond3 = $cond31 . ' and ' . $cond32;
           }

}
else
{
	    $date1_match = '';
	    $date2_match = '';

}

if ( isset ( $_REQUEST['sortfld1'] ) )
{
		 $sort1=$_REQUEST['sortfld1'];
}
if ( isset ( $_REQUEST['sortfld2'] ) )
{
		 $sort2 = $_REQUEST['sortfld2'];
}

$cond = $cond1 . ' and ' . $cond2 . ' and ' . $cond3;




// First include the class definition

include_once('classes/userClass.php');
include_once('classes/loginClass.php');
include('classes/reportClass.php');
include('classes/displayClass.php');

$newlogin = new userlogin;
$newlogin->dbconnect();
$username = $_SESSION['user'];
$newreport = new report;
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
<title>Socket Wo Status</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">

<?php
include('header.html');
?>
     <form>

<table width=100% cellspacing="0" cellpadding="6" border="0">
	<tr>
		<td>
			<table width=100% border=0 cellspacing="0" cellpadding="0">
   				<tr>
        					<td><span class="welcome"><b>Welcome <?php echo $userid?></b></td>
        					<td align="right"><a href="chPassword.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image15','','images/chpwd_mo.gif',1)"><img name="Image15" border="0" src="images/chpwd.gif"></a>
       					<a href="exit.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image16','','images/logout_mo.gif',1)"><img name="Image16" border="0" src="images/logout.gif"></a></td>
        				 </tr>
			</table>
<table width=100% border=0 cellpadding=0 cellspacing=0  >
	<tr><td>

	</td></tr>
	<tr>
	<td>
<?php $newdisp->dispLinks(''); ?>
<table width=100% border=0 cellpadding=0 cellspacing=0  >



			<tr bgcolor="DEDFDE">
  				<td width="6"><img src="images/spacer.gif " width="6"></td>
				<td bgcolor="#FFFFFF">

<table width=100% border=0 >
<tr><td><span class="heading"><b>Socket Report</b></td>
<td colspan=210>&nbsp;</td>
<td><a href="javascript:printSocketreport()"><img name="Image7" border="0" src="images/bu-print.gif"></a></td>
</tr>
</table>
<table width=100% border=0 cellpadding=6 cellspacing=0  >
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
<td bgcolor="#FFFFFF" ><input type="text" name="scomp" size=20 value="<?php echo $company_match ?>" onkeypress="javascript: return checkenter(event)">
</td>

<td bgcolor="#FFFFFF"><span class="labeltext"><b>WO # &nbsp&nbsp</b><span class="tabletext"></td>
 <td  bgcolor="#FFFFFF"><span class="tabletext">  <select name="wonum_oper" size="1" width="100">
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
<td bgcolor="#FFFFFF" colspan=2><input type="text" name="swonum" size=20 value="<?php echo $wonum_match ?>" onkeypress="javascript: return checkenter(event)">
</td>

</tr>
<tr>
<td colspan=3 bgcolor="#FFFFFF"><span class="labeltext"><b>	           Sch Due:   </b><br>From
        <input type="text" name="sdate1" size=10 value="<?php echo $date1_match ?>"
         onkeypress="javascript: return checkenter(event)">
        <img src="images/bu-getdateicon.gif" alt="Get Date" onclick='GetDate("sdate1")'>
         <span class="labeltext"><b>&nbsp&nbspTo</b>
        <input type="text" name="sdate2" size=10 value="<?php echo $date2_match ?>"
         onkeypress="javascript: return checkenter(event)">
        <img src="images/bu-getdateicon.gif" alt="Get Date" onclick='GetDate("sdate2")'>
</td>

<td bgcolor="#FFFFFF"><span class="labeltext"><b>Sort on</b>
<span class="tabletext"><select name="sort1" size="1" width="100">

<?php

      if ($sortl == 'wo')
      {
?>
	<option selected>wo
	<option selected>company
<?php
      }
      else {
?>
	<option selected>company
	<option selected>wo
<?php
      }
?>
</select></td>
<td bgcolor="#FFFFFF" colspan=3><span class="labeltext"><b>Sort on</b>
<span class="tabletext" ><select name="sort2" size="1" width="100">
<?php
      if ($sort2 == 'wo')
      {
?>
	<option selected>wo
	<option selected>company
<?php
      }
      else {
?>
	<option selected>company
	<option selected>wo
<?php
      }
?>
</select>

<input type="hidden" name="sortfld1">
<input type="hidden" name="sortfld2">
<?php
$_SESSION['printcond'] = $cond;
//////session_register('printcond');
?>
<input type="hidden" name="cond" value="<?php echo "$cond";?>">
</td>

</tr>
</table>

</td></tr>
<table width=100% border=0 cellpadding=3 cellspacing=1>


<tr><td><span class="pageheading"><b>Status of Socket Open Work Orders</b></td></tr>

<tr><td>

<table width=100% border=0 cellpadding=3 cellspacing=1  bgcolor="#DFDEDF">

<tr>
	<td bgcolor="#EEEFEE"><span class="heading"><b>WO</b></td>
	<td bgcolor="#EEEFEE"><span class="heading"><b><center>Company</center></b></td>
	<td bgcolor="#EEEFEE"><span class="heading"><b><center>Sch Due</center></b></td>
<?php
         $numstages = 0;
         $result = $newreport->getWFstages('Socket');
         while ($wfstage = mysql_fetch_row($result)) {

               printf('<td bgcolor="#EEEFEE"><b><span class="heading">%s</b></td>
                      ',
		         $wfstage[0]
               );
               $numstages = $numstages + 1;
         }
?>

</tr>

<?php

            $result = $newreport->getWOs('Socket',$cond,$offset, $rowsPerPage);

            $appr = 1;
            while ($myrow = mysql_fetch_row($result)) {
                 $str = '<tr bgcolor="#FFFFFF"><td><span class="tabletext">' . $myrow[0] . '</td><td><span class="tabletext">' . $myrow[1] . "</td>". '</td><td><span class="tabletext">' . $myrow[2] . "</td>";
                 $tl = $newreport->getdates4WO($myrow[3]);
                 while ($mytl = mysql_fetch_row($tl)) {
                     $str = $str . '<td><span class="tabletext">' . $mytl[0] . "</td>";
                     $appr++;
                 }
                 print $str;
                 while ($appr <= $numstages)
                 {
                     print('<td bgcolor="#FFFFFF"></td>');
                     $appr++;
                 }
                 $appr = 1;
              }

             print("</tr>");

?>

      </FORM>





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

$numrows = $newreport->getWOcount($offset, $rowsPerPage,'Socket');
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
    $prev = " <a href=\"socketReport.php?page=$page&totpages=$totpages\">[Prev]</a> ";

    $first = " <a href=\"socketReport.php?page=1&totpages=$totpages\">[First Page]</a> ";
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
    $next = " <a href=\"socketReport.php?page=$page&totpages=$totpages\">[Next]</a> ";

    $last = " <a href=\"socketReport.php?page=$totpages&totpages=$totpages\">[Last Page]</a> ";
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