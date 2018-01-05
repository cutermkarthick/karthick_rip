<?php
$ddproc = $_REQUEST['ddproc'];
$index = $_REQUEST['indexdd'];
 //echo $mmproc;
 if($ddproc=='ddentry')
 {
    	$j=1;
	while($j<$index)
	{

    $line_num="line_num" . $j;
    $pur_ord_num="pur_ord_num" . $j;
    $comp_ser_num="comp_ser_num" . $j;
    $batch_num="batch_num" . $j;
    $qty="qty" . $j;
    $gate_pass_num="gate_pass_num" . $j;
    $gate_pass_date="gate_pass_date" . $j;
    $dc_num="dc_num" . $j;
    $dc_date="dc_date" . $j;
    $inspn_report="inspn_report" . $j;
    $insp_approval="insp_approval" . $j;
    $qchead_approval="qchead_approval" . $j;

    	$line_num1= $_REQUEST[$line_num];
        $pur_ord_num1=$_REQUEST[$pur_ord_num];
	    $comp_ser_num1=$_REQUEST[$comp_ser_num];
        $batch_num1=$_REQUEST[$batch_num];
	    $qty1=$_REQUEST[$qty];
    	$gate_pass_num1=$_REQUEST[$gate_pass_num];
	    $gate_pass_date1=$_REQUEST[$gate_pass_date];
	    $dc_num1=$_REQUEST[$dc_num];
	    $dc_date1=$_REQUEST[$dc_date];
    	$inspn_report1=$_REQUEST[$inspn_report];
	    $insp_approval1=$_REQUEST[$insp_approval];
	    $qchead_approval1=$_REQUEST[$qchead_approval];


		$newlogin = new userlogin;
		$newlogin->dbconnect();

		if ($line_num1 != '')
		{

		$newdd->setline_num($line_num1);
		$newdd->setpur_ord_num($pur_ord_num1);
		$newdd->setcomp_ser_num($comp_ser_num1);
		$newdd->setbatch_num($batch_num1);
	    $newdd->setqty($qty1);
		$newdd->setgate_pass_num($gate_pass_num1);
	    $newdd->setgate_pass_date($gate_pass_date1);
		$newdd->setdc_num($dc_num1);
		$newdd->setdc_date($dc_date1);
		$newdd->setinspn_report($inspn_report1);
		$newdd->setinsp_approval($insp_approval1);
		$newdd->setqchead_approval($qchead_approval1);
		$newdd->setlink2wo($worecnum);

        $newdd->add_disp_det();
        }

		$j++;
	}
  }

 if($ddproc=='ddedit')
 {
  //echo "edit";

 $j=1;

	while($j<$index)
	{
         $line_num="line_num" . $j;
         $pur_ord_num="pur_ord_num" . $j;
         $comp_ser_num="comp_ser_num" . $j;
         $batch_num="batch_num" . $j;
         $qty="qty" . $j;
         $gate_pass_num="gate_pass_num" . $j;
         $gate_pass_date="gate_pass_date" . $j;
         $dc_num="dc_num" . $j;
         $dc_date="dc_date" . $j;
         $inspn_report="inspn_report" . $j;
         $insp_approval="insp_approval" . $j;
         $qchead_approval="qchead_approval" . $j;

	    $ddprevlinenum="ddprevlinenum" . $j;
	    $ddlirecnum="ddlirecnum" . $j;

	    $ddlirecnum1=$_REQUEST[$ddlirecnum];
	    $ddprevlinenum1=$_REQUEST[$ddprevlinenum];

        $line_num1= $_REQUEST[$line_num];
        $pur_ord_num1=$_REQUEST[$pur_ord_num];
	    $comp_ser_num1=$_REQUEST[$comp_ser_num];
        $batch_num1=$_REQUEST[$batch_num];
	    $qty1=$_REQUEST[$qty];
    	$gate_pass_num1=$_REQUEST[$gate_pass_num];
	    $gate_pass_date1=$_REQUEST[$gate_pass_date];
	    $dc_num1=$_REQUEST[$dc_num];
	    $dc_date1=$_REQUEST[$dc_date];
    	$inspn_report1=$_REQUEST[$inspn_report];
	    $insp_approval1=$_REQUEST[$insp_approval];
	    $qchead_approval1=$_REQUEST[$qchead_approval];

        if ($line_num1 != '')
        {

        $newdd->setline_num($line_num1);
		$newdd->setpur_ord_num($pur_ord_num1);
		$newdd->setcomp_ser_num($comp_ser_num1);
		$newdd->setbatch_num($batch_num1);
	    $newdd->setqty($qty1);
		$newdd->setgate_pass_num($gate_pass_num1);
	    $newdd->setgate_pass_date($gate_pass_date1);
		$newdd->setdc_num($dc_num1);
		$newdd->setdc_date($dc_date1);
		$newdd->setinspn_report($inspn_report1);
		$newdd->setinsp_approval($insp_approval1);
		$newdd->setqchead_approval($qchead_approval1);

			 //echo "prevlinenum1  :  " . $prevlinenum1;
         if($ddprevlinenum1!='')
			{

			 	$newdd->updatedisp_det($ddlirecnum1);

			}
			else
			{
                $newdd->setlink2wo($worecnum);
                $newdd->add_disp_det();
			}
	    }
        else
	    {
		    if ($ddprevlinenum1 != '')
		        {
                $newdd->deletedisp_det($ddlirecnum1);
		        }
	    }

    $j++;
		}
    }

?>
