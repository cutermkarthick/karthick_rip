<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = Mar 21, 2007                 =
// Filename: printqualityplanDetails.php       =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OWT                          =
// print Quality Plan Details                  =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];

$_SESSION['pagename'] = 'ds_details';
//////session_register('pagename');

// First include the class definition

include('classes/prod_planclass.php');
include('classes/displayClass.php');

$newlogin = new userlogin;
$newlogin->dbconnect();
$userid = $_SESSION['user'];

$newdisplay = new display;

$newPP = new prod_plan;
$prod_planrecnum = $_REQUEST['prod_planrecnum'];
$result = $newPP->getprod_plan($prod_planrecnum);
$myrow = mysql_fetch_row($result);

?>
<link rel="stylesheet" href="style.css">

<html>
<head>
<title></title>
</head>

<table width=630 border=0>
<tr><td><font style="Arial" size=5><center><b><A HREF="javascript:window.print()">Production Plan</A></b></center></td</tr>
</table>

<table border=0 bgcolor="#FFFFFF" width=100% cellspacing=1 cellpadding=3>
   <tr><td>&nbsp; </td> </tr>
</table>

<table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3>

<tr bgcolor="#DDDEDD"><td colspan=4><span class="heading"><center><b>General Information</b></center></td></tr>

 <table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >

        <tr bgcolor="#FFFFFF">
           <!-- <td><span class="labeltext"><p align="left">Sl #</p></font></td>
            <td><span class="tabletext"><input type="text" name="slnum" size=20 value=""></td>-->
            <td><span class="labeltext"><p align="left">Part #</p></font></td>
            <td colspan=3><span class="tabletext"><?php echo $myrow[1] ?></td>
        </tr>

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Customer</p></font></td>
            <td><span class="tabletext"><?php echo $myrow[2] ?></td>
            <td><span class="labeltext"><p align="left">Description</p></font></td>
            <td><span class="tabletext"><?php echo $myrow[3] ?></td>
        </tr>

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Target</p></font></td>
            <td><span class="tabletext"><?php echo $myrow[4] ?></td>
            <td><span class="labeltext"><p align="left">Start Date</p></font></td>
            <td><span class="tabletext"><?php echo $myrow[5] ?></td>
        </tr>

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">End Date</p></font></td>
            <td><span class="tabletext"><?php echo $myrow[6] ?>
            </td>
            <td><span class="labeltext"><p align="left">Status</p></font></td>
            <td><span class="tabletext"><?php echo $myrow[7] ?></td>
        </tr>

</table>

</body>
</html>
