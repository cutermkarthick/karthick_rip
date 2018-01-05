<?php
//==============================================
// Author: FSI                                 =
// Date-written = Dec 7, 2006                  =
// Filename: processInvoice.php                =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OWT                          =
// Process of Invoice                          =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];

$pagename = $_SESSION['pagename'];

include('classes/invoiceClass.php');
include('classes/invoiceliClass.php');

// Next, create an instance of the classes required
$newinvoice = new invoice;
$newLI = new invoiceli;


//Delete a perticular invoice
if ($pagename == 'invoicepayment')
 {
       $invoicerecnum = $_REQUEST['invoicerecnum'];
       $totaldue = $_REQUEST['totaldue'];
       $payment_amount = $_REQUEST['payment_amount'];
       $payment_date = $_REQUEST['payment_date'];
       $ref_num = $_REQUEST['ref_num'];
       //$link2invoice =  $_REQUEST['invoicerecnum'];
       //echo "invoicerecnum" . $invoicerecnum;
       $status='';

            $newlogin = new userlogin;
			$newlogin->dbconnect();
  				$newinvoice->setpayment_amount($payment_amount);
		  		$newinvoice->setpayment_date($payment_date);
		  		$newinvoice->setref_num($ref_num);
			   	$newinvoice->setlink2invoice($invoicerecnum);
			   	$newinvoice->setstatus($status);

       $newinvoice->Invoicepayment($totaldue,$payment_amount,$invoicerecnum);
       header("Location:invoiceSummary.php" );

 }

if ($pagename == 'editinvoice')
 {
    $delete = $_REQUEST['deleteflag'];
    if ($delete == 'y')
      {
      $invoicerecnum = $_REQUEST['invoicerecnum'];
       $newinvoice->deleteInvoice($invoicerecnum);
       header("Location:invoiceSummary.php" );
      }
 }

$subtotal = '';
$salestax = '';
$shipping = '';
$total = '';

