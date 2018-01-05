<?php

$mmproc = $_REQUEST['mmproc'];
$index = $_REQUEST['indexmm'];
 //echo $mmproc;
 if($mmproc=='mmentry')
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

		$newlogin = new userlogin;
		$newlogin->dbconnect();

		if ($mmline_num1 != '')
		{

        $newmm->setlink2wo($worecnum);
		$newmm->setline_num($mmline_num1);
		$newmm->setqty_drawn($qty_drawn1);
		$newmm->setdrawn_by($drawn_by1);
		$newmm->setdrawn_date($drawn_date1);
		$newmm->setissued_by($issued_by1);
		$newmm->setissued_date($issued_date1);
	    $newmm->setrecd_by($recd_by1);
		$newmm->setsl_from($sl_from1);
	    $newmm->setsl_to($sl_to1);
		$newmm->setaccepted($accepted1);
		$newmm->setrejected($rejected1);
		$newmm->setreturned($returned1);
	    $newmm->setnotes($notes1);
        $newmm->addmm();
        }

		$j++;
	}
  }

 if($mmproc=='mmedit')
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
        //   echo "lirecnum" .$lirecnum1." ";


		$newmm->setline_num($mmline_num1);
		$newmm->setqty_drawn($qty_drawn1);
		$newmm->setdrawn_by($drawn_by1);
        $newmm->setdrawn_date($drawn_date1);
		$newmm->setissued_by($issued_by1);
		$newmm->setissued_date($issued_date1);
	    $newmm->setrecd_by($recd_by1);
		$newmm->setsl_from($sl_from1);
	    $newmm->setsl_to($sl_to1);
		$newmm->setaccepted($accepted1);
		$newmm->setrejected($rejected1);
		$newmm->setreturned($returned1);
	    $newmm->setnotes($notes1);



         if($mmprevlinenum1!='')
			{
			 	$newmm->updatemm($mmlirecnum1);

			}
			else
			{
                $newmm->setlink2wo($worecnum);
                $newmm->addmm();
			}
	    }
        else
	    {
		    if ($mmprevlinenum1 != '')
		        {
                $newmm->deletemm($mmlirecnum1);
		        }
	    }


    $j++;
		}
    }

?>
