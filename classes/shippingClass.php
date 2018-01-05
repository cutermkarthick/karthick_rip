<?php
//====================================
// Author: FSI
// Date-written = Dec 07, 2006
// Filename: invoiceClass.php
// Maintains the class for invoice
// Revision: v1.0  OWT
//====================================

include_once('loginClass.php');

class shipping {
    var
    $sbnum,
   $sbdate,
   $qcert,
   $qcertdate,
   $impcode,
   $rbicode,
   $custome_house_agent,
   $lic_no,
   $rotatingnum,
//echo  "inv2customer" .  $inv2customer;
   $cf,
   $cfr,
   $fob,
 //echo  "inv2customer" .  $inv2customer;
   $other_contract,
   $exchange_rate,
   $currency_in,
   $net_weight,
   $gross_weight,
   $fob_words,
   $invrecnum,
   $ship2customer,
   $fob_value,
   $fob_cur,
   $fob_inr,

   $freight_value,
   $freight_cur,
   $freight_inr,

   $insurance_value,
   $insurance_cur,
   $insurance_inr,

   $commission_value,
   $commission_cur,
   $commission_inr,

   $discount_value,
   $discount_cur,
   $discount_inr,

   $other_value,
   $other_cur,
   $other_inr,

   $deduction_value,
   $deduction_cur,
   $deduction_inr,
   $linenumber,
	$marknum,
	$statnum,
	$qty,
	$vfob,
    $shipping_id,
    $create_date,
    $deffcredit,
   $jointven,
   $rucredit,
   $others_ex,
   $rbiapp,
   $rbiappdate,
   $outrightsale,
   $conexp,
   $other_sh,
   $ar4anum,
  $ar4adate,
  $qty_total,
  $vfob_total;

    // Constructor definition
    function invoice() {

   $this->sbnum =  '';
   $this->sbdate = '';
   $this->qcert =  '';
   $this->qcertdate =  '';
   $this->impcode =  '';
   $this->rbicode =  '';
   $this->custome_house_agent =  '';
   $this->lic_no =  '';
   $this->rotatingnum =  '';
//echo  "inv2customer" .  $inv2customer;
   $this->cf =  '';
   $this->cfr =  '';
   $this->fob =  '';
 //echo  "inv2customer" .  $inv2customer;
   $this->other_contract =  '';
   $this->exchange_rate=  '';
   $this->currency_in= '';
   $this->net_weight =  '';
   $this->gross_weight=  '';
   $this->fob_words=  '';
   $this->invrecnum= '';
   $this->ship2customer= '';
   $this->fob_value =  '';
   $this->fob_cur=  '';
   $this->fob_inr=  '';

   $this->freight_value =  '';
   $this->freight_cur=  '';
   $this->freight_inr=  '';

   $this->insurance_value =  '';
   $this->insurance_cur=  '';
   $this->insurance_inr=  '';

   $this->commission_value =  '';
   $this->commission_cur=  '';
   $this->commission_inr=  '';

   $this->discount_value =  '';
   $this->discount_cur=  '';
   $this->discount_inr=  '';

   $this->other_value =  '';
   $this->other_cur=  '';
   $this->other_inr=  '';

   $this->deduction_value =  '';
   $this->deduction_cur= '';
   $this->deduction_inr=  '';

   $this->linenumber =  '';
   $this->marknum= '';
   $this->qty=  '';
   $this->statnum=  '';
   $this->vfob=  '';
   $this->shipping_id=  '';
   $this->create_date=  '';

   $this->deffcredit =  '';
   $this->jointven= '';
   $this->rucredit=  '';
   $this->others_ex=  '';
   $this->rbiapp=  '';
   $this->rbiappdate=  '';
   
    $this->outrightsale =  '';
    $this->conexp =  '';
    $this->other_sh =  '';
    
    $this->ar4anum =  '';
     $this->ar4adate =  '';
    $this->qty_total =  '';
   $this->vfob_total =  '';


    }



    function getsbnum() {
           return $this->getsbnum;
    }
    function setsbnum ($sbnum) {
           $this->sbnum = $sbnum;
    }

    function getsbdate() {
           return $this->sbdate;
    }
    function setsbdate($sbdate) {
           $this->sbdate = $sbdate;
    }

    function getqcert() {
           return $this->qcert;
    }
    function setqcert ($qcert) {
           $this->qcert = $qcert;
    }

    function getqcertdate() {
           return $this->qcertdate;
    }
    function setqcertdate ($qcertdate) {
           $this->qcertdate = $qcertdate;
    }

    function getimpcode() {
           return $this->impcode;
    }
    function setimpcode($impcode) {
           $this->impcode = $impcode;
    }

    function getrbicode() {
           return $this->rbicode;
    }
    function setrbicode ($rbicode) {
           $this->rbicode = $rbicode;
    }

    function getcustome_house_agent() {
           return $this->custome_house_agent;
    }
    function setcustome_house_agent ($custome_house_agent) {
           $this->custome_house_agent = $custome_house_agent;
    }

    function getlic_no() {
           return $this->lic_no;
    }
    function setlic_no ($lic_no) {
           $this->lic_no = $lic_no;
    }

