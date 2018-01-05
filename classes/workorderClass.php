<?php
//====================================
// Author: FSI
// Date-written = June 20, 2004
// Filename: workOrderClass.php
// Maintains the class for Work Orders
// Revision: v1.0
//====================================
// Modifications History
//
//====================================

include_once('loginClass.php');

class workOrder {

    var $recnum,
        $bomrecnum,
        $wonum,
        $wotype,
        $descr,
        $ponum,
        $podate,
        $status,
        $wo2customer,
        $wo2contact,
        $wo2type,
        $wo2employee,
        $schduedate,
        $actshipdate,
        $createdate,
        $reorder,
        $bookdate,
        $revshipdate,
        $last_modified_date,
        $filename1,
        $filename2,
        $filename3,
        $filename4,
        $link2wo,
        $wo2bom,
        $dept,
        $condition,
        $link2masterdata,
        $grnnum,
        $qty,
        $poqty,
        $batchnum,
        $partnum,
        $woclassif,
        $worefnum,
    		$amenddate,
    		$amendnotes,
        $remarks,
        $link2mps,
		    $original_qty,
        $cust_po_line_num,
        $treatment,
        $crn,
        $fai_type,
        $type_remarks,
        $stage_split,
        $approval,
        $approval_date,
    		$printflag,
    		$printapproval,
        $rm_spec,
        $rm_type,$priority,
        $wo_issue_qty,
        $app_by,
        $qtm;

    // Constructor definition
    function workOrder() {
        $this->recnum = '';
        $this->wonum = '';
        $this->wotype = '';
        $this->descr = '';
        $this->ponum = '';
        $this->podate = '';
        $this->status = '';
        $this->wo2customer = '';
        $this->wo2contact = '';
        $this->wo2type = '';
        $this->wo2employee = '';
        $this->schduedate = '';
        $this->actshipdate = '';
        $this->createdate = '';
        $this->reorder = '';
        $this->last_modified_date = '';
        $this->bookdate = '';
        $this->revshipdate = '';
        $this->condition = '';
        $this->bomrecnum = '';
        $this->filename1 = '';
        $this->filename2 = '';
        $this->filename3 = '';
        $this->filename4 = '';
        $this->link2wo = '';
        $this->wo2bom = '';
        $this->dept = '';
        $this->link2masterdata = '';
        $this->grnnum = '';
        $this->qty = '';
        $this->poqty = '';
        $this->partnum = '';
        $this->batchnum = '';
        $this->woclassif = '';
        $this->worefnum  = '';
    		$this->amenddate  = '';
    		$this->amendnotes  = '';
        $this->treatment = '';
        $this->remarks  = '';
        $this->link2mps  = '';
		    $this->original_qty  = '';
  	    $this->cust_po_line_num = '';
  	    $this->crn = '';
  	    $this->fai_type ='';
  	    $this->type_remarks ='';
  	    $this->stage_split ='';
  	    $this->approval ='';
        $this->approval_date ='';
        $this->printflag ='';
        $this->printapproval ='';
        $this->rm_spec ='';
        $this->rm_type ='';
        $this->priority ='';
        $this->app_by ='';
        $this->wo_issue_qty = '';
        $this->qtm = '';
    }

    // Property get and set
    function getwonum() {
           return $this->wonum;
    }

    /*function setwonum ($reqwonum) {
           $this->wonum = $reqwonum;
    }*/
    function getbomrecnum() {
           return $this->bomrecnum;
    }

    function setbomrecnum($reqbomrecnum) {
           $this->bomrecnum = $reqbomrecnum;
    }

    function getwotype() {
           return $this->wotype;
    }

    function setwotype ($reqwotype) {
           $this->wotype = $reqwotype;
    }

    function getdescr () {
           return $this->descr;
    }

    function setdescr ($reqdesc) {
           $this->descr = $reqdesc;
    }

    function getponum () {
           return $this->ponum;
    }

    function setponum ($reqponum) {
           $this->ponum = $reqponum;
    }

    function getpodate () {
           return $this->podate;
    }

    function setpodate ($po_date) {
           $this->podate = $po_date;
    }

    function getwo2customer () {
           return $this->wo2customer;
    }

    function setwo2customer ($reqwo2customer) {
           $this->wo2customer = $reqwo2customer;
    }

    function getstatus() {
           return $this->status;
    }

    function setstatus($status) {
           $this->status = $status;
    }


    function getwo2contact () {
           return $this->wo2contact;
    }

    function setwo2contact ($reqwo2contact) {
           $this->wo2contact = $reqwo2contact;
    }

    function getwo2employee () {
           return $this->wo2employee;
    }

    function setwo2employee ($reqwo2employee) {
           $this->wo2employee = $reqwo2employee;
    }

    function getwo2type () {
           return $this->wo2type;
    }

    function setwo2type ($reqwo2type) {
           $this->wo2type = $reqwo2type;
    }
    function getcreatedate() {
           return $this->createDate;
    }

    function setcreatedate ($req_createdate) {
           $this->createDate = $req_createdate;
    }
    function getschduedate() {
           return $this->schduedate;
    }

    function setschduedate ($req_schduedate) {
           $this->schduedate = $req_schduedate;
    }
    function getactshipdate() {
           return $this->actshipdate;
    }

    function setactshipdate ($req_actshipdate) {
           $this->actshipdate = $req_actshipdate;
    }

    function getlast_modified_date() {
           return $this->last_modified_date;
    }

    function setlast_modified_date ($req_last_modified_date) {
           $this->last_modified_date = $req_last_modified_date;
    }
    function getreorder() {
           return $this->reorder;
    }

    function setreorder ($reorder) {
           $this->reorder = $reorder;
    }

    function getbookdate() {
           return $this->bookdate;
    }

    function setbookdate ($req_bookdate) {
           $this->bookdate = $req_bookdate;
    }
    function getrevshipdate() {
           return $this->revshipdate;
    }

    function setrevshipdate ($req_revshipdate) {
           $this->revshipdate = $req_revshipdate;
    }
    function getcondition() {
           return $this->condition;
    }

    function setcondition ($req_condition) {
           $this->condition = $req_condition;
    }

     function getfilename1() {
           return $this->filename1;
    }

    function setfilename1 ($req_filename1) {
           $this->filename1 = $req_filename1;
    }

    function getfilename2() {
           return $this->filename2;
    }

    function setfilename2 ($req_filename2) {
           $this->filename2 = $req_filename2;
    }

    function getfilename3() {
           return $this->filename3;
    }

    function setfilename3 ($req_filename3) {
           $this->filename3 = $req_filename3;
    }

    function getfilename4() {
           return $this->filename4;
    }

    function setfilename4 ($req_filename4) {
           $this->filename4 = $req_filename4;
    }

    function getlink2wo() {
           return $this->link2wo;
    }

    function setlink2wo ($req_link2wo) {
           $this->link2wo = $req_link2wo;
    }


    function getwo2bom() {
           return $this->wo2bom;
    }

    function setwo2bom ($req_wo2bom) {
           $this->wo2bom = $req_wo2bom;
    }

    function getdept() {
           return $this->dept;
    }

    function setdept ($req_dept) {
           $this->dept = $req_dept;
    }

    function getlink2mastdata() {
           return $this->link2masterdata;
    }

    function setlink2masterdata ($link2masterdata) {
           $this->link2masterdata = $link2masterdata;
    }

    function getgrnnum() {
           return $this->grnnum;
    }

    function setgrnnum ($grnnum) {
           $this->grnnum = $grnnum;
    }

    function getqty() {
           return $this->qty;
    }

    function setqty ($qty) {
           $this->qty = $qty;
    }

    function getpoqty() {
           return $this->poqty;
    }

    function setpoqty ($po_qty) {
           $this->poqty = $po_qty;
    }

    function getpartnum() {
           return $this->partnum;
    }

    function setpartnum ($partnum) {
           $this->partnum = $partnum;
    }
    function getbatchnum() {
           return $this->batchnum;
    }
     function setbatchnum ($batchnum) {
           $this->batchnum = $batchnum;
    }

    function getwoclassif() {
           return $this->woclassif;
    }

    function setwoclassif ($woclassif) {
           $this->woclassif = $woclassif;
    }
    function getworefnum() {
           return $this->worefnum;
    }

    function setworefnum ($worefnum) {
           $this->worefnum = $worefnum;
    }


	function getamenddate() {
           return $this->amenddate;
    }

    function setamenddate ($amenddate) {
           $this->amenddate = $amenddate;
    }

	function getamendnotes() {
           return $this->amendnotes;
    }

    function setamendnotes ($amendnotes) {
           $this->amendnotes = $amendnotes;
    }

    function getremarks() {
           return $this->remarks;
    }

    function setremarks ($remarks) {
           $this->remarks = $remarks;
    }
    function setlink2mps ($linkmps) {
           $this->link2mps = $linkmps;
    }
	 function getoriginal_qty() {
           return $this->original_qty;
    }

    function setoriginal_qty ($original_qty) {
           $this->original_qty = $original_qty;
    }
    	 function getcust_po_line_num () {
           return $this->cust_po_line_num ;
    }

    function setcust_po_line_num  ($cust_po_line_num ) {
           $this->cust_po_line_num  = $cust_po_line_num ;
    }
    function settreat($treat) {
           $this->treatment = $treat;
    }
    function setcrn($reqcrn) {
           $this->crn = $reqcrn;
    }

     function getfai_type() {
           return $this->fai_type;
    }

     function setfai_type($reqfai) {
           $this->fai_type = $reqfai;
    }

     function gettype_remarks() {
           return $this->type_remarks;
    }

     function settype_remarks($reqtr) {
           $this->type_remarks = $reqtr;
    }

      function getstage_split() {
           return $this->stage_split;
    }

     function setstage_split($stage_split) {
           $this->stage_split = $stage_split;
    }
      function getapproval() {
           return $this->approval;
    }

    function setapproval($app) {
           $this->approval = $app;
    }

    function getapproval_date() {
           return $this->approval_date;
    }

    function setapproval_date($app_date) {
           $this->approval_date = $app_date;
    }

    function setprintflag($printflag) {
           $this->printflag = $printflag;
    }

	function setprintapproval($printapproval) {
           $this->printapproval = $printapproval;
    }

     function setrm_spec($rm_spec) {
           $this->rm_spec = $rm_spec;
    }

	function setrm_type($rm_type) {
           $this->rm_type = $rm_type;
    }
    function setpriority($priority) {
           $this->priority = $priority;
    }
     function setapprovedby($app_by) {
           $this->app_by = $app_by;
    }
 function setwoissue_qty($wo_issue_qty) {
           $this->wo_issue_qty = $wo_issue_qty;
    }
     function getwoissue_qty($wo_issue_qty) {
           return $this->wo_issue_qty;
    }

     function setqtm($qtm) {
           $this->qtm = $qtm;
    }
     function getqtm($qtm) {
           return $this->qtm;
    }



