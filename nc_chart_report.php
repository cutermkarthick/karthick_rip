<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = May 11, 2009                 =
// Filename: nc_chart_report.php               =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 WMS                          =
// NC Chart                                    =
//==============================================


   session_start();
header("Cache-Control: cache, must-revalidate");
header("Pragma: public");
   //header("Cache-control: private");
   header ("Content-type: image/png");
   if ( !isset ( $_SESSION['user'] ) )
   {
        header ( "Location: login.php" );
   }
   $userid = $_SESSION['user'];
   $_SESSION['pagename'] = 'reports';
   //////session_register('pagename');

$cond0 = "(to_days(create_date)-to_days('1582-01-01') > 0 ||
                    create_date = '0000-00-00' ||
                    create_date is NULL ) and
           (to_days(create_date)-to_days('2050-12-31') < 0 ||
                    create_date = '0000-00-00' ||
                    create_date is NULL)";
$cond1 = "refnum like '%'";
$cond2 = "super_name like '%'";
$cond3 = "oper_name like '%'";
$cond6 = "recnum like '%'";
$cond = $cond0 . ' and ' . $cond1 . ' and ' . $cond2 . ' and ' . $cond3. ' and ' . $cond6;

$worec='';
$oper1='like';
$oper2='like';
$oper3='like';
$oper4='like';
$oper5='like';

$sess=session_id();

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

     $cond1 = "refnum " . $oper3 . " " . $crn;

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
          $cond01 = "to_days(create_date) " . "> to_days('" . $date1 . "')";
     }
     else
     {
          $cond01 = "(to_days(create_date)-to_days('1582-01-01') > 0 || create_date is NULL || create_date = '0000-00-00')";
     }

     if ( isset ( $_REQUEST['sdate2'] )  &&  $_REQUEST['sdate2'] != '')
     {
          $date2 = $_REQUEST['sdate2'];
          $cond02 = "to_days(create_date) " . "< to_days('" . $date2 . "')";
     }
     else
     {
          $cond02 = "(to_days(create_date)-to_days('2050-12-31') < 0 || create_date is NULL || create_date = '0000-00-00')";
     }
     $cond0 = $cond01 . ' and ' . $cond02;

}
else
{
     $date1_match = '';
     $date2_match = '';
}

if ( isset ( $_REQUEST['sup_name'] ) )
{
     $sup_match = $_REQUEST['sup_name'];
     if ( isset ( $_REQUEST['sup_oper'] ) ) {
          $oper4 = $_REQUEST['sup_oper'];
     }
     else {
         $oper4 = 'like';
     }
     if ($oper4 == 'like') {
         $sup = "'" . $_REQUEST['sup_name'] . "%" . "'";
     }
     else {
         $sup = "'" . $_REQUEST['sup_name'] . "'";
     }

     $cond2 = "super_name " . $oper4 . " " . $sup;

}
else {
     $sup_match = '';
}

if ( isset ( $_REQUEST['oper_name'] ) )
{
     $oper_match = $_REQUEST['oper_name'];
     if ( isset ( $_REQUEST['oper_oper'] ) ) {
          $oper5 = $_REQUEST['oper_oper'];
     }
     else {
         $oper5 = 'like';
     }
     if ($oper5 == 'like') {
         $oper = "'" . $_REQUEST['oper_name'] . "%" . "'";
     }
     else {
         $oper = "'" . $_REQUEST['oper_name'] . "'";
     }

     $cond3 = "oper_name " . $oper5 . " " . $oper;

}
else {
     $oper_match = '';
}

if ( isset ( $_REQUEST['sortfld1'] ) ) {
    $sort1 = $_REQUEST['sortfld1'];
}
if ( isset ( $_REQUEST['sortfld2'] ) ) {
    $sort2 = $_REQUEST['sortfld2'];
}

if(isset ($_REQUEST['nc_type'] ) )
{
     $sval = $_REQUEST['nc_type'];

      if ($sval== 'Cust NC')
      {
         $cond6 = "cust_end = 'yes'";
      }
     else if ($sval == 'CIM NC')
      {
         $cond6 =  "(cust_end = 'no' || cust_end = 'null' || cust_end = '')";
      }
     else if ($sval == 'All')
      {
         $cond6 = "recnum like '%'";
      }

}
else
{
     $sval = 'All';
     $cond6 = "recnum like '%'";
}

