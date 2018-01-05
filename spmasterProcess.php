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

include('classes/spmasterClass.php');

// Next, create an instance of the classes required
$newspmaster = new spmaster;

if ($pagename == 'spmasterentry') {

   $crnnum = $_REQUEST['crnnum'];
   $partnum = $_REQUEST['partnum'];
   $aukpartnum = $_REQUEST['aukpartnum'];
   $saabpartnum = $_REQUEST['saabpartnum'];
   $currency = $_REQUEST['currency'];
   $price = $_REQUEST['price'];
   $price_valid_from = $_REQUEST['price_valid_from'];
   $price_valid_upto = $_REQUEST['price_valid_upto'];
   $qty = $_REQUEST['qty'];
   $qty_valid_from = $_REQUEST['qty_valid_from'];
   $qty_valid_upto = $_REQUEST['qty_valid_upto'];
   $totalcost = $_REQUEST['totalcost'];
   $totalcost_valid_from = $_REQUEST['totalcost_valid_from'];
   $totalcost_valid_upto = $_REQUEST['totalcost_valid_upto'];
   $link2vendor = $_REQUEST['companyrecnum'];
   $status = $_REQUEST['status'];
   

                $newlogin = new userlogin;
				$newlogin->dbconnect();
  				$newspmaster->setcrnnum($crnnum);
		  		$newspmaster->setpartnum($partnum);
			   	$newspmaster->setaukpartnum($aukpartnum);
   				$newspmaster->setsaabpartnum($saabpartnum);
	  			$newspmaster->setcurrency($currency);
	    	   	$newspmaster->setprice($price);
	    	   	$newspmaster->setprice_valid_from($price_valid_from);
	    	   	$newspmaster->setprice_valid_upto($price_valid_upto);
	    	   	$newspmaster->setqty($qty);
	    	   	$newspmaster->setqty_valid_from($qty_valid_from);
    	   		$newspmaster->setqty_valid_upto($qty_valid_upto);
    	   		$newspmaster->settotalcost($totalcost);
    	   		$newspmaster->settotalcost_valid_from($totalcost_valid_from);
    	   		$newspmaster->settotalcost_valid_upto($totalcost_valid_upto);
    	   		$newspmaster->setlink2vendor($link2vendor);
    	   		$newspmaster->setstatus($status);

	    	   	$sql = "start transaction";
				$result = mysql_query($sql);
				$spmrecnum = $newspmaster->addSPmaster();
				$sql = "commit";
			    $result = mysql_query($sql);
			    if(!$result)
                  {
                        $sql = "rollback";
				        $result = mysql_query($sql);
				        die("Commit failed price Insert..Please report to Sysadmin. " . mysql_errno());
	              }
	              header("Location:spmastersummary.php" );

}
if ($pagename == 'spmasteredit') {
   $recnum = $_REQUEST['recnum'];
   $crnnum = $_REQUEST['crnnum'];
   $partnum = $_REQUEST['partnum'];
   $aukpartnum = $_REQUEST['aukpartnum'];
   $saabpartnum = $_REQUEST['saabpartnum'];
   $currency = $_REQUEST['currency'];
   $price = $_REQUEST['price'];
   $price_valid_from = $_REQUEST['price_valid_from'];
   $price_valid_upto = $_REQUEST['price_valid_upto'];
   $qty = $_REQUEST['qty'];
   $qty_valid_from = $_REQUEST['qty_valid_from'];
   $qty_valid_upto = $_REQUEST['qty_valid_upto'];
   $totalcost = $_REQUEST['totalcost'];
   $totalcost_valid_from = $_REQUEST['totalcost_valid_from'];
   $totalcost_valid_upto = $_REQUEST['totalcost_valid_upto'];
   $link2vendor = $_REQUEST['companyrecnum'];
   $status = $_REQUEST['status'];
   $create_date=$_REQUEST['create_date'];

                $newlogin = new userlogin;
				$newlogin->dbconnect();
                $newspmaster->setcrnnum($crnnum);
		  		$newspmaster->setpartnum($partnum);
			   	$newspmaster->setaukpartnum($aukpartnum);
   				$newspmaster->setsaabpartnum($saabpartnum);
	  			$newspmaster->setcurrency($currency);
	    	   	$newspmaster->setprice($price);
	    	   	$newspmaster->setprice_valid_from($price_valid_from);
	    	   	$newspmaster->setprice_valid_upto($price_valid_upto);
	    	   	$newspmaster->setqty($qty);
	    	   	$newspmaster->setqty_valid_from($qty_valid_from);
    	   		$newspmaster->setqty_valid_upto($qty_valid_upto);
    	   		$newspmaster->settotalcost($totalcost);
    	   		$newspmaster->settotalcost_valid_from($totalcost_valid_from);
    	   		$newspmaster->settotalcost_valid_upto($totalcost_valid_upto);
    	   		$newspmaster->setlink2vendor($link2vendor);
    	   		$newspmaster->setstatus($status);
    	   		$newspmaster->setcreate_date($create_date);

	    	   	$sql = "start transaction";
				$result = mysql_query($sql);
                $newspmaster->updatespmaster($recnum);
				$sql = "commit";
			    $result = mysql_query($sql);
			    if(!$result)
                  {
                        $sql = "rollback";
				        $result = mysql_query($sql);
				        die("Commit failed invoice Insert..Please report to Sysadmin. " . mysql_errno());
	              }
	              header("Location:spmastersummary.php" );

}


?>
