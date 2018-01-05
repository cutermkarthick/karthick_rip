<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = July 01, 2010                =
// Filename: dn_report.php                     =
// Copyright of Badari Mandyam, FluentSoft     =
// Revision: v1.0 OMS                          =
// Displays list of CRN.                       =
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
include('classes/stockClass.php');
include('classes/displayClass.php');
include_once('classes/reportClass.php');


$newlogin = new userlogin;
$newlogin->dbconnect();

$newreport = new stockreport;
$report = new report;
$newdisplay = new display;

$rowsPerPage = 100000;

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

$crn=$_REQUEST['crn'];
$fdate=$_REQUEST['fdate'];
$tdate=$_REQUEST['tdate'];

$dntotqty=$_REQUEST['dntotqty'];
$dntotcost=$_REQUEST['dntotcost'];
//echo "<br>dn tot cost is $dntotcost";

if($tdate==''&& $crn=='')
{

 $cond1 = "d.crn like '%'";
 $cond2 =  "(to_days(d.deliver_date)-to_days('1582-01-01') > 0 ||
                   d.deliver_date = '0000-00-00' ||
                    d.deliver_date = 'NULL' ) and
           (to_days(d.deliver_date)-to_days('2050-12-31') < 0 ||
                    d.deliver_date = '0000-00-00' ||
                    d.deliver_date = 'NULL')";
}else
{
  if($crn=='')
  {
   $cond1 = "d.crn like '%'";
   $crnnum = '';
  }else
  {
   $cond1 = "d.crn like '".$crn."%'";
   $crnnum = $crn;
  }

  //echo $fdate."*--*-*".$tdate;
  if($tdate=='')
  {   //echo"----8888here";
    $cond2 =  "(to_days(d.deliver_date)-to_days('1582-01-01') > 0 ||
                   d.deliver_date = '0000-00-00' ||
                    d.deliver_date = 'NULL' ) and
           (to_days(d.deliver_date)-to_days('2050-12-31') < 0 ||
                    d.deliver_date = '0000-00-00' ||
                    d.deliver_date = 'NULL')";
  } else
  {
    //echo"-----9999here<br>";
     $cond31 = "to_days(d.deliver_date) " . ">= to_days('" . $fdate . "')";
     $cond32 = "to_days(d.deliver_date) " . "<= to_days('" . $tdate . "')";
     $cond2=$cond32;
     $ddate1_match= $fdate;
     $ddate2_match= $tdate;
     //echo $fdate."*--*-*".$tdate."--------".$fromdate1."-*-*".$todate1;
  }
  //echo $finalref_match."****in***";
}
$cond0 = "d.sent_treat_to like '%'";

/*$cond2 =  "(to_days(d.deliver_date)-to_days('1582-01-01') > 0 ||
                   d.deliver_date = '0000-00-00' ||
                    d.deliver_date = 'NULL' ) and
           (to_days(d.deliver_date)-to_days('2050-12-31') < 0 ||
                    d.deliver_date = '0000-00-00' ||
                    d.deliver_date = 'NULL')"; */
$cond = $cond0 . ' and ' . $cond1 . ' and ' . $cond2 ;

if ($_REQUEST['treat_to'] != 'select' && $_REQUEST['treat_to'] != '')
{
 $finaltreat_to = $_REQUEST['treat_to'];
 $treat_to = "'" . $_REQUEST['treat_to'] . "'";
 $cond0 = " d.sent_treat_to = " . $treat_to;
}
else
{
     $treat_to = '';
}

