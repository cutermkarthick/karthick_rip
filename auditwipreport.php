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
$rowsPerPage = 10000;

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

date_default_timezone_set('Asia/Calcutta');
 $todate1 = date("Y-m-d");


$today = split('-',$todate1);
$days = $today[2]-1;
$fromdate1 = date("Y-m-d",strtotime("-$days days"));
$crn=$_REQUEST['crn'];
$fdate=$_REQUEST['fdate'];
$tdate=$_REQUEST['tdate'];
if($tdate==''&& $crn=='')
{

 $cond0 = " w.crn_num like '%'";
 $cond31 = "to_days(w.book_date) " . ">= to_days('" . $fromdate1 . "')";
 $cond32 = "to_days(w.book_date) " . "<= to_days('" . $todate1 . "')";
 $cond3= $cond31;
 $finalref_match = '';
}else
{
  if($crn !='')
  {
    $cond0 = " w.crn_num like '".$crn."%'";
    $finalref_match = $crn;
  }else
  {
   $cond0 = " w.crn_num like '%'";
   $finalref_match = '';
  }

  //echo $fdate."*--*-*".$tdate;
  if($tdate=='')
  {   //echo"----8888here";
    $cond3 = "(to_days(w.book_date)-to_days('1582-01-01') > 0 ||
                    w.book_date = '0000-00-00' ||
                    w.book_date = 'NULL' ) and
           (to_days(w.book_date)-to_days('2050-12-31') < 0 ||
                    w.book_date = '0000-00-00' ||
                    w.book_date = 'NULL')";
           $fromdate1= '';
           $todate1= '';
  } else
  {
    //echo"-----9999here<br>";
     $cond31 = "to_days(w.book_date) " . ">= to_days('" . $fdate . "')";
     $cond32 = "to_days(w.book_date) " . "<= to_days('" . $tdate . "')";
     $cond3=$cond32;
     $fromdate1= $fdate;
     $todate1= $tdate;
     //echo $fdate."*--*-*".$tdate."--------".$fromdate1."-*-*".$todate1;
  }
  //echo $finalref_match."****in***";
}
$cond1 = " w.wonum like '%'";
$cond2 = " w.grnnum like '%'";


$cond4 = "c.name like '%'";

$cond= $cond0 . ' and ' . $cond1 . ' and ' . $cond2 . ' and ' . $cond3;

if ( isset ( $_REQUEST['crnnum'] ) )
{    //echo"here----";
     $finalref_match = $_REQUEST['crnnum'];
     $final_refno = "'" . $_REQUEST['crnnum'] . "%" . "'";
     $cond0 = " w.crn_num like " . $final_refno;

}
else {

     if($crn !='')
      $finalref_match = $crn;
      else
       $finalref_match = '';


}

if ( isset ( $_REQUEST['wonum'] ) )
{
     $wono_match = $_REQUEST['wonum'];
     $final_wono = "'" . $_REQUEST['wonum'] . "%" . "'";
     $cond1 = " w.wonum like " . $final_wono;

}
else {
     $wono_match = '';
}

if ( isset ( $_REQUEST['grnnum'] ) )
{
     $cust_match = $_REQUEST['grnnum'];
     $final_cust = "'" . $_REQUEST['grnnum'] . "%" . "'";
     $cond2 = " w.grnnum like " . $final_cust;

}
else {
     $cust_match = '';
}

if ( isset ( $_REQUEST['sdate1'] ) || isset ( $_REQUEST['sdate2'] ) )
{
     $fromdate1 = $_REQUEST['sdate1'];
     $todate1 = $_REQUEST['sdate2'];
     if ( isset ( $_REQUEST['sdate1']) &&  $_REQUEST['sdate1'] != '' )
     {
          $date1 = $_REQUEST['sdate1'];
          $cond31 = "to_days(w.book_date) " . ">= to_days('" . $date1 . "')";
     }
     else
     {
          $cond31 = "(to_days(w.book_date)-to_days('1582-01-01') > 0 || w.book_date = '0000-00-00')";
     }

     if ( isset ( $_REQUEST['sdate2'] )  &&  $_REQUEST['sdate2'] != '')
     {
          $date2 = $_REQUEST['sdate2'];
          $cond32 = "to_days(w.book_date) " . "<= to_days('" . $date2 . "')";
     }
     else
     {
          $cond32 = "(to_days(w.book_date)-to_days('2050-12-31') < 0
                       || w.book_date = '0000-00-00')";
     }

       $cond3 = $cond31;


}
else
{
     if($tdate!='')
     {
       $fromdate1 = $fdate;
       $todate1 = $tdate;
     }else
     { //echo"----here";
       $fromdate1 = $fromdate1;
       $todate1 = $todate1;
     }
}
if ( isset ( $_REQUEST['scomp'] ) )
{
     $company_match = $_REQUEST['scomp'];

    $scomp = "'" . $_REQUEST['scomp'] . "%" . "'";

     $cond4 = "c.name like " . $scomp;

}
else {
     $company_match = '';
}
//echo $finalref_match."-----";
$cond= $cond0 . ' and ' . $cond1 . ' and ' . $cond2 . ' and ' . $cond3;
//echo $cond."--------------";
include('classes/reportClass.php');
include('classes/stockClass.php');
include('classes/displayClass.php');
$newreport = new stockreport;
$newdisplay = new display;
?>

