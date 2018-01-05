<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = April 27,2010                =
// Filename: processBOM.php                    =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OWT                          =
// Allows processing of BOMs                =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ("Location:login.php");

}
$userid = $_SESSION['user'];

$pagename = $_SESSION['pagename'];

$dept=$_SESSION['department'];

include('classes/bomClass.php');
include('classes/bomliClass.php');
include('classes/bomli_mfgClass.php');
include('classes/bomli_treatedClass.php');
include('classes/bomli_boughtClass.php');
include('classes/bomli_consumeClass.php');
include('classes/bomli_opnClass.php');
include('classes/bom_subassyClass.php');

// Next, create an instance of the classes required
$newBOM = new bom;
$newBOMLI_mfg = new bomli_mfg_items;
$newBOMLI_treat = new bomli_treat_items;
$newBOMLI_bought = new bomli_bought_items;
$newBOMLI_consume = new bomli_consume_items;
$newBOM_oper = new bomli_op;
$newBOMLI_subassy = new bomli_subassy_items;


if ($pagename == 'new_bom' || $pagename == 'edit_bom') 
{

  $bomnum = $_REQUEST['bomnum'];
  $bomissue = $_REQUEST['bom_issue'];
  $crn = $_REQUEST['crn'];
  $assy_part = $_REQUEST['assy_part'];
  $title = $_REQUEST['title'];
  $issue = $_REQUEST['issue'];
  $cos_no = $_REQUEST['cos_no'];
  $cos_iss = $_REQUEST['cos_iss'];
  $drg_no = $_REQUEST['drg_no'];
  $bomrevnum = $_REQUEST['bomrevnum'];
  $eng_app= $_REQUEST["eng_app_1"];
  $eng_app_by= $_REQUEST["eng_app_by"];
  $eng_app_date= $_REQUEST["eng_app_date"];
  $bomnotes= $_REQUEST["notes"];
  $create_date= $_REQUEST["create_date"];
  $partiss= $_REQUEST["partiss"];
  $assywonum= $_REQUEST["assywonum"];
  $link2assywo= $_REQUEST["link2assywo"];
}

