<?php
//
//==============================================
// Author: FT                                  =
// Date-written = July 16, 2011                =
// Filename: spmastersummary.php               =
// Copyright of Badari Mandyam, FluentSoft     =
// Revision: v1.0 WMS                          =
// Displays SP Master Summary list.            =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];
$dept = $_SESSION['department'];
$user_role=$_SESSION['userrole'];
//echo $dept."*-*-*--*-*".$user_role;
$_SESSION['pagename'] = 'spmastersummary';
//////session_register('pagename');
// First include the class definition
include_once('classes/spmasterClass.php');
include_once('classes/displayClass.php');

$newdisplay = new display;
$newSP = new spmaster;
$cond0 = "crnnum like '".$_SESSION['final_refno']."%'";
$cond=$cond0;
$oper1='like';

if(isset($_SESSION['final_refno']))
{
   $finalref_match = $_SESSION['final_refno'];
}

 if ( isset ( $_REQUEST['final_refno'] ) )
{
     $finalref_match = $_REQUEST['final_refno'];
     $_SESSION['final_refno']=$finalref_match;

     if ( isset ( $_REQUEST['refno_oper'] ) ) {
          $oper1 = $_REQUEST['refno_oper'];
     }
     else {
         $oper1 = 'like';
     }
     if ($oper1 == 'like')
     {
         $final_refno = "'" . $_SESSION['final_refno']. "%" . "'";
     }
     else
     {
         $final_refno = "'" . $_SESSION['final_refno'] . "'";
     }

     $cond0 = "crnnum " . $oper1 . " " . $final_refno;
}
else
{
     $finalref_match = '';
}

$rowsPerPage = 20;

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
<html>
<head>
<title>SP Master Summary</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">
<form action='spmastersummary.php' method='post' enctype='multipart/form-data'>
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
     <table width=100% border=0 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF">
  <tr>
	<td bgcolor="#F5F6F5" colspan="3"><span class="heading"><b><center>Search & SortCriteria</center></b></td>
    <td bgcolor="#FFFFFF" rowspan=3 align="center">
	<input type= "image" name="submit" src="images/bu-get.gif" value="Get" onclick="javascript: return searchsort_fields()">

	</td>
  </tr>
<tr>
<td bgcolor="#FFFFFF"><span class="labeltext"><b>PRN No</b></td>

<td bgcolor="#FFFFFF"><span class="tabletext"><select name="refno_oper" size="1" width="50">
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

<td bgcolor="#FFFFFF"><input type="text" name="final_refno" size=15 value="<?php echo $_SESSION['final_refno'] ?>" onkeypress="javascript: return checkenter(event)">
</td>
</tr>
</table>
<table width=100% border=0>
  <tr>
  <td><span class="pageheading"><b>List Of SP Master</b></td>
<?php
$cond = $cond0;
   if($dept=='Sales' || ($dept=='Purchasing'&& $user_role=='SU'))
   {
?>
  <td colspan=160>&nbsp;</td>
  <td align='right'><a href ="spmasterEntry.php"><img name="Image8" border="0" src="images/new.gif"></a>
  </td>
<?php
  }else
  {
?>
  </td>
<?php
  }
?>

  </tr>
</table>
		<tr><td>

<table width="100%" border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
        <tr  bgcolor="#FFCC00">
            <td  bgcolor="#EEEFEE"><span class="tabletext"><b>PRN#</b></td>
	        <td  bgcolor="#EEEFEE"><span class="tabletext"><b>Status</b></td>
            <td  bgcolor="#EEEFEE"><span class="tabletext"><b>Supplier</b></td>
            <td  bgcolor="#EEEFEE"><span class="tabletext"><b>Partnum</b></td>
            <td  bgcolor="#EEEFEE"><span class="tabletext"><b>AUK Partnum</b></td>
	        <td  bgcolor="#EEEFEE"><span class="tabletext"><b>Saab Partnum</b></td>
	        <td  bgcolor="#43BFC7"><span class="tabletext"><b>Qty</b></td>
            <td  bgcolor="#43BFC7"><span class="tabletext"><b>Validity for Qty<br>(yyyy-mm-dd)</b></td>
            <td  bgcolor="#E8A317"><span class="tabletext"><b>Price</b></td>
            <td  bgcolor="#E8A317"><span class="tabletext"><b>Validity for Price<br>(yyyy-mm-dd)</b></td>
		    <td  bgcolor="#EEEFEE"><span class="tabletext"><b>Total<br>Cost</b></td>
            <td  bgcolor="#EEEFEE"><span class="tabletext"><b>Validity for Total Cost<br>(yyyy-mm-dd)</b></td>
       </tr>
