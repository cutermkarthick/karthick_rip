<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = Jan 5 ,2007                  =
// Filename: invoicepaymentReport.php          =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OWT                          =
// Displays Invoice Payment Report             =
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


$cond ='';
$worec='';
$oper='like';
$select='BOM #';
$sort1='v.partnum';
$bom_match='';
$where1='';
$part_match='';
$desc_match='';
$vend_match='';
$mfr_match='';
$rate_match='';
$part_oper='like';
$desc_oper='like';
$vend_oper='like';
$mfr_oper='like';
$rate_oper='like';

if ( isset ($_REQUEST['part_match']) ||  isset ($_REQUEST['desc_match']) ||  isset ($_REQUEST['vend_match']) ||  isset ($_REQUEST['mfr_match']))
{
	if ( isset ($_REQUEST['part_match']))
	{
		$part_match = $_REQUEST['part_match'];
		if ($part_match!='' || $part_match!= 1)
		{
		    	if ( isset ( $_REQUEST['part_oper'] ) )
			 {
       			   $part_oper = $_REQUEST['part_oper'];
			 }
		     	else
			 {
         				$part_oper = 'like';
			  }
			if ($part_oper == 'like')
			{
			             $part_match1 = "'" . $_REQUEST['part_match'] . "%" . "'";
			             $cond="v.partnum like" . $part_match1;
			}
			else
			{
		  	     	$part_match1 = "'" . $_REQUEST['part_match'] . "'";
			                $cond="v.partnum = " . $part_match1;
			 }
		}
	}
	if(isset ($_REQUEST['desc_match']))
	{
		$desc_match=$_REQUEST['desc_match'];
		 if ($desc_match!='')
		 {
		    	if ( isset ( $_REQUEST['desc_oper'] ) )
			{
       				   $desc_oper = $_REQUEST['desc_oper'];
			 }
			else
			{
         				$desc_oper = 'like';
			 }
			  if ($desc_oper == 'like')
			{
			             $desc_match1 = "'" . $_REQUEST['desc_match'] . "%" . "'";
			             if ($cond=='')
				             $cond="v.part_desc like" . $desc_match1;
			              else
				             $cond=$cond . " and v.part_desc like" . $desc_match1;
	                                  }
	                                  else
			  {
	  	     		$desc_match1 = "'" . $_REQUEST['desc_match'] . "'";
			                if ($cond=='')
				             $cond="v.part_desc = " . $desc_match1;
			                else
				             $cond=$cond . " and v.part_desc = " . $desc_match1;
			  }
		}
	}
	if(isset ( $_REQUEST['vend_match'] ))
	{
		$vend_match=$_REQUEST['vend_match'];
		if ($vend_match!='')
		{
		    	if ( isset ( $_REQUEST['vend_oper'] ) )
			{
	       			   $vend_oper = $_REQUEST['vend_oper'];
			 }
		     	else
			{
		         		$vend_oper = 'like';
			 }
			  if ($vend_oper == 'like')
			 {
			             $vend_match1 = "'" . $_REQUEST['vend_match'] . "%" . "'";
			                if ($cond=='')
				             $cond="c.name like" . $vend_match1;
			                else
				             $cond=$cond . " and c.name like" . $vend_match1;

			  }
	               		 else
			 {
  	     			$vend_match1 = "'" . $_REQUEST['vend_match'] . "'";
			                if ($cond=='')
				             $cond="c.name = " . $vend_match1;
			                else
				             $cond=$cond . " and c.name = " . $vend_match1;
			}
		}
	}
	if(isset ( $_REQUEST['mfr_match'] ))
	{
		$mfr_match=$_REQUEST['mfr_match'];
	    	 if ($mfr_match!='')
		 {
		    	if ( isset ( $_REQUEST['mfr_oper'] ) )
			{
		       		   $mfr_oper = $_REQUEST['mfr_oper'];
			 }
		     	else
			{
		         		$mfr_oper = 'like';
			 }
			 if ($mfr_oper == 'like')
			{
			             $mfr_match1 = "'" . $_REQUEST['mfr_match'] . "%" . "'";
			                if ($cond=='')
				             $cond="v.mfr_partnum like" . $mfr_match1;
			                else
				             $cond=$cond . " and v.mfr_partnum like" . $mfr_match1;

			 }
			 else
			{
		  	     	$mfr_match1 = "'" . $_REQUEST['mfr_match'] . "'";
			                if ($cond=='')
				             $cond="v.mfr_partnum = " . $mfr_match1;
			                else
				             $cond=$cond . " and v.mfr_partnum = " . $mfr_match1;

			  }
		}
	}

	if(isset ( $_REQUEST['rate_match'] ))
	{
		$rate_match=$_REQUEST['rate_match'];
        		if ($rate_match!='' )
		{
		    	if ( isset ( $_REQUEST['rate_oper'] ) )
			{
		       		   $rate_oper = $_REQUEST['rate_oper'];
			 }
		     	else
			{
		         		$rate_oper = 'like';
			 }
			 if ($rate_oper == 'like')
			{
			             $rate_match1 = "'" . $_REQUEST['rate_match'] . "%" . "'";
			                if ($cond=='')
				             $cond="v.rate like" . $rate_match1;
			                else
				             $cond=$cond . " and v.rate like" . $rate_match1;

			 }
			 else
			{
		  	     	$rate_match1 = "'" . $_REQUEST['rate_match'] . "'";
			                if ($cond=='')
				             $cond="v.rate = " . $rate_match1;
			                else
				             $cond=$cond . " and v.rate = " . $rate_match1;

			 }
		}
	}



}
else
{
	$cond ="v.partnum like'%'";
}


