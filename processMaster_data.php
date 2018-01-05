<?php



//==============================================
// Author: FSI                                 =
// Date-written = Mar 20, 2007                 =
// Filename: processQualityplan.php            =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OWT                          =
// Process of Quality Plan                     =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];

$pagename = $_SESSION['pagename'];
$dept =  $_SESSION['department'];
include('classes/masterdataClass.php');

// Next, create an instance of the classes required
$newMD = new masterdata;


if ($pagename == 'newmaster_data') {


    $partname = $_REQUEST["partname"];
   //$wonum = $_REQUEST["wonum"];
    $customer = $_REQUEST["customer"];
    $partnum = $_REQUEST["partnum"];
    $sec_partname = $_REQUEST["sec_partname"];
    $RM_by_CIM = $_REQUEST["RM_by_CIM"];
    $project = $_REQUEST["project"];
    $RM_by_customer = $_REQUEST["RM_by_customer"];
    $attachment = $_REQUEST["attachment"];
    $CIM_refnum = $_REQUEST["CIM_refnum"];
    $drg_issue = $_REQUEST["drg_issue"];
    $rm_type = $_REQUEST["rm_type"];
    $rm_spec = $_REQUEST["rm_spec"];
    $rm_dim1 = $_REQUEST["rm_dim1"];
    $rm_dim2 = $_REQUEST["rm_dim2"];
    $rm_dim3 = $_REQUEST["rm_dim3"];
    $mps_rev = $_REQUEST["mps_rev"];
    $mps_num = $_REQUEST["mps_num"];
    $drawing_num = $_REQUEST["drawing_num"];
    $cos = $_REQUEST["cos"];
    $condition = $_REQUEST["condition"];
    $treat=$_REQUEST['treat'];
    $max = $_REQUEST["max"];
    $gf =  $_REQUEST["gf"];
    $machine_name= $_REQUEST["machine_name"];
    $master_rev_status= $_REQUEST["master_rev_status"];
    $type= $_REQUEST["type"];
    $crnremarks= $_REQUEST["crnremarks"];
    $eng_app= $_REQUEST["eng_app"];
    $eng_app_by= $_REQUEST["eng_app_by"];
    $eng_app_date= $_REQUEST["eng_app_date"];
   	$newlogin = new userlogin;
				$newlogin->dbconnect();
				$sql = "start transaction";
 				$result = mysql_query($sql);

  				$newMD->setpartname($partname);
		  		$newMD->setSecPart($sec_partname);
			   	$newMD->setcustomer($customer);
   				$newMD->setpartnum($partnum);
	  			$newMD->setRM_by_CIM($RM_by_CIM);
		   		$newMD->setproject($project);
                $newMD->setRM_by_customer($RM_by_customer);
                $newMD->setCIM_refnum($CIM_refnum);
                $newMD->setdrg_issue($drg_issue);
                $newMD->setrm_type($rm_type);
                $newMD->setrm_spec($rm_spec);
                $newMD->setrm_dim1($rm_dim1);
                $newMD->setrm_dim2($rm_dim2);
                $newMD->setrm_dim3($rm_dim3);
                $newMD->setmps_rev($mps_rev);
                $newMD->setmps_num($mps_num);
                $newMD->setdrawing_num($drawing_num);
                $newMD->setcos($cos);
                $newMD->setgrainflow($gf);
                $newMD->setmaxruling($max);
                $newMD->setcondition($condition);
                $newMD->settreat($treat);
		        $newMD->setattachments($attachment);
		        $newMD->setmachine_name($machine_name);
		        $newMD->setmaster_rev_status($master_rev_status);
		        $newMD->settype($type);
                $newMD->setcrnremarks($crnremarks);
                $newMD->seteng_app($eng_app);
                $newMD->seteng_app_by($eng_app_by);
                $newMD->seteng_app_date($eng_app_date);

        $max=$_REQUEST['index'];
        $i=1;
        $flag=0;
        
      while ($i < $max)
      {
         $line_num="line_num" . $i;
         $mps_revision="mps_revision" . $i;
         $control="control" . $i;
         $remarks="remarks" . $i;
         $rev_status="rev_status" . $i;
         $rev_date="rev_date".$i;
         
         $line_num1=$_REQUEST[$line_num];
         $mps_revision1=$_REQUEST[$mps_revision];
         $control1=$_REQUEST[$control];
         $remarks1=$_REQUEST[$remarks];
         $rev_status1=$_REQUEST[$rev_status];
         $rev_date1=$_REQUEST[$rev_date];

		$sql = "start transaction";
		$result = mysql_query($sql);
		if($flag==0)
		{

   	  $masterdatarecnum = $newMD->addmaster_data();
		  $flag=1;
		}
		if ($line_num1 != '')
   		{
		  $newMD->setlinenum($line_num1);
		  $newMD->setmps_revition($mps_revision1);
		  $newMD->setcontrol($control1);
		  $newMD->setremarks($remarks1);
		  $newMD->setrev_status($rev_status1);
		  $newMD->setrev_date($rev_date1);
		  $newMD->addmps($masterdatarecnum);
		}
	     if(!$result)
	     {
		   $sql = "rollback";
		   $result = mysql_query($sql);
		   die("Commit failed for MPS..Please report to Sysadmin. " . mysql_errno());
	     }
       $i++;
	  }


	$sql = "commit";
        $result = mysql_query($sql);


}


