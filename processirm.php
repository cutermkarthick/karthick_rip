<?php

$irmproc = $_REQUEST['irmproc'];
$index = $_REQUEST['indexirm'];
 //echo $mmproc;
 if($irmproc=='irmentry')
 {
    	$j=1;
	while($j<$index)
	{
	

	    $irmline_num="irmline_num" . $j;
	    $po_num="po_num" . $j;
	    $po_qty="po_qty" . $j;
	    $mgp_num="mgp_num" . $j;
	    $mgp_date="mgp_date" . $j;
	    $rm_dim1="rm_dim1" . $j;
	    $rm_dim2="rm_dim2" . $j;
	    $rm_dim3="rm_dim3" . $j;
	    $rm_qty="rm_qty" . $j;
	    $qty_to_make="qty_to_make" . $j;
	    $cust_batch_num="cust_batch_num" . $j;
	    $cust_wo_num="cust_wo_num" . $j;
	    $irmremarks="irmremarks" . $j;

    	$irmline_num1= $_REQUEST[$irmline_num];
        $po_num1=$_REQUEST[$po_num];
	    $po_qty1=$_REQUEST[$po_qty];
        $mgp_num1=$_REQUEST[$mgp_num];
        $mgp_date1=$_REQUEST[$mgp_date];
	    $rm_dim11=$_REQUEST[$rm_dim1];
    	$rm_dim21=$_REQUEST[$rm_dim2];
	    $rm_dim31=$_REQUEST[$rm_dim3];
	    $rm_qty1=$_REQUEST[$rm_qty];
	    $qty_to_make1=$_REQUEST[$qty_to_make];
	    $cust_batch_num1=$_REQUEST[$cust_batch_num];
	    $cust_wo_num1=$_REQUEST[$cust_wo_num];
	    $irmremarks1=$_REQUEST[$irmremarks];

		$newlogin = new userlogin;
		$newlogin->dbconnect();

		if ($irmline_num1 != '')
		{

        $newirm->setlink2wo($worecnum);
		$newirm->setline_num($irmline_num1);
		$newirm->setpo_num($po_num1);
		$newirm->setpo_qty($po_qty1);
		$newirm->setmgp_num($mgp_num1);
		$newirm->setmgp_date($mgp_date1);
	    $newirm->setrm_dim1($rm_dim11);
		$newirm->setrm_dim2($rm_dim21);
	    $newirm->setrm_dim3($rm_dim31);
		$newirm->setrm_qty($rm_qty1);
		$newirm->setqty_to_make($qty_to_make1);
		$newirm->setcust_batch_num($cust_batch_num1);
	    $newirm->setcust_wo_num($cust_wo_num1);
	    $newirm->setremarks($irmremarks1);
	    
        $newirm->addirm();
        }

		$j++;
	}
  }

 if($irmproc=='irmedit')
 {
  //echo "edit";

 $j=1;

	while($j<$index)
	{
        $worecnum=$_REQUEST['worecnum'];

        $irmline_num="irmline_num" . $j;
	    $po_num="po_num" . $j;
	    $po_qty="po_qty" . $j;
	    $mgp_num="mgp_num" . $j;
	    $mgp_date="mgp_date" . $j;
	    $rm_dim1="rm_dim1" . $j;
	    $rm_dim2="rm_dim2" . $j;
	    $rm_dim3="rm_dim3" . $j;
	    $rm_qty="rm_qty" . $j;
	    $qty_to_make="qty_to_make" . $j;
	    $cust_batch_num="cust_batch_num" . $j;
	    $cust_wo_num="cust_wo_num" . $j;
	    $irmremarks="irmremarks" . $j;

	    $prevlinenum="prevlinenum" . $j;
	    $lirecnum="lirecnum" . $j;

	    $lirecnum1=$_REQUEST[$lirecnum];
	    $prevlinenum1=$_REQUEST[$prevlinenum];

	    $irmline_num1= $_REQUEST[$irmline_num];
        $po_num1=$_REQUEST[$po_num];
	    $po_qty1=$_REQUEST[$po_qty];
        $mgp_num1=$_REQUEST[$mgp_num];
        $mgp_date1=$_REQUEST[$mgp_date];
	    $rm_dim11=$_REQUEST[$rm_dim1];
    	$rm_dim21=$_REQUEST[$rm_dim2];
	    $rm_dim31=$_REQUEST[$rm_dim3];
	    $rm_qty1=$_REQUEST[$rm_qty];
	    $qty_to_make1=$_REQUEST[$qty_to_make];
	    $cust_batch_num1=$_REQUEST[$cust_batch_num];
	    $cust_wo_num1=$_REQUEST[$cust_wo_num];
	    $irmremarks1=$_REQUEST[$irmremarks];

        if ($irmline_num1 != '')
        {

		$newirm->setline_num($irmline_num1);
		$newirm->setpo_num($po_num1);
		$newirm->setpo_qty($po_qty1);
		$newirm->setmgp_num($mgp_num1);
		$newirm->setmgp_date($mgp_date1);
	    $newirm->setrm_dim1($rm_dim11);
		$newirm->setrm_dim2($rm_dim21);
	    $newirm->setrm_dim3($rm_dim31);
		$newirm->setrm_qty($rm_qty1);
		$newirm->setqty_to_make($qty_to_make1);
		$newirm->setcust_batch_num($cust_batch_num1);
	    $newirm->setcust_wo_num($cust_wo_num1);
	    $newirm->setremarks($irmremarks1);


			 //echo "prevlinenum1  :  " . $prevlinenum1;
         if($prevlinenum1!='')
			{
               //echo $prevlinenum1;
			 	$newirm->updateirm($lirecnum1);

			}
			else
			{
                $newirm->setlink2wo($worecnum);
                $newirm->addirm();
			}
	    }
        else
	    {
		    if ($prevlinenum1 != '')
		        {
                $newirm->deleteirm($lirecnum1);
		        }
	    }

    $j++;
		}
    }

?>
