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
$action = $_REQUEST['action'];

include_once('classes/loginClass.php');
include('classes/nc4storesClass.php');


// Next, create an instance of the classes required

//$newQGen= new genericQuote;
$newnc4stores = new nc4stores;


// Get all fields related to quote general info

$userid = $_SESSION['user'];

$refnum=$_REQUEST['refnum'];
$cdate=$_REQUEST['cdate'];
$supplier=$_REQUEST['supplier'];
$rm_po_num=$_REQUEST['rm_po_num'];
$receipt_date=$_REQUEST['receipt_date'];
$invoice_num=$_REQUEST['invoice_num'];
$bol_num=$_REQUEST['bol_num'];
$cofcnum=$_REQUEST['cofcnum'];
$dim_deviation=$_REQUEST['dim_deviation'];


$mat_deviation=$_REQUEST['mat_deviation'];
$descrepancy_quantity=$_REQUEST['descrepancy_quantity'];
$raw_material_docs=$_REQUEST['raw_material_docs'];
$specific_marking=$_REQUEST['specific_marking'];
$other_deviation=$_REQUEST['other_deviation'];

$description=$_REQUEST['description'];
$root_cause=$_REQUEST['root_cause'];
$corrective_action=$_REQUEST['corrective_action'];
$preventive_action=$_REQUEST['preventive_action'];
$nc_created_by=$_REQUEST['nc_created_by'];
$nc_supplied_by=$_REQUEST['nc_supplied_by'];
$due_date=$_REQUEST['due_date'];
$effectiveness=$_REQUEST['effectiveness'];


$newlogin = new userlogin;
$newlogin->dbconnect();


if ($pagename == 'new_nc4stores' )
{
  $newlogin = new userlogin;
  $newlogin->dbconnect();

  $newnc4stores->setrefnum($refnum);
  $newnc4stores->setcdate($cdate);
  $newnc4stores->setsupplier($supplier);
  $newnc4stores->setrm_po_num($rm_po_num);
  $newnc4stores->setreceipt_date($receipt_date); 
  $newnc4stores->setinvoice_num($invoice_num); 
  $newnc4stores->setbol_num($bol_num);
  $newnc4stores->setcofcnum($cofcnum);
  $newnc4stores->setdim_deviation($dim_deviation);
  $newnc4stores->setmat_deviation($mat_deviation);
  $newnc4stores->setdescrepancy_quantity($descrepancy_quantity);
  $newnc4stores->setraw_material_docs($raw_material_docs);
  $newnc4stores->setspecific_marking($specific_marking);
  $newnc4stores->setother_deviation($other_deviation);  

  $newnc4stores->setdescription($description);
  $newnc4stores->setroot_cause($root_cause);
  $newnc4stores->setcorrective_action($corrective_action);
  $newnc4stores->setpreventive_action($preventive_action);
  $newnc4stores->setnc_created_by($nc_created_by);
  $newnc4stores->setnc_supplied_by($nc_supplied_by);
  $newnc4stores->setdue_date($due_date);
  $newnc4stores->seteffectiveness($effectiveness);

 

  $sql = "start transaction";
  $result = mysql_query($sql);
  $final_insprecnum = $newnc4stores->addnc4stores();
}

else if($pagename == 'edit_nc4stores')
{ 
    $recnum = $_REQUEST['recnum'];	
    $newlogin = new userlogin;
    $newlogin->dbconnect();

  $newnc4stores->setrefnum($refnum);
  $newnc4stores->setcdate($cdate);
  $newnc4stores->setsupplier($supplier);
  $newnc4stores->setrm_po_num($rm_po_num);
  $newnc4stores->setreceipt_date($receipt_date); 
  $newnc4stores->setinvoice_num($invoice_num); 
  $newnc4stores->setbol_num($bol_num);
  $newnc4stores->setcofcnum($cofcnum);
  $newnc4stores->setdim_deviation($dim_deviation);
  $newnc4stores->setmat_deviation($mat_deviation);
  $newnc4stores->setdescrepancy_quantity($descrepancy_quantity); 

  $newnc4stores->setraw_material_docs($raw_material_docs);
  $newnc4stores->setspecific_marking($specific_marking);
  $newnc4stores->setother_deviation($other_deviation);  

  $newnc4stores->setdescription($description);
  $newnc4stores->setroot_cause($root_cause);
  $newnc4stores->setcorrective_action($corrective_action);
  $newnc4stores->setpreventive_action($preventive_action);
  $newnc4stores->setnc_created_by($nc_created_by);
  $newnc4stores->setnc_supplied_by($nc_supplied_by);
  $newnc4stores->setdue_date($due_date);
  $newnc4stores->seteffectiveness($effectiveness);

  $result=$newnc4stores->updatenc4stores($recnum);

}
header ( "Location: nc4stores_summary.php" );
?>
