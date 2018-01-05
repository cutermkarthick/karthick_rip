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
include_once('classes/stockClass.php');
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
$crn=$_REQUEST['crn'];
//echo $crn."-------";
$fdate=$_REQUEST['fdate'];
$tdate=$_REQUEST['tdate'];

$fgtotqty=$_REQUEST['fgtotqty'];
$fgtotcost=$_REQUEST['fgtotcost'];

if($tdate==''&&$crn=='')
{

 $cond1 = " m.CIM_refnum like '%'";
 $cond2 = "(to_days(dl.disp_date)-to_days('1582-01-01') > 0 ||
                    dl.disp_date = '0000-00-00' ||
                    dl.disp_date = 'NULL' ) and
           (to_days(dl.disp_date)-to_days('2050-12-31') < 0 ||
                    dl.disp_date = '0000-00-00' ||
                    dl.disp_date = 'NULL') and
                    (to_days(w.actual_ship_date)-to_days('1582-01-01') > 0 ||
                    w.actual_ship_date = '0000-00-00' ||
                    w.actual_ship_date = 'NULL' ) and
           (to_days(w.actual_ship_date)-to_days('2050-12-31') < 0 ||
                    w.actual_ship_date = '0000-00-00' ||
                    w.actual_ship_date = 'NULL')";
}else
{
  if($crn=='')
  {
    $cond1 = " m.CIM_refnum like '%'";
  $finalref_match = '';
  }else
  {
   $cond1 = " m.CIM_refnum like '".$crn."%'";
   $finalref_match = $crn;
  }

  //echo $fdate."*--*-*".$tdate;
  if($tdate=='')
  {   //echo"----8888here";
    $cond2 = "(to_days(dl.disp_date)-to_days('1582-01-01') > 0 ||
                    dl.disp_date = '0000-00-00' ||
                    dl.disp_date = 'NULL' ) and
           (to_days(dl.disp_date)-to_days('2050-12-31') < 0 ||
                    dl.disp_date = '0000-00-00' ||
                    dl.disp_date = 'NULL') ";
    $cond3 ="(to_days(w.actual_ship_date)-to_days('1582-01-01') > 0 ||
                    w.actual_ship_date = '0000-00-00' ||
                    w.actual_ship_date = 'NULL' ) and
           (to_days(w.actual_ship_date)-to_days('2050-12-31') < 0 ||
                    w.actual_ship_date = '0000-00-00' ||
                    w.actual_ship_date = 'NULL')";
           $fromdate1= '';
     $todate1= '';
  } else
  {
    //echo"-----9999here<br>";
     $cond21 = "to_days(dl.disp_date) " . ">= to_days('" . $fdate . "')";
     $cond22 = "to_days(dl.disp_date) " . "<= to_days('" . $tdate . "')";
     $cond32 = "to_days(w.actual_ship_date) " . "<= to_days('" . $tdate . "')";
     $cond2=$cond22 ;
     $cond3=$cond32;
     $fromdate1= $fdate;
     $todate1= $tdate;
     //echo $fdate."*--*-*".$tdate."--------".$fromdate1."-*-*".$todate1;
  }
  //echo $finalref_match."****in***";
}
//$cond2 = "wo.wonum like '%'";
//$cond = $cond1 . ' and ' . $cond2;
$cond=$cond1 . ' and ' . $cond3;

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
//echo $_REQUEST['final_refno']."----------";
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

     $cond1 = "m.CIM_refnum " . $oper1 . " " . $final_refno;

}
else {
     if($crn=='')
{
      $finalref_match = '';
}else
{

  $finalref_match = $crn;
}
}



if ( isset ( $_REQUEST['sortfld1'] ) ) {
    $sort1 = $_REQUEST['sortfld1'];
}
if ( isset ( $_REQUEST['sortfld2'] ) ) {
    $sort2 = $_REQUEST['sortfld2'];
}

