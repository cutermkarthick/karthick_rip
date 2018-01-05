<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = June 20, 2005                =
// Filename: boardwoEntry.php                  =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OWT                          =
// Allows NewWO entry.                         =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];
$_SESSION['pagename'] = 'woEntry';
//////session_register('pagename');
// First include the class definition
include('classes/userClass.php');
include_once('classes/loginClass.php');
include('classes/workorderClass.php');
include('classes/empClass.php');
include('classes/companyClass.php');
include('classes/workflowClass.php');
include('classes/displayClass.php');
include('classes/pageClass.php');

$newlogin = new userlogin;
$newlogin->dbconnect();

$newPages = new page;
$newCustomer = new company;
$newdisp = new display;
$result = $newCustomer->getAllCustomers();
$newEmp = new emp;
$employees = $newEmp->getAllEmps();
//$newWF = new workflow;
//$wf = $newWF->getWF('Board','WO');
//$wfcnt=$newWF->getcountWF('Board','WO');
?>

<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/woentry.js"></script>
<script language="javascript" src="scripts/WorkOrder<?php echo $wotype . ".js"?>"></script>


<html>
<head>
<title>New Wo Entry</title>
</head>

<body leftmargin="0" topmargin="0" marginwidth="0" rightmargin="0">
<form action='WodetailsEntry.php' method='post' name="myform" enctype='multipart/form-data'>
<table width=100% cellspacing="0" cellpadding="0" border="0">
<?php
include('header.html');
?>
<table width=100% cellspacing="0" cellpadding="6" border="0">

<tr>
<td>
<table width=100% border=0 cellspacing="0" cellpadding="0">
<tr>
<td><span class="welcome"><b>Welcome <?php echo $userid?></b></td>
<td align="right">&nbsp;
    <a href="exit.php" onMouseOut="MM_swapImgRestore()"
    onMouseOver="MM_swapImage('Image16','','images/logout_mo.gif',1)"><img name="Image16" border="0"
     src="images/logout.gif"></a>
</td>
</tr>
</table>
<table width=100% border=0 cellpadding=0 cellspacing=0  >
<tr><td>
</td></tr>
<tr>
<td>
<?php $newdisp->dispLinks(''); ?>
</td></tr>
</table>
<table width=100% border=0 cellpadding=0 cellspacing=0  >
<tr bgcolor="DEDFDE">
<td width="6"><img src="images/spacer.gif " width="6"></td>
<td bgcolor="#FFFFFF">

<table width=100% border=0 cellspacing="1" cellpadding="6">
<tr>
    <tr> <tr><td><span class="pageheading"><b>New Board Work Order</b></td></tr>
</tr>
<tr> <tr>
</tr>
<table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3>
      <tr bgcolor="#DDDEDD">
            <td colspan=4><span class="heading"><center><b>General Information</b></center></td>
        </tr>
       <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Customer</p></font></td>
            <td  colspan=1><input type="text" name="company"
                    style=";background-color:#DDDDDD;"
                    readonly="readonly" size=25 value="">
                    <img src="images/bu-getcustomer.gif" alt="Get Customer"
                 onclick="GetAllCustomers()">
        </td>
            	<input type="hidden" name="companyrecnum"></td>

        <td><span class="tabletext"><p align="left"><b>Book Date</b></p></font></td>
        <td><input type="text" name="book_date"
                    style="background-color:#DDDDDD;"
                    readonly="readonly" size=12 value="">
                  <img src="images/bu-getdate.gif" alt="Get BookDate" onclick="GetDate('book_date')">
        </td>

    </tr>
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Description</p></font></td>
            <td colspan=3><input type="text" name="descr" size=64 value=""></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>WO #</p></font></td>
            <td><span class="tabletext"><input type="text" name="wonum" size=25 value=""></td>
              <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>PO #</p></font></td>
              <td><span class="tabletext"><input type="text" name="ponum" size=25 value=""></td>


        </tr>

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Quote #</p></font></td>
            <td><input type="text" name="quotenum" style="background-color:#DDDDDD;" readonly="readonly" size=25 value="">
	        <img src="images/bu-getquote.gif" alt="Get Quote No" onclick="GetQuoteNo()">

            <td><span class="labeltext"><p align="left">GRN#&nbsp;</p></font></td>
            <td><input type="text" name="grnnum" size=12 value="">

            </td>

            <input type="hidden" name="quoterecnum">
            <!--<input type="hidden" name="bomrecnum">-->
        </tr>

        <tr  bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Designer</p></font></td>
            <td><input type="text" name="owner" style=";background-color:#DDDDDD;" readonly="readonly" size=25 value="">
                       <img src="images/bu-getemployee.gif" alt="Get Employee" onclick="GetAllEmps()"></td>
            <td></td>
            <td></td>
        </tr>
 	<input type="hidden" name="reorder" value="No">
	<input type="hidden" name="emprecnum">

        <tr bgcolor="#DDDEDD">
            <td colspan=4><span class="heading"><center><b><span class='asterisk'>*</span>Contact Information</b></center></td>
        </tr>
    <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Contact</p></font></td>
            <td colspan=3><input type="text" name="contact" style="background-color:#DDDDDD;" readonly="readonly" size=25 value="">
                       <img src="images/bu-getcontact.gif" alt="Get Contact" onclick="GetContact()">
	<input type="hidden" name="contactrecnum">
        </td>
        </tr>

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Phone</p></font></td>
            <td><input type="text" name="phone" style="background-color:#DDDDDD;"
                              readonly="readonly" size=25 value=""></td>

            <td><span class="labeltext"><p align="left">Email</p></font></td>
            <td><input type="text" name="email" style="background-color:#DDDDDD;"
                         readonly="readonly" size=30 value=""></td>
        </tr>

        <tr bgcolor="#FFFFFF">
        <td bgcolor="#FFFFFF"><span class="labeltext"><b>Select WO Type</b></td>
        <td colspan=3><span class="tabletext"><select name="wotype" size="1" width="100" onchange="setwotype(); document.forms[0].submit();">
<?php
	//echo "i am here";
	$result = $newPages->getPages4parent("WorkOrder");
	while ($myrow = mysql_fetch_row($result))
    {
		echo"<option value>$myrow[1]";
	}
?>
</select>
</td>
<input type="hidden" name="wotypeval" value="">
</table>
</td>
<td width="6"><img src="images/spacer.gif " width="6"></td>
</tr>
<tr bgcolor="DEDFDE">
<td width="6"><img src="images/box-left-bottom.gif"></td>
<td><img src="images/spacer.gif " height="6"></td>
<td width="6"><img src="images/box-right-bottom.gif"></td>
</tr>
</table>
<span class="labeltext">
                <INPUT TYPE="RESET"
                     style="color=#0066CC;background-color:#DDDDDD;width=130;"
                     VALUE="Reset" onclick="javascript: putfocus()">

</FORM>
</body>
</html>
<?php

   function gonext()
   {
     header ( "Location:WodetailsEntry.php");
   }
?>


