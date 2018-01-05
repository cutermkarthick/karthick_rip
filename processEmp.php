<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = June 20, 2004                =
// Filename: processEmp.php                    =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OMS                          =
// Processes Employees                         =
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
include('classes/empClass.php'); 

// Next, create an instance of the class 
$newEmp = new emp; 

$status = $_REQUEST['activeval'];
//echo "status: $status <br>";
//echo "status: $status <br>";
//$empid = $_REQUEST['empid'];
$fname = $_REQUEST['fname'];  
$lname = $_REQUEST['lname'];    
$companyrecnum = $_REQUEST['companyrecnum'];
$email = $_REQUEST['email'];  
$phone = $_REQUEST['phone'];  
$address1 = $_REQUEST['address1'];  
$address2 = $_REQUEST['address2'];   
$city = $_REQUEST['city'];  
$state = $_REQUEST['state'];    
$zipcode = $_REQUEST['zipcode'];  
$country = $_REQUEST['country'];   
$role = $_REQUEST['roleval'];  
$title = $_REQUEST['title'];   
$salutation = $_REQUEST['salval'];  
if ($pagename == 'editemp') {
    $delete = $_REQUEST['deleteflag'];
}

$department = $_REQUEST['department'];
$empcode = $_REQUEST['empcode'];

$emp_type = $_REQUEST['emp_type'];
$emp_expiry_date = $_REQUEST['emp_expiry_date'];
$secondary_company = $_REQUEST['custrecnum'];


// echo "<pre>";
// print_r($_REQUEST); exit;

// Database Connect
$newlogin = new userlogin;
$newlogin->dbconnect();
// Set the fields
//$newEmp->setempid($empid);
$newEmp->setfname($fname);
$newEmp->setlname($lname);
$newEmp->settitle($title);
$newEmp->setstatus($status);
$newEmp->setphone($phone);
$newEmp->setemail($email);
$newEmp->setrole($role);
$newEmp->setsalutation($salutation);
$newEmp->setaddress1($address1);
$newEmp->setaddress2($address2);
$newEmp->setcity($city);
$newEmp->setstate($state);
$newEmp->setzip($zipcode);
$newEmp->setcountry($country);
$newEmp->setemployee2company($companyrecnum);
$newEmp->setdepartment($department);
$newEmp->setempcode($empcode);

$newEmp->setemp_type($emp_type);
$newEmp->setemp_expiry_date($emp_expiry_date);
$newEmp->setsecondary_company($secondary_company);


if ($pagename == 'newemp') {
   $sql = "start transaction";
   $result = mysql_query($sql);
   $newEmp->addEmp();
   $sql = "commit";
   $result = mysql_query($sql);
   if(!$result) die("New Employee addition failed..Please report to Sysadmin. " . mysql_error()); 
}
if ($pagename == 'editemp' && $delete != 'y') {
   $sql = "start transaction";
   $result = mysql_query($sql);
   $empid = $_REQUEST['empid'];
   $shift_group = $_REQUEST['shift_group'];
   $subscription_type = $_REQUEST['subscription_type'];
   $newEmp->setempid($empid);
   $newEmp->setshift_group($shift_group);
   $newEmp->setsubscription_type($subscription_type);
   $newEmp->updateEmp($empid);
   $sql = "commit";
   $result = mysql_query($sql);
   if(!$result) die("Employee update failed..Please report to Sysadmin. " . mysql_error()); 
}
if ($pagename == 'editemp' && $delete == 'y') {
   $sql = "start transaction";
   $result = mysql_query($sql);
   $empid = $_REQUEST['empid'];
   $newEmp->deleteEmp($empid);
   $sql = "commit";
   $result = mysql_query($sql);
   if(!$result) die("Employee delete failed..Please report to Sysadmin. " . mysql_error()); 
}
header("Location:employees.php");
?>
