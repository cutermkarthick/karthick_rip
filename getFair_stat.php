<?php

//==============================================
// Author: FSI                                 =
// Date-written = sep27, 2010                  =
// Filename: getFair_status.php                =
// Copyright (C) FluentSoft Inc.               =
// Revision: v1.0                              =
//==============================================

include_once('classes/fairClass.php');
include_once('classes/workorderClass.php');
$crn = $_REQUEST['crn'];
$newfair = new fair;
$newworkOrder = new workOrder;

$flag='0';
$prev_fair_flag='0';
$rework_flag='0';
$result_prev_fair = $newfair->get_prev_fairs($crn);
$myrow_prev =  mysql_fetch_row($result_prev_fair);
if(mysql_num_rows($result_prev_fair) >= 2)
{
  $prev_fair_flag='1';
}
$result = $newfair->get_prev_fair_details($crn);
$myrow = mysql_fetch_row($result);
if(mysql_num_rows($result) > 0 )
{
  if($myrow[1] == '' || $myrow[1] == "NULL")
  {
    $flag='1';
  }
}
 $resultwo=$newworkOrder->getworkorder4redflag($crn) ;
 //$myresult4wo=mysql_fetch_row($resultwo);
 while($myresult4wo=mysql_fetch_row($resultwo))
 {    
      $myrewres=$newworkOrder->getrework_dets4crn($crn) ;
      $edate = $myresult4wo[1];
      $today = date("Y-m-d");
     // echo "Today is $today<br>";
      $date_parts1=explode('-', $edate);
      $start_date=gregoriantojd($date_parts1[1], $date_parts1[2], $date_parts1[0]);
      $date_parts2=explode('-', $today);
      $end_date=gregoriantojd($date_parts2[1], $date_parts2[2], $date_parts2[0]);
      $diff = $end_date - $start_date;
     // echo "Diff is $diff-----------$myresult4wo[3]-------------$myresult4wo[2]<br>";
      $red_flag='0';

        if ($myresult4wo[0] == 'With Treatment' && 
			($myresult4wo[4] == 0 || $myresult4wo[4] == '') && 
			$diff > 112)
	    {
              $red_flag = '1';
	    }
        if ($myresult4wo[0] != 'With Treatment' && $diff > 84)
	    {
              $red_flag = '1';
        }
       // $myrewres=$newworkOrder->getreworkdets4crn($crn) ;
       //&& $myresult4wo[0] == 'With Treatment'
       if($myrewres >0  && $diff > 21)
       {
          $rework_flag='1';
       }
  }
echo "<input type=\"hidden\" name=\"fair_stat\" id=\"fair_stat\" value=\"$flag\">";
echo "<input type=\"hidden\" name=\"prev_fairs\" id=\"prev_fairs\" value=\"$prev_fair_flag\">";
echo "<input type=\"hidden\" name=\"red_flag\" id=\"red_flag\" value=\"$red_flag\">";
echo "<input type=\"hidden\" name=\"rework_flag\" id=\"rework_flag\" value=\"$rework_flag\">";
?>