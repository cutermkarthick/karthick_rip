<?php  
//==============================================
// Author: FSI                                 =
// Date-written = June 21, 2005                =
// Filename: processGenericWO.php              =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OWT                          =
//==============================================

session_start();
header("Cache-control: private");

$pagename = $_SESSION['pagename'];
$action = $_REQUEST['action'];
$dept = $_SESSION['department'];
$userrole = $_SESSION['userrole'];

//include('classes/pageClass.php');
//include('classes/pagefieldsClass.php');
//include('classes/genericWOClass.php');
include_once('classes/loginClass.php');
include('classes/workorderClass.php');
include('classes/companyClass.php');
//include('classes/empClass.php');
//include('classes/partClass.php');
include_once('classes/emailClass.php');
include('classes/workflowClass.php');
//include_once('classes/dynamicworkdatesflowClass.php');
include('classes/datesClass.php');
include('classes/approvalClass.php');
include('classes/fairClass.php');



// Get the wo type,recnum and related session variables
if ($pagename == 'wodetailsedit')
{
    $typenum =$_SESSION['typenum'] ;
    $wotype =$_SESSION['wotype'] ;
    $worecnum =$_SESSION['worecnum'] ;
    $wonum =$_SESSION['wonum'];

}

// Next, create an instance of the classes required
$userid = $_SESSION['user'];
$userrecnum = $_SESSION['userrecnum'];
//$newpage = new page;
//$newFI= new pagefields;
//$newGen= new genericWO;
$newWF = new workflow;
$newDates = new dates;
//$newPart = new part;
$newWO = new workOrder;
$newCust = new company;
//$newEmp = new emp;
//$newPart = new part;
$newEmail = new email;
$newapproval= new Approval;
$newfair = new fair;


// Get all fields related to work order general info

$company = $_REQUEST['company'];
$companyrecnum = $_REQUEST['companyrecnum'];
$contactrecnum = $_REQUEST['contactrecnum'];
$contact = $_REQUEST['contact'];
$phone = $_REQUEST['phone'];
$email = $_REQUEST['email'];
$wotype = $_REQUEST['wotype'];
$ponum = $_REQUEST['ponum'];
$po_date = $_REQUEST['po_date'];
$descr = $_REQUEST['descr'];
$schduedate = $_REQUEST['sch_due_date'];
$reorder = $_REQUEST['reorder'];
$emprecnum = $_REQUEST['emprecnum'];
$bookdate = $_REQUEST['book_date'];
$revshipdate = $_REQUEST['rev_ship_date'];
$qtm = $_REQUEST['qtm'];
//$bomrecnum = $_REQUEST['bomrecnum'];

$qty = $_REQUEST['qty'];
$po_qty = $_REQUEST['po_qty'];
$partnum = $_REQUEST['partnum'];
//$rmtype=$_REQUEST['rm_type'];
//$rmspec=$_REQUEST['rm_spec'];
$rmdim1=$_REQUEST['rm_dim1'];
$rmdim2=$_REQUEST['rm_dim2'];
$rmdim3=$_REQUEST['rm_dim3'];
$actshipdate = $_REQUEST['act_ship_date'];

if($_REQUEST['grnnum']=='')
{
 $grnnum = $_REQUEST['grnnum_split'];
 $batchnum = $_REQUEST['batchnum_split'];
 $rm_type=$_REQUEST['rm_type_split'];
  $rm_spec=$_REQUEST['rm_spec_split'];
}
else
{
  $grnnum = $_REQUEST['grnnum'];
  $batchnum = $_REQUEST['batchnum'];
  $rm_type=$_REQUEST['rm_type'];
  $rm_spec=$_REQUEST['rm_spec'];
}
//echo $rmtype."-----------------".$rmspec;

$woclassif = $_REQUEST['woclassif'];
$worefnum =  $_REQUEST['worefnum'];

$amenddate =  $_REQUEST['amenddate'];
$amendqty =  $_REQUEST['amendqty'];
$amendnotes =  $_REQUEST['amendnotes'];
$cust_po_line_num =  $_REQUEST['cust_po_line_num'];

$treatment = $_REQUEST['treatment'];
$crn = $_REQUEST['CIM_refnum'];
$rev4fair = $_REQUEST['mps_rev'];
$stage_split=$_REQUEST['stage_split'];
$app = $_REQUEST['approved_re_wo'];
$app_date = $_REQUEST['approval_date'];
$app_by = $_REQUEST['approved_by'];
$condition=$_REQUEST['condition'];
$printflag=$_REQUEST['printflag'];
$printapproval = $_REQUEST['printapproval'];
$notes = htmlspecialchars($_REQUEST['notes'],ENT_QUOTES);
$priority = $_REQUEST['priority'];
// echo $rev4fair;
if($qty !='' && $amendqty != '')
{
   $qty1=$amendqty;
   $original_qty = $qty;
}