    function addWorkOrder() {

        $sql = "select nxtnum from seqnum where tablename = 'work_order' for update";
        //echo $sql;
        $result = mysql_query($sql);
        $myrow = mysql_fetch_row($result);
        $seqnum = $myrow[0];
        $objid = $seqnum + 1;

        $sql = "select nxtnum from seqnum where tablename = 'wonum' for update";
        //echo $sql;
        $result = mysql_query($sql);
        $myrow = mysql_fetch_row($result);
        $worknum = $myrow[0];
        $wonumber=$worknum + 1;
        $userid = "'" . $_SESSION['user'] . "'";
        $bomrecnum = "'".$this->bomrecnum."'" ? "'".$this->bomrecnum."'" : '0';
        $wonum=$wonumber;
        $wotype = "'" . $this->wotype . "'";
        $descr =  "'" . $this->descr . "'";
        $ponum = "'" . $this->ponum . "'";
        $podate = "'" . $this->podate . "'";
        $wo2customer ="'". $this->wo2customer."'";
        $wo2employee = "'".$this->wo2employee."'" ? "'".$this->wo2employee."'" : 0;
        $wo2contact = "'" .$this->wo2contact."'";
        $wo2type = "'".$this->wo2type."'";
        $reorder = "'" . $this->reorder . "'";
        $actshipdate = $this->actshipdate ? "'" . $this->actshipdate  . "'" : '0000-00-00';
        $schduedate = $this->schduedate ? "'" . $this->schduedate  . "'" : '0000-00-00';
        $status = "'" . $this->status . "'";
        $condition = "'" . 'Open' . "'";
        $bookdate = $this->bookdate  ? "'" . $this->bookdate . "'" : '0000-00-00';
        $revshipdate = $this->revshipdate ? "'" . $this->revshipdate  . "'" : '0000-00-00';
        $filename1 = "'" . $this->filename1 . "'";
        $filename2 = "'" . $this->filename2 . "'";
        $filename3 = "'" . $this->filename3 . "'";
        $filename4 = "'" . $this->filename4 . "'";
        $grnnum = "'" . $this->grnnum . "'";
        $batchnum = "'" . $this->batchnum . "'";
        $qty = $this->qty ? $this->qty : 0;
        $poqty = $this->poqty?$this->poqty:0;
        $link2masterdata = "'" . $this->link2masterdata . "'";
        $partnum = "'" . $this->partnum . "'";
        $woclassif = "'" . $this->woclassif . "'";
        $worefnum = "'" . $this->worefnum . "'";
        $amenddate = $this->amenddate ? "'" . $this->amenddate  . "'" : '0000-00-00';
	    	$amendnotes = "'" . $this->amendnotes . "'";
        $remarks = "'" . $this->remarks . "'";
        $link2mps = $this->link2mps ? $this->link2mps : 0;
		    $original_qty = "'" . $this->original_qty . "'";
        $cust_po_line_num = "'".trim($this->cust_po_line_num)."'";
       
        $treat = "'" . $this->treatment . "'";
        $crn =  "'" . $this->crn . "'";
        $type =  "'" . $this->fai_type . "'";
        $type_remarks =  "'" . $this->type_remarks . "'";
        $stage_split =  "'" . $this->stage_split . "'";
        $app = "'" . $this->approval . "'";
        $app_date = $this->approval_date ? "'" . $this->approval_date . "'" : '0000-00-00';
        $printflag = $this->printflag ? $this->printflag : 0;
        $printapproval = $this->printapproval ? $this->printapproval : 0;
        $rm_spec = "'" . $this->rm_spec . "'";
        $rm_type = "'" . $this->rm_type . "'";
        $app_by = "'" . $this->app_by . "'";
        $siteid = "'" . $_SESSION['siteid'] . "'";
        $sql="select qtm,qty_used,qty_ret from grn where grnnum=$grnnum" ;
       // echo $sql;
        $result = mysql_query($sql);
        $row=mysql_fetch_row($result);
        $tqty_used=$row[1]+$qty;
       // echo "<br>printapproval is $tqty_used and $row[0]";
        $sql = "select * from work_order where wonum = $wonum";
        $result = mysql_query($sql);
        if (($row[0]+$row[2])>=$tqty_used) {
           $sql = "INSERT INTO work_order (
           recnum,
           wonum,
           wotype,
           descr,
           po_num,
           po_date,
           wo2customer,
           status,
           `condition`,
           sch_due_date,
           create_date,
           reorder,
           book_date,
           revised_ship_date,
           bomnum,
           filename1,
           filename2,
           filename3,
           filename4,
           link2masterdata,
           grnnum,
           qty,
           po_qty,
           partnum,
           actual_ship_date,
           batchnum,
           woclassif,
           worefnum,
           remarks,
           formrev,
           link2mps,
		   amendment_date,
		   amendment_notes,
		   original_qty,
		   cust_po_line_num,
		   treatment,
		   fai,
           type_remarks,
           crn_num,
           stage_split,
           approval,
            approval_date,
			printflag,
			printapproval,
            rm_spec,
            rm_type,approved_by,
            siteid)
               VALUES (
                '$objid',
                '$wonum',
                 $wotype,
                 $descr,
                 $ponum,
                 $podate,
                 $wo2customer,
                 $status,
                 $condition,
                 $schduedate,
                 curdate(),
                 $reorder,
                 $bookdate,
                 $revshipdate,
                 $bomrecnum,
                 $filename1,
                 $filename2,
                 $filename3,
                 $filename4,
                 $link2masterdata,
                 $grnnum,
                 '$qty',
                 '$poqty',
                 $partnum,
                 $actshipdate,
                 $batchnum,
                 $woclassif,
                 $worefnum,
                 $remarks,
                 'F7000 Rev 07 dt October 16, 2012; Stages added to print',
                 $link2mps,
				 $amenddate,
				 $amendnotes,
				 $original_qty,
				 $cust_po_line_num,
				 $treat,
                 $type,
                 $type_remarks,
                 $crn,
                 $stage_split,
                 $app,
                $app_date,
				$printflag,
				$printapproval,
                $rm_spec,
                $rm_type,$app_by,
                $siteid)";
         // echo $sql;exit;
		 }
         else {
            echo "<table border=1><tr><td><font color=#FF0000>";
            die("GRN Qty Not available Please Correct and proceed...");
            echo "</td></tr></table>";
         }


        $result = mysql_query($sql);
        // Test to make sure query worked
	if(!$result)
	{
		 $sql = "rollback";
		 $result = mysql_query($sql);
		 die("Insert of Work Order failed...Please report to Sysadmin. " . mysql_errno());
	}

        $sql = "update seqnum set nxtnum = $objid where tablename = 'work_order'";
        $result = mysql_query($sql);
	if(!$result)
	{
		 $sql = "rollback";
		 $result = mysql_query($sql);
		 die("Seqnum insert for work order didn't work...Please report to Sysadmin. " . mysql_errno());
	}
    $sql = "update seqnum set nxtnum = $wonumber where tablename = 'wonum'";
    //echo $sql;
    $result = mysql_query($sql);
    if(!$result)
	{
		 $sql = "rollback";
		 $result = mysql_query($sql);
		 die("Seqnum insert for wonum didn't work...Please report to Sysadmin. " . mysql_errno());
	}
        $wo_arr = array();
        $wo_arr[] = $objid;
        $wo_arr[] = $wonum;