$cond = $cond0 . ' and ' . $cond1 . ' and ' . $cond2 . ' and ' . $cond3. ' and ' . $cond6;


   // First include the class definition
   include('classes/reportClass.php');
   include_once('classes/displayClass.php');
   $newdisplay = new display;
   $newreport = new report;

   $newlogin = new userlogin;
   $newlogin->dbconnect();
   
   $rowsPerPage = 10;

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

?>
<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/report.js"></script>

<html>
<head>
<title>NC Chart</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">
<?php
     include('header.html');
?>
<form action='nc_chart_report.php' method='post' enctype='multipart/form-data'>
<table width=100% cellspacing="0" cellpadding="6" border="0">
<tr>
<td>
<table width=100% border=0 cellspacing="0" cellpadding="0">
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
<tr>
	<td>
  <table width=100% border=0 >
   <tr><td><span class="heading"><b>Production Performance</b></td>

<tr><td>
<table width=100% border=0 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF" >
<tr>
<td bgcolor="#F5F6F5" colspan="7"><span class="heading"><b><center>Search & Sort Criteria</center></b></td>
<td bgcolor="#FFFFFF" rowspan=4 colspan=4 align="center"><span class="tabletext">
<input type="image" name="Submit" src="images/bu-get.gif" value="Get"
            onclick="javascript: return searchsort_prodperf()">

<input type="hidden" name="company_oper">
<input type="hidden" name="wonum_oper">
</td>
</tr>
<tr>
<td colspan=2  bgcolor="#FFFFFF"><span class="labeltext"><b>Create Date:  From &nbsp&nbsp</b>
        <input type="text" name="sdate1" size=10 value="<?php echo $date1_match ?>"
         onkeypress="javascript: return checkenter(event)">
        <img src="images/bu-getdateicon.gif" alt="Get Date" onclick='GetDate("sdate1")'>
         <span class="labeltext"><b>&nbsp;&nbsp;To</b>
        <input type="text" name="sdate2" size=10 value="<?php echo $date2_match ?>"
         onkeypress="javascript: return checkenter(event)">
        <img src="images/bu-getdateicon.gif" alt="Get Date" onclick='GetDate("sdate2")'>
</td>
<td bgcolor="#FFFFFF"><span class="labeltext"><b>PRN#</b></td>
<td  colspan=4 bgcolor="#FFFFFF">
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
<tr>
<td width="25px" bgcolor="#FFFFFF"><span class="labeltext"><b>Supervisor</b></td>
<td bgcolor="#FFFFFF">
       <select name="sup_oper" size="1" width="100">
<?php
      if ($oper4 == 'like')
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
        <input type="text" name="sup_name" size=12 value="<?php echo $sup_match ?>"
         onkeypress="javascript: return checkenter(event)">

</td>
<td bgcolor="#FFFFFF"><span class="labeltext"><b>Operator</b></td>
<td colspan=4 bgcolor="#FFFFFF">
       <select name="oper_oper" size="1" width="100">
<?php
      if ($oper5 == 'like')
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
        <input type="text" name="oper_name" size=12 value="<?php echo $oper_match ?>"
         onkeypress="javascript: return checkenter(event)">

</td>
</tr>
<tr>
 <td bgcolor="#FFFFFF" colspan=7><span class="labeltext"><b>NC #</b>

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="tabletext"><select name="nc_type" size="1" width="50">
<?php
      if ($sval == 'All')
      {
?>
	<option selected value="All">All
	<option value>Cust NC
	<option value>CIM NC
<?php
      }
      else if ($sval == 'Cust NC')
      {
?>
	<option selected>Cust NC
	<option value>CIM NC
    <option value>All
<?php
      }
      else if ($sval == 'CIM NC')
      {
?>
	<option selected>CIM NC
	<option value>Cust NC
    <option value>All
<?php
      }

?>
</select>
</td>
</tr>

</table>
<table width=100% border=0 cellpadding=3 cellspacing=1 >

<tr><td>


