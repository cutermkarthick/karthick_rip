<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = Feb 24,2012                  =
// Filename: consumptionReport.php             =
// Copyright of Badari Mandyam, FluentSoft     =
// Revision: v1.0 OMS                          =
// Displays list of stock consumption          =
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
include_once('classes/consumptionClass.php');

$newlogin = new userlogin;
$newlogin->dbconnect();

$newconsumption = new report;
$newdisplay = new display;
$newconsumption = new consumption;

$rowsPerPage = 15000;

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

date_default_timezone_set('Asia/Calcutta');
 $todate1 = date("Y-m-d");

$today = split('-',$todate1);
$days = '2007-01-01';
$fromdate1 = date("Y-m-d",strtotime($days));

$cond0 = "crn like '%'";
$cond1 = "invoice_num like '%'";
$cond2 = "(bond_num like '%' || bond_num is null)";
$cond3 = "(be_num like '%' || be_num is null)";
$cond6 = "(rmtype like '%' || rmtype is null)";
$cond5 = "(description like '%' || description is null)";
$cond7 = "grnnum like '%'";
$cond01 = "to_days(grn_date) " . ">= to_days('" . $fromdate1 . "')";
$cond02 = "to_days(grn_date) " . "<= to_days('" . $todate1 . "')";

$cond4= $cond01 . ' and ' . $cond02;

//$cond2 = "(cn.status like '%' || cn.status is NULL)";

$cond = $cond0 . ' and ' . $cond1 . ' and ' . $cond4 . ' and ' . $cond6 . ' and ' . $cond5 . ' and ' . $cond7;

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

     $cond0 = "crn " . $oper1 . " " . $final_refno;

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

     $cond1 = "invoice_num " . $oper2 . " " . $final_wono;

}
else {
     $wono_match = '';
}


if ( isset ( $_REQUEST['sdate1'] ) || isset ( $_REQUEST['sdate2'] ) )
{
     $fromdate1 = $_REQUEST['sdate1'];
     $todate1 = $_REQUEST['sdate2'];
     if ( isset ( $_REQUEST['sdate1']) &&  $_REQUEST['sdate1'] != '' )
     {
          $date1 = $_REQUEST['sdate1'];
          $cond01 = "to_days(grn_date) " . ">= to_days('" . $date1 . "')";
     }
     else
     {
          $cond01 = "(to_days(grn_date)-to_days('1582-01-01') > 0 || grn_date is NULL || grn_date = '0000-00-00')";
     }

     if ( isset ( $_REQUEST['sdate2'] )  &&  $_REQUEST['sdate2'] != '')
     {
          $date2 = $_REQUEST['sdate2'];
          $cond02 = "to_days(grn_date) " . "<= to_days('" . $date2 . "')";
     }
     else
     {
          $cond02 = "(to_days(grn_date)-to_days('2050-12-31') < 0 || grn_date is NULL || grn_date = '0000-00-00')";
     }
     $cond4 = $cond01 . ' and ' . $cond02;

}
else
{
      $fromdate1 = $fromdate1;
      $todate1 = $todate1;
}



if ( isset ( $_REQUEST['final_bondno'] ) )
{
     $finalbond_match = $_REQUEST['final_bondno'];
     if ( isset ( $_REQUEST['bondno_oper'] ) ) {
          $oper3 = $_REQUEST['bondno_oper'];
     }
     else {
         $oper3 = 'like';
     }
     if ($oper3 == 'like') {
         $final_bondno = "'" . $_REQUEST['final_bondno'] . "%" . "'";
         $cond2 = "(bond_num " . $oper3 . " " . $final_bondno.")";
     }
     else {
         $final_bondno = "'" . $_REQUEST['final_bondno'] . "'";
         $cond2 = "(bond_num " . $oper3 . " " . $final_bondno.")";
     }


     if($_REQUEST['final_bondno']=='')
      {
      $cond2 = "(bond_num like '%' || bond_num is null)";
      }
}
else {
     $finalbond_match = '';
    // $cond2 = "(bond_num like '%' || bond_num is null)";

}

