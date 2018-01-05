<?php
$fp = fopen("timemaster.csv","r");
$skipfirst = 1;
$conn = mysql_connect('localhost', "admin", "yOd37HmQZF9b2");
if (!$conn) {
		die('Could not connect: ' . mysql_error());
}
mysql_select_db('cimtools', $conn) or die ("connect to db failed");

while (!(feof($fp)))
{
    $line = fgets($fp);
    list($crn,$qty,$stage,$totalrt, $avgrt) =   split(",", $line, 5);
   $stage_num = $stage;
   $setup_time = 1;
   $setup_time_mins = 0;
   $running_time = sprintf("%d",$avgrt / 60);
   $running_time_mins = sprintf("%d",$avgrt % 60);
   $mps_revision = '00';
   $crn_num = $crn;
   $qty = 1;
   $sql = "select recnum from mc_master where crn_num = '$crn_num' and 
		             mps_revision= '$mps_revision'";
    //echo "<br>$sql\n";
    $result1 = mysql_query($sql) or die ("select failed for getting mcmaster");
	$num_rows = mysql_num_rows($result1);
	echo "==========================================================\n";
    echo "CRN : $crn_num and $mps_revision - numrows is $num_rows \n";
	echo "running time is $running_time\n";
	echo "running time mins is $running_time_mins\n";
	echo "setting time  is $setup_time\n";
	echo "setting time mins is $setup_time_mins\n";

    if ($num_rows == 0)
    {
            $sql = "INSERT INTO
                        mc_master
                            (
                              crn_num,qty,mps_revision
                            )
                    VALUES
                            (
                              '$crn_num',$qty,'$mps_revision'
                            )";

         //echo $sql;
             $result = mysql_query($sql) or die ("insert to mcmaster failed");

           // Test to make sure query worked
              if(!$result) die("Insert to mc_master didn't work..Please report to Sysadmin. " . mysql_error());
            $sql = "select recnum from mc_master 
			               where crn_num = '$crn_num' and
						              mps_revision = '$mps_revision'";
            $result = mysql_query($sql) or die ("select mcmaster after insert to get recnum failed");
            $myrow = mysql_fetch_row($result);
            $mc_masterrecnum = $myrow[0];
		    echo "CRN $crn_num inserted into mc_master recnum $mc_masterrecnum\n";
	}
    else 
    {
             $myrow1 = mysql_fetch_row($result1);
             $mc_masterrecnum = $myrow1[0];
    }
	
	$sql = "select recnum from mc_stage_master 
	                 where stage_num = '$stage_num' and 
		                        link2mc_master = $mc_masterrecnum";
    //echo "<br>$sql\n";
    $stageresult = mysql_query($sql) or die ("select to stage master failed");
	$num_rows = mysql_num_rows($stageresult);
    if ($num_rows == 0)
    {

        $sql = "INSERT INTO
                        mc_stage_master
                            (
                             stage_num,running_time,link2mc_master,setting_time,
                             setting_time_mins,running_time_mins
                            )
                    VALUES
                            (
                             $stage_num,$running_time,$mc_masterrecnum,$setup_time,
                             $setup_time_mins,$running_time_mins
                            )";

          //echo $sql;
          $result = mysql_query($sql) or die ("insert to stage master failed");

           // Test to make sure query worked
              if(!$result) die("Insert to mc_stage_master didn't work..Please report to Sysadmin. " . mysql_error());
	   	    echo "CRN $crn_num inserted into mc_stage_master for $stage_num\n";

	   }
       else 
	   {
              $sql = "update mc_stage_master 
				           set running_time = '$running_time',
						         running_time_mins = '$running_time_mins',
				                 setting_time = '$setup_time',
						         setting_time_mins = '$setup_time_mins'
						    where link2mc_master = $mc_masterrecnum and
							           stage_num = '$stage_num'";
              // echo "\n$sql";
              $result = mysql_query($sql) or die ("update to stage failed");
              if(!$result) die("Update to mc_stage_master failed for $crn_num..Please report to Sysadmin. " . mysql_error());
	        echo "CRN $crn_num updated for stage $stage_numwith masterrecnum  $mc_masterrecnum\n";
		}

}
fclose($fp);
?>
