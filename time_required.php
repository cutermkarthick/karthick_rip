<?
@session_start();
header("Cache-control: private");
if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );
}
include('classes/delivery_schClass.php');
$newdelivery_sh = new deliverye_sch;

$crnnum=$_REQUEST['crnnum'];
$schedule_qty=$_REQUEST['schedule_qty'];

$result=$newdelivery_sh ->gettime_required4crn($crnnum);
$myrow = mysql_fetch_row($result);
$time_required = ($myrow[0] + $schedule_qty*$myrow[1]);
$hours = ($time_required % 60);
$mins = intval($time_required / 60);
if($hours == '0')
{
$req_time = $mins.' Mins';
}else{
$req_time = $hours.' H '.$mins. '  Mins ';
}
?>
<input type="text"  name="time_required" id="time_required"  value="<?php echo $time_required ?>" style="background-color:#DDDDDD;"  readonly='readonly'>
