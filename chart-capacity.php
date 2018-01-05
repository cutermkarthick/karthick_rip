<?php
session_start();
include('classes/mc_capacityClass.php');
$newlogin = new userlogin;
$newlogin->dbconnect();

$newmc_capacity = new mc_capacity;
$param=$_REQUEST['param'];
$param=explode("|",$param);

$mc_name=$param[0];
$start_date=$param[1];
$end_date=$param[2];
if($mc_name=='all')
   $ms='%';	
else
   $ms=trim("$mc_name");

$start_array=explode('-',$start_date);
$start_year=$start_array[0];
$start_month=$start_array[1];
$end_array=explode('-',$end_date);
$end_year=$end_array[0];
$end_month=$end_array[1];

include 'php-ofc-library/open-flash-chart.php';
$datearr=array();
$crn_qty=array();
$y_legend=array();
$disp=array();

if($start_year == $end_year)
{
   for($j=$start_month;$j<=$end_month;$j++)
   {  
        if(intval($j) <=9)
		    $j='0'.intval($j);	
		$datearr[]=($j.'-'.$start_year);
		$cond="plan_month = trim('$j') and plan_year=trim('$start_year') and mc_name  like '$ms'";
        $res_plan=$newmc_capacity->get_capacity_plan4reqcrnhrs($cond);
		$myrow_plan=mysql_fetch_array($res_plan);
		$p_month[]=$myrow_plan['plan_month'];
		$p_year[]=$myrow_plan['plan_year'];
   }
}
if($start_year != $end_year)
{	
  $end_month1=12;
  for($m=$start_year ;$m<=$end_year;$m++)
  {
	  $end_month1=($m==$end_year)?$end_month:12;
      for($n=$start_month;$n<=$end_month1;$n++)
      {
			if(intval($n) <=9)
			   $n='0'.intval($n);			
			$datearr[]=($n.'-'.$m);
			$cond="plan_month = trim('$n') and plan_year=trim('$m') and mc_name  like '$ms'";
			$res_plan=$newmc_capacity->get_capacity_plan4reqcrnhrs($cond);
			$myrow_plan=mysql_fetch_array($res_plan);
			$p_month[]=$myrow_plan['plan_month'];
			$p_year[]=$myrow_plan['plan_year'];
	  }
	  $start_month=1;
  }
}

$st=date('M,Y',strtotime($start_date));
$et=date('M,Y',strtotime($end_date));

$title = new title( $mc_name.'  '.$st.' - '.$et);
$title->set_style( "{font-size: 13px; color: #F24062; text-align: center;margin-bottom:20px}" );
$bar_stack = new bar_stack();
$bar_stack->set_colours( array( '#ADFF2F', '#00FFFF', '#7D7B6A','#0066CC' ,'#D2691E','#006400','#556B2F','#FF00FF','#50284A','#C4D318') );
$colrs=array( '#ADFF2F', '#00FFFF', '#7D7B6A','#0066CC' ,'#D2691E','#006400','#556B2F','#FF00FF','#50284A','#C4D318');
$spareflag = 0;

$crnarr=array();
$data_1=array();
$karr=array();

// echo "<pre>";
// print_r($datearr);

