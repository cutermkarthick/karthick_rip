<?php
//==============================================
// Author: FSI                                 =
// Date-written = April 26, 2010               =
// Filename: assyReviewProcess.php             =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OMS                          =
// Processes Contacts                          =
//==============================================

session_start();
header("Cache-control: private");
$userid = $_SESSION['user'];
$userrecnum = $_SESSION['userrecnum'];
$pagename= $_SESSION['pagename'];
include('classes/assyReviewClass.php');
include('classes/assyReview_liClass.php');
include('classes/assywo_flowClass.php');
include('classes/workflowClass.php');

$newassyReview = new assyReview;
$newLI = new assyReview_li;
$assywo_flow = new assywo_flow;
$newWF = new workflow;

if(($pagename == 'assyReviewEntry') || ($pagename == 'assyReviewEdit'))
{
  $cust_ponum = $_REQUEST['cust_ponum'];
  $customer = $_REQUEST['companyrecnum'];
  $po_date = $_REQUEST['po_date'];
  $quote_ref = $_REQUEST['quote_ref'];
  $poline = $_REQUEST['po_li'];
  $amendment= $_REQUEST['amendment'];
  $amendment_date= $_REQUEST['amnd_date'];
  $review_ref = $_REQUEST['review_ref'];
  $review_date = $_REQUEST['review_date'];
  $contact = $_REQUEST['contact'];
  $email = $_REQUEST['email_id'];
  $ord_type= $_REQUEST['ord_type'];
  $order_for = $_REQUEST['order_for'];
  $agr= $_REQUEST['agr'];
  $project= $_REQUEST['project'];
  $technical_requirements= $_REQUEST['technical_requirements'];
  $quality_requirements= $_REQUEST['quality_requirements'];
  $controlled = $_REQUEST['controlled'];
  $doc_req= $_REQUEST['doc_req'];
  $spec_req= $_REQUEST['spec_req'];
  $outsourcing_activities = $_REQUEST['outsourcing_activities'];
  $cust_agr= $_REQUEST['cust_agr'];
  $app_cust= $_REQUEST['app_cust'];
  $act_out= $_REQUEST['act_out'];
  $delivery= $_REQUEST['delivery'];
  $source_mfg= $_REQUEST['source_mfg'];
  $item_req= $_REQUEST['item_req'];
  $item_app= $_REQUEST['item_app'];
  $sup_item = $_REQUEST['sup_item'];
  $risk = $_REQUEST['risk'];
  $resources= $_REQUEST['resources'];
  $env= $_REQUEST['env'];
  $others= $_REQUEST['others'];
  $special_instruction = addslashes($_REQUEST['special_instruction']);
  $qa_approved = $_REQUEST["qa_app"];
  $engineering_approved = $_REQUEST["eng_app"];
  $qa_app = $_REQUEST["qa_app_by"];
  $eng_app = $_REQUEST["eng_app_by"];
  $status = $_REQUEST['status'];
}

