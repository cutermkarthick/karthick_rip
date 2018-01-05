<?php

session_start();
header("Cache-control: private");
$userid = $_SESSION['user'];

$poNum=$_REQUEST["ponum"];
$partNum=$_REQUEST["partnum"];
$qty=$_REQUEST["qty"];
$psn=$_REQUEST["psn"];
$batchno=$_REQUEST["batchno"];
$wo=$_REQUEST["wonum"];
$box=$_REQUEST['box'];

//echo $box;

$header='';
$username=$_SESSION['username'] ;
$str='';


    $data ="SIZE 101.6 mm, 100.1 mm \n";
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
    $data .="BARCODE 722,743,".'"'.'128'.'"'.',102,0,180,5,10,'.'"'.$poNum.'"';
    $data .="\n";
    $data .="CODEPAGE 850 \n";
    $data .="TEXT 501,768,".'"'.'ROMAN.TTF'.'"'.',180,1,8,'.'"'.$poNum.'"';
    $data .="\n";
    $data .="TEXT 634,773,".'"'.'ROMAN.TTF'.'"'.',180,1,8,'.'"'.'PO Number: '.'"';
    $data .="\n";
    $data .="TEXT 674,629,".'"'.'ROMAN.TTF'.'"'.',180,1,8,'.'"'.'Part Number: '.'"';
    $data .="\n";
    $data .="BARCODE 722,599,".'"'.'128'.'"'.',102,0,180,3,6,'.'"'.$partNum.'"';
    $data .="\n";
    $data .="TEXT 534,624,".'"'.'ROMAN.TTF'.'"'.',180,1,8,'.'"'.$partNum.'"';
    $data .="\n";
    $data .="BARCODE 722,455,".'"'.'128'.'"'.',102,0,180,4,8,'.'"'.$qty.'"';
    $data .="\n";
    $data .="TEXT 592,480,".'"'.'ROMAN.TTF'.'"'.',180,1,8,'.'"'.$qty.'"';
    $data .="\n";
    $data .="TEXT 690,485,".'"'.'ROMAN.TTF'.'"'.',180,1,8,'.'"'.'Quantity: '.'"';
    $data .="\n";
    $data .="BARCODE 722,303,".'"'.'128'.'"'.',102,0,180,4,8,'.'"'.$psn.'"';
    $data .="\n";
    $data .="TEXT 568,328,".'"'.'ROMAN.TTF'.'"'.',180,1,8,'.'"'.$psn.'"';
    $data .="\n";
    $data .="TEXT 658,325,".'"'.'ROMAN.TTF'.'"'.',180,1,8,'.'"'.'P/S No.: '.'"';
    $data .="\n";
    $data .="BARCODE 722,152,".'"'.'128'.'"'.',102,0,180,4,8,'.'"'.$batchno.'"';
    $data .="\n";
    $data .="TEXT 526,177,".'"'.'ROMAN.TTF'.'"'.',180,1,8,'.'"'.$batchno.'"';
    $data .="\n";
    $data .="TEXT 634,182,".'"'.'ROMAN.TTF'.'"'.',180,1,8,'.'"'.'Batch No: '.'"';
    $data .="\n";
    $data .="PRINT 1,1";


    header("Content-type: text/plain",true);
	header("Content-Disposition: attachment; filename=$box.prn",true);
	header("Pragma: no-cache");
	header("Expires: 0");
	print "$header\n$data";

?>

