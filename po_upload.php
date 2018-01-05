<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = June 20, 2004                =
// Filename: po_upload.php                     =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OMS                          =
// Allows uploading of POs                     =
//==============================================

session_start();
header("Cache-control: private"); 

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );
    
}
$userid = $_SESSION['user'];

$pagename = $_SESSION['pagename'];

include('classes/poClass.php'); 

// Create an instance of the class 
$newPO = new po; 

$ponum = $_REQUEST['ponum'];

if ($pagename == 'newpo' || $pagename == 'poupdate') {
   $desc = $_REQUEST['desc'];
   $vendor = $_REQUEST['vendor'];
   $podate = $_REQUEST['po_date'];
   $duedate = $_REQUEST['due_date'];
   $poamount = $_REQUEST['poamount'];
// Set the PO fields
   $newPO->setponum($ponum);
   $newPO->setpodate($podate);
   $newPO->setdescr($desc);
   $newPO->setduedate($duedate);
   $newPO->setpoamount($poamount);
   $newPO->setvendor($vendor);
}

$delete="y";
if ($_SESSION['pagename'] == 'podetails') {
    $delete = $_REQUEST['deleteflag'];
}

$crdate = date("d-M-y");

// Insert data

if ($pagename == 'newpo') {
  $newlogin = new userlogin;
  $newlogin->dbconnect();
  $sql = "start transaction";
  $result = mysql_query($sql);
  $newPO->addPO();
  $sql = "commit";
  $result = mysql_query($sql);
  if(!$result) die("Commit failed for PO Insert..Please report to Sysadmin. " . mysql_error()); 
}

// Update data
if ($pagename == 'poupdate') {
  $ponum = $_SESSION['ponum'];
  $newlogin = new userlogin;
  $newlogin->dbconnect();
  $sql = "start transaction";
  $result = mysql_query($sql);
  $newPO->updatePO($ponum);
  $sql = "commit";
  $result = mysql_query($sql);
  if(!$result) die("Commit failed for PO Update..Please report to Sysadmin. " . mysql_error()); 
}
if ($pagename == 'podetails' && $delete == 'y') { 
           $newPO->deletePO($ponum);

}
header("Location:po.php" );
?> 
