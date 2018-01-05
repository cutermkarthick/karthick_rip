<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = June 19, 2008                =
// Filename: crn_status.php                    =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 WMS                          =
// Displays WO Status report                   =
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


include_once('classes/loginClass.php');

$newlogin = new userlogin;
$newlogin->dbconnect();

// For paging - Added on Dec 6,04

// how many rows to show per page
$rowsPerPage = 100000;

// by default we show first page
$pageNum = 1;

// if $_GET['page'] defined, use it as page number
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



//$cond0 = "w.actual_ship_date like %";
//$cond0 = "w.condition like " . "'%'";

$cond1 = "wo.crn_num like '%'";
//$cond2 = "wo.wonum like '%'";
$cond = $cond1;

$oper1='like';
$oper2='like';

$sess=session_id();
if ( isset ( $_REQUEST['flag'] ) )
{
     $flag = 1;
}
else
{
     $flag = 0;
}
if ( isset ( $_REQUEST['tcd'] ) )
{
     $total_cost_dollar = $_REQUEST['tcd'];
}
else
{
     $total_cost_dollar = 0;
}

if ( isset ( $_REQUEST['tcr'] ) )
{
     $total_cost_rupee = $_REQUEST['tcr'];
}
else
{
     $total_cost_rupee = 0;
}

