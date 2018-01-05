<?
//====================================
// Author: FSI
// Date-written = July 04, 2007
// Filename: grnClass.php
// Maintains the class for GRN
//====================================
// Modifications History
//
//====================================

include_once('classes/loginClass.php');

class grn {
    var
       $refnum,
       $partnum,
       $partname,
       $raw_mat_type,
       $raw_mat_spec,
       $linenum1,
       $partnum1,
       $partdesc,
       $libatchnum,
       $uom,
       $expdate,
       $dim11,
       $dim21,
       $dim31,
       $qty1,
       $qty4billet,
       $qty_rej,
       $inventory_cnt1,
       $num_of_lengths,
       $num_of_pieces,
       $raw_mat_code,
       $invoice_num,
       $invoice_date,
       $recieved_date,
       $test_report,
       $batch_num,
       $mgp_num,
       $rate,
       $lead_time,
       $lead_unit,
       $link2vendor,
       $grnnum,
       $coc_refnum,
       $rmbycim,
       $rmbycust,
       $cimponum,
       $total_qty,
       $remarks,
       $grntype,
       $grndateQuar,
       $nc_refnum,
       $crn,
       $grnstatus,
       $shipping_date,
	   $quarremarks,
	   $conversion_date,
       $rm_empcode,
	   $rm_date,
	   $grn_empcode,
	   $grn_date,
	   $rm_cost,
	   $rm_currency,
       $rmpoline_num,
       $approved,
       $amend_line_num,
       $layout_ref,
       $amendstatus,
       $altcrn,
       $parentgrnnum,
       $noofpieces,
       $pocrn,
       $approval_remarks,
	   $approval_date,
       $userid_app,$stdrev,
	   $wo_ref,
	   $wotype,
	   $cad_approved,
	   $cad_approved_by,
	   $cad_approval_date,
	   $qtm_req,
	   $qtm_bal,
	   $billetsreq,
	   $qty4billetparent;


    // Constructor definition
    function grn() {
        $this->refnum = '';
        $this->partnum = '';
        $this->partname = '';
        $this->raw_mat_type = '';
        $this->raw_mat_spec = '';
        $this->linenum1 = '';
	    $this->partnum1 = '';
	    $this->partdesc = '';
	    $this->libatchnum = '';
	    $this->uom = '';
	    $this->expdate = '';
        $this->dim11 = '';
        $this->dim21 = '';
        $this->dim31 = '';
        $this->qty1 = '';
        $this->qty4billet = '';
        $this->qty_rej = '';
        $this->inventory_cnt1 = '';
        $this->num_of_lengths = '';
        $this->num_of_pieces = '';
        $this->raw_mat_code = '';
        $this->invoice_num = '';
        $this->invoice_date = '';
        $this->recieved_date = '';
        $this->test_report = '';
        $this->batch_num = '';
        $this->mgp_num = '';
        $this->rate = '';
        $this->lead_time = '';
        $this->lead_unit = '';
        $this->link2vendor = '';
        $this->grnnum = '';
        $this->coc_refnum = '';
        $this->rmbycim = '';
        $this->rmbycust = '';
        $this->cimponum = '';
        $this->total_qty = '';
        $this->remarks = '';
        $this->nc_refnum = '';
        $this->grntype = '';
		$this->grndateQuar = '';
        $this->crn = '';
        $this->grnstatus = '';
        $this->line_no;
	    $this->iss_date;
        $this->iss_qty;
        $this->iss4wo;
        $this->accqty;
        $this->rejqty;
        $this->retqty;
        $this->balance;
        $this->link2grn;
        $this->shipping_date ='';
	    $this->conversion_date ='';
        $this->quarremarks ='';
        $this->rm_empcode;
        $this->rm_date;
        $this->grn_empcode;
        $this->grn_date ='';
	    $this->rm_cost ='';
        $this->rm_currency ='';
        $this->rmpoline_num ='';
        $this->approved ='';
        $this->amend_line_num ='';
        $this->layout_ref ='';
        $this->amendstatus ='';
        $this->altcrn ='';
        $this->parentgrnnum ='';
        $this->noofpieces='';
        $this->pocrn='';
        $this->approval_remarks='';
	    $this->approval_date='';
	    $this->userid_app='';
	    $this->stdrev='';
		$this->wo_ref='';
		$this->wotype='';
		$this->cad_approved='';
		$this->cad_approved_by='';
		$this->cad_approval_date='';
		$this->qtm_req ='';	
		$this->qtm_bal='';
		$this->billetsreq='';
		$this->qty4billetparent='';
     }

      function setstdrev($stdrev)
    {
       $this->stdrev=$stdrev;
    }

    function getrefnum() {
           return $this->refnum;
    }
    function setrefnum ($refnum) {
           $this->refnum = $refnum;
    }

    function getgrnnum() {
           return $this->grnnum;
    }
    function setgrnnum ($grnnum) {
           $this->grnnum = $grnnum;
    }


    function getpartnum() {
           return $this->partnum;
    }
    function setpartnum($partnum) {
           $this->partnum = $partnum;
    }

    function getpartname() {
           return $this->partname;
    }
    function setpartname ($partname) {
           $this->partname = $partname;
    }

    function getraw_mat_type() {
           return $this->raw_mat_type;
    }
    function setraw_mat_type($raw_mat_type) {
           $this->raw_mat_type = $raw_mat_type;
    }

    function getraw_mat_spec() {
           return $this->raw_mat_spec;
    }
    function setraw_mat_spec($raw_mat_spec) {
           $this->raw_mat_spec = $raw_mat_spec;
    }
    function getlinenum1() {
           return $this->linenum1;
    }
    function setlinenum1 ($linenum1) {
           $this->linenum1 = $linenum1;
    }
    function getpartnum1() {
           return $this->partnum1;
    }
    function setpartnum1 ($partnum1) {
           $this->partnum1 = $partnum1;
    }
    function getpartdesc() {
           return $this->partdesc;
    }
    function setpartdesc ($partdesc) {
           $this->partdesc = $partdesc;
    }
    function getlibatchnum() {
           return $this->libatchnum;
    }
    function setlibatchnum ($libatchnum) {
           $this->libatchnum = $libatchnum;
    }
    function getuom() {
           return $this->uom;
    }
    function setuom ($uom) {
           $this->uom = $uom;
    }
    function getexpdate() {
           return $this->expdate;
    }
    function setexpdate ($expdate) {
           $this->expdate = $expdate;
    }
    function getqty1() {
           return $this->qty1;
    }
    function setqty1 ($qty1) {
           $this->qty1 = $qty1;
    }
    function getdim11() {
           return $this->dim11;
    }
    function setdim11 ($dim11) {
           $this->dim11 = $dim11;
    }

    function getdim21() {
           return $this->dim21;
    }
    function setdim21($dim21) {
           $this->dim21 = $dim21;
    }

    function getdim31() {
           return $this->dim31;
    }
    function setdim31 ($dim31) {
           $this->dim31 = $dim31;
    }
    function getqty4billet() {
           return $this->qty4billet;
    }
    function setqty4billet ($qty4billet) {
           $this->qty4billet = $qty4billet;
    }

    function getqty_rej() {
           return $this->qty_rej;
    }
    function setqty_rej ($qty_rej) {
           $this->qty_rej = $qty_rej;
    }

    function getqty_to_make() {
           return $this->qty_to_make;
    }
    function setqty_to_make ($qty_to_make) {
           $this->qty_to_make = $qty_to_make;
    }


    function getinventory_cnt1 () {
           return $this->inventory_cnt1;
    }
    function setinventory_cnt1 ($reqinventory_cnt) {
           $this->inventory_cnt1 = $reqinventory_cnt;
    }

    function getnum_of_lengths() {
           return $this->num_of_lengths;
    }
    function setnum_of_lengths($num_of_lengths) {
           $this->num_of_lengths = $num_of_lengths;
    }

    function getnum_of_pieces() {
           return $this->num_of_pieces;
    }

    function setnum_of_pieces ($num_of_pieces) {
           $this->num_of_pieces = $num_of_pieces;
    }

    function getraw_mat_code() {
           return $this->raw_mat_code;
    }

    function setraw_mat_code($raw_mat_code) {
           $this->raw_mat_code = $raw_mat_code;
    }

    function getinvoice_num() {
           return $this->invoice_num;
    }

    function setinvoice_num ($invoice_num) {
           $this->invoice_num = $invoice_num;
    }

    function getinvoice_date() {
           return $this->invoice_date;
    }

    function setinvoice_date($invoice_date) {
           $this->invoice_date = $invoice_date;
    }

    function getrecieved_date() {
           return $this->recieved_date;
    }

    function setrecieved_date($recieved_date) {
           $this->recieved_date = $recieved_date;
    }


    function gettest_report() {
           return $this->test_report;
    }

    function settest_report ($test_report) {
           $this->test_report = $test_report;
    }

    function getbatch_num() {
           return $this->batch_num;
    }

    function setbatch_num($batch_num) {
           $this->batch_num = $batch_num;
    }

    function getcrn() {
           return $this->crn;
    }

    function setcrn($crn) {
           $this->crn = $crn;
    }
    function getstatus() {
           return $this->grnstatus;
    }

    function setstatus($status) {
           $this->grnstatus = $status;
    }

    function getmgp_num() {
           return $this->mgp_num;
    }

    function setmgp_num($mgp_num) {
           $this->mgp_num = $mgp_num;
    }

    function getrate () {
           return $this->rate;
    }
    function setrate ($reqrate) {
           $this->rate = $reqrate;
    }
    function getlead_time () {
           return $this->lead_time;
    }
    function setlead_time ($reqlead_time) {
           $this->lead_time = $reqlead_time;
    }
    function getlead_unit () {
           return $this->lead_unit;
    }
    function setlead_unit ($reqlead_unit) {
           $this->lead_unit = $reqlead_unit;
    }

    function getinventory_cnt () {
           return $this->inventory_cnt;
    }
    function setinventory_cnt ($reqinventory_cnt) {
           $this->inventory_cnt = $reqinventory_cnt;
    }
    function getlink2vendor () {
           return $this->link2vendor;
    }
    function setlink2vendor ($reqlink2vendor) {
           $this->link2vendor = $reqlink2vendor;
    }

    function getcoc_refnum () {
           return $this->coc_refnum;
    }
    function setcoc_refnum ($coc_refnum) {
           $this->coc_refnum = $coc_refnum;
    }

    function gettotal_qty () {
           return $this->total_qty;
    }
    function settotal_qty ($total_qty) {
           $this->total_qty = $total_qty;
    }
    function getrmbycim () {
           return $this->rmbycim;
    }
    function setrmbycim ($rmbycim) {
           $this->rmbycim = $rmbycim;
    }
    function getrmbycust () {
           return $this->rmbycust;
    }
    function setrmbycust ($rmbycust) {
           $this->rmbycust = $rmbycust;
    }
    function getcimponum () {
           return $this->cimponum;
    }
    function setcimponum ($cimponum) {
           $this->cimponum = $cimponum;
    }

    function getiss_date () {
           return $this->iss_date;
    }
    function setiss_date ($iss_date) {
           $this->iss_date = $iss_date;
    }

    function getiss_qty () {
           return $this->iss_qty;
    }
    function setiss_qty ($iss_qty) {
           $this->iss_qty = $iss_qty;
    }

    function getiss4wo () {
           return $this->iss4wo;
    }
    function setiss4wo ($iss4wo) {
           $this->iss4wo = $iss4wo;
    }

    function getaccqty () {
           return $this->accqty;
    }
    function setaccqty ($accqty) {
           $this->accqty = $accqty;
    }

    function getrejqty () {
           return $this->rejqty;
    }
    function setrejqty ($rejqty) {
           $this->rejqty = $rejqty;
    }

