<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = June 20, 2004                =
// Filename: grnsummary.php                    =
// Copyright of Fluent Technologies            =
// Revision: v1.0 WMS                          =
// Displays list of GRNs.                      =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];
$_SESSION['pagename'] = 'grn_summary';
$page="Stores: GRN";
//////session_register('pagename');
$dept =  $_SESSION['department'];

// First include the class definition
include_once('classes/userClass.php');
include_once('classes/grnclass.php');
include_once('classes/displayClass.php');
//echo $_SESSION['pagenum']."----===---";
$newgrn = new grn;
$newdisplay = new display;
$newdisplay = new display;

$cond0 = "g.grnnum like '".$_SESSION['final_grn']."%'";
$cond2 = "c.name like '".$_SESSION['final_cust']."%'";
$cond3 = "(g.grntype like '".$_SESSION['final_type']."%')";

$cond4 =  "(to_days(g.recieved_date)-to_days('1582-01-01') > 0 ||
                   g.recieved_date = '0000-00-00' ||
                    g.recieved_date = 'NULL' ) and
           (to_days(g.recieved_date)-to_days('2050-12-31') < 0 ||
                    g.recieved_date = '0000-00-00' ||
                    g.recieved_date = 'NULL')";
$cond5 = "(g.crn like '".$_SESSION['final_crn']."%')";
$cond6 = "(g.status like '".$_SESSION['status_val_grn']."%' || g.status is NULL || g.status = '')";
$cond7 = "g.invoice_num like '".$_SESSION['final_inv']."%'";
if($_SESSION['final_po']!='')
{
  $cond8 = "g.cimponum like '".$_SESSION['final_po']."%'";
}else
{
  $cond8 = "(g.cimponum like '%' || g.cimponum is NULL || g.cimponum = '')";
}if($_SESSION['final_polinenum']!='')
{
  $cond9 = "(g.rmpolinenum like '".$_SESSION['final_polinenum']."%')";

}else
{
 $cond9 = "(g.rmpolinenum like '%'  || g.rmpolinenum is NULL || g.rmpolinenum = '')";

}
if($_SESSION['final_rawtype']!='')
{
  $cond10 = "g.raw_mat_type like '".$_SESSION['final_rawtype']."%'";
}else
{
  $cond10 = "(g.raw_mat_type like '%' || g.raw_mat_type is NULL || g.raw_mat_type = '')";
 }
  if($_SESSION['final_rawmtl']!='')
{
  $cond11 = "g.raw_mat_spec like '".$_SESSION['final_rawmtl']."%'";
}else
{
  $cond11 = "(g.raw_mat_spec like '%' || g.raw_mat_spec is NULL || g.raw_mat_spec = '')";
}

$cond = $cond0 . ' and ' . $cond2 . ' and ' . $cond3 . ' and ' . $cond4 . 'and' . $cond5 . ' and ' . $cond6 . ' and ' . $cond7. ' and ' . $cond8 . ' and ' . $cond9. ' and ' . $cond10 . ' and ' . $cond11;

$final_insprecnum='';
$oper1='like';
$oper2='like';
$oper3='like';
$oper4='like';
$oper5='like';
$oper6='like';
$oper7='like';
$oper8='like';
$oper9='like';
$oper10='like';
$oper11='like';
$oper12='like';
$sort1='GRN Num';

if(isset ( $_SESSION['final_grn'] ))
{
     $finalref_match = $_SESSION['final_grn'];
}

if ( isset ( $_REQUEST['final_grn'] ) )
{
     $finalref_match = $_REQUEST['final_grn'];
     $_SESSION['final_grn'] = $finalref_match;

     if ( isset ( $_REQUEST['refno_oper'] ) ) {
          $oper1 = $_REQUEST['refno_oper'];
     }
     else {
         $oper1 = 'like';
     }
     if ($oper1 == 'like') {
         $final_refno = "'" . $_SESSION['final_grn'] . "%" . "'";
     }
     else {
         $final_refno = "'" . $_SESSION['final_grn'] . "'";
     }

     $cond0 = "g.grnnum " . $oper1 . " " . $final_refno;

}
else {
     $finalref_match = '';
}


if(isset ( $_SESSION['final_cust'] ))
{
     $cust_match = $_SESSION['final_cust'];
}

