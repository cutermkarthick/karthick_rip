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
$_SESSION['pagename'] = 'viewGrnSummary';
//////session_register('pagename');
$dept =  $_SESSION['department'];

// First include the class definition
include_once('classes/userClass.php');
include_once('classes/grnclass.php');
include_once('classes/displayClass.php');

$newgrn = new grn;
$newdisplay = new display;
$newdisplay = new display;

$cond0 = "g.grnnum like '%'";
$cond2 = "c.name like '%'";
$cond3 = "(g.grntype like '%' || g.grntype is NULL)";

$cond4 =  "(to_days(g.recieved_date)-to_days('1582-01-01') > 0 ||
                   g.recieved_date = '0000-00-00' ||
                    g.recieved_date = 'NULL' ) and
           (to_days(g.recieved_date)-to_days('2050-12-31') < 0 ||
                    g.recieved_date = '0000-00-00' ||
                    g.recieved_date = 'NULL')";
$cond5 = "(g.crn like '%' || g.crn is NULL)";
$cond6 = "(g.status like '%' || g.status is NULL || g.status = '')";
$cond7 = "g.invoice_num like '%'";

$cond = $cond0 . ' and ' . $cond2 . ' and ' . $cond3 . ' and ' . $cond4 . 'and' . $cond5 . ' and ' . $cond6 . ' and ' . $cond7;

$final_insprecnum='';
$oper1='like';
$oper2='like';
$oper3='like';
$oper4='like';
$oper5='like';
$oper6='like';
$oper7='like';
$sort1='GRN Num';

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

     $cond0 = "g.grnnum " . $oper1 . " " . $final_refno;

}
else {
     $finalref_match = '';
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

     $cond2 = "c.name " . $oper3 . " " . $final_cust;

}
else {
     $cust_match = '';
}

