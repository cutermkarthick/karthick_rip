<?php
//==============================================
// Author: FSI                                 =
// Date-written = June 20, 2004                =
// Filename: company.php                       =
// Copyright of Badari Mandyam, FluentSoft     =
// Revision: v1.0 OMS                          =
// Displays list of comapnies.                 =
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

$rowsPerPage = 10;

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


$cond0 = "nc.refnum like '%'";
$cond1 = "nc.wonum like '%'";
$cond2 = "nc.customer like '%'";

$months=array( 'Jan','Feb','Mar','April','May','June','July','Aug','Sept','Oct','Nov','Dec' );
//$cond3 = "ponum like '%'";

$cond4 = "(to_days(nc.create_date)-to_days('1582-01-01') > 0 ||
                    nc.create_date= '0000-00-00' ||
                    nc.create_date = 'NULL') and
          (to_days(nc.create_date)-to_days('2050-12-31') < 0 ||
                   nc.create_date = '0000-00-00' ||
                 nc.create_date = 'NULL')";
$cond6 = "nc.recnum like '%'";
$cond7 = "nc.recnum like '%'";
$cond8 = "nc.recnum like '%'";
$cond9 = "nc.recnum like '%'";
$cond10 ="nc.recnum like '%'";
$cond11 = "(nc.status like '%' || nc.status = '' || nc.status is NULL)";

$cond = $cond0 . ' and ' . $cond1 . ' and ' . $cond2 . ' and ' . $cond6 . ' and ' . $cond7 . ' and ' . $cond8 . ' and ' . $cond9 . ' and ' . $cond10. ' and ' . $cond11;

$final_insprecnum='';
$oper1='like';
$oper2='like';
$oper3='like';
$oper4='like';
$oper5='like';
$oper6='like';
$sort1='nc.refnum';

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
         $final_refno = "'".$finalref_match."%" . "'";
     }
     else {
         $final_refno = "'" .$finalref_match. "'";
     }

     $cond0 = "nc.refnum " . $oper1 . " " . $final_refno;

}
else {
     $finalref_match ="";
}

if ( isset ( $_REQUEST['final_wono'] ) )
{
     $wono_match = $_REQUEST['final_wono'];
     if ( isset ( $_REQUEST['wono_oper'] ) ) {
          $oper2 = $_REQUEST['wono_oper'];
     }
     else {
         $oper2 = 'like';
     }
     if ($oper2 == 'like') {
         $final_wono = "'" . $_REQUEST['final_wono'] . "%" . "'";
     }
     else {
         $final_wono = "'" . $_REQUEST['final_wono'] . "'";              
     }

     $cond1 = "nc.wonum " . $oper2 . " " . $final_wono;

}
else {
     $wono_match = '';
}

if ( isset ( $_REQUEST['final_cust'] ) )
{
     $cust_match = $_REQUEST['final_cust'];
     if ( isset ( $_REQUEST['cust_oper'] ) ) {
          $oper3 = $_REQUEST['cust_oper'];
     }
     else {
         $oper3 = 'like';
     }
     if ($oper3 == 'like') {
         $final_cust = "'" . $_REQUEST['final_cust'] . "%" . "'";
     }
     else {
         $final_cust = "'" . $_REQUEST['final_cust'] . "'";
     }

     $cond2 = "nc.customer " . $oper3 . " " . $final_cust;

}
else {
     $cust_match = '';
}


if ( isset ( $_REQUEST['final_part'] ) )
{
     $part_match = $_REQUEST['final_part'];
     if ( isset ( $_REQUEST['part_oper'] ) ) {
          $oper6 = $_REQUEST['part_oper'];
     }
     else {
         $oper6 = 'like';
     }
     if ($oper6 == 'like') {
         $final_partnum = "'" . $_REQUEST['final_part'] . "%" . "'";
     }
     else {
        $final_partnum = "'" . $_REQUEST['final_part'] . "'";
     }

     $cond5 = "nc.partnum " . $oper6 . " " . $final_partnum;

}
else {
     $part_match = '';
}

