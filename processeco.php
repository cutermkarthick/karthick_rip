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
include('classes/ecoClass.php'); 
include('classes/supportClass.php'); 

// Get all fields related to work order general info

// Next, create an instance of the class 
$neweco = new eco; 
$newsupp = new support; 

$econum = $_REQUEST['econum'];
$doc_date = $_REQUEST['doc_date'];
$sch_date = $_REQUEST['sch_date'];  
$due_date = $_REQUEST['due_date'];  
//echo "$due_date";
$tester_type= $_REQUEST['tester_type'];  
$tester_model= $_REQUEST['tester_model'];  
if (isset($_REQUEST['omistake']))
 $omistake ="y";
else
 $omistake ="n";
if (isset($_REQUEST['cmistake']))
 $cmistake ="y";
else
 $cmistake ="n";
$gerber = $_REQUEST['greber'];
$layer = $_REQUEST['layer'];
$sheet = $_REQUEST['sheet'];
$schematic = $_REQUEST['schematic'];
$remake_board = $_REQUEST['remake_board'];
$createdate = '';
$footprint = $_REQUEST['footprint'];
$drawing=$_REQUEST['drawing'];
$error_desc=$_REQUEST['error_desc'];
$short_sol_desc=$_REQUEST['sht_sol_desc'];
$short_eng_app = $_REQUEST['sht_eng_app'];
$short_app_date=$_REQUEST['sht_app_date'];

$worecnum = $_REQUEST['worecnum'];  
$supp2customer = $_REQUEST['companyrecnum'];
$supp2contact = $_REQUEST['contactrecnum'];
$supp2employee = $_REQUEST['empnum'];
$supp2solution = $_REQUEST['solrecnum'];
if($supp2solution=='')
$supp2solution=0;
$long_sol_desc = $_REQUEST['lng_sol'];
$long_eng_app = $_REQUEST['lng_eng_app'];
$long_appr_date=$_REQUEST['lng_app_date'];

//echo "worecnum :$worecnum</br>";
/*

echo "econum :$econum</br>";
echo "doc_date :$doc_date</br>";
echo "$sch_date $sch_date</br>";
echo "tester_type :$tester_type</br>";
echo "omistake : $omistake</br>";
echo "cmistake :$cmistake</br>";
echo "gerber :$gerber</br>";
echo "layer :$layer</br>";
echo "sheet :$sheet</br>";
echo "schematic :$schematic</br>";
echo "remake_board  :$remake_board </br>";
echo "footprint :$footprint</br>";
echo "drawing :$drawing</br>";
echo "$error_desc :$error_desc</br>";
echo "short_sol_desc :$short_sol_desc</br>";
echo "short_eng_app :$short_eng_app</br>";
echo "short_app_date :$short_app_date</br>";
echo "long_sol_desc :$long_sol_desc</br>";
echo "lng_eng_ap :$long_eng_app</br>";
echo "lng_eng_date :$long_appr_date</br>";
*/
/// Database Connect
$newlogin = new userlogin;
$newlogin->dbconnect();
// Set the fields

$neweco->seteconum($econum);
$neweco->setdoc_date($doc_date);
$neweco->settester_type($tester_type);
$neweco->settester_model($tester_model);
$neweco->setsch_due_date ($sch_date );
$neweco->setact_complete_date ($due_date );
$neweco->setomistake($omistake);
$neweco->setcust_chg_req($cmistake);
$neweco->setgerber($gerber);
$neweco->setlayer($layer);
$neweco->setsheet($sheet);
$neweco->setschematic($schematic);
$neweco->setremake_board($remake_board);
$neweco->setfootprint($footprint);
$neweco->setdrawing($drawing);
$neweco->seterror_desc($error_desc);
$neweco->setshort_sol_desc($short_sol_desc);
$neweco->setshort_eng_app($short_eng_app);
$neweco->setshort_appr_date($short_app_date);
$neweco->setlong_sol_desc($long_sol_desc);
$neweco->setlong_eng_app($long_eng_app);
$neweco->setlong_appr_date($long_appr_date);
//echo "$pagename";

if ($pagename == 'neweco') {
   $sql = "start transaction";
   $result = mysql_query($sql);
   $supp2type=$neweco->addeco();
   $sql = "commit";
   $result = mysql_query($sql);
   if(!$result) die("Commit failed for New ECO.Please report to Sysadmin. " . mysql_error()); 
   $newsupp->settype('ECO');
   $newsupp->setstatus('Eco open');
   $newsupp->setcondition('progress');
   $newsupp->setsupp2type($supp2type);
   $newsupp->setsupp2wo($worecnum);
   $newsupp->setsupp2customer($supp2customer);
   $newsupp->setsupp2contact($supp2contact);
   $newsupp->setsupp2employee($supp2employee);
   $newsupp->setsupp2solution($supp2solution);

   $sql = "start transaction";
   $result = mysql_query($sql);
   $newsupp->addsupport();
   $sql = "commit";
   $result = mysql_query($sql);
   if(!$result) die("Commit failed for New Support.Please report to Sysadmin. " . mysql_error()); 
header("Location:supportsummary.php?recnum=$supp2type");
}
if ($pagename == 'updateeco') {
$ecorecnum = $_SESSION['recnum'];
   $sql = "start transaction";
   $result = mysql_query($sql);
   $neweco->updateeco($ecorecnum);
   $sql = "commit";
   $result = mysql_query($sql);
   if(!$result) die("Commit failed for ECO update..Please report to Sysadmin. " . mysql_error()); 
   $newsupp->settype('ECO');
   $newsupp->setstatus('Eco open');
   $newsupp->setcondition('progress');
   $newsupp->setsupp2type($ecorecnum );
   $newsupp->setsupp2wo($worecnum);
   $newsupp->setsupp2customer($supp2customer);
   $newsupp->setsupp2contact($supp2contact);
   $newsupp->setsupp2employee($supp2employee);
   $newsupp->setsupp2solution($supp2solution);
   $newsupp->updatesupport($ecorecnum,'ECO');
   $sql = "commit";
   $result = mysql_query($sql);
//echo "i am here";
   if(!$result) die("Commit failed for Update Support.Please report to Sysadmin. " . mysql_error()); 
header("Location:supportsummary.php?recnum=$ecorecnum");
}

?>
