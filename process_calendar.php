<?php 


session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
    header ( "Location: login.php" );
}

$userid = $_SESSION['user'];
$_SESSION['pagename'] = 'tasklistsummary';
$page = "Utillities: Calendar";
$userrecnum = $_SESSION['userrecnum'];

include_once('classes/userClass.php');
include('classes/tasklistClass.php');

$newtask= new tasklist;


$type = $_REQUEST['type'];
$pagetype = $_REQUEST['pagetype'];

// echo "<pre>";
// print_r($_REQUEST); exit;

if ($pagetype == "newevent") 
{
	$event_date =  $_REQUEST['event_date'];
	$notes_label = $_REQUEST['notes_label'];
	$event_notes = $_REQUEST['event_notes'];

	$newtask->setevent_date($event_date);
	$newtask->setnotes_label($notes_label);
	$newtask->setevent_notes($event_notes);
	$newtask->setuserid($userrecnum);

	$newtask->addevent_notes($userrecnum);

	header("Location:fullcalendar.php");
}


if($type == 'fetch')
{
	$firstday = $_REQUEST['firstday'];
	$lastday = $_REQUEST['lastday'];

	$events = array();
	$result=$newtask->get_eventnotes4month($firstday,$lastday);
	while ($mynotes = mysql_fetch_assoc($result))
	{
		$e = array();
	    $e['userid'] = $mynotes['userid'];
	    $e['title'] = $mynotes['notes_label'];
	    $e['start'] = $mynotes['create_date'];
	    $e['create_date'] = $mynotes['create_date'];
	    $e['notes'] = $mynotes['notes'];
	    $e['recnum'] = $mynotes['recnum'];

	
	    array_push($events, $e);
	}
	echo json_encode($events);
}



?>

