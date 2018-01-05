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

include('classes/vendPartClass.php'); 

// Next, create an instance of the classes required
$newVend = new vendPart; 

// Get all fields related to Vend Part

if($pagename=='updateinvCount')
{
	$ref_type=$_REQUEST['ref_type'];
	$ref_num=$_REQUEST['ref_num'];
	$type1=$_REQUEST['type1'];
    $qty=$_REQUEST['qty'];
	$inv_date=$_REQUEST['inv_date'];
	$inv_num=$_REQUEST['inv_num'];
	$rece_date=$_REQUEST['rece_date'];
	$rece_by=$_REQUEST['rece_by'];
	$inv_value=$_REQUEST['inv_value'];
	$crn=$_REQUEST['crn'];
	$mc_name=$_REQUEST['mc_name'];

    $newVend->setref_num($ref_num);
    $newVend->setref_type($ref_type);
    $newVend->settype1($type1);
    $newVend->setqty($qty);
    $newVend->setinv_date($inv_date);
    $newVend->setinv_num($inv_num);
    $newVend->setrece_date($rece_date);
    $newVend->setrece_by($rece_by);
    $newVend->setinv_value($inv_value);
    $newVend->setcrn($crn);
    $newVend->setmc_name($mc_name);

	$recnum=$newVend->addinventory($qty);
	if($type1=='Receipts')

	   $newVend->increaseInv($qty);
	
	if($type1=='Issues')

		   $newVend->decreaseinv($qty);

	
}
	
if($pagename == 'edit_updateinvcount')
{
	$recnum = $_REQUEST['recnum'];
	$partrecnum = $_REQUEST['partrecnum'];

	$ref_type=$_REQUEST['ref_type'];
	$ref_num=$_REQUEST['ref_num'];
	$type1=$_REQUEST['type1'];
    $qty=$_REQUEST['qty'];
	$rece_by=$_REQUEST['rece_by'];
	$crn=$_REQUEST['crn'];
	$mc_name=$_REQUEST['mc_name'];
	$status = $_REQUEST['issStatus'];
	$clbal = $_REQUEST['clbal'];

    $newVend->setref_num($ref_num);
    $newVend->setref_type($ref_type);
    $newVend->settype1($type1);
    $newVend->setqty($qty);
    $newVend->setrece_by($rece_by);
    $newVend->setcrn($crn);
    $newVend->setmc_name($mc_name);
    $newVend->setstatus($status);
    $newVend->setclbal($clbal);


     $newVend->updateinventory($recnum);
     if($status == 'Active')
     {
         $newVend->increaseInv($qty);
}
header("Location:vendpartDetails.php?partrecnum=$partrecnum");


}


?> 
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
