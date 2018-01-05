<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = November 6, 2006             =
// Filename: printopportunityDetails.php       =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OWT                          =
// Print Opportunity Details                   =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];
$_SESSION['pagename'] = 'opportunityDetails';
//session_register('pagename');

include('classes/userClass.php');
include('classes/opportunityClass.php');
include('classes/displayClass.php');
include('classes/leadsClass.php');

$newlogin = new userlogin;
$newlogin->dbconnect();

$newopportunity = new opportunity;
$newdisplay = new display;

$opportunityrecnum = $_REQUEST['opportunityrecnum'];
$userid = $_SESSION['user'];

$result = $newopportunity->getOpp($opportunityrecnum);
$myrow = mysql_fetch_row($result);
?>
<link rel="stylesheet" href="style.css">

<html>
<head>
<title></title>
</head>

<table width=630 border=0>
<tr><td><font style="Arial" size=5><center><b><A HREF="javascript:window.print()">Opportunity Details</A></b></center></td</tr>
</table>

<table border=0 bgcolor="#FFFFFF" width=100% cellspacing=1 cellpadding=3>
   <tr><td>&nbsp; </td> </tr>
</table>

<table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3>
<tr bgcolor="#DDDEDD"><td colspan=4><span class="heading"><center><b>General Information</b></center></td></tr>
       <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Opportunity Name</p></font></td>
            <td ><span class="tabletext"><?php echo $myrow[1]?></td>
             <td><span class="labeltext"><p align="left">Account Name </p></font></td>
            <td ><span class="tabletext"><?php echo $myrow[2]?></td>
        </tr>

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Expected Close Date</p></font></td>
            <td ><span class="tabletext">
             <?php
            $d=substr($myrow[3],8,2);
            $m=substr($myrow[3],5,2);
            $y=substr($myrow[3],0,4);
            $x=mktime(0,0,0,$m,$d,$y);
            $date=date("M j, Y",$x);
            echo "$date";
            ?>
            </td>

             <td><span class="labeltext"><p align="left">Create Date</p></font></td>
            <td ><span class="tabletext">

            <?php
            $d=substr($myrow[13],8,2);
            $m=substr($myrow[13],5,2);
            $y=substr($myrow[13],0,4);
            $x=mktime(0,0,0,$m,$d,$y);
            $date=date("M j, Y",$x);
            echo "$date";
            ?>

            </td>
        </tr>

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Sales Stage</p></font></td>
            <td ><span class="tabletext"><?php echo $myrow[4]?></td>
             <td><span class="labeltext"><p align="left">Type </p></font></td>
            <td ><span class="tabletext"><?php echo $myrow[5]?></td>
        </tr>

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Lead Source</p></font></td>
            <td ><span class="tabletext"><?php echo $myrow[12]?></td>
             <td><span class="labeltext"><p align="left">Amount & Currency </p></font></td>
            <td ><span class="tabletext"><?php echo $myrow[14] .' '. $myrow[7]?></td>
        </tr>

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Assigned to</p></font></td>
            <td ><span class="tabletext"><?php echo $myrow[8]?></td>
             <td><span class="labeltext"><p align="left">Probability Percentage </p></font></td>
            <td ><span class="tabletext"><?php echo $myrow[9]?></td>
        </tr>

   	   <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Next Step</p></font></td>
            <td colspan=3><span class="tabletext"><?php echo $myrow[10]?></td>
        </tr>

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Sales Notes</p></font></td>
            <td colspan=3><span class="tabletext"><?php echo $myrow[11]?></td>
        </tr>
</table>
</body>
</html>
