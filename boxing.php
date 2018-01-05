<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = Sep 15,2010                  =
// Filename: psn.php                           =
// Copyright of Badari Mandyam, FluentSoft     =
// Revision: v1.0 OMS                          =
// Displays list of psn                        =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];
$_SESSION['pagename'] = 'boxing';
//////session_register('pagename');
$dept = $_SESSION['department'];

// First include the class definition
include_once('classes/userClass.php');
include_once('classes/dispatchClass.php');
include_once('classes/displayClass.php');
include_once('classes/boxingClass.php');

$newbox = new boxing;
$newdisplay = new display;

$cond0 = "d.relnotenum like '%'";
$cond1 = "(dli.wonum like '%')";

$cond = $cond0 .' and '.$cond1;

if ( isset ( $_REQUEST['cofc'] ) )
{
     $finalcofc_match = $_REQUEST['cofc'];
     if ( isset ( $_REQUEST['cofc_oper'] ) ) {
          $oper1 = $_REQUEST['cofc_oper'];
     }
     else {
         $oper1 = 'like';
     }
     if ($oper1 == 'like') {
         $final_relno = "'" . $_REQUEST['cofc'] . "%" . "'";
     }
     else {
         $final_relno = "'" . $_REQUEST['cofc'] . "'";
     }

     $cond0 = "d.relnotenum " . $oper1 . " " . $final_relno;

}
else
{
     $finalrel_match = '';
}

if ( isset ( $_REQUEST['wo'] ) )
{
     $finalwo_match = $_REQUEST['wo'];
     if ( isset ( $_REQUEST['wo_oper'] ) ) {
          $oper2 = $_REQUEST['wo_oper'];
     }
     else {
         $oper2 = 'like';
     }
     if ($oper2 == 'like') {
         $final_wo = "'" . $_REQUEST['wo'] . "%" . "'";
     }
     else {
         $final_wo = "'" . $_REQUEST['wo'] . "'";
     }

     $cond1 = "dli.wonum " . $oper2 . " " . $final_wo;

}
else
{
     $finalwo_match = '';
}

$cond = $cond0 . ' and '. $cond1;
$userrole = $_SESSION['userrole'];
$dept = $_SESSION['department'];
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
?>
<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<html>
<head>
<title>Box</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">
<form action='boxing.php' method='POST' enctype='multipart/form-data'>
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
  <tr>
<td>

<table width=80% border=0 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF">
<tr>
<td bgcolor="#F5F6F5" colspan="13"><span class="heading"><b><center>Search Criteria</center></b></td>
<td bgcolor="#FFFFFF" rowspan=3 align="center"><span class="tabletext"><input type= "image" name="Get" src="images/bu-get.gif" value="Get" onclick="javascript: return searchsort_fields()"></td>
</tr>
<tr>
<td bgcolor="#FFFFFF"><span class="heading"><b>CofC</b></td>
<td bgcolor="#FFFFFF"><span class="tabletext"><select name="cofc_oper" size="1" width="50">
<?php
   if ( isset ( $_REQUEST['cofc_oper'] ) ){
          $oper1 = $_REQUEST['cofc_oper'];

                   if ($oper1 =='like'){
?>
    	            <option value='='>=
	                <option value='like' selected>like
<?php
                    }else{
?>
                    <option value='=' selected>=
	                <option value='like'>like

 <?php
                    }
        }else{
?>
 	<option value='like' selected>like
	<option value='='>=
 <?php
  }
 ?>
</select></td>
<td bgcolor="#FFFFFF"><span class="heading"><input type="text" size=8% name="cofc" value="<?echo $_REQUEST['cofc']?>"></td>
</td>
<td bgcolor="#FFFFFF"><span class="heading"><b>WO#</b></td>
<td bgcolor="#FFFFFF"><span class="tabletext"><select name="wo_oper" size="1" width="50">
<?php
   if ( isset ( $_REQUEST['wo_oper'] ) ){
          $oper2 = $_REQUEST['wo_oper'];

                   if ($oper2 =='like'){
?>
    	            <option value='='>=
	                <option value='like' selected>like
<?php
                    }else{
?>
                    <option value='=' selected>=
	                <option value='like'>like

 <?php
                    }
        }else{
?>
 	<option value='like' selected>like
	<option value='='>=
 <?php
  }
 ?>