    function getretqty () {
           return $this->retqty;
    }
    function setretqty ($retqty) {
           $this->retqty = $retqty;
    }

    function getbalance () {
           return $this->balance;
    }
    function setbalance ($balance) {
           $this->balance = $balance;
    }

    function getline_no () {
           return $this->line_no;
    }
    function setline_no ($line_no) {
           $this->line_no = $line_no;
    }

    function getlink2grn () {
           return $this->lin2grn;
    }
    function setlink2grn ($recnum) {
           $this->link2grn = $recnum;
    }
    function getremarks() {
           return $this->remarks;
    }
    function setremarks ($remarks) {
           $this->remarks = $remarks;
    }

    function getnc_refnum() {
           return $this->nc_refnum;
    }
    function setnc_refnum ($nc_refnum) {
           $this->nc_refnum = $nc_refnum;
    }
     function getgrntype() {
           return $this->grntype;
    }
	function setgrntype ($grntype) {
           $this->grntype = $grntype;
    }
	function getgrndateQuar() {
           return $this->grndateQuar;
    }
	function setgrndateQuar ($grnDateQuar) {
           $this->grndateQuar = $grnDateQuar;
    }


    function getshipping_date() {
           return $this->shipping_date;
    }

    function setshipping_date($shipping_date) {
           $this->shipping_date = $shipping_date;
    }
    function getconversion_date() {
           return $this->conversion_date;
    }

    function setconversion_date($conversion_date) {
           $this->conversion_date = $conversion_date;
    }
    function getquarremarks() {
           return $this->quarremarks;
    }

    function setquarremarks($quarremarks) {
           $this->quarremarks = $quarremarks;
    }


    function getrm_empcode() {
           return $this->rm_empcode;
    }

    function setrm_empcode($rm_empcode) {
           $this->rm_empcode = $rm_empcode;
    }
    function getrm_date() {
           return $this->rm_date;
    }

    function setrm_date($rm_date) {
           $this->rm_date = $rm_date;
    }
    function getgrn_empcode() {
           return $this->grn_empcode;
    }

    function setgrn_empcode($grn_empcode) {
           $this->grn_empcode = $grn_empcode;
    }
    function getgrn_date() {
           return $this->grn_date;
    }

    function setgrn_date($grn_date) {
           $this->grn_date = $grn_date;
    }
    function getrm_cost() {
           return $this->rm_cost;
    }

    function setrm_cost($rm_cost) {
           $this->rm_cost = $rm_cost;
    }
    function getrm_currency() {
           return $this->rm_currency;
    }

    function setrm_currency($rm_currency) {
           $this->rm_currency = $rm_currency;
    }

     function getrmpoline_num() {
           return $this->rmpoline_num;
    }

    function setrmpoline_num($rmpoline_num) {
           $this->rmpoline_num = $rmpoline_num;
    }

     function getapproved() {
           return $this->approved;
    }

    function setapproved($approved) {
           $this->approved = $approved;
    }

    function setamend_line_num($amend_line_num) {
           $this->amend_line_num = $amend_line_num;
    }
    function setlayout_ref($layout_ref) {
           $this->layout_ref = $layout_ref;
    }

    function setamendstatus($amendstatus) {
           $this->amendstatus = $amendstatus;
    }

     function setaltcrn($altcrn) {
           $this->altcrn = $altcrn;
    }

     function setparentgrnnum($parentgrnnum) {
           $this->parentgrnnum = $parentgrnnum;
    }
     function setnoofpieces($noofpieces) {
           $this->noofpieces = $noofpieces;
    }
     function setpocrn($pocrn) {
           $this->pocrn = $pocrn;
    }
    function setapproval_remarks($approval_remarks)
    {
        $this->approval_remarks = $approval_remarks;
    }
    function setapproval_date($approval_date)
    {
        $this->approval_date = $approval_date;
    }

    function setuserid_app($userid_app)
    {
       $this->userid_app=$userid_app;
    }

	
    function getwo_ref() {
           return $this->wo_ref;
    }
    function setwo_ref($wo_ref) {
           $this->wo_ref = $wo_ref;
    }
    function getwotype() 
	{
           return $this->wotype;
    }
    function setwotype($wotype) 
	{
           $this->wotype = $wotype;
    }	
    function getcad_approved() {
           return $this->cad_approved;
    }
    function setcad_approved ($cad_approved) {
           $this->cad_approved = $cad_approved;
    }	
    function getcad_approved_by() 
	{
           return $this->cad_approved_by;
    }
    function setcad_approved_by ($cad_approved_by)
	{
           $this->cad_approved_by = $cad_approved_by;
    }	
    function getcad_approval_date()
    {
           return $this->cad_approval_date;
    }
    function setcad_approval_date($cad_approval_date)
	{
           $this->cad_approval_date = $cad_approval_date;
    }
	function getqtm_req() 
	{
           return $this->qtm_req;
    }
    function setqtm_req ($qtm_req) 
	{
           $this->qtm_req = $qtm_req;
    }	
	function getqtm_bal() {
           return $this->qtm_bal;
    }
    function setqtm_bal ($qtm_bal) {
           $this->qtm_bal = $qtm_bal;
    }
    function setbilletsreq	 ($billetsreq) {
           $this->billetsreq= $billetsreq;
    }
    function setqty4billetparent ($qty4billetparent) {
		   //echo "<br>qty per billet parent is $qty4billetparent";
           $this->qty4billetparent= $qty4billetparent;
    }
    function addgrn($validatFlag,$qtm4grn) 
	{
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "start transaction";
        $result = mysql_query($sql);
        $sql = "select nxtnum from seqnum where tablename = 'grn' for update";
        $result = mysql_query($sql);
        if(!$result) die("Seqnum access failed..Please report to Sysadmin. " . mysql_error());
        $myrow = mysql_fetch_row($result);
        $seqnum = $myrow[0];
        $objid = $seqnum + 1;
        $refnum = "'" . $this->refnum . "'";
        $partnum = "'" . $this->partnum . "'";
        $partname = "'" . $this->partname . "'";
        $raw_mat_type = "'" . $this->raw_mat_type . "'";
        $raw_mat_spec = "'" . $this->raw_mat_spec . "'";
        $num_of_lengths = "'" . $this->num_of_lengths . "'";
        $num_of_pieces = "'" . $this->num_of_pieces . "'";
        $raw_mat_code = "'" . $this->raw_mat_code . "'";
        $invoice_num = "'" . $this->invoice_num . "'";
        $invoice_date = "'" . $this->invoice_date . "'";
        $recieved_date = "'" . $this->recieved_date . "'";
        $test_report = "'" . $this->test_report . "'";
        $batch_num = "'" . $this->batch_num . "'";
        $mgp_num = "'" . $this->mgp_num . "'";
        $link2vendor = $this->link2vendor;
        $grnnum = "'" . trim($this->grnnum) . "'";
        $coc_refnum = "'" . $this->coc_refnum . "'";
        $rmbycim = "'" . $this->rmbycim . "'";
        $rmbycust = "'" . $this->rmbycust . "'";
        $total_qty = "'" . $this->total_qty . "'";
        $cimponum = "'" . $this->cimponum . "'";
        $remarks = "'" . $this->remarks. "'";
        $nc_refnum = "'" . $this->nc_refnum. "'";
        $grntype = "'" . $this->grntype. "'";
		$grndateQuar =$this->grndateQuar ?"'".$this->grndateQuar."'":'0000-00-00';
        $crn = "'" . $this->crn. "'";
        //$status = "'" . $this->grnstatus. "'";
        //$shipping_date = "'" . $this->shipping_date . "'";
        $shipping_date = $this->shipping_date ? "'" . $this->shipping_date  . "'" : '0000-00-00';
		$quarremarks = "'" . $this->quarremarks . "'";
        $conversion_date = $this->conversion_date ? "'" . $this->conversion_date  . "'" : '0000-00-00';
         //echo $grndateQuar;
        $rm_empcode = "'" . $this->rm_empcode . "'";
        $grn_empcode = "'" . $this->grn_empcode. "'";
        $rm_cost = $this->rm_cost? $this->rm_cost : 0;
        $rm_currency = "'" . $this->rm_currency. "'";
        $rm_date = $this->rm_date ?"'".$this->rm_date."'":'0000-00-00';
        $grn_date =$this->grn_date ?"'".$this->grn_date."'":'0000-00-00';
        $approved = "'" . $this->approved. "'";
        $rmpoline_num = $this->rmpoline_num?$this->rmpoline_num:0;
        $altcrn = "'" . $this->altcrn. "'";
        $parentgrnnum= "'" . $this->parentgrnnum. "'";
        $pocrn = "'" . $this->pocrn. "'";
        $stdrev = "'" . $this->stdrev. "'";

		$wo_ref = "'" . $this->wo_ref. "'";
		$wotype = "'" . $this->wotype. "'";
		$qtm_req = "'" . $this->qtm_req. "'";	
    $siteid = "'" . $_SESSION['siteid']. "'"; 

        $qtm4grn=$qtm4grn?$qtm4grn:0;
       
        if($validatFlag=="1")
         {
           $status = "'Pending'";
         }else
         {
           $status = "'Open'";
         }

        $sql = "select * from grn where grnnum = $grnnum";
        $result = mysql_query($sql);
        if (!(mysql_fetch_row($result)))
        {

           $sql = "INSERT INTO
                        grn
                           (recnum,
                            raw_mat_type,
                            raw_mat_spec,
                            raw_mat_code,
                            invoice_num,
                            invoice_date,
                            recieved_date,
                            test_report,
                            batch_num,
                            mgp_num,
                            link2vendor,
                            grnnum,
                            rmbycim,
                            rmbycust,
                            coc_refnum,
                            cimponum,
                            fmtnum,
                            fmtrev,
                            num_of_pieces,
                            remarks,
                            nc_refnum,
                            grntype,
                            crn,
                            status,
                            shipping_date,
                            conversion_date,
			                quarantine_remarks,
                            grndateQuar,
                            rmpo_empcode,
                            rmpo_date,
                            grn_empcode,
                            grn_date,
                            rm_cost,
                            rm_currency ,
                            approved,
                            rmpolinenum,
                            altcrn,
                            parentgrnnum,
                            pocrn ,
							stdrev,
							qtm,
                            qty_used,
                            qty_ret,
							wo_ref,
							grn_classif,
							qtm_req,
              siteid
                           )
                     VALUES
                           ($objid,
                            $raw_mat_type,
                            $raw_mat_spec,
                            $raw_mat_code,
                            $invoice_num,
                            $invoice_date,
                            $recieved_date,
                            $test_report,
                            $batch_num,
                            $mgp_num,
                            $link2vendor,
                            $grnnum,
                            $rmbycim,
                            $rmbycust,
                            $coc_refnum,
                            $cimponum,
                            'F7532',
                            '0',
                            $num_of_pieces,
                            $remarks,
                            $nc_refnum,
                            $grntype,
                            $crn,
                            $status ,
                            $shipping_date,
							$conversion_date,
							$quarremarks,
                            $grndateQuar,
                            $rm_empcode,
                            $rm_date,
                            $grn_empcode,
                            $grn_date,
                            $rm_cost,
                            $rm_currency,
                            $approved,
                            $rmpoline_num,
                            $altcrn,
                            $parentgrnnum,
                            $pocrn,
							$stdrev,
							$qtm4grn,
                            0,
                            0,
							$wo_ref,
							$wotype,
							$qtm_req,
              $siteid
                            )";

          // echo $sql . '<br>';exit;
           $result = mysql_query($sql);
           if(!$result)
           {
	         $sql = "rollback";
             $result = mysql_query($sql);
	         die("Insert to grn didn't work..Please report to Sysadmin. " . mysql_error());
           }


        $sql = "update seqnum set nxtnum = $objid where tablename = 'grn'";
        //echo $sql . '<br>';
        $result = mysql_query($sql);
        if(!$result) die("Seqnum update for grn failed..Please report to Sysadmin. " . mysql_error());

         return $objid;
      }
       else {
            echo "<table border=1><tr><td><font color=#FF0000>";
            die("GRN  " . $grnnum . " already exists. ");
       }
    }