if ( isset ( $_REQUEST['final_cust'] ) )
{
     $cust_match = $_REQUEST['final_cust'];
     $_SESSION['final_cust']= $cust_match;
     if ( isset ( $_REQUEST['cust_oper'] ) ) {
          $oper3 = $_REQUEST['cust_oper'];
     }
     else {
         $oper3 = 'like';
     }
     if ($oper3 == 'like') {
         $final_cust = "'" . $_SESSION['final_cust'] . "%" . "'";
     }
     else {
         $final_cust = "'" . $_SESSION['final_cust'] . "'";
     }

     $cond2 = "c.name " . $oper3 . " " . $final_cust;

}
else {
     $cust_match = '';
}
if(isset ( $_SESSION['final_crn'] ))
{
     $crn_match=$_SESSION['final_crn'];
}
if ( isset ( $_REQUEST['final_crn'] ) )
{
     $crn_match = $_REQUEST['final_crn'];
     $_SESSION['final_crn'] =$crn_match;
     if ( isset ( $_REQUEST['crn_oper'] ) ) {
          $oper7 = $_REQUEST['crn_oper'];
     }
     else {
         $oper7 = 'like';
     }
     if ($oper7 == 'like') {
         $final_crn = "'" . $_SESSION['final_crn'] . "%" . "'";
     }
     else {
         $final_crn = "'" . $_SESSION['final_crn'] . "'";
     }
     if($crn_match=='')
         $cond5 = "(g.crn " . $oper7 . " " . $final_crn ." || g.crn is null)" ;
     else
         $cond5 = "g.crn " . $oper7 . " " . $final_crn ;

}
else {
     $crn_match = '';
}
//echo $cond5;
if(isset ( $_SESSION['final_type'] ))
{
   $type_match=$_SESSION['final_type'];
  // echo $type_match."---==--<br>";
}
if ( isset ( $_REQUEST['final_type'] ) )
{
     $type_match = $_REQUEST['final_type'];
     $_SESSION['final_type']= $type_match;
     //echo $type_match."---==--<br>";
     if ( isset ( $_REQUEST['type_oper'] ) ) 
     {
          $oper6 = $_REQUEST['type_oper'];
     }
     else {
         $oper6 = 'like';
     }
     if ($oper6 == 'like') {
         $final_type = "'" . $_SESSION['final_type'] . "%" . "'";
     }
     else {
         $final_type = "'" . $_SESSION['final_type'] . "'";
     }
    // echo $final_type."---=888=--<br>";
     if($type_match=='')
         $cond3 = "(g.grntype " . $oper6 . " " . $final_type ." || g.grntype is null)" ;
     else
         $cond3 = "g.grntype " . $oper6 . " " . $final_type ;
}
else
{
    $type_match = '';
}

if(isset ( $_SESSION['rdate1'] ) || isset ( $_SESSION['rdate2'] ) )
{
      $rdate1_match = $_SESSION['rdate1'];
      $rdate2_match = $_SESSION['rdate2'];
}

