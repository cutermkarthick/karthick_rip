<?php
//
//==============================================
// Author: Fluent Technologies                             
// Date-written = Aug 1, 2011
// Filename:shipperClass.php
// Contact bmandyam@fluentsoft.com             
// Revision: v1.0 FluentHCM                  
// Copyright of Fluent Technologies (2011 - 2020)
//==============================================

$pagename = $_SESSION['pagename'];

include_once('classes/loginClass.php');

class shipper {
  var   
	    $shipper_name,
        $shipper_date,
        $consignee_name,
        $invnum,
        $iecodeno,
        $bankadcode,
        $currencyofinv,
		$incoterms,
        $natureofpay,
        $fob,
        $freight,
        $insurance,
        $commission,
        $discount,
	    $descgoodshippingbill,
        $nmpkgs,
        $nettwt,
        $grosstwt,
        $volumewt,
        $descgoodawb,
        $dimension,
        $specialinst,
        $freetradesample,
        $dutyfreecommerical,
	    $eoushippingbill,
        $dutydrawback,
        $dutiableshippingbill,
        $depbshippingbill,
        $dfrcshippingbill,
        $epcgshippingbill,
        $deecshippingbill,
		$repair_return,
		$duty_drawback,
	    $invoice,
	    $are_form,
	    $packinglist,
	    $visa_aepc,
	    $sdfform,
	    $labanalysis,
	    $non_dg,
	    $msds,
	    $purchaseordercopy,
	    $phytosanitarycert,
	    $grform_waiver,
	    $gspcer
	    ;

    // Constructor definition
    function shipper() {
		$this->shipper_name = '';
        $this->shipper_date = '';
        $this->consignee_name = '';
        $this->invnum = '';
        $this->iecodeno = '';
        $this->bankadcode = '';
        $this->currencyofinv = '';
		$this->incoterms ='';
		$this->natureofpay = '';
		$this->fob = '';
		$this->freight = '';
		$this->insurance = '';
		$this->commission = '';
		$this->discount = '';
		$this->descgoodshippingbill = '';
		$this->nmpkgs = '';
		$this->nettwt = '';
		$this->grosstwt = '';
		$this->volumewt = '';
		$this->descgoodawb = '';
		$this->dimension = '';
		$this->specialinst = '';
		$this->freetradesample = '';
        $this->dutyfreecommerical = '';
	    $this->eoushippingbill = '';
        $this->dutydrawback = '';
        $this->dutiableshippingbill = '';
        $this->depbshippingbill = '';
        $this->dfrcshippingbill = '';
        $this->epcgshippingbill = '';
        $this->deecshippingbill = '';
		$this->repair_return = '';
		$this->duty_drawback = '';
	    $this->invoice = '';
	    $this->are_form = '';
	    $this->packinglist = '';
	    $this->visa_aepc = '';
	    $this->sdfform = '';
	    $this->labanalysis = '';
	    $this->non_dg = '';
	    $this->msds = '';
	    $this->purchaseordercopy = '';
	    $this->phytosanitarycert = '';
	    $this->grform_waiver = '';
	    $this->gspcer = '';
    }

    function setshipper_name($shipper_name) {
           $this->shipper_name = $shipper_name;
    }

    function setshipper_date($shipper_date) {
           $this->shipper_date = $shipper_date;
    }

    function setconsignee_name($consignee_name) {
           $this->consignee_name= $consignee_name;
    }

    function setinvnum($invnum) {
           $this->invnum = $invnum;
    }

    function setiecodeno($iecodeno) {
           $this->iecodeno = $iecodeno;
    }

    function setbankadcode($bankadcode) {
           $this->bankadcode = $bankadcode;
    }

    function setcurrencyofinv($currencyofinv) {
           $this->currencyofinv = $currencyofinv;
    }
    function getincoterms() {
           return $this->incoterms;
    }
    function setincoterms($incoterms) {
           $this->incoterms = $incoterms;
    }

    function setnatureofpay($natureofpay) {
           $this->natureofpay = $natureofpay;
    }
    function getfob() {
           return $this->fob;
    }
    function setfob($fob) {
           $this->fob = $fob;
    }
    function getfreight() {
           return $this->freight;
    }
    function setfreight($freight) {
           $this->freight = $freight;
    }
    function getinsurance() {
           return $this->insurance;
    }
    function setinsurance($insurance) {
           $this->insurance = $insurance;
    }
    function getcommission() {
           return $this->commission;
    }
    function setcommission($commission) {
           $this->commission = $commission;
    }
    function getdiscount() {
           return $this->discount;
    }
    function setdiscount($discount) {
           $this->discount = $discount;
    }

