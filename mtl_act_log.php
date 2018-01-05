<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = July 22, 2005                =
// Filename: mtl_act_log.php                   =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OMS                          =
//==============================================
session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];

include('classes/displayClass.php');
include('classes/mtl_trackerclass.php');
$newdisp = new display;
$newmtl = new mtl_trk;
$ponum = $_REQUEST['ponum'];
?>

<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/mtltrk.js"></script>
<html>
<head>
<title>Activity Log Details</title>
</head>

<body leftmargin="0"topmargin="0" marginwidth="0">
<form  action="" method='post' enctype='multipart/form-data'>

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
                <td><span class="pageheading"><b>Activity Log Details</b></td>
</tr>

</tr>
<table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3>
<?php /*<tr bgcolor="#FFFFFF"><td colspan=5><a href="javascript:addRow('myTable',document.forms[0].index1.value)"><img name="Image7" border="0" src="images/bu-addrow.gif"></a></td></tr> */ ?>

<tr bgcolor="#FFFFFF">
<table id="myTable" width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Date</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>User ID</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Type</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Description</center></b></td>

</tr>

<?php

$result = $newmtl->getact_logs($ponum);
      $i=1;
      while ($myrow = mysql_fetch_row($result))
     {
	printf('<tr bgcolor="#FFFFFF">');
 	echo "<td align=\"center\"><span class=\"tabletext\">$myrow[1]</td>";
	echo "<td align=\"center\"><span class=\"tabletext\">$myrow[2]</td>";
    echo " <td><span class=\"tabletext\">$myrow[3]</td>";

	echo "<td align=\"center\"><span class=\"tabletext\">$myrow[4]</td>";
	//echo "<td align=\"center\"><span class=\"tabletext\">$myrow[3]</td>";

	printf('</tr>');
	$i++;

    }

echo "<input type=\"hidden\" name=\"index1\" value=$i>";

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

					</FORM>
		</body>
</html>