if($pagename == 'assyReviewEntry')
{
  $newlogin = new userlogin;
  $newlogin->dbconnect();
  $i=0;
  $max=$_POST['maxrecnum'];
  $flag=0;

  while($i<$max)
  {
    $linenumber="line_num" . $i;
    $crn="crn" . $i;
    $assy_partnum="assy_partnum" . $i;
    $assy_desc="assy_desc" . $i;
    $bom="bom" . $i;
    $bomnum="bomnum" . $i;
    $bom_iss="bom_iss" . $i;
    $qty="qty" . $i;
    $price="price" . $i;
    $pcrn="pcrn" . $i;
    $partnum="partnum" . $i;
    $description="description" . $i ;
    $part_iss="part_iss" . $i;
    $cos_iss="cos_iss" . $i;
    $model_iss="model_iss" . $i ;
    $drg_iss="drg_iss" . $i ;

  	$linenumber1= $_REQUEST[$linenumber];
  	$crn1 = $_REQUEST[$crn];
  	$assy_partnum1 = $_REQUEST[$assy_partnum];
  	$assy_desc1 = $_REQUEST[$assy_desc];
  	$bom1 = $_REQUEST[$bom];
  	$bom_iss1 = $_REQUEST[$bom_iss];
  	$qty1 = $_REQUEST[$qty];
  	$price1 = $_REQUEST[$price];
    $pcrn1 = $_REQUEST[$pcrn];
    $partnum1=$_REQUEST[$partnum];
    $description1=$_REQUEST[$description];
    $part_iss1=$_REQUEST[$part_iss];
    $cos_iss1=$_REQUEST[$cos_iss];
    $model_iss1=$_REQUEST[$model_iss];
    $drg_iss1=$_REQUEST[$drg_iss];
    $totprice = $qty1*$price1;

		if ($pagename == 'assyReviewEntry')
		{
			if($flag==0)
			{
        $newassyReview->setcust_ponum($cust_ponum);
        $newassyReview->setcustomer($customer);
        $newassyReview->setpo_date($po_date);
        $newassyReview->setquote_ref($quote_ref);
        $newassyReview->setpo_line($poline);
        $newassyReview->setamnd_num($amendment);
        $newassyReview->setamnd_date($amendment_date);
        $newassyReview->setreview_ref($review_ref);
        $newassyReview->setreview_date($review_date);
        $newassyReview->setord_type($ord_type);
        $newassyReview->setcontact($contact);
        $newassyReview->setorder_for($order_for);
        $newassyReview->setmail($email);
        $newassyReview->setagreement($agr);
        $newassyReview->setproject($project);
        $newassyReview->settechnical_requirements($technical_requirements);
        $newassyReview->setquality_requirements($quality_requirements);
        $newassyReview->setcontrol($controlled);
        $newassyReview->setdoc_req($doc_req);
        $newassyReview->setspec_req($spec_req);
        $newassyReview->setcust_agr($cust_agr);
        $newassyReview->setapp_cust($app_cust);
        $newassyReview->setsource_mfg($source_mfg);
        $newassyReview->setoutsourcing_activities($outsourcing_activities);
        $newassyReview->setitem_req($item_req);
        $newassyReview->setitem_app($item_app);
        $newassyReview->setsup_item($sup_item);
        $newassyReview->setdelivery_schedules($delivery);
        $newassyReview->setrisk($risk);
        $newassyReview->setresources($resources);
        $newassyReview->setenv($env);
        $newassyReview->setothers($others);
        $newassyReview->setact_out($act_out);
        $newassyReview->setspecial_instruction($special_instruction);

				$sql = "start transaction";
				$result = mysql_query($sql);
				$delrecnum = $newassyReview->addAssyReview();
        // $delrecnum = 38;
				$flag=1;

			}
      if($linenumber1 != '')
      {
  			$newLI->setlink2review($delrecnum);
  			$newLI->setlinenum($linenumber1);
  			$newLI->setcrn($crn1);
  			$newLI->setassypart($assy_partnum1);
  			$newLI->setassydesc($assy_desc1);
  			$newLI->setbomref($bom1);
  			$newLI->setbomiss($bom_iss1);
  			$newLI->setqty($qty1);
        $newLI->setprice($price1);
        $newLI->setpcrn($pcrn1);
	  		$newLI->setpartnum($partnum1);
	  		$newLI->setdescription($description1);
	  		$newLI->setpart_iss($part_iss1);
	  		$newLI->setcos_iss($cos_iss1);
	  		$newLI->setmodel_iss($model_iss1);
	  		$newLI->setdrg_iss($drg_iss1);
        $newLI->settotalprice($totprice);
	  		$newLI->setassydate($po_date);
	  		
			  $newLI->addAssyReview_li($cust_ponum);

        /******* Add Assyworkorder from assy so line Items **********/ 
        $assyworecnum = $newLI->addAssywo4AssySOLI($cust_ponum,$customer);

        $j=1;
        $wotype = 'Ripple';
        $wfcnt=$newWF->getcountWF($wotype,'WO');
        $wf = $newWF->getWF($wotype,'WO');

        while ($myrow = mysql_fetch_assoc($wf)) 
        {

          $dateval = '';
          $dependency1 = $myrow['dependency'];
          $stagename1 = $myrow['status'];
          $stagenum1 = $myrow['stage'];
          $dept1 = $myrow['dept'];
          $secs_respose1 = $myrow['secondary_responsibility'];
          $process1 = $myrow['process'];
          $when_process1 = $myrow['when_process'];
          $email_list11 = $myrow['email_list'];
          $primary_respose1 = $myrow['primary_responsibility'];
          $link2wfconfig1 = $myrow['recnum'];

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
          $assywo_flow->setemaillist($email_list11);
          $assywo_flow->setprimary_respose($primary_respose1);
          $assywo_flow->setdoctype('WO');
          
          $assywo_flow->addassywo_flow($assyworecnum);

          $j++;
        }


      }


			$sql = "commit";
			$result = mysql_query($sql);
			if(!$result)
			{
				$sql = "rollback";
				$result = mysql_query($sql);
				die("Commit failed Assypo LI Insert..Please report to Sysadmin. " . mysql_errno());
			}
		}
    $i++;
  }
  // exit;
  header("Location:assyReviewSummary.php");
}

