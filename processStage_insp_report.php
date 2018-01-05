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


include('classes/pageClass.php');
include('classes/pagefieldsClass.php');
include_once('classes/loginClass.php');
include('classes/stage_insp_reportClass.php');
include('classes/stage_insp_reportliClass.php');
include('classes/partClass.php');

// Next, create an instance of the classes required

$newpage = new page;
$newFI= new pagefields;
//$newQGen= new genericQuote;
$newSIR = new stage_insp_report;
$newLI = new stage_insp_reportli;
$newPart = new part;

// Get all fields related to quote general info

$userid = $_SESSION['user'];
$refnum=$_REQUEST['refnum'];
$opnnum=$_REQUEST['opnnum'];
$partnum=$_REQUEST['partnum'];
$batch_qty=$_REQUEST['batch_qty'];
$partname=$_REQUEST['partname'];
$sheet=$_REQUEST['sheet'];
$remarks=$_REQUEST['remarks'];
$tr_no=$_REQUEST['tr_no'];
$rev_no=$_REQUEST['rev_no'];
$revdate=$_REQUEST['revdate'];

$slno1=$_REQUEST['slno1'];
$slno2=$_REQUEST['slno2'];
$slno3=$_REQUEST['slno3'];
$slno4=$_REQUEST['slno4'];
$slno5=$_REQUEST['slno5'];
$verified_by=$_REQUEST['verified_by'];
$insp_by1=$_REQUEST['insp_by1'];
$insp_by2=$_REQUEST['insp_by2'];
$insp_by3=$_REQUEST['insp_by3'];
$insp_by4=$_REQUEST['insp_by4'];
$insp_by5=$_REQUEST['insp_by5'];
$shift1=$_REQUEST['shift1'];
$shift2=$_REQUEST['shift2'];
$shift3=$_REQUEST['shift3'];
$shift4=$_REQUEST['shift4'];
$shift5=$_REQUEST['shift5'];
$date1=$_REQUEST['date1'];
$date2=$_REQUEST['date2'];
$date3=$_REQUEST['date3'];
$date4=$_REQUEST['date4'];
$date5=$_REQUEST['date5'];

$index=$_REQUEST['index'];
$action = $_REQUEST['action'];

// Database Connect
$newlogin = new userlogin;
$newlogin->dbconnect();



if ($pagename == 'edit_stage_insp_report')
 {
    $delete = $_REQUEST['deleteflag'];
    if ($delete == 'y')
      {
        $stage_insprecnum=$_SESSION['stage_insprecnum'];
        $newSIR->deletestage_insp($stage_insprecnum);
        header("Location:Stage_insp_summary.php");
      }
 }


