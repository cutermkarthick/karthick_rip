<?
//====================================
// Author: FSI
// Date-written = Dec 07, 2006
// Filename: invoiceClass.php
// Maintains the class for invoice
// Revision: v1.0  OWT
//====================================

include_once('loginClass.php');

class invoice {
    var
    $recnum,
    $invnum,
    $invdate,
    $duedate,
    $invdesc,
    $terms,
    $subtotal,
    $shipping,
    $salestax,
    $total,
    $status,
    $precarriageby,
	  $precarrierreceipt,
	  $countryoforigin,
	  $countryoffinaldest,
	  $vessel,
	  $portofloading,
	  $portofdischarge,
  	$packages,
    $inv2customer,
    $inv2shipping,
    $inv2invli,
    $link2invoice,
    $payment_date,
    $totaldue,
  	$currency,
	  $fobcf,
    $payment_amount,
    $numpkgs,
    $dcnum,
    $dcdate,$remarks,$advance_info,$advance_amount,
	  $excise, 
   	$vat,
	  $excsubtotal,
	  $vatsubtotal	,
    $st,
    $stsubtotal ,
    $cess1,
    $cess2;	
    // Constructor definition
    function invoice() 
    {
        $this->recnum = '';
        $this->invnum = '';
        $this->invdate = '';
        $this->duedate = '';
        $this->invdesc = '';
        $this->terms = '';
        $this->subtotal = '';
        $this->shipping = '';
        $this->salestax = '';
        $this->total = '';
        $this->totaldue = '';
        $this->status = '';
        $this->inv2customer= '';
        $this->inv2shipping= '';
        $this->inv2invli= '';
        $this->customerponum= '';
        $this->link2invoice= '';
        $this->payment_amount= '';
        $this->payment_date= '';
        $this->ref_num= '';
	      $this->precarriageby= '';
		    $this->precarrierreceipt= '';
		    $this->countryoforigin= '';
		    $this->countryoffinaldest= '';
		    $this->vessel= '';
		    $thise->portofloading= '';
		    $this->portofdischarge= '';
		    $this->packages= '';
		    $thise->status= '';
       	$this->currency= '';
        $this->fobcf= '';
        $this->numpkgs= '';
        $this->dcnum= '';
        $this->dcdate= '';
        $this->remarks= '';
	      $this->advance_info='';
	      $this->advance_amount='';
		    $this->excise='';
		    $this->vat='';
		    $this->excsubtotal='';
		    $this->vatsubtotal='';		   
        $this->stsubtotal='';
        $this->st='';
        $this->cess1='';
        $this->cess2='';
    }



    function getrecnum() {
           return $this->getrecnum;
    }
    function setrecnum ($req_recnum) {
           $this->recnum = $req_recnum;
    }

    function getinvnum() {
           return $this->invnum;
    }
    function setinvnum ($req_invnum) {
           $this->invnum = $req_invnum;
    }

    function getinvdate() {
           return $this->invdate;
    }
    function setinvdate ($req_invdate) {
           $this->invdate = $req_invdate;
    }

    function getduedate() {
           return $this->duedate;
    }
    function setduedate ($req_duedate) {
           $this->duedate = $req_duedate;
    }

    function getinvdesc() {
           return $this->invdesc;
    }
    function setinvdesc($req_invdesc) {
           $this->invdesc = $req_invdesc;
    }

    function getterms() {
           return $this->terms;
    }
    function setterms ($req_terms) {
           $this->terms = $req_terms;
    }

    function getsubtotal() {
           return $this->subtotal;
    }
    function setsubtotal ($req_subtotal) {
           $this->subtotal = $req_subtotal;
    }

    function getshipping() {
           return $this->shipping;
    }
    function setshipping ($req_shipping) {
           $this->shipping = $req_shipping;
    }

    function getsalestax() {
           return $this->salestax;
    }
    function setsalestax ($req_salestax) {
           $this->salestax= $req_salestax;
    }

    function gettotal() {
           return $this->total;
    }
    function settotal($req_total) {
           $this->total= $req_total;
    }

