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
$newcrn = new report;

$userrole = $_SESSION['userrole'];

$cond0 = "m.CIM_refnum like '%'";
$cond1 =  "((to_days(wo.book_date)-to_days('1582-01-01') > 0 ||
                   wo.book_date = '0000-00-00' ||
                    wo.book_date = 'NULL' )) and
           ((to_days(wo.book_date)-to_days('2050-12-31') < 0 ||
                    wo.book_date = '0000-00-00' ||
                    wo.book_date = 'NULL'))";



$cond = $cond0 . ' and ' . $cond1;


$oper1='like';
$oper2='like';
//$sort1='crn';
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

     $cond0 = "m.CIM_refnum " . $oper1 . " " . $finalcrn;

}
else {
     $finalcrn_match = '';
}

if ( isset ( $_REQUEST['bdate1'] ) || isset ( $_REQUEST['bdate2'] ) )
{
     $bdate1_match = $_REQUEST['bdate1'];
     $bdate2_match = $_REQUEST['bdate2'];
     if ( isset ( $_REQUEST['bdate1']) &&  $_REQUEST['bdate1'] != '' )
     {
          $date1 = $_REQUEST['bdate1'];
          $cond11 = "(to_days(wo.book_date) " . ">= to_days('" . $date1 . "'))";
     }
     else
     {
          $cond11 = "((to_days(wo.book_date)-to_days('1582-01-01') >= 0 || wo.book_date is NULL || wo.book_date = '0000-00-00'))";
     }

     if ( isset ( $_REQUEST['bdate2'] )  &&  $_REQUEST['bdate2'] != '')
     {
          $date2 = $_REQUEST['bdate2'];
          $cond12 = "(to_days(wo.book_date) " . "<= to_days('" . $date2 . "'))";
     }
     else
     {
          $cond12 = "((to_days(wo.book_date)-to_days('2050-12-31') <= 0 || wo.book_date is NULL || wo.book_date = '0000-00-00'))";
     }
     $cond1 = $cond11 . ' and ' . $cond12;

}
else
{
     $bdate1_match = '';
     $bdate2_match = '';
}



/*if ( isset ( $_REQUEST['sortfld1'] ) ) {
    $sort1 = $_REQUEST['sortfld1'];
}*/

/*if ( isset ( $_REQUEST['sortfld2'] ) ) {
    $sort2 = $_REQUEST['sortfld2'];
}*/

$cond = $cond0 . ' and ' . $cond1;
//echo $cond;


// echo $cond;
// how many rows to show per page
$rowsPerPage =50;

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
<script language="javascript" src="scripts/crneff.js"></script>
<html>
<head>
<title>CRN Efficiency Status</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">




<form action='crn_efficiency.php' method='post' enctype='multipart/form-data'>
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


<table width=70% border=0 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF" >
<tr>
<td bgcolor="#F5F6F5" colspan=4><span class="heading"><b><center>Search Criteria</center></b></td>
<td bgcolor="#FFFFFF" rowspan=3 align="center"><span class="tabletext"><input type= "image" name="Get" src="images/bu-get.gif" value="Get" onclick="javascript: return searchsort_fields()"></td>
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

<td bgcolor="#FFFFFF"><span class="labeltext"><b>Date:  From &nbsp&nbsp</b>
        <input type="text" name="bdate1" size=10 value="<?php echo $bdate1_match ?>"
         onkeypress="javascript: return checkenter(event)">
        <img src="images/bu-getdateicon.gif" alt="Get Date" onclick='GetDate("bdate1")'>
         <span class="labeltext"><b>&nbsp;&nbsp;To</b>
        <input type="text" name="bdate2" size=10 value="<?php echo $bdate2_match ?>"
         onkeypress="javascript: return checkenter(event)">
        <img src="images/bu-getdateicon.gif" alt="Get Date" onclick='GetDate("bdate2")'>
</td>
</tr>
</table>
	</td></tr>
	<tr><td>
<table width=100% border=0>

  <tr>
  <td><span class="pageheading"><b>List Of PRN Efficiency</b></td>
  <td colspan=160>&nbsp;</td>

  </tr>
  <tr>
  <td><span class="pageheading"><i>Please click on the PRN to view the efficiency chart</i></td>
  <td colspan=160>&nbsp;</td>

  </tr>

</table>
<table width=70% border=1 cellpadding=3 cellspacing=1>
<tr>
<td width=30% valign="top">
<table style="table-layout: fixed" width=470px border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >

        <tr  bgcolor="#FFCC00">
            <td width=30px bgcolor="#EEEFEE"><span class="tabletext"><b>PRN</b></td>
            <td width=30px bgcolor="#EEEFEE"><span class="tabletext"><b>WO <br>Qty</b></td>
            <td width=30px bgcolor="#EEEFEE"><span class="tabletext"><b>Qty<br>Acc</b></td>
	        <td width=30px bgcolor="#EEEFEE"><span class="tabletext"><b>Qty<br>Rej</b></td>
	        <td width=30px bgcolor="#EEEFEE"><span class="tabletext"><b>Qty<br>Ret</b></td>
	        <td width=30px bgcolor="#EEEFEE"><span class="tabletext"><b>Qty<br>Rew</b></td>
	        <td width=30px bgcolor="#EEEFEE"><span class="tabletext"><b>%Eff</b></td>
        </tr>
