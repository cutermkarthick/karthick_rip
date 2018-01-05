<?php
//
//==============================================
// Author: FSI                                 =
// Dechoate-written = June 20, 2004            =
// Filename: processrma.php                    =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OWT                          =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];
$pagename = $_SESSION['pagename'];
include_once('classes/loginClass.php');
include('classes/rmaClass.php');
include('classes/rmaitemsClass.php');
include('classes/supportClass.php');
$newlogin = new userlogin;
$newlogin->dbconnect();
$newrma = new rma;
$newitems_ret = new rmaitems;
$newsupp = new support;

if ($pagename == 'newrma' || $pagename == 'rmaupdate')
{
	$rmannum = $_REQUEST['rmaid'];
	$recive_date = $_REQUEST['recive_date'];
	$sch_due_date = $_REQUEST['sch_due_date'];
	$act_comp_date = $_REQUEST['act_comp_date'];
	$worecnum = $_REQUEST['worecnum'];
	$supp2customer = $_REQUEST['companyrecnum'];
	$supp2contact = $_REQUEST['contactrecnum'];
	$supp2employee = $_REQUEST['empnum'];
	$supp2solution = $_REQUEST['solrecnum'];
	if($supp2solution=='')
	$supp2solution=0;
	if (isset($_REQUEST['omistake']))
	$omistake ="y";
	else
	$omistake ="n";
	if (isset($_REQUEST['cmistake']))
	$cmistake ="y";
	else
	$cmistake ="n";
	$reason4return=$_REQUEST['reason4return'];
	$solrecnum = $_REQUEST['solrecnum'];
	$sol_desc = $_REQUEST['sol_desc'];
	$cost_to_us = $_REQUEST['cost2us'];
	if($cost_to_us=='')
	$cost_to_us=0;
	$cost_to_cust = $_REQUEST['cost2cust'];
	if($cost_to_cust=='')
	$cost_to_cust=0;
	if (isset($_REQUEST['requote']))
	$requote ="y";
	else
	$requote ="n";
	if (isset($_REQUEST['reorder']))
	$reorder ="y";
	else
	$reorder ="n";
	if (isset($_REQUEST['design']))
	$design ="y";
	else
	$design ="n";
	if (isset($_REQUEST['mfg']))
	$mfg ="y";
	else
	$mfg ="n";
	if (isset($_REQUEST['assemply']))
	$assemply ="y";
	else
	$assemply ="n";
	$error_desc= $_REQUEST['error_desc'];
	$crdate = date("d-M-y");
	$part1 = $_REQUEST['part1'];
	$qty1 = $_REQUEST['qty1'];
	$part2 = $_REQUEST['part2'];
	$qty2 = $_REQUEST['qty2'];
	$part3 = $_REQUEST['part3'];
	$qty3 = $_REQUEST['qty3'];
	$part4 = $_REQUEST['part4'];
	$qty4 = $_REQUEST['qty4'];
	$part5 = $_REQUEST['part5'];
	$qty5 = $_REQUEST['qty5'];
	$part6 = $_REQUEST['part6'];
	$qty6 = $_REQUEST['qty6'];
}
if ($pagename == 'newrma')
{
	$newrma ->setrmaid($rmannum) ;
	$newrma ->setreceived_date($recive_date);
	$newrma ->setsch_due_date($sch_due_date);
	$newrma ->setact_complete_date($act_comp_date);
	$newrma ->setomistake($omistake);
	$newrma ->setcmistake($cmistake);
	$newrma ->setreason_for_return($reason4return);
	$newrma ->setsol_desc($sol_desc);
	$newrma ->setcost_to_customer($cost_to_cust);
	$newrma ->setcost_to_us($cost_to_us);
	$newrma ->setre_quote($requote);
	$newrma ->setre_order ($reorder);
	$newrma ->setdesign($design);
	$newrma ->setmfg($mfg);
	$newrma ->setassembly($assemply);
	$newrma ->setcorrective_act ($error_desc);
	$newlogin = new userlogin;
	$newlogin->dbconnect();
	$sql = "start transaction";
	$result = mysql_query($sql);
	$rmarecnum = $newrma ->addrma();
	$newsupp->settype('RMA');
	$newsupp->setstatus('Rma open');
	$newsupp->setcondition('progress');
	$newsupp->setsupp2type($rmarecnum);
	$newsupp->setsupp2wo($worecnum);
	$newsupp->setsupp2customer($supp2customer);
	$newsupp->setsupp2contact($supp2contact);
	$newsupp->setsupp2employee($supp2employee);
	$newsupp->setsupp2solution($supp2solution);
	$newsupp->addsupport();
	$sql = "commit";
	$result = mysql_query($sql);
	if(!$result) die("Commit failed for New Support.Please report to Sysadmin. " . mysql_error());
	if ($part1 != '') {
		if($qty1=='')
		{$qty1=0;}
		$newitems_ret ->setlink2rma($rmarecnum);
		$newitems_ret ->setpart($part1);
		$newitems_ret ->setqty($qty1);
		$newitems_ret ->addrmaitems();
	}
	if ($part2 != '') {
		if($qty2=='')
		{$qty2=0;}

		$newitems_ret ->setlink2rma($rmarecnum);
		$newitems_ret ->setpart($part2);
		$newitems_ret ->setqty($qty2);
		$newitems_ret ->addrmaitems();
	}
	if ($part3 != '') {
		if($qty3=='')
		{$qty3=0;}
		$newitems_ret ->setlink2rma($rmarecnum);
		$newitems_ret ->setpart($part3);
		$newitems_ret ->setqty($qty3);
		$newitems_ret ->addrmaitems();
	}
	if ($part4 != '') {
		if($qty4=='')
		{$qty4=0;}
		$newitems_ret ->setlink2rma($rmarecnum);
		$newitems_ret ->setpart($part4);
		$newitems_ret ->setqty($qty4);
		$newitems_ret ->addrmaitems();
	}
	if ($part5 != '') {
		if($qty5=='')
		{$qty5=0;}
		$newitems_ret ->setlink2rma($rmarecnum);
		$newitems_ret ->setpart($part5);
		$newitems_ret ->setqty($qty5);
		$newitems_ret ->addrmaitems();
	}
	if ($part6 != '') {
		if($qty6=='')
		{$qty6=0;}
		$newitems_ret ->setlink2rma($rmarecnum);
		$newitems_ret ->setpart($part6);
		$newitems_ret ->setqty($qty6);
		$newitems_ret ->addrmaitems();
	}
	$sql = "commit";
	$result = mysql_query($sql);
	if(!$result) {
		$sql = "rollback";
		$result = mysql_query($sql);
		die("Commit failed PO Insert..Please report to Sysadmin. " . mysql_errno());
	}
}
if ($pagename == 'rmaupdate')
 {
	$rmannum = $_REQUEST['rmaid'];
	$recive_date = $_REQUEST['recive_date'];
	$sch_due_date = $_REQUEST['sch_due_date'];
	$act_comp_date = $_REQUEST['act_comp_date'];
	$worecnum = $_REQUEST['worecnum'];
	$rmarecnum=$_REQUEST['rmarecnum'];
	if (isset($_REQUEST['omistake']))
		$omistake ="y";
	else
		$omistake ="n";
	if (isset($_REQUEST['cmistake']))
		$cmistake ="y";
	else
		$cmistake ="n";
	$reason4return=$_REQUEST['reason4return'];
	$solrecnum = $_REQUEST['solrecnum'];
	$sol_desc = $_REQUEST['sol_desc'];
	$cost_to_us = $_REQUEST['cost2us'];
	if($cost_to_us=='')
	$cost_to_us=0;
	$cost_to_cust = $_REQUEST['cost2cust'];
	if($cost_to_cust=='')
	$cost_to_cust=0;
	if (isset($_REQUEST['requote']))
	$requote ="y";
	else
	$requote ="n";
	if (isset($_REQUEST['reorder']))
	$reorder ="y";
	else
	$reorder ="n";
	if (isset($_REQUEST['design']))
	$design ="y";
	else
	$design ="n";
	if (isset($_REQUEST['mfg']))
	$mfg ="y";
	else
	$mfg ="n";
	if (isset($_REQUEST['assemply']))
	$assemply ="y";
	else
	$assemply ="n";
	$error_desc= $_REQUEST['error_desc'];
	$crdate = date("d-M-y");
	$part1 = $_REQUEST['part1'];
	$part2 = $_REQUEST['part2'];
	$part3 = $_REQUEST['part3'];
	$part4 = $_REQUEST['part4'];
	$part5 = $_REQUEST['part5'];
	$part6 = $_REQUEST['part6'];
	$prevpart1 = $_REQUEST['prevpart1'];
	$prevpart2 = $_REQUEST['prevpart2'];
	$prevpart3 = $_REQUEST['prevpart3'];
	$prevpart4 = $_REQUEST['prevpart4'];
	$prevpart5 = $_REQUEST['prevpart5'];
	$prevpart6 = $_REQUEST['prevpart6'];
	$newlogin = new userlogin;
	$newlogin->dbconnect();
	$sql = "start transaction";
	$result = mysql_query($sql);
	$newrma ->setreceived_date($recive_date);
	$newrma ->setsch_due_date($sch_due_date);
	$newrma ->setact_complete_date($act_comp_date);
	$newrma ->setomistake($omistake);
	$newrma ->setcmistake($cmistake);
	$newrma ->setreason_for_return($reason4return);
	$newrma ->setsol_desc($sol_desc);
	$newrma ->setcost_to_customer($cost_to_cust);
	$newrma ->setcost_to_us($cost_to_us);
	$newrma ->setre_quote($requote);
	$newrma ->setre_order ($reorder);
	$newrma ->setdesign($design);
	$newrma ->setmfg($mfg);
	$newrma ->setassembly($assemply);
	$newrma ->setcorrective_act ($error_desc);
	$newrma->updaterma($rmarecnum);
  	$newsupp->settype('RMA');
	$newsupp->setstatus('Rma open');
	$newsupp->setcondition('progress');
	$newsupp->setsupp2type($rmarecnum);
	$newsupp->setsupp2wo($worecnum);
	$newsupp->setsupp2customer($supp2customer);
	$newsupp->setsupp2contact($supp2contact);
	$newsupp->setsupp2employee($supp2employee);
	$newsupp->setsupp2solution($supp2solution);
	$newsupp->updatesupport($rmarecnum,'RMA');

	if ($part1!= '') {
		if($qty1=='')
		{$qty1=0;}
		$newitems_ret ->setlink2rma($rmarecnum);
		$newitems_ret ->setpart($part1);
		$newitems_ret ->setqty($qty1);
		if ($prevpart1 != '') {
			 $newitems_ret ->updatermaitems($rmarecnum); }
		else  {
			    $newitems_ret ->addrmaitems();  }
	}else {

		  if ($prevpart1 != '') {

		         $newitems_ret->deletermaitems($prevpart1);  }
	   }
	  if ($part2!= '') {
		if($qty2=='')
		{$qty2=0;}
     		$newitems_ret ->setlink2rma($rmarecnum);
    		$newitems_ret ->setpart($part2);
		$newitems_ret ->setqty($qty2);
		if ($prevpart2 != '') {
		  $newitems_ret ->updatermaitems($rmarecnum);	}
		else  {
		     $newitems_ret ->addrmaitems();     }
	  }
	  else {

		       if ($prevpart2 != '') {

		       $newitems_ret->deletermaitems($prevpart2);    }
	         }
	 if ($part3!= '') {
		if($qty3=='')
		{$qty3=0;}
		     $newitems_ret ->setlink2rma($rmarecnum);
		     $newitems_ret ->setpart($part3);
		     $newitems_ret ->setqty($qty3);
		     if ($prevpart3 != '') {
		 	     $newitems_ret ->updatermaitems($rmarecnum);
				}
		     else  {
			    $newitems_ret ->addrmaitems(); }
	}  else {

		       if ($prevpart3 != '') {

		        $newitems_ret->deletermaitems($prevpart3); }
	}
    	if ($part4!= '') {
		if($qty4=='')
		{$qty4=0;}
		     $newitems_ret ->setlink2rma($rmarecnum);
		     $newitems_ret ->setpart($part4);
		     $newitems_ret ->setqty($qty4);

		     if ($prevpart4 != '') {
		    $newitems_ret ->updatermaitems($rmarecnum);    }
		     else  {
			    $newitems_ret ->addrmaitems();  }
	  }  else {

		       if ($prevpart4 != '') {

		         $newitems_ret->deletermaitems($prevpart4);  }
	  }
	  if ($part5!= '') {
		if($qty5=='')
		{$qty5=0;}
		     $newitems_ret ->setlink2rma($rmarecnum);
		     $newitems_ret ->setpart($part5);
		     $newitems_ret ->setqty($qty5);
		     if ($prevpart5 != '') {
		         $newitems_ret ->updatermaitems($rmarecnum);    }
		     else  {
			     $newitems_ret ->addrmaitems();    }
	  }  else {
		       if ($prevpart5 != '') {
		         $newitems_ret->deletermaitems($prevpart5);    }
	  }
	  if ($part6!= '') {
		if($qty6=='')
		{$qty6=0;}
		     $newitems_ret ->setlink2rma($rmarecnum);
		     $newitems_ret ->setpart($part6);
		     $newitems_ret ->setqty($qty6);
		     if ($prevpart6 != '') {
			      $newitems_ret ->updatermaitems($rmarecnum);  }
		     else  {
			   $newitems_ret ->addrmaitems(); }
	  }  else {
		       if ($prevpart6 != '') {
			    $newitems_ret->deletermaitems($prevpart6);  }
	  }
  $sql = "commit";
  $result = mysql_query($sql);
  if(!$result) die("Commit failed for Rma items Update..Please report to Sysadmin. " . mysql_errno());
  }
header("Location:supportsummary.php");
?>