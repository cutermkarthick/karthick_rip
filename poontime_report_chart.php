<?php
//==============================================
// Author: FSI                                 =
// Date-written = Nov 10, 2014                =
// Filename: ontime_report_chart.php           =
// Copyright of Badari Mandyam, FluentSoft     =
// Revision: v1.0 WMS                          =
// Displays PO_Ontime Report Chart             =
//==============================================

$ponum = $_REQUEST['ponum'];
$po = $_REQUEST['po'];
include_once 'ofc-library/open_flash_chart_object.php';
open_flash_chart_object(580, 300, 'http://'. $_SERVER['SERVER_NAME'] .'/fluenterp/chart.php?ponum='.$ponum.'&po='.$po,false);
?>