if ( isset ( $_REQUEST['rdate1'] ) || isset ( $_REQUEST['rdate2'] ) )
{
     $rdate1_match = $_REQUEST['rdate1'];
     $_SESSION['rdate1'] =$rdate1_match;

     $rdate2_match = $_REQUEST['rdate2'];
     $_SESSION['rdate2'] = $rdate2_match;

     if ( isset ( $_REQUEST['rdate1']) &&  $_REQUEST['rdate1'] != '' )
     {
          $date1 = $_REQUEST['rdate1'];
          $cond41 = "to_days(g.recieved_date) " . "> to_days('" . $date1 . "')";
     }
     else
     {
          $cond41 = "(to_days(g.recieved_date)-to_days('1582-01-01') > 0 || g.recieved_date = 'NULL' || g.recieved_date = '0000-00-00')";
     }

     if ( isset ( $_REQUEST['rdate2'] )  &&  $_REQUEST['rdate2'] != '')
     {
          $date2 = $_REQUEST['rdate2'];
          $cond42 = "to_days(g.recieved_date) " . "< to_days('" . $date2 . "')";
     }
     else
     {
          $cond42 = "(to_days(g.recieved_date)-to_days('2050-12-31') < 0 || g.recieved_date = 'NULL' || g.recieved_date = '0000-00-00')";
     }
     $cond4 = $cond41 . ' and ' . $cond42;

}
else
{
     $rdate1_match = '';
     $rdate2_match = '';
}
if(isset ($_SESSION['status_val_grn'] ))
{
  $sval =$_SESSION['status_val_grn'];
  if ($sval== 'Open')
      {
         $cond6 = "(g.status = '" . $sval . "' || g.status is NULL || g.status = '')";
      }
     else if ($sval == 'Closed')
      {
         $cond6 = "g.status = '" . $sval . "'" ;
      }
     else if ($sval == 'All')
      {
         $cond6 = "(g.status like '%' || g.status is NULL)";
      }
       else if ($sval == 'Cancelled')
      {
         $cond6 = "g.status = '" . $sval . "'" ;
      }
}
if(isset ($_REQUEST['status_val_grn'] ) )
{
     $sval = $_REQUEST['status_val_grn'];
     $_SESSION['status_val_grn'] = $sval;
      if ($sval== 'Open')
      {
         $cond6 = "(g.status = '" . $sval . "' || g.status is NULL || g.status = '')";
      }
     else if ($sval == 'Closed')
      {
         $cond6 = "g.status = '" . $sval . "'" ;
      }
     else if ($sval == 'All')
      {
         $cond6 = "(g.status like '%' || g.status is NULL)";
      }
       else if ($sval == 'Cancelled')
      {
         $cond6 = "g.status = '" . $sval . "'" ;
      }
       else if ($sval == 'Pending')
      {
         $cond6 = "g.status = '" . $sval . "'" ;
      }
}
/*else if($_SESSION['status_val'] == 'Closed')
{
    $cond6 = "g.status = '" . $sval . "'" ;
} */
else if(!isset ( $_SESSION['status_val_grn'] ))
{
     $sval = 'Open';
     $cond6 = "(g.status = '" . $sval . "' || g.status is NULL || g.status = '')";
}



if ( isset ( $_REQUEST['sortfld1'] ) ) {
    $sort1 = $_REQUEST['sortfld1'];

}
if(isset ( $_SESSION['final_inv'] ))
{
   $finalinv_match=$_SESSION['final_inv'];
}
if ( isset ( $_REQUEST['final_inv'] ) )
{
     $finalinv_match = $_REQUEST['final_inv'];
     $_SESSION['final_inv'] = $finalinv_match;
     if ( isset ( $_REQUEST['inv_oper'] ) ) {
          $oper8 = $_REQUEST['inv_oper'];
     }
     else {
         $oper8 = 'like';
     }
     if ($oper8 == 'like') {
         $final_inv = "'" . $_SESSION['final_inv'] . "%" . "'";
     }
     else {
         $final_inv = "'" . $_SESSION['final_inv'] . "'";
     }

     $cond7 = "g.invoice_num " . $oper8 . " " . $final_inv;

}
else {
     $finalinv_match = '';
}
//echo isset ( $_REQUEST['final_po'] )."---***----";
if(isset ( $_SESSION['final_po'] ))
{
   $finalpo_match=$_SESSION['final_po'];
}
if (isset ($_REQUEST['final_po'] ) )
{
     $finalpo_match = $_REQUEST['final_po'];
      $_SESSION['final_po'] = $finalpo_match;
     if ( isset ( $_REQUEST['po_oper'] ) ) {
          $oper9 = $_REQUEST['po_oper'];
     }
     else {
         $oper9 = 'like';
     }
     if ($oper9 == 'like') {
         $final_po = "'" . $_SESSION['final_po'] . "%" . "'";
         //echo $final_po."--222--<br>";
         if($_REQUEST['final_po'] !='')
         {
          $cond8 = "g.cimponum " . $oper9 . " " . $final_po;
         }else
         {
          $cond8 = "(g.cimponum " . $oper9 . " " . $final_po ."|| g.cimponum is NULL || g.cimponum = '')";
         }

     }
     else {
         $final_po = "'" . $_SESSION['final_po'] . "'";
         $cond8 = "g.cimponum " . $oper9 . " " . $final_po;
     }

}
else {
     $finalpo_match = '';
}
if(isset ( $_SESSION['final_polinenum'] ))
{
   $finalpolinenum_match=$_SESSION['final_polinenum'];
}

