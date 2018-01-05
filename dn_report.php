<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = July 01, 2010                =
// Filename: dn_report.php                     =
// Copyright of Badari Mandyam, FluentSoft     =
// Revision: v1.0 OMS                          =
// Displays list of CRN.                       =
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

// First include the class definition
include_once('classes/userClass.php');
include_once('classes/reportClass.php');
include_once('classes/displayClass.php');

$newlogin = new userlogin;
$newlogin->dbconnect();

$report = new report;
$newdisplay = new display;

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


$cond0 = "d.sent_treat_to like '%'";
$cond1 = "d.crn like '%'";
$cond = $cond0 . ' and ' . $cond1 ;

if (  $_REQUEST['treat_to'] != 'select' && $_REQUEST['treat_to'] != '')
{
 $finaltreat_to = $_REQUEST['treat_to'];
 $treat_to = "'" . $_REQUEST['treat_to'] . "'";
 $cond0 = " d.sent_treat_to = " . $treat_to; 
}
else 
{
     $treat_to = '';
}

if (  $_REQUEST['crnnum'] != '' )
{
     $crnnum = $_REQUEST['crnnum'];
     if ( isset ( $_REQUEST['refno_oper'] ) ) {
          $oper1 = $_REQUEST['refno_oper'];
     }
     else {
         $oper1= 'like';
     }
     if ($oper1 == 'like') {
         $final_crnnum = "'" . $_REQUEST['crnnum'] . "%" . "'";
     }
     else {         
         $final_crnnum = "'" . $_REQUEST['crnnum'] . "'";              
     }
     $cond1 = " d.crn " . $oper1 . " " . $final_crnnum;
}
else {
     $crnnum = '';
}

$cond = $cond0 . ' and ' . $cond1;
?>
<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/report.js"></script>

<html>
<head>
<title>DN Report</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">
<form action='dn_report.php' method='post' enctype='multipart/form-data'>
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
<?php $newdisplay->dispLinks(''); 
$result = $report->getVendors();
?>
</td></tr>
<table width=100% border=0 cellpadding=0 cellspacing=0>
  <tr bgcolor="DEDFDE"><td width="6"><img src="images/spacer.gif " width="6"></td>
	    <td bgcolor="#FFFFFF">
 <table width=100% border=0 cellpadding=6 cellspacing=0>
     <tr><td>

  <tr>
<td>

<table width=100% border=0 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF">
  <tr>
	<td bgcolor="#F5F6F5" colspan="10"><span class="heading"><b><center>Search & SortCriteria</center></b></td>
    <td bgcolor="#FFFFFF" rowspan=3 align="center">
	<input type= "image" name="submit" src="images/bu-get.gif" value="Get" onclick="javascript:return getsupp_crn_details()">
</td>
  </tr>
<tr>
<td bgcolor="#FFFFFF"><span class="labeltext"><b>Supplier Name</b></td>
<td bgcolor="#FFFFFF">
<select name='treat_to' id='treat_to'>
<option value='select'>Select</option>
<?php
while ($myrow = mysql_fetch_row($result)){
if($myrow[1]==$_REQUEST['treat_to']){
?>
<option selected value="<? echo $myrow[1]?>">
<?echo $myrow[1]; ?>
</option>
<?
}
else{
?>
<option value="<? echo $myrow[1]?>">
<?echo $myrow[1]; ?> </option>
<?php
}
}
?>
</select>
</td>
</td>

<td bgcolor="#FFFFFF"><span class="labeltext"><b>PRN</b></td>

