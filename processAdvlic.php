<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = June 20, 2004                =
// Filename: processAdvlic.php                 =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OWT                          =
// Allows processing of Advlics                =
//==============================================

session_start();
header("Cache-control: private");
//echo 'User='.$_SESSION['user'];
if ( !isset ( $_SESSION['user'] ) )
{
     header ("Location:login.php");

}
$userid = $_SESSION['user'];

$pagename = $_SESSION['pagename'];


include('classes/advlicClass.php');
include('classes/advlicliClass.php');

// Next, create an instance of the classes required
$newadv = new advlic;
$newLI = new advlic_line_items;

// Get all fields related to PO
if ($pagename == 'advlicEntry' || $pagename == 'advlicEdit') {
   $advlicno = $_REQUEST['adv_lic_no'];
   $advlicdate = $_REQUEST['licdate'];
   $fromdate =  $_REQUEST['from_date'];
   $todate =  $_REQUEST['to_date'];
   //echo 'ADLICNO='.$advlicno;
   //echo 'LICDATE='.$advlicdate;
}
if ($pagename == 'advlicEntry') {
$i=1;
$max=$_REQUEST['index'];
//echo '---'.$max;
$flag=0;
while($i<=$max)
{
	$linenumber="line_num" . $i;
    //$itemnum="itemnum" . $i;
    $partnum="partnum" . $i;
    $partname="partname" .$i;
    $rmspec="rm_spec" . $i;
    $rmsize="rm_size" . $i;
    $crn="crn" . $i;
    $qtytomake="qtytomake" . $i;
    $qtyimported="qtyimported" . $i;
    $be_no="be_no" . $i;
    $assesmnt_value="assesmnt_value" . $i;
    $cif_value="cif_value" . $i;
    $rate="rate" . $i;
    $tariff="tariff" . $i;
    $wastage="wastage" . $i;

	$linenumber1= $_REQUEST[$linenumber];
	//$itemnum1 = $_REQUEST[$itemnum];
	$partnum1 = $_REQUEST[$partnum];
	$partname1 = $_REQUEST[$partname];
	$rmspec1 = $_REQUEST[$rmspec];
	$rmsize1 = $_REQUEST[$rmsize];
 	$crn1 = $_REQUEST[$crn];
	$qtytomake1 = $_REQUEST[$qtytomake];
	$qtyimported1 = $_REQUEST[$qtyimported];
	$be_no1 = $_REQUEST[$be_no];
	$assesmnt_value1 = $_REQUEST[$assesmnt_value];
	$cif_value1 = $_REQUEST[$cif_value];
	//echo $cif_value1.'--';
	$rate1 =  $_REQUEST[$rate];
	//echo $rate1;
    $tariff1 = $_REQUEST[$tariff];
    $wastage1 = $_REQUEST[$wastage];


	if ($linenumber1 != '')
	{

		if ($pagename == 'advlicEntry')
		{
			if($flag==0)
			{
   				$newlogin = new userlogin;
				$newlogin->dbconnect();
  		        $newadv->setadvlic_no($advlicno);
			   	$newadv->setadvlic_date($advlicdate);
			   	$newadv->setfromdate($fromdate);
			   	$newadv->settodate($todate);
   				$sql = "start transaction";
				$result = mysql_query($sql);
				$advlicrecnum = $newadv->addadvlic();
				$flag=1;
 			}

 			$newLI->setlink2advlic($advlicrecnum);
			$newLI->setlinenum($linenumber1);
			//$newLI->setitemnum($itemnum1);
			
			$newLI->setpartnum($partnum1);
			$newLI->setpartname($partname1);
			$newLI->setrmspec($rmspec1);
			$newLI->setrmsize($rmsize1);
			$newLI->setcrn($crn1);
			$newLI->setqty2make($qtytomake1);
			$newLI->setqtyimp($qtyimported1);
			$newLI->setbeno($be_no1);
            $newLI->setasmntval($assesmnt_value1);
            $newLI->setcifval($cif_value1);
            $newLI->setrate($rate1);
            $newLI->settariff($tariff1);
            $newLI->setwastage($wastage1);

            $newLI->addLI();
			$sql = "commit";
			$result = mysql_query($sql);
			if(!$result)
			{
				 $sql = "rollback";
				 $result = mysql_query($sql);
				 die("Commit failed Adv Lic LI Insert..Please report to Sysadmin. " . mysql_errno());
			}
		}
	}
	$i++;
}
}

