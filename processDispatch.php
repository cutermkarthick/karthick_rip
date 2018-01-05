<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = June 20, 2004                =
// Filename: processDispatch.php               =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OWT                          =
// Allows processing of DISPATCHs              =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ("Location:login.php");

}
$userid = $_SESSION['user'];

$pagename = $_SESSION['pagename'];

//echo "<br>Page name is $pagename";
include('classes/dispatchClass.php');
include('classes/dispatchliClass.php');
include('classes/fairClass.php');
include('classes/consumptionClass.php');
// Added July 21, 2012 for managing CRN schedule updates from Cofc

// Next, create an instance of the classes required
$newDispatch = new dispatch;
$newLI = new dispatch_line_items;
$newFair = new fair;
$newconsumption = new consumption;
// Added July 21, 2012 for managing CRN schedule updates from Cofc

// Get all fields related to PO
$dispUpdate=0;

if ($pagename == 'newdispatch' || $pagename == 'dispatchupdate') {

 
   $relnotenum = $_REQUEST['relnotenum'];
   $dispatch_date = $_REQUEST['disp_date'];
   $dispatchdesc = $_REQUEST['disp_desc'];
   $dispatch2cust = $_REQUEST['companyrecnum'];
   $via = $_REQUEST['via'];
   $refno = $_REQUEST['refno'];
   $crn = $_REQUEST['crnnum'];
   $remarks = $_REQUEST['remarks'];
   $status = $_REQUEST['status'];
   $create_date = $_REQUEST['create_date'];
   $mod_date = $_REQUEST['mod_date'];
   $delivery_to = $_REQUEST['deliver'];
   $invoice_to = $_REQUEST['invoice'];
   $schdate = $_REQUEST['sch_date'];
   $schqty = $_REQUEST['schqty'];
   $type = $_REQUEST['type'];
   $totdispqty = $_REQUEST['totdispqty'];
   $expinvnum = $_REQUEST['expinvnum'];

}
if ($pagename == 'newdispatch') {

$i=1;  $prev_grn='#';$qtygrn=0; $qty_make=0;
$max=$_REQUEST['index'];
$flag=0;
while($i<=6)
{
  $linenumber="line_num" . $i;
  $wonum="wonum" . $i;
    $dnnum="dnnum" . $i;
  $supplier_wonum="supplier_wonum" . $i;
  $partnum="partnum" . $i;
  $woqty="wo_qty" . $i;
  $compqty="comp_qty" . $i;
  $grnnum="grnnum" . $i;
  $custponum="custpo_num" . $i;

  $disp_custpo_no="disp_custpo_no" . $i;
  $disp_custpo_item="disp_custpo_item" . $i;


  $custpoqty="custpo_qty" . $i;
    $custpodate="custpo_date" . $i;
  $dispatchqty="disp_qty" . $i;
    $partname="partname" . $i;
    $rmspec="rmspec" . $i;
    $partiss="partiss" . $i;
    $drgiss="drgiss" . $i;
    $cos="cos" . $i;
    $itemnum="itemnum" . $i;
    $batchnum="batchnum" . $i;
    $psn="psn" .$i;
    $exp_invnum="exp_invnum" .$i;
  
  $linenumber1= $_REQUEST[$linenumber];
  $wonum1 = $_REQUEST[$wonum];
  $dnnum1 = $_REQUEST[$dnnum];
  $supplier_wonum1 = $_REQUEST[$supplier_wonum];
  $partnum1 = $_REQUEST[$partnum];
  $woqty1 = $_REQUEST[$woqty];
  $compqty1 = $_REQUEST[$compqty];
  $grnnum1 = $_REQUEST[$grnnum];
  $custponum1 = $_REQUEST[$custponum];

  $disp_custpo_no1 = $_REQUEST[$disp_custpo_no];
  $disp_custpo_item1 = $_REQUEST[$disp_custpo_item];


  $custpoqty1 = $_REQUEST[$custpoqty];
  $custpodate1 = $_REQUEST[$custpodate];
  $custpodate1 = $_REQUEST[$custpodate];
    $dispatchqty1 = $_REQUEST[$dispatchqty];
    $partname1=$_REQUEST[$partname];
    $rmspec1=$_REQUEST[$rmspec];
    $partiss1=$_REQUEST[$partiss];
    $drgiss1=$_REQUEST[$drgiss];
    $cos1=$_REQUEST[$cos];
    $itemnum1=$_REQUEST[$itemnum];
    $batchnum1=$_REQUEST[$batchnum];
    $psn1=$_REQUEST[$psn];
    $exp_invnum1 = $_REQUEST[$exp_invnum];
   //echo $exp_invnum1."---1177111--<br>";
  if ($linenumber1 != '')
  {
    if ($pagename == 'newdispatch')
    {
      if($flag==0)
      {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
          $newDispatch->setdisp_date($dispatch_date);
          $newDispatch->setdisp2cust($dispatch2cust);
          $newDispatch->setdispdesc($dispatchdesc);
          $newDispatch->setvia($via);
                $newDispatch->setrefno($refno);
                $newDispatch->setcrn($crn);
                $newDispatch->setremarks($remarks);
                $newDispatch->setstatus($status);
          $newDispatch->setcreate_date($create_date);
          $newDispatch->setmod_date($mod_date);
          $newDispatch->setdelivery($delivery_to);
          $newDispatch->setinvoice($invoice_to);
                $newDispatch->setschdate($schdate);
                $newDispatch->setschqty($schqty);
        $newDispatch->settype($type);
        $newDispatch->setexpinvnum($expinvnum);
        $sql = "start transaction";
        $result = mysql_query($sql);
        $disprecnum = $newDispatch->addDispatch();
        $c = "C";
        $disp_recnum=$c.$disprecnum;
      //  $tot_qty=$newDispatch->getsumdisp4cons($grnnum1,$crn);
      //  echo $tot_qty."------";
        //$newDispatch->updateconsumptiondisp();
        $flag=1;
      }

      $newLI->setlink2dispatch($disprecnum);
      $newLI->setlinenum($linenumber1);
      $newLI->setwonum($wonum1);
      $newLI->setdnnum($dnnum1);
      $newLI->setsupplier_wonum($supplier_wonum1);
      $newLI->setpartnum($partnum1);
      $newLI->setwoqty($woqty1);
      $newLI->setcompqty($compqty1);
      $newLI->setgrnnum($grnnum1);
      $newLI->setcustpo_qty($custpoqty1);
        $newLI->setpartname($partname1);
            $newLI->setrmspec($rmspec1);
          $newLI->setdrgiss($drgiss1);
        $newLI->setpartiss($partiss1);
        $newLI->setcos($cos1);
        $newLI->setitemnum($itemnum1);
      $newLI->setcustpo_date($custpodate1);
      $newLI->setcustpo_num($custponum1);

      $newLI->setdisp_custpo_no($disp_custpo_no1);
      $newLI->setdisp_custpo_item($disp_custpo_item1);


      $newLI->setdisp_qty($dispatchqty1);
            $newLI->setBatchnum($batchnum1);
        $newLI->setpsn($psn1);
      //$newLI->setamount($amount1);
      $newLI->addLI();

    if( $type =='Treated')
              {


                $wodqty=$newLI->updatedispqty4dnli($supplier_wonum1,$dispatchqty1);
        // echo "<br>wodqty is $wodqty";
                
       }
      if( $type !='Assembly' && $type !='Kit')
              {
                $wodqty=$newLI->getdispqty4update($wonum1);
        //echo "<br>wodqty is $wodqty";
                $finaldisp_qty= $wodqty + $dispatchqty1;
                $newLI->updateWo4dispqty($finaldisp_qty);

       }
       if($type =='Assembly' || $type =='Kit')
             {
                 $wodqty=$newLI->getdispqty4assyupdate($wonum1);
                 // $finaldisp_qty= $wodqty + $dispatchqty1;
                  //echo $wodqty."---qty---".$dispatchqty1;
                 $finaldisp_qty= $wodqty + $dispatchqty1;
                 $newLI->updateassyWo4dispqty($finaldisp_qty);
       }

        $result=$newLI->getgrninfo4cons($grnnum1);
        $result_grn=$newLI->getallgrn4consupdate($grnnum1);
        $resultcons=$newLI->getgrnmcofcdet4cons($grnnum1);
            $result_cons=$newLI->getgrnmcofcdet4cons($grnnum1);
          //echo $qtyrej."**-*--*-*<br>";
          if(mysql_num_rows($result) >0)
           {
        while($myrowgrn=mysql_fetch_row($result))
        {         //echo  $myrowgrn[2]."-----111--------";
              $myconsinfo=mysql_fetch_row($resultcons);
              $resrmmaster=$newconsumption->getallrmdetails($myrowgrn[11]);
              $myrmres=mysql_fetch_row($resrmmaster);
              $resultqtyrej=$newLI->getworej4cofc($grnnum1);
          $myqty_rej=mysql_fetch_row($resultqtyrej) ;
          $qtyrej = $myqty_rej[0];
          $disp_number="C".$disprecnum;
          $resinvdets=$newconsumption->getconsumptiondets4grn($myrowgrn[0]);
              $myinvdet=mysql_fetch_assoc($resinvdets) ;

              if(($myrmres[0] !='' && $myrmres[0] !='-'&& $myrmres[0] !='NA' && $myrmres[0] !='Not Applicable' )&& ($myrmres[1] !='' && $myrmres[1] !='-' && $myrmres[1] !='NA'&& $myrmres[1] !='Not Applicable'))
               {
                  $uom='Meters';//echo"HERE---";
               }
               else if(($myrmres[0] !='' && $myrmres[0] !='-'&& $myrmres[0] !='NA' && $myrmres[0] !='Not Applicable'))
               {
                  $uom='Meters'; //echo"HERE--1111-";
               }
               else if(($myrmres[1] !='' && $myrmres[1] !='-' && $myrmres[1] !='NA'&& $myrmres[1] !='Not Applicable') && ($myrmres[2] !='' && $myrmres[2] !='-' && $myrmres[2] !='NA'&& $myrmres[2] !='Not Applicable') && ($myrmres[3] !='' && $myrmres[3] !='-' && $myrmres[3] !='NA'&& $myrmres[3] !='Not Applicable'))
               {
                   $uom='NOS'; //echo"HERE--52222-";
               }
               while($myrow_grn=mysql_fetch_row($result_grn))
               {
                 if($prev_grn!=$myrow_grn[0])
                   {     //echo "HERE---";
                     if($myrow_grn[5]!='' && $myrow_grn[5] !='-' && $myrow_grn[5]!='NA' && $myrow_grn[5]!=0)
                       {
                         $dimension = " (".$myrow_grn[4]."X".$myrow_grn[5]."X".$myrow_grn[6].")";
                       }else
                       {
                         $dimension = " (".$myrow_grn[4]."X".$myrow_grn[6].")";
                       }
                       $qtygrn =$myrow_grn[1];
                       $qty_make = $myrow_grn[3];
                       $prev_grn=$myrow_grn[0] ;
                     }else
                     {  //echo "HERE----11----";
                       if($myrow_grn[5]!='' && $myrow_grn[5] !='-' && $myrow_grn[5]!='NA' && $myrow_grn[5]!=0)
                       {
                         $dimension = " (".$myrow_grn[4]."X".$myrow_grn[5]."X".$myrow_grn[6].")".$dimension;
                       }else
                       {
                         $dimension = " (".$myrow_grn[4]."X".$myrow_grn[6].")".$dimension;
                       }
                       $qtygrn +=$myrow_grn[1];
                       $qty_make += $myrow_grn[3];
                     }

                       $grn= $myrowgrn[0];
                       $rm_spec= $myrow_grn[8]." ".$dimension." ;".$myrow_grn[7];
                    }
                       //$grn= $myrowgrn[3];
                       //$rm_spec= $myrowgrn[6]." ".$dimension." ;".$myrowgrn[15];
                      // echo $rm_spec."----new---";
            //echo "<br>here";
              if( $type !='Assembly'&& $type !='Kit')
              {
              if($myconsinfo[0]=='')
              {
                $newLI->addtoconsumption($myrowgrn[3],$myrowgrn[0],$myrowgrn[1],$qty_make,$dispatchqty1,$disp_number,$crn,$myrowgrn[4],$myrowgrn[5],$rm_spec,$myrowgrn[7],$myrowgrn[8],$uom,$qtygrn,$qtyrej,$myinvdet['bond_num'], $myinvdet['bonddate'],$myinvdet['be_num'], $myinvdet['bedate'], $myinvdet['assessval'], $myinvdet['cifval'], $myinvdet['dutyamt'], $myinvdet['invamt'],$myinvdet['currency'],$exp_invnum1);
              }
              else
              {
              //echo  $myrowgrn[2]."---2222----------";
               if($myconsinfo[1]=='')
              {
                 $newLI->updatetoconsumption($qty_make,$dispatchqty1,$disp_number,$crn,$myconsinfo[0],$myinvdet['bond_num'], $myinvdet['bonddate'],$myinvdet['be_num'], $myinvdet['bedate'], $myinvdet['assessval'], $myinvdet['cifval'], $myinvdet['dutyamt'], $myinvdet['invamt'],$myinvdet['currency'],$exp_invnum1);
                 $newLI->updatetoconsumptionrej($grnnum1,$qtyrej);
              }
        else
              {
               $cofcinfo=$newLI->getcofcnuminfo($grnnum1,$disp_number);
               //echo mysql_num_rows($resultcons)."----";
               if(mysql_num_rows($cofcinfo)>0)
               {    //echo $myconsinfo[1]."--------".$disp_number ;
               while($mycons_info=mysql_fetch_row($result_cons))
               {
                  //echo "$mycons_info[1]---in ---the---loop---$disp_number<br>";
                   if($mycons_info[1]==$disp_number)
                 {
                   $dqty=$newLI->getdispqty4grn($grnnum1,$disp_number);
                   //echo $qtyrej."-*-**-*IN-*-$myconsinfo[0]<br>";
                   $newLI->updatetoconsumption($qty_make,$dqty,$disp_number,$crn,$mycons_info[0],$myinvdet['bond_num'], $myinvdet['bonddate'],$myinvdet['be_num'], $myinvdet['bedate'], $myinvdet['assessval'], $myinvdet['cifval'], $myinvdet['dutyamt'], $myinvdet['invamt'],$myinvdet['currency'],$exp_invnum1);
                   $newLI->updatetoconsumptionrej($grnnum1,$qtyrej);

                 }

               }

               }
                else
                {  //echo $dispatchqty1."-*-*addd*-*454545-*-";
                $newLI->addtoconsumption($myrowgrn[3],$myrowgrn[0],$myrowgrn[1],$qty_make,$dispatchqty1,$disp_number,$crn,$myrowgrn[4],$myrowgrn[5],$rm_spec,$myrowgrn[7],$myrowgrn[8],$uom,$qtygrn,$qtyrej,$myinvdet['bond_num'], $myinvdet['bonddate'],$myinvdet['be_num'], $myinvdet['bedate'], $myinvdet['assessval'], $myinvdet['cifval'], $myinvdet['dutyamt'], $myinvdet['invamt'],$myinvdet['currency'],$exp_invnum1);

                }
               }
              }
             }
           }
           }
      else
{ //echo $type."-----";
  if($type =='Assembly' || $type =='Kit')
  {

  if($type =='Assembly')
  {
   $resultwoassyli=$newconsumption->getwo4assyliwo($wonum1);
  }else if($type =='Kit')
  {
    $wonum4kit=$newLI->getwo4kitassyliwo($wonum1);
    $resultwoassyli=$newconsumption->getwo4assyliwo($wonum4kit);
  }
   while($mywoassyli=mysql_fetch_row($resultwoassyli))
  {
    if($mywoassyli[3]!="")
    {
      $resultgrn4wo=$newconsumption->getgrn4wo($mywoassyli[0]);
      $mygrn4wo=mysql_fetch_row($resultgrn4wo);
      $grn_num=$mygrn4wo[0];

    }
    else
    {
      $grn_num=$mywoassyli[0];
    }
    //echo $grnnum."-------GRNNUM---<br>";
    $result4assygrn=$newconsumption->getallgrn4assyconsupdate($grn_num);
    while($myrowgrn=mysql_fetch_row($result4assygrn))
  { // echo $myrowgrn[3]."------------";
   $grnnum=trim($myrowgrn[3]);
   $resultqtyrej=$newconsumption->getworej4consupdate($myrowgrn[3]);
   $myrejqty=mysql_fetch_row($resultqtyrej);
   $resrmmaster=$newconsumption->getallrmdetails($myrowgrn[9]);
   $myrmres=mysql_fetch_row($resrmmaster);
   $resinvdets=$newconsumption->getconsumptiondets4grn($myrowgrn[0]);
   $myinvdet=mysql_fetch_assoc($resinvdets) ;

            if(($myrmres[0] !='' && $myrmres[0] !='-'&& $myrmres[0] !='NA' && $myrmres[0] !='Not Applicable' )&& ($myrmres[1] !='' && $myrmres[1] !='-' && $myrmres[1] !='NA'&& $myrmres[1] !='Not Applicable'))
               {
                  $uom='Meters';//echo"HERE---";
               }
               else if(($myrmres[0] !='' && $myrmres[0] !='-'&& $myrmres[0] !='NA' && $myrmres[0] !='Not Applicable'))
               {
                  $uom='Meters'; //echo"HERE--1111-";
               }
               else if(($myrmres[1] !='' && $myrmres[1] !='-' && $myrmres[1] !='NA'&& $myrmres[1] !='Not Applicable') && ($myrmres[2] !='' && $myrmres[2] !='-' && $myrmres[2] !='NA'&& $myrmres[2] !='Not Applicable') && ($myrmres[3] !='' && $myrmres[3] !='-' && $myrmres[3] !='NA'&& $myrmres[3] !='Not Applicable'))
               {
                   $uom='NOS'; //echo"HERE--52222-";
               }
               //echo $prev_grn."--***---".$myrowgrn[3];
                    if($prev_grn!=$myrowgrn[3])
                   {    // echo "HERE---";
                     if($myrowgrn[12]!='' && $myrowgrn[12] !='-' && $myrowgrn[12]!='NA' && $myrowgrn[12]!=0)
                       {
                         $dimension = " (".$myrowgrn[11]."X".$myrowgrn[12]."X".$myrowgrn[13].")";
                       }else
                       {
                         $dimension = " (".$myrowgrn[11]."X".$myrowgrn[13].")";
                       }
                       $qty =$myrowgrn[10];
                       $qty_make = $myrowgrn[2];
                       $prev_grn=$myrowgrn[3] ;
                       $qty_rej =$myrejqty[0];
                      // $qty_rework=($myrejqty[1]+$myrejqty[2]);
                     }else
                     {  //echo "HERE----11----";
                       if($myrowgrn[12]!='' && $myrowgrn[12] !='-' && $myrowgrn[12]!='NA' && $myrowgrn[12]!=0)
                       {
                         $dimension = " (".$myrowgrn[11]."X".$myrowgrn[12]."X".$myrowgrn[13].")".$dimension;
                       }else
                       {
                         $dimension = " (".$myrowgrn[11]."X".$myrowgrn[13].")".$dimension;
                       }
                       $qty +=$myrowgrn[10];
                       $qty_make += $myrowgrn[2];
                       //$qty_rej +=$myrejqty[0];
                     }

                       $grn= $myrowgrn[0];
                       $rmspec= $myrowgrn[6]." ".$dimension." ;".$myrowgrn[14];
//$newLI->addtoconsumption($myrowgrn[3],$myrowgrn[0],$myrowgrn[1],$qty_make,$dispatchqty1,$disp_number,$crn,$myrowgrn[4],$myrowgrn[5],$rm_spec,$myrowgrn[7],$myrowgrn[8],$uom,$qtygrn,$qtyrej,$myinvdet['bond_num'], $myinvdet['bonddate'],$myinvdet['be_num'], $myinvdet['bedate'], $myinvdet['assessval'], $myinvdet['cifval'], $myinvdet['dutyamt'], $myinvdet['invamt'],$myinvdet['currency']);
$resultdn=$newconsumption->getdispatchassy4update($wonum1);


  while($mydnrow=mysql_fetch_row($resultdn))
  {
                 $c="C";
                 $result_cons=$newLI->getgrnmcofcdet4cons($grnnum);
                 $disp_recnum=$c.$mydnrow[0];
                 $resultcons=$newLI->getgrnmcofcdet4cons($grnnum);
                 $myconsinfo=mysql_fetch_row($resultcons);
                // echo "H---E---R---E---$myconsinfo[0]<br>";
              if($myconsinfo[0]=='')
              {
                $newLI->addtoconsumption($myrowgrn[3],$myrowgrn[0],$myrowgrn[1],$qty_make,$dispatchqty1,$disp_recnum,$crn,$myrowgrn[4],$myrowgrn[5],$rm_spec,$myrowgrn[7],$myrowgrn[8],$uom,$qtygrn,$qtyrej,$myinvdet['bond_num'], $myinvdet['bonddate'],$myinvdet['be_num'], $myinvdet['bedate'], $myinvdet['assessval'], $myinvdet['cifval'], $myinvdet['dutyamt'], $myinvdet['invamt'],$myinvdet['currency'],$exp_invnum1);
              }
              else
              {
                if($myconsinfo[1]=='')
                {      // echo"<br>HERE-----".$myrowgrn[10]."-*-**-*--*".$myconsinfo[0];
                   $newLI->updatetoconsumption($qty_make,$dispatchqty1,$disp_recnum,$crn,$myconsinfo[0],$myinvdet['bond_num'], $myinvdet['bonddate'],$myinvdet['be_num'], $myinvdet['bedate'], $myinvdet['assessval'], $myinvdet['cifval'], $myinvdet['dutyamt'], $myinvdet['invamt'],$myinvdet['currency'],$exp_invnum1);
                   $newLI->updatetoconsumptionrej($grnnum,$qtyrej);
                }
                else
                 {
          //echo "<br>In else$grnnum<br>";
                   $cofcinfo=$newLI->getcofcnuminfo($grnnum,$disp_recnum);
                  // echo mysql_num_rows($resultcons)."----";
                   if(mysql_num_rows($cofcinfo)>0)
                   {
            //echo "---222-----".$disp_recnum."<br>" ;
                      while($mycons_info=mysql_fetch_row($result_cons))
                      {
                         //echo "<br>$grnnum---in ---the---loop---$disp_recnum------<br>";
                          if($mycons_info[1]==$disp_recnum)
                          {
                            $dqty=$newLI->getdispqty4wo($wonum1,$disp_recnum);
                            //echo $dqty."-*-**-*IN-*-$myconsinfo[0]<br>";
                           $newLI->updatetoconsumption($qty_make,$dqty,$disp_recnum,$crn,$mycons_info[0],$myinvdet['bond_num'], $myinvdet['bonddate'],$myinvdet['be_num'], $myinvdet['bedate'], $myinvdet['assessval'], $myinvdet['cifval'], $myinvdet['dutyamt'], $myinvdet['invamt'],$myinvdet['currency'],$exp_invnum1);
                           $newLI->updatetoconsumptionrej($grnnum,$qtyrej);
                           }

                          /* else if($mycons_info[1]!=$disp_recnum)
                           { echo"HERE---in delete";
                            $newconsumption->deletefromconsumption($mycons_info[1],$grnnum);

                           }*/
                       }

                    }
                   else
                    {   // echo"HERE--new--";
               $newLI->addtoconsumption($myrowgrn[3],$myrowgrn[0],$myrowgrn[1],$qty_make,$dispatchqty1,$disp_recnum,$crn,$myrowgrn[4],$myrowgrn[5],$rm_spec,$myrowgrn[7],$myrowgrn[8],$uom,$qtygrn,$qtyrej,$myinvdet['bond_num'], $myinvdet['bonddate'],$myinvdet['be_num'], $myinvdet['bedate'], $myinvdet['assessval'], $myinvdet['cifval'], $myinvdet['dutyamt'], $myinvdet['invamt'],$myinvdet['currency'],$exp_invnum1);

                    }
                  }
            }

      }

    }

  }
 }
}

      $sql = "commit";
      $result = mysql_query($sql);
      if(!$result)
      {
         $sql = "rollback";
         $result = mysql_query($sql);
         die("Commit failed Dispatch LI Insert..Please report to Sysadmin. " . mysql_errno());
      }
           $c = "C";
           $cofc=$c.$disprecnum;
           $newFair->setcofc($cofc);
           $newFair->updateFair_cofc($crn,$wonum1);
    }
  }
  $i++;
 }
}

