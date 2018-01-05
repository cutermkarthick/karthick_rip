<?php 


session_start();
header("Cache-control: private"); 

if ( !isset ( $_SESSION['user'] ) )
{
 	header ( "Location: login.php" );	
}

$userid = $_SESSION['user'];
$userrecnum = $_SESSION['userrecnum'];

include_once('classes/attendanceClass.php');
$newattendance = new Attendance;

$pagename= $_SESSION['pagename'];

$empid = $_REQUEST['empid'];
$month = $_REQUEST['month'];
$year = $_REQUEST['year'];



if ($pagename == "attendancemonthly") {
	
	$result = $newattendance->getAttendanceDaysCount($empid,$month,$year);
	$attendance_cnt = mysql_num_rows($result);

	$numrows = $newattendance->CheckMonthlyAttendance($empid,$month,$year);
	if ($numrows == 0) {
		$newattendance->InsertMonthlyAttendance($empid,$month,$year,$attendance_cnt);	
	}
	else{
		$newattendance->UpdateMonthlyAttendance($empid,$month,$year,$attendance_cnt);
	}
	
	header("Location:attendancemonthly_Details.php?empid=$empid&month=$month&year=$year");
}


?>