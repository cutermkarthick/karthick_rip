<?php

//==============================================
// Author: FSI                                 =
// Date-written = June 2, 2006                 =
// Filename: processSalesorder.php             =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OWT                          =
// Processes Sales Order                       =
//==============================================
session_start();
header("Cache-control: private");
if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );
}
$userid = $_SESSION['user'];
$pagename= $_SESSION['pagename'];
$userrole = $_SESSION['userrole'];
// First include the class definition

include('classes/salesorderClass.php');
include('classes/soliClass.php');
include('classes/reviewClass.php');

$userid = $_SESSION['user'];
//$companyrecnum = $_SESSION['companyrecnum'];
//$salespersonrecnum = $_REQUEST['salespersonrecnum'];
$companyrecnum = $_REQUEST['companyrecnum'];
// Next, create an instance of the class
$newreview = new review;
$newsalesorder= new salesorder;
$soli = new soli;
$so2customer = '';
$so2contact = '';
$so2employee = '';
$description = '';
$sales_order = '';
$order_date = '';
$due_date = '';
$special_instruction = '';
$quote_num = '';
$po_num = '';
$status = '';
$total_due = '';
$tax = '';
$labor = '';
$shipping = '';
$grosstotal = '';
$currency = '';
$resellnum = '';
$amendment = '';

