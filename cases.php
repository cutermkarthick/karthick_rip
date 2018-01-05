<?php
//
//==============================================
// Author: FSI                                 =
// Date-written: March 14, 2005                =
// Filename: cases.php                         =
// Copyright (C) FluentSoft Inc.               =
// Revision: v1.0 OMS                          =
//==============================================
session_start();
header("Cache-control: private"); 

if ( !isset ( $_SESSION['user'] ) ){
	header ( "Location: login.php" );
}


$userid = $_SESSION['user'];
$userrole = $_SESSION['userrole'];
$_SESSION['pagename'] = 'cases'; 
//////session_register('pagename');

//Code for search sort Mechanism

$cond = "s.recnum like '%' and cases.case2owner != 0 ";
$worec='';
$oper='like';
$select='Status';
$sort1='date';
$sr_match='';
$where1='status';
if ( isset ( $_REQUEST['srritval'] ) )
{    $select=$_REQUEST['srcritval'];
     $where1=$_REQUEST['srcritval'];
}

if ( isset ( $_REQUEST['sr'] ) )
{
        $sr_match = $_REQUEST['sr'];
        if ($sr_match!='')
        {
    	if ( isset ( $_REQUEST['sroperval'] ) ) 
	{
       		  $oper = $_REQUEST['sroperval'];
	}
	else
	 {
         		$oper = 'like';
	}
	 if ($oper == 'like') 
	{
        		$sr = "'" . $_REQUEST['sr'] . "%" . "'";
	 }
	 else 
	{
	        	$sr = "'" . $_REQUEST['sr'] . "'";
	 }
	 $where1 =$_REQUEST['srcritval'];
	 $select=$_REQUEST['srcritval'];
	  if($where1=='Status')
	 {
	 	$where1="status" ;
	  	$cond = $where1 . " " . $oper . " " . $sr . "and case2owner != 0 ";
	 }
        }
       else 
       {
       	$sr_match = '';
       }
}
else 
{
	$sr_match = '';
}
$sort1='create_date';

//End

//Include the Class Files

include_once('classes/userClass.php'); 
include_once('classes/loginClass.php'); 
include('classes/casesClass.php');
include('classes/displayClass.php');

//Declaring Objects

$newdisp = new display;
$newlogin = new userlogin;
$newlogin->dbconnect();
$newcases = new cases; 

// how many rows to show per page 
$rowsPerPage = 3; 

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
<title>Cases</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">
<?php
	include('header.html');
?>
<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/cases.js"></script>
<form action="cases.php">
<table width=100% cellspacing="0" cellpadding="6" border="0">
<tr><td>
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
<tr><td>
<?php
      $newdisp->dispLinks(''); 
?>
<table width=100% border=0 cellpadding=0 cellspacing=0  >
<tr bgcolor="DEDFDE">
<td width="6"><img src="images/spacer.gif " width="6"></td>
<td bgcolor="#FFFFFF">
<table width=100% border=0 cellpadding=6 cellspacing=0  >
<tr><td><span class="heading"><i>Please click on the SR# link for details and to Edit/Delete</i></td></tr>
<tr><td>
<table width=100% border=0 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF" >
<tr>
<td bgcolor="#F5F6F5" colspan="3"><span class="heading"><b><center>Search Criteria</center></b></td>
<td bgcolor="#F5F6F5"  colspan="4"><span class="heading"><b><center>Sort Criteria</center></b></td>
<td bgcolor="#FFFFFF" rowspan=2 align="center"><span class="tabletext"><input type= "image" name="Get" src="images/bu-get.gif" value="Get" onclick="javascript: return searchsort_fields()"></td>
</tr>
<tr>
<td bgcolor="#FFFFFF"><span class="tabletext">
      <select name="srcrit" size="1" width="50">
         <option selected>Status
      </select>
</td>
<td bgcolor="#FFFFFF"><span class="tabletext">
      <select name="sr_oper" size="1" width="50">
<?php 
      if ($oper == 'like' )
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
<td bgcolor="#FFFFFF"><input type="text" name="sr" size=15 value="<?php echo $sr_match ?>" onkeypress="javascript: return checkenter(event)"></td>
<td bgcolor="#FFFFFF"><span class="labeltext"><b>Sort by</b></td>
<td bgcolor="#FFFFFF" colspan=3><span class="tabletext">
     <select name="sort1" size="1" width="100">
	<option selected>Date
     </select>
</td>

<input type="hidden" name="srcritval" value="status">
<input type="hidden" name="sortfld1" value="date">
<input type="hidden" name="sroperval">

