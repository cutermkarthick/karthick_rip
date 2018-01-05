<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = June 20, 2004                =
// Filename: processCOntact.php                =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OMS                          =
// Processes Contacts                          =
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
include('classes/contactClass.php');

// Next, create an instance of the class
$newContact = new contact;

$status = $_REQUEST['activeval'];
//$contactid = $_REQUEST['contactid'];
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


// Database Connect
$newlogin = new userlogin;
$newlogin->dbconnect();
// Set the fields
//$newContact->setcontactid($contactid);
$newContact->setfname($fname);
$newContact->setlname($lname);
$newContact->settitle($title);
$newContact->setstatus($status);
$newContact->setphone($phone);
$newContact->setemail($email);
$newContact->setrole($role);
$newContact->setsalutation($salutation);
$newContact->setaddress1($address1);
$newContact->setaddress2($address2);
$newContact->setcity($city);
$newContact->setstate($state);
$newContact->setzip($zipcode);
$newContact->setcountry($country);
$newContact->setcontact2company($companyrecnum);

if ($pagename == 'editcontact')
 {
    $delete = $_REQUEST['deleteflag'];
    if ($delete == 'y')
      {
      $contactid = $_REQUEST['contactid'];
      $newContact->deleteContact($contactid);
       header("Location:contacts.php" );
      }
  }

if ($pagename == 'newcontact' || $pagename == 'newucontact') {
   $sql = "start transaction";
   $result = mysql_query($sql);
   $newContact->addContact();
   $sql = "commit";
   $result = mysql_query($sql);
   if(!$result) die("Commit failed for New Contact..Please report to Sysadmin. " . mysql_error());
}

if ($pagename == 'editcontact' || $pagename == 'editucontact') {
   $sql = "start transaction";
   $result = mysql_query($sql);
   $contactid = $_REQUEST['contactid'];
   $newContact->updateContact($contactid);
   $sql = "commit";
   $result = mysql_query($sql);
   if(!$result) die("Commit failed for Contact update..Please report to Sysadmin. " . mysql_error());
}

header("Location:contacts.php");
?>