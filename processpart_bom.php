<?php
//
//==============================================
// Author: FSI                                 =
// Date-written =July 5, 2005                  =
// Filename: processQuoteGeneric.php           =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 WMS                          =
//==============================================

session_start();
header("Cache-control: private");

$pagename = $_SESSION['pagename'];

include_once('classes/loginClass.php');
include('classes/part_bomclass.php');

// Next, create an instance of the classes required

//$newQGen= new genericQuote;
$newPB = new part_bom;

// Get all fields related to quote general info

$userid = $_SESSION['user'];

$partnum=$_REQUEST['partnum'];
$part_unit=$_REQUEST['part_unit'];
$rm_spec=$_REQUEST['rm_spec'];
$rm_units=$_REQUEST['rm_units'];
$req_rm_qty=$_REQUEST['req_rm_qty'];


// Database Connect
$newlogin = new userlogin;
$newlogin->dbconnect();

if ($pagename == 'new_bom' )
{

  $newlogin = new userlogin;
  $newlogin->dbconnect();
  $newPB->setpartnum($partnum);
  $newPB->setpart_unit($part_unit);
  $newPB->setrm_spec($rm_spec);
  $newPB->setreq_rm_qty($rm_units);
  $newPB->setrm_units($req_rm_qty);

  $sql = "start transaction";
  $result = mysql_query($sql);
  $part_bomrecnum = $newPB->addpart_bom();
}
else
{
    $part_bomrecnum = $_REQUEST['part_bomrecnum'];
    $newlogin = new userlogin;
    $newlogin->dbconnect();
    $newPB->setpartnum($partnum);
    $newPB->setpart_unit($part_unit);
    $newPB->setrm_spec($rm_spec);
    $newPB->setreq_rm_qty($rm_units);
    $newPB->setrm_units($req_rm_qty);

    $sql = "start transaction";
    $result = mysql_query($sql);
    $newPB->updatepart_bom($part_bomrecnum);
}

    header ( "Location: bom_summary.php" );

?>
