<?php
session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
include_once("classes/consumptionClass.php");
$newconsumption = new consumption;

$row = 1;
//echo $row;
			$handle = fopen("./newinvoice.txt", "r");

			$i=0;
			while ((($data = fgetcsv($handle, 1000, ",")) !== FALSE)){

			$num=16;

			$row++;

				if($i==0)
					{

					}
			   else
					{
                      echo"$data[0]<br>";
                      $dataarr=split(':',$data[0]);
                      echo$dataarr[0]."-------".$dataarr[1]."<br>";
                      $newconsumption->update_expinvnum($dataarr[0],$dataarr[1]);
					}
					$i++;
				}
fclose($handle);








?>
