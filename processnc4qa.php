<?php
//
//==============================================
// Author: FSI                                 =
// Date-written =July 5, 2005                  =
// Filename: processQuoteGeneric.php           =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 WMS                          =
//==============================================

session_start();
header("Cache-control: private");

$pagename = $_SESSION['pagename'];
$action = $_REQUEST['action'];

include_once('classes/loginClass.php');
include('classes/nc4qaclass.php');
include('classes/inClass.php');

// Next, create an instance of the classes required

//$newQGen= new genericQuote;
$newqa = new nc4qa;
$wo_p = new in;

// Get all fields related to quote general info

$userid = $_SESSION['user'];

$refnum=$_REQUEST['refnum'];
$customer=$_REQUEST['customer'];
$partname=$_REQUEST['partname'];
$bachnum=$_REQUEST['bachnum'];
$partnum=$_REQUEST['partnum'];
$matl_spec=$_REQUEST['matl_spec'];
$issues_ps=$_REQUEST['issues_ps'];
$qty=$_REQUEST['qty'];
$ponum=$_REQUEST['ponum'];
$part_sl_num=$_REQUEST['part_sl_num'];
$wonum=$_REQUEST['wonum'];
$dcnum=$_REQUEST['dcnum'];
$dcdate=$_REQUEST['dcdate'];
$traceability_recnum=$_REQUEST['traceability_recnum'];
$dim_deviation=$_REQUEST['dim_deviation'];
$man=$_REQUEST['man'];
$inprocess=$_REQUEST['inprocess'];
$mat_deviation=$_REQUEST['mat_deviation'];
$machine=$_REQUEST['machine'];
$final_insp=$_REQUEST['final_insp'];
$other_deviation=$_REQUEST['other_deviation'];
$method=$_REQUEST['method'];
$cust_end=$_REQUEST['cust_end'];
$description=$_REQUEST['description'];
$root_cause=$_REQUEST['root_cause'];
$corrective_action=$_REQUEST['corrective_action'];
$preventive_action=$_REQUEST['preventive_action'];
$effectiveness=$_REQUEST['effectiveness'];
$cofcnum=$_REQUEST['cofcnum'];
$supername=$_REQUEST['sup_name'];
$opername=$_REQUEST['op_name1'];
$custncno=$_REQUEST['cust_ncno'];
$custncdate=$_REQUEST['cust_ncdate'];
$remarks=$_REQUEST['remarks'];
$rm_cost=$_REQUEST['rm_cost'];
$currency=$_REQUEST['currency'];
$create_date = date('Y-m-d');
$action = $_REQUEST['action'];
$stat = $_REQUEST['status'];
$accepted=$_REQUEST['accepted'];
$rejected=$_REQUEST['rejected'];
$quarantined=$_REQUEST['quarantined'];
$rework=$_REQUEST['rework'];

$source1=$_REQUEST['source1'];

$wotype=$_REQUEST['wotype'];
$dnnum=$_REQUEST['dnnum'];
$stagenum=$_REQUEST['stagenum'];
$mc_name=$_REQUEST['mc_name1'];
$created_by=$_REQUEST['created_by'];
// Database Connect
//echo $accepted."******".$rejected."--------".$quarantined;
$newlogin = new userlogin;
$newlogin->dbconnect();



