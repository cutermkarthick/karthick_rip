<?php

include_once( 'ofc-library/open-flash-chart.php' );
$ponum = $_REQUEST['ponum'];
$po = $_REQUEST['po'];
include_once('classes/loginClass.php');

$newlogin = new userlogin;
$newlogin->dbconnect();
$sql= "select li.recnum,
li.line_num,
li.duedate,
li.due_date1,
li.due_date2,
li.accepted_date,
li.order_qty,
li.qty_recd,
p.podate
from po_line_items li, company c, po p
where
li.link2po = p.recnum and
p.recnum = $ponum and
c.recnum = p.link2vendor 
order by p.ponum,li.line_num";
       // echo $sql;
        $result1 = mysql_query($sql);
		$bar = new bar_outline( 50, '#00ff00', '#8010A0' );
		$bar2=new bar_outline( 50, '#ffff00', '#8010A0' );
		$bar3=new bar_outline( 50, '#9933CC', '#8010A0' );
		
		$bar->key( 'OnTime ', 10 );
		$bar2->key( 'Infull', 10 );
		$bar3->key( 'Avg', 10 );
		$data = array();
		$otcnt=0;
		$cnt=0;
		$ifcnt=0;

		while($myrow = mysql_fetch_row($result1))
		{
          
			$dat=$myrow[8];
			$cnt++;
			$due=date_create($myrow[2]);
			$delivry=date_create($myrow[5]);

			if(date_diff($due,$delivry)>=0 && $myrow[6]==$myrow[7])//before or ontime full qty
			{
				  $otcnt++;
				  $ifcnt++;
	
			}
			else if(date_diff($due,$delivry)>=0 && $myrow[6]>$myrow[7])//before or ontime less qty
			{
				  $otcnt++;

			}
			else if(date_diff($due,$delivry)<0 && $myrow[6]<=$myrow[7])//before or ontime less qty
			{
				  
			}


		}
		$bar->data[]=($ifcnt*100)/$otcnt;
		$bar2->data[]=100/$ifcnt;
		$bar3->data[]=((($ifcnt*100)/$otcnt)+((100)/$ifcnt))/2;




$g = new graph();
$g->title( 'OTIF Chart for '.$po, '{font-size: 20px;}' );

//
// BAR CHART:
//
//$g->set_data( $data );
//$g->bar_filled( 50, '#9933CC', '#8010A0', 'Page views', 10 );
//
// ------------------------
//
$g->data_sets[] = $bar;
$g->data_sets[] = $bar2;
$g->data_sets[] = $bar3;

//
// X axis tweeks:
//
//$g->set_x_labels( array( $dat ) );
$g->set_x_labels( array( '' ) );
//
// set the X axis to show every 2nd label:
//
$g->set_x_label_style( 10, '#9933CC', 0, 2 );
//
// and tick every second value:
//
$g->set_x_axis_steps( 2 );
//


$g->set_y_max( 100 );
$g->y_label_steps( 8 );
$g->set_y_legend( 'Percentage', 12, '#736AFF' );
$g->set_x_legend( '', 12, '#736AFF' );
echo $g->render();
?>
