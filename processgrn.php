<?php
//==============================================
// Author: FSI                                 =
// Date-written = Mar 20, 2007                 =
// Filename: processgrn.php                    =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 WMS                          =
// Process GRN                                 =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];
$pagename = $_REQUEST['pagename'];

// Inlcude Classes that are required
include('classes/grnclass.php');
include('classes/grncofcclass.php');
include('classes/emailClass.php');
// Next, create an instance of the classes required
    $newgrn = new grn;
    $newcofc=new cofc;
    $newemail=new email;
    $rm_poqty=0;
// Request all fields of GRN for Insert

// echo "<pre>";
// print_r($_REQUEST); exit;

if ($pagename == 'new_grn' || $pagename == 'grn_swap' || $pagename == 'newcopy_grn'  )
{
	 $raw_mat_type = $_REQUEST["raw_mat_type"];
     $raw_mat_spec = $_REQUEST["raw_mat_spec"];
     $raw_mat_code = $_REQUEST["raw_mat_code"];
     $invoice_num = $_REQUEST["invoice_num"];
     $invoice_date = $_REQUEST["invoice_date"];
     $recieved_date = $_REQUEST["recieved_date"];
     $test_report = $_REQUEST["test_report"];
     $batch_num = $_REQUEST["batch_num"];
     $mgp_num = $_REQUEST["mgp_num"];
     $grnnum = $_REQUEST["grnnum"];
     $coc_refnum = $_REQUEST["coc_refnum"];
     $rmbycim = $_REQUEST["rmbycim"];
     $rmbycust = $_REQUEST["rmbycust"];
     $cimponum = $_REQUEST["cimponum"];
     $remarks = $_REQUEST["remarks"];
     $nc_refnum = $_REQUEST["nc_refnum"];
     $grntype = $_REQUEST["grntype"];
	 $grnDateQuar = $_REQUEST["Quarantined_date"];
     $crn = $_REQUEST["crn"];
     $vendrecnum = $_REQUEST["vendrecnum"];
     //echo"$vendrecnum------------";
     $dimension=$_REQUEST["dimensional"];
     $ndt=$_REQUEST["ndt"];
     $visual=$_REQUEST["visual"];
     $grain=$_REQUEST["grain"];
     $mech=$_REQUEST["mechanical"];
     $conductivity=$_REQUEST["conductivity"];
     $chemical=$_REQUEST["chemical"];
     $hardness=$_REQUEST["hardness"];
     $quantity=$_REQUEST["quantity"];
     $temper=$_REQUEST["temper"];
     $cus=$_REQUEST["cus"];
     $cim=$_REQUEST["cim"];
     $not=$_REQUEST["not"];
     $from=$_REQUEST["frmserial"];
     $to=$_REQUEST["toserial"];
     $con=$_POST["conformance"];
     $ncref=$_POST["ncref"];
     $ncrdate=$_POST["ncrdate"];
     $comm=$_POST["comm"];
     $dcomm=$_POST["dcomm"];
     $anotes=$_POST["anotes"];
     $approval=$_POST["approval"];
     $shipping_date=$_POST["shipping_date"];
     //$conversion_date=$_POST["shipping_date"];
	 $quarremarks=$_POST["quarremarks"];
	 $conversion_date=$_REQUEST["conversion_date"];
     $grnrecnum=$_REQUEST['grnrecnum'];

     $rm_empcode=$_REQUEST["rmempcode"];
     $rm_date=$_REQUEST["rmcheckdate"];
     $grn_empcode=$_REQUEST["grnempcode"];
     $grn_date=$_REQUEST["grncheckdate"];
     $rm_cost=$_REQUEST["rm_cost"];
     $rm_currency=$_REQUEST["currency"];
     $approved=$_REQUEST["approved_grn"];
     $rm_mismatch="";
     $rmpoline_num=$_REQUEST["rmpoline_num"];
	 if($pagename == 'new_grn')
       $parentgrnnum=$_REQUEST["parentgrnnum"];
	 else
	   $parentgrnnum=$_REQUEST["parent_grnnum"];
     $remainqty=$_REQUEST['remain_qty'];
	// echo $parentgrnnum.'----'.$pagename;
  
     $vendor=$_REQUEST["vendor"];
     $stdrev=$_REQUEST["stdrev"];
	 $qtm_req=$_REQUEST["qtm_req"];

	 $wo_ref=$_REQUEST["wo_ref"];

	  $wotype=$_REQUEST["wotype"];
     
     //$pocrn=$_REQUEST["pocrn"];
     if($_REQUEST["altcrn"] != '')
     {
      $altcrn=$_REQUEST["altcrn"];
     }else
     {
       $altcrn="";
     }
     if($_REQUEST["pocrn"] != '')
     {
      $pocrn=$_REQUEST["pocrn"];
     }else
     {
       $pocrn="";
     }
     if($altcrn!="")
     {
       $vcrn=$altcrn;
     }else
     {
       $vcrn=$pocrn;
     }

     $validatFlag=$_REQUEST["validate_flag"];
     
    
     $newlogin = new userlogin;
     $newlogin->dbconnect();
     
	 $newcofc->setcon($con); 
	 $newcofc->setncref($ncref);
	 $newcofc->setncrdate($ncrdate);
	 $newcofc->setcomm($comm);
	 $newcofc->setdcomm($dcomm);
	 $newcofc->setanotes($anotes);
	 $newcofc->setdimension($dimension);
	 $newcofc->setndt($ndt);
	 $newcofc->setvisual($visual);
	 $newcofc->setgrain($grain);
	 $newcofc->setmech($mech);
	 $newcofc->setcon1($conductivity);
	 $newcofc->setchemical($chemical);
	 $newcofc->sethardness($hardness);
	 $newcofc->setquantity($quantity);
	 $newcofc->settemper($temper);
	 $newcofc->setcus($cus);
	 $newcofc->setcim($cim);
	 $newcofc->setnot($not);
	 $newcofc->setfrom($from);
	 $newcofc->setto($to);
	 $newcofc->setapproval($approval);	 
    
    $newgrn->setraw_mat_type($raw_mat_type);
    $newgrn->setraw_mat_spec($raw_mat_spec);
    $newgrn->setraw_mat_code($raw_mat_code);
    $newgrn->setinvoice_num($invoice_num);
    $newgrn->setinvoice_date($invoice_date);
    $newgrn->setrecieved_date($recieved_date);
    $newgrn->settest_report($test_report);
    $newgrn->setbatch_num($batch_num);
    $newgrn->setmgp_num($mgp_num);
    $newgrn->setlink2vendor($vendrecnum);
    $newgrn->setgrnnum($grnnum);
    $newgrn->setcoc_refnum($coc_refnum);
    $newgrn->setrmbycim($rmbycim);
    $newgrn->setrmbycust($rmbycust);
    $newgrn->setcimponum($cimponum);
    $newgrn->setremarks($remarks);
    $newgrn->setnc_refnum($nc_refnum);
    $newgrn->setgrntype($grntype);
    $newgrn->setcrn($crn);
    $newgrn->setshipping_date($shipping_date);
    $newgrn->setconversion_date($conversion_date);
    $newgrn->setquarremarks($quarremarks);
	$newgrn->setgrndateQuar($grnDateQuar);
	$newgrn->setrm_empcode($rm_empcode);
    $newgrn->setrm_date($rm_date);
    $newgrn->setgrn_empcode($grn_empcode);
    $newgrn->setgrn_date($grn_date);
    $newgrn->setrm_cost($rm_cost);
	$newgrn->setrm_currency($rm_currency);
	$newgrn->setapproved($approved);
    $newgrn->setrmpoline_num($rmpoline_num);
    $newgrn->setaltcrn($altcrn);
    $newgrn->setparentgrnnum($parentgrnnum);
    $newgrn->setpocrn($pocrn);
    $newgrn->setstdrev($stdrev);
	$newgrn->setqtm_req($qtm_req);
	$newgrn->setwo_ref($wo_ref);
	$newgrn->setwotype($wotype);
    
    $max=$_REQUEST['index'];
    $max1=$_REQUEST['grniss_index'];
    $flag = 0;
    $i = 0;
    $c="a";$flag_qty=0;   $prflag=0;   $finalpoqty=0;  $stflag=0;
    //$newrmpoqty=0;
//	echo"$max max number------------------$i <br>";
    while ($i < $max)
    {
        // echo $c;
        // echo "inside while";
        $line_num="line_num" . $i;
	    $partnum="partnum" . $i;
	    $partdesc="partdesc" . $i;
	    $batchnum="batchnum" . $i;
	    $uom="uom" . $i;
	    $expdate="expdate" . $i;
	    $qty="qty" . $i;
        $dim1="dim1" . $i;
        $dim2="dim2" . $i;
        $dim3="dim3" . $i;
        $qty_rej="qty_rej" . $i;
	    $qty_to_make="qty_to_make" . $i;
        $qty4billet="qty4billet" . $i;
        $amend_line_num="amend_line_num" . $i;
	    $layout_ref="layout_ref" . $i;
	    $amendstatus="amendstatus" . $i;
	    $noofpieces="noofpieces" . $i;
        $qty_parent="qty_parent". $i;
        $billetsreq="billetsreq". $i;
	    $qty4billet_parent= "qty4billet_parent".$i;

	if (isset($_REQUEST[$line_num]))
    {
          $linenum1= $_REQUEST[$line_num];
	      $partnum1= $_REQUEST[$partnum];
	      $partdesc1= $_REQUEST[$partdesc];
	      $batchnum1= $_REQUEST[$batchnum];
          $uom1= $_REQUEST[$uom];
          $expdate1= $_REQUEST[$expdate];
	      $qty1 = $_REQUEST[$qty];
          $dim11 = $_REQUEST[$dim1];
          $dim21 = $_REQUEST[$dim2];
          $dim31 = $_REQUEST[$dim3];
          $qty_rej1 = $_REQUEST[$qty_rej];
          $qty_to_make1 = $_REQUEST[$qty_to_make];
         // echo $qty_to_make1;
          $qty4billet1 = $_REQUEST[$qty4billet];
          $amend_line_num1 = $_REQUEST[$amend_line_num];
          $layout_ref1 = $_REQUEST[$layout_ref];
          $amendstatus1 = $_REQUEST[$amendstatus];
          $noofpieces1 = $_REQUEST[$noofpieces];
		  $qty_parent1 = $_REQUEST[$qty_parent];
		  $qty4billet_parent1 = $_REQUEST[$qty4billet_parent];
		  $billetsreq1 = $_REQUEST[$billetsreq];
        // echo "\nI am linenumber1  :  " . $rmpoline_num1;
	   if ($linenum1 != '')
	   {
             // echo"$flag is the test";
             if ($flag == 0)
             {
              $j=1;
              while($j<$max)
				{
					$linetot="line_num" . $j;
					$qtytot="qty" . $j;
					$amendstat="amendstatus".$j ;
					$amendlinetot="amend_line_num" . $j;
                    $qty_to_maketot="qty_to_make" . $j;
                    $len="dim1" . $j;
                    $wid="dim2" . $j;
                    $thick="dim3" . $j;
     				$linenumber2= $_REQUEST[$linetot];
                    $qty2 = $_REQUEST[$qtytot];
                   // echo $qty2."---<br>";
                    $amenstat2=$_REQUEST[$amendstat];
                    $amend_line_num2=$_REQUEST[$amendlinetot];
                    $qty_to_maketot2=$_REQUEST[$qty_to_maketot];
                    $length=$_REQUEST[$len];
                    $width= $_REQUEST[$wid];
                    $thickness=$_REQUEST[$thick];
						//echo "<br>this is line2   :$qty2--------$amendstatus1";
					if ($linenumber2 != '')
					{

                    	//echo$amendstatus1."-----------------";
                     if($amend_line_num2 =='')
                     {  
                     //echo"HERE====";
                      

                       $qty_total += $qty2;
                       $qtytomake += $qty_to_maketot2;
                       if($width!='' && $width !='-' && $width!='NA' && $width!='0')
                       {
                         $dimesion = " (".$length."X".$width."X".$thickness.")".$dimesion;
                       }else
                       {
                         $dimesion = " (".$length."X".$thickness.")".$dimesion;
                       }

                     }
                    // echo $raw_mat_spec."------P--".$grntype;
                     $final_descr= $raw_mat_spec." ".$dimesion." ".$grntype;
                       //echo"$qty_total tot qty";
                    //$vfob_total += $rate2;
                    //echo$qty_total.'*************';
						//$totaldue=$total;
					}
					$j++;
				}
			 $sql = "start transaction";
             $result = mysql_query($sql);
		     $recnum = $newgrn->addgrn($validatFlag,$qtytomake);
		     $resrmmaster=$newgrn->getallrmdetails($crn);
             $myrmres=mysql_fetch_row($resrmmaster);
             if(($myrmres[0] !='' && $myrmres[0] !='-'&& $myrmres[0] !='NA' && $myrmres[0] !='Not Applicable' )&& ($myrmres[1] !='' && $myrmres[1] !='-' && $myrmres[1] !='NA'&& $myrmres[1] !='Not Applicable'))
              {
                  $uom_rm='Meters';//echo"HERE---";
              }
              else if(($myrmres[0] !='' && $myrmres[0] !='-'&& $myrmres[0] !='NA' && $myrmres[0] !='Not Applicable'))
              {
                 $uom_rm='Meters'; //echo"HERE--1111-";
              }
              else if(($myrmres[1] !='' && $myrmres[1] !='-' && $myrmres[1] !='NA'&& $myrmres[1] !='Not Applicable') && ($myrmres[2] !='' && $myrmres[2] !='-' && $myrmres[2] !='NA'&& $myrmres[2] !='Not Applicable') && ($myrmres[3] !='' && $myrmres[3] !='-' && $myrmres[3] !='NA'&& $myrmres[3] !='Not Applicable'))
              {
                 $uom_rm='NOS'; //echo"HERE--52222-";
              }
          /* if($parentgrnnum != '' && $noofpieces1 !=''&& $noofpieces1 !=0)
           {
              $prflag=0;
           }else
           {
             $prflag=1;

           } */
           // echo $uom_rm."-----p----f---";
            $newgrn->updateconsumptionreg($qtytomake,$vendor,$qty_total,$final_descr,$uom_rm,$prflag);
		    //}
		     $resgrnnum=$newgrn->getgrn($recnum);
		     $mygrn=mysql_fetch_assoc($resgrnnum);

             if($validatFlag=="1")
		     {
		      //  $newemail->sendgrnpoEmail($cimponum,$mygrn['grnnum']) ;
		     }
		// echo $c;
  	        $newcofc->addcofc($recnum);
  	        
                $flag =1;
             }

 	         $newgrn->setlinenum1($linenum1);
             $newgrn->setpartnum1($partnum1);
	         $newgrn->setpartdesc($partdesc1);
	         $newgrn->setlibatchnum($batchnum1);
	         $newgrn->setuom($uom1);
	         $newgrn->setexpdate($expdate1);
             $newgrn->setqty1($qty1);
             $newgrn->setdim11($dim11);
             $newgrn->setdim21($dim21);
             $newgrn->setdim31($dim31);
             $newgrn->setqty_rej($qty_rej1);
             $newgrn->setqty_to_make($qty_to_make1);
             $newgrn->setqty4billet($qty4billet1);
             $newgrn->setamend_line_num($amend_line_num1);
             $newgrn->setlayout_ref($layout_ref1);
             $newgrn->setamendstatus($amendstatus1);
             $newgrn->setnoofpieces($noofpieces1);
             $newgrn->setbilletsreq($billetsreq1);
			 //echo "<br> parent qty/billet in process is $qty4billet_parent1";
			 $newgrn->setqty4billetparent($qty4billet_parent1);
             if($cimponum != '')
             {
               $result_po=$newgrn->getpo_details($cimponum);
               if($result_po == '')
               {
                   //echo "<table border=1><tr><td><font color=#FF0000>";
                   $rm_mismatch="PO Number Does Not Exist" ;
                   //echo "</td></tr></table>";
               }
               else
               {
                 $result_crn_line=$newgrn->getcrn_line_num($vcrn,$cimponum,$rmpoline_num);
                 if(mysql_num_rows($result_crn_line) > 0)
                 {
                $result_rmpo=$newgrn->getrmpoDetails($vcrn,$cimponum,$rmpoline_num);
                $result4qty=$newgrn->getrmpoDetails($vcrn,$cimponum,$rmpoline_num);
                $mypoqty=mysql_fetch_assoc($result4qty);
               while($myrmpo=mysql_fetch_assoc($result_rmpo))
               {
                 if($myrmpo["no_of_meterages"] != '0.00' && $myrmpo["no_of_meterages"] != '0' && $myrmpo["no_of_meterages"] != '' )
                 {
                      $rmpo_qty= $myrmpo["no_of_meterages"];
                      //echo $rmpo_qty."11111";
                 }else
                 {
                     $rmpo_qty= $myrmpo["no_of_lengths"];
                     //echo $rmpo_qty."22222";
                 }
                 $count1 =10/100;
                 $count2 = $count1 * $qty1;
                 //echo $count2;
                 $count = round($count2, 0);

                 $final_rmpoqty= $count+$rmpo_qty;
                 if((trim(strtoupper($myrmpo['link2vendor'])) != trim(strtoupper($vendrecnum))))
                 {
                   $rm_mismatch="Suppliers Are Different" ;
                 }
                  else if((trim(strtoupper($myrmpo['material_ref'])) != trim(strtoupper($raw_mat_type))))
                 {
                   $rm_mismatch="Material  Types  Dont Match" ;
                 }
                  else if((trim(strtoupper($myrmpo['material_spec'])) != trim(strtoupper($raw_mat_spec))))
                 {
                   $rm_mismatch="Material Specifications Don't match" ;
                 }
                  else if((trim(strtoupper($myrmpo['rate'])) != trim(strtoupper($rm_cost))))
                 {
                   $rm_mismatch="RMPO COSTS are different" ;
                 }

                  else if((trim(strtoupper($myrmpo['currency'])) != trim(strtoupper($rm_currency))))
                 {
                   $rm_mismatch="Currency Is Different" ;
                 }
                 else if((trim(strtoupper($myrmpo['length'])) != trim(strtoupper($dim21))))
                 {
                   $rm_mismatch="The Entered Width does not match with RMPO Width" ;
                 }
                 else if((trim(strtoupper($myrmpo['width'])) != trim(strtoupper($dim11))))
                 {
                   $rm_mismatch="The Entered Length does not match with RMPO Length" ;
                 }
                 else if((trim(strtoupper($myrmpo['thick'])) != trim(strtoupper($dim31))))
                 {
                   $rm_mismatch="The Entered Thickness does not match with RMPO thickness" ;
                 }

                  else if((trim(strtoupper($myrmpo['uom'])) != trim(strtoupper($uom1))))
                 {
                   $rm_mismatch="UOM Does not match" ;
                 }
                  else if($qty1 > $final_rmpoqty )
                 {
                   $rm_mismatch="Entered QTY is 10% more than the RMPO QTY" ;
                 }

               }
                 $finalQty=$count+ $qty_total;
                // echo$qty_total.'*********'.$final_rmpoqty."++++++++++".$validatFlag."---**---".$finalQty."<br>";

                if(($qty_total <= $final_rmpoqty) && ($validatFlag != "1"))
                {
                           $m=0;

                    if( $flag_qty==0)
		 {
		      	while($m<$max)
				{
                    $linetot="line_num" . $m;
					$qtytot="qty" . $m;
					$amendstat="amendstatus".$m ;
					$amendlinetot="amend_line_num" . $m;
                    $no_of_pieces="noofpieces" . $m;
     				$linenumber2= $_REQUEST[$linetot];
                    $qty2 = $_REQUEST[$qtytot];
                    $amenstat2=$_REQUEST[$amendstat];
                    $amend_line_num2=$_REQUEST[$amendlinetot];
                    $no_of_pieces2=$_REQUEST[$no_of_pieces];
						//echo "<br>this is line2   :$qty2--------$amendstatus1";
    	            if ($linenumber2 != '')
					{
                       if($no_of_pieces2!="" && $no_of_pieces2!=0)
                       {
                         $qty_total4po += $qty2;
                       }else
                       {
                         if($amend_line_num2 =='')
                         {
                           $qty_total4po += $qty2;
                          }
                       }
					}
                   $newrmpoqty=$mypoqty['qty_recd']+$qty_total4po;
                   $finalpoqty=$qty_total4po;
 				   $m++;
				}
                 $tot_grn_qty=$newgrn->getpogrndetails($cimponum,$vcrn,$grnnum);
                //echo $grn_qty;
                  $final_grn_qty= $tot_grn_qty+$qty_total4po;
             // echo $final_grn_qty."------".$final_rmpoqty;
				if(($final_grn_qty == $final_rmpoqty) || ($rmpo_qty==$final_grn_qty))
				{
				   $stflag=1;
				}
                 if($parentgrnnum=="")
				{    //echo"HERE---111";
                  if(($mypoqty['accepted_date']=='0000-00-00' || $mypoqty['accepted_date']==''))
                   {  //echo"in if-111-";
                   	 $newgrn->updatePOli($cimponum,$pocrn,$rmpoline_num,$finalpoqty,$recieved_date,$grnnum,$mypoqty['recnum'],$stflag);

                   }else if(($mypoqty['accepted_date']!='0000-00-00'))
                   { //echo"here---e--dd---e<br>";
                     $resultgrnqty=$newgrn->getrmpoDetails4grn($pocrn,$cimponum,$grnnum);
                     $mygrnqtypo=mysql_fetch_assoc($resultgrnqty);
                     if(($mygrnqtypo['grn_num']!=$grnnum))
                   {    //echo"in if-new-<br>";
                 	 $newgrn->update_newPOli($cimponum,$pocrn,$rmpoline_num,$finalpoqty,$recieved_date,$grnnum,$mypoqty['recnum'],$stflag);

                   }else
                   {  //echo"in if-needitw-<br>";
                 	 $newgrn->updatePOli($cimponum,$pocrn,$mygrnqtypo['line_num'],$finalpoqty,$recieved_date,$grnnum,$mypoqty['recnum'],$stflag);
                   }
                  }
               }
				$flag_qty =1;
		 }
                 //echo $newrmpoqty."----------------------------";
                }
                }
                else
                {
                  $rm_mismatch="The Crn : $crn with Line Number: $rmpoline_num Does Not Exist For Ponum: $cimponum" ;
                 }


              }
                 $newgrn->addgrnli($recnum,$rm_mismatch);
              if($pagename =='newcopy_grn' || $pagename =='grn_swap')
			  {			
				  $recnum_li="recnum_li" . $i;
				  $recnum_linum=$_REQUEST[$recnum_li];   			
                  $newgrn->updateparentgrnli($grnrecnum,$max,$recnum_linum,$parentgrnnum,$qty_parent,$remainqty);
			  }
             $sql = "commit";
			 $result = mysql_query($sql);
			 if(!$result)
			{
				 $sql = "rollback";
				 $result = mysql_query($sql);
				 die("Commit failed GRN Insert..Please report to Sysadmin. " . mysql_errno());
			 }
             }
             else
             {

               $newgrn->addgrnli($recnum,$rm_mismatch);
			    if($pagename =='newcopy_grn' || $pagename =='grn_swap')
			   {
                   $recnum_li="recnum_li" . $i;
				  $recnum_linum=$_REQUEST[$recnum_li];  
                  $newgrn->updateparentgrnli($grnrecnum,$max,$recnum_linum,$parentgrnnum,$qty_parent,$remainqty);
			  }
               $sql = "commit";
			 $result = mysql_query($sql);
			 if(!$result)
			{
				 $sql = "rollback";
				 $result = mysql_query($sql);
				 die("Commit failed GRN Insert..Please report to Sysadmin. " . mysql_errno());
			 }
             }
	          $c="b";
        }
      }
         $i++;
		
    }
	/*if($pagename == 'grn_swap' || $pagename == 'newcopy_grn')
	{
		 $qtm_bal=$_REQUEST['qtm_bal'];		
		 $newgrn->setqtm_bal($qtm_bal);	     
         $newgrn->updateparent_grn($parentgrnnum,$recnum);
	}*/
}

