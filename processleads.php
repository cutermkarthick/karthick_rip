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

$pagename= $_SESSION['pagename'];
// First include the class definition

include('classes/leadsClass.php');
// Get all fields related to leads general info

// Next, create an instance of the class

//$leadsrecnum =$_REQUEST['leadsrecnum'] ;
$userid = $_SESSION['user'];

$newlead= new leads;
$source = $_REQUEST['source'];
$leadsnum = $_REQUEST['leadsnum'];
$oppnum = $_REQUEST['oppnum'];
$name = $_REQUEST['name'];
$phone = $_REQUEST['phone'];
$title = $_REQUEST['title'];
$email = $_REQUEST['email'];
$company = $_REQUEST['company'];
$industry_segment = $_REQUEST['industry_segment'];
$product_interest = $_REQUEST['product_interest'];
$primary_lead = $_REQUEST['primary_lead'];
$addr1 = $_REQUEST['addr1'];
$addr2 = $_REQUEST['addr2'];
$city = $_REQUEST['city'];
$state = $_REQUEST['state'];
$zip = $_REQUEST['zip'];
$country = $_REQUEST['country'];
$convert2contact = $_REQUEST['convert2contact'];
$notes = $_REQUEST['spec_instrns'];
$stage = $_REQUEST['stage'];
$percent = $_REQUEST['percent'];
$stagenum=$_REQUEST['stagenum'];
$contacted_date=$_REQUEST['contacted_date'];
$meeting_date=$_REQUEST['meeting_date'];
if($stagenum >20 && $stagenum <60)
{
  $contacted_date=$contacted_date;
}
elseif($stagenum==20)
{
  $contacted_date=date('Y-m-d');
}

if($stagenum>60 && $stagenum <90)
{
  $meeting_date=$meeting_date;
}
elseif($stagenum==60)
{
  $meeting_date=date('Y-m-d');
}

//echo "Iam primary_lead   " . $primary_lead;
/// Database Connect
$newlogin = new userlogin;
$newlogin->dbconnect();

$newlead->setsource($source);
$newlead->setleadsnum($leadsnum);
$newlead->setoppnum($oppnum);
$newlead->setname($name);
$newlead->settitle($title);
$newlead->setphone($phone);
$newlead->setemail($email);
$newlead->setcompany($company);
$newlead->setindustry_segment($industry_segment);
$newlead->setproduct_interest($product_interest);
$newlead->setprimary_lead($primary_lead);
$newlead->setaddr1($addr1);
$newlead->setaddr2($addr2);
$newlead->setcity($city);
$newlead->setstate($state);
$newlead->setzip($zip);
$newlead->setcountry($country);
$newlead->setconvert2contact($convert2contact);
$newlead->setstage($stage);
$newlead->setpercent($percent);
$newlead->setstagenum($stagenum);
  $newlead->setcontacteddate($contacted_date);
  $newlead->setmeetingdate($meeting_date);

//$result = $newlead->getLead($leadsrecnum);
//$myrow = mysql_fetch_row($result);

 // if ($pagename == 'editleads')
 // {
 //    $delete = $_REQUEST['deleteflag'];
 //    if ($delete == 'y')
 //      {
 //       $leadsrecnum = $_REQUEST['leadsrecnum'];
 //      $newlead->deleteLead($leadsrecnum);
 //       header("Location:leadssummary.php" );
 //     }
 // }


if ($pagename== 'newleads') {
//echo "I am here";
   $sql = "start transaction";
   $result = mysql_query($sql);
   $leadsrecnum =  $newlead->addleads();
   $newlead->addNotes($leadsrecnum,$notes);
   $sql = "commit";
   $result = mysql_query($sql);
   if(!$result) die("Commit failed for New Service Request.Please report to Sysadmin. " . mysql_error());
}
if ($pagename== 'editleads') {
   $leadsrecnum = $_REQUEST['leadsrecnum'];


   $sql = "start transaction";
   $result = mysql_query($sql);
   $leadsrecnum = $newlead->updateLeads($leadsrecnum);
   $sql = "commit";
   $result = mysql_query($sql);
   if(!$result) die("Commit failed for Service Request update..Please report to Sysadmin. " . mysql_error());
}
if($pagename== 'editleads' && $stage=='Convert to Opportunity')
{
  $leadsrecnum = $_REQUEST['leadsrecnum'];
  //echo $leadsrecnum; exit;
      header("Location:new_opportunity.php?source=$source&name=$name&account=$company&leadrecnum=$leadsrecnum");
}
else
header("Location:leadssummary.php");

?>