<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = September 18, 2006           =
// Filename: email.php                         =
// Copyright of Badari Mandyam, FluentSoft     =
// Revision: v1.0 OWT                          =
// Displays list of Leads.                     =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];
$_SESSION['pagename'] = 'newemail';
//session_register('pagename');

// First include the class definition
include_once('classes/userClass.php');
include_once('classes/displayClass.php');
$newdisplay = new display;

?>
<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/leads.js"></script>
<html>
<head>
<title>Calendar</title>
</head>
<?php
include('header.html');
?>
<form action='processemail.php' method='post' >
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
			<table width=100% border=0 cellpadding=0 cellspacing=0  >
    <tr><td></td></tr>
				<tr>
					<td>
<?php $newdisplay->dispLinks(''); ?>
</td></tr>
<table width=100% border=0 cellpadding=0 cellspacing=0  >
  <tr bgcolor="DEDFDE"><td width="6"><img src="images/spacer.gif " width="6"></td>
	    <td bgcolor="#FFFFFF">
      <table width=100% border=0 cellpadding=6 cellspacing=0  >
<tr>
<td>


   <CENTER>
<OBJECT classid="clsid:8E27C92B-1264-101C-8A2F-040224009C02" id="Calendar1" width="288" height="192">
  <param name="_Version" value="524288">
  <param name="_ExtentX" value="7620">
  <param name="_ExtentY" value="5080">
  <param name="_StockProps" value="1">
  <param name="BackColor" value="F5F6F5">
    <?php
        echo date("D M d");
     ?>
  <param name="DayLength" value="1">
  <param name="MonthLength" value="2">
  <param name="DayFontColor" value="5">
  <param name="FirstDay" value="1">
  <param name="GridCellEffect" value="1">
  <param name="GridFontColor" value="10485760">
  <param name="GridLinesColor" value="FEEEEEEEE">
  <param name="ShowDateSelectors" value="-1">
  <param name="ShowDays" value="-1">
  <param name="ShowHorizontalGrid" value="-1">
  <param name="ShowTitle" value="-1">
  <param name="ShowVerticalGrid" value="-1">
  <param name="TitleFontColor" value="10485760">
  <param name="ValueIsNull" value="0">
</OBJECT>
</CENTER>
<?php
$todayis = date("l, F j, Y, g:i a") ;
?>
<p align="center">
Date: <?php echo $todayis ?>
<br />
Thank You :




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
</td>
</tr></table>
               <!--     <span class="tabletext"><input type="submit"
                     style="color=#0066CC;background-color:#DDDDDD;width=130;"
                     value="Submit" name="submit" onclick="javascript: return check_req_fields()">
                    <INPUT TYPE="RESET"
                     style="color=#0066CC;background-color:#DDDDDD;width=130;"
                     VALUE="Reset" onclick="javascript: putfocus()">    -->
</FORM>
</body>
</html >