</select></td>
<td bgcolor="#FFFFFF"><span class="heading"><input type="text" size=8% name="wo" value="<?echo $_REQUEST['wo']?>"></td>
</td>
</td>
</tr>
</table>
	</td></tr>
	<tr><td>
<table width=100% border=0>
  <td colspan=160>&nbsp;</td>
  <tr>
  <td><span class="pageheading"><b>List of Boxes</b></td>
  </tr>
</table>
<table width="100%"  border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
        <tr bgcolor="#FFCC00">
            <td width="60px" bgcolor="#EEEFEE"><span class="tabletext"><b>CofC#</b></td>            
			<td width="75px" bgcolor="#EEEFEE"><span class="tabletext"><b>Date</b></td>            
			<td width="140px" bgcolor="#EEEFEE"><span class="tabletext"><b>PO#</b></td>           
			<td width="60px" bgcolor="#EEEFEE"><span class="tabletext"><b>PRN</b></td>           
			<td width="140px" bgcolor="#EEEFEE"><span class="tabletext"><b>Part#</b></td>            
			<td width="60px" bgcolor="#EEEFEE"><span class="tabletext"><b>WO</b></td>
            <td width="60px" bgcolor="#EEEFEE"><span class="tabletext"><b>Qty</b></td>           
           <td width="60px" bgcolor="#EEEFEE"><span class="tabletext"><b>Box#</b></td>           
           <td width="60px" bgcolor="#EEEFEE"><span class="tabletext"><b>Box Qty</b></td>           
          <td width="60px" bgcolor="#EEEFEE"><span class="tabletext"><b>Balance</b></td>                      
        </tr>
