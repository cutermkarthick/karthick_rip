<?php
//==============================================
// Author: FSI                                 =
// Date-written = July 21, 2011                  =
// Filename: invoiceProcess.php                =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OWT                          =
// Processing of Invoice                          =
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

$companyname = 'MAHINDRA AEROSTRUCTURES PVT. LTD' ;
$companyname1 = 'Aerostructures Assemblies India Pvt.Ltd' ;
$companyname2 = 'Dynamatic Technologies Limited' ;


// Next, create an instance of the classes required
$newinvoice = new invoice;
$newLI = new invoiceli;
$temp=0;
 //echo $pagename."-*********";
//Delete a perticular invoice
if($pagename == 'invoice_payment')
{
       $invoicerecnum = $_REQUEST['invoicerecnum'];
       $totaldue = $_REQUEST['totaldue'];

       $payment_amount = $_REQUEST['payment_amount'];
       $payment_date = $_REQUEST['payment_date'];
       $ref_num = $_REQUEST['ref_num'];
       //$link2invoice =  $_REQUEST['invoicerecnum'];
       //echo "invoicerecnum" . $invoicerecnum;
       $awbnum = $_REQUEST['awbnum'];
       $awbdate = $_REQUEST['awbdate'];
       $duedate = $_REQUEST['duedate'];
       $fircnum = $_REQUEST['fircnum'];
       $fircdate = $_REQUEST['fircdate'];
       $shipdate = $_REQUEST['shipdate'];
       $status='';

            $newlogin = new userlogin;
			$newlogin->dbconnect();
  				$newinvoice->setpayment_amount($payment_amount);
		  		$newinvoice->setpayment_date($payment_date);
		  		$newinvoice->setref_num($ref_num);
			   	$newinvoice->setlink2invoice($invoicerecnum);
			   	$newinvoice->setstatus($status);

       $newinvoice->Invoicepayment($totaldue,$payment_amount,$invoicerecnum);
       $newinvoice->updateinvoicedetails($awbnum,$awbdate,$duedate,$fircnum,$fircdate,$invoicerecnum,$shipdate);
       header("Location:invoicepaymentReport.php" );
}
if ($pagename == 'editinvoice')
 {
    $delete = $_REQUEST['deleteflag'];
    if ($delete == 'y')
      {
        $invoicerecnum = $_REQUEST['invoicerecnum'];
        $newinvoice->deleteInvoice($invoicerecnum);
        $newLI->deleteInvoiceliflag($invoicerecnum);
        header("Location:invoiceSummary.php" );
      }
 }
$subtotal = '';
$salestax = '';
$shipping = '';
$total = '';