     function addgrn_issue() {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "start transaction";
        $result = mysql_query($sql);
        $sql = "select nxtnum from seqnum where tablename = 'grn_issue' for update";
        $result = mysql_query($sql);
        if(!$result) die("Seqnum access failed..Please report to Sysadmin. " . mysql_error());
        $myrow = mysql_fetch_row($result);
        $seqnum = $myrow[0];
        $objid = $seqnum + 1;

        $line_no = $this->line_no;
        $iss_date = "'" . $this->iss_date . "'";

        if($this->iss_qty != '')
        {
          $iss_qty = $this->iss_qty;
        }

          $iss4wo = "'" . $this->iss4wo . "'";


        if($this->accqty != '')
        {
          $accqty = $this->accqty;
        }
        else
        {
          $accqty =0;
        }

        if($this->rejqty != '')
        {
          $rejqty = $this->rejqty;
        }
        else
        {
          $rejqty = 0;
        }

        if($this->retqty != '')
        {
          $retqty = $this->retqty;
        }
        else
        {
           $retqty = 0;
        }

        if($this->balance != '')
        {
          $balance = $this->balance;
        }
        else
        {
           $balance = 0;
        }

        $link2grn = $this->link2grn;

                 $sql = "INSERT INTO
                         grn_issue
                           (recno,
                            line_no,
                            iss_date,
                            iss_qty,
                            iss4wo,
                            accqty,
                            rejqty,
                            retqty,
                            balance,
                            link2grn
                           )
                         VALUES
                           ($objid,
                            $line_no,
                            $iss_date,
                            $iss_qty,
                            $iss4wo,
                            $accqty,
                            $rejqty,
                            $retqty,
                            $balance,
                            $link2grn
                            )";
            //echo $sql . '<br>';

           $result = mysql_query($sql);


           if(!$result)
           {
            $sql = "rollback";
	        $result = mysql_query($sql);
	        die("Insert to grn_issue didn't work..Please report to Sysadmin. " . mysql_error());
           }

         $sql = "update seqnum set nxtnum = $objid where tablename = 'grn_issue'";
         //echo $sql . '<br>';
         $result = mysql_query($sql);
         if(!$result) die("Seqnum update for grn_issue failed..Please report to Sysadmin. " . mysql_error());

         $sql = "commit";
	     $result = mysql_query($sql);
	     if(!$result)
	     {
		   $sql = "rollback";
		   $result = mysql_query($sql);
		   die("Commit failed for GRN Issue..Please report to Sysadmin. " . mysql_errno());
	     }


        // Test to make sure query worked

     }

      function addgrnli($grnnum) 
	  {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select nxtnum from seqnum where tablename = 'grn_li' for update";
        $result = mysql_query($sql);
        if(!$result) die("Seqnum access failed..Please report to Sysadmin. " . mysql_error());
        $myrow = mysql_fetch_row($result);
        $seqnum = $myrow[0];
        $objid = $seqnum + 1;
        $inpgrnnum = $grnnum;
        $linenum1 = $this->linenum1;
	    $partnum1 = $this->partnum1;
        $partdesc = "'" . $this->partdesc . "'";
        $batchnum = "'" . $this->libatchnum . "'";
        $uom = "'" . $this->uom . "'";
        //$expdate = "'" . $this->expdate . "'";
        $expdate = $this->expdate ? "'" . $this->expdate  . "'" : '0000-00-00';
        $qty1 = $this->qty1 ? $this->qty1 : 0.0;
        $dim11 =  "'" . $this->dim11 ."'" ;
        $dim21 =  "'" . $this->dim21 . "'" ;
        $dim31 =  "'" . $this->dim31 . "'" ;
        $qty4billet = $this->qty4billet ? $this->qty4billet : 0;
        $qty_rej = $this->qty_rej ? $this->qty_rej : 0;
        $qty_to_make = $this->qty_to_make ?$this->qty_to_make : 0;
        $uom = "'" . $this->uom . "'";
        $amend_line_num = "'" . $this->amend_line_num . "'";
        $layout_ref = "'" . $this->layout_ref . "'";
        $amendstatus="'" . $this->amendstatus. "'";
        $noofpieces=$this->noofpieces?$this->noofpieces:0;
        // echo $rmpoline_num;
         $sql = "INSERT INTO
                        grn_li
                           (recnum,
                            linenum,
			                partnum,
                            qty,
                            dim1,
                            dim2,
                            dim3,
                            qty_left,
                            link2grn,
                            qty_rej,
                            qty_to_make,
                            qty4billet,
                            partdesc,
                            batchnum,
                            uom,
                            expdate,
                            amendlinenum,
                            layoutrefnum,
                            amendstatus,
                            noofpieces
                           )
                     VALUES
                           ($objid,
                            $linenum1,
			                '$partnum1',
                            $qty1,
                            $dim11,
                            $dim21,
                            $dim31,
                            $qty1,
                            $inpgrnnum,
                            $qty_rej,
                            $qty_to_make,
                            $qty4billet,
                            $partdesc,
                            $batchnum,
                            $uom,
                            $expdate,
                            $amend_line_num,
                            $layout_ref,
                            $amendstatus,
                            $noofpieces
                            )";
         // echo $sql;exit;
          $result = mysql_query($sql);
          if(!$result)
           {
	      $sql = "rollback";
	      $result = mysql_query($sql);
	      die("Insert to grnli for $linenum1 failed ..Please report to Sysadmin. " . mysql_error());
           }
        $sql = "update seqnum set nxtnum = $objid where tablename = 'grn_li'";
        $result = mysql_query($sql);
        if(!$result) die("Seqnum update for grn failed..Please report to Sysadmin. " . mysql_error());


     }
     function getgrns($cond,$argoffset,$sort1,$arglimit) {
         $newlogin = new userlogin;
         $newlogin->dbconnect();
         $offset= $argoffset;
         $limit= $arglimit;
         $wcond = $cond;
         $siteid = $_SESSION['siteid'];
         $siteval = "g.siteid = '".$siteid."'";

         if ($sort1 == 'GRN Num' || $sort1 == '') {
            $sortorder1 = 'g.recnum, g.recieved_date';
         }
         if ($sort1 == 'Received Date') {
            $sortorder1 = 'g.recieved_date, g.grnnum';
         }
         $sql = "select g.recnum,
                        g.grnnum,
                        c.name,
                        g.raw_mat_spec,
                        g.raw_mat_type,
                        g.num_of_pieces,
                        g.invoice_num,
                        g.invoice_date,
                        g.grntype,
                        g.recieved_date,
                        g.crn,
                        g.status,
                        sum(grnli.qty_to_make),
                         g.shipping_date,
						 g.conversion_date,
						 g.quarantine_remarks,g.grn_classif
                  FROM grn g, company c,grn_li grnli
                  where $wcond and
                        g.link2vendor = c.recnum and
                        g.recnum = grnli.link2grn and
                        $siteval
                        group by g.grnnum
                  order by g.recnum limit $offset, $limit";
        // echo $sql."<br>";
        $result = mysql_query($sql);
        if(!$result) die("getgrns query failed..Please report to Sysadmin. " . mysql_error());
        return $result;

     }

     function getgrn($grnrecnum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = " select g.recnum,
                        g.refnum,
                        g.partnum,
                        g.partname,
                        g.raw_mat_type,
                        g.raw_mat_spec,
                        g.dim1,
                        g.dim2,
                        g.dim3,
                        g.dim4,
                        g.num_of_lengths,
                        g.num_of_pieces,
                        g.raw_mat_code,
                        g.invoice_num,
                        g.invoice_date,
                        g.recieved_date,
                        g.test_report,
                        g.batch_num,
                        g.mgp_num,
                        g.rate,
                        g.lead_time,
                        g.lead_unit,
                        g.inventory_cnt,
                        c.name,
                        g.link2vendor,
                        g.grnnum,
                        g.coc_refnum,
                        g.total_qty,
                        g.rmbycim,
                        g.rmbycust,
                        g.cimponum,
                        g.fmtnum,
                        g.fmtrev,
                        g.remarks,
                        g.nc_refnum,
                        g.grntype,
                        g.crn,
                        g.status,
                        g.shipping_date,
						g.conversion_date,
						g.quarantine_remarks,
						g.grndateQuar,
                        g.rmpo_empcode,
						g.rmpo_date,
						g.grn_empcode,
						g.grn_date,
						g.rm_cost,
						g.rm_currency,
						g.approved,
						g.rmpolinenum,
						g.altcrn,
						g.parentgrnnum,
						g.pocrn,
						g.approval_remarks,
						g.approval_date,
						g.approved_by,
						g.stdrev,
						g.wo_ref,
						g.grn_classif,
						g.cad_approved,
						g.cad_approved_by,
						g.cad_approval_date,
						g.qtm_req,
						(g.qtm-g.qty_used)
            FROM grn g, company c
            where g.recnum = $grnrecnum and
                  g.link2vendor = c.recnum ";
         // echo $sql;
        $result = mysql_query($sql);
        if(!$result) die("Getgrn query failed..Please report to Sysadmin. " . mysql_error());
        return $result;
     }

     function getgrn_issue($grnrecnum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = " select *
            FROM grn_issue
            where link2grn = $grnrecnum
            order by line_no";
       // echo '<br>' . $sql;
        $result = mysql_query($sql);
        if(!$result) die("Getgrn_issue query failed..Please report to Sysadmin. " . mysql_error());
        return $result;
     }


     function getgrnli($grnrecnum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select gli.linenum,
                       gli.qty,
                       gli.dim1,
                       gli.dim2,
                       gli.dim3,
                       gli.wo_assigned,
                       gli.qty_left,
                       gli.recnum,
                       gli.qty_rej,
                       gli.qty_to_make,
                       gli.qty4billet,
		                   gli.partnum,
                       gli.partdesc,
                       gli.batchnum,
                       gli.uom,
                       gli.expdate,
                       gli.rmpo_linenum,
                       gli.amendlinenum,
                       gli.layoutrefnum,
                       gli.amendstatus,
                       gli.noofpieces
                FROM grn g, grn_li gli
                where g.recnum = $grnrecnum and
                      g.recnum = gli.link2grn order by gli.linenum";
       // echo $sql;exit;
        $result = mysql_query($sql);
        if(!$result) die("Getgrnli query failed..Please report to Sysadmin. " . mysql_error());
        return $result;
     }