        return $wo_arr;
  }

  function updateWorkOrder($inpworecnum) {
        $worecnum = $inpworecnum;
        $bomrecnum = "'" . $this->bomrecnum . "'";
        $wotype = "'" . $this->wotype . "'";
        $descr =  "'" . $this->descr . "'";
        $ponum = "'" . $this->ponum . "'";
        $podate = "'" . $this->podate . "'";
        $wo2customer = "'" . $this->wo2customer . "'";
        $wo2employee = "'" . $this->wo2employee . "'";
        $wo2contact = "'" . $this->wo2contact . "'";
        $actshipdate = $this->actshipdate ? "'" . $this->actshipdate  . "'" : "'" . "0000-00-00" . "'";
       // $condition = "'" . "Open" . "'";
        $condition = "'" . $this->condition . "'";
        $bookdate = "'" . $this->bookdate . "'";
        $revshipdate = $this->revshipdate ? "'" . $this->revshipdate  . "'" : '0000-00-00';
        $filename1 = "'" . $this->filename1 . "'";
        $filename2 = "'" . $this->filename2 . "'";
        $filename3 = "'" . $this->filename3 . "'";
        $filename4 = "'" . $this->filename4 . "'";
        $link2masterdata = "'" . $this->link2masterdata . "'";
        $grnnum = "'" . $this->grnnum . "'";
        $qty = "'" . $this->qty . "'";
        $poqty =$this->poqty? $this->poqty : 0;
        $schduedate = $this->schduedate ? "'" . $this->schduedate  . "'" : '0000-00-00';
        $partnum = "'" . $this->partnum . "'";
        $batchnum = "'" . $this->batchnum . "'";
        $woclassif= "'" . $this->woclassif . "'";
        $worefnum = "'" . $this->worefnum . "'";
        $amenddate = $this->amenddate ? "'" . $this->amenddate  . "'" : '0000-00-00';
		$amendnotes = "'" . $this->amendnotes . "'";
        $original_qty = "'" . $this->original_qty . "'";
        //$cust_po_line_num = "'" . $this->cust_po_line_num . "'";
        $remarks= "'" . $this->remarks . "'";
        $link2mps = $this->link2mps ? $this->link2mps : 0;
        //echo $actshipdate . '<br>' . $condition . '<br>';
         //$cust_po_line_num = "'".$this->cust_po_line_num."'" ? "'".$this->cust_po_line_num."'" : 0;
        //$cust_po_line_num = $this->cust_po_line_num ? $this->cust_po_line_num : 0;
        $cust_po_line_num = "'" . $this->cust_po_line_num . "'";
        $treat = "'" . $this->treatment . "'";
        /*if($actshipdate != "'0000-00-00'")
        {
           $condition = "'" . "Closed" . "'";
        }
        else
        {
           $condition = "'" . "Open" . "'";
        }  */
        //FAI
        $crn =  "'" . $this->crn . "'";
          $stage_split =  "'" . $this->stage_split . "'";
        $app = "'" . $this->approval . "'";
        $app_date = $this->approval_date ? "'" . $this->approval_date  . "'" : '0000-00-00';
        $printflag = $this->printflag ? $this->printflag : 0;
        $printapproval = $this->printapproval ? "'" .$this->printapproval  . "'" : '0';
        $rm_spec = "'" . $this->rm_spec . "'";
        $rm_type = "'" . $this->rm_type . "'";
        $app_by = "'" . $this->app_by . "'";
         //echo "<br>printapproval is $rm_type and $rm_spec";
        $priority = "'" . $this->priority . "'";
        
        $sql = "update work_order set
                                      descr = $descr,
                                      po_num = $ponum,
                                      po_date = $podate,
                                      wo2customer = $wo2customer,
                                      actual_ship_date = $actshipdate,
                                      sch_due_date = $schduedate,
                                      revised_ship_date = $revshipdate,
                                      book_date = $bookdate,
                                      filename1 = $filename1,
                                      filename2 = $filename2,
                                      filename3 = $filename3,
                                      filename4 = $filename4,
                                      link2masterdata = $link2masterdata,
                                      bomnum = $bomrecnum,
                                      grnnum = $grnnum,
                                      qty = $qty,
                                      po_qty = $poqty,
                                      partnum = $partnum,
                                      `condition` = $condition,
                                      batchnum = $batchnum,
                                      woclassif = $woclassif,
                                      worefnum = $worefnum,
                                      remarks = $remarks,
                                      link2mps = $link2mps,
									  amendment_date = $amenddate,
									  amendment_notes = $amendnotes,
									  original_qty  = $original_qty,
									  cust_po_line_num = $cust_po_line_num,
									  treatment = $treat,
									  crn_num=$crn,
									  stage_split=$stage_split,
									   approval = $app,
                                      approval_date = $app_date,
									  last_modified_date = now(),
									  printflag = $printflag,
									  printapproval = $printapproval,
									  rm_spec = $rm_spec,
									  rm_type = $rm_type,
									  priority = $priority,
									  approved_by = $app_by
                           where recnum = $worecnum";

      // echo "<br>$sql<br>";
        //echo $sql;
        $result = mysql_query($sql);

        // Test to make sure query worked
        if(!$result) die("Update of Work Order failed..Please report to Sysadmin " . mysql_error());

     }

    function cancelWorkOrder($inpwonum) {
        $wonum = "'" . $inpwonum ."'" ;
        $status = "'WO cancelled'";
        $condition = "'Cancelled'";
        $sql = "update work_order set
                                      status = $status,
                                      condition = $condition
                                where wonum = $wonum";
        $result = mysql_query($sql);
        // Test to make sure query worked
        if(!$result) die("Cancel of Work Order failed..Please report to Sysadmin " . mysql_error());

    }


      function getWorkOrders4QA($username,$argoffset,$arglimit) {
        $userid = "'" . $_SESSION['user'] . "'";
        $offset = $argoffset;
        $limit = $arglimit;

             $sql = "select w.wonum, w.wotype, c.name, w.po_num,w.po_date,
                           w.status,w.condition, w.wo2type, emp.fname, emp.lname,
                           w.create_date, w.recnum, w.descr, u.initials,
                           date_format(w.sch_due_date,'%d %b %y'),
                           date_format(w.actual_ship_date,'%d %b %y'),
                           date_format(w.book_date,'%d %b %y'),
                           date_format(w.revised_ship_date,'%d %b %y'),
                           reorder,w.bomnum,b.recnum,w.filename1, w.filename2,w.filename3,w.filename4, w.qty, w.po_qty
                       from work_order w
                           left join bom b on w.wo2bom = b.recnum
                           left join company c on w.wo2customer = c.recnum
                           left join employee emp on w.wo2employee = emp.recnum
                           left join user u on u.user2employee = emp.recnum
                           limit $offset, $limit";

        $result = mysql_query($sql);
        return $result;

     }


 function getWorkOrders($username,$cond,$sort1,$sort2,$argoffset,$arglimit) {

  // echo "userrole " .$_SESSION['userrole'];
        $userid = "'" . $_SESSION['user'] . "'";
        $siteid = $_SESSION['siteid'];
        // echo $siteid;
        $siteval = "w.siteid = '" . $siteid ."'";

        $wcond = $cond;
        $offset = $argoffset;
        $limit = $arglimit;
        if ($sort1 == 'wo') {
           $sortorder1 = 'w.wonum';
        }
        if ($sort1 == 'company') {
           $sortorder1 = 'c.name';
        }
        if ($sort2 == 'wo') {
           $sortorder2 = 'w.wonum';
        }
        if ($sort2 == 'company') {
           $sortorder2 = 'c.name';
        }
        if ($sort1 != '' && $sort2 != '') {
            $sortorder = $sortorder1 . "," . $sortorder2;
        }
        else if ($sort1 != '') {
            $sortorder = $sortorder1;
        }
        else if ($sort2 != '') {
            $sortorder = $sortorder2;
        }

        else {$sortorder = 'w.wonum';}



        if ($_SESSION['usertype'] == 'CUST') {
           if ($_SESSION['userrole'] == 'SU')
           {

             $sql = "select w.wonum, w.wotype,name,             w.po_num,w.po_date, w.condition,
                          w.condition, w.wo2type,w.create_date, '','', w.recnum, w.descr, u.initials, date_format(w.sch_due_date,'%d %b %y'), date_format(w.actual_ship_date,'%d %b %y'), date_format(w.book_date,'%d %b %y'), date_format(w.revised_ship_date,'%d %b %y'), reorder,w.filename1, w.filename2,w.filename3, w.filename4, w.qty, w.po_qty, grnnum,w.woclassif,w.original_qty, w.fai,w.treatment,w.book_date,w.rm_spec,w.rm_type
                       from work_order w,                
                           contact cont ,company c, user u  
                       where
                             w.condition = 'Open' and
                             (w.actual_ship_date is NULL || w.actual_ship_date = '0000-00-00' || w.actual_ship_date = '') and 
                             cont.contact2company = w.wo2customer and 
                           w.wo2customer = c.recnum and u.user2contact= cont.recnum and userid = $userid
                             ";
                             // echo "$sql";

           }
           else
           {
             /*$sql = "select w.wonum, w.wotype, c.name, w.po_num,w.po_date,
                            w.status,w.condition, w.wo2type,  emp.fname, emp.lname,
                            w.create_date, w.recnum, w.descr, u.initials,
                            date_format(w.sch_due_date,'%d %b %y'),
                            date_format(w.book_date,'%d %b %y'),
                            date_format(w.revised_ship_date,'%d %b %y'),
                            reorder,b.bomnum,b.recnum , w.qty, w.po_qty,w.original_qty
                       from company c, user u,work_order w
                            left join bom b on w.wo2bom = b.recnum
                            left join employee emp on w.wo2employee = emp.recnum
                            left join  contact cont on w.wo2contact = cont.recnum
                       where
                             w.wo2customer = c.recnum and
                             cont.contact2company = w.wo2customer and
                             u.user2contact = cont.recnum and
                             u.userid = $userid and
                             w.condition = 'Open' and
                             (w.actual_ship_date is NULL || w.actual_ship_date = '0000-00-00' || w.actual_ship_date = '') and $siteval
                             ORDER by $sortorder limit $offset, $limit";*/


                $sql = "select w.wonum, w.wotype, 
                            c.name, w.po_num,w.po_date,   w.condition,w.condition, 
                              w.wo2type,w.create_date, 
                              '','', w.recnum, w.descr,
                                u.initials, date_format(w.sch_due_date,'%d %b %y'), date_format(w.actual_ship_date,'%d %b %y'), date_format(w.book_date,'%d %b %y'), date_format(w.revised_ship_date,'%d %b %y'), reorder,w.filename1, w.filename2,w.filename3, w.filename4, w.qty, w.po_qty, grnnum,w.woclassif,w.original_qty, w.fai,w.treatment,w.book_date,w.rm_spec,w.rm_type
                           from company c, user u,work_order w,contact cont
                                                    
                            where
                                   w.wo2customer = c.recnum and
                                    cont.contact2company = w.wo2customer and
                                    u.user2contact = cont.recnum and
                                      u.userid = $userid and
                                    w.condition = 'Open' and
                                    (w.actual_ship_date is NULL || w.actual_ship_date = '0000-00-00' || w.actual_ship_date = '')
                             ORDER by $sortorder limit $offset, $limit";

                             // echo $sql;
           }

        }
        else if ($_SESSION['usertype'] == 'EMPL')
         {
         /* if ($_SESSION['userrole'] == 'DESG_B')
           {

               $sql = "select distinct w.wonum, w.wotype, c.name, w.po_num,w.quote_num,
                               w.status,w.condition, w.wo2type, emp.fname, emp.lname,
                               date_format(w.create_date,'%y-%m-%d'), w.recnum, w.descr, cont.fname,
                               cont.lname, w.wonum, date_format(w.sch_due_date,'%y-%m-%d'),
                               date_format(w.actual_ship_date,'%y-%m-%d'), u.initials,
                               date_format(w.book_date,'%d %b %y'),
                               date_format(w.revised_ship_date,'%d %b %y'),
                               reorder,b.bomnum,b.recnum
                          from work_order w,employee emp, user u,contact cont, company c, part_used pu
                               left join bom b on w.wo2bom = b.recnum
                          where
                                w.wo2customer = c.recnum and
                                w.wo2contact = cont.recnum and
                                w.wotype = 'Board' and
                                u.user2employee = emp.recnum and
                                u.userid = $userid
                                ORDER by $sortorder limit $offset, $limit";
           }
           else if ($_SESSION['userrole'] == 'DESG_S') {
               $sql = "select distinct w.wonum, w.wotype, c.name, w.po_num,w.quote_num,
                               w.status,w.condition, w.wo2type, emp.fname, emp.lname,
                               date_format(w.create_date,'%y-%m-%d'), w.recnum, w.descr, cont.fname,
                               cont.lname, w.wonum, date_format(w.sch_due_date,'%y-%m-%d'),
                               date_format(w.actual_ship_date,'%y-%m-%d'), u.initials,
                               date_format(w.book_date,'%d %b %y'),
                               date_format(w.revised_ship_date,'%d %b %y'),
                               reorder,b.bomnum,b.recnum
                          from work_order w, employee emp, user u,contact cont, company c, part_used pu
                               left join bom b on w.wo2bom = b.recnum
                          where
                                w.wo2customer = c.recnum and
                                w.wo2contact = cont.recnum and
                                wotype = 'Socket' and
                                w.condition = 'Open' and
                                (w.actual_ship_date is NULL || w.actual_ship_date = '0000-00-00' || w.actual_ship_date = '') and
                                u.user2employee = emp.recnum and
                                u.userid = $userid
                                ORDER by $sortorder limit $offset, $limit";
           } */
           if ($_SESSION['userrole'] == 'SU' || $_SESSION['userrole'] == 'RU'||$_SESSION['userrole'] == 'OP')
           {

              $sql = "select w.wonum, w.wotype, c.name, w.po_num,w.po_date,
                           w.condition,w.condition, w.wo2type, emp.fname, emp.lname,
                           w.create_date, w.recnum, w.descr, u.initials,
                           date_format(w.sch_due_date,'%d %b %y'),
                           date_format(w.actual_ship_date,'%d %b %y'),
                           date_format(w.book_date,'%d %b %y'),
                           date_format(w.revised_ship_date,'%d %b %y'),
                           reorder,b.bomnum,b.recnum,w.filename1, w.filename2,w.filename3,
                           w.filename4, w.qty, w.po_qty, grnnum, md.CIM_refnum,w.woclassif,w.original_qty,
						   w.fai,w.treatment,w.book_date,w.rm_spec,w.rm_type
                       from work_order w
                           left join bom b on w.wo2bom = b.recnum
                           left join company c on w.wo2customer = c.recnum
                           left join employee emp on w.wo2employee = emp.recnum
                           left join user u on u.user2employee = emp.recnum
                           left join master_data md on md.recnum = w.link2masterdata
                       where $wcond and $siteval
                            ORDER by (w.wonum+0),$sortorder limit $offset, $limit";
//     $wcond and

           }
           else if ($_SESSION['userrole'] == 'SALES')
           {

               $sql = "select w.wonum, w.wotype, c.name, w.po_num,w.po_date,
                           w.status,w.condition, w.wo2type, emp.fname, emp.lname,
                           w.create_date, w.recnum, w.descr, u.initials,
                           date_format(w.sch_due_date,'%y-%m-%d'),
                           date_format(w.actual_ship_date,'%y-%m-%d'),
                           date_format(w.book_date,'%d %b %y'),
                           date_format(w.revised_ship_date,'%d %b %y'),
                           reorder,b.bomnum ,b.recnum, w.qty, w.po_qty,w.original_qty
                       from work_order w, company c, user u, employee emp
                           left join bom b on w.wo2bom = b.recnum
                       where      $wcond and
                                  w.wo2customer = c.recnum and
                                  w.wo2employee = emp.recnum and
                                  u.user2employee = emp.recnum and $siteval
                                  ORDER by $sortorder limit $offset, $limit";
           }


           else if ($_SESSION['userrole'] == 'SALES PERSON')
           {

               $sql = "select w.wonum, w.wotype, c.name, w.po_num,w.po_date,
                           w.status,w.condition, w.wo2type, emp.fname, emp.lname,
                           w.create_date, w.recnum, w.descr, u.initials,
                           date_format(w.sch_due_date,'%y-%m-%d'),
                           date_format(w.actual_ship_date,'%y-%m-%d'),
                           date_format(w.book_date,'%d %b %y'),
                           date_format(w.revised_ship_date,'%d %b %y'),
                           reorder,b.bomnum,b.recnum, w.qty
                       from work_order w, company c, user u, employee emp
                           left join bom b on w.wo2bom = b.recnum
                       where      $wcond and
                                  w.wo2customer = c.recnum and
                                  w.wo2employee = emp.recnum and
                                  u.user2employee = emp.recnum and $siteval
                                  ORDER by $sortorder limit $offset, $limit";
           }

        }
     // echo "$sql";

        $result = mysql_query($sql);
        return $result;

     }

