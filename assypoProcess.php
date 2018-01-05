<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = June 20, 2004                =
// Filename: assypoProcess.php                 =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OWT                          =
// Allows processing of Assypos                =
//==============================================
session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ("Location:login.php");
}
$userid = $_SESSION['user'];

$pagename = $_SESSION['pagename'];


include('classes/assypoClass.php');
include('classes/assypoliClass.php');

// Next, create an instance of the classes required
$newassyPo = new assyPo;
$newLI = new assypo_line_items;

// Get all fields related to PO
if ($pagename == 'assyPoNew' || $pagename == 'assypoEdit' || $pagename == 'view_assypoDetails')
{
   $host = $_REQUEST['from'];
   $ship_to = $_REQUEST['order_to'];
   $po = $_REQUEST['po_num'];
   $podate = $_REQUEST['podate'];
   $status = $_REQUEST['status'];
   $cur =  $_REQUEST['currency'];
   $remarks=$_REQUEST['remarks'];
   $terms=$_REQUEST['terms'];
   $approval= $_REQUEST['approval'];
   $approvaldate= $_REQUEST['approvaldate'];
   $amendment_num= $_REQUEST['amendment_num'];
   $amendmentdate= $_REQUEST['amendmentdate'];
   $amendment_notes= $_REQUEST['amendment_notes'];
   $tax=$_REQUEST['tax'];
   $shipping=$_REQUEST['shipping'];
   $labor=$_REQUEST['labor'];
   $podesc = $_REQUEST['podesc'];
   $type = $_REQUEST['type'];
}
if ($pagename == 'assyPoNew') {
//$crdate = date("d-M-y");
$i=1;
$j=1;
$max=$_REQUEST['index'];
$flag=0;
while($i<=$max)
{
	$linenumber="line_num" . $i;
	$crn="crn" . $i;
	$pri_partnum="pri_partnum" . $i;
	$sec_partnum="sec_partnum" . $i;
	$partname="partname" . $i;
	$partiss="partiss" . $i;
	$drgiss="drgiss" . $i;
	$mtlspec="mtlspec" . $i;
    $mtltype="mtltype" . $i;
	$cos="cos" . $i;
    $qty="qty" . $i;
    $price="price" . $i;

    $extprice = 0;

	$linenumber1= $_REQUEST[$linenumber];
	$crn1 = $_REQUEST[$crn];
	$pri_partnum1 = $_REQUEST[$pri_partnum];
	$sec_partnum1 = $_REQUEST[$sec_partnum];
	$partname1 = $_REQUEST[$partname];
	$partiss1 = $_REQUEST[$partiss];
	$drgiss1 = $_REQUEST[$drgiss];
	$mtlspec1 = $_REQUEST[$mtlspec];
	$mtltype1 = $_REQUEST[$mtltype];
	$cos1 = $_REQUEST[$cos];
    $qty1 = $_REQUEST[$qty];
    $price1=$_REQUEST[$price];

    $extprice = $qty1*$price1;
    $poamount = 0;
	//echo "<br>Values for line number   :$linenumber1<br>$itemname1<br>$itemdesc1<br>$qty1<br>$rate1<br>$duedate1";
	if ($linenumber1 != '')
	{
		if ($pagename == 'assyPoNew')
		{
			if($flag==0)
			{
			
                while($j<=$max)
				{
					$linetot="line_num" . $j;
					$pricetot="price" . $j;
					$qtytot="qty" . $j;
					$linenumber2 = $_REQUEST[$linetot];

                    $qty2 = $_REQUEST[$qtytot];
                    $price2 = $_REQUEST[$pricetot];
                    //echo 'qty2=='.$qty2;
                    //echo 'price2=='.$price2;
					if ($linenumber2 != '')
					{
						$amount2=0;
						$amount2 = $price2 * $qty2;
						$poamount= $poamount+$amount2;
                       // echo 'poamount'.$poamount;
                        $tax1 = $tax;
                        $shipping1 = $shipping ;
		                $labor1 = $labor;
						$total_due = $tax1+$shipping1+$labor1+$poamount;

						//echo "linenumber    :$linenumber2</br>rate  :$rate2<br>qty    :$qty2<br>poamount    :$poamount";
					}
					$j++;
				}
				$newlogin = new userlogin;
				$newlogin->dbconnect();
		  		$newassyPo->sethost($host);
			   	$newassyPo->setvend($ship_to);
			   	$newassyPo->setassyPoNum($po);
	  			$newassyPo->setpodate($podate);
	  			$newassyPo->setcur($cur);
  			    $newassyPo->setterms($terms);
                $newassyPo->setamnd_num($amendment_num);
                $newassyPo->setamnd_date($amendmentdate);
                $newassyPo->setamnd_notes($amendment_notes);
                $newassyPo->setremarks($remarks);
                $newassyPo->setshipping($shipping);
                $newassyPo->settax($tax);
                $newassyPo->setlabour($labor);
                $newassyPo->settotaldue($total_due);
                $newassyPo->setpoamount($poamount);
                $newassyPo->setpodesc($podesc);
                $newassyPo->settype($type);

				$sql = "start transaction";
				$result = mysql_query($sql);
				$delrecnum = $newassyPo->addassyPo();
				$flag=1;
			}

			$newLI->setlink2assypo($delrecnum);
			$newLI->setlinenum($linenumber1);
			$newLI->setcrn($crn1);
			$newLI->setpri_partnum($pri_partnum1);
			$newLI->setsec_partnum($sec_partnum1);
			$newLI->setpartname($partname1);
			$newLI->setqty($qty1);
			$newLI->setpartiss($partiss1);
            $newLI->setdrgiss($drgiss1);
	  		$newLI->setmtlspec($mtlspec1);
	  		$newLI->setmtltype($mtltype1);
	  		$newLI->setcos($cos1);
	  		$newLI->setprice($price1);
	  		$newLI->setextprice($extprice);
			$newLI->addLI();
			$sql = "commit";
			$result = mysql_query($sql);
			if(!$result)
			{
				 $sql = "rollback";
				 $result = mysql_query($sql);
				 die("Commit failed Assypo LI Insert..Please report to Sysadmin. " . mysql_errno());
			}
		}
	}
	$i++;
}
}

