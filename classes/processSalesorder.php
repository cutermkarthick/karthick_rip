<?php
//
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
// First include the class definition

include('classes/salesorderClass.php');
include('classes/soliClass.php');

$userid = $_SESSION['user'];
//$companyrecnum = $_SESSION['companyrecnum'];
//$salespersonrecnum = $_REQUEST['salespersonrecnum'];
$companyrecnum = $_REQUEST['companyrecnum'];
// Next, create an instance of the class
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

if($pagename=='newso'){
    $so2customer = $_REQUEST['companyrecnum'];
//    $so2contact = $_REQUEST['contactrecnum'];
//    $so2employee = $_REQUEST['salespersonrecnum'];
    $description = $_REQUEST['description'];
    $sales_order = $_REQUEST['sales_order'];
    $order_date = $_REQUEST['order_date'];
    $due_date = $_REQUEST['due_date'];
    $special_instruction = $_REQUEST['special_instruction'];
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

    $newsalesorder->setso2customer($so2customer);
//    $newsalesorder->setso2contact($so2contact);
//    $newsalesorder->setso2employee($so2employee);
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
    
    $sql = "start transaction";
    $result = mysql_query($sql);
}

if($pagename=='quoteDetails'){
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

}


if ($pagename == 'newso') {

//echo "prosecc salesorder";

$crdate = date("d-M-y");
$i=1;
$soamount=0;
$rmsoamount=0;
$mcsoamount=0;
$totaldue=0;
$flag=0;
$sorecnum='';

while($i<15)
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
  //  $hc_cos="hc_cos" . $i;
    $model_iss="model_iss" . $i;
    $drgiss="drgiss" . $i;
   // $hcdrgiss="hcdrgiss" . $i;
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
   // $hc_cos1 = $_REQUEST[$hc_cos];
    $model_iss1 = $_REQUEST[$model_iss];
    $drgiss1 = $_REQUEST[$drgiss];
   // $hcdrgiss1 = $_REQUEST[$hcdrgiss];
	$qty1 = $_REQUEST[$qty];
	$price1 = $_REQUEST[$price];
	$amount1 = $_REQUEST[$amount];
	$rmprice1 = $_REQUEST[$rmprice];
	$rmamount1 = $_REQUEST[$rmamount];
	$mcprice1 = $_REQUEST[$mcprice];
	$mcamount1 = $_REQUEST[$mcamount];


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
				while($j<15)
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


                $sorecnum = $newsalesorder->addSalesorder();

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
            //$soli->sethc_cos($hc_cos1);
             $soli->setmodel_iss($model_iss1);
             $soli->setdrgiss($drgiss1);
            // $soli->sethcdrgiss($hcdrgiss1);
			 $soli->setqty($qty1);
			 $soli->setprice($price1);
			 $soli->setamount($amount1);
			 $soli->setrmprice($rmprice1);
			 $soli->setrmamount($rmamount1);
			 $soli->setmcprice($mcprice1);
			 $soli->setmcamount($mcamount1);
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
}

if ($pagename== 'editso')
{
   $salesorderrecnum  =$_REQUEST['salesorderrecnum'] ;
   //echo "I am inside editsoooo";
   $so2customer = $_REQUEST['companyrecnum'];
//   $so2contact = $_REQUEST['contactrecnum'];
//   $so2employee = $_REQUEST['salespersonrecnum'];
   $description = $_REQUEST['description'];
   $phone = $_REQUEST['phone'];
   $email = $_REQUEST['email'];
//   $sales_order = $_REQUEST['sales_order'];
   $order_date = $_REQUEST['order_date'];
//   $due_date = $_REQUEST['due_date'];
//   $currency = $_REQUEST['currency'];
   $special_instruction = $_REQUEST['special_instruction'];
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
    $reviewrefrecnum = $_REQUEST['reviewrefrecnum'];

    $tax = $tax;
    $labor = $labor;
    $shipping = $shipping;
   
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
    $newsalesorder->setreviewrefrecnum($reviewrefrecnum);
   $newsalesorder->updateSalesorder($salesorderrecnum);
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
    $model_iss="model_iss" . $i;
    $drgiss="drgiss" . $i;
    $hcdrgiss="hcdrgiss" . $i;
	$qty="qty" . $i;
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

    $partiss1 = $_REQUEST[$partiss];
    $hcpartiss1 = $_REQUEST[$hcpartiss];
    $po_cos1 = $_REQUEST[$po_cos];
    $hc_cos1 = $_REQUEST[$hc_cos];
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
             $soli->setmodel_iss($model_iss1);
             $soli->setdrgiss($drgiss1);
           //  $soli->sethcdrgiss($hcdrgiss1);
			 $soli->setqty($qty1);
			 $soli->setprice($price1);
			 $soli->setamount($amount1);
			 $soli->setrmprice($rmprice1);
			 $soli->setrmamount($rmamount1);
			 $soli->setmcprice($mcprice1);
			 $soli->setmcamount($mcamount1);
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
if ($_SESSION['pagename'] == 'editso') {
    $delete = $_REQUEST['deleteflag'];
}
if ($pagename == 'editso' && $delete == 'y') {
           $newsalesorder->deleteSalesorder($salesorderrecnum);

}

}

if ($pagename == 'editso') {
    header("Location:soDetails.php?salesorderrecnum=$salesorderrecnum");
}
else {
    header("Location:salesorder.php");
}

?>
