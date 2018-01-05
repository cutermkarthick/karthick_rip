<?php
//==============================================
// Author: FSI                                 =
// Date-written = Mar 20, 2007                 =
// Filename: processQualityplan.php            =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OWT                          =
// Process of Quality Plan                     =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];

$pagename = $_SESSION['pagename'];

include('classes/custdataClass.php');
include('classes/custdataliClass.php');

// Next, create an instance of the classes required
$newcustdata = new custdata;
$newLI = new custdatali;


if ($pagename == 'editcustdata')
 {
    $delete = $_REQUEST['deleteflag'];
    if ($delete == 'y')
      {
       $custdatarecnum = $_REQUEST['custdatarecnum'];
       $newcustdata->deletecustdata($custdatarecnum);
       header("Location:custdatasummary.php");
      }
 }

// Get all fields related to invoice



   $partnum = $_REQUEST['partnum'];
   $cust_ref_num = $_REQUEST['cust_ref_num'];
   $partname = $_REQUEST['partname'];
   $cust_rev_num = $_REQUEST['cust_rev_num'];
   $sup_mod_format = $_REQUEST['sup_mod_format'];
   $translated_to = $_REQUEST['translated_to'];
   $note = $_REQUEST['note'];
   $approved_by = $_REQUEST['approved_by'];
   $prepared_by = $_REQUEST['prepared_by'];
   $Issue = $_REQUEST['Issue'];
   $Date = $_REQUEST['Date'];



   $newlogin = new userlogin;
   $newlogin->dbconnect();
   $newcustdata->setpartnum($partnum);
   $newcustdata->setcust_ref_num($cust_ref_num);
   $newcustdata->setpartname($partname);
   $newcustdata->setcust_rev_num($cust_rev_num);
   $newcustdata->setsup_mod_format($sup_mod_format);
   $newcustdata->settranslated_to($translated_to);
   $newcustdata->setnote($note);
   $newcustdata->setapproved_by($approved_by);
   $newcustdata->setprepared_by($prepared_by);
   $newcustdata->setIssue($Issue);
   $newcustdata->setDate($Date);






if ($pagename == 'newcustdata') {

    $max = $_REQUEST['index'];
	$sql = "start transaction";
	$result = mysql_query($sql);

	$custdatarecnum = $newcustdata->addcustdata();
    $sql = "commit";
   $result = mysql_query($sql);
   if(!$result) die("Commit failed for New data validation..Please report to Sysadmin. " . mysql_error());

$i=1;
$flag=0;
while($i<$max)
{

    $refnum="refnum" . $i;
	$px="px" . $i;
	$py="py" . $i;
	$pz="pz" . $i;
	$mx="mx" . $i;
	$my="my" . $i;
	$mz="mz" . $i;
	$remarks="remarks" . $i;

	$refnum1= $_REQUEST[$refnum];
	$px1 = $_REQUEST[$px];
	$py1 = $_REQUEST[$py];
	$pz1 = $_REQUEST[$pz];
	$mx1 = $_REQUEST[$mx];
	$my1 = $_REQUEST[$my];
	$mz1 = $_REQUEST[$mz];
	$remarks1 = $_REQUEST[$remarks];

	if ($refnum1 != '')
	{

			 $newLI->setrefnum($refnum1);
			 $newLI->setpx($px1);
			 $newLI->setpy($py1);
			 $newLI->setpz($pz1);
			 $newLI->setmx($mx1);
			 $newLI->setmy($my1);
			 $newLI->setmz($mz1);
			 $newLI->setremarks($remarks1);
			 $newLI->setlink2custdata($custdatarecnum);

			 $newLI->addcustdatali();
			 $sql = "commit";
			 $result = mysql_query($sql);
			 if(!$result)
			{
				 $sql = "rollback";
				 $result = mysql_query($sql);
				 die("Commit failed customer data insert..Please report to Sysadmin. " . mysql_errno());
			 }

	}
	$i++;
}
header("Location:custdatasummary.php" );
}


if ($pagename == 'editcustdata')
 {
//echo "i am inside editcustdata";
   $max = $_REQUEST['index'];
   $sql = "start transaction";
   $result = mysql_query($sql);
   $custdatarecnum = $_REQUEST['custdatarecnum'];
  // echo "custrecnum is $custdatarecnum\n";
   $newcustdata->updatecustdata($custdatarecnum);
   $link2qualityplan = $_REQUEST['custdatarecnum'];
  
$i=1;
//$flag=0;
while($i<$max)
{
	//echo "i am inside while loop";
	
	
	 $refnum="refnum" . $i;
	$px="px" . $i;
	$py="py" . $i;
	$pz="pz" . $i;
	$mx="mx" . $i;
	$my="my" . $i;
	$mz="mz" . $i;
	$remarks="remarks" . $i;
    $prevlinenum="prev_line_num" . $i;
	$lirecnum="lirecnum" . $i;



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

 

    $refnum1= $_REQUEST[$refnum];
	$px1 = $_REQUEST[$px];
	$py1 = $_REQUEST[$py];
	$pz1 = $_REQUEST[$pz];
	$mx1 = $_REQUEST[$mx];
	$my1 = $_REQUEST[$my];
	$mz1 = $_REQUEST[$mz];
	$remarks1 = $_REQUEST[$remarks];

	$newlogin = new userlogin;
	$newlogin->dbconnect();

	if ($refnum1 != '')
	{
             $newLI->setrefnum($refnum1);
			 $newLI->setpx($px1);
			 $newLI->setpy($py1);
			 $newLI->setpz($pz1);
			 $newLI->setmx($mx1);
			 $newLI->setmy($my1);
			 $newLI->setmz($mz1);
			 $newLI->setremarks($remarks1);
			 //$newLI->setlink2custdata($custdatarecnum);
			 if($prevlinenum1!='')
			{
			 	$newLI->updatecustdatali($lirecnum1);
			}
			else
			{
				$newLI->setlink2custdata($custdatarecnum);
        		$newLI->addcustdatali();
			}
	}
	else
	{
		 if ($prevlinenum1 != '')
		 {
			//echo "i am here deleting";
			 $newLI->deletecustdatali($lirecnum1);
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
}

header("Location:custdatasummary.php" );

?>
