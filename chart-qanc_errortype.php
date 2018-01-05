<?php
session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}

$userid = $_SESSION['user'];
if($_REQUEST['dimdiv'])
{
 $dimdiv=$_REQUEST['dimdiv'];
}
else
{
 $dimdiv=0;
}
if($_REQUEST['matdiv'])
{
 $matdiv=$_REQUEST['matdiv'];
}
else
{
 $matdiv = 0;
}
if($_REQUEST['others'])
{
 $others = $_REQUEST['others'];
}
else
{
 $others = 0;
}


$total = $dimdiv + $matdiv + $others;
// generate some random data
srand((double)microtime()*1000000);

$data = array();

//$data[] = $matdiv;
//$data[] = $dimdiv;
//$data[] = $others;

$label_dim = 'DIM DEVIATION('.$dimdiv.')';
$label_matdiv = 'MATERIAL DEVIATION('.$matdiv.')';
$label_others = 'OTHER DEVIATION('.$others.')';

include_once( 'ofc-library/open-flash-chart.php' );
$g = new graph();

//
// PIE chart, 60% alpha
//
$g->pie(80,'#505050','{font-size: 10px; color: #404040;');
//
// pass in two arrays, one of data, the other data labels
//
//$g->pie_values( $data, array('DIMENSIONAL DEVIATION','MATERIAL DEVIATION','OTHER DEVIATION'));
if($dimdiv != 0 && $matdiv != 0 && $others != 0 )
{
 $data[] = $matdiv;
 $data[] = $dimdiv;
 $data[] = $others;
 $g->pie_values($data, array($label_matdiv,$label_dim,$label_others));
}
else if($dimdiv != 0 && $matdiv != 0 && $others == 0)
{
 $data[] = $dimdiv;
 $data[] = $matdiv;
 $g->pie_values($data, array($label_dim,$label_matdiv));
}
else if($dimdiv != 0 && $matdiv == 0 && $others == 0)
{
 $data[] = $dimdiv;
 $g->pie_values($data, array($label_dim));
}
else if($matdiv != 0 && $dimdiv == 0 && $others == 0)
{
 $data[] = $matdiv;
 $g->pie_values($data, array($label_matdiv));
}
else if($others != 0 && $dimdiv != 0 && $matdiv == 0)
{
 $data[] = $dimdiv;
 $data[] = $others;
 $g->pie_values($data, array($label_dim,$label_others));
}
else if($others != 0 && $matdiv != 0 && $dimdiv == 0)
{
 $data[] = $matdiv;
 $data[] = $others;
 $g->pie_values($data, array($label_matdiv,$label_others));
}
else if($others != 0 && $matdiv == 0 && $dimdiv == 0)
{
 $data[] = $others;
 $g->pie_values($data, array($label_others));
}
//
// Colours for each slice, in this case some of the colours
// will be re-used (3 colurs for 5 slices means the last two
// slices will have colours colour[0] and colour[1]):
//
$g->pie_slice_colours(array('#FFFF00','#99FF00','#CC0000'));

$g->set_tool_tip( '#val#' );

$g->title( 'QA NC ERROR TYPE(Total-'.$total.')', '{font-size:18px; color: #d01f3c}' );
echo $g->render();
?>


