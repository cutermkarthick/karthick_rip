<?
//===============================================
// Author: FSI                                  =
// Date-written = Dec 07 , 2006                 =
// Filename: invoiceliClass.php                 =
// Maintains the class for Invoice Line items   =
// Revision: v1.0                               =
//===============================================

include_once('loginClass.php');

class custinvoiceli {

    var
     $line_num,
     $item_id,
     $item_desc,
     $qty,
     $um,
     $disc_perc,
     $rate,
     $amount,
     $link2invoice,
     $type,
     $po_qty,
     $packaging,$polinenum;

    // Constructor definition
    function custinvoiceli() {
        $this->line_num = '';
        $this->crn = '';
        $this->item_desc = '';
		 $this->partnum = '';
        $this->rawmtl = '';
        $this->tariffsch = '';
        $this->packaging = '';
        $this->ponum = '';
        $this->qty = '';
        $this->rate = '';
        $this->amount = '';
        $this->link2invoice = '';
		$this->cofc = '';
		$this->type = '';
		$this->po_qty = '';
		$this->packaging = '';
		$this->polinenum = '';
		$this->schpo = '';

     }
    function getline_num() {
           return $this->line_num;
    }
    function setline_num ($line_num) {
           $this->line_num = $line_num;
    }
    function getponum() {
           return $this->ponum;
    }
    function setponum ($ponum) {
           $this->ponum = $ponum;
    }

	function getrawmtl() {
           return $this->rawmtl;
    }
    function setrawmtl ($rawmtl) {
           $this->rawmtl = $rawmtl;
    }

    function getcrn() {
           return $this->crn;
    }
    function setcrn ($crn) {
           $this->crn = $crn;
    }

    function getpartnum() {
           return $this->partnum;
    }
    function setpartnum ($partnum) {
           $this->partnum = $partnum;
    }

    function getqty() {
           return $this->qty;
    }
    function setqty ($qty) {
           $this->qty = $qty;
    }
    function getdescr() {
           return $this->descr;
    }
    function setdescr ($descr) {
           $this->descr = $descr;
    }

    function getcofc() {
           return $this->cofc;
    }
    function setcofc ($cofc) {
           $this->cofc = $cofc;
    }
    function gettariffsch() {
           return $this->tariffsch;
    }
    function settariffsch ($tariffsch) {
           $this->tariffsch = $tariffsch;
    }

    function getpackaging() {
           return $this->packaging;
    }
    function setpackaging($packaging) {
           $this->packaging = $packaging;
    }
    function getnoofpackages() {
           return $this->noofpackages;
    }
    function setnoofpackages($noofpackages) {
           $this->noofpackages = $noofpackages;
    }
    function getrate() {
           return $this->rate;
    }
    function setrate ($rate) {
           $this->rate = $rate;
    }

    function getamount() {
           return $this->amount;
    }
    function setamount ($amount) {
           $this->amount = $amount;
    }

    function getlink2invoice() {
           return $this->link2invoice;
    }

    function setlink2invoice ($link2invoice) {
           $this->link2invoice = $link2invoice;
    }
    function settype ($type) {
           $this->type = $type;
    }
    function setpo_qty ($po_qty) {
           $this->po_qty = $po_qty;
    }
    
    function setpolinenum ($polinenum) {
           $this->polinenum = $polinenum;
    }
    function setschpo ($schpo) {
           $this->schpo = $schpo;
    }


