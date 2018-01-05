<?php


 include_once('classes/loginClass.php');
 include('classes/inClass.php');
       // include('classes/fidClass.php');
       // include('classes/irmClass.php');
       // include('classes/siClass.php');
      //  include('classes/ddClass.php');
       $newlogin = new userlogin;
		
	   $newin = new in;
	   $inproc = $_REQUEST['inproc'];
$index = $_REQUEST['indexmm'];
$wonum=$_REQUEST['wonum'];
$condition=$_REQUEST['condition'];
$prevcondition=$_REQUEST['prevcondition'];
if($_REQUEST['grnnum']=='')
{
 $grnnum = $_REQUEST['grnnum_split'];
}
else
{
  $grnnum = $_REQUEST['grnnum'];
}
//echo "worec - $wonum<br>";
 //echo $mmproc;
 if($inproc=='inentry')
 {
	 //echo "<br>In inentry";
    
    $x=1;
	while($x<$index)
	{

	 $mmline_num="mmline_num" . $x;
	 $from="from".$x;
	 $to="to".$x;
	 $sampling="sampling".$x;
	 $rework="rework".$x;
	 $accept="accept".$x;
	 $reject="reject".$x;
	 $returns="returns".$x;
	 $inspno="inspno".$x;
	 $stage="stage".$x;
	 $signoff="signoff".$x;
	 $remarks="remarks".$x;
	 $date="date".$x;
	 $dn="dn".$x;
	 $dn_sent="dn_sent".$x;
	 $dn_recv="dn_recv".$x;
	 $cofc_num="cofc_num".$x;
	 $supplier_wo="supplier_wo".$x;
	 $ncnum="ncnum".$x;
     $hold="hold".$x;
     $prev_ret="prev_ret".$x;
     
     $mmline_num= $_REQUEST[$mmline_num];
	 $from=$_REQUEST[$from];
	 $to=$_REQUEST[$to];
	 $sampling=$_REQUEST[$sampling];
	 $rework=$_REQUEST[$rework];
	 $accept=$_REQUEST[$accept];
	 $reject=$_REQUEST[$reject];
	 $returns=$_REQUEST[$returns];
	 $inspno=$_REQUEST[$inspno];
	 $stage=$_REQUEST[$stage];
	 $signoff=$_REQUEST[$signoff];
	 $remarks=$_REQUEST[$remarks];
	 $dn=$_REQUEST[$dn];
	 $dn_sent=$_REQUEST[$dn_sent];
	 $dn_recv=$_REQUEST[$dn_recv];
     $cofc_num=$_REQUEST[$cofc_num];
	 $supplier_wo=$_REQUEST[$supplier_wo];
     $ncnum=$_REQUEST[$ncnum];
     $hold=$_REQUEST[$hold];
     $prev_ret=$_REQUEST[$prev_ret];
    
	 //echo "<br>Nc num is $ncnum";
	 if($_REQUEST[$date]=='0000-00-00' || $_REQUEST[$date]=='')
	 {
        $date1='';
     }
     else
     {
	    $date1= $_REQUEST[$date];
	 }
	 //$newlogin->dbconnect();


    if($mmline_num != '')
    {
      $newin->setline_num($mmline_num);
	  $newin->set_link2wo($worecnum);
	  $newin->set_from($from);
	  $newin->set_to($to);
	  $newin->set_sample($sampling);
	  $newin->set_rework($rework);
	  $newin->set_accept($accept);
	  $newin->set_reject($reject);
	  $newin->set_returns($returns);
	  $newin->set_inspno($inspno);
	  $newin->set_stage($stage);
	  $newin->set_signoff($signoff);
  	  $newin->set_remarks($remarks);
  	  $newin->set_date($date1);
  	  $newin->set_dn($dn);
  	  $newin->set_dn_sent($dn_sent);
  	  $newin->set_dn_recv($dn_recv);
  	  $newin->set_cofc_num($cofc_num);
  	  $newin->set_supplier_wo($supplier_wo);
  	  $newin->set_ncnum($ncnum);
  	  $newin->set_hold($hold);

	   $checkqanc=$newin->getnc_qa($worecnum,$stage);
	   //echo "<br>checkqanc is $checkqanc";
	   if($checkqanc != '' && 
		   (trim($reject) <= 0) && trim($rework) <= 0 )
	   {
		 echo "<table border=1><tr><td><font color=#FF0000>";
		 die("An NC Exists For The WO #:".$wonum." Please Enter Reject and Proceed" );
		 echo "</td></tr></table>";
	   }
	   else if ($checkqanc == '' && (trim($reject) > 0 || trim($rework) >0))
	   {
		   echo "<table border=1><tr><td><font color=#FF0000>";
		   die("No NC exists for the WO: $wonum");
		   echo "</td></tr></table>";

	   }
	   else if($checkqanc != '' && (trim($reject) > 0 || trim($rework) >0))
	   {

		 $nc_rejcheck=$newin->getnc_details($worecnum,$ncnum);
		 $my_nc_rejcheck=mysql_fetch_array($nc_rejcheck, MYSQL_ASSOC);
		 $ncqty = $my_nc_rejcheck['qty'];
		 //echo "<br>ncrecnum is $ncrecnum";
		 //echo "<br>ncqty is $ncqty";
		 if($ncqty != '' and $ncqty == ($reject+$rework))
		  {
			  $newin->addmm();
			  $newin->updatewo_comp_qty($worecnum);
			  if($stage=="FI"||$stage=="fi"||$stage=="Fi"||$stage=="FINAL"||$stage=="Final"||$stage=="final")
			  {       // echo"HERE";
				  $gretqty=$newin->getgrnretqty($grnnum);
				  $fretqty=$gretqty+$returns;
				  $newin->updategrn4retqty($fretqty,$grnnum);
			   }
		  }
		  else
		  {
			  echo "<table border=1><tr><td><font color=#FF0000>";
			  die("The Rej/Rew Qty in WO does not match the total Qty in NC(s). Please correct it." );
			  echo "</td></tr></table>";
		  }
		}
	   
	  else
	  {
		 $newin->set_link2wo($worecnum);
		 $newin->addmm();
		 if($stage=="FI"||$stage=="fi"||$stage=="Fi"||$stage=="FINAL"||$stage=="Final"||$stage=="final")
		{       // echo"HERE";
		  $gretqty=$newin->getgrnretqty($grnnum);
		  $fretqty=$gretqty+$returns;
		  $newin->updategrn4retqty($fretqty,$grnnum);
		}
	  }


    }
		$x++;
	}
  }
