<?php

//==============================================
// Author: FSI                                 =
// Date-written = April 10, 2010               =
// Filename: addCustNotes.php                  =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =           
//==============================================

@session_start();
header("Cache-control: private");
if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );
}
$userid = $_SESSION['user'];
$_SESSION['pagename'] = 'addCustNotes';
//session_register('pagename');

// First include the class definition
include_once('classes/loginClass.php');
include('classes/taskClass.php');
$page="Project";

//$newLogin= userlogin::singleton();

$newtask = new task;

$recnum_task=$_REQUEST['recnum'];
$recnum_project=$_REQUEST['link2project'];

?>
<script language="javascript" src="scripts/task.js"></script>
<link rel="stylesheet" href="style.css">
<html>
<head>
<title>Add Customer  Notes</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0" onload="javascript:createTab('project')">
<form action='task_Process.php' method='GET' enctype='multipart/form-data'>
<?php
 include('header.html');
?>
<!-- <table width=100% cellspacing="0" cellpadding="6" border="0">
	<tr>
		<td>
			<table width=100% border=0 cellspacing="0" cellpadding="0">
   				<tr>
        		<td colspan=2><span class="welcome"><b>Welcome <?php echo $userid?></b></td>
        		<td align="right">&nbsp;
       			<a href="exit.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image16','','images/logout_mo.gif',1)"><img name="Image16" border="0" src="images/logout.gif"></a></td>
        		</tr>
			</table>
			<table width=100% border=0 cellpadding=0 cellspacing=0>
				<tr><td></td></tr>
				<tr>
					<td>

</td></tr>
<table width=100% border=0 cellpadding=0 cellspacing=0>
  <tr bgcolor="FFFFFF"><td width="6"></td>
	    <td bgcolor="#FFFFFF">
 

<table width=100% border=0 cellpadding=0 cellspacing=0 bgcolor="#FFFFFF">
<tr><td>
 --><table width=100% align='center' border=1 cellpadding=4 cellspacing=1 class="stdtable1">
<tr>
<td ><span class="pageheading"><b>Add Customer Notes</b></td>  
  </tr>
</table>


<table width=100% align='center' border=1 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1" >
<tr bgcolor='#FFFFFF'>
<td><span class="labeltext"><p align="left">Customer Notes</p></font></td>

<td><textarea name="customer_notes" rows="3" cols="74" value=""></textarea></td>
</tr>

<input type='hidden' name='recnum_task' value=<?echo $recnum_task?>>
<input type='hidden' name='recnum_project' value=<?echo $recnum_project?>>

<tr bgcolor='#FFFFFF'><td align='center' colspan=4>
<span class="tabletext"><input type="submit"
                     style="color=#0066CC;background-color:#DDDDDD;width=130;"
                     value="Add CustNotes" name="submit" onclick="javascript: return check_req_fields()">
                <INPUT TYPE="RESET"
                     style="color=#0066CC;background-color:#DDDDDD;width=130;"
                     VALUE="Reset" onclick="javascript: putfocus()">
					 </td></tr>
					 </table>
</FORM>
</body>
</html>