<?php

//==============================================
// Author: FSI                                 =
// Date-written = April 06, 2010               =
// Filename: project_Entry.php                 =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OMS                          =            
//==============================================

@session_start();
header("Cache-control: private");
if ( !isset ( $_SESSION['user'] ) )
{
header ( "Location: login.php" );
}
$userid = $_SESSION['user'];
$_SESSION['pagename'] = 'project';
$page="CRM: Project";
//session_register('pagename');

// First include the class definition
include_once('classes/loginClass.php');
include('classes/projectClass.php');
include('classes/companyClass.php');
// $newLogin= userlogin::singleton();

$newCustomer = new company;
$result = $newCustomer->getAllCustomers();

?>
<script language="javascript" src="scripts/project.js"></script>
<link rel="stylesheet" href="style.css">
<html>
<head>
<title>Project Entry</title>
</head>
<body leftmargin="0" topmargin="0" marginwidth="0">
<form action='project_Process.php' method='post' enctype='multipart/form-data'>

<?php
include('header.html');
?>

 <table width=100% border=0 cellspacing=4 >
<tr><td>
<table width=100% border=0>
<td width="100%"><span class="pageheading"><b>Project Entry</b></td>

</table>

<tr>
<td>



<table width=100% align='center' border=1 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1" >
<tr bgcolor='#FFFFFF'>
<td ><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Project</p></font></td>
<td><input type="text" name="project" id="project"  size=15 value=""></td>

<td ><span class="labeltext"><p align="left">Desc</p></font></td>
<td colspan=9><span class="tabletext"><textarea name="desc" id="desc" cols =40 rows="2"></textarea></td>
</tr>

<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Start Date</p></font></td>
<td><input type="text" name="start_date" id="start_date" size=15 value=""><img src="images/bu-getdateicon.gif" alt="Get Date"  onclick="GetDate('start_date')"></td>
<td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Closed Date</p></font></td>
<td><input type="text" name="closed_date" id="closed_date" size=15 value=""><img src="images/bu-getdateicon.gif" alt="Get Date"  onclick="GetDate('closed_date')"></td>
</tr>

<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">Requirement</p></font></td>
<td><input type="text" name="req" id="req"  size=30 value=""></td>
<!-- <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Customer</p></font>
<img src="images/bu-get.gif" alt="Get Customer" onclick="GetAllCustomers()"></td>
 -->
<td></td>
<td></td>

</tr>

<input type="hidden" name="company" id="company"  size=15 value="" readonly="readonly">
<input type="hidden" id="siteid" name="siteid" value ="" >
<input type="hidden" id="companyrecnum" name="companyrecnum" value ="" >

<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">Category</p></font></td>
<td><input type="text" name="category" id="category"  size=15 value=""></td>
<td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Technology</p></font></td>
<td><input type="text" name="technology" id="technology"  size=15 value=""></td>
</tr>

<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">Platform</p></font></td>
<td><input type="text" name="platform" id="platform"  size=15 value=""></td>
<td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Owner</p></font></td>
<td><input type="text" name="manager" id="manager"  size=15 value=""></td>
</tr>

<tr bgcolor='#FFFFFF'><td align='center' colspan=4>
<span class="tabletext"><input type="submit" style="color=#0066CC;background-color:#DDDDDD;width=130;" value="Submit" name="submit" onclick="javascript: return check_req_fields()">
<INPUT TYPE="RESET" style="color=#0066CC;background-color:#DDDDDD;width=130;"
	VALUE="Reset" onclick="javascript: putfocus()">
</td></tr>
</table>
</FORM>
</body>
</html>