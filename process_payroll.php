<?php 

	session_start();
	header("Cache-control: private");

	include_once('classes/PayrollmasterClass.php');
	$newpayroll = new payroll_master;

  	
  	$name = $_POST['name'];
  	$id = $_POST['empid'];
  	$basic = $_POST['basic'];
  	$hra = $_POST['hra'];
  	$ta = $_POST['ta'];
  	$sa = $_POST['sa'];
  	$increment = $_POST['increment'];
  	$join_date = $_POST['jdate'];
  	$pagename = $_POST['pagename'];
  	$payrecnum = $_REQUEST['recnum'];
  	$role = $_POST['role'];
  	$grade = $_POST['grade'];

  	// echo "<pre>";
  	// print_r($_POST);
  	if ($pagename == 'newpayroll_master' )
	{
		$newpayroll->setname($name);
		$newpayroll->setid($id);
		$newpayroll->setbasic($basic);
		$newpayroll->sethra($hra);
		$newpayroll->setsa($sa);
		$newpayroll->setta($ta);
		$newpayroll->setincrement($increment);
		$newpayroll->setjoin_date($join_date);
		$newpayroll->setrole($role);
		$newpayroll->setgrade($grade);
		
		$recnum = $newpayroll->addnewpayroll_master();

		
		
	}
	else if ($pagename == 'editpayroll_master' )
	{
		$newpayroll->setname($name);
		$newpayroll->setid($id);
		$newpayroll->setbasic($basic);
		$newpayroll->sethra($hra);
		$newpayroll->setsa($sa);
		$newpayroll->setta($ta);
		$newpayroll->setincrement($increment);
		$newpayroll->setjoin_date($join_date);
		$newpayroll->setrole($role);
		$newpayroll->setgrade($grade);
		
		// echo "<pre>";
		// print_r($_POST);
		$newpayroll->updatepayroll_master($payrecnum);

		
		
	}	

header("Location: payrollsummary.php");
?>