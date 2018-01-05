<?php 
	
session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];
$_SESSION['pagename'] = 'attendancemonthly';
$page="ELM: Attendance";
	

$rowsPerPage = 100;

// by default we show first page
$pageNum = 1;

// if $_GET['page'] defined, use it as page number
if (isset($_REQUEST['page']))
{
    $pageNum = $_REQUEST['page'];
}
if (isset($_REQUEST['totpages']))
{
    $totpages = $_REQUEST['totpages'];
}

// counting the offset
$offset = ($pageNum - 1) * $rowsPerPage;

include_once('classes/attendanceClass.php');
include_once('classes/payrollmonthlyClass.php');
include_once('config.php');

$newattendance = new Attendance;
$newpayroll = new payroll_monthly;

$recnum = $_REQUEST['recnum'];

$empid = $_REQUEST['empid'];
$month = $_REQUEST['month'];
$year = $_REQUEST['year'];


// $result = $newpayroll->getpayroll_monthly_details($empid);
$result = $newattendance->getAllEmps4Ams($empid);
$myrow = mysql_fetch_assoc($result);
?>

<html>
<head>
<title>Pay Roll Monthly</title>
<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/payroll.js"></script>
</head>
<body leftmargin="0" topmargin="0" marginwidth="0">
<form action='process_payroll.php' method='post' enctype='multipart/form-data'>
<?php

 include('header.html');

?>

<table width=100% border=0 cellpadding=6 cellspacing=0  >
    <tr>
        <td><span class="pageheading"><b>Attendance Monthly</b></span></td>
    </tr>
</table>

<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1">
  	<tr bgcolor="#DDDEDD">
    	<td colspan=4><span class="heading"><center><b>Attendance Monthly</b></center></span></td>
        <!-- <input type="button" class="stdbtn btn_blue" style="float:right;padding:2px;margin-right:5px;" onClick="location.href='edit_payrollmaster.php?recnum=<?php echo $myrow['recnum']?>'" value="Edit Payroll Master" >   -->
    </tr>


    <tr bgcolor="#FFFFFF">
        <td><span class="labeltext"><p align="left">ID</p></span></td>
        <td><span class="tabletext"><?php echo $myrow['empid']?></span></td>
         <td></td>
        <td></td>
    </tr>


    <tr bgcolor="#FFFFFF">
        <td><span class="labeltext"><p align="left">First Name</p></span></td>
        <td><span class="tabletext"><?php echo $myrow['fname']?></span></td>
        <td><span class="labeltext"><p align="left">Last Name</p></span></td>
        <td><span class="tabletext"><?php echo $myrow['lname']?></span></td>
         
    </tr>

    <tr bgcolor="#FFFFFF">
        <td><span class="labeltext"><p align="left">Days Worked</p></span></td>
        <td><span class="tabletext"><?php echo $myrow['days_come']?></span></td>
        <td><span class="labeltext"><p align="left">Hours Worked</p></td>
        <td><span class="tabletext"><?php echo $myrow['hours_worked']?></td>
    </tr>
    

</table>
    

<?php 
    
    
    $attendance_trans = $newattendance->getAttendance_monthly_details($empid,$month,$year);
    $numrows = mysql_num_rows($attendance_trans);
    if ($numrows > 0) 
    {
        // &month='$month'&year='$year'
        // echo "<br>
        //     <a href=\"processAttendance.php?empid=$empid&month=$month&year=$year\" style=\"float:right;padding:2px;margin-right:5px;\" class=\"stdbtn btn_blue\">Compute</a>";
    }

