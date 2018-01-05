<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = March 15,2005                =
// Filename: product_performace.php            =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OWT                          =
// Product Performance                         =
//==============================================


   session_start();
   header("Cache-control: private");
   //header ("Content-type: image/png");
   if ( !isset ( $_SESSION['user'] ) )
   {
        header ( "Location: login.php" );
   }
   $userid = $_SESSION['user'];
   $_SESSION['pagename'] = 'reports';
   $page = "Reports";
   ////sessio_register('pagename');

//$cond0 = "w.actual_ship_date like %";

$cond1 = "c.name like '%'";
$cond2 = "w.wonum like '%'";
$cond3 = "(to_days(w.actual_ship_date)-to_days('1582-01-01') > 0 ||
                    w.actual_ship_date = '0000-00-00' ||
                    w.actual_ship_date = 'NULL' ) and
           (to_days(w.actual_ship_date)-to_days('2050-12-31') < 0 ||
                    w.actual_ship_date = '0000-00-00' ||
                    w.actual_ship_date = 'NULL')";
$cond4 = "w.wotype like '%'";
$cond5 = "crn.CIM_refnum = '%'";
#$cond =  $cond1 . ' and ' . $cond2 . ' and ' . $cond3 . ' and ' . $cond4;

$worec='';
$oper1='like';
$oper2='like';
$oper3='like';
$sort1='wo';
$sort2='crn';
$sess=session_id();
//if ( isset ( $_REQUEST['status_val'] ) )
//{

//     $sval = $_REQUEST['status_val'];
//     if ($sval == 'All')
//     {
//         $cond0 = "w.condition like " . "'%'";
//     }
//     else if ($sval == 'Open')
//     {
//         $cond0 = "(w.condition = '" . $sval . "' && (w.actual_ship_date is NULL || w.actual_ship_date = '0000-00-00' || w.actual_ship_date = ''))" ;
//     }
//     else if ($sval == 'Closed')
//     {
//         $cond0 = "(w.condition = '" . $sval . "' || (w.actual_ship_date is not NULL && w.actual_ship_date != '0000-00-00' && w.actual_ship_date != ''))" ;
//     }
//     else
//     {
//         $cond0 = "w.condition = '" . $sval . "'";
//     }
//}
//else
//{
//     $sval = 'Open';
//         $cond0 = "(w.condition = '" . $sval . "' && (w.actual_ship_date is NULL || w.actual_ship_date = '0000-00-00' || w.actual_ship_date = ''))" ;
//}

if ( isset ( $_REQUEST['scomp'] ) )
{
     $company_match = $_REQUEST['scomp'];
     if ( isset ( $_REQUEST['company_oper'] ) ) {
          $oper1 = $_REQUEST['company_oper'];
     }
     else {
         $oper1 = 'like';
     }
     if ($oper1 == 'like') {
         $scomp = "'" . $_REQUEST['scomp'] . "%" . "'";
     }
     else {
         $scomp = "'" . $_REQUEST['scomp'] . "'";
     }

     $cond1 = "c.name " . $oper1 . " " . $scomp;

}
else {
     $company_match = '';
}

