<?php
//==============================================
// Author: FSI                                 =
// Date-written = Sep 15,2010                  =
// Filename: boxing.php                        =
// Copyright of Badari Mandyam, FluentSoft     =
// Revision: v1.0 OMS                          =
// creates boxes with psn                      =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );
}
$userid = $_SESSION['user'];
$_SESSION['pagename'] = 'boxingEntry';
//////session_register('pagename');
$dept = $_SESSION['department'];

// First include the class definition
include_once('classes/userClass.php');
include_once('classes/boxingClass.php');
include_once('classes/displayClass.php');

$newbox = new boxing;
$newdisplay = new display;

$cofcno = $_REQUEST['cofcnum'];
//echo $cofc;
$userrole = $_SESSION['userrole'];
$dept = $_SESSION['department'];
// how many rows to show per page
$rowsPerPage = 100;
// by default we show first page
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
<script language="javascript" src="scripts/boxing.js"></script>

<html>
<head>
<title>Boxing Entry</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">
<form action='processBox.php' method='GET' enctype='multipart/form-data'>
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
<table width=80% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
        <tr bgcolor="#FFFFFF"><td colspan=9><span class="tabletext"><b><center>Cofc Details</center></b></td></tr>
        <tr bgcolor="#FFCC00">
            <td bgcolor="#EEEFEE"><span class="tabletext"><b>CofC#</b></td>
            <td bgcolor="#EEEFEE"><span class="tabletext"><b>Qty</b></td>
            <td bgcolor="#EEEFEE"><span class="tabletext"><b>WO</b></td>
            <td bgcolor="#EEEFEE"><span class="tabletext"><b>Date</b></td>
            <td bgcolor="#EEEFEE"><span class="tabletext"><b>PO#</b></td>
            <td bgcolor="#EEEFEE"><span class="tabletext"><b>Part#</b></td>
            <td bgcolor="#EEEFEE"><span class="tabletext"><b>Batch#</b></td>
            <td bgcolor="#EEEFEE"><span class="tabletext"><b>P/S #</b></td>
        </tr>
    </tr>
<?php
$po_arr = array();
$part_arr = array();
$wo_arr = array();
$batch_arr = array();
$k=1;
$prev_wonum="#";
$prev_cofc="#";
$wo_qty = array();
$result = $newbox->getcofc4boxing($cofcno);
while ($myrow = mysql_fetch_row($result))
{
               $cofc_arr[$k] = $myrow[0];
               $po_arr[$k] = $myrow[4];
               $part_arr[$k] = $myrow[5];
               $wo_arr[$k] = $myrow[3];
               $batch_arr[$k] = $myrow[6];
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


   	       printf('<tr bgcolor="#FFFFFF"><td width=50px bgcolor="#FFFFFF"><span class="tabletext">%s</td>
                          <td width=50px><span class="tabletext">%s</td>
                          <td width=50px><span class="tabletext">%s</td>
                          <td width=70px><span class="tabletext">%s</td>
                          <td width=80px><span class="tabletext">%s</td>
                          <td width=100px><span class="tabletext">%s</td>
                          <td width=100px><span class="tabletext">%s</td>
                          <td width=60px><span class="tabletext">%s</td>
                          ',
                          $myrow[0],
                          $myrow[2],
		                  $myrow[3],
						  $dispatch_date,
		                  $myrow[4],
                          $myrow[5],
                          $myrow[6],
                          $myrow[7]);
           printf('</td></tr>');
          $k++;
          $prev_wonum = $myrow[3];
          $prev_cofc = $myrow[0];
      
       echo "<input type=\"hidden\" name=\"$myrow[3]\" id=\"$myrow[3]\" value=\"$myrow[2]\">";
}



?>

 <table  id="myTable" width=80% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
   <tr  bgcolor="#FFFFFF"><td colspan=8 height=40></td></tr>
   <tr bgcolor="#FFFFFF"><td colspan=8><a href="javascript:addRow('myTable',document.forms[0].index.value,'<?php echo $cofcno ?>')"><img name="Image7" border="0" src="images/bu-addrow.gif"></a>
   <span class="tabletext"><b><center>New Entry</center></b></td></tr>
   <td bgcolor="#FFFFFF"><span class="tabletext"><b>WO#</b></td>
   <td bgcolor="#FFFFFF"><span class="tabletext"><b>Box</b></td>
   <td bgcolor="#FFFFFF"><span class="tabletext"><b>Qty</b></td>
   <td bgcolor="#FFFFFF"><span class="tabletext"><b>P/S #</b></td>
 </tr>
 
 <tr  bgcolor="#FFCC00">
 <?php
 $i=1;
 while($i<=2)
 {
   $cofcnum = "cofcnum"  .$i;
   $ponum = "ponum" .$i;
   $wo = "wo" .$i;
   $partnum = "partnum" .$i;
   $batchno = "batchno" .$i;
   $box = "box" .$i;
   $qty = "qty" .$i;
   $psn = "psn" .$i;
  
   echo "<tr bgcolor=\"#FFFFFF\">";
   //echo "<td bgcolor=\"#FFFFFF\"><input type=\"text\" id=\"$cofcnum\" name=\"$cofcnum\"  size=\"8\" value=\"$cofc_arr[$i]\"></td>";
   echo "<td bgcolor=\"#FFFFFF\"><input type=\"text\" id=\"$wo\" name=\"$wo\" size=\"8\" value=\"$wo_arr[$i]\"></td>";
   echo "<td bgcolor=\"#FFFFFF\"><input type=\"text\" id=\"$box\" name=\"$box\" size=\"5\" value=\"\"></td>";
   echo "<td bgcolor=\"#FFFFFF\"><input type=\"text\" id=\"$qty\"  name=\"$qty\" size=\"4\" value=\"\"></td>";
   echo "<td bgcolor=\"#FFFFFF\"><input type=\"text\" id=\"$psn\" name=\"$psn\" size=\"6\" value=\"\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></td>";
   echo "<input type=\"hidden\" name=\"$cofcnum\" size=\"8\" value=\"$cofcno\">";
   echo "<input type=\"hidden\" name=\"$ponum\" size=\"8\" value=\"$po_arr[$i]\">";
   echo "<input type=\"hidden\" name=\"$partnum\" size=\"18\" value=\"$part_arr[$i]\">";
   echo "<input type=\"hidden\" name=\"$batchno\" size=\"8\" value=\"$batch_arr[$i]\">";
   $i++;
 }
 
 echo "<input type=\"hidden\" name=\"index\" id=\"index\" value=\"$i\">";
 echo "<input type=\"hidden\" name=\"cofc\"  id=\"cofc\" value=\"$cofcno\">";
?>
 </table>
 <span class="tabletext">
        <INPUT type="submit"
        style="color=#0066CC;background-color:#DDDDDD;width=130;"
        value="Submit" name="submit" onclick="javascript: return check_req_fields()">
        <INPUT TYPE="RESET"
        style="color=#0066CC;background-color:#DDDDDD;width=130;"
        VALUE="Reset" onclick="javascript: putfocus()">
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
							
								</td>
							</tr>
						</table>
      </FORM>
</body>
</html>