<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/report.js"></script>
<html>
<head>
<title>Work in Progress Report</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">

<?php
include('header.html');

?>
<form action='auditwipreport.php' method='post' enctype='multipart/form-data'>
<table width=100% cellspacing="0" cellpadding="6" border="0">
<tr>
<td>
<table width=100% border="0" cellspacing="0" cellpadding="0">
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
<tr><td>
  <table width=100% border=0 cellspacing="0" cellpadding="0">
   <tr><td><span class="heading"><b>Work in Progress Report</b></td>
   <td align="right"><a href="stock_costReport.php?crn=<?php echo $finalref_match ?>&fdate=<?php echo $fromdate1 ?>&tdate=<?php echo $todate1 ?>"><b><img width=30px hight=50px border=0 src="images/arrow_left.png" alt="Auditor Report"></b></a></td>
<table width=100% border=0 cellpadding=6 cellspacing=1 bgcolor="#DFDEDF" >
<tr>
<td bgcolor="#F5F6F5" colspan="17"><span class="heading"><b><center>Search Criteria</center></b></td>
</tr>
<tr>
	<td bgcolor="#FFFFFF"><span class="labeltext"><b>PRN #:</b>&nbsp;
	<input type="text" name="crnnum" size=15 value="<?php echo $finalref_match ?>" ></td>
	<td bgcolor="#FFFFFF"><span class="labeltext"><b>WO No:</b>&nbsp;
	<input type="text" name="wonum" size=15 value="<?php echo $wono_match ?>"></td>
	<td bgcolor="#FFFFFF" rowspan=2  align="center"><span class="tabletext"><input type= "image" name="Get" src="images/bu-get.gif" value="Get" onclick="javascript: return searchsort_fields()">
	</td>
	</tr>
	<tr>
<td bgcolor="#FFFFFF" colspan=2><span class="labeltext"><b>Book Date:  From &nbsp&nbsp</b>
        <input type="text" name="sdate1" size=10 value="<?php echo $fromdate1 ?>"
         onkeypress="javascript: return checkenter(event)">
        <img src="images/bu-getdateicon.gif" alt="Get Date" onclick='GetDate("sdate1")'>
         <span class="labeltext"><b>&nbsp;&nbsp;To</b>
        <input type="text" name="sdate2" size=10 value="<?php echo $todate1 ?>"
         onkeypress="javascript: return checkenter(event)">
        <img src="images/bu-getdateicon.gif" alt="Get Date" onclick='GetDate("sdate2")'>
</td>

</tr>
</table>
<br>
<table style="table-layout: fixed" width=1210px border=0 cellpadding=6 cellspacing=1 bgcolor="#DFDEDF" >
        <tr>
		  <td bgcolor="#EEEFEE" align="center"><span class="heading"><b>PRN#</b></td>
          <td bgcolor="#EEEFEE" align="center"><span class="heading"><b>RM Type</b></td>
          <td bgcolor="#EEEFEE" align="center"><span class="heading"><b>WO No</b></td>
          <td bgcolor="#EEEFEE" align="center"><span class="heading"><b>Qty</b></td>
          <td bgcolor="#EEEFEE" align="right"><span class="heading"><b>RM Cost(Qty)</b></td>
          <td bgcolor="#EEEFEE" align="center"><span class="heading"><b>Qty Produced</b></td>
          <td bgcolor="#EEEFEE" align="right"><span class="heading"><b>RM Cost ($)<br>(Qty Prod)</b></td>
         <td bgcolor="#EEEFEE" align="center"><span class="heading"><b>Act Sales<br>Cost ($)</b></td>
         <td bgcolor="#EEEFEE" align="center"><span class="heading"><b>% Progress</b></td>
         <td bgcolor="#EEEFEE" align="center"><span class="heading"><b>% Cost ($)</b></td>
        </tr>
