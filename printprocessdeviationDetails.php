<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = Mar 22, 2007                 =
// Filename: printprocessdeviationDetails.php  =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OWT                          =
// print Process deviation Details             =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];

$_SESSION['pagename'] = 'procdeviationdetails';
//////session_register('pagename');

// First include the class definition
include('classes/loginClass.php');
include('classes/processdeviationClass.php');
include('classes/processdeviationliClass.php');
include('classes/displayClass.php');

$newlogin = new userlogin;
$newlogin->dbconnect();
$userid = $_SESSION['user'];

$newprocdev = new procdeviation;
$newLI = new procdeviationli;
$newdisplay = new display;

$procdevrecnum = $_REQUEST['procdevrecnum'];

$myQI = $newLI->getProcdeviationli($procdevrecnum);
$result = $newprocdev->getProcdeviation($procdevrecnum);
$myrow = mysql_fetch_assoc($result);

?>
<link rel="stylesheet" href="style.css">

<html>
<head>
<title></title>
</head>

<table width=630 border=0>
<tr><td><font style="Arial" size=5><center><b><A HREF="javascript:window.print()">Process Deviation Slip</A></b></center></td</tr>
</table>

<table border=0 bgcolor="#FFFFFF" width=100% cellspacing=1 cellpadding=3>
   <tr><td>&nbsp; </td> </tr>
</table>

<table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3>

<tr bgcolor="#DDDEDD"><td colspan=4><span class="heading"><center><b>General Information</b></center></td></tr>

 <table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
 <tr bgcolor="#FFFFFF"></tr>

        <tr bgcolor="#FFFFFF">
            <td width=20%><span class="labeltext"><p align="left">Part Number</p></font></td>
            <td width=20%><span class="tabletext"><?php echo $myrow["partnumber"] ?></td>
            <td width=20%><span class="labeltext"><p align="left">Drg. Issue</p></font></td>
            <td width=20%><span class="tabletext"><?php echo $myrow["drgissue"] ?></td>
        </tr>

        <tr bgcolor="#FFFFFF">
            <td width=20%><span class="labeltext"><p align="left">Customer</p></font></td>
            <td width=20%><span class="tabletext"><?php echo $myrow["name"] ?></td>
            <td width=20%><span class="labeltext"><p align="left">Part Name</p></font></td>
            <td width=20%><span class="tabletext"><?php echo $myrow["partname"] ?></td>
        </tr>

        <tr bgcolor="#FFFFFF">
            <td width=20%><span class="labeltext"><p align="left">Material Type</p></font></td>
            <td width=20%><span class="tabletext"><?php echo $myrow["matltype"] ?></td>
            <td width=20%><span class="labeltext"><p align="left">Project</p></font></td>
            <td width=20%><span class="tabletext"><?php echo $myrow["project"] ?></td>
        </tr>
         <tr bgcolor="#FFFFFF">
            <td width=20%><span class="labeltext"><p align="left">Matl.Spec</p></font></td>
            <td width=20%><span class="tabletext"><?php echo $myrow["matlspec"] ?></td>
            <td width=20%><span class="labeltext"><p align="left">Ref. No</p></font></td>
            <td width=20%><span class="tabletext"><?php echo $myrow["refno"] ?></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td width=20%><span class="labeltext"><p align="left">Attachments</p></font></td>
            <td width=20% colspan=3><span class="tabletext"><?php echo $myrow["attachments"] ?></td>
        </tr>
</table>

<table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3>
<tr bgcolor="#DDDEDD">
</tr>
<tr bgcolor="#FFFFFF">
<table id="myTable" width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Sl.No.</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Description</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Signature</center></b></td>
</tr>
<?php
 $i = 1;
      while ($QI = mysql_fetch_assoc($myQI))
      {
	printf('<tr bgcolor="#FFFFFF">');
	$sl_num = $QI["sl_num"];
	$description = $QI["description"];
	$signature = $QI["signature"];

	echo "<td align=\"center\"><span class=\"tabletext\">$sl_num</td>";
	echo "<td align=\"center\"><span class=\"tabletext\">$description</td>";
	echo "<td align=\"center\"><span class=\"tabletext\">$signature</td>";
	printf('</tr>');
	printf('</tr>');
	$i++;
	?>
 <?php
    }

?>
</table>
</body>
</html>
