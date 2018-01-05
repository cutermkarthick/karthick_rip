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
include('classes/Final_insp_reportClass.php');
include('classes/Final_insp_reportliClass.php');
include('classes/partClass.php');

// Next, create an instance of the classes required

$newpage = new page;
$newFI= new pagefields;
//$newQGen= new genericQuote;
$newFIR = new final_insp_report;
$newLI = new final_insp_reportli;
$newPart = new part;

// Get all fields related to quote general info

$userid = $_SESSION['user'];

$refnum=$_REQUEST['refnum'];
$qty=$_REQUEST['qty'];
$customer=$_REQUEST['customer'];
$wonum=$_REQUEST['wonum'];
$partnum=$_REQUEST['partnum'];
$billnum=$_REQUEST['billnum'];
$billdate=$_REQUEST['billdate'];
$partname=$_REQUEST['partname'];
$ponum=$_REQUEST['ponum'];
$issue=$_REQUEST['issue'];
$reportnum=$_REQUEST['reportnum'];
$page=$_REQUEST['page'];
$approved_by=$_REQUEST['approved_by'];
$approved_date=$_REQUEST['approved_date'];



$slnum1=$_REQUEST['slnum1'];
$slnum2=$_REQUEST['slnum2'];
$slnum3=$_REQUEST['slnum3'];
$insp_by1=$_REQUEST['insp_by1'];
$insp_by2=$_REQUEST['insp_by2'];
$insp_by3=$_REQUEST['insp_by3'];
$insp_date1=$_REQUEST['insp_date1'];
$insp_date2=$_REQUEST['insp_date2'];
$insp_date3=$_REQUEST['insp_date3'];

$index=$_REQUEST['index'];
$action = $_REQUEST['action'];

// Database Connect
$newlogin = new userlogin;
$newlogin->dbconnect();



if ($pagename == 'edit_final_insp_report')
 {
    $delete = $_REQUEST['deleteflag'];
    if ($delete == 'y')
      {
        $final_insprecnum=$_SESSION['final_insprecnum'];
        $newSIR->deletestage_insp($final_insprecnum);
        header("Location:Stage_insp_summary.php");
      }
 }


