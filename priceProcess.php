<?php
//==============================================
// Author: FSI                                 =
// Date-written = July 21, 2011                  =
// Filename: invoiceProcess.php                =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OWT                          =
// Processing of Invoice                          =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];

$pagename = $_SESSION['pagename'];

include('classes/priceClass.php');

// Next, create an instance of the classes required
$newprice = new price;

if ($pagename == 'priceentry') {
   $crnnum = $_REQUEST['crnnum'];
   $cimpartname = $_REQUEST['cimpartname'];
   $validf = $_REQUEST['validf'];
   $validt = $_REQUEST['validt'];
   $status = $_REQUEST['status'];
   $price = $_REQUEST['price'];
   $currency = $_REQUEST['currency'];
   $remarks = $_REQUEST['remarks'];
   $type = $_REQUEST['type'];
   $partname = $_REQUEST['partname'];
   $link2customer = $_REQUEST['companyrecnum'];
   
                $newlogin = new userlogin;
				$newlogin->dbconnect();
  				$newprice->setcrnnum($crnnum);
		  		$newprice->setcimpartname($cimpartname);
			   	$newprice->setvalidf($validf);
   				$newprice->setvalidt($validt);
	  			$newprice->setstatus($status);
	    	   	$newprice->setprice($price);
	    	   	$newprice->setcurrency($currency);
	    	   	$newprice->setremarks($remarks);
	    	   	$newprice->settype($type);
	    	   	$newprice->setpartname($partname);
    	   		$newprice->setlink2customer($link2customer);
	    	   	
	    	   	$sql = "start transaction";
				$result = mysql_query($sql);
				$pricerecnum = $newprice->addPrice();
				$sql = "commit";
			    $result = mysql_query($sql);
			    if(!$result)
                  {
                        $sql = "rollback";
				        $result = mysql_query($sql);
				        die("Commit failed price Insert..Please report to Sysadmin. " . mysql_errno());
	              }
	              header("Location:priceSummary.php" );

}
if ($pagename == 'priceedit') {
   $crnnum = $_REQUEST['crnnum'];
   $cimpartname = $_REQUEST['cimpartname'];
   $validf = $_REQUEST['validf'];
   $validt = $_REQUEST['validt'];
   $status = $_REQUEST['status'];
   $price = $_REQUEST['price'];
   $currency = $_REQUEST['currency'];
   $remarks = $_REQUEST['remarks'];
   $recnum = $_REQUEST['pricerecnum'];
   $create_date = $_REQUEST['create_date'];
   $type = $_REQUEST['type'];
   $partname = $_REQUEST['partname'];
   $link2customer = $_REQUEST['companyrecnum'];
                $newlogin = new userlogin;
				$newlogin->dbconnect();
  				$newprice->setcrnnum($crnnum);
		  		$newprice->setcimpartname($cimpartname);
			   	$newprice->setvalidf($validf);
   				$newprice->setvalidt($validt);
	  			$newprice->setstatus($status);
	    	   	$newprice->setprice($price);
	    	   	$newprice->setcurrency($currency);
	    	   	$newprice->setremarks($remarks);
	    	   	$newprice->setcreate_date($create_date);
	    	   	$newprice->settype($type);
	    	   	$newprice->setpartname($partname);
	    	   	$newprice->setlink2customer($link2customer);

	    	   	$sql = "start transaction";
				$result = mysql_query($sql);
                $newprice->updatePrice($recnum);
				$sql = "commit";
			    $result = mysql_query($sql);
			    if(!$result)
                  {
                        $sql = "rollback";
				        $result = mysql_query($sql);
				        die("Commit failed invoice Insert..Please report to Sysadmin. " . mysql_errno());
	              }
	              header("Location:priceSummary.php" );

}


?>
