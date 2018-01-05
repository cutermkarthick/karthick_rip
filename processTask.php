<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = May 27,2005                  =
// Filename: processinvCont.php                =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OMS                          =
//==============================================

session_start();
header("Cache-control: private"); 

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );
    
}
$userid = $_SESSION['user'];

$pagename = $_SESSION['pagename'];

include('classes/taskEntryClass.php'); 

// Next, create an instance of the classes required
$newTask = new taskEntry; 

// Get all fields related to Vend Part

if($pagename=='taskEntry')
{

	// $taskid=$_REQUEST['task_id'];
	$task_name=$_REQUEST['task_name'];
	$taskcreate_date=$_REQUEST['taskcreate_date'];
    $taskcomp_date=$_REQUEST['taskcomp_date'];
	
    // $newTask->settaskid($taskid);
    $newTask->settaskname($task_name);
    $newTask->settaskcreate_date($taskcreate_date);
    $newTask->settaskcompleted_date($taskcomp_date);
   

	$recnum=$newTask->addTask();

}
if($pagename=='taskEdit')
{

	$taskrecnum=$_REQUEST['taskrecnum'];
	$task_name=$_REQUEST['task_name'];
	$taskcreate_date=$_REQUEST['taskcreate_date'];
    $taskcomp_date=$_REQUEST['taskcomp_date'];
	
    // $newTask->settaskid($taskid);
    $newTask->settaskname($task_name);
    $newTask->settaskcreate_date($taskcreate_date);
    $newTask->settaskcompleted_date($taskcomp_date);
   

	$recnum=$newTask->UpdateTask($taskrecnum);

}

?>
<html>
<head>
<script language=javascript>
function closePage()
{
self.close();
window.opener.location.reload();
}
</script>
</head>
<body onLoad="closePage()">
</body>
</html>


