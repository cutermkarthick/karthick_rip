<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = Mar 22, 2007                 =
// Filename: printfeedbackDetails.php          =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OWT                          =
// Print Feedback Details                    =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];

$_SESSION['pagename'] = 'feedbackdetails';
//////session_register('pagename');

// First include the class definition
include('classes/userClass.php');
include('classes/feedbackClass.php');
include('classes/displayClass.php');

$newlogin = new userlogin;
$newlogin->dbconnect();

$newdisplay = new display;
$newfeedback = new feedback;

if (isset($_REQUEST['feedbackrecnum']))
{
	$feedbackrecnum=$_REQUEST['feedbackrecnum'];
  }
  else if (isset($_SESSION['feedbackrecnum']))
  {

}

$result = $newfeedback->getFeedback($feedbackrecnum);
$myrow = mysql_fetch_assoc($result);
?>
<link rel="stylesheet" href="style.css">

<html>
<head>
<title></title>
</head>

<table width=630 border=0>
<tr><td><font style="Arial" size=5><center><b><A HREF="javascript:window.print()">Feedback Details</A></b></center></td</tr>
</table>

<table border=0 bgcolor="#FFFFFF" width=100% cellspacing=1 cellpadding=3>
   <tr><td>&nbsp; </td> </tr>
</table>

    <table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3>
<tr bgcolor="#DDDEDD"><td colspan=4><span class="heading"><center><b>General Information</b></center></td></tr>

    <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">PRN</p></font></td>
            <td ><span class="tabletext"><?php echo $myrow["crn"]?></td>
            <td><span class="labeltext"><p align="left">Reference No. </p></font></td>
            <td><span class="tabletext"><?php echo $myrow["refno"]?></td>
        </tr>
    <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Part Number</p></font></td>
            <td ><span class="tabletext"><?php echo $myrow["partnumber"]?></td>
             <td><span class="labeltext"><p align="left">Requested By</p></font></td>
            <td ><span class="tabletext"><?php echo $myrow["requestedby"]?></td>
        </tr>

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Part Name</p></font></td>
            <td ><span class="tabletext"><?php echo $myrow["partname"]?></td>
             <td><span class="labeltext"><p align="left">Date </p></font></td>
            <td ><span class="tabletext"><?php echo $myrow["docdate"]?></td>
        </tr>
  <tr bgcolor="#EEEEEE"><td colspan=4><span class="heading"><center><b>Change Required in</b></center></td></tr>
     <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Process</p></font></td>
            <td><span class="tabletext"><?php echo $myrow["process"]?></td>
            <td><span class="labeltext"><p align="left">Program</p></font></td>
            <td><span class="tabletext"><?php echo $myrow["program"]?></td>
     </tr>
     <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Fixture</p></font></td>
            <td><span class="tabletext"><?php echo $myrow["fixture"]?></td>
            <td><span class="labeltext"><p align="left">Tools</p></font></td>
            <td><span class="tabletext"><?php echo $myrow["tools"]?></td>
    </tr>
       <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Description</p></font></td>
            <td colspan=3><span class="tabletext"><?php echo $myrow["description"]?></td>
     </tr>
</table>
</body>
</html>
