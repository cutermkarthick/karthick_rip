<?php
<?php

header("Cache-Control: cache, must-revalidate");
header("Pragma: public");

header ("Content-type: image/png");

session_start();
// generate some random data
srand((double)microtime()*1000000);

//
// NOTE: how we are filling 3 arrays full of data,
//       one for each line on the graph
//
$crn=$_REQUEST['crn'];
$diff=$_SESSION['diff'];
$months=$_SESSION['months'];
$infull=$_SESSION['infull'];
$maxval = max($diff);
$data_1 = array();
$data_2 = array();
$data_3 = array();
foreach($diff as $value)
{
 $data_1[] = $value;
 //$maxval = max($eff);
}
foreach($infull as $value)
{
 $data_2[] = $value;
}
foreach($months as $val)
{
 $data_3[] = 100;
}
//$data_2[] = rand(8,13);
//$data_3[] = rand(1,7);


include_once('ofc-library/open-flash-chart.php');
$g = new graph();
$g->title('Ontime and Infull Report ', '{font-size: 18px; color: #736AFF}');

// we add 3 sets of data:
$g->set_data($data_1);
$g->set_data($data_2);
$g->set_data($data_3);

// we add the 3 line types and key labels
$g->line( 2, '#0000FF', 'Ontime', 10);
$g->line_hollow( 3, 5, '0xCC3399', 'Infull', 10);    // <-- 3px thick + dots
$g->line_dot( 2, 4, '0x80a033', 'Req', 10);

$g->set_x_labels($months);
$g->set_x_label_style( 10, '0x000000', 0, 1 );
$g->set_x_legend('Months->', 12, '#736AFF');
if($maxval < 100)
{
 $maxval = 100;
 $g->set_y_max($maxval);
}
else
{
 $g->set_y_max($maxval);
}
$g->y_label_steps(4);
$g->set_y_legend( 'Efficiency->', 12, '#736AFF');
echo $g->render();
?>


