<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = march 20, 2007               =
// Filename: processMaster.php                 =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OWT                          =
// Allows processing of master sheets          =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];

$pagename = $_SESSION['pagename'];

include('classes/masterclass.php');
include('classes/masterliClass.php');

// Next, create an instance of the classes required
$newMA = new master;
$newLI = new master_line_items;

 $attachments ='';
$check=$_FILES['attachments']['name'] ;
if ($check != '' )
{
	 $attachments = $userid . '_' . $_FILES['attachments']['name'];
	 $attachments = preg_replace('/\s+/',' ',$attachments);
  	 $attachments = preg_replace('/\s/','_',$attachments);
	//echo "$excelfile<br>";
	 $attachments = strtolower($attachments);
}
else
{
//echo "i am here else";
  //  $attachments = $_REQUEST['attachments'];

}

   $newMA->setattachments($check);
   /*
   if (!file_exists("quotes/" . $userid . $attachments)) {
    $source_file=$_FILES['attachments']['tmp_name'];
    $destination_file="quotes/" . $attachments;
    $newqualityplan->ftp_copy($source_file,$destination_file);
   }  */

if ($pagename == 'edit_master')
 {
    $delete = $_REQUEST['deleteflag'];
    if ($delete == 'y')
      {
       $qualityplanrecnum = $_REQUEST['qualityplanrecnum'];
       $newqualityplan->deleteQualityplan($qualityplanrecnum);
       header("Location:qualityplanSummary.php" );
      }
 }

// Get all fields related to invoice
if ($pagename == 'new_master') {
    $max=$_REQUEST['index'];
    $ref_num = $_REQUEST['refnum'];
    $issue_date = $_REQUEST['issue_date'];
    $part_num = $_REQUEST['partnum'];
    $rev_num = $_REQUEST['revnum'];
    $part_name = $_REQUEST['partname'];
    $rev_date = $_REQUEST['revdate'];
   // $attachment = $_REQUEST['attachment'];
    $drg_issue = $_REQUEST['drgissue'];
    $customer = $_REQUEST['customer'];
    $project = $_REQUEST['project'];
    $material_type = $_REQUEST['materialtype'];
    $material_sp = $_REQUEST['materialsp'];

}
if ($pagename == 'new_master') {
$i=1;
$flag=0;
while($i<$max)
{
    $opnnum="opnnum" . $i;
	$opn_desc="opn_desc" . $i;
	$work_center="work_center" . $i;
	$opn_ref_no="opn_ref_no" . $i;
	$revnum="revnum" . $i;

    $opnnum1= $_REQUEST[$opnnum];
	$opn_desc1 = $_REQUEST[$opn_desc];
	$work_center1 = $_REQUEST[$work_center];
	$opn_ref_no1 = $_REQUEST[$opn_ref_no];
	$revnum1 = $_REQUEST[$revnum];

	if ($opnnum1 != '')
	{

		if ($pagename == 'new_master')
		{
			if($flag==0)
			{

				$newlogin = new userlogin;
				$newlogin->dbconnect();
                $sql = "start transaction";
 				$result = mysql_query($sql);
                $newMA->setrefnum($ref_num);
                $newMA->setissuedate($issue_date);
                $newMA->setpartnum($part_num);
                $newMA->setrevnum($rev_num);
                $newMA->setpartname($part_name);
                $newMA->setrevdate($rev_date);
                $newMA->setattachments($attachments);
                $newMA->setdrgissue($drg_issue);
                $newMA->setcustomer($customer);
                $newMA->setproject($project);
                $newMA->setmaterialtype($material_type);
                $newMA->setmaterialsp($material_sp);

				$sql = "start transaction";
				$result = mysql_query($sql);
				$masterrecnum = $newMA->addmaster();
				$flag=1;
			}
             $newLI->setlink2master($masterrecnum);
			 $newLI->setopnnum($opnnum1);
			 $newLI->setopndesc($opn_desc1);
			 $newLI->setworkcenter($work_center1);
			 $newLI->setopnrefno($opn_ref_no1);
			 $newLI->setrevnum($revnum1);
			 $newLI->addLI();
			 $sql = "commit";
			 $result = mysql_query($sql);
			 if(!$result)
			{
				 $sql = "rollback";
				 $result = mysql_query($sql);
				 die("Commit failed invoice Insert..Please report to Sysadmin. " . mysql_errno());
			 }
		}
	}
	$i++;
}
header("Location:masterprocesssheetSummary.php" );
}


