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

// Next, create an instance of the classes required
$newoperator = new operator;

if($pagename == 'editreview')
{
$delete = $_REQUEST['deleteflag'];
if ($delete == 'y')
{
$reviewrecnum = $_REQUEST['reviewrecnum'];
$newreview->deletereview($reviewrecnum);
header("Location:reviewSummary.php");
}
}

// Get all fields related to invoice
if ($pagename == 'operator_details' || $pagename == 'new_operator_data') {
$tot_opqty=0;
$oper_name = $_REQUEST["oper_name"];
$crn = $_REQUEST["crn"];
$wo_num = $_REQUEST["wo_num"];
$qty = $_REQUEST["qty"];
$work_center = $_REQUEST["work_center"];
$shift = $_REQUEST["shift"];
$date = $_REQUEST["date"];
$st_date = $_REQUEST["st_date"];
$status = $_REQUEST["status"];
$qty_rej = $_REQUEST["qty_rej"];
$qty_with_dev = $_REQUEST["qty_with_dev"];
$qty_accepted = $_REQUEST["qty_accepted"];
$mc_name = $_REQUEST["mc_name"];
$remarks = $_REQUEST["remarks"];
$wo_qty = $_REQUEST["wo_qty"];
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
$newoperator->setqty_with_dev($qty_with_dev);
$newoperator->setqty_accepted($qty_accepted);
$newoperator->setmc_name($mc_name);
$newoperator->setremarks($remarks);
$newoperator->setstatus($status);
//	$sql = "start transaction";
//	$result = mysql_query($sql);



$mc_name = $_REQUEST["mc_name"];




$setting_time = $_REQUEST['setting_time'];
$running_time = $_REQUEST['running_time'];
$markup_time = $_REQUEST['markup_time'];
$markdown_time = $_REQUEST['markdown_time'];
$idle_time = $_REQUEST['idle_time'];
$breakdown_time = $_REQUEST['breakdown_time'];

$setting_time_mins = $_REQUEST['setting_time_mins'];
$running_time_mins = $_REQUEST['running_time_mins'];
$markup_time_mins = $_REQUEST['markup_time_mins'];
$markdown_time_mins = $_REQUEST['markdown_time_mins'];
$idle_time_mins = $_REQUEST['idle_time_mins'];
$breakdown_time_mins = $_REQUEST['breakdown_time_mins'];

$qty = $_REQUEST['qty'];
$qty_acc = $_REQUEST['qty_acc'];
$qty_rew = $_REQUEST['qty_rew'];
$qty_rej = $_REQUEST['qty_rej'];
$sl_from = $_REQUEST['sl_from'];
$sl_to = $_REQUEST['sl_to'];
$stage_num = $_REQUEST['stage'];


$newoperator->setmc_name($mc_name);
$newoperator->setsetting_time($setting_time);
$newoperator->setrunning_time($running_time);
$newoperator->setmarkup_time($markup_time);
$newoperator->setmarkdown_time($markdown_time);
$newoperator->setidle_time($idle_time);
$newoperator->setbreakdown_time($breakdown_time);

$newoperator->setqty($qty);
$newoperator->setqty_acc($qty_acc);
$newoperator->setqty_rew($qty_rew);
$newoperator->setqty_rejected($qty_rej);
$newoperator->setsl_from($sl_from);
$newoperator->setsl_to($sl_to);
$newoperator->setstage_num($stage_num);

$newoperator->setoper_name($oper_name);
$newoperator->setsetting_time_mins($setting_time_mins);
$newoperator->setrunning_time_mins($running_time_mins);
$newoperator->setmarkdown_time_mins($markdown_time_mins);
$newoperator->setmarkup_time_mins($markup_time_mins);
$newoperator->setidle_time_mins($idle_time_mins);
$newoperator->setbreakdown_time_mins($breakdown_time_mins);

$result_qty=$newoperator->getwoqty4stage($stage_num,$wo_num);
$myqty=mysql_fetch_row($result_qty);
$inttot_opqty=($myqty[0]+$qty);
$tot_opqty=sprintf("%.2f",$inttot_opqty);

$todays_date = date("Y-m-d");
$today = strtotime($todays_date);
$start_date = strtotime($st_date);
//echo$tot_opqty."--------------".$myqty[0];
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
//echo $link2operator."***************";
$newoperator->addstage_data();
}


}


