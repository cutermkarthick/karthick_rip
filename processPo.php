<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = June 20, 2004                =
// Filename: processPo.php                     =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OWT                          =
// Allows processing of POs                    =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location:login.php" );

}
$userid = $_SESSION['user'];

$pagename = $_SESSION['pagename'];


include('classes/poClass.php');
include('classes/liClass.php');
include('classes/purchasing_allocClass.php');

// Next, create an instance of the classes required
$newPO = new po;
$newLI = new po_line_items;
$newpur = new purchasing_alloc;

// Get all fields related to PO
if ($pagename == 'newpo' || $pagename == 'poupdate' || $pagename == 'vendpoupd') {
   $vendorrecnum = $_REQUEST['vendrecnum'];
   $podate = $_REQUEST['podate'];
   $ponum = $_REQUEST['ponum'];
   //$wonum = $_REQUEST['wonum'];
   $descr = $_REQUEST['desc'];
   $status = $_REQUEST['status'];
   //echo"===$status";
   $tax=$_REQUEST['tax'];
   $shipping=$_REQUEST['shipping'];
   $labor=$_REQUEST['labor'];
   $currency=$_REQUEST['currency'];
   $remarks=$_REQUEST['remarks'];  
   $terms=$_REQUEST['terms'];
   $approval= $_REQUEST['approval'];
   $approvaldate= $_REQUEST['approvaldate'];
   $amendment_num= $_REQUEST['amendment_num'];
   $amendmentdate= $_REQUEST['amendmentdate'];
   $amendment_notes= $_REQUEST['amendment_notes'];
   $potype=$_REQUEST['potype'];
   if (isset($_REQUEST['communication']))
	{
         $communication = $_REQUEST['communication'];
   }
   else $communication = 0;
}
if ($pagename == 'newpo')
{
$crdate = date("d-M-y");
$i=1;
$poamount=0;

$total_due=0;

$flag=0;
while($i<=30)
{
	$linenumber="line_num" . $i;
	$itemname="rmcode" . $i;
	$itemdesc="item_desc" . $i;
	$qty="qty" . $i;
	$material_ref="material_ref" . $i;
	$duedate="due_date" . $i;
    $delvby="delvby" . $i;
	$rate="rate" . $i;
	$material_spec="material_spec" . $i;
	$dia="dia" . $i;
    $thick="thick" . $i;
    $width="width" . $i;
    $len="len" . $i;
    $qty_per_meter="qty_per_meter" . $i;
    $no_of_meterages="no_of_meterages" . $i;
	$uom="uom" . $i;
    $no_of_lengths="no_of_lengths" . $i;
    $grainflow="grainflow" . $i;
    $crn="crn" . $i;
    $condition="condition" . $i;
    $maxruling="maxruling" . $i;
    $delivery = "delivery" . $i;
    $qty_rej = "qty_rej". $i;
    $order_qty = "order_qty". $i;
    $alt_spec = "alt_spec". $i;
    $spec_type="spec_type".$i;
    $layoutrefnum="layoutrefnum".$i;
    $li_status="li_status".$i;
    $qty_recd="qty_recd".$i;
    $accepted_date="accepted_date".$i;
    $remarks_li="remarks_li".$i;
    $grn_num="grn_num".$i;
    $due_datef="due_datef" . $i;
    $due_dates="due_dates" . $i;

	$linenumber1= $_REQUEST[$linenumber];
	$itemname1 = $_REQUEST[$itemname];
	$itemdesc1 = $_REQUEST[$itemdesc];
	$qty1 = $_REQUEST[$qty];
	$material_ref1 = $_REQUEST[$material_ref];
	$rate1 = $_REQUEST[$rate];
	$duedate1 = $_REQUEST[$duedate];
    $delvby1 = $_REQUEST[$delvby];
    $due_date_f = $_REQUEST[$due_datef];
    $due_date_s = $_REQUEST[$due_dates];
	$material_spec1 = $_REQUEST[$material_spec];
	
	$dia1 = $_REQUEST[$dia];
	if($dia1 == '')
	{
	 $thick1 = $_REQUEST[$thick];
	}
	else
	{
     $thick1 = $dia1;
    }
	$width1 = $_REQUEST[$width];
	$length1 = $_REQUEST[$len];
	$qty_per_meter1 = $_REQUEST[$qty_per_meter];
	$no_of_meterages1 = $_REQUEST[$no_of_meterages];
	$no_of_lengths1 = $_REQUEST[$no_of_lengths];
	$uom1 = $_REQUEST[$uom];
	$grainflow1 = $_REQUEST[$grainflow];
	$crn1 = $_REQUEST[$crn];
	$condition1 = $_REQUEST[$condition];
	$maxruling1 = $_REQUEST[$maxruling];
	$delivery1 = $_REQUEST[$delivery];
    $qty_rej1 = $_REQUEST[$qty_rej];
    $order_qty1 = $_REQUEST[$order_qty];
    $alt_spec1 = $_REQUEST[$alt_spec];
    $spec_type1=$_REQUEST[$spec_type];
    $layoutrefnum1=$_REQUEST[$layoutrefnum];
    $li_status1=$_REQUEST[$li_status];
    $qty_recd1=$_REQUEST[$qty_recd];
    $accepted_date1=$_REQUEST[$accepted_date];
    $remarks_li1=$_REQUEST[$remarks_li];
     $grn_num1=$_REQUEST[$grn_num];
    // echo "$due_date_f Due date is $due_date_s-----------$due_datef-----------$due_dates<br>";
	//echo "<br>Values for line number   :$linenumber1<br>$itemname1<br>$itemdesc1<br>$qty1<br>$rate1<br>$duedate1";
	if ($linenumber1 != '')
	{
		$amount1=0;
             /* $resultRm=$newLI->getrm_qty($crn1,$alt_spec1);
  		 $myRm=mysql_fetch_row($resultRm);
  		 //echo $myRm[1]."gyyggyghgh";
	    	if($myRm[0]!=0 ||$myRm[0] !=''){
               if($myRm[1]!=0 || $myRm[1] !=''){
                $no_of_lengths1 =$order_qty1/$myRm[0] ;

               }
               else{
                 $no_of_meterages1=$order_qty1/$myRm[0] ;
               }
     	   }
     	   else{
     	     $no_of_meterages1 = $_REQUEST[$no_of_meterages];

	         $no_of_lengths1 = $_REQUEST[$no_of_lengths];
     	   }  */

                if ($no_of_meterages1 != 0)
                {
		           $amount1 = $rate1 * $no_of_meterages1;

                }
                else
                {
                    $amount1 = $rate1 * $no_of_lengths1;

                }


				//echo$no_of_meterages1."IN PROCESS PO";

		//echo "linenumber   :$linenumber1<br>amount      :$amount1</br>";
		if ($pagename == 'newpo')
		{
			//echo $spec_type1."888888888888";
			if($flag==0)
			{
				$j=1;


				while($j<=30)
				{
					$linetot="line_num" . $j;
					$qtytot="no_of_meterages" . $j;
					$ratetot="rate" . $j;
					$linenumber2= $_REQUEST[$linetot];
                                        $qtytot1="no_of_lengths" . $j;
                                        if ($_REQUEST[$qtytot] != '0')
                                        {
					    $qty2 = $_REQUEST[$qtytot];
                                        }
                                        else 
                                        {
					    $qty2 = $_REQUEST[$qtytot1];
                                        }
                                        
					$rate2 = $_REQUEST[$ratetot];
					if ($linenumber2 != '')
					{
						$amount2=0;
						$amount2 = $rate2 * $qty2;
						$poamount= $poamount+$amount2;

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
  				$newPO->setponum($ponum);
				$newPO->setremarks($remarks);
		  		$newPO->setpodate($podate);
			   	$newPO->setdescr($descr);
   				//$newPO->setwonum($wonum);
	  			$newPO->setpoamount($poamount);
                $newPO->setcurrency($currency);
	  			$newPO->settax($tax1);
	  			$newPO->setshipping($shipping1);
	  			$newPO->setlabor($labor1);
	  			$newPO->settotaldue($total_due);
		   		$newPO->setvendor($vendorrecnum);
                $newPO->setterms($terms);
                $newPO->setamendment_num($amendment_num);
                $newPO->setamendmentdate($amendmentdate);
                $newPO->setamendment_notes($amendment_notes);
                $newPO->setcomm($communication);
                $newPO->setpotype($potype);

				$sql = "start transaction";
				$result = mysql_query($sql);
				$porecnum = $newPO->addPO();
				$flag=1;
              
				//echo "PO Amount is     :$poamount";
			}
			
			$newLI->setvendor($vendorrecnum);
			$newLI->setponum($ponum);
			
			$newLI->setlink2po($porecnum);
			$newLI->setcrn($crn1);
			$newLI->setcondition($condition1);
			$newLI->setlinenum($linenumber1);
			$newLI->setitemname($itemname1);
			$newLI->setitemdesc($itemdesc1);
			$newLI->setqty($qty1);
			$newLI->setmaterial_ref($material_ref1);
			 
			$newLI->setmaterial_spec($material_spec1);
			$newLI->setthick($thick1);
			$newLI->setwidth($width1);
			$newLI->setlength($length1);
			$newLI->setqty_per_meter($qty_per_meter1);
			$newLI->setno_of_meterages($no_of_meterages1);

			$newLI->setno_of_lengths($no_of_lengths1);
			$newLI->setuom($uom1);
			$newLI->setgrainflow($grainflow1);
			$newLI->setmaxruling($maxruling1);
			$newLI->setqtyrej($qty_rej1);
			$newLI->setdelivery($delivery1);
			$newLI->setduedate($duedate1);
            $newLI->setdelvby($delvby1);
			$newLI->setrate($rate1);
			$newLI->setamount($amount1);
            $newLI->setorder_qty($order_qty1);
            $newLI->setalt_spec($alt_spec1);
            $newLI->setspec_type($spec_type1);
            $newLI->setlayoutrefnum($layoutrefnum1);
            $newLI->setstatus($li_status1);
            $newLI->setqty_recd($qty_recd1);
            $newLI->setaccepted_date($accepted_date1);
            $newLI->setremarks($remarks_li1);
            $newLI->setgrn_num($grn_num1);
            $newLI->setdue_date1($due_date_f);
            $newLI->setdue_date2($due_date_s);
              //else
              //{
                $newLI->addLI();
              //}


			$sql = "commit";
			$result = mysql_query($sql);
			if(!$result)
			{
				 $sql = "rollback";
				 $result = mysql_query($sql);
				 die("Commit failed PO Insert..Please report to Sysadmin. " . mysql_errno());
			}
		}
	}
	$i++;
}
}

if ($pagename == 'poupdate' || $pagename == 'vendpoupd')
{
//echo "i am inside poupdates";
$vendrecnum  = $_REQUEST['vendrecnum'];
$porecnum = $_REQUEST['porecnum'];
$remarks = $_REQUEST['remarks'];

$crdate = date("d-M-y");
$i=1;

$poamount=0;
$total_due=0;

$flag=0;  $lnnumber="";  $tot_recd=0;  $prev_ln="#";  $testflag=0;
while($i<=30)
{
	//echo "i am inside while loop";
	$linenumber="line_num" . $i;
	$itemname="rmcode" . $i;
	$itemdesc="item_desc" . $i;
	$qty="qty" . $i;
	$material_ref="material_ref" . $i;
	$duedate="due_date" . $i;
	$accepted_date="accepted_date" . $i;
    $delvby="delvby" . $i;
	$rate="rate" . $i;
	$prelinenum="prev_line_num" . $i;
	$lirecnum="lirecnum" . $i;
	
        $material_spec="material_spec" . $i;
	    $dia="dia" . $i;
        $thick="thick" . $i;
        $width="width" . $i;
        $len="len" . $i;
    	$qty_per_meter="qty_per_meter" . $i;
    	$no_of_meterages="no_of_meterages" . $i;
	    $uom="uom" . $i;
    	$no_of_lengths="no_of_lengths" . $i;
    	$grainflow="grainflow" . $i;
    	$crn="crn" . $i;
    	$condition="condition" . $i;
    	$maxruling="maxruling" . $i;
    	$delivery = "delivery" . $i;
    	$qty_rej = "qty_rej" . $i;
    	$order_qty = "order_qty". $i;
        $alt_spec = "alt_spec". $i;
        $spec_type="spec_type".$i;
        $layoutrefnum="layoutrefnum".$i;
        $li_status="li_status".$i;
        $qty_recd="qty_recd".$i ;
        $remarks_li="remarks_li".$i;
        $grn_num="grn_num".$i;
        $due_datef="due_datef" . $i;
        $due_dates="due_dates" . $i;

	//echo "<br>$linenumber<br>$itemname<br>$itemdesc<br>$qty<br>$rate<br>$duedate<br>";
	//$linenumber1='';$itemname1='';$itemdesc1='';$itemdesc1='';$qty1='';$rate1='';$duedate1='';
	//echo $_REQUEST['line_num1'];
	//if(isset($_REQUEST[$linenumber]))
		//echo "line num is set ";
	$lirecnum1=$_REQUEST[$lirecnum];
	$prevlinenum1=$_REQUEST[$prelinenum];
	$linenumber1= $_REQUEST[$linenumber];
	$itemname1 = $_REQUEST[$itemname];
	$itemdesc1 = $_REQUEST[$itemdesc];
	$qty1 = $_REQUEST[$qty];
	$material_ref1 = $_REQUEST[$material_ref];
	$material_spec1 = $_REQUEST[$material_spec];
       $dia1 = $_REQUEST[$dia];
	if($dia1 == '')
	{
	 $thick1 = $_REQUEST[$thick];
	}
	else
	{
     $thick1 = $dia1;
    }
	$width1 = $_REQUEST[$width];
	$length1 = $_REQUEST[$len];
	$qty_per_meter1 = $_REQUEST[$qty_per_meter];
	$no_of_meterages1 = $_REQUEST[$no_of_meterages];

	$no_of_lengths1 = $_REQUEST[$no_of_lengths];
	$uom1 = $_REQUEST[$uom];
	$grainflow1 = $_REQUEST[$grainflow];

	$rate1 = $_REQUEST[$rate];
	$duedate1 = $_REQUEST[$duedate];
        $delvby1 = $_REQUEST[$delvby];
	$accepteddate1 = $_REQUEST[$accepteddate];
	$crn1 = $_REQUEST[$crn];
	$condition1 = $_REQUEST[$condition];
	$maxruling1 = $_REQUEST[$maxruling];
	$delivery1 = $_REQUEST[$delivery];
	$qty_rej1 = $_REQUEST[$qty_rej];
	$order_qty1 = $_REQUEST[$order_qty];
	//echo $order_qty1."************";
    $alt_spec1 = $_REQUEST[$alt_spec];
    $spec_type1=$_REQUEST[$spec_type];
    $layoutrefnum1=$_REQUEST[$layoutrefnum];
    $li_status1=$_REQUEST[$li_status];
    $qty_recd1=$_REQUEST[$qty_recd];
    $accepted_date1=$_REQUEST[$accepted_date];
    $remarks_li1=$_REQUEST[$remarks_li];
    $grn_num1=$_REQUEST[$grn_num];
    $due_date_f = $_REQUEST[$due_datef];
    $due_date_s = $_REQUEST[$due_dates];
    //echo$alt_spec1."here in proc<br>";
	$newlogin = new userlogin;
	$newlogin->dbconnect();

	//echo "<br>Values for line number   :$linenumber1<br>$itemname1<br>$itemdesc1<br>$qty1<br>$rate1<br>$duedate1";
	if ($linenumber1 != '')
	{
	//	echo "<br>this is line no   :$linenumber1";
  		$amount1=0;
  	/*	 $resultRm=$newLI->getrm_qty($crn1,$alt_spec1);
  	    $myRm=mysql_fetch_row($resultRm) ;
  		 
  		 //echo $myRm[1]."gyyggyghgh";
	    	if($myRm[0]!=0 ||$myRm[0] !=''){
               if($myRm[1]!=0 || $myRm[1] !=''){
                $no_of_lengths1 =($order_qty1/$myRm[0]) ;
                //echo $no_of_lengths1."////////";
               }
               else{
                 $no_of_meterages1=$order_qty1/$myRm[0] ;
               }
     	   }
     	   else{
     	     $no_of_meterages1 = $_REQUEST[$no_of_meterages];

	         $no_of_lengths1 = $_REQUEST[$no_of_lengths];
     	   } */

                if ($no_of_meterages1 != 0)
                {
		           $amount1 = $rate1 * $no_of_meterages1;

                }
                else
                {
                    $amount1 = $rate1 * $no_of_lengths1;

                }
                

				//echo$no_of_lengths1."IN PROCESS PO";

			  //echo"<br>".$rm_qty."<br>".round($order_qty1."IN PROCESS PO";
             //$amount1 = $rate1 * $order_qty1;
			if($flag==0)
			{
				$j=1;
				while($j<=30)
				{
					$linetot="line_num" . $j;
					$qtytot="no_of_meterages" . $j;
					$ratetot="rate" . $j;
					$linenumber2= $_REQUEST[$linetot];
					$qty2 = $_REQUEST[$qtytot];
                                        $qtytot1="no_of_lengths" . $j;
                                        if ($_REQUEST[$qtytot] != '0')
                                        {
                                            $qty2 = $_REQUEST[$qtytot];
                                        }
                                        else 
                                        {
                                            $qty2 = $_REQUEST[$qtytot1];
                                        }
					$rate2 = $_REQUEST[$ratetot];
					if ($linenumber2 != '')
					{
						$amount2=0;
						$amount2 = $rate2 * $qty2;
						$poamount=$poamount+$amount2;

						$tax1 = $tax;
						$shipping1 = $shipping;
						$labor1 = $labor;
						$total_due = $tax1+$shipping1+$labor1+$poamount;
						//echo "linenumber    :$linenumber2</br>rate  :$rate2<br>qty    :$qty2<br>poamount    :$poamount";
					}
					$j++;
				}

				
  				$sql = "start transaction";
 				$result = mysql_query($sql);
		  		$newPO->setpodate($podate);
				$newPO->setremarks($remarks);
			   	$newPO->setdescr($descr);
                $newPO->setcurrency($currency);
                $newPO->setpoamount($poamount);
	  			$newPO->settax($tax1);
	  			$newPO->setshipping($shipping1);
	  			$newPO->setlabor($labor1);
	  			$newPO->settotaldue($total_due);

		   		$newPO->setvendor($vendorrecnum);
				$newPO->setpostatus($status);
				$newPO->setponum($ponum);
                $newPO->setterms($terms);
                $newPO->setapproval($approval);
                $newPO->setapprovaldate($approvaldate);
                $newPO->setamendment_num($amendment_num);
                $newPO->setamendmentdate($amendmentdate);
                $newPO->setamendment_notes($amendment_notes);
                $newPO->setcomm($communication);
                 $newPO->setpotype($potype);
 				$newPO->updatePO($porecnum);
				$flag=1;
				//echo "PO Amount is :$poamount";
			}
			

			 $newLI->setvendor($vendorrecnum);
			 $newLI->setponum($ponum);

		 	 $newLI->setlink2po($porecnum);
			 $newLI->setlinenum($linenumber1);
			 $newLI->setcrn($crn1);
			 $newLI->setcondition($condition1);
			 $newLI->setitemname($itemname1);
		     $newLI->setitemdesc($itemdesc1);
		     $newLI->setqty($qty1);
		     $newLI->setmaterial_ref($material_ref1);
			 
			 $newLI->setmaterial_spec($material_spec1);
			 $newLI->setthick($thick1);
			 $newLI->setwidth($width1);
			 $newLI->setlength($length1);
			 $newLI->setqty_per_meter($qty_per_meter1);
			 $newLI->setno_of_meterages($no_of_meterages1);
			 
			 $newLI->setno_of_lengths($no_of_lengths1);
			 $newLI->setuom($uom1);
			 $newLI->setgrainflow($grainflow1);
             $newLI->setmaxruling($maxruling1);
             $newLI->setqtyrej($qty_rej1);
             $newLI->setdelivery($delivery1);
			 $newLI->setduedate($duedate1);
			 $newLI->setaccepteddate($accepteddate1);

             $newLI->setdelvby($delvby1);
			 $newLI->setrate($rate1);
			 $newLI->setamount($amount1);
			 $newLI->setorder_qty($order_qty1);
             $newLI->setalt_spec($alt_spec1);
             $newLI->setspec_type($spec_type1);
             $newLI->setlayoutrefnum($layoutrefnum1);
             $newLI->setstatus($li_status1);
             $newLI->setqty_recd($qty_recd1);
             $newLI->setaccepted_date($accepted_date1);
             $newLI->setremarks($remarks_li1);
             $newLI->setgrn_num($grn_num1);
            $newLI->setdue_date1($due_date_f);
            $newLI->setdue_date2($due_date_s);
			 if($prevlinenum1!=='')
			{
				//echo"<br>".round($order_qty4)."++++++";
    			//echo "i am here updating";
                $newLI->updateLI($lirecnum1);
			}
			else
			{
				//echo "i am here adding";
              //else
              //{
                $newLI->setlink2po($porecnum);
                $newLI->addLI();
              //}
				

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
		 die("Commit failed PO Insert..Please report to Sysadmin. " . mysql_errno());
	 }
$i++;
}
}

if($pagename = 'purchasingUpdate')
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
    $linenumber="linenum" . $i;
    $mat_spec="mat_spec" . $i;
	$crn="crn" . $i;
	$qty_allocated="qty_allocated" . $i;
	$prevlinenum="prev_line_num" . $i;
	$lirecnum="lirecnum" . $i;
	
	$lirecnum1=$_REQUEST[$lirecnum];
	$prevlinenum1=$_REQUEST[$prevlinenum];
	$linenumber1= $_REQUEST[$linenumber];
	$mat_spec1 = $_REQUEST[$mat_spec];
	$crn1 = $_REQUEST[$crn];
	$qty_allocated1 = $_REQUEST[$qty_allocated];
	$ponum1=$_REQUEST['ponum'];
	$spec = str_replace(".","",$mat_spec1);
	$spec1 = str_replace(" ","",$spec);
	$spec2 = str_replace("-","",$spec1);
	$link=$_REQUEST[$linenumber1];
    //echo 'request='. $link;

	$newlogin = new userlogin;
	$newlogin->dbconnect();

	//echo "<br>Values for line number   :$linenumber1<br>$itemname1<br>$itemdesc1<br>$qty1<br>$rate1<br>$duedate1";
	if ($linenumber1 != '')
	{
	//echo 'in linenumber';
	   // $num = $linenumber1.$mat_spec1.$ponum1;
	    //echo'num='.$num;
        //echo 'link='.$link;

        $link2poli=$link;
        //echo 'link2poli='.$link2poli;

            $newpur->setpoli($link2poli);
			$newpur->setlinenum($linenumber1);
			$newpur->setmat_spec($mat_spec1);
			$newpur->setponum($ponum1);
			$newpur->setcim($crn1);
			$newpur->setqty($qty_allocated1);

            if($prevlinenum1!='')
            {
			 	$newpur->updateLI($lirecnum1);
            }
           else
           {
				 $newpur->setpoli($link2poli);
				 $newpur->addpurchasing();
           }
	}
 /*else
	{
		 if ($prevlinenum1 != '')
		 {
			//echo "i am here deleting";
			 $newLI->deleteLI($lirecnum1);
		  }
	}*/
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

// Update data

// Check if the delete flag is set
if ($_SESSION['pagename'] == 'poupdate') {
    $delete = $_REQUEST['deleteflag'];
}
if ($pagename == 'poupdate' && $delete == 'y') {
           $newPO->deletePO($porecnum);

}
if ($pagename == 'vendpoupd') {
//header("Location:vendpo.php" );
}
if ($_SESSION['pagename'] == 'newpo') {
   header("Location:poDetails.php?porecnum=$porecnum" );
}
else {
 header("Location:po.php" );
}
?>
