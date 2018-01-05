<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = May 14,2012                  =
// Filename: updateConsumption.php             =
// Copyright of Badari Mandyam, FluentSoft     =
// Revision: v1.0 OMS                          =
// To allow update of GRN to consumption table =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];
$_SESSION['pagename'] = 'consumptioreport';
//////session_register('pagename');

// First include the class definition
include_once('classes/displayClass.php');
include_once('classes/consumptionClass.php');

$newlogin = new userlogin;
$newlogin->dbconnect();

$newdisplay = new display;
$newconsumption = new consumption;

?>
<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/report.js"></script>

<html>
<head>
<title>Consumption Report</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">
<form action='uploadConsumptionProcess.php' method='post' enctype='multipart/form-data'>
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
<?php
//echo $userid."---**---";
if($userid!="acccons")
{
 $newdisplay->dispLinks('');
}
else
{?>
<tr bgcolor="DEDFDE">
<td width="6"><img src="images/spacer.gif " width="8"></td>
<td width="6"><img src="images/box-left-bottom.gif"></td>
<td><img src="images/spacer.gif " height="6"></td>
<td width="6"><img src="images/box-right-bottom.gif"></td>
<td width="6"><img src="images/spacer.gif " width="8"></td>
</tr>

<?php
}
?>
</td></tr>

<table width=100% border=0 cellpadding=0 cellspacing=0>
  <tr bgcolor="DEDFDE"><td width="6"><img src="images/spacer.gif " width="6"></td>
	    <td bgcolor="#FFFFFF">
 <table width=100% border=0 cellpadding=6 cellspacing=0>
     <tr><td>
		</tr>
  <tr>
<td>
<table width=100% border=0 cellpadding=6 cellspacing=0>
<?php
//echo $userid."---**---";
if($userid=="acccons")
{
?>
<tr>
<td align="right"><a href="consumptionReport.php"<b><img width=30px height=30px border=0 src="images/arrow_left.png" alt="Consumption Report"></b></a></td>
</tr>
<?php
}
?>

<tr>
<td>
<span class="labeltext"><p align="left"><span class='asterisk'>*</span>GRN No.
<input type="text" size=15 name="grnnum" id="grnnum" value="">
<span class="labeltext"><input type="submit"
                     style="color=#0066CC;background-color:#DDDDDD;width=130;"
                     value="Upload" name="Upload">
</td>
</tr>
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
								</td>
							</tr>
						</table>
      </FORM>
</body>
</html>

