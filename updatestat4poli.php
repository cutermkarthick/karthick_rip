<?php
session_start();
header("Cache-control: private");
if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );
}
$userid = $_SESSION['user'];

include('classes/liClass.php');
$newLI = new po_line_items;

$resultset1= $newLI->getallpolidetails();
while($myresult1=mysql_fetch_assoc($resultset1))
{
  echo"<BR>in update  for ponum and grnnum is ".$myresult1['ponum'] . " and " . $myresult1['grn_num']."<br>";
  $newLI->updatestat4poli($myresult1['grn_num'],$myresult1['crn'],$myresult1['recnum']);
}
?>
