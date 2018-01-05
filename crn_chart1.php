<?php

header("Cache-Control: cache, must-revalidate");
header("Pragma: public");
header ("Content-type: image/png");
//$userid = $_SESSION['user'];
//$_SESSION['pagename'] = 'reports';
////////session_register('pagename');
$crnnum=$_REQUEST['crnnum'];
$qtyacc=$_REQUEST['qtyacc'];
$qtyrej=$_REQUEST['qtyrej'];
$qtyret=$_REQUEST['qtyret'];
$woqty=$_REQUEST['woqty'];
$qtyrew=$_REQUEST['qtyrew'];

// generate some random data
srand((double)microtime()*1000000);


$data = array();

if($qtyacc != 0)
{
 $data[0] = $qtyacc;
 $legend[0] = 'Accepted('.$qtyacc.')';
}
if($qtyrej != 0)
{
  $data[1] = $qtyrej;
  $legend[1] = 'Rejected('.$qtyrej.')';
}
if($qtyret != 0)
{
  $data[2] = $qtyret;
  $legend[2] = 'Returned('.$qtyret.')';
}
if($qtyrew != 0)
{
  $data[3] = $qtyrew;
  $legend[3] = 'Reworked('.$qtyrew.')';
}

include_once( 'ofc-library/open-flash-chart.php' );
$g = new graph();

//
// PIE chart, 60% alpha
//
$g->pie(150,'#505050','{font-size: 10px; color: #404040;}');
//
// pass in two arrays, one of data, the other data labels
//
$g->pie_values( $data,$legend);

//
// Colours for each slice, in this case some of the colours
// will be re-used (3 colurs for 5 slices means the last two
// slices will have colours colour[0] and colour[1]):
//
$g->pie_slice_colours( array('#99FF33','#FF0033','#FFFF33','#FFEE37') );

$g->set_tool_tip( '#val#' );

if($crnnum == '%')
{
 $g->title('Efficiency For CRN:ALL (WO Qty:'.$woqty.')', '{text=bold; font-size:12px; color: #003300}');
}
else
{
 $g->title('Efficiency For CRN:'.$crnnum.' (WO Qty:'.$woqty.')', '{text=bold; font-size:12px; color: #003300}');
}
echo $g->render();
?>