if ( isset ( $_REQUEST['sdate1'] ) || isset ( $_REQUEST['sdate2'] ) )
{
     $date1_match = $_REQUEST['sdate1'];
     $date2_match = $_REQUEST['sdate2'];
     if ( isset ( $_REQUEST['sdate1']) &&  $_REQUEST['sdate1'] != '' )
     {
          $date1 = $_REQUEST['sdate1'];
          $cond01 = "to_days(nc.create_date) " . "> to_days('" . $date1 . "')";
     }
     else
     {
          $cond01 = "(to_days(nc.create_date)-to_days('1582-01-01') > 0 || nc.create_date is NULL || nc.create_date = '0000-00-00')";
     }
     //echo $_REQUEST['sdate2']."-------";
     if ( isset ($_REQUEST['sdate2'])  &&  trim($_REQUEST['sdate2']) != '')
     {     //echo "h-e-r-e-------";
          $date2 = $_REQUEST['sdate2'];
          $cond02 = "to_days(nc.create_date) " . "< to_days('" . $date2 . "')";
     }
     else
     {   //echo"in this loop---";
          $cond02 = "(to_days(nc.create_date)-to_days('2050-12-31') < 0 || nc.create_date is NULL || nc.create_date = '0000-00-00')";
     }
     $cond4 = $cond01 . ' and ' . $cond02;

}
else
{
     $date1_match = '';
     $date2_match = '';
     $cond4 = "(to_days(nc.create_date)-to_days('1582-01-01') > 0 ||
                    nc.create_date= '0000-00-00' ||
                    nc.create_date = 'NULL') and
          (to_days(nc.create_date)-to_days('2050-12-31') < 0 ||
                   nc.create_date = '0000-00-00' ||
                 nc.create_date = 'NULL')";
}

if ( isset ( $_REQUEST['sortfld1'] ) ) 
{
    $sort1 = $_REQUEST['sortfld1'];
}
if(isset ($_REQUEST['nc_type'] ) )
{
     $sval = $_REQUEST['nc_type'];

      if ($sval== 'Cust NC')
      {
         $cond6 = "nc.cust_end = 'yes'";
      }
     else if ($sval == 'CIM NC')
      {
         $cond6 =  "(nc.cust_end = 'no' || nc.cust_end = 'null' || nc.cust_end = '')";
      }
     else if ($sval == 'All')
      {
         $cond6 = "nc.recnum like '%'";
      }
}
else
{
     $sval = 'All';
     $cond6 = "nc.recnum like '%'";
}

if(isset ($_REQUEST['stage'] ) )
{
      $svalst = $_REQUEST['stage'];
      if ($svalst== 'In Process')
      {
         $cond7 = "inprocess = 'yes'";
      }
     else if ($svalst == 'Final Inspection')
      {
         $cond7 =  "final_insp = 'yes'";
      }
      else if ($svalst == 'Customer End')
      {
         $cond7 =  "cust_end = 'yes'";
      }
     else if ($svalst == 'All')
      {
         $cond7 = "nc.recnum like '%'";
      }
}
else
{
     $svalst = 'All';
     $cond7 = "nc.refnum like '%'";
}
if(isset ($_REQUEST['disposition'] ) )
{
      $svaldi = $_REQUEST['disposition'];
      if ($svaldi== 'Accepted')
      {
         $cond8 = "nc.accepted = 'yes'";
      }
     else if ($svaldi == 'Rejected')
      {
         $cond8 =  "nc.rejected = 'yes'";
      }
      else if ($svaldi == 'Quarantined')
      {
         $cond8 =  "nc.quarantined = 'yes'";
      }
      else if ($svaldi == 'Rework')
      {
         $cond8 =  "nc.rework = 'yes'";
      }

     else if ($svaldi == 'All')
      {
         $cond8 = "nc.recnum like '%'";
      }
}
else
{
     $svaldi = 'All';
     $cond8 = "nc.recnum like '%'";
}
if(isset ($_REQUEST['cause'] ) )
{
      $svalc = $_REQUEST['cause'];
      if ($svalc== 'Man')
      {
         $cond9 = "man = 'yes'";
      }
     else if ($svalc == 'Machine')
      {
         $cond9 =  "machine = 'yes'";
      }
      else if ($svalc == 'Method')
      {
         $cond9 =  "method = 'yes'";
      }
      else if ($svalc == 'All')
      {
         $cond9 = "nc.recnum like '%'";
      }
}
else
{
     $svalc = 'All';
     $cond9 = "nc.recnum like '%'";
}
if(isset ($_REQUEST['error_type'] ) )
{
     $svaler = $_REQUEST['error_type'];
    // echo $svaler."-*-*---";
      if ($svaler== 'Dimensional Deviation')
      {
         $cond10 = "dim_deviation = 'yes'";
      }
     else if ($svaler == 'Material Deviation')
      {
         $cond10 =  "mat_deviation = 'yes'";
      }
      else if ($svaler == 'Other')
      {
         $cond10 =  "other_deviation = 'yes'";
      }
     else if ($svaler == 'All')
      {
         $cond10 = "nc.recnum like '%'";
      }
}
else
{
     $svaler = 'All';
     $cond10 = "nc.recnum like '%'";
}