if ($pagename == 'assypoEdit' ||  $pagename == 'view_assypoDetails')
{
//echo "i am inside dispatchupdate";
$delrecnum = $_REQUEST['delrecnum'];

$i=1;
$j=1;
$max=$_REQUEST['index'];
$flag=0;
$poamount=0;
while($i<=$max)
{
	//echo "i am inside while loop" .$i;
	$linenumber="line_num" . $i;
	$crn="crn" . $i;
	$pri_partnum="pri_partnum" . $i;
	$sec_partnum="sec_partnum" . $i;
	$partname="partname" . $i;
	$partiss="partiss" . $i;
	$drgiss="drgiss" . $i;
	$mtlspec="mtlspec" . $i;
    $mtltype="mtltype" . $i;
	$cos="cos" . $i;
    $qty="qty" . $i;
    $price="price" . $i;

	$prelinenum="prev_line_num" . $i;
	$lirecnum="lirecnum" . $i;

	$lirecnum1=$_REQUEST[$lirecnum];
	$prevlinenum1=$_REQUEST[$prelinenum];
	
    $linenumber1= $_REQUEST[$linenumber];
	$crn1 = $_REQUEST[$crn];
	$pri_partnum1 = $_REQUEST[$pri_partnum];
	$sec_partnum1 = $_REQUEST[$sec_partnum];
	$partname1 = $_REQUEST[$partname];
	$partiss1 = $_REQUEST[$partiss];
	$drgiss1 = $_REQUEST[$drgiss];
	$mtlspec1 = $_REQUEST[$mtlspec];
	$mtltype1 = $_REQUEST[$mtltype];
	$cos1 = $_REQUEST[$cos];
    $qty1 = $_REQUEST[$qty];
    //echo 'QQQQQ'.$qty1;
    $price1=$_REQUEST[$price];
	//echo "$linenumber1";

    $extprice = 0;
    $extprice = $qty1*$price1;
    
    $newlogin = new userlogin;
    $newlogin->dbconnect();
	//echo "<br>Values for line number   :$linenumber1<br>$itemname1<br>$itemdesc1<br>$qty1<br>$rate1<br>$duedate1";
	if ($linenumber1 != '')
	{


			if($flag==0)
			{
			
                 while($j<=$max)
				{
					$linetot="line_num" . $j;
					$pricetot="price" . $j;
					$qtytot="qty" . $j;
					$linenumber2 = $_REQUEST[$linetot];

                    $qty2 = $_REQUEST[$qtytot];
                    $price2 = $_REQUEST[$pricetot];

					if ($linenumber2 != '')
					{
						$amount2=0;
						$amount2 = $price2 * $qty2;
						$poamount= $poamount+$amount2;

                        $tax1 = $tax;
                        $shipping1 = $shipping ;
		                $labor1 = $labor;
						$total_due = $tax1+$shipping1+$labor1+$poamount;

						//echo "linenumber    :$linenumber2</br>rate  :$rate2<br>qty    :$qty2<br>poamount    :$poamount";
					}
					$j++;
                  }
  	            $sql = "start transaction";
 				$result = mysql_query($sql);
                $newassyPo->sethost($host);
			   	$newassyPo->setvend($ship_to);
	   	 	    $newassyPo->setassyPoNum($po);
	  			$newassyPo->setpodate($podate);
	  			$newassyPo->setcur($cur);
  			    $newassyPo->setterms($terms);
	            $newassyPo->setapproval($approval);
                $newassyPo->setapprovaldate($approvaldate);
                $newassyPo->setamnd_num($amendment_num);
                $newassyPo->setamnd_date($amendmentdate);
                $newassyPo->setamnd_notes($amendment_notes);
                $newassyPo->setremarks($remarks);
                $newassyPo->setshipping($shipping);
                $newassyPo->settax($tax);
                $newassyPo->setlabour($labor);
                $newassyPo->settotaldue($total_due);
                $newassyPo->setpoamount($poamount);
                $newassyPo->setpodesc($podesc);
                $newassyPo->setstatus($status);
                $newassyPo->settype($type);
                $newassyPo->updateAssypo($delrecnum);
				$flag=1;
 			        //echo 'after dispatch'.$disprecnum;
			}

            $newLI->setlink2assypo($delrecnum);
			$newLI->setlinenum($linenumber1);
			$newLI->setcrn($crn1);
			$newLI->setpri_partnum($pri_partnum1);
			$newLI->setsec_partnum($sec_partnum1);
			$newLI->setpartname($partname1);
			$newLI->setqty($qty1);
			$newLI->setpartiss($partiss1);
            $newLI->setdrgiss($drgiss1);
	  		$newLI->setmtlspec($mtlspec1);
	  		$newLI->setmtltype($mtltype1);
	  		$newLI->setcos($cos1);
	  		$newLI->setprice($price1);
	  		$newLI->setextprice($extprice);

			 if($prevlinenum1!='')
			{
				//echo "i am here updating";
			 	$newLI->updateLI($lirecnum1);
			}
			else
			{
				//echo "i am here adding";
				 //$newLI->setlink2deliver($delrecnum);
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
		 die("Commit failed Deliver Insert..Please report to Sysadmin. " . mysql_errno());
	 }
$i++;
}
}

if($_REQUEST['pagen'] == 'view_assypo')
{
header("Location:view_assypoSummary.php" );
}
else
{
header("Location:assypoSummary.php" );
}

?>
