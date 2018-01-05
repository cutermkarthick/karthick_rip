<?php
//==============================================
// Author: FSI                                 =
// Date-written = May 14, 2012                 =
// Filename: uploadConsumptionProcess.php      =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OWT                          =
// Processing of consumption Upload            =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];

$pagename = $_SESSION['pagename'];

include('classes/consumptionClass.php');
$closingbal=0;
include_once("classes/dispatchliClass.php");
$newconsumption = new consumption;
$newLI = new dispatch_line_items;
$grnnum = $_REQUEST['grnnum'];
$uom='';   $dimension=''; $prev_grn='#'; $rmspec='' ; $qty=0; $qty_make=0; $qty_rej=0; $qty_rework=0;$wonum=''; $prevgrn='#';
                $newlogin = new userlogin;
				$newlogin->dbconnect();
				$resgrndets=$newconsumption->getgrndets4upload($grnnum);
   while($myrowgrn=mysql_fetch_row($resgrndets))
{  //echo $myrowgrn[3]."------------";
   $grnnum=trim($myrowgrn[3]);
   $resultqtyrej=$newconsumption->getworej4consupdate($myrowgrn[3]);
   $myrejqty=mysql_fetch_row($resultqtyrej);

   $resrmmaster=$newconsumption->getallrmdetails($myrowgrn[9]);
   $myrmres=mysql_fetch_row($resrmmaster);
   
   $resinvdets=$newconsumption->getconsumptiondets4grn($myrowgrn[0]);
   $myinvdet=mysql_fetch_assoc($resinvdets) ;
   
    $bond_num=$_REQUEST['bond_num'];
    $be_num =$_REQUEST['be_num'];
    

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
                       $qty =$myrowgrn[10];
                       $qty_make = $myrowgrn[2];
                       $qty_rej =$myrejqty[0];
                       $qty_rework=($myrejqty[1]+$myrejqty[2]);
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
                       $qty +=$myrowgrn[10];
                       $qty_make += $myrowgrn[2];
                     }
                       $grn= $myrowgrn[0];
                     //  echo $qty_rework."-------". $qty_rej."--------".$myrowgrn[3]."<br>";
                       $rmspec= $myrowgrn[6]." ".$dimension." ;".$myrowgrn[14];
$newconsumption->consumptionUpdate4restore($grnnum,$myrowgrn[0],$myrowgrn[1],$qty_make,$myrowgrn[9],$myrowgrn[4],$rmspec,$myrowgrn[7],$myrowgrn[8],$uom,$qty, $qty_rej,$myinvdet['bond_num'], $myinvdet['bonddate'],$myinvdet['be_num'], $myinvdet['bedate'], $myinvdet['assessval'], $myinvdet['cifval'], $myinvdet['dutyamt'], $myinvdet['invamt'],$myinvdet['currency']);



$resultdn=$newconsumption->getdispatch4update($grnnum);
              while($mydnrow=mysql_fetch_row($resultdn))
              {
                 $c="C";
                 $result_cons=$newLI->getgrnmcofcdet4cons($grnnum);
                 $disp_recnum=$c.$mydnrow[0];
                 $resultcons=$newLI->getgrnmcofcdet4cons($grnnum);
                 $myconsinfo=mysql_fetch_row($resultcons);
                if($myconsinfo[1]=='')
                {
                   $newLI->updatetoconsumption($qty_make,$mydnrow[1],$disp_recnum,$myrowgrn[9],$myconsinfo[0],$myinvdet['bond_num'], $myinvdet['bonddate'],$myinvdet['be_num'], $myinvdet['bedate'], $myinvdet['assessval'], $myinvdet['cifval'], $myinvdet['dutyamt'], $myinvdet['invamt'],$myinvdet['currency'],$mydnrow[3]);
                   $newLI->updatetoconsumptionrej($grnnum,$qty_rej);
                }
                else
                 {
                   $cofcinfo=$newLI->getcofcnuminfo($grnnum,$disp_recnum);
                  // echo mysql_num_rows($cofcinfo)."**----";
                   if(mysql_num_rows($cofcinfo)>0)
                   {
                      while($mycons_info=mysql_fetch_row($result_cons))
                      {
                       if($mycons_info[1]==$disp_recnum)
                          {
                           // echo $mycons_info[1]."---***----".$disp_recnum."<br>";
                            $dqty=$newLI->getdispqty4grn($grnnum,$disp_recnum);
                            //echo $dqty."-*-**-*IN-*-$myconsinfo[0]<br>";
                           $newLI->updatetoconsumption($qty_make,$dqty,$disp_recnum,$myrowgrn[9],$mycons_info[0],$myinvdet['bond_num'], $myinvdet['bonddate'],$myinvdet['be_num'], $myinvdet['bedate'], $myinvdet['assessval'], $myinvdet['cifval'], $myinvdet['dutyamt'], $myinvdet['invamt'],$myinvdet['currency'],$mydnrow[3]);
                           $newLI->updatetoconsumptionrej($grnnum,$qty_rej);
                           }
                          else if($mycons_info[1]!=$disp_recnum)
                           { //echo"HERE---in delete";
                            $newconsumption->deletefromconsumption($mycons_info[1],$grnnum);
                           }

                         /*  else
                           {
                            $newconsumption->consumptionUpdate4restoredispatch($grnnum,$myrowgrn[0],$myrowgrn[1],$qty_make,$myrowgrn[9],$myrowgrn[4],$rmspec,$myrowgrn[7],$myrowgrn[8],$uom,$qty, $qty_rej,$disp_recnum,$mydnrow[1],$myinvdet['bond_num'], $myinvdet['bonddate'],$myinvdet['be_num'], $myinvdet['bedate'], $myinvdet['assessval'], $myinvdet['cifval'], $myinvdet['dutyamt'], $myinvdet['invamt'],$myinvdet['currency'],$wonum,$qty_rework);
                           }  */
                       }
                    }
                   else
                    {
                       $newconsumption->consumptionUpdate4restoredispatch($grnnum,$myrowgrn[0],$myrowgrn[1],$qty_make,$myrowgrn[9],$myrowgrn[4],$rmspec,$myrowgrn[7],$myrowgrn[8],$uom,$qty, $qty_rej,$disp_recnum,$mydnrow[1],$myinvdet['bond_num'], $myinvdet['bonddate'],$myinvdet['be_num'], $myinvdet['bedate'], $myinvdet['assessval'], $myinvdet['cifval'], $myinvdet['dutyamt'], $myinvdet['invamt'],$myinvdet['currency']);
                    }
                  }
               }
               

		}
                header("Location:consumptionReport.php");