// Database Connect
$newlogin = new userlogin;
$newlogin->dbconnect();
/*
if($pagename=='newso')
{
    $so2customer = $_REQUEST['companyrecnum'];
//    $so2contact = $_REQUEST['contactrecnum'];
//    $so2employee = $_REQUEST['salespersonrecnum'];
    $description = addslashes($_REQUEST['description']);
    $sales_order = $_REQUEST['sales_order'];
    $order_date = $_REQUEST['order_date'];
    $due_date = $_REQUEST['due_date'];
    $special_instruction = addslashes($_REQUEST['special_instruction']);
    $quote_num = $_REQUEST['quote_num'];
    $ponum = $_REQUEST['po_num'];
    $currency=$_REQUEST['currency'];
    $resellnum = $_REQUEST['resellnum'];
    $tax = $_REQUEST['tax'];
    $labor = $_REQUEST['labor'];
    $shipping=$_REQUEST['shipping'];
    $tax = $tax;
    $labor = $labor;
    $shipping = $shipping;
    $attach1 = $_REQUEST['attach1'];
    $attach2 = $_REQUEST['attach2'];
    $quotedate = $_REQUEST['quote_date'];
    $contact = $_REQUEST['contact'];
    $phone = $_REQUEST['phone'];
    $email = $_REQUEST['email'];
    $reviewrefrecnum = $_REQUEST['reviewrefrecnum'];
    $amendment = $_REQUEST['amendment'];
    $amendmentnum = $_REQUEST['amendmentnum'];
    $amendmentdate = $_REQUEST['amendmentdate'];
    
//------------------------------review request------------------------------//
    //$name = $_REQUEST["name"];
    //$ordernum = $_REQUEST["ordernum"];
    //$orddate = $_REQUEST["orderdate"];
    if(isset($_REQUEST["refno"]))
    {
       $refno = $_REQUEST["refno"];
    }
    else
    {
       $refno = '';
    }
    $ordertype = $_REQUEST["ordertype"];
    $orderfor = $_REQUEST["orderfor"];
    //$quotedate = $_REQUEST["quotedate"];
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
   // $quoterefnum = $_REQUEST["quoterefnum"];
    $path = $_REQUEST["path"];
    $quotation_det_store = $_REQUEST["quotation_det_store"];
    $risk_factors = $_REQUEST["risk_factors"];
    $requirements = $_REQUEST["requirements"];
    $explain_risk_factors = $_REQUEST["explain_risk_factors"];
    $quote_sentby = $_REQUEST["quote_sentby"];
    $quote_path = $_REQUEST["quote_path"];
    $enquiry_path = $_REQUEST["enquiry_path"];
    $data_for_enquiry = $_REQUEST["data_for_enquiry"];
    //$amendment_num = $_REQUEST['amendment_num'];
    //$amendment_date = $_REQUEST['amendment_date'];
    //$special_instrns = $_REQUEST['special_instrns'];
    //$status = $_REQUEST["status"];
    $valstatus = $_REQUEST["val_status"];
    $create_date = $_REQUEST["create_date"];
    $created_by = $_REQUEST["created_by"];
    $qa_approved = $_REQUEST["qa_app"];
    $engineering_approved = $_REQUEST["eng_app"];
    $qa_app = $_REQUEST["qa_app_by"];
    $eng_app = $_REQUEST["eng_app_by"];
    //$review_notes = $_REQUEST['notes'];


    $newsalesorder->setso2customer($so2customer);
    $newsalesorder->setdescription($description);
    $newsalesorder->setsales_order($sales_order);
    $newsalesorder->setorder_date($order_date);
    $newsalesorder->setdue_date($due_date);
    $newsalesorder->setspecial_instruction($special_instruction);
    $newsalesorder->setquote_num($quote_num);
    $newsalesorder->setresellnum($resellnum);
    $newsalesorder->setponum($ponum);
    $newsalesorder->settax($tax);
    $newsalesorder->setlabor($labor);
    $newsalesorder->setshipping($shipping);
    $newsalesorder->setgrosstotal($grosstotal);
    $newsalesorder->setcurrency($currency);
    $newsalesorder->setresellnum($resellnum);
    $newsalesorder->setattach1($attach1);
    $newsalesorder->setattach2($attach2);
    $newsalesorder->setquotedate($quotedate);
    $newsalesorder->setcontact($contact);
    $newsalesorder->setphone($phone);
    $newsalesorder->setemail($email);
    $newsalesorder->setreviewrefrecnum($reviewrefrecnum);
    $newsalesorder->setamendment($amendment);
    $newsalesorder->setamendment_num($amendmentnum);
    $newsalesorder->setamendment_date($amendmentdate);
    
 //------------------------------review set------------------------------//
 
    //$newreview->setname($name);
	//$newreview->setordernum($ordernum);
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
    //$newreview->setquoterefnum($quoterefnum);
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
    //$newreview->setorddate($orddate);
    //$newreview->setquote_date($quotedate);
    //$newreview->setamendment_num($amendment_num);
    //$newreview->setamendment_date($amendment_date);
    //$newreview->setspecial_instrns($special_instrns);
    //$newreview->setorderstatus($status);
    $newreview->setvalstatus($valstatus);
    $newreview->setcreate_date($create_date);
    $newreview->setcreated_by($created_by);
    $newreview->setqa_approved($qa_approved);
    $newreview->setengineering_approved($engineering_approved);
    $newreview->setqa_app_by($qa_app);
    $newreview->seteng_app_by($eng_app);
    
    
    $sql = "start transaction";
    $result = mysql_query($sql);
}*/

/*if($pagename=='quoteDetails')
{
//echo "inside if quoteDetails";
       //$quoteid=$_REQUEST['quoteid'];
       $quote_num=$_REQUEST['quoteid'];
       $order_date=$_REQUEST['quotedate'];
       $so2customer = $_REQUEST['companyrecnum'];
       $so2employee = $_REQUEST['salespersonrecnum'];
       $description=$_REQUEST['desc'];
       $due_date=$_REQUEST['delivarydate'];
       //$special_instruction=$_REQUEST['comments'];
       $quote_num=$_REQUEST['quoterecnum'];
       $currency=$_REQUEST['currency'];
       //$resellnum = $_REQUEST['resellnum'];

       $tax = $_REQUEST['tax'];
       $labor = $_REQUEST['labor'];
       $shipping=$_REQUEST['shipping'];

       $sales_order = 'so-' .  $_REQUEST['quoteid'];
}*/

