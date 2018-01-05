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

include('classes/appendixcClass.php');

// Next, create an instance of the classes required
$newappendixc = new appendixc;

if ($pagename == 'appendixcentry') {
   $expinvnum = $_REQUEST['expinvnum'];
   $totnumpkgs = $_REQUEST['totnumpkgs'];
   $link2customer = $_REQUEST['companyrecnum'];
   $create_date=date('Y-m-d');
                $newlogin = new userlogin;
				$newlogin->dbconnect();
  				$newappendixc->setexpinvnum($expinvnum);
		  		$newappendixc->settotnumpkgs($totnumpkgs);
      	   		$newappendixc->setlink2customer($link2customer);
   			    $newappendixc->setcreate_date($create_date);

	    	   	$sql = "start transaction";
				$result = mysql_query($sql);
				$apprecnum = $newappendixc->addAppendixc();
				$sql = "commit";
			    $result = mysql_query($sql);
			    if(!$result)
                  {
                        $sql = "rollback";
				        $result = mysql_query($sql);
				        die("Commit failed Appendixc Insert..Please report to Sysadmin. " . mysql_errno());
	              }
	              header("Location:appendixcSummary.php" );

}
if ($pagename == 'appendixcedit') {
    $expinvnum = $_REQUEST['expinvnum'];
   $totnumpkgs = $_REQUEST['totnumpkgs'];
   $link2customer = $_REQUEST['companyrecnum'];
   $appendixcrecnum= $_REQUEST['appendixcrecnum'];
    $create_date= $_REQUEST['create_date'];
   
                $newlogin = new userlogin;
				$newlogin->dbconnect();
  				$newappendixc->setexpinvnum($expinvnum);
		  		$newappendixc->settotnumpkgs($totnumpkgs);
      	   		$newappendixc->setlink2customer($link2customer);
      	   		$newappendixc->setcreate_date($create_date);
                 //echo $appendixcrecnum;
	    	   	$sql = "start transaction";
				$result = mysql_query($sql);
                $newappendixc->updateAppendixc($appendixcrecnum);
				$sql = "commit";
			    $result = mysql_query($sql);
			    if(!$result)
                  {
                        $sql = "rollback";
				        $result = mysql_query($sql);
				        die("Commit failed Appendixc Update..Please report to Sysadmin. " . mysql_errno());
	              }
	              header("Location:appendixcSummary.php" );

}


?>
