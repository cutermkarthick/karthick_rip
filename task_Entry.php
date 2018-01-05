<?php

//==============================================
// Author: FSI                                 =
// Date-written = April 06, 2010               =
// Filename: task_Entry.php                    =
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
$_SESSION['pagename'] = 'task_entry';
$page="CRM: Project";
//session_register('pagename');

// First include the class definition
include_once('classes/loginClass.php');
include('classes/taskClass.php');
$project = $_REQUEST['project'];
$project_recnum = $_REQUEST['projrecnum'];
//$newLogin= userlogin::singleton();

$newtask = new task;
$tasks_id = $newtask->gettask_uniqueid();



?>
<script language="javascript" src="scripts/task.js"></script>
<link rel="stylesheet" href="style.css">

<html>
	<head>
		<title>New Task</title>
	</head>

	<body leftmargin="0"topmargin="0" marginwidth="0" onload="javascript:createTab('project')">
		<form action='task_Process.php' method='POST' enctype='multipart/form-data'>
		<?php
			include('header.html');
		?>

 		<table width=100% align='center' border=1 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1">
			<tr bgcolor='#B0C4DE'>
				<td width=20%><span class="pageheading"><b>New Task</b></td>
				<td width=80% align='center'><span class="pageheading"><b>PROJECT=<?php echo $project ?></b></td>
			</tr>
		</table>


		<table width=100% align='center' border=1 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1" >
			<tr bgcolor='#FFFFFF'>
				<td ><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Task Id</p></font></td>
				<td><input type="text" readonly name="task_id" id="task_id"  size=15 value="<?php echo $tasks_id; ?>"></td>

				<td ><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Task Name</p></font></td>
				<td><input type="text" name="task_name" id="task_name"  size=15 value=""></td>
			</tr>

			<tr bgcolor="#FFFFFF">
				<td><span class="labeltext"><p align="left">Category</p></font></td>
				<td><input type="text" 
						<?php 
						if($_SESSION['usertype']=='cust') echo 'readonly';
						?>
						name="category" id="category"  size=15 value="">
				</td>

				<td><span class="labeltext"><p align="left">Description</p></font></td>
				<td><input type="text" name="desc" id="desc"  size=15 value=""></td>
			</tr>

			<tr bgcolor="#FFFFFF">
				<td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Start Date</p></font></td>
				<td><input type="text" name="start_date" id="start_date" size=15 value=""><img src="images/bu-getdateicon.gif" alt="Get Date"  onclick="GetDate('start_date')"></td>
				<td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Est Finish Date</p></font></td>
				<td><input type="text" name="finish_date" id="finish_date" size=15 value=""><img src="images/bu-getdateicon.gif" alt="Get Date"  onclick="GetDate('finish_date')"></td>
			</tr>

			<tr bgcolor="#FFFFFF">
				<td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>User</p></font></td>
				<td><input type="text" name="userid" id="userid"  size=15 value="" readonly="readonly">
				<img src="images/bu-get.gif" alt="Get Customer" 
				onclick="GetUsers4Task()">
				<input type="hidden" id="userrecnum" name="userrecnum" value ="" >
				</td>
				<td></td>
				<td></td>
			</tr>

			<tr bgcolor="#FFFFFF">
				<td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Est Time(Hours)</p></font></td>
				<td><input type="number" name="estimate_hours" id="estimate_hours"  size=15 value="" min="1" max="24" step="1"></td>
				<td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Est Time(Mins)</p></font></td>
				<td><input type="number" name="estimate_mins" id="estimate_mins"  size=15 value="" min="1" max="60" step="1"></td>
			</tr>

			<tr bgcolor="#FFFFFF">
				<td><span class="labeltext"><p align="left">Status</p></font></td>
				<td><span class="tabletext">
				<?php
				if($_SESSION['usertype']!='cust')
				{
				?>
					<select name="status" id="status">
						<?php
						$status=array('Created','Accepted','Dev Done','Tested','Closed','Reopen');				
						for($j=0;$j<count($status);$j++)
						{					
							if($status[$j] == $myrow[5]){?>
								<option selected value="<? echo $status[$j]?>"><?echo $status[$j]; ?> </option>
							<?php
							}
							else
							{?>
								<option value="<? echo $status[$j]?>"><?echo $status[$j]; ?> </option>
							<?php
							}
						}
				}
				else
				{
				?>
				<select name="status" id="status">
					<option selected value='Created'>Created</option>
				<?php 
				}
				?>
				</td>
				<td><span class="labeltext"><p align="left">Priority</p></font></td>
				<td><span class="tabletext"> 
					<select name="priority" id="priority">
						<option value="low">Low</option>
						<option value="medium">Medium</option>
						<option value="high">High</option>
					</select>
				</td>
			</tr>

			<?php
			if($_SESSION['usertype']!='cust')
			{
			?>
			<tr bgcolor="#FFFFFF">
				<td><span class="labeltext"><p align="left">Notes</p></font></td>
				<td colspan=3><textarea name="notes" rows="6" cols="70"></textarea></td>
			</tr>
			<?php 
			}
			?>

			<input type='hidden' name='recnum_project' value=<?echo $project_recnum ?>>

			<tr bgcolor='#FFFFFF'>
				<td align='center' colspan=4><span class="tabletext">
				<input type="submit" style="color=#0066CC;background-color:#DDDDDD;width=130;" value="New Task" name="submit" onclick="javascript: return check_req_fields()">
				<input type="RESET" style="color=#0066CC;background-color:#DDDDDD;width=130;" value="Reset" onclick="javascript: putfocus()">
				</td>
			</tr>
		</table>
		</form>
	</body>
</html>