if ( isset ( $_REQUEST['final_beno'] ) )
{
     $finalbe_match = $_REQUEST['final_beno'];
     if ( isset ( $_REQUEST['be_oper'] ) ) {
          $oper4 = $_REQUEST['be_oper'];
     }
     else {
         $oper4 = 'like';
     }
     if ($oper4 == 'like') {
         $final_beno = "'" . $_REQUEST['final_beno'] . "%'" ;
         $cond3 = "(be_num " . $oper4 . " " . $final_beno.")";
     }
     else {
         $final_beno = "'" . $_REQUEST['final_beno'] . "'";
         $cond3 = "(be_num " . $oper4 . " " . $final_beno.")";
     }
      if($_REQUEST['final_beno']=='')
      {
      $cond3 = "(be_num like '%' || be_num is null)";
      }

}
else {
     $finalbe_match = '';

}

if ( isset ( $_REQUEST['final_rmtype'] ) )
{
     $finalrmtype_match = $_REQUEST['final_rmtype'];
     if ( isset ( $_REQUEST['rmt_oper'] ) ) {
          $oper5 = $_REQUEST['rmt_oper'];
     }
     else {
         $oper5 = 'like';
     }
     if ($oper5 == 'like') {
         $final_rmtype = "'" . $_REQUEST['final_rmtype'] . "%'" ;
         $cond6= "(rmtype " . $oper5 . " " . $final_rmtype.")";
     }
     else {
         $final_rmtype = "'" . $_REQUEST['final_rmtype'] . "'";
         $cond6 = "(rmtype " . $oper5 . " " . $final_rmtype.")";
     }
      if($_REQUEST['final_rmtype']=='')
      {
      $cond6 = "(rmtype like '%' || rmtype is null)";
      }

}
else {
     $finalrmtype_match = '';

}

if ( isset ( $_REQUEST['final_rmspec'] ) )
{
     $finalrmspec_match = $_REQUEST['final_rmspec'];
     if ( isset ( $_REQUEST['rms_oper'] ) ) {
          $oper6 = $_REQUEST['rms_oper'];
     }
     else {
         $oper6 = 'like';
     }
     if ($oper6 == 'like') {
         $final_rmspec = "'" . $_REQUEST['final_rmspec'] . "%'" ;
         $cond5= "(description " . $oper6 . " " . $final_rmspec.")";
     }
     else {
         $final_rmspec = "'" . $_REQUEST['final_rmspec'] . "'";
         $cond5 = "(description " . $oper6 . " " . $final_rmspec.")";
     }
      if($_REQUEST['final_rmspec']=='')
      {
      $cond5 = "(description like '%' || description is null)";
      }

}
else {
     $finalrmspec_match = '';

}
if ( isset ( $_REQUEST['final_grn'] ) )
{
     $grn_match = $_REQUEST['final_grn'];
     if ( isset ( $_REQUEST['grn_oper'] ) ) {
          $oper8 = $_REQUEST['grn_oper'];
     }
     else {
         $oper8 = 'like';
     }
     if ($oper8 == 'like') {
         $final_grnnum = "'" . $_REQUEST['final_grn']."%" . "'";
     }
     else {
         $final_grnnum = "'" . $_REQUEST['final_grn'] . "'";
     }

     $cond7 = "grnnum " . $oper8 . " " . $final_grnnum;

}
else {
     $grn_match = '';
}


$cond = $cond0 . ' and ' . $cond1 . ' and ' . $cond4 . ' and ' . $cond6 . ' and ' . $cond5 . ' and ' . $cond7;


$userrole = $_SESSION['userrole'];
$dept = $_SESSION['department'];

// echo $cond;
// how many rows to show per page


 //echo $offset;

?>
<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/report.js"></script>

<html>
<head>
<title>Discrepancy(COFC-Consumption)</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">
<form action='discrepancygrncofc.php' method='post' enctype='multipart/form-data'>
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
     <!--<tr><td>
          <tr><td><span class="heading"><i>Please click on the appropriate link to Edit/Delete</i></td></tr>
		</tr> -->
  <tr>
<td>

<!--<table width=100% border=0 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF">
  <tr>
	<td bgcolor="#F5F6F5" colspan="8"><span class="heading"><b><center>Search & SortCriteria</center></b></td>
    <td bgcolor="#FFFFFF" rowspan=3 align="center">
	<input type= "image" name="submit" src="images/bu-get.gif" value="Get" onclick="javascript: return searchsort_fields4cons()">


