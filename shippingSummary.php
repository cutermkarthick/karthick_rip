<?php
//==============================================
// Author: FSI                                 =
// Date-written =  Dec 08, 2006                =
// Filename: invoiceSummary.php                =
// Copyright of Badari Mandyam, FluentSoft     =
// Revision: v1.0 OWT                          =
// Displays list of invoice.                   =
//==============================================

session_start();
header("Cache-control: private");
if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];

$_SESSION['pagename'] = 'shippingsummary';
$page = "Invoice: Excise";
//////session_register('pagename');

//Following code added to implement search,sort  and Pagination on Dec 29-04 by Jerry George

$cond0 = " s.shipping_id like '%'";
//$cond1 = " dl.wonum like '%'";
$cond2 =  "(to_days(s.createdate)-to_days('1582-01-01') > 0 ||
                   s.createdate = '0000-00-00' ||
                    s.createdate = 'NULL' ) and
           (to_days(s.createdate)-to_days('2050-12-31') < 0 ||
                    s.createdate = '0000-00-00' ||
                    s.createdate = 'NULL')";
//$cond3 = " s.i like '%'";
//$cond4 = "(d.type = 'Manufacture Only' || d.type = '' || d.type is NULL)";
//$cond5 = " p.cim_invoice like '%'";

//$cond = $cond0 . ' and ' . $cond2 . ' and ' . $cond3. ' and ' . $cond5;
$cond = $cond0 . ' and ' . $cond2;

//$final_insprecnum='';
$oper1='like';
$oper2='like';
$oper3='like';
$sort1='p.packingnum';



if ( isset ( $_REQUEST['final_relno'] ) )
{
     $finalrel_match = $_REQUEST['final_relno'];
     if ( isset ( $_REQUEST['rel_oper'] ) ) {
          $oper1 = $_REQUEST['rel_oper'];
     }
     else {
         $oper1 = 'like';
     }
     if ($oper1 == 'like') {
         $final_relno = "'" . $_REQUEST['final_relno'] . "%" . "'";
     }
     else {
         $final_relno = "'" . $_REQUEST['final_relno'] . "'";
     }

     $cond0 = "s.shipping_id " . $oper1 . " " . $final_relno;

}
else {
     $finalrel_match = '';
}


if ( isset ( $_REQUEST['final_crn'] ) )
{
     $final_crnmatch = $_REQUEST['final_crn'];
     if ( isset ( $_REQUEST['crn_oper'] ) ) {
          $oper2 = $_REQUEST['crn_oper'];
     }
     else {
         $oper2 = 'like';
     }
     if ($oper2 == 'like') {
         $final_crn = "'" . $_REQUEST['final_crn'] . "%" . "'";
     }
     else {
         $final_crn = "'" . $_REQUEST['final_crn'] . "'";
     }

     $cond3 = "p.ponum " . $oper2 . " " . $final_crn;

}
else {
     $final_crnmatch = '';
}

if ( isset ( $_REQUEST['final_partnum'] ) )
{
     $final_partnummatch = $_REQUEST['final_partnum'];
     if ( isset ( $_REQUEST['partnum_oper'] ) ) {
          $oper2 = $_REQUEST['partnum_oper'];
     }
     else {
         $oper2 = 'like';
     }
     if ($oper2 == 'like') {
         $final_partnum= "'" . $_REQUEST['final_partnum'] . "%" . "'";
     }
     else {
         $final_partnum = "'" . $_REQUEST['final_partnum'] . "'";
     }

     $cond5 = "p.cim_invoice " . $oper2 . " " . $final_partnum;

}
else {
     $final_partnummatch = '';
}
if ( isset ( $_REQUEST['ddate1'] ) || isset ( $_REQUEST['ddate2'] ) )
{
     $ddate1_match = $_REQUEST['ddate1'];
     $ddate2_match = $_REQUEST['ddate2'];
     if ( isset ( $_REQUEST['ddate1']) &&  $_REQUEST['ddate1'] != '' )
     {
          $date1 = $_REQUEST['ddate1'];
          $cond21 = "to_days(s.createdate) " . "> to_days('" . $date1 . "')";
     }
     else
     {
          $cond21 = "(to_days(s.createdate)-to_days('1582-01-01') > 0 || s.createdate = 'NULL' || s.createdate = '0000-00-00')";
     }

     if ( isset ( $_REQUEST['ddate2'] )  &&  $_REQUEST['ddate2'] != '')
     {
          $date2 = $_REQUEST['ddate2'];
          $cond22 = "to_days(s.createdate) " . "< to_days('" . $date2 . "')";
     }
     else
     {
          $cond22 = "(to_days(s.createdate)-to_days('2050-12-31') < 0 || s.createdate = 'NULL' || s.createdate = '0000-00-00')";
     }
     $cond2 = $cond21 . ' and ' . $cond22;

}
else
{
     $ddate1_match = '';
     $ddate2_match = '';
}

