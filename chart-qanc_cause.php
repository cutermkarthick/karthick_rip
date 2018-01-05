<?php
session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}

$userid = $_SESSION['user'];

//$dimdiv=$_REQUEST['dimdiv'];
$man=$_REQUEST['man'];
//$inpro=$_REQUEST['inpro'];
//$matdiv=$_REQUEST['matdiv'];
$machine=$_REQUEST['machine'];
//$finalinsp=$_REQUEST['finalinsp'];
$method=$_REQUEST['method'];
//$custend=$_REQUEST['custend'];
//$others = $_REQUEST['others'];

//$userid = $_SESSION['user'];
//$_SESSION['pagename'] = 'reports';
////////session_register('pagename');

include_once( 'ofc-library/open-flash-chart.php' );

// generate some random data
srand((double)microtime()*1000000);

$bar = new bar_outline( 50, '#9933CC', '#8010A0' );
$bar->key( '', 10 );

$data = array();

//$bar->data[] = $dimdiv;
$bar->data[] = $man;
//$bar->data[] = $inpro;
//$bar->data[] = $matdiv;
$bar->data[] = $machine;
//$bar->data[] = $finalinsp;
$bar->data[] = $method;
//$bar->data[] = $custend;
//$bar->data[] = $others;
$total = $man + $machine + $method;

$maxval = max($man,$machine,$method);

$g = new graph();
$g->title('QA NC CAUSE(Total-'.$total.')', '{font-size: 18px;}');

//
// BAR CHART:
//
//$g->set_data( $data );
//$g->bar_filled( 50, '#9933CC', '#8010A0', 'Page views', 10 );
//
// ------------------------
//
$g->data_sets[] = $bar;
//
// X axis tweeks:
//
$g->set_x_labels( array('Man','Machine','Method') );
//
// set the X axis to show every 2nd label:
//
$g->set_x_label_style( 10, '#9933CC', 0, 1 );
//
// and tick every second value:
//
$g->set_x_axis_steps( 1 );
//
$g->set_y_max( $maxval );
$g->y_label_steps( 5 );
$g->set_y_legend( '', 12, '#736AFF' );
echo $g->render();
?>