</table>
<div style="width:470px; height:150; overflow:auto;border:" id="tabledata">
<table style="table-layout: fixed" width=470px border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">

<?php
         $total_woqty = 0;
         $total_acc_qty = 0;
         $total_rej_qty = 0;
         $total_ret_qty = 0;
         $total_eff = 0;
         $total_rew_qty = 0;
         //echo 'beforecond='.$cond1;
        //$date_cond = $cond1;
         //echo 'af='.$date_cond;
         $result = $newcrn->getcrn4effncy($cond);
         $prev_crn = '#####';
         while($myrow=mysql_fetch_row($result))
         {
           $result4woqty = $newcrn->getwoqty4crneff($myrow[3],$cond1);
           $myrow4woqty = mysql_fetch_row($result4woqty);
           $woqty = $myrow4woqty[0];
           $qty_accepted = $myrow[4];
           $qty_ret = $myrow[6];
           $qty_rew = $myrow[8];

           $crn_efficiency = $woqty != 0 ? round((($qty_accepted/($woqty-$qty_ret))*100)) : "0";
   	       printf('<tr bgcolor="#FFFFFF">
                          <td width=30px><span class="tabletext"><a href="javascript:show_graph(\'%s\',%s,%s,%s,%s,%s)">%s</td>
                          <td width=30px><span class="tabletext">%s</td>
                          <td width=30px><span class="tabletext">%s</td>
                          <td width=30px><span class="tabletext">%s</td>
		                  <td width=30px><span class="tabletext">%s</td>
		                  <td width=30px><span class="tabletext">%s</td>
		                  <td width=30px><span class="tabletext">%s</td>',
                            $myrow[3],
                            $myrow[4],
                            $myrow[6],
                            $myrow[5],
                            $woqty,
                            $myrow[8],
                            $myrow[3],
                            $woqty,
			                $myrow[4],
			                $myrow[5],
		                    $myrow[6],
		                    $myrow[8],
                            $crn_efficiency.'%');

           printf('</tr>');
           $total_woqty +=  $woqty;
           $total_acc_qty += $myrow[4];
           $total_rej_qty += $myrow[5];
           $total_ret_qty += $myrow[6];
           $total_rew_qty += $myrow[8];
  ?>

 <?php
        }
    $total_eff = $total_woqty != 0 ? round((($total_acc_qty/($total_woqty-$total_ret_qty))*100)):"0";
 ?>
<tr bgcolor="#E0FFFF">
<?php
$total_crnmatch = $finalcrn_match.'%';
printf('<td width=30px><span class="tabletext"><a href="javascript:show_graph(\'%s\',%s,%s,%s,%s,%s)">Total</td>',$total_crnmatch,$total_acc_qty,$total_ret_qty,$total_rej_qty,$total_woqty,$total_rew_qty);
?>
<?php
printf('<td bgcolor="#E0FFFF" colspan=1><span class="tabletext">%d</td>',$total_woqty);
?>
<?php
printf('<td bgcolor="#E0FFFF" colspan=1><span class="tabletext">%d</td>',$total_acc_qty);
?>
<?php
printf('<td bgcolor="#E0FFFF" colspan=1><span class="tabletext">%d</td>',$total_rej_qty);
?>
<?php
printf('<td bgcolor="#E0FFFF" colspan=1><span class="tabletext">%d</td>',$total_ret_qty);
printf('<td bgcolor="#E0FFFF" colspan=1><span class="tabletext">%d</td>',$total_rew_qty);
?>
<?php
printf('<td bgcolor="#E0FFFF" colspan=1><span class="tabletext">%s</td>',$total_eff.'%');
?>
</table>
</div>
</td>
<td>
<div id="layer1">
<table id="myTable" width=30%  border=0 cellpadding=3 cellspacing=1 bgcolor="#FFFFFF">
</table>
</div>
</td>
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

$numrows = 50;
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
    $prev = " <a href=\"crn_efficiency.php?page=$page&totpages=$totpages\">[Prev]</a> ";

    $first = " <a href=\"crn_efficiency.php?page=1&totpages=$totpages\">[First Page]</a> ";
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
    $next = " <a href=\"crn_efficiency.php?page=$page&totpages=$totpages\">[Next]</a> ";

    $last = " <a href=\"crn_efficiency.php?page=$totpages&totpages=$totpages\">[Last Page]</a> ";
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

