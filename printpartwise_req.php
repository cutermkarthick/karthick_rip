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

$_SESSION['pagename'] = 'partwise_req';
//////session_register('pagename');

// First include the class definition
include('classes/loginClass.php');
include('classes/partwise_reqclass.php');
include('classes/displayClass.php');

$newlogin = new userlogin;
$newlogin->dbconnect();
$userid = $_SESSION['user'];


$newpr = new partwise_req;
$partwise_reqrecnum = $_REQUEST['partwise_reqrecnum'];
$result = $newpr->getpartwise_req($partwise_reqrecnum);
$myrow = mysql_fetch_row($result);

?>
<link rel="stylesheet" href="style.css">

<html>
<head>
<title></title>
</head>

<table width=630 border=0>
<tr><td><font style="Arial" size=5><center><b><A HREF="javascript:window.print()">Partwise Requirement</A></b></center></td</tr>
</table>

<table border=0 bgcolor="#FFFFFF" width=100% cellspacing=1 cellpadding=3>
   <tr><td>&nbsp; </td> </tr>
</table>

<table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3>

<tr bgcolor="#DDDEDD"><td colspan=4><span class="heading"><center><b>General Information</b></center></td></tr>

 <table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >

        <tr bgcolor="#FFFFFF">
           <!-- <td><span class="labeltext"><p align="left">Sl #</p></font></td>
            <td><span class="tabletext"><input type="text" name="slnum" size=20 value=""></td> -->
            <td width=25%><span class="labeltext"><p align="left">Part #</p></font></td>
            <td colspan=3><span class="tabletext"><?php echo $myrow[1] ?></td>
        </tr>

        <tr bgcolor="#FFFFFF">
            <td width=25%><span class="labeltext"><p align="left">Customer</p></font></td>
            <td width=25%><span class="tabletext"><?php echo $myrow[2] ?></td>
            <td width=25%><span class="labeltext"><p align="left">Description</p></font></td>
            <td width=25%><span class="tabletext"><?php echo $myrow[3] ?></td>
        </tr>

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Target</p></font></td>
            <td><span class="tabletext"><?php echo $myrow[4] ?></td>
            <td><span class="labeltext"><p align="left">Achieved</p></font></td>
            <td><span class="tabletext"><?php echo $myrow[5] ?></td>
        </tr>

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Balance</p></font></td>
            <td><span class="tabletext"><?php echo $myrow[6] ?></td>
            <td><span class="labeltext"><p align="left">Due Date</p></font></td>
            <td><span class="tabletext"><?php echo $myrow[7] ?></td>
        </tr>

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Status</p></font></td>
            <td colspan=3><span class="tabletext"><?php echo $myrow[8] ?></td>
        </tr>

<input type="hidden" name="partwise_reqrecnum" value="<?php echo $partwise_reqrecnum ?>">
</table>
</body>
</html>
