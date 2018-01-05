<?php


session_start();
// generate some random data
srand((double)microtime()*1000000);

//
// NOTE: how we are filling 3 arrays full of data,
//       one for each line on the graph
//
$eff=$_SESSION['eff'];
$crn=$_SESSION['crn'];
$maxval = max($eff);
$data_1 = array();
//$data_2 = array();
//$data_3 = array();
foreach($eff as $value)
{
 $data_1[] = $value;
 //$maxval = max($eff);
}
//$data_2[] = rand(8,13);
//$data_3[] = rand(1,7);


include_once( 'ofc-library/open-flash-chart.php' );
$g = new graph();
$g->title( 'CRR Report', '{font-size: 20px; color: #736AFF}');

// we add 3 sets of data:
$g->set_data($data_1);
//$g->set_data( $data_2 );
//$g->set_data( $data_3 );

// we add the 3 line types and key labels
$g->line( 2, '0x9933CC', 'Efficiency', 10 );
$g->line_dot( 3, 5, '0xCC3399', 'Downloads', 10);    // <-- 3px thick + dots
$g->line_hollow( 2, 4, '0x80a033', 'Bounces', 10 );

$g->set_x_labels($crn);
$g->set_x_label_style( 10, '0x000000', 0, 1 );
$g->set_x_legend( 'CRN->', 12, '#736AFF' );

$g->set_y_max($maxval);
$g->y_label_steps(4);
$g->set_y_legend( 'Efficiency(in percentage)->', 12, '#736AFF' );
echo $g->render();
?>