if ( isset ( $_REQUEST['sortfld1'] ) ) {
    $sort1 = $_REQUEST['sortfld1'];

}


//$cond = $cond0 . ' and ' . $cond2 . ' and ' . $cond3. ' and ' . $cond5;
$cond = $cond0 . ' and ' . $cond2;


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

// First include the class definition
include('classes/shippingClass.php');
include_once('classes/displayClass.php');
$newdisplay = new display;
$newshipping = new shipping;
?>
<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/invoice.js"></script>

<html>
<head>
<title>Shipping Summary</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">
<form action='shippingSummary.php' method='post' enctype='multipart/form-data'>
<?php
	include('header.html');
?>
<!-- <table width=100% cellspacing="0" cellpadding="6" border="0">
	<tr>
		<td>
			<table width=100% border=0 cellspacing="0" cellpadding="0">
    				<tr>
       					 <td colspan=2><span class="welcome"><b>Welcome <?php echo $userid?></b></td>
        					<td align="right">&nbsp;<a href="exit.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image15','','images/logout_mo.gif',1)"><img name="Image15" border="0" src="images/logout.gif"></a></td>
    				</tr>
     			</table>
			<table width=100% border=0 cellpadding=0 cellspacing=0  >
				<tr><td></td></tr>
				<tr>
					<td>
						<?php $newdisplay->dispLinks(''); ?>
						<table width=100% border=0 cellpadding=0 cellspacing=0  >
							<tr bgcolor="DEDFDE">
  								<td width="6"><img src="images/spacer.gif " width="6"></td>
								<td bgcolor="#FFFFFF"> -->
									<table width=100% border=0 cellpadding=6 cellspacing=1>
       									<tr><td><span class="heading"><i>Please click on the Shipping id link to Edit</i></td></tr>
									<tr><td>
        <table width=100% border=0 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1">
  <tr>
	<td bgcolor="#F5F6F5" colspan="3"><span class="heading"><b><center>Search Criteria</center></b></td>
    <td bgcolor="#FFFFFF" rowspan=3 align="center">
    <button class="stdbtn btn_blue" style="background-color:#0591e5" onClick="javascript: return searchsort_fields()" >Get</button>
<!-- 	<input type= "image" name="submit" src="images/bu-get.gif" value="Get" onclick="javascript: return searchsort_fields()"> -->


<input type="hidden" name="rel_oper">
<input type="hidden" name="wo_oper">
	</td>
  </tr>
