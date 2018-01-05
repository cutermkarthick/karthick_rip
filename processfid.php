<?php

$fidproc = $_REQUEST['fidproc'];
$index = $_REQUEST['indexfid'];
 //echo $mmproc;
 if($fidproc=='fidentry')
 {

    	$j=1;
	while($j<$index)
	{

    $fidline_num="fidline_num" . $j;
	$qty_recd="qty_recd" . $j;
	$qty_accp="qty_accp" . $j;
	$cim_num="cim_num" . $j;
	$cim_date="cim_date" . $j;
	$dc_qty="dc_qty" . $j;
	$insp_report_num="insp_report_num" . $j;
	$cust_information="cust_information" . $j;
	$fidremarks="fidremarks" . $j;

    	$fidline_num1= $_REQUEST[$fidline_num];
        $qty_recd1=$_REQUEST[$qty_recd];
	    $qty_accp1=$_REQUEST[$qty_accp];
        $cim_num1=$_REQUEST[$cim_num];
        $cim_date1=$_REQUEST[$cim_date];
	    $dc_qty1=$_REQUEST[$dc_qty];
    	$insp_report_num1=$_REQUEST[$insp_report_num];
	    $cust_information1=$_REQUEST[$cust_information];
	    $fidremarks1=$_REQUEST[$fidremarks];
	    

		$newlogin = new userlogin;
		$newlogin->dbconnect();

		if ($fidline_num1 != '')
		{

		$newfid->setline_num($fidline_num1);
		$newfid->setqty_recd($qty_recd1);
		$newfid->setqty_accp($qty_accp1);
		$newfid->setcim_num($cim_num1);
		$newfid->setcim_date($cim_date1);
	    $newfid->setdc_qty($dc_qty1);
		$newfid->setinsp_report_num($insp_report_num1);
	    $newfid->setcust_information($cust_information1);
		$newfid->setremarks($fidremarks1);
		$newfid->setlink2wo($worecnum);

        $newfid->addfid();
        }

		$j++;
	}
  }

 if($fidproc=='fidedit')
 {
  //echo "edit";

 $j=1;

	while($j<$index)
	{
         $fidline_num="fidline_num" . $j;
	     $qty_recd="qty_recd" . $j;
	     $qty_accp="qty_accp" . $j;
	     $cim_num="cim_num" . $j;
	     $cim_date="cim_date" . $j;
	     $dc_qty="dc_qty" . $j;
	     $insp_report_num="insp_report_num" . $j;
	     $cust_information="cust_information" . $j;
	     $fidremarks="fidremarks" . $j;

	    $fidprevlinenum="fidprevlinenum" . $j;
	    $fidlirecnum="fidlirecnum" . $j;

	    $fidlirecnum1=$_REQUEST[$fidlirecnum];
	    $fidprevlinenum1=$_REQUEST[$fidprevlinenum];

        $fidline_num1= $_REQUEST[$fidline_num];
        $qty_recd1=$_REQUEST[$qty_recd];
	    $qty_accp1=$_REQUEST[$qty_accp];
        $cim_num1=$_REQUEST[$cim_num];
        $cim_date1=$_REQUEST[$cim_date];
	    $dc_qty1=$_REQUEST[$dc_qty];
    	$insp_report_num1=$_REQUEST[$insp_report_num];
	    $cust_information1=$_REQUEST[$cust_information];
	    $fidremarks1=$_REQUEST[$fidremarks];

        if ($fidline_num1 != '')
        {

        $newfid->setline_num($fidline_num1);
		$newfid->setqty_recd($qty_recd1);
		$newfid->setqty_accp($qty_accp1);
		$newfid->setcim_num($cim_num1);
		$newfid->setcim_date($cim_date1);
	    $newfid->setdc_qty($dc_qty1);
		$newfid->setinsp_report_num($insp_report_num1);
	    $newfid->setcust_information($cust_information1);
		$newfid->setremarks($fidremarks1);



			 //echo "prevlinenum1  :  " . $prevlinenum1;
         if($fidprevlinenum1!='')
			{
                //echo 'uuu';
               // echo $prevlinenum1;
			 	$newfid->updatefid($fidlirecnum1);

			}
			else
			{
               // echo 'nnn';
                $newfid->setlink2wo($worecnum);
                $newfid->addfid();
			}
	    }
        else
	    {
		    if ($fidprevlinenum1 != '')
		        {
                $newfid->deletefid($fidlirecnum1);
		        }
	    }

    $j++;
		}
    }

?>