if ( isset ( $_REQUEST['final_polinenum'] ) )
{
     $finalpolinenum_match = $_REQUEST['final_polinenum'];
     $_SESSION['final_polinenum']= $finalpolinenum_match;
     if ( isset ( $_REQUEST['poli_oper'] ) ) {
          $oper10 = $_REQUEST['poli_oper'];
     }
     else {
         $oper10 = 'like';
     }
     if ($oper10 == 'like') {
     $final_polinenum = "'" . $_SESSION['final_polinenum'] . "%" . "'";
         if($_REQUEST['final_polinenum']!='')
         {
           $cond9 = "(g.rmpolinenum " . $oper10 . " " . $final_polinenum .")";
         }else
         {
            $cond9 = "(g.rmpolinenum " . $oper10 . " " . $final_polinenum ."|| g.rmpolinenum is NULL || g.rmpolinenum = '')";
         }
     
  }



     else {
         $final_polinenum = "'" . $_SESSION['final_polinenum'] . "'";
         if($_REQUEST['final_polinenum']!='')
         {
           $cond9 = "g.rmpolinenum " . $oper10 . " " . $final_polinenum;
         }else
         {
           $cond9 = "g.rmpolinenum " . $oper10 . " " . $final_polinenum;
         }

     }



}
else {
     $finalpolinenum_match = '';
}

if(isset ( $_SESSION['final_rawmtl'] ))
{
   $finalrawmtl_match=$_SESSION['final_rawmtl'];
}

if ( isset ( $_REQUEST['final_rawmtl'] ) )
{
     $finalrawmtl_match = $_REQUEST['final_rawmtl'];
     $_SESSION['final_rawmtl']= $finalrawmtl_match;
     if ( isset ( $_REQUEST['rmspec_oper'] ) ) {
          $oper12 = $_REQUEST['rmspec_oper'];
     }
     else {
         $oper12 = 'like';
     }
     if ($oper12 == 'like') {
     $final_rawmtl = "'" . $_SESSION['final_rawmtl'] . "%" . "'";
         if($_REQUEST['final_rawmtl']!='')
         {
           $cond11 = "(g.raw_mat_spec " . $oper12 . " " . $final_rawmtl .")";
         }else
         {
            $cond11 = "(g.raw_mat_spec " . $oper12 . " " . $final_rawmtl ."|| g.raw_mat_spec is NULL || g.raw_mat_spec = '')";
         }

  }



     else {
         $final_rawmtl = "'" . $_SESSION['final_rawmtl'] . "'";
         if($_REQUEST['final_rawmtl']!='')
         {
           $cond11 = "g.raw_mat_spec " . $oper12 . " " . $final_rawmtl;
         }else
         {
           $cond11 = "g.raw_mat_spec " . $oper12 . " " . $final_rawmtl;
         }

     }



}
else {
     $finalrawmtl_match = '';
}

if(isset ( $_SESSION['final_rawtype'] ))
{
   $finalrawtype_match=$_SESSION['final_rawtype'];
}

if ( isset ( $_REQUEST['final_rawtype'] ) )
{
     $finalrawtype_match = $_REQUEST['final_rawtype'];
     $_SESSION['final_rawtype']= $finalrawtype_match;
     if ( isset ( $_REQUEST['rmtype_oper'] ) ) {
          $oper11 = $_REQUEST['rmtype_oper'];
     }
     else {
         $oper11 = 'like';
     }
     if ($oper11 == 'like') {
     //echo $_SESSION['final_rawtype']."----inty---";
     $final_rawtype = "'" . $_SESSION['final_rawtype'] . "%" . "'";
         if($_REQUEST['final_rawtype']!='')
         {
           $cond10 = "(g.raw_mat_type " . $oper11 . " " . $final_rawtype .")";
         }else
         {
            $cond10 = "(g.raw_mat_type " . $oper11 . " " . $final_rawtype ."|| g.raw_mat_type is NULL || g.raw_mat_type = '')";
         }

  }



     else {
         $final_rawtype = "'" . $_SESSION['final_rawtype'] . "'";
         if($_REQUEST['final_rawtype']!='')
         {
           $cond10 = "g.raw_mat_type " . $oper11 . " " . $final_rawtype;
         }else
         {
           $cond10 = "g.raw_mat_type " . $oper11 . " " . $final_rawtype;
         }

     }



}
else {
     $finalrawtype_match = '';
}







$cond = $cond0 . ' and ' . $cond2 . ' and ' . $cond3 . ' and ' . $cond4 . ' and ' . $cond5 . ' and ' . $cond6 . ' and ' . $cond7 . ' and ' . $cond8 . ' and ' . $cond9. ' and ' . $cond10 . ' and ' . $cond11;
$userrole = $_SESSION['userrole'];

