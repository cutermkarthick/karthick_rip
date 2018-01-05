<?php
//==============================================
// Author: FSI                                 =
// Date-written = Mar 20, 2007                 =
// Filename: processReview.php                 =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OWT                          =
// Process of Contract Review                  =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];

$pagename = $_SESSION['pagename'];

include('classes/reviewClass.php');
include('classes/review_liClass.php');

// Next, create an instance of the classes required
$newreview = new review;
$LI = new review_li;

if ($pagename == 'editreview')
 {
    $delete = $_REQUEST['deleteflag'];
    if ($delete == 'y')
      {
       $reviewrecnum = $_REQUEST['reviewrecnum'];
       $newreview->deletereview($reviewrecnum);
       header("Location:reviewSummary.php");
      }
 }

// Get all fields related to invoice

    $name = $_REQUEST["name"];
    $ordernum = $_REQUEST["ordernum"];
    $orddate = $_REQUEST["orderdate"];
    $ordertype = $_REQUEST["ordertype"];
    $orderfor = $_REQUEST["orderfor"];
    $quotedate = $_REQUEST["quotedate"];
    $data_store = $_REQUEST["data_store"];
    $numofparts = $_REQUEST["numofparts"];
    $attachment1 = $_REQUEST["attachment1"];
    $rawmaterial = $_REQUEST["rawmaterial"];
    $source = $_REQUEST["source"];
    $parts_class = $_REQUEST["parts_class"];
    $resources = $_REQUEST["resources"];
    $qualityreq = $_REQUEST["qualityreq"];
    $saliant = $_REQUEST["saliant"];
    $aditional_resources = $_REQUEST["aditional_resources"];
    $subcontract = $_REQUEST["subcontract"];
    $special_process = $_REQUEST["special_process"];
    $delivery_req = $_REQUEST["delivery_req"];
    $person = $_REQUEST["person"];
    $quotation = $_REQUEST["quotation"];
    $data_for_quote = $_REQUEST["data_for_quote"];
    $quoterefnum = $_REQUEST["quoterefnum"];
    $path = $_REQUEST["path"];
    $quotation_det_store = $_REQUEST["quotation_det_store"];
    $risk_factors = $_REQUEST["risk_factors"];
    $requirements = $_REQUEST["requirements"];
    $explain_risk_factors = $_REQUEST["explain_risk_factors"];
    $quote_sentby = $_REQUEST["quote_sentby"];
    $quote_path = $_REQUEST["quote_path"];
    $enquiry_path = $_REQUEST["enquiry_path"];
    $data_for_enquiry = $_REQUEST["data_for_enquiry"];
    $amendment_num = $_REQUEST['amendment_num'];
    $amendment_date = $_REQUEST['amendment_date'];
    $special_instrns = $_REQUEST['special_instrns'];
    $status = $_REQUEST["status"];
    $valstatus = $_REQUEST["val_status"];
    $create_date = $_REQUEST["create_date"];
    $created_by = $_REQUEST["created_by"];
    $qa_approved = $_REQUEST["qa_app"];
    $engineering_approved = $_REQUEST["eng_app"];
    $review_notes = $_REQUEST['notes'];
    
	$newreview->setname($name);
	$newreview->setordernum($ordernum);
    $newreview->setnumofparts($numofparts);
    $newreview->setattachment1($attachment1);
    $newreview->setrawmaterial($rawmaterial);
    $newreview->setsource($source);
    $newreview->setparts_class($parts_class);
    $newreview->setresources($resources);
    $newreview->setqualityreq($qualityreq);
    $newreview->setsaliant($saliant);
    $newreview->setaditional_resources($aditional_resources);
    $newreview->setsubcontract($subcontract);
    $newreview->setspecial_process($special_process);
    $newreview->setdelivery_req($delivery_req);
    $newreview->setperson($person);
    $newreview->setquoterefnum($quoterefnum);
    $newreview->setquotation($quotation);
    $newreview->setdata_for_quote($data_for_quote);
    $newreview->setdata_store($data_store);
    $newreview->setpath($path);
    $newreview->setquotation_det_store($quotation_det_store);
    $newreview->setrisk_factors($risk_factors);
    $newreview->setrequirements($requirements);
    $newreview->setexplainrisk_factors($explain_risk_factors);
    $newreview->setquote_sentby($quote_sentby);
    $newreview->setquote_path($quote_path);
    $newreview->setenquiry_path($enquiry_path);
    $newreview->setdata_for_enquiry($data_for_enquiry);
    $newreview->setorderfor($orderfor);
    $newreview->setordertype($ordertype);
    $newreview->setorddate($orddate);
    $newreview->setquote_date($quotedate);
    $newreview->setamendment_num($amendment_num);
    $newreview->setamendment_date($amendment_date);
    $newreview->setspecial_instrns($special_instrns);
    $newreview->setorderstatus($status);
    $newreview->setvalstatus($valstatus);
    $newreview->setcreate_date($create_date);
    $newreview->setcreated_by($created_by);
    $newreview->setqa_approved($qa_approved);
    $newreview->setengineering_approved($engineering_approved);
    
