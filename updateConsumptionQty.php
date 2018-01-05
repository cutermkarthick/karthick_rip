<?php

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
include_once("classes/consumptionClass.php");

$newconsumption = new consumption;

$result=$newconsumption->getallgrn4consupdate();
 $uom='';
//$mygrns=mysql_num_row($result);

while($myrowgrn=mysql_fetch_row($result))
{
                     if($myrowgrn[5]!='' && $myrowgrn[5] !='-' && $myrowgrn[5]!='NA' && $myrowgrn[5]!=0)
                       {
                         $dimesion = " (".$myrowgrn[4]."X".$myrowgrn[5]."X".$myrowgrn[6].")";
                       }else
                       {
                         $dimesion = " (".$myrowgrn[4]."X".$myrowgrn[6].")";
                       }
                       $rmspec= $myrowgrn[8]." ".$dimesion." ;".$myrowgrn[7];
                      // echo $rmspec."----";
   $newconsumption->updateconsumptionreg4qty($myrowgrn[0],$myrowgrn[1],$myrowgrn[3],$rmspec);
}
?>
