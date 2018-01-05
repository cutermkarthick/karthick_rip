<?php
//ini_set("session.save_handler",files);
session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}

$typenum = $_REQUEST['typenum'];
$wotype = $_REQUEST['wotype'];
$worecnum = $_REQUEST['worecnum'];
//$wonum = $_REQUEST['wonum'];

$userrole = $_SESSION['userrole'];
$userid = $_SESSION['user'];
$usertype = $_SESSION['usertype'];
$_SESSION['pagename'] = 'worder_det';
//////session_register('pagename');

   if ($usertype == 'EMPL') {
        header("Location:woDetails.php?typenum=$typenum&worecnum=$worecnum&wotype=$wotype");
   }
   else if ($usertype == 'CUST') {
       header("Location:woDetails.php?typenum=$typenum&worecnum=$worecnum&wotype=$wotype");
   }

   else
   {
       header("Location:login.php");
   }
?>