<table border=1 width=50% cellpadding=1 cellspacing=10>
<tr>
<?php
   $dim_div = 0;
   $man = 0;
   $in_pro = 0;
   $mat_div = 0;
   $machine = 0;
   $final_insp = 0;
   $method = 0;
   $cust_end = 0;
   $others = 0;

   $result = $newreport->getnc4qa_graph($cond);
   while($myrow = mysql_fetch_row($result))
   {
    if($myrow[3] == 'yes')
    {
      $dim_div++;
    }
    if($myrow[4] == 'yes')
    {
      $man++;
    }
    if($myrow[5] == 'yes')
    {
      $in_pro++;
    }
    if($myrow[6] == 'yes')
    {
      $mat_div++;
    }
    if($myrow[7] == 'yes')
    {
      $machine++;
    }
    if($myrow[8] == 'yes')
    {
      $final_insp++;
    }
    if($myrow[9] == 'yes')
    {
      $method++;
    }
    if($myrow[10] == 'yes')
    {
      $cust_end++;
    }
    if($myrow[12] == 'yes')
    {
      $others++;
    }
   }
  // echo $_SERVER['SERVER_NAME']; http://'. $_SERVER['SERVER_NAME'] .'/wms_feb14_2012/

   echo "<td align=\"left\">";
   include_once 'ofc-library/open_flash_chart_object.php';
   open_flash_chart_object( 500, 200, 'chart-qanc_errortype.php?cond='.$cond.'&dimdiv='.$dim_div.'&matdiv='.$mat_div.'&others='.$others, false);
   echo "</td>";
   echo "<td align=\"left\">";
   include_once 'ofc-library/open_flash_chart_object.php';
   open_flash_chart_object( 500, 200, 'https://'. $_SERVER['SERVER_NAME'] .'/wms/chart-qanc_cause.php?cond='.$cond.'&man='.$man.'&machine='.$machine.'&method='.$method, false);
   #open_flash_chart_object( 400, 200, 'https://'. $_SERVER['SERVER_NAME'] .'/wms/chart-qanc_cause.php?cond='.$cond.'&man='.$man.'&machine='.$machine.'&method='.$method, false);

