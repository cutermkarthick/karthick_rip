<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = September 20, 2006           =
// Filename: processemail.php                  =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OWT                          =
// Processes email                             =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];

$pagename= $_SESSION['pagename'];
// First include the class definition

include('classes/emailClass.php');
// Get all fields related to email general info

// Next, create an instance of the class

//$emailrecnum =$_REQUEST['emailrecnum'] ;
$userid = $_SESSION['user'];
$newemail= new email;

if ($_SESSION['pagename'] = 'mailDetails')
 {
    $delete = $_REQUEST['deleteflag'];
    if ($delete == 'y')
      {
       $emailrecnum =$_REQUEST['emailrecnum'] ;
       $newemail->deleteEmail($emailrecnum);
       header("Location:emailsummary.php" );
     }
 }

$to_addrs  = $_REQUEST['to_addrs'];
$cc_addrs = $_REQUEST['cc_addrs'];
$bcc_addrs = $_REQUEST['bcc_addrs'];
$from_addr = $_REQUEST['from_addr'];
$body = $_REQUEST['body'];
$subject = $_REQUEST['subject'];

/// Database Connect
$newlogin = new userlogin;
$newlogin->dbconnect();

$newemail->setto_addrs($to_addrs);
$newemail->setcc_addrs($cc_addrs);
$newemail->setbcc_addrs($bcc_addrs);
$newemail->setfrom_addr($from_addr);
$newemail->setsubject($subject);
$newemail->setbody($body);
$newemail->setuserid($userid);

//$result = $newemail->getemail($emailrecnum);
//$myrow = mysql_fetch_row($result);



if ($pagename== 'newemail') {
//echo "I am here new";
   $sql = "start transaction";
   $result = mysql_query($sql);
   $emailrecnum =  $newemail->addmails();
   $sql = "commit";
   $result = mysql_query($sql);
   if(!$result) die("Commit failed for New Service Request.Please report to Sysadmin. " . mysql_error());
}

   //sendig mails

    $to ="$to_addrs" ;
    $from = "$from_addr";
    $subject = "$subject";
    $message = "$body";

    $headers  = "From: $from\r\n";

    $success = mail($to, $subject, $message, $headers);
    if ($success)
        echo "The email to $to from $from was successfully sent";
    else
        echo "An error occurred when sending the email to $to from $from";
       header("Location:emailsummary.php");
?>