     function updategrn($grnnum,$validatFlag,$grnqty) 
	 {
         $refnum = "'" . $this->refnum . "'";
         $partnum = "'" . $this->partnum . "'";
         $partname = "'" . $this->partname . "'";
         $raw_mat_type = "'" . $this->raw_mat_type . "'";
         $raw_mat_spec = "'" . $this->raw_mat_spec . "'";
         $num_of_lengths = "'" . $this->num_of_lengths . "'";
         $raw_mat_code = "'" . $this->raw_mat_code . "'";
         $invoice_num = "'" . $this->invoice_num . "'";
         $invoice_date = "'" . $this->invoice_date . "'";
         $recieved_date = "'" . $this->recieved_date . "'";
         $test_report = "'" . $this->test_report . "'";
         $batch_num = "'" . $this->batch_num . "'";
         $mgp_num = "'" . $this->mgp_num . "'";
         $link2vendor=$this->link2vendor;
         $grnnum = "'" . $this->grnnum . "'";
         $coc_refnum = "'" . $this->coc_refnum . "'";
         $rmbycim = "'" . $this->rmbycim . "'";
         $rmbycust = "'" . $this->rmbycust . "'";
         $total_qty = "'" . $this->total_qty . "'";
         $cimponum = "'" . $this->cimponum . "'";
         $num_of_pieces = "'" . $this->num_of_pieces . "'";
         $remarks = "'" . $this->remarks . "'";
         $nc_refnum = "'" . $this->nc_refnum . "'";
         $grntype = "'" . $this->grntype . "'";
		 $grndateQuar = $this->grndateQuar ? "'".$this->grndateQuar."'" :'0000-00-00';
         $crn = "'" . $this->crn . "'";
         $shipping_date = $this->shipping_date ? "'" . $this->shipping_date  . "'" : '0000-00-00';
		 $quarremarks = "'" . $this->quarremarks . "'";
         $conversion_date = $this->conversion_date ? "'" . $this->conversion_date  . "'" : '0000-00-00';
         $rm_empcode = "'" . $this->rm_empcode . "'";
         $grn_empcode = "'" . $this->grn_empcode. "'";
         $rm_cost = $this->rm_cost? $this->rm_cost : 0;
         $rm_currency = "'" . $this->rm_currency. "'";
         $rm_date =$this->rm_date ?"'".$this->rm_date."'":'0000-00-00';
         $grn_date =$this->grn_date ?"'".$this->grn_date."'":'0000-00-00';
         $prev_stat= "'" . $this->grnstatus. "'";
         $approved = "'" . $this->approved . "'";
         $rmpoline_num = $this->rmpoline_num?$this->rmpoline_num:0;
         $altcrn = "'" . $this->altcrn . "'";
         $parentgrnnum = "'" . $this->parentgrnnum . "'";
         $pocrn = "'" . $this->pocrn . "'";
         $approval_remarks =  "'" . $this->approval_remarks . "'";
          $approval_date = $this->approval_date ? "'" . $this->approval_date  . "'" : '0000-00-00';
          $userid_app="'". $this->userid_app ."'";
		  $wo_ref = "'" . $this->wo_ref. "'";
		  $wotype="'" . $this->wotype. "'";

		   $cad_approval_date="'" . $this->cad_approval_date. "'";
		    $cad_approved="'" . $this->cad_approved. "'";
			 $cad_approved_by="'" . $this->cad_approved_by. "'";

         //echo $approved.'*-*-*-*-*'.$validatFlag."+++++++++++++++".$cad_approved;
         if($approved=="'yes'" && $validatFlag ==1 && $cad_approved =="'yes'"  )
         { //echo"here11111111111111";			
           $status = "'Open'";
         }else if($approved=="''" && $validatFlag ==1 &&  $cad_approved=="''")
         { //echo"here2222222222222";
           $status = "'Pending'";
         }
         else if($approved=="''" && $validatFlag !=1 &&  $cad_approved=="''")
         {  //echo"here3333333333333333333";
			  //$status = "'Open'";
           $status = "'Pending'";
         }

        else {
         //echo"here444444444444444";
           $status = $prev_stat;
		}
		//echo $prev_stat.'_____+++++++_________';
		$stdrev = "'" . $this->stdrev. "'";
		$grnqty=$grnqty?$grnqty:0;
         //$val_remarks = "'$rm_remarks'";
         //echo $grndateQuar;
         $sql = "UPDATE grn SET
                    refnum = $refnum,
                    raw_mat_type = $raw_mat_type,
                    raw_mat_spec = $raw_mat_spec,
                    num_of_pieces = $num_of_pieces,
                    raw_mat_code = $raw_mat_code,
                    invoice_num = $invoice_num,
                    invoice_date = $invoice_date,
                    recieved_date = $recieved_date,
                    test_report = $test_report,
                    batch_num = $batch_num,
                    mgp_num = $mgp_num,
                    link2vendor = $link2vendor,
                    rmbycim = $rmbycim,
                    rmbycust = $rmbycust,
                    coc_refnum = $coc_refnum,
                    cimponum = $cimponum,
                    remarks = $remarks,
                    nc_refnum = $nc_refnum,
                    grntype = $grntype,
                    crn = $crn,
                    status = $status,
                    shipping_date=$shipping_date,
					conversion_date = $conversion_date,
					quarantine_remarks = $quarremarks,
					grndateQuar = $grndateQuar,
					rmpo_empcode = $rm_empcode,
					rmpo_date = $rm_date,
					grn_empcode = $grn_empcode,
					grn_date = $grn_date,
					rm_cost = $rm_cost,
					rm_currency = $rm_currency ,
					approved = $approved ,
			       rmpolinenum=$rmpoline_num ,
			       altcrn=$altcrn,
			       parentgrnnum=$parentgrnnum,
			       pocrn=$pocrn,
			       approval_remarks=$approval_remarks,
			       approval_date=$approval_date,
			       approved_by=$userid_app,
			       stdrev=$stdrev,
			       qtm=$grnqty,
				   wo_ref=$wo_ref,
				   grn_classif=$wotype,
				   cad_approved_by=$cad_approved_by,
				   cad_approved=$cad_approved,
				   cad_approval_date=$cad_approval_date
        	WHERE
                    grnnum = $grnnum";
       // echo $sql;exit;
        $result = mysql_query($sql);
          if(!$result)
           {
	      $sql = "rollback";
	      $result = mysql_query($sql);
	      die("Update to grn failed ..Please report to Sysadmin. " . mysql_error());
           }
         $sql = "commit";
         $result = mysql_query($sql);
         if(!$result)
         {
	       $sql = "rollback";
	       $result = mysql_query($sql);
	       die("Commit Failed for GRN..Please report to Sysadmin. " . mysql_errno());
         }
    }


    function updategrn_issue($recnum) {

        $line_no = $this->line_no;
        $iss_date = "'" . $this->iss_date . "'";

        if($this->iss_qty != '')
        {
          $iss_qty = $this->iss_qty;
        }
        else
        {
          $iss_qty = 0;
        }


        $iss4wo = "'" . $this->iss4wo . "'";


        if($this->accqty != '')
        {
          $accqty = $this->accqty;
        }
        else
        {
          $accqty =0;
        }

        if($this->rejqty != '')
        {
          $rejqty = $this->rejqty;
        }
        else
        {
          $rejqty = 0;
        }

        if($this->retqty != '')
        {
          $retqty = $this->retqty;
        }
        else
        {
           $retqty = 0;
        }

        if($this->balance != '')
        {
          $balance = $this->balance;
        }
        else
        {
           $balance = 0;
        }

         $sql = "UPDATE grn_issue SET
                    line_no = $line_no,
                    iss_date = $iss_date,
                    iss_qty = $iss_qty,
                    iss4wo = $iss4wo,
                    accqty = $accqty,
                    rejqty = $rejqty,
                    retqty = $retqty,
                    balance = $balance
        	     WHERE
                    recno = $recnum";
        //echo $sql;
         $result = mysql_query($sql);
         if(!$result)
         {
	       $sql = "rollback";
	       $result = mysql_query($sql);
	       die("Update to grn_issue failed ..Please report to Sysadmin. " . mysql_error());
         }
         $sql = "commit";
         $result = mysql_query($sql);
         if(!$result)
         {
	       $sql = "rollback";
	       $result = mysql_query($sql);
	       die("Commit Failed for grn_issue..Please report to Sysadmin. " . mysql_errno());
         }
    }


    function updategrnli($recnum,$rm_mismatch) {
        $lirecnum = $recnum;
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "start transaction";
        $line = "'" . $this->linenum1 . "'";
	    $partnum1 = "'" . $this->partnum1 . "'";
        $partdesc = "'" . $this->partdesc . "'";
        $batchnum = "'" . $this->libatchnum . "'";
        $uom = "'" . $this->uom . "'";
        //$expdate = "'" . $this->expdate . "'";
        $expdate = $this->expdate ? "'".$this->expdate."'" :'0000-00-00';
        $qty = $this->qty1 ? $this->qty1 : 0;
        $dim1 = "'" . $this->dim11 ."'"  ;
        $dim2 = "'" . $this->dim21 ."'"  ;
        $dim3 = "'" . $this->dim31 ."'" ;
        $qty4billet = $this->qty4billet ? $this->qty4billet : 0.0;
        $qty_rej = $this->qty_rej ? $this->qty_rej : 0;
        $qty_to_make = $this->qty_to_make ? $this->qty_to_make : 0;
        $amend_line_num = "'" . $this->amend_line_num . "'";
        $val_remarks="'" . $rm_mismatch ."'";
        $layout_ref= "'" . $this->layout_ref . "'";
        $amendstatus="'" . $this->amendstatus. "'";
        $noofpieces = $this->noofpieces ? $this->noofpieces : 0;
        $sql = "update grn_li
                          set linenum = $line,
                              qty = $qty,
                              dim1 = $dim1,
                              dim2 = $dim2,
                              dim3 = $dim3,
                              qty_rej = $qty_rej,
                              qty_to_make = $qty_to_make,
                              qty4billet = $qty4billet,
			      partnum = $partnum1,
			      partdesc = $partdesc,
			      batchnum = $batchnum,
			      uom = $uom,
			      expdate = $expdate,
			      val_remarks=$val_remarks,
			      amendlinenum=$amend_line_num,
			      layoutrefnum=$layout_ref,
			      amendstatus=$amendstatus,
			      noofpieces=$noofpieces
                        where recnum = $lirecnum";
         // echo $sql;
           $result = mysql_query($sql);
           // Test to make sure query worked
           if(!$result) die("Update to GRN LI didn't work..Please report to Sysadmin. " . mysql_error());

     }

    function deletegrn($grnrecnum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "delete from grn where recnum = $grnrecnum";
        $result = mysql_query($sql);
        if(!$result)
        {
            die("Delete for grn failed...Please report to SysAdmin. " . mysql_error());
        }
    }

    function deletegrn_issue($recnum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "delete from grn_issue where recno = $recnum";
        $result = mysql_query($sql);
        if(!$result)
        {
            die("Delete for grn_issue failed...Please report to SysAdmin. " . mysql_error());
        }
    }



    function deletegrnli($inprecnum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $recnum =$inprecnum;
        $sql = "delete from grn_li where recnum = $recnum";
        // echo "$sql";
        $result = mysql_query($sql);
        if(!$result) die("Delete for Line Items failed...Please report to SysAdmin. " . mysql_error());
      }

    function getwos() {
       //echo 'hi';
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select wonum,book_date,qty from work_order";
        //echo "$sql";
        $result = mysql_query($sql);
        return $result;
      }

    function getallgrns($crn,$woclassif) 
     {
        //echo $rm_type;
        //echo $rm_spec;
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $userid = $_SESSION['user'];
        $siteid = $_SESSION['siteid'];
        $siteval = "g.siteid = '".$siteid."'";
		if($woclassif == 'Rework')		
			$cond=" and g.grntype='Rework' ";
		else
			$cond=" and g.grntype like '%' ";
        $sql1 = "select  g.recnum, g.grnnum,g.batch_num, sum(gli.qty_to_make) as qtm,
                         g.crn,g.raw_mat_type,g.raw_mat_spec,g.grntype,g.recieved_date,
						 g.wo_ref,g.qty_used,g.qty_ret
                       from grn g, grn_li gli
                       where g.crn = '$crn' and
                             g.recnum = gli.link2grn and
		             g.grntype != 'Quarantined' and
		             g.status != 'Closed' and
		             g.status != 'Cancelled' and
		             g.status != 'Pending' and
                    (gli.amendlinenum = ''  or gli.amendlinenum is null or gli.amendlinenum = 0 )
					$cond and $siteval
                       group by g.grnnum
					   order by g.recieved_date ASC";
             
      // echo "$sql1<br>";exit;
        $result1 = mysql_query($sql1);
        if(!$result1) die("get all grns failed for temp table..Please report to Sysadmin. " . mysql_error());
        return $result1;
      }	 


