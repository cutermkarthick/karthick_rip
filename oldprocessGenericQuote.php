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
include('classes/genericQuoteClass.php');
include_once('classes/loginClass.php');
include('classes/companyClass.php');
include('classes/empClass.php');
include('classes/quoteClass.php');
include('classes/quoteliClass.php');
include('classes/partClass.php');

// Next, create an instance of the classes required

$newpage = new page;
$newFI= new pagefields;
//$newQGen= new genericQuote;
$newCust = new company;
$newEmp = new emp;
$newQuote = new quote;
$newQI = new quoteli;
$newPart = new part;

// Get all fields related to quote general info

$userid = $_SESSION['user'];
$quoteid=$_REQUEST['quoteid'];
$quote_date=$_REQUEST['quotedate'];
$company=$_REQUEST['company'];
$companyrecnum=$_REQUEST['companyrecnum'];
$desc=$_REQUEST['desc'];
$delivarydate=$_REQUEST['delivarydate'];
$salesperson1=$_REQUEST['salesperson'];
$salesperson=$_REQUEST['salespersonrecnum'];
$currency=$_REQUEST['currency'];
$tax=$_REQUEST['tax'];
$shipping=$_REQUEST['shipping'];
$labor=$_REQUEST['labor'];
$misc=$_REQUEST['misc'];
$total_due = '';
$lockstatus=$_REQUEST['lockstatus'];

$link2bom=$_REQUEST['bomrecnum'];
$terms=$_REQUEST['terms'];
$rfqid=$_REQUEST['rfqid'];
//$quotetype=$_REQUEST['quotetype'];
$index=$_REQUEST['index'];
$comments=$_REQUEST['comments'];

$revisionnum=$_REQUEST['revisionnum'];
$newQuote->setrevisionnum($revisionnum);
$parentquoteid=$_REQUEST['parentquoteid'];
$newQuote->setparentquoteid($parentquoteid);

// Database Connect
$newlogin = new userlogin;
$newlogin->dbconnect();



if ($pagename == 'quoteDetailsEdit')
 {
    $delete = $_REQUEST['deleteflag'];
    if ($delete == 'y')
      {
       $quoterecnum=$_SESSION['quoterecnum'];
       $newQuote->deleteQuote($quoterecnum);
       header("Location:salesquote.php" );
     }
 }