if (  $_REQUEST['crnnum'] != '' )
{     //echo"HERE----";
     $crnnum = $_REQUEST['crnnum'];
     if ( isset ( $_REQUEST['refno_oper'] ) ) {
          $oper1 = $_REQUEST['refno_oper'];
     }
     else {
         $oper1= 'like';
     }
     if ($oper1 == 'like') {
         $final_crnnum = "'" . $_REQUEST['crnnum'] . "%" . "'";
     }
     else {
         $final_crnnum = "'" . $_REQUEST['crnnum'] . "'";
     }
     $cond1 = " d.crn " . $oper1 . " " . $final_crnnum;
}
else {

if($crn !='')
{
     $crnnum = $crn;
}else
{
     $crnnum = '';
}

}
if ( isset ( $_REQUEST['ddate1'] ) || isset ( $_REQUEST['ddate2'] ) )
{
     $ddate1_match = $_REQUEST['ddate1'];
     $ddate2_match = $_REQUEST['ddate2'];
     if ( isset ( $_REQUEST['ddate1']) &&  $_REQUEST['ddate1'] != '' )
     {
          $date1 = $_REQUEST['ddate1'];
          $cond21 = "to_days(d.deliver_date) " . ">= to_days('" . $date1 . "')";
     }
     else
     {
          $cond21 = "(to_days(d.deliver_date)-to_days('1582-01-01') > 0 || d.deliver_date = 'NULL' || d.deliver_date = '0000-00-00')";
     }

     if ( isset ( $_REQUEST['ddate2'] )  &&  $_REQUEST['ddate2'] != '')
     {
          $date2 = $_REQUEST['ddate2'];
          $cond22 = "to_days(d.deliver_date) " . "<= to_days('" . $date2 . "')";
     }
     else
     {
          $cond22 = "(to_days(d.deliver_date)-to_days('2050-12-31') < 0 || d.deliver_date = 'NULL' || d.deliver_date = '0000-00-00')";
     }
     $cond2 = $cond21 . ' and ' . $cond22;

}
else
{
     if($tdate!='')
     {
       $ddate1_match = $fdate;
       $ddate2_match = $tdate;
     }else
     { //echo"----here";
       $ddate1_match = '';
       $ddate2_match = '';
     }

}

$cond = $cond0 . ' and ' . $cond1 . ' and ' . $cond2 ;
//echo $cond."-----";
?>
<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/report.js"></script>

<html>
<head>
<title>DN Report</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">
<form action='auditdnreport.php' method='post' enctype='multipart/form-data'>
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
<?php $newdisplay->dispLinks('');
$result = $report->getVendors();
?>
</td></tr>
<table width=100% border=0 cellpadding=0 cellspacing=0>
  <tr bgcolor="DEDFDE"><td width="6"><img src="images/spacer.gif " width="6"></td>
	    <td bgcolor="#FFFFFF">
 <table width=100% border=0 cellpadding=6 cellspacing=0>
     <tr><td>

  <tr>
<td>

<table width=100% border=0 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF">
  <tr>
	<td bgcolor="#F5F6F5" colspan="10"><span class="heading"><b><center>Search & SortCriteria</center></b></td>
    <td bgcolor="#FFFFFF" rowspan=3 align="center">
	<input type= "image" name="submit" src="images/bu-get.gif" value="Get" onclick="javascript:return getsupp_crn_details()">
</td>
  </tr>
<tr>
<td bgcolor="#FFFFFF"><span class="labeltext"><b>Supplier Name</b></td>
<td bgcolor="#FFFFFF">
<select name='treat_to' id='treat_to'>
<option value='select'>Select</option>
<?php
while ($myrow = mysql_fetch_row($result)){
if($myrow[1]==$_REQUEST['treat_to']){
?>
<option selected value="<? echo $myrow[1]?>">
<?echo $myrow[1]; ?>
</option>
<?
}
else{
?>
<option value="<? echo $myrow[1]?>">
<?echo $myrow[1]; ?> </option>
<?php
}
}
?>
</select>
</td>
</td>

<td bgcolor="#FFFFFF"><span class="labeltext"><b>PRN</b></td>

