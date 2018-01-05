<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = Dec 28, 2017                 =
// Filename: processSuppQuote.php              =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 WMS                          =
//==============================================

session_start();
header("Cache-control: private");

$pagename = $_SESSION['pagename'];
$action = $_REQUEST['action'];


include_once('classes/loginClass.php');
include('classes/suppquoteClass.php');
include('classes/suppquoteliClass.php');

$newsuppQuote = new suppquote;
$newsuppQI = new suppQuoteli;



$userid = $_SESSION['user'];
$quoteid=$_REQUEST['quoteid'];
$quote_date=$_REQUEST['quotedate'];
$company=$_REQUEST['company'];
$vendrecnum=$_REQUEST['vendrecnum'];
$desc=$_REQUEST['desc'];
$delivarydate=$_REQUEST['delivarydate'];
$salesperson1=$_REQUEST['salesperson'];
$salesperson=$_REQUEST['salespersonrecnum'];
$currency=$_REQUEST['currency'];
$tax=$_REQUEST['tax'];
$shipping=$_REQUEST['shipping'];
$labor=$_REQUEST['labor'];
$misc=$_REQUEST['misc'];
$lockstatus=$_REQUEST['lockstatus'];
$link2bom=$_REQUEST['bomrecnum'];
$terms=$_REQUEST['terms'];
$rfqid=$_REQUEST['rfqid'];
$index=$_REQUEST['index'];
$comments=$_REQUEST['comments'];
$revisionnum=$_REQUEST['revisionnum'];
$parentquoteid=$_REQUEST['parentquoteid'];



$newsuppQuote->setrevisionnum($revisionnum);
$newsuppQuote->setparentquoteid($parentquoteid);


$newlogin = new userlogin;
$newlogin->dbconnect();



if ($pagename == 'quoteDetailsEdit')
{
  $delete = $_REQUEST['deleteflag'];
  if ($delete == 'y')
    {
     $quoterecnum=$_SESSION['quoterecnum'];
     $newsuppQuote->deleteQuote($quoterecnum);
     header("Location:salesquote.php" );
   }
 }


if ($pagename == 'newsuppQuote' )
{
 	$total=0;
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
            }
		        $j++;
         	}

	        $newlogin = new userlogin;
	        $newlogin->dbconnect();

          $newsuppQuote->setid($quoteid);
          $newsuppQuote->setCompany($company);
          $newsuppQuote->setquote2company($vendrecnum);
          $newsuppQuote->setdesc($desc);
          $newsuppQuote->setrfqid($rfqid);
          $newsuppQuote->setquote_date($quote_date);
          $newsuppQuote->setdelivarydate($delivarydate);
          $newsuppQuote->setterms($terms);
          $newsuppQuote->setcomments($comments);
          $newsuppQuote->setsalesperson($salesperson);
          $crdate = date("d-M-y");
          $newsuppQuote->setcurrency($currency);
          $newsuppQuote->setgrosstotal($total);
          $newsuppQuote->settax($tax);
          $newsuppQuote->setlabor($labor);
          $newsuppQuote->setshipping($shipping);
          $newsuppQuote->setmisc($misc);
          $newsuppQuote->setlink2bom($link2bom);
          $newsuppQuote->setlockstatus($lockstatus);
					$sql = "start transaction";
					$result = mysql_query($sql);
					// echo "<pre>";
					// print_r($_REQUEST); exit;
          $quoterecnum = $newsuppQuote->addQuote();
					$flag=1;

        }

        $newsuppQI->setitem($item1);
        $newsuppQI->setlink2quote($quoterecnum);
        $newsuppQI->setitemdesc($itemdesc1);
        $newsuppQI->setquantity($qty1);
        $newsuppQI->setrate($rate1);
        $newsuppQI->setamount($amount1);

        $newsuppQI->addQI();

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
else if($pagename == "SuppQuoteEdit")
{
  $i=1;
  $total=0;
  $flag=0;
	$i=1;
	while($i<$index)
	{

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

    if ($item1 != '')
    {
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
					}
					$j++;
				}

  			$sql = "start transaction";
 				$result = mysql_query($sql);

        $salesperson=$_REQUEST['salespersonrecnum'];
        $quote2employee=$_REQUEST['salespersonrecnum'];
        $salespersonrecnum=$_REQUEST['salespersonrecnum'];
        $delete = $_REQUEST['deleteflag'];
        $quoterecnum = $_SESSION['quoterecnum'];

        $newsuppQuote->setid($quoteid);
        $newsuppQuote->setCompany($company);
        $newsuppQuote->setquote2company($vendrecnum);
        $newsuppQuote->setdesc($desc);
        $newsuppQuote->setrfqid($rfqid);
        $newsuppQuote->setquote_date($quote_date);
        $newsuppQuote->setdelivarydate($delivarydate);
        $newsuppQuote->setterms($terms);
        $newsuppQuote->setcomments($comments);
        $newsuppQuote->setsalesperson($salesperson);
        $crdate = date("d-M-y");
        $newsuppQuote->setcurrency($currency);
        $newsuppQuote->setgrosstotal($total);
        $newsuppQuote->settax($tax);
        $newsuppQuote->setlabor($labor);
        $newsuppQuote->setshipping($shipping);
        $newsuppQuote->setmisc($misc);
        $newsuppQuote->setlink2bom($link2bom);
        $newsuppQuote->setlockstatus($lockstatus);
        $newsuppQuote->updateQuote($quoterecnum);

				$flag=1;
			}

      $newsuppQI->setitem($item1);
			$newsuppQI->setlink2quote($quoterecnum);
			$newsuppQI->setitemdesc($itemdesc1);
			$newsuppQI->setquantity($quantity1);
			$newsuppQI->setrate($rate1);
			$newsuppQI->setamount($amount1);

		 	if($previtem1!=='')
			{
      	$newsuppQI->updateQI($birecnum1);
			}
			else
			{
      	$newsuppQI->addQI();
			}
	  }
	  else
    {
	    if ($previtem1 != '')
      {
        $newsuppQI->deleteQI($birecnum1);
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
else 
{
 	header ( "Location: suppquote.php" );
}

?>