if(isset ($_REQUEST['status'] ) )
{
     $status_val = $_REQUEST['status'];

      if ($status_val== 'Open')
      {
         $cond11 = "(nc.status = '" . $status_val . "' || nc.status is NULL ||nc.status = '')";
      }
     else if ($status_val == 'Closed')
      {
         $cond11 = "nc.status = '" . $status_val . "'" ;
      }
     else if ($status_val == 'All')
      {
         $cond11 = "(nc.status like '%' || nc.status is NULL)";
      }
     else if ($status_val == 'Pending')
      {
         $cond11 = "nc.status = '" . $status_val . "'" ;
      }
}
else
{
     $status_val = 'Open';
     $cond11 = "(nc.status = '" . $status_val . "' || nc.status is NULL || nc.status = '')";
}

$cond = $cond0 . ' and ' . $cond1 . ' and ' . $cond2 . ' and ' . $cond4 . ' and ' . $cond6 . ' and ' . $cond7 . ' and ' . $cond8 . ' and ' . $cond9 . ' and ' . $cond10. ' and ' . $cond11;

$userrole = $_SESSION['userrole'];
$dept = $_SESSION['department'];

//echo $offset;

?>
<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/report.js"></script>

<html>
<head>
<title>NC for Stores</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">
<form action='qanc_report.php' method='post' enctype='multipart/form-data'>
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
          <tr><td><span class="heading"><i>Please click on the CIM Ref No to Edit/Delete</i></td></tr>
		</tr>
  <tr>
<td>

<table width=30% border=0 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF">
  <tr>
	<td bgcolor="#F5F6F5" colspan="5"><span class="heading"><b><center>Search & SortCriteria</center></b></td>
    <td bgcolor="#FFFFFF" rowspan=3 align="center">
	<input type= "image" name="submit" src="images/bu-get.gif" value="Get" onclick="javascript: return searchsort_fields()">


<input type="hidden" name="refno_oper">
<input type="hidden" name="wono_oper">
<input type="hidden" name="cust_oper">
<input type="hidden" name="partno_oper">
<input type="hidden" name="pono_oper">
	</td>
  </tr>
<tr>

<td bgcolor="#FFFFFF"><span class="labeltext"><b>PRN No</b>
<span class="tabletext"><select name="refno_oper" size="1" width="20">
<?php
   if ( isset ( $_REQUEST['refno_oper'] ) ){
          $check2 = $_REQUEST['refno_oper'];

                   if ($check2 =='like'){
?>
    	            <option value="=">=
	                <option selected value="like">like
<?php
                    }else{
?>
                    <option selected value="=">=
	                <option value="like">like
 <?php
                    }
   }else{
?>
 	<option selected value="like">like
	<option value="=">=
 <?PHP
  }
 ?>
</select>&nbsp;&nbsp;
<input type="text" name="final_refno" size=15 value="<?php echo trim($finalref_match) ?>" onkeypress="javascript: return checkenter(event)">
</td>

<td bgcolor="#FFFFFF"><span class="labeltext"><b>WO No</b>
<span class="tabletext"><select name="wono_oper" size="1" width="20">
<?php
   if ( isset ( $_REQUEST['wono_oper'] ) ){
          $check2 = $_REQUEST['wono_oper'];

                   if ($check2 =='like'){
?>
    	            <option value="=">=
	                <option selected value="like">like
<?php
                    }else{
?>
                    <option selected value="=">=
	                <option value="like">like

 <?php
                    }
   }else{
?>
 	<option selected value="like">like
	<option value="=">=
 <?PHP
  }
 ?>
