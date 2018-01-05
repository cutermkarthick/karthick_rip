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

include('classes/newsEntryClass.php'); 

// Next, create an instance of the classes required
$newNews = new newsEntry; 

// Get all fields related to Vend Part

if($pagename=='newsEntry')
{

	// $taskid=$_REQUEST['task_id'];
	$created_by=$_REQUEST['created_by'];
	$Date=$_REQUEST['Date'];
    $descr=$_REQUEST['descr'];
	
    // $newTask->settaskid($taskid);
    $newNews->setcreated_by($created_by);
    $newNews->setDate($Date);
    $newNews->setdescr($descr);
   
	$recnum=$newNews->addNews();
	// print_r($_REQUEST['taskcreate_date']);
	

// if($pagename == 'edit_updateinvcount')
// {
// 	$recnum = $_REQUEST['recnum'];
// 	$partrecnum = $_REQUEST['partrecnum'];

// 	$ref_type=$_REQUEST['ref_type'];
// 	$ref_num=$_REQUEST['ref_num'];
// 	$type1=$_REQUEST['type1'];
//     $qty=$_REQUEST['qty'];
// 	$rece_by=$_REQUEST['rece_by'];
// 	$crn=$_REQUEST['crn'];
// 	$mc_name=$_REQUEST['mc_name'];
// 	$status = $_REQUEST['issStatus'];
// 	$clbal = $_REQUEST['clbal'];

//     $newVend->setref_num($ref_num);
//     $newVend->setref_type($ref_type);
//     $newVend->settype1($type1);
//     $newVend->setqty($qty);
//     $newVend->setrece_by($rece_by);
//     $newVend->setcrn($crn);
//     $newVend->setmc_name($mc_name);
//     $newVend->setstatus($status);
//     $newVend->setclbal($clbal);


//      $newVend->updateinventory($recnum);
//      if($status == 'Active')
//      {
//          $newVend->increaseInv($qty);
// }
// header("Location:dashboard.php");


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
