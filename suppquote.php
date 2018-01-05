<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = Dec 28, 2017                 =
// Filename: suppquote.php                     =
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
$dept = $_SESSION['department'];
$_SESSION['pagename'] = 'salesquote';
$page = "Purchasing: Supplier Quote";

include_once('classes/userClass.php');
include_once('classes/suppquoteClass.php');
include_once('classes/displayClass.php');
include('classes/suppquoteliClass.php');


$newsuppQuote = new suppquote;
$suppquoteli = new suppquoteli;
$newdisplay = new display;


if (isset($_REQUEST['typenum']))
{
	$typenum=$_REQUEST['typenum'];
	$_SESSION['typenum'] = $typenum;
}
if (isset($_REQUEST['quotetype']))
{
	$quotetype=$_REQUEST['quotetype'];
	$_SESSION['quotetype'] = $quotetype;
}
if (isset($_REQUEST['quoterecnum']))
{
	$quoterecnum=$_REQUEST['quoterecnum'];
	$_SESSION['quoterecnum'] = $quoterecnum;
}

 $userrole = $_SESSION['userrole'];

$cond = "(to_days(q.quote_date)-to_days('1582-01-01') > 0 ||
                    q.quote_date = '0000-00-00' ||
                    q.quote_date = 'NULL' ) and
           (to_days(q.quote_date)-to_days('2050-12-31') < 0 ||
                    q.quote_date = '0000-00-00' ||
                    q.quote_date = 'NULL')";


 $sort1='quote_date';

 if ( isset ( $_REQUEST['sortCond'] ) )
  {
    $sort1 = $_REQUEST['sortCond'];
    if ($sort1=='Descending')
         $sort1= "q`.quote_date Desc" ;
         else
        $sort1= "q`.quote_date" ;
   }


 if ( isset ( $_REQUEST['sdate1'] ) || isset ( $_REQUEST['sdate2'] ) )
  {
     $date1_match = $_REQUEST['sdate1'];
     $date2_match = $_REQUEST['sdate2'];
     if ( isset ( $_REQUEST['sdate1']) &&  $_REQUEST['sdate1'] != '' )
     {
          $date1 = $_REQUEST['sdate1'];
          $cond31 = "to_days(q.quote_date) " . "> to_days('" . $date1 . "')";
     }
     else
     {
          $cond31 = "(to_days(q.quote_date)-to_days('1582-01-01') > 0 || q.quote_date = 'NULL' || q`.quote_date = '0000-00-00')";
     }

     if ( isset ( $_REQUEST['sdate2'] )  &&  $_REQUEST['sdate2'] != '')
     {
          $date2 = $_REQUEST['sdate2'];
          $cond32 = "to_days(q.quote_date) " . "< to_days('" . $date2 . "')";
     }
     else
     {
          $cond32 = "(to_days(q.quote_date)-to_days('2050-12-31') < 0 || q.quote_date = 'NULL' || q.quote_date = '0000-00-00')";
     }
     $cond = $cond31 . ' and ' . $cond32;

}
else
{
  $date1_match = '';
  $date2_match = '';
}

$rowsPerPage = 10;
$pageNum = 1;


if (isset($_REQUEST['page']))
{
  $pageNum = $_REQUEST['page'];
}
if (isset($_REQUEST['totpages']))
{
  $totpages = $_REQUEST['totpages'];
}

$offset = ($pageNum - 1) * $rowsPerPage;

?>

<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/quote.js"></script>
<script language="javascript" src="scripts/Quote<?php echo $quotetype . ".js"?>"></script>
<html>
<head>
<title>Supplier Quote</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">
<form action='suppquote.php?scompany=$company_match&company_oper=$oper&sortfld1=$sort1&scompanyfl=$where1' method='post' enctype='multipart/form-data'>
<?php
include('header.html');
?>

	    <td bgcolor="#FFFFFF">
 <table width=100% border=0 cellpadding=6 cellspacing=5>
     <tr><td>
          <tr><td><span class="heading"><i>Please click on the Sales quote to Edit/Delete</i></td></tr>
		</tr>
  <tr>
<td>