</select>&nbsp;&nbsp;
<input type="text" name="final_wono" size=15 value="<?php echo $wono_match ?>" onkeypress="javascript: return checkenter(event)">
</td>

<td bgcolor="#FFFFFF"><span class="labeltext"><b>Create Date:  From &nbsp&nbsp</b>
        <input type="text" name="sdate1" id="sdate1" size=10 value="<?php echo $date1_match ?>"
         onkeypress="javascript: return checkenter(event)">
        <img src="images/bu-getdateicon.gif" alt="Get Date" onclick='GetDate("sdate1")'>
         <span class="labeltext"><b>&nbsp;&nbsp;To</b>
        <input type="text" name="sdate2" id="sdate2" size=10 value="<?php echo $date2_match ?>"
         onkeypress="javascript: return checkenter(event)">
        <img src="images/bu-getdateicon.gif" alt="Get Date" onclick='GetDate("sdate2")'>
</td>
  <tr>
  <td bgcolor="#FFFFFF"><span class="labeltext"><b>NC #</b>

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="tabletext"><select name="nc_type" size="1" width="50">
<?php
      if ($sval == 'All')
      {
?>
	<option selected value="All">All
	<option value="Cust NC">Cust NC
	<option value="CIM NC">CIM NC
<?php
      }
      else if ($sval == 'Cust NC')
      {
?>
	<option selected value="Cust NC">Cust NC
	<option value="CIM NC">CIM NC
    <option value="All">All
<?php
      }
      else if ($sval == 'CIM NC')
      {
?>
	<option selected value="CIM NC">CIM NC
	<option value="Cust NC">Cust NC
    <option value="All">All
<?php
      }

?>
</select>

&nbsp;&nbsp;
<span class="labeltext"><b>Stage</b>

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="tabletext"><select name="stage" size="1" width="50">
<?php
      if ($svalst == 'All')
      {
?>
	<option selected value="All">All
	<option value="In Process">In Process
	<option value="Final Inspection">Final Inspection
	<option value="Customer End">Customer End
<?php
      }
      else if ($svalst == 'In Process')
      {
?>
	<option selected value="In Process">In Process
    <option value="Final Inspection">Final Inspection
	<option value="Customer End">Customer End
    <option value="All">All
<?php
      }
      else if ($svalst == 'Final Inspection')
      {
?>
	<option selected value="Final Inspection">Final Inspection
    <option value="In Process">In Process
	<option value="Customer End">Customer End
    <option value="All">All
<?php
      }
      else if ($svalst == 'Customer End')
      {
?>
	<option selected value="Customer End">Customer End
    <option value="In Process">In Process
    <option value="Final Inspection">Final Inspection
    <option value="All">All
<?php
      }

?>
</select>
</td>
  <td bgcolor="#FFFFFF"><span class="labeltext"><b>Cause</b>

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="tabletext"><select name="cause" size="1" width="50">
<?php
      if ($svalc == 'All')
      {
?>
	<option selected value="All">All
	<option value="Man">Man
	<option value="Machine">Machine
	<option value="Method">Method
<?php
      }
      else if ($svalc == 'Man')
      {
?>
 	<option selected value="Man">Man
	<option value="Machine">Machine
	<option value="Method">Method
    <option value="All">All
<?php
      }
      else if ($svalc == 'Machine')
      {
?>
	<option selected value="Machine">Machine
    <option value="Man">Man
	<option value="Method">Method
    <option value="All">All
<?php
      }
      else if ($svalc == 'Method')
      {
?>
	<option selected value="Method">Method
    <option value="Man">Man
    <option value="Machine">Machine
    <option value="All">All
<?php
      }