if ($pagename == 'advlicEdit')
{
//echo "i am inside advlicEdit";
$advlicrecnum = $_SESSION['advlicrecnum'];
$fromdate =  $_REQUEST['from_date'];
$todate =  $_REQUEST['to_date'];
//echo 'advlicrecnuminprocess'. $advlicrecnum;
$i=1;
$max=$_REQUEST['index'];
$flag=0;
while($i<=$max)
{
	//echo "i am inside while loop" .$i;
	$linenumber="line_num" . $i;
	//echo "$linenumber";
    //$itemnum="itemnum" . $i;
    $partnum="partnum" . $i;
    $partname="partname" .$i;
    $rmspec="rm_spec" . $i;
    $rmsize="rm_size" . $i;
    $crn="crn" . $i;
    $qtytomake="qtytomake" . $i;
    $qtyimported="qtyimported" . $i;
    $be_no="be_no" . $i;
    $assesmnt_value="assesmnt_value" . $i;
    $cif_value="cif_value" . $i;
    $rate="rate" . $i;
    $tariff="tariff" . $i;
    $wastage="wastage" . $i;

	$prevlinenum="prev_line_num" . $i;
	$lirecnum="lirecnum" . $i;
	$lirecnum1=$_REQUEST[$lirecnum];
	$prevlinenum1=$_REQUEST[$prevlinenum];
	$linenumber1= $_REQUEST[$linenumber];
	//echo "$linenumber1";
    //$itemnum1 = $_REQUEST[$itemnum];
	$partnum1 = $_REQUEST[$partnum];
	$partname1 = $_REQUEST[$partname];
 	$crn1 = $_REQUEST[$crn];
	$rmspec1 = $_REQUEST[$rmspec];
	$rmsize1 = $_REQUEST[$rmsize];
	$qtytomake1 = $_REQUEST[$qtytomake];
	$qtyimported1 = $_REQUEST[$qtyimported];
    $be_no1 = $_REQUEST[$be_no];
	$assesmnt_value1 = $_REQUEST[$assesmnt_value];
	$cif_value1 = $_REQUEST[$cif_value];
	$rate1 =  $_REQUEST[$rate];
    $tariff1 = $_REQUEST[$tariff];
    $wastage1 = $_REQUEST[$wastage];

	$newlogin = new userlogin;
	$newlogin->dbconnect();

	//echo "<br>Values for line number   :$linenumber1<br>$itemname1<br>$itemdesc1<br>$qty1<br>$rate1<br>$duedate1";
	if ($linenumber1 != '')
	{
	//echo 'in linenumber';

			if($flag==0)
			{

  				$sql = "start transaction";
 				$result = mysql_query($sql);
                $newadv->setadvlic_no($advlicno);
			   	$newadv->setadvlic_date($advlicdate);
      	        $newadv->setfromdate($fromdate);
			   	$newadv->settodate($todate);
				$newadv->updateadvlic($advlicrecnum);
				$flag=1;
   			}


            $newLI->setlink2advlic($advlicrecnum);
			$newLI->setlinenum($linenumber1);
			$newLI->setpartnum($partnum1);
			$newLI->setpartname($partname1);
			$newLI->setrmspec($rmspec1);
			$newLI->setrmsize($rmsize1);
			$newLI->setcrn($crn1);
			$newLI->setqty2make($qtytomake1);
			$newLI->setqtyimp($qtyimported1);
            $newLI->setbeno($be_no1);
            $newLI->setasmntval($assesmnt_value1);
            $newLI->setcifval($cif_value1);
            $newLI->setrate($rate1);
            $newLI->settariff($tariff1);
            $newLI->setwastage($wastage1);

            if($prevlinenum1!='')
			 {
			 	$newLI->updateLI($lirecnum1);
			 }
           else
			{
				 $newLI->setlink2advlic($advlicrecnum);
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
		 die("Commit failed for Advlic Insert..Please report to Sysadmin. " . mysql_errno());
	 }
$i++;
}


}
header("Location:advlicSummary.php");

?>