      function getwoqty4grn() {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $siteid = $_SESSION['siteid'];
        $siteval = "w.siteid = '".$siteid."'";
        $sql2 = "select w.grnnum, (sum(w.qty))
                       from work_order w where w.`condition` !='WO Cancelled' and $siteval
                       group by w.grnnum";
        // echo $sql2;
        $result2 = mysql_query($sql2);
        if(!$result2) die("get all grns failed for select..Please report to Sysadmin. " . mysql_error());
        return $result2;
      }

      function get_MI_details_old($inpgrnnum) {
         $newlogin = new userlogin;
         $newlogin->dbconnect();
         $grnnum = trim($inpgrnnum);
         $sql = "select wo.wonum,wo.book_date,sum(wps.acc),sum(wps.rework),
                        sum(wps.rej),sum(wps.ret),wo.qty
                 from work_order wo
                 left join wo_part_status wps on wps.link2wo = wo.recnum
                   and (wps.stage = 'final' or wps.stage = 'Final' or
                       wps.stage = 'FINAL' or wps.stage = 'fi' or
                       wps.stage = 'FI' or wps.stage = 'Fi')
                 where
                       wo.grnnum = '$grnnum'
                  group by wo.wonum
                  order by wo.wonum";
         //echo "$sql";
        $result = mysql_query($sql);
        if(!$result) die("Get MI details query failed..Please report to Sysadmin. " . mysql_error());
        return $result;
       }


function get_MI_details($inpgrnnum)
{
           $newlogin = new userlogin;
           $newlogin->dbconnect();
           $grnnum = trim($inpgrnnum);
           $sql = "(select wo.wonum,wo.book_date,sum(wps.acc),sum(wps.rework),
                        sum(wps.rej),sum(wps.ret),wo.qty
                 from work_order wo
                 left join wo_part_status wps on ((wps.link2wo = wo.recnum) and (wps.stage = 'final' or wps.stage = 'Final' or
                       wps.stage = 'FINAL' or wps.stage = 'fi' or
                       wps.stage = 'FI' or wps.stage = 'Fi'))

                 where
                       wo.grnnum = '$grnnum' and
                       wo.`condition` !='WO Cancelled'
                  group by wo.wonum
                  order by wo.wonum )
                   UNION
                  (select wo.assy_wonum,wo.assydate,sum(ali.qty_acc),sum(ali.qty_rew),
                        sum(ali.qty_rej),sum(ali.qty_ret),ali.qty_wo
                 from assywo_li ali,assy_wo wo
                 left join assy_part_status wps on wps.link2assywo = wo.recnum
                   and (wps.stage = 'final' or wps.stage = 'Final' or
                       wps.stage = 'FINAL' or wps.stage = 'fi' or
                       wps.stage = 'FI' or wps.stage = 'Fi')
                 where
                       ali.grn = '$grnnum' and
                       ali.link2assywo=wo.recnum
                  group by wo.assy_wonum
                  order by wo.assy_wonum)";
          // echo "$sql"."<br>";exit;
          $result = mysql_query($sql);
          if(!$result) die("Get MI details query failed..Please report to Sysadmin. " . mysql_error());
          return $result;
}


       function getgrnCount($cond,$argoffset,$arglimit)
       {
        $wcond = $cond;
        $offset = $argoffset;
        $limit = $arglimit;
        $siteid = $_SESSION['siteid'];
        $siteval = "g.siteid = '".$siteid."'";
        $sql = "select count(g.recnum) as numrows
                  FROM grn g, company c
                  where $wcond and
                        g.link2vendor = c.recnum and $siteval limit $offset, $limit";
       $newlogin = new userlogin;
       $newlogin->dbconnect();
      //echo $sql;
        $result  = mysql_query($sql) or die('new grn count query failed');
        $row     = mysql_fetch_array($result, MYSQL_ASSOC);
        $numrows = $row['numrows'];
       return $numrows;
       }

      function get_woqty($grnnum)
      {
         $newlogin = new userlogin;
         $newlogin->dbconnect();
		 $inpgrnnum = trim($grnnum);
         $sql = "select wo.grnnum,sum(wo.qty)
                 from work_order wo
                 where
                      wo.grnnum = '$inpgrnnum' and
                       wo.`condition` !='WO Cancelled'
                 group by wo.grnnum";
        //echo "$sql";
        $result = mysql_query($sql);
        if(!$result) die("Get MI details query failed..Please report to Sysadmin. " . mysql_error());
        return $result;
     }

function get_woretqty($grnnum)
{
         $newlogin = new userlogin;
         $newlogin->dbconnect();
		 $inpgrnnum = trim($grnnum);
         $sql = "select wo.grnnum,sum(wps.ret)
                       from work_order wo
                       left join wo_part_status wps on ((wps.link2wo = wo.recnum) and (wps.stage = 'final' or wps.stage = 'Final' or
                       wps.stage = 'FINAL' or wps.stage = 'fi' or
                       wps.stage = 'FI' or wps.stage = 'Fi'))
                       where
                           wo.grnnum = '$inpgrnnum' and
                       wo.`condition` !='WO Cancelled'
                 group by wo.grnnum";
        // echo "$sql";
        $result = mysql_query($sql);
        if(!$result) die("Get woretqty query failed..Please report to Sysadmin. " . mysql_error());
        return $result;
}

function getrmpoDetails($crn,$cimponum,$linenum)
{
         $newlogin = new userlogin;
         $newlogin->dbconnect();
		 $rmpoline_num = "$rmpoline_num1".'-'.'%';
         $sql = "select po.ponum,poli.line_num,poli.thick,poli.width,
                        poli.length,poli.qty_rej,poli.rate,poli.uom,
                        poli.no_of_meterages,poli.no_of_lengths ,poli.material_ref,poli.material_spec,
						po.currency,po.link2vendor,poli.crn,poli.crn,poli.maxruling,poli.qty_recd,
						poli.accepted_date,poli.grn_num,po.recnum
                        from po po,po_line_items poli
                             where
                                  poli.crn='$crn' and
								  poli.line_num = '$linenum' and
                                  po.ponum='$cimponum' and
                                  poli.link2po=po.recnum
								 ";
        // echo "$sql";exit;
        $result = mysql_query($sql);
        if(!$result) die("getrmpoDetails query failed..Please report to Sysadmin. " . mysql_error());
        return $result;

}

function getrmpoDetails4grn($crn,$cimponum,$grnnum)
{
         $newlogin = new userlogin;
         $newlogin->dbconnect();
		 $inpgrnnum = trim($grnnum);
         $sql = "select po.ponum,poli.line_num,poli.thick,poli.width,
                        poli.length,poli.qty_rej,poli.rate,poli.uom,
                        poli.no_of_meterages,poli.no_of_lengths ,poli.material_ref,poli.material_spec,po.currency,
                        po.link2vendor,c.name,poli.crn,poli.maxruling,poli.qty_recd,poli.accepted_date,poli.grn_num,po.recnum
                        from po po,po_line_items poli,company c
                             where
                                  poli.crn='$crn' and
                                  po.ponum='$cimponum' and
                                  poli.grn_num= '$grnnum' and
                                  poli.link2po=po.recnum and
                                  c.recnum=po.link2vendor";
//       echo "$sql";
        $result = mysql_query($sql);
        if(!$result) die("getrmpoDetails4grn query failed..Please report to Sysadmin. " . mysql_error());
        return $result;

}
function getrmpoDetails4nlinenum($crn,$cimponum,$rmpoline_num1)
{
         $newlogin = new userlogin;
         $newlogin->dbconnect();
		 $inpgrnnum = trim($grnnum);
         $sql = "select po.ponum,poli.line_num,poli.thick,poli.width,
                        poli.length,poli.qty_rej,poli.rate,poli.uom,
                        poli.no_of_meterages,poli.no_of_lengths ,poli.material_ref,poli.material_spec,po.currency,
                        po.link2vendor,c.name,poli.crn,poli.maxruling,poli.qty_recd,poli.accepted_date,po.recnum,poli.grn_num
                        from po po,po_line_items poli,company c
                             where
                                  poli.crn='$crn' and
                                  po.ponum='$cimponum' and
                                  poli.line_num= $rmpoline_num1 and
                                  poli.link2po=po.recnum and
                                  c.recnum=po.link2vendor";
       // echo "$sql";
        $result = mysql_query($sql);
        if(!$result) die("getrmpoDetails query failed..Please report to Sysadmin. " . mysql_error());
        return $result;

}

function getpo_details($ponum)
{
         $newlogin = new userlogin;
         $newlogin->dbconnect();
         $sql = "select po.ponum as ponum
                        from po po
                             where
                                  po.ponum='$ponum'";
        //echo "$sql";
        $result = mysql_query($sql);
        $result  = mysql_query($sql) or die('getpo_details query failed');
        $row     = mysql_fetch_array($result, MYSQL_ASSOC);
        $ponum = $row['ponum'];
        return $ponum;

}
function getcrn_line_num($crn,$cimponum,$rmpoline_num)
{
         $newlogin = new userlogin;
         $newlogin->dbconnect();
         if($rmpoline_num == '')
         {
           $rmpolinenum= 0;
         }
         else
         {
           $rmpolinenum= $rmpoline_num;
         }
         $sql = "select poli.line_num,poli.crn
                        from po po,po_line_items poli
                             where
                                  poli.crn='$crn' and
                                  po.ponum='$cimponum' and
                                  poli.line_num= $rmpolinenum and
                                  poli.link2po=po.recnum";
       // echo "$sql";
        $result = mysql_query($sql);
        if(!$result) die("getcrn_line_num query failed..Please report to Sysadmin. " . mysql_error());
        return $result;

}
function updategrnstatus($status,$grnrecnum)
{
   $newlogin = new userlogin;
   $newlogin->dbconnect();
   $sql = "update grn set status=$status where recnum=$grnrecnum";
       // echo "$sql";
        $result = mysql_query($sql);
        if(!$result) die("getcrn_line_num query failed..Please report to Sysadmin. " . mysql_error());
}

function getpogrndetails($ponum,$crn_num,$grnnum)
{
   $newlogin = new userlogin;
   $newlogin->dbconnect();
    $sql = "select sum(gli.qty) as grn_qty
           from grn_li gli,grn g
                where gli.link2grn=g.recnum and
                      g.cimponum='$ponum' and
                      (g.crn='$crn_num' || g.pocrn='$crn_num') and
                      (g.status='Open'||g.status='Pending'||g.status is null) and
                      g.grnnum != '$grnnum'
                      group by g.cimponum,g.crn";
       // echo "$sql";
        //$result = mysql_query($sql);
        $result  = mysql_query($sql) or die('getpogrndetails query failed');
        $row     = mysql_fetch_array($result, MYSQL_ASSOC);
        $grn_qty = $row['grn_qty'];
       return $grn_qty;
}
function getpogrndetails4update($ponum,$crn_num,$rmpolinenum)
{
   $newlogin = new userlogin;
   $newlogin->dbconnect();
    $sql = "select sum(gli.qty) as grn_qty
           from grn_li gli,grn g
                where gli.link2grn=g.recnum and
                      g.cimponum='$ponum' and
                      (g.crn='$crn_num' || g.pocrn='$crn_num')  and
                      (g.status='Open'||g.status='Pending'||g.status is null) and
                       g.rmpolinenum = '$rmpolinenum'
                      group by g.cimponum,g.crn";
       //echo "$sql";
        //$result = mysql_query($sql);
        $result  = mysql_query($sql) or die('getpogrndetails query failed');
        $row     = mysql_fetch_array($result, MYSQL_ASSOC);
        $grn_qty = $row['grn_qty'];
       return $grn_qty;
}


