<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = June 20, 2004                =
// Filename: processCompany.php                =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OMS                          =
// Processes Companies                         =
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

$name = $_REQUEST['name'];
//$cid = $_REQUEST['cid'];
//$accountrecnum = $_REQUEST['accountrecnum'];
$type = $_REQUEST['type'];
$phone = $_REQUEST['phone'];
$fax = $_REQUEST['fax'];
$website = $_REQUEST['website'];
$tsymbol = $_REQUEST['tsymbol'];
$email = $_REQUEST['email'];
$employees = $_REQUEST['employees'];
$ownership = $_REQUEST['ownership'];
$rating = $_REQUEST['rating'];
$annual_revenue = $_REQUEST['annual_revenue'];
$industry = $_REQUEST['industry'];
$stccode = $_REQUEST['stccode'];
$status = $_REQUEST['status'];

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
$newCompany->setname($name);
//$newCompany->setid($cid);
$newCompany->settype($type);
$newCompany->setphone($phone);
$newCompany->setwebsite($website);
$newCompany->setfax($fax);
$newCompany->settsymbol($tsymbol);
$newCompany->setemail($email);
$newCompany->setemployees($employees);
$newCompany->setownership($ownership);
$newCompany->setannual_revenue($annual_revenue);
$newCompany->setindustry($industry);
$newCompany->setstccode($stccode);
$newCompany->setrating($rating);
 //Primary Address
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
$newCompany->setstatus($status);
if ($pagename == 'newcompany' || $pagename == 'newucompany') {
   $sql = "start transaction";
   $result = mysql_query($sql);
   $newCompany->addAccount();
   $sql = "commit";
   $result = mysql_query($sql);
   if(!$result) die("Commit failed for New Account..Please report to Sysadmin. " . mysql_error());
}
else if ($pagename == 'editcompany' || $pagename == 'editucompany') {
//echo "am inside edit";
   $sql = "start transaction";
   $result = mysql_query($sql);
   $accountrecnum=$_REQUEST['id'];
   $lat=$_REQUEST['lat'];
   $lon=$_REQUEST['lon'];
   $newCompany->setlatitude($lat);
   $newCompany->setlongitude($lon);
   $newCompany->updateAccount($accountrecnum) ;
   $sql = "commit";
   $result = mysql_query($sql);
   if(!$result) die("Commit failed for Account update..Please report to Sysadmin. " . mysql_error());
}
else if ($pagename == 'editcompany' || $pagename == 'editucompany') {
   $id = $_REQUEST['id'];
    $delete = $_REQUEST['deleteflag'];
    //echo "delete flag1 $delete";
   }
else if(($pagename == 'editcompany' || $pagename == 'editucompany') && $delete == 'y') {
  //echo "delete flag2 $delete";
   $newCompany->deleteAccount($id);
   }
header("Location:account.php");
?>
