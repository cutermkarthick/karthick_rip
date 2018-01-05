<?php
include_once("classes/grnclass.php");
include_once("classes/dispatchliClass.php");

$newLI = new dispatch_line_items;
$newgrn = new grn;

$result=$newgrn->getallgrn4consupdate();

//$mygrns=mysql_num_row($result);

while($myrowgrn=mysql_fetch_row($result))
{  //echo $myrowgrn[3]."------------";
   $grnnum=trim($myrowgrn[3]);
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
}

}
?>