/*
if ($pagename == 'newso') 
{
//echo "prosecc salesorder";

$crdate = date("d-M-y");
$i=1;
$soamount=0;
$rmsoamount=0;
$mcsoamount=0;
$totaldue=0;
$flag=0;
$sorecnum='';

while($i<41)
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
    $partiss="partiss" . $i;
   // $hcpartiss="hcpartiss" . $i;
    $po_cos="po_cos" . $i;
    $cos_iss="cos_iss" . $i;
  //  $hc_cos="hc_cos" . $i;
    $model_iss="model_iss" . $i;
    $drgiss="drgiss" . $i;
    $crn_num="crn_num" . $i;
    $condition="condition" . $i;
	$qty="qty" . $i;
	$price="price" . $i;
	$amount="amount" . $i;
	$rmprice="rmprice" . $i;
	$rmamount="rmamount" . $i;
	$mcprice="mcprice" . $i;
	$mcamount="mcamount" . $i;
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

    $partiss1 = $_REQUEST[$partiss];
   // $hcpartiss1 = $_REQUEST[$hcpartiss];
    $po_cos1 = $_REQUEST[$po_cos];
    $cos_iss1 = $_REQUEST[$cos_iss];
   // $hc_cos1 = $_REQUEST[$hc_cos];
    $model_iss1 = $_REQUEST[$model_iss];
    $drgiss1 = $_REQUEST[$drgiss];
    $condition1 = $_REQUEST[$condition];
	$qty1 = $_REQUEST[$qty];
	$price1 = $_REQUEST[$price];
	$amount1 = $_REQUEST[$amount];
	$rmprice1 = $_REQUEST[$rmprice];
	$rmamount1 = $_REQUEST[$rmamount];
	$mcprice1 = $_REQUEST[$mcprice];
	$mcamount1 = $_REQUEST[$mcamount];
	$crn_num1 = $_REQUEST[$crn_num];


//echo "\nI am linenumber1  :  " . $price1;
	if ($linenumber1 != '')
	{
 	      $amount1=0;
	      $amount1 = $price1 * $qty1;
              $rmamount1 = $rmprice1 * $qty1;
              $mcamount1 = $mcprice1 * $qty1;
	if ($pagename == 'newso')

    	{   //echo "\nI am linenumber1  :  " ;
			if($flag==0)
			{
				$j=1;
				while($j<41)
				{
                    $linetot="line_num" . $j;
					$qtytot="qty" . $j;
					$pricetot="price" . $j;
					$rmqtytot="qty" . $j;
					$rmpricetot="rmprice" . $j;
					$mcqtytot="qty" . $j;
					$mcpricetot="mcprice" . $j;
					if ( isset ( $_REQUEST[$linetot] ) ) {
					$linenumber2= $_REQUEST[$linetot];
					$qty2 = $_REQUEST[$qtytot];
					$price2 = $_REQUEST[$pricetot];
					$rmqty2 = $_REQUEST[$rmqtytot];
					$rmprice2 = $_REQUEST[$rmpricetot];
					$mcqty2 = $_REQUEST[$mcqtytot];
					$mcprice2 = $_REQUEST[$mcpricetot];
					if ($linenumber2 != '')
					{
						$amount2=0;
                                                $rmamount2=0;
                                                $mcamount2=0;
						$amount2 = $price2 * $qty2;
						$soamount= $soamount+$amount2;
						$rmamount2 = $rmprice2 * $qty2;
						$rmsoamount= $rmsoamount+$rmamount2;
						$mcamount2 = $mcprice2 * $qty2;
						$mcsoamount= $mcsoamount+$mcamount2;
						$tax1=$tax;
						$labor1=$labor;
						$shipping1=$shipping;
						$totaldue =$tax1+$labor1+$shipping1+$soamount;

					}
				 }
					$j++;
				}
				$newlogin = new userlogin;
				$newlogin->dbconnect();
                $newsalesorder->setgrosstotal($soamount);
                $newsalesorder->setrmtotal($rmsoamount);
                $newsalesorder->setmctotal($mcsoamount);
                $newsalesorder->settax($tax1);
                $newsalesorder->setlabor($labor1);
                $newsalesorder->setshipping($shipping1);
                $newsalesorder->settotal_due($totaldue);

                $reviewrecnum = $newreview->addreview($refno);
                $sorecnum = $newsalesorder->addSalesorder($reviewrecnum);

                if($amendment != '')
                {
                  $newsalesorder->addamendment($sorecnum);
                }
	   //echo "/n I am sorecnum  : " . $sorecnum;
				$flag=1;
			}
             
             $soli->setlink2so($sorecnum);
             $soli->setitem_num($linenumber1);
			 $soli->setitem_desc($itemdesc1);
             $soli->setpartnum($partnum1);
             $soli->setrmtype($rmtype1);
             $soli->setrmspec($rmspec1);
			 $soli->setuom($uom1);
			 $soli->setdia($dia1);
			 $soli->setlength($length1);
			 $soli->setwidth($width1);
			 $soli->setthickness($thickness1);
			 $soli->setgf($gf1);
			 $soli->setmaxruling($maxruling1);
			 $soli->setaltspec($altspec1);

             $soli->setpartiss($partiss1);
            // $soli->sethcpartiss($hcpartiss1);
             $soli->setpo_cos($po_cos1);
             $soli->setcos_iss($cos_iss1);
            //$soli->sethc_cos($hc_cos1);
             $soli->setmodel_iss($model_iss1);
             $soli->setdrgiss($drgiss1);
             $soli->setcondition($condition1);
			 $soli->setqty($qty1);
			 $soli->setprice($price1);
			 $soli->setamount($amount1);
			 $soli->setrmprice($rmprice1);
			 $soli->setrmamount($rmamount1);
			 $soli->setmcprice($mcprice1);
			 $soli->setmcamount($mcamount1);
			 $soli->setcrn_num($crn_num1);
		     $soli->setponum($ponum);
			 $soli->addQI();

		}
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
		 die("Commit failed Sales Oreder Insert..Please report to Sysadmin. " . mysql_errno());
	   }
}*/