if($qty !='' && ($amendqty == '' || $amendqty == '0'))
{
   $qty1=$qty;
   $original_qty = '0';
}

$remarks =  $_REQUEST['remarks'];
$link2mps =  $_REQUEST['link2mps'];

//echo "qty is" . $qty;
//echo "hiii";
 $link2masterdata = $_REQUEST['link2masterdata'];


// Set the Work Order fields

//$newWO->setwonum($wonum);
$newWO->setwotype($wotype);
$newWO->setdescr($descr);
$newWO->setponum($ponum);
$newWO->setpodate($po_date);
$newWO->setwo2customer($companyrecnum);
$newWO->setwo2employee($emprecnum);
$newWO->setwo2contact($contactrecnum);
$newWO->setschduedate($schduedate);
$newWO->setbookdate($bookdate);
$newWO->setrevshipdate($revshipdate);
$newWO->setreorder($reorder);
//$newWO->setbomrecnum($bomrecnum);
$newWO->setgrnnum($grnnum);
$newWO->setqty($qty1);
$newWO->setpoqty($po_qty);
$newWO->setpartnum($partnum);
$newWO->setactshipdate($actshipdate);
$newWO->setbatchnum($batchnum);
$newWO->setwoclassif($woclassif);
$newWO->setworefnum($worefnum);
$newWO->settreat($treatment);
$newWO->setamenddate($amenddate);
$newWO->setamendnotes($amendnotes);
$newWO->setoriginal_qty($original_qty);
$newWO->setcust_po_line_num($cust_po_line_num);

$newWO->setremarks($remarks);
$newWO->setlink2mps($link2mps);
$newWO->setcrn($crn);
$newWO->setstage_split($stage_split);
$newWO->setapproval($app);
$newWO->setapproval_date($app_date);
$newWO->setcondition($condition);
$newWO->setprintflag($printflag);
$newWO->setprintapproval($printapproval);
$newWO->setrm_spec($rm_spec);
$newWO->setrm_type($rm_type);
$newWO->setpriority($priority);
/*$app = $_REQUEST['approved_re_wo'];
$app_date = $_REQUEST['approval_date'];
$app_by = $_REQUEST['approved_by']; */
$newWO->setapprovedby($app_by);
$newWO->setlink2masterdata($link2masterdata);
$newWO->setqtm($qtm);