    function getrotatingnum() {
           return $this->rotatingnum;
    }
    function setrotatingnum ($rotatingnum) {
           $this->rotatingnum= $rotatingnum;
    }

    function getcf() {
           return $this->cf;
    }
    function setcf($cf) {
           $this->cf= $cf;
    }

    function getcfr() {
           return $this->cfr;
    }
    function setcfr($cfr) {
           $this->cfr= $cfr;
    }

    function getfob() {
           return $this->fob;
    }
    function setfob ($fob) {
           $this->fob = $fob;
    }

    function getship2customer() {
           return $this->ship2customer;
    }
    function setship2customer ($ship2customer) {
           $this->ship2customer = $ship2customer;
    }

    function getinvrecnum() {
           return $this->invrecnum;
    }
    function setinvrecnum ($invrecnum) {
           $this->invrecnum = $invrecnum;
    }

    function getfob_value() {
           return $this->fob_value;
    }
    function setfob_value ($fob_value) {
           $this->fob_value = $fob_value;
    }

    function getfob_cur() {
           return $this->fob_cur;
    }
    function setfob_cur($fob_cur) {
           $this->fob_cur = $fob_cur;
    }

    function setfob_inr($fob_inr) {
           $this->fob_inr = $fob_inr;
    }

    function getfreight_value() {
           return $this->freight_value;
    }
    function setfreight_value($freight_value) {
           $this->freight_value = $freight_value;
    }
    
    function getfreight_cur() {
           return $this->freight_cur;
    }
    function setfreight_cur($freight_cur) {
           $this->freight_cur = $freight_cur;
    }

    function getfreight_inr() {
           return $this->freight_inr;
    }
    function setfreight_inr($freight_inr) {
           $this->freight_inr = $freight_inr;
    }
    
     function getinsurance_value() {
           return $this->insurance_value;
    }
    function setinsurance_value($insurance_value) {
           $this->insurance_value = $insurance_value;
    }

    function getinsurance_cur() {
           return $this->insurance_cur;
    }
    function setinsurance_cur($insurance_cur) {
           $this->insurance_cur = $insurance_cur;
    }

    function getinsurance_inr() {
           return $this->insurance_inr;
    }
    function setinsurance_inr($insurance_inr) {
           $this->insurance_inr = $insurance_inr;
    }
    
    function getcommission_value() {
           return $this->commission_value;
    }
    function setcommission_value($commission_value) {
           $this->commission_value = $commission_value;
    }

    function getcommission_cur() {
           return $this->commission_cur;
    }
    function setcommission_cur($commission_cur) {
           $this->commission_cur = $commission_cur;
    }

    function getcommission_inr() {
           return $this->commission_inr;
    }
    function setcommission_inr($commission_inr) {
           $this->commission_inr = $commission_inr;
    }
    
    function getdiscount_value() {
           return $this->discount_value;
    }
    function setdiscount_value($discount_value) {
           $this->discount_value = $discount_value;
    }

    function getdiscount_cur() {
           return $this->discount_cur;
    }
    function setdiscount_cur($discount_cur) {
           $this->discount_cur = $discount_cur;
    }

    function getdiscount_inr() {
           return $this->discount_inr;
    }
    function setdiscount_inr($discount_inr) {
           $this->discount_inr = $discount_inr;
    }
    
    function getother_value() {
           return $this->other_value;
    }
    function setother_value($other_value) {
           $this->other_value = $other_value;
    }

    function getother_cur() {
           return $this->other_cur;
    }
    function setother_cur($other_cur) {
           $this->other_cur = $other_cur;
    }

    function getother_inr() {
           return $this->other_inr;
    }
    function setother_inr($other_inr) {
           $this->other_inr = $other_inr;
    }
    
    function getdeduction_value() {
           return $this->deduction_value;
    }
    function setdeduction_value($deduction_value) {
           $this->deduction_value = $deduction_value;
    }

    function getdeduction_cur() {
           return $this->deduction_cur;
    }
    function setdeduction_cur($deduction_cur) {
           $this->deduction_cur = $deduction_cur;
    }

    function getdeduction_inr() {
           return $this->deduction_inr;
    }
    function setdeduction_inr($deduction_inr) {
           $this->deduction_inr = $deduction_inr;
    }
    function getother_contract() {
           return $this->other_contract;
    }
    function setother_contract($other_contract) {
           $this->other_contract = $other_contract;
    }

    function getexchange_rate() {
           return $this->exchange_rate;
    }
    function setexchange_rate($exchange_rate) {
           $this->exchange_rate = $exchange_rate;
    }
    function setcurrency_in($currency_in) {
           $this->currency_in = $currency_in;
    }

   function setnet_weight($net_weight) {
           $this->net_weight = $net_weight;
    }
   function setgross_weight($gross_weight) {
           $this->gross_weight = $gross_weight;
    }
   function setfob_words($fob_words) {
           $this->fob_words = $fob_words;
    }

     function setlinenum($linenumber) {
           $this->linenumber = $linenumber;
    }

   function setmarknum($marknum) {
           $this->marknum = $marknum;
    }
    
    function setstatnum($statnum) {
           $this->statnum = $statnum;
    }
   function setqty($qty) {
           $this->qty = $qty;
    }
   function setvfob($vfob) {
           $this->vfob = $vfob;
    }
    
