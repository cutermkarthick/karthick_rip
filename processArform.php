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

include('classes/arformClass.php');
//include('classes/invoiceliClass.php');

// Next, create an instance of the classes required
$newarform = new arform;
//$newLI = new invoiceli;

//echo $pagename."-*********";



$subtotal = '';
$salestax = '';
$shipping = '';
$total = '';

// Get all fields related to invoice
if ($pagename == 'arformentry') {
   $max=$_REQUEST['index'];

   $exchange_rate= $_REQUEST['exchange_rate'];
   $gross_weight= $_REQUEST['gross_weight'];
   $nopackage= $_REQUEST['nopackage'];
   $fob_words= $_REQUEST['fob_inwords'];
   $duty_inwords=$_REQUEST['duty_inwords'];
   $invrecnum=$_REQUEST['invrecnum'];
   $ar3anum= $_REQUEST['ar3anum'];
   $ar3adate= $_REQUEST['ar3adate'];
   $tot_qty= $_REQUEST['tot_qty'];
   $tot_amt= $_REQUEST['tot_amt'];
   $tot_payableamt= $_REQUEST['tot_payableamt'];
   $tot_amt_rs= $_REQUEST['tot_amt_rs'];
   $link2ship=$_REQUEST['ship2companyrecnum'];
   $vatsubtotal=$_REQUEST['vatsubtotal'];
// echo  "customerpo num is " .  $nopackage;

}
if ($pagename == 'arformentry') {
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
	$usd="usd" . $i;
	$rate="rate" . $i;
    $amtusd="amtusd" . $i;
    $remarks="remarks" . $i;
    $datew="datew" . $i;
    
	$linenumber1= $_REQUEST[$linenumber];
	$marknum1 = $_REQUEST[$marknum];
	$statnum1 = $_REQUEST[$statnum];
	$qty1 = $_REQUEST[$qty];
	$usd1 = $_REQUEST[$usd];
 	$rate1 = $_REQUEST[$rate];
 	$amtusd1 = $_REQUEST[$amtusd];
 	$remarks1 = $_REQUEST[$remarks];
    $datew1 = $_REQUEST[$datew];
    // echo "linenumber   :$linenumber1<br>";
	if ($linenumber1 != '')
	{
		//$amount1=0;
		//$amount1 = $rate1 * $qty1;
		//echo "linenumber   :$linenumber1<br>amount      :$amount1</br>";
		if ($pagename == 'arformentry')
		{
			if($flag==0)
			{

				$newlogin = new userlogin;
				$newlogin->dbconnect();


                $newarform->setexchange_rate($exchange_rate);
             	$newarform->setgross_weight($gross_weight);
                $newarform->setfob_words($fob_words);
                $newarform->setduty_words($duty_inwords);
 				$newarform->setlink2invoice($invrecnum);
                $newarform->settot_qty($tot_qty);
                $newarform->settot_amt($tot_amt);
                $newarform->settot_payableamt($tot_payableamt);
                $newarform->settot_amt_rs($tot_amt_rs);
                $newarform->setar3anum($ar3anum);
                $newarform->setar3adate($ar3adate);
                $newarform->setnopackage($nopackage);
                $newarform->setlink2ship($link2ship);
                $newarform->setvatsubtotal($vatsubtotal);
				$sql = "start transaction";
				$result = mysql_query($sql);
				$arrecnum = $newarform->addarform();
				$flag=1;
				//echo "PO Amount is     :$poamount";
			}

             $newarform->setlink2arform($arrecnum);
			 $newarform->setlinenum($linenumber1);
         	 $newarform->setmarknum($marknum1);
			 $newarform->setstatnum($statnum1);
			 $newarform->setqty($qty1);
			 $newarform->setusd($usd1);
			 $newarform->setrate($rate1);
			 $newarform->setamtusd($amtusd1);
			 $newarform->setremarks($remarks1);
			 $newarform->setdatew($datew1);
			 
			 $newarform->addarformli();
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
header("Location:arformSummary.php" );
}


if ($pagename == 'arformedit')
 {
//echo "i am inside editinvoice";
  // $max=$_REQUEST['index'];
   $max=$_REQUEST['index'];
   $ar_recnum=$_REQUEST['arrecnum'];
   $exchange_rate= $_REQUEST['exchange_rate'];
   $gross_weight= $_REQUEST['gross_weight'];
   $nopackage= $_REQUEST['nopackage'];
   $fob_words= $_REQUEST['fob_inwords'];
   $duty_inwords=$_REQUEST['duty_inwords'];
   $invrecnum=$_REQUEST['invrecnum'];
   $ar3anum= $_REQUEST['ar3anum'];
   $ar3adate= $_REQUEST['ar3adate'];
   $tot_qty= $_REQUEST['tot_qty'];
   $tot_amt= $_REQUEST['tot_amt'];
   $tot_payableamt= $_REQUEST['tot_payableamt'];
   $tot_amt_rs= $_REQUEST['tot_amt_rs'];
   $create_date=$_REQUEST['create_date'];
   $link2ship=$_REQUEST['ship2companyrecnum'];
   $vatsubtotal=$_REQUEST['vatsubtotal'];
   //echo $tot_payableamt."HERE in p";



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
	$usd="usd" . $i;
	$rate="rate" . $i;
    $amtusd="amtusd" . $i;
    $remarks="remarks" . $i;
    $datew="datew" . $i;
    
    $prelinenum="prev_line_num" . $i;
	$lirecnum="lirecnum" . $i;

	$lirecnum1=$_REQUEST[$lirecnum];
	$prevlinenum1=$_REQUEST[$prelinenum];

	$linenumber1= $_REQUEST[$linenumber];
	$marknum1 = $_REQUEST[$marknum];
	$statnum1 = $_REQUEST[$statnum];
	$qty1 = $_REQUEST[$qty];
	$usd1 = $_REQUEST[$usd];
 	$rate1 = $_REQUEST[$rate];
 	$amtusd1 = $_REQUEST[$amtusd];
 	$remarks1 = $_REQUEST[$remarks];
    $datew1 = $_REQUEST[$datew];

	$newlogin = new userlogin;
	$newlogin->dbconnect();
	if ($linenumber1 != '')
	{
		//echo "<br>this is line no   :$linenumber1";
		$amount1=0;
		$amount1 = $rate1 * $qty1;
			if($flag==0)
			{
   				$sql = "start transaction";
 				$result = mysql_query($sql);

                $newarform->setexchange_rate($exchange_rate);
             	$newarform->setgross_weight($gross_weight);
                $newarform->setfob_words($fob_words);
                $newarform->setduty_words($duty_inwords);
 				$newarform->setlink2invoice($invrecnum);
                $newarform->settot_qty($tot_qty);
                $newarform->settot_amt($tot_amt);
                $newarform->settot_payableamt($tot_payableamt);
                $newarform->settot_amt_rs($tot_amt_rs);
                $newarform->setar3anum($ar3anum);
                $newarform->setar3adate($ar3adate);
                $newarform->setnopackage($nopackage);
                $newarform->setcreatedate($create_date);
				$newarform->setlink2ship($link2ship);
				$newarform->setvatsubtotal($vatsubtotal);
				$sql = "start transaction";
				$result = mysql_query($sql);
				$newarform->updatearform($ar_recnum);
				$flag=1;
				//echo "PO Amount is     :$poamount";
			}
             $newarform->setlink2arform($ar_recnum);
			 $newarform->setlinenum($linenumber1);
         	 $newarform->setmarknum($marknum1);
			 $newarform->setstatnum($statnum1);
			 $newarform->setqty($qty1);
			 $newarform->setusd($usd1);
			 $newarform->setrate($rate1);
			 $newarform->setamtusd($amtusd1);
			 $newarform->setremarks($remarks1);
			 $newarform->setdatew($datew1);

			 //$newarform->addshippingli();

			 if($prevlinenum1!=='')
			{
			 	$newarform->updatearformli($lirecnum1);
			}
			else
			{
				//echo "i am here adding";
				$newarform->setlink2arform($ar_recnum);
        		$newarform->addarformli();
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
header("Location:arformSummary.php" );
}



?>
