<?php
//==============================================
// Author: FSI                                 =
// Date-written = Mar 21, 2007                 =
// Filename: processProcdeviation.php          =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OWT                          =
// Process of Process Deviation                =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];

$pagename = $_SESSION['pagename'];

include('classes/processdeviationClass.php');
include('classes/processdeviationliClass.php');

// Next, create an instance of the classes required
$newprocdev = new procdeviation;
$newLI = new procdeviationli;
$companyrecnum = $_REQUEST['companyrecnum'];
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

   $newprocdev->setattachments($check);
   /*
   if (!file_exists("quotes/" . $userid . $attachments)) {
    $source_file=$_FILES['attachments']['tmp_name'];
    $destination_file="quotes/" . $attachments;
    $newqualityplan->ftp_copy($source_file,$destination_file);
   }  */



if ($pagename == 'editprocdeviation')
 {
    $delete = $_REQUEST['deleteflag'];
    if ($delete == 'y')
      {
      $procdevrecnum = $_REQUEST['procdevrecnum'];
       $newprocdev->deleteProcdeviation($procdevrecnum);
       header("Location:processdeviationSummary.php" );
      }
 }

// Get all fields related to invoice
if ($pagename == 'newprocessdeviation') {
   $max=$_REQUEST['index'];
   $partnumber = $_REQUEST['partnumber'];
   $partname = $_REQUEST['partname'];
   $drgissue = $_REQUEST['drgissue'];
   $procdev2customer = $_REQUEST['companyrecnum'];
   $matltype = $_REQUEST['matltype'];
   $matlspec = $_REQUEST['matlspec'];
   $project = $_REQUEST['project'];
   $refno = $_REQUEST['refno'];
}
if ($pagename == 'newprocessdeviation') {
$i=1;
$flag=0;
while($i<$max)
{

    $sl_num="sl_num" . $i;
	$description="description" . $i;
	$signature="signature" . $i;

	$sl_num1= $_REQUEST[$sl_num];
	$description1 = $_REQUEST[$description];
	$signature1 = $_REQUEST[$signature];

	if ($sl_num1 != '')
	{

		if ($pagename == 'newprocessdeviation')
		{
			if($flag==0)
			{

				$newlogin = new userlogin;
				$newlogin->dbconnect();

			   	$newprocdev->setpartnumber($partnumber);
	  			$newprocdev->setpartname($partname);
		   		$newprocdev->setdrgissue($drgissue);
		   		$newprocdev->setprocdev2customer($procdev2customer);
                $newprocdev->setmatltype($matltype);
                $newprocdev->setmatlspec($matlspec);
                $newprocdev->setproject($project);
                $newprocdev->setrefno($refno);
                $newprocdev->setattachments($attachments);

				$sql = "start transaction";
				$result = mysql_query($sql);
				$procdevrecnum = $newprocdev->addProcdeviation();
				$flag=1;
				//echo "PO Amount is     :$poamount";
			}
			 $newLI->setlink2procdev($procdevrecnum);
			 $newLI->setsl_num($sl_num1);
			 $newLI->setdescription($description1);
			 $newLI->setsignature($signature1);

			 $newLI->addProcdeviationli();
			 $sql = "commit";
			 $result = mysql_query($sql);
			 if(!$result)
			{
				 $sql = "rollback";
				 $result = mysql_query($sql);
				 die("Commit failed Process deviation Insert..Please report to Sysadmin. " . mysql_errno());
			 }
		}
	}
	$i++;
}
header("Location:processdeviationSummary.php" );
}


if ($pagename == 'editprocdeviation')
 {
//echo "i am inside editinvoice";

   $procdevrecnum=$_REQUEST['procdevrecnum'];
   $max=$_REQUEST['index'];
   $partnumber = $_REQUEST['partnumber'];
   $partname = $_REQUEST['partname'];
   $drgissue = $_REQUEST['drgissue'];
   $procdev2customer = $_REQUEST['companyrecnum'];
   $matltype = $_REQUEST['matltype'];
   $matlspec = $_REQUEST['matlspec'];
   $project = $_REQUEST['project'];
   $refno = $_REQUEST['refno'];

$i=1;
//$flag=0;
while($i<$max)
{

    $sl_num="sl_num" . $i;
	$description="description" . $i;
	$signature="signature" . $i;
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

    $sl_num1= $_REQUEST[$sl_num];
	$description1 = $_REQUEST[$description];
	$signature1 = $_REQUEST[$signature];

	$newlogin = new userlogin;
	$newlogin->dbconnect();

	if ($sl_num1 != '')
	{

  				$sql = "start transaction";
 				$result = mysql_query($sql);

                $newprocdev->setpartnumber($partnumber);
	  			$newprocdev->setpartname($partname);
		   		$newprocdev->setdrgissue($drgissue);
		   		$newprocdev->setprocdev2customer($procdev2customer);
                $newprocdev->setmatltype($matltype);
                $newprocdev->setmatlspec($matlspec);
                $newprocdev->setproject($project);
                $newprocdev->setrefno($refno);
                $newprocdev->setattachments($attachments);

                $newprocdev->updateProcdeviation($procdevrecnum);
				//$flag=1;

             $newLI->setlink2procdev($procdevrecnum);
			 $newLI->setsl_num($sl_num1);
			 $newLI->setdescription($description1);
			 $newLI->setsignature($signature1);
			 if($prevlinenum1!='')
			{
			 	$newLI->updateProcdeviationli($lirecnum1);
			}
			else
			{
				$newLI->setlink2procdev($procdevrecnum);
        		$newLI->addProcdeviationli();
			}
	}
	else
	{
		 if ($prevlinenum1 != '')
		 {
			//echo "i am here deleting";
			 $newLI->deleteProcdeviationli($lirecnum1);
		  }
	}
	 $sql = "commit";
	 $result = mysql_query($sql);
	 if(!$result)
	{
		 $sql = "rollback";
		 $result = mysql_query($sql);
		 die("Commit failed PO Insert..Please report to Sysadmin. " . mysql_errno());
	 }
$i++;
}
}

header("Location:processdeviationSummary.php" );

?>