if ($pagename == 'new_final_insp' )
{
//	$type=$_REQUEST['quotetype'];
//	$newQGen->settype($type);

	// Get quote details

//	$genrecnum=$newQGen->addgenericQuote();
//	$newQuote->setquote2type($genrecnum);
//   	$quoterecnum = $newQuote->addQuote();

  $newlogin = new userlogin;
  $newlogin->dbconnect();
  $newFIR->setrefnum($refnum);
  $newFIR->setqty($qty);
  $newFIR->setcustomer($customer);
  $newFIR->setwonum($wonum);
  $newFIR->setpartnum($partnum);
  $newFIR->setbillnum($billnum);
  $newFIR->setbilldate($billdate);
  $newFIR->setpartname($partname);
  $newFIR->setponum($ponum);
  $newFIR->setissue($issue);
  $newFIR->setreportnum($reportnum);
  $newFIR->setpage($page);
  $newFIR->setapproved_by($approved_by);
  $newFIR->setapproved_date($approved_date);

  $sql = "start transaction";
  $result = mysql_query($sql);
  $final_insprecnum = $newFIR->addFinal_insp();

     $total=0;
     $i=1;
     while($i<$index)
        {
	        $slno="slno" . $i;
	        $sheet="sheet" . $i;
	        $map="map" . $i;
	        $main_view="main_view" . $i;
	        $actual_dim1="actual_dim1" . $i;
	        $actual_dim2="actual_dim2" . $i;
	        $actual_dim3="actual_dim3" . $i;
	        $accpt_reject="accpt_reject" . $i;
	        $slno1= $_REQUEST[$slno];
	        $sheet1 = $_REQUEST[$sheet];
	        $map1 = $_REQUEST[$map];
	        $main_view1 = $_REQUEST[$main_view];
	        $actual_dim11 = $_REQUEST[$actual_dim1];
	        $actual_dim21 = $_REQUEST[$actual_dim2];
	        $actual_dim31 = $_REQUEST[$actual_dim3];
	        $accpt_reject1 = $_REQUEST[$accpt_reject];

	        if ($slno1 != '')
	        {

                if ($action == 'new' )
		        {


                    $newLI->setslno($slno1);
		            $newLI->setsheet($sheet1);
		            $newLI->setmap($map1);
		            $newLI->setmain_view($main_view1);
		            $newLI->setslnum1($slnum1);
		            $newLI->setslnum2($slnum2);
		            $newLI->setslnum3($slnum3);
                    $newLI->setactual_dim1($actual_dim11);
		            $newLI->setactual_dim2($actual_dim21);
		            $newLI->setactual_dim3($actual_dim31);
		            $newLI->setaccpt_reject($accpt_reject1);
		            $newLI->setinsp_by1($insp_by1);
		            $newLI->setinsp_by2($insp_by2);
		            $newLI->setinsp_by3($insp_by3);
		            $newLI->setinsp_date1($insp_date1);
		            $newLI->setinsp_date2($insp_date2);
		            $newLI->setinsp_date3($insp_date2);
		            $newLI->setlink2final_insp($final_insprecnum);
		            
      	            $newLI->addLI();
			        $sql = "commit";
			        $result = mysql_query($sql);
			        if(!$result)
			            {
				        $sql = "rollback";
				        $result = mysql_query($sql);
				        die("Commit failed final insp  Insert..Please report to Sysadmin. " . mysql_errno());
			            }
		         }
	        }
	     $i++;
     }

}
else
{
    $final_insprecnum = $_REQUEST['final_insprecnum'];
    $newlogin = new userlogin;
    $newlogin->dbconnect();
    $newFIR->setrefnum($refnum);
    $newFIR->setqty($qty);
    $newFIR->setcustomer($customer);
    $newFIR->setwonum($wonum);
    $newFIR->setpartnum($partnum);
    $newFIR->setbillnum($billnum);
    $newFIR->setbilldate($billdate);
    $newFIR->setpartname($partname);
    $newFIR->setponum($ponum);
    $newFIR->setissue($issue);
    $newFIR->setreportnum($reportnum);
    $newFIR->setpage($page);
    $newFIR->setapproved_by($approved_by);
    $newFIR->setapproved_date($approved_date);

    $sql = "start transaction";
    $result = mysql_query($sql);
    $newFIR->updateFinal_insp($final_insprecnum);

    $total=0;
	$i=1;
	while($i<$index)
	{

            $slno="slno" . $i;
	        $sheet="sheet" . $i;
	        $map="map" . $i;
	        $main_view="main_view" . $i;
	        $actual_dim1="actual_dim1" . $i;
	        $actual_dim2="actual_dim2" . $i;
	        $actual_dim3="actual_dim3" . $i;
	        $accpt_reject="accpt_reject" . $i;

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

            $slno1= $_REQUEST[$slno];
	        $sheet1 = $_REQUEST[$sheet];
	        $map1 = $_REQUEST[$map];
	        $main_view1 = $_REQUEST[$main_view];
	        $actual_dim11 = $_REQUEST[$actual_dim1];
	        $actual_dim21 = $_REQUEST[$actual_dim2];
	        $actual_dim31 = $_REQUEST[$actual_dim3];
	        $accpt_reject1 = $_REQUEST[$accpt_reject];
		    $newlogin = new userlogin;
		    $newlogin->dbconnect();

	    if ($slno1 != '')
	    {

                    $newLI->setslno($slno1);
		            $newLI->setsheet($sheet1);
		            $newLI->setmap($map1);
		            $newLI->setmain_view($main_view1);
		            $newLI->setslnum1($slnum1);
		            $newLI->setslnum2($slnum2);
		            $newLI->setslnum3($slnum3);
                    $newLI->setactual_dim1($actual_dim11);
		            $newLI->setactual_dim2($actual_dim21);
		            $newLI->setactual_dim3($actual_dim31);
		            $newLI->setaccpt_reject($accpt_reject1);
		            $newLI->setinsp_by1($insp_by1);
		            $newLI->setinsp_by2($insp_by2);
		            $newLI->setinsp_by3($insp_by3);
		            $newLI->setinsp_date1($insp_date1);
		            $newLI->setinsp_date2($insp_date2);
		            $newLI->setinsp_date3($insp_date3);



            if($prevlinenum1!='')
			{
            //echo $lirecnum1;
			 	$newLI->updateLI($lirecnum1);
			}
			else
			{
                $newLI->setlink2final_insp($final_insprecnum);
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
		    die("Commit failed final insp Insert..Please report to Sysadmin. " . mysql_errno());
	    }
        $i++;
    }

}


if ($pagename == 'edit_final_insp')
{
     header ( "Location: final_inspDetails.php?final_insprecnum=$final_insprecnum" );
}
else {
       header ( "Location: Final_insp_summary.php" );
}
?>
