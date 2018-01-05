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
include_once('classes/reportClass.php');
include_once('classes/displayClass.php');

$newdisplay = new display;
$newreport = new report;
$rowsPerPage = 10;
$crn=$_REQUEST['crn'];
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
$crn_exp='';
// counting the offset
$offset = ($pageNum - 1) * $rowsPerPage;

$userrole = $_SESSION['userrole'];

$condwd = "(to_days(w.book_date)-to_days('1582-01-01') > 0 ||
                    w.book_date = '0000-00-00' ||
                    w.book_date = 'NULL' ) and
           (to_days(w.book_date)-to_days('2050-12-31') < 0 ||
                    w.book_date = '0000-00-00' ||
                    w.book_date = 'NULL')";
$confd ="(to_days(d.disp_date)-to_days('1582-01-01') > 0 ||
                   d.disp_date = '0000-00-00' ||
                    d.disp_date = 'NULL' ) and
           (to_days(d.disp_date)-to_days('2050-12-31') < 0 ||
                    d.disp_date = '0000-00-00' ||
                    d.disp_date = 'NULL')";
$condelvd ="(to_days(d.deliver_date)-to_days('1582-01-01') > 0 ||
                   d.deliver_date = '0000-00-00' ||
                    d.deliver_date = 'NULL' ) and
           (to_days(d.deliver_date)-to_days('2050-12-31') < 0 ||
                    d.deliver_date = '0000-00-00' ||
                    d.deliver_date = 'NULL')";
$congrnd ="(to_days(g.recieved_date)-to_days('1582-01-01') > 0 ||
                   g.recieved_date = '0000-00-00' ||
                    g.recieved_date = 'NULL' ) and
           (to_days(g.recieved_date)-to_days('2050-12-31') < 0 ||
                    g.recieved_date = '0000-00-00' ||
                    g.recieved_date = 'NULL')";
?>
<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/report.js"></script>
<html>
<head>
<title>CRN Stock Report</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">

<form action='crnonelinereport.php' method='post' enctype='multipart/form-data'>
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
<table width=100% border=0 cellpadding=0 cellspacing=0>
  <tr bgcolor="DEDFDE"><td width="6"><img src="images/spacer.gif " width="6"></td>
	    <td bgcolor="#FFFFFF">
 <table width=100% border=0 cellpadding=6 cellspacing=0>
     <tr><td>
		</tr>
  <tr>
<td>
</td></tr>
<tr><td valign="top">

<table valign="top" width="100%" border=0>
<tr>
<td valign='top'><span class="pageheading"><b>PRN Report</b></td>
<td colspan=160>&nbsp;</td>
</tr>
</table>

<table valign="top" width="100%" align="center" border=0 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF">
<tr bgcolor="#F5F6F5">
<td align="center" colspan=7><span class="heading"><b>Search Criteria</b></td></tr>
<tr>
<td valign='top' bgcolor="#FFFFFF"><span class="tabletext"><b>PRN:</b>&nbsp;
<input type="text" size=15% name="crn" value="<?echo $_REQUEST['crn'] ?>">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="button"><b><input type="submit" name="submit" value="Get"></b></td>
</tr>
</table>

