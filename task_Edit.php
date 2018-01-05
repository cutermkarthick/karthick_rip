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
$page="Project";
//session_register('pagename');

// First include the class definition
include_once('classes/loginClass.php');
include('classes/taskClass.php');

//$newLogin= userlogin::singleton();

$newtask = new task;

$recnum=$_REQUEST['recnum'];
$project = $_REQUEST['link2project'];
$cond='where t.recnum='.$recnum;
$result = $newtask->gettask_details($cond);
$myrow=mysql_fetch_row($result);
?>
<script language="javascript" src="scripts/task.js"></script>
<link rel="stylesheet" href="style.css">
<html>
<head>
<title>Edit Task</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0" onload="javascript:createTab('project')">
<form action='task_Process.php' method='POST' enctype='multipart/form-data'>
<?php
include('header.html');
?>
<!-- <table width=100% cellspacing="0" cellpadding="6" border="0">
<tr>
<td>
<table width=100% border=0 cellspacing="0" cellpadding="0">
<tr>
<td colspan=2><span class="welcome"><b>Welcome <?php echo $userid?></b></td>
 --><?
$status=$_REQUEST['status'];
if($status=='notes')
{
echo "<td><font color='green'>Notes Inserted Successfully</font></td>";
}
elseif($status=='custnotes')
{
echo "<td><font color='green'>Customer Notes Inserted Successfully</font></td>";
}?>
<!-- <td align="right">&nbsp;
<a href="exit.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image16','','images/logout_mo.gif',1)"><img name="Image16" border="0" src="images/logout.gif"></a></td>
</tr>
</table>
<table width=100% border=0 cellpadding=0 cellspacing=0>
<tr><td></td></tr>
<tr>
<td>
</table>
</table>
</td></tr>
<table width=100% border=0 cellpadding=0 cellspacing=0>
<tr bgcolor="#FFFFFF"><td width="6"></td>
<td bgcolor="#FFFFFF">

<table width=100% border=0>
<tr>
<td align="left" width='15%'></a>
</td>
<td align="left" width='8%'><a href ="project_Summary.php" class="btn-primary-active">Project</a>
</td> 
<?php 
if ($_SESSION['usertype'] == 'host')
{
?>

<td align="left" width='9%'><a href ="account.php" class="btn-primary" >Company</a>
</td>
<td align="left" width='0%'><a href ="account.php" class="btn-primary" >Report</a></td>
<?php
}
?>
</tr>
</table>
</table>

</td></tr>


<table width=100% border=0 cellpadding=0 cellspacing=0 bgcolor="#FFFFFF">
<tr><td>
 --><table width=100% align='center' border=1 cellpadding=4 cellspacing=1 bgcolor="#FFFFFF">
<tr >
<td width=20% align='left'><span class="pageheading"></b><b>Edit Task</b></td>
<td width=80% align='center'><span class="pageheading"><b>PROJECT=<?php echo $project ?></b></td>  

</tr>
</table>


<table width=100% align='center' border=1 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF"  class="stdtable1">
<tr bgcolor='#FFFFFF'>
<td ><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Task Id</p></font></td>
<td><span class="tabletext"><?php echo $myrow[1] ?></td>
<input type="hidden" name="task_id" id="task_id"  size=15 value="<?echo $myrow[1]?>">

<td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Task Name</p></font></td>
<td><input type="text" name="task_name" id="task_name"  size=15 value="<?echo $myrow[2]?>"></td>
</tr>

<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">Category</p></font></td>
<td><input type="text" name="category" id="category"  size=15 value="<?echo $myrow[3]?>"></td>
<td><span class="labeltext"><p align="left">Description</p></font></td>
<td><input type="text" name="desc" id="desc"  size=15 value="<?echo $myrow[4]?>"></td>
</tr>

<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Start Date</p></font></td>
<td><input type="text" name="start_date" id="start_date" size=15 value="<?echo $myrow[7]?>" readonly="readonly" style="background-color:##DDDDDD"><img src="images/bu-getdateicon.gif" alt="Get Date"  onclick="GetDate('start_date')"></td>
<td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Finish Date</p></font></td> 
<td><input type="text" name="finish_date" id="finish_date" size=15 value="<?echo $myrow[8]?>" readonly="readonly" style="background-color:##DDDDDD"><img src="images/bu-getdateicon.gif" alt="Get Date"  onclick="GetDate('finish_date')"></td>
</tr>