    function addInvoiceli() {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "start transaction";
        $result = mysql_query($sql);
        $sql = "select nxtnum from seqnum where tablename = 'cust_invoice_line_items' for update";
        $result = mysql_query($sql);
        if(!$result) {
           $sql = "rollback";
           $result = mysql_query($sql);
           die("Seqnum access failed for LI..Please report to Sysadmin. " . mysql_error());
        }
        $myrow = mysql_fetch_row($result);
        $seqnum = $myrow[0];
        $objid = $seqnum + 1;
        $line_num = $this->line_num;
        $item_desc =$this->descr;
        $qty = $this->qty;
        $rate = $this->rate;
		$partnum = $this->partnum;
        $amount = $this->amount;
        $link2invoice = $this->link2invoice;
	    $crn = $this->crn;
		$itemdesc = $this->itemdesc;
		$noofpackages = $this->noofpackages;;
		$packaging = $this->packaging;
		$rawmtl = $this->rawmtl;
		$tariffsch = $this->tariffsch;
		$cofc = $this->cofc;
	    $ponum = $this->ponum;
	    $type = $this->type;
	    $po_qty = $this->po_qty?$this->po_qty:0;
        $polinenum=$this->polinenum?$this->polinenum:0;
        $schpo=$this->schpo;

        $sql = "INSERT INTO cust_invoice_line_items (
		                        recnum,
								line_num,
								custpo_num,
								cofc_num,
								crnnum,
								cimpartnum,
								descr,
                                qty,
							    packaging,
								rawmtl,
							    tariff_schedule,
							    price,
							    line_amount,
							    create_date,
							   link2invoice,
                               type,
                               po_qty,
							   polinenum,
							   schpo)
                            VALUES (
							   $objid,
							   $line_num,
							   '$ponum',
							   '$cofc',
							   '$crn',
							   '$partnum',
							   '$item_desc',
                               $qty,
							   '$packaging',
							   '$rawmtl',
							   '$tariffsch',
							   $rate,
                               $amount,
							   now(),
							   $link2invoice,
                               '$type',
                               0,
							   $polinenum,
							   '$schpo')";
        //echo $sql;
        $result = mysql_query($sql);
        // Test to make sure query worked
        if(!$result) {
           $sql = "rollback";
           $result = mysql_query($sql);
           die("Insert to LI didn't work..Please report to Sysadmin. " . mysql_error());
        }
         $sql = "update seqnum set nxtnum = $objid where tablename = 'cust_invoice_line_items'";
   // echo "$sql";
        $result = mysql_query($sql);
        // Test to make sure query worked
        if(!$result) {
           $sql = "rollback";
           $result = mysql_query($sql);
           die("Seqnum insert query didn't work for invoice line items..Please report to Sysadmin. " . mysql_error());
        }
     }

    function updateInvoiceli($recnum) {
        $lirecnum = $recnum;
        $line_num = $this->line_num;
        $item_desc =$this->descr;
        $qty = $this->qty;
        $rate = $this->rate;
		$partnum = $this->partnum;
        $amount = $this->amount;
        $link2invoice = $this->link2invoice;
	    $crn = $this->crn;
		$itemdesc = $this->itemdesc;
		$noofpackages = $this->noofpackages;
		$packaging = $this->packaging;
		$rawmtl = $this->rawmtl;
		$tariffsch = $this->tariffsch;
		$cofc = $this->cofc;
	    $ponum = $this->ponum;
	    $type = $this->type;
	    $po_qty = $this->po_qty?$this->po_qty:0;
	    $polinenum=$this->polinenum?$this->polinenum:0;
        $schpo=$this->schpo;

        $sql = "update cust_invoice_line_items
                          set
								line_num=$line_num,
								custpo_num='$ponum',
								cofc_num='$cofc',
								crnnum='$crn',
								cimpartnum='$partnum',
								descr='$item_desc',
                                qty=$qty,
							    packaging='$packaging',
								rawmtl='$rawmtl',
							    tariff_schedule='$tariffsch',
							    price=$rate,
							    line_amount=$amount,
							    link2invoice=$link2invoice,
                                type='$type',
                                po_qty=$po_qty,
                                packaging='$packaging',
                                polinenum=$polinenum,
								schpo = '$schpo'
                        where recnum = $recnum";
         //echo "$sql";
           $result = mysql_query($sql);
           // Test to make sure query worked
           if(!$result) die("Update to invoiceLi  didn't work..Please report to Sysadmin. " . mysql_error());

     }
     function getInvoiceli($invoicerecnum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select
		                      l.line_num,
							  l.custpo_num,
							  l.cofc_num,
                              l.crnnum,
							  l.rawmtl,
							  l.cimpartnum,
							  l.packaging,
							  l.noofpackages,
							  l.descr,
							  l.tariff_schedule,
                              l.qty,
							  l.price,
							  l.line_amount,
							  l.create_date,
							  l.type,
							  l.recnum ,
							  l.po_qty,
							  l.packaging ,
							  l.polinenum,
							  l.schpo
                   from cust_invoice_line_items l
                   where l.link2invoice = $invoicerecnum
				   order by  l.crnnum,l.line_num";
        //echo $sql;
        $result = mysql_query($sql);
        return $result;
     }

    function deleteInvoiceli($inprecnum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
         $recnum =$inprecnum;
        $sql = "delete from cust_invoice_line_items where recnum = $recnum";
        // echo "$sql";
        $result = mysql_query($sql);
        if(!$result) die("Delete for Line Items failed...Please report to SysAdmin. " . mysql_error());
      }

      function check_cofc($cofc)
      {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $recnum =$inprecnum;
        $sql = "select link2invoice from invoice_line_items where cofc_num='$cofc'";  
        $result = mysql_query($sql);
        return $result;
      }

 }// End invoice line items class definition
