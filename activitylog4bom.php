<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = June 20, 2004                =
// Filename: getallemps.php                    =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OMS                          =
// Popup for selecting employees               =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}

$userid = $_SESSION['user'];
$bomrecnum=$_SESSION['bomrecnum'];
include('classes/userClass.php');
include('classes/vendPartClass.php');
$newuser = new user;
$newvendPart= new vendPart;
?>

<html>
<head>
    <title>Activty Log</title>
</head>

<form>
<tr>
<td>

<table width=100% border=0 cellpadding=0 cellspacing=0  >
<tr><td>
</td></tr>
<tr>
<td>
</td></tr><tr width=100% bgcolor="DEDEDF"><td><img width="5" src="images/spacer.gif" height="1">
</td></tr>
</table>
<table width=100% border=0 cellpadding=0 cellspacing=0  >
<tr bgcolor="DEDFDE">
<td width="6"><img src="images/spacer.gif " width="6"></td>
<td bgcolor="#FFFFFF">

<table width=100% border=0 cellspacing="1" cellpadding="6">
<tr>
                <td><span class="pageheading"><b>BOM Activity Log</b></td>
</tr>

</tr>
<table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3>
<?php /*<tr bgcolor="#FFFFFF"><td colspan=5><a href="javascript:addRow('myTable',document.forms[0].index1.value)"><img name="Image7" border="0" src="images/bu-addrow.gif"></a></td></tr> */ ?>

<tr bgcolor="#FFFFFF">
<table id="myTable" width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Type</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Qty</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Ref Type</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Ref Num</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Date</center></b></td>
</tr>



<?php
$result=$newvendPart->getInventory($bomrecnum);
while ($myrow = mysql_fetch_row($result)) {

	printf('<tr bgcolor="#FFFFFF">');
	echo "<td align=\"center\"><span class=\"tabletext\">$myrow[0]</td>";
	echo "<td align=\"center\"><span class=\"tabletext\">$myrow[1]</td>";
                echo " <td><span class=\"tabletext\">$myrow[2]</td>";

	echo "<td align=\"center\"><span class=\"tabletext\">$myrow[3]</td>";
	echo "<td align=\"center\"><span class=\"tabletext\">$myrow[4]
	          </td>";
	printf('</tr>');

?>





<?php
}
?>

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


</html>