<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = April 27,2010                =
// Filename: processBOM.php                    =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OWT                          =
// Allows processing of BOMs                   =
//==============================================

session_start();
header("Cache-control: private");
//echo 'process';
if ( !isset ( $_SESSION['user'] ) )
{
     header ("Location:login.php");

}
$userid = $_SESSION['user'];

$pagename = $_REQUEST['pagename'];


include('classes/assywoClass.php');
include('classes/assywoliClass.php');
include('classes/assywoli_operClass.php');
include('classes/fairClass.php');
include('classes/assyProcessDetailsClass.php');
// Next, create an instance of the classes required
$assywo = new assywo;
$assywo_li = new assywo_li;
$assywo_oper = new assywo_oper;
$newfair = new fair;
$newassyprodets = new assywoprocessdetails;
// Get all fields related to PO
if ($pagename == 'assyWoNew' || $pagename == 'assyWoEdit') {


   $assy_wonum = $_REQUEST['assy_wonum'];
   $wo_date = $_REQUEST['wo_date'];
   $crn = $_REQUEST['crn'];
   $customer = $_REQUEST['customer'];
   $crn = $_REQUEST['crn'];
   $cust_ponum = $_REQUEST['cust_ponum'];
   $po_qty = $_REQUEST['po_qty'];
   $bomnum = $_REQUEST['bomnum'];
   $bomiss = $_REQUEST['bomiss'];
   $assy_partno = $_REQUEST['assy_partno'];
   $assy_partiss = $_REQUEST['assy_partiss'];
   $assy_woqty = $_REQUEST['assy_woqty'];
   $descr = $_REQUEST['descr'];
   $drg_no = $_REQUEST['drg_no'];
   $drg_iss = $_REQUEST['drg_iss'];
   $aps_num = $_REQUEST['aps_num'];
   $aps_iss = $_REQUEST['aps_iss'];
   $cos_num = $_REQUEST['cos_num'];
   $sch_date = $_REQUEST['sch_due_date'];
   $rev_date = $_REQUEST['rev_ship_date'];
   $ship_date = $_REQUEST['act_ship_date'];
   $cust_po_line_num= $_REQUEST['cust_po_line_num'];
   $link2cust=$_REQUEST['link2cust'];
   $mpsnumber = $_REQUEST['mpsnumber'];
   $mps_rev = $_REQUEST['mpsrev'];
   $link2mps = $_REQUEST['link2mps'];
   $rev4fair= $_REQUEST['mpsrev'];
   $assy_type= $_REQUEST['assy_type'];
   $status=$_REQUEST['status'];
   $rework_grn=$_REQUEST['rework_grn'];
  // echo $rev4fair."-------------".$_REQUEST['mpsrev'];
}
if ($pagename == 'assyWoNew') {

//   echo "string";
// echo "<pre>";
//   print_r($_REQUEST);exit;
$i=1;
$j=1;

$max_li=$_REQUEST['index'];
$max_oper_li=$_REQUEST['index_oper'];
$max_process_det=$_REQUEST['index_pdets'];
$flag=0;
    $newlogin = new userlogin;
    $newlogin->dbconnect();
    $assywo->setassywonum($assy_wonum);
   	$assywo->setassywodate($wo_date);
   	$assywo->setwoqty($woqty);
    $assywo->setlink2cust($customer);
    $assywo->setponum($cust_ponum);
    $assywo->setpoqty($po_qty);
   	$assywo->setcrn($crn);
   	$assywo->setdescr($descr);
    $assywo->setdrg_iss($drg_iss);
   	$assywo->setdrg_no($drg_no);
   	$assywo->setassypartnum($assy_partno);
    $assywo->setassypartiss($assy_partiss);
   	$assywo->setassywoqty($assy_woqty);
    $assywo->setbomnum($bomnum);
   	$assywo->setbomiss($bomiss);
    $assywo->setapsno($aps_num);
   	$assywo->setapsiss($aps_iss);
    $assywo->setcosno($cos_num);
	$assywo->setsch_due_date( $sch_date);
	$assywo->setship_rev_date( $rev_date);
	$assywo->setac_ship_date( $ship_date);
	$assywo->setcust_po_line_num( $cust_po_line_num);
	$assywo->setmpsnumber($mpsnumber);
	$assywo->setmpsrev($mps_rev);
	$assywo->setlink2mps($link2mps);
	$assywo->setassy_type($assy_type);
	$assywo->setstatus($status);

    $assywo->setrework_grn($rework_grn);

    $sql = "start transaction";
    $result = mysql_query($sql);

    $flag=1;
    
    //FAIR Check
    $fair_flag = 0; $revmatch=0; $mpsrev4wo=0; $mpsrev4crn=0;$wofaistat="";
    $type = "";
    $type_remarks = "";
    $result_wo = $assywo->getPrev_wo($crn);
    $myrow_prev_wo =  mysql_fetch_row($result_wo);

       // echo "<br>".$rev4fair."----i--n---l--o--p----".$_REQUEST['mpsrev'];
    // For Previous WO check
    if(mysql_num_rows($result_wo) > 0)
    {
     $result_rev= $assywo->getPrevrev_match($crn,$myrow_prev_wo[0]);
     $myrow_rev = mysql_fetch_row($result_rev);
     // to populate the rev field it can be either m.rev or mps.rev

         if($myrow_rev[0] !=0 && $myrow_rev[0] !='')
         {
           $revmatch= $myrow_rev[2];
         }else if($myrow_rev[0] ==0 || $myrow_rev[0] =='')
         {
           $revmatch= $myrow_rev[1];
         }

    // to check if an entry exists for that crn and revnumber($rev4fair---selected) in fair table.

         $result_type = $newfair->get_prev_fair_details_new($crn,$rev4fair);
         $myrow_fair = mysql_fetch_row($result_type);

     //echo"HERE********----- $rev4fair-------------------$revmatch**********************$mywofai[0]----------------------- $myrow_fair[1] ";

     //if entry exists for the CRN and MPSREV
     if(mysql_num_rows($result_type) > 0)
     {
       $fair_flag = 1;
       if($myrow_fair[1] != 'APPROVED' && $myrow_fair[1] != 'CUST APPROVED')
       {
       $type = "RE FAIR";
       $type_remarks = "Type is RE FAIR due to change in MPS Revision";
       }
       if($myrow_fair[1] == 'NC' || $myrow_fair[1] == '')
      {
         $type = "FAIR";
         $type_remarks = "Type is FAIR as of the status entered by QA";
      }
      if($myrow_fair[2]==$rev4fair && ($myrow_fair[1] == 'APPROVED' || $myrow_fair[1] == 'CUST APPROVED'))
         {
            $type = "PRODUCTION";
            $type_remarks = "Production WO";
            $fair_flag = 0;

         }

      if($myrow_fair[1] != 'NC' && $myrow_fair[1] != '' && $myrow_fair[1] != 'APPROVED' && $myrow_fair[1] != 'CUST APPROVED' )
         {

          $type = $myrow_fair[1];
          if($type == "RE FAIR")
            {
               $type_remarks = "Type is RE FAIR as of the status entered by QA";
            }
            if($type == "DELTA FAIR")
            {
              $type_remarks = "Type is DELTA FAIR as of the status entered by QA";
            }
         }

     }

     else
         {

//$rev4fair is the current rev number  $revmatch is the revision number of previous WO (either rev from master data or rev from MPS)
            if($rev4fair!=$revmatch )
            {
              $fair_flag = 1;
              $type = "RE FAIR";
              $type_remarks = "Type is RE FAIR due to change in MPS Revision";
            }
            else if($rev4fair ==$revmatch)
            {
              $type = "PRODUCTION";
              $type_remarks = "Production WO";
              $fair_flag = 0;
            }


          }
     }
   // New WO for the CRN.
    else if(mysql_num_rows($result_wo) == 0)
    {
       $fair_flag = 1;
       $type = "FAIR";
       $type_remarks = "Type is FAIR because of the first WO for the CRN";
    }
  //echo $fair_flag."--------".$type_remarks;
//end fair check
$assywo->setfai_type($type);
$assywo->settype_remarks($type_remarks);
$assyworecnum=$assywo->addAssywo();

 if($fair_flag == 1)
     {
       $newfair->setcrn($crn);
       $newfair->setwo($assy_wonum);
       $newfair->setwodate($wo_date);
       $newfair->settype($type);
       $newfair->setmpsrev($rev4fair);
       $newfair->setlink2wo($assyworecnum);
       $newfair->addFair();
     }

include("interassyprocess.php");
//echo $max_li."*-*-*-*-";
while($i<=$max_li)
{
   $linenumber="line_num" . $i;
   $itemno="itemno" . $i;
   $partnum="partnum" . $i;
   $issue="issue" . $i;
   $descr="descr" . $i;
   $qty="qty" . $i;
   $uom="uom" . $i;
   $qty_wo="qty_wo" . $i;
   $grn="grn" . $i;
   $exp_date="exp_date" . $i;
   $remarks="remarks_li" . $i;
   $qty_rew="qty_rew" . $i;
   $qty_rej="qty_rej" . $i;
   $crn_num4li = "crn_num4li" . $i;
   $bom_type= "type".$i;
   $qty_ret="qty_ret" . $i;
   $qty_acc="qty_acc" . $i;
   $pcrn_num="pcrn_num" . $i;
   $crn_type="crn_type" . $i;

   
	$line_num1= $_REQUEST[$linenumber];
	$itemno1 = $_REQUEST[$itemno];
	$partno1 = $_REQUEST[$partnum];
	$issue1 = $_REQUEST[$issue];
	$descr1 = $_REQUEST[$descr];
	$qty1 = $_REQUEST[$qty];
	$uom1 = $_REQUEST[$uom];
	$qty_wo1 = $_REQUEST[$qty_wo];
	$grn1 = $_REQUEST[$grn];
	$exp_date1 = $_REQUEST[$exp_date];
	$remarks1 = $_REQUEST[$remarks];
	$qty_rew1= $_REQUEST[$qty_rew];
	$qty_rej1= $_REQUEST[$qty_rej];
	$crn_num4li1= $_REQUEST[$crn_num4li];
	$bom_type1= $_REQUEST[$bom_type];
	$qty_ret1= $_REQUEST[$qty_ret];
	$qty_acc1= $_REQUEST[$qty_acc];
	$pcrn_num1 = $_REQUEST[$pcrn_num];
	$crn_type1= $_REQUEST[$crn_type];

       //echo $line_num1."****---****".$pcrn_num1."<br>";
	if ($line_num1 != ''|| ($line_num1 == ''&& $pcrn_num1!= ''))
	{    //echo"HERE-------$i";
		if ($pagename == 'assyWoNew')
		{
            $qty4mwo= $assywo_li->getassyqty4wo($grn1);
            $fqty=$qty4mwo+$qty_wo1;

			$assywo_li->setlinenum($line_num1);
			$assywo_li->setitemno($itemno1);
			$assywo_li->setpartno($partno1);
			$assywo_li->setissue($issue1);
			$assywo_li->setdescr($descr1);
			$assywo_li->setqty($qty1);
			$assywo_li->setwo_qty($qty_wo1);
			$assywo_li->setuom($uom1);
			$assywo_li->setgrn($grn1);
			$assywo_li->setqty_rew($qty_rew1);
			$assywo_li->setqty_rej($qty_rej1);
			$assywo_li->setcrn_num4li($crn_num4li1);
          	$assywo_li->settype($bom_type1);
			$assywo_li->setlink2assywo($assyworecnum);
			$assywo_li->setexpdate($exp_date1);
			$assywo_li->setremarks($remarks1);
			$assywo_li->setqty_ret($qty_ret1);
			$assywo_li->setqty_acc($qty_acc1);
			$assywo_li->setpcrn_num($pcrn_num1);
			$assywo_li->setcrn_type($crn_type1);
			$assywo_li->addAssywo_li($cust_ponum);
			if($assy_type=='Kit')
			{
              $assywo_li->updateassywork_order($assy_wonum,$fqty);
			}
			else if($assy_type != 'Rework')
			{
                $assywo_li->updatework_order($grn1,$assy_wonum,$fqty);

			}

		}
	}
	$i++;
}

while($j<=$max_oper_li)
{
    $oppn_num="oppn_num" . $j;
    $stn_num="stn_num" . $j;
    $operation_descr="operation_descr" . $j;
    $sign="sign" . $j;
    $remarks="remarks" . $j;


	$oppn_num1= $_REQUEST[$oppn_num];
	$stn_num1 = $_REQUEST[$stn_num];
	$operation_descr1 = $_REQUEST[$operation_descr];
	$sign1 = $_REQUEST[$sign];
	$remarks1 = $_REQUEST[$remarks];

	if ($oppn_num1 != '')
	{
		if ($pagename == 'assyWoNew')
		{

        	$assywo_oper->setopnnum($oppn_num1);
			$assywo_oper->setstn($stn_num1);
			$assywo_oper->setoperation($operation_descr1);
			$assywo_oper->setsignoff($sign1);
			$assywo_oper->setremarks($remarks1);
			$assywo_oper->setlink2assywo($assyworecnum);

			$assywo_oper->addAssywoOper();
		}
	}
	$j++;
}

while($m<=$max_process_det)
{
    $seqnumber="seqnumber" . $m;
    $process="process" . $m;
    $st_date_time="st_date_time" . $m;
    $end_date_time="end_date_time" . $m;
    $remarks_pdets="remarks_pdets" . $m;


	$seqnumber1= $_REQUEST[$seqnumber];
	$process1 = $_REQUEST[$process];
	$st_date_time1 = $_REQUEST[$st_date_time];
	$end_date_time1 = $_REQUEST[$end_date_time];
	$remarks_pdets1 = $_REQUEST[$remarks_pdets];

	if ($seqnumber1 != '')
	{
		if ($pagename == 'assyWoNew')
		{

        	$newassyprodets->setseqnumber($seqnumber1);
			$newassyprodets->setprocess($process1);
			$newassyprodets->setst_date_time($st_date_time1);
			$newassyprodets->setend_date_time($end_date_time1);
			$newassyprodets->setremarks_pdets($remarks_pdets1);
			$newassyprodets->setlink2assywo($assyworecnum);

			$newassyprodets->addassywoProcessdets();
		}
	}
	$m++;
}


			$sql = "commit";
			$result = mysql_query($sql);
			if(!$result)
			{
				 $sql = "rollback";
				 $result = mysql_query($sql);
				 die("Commit failed for Assy WO LI Insert..Please report to Sysadmin. " . mysql_errno());
			}
header("Location:assywo.php");
}

