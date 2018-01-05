<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = Dec 20, 2004                 =
// Filename: supportSummary.php                =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OWT                          =
// Displays SR Summary                         =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];
$_SESSION['pagename'] = 'supportsummary';
//session_register('pagename');
$usertype = $_SESSION['usertype'];
if($usertype == 'CUST')
{
  $page="Support";  
}
else
{
  $page="Support: New SR";  
}


$cond = "s.status like '%'";
$worec='';
$oper='like';
$select='support ID';
$sort1='support ID';
$support_match='';
$where1='support ID';
if ( isset ( $_REQUEST['supportcritval'] ) )
{	$select=$_REQUEST['supportcritval'];
	$where1=$_REQUEST['supportcritval'];
}
if ( isset ( $_REQUEST['support'] ) )
{
      	$support_match = $_REQUEST['support'];
        if ($support_match!='')
        {
    	if ( isset ( $_REQUEST['supportoperval'] ) ) {
       		  $oper = $_REQUEST['supportoperval'];

    	 }
     	else {
         		$oper = 'like';
    	       }
   	       if ($oper == 'like') {
         		$support = "'" . $_REQUEST['support'] . "%" . "'";
    	       }
                      else {
         	     	$support = "'" . $_REQUEST['support'] . "'";
             	      }
	$where1 =$_REQUEST['supportcritval'];
       	$select=$_REQUEST['supportcritval'];
	 if($where1=='support ID'){
		$where1="recnum" ;
  		$cond = "s." . $where1 . " " . $oper . " " . $support;}
	else  if($where1=='Type'){
		 $where1="type" ;
    		 $cond = "s." . $where1 . " " . $oper . " " . $support;}
	   }
    else
   {
$support_match = '';
}
}
else {
//echo "support not set";
$support_match = '';
}

$sort1='';

if ( isset ( $_REQUEST['sortfld1'] ) ) {
    $sort1 = $_REQUEST['sortfld1'];
	$sort1='s.recnum';
}

include_once('classes/userClass.php');
include_once('classes/loginClass.php');
include('classes/supportClass.php');
include('classes/displayClass.php');

$newlogin = new userlogin;
$newlogin->dbconnect();
//$username = $_SESSION['user'];
$newsupport = new support;
$newdisp = new display;
// For paging - Added on Dec 6,04

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


<html>
<head>
<title>Support Summary</title>
<link rel="stylesheet" href="style.css">
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">
	<form action='supportsummary.php? method='post' enctype='multipart/form-data'>
<?php
include('header.html');
?>
<!-- <link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/support.js"></script>
<table width=100% cellspacing="0" cellpadding="6" border="0">

<tr><td>
<table width=100% border=0 cellspacing="0" cellpadding="0">
    <tr>

        <td colspan=2><span class="welcome"><b>Welcome <?php echo $userid?></b></td>
        <td align="right">&nbsp; <a href="exit.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image16','','images/logout_mo.gif',1)"><img name="Image16" border="0" src="images/logout.gif"></a></td>

    </tr>
</table>
<table width=100% border=0 cellpadding=0 cellspacing=0  >
	<tr><td>

	</td></tr>
	<tr>
	<td>
<?php $newdisp->dispLinks(''); ?>
<table width=100% border=0 cellpadding=0 cellspacing=0  >

			<tr bgcolor="DEDFDE">
  				<td width="6"><img src="images/spacer.gif " width="6"></td>
				<td bgcolor="#FFFFFF">
 -->					<table width=100% border=0 cellpadding=6 cellspacing=0  >
						<tr><td><span class="labeltext"><i>Please click on the support ID# link for details and to Edit/Delete</i></td></tr>
						<tr><td>
               <table width=100% border=0 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1">
						<tr>
							<td bgcolor="#F5F6F5" colspan="3"><span class="labeltext"><b><center>Search Criteria</center></b></td>
							<td bgcolor="#F5F6F5"  colspan="4"><span class="labeltext"><b><center>Sort Criteria</center></b></td>
							<td bgcolor="#FFFFFF" rowspan=2 align="center"><button class="stdbtn btn_blue" style="background-color:#2d3e50" onclick="javascript: return searchsort_fields()">Get</button><!--<span class="tabletext"><input type= "image" name="Get" src="images/bu-get.gif" value="Get" onclick="javascript: return searchsort_fields()">--></td>
               
               
          </tr>

						<tr>
							<td bgcolor="#FFFFFF"><span class="tabletext"><select name="supportcrit" size="1" width="50">
						<?php if($select=='support ID'){?>
              						 <option selected>support ID
             						  <option value>Type
             						 <?php }?>
						<?php if($select=='Type'){?>
              						<option selected>Type
             						 <option value>support ID
      						 <?php }?>
						 </select>
						   </td>
						<td bgcolor="#FFFFFF"><span class="tabletext"><select name="support_oper" size="1" width="50">
      						<?php if($oper=='like'){?>
            						<option selected>like
						<option value>=<?php }else {?>
             						<option selected>=
						<option value>like<?php }?>
            						</select>
              			 	</td>
							<td bgcolor="#FFFFFF"><input type="text" name="support" size=15 value="<?php echo $support_match ?>" onkeypress="javascript: return checkenter(event)">
        			 	</td>
							<td bgcolor="#FFFFFF"><span class="labeltext"><b>Sort by</b></td>
							<td bgcolor="#FFFFFF" colspan=3><span class="tabletext"><select name="sort1" size="1" width="100">
					            <option selected>support ID
             					 </select>
             					</td>
