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

$_SESSION['pagename'] = 'maintain_machine';
//////session_register('pagename');

// First include the class definition
include('classes/loginClass.php');
include('classes/maintain_machineClass.php');
include('classes/displayClass.php');

$newlogin = new userlogin;
$newlogin->dbconnect();
$userid = $_SESSION['user'];


$newMM = new maintain_machine;
$maintain_machinerecnum = $_REQUEST['maintain_machinerecnum'];
$result = $newMM->getmaintain_machine($maintain_machinerecnum);
$myrow = mysql_fetch_row($result);

?>
<link rel="stylesheet" href="style.css">

<html>
<head>
<title></title>
</head>

<table width=630 border=0>
<tr><td><font style="Arial" size=5><center><b><A HREF="javascript:window.print()">Maintain Machine Master Data</A></b></center></td</tr>
</table>

<table border=0 bgcolor="#FFFFFF" width=100% cellspacing=1 cellpadding=3>
   <tr><td>&nbsp; </td> </tr>
</table>

<table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3>

<tr bgcolor="#DDDEDD"><td colspan=4><span class="heading"><center><b>General Information</b></center></td></tr>

 <table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >

        <tr bgcolor="#FFFFFF">
            <td width=25%><span class="labeltext"><p align="left">Machine ID</p></font></td>
            <td width=25%><span class="tabletext"><?php echo $myrow[1] ?></td>
            <td width=25%><span class="labeltext"><p align="left">Purpose</p></font></td>
            <td width=25%><span class="tabletext"><?php echo $myrow[2] ?></td>
        </tr>

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Task</p></font></td>
            <td><span class="tabletext"><?php echo $myrow[3] ?></td>
            <td><span class="labeltext"><p align="left">Task Time</p></font></td>
            <td><span class="tabletext"><?php echo $myrow[4] ?></td>
        </tr>
        <tr bgcolor="#FFFFFF">
           <!-- <td><span class="labeltext"><p align="left">Currency</p></font></td>
            <td><select name="currency">
                          <option selected>$
                          <option>Rs
                          </select></td>    -->
            <td><span class="labeltext"><p align="left">Cost/hr</p></font></td>
            <td colspan=3><span class="tabletext"><?php echo $myrow[5]. ' ' ?><?php echo $myrow[6] ?></td>
        </tr>

</table>
</body>
</html>
