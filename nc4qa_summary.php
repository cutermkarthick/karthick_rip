<?php
//
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
$_SESSION['pagename'] = 'nc4qa_summary';
$page="QA: NC";
//////session_register('pagename');

// First include the class definition
include_once('classes/userClass.php');
include_once('classes/nc4qaclass.php');
include_once('classes/displayClass.php');


$newnc = new nc4qa;
$newdisplay = new display;

$cond0 = "refnum like '%'";
$cond1 = "wonum like '%'";
$cond2 = "customer like '%'";
$cond3 = "cofcnum like '%'";
$cond4 = "(to_days(create_date)-to_days('1582-01-01') >= 0 ||
                    create_date = '0000-00-00' ||
                    create_date is NULL) and
          (to_days(create_date)-to_days('2050-12-31') <= 0 ||
                   create_date = '0000-00-00' ||
                 create_date is NULL)";
//$cond4 = "w.wotype like '%'"; */
$cond5 = "partnum like '%'";
$cond6 = "(status like '%' || status = '' || status is NULL)";

$cond = $cond0 . ' and ' . $cond1 . ' and ' . $cond2 . ' and ' . $cond3 . ' and ' . $cond4 . ' and ' . $cond5 . ' and ' . $cond6;

$final_insprecnum='';
$oper1='like';
$oper2='like';
$oper3='like';
$oper4='like';
$oper5='like';
$oper6='like';
$sort1='refnum';

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
         $final_refno = "'" . $_REQUEST['final_refno'] . "%" . "'";
     }
     else {
         $final_refno = "'" . $_REQUEST['final_refno'] . "'";
     }

     $cond0 = "refnum " . $oper1 . " " . $final_refno;

}
else {
     $finalref_match = '';
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

     $cond1 = "wonum " . $oper2 . " " . $final_wono;

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

     $cond2 = "customer " . $oper3 . " " . $final_cust;

}
else {
     $cust_match = '';
}

if ( isset ( $_REQUEST['final_cofc'] ) )
{
     $cofc_match = $_REQUEST['final_cofc'];
     if ( isset ( $_REQUEST['cofc_oper'] ) ) {
          $oper4 = $_REQUEST['cofc_oper'];
     }
     else {
         $oper4 = 'like';
     }
     if ($oper4 == 'like') {
         $final_cofc = "'" . $_REQUEST['final_cofc'] . "%" . "'";
     }
     else {
         $final_cofc = "'" . $_REQUEST['final_cofc'] . "'";
     }

     $cond3 = "cofcnum " . $oper4 . " " . $final_cofc;

}
else
{
     $cofc_match = '';
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

     $cond5 = "partnum " . $oper6 . " " . $final_partnum;

}
else {
     $part_match = '';
}

if ( isset ( $_REQUEST['final_date1'] ) || isset ( $_REQUEST['final_date2'] ) )
{
     $fdate1_match = $_REQUEST['final_date1'];
     $fdate2_match = $_REQUEST['final_date2'];
     if ( isset ( $_REQUEST['final_date1']) &&  $_REQUEST['final_date1'] != '' )
     {
          $date1 = $_REQUEST['final_date1'];
          $cond41 = "to_days(create_date) " . ">= to_days('" . $date1 . "')";
     }
     else
     {
          $cond41 = "(to_days(create_date)-to_days('1582-01-01') >= 0 || create_date is NULL || create_date = '0000-00-00')";
     }

     if ( isset ( $_REQUEST['final_date2'] )  &&  $_REQUEST['final_date2'] != '')
     {
          $date2 = $_REQUEST['final_date2'];
          $cond42 = "to_days(create_date) " . "<= to_days('" . $date2 . "')";
     }
     else
     {
          $cond42 = "(to_days(create_date)-to_days('2050-12-31') <= 0 || create_date is NULL || create_date = '0000-00-00')";
     }
     $cond4 = $cond41 . ' and ' . $cond42;

}

else
{
     $fdate1_match = '';
     $fdate2_match = '';
}