if ($pagename == 'edit_master')
 {
//echo "i am inside editinvoice";
    $max=$_REQUEST['index'];
   $masterrecnum = $_REQUEST['masterrecnum'];
   //echo  $masterrecnum;
    $ref_num = $_REQUEST['refnum'];
    $issue_date = $_REQUEST['issue_date'];
    $part_num = $_REQUEST['partnum'];
    $rev_num = $_REQUEST['revnum'];
    $part_name = $_REQUEST['partname'];
    $rev_date = $_REQUEST['revdate'];
    //$attachment = $_REQUEST['attachment'];
    $drg_issue = $_REQUEST['drgissue'];
    $customer = $_REQUEST['customer'];
    $project = $_REQUEST['project'];
    $material_type = $_REQUEST['materialtype'];
    $material_sp = $_REQUEST['materialsp'];
    $link2master = $_REQUEST['masterrecnum'];

$i=1;
//$flag=0;
while($i<$max)
{
	//echo "i am inside while loop";
    $opnnum="opnnum" . $i;
	$opn_desc="opn_desc" . $i;
	$work_center="work_center" . $i;
	$opn_ref_no="opn_ref_no" . $i;
	$revnum="revnum" . $i;

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
    $opnnum1= $_REQUEST[$opnnum];
	$opn_desc1 = $_REQUEST[$opn_desc];
	$work_center1 = $_REQUEST[$work_center];
	$opn_ref_no1 = $_REQUEST[$opn_ref_no];
	$revnum1 = $_REQUEST[$revnum];

	$newlogin = new userlogin;
	$newlogin->dbconnect();

	if ($opnnum1 != '')
	{

  				$sql = "start transaction";
 				$result = mysql_query($sql);
                $newMA->setrefnum($ref_num);
                $newMA->setissuedate($issue_date);
                $newMA->setpartnum($part_num);
                $newMA->setrevnum($rev_num);
                $newMA->setpartname($part_name);
                $newMA->setrevdate($rev_date);
                $newMA->setattachments($attachments);
                $newMA->setdrgissue($drg_issue);
                $newMA->setcustomer($customer);
                $newMA->setproject($project);
                $newMA->setmaterialtype($material_type);
                $newMA->setmaterialsp($material_sp);
                $newMA->updatemaster($masterrecnum);
				//$flag=1;
             $newLI->setlink2master($masterrecnum);
			 $newLI->setopnnum($opnnum1);
			 $newLI->setopndesc($opn_desc1);
			 $newLI->setworkcenter($work_center1);
			 $newLI->setopnrefno($opn_ref_no1);
			 $newLI->setrevnum($revnum1);

			 if($prevlinenum1!='')
			{
            //echo $lirecnum1;
			 	$newLI->updateLI($lirecnum1);
			}
			else
			{
				$newLI->setlink2master($masterrecnum);
        		$newLI->addLI();
			}
	}
	else
	{
		 if ($prevlinenum1 != '')
		 {
			//echo "i am here deleting";
			 $newLI->deleteLI($lirecnum1);
		  }
	}
	 $sql = "commit";
	 $result = mysql_query($sql);
	 if(!$result)
	{
		 $sql = "rollback";
		 $result = mysql_query($sql);
		 die("Commit failed Master Process Sheet Insert..Please report to Sysadmin. " . mysql_errno());
	 }
$i++;
}
}

header("Location:masterprocesssheetSummary.php" );

?>
