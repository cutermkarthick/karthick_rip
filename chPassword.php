<?php
//
//==============================================
// Author: FSI                                 =
// Date-written: June 20, 2004                 =
// Filename: chPassword.php                    =
// Copyright of Badari Mandyam, FluentSoft     =
// Revision: v1.0 OMS                          =
// Change Password page                        =
//==============================================
session_start();
header("Cache-control: private"); 


if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );
    
}

$userid = $_SESSION['user'];
?>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script language="javascript" src="scripts/crypt.js"></script>
<script language="javascript" src="scripts/chpassword.js"></script>
<script language="javascript" src="scripts/mouseover.js"></script>
<link rel="stylesheet" href="style.css">

<html>
<head>
<title>Change Password</title>
<body onload=putfocus();>
</head>

<body leftmargin="0"topmargin="0" marginwidth="0">
<?php
include('header.html');
?>

<table width=100% cellspacing="0" cellpadding="6" border="0">

<tr><td>
<table width=100% border=0 cellspacing="0" cellpadding="0">
    <tr>
 
        <td><span class="welcome"><b>Welcome <?php echo $userid?></b></td>
        <td align="right">&nbsp;
        <a href="exit.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image16','','images/logout_mo.gif',1)"><img name="Image16" border="0" src="images/logout.gif"></a></td>
        
    </tr>
</table>
<table width=100% border=0 cellpadding=0 cellspacing=0  >

		

			<tr bgcolor="DEDFDE">
  				<td width="6"><img src="images/spacer.gif " width="6"></td>
				<td bgcolor="#FFFFFF">

<table width=100% border=1 cellspacing="1" cellpadding="6">


<FORM ACTION = "processPassword.php" METHOD = "POST">
<tr><td><span class="tabletext">User Name: </td><td><?php echo $userid ?></td></tr>
<tr><td><span class="tabletext">Password: </td><td><input type="password" name="userPassword" maxlength="32"></td></tr>
<tr><td><span class="tabletext">New Password: </td><td><input type="password" name="newpassword" maxlength="32"></td></tr>
<tr><td colspan=2><span class="tabletext"><input type="submit" size="60" value="Submit" onclick="javascript: return check_req_fields()"/>
<INPUT TYPE="RESET" VALUE="Reset" onclick="javascript: putfocus()"></td></tr>
       <td><input type="hidden" name="userName" value="<?php echo $userid ?>"</td>  


</form>

        <tr>

            
        </tr>
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

      </FORM>


</table>


					
</body>
</html>

					
</body>
</html>