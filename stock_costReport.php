<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = August 12, 2009              =
// Filename: crnreport.php                     =
// Copyright of Badari Mandyam, FluentSoft     =
// Revision: v1.0 WMS                          =
// Displays CRN Stock Summary list.            =
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
include_once('classes/stockClass.php');
include_once('classes/displayClass.php');

$newdisplay = new display;
$newreport = new stockreport;
$rowsPerPage = 10;
$crn=$_REQUEST['crn'];
$date1_match=$_REQUEST['fdate'];
$date2_match=$_REQUEST['tdate'];
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

$userrole = $_SESSION['userrole'];
//echo $date1_match."*-*--*-".$date2_match;

if ( isset ( $_REQUEST['sdate1'] ) || isset ( $_REQUEST['sdate2'] ) )
{
     $date1_match = $_REQUEST['sdate1'];
     $date2_match = $_REQUEST['sdate2'];
     if ( isset ( $_REQUEST['sdate1']) &&  $_REQUEST['sdate1'] != '' )
     {
          $date1 = $_REQUEST['sdate1'];
          $cond31 = "to_days(w.book_date) " . ">= to_days('" . $date1 . "')";
     }
     else
     {
          $cond31 = "(to_days(w.book_date)-to_days('1582-01-01') > 0 || w.book_date = 'NULL' || w.book_date = '0000-00-00')";
     }

     if ( isset ( $_REQUEST['sdate2'] )  &&  $_REQUEST['sdate2'] != '')
     {
          $date2 = $_REQUEST['sdate2'];
          $cond32 = "to_days(w.book_date) " . "<= to_days('" . $date2 . "')";
     }
     else
     {
          $cond32 = "(to_days(w.book_date)-to_days('2050-12-31') < 0 || w.book_date = 'NULL' || w.book_date = '0000-00-00')";
     }
     //$condwd = $cond31 . ' and ' . $cond32;
     $condwd =$cond32;

}
else
{
  if($date2_match=='')
  {
    $condwd = "(to_days(w.book_date)-to_days('1582-01-01') > 0 ||
                    w.book_date = '0000-00-00' ||
                    w.book_date = 'NULL' ) and
           (to_days(w.book_date)-to_days('2050-12-31') < 0 ||
                    w.book_date = '0000-00-00' ||
                    w.book_date = 'NULL')";
  }else
  {
  $cond31 = "to_days(w.book_date) " . ">= to_days('" . $date1_match . "')";
  $cond32 = "to_days(w.book_date) " . "<= to_days('" . $date2_match . "')";
  $condwd =$cond32;
  }
}