if ( isset ( $_REQUEST['ddate1'] ) || isset ( $_REQUEST['ddate2'] ) )
{
     $ddate1_match = $_REQUEST['ddate1'];
     $ddate2_match = $_REQUEST['ddate2'];
     if ( isset ( $_REQUEST['ddate1']) &&  $_REQUEST['ddate1'] != '' )
     {
          $date1 = $_REQUEST['ddate1'];
          $cond21 = "to_days(dl.disp_date) " . "> to_days('" . $date1 . "')";
           $cond31 = "to_days(w.actual_ship_date) " . ">= to_days('" . $date1 . "')";
     }
     else
     {
          $cond21 = "(to_days(dl.disp_date)-to_days('1582-01-01') > 0 || dl.disp_date = 'NULL' || dl.disp_date = '0000-00-00')";
          $cond31 = "(to_days(w.actual_ship_date)-to_days('1582-01-01') > 0 || w.actual_ship_date = '0000-00-00')";
     }

     if ( isset ( $_REQUEST['ddate2'] )  &&  $_REQUEST['ddate2'] != '')
     {
          $date2 = $_REQUEST['ddate2'];
          $cond22 = "to_days(dl.disp_date) " . "< to_days('" . $date2 . "')";
          $cond32 = "to_days(w.actual_ship_date) " . "<= to_days('" . $date2 . "')";
     }
     else
     {
          $cond22 = "(to_days(dl.disp_date)-to_days('2050-12-31') < 0 || dl.disp_date = 'NULL' || dl.disp_date = '0000-00-00')";
          $cond32 = "(to_days(w.actual_ship_date)-to_days('2050-12-31') < 0 || w.actual_ship_date = '0000-00-00')";
     }
     $cond2 = $cond21 . ' and ' . $cond22;
     $cond3= $cond31 . ' and ' . $cond32 ;
}
else
{
    if($tdate!='')
     {
       $ddate1_match = '';
       $ddate2_match =$tdate;
     }else
     { //echo"----here";
       $ddate1_match = '';
       $ddate2_match = '';
     }




}

//$cond1 = "c.name like '%'";
//$cond = $cond1 . ' and ' . $cond2;
$cond=$cond1 . ' and ' . $cond3;
//echo $cond;
// First include the class definition

include('classes/reportClass.php');
include('classes/displayClass.php');
$newreport = new stockreport;
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
<form action='auditfgreport.php' method='post' enctype='multipart/form-data'>
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
   <tr><td><span class="heading"><b>Audit Finished Goods Report</b></td>

    <td align="right"><a href="stock_costReport.php?crn=<?php echo $finalref_match ?>&fdate=<?php echo $ddate1_match ?>&tdate=<?php echo $ddate2_match ?>"><b><img width=30px height=50px border=0 src="images/arrow_left.png" alt="CRN Stock Report"></b></a></td>


<tr><td>
<table width=100% border=0 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF" >
<tr>
<td bgcolor="#F5F6F5" colspan="4"><span class="heading"><b><center>Search Criteria</center></b></td>
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

<td  bgcolor="#FFFFFF"><input type="text" name="final_refno" size=15 value="<?php echo $finalref_match ?>" onkeypress="javascript: return checkenter(event)">
</td>
<td  bgcolor="#FFFFFF"><span class="labeltext"><b>Dispatch Date:  From &nbsp&nbsp</b>
        <input type="text" name="ddate1" size=10 value="<?php echo $ddate1_match ?>"
         onkeypress="javascript: return checkenter(event)">
        <img src="images/bu-getdateicon.gif" alt="Get Date" onclick='GetDate("ddate1")'>
         <span class="labeltext"><b>&nbsp;&nbsp;To</b>
        <input type="text" name="ddate2" size=10 value="<?php echo $ddate2_match ?>"
         onkeypress="javascript: return checkenter(event)">
        <img src="images/bu-getdateicon.gif" alt="Get Date" onclick='GetDate("ddate2")'>
</td>

	</tr>
</table>

</td></tr>
    </tr>
   </table>
<tr><td>
<br>

<table style="table-layout: fixed"   width=600px border=0 cellpadding=6 cellspacing=1 bgcolor="#DFDEDF" >
        <tr>
            <td  bgcolor="#EEEFEE" align="center"><span class="heading"><b>PRN</b></td>
            <td  bgcolor="#EEEFEE" align="center"><span class="heading"><b>RM Type</b></td>
            <td  bgcolor="#EEEFEE" align="center"><span class="heading"><b>FG Stock</b></td>
            <td  bgcolor="#EEEFEE" align="center"><span class="heading"><b>RM Cost</b></td>
            <td  bgcolor="#EEEFEE" align="center"><span class="heading"><b>Actual Sales<br>Cost</b></td>
             <!--<td bgcolor="#EEEFEE" align="center"><span class="heading"><b>%Progress</b></td>
              <td bgcolor="#EEEFEE" align="center"><span class="heading"><b>%Cost</b></td>-->
        </tr>
</table>
<div  style="width:615px; height:400; overflow:auto;border:" id="dataList">

<table style="table-layout: fixed"  width=600px border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >

