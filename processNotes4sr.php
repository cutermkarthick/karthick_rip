<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = June 20, 2004                =
// Filename: processNotes.php                  =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OMS                          =
// Process Notes                               =
//==============================================

session_start();
header("Cache-control: private"); 

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );
    
}
//$userid = $_SESSION['user'];
//$typenum = $_REQUEST['typenum'];
//$type = $_REQUEST['type'];
$notes = $_REQUEST['spec_instrns'];
$srrecnum =$_REQUEST['srrecnum'];
if ( !isset ( $_REQUEST['srrecnum'] ) )
{
     header ( "Location: login.php" );
    
}
//$worecnum = $_REQUEST['worecnum'];
//$userrole = $_SESSION['userrole'];
//$usertype = $_SESSION['usertype'];

//echo "<br>typenum is " . $typenum;
//echo "<br>type is " . $type;
//echo "<br>userrole is " . $userrole;
//echo "<br>usertype is " . $usertype;
// First include the class definition 
include_once('classes/loginClass.php');
include('classes/srClass.php');

$newlogin = new userlogin;
$newlogin->dbconnect();
$newsr = new sr;
$newsr->addNotes($srrecnum,$notes);
//$type = 'Board';
//$usertype = 'EMPL';
//$userrole = 'SU';
/*if ($type == 'Board') {
   if ($usertype == 'EMPL') {
      if ($userrole == 'DESG_B') {  
        header("Location:ruboard.php?worecnum=$worecnum&typenum=$typenum");
      }
      else  if ($userrole == 'SU') {   
        header("Location:board.php?worecnum=$worecnum&typenum=$typenum");
      }
   }
   if ($usertype == 'CUST') {
       header("Location:custboard.php?worecnum=$worecnum&typenum=$typenum");
   }
}
else if ($type == 'Socket') {
   if ($usertype == 'EMPL') {
      if ($userrole == 'DESG_S') {  
        header("Location:rusocket.php?worecnum=$worecnum&typenum=$typenum");
      }
      else  if ($userrole == 'SU') {  
        header("Location:socket.php?worecnum=$worecnum&typenum=$typenum");
      }
   }
   if ($usertype == 'CUST') {
       header("Location:custsocket.php?worecnum=$worecnum&typenum=$typenum");
   }
}
else { header("Location:sr.php"); }*/
header("Location:sr.php?recnum=$srrecnum");
?>