// Database Connect
$newlogin = new userlogin;
$newlogin->dbconnect();
//echo "hiii";
if ($action == 'new' )
{
	$sql = "start transaction";
	$result = mysql_query($sql);
/*	$result = $newpage ->gettypes("Work Order");
	while($myrow = mysql_fetch_row($result))
	{
		$i=1;
		while($i<= $myrow[1])
		{
			$req = $myrow[0] . $i;
			if(isset($_REQUEST[$req]))
			{
				$req1=$_REQUEST[$req];
				if($myrow[0] == 'part' || $myrow[0] == 'partqty' )
				{
					if (isset($_REQUEST[$req]) && trim($_REQUEST[$req] != ''))
					{
						if ($reorder != '')
						{
							$newPart->addPartMaster4upd($req1,$wotype);
						 }
						 else
						 {
							$newPart->addPartMaster($req1,$wotype);
						 }
					}
				}
				else if($myrow[0] == 'checkbox' )
				{
					$req1='y';
				}
				else if($myrow[0] == 'number' || $myrow[0] == 'floatval' || $myrow[0] == 'qty')
				{
					if($req1 == '')
					$req1='NULL';
				}

			}
			else
			{
				if($myrow[0] == 'number' || $myrow[0] == 'floatval' || $myrow[0] == 'qty')
				{
					$req1='NULL';
				}
				else if($myrow[0] == 'checkbox' )
				{
					$req1='n';
				}
				else
				{
					$req1='';
				}
			}
			$fun="set$req";
			//$newGen->$fun($req1);
			$i++;
		}
	} */

//***************Jan 16,2007 added for file attachments ***************************
 //  $check1=$_FILES['filename1']['name'] ;
   //$check2=$_FILES['filename2']['name'] ;
   //$check3=$_FILES['filename3']['name'] ;
   //$check4=$_FILES['filename4']['name'] ;

  /* if ($check1 != '' )
   {
	  $filename1 = $userid . '_' . $_FILES['filename1']['name'];
	  $filename1 = preg_replace('/\s+/',' ',$filename1);
  	  $excelfile = preg_replace('/\s/','_',$filename1);
	  //echo "$filename<br>";
	  $filename1 = strtolower($filename1);
   }
   else
   {
       //echo "i am here else";
	   $filename1 ='';
   }
   if ($check2 != '' )
   {
	  $filename2 = $userid . '_' . $_FILES['filename2']['name'];
	  $filename2 = preg_replace('/\s+/',' ',$filename2);
  	  $excelfile = preg_replace('/\s/','_',$filename2);
	  //echo "$filename<br>";
	  $filename2 = strtolower($filename2);
   }
   else
   {
      //echo "i am here else";
	  $filename2 ='';
   }
   if ($check3 != '' )
   {
	  $filename3 = $userid . '_' . $_FILES['filename3']['name'];
	  $filename3 = preg_replace('/\s+/',' ',$filename3);
  	  $excelfile = preg_replace('/\s/','_',$filename3);
	  //echo "$filename<br>";
	  $filename3 = strtolower($filename3);
   }
   else
   {
      //echo "i am here else";
	  $filename3 ='';
   }
   if ($check4 != '' )
   {
	 $filename4 = $userid . '_' . $_FILES['filename4']['name'];
	 $filename4 = preg_replace('/\s+/',' ',$filename4);
  	 $excelfile = preg_replace('/\s/','_',$filename4);
	 //echo "$filename<br>";
	 $filename4 = strtolower($filename4);
  }
  else
  {
      //echo "i am here else";
	  $filename4 ='';
   }

      $newWO->setfilename1($check1);
      $newWO->setfilename2($check2);
      $newWO->setfilename3($check3);
      $newWO->setfilename4($check4);
      //$newWO->setlink2wo($worecnum);
      // $newWO->addWOattachment();

      copy($_FILES['filename1']['tmp_name'], "attachments/" . $filename1);
      copy($_FILES['filename2']['tmp_name'], "attachments/" . $filename2);
      copy($_FILES['filename3']['tmp_name'], "attachments/" . $filename3);
      copy($_FILES['filename4']['tmp_name'], "attachments/" . $filename4);
       /*
         if (!file_exists("attachments/" . $userid . $filename1)) {
         $source_file=$_FILES['filename1']['tmp_name'];
         $destination_file="attachments/" . $filename1;
         $newWO->ftp_copy($source_file,$destination_file);
         }   */

//**************************End of file attachment*********************************
   	//$type=$_REQUEST['wotype'];
	//$newGen->settype($type);

	// Get workflow details

	$wf = $newWF->getWF($wotype,'WO');
  $wf1 = $newWF->getWF($wotype,'WO');
  $crn_wf = $newWF->getWF4crn($crn,'WO');

	//$genrecnum=$newGen->addgenericWO();
	//$newWO->setwo2type($genrecnum);
	$mywf1 = mysql_fetch_row($wf1);
	$status = $mywf1[3];
	$newWO->setstatus($status);


 //FAIR Check
    $fair_flag = 0; $revmatch=0; $mpsrev4wo=0; $mpsrev4crn=0;$wofaistat="";
    $type = "";
    $type_remarks = "";
    $result_wo = $newWO->getPrev_wo($crn);
    $myrow_prev_wo =  mysql_fetch_row($result_wo);


    // For Previous WO check
    if(mysql_num_rows($result_wo) > 0)
    {
     $result_rev= $newWO->getPrevrev_match($crn,$myrow_prev_wo[0]);
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
         // echo "<pre>";
         // print_r($myrow_fair);

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
           /*if($link2mps !='' && $link2mps != 0)
           {
             $res_mpsrev=$newWO->getwomps($crn);
             $mympsrev=mysql_fetch_row($res_mpsrev);
             $mpsrev4wo=$mympsrev[2];

           }
           else
           {
           
             $res_crnrev=$newWO->getwocrnrev($crn);
             $mycrnrev=mysql_fetch_row($res_crnrev);
             $mpsrev4wo=$mycrnrev[2];

           } */
 //echo $myrow_rev[1]."---------------".$rev4fair;
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

//end fair check

    $newWO->setfai_type($type);
    $newWO->settype_remarks($type_remarks);
    $wo_arr = array();
    //$wonum=$_REQUEST['wonum'];
    //echo$woclassif."*************";
    if($woclassif=='Split')

    {
	  $wo_arr = $newWO->addWorkOrder();


	  //echo$wo_arr[1]."*************";
	  $prev_woref=$newWO->getprev_woref($worefnum);
	  if($prev_woref !=''||$prev_woref !=0)
	  {
      $wo_refnum=$prev_woref.','.$wo_arr[1];
      //echo$wo_refnum;
      $newWO->updatePrev_wo($wo_refnum,$worefnum);
	  }
	  else if($prev_woref ==''|| $prev_woref =='null')
	  {
      $newWO->updatePrev_wo($wo_arr[1],$worefnum);
      }
    }
    else
    {
       $wo_arr = $newWO->addWorkOrder();
    }
   


    $wogrnqty = $newWO->getgrnwoqty($grnnum);
    $wousdqty=$wogrnqty+$qty;
    $newWO->updategrn4woqty($wousdqty,$grnnum);
     /*$clbal = $qtm-$qty;*/



     /*echo $qtm."<br>";
     echo $qty."<br>";
     echo $wogrnqty."<br>";
     echo $clbal;exit;*/
    $qtm = $newWO->getgrnqtm($grnnum);
    $clbal = ($qtm-$wogrnqty)-$qty;
    $wonum = $wo_arr[1];
    $newWO->addgrnIssue($wonum,$clbal);
    
	  $worecnum = $wo_arr[0];
    $wo = $wo_arr[1];

     //Fair Entry
	  if($fair_flag == 1)
    {
      $newfair->setcrn($crn);
      $newfair->setwo($wo);
      $newfair->setwodate($bookdate);
      $newfair->settype($type);
      $newfair->setmpsrev($rev4fair);
      $newfair->setlink2wo($worecnum);
      $newfair->addFair();
    }

    $newDates->settype($wotype);
    $newDates->setdoctype('WO');

if(mysql_num_rows($crn_wf) > 0)
{

  $i=1;
    while ($mywf = mysql_fetch_row($crn_wf)) 
    {


      //echo "<pre>";
      //print_r($mywf);
      $crn_dates="crn_dates" . $i;
      $crn_chknm="crn_ckbo".$i;
      $crn_dependency="crn_dependency".$i;
      $crn_stagename="crn_stagename".$i;
      $crn_stagenum="crn_stagenum".$i;
      $crn_dept="crn_dept".$i;
      $getownerrecnum = $mywf[3] . "crn_ownerrecnum";

      $crn_secs_respose="crn_secs_respose".$i;
      $crn_process="crn_process".$i;
      $crn_when_process="crn_when_process".$i;
      $crn_email="crn_email".$i;
      $crn_primary_respose="crn_primary_respose".$i;

      if ((isset ($_REQUEST[$getownerrecnum])) && $_REQUEST[$getownerrecnum] != '')
      {


        $ownerrecnum = $_REQUEST[$getownerrecnum];
      }
      else
      {
        $ownerrecnum = 'NULL';
      }


      if(isset($_REQUEST[$crn_chknm]))
      {    

       // echo"HERE----";exit;
        if($mywf[2] != 'Cust')
        {
          $crn_dateval = $_REQUEST[$crn_dates];
          $crn_dependency1 = $_REQUEST[$crn_dependency];
          $crn_stagename1 = $_REQUEST[$crn_stagename];
          $crn_stagenum1 = $_REQUEST[$crn_stagenum];
          $crn_dept1 = $_REQUEST[$crn_dept];

          $crn_secs_respose1 = $_REQUEST[$crn_secs_respose];
          $crn_process1 = $_REQUEST[$crn_process];
          $crn_when_process1 = $_REQUEST[$crn_when_process];
          $crn_email1 = $_REQUEST[$crn_email];
          $crn_primary_respose1 = $_REQUEST[$crn_primary_respose];

       

          
          $newDates->setschdue($crn_dateval);
          $newDates->setlink2wfconfig($mywf[4]);
          $newDates->setlink2owner($ownerrecnum);
          $newDates->setlink2contact('NULL');
          $newDates->setdependency($crn_dependency1);
          $newDates->setstagename($crn_stagename1);
          $newDates->setstagenum($crn_stagenum1);
          $newDates->setdept($crn_dept1);

          $newDates->setsec_respose($crn_secs_respose1);
          $newDates->setprocess($crn_process1);
          $newDates->setwhen_process($crn_when_process1);
          $newDates->setemaillist($crn_email1);
          $newDates->setprimary_respose($crn_primary_respose1);
       

          $newDates->adddates($worecnum);
        }
        else if ($mywf[2] == 'Cust')
        { // echo"here in else $mywf[2]";
          $crn_dateval = $_REQUEST[$crn_dates];
          $crn_dependency1 = $_REQUEST[$crn_dependency];
          $crn_stagename1 = $_REQUEST[$crn_stagename];
          $crn_stagenum1 = $_REQUEST[$crn_stagenum];

          $newDates->setschdue($crn_dateval);
          $newDates->setlink2wfconfig($mywf[4]);
          $newDates->setlink2contact($contactrecnum);
          $newDates->setlink2owner('NULL');
          $newDates->setdependency($crn_dependency1);
          $newDates->setstagename($crn_stagename1);
          $newDates->setstagenum($crn_stagenum1);
          $newDates->setdept($crn_dept1);
          //$newDates->setlink2dwfconfig('NULL');
          $newDates->adddates($worecnum);
        }
      }
      $i++;
    }
// exit;
  }
  else
  {

    
    $i=1;
    while ($mywf = mysql_fetch_row($wf)) {
      $dates="dates" . $i;
      $chknm="ckbo".$i;
      $dependency="dependency".$i;
      $stagename="stagename".$i;
      $stagenum="stagenum".$i;
      $dept="dept".$i;
      $getownerrecnum = $mywf[3] . "_ownerrecnum";

      $secs_respose="secs_respose".$i;
      $process="process".$i;
      $when_process="when_process".$i;
      $email_list="email_list".$i;
      $primary_respose="primary_respose".$i;

      if ((isset ($_REQUEST[$getownerrecnum])) && $_REQUEST[$getownerrecnum] != '')
      {
        $ownerrecnum = $_REQUEST[$getownerrecnum];
      }
      else
      {
        $ownerrecnum = 'NULL';
      }

      if(isset($_REQUEST[$chknm]))
      {    

       // echo"HERE----";exit;
        if($mywf[2] != 'Cust')
        {
          $dateval = $_REQUEST[$dates];
          $dependency1 = $_REQUEST[$dependency];
          $stagename1 = $_REQUEST[$stagename];
          $stagenum1 = $_REQUEST[$stagenum];
          $dept1 = $_REQUEST[$dept];

          $secs_respose1 = $_REQUEST[$secs_respose];
          $process1 = $_REQUEST[$process];
          $when_process1 = $_REQUEST[$when_process];
          $email_list1 = $_REQUEST[$email_list];
          $primary_respose1 = $_REQUEST[$primary_respose];



          $newDates->setschdue($dateval);
          $newDates->setlink2wfconfig($mywf[4]);
          $newDates->setlink2owner($ownerrecnum);
          $newDates->setlink2contact('NULL');
          $newDates->setdependency($dependency1);
          $newDates->setstagename($stagename1);
          $newDates->setstagenum($stagenum1);
          $newDates->setdept($dept1);

          $newDates->setsec_respose($secs_respose1);
          $newDates->setprocess($process1);
          $newDates->setwhen_process($when_process1);
          $newDates->setemaillist($email_list1);
          $newDates->setprimary_respose($primary_respose1);


          $newDates->adddates($worecnum);
        }
        else if ($mywf[2] == 'Cust')
        { // echo"here in else $mywf[2]";
          $dateval = $_REQUEST[$dates];
          $dependency1 = $_REQUEST[$dependency];
          $stagename1 = $_REQUEST[$stagename];
          $stagenum1 = $_REQUEST[$stagenum];

          $newDates->setschdue($dateval);
          $newDates->setlink2wfconfig($mywf[4]);
          $newDates->setlink2contact($contactrecnum);
          $newDates->setlink2owner('NULL');
          $newDates->setdependency($dependency1);
          $newDates->setstagename($stagename1);
          $newDates->setstagenum($stagenum1);
          $newDates->setdept($dept1);
	        //$newDates->setlink2dwfconfig('NULL');
          $newDates->adddates($worecnum);
        }
      }
      $i++;
    }
// exit;
  }

  
/********************************************** */
	$dyna_rows = $_REQUEST['msdynamic'];
	if($dyna_rows>=1){
	   $dynaWF = new dynamicworkflow();
		$dynaWF->setact_status('Active');
		$dynaWF->setallowcustdisp('N');
		$dynaWF->setallowprintdisp('Y');
		$dynaWF->setallowreportdisp('N');
		$dynaWF->setapprby('NULL');
		$dynaWF->setapprtype('I');
		$dynaWF->setcuststatusdisp('');
		$dynaWF->setdept('NULL');
		$dynaWF->setdoctype('WO');
		$dynaWF->setemaillist('SU');
		$dynaWF->setest_cost('NULL');
		$dynaWF->setest_time('NULL');
		$dynaWF->settype($wotype);
	}

  for($i=1;$i<=$dyna_rows;$i++)
     {

                $dept = 'deptdyna' . $i;
                $ms = 'msdyna' . $i;
		        $dates = 'datedyna' . $i;
		        $owner = 'ownerdyna' . $i;
                $emprecnum = 'emprecnumdyna' . $i;

		        $dynaWF->setdept($_REQUEST[$dept]);
                $dynaWF->setstatus($_REQUEST[$ms]);
		        $dynaWF->addDWFStage();

         if((isset($_REQUEST[$owner])) && $_REQUEST[$owner] != ''){
		    $ownerrecnum = $_REQUEST[$emprecnum];
		}else{
			$ownerrecnum = 'NULL';
		}

		$dateval = $_REQUEST[$dates];
		$newDates->setschdue($dateval);
		$newDates->setlink2wfconfig($dynaWF->getrecnum());
		//$newDates->setlink2dwfconfig($dynaWF->getrecnum());
		$newDates->setlink2contact('NULL');
		$newDates->setLink2owner($ownerrecnum);
		$newDates->adddates($worecnum);
    }

/********************* Material Movements Entry **************************************/
$wo_issue_qty=$_REQUEST['wo_issue_qty'];

$newWO->setwoissue_qty($wo_issue_qty);
// echo "wo_issue_qty".$wo_issue_qty;
$cond=" where crnnum='$crn' and
     schedule_date ='$schduedate'";
     
$result=$newWO->updatedelivery_sch($cond);

		include("interprocess.php");

/***************************************** */
      $sql = "commit";
	  $result = mysql_query($sql);


	  if(!$result)
	  {
		 die("Commit failed for $wotype Insert..Please report to Sysadmin. " . mysql_error());
	  }
	  else
	  {
		$filename = "config.txt";
		$handle = fopen($filename, "r");
		$contents = fread($handle, filesize($filename));
		$equals= strcmp ( $contents,"Email=yes");
		if($equals==0)
	  	$newEmail->SendWOEmail($wonum);
		fclose($handle);
	  }
	$sql = "commit";
	$result = mysql_query($sql);
	if(!$result)
	{
		 $sql = "rollback";
		 $result = mysql_query($sql);
		 die("Commit failed Generic WO Insert..Please report to Sysadmin. " . mysql_errno());
	}

     header ( "Location: wordersummary.php" );

}
else
{
	$recnum = $_REQUEST['recnum'];

	// $recnum . 'aaaa';

	$actshipdate = $_REQUEST['act_ship_date'];
	$prevrevshipdate = $_REQUEST['prev_rev_ship_date'];
	$delete = $_REQUEST['deleteflag'];
	$worecnum = $_REQUEST['worecnum'];
	$wonum=$_REQUEST['wonum'];
	$newWO->setactshipdate($actshipdate);
	$sql = "start transaction";
	$result = mysql_query($sql);
	//$wostatus = $newGen->UpdategenericWO($recnum);

	if($woclassif=='Split')
	{
	   //echo"****HERE**** $wonum";
	   $newWO->updateWorkOrder($worecnum);
	   $newWO->updatePrev_wo($wonum,$worefnum);
	}
	else
	{


	   $newWO->updateWorkOrder($worecnum);
	}
	$prevamendqty=$_REQUEST['prevamendqty'];
	$prevcondition=$_REQUEST['prevcondition'];
	$prevgrnnum=$_REQUEST['prevgrnnum'];
	//echo $prevgrnnum."----$grnnum--------<br>";
	if($condition!="WO Cancelled")
	{
		if($prevgrnnum!=$grnnum)
		 {
		      $wogrnqty4new = $newWO->getgrnwoqty($grnnum);
			  $wogrnqty4prev = $newWO->getgrnwoqty($prevgrnnum);
   	        if($wogrnqty4new!=0 && $wogrnqty4new!="")
	      {
	          $wousdqty4new=$wogrnqty4new+$qty;
	      }
		   if($wogrnqty4prev!=0 && $wogrnqty4prev!="")
	      {
	          $wousdqty4prev=$wogrnqty4prev-$qty;
	      }
		  else
	      {
            $grnqtyused4new= $newWO->getwoqty4grn($grnnum);
			$grnqtyused4prev= $newWO->getwoqty4grn($prevgrnnum);

	        $wousdqty4new=$grnqtyused+$qty;
		    $wousdqty4prev=$grnqtyused-$qty;

	     }
             $newWO->updategrn4woqty($wousdqty4new,$grnnum);
			 $newWO->updategrn4woqty($wousdqty4prev,$prevgrnnum);
		 }
	if(($prevamendqty==0 || $prevamendqty==""))
	{
       $wogrnqty = $newWO->getgrnwoqty($grnnum);
	//echo $wogrnqty."-----------".$amendqty."-------".$original_qty;
   	  if($wogrnqty!=0 && $wogrnqty!="")
	  {
	    $wousdqty=$wogrnqty-$original_qty+$amendqty;
	  }else
	  {
        $grnqtyused= $newWO->getwoqty4grn($grnnum);
	    $wousdqty=$grnqtyused-$amendqty;
	 }
    //echo $wogrnqty."-----1------".$amendqty."-------".$original_qty."-----***----".$wousdqty."<br>";
        $newWO->updategrn4woqty($wousdqty,$grnnum);
	}
	
	}
	if($condition=="WO Cancelled" && $prevcondition!="WO Cancelled")
	{
     $wogrnqty = $newWO->getgrnwoqty($grnnum);
	//echo $prevamendqty."-----------".$amendqty."-------".$original_qty."<br>";
    if(($prevamendqty!=0 && $prevamendqty!=""))
    {
     if($wogrnqty!=0 && $wogrnqty!="")
     {
        $wousdqty=$wogrnqty-$amendqty;
     }else
     {
       $grnqtyused= $newWO->getwoqty4grn($grnnum);
	    $wousdqty=$grnqtyused-$amendqty;
     }

    }else
    {
       if($wogrnqty!=0 && $wogrnqty!="")
     {
        $wousdqty=$wogrnqty-$qty;
     }else
     {
       $grnqtyused= $newWO->getwoqty4grn($grnnum);
       $wousdqty=$grnqtyused-$qty;
     }
    }
    //echo $wogrnqty."------2-----".$amendqty."-------".$original_qty."-----used***".$wousdqty."<br>";
     $newWO->updategrn4woqty($wousdqty,$grnnum);
     $clbal=$newWO->getgrnIssue4wo($wonum);
     $newWO->addgrniss4wocancel($clbal,$wonum);
     $newWO->subWoIssQty($schduedate,$crn,$qty);
	}
if($condition=="WO Cancelled" || $condition=="Cancelled")
{
  $newWO->delete4mfair($wonum);
}
    
	$newWO->addNotes4wo($worecnum,$notes);
	$timeline = $newDates->getdates('WO', $worecnum, $wotype);
	$maxdates = $newDates->getcountdates('WO', $worecnum, $wotype);

    $filename = "config.txt";
	$handle = fopen($filename, "r");
	$contents = fread($handle, filesize($filename));
	$equals= strcmp ( $contents,"Email=yes");
	if($equals==0)
    {
	  	$newEmail->SendWOEmail($wonum);
		fclose($handle);
	        if($revshipdate != $prevrevshipdate && $revshipdate != '')
	        {
	                 $newEmail->sendShipchngEmail($wonum,$prevrevshipdate,$revshipdate);
	        }
	        if($actshipdate != '' && $actshipdate != '0000-00-00')
            {
                	 $newEmail->sendShipEmail($wonum,$revshipdate);
            }
        }

	$i=1;

	while ($mytl = mysql_fetch_row($timeline))
	{
		$dates="dates" . $i;
		$dater="dater" . $i;
		$datec="datec" . $i;

		$schddate = $_REQUEST[$dates];
		$revdate = $_REQUEST[$dater];
		$comdate = $_REQUEST[$datec];
		
		$newDates->settype($wotype);
		$newDates->setschdue($schddate);
		$newDates->setrevised($revdate);
		$newDates->setcompleted($comdate);
		$getownerrecnum =  $mytl[30] . "_ownerrecnum";
		if ((isset ($_REQUEST[$getownerrecnum])) && $_REQUEST[$getownerrecnum] != '')
		{
		              $ownerrecnum = $_REQUEST[$getownerrecnum];
        }
		 else
		{
		              $ownerrecnum = 'NULL';
		}
  	              	$getapprownerrecnum = $mytl[30] . "_apprrecnum";
		if ((isset ($_REQUEST[$getapprownerrecnum])) && $_REQUEST[$getapprownerrecnum] != '')
		{
		              $apprownerrecnum = $_REQUEST[$getapprownerrecnum];
		             //echo 'approvrec='.$apprownerrecnum;
	    }
	    else
	    {
		              $apprownerrecnum = 'NULL';
	    }
		  $getapprcontactrecnum = $mytl[1] . "_apprcrecnum";
		  if ((isset ($_REQUEST[$getapprcontactrecnum])) && $_REQUEST[$getapprcontactrecnum] != '')
		  {
		              $apprcontactrecnum = $_REQUEST[$getapprcontactrecnum];
		  }
		 else
		 {
		              $apprcontactrecnum = 'NULL';
		 }
		 if ( $mytl[10] != 'Cust')
		 {
		             $newDates->setlink2owner($ownerrecnum);
  		             $newDates->setlink2contact('NULL');
  		              //$newDates->setlink2approvedbyowner($apprownerrecnum);
		             $newDates->setlink2approvedbycontact('NULL');
		 }
		 else if ($mytl[10] == 'Cust')
		 {
		             $newDates->setlink2contact($contactrecnum);
		             $newDates->setlink2owner('NULL');
		             $newDates->setlink2approvedbyowner('NULL');
		             $newDates->setlink2approvedbycontact($apprcontactrecnum);
		 }
		 if ($mytl[8] != NULL)
		 {
		             $newDates->upddates($mytl[8], $worecnum,'WO');
		 }
		 else
		 {
		             $newDates->settype($wotype);
		             $newDates->setdoctype('WO');
		             $newDates->setlink2wfconfig($mytl[9]);
		             $newDates->adddates($worecnum);
		 }
	                 if ($comdate!='')
	                {
			if($apprownerrecnum !='' && $apprownerrecnum !='NULL')
		               {
				$x=$apprownerrecnum;
	             	               }
		               else
		               {
		               		$x=$_SESSION['userrecnum'];
		                }
			//$newapproval->updSignOff1($worecnum,$mytl[9],$mytl[1],$mytl[8],$comdate,$x);
	               }

		 $i++;
	    }

/********************************************** */
	$dyna_rows = $_REQUEST['msdynamic'];
	if($dyna_rows>=1){
	   $dynaWF = new dynamicworkflow();
		$dynaWF->setact_status('Active');
		$dynaWF->setallowcustdisp('N');
		$dynaWF->setallowprintdisp('Y');
		$dynaWF->setallowreportdisp('N');
		$dynaWF->setapprby('NULL');
		$dynaWF->setapprtype('I');
		$dynaWF->setcuststatusdisp('');
		$dynaWF->setdept('NULL');
		$dynaWF->setdoctype('WO');
		$dynaWF->setemaillist('SU');
		$dynaWF->setest_cost('NULL');
		$dynaWF->setest_time('NULL');
		$dynaWF->settype($wotype);
	}

    for($i=1;$i<=$dyna_rows;$i++)
     {

                $dept = 'deptdyna' . $i;
                $ms = 'msdyna' . $i;
		        $dates = 'datedyna' . $i;
		        $owner = 'ownerdyna' . $i;
                $emprecnum = 'emprecnumdyna' . $i;

		        $dynaWF->setdept($_REQUEST[$dept]);
                $dynaWF->setstatus($_REQUEST[$ms]);
		        $dynaWF->addDWFStage();

     	if((isset($_REQUEST[$owner])) && $_REQUEST[$owner] != ''){
		    $ownerrecnum = $_REQUEST[$emprecnum];
		}else{
			$ownerrecnum = 'NULL';
		}

		$dateval = $_REQUEST[$dates];
		$newDates->setschdue($dateval);
		$newDates->setlink2wfconfig($dynaWF->getrecnum());
		//$newDates->setlink2dwfconfig($dynaWF->getrecnum());
		$newDates->setlink2contact('NULL');
		$newDates->setLink2owner($ownerrecnum);
		$newDates->adddates($worecnum);
    }

 include("interprocess.php");

/***************************************** */
	    $sql = "commit";
	    $result = mysql_query($sql);
	    if(!$result) die("Commit failed for $wotype Update..Please report to Sysadmin. " . mysql_error());

        //header ( "Location: wordersummary.php" );

}


if ($pagename == 'wodetailsedit') {
     header ( "Location: woDetails.php?typenum=$typenum&wotype=$wotype&worecnum=$worecnum&wonum=$wonum" );
}
else {
       header ( "Location: worderSummary.php" );

}
?>