    function setdescgoodshippingbill($descgoodshippingbill) {
           $this->descgoodshippingbill = $descgoodshippingbill;
    }

    function setnmpkgs($nmpkgs) {
           $this->nmpkgs = $nmpkgs;
    }
    function getnettwt() {
           return $this->nettwt;
    }
    function setnettwt($nettwt) {
           $this->nettwt = $nettwt;
    }
    function getgrosstwt() {
           return $this->grosstwt;
    }
    function setgrosstwt($grosstwt) {
           $this->grosstwt = $grosstwt;
    }
    function getvolumewt() {
           return $this->volumewt;
    }
    function setvolumewt($volumewt) {
           $this->volumewt = $volumewt;
    }

    function setdescgoodawb ($descgoodawb) {
           $this->descgoodawb = $descgoodawb;
    }
     function getdimension() {
           return $this->dimension;
    }
    function setdimension($dimension) {
           $this->dimension = $dimension;
    }

    function setspecialinst ($specialinst) {
           $this->specialinst = $specialinst;
    }
    function getfreetradesample () {
           return $this->freetradesample;
    }
    function setfreetradesample ($freetradesample) {
           $this->freetradesample = $freetradesample;
    }
    function getdutyfreecommerical () {
           return $this->dutyfreecommerical;
    }
    function setdutyfreecommerical($dutyfreecommerical) {
           $this->dutyfreecommerical = $dutyfreecommerical;
    }
    function geteoushippingbill () {
           return $this->eoushippingbill;
    }
    function seteoushippingbill($eoushippingbill) {
           $this->eoushippingbill = $eoushippingbill;
    }
     function getdutydrawback () {
           return $this->dutydrawback;
    }
    function setdutydrawback($dutydrawback) {
           $this->dutydrawback = $dutydrawback;
    }
    function getinvoice () {
           return $this->invoice;
    }
    function setinvoice ($invoice) {
           $this->invoice = $invoice;
    }

    function setare_form ($are_form) {
           $this->are_form = $are_form;
    }
    function getpackinglist () {
           return $this->packinglist;
    }
    function setpackinglist ($packinglist) {
           $this->packinglist = $packinglist;
    }
	 function getvisa_aepc () {
           return $this->visa_aepc;
    }
    function setvisa_aepc ($visa_aepc) {
           $this->visa_aepc = $visa_aepc;
    }
	 function getsdfform () {
           return $this->sdfform;
    }
    function setsdfform ($sdfform) {
           $this->sdfform = $sdfform;
    }
	function getlabanalysis () {
           return $this->labanalysis;
    }
    function setlabanalysis ($labanalysis) {
           $this->labanalysis = $labanalysis;
    }
	function getnon_dg () {
           return $this->non_dg;
    }
    function setnon_dg ($non_dg) {
           $this->non_dg = $non_dg;
    }
	function getmsds () {
           return $this->msds;
    }
    function setmsds ($msds) {
           $this->msds = $msds;
    }
   function getpurchaseordercopy () {
           return $this->purchaseordercopy;
    }
    function setpurchaseordercopy ($purchaseordercopy) {
           $this->purchaseordercopy = $purchaseordercopy;
    }
   
   function getphytosanitarycert () {
           return $this->phytosanitarycert;
    }
    function setphytosanitarycert ($phytosanitarycert) {
           $this->phytosanitarycert = $phytosanitarycert;
    }
   function getgrform_waiver () {
           return $this->grform_waiver;
    }
    function setgrform_waiver ($grform_waiver) {
           $this->grform_waiver = $grform_waiver;
    }
	function getgspcer () {
           return $this->gspcer;
    }
    function setgspcer ($gspcer) {
           $this->gspcer = $gspcer;
    }