if ($pagename == 'newquote' )
{

//	$type=$_REQUEST['quotetype'];
//	$newQGen->settype($type);

	// Get quote details

//	$genrecnum=$newQGen->addgenericQuote();
//	$newQuote->setquote2type($genrecnum);
//   	$quoterecnum = $newQuote->addQuote();



     $total=0;
     $totaldue=0;
     $flag=0;
     $i=1;
     while($i<$index)
        {

	        $item="item" . $i;
	        $itemdesc="item_desc" . $i;
	        $quantity="quantity" . $i;
	        $rate="rate" . $i;
	        $item1= $_REQUEST[$item];
	        $itemdesc1 = $_REQUEST[$itemdesc];
	        $qty1 = $_REQUEST[$quantity];
	        $rate1 = $_REQUEST[$rate];
	        $amount1=0;
	        $amount1 = $rate1 * $qty1;

	        if ($item1 != '')
	        {
                $amount1=0;
                $amount1 = $rate1 * $qty1;
                if ($action == 'new' )
		        {
			        if($flag==0)
			        {
				     $j=1;
				        while($j<$index)
				         {

                            $linetot="item" . $j;
					        $qtytot="quantity" . $j;
					        $ratetot="rate" . $j;
					        $item2= $_REQUEST[$linetot];
					        $qty2 = $_REQUEST[$qtytot];
					        $rate2 = $_REQUEST[$ratetot];

                            if ($item2 != '')
					            {
					                $amount2=0;
						            $amount2 = $rate2 * $qty2;
						            $total= $total+$amount2;
						            
						            $tax1=$tax;
						            $labor1=$labor;
						            $shipping1=$shipping;
						            $misc1 = $misc;
						            $totaldue =$tax1+$labor1+$shipping1+$misc1+$total;
					            }
					        $j++;
				         }

				        $newlogin = new userlogin;
				        $newlogin->dbconnect();

                        $newQuote->setid($quoteid);
                        $newQuote->setCompany($company);
                        $newQuote->setquote2company($companyrecnum);
                        $newQuote->setdesc($desc);
                        $newQuote->setrfqid($rfqid);
                        $newQuote->setquote_date($quote_date);
                        $newQuote->setdelivarydate($delivarydate);
//                        $newQuote->setquotetype($quotetype);
                        $newQuote->setterms($terms);
                        $newQuote->setcomments($comments);
                        $newQuote->setsalesperson($salesperson);
                        $crdate = date("d-M-y");
                        $newQuote->setcurrency($currency);
                        $newQuote->setgrosstotal($total);
                        $newQuote->settax($tax);
                        $newQuote->setlabor($labor);
                        $newQuote->setshipping($shipping);
                        $newQuote->setmisc($misc);
                        $newQuote->settotal_due($totaldue);
                        $newQuote->setlink2bom($link2bom);
                        $newQuote->setlockstatus($lockstatus);
			$sql = "start transaction";
			$result = mysql_query($sql);
                        $quoterecnum = $newQuote->addQuote();
			$flag=1;

		            }

                    $newQI->setitem($item1);
		            $newQI->setlink2quote($quoterecnum);
		            $newQI->setitemdesc($itemdesc1);
		            $newQI->setquantity($qty1);
		            $newQI->setrate($rate1);
		            $newQI->setamount($amount1);

		            $newQI->addQI();
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


    $i=1;
    $total=0;
    $flag=0;
	$i=1;
	while($i<$index)
	{
//	echo   "$itemdesc";
		$item="item" . $i;
		$itemdesc="item_desc" . $i;
		$quantity="quantity" . $i;
		$rate="rate" . $i;
        $previtem="previtem" . $i;
		$birecnum="birecnum" . $i;
		$previtem1="";
        if ( isset ( $_REQUEST[$previtem] ) )
         {
        	$previtem1=$_REQUEST[$previtem];
         }
		$item1= $_REQUEST[$item];
		$itemdesc1 = $_REQUEST[$itemdesc];
		$quantity1 = $_REQUEST[$quantity];
		$rate1 = $_REQUEST[$rate];
		$birecnum1="";
        if ( isset ( $_REQUEST[$birecnum] ) )
        {
		    $birecnum1= $_REQUEST[$birecnum];
		}
		$newlogin = new userlogin;
		$newlogin->dbconnect();
		//$amount1=0;
		//$amount1 = $rate1 * $quantity1;

	    if ($item1 != '')
	    {
		    //echo "<br>this is line no   :$linenumber1";
		    $amount1=0;
		    $amount1 = $rate1 * $quantity1;
			if($flag==0)
			{
				$j=1;
				while($j<$index)
				{
					$linetot="item" . $j;
					$qtytot="quantity" . $j;
					$ratetot="rate" . $j;
					$item2= $_REQUEST[$linetot];
					$qty2 = $_REQUEST[$qtytot];
					$rate2 = $_REQUEST[$ratetot];
					if ($item2 != '')
					{
                    	$amount2=0;
						$amount2 = $rate2 * $qty2;
						$total= $total+$amount2;
						
						$tax1=$tax;
                        $labor1=$labor;
                        $shipping1=$shipping;
                        $misc1 = $misc;
                        $totaldue =$tax1+$labor1+$shipping1+$misc1+$total;

                        echo $total;
					}
					$j++;
				}
  				$sql = "start transaction";
 				$result = mysql_query($sql);

	            $salesperson=$_REQUEST['salespersonrecnum'];
	            $quote2employee=$_REQUEST['salespersonrecnum'];
                $salespersonrecnum=$_REQUEST['salespersonrecnum'];
//	            $recnum =$_SESSION['typenum'];
	            $delete = $_REQUEST['deleteflag'];
	            $quoterecnum = $_SESSION['quoterecnum'];

//	            $wostatus = $newQGen->UpdategenericQuote($recnum);
//	            $newQuote->setquote2type($recnum);


                $newQuote->setid($quoteid);
                $newQuote->setCompany($company);
                $newQuote->setquote2company($companyrecnum);
                $newQuote->setdesc($desc);
                $newQuote->setrfqid($rfqid);
                $newQuote->setquote_date($quote_date);
                $newQuote->setdelivarydate($delivarydate);
//                $newQuote->setquotetype($quotetype);
                $newQuote->setterms($terms);
                $newQuote->setcomments($comments);
                $newQuote->setsalesperson($salesperson);
                $crdate = date("d-M-y");
                $newQuote->setcurrency($currency);
                $newQuote->setgrosstotal($total);
                $newQuote->settax($tax);
                $newQuote->setlabor($labor);
                $newQuote->setshipping($shipping);
                $newQuote->setmisc($misc);
                $newQuote->settotal_due($totaldue);
                $newQuote->setlink2bom($link2bom);
                $newQuote->setlockstatus($lockstatus);
                $newQuote->updateQuote($quoterecnum);

				$flag=1;
			}
                $newQI->setitem($item1);
			$newQI->setlink2quote($quoterecnum);
			$newQI->setitemdesc($itemdesc1);
			$newQI->setquantity($quantity1);
			$newQI->setrate($rate1);
			$newQI->setamount($amount1);

			 if($previtem1!=='')
			{
            $newQI->updateQI($birecnum1);
			}
			else
			{
                $newQI->addQI();
			}
	  }
	  else
	    {
		    if ($previtem1 != '')
		        {
                $newQI->deleteQI($birecnum1);
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


if ($pagename == 'quoteDetailsEdit')
{
     header ( "Location: quoteDetails.php?quoterecnum=$quoterecnum" );
}
else {
       header ( "Location: salesquote.php" );
}
?>