function getpocrn4grn($ponum,$poline)
{
   $newlogin = new userlogin;
   $newlogin->dbconnect();
   $siteid = $_SESSION['siteid'];
   $siteval = "p.siteid = '".$siteid."'";
    $sql = "select li.crn
                   from po p,po_line_items li
                        where p.ponum='$ponum'and
                              li.line_num='$poline' and
                              li.link2po=p.recnum and $siteval ";
        // echo "$sql";
        $result = mysql_query($sql);
        $result  = mysql_query($sql) or die('getpocrn4grn query failed');
        return $result;
}
  function getAllCIMs_old_oct17_2011()
    {
       $newlogin = new userlogin;
       $newlogin->dbconnect();
       $sql = "select m.CIM_refnum as cim,m.partname,m.wonum,m.customer,m.partnum,
                      m.RM_by_CIM,m.project,m.attachments,
                      m.RM_by_customer,m.recnum,m.drg_issue,
                      m.rm_type,m.rm_spec,m.rm_dim1,m.rm_dim2,
                      m.rm_dim3,NULL,m.mps_num,
                      m.drawing_num,m.cos,m.machine_name,
                      NULL,NULL,m.mps_rev as masterrev,m.treat as treatment
                 from master_data m
                 where m.revstat = 'Active'  and m.status = 'Active'
                 UNION
              select  m.CIM_refnum as cim,m.partname,m.wonum,m.customer,m.partnum,
                      m.RM_by_CIM,m.project,m.attachments,
                      m.RM_by_customer,m.recnum,m.drg_issue,
                      m.rm_type,m.rm_spec,m.rm_dim1,m.rm_dim2,
                      m.rm_dim3,mp.mps_revision as rev,m.mps_num,
                      m.drawing_num,m.cos,mp.control,
                      mp.remarks,mp.recnum as mpslink,NULL ,m.treat as treatment
                 from master_data m,mps mp
                 where m.recnum = mp.link2master_data
                 and mp.revstat = 'Active' and m.status = 'Active'
                order by cim ";
       //echo $sql;
       $result = mysql_query($sql);
       return $result;
    }

  function getAllCIMs()
    {
       $newlogin = new userlogin;
       $newlogin->dbconnect();
       $sql = "select m.CIM_refnum as cim,m.partname,m.wonum,m.customer,m.partnum,
                      m.RM_by_CIM,m.project,m.attachments,
                      m.RM_by_customer,m.recnum,m.drg_issue,
                      m.rm_type,m.rm_spec,m.rm_dim1,m.rm_dim2,
                      m.rm_dim3,NULL,m.mps_num,
                      m.drawing_num,m.cos,m.machine_name,
                      NULL,NULL,m.mps_rev as masterrev,m.treat as treatment
                 from master_data m
                 UNION
              select  m.CIM_refnum as cim,m.partname,m.wonum,m.customer,m.partnum,
                      m.RM_by_CIM,m.project,m.attachments,
                      m.RM_by_customer,m.recnum,m.drg_issue,
                      m.rm_type,m.rm_spec,m.rm_dim1,m.rm_dim2,
                      m.rm_dim3,mp.mps_revision as rev,m.mps_num,
                      m.drawing_num,m.cos,mp.control,
                      mp.remarks,mp.recnum as mpslink,NULL ,m.treat as treatment
                 from master_data m,mps mp
                 where m.recnum = mp.link2master_data
                 and mp.revstat = 'Active' and m.status = 'Active'
                order by cim ";
       echo $sql;
       $result = mysql_query($sql);
       return $result;
    }

    function getcrnpartnum($crnnum)
{
   $newlogin = new userlogin;
   $newlogin->dbconnect();
    $sql = "select m.partnum as partnum
                   from master_data m
                        where m.CIM_refnum='$crnnum' and m.status='Active' ";
        //echo "$sql";
        //$result = mysql_query($sql);
        $result  = mysql_query($sql) or die('getcrnpartnum query failed');
        $row     = mysql_fetch_array($result, MYSQL_ASSOC);
        $partnum = $row['partnum'];
       return $partnum;
}

    function getrmpoqty($cimponum,$crn,$rmpoline_num)
{
   $newlogin = new userlogin;
   $newlogin->dbconnect();
    $sql = "select pli.no_of_meterages ,pli.no_of_lengths
                   from po p,po_line_items pli
                        where pli.crn='$crn' and
                              p.ponum='$cimponum' and
                              pli.line_num=$rmpoline_num and
                              pli.link2po=p.recnum ";
        //echo "$sql";
        //$result = mysql_query($sql);
        $result  = mysql_query($sql) or die('getrmpoqty query failed');
        //$row     = mysql_fetch_array($result, MYSQL_ASSOC);
        //$rmpoqty = $row['rmpoqty'];
       return $result;
}