if ($pagename == 'editreview')
{
    $reviewrecnum = $_REQUEST['reviewrecnum'];
    $newreview->addNotes($reviewrecnum,$review_notes);
}
    
if ($pagename == 'newreview')
{
if(isset($_REQUEST["refno"]))
  $refno = $_REQUEST["refno"];
else
  $refno = '';
$crdate = date("d-M-y");
$i=1;
$flag=0;
$reviewrecnum='';
$max=$_REQUEST['index'];
while($i<$max)
{
//echo "inside while";
	$line_num="line_num" . $i;
	$item_desc="item_desc" . $i;
    $partnum="partnum" . $i;
    $rmtype="rmtype" . $i;
    $rmspec="rmspec" . $i;
    $uom="uom" . $i;
    $dia="dia" . $i;
    $length="length" . $i;
    $width="width" . $i;
    $thickness="thickness" . $i;
    $gf="gf" . $i;
    $maxruling="maxruling" . $i;
    $altspec="altspec" . $i;
    $drgiss="drgiss" . $i;
    //$hcdrgiss="hcdrgiss" . $i;
    $partiss="partiss" . $i;
    $cos_iss="cos_iss" . $i;
    $model_iss="model_iss" . $i;
	$qty="qty" . $i;
	$crn_num="crn_num" . $i;

	if ( isset ( $_REQUEST[$line_num] ) ) {

    $linenumber1= $_REQUEST[$line_num];
	$itemdesc1 = $_REQUEST[$item_desc];
    $partnum1 = $_REQUEST[$partnum];
    $rmtype1 = $_REQUEST[$rmtype];
    $rmspec1 = $_REQUEST[$rmspec];
    $uom1 = $_REQUEST[$uom];
    $dia1 = $_REQUEST[$dia];
    $length1 = $_REQUEST[$length];
    $width1 = $_REQUEST[$width];
    $thickness1 = $_REQUEST[$thickness];
    $gf1 = $_REQUEST[$gf];
    $maxruling1 = $_REQUEST[$maxruling];
    $altspec1 = $_REQUEST[$altspec];
    $drgiss1 = $_REQUEST[$drgiss];
   // $hcdrgiss1 = $_REQUEST[$hcdrgiss];
    $partiss1 = $_REQUEST[$partiss];
  //  $hcpartiss1 = $_REQUEST[$hcpartiss];
  //  $po_cos1 = $_REQUEST[$po_cos];
  //  $hc_cos1 = $_REQUEST[$hc_cos];
    $cos_iss1 = $_REQUEST[$cos_iss];
    $model_iss1 = $_REQUEST[$model_iss];
	$qty1 = $_REQUEST[$qty];
	$crn_num1 = $_REQUEST[$crn_num];


//echo "\nI am linenumber1  :  " . $price1;
	if ($linenumber1 != '')
	{
 	       //echo "\nI am linenumber1  :  " . $price1;
			if($flag==0)
			{
				$newlogin = new userlogin;
				$newlogin->dbconnect();

                $reviewrecnum = $newreview->addreview($refno);
	            //echo "/n I am sorecnum  : " . $sorecnum;

				$flag=1;
			}

             $LI->setlink2review($reviewrecnum);
             $LI->setitem_num($linenumber1);
			 $LI->setitem_desc($itemdesc1);
             $LI->setpartnum($partnum1);
             $LI->setrmtype($rmtype1);
             $LI->setrmspec($rmspec1);
			 $LI->setuom($uom1);
			 $LI->setdia($dia1);
			 $LI->setlength($length1);
			 $LI->setwidth($width1);
			 $LI->setthickness($thickness1);
			 $LI->setgf($gf1);
			 $LI->setmaxruling($maxruling1);
			 $LI->setaltspec($altspec1);
             $LI->setdrgiss($drgiss1);
           //  $LI->sethcdrgiss($hcdrgiss1);
             $LI->setpartiss($partiss1);
          //   $LI->sethcpartiss($hcpartiss1);
           //  $LI->setpo_cos($po_cos1);
          //   $LI->sethc_cos($hc_cos1);
             $LI->setcos_iss($cos_iss1);
             $LI->setmodel_iss($model_iss1);
			 $LI->setqty($qty1);
			 $LI->setcrn_num($crn_num1);
			 $LI->addLI();

	}
	}
	$i++;
}
        $sql = "commit";
	    $result = mysql_query($sql);
        if(!$result)
	{
		 $sql = "rollback";
		 $result = mysql_query($sql);
		 die("Commit failed Review_li Insert..Please report to Sysadmin. " . mysql_errno());
	}
}




