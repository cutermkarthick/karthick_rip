<?php
header("Cache-Control: cache, must-revalidate");
header("Pragma: public");
header ("Content-type: image/png");
//$userid = $_SESSION['user'];
//$_SESSION['pagename'] = 'reports';
////////session_register('pagename');

$setting_time=$_REQUEST['setting_time'];
$running_time = $_REQUEST['running_time'];
$idle_time=$_REQUEST['idle_time'];
$breakdown_time=$_REQUEST['breakdown_time'];
$machine=$_REQUEST['machine'];

$total = ($setting_time +$running_time + $idle_time + $breakdown_time );
$total1 = sprintf("%.2f",$total);

// generate some random data
srand((double)microtime()*1000000);
$setting_time1 = ($setting_time / $total1 )*100;
$running_time1 = ($running_time / $total1 )*100;
$idle_time1 = ($idle_time / $total1)*100;
$breakdown_time1 = ($breakdown_time / $total1)*100;


$data = array();
$setting_time1 = sprintf("%.2f",$setting_time1);
$running_time1 = sprintf("%.2f",$running_time1);
$idle_time1 = sprintf("%.2f",$idle_time1);
$breakdown_time1 = sprintf("%.2f",$breakdown_time1);


$data[0] = $setting_time1;
$data[1] = $running_time1;
$data[2] = $idle_time1;
$data[3] = $breakdown_time1;


$legend[0] = 'Setting Time' ;
$legend[1] = 'Running Time' ;
$legend[2] = 'Idle Time' ;
$legend[3] = 'Breakdown Time' ;


include_once( 'ofc-library/open-flash-chart.php' );
$g = new graph();

//
// PIE chart, 60% alpha
//
$g->pie(150,'#505050','{font-size: 10px; color: #404040;}');
//
// pass in two arrays, one of data, the other data labels
//

$g->pie_values( $data, array($legend[0],$legend[1],$legend[2],$legend[3]));

//
// Colours for each slice, in this case some of the colours
// will be re-used (3 colurs for 5 slices means the last two
// slices will have colours colour[0] and colour[1]):
//
$g->pie_slice_colours( array('#99FF33','#0000FF','#FFFF33','#A5EEFD') );

$g->set_tool_tip( '#x_label#:<br>#val#%' );

$g->title('Efficiency For Machine:'.$machine.'        Total Time:'.$total1, '{text=bold; font-size:15px; color: #d01f3c}');

echo $g->render();
?>


