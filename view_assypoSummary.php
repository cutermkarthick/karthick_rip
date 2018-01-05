<?php
//==============================================
// Author: FSI                                 =
// Date-written = June 20, 2004                =
// Filename: assypoSummary.php                 =
// Copyright of Fluent Technologies            =
// Revision: v1.0 WMS                          =
// Displays list of Dispatchs.                 =
//==============================================
session_start();
header("Cache-control: private");
if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );
}
$userid = $_SESSION['user'];
$_SESSION['pagename'] = 'view_assypoSummary';
//////session_register('pagename');

// First include the class definition
//include_once('classes/userClass.php');
include_once('classes/assypoClass.php');
include_once('classes/assypoliClass.php');
include_once('classes/displayClass.php');

$newassypo = new assyPo;
$newdisplay = new display;

$cond0 = " a.assyPonum like '%'";
$cond1 =  "(to_days(a.podate)-to_days('1582-01-01') > 0 ||
                    a.podate = '0000-00-00' ||
                    a.podate = 'NULL' ) and
           (to_days(a.podate)-to_days('2050-12-31') < 0 ||
                    a.podate = '0000-00-00' ||
                    a.podate = 'NULL')";
$cond2 = " ali.crnNum like '%'";
$cond3 = "(a.status like '%' || a.status = '' || a.status is NULL)";

$cond = $cond0 . ' and ' . $cond1 . ' and ' . $cond2 . ' and ' . $cond3;

$oper1='like';
$oper2='like';
$oper3='like';

if ( isset ( $_REQUEST['status_val'] ) )
{
     //echo '----'.$_REQUEST['status_val'];
     $sval = $_REQUEST['status_val'];
     if ($sval == 'All')
     {
         $cond3 = "a.status like " . "'%'";
     }
     else if ($sval == 'Open')
     {
         $cond3 = "a.status = '" . $sval . "'";
     }
     else if ($sval == 'Closed')
     {
         $cond3 = "a.status = '" . $sval . "'" ;
     }
     else if ($sval == 'Issued')
     {
         $cond3 = "a.status = '" . $sval . "'";
     }
     else if ($sval == 'Pending')
     {
         $cond3 = "a.status = '" . $sval . "'";
     }
     else
     {
         $cond3 = "a.status = '" . $sval . "'";
     }
}
else
{
     $sval = 'Open';
     $cond3 = "(a.status = '" . $sval . "' || a.status is NULL || a.status = '')";
}

if ( isset ( $_REQUEST['final_po'] ))
{
     $finalpo_match = $_REQUEST['final_po'];
     if ( isset ( $_REQUEST['po_oper'] ) ) {
          $oper1 = $_REQUEST['po_oper'];
     }
     else {
         $oper1 = 'like';
     }
     if ($oper1 == 'like') {
         $finalpo = "'" . $_REQUEST['final_po'] . "%" . "'";
     }
     else {
         $finalpo = "'" . $_REQUEST['final_po'] . "'";
     }

     $cond0 = "a.assyPonum " . $oper1 . " " . $finalpo;

}
else {
     $finalpo_match = '';
}


if ( isset ( $_REQUEST['ddate1'] ) || isset ( $_REQUEST['ddate2'] ) )
{
     $ddate1_match = $_REQUEST['ddate1'];
     $ddate2_match = $_REQUEST['ddate2'];
     if ( isset ( $_REQUEST['ddate1']) &&  $_REQUEST['ddate1'] != '' )
     {
          $date1 = $_REQUEST['ddate1'];
          $cond21 = "to_days(a.podate) " . ">= to_days('" . $date1 . "')";
     }
     else
     {
          $cond21 = "(to_days(a.podate)-to_days('1582-01-01') > 0 || a.podate = 'NULL' || a.podate = '0000-00-00')";
     }

     if ( isset ( $_REQUEST['ddate2'] )  &&  $_REQUEST['ddate2'] != '')
     {
          $date2 = $_REQUEST['ddate2'];
          $cond22 = "to_days(a.podate) " . "<= to_days('" . $date2 . "')";
     }
     else
     {
          $cond22 = "(to_days(a.podate)-to_days('2050-12-31') < 0 || a.podate = 'NULL' || a.podate = '0000-00-00')";
     }
     $cond1 = $cond21 . ' and ' . $cond22;

}
else
{
     $ddate1_match = '';
     $ddate2_match = '';
}

