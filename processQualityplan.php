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

include('classes/qualityplanClass.php');
include('classes/qualityplanliClass.php');

// Next, create an instance of the classes required
$newqualityplan = new qualityplan;
$newLI = new qualityplanli;

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
//    $attachments = $_REQUEST['attachments'];

}

   $newqualityplan->setattachments($check);
   /*
   if (!file_exists("quotes/" . $userid . $attachments)) {
    $source_file=$_FILES['attachments']['tmp_name'];
    $destination_file="quotes/" . $attachments;
    $newqualityplan->ftp_copy($source_file,$destination_file);
   }  */



if ($pagename == 'editqualityplan')
 {
    $delete = $_REQUEST['deleteflag'];
    if ($delete == 'y')
      {
       $qualityplanrecnum = $_REQUEST['qualityplanrecnum'];
       $newqualityplan->deleteQualityplan($qualityplanrecnum);
       header("Location:qualityplanSummary.php");
      }
 }

// Get all fields related to invoice
if ($pagename == 'newqualityplan') {
   $max = $_REQUEST["index"];
   $opnrefno = $_REQUEST["opnrefno"];
   $operationnumber = $_REQUEST['operationnumber'];
   $partnumber = $_REQUEST['partnumber'];
   $revnumber = $_REQUEST['revnumber'];
   $partname = $_REQUEST['partname'];
   $revdate = $_REQUEST['revdate'];
   $parttype = $_REQUEST['parttype'];
   $drgissue = $_REQUEST['drgissue'];
   $approvedby = $_REQUEST['approvedby'];
   $preparedby = $_REQUEST['preparedby'];
   $issuesnumber = $_REQUEST['issuesnumber'];
   $sheet = $_REQUEST['sheet'];
 //  $attachments = $_REQUEST['attachments'];
   $note = $_REQUEST['note'];
   
   
   
   	$newlogin = new userlogin;
				$newlogin->dbconnect();
  				$newqualityplan->setopnrefno($opnrefno);
		  		$newqualityplan->setoperationnumber ($operationnumber);
			   	$newqualityplan->setpartnumber($partnumber);
   				$newqualityplan->setrevnumber($revnumber);
	  			$newqualityplan->setpartname($partname);
		   		$newqualityplan->setrevdate($revdate);
		   		$newqualityplan->setparttype($parttype);
                $newqualityplan->setdrgissue($drgissue);
                $newqualityplan->setapprovedby($approvedby);
                $newqualityplan->setpreparedby($preparedby);
                $newqualityplan->setissuesnumber($issuesnumber);
                $newqualityplan->setsheet($sheet);
                $newqualityplan->setattachments($attachments);
                $newqualityplan->setnote($note);

				$sql = "start transaction";
				$result = mysql_query($sql);

            $qualityplanrecnum = $newqualityplan->addQualityplan();
}

if ($pagename == 'newqualityplan') {
$i=1;
$flag=0;
while($i<$max)
{

    $sl_num="sl_num" . $i;
	$drawing_dim="drawing_dim" . $i;
	$measuring_istrument="measuring_istrument" . $i;
	$samplesize="samplesize" . $i;
	$remarks="remarks" . $i;

	$sl_num1= $_REQUEST[$sl_num];
	$drawing_dim1 = $_REQUEST[$drawing_dim];
	$measuring_istrument1 = $_REQUEST[$measuring_istrument];
	$samplesize1 = $_REQUEST[$samplesize];
	$remarks1 = $_REQUEST[$remarks];

	if ($sl_num1 != '')
	{

		if ($pagename == 'newqualityplan')
		{
			if($flag==0)
			{


				$flag=1;
				//echo "PO Amount is     :$poamount";
			}
			 $newLI->setlink2qualityplan($qualityplanrecnum);
			 $newLI->setsl_num($sl_num1);
			 $newLI->setdrawing_dim($drawing_dim1);
			 $newLI->setmeasuring_istrument($measuring_istrument1);
			 $newLI->setsamplesize($samplesize1);
			 $newLI->setremarks($remarks1);

			 $newLI->addQualityplanli();
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
header("Location:qualityplanSummary.php" );
}


if ($pagename == 'editqualityplan')
 {
//echo "i am inside editinvoice";
   $max=$_REQUEST['index'];
   $qualityplanrecnum = $_REQUEST['qualityplanrecnum'];
   $opnrefno = $_REQUEST['opnrefno'];
   $operationnumber = $_REQUEST['operationnumber'];
   $partnumber = $_REQUEST['partnumber'];
   $revnumber = $_REQUEST['revnumber'];
   $partname = $_REQUEST['partname'];
   $revdate = $_REQUEST['revdate'];
   $parttype = $_REQUEST['parttype'];
   $drgissue = $_REQUEST['drgissue'];
   $approvedby = $_REQUEST['approvedby'];
   $preparedby = $_REQUEST['preparedby'];
   $issuesnumber = $_REQUEST['issuesnumber'];
   $sheet = $_REQUEST['sheet'];
  // $attachments = $_REQUEST['attachments'];
   $note = $_REQUEST['note'];
   $link2qualityplan = $_REQUEST['qualityplanrecnum'];
  
$i=1;
//$flag=0;
while($i<$max)
{
	//echo "i am inside while loop";

    $sl_num="sl_num" . $i;
	$drawing_dim="drawing_dim" . $i;
	$measuring_istrument="measuring_istrument" . $i;
	$samplesize="samplesize" . $i;
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

	$sl_num1= $_REQUEST[$sl_num];
	$drawing_dim1 = $_REQUEST[$drawing_dim];
	$measuring_istrument1 = $_REQUEST[$measuring_istrument];
	$samplesize1 = $_REQUEST[$samplesize];
	$remarks1 = $_REQUEST[$remarks];

	$newlogin = new userlogin;
	$newlogin->dbconnect();

	if ($sl_num1 != '')
	{

  				$sql = "start transaction";
 				$result = mysql_query($sql);

                $newqualityplan->setopnrefno($opnrefno);
		  		$newqualityplan->setoperationnumber ($operationnumber);
			   	$newqualityplan->setpartnumber($partnumber);
   				$newqualityplan->setrevnumber($revnumber);
	  			$newqualityplan->setpartname($partname);
		   		$newqualityplan->setrevdate($revdate);
		   		$newqualityplan->setparttype($parttype);
                $newqualityplan->setdrgissue($drgissue);
                $newqualityplan->setapprovedby($approvedby);
                $newqualityplan->setpreparedby($preparedby);
                $newqualityplan->setissuesnumber($issuesnumber);
                $newqualityplan->setsheet($sheet);
                $newqualityplan->setattachments($attachments);
                $newqualityplan->setnote($note);

                $newqualityplan->updateQualityplan($qualityplanrecnum);
				//$flag=1;

             $newLI->setlink2qualityplan($qualityplanrecnum);
			 $newLI->setsl_num($sl_num1);
			 $newLI->setdrawing_dim($drawing_dim1);
			 $newLI->setmeasuring_istrument($measuring_istrument1);
			 $newLI->setsamplesize($samplesize1);
			 $newLI->setremarks($remarks1);
			 if($prevlinenum1!='')
			{
			 	$newLI->updateQualityplanli($lirecnum1);
			}
			else
			{
				$newLI->setlink2qualityplan($qualityplanrecnum);
        		$newLI->addQualityplanli();
			}
	}
	else
	{
		 if ($prevlinenum1 != '')
		 {
			//echo "i am here deleting";
			 $newLI->deleteQualityplanli($lirecnum1);
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

header("Location:qualityplanSummary.php" );

?>
