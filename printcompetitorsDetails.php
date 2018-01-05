<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = November 8, 2006             =
// Filename: printcompetitorsDetails.php       =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OWT                          =
// Print competitorsDetails                    =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];

$_SESSION['pagename'] = 'competitorsDetails';
//session_register('pagename');

// First include the class definition
include('classes/userClass.php');
include('classes/competitorsClass.php');
include('classes/displayClass.php');
include('classes/pageClass.php');

$newlogin = new userlogin;
$newlogin->dbconnect();

$newpage = new page;
$newdisplay = new display;
$newcompetitor = new competitor;

if (isset($_REQUEST['competitorrecnum']))
{
	$competitorrecnum=$_REQUEST['competitorrecnum'];
}

$result = $newcompetitor->getcompetitor($competitorrecnum);
$myrow = mysql_fetch_row($result);
$revenue=$myrow[2];
?>
<link rel="stylesheet" href="style.css">

<html>
<head>
<title></title>
</head>

<table width=630 border=0>
<tr><td><font style="Arial" size=5><center><b><A HREF="javascript:window.print()">Track Competitors Details</A></b></center></td</tr>
</table>

<table border=0 bgcolor="#FFFFFF" width=100% cellspacing=1 cellpadding=3>
   <tr><td>&nbsp; </td> </tr>
</table>

    <table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3>
<tr bgcolor="#DDDEDD"><td colspan=4><span class="heading"><center><b>General Information</b></center></td></tr>
       <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Company Name</p></font></td>
            <td ><span class="tabletext"><?php echo $myrow[1]?></td>
            <td><span class="labeltext"><p align="left">Revenue </p></font></td>
            <td><span class="tabletext">$<?php printf('%.2f',$revenue); ?></td>
        </tr>

    <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Industry Segment</p></font></td>
            <td ><span class="tabletext"><?php echo $myrow[3]?></td>
             <td><span class="labeltext"><p align="left">Product</p></font></td>
            <td ><span class="tabletext"><?php echo $myrow[4]?></td>
        </tr>

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Phone</p></font></td>
            <td ><span class="tabletext"><?php echo $myrow[5]?></td>
             <td><span class="labeltext"><p align="left">Email </p></font></td>
            <td ><span class="tabletext"><?php echo $myrow[6]?></td>
        </tr>
     <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">GUID</p></font></td>
            <td colspan=3><span class="tabletext"><?php echo $myrow[8]?></td>
     </tr>
     <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Notes</p></font></td>
            <td colspan=3><span class="tabletext"><?php echo $myrow[7]?></td>
     </tr>
  <tr bgcolor="#EEEEEE"><td colspan=4><span class="heading"><center><b>Address</b></center></td></tr>
     <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Address1</p></font></td>
            <td><span class="tabletext"><?php echo $myrow[9]?></td>
            <td><span class="labeltext"><p align="left">Address2</p></font></td>
            <td><span class="tabletext"><?php echo $myrow[10]?></td>
     </tr>
     <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">City</p></font></td>
            <td><span class="tabletext"><?php echo $myrow[11]?></td>
            <td><span class="labeltext"><p align="left">State</p></font></td>
            <td><span class="tabletext"><?php echo $myrow[12]?></td>
    </tr>
    <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Zip</p></font></td>
            <td><span class="tabletext"><?php echo $myrow[13]?></td>
            <td><span class="labeltext"><p align="left">Country</p></font></td>
            <td><span class="tabletext"><?php echo $myrow[14]?></td>
    </tr>
</table>
</body>
</html>
