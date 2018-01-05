<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = June 18, 2008                =
// Filename: qa4efficiency.php                 =
// Copyright of Badari Mandyam, FluentSoft     =
// Revision: v1.0 WMS                          =
// Displays QA Efficiency Summary list.        =
//==============================================
@session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );
}
$userid = $_SESSION['user'];
$_SESSION['pagename'] = 'reports';
//////session_register('pagename');

$dept = $_SESSION['department'];

include_once('classes/userClass.php');
include_once('classes/loginClass.php');
include('classes/reportClass.php');
include('classes/displayClass.php');

$newlogin = new userlogin;
$newlogin->dbconnect();
$username = $_SESSION['user'];
$newreport = new report;
$newdisplay = new display;
$cond0 = "w.crn_num like '%'";
$cond1 = "wps.inspnum like '%'";
$cond2 =  "(to_days(d.create_date)-to_days('1582-01-01') > 0 ||
                   d.create_date = '0000-00-00' ||
                    d.create_date = 'NULL' ) and
           (to_days(d.create_date)-to_days('2050-12-31') < 0 ||
                    d.create_date = '0000-00-00' ||
                    d.create_date = 'NULL')";

$cond = $cond0 . ' and ' . $cond1 . ' and ' . $cond2;


$oper1='like';
$oper2='like';
$sort1='crn';
//$sort2='rm_spec';
$sess=session_id();

if ( isset ( $_REQUEST['final_crn'] ) )
{
     $finalcrn_match = $_REQUEST['final_crn'];
     if ( isset ( $_REQUEST['crn_oper'] ) ) {
          $oper1 = $_REQUEST['crn_oper'];
     }
     else {
         $oper1 = 'like';
     }
     if ($oper1 == 'like') {
         $finalcrn = "'" . $_REQUEST['final_crn'] . "%" . "'";
     }
     else {
         $finalcrn = "'" . $_REQUEST['final_crn'] . "'";
     }

     $cond0 = "w.crn_num " . $oper1 . " " . $finalcrn;

}
else {
     $finalcrn_match = '';
}

if ( isset ( $_REQUEST['final_insp'] ) )
{
     $finalinsp_match = $_REQUEST['final_insp'];
     if ( isset ( $_REQUEST['insp_oper'] ) ) {
          $oper2 = $_REQUEST['insp_oper'];
     }
     else {
         $oper2 = 'like';
     }
     if ($oper2 == 'like') {
         $finalinsp = "'" . $_REQUEST['final_insp'] . "%" . "'";
     }
     else {
         $finalinsp = "'" . $_REQUEST['final_insp'] . "'";
     }

     $cond1 = "wps.inspnum " . $oper2 . " " . $finalinsp;

}
else {
     $finalinsp_match = '';
}

if ( isset ( $_REQUEST['sortfld1'] ) ) {
    $sort1 = $_REQUEST['sortfld1'];
}

if ( isset ( $_REQUEST['ddate1'] ) || isset ( $_REQUEST['ddate2'] ) )
{
     $ddate1_match = $_REQUEST['ddate1'];
     $ddate2_match = $_REQUEST['ddate2'];
     if ( isset ( $_REQUEST['ddate1']) &&  $_REQUEST['ddate1'] != '' )
     {
          $date1 = $_REQUEST['ddate1'];
          $cond21 = "to_days(d.create_date) " . "> to_days('" . $date1 . "')";
     }
     else
     {
          $cond21 = "(to_days(d.create_date)-to_days('1582-01-01') > 0 || d.create_date = 'NULL' || d.create_date = '0000-00-00')";
     }

     if ( isset ( $_REQUEST['ddate2'] )  &&  $_REQUEST['ddate2'] != '')
     {
          $date2 = $_REQUEST['ddate2'];
          $cond22 = "to_days(d.create_date) " . "< to_days('" . $date2 . "')";
     }
     else
     {
          $cond22 = "(to_days(d.create_date)-to_days('2050-12-31') < 0 || d.create_date = 'NULL' || d.create_date = '0000-00-00')";
     }
     $cond2 = $cond21 . ' and ' . $cond22;

}
else
{
     $ddate1_match = '';
     $ddate2_match = '';
}

