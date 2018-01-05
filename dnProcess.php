<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = Mar 10, 2010                =
// Filename: dnoProcess.php                    =
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


include('classes/dnClass.php');
include('classes/dnliClass.php');

// Next, create an instance of the classes required
$newDeliver = new dn;
$newLI = new dnli;

// Get all fields related to PO
if ($pagename == 'dnEntry' || $pagename == 'dnEdit') {
 
   $sent_to = $_REQUEST['treat_to'];
   $deliver_to = $_REQUEST['treat_deliver'];
   $crn = $_REQUEST['crn'];
   $deliver_date = $_REQUEST['deliver_date'];
   $ponum = $_REQUEST['ponum'];
   $podate = $_REQUEST['podate'];
   $poline_num = $_REQUEST['poline_num'];

   $wonum = $_REQUEST['wonum'];
   $untreated_partnum = $_REQUEST['untreated_partnum'];
   $treated_partnum = $_REQUEST['treated_partnum'];
   $part_iss = $_REQUEST['part_iss'];
   $drg_iss = $_REQUEST['drg_iss'];

   $cos = $_REQUEST['cos'];
   $mtl_spec = $_REQUEST['mtl_spec'];
   $grn_num = $_REQUEST['grn_num'];
   $batch_num = $_REQUEST['batch_num'];
   $qty = $_REQUEST['qty']; 
   $remarks = $_REQUEST['remarks']; 
   $status = $_REQUEST['status']; 
   $po_qty = $_REQUEST['pur_qty'];
}
if ($pagename == 'dnEntry') {
$i=1;

$max=$_REQUEST['index'];
$flag=0;
				$newlogin = new userlogin;
				$newlogin->dbconnect();

		  		$newDeliver->setsent_to($sent_to);
			   	$newDeliver->setdeliver_to($deliver_to);	
			   	$newDeliver->setcrn($crn);
	  			$newDeliver->setdeliver_date($deliver_date);
    		    $newDeliver->setponum($ponum);
				$newDeliver->setpodate($podate);
			   	$newDeliver->setpoline_num($poline_num);
			   	$newDeliver->setwonum($wonum);
	  			$newDeliver->setuntreated_partnum($untreated_partnum);
    		    $newDeliver->settreated_partnum($treated_partnum);
				$newDeliver->setpart_iss($part_iss);
			   	$newDeliver->setdrg_iss($drg_iss);
			   	$newDeliver->setcos($cos);
	  			$newDeliver->setmtl_spec($mtl_spec);
    		    $newDeliver->setgrn_num($grn_num);
				$newDeliver->setbatch_num($batch_num);
  		        $newDeliver->setqty($qty);
				$newDeliver->setremarks($remarks);
                $newDeliver->setstatus($status);
                $newDeliver->setpo_qty($po_qty);

				$sql = "start transaction";
				$result = mysql_query($sql);
					
				$dnrecnum=$newDeliver->addDeliver();
				/*echo $dnrecnum;
			    $wodnnum=$newDeliver->updatewodnnum($wonum);*/
				$tot_qty=$newLI->getallDn4wo($wonum);
				//echo$tot_qty;
				// $newLI->update_new_WODN_qty($tot_qty,$wonum,$dnrecnum);
   		        $result = mysql_query($sql);
	             if(!$result)
                 {
		           $sql = "rollback";
		           $result = mysql_query($sql);
		           die("updateWO_DN Failed...Please report to Sysadmin. " . mysql_errno());
	             }
				 $flag=1;

while($i<=$max)
{
   $line_num="line_num" . $i;
   $cofc_num="cofc_num" . $i;
   $cofc_date="cofc_date" . $i;
   $qty_recd="qty_recd" . $i;
   $qty_acc="qty_acc" . $i;
   $qty_rej="qty_rej" . $i;
   $insp_stamp="insp_stamp" . $i;
   $supp_wo="supp_wo" . $i;
   $datecode="datecode" . $i;
   $nc_num="nc_num".$i;
   $cost="cost".$i;
   //$qty_rej4stores="qty_rej4stores" . $i;
   //$qty_rew="qty_rew" . $i;
   $qty_rewqa="qty_rewqa" . $i;
   

	$line_num1= $_REQUEST[$line_num];
	$cofc_num1 = $_REQUEST[$cofc_num];
	$cofc_date1 = $_REQUEST[$cofc_date];
	$qty_recd1 = $_REQUEST[$qty_recd];
	$qty_acc1 = $_REQUEST[$qty_acc];
	$qty_rej1 = $_REQUEST[$qty_rej];
	$insp_stamp1 = $_REQUEST[$insp_stamp];
	$supp_wo1 = $_REQUEST[$supp_wo];
	$datecode1 = $_REQUEST[$datecode];
	$nc_num1 = $_REQUEST[$nc_num];
	$cost1 = $_REQUEST[$cost];
	//$qty_rej4stores1=$_REQUEST[$qty_rej4stores];
    //$qty_rew1 = $_REQUEST[$qty_rew];
    $qty_rewqa1 = $_REQUEST[$qty_rewqa];
    
	if ($line_num1 != '')
	{
		if ($pagename == 'dnEntry')
		{




			$newLI->setlink2deliver($dnrecnum);	
			$newLI->setline_num($line_num1);
			$newLI->setcofc_num($cofc_num1);
			$newLI->setcofc_date($cofc_date1);
			$newLI->setqty_recd($qty_recd1);
			$newLI->setqty_acc($qty_acc1);
			$newLI->setqty_rej($qty_rej1);
			$newLI->setinsp_stamp($insp_stamp1);
			$newLI->setsupp_wo($supp_wo1);
			$newLI->setdatecode($datecode1);
			$newLI->setnc_num($nc_num1);
			$newLI->setcost($cost1);
			//$newLI->setqty_rej4stores($qty_rej4stores1);
		//	$newLI->setqty_rew($qty_rew1);
			$newLI->setqty_rewqa($qty_rewqa1);
         if($qty_rej1 != 0 && $qty_rej1 !='')
          {
            $result_nc4dn=$newLI->getnc4dn($nc_num1,$qty_rej1,$wonum);
            if(mysql_num_rows($result_nc4dn)>0)
            {

			$newLI->addLI();
			 $comp_qty = $qty_acc1-$prev_qty_acc1;
                  
                  $newLI->updatecompqty4dn($delrecnum,$comp_qty);
			$recnum_wo=$newLI->checkWoLI($wonum);
		    $result = mysql_query($sql);
			 if(!$result)
	       {
		       $sql = "rollback";
		       $result = mysql_query($sql);
		      die("checkWoLI Failed...Please report to Sysadmin. " . mysql_errno());
	       }
   		    $newLI->addWoLI($recnum_wo,$dnrecnum,$qty);
            $result = mysql_query($sql);
	        if(!$result)
	       {
		       $sql = "rollback";
		       $result = mysql_query($sql);
		      die("addWoLI Failed...Please report to Sysadmin. " . mysql_errno());
	       }
   		    
   		    $dn_qty_recd=$newLI->getDn($dnrecnum,$wonum);
            $dn_qty_acc=$newLI->getDnAcc($dnrecnum,$wonum);
            $tot_qty=$newLI->getallDn4wo($wonum);
				//echo$tot_qty;
           $newLI->updateWO_DN($dn_qty_acc,$dn_qty_recd,$wonum,$tot_qty);
          if(!$result)
	       {
		       $sql = "rollback";
		       $result = mysql_query($sql);
		      die("updateWO_DN Failed...Please report to Sysadmin. " . mysql_errno());
	       }
	       }
	       else
	       {
	           echo "<table border=1><tr><td><font color=#FF0000>";
               die("Please Check The NC # Or Qty(Rej) Entered" );
               echo "</td></tr></table>";
	       }
   		  }
   		  else
   		  {
            $newLI->addLI();
             $comp_qty = $qty_acc1-$prev_qty_acc1;
                  
                  $newLI->updatecompqty4dn($delrecnum,$comp_qty);
			$recnum_wo=$newLI->checkWoLI($wonum);
		    $result = mysql_query($sql);
			 if(!$result)
	       {
		       $sql = "rollback";
		       $result = mysql_query($sql);
		      die("checkWoLI Failed...Please report to Sysadmin. " . mysql_errno());
	       }
   		    $newLI->addWoLI($recnum_wo,$dnrecnum,$qty);
            $result = mysql_query($sql);
	        if(!$result)
	       {
		       $sql = "rollback";
		       $result = mysql_query($sql);
		      die("addWoLI Failed...Please report to Sysadmin. " . mysql_errno());
	       }

   		    $dn_qty_recd=$newLI->getDn($dnrecnum,$wonum);
            $dn_qty_acc=$newLI->getDnAcc($dnrecnum,$wonum);
            $tot_qty=$newLI->getallDn4wo($wonum);
				//echo$tot_qty;
           $newLI->updateWO_DN($dn_qty_acc,$dn_qty_recd,$wonum,$tot_qty);
          if(!$result)
	       {
		       $sql = "rollback";
		       $result = mysql_query($sql);
		      die("updateWO_DN Failed...Please report to Sysadmin. " . mysql_errno());
	       }
   		  }
   		}
	}
	$i++;
}
			$sql = "commit";
			$result = mysql_query($sql);
			if(!$result)
			{
				 $sql = "rollback";
				 $result = mysql_query($sql);
				 die("Commit failed for DN LI Insert..Please report to Sysadmin. " . mysql_errno());
			}
header("Location:dnSummary.php?crn_num=".$crn."&status=new" );
}

