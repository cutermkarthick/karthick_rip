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
$page="ELM: Leave";
//session_register('pagename');

// First include the class definition
include_once('classes/loginClass.php');
include('classes/leaveClass.php');
// $newLogin= userlogin::singleton();

$newLeave = new leave;
if(isset($_POST)&& isset($_POST['reason']))
{
	
	$newLeave->newLeave($_SESSION['userrecnum'],$_POST['from'],$_POST['to'],$_POST['reason'],'Active',$_SESSION['siteid']);
	header('Location:leave_page.php');
}

?>
<script language="javascript" src="scripts/project.js"></script>
<link rel="stylesheet" href="style.css">
<html>
<head>
<title>Project Entry</title>
</head>
<body leftmargin="0" topmargin="0" marginwidth="0">
<form  method='post' name="frm" enctype='multipart/form-data'>

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


<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>From Date</p></font></td>
<td><input type="text" name="from" id="start_date" size=15 value=""><img src="images/bu-getdateicon.gif" alt="Get Date"  onclick="GetDate('start_date')"></td>
<td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>To Date</p></font></td>
<td><input type="text" name="to" id="closed_date" size=15 value=""><img src="images/bu-getdateicon.gif" alt="Get Date"  onclick="GetDate('closed_date')"></td>
</tr>

<tr bgcolor='#FFFFFF'>

<td ><span class="labeltext"><p align="left">Reason</p></font></td>
<td colspan=9><span class="tabletext"><textarea name="reason" id="desc" cols =40 rows="2"></textarea></td>
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