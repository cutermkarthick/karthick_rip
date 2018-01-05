<?php
//==============================================
// Author: FSI                                 =
// Date-written = Mar 20, 2007                 =
// Filename: processmc_master.php              =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OWT                          =
// Process of crn mc master                    =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
header ( "Location: login.php" );

}
$userid = $_SESSION['user'];

$pagename = $_SESSION['pagename'];

include('classes/mc_masterClass.php');

// Next, create an instance of the classes required
$newmc_master = new mc_master;

// Get all fields related to invoice
if ($pagename == 'new_mc_master' || $pagename == 'mc_master_summary' || $pagename == 'new_timemaster')
{
// $mc_id = $_REQUEST["mc_id"];
$mps_revision = $_REQUEST["mps_revision"];
$crn_num = $_REQUEST["crn_num"];
// $mc_cost_per_hour = $_REQUEST["mc_cost_per_hour"];
$qty = $_REQUEST["qty"];
$setup_time_hrs = $_REQUEST["setup_time_hrs"];
$setup_time_mins = $_REQUEST["setup_time_mins"];
$fitting_time_hrs = $_REQUEST["fitting_time_hrs"];
$fitting_time_mins = $_REQUEST["fitting_time_mins"];
$insp_time_hrs = $_REQUEST["insp_time_hrs"];
$insp_time_mins = $_REQUEST["insp_time_mins"];
$valpart = $_REQUEST["valperpart"];
$fromdate = $_REQUEST["fromdate"];
$todate = $_REQUEST["todate"];

$newlogin = new userlogin;
$newlogin->dbconnect();
$sql = "start transaction";
$result = mysql_query($sql);
//   $newmc_master->setmc_id($mc_id);
//	$newmc_master->setmc_name($mc_name);
$newmc_master->setcrn_num($crn_num);
//	$newmc_master->setmc_cost_per_hour($mc_cost_per_hour);
$newmc_master->setqty($qty);
$newmc_master->setsetup_time_hrs($setup_time_hrs);
$newmc_master->setsetup_time_mins($setup_time_mins);
$newmc_master->setfitting_time_hrs($fitting_time_hrs);
$newmc_master->setfitting_time_mins($fitting_time_mins);
$newmc_master->setinsp_time_hrs($insp_time_hrs);
$newmc_master->setinsp_time_mins($insp_time_mins);
$newmc_master->setvalpart($valpart);
$newmc_master->setmps_revision($mps_revision);
$newmc_master->setfromdate($fromdate);
$newmc_master->settodate($todate);

$mc_masterrecnum = $newmc_master->addmc_master();

$link2mc_master = $mc_masterrecnum;
for($i=1;$i<=24;$i++)
{
$running_time = 'running_time' . $i;
$running_time1 = $_REQUEST["$running_time"];

$setting_time = 'setting_time' . $i;
$setting_time1 = $_REQUEST["$setting_time"];

$running_time_mins = 'running_time_mins' . $i;
$running_time_mins1 = $_REQUEST["$running_time_mins"];

$setting_time_mins = 'setting_time_mins' . $i;
$setting_time_mins1 = $_REQUEST["$setting_time_mins"];

$stage_cost = 'stage_cost' . $i;
$stage_cost1 = $_REQUEST["$stage_cost"];


$stage_num = $i;
if($running_time1 != '' || $setting_time1 != '')
{
$newmc_master->setrunning_time($running_time1);
$newmc_master->setsetting_time($setting_time1);
$newmc_master->setrunning_time_mins($running_time_mins1);
$newmc_master->setsetting_time_mins($setting_time_mins1);
$newmc_master->setstage_cost($stage_cost1);
$newmc_master->setstage_num($stage_num);
$newmc_master->setlink2mc_master($link2mc_master);
$newmc_master->addstage_data();
}
}
}

if ($pagename == 'edit_mc_master') 
{
$mps_revision = $_REQUEST["mps_revision"];
$link2master_data=$_REQUEST['link2master_data'];
//echo $link2master_data.'---';
$crn_num = $_REQUEST["crn_num"];
$mc_masterrecnum = $_REQUEST["mc_masterrecnum"];   
$qty = $_REQUEST["qty"];
$setup_time_hrs = $_REQUEST["setup_time_hrs"];
$setup_time_mins = $_REQUEST["setup_time_mins"];
$fitting_time_hrs = $_REQUEST["fitting_time_hrs"];
$fitting_time_mins = $_REQUEST["fitting_time_mins"];
$insp_time_hrs = $_REQUEST["insp_time_hrs"];
$insp_time_mins = $_REQUEST["insp_time_mins"];
$valpart = $_REQUEST["valperpart"];
$fromdate = $_REQUEST["fromdate"];
$todate = $_REQUEST["todate"];
$newlogin = new userlogin;
$newlogin->dbconnect();

$sql = "start transaction";
$result = mysql_query($sql);   
$newmc_master->setcrn_num($crn_num);    
$newmc_master->setqty($qty);
$newmc_master->setsetup_time_hrs($setup_time_hrs);
$newmc_master->setsetup_time_mins($setup_time_mins);
$newmc_master->setfitting_time_hrs($fitting_time_hrs);
$newmc_master->setfitting_time_mins($fitting_time_mins);
$newmc_master->setinsp_time_hrs($insp_time_hrs);
$newmc_master->setinsp_time_mins($insp_time_mins);
$newmc_master->setvalpart($valpart);
$newmc_master->setmps_revision($mps_revision);
$newmc_master->setfromdate($fromdate);
$newmc_master->settodate($todate);
$newmc_master->updatemc_master($mc_masterrecnum);

$link2mc_master = $mc_masterrecnum;
for($i=1;$i<=24;$i++)
{
$result = $newmc_master->getstage($i,$mc_masterrecnum);

$running_time = 'running_time' . $i;
$running_time1 = $_REQUEST["$running_time"];

$setting_time = 'setting_time' . $i;
$setting_time1 = $_REQUEST["$setting_time"];

$running_time_mins = 'running_time_mins' . $i;
$running_time_mins1 = $_REQUEST["$running_time_mins"];

$setting_time_mins = 'setting_time_mins' . $i;
$setting_time_mins1 = $_REQUEST["$setting_time_mins"];

$stage_cost = 'stage_cost' . $i;
$stage_cost1 = $_REQUEST["$stage_cost"];

$stage_num = $i;
if($running_time1 != '' || $setting_time1 != '')
{
$newmc_master->setrunning_time($running_time1);
$newmc_master->setsetting_time($setting_time1);
$newmc_master->setrunning_time_mins($running_time_mins1);
$newmc_master->setsetting_time_mins($setting_time_mins1);
$newmc_master->setstage_cost($stage_cost1);
$newmc_master->setstage_num($stage_num);
$newmc_master->setlink2mc_master($link2mc_master);
if(mysql_fetch_row($result))
{
//echo 'hi1';
$newmc_master->updatestage_data($mc_masterrecnum);
}
else
{
//  echo 'hi';
$newmc_master->addstage_data();
}
}
}
}

header("Location:mc_master_summary.php");

?>
