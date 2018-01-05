<?php
//==============================================
// Author: FSI                                 =
// Date-written = Mar 20, 2007                 =
// Filename: processEnquiry.php                =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OWT                          =
// Process of Contract Enquiry                 =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: ../login.php" );

}
$userid = $_SESSION['user'];

$pagename = $_SESSION['pagename'];

include('classes/custfeedbackClass.php');

// Next, create an instance of the classes required
$newcustomer = new feedback;
// Get all fields related to invoice
if ($pagename == 'newfeedback') 
{

    $name = $_REQUEST["name"];
    $fdate = $_REQUEST["fdate"];
    $tdate = $_REQUEST["tdate"];
    $last_date = $_REQUEST["last_date"];
    $crdate = $_REQUEST["crdate"];
    $max = $_REQUEST["index"];
    
    $newcustomer->setname($name);
    $newcustomer->setfdate($fdate);
    $newcustomer->settdate($tdate);
    $newcustomer->setlast_date($last_date);
    $newcustomer->setcrdate($crdate);

$customerrecnum = $newcustomer->addcust_feedback();
  
$i=1;
while($i<$max)
{
    $ranking = "ranking".$i;
    $remarks = "remarks".$i;
    $parameters = "parameters".$i;
    
    $ranking = $_REQUEST[$ranking];
    $remarks = $_REQUEST[$remarks];
    $parameters = $_REQUEST[$parameters];

	$newcustomer->setranking($ranking);
	$newcustomer->setremarks($remarks);
  $newcustomer->setparameters($parameters);
  if($ranking != '')
  {

    $newcustomer->addcust_feedback_li($customerrecnum);
  }
  $i++;

}

}


if ($pagename == 'editcustomer')
 {


    $customerrecnum = $_REQUEST["customerrecnum"];
    $name = $_REQUEST["name"];
    $parameters = $_REQUEST["parameters"];
    $ranking = $_REQUEST["ranking"];
    $remarks = $_REQUEST["remarks"];
    
    
    $newcustomer->setname($name);
    $newcustomer->setparameters($parameters);
    $newcustomer->setranking($ranking);
    $newcustomer->setremarks($remarks);

    
        $newcustomer->updatecustomer($customerrecnum);
}
        header("Location:custfeedbackSummary.php");

?>