if ( isset ( $_REQUEST['final_refno'] ) )
{
     $finalref_match = $_REQUEST['final_refno'];
     if ( isset ( $_REQUEST['crn_oper'] ) ) {
          $oper1 = $_REQUEST['crn_oper'];
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

     $cond1 = "wo.crn_num " . $oper1 . " " . $final_refno;

}
else {
     $finalref_match = '';
}



if ( isset ( $_REQUEST['sortfld1'] ) ) {
    $sort1 = $_REQUEST['sortfld1'];
}
if ( isset ( $_REQUEST['sortfld2'] ) ) {
    $sort2 = $_REQUEST['sortfld2'];
}

//$cond1 = "c.name like '%'";
$cond = $cond1;
//echo $cond;
// First include the class definition

include('classes/reportClass.php');
include('classes/displayClass.php');
$newreport = new report;
$newdisplay = new display;
?>

<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/report.js"></script>
<html>
<head>
<title>Finished Goods Report</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">

<?php
include('header.html');

?>
<form action='fg.php' method='post' enctype='multipart/form-data'>
<table width=100% cellspacing="0" cellpadding="6" border="0">
<tr>
<td>
<table width=100% border=0 cellspacing="0" cellpadding="0">
<tr>
<td colspan=2><span class="welcome"><b>Welcome <?php echo $userid?></b></td>
<td align="right">&nbsp;<a href="exit.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image16','','images/logout_mo.gif',1)"><img name="Image16" border="0" src="images/logout.gif"></a></td>
 </tr>
</table>
<table width=100% border=0 cellpadding=0 cellspacing=0>
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
  <table width=100% border=0 >
   <tr><td><span class="heading"><b>Finished Goods Report</b></td>

<tr><td>
<table width=100% border=0 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF" >
<tr>
<td bgcolor="#F5F6F5" colspan="7"><span class="heading"><b><center>Search Criteria</center></b></td>
<td bgcolor="#FFFFFF" rowspan=3 colspan=4 align="center"><span class="tabletext">
<input type="image" name="Submit" src="images/bu-get.gif" value="Get"
            onclick="javascript: return searchsort_stockgrn()">

</td>
</tr>
<tr>
<td bgcolor="#FFFFFF"><span class="labeltext"><b>PRN #</b></td>

<td bgcolor="#FFFFFF"><span class="tabletext"><select name="crn_oper" size="1" width="20">
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

<td colspan=5 bgcolor="#FFFFFF"><input type="text" name="final_refno" size=15 value="<?php echo $finalref_match ?>" onkeypress="javascript: return checkenter(event)">
</td>
</tr>


</table>

</td></tr>
    </tr>
   </table>
   <tr>

<tr><td>
<table style="table-layout: fixed" width=850px border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF"  >
<td bgcolor="#FFFFFF" align='right' colspan="4"><span class="pageheading"><b>
<a href="fg_export.php?crn=<?php echo $finalref_match ?>" >Export</a>
</td>
</tr>
        <tr>
            <td bgcolor="#EEEFEE" align="center"><span class="heading"><b>PRN</b></td>
            <td bgcolor="#EEEFEE" align="center"><span class="heading"><b>FG Stock</b></td>
             <td bgcolor="#EEEFEE" align="center"><span class="heading"><b>Unit RM Price</b></td>
            <td bgcolor="#EEEFEE" align="center"><span class="heading"><b>RM Cost</b></td>
            <!--<td bgcolor="#EEEFEE" align="center"><span class="heading"><b>Machine Name</b></td>
            <td bgcolor="#EEEFEE" align="center"><span class="heading"><b>Time Taken <br>To Complete</b></td> -->
        </tr>
</table>
<div style="width:870px; height:400; overflow:auto;border:" id="dataList">
<table style="table-layout: fixed" width=850px border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
<?php
        if($flag==0)
        {
         $total_cost_dollar=0;
         $total_cost_rupee=0;
         $total_r=0;
         $total_d=0;
         $total_cost_nocurr=0;
         $total_n=0;
          $result = $newreport->get_fggoods_totalcost($cond,$finalref_match);
        //$temp_result = $result;
         while ($myrow = mysql_fetch_row($result)) {
        //echo $from_row_count;
            $result4rmprice = $newreport->getunit_price4fg($myrow[0]);
            $myrow4rmprice = mysql_fetch_row($result4rmprice);
            if($myrow4rmprice[0] == '')
            {
              $price = 0;
              $currency ='$';
            }
            else
            {
             $price = $myrow4rmprice[0];
             $currency = $myrow4rmprice[1];
            }
           /* if($myrow[3] == '')
            {
              $disp_qty = 0;
            }
            else
            {
              $disp_qty = $myrow[3];
            }*/
            if($currency == '$')
            {
             $total_cost_dollar += (($myrow[2])*$price);
            }
            else if($currency == 'Rs')
            {
             $total_cost_rupee += (($myrow[2])*$price);
            }
            else if($currency == '')
            {
             $total_cost_nocurr += (($myrow[2])*$price);
            }
           }
          $total_d= number_format($total_cost_dollar,2,'.',',');
          $total_r=number_format($total_cost_rupee,2,'.',',');
          $total_n=number_format($total_cost_nocurr,2,'.',',');
        }
        
        
        echo "<tr><td colspan=4 align=\"right\"><span class=\"labeltext\">Total Cost(Rs) : Rs. $total_r  Total Cost($) : $ $total_d Total Cost() :  $total_n</td></tr>";

         
        $result = $newreport->get_fggoods($cond,$finalref_match);
        //$temp_result = $result;
        $total_page_cost_dollar=0;
        $total_page_cost_rupee=0;
        $total_page_cost_nocurr=0;
        while ($myrow = mysql_fetch_row($result)) {
        //echo $from_row_count;
            $result4rmprice = $newreport->getunit_price4fg($myrow[0]);
            $myrow4rmprice = mysql_fetch_row($result4rmprice);
            if($myrow4rmprice[0] == '')
            {
              $price = 0;
              $currency ='$';
            }
            else
            {
             $price = $myrow4rmprice[0];
             $currency = $myrow4rmprice[1];
            }

            /*if($myrow[3] == '')
            {
              $disp_qty = 0;
            }
            else
            {
              $disp_qty = $myrow[3];
            }*/
            if($currency == '$')
            {
             $total_page_cost_dollar += (($myrow[2])*$price);
            }
            else if($currency == 'Rs')
            {
             $total_page_cost_rupee += (($myrow[2])*$price);
            }
            else if($currency == '')
            {
             $total_page_cost_nocurr += (($myrow[2])*$price);
            }
           // echo $myrow[0]."--**--".$myrow[2]."<br>";
            printf('<tr><td bgcolor="#FFFFFF" align="center"><span class="tabletext">%s</td>
                    <td bgcolor="#FFFFFF" align="center"><span class="tabletext">%d</td>',

                      $myrow[0],
                      $myrow[2]);
            printf('<td bgcolor="#FFFFFF" align="right"><span class="tabletext">%s %.2f</td>',$currency,$price);
            printf('<td bgcolor="#FFFFFF" align="right"><span class="tabletext">%s %.2f</td>',$currency,(($myrow[2])*$price));
           /* printf('<td bgcolor="#FFFFFF" align="center"><span class="tabletext">%s</td>
                    <td bgcolor="#FFFFFF" align="center"><span class="tabletext">%.2f</td>',

                      $myrow[4],
                      $myrow[3]); */
            
          }

?>
</td></tr>
<tr>
<td bgcolor="#FFFFFF" colspan=3 align="right"><span class="heading"><b>Total(Rs)</b></td>
<?php
printf('<td bgcolor="#FFFFFF" colspan=1 align="right"><span class="tabletext">%s %s</td>','Rs',number_format($total_page_cost_rupee),2,'.',',');
?>
<tr>
<td bgcolor="#FFFFFF" colspan=3 align="right"><span class="heading"><b>Total($)</b></td>
<?php
printf('<td bgcolor="#FFFFFF" colspan=1 align="right"><span class="tabletext">%s %s</td>','$',number_format($total_page_cost_dollar),2,'.',',');
?>
<tr>
<td bgcolor="#FFFFFF" colspan=3 align="right"><span class="heading"><b>Total</b></td>
<?php
printf('<td bgcolor="#FFFFFF" colspan=1 align="right"><span class="tabletext">%s %s</td>','',number_format($total_page_cost_nocurr),2,'.',',');
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

/*$numrows =
//echo 'numrows='.$numrows;
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
    $prev = " <a href=\"fg.php?page=$page&totpages=$totpages&final_refno=$finalref_match&flag=1&tcd=$total_cost_dollar&tcr=$total_cost_rupee\">[Prev]</a> ";

    $first = " <a href=\"fg.php?page=1&totpages=$totpages&final_refno=$finalref_match&flag=1&tcd=$total_cost_dollar&tcr=$total_cost_rupee\">[First Page]</a> ";
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
  $next = " <a href=\"fg.php?page=$page&totpages=$totpages&final_refno=$finalref_match&flag=1&tcd=$total_cost_dollar&tcr=$total_cost_rupee\">[Next]</a> ";

  $last = " <a href=\"fg.php?page=$totpages&totpages=$totpages&final_refno=$finalref_match&flag=1&tcd=$total_cost_dollar&tcr=$total_cost_rupee\">[Last Page]</a> ";
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
echo "<span class=\"labeltext\"><align=\"center\">No matching records found";     */
// End additions on Dec 6,04

?>
</td>
</tr></table>
</form>
</body>
</html>