     function setlink2shipping($link2shipping) {
           $this->link2shipping = $link2shipping;
    }
    
    function setshipping_id($shipping_id) {
           $this->shipping_id = $shipping_id;
    }

     function setcreate_date($create_date) {
           $this->create_date = $create_date;
    }
    

      function setdeffcredit($deffcredit) {
           $this->deffcredit = $deffcredit;
    }
   function setjointven($jointven) {
           $this->jointven = $jointven;
    }
   function setrucredit($rucredit) {
           $this->rucredit = $rucredit;
    }

     function setothers_ex($others_ex) {
           $this->others_ex = $others_ex;
    }

    function setrbiapp($rbiapp) {
           $this->rbiapp = $rbiapp;
    }

     function setrbiappdate($rbiappdate) {
           $this->rbiappdate = $rbiappdate;
    }

   
    function setoutrightsale($outrightsale) {
           $this->outrightsale = $outrightsale;
    }

    function setconexp($conexp) {
           $this->conexp = $conexp;
    }

     function setother_sh($other_sh) {
           $this->other_sh = $other_sh;
    }
    

     function setar4anum($ar4anum) {
           $this->ar4anum = $ar4anum;
    }

     function setar4adate($ar4adate) {
           $this->ar4adate = $ar4adate;
    }

    function setqty_total($qty_total) {
           $this->qty_total = $qty_total;
    }

     function setvfob_total($vfob_total) {
           $this->vfob_total = $vfob_total;
    }
 