/*if ( isset ( $_REQUEST['sortfld2'] ) ) {
    $sort2 = $_REQUEST['sortfld2'];
}*/

$cond = $cond0 . ' and ' . $cond1 . ' and ' . $cond2;
//echo $cond;


// echo $cond;
// how many rows to show per page
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



?>
<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/qa4efficiency.js"></script>
<html>
<head>
<title>QA Efficiency</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">




<form action='qaeffrep.php' method='post' enctype='multipart/form-data'>
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
<table width=100% border=0 cellpadding=0 cellspacing=0  >
  <tr bgcolor="DEDFDE"><td width="6"><img src="images/spacer.gif " width="6"></td>
	    <td bgcolor="#FFFFFF">
 <table width=100% border=0 cellpadding=6 cellspacing=0  >
  <tr>
<td>


<table width=100% border=0 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF" >
<tr>
<td bgcolor="#F5F6F5" colspan="5"><span class="heading"><b><center>Search Criteria</center></b></td>
<td bgcolor="#FFFFFF" rowspan=3 align="center"><span class="tabletext"><input type= "image" name="Get" src="images/bu-get.gif" value="Get" onclick="javascript: return searchsort_fields()"></td>
<input type="hidden" name="crn_oper">
</tr>
<tr>
<td bgcolor="#FFFFFF"><span class="tabletext"><b>PRN&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b>
<select name="crn_oper" size="1" width="50">
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
<option value>like

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

