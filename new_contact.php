<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = June 20, 2004                =
// Filename: new_contact.php                   =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OMS                          =
// Allows entry of new contacts                =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];
$dept = $_SESSION['department'];

if (!isset($_SESSION['userrole']))
{
     header ( "Location: login.php" );
}

if ($_SESSION['userrole'] == 'SU'|| $_SESSION['userrole'] == 'SALES' || $_SESSION['userrole'] == 'RU')
{
    $_SESSION['pagename'] = 'newucontact';
}
else
{
    $_SESSION['pagename'] = 'newcontact';
}
//////session_register('pagename');
$page = "Accounts: Contacts";

include('classes/contactClass.php');
include('classes/companyClass.php');
include('classes/displayClass.php');
$newContact = new contact;
$newCompany = new company;
$newdisplay = new display;
?>

<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/contact.js"></script>

<html>
<head>
<title>New Contact</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">
<form action='processContact.php' method='post' enctype='multipart/form-data'>
<?php
include('header.html');
?>
<!-- <table width=100% cellspacing="0" cellpadding="6" border="0">
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
            <?php
            $newdisplay->dispLinks('');
            ?>
				<table width=100% border=0 cellpadding=0 cellspacing=0  >
				<tr bgcolor="DEDFDE">
  				<td width="6"><img src="images/spacer.gif " width="6"></td> -->
				<td bgcolor="#FFFFFF">
				<table width=100% border=0 cellpadding=6 cellspacing=0  >
				<tr><td>
				<table width=100% border=0>
				<tr>
				<td><span class="pageheading"><b>New Contact</b></td>
                </tr>
				</table>
				</td></tr>
				<tr>
				<td>
				<table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=6>
                <tr bgcolor="#EEEFEE">
                <td colspan=4><span class="heading"><center><b>General Information</b></center></td>
                </tr>
  				<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1" >
				<tr bgcolor="#FFFFFF">
                <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Company</p></font></td>
                <td colspan=3><input type="text" name="company"
                    style=";background-color:#DDDDDD;"
                    readonly="readonly" size=30 value="">
                    
                   <img src="images/bu-getcompany.gif" alt="get Company"  onclick="GetCompany()">
                   <input type="hidden" name="companyrecnum">
            </td>

        </tr>


        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">First Name</p></font></td>
            <td><input type="text" name="fname" size=30></td>
            <td><span class="labeltext"><p align="left">Last Name</p></font></td>
            <td><span class="tabletext"><input type="text" name="lname" size=30 value=""></td>
            </tr>
       <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Salutation</p></font></td>
            <td><span class="tabletext"><select name="salutation" size="1" width="100">
             <option selected>Mr.
             <option value>Ms.
            </select><input type="hidden" name="salval">
            </td>
            <td><span class="labeltext"><p align="left">Title</p></font></td>
            <td><span class="tabletext"><input type="text" name="title" size=30 value=""></td>
         </tr>

         <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Role</p></font></td>
            <td><span class="tabletext"><select name="role" size="1" width="100">
             <option selected>RU
             <option value>SU
            </select>
            </td>

            <td><span class="labeltext"><p align="left">Phone</p></font></td>
            <td><span class="tabletext"><input type="text" name="phone" size=30 value=""><input type="hidden" name="roleval"></td>

        </tr>

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Email</p></font></td>
            <td><span class="tabletext"><input type="text" name="email" size=30 value=""></td>

            <td><span class="labeltext"><p align="left">Address 1</p></font></td>
            <td><span class="tabletext"><input type="text" name="address1" size=30 value=""></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Address 2</p></font></td>
            <td><span class="tabletext"><input type="text" name="address2" size=30 value=""></td>

            <td><span class="labeltext"><p align="left">City</p></font></td>
            <td><span class="tabletext"><input type="text" name="city" size=30 value=""></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">State</p></font></td>
            <td><span class="tabletext"><input type="text" name="state" size=30 value=""></td>

            <td><span class="labeltext"><p align="left">Zipcode</p></font></td>
            <td><span class="tabletext"><input type="text" name="zipcode" size=30 value=""></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Country</p></font></td>
            <td><span class="tabletext"><input type="text" name="country" size=30 value=""></td>
            <td><span class="labeltext"><p align="left">Status</p></font></td>
            <td><span class="tabletext"><select name="active" size="1" width="100">
             <option selected>Active
             <option value>Inactive
             <option value>Obsolete
            </select>
	<input type="hidden" name="activeval"></td>
        </tr>
             </table>
			</td>
			</tr>
			</table>
			</td>
			<!-- <td width="6"><img src="images/spacer.gif " width="6"></td>
			</tr>
			<tr bgcolor="DEDFDE">
  			<td width="6"><img src="images/box-left-bottom.gif"></td>
			<td><img src="images/spacer.gif " height="6"></td>
			<td width="6"><img src="images/box-right-bottom.gif"></td>
			</tr> -->
			</table>
			<table border = 0 cellpadding=0 cellspacing=0 width=100% >
			<tr>
			<td align=left>
			</td>
			</tr>
			</table>
        <span class="tabletext"><input type="submit"
                     style="color=#0066CC;background-color:#DDDDDD;width=130;"
                     value="Submit" name="submit" onclick="javascript: return check_req_fields()">
                <INPUT TYPE="RESET"
                     style="color=#0066CC;background-color:#DDDDDD;width=130;"
                     VALUE="Reset" onclick="javascript: putfocus()">

					</FORM>
		</body>
</html>
