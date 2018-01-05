<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = June 02, 2009                =
// Filename: crr_report.php                       =
// Copyright of Badari Mandyam, FluentSoft     =
// Revision: v1.0 OMS                          =
// Displays CRR report.                 =
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

$newlogin = new userlogin;
$newlogin->dbconnect();

$ncreport = new report;
$newdisplay = new display;

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
$cond1 = "d.relnotenum like '%'";
$cond2 = "(to_days(d.disp_date)-to_days('1582-01-01') > 0 ||
                    d.disp_date = '0000-00-00' ||
                    d.disp_date is NULL ) and
           (to_days(d.disp_date)-to_days('2050-12-31') < 0 ||
                    d.disp_date = '0000-00-00' ||
                    d.disp_date is NULL)";

$cond = $cond0 . ' and ' . $cond1 . ' and ' . $cond2;

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
else {
     $finalref_match = '';
}

if ( isset ( $_REQUEST['final_cofc'] ) )
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
}



if ( isset ( $_REQUEST['sdate1'] ) || isset ( $_REQUEST['sdate2'] ) )
{
     $date1_match = $_REQUEST['sdate1'];
     $date2_match = $_REQUEST['sdate2'];
     if ( isset ( $_REQUEST['sdate1']) &&  $_REQUEST['sdate1'] != '' )
     {
          $date1 = $_REQUEST['sdate1'];
          $cond21 = "to_days(d.disp_date) " . "> to_days('" . $date1 . "')";
     }
     else
     {
          $cond21 = "(to_days(d.disp_date)-to_days('1582-01-01') > 0 || d.disp_date is NULL || d.disp_date = '0000-00-00')";
     }

     if ( isset ( $_REQUEST['sdate2'] )  &&  $_REQUEST['sdate2'] != '')
     {
          $date2 = $_REQUEST['sdate2'];
          $cond22 = "to_days(d.disp_date) " . "< to_days('" . $date2 . "')";
     }
     else
     {
          $cond22 = "(to_days(d.disp_date)-to_days('2050-12-31') < 0 || d.disp_date is NULL || d.disp_date = '0000-00-00')";
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


$cond = $cond0 . ' and ' . $cond1 . ' and ' . $cond2;
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
<title>CRR Report</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">
<form action='crr_report.php' method='post' enctype='multipart/form-data'>
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


<table width=750px border=0 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF">
  <tr>
	<td bgcolor="#F5F6F5" colspan="13"><span class="heading"><b><center>Search & SortCriteria</center></b></td>
    <td bgcolor="#FFFFFF" rowspan=5 align="center">
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

<td bgcolor="#FFFFFF"><input type="text" name="final_refno" size=15 value="<?php echo $finalref_match ?>" onkeypress="javascript: return checkenter(event)">
</td>

<td bgcolor="#FFFFFF"><span class="labeltext"><b>C of C No</b></td>

<td bgcolor="#FFFFFF"><span class="tabletext"><select name="cofc_oper" size="1" width="50">
<?php
   if ( isset ( $_REQUEST['cofc_oper'] ) ){
          $check2 = $_REQUEST['cofc_oper'];

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

<td bgcolor="#FFFFFF" colspan=8><input type="text" name="final_cofc" size=15 value="<?php echo $cofc_match ?>" onkeypress="javascript: return checkenter(event)">
</td>
<tr>
<td colspan=13  bgcolor="#FFFFFF"><span class="labeltext"><b>Dispatch Date:  From &nbsp&nbsp</b>
        <input type="text" name="sdate1" id="sdate1" size=10 value="<?php echo $date1_match ?>"
         onkeypress="javascript: return checkenter(event)">
        <img src="images/bu-getdateicon.gif" alt="Get Date" onclick='GetDate("sdate1")'>
         <span class="labeltext"><b>&nbsp;&nbsp;To</b>
        <input type="text" name="sdate2" id="sdate2" size=10 value="<?php echo $date2_match ?>"
         onkeypress="javascript: return checkenter(event)">
        <img src="images/bu-getdateicon.gif" alt="Get Date" onclick='GetDate("sdate2")'>
</td>
</tr>

	</table>
	</td></tr>
	<tr><td>
<table width=100% border=0>
  <tr>
  <td><span class="pageheading"><b>CRR Report</b></td>
  </td>
  </tr>
</table>

<table style="table-layout: fixed" width=650px border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
<tr>
<td>

        <tr bgcolor="#FFFFFF">
            <td bgcolor="#EEEFEE"><span class="tabletext"><b>PRN</b></td>
            <td bgcolor="#EEEFEE"><span class="tabletext"><b>CofC No.</b></td>
            <td bgcolor="#EEEFEE" ><span class="tabletext"><b>Disp Date</b></td>
            <td bgcolor="#EEEFEE"><span class="tabletext"><b>NC Wo</b></td>
            <td bgcolor="#EEEFEE"><span class="tabletext"><b>Acc Qty</b></td>
            <td bgcolor="#EEEFEE"><span class="tabletext"><b>Rej Qty</b></td>
            <td bgcolor="#EEEFEE"><span class="tabletext"><b>Cust NC#</b></td>
            <td bgcolor="#EEEFEE"><span class="tabletext"><b>Eff</b></td>
        </tr>
</table>
<div style="width:670px; height:300; overflow:auto;border:" id="dataList">
<table style="table-layout: fixed" width=630px border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
<?php

      $total_accqty = 0;
      $total_rejqty = 0;
/*
 modified
*/
      $result = $ncreport->getcrr_report($cond,$offset,$rowsPerPage);
           while ($myrow = mysql_fetch_row($result))
       {
           $dliwonum=$myrow[4];
           $cofcnum=$myrow[1];
           $result1= $ncreport->getnc4dispatch($cofcnum,$dliwonum);
           $num_rows=mysql_num_rows($result1);
           //echo "this---$num_rows";
           if($num_rows !=0)
           {
            while($myrow1 = mysql_fetch_row($result1))
            {
              $rej_qty=$myrow1[1];
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

             $total_accqty += $myrow[3];
             $total_rejqty += $myrow1[1];

             $eff = ($myrow[3]+$myrow1[1]) != 0?($myrow[3]/($myrow[3]+$myrow1[1]) * 100):0;

   	         printf('<tr bgcolor="#FFFFFF"><td><span class="tabletext">%s</td>
                          <td><span class="tabletext">%s</td>
                          <td ><span class="tabletext">%s</td>
                          <td><span class="tabletext">%s</td>
                          <td><span class="tabletext">%s</td>
                          <td><span class="tabletext">%s</td>
                          <td><span class="tabletext">%s</td>
                          <td><span class="tabletext">%.2f</td>
                          ',
                         $myrow[0],
                         $myrow[1],
                         $date1,
                         $myrow[4],
                         $myrow[3],
                         $rej_qty,
                         $myrow1[4],
                         $eff.'%');
           printf('</td></tr>');
          }
         }
         else
         {
            $rej_qty='';
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

             $total_accqty += $myrow[3];
             $total_rejqty += $rej_qty;


            $eff=100.0;

   	       printf('<tr bgcolor="#FFFFFF"><td><span class="tabletext">%s</td>
                          <td><span class="tabletext">%s</td>
                          <td><span class="tabletext">%s</td>
                          <td><span class="tabletext">%s</td>
                          <td><span class="tabletext">%s</td>
                          <td><span class="tabletext">%s</td>
                          <td><span class="tabletext">%s</td>
                          <td><span class="tabletext">%.2f</td>
                          ',
                         $myrow[0],
                         $myrow[1],
                         $date1,
                         $myrow[4],
                         $myrow[3],
                         $rej_qty,
                         $myrow1[4],
                         $eff.'%');
           printf('</td></tr>');
         }
      }
        $total_eff = ($total_accqty+$total_rejqty)!=0?(($total_accqty/($total_accqty+$total_rejqty) * 100)):0;
?>
   <tr>
      <td colspan=4 align="right" bgcolor="#CCEEFF"><span class="tabletext"><a href="javascript:display_crrchart()"><b><font color="#151B8D">Total</font></b></a></td>
     <td bgcolor="#CCEEFF"><span class="tabletext"><span class="tabletext"><?php echo $total_accqty ?></td>
     <td bgcolor="#CCEEFF"><span class="tabletext"><span class="tabletext"><?php echo $total_rejqty ?></td>
      <td bgcolor="#CCEEFF"><span class="tabletext"><span class="tabletext">&nbsp;</td>
     <td bgcolor="#CCEEFF"><span class="tabletext"><span class="tabletext"><?php printf('%.2f %s',$total_eff,' %')?></td>
  </tr>
 </table>
 </div>
</table>
  </td>
<td width=50% bgcolor="#FFFFFF">
<div id="crr">
<table id="myTable" width=50%  border=1 cellpadding=3 cellspacing=1 bgcolor="#FFFFFF">
</table>
</div>
</td>
</tr>
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
   $numrows = $ncreport->getcrr_Count($cond,$offset,$rowsPerPage);;
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
if ($pageNum > 1)
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
// End additions on Dec 29,04

?>
</td>
</tr>
</table>
      </FORM>
</body>
</html>

