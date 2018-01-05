<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = Sep 15,2010                  =
// Filename: boxingDetails.php                 =
// Copyright of Badari Mandyam, FluentSoft     =
// Revision: v1.0 OMS                          =
// shows boxing details                        =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );
}
$userid = $_SESSION['user'];
$_SESSION['pagename'] = 'boxingUpdate';
//////session_register('pagename');
$dept = $_SESSION['department'];

// First include the class definition
include_once('classes/userClass.php');
include_once('classes/boxingClass.php');
include_once('classes/displayClass.php');

$newbox = new boxing;
$newdisplay = new display;

$cofcno = $_REQUEST['cofcnum'];
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
<title>Boxing Details</title>
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
        <tr bgcolor="#FFFFFF"><td colspan=9><span class="tabletext"><b><center>Cofc Details</b></td></tr>
        <tr bgcolor="#FFCC00">
            <td bgcolor="#EEEFEE"><span class="tabletext"><b>CofC#</b></td>
            <td bgcolor="#EEEFEE"><span class="tabletext"><b>PRN</b></td>
            <td bgcolor="#EEEFEE"><span class="tabletext"><b>Qty</b></td>
            <td bgcolor="#EEEFEE"><span class="tabletext"><b>WO</b></td>
            <td bgcolor="#EEEFEE"><span class="tabletext"><b>Date</b></td>
            <td bgcolor="#EEEFEE"><span class="tabletext"><b>PO#</b></td>
            <td bgcolor="#EEEFEE"><span class="tabletext"><b>Part#</b></td>
            <td bgcolor="#EEEFEE"><span class="tabletext"><b>Batch#</b></td>
        </tr>
    </tr>
<?php
$prev_wonum="#";
$prev_cofc="#";
$wo_qty = array();
$result = $newbox->getcofc4boxing($cofcno);
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


   	       printf('<tr bgcolor="#FFFFFF"><td width=50px bgcolor="#FFFFFF"><span class="tabletext">%s</td>
                          <td width=50px><span class="tabletext">%s</td>
                          <td width=50px><span class="tabletext">%s</td>
                          <td width=50px><span class="tabletext">%s</td>
                          <td width=70px><span class="tabletext">%s</td>
                          <td width=80px><span class="tabletext">%s</td>
                          <td width=100px><span class="tabletext">%s</td>
                          <td width=100px><span class="tabletext">%s</td>
                          ',
                          $myrow[0],
                          $myrow[8],
                          $myrow[2],
		          $myrow[3],
			  $dispatch_date,
		          $myrow[4],
                          $myrow[5],
                          $myrow[6]);
           printf('</td></tr>');
      $prev_wonum = $myrow[3];
      $prev_cofc = $myrow[0];
      
echo "<input type=\"hidden\" name=\"$myrow[3]\" id=\"$myrow[3]\" value=\"$myrow[2]\">";
}

