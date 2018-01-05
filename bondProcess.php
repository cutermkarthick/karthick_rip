<?php
//==============================================
// Author: FSI                                 =
// Date-written = May 6, 2012                  =
// Filename: bondProcess.php                   =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OWT                          =
// Processing of Bond page                     =
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


 $currbondnum = $_REQUEST['bond_num'];
 $prevbondnum = $_REQUEST['prevbondnum'];
 $bonddate=$_REQUEST['bonddate'];
 $status=$_REQUEST['status'];
 //echo $status."-----";
 
                $newlogin = new userlogin;
				$newlogin->dbconnect();
  				$newconsumption->setprevbondnum($prevbondnum);
		  		$newconsumption->setbond_num($currbondnum);
                $newconsumption->setstatus($status);
                $newconsumption->setbonddate($bonddate);

     			$result = mysql_query($sql);
				$newconsumption->upd4bond();
			    $result = mysql_query($sql);
                header("Location:consumptionReport.php" );