    function gettotaldur() {
           return $this->totaldue;
    }
    function settotaldue($req_totaldue) {
           $this->totaldue= $req_totaldue;
    }

    function getstatus() {
           return $this->status;
    }
    function setstatus ($req_status) {
           $this->status = $req_status;
    }

    function getinv2customer() {
           return $this->inv2customer;
    }
    function setinv2customer ($req_inv2customer) {
           $this->inv2customer = $req_inv2customer;
    }

    function getinv2shipping() {
           return $this->inv2shipping;
    }
    function setinv2shipping($req_inv2shipping) {
           $this->inv2shipping = $req_inv2shipping;
    }

    function getinv2invli() {
           return $this->inv2invli;
    }
    function setinv2invli ($req_inv2invli) {
           $this->inv2invli = $req_inv2invli;
    }

    function getcustomerponum() {
           return $this->customerponum;
    }
    function setcustomerponum ($req_customerponum) {
           $this->customerponum = $req_customerponum;
    }

    function getpayment_amount() {
           return $this->payment_amount;
    }
    function setpayment_amount($req_payment_amount) {
           $this->payment_amount = $req_payment_amount;
    }

    function getlink2invoice() {
           return $this->link2invoice;
    }
    function setlink2invoice($req_link2invoice) {
           $this->link2invoice = $req_link2invoice;
    }

    function getpayment_date() {
           return $this->payment_date;
    }
    function setpayment_date($req_payment_date) {
           $this->payment_date = $req_payment_date;
    }

    function getref_num() {
           return $this->ref_num;
    }
    function setref_num($req_ref_num) {
           $this->ref_num = $req_ref_num;
    }
    function setprecarriageby($req_precarriageby) {
           $this->precarriageby = $req_precarriageby;
    }

   function setprecarrierreceipt($req_precarrierreceipt) {
           $this->precarrierreceipt = $req_precarrierreceipt;
    }
   function setcountryoforigin($req_countryoforigin) {
           $this->countryoforigin = $req_countryoforigin;
    }
   function setcountryoffinaldest($req_countryoffinaldest) {
           $this->countryoffinaldest = $req_countryoffinaldest;
    }
   function setvessel($req_vessel) {
           $this->vessel = $req_vessel;
    }
   function setportofloading($req_portofloading) {
           $this->portofloading = $req_portofloading;
    }
   function setportofdischarge($req_portofdischarge) {
           $this->portofdischarge = $req_portofdischarge;
    }
   function setpackages($req_packages) {
           $this->packages = $req_packages;
    }
   function setcurrency($req_currency) {
           $this->currency = $req_currency;
    }
   function setfobcf($req_fobcf) {
           $this->fobcf = $req_fobcf;
    }

    function setnumpkgs($numpkgs) {
           $this->numpkgs = $numpkgs;
    }
     function setdcnum($dcnum) {
           $this->dcnum = $dcnum;
    }
     function setdcdate($dcdate) {
           $this->dcdate = $dcdate;
    }
    function setremarks($remarks) {
           $this->remarks = $remarks;
    }

	   function getadvance_info() {
           return $this->advance_info;
    }
    function setadvance_info($advance_info) {
           $this->advance_info = $advance_info;
    }

	   function getadvance_amount() {
           return $this->advance_amount;
    }
    function setadvance_amount ($advance_amount) {
           $this->advance_amount = $advance_amount;
    }
    
	function getexcise() {
           return $this->excise;
    }
    function setexcise($excise) {
           $this->excise = $excise;
    }
	
	function getvat() {
         return $this->vat;
    }
    function setvat($vat) {
           $this->vat= $vat;
    }
	
	function getexcsubtotal() {
         return $this->excsubtotal;
    }
    function setexcsubtotal($excsubtotal) {
           $this->excsubtotal= $excsubtotal;
    }

