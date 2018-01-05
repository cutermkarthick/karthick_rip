<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = Sep 15,2010                  =
// Filename: processBox.php                    =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OWT                          =
// Allows processing of boxes                  =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ("Location:login.php");

}
$userid = $_SESSION['user'];
$pagename = $_SESSION['pagename'];

include('classes/boxingClass.php');

$newbox = new boxing;
$cofc=$_REQUEST['cofc'];
$max = $_REQUEST['index'];
$i = 1;

if($pagename == 'boxingEntry')
{
 while($i<=$max)
 {
   $ponum = "ponum" .$i;
   $partnum = "partnum" .$i;
   $batchno = "batchno" .$i;
   $box = "box" .$i;
   $qty = "qty" .$i;
   $psn = "psn" .$i;
   $wo = "wo" .$i;
   

	$ponum1= $_REQUEST[$ponum];
	$partnum1 = $_REQUEST[$partnum];
	$batchno1 = $_REQUEST[$batchno];
	$box1 = $_REQUEST[$box];
	$qty1 = $_REQUEST[$qty];
	$psn1 = $_REQUEST[$psn];
    $wo1 =  $_REQUEST[$wo];

	if ($wo1 != '')
	{

			$newbox->setponum($ponum1);
			$newbox->setpartnum($partnum1);
			$newbox->setbatchno($batchno1);
			$newbox->setbox($box1);
			$newbox->setqty($qty1);
			$newbox->setpsn($psn1);
			$newbox->setwo($wo1);
			$newbox->setcofc($cofc);
			$newbox->addBox();
	}
	$i++;
 }
 header("Location:boxingDetails.php?cofcnum=$cofc");
}

if($pagename == 'boxingUpdate')
{
 while($i<=$max)
 {
   $ponum = "ponum" .$i;
   $partnum = "partnum" .$i;
   $batchno = "batchno" .$i;
   $box = "box" .$i;
   $qty = "qty" .$i;
   $psn = "psn" .$i;
   $wo = "wo" .$i;
   
   $prev_wo = "prev_wo" .$i;
   $lirecnum = "lirecnum" .$i;


	$ponum1= $_REQUEST[$ponum];
	$partnum1 = $_REQUEST[$partnum];
	$batchno1 = $_REQUEST[$batchno];
	$box1 = $_REQUEST[$box];
	$qty1 = $_REQUEST[$qty];
	$psn1 = $_REQUEST[$psn];
    $wo1 =  $_REQUEST[$wo];
    
    $prev_wo1 = $_REQUEST[$prev_wo];
    $lirecnum1 = $_REQUEST[$lirecnum];

	if ($wo1 != '')
	{
			$newbox->setponum($ponum1);
			$newbox->setpartnum($partnum1);
			$newbox->setbatchno($batchno1);
			$newbox->setbox($box1);
			$newbox->setqty($qty1);
			$newbox->setpsn($psn1);
			$newbox->setwo($wo1);
			$newbox->setcofc($cofc);
			
          if($prev_wo1!='')
	      {
		 	   $newbox->updateBox($lirecnum1);
	      }
	      else
	      {
			   $newbox->addBox();
	      }
	}
	$i++;
 }
 header("Location:boxingDetails.php?cofcnum=$cofc");
}
?>
