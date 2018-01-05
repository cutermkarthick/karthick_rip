<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = June 20, 2004                =
// Filename: processuCompany.php               =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OMS                          =
// Processes Companies for user                =
//==============================================

session_start();
header("Cache-control: private"); 

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );
    
}
$userid = $_SESSION['user'];
$userrecnum = $_SESSION['userrecnum'];

$pagename= $_SESSION['pagename'];

// First include the class definition 
include('classes/companyClass.php'); 

// Get all fields related to work order general info

// Next, create an instance of the class 
$newCompany = new Company; 

$cname = $_REQUEST['cname'];
$cid = $_REQUEST['cid'];
$type = $_REQUEST['typeval'];  
$phone = $_REQUEST['phone'];  
$fax = $_REQUEST['fax'];  
$guid = $_REQUEST['guid'];
$address1 = $_REQUEST['address1'];
$address2 = $_REQUEST['address2'];
$city = $_REQUEST['city'];
$state = $_REQUEST['state'];
$zip = $_REQUEST['zip'];
$country = $_REQUEST['country'];

// Billing address
$baddress1 = $_REQUEST['baddress1'];
$baddress2 = $_REQUEST['baddress2'];
$bcity = $_REQUEST['bcity'];
$bstate = $_REQUEST['bstate'];
$bzip = $_REQUEST['bzip'];
$bcountry = $_REQUEST['bcountry'];

// Shipping address
$saddress1 = $_REQUEST['saddress1'];
$saddress2 = $_REQUEST['saddress2'];
$scity = $_REQUEST['scity'];
$sstate = $_REQUEST['sstate'];
$szip = $_REQUEST['szip'];
$scountry = $_REQUEST['scountry'];


// Database Connect
$newlogin = new userlogin;
$newlogin->dbconnect();
// Set the fields
$newCompany->setname($cname);
$newCompany->setid($cid);
$newCompany->settype($type);
$newCompany->setphone($phone);
$newCompany->setfax($fax);
$newCompany->setguid($guid);
$newCompany->setaddress1($address1);
$newCompany->setaddress2($address2);
$newCompany->setcity($city);
$newCompany->setstate($state);
$newCompany->setzip($zip);
$newCompany->setcountry($country);
// Billing Address
$newCompany->setbaddress1($baddress1);
$newCompany->setbaddress2($baddress2);
$newCompany->setbcity($bcity);
$newCompany->setbstate($bstate);
$newCompany->setbzip($bzip);
$newCompany->setbcountry($bcountry);
// Shipping Address
$newCompany->setsaddress1($saddress1);
$newCompany->setsaddress2($saddress2);
$newCompany->setscity($scity);
$newCompany->setsstate($sstate);
$newCompany->setszip($szip);
$newCompany->setscountry($scountry);

if ($pagename == 'newcompany') {
   $sql = "start transaction";
   $result = mysql_query($sql);
   $newCompany->addCompany();
   $sql = "commit";
   $result = mysql_query($sql);
   if(!$result) die("Commit failed for New Company..Please report to Sysadmin. " . mysql_error()); 
}
if ($pagename == 'editcompany') {
   $sql = "start transaction";
   $result = mysql_query($sql);
   $newCompany->updateCompany($cid);
   $sql = "commit";
   $result = mysql_query($sql);
   if(!$result) die("Commit failed for Company update..Please report to Sysadmin. " . mysql_error()); 
}
header("Location:ucompany.php");
?>