if ($pagename == 'edit_operator_data')
{
$operatorrecnum = $_REQUEST["operatorrecnum"];
$crn = $_REQUEST["crn"];
$mc_name = $_REQUEST["mc_name"];
$wo_num = $_REQUEST["wo_num"];
$st_date = $_REQUEST["st_date"];
$shift = $_REQUEST["shift"];
$remarks = $_REQUEST["remarks"];
$status = $_REQUEST["status"];
$stage = 'stage';
$wo_qty = $_REQUEST["wo_qty"];
$tot_opqty=0;
$newlogin = new userlogin;
$newlogin->dbconnect();
$sql = "start transaction";
$result = mysql_query($sql);

$newoperator->setcrn($crn);
$newoperator->setst_date($st_date);
$newoperator->setmc_name($mc_name);
$newoperator->setwo_num($wo_num);
$newoperator->setshift($shift);
$newoperator->setremarks($remarks);
$newoperator->setstatus($status);

//	$sql = "start transaction";
//	$result = mysql_query($sql);


$mc_name = $_REQUEST["mc_name"];
$link2operator = $operatorrecnum;

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
$qty_acc = 'qty_acc';
$qty_rew = 'qty_rew';
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
$qty_acc1 = $_REQUEST["$qty_acc"];
$qty_rew1 = $_REQUEST["$qty_rew"];
$qty_rej1 = $_REQUEST["$qty_rej"];
$sl_from1 = $_REQUEST["$sl_from"];
$sl_to1 = $_REQUEST["$sl_to"];
$stage1 = $_REQUEST["$stage"];

$stage_num = $i;
$newoperator->setmc_name($mc_name);
$newoperator->setsetting_time($setting_time1);
$newoperator->setrunning_time($running_time1);
$newoperator->setmarkup_time($markup_time1);
$newoperator->setmarkdown_time($markdown_time1);
$newoperator->setidle_time($idle_time1);
$newoperator->setbreakdown_time($breakdown_time1);

$newoperator->setqty($qty1);
$newoperator->setqty_acc($qty_acc1);
$newoperator->setqty_rew($qty_rew1);
$newoperator->setqty_rejected($qty_rej1);
$newoperator->setsl_from($sl_from1);
$newoperator->setsl_to($sl_to1);
$newoperator->setstage_num($stage1);
$newoperator->setlink2operator($link2operator);
$newoperator->setsetting_time_mins($setting_time_mins1);
$newoperator->setrunning_time_mins($running_time_mins1);
$newoperator->setmarkdown_time_mins($markdown_time_mins1);
$newoperator->setmarkup_time_mins($markup_time_mins1);
$newoperator->setidle_time_mins($idle_time_mins1);
$newoperator->setbreakdown_time_mins($breakdown_time_mins1);

$result = $newoperator->getoperator($stage1,$operatorrecnum);
$result_qty=$newoperator->getwoqty4stage($stage1,$wo_num);
$myqty=mysql_fetch_row($result_qty);
$prev_prod_qty = $_REQUEST["prev_prod_qty"];
//echo $prev_prod_qty."test qty------------<br>";
if($qty1 > $prev_prod_qty)
{

$up_opqty=($qty1-$prev_prod_qty);
//echo $myqty[0]."------------------".$up_opqty."----------------".$qty1."22222222222<br>";
$inttot_opqty=$myqty[0]+$up_opqty;
$tot_opqty=sprintf("%.2f",$inttot_opqty);
}
else
{

$up_opqty=($qty1);
//echo $myqty[0]."------------------".$up_opqty."----------------".$qty1."111111111111<br>";
$inttot_opqty=$myqty[0];
$tot_opqty=sprintf("%.2f",$inttot_opqty);
}
//$up_opqty=($myqty[0]-$qty1);

//$tot_opqty=$up_opqty+$qty1;
//echo $tot_opqty;
$todays_date = date("Y-m-d");
$today = strtotime($todays_date);
$start_date = strtotime($st_date) ;
// echo$tot_opqty."--------------".$myqty[0];
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
$newoperator->updateoperator($operatorrecnum);

if(mysql_fetch_row($result))
{
//echo 'hi1';
$newoperator->updatestage_data($operatorrecnum);

}
else
{
//  echo 'hi';
$newoperator->addstage_data();
}

}



}

//header("Location:operator_data_summary.php");
header("Location:operatorDetails.php");

?>