if ($pagename == 'new_bom') 
{
	$i=1;
	$j=1;
	$k=1;
	$l=1;
	$z=1;
	$m=1;
	$flag=0;

	$status= 'Pending';
	$max_mfg=$_REQUEST['index'];
	$max_bought=$_REQUEST['boindex'];
	$max_consume=$_REQUEST['coindex'];
	$max_oper=$_REQUEST['opindex'];
	$max_suassy=$_REQUEST['index_assy'];
	$max_treated=$_REQUEST['index_treated'];
	
  $newlogin = new userlogin;
  $newlogin->dbconnect();
  $newBOM->setbomnum($bomnum);
 	$newBOM->setbom_issue($bomissue);
 	$newBOM->setcrn($crn);
  $newBOM->setassy_part($assy_part);
  $newBOM->settitle($title);
  $newBOM->setissue($issue);
 	$newBOM->setcos_no($cos_no);
 	$newBOM->setcos_iss($cos_iss);
  $newBOM->setdrg_no($drg_no);
  $newBOM->setbomrevnum($bomrevnum);
  $newBOM->seteng_app($eng_app);
  $newBOM->seteng_app_by($eng_app_by);
  $newBOM->seteng_app_date($eng_app_date);
  $newBOM->setstatus($status);
  $newBOM->setpartiss($partiss);
  $newBOM->setassywonum($assywonum);
  $newBOM->setlink2assywo($link2assywo);
    
  $sql = "start transaction";
  $result = mysql_query($sql);
  $bomrecnum=$newBOM->addBOM();
  $flag=1;

	while($i<=$max_mfg)
	{
    $linenumber="linenum" . $i;
    $itemno="itemno" . $i;
    $partno="partno" . $i;
    $crn="crn" . $i;
    $partname="partname" . $i;
    $partiss="partiss" . $i;
    $drgiss="drgiss" . $i;
    $mpsnum="mpsnum" . $i;
    $mpsrev="mpsrev" . $i;
    $attach="attach" . $i;
    $qpa="qpa" . $i;
    $crn_type="crn_type" . $i;
		$cos="cos" . $i;

		$line_num1= $_REQUEST[$linenumber];
		$itemno1 = $_REQUEST[$itemno];
		$partno1 = $_REQUEST[$partno];
		$crn1 = $_REQUEST[$crn];
		$partname1 = $_REQUEST[$partname];
		$partiss1 = $_REQUEST[$partiss];
		$drgiss1 = $_REQUEST[$drgiss];
		$mpsnum1 = $_REQUEST[$mpsnum];
		$mpsrev1 = $_REQUEST[$mpsrev];
		$attach1 = $_REQUEST[$attach];
		$qpa1 = $_REQUEST[$qpa];
    $crn_type1 = $_REQUEST[$crn_type];
		$cos1 = $_REQUEST[$cos];
		if ($line_num1 != '')
		{
			if ($pagename == 'new_bom')
			{

				$newBOMLI_mfg->setlink2bom($bomrecnum);
				$newBOMLI_mfg->setlinenum($line_num1);
				$newBOMLI_mfg->setitemno($itemno1);
				$newBOMLI_mfg->setpartnum($partno1);
				$newBOMLI_mfg->setcrn($crn1);
				$newBOMLI_mfg->setpartname($partname1);
				$newBOMLI_mfg->setpartiss($partiss1);
				$newBOMLI_mfg->setdrgiss($drgiss1);
				$newBOMLI_mfg->setmpsnum($mpsnum1);
				$newBOMLI_mfg->setmpsrev($mpsrev1);
				$newBOMLI_mfg->setattach($attach1);
				$newBOMLI_mfg->setqpa($qpa1);
	    	$newBOMLI_mfg->setcrn_type($crn_type1);
				$newBOMLI_mfg->setcos_num($cos1);
				$newBOMLI_mfg->addLI();
			}
		}
		$i++;
	}

	while($m<=$max_treated)
	{

    $tr_linenumber="tr_linenum" . $m;
    $tr_itemno="tr_itemno" . $m;
    $tr_partno="tr_partno" . $m;
    $tr_crn="tr_crn" . $m;
    $tr_partname="tr_partname" . $m;
    $tr_partiss="tr_partiss" . $m;
    $tr_drgiss="tr_drgiss" . $m;
    $tr_mpsnum="tr_mpsnum" . $m;
    $tr_mpsrev="tr_mpsrev" . $m;
    $tr_attach="tr_attach" . $m;
    $tr_qpa="tr_qpa" . $m;
    $tr_crn_type="tr_crn_type" . $m;
		$tr_cos="tr_cos" . $m;

		$tr_line_num1= $_REQUEST[$tr_linenumber];
		$tr_itemno1 = $_REQUEST[$tr_itemno];
		$tr_partno1 = $_REQUEST[$tr_partno];
		$tr_crn1 = $_REQUEST[$tr_crn];
		$tr_partname1 = $_REQUEST[$tr_partname];
		$tr_partiss1 = $_REQUEST[$tr_partiss];
		$tr_drgiss1 = $_REQUEST[$tr_drgiss];
		$tr_mpsnum1 = $_REQUEST[$tr_mpsnum];
		$tr_mpsrev1 = $_REQUEST[$tr_mpsrev];
		$tr_attach1 = $_REQUEST[$tr_attach];
		$tr_qpa1 = $_REQUEST[$tr_qpa];
    $tr_crn_type1 = $_REQUEST[$tr_crn_type];
		$tr_cos1 = $_REQUEST[$tr_cos];

		if ($tr_line_num1 != '')
		{
			if ($pagename == 'new_bom')
			{
				$newBOMLI_treat->setlink2bom($bomrecnum);
				$newBOMLI_treat->setlinenum($tr_line_num1);
				$newBOMLI_treat->setitemno($tr_itemno1);
				$newBOMLI_treat->setpartnum($tr_partno1);
				$newBOMLI_treat->setcrn($tr_crn1);
				$newBOMLI_treat->setpartname($tr_partname1);
				$newBOMLI_treat->setpartiss($tr_partiss1);
				$newBOMLI_treat->setdrgiss($tr_drgiss1);
				$newBOMLI_treat->setmpsnum($tr_mpsnum1);
				$newBOMLI_treat->setmpsrev($tr_mpsrev1);
				$newBOMLI_treat->setattach($tr_attach1);
				$newBOMLI_treat->setqpa($tr_qpa1);
        $newBOMLI_treat->setcrn_type($tr_crn_type1);
				$newBOMLI_treat->setcos_num($tr_cos1);
				$newBOMLI_treat->addLI();
			}
		}
		$m++;
	}

	while($z<=$max_suassy)
	{
    $as_linenumber="as_linenum" . $z;
    $as_itemno="as_itemno" . $z;
    $as_partno="as_partno" . $z;
    $as_crn="as_crn" . $z;
    $as_partname="as_partname" . $z;
    $as_partiss="as_partiss" . $z;
    $as_drgiss="as_drgiss" . $z;
    $as_mpsnum="as_mpsnum" . $z;
    $as_mpsrev="as_mpsrev" . $z;
    $as_attach="as_attach" . $z;
    $as_qpa="as_qpa" . $z;
    $as_crn_type="as_crn_type" . $z;
		$as_cos="as_cos" . $z;

    $as_line_num1= $_REQUEST[$as_linenumber];
    $as_itemno1 = $_REQUEST[$as_itemno];
		$as_partno1 = $_REQUEST[$as_partno];
		$as_crn1 = $_REQUEST[$as_crn];
		$as_partname1 = $_REQUEST[$as_partname];
		$as_partiss1 = $_REQUEST[$as_partiss];
		$as_drgiss1 = $_REQUEST[$as_drgiss];
		$as_mpsnum1 = $_REQUEST[$as_mpsnum];
		$as_mpsrev1 = $_REQUEST[$as_mpsrev];
		$as_attach1 = $_REQUEST[$as_attach];
		$as_qpa1 = $_REQUEST[$as_qpa];
		$as_crn_type1 = $_REQUEST[$as_crn_type];
		$as_cos1 = $_REQUEST[$as_cos];

		if ($as_line_num1 != '')
		{
			if ($pagename == 'new_bom')
			{
				$newBOMLI_subassy->setlink2bom($bomrecnum);
				$newBOMLI_subassy->setlinenum($as_line_num1);
				$newBOMLI_subassy->setitemno($as_itemno1);
				$newBOMLI_subassy->setpartnum($as_partno1);
				$newBOMLI_subassy->setcrn($as_crn1);
				$newBOMLI_subassy->setpartname($as_partname1);
				$newBOMLI_subassy->setpartiss($as_partiss1);
				$newBOMLI_subassy->setdrgiss($as_drgiss1);
				$newBOMLI_subassy->setmpsnum($as_mpsnum1);
				$newBOMLI_subassy->setmpsrev($as_mpsrev1);
				$newBOMLI_subassy->setattach($as_attach1);
				$newBOMLI_subassy->setqpa($as_qpa1);
        $newBOMLI_subassy->setcrn_type($as_crn_type1);
				$newBOMLI_subassy->setcos_num($as_cos1);
				$newBOMLI_subassy->addLI();
			}
		}
		$z++;
	}


	while($j<=$max_bought)
	{
    $bo_linenumber="bo_linenum" . $j;
    $bo_itemno="bo_itemno" . $j;
    $bo_desc="bo_desc" . $j;
    $bo_partnum="bo_partnum" . $j;
    $bo_partiss="bo_partiss" . $j;
    $bo_drgno="bo_drgno" . $j;
    $bo_issue="bo_issue" . $j;
    $bo_supp="bo_supp" . $j;
    $bo_qpa="bo_qpa" . $j;

		$line_num1= $_REQUEST[$bo_linenumber];
		$itemno1 = $_REQUEST[$bo_itemno];
		$desc1 = $_REQUEST[$bo_desc];
		$partnum1 = $_REQUEST[$bo_partnum];
		$partiss1 = $_REQUEST[$bo_partiss];
		$drgno1 = $_REQUEST[$bo_drgno];
		$issue1 = $_REQUEST[$bo_issue];
		$supp1 = $_REQUEST[$bo_supp];
		$qpa1 = $_REQUEST[$bo_qpa];

		if ($line_num1 != '')
		{
			if ($pagename == 'new_bom')
			{
				$newBOMLI_bought->setlink2bom($bomrecnum);
				$newBOMLI_bought->setlinenum($line_num1);
				$newBOMLI_bought->setitemno($itemno1);
				$newBOMLI_bought->setdescr($desc1);
				$newBOMLI_bought->setdrg_no($drgno1);
				$newBOMLI_bought->setissue($issue1);
				$newBOMLI_bought->setsupplier($supp1);
				$newBOMLI_bought->setpartnum($partnum1);
				$newBOMLI_bought->setpartiss($partiss1);
				$newBOMLI_bought->setqpa($qpa1);
				$newBOMLI_bought->addLI();
			}
		}
		$j++;
	}

	while($k<=$max_consume)
	{
    $co_linenumber="co_linenum" . $k;
    $co_itemno="co_itemno" . $k;
    $co_desc="co_desc" . $k;
    $co_spec="co_spec" . $k;
    $co_issue="co_issue" . $k;
    $co_supp="co_supp" . $k;
    $co_qpa="co_qpa" . $k;
		$co_partnum="co_partnum" . $k;

		$line_num1= $_REQUEST[$co_linenumber];
		$itemno1 = $_REQUEST[$co_itemno];
		$desc1 = $_REQUEST[$co_desc];
		$spec1 = $_REQUEST[$co_spec];
		$issue1 = $_REQUEST[$co_issue];
		$supp1 = $_REQUEST[$co_supp];
		$qpa1 = $_REQUEST[$co_qpa];
		$co_partnum1 = $_REQUEST[$co_partnum];

		if ($line_num1 != '')
		{
			if ($pagename == 'new_bom')
			{
				$newBOMLI_consume->setlink2bom($bomrecnum);
				$newBOMLI_consume->setlinenum($line_num1);
				$newBOMLI_consume->setitemno($itemno1);
				$newBOMLI_consume->setdescr($desc1);
				$newBOMLI_consume->setspec($spec1);
				$newBOMLI_consume->setissue($issue1);
				$newBOMLI_consume->setsupplier($supp1);
				$newBOMLI_consume->setqpa($qpa1);
				$newBOMLI_consume->setpartnum($co_partnum1);
				$newBOMLI_consume->addLI();
			}
		}
		$k++;
	}

	while($l<=$max_oper)
	{
    $opn="opn" . $l;
    $stn="stn" . $l;
    $desc="desc" . $l;
    $signoff="signoff" . $l;
    $remarks="remarks" . $l;

		$opn1= $_REQUEST[$opn];
		$stn1 = $_REQUEST[$stn];
		$desc1 = $_REQUEST[$desc];
		$signoff1 = $_REQUEST[$signoff];
		$remarks1 = $_REQUEST[$remarks];

		if ($opn1 != '')
		{
			if ($pagename == 'new_bom')
			{
	      $newBOM_oper->setlink2bom($bomrecnum);
				$newBOM_oper->setopn($opn1);
				$newBOM_oper->setstn($stn1);
				$newBOM_oper->setdescr($desc1);
				$newBOM_oper->setsignoff($signoff1);
				$newBOM_oper->setremarks($remarks1);
				$newBOM_oper->addLI();
			}
		}
		$l++;
	}
	$sql = "commit";
	$result = mysql_query($sql);
	if(!$result)
	{
		 $sql = "rollback";
		 $result = mysql_query($sql);
		 die("Commit failed for BOM LI Insert..Please report to Sysadmin. " . mysql_errno());
	}
	header("Location:bom.php" );
}