<table width=100% border=0 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1" >
  <tr>
	<td bgcolor="#F5F6F5" colspan="7"><span class="heading"><b><center>Search & SortCriteria</center></b></td>
    <td bgcolor="#FFFFFF" rowspan=3 align="center">
	<button class="stdbtn btn_blue" style="background-color:#2d3e50" onClick="javascript: return searchsort_fields()" >Get</button>
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
<div class="contenttitle radiusbottom0">
  <h2><span>List Of Quotes

    <input type="button" class="stdbtn btn_blue" style="float:right;padding:2px;margin-right:2px;"  onclick="location.href='SuppQuoteEntry.php'" value="New Quote" >
</h2>
</span>
  </td>
  </tr>
</table>

<table width=100% border=0 cellpadding=3 cellspacing=1 class="stdtable" >
  <thead>
        <tr>
            <th  class="head0"><span class="tabletext"><b>Quote</b></td>
            <th  class="head1" width=10%><span class="tabletext"><b>Date</b></td>
            <th  class="head0" width=20%><span class="tabletext"><b>Sales Person</b></td>
            <th  class="head1" width=10%><span class="tabletext"><b>Company</b></td>
            <th  class="head0" width=20%><span class="tabletext"><b>Description</b></td>
            <th  class="head1" width=10%><span class="tabletext"><b>Excel file</b></td>
            <th  class="head0" width=8%><span class="tabletext"><b>RFQ ID</b></td>
            <th  class="head1" width=10%><span class="tabletext"><b>Amount</b></td>
            <th  class="head0" width=20%><span class="tabletext"><b>Lock Status</b></td>
            <th  class="head1" width=20%><span class="tabletext"><b>Status</b></td>
        </tr>
        
      </thead>


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
            $result = $newsuppQuote->getQuotes1();
         }else{

             $result = $newsuppQuote->getquotessearch($cond,$offset,$rowsPerPage,$sort1,$quotecond,$quote_oper,$quotecrit);
         }


            while ($myrow = mysql_fetch_row($result)) {
              $d=substr($myrow[5],8,2);
              $m=substr($myrow[5],5,2);
              $y=substr($myrow[5],0,4);
              $x=mktime(0,0,0,$m,$d,$y);
              $date=date("M j, Y",$x);

   	       printf('<tr bgcolor="#FFFFFF"><td ><span class="tabletext">
                           <a href="suppquoteDetails.php?mail=y&typenum=%s&quotetype=%s&quoterecnum=%s">%s</td>
                          <td><span class="tabletext">%s</td>
                          <td><span class="tabletext">%s</td>
                          <td><span class="tabletext">%s</td>
                          <td><span class="tabletext">%s</td>
                          <td><span class="tabletext"><a href=%s>%s</td>
                          <td><span class="tabletext">%s</a></td>
                          <td align="right"><span class="tabletext">%s %.2f</td>
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


        </table>
        <table border = 0 cellpadding=0 cellspacing=0 width=100% >
							<tr>
								<td align=left>

<?php



$numrows = $newsuppQuote->getSuppQuoteCount($cond);
$maxPage = ceil($numrows/$rowsPerPage);

if (!isset($_REQUEST['page']))
{
  $totpages = $maxPage;
}

$self = $_SERVER['PHP_SELF'];


if ($pageNum > 1)
{
    $page = $pageNum - 1;
    $prev = " <a href=\"salesquote.php?page=$page&totpages=$totpages\">[Prev]</a> ";

    $first = " <a href=\"salesquote.php?page=1&totpages=$totpages\">[First Page]</a> ";
}
else
{
    $prev  = ' [Prev] ';       
    $first = ' [First Page] '; 
}

if ($pageNum < $totpages)
{
    $page = $pageNum + 1;
    $next = " <a href=\"salesquote.php?page=$page&totpages=$totpages\">[Next]</a> ";

    $last = " <a href=\"salesquote.php?page=$totpages&totpages=$totpages\">[Last Page]</a> ";
}
else
{
    $next = ' [Next] ';      
    $last = ' [Last Page] '; 
}
if($totpages!=0)
{

echo "<span class=\"labeltext\">" . $first . $prev . " Showing page <strong>$pageNum</strong> of <strong>$totpages</strong> pages " . $next . $last;
}
else
echo "<span class=\"labeltext\"><align=\"center\">No matching records found";


?>
								</td>
							</tr>
						</table>
      </FORM>
</body>
</html >

