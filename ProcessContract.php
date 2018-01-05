<?php 

include('classes/contractClass.php');
$newContract = new contract;

session_start();
header("Cache-control: private");
if ( !isset ( $_SESSION['user'] ) )
{
  header ( "Location: login.php" );
}

$pagename = $_SESSION['pagename'];

$companyname = $_REQUEST['companyname'];
$start_date = $_REQUEST['start_date'];
$end_date = $_REQUEST['end_date'];


$newContract->setcompanyname($companyname);
$newContract->setstart_date($start_date);
$newContract->setend_date($end_date);

if ($pagename == "newcontract") {
	$recnum = $newContract->AddContract();

}else if($pagename == "editcontract"){
	$status = $_REQUEST['status'];
	$approved = $_REQUEST['approved'];
	$approved_by = $_REQUEST['approved_by'];
	$approved_date = $_REQUEST['approved_date'];
	$recnum = $_REQUEST['recnum'];

	$newContract->setstatus($status);
	$newContract->setapproved($approved);
	$newContract->setapproved_by($approved_by);
	$newContract->setapproved_date($approved_date);

	$newContract->UpdateContract($recnum);
}

if ($pagename == "newcontract") {
	header("Location:Contract.php");
}else if($pagename == "editcontract"){
	header("Location:ContractDetails.php?recnum=$recnum");
}



?>