if ( isset ( $_REQUEST['final_crn'] ) )
{
     $crn_match = $_REQUEST['final_crn'];
     if ( isset ( $_REQUEST['crn_oper'] ) ) {
          $oper7 = $_REQUEST['crn_oper'];
     }
     else {
         $oper7 = 'like';
     }
     if ($oper7 == 'like') {
         $final_crn = "'" . $_REQUEST['final_crn'] . "%" . "'";
     }
     else {
         $final_crn = "'" . $_REQUEST['final_crn'] . "'";
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

if ( isset ( $_REQUEST['final_type'] ) )
{
     $type_match = $_REQUEST['final_type'];
     if ( isset ( $_REQUEST['type_oper'] ) ) {
          $oper6 = $_REQUEST['type_oper'];
     }
     else {
         $oper6 = 'like';
     }
     if ($oper6 == 'like') {
         $final_type = "'" . $_REQUEST['final_type'] . "%" . "'";
     }
     else {
         $final_type = "'" . $_REQUEST['final_type'] . "'";
     }
     if($type_match=='')
         $cond3 = "(g.grntype " . $oper6 . " " . $final_type ." || g.grntype is null)" ;
     else
         $cond3 = "g.grntype " . $oper6 . " " . $final_type ;
}
else {
    $type_match = '';
}

if ( isset ( $_REQUEST['rdate1'] ) || isset ( $_REQUEST['rdate2'] ) )
{
     $rdate1_match = $_REQUEST['rdate1'];
     $rdate2_match = $_REQUEST['rdate2'];
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

if(isset ($_REQUEST['status_val'] ) )
{
     $sval = $_REQUEST['status_val'];

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
else
{
     $sval = 'Open';
     $cond6 = "(g.status = '" . $sval . "' || g.status is NULL || g.status = '')";
}

if ( isset ( $_REQUEST['final_inv'] ) )
{
     $finalinv_match = $_REQUEST['final_inv'];
     if ( isset ( $_REQUEST['inv_oper'] ) ) {
          $oper8 = $_REQUEST['inv_oper'];
     }
     else {
         $oper8 = 'like';
     }
     if ($oper8 == 'like') {
         $final_inv = "'" . $_REQUEST['final_inv'] . "%" . "'";
     }
     else {
         $final_inv = "'" . $_REQUEST['final_inv'] . "'";
     }

     $cond7 = "g.invoice_num " . $oper8 . " " . $final_inv;

}
else {
     $finalinv_match = '';
}



if ( isset ( $_REQUEST['sortfld1'] ) ) {
    $sort1 = $_REQUEST['sortfld1'];

}

$cond = $cond0 . ' and ' . $cond2 . ' and ' . $cond3 . ' and ' . $cond4 . ' and ' . $cond5 . ' and ' . $cond6 . ' and ' . $cond7;
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
<form action='viewGrnSummary.php' method='post' enctype='multipart/form-data'>
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
          <tr><td><span class="heading"><i>Please click on the GRN Number to Edit/Delete</i></td></tr>
		</tr>
  <tr>
<td>

<table width=100% border=0 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF">
  <tr>
	<td bgcolor="#F5F6F5" colspan="13"><span class="heading"><b><center>Search & SortCriteria</center></b></td>
    <td bgcolor="#FFFFFF" rowspan=4 align="center">
	<input type= "image" name="submit" src="images/bu-get.gif" value="Get" onclick="javascript: return searchsort_fields()">


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
</select></td>

<td bgcolor="#FFFFFF"><input type="text" name="final_refno" size=15 value="<?php echo $finalref_match ?>" onkeypress="javascript: return checkenter(event)">
</td>

<td bgcolor="#FFFFFF"><span class="labeltext"><b>Supplier</b></td>

<td bgcolor="#FFFFFF"><span class="tabletext"><select name="cust_oper" size="1" width="50">
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
</select></td>

<td bgcolor="#FFFFFF"><input type="text" name="final_cust" size=15 value="<?php echo $cust_match ?>" onkeypress="javascript: return checkenter(event)">
</td>
<td bgcolor="#FFFFFF"><span class="labeltext"><b>PRN</b></td>

<td bgcolor="#FFFFFF"><span class="tabletext"><select name="crn_oper" size="1" width="50">
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
</select></td>

<td colspan=5 bgcolor="#FFFFFF"><input type="text" name="final_crn" size=15 value="<?php echo $crn_match ?>" onkeypress="javascript: return checkenter(event)">
</td>
</tr>

 <tr>
<td colspan=3 bgcolor="#FFFFFF"><span class="labeltext"><b>Recd Date:  From &nbsp&nbsp</b>
        <input type="text" name="rdate1" size=10 value="<?php echo $rdate1_match ?>"
         onkeypress="javascript: return checkenter(event)">
        <img src="images/bu-getdateicon.gif" alt="Get Date" onclick='GetDate("rdate1")'>
         <span class="labeltext"><b>&nbsp;&nbsp;To</b>
        <input type="text" name="rdate2" size=10 value="<?php echo $rdate2_match ?>"
         onkeypress="javascript: return checkenter(event)">
        <img src="images/bu-getdateicon.gif" alt="Get Date" onclick='GetDate("rdate2")'>
</td>


<td bgcolor="#FFFFFF"><span class="labeltext"><b>GRN Type</b></td>

<td bgcolor="#FFFFFF"><span class="tabletext"><select name="type_oper" size="1" width="50">
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
</select></td>

<td colspan=1 bgcolor="#FFFFFF"><input type="text" name="final_type" size=15 value="<?php echo $type_match ?>" onkeypress="javascript: return checkenter(event)">
</td>
<td bgcolor="#FFFFFF" colspan=7><span class="labeltext"><b>Sort on</b>
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
<td bgcolor="#FFFFFF"><span class="tabletext"><select name="status_val" size="1" width="100">
<?php
      if ($sval == 'Open')
      {
?>
	<option selected>Open
	<option value>Closed
	<option value>Cancelled
    <option value>All
<?php
      }
      else if ($sval == 'Closed')
      {
?>
	<option selected>Closed
	<option value>Open
	<option value>Cancelled
    <option value>All
<?php
      }
      else if ($sval == 'Cancelled')
      {
?>
	<option selected>Cancelled
	<option value>Open
    <option value>Closed
    <option value>All
<?php
      }
      else if ($sval == 'All')
      {
?>
	<option selected>All
	<option value>Open
    <option value>Closed
    <option value>Cancelled

<?php
      }
?>
</select>
</td>
<td bgcolor="#FFFFFF" colspan=11><span class="labeltext"><b>Invoice #</b>&nbsp;&nbsp;&nbsp;&nbsp;
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
<input type="text" name="final_inv" size=15 value="<?php echo $finalinv_match ?>" onkeypress="javascript: return checkenter(event)">
</td>

</tr>

</table>
<tr><td>
<table width=100% border=0>
  <tr>
  <td><span class="pageheading"><b>List of GRN</b></td>
  <td colspan=200>&nbsp;</td>

<td>&nbsp;
  </td>
</tr>
</table>

<table style="table-layout: fixed" width=1190px border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF"  >
        <tr  bgcolor="#FFCC00">
            <td width=60px bgcolor="#EEEFEE"><span class="tabletext"><b>GRN</b></td>
            <td width=63px bgcolor="#EEEFEE"><span class="tabletext"><b>Type</b></td>
            <td width=65px bgcolor="#EEEFEE"><span class="tabletext"><b>PRN</b></td>
            <td width=60px bgcolor="#EEEFEE"><span class="tabletext"><b>Status</b></td>
            <td width=80px bgcolor="#EEEFEE"><span class="tabletext"><b>Ship Date</b></td>
            <td width=80px bgcolor="#EEEFEE"><span class="tabletext"><b>Recd Date</b></td>
            <td width=200px bgcolor="#EEEFEE"><span class="tabletext"><b>Supplier</b></td>
            <td width=200px bgcolor="#EEEFEE"><span class="tabletext"><b>RM Spec</b></td>
            <td width=145px bgcolor="#EEEFEE"><span class="tabletext"><b>RM Type</b></td>
            <td width=95px bgcolor="#EEEFEE"><span class="tabletext"><b>Inv #</b></td>
            <td width=80px bgcolor="#EEEFEE"><span class="tabletext"><b>Inv Dt</b></td>
            <td width=45px bgcolor="#EEEFEE"><span class="tabletext"><b>Bal</b></td>


        </tr>
</table>
<div style="width:1210px; height:270; overflow:auto;border:" id="dataList">

<table style="table-layout: fixed" width=1190px border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >

<?php

     $result = $newgrn->getgrns($cond,$offset,$sort1,$rowsPerPage);

            while ($myrow = mysql_fetch_row($result)) {
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
            $balance = $myrow[12] + $woretqty - $woqty;
   	       printf('<tr bgcolor="#FFFFFF"><td width=60px><span class="tabletext">
                          <a href="viewGrnDetails.php?grnrecnum=%s">%s</td>
                          <td width=63px><span class="tabletext">%s</td>
                          <td width=65px><span class="tabletext">%s</td>
                          <td width=60px><span class="tabletext">%s</td>
                          <td width=80px><span class="tabletext">%s</td>
                          <td width=80px><span class="tabletext">%s</td>
                          <td width=200px><span class="tabletext">%s</td>
                          <td width=200px><span class="tabletext">%s</td>
                          <td width=145px><span class="tabletext">%s</td>
                          <td width=95px><span class="tabletext">%s</td>
                          <td width=80px><span class="tabletext">%s</td>


                         ',
		         $myrow[0],$myrow[1],
                         $myrow[8],
                         $myrow[10],
                         $myrow[11],
                         $date2,
                         $date1,
                         wordwrap($myrow[2],25,"<br /> \n"),
                         wordwrap($myrow[3],25,"<br /> \n"),
                         $myrow[4],
                         $myrow[6],
                         $date);

            if ($balance <= 0)
             {
                printf('<td width=45px  bgcolor="#FF0000"><span class="tabletext">%d</td>',$balance);
             }
             else
             {
                printf('<td width=45px bgcolor="#FFFFFF"><span class="tabletext">%d</td>',$balance);
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
      </div>
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
$numrows = $newgrn->getgrnCount($cond,$offset,$rowsPerPage);
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
    $prev = " <a href=\"viewGrnSummary.php?page=$page&totpages=$totpages&final_refno=$finalref_match&final_cust=$cust_match&final_type=$type_match&rdate1=$rdate1_match&rdate2=$rdate2_match&final_crn=$crn_match&sortfld1=$sort1&final_inv=$finalinv_match\">[Prev]</a> ";

    $first = " <a href=\"viewGrnSummary.php?page=1&totpages=$totpages&final_refno=$finalref_match&final_cust=$cust_match&final_type=$type_match&rdate1=$rdate1_match&rdate2=$rdate2_match&final_crn=$crn_match&sortfld1=$sort1&final_inv=$finalinv_match\">[First Page]</a> ";
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
    $next = " <a href=\"viewGrnSummary.php?page=$page&totpages=$totpages&final_refno=$finalref_match&final_cust=$cust_match&final_type=$type_match&rdate1=$rdate1_match&rdate2=$rdate2_match&final_crn=$crn_match&sortfld1=$sort1&final_inv=$finalinv_match\">[Next]</a> ";

    $last = " <a href=\"viewGrnSummary.php?page=$totpages&totpages=$totpages&final_refno=$finalref_match&final_cust=$cust_match&final_type=$type_match&rdate1=$rdate1_match&rdate2=$rdate2_match&final_crn=$crn_match&sortfld1=$sort1&final_inv=$finalinv_match\">[Last Page]</a> ";
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