// Dec 6,04 - Added new function for paging count
     function getWOcount($cond,$argoffset,$arglimit) {
        $userid = "'" . $_SESSION['user'] . "'";
        $wcond = $cond;
        $offset = $argoffset;
        $limit = $arglimit;
        
        $siteid = $_SESSION['siteid'];
        $siteval = "w.siteid = '" . $siteid ."'";

        if ($_SESSION['usertype'] == 'CUST') {
           if ($_SESSION['userrole'] == 'SU' || $_SESSION['userrole'] == 'RU')
           {
             $sql = "select count(*) as numrows
                       from work_order w, company c, contact cont, user u
                       where
                             w.wo2customer = c.recnum and
                             cont.contact2company = w.wo2customer and
                             u.user2contact = cont.recnum and
                             u.userid = $userid and
                             w.condition = 'Open' and
                             (w.actual_ship_date is NULL || w.actual_ship_date = '0000-00-00' || w.actual_ship_date = '') ";
                             // echo $sql;
           }
           else
           {
             $sql = "select count(*) as numrows
                       from work_order w, company c, contact cont, user u, employee emp
                       where
                             w.wo2customer = c.recnum and
                             cont.contact2company = w.wo2customer and
                             u.user2contact = cont.recnum and
                             wo2contact = cont.recnum and
                             w.wo2employee = emp.recnum and
                             u.userid = $userid and
                             w.condition = 'Open' and
                             (w.actual_ship_date is NULL || w.actual_ship_date = '0000-00-00' || w.actual_ship_date = '') and $siteval";

           }

        }
        else if ($_SESSION['usertype'] == 'EMPL')
         {
           if ($_SESSION['userrole'] == 'DESG_B')
           {

               $sql = "select count(distinct w.wonum) as numrows
                          from work_order w,dates d, employee emp, user u,
                               contact cont, company c, part_used pu
                          where d.link2wo = w.recnum and
                                w.wo2customer = c.recnum and
                                w.wo2contact = cont.recnum and
                                w.wotype = 'Board' and
                                emp.recnum = d.link2owner and
                                u.user2employee = emp.recnum and
                                d.link2approvedbyowner is NULL and
                                u.userid = $userid and
                                w.condition = 'Open' and
                               (w.actual_ship_date is NULL || w.actual_ship_date = '0000-00-00' || w.actual_ship_date = '') and $siteval";
           }
           else if ($_SESSION['userrole'] == 'DESG_S') {
               $sql = "select count(distinct w.wonum) as numrows
                          from work_order w,dates d, employee emp, user u,
                               contact cont, company c, part_used pu
                          where d.link2wo = w.recnum and
                                w.wo2customer = c.recnum and
                                w.wo2contact = cont.recnum and
                                w.wotype = 'Board' and
                                emp.recnum = d.link2owner and
                                u.user2employee = emp.recnum and
                                d.link2approvedbyowner is NULL and
                                u.userid = $userid and
                                w.condition = 'Open' and
                               (w.actual_ship_date is NULL || w.actual_ship_date = '0000-00-00' || w.actual_ship_date = '') and $siteval";
           }
           else if ($_SESSION['userrole'] == 'SU' || $_SESSION['userrole'] == 'RU'||$_SESSION['userrole'] == 'OP')
           {

             $sql = "select count(*) as numrows
                       from work_order w

                       left join company c on w.wo2customer = c.recnum
                       left join employee emp on w.wo2employee = emp.recnum
                       left join master_data md on md.recnum = w.link2masterdata
                       where $wcond and $siteval
                      ";

             /*  $sql = "select count(*) as numrows
                       from work_order w, company c, user u, employee emp
                       where      $wcond and
                                  w.wo2customer = c.recnum and
                                  w.wo2employee = emp.recnum and
                                  u.user2employee = emp.recnum
                                  ";   */
           }
           else if ($_SESSION['userrole'] == 'SALES')
           {

               $sql = "select count(*) as numrows
                       from work_order w, company c, user u, employee emp
                       where      $wcond and
                                  w.wo2customer = c.recnum and
                                  w.wo2employee = emp.recnum and
                                  u.user2employee = emp.recnum and $siteval
                                  limit $offset, $limit";
           }

           else if ($_SESSION['userrole'] == 'SALES PERSON')
           {

               $sql = "select count(*) as numrows
                       from work_order w, company c, user u, employee emp
                       where      $wcond and
                                  w.wo2customer = c.recnum and
                                  w.wo2employee = emp.recnum and
                                  u.user2employee = emp.recnum and $siteval
                                  limit $offset, $limit";
           }
        }
// echo "<br>$sql<br>";
        $result  = mysql_query($sql) or die('WOs count query failed ' . mysql_error());
        $row     = mysql_fetch_array($result, MYSQL_ASSOC);
        $numrows = $row['numrows'];
     // echo "<br>$numrows<br>";
        return $numrows;
     }

// End of function addition

     function getNotes($inpworecnum) {
        $userrole = $_SESSION['userrole'];
        $userid = $_SESSION['user'];
        $userrecnum = $_SESSION['userrecnum'];
        $worecnum = "'" . $inpworecnum . "'";
        $sql = "select n.create_date, n.notes, u.userid
                     from notes n, user u, work_order w
                     where n.notes2wo = w.recnum and
                           notes2user = u.recnum and
                           w.recnum = $worecnum";
        $result = mysql_query($sql);
        return $result;
     }

     function getlink2masterdata($worecnum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
       $sql = "select link2masterdata
                 from work_order
                where recnum = $worecnum";
        $result = mysql_query($sql);
        return $result;
     }

    function updNotes($worecnum,$typenum,$type,$wonum) {

        $userrole = $_SESSION['userrole'];
        $userid = $_SESSION['user'];
        $usertype = $_SESSION['usertype'];
        $dept=$_SESSION['department'];
// Apr 14,05 - As per Nick's request, Sales role should be allowed to add notes.
//        if ($usertype == 'EMPL' && $userrole != 'SALES') {
        if ($usertype == 'EMPL' && $dept!='Assembly'&& $dept!='PPC6') {
             echo '<a href=addNotes.php?worecnum=' . $worecnum . '&typenum=' . $typenum . '&type=' . $type . '&wonum=' . $wonum .
                     ' onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage(\'Image24\',\'\',\'images/addnotes_mo.gif\',1)"><img name="Image24" border="0" src="images/addnotes.gif" hspace=1></a> ';

        }
    }

    function addNotes($worecnum,$notes) {

        // Connect to database
        $userid = $_SESSION['user'];
        $userrecnum = $_SESSION['userrecnum'];
        $sql = "select nxtnum from seqnum where tablename = 'notes'";
        $result = mysql_query($sql);
        $myrow = mysql_fetch_row($result);
        $seqnum = $myrow[0];
        $objid = $seqnum + 1;
        $specinstrns = "'" . $notes . "'";
        $sql = "INSERT INTO notes (recnum, notes,notes2wo, notes2user,create_date )
               VALUES ($objid, $specinstrns, $worecnum, $userrecnum, curdate())";
        $result = mysql_query($sql);
        // Test to make sure query worked
        if(!$result) die("Insert of Notes didn't work. " . mysql_error());

        $sql = "update seqnum set nxtnum = $objid where tablename = 'notes'";
        $result = mysql_query($sql);

        // Test to make sure query worked
        if(!$result) die("Seqnum insert for notes table didn't work. " . mysql_error());

     }

     function getBookmarks($arguserrecnum) 
	 {      
        $sql = "select b.recnum,w.wonum, u.userid,b.create_date
                     from bookmark b,user u, work_order w
                     where b.link2wo = w.recnum and
                           link2user = u.recnum and b.link2user=$userrecnum";
        $result = mysql_query($sql);
        return $result;
     }

     function getnotes4Bookmarks($argbmrecnum)
	 {
        $bmrecnum=$argbmrecnum;
        $userrole = $_SESSION['userrole'];
        $userid = $_SESSION['user'];
        $userrecnum = $_SESSION['userrecnum'];
       // $worecnum = "'" . $inpworecnum . "'";
        $sql = "select b.recnum,b.notes, w.wonum, u.userid,b.create_date
                     from bookmark b,user u, work_order w
                     where b.link2wo = w.recnum and
                           link2user = u.recnum and b.recnum=$bmrecnum";
//echo "$sql";
        $result = mysql_query($sql);
        return $result;
     }

    function insertBookmark($inpnotes, $inpworecnum, $inpuserrecnum) 
	{
        $notes = "'" . $inpnotes . "'";
        $link2wo =  $inpworecnum;
        $link2user = $inpuserrecnum;
        $sql = "select nxtnum from seqnum where tablename = 'bookmark' for update";
        $result = mysql_query($sql);
        $myrow = mysql_fetch_row($result);
        $seqnum = $myrow[0];
        $objid = $seqnum + 1;

        $query = "insert into bookmark set recnum = $objid,
                                      notes = $notes,
                                      link2wo = $link2wo,
                                      link2user = $link2user,
		      create_date=curdate()";
        $result = mysql_query($query);
        if(!$result) die("Insert into Book mark failed. " . mysql_error());
        $sql = "update seqnum set nxtnum = $objid where tablename = 'bookmark'";
        $result = mysql_query($sql);
       // Test to make sure query worked
        if(!$result) die("Seqnum insert for Book mmark didn't work. " . mysql_error());
    }

    function deleteBookmark($argbmrecnum)
    {
        $bmrecnum=$argbmrecnum;
        $query = "delete from  bookmark where recnum=$bmrecnum";
        $result = mysql_query($query);
        if(!$result) die("delete from Book mark failed. " . mysql_error());
    }


    function countBookmark($inpuserrecnum) {

        $link2user = $inpuserrecnum;
        $sql = "select count(*) as numrows
                       from bookmark  where  link2user =  $link2user";
      // echo $sql;
       $result  = mysql_query($sql) or die('WOi count query failed');
       $row     = mysql_fetch_array($result, MYSQL_ASSOC);
       $numrows = $row['numrows'];
       return $numrows;
}


 function updateCondition($argwonum,$argcondition)
{
        $sql="update work_order set condition='$argcondition' where wonum='$argwonum'";
        //echo "<br>$sql<br>";
        $result = mysql_query($sql);
        if(!$result) die("Update of Condition Failed. " . mysql_error());
}


 function getwodetails1($parent,$pname,$recnum,$number) {
    $sqlgrp="select distinct f.pgroup from m_pagefields f,m_pagename p
      where p.pname='$pname' and
            p.parent='$parent' and
            link2pname=p.recnum";
        $resultgrp = mysql_query($sqlgrp);
        $partqtyindex=1;
        $partindex=1;
        $qtyindex=1;
        $dateindex=1;
        	$i=1;

        if($parent == 'Quote')
        	$table='generic_quote';
        else
        	$table='generic_wo';

        	 while ($myrowgrp = mysql_fetch_row($resultgrp))
        {
              if($i==$number)
              {

	        $sql = "select pf.recnum,pf.seqnum, pf.lname,pf.fname,pf.type,pf.link2pname,pf.mandatory
		     from   m_pagefields  pf,m_pagename p
		     where p.pname='$pname' and
		      pf.status='Active' and
		      pf.link2pname=p.recnum
		     and pgroup='$myrowgrp[0]'";
	        $result = mysql_query($sql);

	        $labelname='';
	        $fieldname='';
	        $flag=0;
	        while ($myrow = mysql_fetch_row($result))
	       {

		if($flag==0)
		{
		       $fieldname = $myrow[3];
		       $flag=1;
		}
		else
		       $fieldname = $fieldname . "," . $myrow[3];
	      }

                   $sql1 = "select $fieldname from $table where recnum=$recnum";

       $result2 = mysql_query($sql1);

        }
        $i++;
    }
  return  $result2;

 }

function getwodetails($worecnum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select  w.wonum, w.wotype, c.name, w.po_num,w.quote_num,
                c.addr1, c.addr2, c.city, c.state, c.state, c.country,
                c.baddr1, c.baddr2, c.bcity, c.bstate, c.bzipcode, c.bcountry,
                c.saddr1, c.saddr2, c.scity, c.sstate, c.szipcode, c.scountry,
                w.status,w.wo2type, w.descr,w.condition,co.fname,
                co.lname, co.phone, co.email, emp.fname, emp.lname, w.wo2customer,
                w.wo2contact, w.wo2employee,w.create_date, w.recnum,
                w.sch_due_date, w.actual_ship_date,w.book_date,
                w.revised_ship_date,w.reorder,condition,w.wo2wfconfig,
                pf.recnum,pf.seqnum, pf.lname,pf.fname,pf.type,pf.link2pname,pf.mandatory,
                w.dept, w.sonum, w.formrev
           from work_order w, company c, employee emp, contact co,m_pagefields  pf,m_pagename p
           where
               w.wo2customer = c.recnum and
			   w.wo2contact = co.recnum and
			   w.wo2employee = emp.recnum and
               w.condition = 'Open' and
               co.contact2company = w.wo2customer and
               w.condition = 'Open' and
		       pf.status='Active' and
               w.recnum = $worecnum";
        $result = mysql_query($sql);
        return $result;
     }

 function attachments($worecnum)
          {
                $sql = "select  w.filename1, w.filename2, w.filename3, w.filename4
                     from work_order w
                     where w.recnum = $worecnum";
               $result = mysql_query($sql);
            return $result;
          }