    function setduty_drawback($duty_drawback) {
           $this->duty_drawback = $duty_drawback;
    }
     function setdutiableshippingbill($dutiableshippingbill) {
           $this->dutiableshippingbill = $dutiableshippingbill;
    }
    function setdfrcshippingbill($dfrcshippingbill) {
           $this->dfrcshippingbill = $dfrcshippingbill;
    }
    function setepcgshippingbill($epcgshippingbill) {
           $this->epcgshippingbill = $epcgshippingbill;
    }
    function setrepair_return($repair_return) {
           $this->repair_return = $repair_return;
    }
    function setdeecshippingbill($deecshippingbill) {
           $this->deecshippingbill = $deecshippingbill;
    }
     function setdepbshippingbill($depbshippingbill) {
           $this->depbshippingbill = $depbshippingbill;
    }
   function addshipper() {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select nxtnum from seqnum where tablename = 'shipper' for update";
        //echo "$sql";
        $result = mysql_query($sql);
        if(!$result)
                     {
                     //header("Location:errorMessage.php?validate=Inv1");
                     die("Seqnum access failed..Please report to Sysadmin. " . mysql_error());
                     }
        $myrow = mysql_fetch_row($result);
        $seqnum = $myrow[0];
        $objid = $seqnum + 1;
	    $shipper_name = "'".$this->shipper_name."'";
        $shipdate = $this->shipper_date? "'" .$this->shipper_date. "'":'0000-00-00';
        $consignee_name = "'".$this->consignee_name."'";
        $invnum = "'".$this->invnum."'";
        $iecodeno = "'".$this->iecodeno."'";
        $bankadcode = "'".$this->bankadcode."'";
        $currencyofinv = "'".$this->currencyofinv."'";
		$incoterms = "'".$this->incoterms."'";
        $natureofpay = "'".$this->natureofpay."'";
        $fob = "'".$this->fob."'";
        $freight = "'".$this->freight."'";
        $insurance = "'".$this->insurance."'";
        $commission = "'".$this->commission."'";
        $discount = "'".$this->discount."'";
	    $descgoodshippingbill = "'".$this->descgoodshippingbill."'";
        $nmpkgs = "'".$this->nmpkgs."'";
        $nettwt = "'".$this->nettwt."'";
        $grosstwt = "'".$this->grosstwt."'";
        $volumewt = "'".$this->volumewt."'";
        $descgoodawb = "'".$this->descgoodawb."'";
        $dimension = "'".$this->dimension."'";
        $specialinst = "'".$this->specialinst."'";
        $freetradesample = "'".$this->freetradesample."'";
        $dutyfreecommerical = "'".$this->dutyfreecommerical."'";
	    $eoushippingbill = "'".$this->eoushippingbill."'";
        $dutydrawback = "'".$this->dutydrawback."'";
        $dutiableshippingbill = "'".$this->dutiableshippingbill."'";
        $depbshippingbill = "'".$this->depbshippingbill."'";
        $dfrcshippingbill = "'".$this->dfrcshippingbill."'";
        $epcgshippingbill = "'".$this->epcgshippingbill."'";
        $deecshippingbill = "'".$this->deecshippingbill."'";
		$repair_return = "'".$this->repair_return."'";
		$duty_drawback = "'".$this->duty_drawback."'";
	    $invoice = "'".$this->invoice."'";
	    $are_form = "'".$this->are_form."'";
	    $packinglist = "'".$this->packinglist."'";
	    $visa_aepc = "'".$this->visa_aepc."'";
	    $sdfform = "'".$this->sdfform."'";
	    $labanalysis = "'".$this->labanalysis."'";
	    $non_dg = "'".$this->non_dg."'";
	    $msds = "'".$this->msds."'";
	    $purchaseordercopy = "'".$this->purchaseordercopy."'";
	    $phytosanitarycert = "'".$this->phytosanitarycert."'";
	    $grform_waiver = "'".$this->grform_waiver."'";
	    $gspcer = "'".$this->gspcer."'";
 
            $sql = "INSERT INTO
                        shipper
                            (
							recnum,shipper_name,shipper_date,consignee_name,invnum,iecodeno,bankadcode,currencyofinv,
							incoterms,natureofpay,fob,freight,insurance,commission,discount,descgoodshippingbill,
							nmpkgs,nettwt,grosstwt,volumewt,descgoodawb,dimension,specialinst,freetradesample,
							dutyfreecommerical,eoushippingbill,dutydrawback,dutiableshippingbill,depbshippingbill,
							dfrcshippingbill,epcgshippingbill,deecshippingbill,repair_return,duty_drawback,invoice,
							are_form,packinglist,visa_aepc,sdfform,labanalysis,non_dg,msds,purchaseordercopy,
							phytosanitarycert,grform_waiver,gspcer)
						VALUES
                            (
                            $objid,
							$shipper_name,
							$shipdate,
							$consignee_name,
							$invnum,
							$iecodeno,
							$bankadcode,
							$currencyofinv,
							$incoterms,
							$natureofpay,
							$fob,
							$freight,
							$insurance,
							$commission,
							$discount,
							$descgoodshippingbill,
							$nmpkgs,
							$nettwt,
							$grosstwt,
							$volumewt,
							$descgoodawb,
						    $dimension,
							$specialinst,
							$freetradesample,
							$dutyfreecommerical,
							$eoushippingbill,
							$dutydrawback,
							$dutiableshippingbill,
							$depbshippingbill,
							$dfrcshippingbill,
							$epcgshippingbill,
							$deecshippingbill,
							$repair_return,
							$duty_drawback,
							$invoice,
							$are_form,
							$packinglist,
							$visa_aepc,
							$sdfform,
							$labanalysis,
							$non_dg,
							$msds,
							$purchaseordercopy,
							$phytosanitarycert,
							$grform_waiver,
							$gspcer
							)";
							// echo $sql;
              $result = mysql_query($sql);

          if(!$result) die("Insert to Shipper didn't work..Please report to Sysadmin. " . mysql_error());
          
          $sql = "update seqnum set nxtnum = $objid where tablename = 'shipper'";
        $result = mysql_query($sql);
        // Test to make sure query worked
        if(!$result)
                     {
                     //header("Location:errorMessage.php?validate=Inv4");
                     die("Seqnum insert query didn't work..Please report to Sysadmin. " . mysql_error());
                     }
                     return $objid;
     }
function getshippers($cond,$argoffset,$arglimit) {
	  
        $wcond = $cond;
        $offset = $argoffset;
        $limit = $arglimit;
        $sortorder= "";
        if($sortorder=='')
          $sortorder="";
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select 	   
		                    s.recnum,
		                    s.shipper_name,
							s.shipper_date,
							s.consignee_name,
							s.invnum,
							s.iecodeno,
							s.bankadcode,
							s.currencyofinv,
							s.incoterms,
							s.natureofpay,
							s.fob,
							s.freight,
							s.insurance,
							s.commission,
							s.discount,
							s.descgoodshippingbill,
							s.nmpkgs,
							s.nettwt,
							s.grosstwt,
							s.volumewt,
							s.descgoodAWB,
						    s.dimension,
							s.specialInst,
							s.freetradesample,
							s.dutyfreecommerical,
							s.eoushippingbill,
							s.dutydrawback,
							s.dutiableshippingbill,
							s.depbshippingbill,
							s.dfrcshippingbill,
							s.epcgshippingbill,
							s.deecshippingbill,
							s.repair_return,
							s.dutydrawback,
							s.invoice,
							s.are_form,
							s.packinglist,
							s.visa_aepc,
							s.sdfform,
							s.labanalysis,
							s.non_dg,
							s.msds,
							s.purchaseordercopy,
							s.phytosanitarycert,
							s.grform_waiver,
							s.gspcer
							
            FROM shipper s 
                       ORDER by recnum desc limit $offset, $limit";
        $result = mysql_query($sql);
        //echo "$sql";//ORDER by $sortorder
        return $result;
     }
    function getshippercount($cond,$argoffset, $arglimit)
     {
        $wcond = $cond;
        $offset = $argoffset;
        $limit = $arglimit;
             $sql = "select count(*) as numrows from shipper s 
                              limit $offset, $limit";
	    //echo $sql;
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $result  = mysql_query($sql) or die('Shipper count query failed');
        $row     = mysql_fetch_array($result, MYSQL_ASSOC);
        $numrows = $row['numrows'];
        return $numrows;
     }
     function getshipperdata($shipperrecnum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
      $sql = "select 	    s.shipper_name,
							s.shipper_date,
							s.consignee_name,
							s.invnum,
							s.iecodeno,
							s.bankadcode,
							s.currencyofinv,
							s.incoterms,
							s.natureofpay,
							s.fob,
							s.freight,
							s.insurance,
							s.commission,
							s.discount,
							s.descgoodshippingbill,
							s.nmpkgs,
							s.nettwt,
							s.grosstwt,
							s.volumewt,
							s.descgoodawb,
						    s.dimension,
							s.specialinst,
							s.freetradesample,
							s.dutyfreecommerical,
							s.eoushippingbill,
							s.dutydrawback,
							s.dutiableshippingbill,
							s.depbshippingbill,
							s.dfrcshippingbill,
							s.epcgshippingbill,
							s.deecshippingbill,
							s.repair_return,
							s.duty_drawback,
							s.invoice,
							s.are_form,
							s.packinglist,
							s.visa_aepc,
							s.sdfform,
							s.labanalysis,
							s.non_dg,
							s.msds,
							s.purchaseordercopy,
							s.phytosanitarycert,
							s.grform_waiver,
							s.gspcer
            FROM shipper s 
                       where   s.recnum = $shipperrecnum ";
        //echo $sql;
        $result = mysql_query($sql);
        return $result;
     }
     

