<?php
include('classes/nc4qaclass.php');

$newnc = new nc4qa;

$wo_num=$_REQUEST['wo_num'];
//echo $wo_num;
$nc_recnum=$newnc->getwo_check($wo_num);

if($nc_recnum != '')
{
  echo "<table border=1><tr><td><font color=#FF0000>";
  die( " NC Already Exists for this WO: " .$wo_num);
  echo "</td></tr></table>";
}

?>

