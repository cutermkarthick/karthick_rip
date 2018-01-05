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
include('classes/dataClass.php');
include('classes/dataliClass.php');

// Next, create an instance of the classes required
$newDT = new data;
$newLI = new datasheet_line_items;
//$newLI = new master_line_items;

/*$attachment ='';
$check=$_FILES['attachments']['name'] ;
if ($check != '' )
{
	 $attachment = $userid . '_' . $_FILES['attachments']['name'];
	 $attachment = preg_replace('/\s+/',' ',$attachment);
  	 $attachment = preg_replace('/\s/','_',$attachment);
	//echo "$excelfile<br>";
	 $attachment = strtolower($attachment);
}
else
{
//echo "i am here else";
 //   $attachments = $_REQUEST['attachments'];

}

   $newDT->setattachments($check);      */

// request the data

$opn_ref_no = $_REQUEST['opnrefnum'];
$drg_issue = $_REQUEST['drgissue'];
$work_center = $_REQUEST['workcentre'];
$opnnum = $_REQUEST['opnnum'];
$partnum = $_REQUEST['partnum'];
//$attachments = $_REQUEST['attachments'];
$revnum = $_REQUEST['revnum'];
$partname = $_REQUEST['partname'];
$parttype = $_REQUEST['parttype'];
$revdate =  $_REQUEST['revdate'];
$preparedby = $_REQUEST['preparedby'];
$approvedby = $_REQUEST['approvedby'];
$Issuenum = $_REQUEST['issuenum'];




// Get all fields related to PO
/*if ($pagename == 'newpo' || $pagename == 'poupdate' || $pagename == 'vendpoupd') {
   $vendorrecnum = $_REQUEST['vendrecnum'];
   $podate = $_REQUEST['podate'];
   $ponum = $_REQUEST['ponum'];
   //$wonum = $_REQUEST['wonum'];
   $descr = $_REQUEST['desc'];
   $status = $_REQUEST['status'];
}   */

 $newlogin = new userlogin;
   $newlogin->dbconnect();

   $newDT->setopn_ref_no($opn_ref_no);
   $newDT->setdrg_issue($drg_issue);
   $newDT->setwork_center($work_center);
   $newDT->setopnnum($opnnum);
   $newDT->setpartnum($partnum);
 //  $newDT->setattachments($attachments);
   $newDT->setrevnum($revnum);
   $newDT->setpartname($partname);
   $newDT->setparttype($parttype);
   $newDT->setrevdate($revdate);
   $newDT->setprepared_by($preparedby);
   $newDT->setapproved_by($approvedby);
   $newDT->setissuenum($Issuenum);

if ($pagename == 'new_ds') {
   $max = $_REQUEST["index"];
   $i=1;
   $sql = "start transaction";
   $result = mysql_query($sql);
   $datarecnum = $newDT->adddata();
   $sql = "commit";
   $result = mysql_query($sql);
   if(!$result) die("Commit failed for New data sheet..Please report to Sysadmin. " . mysql_error());


   while($i<$max)
  {
    $linenum="linenum" . $i;
	$tool_details="tool_details" . $i;
	$tool_length="tool_length" . $i;
    $speed="speed" . $i;
	$feed="feed" . $i;
	$opn_desc="opn_desc" . $i;
    $cnc_pgm_name="cnc_pgm_name" . $i;
    $est_time="est_time" . $i;

	$linenum1= $_REQUEST[$linenum];
	$tool_details1 = $_REQUEST[$tool_details];
	$tool_length1 = $_REQUEST[$tool_length];
	$speed1 = $_REQUEST[$speed];
	$feed1 = $_REQUEST[$feed];
	$opn_desc1 = $_REQUEST[$opn_desc];
	$cnc_pgm_name1 = $_REQUEST[$cnc_pgm_name];
	$est_time1 = $_REQUEST[$est_time];

	if ($linenum1 != '')
	{
             $newLI->setlinenum($linenum1);
			 $newLI->settool_details($tool_details1);
  			 $newLI->settool_length($tool_length1);
			 $newLI->setspeed($speed1);
			 $newLI->setfeed($feed1);
             $newLI->setopn_desc($opn_desc1);
             $newLI->setcnc_pgm_name($cnc_pgm_name1);
             $newLI->setest_time($est_time1);
             $newLI->setlink2ds($datarecnum);
			 $newLI->addLI();
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
}

if ($pagename == 'edit_ds') {
   $max = $_REQUEST['index'];
   $datarecnum = $_SESSION['dsrecnum'];
   $sql = "start transaction";
   $result = mysql_query($sql);
   $newDT->updatedata($datarecnum);
   $link2ds = $_REQUEST['link2ds'];
   
   
   
   $i=1;
//$flag=0;
while($i<$max)
{
	//echo "i am inside while loop";


    $linenum="linenum" . $i;
	$tool_details="tool_details" . $i;
	$tool_length="tool_length" . $i;
	$speed="speed" . $i;
	$feed="feed" . $i;
	$opn_desc="opn_desc" . $i;
	$cnc_pgm_name="cnc_pgm_name" . $i;
	$est_time="est_time" . $i;
	

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



    $linenum1= $_REQUEST[$linenum];
	$tool_details1 = $_REQUEST[$tool_details];
	$tool_length1 = $_REQUEST[$tool_length];
	$speed1 = $_REQUEST[$speed];
	$feed1 = $_REQUEST[$feed];
	$opn_desc1 = $_REQUEST[$opn_desc];
	$cnc_pgm_name1 = $_REQUEST[$cnc_pgm_name];
	$est_time1 = $_REQUEST[$est_time];


	$newlogin = new userlogin;
	$newlogin->dbconnect();

	if ($linenum1 != '')
	{
             $newLI->setlinenum($linenum1);
			 $newLI->settool_details($tool_details1);
			 $newLI->settool_length($tool_length1);
			 $newLI->setspeed($speed1);
			 $newLI->setfeed($feed1);
			 $newLI->setopn_desc($opn_desc1);
			 $newLI->setcnc_pgm_name($cnc_pgm_name1);
			 $newLI->setest_time($est_time1);

			 $newLI->setlink2ds($datarecnum);
			 if($prevlinenum1!='')
			{
			 	$newLI->updateLI($lirecnum1);
			}
			else
			{
				$newLI->setlink2ds($datarecnum);
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
		 die("Commit failed cust data Insert..Please report to Sysadmin. " . mysql_errno());
	 }
$i++;
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
header("Location:ppcds.php");
}
?>
