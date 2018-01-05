<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = July 2 ,2005                 =
// Filename: wo_type.php                       =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v2.0 OMS                          =
//==============================================

session_start();
header("Cache-control: private"); 

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );
    
}
$userid = $_SESSION['user'];
$_SESSION['pagename'] = 'wo_type'; 
$page = "Template";
//////session_register('pagename');
$userrole = $_SESSION['userrole'];

include_once('classes/loginClass.php'); 

$newlogin = new userlogin;
$newlogin->dbconnect();

// how many rows to show per page 
$rowsPerPage =100; 

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
include('classes/userClass.php'); 
include('classes/pageClass.php'); 
include('classes/displayClass.php');
$newPages = new page; 
$newdisplink = new display;
?>

<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>

<html>
<head>
<title>Templates</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">
<form action='bom.php' method='post' enctype='multipart/form-data'>
<?php
       include('header.html');
?>
  <!-- <table width=100% cellspacing="0" cellpadding="6" border="0">
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
  <?php 
          $newdisplink->dispLinks('');
  ?>
  <table width=100% border=0 cellpadding=0 cellspacing=0  >
  <tr bgcolor="DEDFDE">
  <td width="6"><img src="images/spacer.gif " width="6"></td>
  <td bgcolor="#FFFFFF"> -->
<table width=100% border=0 cellpadding=6 cellspacing=0  class="stdtable1">
<tr><td><span class="heading"><i>Please click on the Page Name link for details or to Edit/Delete</i></td></tr>
<tr>
<td>
</td></tr>
<tr>
<td><span class="pageheading"><b>List of Pages</b></td>
<td colspan=10>&nbsp;</td>
<td align="right"><a href ="new_wotype.php"><img name="Image8" border="0" src="images/bu-newtype.gif"></a></td>
</tr>

</table>
<table width=100% border=0 cellpadding=6 cellspacing=0  >
<tr><td>

<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable">
<tr>
<thead>
<th class="head0"><span class="heading"><b>Page Name</b></th>
<th class="head1"><span class="heading"><b>Parent Name</b></th>
<th class="head0"><span class="heading"><b>Create Date</b></th>
</tr>
       
<?php
  
        $result = $newPages ->getPages($offset,$rowsPerPage); 
        while ($myrow = mysql_fetch_row($result)) 
        {
   	      printf('<tr><td bgcolor="#FFFFFF"><span class="tabletext">
                           <a href="wotypeDetails.php?recnum=%s">%s</td>',
		         $myrow[0],$myrow[1]);
	      printf('<td bgcolor="#FFFFFF"><span class="tabletext">%s</td><td bgcolor="#FFFFFF"><span class="tabletext">%s</td>',
		 $myrow[2],$myrow[3]);
                      printf('</tr>');
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
</form>
</body>
</html>