if ($pagename== 'edit_custpoedit')
{
   $salesorderrecnum  = $_REQUEST['salesorderrecnum'] ;
   //echo "I am inside edit_custpoeditooo";
   $so2customer = $_REQUEST['companyrecnum'];
   $description = addslashes($_REQUEST['description']);
   $phone = $_REQUEST['phone'];
   $email = $_REQUEST['email'];
//   $sales_order = $_REQUEST['sales_order'];
   $order_date = $_REQUEST['order_date'];
   $special_instruction = addslashes($_REQUEST['special_instruction']);
   $quote_num = $_REQUEST['quote_num'];
//   $resellnum = $_REQUEST['resellnum'];
   $ponum = $_REQUEST['po_num'];
   
    $tax = $_REQUEST['tax'];
    $labor = $_REQUEST['labor'];
    $shipping=$_REQUEST['shipping'];

    $attach1 = $_REQUEST['attach1'];
    $attach2 = $_REQUEST['attach2'];
//    $quotedate = $_REQUEST['quote_date'];
    $contact = $_REQUEST['contact'];
    $amendment = $_REQUEST['amendment'];
    $amendmentnum = $_REQUEST['amendmentnum'];
    $amendmentdate = $_REQUEST['amendmentdate'];
	$status = $_REQUEST['status'];
	//echo 'status='.$status;
    $reviewrefrecnum = $_REQUEST['reviewrefrecnum'];

    $tax = $tax;
    $labor = $labor;
    $shipping = $shipping;
    
//--------------------------Review request------------------------//

    //$name = $_REQUEST["name"];
    //$ordernum = $_REQUEST["ordernum"];
    //$orddate = $_REQUEST["orderdate"];
    $ordertype = $_REQUEST["ordertype"];
    $orderfor = $_REQUEST["orderfor"];
    //$quotedate = $_REQUEST["quotedate"];
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
   // $quoterefnum = $_REQUEST["quoterefnum"];
    $path = $_REQUEST["path"];
    $quotation_det_store = $_REQUEST["quotation_det_store"];
    $risk_factors = $_REQUEST["risk_factors"];
    $requirements = $_REQUEST["requirements"];
    $explain_risk_factors = $_REQUEST["explain_risk_factors"];
    $quote_sentby = $_REQUEST["quote_sentby"];
    $quote_path = $_REQUEST["quote_path"];
    $enquiry_path = $_REQUEST["enquiry_path"];
    $data_for_enquiry = $_REQUEST["data_for_enquiry"];
  //  $amendment_num = $_REQUEST['amendment_num'];
  //  $amendment_date = $_REQUEST['amendment_date'];
  //  $special_instrns = $_REQUEST['special_instrns'];
    //$status = $_REQUEST["status"];
    $valstatus = $_REQUEST["val_status"];
    $create_date = $_REQUEST["create_date"];
    $created_by = $_REQUEST["created_by"];
    $qa_approved = $_REQUEST["qa_app"];
    $engineering_approved = $_REQUEST["eng_app"];
    $review_notes = $_REQUEST['notes'];
    $reviewrecnum  = $_REQUEST['reviewrecnum'];
    $qa_app = $_REQUEST["qa_app_by"];
    $eng_app = $_REQUEST["eng_app_by"];

	
	$prodn_app = $_REQUEST["prodn_app"];
	$prodn_app_by = $_REQUEST["prodn_app_by"];

   
   $sql = "start transaction";
   $result = mysql_query($sql);
   $newsalesorder->setso2customer($so2customer);
   $newsalesorder->setso2contact($so2contact);
   $newsalesorder->setso2employee($so2employee);
   $newsalesorder->setdescription($description);
   $newsalesorder->setphone($phone);
   $newsalesorder->setemail($email);
//   $newsalesorder->setsales_order($sales_order);
   $newsalesorder->setorder_date($order_date);
   $newsalesorder->setdue_date($due_date);
   $newsalesorder->setcurrency($currency);
   $newsalesorder->setspecial_instruction($special_instruction);
   $newsalesorder->setquote_num($quote_num);
   $newsalesorder->setresellnum($resellnum);
   $newsalesorder->setponum($ponum);
   $newsalesorder->setcontact($contact);

    $newsalesorder->setattach1($attach1);
    $newsalesorder->setattach2($attach2);
//    $newsalesorder->setquotedate($quotedate);
    $newsalesorder->setamendment($amendment);
    $newsalesorder->setamendment_num($amendmentnum);
    $newsalesorder->setamendment_date($amendmentdate);
	$newsalesorder->setstatus($status);
    $newsalesorder->setreviewrefrecnum($reviewrecnum);
    
//------------------------------Review set-------------------------//
    //$newreview->setname($name);
	//$newreview->setordernum($ordernum);
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
    //$newreview->setquoterefnum($quoterefnum);
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
    $newreview->setvalstatus($valstatus);
    $newreview->setcreate_date($create_date);
    $newreview->setcreated_by($created_by);
    $newreview->setqa_approved($qa_approved);
    $newreview->setengineering_approved($engineering_approved);
    $newreview->setqa_app_by($qa_app);
    $newreview->seteng_app_by($eng_app);

	$newreview->setprodn_app($prodn_app);
	$newreview->setprodn_app_by($prodn_app_by);

    $newreview->addNotes($reviewrecnum,$review_notes);
    
   $soamount=0;
   $rmsoamount=0;
   $mcsoamount=0;
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
    $partiss="partiss" . $i;
    $hcpartiss="hcpartiss" . $i;
    $po_cos="po_cos" . $i;
    $hc_cos="hc_cos" . $i;
    $cos_iss="cos_iss" . $i;
    $model_iss="model_iss" . $i;
    $drgiss="drgiss" . $i;
    $hcdrgiss="hcdrgiss" . $i;
	$qty="qty" . $i;
	$crn_num="crn_num" . $i;
	$condition="condition" . $i;
	$price="price" . $i;
	$amount="amount" . $i;
	$rmprice="rmprice" . $i;
	$rmamount="rmamount" . $i;
	$mcprice="mcprice" . $i;
	$mcamount="mcamount" . $i;
	$prevlinenum="prev_line_num" . $i;
	$lirecnum="lirecnum" . $i;

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
    $crn_num1 = $_REQUEST[$crn_num];
    $condition1 = $_REQUEST[$condition];
    $partiss1 = $_REQUEST[$partiss];
    $hcpartiss1 = $_REQUEST[$hcpartiss];
    $po_cos1 = $_REQUEST[$po_cos];
    $hc_cos1 = $_REQUEST[$hc_cos];
    $cos_iss1 = $_REQUEST[$cos_iss];
    $model_iss1 = $_REQUEST[$model_iss];
    $drgiss1 = $_REQUEST[$drgiss];
    $hcdrgiss1 = $_REQUEST[$hcdrgiss];
	$qty1 = $_REQUEST[$qty];
	$price1 = $_REQUEST[$price];
	$rmprice1 = $_REQUEST[$rmprice];
	$mcprice1 = $_REQUEST[$mcprice];
	$newlogin = new userlogin;
	$newlogin->dbconnect();

	if ($linenumber1 != '')
	{
//echo "\nIam inside linenumber1  : " . $linenumber1 ;
		$amount1=0;
		$amount1 = $price1 * $qty1;
                $rmamount1 = $rmprice1 * $qty1;
                $mcamount1 = $mcprice1 * $qty1;
			if($flag==0)
			{
				$j=1;
				while($j<$max)
				{
                	$linetot="line_num" . $j;
					$qtytot="qty" . $j;
					$ratetot="price" . $j;
					$linenumber2= $_REQUEST[$linetot];
					$qty2 = $_REQUEST[$qtytot];
					$price2 = $_REQUEST[$ratetot];

                    $rmratetot="rmprice" . $j;
					$rmprice2 = $_REQUEST[$rmratetot];

					$mcratetot="mcprice" . $j;
					$mcprice2=$_REQUEST[$mcratetot];

                   if ($linenumber2 != '')
					{
						$amount2=0;
						$amount2 = $price2 * $qty2;
						$soamount=$soamount+$amount2;
						$rmamount2 = $rmprice2 * $qty2;
						$rmsoamount= $rmsoamount+$rmamount2;
						$mcamount2 = $mcprice2 * $qty2;
						$mcsoamount= $mcsoamount+$mcamount2;
                        $tax1= $tax;
						$labor1=$labor;
						$shipping1=$shipping;
						$totaldue =$tax1+$labor1+$shipping1+$soamount;

					}
					$j++;
				}

                $newsalesorder->setgrosstotal($soamount);
                $newsalesorder->setrmtotal($rmsoamount);
                $newsalesorder->setmctotal($mcsoamount);
                $newsalesorder->settax($tax1);
                $newsalesorder->setlabor($labor1);
                $newsalesorder->setshipping($shipping1);
                $newsalesorder->settotal_due($totaldue);
//echo "Grosstotal is $totaldue";
				$sql = "start transaction";
				$result = mysql_query($sql);
				$newreview->updatereview($reviewrecnum);
				$newsalesorder->updateSalesorder($salesorderrecnum);
				
				if($amendment != '')
				{
				  $newsalesorder->addamendment($salesorderrecnum);
				}
				$flag=1;
			}
			 $soli->setlink2so($salesorderrecnum);
			 $soli->setitem_num($linenumber1);
			 $soli->setitem_desc($itemdesc1);
             $soli->setpartnum($partnum1);
             $soli->setrmtype($rmtype1);
             $soli->setrmspec($rmspec1);
			 $soli->setuom($uom1);
			 $soli->setdia($dia1);
			 $soli->setlength($length1);
			 $soli->setwidth($width1);
			 $soli->setthickness($thickness1);
			 $soli->setgf($gf1);
			 $soli->setmaxruling($maxruling1);
			 $soli->setaltspec($altspec1);
             $soli->setpartiss($partiss1);
            // $soli->sethcpartiss($hcpartiss1);
             $soli->setpo_cos($po_cos1);
            // $soli->sethc_cos($hc_cos1);
             $soli->setcos_iss($cos_iss1);
             $soli->setmodel_iss($model_iss1);
             $soli->setdrgiss($drgiss1);
             $soli->setcondition($condition1);
			 $soli->setqty($qty1);
			 $soli->setprice($price1);
			 $soli->setamount($amount1);
			 $soli->setrmprice($rmprice1);
			 $soli->setrmamount($rmamount1);
			 $soli->setmcprice($mcprice1);
			 $soli->setmcamount($mcamount1);
		     $soli->setcrn_num($crn_num1);
		     $soli->setponum($ponum);
			// echo "prevlinenum1  :  " . $prevlinenum1;
             if($prevlinenum1!='')
			 {
				//echo "update";
			 	$soli->updateQI($lirecnum1);

			 }
			 else
			 {
				//echo "Add";
                $soli->addQI();
			 }
	}
	else
	{
		 if ($prevlinenum1 != '')
		 {
		// echo "Delete";
			    $soli->deleteLI($lirecnum1);
		  }
	}
	 $sql = "commit";
	 $result = mysql_query($sql);
     if(!$result)
	 {
		 $sql = "rollback";
		 $result = mysql_query($sql);
		 die("Commit failed SO Insert..Please report to Sysadmin. " . mysql_errno());
	 }
$i++;
}
$salesorderrecnum = $_REQUEST['salesorderrecnum'];
if ($_SESSION['pagename'] == 'edit_custpoedit') {
    $delete = $_REQUEST['deleteflag'];
}
if ($pagename == 'edit_custpoedit' && $delete == 'y') {
           $newsalesorder->deleteSalesorder($salesorderrecnum);
}
}