    function addshipping() {
       //echo "I am here";
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "start transaction";
        $result = mysql_query($sql);
        $sql = "select nxtnum from seqnum where tablename = 'shipping' for update";
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
        //$modobjid = $objid - 1261;
        // Modified for 2013-14
        //$modobjid = $objid - 2476;
        //$prefix = "S";
        //$suffix = '/13-14';

        // Modified for 2014-15
	//$modobjid = $objid - 3580;
        //$prefix = "S";
        //$suffix = '/14-15';

        // Modified for 2015-16
	//$modobjid = $objid - 4650;
       //$prefix = "S";
       // $suffix = '/15-16';

        // Modified for 2016-17
	$modobjid = $objid - 5660;
        $prefix = "S";
        $suffix = '/16-17';

        $strrecnum=sprintf("%03d",$modobjid);
        $shipid=$prefix.$strrecnum.$suffix;
         $sbnum = "'" . $this->sbnum . "'";
         $sbdate=  $this->sbdate?"'" . $this->sbdate . "'":'0000-00-00';
       $qcertnum =  "'" . $this->qcert . "'";
        $qcertdate = $this->qcertdate?"'" . $this->qcertdate . "'":'0000-00-00';
        $impcode = "'" . $this->impcode . "'";
       $rbicode =  "'" . $this->rbicode . "'";
       $custome_house_agent =  "'" . $this->custome_house_agent . "'";
       $lic_no =  "'" . $this->lic_no . "'";
       $rotatingnum =  "'" . $this->rotatingnum . "'";
//echo  "inv2customer" .  $inv2customer;
         $cf = "'" . $this->cf . "'";
         $cfr = "'" . $this->cfr . "'";
        $fob =  "'" . $this->fob . "'";
 //echo  "inv2customer" .  $inv2customer;
         $other_contract =  "'" . $this->other_contract . "'";
         $exchange_rate =  "'" . $this->exchange_rate . "'";
         $currency_in =  "'" . $this->currency_in . "'";
         $net_weight =  "'" . $this->net_weight . "'";
         $gross_weight =  "'" . $this->gross_weight . "'";
         $fob_words =  "'" . $this->fob_words . "'";
         $invrecnum =$this->invrecnum;
         $ship2customer =  "'" . $this->ship2customer . "'";
         $fob_value =  "'" . $this->fob_value . "'";
         $fob_cur =  "'" . $this->fob_cur . "'";
         $fob_inr =  "'" . $this->fob_inr . "'";

         $freight_value =  "'" . $this->freight_value . "'";
         $freight_cur =  "'" . $this->freight_cur . "'";
         $freight_inr =  "'" . $this->freight_inr . "'";

          $insurance_value = "'" . $this->insurance_value . "'";
          $insurance_cur = "'" . $this->insurance_cur . "'";
         $insurance_inr =  "'" . $this->insurance_inr . "'";

          $commission_value = "'" . $this->commission_value . "'";
         $commission_cur =  "'" . $this->commission_cur . "'";
         $commission_inr = "'" . $this->commission_inr . "'";

          $discount_value = "'" . $this->discount_value . "'";
         $discount_cur =  "'" . $this->discount_cur . "'";
         $discount_inr =  "'" . $this->discount_inr . "'";

          $other_value = "'" . $this->other_value . "'";
         $other_cur =  "'" . $this->other_cur . "'";
         $other_inr = "'" . $this->other_inr . "'";

          $deduction_value = "'" . $this->deduction_value . "'";
         $deduction_cur =  "'" . $this->deduction_cur . "'";
         $deduction_inr =  "'" . $this->deduction_inr . "'";
         
         $deffcredit =  $this->deffcredit ;
         $jointven =  "'" . $this->jointven . "'";
         $rucredit =    "'" . $this->rucredit . "'";
         $others_ex =    "'" . $this->others_ex . "'";
         $rbiapp =    "'" . $this->rbiapp . "'";
         $rbiappdate =  $this->rbiappdate? "'" . $this->rbiappdate . "'":'0000-00-00';
         
         $outrightsale=  "'" . $this->outrightsale . "'";
         $conexp=  "'" . $this->conexp . "'";
         $other_sh=  "'" . $this->other_sh . "'";
         
         $ar4anum=  "'" . $this->ar4anum . "'";
         $ar4adate=  $this->ar4adate?"'" . $this->ar4adate . "'":'0000-00-00';

         $qty_total=$this->qty_total?$this->qty_total:0.0;
         $vfob_total= $this->vfob_total?$this->vfob_total:0.0;

        $sql = "select * from shipping where recnum = $objid";
       // echo $sql;
        $result = mysql_query($sql);
        if (!(mysql_fetch_row($result))) {
           $sql = "INSERT INTO
                        shipping
                            (
                            recnum,
							link2invoice,
							sbnum,
							sbdate,
							impexpcode,
							rbicode,
					        qcertnum,
                            qcertdate,
                            rotatingnum,
                            cf,
                            cfr,
                            fob,
                            contractother,
							exchangerate,
							netweight,
							grossweight,
							fobwords,
							fob_value,
							fob_currency,
                            fob_inr,
                            freight_value,
                            freight_currency,
                            freight_inr,
                            insurance_value,
                            insurance_currency,
                            insurance_inr,
                             commission_value,
                             commission_currency,
                             commission_inr,
                             discount_value,
                             discount_currency,
                             discount_inr,
                             other_value,
                             other_currency,
                             other_inr,
                             deduction_value,
                             deduction_currency,
                             deduction_inr,
                             custom_agent,
                             shipping_id,
                             createdate,
                             licnum,
                             formrev,
                             deffcredit,
                             jointventure,
                             rupcredit,
                             otherex,
                             rbiappcode,
                             rbiappdate,
                             outrightsale,
                             consignmentexp,
                             othersh,
                             ar4anum,
                             ar4adate,
                             total_qty,
                             vfobtotal
                            )
                    VALUES
                            (
                            $objid,
                            $invrecnum,
							'$shipid',
							$sbdate,
							$impcode,
							$rbicode,
					        $qcertnum,
                            $qcertdate,
                            $rotatingnum,
                            $cf,
                            $cfr,
                            $fob,
                            $other_contract,
							$exchange_rate,
							$net_weight,
							$gross_weight,
							$fob_words,
							$fob_value,
							$fob_cur,
                            $fob_inr,
                            $freight_value,
                            $freight_cur,
                            $freight_inr,
                            $insurance_value,
                            $insurance_cur,
                            $insurance_inr,
                             $commission_value,
                             $commission_cur,
                             $commission_inr,
                             $discount_value,
                             $discount_cur,
                             $discount_inr,
                             $other_value,
                             $other_cur,
                             $other_inr,
                             $deduction_value,
                             $deduction_cur,
                             $deduction_inr,
                             $custome_house_agent,
                             '$shipid',
                             now(),
                             $lic_no,
                             'F7000 Rev 00 dt August 04, 2011',
                             '$deffcredit',
                             $jointven,
                             $rucredit,
                             $others_ex,
                             $rbiapp,
                             $rbiappdate,
                             $outrightsale,
                             $conexp,
                             $other_sh,
                             $ar4anum,
                             $ar4adate,
                             $qty_total,
                             $vfob_total
                            )";
           //echo "\n" . $sql;
           $result = mysql_query($sql);
           // Test to make sure query worked
           if(!$result)
                        {
                        //header("Location:errorMessage.php?validate=Inv2");
                        die("Insert to invoice didn't work..Please report to Sysadmin. " . mysql_error());
                        }
         }
         else {
              //header("Location:errorMessage.php?validate=Inv3");
              die("Invoice ID " . $objid . " already exists. ");
              }

        $sql = "update seqnum set nxtnum = $objid where tablename = 'shipping'";
        $result = mysql_query($sql);
        // Test to make sure query worked
        if(!$result)
                     {
                     //header("Location:errorMessage.php?validate=Inv4");
                     die("Seqnum insert query didn't work..Please report to Sysadmin. " . mysql_error());
                     }
        return $objid;
     }
     