<td bgcolor="#FFFFFF"><input type="text" name="final_crn" size=15 value="<?php echo $finalcrn_match ?>" onkeypress="javascript: return checkenter(event)">
</td>
<td bgcolor="#FFFFFF"><span class="tabletext"><b>Inspector</b>
<select name="insp_oper" size="1" width="50">
<?php
  if ( isset ( $_REQUEST['insp_oper'] ) ){
     $check2 = $_REQUEST['insp_oper'];

      if ($check2 =='like'){
?>
<option value>=
<option selected>like
<?php
    }else{
?>
<option selected>=
<option value>like

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

<td colspan=2 bgcolor="#FFFFFF"><input type="text" name="final_insp" size=15 value="<?php echo $finalinsp_match ?>" onkeypress="javascript: return checkenter(event)">
</td>

</tr>
 <tr>
<td colspan=5 bgcolor="#FFFFFF"><span class="labeltext"><b>COFC Date:  From &nbsp&nbsp</b>
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
	<tr><td>
<table width=100% border=0>

  <tr>
  <td><span class="pageheading"><b>QA Efficiency Report</b></td>
  <td colspan=160>&nbsp;</td>
  </tr>

</table>

<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
        <tr bgcolor="#FFCC00">
            <td bgcolor="#EEEFEE"><span class="tabletext"><b>PRN</b></td>
            <td bgcolor="#EEEFEE"><span class="tabletext"><b>WO#</b></td>
            <td bgcolor="#EEEFEE"><span class="tabletext"><b>Cofc Num</b></td>
            <td bgcolor="#EEEFEE"><span class="tabletext"><b>Cofc Dt</b></td>
            <td bgcolor="#EEEFEE"><span class="tabletext"><b>Inspected<br>By</b></td>
            <td bgcolor="#EEEFEE"><span class="tabletext"><b>Inspected<br>Date</b></td>
            <td bgcolor="#EEEFEE"><span class="tabletext"><b>Quantity<br>Dispatched</b></td>
	        <td bgcolor="#EEEFEE"><span class="tabletext"><b>Quantity<br>Accepted</b></td>
	        <td bgcolor="#EEEFEE"><span class="tabletext"><b>Cust Rej</b></td>
	        <td bgcolor="#EEEFEE"><span class="tabletext"><b>Accepted<br>Rating</b></td>
        </tr>

<?php

         $result = $newreport->getqaeff($cond,$sort1,$offset,$rowsPerPage);
         $total_dispatched = 0;
         $total_accepted = 0;
         while($myrow=mysql_fetch_row($result))
         {
         if($myrow[11] != '' && $myrow[11] != '0000-00-00')
          {
            $datearr = split('-', $myrow[11]);
            $d=$datearr[2];
            $m=$datearr[1];
            $y=$datearr[0];
            $x=mktime(0,0,0,$m,$d,$y);
            $date=date("M j, Y",$x);
          }
            else
          {
            $date = '';
          }
          if($myrow[2] != '' && $myrow[2] != '0000-00-00')
          {
            $datearr = split('-', $myrow[2]);
            $d=$datearr[2];
            $m=$datearr[1];
            $y=$datearr[0];
            $x=mktime(0,0,0,$m,$d,$y);
            $ins_date=date("M j, Y",$x);
          }
            else
          {
            $ins_date = '';
          }
          $qty_disp = $myrow[4];
		  $result1 = $newreport->getnc4qaeff($myrow[1]);
		  $num_rows = mysql_num_rows($result1);
		  $qty_rej = 0;
		  if ($num_rows > 0)
			 {
			    $myrow1=mysql_fetch_row($result1);
				$qty_rej = $myrow1[0];
			 }
		   $qty_accp = $myrow[4]-$qty_rej;
		  /*
		  if ($myrow[8] != 'yes')
			 {
			   $custend = '';
			 }
		   else if ($myrow[8] == 'yes' && $myrow[9] == 'yes')

			 {
			   $custend = 'yes';
			   $rejqty = $myrow[5];
			 }
			else 
			 {
				$custend = '';
			 }
			 */
		   $accp_rating1 = $qty_disp != 0 ? ((($qty_accp)/$qty_disp)*100) : "0";
           $accp_rating = round($accp_rating1);

   	       printf('<tr bgcolor="#FFFFFF">
		                  <td ><span class="tabletext">%s</td>
                          <td><span class="tabletext">%s</td>
                          <td><span class="tabletext">%s</td>
                          <td><span class="tabletext">%s</td>
                          <td><span class="tabletext">%s</td>
					      <td><span class="tabletext">%s</td>
                          <td><span class="tabletext">%s</td>
                          <td><span class="tabletext">%s</td>
                          <td><span class="tabletext">%s</td>
		                  <td><span class="tabletext">%s</td>
                          ',
                         $myrow[0],
                         $myrow[1],
                         $myrow[10],
						 $date,
                         $myrow[3],
                         $ins_date,
                         $myrow[4],
                         $qty_accp,
			             $qty_rej,
                         $accp_rating.'%');
              printf('</td></tr>');
          $total_dispatched += $qty_disp;
          $total_accepted += $qty_accp;

        }
      $overall_rating1 = $total_dispatched != 0 ? (($total_accepted/$total_dispatched)*100) : "0";
      $overall_rating = round($overall_rating1);

?><tr></tr>

   <tr>
    <td colspan=5 align="right"  bgcolor="#FFFFFF"><span class="tabletext"><b>Total</b></td>
    <td bgcolor="#CCEEFF"><span class="tabletext"><span class="tabletext"><?php echo $total_dispatched ?></td>
    <td bgcolor="#CCEEFF"><span class="tabletext"><span class="tabletext"><?php echo $total_accepted ?></td>
    <td bgcolor="#CCEEFF"><span class="tabletext"><span class="tabletext">&nbsp</td>
    <td bgcolor="#CCEEFF"><span class="tabletext"><span class="tabletext"><?php echo $overall_rating.'%' ?></td>

  </tr>
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

								</td>
							</tr>


						</table>
      </FORM>
</body>
</html >

