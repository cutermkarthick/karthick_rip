<?php
 session_start();
 header("Cache-control: private");
include('classes/loginClass.php');

$userid = $_SESSION['user'];
if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}

// Store all the WOs for part status processing in an array 
 //$arr = array("5757:1");
 //$arr = array("6995:2","7030:80","3616:3","5761:1","6194:1","9989:1","8987:2","7002:4","9001:1","9377:5","10703:10");
 //$arr = array("5080:5","10695:4","4458:2","10698:3","10185:1","11179:5","10696:1","3745:2","10948:1","8205:1","10397:2","10398:2");
 //$arr = array("6842:1","11196:8","8506:1","8048:4","6439:1","9711:3","3473:45","000495:14","8670:6","10208:2","7509:6","7651:4","10400:2");
 //$arr = array("7780:16","6080:6","7742:10","11231:4","10338:1","9831:1","7494:17","9999:8","10384:2","11200:1","7044:100");
 //$arr = array("008371:1","3166:1","3434:9","3321:3","2597:1","00858:4","2199:1","3123:3","8615:4","00218:5","00219:18","5881:1","00213:11","8593:2","3671:7","1458:17");
 $arr = array("00837:1");
// $arr = array("");


// Keep wo count
$wocount=0;
// Process each work order - only closed wos and those that have FI in part status
// Pick each work order and subtract inp qty from accepted and put the inp qty in Hold
foreach ($arr as $wonum_qty) 
{
	$inparr = split(":",$wonum_qty);
	$wonum = $inparr[0];
	$inpqty = $inparr[1];
	echo "<br>=================Processing WO for part status : $wonum======================";

    $result_wo=getwoInfo($wonum);
	$woinfo=mysql_fetch_assoc($result_wo);
    $wocond=$woinfo['cond'];
    $woshipdate = $woinfo['actual_ship_date'];
    $worecnum = $woinfo['recnum'];
	echo "<br>wo condition is $wocond";
	echo "<br>wo shipdate is $woshipdate";
	echo "<br>wo recnum is $worecnum";
	echo "<br>Adj qty is $inpqty";
    $acc=getpartstat($worecnum);
	echo "<br>Acc qty for $wonum is $acc";
    if ($acc > 0 and $wocond == 'Closed' and $woshipdate != '0000-00-00' and $woshipdate != '' and $woshipdate != 'NULL')
	{
        updatewopartstat($worecnum,$inpqty);
        echo "<br>WO $wonum partstatus and comp_qty updated";
		$wocount++;
    }
}
echo "<br>================================================";
echo "<br>No. of WOs processed : $wocount<br>";
function getwoInfo($wonum)
{
  $newlogin = new userlogin;
  $newlogin->dbconnect();
  $sql="select `condition` as cond,actual_ship_date,recnum 
          from work_order 
		  where wonum='$wonum'";
  //echo "<br>$sql";
  $result=mysql_query($sql);
  return $result;
}
function getpartstat($worecnum)
{
  $newlogin = new userlogin;
  $newlogin->dbconnect();
  $sql="select acc 
          from wo_part_status wps
          where (wps.stage = 'final' or wps.stage = 'Final'
				or wps.stage = 'FINAL' or wps.stage = 'fi' or
                wps.stage = 'FI' or wps.stage = 'Fi') and
		        wps.link2wo = $worecnum";
  //echo "<br>$sql";
  $result=mysql_query($sql);
  $num_rows = mysql_num_rows($result);
  if ($num_rows > 1)
  {
       echo "<br>More than 1 row for Final in $wonum...dont process";
	   return 0;
  }
  $getacc=mysql_fetch_assoc($result);
  $acc=$getacc['acc'];
  return $acc;
}
function updatewopartstat($worecnum,$inpqty)
{
  $newlogin = new userlogin;
  $newlogin->dbconnect();
  $sql="update wo_part_status
         set acc = acc-$inpqty,
		     hold = $inpqty
         where link2wo = $worecnum";
  //echo "<br>$sql";
  $result=mysql_query($sql);
  if (!$result) die ("Error while part status update for wo $wonum and worecnum is $worecnum<br>");
  $sql="update work_order
         set comp_qty = comp_qty-$inpqty
         where recnum = $worecnum";
  //echo "<br>$sql";
  $result=mysql_query($sql);
  if (!$result) die ("Error while wo(comp_qty) update for wo $wonum and worecnum is $worecnum<br>");
}

?>
</tr>
</table>
</table>
</div>
</body>
</html>