	function getvatsubtotal() {
         return $this->vatsubtotal;
    }
    function setvatsubtotal($vatsubtotal) {
           $this->vatsubtotal= $vatsubtotal;
    }	
	 function getservice_tax() {
         return $this->st;
    }
    function setservice_tax($st) {
           $this->st= $st;
    } 
      function getstsubtotal() {
         return $this->stsubtotal;
    }
    function setstsubtotal($stsubtotal) {
           $this->stsubtotal= $stsubtotal;
    }
     function getcess1() {
         return $this->cess1;
    }
    function setcess1($cess1) {
           $this->cess1=$cess1;
    } 
     function getcess2() {
         return $this->cess2;
    }
    function setcess2($cess2) {
           $this->cess2= $cess2;
    } 
	
    function addInvoice() {
       //echo "I am here";
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "start transaction";
        $result = mysql_query($sql);
        $sql = "select nxtnum from seqnum where tablename = 'invoice' for update";
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
        $prefix = "";
		    $strrecnum=sprintf("%05d",$objid);
        $invnum=$prefix.$strrecnum;
        //$invnum = "'" . $this->invnum . "'";
        $invdate = "'" . $this->invdate . "'";
        $duedate = $this->duedate?"'" . $this->duedate . "'":'0000-00-00';
        $invdesc= "'" . $this->invdesc . "'";
        $terms = "'" . $this->terms. "'";
	      $precarriageby = "'" . $this->precarriageby. "'";
        $precarrierreceipt = "'" . $this->precarrierreceipt. "'";
        $packages =$this->packages?$this->packages:0;
        $countryoforigin = "'" . $this->countryoforigin. "'";
        $countryoffinaldest = "'" . $this->countryoffinaldest. "'";
        $vessel = "'" . $this->vessel. "'";
        $portofloading = "'" . $this->portofloading. "'";
        $portofdischarge = "'" . $this->portofdischarge. "'";
        $subtotal = "'" . $this->subtotal . "'";
        $salestax = "'" . $this->salestax . "'";
        $username = "'" . $_SESSION["user"] . "'";
        $total = "'" . $this->total . "'";
        $totaldue = "'" . $this->totaldue . "'";
        $status = "'" . $this->status . "'";
        $inv2customer="'" . $this->inv2customer . "'";
        $inv2shipping="'" . $this->inv2shipping . "'";
        $inv2invli = "'" . $this->inv2invli . "'";
        $customerponum = "'" . $this->customerponum . "'";
        $currency = "'" . $this->currency . "'";
        $fobcf = "'" . $this->fobcf . "'";
        $numpkgs = "'" . $this->numpkgs . "'";
        $dcnum = "'" . $this->dcnum . "'";
        $dcdate = $this->dcdate?"'" . $this->dcdate . "'":'0000-00-00';
        $remarks = "'" . $this->remarks . "'";
        $sql = "select * from invoice where recnum = $objid";
       // echo $sql;
        $result = mysql_query($sql);
        if (!(mysql_fetch_row($result))) {
		   //$invnum = sprintf("%05d",$objid);
           $sql = "INSERT INTO
                        invoice
                            (
                            recnum,
							invnum,
							invdate,
							duedate,
							invdesc,
							custpo_num,
							terms,
					        precarriageby,
                            precarrierreceipt,
                            packages,
                            countryoforigin,
                            countryoffinaldest,
                            vessel,
                            portofloading,
                            portofdischarge,
							subtotal,
							total,
							totaldue,
							status,
							currency,
							fob_or_candf,
							inv2customer,
							inv2shipping,
							formrev,
							dcnum,
							dcdate,
							remarks							
                            )
                    VALUES
                            (
                            $objid,
							'$invnum',
							$invdate,
							$duedate,
							$invdesc,
							$customerponum,
							$terms,
					        $precarriageby,
                            $precarrierreceipt,
                            $numpkgs,
                            $countryoforigin,
                            $countryoffinaldest,
                            $vessel,
                            $portofloading,
                            $portofdischarge,
							$subtotal,
							$total,
							$total,
							$status,
							$currency,
							$fobcf,
							$inv2customer,
							$inv2shipping,
							'F9015 Rev 00 dt August 15, 2011;',
							$dcnum,
							$dcdate ,$remarks
                            )";
          // echo "\n" . $sql;
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

        $sql = "update seqnum set nxtnum = $objid where tablename = 'invoice'";
        $result = mysql_query($sql);
        // Test to make sure query worked
        if(!$result)
                     {
                     //header("Location:errorMessage.php?validate=Inv4");
                     die("Seqnum insert query didn't work..Please report to Sysadmin. " . mysql_error());
                     }
        return $objid;
     }


     function customeraddress($invoicerecnum) {
       $newlogin = new userlogin;
       $newlogin->dbconnect();
       $sql = "select c.name, c.id,
               c.baddr1, c.baddr2, c.bcity, c.bstate,c.bzipcode,c.bcountry,
               c1.name as sname,c1.saddr1, c1.saddr2, c1.scity, c1.sstate, c1.szipcode,
               c1.scountry , i.recnum , i.inv2customer,c.remarks
               FROM invoice i, company c, company c1
            where c.recnum = i.inv2customer and
			             c1.recnum = i.inv2shipping
            and   i.recnum = $invoicerecnum";

       //echo "$sql";
       $result = mysql_query($sql);
       if(!$result) die("Failed to get customer address...Please report to SysAdmin. " . mysql_error());
       return $result;
     }

     function getinvoices($cond,$argoffset,$arglimit) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $offset = $argoffset;
        $limit = $arglimit;
         $sql = "select distinct il.link2invoice,i.*,c.name
                         from invoice i,
						          company c ,invoice_line_items il
                         where c.recnum = i.inv2customer  and
                         il.link2invoice=i.recnum and
                               $cond
                               order by i.recnum
                               limit $offset,$limit
                               ";

        //echo "\n" . $sql;
        $result = mysql_query($sql);
        return $result;

     }
     function getinvoicescount($cond,$argoffset,$arglimit) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $offset = $argoffset;
        $limit = $arglimit;
         $sql = "select distinct il.link2invoice,i.*,c.name
                         from invoice i,
						          company c ,invoice_line_items il
                         where c.recnum = i.inv2customer  and
                         il.link2invoice=i.recnum and
                               $cond
                               order by i.recnum
                               ";