<input type="hidden" name="refno_oper">
<input type="hidden" name="wono_oper">
<input type="hidden" name="cust_oper">
<input type="hidden" name="partno_oper">
<input type="hidden" name="pono_oper">
	</td>
  </tr>
<tr>
<td bgcolor="#FFFFFF"><span class="labeltext"><b>GRN Date:  From &nbsp&nbsp</b>
        <input type="text" name="sdate1" id="sdate1" size=10 value="<?php echo $fromdate1 ?>"
         onkeypress="javascript: return checkenter(event)">
        <img src="images/bu-getdateicon.gif" alt="Get Date" onclick='GetDate("sdate1")'>
         <span class="labeltext"><b>&nbsp;&nbsp;To</b>
        <input type="text" name="sdate2" id="sdate2" size=10 value="<?php echo $todate1  ?>"
         onkeypress="javascript: return checkenter(event)">
        <img src="images/bu-getdateicon.gif" alt="Get Date" onclick='GetDate("sdate2")'>
</td>
<td bgcolor="#FFFFFF"><span class="labeltext"><b>PRN No</b></td>

<td bgcolor="#FFFFFF"><span class="tabletext"><select name="refno_oper" size="1" width="20">
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
</select></td>

<td bgcolor="#FFFFFF"><input type="text" name="final_refno" size=15 value="<?php echo $finalref_match ?>" onkeypress="javascript: return checkenter(event)">
</td>