</table>
<div style="width:1230px; height:400; overflow:auto;border:" id="dataList">

<table style="table-layout: fixed" width=1210px border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >

<?php
        $total_rm_cost = 0;
        $total_so_cost = 0;
        $total_qty=0; $totaldnrecdcost=0;$cost1=0; $flag=0; $total_qty_pgt=0;
        $curr_rm='';$curr_so=''; $total_cost_rm=0; $curr_rmto='';$curr_soto='';
        $total_so_costd=0; $total_so_costrs=0;$total_so_costgbp=0;$total_rm_cost_qty=0;$qtyprod=0;
       // echo $todate1."-------------";  (Qty Produced*RM Unit Price)  <br>(Qty Produced*Soli Unit Price)
        if($todate1!='')
        {
          $result = $newreport->getallwoqty4open4drilldown($cond,$todate1,$offset,$rowsPerPage);
        }else
        {
          $result = $newreport->getallwoqty4open4drilldown($cond,$todate1,$offset,$rowsPerPage);
        }
        
         if($flag==0)
        {
         $total_cost_dollar=0;
         $total_cost_rupee=0;
          $resultto = $newreport->getallwoqty4open4totalcost($cond,$todate1);
        //$temp_result = $result;
         while ($myrowto = mysql_fetch_row($resultto)) {
        //echo $from_row_count;
        $resulttrwipto=$newreport->getdnqty4w4drilldown($todate1,$myrow[0],$myrow[1]);
        $myresultdnto=mysql_fetch_row($resulttrwipto);
         $temp_woqtyto =$myrowto[6]-$myresultdnto[1];
        $resultmdto = $newreport->getmasterdata4wo($myrowto[4]);
        $mymdto = mysql_fetch_row($resultmdto);

        if($myrowto[2] == 0)
        {
        $mps_revto = $mymdto[0];
        }
        else
        {
        $mps_revto = $mymdto[3];
        }
        
        $resultmsstageto= $newreport->getallmcstageDetails($myrowto[0],$mps_revto);
        $resultoperdetto= $newreport->getalloperatorDetails($myrowto[1],$myrowto[0],$todate1);
        $resultrmcstto= $newreport->getrate4crn($myrowto[0]);
        $resultsolicstto= $newreport->getsoliprice4crn($myrowto[0]);

        $myoperdetsto=mysql_fetch_row($resultoperdetto);
        $mymcdetsto=mysql_fetch_row($resultmsstageto);
        $myrmdetsto=mysql_fetch_row($resultrmcstto);
        $mysolidetsto=mysql_fetch_row($resultsolicstto);

        	$curr_rmto= $myrmdetsto[1];
			$curr_soto= $mysolidetsto[1];

                $total_cost_rm += ($myoperdetsto[1]*$myrmdetsto[0]);
                $total_cost_so += ($myoperdetsto[1]*$mysolidetsto[0]);
                $total_qty_pgt+= $temp_woqtyto;
        }
        $flag=1;
        }
        $tot_rm_cst=number_format ($total_cost_rm,2 );
        $tot_so_cst=number_format ($total_cost_so,2 );
        $tqty=number_format ($total_qty_pgt,2 );
       // echo "<tr><td colspan=9 align=\"right\"><span class=\"labeltext\">Total Qty: $tqty Total RM Cost : $curr_rmto $tot_rm_cst  Total Sales Cost : $curr_soto $tot_so_cst</td></tr>";

        

        while ($myrow = mysql_fetch_row($result)) {
        $resulttrwip=$newreport->getdnqty4w4drilldown($todate1,$myrow[0],$myrow[1]);
        $myresultdn=mysql_fetch_row($resulttrwip);
         $temp_woqty =$myrow[6]-$myresultdn[1];
        $resultmd = $newreport->getmasterdata4wo($myrow[4]);
        $mymd = mysql_fetch_row($resultmd);

        if($myrow[2] == 0)
        {
        $mps_rev = $mymd[0];
        }
        else
        {
        $mps_rev = $myrow[3];
        }
        
        $resultmsstage= $newreport->getallmcstageDetails($myrow[0],$mps_rev);
        $resultoperdet= $newreport->getalloperatorDetails($myrow[1],$myrow[0],$todate1);
        $resultrmcst= $newreport->getrate4crn($myrow[0]);
        $resultsolicst= $newreport->getsoliprice4crn($myrow[0]);
        
        $myoperdets=mysql_fetch_row($resultoperdet);
        $mymcdets=mysql_fetch_row($resultmsstage);
        $myrmdets=mysql_fetch_row($resultrmcst);
        $mysolidets=mysql_fetch_row($resultsolicst);


        $total_wiptr += $myresultdn[1];
        $totaldnacc += $myresultdn[2];
        $totaldnrecdcost = $myresultdn[3];
        $totaldnacccost += $myresultdn[4];

        $total_wip = $myrow[2];
        $costtemp+= $myrow[3];
        $total_dnsent= $myrow[4];
        $total= ($myrow[2]-$myrow[4]);


          // echo   $mymcdets[0]."-----".$myoperdets[0]."----";
			$curr_rm= $myrmdets[1];
			$curr_so= $mysolidets[1];

           $total_rm_cost += ($myoperdets[1]*$myrmdets[0]);
           $total_rm_cost_qty+=($temp_woqty*$myrmdets[0]);

			if($mymcdets[0]!=0&&$mymcdets[0]!='')
			{
			   $progress=($myoperdets[0]/ $mymcdets[0])*100;
			   //echo "HERE-1---$progress";
			}else
			{  
				//echo "HERE--2--$progress";
			    $progress=0;
			    //$myoperdets[1]
			}
		  $total_so_costd += ($myoperdets[1]*$mysolidets[0]);
          $qtyprod+=$myoperdets[1];
            printf('<tr><td bgcolor="#FFFFFF" align="center"><span class="tabletext">%s</td>
                    <td bgcolor="#FFFFFF" align="center"><span class="tabletext">%s</td>
                    <td bgcolor="#FFFFFF" align="center"><span class="tabletext">%s</td>
					<td bgcolor="#FFFFFF" align="center"><span class="tabletext">%.2f</td>
					 <td bgcolor="#FFFFFF" align="right"><span class="tabletext">%.2f</td>
					<td bgcolor="#FFFFFF" align="center"><span class="tabletext">%.2f</td>
                    <td bgcolor="#FFFFFF" align="right"><span class="tabletext">%.2f</td>
                    <td bgcolor="#FFFFFF" align="right"><span class="tabletext">%.2f</td>
                    <td bgcolor="#FFFFFF" align="right"><span class="tabletext">%.2f</td>
                    <td bgcolor="#FFFFFF" align="right"><span class="tabletext">%.2f</td>',
                      $myrow[0],
                      $myrow[5],
                      $myrow[1],
                      $temp_woqty,
                      ($temp_woqty*$myrmdets[0]),
                      $myoperdets[1],
                      ($myoperdets[1]*$myrmdets[0]),
                      ($myoperdets[1]*$mysolidets[0]),
                      $progress,
					  (($myoperdets[1]*$mysolidets[0]*$progress)/100));
                      $total_qty+= $temp_woqty;

}
//echo $totalqty."------"; <td colspan="6" align="right" class="labeltext">&nbsp;</td> <td colspan="1" align="right" class="tabletext">&nbsp;</td>
$prrmcst=number_format ($total_rm_cost,2 );
$prsocstd=number_format ($total_so_costd,2 );
$prrmqtycst=number_format ($total_rm_cost_qty,2 );
?>
</td>
</tr>
<tr bgcolor="#FFFFFF">
<td colspan="3" align="right" class="labeltext">Total</td>
<td colspan="1" align="center" class="tabletext"><?php printf('%.2f',$total_qty);?></td>
<td colspan="1" align="right" class="tabletext"><?php printf('%s %s',$curr_rm,$prrmqtycst);?></td>
<td colspan="1" align="center" class="tabletext"><?php printf('%.2f',$qtyprod);?></td>
<td colspan="1" align="right" class="tabletext"><?php printf('%s',$prrmcst);?></td>
<td colspan="1" align="right" class="tabletext"><?php printf('%s',$prsocstd);?></td>
<td colspan="2"  class="labeltext">&nbsp;</td>
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
</form>
</body>
</html>
