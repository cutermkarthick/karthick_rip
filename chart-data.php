<?
//==============================================
// Author: FSI                                 =
// Date-written = July 02,2013                 =
// Filename: chart_data.php                    =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
//==============================================
session_start();
//header("Cache-control: private");
header("Cache-Control: cache, must-revalidate");
header("Pragma: public");
//header ("Content-type: image/png");
if ( !isset ( $_SESSION['user'] ) )
{
   header ( "Location: login.php" );
}
$userid = $_SESSION['user'];

//include 'php-ofc-library/open-flash-chart.php';
include('classes/reportClass.php');
$newreport = new report;

$start_date=$_REQUEST['start_date_wo'];
$end_date=$_REQUEST['end_date_wo'];

$start_array=explode('-',$start_date);
$start_year=$start_array[0];
$start_month=$start_array[1];

$end_array=explode('-',$end_date);
$end_year=$end_array[0];
$end_month=$end_array[1];


$month_year=array();
$open_wo=array();
$closed_wo=array();
if($start_year == $end_year)
{	
   for($j=$start_month;$j<=$end_month;$j++)
   {
	   $open='';$closed='';
		   $monthName = date("M", mktime(0, 0, 0, $j, 10));
		   $Date=$monthName.'-'.$start_year;	
		   if(intval($j) <=9)
		    $j='0'.intval($j);		 
           $cond1="(actual_ship_date!='0000-00-00' || actual_ship_date='0000-00-00' || actual_ship_date ='') and book_date like '$start_year-$j%'";		  
		   $result = $newreport->getcount_wo($cond1);
		while($wo=mysql_fetch_array($result))
	   {		
		if($wo[0] == 'Open')
			$open=$wo[1];
			else if($wo[0] == 'Closed')
			$closed=$wo[1];
	   }		
				$month_year[]=$Date;
				$open_wo[]=$open;
				$closed_wo[]=$closed;		
   }
}
if($start_year != $end_year)
{	
  $end_month1=11;$i=0;$j=0;
  for($m=$start_year ;$m<=$end_year;$m++)
  {
	    $open='';$closed='';
      // $end_month1=($m==$end_year)?$end_month:12;
      for($n=$start_month;$n<=$end_month1;$n++)
      {
        $monthName = date("F", mktime(0, 0, 0, $n, 10));
		$Date=$monthName.'-'.$m;
		if(intval($n) <=9)
			   $n='0'.intval($n);   

           $cond1="book_date like '$m-$n%' and (actual_ship_date!='0000-00-00' || actual_ship_date='0000-00-00' )";		  
		   $result = $newreport->getcount_wo($cond1);
		 while($wo=mysql_fetch_array($result))
	   {		
		if($wo[0] == 'Open')
			$open=$wo[1];
			else if($wo[0] == 'Closed')
			$closed=$wo[1];
	   }

	            $month_year[]=$Date;
				$open_wo[]=$open;
				$closed_wo[]=$closed;	
		
     }
     $start_month=1;	     
  }
}
include_once( 'ofc-library/open-flash-chart.php' );

// generate some random data
srand((double)microtime()*1000000);

//
// We are diplaying 3 bar charts, so create 3
// bar chart objects:
//

$bar_1 = new bar( 50, '#0066CC' );
$bar_1->key( 'Open WO', 10 );

$bar_2 = new bar( 50, '#639F45' );
$bar_2->key( 'Closed Wo', 10 );


//
// NOTE: how we are filling 3 arrays full of data,
//       one for each bar on the graph
//
for($x=0;$x<count($open_wo);$x++)
$bar_1->data[]  = $open_wo[$x];

for($y=0;$y<count($closed_wo);$y++)
$bar_2->data[] = $closed_wo[$y];

// create the chart:
$g = new graph();
$g->title( 'WO Chart', '{font-size: 26px;}' );

// add the 3 bar charts to it:
$g->data_sets[] = $bar_1;
$g->data_sets[] = $bar_2;
$max_val1=max($open_wo);
$max_val2=max($closed_wo);
$max=array($max_val1,$max_val2);
$max1=max($max);
//

$g->set_x_labels($month_year);
$g->set_y_max( $max1 );
$g->set_x_label_style( 10, '#9933CC', 2 );
$g->set_y_legend( 'WO PERFORMANCE', 12, '0x736AFF' );
echo $g->render();
?>