else if ($pagename == 'assyReviewEdit')
{
   $bomdetails = $_REQUEST['bom_details'];
//echo "<br>bom details is $bomdetails";
//echo "<br>i am inside dispatchupdate";
   $max=$_REQUEST['maxrecnum'];
   $recnum = $_REQUEST['recnum'];
   //echo "<br>recnum is $recnum and in edit----index is $max";
   $i=0;
   $flag=0;
   				$newlogin = new userlogin;
				$newlogin->dbconnect();

                $newassyReview->setcust_ponum($cust_ponum);
                $newassyReview->setcustomer($customer);
                $newassyReview->setpo_date($po_date);

                $newassyReview->setquote_ref($quote_ref);
                $newassyReview->setpo_line($poline);
                $newassyReview->setamnd_num($amendment);
                $newassyReview->setamnd_date($amendment_date);
                $newassyReview->setreview_ref($review_ref);
                $newassyReview->setreview_date($review_date);
                $newassyReview->setord_type($ord_type);
                $newassyReview->setcontact($contact);
                $newassyReview->setorder_for($order_for);
                $newassyReview->setmail($email);
                $newassyReview->setagreement($agr);
                $newassyReview->setproject($project);
                $newassyReview->settechnical_requirements($technical_requirements);
                $newassyReview->setquality_requirements($quality_requirements);
                $newassyReview->setcontrol($controlled);
                $newassyReview->setdoc_req($doc_req);
                $newassyReview->setspec_req($spec_req);
                $newassyReview->setcust_agr($cust_agr);
                $newassyReview->setapp_cust($app_cust);
                $newassyReview->setsource_mfg($source_mfg);
                $newassyReview->setoutsourcing_activities($outsourcing_activities);
                $newassyReview->setitem_req($item_req);
                $newassyReview->setitem_app($item_app);
                $newassyReview->setsup_item($sup_item);
                $newassyReview->setdelivery_schedules($delivery);
                $newassyReview->setrisk($risk);
                $newassyReview->setresources($resources);
                $newassyReview->setenv($env);
                $newassyReview->setothers($others);
                $newassyReview->setact_out($act_out);
                $newassyReview->setspecial_instruction($special_instruction);
                $newassyReview->setqa_approved($qa_approved);
                $newassyReview->setengineering_approved($engineering_approved);
                $newassyReview->setqa_app_by($qa_app);
                $newassyReview->seteng_app_by($eng_app);
                 $newassyReview->setstatus($status);
               	$sql = "start transaction";
 				$result = mysql_query($sql);
                $newassyReview->updateAssyReview($recnum);
				$flag=1;
 			        //echo 'after dispatch'.$disprecnum;

while($i<=$max)
{
   $linenumber="line_num" . $i;
   $crn="crn" . $i;
   $assy_partnum="assy_partnum" . $i;
   $assy_desc="assy_desc" . $i;
   $bom="bom" . $i;
   $bomnum="bomnum" . $i;
   $bom_iss="bom_iss" . $i;
   $qty="qty" . $i;
   $price="price" . $i;
   $pcrn="pcrn" . $i;
   $partnum="partnum" . $i;
   $description="description" . $i ;
   $part_iss="part_iss" . $i;
   $cos_iss="cos_iss" . $i;
   $model_iss="model_iss" . $i ;
   $drg_iss="drg_iss" . $i ;
   //echo $partnum."--<br>";

	$prelinenum="prev_line_num" . $i;
	$lirecnum="lirecnum" . $i;

	$prevlinenum1=$_REQUEST[$prelinenum];
	$lirecnum1=$_REQUEST[$lirecnum];

    //echo 'prevlinenum1='.$prevlinenum1;
    $linenumber1= $_REQUEST[$linenumber];
	$crn1 = $_REQUEST[$crn];
	$assy_partnum1 = $_REQUEST[$assy_partnum];
	$assy_desc1 = $_REQUEST[$assy_desc];
	$bom1 = $_REQUEST[$bom];
	$bom_iss1 = $_REQUEST[$bom_iss];
	$qty1 = $_REQUEST[$qty];
	$price1 = $_REQUEST[$price];
	$pcrn1 = $_REQUEST[$pcrn];
	$partnum1=$_REQUEST[$partnum];
    $description1=$_REQUEST[$description];
    $part_iss1=$_REQUEST[$part_iss];
    $cos_iss1=$_REQUEST[$cos_iss];
    $model_iss1=$_REQUEST[$model_iss];
    $drg_iss1=$_REQUEST[$drg_iss];
	
	$totprice = $qty1*$price1;

	$newlogin = new userlogin;
	$newlogin->dbconnect();

	//echo "<br>Line number is    :$linenumber1<br>";
	if ($linenumber1 != '')
	{
      //echo 'inside up';

			$newLI->setlinenum($linenumber1);
			$newLI->setcrn($crn1);
			$newLI->setassypart($assy_partnum1);
			$newLI->setassydesc($assy_desc1);
			$newLI->setbomref($bom1);
			$newLI->setbomiss($bom_iss1);
			$newLI->setqty($qty1);
            $newLI->setprice($price1);
            $newLI->setpcrn($pcrn1);
	  		$newLI->settotalprice($totprice);
	  		$newLI->setpartnum($partnum1);
	  		$newLI->setdescription($description1);
  			$newLI->setpart_iss($part_iss1);
	  		$newLI->setcos_iss($cos_iss1);
	  		$newLI->setmodel_iss($model_iss1);
	  		$newLI->setdrg_iss($drg_iss1);
	  		//echo "prev=".$prevlinenum1;
                        if($prevlinenum1 != '')
			{  
                                //echo"<br>HERE--up-";
			 	$newLI->updateAssyReview_li($lirecnum1,$cust_ponum);
			}
			else
			{  
                             //echo "<br>HERE-in--";
		             $newLI->setlink2review($recnum);
      		             $newLI->addAssyReview_li($cust_ponum);
			}
	} else
	{
	  //echo "<br>HERE-del---$prevlinenum1<br>";
         if ($prevlinenum1 != '')
         {   $prevlnarr=split("-",$prevlinenum1);
           if($prevlnarr[1]!="")
           { //echo"HERE--pppp<br>";
              $newLI->deleteassyreviewli($lirecnum1);
           }else
           {   //echo"hrerer---$crn1<br>";
             $newLI->deleteassyreviewli($lirecnum1);
             $newLI->deleteassyreviewlichild($crn1);
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
		 die("Commit failed for assembly review update..Please report to Sysadmin. " . mysql_errno());
	 }
header("Location:assyReviewDetails.php?recnum=".$recnum);
}
else if($pagename == 'assyReviewedit4View')
{
    $status = $_REQUEST['status'];
    $qa_approved = $_REQUEST["qa_app"];
    $engineering_approved = $_REQUEST["eng_app"];
    $recnum = $_REQUEST['recnum'];
    $qa_app = $_REQUEST["qa_app_by"];
    $eng_app = $_REQUEST["eng_app_by"];
    //echo  $eng_app."-----".$engineering_approved."-<br>";
    $newassyReview->setstatus($status);
    $newassyReview->setqa_approved($qa_approved);
    $newassyReview->setengineering_approved($engineering_approved);
    $newassyReview->setqa_app_by($qa_app);
    $newassyReview->seteng_app_by($eng_app);
    $newassyReview->updatereview4app($recnum);
    header("Location:assyReviewDetails4View.php?recnum=".$recnum);
}

else if ($pagename == 'assyReviewDetails')
{
  $recnum = $_REQUEST['recnum'];
  $newassyReview->updateval_status($recnum);
  header("Location:assyReviewDetails.php?recnum=".$recnum);
}
?>