?>
</select>
&nbsp;&nbsp;
<span class="labeltext"><b>Disposition</b>

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="tabletext"><select name="disposition" size="1" width="50">
<?php
      if ($svaldi == 'All')
      {
?>
	<option selected value="All">All
	<option value="Accepted">Accepted
	<option value="Rejected">Rejected
	<option value="Quarantined">Quarantined
	<option value="Rework">Rework
<?php
      }
      else if ($svaldi == 'Accepted')
      {
?>
    <option selected value="Accepted">Accepted
	<option value="Rejected">Rejected
	<option value="Quarantined">Quarantined
	<option value="Rework">Rework
    <option value="All">All
<?php
      }
      else if ($svaldi == 'Rejected')
      {
?>
	<option selected value="Rejected">Rejected
    <option value="Accepted">Accepted
	<option value="Quarantined">Quarantined
	<option value="Rework">Rework
    <option value="All">All
<?php
      }
      else if ($svaldi == 'Rework')
      {
?>
    <option selected value="Rework">Rework
	<option value="Rejected">Rejected
    <option value="Accepted">Accepted
	<option value="Quarantined">Quarantined
    <option value="All">All
<?php
      }
      else if ($svaldi == 'Quarantined')
      {
?>
	<option selected value="Quarantined">Quarantined
    <option value="Accepted">Accepted
	<option value="Rejected">Rejected
	<option value="Rework">Rework
    <option value="All">All
<?php
      }

?>
</select>
</td>
  <td bgcolor="#FFFFFF"><span class="labeltext"><b>Error Type</b>

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="tabletext"><select name="error_type" size="1" width="50">
<?php
      if ($svaler == 'All')
      {
?>
	<option selected value="All">All
	<option value="Dimensional Deviation">Dimensional Deviation
	<option value="Material Deviation">Material Deviation
	<option value="Other">Other
<?php
      }
      else if ($svaler == 'Dimensional Deviation')
      {
?>
	<option selected value="Dimensional Deviation">Dimensional Deviation
    <option value="Material Deviation">Material Deviation
	<option value="Other">Other
    <option value="All">All
<?php
      }
      else if ($svaler == 'Material Deviation')
      {
?>
	<option selected value="Material Deviation">Material Deviation
 	<option value="Dimensional Deviation">Dimensional Deviation
	<option value="Other">Other
    <option value="All">All
<?php
      }
            else if ($svaler == 'Other')
      {
?>
    <option selected  value="Other">Other
    <option value="Material Deviation">Material Deviation
 	<option value="Dimensional Deviation">Dimensional Deviation
    <option value="All">All
<?php
      }

?>
</select>
&nbsp;&nbsp;
<span class="labeltext"><b>Status</b>
&nbsp;&nbsp;<span class="tabletext"><select name="status" size="1" width="50">
<?php
      if ($status_val == 'All')
      {
?>
	<option selected value="All">All
	<option value="Open">Open
	<option value="Closed">Closed
	<option value="Pending">Pending
<?php
      }
      else if ($status_val == 'Open')
      {?>
    <option selected value="Open">Open
	<option value="All">All
	<option value="Closed">Closed
	<option value="Pending">Pending
<?php
      }
      else if ($status_val == 'Closed')
      {?>
	<option selected value="Closed">Closed
	<option value="Open">Open
	<option value="All">All
	<option value="Pending">Pending
<?php
      }
	  else if ($status_val == 'Pending')
      {?>
	<option selected value="Pending">Pending
	<option value="Open">Open
	<option value="Closed">Closed
	<option value="All">All
<?php
      }

?>
</select>
</td>
</tr>

	</table>
	</td></tr>
	<tr><td>
<table width=100% border=0>
  <tr>
  <td><span class="pageheading"><b>List Of NCs</b></td>
  <td align="right"><a href="nc4qa_excel.php?crnum=<?php echo trim($finalref_match) ?>&wonum=<?php echo trim($wono_match)?>&nctype=<?php echo $sval ?>&fdate=<?php echo $date1_match ?>&tdate=<?php echo $date2_match ?>&stage=<?php echo trim($svalst) ?>&cause=<?php echo $svalc ?>&error_type=<?php echo $svaler ?>&disposition=<?php echo $svaldi ?>&status_val=<? echo $status_val ?>">
  <img name="Image8" border="0" src="images/export.gif" ></a>

  </td>
  </tr>
</table>

