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
 $uom=''; $prev_grn='#'; $rmspec='';
//$mygrns=mysql_num_row($result);

while($myrowgrn=mysql_fetch_row($result))
{    //echo $myrowgrn[9]."<br>";
   $resrmmaster=$newconsumption->getallrmdetails($myrowgrn[9]);
   $myrmres=mysql_fetch_row($resrmmaster);

               if(($myrmres[0] !='' && $myrmres[0] !='-'&& $myrmres[0] !='NA' && $myrmres[0] !='Not Applicable' )&& ($myrmres[1] !='' && $myrmres[1] !='-' && $myrmres[1] !='NA'&& $myrmres[1] !='Not Applicable'))
               {
                  $uom='NOS';//echo"HERE---";
               }
               else if(($myrmres[0] !='' && $myrmres[0] !='-'&& $myrmres[0] !='NA' && $myrmres[0] !='Not Applicable'))
               {
                  $uom='Meters'; //echo"HERE--1111-";
               }
               else if(($myrmres[1] !='' && $myrmres[1] !='-' && $myrmres[1] !='NA'&& $myrmres[1] !='Not Applicable') && ($myrmres[2] !='' && $myrmres[2] !='-' && $myrmres[2] !='NA'&& $myrmres[2] !='Not Applicable') && ($myrmres[3] !='' && $myrmres[3] !='-' && $myrmres[3] !='NA'&& $myrmres[3] !='Not Applicable'))
               {
                   $uom='NOS'; //echo"HERE--52222-";
               }

                     if($prev_grn!=$myrowgrn[3])
                   {
                     if($myrowgrn[12]!='' && $myrowgrn[12] !='-' && $myrowgrn[12]!='NA' && $myrowgrn[12]!=0)
                       {
                         $dimension = " (".$myrowgrn[11]."X".$myrowgrn[12]."X".$myrowgrn[13].")";
                       }else
                       {
                         $dimension = " (".$myrowgrn[11]."X".$myrowgrn[13].")";
                       }
                       $prev_grn=$myrowgrn[3] ;


                     }else
                     {
                       if($myrowgrn[12]!='' && $myrowgrn[12] !='-' && $myrowgrn[12]!='NA' && $myrowgrn[12]!=0)
                       {
                         $dimension = " (".$myrowgrn[11]."X".$myrowgrn[12]."X".$myrowgrn[13].")".$dimension;
                       }else
                       {
                         $dimension = " (".$myrowgrn[11]."X".$myrowgrn[13].")".$dimension;
                       }
                      }

                       $rmspec= $myrowgrn[6]." ".$dimension." ;".$myrowgrn[14];
                       echo $rmspec."----".$uom."<br>";
   $newconsumption->updateconsumptionreg4spec($myrowgrn[3],$rmspec,$uom);
}
?>