<td bgcolor="#FFFFFF"><span class="tabletext"><select name="refno_oper" size="1" width="50">
<?php
   if ( isset ( $_REQUEST['refno_oper'] ) ){
          $oper1 = $_REQUEST['refno_oper'];

                   if ($oper1 =='like'){
?>
    	            <option value='='>=
	                <option selected ='like'>like
<?php
                    }else{
?>
                    <option selected ='='>=
	                <option value ='like'>like

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

<td bgcolor="#FFFFFF" colspan=6><input type="text" name="crnnum" id="crnnum"  size=15 value="<?php echo $crnnum ?>">
</td>
</tr>
	<tr>
	<td colspan=10 bgcolor="#FFFFFF"><span class="labeltext"><b>Deliver Date:  From &nbsp&nbsp</b>
        <input type="text" name="ddate1" id="ddate1" size=10 value="<?php echo $ddate1_match ?>"
         onkeypress="javascript: return checkenter(event)">
        <img src="images/bu-getdateicon.gif" alt="Get Date" onclick='GetDate("ddate1")'>
         <span class="labeltext"><b>&nbsp;&nbsp;To</b>
        <input type="text" name="ddate2" id="ddate2"  size=10 value="<?php echo $ddate2_match ?>"
         onkeypress="javascript: return checkenter(event)">
        <img src="images/bu-getdateicon.gif" alt="Get Date" onclick='GetDate("ddate2")'>
</td>

	</tr>
</table>
	</td></tr>

	<tr><td>

<?
//if($treat_to!='' || $crnnum!='')
//{?>
<table width=100% border=0>
  <tr>
  <td><span class="pageheading"><b>List Of DN</b></td>
  </td>

    <td align="right"><a href="stock_costReport.php?crn=<?php echo $crnnum ?>&fdate=<?php echo $ddate1_match ?>&tdate=<?php echo $ddate2_match ?>"><b><img width=30px hight=50px border=0 src="images/arrow_left.png" alt="CRN Stock Report"></b></a></td>

  </tr>
</table>
<br>
<table style="table-layout: fixed" width=1200px border=0 cellpadding=6 cellspacing=1 bgcolor="#DFDEDF" >
        <tr bgcolor="#FFCC00">
            <td  bgcolor="#EEEFEE"><span class="tabletext"><b>Sl.No</b></td>
            <td  bgcolor="#EEEFEE"><span class="tabletext"><b>DN #.</b></td>
            <td  bgcolor="#EEEFEE"><span class="tabletext"><b>DN Date</b></td>
            <td  bgcolor="#EEEFEE"><span class="tabletext"><b>PRN</b></td>
            <td  bgcolor="#EEEFEE"><span class="tabletext"><b>WO#</b></td>
            <td  bgcolor="#EEEFEE"><span class="tabletext"><b>Part No.<br>(aft treatment)</b></td>
	        <td  bgcolor="#EEEFEE"><span class="tabletext"><b>DN Qty</b></td>
            <td  bgcolor="#EEEFEE" align="center"><span class="tabletext"><b>Unreturned<br>Qty</b></td>
            <td  bgcolor="#EEEFEE" align="center"><span class="tabletext"><b>Unit RM<br>Price</b></td>
            <td  bgcolor="#EEEFEE"><span class="tabletext"><b>Balance<br>Cost</b></td>
        </tr>
</table>
<div style="width:1220px; height:400; overflow:auto;border:" id="dataList">

<table style="table-layout: fixed" width=1200px border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >

<?php

     
     
    $result = $newreport->getdeliverDetails($cond,$offset,$rowsPerPage);
           $total_balance_cost = 0;
        $total_balance_cost_rupee = 0;
        $total_balance_cost_dollar = 0;
        $total_balance_cost_null = 0;  $total_dn_qty=0;
        $tot_balance_cost_rupee = 0;
        $tot_balance_cost_dollar = 0;
        $tot_balance_cost_null = 0;  $tot_dn_qty=0;
        if($flag==0)
        {  $resulto = $newreport->getdeliverDetails4total($cond);
           while ($myrowto = mysql_fetch_row($resulto)) {

              $dnqty=$myrowto[6] ? $myrowto[6] : 0;
              $dliqty_recd=$myrowto[7] ? $myrowto[7] : 0;
              $dnliqty_rej=$myrowto[10] ? $myrowto[10] : 0;
              //echo"$dnliqty_rej//////<br>";
             // echo $dnqty."---------".$dliqty_recd."--------".$dnliqty_rej."<br>";
              $unret_qty = ($dnqty-$dliqty_recd);
              //echo ($dnqty-$dliqty_recd)."-----***<br>";
              //echo $myrow[6]."---------".$myrow[7]."--------".$myrow[10]."-----------".$unretured_qty."<br>";
            $result4rmprice4to = $newreport->getrate4crn($myrowto[3]);
            $myrow4rmpriceto = mysql_fetch_row($result4rmprice4to);

            $rmprice = $myrow4rmpriceto[0];
            $currency = $myrow4rmpriceto[1];
              $tot_balance_cost_dollar += ($unret_qty*$rmprice);
              //echo $total_balance_cost_dollar."---$---";

            //$tot_balance_cost = ($unretured_qty*$rmprice);
            $tot_dn_qty+=$unret_qty;

        }

          $flag=1;
        }
        $t_balance_cost_dollar =number_format ($tot_balance_cost_dollar,2 );
                 $t_dn_qty=number_format ($tot_dn_qty,2 );
       // echo "<tr><td colspan=11 align=\"right\"><span class=\"labeltext\">Total Qty: $t_dn_qty  <br>Total Cost($) : $ $t_balance_cost_dollar </td></tr>";


            while ($myrow = mysql_fetch_row($result)) {
              if($myrow[2] != '0000-00-00' && $myrow[2] != '' && $myrow[2] != 'NULL')
              {
                $datearr = split('-', $myrow[2]);
                $d=$datearr[2];
                $m=$datearr[1];
                $y=$datearr[0];
                $x=mktime(0,0,0,$m,$d,$y);
                $deliver_date=date("M j, Y",$x);
	          }
	      else
              {
                $deliver_date="";
	      }
              $dnqty=$myrow[6] ? $myrow[6] : 0;
              $dliqty_recd=$myrow[7] ? $myrow[7] : 0;
              $dnliqty_rej=$myrow[10] ? $myrow[10] : 0;
              //echo"$dnliqty_rej//////<br>";
             // echo $dnqty."---------".$dliqty_recd."--------".$dnliqty_rej."<br>";
              $unretured_qty = ($dnqty-$dliqty_recd);
              //echo ($dnqty-$dliqty_recd)."-----***<br>";
              //echo $myrow[6]."---------".$myrow[7]."--------".$myrow[10]."-----------".$unretured_qty."<br>";
            $result4rmprice = $newreport->getrate4crn($myrow[3]);
            $myrow4rmprice = mysql_fetch_row($result4rmprice);

            $rmprice = $myrow4rmprice[0];
            $currency = $myrow4rmprice[1];
              $total_balance_cost_dollar += ($unretured_qty*$rmprice);
              //echo $total_balance_cost_dollar."---$---";
            $total_balance_cost = ($unretured_qty*$rmprice);

   	       printf('<tr bgcolor="#FFFFFF">
                        <td><span class="tabletext">%s</td>
                        <td><span class="tabletext">%s</td>
                        <td><span class="tabletext">%s</td>
                        <td><span class="tabletext">%s</td>
                         <td><span class="tabletext">%s</td>
                        <td><span class="tabletext">%s</td>
                        <td align="center"><span class="tabletext">%s</td>
                        <td align="center"><span class="tabletext">%s</td>
                        <td align="center"><span class="tabletext">%.2f</td>
                        <td align="right"><span class="tabletext">%.2f</td>
                          ',
		                 $myrow[0],
                         $myrow[1],
                         $deliver_date,
                         $myrow[3],
                         $myrow[9],
                         $myrow[4],
                         $myrow[6],
                         $unretured_qty,
                         $rmprice,
                         $total_balance_cost);

                        $total_dn_qty+=$unretured_qty;

           printf('</td></tr>');

        }
        $prcst=number_format ($total_balance_cost_dollar,2 );

?>
<tr>
<td bgcolor="#FFFFFF" colspan=7 align="right"><span class="heading"><b>Total</b></td>
<?php

printf('<td bgcolor="#FFFFFF" colspan=1 align="center"><span class="tabletext">%.2f</td>',$dntotqty);
printf('<td bgcolor="#FFFFFF" colspan=1 align="right"><span class="tabletext">%s</td>','&nbsp;');
printf('<td bgcolor="#FFFFFF" colspan=1 align="right"><span class="tabletext">%s</td>',
number_format ($dntotcost));
?>
</td></tr>
</table>
<?
//}?>

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


								</td>
							</tr>

</table>
<?
//}?>
</FORM>
</body>
</html>

