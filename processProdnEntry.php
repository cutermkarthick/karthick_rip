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

include('classes/operatorClass.php');
include ('classes/nc4qaclass.php');

// Next, create an instance of the classes required
$newoperator = new operator;
$newqa = new nc4qa;

// Get all fields related to invoice
if ($pagename == 'prodnEntry')
{
$oper_name = $_REQUEST["oper_name"];
$crn = $_REQUEST["crn"];
$wo_num = $_REQUEST["wo_num"];
$qty = $_REQUEST["qty"];
$work_center = $_REQUEST["work_center"];
$shift = $_REQUEST["shift"];
$date = $_REQUEST["date"];
$st_date = $_REQUEST["st_date"];
//$end_date = $_REQUEST["end_date"];
$qty_rej = $_REQUEST["qty_rej"];

$qty_acc = $_REQUEST["qty_acc"];
$qty_rew = $_REQUEST["qty_rew"];

$qty_with_dev = $_REQUEST["qty_with_dev"];
$qty_accepted = $_REQUEST["qty_accepted"];
$stage_num =  $_REQUEST["stage"];
$mc_name = $_REQUEST["mc_name"];
$remarks = $_REQUEST["remarks"];
$status='Pending';
$description=$_REQUEST['brief_desc'];
$create_date = date('Y-m-d');
$partname=$_REQUEST['partname'];
$customer=$_REQUEST['customer'];
$ponum=$_REQUEST['ponum'];
$bachnum=$_REQUEST['bachnum'];
$rm_spec=$_REQUEST['rm_spec'];
$attachments=$_REQUEST['attachments'];
$partnum=$_REQUEST['partnum'];
$wo_qty=$_REQUEST['wo_qty'];
$newlogin = new userlogin;
$newlogin->dbconnect();
$sql = "start transaction";
$result = mysql_query($sql);

$newoperator->setoper_name($oper_name);
$newoperator->setshift($shift);
$newoperator->setcrn($crn);
$newoperator->setwo_num($wo_num);
$newoperator->setqty($qty);
$newoperator->setst_date($st_date);
$newoperator->setqty_rej($qty_rej);
$newoperator->setstatus($status);

$newoperator->setqty_acc($qty_acc);
$newoperator->setqty_rew($qty_rew);

$newoperator->setqty_with_dev($qty_with_dev);
$newoperator->setqty_accepted($qty_accepted);
$newoperator->setstage_num($stage_num);
$newoperator->setmc_name($mc_name);
$newoperator->setremarks($remarks);
//to enter data to the nc4qa table--jan_18_2010;
// Stage shold go in as inprocess for operetor
$inprocess='yes';
$newqa->setoper($oper_name);
$newqa->setrefnum($crn);
$newqa->setwonum($wo_num);
$newqa->setqty($qty_rej);
$newqa->setdescription($description);
$newqa->setcreate_date($create_date);
$newqa->setpartname($partname);
$newqa->setpartnum($partnum);
$newqa->setcustomer($customer);
$newqa->setmatl_spec($rm_spec);
$newqa->setissues_ps($attachments);
$newqa->setbachnum($bachnum);
$newqa->setponum($ponum);
$newqa->setstat($status);
$newqa->setinprocess($inprocess);
//	$sql = "start transaction";
//	$result = mysql_query($sql);





$mc_name = $_REQUEST["mc_name"];


$setting_time = 'setting_time';
$running_time = 'running_time';
$markup_time = 'markup_time';
$markdown_time = 'markdown_time';
$idle_time = 'idle_time';
$breakdown_time = 'breakdown_time';

$setting_time_mins = 'setting_time_mins';
$running_time_mins = 'running_time_mins';
$markup_time_mins = 'markup_time_mins';
$markdown_time_mins = 'markdown_time_mins';
$idle_time_mins = 'idle_time_mins';
$breakdown_time_mins = 'breakdown_time_mins';

$qty = 'qty';
$qty_rej = 'qty_rej';
$sl_from = 'sl_from';
$sl_to = 'sl_to';

$setting_time1 = $_REQUEST["$setting_time"];
$running_time1 = $_REQUEST["$running_time"];
$markup_time1 = $_REQUEST["$markup_time"];
$markdown_time1 = $_REQUEST["$markdown_time"];
$idle_time1 = $_REQUEST["$idle_time"];
$breakdown_time1 = $_REQUEST["$breakdown_time"];

$setting_time_mins1 = $_REQUEST["$setting_time_mins"];
$running_time_mins1 = $_REQUEST["$running_time_mins"];
$markup_time_mins1 = $_REQUEST["$markup_time_mins"];
$markdown_time_mins1 = $_REQUEST["$markdown_time_mins"];
$idle_time_mins1 = $_REQUEST["$idle_time_mins"];
$breakdown_time_mins1 = $_REQUEST["$breakdown_time_mins"];

$qty1 = $_REQUEST["$qty"];
$qty_rej1 = $_REQUEST["$qty_rej"];
$sl_from1 = $_REQUEST["$sl_from"];
$sl_to1 = $_REQUEST["$sl_to"];


$newoperator->setmc_name($mc_name);
$newoperator->setsetting_time($setting_time1);
$newoperator->setrunning_time($running_time1);
$newoperator->setmarkup_time($markup_time1);
$newoperator->setmarkdown_time($markdown_time1);
$newoperator->setidle_time($idle_time1);
$newoperator->setbreakdown_time($breakdown_time1);
$newoperator->setqty($qty1);
$newoperator->setqty_rejected($qty_rej1);
$newoperator->setsl_from($sl_from1);
$newoperator->setsl_to($sl_to1);
$newoperator->setstage_num($stage_num);

$newoperator->setoper_name($oper_name);
$newoperator->setsetting_time_mins($setting_time_mins1);
$newoperator->setrunning_time_mins($running_time_mins1);
$newoperator->setmarkdown_time_mins($markdown_time_mins1);
$newoperator->setmarkup_time_mins($markup_time_mins1);
$newoperator->setidle_time_mins($idle_time_mins1);
$newoperator->setbreakdown_time_mins($breakdown_time_mins1);
$todays_date = date("Y-m-d");
$today = strtotime($todays_date);
$start_date = strtotime($st_date);

$result_qty=$newoperator->getwoqty4stage($stage_num,$wo_num);
$myqty=mysql_fetch_row($result_qty);

$tot_opqty=($myqty[0]+$qty1);

// echo$tot_opqty."-*--------------".$qty1;
if($tot_opqty > $wo_qty)
{
echo "<table border=1><tr><td><font color=#FF0000>";
die("Quantity $tot_opqty for this WO for this stage is greater than the total WO Qty $wo_qty");
echo "</td></tr></table>";
}
else if ($start_date > $today)
{
echo "<table border=1><tr><td><font color=#FF0000>";
die("The Start Date Cannot be a Future Date." );
echo "</td></tr></table>";
}
else
{
$operatorrecnum = $newoperator->addoperator();
$link2operator = $operatorrecnum;
$newoperator->setlink2operator($link2operator);
$opmcobjid=$newoperator->addstage_data();
if ($qty_rej1 > 0)
{
$final_insprecnum = $newqa->addnc4qa();
}
}



}
header("Location:prodnEntry.php?status=submit&objid=$opmcobjid&crn=$crn&ncrecnum=$final_insprecnum");
?>
