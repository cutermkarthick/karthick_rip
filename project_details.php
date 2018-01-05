<?php

//==============================================
// Author: FSI                                 =
// Date-written = April 06, 2010               =
// Filename: project_details.php               =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OMS                          =            
//==============================================

@session_start();
header("Cache-control: private");
if ( !isset ( $_SESSION['user'] ) )
{
	header ( "Location: login.php" );
}
$userid = $_SESSION['user'];
$_SESSION['pagename'] = 'task';
$page="CRM: Project";
//session_register('pagename');

// First include the class definition
include_once('classes/loginClass.php');
include('classes/projectClass.php');
include('classes/taskClass.php');

// $newLogin= userlogin::singleton();
$newproject = new project;
$newtask = new task;

$recnum=$_REQUEST['recnum'];
$cond_1='where p.recnum='.$recnum;
$cond_2='where link2project='.$recnum;


if(isset($_REQUEST['taskid']))
{
   $taskid = $_REQUEST['taskid'];
   $cond1 = "t.task_id like'" . $taskid . "%'";
}
else
{
   $taskid = "";
   $cond1 = "t.task_id like'%'";
}


if(isset($_REQUEST['status']))
{
    $status = $_REQUEST['status'];
    if ($status == "All" || $status == "new_task" || $status == "edit_task") 
    {
    	$cond2 = " t.status IN('Created' ,'Accepted', 'Dev Done', 'Tested', 'Dev Closed', 'Reopen', 'Completed', 'Checkin', 'Checkout','Break')" ;
    }
    else
    {
      $cond2 = "t.status like'" . $status . "%'";	
    }  
}
else
{
   $status = "All";
   $cond2 = " t.status IN('Created' ,'Accepted', 'Dev Done', 'Tested', 'Dev Closed', 'Reopen', 'Completed', 'Checkin', 'Checkout','Break')" ;
}

$cond = $cond_2 .' and ' . $cond1 .' and ' . $cond2;

// echo "cond $cond <br>";
// echo "<pre>";
// print_r($_REQUEST);

$result1 = $newproject->getproject_details($cond_1);
$myrow = mysql_fetch_row($result1);
$result2 = $newtask->gettask_details($cond);

$numtasks = mysql_num_rows($result2);

if($myrow[3] != '' && $myrow[3] != '0000-00-00')   
{
	$datearr = split('-', $myrow[3]);
	$d=$datearr[2];
	$m=$datearr[1];
	$y=$datearr[0];
	$x=mktime(0,0,0,$m,$d,$y);
	$start_date=date("M j, Y",$x);
}
else
{
	$start_date='';
}

if($myrow[4] != '' && $myrow[4] != '0000-00-00')   
{
	$datearr = split('-', $myrow[4]);
	$d=$datearr[2];
	$m=$datearr[1];
	$y=$datearr[0];
	$x=mktime(0,0,0,$m,$d,$y);
	$closed_date=date("M j, Y",$x);
}
else
{
	$closed_date='';
}
$desc=wordwrap($myrow[2],122,"<br/>",true);

?>

<script language="javascript" src="scripts/project.js"></script>
<script language="javascript" src="scripts/task.js"></script>
<link rel="stylesheet" href="style.css">