?>
</td>
</tr>
</table>
<table width=100% align=left border=1 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
<tr>
<td width=2% bgcolor="#FFFFF" colspan=6><span class="tabletext"><p align="left"><b>&nbsp</p></font></td>
<td width=2% bgcolor="#FFFFF" colspan=3><span class="tabletext"><p align="center"><b>ERROR TYPE</p></font></td>
<td width=2% bgcolor="#FFFFF" colspan=3><span class="tabletext"><p align="center"><b>CAUSE</p></font></td>
<td width=2% bgcolor="#FFFFF" colspan=3><span class="tabletext"><p align="center"><b>STAGE</p></font></td>
</tr>
<tr>
<td width=2% bgcolor="#EEEFEE"><span class="tabletext"><p align="left"><b>Id No.</p></font></td>
<td width=2% bgcolor="#EEEFEE"><span class="tabletext"><p align="left"><b>Create Date</p></font></td>
<td width=2% bgcolor="#EEEFEE"><span class="tabletext"><p align="left"><b>PRN</p></font></td>
<td width=2% bgcolor="#EEEFEE"><span class="tabletext"><p align="left"><b>WO#</p></font></td>
<td width=2% bgcolor="#EEEFEE"><span class="tabletext"><p align="left"><b>Superviser<br>Name</p></font></td>
<td width=2% bgcolor="#EEEFEE"><span class="tabletext"><p align="left"><b>Operator<br>Name</p></font></td>
<td width=2% bgcolor="#EEEFEE"><span class="tabletext"><p align="left"><b>DIMENSIONAL<br>DEVIATION</p></font></td>
<td width=2% bgcolor="#EEEFEE"><span class="tabletext"><p align="left"><b>MATERIAL<br>DEVIATION</p></font></td>
<td width=2% bgcolor="#EEEFEE"><span class="tabletext"><p align="left"><b>OTHER<br>DEVIATION</p></font></td>
<td width=2% bgcolor="#EEEFEE"><span class="tabletext"><p align="left"><b>MAN</p></font></td>
<td width=2% bgcolor="#EEEFEE"><span class="tabletext"><p align="left"><b>MACHINE</p></font></td>
<td width=2% bgcolor="#EEEFEE"><span class="tabletext"><p align="left"><b>METHOD</p></font></td>
<td width=2% bgcolor="#EEEFEE"><span class="tabletext"><p align="left"><b>IN<br>PROCESS</p></font></td>
<td width=2% bgcolor="#EEEFEE"><span class="tabletext"><p align="left"><b>FINAL<br>INSPECTION</p></font></td>
<td width=2% bgcolor="#EEEFEE"><span class="tabletext"><p align="left"><b>CUSTOMER<br>END</p></font></td>
</tr>
<?php
	$result = $newreport->getnc4qa_chart($cond,$offset,$rowsPerPage);
	while($myrow = mysql_fetch_row($result))
	{
        ($myrow[3] == 'no')? ($dimdiv='&nbsp'):$dimdiv=$myrow[3];
        ($myrow[4] == 'no')? ($Man='&nbsp'):$Man=$myrow[4];
        ($myrow[5] == 'no')? ($inp='&nbsp'):$inp=$myrow[5];
        ($myrow[6] == 'no')? ($matdiv='&nbsp'):$matdiv=$myrow[6];
        ($myrow[7] == 'no')? ($mc='&nbsp'):$mc=$myrow[7];
        ($myrow[8] == 'no')? ($fi='&nbsp'):$fi=$myrow[8];
        ($myrow[9] == 'no')? ($met='&nbsp'):$met=$myrow[9];
        ($myrow[10] == 'no')? ($custend='&nbsp'):$custend=$myrow[10];
        ($myrow[12] == 'no')? ($oth='&nbsp'):$oth=$myrow[12];

	    printf('<tr><td bgcolor="#FFFFFF"><span class="tabletext">%05d</td>
                    <td bgcolor="#FFFFFF"><span class="tabletext">%s</td>
                    <td bgcolor="#FFFFFF"><span class="tabletext">%s</td>
                    <td bgcolor="#FFFFFF"><span class="tabletext">%s</td>
                    <td bgcolor="#FFFFFF"><span class="tabletext">%s</td>
                    <td bgcolor="#FFFFFF"><span class="tabletext">%s</td>
                    <td bgcolor="#FFFFFF"><span class="tabletext">%s</td>
                    <td bgcolor="#FFFFFF"><span class="tabletext">%s</td>
                    <td bgcolor="#FFFFFF"><span class="tabletext">%s</td>
                    <td bgcolor="#FFFFFF"><span class="tabletext">%s</td>
                    <td bgcolor="#FFFFFF"><span class="tabletext">%s</td>
                    <td bgcolor="#FFFFFF"><span class="tabletext">%s</td>
                    <td bgcolor="#FFFFFF"><span class="tabletext">%s</td>
                    <td bgcolor="#FFFFFF"><span class="tabletext">%s</td>
                    <td bgcolor="#FFFFFF"><span class="tabletext">%s</td>',
	    		  $myrow[0],
	    		  $myrow[11],
			      $myrow[1],
			      $myrow[2],
			      $myrow[13],
			      $myrow[14],
			      $dimdiv,
		          $matdiv,
		          $oth,
			      $Man,
			      $mc,
			      $met,
			      $inp,
                  $fi,
                  $custend);
   	    printf('</td></tr>');
   }

?>
</table>
</td></tr>
</table>
</table>
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
//  Added on Dec 6,04 for paging

$numrows = $newreport->nc_chartCount($cond,$offset,$rowsPerPage);
//echo $numrows;
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
    $prev = " <a href=\"nc_chart_report.php?page=$page&totpages=$totpages&crn=$crn_match&sdate1=$date1_match&sdate2=$date2_match&sup_name=$sup_match&oper_name=$oper_match&nc_type=$sval\">[Prev]</a> ";

    $first = " <a href=\"nc_chart_report.php?page=1&totpages=$totpages&crn=$crn_match&sdate1=$date1_match&sdate2=$date2_match&sup_name=$sup_match&oper_name=$oper_match&nc_type=$sval\">[First Page]</a> ";
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
  $next = " <a href=\"nc_chart_report.php?page=$page&totpages=$totpages&crn=$crn_match&sdate1=$date1_match&sdate2=$date2_match&sup_name=$sup_match&oper_name=$oper_match&nc_type=$sval\">[Next]</a> ";

  $last = " <a href=\"nc_chart_report.php?page=$totpages&totpages=$totpages&crn=$crn_match&sdate1=$date1_match&sdate2=$date2_match&sup_name=$sup_match&oper_name=$oper_match&nc_type=$sval\">[Last Page]</a> ";
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
// End additions on Dec 6,04

?>
</td>
</tr></table>
</table>
</body>
</html>
