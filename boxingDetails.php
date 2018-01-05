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
$_SESSION['pagename'] = 'boxingDetails';
//////session_register('pagename');
$dept = $_SESSION['department'];

// First include the class definition
include_once('classes/userClass.php');
include_once('classes/boxingClass.php');
include_once('classes/displayClass.php');

$newbox = new boxing;
$newdisplay = new display;

$cofc = $_REQUEST['cofcnum'];
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
        <tr bgcolor="#FFFFFF"><td colspan=9><span class="tabletext"><b><center>Cofc Details</center></b></td></tr>
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

$result = $newbox->getcofc4boxing($cofc);
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
}
?>
 <table  width=80% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
  <tr  bgcolor="#FFFFFF"><td colspan=10 height=40></td></tr>

  <tr  bgcolor="#FFFFFF"><td colspan=10><span class="tabletext"><center><b>Boxing Details</b></center>
  <a href ="boxingUpdate.php?cofcnum=<?php echo $cofc ?>"><img name="Image8" border="0" align="right" src="images/bu-edit.gif" ></a></td></tr>

   <td bgcolor="#FFFFFF"><span class="tabletext"><b>CofC</b></td>
   <td bgcolor="#FFFFFF"><span class="tabletext"><b>PRN</b></td>
   <td bgcolor="#FFFFFF"><span class="tabletext"><b>PO#</b></td>
   <td bgcolor="#FFFFFF"><span class="tabletext"><b>WO#</b></td>
   <td bgcolor="#FFFFFF"><span class="tabletext"><b>Part#</b></td>
   <td bgcolor="#FFFFFF"><span class="tabletext"><b>Batch#</b></td>
   <td bgcolor="#FFFFFF"><span class="tabletext"><b>Part Box#</b></td>
   <td bgcolor="#FFFFFF"><span class="tabletext"><b>Qty</b></td>
   <td bgcolor="#FFFFFF"><span class="tabletext"><b>Main Box#</b></td>
   <td bgcolor="#FFFFFF"><span class="tabletext"><b>Print</b></td>
 </tr>
 <tr  bgcolor="#FFCC00">
 <?php
 $i=1;
 $result_box = $newbox->getBoxDetails($cofc);
 while($myrow_box=mysql_fetch_row($result_box))
 {
     $cofcnum = $myrow_box[8];
     $crn=$myrow_box[9];
     $ponum = $myrow_box[3];
     $wo = $myrow_box[6];
     $partnum = $myrow_box[7];
     $batchno = $myrow_box[5];
     $box = $myrow_box[1];
     $qty = $myrow_box[4];
     $mbn = $myrow_box[2];

     echo "<tr bgcolor=\"#FFFFFF\">";
     echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$cofcnum</td>";
     echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$crn</td>";
     echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$ponum</td>";
     echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$wo</td>";
     echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$partnum</td>";
     echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$batchno</td>";
     echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$box</td>";
     echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$qty</td>";
     echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$pbn</td>";
 ?>
    <td bgcolor="#FFFFFF"><span class="tabletext">
                          <a href="print_prn.php?ponum=<?php echo $ponum ?>&partnum=<?php echo $partnum?>&qty=<?php echo $qty?>&cofc=<?php echo $cofcnum?>&mbn=<?php echo $mbn?>&wonum=<?php echo $wo?>&box=<?php echo $box?>&crn=<?php echo $crn?>">Save</td>
<?php
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

								</td>
							</tr>
						</table>
      </FORM>
</body>
</html>