if ($pagename == 'dnEdit')
{
//echo "i am inside dispatchupdate";
$delrecnum = $_REQUEST['delrecnum'];

$i=1;
$max=$_REQUEST['index'];
$flag=0;
   				$newlogin = new userlogin;
				$newlogin->dbconnect();

  				$sql = "start transaction";
 				$result = mysql_query($sql);

                $newDeliver->setsent_to($sent_to);
			   	$newDeliver->setdeliver_to($deliver_to);	
			   	$newDeliver->setcrn($crn);
	  			$newDeliver->setdeliver_date($deliver_date);
    		    $newDeliver->setponum($ponum);
				$newDeliver->setpodate($podate);
			   	$newDeliver->setpoline_num($poline_num);
			   	$newDeliver->setwonum($wonum);
	  			$newDeliver->setuntreated_partnum($untreated_partnum);
    		    $newDeliver->settreated_partnum($treated_partnum);
				$newDeliver->setpart_iss($part_iss);
			   	$newDeliver->setdrg_iss($drg_iss);
			   	$newDeliver->setcos($cos);
	  			$newDeliver->setmtl_spec($mtl_spec);
   			    $newDeliver->setgrn_num($grn_num);
				$newDeliver->setbatch_num($batch_num);
  		        $newDeliver->setqty($qty);
				$newDeliver->setremarks($remarks);
				$newDeliver->setstatus($status);
                $newDeliver->setpo_qty($po_qty);
                $newDeliver->updateDeliver($delrecnum);
                $tot_qty=$newLI->getallDn4wo($wonum);
				//echo$tot_qty;
  		        // $newLI->updateWODN_qty($tot_qty,$wonum,$delrecnum);
   		        $result = mysql_query($sql);
	             if(!$result)
                 {
		           $sql = "rollback";
		           $result = mysql_query($sql);
		           die("updateWO_DN Failed...Please report to Sysadmin. " . mysql_errno());
	             }
				$flag=1;
 			        //echo 'a cancel status'.$status;


while($i<=$max)
{
	//echo "i am inside while loop" .$i;
	$line_num="line_num" . $i;
	$dn_stage="dn_stage" . $i;
    $cofc_num="cofc_num" . $i;
    $cofc_date="cofc_date" . $i;
    $qty_recd="qty_recd" . $i;
    $qty_acc="qty_acc" . $i;
    $qty_rej="qty_rej" . $i;
    $insp_stamp="insp_stamp" . $i;
    $supp_wo="supp_wo" . $i;
    $datecode="datecode" . $i;
    $nc_num="nc_num".$i;
    $cost="cost".$i;
    $disp_qty="disp_qty".$i;
   // echo $cost."-************";
	$prelinenum="prev_line_num" . $i;
	$lirecnum="lirecnum" . $i;
    $qty_rej4stores= "qty_rej4stores" . $i;
    $qty_rew="qty_rew" . $i;
    $qty_rewqa="qty_rewqa" . $i;
    $prev_qty_acc="prev_qty_acc" . $i;

	$prevlinenum1=$_REQUEST[$prelinenum];
	$lirecnum1=$_REQUEST[$lirecnum];

	$line_num1= $_REQUEST[$line_num];
	$dn_stage1= $_REQUEST[$dn_stage];
	$cofc_num1 = $_REQUEST[$cofc_num];
	$cofc_date1 = $_REQUEST[$cofc_date];
	$qty_recd1 = $_REQUEST[$qty_recd];
	$qty_acc1 = $_REQUEST[$qty_acc];
	$qty_rej1 = $_REQUEST[$qty_rej];
	$insp_stamp1 = $_REQUEST[$insp_stamp];
	$supp_wo1 = $_REQUEST[$supp_wo];
	$datecode1 = $_REQUEST[$datecode];
	$nc_num1 = $_REQUEST[$nc_num];
	$cost1 = $_REQUEST[$cost];
	$disp_qty1 = $_REQUEST[$disp_qty];
	$prev_qty_acc1 = $_REQUEST[$prev_qty_acc];
 	//$qty_rej4stores1=$_REQUEST[$qty_rej4stores];
	//$qty_rew1 = $_REQUEST[$qty_rew];
	$qty_rewqa1 = $_REQUEST[$qty_rewqa];
//	echo "<br>".$cost1;
	$newlogin = new userlogin;
	$newlogin->dbconnect();
        //echo $nc_num1."--------";
	//echo "<br>Values for line number   :$linenumber1<br>$itemname1<br>$itemdesc1<br>$qty1<br>$rate1<br>$duedate1";
	if ($line_num1 != '')
	{
            //echo $qty_rej4stores1."in---p---r---";
            $newLI->setlink2deliver($delrecnum);
            $newLI->setline_num($line_num1);
            $newLI->setdn_stage($dn_stage1);
			$newLI->setcofc_num($cofc_num1);
			$newLI->setcofc_date($cofc_date1);
			$newLI->setqty_recd($qty_recd1);
			$newLI->setqty_acc($qty_acc1);
			$newLI->setdisp_qty($disp_qty1);
			$newLI->setqty_rej($qty_rej1);
			$newLI->setinsp_stamp($insp_stamp1);
			$newLI->setsupp_wo($supp_wo1);
			$newLI->setdatecode($datecode1);
            $newLI->setnc_num($nc_num1);
            $newLI->setcost($cost1);

            // echo "<pre>";
            // print_r($_REQUEST);
           //	$newLI->setqty_rej4stores($qty_rej4stores1);
           	//$newLI->setqty_rew($qty_rew1);
           	$newLI->setqty_rewqa($qty_rewqa1);
            if($prevlinenum1!='')
			{

               if($qty_rej1 != 0 && $qty_rej1 !='')
               { //echo"$nc_num1<br>$qty_rej1";
               $result_nc4dn=$newLI->getnc4dn($nc_num1,$qty_rej1,$wonum);
               if(mysql_num_rows($result_nc4dn)>0)
               {
			 	$newLI->updateLI($lirecnum1);
			 	 $comp_qty = $qty_acc1-$prev_qty_acc1;
                  
                  $newLI->updatecompqty4dn($delrecnum,$comp_qty);
			 	$cofcnum=$newLI->checkCofc($cofc_num1,$wonum);

			 	if($cofcnum==0)
                  {
			 	   $recnum_wo=$newLI->checkWoLI($wonum);
   		           // $newLI->addWoLI($recnum_wo,$delrecnum,$qty);
   		            $dn_qty_recd=$newLI->getDn($delrecnum,$wonum);
   		            //echo $dn_qty_recd."recd33333<br>";
   		            $dn_qty_acc=$newLI->getDnAcc($delrecnum,$wonum);
   		            //echo $dn_qty_acc."acc33333<br>";
   		                 $tot_qty=$newLI->getallDn4wo($wonum);
				//echo$tot_qty;
                    // $newLI->updateWO_DN($dn_qty_acc,$dn_qty_recd,$wonum,$tot_qty);
 
			 	} else{
			 	      // $newLI->updateWoLI($wonum,$delrecnum,$qty);
                      $dn_qty_recd=$newLI->getDn($delrecnum,$wonum);
                      //echo $dn_qty_recd."recd111111<br>";
                      $dn_qty_acc=$newLI->getDnAcc($delrecnum,$wonum);
                        //echo $dn_qty_acc."accc111111111<br>";
                        $tot_qty=$newLI->getallDn4wo($wonum);
				//echo$tot_qty;
                    // $newLI->updateWO_DN($dn_qty_acc,$dn_qty_recd,$wonum,$tot_qty);

			 	}
			 	}
			 	else
			 	{
			 	  echo "<table border=1><tr><td><font color=#FF0000>";
                  die("Please Check The NC # Or Qty(Rej) Entered" );
                  echo "</td></tr></table>";
			 	}
			 	}
			 	else
			 	{
                  $newLI->updateLI($lirecnum1);
                
                   $comp_qty = $qty_acc1-$prev_qty_acc1;
                  
                  $newLI->updatecompqty4dn($delrecnum,$comp_qty);
			 	  $cofcnum=$newLI->checkCofc($cofc_num1,$wonum);
 			 	if($cofcnum==0)
                  {
			 	   // $recnum_wo=$newLI->checkWoLI($wonum);
   		           // $newLI->addWoLI($recnum_wo,$delrecnum,$qty);
   		            $dn_qty_recd=$newLI->getDn($delrecnum,$wonum);
   		            //echo $dn_qty_recd."recd33333<br>";
   		            $dn_qty_acc=$newLI->getDnAcc($delrecnum,$wonum);
   		            //echo $dn_qty_acc."acc33333<br>";
   		                 $tot_qty=$newLI->getallDn4wo($wonum);
				//echo$tot_qty;
                    // $newLI->updateWO_DN($dn_qty_acc,$dn_qty_recd,$wonum,$tot_qty);

			 	} else
                 {
			 	      // $newLI->updateWoLI($wonum,$delrecnum,$qty);
                      $dn_qty_recd=$newLI->getDn($delrecnum,$wonum);
                      //echo $dn_qty_recd."recd111111<br>";
                      $dn_qty_acc=$newLI->getDnAcc($delrecnum,$wonum);
                        //echo $dn_qty_acc."accc111111111<br>";
                        $tot_qty=$newLI->getallDn4wo($wonum);
				//echo$tot_qty;
                    // $newLI->updateWO_DN($dn_qty_acc,$dn_qty_recd,$wonum,$tot_qty);
			 	}
			 	}
 			}
			else
			{
              if($qty_rej1 != 0 && $qty_rej1 !='')
              {
               $result_nc4dn=$newLI->getnc4dn($nc_num1,$qty_rej1,$wonum);
               if(mysql_num_rows($result_nc4dn)>0)
               {
                $newLI->setlink2deliver($delrecnum);
      		    $newLI->addLI();
      		     $comp_qty = $qty_acc1-$prev_qty_acc1;
                  
                  $newLI->updatecompqty4dn($delrecnum,$comp_qty);
                // $recnum_wo=$newLI->checkWoLI($wonum);

   		        // $newLI->addWoLI($recnum_wo,$delrecnum,$qty);

   		        $dn_qty_recd=$newLI->getDn($delrecnum,$wonum);
   		       //echo $dn_qty_recd."recd22222<br>";
                $dn_qty_acc=$newLI->getDnAcc($delrecnum,$wonum);
                //echo $dn_qty_acc."acc22222<br>";
                $tot_qty=$newLI->getallDn4wo($wonum);
				//echo$tot_qty;
                 // $newLI->updateWO_DN($dn_qty_acc,$dn_qty_recd,$wonum,$tot_qty);
               }else
               {
                  echo "<table border=1><tr><td><font color=#FF0000>";
                  die("Please Check The NC # Or Qty(Rej) Entered" );
                  echo "</td></tr></table>";
               }
              
              }else
              {
              
		       $newLI->setlink2deliver($delrecnum);
      		   $newLI->addLI();
      		    $comp_qty = $qty_acc1-$prev_qty_acc1;
                  
                  $newLI->updatecompqty4dn($delrecnum,$comp_qty);
               // $recnum_wo=$newLI->checkWoLI($wonum);
 
   		       // $newLI->addWoLI($recnum_wo,$delrecnum,$qty);
 
   		       $dn_qty_recd=$newLI->getDn($delrecnum,$wonum);
   		       //echo $dn_qty_recd."recd22222<br>";
               $dn_qty_acc=$newLI->getDnAcc($delrecnum,$wonum);
                //echo $dn_qty_acc."acc22222<br>";
                $tot_qty=$newLI->getallDn4wo($wonum);
				//echo$tot_qty;
            // $newLI->updateWO_DN($dn_qty_acc,$dn_qty_recd,$wonum,$tot_qty);
            }
	       }
 
			
	}
	else
	{
         if ($prevlinenum1 != '')
		 {		
			 $newLI->deleteLI($lirecnum1);
			 // $newLI->deleteWOLI($cofc_num1,$wonum);
		  }

	}
   // if($status == 'Cancelled')
   //    {
   //       $newLI->deleteDN_WO($cofc_num1,$wonum,$delrecnum);
   //       // $newLI->updateWO_DN_QTY($wonum);

   //    }

$i++;
}
	 $sql = "commit";
	 $result = mysql_query($sql);
	 if(!$result)
	 {
		 $sql = "rollback";
		 $result = mysql_query($sql);
		 die("Commit failed Deliver Insert..Please report to Sysadmin. " . mysql_errno());
	 }

header("Location:dnDetails.php?crn_num=".$crn."&status=edit&recnum=".$delrecnum);
}
?>
