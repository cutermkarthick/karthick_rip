<?php

//==============================================
// Author: FSI                                 =
// Date-written = April 06, 2010               =
// Filename: project_details.php               =
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
$_SESSION['pagename'] = 'task';
//session_register('pagename');

// First include the class definition
include_once('classes/loginClass.php');
include('classes/projectClass.php');
include('classes/taskClass.php');

$newLogin= userlogin::singleton();
$newproject = new project;
$newtask = new task;

$recnum=$_SESSION['projectid'];
$cond_1='where recnum='.$recnum;
$cond_2='where link2project='.$recnum;
//$result1 = $newproject->getproject_details($cond_1);
//$myrow = mysql_fetch_row($result1);
$result2 = $newtask->gettask_details($cond_2);
if($myrow[3] != '' && $myrow[3] != '0000-00-00')   
{
		$datearr = split('-', $myrow[3]);
		$d=$datearr[2];
		$m=$datearr[1];
		$y=$datearr[0];
		$x=mktime(0,0,0,$m,$d,$y);
		$start_date=date("M j, Y",$x);
}
else
{
		$start_date='';
}

if($myrow[4] != '' && $myrow[4] != '0000-00-00')   
{
		$datearr = split('-', $myrow[4]);
		$d=$datearr[2];
		$m=$datearr[1];
		$y=$datearr[0];
		$x=mktime(0,0,0,$m,$d,$y);
		$closed_date=date("M j, Y",$x);
}
else
{
		$closed_date='';
}
$desc=wordwrap($myrow[2],122,"<br/>",true);
?>
<script language="javascript" src="scripts/project.js"></script>
<script language="javascript" src="scripts/task.js"></script>
<link rel="stylesheet" href="style.css">
<html>
<head>
<title>Project Details</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0" onload="javascript:createTab('project')">
<form action='project_Process.php' method='GET' enctype='multipart/form-data'>
<?php
 include('header2.html');
?>
<table width=100% cellspacing="0" cellpadding="6" border="0">
	<tr>
		<td>
			<table width=100% border=0 cellspacing="0" cellpadding="0">
   				<tr>
        		<td colspan=2><span class="welcome"><b>Welcome <?php echo $userid?></b></td>
								<?
$status=$_REQUEST['status'];
if($status=='edit_project')
{
echo "<td><font color='green'>Project :<font color='red'> ". $_REQUEST['project']."</font>  Updated Succesfully.</font></td>";
}
else if($status=='edit_task')
{
echo "<td><font color='green'>Project :<font color='red'> ". $myrow[1]."</font>  with task ID: <font color='red'>".$_REQUEST['task_id']." </font> Updated Succesfully.</font></td>";
}
else if($status=='new_task')
{
echo "<td><font color='green'>Project :<font color='red'> ". $myrow[1]."</font>  with task ID: <font color='red'>".$_REQUEST['task_id']." </font> Inserted Succesfully.</font></td>";
}
?>
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
<table width=100% border=0>
<tr>
<td width='78%' align="right" ></td>
<td width='22%' align="left"><a href ="task_Entry.php?recnum=<?echo $recnum?>"><img name="Image8" border="0" src="images/bu-newtask.png" height='36'></a>
  </td>
  <tr>
  </table>
</td></tr>



<table width=70% align='center' border=1 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF" >

<tr bgcolor='#B0C4DE'>
<td align='center' colspan=5><span class="pageheading"><b>Task Details</b></td>  
</tr>
<tr bgcolor="#FFFFFF">
<td bgcolor="#A5EEFD"><span class="heading"><b>Task Id</b></td>
<td bgcolor="#A5EEFD"><span class="heading"><b>Task Name</b></td>
<td bgcolor="#A5EEFD"><span class="heading"><b>Category</b></td>
<td bgcolor="#A5EEFD"><span class="heading"><b>Status</b></td>
</tr>
<?
while($myLI = mysql_fetch_row($result2)) 
{
	         $notes=wordwrap($myLI[6],122,"<br/>",true);
             echo"<tr><td bgcolor=\"#FFFFFF\"><span class=\"tabletext\"><a href=\"task_edit_customer.php?recnum=$myLI[0]&link2project=$recnum\">
			 $myLI[1]</td>" ;
             echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$myLI[2]</td>";
             echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$myLI[3]</td>";       
			 echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$myLI[5]</td>";	
}?>
</tr>
</table>

</FORM>
</body>
</html>