<td bgcolor="#FFFFFF"><span class="tabletext"><select name="refno_oper" size="1" width="50">
<?php
   if ( isset ( $_REQUEST['refno_oper'] ) ){
          $oper1 = $_REQUEST['refno_oper'];

                   if ($oper1 =='like'){
?>
    	            <option value='='>=
	                <option selected ='like'>like
<?php
                    }else{
?>
                    <option selected ='='>=
	                <option value ='like'>like

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

<td bgcolor="#FFFFFF" colspan=6><input type="text" name="crnnum" id="crnnum"  size=15 value="<?php echo $crnnum ?>">
</td>
<tr>
</tr>
</table>
	</td></tr>
	<tr><td>

<?
if($treat_to!='' || $crnnum!='')
{?>
<table width=100% border=0>
  <tr>
  <td><span class="pageheading"><b>List Of DN</b></td>
  </td>
 <td align="right"><a href="dnreport_export.php?crnnum=<?php echo $crnnum ?>&company=<?php echo $finaltreat_to ?>"><b>
 <img src="images/export.gif" alt="DN Stock Report"></b></a></td>
  </tr>
</table>

<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
        <tr  bgcolor="#FFCC00">
            <td  bgcolor="#EEEFEE"><span class="tabletext"><b>Sl.No</b></td>
            <td  bgcolor="#EEEFEE"><span class="tabletext"><b>DN #.</b></td>
            <td  bgcolor="#EEEFEE"><span class="tabletext"><b>DN Date</b></td>
            <td  bgcolor="#EEEFEE"><span class="tabletext"><b>PRN</b></td>   
            <td  bgcolor="#EEEFEE"><span class="tabletext"><b>WO#</b></td>          
            <td  bgcolor="#EEEFEE"><span class="tabletext"><b>Part No.(after treatment)</b></td>           
            <td  bgcolor="#EEEFEE"><span class="tabletext"><b>SP PO#</b></td>    
	    <td  bgcolor="#EEEFEE"><span class="tabletext"><b>DN Qty</b></td>      
            <td  bgcolor="#EEEFEE"><span class="tabletext"><b>Unreturned Qty</b></td>  
        </tr>

<?php

    $result = $report->getdeliverDetails($cond,$offset,$rowsPerPage);

            while ($myrow = mysql_fetch_row($result)) {	
              if($myrow[2] != '0000-00-00' && $myrow[2] != '' && $myrow[2] != 'NULL')
              {
                $datearr = split('-', $myrow[2]);
                $d=$datearr[2];
                $m=$datearr[1];
                $y=$datearr[0];
                $x=mktime(0,0,0,$m,$d,$y);
                $deliver_date=date("M j, Y",$x);
	          }
	      else
              {
                $deliver_date="";
	      }
              $dnqty=$myrow[6] ? $myrow[6] : 0;
              $dliqty_recd=$myrow[7] ? $myrow[7] : 0;

              $unretured_qty = $dnqty-$dliqty_recd;
             
   	       printf('<tr bgcolor="#FFFFFF">
                        <td><span class="tabletext">%s</td>
                        <td><span class="tabletext">%s</td>                          
                        <td><span class="tabletext">%s</td>
                        <td><span class="tabletext">%s</td>
                         <td><span class="tabletext">%s</td>
                        <td><span class="tabletext">%s</td>
                        <td><span class="tabletext">%s</td>
                        <td><span class="tabletext">%s</td>
                        <td><span class="tabletext">%s</td>			
                          ',
		         $myrow[0],
                         $myrow[1],
                         $deliver_date,
                         $myrow[3],  
                         $myrow[9],                      
                         $myrow[4],                        
                         $myrow[5],
                         $myrow[6],
                         $unretured_qty);



           printf('</td></tr>');

        }

?>
</table>
<?}?>

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
if($treat_to!='' || $crnnum!='')
{
   $numrows = $report->getdeliverDetailsCount($cond,$offset,$rowsPerPage);
   //echo $numrows;
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
    $prev = " <a href=\"dn_report.php?page=$page&totpages=$totpages&treat_to=$finaltreat_to&crnnum=$crnnum&submit=Get\">[Prev]</a> ";

    $first = " <a href=\"dn_report.php?page=1&totpages=$totpages&treat_to=$finaltreat_to&crnnum=$crnnum&submit=Get\">[First Page]</a> ";
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
    $next = " <a href=\"dn_report.php?page=$page&totpages=$totpages&treat_to=$finaltreat_to&crnnum=$crnnum&submit=Get\">[Next]</a> ";

    $last = " <a href=\"dn_report.php?page=$totpages&totpages=$totpages&treat_to=$finaltreat_to&crnnum=$crnnum&submit=Get\">[Last Page]</a> ";
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
<?}?>
</FORM>
</body>
</html>