if (isset($_REQUEST['sort1']))
{
    $sort1 = $_REQUEST['sort1'];
    if ($sort1=='part')
         $sort1= "v.partnum" ;
    else
         $sort1= "c.name" ;
}




include_once('../classes/loginClass.php');

$newlogin = new userlogin;
$newlogin->dbconnect();

// For paging - Added on Dec 6,04

// how many rows to show per page
$rowsPerPage = 20;

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

// First include the class definition
/*
include('classes/invoiceClass.php');
include('classes/invoiceliClass.php');  */
include('classes/displayClass.php');
/*
$newinvoice = new invoice;     */
$newdisplay = new display;
?>

<link rel="stylesheet" href="../style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/invoice.js"></script>

<html>
<head>
<title>Production Scorecard Report</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">
	<form action='vendpartReport.php? method='post' enctype='multipart/form-data'>
<?php
include('header.html');

?>
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
   <tr><td><span class="heading"><b>Sales</b></td>
    <td colspan=190>&nbsp;</td>
    <td><a href="javascript:printInvoicePaymentReport()"><img name="Image7" border="0" src="images/bu-print.gif"></a></td>
    </tr>
   </table>



<!--
<table width=100% border=0 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF" >
<tr>
<td bgcolor="#F5F6F5" colspan="7"><span class="heading"><b><center>Search & Sort Criteria</center></b></td>
<td bgcolor="#FFFFFF" rowspan=4 align="center"><span class="tabletext"><input type= "image" name="Get" src="images/bu-get.gif" value="Get" ></td>
</tr>
<tr>
<td bgcolor="#FFFFFF"><span class="labeltext"><b>Part # &nbsp</b></td>
<td  bgcolor="#FFFFFF"><span class="tabletext"><select name="part_oper" size="1" width="100">
<?php
      if ($part_oper == 'like')
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
</td>
<td bgcolor="#FFFFFF"><input type="text" name="part_match" size=20 value="<?php echo "$part_match";?>" >
</td>
<td bgcolor="#FFFFFF"><span class="labeltext"><b>Part Desc &nbsp</b></td>
<td  bgcolor="#FFFFFF"><span class="tabletext"><select name="desc_oper" size="1" width="100">
<?php
      if ($desc_oper == 'like')
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
</td>
<td bgcolor="#FFFFFF" colspan=2><input type="text" name="desc_match" size=20 value="<?php echo "$desc_match";?>" >
</td>
</tr>
<tr>
<td bgcolor="#FFFFFF"><span class="labeltext"><b>Vendor  &nbsp</b></td>
<td  bgcolor="#FFFFFF"><span class="tabletext"><select name="vend_oper" size="1" width="100">
<?php
      if ($vend_oper == 'like')
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
</td>
<td bgcolor="#FFFFFF"><input type="text" name="vend_match" size=20 value="<?php echo "$vend_match";?>" onkeypress="javascript: return checkenter(event)">
</td>
<td bgcolor="#FFFFFF"><span class="labeltext"><b>Manufacturer &nbsp</b></td>
<td  bgcolor="#FFFFFF"><span class="tabletext"><select name="mfr_oper" size="1" width="100">
<?php
      if ($mfr_oper == 'like')
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
</td>
<td bgcolor="#FFFFFF" colspan=2><input type="text" name="mfr_match" size=20 value="<?php echo "$mfr_match";?>" onkeypress="javascript: return checkenter(event)">
</td>
</tr>
<tr>
<td bgcolor="#FFFFFF"><span class="labeltext"><b>Rate &nbsp</b></td>
<td  bgcolor="#FFFFFF"><span class="tabletext"><select name="rate_oper" size="1" width="100">
<?php
      if ($rate_oper == 'like')
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
</td>
<td bgcolor="#FFFFFF"><input type="text" name="rate_match" size=20 value="<?php echo "$rate_match";?>" onkeypress="javascript: return checkenter(event)">
</td>
<td bgcolor="#FFFFFF"><span class="labeltext"><b>Sort on</b></td>
<td bgcolor="#FFFFFF"><span class="tabletext"><select name="sort1" size="1" width="100">
<?php
      if ($sortl == 'part')
      {
?>
	<option selected>part
	<option selected>vendor
<?php
      }
      else {
?>
	<option selected>vendor
	<option selected>part
<?php
      }