</table>
<table width="100%"  border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
<?php
$prev_cofc = "#";
$prev_wo = "#";
$bal = 0;
$flag = 0;
$result = $newbox->getCofcs($cond,$offset,$rowsPerPage);
while ($myrow = mysql_fetch_row($result))
{
	  if($myrow[1] != '' && $myrow[1] != '0000-00-00')
      {
                 $datearr = split('-', $myrow[1]);
                 $d=$datearr[2];
                 $m=$datearr[1];
                 $y=$datearr[0];
                 $x=mktime(0,0,0,$m,$d,$y);
                 $dispatch_date=date("M j, Y",$x);
       }
       else
       {
             $dispatch_date = '';
        }
		if ($flag == 0)
	   {
			   $prev_cofc = $myrow[0];
			   $prev_wo = $myrow[7];
		  	   $bal = $myrow[2]-$myrow[9];       
   	           printf('<tr bgcolor="#FFFFFF">
			             <td width="60px" bgcolor="#FFFFFF"><span class="tabletext">
                          <a href="boxingDetails.php?cofcnum=%s">%s</a></td>
                          <td width="60px"><span class="tabletext">%s</td>
                          <td width="140px"><span class="tabletext">%s</td>
                          <td width="60px"><span class="tabletext">%s</td>
                          <td width="140px"><span class="tabletext">%s</td>
                          <td width="60px"><span class="tabletext">%s</td>                          
						  <td width="60px"><span class="tabletext">%s</td>                         
						  <td width="60px"><span class="tabletext">%s</td>                         
						  <td width="60px"><span class="tabletext">%s</td>                        
						  <td width="60px"><span class="tabletext">%d</td>
                          ',
                          $myrow[0],
                          $myrow[0],
						  $dispatch_date,
                          $myrow[3],
		                  $myrow[5],                          
		                  $myrow[4],
                          $myrow[7],
						  $myrow[2],
						  $myrow[8],
						  $myrow[9],
						  $bal
						);              

	   }

	    if ($flag !=0)
	   {
			if ($prev_cofc != $myrow[0])
	       {
			       $bal = $myrow[2]-$myrow[9];  
				   
   	           printf('<tr bgcolor="#FFFFFF">
			             <td width="60px" bgcolor="#FFFFFF"><span class="tabletext">
                          <a href="boxingDetails.php?cofcnum=%s">%s</a></td>
                          <td width="60px"><span class="tabletext">%s</td>
                          <td width="140px"><span class="tabletext">%s</td>
                          <td width="60px"><span class="tabletext">%s</td>
                          <td width="140px"><span class="tabletext">%s</td>
                          <td width="60px"><span class="tabletext">%s</td>                          
						  <td width="60px"><span class="tabletext">%s</td>                         
						  <td width="60px"><span class="tabletext">%s</td>                         
						  <td width="60px"><span class="tabletext">%s</td>                        
						  <td width="60px"><span class="tabletext">%d</td>
                          ',
                          $myrow[0],
                          $myrow[0],
						  $dispatch_date,
                          $myrow[3],
		                  $myrow[5],                          
		                  $myrow[4],
                          $myrow[7],
						  $myrow[2],
						  $myrow[8],
						  $myrow[9],
						  $bal
						);              
					     $prev_cofc = $myrow[0];
					     $prev_wo = $myrow[7];
					   print('</td></tr>');
		      }
		      else   if ($prev_wo != $myrow[7])
	          {
				   $bal = $myrow[2]-$myrow[9];  
				   
				    printf('<tr bgcolor="#FFFFFF">
					      <td width="60px" bgcolor="#FFFFFF">&nbsp;</td>
                          <td width="60px"><span class="tabletext">&nbsp;</td>
                          <td width="140px"><span class="tabletext">&nbsp;</td>
                          <td width="60px"><span class="tabletext">&nbsp;</td>
                          <td width="140px"><span class="tabletext">&nbsp;</td>
                          <td width="60px"><span class="tabletext">%s</td>
                          <td width="60px"><span class="tabletext">%s</td>
                          <td width="60px"><span class="tabletext">%s</td>
                          <td width="60pxx"><span class="tabletext">%s</td>
                          <td width="60px"><span class="tabletext">%d</td>
                          ',
                          $myrow[7],
						  $myrow[2],
						  $myrow[8],
						  $myrow[9],
						  $bal); 
					   print('</td></tr>');
					   $prev_wo = $myrow[7];
	          }
		   else
	       {
			   $bal =  $bal -$myrow[9];  

				    printf('<tr bgcolor="#FFFFFF">
					      <td width="60px" bgcolor="#FFFFFF">&nbsp;</td>
                          <td width="60px"><span class="tabletext">&nbsp;</td>
                          <td width="140px"><span class="tabletext">&nbsp;</td>
                          <td width="60px"><span class="tabletext">&nbsp;</td>
                          <td width="140px"><span class="tabletext">&nbsp;</td>
                          <td width="60px"><span class="tabletext">%s</td>
                          <td width="60px"><span class="tabletext">%s</td>
                          <td width="60px"><span class="tabletext">%s</td>
                          <td width="60pxx"><span class="tabletext">%s</td>
                          <td width="60px"><span class="tabletext">%d</td>
                          ',
                          $myrow[7],
						  $myrow[2],
						  $myrow[8],
						  $myrow[9],
						  $bal); 
					   print('</td></tr>');
		}
	   }
		$flag=1;
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
<table border=0 cellpadding=0 cellspacing=0 width=100%>
<tr>
	<td align=left>
  <?php
//Added on Dec 6,04 for paging

$numrows = $newbox->getcofccount($cond,$offset,$rowsPerPage);
//echo "rows=$numrows<br>";
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
    $prev = " <a href=\"boxing.php?page=$page&totpages=$totpages&cofc=$finalcofc_match&wo=$finalwo_match\">[Prev]</a> ";

    $first = " <a href=\"boxing.php?page=1&totpages=$totpages&cofc=$finalcofc_match&wo=$finalwo_match\">[First Page]</a> ";
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
    $next = " <a href=\"boxing.php?page=$page&totpages=$totpages&cofc=$finalcofc_match&wo=$finalwo_match\">[Next]</a> ";

    $last = " <a href=\"boxing.php?page=$totpages&totpages=$totpages&cofc=$finalcofc_match&wo=$finalwo_match\">[Last Page]</a> ";
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

<table border=0 cellpadding=0 cellspacing=0 width=100%>
<tr>
<td align=left>
</td>
</tr>
</table>
</FORM>
</body>
</html>

