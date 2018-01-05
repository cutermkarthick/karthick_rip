<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = July 22, 2005    Jerry George           =
// Filename: processShipment.php                    =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
//==============================================

session_start();
header("Cache-control: private"); 
$pagename = $_SESSION['pagename'];

include('classes/shipmentClass.php'); 
include('classes/workorderClass.php'); 

// Next, create an instance of the classes required

$newSHP= new shipment; 
$newWO=new workorder;
$i=1;
$i=1;
$workclose='n';
$ship='';
$condition='Open';
$index=$_REQUEST['index1'];
while($i<$index)
{
	$prevseqnum="prevseqnum" . $i;
	$shiprecnum="shiprecnum" . $i;
	$seqnum="seqnum" . $i;
	$desc="desc" . $i;
	$date="date" . $i;
	$tracking_num="tracking_num" . $i;
	$carrier="carrierval" . $i;
	$final="final" . $i;
	$link2wo="link2wo" . $i;
	$prevseqnum1 = $_REQUEST[$prevseqnum];
	$shiprecnum1 = $_REQUEST[$shiprecnum];
	$seqnum1 = $_REQUEST[$seqnum];
	$carrier1 = $_REQUEST[$carrier];
	$desc1 = $_REQUEST[$desc];
	$link2wo=$_SESSION['worecnum'];
	$tracking_num1 = $_REQUEST[$tracking_num];
	$date1= $_REQUEST[$date];
        if(isset($_REQUEST[$final]))
             	$final1 ="y";
        else
        	$final1 ="n";
	if($final1 == 'y')
	{
		$workclose='y';
		$ship=$date1;
		$condition='Closed';
	}
	$newSHP->setseqnum($seqnum1);
	$newSHP->settracking_num($tracking_num1);
	$newSHP->setdesc($desc1);
	$newSHP->setcarrier($carrier1);
	$newSHP->setfinal($final1);
	$newSHP->setdate($date1);
	$newSHP->setlink2wo($link2wo);
	if ($seqnum1 != '') 
	{
		if($prevseqnum1!='')
		{
			if($prevseqnum1!=='')
			{
			 	$newSHP->updateSHP($shiprecnum1);
			}
			else
			{
				 $newSHP->addSHP();
			}
		}
		else
		{
			$newSHP->addSHP();
		}
		$sql = "commit";
		$result = mysql_query($sql);
		if(!$result) 
		{
			 $sql = "rollback";
			 $result = mysql_query($sql);
			 die("Commit failed for Shipment Insert.Please rreportrt to Sysadmin. " . mysql_errno()); 
		 }
	}
$i++;
}
//if($workclose== 'y')
 $newWO->setShipdate($ship,$condition);
?> 

<html>
<head>
<script language=javascript>
function closePage()
{
self.close();
}
</script>
</head>
<body onLoad="closePage()">
</body>
</html>