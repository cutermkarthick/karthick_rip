<?php
session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location:login.php" );

}
$userid = $_SESSION['user'];

$pagename = $_SESSION['pagename'];

include('classes/packingClass.php');
include('classes/packingliClass.php');

$newpacking= new packing();
$newli= new packingli();
$newlogin = new userlogin();
//$newlogin->dbconnect();

if($pagename == 'packingentry')
{
   $companyrecnum=$_REQUEST['companyrecnum'];
   $podate = $_REQUEST['podate'];
   $ponum = $_REQUEST['ponum'];
   $wonum = $_REQUEST['wonum'];
   $packingnum = $_REQUEST['packingnum'];
   $descr = $_REQUEST['item_descr'];
  //echo"===$descr";
   $order_qty=$_REQUEST['order_qty'];
   $qty_disp=$_REQUEST['qty_disp'];
   $qty_bal=$_REQUEST['qty_bal'];
   $cim_invoice=$_REQUEST['cim_invoice'];
   $remarks=$_REQUEST['remarks'];
   $pack_date=$_REQUEST['packdate'];
   $no_packing= $_REQUEST['no_packing'];
   $type_packing= $_REQUEST['type_packing'];
   $transportation= $_REQUEST['transportation'];
   $link2invoice=$_REQUEST['ciminvoicerecnum'];

    $index = $_REQUEST['index'];
    $index_qty = $_REQUEST['index_qty'];
     //echo $index_qty;
	$x=1;
	$z=1;
	//$tot_net_wt=0;
    //$tot_gross_wt=0;
    $flag=0;
	while($x<$index)
	{
	 $line_num="line_num" . $x;
	 $length="length".$x;
	 $width="width_po".$x;
	 $thickness="thickness".$x;
	 $net_weight="net_weight".$x;
	 $tot_weight="tot_weight".$x;
     $numboxes="numboxes".$x;

	 $line_num= $_REQUEST[$line_num];
	 $length=$_REQUEST[$length];
	 $width=$_REQUEST[$width];
	 $thickness=$_REQUEST[$thickness];
	 $net_weight=$_REQUEST[$net_weight];
	 $tot_weight=$_REQUEST[$tot_weight];
     $numboxes=$_REQUEST[$numboxes];
     //echo "numboxes is $numboxes";
	  //echo$line_num;
	 if($line_num !='')
	 {
        if($flag==0)
              {
	            $j=1;
				while($j<=$index)
				{
					$linetot="line_num" . $j;
					$net_tot="net_weight" . $j;
					$gross_tot="tot_weight" . $j;
					$linenumber2= $_REQUEST[$linetot];
					$net_weight2 = $_REQUEST[$net_tot];
					$tot_weight2 = $_REQUEST[$gross_tot];
					//$numboxes = $_REQUEST[$numboxes];
					//	echo "<br>this is line2   :$linenumber2";
					if ($linenumber2 != '')
					{

                    $tot_net_wt += $net_weight2;
                    $tot_gross_wt += $tot_weight2;
                   // echo$tot_net_wt.'*************'.$tot_gross_wt;
						//$totaldue=$total;
					}
					$j++;
				}
				$newpacking->setpodate($podate);
                $newpacking->setponum($ponum);
                $newpacking->setwonum($wonum);
                $newpacking->setdescr($descr);
                $newpacking->setorder_qty($order_qty);
                $newpacking->setqty_disp($qty_disp);
                $newpacking->setcim_invoice($cim_invoice);
                $newpacking->setremarks($remarks);
                $newpacking->setpack_date($pack_date);
                $newpacking->setcompanyrecnum($companyrecnum);
                $newpacking->settype_packing($type_packing);
                $newpacking->setno_packing($no_packing);
                $newpacking->settransportation($transportation);
                $newpacking->setqty_bal($qty_bal);
                $newpacking->setlink2invoice($link2invoice);
                $newpacking->settot_net_wt($tot_net_wt);
                $newpacking->setgross_wt($tot_gross_wt);
                $newpacking->setpackingnum($packingnum);
                $pack_recnum=$newpacking->addpacking();

				$flag=1;
				}
      // $newlogin->dbconnect();
	   $newli->setline_num($line_num);
       $newli->setlength($length);
	   $newli->setwidth($width);
	   $newli->setthickness($thickness);
	   $newli->setnet_weight($net_weight);
	   $newli->settot_weight($tot_weight);
	   $newli->setnumboxes($numboxes);
	   $newli->setlink2packing($pack_recnum);
	   $newli->addpackingli();

	 }
	 
	 $x++;
	}
	while($z<$index_qty)
	{
	 $ponum_li="ponum_li" . $z;
	 $order_qtyli="order_qtyli".$z;
	 $this_shipment="this_shipment".$z;
	 $bal_dispatch="bal_dispatch".$z;
	 $ponum_li1= $_REQUEST[$ponum_li];
	 $order_qtyli1=$_REQUEST[$order_qtyli];
	 $this_shipment1=$_REQUEST[$this_shipment];
	 $bal_dispatch1=$_REQUEST[$bal_dispatch];

	 if($ponum_li1 !='')
	 {

       $newlogin->dbconnect();
	   $newli->setponum_li($ponum_li1);
       $newli->setorder_qty($order_qtyli1);
	   $newli->setthis_shipment($this_shipment1);
	   $newli->setbal_dispatch($bal_dispatch1);
	   $newli->setlink2packing($pack_recnum);
	   $newli->addpacking_qtyli();

	 }
	 $z++;
	}
       $sql = "commit";
       $result = mysql_query($sql);
       if(!$result)
       {
	 $sql = "rollback";
	 $result = mysql_query($sql);
	 die("Commit failed invoice Insert..Please report to Sysadmin. " . mysql_errno());
       }
       $newlogin->dbconnect();

}