/*if ($pagename == 'soDetails')
{
  $salesorderrecnum = $_REQUEST['salesorderrecnum'];
  $reviewrecnum  = $_REQUEST['reviewrecnum'] ;
  $newreview->updateval_status($reviewrecnum);
}*/
/*if($pagename == 'edit_custpoedit4app')
{
    $status = $_REQUEST['status'];
    $qa_approved = $_REQUEST["qa_app"];
    $engineering_approved = $_REQUEST["eng_app"];
    $reviewrecnum  = $_REQUEST['reviewrecnum'];
    //echo $reviewrecnum;
    $salesorderrecnum = $_REQUEST['salesorderrecnum'];
    $qa_app = $_REQUEST["qa_app_by"];
    $eng_app = $_REQUEST["eng_app_by"];
    $review_notes = $_REQUEST['notes'];
  
    $newsalesorder->setstatus($status);
    $newreview->setqa_approved($qa_approved);
    $newreview->setengineering_approved($engineering_approved);
    $newreview->setqa_app_by($qa_app);
    $newreview->seteng_app_by($eng_app);
    $newreview->upQaApp($reviewrecnum);
    $newsalesorder->updateSales4Status($salesorderrecnum);
    $newreview->upQaApp($reviewrecnum);
    $newreview->addNotes($reviewrecnum,$review_notes);
}*/
$submit_type = $_REQUEST['stype'];
if ($pagename == 'edit_custpoedit')
{
   header("Location:viewsoDetails.php?salesorderrecnum=$salesorderrecnum");
}
else 
{
    header("Location:salesorder.php");
}
?>