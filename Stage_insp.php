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
$_SESSION['pagename'] = 'salesquote';
//////session_register('pagename');

// First include the class definition
include_once('classes/userClass.php');
include_once('classes/quoteClass.php');
include_once('classes/displayClass.php');
include('classes/companyClass.php');
include('classes/quoteliClass.php');
include('classes/pageClass.php');

$newQuote = new quote;
$newdisplay = new display;
$newpage = new page;
$newQuote = new quote;
$quoteli = new quoteli;
$newdisplay = new display;
$newCustomer = new company;

if (isset($_REQUEST['typenum']))
{
	$typenum=$_REQUEST['typenum'];
	$_SESSION['typenum'] = $typenum;
	//////session_register('typenum');
}
if (isset($_REQUEST['quotetype']))
{
	$quotetype=$_REQUEST['quotetype'];
	$_SESSION['quotetype'] = $quotetype;
	//////session_register('quotetype');
}
if (isset($_REQUEST['quoterecnum']))
{
	$quoterecnum=$_REQUEST['quoterecnum'];
	$_SESSION['quoterecnum'] = $quoterecnum;
	//////session_register('quoterecnum');
}

 $userrole = $_SESSION['userrole'];

$cond = "(to_days(`quote`.quote_date)-to_days('1582-01-01') > 0 ||
                    `quote`.quote_date = '0000-00-00' ||
                    `quote`.quote_date = 'NULL' ) and
           (to_days(`quote`.quote_date)-to_days('2050-12-31') < 0 ||
                    `quote`.quote_date = '0000-00-00' ||
                    `quote`.quote_date = 'NULL')";


 $sort1='quote_date';

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
}
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
<script language="javascript" src="scripts/quote.js"></script>
<script language="javascript" src="scripts/Quote<?php echo $quotetype . ".js"?>"></script>
<html>
<head>
<title>Sales Quote</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">
<form action='salesquote.php?scompany=$company_match&company_oper=$oper&sortfld1=$sort1&scompanyfl=$where1' method='post' enctype='multipart/form-data'>
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
       			<a href="../exit.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image16','','images/logout_mo.gif',1)"><img name="Image16" border="0" src="images/logout.gif"></a></td>
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
     <tr><td>
          <tr><td><span class="heading"><i>Please click on the Sales quote to Edit/Delete</i></td></tr>
		</tr>
  <tr>
<td>


<table width=100% border=0 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF" >
  <tr>
	<td bgcolor="#F5F6F5" colspan="7"><span class="heading"><b><center>Search & SortCriteria</center></b></td>
    <td bgcolor="#FFFFFF" rowspan=3 align="center">
	<input type= "image" name="submit" src="images/bu-get.gif" value="Get" onclick="javascript: return searchsort_fields()">
	</td>
 </tr>
 <tr>

<td bgcolor="#FFFFFF"><span class="tabletext"><select name="quotecrit" size="1" width="50">

<?php
   if ( isset ( $_REQUEST['quotecrit'] ) ){
          $check1 = $_REQUEST['quotecrit'];

                   if ($check1 =='company'){
?>
    	            <option value="id" >id
	                <option value="company" selected>company
<?php
                    }else{
?>
                    <option value="id" selected>id
	                <option value="company" >company

 <?php
                    }
   }else{
?>
 	<option value="id" selected>id
	<option value="company">company
 <?PHP
  }
 ?>
</select></td>


