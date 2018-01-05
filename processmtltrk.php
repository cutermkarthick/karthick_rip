<?php
//
//==============================================
// Author: FSI                                 =
// Date-written =July 5, 2005                  =
// Filename: processQuoteGeneric.php           =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 WMS                          =
//==============================================

session_start();
header("Cache-control: private");

$pagename = $_SESSION['pagename'];

include_once('classes/loginClass.php');
include('classes/mtl_trackerclass.php');
include('classes/emailClass.php');
include('classes/liClass.php');
include('config.php');
$msg='';
$usertype = $_SESSION['usertype'];
$newLI = new mtl_trk;
$newEmail = new email;
$newPOLI = new po_line_items;

$userid = $_SESSION['user'];

// Database Connect
$newlogin = new userlogin;
$newlogin->dbconnect();

 // echo "<pre>"; print_r($_REQUEST); exit;

if ($pagename == 'edit_mtltrk' )
{
  $max = $_REQUEST["index"];
  $ponum = $_REQUEST["ponum"];
  //echo $ponum;
  $usertype = $_REQUEST['usertype'];
  $userid = $_REQUEST['userid'];
  $supp_name = $_REQUEST['supp_name'];
  


  $i=1;


  while($i<$max)
  {
    //echo $max;
    $adv_license_qty = 'adv_license_qty' . $i;
    $partnum = 'partnum' . $i;
    $invnum = 'invnum' . $i;
    $invdate =  'invdate' . $i;
    $invqty = 'invqty' . $i;
    $supdel_date = 'supdel_date' . $i;
    $paydue_date = 'paydue_date' . $i;
    $payexp_date = 'payexp_date' . $i;
    $pick_date = 'pick_date' . $i;
    $sail_date = 'sail_date' . $i;
    $eda = 'eda' . $i;
    $aad = 'aad' . $i;
    $expclr_date = 'expclr_date' . $i;
    $cfdel_date = 'cfdel_date' . $i;
    $partnum = $_REQUEST[$partnum];
    $link2mtltracker ='link2mtltracker' . $i;
    $ffpaydue_date = 'ffpaydue_date' . $i;
    $ffpayexp_date = 'ffpayexp_date' . $i;
    $cfpaydue_date = 'cfpaydue_date' . $i;
    $cfpayexp_date = 'cfpayexp_date' . $i;
    $packnum = 'packnum' . $i;
    $bill_lading_num ='bill_lading_num' . $i;
    $bil_lading_date ='bil_lading_date' . $i;
    $docket_num ='docket_num' . $i;
    $boe_num ='boe_num' . $i;    
    $prevlinenum="prev_line_num" . $i;
    $lirecnum="lirecnum" . $i;
  $recd_date="recd_date".$i;
  $credit_note="credit_note".$i;

  
    $prevlinenum1="";
    if(isset ( $_REQUEST[$credit_note] ))
      {
      $credit_note=$_REQUEST[$credit_note];
      //echo $credit_note;
      }
    //exit();
        if ( isset ( $_REQUEST[$prevlinenum] ) )
         {
          $prevlinenum1=$_REQUEST[$prevlinenum];
         }
    $lirecnum1="";
        if ( isset ( $_REQUEST[$lirecnum] ) )
        {
        $lirecnum1= $_REQUEST[$lirecnum];
    }
//echo "max is $max" . "<br>";
    //echo $invnum;
  if ( isset ( $_REQUEST[$adv_license_qty] ) )
  {
    $adv_license_qty1 = $_REQUEST[$adv_license_qty];
    //echo "a is $adv_license_qty1";
  }

  if ( isset ( $_REQUEST[$invnum] ) )
  {
    $invnum1 = $_REQUEST[$invnum];
  }
  $packnum1 = $_REQUEST[$packnum];
  $bill_lading_num1 = $_REQUEST[$bill_lading_num];
  $docket_num1 = $_REQUEST[$docket_num];
  $boe_num1 = $_REQUEST[$boe_num];
  $recd_date1 = $_REQUEST[$recd_date];  
 // echo $recd_date1.'asdf'; exit();
  if ( isset ( $_REQUEST[$invdate] ))
  {
  $invdate1 = $_REQUEST[$invdate];
       // echo "Inv date is $invdate1 <br>";
  //$invdate1 = $newLI->convert_date($invdate1,1);
  //echo "inv date is $invdate1"; exit();
  }
  else
  {
    $invdate1 = '';
  }


  if ( isset ( $_REQUEST[$bil_lading_date] ))
  {
  $bil_lading_date1 = $_REQUEST[$bil_lading_date];
  //$bil_lading_date1 = $newLI->convert_date($bil_lading_date1,0);
  }
  else
  {
    $bil_lading_date1 = '';
  }

  if ( isset ( $_REQUEST[$invqty] ) )
  {
    $invqty1 = $_REQUEST[$invqty];
   }

  if ( isset ( $_REQUEST[$supdel_date] ))
  {
  $supdel_date1 = $_REQUEST[$supdel_date];
//echo "Sup del is $supdel_date1 <br>";
  $supdel_date1 = $newLI->convert_date($supdel_date1,2);
  
  //echo 'deldate' . $supdel_date1;
  }
  else
  {
    $supdel_date1 = '';
  }
  
  // echo 'supdate' . $supdel_date1;



  // $date = strtodate($time);
   // echo "<br>date:$time";
  // echo date('Y-m-d',$time);
  
  if ( isset ( $_REQUEST[$paydue_date] ))
  {
    $paydue_date1 = $_REQUEST[$paydue_date];

    $paydue_date1 = $newLI->convert_date($paydue_date1,3);

   }
   else
   {
    $paydue_date1 = '';
   }
  if ( isset ( $_REQUEST[$payexp_date] ))
  {
    $payexp_date1 = $_REQUEST[$payexp_date];
    $payexp_date1 = $newLI->convert_date($payexp_date1,4);
   }
   else
   {
      $payexp_date1 = '';
   }
  if ( isset ( $_REQUEST[$pick_date] ))
  {
    $pick_date1 = $_REQUEST[$pick_date];
    $pick_date1 = $newLI->convert_date($pick_date1,5);
   }
   else
   {
     $pick_date1 = '';
   }
  if ( isset ( $_REQUEST[$sail_date] ))
  {
    $sail_date1 = $_REQUEST[$sail_date];
    $sail_date1 = $newLI->convert_date($sail_date1,6);
   }
   else
   {
     $sail_date1 = '';
   }
  if ( isset ( $_REQUEST[$eda] ))
  {
    $eda1 = $_REQUEST[$eda];
    $eda1 = $newLI->convert_date($eda1,7);
   }
   else
   {
      $eda1 = '';
   }
  if ( isset ( $_REQUEST[$aad] ))
  {
    $aad1 = $_REQUEST[$aad];
    $aad1 = $newLI->convert_date($aad1,8);
   }
   else
   {
     $aad1 = '';
   }
  if ( isset ( $_REQUEST[$expclr_date] ))
  {
    $expclr_date1 = $_REQUEST[$expclr_date];
    $expclr_date1 = $newLI->convert_date($expclr_date1,9);
   }
   else
   {
      $expclr_date1 = '';
   }
  if ( isset ( $_REQUEST[$cfdel_date] ))
  {
   // echo "name is $cfdel_date";
    $cfdel_date1 = $_REQUEST[$cfdel_date];
   // echo "cfdeldate is $cfdel_date1";
    $cfdel_date1 = $newLI->convert_date($cfdel_date1,10);
  }
  else
  {
     $cfdel_date1 = '';
  }
  if ( isset ( $_REQUEST[$link2mtltracker] ) )
  {
    $link2mtltracker1 = $_REQUEST[$link2mtltracker];

  }

  if ( isset ( $_REQUEST[$ffpaydue_date] ) )
  {
    $ffpaydue_date1 = $_REQUEST[$ffpaydue_date];
    $ffpaydue_date1 = $newLI->convert_date($ffpaydue_date1,11);
   }
   else
   {
     $ffpaydue_date1 = '';
   }
  if ( isset ( $_REQUEST[$ffpayexp_date] ) )
  {
    $ffpayexp_date1 = $_REQUEST[$ffpayexp_date];
    $ffpayexp_date1 = $newLI->convert_date($ffpayexp_date1,12);
   }
   else
   {
     $ffpayexp_date1 = '';
   }
   if ( isset ( $_REQUEST[$cfpaydue_date] ) )
  {
    $cfpaydue_date1 = $_REQUEST[$cfpaydue_date];
    $cfpaydue_date1 = $newLI->convert_date($cfpaydue_date1,13);
   }
   else
   {
     $cfpaydue_date1 = '';
   }
  if ( isset ( $_REQUEST[$cfpayexp_date] ) )
  {
    $cfpayexp_date1 = $_REQUEST[$cfpayexp_date];
    $cfpayexp_date1 = $newLI->convert_date($cfpayexp_date1,14);
   }
   else
   {
     $cfpayexp_date1 = '';
   }

//    echo "i is $i" . "<br>";
//    echo "link2 mtl tracker var name is $link2mtltracker" . "<br>";
//    echo "link2 mtl tracker is $link2mtltracker1" . "<br>";
    //echo $invnum1;

  if (isset($adv_license_qty1))
   {
    $newLI->setadv_license_qty($adv_license_qty1);
    $newLI->updateadvqty($ponum, $partnum);
   }
  if($usertype == 'VEND')
  {
   if($invdate1 != '')
   {
     //echo $invdate1 . '<br>';
    //echo $supdel_date1 . '<br>';
     $time = strtotime($invdate1) - strtotime($supdel_date1);
    // echo "<br>$time<br>";
     if($time > 1296000)
     {
       //echo '';
      header ( "Location: edit_mtltrk.php?ponum=$ponum&error=1&invnum=$invnum1" );
      echo 'if';
     }
   }
   
   if($paydue_date1 != '' && $invdate1 != '')
   {
     $time = strtotime($paydue_date1) - strtotime($invdate1);
     //echo "<br>$time<br>";
     //echo "Pay due date is $paydue_date1" . '<br>';
     //echo "Inv date is $invdate1" . '<br>';
     if($time < 0)
     {
       //echo '';
      header ( "Location: edit_mtltrk.php?ponum=$ponum&error=2&invnum=$invnum1" );
      echo 'if';
     }
   }
  }

  else if($usertype == 'FF')
  {
   if($invdate1 != '' && $pick_date1 != '')
   {
     $time = strtotime($pick_date1) - strtotime($invdate1);
     //echo "<br>$time<br>";
     if($time < 0)
     {
       //echo '';
      header ( "Location: edit_mtltrk.php?ponum=$ponum&error=3&invnum=$invnum1" );
      echo 'if';
     }
   }
   if($sail_date1 != '' && $pick_date1 != '')
   {
     $time = strtotime($sail_date1) - strtotime($pick_date1);
    // echo "<br>sail date - pick date is $time<br>";
     if($time < 0)
     {
      // echo 'Here';
      header ( "Location: edit_mtltrk.php?ponum=$ponum&error=4&invnum=$invnum1" );
      echo 'if';
     }
   }
   if($eda1 != '' && $sail_date1 != '')
   {

     $time = strtotime($eda1) - strtotime($sail_date1);
     //echo "<br>$time<br>";
     if($time < 0)
     {
       //echo '';
      header ( "Location: edit_mtltrk.php?ponum=$ponum&error=5&invnum=$invnum1" );
      echo 'if';
     }
   }
   if($ffpaydue_date1 != '' && $eda1 != '')
   {

     $time = strtotime($ffpaydue_date1) - strtotime($eda1);
     //echo "<br>$time<br>";
     if($time < 0)
     {
       //echo '';
      header ( "Location: edit_mtltrk.php?ponum=$ponum&error=6&invnum=$invnum1" );
      echo 'if';
     }
   }
  }
  else if($usertype == 'CF')
  {
     if($aad1 != '' && $eda1 != '')
   {

     $time = strtotime($aad1) - strtotime($eda1);
     //echo "<br>$time<br>";
     if($time < 0)
     {
       //echo '';
      header ( "Location: edit_mtltrk.php?ponum=$ponum&error=7&invnum=$invnum1" );
      echo 'if';
     }
   }
   if($expclr_date1 != '' && $aad1 != '')
   {

     $time = strtotime($expclr_date1) - strtotime($aad1);
     //echo "<br>$time<br>";
     if($time < 0)
     {
       //echo '';
      header ( "Location: edit_mtltrk.php?ponum=$ponum&error=8&invnum=$invnum1" );
      echo 'if';
     }
   }
   if($cfdel_date1 != '' && $expclr_date1 != '')
   {

     $time = strtotime($cfdel_date1) - strtotime($expclr_date1);
     //echo "<br>$time<br>";
     if($time < 0)
     {
       //echo '';
      header ( "Location: edit_mtltrk.php?ponum=$ponum&error=9&invnum=$invnum1" );
      echo 'if';
     }
   }
   if($cfpaydue_date1 != '' && $cfdel_date1 != '')
   {

     $time = strtotime($cfpaydue_date1) - strtotime($cfdel_date1);
     //echo "<br>$time<br>";
     if($time < 0)
     {
       //echo '';
      header ( "Location: edit_mtltrk.php?ponum=$ponum&error=10&invnum=$invnum1" );
      echo 'if';
     }
   }
 }

       if ($invnum1!='')
     {  
            $newLI->setinvnum($invnum1);
            $newLI->setinvdate($invdate1);
            $newLI->setinvqty($invqty1);
            $newLI->setsupdel_date($supdel_date1);
            $newLI->setpaydue_date($paydue_date1);
            $newLI->setpayexp_date($payexp_date1);
           $newLI->setrecd_date($recd_date1);
            $newLI->setpick_date($pick_date1);
            $newLI->setsail_date($sail_date1);
            $newLI->seteda($eda1);
            $newLI->setaad($aad1);
            $newLI->setexpclr_date($expclr_date1);
            $newLI->setcfdel_date($cfdel_date1);
            $newLI->setffpaydue_date($ffpaydue_date1);
            $newLI->setffpayexp_date($ffpayexp_date1);
            $newLI->setcfpaydue_date($cfpaydue_date1);
            $newLI->setcfpayexp_date($cfpayexp_date1);
            $newLI->setpacknum($packnum1);
            $newLI->setbill_lading_num($bill_lading_num1);
            $newLI->setbil_lading_date($bil_lading_date1);
            $newLI->setdocket_num($docket_num1);    
      $newLI->setcredit_note($credit_note);
      //echo "=====$prevlinenum1";
             if($prevlinenum1!='')
       {
         $st='';
        
         $tempres=$newLI->getLi($lirecnum1);
         if($tem=mysql_fetch_array($tempres))
         {
           //echo $tem['invdate']."===";
           if($tem['invdate']!=$invdate1)
           {
             $msg.="invoice date updated to $invdate1,";
             $st=1;
           }
           if($tem['invqty']!=$invqty1)
           {
             $msg.="Quantity updated to $invqty1 ,";
             $st=1;
           }
           if($tem['bill_lading_date']!=$bil_lading_date1)
           {
             $msg.="bill date updated to $bil_lading_date1 ,";
             $st=1;
           }
           if($tem['bill_lading_num']!=$bill_lading_num1)
           {
             $msg.="bill lading number updated to $bill_lading_num1,";
             $st=1;
           }

           if($credit_note!=$tem['credit_note_no'])
           {
             $msg.="Credit note# entered ,";
             $st=1;
           }
           if($st==1)
             $msg=$i."th Line item updated:Inv# $invnum1: Updations are \n".$msg;
         }
          $newLI->updateLI($lirecnum1);
         $msg.="</br>";
       }
       else
       {
         $msg=$msg."New Line item added with inv date: $invdate1 and inv qty:$invqty1 on invNo:$invnum1";
           $newLI->setlink2mtltracker($link2mtltracker1);
                    $newLI->addLI($ponum);
       }
      }

             $sql = "commit";
       $result = mysql_query($sql);
       if(!$result)
      {
         $sql = "rollback";
         $result = mysql_query($sql);
         die("Commit failed data Insert..Please report to Sysadmin. " . mysql_errno());
        }
     //}
     $newLI->setuserid($userid);
   $ponumber=$_REQUEST['ponumber'];
   $newEmail->setuserid($userid);
   $newEmail->setponum($ponumber);

     $newLI->setusertype($usertype);
     $newLI->setdescription('Modified');
     $newLI->addact_log($ponum);
     //$newEmail->sendMtlEmail($ponum,$usertype,$userid);
     $i++;
   }

  if($usertype == 'VEND')
  {
    $supnotes= $_REQUEST["notes2"];
    $sup_id = $newLI->get_sup_id($supp_name);
    $newLI->add_supplier_notes($ponum,$supnotes,$sup_id);
  }else{
      $ponotes= $_REQUEST["notes"];
      $newLI->addponotes($ponum,$ponotes);
  }
  


  

$j=1;            
$result=$newLI->getpo_linetems($ponum);
while($myrow=mysql_fetch_row($result))
{
   $linenum="linenum" . $j;
   $duedate="due_date" . $j;
   $due_datef="due_datef" . $j;
   $due_dates="due_dates" . $j;
   $accepted_date="accepted_date" . $j;
   $cim_due1="cim_due1".$j;
   $cim_due2="cim_due2".$j;

   $linenum1=$_REQUEST[$linenum];
   $due_date1=$_REQUEST[$duedate];
   $due_datef1=$_REQUEST[$due_datef];
   $due_dates1=$_REQUEST[$due_dates];
 $accepted_date1=$_REQUEST[$accepted_date];
   $cim_due11=$_REQUEST[$cim_due1];
   $cim_due21=$_REQUEST[$cim_due2];
    if($linenum1 == $myrow[1])
  {
    $st='';
          $newPOLI->setduedate($due_date1);
            $newPOLI->setdue_date1($due_datef1);
            $newPOLI->setdue_date2($due_dates1);
      $newPOLI->setaccepted_date($accepted_date1);
      $newPOLI->setcim_due1($cim_due11);  
            $newPOLI->setcim_due2($cim_due21);
      $tmres=$newPOLI->getlidates($myrow[0]);
      if($tem=mysql_fetch_array($tmres))
      {
          //echo "=".$tem['due_date1']."====".$due_datef1;
        //echo "=".$tem['due_date2']."====".$due_dates1;
        if($due_dates1!=$tem['due_date2'] &&($due_dates1!='' && $due_dates1!='0000-00-00'))
        {
          $st=1;
         $msg=$msg."Duedate 2 changed to ".$due_dates1."for line# $j. ";
        }

        else if(($tem['due_date1']!=$due_datef1)&&($due_datef1!='' && $due_datef1!='0000-00-00'))
        {
          $st=1;
         $msg=$msg."Duedate 1 changed to ".$due_datef1."for line# $j. ";
        }
        if($tem['cim2_approval']!=$cim_due21)
        {
          $msg=$msg."Cim approval 2 changed,";
          $st=1;
        }

        if($tem['cim1_approval']!=$cim_due11)
        {
          $msg=$msg."Cim approval 1 changed,";
          $st=1;

        }
        if($st==1)
        {
          $msg="Due date and approval changes are:\n".$msg;
        }
      }
        $newPOLI->updateLIDates($myrow[0]);
  }
     $j++;
}

}
// echo $msg;

if($msg!='')
{
  $msg="Mtl Tracker modified by $userid for PO $ponumber \n".$msg;
  
  $newEmail->setfrom_addr($mtltrk_from);
  $newEmail->setto_addrs($mtltrk_to);
  $newEmail->sendMtlEditEmail($msg);
}
header ( "Location: mtltrk_details.php?ponum=$ponum" );
?>