<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
            <tr  bgcolor="#FFCC00">
            <td  bgcolor="#EEEFEE"><span class="tabletext"><b>NC No.</b></td>
			<td  bgcolor="#EEEFEE"><span class="tabletext"><b>PRN</b></td>  
			<td  bgcolor="#EEEFEE"><span class="tabletext"><b>M/C Name</b></td>
            <td  bgcolor="#EEEFEE"><span class="tabletext"><b>Stage</b></td>

			<td  bgcolor="#EEEFEE"><span class="tabletext"><b>Operator</b></td>
			<td  bgcolor="#EEEFEE"><span class="tabletext"><b>Supervisor<br>Name</b></td>
			<td  bgcolor="#EEEFEE"><span class="tabletext"><b>RM Cost</b></td>
			<td  bgcolor="#EEEFEE"><span class="tabletext"><b>Cust NC Date</b></td>
			<td  bgcolor="#EEEFEE"><span class="tabletext"><b>DC.No</b></td>
			<td  bgcolor="#EEEFEE"><span class="tabletext"><b>DC Date</b></td>
			<td  bgcolor="#EEEFEE"><span class="tabletext"><b>Cofc No.</b></td>
			<td  bgcolor="#EEEFEE"><span class="tabletext"><b>Customer</b></td>
			<td  bgcolor="#EEEFEE"><span class="tabletext"><b>PO No.</b></td>
			<td  bgcolor="#EEEFEE"><span class="tabletext"><b>PartName</b></td>
			<td  bgcolor="#EEEFEE"><span class="tabletext"><b>Batch No.</b></td>
			<td  bgcolor="#EEEFEE"><span class="tabletext"><b>Part No.</b></td>
			<td  bgcolor="#EEEFEE"><span class="tabletext"><b>Matl Spec.</b></td>
			<td  bgcolor="#EEEFEE"><span class="tabletext"><b>Part SI.No</b></td>
			<td  bgcolor="#EEEFEE"><span class="tabletext"><b>Issue & PS</b></td>

            <td  bgcolor="#EEEFEE"><span class="tabletext"><b>Cause</b></td>
            <td  bgcolor="#EEEFEE"><span class="tabletext"><b>Error Type</b></td>
            <td  bgcolor="#EEEFEE"><span class="tabletext"><b>Disposition</b></td>
			<td  bgcolor="#EEEFEE"><span class="tabletext"><b>Status</b></td>
            <td  bgcolor="#EEEFEE"><span class="tabletext"><b>WO No.</b></td>

			 <td  bgcolor="#EEEFEE"><span class="tabletext"><b>WO<br/>Qty</b></td>

			<td  bgcolor="#EEEFEE"><span class="tabletext"><b>WO Type.</b></td>
			<td  bgcolor="#EEEFEE"><span class="tabletext"><b>DN #</b></td>


            <td  bgcolor="#EEEFEE"><span class="tabletext"><b>Rej<br>Qty</b></td>
			<td  bgcolor="#EEEFEE"><span class="tabletext"><b>Rew<br>Qty</b></td>                 
            <td  bgcolor="#EEEFEE"><span class="tabletext"><b>Create Date</b></td>           
            <td  bgcolor="#EEEFEE"><span class="tabletext"><b>Description</b></td>
            <td  bgcolor="#EEEFEE"><span class="tabletext"><b>Root Cause</b></td>
            <td  bgcolor="#EEEFEE"><span class="tabletext"><b>Corrective Action</b></td>
			<td  bgcolor="#EEEFEE"><span class="tabletext"><b>Preventive Action</b></td>
            <td  bgcolor="#EEEFEE"><span class="tabletext"><b>Effectiveness</b></td>
			<td  bgcolor="#EEEFEE"><span class="tabletext"><b>Remarks</b></td>
			</tr>

