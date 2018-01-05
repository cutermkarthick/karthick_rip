<?php
$from = $_REQUEST['from'];
$to = $_REQUEST['to'];
include_once 'ofc-library/open_flash_chart_object.php';
open_flash_chart_object(580, 300, 'http://'. $_SERVER['SERVER_NAME'] .'/fluenterp/chart_date.php?from='.$from.'&to='.$to,false);
?>





