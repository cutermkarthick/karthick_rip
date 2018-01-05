<?php
session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}

$userid = $_SESSION['user'];

session_start();
// generate some random data
srand((double)microtime()*1000000);

//
// NOTE: how we are filling 3 arrays full of data,
//       one for each line on the graph
//
$crn=$_REQUEST['crn'];
$month=$_REQUEST['month'];
$short_month=substr_replace($month,"",3);
$y = $month;
$length = strlen($y);
$characters = 4;
$start = $length - $characters;
$year = substr($y , $start ,$characters);
$short_month_year = $short_month.$year;
$diff=$_SESSION['timediff'];
$cofcs=$_SESSION['cofcs'];
$infull=$_SESSION['infull'];
$max_ontime = max($diff);
$max_infull = max($infull);
$maxval = max($max_ontime,$max_infull);
$min_ontime = min($diff);
$min_infull = min($infull);
$minval = min($min_ontime,$min_infull);
$data_1 = array();
$data_2 = array();
//$data_3 = array();
foreach($diff as $value)
{
 $data_1[] = $value;
 //$maxval = max($eff);
}
foreach($infull as $value)
{
 $data_2[] = $value;
 //$maxval = max($eff);
}

include_once('ofc-library/open-flash-chart.php');
$g = new graph();

$g->title('Cofc Drill down', '{font-size: 18px; color: #736AFF}');

// we add 3 sets of data:
$g->set_data($data_1);
$g->set_data($data_2);
//$g->set_data( $data_3 );

// we add the 3 line types and key labels
$g->line( 2, '#0000FF', 'Ontime', 10);
$g->line_dot( 3, 5, '0xCC3399', 'Infull', 10);    // <-- 3px thick + dots
$g->line_hollow( 2, 4, '0x80a033', 'Bounces', 10);

$g->set_x_labels($cofcs);
$g->set_x_label_style( 10, '0x000000', 0, 1 );
$g->set_x_legend( 'Cofcs->', 12, '#736AFF' );

$highest_val = max($maxval,abs($minval));

if($highest_val%4 != 0)
{
   $add=4-($highest_val%4);
   $highest_val=$highest_val+$add;
}
//$max_val=-90;
if($maxval<=0)
  $g->set_y_max( 0 );
else
  $g->set_y_max($highest_val);

if($minval>=0)
  $g->set_y_min( 0 );
else
  $g->set_y_min( -$highest_val );

/*$g->set_y_min($minval);
$g->set_y_max($maxval);*/
$g->y_label_steps(4);
$g->set_y_legend('Ontime/Infull->', 12, '#736AFF');
echo $g->render();
?>