function updatePOli($cimponum,$crn,$rmpoline_num,$qty_total,$accdate,$grnnum,$recnum,$stflag)
{
   //echo $rmpoline_num."--**---";  //
    $newlogin = new userlogin;
    $newlogin->dbconnect();
    $qty_total=$qty_total?$qty_total:0.0;
    $accdate = "'" . $accdate . "'"? "'" . $accdate . "'":'0000-00-00';
    if($stflag==1)
    {
       $sql = "update po p,po_line_items li
                   set li.qty_recd=$qty_total,li.accepted_date=$accdate ,li.grn_num='$grnnum',li.status='Close'
                        where p.ponum='$cimponum' and
                              li.crn='$crn' and
                              li.line_num='$rmpoline_num' and
                              li.link2po=p.recnum  ";
         $sql1 = "update po p,po_line_items li
                   set li.status='Close'
                        where p.ponum='$cimponum' and
                              li.crn='$crn' and
                              li.link2po=$recnum  ";
           $result1 = mysql_query($sql1);
         if(!$result1)
           {

	         die("Update status to POli didn't work..Please report to Sysadmin. " . mysql_error());
           }
    }else
    {
             $sql = "update po p,po_line_items li
                   set li.qty_recd=$qty_total,li.accepted_date=$accdate ,li.grn_num='$grnnum'
                        where p.ponum='$cimponum' and
                              li.crn='$crn' and
                              li.line_num='$rmpoline_num' and
                              li.link2po=p.recnum  ";
    }
      //echo "<br>update-------$sql---<br>";
        $result  = mysql_query($sql) or die('updatePOli query failed'.mysql_error());

}
function update_newPOli($cimponum,$crn,$rmpoline_num,$qty_total,$accdate,$grnnum,$recnum,$stflag)
{
    $i=0;
    $newlogin = new userlogin;
    $newlogin->dbconnect();
    $sql = "select nxtnum from seqnum where tablename = 'po_line_items' for update";
        $result = mysql_query($sql);
        if(!$result) {
           $sql = "rollback";
           $result = mysql_query($sql);
           die("Seqnum access failed for LI..Please report to Sysadmin. " . mysql_error());
        }
        $myrow = mysql_fetch_row($result);
        $seqnum = $myrow[0];
        $objid = $seqnum + 1;
        $i++;
        $new_line=$rmpoline_num."-$i";
        $grn_num = "'" . trim($this->grnnum) . "'";
        $accdate = "'" . $accdate . "'"? "'" . $accdate . "'":'0000-00-00';
        //echo $grn_num."---------".$grnnum."<br>";

        $sql="select poli.line_num as ln from po p,po_line_items poli where poli.link2po=p.recnum and p.recnum=$recnum and
        poli.line_num='$new_line'" ;
       // echo $sql;
        $result=mysql_query($sql);
        if(!$result)
        {  //echo"--H---E---R===<br>";
          $newline=$rmpoline_num."-$i";
         // echo"$newline<br>";
        }else
        {  $sql1="select poli.line_num as ln
                         from po p,po_line_items poli
                              where poli.link2po=p.recnum and
                                     p.recnum=$recnum and
                                     poli.crn='$crn'
                                     order by ln desc limit 1 ";
           $result1=mysql_query($sql1);
           if(!$result1) die("line num access failed in update for poli in GRN..Please report to Sysadmin. " . mysql_error());
           $row1     = mysql_fetch_array($result1, MYSQL_ASSOC);
           $newln = $row1['ln'];
           $lnarr=split('-',$newln);
           $newlnnum=$lnarr[1]+$i;
           //echo"$newlnnum<br>";
           $newline=$rmpoline_num."-$newlnnum";
        }
        if($stflag==1)
        {
          $sql = "INSERT INTO po_line_items (recnum, line_num, item_name, item_desc, qty, material_ref,
                                           duedate, rate,
                                           amount, link2po, creation_date,material_spec,thick,width,length,
                                           qty_per_meter,no_of_meterages,delv_by, no_of_lengths,
                                           uom, grainflow,crn,`condition`,maxruling,qty_rej,delivery_time,order_qty,
                                           alt_spec_rm,spec_type,layoutrefnum,status,qty_recd,accepted_date,remarks,grn_num)
                                           select $objid, '$newline', item_name, item_desc, qty, material_ref,
                                           duedate, rate,
                                           amount, $recnum, creation_date,material_spec,thick,width,length,
                                           qty_per_meter,no_of_meterages,delv_by, no_of_lengths,
                                           uom, grainflow,crn,`condition`,maxruling,qty_rej,delivery_time,order_qty,
                                           alt_spec_rm,spec_type,layoutrefnum,'Close',$qty_total,$accdate,remarks,'$grnnum'
                                           from po_line_items
                                           where link2po=$recnum and
                                           crn='$crn'";
          $sql1 = "update po p,po_line_items li
                   set li.status='Close'
                        where p.ponum='$cimponum' and
                              li.crn='$crn' and
                              li.link2po=$recnum  ";
           $result1 = mysql_query($sql1);
         if(!$result1)
           {

	         die("Update status to POli didn't work..Please report to Sysadmin. " . mysql_error());
           }
        }else
        {
          $sql = "INSERT INTO po_line_items (recnum, line_num, item_name, item_desc, qty, material_ref,
                                           duedate, rate,
                                           amount, link2po, creation_date,material_spec,thick,width,length,
                                           qty_per_meter,no_of_meterages,delv_by, no_of_lengths,
                                           uom, grainflow,crn,`condition`,maxruling,qty_rej,delivery_time,order_qty,
                                           alt_spec_rm,spec_type,layoutrefnum,status,qty_recd,accepted_date,remarks,grn_num)
                                           select $objid, '$newline', item_name, item_desc, qty, material_ref,
                                           duedate, rate,
                                           amount, $recnum, creation_date,material_spec,thick,width,length,
                                           qty_per_meter,no_of_meterages,delv_by, no_of_lengths,
                                           uom, grainflow,crn,`condition`,maxruling,qty_rej,delivery_time,order_qty,
                                           alt_spec_rm,spec_type,layoutrefnum,status,$qty_total,$accdate,remarks,'$grnnum'
                                           from po_line_items
                                           where link2po=$recnum and
                                           line_num='$rmpoline_num' and
                                           crn='$crn'";

         }
        // echo "<br>insert--------$sql<br>";
         $result = mysql_query($sql);
         if(!$result)
           {
	         $sql = "rollback";
             $result = mysql_query($sql);
	         die("Insert to POli didn't work..Please report to Sysadmin. " . mysql_error());
           }


        $sql = "update seqnum set nxtnum = $objid where tablename = 'po_line_items'";
        $result = mysql_query($sql);
        // Test to make sure query worked
        if(!$result) {
           $sql = "rollback";
           $result = mysql_query($sql);
           die("Seqnum insert query didn't work for PO..Please report to Sysadmin. " . mysql_error());
        }

}




    function getcrnmasterdetails($crn)
{
    $newlogin = new userlogin;
    $newlogin->dbconnect();
    $sql = "select m.rm_dim1,m.rm_dim2,m.rm_dim3,m.maxruling
                   from master_data m
                       where m.CIM_refnum='$crn' and
                             m.status = 'Active'";
        //echo "$sql";

        $result  = mysql_query($sql) or die('getcrnmasterdetails query failed');
        return $result;
}



  function getrmdetails($crn)
  {
     $newlogin = new userlogin;
     $newlogin->dbconnect();
     $sql = "select r.rm_type ,r.rm_spec,r.rm_altrm
                   from rmmaster r
                        where r.crnnum = '$crn' and
                              r.rm_status like '%'" ;
      // echo "<br>$sql";

        $result  = mysql_query($sql) or die('getrmdetails query failed');
        return $result;
  }
     function getrmdcrnetails($crn)
  {
     $newlogin = new userlogin;
     $newlogin->dbconnect();
     $sql = "select r.rm_type,r.rm_spec
                   from rmmaster r
                        where r.crnnum = '$crn' and
                              r.rm_status='Active' ";
        //echo "$sql";

        $result  = mysql_query($sql) or die('getrmpoqty query failed');
        return $result;
  }
  function addgrnnotes($grnrecnum,$grnnotes)
  {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        //Connect to database
        $userid = $_SESSION['user'];
        $link2user = "'" . $userid . "'";
       // $userrecnum = $_SESSION['userrecnum'];
        $grnnotes = "'" . $grnnotes . "'";
        $sql = "INSERT INTO grn_notes (grnnotes,link2grn,create_date,modified_date,link2user)
               VALUES ($grnnotes,$grnrecnum,now(),now(),$link2user)";
        //echo "$sql";
        $result = mysql_query($sql);
        // Test to make sure query worked
        if(!$result) die("Insert of GRN Notes didn't work. " . mysql_error());
  }
  function getNotes($grnrecnum)
{
        //Connect to database
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select gr.grnnotes, DATE_ADD(gr.create_date, INTERVAL '13:00' HOUR_MINUTE),
                        e.fname
                from grn_notes gr, employee e, user u
                where link2grn=$grnrecnum and
                      u.userid = gr.link2user and
                      u.user2employee = e.recnum
                order by gr.create_date";
        //echo "$sql";
        $result = mysql_query($sql);
        // Test to make sure query worked
        if(!$result) die("Get Grn Notes didn't work. " . mysql_error());
       return $result;
}
      function updateconsumptionreg($qty_total,$company,$qty_grn,$dimension,$uom,$prflag)
     {
        $sql = "select nxtnum from seqnum where tablename = 'consumption' for update";
        // echo "$sql";
        $result = mysql_query($sql);
        if(!$result)
                     {
                      $sql = "rollback";
                      $result = mysql_query($sql);
                      die("Seqnum access failed..Please report to Sysadmin. " . mysql_error());
                     }


        $myrow = mysql_fetch_row($result);
        $seqnum = $myrow[0];
        $objid = $seqnum + 1;
        $crn = "'" . $this->crn . "'";
        $grnnum= "'" . $this->grnnum . "'";
        $description= "'" . $this->raw_mat_spec . "'";
        $qtyrecd= $qty_total?$qty_total:0.0;
        $grndate = $this->recieved_date?"'" . $this->recieved_date . "'":'0000-00-00';
        $invoice_num= "'" . $this->invoice_num . "'";
        $create_date = $this->create_date?"'" . $this->create_date . "'":'0000-00-00';
        $invoice_date = $this->invoice_date?"'" . $this->invoice_date . "'":'0000-00-00';
        $rmtype= "'" . $this->raw_mat_type . "'";
        $company= "'" . $company . "'";
        $uom = "'" . $uom . "'";
        $grntype= "'" . $this->grntype . "'";
        $descr = "'" . $dimension . "'";
        $qty= $qty_grn?$qty_grn:0.0;
        $parentgrnnum= "'" . $this->parentgrnnum. "'";
        //echo $parentgrnnum."---c@---<br>";
       /* if($dimension !="' '")
        {
          $descr=$description."".$dimension."".$grntype;
        }

        echo $description."---c!---<br>";

        echo $descr."-----c#----<br>";   */
        $sql = "select * from consumption where grnnum = $grnnum";
       // echo $sql;
        $result = mysql_query($sql);

        if (!(mysql_fetch_row($result))) {
                 $sql = "INSERT INTO
                        consumption
                            (
                            recnum,
                            crn,
                            invoice_num,
                            grnnum,
                            grn_date,
                            description,
                            qty_recd,
                            create_date,
                            invoice_date,
                            company,
                            rmtype,
                            uom,qty,parentgrnnum
                            )
                            VALUES
                            (
                            $objid,
                            $crn,
                            $invoice_num,
                            $grnnum,
                            $grndate,
                            $descr,
                            $qtyrecd,
                            now(),
                            $invoice_date,
                            $company,
                            $rmtype,
                            $uom,$qty,$parentgrnnum
                           )";
                         // echo $sql;
             $result = mysql_query($sql);
           // Test to make sure query worked
           if(!$result)
                        {
                        //header("Location:errorMessage.php?validate=Inv2");
                        die("Insert to consumption for grn didn't work..Please report to Sysadmin. " . mysql_error());
                        }

                         $sql = "update seqnum set nxtnum = $objid where tablename = 'consumption'";
        $result = mysql_query($sql);
        // Test to make sure query worked
        if(!$result)
                     {
                     //header("Location:errorMessage.php?validate=Inv4");
                     die("Seqnum insert query for grn consumption didn't work..Please report to Sysadmin. " . mysql_error());
                     }

         }
         else {

                    $sql = "update consumption set
                            crn =$crn,
                            invoice_num=$invoice_num,
                            grn_date=$grndate,
                            description=$descr,
                            qty_recd=$qtyrecd,
                            create_date=now(),
                            modified_date=now(),
                            invoice_date=$invoice_date,
                            company=$company,
                            rmtype=$rmtype,
                            uom=$uom,
                            qty=$qty,
                            parentgrnnum=$parentgrnnum
                            where grnnum = $grnnum";


              // echo $sql;
               $result = mysql_query($sql);
           // Test to make sure query worked
           if(!$result)
                        {
                        //header("Location:errorMessage.php?validate=Inv2");
                        die("Update to consumption for grn didn't work..Please report to Sysadmin. " . mysql_error());
                        }
              }


     }

       function getallgrn4consupdate()
     {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select g.invoice_num,g.invoice_date,sum(gli.qty_to_make),
                      g.grnnum,g.recieved_date,g.cimponum,g.raw_mat_spec,c.name,g.raw_mat_type,gli.uom,g.crn
                      from grn_li gli,grn g,company c
                           where gli.link2grn=g.recnum and
                                 g.link2vendor=c.recnum and
                                 g.grnnum !=' C00499' and
                                 g.recieved_date > '2011-10-30' and
								 g.status != 'Cancelled'
				                 group by g.grnnum";
        //echo "$sql <br>";
        $result = mysql_query($sql);
        // Test to make sure query worked
        if(!$result) die("getallgrn4consupdate didn't work. " . mysql_error());
       return $result;

     }

     function getdispatch4update($grnnum)
     {

       $newlogin = new userlogin;
        $newlogin->dbconnect();
        $grn=trim($grnnum);
        $sql = "select dli.link2dispatch,sum(dli.dispatch_qty)
		                      from dispatch_line_items dli, dispatch d
							  where dli.grnnum='$grn' and
							               d.recnum = dli.link2dispatch and
										   d.status != 'Cancelled'
                        group by dli.link2dispatch";
        //echo "$sql <br>";
        $result = mysql_query($sql);
        // Test to make sure query worked
        if(!$result) die("getdispatch4update didn't work. " . mysql_error());
       return $result;
     }

     function updateconsumptionreg4update($grnnum,$invoice_num,$invoice_date,$qtyrecd,$crn,$grndate,$ponum,$rmspec,$company,$rmtype,$uom)
     {
        $sql = "select nxtnum from seqnum where tablename = 'consumption' for update";
        //echo "$sql";
        $result = mysql_query($sql);
        if(!$result)
                     {
                      $sql = "rollback";
                      $result = mysql_query($sql);
                      die("Seqnum access failed..Please report to Sysadmin. " . mysql_error());
                     }


        $myrow = mysql_fetch_row($result);
        $seqnum = $myrow[0];
        $objid = $seqnum + 1;
        $crn = "'" . $crn . "'";
        $grnnum= "'" . $grnnum . "'";
        $description= "'" . $raw_mat_spec . "'";
        $qtyrecd= $qty_total?$qty_total:0.0;
        $grndate = $grndate?"'" . $grndate . "'":'0000-00-00';
        $invoice_num= "'" . $invoice_num . "'";
        $create_date = $create_date?"'" . $create_date . "'":'0000-00-00';
        $invoice_date = $invoice_date?"'" . $invoice_date . "'":'0000-00-00';
        $rmtype= "'" . $raw_mat_type . "'";
        $company= "'" . $company . "'";
        $uom = "'" . $uom . "'";

        $sql = "select * from consumption where grnnum = $grnnum";
       // echo $sql;
        $result = mysql_query($sql);

        if (!(mysql_fetch_row($result))) {
           $sql = "INSERT INTO
                        consumption
                            (
                            recnum,
                            crn,
                            invoice_num,
                            grnnum,
                            grn_date,
                            description,
                            qty_recd,
                            create_date,
                            invoice_date,
                            rmtype,company,uom
                            )
                           select
                            $objid,
                            g.crn,
                            g.invoice_num,
                            g.grnnum,
                            g.recieved_date,
                            g.raw_mat_spec,
                            sum(gli.qty_to_make),
                            now(),
                            g.invoice_date,
                            g.raw_mat_type,c.name,gli.uom
                            from grn_li gli,grn g,company c
                            where gli.link2grn=g.recnum and
							           g.link2vendor=c.recnum and
									   g.grnnum = $grnnum
				                 group by g.grnnum";
             echo $sql."<br>";
             $result = mysql_query($sql);
           // Test to make sure query worked
           if(!$result)
                        {
                        //header("Location:errorMessage.php?validate=Inv2");
                        die("Insert to consumption didn't work..Please report to Sysadmin. " . mysql_error());
                        }

                         $sql = "update seqnum set nxtnum = $objid where tablename = 'consumption'";
        $result = mysql_query($sql);
        // Test to make sure query worked
        if(!$result)
                     {
                     //header("Location:errorMessage.php?validate=Inv4");
                     die("Seqnum insert query didn't work..Please report to Sysadmin. " . mysql_error());
                     }

         }
         else {
                      $sql = "update consumption set
                            crn =$crn,
                            invoice_num=$invoice_num,
                            grn_date=$grndate,
                            description=$description,
                            qty_recd=$qtyrecd,
                            create_date=now(),
                            modified_date=now(),
                            invoice_date=$invoice_date,
                            rmtype=$rmtype,
                            company=$company,
                            uom=$uom
                            where grnnum = $grnnum";
              // echo $sql;
               $result = mysql_query($sql);
           // Test to make sure query worked
           if(!$result)
                        {
                        //header("Location:errorMessage.php?validate=Inv2");
                        die("Update to Consumption for grn didn't work..Please report to Sysadmin. " . mysql_error());
                        }
              }


     }


          function getallrmdetails($crn)
     {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select r.rm_dia,r.length ,r.width,r.thickness
                      from rmmaster r
                           where r.rm_status ='Active' and
                           r.rm_altrm='Primary Spec' and
                           r.crnnum='$crn'";
        //echo "$sql <br>";
        $result = mysql_query($sql);
        // Test to make sure query worked
        if(!$result) die("getallgrn4consupdate didn't work. " . mysql_error());
       return $result;

     }
     //and g.recieved_date between '2011-08-01' and '2011-12-01'
     //and  g.cimponum='TKA-098'
     //(gli.amendlinenum = ''  or gli.amendlinenum is null or gli.amendlinenum = 0 )
     /*
     and  g.cimponum in (
'TKA-171',
'TKA-172',
'TKA-173',
'TKA-174',
'TKA-175',
'TKA-176',
'TKA-177',
'TKA-178',
'TKA-179',
'TKA-180'  and
                                  g.grnnum='D01854'
)*/

     function getgrnpodetails()
     {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select g.grnnum as grn,g.cimponum,g.rmpolinenum,sum(gli.qty),
		                          g.crn,g.recieved_date,g.pocrn,g.altcrn
                       from grn g,grn_li gli
                            where gli.link2grn=g.recnum and
                            (g.parentgrnnum='' || g.parentgrnnum is null)and
                                  g.`status` != 'Cancelled' and
                                  g.recieved_date  between '2011-01-25' and '2011-12-31' and
                                  (g.cimponum!='' && g.cimponum!='-' && g.cimponum !='--')
                                  group by grn";
     //  echo "$sql <br>";
        $result = mysql_query($sql);
        // Test to make sure query worked
        if(!$result) die("getgrnpodetails for GRN didn't work. " . mysql_error());
       return $result;
     }
     
