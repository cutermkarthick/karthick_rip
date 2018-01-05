<?php

$siproc = $_REQUEST['siproc'];

 //echo $mmproc;
 if($siproc=='sientry')
 {

    $j=1;
	while($j<16)
	{
        $fqc_sign = "fopn" . $j;
    	$fqc_sign1 = $_REQUEST[$fqc_sign];
    	$fremarks = $_REQUEST['fremarks'];

        $prodn_sign = "popn" . $j;
    	$prodn_sign1 = $_REQUEST[$prodn_sign];
    	$premarks = $_REQUEST['premarks'];

        $qc_sign = "opn" . $j;
    	$qc_sign1 = $_REQUEST[$qc_sign];
    	$remarks = $_REQUEST['remarks'];

		$newlogin = new userlogin;
		$newlogin->dbconnect();
		
		if($j<16)
		{
            $newsi->setfqc_sign($fqc_sign1);
            $newsi->setfremarks($fremarks);

            $newsi->setprodn_sign($prodn_sign1);
            $newsi->setpremarks($premarks);
            
            $newsi->setqc_sign($qc_sign1);
	    	$newsi->setstagenum($j);
	    	$newsi->setremarks($remarks);
	    	$newsi->setlink2wo($worecnum);
	    	
            $newsi->addsi();
        }
        $j++;
	}

 }

 if($siproc=='siedit')
 {
  //echo "edit";
$j=1;
	while($j<16)
	{
        $worecnum =$_REQUEST['worecnum'];
        $qc_sign = "opn" . $j;
    	$qc_sign1 = $_REQUEST[$qc_sign];
    	$remarks = $_REQUEST['remarks'];
    	
    	$fqc_sign = "fopn" . $j;
    	$fqc_sign1 = $_REQUEST[$fqc_sign];
    	$fremarks = $_REQUEST['fremarks'];

        $prodn_sign = "popn" . $j;
    	$prodn_sign1 = $_REQUEST[$prodn_sign];
    	$premarks = $_REQUEST['premarks'];

		$newlogin = new userlogin;
		$newlogin->dbconnect();

		if($j<16)
		{
            $newsi->setfqc_sign($fqc_sign1);
            $newsi->setfremarks($fremarks);

            $newsi->setprodn_sign($prodn_sign1);
            $newsi->setpremarks($premarks);
            
	    	$newsi->setqc_sign($qc_sign1);
         	$newsi->setremarks($remarks);

            $newsi->updatesi($worecnum, $j);
        }
        $j++;
	}
 }

?>