if ($pagename == 'dispatchupdate')
 {
//echo "<br>Inside of dispatchupdate";
$disprecnum = $_REQUEST['disprecnum'];

//$crdate = date("d-M-y");
$i=1; $qty_total=0;  $prev_grn='#';$qtygrn=0; $qty_make=0;

//$poamount=0;
//$total_due=0;
$max=$_REQUEST['index'];
$flag=0;
while($i<=6)
{
  //echo "i am inside while loop" .$i;
  $linenumber="line_num" . $i;
  //echo "$linenumber";
    $wonum="wonum" . $i;
    $dnnum="dnnum" . $i;
  $supplier_wonum="supplier_wonum" . $i;
    //echo "$wonum";
  $partnum="partnum" . $i;
  $woqty="wo_qty" . $i;
  $compqty="comp_qty" . $i;
  $grnnum="grnnum" . $i;
  $custponum="custpo_num" . $i;
  $custpoqty="custpo_qty" . $i;
    $custpodate="custpo_date" . $i;
  $dispatchqty="disp_qty" . $i;

    $partname="partname" . $i;
    $rmspec="rmspec" . $i;
    $partiss="partiss" . $i;
    $drgiss="drgiss" . $i;
    $cos="cos" . $i;
    $itemnum="itemnum" . $i;
    $batchnum="batchnum" . $i;
    $psn="psn" .$i;
    $disp_update="prev_qty".$i;
  $prelinenum="prev_line_num" . $i;
  $lirecnum="lirecnum" . $i;
    $exp_invnum="exp_invnum" .$i;
    $prevdqty="prev_qty".$i;


  $disp_custpo_no="disp_custpo_no" . $i;
  $disp_custpo_item="disp_custpo_item" . $i;
  // echo "<pre>";
      
  //     print_r($_REQUEST);exit;


      $lirecnum1=$_REQUEST[$lirecnum];
      $prevlinenum1=$_REQUEST[$prelinenum];
      $linenumber1= $_REQUEST[$linenumber];
  //echo "$linenumber1";
        $wonum1 = $_REQUEST[$wonum];
         $dnnum1 = $_REQUEST[$dnnum];
    $supplier_wonum1 = $_REQUEST[$supplier_wonum];
      $partnum1 = $_REQUEST[$partnum];
      $woqty1 = $_REQUEST[$woqty];
      $compqty1 = $_REQUEST[$compqty];
      $grnnum1 = $_REQUEST[$grnnum];
      $custponum1 = $_REQUEST[$custponum];

     $disp_custpo_no1 = $_REQUEST[$disp_custpo_no];
      $disp_custpo_item1 = $_REQUEST[$disp_custpo_item];


      $custpoqty1 = $_REQUEST[$custpoqty];
      $custpodate1 = $_REQUEST[$custpodate];
        $dispatchqty1 = $_REQUEST[$dispatchqty];
        $batchnum1=$_REQUEST[$batchnum];
        $psn1=$_REQUEST[$psn];
        $disp_update1=$_REQUEST[$disp_update];
       // $dispUpdate=$_REQUEST[$disp_update];
        $partname1=$_REQUEST[$partname];
        $rmspec1=$_REQUEST[$rmspec];
        $partiss1=$_REQUEST[$partiss];
        $drgiss1=$_REQUEST[$drgiss];
        $cos1=$_REQUEST[$cos];
        $itemnum1=$_REQUEST[$itemnum];
        $exp_invnum1 = $_REQUEST[$exp_invnum];
        $prevdqty1 = $_REQUEST[$prevdqty];
 // $prevdispqty = $_REQUEST[$prev_disp_qty];

        //echo $exp_invnum."---11111--<br>";
  $newlogin = new userlogin;
  $newlogin->dbconnect();

  //echo "<br>Values for line number   :$linenumber1<br>$itemname1<br>$itemdesc1<br>$qty1<br>$rate1<br>$duedate1";
  if ($linenumber1 != '')
  {
  //echo 'in linenumber';
    //echo "<br>this is line no   :$linenumber1";
    //$amount1=0;
    //$amount1 = $rate1 * $no_of_meterages1;

      if($flag==0)
      {
        /*$j=1;
        while($j<=6)
        {
          $linetot="line_num" . $j;
          $qtytot="no_of_meterages" . $j;
          $ratetot="rate" . $j;
          $linenumber2= $_REQUEST[$linetot];
          $qty2 = $_REQUEST[$qtytot];
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
        }*/

        $j=1;
                while($j<6)
        {
          $linetot="line_num" . $j;
          $qtytot="disp_qty" . $j;
          $grn_num="grnnum" . $j;
            $disp_updatetot="prev_qty".$j;
                    $disp_update2=$_REQUEST[$disp_updatetot];
              $linenumber2= $_REQUEST[$linetot];
                    $qty2 = $_REQUEST[$qtytot];
                  /*  $grn_num2=$_REQUEST[$grn_num];
                  $resultgrn=$newLI->getgrninfo4cons($grn_num2);
         while($myrow_grn=mysql_fetch_row($resultgrn))
        {
                 if($myrow_grn[13]!='' && $myrow_grn[13] !='-' && $myrow_grn[13]!='NA' && $myrow_grn[13]!=0)
                       {
                         $dimesion = " (".$myrow_grn[12]."X".$myrow_grn[13]."X".$myrow_grn[14].")".$dimesion;
                       }else
                       {
                         $dimesion = " (".$myrow_grn[12]."X".$myrow_grn[14].")".$dimesion;
                       }
                       $rmspec= $myrow_grn[6]." ".$dimesion." ".$myrow_grn[15];
                       echo $rmspec."--89898----";
        } */
                   // echo $qty2."---<br>";
          if ($linenumber2 != '')
          {
                       $qty_total = $qty2;
                       $dispUpdate = $disp_update2;

          }
          $j++;


        }
          $sql = "start transaction";
        $result = mysql_query($sql);
                $newDispatch->setrel_note($relnotenum);
          $newDispatch->setdisp_date($dispatch_date);
          $newDispatch->setdisp2cust($dispatch2cust);
          $newDispatch->setdispdesc($dispatchdesc);
          //$newPO->setwonum($wonum);
          $newDispatch->setvia($via);
                $newDispatch->setrefno($refno);
                $newDispatch->setcrn($crn);
                $newDispatch->setremarks($remarks);
                $newDispatch->setstatus($status);
          $newDispatch->setcreate_date($create_date);
          $newDispatch->setmod_date($mod_date);
          $newDispatch->setdelivery($delivery_to);
          $newDispatch->setinvoice($invoice_to);
                $newDispatch->setschdate($schdate);
                $newDispatch->setschqty($schqty);
        $newDispatch->settype($type);
        $newDispatch->setexpinvnum($expinvnum);
              //echo 'before dispatch'.$disprecnum;
        $newDispatch->updateDispatch($disprecnum);


        $flag=1;

              //echo 'after dispatch'.$disprecnum;
      }

      //$newLI->setponum($ponum);

            $newLI->setlink2dispatch($disprecnum);
      $newLI->setlinenum($linenumber1);
      $newLI->setwonum($wonum1);
      $newLI->setdnnum($dnnum1);
      $newLI->setsupplier_wonum($supplier_wonum1);
      $newLI->setpartnum($partnum1);
      $newLI->setwoqty($woqty1);
      $newLI->setcompqty($compqty1);
      $newLI->setgrnnum($grnnum1);
      $newLI->setcustpo_qty($custpoqty1);
        $newLI->setpartname($partname1);
            $newLI->setrmspec($rmspec1);
          $newLI->setdrgiss($drgiss1);
        $newLI->setpartiss($partiss1);
        $newLI->setcos($cos1);
        $newLI->setitemnum($itemnum1);
      $newLI->setcustpo_date($custpodate1);
      $newLI->setcustpo_num($custponum1);

      $newLI->setdisp_custpo_no($disp_custpo_no1);
      $newLI->setdisp_custpo_item($disp_custpo_item1);


      $newLI->setdisp_qty($dispatchqty1);
            $newLI->setBatchnum($batchnum1);
        $newLI->setpsn($psn1);

        $c = "C";
      $disp_number=$c.$disprecnum;
        //echo $disp_number."*-*-*--*";
        $result=$newLI->getgrninfo4cons($grnnum1);
            $result_grn=$newLI->getallgrn4consupdate($grnnum1);
            $resultcons=$newLI->getgrnmcofcdet4cons($grnnum1);
            $result_cons=$newLI->getgrnmcofcdet4cons($grnnum1);
             //echo $qty_total."**-*--*-*<br>";
          //$newLI->setamount($amount1);
          $wodqty=$newLI->getdispqty4update($wonum1);
          //echo $wodqty."---qty---".$dispatchqty1;
                if($status=='Cancelled')
                {
                   $finaldisp_qty= ($wodqty- $dispatchqty1);
                }else
                {
           /*echo "<br>wodqty is $wodqty";
           echo "<br>prevdqty is $prevdqty1";
           echo "<br>dispatchqty1 is $dispatchqty1";*/
           if ($wodqty != 0)
          {
                       $finaldisp_qty= ($wodqty-$prevdqty1) + $dispatchqty1;
          }
          else 
          {
            //echo "<br>in elzs ,.,,,,,dispatchqty1 is $dispatchqty1";
            $finaldisp_qty= $dispatchqty1;
                        
          }
          //echo "<br>dispatchqty1 is $dispatchqty1";
                }   

            $newLI->updateWo4dispqty($finaldisp_qty);

  

     
     

       if($prevlinenum1!='')
      {
        // echo "i am here updating";
        $newLI->updateLI($lirecnum1);

      }
      else
      {
        //echo "i am here adding";
         $newLI->setlink2dispatch($disprecnum);
         $newLI->addLI();
      }
       if( $type == 'Treated' )
              {

                $final_dispqty = ($totdispqty-$prevdqty1) + $dispatchqty1;
                
                $wodqty=$newLI->updatedispqty4dnli($supplier_wonum1,$dispatchqty1,$final_dispqty);
              }


          
        //echo mysql_num_rows($result)."----";
            if(mysql_num_rows($result) >0)
            {
        while($myrowgrn=mysql_fetch_row($result))
        {         //echo  $myrowgrn[2]."-----111--------";
              $myconsinfo=mysql_fetch_row($resultcons);
              $resrmmaster=$newconsumption->getallrmdetails($myrowgrn[11]);
              $myrmres=mysql_fetch_row($resrmmaster);

              $resultqtyrej=$newLI->getworej4cofc($grnnum1);
          $myqty_rej=mysql_fetch_row($resultqtyrej) ;
          $qtyrej = $myqty_rej[0];

          $disp_number="C".$disprecnum;

          $resinvdets=$newconsumption->getconsumptiondets4grn($myrowgrn[0]);
              $myinvdet=mysql_fetch_assoc($resinvdets) ;

              if(($myrmres[0] !='' && $myrmres[0] !='-'&& $myrmres[0] !='NA' && $myrmres[0] !='Not Applicable' )&& ($myrmres[1] !='' && $myrmres[1] !='-' && $myrmres[1] !='NA'&& $myrmres[1] !='Not Applicable'))
               {
                  $uom='Meters';//echo"HERE---";
               }
               else if(($myrmres[0] !='' && $myrmres[0] !='-'&& $myrmres[0] !='NA' && $myrmres[0] !='Not Applicable'))
               {
                  $uom='Meters'; //echo"HERE--1111-";
               }
               else if(($myrmres[1] !='' && $myrmres[1] !='-' && $myrmres[1] !='NA'&& $myrmres[1] !='Not Applicable') && ($myrmres[2] !='' && $myrmres[2] !='-' && $myrmres[2] !='NA'&& $myrmres[2] !='Not Applicable') && ($myrmres[3] !='' && $myrmres[3] !='-' && $myrmres[3] !='NA'&& $myrmres[3] !='Not Applicable'))
               {
                   $uom='NOS'; //echo"HERE--52222-";
               }
               while($myrow_grn=mysql_fetch_row($result_grn))
               {
                 if($prev_grn!=$myrow_grn[0])
                   {     //echo "HERE---";
                     if($myrow_grn[5]!='' && $myrow_grn[5] !='-' && $myrow_grn[5]!='NA' && $myrow_grn[5]!=0)
                       {
                         $dimension = " (".$myrow_grn[4]."X".$myrow_grn[5]."X".$myrow_grn[6].")";
                       }else
                       {
                         $dimension = " (".$myrow_grn[4]."X".$myrow_grn[6].")";
                       }
                       $qtygrn =$myrow_grn[1];
                       $qty_make = $myrow_grn[3];
                       $prev_grn=$myrow_grn[0] ;
                     }else
                     {  //echo "HERE----11----";
                       if($myrow_grn[5]!='' && $myrow_grn[5] !='-' && $myrow_grn[5]!='NA' && $myrow_grn[5]!=0)
                       {
                         $dimension = " (".$myrow_grn[4]."X".$myrow_grn[5]."X".$myrow_grn[6].")".$dimension;
                       }else
                       {
                         $dimension = " (".$myrow_grn[4]."X".$myrow_grn[6].")".$dimension;
                       }
                       $qtygrn +=$myrow_grn[1];
                       $qty_make += $myrow_grn[3];
                     }

                       $grn= $myrowgrn[0];
                       $rm_spec= $myrow_grn[8]." ".$dimension." ;".$myrow_grn[7];
                    }
                       //$grn= $myrowgrn[3];
                       //$rm_spec= $myrowgrn[6]." ".$dimension." ;".$myrowgrn[15];
                      // echo $rm_spec."----new---";
              if( $type !='Assembly'&& $type !='Kit')
              {
              if($myconsinfo[0]=='')
              {
                $newLI->addtoconsumption($myrowgrn[3],$myrowgrn[0],$myrowgrn[1],$qty_make,$dispatchqty1,$disp_number,$crn,$myrowgrn[4],$myrowgrn[5],$rm_spec,$myrowgrn[7],$myrowgrn[8],$uom,$qtygrn,$qtyrej,$myinvdet['bond_num'], $myinvdet['bonddate'],$myinvdet['be_num'], $myinvdet['bedate'], $myinvdet['assessval'], $myinvdet['cifval'], $myinvdet['dutyamt'], $myinvdet['invamt'],$myinvdet['currency'],$exp_invnum1);
              }
              else
              {
              //echo  $myrowgrn[2]."---2222----------";
               if($myconsinfo[1]=='')
              {
                 $newLI->updatetoconsumption($qty_make,$dispatchqty1,$disp_number,$crn,$myconsinfo[0],$myinvdet['bond_num'], $myinvdet['bonddate'],$myinvdet['be_num'], $myinvdet['bedate'], $myinvdet['assessval'], $myinvdet['cifval'], $myinvdet['dutyamt'], $myinvdet['invamt'],$myinvdet['currency'],$exp_invnum1);
                 $newLI->updatetoconsumptionrej($grnnum1,$qtyrej);
              }else
              {
               $cofcinfo=$newLI->getcofcnuminfo($grnnum1,$relnotenum);
               //echo mysql_num_rows($resultcons)."----";
               if(mysql_num_rows($cofcinfo)>0)
               {    //echo $myconsinfo[1]."--------".$disp_number ;
               while($mycons_info=mysql_fetch_row($result_cons))
               {
                  //echo "$mycons_info[1]---in ---the---loop---$disp_number<br>";
                   if($mycons_info[1]==$disp_number)
                 {
                   $dqty=$newLI->getdispqty4grn($grnnum1,$relnotenum);
                   //echo $qtyrej."-*-**-*IN-*-$myconsinfo[0]<br>";
                   $newLI->updatetoconsumption($qty_make,$dqty,$disp_number,$crn,$mycons_info[0],$myinvdet['bond_num'], $myinvdet['bonddate'],$myinvdet['be_num'], $myinvdet['bedate'], $myinvdet['assessval'], $myinvdet['cifval'], $myinvdet['dutyamt'], $myinvdet['invamt'],$myinvdet['currency'],$exp_invnum1);
                   $newLI->updatetoconsumptionrej($grnnum1,$qtyrej);

                 }

               }

               }
                else
                {  //echo $dispatchqty1."-*-*addd*-*454545-*-";
                $newLI->addtoconsumption($myrowgrn[3],$myrowgrn[0],$myrowgrn[1],$qty_make,$dispatchqty1,$disp_number,$crn,$myrowgrn[4],$myrowgrn[5],$rm_spec,$myrowgrn[7],$myrowgrn[8],$uom,$qtygrn,$qtyrej,$myinvdet['bond_num'], $myinvdet['bonddate'],$myinvdet['be_num'], $myinvdet['bedate'], $myinvdet['assessval'], $myinvdet['cifval'], $myinvdet['dutyamt'], $myinvdet['invamt'],$myinvdet['currency'],$exp_invnum1);

                }
               }
              }
             }
           }
         }
         else
         {
  if($type =='Assembly' || $type =='Kit')
  {    //echo $type."---===";
  
  $wodqty=$newLI->getdispqty4assyupdate($wonum1);
   // $finaldisp_qty= $wodqty + $dispatchqty1;
   //echo $wodqty."---qty---".$dispatchqty1."-------*-----".$prevdqty1."<br>";
    if($status=='Cancelled')
                {
                   $finaldisp_qty= ($wodqty-$dispatchqty1);
                }else
                {
                   $finaldisp_qty= ($wodqty-$prevdqty1) + $dispatchqty1;
                }
    $newLI->updateassyWo4dispqty($finaldisp_qty);
  if($type =='Assembly')
  {
   $resultwoassyli=$newconsumption->getwo4assyliwo($wonum1);
  }else if($type =='Kit')
  {
    $wonum4kit=$newLI->getwo4kitassyliwo($wonum1);
    $resultwoassyli=$newconsumption->getwo4assyliwo($wonum4kit);
  }
  //if($mywoassyli[1]=='Bought Out')
  //echo"$wonum4kit============$wonum1<br>";
   while($mywoassyli=mysql_fetch_row($resultwoassyli))
  {
    //echo $mywoassyli[1]."--type---<br>";
    if($mywoassyli[3]!="")
    {
      $resultgrn4wo=$newconsumption->getgrn4wo($mywoassyli[0]);
      $mygrn4wo=mysql_fetch_row($resultgrn4wo);
      $grn_num=$mygrn4wo[0];

    }
    else
    {
      $grn_num=$mywoassyli[0];

    }
    //echo $grn_num."-------GRNNUM---<br>";
    $result4assygrn=$newconsumption->getallgrn4assyconsupdate($grn_num);
    while($myrowgrn=mysql_fetch_row($result4assygrn))
  { //echo $myrowgrn[3]."------------<br>";
   $grnnum=trim($myrowgrn[3]);
   $resultqtyrej=$newconsumption->getworej4consupdate($myrowgrn[3]);
   $myrejqty=mysql_fetch_row($resultqtyrej);
   $resrmmaster=$newconsumption->getallrmdetails($myrowgrn[9]);
   $myrmres=mysql_fetch_row($resrmmaster);
   $resinvdets=$newconsumption->getconsumptiondets4grn($myrowgrn[0]);
   $myinvdet=mysql_fetch_assoc($resinvdets) ;

            if(($myrmres[0] !='' && $myrmres[0] !='-'&& $myrmres[0] !='NA' && $myrmres[0] !='Not Applicable' )&& ($myrmres[1] !='' && $myrmres[1] !='-' && $myrmres[1] !='NA'&& $myrmres[1] !='Not Applicable'))
               {
                  $uom='Meters';//echo"HERE---";
               }
               else if(($myrmres[0] !='' && $myrmres[0] !='-'&& $myrmres[0] !='NA' && $myrmres[0] !='Not Applicable'))
               {
                  $uom='Meters'; //echo"HERE--1111-";
               }
               else if(($myrmres[1] !='' && $myrmres[1] !='-' && $myrmres[1] !='NA'&& $myrmres[1] !='Not Applicable') && ($myrmres[2] !='' && $myrmres[2] !='-' && $myrmres[2] !='NA'&& $myrmres[2] !='Not Applicable') && ($myrmres[3] !='' && $myrmres[3] !='-' && $myrmres[3] !='NA'&& $myrmres[3] !='Not Applicable'))
               {
                   $uom='NOS'; //echo"HERE--52222-";
               }
               //echo $prev_grn."--***---".$myrowgrn[3];
                    if($prev_grn!=$myrowgrn[3])
                   {    // echo "HERE---";
                     if($myrowgrn[12]!='' && $myrowgrn[12] !='-' && $myrowgrn[12]!='NA' && $myrowgrn[12]!=0)
                       {
                         $dimension = " (".$myrowgrn[11]."X".$myrowgrn[12]."X".$myrowgrn[13].")";
                       }else
                       {
                         $dimension = " (".$myrowgrn[11]."X".$myrowgrn[13].")";
                       }
                       $qty =$myrowgrn[10];
                       $qty_make = $myrowgrn[2];
                       $prev_grn=$myrowgrn[3] ;
                       $qty_rej =$myrejqty[0];
                      // $qty_rework=($myrejqty[1]+$myrejqty[2]);
                     }else
                     {  //echo "HERE----11----";
                       if($myrowgrn[12]!='' && $myrowgrn[12] !='-' && $myrowgrn[12]!='NA' && $myrowgrn[12]!=0)
                       {
                         $dimension = " (".$myrowgrn[11]."X".$myrowgrn[12]."X".$myrowgrn[13].")".$dimension;
                       }else
                       {
                         $dimension = " (".$myrowgrn[11]."X".$myrowgrn[13].")".$dimension;
                       }
                       $qty +=$myrowgrn[10];
                       $qty_make += $myrowgrn[2];
                       //$qty_rej +=$myrejqty[0];
                     }

                       $grn= $myrowgrn[0];
                       $rmspec= $myrowgrn[6]." ".$dimension." ;".$myrowgrn[14];
//$newLI->addtoconsumption($myrowgrn[3],$myrowgrn[0],$myrowgrn[1],$qty_make,$dispatchqty1,$disp_number,$crn,$myrowgrn[4],$myrowgrn[5],$rm_spec,$myrowgrn[7],$myrowgrn[8],$uom,$qtygrn,$qtyrej,$myinvdet['bond_num'], $myinvdet['bonddate'],$myinvdet['be_num'], $myinvdet['bedate'], $myinvdet['assessval'], $myinvdet['cifval'], $myinvdet['dutyamt'], $myinvdet['invamt'],$myinvdet['currency']);
 //echo $wonum1."---";
$resultdn=$newconsumption->getdispatchassy4update($wonum1);


  while($mydnrow=mysql_fetch_row($resultdn))
  {
                 $c="C";
                 $result_cons=$newLI->getgrnmcofcdet4cons($grnnum);
                 $disp_recnum=$c.$mydnrow[0];
                 $resultcons=$newLI->getgrnmcofcdet4cons($grnnum);
                 $myconsinfo=mysql_fetch_row($resultcons);
                 //echo "H---E---R---E---$qty_rej<br>";
              if($myconsinfo[0]=='')
              {
                $newLI->addtoconsumption($myrowgrn[3],$myrowgrn[0],$myrowgrn[1],$qty_make,$dispatchqty1,$disp_recnum,$crn,$myrowgrn[4],$myrowgrn[5],$rm_spec,$myrowgrn[7],$myrowgrn[8],$uom,$qtygrn,$qtyrej,$myinvdet['bond_num'], $myinvdet['bonddate'],$myinvdet['be_num'], $myinvdet['bedate'], $myinvdet['assessval'], $myinvdet['cifval'], $myinvdet['dutyamt'], $myinvdet['invamt'],$myinvdet['currency'],$exp_invnum1);
              }
              else
              {
                if($myconsinfo[1]=='')
                {       //echo"<br>HERE-----".$myrowgrn[10]."-*-**-*--*".$myconsinfo[0];
                   $newLI->updatetoconsumption($qty_make,$dispatchqty1,$disp_recnum,$crn,$myconsinfo[0],$myinvdet['bond_num'], $myinvdet['bonddate'],$myinvdet['be_num'], $myinvdet['bedate'], $myinvdet['assessval'], $myinvdet['cifval'], $myinvdet['dutyamt'], $myinvdet['invamt'],$myinvdet['currency'],$exp_invnum1);
                   $newLI->updatetoconsumptionrej($grnnum,$qty_rej);
                }
                else
                 {
          //echo "<br>In else$grnnum<br>";
                   $cofcinfo=$newLI->getcofcnuminfo($grnnum,$disp_recnum);
                  // echo mysql_num_rows($resultcons)."----";
                   if(mysql_num_rows($cofcinfo)>0)
                   {
            //echo "---222-----".$disp_recnum."<br>" ;
                      while($mycons_info=mysql_fetch_row($result_cons))
                      {
                         //echo "<br>$grnnum---in ---the---loop---$disp_recnum------<br>";
                          if($mycons_info[1]==$disp_recnum)
                          {
                            $dqty=$newLI->getdispqty4wo($wonum1,$disp_recnum);
                            //echo $dqty."-*-**-*IN-*-$myconsinfo[0]<br>";
                           $newLI->updatetoconsumption($qty_make,$dqty,$disp_recnum,$crn,$mycons_info[0],$myinvdet['bond_num'], $myinvdet['bonddate'],$myinvdet['be_num'], $myinvdet['bedate'], $myinvdet['assessval'], $myinvdet['cifval'], $myinvdet['dutyamt'], $myinvdet['invamt'],$myinvdet['currency'],$exp_invnum1);
                           $newLI->updatetoconsumptionrej($grnnum,$qty_rej);
                           }

                          /* else if($mycons_info[1]!=$disp_recnum)
                           { echo"HERE---in delete";
                            $newconsumption->deletefromconsumption($mycons_info[1],$grnnum);

                           }*/
                       }

                    }
                   else
                    {    //echo"HERE--new--";
               $newLI->addtoconsumption($myrowgrn[3],$myrowgrn[0],$myrowgrn[1],$qty_make,$dispatchqty1,$disp_recnum,$crn,$myrowgrn[4],$myrowgrn[5],$rm_spec,$myrowgrn[7],$myrowgrn[8],$uom,$qtygrn,$qty_rej,$myinvdet['bond_num'], $myinvdet['bonddate'],$myinvdet['be_num'], $myinvdet['bedate'], $myinvdet['assessval'], $myinvdet['cifval'], $myinvdet['dutyamt'], $myinvdet['invamt'],$myinvdet['currency'],$exp_invnum1);

                    }
                  }
            }

      }

    }

  }
 }
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
  //echo '---abc----';
   $sql = "commit";
   $result = mysql_query($sql);
   if(!$result)
   {
     $sql = "rollback";
     $result = mysql_query($sql);
     die("Commit failed Dispatch Insert..Please report to Sysadmin. " . mysql_errno());
   }
$i++;
}

    //echo $i.'abc2222'.$max;

}
//echo $dispUpdate."-----<br>";
// $newLI->upddelsch($crn,$schdate,$totdispqty,$dispUpdate,$pagename);
if($pagename == 'newdispatch')
{
$newLI->upddelsch($crn,$schdate,$totdispqty,$dispUpdate,$pagename);
}
header("Location:dispatchSummary.php" );

?>