function getrmpoDetails4nullgrn($crn,$cimponum,$grn)
{
         $newlogin = new userlogin;
         $newlogin->dbconnect();
		 $rmpoline_num = "$rmpoline_num1".'-'.'%';
         $sql = "select po.ponum,poli.line_num,poli.thick,poli.width,
                        poli.length,poli.qty_rej,poli.rate,poli.uom,
                        poli.no_of_meterages,poli.no_of_lengths ,poli.material_ref,poli.material_spec,
						po.currency,po.link2vendor,poli.crn,poli.crn,poli.maxruling,poli.qty_recd,
						poli.accepted_date,poli.grn_num,po.recnum
                        from po po,po_line_items poli
                             where
                                  poli.crn='$crn' and
								  (poli.grn_num = '' || poli.grn_num is NULL) and
                                  po.ponum='$cimponum' and
                                  poli.link2po=po.recnum 
								 ";
      //  echo "$sql";
        $result = mysql_query($sql);
        if(!$result) die("getrmpoDetails query failed..Please report to Sysadmin. " . mysql_error());
        return $result;

}
	
     function getrmpoDetails4update($crn,$cimponum,$grn)
{
         $newlogin = new userlogin;
         $newlogin->dbconnect();
		 $rmpoline_num = "$rmpoline_num1".'-'.'%';
         $sql = "select po.ponum,poli.line_num,poli.thick,poli.width,
                        poli.length,poli.qty_rej,poli.rate,poli.uom,
                        poli.no_of_meterages,poli.no_of_lengths ,poli.material_ref,poli.material_spec,
						po.currency,po.link2vendor,poli.crn,poli.crn,poli.maxruling,poli.qty_recd,
						poli.accepted_date,poli.grn_num,po.recnum
                        from po po,po_line_items poli
                             where
                                  poli.crn='$crn' and
								  poli.grn_num = '$grn' and
                                  po.ponum='$cimponum' and
                                  poli.link2po=po.recnum
								 ";
       // echo "$sql";
        $result = mysql_query($sql);
        if(!$result) die("getrmpoDetails query failed..Please report to Sysadmin. " . mysql_error());
        return $result;

}

function updatepolistat4update($cimponum,$crn,$recnum)
{
     $newlogin = new userlogin;
     $newlogin->dbconnect();
     $sql1 = "update po p,po_line_items li
                   set li.status='Close'
                        where p.ponum='$cimponum' and
                              li.crn='$crn' and
                              li.link2po=$recnum ";
                             // echo $sql1."<br>";
         $result1 = mysql_query($sql1);
         if(!$result1)
           {

	         die("Update status to POli didn't work..Please report to Sysadmin. " . mysql_error());
           }
}

/*function getwoqty4cancel($grnnum)
{
   $newlogin = new userlogin;
   $newlogin->dbconnect();
   $sql="select distinct w.qty ,w.wonum
                from work_order w
                     left join wo_part_status wps on wps.link2wo=w.recnum and wps.link2wo is null
                     left join dates d on d.link2wo=w.recnum and d.link2approvedbyowner is null
                     where w.`condition` ='Cancelled' and w.grnnum='$grnnum'
                           group by w.wonum having w.qty > 0";
    //echo $sql;
    $result = mysql_query($sql);
         if(!$result)
           {

	         die("getwoqty4cancel for grn failed..Please report to Sysadmin. " . mysql_error());
           }
   return $result;
}   */

  function getAll_assy_CIMs()
    {
       $newlogin = new userlogin;
       $newlogin->dbconnect();
       $siteid = $_SESSION['siteid'];
       $siteval = "siteid = '".$siteid."'";
       $sql = "select crn
                 from assy_wo
                 where $siteval
				 group by crn
				 order by crn";
       //echo $sql;
       $result = mysql_query($sql);
       return $result;
    }
    function getpo_items($ponum,$crn)
    {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select pl.material_ref,pl.material_spec,pl.length,pl.width,pl.thick  
                from po p ,po_line_items pl 
                where p.recnum=pl.link2po and p.ponum='$ponum' and crn='$crn'";
       // echo "$sql <br>";
        $result = mysql_query($sql);
        // Test to make sure query worked
        if(!$result) die("getpo_items didn't work. " . mysql_error());
       return $result;
    }
    function getparent_grn($cond)
    {
       $newlogin = new userlogin;
       $newlogin->dbconnect();
     
       $sql = "select g.recnum,grnnum,(qtm-qty_used+qty_ret) as bal 
	           from grn g,grn_li li   
	           where $cond and
			         (qtm-qty_used+qty_ret) >= 0 and
					  (status = 'Open' || status = 'Closed') and 
					  (parentgrnnum ='' || parentgrnnum is NULL) and 
					  g.recnum=li.link2grn
			   group by g.recnum
	           order by g.recnum";
         //echo $sql;
       $result = mysql_query($sql);
       return $result;
    }    
	function getrm_qty_perbill($crnnum)
	{
       $newlogin = new userlogin;
       $newlogin->dbconnect();
     
       $sql = "select rm_qty_perbill,length,rm_dia,rm_uom,
	                  width,thickness,rm_type,rm_spec
	           from rmmaster where crnnum='$crnnum' and
                              rm_status like '%' 
			   limit 1";
      // echo $sql;
       $result = mysql_query($sql);
       return $result;
	}

	function updateparentgrnli($grnrecnum,$line,$lirecnum,$grn,$qty_parent,$remainqty)
	{
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select nxtnum from seqnum where tablename = 'grn_li' for update";
        $result = mysql_query($sql);
        if(!$result) die("Seqnum access failed..Please report to Sysadmin. " . mysql_error());
        $myrow = mysql_fetch_row($result);
        $seqnum = $myrow[0];
        $objid = $seqnum + 1;
        $inpgrnnum = $grnrecnum;
        $linenum1 = $this->linenum1;
	    $partnum1 = $this->partnum1;
        $partdesc = "'" . $this->partdesc . "'";
        $batchnum = "'" . $this->libatchnum . "'";
        $uom = "'" . $this->uom . "'";
        //$expdate = "'" . $this->expdate . "'";
        $expdate = $this->expdate ? "'" . $this->expdate  . "'" : '0000-00-00';
        $qty1 = $this->qty1 ? $this->qty1 : 0.0;
        $dim11 =  "'" . $this->dim11 ."'" ;
        $dim21 =  "'" . $this->dim21 . "'" ;
        $dim31 =  "'" . $this->dim31 . "'" ;
        $qty4billet = $this->qty4billet ? $this->qty4billet : 0;
        $qty_rej = $this->qty_rej ? $this->qty_rej : 0;
        $qty_to_make = $this->qty_to_make ?$this->qty_to_make : 0;
        $uom = "'" . $this->uom . "'";
        $amend_line_num = "'" . $this->amend_line_num . "'";
        $layout_ref = "'" . $this->layout_ref . "'";
        $amendstatus="'" . $this->amendstatus. "'";
        $noofpieces=$this->noofpieces?$this->noofpieces:0;
        $billetsreq = $this->billetsreq;
		$qty4billetparent= $this->qty4billetparent;
        // echo $rmpoline_num;
         $sql = "INSERT INTO
                        grn_li
                           (recnum,
                            linenum,
			                partnum,
                            qty,
                            dim1,
                            dim2,
                            dim3,
                            qty_left,
                            link2grn,
                            qty_rej,
                            qty_to_make,
                            qty4billet,
                            partdesc,
                            batchnum,
                            uom,
                            expdate,
                            amendlinenum,
                            layoutrefnum,
                            amendstatus,
                            noofpieces
                           )
                     VALUES
                           ($objid,
                            $line,
			                '$partnum1',
                            $billetsreq,
                            $dim11,
                            $dim21,
                            $dim31,
                            $qty1,
                            $inpgrnnum,
                            $qty_rej,
                            ($billetsreq*$qty4billetparent),
							$qty4billetparent,
                            $partdesc,
                            $batchnum,
                            $uom,
                            $expdate,
                            $linenum1,
                            $layout_ref,
                            $amendstatus,
                            $noofpieces
                            )";
         //echo $sql;
         $result = mysql_query($sql);
        if(!$result) die("Insert into grnli failed for swap..Please report to Sysadmin. " . mysql_error());
        $sql = "update seqnum set nxtnum = $objid where tablename = 'grn_li'";
        $result = mysql_query($sql);
        if(!$result) die("Seqnum update for grn failed..Please report to Sysadmin. " . mysql_error());

		 //$qtm_new = "'" . $this->qtm_new . "'";
		// $qtm_bal=  $this->qtm_bal;
	  
		 if($remainqty > 0)
		 {
		   $sql1 = "update grn_li 
					   set qty_to_make = qty_to_make - ($billetsreq	*$qty4billetparent)	       
						   where recnum =  $lirecnum";
		   //echo $sql1."<br>";
		   $result1 = mysql_query($sql1);
		   if(!$result1)
		   {
				 die("Update grnli swap for qtm..Please report to Sysadmin. " . mysql_error());
		   }
		  }
		  if($remainqty > 0)
		  {
		    $sql2 = "update grn
					   set qtm  = qtm - ($billetsreq	*$qty4billetparent)
							where grnnum = '$grn'";
		     //echo $sql1."<br>";
		     $result2 = mysql_query($sql2);
		     if(!$result2)
		     {
				 die("Update grn swap for qtm didn't work..Please report to Sysadmin. " . mysql_error());
		     }
		   }
       //return $result;
	}

	function getallCIM4rm_master()
    {
       $newlogin = new userlogin;
       $newlogin->dbconnect();
       $siteid = $_SESSION['siteid'];
       $siteval = "m.siteid = '".$siteid."'";
       $sql =   " select m.CIM_refnum as cim,rm.rm_qty_perbill,
	                    rm.length,rm.rm_dia,
	                    rm.rm_uom,rm.width,rm.thickness
                  from  master_data m,rmmaster rm
				  where rm.crnnum=m.CIM_refnum  
          and m.siteid= rm.siteid and $siteval
                  order by cim ";
        // echo $sql;
       $result = mysql_query($sql);
       return $result;
    }
	function getall_layout()
	{
       $newlogin = new userlogin;
       $newlogin->dbconnect();
       $sql =   " select distinct layoutrefnum 
	              from grn_li
				  order by recnum";
        //echo $sql;
       $result = mysql_query($sql);
       return $result;
	}


} // End grn class definition
