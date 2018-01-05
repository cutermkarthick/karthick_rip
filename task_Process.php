<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = April 07, 2010               =
// Filename: task_rocess.php                   =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
//==============================================

session_start();
header("Cache-control: private");
$userid = $_SESSION['user'];
$userrecnum = $_SESSION['userrecnum'];

$pagename= $_SESSION['pagename'];
include('classes/taskClass.php');
include('config.php');
$submit=$_REQUEST['submit'];
//Next, create an instance of the class
$newtask = new task;


$task_id = $_REQUEST['task_id'];
$task_name = $_REQUEST['task_name'];
$category = $_REQUEST['category'];
$desc = $_REQUEST['desc'];
$status = $_REQUEST['status'];
$notes = $_REQUEST['notes'];
$customer_notes = $_REQUEST['customer_notes'];
$priority = $_REQUEST['priority'];
$start_date = $_REQUEST['start_date'];
$finish_date = $_REQUEST['finish_date'];
$assigned_user = $_REQUEST['userrecnum'];
$estimate_hours = $_REQUEST['estimate_hours'];
$estimate_mins = $_REQUEST['estimate_mins'];

//$newLogin= userlogin::singleton();

$newtask->settask_id($task_id);
$newtask->settask_name($task_name);
$newtask->setcategory($category);
$newtask->setdesc($desc);
$newtask->setstatus($status);
$newtask->setnotes($notes);
$newtask->setcustomer_notes($customer_notes);
$newtask->setpriority($priority);
$newtask->setstart_date($start_date);
$newtask->setfinish_date($finish_date);
$newtask->setassigned_user($assigned_user);
$newtask->setestimate_hours($estimate_hours);
$newtask->setestimate_mins($estimate_mins);

$recnum_project=$_REQUEST['recnum_project'];

if($submit == 'New Task')
{
	$newtask->addTask($recnum_project);
	$result=$newtask->getlast_Task();
	$myrow=mysql_fetch_row($result);
	$newtask->InsertNotes($myrow[0],$recnum_project);

	$API_ACCESS_KEY = $config['fcm_api_access_key'] ;
	$Legacy_Server_API_Key = $config['Legacy_Server_API_Key'] ;

	$registrationIds = $newtask->getMobileIdToken($assigned_user);


	// prep the bundle
	$msg = array
	(
		'message' 	=> 'here is a message. message',
		'title'		=> $task_id.': '. $task_name,
		'subtitle'  => $desc,
		'vibrate'   => 1,
    	'sound'     => 1,
	);
	$fields = array
	(
		'registration_ids'=> $registrationIds,
		'notification'=> $msg,
		'priority'=> 'high'
	);
	 
	$headers = array
	(
		'Authorization: key=' . $Legacy_Server_API_Key,
		'Content-Type: application/json'
	);
	
	$ch = curl_init();
	curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
	curl_setopt( $ch,CURLOPT_POST, true );
	curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
	curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
	curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
	curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
	$result = curl_exec($ch );
	curl_close( $ch );


	if(($_SESSION['usertype']!='cust'))
	{
		header("Location:project_details.php?status=new_task&task_id=$myrow[1]&recnum=$recnum_project");
	}
	else
	{
		header("Location:project_details.php?status=new_task&task_id=$myrow[1]&recnum=$recnum_project");
	}
}

if($submit == 'Update Task')
{
	$recnum_task=$_REQUEST['recnum_task'];

	$newtask->UpdateTask($recnum_task,$recnum_project);
	if(($_SESSION['usertype']!='cust'))
	{
		header("Location:project_details.php?status=edit_task&task_id=$task_id&recnum_task=$recnum_task&recnum=$recnum_project");
	}
	else
	{
		header("Location:project_details.php?status=edit_task&task_id=$task_id&recnum_task=$recnum_task&recnum=$recnum_project");
	}
}

if($submit == 'Add Notes')
{
	$recnum_task=$_REQUEST['recnum_task'];
	$newtask->InsertNotes($recnum_task,$recnum_project);

	if(($_SESSION['usertype']!='cust'))
	{
		header("Location:task_Edit.php?status=notes&recnum=$recnum_task&link2project=$recnum_project");
	}
	else
	{
		header("Location:task_edit_customer.php?status=notes&recnum=$recnum_task&link2project=$recnum_project");
	}
}

if($submit == 'Add CustNotes')
{	
	$recnum_task=$_REQUEST['recnum_task'];
	$newtask->InsertCustNotes($recnum_task,$recnum_project);
	if(($_SESSION['usertype']!='cust'))
	{
		header("Location:task_Edit.php?status=custnotes&recnum=$recnum_task&link2project=$recnum_project");
	}
	else
	{
		header("Location:task_edit_customer.php?status=custnotes&recnum=$recnum_task&link2project=$recnum_project");
	}
}