</td></tr>
</table>
</td></tr>
<tr><td><span class="pageheading"><b>List of SRs</b></td></tr>
<tr><td>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
<tr>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Case #</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Customer</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Date</b></center></td>  
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Status</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Age</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Owner</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>SR#</b></td>    
<td bgcolor="#EEEFEE"><span class="heading"><b><center>FSR#</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>SCDR#</center></b></td>
</tr>

<?php
      if ( $userrole == 'SU' )
      {
	   $result = $newcases->getCases($cond,$sort1,$offset,$rowsPerPage); 
      }
      while ($myrow = mysql_fetch_row($result))
      {

	    printf('<td  bgcolor="#FFFFFF" align=center><span class="tabletext">
                                <a href="caseDetails.php?recnum=%s">%s</td>',$myrow[11],$myrow[11]);
?>
            <td bgcolor="#FFFFFF" align=center><span class="tabletext"><?php echo $myrow[3] ?></td>
 	    <td bgcolor="#FFFFFF" align=center><span class="tabletext"><?php if ($myrow[5] != '00-00-00') 
                      echo $myrow[5] ?></td>
            <td bgcolor="#FFFFFF" align=center><span class="tabletext"><?php echo $myrow[8] ?></td>
<?php    
            printf('<td bgcolor="#FFFFFF" align=center><span class="tabletext">%s</td>',$myrow[12]);
            printf('<td bgcolor="#FFFFFF" align=center><span class="tabletext">%s</td>',$myrow[9]);
	    printf('<td  bgcolor="#FFFFFF" align=center><span class="tabletext">
                                <a href="sr.php?recnum=%s">%s</td>',$myrow[11],$myrow[0]);

	    if ( $myrow[1] == '')
            {
	       printf('<td  bgcolor="#FFFFFF" align=center><span class="tabletext">
                          <a href="newFSR.php?caserecnum=%s">New FSR</td>',$myrow[11]);
               printf('<td  bgcolor="#FFFFFF">&nbsp;</td>');
            }
	    if ( $myrow[1] != '' && $myrow[2] == '' )
            {
               echo "<td  bgcolor=\"#FFFFFF\" align=center><span class=\"tabletext\">
                        <a href=\"fsr.php?recnum=$myrow[11]\">$myrow[1]</td>";
	       printf('<td bgcolor="#FFFFFF" align=center><span class="tabletext">
                        <a href="newscdr.php?caserecnum=%s">New SCDR</td>',$myrow[7]);
            }


            if ( $myrow[1] != '' && $myrow[2] != '' )
            {
               echo "<td  bgcolor=\"#FFFFFF\" align=center><span class=\"tabletext\">
                        <a href=\"fsr.php?recnum=$myrow[11]\">$myrow[1]</td>";
               printf('<td  bgcolor="#FFFFFF" align=center><span class="tabletext">
                          <a href="scdr.php?recnum=%s">%s</td>',$myrow[11],$myrow[2]);
            }

            echo " </tr>";  
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
</form>
<table border = 0 cellpadding=0 cellspacing=0 width=100% >
<tr>
<td align=left>   

<?php
if ( $userrole == 'SU')
     $numrows = $newcases->getCasesCount($cond,'',$offset, $rowsPerPage);
else
     $numrows = $newcases->getcasecount4ru($cond,'',$offset, $rowsPerPage);

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
    $prev = " <a href=\"cases.php?page=$page&totpages=$totpages&sr=$sr_match&srcritval=$where1&sroperval=&oper\">[Prev]</a> "; 
     
    $first = " <a href=\"cases.php?page=1&totpages=$totpages&sr=$sr_match&srcritval=$where1&sroperval=&oper\">[First Page]</a> "; 
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
    $next = " <a href=\"cases.php?page=$page&totpages=$totpages&sr=$sr_match&srcritval=$where1&sroperval=&oper\">[Next]</a> "; 
     
    $last = " <a href=\"cases.php?page=$totpages&totpages=$totpages&sr=$sr_match&srcritval=$where1&sroperval=&oper\">[Last Page]</a> "; 
} 
else 
{ 
    $next = ' [Next] ';      // we're on the last page, don't enable 'next' link 
    $last = ' [Last Page] '; // nor 'last page' link 
} 

if($totpages!=0)
{
     echo "<span class=\"labeltext\">" . $first . $prev . " Showing page <strong>$pageNum</strong> of <strong>$totpages</strong> pages " . $next . $last; 
}
else
echo "<span class=\"labeltext\"><align=\"center\">No matching records found";

?>
 
</td>
</tr></table>

</body>
</html>