foreach($datearr as $date)
{
$da=  split('-', $date);
$month=$da[0];
$year=$da[1];


$pre_m=''; 
$pre_y='';
$crn_qty=array();
$max='';
$prev_mc='';
$ftflag = 0;

$result=$newmc_capacity->get_mc_capacity($ms,$month,$year);  
if(mysql_num_rows($result)>0)
{	 
	$myrow_mast=mysql_fetch_row($result);
	  $bal_crn_qty=''; 
	  $mcarr=array();
	  $totreqhrs=0;
	  $cond="plan_month = trim('$month') and plan_year=trim('$year') and mc_name  like '$ms'";	  	
	  $i=0;
	  $totreq_crn_hrs=0;

	  $res1=$newmc_capacity->get_capacity_plan_chartcap($cond);	 
	  while($myrow=mysql_fetch_array($res1))
	  { 
		    if ($ftflag == 0)
		    {
				$prev_mc=$myrow['mc_name'];	
				$ftflag = 1;
		    }
		    $crn_qty=array();
            $res2=$newmc_capacity->get_capacity_plan4reqcrnhrs($cond);	
			while($myrow1=mysql_fetch_array($res2))
		    {
			  $crn_qty[]=(int)$myrow1['ff_qty_hrs'];	
		    }		   
			$totreq_crn_hrs+=(int)$myrow['ff_qty_hrs'];
			if($myrow['plan_month']!=$pre_m && $myrow['plan_year']!=$pre_y)
		    {
				$monthName = date("M", mktime(0, 0, 0, $myrow['plan_month'], 10));
		    	$y_legend[]=($monthName.'-'.$myrow['plan_year']);		
				$pre_m=$myrow['plan_month'];
			}
			//print_r($y_legend);
			$pre_y=$myrow['plan_year'];
			
			$crnarr[]=$myrow['ff_qty_hrs'];		
            $storemc = $myrow['mc_name'];
			if (!array_key_exists($storemc, $mcarr) && $storemc != '') 
		    {
                $mcarr[$storemc] = 	floor($myrow['mc_cap_hrs']);	
				$max +=floor($myrow['mc_cap_hrs']);	
			}
			$bal_crn_qty +=floor($myrow['balance_crn_hrs']);
			$crnsplit=split("-",$myrow['crn']);
			$new_crnsplit[]=$crnsplit[0].'- Series';
            $i++;	
     		$prev_mc=$myrow['mc_name'];

      }	
	
	  //print_r($p_year);

	if(in_array($myrow_mast[5],$p_month)  && in_array($myrow_mast[6],$p_year))
	{
	  $max_val[]=$max;  
	  $da=$max;
	  $data_1[]=$da;
	  $monthName = date("M", mktime(0, 0, 0, $month, 10));
	  $bal_qty=floor(($max/100)*85);
	  if(floor($totreq_crn_hrs) <= floor($bal_qty))
	  {
		  $bal_mc_hrs=floor($bal_qty)-floor($totreq_crn_hrs);
		  $totreqhrs=floor($totreq_crn_hrs)+$bal_mc_hrs;
		  array_push($crn_qty,new bar_stack_value($bal_mc_hrs, '#ff00ff') );	  
		  $bar_stack->append_stack($crn_qty);
	  }
	  else
	  {
		  $bal_mc_hrs=floor($bal_qty);
	      $totreqhrs=$bal_mc_hrs;	  
		  $bar_stack->append_stack($crn_qty);
	  }	
	  if ($spareflag == 0)
	  {
		 $spareflag = 1;
	  }
	  $data_2[]= $totreqhrs;

	  // echo "crn qty <br>";
	  // echo "<pre>";
	  // print_r($crn_qty);


	}
  }  
}


$max_val=max($max_val);	
$min_val=(int)($max_val/6);
$tooltip = new tooltip();
$tooltip->set_hover();

$bar_stack->set_tooltip( 'Hours =#val#<br>Total =#total#' );
$tip = 'Title!<br>Test weird characters:';

$line_1 = new line();
$line_1->set_values( $data_1 );
$line_1->set_colour( '#FFFF00' );

$line_2 = new line();
$line_2->set_values( $data_2 );
$line_2->set_colour( '#ADFF2F' );

$y = new y_axis();
$y->set_range(0,$max_val,$min_val);

$x = new x_axis();
$x_labels = new x_axis_labels();
$x_labels->set_vertical();
$x_labels->set_colour( '#CF4D5F' );

// nice big font
$x_labels->set_size( 16 );
// set the label text
$x_labels->set_labels(
    $y_legend
    );
//$x->set_labels_from_array($y_legend);
$x->set_labels( $x_labels );


$tooltip = new tooltip();
$tooltip->set_hover();

$chart = new open_flash_chart();

$chart->set_title( $title );
$chart->add_element( $bar_stack );
$chart->set_x_axis( $x );
$chart->add_y_axis( $y );
$chart->bg_colour = '#FFFFFF';
$chart->add_element( $line_1 );
$chart->add_element( $line_2 );
echo $chart->toPrettyString();
?>
