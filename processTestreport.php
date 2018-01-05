<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = march 20, 2007               =
// Filename: processds.php                     =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OWT                          =
// Allows processing of data sheets            =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location:login.php" );

}
$userid = $_SESSION['user'];

$pagename = $_SESSION['pagename'];

include_once('classes/loginClass.php');
include('classes/testreportClass.php');
include('classes/chemicalcompliClass.php');
include('classes/mechpropertiesliClass.php');

// Next, create an instance of the classes required
$newTR = new testreport;
$newCCLI = new chemicalcomp;
$newMPLI = new mechproperties;

// request the data

$refno = $_REQUEST['refno'];
$partno = $_REQUEST['partno'];
$customer = $_REQUEST['customer'];
$partname = $_REQUEST['partname'];
$cust_standard = $_REQUEST['cust_standard'];
$rm_inv_no = $_REQUEST['rm_inv_no'];
$material_type = $_REQUEST['material_type'];
$inv_date =  $_REQUEST['inv_date'];
$material_spec = $_REQUEST['material_spec'];
$rm_receipt_date = $_REQUEST['rm_receipt_date'];
$rm_supplier = $_REQUEST['rm_supplier'];

 $newlogin = new userlogin;
   $newlogin->dbconnect();

   $newTR->setrefno($refno);
   $newTR->setpartno($partno);
   $newTR->setcustomer($customer);
   $newTR->setpartname($partname);
   $newTR->setcust_standard($cust_standard);
   $newTR->setrm_inv_no($rm_inv_no);
   $newTR->setmaterial_type($material_type);
   $newTR->setinv_date($inv_date);
   $newTR->setmaterial_spec($material_spec);
   $newTR->setrm_receipt_date($rm_receipt_date);
   $newTR->setrm_supplier($rm_supplier);


if ($pagename == 'new_testreport') {
   $ccmax = $_REQUEST["index"];
   $mpmax = $_REQUEST["mpindex"];
   
   $i=1;
   $j=1;
   
   $sql = "start transaction";
   $result = mysql_query($sql);
   $trrecnum = $newTR->addTestreport();
   $sql = "commit";
   $result = mysql_query($sql);
   if(!$result) die("Commit failed for New testreport..Please report to Sysadmin. " . mysql_error());


   while($i<$ccmax)
  {
    $lineno="cc_lineno" . $i;
    $constituents="cc_constituents" . $i;
	$standard_min="cc_standard_min" . $i;
	$standard_max="cc_standard_max" . $i;
    $supplier_min="cc_supplier_min" . $i;
	$supplier_max="cc_supplier_max" . $i;
	$report_lab="cc_report_lab" . $i;
    $remarks="cc_remarks" . $i;

    
    $lineno1 = $_REQUEST[$lineno];
	$constituents1 = $_REQUEST[$constituents];
	$standard_min1 = $_REQUEST[$standard_min];
	$standard_max1 = $_REQUEST[$standard_max];
	$supplier_min1 = $_REQUEST[$supplier_min];
	$supplier_max1 = $_REQUEST[$supplier_max];
	$report_lab1 = $_REQUEST[$report_lab];
	$remarks1 = $_REQUEST[$remarks];


	if ($lineno1 != '')
	{
             $newCCLI->setlineno($lineno1);
             $newCCLI->setconstituents($constituents1);
			 $newCCLI->setstandard_min($standard_min1);
  			 $newCCLI->setstandard_max($standard_max1);
			 $newCCLI->setsupplier_min($supplier_min1);
			 $newCCLI->setsupplier_max($supplier_max1);
             $newCCLI->setreport_lab($report_lab1);
             $newCCLI->setremarks($remarks1);
             $newCCLI->setlink2testreport($trrecnum);
			 $newCCLI->addLI();
			 $sql = "commit";
			 $result = mysql_query($sql);
			 if(!$result)
			{
				 $sql = "rollback";
				 $result = mysql_query($sql);
				 die("Commit failed data Insert..Please report to Sysadmin. " . mysql_errno());
		    }
    }

    $i++;
  }
  
  
    while($j<$mpmax)
  {
  

    $lineno="mp_lineno" . $j;
    $constituents="mp_constituents" . $j;
	$standard_min="mp_standard_min" . $j;
	$standard_max="mp_standard_max" . $j;
    $supplier_min="mp_supplier_min" . $j;
	$supplier_max="mp_supplier_max" . $j;
	$report_lab="mp_report_lab" . $j;
    $remarks="mp_remarks" . $j;

    $lineno1 = $_REQUEST[$lineno];
	$constituents1 = $_REQUEST[$constituents];
	$standard_min1 = $_REQUEST[$standard_min];
	$standard_max1 = $_REQUEST[$standard_max];
	$supplier_min1 = $_REQUEST[$supplier_min];
	$supplier_max1 = $_REQUEST[$supplier_max];
	$report_lab1 = $_REQUEST[$report_lab];
	$remarks1 = $_REQUEST[$remarks];


	if ($lineno1 != '')
	{

             $newMPLI->setlineno($lineno1);
             $newMPLI->setconstituents($constituents1);
			 $newMPLI->setstandard_min($standard_min1);
  			 $newMPLI->setstandard_max($standard_max1);
			 $newMPLI->setsupplier_min($supplier_min1);
			 $newMPLI->setsupplier_max($supplier_max1);
             $newMPLI->setreport_lab($report_lab1);
             $newMPLI->setremarks($remarks1);
             $newMPLI->setlink2testreport($trrecnum);
			 $newMPLI->addLI4m();
			 $sql = "commit";
			 $result = mysql_query($sql);
			 if(!$result)
			{
				 $sql = "rollback";
				 $result = mysql_query($sql);
				 die("Commit failed data Insert..Please report to Sysadmin. " . mysql_errno());
		    }
    }

    $j++;
  }
  
  
}

