<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = June 20, 2004                =
// Filename: sruworderSummary                  =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OMS                          =
// Displays Socket WO summary for RU           =
// Modifications History                       =
// Dec 6,04 - Paging Enhancements              =
//==============================================

session_start();
header("Cache-control: private"); 

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );
    
}
$userid = $_SESSION['user'];
$_SESSION['pagename'] = 'sruworderSummary'; 
//////session_register('pagename');
// First include the class definition 
include_once('classes/userClass.php'); 
include_once('classes/loginClass.php'); 
include('classes/workorderClass.php');
include('classes/displayClass.php');
$newdisp = new display;

$username = $_SESSION['user'];
$newlogin = new userlogin;
$newlogin->dbconnect();
$newworkOrder = new workOrder; 

// For paging - Added on Dec 6,04
 
// how many rows to show per page 
$rowsPerPage = 6; 

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
 
// End additions on Dec 6,04


?>

<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>

<html>
<head>
<title>Work Order Summary</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">

<?php
include('header.html');
?>
     <form action='sruworderSummary.php' method='post' enctype='multipart/form-data'>

<table width=100% cellspacing="0" cellpadding="6" border="0">
	<tr>
		<td>
			<table width=100% border=0 cellspacing="0" cellpadding="0">
   				<tr> 
        					<td colspan=2><span class="welcome"><b>Welcome <?php echo $userid?></b></td>
        					<td align="right"><a href="chPassword.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image15','','images/chpwd_mo.gif',1)"><img name="Image15" border="0" src="images/chpwd.gif"></a>
       					<a href="exit.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image16','','images/logout_mo.gif',1)"><img name="Image16" border="0" src="images/logout.gif"></a></td>
        				 </tr>
			</table>
<table width=100% border=0 cellpadding=0 cellspacing=0  >
	<tr><td>
	
	</td></tr>
	<tr>
	<td>
<?php $newdisp->dispLinks(''); ?>
</td></tr>
<table width=100% border=0 cellpadding=0 cellspacing=0  >

	<tr bgcolor="DEDFDE"><td width="6"><img src="images/spacer.gif " width="6"></td>
	     		     <td bgcolor="#FFFFFF">
				<table width=100% border=0 cellpadding=6 cellspacing=0  >
<tr><td><span class="heading"><i>&nbspPlease click on the WO link for details</i></td></tr>
				<tr><td>
				 <table width=100% border=0>
												<tr>
													<td><span class="pageheading"><b>List of Work Orders</b></td>
													
    												</tr>
										     	 </table>
										</td></tr>
										<tr>
											<td>
  												<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
        

        <tr bgcolor="#FFCC00">
            <td  bgcolor="#EEEFEE" width="5%"><span class="tabletext"><b>WO #</b></td>
            <td  bgcolor="#EEEFEE" width="25%"><span class="tabletext"><b>Description</b></td>
            <td  bgcolor="#EEEFEE" width="7%"><span class="tabletext"><b>Date</b></td>
            <td  bgcolor="#EEEFEE" width="10%"><span class="tabletext"><b>Company</b></td>
            <td  bgcolor="#EEEFEE" width="7%"><span class="tabletext"><b>Contact</b></td>
            <td  bgcolor="#EEEFEE" width="11%"><span class="tabletext"><b>Status</b></td>      
            <td  bgcolor="#EEEFEE" width="9%"><span class="tabletext"><b>Sch Due Date</b></td>
            <td  bgcolor="#EEEFEE" width="9%"><span class="tabletext"><b>Actual Ship Date</b></td>  
        </tr>

        
<?php

// use pager values to fetch data 
            $result = $newworkOrder->getWorkOrders($username,'','','',$offset,$rowsPerPage); 
            $flag = 0;

           
        while ($myrow = mysql_fetch_row($result)) {
	      printf('<tr bgcolor="#FFFFFF"><td><span class="tabletext"><a href="worder_det.php?typenum=%s&wotype=%s&worecnum=%s">%s</td>
                          <td><span class="tabletext">%s</td>
                          <td><span class="tabletext">%s</td>
                          <td><span class="tabletext">%s</td>
                          <td><span class="tabletext">%s %s</td>
                          <td><span class="tabletext">%s</td>
                          ',
		          $myrow[7],$myrow[1],$myrow[11],$myrow[0],
                          $myrow[12],
                          $myrow[10],
                          $myrow[2],
                          $myrow[13],$myrow[14],
                          $myrow[5]);
?>
               <td><span class="tabletext"><?php if ($myrow[15] != '00-00-00') echo $myrow[15] ?></td>
               <td><span class="tabletext"><?php if ($myrow[16] != '00-00-00') echo $myrow[16] ?></td></tr>
<?php
        }

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

$numrows = $newworkOrder->getWOcount('',$offset, $rowsPerPage);
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
    $prev = " <a href=\"sruworderSummary.php?page=$page&totpages=$totpages\">[Prev]</a> "; 
     
    $first = " <a href=\"sruworderSummary.php?page=1&totpages=$totpages\">[First Page]</a> "; 
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
    $next = " <a href=\"sruworderSummary.php?page=$page&totpages=$totpages\">[Next]</a> "; 
     
    $last = " <a href=\"sruworderSummary.php?page=$totpages&totpages=$totpages\">[Last Page]</a> "; 
} 
else 
{ 
    $next = ' [Next] ';      // we're on the last page, don't enable 'next' link 
    $last = ' [Last Page] '; // nor 'last page' link 
} 

// print the page navigation link 
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
</tr>
</table>



</body>
</html>