if ( isset ( $_REQUEST['swonum'] ) )
{
     $wonum_match = $_REQUEST['swonum'];
     if ( isset ( $_REQUEST['wonum_oper'] ) ) {
          $oper2 = $_REQUEST['wonum_oper'];
     }
     else {
         $oper2 = 'like';
     }
     if ($oper2 == 'like') {
         $swonum = "'" . $_REQUEST['swonum'] . "%" . "'";
     }
     else {
         $swonum = "'" . $_REQUEST['swonum'] . "'";
     }

     $cond2 = "w.wonum " . $oper2 . " " . $swonum;

}
else {
     $wonum_match = '';
}
if ( isset ( $_REQUEST['crn'] ) )
{
     $crn_match = $_REQUEST['crn'];
     if ( isset ( $_REQUEST['crn_oper'] ) ) {
          $oper3 = $_REQUEST['crn_oper'];
     }
     else {
         $oper3 = 'like';
     }
     if ($oper3 == 'like') {
         $crn = "'" . $_REQUEST['crn'] . "%" . "'";
     }
     else {
         $crn = "'" . $_REQUEST['crn'] . "'";
     }

     $cond5 = "crn.CIM_refnum " . $oper3 . " " . $crn;

}
else {
     $crn_match = '';
}
if ( isset ( $_REQUEST['sdate1'] ) || isset ( $_REQUEST['sdate2'] ) )
{
     $date1_match = $_REQUEST['sdate1'];
     $date2_match = $_REQUEST['sdate2'];
     if ( isset ( $_REQUEST['sdate1']) &&  $_REQUEST['sdate1'] != '' )
     {
          $date1 = $_REQUEST['sdate1'];
          $cond31 = "to_days(w.actual_ship_date) " . "> to_days('" . $date1 . "')";
     }
     else
     {
          $cond31 = "(to_days(w.actual_ship_date)-to_days('1582-01-01') > 0 || w.actual_ship_date = 'NULL' || w.actual_ship_date = '0000-00-00')";
     }

     if ( isset ( $_REQUEST['sdate2'] )  &&  $_REQUEST['sdate2'] != '')
     {
          $date2 = $_REQUEST['sdate2'];
          $cond32 = "to_days(w.actual_ship_date) " . "< to_days('" . $date2 . "')";
     }
     else
     {
          $cond32 = "(to_days(w.actual_ship_date)-to_days('2050-12-31') < 0 || w.actual_ship_date = 'NULL' || w.actual_ship_date = '0000-00-00')";
     }
     $cond3 = $cond31 . ' and ' . $cond32;

}
else
{
     $date1_match = '';
     $date2_match = '';
}
if ( isset ( $_REQUEST['sortfld1'] ) ) {
    $sort1 = $_REQUEST['sortfld1'];
}
if ( isset ( $_REQUEST['sortfld2'] ) ) {
    $sort2 = $_REQUEST['sortfld2'];
}

$cond1 = "c.name like '%'";
$cond = $cond1 . ' and ' . $cond2 . ' and ' . $cond3 . ' and ' . $cond4 . ' and ' . $cond5;


   // First include the class definition
   include('classes/reportClass.php');
   include_once('classes/displayClass.php');
   $newdisplay = new display;
   $newreport = new report;

   $newlogin = new userlogin;
   $newlogin->dbconnect();

?>
<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/report.js"></script>

<html>
<head>
<title>Prodn Performance</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">
<?php
     include('header.html');
?>
<form action='product_performance.php' method='post' enctype='multipart/form-data'>
<!-- <table width=100% cellspacing="0" cellpadding="6" border="0">
  <tr>
    <td>
      <table width=100% border=0 cellspacing="0" cellpadding="0">
        <tr>
          <td colspan=2><span class="welcome"><b>Welcome <?php echo $userid?></b></td>
          <td align="right">&nbsp;<a href="exit.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image16','','images/logout_mo.gif',1)"><img name="Image16" border="0" src="images/logout.gif"></a></td>
        </tr>
      </table>
      <table width=100% border=0 cellpadding=0 cellspacing=0  >
      <tr>
        <td></td>
      </tr>
      <tr>
        <td>
        <?php $newdisplay ->dispLinks(''); ?>
        </td></tr>
      </table>
      <table width=100% border=0 cellpadding=0 cellspacing=0  >
        <tr bgcolor="DEDFDE">
          <td width="6"><img src="images/spacer.gif " width="6"></td>
          <td bgcolor="#FFFFFF">
      <table width=100% border=0 cellpadding=6 cellspacing=0  >
          <tr>
	           <td>
          </tr>
          <tr>
            <td></td>
          </tr>
        <tr><td valign="top"> -->
          <table width=100% border=0 >
            <tr>
          <td><span class="heading"><b>Production Performance (Closed WOs only)</b></td>
    
        <tr><td>
<table  border=0 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1" style="width:83%">
<tr>
<td bgcolor="#F5F6F5" colspan="7"><span class="heading"><b><center>Search & Sort Criteria</center></b></td>
<td bgcolor="#FFFFFF" rowspan=3 colspan=4 align="center"><span class="tabletext">
<input type="image" name="Submit" src="images/bu-get.gif" value="Get"
            onclick="javascript: return searchsort_prodperf()">

