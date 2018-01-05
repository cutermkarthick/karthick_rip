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

$_SESSION['pagename'] = 'enquiryDetails';
//session_register('pagename');

// First include the class definition

include('classes/enquiryClass.php');
include('classes/displayClass.php');

$newlogin = new userlogin;
$newlogin->dbconnect();
$userid = $_SESSION['user'];

$newenquiry = new enquiry;
$newdisplay = new display;

$enquiryrecnum = $_REQUEST['enquiryrecnum'];

$result = $newenquiry->getenquiry($enquiryrecnum);
$myrow = mysql_fetch_assoc($result);

?>
<link rel="stylesheet" href="style.css">

<html>
<head>
<title></title>
</head>

<table width=100% border=0>
<tr><td><font style="Arial" size=5><center><b><A HREF="javascript:window.print()">Enquiry</A></b></center></td</tr>
<tr><td>&nbsp</td></tr>
</table>


<table width=100% border=1 bgcolor="#DFDEDF"  cellspacing=1 cellpadding=3 rules=all>

<?php

if ($myrow['enq_date'] != '0000-00-00' && $myrow['enq_date'] != '') 
{
            $d=substr($myrow['enq_date'],8,2);
            $m=substr($myrow['enq_date'],5,2);
            $y=substr($myrow['enq_date'],0,4);
            $x=mktime(0,0,0,$m,$d,$y);
            $enq_date=date("M j, Y",$x);
}
else {
          $enq_date = '';
}
if ($myrow['rtquot_date'] != '0000-00-00' && $myrow['rtquot_date'] != '') 
{
            $d=substr($myrow['rtquot_date'],8,2);
            $m=substr($myrow['rtquot_date'],5,2);
            $y=substr($myrow['rtquot_date'],0,4);
            $x=mktime(0,0,0,$m,$d,$y);
            $rtquot_date=date("M j, Y",$x);
}
else {
          $rtquot_date = '';
}


?>
           <tr bgcolor="#DDDEDD">
            <td colspan=4><span class="heading"><center><b>Enquiry Details</b></center></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td width=25%><span class="labeltext">Customer</td>
            <td width=25%><span class="tabletext"><?php echo $myrow["name"] ?></td>
            <td width=25%><span class="labeltext"><p align="left">ID</p></font></td>
            <td width=25%><span class="tabletext"><?php echo $myrow['id'] ?></td>

        </tr>
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext">Part Description</td>
            <td><span class="tabletext"><?php echo $myrow["partdesc"] ?></td>
            <td><span class="labeltext">Partnum</font></td>
            <td><span class="tabletext"><?php echo $myrow["partnum"] ?></td>
        </tr>
        
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext">RT Quatation Date</font></td>
            <td><span class="tabletext"><?php echo $rtquot_date ?></td>
            <td><span class="labeltext">RT Quatation No.</font></td>
            <td><span class="tabletext"><?php echo $myrow['rtquot_no'] ?></td>
        </tr>

         <tr bgcolor="#FFFFFF">
            <td><span class="labeltext">Risk Invloved</td>
            <td><span class="tabletext"><?php echo $myrow["risk_involv"] ?></td>
            <td><span class="labeltext">Risk Details</font></td>
            <td><span class="tabletext"><?php echo $myrow["risk_details"] ?></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext">Status</td>
            <td><span class="tabletext"><?php echo $myrow["status"] ?></td>
            <td><span class="labeltext">Qty</font></td>
            <td><span class="tabletext"><?php echo $myrow["qty"] ?></td>
        </tr>
    
</table>

<table border=3 bgcolor="#DFDEDF" cellspacing=1 cellpadding=3 WIDTH=100%>
        <tr bgcolor="#FFFFFF">
            <td colspan=4><span class="labeltext">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <td colspan=2><span class="labeltext"><?php echo $myrow["formrev"] ?></td>
            <td colspan=2><span class="labeltext">FLUENTERP</td>
        </tr>
 
</table>
</body>
</html>