<tr>
<td bgcolor="#FFFFFF"><span class="labeltext"><b>Shipping #</b>
<span class="tabletext"><select name="rel_oper" size="1" width="20">
<?php
   if ( isset ( $_REQUEST['rel_oper'] ) ){
          $check2 = $_REQUEST['rel_oper'];

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
</td>
<td bgcolor="#FFFFFF"><input type="text" name="final_relno" size=10 value="<?php echo $finalrel_match ?>" onkeypress="javascript: return checkenter(event)">
</td>

 <td colspan=1 bgcolor="#FFFFFF"><span class="labeltext"><b>Shipping Date:  From &nbsp&nbsp</b>
        <input type="text" name="ddate1" size=10 value="<?php echo $ddate1_match ?>"
         onkeypress="javascript: return checkenter(event)">
        <img src="images/bu-getdateicon.gif" alt="Get Date" onclick='GetDate("ddate1")'>
         <span class="labeltext"><b>&nbsp;&nbsp;To</b>
        <input type="text" name="ddate2" size=10 value="<?php echo $ddate2_match ?>"
         onkeypress="javascript: return checkenter(event)">
        <img src="images/bu-getdateicon.gif" alt="Get Date" onclick='GetDate("ddate2")'>
</td>

</tr>
 <!--<tr>
 <td bgcolor="#FFFFFF"><span class="labeltext"><b>Invoice#</b>
<span class="tabletext"><select name="partnum_oper" size="1" width="50">
<?php
   if ( isset ( $_REQUEST['partnum_oper'] ) ){
          $check2 = $_REQUEST['partnum_oper'];
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

<td colspan=2 bgcolor="#FFFFFF"><input type="text" name="final_partnum" size=20 value="<?php echo $final_partnummatch ?>" onkeypress="javascript: return checkenter(event)">
</td>


</tr>-->

</table>
									</td></tr>
										<tr><td>
										       <table width=100% border=0>
          	                                   <div class="contenttitle radiusbottom0">
<h2 class="table"><span>
 Shipping Summary
 <input type="button" class="stdbtn btn_blue" style="float:right;padding:2px;margin-right:5px;" onClick="location.href='shippingEntry.php'" value="New Shipping"> 
</span></h2></table>

											<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class='stdtable'>
        												<tr>
                                <thead>
            													<th class="head0"><span class="tabletext"><b>Shipping Id#</b></th>
            													<th class="head1"><span class="tabletext"><b>Shipping Date</b></th>
             								 			     <th class="head0"><span class="tabletext"><b>Invoice #</b></th>
                                       <th class="head1"><span class="tabletext"><b>Invoice Date</b></th>
                                       <th class="head0"><span class="tabletext"><b>Exporter</b></th>
             													<th class="head1"><span class="tabletext"><b>Ship To</b></th>
                                      </tr>
													<?php
													$newlogin = new userlogin;
													$newlogin->dbconnect();
													$result = $newshipping->getshipping4summary($cond,$offset,$rowsPerPage);
	     										  		 while ($myrow = mysql_fetch_assoc($result)) {
                                                                 $resultinvoice=$newshipping->getinvoice4ship($myrow["link2invoice"]);
                                                                 $myinvoice=mysql_fetch_assoc($resultinvoice);
                                                                 if($myinvoice["invdate"] != '0000-00-00' && $myinvoice["invdate"]!= '' && $myinvoice["invdate"] != 'NULL')
                                                                 {
                                                                 $datearr = split('-', $myinvoice["invdate"]);
                                                                 $d=$datearr[2];
                                                                 $m=$datearr[1];
                                                                 $y=$datearr[0];
                                                                 $x=mktime(0,0,0,$m,$d,$y);
                                                                 $idate=date("M j, Y",$x);
                                                                 }
                                                                 else
                                                                 {
                                                                 $idate = '';
                                                                 }
                                                                if($myrow["createdate"] != '0000-00-00' && $myrow["createdate"]!= '' && $myship["createdate"] != 'NULL')
                                                                {
                                                                $datearr = split('-', $myrow["createdate"]);
                                                                $d=$datearr[2];
                                                                $m=$datearr[1];
                                                                $y=$datearr[0];
                                                                $x=mktime(0,0,0,$m,$d,$y);
                                                                $sdate=date("M j, Y",$x);
                                                                }
                                                                else
                                                                {
                                                                $sdate = '';
                                                                }


                                                 		 printf('<tr><td bgcolor="#FFFFFF"><span class="tabletext"><a href="shippingDetails.php?shiprecnum=%s&link2invoice=%s"><b>%s</b></td>
                          												<td bgcolor="#FFFFFF"><span class="tabletext">%s</td>
                          												<td bgcolor="#FFFFFF"><span class="tabletext">%s</td>
                          												<td bgcolor="#FFFFFF"><span class="tabletext">%s</td>
                          												<td bgcolor="#FFFFFF"><span class="tabletext">%s</td>
                           											 	<td bgcolor="#FFFFFF"><span class="tabletext">%s</td></tr>',
		     									     		               $myrow["recnum"],$myrow["link2invoice"],$myrow["shipping_id"],
		     									     		               $sdate,
                       													   $myinvoice["invnum"],
                       													   $idate,
                                                                           $myinvoice["name"],
                       										 		       $myinvoice["saddr1"]
										);
                                                                      	printf('</td></tr>');
        													}
  											 		/* Free resultset */
  													 mysql_free_result($result);
													  /* Closing connection */
  													$newlogin->dbdisconnect();
            	                              ?>
											               </table>
 											</td>
										</tr>
									</table>
								</td>
								<!-- <td width="6"><img src="images/spacer.gif " width="6"></td>
							</tr>
							<tr bgcolor="DEDFDE">
  								<td width="6"><img src="images/box-left-bottom.gif"></td>
								<td><img src="images/spacer.gif " height="6"></td>
								<td width="6"><img src="images/box-right-bottom.gif"></td>
							</tr>
						</table> -->
						<table border = 0 cellpadding=0 cellspacing=0 width=100% >
							<tr>
								<td align=left>

<?php

//Additions on Dec 29 04 by Jerry George to implement pagination
 //$numrows=10;
$numrows = $newshipping->getshipping4summarycount($cond,$offset,$rowsPerPage);
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
    $prev = " <a href=\"shippingSummary.php?page=$page&totpages=$totpages&final_relno=$finalrel_match&
	final_crn=$final_crnmatch&ddate1=$ddate1_match&ddate2=$ddate2_match&final_partnum=$final_partnummatch\">[Prev]</a> ";

    $first = " <a href=\"shippingSummary.php?page=1&totpages=$totpages&final_relno=$finalrel_match&
	final_crn=$final_crnmatch&ddate1=$ddate1_match&ddate2=$ddate2_match&final_partnum=$final_partnummatch\">[First Page]</a> ";
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
    $next = " <a href=\"shippingSummary.php?page=$page&totpages=$totpages&final_relno=$finalrel_match&
	final_crn=$final_crnmatch&ddate1=$ddate1_match&ddate2=$ddate2_match&final_partnum=$final_partnummatch\">[Next]</a> ";

    $last = " <a href=\"shippingSummary.php?page=$totpages&totpages=$totpages&final_relno=$finalrel_match&
	final_crn=$final_crnmatch&ddate1=$ddate1_match&ddate2=$ddate2_match&final_partnum=$final_partnummatch\">[Last Page]</a> ";
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
