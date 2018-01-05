<?php
// First include the class definition
include_once('classes/dnClass.php');
include_once('classes/dnliClass.php');

$newLI = new dnli;
$i = 0;
     $result = $newLI->getdeliver_restore();

            while ($myrow = mysql_fetch_assoc($result)) {
            $prefix = "DN";
		    $strrecnum=sprintf("%03d",$myrow['recnum']);
		    $dnnum=$prefix.$strrecnum;
			$cofc = $myrow['cofc_num'];
			$won = $myrow['wonum'];
            $cofcnum=$newLI->checkCofc_sec($myrow['wonum']);
     	 	if($cofcnum==0) {
			 	   $recnum_wo=$newLI->checkWoLI($myrow['wonum']);
			 	   $dn_qty_recd=$newLI->getDn($myrow['recnum']);
                   $dn_qty_acc=$newLI->getDnAcc($myrow['recnum']);
			 	   //if($myrow['recnum'] !='') {
       	           $newLI->addWoLI_DNrestore($recnum_wo,$myrow['recnum'],$myrow['qty'],$dn_qty_recd,
                           $dn_qty_acc,$myrow['qty_rej'],$myrow['supplier_wo'],$myrow['cofc_num'],$myrow['cofc_date']);

                   $newLI->updateWO_acc4dnrestore($dn_qty_acc,$dn_qty_recd,$myrow['wonum'],$myrow['qty']);
                    echo "<br>(addwoli)WO Part Status Details Updated for WO # ".$myrow['wonum']."<br>";
                   //}
               }

              /*else{
			 	    $newLI->updateWoLI_restore($myrow['wonum'],$myrow['recnum'],
					   $myrow['qty'],$myrow['qty_recd'],
					   $myrow['qty_acc'],
					   $myrow['qty_rej'],$myrow['supplier_wo'],$myrow['cofc_num'],$myrow['cofc_date']);
                      $dn_qty_recd=$newLI->getDn($myrow['recnum']);
                      $dn_qty_acc=$newLI->getDnAcc($myrow['recnum']);
                      $newLI->updateWO_DN($dn_qty_acc,$dn_qty_recd,$myrow['wonum'],$myrow['qty']);
                       echo "<br>(updatewoli)WO Part Status Details Updated for DN# ".$myrow['wonum'];
            	    } */
            	$i++;

            }
           
           /* while ($myrow = mysql_fetch_assoc($result)) {


            $cofcnum=$newLI->checkCofc($myrow['cofc_num'],$myrow['wonum']);
     	 	if($cofcnum==0) {
			 	   $recnum_wo=$newLI->checkWoLI($myrow['wonum']);
			 	   if($recnum_wo !='') {
       	           $newLI->addWoLI_restore($recnum_wo,$myrow['recnum'],$myrow['qty'],$myrow['qty_recd'],$myrow['qty_acc'],$myrow['qty_rej'],$myrow['supplier_wo'],$myrow['cofc_num'],$myrow['cofc_date']);
                   $dn_qty_recd=$newLI->getDn($myrow['recnum']);
                   $dn_qty_acc=$newLI->getDnAcc($myrow['recnum']);
                   $newLI->updateWO_DN($dn_qty_acc,$dn_qty_recd,$myrow['wonum'],$myrow['qty']);
                    echo "<br>WO Part Status Details Updated for DN# ".$myrow['dnnum'];
                   }
               } else{
			 	      $newLI->updateWoLI_restore($myrow['wonum'],$myrow['recnum'],$myrow['qty'],$myrow['qty_recd'],$myrow['qty_acc'],$myrow['qty_rej'],$myrow['supplier_wo'],$myrow['cofc_num'],$myrow['cofc_date']);
                      $dn_qty_recd=$newLI->getDn($myrow['recnum']);
                      $dn_qty_acc=$newLI->getDnAcc($myrow['recnum']);
                      $newLI->updateWO_DN($dn_qty_acc,$dn_qty_recd,$myrow['wonum'],$myrow['qty']);
                       echo "<br>WO Part Status Details Updated for DN# ".$myrow['dnnum'];
            	    }


            } */


?>

