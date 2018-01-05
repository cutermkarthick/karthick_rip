<?php

session_start();
header("Cache-control: private");
$userid = $_SESSION['user'];

$poNum=$_REQUEST["ponum"];
$partNum=$_REQUEST["partnum"];
$qty=$_REQUEST["qty"];
$mbn=$_REQUEST["mbn"];
$batchno=$_REQUEST["batchno"];
$wo=$_REQUEST["wonum"];
$box=$_REQUEST['box'];
$crn=$_REQUEST['crn'];
$cofc=$_REQUEST['cofc'];
//echo $box;

$header='';
$username=$_SESSION['username'] ;
$str='';

    $data ="SIZE 101.5 mm, 150 mm \n";
    $data .="GAP 3 mm, 0 mm \n";
    $data .="SPEED 4 \n";
    $data .="DENSITY 7 \n";
    $data .="DIRECTION 0,0 \n";
    $data .="REFERENCE 0,0 \n";
    $data .="OFFSET 0 mm \n";
    $data .="SHIFT 0 \n";
    $data .="SET PEEL OFF \n";
    $data .="SET CUTTER OFF \n";
    $data .="SET TEAR ON \n";
    $data .="CLS \n";
    $data .="BARCODE 722,902,".'"'.'128'.'"'.',102,0,180,5,10,'.'"'.$poNum.'"';
    $data .="\n";
    $data .="CODEPAGE 850 \n";
    $data .="TEXT 501,927,".'"'.'ROMAN.TTF'.'"'.',180,1,8,'.'"'.$poNum.'"';
    $data .="\n";
    $data .="TEXT 634,932,".'"'.'ROMAN.TTF'.'"'.',180,1,8,'.'"'.'PO Number: '.'"';
    $data .="\n";
    $data .="TEXT 674,788,".'"'.'ROMAN.TTF'.'"'.',180,1,8,'.'"'.'Part Number: '.'"';
    $data .="\n";
    $data .="BARCODE 722,758,".'"'.'128'.'"'.',102,0,180,3,6,'.'"'.$partNum.'"';
    $data .="\n";
    $data .="TEXT 534,783,".'"'.'ROMAN.TTF'.'"'.',180,1,8,'.'"'.$partNum.'"';
    $data .="\n";
    $data .="BARCODE 722,614,".'"'.'128'.'"'.',102,0,180,4,8,'.'"'.$qty.'"';
    $data .="\n";
    $data .="TEXT 592,639,".'"'.'ROMAN.TTF'.'"'.',180,1,8,'.'"'.$qty.'"';
    $data .="\n";
    $data .="TEXT 690,644,".'"'.'ROMAN.TTF'.'"'.',180,1,8,'.'"'.'Quantity: '.'"';
    $data .="\n";
    $data .="BARCODE 722,462,".'"'.'128'.'"'.',102,0,180,4,8,'.'"'.$box.'"';
    $data .="\n";
    $data .="TEXT 568,487,".'"'.'ROMAN.TTF'.'"'.',180,1,8,'.'"'.$box.'"';
    $data .="\n";
    $data .="TEXT 658,484,".'"'.'ROMAN.TTF'.'"'.',180,1,8,'.'"'.'Part Box: '.'"';
    $data .="\n";
    $data .="BARCODE 722,310,".'"'.'128'.'"'.',102,0,180,4,8,'.'"'.$crn.'"';
    $data .="\n";
    $data .="TEXT 526,335,".'"'.'ROMAN.TTF'.'"'.',180,1,8,'.'"'.$crn.'"';
    $data .="\n";
    $data .="TEXT 634,341,".'"'.'ROMAN.TTF'.'"'.',180,1,8,'.'"'.'CRN: '.'"';
    $data .="\n";
    $data .="BARCODE 706,1054,".'"'.'128'.'"'.',102,0,180,4,8,'.'"'.$cofc.'"';
    $data .="\n";
    $data .="TEXT 554,1079,".'"'.'ROMAN.TTF'.'"'.',180,1,8,'.'"'.$cofc.'"';
    $data .="\n";
    $data .="TEXT 618,1076,".'"'.'ROMAN.TTF'.'"'.',180,1,8,'.'"'.'CofC: '.'"';
    $data .="\n";
    $data .="PRINT 1,1";


        header("Content-type: text/plain",true);
	header("Content-Disposition: attachment; filename=$box.prn",true);
	header("Pragma: no-cache");
	header("Expires: 0");
	print "$header\n$data";

?>

