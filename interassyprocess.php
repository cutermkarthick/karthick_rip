<?php
include_once('classes/loginClass.php');
include('classes/inassyClass.php');
       // include('classes/fidClass.php');
       // include('classes/irmClass.php');
       // include('classes/siClass.php');
      //  include('classes/ddClass.php');
       $newlogin = new userlogin;
		
	   $newinassy= new inassy;
	   $inproc = $_REQUEST['inproc'];
       $index = $_REQUEST['indexmm'];        

//echo "worec - $worecnum<br>";
 //echo $mmproc;
       // echo "<pre>"; print_r($_REQUEST); exit;

 if($inproc=='inentry')
 {
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
	 $ncnum="ncnum".$x;
	 $returns="returns".$x;
	 $inspno="inspno".$x;
	 $stage="stage".$x;
	 $signoff="signoff".$x;
	 $remarks="remarks".$x;
	 $date="date".$x;

     $mmline_num= $_REQUEST[$mmline_num];
	 $from=$_REQUEST[$from];
	 $to=$_REQUEST[$to];
	 $sampling=$_REQUEST[$sampling];
	 $rework=$_REQUEST[$rework];
	 $accept=$_REQUEST[$accept];
	 $reject=$_REQUEST[$reject];
	 $ncnum=$_REQUEST[$ncnum];
	 $returns=$_REQUEST[$returns];
	 $inspno=$_REQUEST[$inspno];
	 $stage=$_REQUEST[$stage];
	 $signoff=$_REQUEST[$signoff];
	 $remarks=$_REQUEST[$remarks];
	 if($_REQUEST[$date]=='0000-00-00' || $_REQUEST[$date]=='')
	 {
        $date1='';
     }
     else
     {
	    $date1= $_REQUEST[$date];
	 }
	 $newlogin->dbconnect();


    if($mmline_num != '')
    {
      $newinassy->setline_num($mmline_num);
	  $newinassy->set_link2assywo($assyworecnum);
	  $newinassy->set_from($from);
	  $newinassy->set_to($to);
	  $newinassy->set_sample($sampling);
	  $newinassy->set_rework($rework);
	  $newinassy->set_accept($accept);
	  $newinassy->set_reject($reject);
	  $newinassy->set_ncnum($ncnum);
	  $newinassy->set_returns($returns);
	  $newinassy->set_inspno($inspno);
	  $newinassy->set_stage($stage);
	  $newinassy->set_signoff($signoff);
  	  $newinassy->set_remarks($remarks);
  	  $newinassy->set_date($date1);
  	  

  	  $checkqanc=$newinassy->getnc_qa($assyworecnum,$stage);

 
	   	if($checkqanc != '' && trim($reject) <= 0 && trim($rework) <= 0 )
        {
             echo "<table border=1><tr><td><font color=#FF0000>";
             die("An NC Exists For The Assy WO #:".$assyworecnum." Please Enter Reject and NC num" );
             echo "</td></tr></table>";
        }


        else if ($checkqanc == '' && (trim($reject) > 0 || trim($rework) >0))
	    {
             echo "<table border=1><tr><td><font color=#FF0000>";
             die("No NC exists for Assy WO: $assyworecnum");
             echo "</td></tr></table>";

        }


	   else if($checkqanc != '' && (trim($reject) > 0 || trim($rework) >0))
       {
       		$nc_rejcheck=$newinassy->getnc_details($assyworecnum,$ncnum);

       		$my_nc_rejcheck=mysql_fetch_array($nc_rejcheck, MYSQL_ASSOC);
             $ncqty = $my_nc_rejcheck['qty'];

             if($ncqty != '' and $ncqty == ($reject+$rework))
             {

                 $newinassy->addmmassy();
        		 $newinassy->updatewo_comp_qty($assyworecnum);
             }
             else
             {
                 echo "<table border=1><tr><td><font color=#FF0000>";
                 die("The Rej Qty in Assy WO does not match the Qty in NC ". $ncnum ." Please correct" );
                 echo "</td></tr></table>";
             }


       }
       else if ($checkqanc == '' && ($reject==0 || $reject==''))
	   {
	   		$newinassy->set_link2assywo($assyworecnum);
      		$newinassy->addmmassy();

	   }


    }
		$x++;
	}
  }