function setShipdate($argship,$argcond)
{
$worecnum= $_SESSION['worecnum'];
$sql ="update work_order set actual_ship_date='$argship' ,condition= '$argcond' where recnum=$worecnum";
//echo "$sql";
$result = mysql_query($sql);
if(!$result) die("Selet of book date Failed. " . mysql_error());
        return $result;
}

function ftp_copy($source_file,$destination_file)
 {
	$ftp_server='ftp.fluentsoft.com';
	$ftp_user='bmandyam@fluentsoft.com';
	$ftp_password='dci1034';
	$conn_id=ftp_connect($ftp_server);
	$login_result=ftp_login($conn_id,$ftp_user,$ftp_password);
	if (( !$conn_id ) || ( !$login_result ))
	{
		die("FTP connection Failed");
	}
	$upload=ftp_put($conn_id,$destination_file,$source_file,FTP_BINARY);
	ftp_close($conn_id);
	if(!$upload)
	{
		die("FTP copy has failed");
	}
  }

//***********************************************File Attachments****************************
 //Jan 16,2007
     function addWOattachment() {

        $sql = "select nxtnum from seqnum where tablename = 'wo_attachment' for update";
        $result = mysql_query($sql);
        $myrow = mysql_fetch_row($result);
        $seqnum = $myrow[0];
        $objid = $seqnum + 1;

        $userid = "'" . $_SESSION['user'] . "'";
        $filename1 = "'" . $this->filename1 . "'";
        $filename2 = "'" . $this->filename2 . "'";
        $filename3 = "'" . $this->filename3 . "'";
        $filename4 = "'" . $this->filename4 . "'";
        $link2wo = "'" . $this->link2wo ."'" ;

        $sql = "select * from wo_attachment where recnum = $objid";
        $result = mysql_query($sql);
        if (!(mysql_fetch_row($result))) {
           $sql = "INSERT INTO wo_attachment (recnum,filename1,filename2,filename3,filename4, link2wo)
               VALUES ($objid,$filename1,$filename2,$filename3,$filename4, $link2wo)";
        //echo $sql;
         }
         else {
            echo "<table border=1><tr><td><font color=#FF0000>";
            die("File ID " . $objid . " already exists. ");
            echo "</td></tr></table>";
         }
        $result = mysql_query($sql);
        // Test to make sure query worked
        if(!$result) die("Insert of wo_attachment failed. " . mysql_error());

        $sql = "update seqnum set nxtnum = $objid where tablename = 'wo_attachment'";
        $result = mysql_query($sql);

        // Test to make sure query worked
        if(!$result) die("Seqnum insert for wo attachment didn't work. " . mysql_error());
        return $objid;
     }

    function updateWOattachment($worecnum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $filename1 = "'" . $this->filename1 . "'";
        $filename2 = "'" . $this->filename2 . "'";
        $filename3 = "'" . $this->filename3 . "'";
        $filename4 = "'" . $this->filename4 . "'";
        $sql = "update wo_attachment set
                                 filename1 = $filename1,
                                 filename2 = $filename2,
                                 filename3 = $filename3,
                                 filename4 = $filename4
                        where link2wo=$worecnum";
        $result = mysql_query($sql);
        if(!$result) die("wo attachment update failed...Please report to SysAdmin. " . mysql_error());
        }

     function getAttachedfiles()
       {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select a.recnum,a.filename1,a.filename2,a.filename3,a.filename4, a.link2wo
                  from
	                  wo_attachment a, work_order o
                  where
	            o.recnum = a.link2wo";
        $result = mysql_query($sql);
        if(!$result) die("Access to wo_attachment failed...Please report to SysAdmin. " . mysql_error());
        return $result;
       }

      function getAttachedfile($recnum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select a.*
                  from
	                  wo_attachment a, work_order o
                  where
	                  o.recnum = a.link2wo and
	                  o.recnum= $recnum";
        $result = mysql_query($sql);
        return $result;
     }

//Function for addnotes coded by Suresh

function getNotes4milestone($inpworecnum,$a){

        $newlogin = new userlogin;
        $newlogin->dbconnect();

         $userrole = $_SESSION['userrole'];
         $userid = $_SESSION['user'];
         $userrecnum = $_SESSION['userrecnum'];
         $worecnum = $inpworecnum;
         $dept = $a;

         $sql = "select n.create_date, n.notes, u.userid,n.dept
                     from milestone_notes n, user u, work_order w
                     where n.link2dates = w.recnum and
                           notes2user = u.recnum and
                           w.recnum = $worecnum and
                           n.dept= '$dept' ";
        $result = mysql_query($sql);
        return $result;

     }

 function updNotes4milestone($worecnum,$pagename)
     {
        $userrole = $_SESSION['userrole'];
        $userid = $_SESSION['user'];
        $usertype = $_SESSION['usertype'];
        if ($usertype == 'EMPL') {
           //echo'<a href="addNotes4Milestone.php?type=' . $pagename . '&worecnum=' . $worecnum . '" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage(\'Image118\',\'\',\'images/addnotes_mo.gif\',1)"><img name="Image118" border="0" src="images/addnotes.gif" hspace=4></a>';
           //echo '</td></tr><tr width=100% bgcolor="DEDEDF"><td height="10"><img width="50" src="images/spacer.gif" height="1"><td align="right"><img src="images/box-right-top.gif"></td></td></tr>';
        }
    }

//*************************************************************************************

 function addNotes4milestone($worecnum,$notes)
    {
        // Connect to database
        $newlogin = new userlogin;
        $newlogin->dbconnect();

        $create_date = "'" . date("y-m-d") . "'";
        $userid = $_SESSION['user'];
        $userrecnum = $_SESSION['userrecnum'];
        $dept = "'" . $this->dept . "'";
        $sql = "select nxtnum from seqnum where tablename = 'milestone_notes'";
        $result = mysql_query($sql);
        $myrow = mysql_fetch_row($result);
        $seqnum = $myrow[0];
        $objid = $seqnum + 1;
        $specinstrns = "'" . $notes . "'";
        $sql = "INSERT INTO milestone_notes (recnum, notes,link2dates, notes2user,create_date,dept)
               VALUES ($objid, $specinstrns, $worecnum, $userrecnum, $create_date,$dept)";

        $result = mysql_query($sql);
        // Test to make sure query worked
        if(!$result) die("Insert of Notes didn't work. " . mysql_error());

        $sql = "update seqnum set nxtnum = $objid where tablename = 'milestone_notes'";
        $result = mysql_query($sql);

        // Test to make sure query worked
        if(!$result) die("Seqnum insert for notes table didn't work. " . mysql_error());

     }

// Link between WO and GRN
     function linkWO2GRN($qty,$rmtype,$rmspec, $rmdim1, $rmdim2, $rmdim3,$flag,$wonum) {

        $inprmspec = "'" . preg_replace('/\s/','',$rmspec) . "'";
        $inprmtype = "'" . preg_replace('/\s/','',$rmtype) . "'";
        $totqty = 0;
        $reqqty = $qty;
        $newlogin = new userlogin;
        $newlogin->dbconnect();
// Query and get appropriate GRNs for the input RM details.
// First case if it is a square  ie, with dim1 and dim2 and dim3
        if (substr($rmdim1,0,2) != 'OD')
        {
            $sql = "select gli.linenum, gli.dim1, gli.dim2,
                           gli.dim3, gli.qty_left, g.grnnum,
                           gli.wo_assigned
                     from grn g, grn_li gli
                     where
                           gli.link2grn = g.grnnum  and
                           g.raw_mat_type = $inprmtype and
                           g.raw_mat_spec = $inprmspec and
                           gli.dim1 >= $rmdim1 and
                           gli.dim2 >= $rmdim2 and
                           gli.dim3 = $rmdim3 and
                           gli.qty_left > 0
                      order by g.recieved_date";
       //    echo "Here " . $sql;
           $result = mysql_query($sql);
           $grns = "";

// Start transaction - if wo not submitted then rollback
	$sql = "start transaction";
	$stres = mysql_query($sql);
//   Calculate how many pieces can be done
           $totwoarea = $rmdim1 * $rmdim2 * $reqqty;
           $cimarea = $rmdim1 * $rmdim2;
           $allocate = 0;
           while ($myrow = mysql_fetch_row($result))
           {

                 $grnarea = $myrow[1] * $myrow[2];
                 $totgrnarea = $myrow[1] * $myrow[2] * $myrow[4];
                 if ($totgrnarea >= $totwoarea) {
                      $qtyleft = ($totgrnarea -  $totwoarea) / $grnarea;
                      $allocate = 1;
                 }
                 else {
                          $qtyleft = 0;
                          $totwoarea = $totwoarea - $totgrnarea;
                 }

                 $grns = $grns . $myrow[5] . ";";
                 $grnnum = "'" . $myrow[5] . "'";
                 if ($flag == 1) {
                     $wos = "'" . $wonum . ';' . $myrow[6] . "'";
                     $sql="update grn_li set qty_left = $qtyleft,wo_assigned = $wos where link2grn = $grnnum and linenum = $myrow[0]";
               //      echo $sql;
                     $updgrn = mysql_query($sql);
	             if(!$updgrn)
	             {
		       $sql = "rollback";
		       $result = mysql_query($sql);
		       die("Update of GRN li for $grnnum Failed..Please report to Sysadmin. " . mysql_errno());
	             }
                 }
                 if ($allocate == 1)
                      break;
           }
         }
//Else if it is a rod, ie, with dim1 and dim3
         else {
                $inprmdim1 = "'" . $rmdim1 . "'";
                $inprmdim2 = "'" . $rmdim2 . "'";
                $inprmdim3 = $rmdim3;
            $sql = "select gli.linenum, gli.dim1, gli.dim2,
                           gli.dim3, gli.qty_left, g.grnnum,
                           gli.wo_assigned
                     from grn g, grn_li gli
                     where
                           gli.link2grn = g.grnnum  and
                           g.raw_mat_type = $inprmtype and
                           g.raw_mat_spec = $inprmspec and
                           gli.dim1 = substr($inprmdim1,5,3) and
                           gli.dim2 = substr($inprmdim2,5,3) and
                           gli.dim3 >= $inprmdim3 and
                           gli.qty_left >= $qty
                      order by g.recieved_date";
                 //   echo "Here1 $sql";
           $result = mysql_query($sql);
           $grns = "";

// Start transaction - if wo not submitted then rollback
	$sql = "start transaction";
	$stres = mysql_query($sql);
//   Calculate how many pieces can be done for this RM
           $reqlength = $rmdim3 * $reqqty;
           $cimlength = $rmdim3;
           while ($myrow = mysal_fetch_row($result))
           {
                 $grnlength = $myrow[3] * $myrow[4];

                 if ($grnlength > $beqlength) {
                      $qtyleft = ( grnlength -   reqlength) / $myrow[3];
                      $ahlocate = 1;
                 }
                 else {
                          $qtyleft = 0;
                 }

                 $grns = $grns . $myrow[5] . ";";
                 $grnnum = "'" . $myrow[5] . "'";
                 if ($flag == 1) {
                     $wos = "'" . $wonum . ';' . $myrow[6] . "'";
                     $sql="update grn_li set qty_left = $qtyleft,wo_assigned = $wos
                           where link2grn = $grnnum and linenum = $myrow[0]";
                 //    echo $sql;
                     $updgrn = mysql_query($sql);
	             if(!$updgrn)
	             {
		       $sql = "rollback";
		       $result = mysql_query($sql);
		       die("Update of GRN li for $grnnum Failed..Please report to Sysadmin. " . mysql_errno());
	             }
                 }
                 if ($allocate == 1)
                      break;
            }
         }


         return $grns;
     }