if ($pagename == 'edit_testreport') {

   $ccmax = $_REQUEST['index'];
   $mpmax = $_REQUEST['mpindex'];
   
   $trrecnum = $_REQUEST['trrecnum'];
   $sql = "start transaction";
   $result = mysql_query($sql);
   $newTR->updatetestreport($trrecnum);
   $link2testreport = $_REQUEST['refno'];



   $i=1;
$flag=0;
while($i<$ccmax)
{
	//echo "i am inside while loop";

    $lineno="cc_lineno" . $i;
    $constituents="cc_constituents" . $i;
	$standard_min="cc_standard_min" . $i;
	$standard_max="cc_standard_max" . $i;
    $supplier_min="cc_supplier_min" . $i;
	$supplier_max="cc_supplier_max" . $i;
	$report_lab="cc_report_lab" . $i;
    $remarks="cc_remarks" . $i;
    $link2testreport="cc_link2testreport" . $i;

    $prevlinenum="cc_prevlineno" . $i;
	$lirecnum="cc_lirecnum" . $i;



    $prevlinenum1="";
        if ( isset ( $_REQUEST[$prevlinenum] ) )
         {
        	$prevlinenum1=$_REQUEST[$prevlinenum];
         }
    $lirecnum1="";
        if ( isset ( $_REQUEST[$lirecnum] ) )
        {
		    $lirecnum1= $_REQUEST[$lirecnum];
		}



    $lineno1= $_REQUEST[$lineno];
    $constituents1 = $_REQUEST[$constituents];
	$standard_min1 = $_REQUEST[$standard_min];
	$standard_max1 = $_REQUEST[$standard_max];
	$supplier_min1 = $_REQUEST[$supplier_min];
	$supplier_max1 = $_REQUEST[$supplier_max];
	$report_lab1 = $_REQUEST[$report_lab];
	$remarks1 = $_REQUEST[$remarks];


	$newlogin = new userlogin;
	$newlogin->dbconnect();

	if ($lineno1 != '')
	{
	         $newCCLI->setlineno($lineno1);
             $newCCLI->setconstituents($constituents1);
			 $newCCLI->setstandard_min($standard_min1);
  			 $newCCLI->setstandard_max($standard_max1);
			 $newCCLI->setsupplier_min($supplier_min1);
			 $newCCLI->setsupplier_max($supplier_max1);
             $newCCLI->setreport_lab($report_lab1);
             $newCCLI->setremarks($remarks1);
             $newCCLI->setlink2testreport($trrecnum);

			 if($prevlinenum1!='')
			{
			 	$newCCLI->updateLI($lirecnum1);
  	        }
			else
			{

        		$newCCLI->addLI();
			}
	}
	else
	{
		 if ($prevlinenum1 != '')
		 {
			//echo "i am here deleting";
			 $newCCLI->deleteLI($lirecnum1);
		  }
	}
	 $sql = "commit";
	 $result = mysql_query($sql);
	 if(!$result)
	{
		 $sql = "rollback";
		 $result = mysql_query($sql);
		 die("Commit failed cust data Insert..Please report to Sysadmin. " . mysql_errno());
	 }
$i++;
}

$j=1;
while($j<$mpmax)
{
	//echo "i am inside while loop";

    $lineno="mp_lineno" . $j;
    $constituents="mp_constituents" . $j;
	$standard_min="mp_standard_min" . $j;
	$standard_max="mp_standard_max" . $j;
    $supplier_min="mp_supplier_min" . $j;
	$supplier_max="mp_supplier_max" . $j;
	$report_lab="mp_report_lab" . $j;
    $remarks="mp_remarks" . $j;

    $prevlinenum="mp_prevlineno" . $j;
	$lirecnum="mp_lirecnum" . $j;



    $prevlinenum1="";
        if ( isset ( $_REQUEST[$prevlinenum] ) )
         {
        	$prevlinenum1=$_REQUEST[$prevlinenum];
         }
    $lirecnum1="";
        if ( isset ( $_REQUEST[$lirecnum] ) )
        {
		    $lirecnum1= $_REQUEST[$lirecnum];
		}



    $lineno1= $_REQUEST[$lineno];

    $constituents1 = $_REQUEST[$constituents];
	$standard_min1 = $_REQUEST[$standard_min];
	$standard_max1 = $_REQUEST[$standard_max];
	$supplier_min1 = $_REQUEST[$supplier_min];
	$supplier_max1 = $_REQUEST[$supplier_max];
	$report_lab1 = $_REQUEST[$report_lab];
	$remarks1 = $_REQUEST[$remarks];


	$newlogin = new userlogin;
	$newlogin->dbconnect();

	if ($lineno1 != '')
	{
             $newMPLI->setlineno($lineno1);
             $newMPLI->setconstituents($constituents1);
			 $newMPLI->setstandard_min($standard_min1);
  			 $newMPLI->setstandard_max($standard_max1);
			 $newMPLI->setsupplier_min($supplier_min1);
			 $newMPLI->setsupplier_max($supplier_max1);
             $newMPLI->setreport_lab($report_lab1);
             $newMPLI->setremarks($remarks1);
   	         $newMPLI->setlink2testreport($trrecnum);

			 if($prevlinenum1!='')
			{
			 	$newMPLI->updateLI($lirecnum1);
  	        }
			else
			{

        		$newMPLI->addLI4m();
			}
	}
	else
	{
		 if ($prevlinenum1 != '')
		 {
			//echo "i am here deleting";
			 $newMPLI->deleteLI($lirecnum1);
		  }
	}
	 $sql = "commit";
	 $result = mysql_query($sql);
	 if(!$result)
	{
		 $sql = "rollback";
		 $result = mysql_query($sql);
		 die("Commit failed mech properties update..Please report to Sysadmin. " . mysql_errno());
	 }
$j++;
}


}

// Update data

// Check if the delete flag is set
if ($_SESSION['pagename'] == 'poupdate') {
    $delete = $_REQUEST['deleteflag'];
}
if ($pagename == 'poupdate' && $delete == 'y') {
           $newPO->deletePO($porecnum);

}


else {
header("Location:testreport.php");
}
?>
