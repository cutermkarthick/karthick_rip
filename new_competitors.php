<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = June 20, 2004                =
// Filename: new_company.php                   =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OMS                          =
// Allows entry of new companies               =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
header ( "Location: login.php" );

}

$userid = $_SESSION['user'];
$dept = $_SESSION['department'];

$_SESSION['pagename'] = 'new_competitors';
$page = "CRM: Competitor";
//session_register('pagename');

// First include the class definition
include('classes/competitorsClass.php');
include('classes/displayClass.php');
$newcompetitor = new competitor;
$newdisplay = new display;
?>

<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/competitor.js"></script>

<html>
<head>
<title>New Competitor</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">
<form action='processcompetitors.php' method='post'>

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
<table width=100% border=0 cellspacing=4 >
<tr><td>
<table width=100% border=0>
<td width="100%"><span class="pageheading"><b>New Competitor</b></td>
</table>

<tr>
<td>

<table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=6>
<tr bgcolor="#EEEFEE">
<td colspan=4><span class="heading"><center><b>General Information</b></center></td>
</tr>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1" >
<tr bgcolor="#FFFFFF" colspan=3>
<td><span class="labeltext"><p align="left">Company Name</p></font></td>
<td><span class="labeltext"><input type="text" name="companyname" size=30  value=""></td>
<td><span class="labeltext"><p align="left">Revenue</font></td>
<td><span class="labeltext"><input type="text" name="revenue" size=30  value=""></td>
</tr>
<tr bgcolor="#FFFFFF" colspan=3>
<td><span class="labeltext"><p align="left">Industry Segment</p></font></td>
<td><span class="labeltext"><input type="text" name="industrysegment" size=30  value=""></td>
<td><span class="labeltext"><p align="left">Product</p></font></td>
<td><span class="labeltext"><input type="text" name="product" size=30  value=""></td>
</tr>
<tr bgcolor="#FFFFFF" colspan=3>
<td><span class="labeltext"><p align="left">Phone</p></font></td>
<td><span class="labeltext"><input type="text" name="phone" size=30  value=""></td>
<td><span class="labeltext"><p align="left">Email</p></font></td>
<td><span class="labeltext"><input type="text" name="email" size=30  value=""></td>
</tr>

        <tr bgcolor="#FFFFFF" colspan=3>
         <td ><span class="labeltext"><p align="left">GUID</p></font></td>
         <td colspan=3><input type="text" name="guid" size=30 value="">
         </tr>
        <tr bgcolor="#FFFFFF" colspan=3>
         <td><span class="labeltext">Notes</font></td>
         <td colspan=3><textarea name="notes" rows="4" cols="45" value=""></textarea></td>
        </tr>


<tr bgcolor="#EEEFEE"><td colspan=4><span class="heading"><center><b>Address</b></center></td></tr>
<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">Address1</p></font></td>
<td><span class="labeltext"><input type="text" name="address1" size=30  value=""></td>
<td><span class="labeltext"><p align="left">Address2</p></font></td>
<td><span class="labeltext"><input type="text" name="address2" size=30  value=""></td>
</tr>
<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">City</p></font></td>
<td><span class="labeltext"><input type="text" name="city" size=30  value=""></td>
<td><span class="labeltext"><p align="left">State</p></font></td>
<td><span class="labeltext"><input type="text" name="state" size=30  value=""></td>
</tr>
<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">Zip</p></font></td>
<td><span class="labeltext"><input type="text" name="zip" size=30  value=""></td>
<td><span class="labeltext"><p align="left">Country</p></font></td>
<td><span class="labeltext"><input type="text" name="country" size=30  value=""></td>
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
<table border = 0 cellpadding=0 cellspacing=0 width=100%>
<tr>
<td align=left>
</td>
</tr>
</table>
<span class="labeltext"><input type="submit"
style="color=#0066CC;background-color:#DDDDDD;width=130;"
value="Submit" name="submit" onclick="javascript: return check_req_fields()">
<INPUT TYPE="RESET"
style="color=#0066CC;background-color:#DDDDDD;width=130;"
VALUE="Reset" onclick="javascript: putfocus()">

</FORM>
</body>
</html>