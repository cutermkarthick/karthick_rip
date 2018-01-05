<?php
//==============================================
// Author: FSI                                 =
// Date-written =  Mar 20, 2007                =
// Filename: reviewSummary.php                 =
// Copyright Fluent Technologies               =
// Revision: v1.0 OMS                          =
// Displays list of Review Summary             =
//==============================================
session_start();
header("Cache-control: private");
if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];

$_SESSION['pagename'] = 'reviewsummary';
//////session_register('pagename');
$dept = $_SESSION['department'];
// First include the class definition
include_once('classes/userClass.php');
include('classes/reviewClass.php');
include_once('classes/displayClass.php');
$newdisplay = new display;
$newreview = new review;

//Following code added to implement search,sort  and Pagination on Dec 29-04 by Jerry George

$cond0 = "ordernum like '%'";
$cond1 = "refno like '%'";
$cond2 = "name like '%'";
$cond3 = "(status like '%' || status is NULL)";

$cond = $cond0 . ' and ' . $cond1 . ' and ' . $cond2 . ' and ' . $cond3;

$sort1='refno';
$select='name';
$worec='';
$where1='';
$oper1='like';
$oper2='like';
$oper3='like';
if ( isset ( $_REQUEST['cust_no'] ) )
{
     $cust_match = $_REQUEST['cust_no'];
     if ( isset ( $_REQUEST['cust_oper'] ) ) {
          $oper1 = $_REQUEST['cust_oper'];
     }
     else {
         $oper1 = 'like';
     }
     if ($oper1 == 'like') {
         $final_custno = "'" . $_REQUEST['cust_no'] . "%" . "'";
     }
     else {
         $final_custno = "'" . $_REQUEST['cust_no'] . "'";
     }

     $cond0 = "ordernum " . $oper1 . " " . $final_custno;

}
else {
     $cust_match = '';
}
if ( isset ( $_REQUEST['ref_no'] ) )
{
     $ref_match = $_REQUEST['ref_no'];
     if ( isset ( $_REQUEST['ref_oper'] ) ) {
          $oper2 = $_REQUEST['ref_oper'];
     }
     else {
         $oper2 = 'like';
     }
     if ($oper2 == 'like') {
         $final_refno = "'" . $_REQUEST['ref_no'] . "%" . "'";
     }
     else {
         $final_refno = "'" . $_REQUEST['ref_no'] . "'";
     }

     $cond1 = "refno " . $oper2 . " " . $final_refno;

}
else {
     $ref_match = '';
}
if ( isset ( $_REQUEST['name_no'] ) )
{
     $name_match = $_REQUEST['name_no'];
     if ( isset ( $_REQUEST['name_oper'] ) ) {
          $oper3 = $_REQUEST['name_oper'];
     }
     else {
         $oper3 = 'like';
     }
     if ($oper3 == 'like') {
         $final_nameno = "'" . $_REQUEST['name_no'] . "%" . "'";
     }
     else {
         $final_nameno = "'" . $_REQUEST['name_no'] . "'";
     }

     $cond2 = "name " . $oper3 . " " . $final_nameno;

}
else {
     $name_match = '';
}
if ( isset ( $_REQUEST['status_val'] ) )
{

     $sval = $_REQUEST['status_val'];
      //echo $sval."----------------";
     if ($sval == 'Open')
     {
         $cond3 = "(status = '" . $sval . "' || status is NULL)";
     }
     else if ($sval == 'Close')
     {
         $cond3 = "status = '" . $sval . "'" ;
     }
     else
     {
         $cond3 = "status = '" . $sval . "'";
     }
}
else
{
     $sval = 'Open';
     $cond3 = "(status = '" . $sval . "' || status is NULL)";
}


if ( isset ( $_REQUEST['sortfld1'] ) )
{
	 $sort1 = $_REQUEST['sortfld1'];
}

$cond = $cond0 . ' and ' . $cond1 . ' and ' . $cond2 . ' and ' . $cond3;
//echo $cond;
$userrole = $_SESSION['userrole'];

// how many rows to show per page
$rowsPerPage = 25;

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
<script language="javascript" src="scripts/review.js"></script>