<td bgcolor="#FFFFFF"><span class="tabletext"><select name="quote_oper" size="1" width="50">
<?php
   if ( isset ( $_REQUEST['quote_oper'] ) ){
          $check2 = $_REQUEST['quote_oper'];

                   if ($check2 =='like'){
?>
    	            <option value="equal" >=
	                <option value="like" selected>like
<?php
                    }else{
?>
                    <option value="equal" selected>=
	                <option value="like" >like

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



<?php
 $quoteName='';
 if (isset($_REQUEST['quote'])) {
 $quoteName= $_REQUEST['quote'];
 }
?>

<td bgcolor="#FFFFFF"><input type="text" name="quote" size=15 value="<?php echo  $quoteName ?>" ></td>

		<td  bgcolor="#FFFFFF"><span class="labeltext"><b>Quote Date:  From &nbsp&nbsp</b>
        <input type="text" name="sdate1" size=10 value="<?php echo $date1_match ?>"
         onkeypress="javascript: return checkenter(event)">
        <img src="images/bu-getdateicon.gif" alt="Get Date" onclick='GetDate("sdate1")'>
         <span class="labeltext"><b>&nbsp&nbspTo</b>
        <input type="text" name="sdate2" size=10 value="<?php echo $date2_match ?>"
         onkeypress="javascript: return checkenter(event)">
        <img src="images/bu-getdateicon.gif" alt="Get Date" onclick='GetDate("sdate2")'>
       </td>

<td bgcolor="#FFFFFF" colspan=3><span class="labeltext"><b>Sort on</b>
<span class="tabletext"><select name="sortCond" size="1" width="100">
<?php
   if ( isset ( $_REQUEST['sortCond'] ) ){
          $check = $_REQUEST['sortCond'];
                   if ($check=='Descending'){
?>
    	            <option value="Ascending" >Ascending
	                <option value="Descending" selected>Descending
<?php
                    }else{
?>
                    <option value="Ascending" selected>Ascending
	                <option value="Descending" >Descending

 <?php
                    }
   }else{
?>
 	<option value="Ascending" selected>Ascending
	<option value="Descending">Descending
 <?PHP
  }
 ?>
</select></td>


	</table>
	</td></tr>
	<tr><td>
<table width=100% border=0>
  <tr>
  <td><span class="pageheading"><b>List Of Stage Inspections</b></td>
  <td colspan=260>&nbsp;</td>
  <td><a href ="quoteDetailsEntry.php"><img name="Image8" border="0" src="images/nq.gif"></a>
  </td>
  </tr>
</table>

<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
        <tr  bgcolor="#FFCC00">
            <td  bgcolor="#EEEFEE"><span class="tabletext"><b>Quote</b></td>
            <td  bgcolor="#EEEFEE" width=10%><span class="tabletext"><b>Date</b></td>
            <td  bgcolor="#EEEFEE" width=20%><span class="tabletext"><b>Sales Person</b></td>
            <td  bgcolor="#EEEFEE" width=10%><span class="tabletext"><b>Company</b></td>
            <td  bgcolor="#EEEFEE" width=20%><span class="tabletext"><b>Description</b></td>
            <td  bgcolor="#EEEFEE" width=10%><span class="tabletext"><b>Excel file</b></td>
            <td  bgcolor="#EEEFEE" width=8%><span class="tabletext"><b>RFQ ID</b></td>
            <td  bgcolor="#EEEFEE" width=10%><span class="tabletext"><b>Amount</b></td>
            <td  bgcolor="#EEEFEE" width=20%><span class="tabletext"><b>Lock Status</b></td>
            <td  bgcolor="#EEEFEE" width=20%><span class="tabletext"><b>Status</b></td>
        </tr>


<?php


         $quote_oper='';
         $quotecrit='';
         $quotecond='';
         if ( isset ( $_REQUEST['quote_oper'] ) ){
          $quote_oper = $_REQUEST['quote_oper'];
         }

         if ( isset ( $_REQUEST['quotecrit'] ) ){
          $quotecrit = $_REQUEST['quotecrit'];

         }
         if ( isset ( $_REQUEST['quote'] ) ){
          $quotecond = $_REQUEST['quote'];
         }

        if( $userrole == 'SALES PERSON'){
            $result = $newQuote->getQuotes1();
         }else{

             $result = $newQuote->getquotessearch($cond,$offset,$rowsPerPage,$sort1,$quotecond,$quote_oper,$quotecrit);
         }


            while ($myrow = mysql_fetch_row($result)) {
              $d=substr($myrow[5],8,2);
              $m=substr($myrow[5],5,2);
              $y=substr($myrow[5],0,4);
              $x=mktime(0,0,0,$m,$d,$y);
              $date=date("M j, Y",$x);

   	       printf('<tr bgcolor="#FFFFFF"><td ><span class="tabletext">
                           <a href="quoteDetails.php?mail=y&typenum=%s&quotetype=%s&quoterecnum=%s">%s</td>
                          <td><span class="tabletext">%s</td>
                          <td><span class="tabletext">%s</td>
                          <td><span class="tabletext">%s</td>
                          <td><span class="tabletext">%s</td>
                          <td><span class="tabletext"><a href=%s>%s</td>
                          <td><span class="tabletext">%s</a></td>
                          <td align="right"><span class="tabletext">%s%.2f</td>
                          <td><span class="tabletext">%s</td>
                          <td><span class="tabletext"><b>%s</b></td>',
		         $myrow[8],$myrow[7],$myrow[6],$myrow[0],
                         $date,
                         $myrow[9].' '.$myrow[10],
                         $myrow[1],
                         $myrow[2],
                         $myrow[3],$myrow[3],
                         $myrow[4],
                         $myrow[13],$myrow[12]+$myrow[15]+$myrow[16]+$myrow[17]+$myrow[18],
                         $myrow[20],
                         $myrow[11] );
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

//Additions on Dec 29 04 by Jerry George to implement pagination

$numrows = $newQuote->getquoteCount($cond,$offset,$rowsPerPage);
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
    $prev = " <a href=\"salesquote.php?page=$page&totpages=$totpages\">[Prev]</a> ";

    $first = " <a href=\"salesquote.php?page=1&totpages=$totpages\">[First Page]</a> ";
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
    $next = " <a href=\"salesquote.php?page=$page&totpages=$totpages\">[Next]</a> ";

    $last = " <a href=\"salesquote.php?page=$totpages&totpages=$totpages\">[Last Page]</a> ";
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
</html >