<?php

     $result = $ncreport->getqanc4report($cond,$offset,$rowsPerPage);

            while ($myrow = mysql_fetch_array($result,MYSQL_BOTH)) {
				$datearr1 = split('-', $myrow[5]);
				$month=$datearr1[1];
                $year=$datearr1[0];
                $day=$datearr1[2];
				if($myrow[5]!='')
				{
                $cdate=$months[$month-1].' '.$day.','.$year;
				}
				else{
				$cdate='';
				}
              $desc = wordwrap($myrow[7],15,"\n");
              $rootcause = wordwrap($myrow[10],15,"\n");
              $correctiveaction = wordwrap($myrow[11],15,"\n");
              $preventiveaction = wordwrap($myrow[12],15,"\n");
              $effectiveness = wordwrap($myrow[9],15,"\n");
			  $status = $myrow['status'];
			
              if($myrow[13]=='yes')
              {
                $stage='In Process';
              }
              else if($myrow[14]=='yes')
              {
                 $stage='Final Inspection';
              }
              else if($myrow[15]=='yes')
              {
                 $stage='Customer End';
              }
              
              if($myrow[17]=='yes')
              {
                $disposition='Accepted';
              }
              else if($myrow[18]=='yes')
              {
                 $disposition='Rejected';
              }
              else if($myrow[19]=='yes')
              {
                 $disposition='Quarantined';
              }			
			   else if($myrow[28]=='yes')
              {
                 $disposition='Rework';
              }
              else
              {
                 $disposition='';
              }
              if($myrow[20]=='yes')
              {
                $cause='Man';
              }
              else if($myrow[21]=='yes')
              {
                 $cause='Machine';
              }
              else if($myrow[22]=='yes')
              {
                 $cause='Method';
              }
              else
              {
                 $cause='';
              }
               if($myrow[23]=='yes')
              {
                $errtype='Dimensional Deviation';
              }
              else if($myrow[24]=='yes')
              {
                 $errtype='Material Deviation';
              }
              else if($myrow[25]=='yes')
              {
                 $errtype='Other Deviation';
              }
              else
              {
                 $errtype='';
              }
           $rejqty = 0;
		   $rewqty = 0;		
           if ($disposition == 'Rejected')
		   {
			   $rejqty = $myrow[8];
		   }
		   if ($disposition == 'Rework')
			{
				$rewqty = $myrow[8];
		    }
		
			$str = ltrim($myrow[27], ',');
			$var=split(',',$str);
		
		    $v1=implode(',<br/> ',$var);	
			$wotype=wordwrap($myrow[29],11,"<br/>\n",true);

			$datearr = split('-', $myrow[34]);
				$month=$datearr[1];
                $year=$datearr[0];
                $day=$datearr[2];
				
				if($myrow[34]!='' && $myrow[34]!='0000-00-00')
				{
                $cust_nc_date=$months[$month-1].' '.$day.','.$year;
				}
				else{
				$cust_nc_date='';
				}

					$datearr = split('-', $myrow[36]);
				$month=$datearr[1];
                $year=$datearr[0];
                $day=$datearr[2];
				
				if($myrow[36]!='' && $myrow[36]!='0000-00-00')
				{
                $dc_date=$months[$month-1].' '.$day.','.$year;
				}
				else{
				$dc_date='';
				}
				$oper_name=wordwrap($myrow[31],11,"<br/>\n",false);
				$super_name=wordwrap($myrow[32],11,"<br />\n",false);

		

				$ponum=wordwrap($myrow[39],10,"<br/>\n",true);
				$partname=wordwrap($myrow[40],10,"<br/>\n",true);
				$batch_num=wordwrap($myrow[41],10,"<br  />\n",true);
				$customer=wordwrap($myrow[38],10,"<br  />\n",false);

				$partnum=wordwrap($myrow[42],10,"<br />\n",true);
				$matl_spec=wordwrap($myrow[43],10,"<br />\n",true);
				$issue_ps=wordwrap($myrow[45],10,"<br />\n",true);
				$errtype1=wordwrap($errtype,11,"<br  />\n",true);
				$remarks=wordwrap($myrow[46],15,"<br  />\n",true);

						
   	        printf('<tr bgcolor="#FFFFFF"><td><span class="tabletext">%05d</td>
			            <td><span class="tabletext">%s</td>
                        <td><span class="tabletext">%s</td>
                        <td><span class="tabletext">%s</td>
                        <td><span class="tabletext">%s</td>
						 <td><span class="tabletext">%s</td>
						  <td><span class="tabletext">%s</td>
                        <td><span class="tabletext">%s</td>
						<td><span class="tabletext">%s</td>
						<td><span class="tabletext">%s</td>
                        <td><span class="tabletext">%s</td>

						<td><span class="tabletext">%s</td>
						<td><span class="tabletext">%s</td>
						<td><span class="tabletext">%s</td>
						<td><span class="tabletext">%s</td>
						<td><span class="tabletext">%s</td>
						<td><span class="tabletext">%s</td>
						<td><span class="tabletext">%s</td>
						<td><span class="tabletext">%s</td>
						<td><span class="tabletext">%s</td>
						<td><span class="tabletext">%s</td>
						<td><span class="tabletext">%s</td>
						<td><span class="tabletext">%s</td><td><span class="tabletext">%s</td>
						<td><span class="tabletext">%s</td>
						<td><span class="tabletext">%s</td>
                        <td><span class="tabletext">%s</td>
                        <td><span class="tabletext">%s</td>
						<td><span class="tabletext">%s</td>
                        <td><span class="tabletext">%s</td>
                        <td><span class="tabletext"><textarea rows="2" cols="16"
                            style="background-color:#DDDDDD;" readonly="readonly">%s</textarea></td>
			           <td><span class="tabletext"><textarea rows="2" cols="16"
			               style="background-color:#DDDDDD;" readonly="readonly">%s</textarea></td>
			           <td><span class="tabletext"><textarea rows="2" cols="16" style="background-color:#DDDDDD;"
                            readonly="readonly">%s</textarea></td>
                       <td><span class="tabletext"><textarea rows="2" cols="16" style="background-color:#DDDDDD;"
                             readonly="readonly">%s</textarea></td>
                       <td><span class="tabletext">
                            <textarea rows="2" 
							cols="16" style="background-color:#DDDDDD;" readonly="readonly">%s</textarea></td>
							<td><span class="tabletext">
                            <textarea rows="2" 
							cols="16" style="background-color:#DDDDDD;" readonly="readonly">%s</textarea></td>
                          ',
		                 $myrow[0],
						 $myrow[2], 
						 $v1,
                         $stage,
						 $oper_name,
						 $super_name,
						 $myrow[33],
						 $cust_nc_date,
						 $myrow[35],
						 $dc_date,
						 $myrow[37],
						 $customer,
						 $ponum,
					     $partname,
						 $batch_num,
						 $partnum,
						 $matl_spec,
						 $myrow[44],
						 $issue_ps,
                         $cause,
                         $errtype1,
                         $disposition,
						 $status,
                         $myrow[1],
						 $myrow[47],
						 $wotype,$myrow[30],
						 $rejqty,
						 $rewqty,                                            
                         $cdate,                        
                         $desc,
                         $rootcause,
			             $correctiveaction,
			             $preventiveaction,
                         $effectiveness,
						 $remarks);



           printf('</td></tr>');

        }

