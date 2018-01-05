<?php
session_start();
header("Cache-control: private");
$userid = $_SESSION['user'];
include('classes/salesorderClass.php');
$newcrn4soli = new salesorder;
$i=0;
$crn_result=$newcrn4soli->getallcrn4soli();
while($myrm_details=mysql_fetch_assoc($crn_result))
{
        $currency = array("$");
        $rm_price = str_replace($currency, "", $myrm_details['rm_unitprize']);

       if($myrm_details['rm_qty_perbill'] != 0 && $myrm_details['rm_qty_perbill'] != '' && $myrm_details['rm_qty_perbill'] != 'null')
        {
	      $rm_unitcost=$rm_price/$myrm_details['rm_qty_perbill'];
	    }
	    else
        {
		  echo "Here";
	      $rm_unitcost=$rm_price;
	    }
	    //echo "<br>".number_format($rm_unitcost,2);
	    $unit_rm_cost=number_format($rm_unitcost,2);
	    $rm_amount=($myrm_details['qty']*$unit_rm_cost);
	    $i++;
	    //echo $unit_rm_cost;  rmtotal

         $result_so_update=$newcrn4soli->updateSoli_rmprice($unit_rm_cost,$myrm_details['crn_num'],$myrm_details['altspec'],$rm_amount);
         echo "<br>CRN_NUM:  ".$myrm_details['crn_num']."<br>QTY:  ".
               $myrm_details['rm_qty_perbill']."<br>PRICE: ".$unit_rm_cost.
              "<br>altspec:  ".$myrm_details['altspec']."<br>so QTY: ".$myrm_details['qty']."<br> RM_AMOUNT: ".$rm_amount."<br>";

        
}
$rm_amount_tot=$newcrn4soli->gettotrm_amount();
while($mytotamount=mysql_fetch_assoc($rm_amount_tot))
{
     echo"<br><br><br><br>SO Total RM Amount: ".$mytotamount['total_rmamount']."<br>PO_NUM: ".$mytotamount['po_num']."<br>" ;
     $newcrn4soli->updateSo_rmamount($mytotamount['total_rmamount'],$mytotamount['po_num'] );
     //$total_rmamount=

}

?>