     function addshippingli()
     {
      $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "start transaction";
        $result = mysql_query($sql);
        $sql = "select nxtnum from seqnum where tablename = 'shipping_line_items' for update";
        $result = mysql_query($sql);
        if(!$result) {
           $sql = "rollback";
           $result = mysql_query($sql);
           die("Seqnum access failed for LI..Please report to Sysadmin. " . mysql_error());
        }
        $myrow = mysql_fetch_row($result);
        $seqnum = $myrow[0];
        $objid = $seqnum + 1;
        $linenum = $this->linenumber;
        $marknum =" ' ". $this->marknum . " ' ";
        $qty = $this->qty?$this->qty:0;
        $statnum =" ' ".  $this->statnum . " ' ";
		$vfob = $this->vfob? $this->vfob:0;
		$link2shipping = $this->link2shipping;

        $sql = "INSERT INTO shipping_line_items (
		                        recnum,
								line_num,
								marknum,
								statcode,
								qty,
								value_fob ,
							   link2shipping)
                            VALUES (
							   $objid,
							   $linenum,
							   $marknum,
							   $statnum,
							   $qty,
							   $vfob,
             				   $link2shipping)";
        // echo $sql;exit;
        $result = mysql_query($sql);
        // Test to make sure query worked
        if(!$result) {
           $sql = "rollback";
           $result = mysql_query($sql);
           die("Insert to LI didn't work..Please report to Sysadmin. " . mysql_error());
        }
         $sql = "update seqnum set nxtnum = $objid where tablename = 'shipping_line_items'";
   // echo "$sql";
        $result = mysql_query($sql);
        // Test to make sure query worked
        if(!$result) {
           $sql = "rollback";
           $result = mysql_query($sql);
           die("Seqnum insert query didn't work for invoice line items..Please report to Sysadmin. " . mysql_error());
        }
     }

    function updateshippingli($recnum) {
        $lirecnum = $recnum;
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "start transaction";
        $linenum = $this->linenumber;
        $marknum =" ' ". $this->marknum . " ' ";
        $qty = $this->qty?$this->qty:0;
        $statnum =" ' ".  $this->statnum . " ' ";
		$vfob = $this->vfob? $this->vfob:0;
		$link2shipping = $this->link2shipping;

        $sql = "update shipping_line_items
                          set line_num = $linenum,
                              marknum = $marknum,
                              statcode = $statnum,
                              qty = $qty,
                              value_fob = $vfob,
                              link2shipping= $link2shipping
                        where recnum = $lirecnum";
         //echo "$sql";
           $result = mysql_query($sql);
           // Test to make sure query worked
           if(!$result) die("updateshippingli  didn't work..Please report to Sysadmin. " . mysql_error());

     }


     function customeraddress($invoicerecnum) {
       $newlogin = new userlogin;
       $newlogin->dbconnect();
       $sql = "select c.name, c.id,
               c.baddr1, c.baddr2, c.bcity, c.bstate,c.bzipcode,c.bcountry,
               c.saddr1, c.saddr2, c.scity, c.sstate, c.szipcode, c.scountry , i.recnum , i.inv2customer
               FROM invoice i, company c
            where c.recnum = i.inv2customer
            and   i.recnum = $invoicerecnum";

//echo "$sql";
       $result = mysql_query($sql);
       if(!$result) die("Failed to get customer address...Please report to SysAdmin. " . mysql_error());
       return $result;
     }

     function getinvoices() {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
         $sql = "select i.recnum,
		                          i.invnum,
								  i.invdate,
								  i.duedate,
								  i.invdesc,
								  i.terms,
								  i.total,
								  i.status,
								  c.name,
								  i.custpo_num,
								  i.currency,
								  i.fob_or_candf,
								  i.totaldue
                         from invoice i,
						          company c
                         where c.recnum = i.inv2customer";

        //echo "\n" . $sql;
        $result = mysql_query($sql);
        return $result;

     }


     function getInvoiceDetails($invoicerecnum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();

       $sql = " select
                            i.recnum,
							i.invnum,
							i.invdate,
							i.duedate,
							i.invdesc,
							i.terms,
							i.currency,
							i.exporter,
							i.consignee,
					        i.precarriageby,
                            i.precarrierreceipt,
                            i.packages,
                            i.countryoforigin,
                            i.countryoffinaldest,
                            i.vessel,
                            i.portofloading,
                            i.portofdischarge,
							i.subtotal,
							i.finaldest,
							i.total,
							i.status,
							i.custpo_num,
							c.name,
							c.baddr1,
							c.bcity,
							c.bcountry,
							c.saddr1,
							c.scity,
							c.scountry,
							i.totaldue,
							i.fob_or_candf,
							i.inv2customer,
							c.saddr2,
							c.addr1,
							c.addr2,
							c.city,
							c.country,
							c.state,
							c.zipcode,
							i.advance_amount
                     from invoice i,
					          company c
                    where c.recnum = i.inv2customer and
                                i.recnum = $invoicerecnum";

       //echo $sql;
        $result = mysql_query($sql);
        return $result;
     }

     function updateshipping($recnum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $shipping_id= "'" . $this->shipping_id . "'";
         $sbnum = "'" . $this->sbnum . "'";
        $sbdate = $this->sbdate? "'" . $this->sbdate . "'":'0000-00-00';
       $qcertnum =  "'" . $this->qcert . "'";
        $qcertdate = $this->qcertdate?"'" . $this->qcertdate . "'":'0000-00-00';
        $impcode = "'" . $this->impcode . "'";
       $rbicode =  "'" . $this->rbicode . "'";
       $custome_house_agent =  "'" . $this->custome_house_agent . "'";
       $lic_no =  "'" . $this->lic_no . "'";
       $rotatingnum =  "'" . $this->rotatingnum . "'";
//echo  "inv2customer" .  $inv2customer;
         $cf = "'" . $this->cf . "'";
         $cfr = "'" . $this->cfr . "'";
        $fob =  "'" . $this->fob . "'";
 //echo  "inv2customer" .  $inv2customer;
         $other_contract =  "'" . $this->other_contract . "'";
         $exchange_rate =  "'" . $this->exchange_rate . "'";
         $currency_in =  "'" . $this->currency_in . "'";
         $net_weight =  "'" . $this->net_weight . "'";
         $gross_weight =  "'" . $this->gross_weight . "'";
         $fob_words =  "'" . $this->fob_words . "'";
         $invrecnum =$this->invrecnum;
         $ship2customer =  "'" . $this->ship2customer . "'";
         $fob_value =  "'" . $this->fob_value . "'";
         $fob_cur =  "'" . $this->fob_cur . "'";
         $fob_inr =  "'" . $this->fob_inr . "'";

         $freight_value =  "'" . $this->freight_value . "'";
         $freight_cur =  "'" . $this->freight_cur . "'";
         $freight_inr =  "'" . $this->freight_inr . "'";

          $insurance_value = "'" . $this->insurance_value . "'";
          $insurance_cur = "'" . $this->insurance_cur . "'";
         $insurance_inr =  "'" . $this->insurance_inr . "'";

          $commission_value = "'" . $this->commission_value . "'";
         $commission_cur =  "'" . $this->commission_cur . "'";
         $commission_inr = "'" . $this->commission_inr . "'";

          $discount_value = "'" . $this->discount_value . "'";
         $discount_cur =  "'" . $this->discount_cur . "'";
         $discount_inr =  "'" . $this->discount_inr . "'";

          $other_value = "'" . $this->other_value . "'";
         $other_cur =  "'" . $this->other_cur . "'";
         $other_inr = "'" . $this->other_inr . "'";

          $deduction_value = "'" . $this->deduction_value . "'";
         $deduction_cur =  "'" . $this->deduction_cur . "'";
         $deduction_inr =  "'" . $this->deduction_inr . "'";
         $create_date = $this->create_date? "'" . $this->create_date . "'":'0000-00-00';
         
         $deffcredit =  "'" . $this->deffcredit . "'";
         $jointven =  "'" . $this->jointven . "'";
         $rucredit =    "'" . $this->rucredit . "'";
         $others_ex =    "'" . $this->others_ex . "'";
         $rbiapp =   "'" . $this->rbiapp . "'";
         $rbiappdate =  $this->rbiappdate? "'" . $this->rbiappdate . "'":'0000-00-00';
         
         $outrightsale=  "'" . $this->outrightsale . "'";
         $conexp=  "'" . $this->conexp . "'";
         $other_sh=  "'" . $this->other_sh . "'";
         
         $ar4anum=  "'" . $this->ar4anum . "'";
         $ar4adate=  $this->ar4adate?"'" . $this->ar4adate . "'":'0000-00-00';
         
         $qty_total=$this->qty_total?$this->qty_total:0.0;
         $vfob_total= $this->vfob_total?$this->vfob_total:0.0;
         
         $sql = "UPDATE shipping SET
                     		link2invoice=$invrecnum,
							sbnum=$sbnum,
							sbdate=$sbdate,
							impexpcode=$impcode,
							rbicode=$rbicode,
					        qcertnum=$qcertnum,
                            qcertdate=$qcertdate,
                            rotatingnum=$rotatingnum,
                            cf=$cf,
                            cfr=$cfr,
                            fob=$fob,
                            contractother=$other_contract,
							exchangerate=$exchange_rate,
							netweight=$net_weight,
							grossweight=$gross_weight,
							fobwords=$fob_words,
							fob_value=$fob_value,
							fob_currency=$fob_cur,
                            fob_inr=$fob_inr,
                            freight_value=$freight_value,
                            freight_currency=$freight_cur,
                            freight_inr=$freight_inr,
                            insurance_value=$insurance_value,
                            insurance_currency=$insurance_cur,
                            insurance_inr=$insurance_inr,
                             commission_value=$commission_value,
                             commission_currency=$commission_cur,
                             commission_inr=$commission_inr,
                             discount_value=$discount_value,
                             discount_currency=$discount_cur,
                             discount_inr=$discount_inr,
                             other_value=$other_value,
                             other_currency=$other_cur,
                             other_inr=$other_inr,
                             deduction_value=$deduction_value,
                             deduction_currency=$deduction_cur,
                             deduction_inr=$deduction_inr,
                             custom_agent=$custome_house_agent,
                             shipping_id=$shipping_id,
                             createdate=$create_date,
                             licnum=$lic_no,
                             deffcredit=$deffcredit,
                             jointventure=$jointven,
                             rupcredit=$rucredit,
                             otherex=$others_ex,
                             rbiappcode=$rbiapp,
                             rbiappdate=$rbiappdate,
                             outrightsale=$outrightsale,
                             consignmentexp=$conexp,
                             othersh=$other_sh,
                             ar4anum=$ar4anum,
                             ar4adate=$ar4adate,
                             total_qty=$qty_total,
                             vfobtotal=$vfob_total
        	WHERE
                    recnum = $recnum";
 //echo $sql;
        $result = mysql_query($sql);

        if(!$result)
                     {
                     //header("Location:errorMessage.php?validate=Inv5");
                     die("shipping update failed...Please report to SysAdmin. " . mysql_error());
                     }
        }


    function deleteInvoice($invoicerecnum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "delete from invoice where recnum = $invoicerecnum";
        $result = mysql_query($sql);
        if(!$result)
                     {
                      //header("Location:errorMessage.php?validate=Inv6");
                      die("Delete for Invoice failed...Please report to SysAdmin. " . mysql_error());
                     }
      }


	function getallinvoice()
	{
   $newlogin = new userlogin;
        $newlogin->dbconnect();
         $sql = "select
                            i.recnum,
							i.invnum,
							i.invdate,
							i.duedate,
							i.currency,
					        i.precarriageby,
                            i.precarrierreceipt,
                            i.packages,
                            i.countryoforigin,
                            i.countryoffinaldest,
                            i.vessel,
                            i.portofloading,
                            i.portofdischarge,
							i.finaldest,
							i.total,
							c.name,
							c.baddr1,
							c.bcity,
							c.bcountry,
							c.saddr1,
							c.scity,
							c.scountry,
							i.totaldue,
							i.fob_or_candf,
							i.inv2customer
                     from invoice i,
					          company c
                    where c.recnum = i.inv2customer";

        //echo "\n" . $sql;
        $result = mysql_query($sql);
        return $result;


	}
	function getinvoice4ship($recnum)
	{
   $newlogin = new userlogin;
        $newlogin->dbconnect();
         $sql = "select
                            i.recnum,
							i.invnum,
							i.invdate,
							i.duedate,
							i.currency,
					        i.precarriageby,
                            i.precarrierreceipt,
                            i.packages,
                            i.countryoforigin,
                            i.countryoffinaldest,
                            i.vessel,
                            i.portofloading,
                            i.portofdischarge,
							i.finaldest,
							i.total,
							c.name,
							c.baddr1,
							c.bcity,
							c.bcountry,
							c.saddr1,
							c.scity,
							c.scountry,
							i.totaldue,
							i.fob_or_candf,
							i.inv2customer
                     from invoice i,
					          company c
                    where c.recnum = i.inv2customer and
                    i.recnum=$recnum";

        //echo "\n" . $sql;
        $result = mysql_query($sql);
        return $result;


	}
	
	function getshipping4summary($cond,$argoffset,$arglimit)
	{
	  $newlogin = new userlogin;
      $newlogin->dbconnect();
      $offset = $argoffset;
        $limit = $arglimit;
      $sql = "select s.* from shipping s where $cond order by s.recnum limit $offset,$limit ";

        //echo "\n" . $sql;
        $result = mysql_query($sql);
        return $result;
	}
	
		function getshipping4summarycount($cond,$argoffset,$arglimit)
	{
	  $newlogin = new userlogin;
      $newlogin->dbconnect();
      $offset = $argoffset;
        $limit = $arglimit;
      $sql = "select count(*) as numrows from shipping s where $cond limit $offset,$limit";

       // echo "\n" . $sql;
        $result  = mysql_query($sql) or die('getpackdetails4summary count query failed');
        $row     = mysql_fetch_array($result, MYSQL_ASSOC);
        $numrows = $row['numrows'];
         return $numrows;
	}
	
	
	function getshippinglidetails($recnum)
	{
	 $newlogin = new userlogin;
         $newlogin->dbconnect();
         $sql = "select * from shipping_line_items 
                    where link2shipping=$recnum
                    order by line_num asc";

        //echo "\n" . $sql;
        $result = mysql_query($sql);
        return $result;
	}
	
        function getshippingdetails($recnum)
	{
	  $newlogin = new userlogin;
      $newlogin->dbconnect();
      $sql = "select * from shipping where recnum=$recnum";

        //echo "\n" . $sql;
        $result = mysql_query($sql);
        return $result;
	}
	
	function getinvlidet4shipping($invnum)
	{
	  $newlogin = new userlogin;
      $newlogin->dbconnect();
      $sql = "select concat(il.cimpartnum, ' ',il.descr),il.qty,il.line_amount,i.invnum
             from invoice_line_items il,invoice i
                  where il.link2invoice=i.recnum and
                        i.invnum='$invnum'
                  order by il.line_num desc";

        //echo "\n" . $sql;
        $result = mysql_query($sql);
        return $result;
	
	}
	function getpackingslip()
	{
	   $newlogin = new userlogin;
      $newlogin->dbconnect();
      $sql = "select p.packingnum
             from packing p
             order by recnum desc";

        //echo "\n" . $sql;
        $result = mysql_query($sql);
        return $result;

    }
	function getpackinglidet($ponum)
	{
   $newlogin = new userlogin;
      $newlogin->dbconnect();
      $sql = "select pli.line_num ,pli.length,pli.width,pli.thickness,p.ponum,p.tot_net_wt,p.gross_wt,p.no_packings
             from packingli pli,packing p
                  where pli.link2packing=p.recnum and
                        p.packingnum='$ponum'
              ";

       //echo "\n" . $sql;
        $result = mysql_query($sql);
        return $result;

	}
	
	/*	function getinvlidet4shipping($invnum)
	{
	  $newlogin = new userlogin;
      $newlogin->dbconnect();
      $sql = "select il.cimpartnum,il.qty,il.line_amount,i.invnum
             from invoice_line_items il,invoice i
                  where il.link2invoice=i.recnum and
                        i.invnum='$invnum'";

        //echo "\n" . $sql;
        $result = mysql_query($sql);
        return $result;

	} */