<table valign="top" width="100%" border=0 cellpadding=3 cellspacing=1 bgcolor="#FFFFFF">
<tr bgcolor="#FFFFFF">
<td valign='top'>
<?php
if($crn!='')
{
?>
<table align="top" style="table-layout: fixed" width="750px" border=0 cellpadding=3 cellspacing=1 bgcolor="#FFFFFF">
<tr bgcolor="#FFFFFF">
    <td><span class="tabletext">
                          <a href="crnstock_xls.php?crn=<?php echo $crn ?>">Export To Excel</td>
</tr>
</table>
<table align="top" style="table-layout: fixed" width="750px" style="border:1px solid #000000;" border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
<tr bgcolor="#FFCC00">
<td width="55px" bgcolor="#EEEFEE"><span class="tabletext" align='center'><b>PRN</b></td>
<td width="175px" bgcolor="#EEEFEE"><span class="tabletext" align='center'><b>Part Number&nbsp;</b></td>
<!--<td width="102px" bgcolor="#EEEFEE"><span class="tabletext" align='center'><b>WO Process</b></td>-->
<td width="44px" bgcolor="#EEEFEE"><span class="tabletext" align='center'><b>WIP</b></td>
<td width="40px" bgcolor="#EEEFEE"><span class="tabletext" align='center'><b>DN<br>Bal</b></td>
<td width="50px" bgcolor="#EEEFEE"><span class="tabletext" align='center'><b>DN<br>(Stores)</b></td>
<td width="40px" bgcolor="#EEEFEE"><span class="tabletext" align='center'><b>FG<br>Stock</b></td>
<td width="40px" bgcolor="#EEEFEE"><span class="tabletext" align='center'><b>GRN<br>Stock</b></td>
<td width="40px" bgcolor="#EEEFEE"><span class="tabletext" align='center'><b>GRN<br>Stock<br>(Quar)</b></td>
<td width="80px" bgcolor="#EEEFEE"><span class="tabletext" align='center'><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;RMPO<br>&nbsp;&nbsp;&nbsp;(po#/qty/<br>&nbsp;&nbsp;&nbsp;&nbsp;Duedate)</b></td>
<!--<td width="40px" bgcolor="#EEEFEE"><span class="tabletext" align='center'><b>Export</b></td> -->
</tr>
</table>

<!--<div style="width:770px; height:200; overflow:auto;border:" id="dataList"> -->

<table width="750px" style="border:1px solid #000000;" border=1 cellpadding=3 cellspacing=1 bgcolor="#FFFFFF">
<!--<tr bgcolor="#FFFFFF">
<td valign='top'>-->
<?php
$cond='';
if($crn!='')
{
$cond='and w.crn_num like '."'".$crn."%'";
$cond1='where w.crn_num like '."'".$crn."%'".$cond;
}
else
{
$cond='';
$cond1=''.$cond;
}
$woprocarr = array("Assembly","Manufacture Only","With Treatment");
$result = $newreport->getstock4crnnew($cond1,$crn,$woprocarr);
$total1=0;
$total4dis1=0;
$total4grn1=0;
$totalgrn_quar1=0;
$totalbalance1=0;
$totalbalance_quar1=0;
$totaldn_qty1=0;
$totalrecd_qty1=0;
$totalrmpoqty1=0;
$total_recd4stores1=0;
$total=0;
$total4dis=0;
$total4grn=0;
$totalgrn_quar=0;
$totalbalance=0;
$totalbalance_quar=0;
$totaldn_qty=0;
$totalrecd_qty=0;
$totalrmpoqty=0;
$total_recd4stores=0;
$ft = 1;
$fg=0;
$wip = 0;
$dnbalst = 0;$procarray = array();
$crnarray = array($procarray);
$rmpoarray = array();

while($myrow4crn=mysql_fetch_row($result))
{
 $dnSent_qty=0;
 $dnRecd_qty=0;
 $proc = $myrow4crn[1];

 $dn_recd4stores=0;
  if ($ft == 1)
	  {
	       $prevcrndb = $myrow4crn[0];
	  }
	  if ($ft != 1 && $prevcrndb != $myrow4crn[0])
	  {
	       $procarray = array();
               $prevcrndb = $myrow4crn[0];			  
               $fg_close = 0;
	  }
 //$crn_exp=$myrow4crn[1];
 $wip = $myrow4crn[6];
 $dnbal = $myrow4crn[4];
 //$part_num=$myrow4crn[3];
 $cond = $myrow4crn[7];
 $fg = $myrow4crn[5];
         if($cond == 'Closed')
         {
           $procarray[$proc][2] = $fg;        
           $total4dis += $fg;
           $fg_close= $fg;	
		   $total=0;
         }
         else
	     {			
          if($fg!=0)
          {     
			$procarray[$proc][2] = $fg+$fg_close;
           $total4dis +=$myrow4crn[5];
          }
          if($fg==0)
          {
			  $dnbal_st=0;
           $dnbal_st = $myrow4crn[8] - $myrow4crn[2];
		   }		
          $procarray[$proc][0] = $wip;		 
		  $procarray[$proc][1] = $dnbal;
		  $procarray[$proc][3] = $dnbal_st;		 
		  $total = $wip;	
		  $total1 +=$total;
		  $totaldn_qty += $dnbal;		
		  $total_recd4stores +=  $dnbal_st;		
	   } 
	    $crnarray[$prevcrndb]=$procarray;		
		 $ft = 0;
}
$result = $newreport->getgrnqty4crnnew($crn);
while($mygrn=mysql_fetch_row($result))
{
      $crndb = $mygrn[3];
      $grnqtm=$mygrn[0];
      $grnqtyused = $mygrn[1];
      $qty_ret=  $mygrn[4];
      $grnquar = $mygrn[2];
     // echo $grnquar."-**---";
	  $grnbal = $grnqtm - $grnqtyused+$qty_ret;
	  $grnarray[$crndb][0] = $grnbal;
	  $grnarray[$crndb][1] = $grnquar;
	  $total4grn += $grnbal;
	  $totalgrn_quar += $grnquar;
}
$result = $newreport->getallCRN4report($cond1,$crn);
while($myrow4crn=mysql_fetch_row($result))
{
$part_num=wordwrap($myrow4crn[3],25,"<br>\n");
$result4rmpo=$newreport->get_rmpotqty($myrow4crn[1]);
$myrmpo=mysql_fetch_row($result4rmpo);
$rmpoqty=$myrmpo[5];
$crninp = $myrow4crn[1];
$totalrmpoqty += $rmpoqty;
$wip1=0;
$dn1=0;
$fg1=0;
$dnst1=0;
foreach ($woprocarr as $proc)
{
   $wip = $crnarray[$crninp][$proc][0];
   $wip1 += $wip; 
   
   $dn = $crnarray[$crninp][$proc][1];
   $dn1 += $dn;
  
   $dnst = $crnarray[$crninp][$proc][3];
   $dnst1 += $dnst;
   //echo '--------'.$dnst1.'----<br>';
   $fg = $crnarray[$crninp][$proc][2];
   $fg1 += $fg ;	
}
   $grnstock = $grnarray[$crninp][0];
   $grnstockquar = $grnarray[$crninp][1];

 printf('<tr bgcolor="#FFFFFF">
        <td width="55px"><span class="tabletext"><a href="javascript:ShowDetails(\'%s\')"><span class="tabletext"><font color="red">%s</td>
		<td align="center" width="175px"><span class="tabletext">%s</td>
        <td align="center" width="44px"><span class="tabletext">%d</td>
        <td align="center" width="40px"><span class="tabletext">%d</td>
	    <td align="center" width="40px"><span class="tabletext">%d</td>
	    <td align="center" width="50px"><span class="tabletext">%d</td>
        <td align="center" width="40px"><span class="tabletext">%d</td>
        <td align="center" width="40px"><span class="tabletext">%d</td>
        <td align="center" width="80px"><span class="tabletext">%s</tr>',
        $myrow4crn[1],$myrow4crn[1],$part_num,$wip1,$dn1,$dnst1,$fg1.'---',$grnstock,$grnstockquar,$rmpoqty);
}
?>
</table>
<table style="table-layout: fixed" width="750px" style="border:1px solid #000000;"  border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
<?
		printf('<tr bgcolor="#F5F6F5">
        <td width="55px"><span class="tabletext"><b>%s</b></td>		
		<td align="center" width="175px"><span class="tabletext"><b>%s</b></td>
        <td align="center" width="44px"><span class="tabletext"><b>%d</b></td>
         <td align="center" width="40px"><span class="tabletext"><b>%d</b></td>
	     <td align="center" width="40px"><span class="tabletext"><b>%d</b></td>
	    <td align="center" width="50px"><span class="tabletext"><b>%d</b></td>
        <td align="center" width="40px"><span class="tabletext"><b>%d</b></td>
        <td align="center" width="40px"><span class="tabletext"><b>%d</b></td>
        <td align="center" width="80px"><span class="tabletext"><b>%d</b></td></tr>',
        'Total','&nbsp;',
        $total1,
        $totaldn_qty,
        $total_recd4stores,
        $total4dis,
        $total4grn,
        $totalgrn_quar,
        $totalrmpoqty);

?>
</tr>
</table>
<?php
}
?>
</td>
<br>
<td valign='top'>
<table width="200px"  border=0 cellpadding=3 cellspacing=1 bgcolor="#FFFFFF" >
<tr  bgcolor="#FFFFFF">
<td valign='top'>
<div id='cust'>
</td>
<tr>
</table>
</td></tr>
</table>
</td></tr>
</table>


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