// Get all fields related to invoice
if ($pagename == 'newinvoice') {
   $max=$_REQUEST['index'];
   $invnum = $_REQUEST['invnum'];
   $invdate = $_REQUEST['invdate'];
   $duedate = $_REQUEST['duedate'];
   $invdesc = $_REQUEST['invdesc'];
   $terms = $_REQUEST['terms'];
   $inv2customer = $_REQUEST['companyrecnum'];
 //echo  "inv2customer" .  $inv2customer;
   $customerponum = $_REQUEST['customerponum'];

}
if ($pagename == 'newinvoice') {
$crdate = date("d-M-y");
$i=1;
$salestax = '';
$shipping = '';
$totalamount='';
$total=0;
$flag=0;
while($i<$max)
{
	$linenumber="linenum" . $i;
	$itemid="item_id" . $i;
	$itemdesc="item_desc" . $i;
	$qty="qty" . $i;
	$um="um" . $i;
	$disc_perc="disc_perc" . $i;
	$rate="rate" . $i;
	$amount="amount" . $i;

	$linenumber1= $_REQUEST[$linenumber];
	$itemid1 = $_REQUEST[$itemid];
	$itemdesc1 = $_REQUEST[$itemdesc];
	$disc_perc1 = $_REQUEST[$disc_perc];
	$um1 = $_REQUEST[$um];
	$qty1 = $_REQUEST[$qty];
	$rate1 = $_REQUEST[$rate];
    $amount1=$_REQUEST[$amount];

	if ($linenumber1 != '')
	{
		$amount1=0;
		$amount1 = $rate1 * $qty1;
		//echo "linenumber   :$linenumber1<br>amount      :$amount1</br>";
		if ($pagename == 'newinvoice')
		{
			if($flag==0)
			{
				$j=1;
				while($j<$max)
				{
					$linetot="linenum" . $j;
					$qtytot="qty" . $j;
					$ratetot="rate" . $j;
					$linenumber2= $_REQUEST[$linetot];
					$qty2 = $_REQUEST[$qtytot];
					$rate2 = $_REQUEST[$ratetot];
					if ($linenumber2 != '')
					{
					    $amount2=0;
						$amount2 = $rate2 * $qty2;
						$totalamount= $totalamount+$amount2;
						$salestax= $totalamount*0.1;
						$shipping=$totalamount*0.1;
						$total =$salestax+$shipping+$totalamount;
						$totaldue=$total;

					}
					$j++;
				}
				$newlogin = new userlogin;
				$newlogin->dbconnect();
  				$newinvoice->setinvnum($invnum);
		  		$newinvoice->setinvdate($invdate);
			   	$newinvoice->setduedate($duedate);
   				$newinvoice->setinvdesc($invdesc);
	  			$newinvoice->setterms($terms);
		   	  //$newinvoice->setstatus($status);
		   		$newinvoice->setinv2customer($inv2customer);
		   		$newinvoice->setcustomerponum($customerponum);
                $newinvoice->setsubtotal($totalamount);
                $newinvoice->setshipping($shipping);
                $newinvoice->setsalestax($salestax);
                $newinvoice->settotal($total);
                $newinvoice->settotaldue($totaldue);

				$sql = "start transaction";
				$result = mysql_query($sql);
				$invoicerecnum = $newinvoice->addInvoice();
				$flag=1;
				//echo "PO Amount is     :$poamount";
			}
			 $newLI->setlink2invoice($invoicerecnum);
			 $newLI->setline_num($linenumber1);
			 $newLI->setitem_id($itemid1);
			 $newLI->setitem_desc($itemdesc1);
			 $newLI->setqty($qty1);
			 $newLI->setum($um1);
			 $newLI->setdisc_perc($disc_perc1);
			 $newLI->setrate($rate1);
			 $newLI->setamount($amount1);
			 $newLI->addInvoiceli();
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
header("Location:invoiceSummary.php" );
}


if ($pagename == 'editinvoice')
 {
//echo "i am inside editinvoice";
  // $max=$_REQUEST['index'];
   $invoicerecnum = $_REQUEST['invoicerecnum'];
   $invnum = $_REQUEST['invnum'];
   $invdate = $_REQUEST['invdate'];
   $duedate = $_REQUEST['duedate'];
   $invdesc = $_REQUEST['invdesc'];
   $terms = $_REQUEST['terms'];
   $link2invoice = $_REQUEST['invoicerecnum'];
   $inv2customer = $_REQUEST['companyrecnum'];
   $customerponum = $_REQUEST['customerponum'];
$crdate = date("d-M-y");
$i=1;
$totalamount=0;
$shipping='';
$salestax='';
$flag=0;
while($i<=10)
{
	//echo "i am inside while loop";
	$linenumber="line_num" . $i;
	$itemid="item_id" . $i;
	$itemdesc="item_desc" . $i;
	$qty="qty" . $i;
	$um="um" . $i;
	$disc_perc="disc_perc" . $i;
	$rate="rate" . $i;
	$prelinenum="prev_line_num" . $i;
	$lirecnum="lirecnum" . $i;
	$lirecnum1=$_REQUEST[$lirecnum];
	$prevlinenum1=$_REQUEST[$prelinenum];
	$linenumber1= $_REQUEST[$linenumber];
	$itemid1 = $_REQUEST[$itemid];
	$itemdesc1 = $_REQUEST[$itemdesc];
	$qty1 = $_REQUEST[$qty];
	$um1 = $_REQUEST[$um];
	$disc_perc1 = $_REQUEST[$disc_perc];
	$qty1 = $_REQUEST[$qty];
	$rate1 = $_REQUEST[$rate];
				$newlogin = new userlogin;
				$newlogin->dbconnect();
	if ($linenumber1 != '')
	{
		//echo "<br>this is line no   :$linenumber1";
		$amount1=0;
		$amount1 = $rate1 * $qty1;
			if($flag==0)
			{
				$j=1;
				while($j<=10)
				{
					$linetot="line_num" . $j;
					$qtytot="qty" . $j;
					$ratetot="rate" . $j;
					$linenumber2= $_REQUEST[$linetot];
					$qty2 = $_REQUEST[$qtytot];
					$rate2 = $_REQUEST[$ratetot];
					if ($linenumber2 != '')
					{
                    	$amount2=0;
						$amount2 = $rate2 * $qty2;
						$totalamount= $totalamount+$amount2;
						$salestax= $totalamount*0.1;
						$shipping=$totalamount*0.1;
						$total =$salestax+$shipping+$totalamount;
						$totaldue=$total;
					}
					$j++;
				}
  				$sql = "start transaction";
 				$result = mysql_query($sql);

                $newinvoice->setinvnum($invnum);
		  		$newinvoice->setinvdate($invdate);
			   	$newinvoice->setduedate($duedate);
   				$newinvoice->setinvdesc($invdesc);
	  			$newinvoice->setterms($terms);
		   		$newinvoice->setinv2customer($inv2customer);
		   		$newinvoice->setcustomerponum($customerponum);
                $newinvoice->setsubtotal($totalamount);
                $newinvoice->setshipping($shipping);
                $newinvoice->setsalestax($salestax);
                $newinvoice->settotal($total);
                $newinvoice->settotaldue($totaldue);
                $newinvoice->updateInvoice($invoicerecnum);
				$flag=1;
			}
             $newLI->setlink2invoice($invoicerecnum);
			 $newLI->setline_num($linenumber1);
			 $newLI->setitem_id($itemid1);
			 $newLI->setitem_desc($itemdesc1);
			 $newLI->setqty($qty1);
			 $newLI->setum($um1);
			 $newLI->setdisc_perc($disc_perc1);
			 $newLI->setrate($rate1);
			 $newLI->setamount($amount1);

			 if($prevlinenum1!=='')
			{
			 	$newLI->updateInvoiceli($lirecnum1);
			}
			else
			{
				//echo "i am here adding";
				$newLI->setlink2invoice($invoicerecnum);
        		$newLI->addInvoiceli();
			}
	}
	else
	{
		 if ($prevlinenum1 != '')
		 {
			//echo "i am here deleting";
			 $newLI->deleteInvoiceli($lirecnum1);
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

header("Location:invoiceSummary.php" );

?>