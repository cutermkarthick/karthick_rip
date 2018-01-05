<?php 


session_start();
header("Cache-control: private"); 

if ( !isset ( $_SESSION['user'] ) )
{
 	header ( "Location: login.php" );	
}

$userid = $_SESSION['user'];
$userrecnum = $_SESSION['userrecnum'];

include('classes/empconfigClass.php'); 
$newEmpconfig = new empconfig; 

$pagename= $_SESSION['pagename'];

$company = $_REQUEST['company'];
$companyrecnum = $_REQUEST['companyrecnum'];
$shift_group = $_REQUEST['shift_group'];
$start_hour = $_REQUEST['start_hour'];
$start_min = $_REQUEST['start_min'];
$end_hour = $_REQUEST['end_hour'];
$end_min = $_REQUEST['end_min'];


$newEmpconfig->setcompany($company);
$newEmpconfig->setcompanyrecnum($companyrecnum);
$newEmpconfig->setshift_group($shift_group);
$newEmpconfig->setstart_hour($start_hour);
$newEmpconfig->setstart_min($start_min);
$newEmpconfig->setend_hour($end_hour);
$newEmpconfig->setend_min($end_min);


if ($pagename == "newempConfig") {
	$id = $newEmpconfig->addEmpConfig();
	header("Location:employee_config_summary.php");
}
elseif ($pagename == "editempConfig") {
	$recnum = $_REQUEST['recnum'];
	$newEmpconfig->UpdateEmpConfig($recnum);
	header("Location:employee_config_summary.php");
}


?>