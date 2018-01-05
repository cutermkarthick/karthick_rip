<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = June 18, 2008                =
// Filename: qa4efficiency.php                 =
// Copyright of Badari Mandyam, FluentSoft     =
// Revision: v1.0 WMS                          =
// Displays QA Efficiency Summary list.        =
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

// First include the class definition
include_once('classes/reportClass.php');
include_once('classes/displayClass.php');

$newdisplay = new display;
$newQA = new report;

$userrole = $_SESSION['userrole'];

$cond0 = "crn like '%'";
$cond1 = "inspected_by like '%'";


$cond = $cond0 . ' and ' . $cond1;


$oper1='like';
$oper2='like';
$sort1='crn';
//$sort2='rm_spec';
$sess=session_id();

if ( isset ( $_REQUEST['final_crn'] ) )
{
     $finalcrn_match = $_REQUEST['final_crn'];
     if ( isset ( $_REQUEST['crn_oper'] ) ) {
          $oper1 = $_REQUEST['crn_oper'];
     }
     else {
         $oper1 = 'like';
     }
     if ($oper1 == 'like') {
         $finalcrn = "'" . $_REQUEST['final_crn'] . "%" . "'";
     }
     else {
         $finalcrn = "'" . $_REQUEST['final_crn'] . "'";
     }

     $cond0 = "crn " . $oper1 . " " . $finalcrn;

}
else {
     $finalcrn_match = '';
}

if ( isset ( $_REQUEST['final_insp'] ) )
{
     $finalinsp_match = $_REQUEST['final_insp'];
     if ( isset ( $_REQUEST['insp_oper'] ) ) {
          $oper2 = $_REQUEST['insp_oper'];
     }
     else {
         $oper2 = 'like';
     }
     if ($oper2 == 'like') {
         $finalinsp = "'" . $_REQUEST['final_insp'] . "%" . "'";
     }
     else {
         $finalinsp = "'" . $_REQUEST['final_insp'] . "'";
     }

     $cond1 = "inspected_by " . $oper2 . " " . $finalinsp;

}
else {
     $finalinsp_match = '';
}

if ( isset ( $_REQUEST['sortfld1'] ) ) {
    $sort1 = $_REQUEST['sortfld1'];
}

/*if ( isset ( $_REQUEST['sortfld2'] ) ) {
    $sort2 = $_REQUEST['sortfld2'];
}*/

$cond = $cond0 . ' and ' . $cond1;
//echo $cond;


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



?>
<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/qa4efficiency.js"></script>
<html>
<head>
<title>QA Efficiency Status</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">




<form action='qa4efficiency_status.php' method='post' enctype='multipart/form-data'>
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
		</tr>
  <tr>
<td>


<table width=100% border=0 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF" >
<tr>
<td bgcolor="#F5F6F5" colspan="9"><span class="heading"><b><center>Search Criteria</center></b></td>
<td bgcolor="#FFFFFF" rowspan=2 align="center"><span class="tabletext"><input type= "image" name="Get" src="images/bu-get.gif" value="Get" onclick="javascript: return searchsort_fields()"></td>
<input type="hidden" name="crn_oper">
</tr>
<tr>
<td bgcolor="#FFFFFF"><span class="tabletext"><b>PRN</b>

</td>
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
<?PHP
    }
?>
</select></td>

<td bgcolor="#FFFFFF"><input type="text" name="final_crn" size=15 value="<?php echo $finalcrn_match ?>" onkeypress="javascript: return checkenter(event)">
</td>
<td bgcolor="#FFFFFF"><span class="tabletext"><b>Inspector</b>

</td>
<td bgcolor="#FFFFFF"><span class="tabletext"><select name="insp_oper" size="1" width="50">
<?php
  if ( isset ( $_REQUEST['insp_oper'] ) ){
     $check2 = $_REQUEST['insp_oper'];

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
<?PHP
    }
?>
</select></td>

<td colspan=4 bgcolor="#FFFFFF"><input type="text" name="final_insp" size=15 value="<?php echo $finalinsp_match ?>" onkeypress="javascript: return checkenter(event)">
</td>

<!--<td bgcolor="#FFFFFF"><span class="labeltext"><b>Sort by</b></td>
<td colspan=2 bgcolor="#FFFFFF"><span class="tabletext"><select name="sort1" size="1" width="100">
<?php if($sort1 == 'crn')
{
?>
<option selected>crn
<?php   } else{
?>
<option selected>crn
<?php
}
?>
</select>
<input type="hidden" name="sortfld1">
</td> -->