if ($pagename == 'editreview')
{
   $reviewrecnum  = $_REQUEST['reviewrecnum'] ;
   $flag=0;
   $sorecnum='';
   $i=1;
$max=$_REQUEST['index'];
//echo "Max is $max";
while($i<$max)
{
//echo "INside while";
	$linenumber="line_num" . $i;
	$itemdesc="item_desc" . $i;
    $partnum="partnum" . $i;
    $rmtype="rmtype" . $i;
    $rmspec="rmspec" . $i;
    $uom="uom" . $i;
    $dia="dia" . $i;
    $length="length" . $i;
    $width="width" . $i;
    $thickness="thickness" . $i;
    $gf="gf" . $i;
    $maxruling="maxruling" . $i;
    $altspec="altspec" . $i;
    $drgiss="drgiss" . $i;
    $hcdrgiss="hcdrgiss" . $i;
    $partiss="partiss" . $i;
    $hcpartiss="hcpartiss" . $i;
    $po_cos="po_cos" . $i;
    $hc_cos="hc_cos" . $i;
    $cos_iss="cos_iss" . $i;
    $model_iss="model_iss" . $i;
	$qty="qty" . $i;
 	$prevlinenum="prev_line_num" . $i;
	$lirecnum="lirecnum" . $i;
	$crn_num="crn_num" . $i;

	$lirecnum1=$_REQUEST[$lirecnum];
	$prevlinenum1=$_REQUEST[$prevlinenum];
	$linenumber1= $_REQUEST[$linenumber];
	$itemdesc1 = $_REQUEST[$itemdesc];
    $partnum1 = $_REQUEST[$partnum];
    $rmtype1 = $_REQUEST[$rmtype];
    $rmspec1 = $_REQUEST[$rmspec];
    $uom1 = $_REQUEST[$uom];
    $dia1 = $_REQUEST[$dia];
    $length1 = $_REQUEST[$length];
    $width1 = $_REQUEST[$width];
    $thickness1 = $_REQUEST[$thickness];
    $gf1 = $_REQUEST[$gf];
    $maxruling1 = $_REQUEST[$maxruling];
    $altspec1 = $_REQUEST[$altspec];
    $drgiss1 = $_REQUEST[$drgiss];
   // $hcdrgiss1 = $_REQUEST[$hcdrgiss];
    $partiss1 = $_REQUEST[$partiss];
  //  $hcpartiss1 = $_REQUEST[$hcpartiss];
  //  $po_cos1 = $_REQUEST[$po_cos];
  //  $hc_cos1 = $_REQUEST[$hc_cos];
    $cos_iss1 = $_REQUEST[$cos_iss];
    $model_iss1 = $_REQUEST[$model_iss];
	$qty1 = $_REQUEST[$qty];
	$crn_num1 = $_REQUEST[$crn_num];
    //echo  $crn_num1;
	$newlogin = new userlogin;
	$newlogin->dbconnect();

	if ($linenumber1 != '')
	{

			if($flag==0)
			{

				$sql = "start transaction";
				$result = mysql_query($sql);
				$newreview->updatereview($reviewrecnum);

				$flag=1;
			}

             $LI->setitem_num($linenumber1);
			 $LI->setitem_desc($itemdesc1);
             $LI->setpartnum($partnum1);
             $LI->setrmtype($rmtype1);
             $LI->setrmspec($rmspec1);
			 $LI->setuom($uom1);
			 $LI->setdia($dia1);
			 $LI->setlength($length1);
			 $LI->setwidth($width1);
			 $LI->setthickness($thickness1);
			 $LI->setgf($gf1);
			 $LI->setmaxruling($maxruling1);
			 $LI->setaltspec($altspec1);
             $LI->setdrgiss($drgiss1);
           //  $LI->sethcdrgiss($hcdrgiss1);
             $LI->setpartiss($partiss1);

             $LI->setcos_iss($cos_iss1);
             $LI->setmodel_iss($model_iss1);
			 $LI->setqty($qty1);
			 $LI->setcrn_num($crn_num1);

			// echo "prevlinenum1  :  " . $prevlinenum1;
             if($prevlinenum1!='')
			 {
			 	$LI->updateLI($lirecnum1);
			 }
			 else
			 {
                $LI->setlink2review($reviewrecnum);
                $LI->addLI($reviewrecnum);
			 }
	}
	else
	{
		 if ($prevlinenum1 != '')
		 {
			    $LI->deleteLI($lirecnum1);
	     }
	}
	 $sql = "commit";
	 $result = mysql_query($sql);
	 if(!$result)
	{
		 $sql = "rollback";
		 $result = mysql_query($sql);
		 die("Commit failed Review LI Insert..Please report to Sysadmin. " . mysql_errno());
	 }
$i++;
}

}

if ($pagename == 'reviewDetails')
{
  $reviewrecnum  = $_REQUEST['reviewrecnum'] ;
  $newreview->updateval_status($reviewrecnum);
}

 header("Location:reviewDetails.php?reviewrecnum=$reviewrecnum" );

?>