if(isset ($_REQUEST['status_val'] ) )
{
     $sval = $_REQUEST['status_val'];

      if ($sval== 'Open')
      {
         $cond6 = "(status = '" . $sval . "' || status is NULL || status = '')";
      }
     else if ($sval == 'Closed')
      {
         $cond6 = "status = '" . $sval . "'" ;
      }
     else if ($sval == 'All')
      {
         $cond6 = "(status like '%' || status is NULL)";
      }
     else if ($sval == 'Pending')
      {
         $cond6 = "status = '" . $sval . "'" ;
      }
}
else
{
     $sval = 'Open';
     $cond6 = "(status = '" . $sval . "' || status is NULL || status = '')";
}

if ( isset ( $_REQUEST['sortfld1'] ) ) {
    $sort1 = $_REQUEST['sortfld1'];

}


$cond = $cond0 . ' and ' . $cond1 . ' and ' . $cond2 . ' and ' . $cond3 . ' and ' . $cond4 . ' and ' . $cond5 . ' and ' . $cond6;

$userrole = $_SESSION['userrole'];
$dept = $_SESSION['department'];
/*if (isset($_REQUEST['final_insprecnum']))
{
	$final_insprecnum=$_REQUEST['final_insprecnum'];
	$_SESSION['final_insprecnum'] = $final_insprecnum;
	//////session_register('final_insprecnum');
}



$cond = "(to_days(final_insp_report.billdate)-to_days('1582-01-01') > 0 ||
                    final_insp_report.billdate = '0000-00-00' ||
                    final_insp_report.billdate = 'NULL' ) and
           (to_days(final_insp_report.billdate)-to_days('2050-12-31') < 0 ||
                    final_insp_report.billdate = '0000-00-00' ||
                    final_insp_report.billdate = 'NULL')";


 $sort1='billdate';

 if ( isset ( $_REQUEST['sortCond'] ) )
  {
    $sort1 = $_REQUEST['sortCond'];
    if ($sort1=='Descending')
         $sort1= "`quote`.quote_date Desc" ;
         else
        $sort1= "`quote`.quote_date" ;
  }


 if ( isset ( $_REQUEST['sdate1'] ) || isset ( $_REQUEST['sdate2'] ) )
  {
     $date1_match = $_REQUEST['sdate1'];
     $date2_match = $_REQUEST['sdate2'];
     if ( isset ( $_REQUEST['sdate1']) &&  $_REQUEST['sdate1'] != '' )
     {
          $date1 = $_REQUEST['sdate1'];
          $cond31 = "to_days(`quote`.quote_date) " . "> to_days('" . $date1 . "')";
     }
     else
     {
          $cond31 = "(to_days(`quote`.quote_date)-to_days('1582-01-01') > 0 || `quote`.quote_date = 'NULL' || `quote`.quote_date = '0000-00-00')";
     }

     if ( isset ( $_REQUEST['sdate2'] )  &&  $_REQUEST['sdate2'] != '')
     {
          $date2 = $_REQUEST['sdate2'];
          $cond32 = "to_days(`quote`.quote_date) " . "< to_days('" . $date2 . "')";
     }
     else
     {
          $cond32 = "(to_days(`quote`.quote_date)-to_days('2050-12-31') < 0 || `quote`.quote_date = 'NULL' || `quote`.quote_date = '0000-00-00')";
     }
     $cond = $cond31 . ' and ' . $cond32;

}
else
{
     $date1_match = '';
     $date2_match = '';
}             */
// echo $cond;
// how many rows to show per page
$rowsPerPage = 100;

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

 //echo $offset;

?>
<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/nc4qa.js"></script>

<html>
<head>
<title>QA NC</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">
<form action='nc4qa_summary.php' method='post' enctype='multipart/form-data'>
<?php

 include('header.html');

?>
<!-- <table width=100% cellspacing="0" cellpadding="6" border="0">
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
	    <td bgcolor="#FFFFFF"> -->
 <table width=100% border=0 cellpadding=6 cellspacing=0>
     <tr><td>
          <tr><td><span class="heading"><i>Please click on the CIM Ref No to Edit/Delete</i></td></tr>
		</tr>
  <tr>