?>
    

    <table width=100% border=0 cellpadding=3 cellspacing=1 class="stdtable" >
        <thead>
            <tr>
                <th  class="head0"><b>Seq #</b></th>
                <th  class="head0"><b>Shift Start Time</b></th>
                <th  class="head0"><b>Shift End Time</b></th>
                <th  class="head0"><b>Shift Duration</b></th>
                <th  class="head0"><b>Lat</b></th>
                <th  class="head0"><b>Lang</b></th>
                <!-- <th  class="head0"><b>Address</b></th> -->
                <th  class="head0"><b>Date</b></th>
                <th  class="head0"><b>Late By</b></th>
                <th  class="head0"><b>After Hrs</b></th>
                <th  class="head0"><b>Stage</b></th>
                <th  class="head0"><b>Duration</b></th>
                <th  class="head0"><b>Perday Hrs Worked</b></th>
               
            </tr>
        </thead>

        <tbody>
            <?php
                $i = 1;
                $prev_time = '';
                $val_arr = array();
                $prev_date = "";
                $month_details = array();
                $date_array= array();
                while ($myptli = mysql_fetch_row($attendance_trans)) 
                { 

                    if ($myptli[4] == 1) {
                        $checkInOut = 'In';
                    }else if ($myptli[4] == 0) {
                        $checkInOut = 'Out';
                    }else if ($myptli[4] == 2) {
                        $checkInOut = 'Break';
                    }

                    

                    if ($prev_time != "") {
                        if ($checkInOut == "Out") {
                            $datetime1 = new DateTime($prev_time);
                            $datetime2 = new DateTime($myptli[2]);
                            $interval = $datetime1->diff($datetime2);
                            $elapsed = $interval->format('%h:%i:%s');
                        }
                        else{
                            $elapsed = "";
                        }
                      
                    }
                    else{
                      $elapsed = "0:0:0";
                    }

                    if ($myptli[8] < 10) {
                        $start_hour = "0".$myptli[8];
                      }
                      else{
                        $start_hour = $myptli[8];
                      }
                      if ($myptli[9] < 10) {
                        $start_min = "0".$myptli[9];
                      }else{
                        $start_min = $myptli[9];
                      }
                      if ($myptli[10] < 10) {
                        $end_hour = "0".$myptli[10];
                      }else{
                        $end_hour = $myptli[10];
                      }
                      if ($myptli[11] < 10) {
                        $end_min = "0".$myptli[11];
                      }else{
                        $end_min = $myptli[11];
                      }

                      if ($myptli[8] > 12) {
                          $start_meri = "PM";
                      }
                      else
                      {
                        $start_meri = "AM";
                      }

                      if ($myptli[10] > 12) {
                          $end_meri = "PM";
                      }
                      else
                      {
                        $end_meri = "AM";
                      }

                      

                      if ($prev_date != $date_split[0]) 
                      {
                        $a = new DateTime($date_split[1]);
                        $b = new DateTime($start_hour.":".$start_min);
                        $time_diff4late = $a->diff($b);
                        $late_by = $time_diff4late->format("%h:%i");
                      }
                      else
                      {
                        $late_by = "";
                      }
                      
                      $date_split = explode(" ", $myptli[2]);
                      $split_time = $date_split[1];

                      $dates = $date_split[0];
                    

                   

                      $start_time = $start_hour.":".$start_min." ".$start_meri;
                      $end_time = $end_hour.":".$end_min." ".$end_meri;

                      $start_time_womeri = $start_hour.":".$start_min;
                      $end_time_womeri = $end_hour.":".$end_min;

                      $shift_duration = $end_hour - $start_hour;

                       $month_details[$dates][] = array('seqnum' => $i,
                                'empid' => $myptli[1],
                                'date' => $myptli[2],
                                'stage' => $checkInOut,
                                'elapsed' => $elapsed,
                                'lat' => $myptli[5],
                                'lan' => $myptli[6],
                                'address' => "fluent tech",
                                'taskid'=>$myptli[7],
                                'start_time' => $start_time,
                                'end_time' => $end_time,
                                'shift_duration' => $shift_duration,
                                'after_hrs'=>'',
                                'late_by'=>'',
                                'start_time_womeri'=> $start_time_womeri,
                                'end_time_womeri'=> $end_time_womeri);

                      

                    
                    $i++;
                    $prev_time = $myptli[2];
                    $prev_date = $date_split[0];
                }
                $j=1;
                foreach ($month_details as $datekey => $dateval) {
                        
                  
                  $datevalCnt = count($dateval);
                  $i = 1;
                  $work_hrs_day = 0;
                  $totalsec_mins = 0;
                  $total_hrs = 0;
                  $totalsec_mins = 0;
                  foreach ($dateval as $key => $value) {

                    $duration_split = explode(":", $value['elapsed']);
                    $hrs = $duration_split[0];
                    $total_hrs += $hrs;
                    $mins = $duration_split[1];
                    $secs = $duration_split[2];

                    $min2sec = ($mins * 60) + $secs;
                    $totalsec_mins += $min2sec;

                    echo "<tr>";
                    echo "<td align=\"center\"><span class=\"tabletext\">".$value['seqnum']."</span></td>";

                    if ($i == 1) {
                      
                      $a = new DateTime($value['date']);
                      $b = new DateTime($datekey." ".$value['start_time_womeri']);
                      if ($a > $b) {
                        $time_diff4late = $a->diff($b);
                        $late_by = $time_diff4late->format("%h:%i");
                        $month_details[$datekey][$key]['late_by'] = $late_by;
                      }else{
                        
                        $late_by = "0:0";
                        $month_details[$datekey][$key]['late_by'] = $late_by;
                      }
                 

                      

                      $start_time = $value['start_time'];
                      $end_time = $value['end_time'];
                      $shift_duration = $value['shift_duration'];
                      $after_hrs = "";



                      $work_hrs_day += $value['elapsed'];
                      $work_hrs = "";
                    }elseif($datevalCnt == $i){
                      
                      $a1 = new DateTime($value['date']);
                      $b1 = new DateTime($datekey." ".$value['end_time_womeri']);
                      

                      if ($a1 > $b1) {
                        $time_diff4after = $a1->diff($b1);
                        $after_hrs = $time_diff4after->format("%h:%i");
                        $month_details[$datekey][$key]['after_hrs'] = $after_hrs;
                      }else{
                        
                        $after_hrs = "0:0";
                        $month_details[$datekey][$key]['after_hrs'] = $after_hrs;
                      }

                      $start_time = "";
                      $end_time = "";
                      $shift_duration = "";
                      $late_by = "";
                      // $work_hrs = $work_hrs_day;

                      $totalsecs = $totalsec_mins;
                      $hours = floor($totalsecs / 3600);
                      $minutes = floor(($totalsecs / 60) % 60);
                      $seconds = $totalsecs % 60;

                      $hours_worked = $total_hrs + $hours;
                      $mins_worked = $minutes;
                      $secs_worked = $seconds;
                      $work_hrs = $hours_worked.":".$mins_worked.":".$secs_worked;
                    }else{
                      
                      $start_time = "";
                      $end_time = "";
                      $shift_duration = "";
                      $late_by = "";
                      $after_hrs = "";
                      $work_hrs = "";
                      $work_hrs_day += $value['elapsed'];
                    }

                    echo "<td align=\"center\"><span class=\"tabletext\">".$start_time."</span></td>";
                    echo "<td align=\"center\"><span class=\"tabletext\">".$end_time."</span></td>";
                    echo "<td align=\"center\"><span class=\"tabletext\">".$shift_duration ."</span></td>";

                    echo "<td align=\"center\"><span class=\"tabletext\">".$value['lat']."</span></td>";
                    echo "<td align=\"center\"><span class=\"tabletext\">".$value['lan']."</span></td>";
                    // echo "<td align=\"center\"><span class=\"tabletext\">".$value['address']."</span></td>";
                    echo "<td align=\"center\"><span class=\"tabletext\">".$value['date']."</span></td>";
                    echo "<td align=\"center\"><span class=\"tabletext\">".$late_by ."</span></td>";
                    echo "<td align=\"center\"><span class=\"tabletext\">".$after_hrs ."</span></td>";
                    echo "<td align=\"center\"><span class=\"tabletext\">".$value['stage']."</span></td>";
                    echo "<td align=\"center\"><span class=\"tabletext\">".$value['elapsed']."</span></td>";
                    echo "<td align=\"center\"><span class=\"tabletext\">".$work_hrs ."</span></td>";

                    $i++;
                    $j++;
                    echo "</tr>";
                  }
                  

                }



            ?>

                

        </tbody>

    </table>

    <input type="hidden" name="locatios_arr" id="locatios_arr"  value='<?php echo json_encode($month_details); ?>'>

    <div id="map" style="width:100%;height:400px;"></div>

    <script>
    
    var result = document.getElementById("locatios_arr").value;
    var location_res = JSON.parse(result);
    
        console.log("result " + JSON.stringify(location_res));


        function initMap() {

          var homeLatlng = new google.maps.LatLng(12.9958082,77.5400988);
          var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 1,
            center: homeLatlng,
            mapTypeId: google.maps.MapTypeId.ROADMAP
          });

          var infowindow = new google.maps.InfoWindow();
          var marker, i;


         
          for (var key in location_res) {
              var subarrval = location_res[key];
            for (var subkey in  subarrval) {

              if (subarrval.hasOwnProperty(subkey)) {
                var val = subarrval[subkey];
                marker = new google.maps.Marker({
                  position: new google.maps.LatLng(val.lat, val.lan),
                  map: map,
                  animation: google.maps.Animation.DROP
                });

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

              }
            }
          }
        }
      </script>
      <script async defer
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAi4EqtVuQYCRg0rXz51CE4yDxE2ajGG40&callback=initMap">
      </script>


