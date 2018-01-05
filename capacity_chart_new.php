<?php
//==============================================
// Author: FSI                                 =
// Date-written: May 22, 2013                  =
// Filename: capacity_chart_new.php            =
// Copyright of Badari Mandyam, FluentSoft     =
// Revision: v1.0 OMS                          =
// Board details                               =
//==============================================

session_start();
header("Cache-control: private");
if ( !isset ( $_SESSION['user'] ) )
{
    header ( "Location: login.php" );
}

include_once('classes/loginClass.php');
include('classes/displayClass.php');
include('classes/mc_capacityClass.php');

	$userid = $_SESSION['user'];
	$_SESSION['pagename'] = 'capacity_chart';
	$page = "MES: Cap Chart";

	$newlogin = new userlogin;
	$newlogin->dbconnect();
	$newdisplay = new display;
	$newmc_capacity = new mc_capacity;

	$dept=$_SESSION['department'];

	
	$result=$newmc_capacity->get_all_mc();  
	$r=mysql_fetch_array($result);

	
	
	if (isset($_REQUEST['mc_series'])) 
	{	
		$mc_series=$_REQUEST['mc_series']; 
		
	}
	else
	{
		$mc_series = 'select'; 
	}

	if (isset($_REQUEST['frm'])) 
	{
		$start_date=$_REQUEST['frm'];
	}

	if (isset($_REQUEST['to'])) 
	{
		$end_date=$_REQUEST['to'];
	}

	if(isset($_REQUEST['frm']) == '')
	{
		$end_date = date("Y-m-d");
		$start_date = date("Y-m-d",strtotime('last month'));
	}
	?>