<input type="hidden" name="company_oper">
<input type="hidden" name="wonum_oper">
</td>
</tr>
<tr>
<!--<td bgcolor="#FFFFFF"><span class="labeltext"><b>Status = &nbsp</b></td>
<td bgcolor="#FFFFFF"><span class="tabletext"><select name="status_val" size="1" width="100">
<?php
      if ($sval == 'Open')
      {
?>
	<option selected>Open
	<option value>All
	<option value>Closed
    <option value>Cancelled
    <option value>Hold
<?php
      }
      else if ($sval == 'Closed')
      {
?>
	<option selected>Closed
	<option value>Open
	<option value>All
    <option value>Cancelled
    <option value>Hold
<?php
      }
      else if ($sval == 'Hold')
      {
?>
	<option selected>Hold
	<option value>Open
	<option value>All
        <option value>Cancelled
        <option value>Closed
<?php
      }
      else if ($sval == 'All')
      {
?>
	<option selected>All
	<option value>Open
	<option value>Closed
        <option value>Cancelled
        <option value>Hold
<?php
      }
      else if ($sval == 'Cancelled')
      {
?>
	<option selected>Cancelled
	<option value>Open
	<option value>All
        <option value>Closed
        <option value>Hold
<?php
      }
?>
</select>
</td> -->

<td bgcolor="#FFFFFF"><span class="labeltext"><b>Company &nbsp</b></td>
<td  bgcolor="#FFFFFF"><span class="labeltext">like</td>
<td bgcolor="#FFFFFF"><input type="text" name="scomp" size=20 value="<?php echo $company_match ?>" onKeyPress="javascript: return checkenter(event)">
</td>

<td bgcolor="#FFFFFF"><span class="labeltext"><b>WO # &nbsp&nbsp</b><span class="tabletext">
   <select name="wonum_oper" size="1" width="100">
<?php
      if ($oper2 == 'like')
      {
?>
	<option selected>like
	<option value>=
<?php
      }
      else
      {
?>
	<option selected>=
	<option value>like
<?php
      }
?>
</select>
</td>
<td colspan=3 bgcolor="#FFFFFF"><input type="text" name="swonum" size=16 value="<?php echo $wonum_match ?>" onKeyPress="javascript: return checkenter(event)">
</td>
</tr>
<tr>
<td colspan=5 bgcolor="#FFFFFF"><span class="labeltext"><b>WO Close Date:  From &nbsp&nbsp</b>
        <input type="text" name="sdate1" size=10 value="<?php echo $date1_match ?>"
         onkeypress="javascript: return checkenter(event)">
        <img src="images/bu-getdateicon.gif" alt="Get Date" onclick='GetDate("sdate1")'>
         <span class="labeltext"><b>&nbsp;&nbsp;To</b>
        <input type="text" name="sdate2" size=10 value="<?php echo $date2_match ?>"
         onkeypress="javascript: return checkenter(event)">
        <img src="images/bu-getdateicon.gif" alt="Get Date" onclick='GetDate("sdate2")'>
</td>
<td bgcolor="#FFFFFF"><span class="labeltext"><b>PRN#</b></td>
<td bgcolor="#FFFFFF">
       <select name="crn_oper" size="1" width="100">
<?php
      if ($oper3 == 'like')
      {
?>
	<option selected>like
	<option value>=
<?php
      }
      else
      {
?>
	<option selected>=
	<option value>like
<?php
      }
?>
</select> &nbsp;&nbsp;
        <input type="text" name="crn" size=10 value="<?php echo $crn_match ?>"
         onkeypress="javascript: return checkenter(event)">

</td></tr>
</table>
</td></tr>
<td>
<div style="width:83%;overflow-x:scroll">
<?php
   include_once 'ofc-library/open_flash_chart_object.php';
   open_flash_chart_object( 1200, 350, 'http://'. $_SERVER['SERVER_NAME'] .'/fluenterp/chart-data1.php', false );
   //open_flash_chart_object( 600, 350, 'http://localhost/fluentwms/chart-data1.php', false );
