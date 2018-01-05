<?php 
  
session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}

$userid = $_SESSION['user'];
$_SESSION['pagename'] = 'attendancesummary';
$page="ELM: Leave";


?>
<link rel="stylesheet" href="style.css">
<html>
<head>
<title>Leave MGMT</title>
</head>
<body leftmargin="0" topmargin="0" marginwidth="0">
<?php

 include('header.html');
include_once('classes/leaveClass.php');
$newleave = new leave;

if(isset($_REQUEST['status'])&&isset($_REQUEST['recnum']))
{
    $newleave->updateStatus($_REQUEST['recnum'],$_REQUEST['status']);
}
if(isset($_REQUEST['recnum']))
{
    $leavedetails = $newleave->leaveDetails($_REQUEST['recnum']);
}
?>

<input type="button" class="stdbtn btn_blue" style="float:right;padding:2px;margin-right:5px" onClick="location.href='employee_leave_details.php?recnum=<?php echo $leavedetails['recnum']?>&status=1'" value="Accept" >
<input type="button" class="stdbtn btn_blue" style="float:right;padding:2px;margin-right:5px" onClick="location.href='employee_leave_details.php?recnum=<?php echo $leavedetails['recnum']?>&status=0'" value="Reject" >



<table width=100% align='center' border=1 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1" >



<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>From Date</p></font></td>
<td><input readonly="readonly" type="text" name="from" id="start_date" size=15 value="<?php echo $leavedetails['from']?>"></td>
<td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>To Date</p></font></td>
<td><input type="text" readonly="readonly" name="to" id="closed_date" size=15 value="<?php echo $leavedetails['to']?>"></td>
</tr>

<tr bgcolor='#FFFFFF'>

<td ><span class="labeltext"><p align="left">Reason</p></font></td>
<td ><span class="tabletext"><textarea readonly="readonly" name="reason" id="desc" cols =40 rows="2" ><?php echo $leavedetails['reason']?></textarea></td>
<td ><span class="labeltext"><p align="left">Status</p></font></td>
<td colspan=9><span class="tabletext"><input readonly="readonly" type="text" value="<?php echo $leavedetails['status']?>"> </span></td>
</tr>


</table>


 
