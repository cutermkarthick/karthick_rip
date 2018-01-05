<?php
include_once("classes/consumptionClass.php");
include_once("classes/dispatchliClass.php");
$newconsumption = new consumption;
$newLI = new dispatch_line_items;

$result=$newconsumption->getallgrn4consupdate();

//$mygrns=mysql_num_row($result);

while($myrowgrn=mysql_fetch_row($result))
{  //echo $myrowgrn[3]."------------";
  /* $grnnum=trim($myrowgrn[3]);
  // $newgrn->updateconsumptionreg4update($grnnum,$myrowgrn[0],$myrowgrn[1],$myrowgrn[2],$myrowgrn[10],$myrowgrn[4],$myrowgrn[5],$myrowgrn[6],$myrowgrn[7],$myrowgrn[8],$myrowgrn[9]);

  $resultdn=$newgrn->getdispatch4update($grnnum);
 // $mydnrow=mysql_fetch_row($resultdn);


  
 //echo $myconsinfo[0]."*-*-*-";


  while($mydnrow=mysql_fetch_row($resultdn))
  {              $c="C";
                 $disp_recnum=$c.$mydnrow[0];
                 $resultcons=$newLI->getgrnmcofcdet4cons($grnnum);
                 $myconsinfo=mysql_fetch_row($resultcons);
                if($myconsinfo[1]=='')
                {       //echo"HERE-----".$myrowgrn[10]."-*-**-*--*".$myconsinfo[0];
                  $newLI->updatetoconsumption($myrowgrn[2],$mydnrow[1],$disp_recnum,$myrowgrn[10],$myconsinfo[0]);
                }
                else
                 {
                   if($myconsinfo[1]==$disp_recnum)
                   {
                      $dqty=$newLI->getdispqty4grn($grnnum,$disp_recnum);
                      //echo $dqty."-*-**-*-*-";
                      $newLI->updatetoconsumption($myrowgrn[2],$dqty,$disp_recnum,$myrowgrn[10],$myconsinfo[0]);
                   }
                   else
                    {  //echo"HERE---22222--".$myrowgrn[10]."-*-**-*--*".$myconsinfo[0];
                       $newLI->addtoconsumption($grnnum,$myrowgrn[0],$myrowgrn[1],$myrowgrn[2],$mydnrow[1],$disp_recnum,$myrowgrn[10],$myrowgrn[4],$myrowgrn[5],$myrowgrn[6],$myrowgrn[7],$myrowgrn[8],$myrowgrn[9]);
                    }
                  }
} */

   $grnnum=trim($myrowgrn[3]);
   $resultqtyrej=$newconsumption->getworej4consupdate($myrowgrn[3]);
   $myrejqty=mysql_fetch_row($resultqtyrej);
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
               echo $prev_grn."--***---".$myrowgrn[3];
                    if($prev_grn!=$myrowgrn[3])
                   {     echo "HERE---";
                     if($myrowgrn[12]!='' && $myrowgrn[12] !='-' && $myrowgrn[12]!='NA' && $myrowgrn[12]!=0)
                       {
                         $dimension = " (".$myrowgrn[11]."X".$myrowgrn[12]."X".$myrowgrn[13].")";
                       }else
                       {
                         $dimension = " (".$myrowgrn[11]."X".$myrowgrn[13].")";
                       }
                       $qty =$myrowgrn[10];
                       $qty_make = $myrowgrn[2];
                       $prev_grn=$myrowgrn[3] ;
                       $qty_rej =$myrejqty[0];
                     }else
                     {  echo "HERE----11----";
                       if($myrowgrn[12]!='' && $myrowgrn[12] !='-' && $myrowgrn[12]!='NA' && $myrowgrn[12]!=0)
                       {
                         $dimension = " (".$myrowgrn[11]."X".$myrowgrn[12]."X".$myrowgrn[13].")".$dimension;
                       }else
                       {
                         $dimension = " (".$myrowgrn[11]."X".$myrowgrn[13].")".$dimension;
                       }
                       $qty +=$myrowgrn[10];
                       $qty_make += $myrowgrn[2];
                       //$qty_rej +=$myrejqty[0];
                     }

                       $grn= $myrowgrn[0];
                       $rmspec= $myrowgrn[6]." ".$dimension." ;".$myrowgrn[14];
                       //echo $qty_make."<br>";
 //$newLI->updatetoconsumptionrej($grnnum,$qty_rej);
//$newconsumption->consumptionUpdate4restore($grnnum,$myrowgrn[0],$myrowgrn[1],$qty_make,$myrowgrn[9],$myrowgrn[4],$rmspec,$myrowgrn[7],$myrowgrn[8],$uom,$qty, $qty_rej);

$resultdn=$newconsumption->getdispatch4update($grnnum);


  while($mydnrow=mysql_fetch_row($resultdn))
  {
                 $c="C";
                 $result_cons=$newLI->getgrnmcofcdet4cons($grnnum);
                 $disp_recnum=$c.$mydnrow[0];
                 $resultcons=$newLI->getgrnmcofcdet4cons($grnnum);
                 $myconsinfo=mysql_fetch_row($resultcons);
                 //echo "H---E---R---E";
                if($myconsinfo[1]=='')
                {       //echo"<br>HERE-----".$myrowgrn[10]."-*-**-*--*".$myconsinfo[0];
                   $newLI->updatetoconsumption($qty_make,$mydnrow[1],$disp_recnum,$myrowgrn[9],$myconsinfo[0],$qty_rej);
                   $newLI->updatetoconsumptionrej($grnnum1,$qtyrej);
                }
                else
                 {
					echo "<br>In else";
                   $cofcinfo=$newLI->getcofcnuminfo($grnnum,$disp_recnum);
                   //echo mysql_num_rows($resultcons)."----";
                   if(mysql_num_rows($cofcinfo)>0)
                   {
					   //echo $qty_rej."--------".$disp_recnum ;
                      while($mycons_info=mysql_fetch_row($result_cons))
                      {
                         //echo "<br>++++++++++++++$mycons_info[1]---in ---the---loop---$disp_number<br>";
                       if($mycons_info[1]==$disp_recnum)
                          {
                            $dqty=$newLI->getdispqty4grn($grnnum,$disp_recnum);
                            //echo $dqty."-*-**-*IN-*-$myconsinfo[0]<br>";
                           $newLI->updatetoconsumption($qty_make,$dqty,$disp_recnum,$myrowgrn[9],$mycons_info[0],$qty_rej);
                           $newLI->updatetoconsumptionrej($grnnum,$qtyrej);
                           }
                       }

                    }
                   else
                    {
					   //echo"HERE---22222--".$myrowgrn[10]."-*-**-*--*".$mydnrow[1];
                       $newconsumption->consumptionUpdate4restoredispatch($grnnum,$myrowgrn[0],$myrowgrn[1],$qty_make,$myrowgrn[9],$myrowgrn[4],$rmspec,$myrowgrn[7],$myrowgrn[8],$uom,$qty, $qty_rej,$disp_recnum,$mydnrow[1]);
                    }
                  }
}

}
?>
