<?php
//==============================================
// Author: FSI                                 =
// Date-written = June 02, 2009                =
// Filename: ontime_report.php                 =
// Copyright of Badari Mandyam, FluentSoft     =
// Revision: v1.0 OMS                          =
// Displays ontime report.                     =
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
include_once('classes/userClass.php');
include_once('classes/reportClass.php');
include_once('classes/displayClass.php');
include_once('classes/helperClass.php');

$newlogin = new userlogin;
$newlogin->dbconnect();

$ncreport = new report;
$newdisplay = new display;
$help = new helper;

$rowsPerPage = 3000;

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


$cond0 = "d.crn like '%'";
//$cond1 = "d.relnotenum like '%'";
$cond2 = "(to_days(d.schdate)-to_days('1582-01-01') > 0 ||
                    d.schdate = '0000-00-00' ||
                    d.schdate is NULL ) and
           (to_days(d.schdate)-to_days('2050-12-31') < 0 ||
                    d.schdate = '0000-00-00' ||
                    d.schdate is NULL)";

$cond = $cond0 . ' and ' . $cond2;

$final_insprecnum='';
$oper1='like';
$oper2='like';
$oper3='like';
$oper4='like';
$oper5='like';
$oper6='like';
$sort1='refnum';

if ( isset ( $_REQUEST['final_refno'] ) )
{
     $finalref_match = $_REQUEST['final_refno'];
     if ( isset ( $_REQUEST['refno_oper'] ) ) {
          $oper1 = $_REQUEST['refno_oper'];
     }
     else {
         $oper1 = 'like';
     }
     if ($oper1 == 'like') {
         $final_refno = "'" . $_REQUEST['final_refno'] . "%" . "'";
     }
     else {
         $final_refno = "'" . $_REQUEST['final_refno'] . "'";
     }

     $cond0 = "d.crn " . $oper1 . " " . $final_refno;

}
else
{
     $finalref_match = '';
}

/*if ( isset ( $_REQUEST['final_cofc'] ) )
{
     $cofc_match = $_REQUEST['final_cofc'];
     if ( isset ( $_REQUEST['cofc_oper'] ) ) {
          $oper2 = $_REQUEST['cofc_oper'];
     }
     else {
         $oper2 = 'like';
     }
     if ($oper2 == 'like') {
         $final_cofc = "'" . $_REQUEST['final_cofc'] . "%" . "'";
     }
     else {
         $final_cofc = "'" . $_REQUEST['final_cofc'] . "'";
     }

     $cond1 = "d.relnotenum " . $oper2 . " " . $final_cofc;

}
else {
     $cofc_match = '';
}*/



if ( isset ( $_REQUEST['sdate1'] ) || isset ( $_REQUEST['sdate2'] ) )
{
     $date1_match = $_REQUEST['sdate1'];
     $date2_match = $_REQUEST['sdate2'];
     if ( isset ( $_REQUEST['sdate1']) &&  $_REQUEST['sdate1'] != '' )
     {
          $date1 = $_REQUEST['sdate1'];
          $cond21 = "to_days(d.schdate) " . "> to_days('" . $date1 . "')";
     }
     else
     {
          $cond21 = "(to_days(d.schdate)-to_days('1582-01-01') > 0 || d.schdate is NULL || d.schdate = '0000-00-00')";
     }

     if ( isset ( $_REQUEST['sdate2'] )  &&  $_REQUEST['sdate2'] != '')
     {
          $date2 = $_REQUEST['sdate2'];
          $cond22 = "to_days(d.schdate) " . "< to_days('" . $date2 . "')";
     }
     else
     {
          $cond22 = "(to_days(d.schdate)-to_days('2050-12-31') < 0 || d.schdate is NULL || d.schdate = '0000-00-00')";
     }
     $cond2 = $cond21 . ' and ' . $cond22;

}
else
{
     $date1_match = '';
     $date2_match = '';
}

/*if ( isset ( $_REQUEST['sortfld1'] ) ) {
    $sort1 = $_REQUEST['sortfld1'];

}*/


$cond = $cond0 .  ' and ' . $cond2;
$_SESSION['cond'] = $cond;
//////session_register('cond');

$userrole = $_SESSION['userrole'];
$dept = $_SESSION['department'];

?>
<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/report.js"></script>

<html>
<head>
<title>Ontime Report</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">
<form action='ontime_report.php' method='post' enctype='multipart/form-data'>
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
		</tr>
  <tr>
<td>