<html>
	<head>
		<title>Project Details</title>
	</head>

	<body leftmargin="0"topmargin="0" marginwidth="0" onload="javascript:createTab('project')">
		<form action='project_details.php' method='GET' enctype='multipart/form-data'>
		<?php
		include('header.html');
		?>

 			<table width=100% border=0 cellpadding=0 cellspacing=0>
				<tr bgcolor="#FFFFFF"><td width="6"></td>
					<table width=100% border=0>
					<?php
					if ($_SESSION['usertype'] == 'cust') 
					{
					?>
					<tr>
						<table width=100% border=0 cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
							<td align="left" width='9%'></td>
							<td align="left" width='50%'><a href ="project_Summary.php" class="btn-primary-active">Project</a></td>
						</table>
					</tr>
					<?php
					}
					?>
					<table width=100% border=0>
						<td width="100%"><span class="pageheading"><b>Project Details</b></td>
						<td align="center">
 							<input type="button" class="stdbtn btn_blue" style="float:right;padding:2px;margin-right:5px" onClick="location.href='project_Edit.php?recnum=<?echo $recnum?>'" value="Edit Project" >
 						</td>
 						<tr></tr>
					</table>
					</table>

					<table width=100% align='center' border=1 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF" style="margin-top: -4px;" class="stdtable1" >
						<tr bgcolor='#FFFFFF'>
							<td width='20%'><span class="labeltext"><p align="left">Project</p></font></td>
							<td><span class="tabletext"><?php echo $myrow[1] ?></td>
						
							<td width='20%'><span class="labeltext"><p align="left">Desc</p></font></td>
							<td><span class="tabletext"><textarea name="desc" rows="1" style="background-color:#DDDDDD;" readonly="readonly"><?php echo $desc ?></textarea></td>
						</tr>

						<tr bgcolor="#FFFFFF">
							<td><span class="labeltext"><p align="left">Start Date</p></font></td>
							<td><span class="tabletext"><?php echo $start_date ?></td>
							<td><span class="labeltext"><p align="left">End Date</p></font></td>
							<td><span class="tabletext"><?php echo $closed_date?></td>
						</tr>

						<tr bgcolor="#FFFFFF">
							<td><span class="labeltext"><p align="left">Requirement</p></font></td>
							<td><span class="tabletext"><?php echo $myrow[6]?></td>
							<td><span class="labeltext"><p align="left">Customer</p></font></td>
							<td><span class="tabletext"><?php echo $myrow[10]?></td>
						</tr>

						<tr bgcolor="#FFFFFF">
							<td><span class="labeltext"><p align="left">Category</p></font></td>
							<td><span class="tabletext"><?php echo $myrow[7] ?></td>
							<td><span class="labeltext"><p align="left">Technology</p></font></td>
							<td><span class="tabletext"><?php echo $myrow[8]?></td>
						</tr>

						<tr bgcolor="#FFFFFF">
							<td><span class="labeltext"><p align="left">Platform</p></font></td>
							<td><span class="tabletext"><?php echo $myrow[9] ?></td>
							<td><span class="labeltext"><p align="left">Manager</p></font></td>
							<td><span class="tabletext"><?php echo $myrow[5] ?></td>
						</tr>

						<table width=100% border=0>
						  <div class="contenttitle radiusbottom0">
						  	<h2>
						  		<span>Task Details
						  		<input type="button" class="stdbtn btn_blue" style="float:right;padding:2px;margin-right:5px" onClick="location.href='task_Entry.php?projrecnum=<?php echo $recnum ?>&project=<?php echo $myrow[1] ?>'" value="New Task" >
						  		</span>
					  		</h2>
						  </div>
						</table>

            <table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1">
              <tr bgcolor="#FFFFFF">
                <td><span class="labeltext"><p align="left">TaskId</p></span></td>
                <td><span class="tabletext"><input type="taskid" name="taskid" id='name' size=10 value="<?php echo $taskid; ?>"></span></td>

                <td><span class="labeltext"><p align="left">Status</p></span></td>
                <td><span class="tabletext">
                    <select name="status">
                    	<option value="All" <?php if($status == "" || $status == "All") { echo "selected='selected'" ;}?> >All</option>
                    	<option value="Created" <?php if( $status == "Created") { echo "selected='selected'" ;}?> >Created</option>
                    	<option value="Accepted" <?php if( $status == "Accepted") { echo "selected='selected'" ;}?>>Accepted</option>
                    	<option value="Dev Done" <?php if( $status == "Dev Done") { echo "selected='selected'" ;}?> >Dev Done</option>
                    	<option value="Tested" <?php if( $status == "Tested") { echo "selected='selected'" ;}?> >Tested</option>
                    	<option value="Closed" <?php if( $status == "Closed") { echo "selected='selected'" ;}?> >Closed</option>
                    	<option value="Reopen" <?php if( $status == "Reopen") { echo "selected='selected'" ;}?> >Reopen</option>
                    	<option value="Completed" <?php if( $status == "Completed") { echo "selected='selected'" ;}?> >Completed</option>
                    </select>
                  </span>
                </td>
                <td bgcolor="#FFFFFF"><span class="labeltext">
                  <input type="submit" name="Submit"  value="Get" ">
                </td>

              </tr>
            </table>


			
            
            <input type="hidden" name="recnum" value="<?php echo $recnum; ?>">
            

						<table width=100% align='center' border=1 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF" class="stdtable">
							<thead>
								<tr bgcolor="#FFFFFF">
									<td class="head0"><span class="heading"><b>Task Id</b></td>
									<td class="head0"><span class="heading"><b>Task Name</b></td>
									<td class="head0"><span class="heading"><b>Emp Id</b></td>
									<td class="head0"><span class="heading"><b>Device</b></td>
									<td class="head0"><span class="heading"><b>Task Last Lat</b></td>
									<td class="head0"><span class="heading"><b>Task Last Lon</b></td>
									<td class="head0"><span class="heading"><b>Est Duration<br>(HH:MM)</b></td>
									<td class="head0"><span class="heading"><b>Category</b></td>
									<td class="head0"><span class="heading"><b>Task Accepted <br>Timestamp</b></td>
									<td class="head0"><span class="heading"><b>Task Completed <br>Timestamp</b></td>
									<td class="head0" style="width:70px !important;"><span class="heading"><b>Actual Duration<br>(HH:MM)</b></td>
									<td class="head0"><span class="heading"><b>Status</b></td>
								</tr>
							</thead>
							<?php
							$usertype = $_SESSION['usertype'] ;
							$k = 1;
							$LastLocation4Task = array();
							while($myLI = mysql_fetch_row($result2)) 
							{
								$result3 = $newtask->gettaks_checkInOut($myLI[1]);
								$month_arr = array();
					  		$prev_date = '';
				        $prev_status = 1;
					  		$i = 0;
					  		$j = 1;

					  		
					  		
					  		$totaltask4proj = mysql_num_rows($result3);
					  		$last_loc_lat = "";
					  		$last_loc_lon = "";
					  		while ($myptli = mysql_fetch_row($result3)) 
				        {
				        	$date_split = explode(' ', $myptli[2]);
				        	$date = $date_split[0];

				        	if ($prev_date != $date) 
				        	{
				        		
				        		if ($myptli[4] == 1) {
				        			$i++;
				        			$month_arr[$date][$i] = array('checkin' => $myptli[2],'checkout' => '', 'break' => '', 'hrs_worked' =>'')	;
				        		}
				        		else if($myptli[4] == 0){

				        		}
				        		else if($myptli[4] == 2){

				        		}
				        	}
				        	else
				        	{	
				        		if ($myptli[4] == 1) {
				        			$month_arr[$date][$i]['checkin'] = $myptli[2];
				        		}
				        		if($myptli[4] == 0){
	                    if ($prev_status != 2) 
	                    {
	                        $month_arr[$date][$i]['checkout'] = $myptli[2];
	                        $checkin_dt = $month_arr[$date][$i]['checkin'];

	                        $datetime1 = new DateTime($checkin_dt);
	                        $datetime2 = new DateTime($myptli[2]);
	                        $interval = $datetime1->diff($datetime2);
	                        $elapsed = $interval->format('%h|%i|%s');
	                        $month_arr[$date][$i]['hrs_worked'] = $elapsed;
	                        $month_arr[$date][$i]['checkin'] = $month_arr[$date][$i]['checkin'];
	                        
	                    }
	                    else
	                    {   
	                        $month_arr[$date][$i]['checkout'] = $myptli[2];
	                        $month_arr[$date][$i]['break'] = $month_arr[$date][$i]['break'];
	                        $elapsed = '0|0|0';
	                        $month_arr[$date][$i]['hrs_worked'] = $elapsed;
	                    }
					        			
					        			$i++;
				        		}
				        		else if($myptli[4] == 2){
				        			$month_arr[$date][$i]['break'] = $myptli[2];
				        			$checkin_dt = $month_arr[$date][$i]['checkin'];

				        			$datetime1 = new DateTime($checkin_dt);
											$datetime2 = new DateTime($myptli[2]);
											$interval = $datetime1->diff($datetime2);
											$elapsed = $interval->format('%h|%i|%s');
              				$month_arr[$date][$i]['hrs_worked'] = $elapsed;
				        			$i++;
				        		}

				        	}

				        	$prev_date = $date;
			            $prev_status = $myptli[4];
			            if ($totaltask4proj == $j) {
			            	if ($myptli[4] == 1) {
                        $checkInOut = 'In';
                    }else if ($myptli[4] == 0) {
                        $checkInOut = 'Out';
                    }else if ($myptli[4] == 2) {
                        $checkInOut = 'Break';
                    }
			            	$LastLocation4Task[$k] = array(
																							'address'=>'fluent tech',
																							'empid'=> $myptli[1],
																							'date'=> $myptli[2],
																							'lat'=> $myptli[5],
																							'lan'=>$myptli[6],
																							'stage'=> $checkInOut);
			            	$last_loc_lat = $myptli[5];
			            	$last_loc_lon = $myptli[6];
			            	$k++;
			            }

			            
				        	$j++;
				        }


				        $totalhrs = 0;
				        $totalsec_mins = 0;
				        foreach ($month_arr as $dkey => $daysval) {
				        	foreach ($daysval as $key => $value) {
				        		$hrs_worked_split = explode('|', $value['hrs_worked']);
				        		$hrs = $hrs_worked_split[0];
				        		$mins = $hrs_worked_split[1];
				        		$secs = $hrs_worked_split[2];

				        		$min2sec = ($mins * 60) + $secs;
				        		$totalsec_mins += $min2sec;
				        		$totalhrs += $hrs;
				        	}
				        }

				        if ($myLI[13] != "" && $myLI[14] != "") {
				        	$task_st_date = new DateTime($myLI[13]);
	                $task_ed_date = new DateTime($myLI[14]);
	                $taskinterval = $task_ed_date->diff($task_st_date);
	                $task_duration = $taskinterval->format('%h:%i:%s');
				        }
				        else
				        {
				        	$task_duration = "0:0:0";
				        }

				        

				        $totalsecs = $totalsec_mins;
								$hours = floor($totalsecs / 3600);
								$minutes = floor(($totalsecs / 60) % 60);
								$seconds = $totalsecs % 60;

								$hours_worked = $totalhrs + $hours;
								$mins_worked = $minutes;
								$secs_worked = $seconds;

								$task_wo_hrs = $hours_worked .':'.$mins_worked ;

								$est_hrs = $myLI[11] != '' ? $myLI[11] : 0;
								$est_mins = $myLI[12] != '' ? $myLI[12] : 0;

								echo "<tr>";
								$notes=wordwrap($myLI[6],122,"<br/>",true);

									
								echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\"><a href=\"task_details.php?recnum=$myLI[0]&link2project=$recnum&project=$myrow[1]\">$myLI[1]</td>" ;
								echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$myLI[2]</td>";
								echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$myLI[15]</td>";
								echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$myLI[16]</td>";
								echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$last_loc_lat</td>";
								echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$last_loc_lon</td>";
								echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$est_hrs Hrs:$est_mins Mins</td>";
								echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$myLI[3]</td>";       
								echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$myLI[13]</td>";       
								echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$myLI[14]</td>";     
								echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$task_duration</td>";  
								echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$myLI[5]</td>";	
							}


							?>
								</tr>

								<tr>
									<td  bgcolor="#FFFFFF" colspan=10></td>
									<td  bgcolor="#FFFFFF"><span class="heading"><b># Tasks</b></span></td>
									<td bgcolor="#FFFFFF"><span class="heading"><b><?php echo $numtasks?></b></span></td>
								</tr>

						</table>
					</tr>
				</table>
		</form>

		<input type="hidden" name="locatios_arr" id="locatios_arr"  value='<?php echo json_encode($LastLocation4Task); ?>'>

		<div id="map" style="width:100%;height:400px;"></div>
		<div id="marker-tooltip"></div>

		<script>
		
		var result = document.getElementById("locatios_arr").value;
		var location_res = JSON.parse(result);
				var length_arr = Object.keys(location_res).length;
				
      	function initMap() {

	        var homeLatlng = new google.maps.LatLng(12.9958082,77.5400988);
	        var map = new google.maps.Map(document.getElementById('map'), {
	          zoom: 1,
	          center: homeLatlng,
	          mapTypeId: google.maps.MapTypeId.ROADMAP
	        });

	        var infowindow = new google.maps.InfoWindow();
	        var marker, i;


		     	var start = "";
		     	var end = "";
		     	
	      	for (var key in location_res) {
				  	if (location_res.hasOwnProperty(key)) {
				  		var val = location_res[key];
				  		marker = new google.maps.Marker({
				        position: new google.maps.LatLng(val.lat, val.lan),
				        map: map,
				        animation: google.maps.Animation.DROP,
				        label: (val.stage.substring(0,2))
				        
				      });

				  		var directionsService = new google.maps.DirectionsService;
		        	var directionsDisplay = new google.maps.DirectionsRenderer;
		        	directionsDisplay.setMap(map);

			      	google.maps.event.addListener(marker, 'click', (function(marker, i){
				        return function() {
				          infowindow.setContent(val.address);
				          infowindow.open(map, marker);
				        }
			      	})(marker, i));

			      	google.maps.event.addListener(marker, 'mouseover', (function(marker, i){
				        return function() {
				          content = '<b>Lat: '+val.lat+'<br> Lon: '+val.lan+'<br> Address: '+ val.address+'</b>';
				          infowindow.setContent(content);
				          infowindow.open(map, marker);
				        }
			      	})(marker, i));

			      	google.maps.event.addListener(marker, 'mouseout', (function(marker, i){
				        return function() {
				         
				          infowindow.open(null);
				        }
			      	})(marker, i));

			      	
			      	if (length_arr == 0) 
			      	{
			      		start = val.lat;
			      		end = val.lat;

			      	}
			      	else
			      	{
			      		start = end;
			      		end = val.lat
			      	}

			      	if (start != 0 && end != 0) {
			      		// calculateAndDisplayRoute(directionsService, directionsDisplay,start,end,val);	
			      		console.log("start " +start);
			      		console.log("end " +end);
			      	}
			      	
				  	}
						

    			}
      	}

      	function calculateAndDisplayRoute(directionsService, directionsDisplay,start, end, val) {

      		var latlng = new google.maps.LatLng(val.lat, val.lan);
          var geocoder = new google.maps.Geocoder();
          geocoder.geocode({ 'latLng': latlng }, function (results, status) {
              if (status == google.maps.GeocoderStatus.OK) {
                  if (results[1]) {
                      console.log("Location: " + results[1].formatted_address);
                  }
              }
          });

	        directionsService.route({
	          origin: 'Mettur Dam, Mettur, Tamil Nadu',
	          destination: 'Basaveshwar Nagar, Bengaluru, Karnataka',
	          travelMode: 'DRIVING'
	        }, function(response, status) {
	        	console.log("response " + JSON.stringify(response));
	          if (status === 'OK') {
	            directionsDisplay.setDirections(response);
	          } else {
	            window.alert('Directions request failed due to ' + status);
	          }
	        });
	      }

	    </script>
	    <script async defer
	    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAi4EqtVuQYCRg0rXz51CE4yDxE2ajGG40&callback=initMap">
	    </script>

	</body>
</html>
