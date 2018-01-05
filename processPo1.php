<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = June 20, 2004                =
// Filename: po_upload.php                     =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OMS                          =
// Allows uploading of POs                     =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];

$pagename = $_SESSION['pagename'];

include('classes/poClass.php');
include('classes/liClass.php');

// Next, create an instance of the classes required
$newPO = new po;
$newLI = new po_line_items;

// Get all fields related to PO
if ($pagename == 'newpo' || $pagename == 'poupdate' || $pagename == 'vendpoupd') {
   $vendorrecnum = $_REQUEST['vendrecnum'];
   $podate = $_REQUEST['podate'];
   $ponum = $_REQUEST['ponum'];
   $wonum = $_REQUEST['wonum'];
   $descr = $_REQUEST['desc'];
   $status = $_REQUEST['status'];
}
if ($pagename == 'newpo') {
$crdate = date("d-M-y");
$i=1;
$poamount=0;
$flag=0;
while($i<=15)
{
	$linenumber="line_num" . $i;
	$itemname="item_name" . $i;
	$itemdesc="item_desc" . $i;
	$qty="qty" . $i;
	$duedate="due_date" . $i;
	$rate="rate" . $i;
	//echo "<br>$linenumber<br>$itemname<br>$itemdesc<br>$qty<br>$rate<br>$duedate<br>";
	//$linenumber1='';$itemname1='';$itemdesc1='';$itemdesc1='';$qty1='';$rate1='';$duedate1='';
	//echo $_REQUEST['line_num1'];
	//if(isset($_REQUEST[$linenumber]))
		//echo "line num is set ";
	$linenumber1= $_REQUEST[$linenumber];
	$itemname1 = $_REQUEST[$itemname];
	$itemdesc1 = $_REQUEST[$itemdesc];
	$qty1 = $_REQUEST[$qty];
	$rate1 = $_REQUEST[$rate];
	$duedate1 = $_REQUEST[$duedate];
	//echo "<br>Values for line number   :$linenumber1<br>$itemname1<br>$itemdesc1<br>$qty1<br>$rate1<br>$duedate1";
	if ($linenumber1 != '')
	{
		$amount1=0;
		$amount1 = $rate1 * $qty1;
		//echo "linenumber   :$linenumber1<br>amount      :$amount1</br>";
		if ($pagename == 'newpo')
		{
			if($flag==0)
			{
				$j=1;
				while($j<=15)
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
						$poamount= $poamount+$amount2;
						//echo "linenumber    :$linenumber2</br>rate  :$rate2<br>qty    :$qty2<br>poamount    :$poamount";
					}
					$j++;
				}
				$newlogin = new userlogin;
				$newlogin->dbconnect();
  				$newPO->setponum($ponum);
		  		$newPO->setpodate($podate);
			   	$newPO->setdescr($descr);
   				$newPO->setwonum($wonum);
	  			$newPO->setpoamount($poamount);
		   		$newPO->setvendor($vendorrecnum);
				$sql = "start transaction";
				$result = mysql_query($sql);
				$porecnum = $newPO->addPO();
				$flag=1;
				//echo "PO Amount is     :$poamount";
			}
			$newLI->setlink2po($porecnum);
			$newLI->setlinenum($linenumber1);
			$newLI->setitemname($itemname1);
			 $newLI->setitemdesc($itemdesc1);
			 $newLI->setqty($qty1);
			 $newLI->setduedate($duedate1);
			 $newLI->setrate($rate1);
			 $newLI->setamount($amount1);
			 $newLI->addLI();
			 $sql = "commit";
			 $result = mysql_query($sql);
			 if(!$result)
			{
				 $sql = "rollback";
				 $result = mysql_query($sql);
				 die("Commit failed PO Insert..Please report to Sysadmin. " . mysql_errno());
			 }
		}
	}
	$i++;
}
}