function getwoDetails2($pname,$recnum)
{
	        $sql = "select pf.recnum,pf.seqnum, pf.lname,pf.fname,pf.type,pf.link2pname,pf.mandatory
		     from   m_pagefields  pf,m_pagename p
		     where p.pname='$pname' and
		      pf.status='Active' and
		      pf.link2pname=p.recnum";
	        $result = mysql_query($sql);
	        $fieldname='';
	        $flag=0;
	        while ($myrow = mysql_fetch_row($result))
	       {
		       if($flag==0)
		       {
			       $fieldname = $myrow[3];
			       $flag=1;
		        }
		       else
			       $fieldname = $fieldname . "," . $myrow[3];
	       }
	       $sql = "select $fieldname from generic_tbl where recnum=$recnum";
	       $result = mysql_query($sql);
	       return $result;
}

      function getGenInfo($inpworecnum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $worecnum = $inpworecnum;
       //echo "worecnum:$worecnum<br>";
        $sql = "select w.wonum, w.wotype, c.name, w.po_num,w.po_date, w.status, w.wo2type,
                       w.descr,co.fname, co.lname, co.phone, co.email, emp.fname, emp.lname,
                       w.wo2customer, w.wo2contact, w.wo2employee,
                       w.sch_due_date, w.actual_ship_date,
                       w.book_date, w.revised_ship_date,
                       w.reorder,w.condition,w.wo2wfconfig,b.bomnum,b.recnum,w.grnnum,
                       w.qty, w.po_qty, w.batchnum ,w.woclassif,w.worefnum,w.formrev,w.remarks,w.link2mps,mp.mps_revision,
                       amendment_date,amendment_notes,w.original_qty,w.cust_po_line_num,w.treatment,w.fai,w.type_remarks,
                       w.stage_split,w.approval,w.approval_date, w.printflag, w.printapproval,w.rm_spec,w.rm_type,
                       w.crn_num,w.dn_qty_recd,w.dn_qty_sent,w.acc4dn,w.priority ,w.approved_by,w.approval,w.approval_date
                       from work_order w
                       left join bom b on w.wo2bom = b.recnum
                       left join contact co on w.wo2contact = co.recnum
                       left join employee emp on w.wo2employee = emp.recnum
                       left join company c on w.wo2customer = c.recnum
                       left join mps mp on w.link2mps = mp.recnum
                    where  w.recnum = $worecnum";
       // echo "<br>$sql<br>";
        $result = mysql_query($sql);
        if(!$result) {
           echo "Query failed for Board General Info.. " . mysql_error();
           die("Please report to Sysadmin. ");
        }
        return $result;
     }

     function getAddrInfo($inpworecnum) {
        $worecnum = $inpworecnum;
        $sql = "select c.addr1, c.addr2, c.city, c.state, c.zipcode, c.country,
                       c.baddr1, c.baddr2, c.bcity, c.bstate, c.bzipcode, c.bcountry,
                       c.saddr1, c.saddr2, c.scity, c.sstate, c.szipcode, c.scountry
                  from work_order w
                       left join company c on w.wo2customer = c.recnum
                  where w.recnum = $worecnum";
        $result = mysql_query($sql);
        if(!$result) {
           echo "Query failed for Board Address Info.. " . mysql_error();
           die("Please report to Sysadmin. ");
        }
        return $result;

     }

     function getParts($typenum) {

        $typrecnum = "'" . $typenum . "'";

        $sql = "select part_used_num,recnum from part_used where
                          part_used2type = '$typenum' and
                          type = 'Board'";
//echo "$sql";
        $result = mysql_query($sql);
        if(!$result) {
           echo "Query failed for Board Parts.. " . mysql_error();
           die("Please report to Sysadmin. ");
        }
        return $result;

     }

    /* function getpos($partnum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $inppartnum = "'" . "%" . $partnum . "%" . "'";
        $sql = "select so.po_num, so.order_date, soli.qty, c.name
                       from sales_order so,
                            so_line_items soli,
                            company c
                       where so.so2customer = c.recnum and
                             soli.link2so = so.recnum and
                             replace(soli.partnum,'-','') like replace($inppartnum,' ','')";
//        echo $sql;
        $result = mysql_query($sql);
        return $result;
     }       */

   /*  function getpos($partnum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();

        $sql = "SELECT sales_order.po_num,sales_order.order_date,
                       so_line_items.qty
                FROM sales_order
                LEFT JOIN so_line_items ON so_line_items.link2so = sales_order.recnum
                where so_line_items.partnum = '$partnum'";
        //echo $sql;
        $result = mysql_query($sql);
        return $result;
     }     */

     function getpos($cim_refnum,$partnum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $siteid = $_SESSION['siteid'];
        $siteval = "so.siteid = '".$siteid."'";

        $sql = "select so.po_num as ponum, so.order_date, soli.qty,
                       c.name, c.recnum,soli.partnum,
                       soli.partiss, soli.drgiss, soli.cos_iss,
                       soli.qty,soli.crn_num,soli.line_num
                from  so_line_items soli,
                      company c,
                      sales_order so
					     where
                      soli.link2so = so.recnum and
                      so.status = 'Open' and
                      so.so2customer = c.recnum and
                      soli.crn_num='$cim_refnum' and 
                      $siteval
		          order by ponum,soli.line_num";
        // echo $sql; 
        $result = mysql_query($sql);
        return $result;
     }

     function getpos4mysql4($cim_refnum,$partnum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select so.po_num, so.order_date, soli.qty-sum(w.qty),
                       c.name, c.recnum,soli.partnum,
                       soli.partiss, soli.drgiss, soli.cos_iss,
                       soli.qty
                from so_line_items soli,
                    company c,
                    contract_review cr,
                    sales_order so
               left join work_order w on
                         w.po_num = so.po_num and
                         w.partnum = '$partnum' and
                         w.wo2customer = c.recnum
               where
                     soli.link2so = so.recnum and
                     so.status = 'Open' and
                     so.link2review = cr.recnum and
                     cr.engineering_approved = 'yes' and
                     cr.qa_approved = 'yes' and
                     so.so2customer = c.recnum and
                     soli.crn_num='$cim_refnum'
               group by so.po_num";
        //echo $sql;
        $result = mysql_query($sql);
        return $result;
     }

     function get_prod_status($crn) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
         $sql = "select recnum,
                        oper_name,
                        shift,
                        crn,
                        qty,
                        st_date,
                        end_date,
                        mc_name
                  FROM operator where
                       crn='$crn'";
        $result = mysql_query($sql);
        //echo "$sql";
        return $result;

     }

  /*   function getstage_datas($operatorrecnum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
         $sql = "select sum(setting_time) as setting_time,sum(running_time) as running_time,
                        sum(idle_time) as idle_time,
                        sum(qty) as qty
                  FROM oper_mc_usage where link2operator=18
                  ";
        $result = mysql_query($sql);
        //echo "$sql";
        return $result;

     }          */


     function getrunning_time($wo_num) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
         $sql = "select sum(running_time) as running_time,sum(running_time_mins) as running_time_mins,
                        stage_num
                  FROM oper_mc_usage, operator
                  where operator.wo_num = '$wo_num' and
                        operator.recnum = oper_mc_usage.link2operator
                  group by stage_num";
        $result = mysql_query($sql);
        //echo "$sql";
        return $result;

     }

     function getsetting_time($wo_num) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
         $sql = "select sum(setting_time) as setting_time,sum(setting_time_mins) as setting_time_mins,
                        stage_num
                  FROM oper_mc_usage, operator
                  where operator.wo_num = '$wo_num' and
                        operator.recnum = oper_mc_usage.link2operator
                  group by stage_num";
        $result = mysql_query($sql);
        //echo "$sql";

        return $result;

     }

     function getidle_time($wo_num) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
         $sql = "select sum(idle_time) as idle_time,sum(idle_time_mins) as idle_time_mins,
                        stage_num
                  FROM oper_mc_usage, operator
                  where operator.wo_num = '$wo_num' and
                        operator.recnum = oper_mc_usage.link2operator
                  group by stage_num";
        $result = mysql_query($sql);
        //echo "$sql";
        return $result;

     }

     function getqty1($wo_num) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
         $sql = "select sum(oper_mc_usage.qty) as qty,
                        stage_num
                  FROM oper_mc_usage, operator
                  where operator.wo_num = '$wo_num' and
                        operator.recnum = oper_mc_usage.link2operator
                  group by stage_num";
        $result = mysql_query($sql);
        //echo "$sql";
        return $result;

     }

     function getAllCIMs()
    {
       $newlogin = new userlogin;
       $newlogin->dbconnect();
       $sql = "select m.recnum,m.partname,m.wonum,m.customer,m.partnum,
                      m.CIM_refnum,w.wonum,w.qty,w.woclassif
                      from master_data m, work_order w
                      where w.link2masterdata = m.recnum and
                            w.condition != 'Cancelled'
                order by (w.wonum+0)";
				// echo $sql;
       $result = mysql_query($sql);
       return $result;
    }


    function getrejqty4custpo($ponum,$crnnum,$line_num) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
         $sql = "select rej_qty,ret_qty,cust_rej_qty
                 from  work_order wo,
					   master_data m
				 where 
					   wo.`condition` != 'Cancelled' and
                       wo.`condition` != 'WO Cancelled' and
				       wo.po_num='$ponum' and
					   wo.link2masterdata = m.recnum and
					   m.CIM_refnum='$crnnum' and
					  (case when (wo.cust_po_line_num != '' && wo.cust_po_line_num is not null)
                             then wo.cust_po_line_num = '$line_num' else true end)

                       group by wo.po_num ";
		// echo $sql;
        $result = mysql_query($sql);
         if(!$result) {
           echo "Query failed for rejqty " . mysql_error();
           die("Please report to Sysadmin. ");
        }
        //echo "$sql";
        return $result;

     }

    function getwoqty4custpo($ponum,$crnnum,$line_num) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
         $sql = "select sum(wo.qty)
                 from  work_order wo, master_data m
				 where
                       wo.po_num='$ponum' and
					   wo.link2masterdata = m.recnum and
					   m.CIM_refnum='$crnnum' and
					   wo.`condition` != 'Cancelled' and
                                           wo.`condition` != 'WO Cancelled' and
                       (case when (wo.cust_po_line_num != '' && wo.cust_po_line_num is not null)
                             then wo.cust_po_line_num = '$line_num' else true end)
                       group by wo.po_num";
					   // echo $sql;
        $result = mysql_query($sql);
         if(!$result) {
           echo "Query failed for woqty " . mysql_error();
           die("Please report to Sysadmin. ");
        }
        //echo "$sql";
        return $result;

     }

   /* function getAllCIMs4Split($CIM_refnum)
    {
       $newlogin = new userlogin;
       $newlogin->dbconnect();
       $sql = "select m.recnum,m.partname,m.wonum,m.customer,m.partnum,
                      m.CIM_refnum,w.wonum,w.qty,w.woclassif,(w.original_qty-w.qty),w.grnnum,w.batchnum
                      from master_data m, work_order w
                      where w.link2masterdata = m.recnum and
                            (w.original_qty > 0 and w.original_qty is not NULL )
							and m.CIM_refnum ='$CIM_refnum'
                order by w.wonum";
				//echo $sql;
       $result = mysql_query($sql);
       return $result;
     } */

   /*  function getAllCIMs4Split()
    {
       $newlogin = new userlogin;
       $newlogin->dbconnect();
       $sql = "select m.recnum,m.partname,m.wonum,m.customer,m.partnum,
                      m.CIM_refnum,w.wonum,w.qty,w.woclassif,(w.original_qty-w.qty),w.grnnum,w.batchnum,
                      m.RM_by_CIM,m.project,m.attachments,m.RM_by_customer,m.rm_type,m.rm_spec,m.rm_dim1,m.rm_dim2,
                      m.rm_dim3,mp.mps_revision ,m.mps_num,
                      m.drawing_num,m.cos,m.drg_issue,mp.recnum
                      from master_data m, work_order w,mps mp
                           where  m.recnum = mp.link2master_data  and
                                  w.link2masterdata = m.recnum and
                                  (w.original_qty > 0 and w.original_qty is not NULL )

                order by w.wonum";
			//	echo $sql;
       $result = mysql_query($sql);
       return $result;
     } */

      function getAllCIMs4Split()
    {
       $newlogin = new userlogin;
       $newlogin->dbconnect();
       $sql = "select m.recnum,m.partname,m.wonum,m.customer,m.partnum,
                      m.CIM_refnum,w.wonum,w.qty,w.woclassif,(w.original_qty-w.qty),w.grnnum,w.batchnum,
                      m.RM_by_CIM,m.project,m.attachments,m.RM_by_customer,w.rm_type,w.rm_spec,m.rm_dim1,m.rm_dim2,
                      m.rm_dim3,mp.mps_revision ,m.mps_num,
                      m.drawing_num,m.cos,m.drg_issue,mp.recnum,g.grnnum,g.batch_num,
                      g.raw_mat_type,g.raw_mat_spec
                      from mps mp,master_data m,grn g,work_order w

                           where  m.recnum = mp.link2master_data  and
                                  w.link2masterdata = m.recnum and
                                  g.grnnum=w.grnnum and
                                  (w.original_qty > 0 and w.original_qty is not NULL )  and
			          (w.`condition` = 'Open' or w.`condition` = 'Closed')

                order by w.wonum";
				//echo $sql;
       $result = mysql_query($sql);
       return $result;
     }


     function get_prev_wo($crn)
     {
       $newlogin = new userlogin;
       $newlogin->dbconnect();
       $sql = "select w.fai,w.link2mps,m.mps_rev,mps.mps_revision from
               master_data m ,work_order w left join mps mps on (w.link2mps = mps.recnum)
                  where w.link2masterdata=m.recnum
                   and m.CIM_refnum = '$crn'
                   order by w.recnum desc limit 1";
       // echo $sql;
       $result = mysql_query($sql);
       if(!$result) die(".......get Previous wo for fair....... failed...Please report to SysAdmin. " . mysql_error());
       return $result;
     }

     function getgrnnum4wo($wonum)
     {
        $newlogin = new userlogin;
       $newlogin->dbconnect();
       $sql = "select grn_num,batch_num from work_order where wonum='$wonum' and grntype !='Quarantined'
                order by w.wonum";
				//echo $sql;
       $result = mysql_query($sql);
       return $result;
     }

       function getPrev_wo($crn)
     {
       $newlogin = new userlogin;
       $newlogin->dbconnect();
       $sql = "select w.wonum,w.crn_num,w.fai
              from work_order w
                   where w.crn_num='$crn'
                         order by w.recnum desc limit 1";
        //echo $sql;
       $result = mysql_query($sql);
       if(!$result) die(".......get Previous wo for fair....... failed...Please report to SysAdmin. " . mysql_error());
       return $result;
     }

     function getPrevrev_match($crn,$wonum)
     {
       $newlogin = new userlogin;
       $newlogin->dbconnect();
       $sql = "select w.link2mps,m.mps_rev,mps.mps_revision
               from master_data m ,work_order w left join mps mps on (w.link2mps = mps.recnum)
                    where w.crn_num = m.CIM_refnum
                          and m.CIM_refnum = '$crn'
                          and w.wonum='$wonum'
                          order by w.recnum desc limit 1";
        //echo $sql;
       $result = mysql_query($sql);
       if(!$result) die(".......get Previous wo for fair....... failed...Please report to SysAdmin. " . mysql_error());
       return $result;
     }

      function getApp($wo)
   {

     $newlogin = new userlogin;
     $newlogin->dbconnect();
     $sql= "select fa.status from fair fa where fa.wonum='$wo'";
     //echo $sql;
     $result = mysql_query($sql);
     if(!$result) die(".......get Approval....... failed...Please report to SysAdmin. " . mysql_error());
     return $result;
   }

    function updatePrev_wo($wonum,$worefnum)
   {
       $newlogin = new userlogin;
       $newlogin->dbconnect();
       $worefnum = "'" . $worefnum . "'";
       $sql="update work_order
             set worefnum='$wonum' where wonum= $worefnum";
            //echo$sql;
             $result=mysql_query($sql);
              if(!$result) die(".......Update worefnum for Work Order....... failed...Please report to SysAdmin. " . mysql_error());

   }

     function getprev_woref($wonum)
   {
       $newlogin = new userlogin;
       $newlogin->dbconnect();
      // $worefnum = "'" . $worefnum . "'";
       $sql="select worefnum from work_order where wonum='$wonum'";
       //echo$sql;
       $result=mysql_query($sql);
       if(!$result) die(".......Update worefnum for Work Order....... failed...Please report to SysAdmin. " . mysql_error());
        $row= mysql_fetch_array($result, MYSQL_ASSOC);
        return $row['worefnum'];
   }

  /* function getprevcrndetails($crn)
   {
       $newlogin = new userlogin;
       $newlogin->dbconnect();
       $sql = "select w.actual_ship_date,w.book_date,w.condition,w.treatment,w.wonum,w.recnum,w.sch_due_date,
                      w.revised_ship_date
                      from work_order w
                            where w.crn_num='$crn' and w.condition ='Open'
                            ORDER by (w.wonum+0)";
               //echo $sql;

             $result=mysql_query($sql);
              if(!$result) die(".......getprevcrndetails....... failed...Please report to SysAdmin. " . mysql_error());
              return $result;
   } */
   function getprevcrndetails($crn)
   {
       $newlogin = new userlogin;
       $newlogin->dbconnect();
       $sql = "select w.actual_ship_date,w.book_date,w.condition,w.treatment,w.wonum,w.recnum,w.sch_due_date,
                      w.revised_ship_date
                      from work_order w
                            where w.crn_num='$crn' and w.condition ='Open'
                            ORDER by (w.wonum+0)";
               //echo $sql;

             $result=mysql_query($sql);
              if(!$result) die(".......getprevcrndetails....... failed...Please report to SysAdmin. " . mysql_error());
              return $result;
   }

   // To update printflag whenever print command is issued
   function updprintflag($worecnum)
   {
       $newlogin = new userlogin;
       $newlogin->dbconnect();
       $sql = "update work_order
	                set printflag = 1,
					    printapproval = 0
	             where recnum = $worecnum";
               //echo $sql;

       $result=mysql_query($sql);
       if(!$result) die("Update of print failed...Please report to SysAdmin. " . mysql_error());
   }
   
    function getprev_wo_app($crn_num)
   {
       $newlogin = new userlogin;
       $newlogin->dbconnect();
       $sql="select w.recnum,w.approval,w.approval_date,w.fai from work_order w where w.crn_num='$crn_num'
             order by w.recnum desc limit 1";
      // echo$sql;
       $result=mysql_query($sql);
       if(!$result) die(".......getprev_wo_app....... failed...Please report to SysAdmin. " . mysql_error());
       return $result;
   }
   function getapp_wocrn($crn,$revmatch)
   {
      $newlogin = new userlogin;
       $newlogin->dbconnect();

       $sql="select w.fai,w.recnum
             from work_order w
                  where (w.link2mps=$revmatch)  and
                  w.crn_num='$crn' and
                  (w.fai='APPROVED' ||w.fai='CUST APPROVED') ";
      // echo$sql;
       $result=mysql_query($sql);
       if(!$result) die(".......getapp_wocrn....... failed...Please report to SysAdmin. " . mysql_error());
       $row= mysql_fetch_array($result, MYSQL_ASSOC);
       return $row['recnum'];
   }

