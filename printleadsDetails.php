<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = November 6, 2006             =
// Filename: printleadsDetails.php             =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OWT                          =
// Print Leads Details                         =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];

$_SESSION['pagename'] = 'leadsDetails';
//session_register('pagename');

// First include the class definition
include('classes/userClass.php');
include('classes/leadsClass.php');
include('classes/displayClass.php');
include('classes/pageClass.php');

$newlogin = new userlogin;
$newlogin->dbconnect();

$newpage = new page;
$newLead = new leads;
$newdisplay = new display;

$leadsrecnum = $_REQUEST['leadsrecnum'];
$userid = $_SESSION['user'];

$result = $newLead->getLead($leadsrecnum);
$myrow = mysql_fetch_row($result);
?>
<link rel="stylesheet" href="style.css">

<html>
<head>
<title></title>
</head>


<table width=630 border=0>
<tr><td><font style="Arial" size=5><center><b><A HREF="javascript:window.print()">Leads Details</A></b></center></td</tr>
</table>

<table border=0 bgcolor="#FFFFFF" width=100% cellspacing=1 cellpadding=3>
   <tr><td>&nbsp; </td> </tr>
</table>

    <table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3>
<tr bgcolor="#DDDEDD"><td colspan=4><span class="heading"><center><b>Leads Details</b></center></td></tr>
       <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Lead Name</p></font></td>
            <td><span class="tabletext"><?php echo $myrow[2]?></td>
            <td><span class="labeltext"><p align="left">Company Name</p></font></td>
            <td><span class="tabletext"><?php echo $myrow[6]?></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Lead Source</p></font></td>
            <td><span class="tabletext"><?php echo $myrow[1]?></td>
            <td><span class="labeltext"><p align="left">Title </p></font></td>
            <td><span class="tabletext"><?php echo $myrow[3]?></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Email</p></font></td>
            <td><span class="tabletext"><?php echo $myrow[5]?></td>
            <td><span class="labeltext"><p align="left">Phone</p></font></td>
            <td><span class="tabletext"><?php echo $myrow[4]?></td>
        </tr>
       <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Industry Segment</p></font></td>
            <td><span class="tabletext"><?php echo $myrow[7]?></td>
            <td><span class="labeltext"><p align="left">Product Interest</p></font></td>
            <td><span class="tabletext"><?php echo $myrow[8]?></td>
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Primary</p></font></td>
            <td colspan=3><span class="tabletext"><?php echo $myrow[9]?></td>
        </tr>
        <tr bgcolor="#DDDEDD">
            <td colspan=4><span class="heading"><center><b>Address Information</b></center></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Address1</p></font></td>
            <td><span class="tabletext"><?php echo $myrow[13]?></td>
            <td><span class="labeltext"><p align="left">Address2</p></font></td>
            <td><span class="tabletext"><?php echo $myrow[14]?></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">City</p></font></td>
            <td><span class="tabletext"><?php echo $myrow[15]?></td>
            <td><span class="labeltext"><p align="left">State</p></font></td>
            <td><span class="tabletext"><?php echo $myrow[16]?></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Zip</p></font></td>
            <td><span class="tabletext"><?php echo $myrow[17]?></td>
            <td><span class="labeltext"><p align="left">Country</p></font></td>
            <td><span class="tabletext"><?php echo $myrow[18]?></td>
        </tr>
</table>
</body>
</html>
