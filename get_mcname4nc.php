<?php
session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];
include('classes/helperClass.php');
$newwo = new helper;

$wo_num=$_REQUEST['wo_num'];
$stagenum=$_REQUEST['stagenum'];
$crn=$_REQUEST['crn'];
if($stagenum == "fi" || $stagenum ==  "final" || $stagenum == "FINAL" || $stagenum == "FI" || $stagenum == "Final" || $stagenum == "Fi")
{
   $stagenum='%';
   
}
$result=$newwo->getmc_name4nc($wo_num,$crn,$stagenum);

$num_rows=mysql_num_rows($result);
?>
<select name="mc_name" id="mc_name"  size="1">
<option value="select">Select</option>
<?
if($num_rows == '0')
{?>
<option value="Misc">Misc</option>
<?}
while($myrow=mysql_fetch_row($result))
{?>
<option  value="<? echo $myrow[1]?>"><?echo $myrow[1];?></option>
<?}?>
</select>