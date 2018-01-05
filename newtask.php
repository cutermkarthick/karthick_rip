<?php
//==============================================
// Author: FSI                                 =
// Date-written = July 20, 2006                =
// Filename: new_leads.php                     =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OWT                          =
// Allows entry of new leads                   =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];

$_SESSION['pagename'] = 'newtask';
//////session_register('pagename');

// First include the class definition
include('classes/userClass.php');
include('classes/tasklistClass.php');
include('classes/displayClass.php');
$newtask = new tasklist;
$newdisplay = new display;

?>

<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/quote.js"></script>

<html>
<head>
<title>New Lead</title>
</head>

<body leftmargin="0"topmargin="0" marginwidth="0">
<form action='processtasklist.php' method='post' >
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
	<table width=100% border=0 cellpadding=0 cellspacing=0  >
   <tr><td></td></tr>
  <tr><td>
<?php $newdisplay->dispLinks(''); ?>
</td></tr>
<table width=100% border=0 cellpadding=0 cellspacing=0  >
   <tr bgcolor="DEDFDE"><td width="6"><img src="images/spacer.gif " width="6"></td>
      <td bgcolor="#FFFFFF">




        <table width=100% border=0 cellpadding=6 cellspacing=0  >
     <tr>
        <td><span class="pageheading"><b> New Task</b></td>
     </tr>
  <td>

<tr>
<td>
<table border=0 bgcolor="#DFDEDF" width=100% >
            <tr bgcolor="#DDDEDD">
            <td colspan=4><span class="heading"><center><b>General Information</b></center></td>
           </tr>
   <table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
       <tr bgcolor="#FFFFFF" width=100%>
           	       <td><span class="labeltext"><p align="left">Lead Name</p></font></td>
            			<td colspan=3><input type="text" name="task1" size=25 value="">
                   </td>

		  </tr>


   		  <tr bgcolor="#FFFFFF" width=100%>

                   <td><span class="labeltext"><p align="left">Email</p></font></td>
            	      <td colspan=3><input type="text" name="task2" size=25 value="">
                   </td>


           </tr>
 			   <tr bgcolor="#FFFFFF">
           		  <td><span class="labeltext"><p align="left">Industry Segment</p></font></td>
            	      <td colspan=3><input type="text" name="task3" size=25 value="">
                   </td>

           </tr>



   </table>
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

        <br>
        <span class="tabletext"><input type="submit"
                     style="color=#0066CC;background-color:#DDDDDD;width=130;"
                     value="Submit" name="submit" onclick="javascript: return check_req_fields()">
                    <INPUT TYPE="RESET"
                     style="color=#0066CC;background-color:#DDDDDD;width=130;"
                     VALUE="Reset" onclick="javascript: putfocus()">
 </FORM>
</table>
</body>
</html>