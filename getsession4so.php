<?php
include('classes/salesorderClass.php');
$newsalesorder = new salesorder;

$result_session = $newsalesorder->getcompany();
$flag_session='0'; $sess_flag=0;
while($myrow_sess=  mysql_fetch_row($result_session))
{
  $sess_flag++;
  $flag_session=$sess_flag;

}
echo "<input type=\"hidden\" name=\"sess_flag\" id=\"sess_flag\" value=\"$flag_session\">";

?>