if ( isset ( $_REQUEST['sdate1'] ) || isset ( $_REQUEST['sdate2'] ) )
{
     $date1_match = $_REQUEST['sdate1'];
     $date2_match = $_REQUEST['sdate2'];
     if ( isset ( $_REQUEST['sdate1']) &&  $_REQUEST['sdate1'] != '' )
     {
          $date1 = $_REQUEST['sdate1'];
          $cond51 = "to_days(w.actual_ship_date) " . ">= to_days('" . $date1 . "')";
     }
     else
     {
          $cond51 = "(to_days(w.actual_ship_date)-to_days('1582-01-01') > 0 || w.actual_ship_date = 'NULL' || w.actual_ship_date = '0000-00-00')";
     }

     if ( isset ( $_REQUEST['sdate2'] )  &&  $_REQUEST['sdate2'] != '')
     {
          $date2 = $_REQUEST['sdate2'];
          $cond52 = "to_days(w.actual_ship_date) " . "<= to_days('" . $date2 . "')";
     }
     else
     {
          $cond52 = "(to_days(w.actual_ship_date)-to_days('2050-12-31') < 0 || w.actual_ship_date = 'NULL' || w.actual_ship_date = '0000-00-00')";
     }
     //$condwd = $cond31 . ' and ' . $cond32;
     $condwfd =$cond52;

}
else
{
  if($date2_match=='')
  {
    $condwfd = "(to_days(w.actual_ship_date)-to_days('1582-01-01') > 0 ||
                    w.actual_ship_date = '0000-00-00' ||
                    w.actual_ship_date = 'NULL' ) and
           (to_days(w.actual_ship_date)-to_days('2050-12-31') < 0 ||
                    w.actual_ship_date = '0000-00-00' ||
                    w.actual_ship_date = 'NULL')";
  }else
  {
  $cond31 = "to_days(w.actual_ship_date) " . ">= to_days('" . $date1_match . "')";
  $cond52 = "to_days(w.actual_ship_date) " . "<= to_days('" . $date2_match . "')";
  $condwfd =$cond52;
  }
}
if ( isset ( $_REQUEST['sdate1'] ) || isset ( $_REQUEST['sdate2'] ) )
{
     $ddate1_match = $_REQUEST['sdate1'];
     $ddate2_match = $_REQUEST['sdate2'];
     if ( isset ( $_REQUEST['sdate1']) &&  $_REQUEST['sdate1'] != '' )
     {
          $date1 = $_REQUEST['sdate1'];
          $cond21 = "to_days(d.deliver_date) " . ">= to_days('" . $date1 . "')";
     }
     else
     {
          $cond21 = "(to_days(d.deliver_date)-to_days('1582-01-01') > 0 || d.deliver_date = 'NULL' || d.deliver_date = '0000-00-00')";
     }

     if ( isset ( $_REQUEST['sdate2'] )  &&  $_REQUEST['sdate2'] != '')
     {
          $date2 = $_REQUEST['sdate2'];
          $cond22 = "to_days(d.deliver_date) " . "<= to_days('" . $date2 . "')";
     }
     else
     {
          $cond22 = "(to_days(d.deliver_date)-to_days('2050-12-31') < 0 || d.deliver_date = 'NULL' || d.deliver_date = '0000-00-00')";
     }
     $condelvd =$cond22;

}
else
{
 if($date2_match=='')
  {
   $condelvd ="(to_days(d.deliver_date)-to_days('1582-01-01') > 0 ||
                   d.deliver_date = '0000-00-00' ||
                    d.deliver_date = 'NULL' ) and
           (to_days(d.deliver_date)-to_days('2050-12-31') < 0 ||
                    d.deliver_date = '0000-00-00' ||
                    d.deliver_date = 'NULL')";
  }else
  {
  $cond21 = "to_days(d.deliver_date) " . ">= to_days('" . $date1_match . "')";
  $cond22 = "to_days(d.deliver_date) " . "<= to_days('" . $date2_match . "')";
  $condelvd =$cond22;
  }
}
if ( isset ( $_REQUEST['sdate1'] ) || isset ( $_REQUEST['sdate2'] ) )
{
     $ddate1_match = $_REQUEST['sdate1'];
     $ddate2_match = $_REQUEST['sdate2'];
     if ( isset ( $_REQUEST['sdate1']) &&  $_REQUEST['sdate1'] != '' )
     {
          $date1 = $_REQUEST['sdate1'];
          $cond11 = "to_days(d.disp_date) " . ">= to_days('" . $date1 . "')";
     }
     else
     {
          $cond11 = "(to_days(d.disp_date)-to_days('1582-01-01') > 0 || d.disp_date = 'NULL' || d.disp_date = '0000-00-00')";
     }

     if ( isset ( $_REQUEST['sdate2'] )  &&  $_REQUEST['sdate2'] != '')
     {
          $date2 = $_REQUEST['sdate2'];
          $cond12 = "to_days(d.disp_date) " . "<= to_days('" . $date2 . "')";
     }
     else
     {
          $cond12 = "(to_days(d.disp_date)-to_days('2050-12-31') < 0 || d.disp_date = 'NULL' || d.disp_date = '0000-00-00')";
     }
     $confd =$cond12;

}else
{   if($date2_match=='')
  {
   $confd ="(to_days(d.disp_date)-to_days('1582-01-01') > 0 ||
                   d.disp_date = '0000-00-00' ||
                    d.disp_date = 'NULL' ) and
           (to_days(d.disp_date)-to_days('2050-12-31') < 0 ||
                    d.disp_date = '0000-00-00' ||
                    d.disp_date = 'NULL')";
  }else
  {

    $cond11 = "to_days(d.disp_date) " . ">= to_days('" . $date1_match . "')";
  $cond12 = "to_days(d.disp_date) " . "<= to_days('" . $date2_match . "')";
  $confd =$cond12;
  }
}
if ( isset ( $_REQUEST['sdate1'] ) || isset ( $_REQUEST['sdate2'] ) )
{
     $sdate1_match = $_REQUEST['sdate1'];
     $sdate2_match = $_REQUEST['sdate2'];
     if ( isset ( $_REQUEST['sdate1']) &&  $_REQUEST['sdate1'] != '' )
     {
          $date1 = $_REQUEST['sdate1'];
          $cond41 = "to_days(g.recieved_date) " . ">= to_days('" . $date1 . "')";
     }
     else
     {
          $cond41 = "(to_days(g.recieved_date)-to_days('1582-01-01') > 0 || g.recieved_date = 'NULL' || g.recieved_date = '0000-00-00')";
     }

     if ( isset ( $_REQUEST['sdate2'] )  &&  $_REQUEST['sdate2'] != '')
     {
          $date2 = $_REQUEST['sdate2'];
          $cond42 = "to_days(g.recieved_date) " . "<= to_days('" . $date2 . "')";
     }
     else
     {
          $cond42 = "(to_days(g.recieved_date)-to_days('2050-12-31') < 0 || g.recieved_date = 'NULL' || g.recieved_date = '0000-00-00')";
     }
     $congrnd =$cond42;

}
else{
  if($date2_match=='')
  {
  $congrnd ="(to_days(g.recieved_date)-to_days('1582-01-01') > 0 ||
                   g.recieved_date = '0000-00-00' ||
                    g.recieved_date = 'NULL' ) and
           (to_days(g.recieved_date)-to_days('2050-12-31') < 0 ||
                    g.recieved_date = '0000-00-00' ||
                    g.recieved_date = 'NULL')";
  }else
  {
    $cond41 = "to_days(g.recieved_date) " . ">= to_days('" . $date1_match . "')";
  $cond42 = "to_days(g.recieved_date) " . "<= to_days('" . $date2_match . "')";
  $congrnd =$cond42;
}
}
?>
<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/report.js"></script>
<html>
<head>
<title>PRN Stock Report</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">

