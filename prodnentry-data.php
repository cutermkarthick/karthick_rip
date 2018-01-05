<?
$accept_efficiency = $_REQUEST['accept_efficiency'];
$total_efficiency = $_REQUEST['total_efficiency'];


include_once( 'ofc-library/open-flash-chart.php' );

// generate some random data
srand((double)microtime()*1000000);

//
// We are diplaying 3 bar charts, so create 3
// bar chart objects:
//

$bar_acc = new bar( 50, '#9933CC' );
$bar_acc->key( 'Accepted Eff', 10 );

$bar_tot = new bar( 50, '#0066CC' );
$bar_tot->key( 'Total Eff', 10 );


$bar_acc->data[] = $accept_efficiency;
$bar_tot->data[] = $total_efficiency;

$max=max($accept_efficiency,$total_efficiency);

$g = new graph();
$g->title( 'Efficiency Graph', '{font-size: 20px;}' );

$g->data_sets[] = $bar_acc;
$g->data_sets[] = $bar_tot;

$g->set_x_labels( array('Efficiency') );
$g->set_tool_tip( '#key#= #val#');

$g->set_x_label_style( 10, '#9933CC', 0, 2 );
$g->set_x_axis_steps( 2 );

$g->set_y_max( $max );
$g->y_label_steps( 4 );
$g->set_y_legend( 'Percentage', 12, '0x736AFF' );
echo $g->render();
?>