if($inproc=='inedit')
 {
 	$assyworecnum = $_REQUEST['assyworecnum'];
    //echo "worec0 - $worecnum<br>";
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
	 $ncnum="ncnum".$x;
	 $returns="returns".$x;
	 $inspno="inspno".$x;
	 $stage="stage".$x;
	 $signoff="signoff".$x;
	 $remarks="remarks".$x;
     $intprevlinenum="intlirecnum" . $x;
     $recno="recno".$x;
     $date="date".$x;
	  
	 $recno=$_REQUEST[$recno];
	 $intprevlinenum= $_REQUEST[$intprevlinenum];
	 $mmline_num= $_REQUEST[$mmline_num];
	 $from=$_REQUEST[$from];
	 $to=$_REQUEST[$to];
	 $sampling=$_REQUEST[$sampling];
	 $rework=$_REQUEST[$rework];
	 $accept=$_REQUEST[$accept];
	 $reject=$_REQUEST[$reject];
	 $ncnum=$_REQUEST[$ncnum];
	 $returns=$_REQUEST[$returns];
	 $inspno=$_REQUEST[$inspno];
	 $stage=$_REQUEST[$stage];
	 $signoff=$_REQUEST[$signoff];
	 $remarks=$_REQUEST[$remarks];
	 $date1= $_REQUEST[$date];	

	  if($mmline_num != '')
    {
		$newinassy->setline_num($mmline_num);
		$newinassy->set_link2assywo($assyworecnum);
		$newinassy->set_from($from);
		$newinassy->set_to($to);
		$newinassy->set_sample($sampling);
		$newinassy->set_rework($rework);
		$newinassy->set_accept($accept);
		$newinassy->set_reject($reject);
		$newinassy->set_ncnum($ncnum);
		$newinassy->set_returns($returns);
		$newinassy->set_inspno($inspno);
		$newinassy->set_stage($stage);
		$newinassy->set_signoff($signoff);
		$newinassy->set_remarks($remarks);
		$newinassy->set_date($date1);
     
        $newlogin->dbconnect();

       if ($stage == 'DN' || preg_match("/fi/i", $stage ))
	   {


		    if($intprevlinenum!='')
			{
				$checkqanc=$newinassy->getnc_qa($assyworecnum,$stage);

				if($checkqanc != '' && trim($reject) <= 0 && trim($rework) <= 0 )
               {
	                 echo "<table border=1><tr><td><font color=#FF0000>";
	                 die("An NC Exists For The Assy WO #:".$assyworecnum." Please Enter Reject and NC num" );
	                 echo "</td></tr></table>";
               }
               else if ($checkqanc == '' && (trim($reject) > 0 || trim($rework) >0))
			   {
                   echo "<table border=1><tr><td><font color=#FF0000>";
                   die("No NC exists for Assy WO: $assyworecnum");
                   echo "</td></tr></table>";

               }

               else if($checkqanc != '' && (trim($reject) > 0 || trim($rework) >0))
               {
               		$nc_rejcheck=$newinassy->getnc_details($assyworecnum,$ncnum);

               		$my_nc_rejcheck=mysql_fetch_array($nc_rejcheck, MYSQL_ASSOC);
	                 $ncqty = $my_nc_rejcheck['qty'];

	                 if($ncqty == ($reject+$rework))
                     {

                         $newinassy->updateinassy($recno);
                     }
                     else
	                 {
	                     echo "<table border=1><tr><td><font color=#FF0000>";
	                     die("The Rej Qty in Assy WO does not match the Qty in NC ". $ncnum ." Please correct" );
	                     echo "</td></tr></table>";
	                 }


               }
               else if ($checkqanc == '' && ($reject==0 || $reject==''))
			   {
			   		$newinassy->updateinassy($recno);

			   }

			 	

			}


			else
			{

				$checkqanc=$newinassy->getnc_qa($assyworecnum,$stage);

				if($checkqanc != '' && (trim($reject) == '' && trim($rework) == ''))
               	{
                   echo "<table border=1><tr><td><font color=#FF0000>";
                   die("An NC Exists For The Assy WO #:".$assyworecnum." Please Enter Reject/Rework and NC num" );
                   echo "</td></tr></table>";
               	}
			    else if ($checkqanc == '' && (trim($reject) > 0 || trim($rework) >0))
			    {
                   echo "<table border=1><tr><td><font color=#FF0000>";
                   die("No NC exists for Assy WO: $assyworecnum");
                   echo "</td></tr></table>";

                }
                else if($checkqanc != '' && (trim($reject) > 0 || trim($rework) >0))
               	{
               		$nc_rejcheck=$newinassy->getnc_details($assyworecnum,$ncnum);

               		$my_nc_rejcheck=mysql_fetch_array($nc_rejcheck, MYSQL_ASSOC);
	                 $ncqty = $my_nc_rejcheck['qty'];

	                 if($ncqty == ($reject+$rework))
                     {

                         $newinassy->addmmassy();
                     }
                     else
	                 {
	                     echo "<table border=1><tr><td><font color=#FF0000>";
	                     die("The Rej Qty in WO does not match the Qty in NC ". $ncnum ." Please correct" );
	                     echo "</td></tr></table>";
	                 }


                }
                else
                {
                	 // echo "worec1 - $worecnum<br>";
              		 $newinassy->set_link2assywo($assyworecnum);
              		 $newinassy->addmmassy();
                }

                if($returns > 0 && ($stage =='FI' OR $stage == 'final' OR  $stage == 'Final' or
                      				$stage == 'FINAL' or $stage == 'fi' or
                      					$stage == 'FI' or $stage == 'Fi'))
                {


                	
 					$retqty = $newinassy->getretforassywo($assyworecnum);
 					$retqty1 = $retqty + $returns - $prevreturns;
 					$newinassy->updateretqtyforAssywo($assyworecnum, $retqty1); 

                }

			}

	   }

       
	    
   }
    $x++;

		}
	//	echo "worec2 - $worecnum<br>";
		$newinassy->updatewo_comp_qty($assyworecnum);
    }
?>
