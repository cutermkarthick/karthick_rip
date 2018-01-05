
<?php

include_once( 'ofc-library/open-flash-chart.php' );
$from = $_REQUEST['from'];
$to = $_REQUEST['to'];
include_once('classes/loginClass.php');
$newlogin = new userlogin;
$newlogin->dbconnect();
$sql= "select recnum,
		      line_num,
			  duedate,
			  due_date1,
			  due_date2,
			  accepted_date,
		      order_qty,
			  qty_recd
       from po_line_items 
	   where
	        (due_date2 between '$from' and '$to')
			          or
            (due_date1 between '$from' and '$to')
       order by line_num";
					   //and (accepted_date !='0000-00-00' && accepted_date !='')
       // echo $sql;
        $result = mysql_query($sql);

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

		while($myrow = mysql_fetch_row($result))
		{
			$cnt++;
			$due=new DateTime($myrow[2]);
			$delivry=new DateTime($myrow[5]);

			// if($due>=$delivry && $myrow[6]==$myrow[7])//before or ontime full qty
			// {
			// 	  $otcnt++;
			// 	  $ifcnt++;
	
			// }
			// elseif($due>=$delivry && $myrow[6]>$myrow[7])//before or ontime less qty
			// {
			// 	  $otcnt++;

			// }
			// elseif($due<$delivry && $myrow[6]<=$myrow[7])//dued lesser or equal qty
			// {
				  
			// }


			if($myrow[6]>=$myrow[7])
			{
					if($due>=$delivry)
					{
 						$otcnt++;
						$ifcnt++;

					}
					else 
					{
						$ifcnt++ ;

					}


			}

		}
		$bar->data[]=($ifcnt*100)/$otcnt;
		$bar2->data[]=100/$ifcnt;
		$bar3->data[]=((($ifcnt*100)/$otcnt)+((100)/$ifcnt))/2;




$g = new graph();
$g->title( 'OTIF Chart:'.$from." to ".$to, '{font-size: 20px;}' );

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
$g->set_x_labels( array( 'Within range' ) );
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
$g->set_x_legend( ' ', 12, '#736AFF' );
echo $g->render();
?>