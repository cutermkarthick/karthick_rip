<?php

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


$_SESSION['pagename'] = 'reports';
//////session_register('pagename');


$fdate = $_REQUEST['sdate'];
$tdate = $_REQUEST['edate'];
if($fdate != '' && $fdate != '0000-00-00')
 {
  $datearr = split('-', $fdate);
  $d=$datearr[2];
  $m=$datearr[1];
  $y=$datearr[0];
  $x=mktime(0,0,0,$m,$d,$y);
  $from_date=date("M j, Y",$x);
 }
else
 {
  $from_date = '';
 }
if($tdate != '' && $tdate != '0000-00-00')
 {
  $datearr = split('-', $tdate);
  $d=$datearr[2];
  $m=$datearr[1];
  $y=$datearr[0];
  $x=mktime(0,0,0,$m,$d,$y);
  $to_date=date("M j, Y",$x);
 }
else
 {
  $to_date = '';
 }
$dcond = "op.st_date >= '$fdate' and op.st_date <= '$tdate'";
$mcname =  $_REQUEST['mcname'];

// First include the class definition
include('classes/operatorClass.php');
include('classes/reportClass.php');
include_once('classes/displayClass.php');
$newdisplay = new display;
$newreport = new report;

$newlogin = new userlogin;
$newlogin->dbconnect();

$crns=array();
$esttimes=array();
$actualtimes=array();
$lossorgains=array();
$index = 0;
$counter = 0;
//echo "cond is=$cond";
$result = $newreport->gettime4prodn_eff($mcname,$dcond);

 while ($myrow = mysql_fetch_row($result)) {
      //echo 'inside whlie';
             if($myrow[8] != 0)
               {
                 $result4rejtime = $newreport->getmaster_rejtime4prodn_eff($myrow[1],$myrow[2],$myrow[8]);
                 $myrow4rejtime = mysql_fetch_row($result4rejtime);
                 $rej_time=$myrow4rejtime[2];
               }
             else
               {
                 $rej_time = 0;
               }
            if($index == 0)
            {
             $crns[0]= $myrow[1];
             $esttimes[0]= $myrow[4];
             $actualtimes[0] = $myrow[5];
             $lossorgains[0]  =  ($myrow[4]-$myrow[5]);
            }
            else if($crns[$counter]==$myrow[1])
            {
             $esttimes[$counter] += $myrow[4];
             $actualtimes[$counter] += $myrow[5];
             $lossorgains[$counter] +=  ($myrow[4]-$myrow[5]);
            }
            else{
             $counter++;
             $crns[$counter] = $myrow[1];
             $esttimes[$counter] = $myrow[4];
             $actualtimes[$counter] = $myrow[5];
             $lossorgains[$counter]  =  ($myrow[4]-$myrow[5]);
           }
            $index++;
         }

$graph_labels=$crns;
$graph_items=$actualtimes;
$graph_items1=$esttimes;
$graph_items2=$lossorgains;

//echo 'here';
//print_r($crns);
/*$graph_labels=array('c1','c2');
$graph_items=array('5','2');
$graph_items1=array('1','2');
$graph_items2=array('1','5'); */


include_once( 'ofc-library/open-flash-chart.php' );

// generate some random data
srand((double)microtime()*1000000);


$bar_1 = new bar( 55, '#9966FF', '#C31812' );
$bar_1->key( 'Esi ST Time', 10 );

// add 10 bars with random heights
for( $i=0; $i<count($graph_items1); $i++ )
$bar_1->data[] = $graph_items1[$i];

//
// create a 2nd set of bars:
//
$bar_2 = new bar( 55, '#CCCCFF', '#424581' );
$bar_2->key( 'Actual ST Time', 10 );

// make 10 bars of random heights
for( $i=0; $i<count($graph_items); $i++ )
$bar_2->data[] = $graph_items[$i];  
  
$bar_3 = new bar( 55, '#000000', '#FF3300' );
$bar_3->key( 'Loss or Gain', 10 );

// make 10 bars of random heights
for( $i=0; $i<count($graph_items2); $i++ )
  $bar_3->data[] = $graph_items2[$i];

$max_val1=max($graph_items);
$max_val2=max($graph_items1);
$max_val3=max($graph_items2);
$max_val = max($max_val1,$max_val2,$max_val3);

$min_val1=min($graph_items);
$min_val2=min($graph_items1);
$min_val3=min($graph_items2);
$min_val = min($min_val1,$min_val2,$min_val3);
$middle = ($max_val+$min_val)/2;
//
// create the chart:
//
$g = new graph();
$g->title( 'Efficiency for Machine:'.$mcname.' For Setting Time From:'.$from_date.' To:'.$to_date, '{font-size:18px; color: #bcd6ff; margin:10px; background-color: #5E83BF; padding: 5px 15px 5px 15px;}' );

// add both sets of bars:
$g->data_sets[] = $bar_1;
$g->data_sets[] = $bar_2;
$g->data_sets[] = $bar_3;

// label the X axis (10 labels for 10 bars):
$g->set_x_labels( $graph_labels );

// colour the chart to make it pretty:
$g->x_axis_colour( '#909090', '#D2D2FB' );
$g->y_axis_colour( '#909090', '#D2D2FB' );

//$g->set_x_labels( $graph_labels );

$highest_val = max($max_val,abs($min_val));

if($highest_val%6 != 0)
{
   $add=6-($highest_val%6);
   $highest_val=$highest_val+$add;
}
//$max_val=-90;
if($max_val<=0)
  $g->set_y_max( 0 );
else
  $g->set_y_max( $highest_val );

if($min_val>=0)
  $g->set_y_min( 0 );
else
  $g->set_y_min( -$highest_val );

$g->y_label_steps(6);
$g->set_y_legend( '', 12, '#736AFF' );
echo $g->render();

unset($crns);
unset($actualtimes);
unset($esttimes);
unset($lossorgains);
unset($rej_time);
unset($graph_labels);
unset($graph_items);
unset($graph_items1);
unset($graph_items2);
unset($bar_1);
unset($bar_2);
unset($bar_3);
unset($g);

?>