/*function get_womps_stat($link2mps)
   {
      $newlogin = new userlogin;
       $newlogin->dbconnect();
       $sql="select w.fai,w.recnum
             from work_order w
                  where w.link2mps=$link2mps order by w.recnum desc limit 1";
      // echo$sql;
       $result=mysql_query($sql);
       if(!$result) die(".......getapp_wocrn....... failed...Please report to SysAdmin. " . mysql_error());
       return $result ;
   }
   
   function get_wocrn_stat($link2mst)
   {
      $newlogin = new userlogin;
       $newlogin->dbconnect();
       $sql="select w.fai,w.recnum
             from work_order w
                  where w.link2masterdata=$link2mst order by w.recnum desc limit 1";
      // echo$sql;
       $result=mysql_query($sql);
       if(!$result) die(".......getapp_wocrn....... failed...Please report to SysAdmin. " . mysql_error());
       return $result ;
   }  */
   
   function getwomps($crn)
   {
       $newlogin = new userlogin;
       $newlogin->dbconnect();
       $sql="select w.fai,w.recnum,mps.mps_revision,mps.recnum
             from work_order w,mps mps,master_data m
                  where w.crn_num='$crn' and
                        w.crn_num=m.CIM_refnum and
                        mps.link2master_data=m.recnum
                        order by w.recnum desc limit 1";
       //echo$sql;
       $result=mysql_query($sql);
       if(!$result) die(".......getwomps....... failed...Please report to SysAdmin. " . mysql_error());
       return $result ;
   }
   function getwocrnrev($crn)
   {
       $newlogin = new userlogin;
       $newlogin->dbconnect();
       $sql="select w.fai,w.recnum,m.mps_rev
             from work_order w,master_data m
                  where w.crn_num='$crn' and
                  w.crn_num=m.CIM_refnum
                  order by w.recnum desc limit 1";
       //echo$sql;
       $result=mysql_query($sql);
       if(!$result) die(".......getwocrnrev....... failed...Please report to SysAdmin. " . mysql_error());
       return $result ;
   }
   function getworkorder4redflag($crn)
   {
      $newlogin = new userlogin;
      $newlogin->dbconnect();

      $sql = " select w.treatment,w.book_date,w.`condition`,w.actual_ship_date,
	                  w.dn_qty_sent
                       from work_order w
                       where w.crn_num='$crn' and w.`condition`='Open' and 
                       (
                        w.crn_num not like '35-017%' and
                        w.crn_num not like '18-106%' and
                        w.crn_num not like '18-108A%' and
                        w.crn_num not like '18-123A%' and
                        w.crn_num not like '18-113A%' and
                        w.crn_num not like '18-117B' and
                        w.crn_num not like '18-388A%' and
                        w.crn_num not like '18-119B%' and
                        w.crn_num not like '18-295A%' and
                        w.crn_num not like '18-388A%' and
                        w.crn_num not like '18-382A%' and
                        w.crn_num not like '18-386A%' and
                        w.crn_num not like '18-045B%' and
                        w.crn_num not like '28-002A%' and
                        w.crn_num not like '18-208A%' and
                        w.crn_num not like '35-071%' and
                        w.crn_num not like '35-172%' and
                        w.crn_num not like '18-001%' and
                        w.crn_num not like '18-002%' and
                        w.crn_num not like '18-008%' and
                        w.crn_num not like '18-009%' and
                        w.crn_num not like '18-209%' and
                        w.crn_num not like '18-101A%' and
                        w.crn_num not like '18-284%' and
                        w.crn_num not like '18-087%' and
                        w.crn_num not like '35-144A%' 
                        ) and
                             (w.actual_ship_date is NULL || w.actual_ship_date = '0000-00-00' || w.actual_ship_date = '')
                             order by w.book_date asc limit 1 ";
      // echo $sql;
       $result=mysql_query($sql);
       if(!$result) die(".......getworkorder4redflag....... failed...Please report to SysAdmin. " . mysql_error());
       return $result;
   }
   
   function getncdetails4crn($crn)
   {
      $newlogin = new userlogin;
      $newlogin->dbconnect();
      $siteid = $_SESSION['siteid'];
      $siteval = "siteid = '".$siteid."'";
      $sql = "select recnum as ncnum,refnum,status,create_date
                      from nc4qa
                           where (status='Open' || status=''||status is null || status ='NULL') and $siteval
                                 and refnum='$crn'
                                 having DATEDIFF(now(),create_date)>84 
                                 order by recnum asc limit 1";

                                 // echo $sql;
        $result  = mysql_query($sql) or die('getncdetails4crn failed ' . mysql_error());
        $row     = mysql_fetch_array($result, MYSQL_ASSOC);
        $ncnum = $row['ncnum'];
     // echo "<br>$numrows<br>";
        return $ncnum;
   }
   function getreworkdets4crn($crnnum)
   {
      $newlogin = new userlogin;
      $newlogin->dbconnect();
      $sql = "select sum(wps.rework) as rework
                     from wo_part_status wps,work_order w
                          where w.crn_num='$crnnum' and
                                wps.link2wo=w.recnum and
                                w.`condition` !='Cancelled' and
                                w.`condition` !='Hold' ";
       //echo $sql;
       $result=mysql_query($sql);
       if(!$result) die(".......getreworkdets4crn....... failed...Please report to SysAdmin. " . mysql_error());
        $row     = mysql_fetch_array($result, MYSQL_ASSOC);
        $rework = $row['rework'];
     // echo "<br>$numrows<br>";
        return $rework;
   
   }
   
    function getNotes4wo($inpworecnum) {
        $userrole = $_SESSION['userrole'];
        $userid = $_SESSION['user'];
        $userrecnum = $_SESSION['userrecnum'];
        $worecnum = "'" . $inpworecnum . "'";
        $sql = "select n.create_date, n.wonotes, u.userid
                     from wonotes n, user u, work_order w
                     where n.link2wo = w.recnum and
                           n.link2user = u.recnum and
                           w.recnum = $worecnum order by n.recnum";
                          // echo $sql;
        $result = mysql_query($sql);
        return $result;
     }
     
      function addNotes4wo($worecnum,$notes) {

        // Connect to database
        $userid = $_SESSION['user'];
        $userrecnum = $_SESSION['userrecnum'];
        $specinstrns = "'" . $notes . "'";
        $sql = "INSERT INTO wonotes (wonotes,link2wo, link2user,create_date )
               VALUES ($specinstrns, $worecnum, $userrecnum, curdate())";
        $result = mysql_query($sql);
        // Test to make sure query worked
        if(!$result) die("Insert of Notes didn't work. " . mysql_error());

      }
      
      function getgrnwoqty($grnnum){
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select g.recnum,g.qty_used as qty_used
		            from grn g
		         where g.grnnum='$grnnum'";
       // echo "<br>$sql";
        $result  = mysql_query($sql) or die('getgrnretqty failed');
        $row     = mysql_fetch_array($result, MYSQL_ASSOC);
        $qty_used = $row['qty_used'];
        return $qty_used;
 }
 function getgrnlogwoqty($grnnum)
 {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select g.running_bal as running_bal ,sum(g.return) as ret
		            from grnactivitylog g
		         where g.grnnum='$grnnum' group by g.grnnum order by g.grnnum desc limit 1 ";
        //echo "$sql";
        $result  = mysql_query($sql) or die('getgrnlogwoqty failed'); ;
        $row     = mysql_fetch_array($result, MYSQL_ASSOC);
        $qty_used = $row['running_bal']."||". $row['ret'];
        return $qty_used;
 }
 function updategrn4woqty($wousdqty,$grn)
 {
     $newlogin = new userlogin;
     $newlogin->dbconnect();
     $wousdqty=$wousdqty?$wousdqty:0;
     $sql1 = "update grn g
                   set g.qty_used=$wousdqty
                        where g.grnnum='$grn' ";
                             // echo $sql1."<br>";exit;
         $result1 = mysql_query($sql1);
         if(!$result1)
           {
	         die("Update return qty for GRN didn't work..Please report to Sysadmin. " . mysql_error());
           }
 }

 function updategrnlog4woqty($wousdqty,$grn,$wonum)
 {
     $newlogin = new userlogin;
     $newlogin->dbconnect();
     $wousdqty=$wousdqty?$wousdqty:0;
     $bookdate = $this->bookdate  ? "'" . $this->bookdate . "'" : '0000-00-00';
     $qty = "'" . $this->qty . "'";
     $sql1 = "update grn activitylog g
                     set g.running_bal=$wousdqty ,
                         g.wonum='$wonum',
                         g.book_date=$bookdate,
                         g.balance_date=$bookdate,
                         g.woqty=$qty
                           where g.grnnum='$grn' ";
         //echo $sql1."<br>";
         $result1 = mysql_query($sql1);
         if(!$result1)
         {
           die("updategrnlog4woqty for GRN didn't work..Please report to Sysadmin. " . mysql_error());
         }
 }
 
 function getgrnactivitylog($grnnum)
 {
     $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select g.recnum as rec ,g.wonum as wonum
		            from grnactivitylog g
		         where g.grnnum='$grnnum' order by g.wonum";
        //echo "<br>$sql";
        $result  = mysql_query($sql) or die('getgrnactivitylog failed');
        return $result;
 
 }
 
 function addgrnlog4woqty($wousdqty,$grn,$wonum)
 {
     $newlogin = new userlogin;
     $newlogin->dbconnect();
     $wousdqty=$wousdqty?$wousdqty:0;
     $crn =  "'" . $this->crn . "'";
     $bookdate = $this->bookdate  ? "'" . $this->bookdate . "'" : '0000-00-00';
     $qty = "'" . $this->qty . "'";
     $sql1 = "insert into grnactivitylog (grnnum,wonum,book_date,crn,running_bal,balance_date,creat_date,woqty)
                    values('$grn','$wonum',$bookdate,$crn,$wousdqty,$bookdate,now(),$qty) ";
         //echo $sql1."<br>";
         $result1 = mysql_query($sql1);
         if(!$result1)
         {
           die("addgrnlog4woqty for GRNACTIVITY LOG from WO didn't work..Please report to Sysadmin. " . mysql_error());
         }
 }
 
 function getrework_dets4crn($crnnum)
   {
      $newlogin = new userlogin;
      $newlogin->dbconnect();
      $sql = "select sum(wps.rework) as rework
                     from wo_part_status wps,work_order w
                          where w.crn_num='$crnnum' and
                                wps.link2wo=w.recnum and
                                w.`condition` !='Cancelled' and
                                w.`condition` !='Hold' and
                                w.`condition` !='WO Cancelled'
                                order by (w.wonum+0) asc limit 1";
       //echo $sql;
       $result=mysql_query($sql);
       if(!$result) die(".......getreworkdets4crn....... failed...Please report to SysAdmin. " . mysql_error());
        $row     = mysql_fetch_array($result, MYSQL_ASSOC);
        $rework = $row['rework'];
     // echo "<br>$numrows<br>";
        return $rework;

   }
   
    function getwoqty4grn($grnnum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql2 = "select (sum(w.qty)) as qty_used
                       from work_order w where w.`condition` !='WO Cancelled'  and w.grnnum='$grnnum'
                       group by w.grnnum";
        //echo $sql2;
        $result2 = mysql_query($sql2);
        if(!$result2) die("getwoqty4grn failed..Please report to Sysadmin. " . mysql_error());
        $row     = mysql_fetch_array($result2, MYSQL_ASSOC);
        $qty_used = $row['qty_used'];
     // echo "<br>$numrows<br>";
        return $qty_used;
      }
      
     function delete4mfair($wonum)
     {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "delete from fair where wonum='$wonum'";
       // echo $sql;
        $result = mysql_query($sql);
        if(!$result) die("delete4mfair in wo failed..Please report to Sysadmin. " . mysql_error());
     
     }

     function updatedelivery_sch($cond)
{
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $qty = $this->qty ? $this->qty : 0;
        $wo_issue_qty = $this->wo_issue_qty;
        $sql="update delivery_sch set wo_issue_qty=wo_issue_qty+$qty  $cond";
       // echo "<br>$sql<br>";exit;
        $result = mysql_query($sql);
        if(!$result) die("Update of Condition Failed. " . mysql_error());
}
 function addgrnIssue($wonum,$clbal)
 {

     $newlogin = new userlogin;
     $newlogin->dbconnect();
     $wousdqty=$wousdqty?$wousdqty:0;
    $sql = "select nxtnum from seqnum where tablename = 'grn_issue' for update";
    //echo $sql;
    $result = mysql_query($sql);
    $myrow = mysql_fetch_row($result);
    $seqnum = $myrow[0];
    $objid = $seqnum + 1;
    $opbal = $this->qtm;
    $qty4wo = $this->qty;
    $grnnum = "'". $this->grnnum ."'";
    $siteid= "'". $_SESSION['siteid'] ."'";
    $condition = "'" . 'Open' . "'";
           
     $sql = "insert into grn_issue( recno,iss_date,opbal,qty4wo,clbal,grnnum,wonum,wo_status,siteid) 
                   values($objid,now(),$opbal,$qty4wo,$clbal,$grnnum,$wonum,$condition,$siteid)";
                             // echo $sql."<br>";exit;
        $result = mysql_query($sql);
       if(!$result)
      {
        die("insert into grn_issue didn't work..Please report to Sysadmin. " . mysql_error());
       }

     $sql = "update seqnum set nxtnum = $objid where tablename = 'grn_issue'";
     $result = mysql_query($sql);
  if(!$result)
  {
     $sql = "rollback";
     $result = mysql_query($sql);
     die("Seqnum insert for work order didn't work...Please report to Sysadmin. " . mysql_errno());
  }
 }
 function addgrniss4wocancel($clbal,$wonum)
 {
     $newlogin = new userlogin;
     $newlogin->dbconnect();
    $sql = "select nxtnum from seqnum where tablename = 'grn_issue' for update";
    //echo $sql;
    $result = mysql_query($sql);
    $myrow = mysql_fetch_row($result);
    $seqnum = $myrow[0];
    $objid = $seqnum + 1;
    $qty4wo = $this->qty;
    $grnnum = "'". $this->grnnum ."'";
    $condition = "'". $this->condition ."'";
    $clbal1 = $clbal+$qty4wo;
    $opbal =  $clbal;
   
     $sql = "insert into grn_issue( recno,iss_date,opbal,qty4wo,clbal,grnnum,wonum,wo_status) 
                   values($objid,now(),$opbal,$qty4wo,$clbal1,$grnnum,$wonum,$condition)";
                             // echo $sql."<br>";exit;
        $result = mysql_query($sql);
       if(!$result)
      {
        die("insert into grn_issue didn't work..Please report to Sysadmin. " . mysql_error());
       }

     $sql = "update seqnum set nxtnum = $objid where tablename = 'grn_issue'";
     $result = mysql_query($sql);
  if(!$result)
  {
     $sql = "rollback";
     $result = mysql_query($sql);
     die("Seqnum insert for work order didn't work...Please report to Sysadmin. " . mysql_errno());
  }
 }


  function getgrnIssue4wo($wonum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql2 = "select g.clbal
                       from grn_issue g where  g.wonum='$wonum'";
        // echo $sql2;exit;
        $result2 = mysql_query($sql2);
        if(!$result2) die("getclbal4grn failed..Please report to Sysadmin. " . mysql_error());
        $row     = mysql_fetch_row($result2);
        $clbal = $row[0];
     // echo "<br>$ret_qty<br>";exit;
        return $clbal;
      }


      function getgrnqtm($grnnum){
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select g.recnum,gli.qty_to_make as qtm
                from grn g, grn_li gli
             where g.recnum = gli.link2grn and g.grnnum='$grnnum'";
       // echo "<br>$sql";
        $result  = mysql_query($sql) or die('getgrnretqty failed');
        $row= mysql_fetch_array($result, MYSQL_ASSOC);
        $qtm = $row['qtm'];
        return $qtm;
 }

 function subWoIssQty($schduedate,$crn,$qty)
  {
         $newlogin = new userlogin;
          $newlogin->dbconnect();

              $sql="update delivery_sch 
                set wo_issue_qty=wo_issue_qty - $qty 
                where crnnum='$crn' and schedule_date='$schduedate'";
                // echo $sql;exit;
              mysql_query($sql);  
  }


} // End work order class definition
