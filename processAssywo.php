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
if ( !isset ( $_SESSION['user'] ) )
{
  header ("Location:login.php");
}

$userid = $_SESSION['user'];
$pagename = $_REQUEST['pagename'];

include('classes/assywoClass.php');
include('classes/assywo_flowClass.php');
include('classes/assywoliClass.php');
include('classes/assywoli_operClass.php');
include('classes/fairClass.php');
include('classes/assyProcessDetailsClass.php');

$assywo = new assywo;
$assywo_flow = new assywo_flow;
$assywo_li = new assywo_li;
$assywo_oper = new assywo_oper;
$newfair = new fair;
$newassyprodets = new assywoprocessdetails;


if ($pagename == 'new_assywo' || $pagename == 'edit_assywo') 
{

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
   
}


if ($pagename == 'new_assywo') 
{
  $i=1;
  $j=1;

  $max_li=$_REQUEST['index'];
  $max_oper_li=$_REQUEST['index_oper'];
  $max_process_det=$_REQUEST['index_pdets'];
  $flag=0;

  $newlogin = new userlogin;
  $newlogin->dbconnect();
  //$assywo->setassywonum($assy_wonum);
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
    }
    else if($myrow_rev[0] ==0 || $myrow_rev[0] =='')
    {
      $revmatch= $myrow_rev[1];
    }

    // to check if an entry exists for that crn and revnumber($rev4fair---selected) in fair table.

    $result_type = $newfair->get_prev_fair_details_new($crn,$rev4fair);
    $myrow_fair = mysql_fetch_row($result_type);

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
//end fair check

  $assywo->setfai_type($type);
  $assywo->settype_remarks($type_remarks);
  $assyworecnum = $assywo->addAssywo();

  $assywonum = str_pad($assyworecnum, 5, '0', STR_PAD_LEFT);
  
  if($assy_type != 'Kit')
    $assywonum='A'.$assywonum;
  else
    $assywonum='K'.$assywonum;

  if($fair_flag == 1)
  {
    $newfair->setcrn($crn);
    $newfair->setwo($assywonum);
    $newfair->setwodate($wo_date);
    $newfair->settype($type);
    $newfair->setmpsrev($rev4fair);
    $newfair->setlink2wo($assyworecnum);
    $newfair->addFair();
  }


  include("interassyprocess.php");

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

    $wpsrecnum="wpsrecnum" . $i;
    $cofc_num="cofc_num" . $i;
    $supplier_wo="supplier_wo" . $i;
    $qtyused_assy="qtyused_assy" . $i;
    $dnrecnum="dnrecnum" . $i;
    $avail_qty="avail_qty" . $i;

    $rmponum_li="rmponum_li" . $i;
    $rmponum_linum="rmponum_linum" . $i;
    $cost_li="cost_li" . $i;
    $ncrnum_li="ncrnum_li" . $i;



    $worecnum=$_REQUEST[$wpsrecnum];
    $cofc_num=$_REQUEST[$cofc_num];
    $supplier_wo=$_REQUEST[$supplier_wo];
    $qtyused_assy=$_REQUEST[$qtyused_assy]; 
    // $nc_num=$_REQUEST[$nc_num];

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
    $dnrecnum1= $_REQUEST[$dnrecnum];
    $avail_qty1=$_REQUEST[$avail_qty];
    $rmponum_li1=$_REQUEST[$rmponum_li];
    $rmponum_linum1=$_REQUEST[$rmponum_linum];
    $cost_li1=$_REQUEST[$cost_li];
    $ncrnum_li1=$_REQUEST[$ncrnum_li];
    // $nc_num1= $_REQUEST[$nc_num];


    if ($line_num1 != ''|| ($line_num1 == ''&& $pcrn_num1!= ''))
    {  
      if ($pagename == 'new_assywo')
      {

        $line_num1 = $assywonum.'-'.$line_num1;
        $qtyused_assy1=$qtyused_assy+$qty_wo1;

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
        $assywo_li->setrmponum($rmponum_li1);
        $assywo_li->setrmpo_linenum($rmponum_linum1);
        $assywo_li->setrmpocost($cost_li1);
        $assywo_li->setncrnum_li($ncrnum_li1);
        $assywo_li->setcofc_num($cofc_num);
        $assywo_li->setsupplier_wo($supplier_wo);
        
        $assywo_li->addAssywo_li($cust_ponum);

        $assywo_li->setworecnum($worecnum);
        
        // $assywo_li->setnc_num($nc_num1);

        if($assy_type=='Kit')
        {
          if($bom_type1  == 'Sub Assembly')
          {
            $qty4mwo= $assywo_li->getassyqty4kitwo($grn1);
            $fqty=$qty4mwo+$qty_wo1;
            $assywo_li->updateassywork_order($grn1,$fqty);
          }

          if($bom_type1 == 'Non Assembly')
          {
            if($crn_type1  == 'Untreated')
            {
              $qty4mwo= $assywo_li->getassyqty4wo($grn1);
              $fqty=$qty4mwo+$qty_wo1;
              $assywo_li->updatework_order($grn1,$assywonum,$fqty);  
            }       

            if($crn_type1  == 'Treated')
            {
              $qty4mwo= $assywo_li->getassyqty4dn($dnrecnum1);
              $fqty=$qty4mwo+$qty_wo1;
              $assywo_li->updatedelivery_note($dnrecnum1,$assywonum,$fqty);  
            }

          } 

          if($bom_type1  == 'Bought Out')
          {
            $wogrnqty = $assywo_li->getgrnwoqty($grn1);
            $wousdqty=$wogrnqty+$qty_wo1;
            $assywo_li->updateqtyused_grn($wousdqty);
            $qtm = $assywo_li->getqtm4grnissassy($grn1);
            $clbal = ($qtm-$wogrnqty)-$qty_wo1;
            $assywo_li->addgrnIss4assywo($assywonum,$clbal,$avail_qty1);
          }
        }
        else if($assy_type != 'Rework')
        {  
          if($bom_type1 == 'Non Assembly')
          {
            if($crn_type1  == 'Untreated')
            {     
              $qty4mwo= $assywo_li->getassyqty4wo($grn1);
              $fqty=$qty4mwo+$qty_wo1;
              $assywo_li->updatework_order($grn1,$assywonum,$fqty);        
            }
                       
            if($crn_type1  == 'Treated')
            {
              $qty4mwo= $assywo_li->getassyqty4dn($dnrecnum1);
              $fqty=$qty4mwo+$qty_wo1;
              $assywo_li->updatedelivery_note($dnrecnum1,$assywonum,$fqty);  

            } 

          }  

          if($bom_type1  == 'Bought Out')
          {
            $wogrnqty = $assywo_li->getgrnwoqty($grn1);
            $wousdqty=$wogrnqty+$qty_wo1;
            $assywo_li->updateqtyused_grn($wousdqty);
            $qtm = $assywo_li->getqtm4grnissassy($grn1);
            $clbal = ($qtm-$wogrnqty)-$qty_wo1;
            $assywo_li->addgrnIss4assywo($assywonum,$clbal,$avail_qty1);
          }

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
      if ($pagename == 'new_assywo')
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
      if ($pagename == 'new_assywo')
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

  $k = 1;
  $wfcnt = $_REQUEST['wfcnt'];

  while($k <= $wfcnt)
  {
    $dates="dates" . $k;
    $est="est" . $k;
    $chknm="ckbo".$k;
    $dependency="dependency" . $k;
    $stagename="stagename" . $k;
    $stagenum="stagenum" . $k;
    $dept="dept" . $k;
    $secs_respose="secs_respose" . $k;
    $process="process" . $k;
    $when_process="when_process" . $k;
    $email="email" . $k;
    $primary_respose="primary_respose" . $k;
    $link2wfconfig="link2wfconfig" . $k;

    if(isset($_REQUEST[$chknm]))
    {
      $dateval = $_REQUEST[$dates];
      $dependency1 = $_REQUEST[$dependency];
      $stagename1 = $_REQUEST[$stagename];
      $stagenum1 = $_REQUEST[$stagenum];
      $dept1 = $_REQUEST[$dept];

      $secs_respose1 = $_REQUEST[$secs_respose];
      $process1 = $_REQUEST[$process];
      $when_process1 = $_REQUEST[$when_process];
      $email_list11 = $_REQUEST[$email];
      $primary_respose1 = $_REQUEST[$primary_respose];
      $link2wfconfig1 = $_REQUEST[$link2wfconfig];

      // echo "<pre>";
      // print_r($wfcnt);

      $assywo_flow->setschdue($dateval);
      $assywo_flow->setlink2contact('NULL');
      $assywo_flow->setdependency($dependency1);
      $assywo_flow->setstagename($stagename1);
      $assywo_flow->setstagenum($stagenum1);
      $assywo_flow->setdept($dept1);
      $assywo_flow->setlink2wfconfig($link2wfconfig1);
      $assywo_flow->setsec_respose($secs_respose1);
      $assywo_flow->setprocess($process1);
      $assywo_flow->setwhen_process($when_process1);
      $assywo_flow->setemaillist($email_list1);
      $assywo_flow->setprimary_respose($primary_respose1);
      $assywo_flow->setdoctype('WO');
      
      $assywo_flow->addassywo_flow($assyworecnum);

    }

$k++;
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

if ($pagename == 'edit_assywo')
{
  $assy_wonum = $_REQUEST['assy_wonum'];
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
  
  $notes = $_REQUEST['notes'];


  if (!empty($notes)) {
    $assywo->AddNotes4Assywo($assyworecnum, $notes);
    echo "notes $notes ";
  
  }

  $flag=1;
  include("interassyprocess.php");

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
    $prevlinenum="prev_line_num" . $i;
    $lirecnum="lirecnum" . $i;
    $qty_ret="qty_ret" . $i;
    $qty_acc="qty_acc" . $i;
    $pcrn_num="pcrn_num" . $i;
    $crn_type="crn_type" . $i;
    $prev_qty_wo="prev_qty_wo" . $i;
    $prev_qty_ret="prev_qty_ret" . $i;
    $prev_qty_rew="prev_qty_rew" . $i;
    $prev_qty_rej="prev_qty_rej" . $i;

    $wpsrecnum="wpsrecnum" . $i;
    $cofc_num="cofc_num" . $i;
    $supplier_wo="supplier_wo" . $i;
    $qtyused_assy="qtyused_assy" . $i;
    $dnrecnum="dnrecnum" . $i;
    $avail_qty="avail_qty" . $i;

    $rmponum_li="rmponum_li" . $i;
    $rmponum_linum="rmponum_linum" . $i;
    $cost_li="cost_li" . $i;

    $qainsp_app = "qainsp_app". $i;
    $qainsp_appdate = "qainsp_appdate". $i;
    $qainsp_appby = "qainsp_appby". $i;

    $worecnum=$_REQUEST[$wpsrecnum];
    $cofc_num=$_REQUEST[$cofc_num];
    $supplier_wo=$_REQUEST[$supplier_wo];
    $qtyused_assy=$_REQUEST[$qtyused_assy];

    $prevlinenum1=$_REQUEST[$prevlinenum];
    $lirecnum1=$_REQUEST[$lirecnum];

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
    $prev_qty_wo1= $_REQUEST[$prev_qty_wo];
    $prev_qty_ret1= $_REQUEST[$prev_qty_ret];
    $prev_qty_rew1= $_REQUEST[$prev_qty_rew];
    $prev_qty_rej1= $_REQUEST[$prev_qty_rej];
    $dnrecnum1= $_REQUEST[$dnrecnum];
    $avail_qty1= $_REQUEST[$avail_qty];

    $rmponum_li1=$_REQUEST[$rmponum_li];
    $rmponum_linum1=$_REQUEST[$rmponum_linum];
    $cost_li1=$_REQUEST[$cost_li];

    $qainsp_app1=$_REQUEST[$qainsp_app];

    if ($qainsp_app1 == 'yes') {
      
      $qainsp_app1=$_REQUEST[$qainsp_app];
      $qainsp_appdate1=$_REQUEST[$qainsp_appdate];
      $qainsp_appby1=$_REQUEST[$qainsp_appby];
    }
    else
    {
      $qainsp_app1 = "";
      $qainsp_appdate1="";
      $qainsp_appby1="";
    }


    $newlogin = new userlogin;
    $newlogin->dbconnect();

    if ($line_num1 != ''|| ($line_num1 == ''&& $pcrn_num1!= ''))
    {
      if($assy_type=='Kit')
      {
        //kit qty
        $qty4mwo= $assywo_li->getassyqty4kitwo($grn1);
      }
      else
      {
        //assy_Qty
        $qty4mwo= $assywo_li->getassyqty4wo($grn1);
        $qty4wps= $assywo_li->getassyqty4wps($worecnum);
      }

      //sum of qty_wo  
      $totqty4wo0 =$assywo_li->getassy_qty4wo($grn1);
      $totqty4wo1=$assywo_li->getassy_qty4woret($grn1);
      $totqty4wo2=$assywo_li->getassy_qty4worew($grn1);
      $totqty4wo3=$assywo_li->getassy_qty4worej($grn1);

      $totqty4wo = $totqty4wo0 - $totqty4wo1 - $totqty4wo2 - $totqty4wo3 ;
      $fqty=0;

      if($status=='Cancelled')
      {
        if($qty4mwo!=0)
        {
          $fqty=$qty4mwo-$qty_wo1;        
        }
        else
        {
          $fqty=$totqty4wo-$qty_wo1;
        }
      }
      else
      {
        if($qty4mwo!=0)
        {
          $fqty=$qty4mwo-$prev_qty_wo1+$qty_wo1 + $prev_qty_ret1 - $qty_ret1 + $prev_qty_rew1 - $qty_rew1 + $prev_qty_rej1 - $qty_rej1;
        }
        else
        {
          $fqty=$totqty4wo-$prev_qty_wo1+$qty_wo1+$prev_qty_ret1-$qty_ret1 +$prev_qty_rew1-$qty_rew1 + $prev_qty_rej1 - $qty_rej1 ;
        }          
            
      }  


      if($qty4wps != 0) 
      {      
        $qtyused_assy1=$qty4wps-$prev_qty_wo1+$qty_wo1;  
      }
      else
      {         
        $qtyused_assy1=$qty_wo1;
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
      $assywo_li->setworecnum($worecnum);
      $assywo_li->setcofc_num($cofc_num);
      $assywo_li->setsupplier_wo($supplier_wo);
      $assywo_li->setworecnum($worecnum);
      $assywo_li->setcofc_num($cofc_num);
      $assywo_li->setsupplier_wo($supplier_wo);

      $assywo_li->setrmponum($rmponum_li1);
      $assywo_li->setrmpo_linenum($rmponum_linum1);
      $assywo_li->setrmpocost($cost_li1);

      $assywo_li->setqainsp_app($qainsp_app1);
      $assywo_li->setqainsp_appdate($qainsp_appdate1);
      $assywo_li->setqainsp_appby($qainsp_appby1);

      if($status == 'Cancelled' && $bom_type1 == 'Bought Out')
      {
        $clbal=$assywo_li->getgrnIssue4assywo($assy_wonum);
        $assywo_li->addgrniss4cancel($clbal,$assy_wonum,$status);
      }

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
        if($bom_type1  == 'Sub Assembly')
        {
          $assywo_li->updateassywork_order($grn1,$fqty);
          
          if($qty_rej1 !='' || $qty_rej !='0')
          {
            $rejqty = $totqty4wo3- $prev_qty_rej1 + $qty_rej1  ;
            $assywo_li->updaterejqtyfromassywo($grn1,$rejqty);
          }
        }
        if($bom_type1 == 'Non Assembly')
        {
          if($crn_type1  == 'Untreated')
          {
            $assywo_li->updatework_order($grn1,$assywonum,$fqty);
          }
          if($crn_type1  == 'Treated')
          {
            $assywo_li->updatedelivery_note($dnrecnum1,$assywonum,$fqty);  
          }  
        }
        if($bom_type1  == 'Bought Out')
        {
          $assywo_li->updategrn4woqty($fqty,$grn1);
        }

        if($bom_type1  == 'Bought Out' && ($qty_ret1 !='' || $qty_ret1 !='0'))
        {
          $retqty = $totqty4wo1- $prev_qty_ret1 + $qty_ret1  ;
          $assywo_li->updateretqtyfromgrn($grn1,$retqty);
        }

        if($bom_type1 == 'Non Assembly')
        {            

          if(($qty_rew1 != '' && $qty_rew1 !='0'))
          {
            if($crn_type1  == 'Untreated')
            {
              $rewqty = $totqty4wo2 - $prev_qty_rew1 + $qty_rew1  ;
              $assywo_li->updaterewqtyforwo($grn1,$rewqty);
            }
            if($crn_type1  == 'Treated')
            {
              $rewqty = $totqty4wo2 - $prev_qty_rew1 + $qty_rew1  ;
              $assywo_li->updaterewqtyfordn($dnrecnum1,$rewqty)  ;
            }
          }    
        }
        if($qty_rej1 != '' && $qty_rej1 !='0')
        {
          if($bom_type1 == 'Non Assembly')
          {
            if($crn_type1  == 'Untreated')
            {
              $rejqty = $totqty4wo3 - $prev_qty_rej1 + $qty_rej1  ;
              $assywo_li->updaterejqtyforwo($grn1,$rejqty)  ;
            }
            if($crn_type1  == 'Treated')
            {
              $rejqty = $totqty4wo3 - $prev_qty_rej1 + $qty_rej1  ;
              $assywo_li->updaterejqtyfordn($dnrecnum1,$rejqty)  ;
            }
          }
            
          if($bom_type1  == 'Bought Out')
          {
            $rejqty1 = $totqty4wo3 - $prev_qty_rej1 + $qty_rej1  ;
            $assywo_li->updaterejqtyforbo($grn1,$rejqty1)  ;
          }       
        }
      }
      else 
      {  

        if($bom_type1 == 'Non Assembly')
        {           
          if($crn_type1  == 'Untreated')
          {
            $assywo_li->updatework_order($grn1,$assywonum,$fqty);
            //rework quantity
            $rewqty = $totqty4wo2 - $prev_qty_rew1 + $qty_rew1  ;
            $assywo_li->updaterewqtyforwo($grn1,$rewqty)  ;
          }
          if($crn_type1  == 'Treated')
          {
            $assywo_li->updatedelivery_note($dnrecnum1,$assywonum,$fqty); 
            //rework quantity
            $rewqty = $totqty4wo2 - $prev_qty_rew1 + $qty_rew1  ;
            $assywo_li->updaterewqtyfordn($dnrecnum1,$rewqty)  ;
          }
        }
             
        if($bom_type1  == 'Bought Out')
        {               
          $wousdty4=$totqty4wo1 -$prev_qty_ret1 + $qty_ret1  ;
          $assywo_li->updateretqtyfromgrn($grn1,$wousdty4) ;
        }

        if($qty_rej1 != '' && $qty_rej1 !='0')
        {
          if($bom_type1 == 'Non Assembly')
          {    
            if($crn_type1  == 'Untreated')
            {
              $rejqty = $totqty4wo3 - $prev_qty_rej1 + $qty_rej1  ;
              $assywo_li->updaterejqtyforwo($grn1,$rejqty)  ;
            }
            if($crn_type1  == 'Treated')
            {
              $rejqty = $totqty4wo3 - $prev_qty_rej1 + $qty_rej1  ;
              $assywo_li->updaterejqtyfordn($dnrecnum1,$rejqty)  ;
            }
          }

          if($bom_type1  == 'Bought Out')
          {
            $rejqty1 = $totqty4wo3 - $prev_qty_rej1 + $qty_rej1  ;
            $assywo_li->updaterejqtyforbo($grn1,$rejqty1)  ;
          }                
        }

        if($qty_ret1 != '' && $qty_ret1 !='0')
        {
          if($bom_type1 == 'Non Assembly')
          {
            if($crn_type1  == 'Untreated')
            {
              $retqty = $totqty4wo1 - $prev_qty_ret1 + $qty_ret1  ;
              $assywo_li->updateretqtyforwo($grn1,$retqty)  ;
            }
            if($crn_type1  == 'Treated')
            {
              $retqty = $totqty4wo1 - $prev_qty_ret1 + $qty_ret1  ;
              $assywo_li->updateretqtyfordn($dnrecnum1,$retqty)  ;
            }
          }

          if($bom_type1  == 'Bought Out')
          {
            $retqty1 = $totqty4wo1 - $prev_qty_ret1 + $qty_ret1  ;
            $assywo_li->updateretqtyfromgrn($grn1,$retqty1)  ;
          }                
        }

        $grn_prev="grn_prev" . $i;
        $grn_prev1=$_REQUEST[$grn_prev];

        if($grn_prev1 != $grn1)
        {
          $wogrnqty4new  = $assywo_li->getgrnwoqty($grn1);
          $wogrnqty4prev = $assywo_li->getgrnwoqty($grn_prev1);
          if($wogrnqty4new!=0 && $wogrnqty4new!="")
          {
            $wousdqty4new=$wogrnqty4new+$fqty;
          }
          
          if($wogrnqty4prev!=0 && $wogrnqty4prev!="")
          {
            $wousdqty4prev=$wogrnqty4prev-$fqty;
          }
          else
          {
            $grnqtyused4new= $assywo_li->getwoqty4grn($grn1);
            $grnqtyused4prev= $assywo_li->getwoqty4grn($grn_prev1);

            $wousdqty4new=$grnqtyused4new+$fqty;
            $wousdqty4prev=$grnqtyused4prev-$fqty;
          }
          $assywo_li->updategrn4woqty($wousdqty4new,$grn1);
          $assywo_li->updategrn4woqty($wousdqty4prev,$grn_prev1);
        }
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

  while($j<=$max_oper_li)
  {
  
    $oppn_num="oppn_num" . $j;
    $stn_num="stn_num" . $j;
    $operation_descr="operation_descr" . $j;
    $sign="sign" . $j;
    $remarks="remarks_oper" . $j;
    $prevlinenum_oper="prev_line_num_oper" . $j;
    $lirecnum_oper="lirecnum_oper" . $j;

    $oppn_num1= $_REQUEST[$oppn_num];
    $stn_num1 = $_REQUEST[$stn_num];
    $operation_descr1 = $_REQUEST[$operation_descr];
    $sign1 = $_REQUEST[$sign];
    $remarks1 = $_REQUEST[$remarks];
    $prevlinenum1_oper=$_REQUEST[$prevlinenum_oper];
    $lirecnum1_oper=$_REQUEST[$lirecnum_oper];
    
    $newlogin = new userlogin;
    $newlogin->dbconnect();

    if ($oppn_num1 != '')
    {

      $assywo_oper->setopnnum($oppn_num1);
      $assywo_oper->setstn($stn_num1);
      $assywo_oper->setoperation($operation_descr1);
      $assywo_oper->setsignoff($sign1);
      $assywo_oper->setremarks($remarks1);
      $assywo_oper->setlink2assywo($assyworecnum);

      if($prevlinenum1_oper != '')
      {
        $assywo_oper->updateAssywo_oper($lirecnum1_oper);
      }
      else
      {
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

  while($m<=$max_process_det)
  {
  
    $seqnumber="seqnumber" . $m;
    $process="process" . $m;
    $st_date_time="st_date_time" . $m;
    $end_date_time="end_date_time" . $m;
    $remarks_pdets="remarks_pdets" . $m;
    $prevlinenum_prdet="prevlinenum_prdet" . $m;
    $linerecnum_prdet="linerecnum_prdet" . $m;


    $seqnumber1= $_REQUEST[$seqnumber];
    $process1 = $_REQUEST[$process];
    $st_date_time1 = $_REQUEST[$st_date_time];
    $end_date_time1 = $_REQUEST[$end_date_time];
    $remarks_pdets1 = $_REQUEST[$remarks_pdets];
    $prevlinenum_prdet1=$_REQUEST[$prevlinenum_prdet];
    $linerecnum_prdet1=$_REQUEST[$linerecnum_prdet];

    $newlogin = new userlogin;
    $newlogin->dbconnect();

    if ($seqnumber1 != '')
    {
      $newassyprodets->setseqnumber($seqnumber1);
      $newassyprodets->setprocess($process1);
      $newassyprodets->setst_date_time($st_date_time1);
      $newassyprodets->setend_date_time($end_date_time1);
      $newassyprodets->setremarks_pdets($remarks_pdets1);
      $newassyprodets->setlink2assywo($assyworecnum);

      if($prevlinenum_prdet1 != '')
      {
        $newassyprodets->updateAssywo_processdets($linerecnum_prdet1);
      }
      else
      {
        
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