<?php


        //$temp_result = $result;
                $total_rm_cost = 0;
                $total_so_cost = 0;
                $total_fg_qty=0; $totalcost_per=0;
                $cost1=0;
                $total_rm_costto = 0;
                $total_so_costto = 0;
                $total_fg_qtyto=0; $totalcost_perto=0;
                $curr_rm='';$curr_so='';  $curr_rmto='';$curr_soto='';   $flag=0;  $totd=0;$totf=0; $tot_no_qty=0;
        $resultdispqty=$newreport->getdispqtydetails4drilldown($ddate2_match,$finalref_match,$offset,$rowsPerPage);
        //echo mysql_num_rows($resultdispqty) ."-----";
        if(mysql_num_rows($resultdispqty)>0)
        { //echo"HERE-----";
         if($flag==0)
         {      
			 $resultdispqty4tot=$newreport->getdispqtydetails4tot($ddate2_match,$finalref_match,$offset,$rowsPerPage);
            while ($myresultdispqty4tot=mysql_fetch_row($resultdispqty4tot)) {
                 //echo $from_row_count;
               $resultfgqty4tot=$newreport->getcqty4closedwo4drilldown($ddate2_match,$myresultdispqty4tot[1]);
               $myresultfgqty4tot=mysql_fetch_row($resultfgqty4tot);
        
              $resultndqty4tot=$newreport->getclosedwo_dispatch($ddate2_match,$myresultdispqty4tot[1]);
              $myresultndqty4tot=mysql_fetch_row($resultndqty4tot);
               $tot_no_qty +=$myresultndqty4tot[0] ;
           // $result4rmprice = $newreport->getrate4crn($myresultdispqty[1]);
            //$myrow4rmprice = mysql_fetch_row($result4rmprice);

            if($myresultdispqty4tot[0] == '')
            {
              $disp_qty4tot = 0;
            }
            else
            {
              $disp_qty4tot = $myresultdispqty4tot[0];
            }

            $resultrmcst4tot= $newreport->getrate4crn($myresultdispqty4tot[1]);
            $myrmdets4tot=mysql_fetch_row($resultrmcst4tot);
             $resultsolicst4tot= $newreport->getsoliprice4crn($myresultdispqty4tot[1]);
             $mysolidets4tot=mysql_fetch_row($resultsolicst4tot);

             	$curr_rmto= $myrmdets4tot[1];
			$curr_soto= $mysolidets4tot[1];

            $total_fg_qtyto +=($myresultfgqty4tot[0]-$disp_qty4tot);
           $total_rm_costto+=(($myresultfgqty4tot[0]-$disp_qty4tot)*$myrmdets4tot[0]) ;
           $total_so_costto +=(($myresultfgqty4tot[0]-$disp_qty4tot)*$mysolidets4tot[0]);
           $totalcost_perto +=(($myresultfgqty4tot[0]-$disp_qty4tot)*100);
           $totd+=$myresultfgqty4tot[0];$totf+=$disp_qty4tot;
          }

           $flag=1;
         }
         //echo $totd."---***---".$totf."--***----".$tot_no_qty;
        $tot_rm_cst=number_format ($total_rm_costto,2 );
        $tot_so_cst=number_format ($total_so_costto,2 );
        $tot_cst =number_format ($totalcost_perto,2 );
          $t_fg_qty=number_format ($total_fg_qtyto,2 );
      // echo "<tr><td colspan=7 align=\"right\"><span class=\"labeltext\">Total Qty: $t_fg_qty  <br>Total RM Cost : $curr_rmto  $tot_rm_cst  Total Sales Cost : $curr_soto $tot_so_cst Total Cost : $curr_soto $tot_cst </td></tr>";
       //echo "<tr><td colspan=6 align=\"right\"><span class=\"labeltext\">Total Qty: $t_fg_qty  <br>Total RM Cost : $curr_rmto  $tot_rm_cst  Total Sales Cost : $curr_soto $tot_so_cst  </td></tr>";
        while ($myresultdispqty=mysql_fetch_row($resultdispqty)) {
        //echo $from_row_count;
        $resultfgqty1=$newreport->getcqty4closedwo4drilldown($ddate2_match,$myresultdispqty[1]);
        $myresultfgqty1=mysql_fetch_row($resultfgqty1);
           // $result4rmprice = $newreport->getrate4crn($myresultdispqty[1]);
            //$myrow4rmprice = mysql_fetch_row($result4rmprice);

            if($myresultdispqty[0] == '')
            {
              $disp_qty = 0;
            }
            else
            {
              $disp_qty = $myresultdispqty[0];
            }

            $resultrmcst= $newreport->getrate4crn($myresultdispqty[1]);
            $myrmdets=mysql_fetch_row($resultrmcst);
             $resultsolicst= $newreport->getsoliprice4crn($myresultdispqty[1]);
             $mysolidets=mysql_fetch_row($resultsolicst);
             
             	$curr_rm= $myrmdets[1];
			$curr_so= $mysolidets[1];

                //$total_rm_cost += $myrmdets[0];
                //$total_so_cost += $mysolidets[0];

            printf('<tr><td  bgcolor="#FFFFFF" align="center"><span class="tabletext">%s</td>
            <td  bgcolor="#FFFFFF" align="center"><span class="tabletext">%s</td>
            <td bgcolor="#FFFFFF" align="center"><span class="tabletext">%d</td>',

                      $myresultdispqty[1],
                      $myresultfgqty1[2],
                      $myresultfgqty1[0]-$disp_qty);
		
		   $linermcst=number_format ((($myresultfgqty1[0]-$disp_qty)*$myrmdets[0]),2 );
           $linesocst=number_format ((($myresultfgqty1[0]-$disp_qty)*$mysolidets[0]),2 );
            printf('<td bgcolor="#FFFFFF" align="right"><span class="tabletext"> %s</td>',$linermcst);
            printf('<td  bgcolor="#FFFFFF" align="right"><span class="tabletext"> %s</td>',$linesocst);
           // printf('<td bgcolor="#FFFFFF" align="right"><span class="tabletext">%d</td>','100%');
            //printf('<td bgcolor="#FFFFFF" align="right"><span class="tabletext">%s %.2f</td>',$mysolidets[1],(($myresultfgqty1[0]-$disp_qty)*100));

           $total_fg_qty +=($myresultfgqty1[0]-$disp_qty);
           $total_rm_cost+=(($myresultfgqty1[0]-$disp_qty)*$myrmdets[0]) ;
           $total_so_cost +=(($myresultfgqty1[0]-$disp_qty)*$mysolidets[0]);
           $totalcost_per +=(($myresultfgqty1[0]-$disp_qty)*100);
          }

         }else
         {   // echo"HERE---555--.$ddate2_match---$finalref_match";
           $resultfgqty1=$newreport->getcqty4closednodisp($ddate2_match,$finalref_match,$offset,$rowsPerPage);

           while($myresultfgqty1=mysql_fetch_row($resultfgqty1))
           {
                $totalfg1+=$myresultfgqty1[0];
                $costfg1 += $myresultfgqty1[1];
                //$result4rmprice = $newreport->getrate4crn($myresultfgqty1[2]);
                //$myrow4rmprice = mysql_fetch_row($result4rmprice);
                
                 $resultrmcst= $newreport->getrate4crn($myresultfgqty1[2]);
            $myrmdets=mysql_fetch_row($resultrmcst);
             $resultsolicst= $newreport->getsoliprice4crn($myresultfgqty1[2]);
             $mysolidets=mysql_fetch_row($resultsolicst);
             
             	$curr_rm= $myrmdets[1];
			    $curr_so= $mysolidets[1];

                //$total_rm_cost += $myrmdets[0];
                //$total_so_cost += $mysolidets[0];
             

             $disp_qty=0;



            printf('<tr><td bgcolor="#FFFFFF" align="center"><span class="tabletext">%s</td>
                    <td  bgcolor="#FFFFFF" align="center"><span class="tabletext">%s</td>
            <td bgcolor="#FFFFFF" align="center"><span class="tabletext">%d</td>',

                      $myresultfgqty1[2],
                      $myresultfgqty1[3],
                      $myresultfgqty1[0]-$disp_qty);
		   $linermcst=number_format ((($myresultfgqty1[0]-$disp_qty)*$myrmdets[0]),2 );
           $linesocst=number_format ((($myresultfgqty1[0]-$disp_qty)*$mysolidets[0]),2 );
            printf('<td  bgcolor="#FFFFFF" align="right"><span class="tabletext"> %s</td>',$linermcst);
            printf('<td  bgcolor="#FFFFFF" align="right"><span class="tabletext"> %s</td>',$linesocst);
            //printf('<td bgcolor="#FFFFFF" align="right"><span class="tabletext">%d</td>','100%');
            //printf('<td bgcolor="#FFFFFF" align="right"><span class="tabletext">%s %.2f</td>',$mysolidets[1],(($myresultfgqty1[0]-$disp_qty)*100));
            $total_fg_qty +=($myresultfgqty1[0]-$disp_qty);
            $total_rm_cost+=(($myresultfgqty1[0]-$disp_qty)*$myrmdets[0]) ;
            $total_so_cost +=(($myresultfgqty1[0]-$disp_qty)*$mysolidets[0]);
            $totalcost_per +=(($myresultfgqty1[0]-$disp_qty)*100);
           }

         }
$prrmcst=number_format ($total_rm_cost,2 );
$prsocstd=number_format ($total_so_cost,2 );
?>
</td></tr>
<tr bgcolor="#FFFFFF">
<td colspan="2" align="right" class="labeltext">Totals</td>
<td colspan="1" align="center" class="tabletext"><?php printf('%d',$fgtotqty);?></td>
<td colspan="1" align="right" class="tabletext"><?php print(number_format($fgtotcost));?></td>
<td colspan="1" align="right" class="tabletext"><?php print($prsocstd);?></td>
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


<table border = 0 cellpadding=0 cellspacing=0 width=100% >
<tr>
	<td align=left>

</td>
</tr></table>
</form>
</body>
</html>