  function updateshipper($shipperrecnum) {
	  
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $shipper_name = "'".$this->shipper_name."'";
        $shipdate = $this->shipper_date? "'" .$this->shipper_date. "'":'0000-00-00';
        $consignee_name = "'".$this->consignee_name."'";
        $invnum = "'".$this->invnum."'";
        $iecodeno = "'".$this->iecodeno."'";
		$bankadcode = "'".$this->bankadcode."'";
        $currencyofinv = "'".$this->currencyofinv."'";
		$incoterms = "'".$this->incoterms."'";
        $natureofpay = "'".$this->natureofpay."'";
        $fob = "'".$this->fob."'";
        $freight = "'".$this->freight."'";
        $insurance = "'".$this->insurance."'";
        $commission = "'".$this->commission."'";
        $discount = "'".$this->discount."'";
	    $descgoodshippingbill = "'".$this->descgoodshippingbill."'";
        $nmpkgs = "'".$this->nmpkgs."'";
        $nettwt = "'".$this->nettwt."'";
        $grosstwt = "'".$this->grosstwt."'";
        $volumewt = "'".$this->volumewt."'";
        $descgoodawb = "'".$this->descgoodawb."'";
        $dimension = "'".$this->dimension."'";
        $specialinst = "'".$this->specialinst."'";
        $freetradesample = "'".$this->freetradesample."'";
        $dutyfreecommerical = "'".$this->dutyfreecommerical."'";
	    $eoushippingbill = "'".$this->eoushippingbill."'";
        $dutydrawback = "'".$this->dutydrawback."'";
        $dutiableshippingbill = "'".$this->dutiableshippingbill."'";
        $depbshippingbill = "'".$this->depbshippingbill."'";
        $dfrcshippingbill = "'".$this->dfrcshippingbill."'";
        $epcgshippingbill = "'".$this->epcgshippingbill."'";
        $deecshippingbill = "'".$this->deecshippingbill."'";
		$repair_return = "'".$this->repair_return."'";
		$duty_drawback = "'".$this->duty_drawback."'";
	    $invoice = "'".$this->invoice."'";
	    $are_form = "'".$this->are_form."'";
	    $packinglist = "'".$this->packinglist."'";
	    $visa_aepc = "'".$this->visa_aepc."'";
	    $sdfform = "'".$this->sdfform."'";
	    $labanalysis = "'".$this->labanalysis."'";
	    $non_dg = "'".$this->non_dg."'";
	    $msds = "'".$this->msds."'";
	    $purchaseordercopy = "'".$this->purchaseordercopy."'";
	    $phytosanitarycert = "'".$this->phytosanitarycert."'";
	    $grform_waiver = "'".$this->grform_waiver."'";
	    $gspcer = "'".$this->gspcer."'";
	    
        $sql = "UPDATE shipper SET
                            shipper_name = $shipper_name,
							shipper_date = $shipdate,
							consignee_name = $consignee_name,
							invnum = $invnum,
							iecodeno = $iecodeno,
							bankadcode = $bankadcode,
							currencyofinv = $currencyofinv,
							incoterms = $incoterms,
							natureofpay = $natureofpay,
							fob = $fob,
							freight = $freight,
							insurance = $insurance,
							commission = $commission,
							discount = $discount,
							descgoodshippingbill = $descgoodshippingbill,
							nmpkgs = $nmpkgs,
							nettwt = $nettwt,
							grosstwt = $grosstwt,
							volumewt = $volumewt,
							descgoodawb = $descgoodawb,
						    dimension = $dimension,
							specialinst = $specialinst,
							freetradesample = $freetradesample,
							dutyfreecommerical = $dutyfreecommerical,
							eoushippingbill = $eoushippingbill,
							dutydrawback = $dutydrawback,
							dutiableshippingbill = $dutiableshippingbill,
							depbshippingbill = $depbshippingbill,
							dfrcshippingbill = $dfrcshippingbill,
							epcgshippingbill = $epcgshippingbill,
							deecshippingbill = $deecshippingbill,
							repair_return = $repair_return,
							duty_drawback = $duty_drawback,
							invoice = $invoice,
							are_form = $are_form,
							packinglist = $packinglist,
							visa_aepc = $visa_aepc,
							sdfform = $sdfform,
							labanalysis = $labanalysis,
							non_dg = $non_dg,
							msds = $msds,
							purchaseordercopy = $purchaseordercopy,
							phytosanitarycert = $phytosanitarycert,
							grform_waiver = $grform_waiver,
							gspcer = $gspcer
        			   WHERE
                       recnum = $shipperrecnum";
      // echo $sql;
       $result = mysql_query($sql) or die("shipper update failed...Please report to SysAdmin. " . mysql_error());
 }

} // End Shipper class definition