// Get all fields related to invoice
if ($pagename == 'newinvoice') 
{
   $max=$_REQUEST['index'];
   $invnum = $_REQUEST['invnum'];
   $company  = $_REQUEST['company'];
   $invdate = $_REQUEST['invdate'];
   $invdesc = $_REQUEST['invdesc'];
   $duedate = $_REQUEST['duedate'];
   $status = $_REQUEST['status'];
   $terms = $_REQUEST['terms'];
   $precarrigeby = $_REQUEST['precarriageby'];
   $precarrierreceipt = $_REQUEST['precarrierreceipt'];
   $countryoforigin = $_REQUEST['countryoforigin'];
   $countryoffinaldest = $_REQUEST['countryoffinaldest'];
   $vessel = $_REQUEST['vessel'];
   $portofloading = $_REQUEST['portofloading'];
   $portofdischarge = $_REQUEST['portofdischarge'];
   $packages = $_REQUEST['packages'];
   $inv2customer = $_REQUEST['companyrecnum'];
   $inv2shipping = $_REQUEST['shippingcompanyrecnum'];
 //echo  "inv2customer" .  $inv2shipping;
   $customerponum = $_REQUEST['customerponum'];
   $currency= $_REQUEST['currency'];
   $fobcf= $_REQUEST['fobcf'];
   $remarks = $_REQUEST['remarks'];
   $dcnum= $_REQUEST['dcnum'];
   $dcdate = $_REQUEST['dcdate'];
 //echo  "customerpo num is " .  $customerponum;
}
if ($pagename == 'newinvoice') 
{
$crdate = date("d-M-y");
$i=1;

$salestax = '';
$shipping = '';
$totalamount='';
$total=0;
$flag=0;
while($i<$max)
{
	$linenumber="line_num" . $i;
	$cofc="cofc" . $i;
	$itemdesc="item_desc" . $i;
	$qty="qty" . $i;
	$crn="crn" . $i;
	$partnum="partnum" . $i;
	$tariffsch="tariffsch" . $i;
	$rawmtl="rawmtl" . $i;
	$packaging="packaging" . $i;
	$ponum="ponum" . $i;
	$rate="rate" . $i;
	$amount="amount" . $i;
	$type="type" . $i;
    $po_qty="po_qty" . $i;
    $numpkgs ="numpkgs".$i;
    $polinenum ="polinenum".$i;
    $schpo ="schpo".$i;
	$linenumber1= $_REQUEST[$linenumber];
	$cofc1 = $_REQUEST[$cofc];
	$itemdesc1 = $_REQUEST[$itemdesc];
	$qty1 = $_REQUEST[$qty];
	$crn1 = $_REQUEST[$crn];
	$partnum1 = $_REQUEST[$partnum];
	$rawmtl1 = $_REQUEST[$rawmtl];
	$tariffsch1 = $_REQUEST[$tariffsch];
	$packaging1 = $_REQUEST[$packaging];
	$ponum1 = $_REQUEST[$ponum];
	$rate1 = $_REQUEST[$rate];
	$type1 = $_REQUEST[$type];
    $amount1=$_REQUEST[$amount];
    $po_qty1=$_REQUEST[$po_qty];
    $polinenum1=$_REQUEST[$polinenum];
    $schpo=$_REQUEST[$schpo];

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
						$salestax= $totalamount*0;
						$shipping=$totalamount*0;
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
	    	   	$newinvoice->setprecarriageby($precarrigeby);
			   	$newinvoice->setprecarrierreceipt($precarrierreceipt);
			   	$newinvoice->setcountryoforigin($countryoforigin);
			   	$newinvoice->setcountryoffinaldest($countryoffinaldest);
			   	$newinvoice->setvessel($vessel);
			   	$newinvoice->setportofloading($portofloading);
			   	$newinvoice->setportofdischarge($portofdischarge);
			   	$newinvoice->setpackages($packages);
		   	    $newinvoice->setstatus($status);
		   		$newinvoice->setinv2customer($inv2customer);
				$newinvoice->setinv2shipping($inv2shipping);
                $newinvoice->setcustomerponum($customerponum);
                $newinvoice->setsubtotal($totalamount);
                $newinvoice->setshipping($shipping);
                $newinvoice->setsalestax($salestax);
                $newinvoice->settotal($total);
                $newinvoice->settotaldue($totaldue);
				$newinvoice->setcurrency($currency);
                $newinvoice->setfobcf($fobcf);
                $newinvoice->setdcnum($dcnum);
                $newinvoice->setdcdate($dcdate);
                $newinvoice->setremarks($remarks);


				$sql = "start transaction";
				$result = mysql_query($sql);

				$invoicerecnum = $newinvoice->addInvoice();

                $newinvoice->updatecompanyremarks($remarks,$inv2customer,$terms);
				$flag=1;
				//echo "PO Amount is     :$poamount";
			}
             $newLI->setlink2invoice($invoicerecnum);
			 $newLI->setline_num($linenumber1);
			 $newLI->setcrn($crn1);
			 $newLI->setdescr($itemdesc1);
			 $newLI->setpartnum($partnum1);
			 $newLI->setpackaging($packaging1);
			 $newLI->setrawmtl($rawmtl1);
			 $newLI->setqty($qty1);
			 $newLI->setponum($ponum1);
			 $newLI->setcofc($cofc1);
			 $newLI->settariffsch($tariffsch1);
			 $newLI->setrate($rate1);
			 $newLI->settype($type1);
			 $newLI->setamount($amount1);
			 $newLI->setpo_qty($po_qty1);
			 $newLI->setpolinenum($polinenum1);
			 $newLI->setschpo($schpo1);
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
    $max=$_REQUEST['index'];
   $invoicerecnum = $_REQUEST['invoicerecnum'];
   $company = $_REQUEST['company'];
   $invnum  = $_REQUEST['invnum'];
   $invdate = $_REQUEST['invdate'];
   $invdesc = $_REQUEST['invdesc'];
   $duedate = $_REQUEST['duedate'];
   $invdesc = $_REQUEST['invdesc'];
   $terms   = $_REQUEST['terms'];
   $status  = $_REQUEST['status'];
   $precarrigeby = $_REQUEST['precarriageby'];
   $precarrierreceipt = $_REQUEST['precarrierreceipt'];
   $countryoforigin = $_REQUEST['countryoforigin'];
   $countryoffinaldest = $_REQUEST['countryoffinaldest'];
   $vessel = $_REQUEST['vessel'];
   $portofloading = $_REQUEST['portofloading'];
   $portofdischarge = $_REQUEST['portofdischarge'];
   //echo$portofdischarge."in pro-------------";
   $packages = $_REQUEST['packages'];
   $remarks  = $_REQUEST['remarks'];
   //$numpkgs = $_REQUEST['numpkgs'];
   $currency= $_REQUEST['currency'];
   $fobcf= $_REQUEST['fobcf'];
   //$link2invoice = $_REQUEST['invoicerecnum'];
   $inv2customer = $_REQUEST['companyrecnum'];
   $inv2shipping = $_REQUEST['shippingcompanyrecnum'];
   $customerponum = $_REQUEST['customerponum'];
   $cust_amt = $_REQUEST['cust_amt'];
   $dcnum= $_REQUEST['dcnum'];
   $dcdate = $_REQUEST['dcdate'];

    $advance_info = $_REQUEST['advance_info'];
	$advance_amount = $_REQUEST['advance_amount'];
	
   $excise = $_REQUEST['excise'];
   $vat    = $_REQUEST['vat'];   
   $excsubtotal = $_REQUEST['excsubtotal'];
   $vatsubtotal = $_REQUEST['vatsubtotal'];   
  $st = $_REQUEST['service_tax'];  
   $stsubtotal = $_REQUEST['stsubtotal'];  
   $cess1 = $_REQUEST['cess1'];  
   $cess2 = $_REQUEST['cess2'];
   
   $crdate = date("d-M-y");
   $i=1;
   $totalamount=0;
   $shipping='';
   $salestax='';
   $flag=0;
   $excise ='';
	$vat ='';
	$excisesubtotal ='';
	$vatsubtotal ='';
		$st ='';
	$stsubtotal ='';
		$cess1 ='';
	$cess2 ='';
//echo $i."-------------".$max ;
   while($i<$max)
   {
	//echo "i am inside while loop";
    $prelinenum="prelinenum" . $i;
	$lirecnum="lirecnum" . $i;
    $line_num="line_num" . $i;
    //echo"$line_num================";
	$cofc="cofc" . $i;
	$itemdesc="item_desc" . $i;
	$qty="qty" . $i;
	$crn="crn" . $i;
	$partnum="partnum" . $i;
	$tariffsch="tariffsch" . $i;
	$rawmtl="rawmtl" . $i;
	$packaging="packaging" . $i;
	$ponum="ponum" . $i;
	$rate="rate" . $i;
	$amount="amount" . $i;
	$type="type" . $i;
	$po_qty="po_qty" . $i;
    $numpkgs ="numpkgs".$i;
    $polinenum ="polinenum".$i;
    $schpo ="schpo".$i;

    $lirecnum1=$_REQUEST[$lirecnum];
	$prevlinenum1=$_REQUEST[$prelinenum];
	$line_num1= $_REQUEST[$line_num];
		//echo "<br>this is line no   :$prevlinenum1";
	$cofc1 = $_REQUEST[$cofc];
	$itemdesc1 = $_REQUEST[$itemdesc];
	$qty1 = $_REQUEST[$qty];
	$crn1 = $_REQUEST[$crn];
	$partnum1 = $_REQUEST[$partnum];
	$rawmtl1 = $_REQUEST[$rawmtl];
	$tariffsch1 = $_REQUEST[$tariffsch];
	$packaging1 = $_REQUEST[$packaging];
	$ponum1 = $_REQUEST[$ponum];
	$rate1 = $_REQUEST[$rate];
	$type1 = $_REQUEST[$type];
    $amount1=$_REQUEST[$amount];
    $po_qty1=$_REQUEST[$po_qty];
    $polinenum1=$_REQUEST[$polinenum];
    $schpo1=$_REQUEST[$schpo];




	$newlogin = new userlogin;
	$newlogin->dbconnect();

	$flagc = 0;
	//echo "<br>this is line no   :$line_num1";
	if ($line_num1 != '')
	{
		//echo "<br>this is line no   :$line_num1";
		$amount1=0;
		$amount1 = $rate1 * $qty1;
			if($flag==0)
			{
				$j=1;
				while($j<$max)
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
					}
					$j++;
				}
				//Only if customer is Mahindra 	
				if($company == $companyname)
				{	
				$excise = (12.5/100) * $totalamount ;
				$excisesubtotal = $totalamount  + $excise ;
				$vat = (14.5/100) * $excisesubtotal ;
				$vatsubtotal = $excisesubtotal + $vat ;
				$flagc = 1;	
				}
				
				//Only if customer is Aerostructures 	
				if($company == $companyname1)
				{						
				$vat = (14.5/100) * $totalamount ;
				$vatsubtotal = $totalamount + $vat;
				$flagc = 1;
				}		
				
				$shipping=$totalamount*0;
				// if($flagc == 1 )
				// {	
				// $total = $shipping+$vatsubtotal-$advance_amount;
				// }
				// else
				// {
				// $total = $totalamount + $shipping+$vatsubtotal-$advance_amount;
				// }

				// if($company == $companyname2)
				// {				

				//    $st = (14/100) * $totalamount ;
				//     $cess1 = (0.5/100) * $totalamount ;
				//      $cess2 = (0.5/100) * $totalamount ;
				//    $stsubtotal = $totalamount + $st+$cess1+$cess2;
				//    $flagst = 1 ;
				// }		

    //            if($flagst == 1)
				// {
				// $total = $shipping+$stsubtotal-$advance_amount;

			 //   }
				// else
				// {
				// $total =  $totalamount + $shipping+$stsubtotal-$advance_amount;


				// }	

				// $totaldue=$total;

				if($company == $companyname2)
				{						
				    $st = (14/100) * $totalamount ;
				    $cess1 = (0.5/100) * $totalamount ;
				    $cess2 = (0.5/100) * $totalamount ;
				    $stsubtotal = $totalamount+$st+$cess1+$cess2;
				    $flagst = 1 ;
				}		

				$comptotal = '' ;
               if($flagst == 1 || $flagc == 1)
				{
					if($flagc == 1)
					{
						$comptotal = $vatsubtotal ;
					} 	
					else
					{
						$comptotal = $stsubtotal ;
					}
				$total = $shipping+$comptotal-$advance_amount;
				}
				else
				{
				$total =  $totalamount + $shipping -$advance_amount;
				}						
				$totaldue=$total;
				
  				$sql = "start transaction";
 				$result = mysql_query($sql);

  				$newinvoice->setinvnum($invnum);
		  		$newinvoice->setinvdate($invdate);
			   	$newinvoice->setduedate($duedate);
   				$newinvoice->setinvdesc($invdesc);
	  			$newinvoice->setterms($terms);
	    	   	$newinvoice->setprecarriageby($precarrigeby);
			   	$newinvoice->setprecarrierreceipt($precarrierreceipt);
			   	$newinvoice->setcountryoforigin($countryoforigin);
			   	$newinvoice->setcountryoffinaldest($countryoffinaldest);
			   	$newinvoice->setvessel($vessel);
			   	$newinvoice->setportofloading($portofloading);
			   	$newinvoice->setportofdischarge($portofdischarge);
			   	$newinvoice->setpackages($packages);
		   	    $newinvoice->setstatus($status);
		   		$newinvoice->setinv2customer($inv2customer);
     	   		$newinvoice->setinv2shipping($inv2shipping);
		   		$newinvoice->setcustomerponum($customerponum);
                $newinvoice->setsubtotal($totalamount);
                $newinvoice->setshipping($shipping);
                $newinvoice->setsalestax($salestax);
                $newinvoice->settotal($total);
                $newinvoice->settotaldue($totaldue);
                $newinvoice->setremarks($remarks);
                $newinvoice->setcurrency($currency);
                $newinvoice->setfobcf($fobcf);
                $newinvoice->setdcnum($dcnum);
                $newinvoice->setdcdate($dcdate);
                $newinvoice->setremarks($remarks);    
				
				$newinvoice->setadvance_info($advance_info);  
				$newinvoice->setadvance_amount($advance_amount);  
				$newinvoice->setexcise($excise); 
				$newinvoice->setvat($vat);
				
				$newinvoice->setexcsubtotal($excisesubtotal); 
				$newinvoice->setvatsubtotal($vatsubtotal);	
				$newinvoice->setservice_tax($st);
				$newinvoice->setstsubtotal($stsubtotal);
				$newinvoice->setcess1($cess1);
				$newinvoice->setcess2($cess2);			
                $temptotal = sprintf("%.2f",$total);
                $tempcustamt = sprintf("%.2f",$cust_amt);

                if($temptotal > $tempcustamt)
                {
                  echo "<table border=1><tr><td><font color=#FF0000>";
                  die("Invoice Amount $total Is Greater Than The Cust Invoice Amount $cust_amt. ");
                }
                $newinvoice->updateInvoice($invoicerecnum);

                //$newinvoice->updatecompanyremarks($remarks,$inv2customer,$terms);
				$flag=1;
			}
			 $newLI->setlink2invoice($invoicerecnum);
			 $newLI->setline_num($line_num1);
			 $newLI->setcrn($crn1);
			 $newLI->setdescr($itemdesc1);
			 $newLI->setpartnum($partnum1);
			 $newLI->setpackaging($packaging1);
			 $newLI->setrawmtl($rawmtl1);
			 $newLI->setqty($qty1);
			 $newLI->setponum($ponum1);
			 $newLI->setcofc($cofc1);
			// echo '========'.$cofc1.'==========';
			 $newLI->settariffsch($tariffsch1);
			 $newLI->setrate($rate1);
		     $newLI->settype($type1);
			 $newLI->setamount($amount1);
             $newLI->setpo_qty($po_qty1);
             $newLI->setpolinenum($polinenum1);
             $newLI->setschpo($schpo1);

$result=$newLI->check_cofc($cofc1);
$num_rows=mysql_num_rows($result);
if($num_rows == '0' && $cofc1!='')
{
			if($prevlinenum1!='')
			{  
				//echo "i am here edd $lirecnum1<br>";
			 	$newLI->updateInvoiceli($lirecnum1);
			}
			else
			{
				//echo "i am here adding";
				$newLI->setlink2invoice($invoicerecnum);
        		$newLI->addInvoiceli();
			}
}
elseif($num_rows != '0' && $cofc1!='')
{
	while($row=mysql_fetch_row($result))
	{		
		if($row[0] == $invoicerecnum && $cofc1 !='')
		{
            if($prevlinenum1!='')
			{   //echo "i am here edd $lirecnum1<br>";
			 	$newLI->updateInvoiceli($lirecnum1);
			}
			else
			{
				echo "i am here adding";
				$newLI->setlink2invoice($invoicerecnum);
        		$newLI->addInvoiceli();
			}
		}		
		else
		{				
			   $cof=$cofc1;
			   $temp=1;			
		}
	}
}
elseif($num_rows != '0' && $cofc1=='')
{
	
		   if($prevlinenum1!='')
			{   //echo "i am here edd $lirecnum1<br>";
			 	$newLI->updateInvoiceli($lirecnum1);
			}
			else
			{
				echo "i am here adding";
				$newLI->setlink2invoice($invoicerecnum);
        		$newLI->addInvoiceli();
			}
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
if($temp == 0)
	{
header("Location:invoiceSummary.php" );
	}else
	{
		echo "<font size=5><font color=red>Duplicate Cofc#: $cof</font>";		
	}
}

if ($pagename == 'copyinvoice')
 {
    $cust_invnum=$_REQUEST['custinvnum'];
    //echo $cust_invnum;
    $newlogin = new userlogin;
	$newlogin->dbconnect();
	$result=$newinvoice->getdetails4custinv($cust_invnum);
	$myrow=mysql_fetch_row($result);
	//get data and insert into inv and li
   //header("Location:invoiceSummary.php" );
 }



?>