<form action='stock_costReport.php' method='post' enctype='multipart/form-data'>
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
</table>
<table width=100% border=0 cellpadding=0 cellspacing=0  >
  <tr bgcolor="DEDFDE"><td width="6"><img src="images/spacer.gif " width="6"></td>
	    <td bgcolor="#FFFFFF">
 <table width=100% border=0 cellpadding=6 cellspacing=0  >
     <tr><td>
		</tr>
  <tr>
<td>
</td></tr>
<tr><td>

<table width="100%" border=0>
<tr>
<td><span class="pageheading"><b>PRN Report</b></td>
<td colspan=160>&nbsp;</td>
</tr>
</table>

<table width="100%" align="center" border=0 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF">
<tr bgcolor="#F5F6F5">
<td align="center" colspan=8><span class="heading"><b>Search Criteria</b></td></tr>
<tr>
<td bgcolor="#FFFFFF"><span class="tabletext"><b>PRN:</b>&nbsp;
<input type="text" size=15% name="crn" value="<?echo $_REQUEST['crn'] ?>">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
         <span class="labeltext"><b>&nbsp;&nbsp;&nbsp;Date:&nbsp;</b>
        <input type="text" name="sdate2" size=10 value="<?php echo $date2_match ?>"
         onkeypress="javascript: return checkenter(event)">
        <img src="images/bu-getdateicon.gif" alt="Get Date" onclick='GetDate("sdate2")'>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="button"><b><input type="submit" name="submit" value="Get"></b></td>
<td bgcolor="#FFFFFF" align='center' width='50%'><span class="pageheading"><b>
</td>
</tr>

</table>

