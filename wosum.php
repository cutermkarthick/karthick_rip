<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = June 20, 2004                =
// Filename: boardwoEntry.php                  =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OMS                          =
// Allows Board WO entry.                      =
//==============================================

session_start();
header("Cache-control: private"); 

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );
    
}
$userid = $_SESSION['user'];
$role = $_SESSION['userrole'];
$usertype = $_SESSION['usertype'];
$_SESSION['pagename'] = 'wosum'; 
//////session_register('pagename');
if ($usertype == 'EMPL') {

   if ($role == 'DESG_B') {  
        header("Location:ruworderSummary.php" );
   }
   else if ($role == 'DESG_S') {  
        header("Location:sruworderSummary.php" );
   }
   else if ($role == 'SU') {
        header("Location:worderSummary.php");
   }
   else { header("Location: login.php");
   }
}
else if ($usertype == 'CUST') {

        header("Location:custworderSummary.php" );
}
else {
       header("Location: login.php");
}

?>