if ($pagename == 'edit_bom')
{
//echo "i am inside dispatchupdate";
$bomrecnum = $_REQUEST['bomrecnum'];
$status= $_REQUEST["status"];
$i=1;
$j=1;
$k=1;
$l=1;
$z=1;
$m=1;

$max_mfg=$_REQUEST['index'];
$max_bought=$_REQUEST['boindex'];
$max_consume=$_REQUEST['coindex'];
$max_oper=$_REQUEST['opindex'];
$max_suassy=$_REQUEST['index_assy'];
$max_treated=$_REQUEST['index_treated'];


$flag=0;
   				$newlogin = new userlogin;
				$newlogin->dbconnect();

  				$sql = "start transaction";
 				$result = mysql_query($sql);

			  $newBOM->setbomnum($bomnum);
              $newBOM->setbom_issue($bomissue);
   	          $newBOM->setcrn($crn);
              $newBOM->setassy_part($assy_part);
              $newBOM->settitle($title);
              $newBOM->setissue($issue);
   	          $newBOM->setcos_no($cos_no);
   	          $newBOM->setcos_iss($cos_iss);
              $newBOM->setdrg_no($drg_no);
              $newBOM->setbomrevnum($bomrevnum);
              $newBOM->seteng_app($eng_app);
              $newBOM->seteng_app_by($eng_app_by);
              $newBOM->seteng_app_date($eng_app_date);
              $newBOM->setcreate_date($create_date);
              $newBOM->setstatus($status);
              $newBOM->setpartiss($partiss);
              
              $newBOM->updateBom($bomrecnum);
              $newBOM->addbomnotes($bomrecnum,$bomnotes);
              $flag=1;
 			        //echo 'after dispatch'.$disprecnum;

while($i<=$max_mfg)
{
	//echo "i am inside while loop" .$i;
        $linenumber="linenum" . $i;
        $itemno="itemno" . $i;
        $partno="partno" . $i;
        $crn="crn" . $i;
        $partname="partname" . $i;
        $partiss="partiss" . $i;
        $drgiss="drgiss" . $i;
        $mpsnum="mpsnum" . $i;
        $mpsrev="mpsrev" . $i;
        $attach="attach" . $i;
        $qpa="qpa" . $i;
        $crn_type="crn_type" . $i;
        $cos="cos" . $i;

        $prevlinenum="prev_line_num_mfg" . $i;
        $lirecnum="lirecnum_mfg" . $i;

	$prevlinenum1=$_REQUEST[$prevlinenum];
	$lirecnum1=$_REQUEST[$lirecnum];

    $line_num1= $_REQUEST[$linenumber];
	$itemno1 = $_REQUEST[$itemno];
	$partno1 = $_REQUEST[$partno];
	$crn1 = $_REQUEST[$crn];
	$partname1 = $_REQUEST[$partname];
	$partiss1 = $_REQUEST[$partiss];
	$drgiss1 = $_REQUEST[$drgiss];
	$mpsnum1 = $_REQUEST[$mpsnum];
	$mpsrev1 = $_REQUEST[$mpsrev];
	$attach1 = $_REQUEST[$attach];
	$qpa1 = $_REQUEST[$qpa];
    $crn_type1 = $_REQUEST[$crn_type];
      $cos1 = $_REQUEST[$cos];
	$newlogin = new userlogin;
	$newlogin->dbconnect();

	//echo "<br>Values for line number   :$linenumber1<br>$itemname1<br>$itemdesc1<br>$qty1<br>$rate1<br>$duedate1";
	if ($line_num1 != '')
	{


            $newBOMLI_mfg->setlink2bom($bomrecnum);
			$newBOMLI_mfg->setlinenum($line_num1);
			$newBOMLI_mfg->setitemno($itemno1);
			$newBOMLI_mfg->setpartnum($partno1);
			$newBOMLI_mfg->setcrn($crn1);
			$newBOMLI_mfg->setpartname($partname1);
			$newBOMLI_mfg->setpartiss($partiss1);
			$newBOMLI_mfg->setdrgiss($drgiss1);
			$newBOMLI_mfg->setmpsnum($mpsnum1);
			$newBOMLI_mfg->setmpsrev($mpsrev1);
			$newBOMLI_mfg->setattach($attach1);
			$newBOMLI_mfg->setqpa($qpa1);
            $newBOMLI_mfg->setcrn_type($crn_type1);
            $newBOMLI_mfg->setcos_num($cos1);


           if($prevlinenum1!='')
			{
				$newBOMLI_mfg->updateLI($lirecnum1);
			}
			else
			{
               $newBOMLI_mfg->setlink2bom($bomrecnum);
      		   $newBOMLI_mfg->addLI();
			}
	}
	else
	{
		 if ($prevlinenum1 != '')
		 {
			 $newBOMLI_mfg->deleteLI($lirecnum1);
		  }
	}
$i++;
}

while($m<=$max_treated)
{
        $tr_linenumber="tr_linenum" . $m;
        $tr_itemno="tr_itemno" . $m;
        $tr_partno="tr_partno" . $m;
        $tr_crn="tr_crn" . $m;
        $tr_partname="tr_partname" . $m;
        $tr_partiss="tr_partiss" . $m;
        $tr_drgiss="tr_drgiss" . $m;
        $tr_mpsnum="tr_mpsnum" . $m;
        $tr_mpsrev="tr_mpsrev" . $m;
        $tr_attach="tr_attach" . $m;
        $tr_qpa="tr_qpa" . $m;
        $tr_crn_type="tr_crn_type" . $m;
		$tr_cos="tr_cos" . $m;
        $tr_prevlinenum="tr_prev_line_num" . $m;
        $tr_lirecnum="tr_lirecnum" . $m;



    $tr_prevlinenum1=$_REQUEST[$tr_prevlinenum];
	$tr_lirecnum1=$_REQUEST[$tr_lirecnum];
	$tr_line_num1= $_REQUEST[$tr_linenumber];
	$tr_itemno1 = $_REQUEST[$tr_itemno];
	$tr_partno1 = $_REQUEST[$tr_partno];
	$tr_crn1 = $_REQUEST[$tr_crn];
	$tr_partname1 = $_REQUEST[$tr_partname];
	$tr_partiss1 = $_REQUEST[$tr_partiss];
	$tr_drgiss1 = $_REQUEST[$tr_drgiss];
	$tr_mpsnum1 = $_REQUEST[$tr_mpsnum];
	$tr_mpsrev1 = $_REQUEST[$tr_mpsrev];
	$tr_attach1 = $_REQUEST[$tr_attach];
	$tr_qpa1 = $_REQUEST[$tr_qpa];
    $tr_crn_type1 = $_REQUEST[$tr_crn_type];
	$tr_cos1 = $_REQUEST[$tr_cos];




	$newlogin = new userlogin;
	$newlogin->dbconnect();

	if ($tr_line_num1 != '')
	{
		
			$newBOMLI_treat->setlink2bom($bomrecnum);
			$newBOMLI_treat->setlinenum($tr_line_num1);
			$newBOMLI_treat->setitemno($tr_itemno1);
			$newBOMLI_treat->setpartnum($tr_partno1);
			$newBOMLI_treat->setcrn($tr_crn1);
			$newBOMLI_treat->setpartname($tr_partname1);
			$newBOMLI_treat->setpartiss($tr_partiss1);
			$newBOMLI_treat->setdrgiss($tr_drgiss1);
			$newBOMLI_treat->setmpsnum($tr_mpsnum1);
			$newBOMLI_treat->setmpsrev($tr_mpsrev1);
			$newBOMLI_treat->setattach($tr_attach1);
			$newBOMLI_treat->setqpa($tr_qpa1);
            $newBOMLI_treat->setcrn_type($tr_crn_type1);
			$newBOMLI_treat->setcos_num($tr_cos1);



		if($tr_prevlinenum1!='')
			{

				// echo "reached  " .$tr_prevlinenum1;
			 	$newBOMLI_treat->updateLI($tr_lirecnum1);
			}
			else
			{

				// echo "reached1";exit;
               $newBOMLI_treat->setlink2bom($bomrecnum);
      		   $newBOMLI_treat->addLI();
			}
	}
	else
	{
		 if ($tr_prevlinenum1 != '')
		 {
			 $newBOMLI_treat->deleteLI($tr_lirecnum1);
		  }
	}
$m++;
}
//echo $max_suassy."-*--*-*-*".$z;
while($z<=$max_suassy)
{
        $as_linenumber="as_linenum" . $z;
        $as_itemno="as_itemno" . $z;
        $as_partno="as_partno" . $z;
        $as_crn="as_crn" . $z;
        $as_partname="as_partname" . $z;
        $as_partiss="as_partiss" . $z;
        $as_drgiss="as_drgiss" . $z;
        $as_mpsnum="as_mpsnum" . $z;
        $as_mpsrev="as_mpsrev" . $z;
        $as_attach="as_attach" . $z;
        $as_qpa="as_qpa" . $z;
        $as_crn_type="as_crn_type" . $z;

	$as_line_num1= $_REQUEST[$as_linenumber];
	$as_itemno1 = $_REQUEST[$as_itemno];
	$as_partno1 = $_REQUEST[$as_partno];
	$as_crn1 = $_REQUEST[$as_crn];
	$as_partname1 = $_REQUEST[$as_partname];
	$as_partiss1 = $_REQUEST[$as_partiss];
	$as_drgiss1 = $_REQUEST[$as_drgiss];
	$as_mpsnum1 = $_REQUEST[$as_mpsnum];
	$as_mpsrev1 = $_REQUEST[$as_mpsrev];
	$as_attach1 = $_REQUEST[$as_attach];
	$as_qpa1 = $_REQUEST[$as_qpa];
    $as_crn_type1 = $_REQUEST[$as_crn_type];
    
    $prevlinenum_assy="prev_line_num_assy" . $z;
    $lirecnum_assy="lirecnum_assy" . $z;

	$prevlinenum_assy1=$_REQUEST[$prevlinenum_assy];
	$lirecnum_assy1=$_REQUEST[$lirecnum_assy];
//	echo "<br>Values for line number   :$as_line_num1...........$lirecnum_assy1";
	if ($as_line_num1 != '')
	{

			$newBOMLI_subassy->setlink2bom($bomrecnum);
			$newBOMLI_subassy->setlinenum($as_line_num1);
			$newBOMLI_subassy->setitemno($as_itemno1);
			$newBOMLI_subassy->setpartnum($as_partno1);
			$newBOMLI_subassy->setcrn($as_crn1);
			$newBOMLI_subassy->setpartname($as_partname1);
			$newBOMLI_subassy->setpartiss($as_partiss1);
			$newBOMLI_subassy->setdrgiss($as_drgiss1);
			$newBOMLI_subassy->setmpsnum($as_mpsnum1);
			$newBOMLI_subassy->setmpsrev($as_mpsrev1);
			$newBOMLI_subassy->setattach($as_attach1);
			$newBOMLI_subassy->setqpa($as_qpa1);
            $newBOMLI_subassy->setcrn_type($as_crn_type1);
        if($prevlinenum_assy1!='')
			{
			 	$newBOMLI_subassy->updateLI($lirecnum_assy1);
			}
			else
			{
               $newBOMLI_subassy->setlink2bom($bomrecnum);
      		   $newBOMLI_subassy->addLI();
			}
	}
	else
	{
		 if ($prevlinenum_assy1 != '')
		 {
			 $newBOMLI_subassy->deleteLI($lirecnum_assy1);
		  }
	}
	$z++;
}

while($j<=$max_bought)
{
	//echo "i am inside while loop" .$i;
        $bo_linenumber="bo_linenum" . $j;
        $bo_itemno="bo_itemno" . $j;
        $bo_desc="bo_desc" . $j;
        $bo_partnum="bo_partnum" . $j;
        $bo_partiss="bo_partiss" . $j;
        $bo_drgno="bo_drgno" . $j;
        $bo_issue="bo_issue" . $j;
        $bo_supp="bo_supp" . $j;
        $bo_qpa="bo_qpa" . $j;
        
        $prevlinenum="prev_line_num_bo" . $j;
        $lirecnum="lirecnum_bo" . $j;

	$prevlinenum1=$_REQUEST[$prevlinenum];
	$lirecnum1=$_REQUEST[$lirecnum];

	$line_num1= $_REQUEST[$bo_linenumber];
	$itemno1 = $_REQUEST[$bo_itemno];
	$desc1 = $_REQUEST[$bo_desc];
	$partnum1 = $_REQUEST[$bo_partnum];
	$partiss1 = $_REQUEST[$bo_partiss];
	$drgno1 = $_REQUEST[$bo_drgno];
	$issue1 = $_REQUEST[$bo_issue];
	$supp1 = $_REQUEST[$bo_supp];
	$qpa1 = $_REQUEST[$bo_qpa];


	$newlogin = new userlogin;
	$newlogin->dbconnect();

	//echo "<br>Values for line number   :$linenumber1<br>$itemname1<br>$itemdesc1<br>$qty1<br>$rate1<br>$duedate1";
	if ($line_num1 != '')
	{


            $newBOMLI_bought->setlink2bom($bomrecnum);
			$newBOMLI_bought->setlinenum($line_num1);
			$newBOMLI_bought->setitemno($itemno1);
			$newBOMLI_bought->setdescr($desc1);
			$newBOMLI_bought->setdrg_no($drgno1);
			$newBOMLI_bought->setissue($issue1);
			$newBOMLI_bought->setsupplier($supp1);
			$newBOMLI_bought->setpartnum($partnum1);
			$newBOMLI_bought->setpartiss($partiss1);
			$newBOMLI_bought->setqpa($qpa1);

            if($prevlinenum1!='')
			{
			 	$newBOMLI_bought->updateLI($lirecnum1);
			}
			else
			{
               $newBOMLI_bought->setlink2bom($bomrecnum);
      		   $newBOMLI_bought->addLI();
			}
	}
	else
	{
		 if ($prevlinenum1 != '')
		 {
			 $newBOMLI_bought->deleteLI($lirecnum1);
		  }
	}
$j++;
}

while($k<=$max_consume)
{
	//echo "i am inside while loop" .$i;
        $co_linenumber="co_linenum" . $k;
        $co_itemno="co_itemno" . $k;
        $co_desc="co_desc" . $k;
        $co_spec="co_spec" . $k;
        $co_issue="co_issue" . $k;
        $co_supp="co_supp" . $k;
        $co_qpa="co_qpa" . $k;
		$co_partnum="co_partnum" . $k;

        $prevlinenum="prev_line_num_co" . $k;
        $lirecnum="lirecnum_co" . $k;

	$prevlinenum1=$_REQUEST[$prevlinenum];
	$lirecnum1=$_REQUEST[$lirecnum];

    $line_num1= $_REQUEST[$co_linenumber];
	$itemno1 = $_REQUEST[$co_itemno];
	$desc1 = $_REQUEST[$co_desc];
	$spec1 = $_REQUEST[$co_spec];
	$issue1 = $_REQUEST[$co_issue];
	$supp1 = $_REQUEST[$co_supp];
	$qpa1 = $_REQUEST[$co_qpa];
    $co_partnum1 = $_REQUEST[$co_partnum];


	$newlogin = new userlogin;
	$newlogin->dbconnect();

	if ($line_num1 != '')
	{


            $newBOMLI_consume->setlink2bom($bomrecnum);
			$newBOMLI_consume->setlinenum($line_num1);
			$newBOMLI_consume->setitemno($itemno1);
			$newBOMLI_consume->setdescr($desc1);
			$newBOMLI_consume->setspec($spec1);
			$newBOMLI_consume->setissue($issue1);
			$newBOMLI_consume->setsupplier($supp1);
			$newBOMLI_consume->setqpa($qpa1);
			$newBOMLI_consume->setpartnum($co_partnum1);

            if($prevlinenum1!='')
			{
			 	$newBOMLI_consume->updateLI($lirecnum1);
			}
			else
			{
               $newBOMLI_consume->setlink2bom($bomrecnum);
      		   $newBOMLI_consume->addLI();
			}
	}
	else
	{
		 if ($prevlinenum1 != '')
		 {
			 $newBOMLI_consume->deleteLI($lirecnum1);
		  }
	}
$k++;
}

while($l<=$max_oper)
{
        $opn="opn" . $l;
        $stn="stn" . $l;
        $desc="desc" . $l;
        $signoff="signoff" . $l;
        $remarks="remarks" . $l;

        $prevlinenum="prev_line_num_op" . $l;
        $lirecnum="lirecnum_op" . $l;

  	    $prevlinenum1=$_REQUEST[$prevlinenum];
  	    $lirecnum1=$_REQUEST[$lirecnum];

        $opn1= $_REQUEST[$opn];
	    $stn1 = $_REQUEST[$stn];
	    $desc1 = $_REQUEST[$desc];
	    $signoff1 = $_REQUEST[$signoff];
	    $remarks1 = $_REQUEST[$remarks];


	$newlogin = new userlogin;
	$newlogin->dbconnect();

	if ($opn1 != '')
	{
            $newBOM_oper->setlink2bom($bomrecnum);
			$newBOM_oper->setopn($opn1);
			$newBOM_oper->setstn($stn1);
			$newBOM_oper->setdescr($desc1);
			$newBOM_oper->setsignoff($signoff1);
			$newBOM_oper->setremarks($remarks1);

            if($prevlinenum1!='')
			{
			 	$newBOM_oper->updateLI($lirecnum1);
			}
			else
			{
               $newBOM_oper->setlink2bom($bomrecnum);
      		   $newBOM_oper->addLI();
			}
	}
	else
	{
		 if ($prevlinenum1 != '')
		 {
			 $newBOM_oper->deleteLI($lirecnum1);
	     }
	}
$l++;
}
	 $sql = "commit";
	 $result = mysql_query($sql);
	 if(!$result)
	 {
		 $sql = "rollback";
		 $result = mysql_query($sql);
		 die("Commit failed BOM Insert..Please report to Sysadmin. " . mysql_errno());
	 }

header("Location:bom.php");
}

 if($pagename=='editbomview')
 {
    //echo $_REQUEST["eng_app_by"]."------------";
    $eng_app= $_REQUEST["eng_app"];
    $eng_app_by= $_REQUEST["eng_app_by"];
    $eng_app_date= $_REQUEST["eng_app_date"];
    $bomrecnum=$_REQUEST["bomrecnum"];
     $bomnotes=$_REQUEST["notes"];
    if($dept=='CAD')
    {
     $status=$_REQUEST["status"];
    }else
    {
    if($eng_app=='yes')
    {
      $status='Active';
    }else
    {
      $status='Pending';
    }
    }
    //echo $eng_app_date."***----";
    $newBOM->seteng_app($eng_app);
    $newBOM->seteng_app_by($eng_app_by);
    $newBOM->seteng_app_date($eng_app_date);
    $newBOM->setstatus($status);
    $newBOM->updatebom4eng($bomrecnum);
    $newBOM->addbomnotes($bomrecnum,$bomnotes);
    header("Location:bom.php");
 }
?>