if ($pagename == 'new_nc4qa' )
{
  $newlogin = new userlogin;
  $newlogin->dbconnect();

  $newqa->setrefnum($refnum);
  $newqa->setcustomer($customer);
  $newqa->setpartname($partname);
  $newqa->setbachnum($bachnum);
  $newqa->setpartnum($partnum);
  $newqa->setmatl_spec($matl_spec);
  $newqa->setissues_ps($issues_ps);
  $newqa->setqty($qty);
  $newqa->setponum($ponum);
  $newqa->setpart_sl_num($part_sl_num);
  $newqa->setwonum($wonum);
  $newqa->setdcnum($dcnum);
  $newqa->setdcdate($dcdate);
  $newqa->setcreate_date($create_date);
  $newqa->settraceability_recnum($traceability_recnum);
  $newqa->setdim_deviation($dim_deviation);
  $newqa->setman($man);
  $newqa->setinprocess($inprocess);
  $newqa->setmat_deviation($mat_deviation);
  $newqa->setmachine($machine);
  $newqa->setfinal_insp($final_insp);
  $newqa->setother_deviation($other_deviation);
  $newqa->setmethod($method);
  $newqa->setcust_end($cust_end);
  $newqa->setdescription($description);
  $newqa->setroot_cause($root_cause);
  $newqa->setcorrective_action($corrective_action);
  $newqa->setpreventive_action($preventive_action);
  $newqa->seteffectiveness($effectiveness);
  $newqa->setcofcnum($cofcnum);
  $newqa->setsuper($supername);
  $newqa->setoper($opername);
  $newqa->setcust_nc($custncno);
  $newqa->setcust_date($custncdate);
  $newqa->setremarks($remarks);
  $newqa->setrm_cost($rm_cost);
  $newqa->setcurrency($currency);
  $newqa->setstat($stat);
  $newqa->setaccepted($accepted);
  $newqa->setrejected($rejected);
  $newqa->setquarantined($quarantined);
  $newqa->setrework($rework);
  $newqa->setsource($source1);
  $newqa->setwotype($wotype);
  $newqa->setdnnum($dnnum);
  $newqa->setstagenum($stagenum);
  $newqa->setcreated_by($created_by);

  $newqa->setmc_name($mc_name);
  $sql = "start transaction";
  $result = mysql_query($sql);

 $final_insprecnum = $newqa->addnc4qa();
  $checkdn_num=$newqa->getdn_num($wonum,$dnnum);

  if($cust_end == 'yes')
  {
  if($wotype=='With Treatment')
  {
    if(mysql_num_rows($checkdn_num) > 0)
    {
        $wopartstatus=$newqa->updatewo_p4tret($wonum,$qty,$final_insprecnum,$dnnum);
    }
   else if($stagenum =='DN')
   {
     echo "<table border=1><tr><td><font color=#FF0000>";
     die("The Entered DN # ".$dnnum. " is not present for WO # ".$wonum);
     echo "</td></tr></table>";
   }
  }
  else
  {
     $wopartstatus=$newqa->updatewo_part_status($wonum,$qty,$final_insprecnum);

   }

   $refnum1 = strpos($refnum, "A-") ;
   if($refnum1 > 0 )
   {
      if($rework =='yes')
      {
        $type ='rework' ;
        $newqa->updateassywoli($wonum,$qty,$type) ;
      }
    if($rejected =='yes')
      {
        $type ='rejected' ;
        $newqa->updateassywoli($wonum,$qty,$type) ;
      }
   }
   else
   {
      if($rework =='yes')
      {
        $type ='rework' ;
        $newqa->updaterework4wo($wonum,$qty,$type) ;
      }

      // echo "hello";
      if($rejected =='yes')
      { 

        // echo "reachde" . $type ;exit;   
        $type ='reject' ;
        $newqa->updaterework4wo($wonum,$qty,$type) ;
      }

   }

}
}
else if($pagename == 'edit_nc4qa_prodn')
{
  $nc4qarecnum = $_REQUEST['nc4qarecnum'];
  $newlogin = new userlogin;
  $newlogin->dbconnect();

  $newqa->setrefnum($refnum);
  $newqa->setcustomer($customer);
  $newqa->setpartname($partname);
  $newqa->setbachnum($bachnum);
  $newqa->setpartnum($partnum);
  $newqa->setmatl_spec($matl_spec);
  $newqa->setissues_ps($issues_ps);
  $newqa->setqty($qty);
  $newqa->setponum($ponum);
  $newqa->setpart_sl_num($part_sl_num);
  $newqa->setwonum($wonum);
  $newqa->setdcnum($dcnum);
  $newqa->setdcdate($dcdate);
  $newqa->setcreate_date($create_date);
  $newqa->settraceability_recnum($traceability_recnum);
  $newqa->setdim_deviation($dim_deviation);
  $newqa->setman($man);
  $newqa->setinprocess($inprocess);
  $newqa->setmat_deviation($mat_deviation);
  $newqa->setmachine($machine);
  $newqa->setfinal_insp($final_insp);
  $newqa->setother_deviation($other_deviation);
  $newqa->setmethod($method);
  $newqa->setcust_end($cust_end);
  $newqa->setdescription($description);
  $newqa->setroot_cause($root_cause);
  $newqa->setcorrective_action($corrective_action);
  $newqa->setpreventive_action($preventive_action);
  $newqa->seteffectiveness($effectiveness);
  $newqa->setcofcnum($cofcnum);
  $newqa->setsuper($supername);
  $newqa->setoper($opername);
  $newqa->setcust_nc($custncno);
  $newqa->setcust_date($custncdate);
  $newqa->setremarks($remarks);
  $newqa->setrm_cost($rm_cost);
  $newqa->setcurrency($currency);
  $newqa->setstat($stat);
  $newqa->setmc_name($mc_name);
 // $newqa->setstagenum($stagenum);
  
  $newqa->updatenc4qa_prodn($nc4qarecnum);
}
else
{
//echo "here";
    $nc4qarecnum = $_REQUEST['nc4qarecnum'];
    $newlogin = new userlogin;
    $newlogin->dbconnect();
    
    $newqa->setrefnum($refnum);
    $newqa->setcustomer($customer);
    $newqa->setpartname($partname);
    $newqa->setbachnum($bachnum);
    $newqa->setpartnum($partnum);
    $newqa->setmatl_spec($matl_spec);
    $newqa->setissues_ps($issues_ps);
    $newqa->setqty($qty);
    $newqa->setponum($ponum);
    $newqa->setpart_sl_num($part_sl_num);
    $newqa->setwonum($wonum);
    $newqa->setdcnum($dcnum);
    $newqa->setdcdate($dcdate);
    $newqa->settraceability_recnum($traceability_recnum);
    $newqa->setdim_deviation($dim_deviation);
    $newqa->setman($man);
    $newqa->setinprocess($inprocess);
    $newqa->setmat_deviation($mat_deviation);
    $newqa->setmachine($machine);
    $newqa->setfinal_insp($final_insp);
    $newqa->setother_deviation($other_deviation);
    $newqa->setmethod($method);
    $newqa->setcust_end($cust_end);
    $newqa->setdescription($description);
    $newqa->setroot_cause($root_cause);
    $newqa->setcorrective_action($corrective_action);
    $newqa->setpreventive_action($preventive_action);
    $newqa->seteffectiveness($effectiveness);
    $newqa->setcofcnum($cofcnum);
    $newqa->setsuper($supername);
    $newqa->setoper($opername);
    $newqa->setcust_nc($custncno);
    $newqa->setcust_date($custncdate);
    $newqa->setremarks($remarks);
    $newqa->setrm_cost($rm_cost);
    $newqa->setcurrency($currency);
    $newqa->setstat($stat);
    $newqa->setaccepted($accepted);
    $newqa->setrejected($rejected);
    $newqa->setquarantined($quarantined);
	$newqa->setrework($rework);
    $newqa->setsource($source1);
    $newqa->setwotype($wotype);
    $newqa->setdnnum($dnnum);
    $newqa->setstagenum($stagenum);
	$newqa->setmc_name($mc_name);
	//echo '---'.$rm_cost.'---'.$currency;

    $sql = "start transaction";
    $result = mysql_query($sql);
	
    $final_insprecnum=$newqa->updatenc4qa($nc4qarecnum);
//echo "ok";
  $checkdn_num=$newqa->getdn_num($wonum,$dnnum);
 //echo $accepted;
    if($cust_end == 'yes')
{
  if($wotype=='With Treatment')
  {
    if(mysql_num_rows($checkdn_num) > 0)
  {
      if($accepted == 'yes')
      {
        $wopartstatus=$newqa->updatewo_pQty4treat($wonum,$qty,$final_insprecnum,$dnnum);
      }else
      {
        $wopartstatus=$newqa->updatewo_p4tret($wonum,$qty,$final_insprecnum,$dnnum);
      }

  }
   else if($stagenum !='FI')
   {
     echo "<table border=1><tr><td><font color=#FF0000>";
     die("The Entered DN # ".$dnnum. " is not present for WO # ".$wonum);
     echo "</td></tr></table>";
   }
  }
  else
  {
    if($accepted=='yes')
    {
      $wopartstatus=$newqa->updatewo_part_statusQty($wonum,$qty,$final_insprecnum);
    }else
    {
     $wopartstatus=$newqa->updatewo_part_status($wonum,$qty,$final_insprecnum);
    }

   }
}
}
//exit();
header ( "Location: nc4qa_summary.php" );



?>