?>
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
   $numrows = $ncreport->getqanc_count($cond,$offset,$rowsPerPage);
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
    $prev = " <a href=\"qanc_report.php?page=$page&totpages=$totpages&final_wono=$wono_match&final_refno=$finalref_match&final_cust=$cust_match&final_part=$part_match&sdate1=$date1_match&sdate2=$date2_match&nc_type=$sval&stage=$svalst&cause=$svalc&error_type=$svaler&disposition=$svaldi&status=$status_val\">[Prev]</a> ";

    $first = " <a href=\"qanc_report.php?page=1&totpages=$totpages&final_wono=$wono_match&final_refno=$finalref_match&final_cust=$cust_match&final_part=$part_match&sdate1=$date1_match&sdate2=$date2_match&nc_type=$sval&stage=$svalst&cause=$svalc&error_type=$svaler&disposition=$svaldi&status=$status_val\">[First Page]</a> ";
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
    $next = " <a href=\"qanc_report.php?page=$page&totpages=$totpages&final_wono=$wono_match&final_refno=$finalref_match&final_refno=$finalref_match&final_cust=$cust_match&final_part=$part_match&sdate1=$date1_match&sdate2=$date2_match&nc_type=$sval&stage=$svalst&cause=$svalc&error_type=$svaler&disposition=$svaldi&status=$status_val\">[Next]</a> ";

    $last = " <a href=\"qanc_report.php?page=$totpages&totpages=$totpages&final_wono=$wono_match&final_refno=$finalref_match&final_cust=$cust_match&final_part=$part_match&sdate1=$date1_match&sdate2=$date2_match&nc_type=$sval&stage=$svalst&cause=$svalc&error_type=$svaler&disposition=$svaldi&status=$status_val\">[Last Page]</a> ";
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