if ($pagename == 'poupdate' || $pagename == 'vendpoupd')
 {
//echo "i am inside poupdates";
  $porecnum = $_REQUEST['porecnum'];
$crdate = date("d-M-y");
$i=1;
$poamount=0;
$flag=0;
while($i<=15)
{
	//echo "i am inside while loop";
	$linenumber="line_num" . $i;
	$itemname="item_name" . $i;
	$itemdesc="item_desc" . $i;
	$qty="qty" . $i;
	$duedate="due_date" . $i;
	$rate="rate" . $i;
	$prelinenum="prev_line_num" . $i;
	$lirecnum="lirecnum" . $i;
	//echo "<br>$linenumber<br>$itemname<br>$itemdesc<br>$qty<br>$rate<br>$duedate<br>";
	//$linenumber1='';$itemname1='';$itemdesc1='';$itemdesc1='';$qty1='';$rate1='';$duedate1='';
	//echo $_REQUEST['line_num1'];
	//if(isset($_REQUEST[$linenumber]))
		//echo "line num is set ";
	$lirecnum1=$_REQUEST[$lirecnum];
	$prevlinenum1=$_REQUEST[$prelinenum];
	$linenumber1= $_REQUEST[$linenumber];
	$itemname1 = $_REQUEST[$itemname];
	$itemdesc1 = $_REQUEST[$itemdesc];
	$qty1 = $_REQUEST[$qty];
	$rate1 = $_REQUEST[$rate];
	$duedate1 = $_REQUEST[$duedate];
				$newlogin = new userlogin;
				$newlogin->dbconnect();

	//echo "<br>Values for line number   :$linenumber1<br>$itemname1<br>$itemdesc1<br>$qty1<br>$rate1<br>$duedate1";
	if ($linenumber1 != '')
	{
		//echo "<br>this is line no   :$linenumber1";
		$amount1=0;
		$amount1 = $rate1 * $qty1;
			if($flag==0)
			{
				$j=1;
				while($j<=15)
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
						$poamount=$poamount+$amount2;
						//echo "linenumber    :$linenumber2</br>rate  :$rate2<br>qty    :$qty2<br>poamount    :$poamount";
					}
					$j++;
				}
  				$sql = "start transaction";
 				$result = mysql_query($sql);
		  		$newPO->setpodate($podate);
			   	$newPO->setdescr($descr);
   				$newPO->setwonum($wonum);
	  			$newPO->setpoamount($poamount);
		   		$newPO->setvendor($vendorrecnum);
				$newPO->setpostatus($status);
				$newPO->setponum($ponum);
				$newPO->updatePO($porecnum);

				$newsalesorder->updateSalesorder($salesorderrecnum);
				$flag=1;
				//echo "PO Amount is     :$poamount";
			}

			$newLI->setlink2po($porecnum);
			$newLI->setlinenum($linenumber1);
			$newLI->setitemname($itemname1);
			 $newLI->setitemdesc($itemdesc1);
			 $newLI->setqty($qty1);
			 $newLI->setduedate($duedate1);
			 $newLI->setrate($rate1);
			 $newLI->setamount($amount1);
			 if($prevlinenum1!=='')
			{
				//echo "i am here updating";
			 	$newLI->updateLI($lirecnum1);
			}
			else
			{
				//echo "i am here adding";
				 $newLI->setlink2po($porecnum);
        				 $newLI->addLI();
			}
	}
	else
	{
		 if ($prevlinenum1 != '')
		 {
			//echo "i am here deleting";
			 $newLI->deleteLI($lirecnum1);
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

// Update data

// Check if the delete flag is set
if ($_SESSION['pagename'] == 'poupdate') {
    $delete = $_REQUEST['deleteflag'];
}
if ($pagename == 'poupdate' && $delete == 'y') {
           $newPO->deletePO($porecnum);

}
if ($pagename == 'vendpoupd') {
header("Location:vendpo.php" );
}
else {
header("Location:po.php" );
}
?>