if ( isset ( $_REQUEST['final_crn'] ) )
{
     $finalcrn_match = $_REQUEST['final_crn'];
     if ( isset ( $_REQUEST['crn_oper'] ) ) {
          $oper3 = $_REQUEST['crn_oper'];
     }
     else {
         $oper3 = 'like';
     }
     if ($oper3 == 'like') {
         $finalcrn = "'" . $_REQUEST['final_crn'] . "%" . "'";
     }
     else {
         $finalcrn = "'" . $_REQUEST['final_crn'] . "'";
     }

     $cond2 = "ali.crnNum " . $oper1 . " " . $finalcrn;

}
else {
     $finalcrn_match = '';
}
$cond = $cond0 . ' and ' . $cond1 . ' and ' . $cond2 . ' and ' . $cond3;
//echo $cond;
$userrole = $_SESSION['userrole'];

// echo $cond;
// how many rows to show per page
#$rowsPerPage = 5;
$rowsPerPage = 20000;

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
<script language="javascript" src="scripts/assypo.js"></script>

<html>
<head>
<title>SP PO Summary</title>
</head>
<body leftmargin="0" topmargin="0" marginwidth="0">
<form action='view_assypoSummary.php' method='get' enctype='multipart/form-data'>
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
          <tr><td><span class="heading"><i>Please click on the link for Details</i></td></tr>
		</tr>
  <tr>
<td>

<table width=100% border=0 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF">
  <tr>
	<td bgcolor="#F5F6F5" colspan="12"><span class="heading"><b><center>Search Criteria</center></b></td>
    <td bgcolor="#FFFFFF" rowspan=3 align="center">
	<input type= "image" name="submit" src="images/bu-get.gif" value="Get" onclick="javascript: return searchsort_fields()">

<input type="hidden" id="rel_oper" name="rel_oper">
<input type="hidden" id="wo_oper" name="wo_oper">
	</td>
  </tr>