<?php
         //$newSP->getspmaster($cond,$sort1,$offset,$rowsPerPage);
         $result = $newSP->getspmaster($cond,$offset,$rowsPerPage);
        /* crnnum, partnum, aukpartnum, saabpartnum, currency, price, price_valid_from,
                       price_valid_upto, qty, qty_valid_from, qty_valid_upto, totalcost, totalcost_valid_from,
                       totalcost_valid_upto, qty_ss, link2vendor, create_date, status,name*/
         while($myrow=mysql_fetch_row($result))
         {
           if($myrow[10] != '' && $myrow[10] != '0000-00-00')
               {
                 $datearr = split('-', $myrow[10]);
                 $d=$datearr[2];
                 $m=$datearr[1];
                 $y=$datearr[0];
                 $x=mktime(0,0,0,$m,$d,$y);
                 $vfdate=date("M j, Y",$x);
               }
               else
               {
                 $vfdate = '';
               }
               
               if($myrow[11] != '' && $myrow[11] != '0000-00-00')
               {
                 $datearr = split('-', $myrow[11]);
                 $d=$datearr[2];
                 $m=$datearr[1];
                 $y=$datearr[0];
                 $x=mktime(0,0,0,$m,$d,$y);
                 $vddate=date("M j, Y",$x);
               }
               else
               {
                 $vddate = '';
               }
               if($myrow[7] != '' && $myrow[7] != '0000-00-00')
               {
                 $datearr = split('-', $myrow[7]);
                 $d=$datearr[2];
                 $m=$datearr[1];
                 $y=$datearr[0];
                 $x=mktime(0,0,0,$m,$d,$y);
                 $pfdate=date("M j, Y",$x);
               }
               else
               {
                 $vfdate = '';
               }

               if($myrow[8] != '' && $myrow[8] != '0000-00-00')
               {
                 $datearr = split('-', $myrow[11]);
                 $d=$datearr[2];
                 $m=$datearr[1];
                 $y=$datearr[0];
                 $x=mktime(0,0,0,$m,$d,$y);
                 $ptdate=date("M j, Y",$x);
               }
               else
               {
                 $vddate = '';
               }
               if($myrow[14] != '' && $myrow[14] != '0000-00-00')
               {
                 $datearr = split('-', $myrow[14]);
                 $d=$datearr[2];
                 $m=$datearr[1];
                 $y=$datearr[0];
                 $x=mktime(0,0,0,$m,$d,$y);
                 $ttdate=date("M j, Y",$x);
               }
               else
               {
                 $ttdate = '';
               }



   	       printf('<tr bgcolor="#FFFFFF">');
   	              if($myrow[22] == 'Inactive')
                  {
                      $color = '"#FF0000"';
                  }
                   else
                       {
                         $color = '"#FFFFFF"';
                       }
                       if($dept=='Sales'|| ($dept=='Purchasing'&& $user_role=='SU'))
                       {
                       

              printf("<td ><span class=\"tabletext\"><a href=\"spmasterEdit.php?recnum=%s\"><b>%s</b></td>
                      <td bgcolor=$color><span class=\"tabletext\">%s</td>
                      <td><span class=\"tabletext\">%s</td>
           	          <td><span class=\"tabletext\">%s</td>
                      <td><span class=\"tabletext\">%s</td>
                      <td><span class=\"tabletext\">%s</td>
                      <td><span class=\"tabletext\">%s</td>
	                  <td><span class=\"tabletext\">%s%s%s</td>
	                  <td align=\"right\"><span class=\"tabletext\"><b>%s %s</b></td>
	                  <td><span class=\"tabletext\">%s%s%s</td>
				      <td><span class=\"tabletext\">%s</td>
			          <td><span class=\"tabletext\">%s%s%s</td>
                          ",
                       $myrow[0],
		              $myrow[1],
		     		  $myrow[18],
                      $myrow[19],
                      $myrow[2],
			          $myrow[3],
			          $myrow[4],
			          $myrow[9],
                      $vfdate,
					   ' to ',
					  $vddate,
					  $myrow[5],
			          $myrow[6],
                      $pfdate,
					  ' to ',
					  $ptdate,
			          $myrow[12],
                      $vfdate,
					  ' to ',
                      $ttdate);
              printf('</td></tr>');

        }
        
        else
        {
             printf("
			          <td ><span class=\"tabletext\"><b>%s</b></td>
                      <td bgcolor=$color><span class=\"tabletext\">%s</td>
                      <td><span class=\"tabletext\">%s</td>
           	          <td><span class=\"tabletext\">%s</td>
                      <td><span class=\"tabletext\">%s</td>
                      <td><span class=\"tabletext\">%s</td>
                      <td><span class=\"tabletext\">%s</td>
	                  <td><span class=\"tabletext\">%s%s%s</td>
	                  <td align=\"right\"><span class=\"tabletext\"><b>%s %s</b></td>
	                  <td><span class=\"tabletext\">%s%s%s</td>
				      <td><span class=\"tabletext\">%s</td>
			          <td><span class=\"tabletext\">%s%s%s</td>
                          ",
		              $myrow[1],
		     		  $myrow[18],
                      $myrow[19],
                      $myrow[2],
			          $myrow[3],
			          $myrow[4],
			          $myrow[9],
                      $vfdate,
					   ' to ',
					  $vddate,
					  $myrow[5],
			          $myrow[6],
                      $pfdate,
					  ' to ',
					  $ptdate,
			          $myrow[12],
                      $vfdate,
					  ' to ',
                      $ttdate);
              printf('</td></tr>');
        }
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
   $numrows = $newSP->getspmastercount($cond,$offset,$rowsPerPage);
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
    $prev = " <a href=\"spmastersummary.php?page=$page&totpages=$totpages&final_refno=$finalref_match\">[Prev]</a> ";

    $first = " <a href=\"spmastersummary.php?page=1&totpages=$totpages&final_refno=$finalref_match\">[First Page]</a> ";
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
    $next = " <a href=\"spmastersummary.php?page=$page&totpages=$totpages&final_refno=$finalref_match\">[Next]</a> ";

    $last = " <a href=\"spmastersummary.php?page=$totpages&totpages=$totpages&final_refno=$finalref_match\">[Last Page]</a> ";
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
						</table>
						</form>
</body>
</html >