<table width=70% border=0 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF">
  <tr>
	<td bgcolor="#F5F6F5" colspan="13"><span class="heading"><b><center>Search & SortCriteria</center></b></td>
    <td bgcolor="#FFFFFF" rowspan=3 align="center">
	<input type= "image" name="submit" src="images/bu-get.gif" value="Get" onclick="javascript: return searchsort_fields()">


<input type="hidden" name="refno_oper">
<input type="hidden" name="wono_oper">
<input type="hidden" name="cust_oper">
<input type="hidden" name="partno_oper">
<input type="hidden" name="pono_oper">
	</td>
  </tr>
<tr>
<td bgcolor="#FFFFFF"><span class="labeltext"><b>PRN No</b></td>

<td bgcolor="#FFFFFF"><span class="tabletext"><select name="refno_oper" size="1" width="50">
<?php
   if ( isset ( $_REQUEST['refno_oper'] ) ){
          $check2 = $_REQUEST['refno_oper'];

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
<td colspan=11 bgcolor="#FFFFFF"><input type="text" name="final_refno" size=15 value="<?php echo $finalref_match ?>" onkeypress="javascript: return checkenter(event)">
</td>
<tr>
<td colspan=13  bgcolor="#FFFFFF"><span class="labeltext"><b>Schedule Date:  From &nbsp&nbsp</b>
        <input type="text" name="sdate1" size=10 value="<?php echo $date1_match ?>"
         onkeypress="javascript: return checkenter(event)">
        <img src="images/bu-getdateicon.gif" alt="Get Date" onclick='GetDate("sdate1")'>
         <span class="labeltext"><b>&nbsp;&nbsp;To</b>
        <input type="text" name="sdate2" size=10 value="<?php echo $date2_match ?>"
         onkeypress="javascript: return checkenter(event)">
        <img src="images/bu-getdateicon.gif" alt="Get Date" onclick='GetDate("sdate2")'>
</td>
</tr>

	</table>
	</td></tr>
	<tr><td>
<table width=100% border=0>
  <tr>
  <td><span class="pageheading"><b>OTIF Report</b></td>
  </td>
  </tr>
  <tr>
  <td><span class="pageheading"><i>Please click on OTIF link to view Ontime and Infull graph</i></td>
  </td>
  <tr>
  <td><span class="pageheading"><i>Please click on Cofc link to view Cofc drilldown graph</i></td>
  </td>
  </tr>
</table>

<table width=50% border=0>
<tr>
<td>
<table cellpadding=3 cellspacing=1 style="table-layout:fixed" width=570px bgcolor="#DFDEDF" id="ontimetable" rules=all>
<tr>
<td align="left" bgcolor="#FFFFFF">
<tr bgcolor="#FFFFFF">
        <td bgcolor="#FBF5EF"><span class="tabletext"><b>PRN</b></td>
        <td bgcolor="#FBF5EF"><span class="tabletext"><b>Sch Date</b></td>
        <td bgcolor="#FBF5EF"><span class="tabletext"><b>Disp Date</b></td>
        <td bgcolor="#FBF5EF"><span class="tabletext"><b>OT</b></td>
        <td bgcolor="#FBF5EF"><span class="tabletext"><b>Sch Qty</b></td>
        <td bgcolor="#FBF5EF"><span class="tabletext"><b>Disp Qty</b></td>
        <td bgcolor="#FBF5EF"><span class="tabletext"><b>IF</b></td>
</tr>
</table>
<div style="width:588px; height:300; overflow:auto;border:" id="dataList">
<table cellpadding=3 cellspacing=1 style="table-layout:fixed" width=570px bgcolor="#DFDEDF" id="ontimetable" rules=all>
<?php
     $result = $ncreport->getcrn_ontime($cond);
     $prev_crn = '###';
     $prev_date = '###';
     $prev_month_year = '###';
     $prev_lossrgain = 0;
     $count = 0;
     $lossrgain4crn = 0;
     $total_lossrgain = 0;
     $totalpercrn = 0;
     $infull = 0;

            while ($myrow = mysql_fetch_row($result))
            {
              // echo $prev_crn .'-----------'. $myrow[0].'<br/>';
               if($myrow[1] != '' && $myrow[1] != '0000-00-00')
               {
                $datearr = split('-', $myrow[1]);
                $d=$datearr[2];
                $m=$datearr[1];
                $y=$datearr[0];
                $x=mktime(0,0,0,$m,$d,$y);
                $disp_date=date("M j, Y",$x);
               }
               else
               {
                $disp_date = '';
               }
               $my = getdate($x);
               $month = $my[month];
               $year = $my[year];
               $month_year = $month.$year;
               //echo $month_year;
               if($myrow[2] != '' && $myrow[2] != '0000-00-00')
               {
                $datearr = split('-', $myrow[2]);
                $d=$datearr[2];
                $m=$datearr[1];
                $y=$datearr[0];
                $x=mktime(0,0,0,$m,$d,$y);
                $sch_date=date("M j, Y",$x);
               }
               else
               {
                $sch_date = '';
               }
             if($myrow[4]-$myrow[3] == 0)
             {
               $diff_infull = 'OK';
             }
             else
             {
               $diff_infull = ($myrow[4]-$myrow[3]);
             }
           if($prev_crn != $myrow[0] && $prev_date != $myrow[1] && $count == 0)
           {
               $lossrgain = $help->dateDiff("-", $myrow[2], $myrow[1]);
               
               printf('<tr bgcolor="#FFFFFF"><td><span class="tabletext"><a href="javascript:show_graph_ontime(\'%s\')">%s</td>
                      <td><span class="tabletext">%s</td>
                      <td><span class="tabletext">%s</td>
                      <td><span class="tabletext">%d</td>
                      <td><span class="tabletext">%d</td>
                      <td><span class="tabletext">%d</td>
                      <td><span class="tabletext">%s</td>',
                      $myrow[0],$myrow[0],$sch_date,$disp_date,$lossrgain,$myrow[3],$myrow[4],$diff_infull);
               printf('</tr>');
               $infull += $myrow[4]-$myrow[3];
               $lossrgain4crn += $lossrgain;
           }
           else if($prev_crn != $myrow[0] && $prev_date != $myrow[1] && $count > 0)
           {
               $lossrgain = $help->dateDiff("-", $myrow[2], $myrow[1]);
               printf('<tr bgcolor="#FFFFFF"><td><span class="tabletext"><a href="javascript:show_graph_ontime(\'%s\')">%s</td>
                      <td><span class="tabletext">%s</td>
                      <td><span class="tabletext">%s</td>
                      <td><span class="tabletext">%d</td>
                      <td><span class="tabletext">%d</td>
                      <td><span class="tabletext">%d</td>
                      <td><span class="tabletext">%s</td>',
                      $myrow[0],$myrow[0],$sch_date,$disp_date,$lossrgain,$myrow[3],$myrow[4],$diff_infull);
               printf('</tr>');
               $infull += $myrow[4]-$myrow[3];
               $lossrgain4crn += $lossrgain;
           }
           else if($prev_crn != $myrow[0] && $prev_date == $myrow[1] && $count > 0)
           {
               $lossrgain = $help->dateDiff("-", $myrow[2], $myrow[1]);
               printf('<tr bgcolor="#FFFFFF"><td><span class="tabletext"><a href="javascript:show_graph_ontime(\'%s\')">%s</td>
                      <td><span class="tabletext">%s</td>
                      <td><span class="tabletext">%s</td>
                      <td><span class="tabletext">%d</td>
                      <td><span class="tabletext">%d</td>
                      <td><span class="tabletext">%d</td>
                      <td><span class="tabletext">%s</td>',
                      $myrow[0],$myrow[0],$sch_date,$disp_date,$lossrgain,$myrow[3],$myrow[4],$diff_infull);
               printf('</tr>');
               $infull += $myrow[4]-$myrow[3];
               $lossrgain4crn += $lossrgain;
           }
           else if($prev_crn == $myrow[0] && $prev_date != $myrow[1] && $count > 0)
           {
              if($prev_month_year == $month_year)
              {
               $lossrgain = $help->dateDiff("-", $myrow[2], $myrow[1]);
               printf('<tr bgcolor="#FFFFFF"><td><span class="tabletext">&nbsp</td>
                      <td><span class="tabletext">%s</td>
                      <td><span class="tabletext">%s</td>
                      <td><span class="tabletext">%d</td>
                      <td><span class="tabletext">%d</td>
                      <td><span class="tabletext">%d</td>
                      <td><span class="tabletext">%s</td>',
                      $sch_date,$disp_date,$lossrgain,$myrow[3],$myrow[4],$diff_infull);
               printf('</tr>');
               $infull += $myrow[4]-$myrow[3];
               $lossrgain4crn += $lossrgain;
              }
              else if($prev_month_year != $month_year)
              {
               $lossrgain = $help->dateDiff("-", $myrow[2], $myrow[1]);
                printf('<tr bgcolor="#FFFFFF"><td><span class="tabletext">&nbsp</td>
                      <td><span class="tabletext">%s</td>
                      <td><span class="tabletext">%s</td>
                      <td><span class="tabletext">%d</td>
                      <td><span class="tabletext">%d</td>
                      <td><span class="tabletext">%d</td>
                      <td><span class="tabletext">%s</td>',
                      $sch_date,$disp_date,$lossrgain,$myrow[3],$myrow[4],$diff_infull);
               printf('</tr>');
                $infull += $myrow[4]-$myrow[3];
              }
           }
           else if($prev_crn == $myrow[0] && $prev_date == $myrow[1] && $count > 0)
           {
              if($prev_month_year == $month_year)
              {
               $lossrgain = $help->dateDiff("-", $myrow[2], $myrow[1]);
               printf('<tr bgcolor="#FFFFFF"><td><span class="tabletext">&nbsp</td>
                      <td><span class="tabletext">%s</td>
                      <td><span class="tabletext">%s</td>
                      <td><span class="tabletext">%d</td>
                      <td><span class="tabletext">%d</td>
                      <td><span class="tabletext">%d</td>
                      <td><span class="tabletext">%s</td>',
                      $sch_date,$disp_date,$lossrgain,$myrow[3],$myrow[4],$diff_infull);
               printf('</tr>');
               $infull += $myrow[4]-$myrow[3];
               $lossrgain4crn += $lossrgain;
              }
              else if($prev_month_year != $month_year)
              {
               $lossrgain = $help->dateDiff("-", $myrow[2], $myrow[1]);
               printf('<tr bgcolor="#FFFFFF"><td><span class="tabletext">&nbsp</td>
                      <td><span class="tabletext">%s</td>
                      <td><span class="tabletext">%s</td>
                      <td><span class="tabletext">%d</td>
                      <td><span class="tabletext">%d</td>
                      <td><span class="tabletext">%d</td>
                      <td><span class="tabletext">%s</td>',
                      $sch_date,$disp_date,$lossrgain,$myrow[3],$myrow[4],$diff_infull);
               printf('</tr>');
               $infull += $myrow[4]-$myrow[3];
              }
           }
           $count++;
           $prev_crn = $myrow[0];
           $prev_date = $myrow[1];
           $prev_month_year = $month_year;
           $total_lossrgain += $lossrgain;
           $prev_lossrgain += $lossrgain;
           $totalpercrn += $lossrgain;
        }
        printf('<tr bgcolor="#CCEEFF"><td colspan=3 align="right"><span class="tabletext"><b>Total</b></td>
                      <td><span class="tabletext">%d</td><td>&nbsp</td><td>&nbsp</td><td><span class="tabletext">%d</td></tr>',$total_lossrgain,$infull);
        unset($lossrgain4crn);
        printf('<tr bgcolor="#CCEEFF"><td>&nbsp</td>');
        printf('<td colspan=3><span class="tabletext"><b><a href="javascript:show_otif()">OtIf</a></b></td>');
        printf('<td colspan=3><span class="tabletext"><b><a href="javascript:show_cofc()">Cofc</a></b></td></tr>');
?>
</table>
</div>
  </td>
 </td>
 <td>&nbsp</td>
<td align="left" width=70% bgcolor="#FFFFFF">
<div id="crrontime">
<table id="myTable" border=1 cellpadding=3 cellspacing=1 bgcolor="#FFFFFF">
</table>
</div>
</table>
</td>
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
   $numrows = $ncreport->getcrr_Count($cond,$offset,$rowsPerPage);
   //echo $numrows;
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
/*if ($pageNum > 1)
{
    $page = $pageNum - 1;
    $prev = " <a href=\"crr_report.php?page=$page&totpages=$totpages&final_cofc=$cofc_match&final_refno=$finalref_match&sdate1=$date1_match&sdate2=$date2_match\">[Prev]</a> ";

    $first = " <a href=\"crr_report.php?page=1&totpages=$totpages&final_cofc=$cofc_match&final_refno=$finalref_match&sdate1=$date1_match&sdate2=$date2_match\">[First Page]</a> ";
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
    $next = " <a href=\"crr_report.php?page=$page&totpages=$totpages&final_cofc=$cofc_match&final_refno=$finalref_match&sdate1=$date1_match&sdate2=$date2_match\">[Next]</a> ";

    $last = " <a href=\"crr_report.php?page=$totpages&totpages=$totpages&final_cofc=$cofc_match&final_refno=$finalref_match&sdate1=$date1_match&sdate2=$date2_match\">[Last Page]</a> ";
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
*/
// End additions on Dec 29,04

?>
</td>
</tr>
</table>
      </FORM>
</body>
</html>

