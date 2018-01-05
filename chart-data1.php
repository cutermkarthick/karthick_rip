<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = March 15,2005                =
// Filename: chart-data1.php                   =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OWT                          =
// Chart data for Product Performance          =
//==============================================

session_start();
header("Cache-control: private");
header ("Content-type: image/png");
if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );
}
$userid = $_SESSION['user'];
$_SESSION['pagename'] = 'reports';
//////session_register('pagename');
$cond = $_SESSION['cond'];
// First include the class definition
include('classes/reportClass.php');
include_once('classes/displayClass.php');
$newdisplay = new display;
$newreport = new report;
$newlogin = new userlogin;
$newlogin->dbconnect();
$flag = 0;
	$closedwos = $newreport->get_closed_wos($cond);
	while($myrow = mysql_fetch_row($closedwos))
	{
        $flag = 1;
		$mastertime = $newreport->get_est_time($myrow[1],$myrow[2]);
		$mymastertime = mysql_fetch_row($mastertime);

		$acttime = $newreport->get_act_time($myrow[0]);
		$myacttime = mysql_fetch_row($acttime);
        $crn=$myrow[0];        
        $graph_labels[]=$crn;
        $graph_items[]=$myacttime[0]/60 ? $myacttime[0]/60 : 0;
        $graph_exp_items[]=$mymastertime[0]/60 ? $mymastertime[0]/60 : 0;
    }

include_once( 'ofc-library/open-flash-chart.php' );
//srand((double)microtime()*1000000);

$bar_red = new bar_3d( 75, '#CC9966' );
$bar_red->key( 'Estimated Time', 10 );

// add random height bars:
for( $i=0; $i<count($graph_exp_items); $i++ )
 // $bar_red->data[] = rand(7,12);
  $bar_red->data[] = $graph_exp_items[$i];

//
// create a 2nd set of bars:
//
$bar_blue = new bar_3d( 75, '#663300' );
$bar_blue->key( 'Actual Time', 10 );

// add random height bars:
for( $i=0; $i<count($graph_items); $i++ )
  $bar_blue->data[] = $graph_items[$i];

  $max_val1=max($graph_items);
  $max_val2=max($graph_exp_items);
  $max_val = max($max_val1,$max_val2);

// create the graph object:
$g = new graph();
$g->title( 'Production Performance(Closed WOs)', '{font-size:18px; color: #FFFFFF; margin: 5px; background-color: #505050; padding:5px; padding-left: 20px; padding-right: 20px;}' );

//$g->set_data( $data_1 );
//$g->bar_3D( 75, '#D54C78', 'Estimated Time', 10 );

//$g->set_data( $data_2 );
//$g->bar_3D( 75, '#3334AD', 'Actual Time', 10 );

$g->data_sets[] = $bar_red;
$g->data_sets[] = $bar_blue;

$g->set_x_axis_3d( 12 );
$g->x_axis_colour( '#909090', '#ADB5C7' );
$g->y_axis_colour( '#909090', '#ADB5C7' );

$g->set_x_labels( $graph_labels );
$g->set_y_max( $max_val );
$g->y_label_steps( 5 );
$g->set_y_legend( 'Time(Hours)', 12, '#736AFF' );
if ($flag == 1)
{
   echo $g->render();
}

?>