// echo $cond;
// how many rows to show per page
$rowsPerPage =100;

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
<script language="javascript" src="scripts/grn.js"></script>

<html>
<head>
<title>GRN Summary</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">
<form action='grn_summary.php' method='post' enctype='multipart/form-data'>
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
 <table width=100% border=0 cellpadding=1 cellspacing=0>
    
          <tr><td><span class="heading"><i>Please click on the GRN Number to Edit/Delete</i></td></tr>
<table style="width:100%" border=0 cellpadding=1 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1">
  <tr>
	<td bgcolor="#F5F6F5" colspan="6"><span class="heading"><b><center>Search & SortCriteria</center></b></td>
    <td bgcolor="#FFFFFF" rowspan=5 align="center">
	<button class="stdbtn btn_blue" style="padding:2px;margin-right:5px;" onClick="javascript: return searchsort_fields()" >Get</button>


<input type="hidden" name="refno_oper">
<input type="hidden" name="wono_oper">
<input type="hidden" name="cust_oper">
<input type="hidden" name="partno_oper">
<input type="hidden" name="pono_oper">
	</td>
  </tr>
<tr>
<td bgcolor="#FFFFFF"><span class="labeltext"><b>GRN No</b></td>

<td bgcolor="#FFFFFF"><span class="tabletext"><select name="refno_oper" size="1" width="20">
<?php
   if ( isset ( $_REQUEST['refno_oper'] ) ){
          $check2 = $_REQUEST['refno_oper'];

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
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="final_grn" size=15 value="<?php echo $_SESSION['final_grn'] ?>" onkeypress="javascript: return checkenter(event)">
</td>

<td bgcolor="#FFFFFF" width=2%><span class="labeltext"><b>Supplier</b>
&nbsp;&nbsp;&nbsp;&nbsp;<select name="cust_oper" size="1">
<?php
   if ( isset ( $_REQUEST['cust_oper'] ) ){
          $check2 = $_REQUEST['cust_oper'];

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
 <?php
  }
 ?>
</select>
</td>
<td bgcolor="#FFFFFF">
<input type="text" name="final_cust" size=15 value="<?php echo $_SESSION['final_cust'] ?>" onkeypress="javascript: return checkenter(event)">
</td>
<td bgcolor="#FFFFFF"><span class="labeltext"><b>PRN</b>&nbsp;&nbsp;&nbsp;&nbsp;<select name="crn_oper" size="1" width="50">
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
 <?php
  }
 ?>
</select>&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="final_crn" size=15 value="<?php echo $_SESSION['final_crn'] ?>" onkeypress="javascript: return checkenter(event)">
</td>
</tr>

 <tr>
<td colspan=3 bgcolor="#FFFFFF"><span class="labeltext"><b>Recd Date:  From &nbsp&nbsp</b>
        <input type="text" name="rdate1" size=10 value="<?php echo $_SESSION['rdate1'] ?>"
         onkeypress="javascript: return checkenter(event)">
        <img src="images/bu-getdateicon.gif" alt="Get Date" onclick='GetDate("rdate1")'>
         <span class="labeltext"><b>&nbsp;&nbsp;To</b>
        <input type="text" name="rdate2" size=10 value="<?php echo $_SESSION['rdate2'] ?>"
         onkeypress="javascript: return checkenter(event)">
        <img src="images/bu-getdateicon.gif" alt="Get Date" onclick='GetDate("rdate2")'>
</td>


<td bgcolor="#FFFFFF"><span class="labeltext"><b>GRN Type</b>&nbsp;&nbsp;&nbsp;&nbsp;<select name="type_oper" size="1" width="50">
<?php
   if ( isset ( $_REQUEST['type_oper'] ) ){
          $check2 = $_REQUEST['type_oper'];

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
 <?php
  }
 ?>
</select>&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="final_type" size=15 value="<?php echo $_SESSION['final_type'] ?>" onkeypress="javascript: return checkenter(event)">
</td>
<td bgcolor="#FFFFFF"><span class="labeltext"><b>Sort on</b>&nbsp;&nbsp;&nbsp;&nbsp;
<span class="tabletext"><select name="sort1" size="1" width="100">
<?php
      if ($sort1=='GRN Num')
      {
?>
	<option selected>GRN Num
       	<option>Received Date

<?php
      }
      else 
      {
?>
	<option selected>Received Date
       	<option>GRN Num
<?php
      }