if ($pagename == 'assyWoEdit')
{
//echo "i am inside update";
$assyworecnum = $_REQUEST['assyworecnum'];

$i=1;
$j=1;

$max_li=$_REQUEST['index'];
$max_oper_li=$_REQUEST['index_oper'];
$max_process_det=$_REQUEST['index_pdets'];
$flag=0;
$part_flag=0;
              $newlogin = new userlogin;
              $newlogin->dbconnect();

              $sql = "start transaction";
              $result = mysql_query($sql);

             $assywo->setassywodate($wo_date);
   	         $assywo->setwoqty($woqty);
             $assywo->setlink2cust($customer);
             $assywo->setponum($cust_ponum);
             $assywo->setpoqty($po_qty);
   	         $assywo->setcrn($crn);
   	         $assywo->setdescr($descr);
             $assywo->setdrg_iss($drg_iss);
   	         $assywo->setdrg_no($drg_no);
   	         $assywo->setassypartnum($assy_partno);
             $assywo->setassypartiss($assy_partiss);
   	         $assywo->setassywoqty($assy_woqty);
             $assywo->setbomnum($bomnum);
   	         $assywo->setbomiss($bomiss);
             $assywo->setapsno($aps_num);
   	         $assywo->setapsiss($aps_iss);
             $assywo->setcosno($cos_num);
			 $assywo->setsch_due_date( $sch_date);
	         $assywo->setship_rev_date( $rev_date);
	         $assywo->setac_ship_date( $ship_date);
	         $assywo->setcust_po_line_num( $cust_po_line_num);
	         $assywo->setmpsnumber($mpsnumber);
	         $assywo->setmpsrev($mps_rev);
	         $assywo->setassy_type($assy_type);
	         $assywo->setlink2mps($link2mps);
	         $assywo->setstatus($status);

			 $assywo->setrework_grn($rework_grn);

             $assywo->updateAssywo($assyworecnum);
             $flag=1;
 			      //  echo 'after dispatch'.$max_li;
           include("interassyprocess.php");
          // echo $max_li."*-*-*-*-";
while($i<=$max_li)
{
//	echo "i am inside while loop" .$line_num1;
      $linenumber="line_num" . $i;
      $itemno="itemno" . $i;
      $partnum="partnum" . $i;
      $issue="issue" . $i;
      $descr="descr" . $i;
      $qty="qty" . $i;
      $uom="uom" . $i;
      $qty_wo="qty_wo" . $i;
      $grn="grn" . $i;
      $exp_date="exp_date" . $i;
      $remarks="remarks_li" . $i;
      $qty_rew="qty_rew" . $i;
      $qty_rej="qty_rej" . $i;
      $crn_num4li = "crn_num4li" . $i;
      $bom_type= "type".$i;
      $prevlinenum="prev_line_num" . $i;
      $lirecnum="lirecnum" . $i;
      $qty_ret="qty_ret" . $i;
      $qty_acc="qty_acc" . $i;
      $pcrn_num="pcrn_num" . $i;
      $crn_type="crn_type" . $i;
      $prev_qty_wo="prev_qty_wo" . $i;

	$prevlinenum1=$_REQUEST[$prevlinenum];
	$lirecnum1=$_REQUEST[$lirecnum];

    $line_num1= $_REQUEST[$linenumber];
    //echo "i am inside while loop" .$line_num1."<br>";
	$itemno1 = $_REQUEST[$itemno];
	$partno1 = $_REQUEST[$partnum];
	$issue1 = $_REQUEST[$issue];
	$descr1 = $_REQUEST[$descr];
	$qty1 = $_REQUEST[$qty];
	$uom1 = $_REQUEST[$uom];
	$qty_wo1 = $_REQUEST[$qty_wo];
	$grn1 = $_REQUEST[$grn];
	$exp_date1 = $_REQUEST[$exp_date];
	$remarks1 = $_REQUEST[$remarks];
	$qty_rew1= $_REQUEST[$qty_rew];
	$qty_rej1= $_REQUEST[$qty_rej];
	$crn_num4li1= $_REQUEST[$crn_num4li];
	$bom_type1= $_REQUEST[$bom_type];
    $qty_ret1= $_REQUEST[$qty_ret];
   	$qty_acc1= $_REQUEST[$qty_acc];
   	$pcrn_num1 = $_REQUEST[$pcrn_num];
    $crn_type1= $_REQUEST[$crn_type];
    $prev_qty_wo1= $_REQUEST[$prev_qty_wo];
	$newlogin = new userlogin;
	$newlogin->dbconnect();

	//echo "<br>Values for line number   :$line_num1<br>$pcrn_num1<br>";
	if ($line_num1 != ''|| ($line_num1 == ''&& $pcrn_num1!= ''))
	{
            if($assy_type=='Kit')
            {
              $qty4mwo= $assywo_li->getassyqty4kitwo($grn1);

            }else
            {
              $qty4mwo= $assywo_li->getassyqty4wo($grn1);
            }
            $totqty4wo=$assywo_li->getassy_qty4wo($grn1);
            
           // echo $totqty4wo."--**--".$qty4mwo;
            //$fqty=$qty4mwo-$prev_qty_wo1+$qty_wo1;
            
            if($status=='Cancelled')
            {
             if($qty4mwo!=0)
             {
              $fqty=$qty4mwo-$qty_wo1;
             }else
             {
              $fqty=$totqty4wo-$qty_wo1;
             }

            }else
            {
              if($qty4mwo!=0)
              {
               $fqty=$qty4mwo-$prev_qty_wo1+$qty_wo1;
              }else
              {
                $fqty=$totqty4wo;
              }

            }

            

           	$assywo_li->setlinenum($line_num1);
			$assywo_li->setitemno($itemno1);
			$assywo_li->setpartno($partno1);
			$assywo_li->setissue($issue1);
			$assywo_li->setdescr($descr1);
			$assywo_li->setqty($qty1);
			$assywo_li->setwo_qty($qty_wo1);
			$assywo_li->setuom($uom1);
			$assywo_li->setgrn($grn1);
			$assywo_li->setlink2assywo($assyworecnum);
			$assywo_li->setexpdate($exp_date1);
			$assywo_li->setremarks($remarks1);
			$assywo_li->setqty_rew($qty_rew1);
			$assywo_li->setqty_rej($qty_rej1);
			$assywo_li->setcrn_num4li($crn_num4li1);
			$assywo_li->settype($bom_type1);
			$assywo_li->setqty_ret($qty_ret1);
			$assywo_li->setqty_acc($qty_acc1);
			$assywo_li->setpcrn_num($pcrn_num1);
			$assywo_li->setcrn_type($crn_type1);
            // echo $lirecnum1."------------".$prevlinenum1."----------".$pcrn_num1."$i<br>";
             if($prevlinenum1!=''|| ($lirecnum1 != ''&& $pcrn_num1!= ''))
		     {
			    $assywo_li->updateAssywo_li($lirecnum1,$cust_ponum);
		     }
		     else
		     {
                       if($part_flag == 0  && $_REQUEST['delete_flag']==1)
                       {
                         $assywo_li->deleteAssyli($assyworecnum);
                         $part_flag = 1;                         
                       }

                       $assywo_li->setlink2assywo($assyworecnum);
      		           $assywo_li->addAssywo_li($cust_ponum);
		     }

      
       	    if($assy_type=='Kit')
			{
               $assywo_li->updateassywork_order($assy_wonum,$fqty);
			}else
			{
        // echo "reac".$assy_type;
               $assywo_li->updatework_order($grn1,$assy_wonum,$fqty);

			}
	}
	else
	{
		 if ($prevlinenum1 != '')
		 {
			 $assywo_li->deleteLI($lirecnum1);
		 }
	}
$i++;
}
$oper_flag = 0;
//echo 'index='.$max_oper_li;
while($j<=$max_oper_li)
{
	//echo "i am inside while loop" .$i;
    $oppn_num="oppn_num" . $j;
    $stn_num="stn_num" . $j;
    $operation_descr="operation_descr" . $j;
    $sign="sign" . $j;
    $remarks="remarks_oper" . $j;


	$oppn_num1= $_REQUEST[$oppn_num];
	$stn_num1 = $_REQUEST[$stn_num];
	$operation_descr1 = $_REQUEST[$operation_descr];
	$sign1 = $_REQUEST[$sign];
	$remarks1 = $_REQUEST[$remarks];

        $prevlinenum_oper="prev_line_num_oper" . $j;
        $lirecnum_oper="lirecnum_oper" . $j;

	$prevlinenum1_oper=$_REQUEST[$prevlinenum_oper];
	$lirecnum1_oper=$_REQUEST[$lirecnum_oper];


	$newlogin = new userlogin;
	$newlogin->dbconnect();
        //echo 'opn_num='.$oppn_num1;
	//echo "<br>Values for line number   :$linenumber1<br>$itemname1<br>$itemdesc1<br>$qty1<br>$rate1<br>$duedate1";
	if ($oppn_num1 != '')
	{


           	       $assywo_oper->setopnnum($oppn_num1);
		       $assywo_oper->setstn($stn_num1);
		       $assywo_oper->setoperation($operation_descr1);
		       $assywo_oper->setsignoff($sign1);
		       $assywo_oper->setremarks($remarks1);
		       $assywo_oper->setlink2assywo($assyworecnum);
                       //echo 'prevline='.$prevlinenum1_oper;
                      if($prevlinenum1_oper != '')
		      {
			  $assywo_oper->updateAssywo_oper($lirecnum1_oper);
		      }
		      else
		      {
                          //echo 'inside';
                          if($oper_flag == 0 && $_REQUEST['delete_flag']==1)
                          {
                           $assywo_oper->deleteOperli($assyworecnum);
                           $oper_flag = 1;                         
                          }

                        $assywo_oper->setlink2assywo($assyworecnum);
      		        $assywo_oper->addAssywoOper();
		      }
	}
       else 
	{
             if ($prevlinenum1_oper != '')
	     {
		$assywo_oper->deleteLI($lirecnum1);
	     }
	}
$j++;
}

$process_dets_flg = 0;
//echo 'index='.$max_oper_li;
while($m<=$max_process_det)
{
	//echo "i am inside while loop" .$i;
    $seqnumber="seqnumber" . $m;
    $process="process" . $m;
    $st_date_time="st_date_time" . $m;
    $end_date_time="end_date_time" . $m;
    $remarks_pdets="remarks_pdets" . $m;


	$seqnumber1= $_REQUEST[$seqnumber];
	$process1 = $_REQUEST[$process];
	$st_date_time1 = $_REQUEST[$st_date_time];
	$end_date_time1 = $_REQUEST[$end_date_time];
	$remarks_pdets1 = $_REQUEST[$remarks_pdets];

    $prevlinenum_prdet="prevlinenum_prdet" . $m;
    $linerecnum_prdet="linerecnum_prdet" . $m;

	$prevlinenum_prdet1=$_REQUEST[$prevlinenum_prdet];
	$linerecnum_prdet1=$_REQUEST[$linerecnum_prdet];


	$newlogin = new userlogin;
	$newlogin->dbconnect();
        //echo 'opn_num='.$oppn_num1;
	//echo "<br>Values for line number   :$linenumber1<br>$itemname1<br>$itemdesc1<br>$qty1<br>$rate1<br>$duedate1";
	if ($seqnumber1 != '')
	{


            $newassyprodets->setseqnumber($seqnumber1);
			$newassyprodets->setprocess($process1);
			$newassyprodets->setst_date_time($st_date_time1);
			$newassyprodets->setend_date_time($end_date_time1);
			$newassyprodets->setremarks_pdets($remarks_pdets1);
			$newassyprodets->setlink2assywo($assyworecnum);
                       //echo 'prevline='.$prevlinenum1_oper;
                      if($prevlinenum_prdet1 != '')
		      {
			  $newassyprodets->updateAssywo_processdets($linerecnum_prdet1);
		      }
		      else
		      {
                          //echo 'inside';
                          if($process_dets_flg == 0 && $_REQUEST['delete_flag_prodet']==1)
                          {
                           $newassyprodets->deleteprocessdets($assyworecnum);
                           $process_dets_flg = 1;
                          }

                        $newassyprodets->setlink2assywo($assyworecnum);
      		            $newassyprodets->addassywoProcessdets();
		      }
	}
       else
	{
             if ($prevlinenum_prdet1 != '')
	     {
		    $newassyprodets->deleteprodetLI($linerecnum_prdet1);
	     }
	}
$m++;
}



	 $sql = "commit";
	 $result = mysql_query($sql);
	 if(!$result)
	 {
		 $sql = "rollback";
		 $result = mysql_query($sql);
		 die("Commit failed Assywo Insert..Please report to Sysadmin. " . mysql_errno());
	 }
header("Location:assywo.php");
}
?>