?>
</select></td>
<td bgcolor="#FFFFFF" colspan=2>&nbsp;</td>
</tr>
</table>
-->



<tr><td>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
        <tr>
            <td bgcolor="#EEEFEE"><span class="heading"><b>&nbsp;</b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b>Current</b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b>Last Year</b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b>Varience</b></td>

        </tr>
        <tr>
            <td bgcolor="#EEEFEE"><span class="heading"><b>Products</b></td>
            <td bgcolor="#FFFFFF"><span class="heading"><b>&nbsp;</b></td>
            <td bgcolor="#FFFFFF"><span class="heading"><b>&nbsp;</b></td>
            <td bgcolor="#FFFFFF"><span class="heading"><b>&nbsp;</b></td>

        </tr>
        <tr>
            <td bgcolor="#EEEFEE"><span class="heading"><b>Services</b></td>
            <td bgcolor="#FFFFFF"><span class="heading"><b>&nbsp;</b></td>
            <td bgcolor="#FFFFFF"><span class="heading"><b>&nbsp;</b></td>
            <td bgcolor="#FFFFFF"><span class="heading"><b>&nbsp;</b></td>

        </tr>
        <tr>
            <td bgcolor="#EEEFEE"><span class="heading"><b>Others</b></td>
            <td bgcolor="#FFFFFF"><span class="heading"><b>&nbsp;</b></td>
            <td bgcolor="#FFFFFF"><span class="heading"><b>&nbsp;</b></td>
            <td bgcolor="#FFFFFF"><span class="heading"><b>&nbsp;</b></td>

        </tr>


<?php      // $invoicerecnum=2;
  /*          $result = $newinvoice->getInvoicesPayment();
        while ($myrow = mysql_fetch_assoc($result)) {
            printf('<tr><td bgcolor="#FFFFFF"><span class="tabletext">%s</td>
                    <td bgcolor="#FFFFFF"><span class="tabletext">%s</td>
                    <td bgcolor="#FFFFFF"><span class="tabletext">%s</td>
                    <td bgcolor="#FFFFFF"><span class="tabletext">%s</td>
                    <td bgcolor="#FFFFFF"><span class="tabletext">%s</td>',
                    $myrow["recnum"],$myrow["name"], $myrow["payment_amount"],$myrow["payment_date"],$myrow["ref_num"]);
          }
                       */
?>
</table>
</td></tr>
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
//  Added on Dec 6,04 for paging

$numrows = 10;
//$result = $newVend->getPartcount($cond,$offset, $rowsPerPage);
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
    $prev = " <a href=\"invoicepaymentReport.php?page=$page&totpages=$totpages&part_match=$part_match&desc_match=$desc_match&vend_match=$vend_match&mfr_match=$mfr_match&rate_match=$rate_match&part_oper=$part_oper&desc_oper=$desc_oper&vend_oper=$vend_oper&mfr_oper=$mfr_oper&rate_oper=$rate_oper\">[Prev]</a> ";

    $first = " <a href=\"invoicepaymentReport.php?page=$page&totpages=$totpages&part_match=$part_match&desc_match=$desc_match&vend_match=$vend_match&mfr_match=$mfr_match&rate_match=$rate_match&part_oper=$part_oper&desc_oper=$desc_oper&vend_oper=$vend_oper&mfr_oper=$mfr_oper&rate_oper=$rate_oper\">[First Page]</a> ";
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
  $next = " <a href=\"invoicepaymentReport.php?page=$page&totpages=$totpages&part_match=$part_match&desc_match=$desc_match&vend_match=$vend_match&mfr_match=$mfr_match&rate_match=$rate_match&part_oper=$part_oper&desc_oper=$desc_oper&vend_oper=$vend_oper&mfr_oper=$mfr_oper&rate_oper=$rate_oper\">[Next]</a> ";

  $last = " <a href=\"invoicepaymentReport.php?page=$page&totpages=$totpages&part_match=$part_match&desc_match=$desc_match&vend_match=$vend_match&mfr_match=$mfr_match&rate_match=$rate_match&part_oper=$part_oper&desc_oper=$desc_oper&vend_oper=$vend_oper&mfr_oper=$mfr_oper&rate_oper=$rate_oper\">[Last Page]</a> ";
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
</form>
</body>
</html>
