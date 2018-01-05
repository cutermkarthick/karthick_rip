<?php
//
//==============================================
// Author: FSI                                 =
// Date-written: June 20, 2004                 =
// Filename: exit.php                          =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OMS                          =
// Exit before logout                          =
//==============================================
session_start();
header("Cache-control: private"); 

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );
}

$userid = $_SESSION['user'];

include_once('classes/loginClass.php'); 
include_once('classes/userClass.php'); 
// Database Connect
$newlogin = new userlogin;
$newlogin->dbconnect();


// Insert into log
$newUser = new user; 
$newUser->insertLog($userid, $_SESSION['user'],'Logged Out');
$newUser->deleteactiveLog($userid);
// Disconnect
$newlogin->dbdisconnect();
// Unset all of the session variables.
$_SESSION = array();
// Finally, destroy the session.
session_destroy(); 
session_unset();
unset($_SESSION['user']);
unset($_SESSION['usertype']);
unset($_SESSION['userrole']);

?>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<html>
<head>
</head>
<body> 	
<?php
include('header1.html');
?>
        <!-- content goes here-->
<table cellspacing="0" cellpadding="6" border="0" width=100%>
<tr>
    <td>
    <table cellspacing="0" cellpadding="2" border="0" width=100%>
    <tr>
        <td><span class="welcome"><b><font color="black" >OMS</font></b></td>
    </tr>
    <tr><td>&nbsp</td></tr>
   

<tr><td>
<table border=0  bgcolor="#E2E2E2" cellpadding="6" cellspacing="1" align="center" width="500">
<tr>
<td bgcolor="#F5F6F5" colspan="10"><span class="heading"><b><center>Thank You</center></b></td></tr><tr>
<td bgcolor="#F5F6F5"  colspan="10"><span class="heading"><b><center>You Have Been Logged Out Sucessfully</center></b></td>
</tr>

        </table>
 
       <table>
       <tr>
        <br> 
        
        </tr>
      </FORM>
</table>
    </td>
</tr>
<!--<tr><td bgcolor="000000"><img src="images/spacer.gif" ></td></tr>-->
</table>
</body>
</html>