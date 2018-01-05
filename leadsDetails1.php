<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = June 20, 2006                =
// Filename: leadsDetails.php                  =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OWT                          =
// Leads Details                               =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];

$_SESSION['pagename'] = 'leadsDetails';
//////session_register('pagename');

// First include the class definition
include('classes/userClass.php');
include('classes/companyClass.php');
include('classes/quoteClass.php');
include('classes/quoteliClass.php');
include('classes/displayClass.php');
include('classes/pageClass.php');
include('classes/leadsClass.php');

$newlogin = new userlogin;
$newlogin->dbconnect();

$newpage = new page;
$newLead = new leads;
$newdisplay = new display;
$newCustomer = new company;

if (isset($_REQUEST['leadsrecnum']))
{
	$leadsrecnum=$_REQUEST['leadsrecnum'];
}

$userid = $_SESSION['user'];
$result = $newLead->getLead($leadsrecnum);
$myrow = mysql_fetch_row($result);
?>

<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/quote.js"></script>

<html>
<head>
<title>Lead Details</title>
</head>

<body leftmargin="0"topmargin="0" marginwidth="0">

<table width=100% cellspacing="0" cellpadding="0" border="0">
<tr><td>

<table width=100% border=0 cellpadding=0 cellspacing=0  >
<tr><td>
</td></tr>
<tr>
<td>


</td></tr>
</table>
 <table width=100% border=0>
  <tr>
<td><span class="pageheading"><b>Leads Details</b></td>
	<td colspan=200>&nbsp;</td>
<td><a href ="javascript:retrieveURL('edit_leads1.php?leadsrecnum=<?php echo $leadsrecnum ?>');" ><img name="Image8" border="0" src="images/el.gif" ></a>

</td>

  </tr>
 <table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=0>
<tr bgcolor="#DDDEDD"><td colspan=4><span class="heading"><center><b>Lead Details</b></center></td></tr>

    <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Lead Name</p></font></td>
            <td ><span class="tabletext"><?php echo $myrow[2]?></td>
             <td><span class="labeltext"><p align="left">Company Name </p></font></td>
            <td ><span class="tabletext"><?php echo $myrow[6]?></td>

        </tr>
    <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Lead Source</p></font></td>
            <td ><span class="tabletext"><?php echo $myrow[1]?></td>
             <td><span class="labeltext"><p align="left">Title </p></font></td>
            <td ><span class="tabletext"><?php echo $myrow[3]?></td>
        </tr>

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Email</p></font></td>
            <td ><span class="tabletext"><?php echo $myrow[5]?></td>
             <td><span class="labeltext"><p align="left">Phone </p></font></td>
            <td ><span class="tabletext"><?php echo $myrow[4]?></td>
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
        <input type="hidden" name="primary_lead">
</table>

    <table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3>

        <tr>
       </tr>
        </table>
</td>


		</table>

      </FORM>

</table>

</body>
</html>