<input type="hidden" name="supportcritval" value="">
<input type="hidden" name="sortfld1" value="">
<input type="hidden" name="supportoperval" value="">
</td>

</tr>
</table>
</td></tr>
<tr><td>
<table width=100% border=0>
<div class="contenttitle radiusbottom0">
<h2><span>List of Service Requests
  </h2>
</span>
</td>
</tr>

</td></tr>
</table>

<!-- <tr><td>
<span class="pageheading"><b>List of Service Requests</b></td></tr>

<tr><td>
 -->
<table width=60% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable" >
<thead>
<tr>
<td class="head0"><span class="heading"><b>Support ID #</b></td>
<td class="head1"><span class="heading"><b>Type</b></td>
<td class="head0"><span class="heading"><b><center>Status</center></b></td>
<td class="head1"><span class="heading"><b><center>Condition</b></center></td>
<td class="head0"><span class="heading"><b><center>Received Date</b></center></td>
<td class="head1"><span class="heading"><b><center>Age (days)</center></b></td>
</tr>
</thead>         <?php

            $result = $newsupport->getsupports($cond,$sort1,$offset,$rowsPerPage);

            while ($myrow = mysql_fetch_assoc($result)) {

                $d=substr($myrow["create_date"],8,2);
                $m=substr($myrow["create_date"],5,2);
                $y=substr($myrow["create_date"],0,4);
                $x=mktime(0,0,0,$m,$d,$y);
                $date=date("M j, Y",$x);
             //echo "$date";

	if ($myrow["type"]=='SR')
	{
	    $result1=$newsupport->getSrid($myrow["supp2type"]);
	    $myrow1=mysql_fetch_row($result1);
	    printf('<tr><td bgcolor="#FFFFFF"><span class="tabletext"><a href="sr.php?recnum=%s">%s</td>',
		         $myrow["supp2type"],$myrow1[0]);}
	if ($myrow["supp2type"]=='RMA')
	{
	    $result1=$newsupport->getRmaid($myrow["supp2type"]);
	    $myrow1=mysql_fetch_row($result1);
	    printf('<tr><td bgcolor="#FFFFFF"><span class="tabletext"><a href="rma.php?recnum=%s">%s</td>',
		         $myrow["supp2type"],$myrow1[0]);}
	if ($myrow["supp2type"]=='ECO')
	{
	    $result1=$newsupport->getEcoid($myrow["supp2type"]);
	    $myrow1=mysql_fetch_row($result1);
	    printf('<tr><td bgcolor="#FFFFFF"><span class="tabletext"><a href="eco.php?recnum=%s">%s</td>',
		         $myrow["supp2type"],$myrow1[0]);}
          ?>
           	    <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow["type"] ?></td>
                <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow["status"] ?></td>
                <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow["condition"] ?></td>

                <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $date ?></td>

	            <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow["TO_DAYS(CURDATE())-TO_DAYS(s.create_date)"] ?></td>
                </tr>
           <?php
       	 }
             ?>
</table>
</td></tr>
					</table>
				</td>
				<!-- <td width="6"><img src="images/spacer.gif " width="6"></td>
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
//  Added on Dec 6,04 for paging
// how many rows we have in database
//$query   = "SELECT COUNT(*) AS numrows FROM work_order";
//$result  = mysql_query($query) or die('Error, query failed');
//$row     = mysql_fetch_array($result, MYSQL_ASSOC);
//$numrows = $row['numrows'];
$numrows = $newsupport->getsupportcount($cond,$offset, $rowsPerPage);
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
    $prev = " <a href=\"supportSummary.php?page=$page&totpages=$totpages&support=$support_match&supportcritval=$where1&supportoperval=&oper\">[Prev]</a> ";
    $first = " <a href=\"supportSummary.php?page=1&totpages=$totpages&support=$support_match&supportcritval=$where1&supportoperval=&oper\">[First Page]</a> ";
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
    $next = " <a href=\"supportSummary.php?page=$page&totpages=$totpages&support=$support_match&supportcritval=$where1&supportoperval=&oper\">[Next]</a> ";
    $last = " <a href=\"supportSummary.php?page=$totpages&totpages=$totpages&support=$support_match&supportcritval=$where1&supportoperval=&oper\">[Last Page]</a> ";
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