<html>
<head>
<title>Order Stage Summary</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">
<form action='reviewSummary.php' method='post' enctype='multipart/form-data'>
<?php
	include('header.html');
?>
<table width=100% cellspacing="0" cellpadding="6" border="0">
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
	<td bgcolor="#FFFFFF">
	<table width=100% border=0 cellpadding=6 cellspacing=0  >
    <tr><td><span class="heading"><i>Please click on the Cust Ord No. link to Edit or Delete</i></td></tr>
	<tr><td>
	<table width=100% border=0 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF" >
	<tr>
	<td bgcolor="#F5F6F5" colspan="7"><span class="heading"><b><center>Search Criteria</center></b></td>
	<td bgcolor="#FFFFFF" rowspan=3 align="center">
	<input type= "image" name="submit" src="images/bu-get.gif" value="Get" onclick="javascript: return searchsort_fields()">
    <input type="hidden" name="cust_oper">
    <input type="hidden" name="ref_oper">
                                                 <input type="hidden" name="name_oper">
											</td>
										</tr>
										<tr>
           <td bgcolor="#FFFFFF"><span class="labeltext"><b>Cust PO</b></td>

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

<td bgcolor="#FFFFFF"><input type="text" name="cust_no" size=15 value="<?php echo $cust_match ?>" onkeypress="javascript: return checkenter(event)">
</td>
<td bgcolor="#FFFFFF"><span class="labeltext"><b>Ref No</b></td>