<tr>
<td bgcolor="#FFFFFF"><span class="labeltext"><b>SP PO#</b>
<span class="tabletext"><select id="po_oper" name="po_oper" size="1" width="20">
<?php
   if ( isset ( $_REQUEST['po_oper'] ) ){
          $check2 = $_REQUEST['po_oper'];

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
</select>
<input type="text" id="final_po" name="final_po" size=10 value="<?php echo $finalpo_match ?>" onkeypress="javascript: return checkenter(event)">
</td>
<td colspan=6 bgcolor="#FFFFFF"><span class="labeltext"><b>PO Date:  From &nbsp&nbsp</b>
        <input type="text" id="ddate1" name="ddate1" size=10 value="<?php echo $ddate1_match ?>"
         onkeypress="javascript: return checkenter(event)">
        <img src="images/bu-getdateicon.gif" alt="Get Date" onclick='GetDate("ddate1")'>
         <span class="labeltext"><b>&nbsp;&nbsp;To</b>
        <input type="text" id="ddate2" name="ddate2" size=10 value="<?php echo $ddate2_match ?>"
         onkeypress="javascript: return checkenter(event)">
        <img src="images/bu-getdateicon.gif" alt="Get Date" onclick='GetDate("ddate2")'>
</td>
<td colspan=4 bgcolor="#FFFFFF"><span class="labeltext"><b>PRN</b>
<span class="tabletext"><select id="crn_oper" name="crn_oper" size="1" width="20">
<?php
   if ( isset ( $_REQUEST['crn_oper'] ) ){
          $check2 = $_REQUEST['crn_oper'];

                   if ($check2 =='like'){?>
    	            <option value>=
	                <option selected>like
<?php
                    }else{?>
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
</select>
<input type="text" id="final_crn" name="final_crn" size=10 value="<?php echo $finalcrn_match ?>" onkeypress="javascript: return checkenter(event)">
</td>
</tr>
<tr>
<td  align="left" bgcolor="#FFFFFF"><span class="labeltext"><b>Status</b>
<span class="tabletext"><select id="status_val" name="status_val" size="1" width="100">
<?php
      if ($sval == 'Open')
      {
?>
	<option selected="Open">Open
	<option value="Pending">Pending</option>
	<option value="Closed">Closed</option>
    <option value="Cancelled">Cancelled</option>
    <option value="Issued">Issued</option>
    <option value="All">All</option>
<?php
      }
      else if ($sval == 'Closed')
      {
?>
	<option selected="Closed">Closed
	<option value="Open">Open</option>
	<option value="Pending">Pending</option>
    <option value="Cancelled">Cancelled</option>
    <option value="Issued">Issued</option>
    <option value="All">All</option>
<?php
      }
      else if ($sval == 'All')
      {
?>
	<option selected="All">All
	<option value="Open">Open</option>
	<option value="Pending">Pending</option>
    <option value="Closed">Closed</option>
    <option value="Cancelled">Cancelled</option>
    <option value="Issued">Issued</option>
<?php
      }
      else if ($sval == 'Issued')
      {
?>
	<option selected="Issued">Issued
	<option value="Open">Open</option>
	<option value="Pending">Pending</option>
    <option value="Closed">Closed</option>
    <option value="Cancelled">Cancelled</option>
    <option value="All">All</option>
<?php
      }
      else if ($sval == 'Cancelled')
      {
?>
	<option selected="Cancelled">Cancelled
	<option value="Open">Open</option>
	<option value="Pending">Pending</option>
    <option value="Closed">Closed</option>
    <option value="Issued">Issued</option>
    <option value="All">All</option>
<?php
      }
       else if ($sval == 'Pending')
      {
?>
    <option selected="Pending">Pending
	<option value="Open">Open</option>
    <option value="Closed">Closed</option>
    <option value="Issued">Issued</option>
    <option value="Cancelled">Cancelled</option>
    <option value="All">All</option>
<?php
    }
?>
</select>
</td>
<td colspan=10 bgcolor="#FFFFFF">&nbsp;</td>
</tr>
</table>
<tr><td>
<table width=100% border=0>
  <tr>
  <td><span class="pageheading"><b>List of SP PO</b></td>
  </tr>
</table>

<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
        <tr  bgcolor="#FFCC00">
            <td width="5%" bgcolor="#EEEFEE"><span class="tabletext"><b>SP Po#</b></td>
            <td width="5%" bgcolor="#EEEFEE"><span class="tabletext"><b>Amend #</b></td>

            <td width="5%" bgcolor="#EEEFEE"><span class="tabletext"><b>PO Date</b></td>
            <td width="10%" bgcolor="#EEEFEE"><span class="tabletext"><b>Order To</b></td>
            <td width="10%" bgcolor="#EEEFEE"><span class="tabletext"><b>PRN</b></td>
			<td width="10%" bgcolor="#EEEFEE"><span class="tabletext"><b>Part#<br>Before NDT/SP</b></td>
			<td width="10%" bgcolor="#EEEFEE"><span class="tabletext"><b>Part#<br>After SP</b></td>

			<td width="10%" bgcolor="#EEEFEE"><span class="tabletext"><b>Ln</b></td>


			<td width="10%" bgcolor="#EEEFEE"><span class="tabletext"><b>SP PO<br>Qty</b></td>
			<td width="10%" bgcolor="#EEEFEE"><span class="tabletext"><b>DN#</b></td>
			<td width="10%" bgcolor="#EEEFEE"><span class="tabletext"><b>DN Qty</b></td>
			<td width="10%" bgcolor="#EEEFEE"><span class="tabletext"><b>Balance Qty<br>(SP Qty-DNQty)</b></td>
			<td width="10%" bgcolor="#EEEFEE"><span class="tabletext"><b>Status</b></td>
        </tr>
<?php				
			  $prev_ponum = '#';	
			  $pre_crn='#';
              $result = $newassypo->getassypoSummary($cond,$offset,$rowsPerPage);           
              while ($myrow = mysql_fetch_row($result))
			  {
              if($myrow[2] != '' && $myrow[2] != '0000-00-00')
              {
                 $datearr = split('-', $myrow[2]);
                 $d=$datearr[2];
                 $m=$datearr[1];
                 $y=$datearr[0];
                 $x=mktime(0,0,0,$m,$d,$y);
                 $pdate=date("M j, Y",$x);
              }
              else
              {
                 $pdate = '';
              } 		  	    
           
              if($prev_ponum != $myrow[1])
              {
               $dnbal=$myrow[8]-$myrow[10];	
			   $order_to=wordwrap($myrow[3],15,"<br>\n",true);
			   $part_no=wordwrap($myrow[6],15,"<br>\n",true);
               echo '<tr bgcolor="#FFFFFF"><td><span class="tabletext">';
               echo "<a href=\"view_assypoDetails.php?delrecnum=$myrow[0]\">$myrow[1]</td>";
			   echo "<td><span class=\"tabletext\">$myrow[12]</td>";
               echo "<td><span class=\"tabletext\">$pdate</td>";
               echo "<td><span class=\"tabletext\">$order_to</td>";
               echo "<td><span class=\"tabletext\">$myrow[4]</td>";
			   echo "<td><span class=\"tabletext\">$myrow[5]</td>";
			   echo "<td><span class=\"tabletext\">$part_no</td>";

			   echo "<td><span class=\"tabletext\">$myrow[11]</td>";


			   echo "<td><span class=\"tabletext\">$myrow[8]</td>";
			   echo "<td><span class=\"tabletext\">$myrow[9]</td>";
               echo "<td><span class=\"tabletext\">$myrow[10]</td>";
			    if($dnbal < 0)
				  {
						$color='#ff0033';
				  }
				elseif($dnbal == 0)
				  {
					   $color='#669966';
				  }				  
				else
				  {
						$color='#FFFFFF';
				  }
			   echo "<td bgcolor=$color><span class=\"tabletext\">$dnbal</td>";

			   echo "<td><span class=\"tabletext\">$myrow[7]</td>";
               echo '</tr>';
              }
              else
              {			               
				 
				  if($pre_crn != $myrow[4])
				  { 
					$dnbal=$myrow[8]-$myrow[10];					
			        $part_no=wordwrap($myrow[6],15,"<br>\n",true);
				    echo '<tr bgcolor="#FFFFFF"><td><span class="tabletext">';
					echo "&nbsp;</td>";
                    echo "<td><span class=\"tabletext\">&nbsp;</td>";
					echo "<td><span class=\"tabletext\">&nbsp;</td>";
					echo "<td><span class=\"tabletext\">&nbsp;</td>";
					echo "<td><span class=\"tabletext\">$myrow[4]</td>";
					echo "<td><span class=\"tabletext\">$myrow[5]</td>";
					echo "<td><span class=\"tabletext\">$part_no</td>";

				   echo "<td><span class=\"tabletext\">$myrow[11]</td>";

					echo "<td><span class=\"tabletext\">$myrow[8]</td>";
					echo "<td><span class=\"tabletext\">$myrow[9]</td>";
					echo "<td><span class=\"tabletext\">$myrow[10]</td>";

                    if($dnbal < 0)
				  {
						$color='#ff0033';
				  }
				elseif($dnbal == 0)
				  {
					   $color='#669966';
				  }				  
				else
				  {
						$color='#FFFFFF';
				  }
					echo "<td bgcolor=$color><span class=\"tabletext\">$dnbal</td>";
					echo "<td><span class=\"tabletext\">&nbsp;</td>";
				  }
				  else
				  {
					$dnbal=$dnbal-$myrow[10];	
					$part_no=wordwrap($myrow[6],15,"<br>\n",true);
					echo '<tr bgcolor="#FFFFFF"><td><span class="tabletext">';
					echo "&nbsp;</td>";
					echo "<td><span class=\"tabletext\">&nbsp;</td>";
					echo "<td><span class=\"tabletext\">&nbsp;</td>";
					echo "<td><span class=\"tabletext\">&nbsp;</td>";
					echo "<td><span class=\"tabletext\">&nbsp;</td>";
					echo "<td><span class=\"tabletext\">&nbsp;</td>";
					echo "<td><span class=\"tabletext\">&nbsp;</td>";

					 echo "<td><span class=\"tabletext\">&nbsp;</td>";


					echo "<td><span class=\"tabletext\">&nbsp;</td>";
					echo "<td><span class=\"tabletext\">$myrow[9]</td>";
					echo "<td><span class=\"tabletext\">$myrow[10]</td>";
					if($dnbal < 0)
				  {
						$color='#ff0033';
				  }
				elseif($dnbal == 0)
				  {
					   $color='#669966';
				  }				  
				else
				  {
						$color='#FFFFFF';
				  }
					echo "<td bgcolor=$color><span class=\"tabletext\">$dnbal</td>";
					echo "<td><span class=\"tabletext\">&nbsp;</td>";
				  }
              }              
              $prev_ponum = $myrow[1];
			  $pre_crn = $myrow[4];
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
        
      </FORM>
</body>
</html>