        // echo "\n" . $sql;
        $result  = mysql_query($sql) or die('invoice count query failed');
       // $row     = mysql_fetch_array($result, MYSQL_ASSOC);
        //$numrows = $row['numrows'];
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
                            c.baddr2,
							c.bcity,
                            c.bstate,
							c.bcountry,
							c1.name as sname,
							c1.saddr1,
                            c1.saddr2,
							c1.scity,
                            c1.sstate,
							c1.scountry,
							i.totaldue,
							i.fob_or_candf,
							i.inv2customer,
							i.inv2shipping,
							i.formrev ,
							i.dcnum,
							i.dcdate,i.remarks,
							i.advance_info,
							i.advance_amount,
							i.excise,
							i.vat,
							i.excsubtotal,
							i.vatsubtotal,
              i.service_tax,
              i.stsubtotal,
              i.cess1,
              i.cess2
                     from invoice i, 
					          company c,
							  company c1
                    where c.recnum = i.inv2customer and
					             c1.recnum = i.inv2shipping and
                                i.recnum = $invoicerecnum";

        // echo $sql;
        $result = mysql_query($sql);
        return $result;
     }

     function updateInvoice($invoicerecnum) {
        //$invnum = "'" . $this->invnum . "'";
        $invdate = "'" . $this->invdate . "'";
        $duedate = $this->duedate?"'" . $this->duedate . "'":'0000-00-00';
        $invdesc= "'" . $this->invdesc . "'";
        $terms = "'" . $this->terms. "'";
	    $precarriageby = "'" . $this->precarriageby. "'";
        $precarrierreceipt = "'" . $this->precarrierreceipt. "'";
        $packages =$this->packages?$this->packages:0;
        $countryoforigin = "'" . $this->countryoforigin. "'";
        $countryoffinaldest = "'" . $this->countryoffinaldest. "'";
        $vessel = "'" . $this->vessel. "'";
        $portofloading = "'" . $this->portofloading. "'";
        $portofdischarge = "'" . $this->portofdischarge. "'";
        $subtotal = "'" . $this->subtotal . "'";
        $salestax = "'" . $this->salestax . "'";
        $username = "'" . $_SESSION["user"] . "'";
        $total = "'" . $this->total . "'";
        $totaldue = "'" . $this->totaldue . "'";
        $status = "'" . $this->status . "'";
        $inv2customer="'" . $this->inv2customer . "'";
		$inv2shipping="'" . $this->inv2shipping . "'";
        $inv2invli =  $this->inv2invli?$this->inv2invli:0;
        $customerponum = "'" . $this->customerponum . "'";
        $currency = "'" . $this->currency . "'";
        $fobcf = "'" . $this->fobcf . "'";
        $shipping = "'" . $this->shipping . "'";
        $numpkgs = "'" . $this->numpkgs . "'";
         $dcnum = "'" . $this->dcnum . "'";
         $dcdate = $this->dcdate?"'" . $this->dcdate . "'":'0000-00-00';
         $remarks = "'" . $this->remarks . "'";

		 $advance_info = "'" . $this->advance_info . "'";
		 $advance_amount = "'" . $this->advance_amount . "'";

				
		$excise = "'" . $this->excise . "'";
		$vat = "'" . $this->vat . "'";		
		$excsubtotal = "'" . $this->excsubtotal. "'";
		$vatsubtotal = "'" . $this->vatsubtotal . "'";	
        $st = "'" . $this->st . "'";   
    $stsubtotal = "'" . $this->stsubtotal . "'";
        $cess1 = "'" . $this->cess1 . "'";   
    $cess2 = "'" . $this->cess2 . "'";	 

       $sql = "UPDATE invoice SET
                    invdate = $invdate,
                    duedate = $duedate,
            	    invdesc = $invdesc,
            	    terms =$terms ,
            	    subtotal=$subtotal,
            	     shipping=$shipping,
                     salestax = $salestax ,
					          vessel = $vessel,
                    total = $total,
                    totaldue = $totaldue,
                    status= $status ,
                    inv2customer=$inv2customer,
					          inv2shipping=$inv2shipping,
                    inv2invli=$inv2invli,
                    custpo_num=$customerponum,
                    currency=$currency,
                    fob_or_candf=$fobcf,
                    packages=$numpkgs,
                    precarriageby=$precarriageby,
                    portofdischarge=$portofdischarge,
                    countryoforigin=$countryoforigin,
                    countryoffinaldest=$countryoffinaldest,
                    portofloading=$portofloading ,
                    dcnum=$dcnum,
                    dcdate=$dcdate,
                    remarks=$remarks,
					advance_info=$advance_info,
					advance_amount=$advance_amount,
					excise= $excise,
					vat = $vat,
					excsubtotal = $excsubtotal,
					vatsubtotal = $vatsubtotal,
          service_tax = $st,
          stsubtotal = $stsubtotal,
          cess1 = $cess1,
          cess2 = $cess2						
        	WHERE
                    recnum = $invoicerecnum";
        // echo $sql;
        $result = mysql_query($sql);

        if(!$result)
                     {
                     //header("Location:errorMessage.php?validate=Inv5");
                     die("Invoice update failed...Please report to SysAdmin. " . mysql_error());
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



 function Invoicepayment($totaldue,$payment_amount,$invoicerecnum) {
     $c=$invoicerecnum;
     if($totaldue>$payment_amount)
         $sql = "update invoice set status = 'Partial ' where recnum =$c ";
     else if($totaldue==$payment_amount)
         $sql = "update invoice set status = 'Paid' where recnum =$c ";
     else
         $sql = "update invoice set status = 'Creadit' where recnum =$c ";
           $result = mysql_query($sql);

        $newlogin = new userlogin;
        $newlogin->dbconnect();
        // $sql = "start transaction";
        //$result = mysql_query($sql);
        $sql = "select nxtnum from seqnum where tablename = 'invoice_payment' for update";
        //echo "$sql";
        $result = mysql_query($sql);
        if(!$result) die("Seqnum access failed..Please report to Sysadmin. " . mysql_error());
        $myrow = mysql_fetch_row($result);
        $seqnum = $myrow[0];
        $objid = $seqnum + 1;

        $payment_date = "'" . $this->payment_date . "'";
        //$payment_date = "'" . date("y-m-d") . "'";
        $payment_amount = "'" . $this->payment_amount . "'";
        $inv2customer="'" . $this->inv2customer . "'";
        $link2invoice = "'" . $this->link2invoice . "'";
        $ref_num = "'" . $this->ref_num . "'";

        $sql = "select * from invoice_payment where recnum = $objid";
        //echo $sql;
        $result = mysql_query($sql);

        if (!(mysql_fetch_row($result))) {
           $sql = "INSERT INTO
                        invoice_payment
                            (
                            recnum,payment_amount,payment_date,link2invoice,ref_num
                            )
                    VALUES
                            (
                            $objid,$payment_amount,$payment_date,$link2invoice,$ref_num
                            )";
            $result = mysql_query($sql);
            if(!$result) die("Insert to invoice_payment didn't work..Please report to Sysadmin. " . mysql_error());
            $sql = "update invoice set totaldue = totaldue - $payment_amount where recnum = $c";
            $result = mysql_query($sql);

            // Test to make sure query worked
             if(!$result) die("Insert to invoice for totaldue didn't work..Please report to Sysadmin. " . mysql_error());
             $sql = "update seqnum set nxtnum = $objid where tablename = 'invoice_payment'";
             $result = mysql_query($sql);
             //echo  $sql;
             $result = mysql_query($sql);
             if(!$result) die("Seqnum insert query didn't work..Please report to Sysadmin. " . mysql_error());
          } else {
                 echo "<table border=1><tr><td><font color=#FF0000>";
                 die("Invoice ID " . $objid . " already exists. ");
           }
          return $objid;
     }


    function getInvoicesPayment() {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
         $sql = "select  p.recnum, p.payment_date,p.payment_amount,p.ref_num ,c.name,p.formrev
                from invoice_payment p ,company c
                where c.recnum = p.link2invoice ";


   //echo "\n" . $sql;
        $result = mysql_query($sql);
        return $result;

     }
     
     function getpayment4invoice($recnum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
         $sql = "select  p.recnum, p.payment_date,p.payment_amount,p.ref_num ,c.name,i.invnum,i.invdate,i.total,i.totaldue
                from invoice_payment p ,company c,invoice i
                where c.recnum = i.inv2customer and
                p.link2invoice=i.recnum and i.recnum=$recnum";


   //echo "\n" . $sql;
        $result = mysql_query($sql);
        return $result;

     }
     function getInvoicesPayment4summary($cond,$argoffset,$arglimit) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
         $sql = "select  i.recnum,c.name,i.invnum,
                         i.invdate,i.total,i.awbnum,i.awbdate,i.duedate,i.fircnum,i.fircdate,i.totaldue,
                         i.currency,i.formrev,i.shipdate
                from company c ,invoice i
                where i.inv2customer=c.recnum and 
				       $cond 
					   order by i.recnum
					   limit $argoffset,$arglimit ";


   //echo "\n" . $sql;
        $result = mysql_query($sql);
        return $result;

     }
	 function getInvoicesPayment4summcount($cond,$argoffset,$arglimit) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
         $sql = "select  count(*) as numrows 
                from invoice i
                where $cond";
   //echo "\n" . $sql;
        $result  = mysql_query($sql) or die('invoice count query failed');
        $row     = mysql_fetch_array($result, MYSQL_ASSOC);
        $numrows = $row['numrows'];
		return $numrows;

     }
     function getInvoicesPaymentdetails($recnum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
         $sql = "select  i.recnum,c.name,i.invnum,
                         i.invdate,i.total,i.awbnum,i.awbdate,i.duedate,i.fircnum,i.fircdate,i.totaldue
                from company c ,invoice i
                where
                i.recnum=$recnum and i.inv2customer=c.recnum";


   //echo "\n" . $sql;
        $result = mysql_query($sql);
        return $result;

     }

     function getStatus1($invoicerecnum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select  status from invoice where recnum = $invoicerecnum";
        $result = mysql_query($sql);
        if(!$result) die("Update for invoice failed...Please report to SysAdmin. " . mysql_error());
        return $result;
      }

     function updateInvoicepayment() {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "delete from invoice where recnum = $invoicerecnum";
        $result = mysql_query($sql);
        if(!$result) die("Delete for Invoice failed...Please report to SysAdmin. " . mysql_error());
      }


    function getPaymentDetails($invoicerecnum)
	{
	    $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select
			              payment_date,
						  payment_amount,
						  ref_num
		             from
			             invoice_payment
		             where
                          link2invoice=$invoicerecnum
					  order by payment_date";
		//echo "<br>$sql";
        $result = mysql_query($sql);
        if(!$result) die("Access to invoice payment failed...Please report to SysAdmin. " . mysql_error());
        return $result;
	}
	function updateinvoicedetails($awbnum,$awbdate,$duedate,$fircnum,$fircdate,$recnum,$shipdate)
	{
	    $newlogin = new userlogin;
        $newlogin->dbconnect();
        
        $awbnum = "'" . $awbnum . "'";
        $awbdate = "'" . $awbdate . "'"?"'" . $awbdate . "'":'0000-00-00';
        $duedate = "'" . $duedate . "'"?"'" . $duedate . "'":'0000-00-00';
        $fircnum= "'" . $fircnum . "'";
        $fircdate = "'" . $fircdate. "'"?"'" . $fircdate. "'":'0000-00-00';
        $shipdate = "'" . $shipdate . "'"?"'" . $shipdate . "'":'0000-00-00';
        
        $sql = "update invoice set
			              awbnum=$awbnum,
						  awbdate=$awbdate,
						  fircnum=$fircnum,
						  fircdate=$fircdate,
						  duedate=$duedate,
						  shipdate=$shipdate
		             where
                          recnum=$recnum";
		//echo "<br>$sql";
        $result = mysql_query($sql);
        if(!$result) die("update to invoice failed...Please report to SysAdmin. " . mysql_error());
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
							i.inv2customer,
							i.dcnum,
							i.dcdate,i.remarks,i.terms
                     from invoice i,
					          company c
                    where c.recnum = i.inv2customer";

        //echo "\n" . $sql;
        $result = mysql_query($sql);
        return $result;
	}

		function getallinvoice4shipping($invnum)
	{
        $newlogin = new userlogin;
        $newlogin->dbconnect();
		if ($invnum == '')
        {
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
							i.inv2customer,
							i.dcnum,
							i.dcdate
                     from invoice i,
					          company c
                    where c.recnum = i.inv2customer and
					           i.invnum like '%' and
							   i.recnum not in (select s.link2invoice from shipping s)
					order by i.recnum";
		}
		else {
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
							i.inv2customer,
							i.dcnum,
							i.dcdate
                     from invoice i,
					          company c
                    where c.recnum = i.inv2customer and
					           i.invnum like '$invnum%' 
					order by i.recnum";
		}

        //echo "\n" . $sql;
        $result = mysql_query($sql);
        return $result;


	}

	function getallinvoice4shipper()
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
					           i.invnum like '$invnum%' 
					order by i.recnum";
        //echo "\n" . $sql;
        $result = mysql_query($sql);
        return $result;
	}


	function getallcustpo($companyrecnum,$type,$crn)
	{
	 $newlogin = new userlogin;
         $newlogin->dbconnect();
         $sql="select p.custponum,p.recnum,p.custpodate,pli.qty 
           from custpo p,custpo_line_items pli 
            where p.link2customer=$companyrecnum and 
            pli.type='$type' and
            p.status = 'Open' and
           pli.link2custpo=p.recnum and 
           pli.crnnum='$crn'";
          // echo $sql;exit;
          $result=mysql_query($sql);
          return $result;
	}

	function getallcustpo4pl($companyrecnum)
	{
	 $newlogin = new userlogin;
     $newlogin->dbconnect();
     $sql="select distinct p.custponum from custpo p,custpo_line_items pli where p.link2customer=$companyrecnum 
     and p.status !='Cancelled' and pli.link2custpo=p.recnum";
     //echo $sql;
     $result=mysql_query($sql);
     return $result;
	}

	function getallcustpo4packing($companyrecnum)
	{
	 $newlogin = new userlogin;
     $newlogin->dbconnect();
     $sql="select p.custponum,p.recnum,p.custpodate from custpo p where p.link2customer=$companyrecnum
     and p.status !='Cancelled'";
     //echo $sql;
     $result=mysql_query($sql);
     return $result;
	}


	function updatecompanyremarks($remarks,$companyrecnum,$terms)
	{
	/* $newlogin = new userlogin;
     $newlogin->dbconnect();
     $sql="update company set remarks='$remarks',terms='$terms' where recnum=$companyrecnum";
     //echo $sql;
     $result=mysql_query($sql);
     return $result; */
	}
	
	function getallcustpo4invoice($companyrecnum,$crn_num)
	{
	 $newlogin = new userlogin;
     $newlogin->dbconnect();
     $sql="select p.custponum,p.recnum,p.custpodate,pli.qty
                  from custpo p,custpo_line_items pli
                       where p.link2customer=$companyrecnum
                             and p.status !='Cancelled'
                             and pli.link2custpo = p.recnum
                             and pli.crnnum ='$crn_num'";
     //echo $sql;
     $result=mysql_query($sql);
     return $result;
	}
	
	 function getcustpoqty4invoice($crn_num,$companyrecnum,$po_num,$type)
     {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select sum(li.qty)
               from invoice_line_items li,invoice l
                    where
                         li.crnnum='$crn_num' and
                         l.inv2customer=$companyrecnum and
                         li.link2invoice=l.recnum and
                         li.custpo_num='$po_num' and
                         li.type='$type'
                         group by li.crnnum";
        // echo $sql;exit;
        $result = mysql_query($sql);
        return $result;
     }
     
      function getinvoices4po($custpo) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();

         $sql = "select i.*,c.name,il.crnnum,il.cimpartnum,il.descr,il.type ,il.custpo_num,il.qty
                         from invoice i,invoice_line_items il,
						          company c
                         where c.recnum = i.inv2customer and
                               il.link2invoice=i.recnum and
                               il.custpo_num='$custpo'
                               order by i.recnum";

       // echo "\n" . $sql;
        $result = mysql_query($sql);
        return $result;

     }
     
     function getcustpoqty4invoice1($crn_num,$companyrecnum,$invnum)
     {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select sum(li.qty)
               from invoice_line_items li,invoice l
                    where
                         li.crnnum='$crn_num' and
                         l.inv2customer=$companyrecnum and
                         li.link2invoice=l.recnum and
                         l.invnum='$invnum'
                         group by li.crnnum order by l.recnum";
        //echo $sql;
        $result = mysql_query($sql);
        return $result;
     }
     
     function getdetails4custinv($cust_invnum)
     {
       $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select ci.*,cli.* from cust_invoice ci,cust_invoice_line_items cli where ci.invnum='$cust_invnum' and cli.link2invoice=ci.recnum";
        //echo $sql;
        $result = mysql_query($sql);
        return $result;
     }
	
function getCustinvamt($invnum)
     {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select total as cust_totamt
                from cust_invoice
                     where invnum='$invnum'";
      // echo $sql;exit;
        $result  = mysql_query($sql) or die('invoice count query failed');
        $row     = mysql_fetch_array($result, MYSQL_ASSOC);
        $cust_totamt = $row['cust_totamt'];
        return $cust_totamt;
     }
     function getpodate4invoice($ponum4hal)
     {
       $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select custpodate from custpo where custponum='$ponum4hal'";
        //echo $sql;
        $result = mysql_query($sql);
        return $result;
     }

} // End invoice class definition