if ($pagename == 'packingedit')
 {
    $delete = $_REQUEST['deleteflag'];
    if ($delete == 'y')
      {
        $packingrecnum = $_REQUEST['recnum'];
        $newpacking->deletePacking($packingrecnum);
        $newpacking->deletepackingli($packingrecnum);
        $newpacking->deletepackingqtyliflag($packingrecnum);
        header("Location:packingSummary.php" );
      }
 }
if($pagename == 'packingedit')
{
    $recnum=$_REQUEST['recnum'];
   $companyrecnum=$_REQUEST['companyrecnum'];
   $podate = $_REQUEST['podate'];
   $ponum = $_REQUEST['ponum'];
   $wonum = $_REQUEST['wonum'];
   $packingnum = $_REQUEST['packingnum'];
   $descr = $_REQUEST['item_descr'];
  // echo"===$descr";
   $order_qty=$_REQUEST['order_qty'];
   $qty_disp=$_REQUEST['qty_disp'];
   $qty_bal=$_REQUEST['qty_bal'];
   $cim_invoice=$_REQUEST['cim_invoice'];
   $remarks=$_REQUEST['remarks'];
   $pack_date=$_REQUEST['packdate'];
   $no_packing= $_REQUEST['no_packing'];
   $type_packing= $_REQUEST['type_packing'];
   $transportation= $_REQUEST['transportation'];
   $link2invoice=$_REQUEST['ciminvoicerecnum'];
   
    $flag=0;



  // }
     $index = $_REQUEST['index'];
     $index_qty= $_REQUEST['index_qty'];
     //echo $index."/*--------<br>";
     
	$m=1; $z=1;
	while($m<$index)
	{

	 $line_num="line_num" . $m;
	 $length="length".$m;
	 $width="width_po".$m;
	 $thickness="thickness".$m;
	 $net_weight="net_weight".$m;
	 $tot_weight="tot_weight".$m;
	 $numboxes="numboxes".$m;
     $prevlinenum="prevlinenum" . $m;
     $lirecnum="lirecnum" . $m;

	 $line_num= $_REQUEST[$line_num];
	// echo $index."/*--------".$line_num;
	 $length=$_REQUEST[$length];
	 $width=$_REQUEST[$width];
	 $thickness=$_REQUEST[$thickness];
	 $net_weight=$_REQUEST[$net_weight];
	 $tot_weight=$_REQUEST[$tot_weight];
	 $numboxes=$_REQUEST[$numboxes];
	 $lirecnum=$_REQUEST[$lirecnum];
	 $prevlinenum=$_REQUEST[$prevlinenum];
	  //echo"<br>---------------------".$line_num;
	 if($line_num !='')
	 {


	   $newlogin->dbconnect();
	   $newli->setline_num($line_num);
       $newli->setlength($length);
	   $newli->setwidth($width);
	   $newli->setthickness($thickness);
	   $newli->setnet_weight($net_weight);
	   $newli->settot_weight($tot_weight);
	   $newli->setnumboxes($numboxes);
	   $newli->setlink2packing($recnum);
	   //echo $flag."flag is";
      if($flag==0)
    {

       $n=1;
	   
	    while($n<=$index)
				{
					$linetot="line_num" . $n;
					$net_tot="net_weight" . $n;
					$gross_tot="tot_weight" . $n;
					$numboxes="numboxes" . $n;
					$linenumber2= $_REQUEST[$linetot];
					$net_weight2 = $_REQUEST[$net_tot];
					$tot_weight2 = $_REQUEST[$gross_tot];
					$numboxes2 = $_REQUEST[$numboxes];
						//echo "<br>this is line2   :$linenumber2";
					if ($linenumber2 != '')
					{

                    $tot_net_wt += $net_weight2;
                    $tot_gross_wt += $tot_weight2;
					$tot_numboxes += $numboxes2;

						//$totaldue=$total;
					}
					$n++;
					//echo$tot_net_wt.'*************'.$tot_gross_wt;
				}
				$flag=1;
  }
//	echo "tot_net_wt total  is	$tot_net_wt  ";
	//echo "tot_gross_wt fob inr  is	$tot_gross_wt  ";
    	
        if($prevlinenum != '')
      {

	   $newli->updatepackingli($lirecnum);

     }

   else
   {
      $newli->setlink2packing($recnum);
      $newli->addpackingli();
   }
	 }
	 $m++;
	}
	while($z<$index_qty)
	{
	 $ponum_li="ponum_li" . $z;
	 $order_qtyli="order_qtyli".$z;
	 $this_shipment="this_shipment".$z;
	 $bal_dispatch="bal_dispatch".$z;
	 $prevponum="prevponum" . $z;
     $linerecnum="linerecnum" . $z;
     
	 $ponum_li1= $_REQUEST[$ponum_li];
	 $order_qtyli1=$_REQUEST[$order_qtyli];
	 $this_shipment1=$_REQUEST[$this_shipment];
	 $bal_dispatch1=$_REQUEST[$bal_dispatch];
     $linerecnum=$_REQUEST[$linerecnum];
	 $prevponum=$_REQUEST[$prevponum];
	// echo $ponum_li1."**************";
	 if($ponum_li1 !='')
	 {

       $newlogin->dbconnect();
	   $newli->setponum_li($ponum_li1);
       $newli->setorder_qty($order_qtyli1);
	   $newli->setthis_shipment($this_shipment1);
	   $newli->setbal_dispatch($bal_dispatch1);
	   $newli->setlink2packing($recnum);
	   //echo $prevponum."-------------------";
           if($prevponum != '')
      {

	   $newli->updatepackingqtyli($linerecnum);

     }

   else
   {
      $newli->setlink2packing($recnum);
      $newli->addpacking_qtyli();
   }

	 }
	 $z++;
	}
	
	 $newlogin->dbconnect();
    $newpacking->setpodate($podate);
    $newpacking->setponum($ponum);
    $newpacking->setwonum($wonum);
    $newpacking->setpackingnum($packingnum);
    $newpacking->setdescr($descr);
    $newpacking->setorder_qty($order_qty);
    $newpacking->setqty_disp($qty_disp);
    $newpacking->setcim_invoice($cim_invoice);
    $newpacking->setremarks($remarks);
    $newpacking->setpack_date($pack_date);
    $newpacking->setcompanyrecnum($companyrecnum);
    $newpacking->settype_packing($type_packing);
    $newpacking->setno_packing($no_packing);
    $newpacking->settransportation($transportation);
    $newpacking->setqty_bal($qty_bal);
    $newpacking->setlink2invoice($link2invoice);
    $newpacking->settot_net_wt($tot_net_wt);
    $newpacking->setgross_wt($tot_gross_wt);
    $newpacking->updatepacking($recnum);
}
header("Location:packingSummary.php" );
?>