if ($pagename == 'edit_master_data')
 {
 
               $attachment = $_REQUEST["attachment"];
               $masterdatarecnum = $_REQUEST["masterdatarecnum"];
               $partname = $_REQUEST["partname"];
               $sec_partname = $_REQUEST["sec_partname"];
               $customer = $_REQUEST["customer"];
               $partnum = $_REQUEST["partnum"];
               $RM_by_CIM = $_REQUEST["RM_by_CIM"];
               $project = $_REQUEST["project"];
               $RM_by_customer = $_REQUEST["RM_by_customer"];
               // $attachment = $_REQUEST["attachment"];
               $CIM_refnum = $_REQUEST["CIM_refnum"];
               $drg_issue = $_REQUEST["drg_issue"];
               $rm_type = $_REQUEST["rm_type"];
               $rm_spec = $_REQUEST["rm_spec"];
               $rm_dim1 = $_REQUEST["rm_dim1"];
               $rm_dim2 = $_REQUEST["rm_dim2"];
               $rm_dim3 = $_REQUEST["rm_dim3"];
			   
               
               $mps_rev = $_REQUEST["mps_rev"];
               $mps_num = $_REQUEST["mps_num"];
               $drawing_num = $_REQUEST["drawing_num"];
               $cos = $_REQUEST["cos"];
               $max = $_REQUEST["max"];
               $gf =  $_REQUEST["gf"];
               $condition =  $_REQUEST["condition"];
               $treat =  $_REQUEST["treat"];
               $machine_name =  $_REQUEST["machine_name"];
               $master_rev_status =  $_REQUEST["master_rev_status"];
               $type =  $_REQUEST["type"];
               $crnremarks= $_REQUEST["crnremarks"];
               $crnstatus= $_REQUEST["crnstatus"];
               $create_date= $_REQUEST["create_date"];
               $eng_app= $_REQUEST["eng_app"];
               $eng_app_by= $_REQUEST["eng_app_by"];
               $eng_app_date= $_REQUEST["eng_app_date"];
               //echo $director_app.'*---'.$director_app_by;
        	$newlogin = new userlogin;
		$newlogin->dbconnect();
		$sql = "start transaction";
 		$result = mysql_query($sql);


		$newMD->setpartname($partname);
  		$newMD->setSecPart($sec_partname);
	   	$newMD->setcustomer($customer);
		$newMD->setpartnum($partnum);
		$newMD->setRM_by_CIM($RM_by_CIM);
   		$newMD->setproject($project);
	        $newMD->setRM_by_customer($RM_by_customer);
        	$newMD->setCIM_refnum($CIM_refnum);
        	$newMD->setdrg_issue($drg_issue);
        	$newMD->setrm_type($rm_type);
        	$newMD->setrm_spec($rm_spec);
        	$newMD->setrm_dim1($rm_dim1);
        	$newMD->setrm_dim2($rm_dim2);
        	$newMD->setrm_dim3($rm_dim3);
        	$newMD->setmps_rev($mps_rev);
        	$newMD->setmps_num($mps_num);
        	$newMD->setdrawing_num($drawing_num);
        	$newMD->setcos($cos);
        	$newMD->setattachments($attachment);
        	$newMD->setgrainflow($gf);
        	$newMD->setmaxruling($max);
        	$newMD->setcondition($condition);
        	$newMD->settreat($treat);
        	$newMD->setmachine_name($machine_name);
        	$newMD->setmaster_rev_status($master_rev_status);
        	$newMD->settype($type);
       	    $newMD->setcrnremarks($crnremarks);
	        $newMD->setcrnstatus($crnstatus);
	        $newMD->setcreate_date($create_date);
	        $newMD->seteng_app($eng_app);
            $newMD->seteng_app_by($eng_app_by);
            $newMD->seteng_app_date($eng_app_date);
	
		$newMD->updatemaster_data($masterdatarecnum);
		
		$i=1;
		$max=$_REQUEST['index'];
//echo $max.'--<br>';
		while($i<$max)
		{
//echo $i;
	        	$line_num="line_num" . $i;
	
         		$mps_revision="mps_revision" . $i;
		        $control="control" . $i;
         		$remarks="remarks" . $i;
         		$rev_status="rev_status" . $i;
         		$rev_date="rev_date".$i;
         		$prevlinenum="prevlinenum" . $i;
	     		$lirecnum="lirecnum" . $i;
//echo "In process page".$prevlinenum;   
         		$lirecnum1=$_REQUEST[$lirecnum];
	 		$prevlinenum1=$_REQUEST[$prevlinenum];

         		$line_num1=$_REQUEST[$line_num];
//echo $line_num."===line_num====".$line_num1."===<br>";
//echo $prevlinenum."===prevlinenum====".$prevlinenum1."===<br>";
         		$mps_revision1=$_REQUEST[$mps_revision];
         		$control1=$_REQUEST[$control];
         		$remarks1=$_REQUEST[$remarks];
         		$rev_status1=$_REQUEST[$rev_status];
		 	$rev_date1=$_REQUEST[$rev_date];

         
         		if ($line_num1 != '')
         		{

          			$newMD->setlinenum($line_num1);
  				$newMD->setmps_revition($mps_revision1);
		  		$newMD->setcontrol($control1);
		  		$newMD->setremarks($remarks1);
		  		$newMD->setrev_status($rev_status1);
		  		$newMD->setrev_date($rev_date1);

//echo "prevlinenum1  :  --" . $prevlinenum1."--";
          			if($prevlinenum1!='')
          			{
//echo "in updategrnli";
				$newMD->updatemps($lirecnum1);
	  			}else
	  			{
//echo "in addgrnli";
            			$newMD->addmps($masterdatarecnum);
  				}
	    		}
	    		else
	    		{
         			if ($prevlinenum1 != ''){
           				$newMD->deletemps($lirecnum1);
         			}
	    		}        

	     		if(!$result)
	     		{
		   		$sql = "rollback";
		   		$result = mysql_query($sql);
		   		die("Commit failed for MPS..Please report to Sysadmin. " . mysql_errno());
	     		}

	        	$i++;
       		
		}

		$sql = "commit";
        	$result = mysql_query($sql);
		
 }
 if($pagename=='master_datadetails4engapp')
 {
    //echo $_REQUEST["eng_app"]."------------";
    $eng_app= $_REQUEST["eng_app"];
    $eng_app_by= $_REQUEST["eng_app_by"];
    $eng_app_date= $_REQUEST["eng_app_date"];
    $masterdatarecnum=$_REQUEST["masterdatarecnum"];
    
    $newMD->seteng_app($eng_app);
    $newMD->seteng_app_by($eng_app_by);
    $newMD->seteng_app_date($eng_app_date);
    $newMD->updatemaster_data4eng($masterdatarecnum);
 }
 
if($dept=='Sales' || $dept=='ENGAPP' ){


header("Location:masterSummary.php");
} else{
header("Location:masterSummary.php");
}

?>