if ($pagename == 'new_stage_insp' )
{
//	$type=$_REQUEST['quotetype'];
//	$newQGen->settype($type);

	// Get quote details

//	$genrecnum=$newQGen->addgenericQuote();
//	$newQuote->setquote2type($genrecnum);
//   	$quoterecnum = $newQuote->addQuote();

  $newlogin = new userlogin;
  $newlogin->dbconnect();
  $newSIR->setrefnum($refnum);
  $newSIR->setopnnum($opnnum);
  $newSIR->setpartnum($partnum);
  $newSIR->setbatch_qty($batch_qty);
  $newSIR->setpartname($partname);
  $newSIR->setremarks($remarks);
  $newSIR->settr_no($tr_no);
  $newSIR->setrev_no($rev_no);
  $newSIR->setrevdate($revdate);
  $newSIR->setsheet($sheet);

  $sql = "start transaction";
  $result = mysql_query($sql);
  $stage_insprecnum = $newSIR->addStage_insp();

     $total=0;
     $i=1;
     while($i<$index)
        {
	        $linenum="linenum" . $i;
	        $nominal_dim="nominal_dim" . $i;
	        $measured_dim1="measured_dim1" . $i;
	        $measured_dim2="measured_dim2" . $i;
	        $measured_dim3="measured_dim3" . $i;
	        $measured_dim4="measured_dim4" . $i;
	        $measured_dim5="measured_dim5" . $i;
	        $linenum1= $_REQUEST[$linenum];
	        $nominal_dim1 = $_REQUEST[$nominal_dim];
	        $measured_dim11 = $_REQUEST[$measured_dim1];
	        $measured_dim21 = $_REQUEST[$measured_dim2];
	        $measured_dim31 = $_REQUEST[$measured_dim3];
	        $measured_dim41 = $_REQUEST[$measured_dim4];
	        $measured_dim51 = $_REQUEST[$measured_dim5];

	        if ($linenum1 != '')
	        {

                if ($action == 'new' )
		        {


                    $newLI->setlinenum($linenum1);
		            $newLI->setnormal_dim($nominal_dim1);
		            $newLI->setslno1($slno1);
		            $newLI->setslno2($slno2);
		            $newLI->setslno3($slno3);
		            $newLI->setslno4($slno4);
		            $newLI->setslno5($slno5);
                    $newLI->setmeasured_dim1($measured_dim11);
		            $newLI->setmeasured_dim2($measured_dim21);
		            $newLI->setmeasured_dim3($measured_dim31);
		            $newLI->setmeasured_dim4($measured_dim41);
		            $newLI->setmeasured_dim5($measured_dim51);
		            $newLI->setverified_by($verified_by);
		            $newLI->setinsp_by1($insp_by1);
		            $newLI->setinsp_by2($insp_by2);
		            $newLI->setinsp_by3($insp_by3);
		            $newLI->setinsp_by4($insp_by4);
		            $newLI->setinsp_by5($insp_by5);
		            $newLI->setshift1($shift1);
		            $newLI->setshift2($shift2);
		            $newLI->setshift3($shift3);
		            $newLI->setshift4($shift4);
		            $newLI->setshift5($shift5);
		            $newLI->setdate1($date1);
		            $newLI->setdate2($date2);
		            $newLI->setdate3($date3);
		            $newLI->setdate4($date4);
		            $newLI->setdate5($date5);
		            $newLI->setlink2stage_insp($stage_insprecnum);

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

}
else
{
    $stage_insprecnum = $_REQUEST['stage_insprecnum'];
    $newlogin = new userlogin;
    $newlogin->dbconnect();
    $newSIR->setrefnum($refnum);
    $newSIR->setopnnum($opnnum);
    $newSIR->setpartnum($partnum);
    $newSIR->setbatch_qty($batch_qty);
    $newSIR->setpartname($partname);
    $newSIR->setremarks($remarks);
    $newSIR->settr_no($tr_no);
    $newSIR->setrev_no($rev_no);
    $newSIR->setrevdate($revdate);
    $newSIR->setsheet($sheet);

    $sql = "start transaction";
    $result = mysql_query($sql);
    $newSIR->updateStage_insp($stage_insprecnum);

    $total=0;
	$i=1;
	while($i<$index)
	{

            $linenum="linenum" . $i;
	        $nominal_dim="nominal_dim" . $i;
	        $measured_dim1="measured_dim1" . $i;
	        $measured_dim2="measured_dim2" . $i;
	        $measured_dim3="measured_dim3" . $i;
	        $measured_dim4="measured_dim4" . $i;
	        $measured_dim5="measured_dim5" . $i;
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
	        $nominal_dim1 = $_REQUEST[$nominal_dim];
	        $measured_dim11 = $_REQUEST[$measured_dim1];
	        $measured_dim21 = $_REQUEST[$measured_dim2];
	        $measured_dim31 = $_REQUEST[$measured_dim3];
	        $measured_dim41 = $_REQUEST[$measured_dim4];
	        $measured_dim51 = $_REQUEST[$measured_dim5];
		    $newlogin = new userlogin;
		    $newlogin->dbconnect();

	    if ($linenum1 != '')
	    {


                    $newLI->setlinenum($linenum1);
		            $newLI->setnormal_dim($nominal_dim1);
		            $newLI->setslno1($slno1);
		            $newLI->setslno2($slno2);
		            $newLI->setslno3($slno3);
		            $newLI->setslno4($slno4);
		            $newLI->setslno5($slno5);
                    $newLI->setmeasured_dim1($measured_dim11);
		            $newLI->setmeasured_dim2($measured_dim21);
		            $newLI->setmeasured_dim3($measured_dim31);
		            $newLI->setmeasured_dim4($measured_dim41);
		            $newLI->setmeasured_dim5($measured_dim51);
		            $newLI->setverified_by($verified_by);
		            $newLI->setinsp_by1($insp_by1);
		            $newLI->setinsp_by2($insp_by2);
		            $newLI->setinsp_by3($insp_by3);
		            $newLI->setinsp_by4($insp_by4);
		            $newLI->setinsp_by5($insp_by5);
		            $newLI->setshift1($shift1);
		            $newLI->setshift2($shift2);
		            $newLI->setshift3($shift3);
		            $newLI->setshift4($shift4);
		            $newLI->setshift5($shift5);
		            $newLI->setdate1($date1);
		            $newLI->setdate2($date2);
		            $newLI->setdate3($date3);
		            $newLI->setdate4($date4);
		            $newLI->setdate5($date5);


            if($prevlinenum1!='')
			{
            //echo $lirecnum1;
			 	$newLI->updateLI($lirecnum1);
			}
			else
			{
                $newLI->setlink2stage_insp($stage_insprecnum);
        		$newLI->addLI();
			}
	  }
	  else
	    {
		    if ($prevlinenum1 != '')
		        {
                $newLI->deleteLI($lirecnum1);
		        }
	    }
	        $sql = "commit";
	        $result = mysql_query($sql);
	    if(!$result)
	    {
		    $sql = "rollback";
		    $result = mysql_query($sql);
		    die("Commit failed stage insp Insert..Please report to Sysadmin. " . mysql_errno());
	    }
        $i++;
    }

}


if ($pagename == 'edit_stage_insp')
{
     header ( "Location: stage_inspDetails.php?stage_insprecnum=$stage_insprecnum" );
}
else {
       header ( "Location: Stage_insp_summary.php" );
}
?>