?>
</td>
</div>
<td width=1 bgcolor='#000000'>
<br>
</td>
<tr>
<td>

<table style="table-layout: fixed;width:83%" border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable">
<tr>
<thead>
<th style="width:1%" class="head0"><span class="tabletext"><p align="left"><b>WO#</p></font></th>
<th style="width:1%" class="head1"><span class="tabletext"><p align="left"><b>Qty.<br>Mfg.</p></font></th>
<th style="width:1%" class="head0"><span class="tabletext"><p align="left"><b>PRN</p></font></th>
<th style="width:1%" class="head1"><span class="tabletext"><p align="left"><b>EST.<br/> Time<br>(Hrs)</p></font></th>
<th style="width:1%" class="head0"><span class="tabletext"><p align="left"><b>Act. Time<br>(Hrs.)</p></font></th>
<th style="width:1%" class="head1"><span class="tabletext"><p align="left"><b>Rejection<br>Qty.</p></font></th>
<th style="width:1%" class="head0"><span class="tabletext"><p align="left"><b>Hours<br/>(-ve=Loss;+ve=Gain)<br>Lost/Gained</p></font></th>
</tr>
<!-- </table>
<div style="width:100%;height:100;overflow:auto;border:" id="dataList">
<table style="table-layout: fixed;width:100%"  border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable"> -->
<?php
	$newlogin = new userlogin;
	$newlogin->dbconnect();
	$closedwos = $newreport->get_closed_wos($cond);
    $_SESSION['cond'] = $cond;
	while($myrow = mysql_fetch_row($closedwos))
	{
		$mastertime = $newreport->get_est_time($myrow[1],$myrow[2]);
		$mymastertime = mysql_fetch_row($mastertime);
		$acttime = $newreport->get_act_time($myrow[0]);
		$myacttime = mysql_fetch_row($acttime);
        //echo'<br>ESTTIME=='.$mymastertime[0];
        $estTime = intval($mymastertime[0] / 60)." h ". ($mymastertime[0] % 60)." m ";
        $actTime = intval($myacttime[0] / 60)." h ". ($myacttime[0] % 60)." m ";
        $lRg_min = (($mymastertime[0]-$myacttime[0]));
        //echo'<br>lrGain=='.$lRg_min;
        if($lRg_min < 0)
        {
          $lossRgain = intval($lRg_min / 60)." h ". abs($lRg_min % 60)." m ";
        }
        else
        {
          $lossRgain = intval($lRg_min / 60)." h ". ($lRg_min % 60)." m ";
        }

	    printf('<tr><td bgcolor="#FFFFFF"><span class="tabletext"><a href="javascript:show_prodn_shift(\'%s\')">%s</td>
                    <td bgcolor="#FFFFFF"><span class="tabletext">%s</td>
                    <td bgcolor="#FFFFFF"><span class="tabletext">%s</td>
                    <td bgcolor="#FFFFFF"><span class="tabletext">%s</td>
                    <td bgcolor="#FFFFFF"><span class="tabletext">%s</td>
                    <td bgcolor="#FFFFFF"><span class="tabletext">%s</td>
                    <td bgcolor="#FFFFFF"><span class="tabletext">%s</td>',
                  $myrow[0],
	    		  $myrow[0],
			      $myrow[2],
			      $myrow[1],
			      $estTime,
			      $actTime,
			      $myrow[4],
                  $lossRgain);
   	    printf('</td></tr>');
   }

   /* Free resultset */
   mysql_free_result($closedwos);
//   mysql_free_result($mastertime);
   /* Closing connection */
   $newlogin->dbdisconnect();
?>
</table>
</div>
<tr>
<table width=100% align=left border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
<tr><td>
<div id='prodn'>
</div>
</tr></td></table>
      <!-- </table>
         <td width="6"><img src="images/spacer.gif " width="6"></td>
			</tr>
                <tr bgcolor="DEDFDE">
  				<td width="6"><img src="images/box-left-bottom.gif"></td>
				<td><img src="images/spacer.gif " height="6"></td>
				<td width="6"><img src="images/box-right-bottom.gif"></td>
			</tr> -->
        </table>
</FORM>
</table>
</body>
</html>
