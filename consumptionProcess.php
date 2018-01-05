<?php
//==============================================
// Author: FSI                                 =
// Date-written = April 23, 2012                =
// Filename: consumptionProcess.php           =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OWT                          =
// Processing of consumption                   =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];

$pagename = $_SESSION['pagename'];

include('classes/consumptionClass.php');

// Next, create an instance of the classes required
$newconsumption = new consumption;


 $crnnum = $_REQUEST['crnnum'];
 $grnnum = $_REQUEST['grnnum'];
 $grndate=$_REQUEST['grndate'];
 $description=$_REQUEST['descr'];
 $qtyrecd=$_REQUEST['qtyrecd'];
 $qtyused=$_REQUEST['qtyused'];
 $closingbal=$_REQUEST['closebal'];
 $create_date=$_REQUEST['create_date'];
 $invnum =$_REQUEST['invnum'];
 $bond_num=$_REQUEST['bond_num'];
 $be_num =$_REQUEST['be_num'];
 $invdate =$_REQUEST['invdate'];
 $cofcnum =$_REQUEST['cofcnum'];
 $company =$_REQUEST['company'];
 $rmtype =$_REQUEST['rmtype'];
 $uom =$_REQUEST['uom'];
 $invamt =$_REQUEST['invamt'];
 $recnum =$_REQUEST['recnum'];
 $qty =$_REQUEST['qty'];
 $currency =$_REQUEST['currency'];
 $qty_rej =$_REQUEST['qty_rej'];
// $status =$_REQUEST['status'];
// $inv_assessval =$_REQUEST['inv_assessval'];
// $inv_dutyamt =$_REQUEST['inv_dutyamt'];
 
                $newlogin = new userlogin;
				$newlogin->dbconnect();
  				$newconsumption->setcrnnum($crnnum);
		  		$newconsumption->setgrnnum($grnnum);
			   	$newconsumption->setinvnum($invnum);
	    	   	$newconsumption->setclosingbal($closingbal);
	    	   	$newconsumption->setcreate_date($create_date);
	    	   	$newconsumption->setqtyused($qtyused);
	    	   	$newconsumption->setqtyrecd($qtyrecd);
    	   		$newconsumption->setdescription($description);
           		$newconsumption->setgrndate($grndate);
           		$newconsumption->setbond_num($bond_num);
           		$newconsumption->setbe_num($be_num);
           		$newconsumption->setinvdate($invdate);
           		$newconsumption->setcofcnum($cofcnum);
           		$newconsumption->setcompany($company);
           		$newconsumption->setrmtype($rmtype);
           		$newconsumption->setuom($uom);
                $newconsumption->setinvamt($invamt);
                $newconsumption->setqty($qty);
                $newconsumption->setcurrency($currency);
                $newconsumption->setqty_rej($qty_rej);
                //$newconsumption->setstatus($status);
                //$newconsumption->setinv_assessval($inv_assessval);
                //$newconsumption->setinv_dutyamt($inv_dutyamt);
                
	    	   	$sql = "start transaction";
				$result = mysql_query($sql);
				$spmrecnum = $newconsumption->addconsumption($recnum);
				$sql = "commit";
			    $result = mysql_query($sql);
			    if(!$result)
                  {
                        $sql = "rollback";
				        $result = mysql_query($sql);
				        die("Commit failed price Insert..Please report to Sysadmin. " . mysql_errno());
	              }
	              header("Location:consumptionReport.php" );