<html>
	<head>
		<style>
			p.serif 
			{
			    font-family: "Times New Roman", Times, serif;color:blue;font-size:25px;
			}
			p.sansserif
			{
			    font-family: "Times New Roman", Times, serif;font-size:20px;color:red;
			}
		</style>

		<script language="javascript" src="scripts/mouseover.js"></script>
		<script language="javascript" src="scripts/mc_capacity.js"></script>
		<script language="javascript" src="scripts/jquery.js"></script>
		<script language="javascript" src="js/chartjs.min.js"></script>

		<link rel="stylesheet" href="style.css">
		<title>M/C Capacity Chart</title>
	</head>

	<body leftmargin="0" topmargin="0" marginwidth="0" >
		<?php
		include('header.html');
		?>

			<td><span class="pageheading"><b>M/C Capacity Chart</b></td>
		</tr>

		<form action='capacity_chart_new.php' method='get' enctype='multipart/form-data'>
		<tr>
			<td>
				<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1">
					<tr bgcolor="#DDDEDD">
						<td colspan=4><span class="heading"><center><b>Machine Capacity Chart</b></center></td>
					</tr>

					<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">

					<tr bgcolor="#FFFFFF">
						<td><span class="labeltext">M/C </p></font></td>
						<td><span class="tabletext">

						<?php        
							$result=$newmc_capacity->get_all_mc();        
						?>
							<select name="mc_series" onchange="javascript:getmc_series(this)">
								<option <?php echo (($mc_series=='select')?"selected":"")?> value="select">Please Select</option>
								<option <?php echo (($mc_series=='all')?"selected":"")?> value="all">ALL</option>
								<?php
									while ($myrow = mysql_fetch_row($result))
									{
										if($myrow[0]==$_REQUEST['mc_series'])
										{
											?>
											<option selected value="<? echo $myrow[0]?>"><?echo $myrow[0]; ?> </option>
											<?php
										}
										else
										{
											?>
											<option value="<? echo $myrow[0]?>">
											<?echo $myrow[0]; ?> </option>
											<?php
										}
									}
								?>
							</select>
						</td>

						<td  bgcolor="#FFFFFF" width='40%'><span class="labeltext"><b>From &nbsp&nbsp</b>
				         	<input type="text" id="frm" name="frm" size=10 value="<?php echo $start_date ?>" style="background-color:#DDDDDD;">
						    <img src="images/bu-getdateicon.gif" alt="Get Date" onclick="GetDate('frm')">
						    <span class="labeltext"><b>&nbsp;&nbsp;To</b>
						    <input type="text" id="to" name="to" size=10 value="<?php echo $end_date ?>" style="background-color:#DDDDDD;">
						    <img src="images/bu-getdateicon.gif" alt="Get Date" onclick="GetDate('to')">  
						</td>

						<td><span class="labeltext"><input type="image" name="Submit" src="images/bu-get.gif" value="Get" onclick="javascript: return fetch_cap_req()">
						</td>

					</tr>
				</table>
				<br/>

				<?php

					if($mc_series != 'select' && $start_date !='' &&  $end_date!='')
					{	
						$crn_usage_hrs = array(); 

						if($mc_series=='all')
						{
					      	$ms='%';	
						}
					   	else
					   	{
					      	$ms=trim("$mc_series");
					   	}

					   	$start_array=explode('-',$start_date);
					   	$start_year = $start_array[0];
					   	$start_month = $start_array[1];
					   	if($start_month < 10)
					   	{
							$start_month=(int)$start_month;
					   	}

						$end_array=explode('-',$end_date);
						$end_year=$end_array[0];
						$end_month=$end_array[1];
						if($end_month < 10)
						{
							$end_month=(int)$end_month;
						}

						$p_month = array();
						$p_year = array();

						if($start_year == $end_year)
						{
						   for($j=$start_month;$j<=$end_month;$j++)
						   {  
						        if(intval($j) <=9){
								    $j='0'.intval($j);	
						        }
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
							for ($m=$start_year; $m<=$end_year ; $m++) 
							{ 
								$end_month1=($m==$end_year)?$end_month:12;

								for($n=$start_month;$n<=$end_month1;$n++)
						      	{
									if(intval($n) <=9)
									{
									   $n='0'.intval($n);			
									}


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


						$colrs_arr = array( '#ADFF2F', '#00FFFF', '#7D7B6A','#0066CC' ,'#D2691E','#006400','#556B2F','#FF00FF','#50284A','#C4D318');

						$mc_max_hrs_array = array();
						$colors4crn = array();
						$crncolr_cnt = 0;
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

								
								while($myrow_mast=mysql_fetch_row($result))
								{
									
									$mc_max_hrs_array[$myrow_mast[2]][] = $myrow_mast[4];

								}


								
								$bal_crn_qty=''; 
								$mcarr=array();
								$totreqhrs=0;
								$cond="plan_month = trim('$month') and plan_year=trim('$year') and mc_name  like '$ms'";	  	
								$i=0;
								$totreq_crn_hrs=0;

								



								$res1=$newmc_capacity->get_capacity_planchart($cond);
								while($myrow=mysql_fetch_array($res1))
	  							{	
	  								
	  								if ($prev_mc != $myrow['mc_name']) 
	  								{
	  									
	  									$m_name=$myrow['mc_name'];
	  								}
	  								else
	  								{
	  									$m_name=$myrow['mc_name'];
	  								}

	  								$crn_usage_hrs[$m_name][$date][] = array('crn' => $myrow['crn'], 'used_hrs' => $myrow['ff_qty_hrs'], 'mc_hrs'=> $myrow['mc_cap_hrs']);
								    
	  								$prev_mc=$myrow['mc_name'];

	  								if (!array_key_exists($myrow['crn'], $colors4crn)) {
									    $colors4crn[$myrow['crn']] = $colrs_arr[$crncolr_cnt];
									}

	  								$crncolr_cnt++;
	  							}

							}

							
						}


						$st=date('M,Y',strtotime($start_date));
						$et=date('M,Y',strtotime($end_date));
 

					   	$chart = 1;

					   	foreach ($crn_usage_hrs as $mcn => $mc_arr1) 
					   	{	

					   		// echo "<pre>";
					   		// print_r($mc_arr1);
					   		
					   		$max_hrs = max($mc_max_hrs_array[$mcn]);

					   		echo'<script type="text/javascript"> 
								$(document).ready(function()
								{	
									var chart = ' . $chart .' 
									var value = ' . "'" . json_encode($crn_usage_hrs) ."'" .' 
									var mc = "' . $mcn . '"
									var total_mc_hrs = "' . $max_hrs . '"
									drawChart1(chart,mc,value, total_mc_hrs); 
								});
								</script>';

							?>
								<div style="border: 1px solid black; width:50%; " >
									<canvas id="myChart<?php echo $chart ?>" style="margin-left: 10px;"></canvas>	
								</div>
								<br>
								<input type="hidden" name="chart_det<?php echo $chart; ?>" id="chart_det<?php echo $chart; ?>"  value='<?php echo json_encode($crn_usage_hrs); ?>'>	
							<?php 
					   		$chart++;

					   		
					   	}

					   	?>

					   	<input type="hidden" name="colors4crn" id="colors4crn"  value='<?php echo json_encode($colors4crn); ?>'>
	
						<script type="text/javascript">

								function drawChart1(i,mc_name,value, mchrs)
								{
									var colorsarr = document.getElementById("colors4crn").value;
									var colorsarr1 = JSON.parse(colorsarr);
									
									console.log("colorsarr1 " + JSON.stringify(colorsarr1));

									var crnusage = document.getElementById("chart_det"+i).value;
									var frm_dt = document.getElementById("frm").value;
									var to_dt = document.getElementById("to").value;

									var result = JSON.parse(value);

									var monthNames = [ "Jan", "Feb", "Mar", "Apr", "May", "Jun", 
                       								   "Jul", "Aug", "Sep", "Oct", "Nov", "Dec" ];

									var frm_d = new Date(frm_dt);
									var frm_short_month = monthNames[frm_d.getMonth()];
									var frm_year = frm_d.getFullYear();


									var to_d = new Date(to_dt);
									var to_short_month = monthNames[to_d.getMonth()];
									var to_year = to_d.getFullYear();


									var from_date = frm_short_month+', '+frm_year;
									var to_date = to_short_month+', '+to_year;
									

									var ctx = document.getElementById("myChart"+i).getContext('2d');
									ctx.canvas.width = 650;
									ctx.canvas.height = 300;
									var myChart = new Chart(ctx, {
								  	type: 'bar',
								  	scaleOverride : true,
								  	data: {
									    labels: [],
									    datasets: [{
								  				type: 'line',
								  				label: 'Total Available',
								  				yAxisID: "y-axis-0",
										        data:  [],
										        fill: false,
							                    borderColor: '#FFFF00',
							                    backgroundColor: '#FFFF00',
							                    pointBorderColor: '#FFFF00',
							                    pointBackgroundColor: '#FFFF00',
							                    pointHoverBackgroundColor: '#FFFF00',
							                    pointHoverBorderColor: '#FFFF00'
											},

											{
								  				type: 'line',
								  				label: 'Utilization upto 85%',
								  				yAxisID: "y-axis-1",
										        data:  [],
										        fill: false,
							                    borderColor: '#ff00ff',
							                    backgroundColor: '#ff00ff',
							                    pointBorderColor: '#ff00ff',
							                    pointBackgroundColor: '#ff00ff',
							                    pointHoverBackgroundColor: '#ff00ff',
							                    pointHoverBorderColor: '#ff00ff'
											}]
								  	},
									  	options: {
										    scales: {
										      xAxes: [{
										      	gridLines: {
							                        display: false
							                    },
										        stacked: true
										      }],
										      yAxes: [{
										      	gridLines: {
							                        display: true
							                    },
										        stacked: true,
										        id: "y-axis-0",
										        ticks: {
										            beginAtZero: true,
					                                steps: 7
										        }
										      }, {
										        display: false,
										        stacked: false,
										        id: "y-axis-1",
										        ticks: {
										            beginAtZero: true,
					                                steps: 7
										        }
										      }]


										    },
										    responsive: false,
										    legend: {
										    	position: "right",
										    	display: true
										    },
										    title: {
									            display: true,
									            text: mc_name +' '+ from_date + ' - ' + to_date,
									            fontColor: "#F24062"
								          	},
										    tooltips: {
										      callbacks: {

										        title: function(tooltipItem, data) {
										           return  tooltipItem[0].xLabel;
										        },
										        label : function(tooltipItem, data) {
						                        	var t_label = "Used Hrs " + ': ' + tooltipItem.yLabel + "\n" + " Total Hrs "  + myChart.data.datasets[2].t_hrs ;
						                        	return t_label;
						                    	},
										      }
										    },
								        	animation: {
										      onComplete: function () {
										        var chartInstance = this.chart;
										        var ctx = chartInstance.ctx;
										        var height = chartInstance.controller.boxes[0].bottom;
										        ctx.textAlign = "center";
										        ctx.fillStyle = "White";
										        Chart.helpers.each(this.data.datasets.forEach(function (dataset, i) {
										          var meta = chartInstance.controller.getDatasetMeta(i);
										          Chart.helpers.each(meta.data.forEach(function (bar, index) {
										            
										            var data = dataset.data[index];
										            if (data != 0) 
										            {	
										            	ctx.fillText(data, bar._model.x, bar._model.y + 5);	
										            }
										          }),this)
										        }),this);
										      }
										    }
									  	}


									});


									var randomColorGenerator = function (val) { 
									    $colrs = new Array( '#ADFF2F', '#00FFFF', '#7D7B6A','#0066CC' ,'#D2691E','#006400','#556B2F','#FF00FF','#50284A','#C4D318');
			    						return $colrs[val];
									};

									

                       				var crn_temp_arr  = [];
                       				

                       				var stack_cnt = 1;
                       				var crn_list = {};

									for (var key in result) 
									{

										if (key == mc_name) 
										{
											prevsubkey = '';
											crn_list[key] = {};
											
									 		for (subkey in result[key])
									 		{
									 			
												crn_list[key][subkey] = {};
										  		var val = result[key][subkey];

										  		var crn_cnt = 0;

											   	for (var i = 0; i < val.length; i++) 
											   	{
											   		
											   		crn = crn_temp_arr.indexOf(val[i].crn);

											   		if (crn < 0) 
											   		{
											   			crn_temp_arr.push(val[i].crn);
											   			 
											   			
											   		}

											   	}

										   		var array_list = {};
												crn_temp_arr.forEach(function(crn){
													
													array_list[crn] = [];

												})

												array_list['unused_hrs'] = [];

											}

										
											for (subkey in result[key])
											{
												
												var crn_array = result[key][subkey];

												mc_used_hrs_month = 0;

												for (var j = 0; j < crn_temp_arr.length; j++)  
												{

													var found=false;
													for(var l=0;l<crn_array.length;l++)
													{
														if(crn_array[l].crn.indexOf(crn_temp_arr[j]) == 0) {
															found=true;
															break;
														};

													}
													if(found)
													{
														var sum=0;
														for(var m=0;m<crn_array.length;m++)
														{
															if(crn_array[m].crn==crn_temp_arr[j])
																sum=parseFloat(sum)+parseFloat(crn_array[m].used_hrs);
														}
														array_list[crn_temp_arr[j]].push(sum);
														mc_used_hrs_month += parseFloat(sum);
													}
													else
													{
														array_list[crn_temp_arr[j]].push(0);
														mc_used_hrs_month += parseFloat(0);
													}
												}


												spare_hrs = Math.round(parseFloat(crn_array[0].mc_hrs) - parseFloat(mc_used_hrs_month) );

												array_list['unused_hrs'].push(spare_hrs);

												var mc_utilization_85perc = Math.round(((85/100) * parseInt(crn_array[0].mc_hrs)));

												myChart.data.datasets[0].data.push(crn_array[0].mc_hrs);
												myChart.data.datasets[1].data.push(mc_utilization_85perc);
												
											}


											for (subkey in result[key])
											{

												month_split = subkey.split('-');

												var d = new Date(month_split[1] +'-'+month_split[0]);
												var short_month = monthNames[d.getMonth()];
												var bar_label = short_month+', '+ month_split[1];

												myChart.data.labels.push(bar_label);

												var chart_crn_array = result[key][subkey];

												var month_crns = [];

												for (var m = 0; m < chart_crn_array.length; m++) 
												{

													var crns_lists = array_list[chart_crn_array[m].crn]
													
													

													crn_check = month_crns.indexOf(chart_crn_array[m].crn);

											   		if (crn_check < 0) 
											   		{
											   			month_crns.push(chart_crn_array[m].crn);
											   			crn_colors = chart_crn_array[m].crn;

											   			myChart.data.datasets.push({
											  				type: 'bar',
														    label: chart_crn_array[m].crn,
													        // backgroundColor: randomColorGenerator(m), 
													        backgroundColor: colorsarr1[crn_colors], 
													        data:  crns_lists,
													        't_hrs': chart_crn_array[m].mc_hrs,
														})

											   		}

												}

												myChart.options.scales.yAxes[0].ticks['max'] = parseFloat(mchrs.trim());

											}

											myChart.data.datasets.push({
									  				type: 'bar',
												    label: 'spare Hrs',
											        backgroundColor: '#0d45ad', 
											        data:  array_list['unused_hrs'],
											        't_hrs': mchrs,
												})

											myChart.update();
											
										}

										
									}

									
									// console.log("all crns list " + crn_temp_arr);
									// console.log("all crn bgcolor list " + JSON.stringify(array_list));

								}


						</script>

					   	<?php


					}

				?>



		</table>

		</table>
	</table>
  
	</body>
</html>