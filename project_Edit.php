<?php

//==============================================
// Author: FSI                                 =
// Date-written = April 06, 2010               =
// Filename: task.php                          =
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
$_SESSION['pagename'] = 'task_edit';
$page="CRM: Project";
//session_register('pagename');

// First include the class definition
include_once('classes/loginClass.php');
include('classes/projectClass.php');

//$newLogin= userlogin::singleton();

$newproject = new project;

$recnum=$_REQUEST['recnum'];
$cond='where p.recnum='.$recnum;
$result = $newproject->getproject_details($cond);
$myrow=mysql_fetch_row($result);
?>
<script language="javascript" src="scripts/project.js"></script>
<link rel="stylesheet" href="style.css">
<html>
<head>
<title>Edit Project</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0" >
<form action='project_Process.php' method='GET' enctype='multipart/form-data'>
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
aany
</td></tr>
<table width=80% border=0 cellpadding=0 cellspacing=0>
  <tr bgcolor="FFFFFF">
	    <td width="6" bgcolor="#FFFFFF"></td>
        <table width=100% border=0 cellpadding=0 cellspacing=0 bgcolor="#FFFFFF">
<tr><td>
 <table width=100% border=0 align='center'>
<tr bgcolor='#FFFFFF'>
  
<td align="left" width='10%'><a href ="project_Summary.php" class="btn-primary-active">Project</a>
</td>

<?php
if ($_SESSION['usertype'] == 'host')
{
?>

<td align="left" width='10%'><a href ="account.php" class="btn-primary" >Company</a>
  </td>
  <td align="left" width='0%'><a href ="account.php" class="btn-primary" >Report</a>
<?php
}
?>
</tr>
  </table>

</td></tr>-->
 

<table width=100% border=0 cellpadding=0 cellspacing=0 bgcolor="#FFFFFF">
<tr><td>
<table width=100% border=0>
<td width="100%"><span class="pageheading"><b>Project Edit</b></td>

</table>



<table width=100% align='center' border=1 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1">
<tr bgcolor='#FFFFFF'>
<td ><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Project</p></font></td>
<td><span class="tabletext"><?php echo $myrow[1] ?></td>

<input type="hidden" name="project" id="project"  size=15 value="<?echo $myrow[1]?>">

<td><span class="labeltext"><p align="left">Desc</p></font></td>
<td><span class="tabletext"><textarea name="desc" id="desc" cols="40" rows="2"
			     ><?php echo $myrow[1] ?></textarea></td>
</tr>

<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Start Date</p></font></td>
<td><input type="text" name="start_date" id="start_date" size=15 value="<?echo $myrow[3]?>"><img src="images/bu-getdateicon.gif" alt="Get Date"  onclick="GetDate('start_date')"></td>
<td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Closed Date</p></font></td>
<td><input type="text" name="closed_date" id="closed_date" size=15 value="<?echo $myrow[4]?>"><img src="images/bu-getdateicon.gif" alt="Get Date"  onclick="GetDate('closed_date')"></td>
</tr>

<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">Requirement</p></font></td>
<td><input type="text" name="req" id="req"  size=15 value="<?echo $myrow[6]?>"></td>
<td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Customer</p></font></td>
<td><input type="text" name="company" id="company"  size=25  readonly="readonly" value="<?echo $myrow[10]?>">
<input type="hidden" id="siteid" name="siteid" value ="<?php echo $myrow[11]?>" >
<input type="hidden" id="companyrecnum" name="companyrecnum" value ="<?php echo $myrow[12]?>" >
</td>
</tr>

<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">Category</p></font></td>
<td><input type="text" name="category" id="category"  size=15 value="<?echo $myrow[7]?>"></td>
<td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Technology</p></font></td>
<td><input type="text" name="technology" id="technology"  size=15 value="<?echo $myrow[8]?>"></td>
</tr>

<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">Plateform</p></font></td>
<td ><input type="text" name="platform" id="platform"  size=15 value="<?echo $myrow[9]?>"></td>
<td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Manager</p></font></td>
<td><input type="text" name="manager" id="manager"  size=15 value="<?echo $myrow[5]?>"></td>

</tr>
<input type='hidden' name='recnum' value=<?echo $recnum?>>
<tr bgcolor='#FFFFFF'><td align='center' colspan=4>
<span class="tabletext"><input type="submit"
                     style="color=#0066CC;background-color:#DDDDDD;width=130;"
                     value="Update Project" name="submit" onclick="javascript: return check_req_fields()">
                <INPUT TYPE="RESET"
                     style="color=#0066CC;background-color:#DDDDDD;width=130;"
                     VALUE="Reset" onclick="javascript: putfocus()">
					 </td></tr>
					 </table>
</FORM>
</body>
</html>