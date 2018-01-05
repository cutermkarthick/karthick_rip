<?php
 session_start();
 header("Cache-control: private");
include('classes/loginClass.php');

$userid = $_SESSION['user'];
if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}

// Store all the WOs in an array
//$arr = array("7816","7818","7908","7920","8004","8151","8279","8324","8340","8557","8683","8777","8808","8995","9308","9500","9506");
//$arr = array("9518","9747","9797","10079","10187","10248","10327","10454","10567","10654","10687","10784","10813","10898","11078");
//$arr = array("11079","11080","11193","11194","11201","11222","98","170","2980","10447","10560","209","2397","2550","3448","3637");
//$arr = array("3737","3740","4210","5444","5445","5733","5734","6278","6345","6346","6784","6915","7065","7066","7739","8010");
//$arr = array("2503","2504","2506","2940","3664","3690","3781","3782","3794","3965","4209","5149","5219","6523","8427","9794","9795","10116");
//$arr = array("4171","4195","4196","4198","5865","6188","6904","8623","10168","10169");
// HAL work orders
 //$arr = array("2230","2233","2234","2235","2236","2237","2238","2239","2240","2241","2242","2243","2244","2245","2327","2507","2545");
//$arr = array("2731","3172","3299","3540","4073","4309","4843","5132","5371","5768","5771","6256","6408","6941","7415","7416","8305");
//$arr = array("8319","8320","8511","8512","945","1347","1359","1362","1388","1777","1778","1779","1829","1849","2090","2091","2587");
//$arr = array("2588","2913","2914","3702");
//$arr = array("00098");
$arr = array("00209","00170");

// Keep wo count
$wocount=0;
// Process each work order - first check condition and then if there is a Cofc or not
foreach ($arr as $wonum) 
{
	echo "<br>=================Processing WO : $wonum======================";
    $result_wo=getwoInfo($wonum);
	$woinfo=mysql_fetch_assoc($result_wo);
    $wocond=$woinfo['cond'];
    $woshipdate = $woinfo['actual_ship_date'];
	echo "<br>wo condition is $wocond";
	echo "<br>wo shipdate is $woshipdate";
    $cofc=getcofc($wonum);
	echo "<br># of cofcs for wo $wonum is $cofc";
    if ($cofc == 0 and $wocond == 'Open' and ($woshipdate = '0000-00-00' || $woshipdate = ''))
	{
        updatewo($wonum);
        echo "<br>WO $wonum updated to Hold";
		$wocount++;
    }
}
echo "<br>================================================";
echo "<br>No. of WOs processed : $wocount<br>";
function getwoInfo($wonum)
{
  $newlogin = new userlogin;
  $newlogin->dbconnect();
  $sql="select `condition` as cond,actual_ship_date from work_order where wonum='$wonum'";
  //echo "<br>$sql";
  $result=mysql_query($sql);
  return $result;
}
function getcofc($wonum)
{
  $newlogin = new userlogin;
  $newlogin->dbconnect();
  $sql="select recnum,dispatch_qty from dispatch_line_items where wonum = '$wonum'";
  echo "<br>$sql";
  $result=mysql_query($sql);
  $num_rows = mysql_num_rows($result);
  //echo "<br>numrows is $num_rows";
  return $num_rows;
}
function updatewo($wonum)
{
  $newlogin = new userlogin;
  $newlogin->dbconnect();
  $sql="update work_order set `condition`='Hold',actual_ship_date = '0000-00-00' where wonum = '$wonum'";
  $result=mysql_query($sql);
  if (!$result) die ("Error while updating for wo $wonum<br>");
}

?>
</tr>
</table>
</table>
</div>
</body>
</html>