</tr>

</table>
	</td></tr>
	<tr><td>
<table width=100% border=0>

  <tr>
  <td><span class="pageheading"><b>List Of QA Efficiency</b></td>
  <td colspan=160>&nbsp;</td>

  </tr>

</table>

<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
        <tr  bgcolor="#FFCC00">
            <td  bgcolor="#EEEFEE"><span class="tabletext"><b>PRN</b></td>
            <td  bgcolor="#EEEFEE"><span class="tabletext"><b>WO#</b></td>
            <td  bgcolor="#EEEFEE"><span class="tabletext"><b>QA Date</b></td>
            <td  bgcolor="#EEEFEE"><span class="tabletext"><b>Inspected By</b></td>
            <td  bgcolor="#EEEFEE"><span class="tabletext"><b>Quantity Dispatched</b></td>
	        <td  bgcolor="#EEEFEE"><span class="tabletext"><b>Quantity Accepted</b></td>
	        <td  bgcolor="#EEEFEE"><span class="tabletext"><b>Accepted Rating</b></td>
        </tr>

<?php

         $result = $newQA->getqasummary4status($cond,$sort1,$offset,$rowsPerPage);
         $total_dispatched = 0;
         $total_accepted = 0;
         while($myrow=mysql_fetch_row($result))
         {
         if($myrow[3] != '' && $myrow[3] != '0000-00-00')
          {
            $datearr = split('-', $myrow[3]);
            $d=$datearr[2];
            $m=$datearr[1];
            $y=$datearr[0];
            $x=mktime(0,0,0,$m,$d,$y);
            $date=date("M j, Y",$x);
          }
            else
          {
            $date = '';
          }
          $qty_disp = $myrow[4];
          $qty_accp = $myrow[6];
          $accp_rating = $qty_disp != 0 ? round((($qty_accp/$qty_disp)*100)) : "0";
   	       printf('<tr bgcolor="#FFFFFF">
                          <td><span class="tabletext">%s</td>
                          <td><span class="tabletext">%s</td>
                          <td><span class="tabletext">%s</td>
                          <td><span class="tabletext">%s</td>
                          <td><span class="tabletext">%s</td>
                          <td><span class="tabletext">%s</td>
		                  <td><span class="tabletext">%s</td>
                          ',
                         $myrow[1],
                         $myrow[7],
                         $date,
                         $myrow[5],
			             $myrow[4],
			             $myrow[6],
                         $accp_rating.'%');
              printf('</td></tr>');
          $total_dispatched += $qty_disp;
          $total_accepted += $qty_accp;

        }
      $overall_rating = $total_dispatched != 0 ? round((($total_accepted/$total_dispatched)*100)) : "0";

?> <tr></tr>
   <tr>
    <td colspan=4 align="right"  bgcolor="#FFFFFF"><span class="tabletext"><b>Total</b></td>
    <td bgcolor="#CCEEFF"><span class="tabletext"><span class="tabletext"><?php echo $total_dispatched ?></td>
    <td bgcolor="#CCEEFF"><span class="tabletext"><span class="tabletext"><?php echo $total_accepted ?></td>
    <td bgcolor="#CCEEFF"><span class="tabletext"><span class="tabletext"><?php echo $overall_rating.'%' ?></td>
  </tr>
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

//Additions on Dec 29 04 by Jerry George to implement pagination

$numrows = $newQA->getqacount4status($cond,$offset,$rowsPerPage);
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
    $prev = " <a href=\"qa4efficiency.php?page=$page&totpages=$totpages&final_crn=$finalcrn_match&final_insp=$finalinsp_match\">[Prev]</a> ";

    $first = " <a href=\"qa4efficiency.php?page=1&totpages=$totpages&final_crn=$finalcrn_match&final_insp=$finalinsp_match\">[First Page]</a> ";
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
    $next = " <a href=\"qa4efficiency.php?page=$page&totpages=$totpages&final_crn=$finalcrn_match&final_insp=$finalinsp_match\">[Next]</a> ";

    $last = " <a href=\"qa4efficiency.php?page=$totpages&totpages=$totpages&final_crn=$finalcrn_match&final_insp=$finalinsp_match\">[Last Page]</a> ";
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
							</tr>


						</table>
      </FORM>
</body>
</html >