<td bgcolor="#FFFFFF"><span class="tabletext"><select name="ref_oper" size="1" width="50">
<?php
   if ( isset ( $_REQUEST['ref_oper'] ) ){
          $check2 = $_REQUEST['ref_oper'];

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

<td  bgcolor="#FFFFFF"><input type="text" name="ref_no" size=15 value="<?php echo $ref_match ?>" onkeypress="javascript: return checkenter(event)">
</td>
</tr>
<tr>
<td bgcolor="#FFFFFF"><span class="labeltext"><b>Customer</b></td>

<td bgcolor="#FFFFFF"><span class="tabletext"><select name="name_oper" size="1" width="50">
<?php
   if ( isset ( $_REQUEST['name_oper'] ) ){
          $check2 = $_REQUEST['name_oper'];

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

<td bgcolor="#FFFFFF"><input type="text" name="name_no" size=15 value="<?php echo $name_match ?>" onkeypress="javascript: return checkenter(event)">
</td>
<td bgcolor="#FFFFFF"><span class="labeltext"><b>Status </b></td>
<td colspan=2 bgcolor="#FFFFFF"><span class="tabletext"><select name="status_val" size="1" width="100">
<?php
      if ($sval == 'Open')
      {
?>
	<option selected>Open
    <option value>Pending
	<option value>Close
    <option value>Cancelled
<?php
      }
      else if ($sval == 'Close')
      {
?>
	<option selected>Close
	<option value>Open
	<option value>Pending
    <option value>Cancelled
<?php
      }
      else if ($sval == 'Cancelled')
      {
?>
	<option selected>Cancelled
	<option value>Open
	<option value>Pending
    <option value>Close

<?php
      }
      else if ($sval == 'Pending')
      {
?>
	<option selected>Pending
	<option value>Open
	<option value>Cancelled
    <option value>Close
<?php
    }
?>

</select>
</td>
</tr>
</table>
<tr><td>
<table width=100% border=0>
<tr>
<td><span class="pageheading"><b>Order Stage Summary</b></td>
<td colspan=150>&nbsp;</td>
<td><a href ="new_review.php"><img name="Image8" border="0" src="images/bu_newreview.gif"></a>
</td>
</tr>
</table>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
<tr>
<td width="5%" bgcolor="#EEEFEE"><span class="tabletext"><b>Cust PO</b></td>
<td width="10%" bgcolor="#EEEFEE"><span class="tabletext"><b>Name of Customer</b></td>
<td width="5%" bgcolor="#EEEFEE"><span class="tabletext"><b>Ref No.</b></td>
<td width="5%" bgcolor="#EEEFEE"><span class="tabletext"><b>Order Date</b></td>
<td width="10%" bgcolor="#EEEFEE"><span class="tabletext"><b>Order Type</b></td>
<td width="5%" bgcolor="#EEEFEE"><span class="tabletext"><b>Amendment Num</b></td>
<td width="5%" bgcolor="#EEEFEE"><span class="tabletext"><b>Amendment Date</b></td>
<td width="5%" bgcolor="#EEEFEE"><span class="tabletext"><b>Status</b></td>
</tr>
<?php
    //$newlogin = new userlogin;
	//$newlogin->dbconnect();
    if ($dept == 'Sumant') 
    {
	    $result=$newreview->getgoodrich();
    }
	else 
    {
        $result = $newreview->getreviewsummary($cond,$offset,$sort1,$rowsPerPage);
    }
    while ($myrow = mysql_fetch_assoc($result))
    {
          if($myrow["order_date"] != '' && $myrow["order_date"] != '0000-00-00')
          {
                 $datearr = split('-', $myrow["order_date"]);
                 $d=$datearr[2];
                 $m=$datearr[1];
                 $y=$datearr[0];
                 $x=mktime(0,0,0,$m,$d,$y);
                 $orddate=date("M j, Y",$x);
          }
          else
          {
              $orddate = '';
          }
          if($myrow["amendment_date"] != '' && $myrow["amendment_date"] != '0000-00-00')
          {
                 $datearr = split('-', $myrow["amendment_date"]);
                 $d=$datearr[2];
                 $m=$datearr[1];
                 $y=$datearr[0];
                 $x=mktime(0,0,0,$m,$d,$y);
                 $amdate=date("M j, Y",$x);
          }
          else
          {
                 $amdate = '';
          }
               $amendnum = $myrow["amendment_num"];
               printf('<tr><td bgcolor="#FFFFFF"><span class="tabletext"><a href="reviewDetails.php?reviewrecnum=%s"><b>%s</b></td>
               <td bgcolor="#FFFFFF"><span class="tabletext">%s</td>
               <td bgcolor="#FFFFFF"><span class="tabletext">%s</td>
               <td bgcolor="#FFFFFF"><span class="tabletext">%s</td>
               <td bgcolor="#FFFFFF"><span class="tabletext">%s</td>
               <td bgcolor="#FFFFFF"><span class="tabletext">%s</td>
               <td bgcolor="#FFFFFF"><span class="tabletext">%s</td>',
               $myrow["recnum"],$myrow["ordernum"],
               $myrow["name"],
               $myrow["refno"],
               $orddate,
			   $myrow['ordertype'],
               $amendnum,
               $amdate);
               
             if ($myrow['status'] == 'Pending')
             {
                printf('<td bgcolor="#FF0000"><span class="tabletext">%s</td>',$myrow['status']);
             }
             else
             {
                printf('<td bgcolor="#FFFFFF"><span class="tabletext">%s</td>',$myrow['status']);
             }
             printf('</tr>');

      }
  											 		/*Free resultset*/
             mysql_free_result($result);
													  /*Closing connection*/
            // $newlogin->dbdisconnect();
?>
											               </table>
 											</td>
										</tr>
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
						<table border = 0 cellpadding=0 cellspacing=0 width=100% >
							<tr>
								<td align=left>

<?php

//Additions on Dec 29 04 by Jerry George to implement pagination
$numrows=$newreview->getreviewCount($cond,$offset,$rowsPerPage);
//$numrows = $newcompetitor->getcompetitorCount($cond,$offset, $rowsPerPage);
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
    $prev = " <a href=\"reviewSummary.php?page=$page&totpages=$totpages&cust_no=$cust_match&ref_no=$ref_match&name_no=$name_match\">[Prev]</a> ";

    $first = " <a href=\"reviewSummary.php?page=1&totpages=$totpages&cust_no=$cust_match&ref_no=$ref_match&name_no=$name_match\">[First Page]</a> ";
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
    $next = " <a href=\"reviewSummary.php?page=$page&totpages=$totpages&cust_no=$cust_match&ref_no=$ref_match&name_no=$name_match\">[Next]</a> ";

    $last = " <a href=\"reviewSummary.php?page=$totpages&totpages=$totpages&cust_no=$cust_match&ref_no=$ref_match&name_no=$name_match\">[Last Page]</a> ";
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
		</body>
</html>