<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">Status</p></font></td>
<td><span class="tabletext">
<select name="status" id="status">
<?
$status=array('Created','Accepted','Dev Done','Tested','Closed','Reopen');				
for($j=0;$j<count($status);$j++)
{					
if($status[$j] == $myrow[5]){?>
<option selected value="<? echo $status[$j]?>"><?echo $status[$j]; ?> 
</option>
<?}
else{?>
<option value="<? echo $status[$j]?>"><?echo $status[$j]; ?> 
</option>
<?}
}?>
</td>

<td><span class="labeltext"><p align="left">Priority</p></font></td>
<td><span class="tabletext">
<select name="priority" id="priority">
<?
$priority=array('low','medium','high');
for($j=0;$j<count($priority);$j++)
{         
if($priority[$j] == $myrow[6]){?>
<option selected value="<? echo $priority[$j]?>"><?echo $priority[$j]; ?> 
</option>
<?}
else{?>
<option value="<? echo $priority[$j]?>"><?echo $priority[$j]; ?> 
</option>
<?}
}?>
</td>


</td>

<?php

$usertype=$_SESSION['usertype'];

if($usertype =='host')
{
?><tr bgcolor="#FFFFFF">
<td rowspan=2><span class="labeltext"><p align="left">Notes</p></font></td>
<?
$userrole=$_SESSION['role'];

if($userrole == 'SU' || $userrole == 'RU')
{
printf('<td align="right" colspan=3><span class="labeltext"><a href=addNotes.php?recnum='.$recnum.'&link2project='.$_REQUEST["link2project"].'>Add Notes</span></td></tr>');
}

printf('<tr bgcolor="#FFFFFF"><td colspan=3><textarea name="notes" rows="3" cols="70" style="background-color:#DDDDDD;"
readonly="readonly">');
$result1 = $newtask->getNote($recnum,$_REQUEST['link2project']);
while ($mynotes1 = mysql_fetch_row($result1)) {
printf("\n");
printf("********Added by $mynotes1[2] on $mynotes1[0]*******");
printf("\n");
printf($mynotes1[1]);
printf("   \n");
}

?>
</textarea></td>
</tr>
<?php

}?>
<tr bgcolor="#FFFFFF">
<td bgcolr="#FFFFFF" rowspan=2><span class="labeltext"><p align="left">Customer Notes</p></font></td>
<?
$userrole=$_SESSION['role'];
if($userrole == 'RU' || $userrole == 'SU')
{
printf('<td align="right" colspan=3><span class="labeltext"><a href=addCustNotes.php?recnum='.$recnum.'&link2project='.$_REQUEST["link2project"].'>Add Notes</span></td></tr>');
}
printf('
<tr bgcolor="#FFFFFF"><td colspan=3><textarea name="customer_notes" rows="3" cols="70"
>');
$result2 = $newtask->getCustNote($recnum,$_REQUEST['link2project']);
while ($mynotes2 = mysql_fetch_row($result2)) {
printf("\n");
printf("********Added by $mynotes2[2] on $mynotes2[0]*******");
printf("\n");
printf($mynotes2[1]);
printf("   \n");
}

?>
</textarea></td>
</tr>
<input type='hidden' name='recnum_task' value=<?echo $recnum?>>
<input type='hidden' name='recnum_project' value=<?echo $_REQUEST['link2project']?>>

<tr bgcolor='#FFFFFF'><td align='center' colspan=4>
<span class="tabletext"><input type="submit"
style="color=#0066CC;background-color:#DDDDDD;width=130;"
value="Update Task" name="submit" onclick="javascript: return check_req_fields()">
<INPUT TYPE="RESET"
style="color=#0066CC;background-color:#DDDDDD;width=130;"
VALUE="Reset" onclick="javascript: putfocus()">
</td></tr>
</table>
</FORM>
</body>
</html>