function convert_number($number) 
{ 
	//echo "<br>Number is $number";
    if (($number < 0) || ($number > 999999999)) 
    { 
    throw new Exception("Number is out of range");
    } 
 
    $Gn = floor($number / 100000);  /* Lakhs (giga) */ 
    $number -= $Gn * 100000; 
    $kn = floor($number / 1000);     /* Thousands (kilo) */ 
    $number -= $kn * 1000; 
    $Hn = floor($number / 100);      /* Hundreds (hecto) */ 
    $number -= $Hn * 100; 
    $Dn = floor($number / 10);       /* Tens (deca) */ 
    $n = $number % 10;               /* Ones */ 

    $res = ""; 

    if ($Gn) 
    { 
        $res .= $this->convert_number($Gn) . " Lakhs"; 
    } 

    if ($kn) 
    { 
        $res .= (empty($res) ? "" : " ") . 
            $this->convert_number($kn) . " Thousand"; 
    } 

    if ($Hn) 
    { 
        $res .= (empty($res) ? "" : " ") . 
            $this->convert_number($Hn) . " Hundred"; 
    } 

    $ones = array("", "One", "Two", "Three", "Four", "Five", "Six", 
        "Seven", "Eight", "Nine", "Ten", "Eleven", "Twelve", "Thirteen", 
        "Fourteen", "Fifteen", "Sixteen", "Seventeen", "Eightteen", 
        "Nineteen"); 
    $tens = array("", "", "Twenty", "Thirty", "Fourty", "Fifty", "Sixty", 
        "Seventy", "Eigthy", "Ninety"); 

    if ($Dn || $n) 
    { 
        if (!empty($res)) 
        { 
            $res .= " and "; 
        } 

        if ($Dn < 2) 
        { 
            $res .= $ones[$Dn * 10 + $n]; 
        } 
        else 
        { 
            $res .= $tens[$Dn]; 

            if ($n) 
            { 
                $res .= "-" . $ones[$n]; 
            } 
        } 
    } 

    if (empty($res)) 
    { 
        $res = "zero"; 
    } 

    return $res; 
} 
function num2words( $num ){
    $ZERO = "zero";
    $MINUS = "minus";
    $lowName = array(
          /* zero is shown as "" since it is never used in combined forms */
          /* 0 .. 19 */
          "", "one", "two", "three", "four", "five",
          "six", "seven", "eight", "nine", "ten",
          "eleven", "twelve", "thirteen", "fourteen", "fifteen",
          "sixteen", "seventeen", "eighteen", "nineteen");

    $tys = array(
          /* 0, 10, 20, 30 ... 90 */
          "", "", "twenty", "thirty", "forty", "fifty",
          "sixty", "seventy", "eighty", "ninety");

    $groupName = array(
          /* We only need up to a quintillion, since a long is about 9 * 10 ^ 18 */
          /* American: unit, hundred, thousand, million, billion, trillion, quadrillion, quintillion */
          "", "hundred", "thousand", "million", "billion",
          "trillion", "quadrillion", "quintillion");

    $divisor = array(
          /* How many of this group is needed to form one of the succeeding group. */
          /* American: unit, hundred, thousand, million, billion, trillion, quadrillion, quintillion */
          100, 10, 1000, 1000, 1000, 1000, 1000, 1000) ;

    $num = str_replace(",","",$num);
    $num = number_format($num,2,'.','');
    $cents = substr($num,strlen($num)-2,strlen($num)-1);
    $num = (int)$num;

    $s = "";

    if ( $num == 0 ) $s = $ZERO;
    $negative = ($num < 0 );
    if ( $negative ) $num = -$num;

    // Work least significant digit to most, right to left.
    // until high order part is all 0s.
    for ( $i=0; $num>0; $i++ ) {
        $remdr = (int)($num % $divisor[$i]);
        $num = $num / $divisor[$i];
        // check for 1100 .. 1999, 2100..2999, ... 5200..5999
        // but not 1000..1099,  2000..2099, ...
        // Special case written as fifty-nine hundred.
        // e.g. thousands digit is 1..5 and hundreds digit is 1..9
        // Only when no further higher order.
        if ( $i == 1 /* doing hundreds */ && 1 <= $num && $num <= 5 ){
            if ( $remdr > 0 ){
                $remdr += $num * 10;
                $num = 0;
            } // end if
        } // end if
        if ( $remdr == 0 ){
            continue;
        }
        $t = "";
        if ( $remdr < 20 ){
            $t = $lowName[$remdr];
        }
        else if ( $remdr < 100 ){
            $units = (int)$remdr % 10;
            $tens = (int)$remdr / 10;
            $t = $tys [$tens];
            if ( $units != 0 ){
               $t .= "-" . $lowName[$units];
            }
        }else {
            $t = $inWords($remdr);
        }
        $s = $t . " " . $groupName[$i] . " "  . $s;
        $num = (int)$num;
    } // end for
    $s = trim($s);
    if ( $negative ){
        $s = $MINUS . " " . $s;
    }

    //$s .= " and Paise $cents";
    $s .= "";


    return $s;
} // end inWords

} // End invoice class definition
?>