?>
 <table id="myTable" width=80% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
  <tr  bgcolor="#FFFFFF"><td colspan=7 height=40></td></tr>
  <tr  bgcolor="#FFCC00">
  <tr  bgcolor="#FFFFFF"><td colspan=7><span class="tabletext"><center><b>Boxing Update</b></center></td>
  <tr bgcolor="#FFFFFF"><td colspan=7><a href="javascript:addRow('myTable',document.forms[0].index.value,'<?php echo $cofcno ?>')"><img name="Image7" border="0" src="images/bu-addrow.gif"></a>
   <tr  bgcolor="#FFFFFF">
   <td bgcolor="#FFFFFF"><span class="tabletext"><b>WO#</b></td>
   <td bgcolor="#FFFFFF"><span class="tabletext"><b>Part Box</b></td>
   <td bgcolor="#FFFFFF"><span class="tabletext"><b>Qty</b></td>
   <td bgcolor="#FFFFFF"><span class="tabletext"><b>Main Box#</b></td>
 </tr>
 <tr  bgcolor="#FFCC00">
 <?php
 $i=1;
 $result_box = $newbox->getBoxDetails($cofcno);
 $flag = 0;
 while($i<=2)
 {
  if($flag == 0)
  {
   while($myrow_box=mysql_fetch_row($result_box))
   {
     $cofcnum  = "cofcnum" .$i;
     $ponum = "ponum" .$i;
     $wo = "wo" .$i;
     $partnum = "partnum" .$i;
     $batchno = "batchno" .$i;
     $box = "box" .$i;
     $qty = "qty" .$i;
     $psn = "psn" .$i;
     
     $prev_wo = "prev_wo" .$i;
     $lirecnum = "lirecnum" .$i;
    
       echo "<tr bgcolor=\"#FFFFFF\">";
       //echo "<td><input type=\"text\" id=\"$cofcnum\" name=\"$cofcnum\"  style=\"background-color:#DDDDDD;\" readonly=\"readonly\" size=\"8%\" value=\"$myrow_box[8]\"></td>";
       echo "<td><input type=\"text\" id=\"$wo\" name=\"$wo\" size=\"8%\" value=\"$myrow_box[6]\"></td>";
       echo "<td><input type=\"text\" id=\"$box\" name=\"$box\" size=\"5%\" value=\"$myrow_box[1]\"></td>";
       echo "<td><input type=\"text\" id=\"$qty\" name=\"$qty\" size=\"4%\" value=\"$myrow_box[4]\"></td>";
       echo "<td><input type=\"text\" id=\"$psn\" name=\"$psn\" size=\"6%\" value=\"$myrow_box[2]\"></td>";
       
       echo "<input type=\"hidden\" id=\"$cofcnum\" name=\"$cofcnum\"  size=\"8%\" value=\"$cofcno\">";
       echo "<input type=\"hidden\" id=\"$ponum\" name=\"$ponum\"  size=\"8%\" value=\"$myrow_box[3]\">";
       echo "<input type=\"hidden\" id=\"$partnum\" name=\"$partnum\" size=\"18%\" value=\"$myrow_box[7]\">";
       echo "<input type=\"hidden\" id=\"$batchno\" name=\"$batchno\" size=\"8%\" value=\"$myrow_box[5]\">";
       
       echo "<input type=\"hidden\" name=\"$prev_wo\" value=\"$myrow_box[6]\">";
       echo "<input type=\"hidden\" name=\"$lirecnum\" value=\"$myrow_box[0]\">";
       $i++;
    }
    $flag=1;
   }
     $cofcnum  = "cofcnum" .$i;
     $ponum = "ponum" .$i;
     $wo = "wo" .$i;
     $partnum = "partnum" .$i;
     $batchno = "batchno" .$i;
     $box = "box" .$i;
     $qty = "qty" .$i;
     $psn = "psn" .$i;

     $prev_wo = "prev_wo" .$i;
     $lirecnum = "lirecnum" .$i;


     echo "<tr bgcolor=\"#FFFFFF\">";
     //echo "<td><input type=\"text\" id=\"$cofcnum\" name=\"$cofcnum\"  size=\"8%\" value=\"\"></td>";
     echo "<td><input type=\"text\" id=\"$wo\" name=\"$wo\" size=\"8%\" value=\"\"></td>";
     echo "<td><input type=\"text\" id=\"$box\" name=\"$box\" size=\"5%\" value=\"\"></td>";
     echo "<td><input type=\"text\" id=\"$qty\" name=\"$qty\" size=\"4%\" value=\"\"></td>";
     echo "<td><input type=\"text\" id=\"$psn\" name=\"$psn\" size=\"6%\" value=\"\"></td>";
     
     echo "<input type=\"hidden\" id=\"$cofcnum\" name=\"$cofcnum\"  size=\"8%\" value=\"$cofcno\">";
     echo "<input type=\"hidden\" id=\"$ponum\" name=\"$ponum\"  size=\"8%\" value=\"\">";
     echo "<input type=\"hidden\" id=\"$partnum\" name=\"$partnum\" size=\"18%\" value=\"\">";
     echo "<input type=\"hidden\" id=\"$batchno\" name=\"$batchno\" size=\"8%\" value=\"\">";

     echo "<input type=\"hidden\" name=\"$prev_wo\" value=\"\">";
     echo "<input type=\"hidden\" name=\"$lirecnum\" value=\"\">";
     $i++;
 }
    echo "<input type=\"hidden\" name=\"index\" value=$i>";
    echo "<input type=\"hidden\" name=\"cofc\" id=\"cofc\" value=\"$cofcno\">";
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