<td bgcolor="#FFFFFF"><span class="labeltext"><b>Invoice #</b>&nbsp;&nbsp;&nbsp;&nbsp;
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
</select>&nbsp;&nbsp;&nbsp;&nbsp;
<input type="text" name="final_wono" size=15 value="<?php echo $wono_match ?>" onkeypress="javascript: return checkenter(event)">
</td>
<td bgcolor="#FFFFFF" ><span class="labeltext"><b>GRN #</b>&nbsp;&nbsp;&nbsp;&nbsp;
<span class="tabletext"><select name="grn_oper" size="1" width="20">
<?php
   if ( isset ( $_REQUEST['grn_oper'] ) ){
          $check2 = $_REQUEST['grn_oper'];

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
</select>&nbsp;&nbsp;&nbsp;&nbsp;
<input type="text" name="final_grn" size=15 value="<?php echo $grn_match ?>" onkeypress="javascript: return checkenter(event)">
</td></tr>
<tr>
<td bgcolor="#FFFFFF"><span class="labeltext"><b>RM Type</b>
<select name="bondno_oper" size="1" width="20">
<?php
   if ( isset ( $_REQUEST['rmt_oper'] ) ){
          $check6 = $_REQUEST['rmt_oper'];

                   if ($check6 =='like'){
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
</select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="final_rmtype" size=15 value="<?php echo $finalrmtype_match ?>" onkeypress="javascript: return checkenter(event)">
</td>

<td colspan=6 bgcolor="#FFFFFF" ><span class="labeltext"><b>RM Spec</b>
<span class="tabletext"><select name="rmt_oper" size="1" width="20">
<?php
   if ( isset ( $_REQUEST['rms_oper'] ) ){
          $check5 = $_REQUEST['rms_oper'];

                   if ($check5 =='like'){
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
  //style="table-layout: fixed" width=1230px
 ?>
</select>
<input type="text" name="final_rmspec" size=15 value="<?php echo $finalrmspec_match ?>" onkeypress="javascript: return checkenter(event)">
</td>
</tr>
	</table> -->
	</td></tr>
	<tr><td>
<table width=100% border=0>
  <tr>
  <td><span class="pageheading"><b>Discrepancy Report(COFC data)</b></td>
  <!--<td align="right"><a href="exportconsReport.php?crn_num=<?php echo $finalref_match ?>&invnum=<?php echo $wono_match ?>&fdate=<?php echo $fromdate1 ?>&tdate=<?php echo $todate1 ?>&bond_num=<?php echo $finalbond_match ?>&be_num=<?php echo $finalbe_match ?>&raw_mat_type=<?php echo $finalraw_mat_type_match ?>&rmspec=<?php echo $finalrmspec_match ?>"><img name="Image8" border="0" src="images/export.gif" ></a>

  </td> -->
  </tr>
</table>
<table width=1200px border=0 >
<tr><td>
<table style="table-layout: fixed" width=600px border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
<tr>
	        <td align=center colspan=4  bgcolor="#43BFC7"><span class="heading"><b>Dispatch</b></td>
           </tr>
        <tr  bgcolor="#FFCC00">
            <td  bgcolor="#EEEFEE"><span class="tabletext"><b>GRN #</b></td>
            <td  bgcolor="#EEEFEE"><span class="tabletext"><b>PRN #</b></td>
            <td  bgcolor="#EEEFEE"><span class="tabletext"><b>Cofc #</b></td>
            <td  bgcolor="#EEEFEE"><span class="tabletext"><b>Cofc<br>Qty</b></td>
           </tr>
           </table>
<div style="width:620px; height:400; overflow:auto;border:" id="dataList">
<table style="table-layout: fixed" width=600px border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
<?php
$closingbal=0; $prevgrnnum='#';  $prev_grnnum="%";
$closing_bal=0; $prgrnnum='#';  $pgrnnum="%";
            // $result=$newconsumption->getcons4discrepancy($cond,$offset,$rowsPerPage);

            // while($myrow = mysql_fetch_array($result))
             //{
                   $resultdispatch=$newconsumption->getdiscrepancycofcdets4data();
                     //if(mysql_num_rows($resultdispatch)>0)
                     //{
                     while($myrowdisp= mysql_fetch_array($resultdispatch))
                     {
                     if($myrowdisp['disp_date'] != '0000-00-00' && $myrowdisp['disp_date'] != 'NULL' && $myrowdisp['disp_date'] != '')
                    {
                      $datearr = split('-', $myrowdisp['disp_date']);
                      $d=$datearr[2];
                      $m=$datearr[1];
                      $y=$datearr[0];
                      $x=mktime(0,0,0,$m,$d,$y);
                      $disp_date=date("M j, Y",$x);
                     }
                     else
                     {
                      $disp_date = '';
                     }




?>
   <tr  bgcolor="#FFFFFF">
                         <?php
                         //echo $myrow['qty_rej']."<br>";
                         if($prev_grnnum !=$myrowdisp['grnnum'])
                         {  //echo $prev_grnnum ."---***---".$myrow['grnnum']."----****-----".$myrow['qty_rej']."<br>";
                        ?>
                         <td><span class="tabletext"><?php echo $myrowdisp['grnnum'] ?></td>
                        <td><span class="tabletext"><?php echo $myrowdisp['crn'] ?></td>
                        <?php
                        $prev_grnnum =$myrowdisp['grnnum'] ;
                        }
                        else
                        {
                        ?>
                        <td><span class="tabletext">&nbsp;</td>
                        <td><span class="tabletext">&nbsp;</td>
                        <?php
                        }
                        ?>
                        <td><span class="tabletext"><?php echo $myrowdisp['relnotenum']?></td>
                        <td><span class="tabletext"><?php echo $myrowdisp['dqty'] ?></td>

            </td></tr>
<?php
                  			}
                  			//}
                  			?>
</table>
</td><td>
<table style="table-layout: fixed" width=600px border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
<tr>
	        <td align=center colspan=5  bgcolor="#43BFC7"><span class="heading"><b>Consumption</b></td>
           </tr>
        <tr  bgcolor="#FFCC00">
            <td  bgcolor="#EEEFEE"><span class="tabletext"><b>GRN #</b></td>
            <td  bgcolor="#EEEFEE"><span class="tabletext"><b>PRN #</b></td>
            <td  bgcolor="#EEEFEE"><span class="tabletext"><b>Qty<br>Recd</b></td>
            <td  bgcolor="#EEEFEE"><span class="tabletext"><b>Cofc #</b></td>
            <td  bgcolor="#EEEFEE"><span class="tabletext"><b>Cofc<br>Qty</b></td>
           </tr>
           </table>
<div style="width:620px; height:400; overflow:auto;border:" id="dataList">
<table style="table-layout: fixed" width=600px border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
    			<?


			//$result2=$newconsumption->getcons4discrepancy($cond,$offset,$rowsPerPage);

            // while($myrow2 = mysql_fetch_array($result2))
             //{
			$result_cons=$newconsumption->getcons4grncofc();
             while($myrowcons= mysql_fetch_array($result_cons))
                     {
                         //echo $prgrnnum."---***---".$myrowcons['grnnum']."<br>";
                      if($prgrnnum!=$myrowcons['grnnum'])
                    {
                        $prgrnnum=$myrowcons['grnnum'];
                        $close_bal=$myrowcons['qty_recd']-($myrowcons['qty_cons']+$myrowcons['qty_rej']);
                        $closing_bal=$close_bal;
                        //echo $close_bal."----in----<br>";

                    }
					else
                    {//echo $closingbal."----222----".$close_bal."----------$myrow[7]<br>";
                      $closing_bal= $closing_bal-($myrowcons['qty_cons']);
                    }
                    //echo $closingbal."---***----";
                    if($closing_bal>=0)
                    {
                       $color4bal="#FFFFFF";
                    }else
                    {
                      $color4bal="#FF0000";
                      ?>

                      <?php
                    }

			?>
			<tr  bgcolor="#FFFFFF">
                         <?php
                         //echo $myrow['qty_rej']."<br>";
                         if($pgrnnum !=$myrowcons['grnnum'])
                         {  //echo $prev_grnnum ."---***---".$myrow['grnnum']."----****-----".$myrow['qty_rej']."<br>";
                        ?>
                         <td><span class="tabletext"><?php echo $myrowcons['grnnum'] ?></td>
                        <td><span class="tabletext"><?php echo $myrowcons['crn'] ?></td>
                        <td><span class="tabletext"><?php echo $myrowcons['qty_recd'] ?></td>
                        <?php
                        $pgrnnum =$myrowcons['grnnum'] ;
                        }
                        else
                        {
                        ?>
                        <td><span class="tabletext">&nbsp;</td>
                        <td><span class="tabletext">&nbsp;</td>
                        <td><span class="tabletext">&nbsp;</td>
                        <?php
                        }
                        ?>
                        <td><span class="tabletext"><?php echo $myrowcons['cofc_num'] ?></td>
                        <td><span class="tabletext"><?php echo $myrowcons['qty_cons'] ?></td>

            </td></tr>
<?php
			}
			//}
   ?>
   </table>
</td></tr>
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
  /* $resultrows = $newconsumption->getgrndets4countdisc($cond,$offset,$rowsPerPage);
   $numrows=mysql_num_rows($resultrows);
   //echo $numrows."---".$rowsPerPage."<br>";
   // how many pages we have when using paging?
   $maxPage = ceil($numrows/$rowsPerPage);
//echo "$maxPage</br>";
if (!isset($_REQUEST['page']))
{
   //echo "page is set $maxPage";
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
    $prev = " <a href=\"discrepancygrncofc.php?page=$page&totpages=$totpages&final_wono=$wono_match&final_refno=$finalref_match&sdate1=$fromdate1&sdate2=$todate1&final_bondno=$finalbond_match&final_beno=$finalbe_match&final_raw_mat_type=$finalraw_mat_type_match&final_rmspec=$finalrmspec_match\">[Prev]</a> ";

    $first = " <a href=\"discrepancygrncofc.php?page=1&totpages=$totpages&final_wono=$wono_match&final_refno=$finalref_match&sdate1=$fromdate1&sdate2=$todate1&final_bondno=$finalbond_match&final_beno=$finalbe_match&final_raw_mat_type=$finalraw_mat_type_match&final_rmspec=$finalrmspec_match\">[First Page]</a> ";
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
    $next = " <a href=\"discrepancygrncofc.php?page=$page&totpages=$totpages&final_wono=$wono_match&final_refno=$finalref_match&sdate1=$fromdate1&sdate2=$todate1&final_bondno=$finalbond_match&final_beno=$finalbe_match&final_raw_mat_type=$finalraw_mat_type_match&final_rmspec=$finalrmspec_match\">[Next]</a> ";

    $last = " <a href=\"discrepancygrncofc.php?page=$totpages&totpages=$totpages&final_wono=$wono_match&final_refno=$finalref_match&sdate1=$fromdate1&sdate2=$todate1&final_bondno=$finalbond_match&final_beno=$finalbe_match&final_raw_mat_type=$finalraw_mat_type_match&final_rmspec=$finalrmspec_match\">[Last Page]</a> ";
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
{
      echo "<span class=\"labeltext\"><align=\"center\">No matching records found";
}  */
// End additions on Dec 29,04

?>
								</td>
							</tr>
						</table>
      </FORM>
</body>
</html>

