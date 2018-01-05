<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = June 20, 2004                =
// Filename: edit_contact.php                  =
// Copyright of Badari Mandyam, FluentSoft     =
// Revision: v1.0 OWT                          =
// Allows editing of contacts                  =
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
$_SESSION['pagename'] = 'editucontact';
}
else
{
$_SESSION['pagename'] = 'editcontact';
}
//////session_register('pagename');
$page = "Accounts: Contacts";
$contactid = $_REQUEST['contactid'];

// First include the class definition
include('classes/contactClass.php');
include('classes/companyClass.php');
include('classes/displayClass.php');
$newContact = new contact;
$newdisplay = new display;
$result = $newContact->getContact($contactid);
$myrow = mysql_fetch_row($result);
?>


<html>
<head>
<title>Edit Contact</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">
<form action='processContact.php' method='post' enctype='multipart/form-data'>

<?php
include('header.html');
?>
<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/contact.js"></script>
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
<table width=100% border=0 cellpadding=6 cellspacing=0 class="stdtable1" >
<!-- <tr><td>
<table width=100% border=0> -->
<tr>
<td><span class="pageheading"><b>Edit Contact</b></td>
<td colspan=20>&nbsp;</td>
<td bgcolor="#FFFFFF" align="right"><input type= "image" name="Delete" src="images/bu-delete.gif" value="Get" onclick="javascript: return ConfirmDelete()">
</td>
</tr>
</table>
</td></tr>
<tr>
<td>
<table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=6>
<tr bgcolor="#EEEFEE">
<td colspan=4><span class="heading"><center><b>General Information</b></center></td>
</tr>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1">
<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">Contact ID</p></font></td>
<td><span class="tabletext"><?php echo $myrow[4] ?></td>
<td><span class="labeltext"><p align="left">Company</p></font></td>
<td><input type="text" name="company"
style=";background-color:#DDDDDD;"
readonly="readonly" size=20 value="<?php echo $myrow[15] ?>"> <img src="images/bu-getcompany.gif" alt="Get Company"    
onclick="GetCompany()">
<input type="hidden" name="companyrecnum" value="<?php echo $myrow[17] ?>">
</td>

</tr>
<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">First Name</p></font></td>
<td><input type="text" name="fname" size=20 value="<?php echo $myrow[0] ?>"</td>
<td><span class="labeltext"><p align="left">Last Name</p></font></td>
<td><input type="text" name="lname" size=20 value="<?php echo $myrow[1] ?>"</td>
</tr>
<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">Salutation</p></font></td>
<td><span class="tabletext"><input type="text" name="salu" size=15  value="<?php echo $myrow[16] ?>"
<span class="tabletext"><select name="sal" size="1" width="100" onchange="onSelectSal()">
<option value>Please Specify
<option value>Mr.
<option value>Ms.
</select>
</td>
<td><span class="labeltext"><p align="left">Title</p></font></td>
<td><input type="text" name="title" size=20 value="<?php echo $myrow[5] ?>"</td><input type="hidden" name="salval" value="<?php echo $myrow[16] ?>">
</tr>
<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">Role</p></font></td>
<td><span class="tabletext"><input type="text" name="rolename" size=15  value="<?php echo $myrow[3] ?>"
<span class="tabletext"><select name="role" size="1" width="100" onchange="onSelectRole()">
<option value>Please Specify
<option value>SU
<option value>RU
</select>
</td>

<td><span class="labeltext"><p align="left">Phone</p></font></td>
<td><input type="text" name="phone" size=20 value="<?php echo $myrow[6] ?>"</td><input type="hidden" name="roleval" value="<?php echo $myrow[3] ?>">
</tr>
<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">Email</p></font></td>
<td><input type="text" name="email" size=20 value="<?php echo $myrow[7] ?>"</td>
<td><span class="labeltext"><p align="left">Address 1</p></font></td>
<td><input type="text" name="address1" size=20 value="<?php echo $myrow[8] ?>"</td>
</tr>
<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">Address 2</p></font></td>
<td><input type="text" name="address2" size=20 value="<?php echo $myrow[9] ?>"</td>

<td><span class="labeltext"><p align="left">City</p></font></td>
<td><input type="text" name="city" size=20 value="<?php echo $myrow[10] ?>"</td>
</tr>
<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">State</p></font></td>
<td><input type="text" name="state" size=20 value="<?php echo $myrow[11] ?>"</td>
<td><span class="labeltext"><p align="left">Zipcode</p></font></td>
<td><input type="text" name="zipcode" size=20 value="<?php echo $myrow[12] ?>"</td>
</tr>
<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">Country</p></font></td>
<td><input type="text" name="country" size=20 value="<?php echo $myrow[14] ?>"</td>
<td><span class="tabletext"><p align="left"><b>Status</b></p></font></td>
<td><span class="labeltext"><input type="text" name="status" size=20  value="<?php echo $myrow[13] ?>"
<span class="tabletext"><select name="active" size="1" width="40" onchange="onSelectStatus()">
<option selected>Please Specify
<option value>Active
<option value>Inactive
<option value>Obsolete
</select>
<input type="hidden" name="activeval" value="<?php echo $myrow[13] ?>">
<input type="hidden" name="contactid" value="<?php echo $contactid ?>">
<input type="hidden" name="deleteflag" value="">
</td>
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
value="Submit" name="submit">
<INPUT TYPE="RESET"
style="color=#0066CC;background-color:#DDDDDD;width=130;"
VALUE="Reset" onclick="javascript: putfocus1()">

</FORM>
</body>
</html>