?>

</select>
<input type="hidden" name="sortfld1">
</td>
</tr>
<tr>
<td bgcolor="#FFFFFF"><span class="labeltext"><b>Status</b></td>
<td bgcolor="#FFFFFF"><span class="tabletext"><select name="status_val_grn" size="1" width="100">
<?php
      if ($sval == 'Open')
      {
?>
	<option selected value="Open">Open
	<option value="Closed">Closed
	<option value="Cancelled">Cancelled
    <option value="All">All
    <option value="Pending">Pending
<?php
      }
      else if ($sval == 'Closed')
      {
?>
	<option selected value="Closed">Closed
	<option value="Open">Open
	<option value="Cancelled">Cancelled
    <option value="All">All
    <option value="Pending">Pending
<?php
      }
      else if ($sval == 'Cancelled')
      {
?>
	<option selected value="Cancelled">Cancelled
	<option value="Open">Open
    <option value="Closed">Closed
    <option value="All">All
    <option value="Pending">Pending
<?php
      }
      else if ($sval == 'All')
      {
?>
	<option selected value="All">All
	<option value="Open">Open
    <option value="Closed">Closed
    <option value="Cancelled">Cancelled
    <option value="Pending">Pending

<?php
      }
else if ($sval == 'Pending')
      {
?>
	<option selected value="Pending">Pending
	<option value="Open">Open
    <option value="Closed">Closed
    <option value="Cancelled">Cancelled
    <option value="All">All
<?php
      }
