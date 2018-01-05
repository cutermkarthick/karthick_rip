<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = June 20, 2004                =
// Filename: advlicSummary.php               =
// Copyright of Fluent Technologies            =
// Revision: v1.0 WMS                          =
// Displays list of Dispatchs.                 =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];
$_SESSION['pagename'] = 'advlicSummary';
//////session_register('pagename');

// First include the class definition
include_once('classes/userClass.php');
include_once('classes/advlicClass.php');
include_once('classes/advlicliClass.php');
include_once('classes/displayClass.php');

$newadv = new advlic;
$newdisplay = new display;


$cond0 = " adv.adv_license like '%'";
$cond1 = " advli.crn like '%'";

/*$cond2 =  "(to_days(d.disp_date)-to_days('1582-01-01') > 0 ||
                   d.disp_date = '0000-00-00' ||
                    d.disp_date = 'NULL' ) and
           (to_days(d.disp_date)-to_days('2050-12-31') < 0 ||
                    d.disp_date = '0000-00-00' ||
                    d.disp_date = 'NULL')"; */

$cond = $cond0 . ' and ' . $cond1 ;

//$final_insprecnum='';
$oper1='like';
$oper2='like';
$oper3='like';
//$sort1='d.relnotenum';

if ( isset ( $_REQUEST['final_licno'] ) )
{
     $final_licmatch = $_REQUEST['final_licno'];
     if ( isset ( $_REQUEST['advlicno_oper'] ) ) {
          $oper1 = $_REQUEST['advlicno_oper'];
     }
     else {
         $oper1 = 'like';
     }
     if ($oper1 == 'like') {
         $final_licno = "'" . $_REQUEST['final_licno'] . "%" . "'";
     }
     else {
         $final_licno = "'" . $_REQUEST['final_licno'] . "'";
     }

     $cond0 = "adv.adv_license " . $oper1 . " " . $final_licno;

}
else {
     $final_licmatch = '';
}


if ( isset ( $_REQUEST['final_crn'] ) )
{
     $final_crnmatch = $_REQUEST['final_crn'];
     if ( isset ( $_REQUEST['crn_oper'] ) ) {
          $oper2 = $_REQUEST['crn_oper'];
     }
     else {
         $oper2 = 'like';
     }
     if ($oper2 == 'like') {
         $final_crn = "'" . $_REQUEST['final_crn'] . "%" . "'";
     }
     else {
         $final_crn = "'" . $_REQUEST['final_crn'] . "'";
     }

     $cond1 = "advli.crn " . $oper2 . " " . $final_crn;

}
else {
     $final_crnmatch = '';
}


/*if ( isset ( $_REQUEST['ddate1'] ) || isset ( $_REQUEST['ddate2'] ) )
{
     $ddate1_match = $_REQUEST['ddate1'];
     $ddate2_match = $_REQUEST['ddate2'];
     if ( isset ( $_REQUEST['ddate1']) &&  $_REQUEST['ddate1'] != '' )
     {
          $date1 = $_REQUEST['ddate1'];
          $cond21 = "to_days(d.disp_date) " . "> to_days('" . $date1 . "')";
     }
     else
     {
          $cond21 = "(to_days(d.disp_date)-to_days('1582-01-01') > 0 || d.disp_date = 'NULL' || d.disp_date = '0000-00-00')";
     }

     if ( isset ( $_REQUEST['ddate2'] )  &&  $_REQUEST['ddate2'] != '')
     {
          $date2 = $_REQUEST['ddate2'];
          $cond22 = "to_days(d.disp_date) " . "< to_days('" . $date2 . "')";
     }
     else
     {
          $cond22 = "(to_days(d.disp_date)-to_days('2050-12-31') < 0 || d.disp_date = 'NULL' || d.disp_date = '0000-00-00')";
     }
     $cond2 = $cond21 . ' and ' . $cond22;

}
else
{
     $ddate1_match = '';
     $ddate2_match = '';
}


if ( isset ( $_REQUEST['sortfld1'] ) ) {
    $sort1 = $_REQUEST['sortfld1'];

} */


$cond = $cond0 . ' and ' . $cond1;
//echo $cond;

$userrole = $_SESSION['userrole'];

// echo $cond;
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

 //echo $offset;

?>
<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/advlic.js"></script>

<html>
<head>
<title>Advance License Summary</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">
<form action='advlicSummary.php' method='post' enctype='multipart/form-data'>
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
			<table width=100% border=0 cellpadding=0 cellspacing=0>
				<tr><td></td></tr>
				<tr>
					<td>
<?php $newdisplay->dispLinks(''); ?>
</td></tr>
<table width=100% border=0 cellpadding=0 cellspacing=0>
  <tr bgcolor="DEDFDE"><td width="6"><img src="images/spacer.gif " width="6"></td>
	    <td bgcolor="#FFFFFF">
 <table width=100% border=0 cellpadding=6 cellspacing=0>
     <tr><td>
          <tr><td><span class="heading"><i>Please click on the Advance Lic# link for Details and Edit</i></td></tr>
		</tr>
  <tr>
<td>

<table width=100% border=0 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF">
  <tr>
	<td bgcolor="#F5F6F5" colspan="13"><span class="heading"><b><center>Search Criteria</center></b></td>
    <td bgcolor="#FFFFFF" rowspan=3 align="center">
	<input type= "image" name="submit" src="images/bu-get.gif" value="Get" onclick="javascript: return searchsort_fields()">


