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

include('classes/shippingClass.php');
//include('classes/invoiceliClass.php');

// Next, create an instance of the classes required
$newshipping = new shipping;
//$newLI = new invoiceli;

//echo $pagename."-*********";



$subtotal = '';
$salestax = '';
$shipping = '';
$total = '';

// Get all fields related to invoice
if ($pagename == 'shippingentry') {
   $max=$_REQUEST['index'];
   $sbnum = $_REQUEST['sbnum'];
   $sbdate = $_REQUEST['sbdate'];
   $qcert = $_REQUEST['qcert'];
   $qcertdate = $_REQUEST['qcertdate'];
   $impcode = $_REQUEST['impcode'];
   $rbicode = $_REQUEST['rbicode'];
   $custome_house_agent = $_REQUEST['custome_house_agent'];
   $lic_no = $_REQUEST['lic_no'];
   $rotatingnum = $_REQUEST['rotatingnum'];
//echo  "inv2customer" .  $inv2customer;
   $cf = $_REQUEST['cf'];
   $cfr = $_REQUEST['cfr'];
   $fob = $_REQUEST['fob'];
 //echo  "inv2customer" .  $inv2customer;
   $other_contract = $_REQUEST['other_cont'];
   $exchange_rate= $_REQUEST['exchange_rate'];
   $currency_in= $_REQUEST['currency_in'];
   $net_weight = $_REQUEST['net_weight'];
   $gross_weight= $_REQUEST['gross_weight'];
   $fob_words= $_REQUEST['fob_inwords'];
   $invrecnum=$_REQUEST['invrecnum'];
   $ship2customer=$_REQUEST['ship2customer'];
   $fob_value = $_REQUEST['fob_value'];
   $fob_cur= $_REQUEST['fob_cur'];
   $fob_inr= $_REQUEST['fob_inr'];

   $freight_value = $_REQUEST['freight_value'];
   $freight_cur= $_REQUEST['freight_cur'];
   $freight_inr= $_REQUEST['freight_inr'];

   $insurance_value = $_REQUEST['insurance_value'];
   $insurance_cur= $_REQUEST['insurance_cur'];
   $insurance_inr= $_REQUEST['insurance_inr'];

   $commission_value = $_REQUEST['commission_value'];
   $commission_cur= $_REQUEST['commission_cur'];
   $commission_inr= $_REQUEST['commission_inr'];

   $discount_value = $_REQUEST['discount_value'];
   $discount_cur= $_REQUEST['discount_cur'];
   $discount_inr= $_REQUEST['discount_inr'];

   $other_value = $_REQUEST['other_value'];
   $other_cur= $_REQUEST['other_cur'];
   $other_inr= $_REQUEST['other_inr'];

   $deduction_value = $_REQUEST['deduction_value'];
   $deduction_cur= $_REQUEST['deduction_cur'];
   $deduction_inr= $_REQUEST['deduction_inr'];
   
   $deffcredit = $_REQUEST['deffcredit'];
   $jointven= $_REQUEST['jointven'];
   $rucredit= $_REQUEST['rucredit'];
   $others_ex= $_REQUEST['others_ex'];
   $rbiapp= $_REQUEST['rbiapp'];
   $rbiappdate= $_REQUEST['rbiappdate'];
   
   $outrightsale= $_REQUEST['outrightsale'];
   $conexp= $_REQUEST['conexp'];
   $other_sh= $_REQUEST['other_sh'];
   
   $ar4anum= $_REQUEST['ar4anum'];
   $ar4adate= $_REQUEST['ar4adate'];

 //echo  "customerpo num is " .  $customerponum;

}
if ($pagename == 'shippingentry') {
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
	$marknum="marknum" . $i;
	$statnum="statnum" . $i;
	$qty="qty" . $i;
	$vfob="vfob" . $i;

	$linenumber1= $_REQUEST[$linenumber];
	$marknum1 = $_REQUEST[$marknum];
	$statnum1 = $_REQUEST[$statnum];
	$qty1 = $_REQUEST[$qty];
	$vfob1 = $_REQUEST[$vfob];

	if ($linenumber1 != '')
	{
		$amount1=0;
		$amount1 = $rate1 * $qty1;
		//echo "linenumber   :$linenumber1<br>amount      :$amount1</br>";
		if ($pagename == 'shippingentry')
		{
			if($flag==0)
			{
             $j=1;
				while($j<=30)
				{
					$linetot="linenum" . $j;
					$qtytot="qty" . $j;
					$ratetot="vfob" . $j;
					$linenumber2= $_REQUEST[$linetot];
					$qty2 = $_REQUEST[$qtytot];
					$rate2 = $_REQUEST[$ratetot];
					//	echo "<br>this is line2   :$linenumber2";
					if ($linenumber2 != '')
					{
                    	$amount2=0;

                    $qty_total += $qty2;
                    $vfob_total += $rate2;
                   // echo$qty_total.'*************'.$vfob_total;
						$totaldue=$total;
					}
					$j++;
				}
				$tot_fob_inr=$vfob_total* $exchange_rate;
				//echo "exchange is	$exchange_rate";
				//echo "vfob total  is	$vfob_total  ";
				//echo "total fob inr  is	$tot_fob_inr  ";
				$newlogin = new userlogin;
				$newlogin->dbconnect();
  				//$newshipping->setinvnum($invnum);
  				//$newshipping->setinvdate($invdate);
		  		$newshipping->setsbnum($sbnum);
			   	$newshipping->setsbdate($sbdate);
   				$newshipping->setqcert($qcert);
	  			$newshipping->setqcertdate($qcertdate);
	    	   	$newshipping->setimpcode($impcode);
			   	$newshipping->setrbicode($rbicode);
			   	$newshipping->setcustome_house_agent($custome_house_agent);
			   	$newshipping->setlic_no($lic_no);
			   	//$newshipping->setpre_carriage($pre_carriage);
			   	//$newshipping->setplace_receipt($place_receipt);
			   	//$newshipping->setvessel($vesselnum);
			   	$newshipping->setrotatingnum($rotatingnum);
			   	$newshipping->setcf($cf);
			   	$newshipping->setcfr($cfr);
		   	    $newshipping->setfob($fob);
		   		$newshipping->setship2customer($ship2customer);
		   		//$newshipping->setport_loading($port_loading);
                //$newshipping->setcountry_desti($country_desti);
                $newshipping->setother_contract($other_contract);
                $newshipping->setexchange_rate($exchange_rate);
                $newshipping->setcurrency_in($currency_in);
                $newshipping->setnet_weight($net_weight);
				$newshipping->setgross_weight($gross_weight);
                $newshipping->setnet_weight($net_weight);
				$newshipping->setgross_weight($gross_weight);
                $newshipping->setfob_words($fob_words);
                $newshipping->setnet_weight($net_weight);
				$newshipping->setgross_weight($gross_weight);
                $newshipping->setfob_words($fob_words);
                $newshipping->setfob_value($vfob_total);
				$newshipping->setfob_cur($currency_in);
                $newshipping->setfob_inr($tot_fob_inr);
                $newshipping->setfreight_value($freight_value);
				$newshipping->setfreight_cur($freight_cur);
                $newshipping->setfreight_inr($freight_inr);
                $newshipping->setinsurance_value($insurance_value);
				$newshipping->setinsurance_cur($insurance_cur);
                $newshipping->setinsurance_inr($insurance_inr);
                $newshipping->setcommission_value($commission_value);
				$newshipping->setcommission_cur($commission_cur);
                $newshipping->setcommission_inr($commission_inr);
                $newshipping->setdiscount_value($discount_value);
				$newshipping->setdiscount_cur($discount_cur);
                $newshipping->setdiscount_inr($discount_inr);
                $newshipping->setother_value($other_value);
				$newshipping->setother_cur($other_cur);
                $newshipping->setother_inr($other_inr);
                $newshipping->setdeduction_value($deduction_value);
				$newshipping->setdeduction_cur($deduction_cur);
                $newshipping->setdeduction_inr($deduction_inr);
                $newshipping->setinvrecnum($invrecnum);
                $newshipping->setdeffcredit($deffcredit);
                $newshipping->setjointven($jointven);
                $newshipping->setrucredit($rucredit);
                $newshipping->setothers_ex($others_ex);
				$newshipping->setrbiapp($rbiapp);
                $newshipping->setrbiappdate($rbiappdate);
                $newshipping->setoutrightsale($outrightsale);
				$newshipping->setconexp($conexp);
                $newshipping->setother_sh($other_sh);
                $newshipping->setqty_total($qty_total);
                $newshipping->setvfob_total($vfob_total);
                $newshipping->setar4anum($ar4anum);
                $newshipping->setar4adate($ar4adate);
				$sql = "start transaction";
				$result = mysql_query($sql);
				$shippingrecnum = $newshipping->addshipping();
				$flag=1;
				//echo "PO Amount is     :$poamount";
			}
             $newshipping->setlink2shipping($shippingrecnum);
			 $newshipping->setlinenum($linenumber1);
         	 $newshipping->setmarknum($marknum1);
			 $newshipping->setstatnum($statnum1);
			 $newshipping->setqty($qty1);
			 $newshipping->setvfob($vfob1);
			 $newshipping->addshippingli();
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
header("Location:shippingSummary.php" );
}


if ($pagename == 'shippingedit')
 {
//echo "i am inside editinvoice";
  // $max=$_REQUEST['index'];
   $ship_recnum=$_REQUEST['shippingrecnum'];
   $max=$_REQUEST['index'];
   $sbnum = $_REQUEST['sbnum'];
   $sbdate = $_REQUEST['sbdate'];
   $qcert = $_REQUEST['qcert'];
   $qcertdate = $_REQUEST['qcertdate'];
   $impcode = $_REQUEST['impcode'];
   $rbicode = $_REQUEST['rbicode'];
   $custome_house_agent = $_REQUEST['custome_house_agent'];
   $lic_no = $_REQUEST['lic_no'];
   $rotatingnum = $_REQUEST['rotatingnum'];
 //echo  "inv2customer" .  $inv2customer;
   $cf = $_REQUEST['cf'];
   $cfr = $_REQUEST['cfr'];
   $fob = $_REQUEST['fob'];
 //echo  "inv2customer" .  $inv2customer;
   $other_contract = $_REQUEST['other_cont'];
   $exchange_rate= $_REQUEST['exchange_rate'];
   $currency_in= $_REQUEST['currency_in'];
   $net_weight = $_REQUEST['net_weight'];
   $gross_weight= $_REQUEST['gross_weight'];
   $fob_words= $_REQUEST['fob_inwords'];
   $invrecnum=$_REQUEST['invrecnum'];
   $ship2customer=$_REQUEST['ship2customer'];
   $fob_value = $_REQUEST['fob_value'];
   $fob_cur= $_REQUEST['fob_cur'];
   $fob_inr= $_REQUEST['fob_inr'];

   $freight_value = $_REQUEST['freight_value'];
   $freight_cur= $_REQUEST['freight_cur'];
   $freight_inr= $_REQUEST['freight_inr'];

   $insurance_value = $_REQUEST['insurance_value'];
   $insurance_cur= $_REQUEST['insurance_cur'];
   $insurance_inr= $_REQUEST['insurance_inr'];

   $commission_value = $_REQUEST['commission_value'];
   $commission_cur= $_REQUEST['commission_cur'];
   $commission_inr= $_REQUEST['commission_inr'];

   $discount_value = $_REQUEST['discount_value'];
   $discount_cur= $_REQUEST['discount_cur'];
   $discount_inr= $_REQUEST['discount_inr'];

   $other_value = $_REQUEST['other_value'];
   $other_cur= $_REQUEST['other_cur'];
   $other_inr= $_REQUEST['other_inr'];

   $deduction_value = $_REQUEST['deduction_value'];
   $deduction_cur= $_REQUEST['deduction_cur'];
   $deduction_inr= $_REQUEST['deduction_inr'];
   
   $shipping_id=$_REQUEST["shipping_id"];
   $create_date=$_REQUEST["shipping_date"];
   
    $deffcredit = $_REQUEST['deffcredit'];
   $jointven= $_REQUEST['jointven'];
   $rucredit= $_REQUEST['rucredit'];
   $others_ex= $_REQUEST['others_ex'];
   $rbiapp= $_REQUEST['rbiapp'];
   $rbiappdate= $_REQUEST['rbiappdate'];
   

   $outrightsale= $_REQUEST['outrightsale'];
   $conexp= $_REQUEST['conexp'];
   $other_sh= $_REQUEST['other_sh'];
   
   $ar4anum= $_REQUEST['ar4anum'];
   $ar4adate= $_REQUEST['ar4adate'];
   
$crdate = date("d-M-y");
$i=1;
$totalamount=0;
$shipping='';
$salestax='';
$flag=0;
while($i<=30)
{
	//echo "i am inside while loop";
    $linenumber="linenum" . $i;
	$marknum="marknum" . $i;
	$statnum="statnum" . $i;
	$qty="qty" . $i;
	$vfob="vfob" . $i;
	$prelinenum="prev_line_num" . $i;
	$lirecnum="lirecnum" . $i;
	
	$lirecnum1=$_REQUEST[$lirecnum];
	$prevlinenum1=$_REQUEST[$prelinenum];
	//$linenumber1= $_REQUEST[$linenumber];
 	$linenumber1= $_REQUEST[$linenumber];
	$marknum1 = $_REQUEST[$marknum];
	$statnum1 = $_REQUEST[$statnum];
	$qty1 = $_REQUEST[$qty];
	$vfob1 = $_REQUEST[$vfob];

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
				while($j<=30)
				{
					$linetot="linenum" . $j;
					$qtytot="qty" . $j;
					$ratetot="vfob" . $j;
					$linenumber2= $_REQUEST[$linetot];
					$qty2 = $_REQUEST[$qtytot];
					$rate2 = $_REQUEST[$ratetot];
						//echo "<br>this is line2   :$linenumber2";
					if ($linenumber2 != '')
					{
                    	$amount2=0;
						//$amount2 = $rate2 * $qty2;
						//$totalamount= $totalamount+$amount2;
						//$salestax= $totalamount*0;
						//$shipping=$totalamount*0;
						//$total =$salestax+$shipping+$totalamount;
                    $qty_total += $qty2;
                    $vfob_total += $rate2;
                    //echo$qty_total.'*************'.$vfob_total;
						$totaldue=$total;
					}
					$j++;
				}
				$tot_fob_inr=$vfob_total* $exchange_rate;
				//echo "exchange is	$exchange_rate";
				//echo "vfob total  is	$vfob_total  ";
				//echo "total fob inr  is	$tot_fob_inr  ";

  				$sql = "start transaction";
 				$result = mysql_query($sql);

      //$newlogin = new userlogin;
				//$newlogin->dbconnect();
                $newshipping->setsbnum($sbnum);
			   	$newshipping->setsbdate($sbdate);
   				$newshipping->setqcert($qcert);
	  			$newshipping->setqcertdate($qcertdate);
	    	   	$newshipping->setimpcode($impcode);
			   	$newshipping->setrbicode($rbicode);
			   	$newshipping->setcustome_house_agent($custome_house_agent);
			   	$newshipping->setlic_no($lic_no);
			   	//$newshipping->setpre_carriage($pre_carriage);
			   	//$newshipping->setplace_receipt($place_receipt);
			   	//$newshipping->setvessel($vesselnum);
			   	$newshipping->setrotatingnum($rotatingnum);
			   	$newshipping->setcf($cf);
			   	$newshipping->setcfr($cfr);
		   	    $newshipping->setfob($fob);
		   		$newshipping->setship2customer($ship2customer);
		   		//$newshipping->setport_loading($port_loading);
                //$newshipping->setcountry_desti($country_desti);
                $newshipping->setother_contract($other_contract);
                $newshipping->setexchange_rate($exchange_rate);
                $newshipping->setcurrency_in($currency_in);
                $newshipping->setnet_weight($net_weight);
				$newshipping->setgross_weight($gross_weight);
                $newshipping->setnet_weight($net_weight);
				$newshipping->setgross_weight($gross_weight);
                $newshipping->setfob_words($fob_words);
                $newshipping->setnet_weight($net_weight);
				$newshipping->setgross_weight($gross_weight);
                $newshipping->setfob_words($fob_words);
                $newshipping->setfob_value($vfob_total);
				$newshipping->setfob_cur($currency_in);
                $newshipping->setfob_inr($tot_fob_inr);
                $newshipping->setfreight_value($freight_value);
				$newshipping->setfreight_cur($freight_cur);
                $newshipping->setfreight_inr($freight_inr);
                $newshipping->setinsurance_value($insurance_value);
				$newshipping->setinsurance_cur($insurance_cur);
                $newshipping->setinsurance_inr($insurance_inr);
                $newshipping->setcommission_value($commission_value);
				$newshipping->setcommission_cur($commission_cur);
                $newshipping->setcommission_inr($commission_inr);
                $newshipping->setdiscount_value($discount_value);
				$newshipping->setdiscount_cur($discount_cur);
                $newshipping->setdiscount_inr($discount_inr);
                $newshipping->setother_value($other_value);
				$newshipping->setother_cur($other_cur);
                $newshipping->setother_inr($other_inr);
                $newshipping->setdeduction_value($deduction_value);
				$newshipping->setdeduction_cur($deduction_cur);
                $newshipping->setdeduction_inr($deduction_inr);
                $newshipping->setshipping_id($shipping_id);
                $newshipping->setcreate_date($create_date);
                $newshipping->setinvrecnum($invrecnum);
                $newshipping->setdeffcredit($deffcredit);
                $newshipping->setjointven($jointven);
                $newshipping->setrucredit($rucredit);
                $newshipping->setothers_ex($others_ex);
				$newshipping->setrbiapp($rbiapp);
                $newshipping->setrbiappdate($rbiappdate);
                $newshipping->setoutrightsale($outrightsale);
				$newshipping->setconexp($conexp);
                $newshipping->setother_sh($other_sh);
                $newshipping->setar4anum($ar4anum);
                $newshipping->setar4adate($ar4adate);
                $newshipping->setqty_total($qty_total);
                $newshipping->setvfob_total($vfob_total);
				$sql = "start transaction";
				$result = mysql_query($sql);
				$newshipping->updateshipping($ship_recnum);
				$flag=1;
				//echo "PO Amount is     :$poamount";
			}
             $newshipping->setlink2shipping($ship_recnum);
			 $newshipping->setlinenum($linenumber1);
         	 $newshipping->setmarknum($marknum1);
			 $newshipping->setstatnum($statnum1);
			 $newshipping->setqty($qty1);
			 $newshipping->setvfob($vfob1);
			 //$newshipping->addshippingli();

			 if($prevlinenum1!=='')
			{
			 	$newshipping->updateshippingli($lirecnum1);
			}
			else
			{
				//echo "i am here adding";
				$newshipping->setlink2shipping($ship_recnum);
        		$newshipping->addshippingli();
			}
	}
	/*else
	{
		 if ($prevlinenum1 != '')
		 {
			//echo "i am here deleting";
			 $newLI->deleteInvoiceli($lirecnum1);
		  }
	} */
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
header("Location:shippingSummary.php" );
}



?>
