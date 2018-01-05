<div id="crn_prev_stat">
<?
include('classes/workorderClass.php');

$crn=$_REQUEST['crn'];
//echo $crn;

$newwo = new workOrder;
$result=$newwo->getprevcrndetails($crn);


$prev_crnstat='0';
while($myrow=mysql_fetch_row($result))
{
$edate = $myrow[1];
      $today = date("Y-m-d");
      //echo "Today is $edate<br>$today";
      $date_parts1=explode('-', $edate);
      $start_date=gregoriantojd($date_parts1[1], $date_parts1[2], $date_parts1[0]);
      $date_parts2=explode('-', $today);
      $end_date=gregoriantojd($date_parts2[1], $date_parts2[2], $date_parts2[0]);
      $diff = $end_date - $start_date;
      //echo $diff;
        if ($myrow[0] == '0000-00-00' || $myrow[0] == '' || $myrow[0] == 'null' || $myrow[2] == 'Open')
       {
            if ($myrow[3] == 'With Treatment' && $diff > 112)
	    {
              $prev_crnstat = "1";
	    }
            if ($myrow[3] != 'With Treatment' && $diff > 84)
	    {
              $prev_crnstat = "1";
	    }
	 }

}

echo"<td><input type=\"hidden\" name=\"crn_stat\" id\"crn_stat\" value=\"$prev_crnstat\"></td>";
?>
</div>