<td>

<table width=100% border=0 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1">
  <tr>
	<td bgcolor="#F5F6F5" colspan="13"><span class="heading"><b><center>Search & SortCriteria</center></b></td>
    <td bgcolor="#FFFFFF" rowspan=3 align="center">
	<button class= "stdbtn btn_blue" name="submit" onclick="javascript: return searchsort_fields()">Get</button>


<input type="hidden" name="refno_oper">
<input type="hidden" name="wono_oper">
<input type="hidden" name="cust_oper">
<input type="hidden" name="partno_oper">
<input type="hidden" name="pono_oper">
	</td>
  </tr>
<tr>
<td bgcolor="#FFFFFF"><span class="labeltext"><b>PRN</b></td>

<td bgcolor="#FFFFFF"><span class="tabletext"><select name="refno_oper" size="1" width="50">
<?php
   if ( isset ( $_REQUEST['refno_oper'] ) ){
          $check2 = $_REQUEST['refno_oper'];

                   if ($check2 =='like'){
?>
    	            <option value='='>=
	                <option selected value='like'>like
<?php
                    }else{
?>
                    <option selected value='='>=
	                <option value='like'>like

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

<td bgcolor="#FFFFFF"><input type="text" name="final_refno" size=15 value="<?php echo $finalref_match ?>" onkeypress="javascript: return checkenter(event)">
</td>

<td bgcolor="#FFFFFF"><span class="labeltext"><b>WO No</b></td>

<td bgcolor="#FFFFFF"><span class="tabletext"><select name="wono_oper" size="1" width="30">
<?php
   if ( isset ( $_REQUEST['wono_oper'] ) ){
          $check2 = $_REQUEST['wono_oper'];

                   if ($check2 =='like'){
?>
    	            <option value='='>=
	                <option selected value='like'>like
<?php
                    }else{
?>
                    <option selected value='='>=
	                <option value='like'>like

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

<td bgcolor="#FFFFFF"><input type="text" name="final_wono" size=15 value="<?php echo $wono_match ?>" onkeypress="javascript: return checkenter(event)">
</td>


<td bgcolor="#FFFFFF"><span class="labeltext"><b>C Of C No</b></td>
<td bgcolor="#FFFFFF"><span class="tabletext"><select name="cofc_oper" size="1" width="30">
<?php
   if ( isset ( $_REQUEST['cofc_oper'] ) ){
          $check2 = $_REQUEST['cofc_oper'];

                   if ($check2 =='like'){
?>
    	            <option value='='>=
	                <option selected value='like'>like
<?php
                    }else{
?>
                    <option selected value='='>=
	                <option value='like'>like

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

<td  bgcolor="#FFFFFF"><input type="text" name="final_cofc" size=15 value="<?php echo $cofc_match ?>" onkeypress="javascript: return checkenter(event)">
</td>
<td bgcolor="#FFFFFF"><span class="labeltext"><b>Status =</b></td>
<td colspan=3 bgcolor="#FFFFFF"><span class="tabletext"><select name="status_val" size="1" width="50">
<?php
      if ($sval == 'Open')
      {
?>
	<option selected value='Open'>Open
	<option value='Closed'>Closed
	<option value='Pending'>Pending
    <option value='All'>All
<?php
      }
      else if ($sval == 'Closed')
      {
?>
	<option selected value='Closed'>Closed
	<option value='Open'>Open
	<option value='Pending'>Pending
    <option value='All'>All
<?php
      }
      else if ($sval == 'Pending')
      {
?>
	<option selected value='Pending'>Pending
	<option value='Open'>Open
    <option value='Closed'>Closed
    <option value='All'>All
<?php
      }
      else if ($sval == 'All')
      {
?>
	<option selected value='All'>All
	<option value='Open'>Open
    <option value='Closed'>Closed
    <option value='Pending'>Pending

<?php
      }
?>
</select>
</td>
  <tr>

  <td bgcolor="#FFFFFF"><span class="labeltext"><b>Part No</b></td>

<td bgcolor="#FFFFFF"><span class="tabletext"><select name="part_oper" size="1" width="50">
<?php
   if ( isset ( $_REQUEST['part_oper'] ) ){
          $check2 = $_REQUEST['part_oper'];

                   if ($check2 =='like'){
?>
    	            <option value='='>=
	                <option selected value='like'>like
<?php
                    }else{
?>
                    <option selected value='='>=
	                <option value='like'>like

 <?php
                    }
   }else{
?>
 	<option value="like" selected>like
	<option value="equal">=
 <?PHP
  }
 ?>
</select></td>

<td bgcolor="#FFFFFF"><input type="text" name="final_part" size=15 value="<?php echo $part_match ?>" onkeypress="javascript: return checkenter(event)">
</td>
<td bgcolor="#FFFFFF"><span class="labeltext"><b>Customer</b></td>

<td bgcolor="#FFFFFF"><span class="tabletext"><select name="cust_oper" size="1" width="50">
<?php
   if ( isset ( $_REQUEST['cust_oper'] ) ){
          $check2 = $_REQUEST['cust_oper'];

                   if ($check2 =='like'){
?>
    	            <option value='='>=
	                <option selected value='like'>like
<?php
                    }else{
?>
                    <option selected value='='>=
	                <option value='like'>like

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

<td bgcolor="#FFFFFF"><input type="text" name="final_cust" size=15 value="<?php echo $cust_match ?>" onkeypress="javascript: return checkenter(event)">
</td>


      	<td colspan=7 bgcolor="#FFFFFF"><span class="labeltext"><b>Create Date:  From &nbsp&nbsp</b>
        <input type="text" name="final_date1" size=10 value="<?php echo $fdate1_match ?>"
         onkeypress="javascript: return checkenter(event)">
        <img src="images/bu-getdateicon.gif" alt="Get Date" onclick='GetDate("final_date1")'>
         <span class="labeltext"><b>&nbsp;&nbsp;To</b>
        <input type="text" name="final_date2" size=10 value="<?php echo $fdate2_match ?>"
         onkeypress="javascript: return checkenter(event)">
        <img src="images/bu-getdateicon.gif" alt="Get Date" onclick='GetDate("final_date2")'>
       </td>
  </tr>


	</table>
	</td></tr>
	<tr><td>
<table width=100% border=0>
  <div class="contenttitle radiusbottom0">
  <h2><span>List Of NC
<?php
   if($dept=='Sales' || $dept == 'QA' || $dept == 'Production')
   {
?>
<input type="button" class="stdbtn btn_blue" style="float:right;padding:2px;margin-right:5px;" onClick="location.href='new_nc4qa.php'" value="New NC" >
  <!-- <a href ="new_nc4qa.php"><img name="Image8" style="float:right" border="0" src="images/new_nc.gif"></a> -->
  </h2>
</span>
<?php
  }else
  {
?>
  </td>
<?php
  }
?>
  </tr>
</table>

<table width=100% border=0 cellpadding=3 cellspacing=1 class="stdtable" >
  <thead>
        <tr>
             <th  class="head0"><span class="tabletext"><b>Id No.</b></th>
             <th  class="head1"><span class="tabletext"><b>Create Date</b></th>
            <th  class="head0"><span class="tabletext"><b>WO No.</b></th>
            <th  class="head1"><span class="tabletext"><b>PRN</b></th>
             <th  class="head0"><span class="tabletext"><b>C Of C No.</b></th>
            <th  class="head1"><span class="tabletext"><b>Customer</b></th>
           <th  class="head0"><span class="tabletext"><b>Part Name</b></th>
            <th  class="head1"><span class="tabletext"><b>Part No.</b></th>
            <th  class="head0"><span class="tabletext"><b>Batch No.</b></th>
            <th  class="head1"><span class="tabletext"><b>Status</b></th>
        </tr>
      </thead>

<?php

     $result = $newnc->getnc4qa($cond,$offset,$sort1,$rowsPerPage);

            while ($myrow = mysql_fetch_row($result)) {
            
              if($myrow[8] != '' && $myrow[8] != '0000-00-00')
               {
                 $datearr = split('-', $myrow[8]);
                 $d=$datearr[2];
                 $m=$datearr[1];
                 $y=$datearr[0];
                 $x=mktime(0,0,0,$m,$d,$y);
                 $create_date=date("M j, Y",$x);
               }
               else
               {
                 $create_date = '';
               }

    $today = strtotime(date('Y-m-d'),"00:00:00");
		$myBookDate = strtotime($myrow[8],"00:00:00");
		$days_old=round(abs($today-$myBookDate)/60/60/24)."days";
    

              if(($days_old>=29)&&($myrow[9]=='Open' || $myrow[9]=='' || $myrow[9] == 'null'))
              {

                      $bgcolour="#ff5500";
              }
              else
              {
                 $bgcolour="#FFFFFF"; 
              }
   	       printf('<tr bgcolor="%s"><td align="center"><span class="tabletext">
                           <a href="nc4qadetails.php?nc4qarecnum=%s">%05d</td>
                          <td align="center"><span class="tabletext">%s</td>
                          <td align="center"><span class="tabletext">%s</td>
                          <td align="center"><span class="tabletext">%s</td>
                          <td align="center"><span class="tabletext">%s</td>
                          <td align="center"><span class="tabletext">%s</td>
                          <td align="center"><span class="tabletext">%s</td>
                          <td align="center"><span class="tabletext">%s</td>
                          <td align="center"><span class="tabletext">%s</td>
                          <td align="center"><span class="tabletext">%s</td>
                          ',
		                        $bgcolour,   
                            $myrow[0],$myrow[0],
		                        $create_date,
                            $myrow[6],
                            $myrow[1],
                            $myrow[7],
                            $myrow[2],
                            $myrow[3],
                            $myrow[5],
                            $myrow[4],
                            $myrow[9]);
                         
                         

           printf('</td></tr>');
         

        }

?>
</table>
      </table>
     <!--     <td width="6"><img src="images/spacer.gif " width="6"></td>
			</tr>
                <tr bgcolor="DEDFDE">
  				<td width="6"><img src="images/box-left-bottom.gif"></td>
				<td><img src="images/spacer.gif " height="6"></td>
				<td width="6"><img src="images/box-right-bottom.gif"></td>
			</tr>

        </table>
        <table border = 0 cellpadding=0 cellspacing=0 width=100% >
							<tr>
								<td align=left> -->

<?php
   $numrows = $newnc->getncCount($cond,$offset,$rowsPerPage);
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
    $prev = " <a href=\"nc4qa_summary.php?page=$page&totpages=$totpages&final_wono=$wono_match&final_refno=$finalref_match&final_cust=$cust_match&final_part=$part_match&final_date1=$fdate1_match&final_date2=$fdate2_match&final_cofc=$cofc_match&status_val=$sval\">[Prev]</a> ";

    $first = " <a href=\"nc4qa_summary.php?page=1&totpages=$totpages&final_wono=$wono_match&final_refno=$finalref_match&final_cust=$cust_match&final_part=$part_match&final_date1=$fdate1_match&final_date2=$fdate2_match&final_cofc=$cofc_match&status_val=$sval\">[First Page]</a> ";
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
    $next = " <a href=\"nc4qa_summary.php?page=$page&totpages=$totpages&final_wono=$wono_match&final_refno=$finalref_match&final_cust=$cust_match&final_part=$part_match&final_date1=$fdate1_match&final_date2=$fdate2_match&final_cofc=$cofc_match&status_val=$sval\">[Next]</a> ";

    $last = " <a href=\"nc4qa_summary.php?page=$totpages&totpages=$totpages&final_wono=$wono_match&final_refno=$finalref_match&final_cust=$cust_match&final_part=$part_match&final_date1=$fdate1_match&final_date2=$fdate2_match&final_cofc=$cofc_match&status_val=$sval\">[Last Page]</a> ";
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