<table width="900px" border=0 cellpadding=3 cellspacing=1 bgcolor="#FFFFFF">
<tr bgcolor="#FFFFFF">
<td valign='top'>
<?php
//echo $date2_match."-----";
if($date2_match!=''||$crn !='')
{
?>


<?php

$total=0;
$total4dis=0;
$total4grn=0;
$totalbalance=0;
$total4grnboi=0;
$totalbalance4boi=0;
$totaldn_qty=0;
$total_recd4stores=0;
$total_wip=0;
$total_wiptr=0;
$totaldnrecd=0;
$totaldnsent=0;
$totaldnacc=0;
$totalfg1=0;
$total_fg_qty=0;
$total_disp=0;

$total_cost1_dol=0;
$total_cost1_re=0;
$total_cost1_others=0;
$total_cost2_dol=0;
$total_cost2_re=0;
$total_cost2_others=0;
$total_cost3_dol=0;
$total_cost3_re=0;
$total_cost3_others=0;
$total_cost4_dol=0;
$total_cost4_re=0;
$total_cost4_others=0;
$total_costdn_dol=0;
$total_costdn_re=0;
$total_costdn_others=0;
$total_costdns_dol=0;
$total_costdns_re=0;
$total_costdns_others=0;
$total_quantity=0;
$total_cost_dollar=0;
$total_cost_ru=0;
$total_cost_other=0;

$woprocarr = array("Manufacture Only","With Treatment");
$dnSent_qty=0;
$dnRecd_qty=0;
$dn_recd4stores=0;


//WIP
$resultwip=$newreport->getallwoqty4open($date2_match,$crn);
//$resultwip=$newreport->getoperdetails4wip($crn,$date2_match);

//while($myresultwip=mysql_fetch_row($resultwip))
$myresultwip=mysql_fetch_row($resultwip);
//{
  // echo $myresultwip[0]."-----------<br>";
  $total_wip = $myresultwip[0];
  $costtemp= $myresultwip[1];
  $total_dnsent= $myresultwip[2];
  //$crncost= $myresultwip[3];
  //echo $rm_curr."-----------<br>";
//}

$resulttrwip=$newreport->getdnqty4wo($date2_match,$crn);
$myresultdn=mysql_fetch_row($resulttrwip);
//while($myresultdn=mysql_fetch_row($resulttrwip))
//{
  $total_wiptr += $myresultdn[0];
  $totaldnacc += $myresultdn[1];
  $totaldnrecdcost += $myresultdn[2];
  $totaldnacccost += $myresultdn[3];

//  echo "rm price is $crncost-----------<br>";
//}
//echo $total_wip."-------".$total_wiptr."----------".$total_dnsent;
//-$totaldnrecdcost
$total1 = $total_wip-$total_wiptr;
$total= $total_wip;
$cost1=$costtemp;
//echo $total."----w----o----";



//=========DN
$resultdnqty=$newreport->getdn_qty($date2_match,$crn);
$myresultdnqty=mysql_fetch_row($resultdnqty);
$dnqtytot=$myresultdnqty[0];
$dntotcost=$myresultdnqty[1];
//echo "<br>dn qty is $dnqtytot <br>";
//echo "<br>dn cost is $dntotcost <br>";
$resultdnliqty=$newreport->getdnli_qty($date2_match,$crn);
$myresultdnliqty=mysql_fetch_row($resultdnliqty);
$dnliqtytot=$myresultdnliqty[0];
$dnliqtycost=$myresultdnliqty[1];
$totaldnacc= $myresultdnliqty[2];
//echo "<br>dn li qty is $dnliqtytot <br>";
//echo "<br>dn li cost is $dnliqtycost <br>";
$totaldn_qty =$dnqtytot-$dnliqtytot;
$costdn=$dntotcost-$dnliqtycost;
//echo $totaldnrecd."-----------$totaldnsent--------$totaldn_qty<br>";
//==========



//FG
$resultfgqty1=$newreport->getcqty4closedwo($date2_match,$crn);
$myresultfgqty1=mysql_fetch_row($resultfgqty1);
//while($myresultfgqty1=mysql_fetch_row($resultfgqty1))
//{
  $totalfg1=$myresultfgqty1[0];
  $costfg1 = $myresultfgqty1[1];
//}
//$total_fg_qty=$totalfg1;
//$costfgtemp=$costfg1;
//echo "<br>Total FG qty = $totalfg1 <br>";
$resultdispqty=$newreport->getdispqtydetails($date2_match,$crn);
$myresultdispqty=mysql_fetch_row($resultdispqty);
//while($myresultdispqty=mysql_fetch_row($resultdispqty))
//{
  $total_disp=$myresultdispqty[0];
  $costfg2=$myresultdispqty[1];
//}
//echo "<br>Disp qty = $total_disp <br>";
//echo "<br>Comp qty cost is $costfg1";
//echo "<br>Disp cost is $costfg2";
$cost2=$costfg1-$costfg2;
$total4dis = $totalfg1-$total_disp;
//echo $total4dis."-----------".$total_fg_qty."---------".$total_disp;


//GRN
$costgrn3=0;$costgrn2=0;$costgrn1=0;
$resultwoqtygrn=$newreport->getwoqty4grn($date2_match,$crn);
$myrowwoqtygrn=mysql_fetch_row($resultwoqtygrn) ;
//while($myrowwoqtygrn=mysql_fetch_row($resultwoqtygrn))
//{
  $woqty = $myrowwoqtygrn[0];
  $costgrn1 = $myrowwoqtygrn[1];
//}

//echo $woqty."---1--".$costgrn1."<br>";
$resultgrnqty=$newreport->getallGRN4Details($date2_match,$crn);
$grnarra2=array();
$myrowgrnqty=mysql_fetch_row($resultgrnqty);
//while($myrowgrnqty=mysql_fetch_row($resultgrnqty))
//{
  $grnqty = $myrowgrnqty[0];
  $costgrn2 = $myrowgrnqty[1];
//}

//echo $grnqty."--2---".$costgrn2."<br>";

$resultworetqty=$newreport->get_woretqty($date2_match,$crn);
$myrowworetqty=mysql_fetch_row($resultworetqty);
//while($myrowworetqty=mysql_fetch_row($resultworetqty))
//{
  $woretqty += $myrowworetqty[0];
  $costgrn3 += $myrowworetqty[1];
//}
//echo $woretqty."--3---".$costgrn3."<br>";
$cost3=$costgrn2-$costgrn1+  $costgrn3;
//echo $cost3."------4";
$total4grn= $grnqty-$woqty+ $woretqty;

//echo $costgrn2."-------".$costgrn1."----------".$costgrn3."<br>";


//Price
// Currency has been hardcoded to US dollar because RM price
// is maintained in $.
        $rm_curr = '$';
        if($rm_curr == '$')
		{
			$total_cost1_dol = $cost1;
		}
		else if($rm_curr == 'RS'|| $rm_curr == 'Rs')
		{
			$total_cost1_re = $cost1;
		}
		else
		{
            $total_cost1_others =  $cost1;
		}

        //$costdn=$totaldn_qty*$rmprice;
		if($rm_curr == '$')
       {
       $total_costdn_dol = $costdn;
       }
       else if($rm_curr == 'RS'|| $myrow4c1[1] == 'Rs')
       {
       $total_costdn_re =  $costdn;
       }
       else
       {
       $total_costdn_others = $costdn;
       }

       // $cost2=($total4dis*$rmprice);
        //echo$cost2."****".$rm_curr;
       if($rm_curr == '$')
       {
       $total_cost2_dol = $cost2;
       //echo"h---$total_cost2_dol";
       }
       else if($rm_curr == 'RS'|| $rm_curr == 'Rs')
       {
       $total_cost2_re = $cost2;
        //echo"R---$total_cost2_re";
       }
       else
       {
       $total_cost2_others = $cost2;
       //echo"O---$total_cost2_others";
       }

       if($rm_curr == '$')
	   {
			$total_cost3_dol = $cost3;
	   }
	   else if($rm_curr == 'RS'|| $rm_curr == 'Rs')
	   {
			$total_cost3_re = $cost3;
	   }
	   else
	   {
			$total_cost3_others = $cost3;
	   }
$total_quantity=  $total+ $totaldn_qty+ $total4dis+ $total4grn;
$total_cost_dollar=$total_cost1_dol+$total_costdn_dol+$total_cost2_dol+$total_cost3_dol;
$total_cost_ru=$total_cost1_re+$total_costdn_re+$total_cost2_re+$total_cost3_re;
$total_cost_other=$total_cost1_others+$total_costdn_others+$total_cost2_others+$total_cost3_others;
?>
<table style="table-layout: fixed" width="600px" style="border:1px solid #000000;" border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
<tr bgcolor="#FFCC00">
<td width="130px" bgcolor="#00FFFF"><span class="tabletext" align='center'><b>&nbsp;</b></a></td>
<td align="center" width="130px" bgcolor="#00FFFF"><span class="tabletext" align='center'><b>Qty</b></a></td>
<td align="center" width="130px" bgcolor="#00FFFF"><span class="tabletext"><b>Value($)</b></td>
</tr>
<tr bgcolor="#FFCC00">
<td width="130px" bgcolor="#EEEFEE"><span class="tabletext" align='center'>
<a href="auditwipreport.php?crn=<?php echo $_REQUEST['crn']?>&fdate=<?php echo $date1_match ?>&tdate=<?php echo $date2_match ?>"><b>WO Qty(WIP)</b></a></td>
<td align="center" width="130px" bgcolor="#FFFFFF"><span class="tabletext"><b><?php echo $total ?></b></td>
<td align="right" bgcolor="#FFFFFF"><span class="tabletext"><b>
     <?php print(number_format($total_cost1_dol)) ?></b></td>
	</tr>
<tr bgcolor="#FFCC00">
<td width="130px" bgcolor="#EEEFEE"><span class="tabletext" align='center'>
<a href="auditdnreport.php?crn=<?php echo $_REQUEST['crn']?>&dntotqty=<?php echo $totaldn_qty?>&dntotcost=<?php print $total_costdn_dol?>&fdate=<?php echo $date1_match ?>&tdate=<?php echo $date2_match ?>"><b>DN Bal</b></a></td>
<td align="center" width="130px" bgcolor="#FFFFFF"><span class="tabletext"><b><?php echo $totaldn_qty ?></b></td>
<td align="right"  bgcolor="#FFFFFF"><span class="tabletext"><b>
     <?php print(number_format($total_costdn_dol)) ?></b></td>
</tr>
<tr bgcolor="#FFCC00">
<td width="130px" bgcolor="#EEEFEE"><span class="tabletext" align='center'>
<a href="auditfgreport.php?crn=<?php echo $_REQUEST['crn']?>&fgtotqty=<?php echo $total4dis ?>&fgtotcost=<?php print $total_cost2_dol?>&fdate=<?php echo $date1_match ?>&tdate=<?php echo $date2_match ?>"><b>FG Stock</b></a></td>
<td align="center" width="130px" bgcolor="#FFFFFF"><span class="tabletext"><b><?php echo $total4dis ?></b></td>
<td align="right"  bgcolor="#FFFFFF"><span class="tabletext"><b><?php 
	print(number_format($total_cost2_dol)) ?></b></td>
</tr>
<tr bgcolor="#FFCC00">
<td width="130px" bgcolor="#EEEFEE"><span class="tabletext" align='center'>
<a href="auditgrnstockreport.php?crn=<?php echo $_REQUEST['crn']?>&grnqty=<?php echo $total4grn?>&grncost=<?php print $total_cost3_dol ?>&fdate=<?php echo $date1_match ?>&tdate=<?php echo $date2_match ?>"><b>GRN Stock</b></a></td>
<td align="center" width="130px" bgcolor="#FFFFFF"><span class="tabletext"><b><?php echo $total4grn ?></b></td>
<td align="right"  bgcolor="#FFFFFF"><span class="tabletext"><b><?php 
	print(number_format($total_cost3_dol)) ?></b></td>
</tr>
<tr bgcolor="#FFCC00">
<td bgcolor="#EEEFEE"><span class="tabletext" align='center'>
<b>&nbsp;</b></td>
<td  colspan=2 bgcolor="#FFFFFF"><span class="tabletext" align='center'>
<b>&nbsp;</b></td>
</tr>
<tr bgcolor="#FFCC00">
<td width="130px" bgcolor="#EEEFEE"><span class="tabletext" align='center'>
<b>Total </b></td>
<td align="center" width="130px" bgcolor="#FFFFFF"><span class="tabletext"><b><?php echo $total_quantity ?></b></td>
<td align="right"  bgcolor="#FFFFFF"><span class="tabletext"><b><?php 
	print(number_format($total_cost_dollar)) ?></b></td>
</tr>
</table>
<input type='hidden' name='crn_num' value='<?echo $crn?>'>
<?php
}
?>
</td>

<br>
</br>
<td valign='top'>
<table width="200px"  border=0 cellpadding=3 cellspacing=1 bgcolor="#FFFFFF" >
<tr  bgcolor="#FFFFFF">
<td>
<div id='cust'>
</td>
<tr>
</table>
</td></tr>
</table>
</td></tr>
</table>
<input type='hidden' name='crn_num' value='<?echo $crn?>'>
<td width="6"><img src="images/spacer.gif " width="6"></td>
</tr>
<tr bgcolor="DEDFDE">
<td width="6"><img src="images/box-left-bottom.gif"></td>
<td><img src="images/spacer.gif " height="6"></td>
<td width="6"><img src="images/box-right-bottom.gif"></td>
</tr>
</table>
</table>
</table>
</table>
</FORM>
</body>
</html>