// Request all fields for Update
if ($pagename == 'edit_grn')
{
//   echo "<pre>";
// print_r($_REQUEST);exit;
// echo "i am inside editinvoice";
    $grnrecnum = $_REQUEST["grnrecnum"];
    $raw_mat_type = $_REQUEST["raw_mat_type"];
    $raw_mat_spec = $_REQUEST["raw_mat_spec"];
    $raw_mat_code = $_REQUEST["raw_mat_code"];
    $invoice_num = $_REQUEST["invoice_num"];
    $invoice_date = $_REQUEST["invoice_date"];
    $recieved_date = $_REQUEST["recieved_date"];
    $test_report = $_REQUEST["test_report"];
    $batch_num = $_REQUEST["batch_num"];
    $mgp_num = $_REQUEST["mgp_num"];
    $grnnum = $_REQUEST["grnnum"];
    $coc_refnum = $_REQUEST["coc_refnum"];
    $rmbycim = $_REQUEST["rmbycim"];
    $rmbycust = $_REQUEST["rmbycust"];
    $cimponum = $_REQUEST["cimponum"];
    $remarks = $_REQUEST["remarks"];
    $nc_refnum = $_REQUEST["nc_refnum"];
    $grntype = $_REQUEST["grntype"];
	$grnDateQuar = $_REQUEST["Quarantined_date"];
    $crn = $_REQUEST["crn"];
    //$status = $_REQUEST["status"];
    $vendrecnum = $_REQUEST['vendrecnum'];
    $dimension=$_REQUEST["dimensional"];
    $ndt=$_REQUEST["ndt"];
    $visual=$_REQUEST["visual"];
    $grain=$_REQUEST["grain"];
    $mech=$_REQUEST["mechanical"];
    $conductivity=$_REQUEST["conductivity"];
    $chemical=$_REQUEST["chemical"];
    $hardness=$_REQUEST["hardness"];
    $quantity=$_REQUEST["quantity"];
    $temper=$_REQUEST["temper"];
    $cus=$_REQUEST["cus"];
    $cim=$_REQUEST["cim"];
    $not=$_REQUEST["not"];
    $from=$_REQUEST["frmserial"];
    $to=$_REQUEST["toserial"];
    $con=$_POST["conformance"];
    $ncref=$_POST["ncref"];
    $ncrdate=$_POST["ncrdate"];
    $comm=$_POST["comm"];
    $dcomm=$_POST["dcomm"];
    $anotes=$_POST["anotes"];
    $approval=$_POST["approval"];
    $shipping_date=$_POST["shipping_date"];
    //$conversion_date=$_POST["shipping_date"];
	$quarremarks=$_POST["quarremarks"];
	$conversion_date=$_REQUEST["conversion_date"];

	$wo_ref=$_REQUEST["wo_ref"];
	
	 $rm_empcode=$_POST["rmempcode"];
	 $rm_date=$_REQUEST["rmcheckdate"];
	 $grn_empcode=$_POST["grnempcode"];
	 $grn_date=$_REQUEST["grncheckdate"];
	 $rm_cost=$_POST["rm_cost"];
	 $rm_currency=$_REQUEST["currency"];
	 $approved_grn=$_REQUEST["approved_grn"];
	 $rmpoline_num=$_REQUEST["rmpoline_num"];
	 $altcrn=$_REQUEST["altcrn"];
	 $parentgrnnum=$_REQUEST["parentgrnnum"];
	 $prev_grn_qty=$_REQUEST["qty_tot"];
	 $validatFlag=$_REQUEST["validate_flag"];
	 $prev_stat=$_REQUEST["status"];
	 $pocrn=$_REQUEST["pocrn"];
	 $grnnotes= $_REQUEST["notes"];
	 $approval_remarks = $_REQUEST["approval_remarks"];
     $approval_date = $_REQUEST["approval_date"];
     $userid_app=$_REQUEST['userid_app'];
     $vendor=$_REQUEST["vendor"];
     $stdrev=$_REQUEST["stdrev"];

	 $cad_approval_date=$_REQUEST["cad_approval_date"];
	 $userid_app_cad=$_REQUEST["userid_app_cad"];
	 $cad_approved_grn=$_REQUEST["cad_approved_grn"];

	 $wotype=$_REQUEST['wotype'];
 
     
	 if($approved_grn=="yes" && $prev_stat=="Pending" &&  $cad_approved_grn=="yes")
         {
           $status = "Open";
         }else if($approved_grn==" " || $validatFlag =="1" || $cad_approved_grn==" " )
         {
           $status = "Pending";
         }
        else {
           $status = $prev_stat;
		}
		
		if($_REQUEST["altcrn"] != '')
     {
      $altcrn=$_REQUEST["altcrn"];
     }else
     {
       $altcrn="";
     }
     if($_REQUEST["pocrn"] != '')
     {
      $pocrn=$_REQUEST["pocrn"];
     }else
     {
       $pocrn="";
     }
     if($altcrn!="")
     {
       $vcrn=$altcrn;
     }else
     {
       $vcrn=$pocrn;
     }
    // echo $status."pro---";

     $newlogin = new userlogin;
    $newlogin->dbconnect();
    $sql = "start transaction";
    $result = mysql_query($sql);
    
	$newcofc->setcon($con);
	$newcofc->setncref($ncref);
	$newcofc->setncrdate($ncrdate);
	$newcofc->setcomm($comm);
	$newcofc->setdcomm($dcomm);
	$newcofc->setanotes($anotes);
	$newcofc->setdimension($dimension);
	$newcofc->setdimension($dimension);
	$newcofc->setndt($ndt);
	$newcofc->setvisual($visual);
	$newcofc->setgrain($grain);
	$newcofc->setmech($mech);
	$newcofc->setcon1($conductivity);
	$newcofc->setchemical($chemical);
	$newcofc->sethardness($hardness);
	$newcofc->setquantity($quantity);
	$newcofc->settemper($temper);
	$newcofc->setcus($cus);
	$newcofc->setcim($cim);
	$newcofc->setnot($not);
	$newcofc->setfrom($from);
	$newcofc->setto($to);
	$newcofc->setapproval($approval);

	

    $newgrn->setraw_mat_type($raw_mat_type);
    $newgrn->setraw_mat_spec($raw_mat_spec);
    $newgrn->setraw_mat_code($raw_mat_code);
    $newgrn->setinvoice_num($invoice_num);
    $newgrn->setinvoice_date($invoice_date);
    $newgrn->setrecieved_date($recieved_date);
    $newgrn->settest_report($test_report);
    $newgrn->setbatch_num($batch_num);
    $newgrn->setmgp_num($mgp_num);
    $newgrn->setlink2vendor($vendrecnum);
    $newgrn->setgrnnum($grnnum);
    $newgrn->setcoc_refnum($coc_refnum);
    $newgrn->setrmbycim($rmbycim);
    $newgrn->setrmbycust($rmbycust);
    $newgrn->setcimponum($cimponum);
    $newgrn->setremarks($remarks);
    $newgrn->setnc_refnum($nc_refnum);
    $newgrn->setgrntype($grntype);
	$newgrn->setgrndateQuar($grnDateQuar);
    $newgrn->setcrn($crn);
    $newgrn->setstatus($status);
	//echo '++++'.$status.'+++';
    $newgrn->setshipping_date($shipping_date);
    $newgrn->setconversion_date($conversion_date);
    $newgrn->setquarremarks($quarremarks);
   	$newgrn->setrm_empcode($rm_empcode);
    $newgrn->setrm_date($rm_date);
    $newgrn->setgrn_empcode($grn_empcode);
    $newgrn->setgrn_date($grn_date);
    $newgrn->setrm_cost($rm_cost);
	$newgrn->setrm_currency($rm_currency);
	$newgrn->setapproved($approved_grn);
	$newgrn->setrmpoline_num($rmpoline_num);
    $newgrn->setaltcrn($altcrn);
    $newgrn->setparentgrnnum($parentgrnnum);
    $newgrn->setpocrn($pocrn);
    $newgrn->setapproval_remarks($approval_remarks);
    $newgrn->setapproval_date($approval_date);
    $newgrn->setuserid_app($userid_app);
    $newgrn->setstdrev($stdrev);
	$newgrn->setwo_ref($wo_ref);

	$newgrn->setwotype($wotype);    

	$newgrn->setcad_approval_date($cad_approval_date);
	$newgrn->setcad_approved_by($userid_app_cad);
	$newgrn->setcad_approved($cad_approved_grn);

    $newgrn->updateconsumptionreg($qty_to_maketot2,$vendor,$qty_total,$dimesion,$uom_rm,$prflag);
    $newgrn->addgrnnotes($grnrecnum,$grnnotes);
   $i=1;
  $index=$_REQUEST['index'];
   $flag=0;$flag_qty=0;   $stflag=0;
   //$newrmpoqty=0;
   $j=1;
 
   //echo "Max is $index"."************".$j;
    while($j<$index)
    {
        $line_num="line_num" . $j;
	    $partnum="partnum" . $j;
	    $partdesc="partdesc" . $j;
	    $batchnum="batchnum" . $j;
	    $uom="uom" . $j;
	    $expdate="expdate" . $j;
	    $qty1="qty" . $j;
	    $dim1="dim1" . $j;
	    $dim2="dim2" . $j;
	    $dim3="dim3" . $j;
        $qty_rej="qty_rej" . $j;
        $qty_to_make="qty_to_make" . $j;
        $qty4billet="qty4billet" . $j;
        $prevlinenum="prevlinenum" . $j;
	    $lirecnum="lirecnum" . $j;
	    $amend_line_num="amend_line_num" . $j;
	    $layout_ref="layout_ref" . $j;
	    $amendstatus="amendstatus" . $j;
	    $noofpieces="noofpieces" . $j;

        $lirecnum1=$_REQUEST[$lirecnum];
	    $partnum1= $_REQUEST[$partnum];
	    $prevlinenum1=$_REQUEST[$prevlinenum];
	    $linenum1= $_REQUEST[$line_num];
	    $partdesc1= $_REQUEST[$partdesc];
	    $batchnum1= $_REQUEST[$batchnum];
	    $uom1= $_REQUEST[$uom];
	    $expdate1= $_REQUEST[$expdate];
	    $qty1 = $_REQUEST[$qty1];
        $dim11 = $_REQUEST[$dim1];
        $dim21 = $_REQUEST[$dim2];
        $dim31 = $_REQUEST[$dim3];
        $qty4billet1 = $_REQUEST[$qty4billet];
        $qty_rej1 = $_REQUEST[$qty_rej];
        $qty_to_make1 = $_REQUEST[$qty_to_make];
        $amend_line_num1 = $_REQUEST[$amend_line_num];
        $layout_ref1 = $_REQUEST[$layout_ref];
        $amendstatus1 = $_REQUEST[$amendstatus];
        $rm_mismatch="";
        $noofpieces1= $_REQUEST[$noofpieces];
        $prev_appstat=$_REQUEST['prev_approved_grn'];
       // echo $qty1."*----------11---<br>";
        if ($linenum1 != '')
        {

        if( $flag==0)
		 {
		      	while($n<$index)
				{
                    $linetot="line_num" . $n;
					$qtytot="qty" . $n;
					$amendstat="amendstatus".$n ;
					$amendlinetot="amend_line_num" . $n;
					$qty_to_maketot="qty_to_make" . $n;
					$len="dim1" . $n;
                    $wid="dim2" . $n;
                    $thick="dim3" . $n;
     				$linenumber2= $_REQUEST[$linetot];
                    $qty2 = $_REQUEST[$qtytot];
                   // echo $qty2."---<br>";
                    $amenstat2=$_REQUEST[$amendstat];
                    $amend_line_num2=$_REQUEST[$amendlinetot];
                    $qty_to_maketot2=$_REQUEST[$qty_to_maketot];
                    $length=$_REQUEST[$len];
                    $width= $_REQUEST[$wid];
                    $thickness=$_REQUEST[$thick];
						//echo "<br>this is line2   :$qty2--------$amendstatus1";
					if ($linenumber2 != '')
					{
                    	//echo$amendstatus1."-----------------";
                     if($amend_line_num2 =='')
                     {  //echo"HERE====";

                       $qty_total += $qty2;
                       $qtytomake += $qty_to_maketot2;
                       
                       if($width!='' && $width !='-' && $width!='NA' && $width!='0')
                       {
                         $dimesion = " (".$length." x ".$width." x ".$thickness.")".$dimesion;
                       }else
                       {
                         $dimesion = " (".$length." x ".$thickness.")".$dimesion;
                       }
                     }
                     // echo $raw_mat_spec."------P--".$grntype;
                     $final_descr= $raw_mat_spec." ".$dimesion." ".$grntype;
                    //$vfob_total += $rate2;
                    //echo$qty_total.'*************';
						//$totaldue=$total;
					}
					$n++;
				}
				//echo $qty_total."**--**-";
				//echo"$final_descr tot dimension";
             $resrmmaster=$newgrn->getallrmdetails($crn);
             $myrmres=mysql_fetch_row($resrmmaster);
             if(($myrmres[0] !='' && $myrmres[0] !='-'&& $myrmres[0] !='NA' && $myrmres[0] !='Not Applicable' )&& ($myrmres[1] !='' && $myrmres[1] !='-' && $myrmres[1] !='NA'&& $myrmres[1] !='Not Applicable'))
              {
                  $uom_rm='Meters';//echo"HERE---";
              }
              else if(($myrmres[0] !='' && $myrmres[0] !='-'&& $myrmres[0] !='NA' && $myrmres[0] !='Not Applicable'))
              {
                 $uom_rm='Meters'; //echo"HERE--1111-";
              }
              else if(($myrmres[1] !='' && $myrmres[1] !='-' && $myrmres[1] !='NA'&& $myrmres[1] !='Not Applicable') && ($myrmres[2] !='' && $myrmres[2] !='-' && $myrmres[2] !='NA'&& $myrmres[2] !='Not Applicable') && ($myrmres[3] !='' && $myrmres[3] !='-' && $myrmres[3] !='NA'&& $myrmres[3] !='Not Applicable'))
              {
                 $uom_rm='NOS'; //echo"HERE--52222-";
              }
           /* if($parentgrnnum != '' && $noofpieces1 !='' && $noofpieces1 !=0)
           {
              $prflag=0;
           }else
           {
             $prflag=1;

           } */
          //echo $uom_rm."-----p----f---";
            $newgrn->updateconsumptionreg($qtytomake,$vendor,$qty_total,$final_descr,$uom_rm,$prflag);
            $newgrn->updategrn($grnnum,$validatFlag,$qtytomake);
				$flag =1;
		 }
 	    $newgrn->setlinenum1($linenum1);
	    $newgrn->setpartnum1($partnum1);
	    $newgrn->setpartdesc($partdesc1);
	    $newgrn->setlibatchnum($batchnum1);
	    $newgrn->setuom($uom1);
	    $newgrn->setexpdate($expdate1);
	    $newgrn->setqty1($qty1);
	    $newgrn->setdim11($dim11);
	    $newgrn->setdim21($dim21);
	    $newgrn->setdim31($dim31);
	    $newgrn->setqty4billet($qty4billet1);
	    $newgrn->setqty_rej($qty_rej1);
	    $newgrn->setqty_to_make($qty_to_make1);
	    $newgrn->setamend_line_num($amend_line_num1);
        $newgrn->setlayout_ref($layout_ref1);
        $newgrn->setamendstatus($amendstatus1);
        $newgrn->setnoofpieces($noofpieces1);
		// echo "prevlinenum1  :  " . $prevlinenum1;
		 $n=1;
            if($prevlinenum1!='')
            {
//                 echo "prevlinenum++++++++++++++ :  " . $cimponum;
            if($cimponum != '')
             {  //echo "prevlinenum2222222222222222 :  " . $prevlinenum1;
               $result_po=$newgrn->getpo_details($cimponum);
               if($result_po == '')
               {
                   //echo "<table border=1><tr><td><font color=#FF0000>";
                   $rm_mismatch="PO Number Does Not Exist" ;
                   //echo "</td></tr></table>";
               }
               else
               {   //echo "prevlinenum3333333333333333 :   $crn-------------$cimponum--------------$rmpoline_num";
                 $result_crn_line=$newgrn->getcrn_line_num($vcrn,$cimponum,$rmpoline_num);
                 if(mysql_num_rows($result_crn_line) > 0)
                 {
                 //echo "prevlinenum44444444444 :  " . $prevlinenum1;
                $result_rmpo=$newgrn->getrmpoDetails($vcrn,$cimponum,$rmpoline_num);
                $result4qty=$newgrn->getrmpoDetails($vcrn,$cimponum,$rmpoline_num);

                $mypoqty=mysql_fetch_assoc($result4qty);
               while($myrmpo=mysql_fetch_assoc($result_rmpo))
               {
                 if($myrmpo["no_of_meterages"] != '0.00' && $myrmpo["no_of_meterages"] != '0' && $myrmpo["no_of_meterages"] != '' )
                 {
                      $rmpo_qty= $myrmpo["no_of_meterages"];
                      //echo $rmpo_qty."11111";
                 }else
                 {
                     $rmpo_qty= $myrmpo["no_of_lengths"];

                 }
                 $count1 =10/100;
                 $count2 = $count1 * $qty1;
                 $count = round($count2, 0);
                 $final_rmpoqty= $count2+$rmpo_qty;
                 if((trim(strtoupper($myrmpo['link2vendor'])) != trim(strtoupper($vendrecnum))))
                 {
                   $rm_mismatch="Suppliers Are Different" ;
                 }
                  else if((trim(strtoupper((preg_replace("/[$&*\"\'\/\ ,+]/","", $myrmpo['material_ref'])))) != trim(strtoupper((preg_replace("/[$&*\"\'\/\ ,+]/","", $raw_mat_type))))))
                 {
                   $rm_mismatch="Material  Types  Dont Match" ;
                }
                  else if((trim(strtoupper((preg_replace("/[$&*\"\'\/\ ,+]/","", $myrmpo['material_spec'])))) != trim(strtoupper((preg_replace("/[$&*\"\'\/\ ,+]/","", $raw_mat_spec))))))
                 {
                   $rm_mismatch="Material Specifications Dont match" ;
                 }
                  else if((trim(strtoupper((preg_replace("/[$&*\"\'\/\ ,+]/","", $myrmpo['rate'])))) != trim(strtoupper((preg_replace("/[$&*\"\'\/\ ,+]/","", $rm_cost))))))
                 {
                   $rm_mismatch="RMPO COSTS are different" ;
                 }

                 else if((trim(strtoupper((preg_replace("/[$&*\"\'\/\ ,+]/","", $myrmpo['length'])))) != trim(strtoupper((preg_replace("/[$&*\"\'\/\ ,+]/","", $dim21))))))
                 {
                   $rm_mismatch="The Entered Width does not match with RMPO Width" ;
                 }
                 else if((trim(strtoupper((preg_replace("/[$&*\"\'\/\ ,+]/","", $myrmpo['width'])))) != trim(strtoupper((preg_replace("/[$&*\"\'\/\ ,+]/","", $dim11))))))
                 {
                   $rm_mismatch="The Entered Length does not match with RMPO Length" ;
                 }
                 else if((trim(strtoupper((preg_replace("/[$&*\"\'\/\ ,+]/","", $myrmpo['thick'])))) != trim(strtoupper((preg_replace("/[$&*\"\'\/\ ,+]/","", $dim31))))))
                 {
                   $rm_mismatch="The Entered Thickness does not match with RMPO thickness" ;
                 }

                  else if((trim(strtoupper((preg_replace("/[$&*\"\'\/\ ,+]/","", $myrmpo['uom'])))) != trim(strtoupper((preg_replace("/[$&*\"\'\/\ ,+]/","", $uom1))))))
                 {
                   $rm_mismatch="UOM Does not match";
                 }
                  else if($qty1 > $final_rmpoqty )
                 {
                   $rm_mismatch="Entered QTY is 10% more than the RMPO QTY";
                 }
               }
               
               $tot_grn_qty=$newgrn->getpogrndetails($cimponum,$vcrn,$grnnum);
               // echo $qty_total;
               $final_grn_qty= $tot_grn_qty+$qty_total;
               //echo $approved_grn."----ed---$status----------".$qty_total."----ed-------".$final_rmpoqty."---**----".$prev_grn_qty."**-*".$mypoqty['qty_recd'] ."<br>";
                if(($approved_grn=="yes"||$status=='Open')&& ($qty_total <= $final_rmpoqty))
                {

                  $m=0;

              if( $flag_qty==0)
		      {
		      	while($m<$index)
				{
                    $linetot="line_num" . $m;
					$qtytot="qty" . $m;
					$amendstat="amendstatus".$m ;
					$amendlinetot="amend_line_num" . $m;
                    $no_of_pieces="noofpieces" . $m;
     				$linenumber2= $_REQUEST[$linetot];
                    $qty2 = $_REQUEST[$qtytot];
                    $amenstat2=$_REQUEST[$amendstat];
                    $amend_line_num2=$_REQUEST[$amendlinetot];
                    $no_of_pieces2=$_REQUEST[$no_of_pieces];
     	            if ($linenumber2 != '')
					{
                       if($no_of_pieces2!="" && $no_of_pieces2!=0)
                       {
                         $qty_total4po += $qty2;
                       }else
                       {
                         if($amend_line_num2 =='')
                         {
                           $qty_total4po += $qty2;
                         }
                       }


					}
					if($mypoqty['qty_recd'] !=0.0 && $mypoqty['qty_recd'] !='')
					{
					 $newrmpoqty=$mypoqty['qty_recd']-$prev_grn_qty;
					}else
					{
					  $newrmpoqty=0;
					}
					//echo $parentgrnnum."---------".$qty_total4po."--<br>";
                  //if(($mypoqty['accepted_date']!='0000-00-00' && $mypoqty['accepted_date']!='')&& ($mypoqty['grn_num']!=$grnnum))
                   $finalpoqty=$qty_total4po;
   // echo "<br>".$mypoqty['accepted_date']."------".$mypoqty['grn_num']."***".$mypoqty['qty_recd']."----".$prev_grn_qty."/////".$qty_total4po."****".$grnnum."<br>";
    				$m++;
				}
				//echo $final_grn_qty."------".$final_rmpoqty;
				if(($final_grn_qty == $final_rmpoqty) || ($rmpo_qty==$final_grn_qty))
				{
				   $stflag=1;
				}
				if($parentgrnnum=="")
				{       //echo"HERE---222$stflag";// echo $mypoqty['accepted_date']."------22---".$grnnum."------33---".$mypoqty['grn_num']."--<br>";
                  if(($mypoqty['accepted_date']=='0000-00-00' || $mypoqty['accepted_date']==''))
                   {  //echo"in if-111****";
                   	 $newgrn->updatePOli($cimponum,$pocrn,$rmpoline_num,$finalpoqty,$recieved_date,$grnnum,$mypoqty['recnum'],$stflag);

                   }else if(($mypoqty['accepted_date']!='0000-00-00'))
                   { //echo"here---e--dd---e<br>";
                     $resultgrnqty=$newgrn->getrmpoDetails4grn($pocrn,$cimponum,$grnnum);
                     $mygrnqtypo=mysql_fetch_assoc($resultgrnqty);
                     if(($mygrnqtypo['grn_num']!=$grnnum))
                   {    //echo"in if-new-<br>";
                 	 $newgrn->update_newPOli($cimponum,$pocrn,$rmpoline_num,$finalpoqty,$recieved_date,$grnnum,$mypoqty['recnum'],$stflag);

                   }else
                   {  //echo"in if-needitw-<br>";
                 	 $newgrn->updatePOli($cimponum,$pocrn,$mygrnqtypo['line_num'],$finalpoqty,$recieved_date,$grnnum,$mypoqty['recnum'],$stflag);

                   }


                   }/*else if(($mypoqty['accepted_date']!='0000-00-00' && $mypoqty['accepted_date']!='') &&($mypoqty['grn_num']==$grnnum) )
                   {
                     echo"in if222--";
                   	 $newgrn->updatePOli($cimponum,$crn,$rmpoline_num,$finalpoqty,$mypoqty['accepted_date'],$grnnum);

                   } */
               }
                
                
				$flag_qty =1;
		 }
                }
                }
                else
                {
                   $rm_mismatch="The Crn : $crn with Line Number: $rmpoline_num1 Does Not Exist For Ponum: $cimponum";
                }
              }
              $newgrn->updategrnli($lirecnum1,$rm_mismatch);
             }
             else
             {
                 $newgrn->updategrnli($lirecnum1,$rm_mismatch);
             }

	       }
	    else
	    {
                   // echo "in addgrnli";
             if($cimponum != '')
             {
               $result_po=$newgrn->getpo_details($cimponum);
               if($result_po == '')
               {
                   //echo "<table border=1><tr><td><font color=#FF0000>";
                   $rm_mismatch="PO Number Does Not Exist";
                   //echo "</td></tr></table>";
               }
               else
               {
                 $result_crn_line=$newgrn->getcrn_line_num($vcrn,$cimponum,$rmpoline_num);
                 if(mysql_num_rows($result_crn_line) > 0)
                 {

                $result_rmpo=$newgrn->getrmpoDetails($vcrn,$cimponum,$rmpoline_num);
                $result4qty=$newgrn->getrmpoDetails($vcrn,$cimponum,$rmpoline_num);
                $mypoqty=mysql_fetch_assoc($result4qty);
               while($myrmpo=mysql_fetch_assoc($result_rmpo))
               {
                 if($myrmpo["no_of_meterages"] != '0.00' && $myrmpo["no_of_meterages"] != '0' && $myrmpo["no_of_meterages"] != '' )
                 {
                      $rmpo_qty= $myrmpo["no_of_meterages"];
                      //echo $rmpo_qty."11111";
                 }else
                 {
                     $rmpo_qty= $myrmpo["no_of_lengths"];
                     //echo $rmpo_qty."22222";
                 }
                 $count1 =10/100;
                 $count2 = $count1 * $qty1;
                 //echo $count2;
                 $count = round($count2, 0);

                 $final_rmpoqty= $count+$rmpo_qty;
                 //echo $final_rmpoqty."************".$qty1;
                 //echo ($myrmpo['length']."-----".$dim11);
                 if((trim(strtoupper($myrmpo['link2vendor'])) != trim(strtoupper($vendrecnum))))
                 {
                   $rm_mismatch="Suppliers Are Different" ;

                 }
                  else if((trim(strtoupper($myrmpo['material_ref'])) != trim(strtoupper($raw_mat_type))))
                 {

                   $rm_mismatch="Material  Types  Dont Match" ;

                 }
                  else if((trim(strtoupper($myrmpo['material_spec'])) != trim(strtoupper($raw_mat_spec))))
                 {

                   $rm_mismatch="Material Specifications Dont match" ;

                 }
                  else if((trim(strtoupper($myrmpo['rate'])) != trim(strtoupper($rm_cost))))
                 {

                   $rm_mismatch="RMPO COSTS are different" ;

                 }

                  else if((trim(strtoupper($myrmpo['currency'])) != trim(strtoupper($rm_currency))))
                 {

                   $rm_mismatch="Currency Is Different" ;

                 }
                 else if((trim(strtoupper($myrmpo['length'])) != trim(strtoupper($dim21))))
                 {

                   $rm_mismatch="The Entered Width does not match with RMPO Width" ;

                 }
                 else if((trim(strtoupper($myrmpo['width'])) != trim(strtoupper($dim11))))
                 {

                   $rm_mismatch="The Entered Length does not match with RMPO Length" ;

                 }
                 else if((trim(strtoupper($myrmpo['thick'])) != trim(strtoupper($dim31))))
                 {

                   $rm_mismatch="The Entered Thickness does not match with RMPO thickness" ;

                 }

                  else if((trim(strtoupper($myrmpo['uom'])) != trim(strtoupper($uom1))))
                 {

                   $rm_mismatch="UOM Does not match" ;

                 }
                  else if($qty1 > $final_rmpoqty )
                 {

                   $rm_mismatch="Entered QTY is 10% more than the RMPO QTY" ;

                 }
                 $tot_grn_qty=$newgrn->getpogrndetails($cimponum,$vcrn,$grnnum);
                //echo $grn_qty;
                $final_grn_qty= $tot_grn_qty+$qty1;
                  //echo $approved_grn."-------".$qty_total."-----------".$final_rmpoqty;
                if($approved_grn=="yes" && ($qty_total <= $final_rmpoqty))
                {
                  $m=0;

                    if( $flag_qty==0)
		 {
		      	while($m<$max)
				{
                    $linetot="line_num" . $m;
					$qtytot="qty" . $m;
					$amendstat="amendstatus".$m ;
					$amendlinetot="amend_line_num" . $m;
					$no_of_pieces="noofpieces" . $m;
     				$linenumber2= $_REQUEST[$linetot];
                    $qty2 = $_REQUEST[$qtytot];
                    $amenstat2=$_REQUEST[$amendstat];
                    $amend_line_num2=$_REQUEST[$amendlinetot];
                    $no_of_pieces2=$_REQUEST[$no_of_pieces];
						//echo "<br>this is line2   :$qty2--------$amendstatus1";
					if ($linenumber2 != '')
					{
                       if($no_of_pieces2!="" && $no_of_pieces2!=0)
                       {
                         $qty_total4po += $qty2;
                       }else
                       {
                         if($amend_line_num2 =='')
                         {
                           $qty_total4po += $qty2;
                          }
                      }


					}
                   $newrmpoqty=$mypoqty['qty_recd']+$qty_total4po;
                   //$finalpoqty=$newrmpoqty+$qty_total4po;
    				$m++;
    				$finalpoqty=$qty_total4po;
				}
               // echo $finalpoqty."--**----";
               if(($final_grn_qty == $final_rmpoqty) || ($final_grn_qty == $rmpo_qty))
				{
				   $stflag=1;
				}
                 if($parentgrnnum=="")
				{   // echo"HERE---333";
                  if(($mypoqty['accepted_date']=='0000-00-00' || $mypoqty['accepted_date']==''))
                   {  //echo"in if-111-";
                   	 $newgrn->updatePOli($cimponum,$pocrn,$rmpoline_num,$finalpoqty,$recieved_date,$grnnum,$mypoqty['recnum'],$stflag);

                   }else if(($mypoqty['accepted_date']!='0000-00-00'))
                   { //echo"here---e--dd---e<br>";
                     $resultgrnqty=$newgrn->getrmpoDetails4grn($pocrn,$cimponum,$grnnum);
                     $mygrnqtypo=mysql_fetch_assoc($resultgrnqty);
                     if(($mygrnqtypo['grn_num']!=$grnnum))
                   {   // echo"in if-new-<br>";
                 	 $newgrn->update_newPOli($cimponum,$pocrn,$rmpoline_num,$finalpoqty,$recieved_date,$grnnum,$mypoqty['recnum'],$stflag);

                   }else
                   { // echo"in if-needitw-<br>";
                 	 $newgrn->updatePOli($cimponum,$pocrn,$mygrnqtypo['line_num'],$finalpoqty,$recieved_date,$grnnum,$mypoqty['recnum'],$stflag);

                   }


                   }
               }
				$flag_qty =1;
		 }
                }
               }

                }
                else
                {
                   $rm_mismatch=("The Crn : $crn with Line Number: $rmpoline_num1 Does Not Exist For Ponum: $cimponum" );
                }
              }
               //echo$qty_total.'*************';
              $newgrn->addgrnli($grnrecnum,$rm_mismatch);
             }
             else
             {
              //echo$rm_mismatch.'*************';
                $newgrn->addgrnli($grnrecnum,$rm_mismatch);
             }

		  }
		    $sql = "commit";
	         $result = mysql_query($sql);
	         if(!$result)
	         {
		      $sql = "rollback";
		      $result = mysql_query($sql);
		      die("Commit failed for GRN Li..Please report to Sysadmin. " . mysql_errno());
	          }
	    }
          else
	  {
		 if ($prevlinenum1 != '')
		 {
                     $newgrn->deletegrnli($lirecnum1);
		 }
	  }

          $j++;
       }
        
    $index1 = $_REQUEST['grniss_index'];
    
}
if($pagename =='grn_details')
{
 $grnrecnum=$_REQUEST['grnrecnum'];
 //echo"the recnum-----$grnrecnum";
 //$newgrn->copyparentgrn($grnrecnum);

}

header("Location:grn_summary.php");

?>