?>
</select>
</td>
<td bgcolor="#FFFFFF"><span class="labeltext"><b>Invoice #</b>&nbsp;&nbsp;&nbsp;&nbsp;
<span class="tabletext"><select name="inv_oper" size="1" width="20">
<?php
   if ( isset ( $_REQUEST['inv_oper'] ) ){
          $check2 = $_REQUEST['inv_oper'];

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
<input type="text" name="final_inv" size=15 value="<?php echo $_SESSION['final_inv']  ?>" onkeypress="javascript: return checkenter(event)">
</td>

<td bgcolor="#FFFFFF"><span class="labeltext"><b>PO #</b>&nbsp;&nbsp;&nbsp;&nbsp;
<span class="tabletext"><select name="po_oper" size="1" width="20">
<?php
   if ( isset ( $_REQUEST['po_oper'] ) ){
          $check2 = $_REQUEST['po_oper'];

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
<input type="text" name="final_po" size=15 value="<?php echo $_SESSION['final_po']?>" onkeypress="javascript: return checkenter(event)">
</td>

<td bgcolor="#FFFFFF"><span class="labeltext"><b>PO Line #</b>&nbsp;&nbsp;&nbsp;&nbsp;
<span class="tabletext"><select name="poli_oper" size="1" width="20">
<?php
   if ( isset ( $_REQUEST['poli_oper'] ) ){
          $check2 = $_REQUEST['poli_oper'];

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
<input type="text" name="final_polinenum" size=8 value="<?php echo $_SESSION['final_polinenum'] ?>" onkeypress="javascript: return checkenter(event)">
</td>

</tr>
<tr>
<td bgcolor="#FFFFFF"><span class="labeltext"><b>Raw Mtl Spec &nbsp</b></td>&nbsp&nbsp&nbsp&nbsp
<td bgcolor="#FFFFFF"><select name="rmspec_oper" size="1" width="100">
<?php
      if ($oper12 == 'like')
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
&nbsp&nbsp&nbsp&nbsp<input type="text" name="final_rawmtl" id="final_rawmtl" size=20 value="<?php echo $_SESSION['final_rawmtl'] ?>" onKeyPress="javascript: return checkenter(event)">
</td>

<td colspan=3 bgcolor="#FFFFFF"><span class="labeltext"><b>Raw Matl Type&nbsp&nbsp</b>&nbsp&nbsp&nbsp&nbsp<span class="tabletext">
<select name="rmtype_oper" size="1" width="100">
<?php
      if ($oper11 == 'like')
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
&nbsp&nbsp&nbsp&nbsp<input type="text" name="final_rawtype" id="final_rawtype" size=20 value="<?php echo $_SESSION['final_rawtype'] ?>" onKeyPress="javascript: return checkenter(event)">
</td>
</tr>

</table>
<tr><td>
<table style="width:100%" border=0>
 <div class="contenttitle radiusbottom0" style="width:100%">
  <h2><span>List of GRN
 <?php
if($dept == 'Sales' || $dept == 'Stores')
{
?>
 <input type="button" class="stdbtn btn_blue" style="float:right;padding:2px;margin-right:5px;" onClick="location.href='new_grn.php'" value="New GRN" >
 <!-- <a href ="new_grn.php"><img name="Image8" style="float:right" border="0" src="images/new_grn.gif"></a> -->
 <?php
}
else
{
?>
<td>&nbsp;
</td>
<?php
}
?>
</tr>

</table>

<table style="width:100%" border=0 cellpadding=3 cellspacing=1 class="stdtable">
  <thead>
        <tr>
            <th class="head0"> <span class="tabletext"><b>GRN</b></th>
            <th class="head1"><span class="tabletext"><span class="tabletext"><b>Type</b></th>
            <th class="head0"><span class="tabletext"><b>PRN</b></th>
            <th class="head1"><span class="tabletext"><b>Status</b></th>
            <th class="head0"><span class="tabletext"><b>Ship Date</b></th>
            <th class="head1"><span class="tabletext"><b>Recd Date</b></th>
            <th class="head0"><span class="tabletext"><b>Supplier</b></th>
            <th class="head1"><span class="tabletext"><b>RM Spec</b></th>
            <th class="head0"><span class="tabletext"><b>RM Type</b></th>
            <th class="head1"><span class="tabletext"><b>Inv #</b></th>
            <th class="head0"><span class="tabletext"><b>Inv Dt</b></th>
            <th class="head1"><span class="tabletext"><b>Bal</b></th>
      </tr>
    </thead>

<!-- <div style="height:270; overflow:auto;border:" id="dataList">

<table width=100% border=0 cellpadding=3 cellspacing=1 class="stdtable" > -->

<?php

     $result = $newgrn->getgrns($cond,$offset,$sort1,$rowsPerPage);


            while ($myrow = mysql_fetch_row($result)) {
            
                 $grnli = $newgrn->getgrnli($myrow[0]);
                 $total=0; $i=0;
                 //$myrowli = mysql_fetch_row($grnli);
                 while ($myrowli = mysql_fetch_row($grnli))
  {
      //echo"$myrowli[19]------------";
                 if($myrowli[17] =='')
                 {   //echo"HERE";
                  $total = $total + $myrowli[9];
                 }
  }

            if($myrow[9] != '' && $myrow[9] != '0000-00-00')
               {
                 $datearr = split('-', $myrow[9]);
                 $d=$datearr[2];
                 $m=$datearr[1];
                 $y=$datearr[0];
                 $x=mktime(0,0,0,$m,$d,$y);
                 $date1=date("M j, Y",$x);
               }
               else
               {
                 $date1 = '';
               }
              if($myrow[7] != '' && $myrow[7] != '0000-00-00')
               {
                 $datearr = split('-', $myrow[7]);
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
                if($myrow[13] != '' && $myrow[13] != '0000-00-00')
               {
                 $datearr = split('-', $myrow[13]);
                 $d=$datearr[2];
                 $m=$datearr[1];
                 $y=$datearr[0];
                 $x=mktime(0,0,0,$m,$d,$y);
                 $date2=date("M j, Y",$x);
               }
               else
               {
                 $date2 = '';
               }
            $woqtyres = $newgrn->get_woqty($myrow[1]);
            $woqtyrow = mysql_fetch_row($woqtyres);
            $woqty = $woqtyrow[1];
            $woretqtyres = $newgrn->get_woretqty($myrow[1]);
            $woretqtyrow = mysql_fetch_row($woretqtyres);
            $woretqty = $woretqtyrow[1];
            $balance = 0;
            if ($woretqty == '' && $woretqty == 'NULL')
            {
                $woretqty = 0;
            }

            $balance = $total + $woretqty - $woqty;
            //echo $total."---------------".$woretqty."******************".$woqty."+++++++++++++++++++".$balance."<br>";
   	       printf('<tr bgcolor="#FFFFFF"><td width=8%% align="center"><span class="tabletext">
                          <a href="grn_details.php?grnrecnum=%s">%s</td>
                          <td width=7%% align="center"><span class="tabletext">%s</td>
                          <td width=8%% align="center"><span class="tabletext">%s</td>
                          <td width=8%% align="center"><span class="tabletext">%s</td>
                          <td width=6%% align="center"><span class="tabletext">%s</td>
                          <td width=7%% align="center"><span class="tabletext">%s</td>
                          <td width=7%% align="center"><span class="tabletext">%s</td>
                          <td width=7%% align="center"><span class="tabletext">%s</td>
                          <td width=7%% align="center"><span class="tabletext">%s</td>
                          <td width=7%% align="center"><span class="tabletext">%s</td>
                          <td width=7%% align="center"><span class="tabletext">%s</td>


                         ',
		                 $myrow[0],$myrow[1],
                         $myrow[8],
                          wordwrap($myrow[10],8,"<br /> \n",true),
                         $myrow[11],
                         $date2,
                         $date1,
                         wordwrap($myrow[2],25,"<br /> \n",true),
                         wordwrap($myrow[3],25,"<br /> \n",true),
                         $myrow[4],
                         $myrow[6],
                         $date);
          
            if ($balance <= 0)
             {
                printf('<td width=7%%  align="center" bgcolor="#FF0000"><span class="tabletext">%d</td>',$balance);
             }
             else
             {
                printf('<td width=7%% align="center" bgcolor="#FFFFFF"><span class="tabletext">%d</td>',$balance);
             }

               printf('</tr>');

            }



             if($myrow[14] != '' && $myrow[14] != '0000-00-00')
             {
              $datearr = split('-', $myrow[14]);
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


?>
</table>

      </table>
      </table>
      <!-- </div> -->
    <!--      <td width="6"><img src="images/spacer.gif " width="6"></td>
			</tr>
                <tr bgcolor="DEDFDE">
  				<td width="6"><img src="images/box-left-bottom.gif"></td>
				<td><img src="images/spacer.gif " height="6"></td>
				<td width="6"><img src="images/box-right-bottom.gif"></td>
			</tr> -->

        </table>
        <table border = 0 cellpadding=0 cellspacing=0 width=100% >
							<tr>
								<td align=left>

<?php
$numrows = $newgrn->getgrnCount($cond,$offset,$rowsPerPage);
//echo $numrows;
    $spage=$_SESSION['pagenum'];
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

    $prev = " <a href=\"grn_summary.php?page=$page&totpages=$totpages&final_refno=$finalref_match&final_cust=$cust_match&final_type=$type_match&rdate1=$rdate1_match&rdate2=$rdate2_match&final_crn=$crn_match&sortfld1=$sort1&final_inv=$finalinv_match&final_po=$finalpo_match&final_polinenum=$finalpolinenum_match&final_rawmtl=$finalrawmtl_match&final_rawtype=$finalrawtype_match\">[Prev]</a> ";

    $first = " <a href=\"grn_summary.php?page=1&totpages=$totpages&final_refno=$finalref_match&final_cust=$cust_match&final_type=$type_match&rdate1=$rdate1_match&rdate2=$rdate2_match&final_crn=$crn_match&sortfld1=$sort1&final_inv=$finalinv_match&final_po=$finalpo_match&final_polinenum=$finalpolinenum_match&final_rawmtl=$finalrawmtl_match&final_rawtype=$finalrawtype_match\">[First Page]</a> ";
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

    $next = " <a href=\"grn_summary.php?page=$page&totpages=$totpages&final_grn=$finalref_match&final_cust=$cust_match&final_type=$type_match&rdate1=$rdate1_match&rdate2=$rdate2_match&final_crn=$crn_match&sortfld1=$sort1&final_inv=$finalinv_match&final_po=$finalpo_match&final_polinenum=$finalpolinenum_match&final_rawmtl=$finalrawmtl_match&final_rawtype=$finalrawtype_match\">[Next]</a> ";

    $last = " <a href=\"grn_summary.php?page=$totpages&totpages=$totpages&final_grn=$finalref_match&final_cust=$cust_match&final_type=$type_match&rdate1=$rdate1_match&rdate2=$rdate2_match&final_crn=$crn_match&sortfld1=$sort1&final_inv=$finalinv_match&final_po=$finalpo_match&final_polinenum=$finalpolinenum_match&final_rawmtl=$finalrawmtl_match&final_rawtype=$finalrawtype_match\">[Last Page]</a> ";
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

