<?php
session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );
}
$userid = $_SESSION['user'];
$dept = $_SESSION['department'];

$userrole = $_SESSION['userrole'];

//echo $userrole;
$_SESSION['pagename'] = 'wodetailsEntry';
//////session_register('pagename');

include('classes/workorderClass.php');
?>
<html>
<head>
<link rel="stylesheet" href="style.css">
<title>Wo Updates</title>
</head>
<script language="javascript" src="scripts/woupdate4disp.js"></script>
<body leftmargin="0" topmargin="0" marginwidth="0" rightmargin="0">
<form action='processWODisp.php' method='post' enctype='multipart/form-data'>
<br><br>
<table align="center"width=40% border=1 cellspacing="1" cellpadding="6">
<tr bgcolor="#F0F0F0">
<td colspan=18><span class="pageheading"><b>WO Updates</b></td>
</tr>
<tr bgcolor="#FFFFFF">
<td ><span class="labeltext"><p align="left">WO #</p></font></td>
		<td > <input type="text" id="wo_num" name="wo_num" size=20 value=""></td>

</tr>
</table>
<table align="center"width=40% border=0 cellspacing="1" cellpadding="6">
<tr bgcolor="#FFFFFF">
<td>
<span class="labeltext"><input type="submit"
                     style="color=#0066CC;background-color:#DDDDDD;width=130;"
                      value="Submit" name="submit" onClick="javascript: return check_req_fields()">
                      <INPUT TYPE="RESET"
                     style="color=#0066CC;background-color:#DDDDDD;width=130;"
                     VALUE="Reset" onClick="javascript: putfocus()">
                     </td>
</tr>
</table>

</FORM>

		</body>
</html>