<input type="hidden" name="advlicno_oper">
<input type="hidden" name="wo_oper">
	</td>
  </tr>
<tr>
<td bgcolor="#FFFFFF"><span class="labeltext"><b>Advance Lic#</b></td>

<td bgcolor="#FFFFFF"><span class="tabletext"><select name="advlicno_oper" size="1" width="20">
<?php
   if ( isset ( $_REQUEST['advlicno_oper'] ) ){
          $check2 = $_REQUEST['advlicno_oper'];

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
</select></td>

<td bgcolor="#FFFFFF"><input type="text" name="final_licno" size=15 value="<?php echo $final_licmatch ?>" onkeypress="javascript: return checkenter(event)">
</td>

<td bgcolor="#FFFFFF"><span class="labeltext"><b>PRN</b></td>

<td bgcolor="#FFFFFF"><span class="tabletext"><select name="crn_oper" size="1" width="50">
<?php
   if ( isset ( $_REQUEST['crn_oper'] ) ){
          $check2 = $_REQUEST['crn_oper'];

                   if ($check2 =='like'){
?>
    	            <option value>=
	                <option selected>like
<?php
                    }else{
?>
                    <option selected>=
	                <option value>like

 <?php
                    }
   }else{
?>
 	<option selected>like
	<option value>=
 <?php
  }
 ?>
</select></td>

<td colspan=8 bgcolor="#FFFFFF"><input type="text" name="final_crn" size=15 value="<?php echo $final_crnmatch ?>" onkeypress="javascript: return checkenter(event)">
</td>
</tr>

<!-- <tr>
<td colspan=13 bgcolor="#FFFFFF"><span class="labeltext"><b>Dispatch Date:  From &nbsp&nbsp</b>
        <input type="text" name="ddate1" size=10 value="<?php echo $ddate1_match ?>"
         onkeypress="javascript: return checkenter(event)">
        <img src="images/bu-getdateicon.gif" alt="Get Date" onclick='GetDate("ddate1")'>
         <span class="labeltext"><b>&nbsp;&nbsp;To</b>
        <input type="text" name="ddate2" size=10 value="<?php echo $ddate2_match ?>"
         onkeypress="javascript: return checkenter(event)">
        <img src="images/bu-getdateicon.gif" alt="Get Date" onclick='GetDate("ddate2")'>
</td>
-->
</tr>

</table>
<tr><td>
<table width=100% border=0>
  <tr>
  <td><span class="pageheading"><b>List of Advance License</b></td>
  <td colspan=200>&nbsp;</td>
  <td><a href ="advlicEntry.php"><img name="Image8" border="0" src="images/new.gif"></a>
  </td>
  </tr>
</table>

<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
        <tr  bgcolor="#FFCC00">
            <td width="2%" bgcolor="#EEEFEE"><span class="tabletext"><b>Advance Lic#</b></td>
            <td width="2%" bgcolor="#EEEFEE"><span class="tabletext"><b>License Date</b></td>
            <td width="2%" bgcolor="#EEEFEE"><span class="tabletext"><b>Partnum</b></td>
            <td width="2%" bgcolor="#EEEFEE"><span class="tabletext"><b>Partname</b></td>
            <td width="2%" bgcolor="#EEEFEE"><span class="tabletext"><b>PRN</b></td>

        </tr>

<?php

     $result = $newadv->getlic4summary($cond,$offset,$rowsPerPage);

            while ($myrow = mysql_fetch_row($result)) {
              if($myrow[2] != '' && $myrow[2] != '0000-00-00')
               {
                 $datearr = split('-', $myrow[2]);
                 $d=$datearr[2];
                 $m=$datearr[1];
                 $y=$datearr[0];
                 $x=mktime(0,0,0,$m,$d,$y);
                 $date1=date("M j, Y",$x);
               }
               else
               {
                 $date1 = '';
               }
   	       echo '<tr bgcolor="#FFFFFF"><td><span class="tabletext">';
               echo "<a href=\"advlicDetails.php?advlicrecnum=$myrow[0]\">$myrow[1]</td>";
               echo "<td><span class=\"tabletext\">$date1</td>";
               echo "<td><span class=\"tabletext\">$myrow[3]</td>";
               echo "<td><span class=\"tabletext\">$myrow[4]</td>";
               echo "<td><span class=\"tabletext\">$myrow[5]</td>";
               echo '</td></tr>';
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
$numrows = $newadv->getadvlicCount($cond,$offset,$rowsPerPage);

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
    $prev = " <a href=\"advlicSummary.php?page=$page&totpages=$totpages&final_crn=$final_crnmatch&final_licno=$final_licmatch\">[Prev]</a> ";

    $first = " <a href=\"advlicSummary.php?page=1&totpages=$totpages&final_crn=$final_crnmatch&final_licno=$final_licmatch\">[First Page]</a> ";
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
    $next = " <a href=\"advlicSummary.php?page=$page&totpages=$totpages&final_crn=$final_crnmatch&final_licno=$final_licmatch\">[Next]</a> ";

    $last = " <a href=\"advlicSummary.php?page=$totpages&totpages=$totpages&final_crn=$final_crnmatch&final_licno=$final_licmatch\">[Last Page]</a> ";
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
else        {
echo "<span class=\"labeltext\"><align=\"center\">No matching records found";
}
// End additions on Dec 29,04

?>
								</td>
							</tr>
						</table>
      </FORM>
</body>
</html>

