<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = March 15,2005                =
// Filename: boardReport.php                   =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OWT                          =
// Operator Efficiency Report                  =
//==============================================


session_start();
//header("Cache-control: private");
header("Cache-Control: cache, must-revalidate");
header("Pragma: public");
header ("Content-type: image/png");
if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];

$cond = $_SESSION['cond'];
$_SESSION['pagename'] = 'reports';
//////session_register('pagename');
$cond = $_SESSION['cond'];
$cond1 = $_SESSION['cond1'];
$cond2 = $_SESSION['cond2'];
$from = $_REQUEST['from'];
$to = $_REQUEST['to'];
$dept = $_SESSION['department'];

 if($from != '0000-00-00' && $from != '' && $from != 'NULL')
 {
      $datearr = split('-', $from);
      $d=$datearr[2];
      $m=$datearr[1];
      $y=$datearr[0];
      $x=mktime(0,0,0,$m,$d,$y);
      $fromdate=date("M j, Y",$x);
 }
 else
 {
      $fromdate="";
 }
 
 if($to != '0000-00-00' && $to != '' && $to != 'NULL')
 {
      $datearr = split('-', $to);
      $d=$datearr[2];
      $m=$datearr[1];
      $y=$datearr[0];
      $x=mktime(0,0,0,$m,$d,$y);
      $todate=date("M j, Y",$x);
 }
 else
 {
      $todate="";
 }
// First include the class definition
include('classes/operatorClass.php');
include('classes/reportClass.php');
include_once('classes/displayClass.php');
$newdisplay = new display;
$newreport = new report;

$newlogin = new userlogin;
$newlogin->dbconnect();


//$result = $newreport->getempid($dept);
//$myrow_e=mysql_fetch_array($result);

$result = $newreport->getops($cond2);
while($myrow = mysql_fetch_row($result))
{

   $empcode = $myrow[2];
   $op = $myrow[0].' '.$myrow[1];
  // $result1 = $newreport->getcrns($op);
       $eff_runtime=0;
       $eff_settime=0;
       $runtimediff=0;
       $settimediff=0;
       $rejtime=0;
       $actual_time4set_eff=0;
       $ideal_time4set_eff=0;
       $actual_time4run_eff=0;
       $ideal_time4run_eff=0;
       
       $rec_arr = array();
       $crn_arr = array();
       $result_rev=$newreport->getrev_crn($op,$cond);
       while($myrow_crn_rev=mysql_fetch_row($result_rev))
       {
           $rec_arr[]=$myrow_crn_rev[4];
           $crn_arr[]=$myrow_crn_rev[0];
       }
       
       $setting_arr = array();
       $result4settime = $newreport->getsettime4eff($op,$cond,$rec_arr);
        while($myrow4seteff=mysql_fetch_row($result4settime))
        {
         $setting_arr[$op] = $myrow4seteff[0].'|'.$myrow4seteff[1];

        }
        $opername = $setting_arr[$op];
               //print_r("---".$opername."---");
        $settimearr = split('\|',$opername);
        $ideal_settime = $settimearr[0];
        $actual_settime = $settimearr[1];
  $result4eff = $newreport->geteffdetails($op,$cond,$rec_arr);
         while($myrow4eff=mysql_fetch_row($result4eff))
         {

           //$ideal_time4set_eff += $myrow4eff[4];
           $actual_runtime += $myrow4eff[5];
           $ideal_runtime += $myrow4eff[6];
         }
  $result4stg = $newreport->getstagenum($op,$cond);
       while($myrow4stg=mysql_fetch_row($result4stg))
       {
          $crn = $myrow4stg[1];
          $stagenum = $myrow4stg[2];
          $qty_rej = $myrow4stg[3];
          $result4rejtime = $newreport->getmaster_rejtime($crn,$stagenum,$qty_rej,$rec_arr);
          $myrow4rejtime=mysql_fetch_row($result4rejtime);
          $rejtime +=  $myrow4rejtime[2];
       }
         $actual_runtime =  $actual_runtime + $rejtime;
         $eff_settime =  $actual_settime != 0 ? (($ideal_settime/$actual_settime)*100) : 0;
         $eff_runtime =  $actual_runtime != 0 ? (($ideal_runtime/$actual_runtime)*100) : 0;
         $eff_avg = (($eff_settime+$eff_runtime) / 2);
         
   $graph_labels[]=$op;
   $graph_items[]=$eff_runtime;
   $graph_items1[]=$eff_settime;
   $graph_items2[]=$eff_avg;
   
    unset($eff_settime);
    unset($eff_runtime);
    unset($actual_runtime);
    unset($ideal_runtime);
    unset($rejtime);
    unset($crn);
    unset($stagenum);
    unset($qty_rej);

}
//print_r($graph_exp_items);

include_once( 'ofc-library/open-flash-chart.php' );
srand((double)microtime()*1000000);


//$bar_red = new bar_3d( 75, '#736AFF' );
$bar_red = new bar_3d( 75, '#FF9900' );
$bar_red->key( 'Setting Time Efficiency', 10 );

// add random height bars:
for( $i=0; $i<count($graph_items1); $i++ )
 // $bar_red->data[] = rand(7,12);
  $bar_red->data[] = $graph_items1[$i];

//
// create a 2nd set of bars:
//
//$bar_blue = new bar_3d( 75, '#566D7E' );
$bar_blue = new bar_3d( 75, '#663300' );
$bar_blue->key( 'Running Time Efficiency', 10 );

// add random height bars:
for( $i=0; $i<count($graph_items); $i++ )
  $bar_blue->data[] = $graph_items[$i];
  
//$bar_avgtime = new bar_3d( 75, '#6698FF' );
$bar_avgtime = new bar_3d( 75, '#CC6600' );
$bar_avgtime->key( 'Avg Time Efficiency', 10 );

// add random height bars:
for( $i=0; $i<count($graph_items2); $i++ )
 // $bar_red->data[] = rand(7,12);
 // $bar_avgtime->data[] = $graph_items2[$i];

  $max_val1=max($graph_items);
  $max_val2=max($graph_items1);
  $max_val3=max($graph_items2);
  $max_val = max($max_val1,$max_val2,$max_val3);

// create the graph object:
$g = new graph();
$g->title( $op.'('.$empcode.') From:'.$fromdate.' To:'.$todate, '{font-size:16px; color: #FFFFFF; margin: 5px; background-color: #505050; padding:5px; padding-left: 20px; padding-right: 20px;}' );

//$g->set_data( $data_1 );
//$g->bar_3D( 75, '#D54C78', 'Estimated Time', 10 );

//$g->set_data( $data_2 );
//$g->bar_3D( 75, '#3334AD', 'Actual Time', 10 );

$g->data_sets[] = $bar_red;
$g->data_sets[] = $bar_blue;
//$g->data_sets[] = $bar_avgtime;

$g->set_x_axis_3d( 12 );
$g->x_axis_colour( '#909090', '#ADB5C7' );
$g->y_axis_colour( '#909090', '#ADB5C7' );

$g->set_x_labels( $graph_labels );
$g->set_y_max(  $max_val );
$g->y_label_steps( 5 );
$g->set_y_legend( 'Efficiency(Percentage)', 12, '#736AFF' );
echo $g->render();
?>