if($inproc=='inedit')
 {

   //echo "worec0 - $worecnum<br>";
   $z=1;
	while($z<$index)
	{
		$ncnum="ncnum".$z;
        $ncnum=$_REQUEST[$ncnum];
		if ($ncnum != '')
			$ncflag = 1;
		$z++;
	}

 	$x=1;
	while($x<$index)
	{

     $mmline_num="mmline_num" . $x;
     $from="from".$x;
	 $to="to".$x;
	 $sampling="sampling".$x;
	 $rework="rework".$x;
	 $accept="accept".$x;
	 $reject="reject".$x;
	 $returns="returns".$x;
	 $inspno="inspno".$x;
	 $stage="stage".$x;
	 $signoff="signoff".$x;
	 $remarks="remarks".$x;
     $intprevlinenum="intlirecnum" . $x;
     $recno="recno".$x;
      $date="date".$x;
      $dn="dn".$x;
	 $dn_sent="dn_sent".$x;
	 $dn_recv="dn_recv".$x;
	 $cofc_num="cofc_num".$x;
	 $supplier_wo="supplier_wo".$x;
	 $ncnum="ncnum".$x;
	 $hold="hold".$x;
	 $prev_ret="prev_ret".$x;
	  
	 $recno=$_REQUEST[$recno];
	 $intprevlinenum= $_REQUEST[$intprevlinenum];
	 $mmline_num= $_REQUEST[$mmline_num];
	 $from=$_REQUEST[$from];
	 $to=$_REQUEST[$to];
	 $sampling=$_REQUEST[$sampling];
	 $rework=$_REQUEST[$rework];
	 $accept=$_REQUEST[$accept];
	 $reject=$_REQUEST[$reject];
	 $returns=$_REQUEST[$returns];
	 $inspno=$_REQUEST[$inspno];
	 $stage=$_REQUEST[$stage];
	 $signoff=$_REQUEST[$signoff];
     $remarks=$_REQUEST[$remarks];
     $date1= $_REQUEST[$date];
     $dn=$_REQUEST[$dn];
	 $dn_sent=$_REQUEST[$dn_sent];
	 $dn_recv=$_REQUEST[$dn_recv];
	 $cofc_num=$_REQUEST[$cofc_num];
	 $supplier_wo=$_REQUEST[$supplier_wo];
     $ncnum=$_REQUEST[$ncnum];
     $hold=$_REQUEST[$hold];
     $prev_ret=$_REQUEST[$prev_ret];
     
  if ($mmline_num !='')
  {
	$newin->setline_num($mmline_num);
	$newin->set_link2wo($worecnum);
	$newin->set_from($from);
	$newin->set_to($to);
	$newin->set_sample($sampling);
	$newin->set_rework($rework);
	$newin->set_accept($accept);
	$newin->set_reject($reject);
	$newin->set_returns($returns);
	$newin->set_inspno($inspno);
	$newin->set_stage($stage);
	$newin->set_signoff($signoff);
	$newin->set_remarks($remarks);
	$newin->set_date($date1);
	$newin->set_dn($dn);
    $newin->set_dn_sent($dn_sent);
    $newin->set_dn_recv($dn_recv);
    $newin->set_cofc_num($cofc_num);
    $newin->set_supplier_wo($supplier_wo);
    $newin->set_ncnum($ncnum);
    $newin->set_hold($hold);
    $woqty = $newWO->getqty();
   $newlogin->dbconnect();
   if ($stage == 'DN' || preg_match("/fi/i", $stage ))
	   {     // echo $stage."---b4---<br>";
         if($intprevlinenum!='')
			  {
			      //echo "<br>here stage is $stage reject is $reject and rework is $rework";
                  $checkqanc=$newin->getnc_qa($worecnum,$stage);
				  
                   if($checkqanc != '' &&
					   trim($reject) <= 0 && trim($rework) <= 0 )
                   {
                     echo "<table border=1><tr><td><font color=#FF0000>";
                     die("An NC Exists For The WO #:".$wonum." Please Enter Reject and NC num" );
                     echo "</td></tr></table>";
                   }
				   else if ($checkqanc == '' && (trim($reject) > 0 || trim($rework) >0))
				   {
                       echo "<table border=1><tr><td><font color=#FF0000>";
                       die("No NC exists for WO: $wonum");
                       echo "</td></tr></table>";

                   }

                   else if($checkqanc != '' && (trim($reject) > 0 || trim($rework) >0))
                   {
                     $nc_rejcheck=$newin->getnc_details($worecnum,$ncnum);
                     $my_nc_rejcheck=mysql_fetch_array($nc_rejcheck, MYSQL_ASSOC);
				     $ncqty = $my_nc_rejcheck['qty'];
					// echo "<br>ncrecnum is $ncqty---------$reject";
  
                      if($ncqty == ($reject+$rework))
                       {

                          if($stage=="FI"||$stage=="fi"||$stage=="Fi"||$stage=="FINAL"||$stage=="Final"||$stage=="final")
                         {
                            $gretqty=$newin->getgrnretqty($grnnum);
                                  //echo"HERE";
                          if($condition=="WO Cancelled" && $prevcondition!="WO Cancelled")
                          {


                            if($gretqty!=0 && $gretqty !="")
                            {
                              $fretqty=($gretqty-$returns);
                            }else
                            {
                             $wretqty=$newin->getretqtydets4crn($grnnum);
                             $fretqty=($wretqty-$returns);
                            }

                          }else
                          {  //echo $gretqty."<br>";
                             if($gretqty!=0 && $gretqty !="")
                            {
                              $fretqty=($gretqty-$prev_ret)+$returns;
                            }else
                            {

                             $wretqty=$newin->getretqtydets4crn($grnnum);
                             //echo $wretqty."------".$prev_ret."------".$returns."<br>";
                             $fretqty=($wretqty-$prev_ret)+$returns;
                            }

                          }

                           $newin->updategrn4retqty($fretqty,$grnnum);
                         }
                         $newin->updatein($recno);
                       }
                       else
                       {
                          echo "<table border=1><tr><td><font color=#FF0000>";
                          die("The Rej Qty in WO does not match the Qty in NC ". $ncnum ." Please correct" );
                          echo "</td></tr></table>";
                       }
                     }
				   else if ($checkqanc == '' && ($reject==0 || $reject==''))
				   {

                         if($stage=="FI"||$stage=="fi"||$stage=="Fi"||$stage=="FINAL"||$stage=="Final"||$stage=="final")
                       {        //echo"HERE";
                          $gretqty=$newin->getgrnretqty($grnnum);
                                  //echo"HERE";
                          if($condition=="WO Cancelled" && $prevcondition!="WO Cancelled")
                          {


                            if($gretqty!=0 && $gretqty !="")
                            {
                              $fretqty=($gretqty-$returns);
                            }else
                            {
                             $wretqty=$newin->getretqtydets4crn($grnnum);
                             $fretqty=($wretqty-$returns);
                            }

                          }else
                          {
                             if($gretqty!=0 && $gretqty !="")
                            {
                              $fretqty=($gretqty-$prev_ret)+$returns;
                            }else
                            {
                             $wretqty=$newin->getretqtydets4crn($grnnum);
                             $fretqty=($wretqty-$prev_ret)+$returns;
                            }

                          }

                          $newin->updategrn4retqty($fretqty,$grnnum);
                       }
                       $newin->updatein($recno);
				   }
 			}
			else
			{
                  $checkqanc=$newin->getnc_qa($worecnum,$stage);
				  //echo "Here in else line 379";
                   if($checkqanc != '' && (trim($reject) == '' && trim($rework) == ''))
                   {
                     echo "<table border=1><tr><td><font color=#FF0000>";
                     die("An NC Exists For The WO #:".$wonum." Please Enter Reject/Rework and NC num" );
                     echo "</td></tr></table>";
                   }
				   else if ($checkqanc == '' && (trim($reject) > 0 || trim($rework) >0))
				   {
                       echo "<table border=1><tr><td><font color=#FF0000>";
                       die("No NC exists for WO: $wonum");
                       echo "</td></tr></table>";

                   }

                   else if($checkqanc != '' && (trim($reject) > 0 || trim($rework) >0))
                   {
                     $nc_rejcheck=$newin->getnc_details($worecnum,$ncnum);
                     $my_nc_rejcheck=mysql_fetch_assoc($nc_rejcheck);
                     
                       if($my_nc_rejcheck['qty'] == ($reject+$rework))
                       {
                          $newin->set_link2wo($worecnum);

                          if($stage=="FI"||$stage=="fi"||$stage=="Fi"||$stage=="FINAL"||$stage=="Final"||$stage=="final")
                          {        //echo"HERE";
                            $gretqty=$newin->getgrnretqty($grnnum);
                                  //echo"HERE";
                          if($condition=="WO Cancelled" && $prevcondition!="WO Cancelled")
                          {


                            if($gretqty!=0 && $gretqty !="")
                            {
                              $fretqty=($gretqty-$returns);
                            }else
                            {
                             $wretqty=$newin->getretqtydets4crn($grnnum);
                             $fretqty=($wretqty-$returns);
                            }

                          }else
                          {
                             if($gretqty!=0 && $gretqty !="")
                            {
                              $fretqty=($gretqty-$prev_ret)+$returns;
                            }else
                            {
                             $wretqty=$newin->getretqtydets4crn($grnnum);
                             $fretqty=($wretqty-$prev_ret)+$returns;
                            }

                          }

                            $newin->updategrn4retqty($fretqty,$grnnum);
                          }
                          $newin->addmm();
                       }
                       else
                       {
                          echo "<table border=1><tr><td><font color=#FF0000>";
                          die("The quantity in WO does not match the qiantity in NC".$ncnum."   Please correct" );
                          echo "</td></tr></table>";
                       }
                  
                   }
               else
               {
                  $newin->set_link2wo($worecnum);

                 // echo $stage."---b4---<br>";
                  if($stage=="FI"||$stage=="fi"||$stage=="Fi"||$stage=="FINAL"||$stage=="Final"||$stage=="final")
                  {
                     $gretqty=$newin->getgrnretqty($grnnum);
                                  //echo"HERE";
                          if($condition=="WO Cancelled" && $prevcondition!="WO Cancelled")
                          {


                            if($gretqty!=0 && $gretqty !="")
                            {
                              $fretqty=($gretqty-$returns);
                            }else
                            {
                             $wretqty=$newin->getretqtydets4crn($grnnum);
                             $fretqty=($wretqty-$returns);
                            }

                          }else
                          {
                             if($gretqty!=0 && $gretqty !="")
                            {
                              $fretqty=($gretqty-$prev_ret)+$returns;
                            }else
                            {
                             $wretqty=$newin->getretqtydets4crn($grnnum);
                             $fretqty=($wretqty-$prev_ret)+$returns;
                            }

                          }

                     $newin->updategrn4retqty($fretqty,$grnnum);
                 }
                 $newin->addmm();
               }
			}

       }

    }
    $x++;
}
	//	echo "worec2 - $worecnum<br>";
		$newin->updatewo_comp_qty($worecnum);
    }
    

 /*if($mmproc=='mmedit')
 {


 $j=1;

	while($j<$index)
	{
        $mmline_num="mmline_num" . $j;
       	$qty_drawn="qty_drawn" . $j;
	    $drawn_by="drawn_by" . $j;
        $drawn_date="drawn_date" . $j;
        $issued_by="issued_by" . $j;
        $issued_date="issued_date" . $j;
        $recd_by="recd_by" . $j;
	    $sl_from="sl_from" . $j;
	    $sl_to="sl_to" . $j;
	    $accepted="accepted" . $j;
	    $rejected="rejected" . $j;
	    $returned="returned" . $j;
	    $notes="notes" . $j;

	    $mmprevlinenum="mmprevlinenum" . $j;
	    $mmlirecnum="mmlirecnum" . $j;
	    
	   // echo "line name is " . $mmprevlinenum;

	    $mmlirecnum1=$_REQUEST[$mmlirecnum];
	    $mmprevlinenum1=$_REQUEST[$mmprevlinenum];

	    $mmline_num1= $_REQUEST[$mmline_num];
        $qty_drawn1=$_REQUEST[$qty_drawn];
	    $drawn_by1=$_REQUEST[$drawn_by];
        $drawn_date1=$_REQUEST[$drawn_date];
        $issued_by1=$_REQUEST[$issued_by];
        $issued_date1=$_REQUEST[$issued_date];
	    $recd_by1=$_REQUEST[$recd_by];
    	$sl_from1=$_REQUEST[$sl_from];
	    $sl_to1=$_REQUEST[$sl_to];
	    $accepted1=$_REQUEST[$accepted];
	    $rejected1=$_REQUEST[$rejected];
	    $returned1=$_REQUEST[$returned];
	    $notes1=$_REQUEST[$notes];



        if ($mmline_num1 != '')
        {
        //   echo "prevlinenum".$prevlinenum1. " ";
        //   echo "lirecnum" .$lirecnum1." "; $newin->setline_num($mmline_num1); $newin->setqty_drawn($qty_drawn1); $newin->setdrawn_by($drawn_by1); $newin->setdrawn_date($drawn_date1); $newin->setissued_by($issued_by1); $newin->setissued_date($issued_date1); $newin->setrecd_by($recd_by1); $newin->setsl_from($sl_from1); $newin->setsl_to($sl_to1); $newin->setaccepted($accepted1); $newin->setrejected($rejected1); $newin->setreturned($returned1); $newin->setnotes($notes1);



         if($mmprevlinenum1!='')
			{ $newin->updatemm($mmlirecnum1);

			}
			else
			{ $newin->setlink2wo($worecnum); $newin->addmm();
			}
	    }
        else
	    {
		    if ($mmprevlinenum1 != '')
		        { $newin->deletemm($mmlirecnum1);
		        }
	    }


    $j++;
		}
    }*/

?>
